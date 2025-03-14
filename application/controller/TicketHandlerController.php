<?php

/**
 * This controller shows an area that's only visible for logged in users (because of Auth::checkAuthentication(); in line 16)
 */
class TicketHandlerController extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    public function __construct()
    {
        parent::__construct();
        Auth::checkAuthentication();
    }

    /**
     * This method controls what happens when you move to /ticket/index in your app.
     */
    public function index($ticket_id)
    {
        $ticket = TicketHandlerModel::getTicketById($ticket_id);
        $messages = TicketHandlerModel::getAllMessages($ticket_id);

        if (!$ticket) {
            $this->View->render('error/index', ['errorMessage' => 'Ticket not found.']);
            return;
        }

        $this->View->render('ticketHandler/index', [
            'ticket' => $ticket,
            'messages' => $messages
        ]);
    }

    public function edit($ticket_id)
    {
        $ticket = TicketModel::getTicket($ticket_id);
        $messages = TicketHandlerModel::getAllMessages($ticket_id);

        $this->View->render('ticketHandler/edit', [
            'ticket' => $ticket,
            'messages' => $messages
        ]);
    }

    /**
     * Respond to a ticket by adding a new message
     */
    public function respondToTicket()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ticket_id = (int)$_POST['ticket_id'];
            $message = trim($_POST['message'] ?? '');
            $attachment_path = null;

            if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] === UPLOAD_ERR_OK) {
                $upload_dir = Config::get('PATH_IMAGES') . Session::get('user_id') . '/';
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0755, true);
                }

                $filename = uniqid() . '_' . basename($_FILES['attachment']['name']);
                $target_file = $upload_dir . $filename;

                if (move_uploaded_file($_FILES['attachment']['tmp_name'], $target_file)) {
                    $attachment_path = 'images/' . Session::get('user_id') . '/' . $filename;
                } else {
                    Session::add('feedback_negative', 'Failed to upload the attachment.');
                }
            }

            $result = TicketHandlerModel::saveMessage($ticket_id, Session::get('user_id'), $message, $attachment_path);

            if ($result) {
                Session::add('feedback_positive', 'Message sent successfully.');
            } else {
                Session::add('feedback_negative', 'An error occurred while sending the message.');
            }

            header('Location: ' . Config::get('URL') . 'ticketHandler/index/' . $ticket_id);
            exit;
        }

        header('Location: ' . Config::get('URL') . 'ticket');
        exit;
    }

    public function updateTicket()
    {
        if (!isset($_POST['ticket_id'], $_POST['subject'], $_POST['description'], $_POST['priority'], $_POST['category'], $_POST['status'])) {
            Session::add('feedback_negative', 'Missing required fields.');
            Redirect::to('ticket/view/' . $_POST['ticket_id']);
            return;
        }

        $ticket_id = intval($_POST['ticket_id']);
        $subject = trim($_POST['subject']);
        $description = trim($_POST['description']);
        $priority = trim($_POST['priority']);
        $category = trim($_POST['category']);
        $status = trim($_POST['status']);

        $allowed_statuses = ['open', 'waiting', 'resolved'];
        if (!in_array($status, $allowed_statuses, true)) {
            Session::add('feedback_negative', 'Invalid ticket status.');
            Redirect::to('ticketHandler/index/' . $ticket_id);
            return;
        }

        $allowed_priorities = ['low', 'mid', 'high'];
        if (!in_array($priority, $allowed_priorities, true)) {
            Session::add('feedback_negative', 'Invalid priority value.');
            Redirect::to('ticketHandler/index/' . $ticket_id);
            return;
        }

        if (TicketModel::updateTicket($ticket_id, $subject, $description, $priority,  $status, $category)) {
            Session::add('feedback_positive', 'Ticket updated successfully.');
        } else {
            Session::add('feedback_negative', 'Failed to update ticket.');
        }

        Redirect::to('ticketHandler/index/' . $ticket_id);
    }

    public function closeTicket()
    {
        $ticket_id = intval($_POST['ticket_id']);

        if (TicketHandlerModel::closeTicket($ticket_id)) {
            Session::add('feedback_positive', 'Ticket closed successfully.');
        } else {
            Session::add('feedback_negative', 'Failed to close ticket.');
        }

        Redirect::to('ticket/index/');
    }
}
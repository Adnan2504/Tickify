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
                    mkdir($upload_dir, 0755, true);  // Create directory if it doesn't exist
                }

                $filename = uniqid() . '_' . basename($_FILES['attachment']['name']);
                $target_file = $upload_dir . $filename;

                if (move_uploaded_file($_FILES['attachment']['tmp_name'], $target_file)) {
                    $attachment_path = 'images/' . Session::get('user_id') . '/' . $filename;  // Save the relative path
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

}

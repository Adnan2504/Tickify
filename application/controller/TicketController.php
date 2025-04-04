<?php

/**
 * This controller shows an area that's only visible for logged in users (because of Auth::checkAuthentication(); in line 16)
 */
class TicketController extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    public function __construct()
    {
        parent::__construct();

        // this entire controller should only be visible/usable by logged in users, so we put authentication-check here
        Auth::checkAuthentication();
    }

    /**
     * This method controls what happens when you move to /ticket/index in your app.
     */

    public function index()
    {
        $tickets = TicketModel::getAllTickets();

        // Get filter parameters
        $selectedPriorities = isset($_GET['priority']) ? $_GET['priority'] : [];
        $selectedStatuses = isset($_GET['status']) ? $_GET['status'] : [];
        $sortOrder = isset($_GET['sort']) ? $_GET['sort'] : 'newest';

        // Apply filters
        if (!empty($selectedPriorities) || !empty($selectedStatuses)) {
            $tickets = array_filter($tickets, function($ticket) use ($selectedPriorities, $selectedStatuses) {
                $priorityMatch = empty($selectedPriorities) || in_array($ticket->priority, $selectedPriorities);
                $statusMatch = empty($selectedStatuses) || in_array($ticket->status, $selectedStatuses);
                return $priorityMatch && $statusMatch;
            });
        }

        // Apply sorting
        if ($sortOrder === 'oldest') {
            usort($tickets, function($a, $b) {
                return strtotime($a->created_at) - strtotime($b->created_at);
            });
        } else {
            usort($tickets, function($a, $b) {
                return strtotime($b->created_at) - strtotime($a->created_at);
            });
        }

        $this->View->render('ticket/index', array(
            'tickets' => $tickets,
            'selectedPriorities' => $selectedPriorities,
            'selectedStatuses' => $selectedStatuses,
            'sortOrder' => $sortOrder
        ));
    }

    public function createTicket()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $subject = trim($_POST['subject'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $priority = trim($_POST['priority'] ?? '');
            $category = trim($_POST['category'] ?? '');

            if (empty($subject) || empty($description) || empty($priority)) {
                Session::add('feedback_negative', 'Please fill in all required fields.');
                header('Location: ' . Config::get('URL') . 'ticket');
                exit;
            }

            $result = TicketModel::createTicket($subject, $description, $priority, $category);

            if ($result) {
                Session::add('feedback_positive', 'Ticket created successfully.');
            } else {
                Session::add('feedback_negative', 'An error occurred while creating the ticket.');
            }

            header('Location: ' . Config::get('URL') . 'ticket');
            exit;
        }

        header('Location: ' . Config::get('URL') . 'ticket');
    }

    /**
     * This method controls what happens when you move to /ticket/edit(/XX) in your app.
     * Shows the current content of the ticket and an editing form.
     * @param $note_id int id of the ticket
     */
    public function edit($note_id)
    {
        $this->View->render('ticket/edit', array(
            'ticket' => TicketModel::getTicket($note_id)
        ));
    }

    /**
     * This method controls what happens when you move to /ticket/edit(/XX) in your app.
     * Shows the current content of the ticket and an editing form.
     * @param $note_id int id of the ticket
     */
    public function ticket_handler($note_id)
    {
        $this->View->render('ticketHandler/index', array(
            'ticket' => TicketModel::getTicket($note_id),
            'messages' => TicketModel::getTicket($note_id)
        ));
    }

    /**
     * This method controls what happens when you move to /ticket/editSave in your app.
     * Edits a ticket (performs the editing after form submit).
     * POST request.
     */
    public function editSave()
    {
        $ticket_id   = Request::post('ticket_id');
        $subject     = Request::post('subject');
        $description = Request::post('description');
        $priority    = Request::post('priority');
        $category    = Request::post('category');
        $status      = Request::post('status');

        if ($status === null) {
            $ticket = TicketModel::getTicket($ticket_id);
            $status = $ticket->status;
        }

        TicketModel::updateTicket($ticket_id, $subject, $description, $priority, $status, $category);
        Redirect::to('ticket');
    }

    /**
     * This method controls what happens when you move to /ticket/delete(/XX) in your app.
     * Deletes a ticket. In a real application, a deletion via GET/URL is not recommended, but for demo purposes, it's okay.
     * @param int $ticket_id ID of the ticket
     */
    public function delete($ticket_id)
    {
        TicketModel::deleteTicket($ticket_id);
        Redirect::to('ticket');
    }

}
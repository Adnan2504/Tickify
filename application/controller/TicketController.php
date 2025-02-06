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
        $this->View->render('ticket/index', array(
            'tickets' => TicketModel::getAllTickets()
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

        TicketModel::updateTicket($ticket_id, $subject, $description, $priority, $category);
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

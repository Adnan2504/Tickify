<?php

/**
 * This controller shows an area that's only visible for logged in users (because of Auth::checkAuthentication(); in line 16)
 */
class CreateTicketController extends Controller
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
        $this->View->render('createTicket/index');
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
}
<?php

class IndexController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        Auth::checkAuthentication();

    }

    public function index()
    {
        if (isset($_POST['user_text'])) {
            $_SESSION['temp_index_history'][] = array("role" => "user", "content" => $_POST['user_text']);
            Redirect::to('index/index');
            exit();
        }

        if (isset($_POST['continue_in_chat'])) {
            // Initialize history if it doesn't exist
            if (!isset($_SESSION['history'])) {
                $_SESSION['history'] = [["role" => "system", "content" => "You are a helpful assistant."]];
            }
            // Append temp history (skip system message)
            if (isset($_SESSION['temp_index_history']) && count($_SESSION['temp_index_history']) > 1) {
                for ($i = 1; $i < count($_SESSION['temp_index_history']); $i++) {
                    $_SESSION['history'][] = $_SESSION['temp_index_history'][$i];
                }
            }
            Redirect::to('aiChat/index');
            exit();
        }

        //Save only the last 3 tickets (-3 from the end and 3 ist the length)
        $allTickets = TicketModel::getAllTickets();
        $latestTickets = array_slice($allTickets, -3, 3);

        $this->View->render('index/index', array(
            'tickets' => $latestTickets
        ));
    }
}
<?php

class IndexController extends Controller
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
     * Handles what happens when user moves to URL/index/index - or - as this is the default controller, also
     * when user moves to /index or enter your application at base level
     */
    public function index()
    {
        //Save only the last 3 tickets (-3 from the end and 3 ist the length)
        $allTickets = TicketModel::getAllTickets();
        $latestTickets = array_slice($allTickets, -3, 3);

        $this->View->render('index/index', array(
            'tickets' => $latestTickets
        ));
    }
}

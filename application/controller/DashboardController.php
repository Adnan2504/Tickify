<?php

/**
 * This controller shows an area that's only visible for logged in users (because of Auth::checkAuthentication(); in line 16)
 */
class DashboardController extends Controller
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
     * This method controls what happens when you move to /dashboard/index in your app.
     */
    public function index()
    {
        $ticketStats = DashboardModel::getTicketStats();
        $messageStats = DashboardModel::getMessageCount();

        $this->View->render('dashboard/index', [
            'ticketStats' => $ticketStats,
            'messageStats' => $messageStats
        ]);
    }
}

 <?php

/**
 * This controller shows an area that's only visible for logged in users (because of Auth::checkAuthentication(); in line 16)
 */
class DashboardController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        Auth::checkAuthentication();
    }

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


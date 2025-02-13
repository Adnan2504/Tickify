<?php

/**
 * Handles all data manipulation of the Ticket part
 */
class DashboardModel
{
    public static function getTicketStats()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $query = $database->prepare("SELECT 
                COUNT(CASE WHEN status = 'open' THEN 1 END) AS open_tickets,
                COUNT(CASE WHEN status = 'waiting' THEN 1 END) AS in_progress_tickets,
                COUNT(CASE WHEN status = 'resolved' THEN 1 END) AS solved_tickets
            FROM support_tickets");
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public static function getMessageCount()
    {
        $database = DatabaseFactory::getFactory()->getConnection();
        $query = $database->prepare("SELECT COUNT(*) as total_messages FROM messages WHERE sender_id = :user_id");
        $query->execute([':user_id' => $_SESSION['user_id']]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }
}

<?php

/**
 * Handles all data manipulation of the Ticket part
 */
class TicketModel
{

    /**
     * Get all tickets created by the current logged-in user
     * @return array an array with ticket objects
     */
    public static function getAllTickets()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT id, subject, description, priority, category,status , created_at FROM support_tickets WHERE created_by = :user_id";
        $query = $database->prepare($sql);

        $query->execute(array(':user_id' => Session::get('user_id')));

        return $query->fetchAll();
    }

    /**
     * Create a new ticket and insert it into the database
     * @param string $subject
     * @param string $description
     * @param string $priority
     * @param string $category
     * @return bool Returns true if the ticket was created successfully, false otherwise
     */
    public static function createTicket($subject, $description, $priority, $category)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "INSERT INTO support_tickets (subject, description, priority, category, status, created_by, created_at) 
            VALUES (:subject, :description, :priority, :category, :status, :created_by, NOW())";

        $query = $database->prepare($sql);
        $result = $query->execute([
            ':subject' => $subject,
            ':description' => $description,
            ':priority' => $priority,
            ':category' => $category,
            ':status' => 'open', // status is by default set to open, admin will have option to change it
            ':created_by' => Session::get('user_id')
        ]);

        return $result;
    }

    /**
     * Get a single ticket
     * @param int $ticket_id ID of the specific ticket
     * @return object|null A single ticket object (or null if not found)
     */
    public static function getTicket($ticket_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT id, subject, description, priority,  attachment_path,  category, created_by, created_at, status 
            FROM support_tickets
            JOIN users ON support_tickets.created_by = users.user_id
            WHERE support_tickets.id = :ticket_id AND users.user_id = :user_id
            LIMIT 1";


        $query = $database->prepare($sql);
        $query->execute(array(
            ':ticket_id' => $ticket_id,
            ':user_id'   => Session::get('user_id')
        ));

        return $query->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Update an existing ticket
     * @param int $ticket_id ID of the specific ticket
     * @param string $subject New subject of the ticket
     * @param string $description New description of the ticket
     * @param string $priority New priority of the ticket
     * @param string|null $category New category of the ticket (optional)
     * @return bool Feedback (was the update successful?)
     */
    public static function updateTicket($ticket_id, $subject, $description, $priority, $category = null)
    {
        if (!$ticket_id || !$subject || !$description || !$priority) {
            return false;
        }

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE support_tickets 
            SET subject = :subject, 
                description = :description, 
                priority = :priority, 
                category = :category 
            WHERE id = :ticket_id AND created_by = :user_id 
            LIMIT 1";

        $query = $database->prepare($sql);
        $query->execute(array(
            ':ticket_id'   => $ticket_id,
            ':subject'     => $subject,
            ':description' => $description,
            ':priority'    => $priority,
            ':category'    => $category,
            ':user_id'     => Session::get('user_id')
        ));

        return $query->rowCount() === 1;
    }

    /**
     * Delete a specific ticket
     * @param int $ticket_id ID of the ticket
     * @return bool Feedback (was the ticket deleted successfully?)
     */
    public static function deleteTicket($ticket_id)
    {
        if (!$ticket_id) {
            return false;
        }

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "DELETE FROM support_tickets WHERE id = :ticket_id AND created_by = :user_id LIMIT 1";
        $query = $database->prepare($sql);

        $query->execute(array(':ticket_id' => $ticket_id, ':user_id' => Session::get('user_id')));

        if ($query->rowCount() === 1) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_TICKET_DELETION_FAILED'));
        return false;
    }


}

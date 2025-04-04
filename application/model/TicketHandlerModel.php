<?php

/**
 * Handles all data manipulation of the Ticket part
 */
class TicketHandlerModel
{
    /**
     * Get all messages for a specific ticket
     * @param int $ticket_id ID of the ticket
     * @return array an array of message objects
     */
    public static function getAllMessages($ticket_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "
        SELECT 
            m.message_id, 
            m.message_text AS content, 
            m.attachment_path AS attachment, 
            m.sent_at, 
            u.user_name AS sender  
        FROM messages m
        LEFT JOIN users u ON m.sender_id = u.user_id
        WHERE m.ticket_id = :ticket_id
        ORDER BY m.sent_at ASC
    ";

        $query = $database->prepare($sql);
        $query->execute([':ticket_id' => $ticket_id]);

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Save a new message for a ticket
     * @param int $ticket_id ID of the ticket
     * @param int $sender_id ID of the sender (user)
     * @param string $message The message content
     * @param string|null $attachment Path to the attachment (optional)
     * @return bool Whether the message was saved successfully
     */
    public static function saveMessage($ticket_id, $sender_id, $message, $attachment = null)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "INSERT INTO messages (ticket_id, sender_id, message_text, attachment_path, sent_at) 
                VALUES (:ticket_id, :sender_id, :message_text, :attachment_path, NOW())";

        $query = $database->prepare($sql);
        return $query->execute([
            ':ticket_id' => $ticket_id,
            ':sender_id' => $sender_id,
            ':message_text' => $message,
            ':attachment_path' => $attachment
        ]);
    }

    public static function getTicketById($ticket_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM support_tickets WHERE id = :ticket_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute([':ticket_id' => $ticket_id]);

        return $query->fetch();
    }

    public static function updateTicket($ticket_id, $subject, $description, $priority, $status, $category)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE support_tickets SET subject = :subject, description = :description, priority = :priority, status = :status, category = :category WHERE id = :ticket_id";
        $query = $database->prepare($sql);
        $query->execute([
            ':ticket_id' => $ticket_id,
            ':subject' => $subject,
            ':description' => $description,
            ':priority' => $priority,
            ':status' => $status,
            ':category' => $category
        ]);

        return $query->rowCount() > 0;
    }

    public static function closeTicket($ticket_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE support_tickets SET status = :status WHERE id = :ticket_id";
        $query = $database->prepare($sql);
        $query->execute([
            ':ticket_id' => $ticket_id,
            ':status' => 'resolved'
        ]);

        return true;
    }
}
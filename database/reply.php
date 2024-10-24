<?php

declare(strict_types=1);

class Reply
{
    public int $id;
    public int $ticket_id;
    public int $user_id;
    public string $message;

    public function __construct(int $id, int $ticket_id, int $user_id, string $message)
    {
        $this->id = $id;
        $this->ticket_id = $ticket_id;
        $this->user_id = $user_id;
        $this->message = $message;
    }



    public static function createReply(PDO $db, Reply $reply)
{
    try {
        $stmt = $db->prepare('INSERT INTO replies (ticket_id, user_id, message) VALUES (:ticket_id, :user_id, :message)');
        $stmt->bindParam(':ticket_id', $reply->ticket_id);
        $stmt->bindParam(':user_id', $reply->user_id);
        $stmt->bindParam(':message', $reply->message);
        $stmt->execute();
        return $db->lastInsertId();
    } catch (PDOException $e) {
        return -1;
    }
}
    public static function getReplyByTicketId(PDO $db, int $ticketId): Reply
    {
        $stmt = $db->prepare('SELECT * FROM replies WHERE ticket_id = :ticket_id');
        $stmt->bindParam(':ticket_id', $ticketId, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return new Reply(
                $result['id'],
                $result['ticket_id'],
                $result['user_id'],
                $result['message']
            );
        }

        return null;
    }

    // ...
}


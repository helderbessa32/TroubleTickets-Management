<?php 

declare(strict_types=1);
require_once(__DIR__ . '/../database/reply.php');

class Ticket {
    public int $id;
    public string $title;
    public string $description;
    public string $status;
    public string $priority;
    public int $user_id;
    public int $department_id;

    public function __construct(int $id, string $title, string $description, string $status, string $priority, int $user_id, int $department_id) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->status = $status;
        $this->priority = $priority;
        $this->user_id = $user_id;
        $this->department_id = $department_id;
    }


    static function createTicket($db, $title, $description, $status, $priority, $user_id, $department_id) {
        try {
            $stmt = $db->prepare('INSERT INTO tickets (title, description, status, priority, user_id, department_id) VALUES (:title, :description, :status, :priority, :user_id, :department_id)');
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':priority', $priority);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':department_id', $department_id);
            $stmt->execute();
            return $db->lastInsertId();
        } catch (PDOException $e) {
            return -1;
        }
    }
    
    



function updateTicketsPriority($ticketsid, $newpriority) {
    global $dbh;
    try {
        $stmt = $dbh->prepare('UPDATE tickets SET priority = :priority WHERE id = :id');
        $stmt->bindParam(':priority', $newpriority);
        $stmt->bindParam(':id', $ticketsid);
        if($stmt->execute())
            return true;
        else
            return false;

    }catch(PDOException $e) {
        return false;
    }
}

function updateTicketStatus($ticketid, $status) {
    global $dbh;
    try {
        $stmt = $dbh->prepare('UPDATE tickets SET status = :status WHERE id = :id');
        $stmt->bindParam(':id', $ticketid);
        $stmt->bindParam(':status', $status);
        if($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    } catch(PDOException $e) {
        return false;
    }
}

function addTicketInformation($ticketid, $information) {
    global $dbh;
    try {
        $stmt = $dbh->prepare('UPDATE tickets SET additional_info = :info, last_update = datetime(\'now\') WHERE id = :id');
        $stmt->bindParam(':info', $information);
        $stmt->bindParam(':id', $ticketid);
        $stmt->execute();
        return true;
    } catch(PDOException $e) {
        return false;
    }
}


function deleteTickets($ticketsid) {
    global $dbh;
    try{
        $stmt = $dbh->prepare('DELETE FROM tickets WHERE id = ?');
        if($stmt->execute(array($ticketsid)))
            return true;
        else
            return false;

    } catch(PDOException $e) {
        return false;
    }
}

function editTicketstitle($ticketsid, $ticketstitle) {
    global $dbh;
    try {
        $stmt = $dbh->prepare('UPDATE tickets SET title = ? WHERE id = ?');
        if($stmt->execute(array($ticketstitle, $ticketsid)))
            return true;
        else
            return false;

    }catch(PDOException $e) {
        return false;
    }
}


function updateTickets($ticketsid, $newPriority, $newtitle, $newisDone) {
    global $dbh;
    try {
        $stmt = $dbh->prepare('UPDATE tickets SET Priority = :Priority , title = :title, isDone = :isDone, WHERE id = :id');
        $stmt->bindParam(':Priority', $newPriority);
        $stmt->bindParam(':title', $newtitle);
        $stmt->bindParam(':isDone', $newisDone);
        $stmt->bindParam(':id', $ticketsid);
        if($stmt->execute())
            return true;
        else
            return false;

    }catch(PDOException $e) {
        return false;
    }
}

public static function getTickets(PDO $db) : array 
{
        $stmt = $db->prepare('
        SELECT * 
        FROM tickets'
    );
        $stmt->execute();
        
        $tickets = [];
        while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
            $ticket = new Ticket(
                $row->id,
                $row->title,
                $row->description,
                $row->status,
                $row->priority,
                $row->user_id,
                $row->department_id,
                '',
            );
            $tickets[] = $ticket;
        }
        
        
        return $tickets;
}


function getTicketssDone($id, $isDone) {
    global $dbh;
    try{
        $stmt = $dbh->prepare('SELECT id, title, Priority FROM tickets WHERE id = ? AND isDone = ? ORDER BY Priority DESC LIMIT 5');
        $stmt->execute(array($id, $isDone));
        return $stmt->fetchAll();

    } catch(PDOException $e) {
        return null;
    }
}

function ticketsToSolve(){

}
// TO DO 

function getUserTickets($userID, $status) {
    global $dbh;

    try {
        $stmt = $dbh->prepare('SELECT id, title, description, priority, created_date FROM tickets WHERE user_id = ? AND status = ? ORDER BY created_date DESC');
        $stmt->execute(array($userID, $status));
        return $stmt->fetchAll();
    } catch(PDOException $e) {
        return null;
    }
}


function getTicketUsers($ticketID) {
    global $dbh;
    try {

        $stmt = $dbh->prepare('SELECT User.ID, User.name, User.email FROM TicketUser, User WHERE TicketUser.ticket_id = ? AND User.ID = TicketUser.user_id');
        $stmt->execute(array($ticketID));
        return $stmt->fetchAll();
    
    }catch(PDOException $e) {
        return null;
    }
}

public static function getTicketById(PDO $db, $ticketId): ?Ticket
{
    $stmt = $db->prepare('
        SELECT * 
        FROM tickets
        WHERE id = :id'
    );
    $stmt->bindParam(':id', $ticketId);
    $stmt->execute();

    if ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
        $ticket = new Ticket(
            $row->id,
            $row->title,
            $row->description,
            $row->status,
            $row->priority,
            $row->user_id,
            $row->department_id,
            ''
        );
        return $ticket;
    }

    return null; 
}
public static function deleteTicketsByDepartment(PDO $db, int $departmentId): bool
{

    $stmt = $db->prepare('DELETE FROM tickets WHERE department_id = ?');
    $result = $stmt->execute([$departmentId]);

    return $result;
}


public static function deleteTicketById(PDO $db, $ticketId): bool
{
    $stmt = $db->prepare('DELETE FROM tickets WHERE id = :id');
    $stmt->bindParam(':id', $ticketId);
    
    return $stmt->execute();
}


public function save(PDO $db): bool {
    $stmt = $db->prepare('
        UPDATE tickets 
        SET title = ?, description = ?, status = ?, priority = ?, user_id = ?, department_id = ?
        WHERE id = ?
    ');

    return $stmt->execute(array(
        $this->title,
        $this->description,
        $this->status,
        $this->priority,
        $this->user_id,
        $this->department_id,
        $this->id
    ));
}


    public function getReply(): Reply
    {
        // Implemente a lógica para obter o reply associado ao ticket
        // e retorne-o. Se não houver reply associado, retorne null.
        // Por exemplo:
        $db = getDatabaseConnection();
        //var_dump($this->id);
        //var_dump(Reply::getReplyByTicketId($db,$this->id));
        return Reply::getReplyByTicketId($db,$this->id);
    }

    // ...
}

?>

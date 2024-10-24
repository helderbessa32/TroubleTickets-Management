<?php
declare(strict_types=1);

require_once(__DIR__ . '/../utils/session.php');
$session = new Session();

require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/ticket.php');

$db = getDatabaseConnection();
if (isset($_POST['submit'])){
    echo $_POST['title'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $status = isset($_POST['status']) ? $_POST['status'] : 'unsolved';
    $priority = $_POST['priority'];
    $department_id = $_POST['department_id'];
    $ticketId = Ticket::createTicket($db, $title, $description, $status, $priority, 0, $department_id);
        
   header("Location: /../pages/ticket/tickets.php");
}

?>

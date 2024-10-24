<?php

declare(strict_types=1);

require_once(__DIR__ . '/../utils/session.php');
$session = new Session();

require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/ticket.php');

$db = getDatabaseConnection();
$ticketId = intval($_POST['ticketid']);
$ticket = Ticket::getTicketById($db, $ticketId);
$session->setstatus($ticket->status = "solved");

$ticket->save($db);


header('Location: /../pages/ticket/solved.php');
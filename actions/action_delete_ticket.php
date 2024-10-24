<?php

declare(strict_types=1);

require_once(__DIR__ . '/../utils/session.php');
$session = new Session();

require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/ticket.php');

$db = getDatabaseConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar se o ticketid foi enviado no formulário
    if (isset($_POST['ticketid'])) {
        $ticketId = intval($_POST['ticketid']);

        // Excluir o ticket
        $success = Ticket::deleteTicketById($db, $ticketId);

        if ($success) {
            $session->addMessage('success', 'Ticket deleted successfully!');
        } else {
            $session->addMessage('error', 'Failed to delete ticket.');
        }
    } else {
        $session->addMessage('error', 'Invalid request.');
    }
} else {
    $session->addMessage('error', 'Invalid request.');
}

header('Location: /../pages/ticket/tickets.php');

<?php
declare(strict_types=1);

require_once(__DIR__ . '/../utils/session.php');
$session = new Session();

require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/ticket.php');
require_once(__DIR__ . '/../templates/common.tpl.php');
require_once(__DIR__ . '/../templates/departments.tpl.php');
require_once(__DIR__ . '/../database/departments.php');
require_once(__DIR__ . '/../templates/ticket.tpl.php');

$db = getDatabaseConnection();

if (isset($_POST['ticket'])) {
    $ticketId = $_POST['ticket'];
    $ticket = Ticket::getTicketById($db, $ticketId);
    if ($ticket) {
        
        $_SESSION['selected_ticket_id'] = $ticketId;
    } 
}


drawHeader($session);
?>
<?php
drawMainMenu();
?>
<?php
if ($session->isAdmin()) {
    drawSelectedTicket($ticket);
}
else{
    drawSelectedTicketForClient($ticket);
}
?>
<?php
drawFooter();
?>

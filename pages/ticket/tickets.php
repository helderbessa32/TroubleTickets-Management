<?php

declare(strict_types=1);

require_once(__DIR__ . '/../../utils/session.php');
$session = new Session();

require_once(__DIR__ . '/../../templates/common.tpl.php');
require_once(__DIR__ . '/../../templates/departments.tpl.php');
require_once(__DIR__ . '/../../database/connection.php');
require_once(__DIR__ . '/../../database/departments.php');
require_once(__DIR__ . '/../../database/ticket.php');
require_once(__DIR__ . '/../../templates/ticket.tpl.php');


$db = getDatabaseConnection();
$tickets = Ticket::getTickets($db);
//var_dump($tickets);


drawHeader($session);

?>
<?php
drawMainMenu();
?>


<?php
drawAddTicket();
drawTicketsForm($tickets);
?>

<?php
drawFooter();
?>

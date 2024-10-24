<?php

declare(strict_types=1);

require_once(__DIR__ . '/../utils/session.php');
$session = new Session();

require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/ticket.php');
require_once(__DIR__ . '/../database/reply.php');
require_once(__DIR__ . '/../templates/common.tpl.php');
require_once(__DIR__ . '/../templates/departments.tpl.php');
require_once(__DIR__ . '/../database/departments.php');
require_once(__DIR__ . '/../templates/ticket.tpl.php');


$db = getDatabaseConnection();

if (isset($_POST['Submit'])) {
    $ticketId = intval($_POST['ticketid']);
    $message = $_POST['message'];

    
    $reply = new Reply(0, $ticketId, 0, $message);

    
    $replyId = Reply::createReply($db, $reply);
}

drawHeader($session);
?>
<?php
drawMainMenu();
?>
<?php

drawReply($reply);
?>
<?php
drawFooter();
?>


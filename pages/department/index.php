<?php

declare(strict_types=1);

require_once(__DIR__ . '/../../utils/session.php');
$session = new Session();

require_once(__DIR__ . '/../../templates/common.tpl.php');
require_once(__DIR__ . '/../../templates/departments.tpl.php');
require_once(__DIR__ . '/../../database/connection.php');
require_once(__DIR__ . '/../../database/departments.php');


$db = getDatabaseConnection();

drawHeader($session);

drawMainMenu();

if ($session->isAdmin()) {
    drawCreateDepartment();
}

$departments = Department::getDepartments($db);

drawDepartmentsForm($departments, $db);

drawFooter();
?>

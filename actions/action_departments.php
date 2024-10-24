<?php

declare(strict_types=1);

require_once(__DIR__ . '/../utils/session.php');
$session = new Session();

require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/users.php');
require_once(__DIR__ . '/../database/departments.php');
require_once(__DIR__ . '/../templates/common.tpl.php');
require_once(__DIR__ . '/../templates/departments.tpl.php');

$db = getDatabaseConnection();
$departments = Department::getDepartments($db); 

drawHeader($session);


drawMainMenu();

if (isset($_POST['department'])) {
    $departmentId = $_POST['department'];
    $department = Department::getDepartmentById($db, $departmentId);
    if ($department) {
        echo '<div class="department-container">';
        drawDepartmentInfo($department);
        if ($session->isAdmin()) {
            drawEditDepartmentForm($department);
            drawDeleteDepartment($department);
        }
        echo '</div>';
    } else {
        echo "Department not found.";
    }
} else {
    echo "No department selected.";
}



drawFooter();
?>
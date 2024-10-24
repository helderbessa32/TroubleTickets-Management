<?php
declare(strict_types=1);

require_once(__DIR__ . '/../utils/session.php');
$session = new Session();

require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/departments.php');
require_once(__DIR__ . '/../database/ticket.php');

$db = getDatabaseConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['department_id'])) {
        $departmentId = intval($_POST['department_id']);

        if (Department::deleteDepartment($db, $departmentId)) {
            $session->addMessage('success', 'Department and associated tickets deleted successfully.');
        } else {
            $session->addMessage('error', 'Failed to delete department and associated tickets.');
        }

        header("Location: /pages/department/index.php");
        exit;
    }
}

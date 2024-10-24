<?php

declare(strict_types=1);

require_once(__DIR__ . '/../utils/session.php');
$session = new Session();

require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/departments.php');

$db = getDatabaseConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['name_dept'])) {
        $nameDept = $_POST['name_dept'];

        if (Department::createDepartment($db, $nameDept)) {
            $session->addMessage('success', 'Department created successfully.');
        } else {
            $session->addMessage('error', 'Failed to create department.');
        }

        header("Location: /pages/department/index.php");
        exit;
    }
}

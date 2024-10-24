<?php
declare(strict_types=1);

require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/departments.php');

$db = getDatabaseConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    if (isset($_POST['department_id']) && isset($_POST['department_name'])) {
        $departmentId = (int) $_POST['department_id'];
        $newName = $_POST['department_name'];


        $success = Department::updateDepartmentName($db, $departmentId, $newName);

        if ($success) {

            header("Location: /pages/department/index.php");
            exit;
        } else {
            
            echo "Failed to update department name.";
        }
    }
} else {
    echo "Invalid request.";
}
?>

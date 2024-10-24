<?php
declare(strict_types=1);

require_once(__DIR__ . '/../utils/session.php');
$session = new Session();

require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/users.php');

$db = getDatabaseConnection();

if (User::duplicateUsername($db, $_POST['username'])) {
    $_SESSION['ERROR'] = 'Duplicated Username';
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
} elseif (User::duplicateEmail($db, $_POST['email'])) {
    $_SESSION['ERROR'] = 'Duplicated Email';
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
} else {
    $userId = User::createUser($db, $_POST['name'], $_POST['email'], $_POST['username'], $_POST['pass']);
    if ($userId !== -1) {
        header("Location: /../pages/static/login.php");
        echo 'User registered successfully';
        exit;
    } else {
        $_SESSION['ERROR'] = 'ERROR';
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }
}
?>

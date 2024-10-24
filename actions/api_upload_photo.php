<?php
declare(strict_types=1);

require_once(__DIR__ . '/../utils/session.php');

$session = new Session();

require_once(__DIR__ . '/../database/connection.php');
require_once("../database/users.php");

$db = getDatabaseConnection();
$user = User::getUserId($db, $session->getId());

$target_dir = "../profilePictures/";
$originalName = basename($_FILES["fileToUpload"]["name"]);
$imageFileType = pathinfo($originalName, PATHINFO_EXTENSION);
$target_file = $target_dir . $session->getId() . "." . $imageFileType;
$uploadOk = 1;

// Allow certain file formats
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
    $_SESSION['ERROR'] = "ERROR: Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Override previous picture
if (file_exists($target_file)) {
    unlink($target_file);
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $_SESSION['ERROR'] = "Error uploading photo";
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $user = User::getUserId($db, $session->getId()); // Certifique-se de ter a variável $db configurada corretamente
        if ($user instanceof User && $user->updateUserPhoto($session->getId(), $session->getId() . "." . $imageFileType, $db)) {
            // A foto do perfil foi atualizada com sucesso
        } else {
            $_SESSION['ERROR'] = "Error uploading photo";
        }
    } else {
        $_SESSION['ERROR'] = "Error uploading photo";
    }
}

header("Location: " . $_SERVER['HTTP_REFERER']);
?>

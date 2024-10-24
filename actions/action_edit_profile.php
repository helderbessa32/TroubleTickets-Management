<?php

declare(strict_types=1);

require_once(__DIR__ . '/../utils/session.php');
$session = new Session();

require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/users.php');

$db = getDatabaseConnection();
$user = User::getUserId($db, $session->getid());

echo $_POST['name'];
$session->setname($user->name = $_POST['name']);
$session->setusername($user->username = $_POST['username']);
$session->setemail($user->email = $_POST['email']);

$user->save($db);


header('Location: /../pages/index.php');

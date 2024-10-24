<?php

declare(strict_types=1);

require_once(__DIR__ . '/../utils/session.php');
$session = new Session();

require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/users.php');

$db = getDatabaseConnection();

/* DEBUG
 * echo $_POST['email'];
 * echo $_POST['pass'];
*/

$users = user::isLoginCorrect($db, $_POST['email'], $_POST['pass']);
echo $_POST['name'];

if ($users) {
  $session->setid($users->id);
  if ($users->roles === 'admin') {
    $_SESSION['roles'] = 'admin'; // Define a função como 'admin'
  }

  /* debug
   * echo ("e2ntrei aqui");
   * $session->setname($user->name);
   * $session->setemail($user->email);
  */
  $session->addMessage('success', 'Login Accepted!');

} else $session->addMessage('error', 'Login Rejected!');

header('Location: /../pages/ticket/tickets.php');
?>
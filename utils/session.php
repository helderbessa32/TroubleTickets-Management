<?php
class session
{

  function setCurrentUser($id, $name)
  {
    $_SESSION['name'] = $name;
    $_SESSION['id'] = $id;
  }

  function getid()
  {
    if (isset($_SESSION['id'])) {
      return $_SESSION['id'];
    } else {
      return null;
    }
  }

  function getname()
  {
    if (isset($_SESSION['name'])) {
      return $_SESSION['name'];
    } else {
      return null;
    }
  }

  function getroles()
  {
    if (isset($_SESSION['roles'])) {
      return $_SESSION['roles'];
    } else {
      return null;
    }
  }
  function setemail(string $email)
  {
    $_SESSION['email'] = $email;
  }

  function setname(string $name)
  {
    $_SESSION['name'] = $name;
  }

  function setstatus(string $status)
  {
    $_SESSION['status'] = $status;
  }

  function setusername(string $username)
  {
    $_SESSION['username'] = $username;
  }

  function setroles(string $roles)
  {
    $_SESSION['roles'] = $roles;
  }


  function setid(int $id)
  {
    $_SESSION['id'] = $id;
  }

  public function isloggedin(): bool
  {
    return isset($_SESSION['id']);
  }

  public function isAdmin(): bool
  {
  return isset($_SESSION['roles']) && $_SESSION['roles'] === 'admin';
}



  private array $messages;

  public function __construct()
  {
    session_start();

    $this->messages = $this->retrieveAndClearMessages();
  }

  private function retrieveAndClearMessages()
  {
    if (isset($_SESSION['messages'])) {
      $messages = $_SESSION['messages'];
      unset($_SESSION['messages']);
      return $messages;
    }
    return array();
  }
  public function addMessage(string $type, string $text)
  {
    $_SESSION['messages'][] = array('type' => $type, 'text' => $text);
  }

  public function getMessages()
  {
    return $this->messages;
  }

  public function logout(){
    session_destroy();
  }

  public function deleteTicket(){
    
  }
}

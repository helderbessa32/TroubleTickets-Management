<?php

declare(strict_types=1);

class User
{
    public int $id;
    public string $name;
    public string $email;
    public string $username;
    public string $pass;
    public string $roles;


    public function __construct(int $id, string $name, string $email, string $username, string $pass, string $roles)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->username = $username;
        $this->pass = $pass;
        $this->roles = $roles;

    }

    public static function isLoginCorrect(PDO $db, string $email, string $pass): ?User
    {
        $stmt = $db->prepare('SELECT id, name, email, username, pass, roles FROM users WHERE email = ?');
        $stmt->execute([$email]);

        if ($user = $stmt->fetch()) {
            if (password_verify($pass, $user['pass'])) {
                return new User(
                    $user['id'],
                    $user['name'],
                    $user['email'],
                    $user['username'],
                    $user['pass'],
                    $user['roles']
                );
            }
        }

        return null;
    }

    

    public static function duplicateUsername(PDO $db, string $username): ?User
    {
        try {
            $stmt = $db->prepare('SELECT id FROM users WHERE username = ?');
            $stmt->execute([$username]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result !== false) {
                return self::getUser($db, $result['id']);
            } else {
                return null;
            }
        } catch (PDOException $e) {
            return null;
        }
    }

    public static function duplicateEmail(PDO $db, string $email): bool
    {
        try {
            $stmt = $db->prepare('SELECT id FROM users WHERE email = ?');
            $stmt->execute([$email]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result !== false;
        } catch (PDOException $e) {
            return true;
        }
    }

    public static function createUser(PDO $db, string $name, string $email, string $username, string $pass)
    {
        try {
            $passwordHashed = password_hash($pass, PASSWORD_DEFAULT);

            $stmt = $db->prepare('INSERT INTO users (name, email, username, pass) VALUES (:name, :email, :username, :pass)');
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':pass', $passwordHashed);

            if ($stmt->execute()) {
                return self::getId($db, $username);
            } else {
                return -1;
            }
        } catch (PDOException $e) {
            return -1;
        }
    }

    public static function getUser(PDO $db, string $username)
    {
        try {
            $stmt = $db->prepare('SELECT name, username, email FROM users WHERE username = ?');
            $stmt->execute([$username]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            return null;
        }
    }

    public static function getId(PDO $db, string $username)
    {
        try {
            $stmt = $db->prepare('SELECT id FROM users WHERE username = ?');
            $stmt->execute([$username]);
            if ($row = $stmt->fetch()) {
                return $row['id'];
            }
        } catch (PDOException $e) {
            return -1;
        }
    }

    public static function getUserId(PDO $db, int $id): User
    {
        $stmt = $db->prepare('
            SELECT id, name, email, username, pass, roles
            FROM users 
            WHERE id = ?
        ');

        $stmt->execute(array($id));
        $user = $stmt->fetch();

        return new User(
            $user['id'],
            $user['name'],
            $user['email'],
            $user['username'],
            $user['pass'],
            $user['roles']
        );
    }

    public function save(PDO $db): bool {
      $stmt = $db->prepare('
          UPDATE users 
          SET name = ?, email = ?, username = ?, pass = ?, roles = ? 
          WHERE id = ?
      ');

      return $stmt->execute(array(
          $this->name,
          $this->email,
          $this->username,
          $this->pass,
          $this->roles,
          $this->id
      ));
    }

    function updateUserPhoto(int $userID, string $photoPath, PDO $db): bool
    {
        try {
            $stmt = $db->prepare('UPDATE users SET photo = ? WHERE id = ?');
            return $stmt->execute([$photoPath, $userID]);
        } catch (PDOException $e) {
            return false;
        }
    }
    

    function getUserPhoto(PDO $db, int $userID)
    {
        try {
            $stmt = $db->prepare('SELECT photo FROM users WHERE id = ?');
            $stmt->execute([$userID]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            return null;
        }
    }
   


}
?>
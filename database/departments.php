<?php

declare(strict_types=1);

class Department
{
    public int $id;
    public string $name_dept;

    public function __construct(int $id, string $name_dept)
    {
        $this->id = $id;
        $this->name_dept = $name_dept;
    }

    public static function getDepartments(PDO $db): array
    {
        $stmt = $db->prepare('SELECT * FROM departments');
        $stmt->execute();
        $departments = $stmt->fetchAll();

        $result = [];
        foreach ($departments as $department) {
            $result[] = new Department(
                $department['id'],
                $department['name_dept']
            );
        }

        return $result;
    }


    public static function getDepartmentById(PDO $db, $departmentId): ?Department
{
    $stmt = $db->prepare('
        SELECT * 
        FROM departments
        WHERE id = :id'
    );
    $stmt->bindParam(':id', $departmentId);
    $stmt->execute();

    if ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
        $department = new Department(
            $row->id,
            $row->name_dept,
            ''
        );
        return $department;
    }

    return null;
}



    public static function getUserDepartments(PDO $db, int $id): array
    {
        $stmt = $db->prepare('SELECT * FROM user_dept WHERE user_id = ?');
        $stmt->execute([$id]);
        $departments = $stmt->fetchAll();

        return $departments;
    }

    public static function getDepartmentUsers(PDO $db, int $id): array
    {
        $stmt = $db->prepare('SELECT * FROM users JOIN user_dept ON user_dept.userid = users.id WHERE user_dept.departmentid = ?');
        $stmt->execute([$id]);
        $users = $stmt->fetchAll();

        return $users;
    }

    public static function getDepartmentTickets(PDO $db, int $id): array
    {
        $stmt = $db->prepare('SELECT * FROM tickets WHERE departmentid = ?');
        $stmt->execute([$id]);
        $tickets = $stmt->fetchAll();

        return $tickets;
    }
    
    public function getTickets()
    {
        $db = getDatabaseConnection(); // Obtenha a conexão PDO aqui ou passe-a como um parâmetro para a classe Department

        $stmt = $db->prepare('SELECT * FROM tickets WHERE department_id = ?');
        $stmt->execute([$this->id]);
        $tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $ticketObjects = [];
        foreach ($tickets as $ticket) {
            $ticketObjects[] = new Ticket(
                $ticket['id'],
                $ticket['title'],
                $ticket['description'],
                $ticket['status'],
                $ticket['priority'],
                $ticket['user_id'],
                $ticket['department_id'],
                ''
            );
        }

        return $ticketObjects;
    }
    public static function updateDepartmentName(PDO $db, int $departmentId, string $newName): bool
    {
        $stmt = $db->prepare('UPDATE departments SET name_dept = :newName WHERE id = :departmentId');
        $stmt->bindValue(':newName', $newName, PDO::PARAM_STR);
        $stmt->bindValue(':departmentId', $departmentId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public static function deleteDepartment(PDO $db, int $departmentId): bool
    {
        $stmt = $db->prepare('DELETE FROM departments WHERE id = ?');
        $stmt->execute([$departmentId]);

        if ($stmt->rowCount() > 0) {
            
            Ticket::deleteTicketsByDepartment($db, $departmentId);
            return true;
        }

        return false;
    }

    public static function createDepartment(PDO $db, string $nameDept): bool
    {
        $stmt = $db->prepare('INSERT INTO departments (name_dept) VALUES (?)');
        return $stmt->execute([$nameDept]);
    }




}
?>

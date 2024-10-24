<?php 
    declare(strict_types = 1); 

    require_once(__DIR__ . '/../database/departments.php');
    require_once(__DIR__ . '/../database/ticket.php');
?>

<?php function drawDepartmentsForm(array $departments, PDO $pdo) { ?>

    <form action="/../actions/action_departments.php" method="post" class="departments_form">
    <h1>Select Department</h1>
    <?php foreach ($departments as $department) { ?>
        <div class="department">
            <input type="radio" id="department_<?= $department->id ?>" name="department" value="<?= $department->id ?>">
            <label for="department_<?= $department->id ?>" class="department-title"><?= $department->name_dept ?></label>
            <!-- Exibir aqui os tickets associados ao departamento -->
            <ul>
                <?php
                $departmentId = $department->id;
                $stmt = $pdo->prepare("SELECT title FROM tickets WHERE department_id = :departmentId");
                $stmt->bindValue(':departmentId', $departmentId, PDO::PARAM_INT);
                $stmt->execute();
                $tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($tickets as $ticket) {
                    ?><p></p>
                    <li><?= $ticket['title'] ?></li>
                <?php } ?>
            </ul>
        </div>
    <?php } ?>
    <input name="Submit" class="w3-input w3-border" type="submit" value="Select">
</form>
<?php } ?>


<?php function drawDepartmentsFormClient(array $departments, PDO $pdo) { ?>

<form action="/../actions/action_departments.php" method="post" class="departments_form">
    <h1>Departments</h1>
    <?php foreach ($departments as $department) { ?>
        <div class="department">
            <label type="radio" id="department_<?= $department->id ?>" name="department" value="<?= $department->name_dept ?>"></label>
            <label for="department_<?= $department->id ?>" class="department-title"><?= $department->name_dept ?></label>
            <!-- Exibir aqui os tickets associados ao departamento -->
            <ul>
                <?php
                $departmentId = $department->id;
                $stmt = $pdo->prepare("SELECT title FROM tickets WHERE department_id = :departmentId");
                $stmt->bindValue(':departmentId', $departmentId, PDO::PARAM_INT);
                $stmt->execute();
                $tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($tickets as $ticket) {
                    ?><p></p>
                    <li><?= $ticket['title'] ?></li>
                <?php } ?>
            </ul>
        </div>
    <?php } ?>
</form>

<?php } ?>

<?php
function drawSelectedDepartment(Department $department)
{
?>
    <div class="department">
        <h1><?= $department->name_dept ?></h1>
        <!-- Exiba outras informações relevantes do departamento -->
    </div>
<?php
}


function drawDepartmentInfo(Department $department)
{
    ?>
    <div class="department-info">
        <h1><?= $department->name_dept ?></h1>

        <h2>Tickets:</h2>
        <div class="accordion">
            <?php
            $tickets = $department->getTickets();
            foreach ($tickets as $ticket) {
                ?>
                <div class="accordion-item">
                    <div class="accordion-header">
                        <button class="accordion-button" type="button">
                            <?= $ticket->title ?>
                        </button>
                    </div>
                    <div class="accordion-content">
                        <p>Description: <?= $ticket->description ?></p>
                        <p>Status: <?= $ticket->status ?></p>
                        <p>Priority: <?= $ticket->priority ?></p>
                        
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <?php
}

function drawEditDepartmentForm(Department $department)
{
?>
    <form id="edit_department_form" action="/actions/action_edit_department.php" method="post">
        <input type="hidden" name="department_id" value="<?= $department->id ?>">
        <label for="department_name">Department Name:</label>
        <input type="text" name="department_name" id="department_name" value="<?= $department->name_dept ?>">
        <input type="submit" value="Edit">
    </form>
<?php
}

function drawDeleteDepartment(Department $department)
{
?>
    <form action="/actions/action_delete_department.php" method="post" class="delete-department-form">
        <input type="hidden" name="department_id" value="<?= $department->id ?>">
        <p>Deleting this department will also delete the associated tickets.</p>
        <p>Are you sure you want to delete the department "<strong><?= $department->name_dept ?></strong>"?</p>
        <input type="submit" value="Delete">
    </form>
<?php
}
function drawCreateDepartment()
{
    ?>
    <div id="create-department" class="create-department">
        <h2>Create New Department</h2>
        <form action="/actions/action_create_department.php" method="post">
            <label for="name_dept">Department Name:</label>
            <input type="text" id="name_dept" name="name_dept" required>
            <input type="submit" value="Create">
        </form>
    </div>
    <?php
}








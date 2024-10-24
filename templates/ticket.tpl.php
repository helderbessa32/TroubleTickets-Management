<?php

declare(strict_types=1);

require_once(__DIR__ . '/../utils/session.php');
?>

<?php
function drawAddTicket()
{
?>
    <form action="/../pages/ticket/add_ticket.php" class="add-ticket-form">
        <button type="submit">Add Ticket</button>
    </form>
<?php
}


function drawAddTicketForm(array $departments)
{
?>
    <div id="add_ticket_container">
        <h1>Add Ticket</h1>
        <form action="../../actions/action_add_ticket.php" method="post" class="add_ticket_form">
            <input name="title" class="w3-input w3-border" type="text" placeholder="Title" required="required">
            <textarea name="description" class="w3-input w3-border" placeholder="Description" required="required"></textarea>
            <select name="priority" class="w3-select w3-border" required="required">
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">High</option>
            </select>

            <select name="department_id" class="w3-select w3-border" required="required">
                <?php foreach ($departments as $department) { ?>
                    <option value="<?= $department->id ?>"> <?= $department-> name_dept ?></option>
                <?php } ?>
            </select>
            <button type="submit" name="submit" class="w3-input w3-border" value="submit"> Submit </button>
        </form>
    </div>
<?php
}
?>

<?php
function drawTicketsForm(array $tickets)
{
?>
    <form action="/../actions/action_tickets.php" method="post" class="tickets_form">
        <h1>Select Ticket</h1>
        <?php foreach ($tickets as $ticket) { ?>
            <div class="ticket-show">
                <input type="radio" id="ticket_<?= $ticket->id ?>" name="ticket" value="<?= $ticket->id ?>">
                <label for="ticket_<?= $ticket->id ?>"> <?= $ticket->title ?></label>
                <p>Description: <?= $ticket->description ?></p>
                <p>Status: <?= $ticket->status ?></p>
                <p>Priority: <?= $ticket->priority ?></p>
                <p>Department ID: <?= $ticket->department_id ?></p>
            </div>
        <?php } ?>
        <input name="Submit" class="w3-input w3-border" type="submit" value="Select">
    </form>
<?php
}
?>

<?php
function drawTicketsFormByStatus(array $tickets, string $status)
{
?>
    <form action="/../actions/action_tickets.php" method="post" class="tickets_form">
        <h1>Select Ticket</h1>
        <?php foreach ($tickets as $ticket) {
            if ($ticket->status === $status) { ?>
                <div class="ticket">
                    <input type="radio" id="ticket_<?= $ticket->id ?>" name="ticket" value="<?= $ticket->id ?>">
                    <label for="ticket_<?= $ticket->id ?>"> <?= $ticket->title ?></label>
                    <p>Description: <?= $ticket->description ?></p>
                    <p>Status: <?= $ticket->status ?></p>
                    <p>Priority: <?= $ticket->priority ?></p>
                    <p>Department ID: <?= $ticket->department_id ?></p>
                </div>
        <?php }
        } ?>
        <input name="Submit" class="w3-input w3-border" type="submit" value="Select">
    </form>
<?php
}
?>  

<?php
function drawSelectedTicket(Ticket $ticket)
{
?>
    <form action="/../actions/action_solved_ticket.php" method="post" class="tickets_form">
    <div class="ticket">
        <h1><?= $ticket->title ?></h1>
        <input type="hidden" name="ticketid" value="<?= $ticket->id ?>">
        <p>Description: <?= $ticket->description ?></p>
        <p>Status: <?= $ticket->status ?></p>
        <p>Priority: <?= $ticket->priority ?></p>
        <p>Department ID: <?= $ticket->department_id ?></p>        
        <input name="Submit" class="w3-input w3-border" type="submit" value="Solved">
    </form>
    <form action="/../actions/action_delete_ticket.php" method="post">
        <input type="hidden" name="ticketid" value="<?= $ticket->id ?>">
        <input name="Submit" class="w3-input w3-border" type="submit" value="Delete">
    </form>
    <form action="/../actions/action_add_reply.php" method="post">
        <input type="hidden" name="ticketid" value="<?= $ticket->id ?>">
        <textarea name="message" class="w3-input w3-border" placeholder="Enter your reply"></textarea>
        <input name="Submit" class="w3-input w3-border" type="submit" value="Reply">
    </form>
    <?php drawReplyMessage($ticket->getReply());?>

    </div>
    
    <?php
}
?>

<?php
function drawSelectedTicketForClient(Ticket $ticket)
{
?>
    <div class="ticket">
        <h1><?= $ticket->title ?></h1>
        <input type="hidden" name="ticketid" value="<?= $ticket->id ?>">
        <p>Description: <?= $ticket->description ?></p>
        <p>Status: <?= $ticket->status ?></p>
        <p>Priority: <?= $ticket->priority ?></p>
        <p>Department ID: <?= $ticket->department_id ?></p>
        <form action="/../actions/action_add_reply.php" method="post">
            <input type="hidden" name="ticketid" value="<?= $ticket->id ?>">
            <textarea name="message" class="w3-input w3-border" placeholder="Enter your reply"></textarea>
            <input name="Submit" class="w3-input w3-border" type="submit" value="Reply">
        </form>
        <?php drawReplyMessage($ticket->getReply());?>
    </div>
    
    <?php
}
?>

<?php
function drawReply(Reply $reply)
{
    ?>
    <div class="reply">
        <p>Reply ID: <?= $reply->id ?></p>
        <p>Ticket ID: <?= $reply->ticket_id ?></p>
        <p>User ID: <?= $reply->user_id ?></p>
        <p>Message: <?= $reply->message ?></p>
    </div>
    <?php
}

?>


<?php
function drawReplyMessage(Reply $reply)
{
    echo "<p>Reply: " . $reply->message . "</p>";
}
?>


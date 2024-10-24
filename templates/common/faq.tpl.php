<?php

declare(strict_types=1);

require_once(__DIR__ . '/../../utils/session.php');

function drawFAQs(array $faqs)
{
    foreach ($faqs as $faq) {
        ?>
        <button class="accordion"><?= $faq['question'] ?></button>
        <div class="panel">
            <p><?= $faq['answer'] ?></p>
        </div>
        <?php
    }
}

function addFAQ(PDO $db, string $question, string $answer): bool
{
    $stmt = $db->prepare('INSERT INTO faq (question, answer) VALUES (?, ?)');
    return $stmt->execute([$question, $answer]);
}

function deleteFAQ(PDO $db, int $faqId): bool
{
    $stmt = $db->prepare('DELETE FROM faq WHERE id = ?');
    return $stmt->execute([$faqId]);
}

function editFAQ(PDO $db, int $faqId, string $question, string $answer): bool
{
    $stmt = $db->prepare('UPDATE faq SET question = ?, answer = ? WHERE id = ?');
    return $stmt->execute([$question, $answer, $faqId]);
}
<?php
declare(strict_types=1);

require_once(__DIR__ . '/utils/session.php');
$session = new Session();

// Verificar se o usuário está logado
if ($session->isLoggedIn()) {
    // Redirecionar para a página de tickets
    header('Location: pages/ticket/tickets.php');
    exit;
}

// Redirecionar para a página de login
header('Location: pages/static/login.php');
exit;
?>
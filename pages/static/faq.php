<?php

declare(strict_types=1);

require_once(__DIR__ . '/../../utils/session.php');
$session = new Session();

require_once(__DIR__ . '/../../database/connection.php');
require_once(__DIR__ . '/../../database/faqs.php');

require_once(__DIR__ . '/../../templates/common.tpl.php');
require_once(__DIR__ . '/../../templates/common/faq.tpl.php');

$db = getDatabaseConnection();

drawHeader($session);

drawMainMenu();

$faqs = FAQ::getFAQs($db);

echo '<section id="feed">';
echo '<h3 class="page-title">Faqs</h3>';
echo "<p>Welcome to Trouble Tickets FAQs page! Here, we have compiled a list of frequently asked questions to help you better understand our ticket management website and how it works. Whether you're new to our platform or a longtime user, we hope that this page will provide you with the information you need to make the most of our services. So, let's dive in and explore the most common questions and answers about our website.</p>";

drawFAQs($faqs);

echo '</section>';

drawFooter();

?>

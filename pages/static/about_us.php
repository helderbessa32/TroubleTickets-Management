<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../../utils/session.php');
    $session = new Session();

    require_once(__DIR__ . '/../../templates/common.tpl.php');

    drawHeader($session);

    drawMainMenu();

?>
<section id="feed-about">
    <h3 class="page-title">About Us</h3>
    <p>Welcome to Trouble Tickets! We are a team of dedicated professionals committed to providing exceptional support for college-related issues through our ticketing system. Our platform is specially designed to help you manage and resolve issues in an efficient and organized manner.</p>
    <p>We understand that dealing with academic issues can be challenging, which is why we strive to provide the highest level of support to our customers. Our team is made up of experienced educational experts, ready to help you resolve your academic difficulties quickly and effectively.</p>
    <p>With the Trouble Tickets platform, you will have access to advanced features such as a ticket tracking system, automated responses, and customizable workflows. This will ensure that all your issues are logged and handled properly, allowing you to track the status of each request and have full visibility into the progress of solutions.</p>
    <p>We are committed to providing an exceptional student experience and helping to ensure that your academic journey is as smooth as possible. We are here to support you at every stage, from enrollment issues, learning difficulties, payment issues, and any other college-related concern.</p>
    <p>At Trouble Tickets, we believe that every student deserves quality support and we are committed to providing just that. Thank you for choosing our platform and we look forward to working with you to solve all your academic problems through our ticketing system.</p>
</section>
<?php

    drawFooter();
?>
<?php

declare(strict_types=1);

require_once(__DIR__ . '/../utils/session.php');

function drawHeader(Session $session)
{
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="/css/style.css" rel="stylesheet">
        <link rel="icon" type="image/ico" href="/../assets/favicon.ico" sizes="96x96"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-/1xMteP9ISgIaRIa8EpTJGJK+TIyjU7o3M10XMxLe56Hhzmht4v3H7KfWhtSvn6oMVX7ySsO+3N0t3/jKO6j3A==" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" integrity="sha512-9n6TkvR3Vzl+ufTWHh0LMeZ3oSCDbC5Fe4A9+1rD+Hf5yAs+QSFplTdfhyr/sR6VczomK67VTkffT0He6H+F7w==" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/8a7fec6160.js" crossorigin="anonymous"></script>
        <title>Trouble Tickets</title>
    </head>

    <body>

        <header>
            
            <img src="/../assets/logotipo_branco.png" alt="logo feup" id="logo-feup">
            <img src="/../assets/Ticket_Logo.png" alt="logo" id="logo"> 
            <div id="project-title">
                <h1>
                    <a href="<?php echo $session->isLoggedIn() ? '/index.php' : '/../pages/static/login.php'; ?>">
                        Trouble Tickets
                    </a>
                </h1>
                <h2>
                    <a href="<?php echo $session->isLoggedIn() ? '/index.php' : '/../pages/static/login.php'; ?>">
                        KEEP CALM. WE ARE HERE!!!
                    </a>
                </h2>
            </div>
            <div id="login" <?php if (!$session->isLoggedIn()) echo 'class="logged-out"'; ?>>
                <?php
                if ($session->isLoggedIn()) {
                    drawLogoutForm($session);
                } else {
                    echo '<a href="/../pages/static/login.php" id="login-link">Login</a>';
                }
                ?>
            </div>
        </header>
        <main>
<?php
}

function drawFooter()
{
?>
        </main>
        <footer id="site-footer">
            <p>&copy; FEUP | Developed by Diogo Gomes, Diogo Geraldes, Hélder Bessa</p>
        </footer>
        <script src="/js/app.js"></script>
    </body>
    </html>
<?php
}


function drawLoginForm()
{
?>
    <form action="/../actions/action_login.php" method="post" class="login_form">
        <div id="register_container">
            <div class="register_header">
                <a href="../static/signup.php" class="register_button">Sign Up</a>
                <h1>Trouble Tickets</h1>
                <p>Here to help you.</p>
            </div>
            <div class="register_content">
                <h1>Login</h1>
                <input id="email" name="email" class="w3-input w3-border" type="email" placeholder="Email" required="required">
                <input id="pass" name="pass" class="w3-input w3-border" type="password" placeholder="Password" required="required">
                <input name="Submit" class="w3-input w3-border" type="submit" value="Next">
                <p id="error_messages" style="color: black">
                    <?php if (isset($_SESSION['ERROR'])) echo htmlentities($_SESSION['ERROR']);
                    unset($_SESSION['ERROR']); ?>
                </p>
            </div>
        </div>
    </form>
<?php
}

function drawLogoutForm(Session $session)
{
?>
    <form action="/../actions/action_logout.php" method="post" class="logout" id="logout-form">
        <?php
        echo '<a href="/../pages/index.php?id=' . $session->getId() . '">' . $session->getName() . '</a>';
        ?>
        <button type="button" id="logout-button">Logout</button>
    </form>
    <div id="logout-popup" class="popup"></div>
<?php
}


function drawRegisterForm(Session $session)
{
?>
    <div id="register_container">
        <div class="register_header">
            <a href="login.php" class="register_button">Login</a>
            <p>Welcome.<br>Thanks for joining us.</p>
        </div>
        <div class="register_content signup">
            <h1>Sign Up</h1>
            <form action="../../actions/action_sign_up.php" method="post" class="register_form">
                <input name="name" class="w3-input w3-border" type="text" placeholder="Name" required="required">
                <input name="username" class="w3-input w3-border" type="text" placeholder="Username" required="required">
                <span class="hint">Only lowercase and numbers, at least 6 characters.</span>
                <input name="email" class="w3-input w3-border" type="email" placeholder="Email" required="required">
                <input name="pass" class="w3-input w3-border" type="password" placeholder="Password">
                <span class="hint">One uppercase, 1 symbol, 1 number, at least 6 characters.</span>
                <input name="passwordagain" class="w3-input w3-border" type="password" placeholder="Repeat Password">
                <span class="hint">Must match new password.</span>
                <input name="Submit" class="w3-input w3-border" type="submit" value="Submit">
            </form>
        </div>
    </div>
<?php
}

function drawMainMenu()
{
?>
    <nav>
        <ul>
            <li>
                <a id="department-item"     href= "/../pages/department/index.php">
                    <i class="fas fa-building"></i>
                    <span>Departments</span>
                </a>
            </li>
            <li>    
                <a id="tickets-item"            href="/../pages/ticket/tickets.php">
                    <i class="fas fa-ticket-alt"></i>
                    <span>Tickets</span>
                </a>
            </li>
            <li>
                <a id="solved-tickets-item"     href="/../pages/ticket/solved.php">
                    <i class="fas fa-check-circle"></i>
                    <span>Solved Tickets</span>
                </a>
            </li>
            <li>
                <a id="unsolved-tickets-item"   href="/../pages/ticket/unsolved.php">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>Unsolved Tickets</span>
                </a>
            </li>
            <li>
                <a id="account-item"            href="/../pages/user/edit.php">
                    <i class="fas fa-user"></i>
                    <span>My Account</span>
                </a>
            </li>
            <li>
                <a id="account-item"            href="/../pages/static/about_us.php">
                    <i class="fas fa-info-circle"></i>
                    <span>About us</span>
                </a>
            </li>
            <li>
                <a id="faq-item"                href="/../pages/static/faq.php">
                    <i class="fas fa-question-circle"></i>
                    <span>FAQ</span>
                </a>
            </li>
        </ul>
    </nav>
<?php
}

function drawEditForm($user)
{
?>
    <form action="/../actions/action_edit_profile.php" method="post" class="edit_form">
        <h1>Edit Settings</h1>
        <input name="name" class="w3-input w3-border" type="text" placeholder="Name" required="required">
        <input name="username" class="w3-input w3-border" type="text" placeholder="Username" required="required">
        <span class="hint">Only lowercase and numbers, at least 6 characters.</span>
        <input name="email" class="w3-input w3-border" type="email" placeholder="Email" required="required">
        <input name="pass" class="w3-input w3-border" type="password" placeholder="New Password">
        <span class="hint">One uppercase, 1 symbol, 1 number, at least 6 characters.</span>
        <input name="passwordagain" class="w3-input w3-border" type="password" placeholder="Repeat New Password">
        <span class="hint">Must match new password.</span>
        <input name="Submit" class="w3-input w3-border" type="submit" value="Save Changes">

        <div class="current-info">
            <h2>Current Information</h2>
            <p><strong>Name:</strong> <?php echo $user->name; ?></p>
            <p><strong>Username:</strong> <?php echo $user->username; ?></p>
            <p><strong>Email:</strong> <?php echo $user->email; ?></p>
        </div>
    </form>
<?php
}
?>

<?php
function renderUploadForm($photoPath) {
    echo '<form action="../actions/api_upload_photo.php" method="post" enctype="multipart/form-data">';
    echo '<label for="fileToUpload">Choose a Photo</label>';
    echo '<input type="file" name="fileToUpload" id="fileToUpload">';
    echo '<input type="submit" name="Submit" value="Upload">';
    echo '</form>';
}
?>

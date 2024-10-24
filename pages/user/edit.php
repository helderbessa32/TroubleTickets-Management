<?php

declare(strict_types=1);

require_once(__DIR__ . '/../../utils/session.php');
$session = new Session();

require_once(__DIR__ . '/../../templates/common.tpl.php');
require_once(__DIR__ . '/../../database/connection.php');
require_once(__DIR__ . '/../../database/users.php');


$db = getDatabaseConnection();
$user = User::getUserId($db, $session->getid());

drawHeader($session);

drawMainMenu();
?>
<div id="user-photo-container">
  <?php
  $photo = $user->getUserPhoto($db, $session->getId());
  if ($photo !== null) {
    $photoPath = "../../profilePictures/" . $photo['photo'];
  } else {
    $photoPath = "../../aprofilePictures/default.jpg";
  }
  ?>
</div>




<div id="photo-upload-container">
    <img src="<?php echo $photoPath; ?>" alt="User Photo" id="user-photo">

    <form action="../../actions/api_upload_photo.php" method="post" enctype="multipart/form-data">
        <label for="fileToUpload">Photo</label>
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" name="submit" value="Upload">
    </form>
</div>

<?php

drawEditForm($user);

drawFooter();

?>

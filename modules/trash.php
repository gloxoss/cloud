<?php
include_once("../include/functions.php");
noPublic('dashboard.php');

if (isset($_POST['file'])) {
    $file_owner = checkFileOwner($_POST['file'])[0];
    $server_name = checkFileOwner($_POST['file'])[1];
    if ($_SESSION['id'] == $file_owner) {
        trashFile($server_name);
    }
}



// Redirect to dashboard.php after processing
echo '<script type="text/javascript">'; 
echo 'window.location.href = "dashboard.php";'; 
echo '</script>';


?>

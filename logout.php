<?php ob_start(); session_start(); ?>
<?php

session_destroy(); //Destroys Current Session
header("Location: index.php"); //Redirects to login page
exit();


?>

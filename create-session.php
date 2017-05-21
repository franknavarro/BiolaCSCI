<?php if (session_status() == PHP_SESSION_NONE) {
    session_start();
}  ?>

<?php

if(isset($_SESSION['user_id'])){
    if($_SESSION['user_perm'] > "2"){
        goto begin;
    } else {
        include 'templates/header.php';
        echo "Permission Denied!";
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>

<html>
<?php begin: include 'templates/header.php'; ?>
    <body>
        <h1 class="text-center"> Create a Session </h1>
        <form role="form" action="create-session.php" method="post">
            <fieldset>
            <input type="text" placeholder="Class ID" name="classID" required/>
            <input type="submit" class="submit-button">
            </fieldset>
        </form>

        <?php
        include 'resources/library/attendance.php';
        if(isset($_POST['classID'])){
            $classRole = db::query("SELECT role from user_class where user_email=:user_id", array(':user_id'=>$_SESSION['user_id']));
            if(print_r($classRole[0]['role'], true) == "3"){
                echo "Attendance Code: ";
                echo attendance::createSession($_POST['classID'], $_SESSION['user_id']);
            } else {
                echo "Error: The user is not a teacher in the class";
            }
        }
         ?>
    </body>

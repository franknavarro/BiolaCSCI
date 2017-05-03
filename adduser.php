<?php session_start(); ?>

<?php

if(isset($_SESSION['user_id'])){
    if($_SESSION['user_id'] == "mark.a.gong-guy@biola.edu"){
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
        <h1 class="text-center"> Create a New User </h1>
        <form role="form" action="adduser.php" method="post">
            <fieldset>
            <input type="text" placeholder="Biola Email" name="email" required/>
            <input type="text" placeholder="First Name" name="firstName" required/>
            <input type="text" placeholder="Last Name" name="lastName" required/>
            <input type="password" placeholder="Password" name="password" required/>
            <input type="submit" class="submit-button">
            <fieldset>
        </form>

        <?php
        include 'resources/library/user.php';
        if(isset($_POST['email'])){
            $defaultuser_perm = 1;
            user::addUser($_POST['email'], $_POST['firstName'], $_POST['lastName'], $_POST['password'], $defaultuser_perm);
            echo "Created!";
        }
         ?>
    </body>

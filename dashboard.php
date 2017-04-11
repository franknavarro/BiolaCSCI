<?php session_start(); ?>

<?php

if(isset($_SESSION['user_id'])){
    echo "Welcome ", $_SESSION['user_id'];
} else {
    header("Location: index.php");
    exit();
}
?>

<?php include 'templates/header.php'; ?>

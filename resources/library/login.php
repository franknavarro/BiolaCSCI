<?php

include('db.php');

$email = $_POST['email'];
$password = $_POST['password'];

if (DB::query('SELECT email FROM user WHERE email=:email', array(':email'=>$email))){
    echo "Email Found";
} else {
    echo "Email Not Found";
}

// if(isset($POST['login'])) {
//     $email = $_POST['email'];
//     $password = $_POST['password'];
//
//     if(DB::query('SELECT email FROM user WHERE email=:email', array(':email'=>$email))){
//         echo "User Found!";
//     } else {
//         echo "User not registered!";
//     }
//
//     echo "Complete";
//
// }
?>

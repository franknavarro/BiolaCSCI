<?php

include_once('resources/library/user.php');

class class_test{
    public static function runTest(){
        echo "<h1>Testing Email Verification</h1>";

        echo "Inputting Bad Email...";
        if(user::validateEmail("Test") == "Invalid email format"){
            echo "</br>Test Passed!";
        } else {
            echo "</br>Test Failed!";
        }

        echo "<h1>Testing Password Verification</h1>";

        echo "Inputting Blank Password...";
        if(user::validatePassword("") == "Please enter a password"){
            echo "</br>Test Passed!";
        } else {
            echo "</br>Test Failed!";
        }

        echo "<h1>Validate User Verification</h1>";
        echo "Note: Must have the default mark.a.gong-guy@biola.edu user installed</br>";

        echo "Inputting Good User...";
        echo "</br>Inputting Bad Password...";
        if(user::validateUser("mark.a.gong-guy@biola.edu","wrongpassword") == "The Email or Password is Incorrect"){
            echo "</br>Inputting Good User...";
            echo "</br>Inputting Good Password...";
            if(user::validateUser("mark.a.gong-guy@biola.edu","password") != "The Email or Password is Incorrect"){
                echo "</br>Test Passed";
            } else {
                echo "</br>Test Failed at Password Verification";
            }
        } else {
            echo "</br>Test Failed!";
        }

        echo "<h1>Validate Add User Function</h1>";
        echo "Note: Must have the default mark.a.gong-guy@biola.edu user installed</br>";

        echo "Adding Test User";
        echo "</br>Note: Can only run one time any other times will fail because user will exist";
        user::addUser("tom.doe@biola.edu", "Tom", "Doe", "password", "1");
        if(user::validateUser("tom.doe@biola.edu", "password") != "The Email or Password is Incorrect"){
            echo "</br>Test Passed!";
        } else {
            echo "</br>Test Failed!";
        }

    }
}

 ?>

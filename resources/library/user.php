<?php

include_once('db.php');


/*
Class: User
Description: Handles login and validation of login form data
*/

class user{

    /*
    Function: validateEmail($email)
    Input: $email = email to be validated
    Return: Error message after checking for blank as well as if the entered is an email
    */
    public static function validateEmail($email){
        if (empty($email)) {
            return "Please enter an email";
          } else {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                  return "Invalid email format";
              }
            }
        }
    /*
    Function: validatePassword($password)
    Input: $password = password to be validated
    Return: Error message after checking for blank as well as characters entered
    */
    public static function validatePassword($password){
        if (empty($password)) {
            return "Please enter a password";
        } else if(preg_match("/\\s/", $password)) {
            return 'Invalid Password';
        }
    }
    /*
    Function: ValidateUser($email, $password)
    Input: $email = the email that is to be validated, $password = password to be validated
    Return: 1 if the function is able to valide the user or will return an error message
    */
    public static function validateUser($email, $password){
        //$hash = password_hash($password)
        $ipAddress = $_SERVER['REMOTE_ADDR']; //Obtains and stores clients ip address
        $timestamp = date("Y-m-d H:i:s"); //Obtains and stores current date and time
        //Query: Checks if both email and password entered are a match
        $result = db::query("SELECT user_perm, firstName, lastName FROM user WHERE email=:email AND password=:password", array(':email'=>$email, ':password'=>$password));
        if(!empty($result)){
            $_SESSION['user_id'] = $email; // Stores user_id for the sessioning
            $_SESSION['user_perm'] = print_r($result[0]['user_perm'], true); //Stores user permissions for sessioning
            $_SESSION['user_fName'] = print_r($result[0]['firstName'], true); //Stores user firstname for sessioning
            $_SESSION['user_lName'] = print_r($result[0]['lastName'], true); //Stores user lastname for sessioning
            //Insert: Will log when the user logs in and their respective ip address
            db::query("INSERT INTO log_login (timestamp, ipAddress, user_email) VALUES (:timestamp, :ipAddress, :user_email)", array(':timestamp'=>$timestamp, ':ipAddress'=>$ipAddress, ':user_email'=>$email));
            //Insert: Will log the date and last ip address in the user table
            db::query("UPDATE user SET lastsignin=:lastsignin, lastipaddress=:lastipaddress WHERE email=:email", array(':lastsignin'=>$timestamp, ':lastipaddress'=>$ipAddress, ':email'=>$email));
            return 1;

        } else {
            return "The Email or Password is Incorrect";
        }
    }

    public static function addUser($email, $firstName, $lastName, $password, $user_perm){
        $hash = $password;
        // password_hash($password, PASSWORD_DEFAULT);
        $perm = $user_perm; // Write Verification
        db::query("INSERT INTO user (email, firstName, lastName, password, user_perm) VALUES (:email, :firstName, :lastName, :password, :user_perm)", array(':email'=>$email, ':firstName'=>$firstName, ':lastName'=>$lastName, ':password'=>$hash, 'user_perm'=>$perm));
    }
}

 ?>

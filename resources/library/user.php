<?php

include_once('db.php');

class user{

    public static function validateEmail($email){
        if (empty($email)) {
            return "Please enter an email";
          } else {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                  return "Invalid email format";
              }
            }
        }

    public static function validatePassword($password){
        if (empty($password)) {
            return "Please enter a password";
        } else if (preg_match(" /^.*(?=.{8,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/",$password)){ //Determine Characters Later
            return "Invalid Characters Entered";
            }
        }

    public static function validateUser($email, $password){
        $result = DB::query("SELECT email FROM user WHERE email=:email AND password=:password", array (':email'=>$email, ':password'=>$password));
        if(!empty($result)){
            $_SESSION['user_id'] = $email;
            return 1;
        } else {
            return "The Email or Password is Incorrect";
        }
    }
}

 ?>

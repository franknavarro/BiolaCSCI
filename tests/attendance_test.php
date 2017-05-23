<?php

//Instructions: To run use the runtests.php

include_once('resources/library/attendance.php');
include_once('resources/library/db.php');

class attendance_test{
    public static function runTest(){
        echo "<h1>Testing Attendance Create Session</h1>";
        $classID = 1;
        $hostEmail = "mark.a.gong-guy@biola.edu";
        $sessionURL = "csci.biola.edu";
        $sessionKey = attendance::createSession($classID, $hostEmail, $sessionURL);
        if($sessionKey != "ERROR: Unable to create session"){
            echo "Success";
        } else {
            echo "Failed";
        }

        echo "<h1>Testing Attendance Check In</h1>";
        $sessionID = attendance::checkIn($hostEmail, $sessionKey);
        if(strpos($sessionID, 'ERROR:')){
            echo "Failed";
        } else {
            echo "Success";
        }


        echo "<h1>Testing Attendance Start Session</h1>";
        if(attendance::startSession($sessionID)){
            echo "Success";
        } else {
            echo "Failed!";
        }

        echo "<h1>Testing Attendance End Session</h1>";
        if(attendance::endSession($sessionID) == true){
            echo "Success";
        } else {
            echo "Failed!";
        }

    }
}

 ?>

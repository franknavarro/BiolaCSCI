<?php

include_once('db.php');

class attendance{

    private static function generateCode($classID, $professor_id){
        $length = 5;
        return bin2hex(random_bytes($length));
        //Enter attendance code into database
    }

    public static function checkIn($user_id, $classID, $attendanceCode){
        //Verify Attendance Code
        //Check if class has started
        // if class has started then mark student as tardy
        // if class has not started them ark student as present
    }

    public static function beginClass($classID){
        // Mark class as open
    }

    public static function endClass($classID){
        // Mark class as complete
    }

}
 ?>

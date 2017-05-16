<?php

include_once('db.php');

class attendance{

    public static function checkIn($user_id, $classID, $attendanceCode){
        //Verify Attendance Code
        //Check if class has started
        // if class has started then mark student as tardy
        // if class has not started them ark student as present
    }

    public static function beginClass($classID, $hostEmail){

        $results = db::query("SELECT className from class where classID=:classID", array (':classID'=>$classID));
        $sessionName = print_r($results[0]['className']);
        $sessionExpired = 0; //Marks the class as not expired
        $sessionKey = bin2hex(random_bytes(5)); //Returns 5 random characters for attendance code
        //Create Class Information
        db::query("INSERT INTO session (hostID, sessionName, sessionExpired, sessionKey) VALUES (:hostID, :sessionName, :sessionExpired, :sessionKey)", array (':hostID'=>$hostemail, ':sessionName'=>$sessionName, ':sessionExpired'=>$sessionExpired, ':sessionKey'=>$sessionKey))
    }

    public static function endClass($classID){
        // Mark class as complete
    }

}
 ?>

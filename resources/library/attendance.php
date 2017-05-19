<?php

include_once('db.php');

class attendance{

    public static function checkIn($user_id, $attendanceCode){
        //Verify Attendance Code
        $result = db::query("SELECT sessionStatus, sessionID from session where sessionKey=:sessionKey", array(':sessionKey'=>$attendanceCode));
        //Check if class has started
        if(!empty($result)){
            $sessionStatus = print_r($result[0]['sessionStatus'], true);
            $sessionID = print_r($result[0]['sessionID'], true);
            switch ($sessionStatus) {
                case 0:
                    return "Error: Session Expired";
                    break;

                case 1:
                    //Note: Present: 1
                    db::query("INSERT INTO attendance (sessionID, state, user_email) VALUES (:sessionID, 1, :user_email)", array(':sessionID'=>$sessionID, ':user_email'=>$user_id));
                    $nameResult = db::query("SELECT sessionID from session WHERE sessionID=:sessionID", array(':sessionID'=>$sessionID));
                    $sessionID = print_r($nameResult[0]['sessionID'], true);
                    return $sessionID; //Returns class name for user
                    break;
                    //Note: Tardy; 2
                case 2:
                    db::query("INSERT INTO attendance (sessionID, state, user_email) VALUES (:sessionID, 2, :user_email)", array(':sessionID'=>$sessionID, ':user_email'=>$user_id));
                    $nameResult = db::query("SELECT sessionID from session WHERE sessionID=:sessionID", array(':sessionID'=>$sessionID));
                    $sessionID = print_r($nameResult[0]['sessionID'], true);
                    return $sessionID; //Returns class name for user
                    break;
                default:
                    return "Error: Invalid Session Status";
                    break;
            }
        } else {
            return "Error: Incorrect Attedance Code or Session does not exist!";
        }
        // if class has started then mark student as tardy
        // if class has not started them ark student as present
    }

    public static function createSession($classID, $hostEmail){

        $results = db::query("SELECT className from class where classID=:classID", array (':classID'=>$classID));
        $sessionName = print_r($results[0]['className']);
        $sessionStatus = 1; //Marks the class as not expired
        $sessionKey = bin2hex(random_bytes(5)); //Returns 5 random characters for attendance code
        //Create Class Information
        db::query("INSERT INTO session (hostID, sessionName, sessionStatus, sessionKey) VALUES (:hostID, :sessionName, :sessionStatus, :sessionKey)", array(':hostID'=>$hostEmail, ':sessionName'=>$sessionName, ':sessionStatus'=>$sessionStatus, ':sessionKey'=>$sessionKey));
    }

    public static function startSession($sessionID){
        $result = db::query("SELECT sessionName from session WHERE sessionID=:sessionID", array(':sessionID' => $sessionID));
        if(!empty($result)){
            $className = print_r($result[0]['sessionName']);
            $classID = db::query("SELECT classID from session WHERE className=:className", array(':className' => $className));

            // Mark class as complete
            db::query("UPDATE session SET sessionStatus = 2 WHERE sessionID=:sessionID", array(':sessionID' => $sessionID));
            db::query("UPDATE class SET activeSession = 1 WHERE classID=:classID", array(':classID'=>$classID));
        }
    }

    public static function endSession($sessionID){
        $result = db::query("SELECT sessionName from session WHERE sessionID=:sessionID", array(':sessionID' => $sessionID));
        if(!empty($result)){
            $className = print_r($result[0]['sessionName']);
            $classID = db::query("SELECT classID from session WHERE className=:className", array(':className' => $className));

            // Mark class as complete
            db::query("UPDATE session SET sessionStatus = 0 WHERE sessionID=:sessionID", array(':sessionID' => $sessionID));
            db::query("UPDATE class SET activeSession = 0 WHERE classID=:classID", array(':classID'=>$classID));
        }
    }

}
 ?>

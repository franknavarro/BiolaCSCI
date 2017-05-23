<?php

include_once('db.php');

/*
Class: Attendance
Description: Handles checking in a user to a virtual session and noting it as well as creating sessions and validating them
*/
class attendance{
    /*
    Function: checkIn($user_id, $attendanceCode)
    Input: $user_id = enter the id of the user to check in, $attendanceCode = enter the attendance Code for a session
    Return: Returns error messages or if validated the sessionID.
    */
    public static function checkIn($user_id, $attendanceCode){
        //Verify Attendance Code
        $result = db::query("SELECT sessionStatus, sessionID from session where sessionKey=:sessionKey", array(':sessionKey'=>$attendanceCode));
        //Check if class has started
        if(!empty($result)){

            //Variables to hold
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
    }

    /*
    Function: createSession($classID, $hostEmail)
    Input: $classID = the ID of the class to create the session under, $hostEmail = The host user_id which will be in the form of an email address
    Return: Returns error messages or if validated the sessionKey
    */
    public static function createSession($classID, $hostEmail, $sessionURL){

        $results = db::query("SELECT className from class where classID=:classID", array (':classID'=>$classID));
        if(!empty($results)){
            $sessionName = print_r($results[0]['className'], true);
            $sessionStatus = 1; //Marks the class as not expired
            $sessionKey = bin2hex(random_bytes(5)); //Returns 5 random characters for attendance code
            $timestamp = date("Y-m-d");
            //Create Class Information
            db::query("INSERT INTO session (hostID, sessionName, sessionStatus, sessionKey, sessionDate, sessionURL) VALUES (:hostID, :sessionName, :sessionStatus, :sessionKey, :sessionDate, :sessionURL)", array(':hostID'=>$hostEmail, ':sessionName'=>$sessionName, ':sessionStatus'=>$sessionStatus, ':sessionKey'=>$sessionKey, ':sessionDate'=>$timestamp, ':sessionURL'=>$sessionURL));
            db::query("UPDATE class SET activeSession = 1 WHERE classID=:classID", array(':classID'=>$classID));
            return $sessionKey;
        } else {
            return "ERROR: Unable to create session";
        }
    }

    /*
    Function: startSession($sessionID)
    Input: $sessionID = The session ID to start
    Return: Returns error messages or if validated True
    */

    public static function startSession($sessionID){
        // Mark class as complete
        if(db::query("UPDATE session SET sessionStatus = 2 WHERE sessionID=:sessionID", array(':sessionID' => $sessionID))){
            return true;
        } else {
            return "ERROR: Unable to start Session";
        }

    }

    /*
    Function: endSession($sessionID)
    Input: $sessionID = The session ID to end
    Return: Returns error messages or if validated True
    */

    public static function endSession($sessionID){
        $result = db::query("SELECT sessionName from session WHERE sessionID=:sessionID", array(':sessionID' => $sessionID));
        if(!empty($result)){
            $className = print_r($result[0]['sessionName'], true);
            $classIDQuery = db::query("SELECT classID from class WHERE className=:className", array(':className' => $className));
            if(!empty($classIDQuery)){
                $classID = print_r($classIDQuery[0]['classID'], true);
            }
            // Mark class as complete
            db::query("UPDATE session SET sessionStatus = 0 WHERE sessionID=:sessionID", array(':sessionID' => $sessionID));
            db::query("UPDATE class SET activeSession = 0 WHERE classID=:classID", array(':classID'=>$classID));
            return true;

        } else {
            return "ERROR: Unable to end session";
        }
    }

}
 ?>

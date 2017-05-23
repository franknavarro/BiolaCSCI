<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
?>

<?php

    if(isset($_SESSION['user_id'])){
        goto begin;
    } else {
        header("Location: index.php");
        exit();
    }
?>

<?php begin: include_once 'templates/header.php'; include_once 'resources/library/db.php';?>
    <body>
        <?php
            include_once 'resources/library/attendance.php';

            if(isset($_POST['attendanceCode'])){
                $attendanceCode = $_POST['attendanceCode'];
                $user_id = $_SESSION['user_id'];

                $sessionID = attendance::checkIn($user_id, $attendanceCode);

                if(substr($sessionID, 0, 5) === "Error"){
                    //Return Error Message
                    echo '<div class="alert alert-warning">';
                    echo $sessionID;
                    echo '</div>';
                } else {
                    $sessionURLQuery = db::query("SELECT sessionURL from session where sessionID=:sessionID", array(':sessionID'=>$sessionID));
                    $sessionURL = print_r($sessionURLQuery[0]['sessionURL'], true);
                     die("<script>location.href = '$sessionURL'</script>");
                }
            }
        ?>
        <div class="page-header" style="padding-left: 1em">
          <h1><center>CSCI Dashboard</center></br></br><small> Welcome, <?php echo $_SESSION['user_fName']; echo " "; echo $_SESSION['user_lName'];?></small></h1>
             <?php
             include_once 'resources/library/db.php';
             $class_id = db::query("SELECT class_classID from user_class where user_email = :user_email", array(':user_email'=>$_SESSION['user_id']));
             for($count = 0; $count < count($class_id); $count++){

                 $classID = print_r($class_id[$count]["class_classID"], true); //Variable to hold classID
                 $result = db::query("SELECT className, syllabusURL, classTime, activeSession, classCode from class where classID = :classID", array(':classID'=>$classID));
                 $className = print_r($result[0]["className"], true);
                //  //Add Professor Email that links to First and Last Name
                 $classTime = print_r($result[0]["classTime"], true);
                 $activeSession = print_r($result[0]["activeSession"], true);
                 $classURL = print_r($result[0]["syllabusURL"], true);
                 $classCode = print_r($result[0]["classCode"], true);
                 $sessionData = db::query("SELECT sessionURL from session where sessionName=:className and sessionStatus > 0", array(':className'=>$className));
                 if(!empty($sessionData)){
                    $sessionURL = print_r($sessionData[$count]['sessionURL'], true);
                 }

                 echo '<div class="row">';
                 echo     '<div class="col-sm-6 col-md-4">';
                 echo       '<div class="caption">';
                 echo           "<h3 class='dashClassTitle'>$className</h3>";
                 echo               '<p>';
                 echo                   'Professor: Dr. Lin </br>';
                 echo                   "Class Times: $classTime";
                 echo               '</p>';
                 if($_SESSION['user_perm'] < 2){
                     if($activeSession == 1){
                         echo '<p><a data-toggle="modal" data-target="#myModal" class="btn btn-success" role="button">Join Session</a>';
                     } else {
                         echo '<p><a href="#" class="btn btn-danger" role="button">No Session</a>';
                     }
                 } else {
                     if($activeSession == 1){
                         echo '<p><a href="';
                         echo $sessionURL;
                         echo '" class="btn btn-warning" role="button">Join Session</a>';
                     } else {
                         echo '<p><a href="/classroom.php" class="btn btn-success" role="button">Start Session</a>';
                     }
                 }

                 echo        '<a href="';
                 echo        $classCode . '.php';
                 echo        '" class="btn btn-default" role="button">More Info</a></p>';
                 echo   '</div>';
                 echo '</div>';


             }
              ?>
               </div>
        </div>
        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Attendance Code</h4>
              </div>
              <div class="modal-body">
                    <form action="dashboard.php" method="post">
                        <input type="text" name="attendanceCode"/>
                        <input type="submit" name="submitButton">
                    </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>


<?php include "templates/footer.php"; ?>

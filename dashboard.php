<?php session_start(); ?>

<?php

if(isset($_SESSION['user_id'])){
    goto begin;
} else {
    header("Location: index.php");
    exit();
}
?>

<html>
<?php begin: include 'templates/header.php'; include 'resources/library/db.php';?>
    <body>
        <div class="page-header" style="padding-left: 1em">
          <h1><center>CSCI Dashboard</center></br></br><small> Welcome, <?php echo $_SESSION['user_fName']; ?></small></h1>
          <!-- <div class="row" style="padding-left: 3em">
            <div class="col-sm-6 col-md-4">
                <div class="caption">
                  <h3>Introduction to Programming</h3>
                  <p>
                      Professor: Dr. Lin </br>
                      Class Times: TR 10:30am - 12:00am
                  </p>
                  <p><a href="#" class="btn btn-success" role="button">Join Session</a> <a href="#" class="btn btn-default" role="button">More Info</a></p>
                </div>
             </div> -->
             <?php

             include_once 'resources/library/db.php';
             $class_id = db::query("SELECT class_classID from user_class where user_email = :user_email", array(':user_email'=>$_SESSION['user_id']));
             for($count = 0; $count < count($class_id); $count++){

                 $classID = print_r($class_id[$count]["class_classID"], true); //Variable to hold classID
                 $result = db::query("SELECT className, syllabusURL, classTime, activeSession from class where classID = :classID", array(':classID'=>$classID));
                 $className = print_r($result[0]["className"], true);
                //  //Add Professor Email that links to First and Last Name
                 $classTime = print_r($result[0]["classTime"], true);
                 $activeSession = print_r($result[0]["activeSession"], true);
                 $classURL = print_r($result[0]["syllabusURL"], true);

                 echo '<div class="row" style="padding-left: 3em">';
                 echo     '<div class="col-sm-6 col-md-4">';
                 echo       '<div class="caption">';
                 echo           "<h3>$className</h3>";
                 echo               '<p>';
                 echo                   'Professor: Dr. Lin </br>';
                 echo                   "Class Times: $classTime";
                 echo               '</p>';
                 if($activeSession == 1){
                     echo '<p><a href="#" class="btn btn-success" role="button">Join Session</a>';
                 } else {
                     echo '<p><a href="#" class="btn btn-danger" role="button">No Session</a>';
                 }
                 echo        '<a href="';
                 echo        $classURL;
                 echo        '" class="btn btn-default" role="button">More Info</a></p>';
                 echo   '</div>';
                 echo '</div>';


             }
              ?>
               </div>
        </div>
    </body>
</html>

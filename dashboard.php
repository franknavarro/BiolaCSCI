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
<?php begin: include 'templates/header.php'; ?>
    <body>
        <div class="page-header" style="padding-left: 1em">
          <h1><center>CSCI Dashboard</center></br></br><small> Welcome, <?php echo $_SESSION['user_id']; ?></small></h1>
          <div class="row">
            <div class="col-sm-6 col-md-4">
                <div class="caption">
                  <h3>Introduction to Programming</h3>
                  <p>
                      Professor: Dr. Lin </br>
                      Class Times: TR 10:30am - 12:00am
                  </p>
                  <p><a href="#" class="btn btn-success" role="button">Join Session</a> <a href="#" class="btn btn-default" role="button">More Info</a></p>
                </div>
             </div>
             <div class="col-sm-6 col-md-4">
                 <div class="caption">
                   <h3>Data Structures</h3>
                   <p>
                       Professor: Dr. Lin </br>
                       Class Times: TR 10:30am - 12:00am
                   </p>
                   <p><a href="#" class="btn btn-danger" role="button">No Session</a> <a href="#" class="btn btn-default" role="button">More Info</a></p>
                 </div>
              </div>
              <div class="col-sm-6 col-md-4">
                  <div class="caption">
                    <h3>Data Structures</h3>
                    <p>
                        Professor: Dr. Lin </br>
                        Class Times: TR 10:30am - 12:00am
                    </p>
                    <p><a href="#" class="btn btn-danger" role="button">No Session</a> <a href="#" class="btn btn-default" role="button">More Info</a></p>
                  </div>
               </div>
        </div>
    </body>
</html>

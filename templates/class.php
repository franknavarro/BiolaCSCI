<?php ob_start(); session_start(); ?>

<?php
if(isset($_SESSION['user_id'])){
    header("Location: dashboard.php");
    exit();
}
 ?>

<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Class</title>

    <!-- Bootstrap CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <!-- Default CSS -->
    <link rel="stylesheet" href="/css/style.css">
    
</head>

<body>
    
 <!------------------------------------------------------- 
Everthing above should be in header.php
--------------------------------------------------------->

    <div id="class-page">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 class-header-container">
                    
                    <!-- Update class title and ID here -->
                    <div class="class-header">
                        <h3>Introduction to Computer Science</h3>
                        <label>CSCI 105</label>
                    </div>
                    
                    <!-- Add links that loads relavent content into div.class-deatils below -->
                    <div class="class-navigation">
                        <div class="col-xs-4">
                            <a href="#">Info</a>
                        </div>
                        <div class="col-xs-4">
                            <a href="#">Announcements</a>
                        </div>
                        <div class="col-xs-4">
                            <a href="#">Assignments</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8 class-content">
                    <!--Here is where you would load the class information details. When you click Info, Announcements, or Assignments above this container adds the information needed -->
                    <div class="class-details">
                        <!-- Loaded Data -->
                    </div>
                </div>
                    
                <!-- Check permisions to load relavent links -->
                <div class="col-sm-4 class-links">
                    <button class="default-button"><a href="#">Begin Collab</a></button>
                    <button class="default-button"><a href="#">Edit Class Info</a></button>
                    <button class="default-button"><a href="#">Edit Class Announcements</a></button>
                    <button class="default-button"><a href="#">Edit Class Assignments</a></button>
                    <button class="default-button"><a href="#">Start Whiteboard</a></button>
                    <button class="default-button"><a href="#">Generate Attendance</a></button>
                    <button class="default-button"><a href="#">Fill Attendance</a></button>
                </div>
            </div>
        </div>
    </div>
    
    
<!-------------------------------------------------------
Everthing below should be in footer.php
--------------------------------------------------------->
    
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="/js/bootstrap.min.js"></script>

</body>
</html>

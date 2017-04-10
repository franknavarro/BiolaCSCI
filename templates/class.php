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
    <title>Biola CSCI Website</title>

    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Default CSS -->
    <link href="css/style.css" rel="stylesheet">

    <title>Classes</title>
    <link rel="stylesheet" href="css/style.css">
    <!-- Login Page CSS -->
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    
    <div id="class-page">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 class-content">
                    <div class="class-header">
                        <h3>Introduction to Computer Science</h3>
                    </div>
                </div>
                <div class="col-sm-4 class-links">
                </div>
            </div>
        </div>
    </div>
    
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="js/bootstrap.min.js"></script>

</body>
</html>

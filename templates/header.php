<?php ob_start(); session_start(); ?>

<?php
if(isset($_SESSION['user_id'])){
    //What you want the user to do or see if the user is logged in
} else {

    header("Location: ../index.php");
}
 ?>


<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Use PHP to get page title -->
    <title>Biola Computer Science</title>

    <!-- Bootstrap Core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/css/style.css" rel="stylesheet">

    <!-- Font Awesome -->
    <script src="https://use.fontawesome.com/2426b7bc7d.js"></script>

</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

    <!-- Navigation -->
    <nav class="navbar navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="/index.php">Biola CSCI</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <li class="nav-item dropdown">
                        <a href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Classes</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <!-- Here is where each class is displayed. Use PHP to load each item as a link with <a> tag with the class "dropdown-item" -->
                            <a class="dropdown-item" href="/class.php">Introduction to Computer Science</a>
                            <!-- Use horizontal rule to seperate each class -->
                            <!-- <hr> -->
                        </div>
                    </li>
                    <?php
                    if($_SESSION['user_perm'] > "2"){
                        echo '<li class="nav-item">';
                        echo '<a href="#">Create Class</a>';
                        echo '</li>';
                    }
                    ?>
                    <?php
                    if($_SESSION['user_perm'] == "4"){
                        echo '<li class="nav-item">';
                        echo '<a href="/adduser.php">Create User</a>';
                        echo '</li>';
                    }
                    ?>
                    <?php
                    if($_SESSION['user_perm'] > "1"){
                        echo '<li class="nav-item">';
                        echo '<a href="/classroom.php">Start Session</a>';
                        echo '</li>';
                    }
                    ?>
                    <li class="nav-item">
                        <a href="/logout.php">Log Out</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <div class="container page-content">

<?php ob_start(); session_start(); ?>

<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Use PHP to get page title -->
    <title>Dope Page</title>

    <!-- Bootstrap Core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/css/style.css" rel="stylesheet">

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
                <a class="navbar-brand page-scroll" href="#page-top">Biola CSCI</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <li class="nav-item dropdown">
                        <a href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Classes</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <!-- Here is where each class is displayed. Use PHP to load each item as a link with <a> tag with the class "dropdown-item" -->
                            <a class="dropdown-item" href="#">Introduction to Computer Science</a>
                            <!-- Use horizontal rule to seperate each class -->
                            <hr>
                            <a class="dropdown-item" href="#">Computer Organization & Assembly Language Programming</a>
                            <hr>
                            <a class="dropdown-item" href="#">Software Engineering</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="#">Forums</a>
                    </li>
                    <li class="nav-item">
                        <a href="#">Repo</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Only used for scroll effect in navbar-->
    <div style="height: 150%;"></div>

     <!-- jQuery -->
    <script src="/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/js/bootstrap.min.js"></script>

    <!-- Scrolling Navbar JavaScript-->
    <script src="/js/jquery.easing.min.js"></script>
    <script src="/js/navbar.js"></script>

</body>

</html>

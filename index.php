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

    </head>

<body>
    <div id="login-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <?php

                include_once('resources/library/user.php');

                if(isset($_POST['email'])){
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    $errormessage = "";

                    $errormessage = user::validateEmail($email);
                    if (!$errormessage == "") {
                        echo '<div class="alert alert-warning">';
                        echo '<strong>Warning! </strong>', $errormessage;
                        echo '</div>';
                        $errormessage = "";
                    }
                    $errormessage = user::validatePassword($password);
                    if (!$errormessage == "") {
                        echo '<div class="alert alert-warning">';
                        echo '<strong>Warning! </strong>', $errormessage;
                        echo '</div>';
                        $errormessage = "";
                    }
                    $errormessage = user::validateUser($email, $password);
                    if ($errormessage == 1) {
                        header("Location: dashboard.php");
                        exit();

                    } else {
                        echo '<div class="alert alert-warning">';
                        echo '<strong>Warning! </strong>', $errormessage;
                        echo '</div>';
                        $errormessage = "";
                    }

                }

                 ?>
                <div class="login-container">
                    <div class="form">
                        <form class="login-form" action="index.php" method="post">
                            <fieldset>
                                <input type="text" placeholder="Biola Email" name="email" required/>
                                <input type="password" placeholder="Password" name="password" required/>
                                <input type="submit" class="submit-button">
                            </fieldset>
                        </form>
                    </div>
                </div>
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

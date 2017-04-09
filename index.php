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
    <!-- Login Page CSS -->
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <?php

                include_once('resources/library/login.php');



                if(isset($_POST['email'])){
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    $errormessage = "";

                    $errormessage = login::validateEmail($email);
                    if (!$errormessage == "") {
                        echo '<div class="alert alert-warning">';
                        echo '<strong>Warning! </strong>', $errormessage;
                        echo '</div>';
                        $errormessage = "";
                    }
                    $errormessage = login::validatePassword($password);
                    if (!$errormessage == "") {
                        echo '<div class="alert alert-warning">';
                        echo '<strong>Warning! </strong>', $errormessage;
                        echo '</div>';
                        $errormessage = "";
                    }
                    // $errormessage = login::loginUser($email, $password);
                    // if ($errormessage == "1") {
                    //     echo '<div class="alert alert-success">';
                    //     echo '<strong>Success!</strong> You are logged in as ', $email;
                    //     echo '</div>';
                    // } else {
                    //     echo '<div class="alert alert-warning">';
                    //     echo '<strong>Warning! </strong>', $errormessage;
                    //     echo '</div>';
                    //     $errormessage = "";
                    // }

                }

                 ?>
                <div class="login-container">
                    <div class="form">
                        <form class="login-form" action="index.php" method="post">
                            <fieldset>
                                <input type="text" placeholder="Biola Email" name="email" required/>
                                <input type="password" placeholder="Password" name="password" required/>
                                <input type="submit">
                            </fieldset>
                        </form>
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

<?php

include('resources/library/db.php');

if(isset($POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(DB::query('SELECT email FROM user WHERE email=:email', array(':email'=>$email))){

    } else {
        echo "User not registered!";
    }

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

    <title>Biola CSCI Website</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div id="login-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="login-container">
                    <div class="form">
                        <form class="login-form" action="index.php" method="post">
                            <fieldset>
                                <input type="text" placeholder="Biola Email" name="email" required/>
                                <input type="password" placeholder="Password" name="password" required/>
                                <button value="login">login</button>
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

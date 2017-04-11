<?php ob_start(); session_start(); ?>

<?php
if(isset($_SESSION['user_id'])){
    //What you want the user to do or see if the user is logged in
} else {
    header("Location: ../index.php");
}
 ?>

<html>

<?php include 'header.php'; ?>

    <!-- S
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

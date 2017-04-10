<html>
<body>
<!-- php script for setting up cookies -->
<?php
$cookie_name1 = "user";
$cookie_value1 = "1631194";
$cookie_name2 = "classID";
$cookie_value2 = "450";
setcookie($cookie_name1, $cookie_value1, time()+(86400),"/");
setcookie($cookie_name2,$cookie_value2, time()+(86400),"/");
?>
 Title: <?php echo $_POST["title"]; ?><br>
 Description: <?php echo $_POST["description"]; ?><br>
 Published?: <?php echo $_POST["isLive"]; ?><br>
 Last Edited: <?php echo date("h:i:sa m/d/Y") ?><br>
 Creator: <?php echo $_COOKIE[$cookie_name1] ?><br>
 Class ID: <?php echo $_COOKIE[$cookie_name2] ?><br>
</body>
</html>

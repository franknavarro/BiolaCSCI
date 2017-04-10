<html>
    <body>
         Title: <?php echo $_POST["title"]; ?><br>
         Due Date: <?php echo $_POST["dueDate"]; ?><br>
         Description: <?php echo $_POST["description"]; ?><br>
         Assignment URL: <?php echo $_POST["assignmentURL"]; ?><br>
         Published?: <?php echo $_POST["isLive"]; ?><br>
         Last Edited: <?php echo date("h:i:sa m/d/Y") ?><br>
         Class ID: <?php echo $_COOKIE[$cookie_value2] ?><br>
    </body>
</html>

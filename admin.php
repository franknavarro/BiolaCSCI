<?php
include 'templates/header.php';
?>

<h1> Attendance Record </h1>
<p> Select class from drop down: </p>
<form name="class" action="admin.php" method="post">
    <select class="form-control">
        <?php

            include 'resources/library/db.php';

            $classID_teaching = db::query("SELECT class_classID from user_class where user_email=:user_id and role = 3", array('user_id'=>$_SESSION['user_id']));
            for($count = 0; $count < count($classID_teaching); $count++){
                $classID = print_r($classID_teaching[$count]['class_classID'], true);
                //Get class name from classID
                $className = db::query("SELECT className from class where classID=:classID", array(':classID'=>$classID));
                if(!empty($className)){
                    echo "<option>";
                    print_r($className[0]['className']);
                    echo "</option>";
                }
            }

            if(empty($classID_teaching)){
                echo "<option> Not Teaching any Classes </option>";
            }
         ?>
    </select>
        <input type="submit" name="Update" value="Select Class"/>
</form>

  <table class="table">
      <thead>
        <tr>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>John</td>
          <td>Doe</td>
          <td>Tardy</td>
        </tr>
        <tr>
          <td>Mary</td>
          <td>Moe</td>
          <td>mary@example.com</td>
        </tr>
        <tr>
          <td>July</td>
          <td>Dooley</td>
          <td>july@example.com</td>
        </tr>
      </tbody>
    </table>

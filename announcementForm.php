<?php include 'templates/header.php'; ?>
<?php require_once 'resources/library/db.php';?>
<?php if ($_SERVER['REQUEST_METHOD'] == 'GET') { ?>
<html>
<body>
  <div class="row">
    <div class="col-md-12">
      <form action="<?php echo htmlentities($_SERVER['SCRIPT_NAME']) ?>" method="post">
          <!--Announcement Info--------------------------------->
          <!--Title-->
          <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" placeholder="Enter Title">
          </div>

          <!--Description-->
          <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
          </div>


          <!--Class
          <div class="form-group">
            <label for="classID">Class</label>
            <input type="text" class="form-control" name="classID" placeholder="Which Class Is This for?">
          </div>-->

          <select name="class">
            <?php
              #Look up all classes which are owned by the professor
              $classes = db::query("SELECT className, classID
                                    FROM class LEFT JOIN user_class
                                    ON class.classID = user_class.class_classID
                                    AND user_class.user_email = ':email';",
                                    array(':email'=>$_SESSION['user_id']));

              #loop through them
              foreach ($classes as &$class) {
                echo '<option value="' . $class[1] . '">' . $class[0] . '</option>"';
              }
            ?>
          </select>

          <!--Submission-->
          <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
</body>
</html>

<?php include 'templates/footer.php';}
  else {
    //include_once '../resources/library/class_validation.php';

    #validate input
    //$entry_list = validate::announcement_val();



    #get post time
    $timeStamp = date("d-m-Y, h:i:sa");

    #create insertion array
    $insertArray = array(':title'=>$_POST['title'],
                        ':description' =>$_POST['description'],
                        ':postTime'=>(string) $timeStamp,
                        ':user_email'=>$_SESSION['user_id'],
                        ':class_classID'=>$_POST['class']);
    #insert into database
    try {
      db::query("SET FOREIGN_KEY_CHECKS=0; INSERT INTO announcement (title, description, postTime, user_email, class_classID)
                VALUES (:title, :description, :postTime, :user_email, :class_classID)", $insertArray);

      #redirect
      #header("Location: index.php");

    }

    catch (PDOException $e){
      include_once 'templates/header.php';
      echo "<br>SQL ERROR<br>";
    }


  }
  include 'templates/footer.php';
?>

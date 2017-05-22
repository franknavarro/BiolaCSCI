<?php include 'templates/header.php'; ?>
<?php require_once 'resources/library/db.php';?>
<?php if ($_SERVER['REQUEST_METHOD'] == 'GET') { ?>
<html>
<body>
<form action="<?php echo htmlentities($_SERVER['SCRIPT_NAME']) ?>" method="post" enctype="multipart/form-data">
    ----Assignment Info------------------------------------<br>
    Title: <br>
    <input type="text" name="title" maxlength="45"><br>
    Due Date: <br>
    <input type="datetime-local" name="dueDate"><br>
    Description: <br>
    <textarea name="description" rows="10" cols="50"></textarea>
    <br>
    ----Assignment URL-----------------------------------<br>

    <label class="custom-file">Assignment File Upload
      <input type="file" id="file" name="file" class="custom-file-input">
      <span class="custom-file-control"></span>
    </label>
    <br>----Publish-----------------------------------------------<br>
    <div class="form-check">
      <label class="form-check-label">
        <input class="form-check-input" type="radio" name="publish" id="publish" value="publish">
        Publish Announcement
      </label>
    </div>
    ----Class-----------------------------------------------<br>
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
    <br>----Submission------------------------------------------<br>
    <input type="submit">
    <!--Publish-->

</form>
</body>
</html>
<?php include 'templates/footer.php';}
  else {

    #get post yes/no
    if ($_POST['publish']){
      $pub = 1;
    }
    else{
      $pub = 0;
    }

    #get post time
    $timeStamp = date("d-m-Y, h:i:sa");

    #prepare Array
    $submitArray = array(':title'=>$_POST['title'],
                        ':description'=>$_POST['description'],
                        ':dueDate'=>$_POST['dueDate'],
                        ':publish'=>$_POST['publish'],
                        ':classID'=>$_POST['class'],
                        ':postTime'=>(string) $timeStamp);
    try {
      #query database
      db::query("SET FOREIGN_KEY_CHECKS=0; INSERT INTO assignment (title, description, dueDate, isLive, class_classID, postTime)
                #VALUES (:title, :description, :dueDate, :publish, :classID, :postTime)", $submitArray);

      #File upload
      $uploaddir = 'ClassObject/assignment/';
      $uploadfile = $uploaddir . basename($_FILES['file']['name']);
      print_r($uploadfile);
      if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)){
        echo "Success! File can be found at $uploadfile</br>";
      }
      else{
        echo (basename($_FILES['file']['tmp_name']) . " Not Uploaded!");
      }

      $url = 'assignment/' . basename($_FILES['file']['name']);

      $assID = db::query("SELECT MAX(assID) from assignment");
      $array = array(':URL'=>$url, ':id'=>$assID[0][0]);

      db::query("SET FOREIGN_KEY_CHECKS=0; UPDATE assignment SET url = :URL WHERE assID = :id;", $array);
    } catch (PDOException $e){
      print_r($e);
    }


  }
  include 'templates/footer.php';
?>

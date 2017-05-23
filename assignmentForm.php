<?php include 'templates/header.php'; ?>
<?php require_once 'resources/library/db.php';?>
<?php if ($_SERVER['REQUEST_METHOD'] == 'GET') { ?>

<form action="<?php echo htmlentities($_SERVER['SCRIPT_NAME']) ?>" method="post" enctype="multipart/form-data">
    
    <h1 class="form-head">Create Assignment</h1>
    
    <!----Assignment Info------------------------------------>
    <div class="form-group">
        <label>Title</label>
        <input type="text" name="title" maxlength="45" placeholder="Enter Title">
    </div>
    <div class="form-group">
        <label>Due Date</label>
        <div class="nativeDateTimePicker">
            <input type="datetime-local" name="dueDate" id="dueDate">
        </div>
        <div class="fallbackDateTimePicker">
            <div class="row time-field">
                <div class="col-md-8 left-most time-div">
                <div class="col-xs-7 left-most">
                <label for="month">Month:</label>
                    <div class="selectDropdown">
                <select id="month" name="month">
                  <option selected value="1">January</option>
                  <option value="2">February</option>
                  <option value="3">March</option>
                  <option value="4">April</option>
                  <option value="5">May</option>
                  <option value="6">June</option>
                  <option value="7">July</option>
                  <option value="8">August</option>
                  <option value="9">September</option>
                  <option value="10">October</option>
                  <option value="11">November</option>
                  <option value="12">December</option>
                </select>
                    </div>
              </div>
              <div class="col-xs-2">
                <label for="day">Day:</label>
                  <div class="selectDropdown">
                <select id="day" name="day">
                </select>
                  </div>
              </div>
              
              <div class="col-xs-3 right-most">
                <label for="year">Year:</label>
                  <div class="selectDropdown">
                <select id="year" name="year">
                </select>
                  </div>
              </div>
                </div>
                
                <div class="col-md-4 right-most time-div">
              <div class="col-xs-4 left-most">
                <label for="hour">Hour:</label>
                  <div class="selectDropdown">
                <select id="hour" name="hour">
                </select>
                  </div>
              </div>
              <div class="col-xs-4">
                <label for="minute">Minute:</label>
                  <div class="selectDropdown">
                <select id="minute" name="minute">
                </select>
                  </div>
              </div>
              <div class="col-xs-4 right-most">
                  <label for="minute">TOD:</label>
                  <div class="selectDropdown">
                <select id="TOD" name="TOD">
                    <option>AM</option>
                    <option>PM</option>
                </select>
                  </div>
              </div>
                </div>
            </div>
          </div>
    </div>
    <div class="form-group">
        <label>Description</label>
        <textarea name="description" rows="10" cols="50" placeholder="Enter Description"></textarea>
    </div>

    <div class="form-group">
        <label class="custom-file">Assignment File Upload
          <input type="file" id="file" name="file" class="custom-file-input">
          <span class="custom-file-control"></span>
        </label>
    </div>
    
    <!----Class---------------------------------------------->
    <div class="form-group">
        <label>Which Class is this For?</label>
        <div class="selectDropdown">
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
        </div>
    </div>
    
    <!----Publish-------------------------------------------->
    <div class="form-group">
      <label class="form-check-label">
        <input class="form-check-input" type="checkbox" name="publish" id="publish" value="publish">
        Publish Assignment Now
      </label>
    </div>
    
    <!----Submission----------------------------------------->
    <input type="submit" class="submit-button">
    <!--Publish-->

</form>

<script type="text/javascript" src="js/datetimeFallback.js"></script>



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

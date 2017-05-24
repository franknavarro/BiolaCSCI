<?php include 'templates/header.php'; ?>
<?php if ($_SERVER['REQUEST_METHOD'] == 'GET') { ?>

<link type="text/css" href="css/style.css">
<div id="classform">

    <div class="row">

        <h1 class="form-head">Create a Class</h1>

        <form action="<?php echo htmlentities($_SERVER['SCRIPT_NAME']) ?>" enctype="multipart/form-data" method="post">

            <!--Class Name Input-->
            <div class="form-group">
                <label for="className">Class Name</label>
                <input type="text" name="className" placeholder="Enter Class Name">
            </div>

            <!-- Class Code Input-->
            <div class="col-sm-6 left-most time-div">
                <div class="form-group">
                    <label for="className">Class Code</label>
                    <input type="text" name="classCode" aria-describedby="idHelp" placeholder="Enter Class Code">
                    <small id="idHelp" class="form-text text-muted">ID should be in form: Department Code Class Code (e.g. "CSCI105")</small>
                </div>
            </div>

            <!--Class Location Input-->
            <div class="col-sm-6 right-most time-div">
                <div class="form-group">
                    <label for="classLocation">Class Location</label>
                    <input type="text" name="classLocation" aria-describedby="locationHelp" placeholder="Enter Class Location">
                    <small id="locationHelp" class="form-text text-muted">Location should be in form: Building "space" Room Number (e.g. "Library 141")</small>
                </div>
            </div>

            <!-- Class Description Input-->
            <div class="form-group">
                <label for="exampleTextarea">Class Description</label>
                <textarea id="classDescription" name="classDescription" rows="3"></textarea>
            </div>

            <!--Class Period input-->
            <div class="form-group time-field">
                <label for="classTime">Class Period</label>
                <small class="form-text text-muted">(Select Days the Class meets)</small>
                <div class="row">
                    <!--Monday check box-->
                    <div class="col-sm-dow left-most">
                        <label class="checkboxFullBox">
                        <input name="Monday" type="checkbox" class="fullCheckbox" value="M">
                        <span class="checkboxText">Monday</span>
                        </label>
                    </div>
                    <!--Tuesday check Box-->
                    <div class="col-sm-dow">
                        <label class="checkboxFullBox">
                        <input name="Tuesday" type="checkbox" class="fullCheckbox" value="T">
                        <span class="checkboxText">Tuesday</span>
                        </label>
                    </div>
                    <!--Wednesday check Box-->
                    <div class="col-sm-dow">
                        <label class="checkboxFullBox">
                        <input name="Wednesday" type="checkbox" class="fullCheckbox" value="W">
                        <span class="checkboxText">Wednesday</span>
                        </label>
                    </div>
                    <!--Thursday check Box-->
                    <div class="col-sm-dow">
                        <label class="checkboxFullBox">
                        <input name="Thursday" type="checkbox" class="fullCheckbox" value="Tr">
                        <span class="checkboxText">Thursday</span>
                        </label>
                    </div>
                    <!--Friday check Box-->
                    <div class="col-sm-dow right-most">
                        <label class="checkboxFullBox">
                        <input name="Friday" type="checkbox" class="fullCheckbox" value="F">
                        <span class="checkboxText">Friday</span>
                        </label>
                    </div>
                </div>

                <!--Enter the class start time-->
                <div class="row">
                    <div class="col-sm-6 left-most time-div">
                        <div class="nativeTimePicker">
                            <input type="time" id="classStartTime" name="classStartTime" aria-describedby="startTimeHelp" placeholder="Enter Start Time">
                        </div>
                        <div class="fallbackTimePicker">
                            <div class="col-xs-4 left-most">
                                <label for="hour">Hour:</label>
                                <div class="selectDropdown">
                                    <select class="hour" name="hour">
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <label for="minute">Minute:</label>
                                <div class="selectDropdown">
                                    <select class="minute" name="minute">
                                            </select>
                                </div>
                            </div>
                            <div class="col-xs-4 right-most">
                                <label for="minute">TOD:</label>
                                <div class="selectDropdown">
                                    <select class="TOD" name="TOD">
                                        <option>AM</option>
                                        <option>PM</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="throughTime"><i class="fa fa-minus" aria-hidden="true"></i></div>
                        <small class="form-text text-muted timeTextPlaceholder">Enter Class Start Time</small>
                    </div>

                    <!-- Enter the Class end time-->
                    <div class="col-sm-6 right-most time-div">
                        <div class="nativeTimePicker">
                            <input type="time" id="classEndTime" name="classEndTime" aria-describedby="endTimeHelp" placeholder="Enter End Time">
                        </div>
                        <div class="fallbackTimePicker">
                            <div class="col-xs-4 left-most">
                                <label for="hour">Hour:</label>
                                <div class="selectDropdown">
                                    <select class="hour" name="hour">
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <label for="minute">Minute:</label>
                                <div class="selectDropdown">
                                    <select class="minute" name="minute">
                                            </select>
                                </div>
                            </div>
                            <div class="col-xs-4 right-most">
                                <label for="minute">TOD:</label>
                                <div class="selectDropdown">
                                    <select class="TOD" name="TOD">
                                        <option>AM</option>
                                        <option>PM</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <small class="form-text text-muted timeTextPlaceholder">Enter Class End Time</small>
                    </div>
                </div>
            </div>

            <select name="ta">
              <?php
                include_once 'resources/library/db.php';
                #Look up all classes which are owned by the professor
                $taArray = db::query("SELECT firstName, lastName, email FROM user WHERE user_perm = 2;");

                #add option for no TA
                echo '<option value="0">No TA</option>';

                #loop through them
                foreach ($taArray as &$ta) {
                  echo '<option value="' . $ta[2] . '">' . $ta[0] . ' ' . $ta[1] . '</option>"';
                }
              ?>
            </select>

            <div class="form-group time-field">
                <label for="taHoursStartTime">TA Office Hours</label>
                <small class="form-text text-muted">(Select Days the TA has office Hours)</small>
                <div class="row">
                    <!--Monday check box-->
                    <div class="col-sm-dow left-most">
                        <label class="checkboxFullBox">
                        <input name="taMonday" type="checkbox" class="fullCheckbox" value="M">
                        <span class="checkboxText">Monday</span>
                        </label>
                    </div>
                    <!--Tuesday check Box-->
                    <div class="col-sm-dow">
                        <label class="checkboxFullBox">
                        <input name="taTuesday" type="checkbox" class="fullCheckbox" value="T">
                        <span class="checkboxText">Tuesday</span>
                        </label>
                    </div>
                    <!--Wednesday check Box-->
                    <div class="col-sm-dow">
                        <label class="checkboxFullBox">
                        <input name="taWednesday" type="checkbox" class="fullCheckbox" value="W">
                        <span class="checkboxText">Wednesday</span>
                        </label>
                    </div>
                    <!--Thursday check Box-->
                    <div class="col-sm-dow">
                        <label class="checkboxFullBox">
                        <input name="taThursday" type="checkbox" class="fullCheckbox" value="Tr">
                        <span class="checkboxText">Thursday</span>
                        </label>
                    </div>
                    <!--Friday check Box-->
                    <div class="col-sm-dow right-most">
                        <label class="checkboxFullBox">
                        <input name="taFriday" type="checkbox" class="fullCheckbox" value="F">
                        <span class="checkboxText">Friday</span>
                        </label>
                    </div>
                </div>
                <!--Enter the taHours start time-->
                <div class="row">
                    <div class="col-sm-6 left-most time-div">
                        <div class="nativeTimePicker">
                            <input type="time" id="taHoursStartTime" name="taHoursStartTime" aria-describedby="startTimeHelp" placeholder="Enter Start Time">
                        </div>
                        <div class="fallbackTimePicker">
                            <div class="col-xs-4 left-most">
                                <label for="hour">Hour:</label>
                                <div class="selectDropdown">
                                    <select class="hour" name="hour">
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <label for="minute">Minute:</label>
                                <div class="selectDropdown">
                                    <select class="minute" name="minute">
                                            </select>
                                </div>
                            </div>
                            <div class="col-xs-4 right-most">
                                <label for="minute">TOD:</label>
                                <div class="selectDropdown">
                                    <select class="TOD" name="TOD">
                                        <option>AM</option>
                                        <option>PM</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="throughTime"><i class="fa fa-minus" aria-hidden="true"></i></div>
                        <small class="form-text text-muted timeTextPlaceholder">Enter TA's Office Hours Start Time</small>
                    </div>

                    <!-- Enter the taHours end time-->
                    <div class="col-sm-6 right-most time-div">
                        <div class="nativeTimePicker">
                            <input type="time" id="taHoursEndTime" name="taHoursEndTime" aria-describedby="endTimeHelp" placeholder="Enter End Time">
                        </div>
                        <div class="fallbackTimePicker">
                            <div class="col-xs-4 left-most">
                                <label for="hour">Hour:</label>
                                <div class="selectDropdown">
                                    <select class="hour" name="hour">
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <label for="minute">Minute:</label>
                                <div class="selectDropdown">
                                    <select class="minute" name="minute">
                                            </select>
                                </div>
                            </div>
                            <div class="col-xs-4 right-most">
                                <label for="minute">TOD:</label>
                                <div class="selectDropdown">
                                    <select class="TOD" name="TOD">
                                        <option>AM</option>
                                        <option>PM</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <small class="form-text text-muted timeTextPlaceholder">Enter TA's Office Hours End Time</small>
                    </div>
                </div>
            </div>

            <div class="form-group time-field">
                <label for="profHoursStartTime">Professor Office Hours</label>
                <small class="form-text text-muted">(Select Days the Professor has office Hours)</small>
                <div class="row">
                    <!--Monday check box-->
                    <div class="col-sm-dow left-most">
                        <label class="checkboxFullBox">
                        <input name="profMonday" type="checkbox" class="fullCheckbox" value="M">
                        <span class="checkboxText">Monday</span>
                        </label>
                    </div>
                    <!--Tuesday check Box-->
                    <div class="col-sm-dow">
                        <label class="checkboxFullBox">
                        <input name="profTuesday" type="checkbox" class="fullCheckbox" value="T">
                        <span class="checkboxText">Tuesday</span>
                        </label>
                    </div>
                    <!--Wednesday check Box-->
                    <div class="col-sm-dow">
                        <label class="checkboxFullBox">
                        <input name="profWednesday" type="checkbox" class="fullCheckbox" value="W">
                        <span class="checkboxText">Wednesday</span>
                        </label>
                    </div>
                    <!--Thursday check Box-->
                    <div class="col-sm-dow">
                        <label class="checkboxFullBox">
                        <input name="profThursday" type="checkbox" class="fullCheckbox" value="Tr">
                        <span class="checkboxText">Thursday</span>
                        </label>
                    </div>
                    <!--Friday check Box-->
                    <div class="col-sm-dow right-most">
                        <label class="checkboxFullBox">
                        <input name="profFriday" type="checkbox" class="fullCheckbox" value="F">
                        <span class="checkboxText">Friday</span>
                        </label>
                    </div>
                </div>
                <!--Enter the Professor's start time-->
                <div class="row time-field">
                    <div class="col-sm-6 left-most time-div">
                        <div class="nativeTimePicker">
                            <input type="time" id="profHoursStartTime" name="profHoursStartTime" aria-describedby="startTimeHelp" placeholder="Enter Start Time">
                        </div>
                        <div class="fallbackTimePicker">
                            <div class="col-xs-4 left-most">
                                <label for="hour">Hour:</label>
                                <div class="selectDropdown">
                                    <select class="hour" name="hour">
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <label for="minute">Minute:</label>
                                <div class="selectDropdown">
                                    <select class="minute" name="minute">
                                            </select>
                                </div>
                            </div>
                            <div class="col-xs-4 right-most">
                                <label for="minute">TOD:</label>
                                <div class="selectDropdown">
                                    <select class="TOD" name="TOD">
                                        <option>AM</option>
                                        <option>PM</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="throughTime"><i class="fa fa-minus" aria-hidden="true"></i></div>
                        <small class="form-text text-muted timeTextPlaceholder">Enter Professor's Office Hours End Time</small>
                    </div>


                    <!-- Enter the Professor's end time-->
                    <div class="col-sm-6 right-most time-div">
                        <div class="nativeTimePicker">
                            <input type="time" id="profHoursEndTime" name="profHoursEndTime" aria-describedby="endTimeHelp" placeholder="Enter End Time">
                        </div>
                        <div class="fallbackTimePicker">
                            <div class="col-xs-4 left-most">
                                <label for="hour">Hour:</label>
                                <div class="selectDropdown">
                                    <select class="hour" name="hour">
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-4 right-most">
                                <label for="minute">Minute:</label>
                                <div class="selectDropdown">
                                    <select class="minute" name="minute">
                                            </select>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <label for="minute">TOD:</label>
                                <div class="selectDropdown">
                                    <select class="TOD" name="TOD">
                                        <option>AM</option>
                                        <option>PM</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <small class="form-text text-muted timeTextPlaceholder">Enter Professor's Office Hours End Time</small>
                    </div>
                </div>
            </div>
            <!--Syllabus Upload-->
            <label class="custom-file">Syllabus Upload
                <input type="file" id="syllabus" name="syllabus" class="custom-file-input">
            <span class="custom-file-control"></span>
            </label>
            <input type="submit" class="submit-button">
        </form>
    </div>
</div>


<script src="js/jquery.js"></script>
<script type="text/javascript" src="js/timeFallback.js"></script>

<?php }
  else {
    require_once("resources/library/db.php");
    #Search for existing class
    $searchArray = array(':profID'=>$_SESSION['user_id'], ':classCode'=>$_POST['classCode']);
    $searchResults = db::query("SELECT classID FROM class WHERE professorEmail = :profID AND classCode = :classCode;", $searchArray);
    if (!$searchResults[0]){
      #validate input
      #Operate on the input
      $classPeriod = $taHours = $profHours = "";
      #needs to be concatenated based on entry
      #There are 7 values to consider. The five days need to be correlated to a textual code, e.g. Monday = M
      if ($_POST["Monday"]){
        $classPeriod .= $_POST["Monday"];
        if ($_POST["Tuesday"] || $_POST["Wednesday"] || $_POST["Thursday"] || $_POST["Friday"]){
          $classPeriod .= '/';
        }
      }
      if ($_POST["Tuesday"]) {
        $classPeriod .= $_POST["Tuesday"];
        if ($_POST["Wednesday"] || $_POST["Thursday"] || $_POST["Friday"]){
          $classPeriod .= '/';
        }
      }
      if ($_POST["Wednesday"]) {
        $classPeriod .= $_POST["Wednesday"];
        if ($_POST["Thursday"] || $_POST["Friday"]){
          $classPeriod .= '/';
        }
      }
      if ($_POST["Thursday"]) {
        $classPeriod .= $_POST["Thursday"];
        if ($_POST["Friday"]){
          $classPeriod .= '/';
        }
      }
      if ($_POST["Friday"]) {
        $classPeriod .= $_POST["Friday"];
      }
    	#The times, should be outputted as a string, take the start time, and concatenate it to the end of the day code after a space
      $classPeriod = $classPeriod . " " . $_POST["classStartTime"] . " - " . $_POST["classEndTime"];
    	#Concatenate the end time to the start time with a dash and two spaces
      #TA hours manipulation
      if ($_POST["taMonday"]){
        $taHours .= $_POST["taMonday"];
        if ($_POST["taTuesday"] || $_POST["taWednesday"] || $_POST["taThursday"] || $_POST["taFriday"]){
          $taHours .= '/';
        }
      }
      if ($_POST["taTuesday"]) {
        $taHours .= $_POST["taTuesday"];
        if ($_POST["taWednesday"] || $_POST["taThursday"] || $_POST["taFriday"]){
          $taHours .= '/';
        }
      }
      if ($_POST["taWednesday"]) {
        $taHours = $taHours . $_POST["taWednesday"];
        if ($_POST["taThursday"] || $_POST["taFriday"]){
          $taHours .= '/';
        }
      }
      if ($_POST["taThursday"]) {
        $taHours = $taHours . $_POST["taThursday"];
        if ($_POST["taFriday"]){
          $taHours .= '/';
        }
      }
      if ($_POST["taFriday"]) {
        $taHours = $taHours . $_POST["taFriday"];
      }
      #create taHours variable the same way
      $taHours = $taHours . " " . $_POST["taHoursStartTime"] . " - " . $_POST["taHoursEndTime"];
      #create profHours
      #TA input
      if ($_POST["profMonday"]){
        $profHours = $profHours . $_POST["profMonday"];
        if ($_POST["profTuesday"] || $_POST["profWednesday"] || $_POST["profThursday"] || $_POST["profFriday"]){
          $profHours .= '/';
        }
      }
      if ($_POST["profTuesday"]) {
        $profHours = $profHours . $_POST["profTuesday"];
        if ($_POST["profWednesday"] || $_POST["profThursday"] || $_POST["profFriday"]){
          $profHours .= '/';
        }
      }
      if ($_POST["profWednesday"]) {
        $profHours = $profHours . $_POST["profWednesday"];
        if ($_POST["profThursday"] || $_POST["profFriday"]){
          $profHours .= '/';
        }
      }
      if ($_POST["profThursday"]) {
        $profHours = $profHours . $_POST["profThursday"];
        if ($_POST["profFriday"]){
          $profHours .= '/';
        }
      }
      if ($_POST["profFriday"]) {
        $profHours = $profHours . $_POST["profFriday"];
      }
      print_r ($_POST["profHoursStartTime"]);
      print_r($_POST["profHoursEndTime"]);
      $profHours = $profHours . " " . $_POST["profHoursStartTime"] . " - " . $_POST["profHoursEndTime"];
      # create if not exists clause
      #if exists, throw a SQL exception
      #catch block handles sql exception
      #catch block updates the form and clears the post stream
      #create new class element
      #create submission array for class update
      $submit = array(':className' => $_POST["className"],
                      ":classCode"=>$_POST["classCode"],
                      ":classLocation"=>$_POST["classLocation"],
                      ":classPeriod"=>$classPeriod,
                      ":taHours"=>$taHours,
                      ":profID"=>$_SESSION["user_id"],
                      ":taID"=>$_POST['ta'],
                      ":profHours"=>$profHours,
                      ":classDescription"=>$_POST["classDescription"]);
      #submit the array to the database
      db::query("SET FOREIGN_KEY_CHECKS=0;
                INSERT INTO class (className, classCode, room, classTime, taHours, professorEmail, taEmail, instructorHours, classDescription)
                VALUES (:className, :classCode, :classLocation, :classPeriod, :taHours, :profID, :taID, :profHours, :classDescription)", $submit);
      #Create professor entry for the class in user_class
      #Get max class ID of last class entered
      $classID = db::query("SELECT MAX(classID) from class");
      if ($_POST['ta'] != "0"){
        #creates update variable list for user_class query
        $userUpdate = array(':profID'=>$_SESSION["user_id"],
                            ':profRole'=>"3",
                            ":profClassID"=>$classID[0][0],
                            ':taID'=>$_POST['ta'],
                            ':taRole'=>'2',
                            ':taClassID'=>$classID[0][0]);
        #create ta and professor in database
        db::query("SET FOREIGN_KEY_CHECKS=0;
                  INSERT INTO user_class (user_email, role, class_classID) VALUES (:profID, :profRole, :profClassID);
                  INSERT INTO user_class (user_email, role, class_classID) VALUES (:taID, :taRole, :taClassID);", $userUpdate);
      }
      else{
        #creates update variable list for user_class query
        $profUpdate = array(':profID'=>$_SESSION["user_id"],
                            ':profRole'=>"3",
                            ":profClassID"=>$classID[0][0]);
        #create ta and professor in database
        db::query("SET FOREIGN_KEY_CHECKS=0;
                  INSERT INTO user_class (user_email, role, class_classID) VALUES (:profID, :profRole, :profClassID);", $profUpdate);
      }
      #Syllabus upload
      $uploaddir = 'ClassObject/Syllabus/';
      $uploadfile = $uploaddir . basename($_FILES['syllabus']['name']);
      if (move_uploaded_file($_FILES['syllabus']['tmp_name'], $uploadfile)){
        echo "Success! File can be found at $uploadfile</br>";
      }
      else{
        echo (basename($_FILES['syllabus']['tmp_name']) . " Not Uploaded!");
      }
      $url = 'Syllabus/' . basename($_FILES['syllabus']['name']);
      $array = array(':URL'=>$url, ':classID'=>$classID[0][0]);
      db::query("SET FOREIGN_KEY_CHECKS=0; UPDATE class SET syllabusURL= :URL WHERE classID = :classID;", $array);
      #Create class file
      $classCode = $_POST["classCode"];
      $file = "${classCode}.php";
      if (!file_exists($file)){
        $key_array = db::query("SELECT MAX(classID) from class");
        var_dump($key_array);
        $class_key = $key_array[0][0];
        $contents = '<?php $currentClass = ';
          $contents .= $class_key;
          $contents .= '; include "class.php";?>';
        file_put_contents($file, $contents, LOCK_EX);
      }
      else{
        echo '<br>Class Not Created<br>';
      }
      #redirect
      header("Location: ${classCode}.php");
    }
    else{
      #redirect
      header("Location: classForm.php");
      #FRAAAAAAANK Can you cause this to spit out a warning saying that the class already exists?
      #echo "Class Already Exists Dummy!";
    }
  }
  include 'templates/footer.php';
?>

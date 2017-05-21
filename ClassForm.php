<?php include 'templates/header.php'; ?>
<?php if ($_SERVER['REQUEST_METHOD'] == 'GET') { ?>
  <html>
  <body>
    <div class="row">
      <div class="col-md-12">
        <form action="<?php echo htmlentities($_SERVER['SCRIPT_NAME']) ?>" enctype="multipart/form-data" method="post">
          <!--Class Name Input-->
          <div class="form-group">
            <label for="className">Class Name</label>
            <input type="text" class="form-control" name="className" placeholder="Enter Class Name">
          </div>

          <!-- Class Code Input-->
          <div class="form-group">
            <label for="className">Class Code</label>
            <input type="text" class="form-control" name="classCode" aria-describedby="idHelp" placeholder="Enter Class Code">
            <small id="idHelp" class="form-text text-muted">ID should be in form: Department Code Class Code (e.g. "CSCI105")</small>
          </div>

          <!--Class Location Input-->
          <div class="form-group">
            <label for="classLocation">Class Location</label>
            <input type="text" class="form-control" name="classLocation" aria-describedby="locationHelp" placeholder="Enter Class Location">
            <small id="locationHelp" class="form-text text-muted">Location should be in form: Building "space" Room Number (e.g. "Library 141")</small>
          </div>

          <!-- Class Description Input-->
          <div class="form-group">
            <label for="exampleTextarea">Class Description</label>
            <textarea class="form-control" id="classDescription" name="classDescription" rows="3"></textarea>
          </div>

          <!--Class Period input-->
          <div class="form-group">
            <label for="classTime">Class Period</label>
            <div class="row">
              <!--Monday check box-->
              <label class="custom-control custom-checkbox-inline">
                <input name="Monday" type="checkbox" class="custom-control-input" value="M">
                <span class="custom-control-description">Monday</span>
                <span class="custom-control-indicator"></span>
              </label>
              <!--Tuesday check Box-->
              <label class="custom-control custom-checkbox-inline">
                <input name="Tuesday" type="checkbox" class="custom-control-input" value="T">
                <span class="custom-control-description">Tuesday</span>
                <span class="custom-control-indicator"></span>
              </label>
              <!--Wednesday check Box-->
              <label class="custom-control custom-checkbox-inline">
                <input name="Wednesday" type="checkbox" class="custom-control-input" value="W">
                <span class="custom-control-description">Wednesday</span>
                <span class="custom-control-indicator"></span>
              </label>
              <!--Thursday check Box-->
              <label class="custom-control custom-checkbox-inline">
                <input name="Thursday" type="checkbox" class="custom-control-input" value="Tr">
                <span class="custom-control-description">Thursday</span>
                <span class="custom-control-indicator"></span>
              </label>
              <!--Friday check Box-->
              <label class="custom-control custom-checkbox-inline">
                <input name="Friday" type="checkbox" class="custom-control-input" value="F">
                <span class="custom-control-description">Friday</span>
                <span class="custom-control-indicator"></span>
              </label>
            </div>

            <!--Enter the class start time-->
            <input class="form-control" type="time" id="classStartTime" name="classStartTime" aria-describedby="startTimeHelp">
            <small id="startTimeHelp" class="form-text text-muted">Enter Class Start Time</small>

            <!-- Enter the Class end time-->
            <input class="form-control" type="time" id="classEndTime" name="classEndTime" aria-describedby="endTimeHelp">
            <small id="endTimeHelp" class="form-text text-muted">Enter Class End Time</small>
          </div>

          <div class="form-group">
            <label for="taHoursStartTime">TA Office Hours</label>
            <div class="row">
              <!--Monday check box-->
              <label class="custom-control custom-checkbox-inline">
                <input name="taMonday" type="checkbox" class="custom-control-input" value="M">
                <span class="custom-control-description">Monday</span>
                <span class="custom-control-indicator"></span>
              </label>
              <!--Tuesday check Box-->
              <label class="custom-control custom-checkbox-inline">
                <input name="taTuesday" type="checkbox" class="custom-control-input" value="T">
                <span class="custom-control-description">Tuesday</span>
                <span class="custom-control-indicator"></span>
              </label>
              <!--Wednesday check Box-->
              <label class="custom-control custom-checkbox-inline">
                <input name="taWednesday" type="checkbox" class="custom-control-input" value="W">
                <span class="custom-control-description">Wednesday</span>
                <span class="custom-control-indicator"></span>
              </label>
              <!--Thursday check Box-->
              <label class="custom-control custom-checkbox-inline">
                <input name="taThursday" type="checkbox" class="custom-control-input" value="Tr">
                <span class="custom-control-description">Thursday</span>
                <span class="custom-control-indicator"></span>
              </label>
              <!--Friday check Box-->
              <label class="custom-control custom-checkbox-inline">
                <input name="taFriday" type="checkbox" class="custom-control-input" value="F">
                <span class="custom-control-description">Friday</span>
                <span class="custom-control-indicator"></span>
              </label>
            </div>
            <!--Enter the taHours start time-->
            <input class="form-control" type="time" id="taHoursStartTime" name="taHoursStartTime" aria-describedby="startTimeHelp">
            <small id="startTimeHelp" class="form-text text-muted">Enter TA Office Hours Start Time</small>

            <!-- Enter the taHours end time-->
            <input class="form-control" type="time" id="taHoursEndTime" name="taHoursEndTime" aria-describedby="endTimeHelp">
            <small id="endTimeHelp" class="form-text text-muted">Enter TA Office Hours End Time</small>
          </div>

          <div class="form-group">
            <label for="profHoursStartTime">Professor Office Hours</label>
            <div class="row">
              <!--Monday check box-->
              <label class="custom-control custom-checkbox-inline">
                <input name="profMonday" type="checkbox" class="custom-control-input" value="M">
                <span class="custom-control-description">Monday</span>
                <span class="custom-control-indicator"></span>
              </label>
              <!--Tuesday check Box-->
              <label class="custom-control custom-checkbox-inline">
                <input name="profTuesday" type="checkbox" class="custom-control-input" value="T">
                <span class="custom-control-description">Tuesday</span>
                <span class="custom-control-indicator"></span>
              </label>
              <!--Wednesday check Box-->
              <label class="custom-control custom-checkbox-inline">
                <input name="profWednesday" type="checkbox" class="custom-control-input" value="W">
                <span class="custom-control-description">Wednesday</span>
                <span class="custom-control-indicator"></span>
              </label>
              <!--Thursday check Box-->
              <label class="custom-control custom-checkbox-inline">
                <input name="profThursday" type="checkbox" class="custom-control-input" value="Tr">
                <span class="custom-control-description">Thursday</span>
                <span class="custom-control-indicator"></span>
              </label>
              <!--Friday check Box-->
              <label class="custom-control custom-checkbox-inline">
                <input name="profFriday" type="checkbox" class="custom-control-input" value="F">
                <span class="custom-control-description">Friday</span>
                <span class="custom-control-indicator"></span>
              </label>
            </div>
            <!--Enter the taHours start time-->
            <input class="form-control" type="time" id="profHoursStartTime" name="profHoursStartTime" aria-describedby="startTimeHelp">
            <small id="startTimeHelp" class="form-text text-muted">Enter Professor Office Hours Start Time</small>

            <!-- Enter the taHours end time-->
            <input class="form-control" type="time" id="profHoursEndTime" name="profHoursEndTime" aria-describedby="endTimeHelp">
            <small id="endTimeHelp" class="form-text text-muted">Enter Professor Office Hours End Time</small>
          </div>
          <!--Syllabus Upload-->
          <label class="custom-file">Syllabus Upload
            <input type="file" id="syllabus" name="syllabus" class="custom-file-input">
            <span class="custom-file-control"></span>
          </label>
          <input type="submit">
        </form>
      </div>
    </div>
  </body>
</html>

<?php }
  else {
    require_once("resources/library/db.php");

    #validate input

    #Operate on the input
    $classPeriod = $taHours = $profHours = "";
    #needs to be concatenated based on entry
    #There are 7 values to consider. The five days need to be correlated to a textual code Monday = M
    if ($_POST["Monday"]){
      $classPeriod = $classPeriod . $_POST["Monday"];
    }
    if ($_POST["Tuesday"]) {
      $classPeriod = $classPeriod . $_POST["Tuesday"];
    }
    if ($_POST["Wednesday"]) {
      $classPeriod = $classPeriod . $_POST["Wednesday"];
    }
    if ($_POST["Thursday"]) {
      $classPeriod = $classPeriod . $_POST["Thursday"];
    }
    if ($_POST["Friday"]) {
      $classPeriod = $classPeriod . $_POST["Friday"];
    }
  	#The times, should be outputted as a string, take the start time, and concatenate it to the end of the day code after a space
    $classPeriod = $classPeriod . " " . $_POST["classStartTime"] . " - " . $_POST["classEndTime"];
  	#Concatenate the end time to the start time with a dash and two spaces

    #TA input
    if ($_POST["taMonday"]){
      $taHours = $taHours . $_POST["taMonday"];
    }
    if ($_POST["taTuesday"]) {
      $taHours = $taHours . $_POST["taTuesday"];
    }
    if ($_POST["taWednesday"]) {
      $taHours = $taHours . $_POST["taWednesday"];
    }
    if ($_POST["taThursday"]) {
      $taHours = $taHours . $_POST["taThursday"];
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
    }
    if ($_POST["profTuesday"]) {
      $profHours = $profHours . $_POST["profTuesday"];
    }
    if ($_POST["profWednesday"]) {
      $profHours = $profHours . $_POST["profWednesday"];
    }
    if ($_POST["profThursday"]) {
      $profHours = $profHours . $_POST["profThursday"];
    }
    if ($_POST["profFriday"]) {
      $profHours = $profHours . $_POST["profFriday"];
    }

    $profHours = $profHours . " " . $_POST["profHoursStartTime"] . " - " . $_POST["profHoursEndTime"];

    # create if not exists clause
    #if exists, throw a SQL exception
    #catch block handles sql exception
    #catch block updates the form and clears the post stream

    #create new class element
    #create submission array for class update
    $submit = array(':className' => $_POST["className"], ":classCode"=>$_POST["classCode"], ":classLocation"=>$_POST["classLocation"], ":classPeriod"=>$classPeriod, ":taHours"=>$taHours, ":profID"=>$_SESSION["user_id"], ":profHours"=>$profHours, ":classDescription"=>$_POST["classDescription"]);

    #submit the array to the database
    db::query("SET FOREIGN_KEY_CHECKS=0;
              INSERT INTO class (className, classCode, room, classTime, taHours, professorEmail, instructorHours, classDescription)
              VALUES (:className, :classCode, :classLocation, :classPeriod, :taHours, :profID, :profHours, :classDescription)", $submit);


    #Create professor entry for the class in user_class
    #Get max class ID of last class entered
    $classID = db::query("SELECT MAX(classID) from class");

    echo "</br>" . $classID[0][0] . "</br>";
    #creates update variable list for user_class query
    $userUpdate = array(':userID'=>$_SESSION["user_id"], ':role'=>"3", ":classID"=>$classID[0][0]);

    #user_class query
    db::query("SET FOREIGN_KEY_CHECKS=0; INSERT INTO user_class (user_email, role, class_classID) VALUES (:userID, :role, :classID)", $userUpdate);


    #Syllabus upload
    $uploaddir = 'ClassObject/Syllabus/';
    $uploadfile = $uploaddir . basename($_FILES['syllabus']['name']);

    if (move_uploaded_file($_FILES['syllabus']['tmp_name'], $uploadfile)){
      echo "Success! File can be found at $uploadfile</br>";
    }
    else{
      echo (basename($_FILES['syllabus']['tmp_name']) . " Not Uploaded!");
    }
    print_r($classID[0][0]);

    $url = 'Syllabus/' . basename($_FILES['syllabus']['name']);
    $array = array(':URL'=>$url, ':classID'=>$classID[0][0]);
    db::query("SET FOREIGN_KEY_CHECKS=0; UPDATE class SET syllabusURL= :URL WHERE classID = :classID;", $array);

    #Create class file

    $classCode = $_POST["classCode"];

    $file = "ClassObject\\${classCode}.php";
    if (!file_exists($file)){
      echo $file;

      $key_array = db::query("SELECT MAX(classID) from class");
      var_dump($key_array);

      $class_key = $key_array[0][0];

      $contents = '<?php $currentClass = ';
        $contents .= $class_key;
        $contents .= '; include "../templates/class.php";?>';

      file_put_contents($file, $contents, LOCK_EX);
    }

    else{
      echo '<br>Class Not Created<br>';
    }
  }
  include 'templates/footer.php';;
?>

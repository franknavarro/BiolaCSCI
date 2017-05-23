<?php include "templates/virtual-header.php";?>

<!--Load jQuery First and Foremost -->
<script type="text/javascript" src="js/jquery.js"></script>


<!-- Load Base CodeMirror JS File -->
<script src="/resources/codemirror-5.25.2/lib/codemirror.js"></script>
<!-- Load Base CodeMirror Stylesheet -->
<link rel="stylesheet" href="/resources/codemirror-5.25.2/lib/codemirror.css">
<link rel="stylesheet" href="/resources/codemirror-5.25.2/addon/hint/show-hint.css">
<!-- Load C type Language Files -->
<script type="text/javascript" src="/resources/codemirror-5.25.2/mode/clike/clike.js"></script>
<!-- Load CodeMirrors Addon Files -->
<script type="text/javascript" src="/resources/codemirror-5.25.2/addon/selection/active-line.js"></script>
<script type="text/javascript" src="/resources/codemirror-5.25.2/addon/edit/matchbrackets.js"></script>
<script type="text/javascript" src="/resources/codemirror-5.25.2/addon/edit/closebrackets.js"></script>
<script type="text/javascript" src="/resources/codemirror-5.25.2/addon/hint/show-hint.js"></script>


<!-- Load Stylesheet Specifically for Code Sharing -->
<link rel="stylesheet" type="text/css" href="css/classroom.css">


<!-- Load TogetherJS for Screen Sharing -->
<iframe src ="resources/firepad.html"></iframe> 
<!-- Get the username for current user using PHP and JS -->
<script type="text/javascript">
    TogetherJSConfig_getUserName = function(){
        return '<?php echo $_SESSION['user_fName']; ?>';
    };
</script>


<!-- Code Languages Select Dropdown List -->
<div id="langContainer">
    <div id="langLabel">Current Language: </div>
    <div class="selectDropdown">
        <select id="langSelector">
            <option value="text/x-csrc">C</option>
            <option value="text/x-c++src" selected="selected">C++</option>
            <option value="text/x-objectivecsrc">Objective-C</option>
            <option value="text/css">CSS</option>
            <option value="django">Django</option>
            <option value="htmlmixed">HTML/XML</option>
            <option value="text/x-javasrc">Java</option>
            <option value="text/javascript">JavaScript</option>
            <option value="application/json">JSON</option>
            <option value="text/x-lesscss">LESS</option>
            <option value="text/x-mariadb">MySQL</option>
            <option value="application/x-httpd-php">PHP</option>
            <option value="text/x-python">Python</option>
            <option value="text/x-scss">SCSS</option>
        </select>
    </div>
</div>

<!-- Virtual WhiteBoard -->
<textarea id="classroom-code"></textarea>


<!-- Load Screen Sharing JS -->
<script type="text/javascript" src="js/code-collab.js"></script>

<!-- Load CodeMirror Languages -->
<script type="text/javascript" src="/resources/codemirror-5.25.2/mode/htmlmixed/htmlmixed.js"></script>
<script type="text/javascript" src="/resources/codemirror-5.25.2/mode/css/css.js"></script>
<script type="text/javascript" src="/resources/codemirror-5.25.2/mode/javascript/javascript.js"></script>
<script type="text/javascript" src="/resources/codemirror-5.25.2/mode/xml/xml.js"></script>
<script type="text/javascript" src="/resources/codemirror-5.25.2/mode/vbscript/vbscript.js"></script>
<script type="text/javascript" src="/resources/codemirror-5.25.2/mode/python/python.js"></script>
<script type="text/javascript" src="/resources/codemirror-5.25.2/mode/php/php.js"></script>
<script type="text/javascript" src="/resources/codemirror-5.25.2/mode/sql/sql.js"></script>
<script type="text/javascript" src="/resources/codemirror-5.25.2/mode/django/django.js"></script>

<!-- CodeMirror Less Important Addon Files -->
<script type="text/javascript" src="/resources/codemirror-5.25.2/addon/edit/closetag.js"></script>
<script type="text/javascript" src="/resources/codemirror-5.25.2/addon/edit/matchtags.js"></script>
<script type="text/javascript" src="/resources/codemirror-5.25.2/addon/hint/anyword-hint.js"></script>
<script type="text/javascript" src="/resources/codemirror-5.25.2/addon/hint/css-hint.js"></script>
<script type="text/javascript" src="/resources/codemirror-5.25.2/addon/hint/html-hint.js"></script>
<script type="text/javascript" src="/resources/codemirror-5.25.2/addon/hint/javascript-hint.js"></script>
<script type="text/javascript" src="/resources/codemirror-5.25.2/addon/hint/sql-hint.js"></script>
<script type="text/javascript" src="/resources/codemirror-5.25.2/addon/hint/sql-hint.js"></script>


<!-- Close off HTML File with Footer -->
<?php include "templates/footer.php";?>

<!-- Modal for Attendance -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Attendance</h4>
      </div>
      <div class="modal-body">
          <div>
              <form role="form" action="classroom.php" method="post">
                  <fieldset>
                    <p> Please enter the class ID number </p>
                    <input type="text" placeholder="Class ID" name="classID" required/>
                    <br><br>
                    <p> Please Enter Classroom URL: </p>
                    <input type="text" placeholder="Class URL" name="classURL" required/>
                    <br><br>
                    <input type="submit" class="submit-button">
                  </fieldset>
              </form>

              <?php
              include 'resources/library/attendance.php';
              if(isset($_POST['classID'])){
                  $classRole = db::query("SELECT role from user_class where user_email=:user_id", array(':user_id'=>$_SESSION['user_id']));
                  if(print_r($classRole[0]['role'], true) == "3"){
                      echo "Attendance Code: ";
                      $attendanceCode = attendance::createSession($_POST['classID'], $_SESSION['user_id'], $_POST['classURL']);
                      echo $attendanceCode;
                      $sessionIDQuery = db::query("SELECT sessionID from session where sessionKey=:attendanceCode", array(':attendanceCode'=>$attendanceCode));
                      $_SESSION['session_id'] = print_r($sessionIDQuery[0]['sessionID'], true);

                  } else {
                      echo "Error: The user is not a teacher in the class";
                  }
              }
               ?>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

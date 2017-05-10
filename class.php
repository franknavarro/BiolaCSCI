<?php include 'templates/header.php'; ?>

<?php
$currentClass;
 ?>


 <!-- Update class title and ID here
include '../resources/library/db.php';
$currentClass = $_COOKIE["currentClass"];
$classQuery = "SELECT classCode, className, room, classTime, syllabusURL, professorID, instructorHours,  FROM 'cscidb'.'class' WHERE classID = $currentClass";
$profQuery = "SELECT firstName, lastName, email FROM 'cscidb'.'user' WHERE ??????";
****** professorID means what? how do I use this to query the user class? *****
$taQuery = "SELECT firstName, lastName, email FROM 'cscidb'.'user' WHERE ?????";
****** How do are we signifying the who the TA is? *****
$assQuery = "SELECT name, description, dueDate, postTime FROM 'cscidb'.'assignment' WHERE classID = $currentClass";
$annQuery = "SELECT name, description, postTime, user_email FROM 'cscidb'.'announcement' WHERE classID = $currentClass";

$classResult = db::query($nameCodeQuery);
$profResult = db::query($profQuery);
$taResult = db::query($taQuery);
$assResults = db::query($assQuery);
$annResults = db::query($annQuery);



$header = $result->fetch_assoc();
" . $header["className"]. "
" . $header["classCode"]. "
-->

    <div id="class-page">
            <div class="row">
                <div class="col-sm-8 class-header-container">

                    <!-- Update class title and ID here -->
                    <div class="class-header">
                        <h3>Introduction to Computer Science</h3>
                        <label>CSCI 105</label>
                    </div>

                    <!-- Add links that loads relavent content into div.class-deatils below -->
                    <div class="class-navigation">
                        <div class="col-xs-4">
                            <button class="default-button class-nav-button active-button" id="class-info-button">General</button>
                        </div>
                        <div class="col-xs-4">
                            <button class="default-button class-nav-button" id="class-announcements-button">Announcements</button>
                        </div>
                        <div class="col-xs-4">
                            <button class="default-button class-nav-button" id="class-assignments-button">Assignments</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8 class-content">
                    <!--Here is where you would load the class information details. When you click General, Announcements, or Assignments above this div container shows the information needed -->
                    <div class="class-details">
                        <!-- Use PHP to update all relevant values -->

    <!-------------------------------------------------------GENERAL CLASS INFORMATION SECTION
    -------------------------------------------------------->
    <div id="class-info-page" class="class-section" style="display:block;">
        <h4 class="cinfo-header">Class Information</h4>
        <p><strong>Location: </strong>
            <!-- Pull Class Location from database here -->
            Library 141
        </p>
        <p><strong>Class Time: </strong>
            <!-- Pull Class Time from database here -->
            3:00-4:15pm M/W
        </p>
        <!-- Change href to location of syllabus saved in database -->
        <p><a href="course-syllabus">Course Syllabus</a></p>
        <h4 class="cinfo-header">Professor Information</h4>
        <h5 class="cinfo-header sub-header">
            <!-- Pull Professor Name from database here -->
            Dr. Sheui-Hong Lin
        </h5>
        <p><strong>Email: </strong>
            <!-- Change href="" to hold professors email in between the quotations -->
            <a href="mailto:shieu-hong.lin@biola.edu">shieu-hong.lin@biola.edu</a>
        </p>
        <p><strong>Office Hours: </strong>
            <!-- Pull Office Hours for class from database here -->
            4:00-5:00pm T/Th
        </p>
        <h4 class="cinfo-header">TA Information</h4>
        <h5 class="cinfo-header sub-header">
            <!-- Get TA Name from database here -->
            Alex Patton
        </h5>
        <p><strong>Email: </strong>
            <!-- Change href="" to hold TA's email in between the quotations -->
            <a href="mailto:alex.j.patton@biola.edu"> alex.j.patton@biola.edu</a>
        </p>
        <p><strong>TA Hours: </strong>
            <!-- Pull TA Office Hours from database here -->
            12:00-1:15pm M/W
        </p>
    </div>



    <!-------------------------------------------------------ALL ASSIGNMENTS SECTION
    -------------------------------------------------------->

    <div id="class-assignments-page" class="class-section">

        <!-- PAST ASSIGNMENTS -->

        <div id="past-assignments" class="dropdown keep-open open">
            <button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Past Assignments
            </button>
            <div class="dropdown-menu assingments-dropdown" aria-labelledby="dropdownMenuButton">

                <!-- Use PHP to loop through and display all assignments where the due-date is SMALLER than today's date -->
                <!-- Assignment Format Begins Here -->
                <!-- Change id to be formatted as "list-assignment-idnumber" Changing idnumber to be the assignments id within the database-->
                <div class="assignment" id="list-assignment-idnumber">
                    <div class="row">
                        <div class="col-xs-12">
                            <h4 class="title">
                                <!--Pull Title of the Assignment from the database here -->
                                Lab #1
                            </h4>
                            <div class="due-date"><strong>Due </strong>
                                <!-- Pull the Due Date of the Assignment from the database here -->
                                April 30 at 11:30pm
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Assignment Format Ends here -->
                <!-- Loop back to top or end loop if no more assignments meet the loops condition here -->



                <!-- Bellow are just examples of how the previous-assignments should look -->

                <!-- GO TO UPCOMING-ASSIGNMENTS -->

                <!-- EXAMPLES -->
                <div class="assignment" id="list-assignment-idnumber">
                    <div class="row">
                        <div class="col-xs-12">
                            <h4 class="title">Lab #2</h4>
                            <div class="due-date"><strong>Due </strong>April 31 at 11:30pm</div>
                        </div>
                    </div>
                </div>
                <div class="assignment" id="list-assignment-idnumber">
                    <div class="row">
                        <div class="col-xs-12">
                            <h4 class="title">Lab #3</h4>
                            <div class="due-date"><strong>Due </strong>April 32 at 11:30pm</div>
                        </div>
                    </div>
                </div>
                <!-- END OF EXAMPLES -->

            </div> <!-- End of dropdown -->
        </div> <!-- End of past assignments -->



        <!-- UPCOMING ASSIGNMENTS -->

        <div id="upcoming-assignments" class="dropdown keep-open open">
            <button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Upcoming Assignments
            </button>
            <div class="dropdown-menu assingments-dropdown" aria-labelledby="dropdownMenuButton">
                <!-- Use PHP to loop through and display all assignments where the due-date is LARGER than today's date -->
                <!-- Assignment Format Begins Here -->
                <!-- Change id to be formatted as "list-assignment-idnumber" Changing idnumber to be the assignments id within the database-->
                <div class="assignment" id="list-assignment-idnumber">
                    <div class="row">
                        <div class="col-xs-12">
                            <h4 class="title">
                                <!--Pull Title of the Assignment from the database here -->
                                Lab #4
                            </h4>
                            <div class="due-date"><strong>Due </strong>
                                <!-- Pull the Due Date of the Assignment from the database here -->
                                April 30 at 11:30pm
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Assignment Format Ends here -->
                <!-- Loop back to top or end loop if no more assignments meet the loops condition here -->



                <!-- Bellow are just more examples of how the upcoming-assignments should look -->
                <!-- EXAMPLES -->
                <div class="assignment" id="list-assignment-idnumber">
                    <div class="row">
                        <div class="col-xs-12">
                            <h4 class="title">Lab #5</h4>
                            <div class="due-date"><strong>Due </strong>April 31 at 11:30pm</div>
                        </div>
                    </div>
                </div>
                <div class="assignment" id="list-assignment-idnumber">
                    <div class="row">
                        <div class="col-xs-12">
                            <h4 class="title">Lab #6</h4>
                            <div class="due-date"><strong>Due </strong>April 32 at 11:30pm</div>
                        </div>
                    </div>
                </div>
                <!-- END OF EXAMPLES -->

            </div><!-- End of dropdown -->
        </div> <!-- End of upcoming assignments -->
    </div> <!-- End of assignments container -->



    <!-------------------------------------------------------INDIVIDUAL ASSIGNMENTS SECTION
    -------------------------------------------------------->

    <!-- Use PHP to loop through all assignments and Format them as below -->
    <!-- Use PHP to format id value to be "assign-1234" -->
    <!-- Changing the 1234 to whatever the assignments id is in the database -->
    <div class="assignment-single class-section" id="assignment-idnumber">
        <h2 class="title">
            <!-- Pull Assignment Title from database here -->
            Title
        </h2>

        <hr style="margin-top:10px;">

        <h5><strong>Due </strong><span class="due-date">
            <!-- Pull Assignment Due Date from database here -->
            April 30, 2017
        </span></h5>

        <h5><strong>URL/File: </strong>
            <!-- Change in between quotes of href="" to load the relevant link or file link for the homework assignment as stored in database -->
            <a class="url-file" target="_blank" href="http://heeeeeeeey.com/">Homework Reading Website</a>
        </h5>

        <hr>

        <p class="assignment-description">
            <!-- Pull Assignment Description from database here -->
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sit amet quam lacinia, scelerisque lorem tempus, facilisis dolor. Vivamus elementum nisl at viverra blandit. Sed ultrices lacinia diam, vitae dapibus urna. Duis id purus viverra, vestibulum purus vitae, bibendum ex. Donec eleifend lobortis libero, vel malesuada nunc elementum vel. Phasellus elit ante, accumsan eu auctor quis, cursus vitae sapien. Aliquam malesuada erat enim, ut ullamcorper eros aliquam eget. Curabitur venenatis quam sit amet est bibendum ultricies.
        </p>
    </div>


    <!-------------------------------------------------------ALL ANNOUNCEMENTS SECTION
    -------------------------------------------------------->

    <div id="class-announcements-page" class="class-section">

        <!-- Loop through and display all announcements for the class -->
        <!-- Change id to be formatted as "list-announcement-idnumber" Changing idnumber to be the assignments id within the database-->
        <div class="announcement" id="list-announcement-idnumber">
            <div class="row">
                <div class="col-xs-12 ann-content">
                    <h4 class="title">
                        <!-- Pull Announcement Title from database  here -->
                        Title
                    </h4>
                    <h5 class="author">
                        <!-- Pull Announcement Author from database here -->
                        Author
                    </h5>
                    <p class="message">
                        <!-- Pull a 100 character snipit of the content of the announcement from the database here -->
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc lobortis metus mi, et fringilla metus.
                    </p>
                </div>
            </div>
        </div>

        <!-- All announcements follow the above fromat with all tags and classes-->
        <!-- Bellow are just examples of how the announcements should look -->

        <!-- EXAMPLES -->
        <div class="announcement" id="list-announcement-idnumber">
            <div class="row">
                <div class="col-xs-12 ann-content">
                    <h4 class="title">Title</h4>
                    <h5 class="author">Author</h5>
                    <p class="message">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer pellentesque pulvinar dui. Vivamus commodo finibus nunc, pretium commodo felis ultrices.</p>
                </div>
            </div>
        </div>
        <div class="announcement" id="list-announcement-idnumber">
            <div class="row">
                <div class="col-xs-12 ann-content">
                    <h4 class="title">Title</h4>
                    <h5 class="author">Author</h5>
                    <p class="message">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer pellentesque pulvinar dui. Vivamus commodo finibus nunc, pretium commodo felis ultrices.</p>
                </div>
            </div>
        </div>
        <!-- END OF EXAMPLES -->

    </div> <!-- End of Announcements page -->


    <!-------------------------------------------------------SINGLE ANNOUNCEMENTS SECTION
    -------------------------------------------------------->

    <!-- Use PHP to loop through all assignments and Format them as below -->
    <!-- Use PHP to format id value to be assign-1234 -->
    <!-- Changing the 1234 to whatever the assignments id is in the database -->
    <div class="announcement-single class-section" id="announcement-idnumber">
        <h3 class="title">
            <!-- Pull Announcement Title from database here -->
            Title
        </h3>
        <h5 class="author">
            <!-- Pull Announcement Author from database here -->
            Author
        </h5>
        <p class="message">
            <!-- Pull Announcement Message Content from database here -->
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sit amet quam lacinia, scelerisque lorem tempus, facilisis dolor. Vivamus elementum nisl at viverra blandit. Sed ultrices lacinia diam, vitae dapibus urna. Duis id purus viverra, vestibulum purus vitae, bibendum ex. Donec eleifend lobortis libero, vel malesuada nunc elementum vel. Phasellus elit ante, accumsan eu auctor quis, cursus vitae sapien. Aliquam malesuada erat enim, ut ullamcorper eros aliquam eget. Curabitur venenatis quam sit amet est bibendum ultricies.

            Ut ornare velit eget elit suscipit lobortis. Nunc faucibus, ex in vehicula euismod, mauris turpis pretium risus, id tempus felis elit vulputate felis. Nam varius turpis eget quam semper, in bibendum leo tristique. Nullam sit amet mi et neque mollis rhoncus facilisis id justo. Suspendisse nec porttitor metus. Vestibulum efficitur nisi in ante eleifend, eget ultrices dui interdum. Duis non tellus eget magna scelerisque imperdiet sit amet et arcu. Donec eget arcu sit amet massa cursus euismod a sed est. Maecenas luctus tempus auctor. Sed hendrerit eleifend libero et bibendum. Ut ac vulputate velit. Nunc non lacus enim. Curabitur a laoreet nisl, in faucibus erat. Sed sagittis lorem diam, non vehicula orci consectetur vel.

        </p>
    </div>

                    </div> <!-- END OF CLASS DETAILS CONTAINER -->
                </div> <!-- END OF BOOTSTRAP COLUMN -->

                <!-- Check permisions to load relavent links -->
                <div class="col-sm-4 class-links">
                    <button class="default-button"><a href="#">Begin Collab</a></button>
                    <button class="default-button"><a href="#">Edit Class Info</a></button>
                    <button class="default-button"><a href="#">Edit Class Announcements</a></button>
                    <button class="default-button"><a href="#">Edit Class Assignments</a></button>
                    <button class="default-button"><a href="#">Start Whiteboard</a></button>
                    <button class="default-button"><a href="#">Generate Attendance</a></button>
                    <button class="default-button"><a href="#">Fill Attendance</a></button>
                </div>
            </div>
        </div>
    </div>

<?php include 'templates/footer.php'; ?>

<?php include 'templates/header.php';
      include 'resources/library/db.php';
?>


<?php
 $currentClass = '1';
?>

    <div id="class-page">
            <div class="row">
                <div class="col-sm-8 class-header-container">

                    <!-- Update class title and ID here -->
                    <div class="class-header">
                        <h3>
                            <?php
                            $classTitleQuery = db::query("SELECT classCode, className from class where classID = $currentClass");
                            print_r($classTitleQuery[0]["className"]);
                            ?>
                        </h3>
                        <label>
                            <?php
                            print_r($classTitleQuery[0]["classCode"]);
                            ?>
                        </label>
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
            <?php
                $locationQuery = db::query("SELECT room from class where classID = $currentClass");
                print_r($locationQuery[0]["room"]);
            ?>
        </p>
        <p><strong>Class Time: </strong>
            <!-- Pull Class Time from database here -->
            <?php
                $timeQuery = db::query("SELECT classTime from class where classID = $currentClass");
                print_r($timeQuery[0]["classTime"]);
            ?>
        </p>
        <!-- Change href to location of syllabus saved in database -->
        <p><a href="<?php
            $syllabusQuery = db::query("SELECT syllabusURL from class where classID = $currentClass");
            print_r($syllabusQuery[0]["syllabusURL"]);
        ?>">Course Syllabus</a></p>


        <h4 class="cinfo-header">Professor Information</h4>
        <h5 class="cinfo-header sub-header">
            <!-- Pull Professor Name from database here -->
            <?php
                $profEmailQuery = db::query("SELECT professorEmail from class where classID = $currentClass");
                $profEmail = $profEmailQuery[0]["professorEmail"];
                $profNameQuery = db::query("SELECT firstName, lastName from user where email = '$profEmail'");
                print_r($profNameQuery[0]["firstName"]);
                echo " ";
                print_r($profNameQuery[0]["lastName"]);
            ?>
        </h5>
        <p><strong>
            Email:
            </strong>
            <!-- Change href="" to hold professors email in between the quotations -->
            <a href="mailto:
            <?php
                print_r($profEmail);
            ?>
            ">
            <?php
                print_r($profEmail);
            ?>
        </a>
        </p>
        <p><strong>Office Hours: </strong>
            <!-- Pull Office Hours for class from database here -->
            <?php
                $profHoursQuery = db::query("SELECT instructorHours from class where classID = $currentClass");
                print_r($profHoursQuery[0]["instructorHours"]);
            ?>
        </p>
        <h4 class="cinfo-header">TA Information</h4>
        <h5 class="cinfo-header sub-header">
            <!-- Get TA Name from database here -->
            <?php
                $taEmailQuery = db::query("SELECT taEmail from class where classID = $currentClass");
                $taEmail = $taEmailQuery[0]["taEmail"];
                $taNameQuery = db::query("SELECT firstName, lastName from user where email = '$taEmail'");
                print_r($taNameQuery[0]["firstName"]);
                echo " ";
                print_r($taNameQuery[0]["lastName"]);
            ?>
        </h5>
        <p><strong>Email: </strong>
            <!-- Change href="" to hold TA's email in between the quotations -->
            <a href="mailto:
            <?php
                print_r($taEmail);
            ?>">
            <?php
                print_r($taEmail);
            ?></a>
        </p>
        <p><strong>TA Hours: </strong>
            <!-- Pull TA Office Hours from database here -->
            <?php
                $taHoursQuery = db::query("SELECT taHours from class where classID = $currentClass");
                print_r($taHoursQuery[0]["taHours"]);
            ?>
        </p>
    </div>



    <!-------------------------------------------------------ALL ASSIGNMENTS SECTION
    -------------------------------------------------------->

    <div id="class-assignments-page" class="class-section">

        <!-- PAST ASSIGNMENTS -->

        <div id="past-assignments" class="my-dropdown">
            <button class="my-dropdown-toggle" type="button" id="dropdownMenuButton">
                Past Assignments<span class="menu-symbol"><i class="fa fa-minus-square" aria-hidden="true"></i></span>
            </button>
            <div class="my-dropdown-menu assingments-dropdown" aria-labelledby="dropdownMenuButton">

                <!-- Use PHP to loop through and display all assignments where the due-date is SMALLER than today's date -->
                <?php
                $assignmentQuery = db::query("SELECT title, dueDate, assID FROM assignment WHERE classID = $currentClass");

                for ($count=0; $count < count($assignmentQuery); $count++) {
                #<!-- Change id to be formatted as "list-assignment-idnumber" Changing idnumber to be the assignments id within the database-->
                    $assDueDate = print_r($assignmentQuery[$count]['dueDate'], true);
                    if(date("Y-m-d h:m:s") < $assDueDate){
                        $assIDNum = $assignmentQuery[$count]['assID'];
                        echo "<div class='assignment' id='list-assignment-$assIDNum'>";
                        echo    '<div class="row">';
                        echo        '<div class="col-xs-12">';
                        echo            '<h4 class="title">';
                        echo                $assignmentQuery[$count]['title'];
                        echo            '</h4>';
                        echo            '<div class="due-date"><strong>Due </strong>';
                        echo                $assignmentQuery[$count]['dueDate'];
                        echo             '</div>';
                        echo        '</div>';
                        echo    '</div>';
                        echo '</div>';
                    }
                }
                ?>
                <!-- Assignment Format Ends here -->
                <!-- Loop back to top or end loop if no more assignments meet the loops condition here
                INSERT INTO assignment (title, dueDate, classID) VALUES ('Final', '2017-12-01 12:00:00', '1');
                INSERT INTO assignment (title, dueDate, classID) VALUES ('Paper', '2017-12-02 12:00:00', '1');
                INSERT INTO assignment (title, dueDate, classID) VALUES ('Quiz', '2017-12-03 12:00:00', '1');

            -->



                <!-- GO TO UPCOMING-ASSIGNMENTS -->

            </div> <!-- End of dropdown -->
        </div> <!-- End of past assignments -->



        <!-- UPCOMING ASSIGNMENTS -->

        <div id="upcoming-assignments" class="my-dropdown">
            <button class="my-dropdown-toggle" type="button" id="dropdownMenuButton">
                Assignments<span class="menu-symbol"><i class="fa fa-minus-square" aria-hidden="true"></i></span>
            </button>
            <div class="my-dropdown-menu assingments-dropdown" aria-labelledby="dropdownMenuButton">
                <!-- Use PHP to loop through and display all assignments where the due-date is LARGER than today's date -->
                <!-- Assignment Format Begins Here -->
                <?php
                    $assignmentQuery = db::query("SELECT title, dueDate, assID FROM assignment WHERE classID = $currentClass");
                    for ($count=0; $count < count($assignmentQuery); $count++) {
                        #if(){
                        $assIDNum = $assignmentQuery[$count]['assID'];
                            echo "<div class='assignment' id='list-assignment-$assIDNum'>";
                            echo    '<div class="row">';
                            echo        '<div class="col-xs-12">';
                            echo            '<h4 class="title">';
                            echo                $assignmentQuery[$count]['title'];
                            echo           '</h4>';
                            echo            '<div class="due-date"><strong>Due </strong>';
                            echo                $assignmentQuery[$count]['description'];
                            echo            '</div>';
                            echo        '</div>';
                            echo    '</div>';
                            echo '</div>';
                        #}
                    }
                ?>
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
        <button class="class-back-button"><i class="fa fa-chevron-left" aria-hidden="true"></i>Back</button>
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

        <!-- block of code to disply only a certain amount of letters. is currently erroring.
        if (strlen($announcementQuery[$count]['description']) > 40)
        {
            $shortDescription = substr($announcementQuery[$count]['description',0,40).'...';
            echo $shortDescription;
        }
        else {
            echo $announcementQuery[$count]['description'];
        }
        $shortDescription = (strlen($announcementQuery[$count]['description']) > 43) ? substr($announcementQuery[$count]['description',0,40).'...' : $string;
        echo $shortDescription;
        -->

        <?php

            $announcementQuery = db::query("SELECT title, description, postTime, user_email, annID FROM announcement WHERE classID = $currentClass");
            for ($count=0; $count < count($announcementQuery); $count++) {
                #echo '<div class="announcement" id="list-announcement-idnumber">';
                $annIDNum = $announcementQuery[$count]['annID'];
                echo "<div class='announcement' id='list-announcement-$annIDNum'>";
                    echo '<div class="row">';
                        echo '<div class="col-xs-12 ann-content">';
                            echo '<h4 class="title">';
                                echo $announcementQuery[$count]['title'];
                            echo '</h4>';
                            echo '<h5 class="author">';
                                $annEmail = $announcementQuery[$count]['user_email'];
                                $annNameQuery = db::query("SELECT firstName, lastName from user where email = '$annEmail'");
                                echo "Name: ";
                                echo $annNameQuery[0]["firstName"];
                                echo ' ';
                                echo $annNameQuery[0]["lastName"];
                            echo '</h5>';
                                echo '<p class="message">';
                                    echo $announcementQuery[$count]['description'];
                                echo '</p>';
                            echo '</h5>';
                            echo '<p class="message">';
                                echo 'Time of Post: ';
                                echo $announcementQuery[$count]['postTime'];
                            echo '</p>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            }
        ?>
    </div> <!-- End of Announcements page -->


    <!-------------------------------------------------------SINGLE ANNOUNCEMENTS SECTION
    -------------------------------------------------------->

    <!-- Use PHP to loop through all assignments and Format them as below -->
    <!-- Use PHP to format id value to be assign-1234 -->
    <!-- Changing the 1234 to whatever the assignments id is in the database -->

    <?php
        #single announcement display
        $announcementQuery = db::query("SELECT title, description, postTime, user_email, annID FROM announcement WHERE classID = $currentClass");
        for ($count=0; $count < count($announcementQuery); $count++){
            $annIDNum = $announcementQuery[$count]['annID'];
            echo "<div class='announcement-single class-section' id='announcement-$annIDNum'>";
                echo '<button class="class-back-button"><i class="fa fa-chevron-left" aria-hidden="true"></i>Back</button>';
                echo '<h3 class="title">';
                    echo $announcementQuery[$count]['title'];
                echo '</h3>';
                echo '<h5 class="author">';
                    $annEmail = $announcementQuery[$count]['user_email'];
                    $annNameQuery = db::query("SELECT firstName, lastName from user where email = '$annEmail'");
                    echo "Name: ";
                    echo $annNameQuery[0]["firstName"];
                    echo ' ';
                    echo $annNameQuery[0]["lastName"];
                echo '</h5>';
                echo '<p class="message">';
                    echo $announcementQuery[$count]['description'];
                echo '</p>';
            echo '</div>';
        }
    ?>
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

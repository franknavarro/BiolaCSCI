<?php include 'templates/header.php';
      include 'resources/library/db.php';
?>

<?php
 $currentClass;
 //set this to a default value for testing. = '1';
?>
    <div id="class-page">
            <div class="row">
                <div class="col-sm-8 class-header-container">
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
                    <div class="class-details">
    <!-------------------------------------------------------GENERAL CLASS INFORMATION SECTION-------------------------------------------------------->
    <div id="class-info-page" class="class-section" style="display:block;">
        <h4 class="cinfo-header">Class Information</h4>
        <p><strong>Location: </strong>
            <?php
                $locationQuery = db::query("SELECT room from class where classID = $currentClass");
                print_r($locationQuery[0]["room"]);
            ?>
        </p>
        <p><strong>Class Time: </strong>
            <?php
                $timeQuery = db::query("SELECT classTime from class where classID = $currentClass");
                print_r($timeQuery[0]["classTime"]);
            ?>
        </p>
        <p><a href="<?php
            $syllabusQuery = db::query("SELECT syllabusURL from class where classID = $currentClass");
            print_r($syllabusQuery[0]["syllabusURL"]);
        ?>">Course Syllabus</a></p>
        <h4 class="cinfo-header">Professor Information</h4>
        <h5 class="cinfo-header sub-header">
            <?php
                $profEmailQuery = db::query("SELECT professorEmail from class where classID = $currentClass");
                $profEmail = $profEmailQuery[0]["professorEmail"];
                $profNameQuery = db::query("SELECT firstName, lastName from user where email = '$profEmail'");
                print_r($profNameQuery[0]["firstName"]);
                echo " ";
                print_r($profNameQuery[0]["lastName"]);
            ?>
        </h5>
            <p><strong>Email:</strong>
                <a href="mailto:<?php print_r($profEmail); ?>">
                <?php print_r($profEmail); ?>
                </a>
            </p>
        <p><strong>Office Hours: </strong>
            <?php
                $profHoursQuery = db::query("SELECT instructorHours from class where classID = $currentClass");
                print_r($profHoursQuery[0]["instructorHours"]);
            ?>
        </p>
        <h4 class="cinfo-header">TA Information</h4>
        <h5 class="cinfo-header sub-header">
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
            <a href="mailto:
            <?php
                print_r($taEmail);
            ?>">
            <?php
                print_r($taEmail);
            ?></a>
        </p>
        <p><strong>TA Hours: </strong>
            <?php
                $taHoursQuery = db::query("SELECT taHours from class where classID = $currentClass");
                print_r($taHoursQuery[0]["taHours"]);
            ?>
        </p>
    </div>

    <!-------------------------------------------------------ALL ASSIGNMENTS SECTION-------------------------------------------------------->
    <div id="class-assignments-page" class="class-section">
        <!-- UPCOMING ASSIGNMENTS -->
        <div id="upcoming-assignments" class="my-dropdown">
            <button class="my-dropdown-toggle" type="button" id="dropdownMenuButton">
                Assignments<span class="menu-symbol"><i class="fa fa-minus-square" aria-hidden="true"></i></span>
            </button>
            <div class="my-dropdown-menu assingments-dropdown" aria-labelledby="dropdownMenuButton">
                <!-- Assignment Format Begins Here -->
                <?php
                    $assignmentQuery = db::query("SELECT title, dueDate, assID FROM assignment WHERE classID = $currentClass");
                    for ($count=0; $count < count($assignmentQuery); $count++) {
                        $assDueDate = print_r($assignmentQuery[$count]['dueDate'], true);
                        if(date("Y-m-d h:m:s") < $assDueDate){
                        $assIDNum = $assignmentQuery[$count]['assID'];
                            echo "<div class='assignment' id='list-assignment-$assIDNum'>";
                                echo '<div class="row">';
                                    echo '<div class="col-xs-12">';
                                        echo '<h4 class="title">';
                                            echo $assignmentQuery[$count]['title'];
                                        echo '</h4>';
                                        echo '<div class="due-date"><strong>Due </strong>';
                                            echo $assignmentQuery[$count]['dueDate'];
                                        echo '</div>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        }
                    }
                ?>
            </div><!-- End of dropdown -->
        </div> <!-- End of upcoming assignments -->

        <!-- PAST ASSIGNMENTS -->
        <div id="past-assignments" class="my-dropdown">
            <button class="my-dropdown-toggle" type="button" id="dropdownMenuButton">
                Past Assignments<span class="menu-symbol"><i class="fa fa-minus-square" aria-hidden="true"></i></span>
            </button>
            <div class="my-dropdown-menu assingments-dropdown" aria-labelledby="dropdownMenuButton">
                <?php
                $assignmentQuery = db::query("SELECT title, dueDate, assID FROM assignment WHERE classID = $currentClass");
                for ($count=0; $count < count($assignmentQuery); $count++) {
                    $assDueDate = print_r($assignmentQuery[$count]['dueDate'], true);
                    if(date("Y-m-d h:m:s") > $assDueDate){
                        $assIDNum = $assignmentQuery[$count]['assID'];
                        echo "<div class='assignment' id='list-assignment-$assIDNum'>";
                            echo '<div class="row">';
                                echo '<div class="col-xs-12">';
                                    echo '<h4 class="title">';
                                        echo $assignmentQuery[$count]['title'];
                                    echo '</h4>';
                                    echo '<div class="due-date"><strong>Due </strong>';
                                        echo $assignmentQuery[$count]['dueDate'];
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    }
                }
                ?>
                <!-- Assignment Format Ends here -->
            </div> <!-- End of dropdown -->
        </div> <!-- End of past assignments -->
    </div>
    <!-- End of assignments container -->

    <!-------------------------------------------------------INDIVIDUAL ASSIGNMENTS SECTION-------------------------------------------------------->
    <?php
        $assignmentQuery = db::query("SELECT title, dueDate, assID, url, description, postTime FROM assignment WHERE classID = $currentClass");
        for ($count=0; $count < count($assignmentQuery); $count++) {
            $assIDNum = $assignmentQuery[$count]['assID'];
            echo "<div class='assignment-single class-section' id='assignment-$assIDNum'>";
                echo '<button class="class-back-button"><i class="fa fa-chevron-left" aria-hidden="true"></i>Back</button>';
                echo '<h2 class="title">';
                    echo $assignmentQuery[$count]['title'];
                echo '</h2>';
                echo '<hr style="margin-top:10px;">';
                    echo '<h5><strong>Due </strong><span class="due-date">';
                        echo $assignmentQuery[$count]['dueDate'];
                    echo '</span></h5>';
                    echo '<h5><strong>URL/File: </strong>';
                        $assUrl = $assignmentQuery[$count]['url'];
                        echo "<a class='url-file' target='_blank' href='$assUrl'>$assUrl</a>";
                    echo '</h5>';
                echo '<hr>';
                echo '<p class="assignment-description">';
                    echo $assignmentQuery[$count]['description'];
                echo '</p>';
                echo '<h5><strong>Post Time: </strong><span class="due-date">';
                    echo $assignmentQuery[$count]['postTime'];
                echo '</span></h5>';
            echo '</div>';
        }
    ?>

    <!-------------------------------------------------------ALL ANNOUNCEMENTS SECTION-------------------------------------------------------->
    <div id="class-announcements-page" class="class-section">
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
    </div>
    <!-- End of Announcements page -->

    <!-------------------------------------------------------SINGLE ANNOUNCEMENTS SECTION-------------------------------------------------------->
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
                echo '<h5 class="author">';
                    echo "Post Time: ";
                    echo $announcementQuery[$count]["postTime"];
                echo '</h5>';
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

<!--
*****DATA FOR TESTING*****
Dummy Assignments to add to the database for testing.
INSERT INTO assignment (title, dueDate, classID, class_classID, description, postTime) VALUES ('Final', '2017-12-01 12:00:00', '1', '1', 'Lorem ipsum dolor sit amet, sanctus tractatos abhorreant vim eu. Accusata oportere cotidieque duo ea, nullam erroribus eos in. Mea paulo accusamus at. Vitae everti consequuntur usu an, nec eu quando omnium feugiat, et assum labores nominavi qui.', '2015-02-03 12:00:00')';
INSERT INTO assignment (title, dueDate, classID, class_classID, description, postTime) VALUES ('Paper', '1993-12-02 12:00:00', '1', '1', 'Lorem ipsum dolor sit amet, sanctus tractatos abhorreant vim eu. Accusata oportere cotidieque duo ea, nullam erroribus eos in. Mea paulo accusamus at. Vitae everti consequuntur usu an, nec eu quando omnium feugiat, et assum labores nominavi qui.', '2015-02-03 12:00:00');
INSERT INTO assignment (title, dueDate, classID, class_classID, description, postTime) VALUES ('Quiz', '2017-12-03 12:00:00', '1', '1', 'Lorem ipsum dolor sit amet, sanctus tractatos abhorreant vim eu. Accusata oportere cotidieque duo ea, nullam erroribus eos in. Mea paulo accusamus at. Vitae everti consequuntur usu an, nec eu quando omnium feugiat, et assum labores nominavi qui.', '2015-02-03 12:00:00');
Dummy announcements to add the database for testing.
INSERT INTO announcement (classID, title, description, postTime, user_email, class_classID) VALUES ('1', 'Class Tomorrow', 'We will be having a quiz tomorrow in class', '4:50pm', 'peter.a.alford@biola.edu', '1');
INSERT INTO announcement (classID, title, description, postTime, user_email, class_classID) VALUES ('1', 'Party', 'Come to my house at 7:00pm food and drinks will be provided', '2:50pm', 'peter.a.alford@biola.edu', '1');
INSERT INTO announcement (classID, title, description, postTime, user_email, class_classID) VALUES ('1', 'Presentations', 'I am getting rid of the group presentation option', '9:50am', 'peter.a.alford@biola.edu', '1');
Dummy Updatees for current classes in the database.
UPDATE class Set taHours = '12:00-2:15pm', instructorHours = '5:00-6:15pm', professorEmail = 'shieu-hong.lin@biola.edu', taEmail = 'peter.a.alford@biola.edu' Where classID = '1';
-->

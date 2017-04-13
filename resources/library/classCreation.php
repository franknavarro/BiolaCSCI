<html>
    <body>
        <form action="classProcess.php" method="post">
            ----Class Info--------------------------------<br>
            Class Name: <input type="text" name="name"><br>
            Class ID: <input type="text" name="classID"><br>
            Location: <input type="text" name="location"><br>
            Class Time: <input type="datetime-local" name="classTime"><br>
            ----Syllabus----------------------------------<br>
            Syllabus URL: <input type="url" name="syllabusURL"><br>
            ----Professor Info---------------------------<br>
            Professor Name: <input type="text" name="professorName"><br>
            Professor Email: <input type="email" name="professorEmail"><br>
            Professor Hours: <input type="text" name="professorHours"><br>
            ----TA Info----------------------------------<br>
            TA Name: <input type="text" name="taName"><br>
            TA Email: <input type="email" name="taEmail"><br>
            TA Hours: <input type="text" name="taHours"><br>
            ----Submission-------------------------------<br>
            <input type="submit">
        </form>

        <?php
        require_once("db.php");
        $classID = $_POST["classID"];
        echo $classID;
        echo $className = $_POST["name"];
        echo $sessionID = $_POST[""];
        echo $syllabusURL = $_POST["syllabusURL"];
        echo $classTime = $_POST["classTime"];
        echo $location = $_POST["location"];
        echo $taName = $_POST["taName"];
        echo $taEmail = $_POST["taEmail"];
        echo $taHours = $_POST["taHours"];
        echo $professorName = $_POST["professorName"];
        echo $professorEmail = $_POST["professorEmail"];
        echo $professorHours = $_POST["professorHours"];
        //Create Class Entry
        db::query("INSERT INTO class VALUES (:classID, :professorName, :name, :sessionID, :syllabusURL, :classTime, :location, :taHours, :professorHours)", array(':classID'=>$classID, ':professorName'=>$professorName, ':name'=>$className, ':sessionID'=>$sessionID, ':syllabusURL'=>$syllabusURL, ':classTime'=>$classTime, ':location'=>$location, ':taHours'=>$taHours, ':professorHours'=>$professorHours));
<<<<<<< HEAD
=======

>>>>>>> 94f83c3f7ee04258f0b882a507881d899240db38
        //db::
        //Create TA entry
        //INSERT INTO user_class (role, user_email, class_classID) VALUES (:TA, :taEmail, :classID);
        //Create professor entry
        //INSERT INTO user_class (role, user_email, class_classID) VALUES (:Prof, :professorEmail, :classID);
        ?>
    </body>
</html>

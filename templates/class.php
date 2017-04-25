<?php include 'header.php'; ?>

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
                            <button class="default-button">
                                <a href="#">General</a>
                            </button>
                        </div>
                        <div class="col-xs-4">
                            <button class="default-button">
                                <a href="#">Announcements</a>
                            </button>
                        </div>
                        <div class="col-xs-4">
                            <button class="default-button">
                                <a href="#">Assignments</a>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8 class-content">
                    <!--Here is where you would load the class information details. When you click Info, Announcements, or Assignments above this container adds the information needed -->
                    <div class="class-details">
                        <!-- Loaded Data -->
                        <?php include 'class-assignments.php'; ?>
                    </div>
                </div>
                    
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
    
<?php include 'footer.php'; ?>
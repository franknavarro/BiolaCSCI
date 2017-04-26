<div id="assignments-page">
    
    <!-- PAST ASSIGNMENTS -->
    
    <div id="past-assignments" class="dropdown keep-open open">
        <button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Past Assignments
        </button>
        <div class="dropdown-menu assingments-dropdown" aria-labelledby="dropdownMenuButton">
            
            <!-- Use PHP to loop through and display all assignments where the due-date is SMALLER than today's date -->
            <!-- Assignment Format Begins Here -->
            <!-- Change href to point to and load the individual assignment, the template for individual assignments is held in class-assign-single.php -->
            <a href="#link-to-assignment" class="assignment">
                <div class="row">
                    <div class="col-xs-12">
                        <h4 class="title">
                            <!--Pull Title of the Assignment from the database here -->
                            Lab #1
                        </h4>
                        <label class="due-date"><strong>Due </strong>
                            <!-- Pull the Due Date of the Assignment from the database here -->
                            April 30 at 11:30pm
                        </label>
                    </div>
                </div>
            </a>
            <!-- Assignment Format Ends here -->
            <!-- Loop back to top or end loop if no more assignments meet the loops condition here -->
            
            
            
            <!-- Bellow are just examples of how the previous-assignments should look -->
            
            <!-- GO TO UPCOMING-ASSIGNMENTS -->
            
            <!-- EXAMPLES -->
            <a href="#link-to-assignment" class="assignment">
                <div class="row">
                    <div class="col-xs-12">
                        <h4 class="title">Lab #2</h4>
                        <label class="due-date"><strong>Due </strong>April 31 at 11:30pm</label>
                    </div>
                </div>
            </a>
            <a href="#link-to-assignment" class="assignment">
                <div class="row">
                    <div class="col-xs-12">
                        <h4 class="title">Lab #3</h4>
                        <label class="due-date"><strong>Due </strong>April 32 at 11:30pm</label>
                    </div>
                </div>
            </a>
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
            <!-- Change href to point to and load the individual assignment, the template for individual assignments is held in class-assign-single.php -->
            <a href="#link-to-assignment" class="assignment">
                <div class="row">
                    <div class="col-xs-12">
                        <h4 class="title">
                            <!--Pull Title of the Assignment from the database here -->
                            Lab #4
                        </h4>
                        <label class="due-date"><strong>Due </strong>
                            <!-- Pull the Due Date of the Assignment from the database here -->
                            April 30 at 11:30pm
                        </label>
                    </div>
                </div>
            </a>

            <!-- Assignment Format Ends here -->
            <!-- Loop back to top or end loop if no more assignments meet the loops condition here -->
            
            
            
            <!-- Bellow are just examples of how the upcoming-assignments should look -->
            <!-- EXAMPLES -->
            <a href="#link-to-assignment" class="assignment">
                <div class="row">
                    <div class="col-xs-12">
                        <h4 class="title">Lab #5</h4>
                        <label class="due-date"><strong>Due </strong>April 31 at 11:30pm</label>
                    </div>
                </div>
            </a>
            <a href="#link-to-assignment" class="assignment">
                <div class="row">
                    <div class="col-xs-12">
                        <h4 class="title">Lab #6</h4>
                        <label class="due-date"><strong>Due </strong>April 32 at 11:30pm</label>
                    </div>
                </div>
            </a>
            <!-- END OF EXAMPLES -->
            
        </div><!-- End of dropdown -->
    </div> <!-- End of upcoming assignments -->
</div> <!-- End of assignments container -->
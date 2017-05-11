$('.dropdown.keep-open').on({
    "shown.bs.dropdown": function() { this.closable = false; },
    "click":             function() { this.closable = true; },
    "hide.bs.dropdown":  function() { return this.closable; }
});

$('.assingments-dropdown').on('click', function(event){
    // The event won't be propagated up to the document NODE and 
    // therefore delegated events won't be fired
    event.stopPropagation();
});

//Changing Class Sections within the class page
$(".class-nav-button").click(function() {
    
    //Change the section according to the button pressed
    var sectionId = "#" + $(this).attr("id").slice(0, -7) + "-page";
    //Rehide all the class sections
    $(".class-section").hide();
    //Display the section the user selected
    $(sectionId).show();
    
    //Removes the button as the active page
    $(".class-nav-button").removeClass("active-button");
    //Adds active button to our current button
    $(this).addClass("active-button");

});

$(".assignment").click(function() {
    
    var assignmentId = "#" + $(this).attr("id").substring(5);
    
    $("#class-assignments-page").hide();
    $(assignmentId).show();
    
});
$(".announcement").click(function() {
    
    var announcementId = "#" + $(this).attr("id").substring(5);
    
    $("#class-announcements-page").hide();
    $(announcementId).show();
    
});

$(".my-dropdown-toggle").click(function() {
    
    var menu = $(this).parent().find(".my-dropdown-menu");
    var menuSymbol = $(this).find(".menu-symbol");
    
    menu.slideToggle(function() {
        
        if($(this).css("display") == "none") {
            menuSymbol.html("<i class='fa fa-plus-square' aria-hidden='true'></i>");
        } else {
            menuSymbol.html("<i class='fa fa-minus-square' aria-hidden='true'></i>");
        }
        
    });
    
    
});


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

//Switching between two different sections
function switchSections(hideThis, showThis) {
    $(hideThis).hide();
    $(showThis).show();
}

//Changing Class Sections within the class page
$(".class-nav-button").click(function() {
    
    //Change the section according to the button pressed
    var sectionId = "#" + $(this).attr("id").slice(0, -7) + "-page";

    switchSections(".class-section", sectionId);
    
    //Removes the button as the active page
    $(".class-nav-button").removeClass("active-button");
    //Adds active button to our current button
    $(this).addClass("active-button");

});

//Clicking on an individual assignment in the all assignments view
$(".assignment").click(function() {
    
    var assignmentId = "#" + $(this).attr("id").substring(5);
    
    switchSections("#class-assignments-page", assignmentId);

});
//Clicking on an individual announcement in the all announcements view
$(".announcement").click(function() {
    
    var announcementId = "#" + $(this).attr("id").substring(5);
    
    switchSections("#class-announcements-page", announcementId);

});
//Going back to the previous view if on an individual view
$(".class-back-button").click(function() {
    
    var goToPage = "#class-" + $(this).parent().attr("class").replace("-single class-section", "") + "s-page";
    
    switchSections(
        "#" + $(this).parent().attr("id"),
        goToPage);
    
});


//Drop Down Toggle
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


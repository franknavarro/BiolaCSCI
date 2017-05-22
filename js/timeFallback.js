var nativePicker = $(".time-field").find(".nativeTimePicker");

var fallbackPicker = $(".time-field").find(".fallbackTimePicker");



var minuteFields = $(".minute");
var hourFields = $(".hour");




fallbackPicker.each(function() {
    $(this).hide();
});

var test = document.createElement("input");
test.type = "time";

if(test.type === "text") {
    
    nativePicker.each(function() {
        $(this).hide();
        $(this).children("input").attr("readonly", true);
    });
    
    fallbackPicker.each(function() {
        $(this).show();
        populateMinutes();
        populateHours();
    })
}

function populateMinutes() {
    for(var i = 0; i <= 59; i++) {
        var minute = (i < 10) ? ("0" + i) : i;
        minuteFields.each(function() {
            $(this).append("<option>" + minute + "</option>");
        })
    }
}

function populateHours() {
    for(var i = 0; i <=11; i++) {
        var hour = (i < 9) ? ("0" + (i+1)) : i+1;
        hourFields.each(function() {
            $(this).append("<option>" + hour + "</option>");
        })
    }
}
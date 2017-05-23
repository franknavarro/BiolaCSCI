var nativePicker = $(".time-field").find(".nativeTimePicker");

var fallbackPicker = $(".time-field").find(".fallbackTimePicker");

var legitTimePicker = nativePicker.children("input");

var minuteFields = $(".minute");
var hourFields = $(".hour");
var timeofdayFields = $(".tod");




fallbackPicker.each(function() {
    $(this).hide();
});

var test = document.createElement("input");
test.type = "time";

if(test.type === "text") {
    
    $(".throughTime").css("top", "45%");
    
    
    nativePicker.each(function() {
        $(this).hide();
        $(this).children("input").attr("readonly", true);
    });
    
    populateMinutes();
    populateHours();
    
    fallbackPicker.each(function() {
        $(this).show();
        var fieldforshits = $(this).find(".hour");
        updateTime(fieldforshits);
    })
    
}

function populateMinutes() {
    minuteFields.each(function() {
        for(var i = 0; i <= 59; i++) {
            var minute = (i < 10) ? ("0" + i) : i;
            $(this).append("<option>" + minute + "</option>");
        }
    });
    
}

function populateHours() {
    hourFields.each(function() {
        for(var i = 0; i <=11; i++) {
            var hour = (i < 9) ? ("0" + (i+1)) : i+1;
            $(this).append("<option>" + hour + "</option>");
        }
    });
}

function updateTime(fieldChanged) {
    
    var fallBackP = fieldChanged.closest(".fallbackTimePicker");
    var nativeP = fallBackP.siblings(".nativeTimePicker").children("input");
    
    var minuteVal = fallBackP.find(".minute").val();
    var hourVal = parseInt(fallBackP.find(".hour").val());
    var todVal = fallBackP.find(".tod").val();
    
    var newTime = (todVal === "PM" && hourVal < 12) ? (hourVal + 12) : (todVal ==="AM" && hourVal == 12) ? "00" : (hourVal < 10) ? ("0" + hourVal) : hourVal;
    newTime += ":";
    newTime += minuteVal;
    
    nativeP.val(newTime);
    
    
}

minuteFields.on("change", function() {
    updateTime($(this));
});
hourFields.on("change", function() {
    updateTime($(this));
});
timeofdayFields.on("change", function() {
    updateTime($(this));
});
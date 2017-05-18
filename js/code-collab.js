/* Launch TogetherJS */
$(document).ready(TogetherJS);

var textArea = document.getElementById("classroom-code");

// Define an extended mixed-mode that understands vbscript and
// leaves mustache/handlebars embedded templates in html mode
var mixedMode = {
    name: "htmlmixed",
    scriptTypes: [{matches: /\/x-handlebars-template|\/x-mustache/i,
                   mode: null},
                  {matches: /(text|application)\/(x-)?vb(a|script)/i,
                   mode: "vbscript"}]
};

//Load up CodeMirror
var myCodeMirror = CodeMirror.fromTextArea(textArea, {
    value: "function myScript(){return 100;}\n",
    mode:  "text/x-c++src",
    theme: "default",
    lineNumbers: true,
    indentUnit: 4,
    lineWrapping: true,
    styleActiveLine: true,
    autofocus: true,
    matchBrackets: true,
    autoCloseBrackets: true
    
});

//Resize CodeMirror Page to fit the screen
function resizeCodeMirror() {
    var currentWindowHeight = $("body").innerHeight()-$("nav").height()-$("#langContainer").outerHeight(true);
    $(".CodeMirror").height(currentWindowHeight);
}

//When file loads resize CodeMirror Screen
resizeCodeMirror();

//When window is resized resize all CodeMirror Screen
$(window).resize(function() {
    resizeCodeMirror();
});

//Change the coding language to what the user selected
$("#langSelector").change(function() {
    var newLanguage = $(this).val();
    
    if(newLanguage=="htmlmixed") {
        myCodeMirror.setOption("mode", mixedMode);
        myCodeMirror.setOption("matchTags", true);
        myCodeMirror.setOption("autoCloseTags", true);
    } else if (newLanguage=="application/x-httpd-php" || newLanguage=="django"){
        myCodeMirror.setOption("matchTags", true);
        myCodeMirror.setOption("autoCloseTags", true);
    }else {
        myCodeMirror.setOption("mode", newLanguage);
        myCodeMirror.setOption("matchTags", false);
        myCodeMirror.setOption("autoCloseTags", false);
    }
});
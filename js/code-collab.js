//// Initialize Firebase.
//// TODO: replace with your Firebase project configuration.
var config = {
    apiKey: "AIzaSyCeS-XV1dUirriS_uQb0DVvNESRjtfhpCM",
    authDomain: "csci-website.firebaseapp.com",
    databaseURL: "https://csci-website.firebaseio.com",
    projectId: "csci-website",
    storageBucket: "csci-website.appspot.com",
    messagingSenderId: "832854775752"
};
firebase.initializeApp(config);
//// Get Firebase Database reference.
var firepadRef = getExampleRef();

// Helper to get hash from end of URL or generate a random one.
function getExampleRef() {
var ref = firebase.database().ref();
var hash = window.location.hash.replace(/#/g, '');
if (hash) {
  ref = ref.child(hash);
} else {
  ref = ref.push(); // generate unique location.
  window.location = window.location + '#' + ref.key; // add it as a hash to the URL.
}
if (typeof console !== 'undefined') {
  console.log('Firebase data: ', ref.toString());
}
return ref;
}

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

//// Create Firepad.
var firepad = Firepad.fromCodeMirror(firepadRef, myCodeMirror, {
  defaultText: '// JavaScript Editing with Firepad!\nfunction go() {\n  var message = "Hello, world.";\n  console.log(message);\n}'
});


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

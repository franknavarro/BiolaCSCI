
window.onload = function() {
    tabCapableText(); //Enabled Tabbed Text in textarea
    TogetherJS(); //Run together JS
    TogetherJS.config("TogetherJSConfig_dontShowClicks", true) //Disable Click Ping
};

//Makes the textarea tab-capable
function tabCapableText() {
    var textareas = document.getElementsByTagName('textarea');
    var count = textareas.length;
    for(var i=0;i<count;i++){
        textareas[i].onkeydown = function(e){
            if(e.keyCode==9 || e.which==9){
                e.preventDefault();
                var s = this.selectionStart;
                this.value = this.value.substring(0,this.selectionStart) + "\t" + this.value.substring(this.selectionEnd);
                this.selectionEnd = s+1;
            }
        }
    }
}

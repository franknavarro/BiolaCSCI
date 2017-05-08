<?php include 'templates/header.php'; ?>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script src="js/jquery-linedtextarea.js"></script>
    <script src="resources/library/together.js"></script>
	<link href="css/jquery-linedtextarea.css" type="text/css" rel="stylesheet" />
</head>
<body onload="TogetherJS(this); return false;">
<textarea class="lined" rows="10" cols="50"></textarea>

<script>
$(function() {
	$(".lined").linedtextarea(
		{selectedLine: 1}
	);
});
</script>

<script>
//Makes the textarea tab-capable

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
</script>

<script>
         TogetherJSConfig_getUserName = function () {		 +//Makes the textarea tab-capable
             return '<?php echo $_SESSION['user_id']; ?>';
         };
</script>
</body>
</html>

<?php include 'templates/header.php'; ?>

    <div id="code-collaboration">
        <div id="container">
            <label for="ta"></label>
            <div class="twrap">
                <textarea id="ta" name="ta" cols="50" rows="40"></textarea>
            </div>
        </div>
    </div>
    <script src="js/code-collab.js"></script>
    <script src="resources/library/together.js"></script>
    <script> TogetherJSConfig_getUserName = function () {return '<?php echo $_SESSION['user_id']; ?>';}; </script>

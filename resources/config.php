<?php

/* Biola CS Site Configuration File
Returns: Array of Configuration Variables
Use:

<?php
$config = include('resources/config.php');
echo $config['dbhost']; // 'localhost'
?>


*/

/* Configuration Variables */
return [
        /* LocalHost Environment Database Configuration Settings */
        'dbhost' => '127.0.0.1',
        'dbname' => 'cscidb',
        'dbuser' => 'root',
        'dbpassword' => 'root',
        'dbport' => '8889'
];


?>

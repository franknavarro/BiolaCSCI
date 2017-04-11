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

// Database Selection (1 - LocalHost, 2 - Development)

$dbSelection = 1;

    if ($dbSelection == 1) {
        return [/* LocalHost Environment Database Configuration Settings */
        'dbhost' => '127.0.0.1',
        'dbname' => 'cscidb',
        'dbuser' => 'root',
        'dbpassword' => 'root',
        'dbport' => '8889'
    ];
    } else if ($dbSelection == 2) {
        return[/* Development Environment Database Configuration Settings */
        'dbhost' => '127.0.0.1',
        'dbname' => 'cscidb',
        'dbuser' => 'dev_csci',
        'dbpassword' => 'na34Unah+t+S',
        'dbport' => '3306'
        ];
    } else {
        error_log("ERROR: CS-Web Application Configuration Error - $dbSelection not set correctly use (1 or 2)");
    }

?>

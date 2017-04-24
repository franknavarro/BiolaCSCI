<?php

/* Biola CS Site Configuration File
Returns: Array of Configuration Variables
*/

/* Configuration Variables */

// Database Selection (0 - Live, 1 - LocalHost)

$debug = 0;

    if ($debug == 1) {
        return [/* LocalHost Environment Database Configuration Settings */
        'dbhost' => '127.0.0.1',
        'dbname' => 'cscidb',
        'dbuser' => 'root',
        'dbpassword' => 'root',
        'dbport' => '8889'
    ];
    } else if ($debug == 0) {
        return[/* Live Environment Database Configuration Settings */
        'dbhost' => '127.0.0.1',
        'dbname' => 'cscidb',
        'dbuser' => 'root',
        'dbpassword' => 'password',
        'dbport' => '3306'
        ];
    } else {
        error_log("ERROR: CS-Web Application Configuration Error - $debug not set correctly use (0 or 1)");
    }

?>

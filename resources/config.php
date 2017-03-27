<?php

/* Biola CS Site Configuration File
   Returns: Array of Configuration Variables
   Use:

   <?php
   $config = include('resources/config.php');
   echo $database['dbhost']; // 'localhost'
   ?>


 */

return [

/* Database Configuration Settings */
  'dbhost' => 'localhost',
  'dbname' => 'dbname',
  'dbuser' => 'dbuser',
  'dbpassword' => 'dbpassword',

/* Debug Configuration Settings */
  ini_set("error_reporting", "true"); //Enable or disable error reporting
  error_reporting(E_ALL|E_STRCT);

];


 ?>

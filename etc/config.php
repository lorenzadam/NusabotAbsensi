<?php
/**
 * using mysqli_connect for database connection
 */

// ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
error_reporting(E_ERROR | E_PARSE);
 
$databaseHost = 'localhost';
$databaseName = 'absensi';
$databaseUsername = 'root';
$databasePassword = '';
 
$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName); 
 
?>
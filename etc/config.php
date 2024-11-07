<?php
/**
 * using mysqli_connect for database connection
 */

error_reporting(E_ERROR | E_PARSE);
 
$databaseHost = 'localhost';
$databaseName = 'absensi';
$databaseUsername = 'root';
$databasePassword = '';
 
$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName); 
 
?>
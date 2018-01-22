<?php
ini_set('error_reporting', 'E_COMPILE_ERROR|E_RECOVERABLE_ERROR|E_ERROR|E_CORE_ERROR');
include 'config.php';

// Make the PDO and the legacy database drivers mutually exclusive.
if (isset($dbh)) {
    die('Multiple DB handlers instantiated; aborting.');
}

$db = mysql_connect($host,$user,$password);
if (!$db) {
  die("Error;Unable to connect to MySQL at $host as $user: " . mysql_error());
}
if(!mysql_select_db($dbname, $db)) {
  die("Error;Unable to select database $dbname: " . mysql_error());
}
mysql_query("SET NAMES 'utf8'");
?>

<?php
session_start();
include 'db.php';

	// List of all airports
	$sql = "SELECT iata, name, city, country FROM airports where country='Canada' and iata ";
	$sql .= " in (select src_ap from routes) and dst='A'";
	print_r($sql);
	$result = mysql_query($sql, $db);
	print_r($result);
	$first = true;
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
//	  echo ("%s, %s, %s, %s ", $row["iata"], $row["name"], $row["city"], $row["country"]);
	  echo ("<option value=\"$row['iata']\">$row['iata']</option>";
	}
?>

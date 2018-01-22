<?php
include 'db.php';
 $match = "src_ap='" . $_GET['from'] . "' and dst_ap='" . $_GET['to'] . "'";
   $sql = "select airline,alid,src_ap, dst_ap, '-' as start_date, '-' as start_time from routes a where " . $match . " order by start_date, start_time " ;
	//print_r($sql);
  
// Execute!
$result = mysql_query($sql, $db);
$s="";
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
	$cost = 400 * (int)($_GET["noOfTravellers"]);
  $iata = '<tr><td>' . $row["airline"] . ' ' . $row["alid"] . '</td><td><button>USD '. $cost .'</button></td><td>'. $_GET["noOfTravellers"] .'</td><td>' . $row["src_ap"]  . '</td><td>' .  $row["dst_ap"]  . '</td><td>' . $_GET['dt'].'</td><td>' . $_GET['dt'] . '</td><td>2 hours</td></tr>';
  $s .= $iata ;  
}

	echo '<table id="flights" class="table">
    <thead>
      <tr>
        <th>Airline</th>
        <th>Cost</th>
        <th>No of Travellers</th>
        <th>Departure</th>
        <th>Arrival</th>
        <th>Departure Time</th>
        <th>Arrival Time</th>
        <th>Travel Duration</th>
      </tr>
    </thead>'.$s.
	
  '</table>';

?>

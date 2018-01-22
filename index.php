<?php
ini_set('error_reporting', 'E_COMPILE_ERROR|E_RECOVERABLE_ERROR|E_ERROR|E_CORE_ERROR');
//require_once("./php/locale.php");
require_once("./php/db.php");
//require_once("./php/helper.php");
//require_once("./php/airports.php");

?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Air Ticket Booking</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="bootstrap-3.3.7/dist/css/bootstrap.css" type="text/css">
        <link rel="stylesheet" href="bootstrap-3.3.7/dist/css/bootstrap.min.css" type="text/css">
        <script src="bootstrap-3.3.7/dist/js/jquery-3.3.1.min.js" type="text/javascript"></script>
        <script src="bootstrap-3.3.7/dist/js/bootstrap.min.js" type="text/javascript"></script>

        <style>
            nav, .jumbotron {
                margin-bottom: 0 !important;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="col-md-7"></div>
            <ul class="nav navbar-nav col-md-5">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#">Login</a></li>
                <li><a href="#">Signup</a></li>
                
            </ul>
        </nav>
        <div class="jumbotron">
            <h1 class="text-center">
                <a href="#">DOMESTIC AIR</a>
            </h1>
        </div>
		<hr  style="height:50px;color:black">

		<form name="searchFlight">
        <table align="center">
		<tr><td height="30">&nbsp;&nbsp;&nbsp;&nbsp;<b>From</b></td><td  height="30">&nbsp;&nbsp;&nbsp;&nbsp;<b>To</b></td></tr>
		<tr><td>
        <div class="col-md-4">
			<select id="fromAirport" name="fromAirport" size="5">
			<?php
				// List of all airports
				$sql = "SELECT iata, name, city, country FROM airports where country='Canada' and iata in (select src_ap from routes) and dst='A' ORDER BY IATA";
				$result = mysql_query($sql, $db);
				while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
					$iata = $row["iata"]  . ', ' .  $row["name"]  . ', ' .  $row["city"] . ', ' . $row["country"];
				  echo "<option value=\"".$row["iata"]."\">$iata</option>";
				}
			?>
			</select>
        </div>
		</td><td>
        <div class="col-md-4">
            
			<select id="toAirport" name="toAirport" size="5">
			<?php
				// List of all airports
				$sql = "SELECT iata, name, city, country FROM airports where country='Canada' and iata in (select dst_ap from routes) and dst='A' ORDER BY IATA";
				//print_r($sql);
				$result = mysql_query($sql, $db);
				while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
					$iata = $row["iata"]  . ', ' .  $row["name"]  . ', ' .  $row["city"] . ', ' . $row["country"];
				  echo "<option value=\"".$row["iata"]."\">$iata</option>";
				}
			?>
			</select>
			</td></tr>
        </div>
		<div><tr><td  height="30">&nbsp;&nbsp;&nbsp;&nbsp;<b>Date of Travel</b></td></div><div><td>&nbsp;&nbsp;&nbsp;&nbsp;<b>Number of Travellers</b></td></div></tr>
		<tr><td style="padding-left: 15px;"><input  type="date" id="dtOfTravel" value ="<?php echo date("Y-m-d");?>"></td>
		<td style="padding-left: 15px;"><input type="number" id="noOfTravellers" value="1"></td></tr>
		<div><tr><td  height="30"></td></div><div><td></td></div></tr>
		</table>
        <div  class="col-md-12 text-center">
            <button type="button" onclick="findFlights();" class="btn btn-default">Get Deals</button>
        </div>
	</form>
		<div id ="searchResults">
		</div>
		<hr size="30">
        <footer class="col-md-12 text-center">
            <div class="row">
                <div class="col-md-4">footer - 1</div>
                <div class="col-md-4">footer - 2</div>
                <div class="col-md-4">footer - 3</div>
            </div>
        </footer>
		<script>
			function findFlights(){
				var f = document.getElementById('fromAirport').value;
				var t = document.getElementById('toAirport').value;
				var dt = document.getElementById('dtOfTravel').value;
				var travellers = document.getElementById('noOfTravellers').value;
//				alert("./php/routes.php?from=" + f + '&to='+t+'&dt='+dt + '&travellers='+noOfTravellers);
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
//						alert(xhttp.responseText);
					   document.getElementById("searchResults").innerHTML = xhttp.responseText;
					}
				};
				xhttp.open("GET", "./php/routes.php?from=" + f + '&to='+t+'&dt='+dt + '&noOfTravellers='+travellers, true);
				xhttp.send();
			}
		</script>
    </body>
</html>

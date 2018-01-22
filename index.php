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
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <script src="bootstrap-3.3.7/dist/js/jquery-3.3.1.min.js" type="text/javascript"></script>
 <script src="bootstrap-3.3.7/dist/js/bootstrap.min.js" type="text/javascript"></script>

 <style>
 body {
   background-color: #f8f8f8 !important;
 }
 nav, .jumbotron {
  margin-bottom: 0 !important;
 }
 navbar-default .navbar-nav>.active>a, .navbar-default .navbar-nav>.active>a:focus, .navbar-default .navbar-nav>.active>a {
    color: #337ab7 !important;
    background-color: #e7e7e7 !important;
}
.navbar-default .navbar-nav>li>a {
    color: #337ab7 !important;
}
 .jumbotron {
  padding-top: 30px;
  padding-bottom: 30px;
  margin-bottom: 30px;
  color: inherit;
  background-color: #3a3434;
 }
 footer {
  position: absolute;
  margin-bottom: 0;
  width: 100%;
  /* Set the fixed height of the footer here */
  height: 71px;
  background-color: #3a3434;
 }
 ..row {
    margin-bottom: 0px;
}


 .fa {
  padding: 20px;
  font-size: 30px;
  width: 63px;
  text-align: center;
  text-decoration: none;
  margin: 0px 0px;
 }
 .fa-facebook {
  background: #3B5998;
  color: white;
 }

 .fa-twitter {
  background: #55ACEE;
  color: white;
 }

 .fa-google {
  background: #dd4b39;
  color: white;
 }

 .fa-youtube {
  background: #bb0000;
  color: white;
 }
 .fa-pinterest {
  background: #cb2027;
  color: white;
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
    <div class="col-md-4"><a href="#">About Us</a></div>
    <div class="col-md-4"><a href="#">Contact Us</div>
     <div class="col-md-4">
      <a href="#" class="fa fa-facebook"></a>
      <a href="#" class="fa fa-twitter"></a>
      <a href="#" class="fa fa-google"></a>
      <a href="#" class="fa fa-youtube"></a>
      <a href="#" class="fa fa-pinterest"></a>
     </div>
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

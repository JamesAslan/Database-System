<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>12307</title>
<link rel="stylesheet" type="text/css" href="style.css"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css"/>
<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,300,400italic,600,700,900' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Ubuntu:400,300,500,700' rel='stylesheet' type='text/css'>
<script src="js/jquery.min.js"></script>
</head>
<style type="text/css">
@import url(https://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100);
body {
  background-color: #3e94ec;
  font-family: "Roboto", helvetica, arial, sans-serif;
  font-size: 16px;
  font-weight: 400;
  text-rendering: optimizeLegibility;
}

div.table-title {
   display: block;
  margin: auto;
  max-width: 600px;
  padding:5px;
  width: 100%;
}
.table-title h3 {
   color: #fafafa;
   font-size: 20px;
   font-weight: 400;
   font-style:normal;
   font-family: "Roboto", helvetica, arial, sans-serif;
   text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);
   text-transform:uppercase;
}
/*** Table Styles **/
.table-fill {
  background: white;
  border-radius:3px;
  border-collapse: collapse;

  margin: auto;
  max-width: 600px;
  padding:2px;
  width: 100%;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
  animation: float 5s infinite;
  white-space: nowrap;
}
 
th {
  color:#D5DDE5;
  background:#1b1e24;
  border-bottom:2px solid #9ea7af;
  border-right: 1px solid #343a45;
  font-size:18px;
  font-weight: 100;
  padding:2px;
  text-align:center;
  text-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
  vertical-align:middle;
}

th:first-child {
  border-top-left-radius:3px;}
 
th:last-child {
  border-top-right-radius:3px;
  border-right:none;}
  
tr {
  border-top: 1px solid #C1C3D1;
  border-bottom-: 1px solid #C1C3D1;
  color:#666B85;
  font-size:16px;
  font-weight:normal;
  text-shadow: 0 1px 1px rgba(256, 256, 256, 0.1);}
 
tr:hover td {
  background:#4E5066;
  color:#FFFFFF;
  border-top: 1px solid #22262e;}
 
tr:first-child {
  border-top:none;}

tr:last-child {
  border-bottom:none;}
 
tr:nth-child(odd) td {
  background:#EBEBEB;}
 
tr:nth-child(odd):hover td {
  background:#4E5066; }

tr:last-child td:first-child {
  border-bottom-left-radius:3px;}
 
tr:last-child td:last-child {
  border-bottom-right-radius:3px;}
 
td {
  background:#FFFFFF;
  padding:7px;
  text-align:center;
  vertical-align:middle;
  font-weight:300;
  font-size:18px;
  text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);
  border-right: 1px solid #C1C3D1;
}
td:last-child {
  border-right: 0px;}
th.text-left {
  text-align: center;}
th.text-center {
  text-align: center;}
th.text-right {
  text-align: right;}
td.text-left {
  text-align: left;}
td.text-center {
  text-align: center;}
td.text-right {
  text-align: right;}

p
  {
  white-space: nowrap  }
</style>
<body>
<div class="header">
  <div class="container">
    <div class="navbar menubar" id="menu">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle menu-button" data-toggle="collapse" data-target="#myNavbar"> <span class="glyphicon glyphicon-align-justify set"></span> </button>
          <a class="navbar-brand logo" href="#">12307</a> </div>
        <div class="navdiv">
          <nav class="collapse navbar-collapse navset" id="myNavbar" role="navigation">
            <ul class="nav navbar-nav navbar-right navstyle navb">
              <li><a href="index.php" class="page-scroll active">主页</a></li>
              <li><a href="login.php" class="page-scroll">登录</a></li>
              <li><a href="admin.php" class="page-scroll">我的订单</a></li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="banner">
  <div class="container">
  <h1><font size="10" face="verdana" color="white">控制台</font></h1>
  </div>
</br>

<div id="result" align ="center" class="table-title">
<h5><font size="5">result</font></h5>
</div>
</br>
<table class="table-fill">
<thead>
<tr>
<th class="text-left">total orders</th>
<th class="text-left">total price</th>
</tr>
</thead>
<tbody class="table-hover">
<?php
  $user = $_SESSION['loginname'];

  if($user!="admin")
  {
    echo "<script>alert('您无访问权限！');window.location.href='login.php';</script>"; 
  }

$dbconn = pg_connect("dbname=ticket user=dbms password=dbms")
    or die('Could not connect: ' . pg_last_error());

$current_user = "Admin";

// Total Orders
$query = "select count(distinct OrderID) 
from orders;";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

$line = pg_fetch_array($result, null, PGSQL_BOTH);
echo "<tr>\n<td>\n".$line[0]."</td>";
echo "\n";
// Free resultset
pg_free_result($result);
// Sum Prices
$query = "select sum(OrderPrice)
from orders;";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());
$line = pg_fetch_array($result, null, PGSQL_BOTH);
echo "<td>\n".$line[0]."</td></tr>";
echo "\n";
// Free resultset
pg_free_result($result);
?>
</tbody>
</table>


<div id="result" align ="center" class="table-title">
<h5><font size="5">Train</font></h5>
</div>
<table class="table-fill">
<thead>
<tr>
<th class="text-left">hot train</th>
<th class="text-left">ticket number</th>
</tr>
</thead>
<tbody class="table-hover">
<?php

$query = "select TrainID, count(*) as OrderTimes
from orders
group by TrainID
order by OrderTimes desc limit 10;";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

// Printing results in HTML
while ($line = pg_fetch_array($result, null, PGSQL_BOTH)) {
    echo "\t<tr>\n";
        echo "\t\t<td>".$line[0]."</td>\n";
        echo "\t\t<td>".$line[1]."</td>\n";
    echo "\t</tr>\n";
}
echo "\n";

// Free resultset
pg_free_result($result);
?>
</tbody>
</table>

<div id="result" align ="center" class="table-title">
<h5><font size="5">Users</font></h5>
</div>
<table class="table-fill">
<thead>
<tr>
<th class="text-left">userid</th>
<th class="text-left">phone</th>
<th class="text-left">creditcard</th>
<th class="text-left">username</th>
<th class="text-left">realname</th>
</tr>
</thead>
<tbody class="table-hover">
<?php

$query = "select *
from users;";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

while ($line = pg_fetch_array($result, null, PGSQL_BOTH)) {
    echo "\t<tr>\n";
    echo "<td><a href=orderpage.php?userid=". $line[3]. ">".$line[0]. "</a></td>\n";
    for ($x=1; $x<5; $x++)
      echo "<td>".$line[$x]."</td>\n";
    echo "\t</tr>\n";
}

// Free resultset
pg_free_result($result);
pg_close($dbconn);
?>
</tbody>
</table>

  </div>
  </div>
</div>


<div class="footer">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-sm-6 col-xs-6">
        <div class="quicklinks">
          <h4 class="footerh">Quick Links</h4>
          <ul>
            <li><i class="fa fa-angle-right"></i> <a href="index.php">Home</a></li>
            <li><i class="fa fa-angle-right"></i> <a href="index.php">About us</a></li>
          </ul>
        </div>
      </div>
      <div class="col-md-6 col-sm-6 col-xs-6">
        <div class="quickcontact">
          <h4 class="footerh">Quick Contact</h4>
          <ul>
            <li><i class="fa fa-envelope"></i> ucas.ac.cn</li>
            <li><i class="fa fa-map-marker"></i> UCAS</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<footer>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <p>Copyright LGD & LPH & LYW</a></p>
      </div>
    </div>
  </div>
</footer>
<script src="js/bootstrap.min.js"></script>
</body>
</html>

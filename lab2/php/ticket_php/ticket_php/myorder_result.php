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
              <li><a href="#testimonials" class="page-scroll">我的订单</a></li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="banner">
  <div class="container">
  <h1><font size="10" face="verdana" color="white">欢迎, <?php echo $_SESSION['loginname'];?></font></h1>
  </div>
    <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 text-center">
        <div class="schbox">
          
          <div class="col-md-6 col-sm-12 col-xs-12 working">
              <div class="schbox-title">
                <h2>订单查询</h2>
              </div>
                <form action= "myorder_result.php" method="post" >
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                <input type="date" class="form-control" value="2017-11-24" name="sdate" placeholder="请在此输入出发日期">
                </div>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                  <input type="date" class="form-control" value="2017-11-30" name="edate" placeholder="请在此输入出发日期">
                </div>
              </div>
              <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                <button type="submit" class="btn orange">查询</button>
              </div>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
</div>
</br>
<div id="result" align ="center" class="table-title">
<h5><font size="5">订单查询</font></h5>
</div>
</br>
<table class="table-fill">
<thead>
<tr>
<th class="text-left">订单号</th>
<th class="text-left">出发日期</th>
<th class="text-left">出发站</th>
<th class="text-left">到达站</th>
<th class="text-left">价格</th>
<th class="text-left">订单状态</th>
</tr>
</thead>
<tbody class="table-hover">
<?php
$dbconn = pg_connect("dbname=ticket user=dbms password=dbms")
    or die('Could not connect: ' . pg_last_error());
$sdate = $_POST["sdate"];
$edate = $_POST["edate"];
$user =  $_SESSION['loginname'];
// Performing SQL query
$query = "select OrderID, Orders.StartDate, TS1.StationName, TS2.StationName, Sum(OrderPrice), Status, Orders.TrainID, TS1.StartTime as starttime, TS2.ArriveTime as arrivetime, Orders.seattype, orderprice
from Orders, TrainStation as TS1, TrainStation as TS2
where TS1.OuterStationID = Orders.StartStationOuterID and
        TS2.OuterStationID = Orders.EndStationOuterID and
        TS1.TrainID = Orders.TrainID and
        TS2.TrainID = Orders.TrainID and
        Orders.UserId = '$user' and
        Orders.StartDate >= '$sdate' and
        Orders.StartDate <= '$edate'
group by OrderID, Orders.StartDate, TS1.StationName, TS2.StationName, Status, Orders.TrainID, TS1.starttime, TS2.arrivetime
order by OrderID;";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

// Printing results in HTML
$last_orderid = "0";
$last_price = 0;
while ($line = pg_fetch_array($result, null, PGSQL_BOTH)) {
    echo "\t<tr>\n";
    
    echo "\t\t<td><a href='detail.php?orderid=" . $line[0] . "&startdate=" .$line[1] . "&starttime=" . $line[7] . "&arrivetime=" . $line[8]. "&seattype=" .$line[9]. "&trainid=" . $line[6] . "&price=" . $line[10] . "&sdate=" . $sdate. "&edate=". $edate. "'>" . $line[0]. "</a></td>";

    for ($x=1; $x <=4; $x++) {
        echo "\t\t<td>$line[$x]</td>";
    }
    switch ($line[5]) 
    {
        case "0":
            echo "\t\t<td>等待付款</td><td><a href='pay.html?orderid=$line[0]'>付款</a></td>";
            break;
        case "1":
            echo "\t\t<td>付款成功</td><td><a href='cancel.php?orderid=$line[0]&trainid=$line[6]'>取消订单</a></td>";
            break;
        case "-1":
            echo "\t\t<td>订单已取消</td>";
            break;
    }

    if ($last_orderid != $line[0]) {
        echo "\t</tr>\n\n";
    }
    else {
        echo "\t\t</tr>\n\n";
        echo "\t\t\t\t<tr><td>小计: $line[4] + $last_price\t\t</td></tr>\n";
    }

    $last_orderid = $line[0];
    $last_price = $line[4];
    echo "\t</tr>\n";
}
echo "</table>\n";

// Free resultset
pg_free_result($result);

// Closing connection
pg_close($dbconn);
?>
</tbody>
</table>


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


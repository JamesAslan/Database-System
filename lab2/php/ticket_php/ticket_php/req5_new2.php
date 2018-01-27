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

<?php
$startcity = $_REQUEST["startcity"];
$endcity = $_REQUEST["endcity"];
$date = $_REQUEST["date"];
$time = $_REQUEST["time"];
?>

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
              <li><a href="myorder.php" class="page-scroll">我的订单</a></li>
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

  <div id="begin" class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 text-center">
        <div class="schbox">
          <div class="col-md-6 col-sm-12 col-xs-12 appointment">
            <div class="schbox-title">
              <h2>按车次搜索</h2>
            </div>
            <form action= "req4_new.php#begin" method="post" class="searchwithid">
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                  <input type="text" class="form-control" name="trainid" placeholder="请在此输入车次，例如G1">
                </div>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                  <input type="date" value=<?php echo "'".$date."'"?> name="date" class="form-control" />
                </div>
              </div>
              <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                <button type="submit" class="btn orange">Go</button>
              </div>
            </form>
          </div>
          <div class="col-md-6 col-sm-12 col-xs-12 working">
              <div class="schbox-title">
                <h2>按城市搜索</h2>
              </div>
              <form action= "req5_new.php" method="post" class="searchwithcity">
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                  <input type="text" class="form-control" name="startcity" value=<?php echo "'".$startcity."'"?>>
                   </div>
                <div class="form-group">
                <input type="date" class="form-control" value=<?php echo "'".$date."'"?> name="date" placeholder="请在此输入出发日期">
                <div class="form-group">
               <input type="checkbox" Name='checkbox2[]' id="brand2" value="1">             
                <label for="brand2"><span></span>查询返程</label>
                </div>
                </div>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                <input type="text" class="form-control" name="endcity" value=<?php echo "'".$endcity."'"?>>  
                 </div>
                <div class="form-group">
                     <input type="time" class="form-control" name="time" value=<?php echo "'".$time."'"?>>
                </div>
              </div>
              <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                <button type="submit" class="btn orange">Go</button>
              </div>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</br>

</br>
<div align ="center" class="table-title">
<h5><font size="5">换乘方案</font></h5>
</div>
</br>
<table class="table-fill">
<thead>
<tr>
<th class="text-left">换乘地点</th>
<th class="text-left">车次</th>
<th class="text-left">出发站</br>到达站</th>
<th class="text-left">出发时间</br>到达时间</th>
<th class="text-left">硬座</th>
<th class="text-left">软座</th>
<th class="text-left">硬卧上</th>
<th class="text-left">硬卧中</th>
<th class="text-left">硬卧下</th>
<th class="text-left">软卧上</th>
<th class="text-left">软卧下</th>
<th class="text-left">预定</th>
</tr>
</thead>
<tbody class="table-hover">
<?php
$dbconn = pg_connect("dbname=ticket user=dbms password=dbms")
    or die('Could not connect: ' . pg_last_error());

$query3="(select    
        (ot1.MinPrice + ot2.MinPrice )as FinalMinPrice,
        (ot2.TripTimemin + ot2.TripTimemin) as FinalTripTimeMin,
        ot1.TrainID as Train1ID, 
        (ast1.StartDate + ot1.BeginDeltaday) :: date as Train1StartDate, 
        (ast1.StartDate + ot1.EndDeltaDay) :: date as Train1EndDate, 
        ot1.BeginStationName,ot1.BeginCityName, ot1.MinPrice as Train1MinPrice, ot1.TripTimemin as Train1TripTimeMin,
        ot1.BeginTime as Train1BeginTime, ot1.EndTime as Train1EndTime,

        ot1.EndStationName as Train1EndStationName, 
        ot1.EndCityName as TransferCityName,

        ot2.TrainID as Train2ID, 
        (ast2.StartDate + ot2.BeginDeltaday):: date as Train2STartDate,
        (ast2.StartDate + ot2.EndDeltaday):: date as Train2EndDate,
        ot2.BeginStationName as Train2BeginStationName,ot2.MinPrice as Train2MinPrice, ot2.TripTimemin as Train2TripTimeMin,
        ot2.EndStationName,  ot2.EndCityName,
        ot2.BeginTime as Train2BeginTime, ot2.EndTime as Train2EndTime,
        
        ot1.PriceYZ  as Train1PriceYZ, ot2.PriceYZ as Train2PriceYZ, ot1.PriceRZ as Train1PriceRZ, ot2.PriceRZ as Train2PriceRZ, 
        ot1.PriceYWS as Train1PriceYWS, ot2.PriceYWS as Train2PriceYWS, ot1.PriceYWZ as Train1PriceYWZ, ot2.PriceYWZ as  Train2PriceYWZ, 
        ot1.PriceYWX as Train1PriceYWX,ot2.PriceYWX as Train2PriceYWX, ot1.PriceRWS as Train1PriceRWS,ot2.PriceRWS as Train2PriceRWS, 
        ot1.PriceRWX as Train1PriceRWX, ot2.PriceRWX as Train2PriceRWX,

        min(ast1.YZCount)  as Train1YZCount,  min(ast1.RZCount) as Train1RZCount,
        min(ast1.YWSCount) as Train1YWSCount, min(ast1.YWZCount)  as Train1YWZCount, min(ast1.YWXCount) as Train1YWXCount, 
        min(ast1.RWSCount) as Train1RWSCount, min(ast1.RWXCount) as Train1RWXCount, 

        min(ast2.YZCount)  as  Train2YZCount,  min(ast2.RZCount) as Train2RZCount,
        min(ast2.YWSCount) as Train2YWSCount, min(ast2.YWZCount)  as Train2YWZCount, min(ast2.YWXCount) as Train2YWXCount, 
        min(ast2.RWSCount) as Train2RWSCount, min(ast2.RWXCount) as Train2RWXCount,
        tl1.YZen as Train1YZen, tl1.RZen as Train1RZen, tl1.YWSen as Train1YWSen, tl1.YWZen as Train1YWZen,
        tl1.YWXen as Train1YWXen , tl1.RWSen as Train1RWSen, tl1.RWXen as Train1RWXen,
        tl2.YZen as Train2YZen, tl2.RZen as Train2RZen, tl2.YWSen as Train2YWSen, tl2.YWZen as Train2YWZen,
        tl2.YWXen as Train2YWXen , tl2.RWSen as Train2RWSen, tl2.RWXen as Train2RWXen,
        ot1.BeginstationID as begin1, ot1.BeginStationOut as beginout1, ot1.EndStationID as end1, ot1.EndStationOut as endout1,
        ot2.BeginstationID as begin2, ot2.BeginStationOut as beginout2, ot2.EndStationID as end2, ot2.EndStationOut as endout2,
        ast1.StartDate  as startdate1, ast2.StartDate as startdate2

into TransferTickets
from      OneTrip as ot1, OneTrip as ot2 , AvailableSeat as ast1, AvailableSeat ast2, TrainList as tl1, TrainList as tl2
where   tl1.TrainId = ot1.TrainID and tl2.TrainID = ot2.TRainID and 
        ot1.BeginCityName = '$startcity' and ot2.EndCityName = '$endcity' and 
        ot1.EndCityName = ot2.BeginCityName and 
        (   (ot1.EndStationOut = ot2.BeginStationOut  
        and (  ((ot2.BeginTime - ot1.EndTime)> '0 min' and ((ot2.BeginTime - ot1.EndTime ) between interval'1 hour' and  interval'4 hour')) 
            ))  or
            (ot1.EndStationOut <>ot2.BeginStationOut  
        and (  ((ot2.BeginTime - ot1.EndTime)> '0 min' and ((ot2.BeginTime - ot1.EndTime ) between interval'2 hour' and  interval'4 hour')) 
        )) ) 
        and 
        (ot1.BeginTime - '$time') >= '0 min' and 
        (ast1.StartDate + ot1.BeginDeltaday) = '$date'and   ( ast2.StartDate + ot2.BeginDeltaday) = (ast1.StartDate + ot1.EndDeltaday)  and

        ot1.TrainID = ast1.TrainID and ast1.InnerStationID > ot1.BeginStationID and ast1.InnerStationID <= ot1.EndStationID and
        ot2.TrainID = ast2.TrainID and 
        (ast2.InnerStationID > ot2.BeginStationID and ast2.InnerStationID <= ot2.EndStationID   ) 

group by
        ot1.BeginCityName,ot1.EndCityName ,ot2.EndCityName,
        ot1.TrainID ,ast1.StartDate, ot1.BeginDeltaday,ot2.BeginDeltaday,ot2.BeginDeltaday,ot1.EndDeltaday,ot2.EndDeltaday,
        ot1.BeginStationName, ot1.EndStationName , Train1MinPrice, Train1TripTimeMin,
        ot1.BeginTime, ot1.EndTime ,

        ot2.TrainID , ast2.StartDate,
        ot2.BeginStationName ,ot2.EndStationName, Train2MinPrice, Train2TripTimeMin,
        ot2.BeginTime , ot2.EndTime,    

        ot1.PriceYZ ,  ot1.PriceRZ ,ot1.PriceYWS ,ot1.PriceYWZ ,ot1.PriceYWX, ot1.PriceRWS,
        ot1.PriceRWX,
        ot2.PriceYZ,ot2.PriceRZ ,  ot2.PriceYWS ,  ot2.PriceYWZ, ot2.PriceYWX,ot2.PriceRWS,  ot2.PriceRWX,
        Train1YZen, Train1RZen, Train1YWSen, Train1YWZen,
        Train1YWXen , Train1RWSen, Train1RWXen,
        Train2YZen, Train2RZen,  Train2YWSen, Train2YWZen,
        Train2YWXen , Train2RWSen,  Train2RWXen,
        begin1, beginout1, end1, endout1,
        begin2, beginout2, end2, endout2  

 )union(
        select
        (ot1.MinPrice + ot2.MinPrice )as FinalMinPrice,
        (ot2.TripTimemin + ot2.TripTimemin) as FinalTripTimeMin,
        ot1.TrainID as Train1ID, 
        (ast1.StartDate + ot1.BeginDeltaday) :: date as Train1StartDate, 
        (ast1.StartDate + ot1.EndDeltaDay) :: date as Train1EndDate, 
        ot1.BeginStationName,ot1.BeginCityName, ot1.MinPrice as Train1MinPrice, ot1.TripTimemin as Train1TripTimeMin,
        ot1.BeginTime as Train1BeginTime, ot1.EndTime as Train1EndTime,

        ot1.EndStationName as Train1EndStationName, 
        ot1.EndCityName as TransferCityName,

        ot2.TrainID as Train2ID, 
        (ast2.StartDate + ot2.BeginDeltaday):: date as Train2STartDate,
        (ast2.StartDate + ot2.EndDeltaday):: date as Train2EndDate,
        ot2.BeginStationName as Train2BeginStationName,ot2.MinPrice as Train2MinPrice, ot2.TripTimemin as Train2TripTimeMin,
        ot2.EndStationName,  ot2.EndCityName,
        ot2.BeginTime as Train2BeginTime, ot2.EndTime as Train2EndTime,
        
        ot1.PriceYZ  as Train1PriceYZ, ot2.PriceYZ as Train2PriceYZ, ot1.PriceRZ as Train1PriceRZ, ot2.PriceRZ as Train2PriceRZ, 
        ot1.PriceYWS as Train1PriceYWS, ot2.PriceYWS as Train2PriceYWS, ot1.PriceYWZ as Train1PriceYWZ, ot2.PriceYWZ as  Train2PriceYWZ, 
        ot1.PriceYWX as Train1PriceYWX,ot2.PriceYWX as Train2PriceYWX, ot1.PriceRWS as Train1PriceRWS,ot2.PriceRWS as Train2PriceRWS, 
        ot1.PriceRWX as Train1PriceRWX, ot2.PriceRWX as Train2PriceRWX,

        min(ast1.YZCount)  as Train1YZCount,  min(ast1.RZCount) as Train1RZCount,
        min(ast1.YWSCount) as Train1YWSCount, min(ast1.YWZCount)  as Train1YWZCount, min(ast1.YWXCount) as Train1YWXCount, 
        min(ast1.RWSCount) as Train1RWSCount, min(ast1.RWXCount) as Train1RWXCount, 

        min(ast2.YZCount)  as  Train2YZCount,  min(ast2.RZCount) as Train2RZCount,
        min(ast2.YWSCount) as Train2YWSCount, min(ast2.YWZCount)  as Train2YWZCount, min(ast2.YWXCount) as Train2YWXCount, 
        min(ast2.RWSCount) as Train2RWSCount, min(ast2.RWXCount) as Train2RWXCount,

        tl1.YZen as Train1YZen, tl1.RZen as Train1RZen, tl1.YWSen as Train1YWSen, tl1.YWZen as Train1YWZen,
        tl1.YWXen as Train1YWXen , tl1.RWSen as Train1RWSen, tl1.RWXen as Train1RWXen,
        tl2.YZen as Train2YZen, tl2.RZen as Train2RZen, tl2.YWSen as Train2YWSen, tl2.YWZen as Train2YWZen,
        tl2.YWXen as Train2YWXen , tl2.RWSen as Train2RWSen, tl2.RWXen as Train2RWXen,

        ot1.BeginstationID as begin1, ot1.BeginStationOut as beginout1, ot1.EndStationID as end1, ot1.EndStationOut as endout1,
        ot2.BeginstationID as begin2, ot2.BeginStationOut as beginout2, ot2.EndStationID as end2, ot2.EndStationOut as endout2,
        ast1.StartDate  as startdate1, ast2.StartDate as startdate2

from    OneTrip as ot1, OneTrip as ot2 , AvailableSeat as ast1, AvailableSeat ast2, TrainList as tl1, TrainList as tl2
where   tl1.TrainId = ot1.TrainID and tl2.TrainID = ot2.TRainID and 
        ot1.BeginCityName = '$startcity' and ot2.EndCityName = '$endcity' and 
        ot1.EndCityName = ot2.BeginCityName and 
        (   (ot1.EndStationOut = ot2.BeginStationOut  
        and (  ((ot2.BeginTime - ot1.EndTime)< '0 min'and ((ot2.BeginTime - ot1.EndTime+ interval'1 day') between interval'1 hour' and  interval'4 hour'))
            ))  or
            (ot1.EndStationOut <>ot2.BeginStationOut  
        and (   ((ot2.BeginTime - ot1.EndTime)< '0 min'and ((ot2.BeginTime - ot1.EndTime+ interval'1 day') between interval'2 hour' and  interval'4 hour'))
            ) ))
        and 

        (ot1.BeginTime -  '$time') >= '0 min' and 
        (ast1.StartDate + ot1.BeginDeltaday) = '$date'and   ( ast2.StartDate + ot2.BeginDeltaday) =(ast1.StartDate + ot1.EndDeltaday + '1 day') and
        ot1.TrainID = ast1.TrainID and ast1.InnerStationID > ot1.BeginStationID and ast1.InnerStationID <= ot1.EndStationID and
        ot2.TrainID = ast2.TrainID and 
        (ast2.InnerStationID > ot2.BeginStationID and ast2.InnerStationID <= ot2.EndStationID   ) 

group by
        ot1.BeginCityName,ot1.EndCityName ,ot2.EndCityName,
        ot1.TrainID ,ast1.StartDate,ot1.BeginDeltaday,ot2.BeginDeltaday,ot1.EndDeltaday,ot2.EndDeltaday,
        ot1.BeginStationName, ot1.EndStationName , Train1MinPrice, Train1TripTimeMin,
        ot1.BeginTime, ot1.EndTime ,

        ot2.TrainID , ast2.StartDate,
        ot2.BeginStationName ,ot2.EndStationName, Train2MinPrice, Train2TripTimeMin,
        ot2.BeginTime , ot2.EndTime,    

        ot1.PriceYZ ,  ot1.PriceRZ ,ot1.PriceYWS ,ot1.PriceYWZ ,ot1.PriceYWX, ot1.PriceRWS,
        ot1.PriceRWX,
        ot2.PriceYZ,ot2.PriceRZ ,  ot2.PriceYWS ,  ot2.PriceYWZ, ot2.PriceYWX,ot2.PriceRWS,  ot2.PriceRWX,
        Train1YZen, Train1RZen, Train1YWSen, Train1YWZen,
        Train1YWXen , Train1RWSen, Train1RWXen,
        Train2YZen, Train2RZen,  Train2YWSen, Train2YWZen,
        Train2YWXen , Train2RWSen,  Train2RWXen,
        begin1, beginout1, end1, endout1,
        begin2, beginout2, end2, endout2    
        
)
order by FinalMinPrice, FinalTripTimeMin, Train1BeginTime, Train2BeginTime
asc limit 10 offset 0;";
pg_query($query3);
$query4= "select * from TransferTickets;";
$result2=pg_query($query4) or die('Query failed: ' . pg_last_error());

    for($lt = 0; $lt < pg_num_rows($result2); $lt++) 
    {
        echo "<tr>\n";
                echo "<form action= 'booking_new.php?train1id=" . pg_result($result2, $lt,2) . "&startdate1=" . pg_result($result2, $lt,3) . "&startoutid1=" . pg_result($result2, $lt,66) . "&endoutid1=" . pg_result($result2, $lt,68). "&startinid1=" .pg_result($result2, $lt,65). "&endinid1=" .pg_result($result2, $lt,67). "&train1yz=" . pg_result($result2, $lt,23) ."&train1rz=" . pg_result($result2, $lt,25) ."&train1yws=" . pg_result($result2, $lt,27) ."&train1ywz=" . pg_result($result2, $lt,29) ."&train1ywx=" . pg_result($result2, $lt,31) ."&train1rws=" . pg_result($result2, $lt,33) ."&train1rwx=" .pg_result($result2, $lt,35) . "&startstation1=" . pg_result($result2, $lt,5) ."&arrivestation1=" .pg_result($result2, $lt,11)."&starttime1=" . pg_result($result2, $lt,9)."&enddate1=". pg_result($result2, $lt,4)."&endtime1=" .pg_result($result2, $lt,10)."&train2id=" . pg_result($result2, $lt,13)."&startdate2=" . pg_result($result2, $lt,14) . "&startoutid2=" . pg_result($result2, $lt,70) . "&endoutid2=" . pg_result($result2, $lt,72). "&startinid2=" .pg_result($result2, $lt,69). "&endinid2=" .pg_result($result2, $lt,71). "&train2yz=" . pg_result($result2, $lt,24) ."&train2rz=" . pg_result($result2, $lt,26) ."&train2yws=" . pg_result($result2, $lt,28) ."&train2ywz=" . pg_result($result2, $lt,30) ."&train2ywx=" . pg_result($result2, $lt,32) ."&train2rws=" . pg_result($result2, $lt,34) ."&train2rwx=" . pg_result($result2, $lt,36) . "&startstation2=" . pg_result($result2, $lt,16) ."&arrivestation2=" .pg_result($result2, $lt,19)."&starttime2=" . pg_result($result2, $lt,21)."&enddate2=". pg_result($result2, $lt,15)."&endtime2=" .pg_result($result2, $lt,22). "&ticketdate1=" .pg_result($result2, $lt,73). "&ticketdate2=" .pg_result($result2, $lt,74)."'" . " method='post' >";

                echo "<td rowspan= '2'>在</br>" . pg_result($result2, $lt,11) . "</br>换乘</td>\n";
                //Train1
                echo "<td >" . pg_result($result2, $lt,2) .  "</td>\n";  //Train1ID
                echo "<td >" . pg_result($result2, $lt,5) . "</br>" . pg_result($result2, $lt,11) . "</td>\n";  
                echo "<td >" . pg_result($result2, $lt,3) ." ". pg_result($result2, $lt,9) . "</br>" . pg_result($result2, $lt,4) ." " . pg_result($result2, $lt,10) ."</td>\n"; 
                //Train1-Price 
            if(pg_result($result2, $lt, 51) == 1) //Train1 YZ
            {
                if(pg_result($result2, $lt, 37) > 0){
                      echo "<td align='center'> <input type='radio' name='train1seat' value='0'>余" . pg_result($result2, $lt,37) . "</br>￥" . pg_result($result2, $lt, 23) . "</td>\n" ;}
                else {echo "<td align='center'> 0 </td>";}
            }
            else{echo "<td align='center'> - </td>\n";}
            if(pg_result($result2, $lt, 52) == 1) //RZ
            {
                if(pg_result($result2, $lt, 38) > 0){
                      echo "<td align='center'> <input type='radio' name='train1seat' value='1'>余" . pg_result($result2, $lt,38) . "</br>￥" . pg_result($result2, $lt, 25) . "</td>\n" ;}
                else {echo "<td align='center'> 0 </td>";}
            }
            else{echo "<td align='center'> - </td>\n";}
            if(pg_result($result2, $lt, 53) == 1) //YWS
            {
                if(pg_result($result2, $lt, 39) > 0){
                      echo "<td align='center'> <input type='radio' name='train1seat' value='2'>余" . pg_result($result2, $lt,39) . "</br>￥" . pg_result($result2, $lt, 27) . "</td>\n" ;}
                else {echo "<td align='center'> 0 </td>";}
            }
            else{echo "<td align='center'> - </td>\n";}
            if(pg_result($result2, $lt, 54) == 1) //YWZ
            {
                if(pg_result($result2, $lt, 40) > 0){
                  echo "<td align='center'> <input type='radio' name='train1seat' value='3'>余" . pg_result($result2, $lt,40) . "</br>￥" . pg_result($result2, $lt, 29) . "</td>\n" ;}
                else {echo "<td align='center'> 0 </td>";}
            }
            else{echo "<td align='center'> - </td>\n";}
            if(pg_result($result2, $lt, 55) == 1) //YWX
            {
                if(pg_result($result2, $lt, 41) > 0){
                  echo "<td align='center'> <input type='radio' name='train1seat' value='4'>余" . pg_result($result2, $lt,41) . "</br>￥" . pg_result($result2, $lt, 31) .  "</td>\n" ;}
                else {echo "<td align='center'> 0 </td>";}
            }
            else{echo "<td align='center'> - </td>\n";}
            if(pg_result($result2, $lt, 56) == 1) //RWS
            {
                if(pg_result($result2, $lt, 42) > 0){
                  echo "<td align='center'> <input type='radio' name='train1seat' value='5'>余" . pg_result($result2, $lt,42) . "</br>￥" . pg_result($result2, $lt, 33) . "</td>\n" ;}
                else {echo "<td align='center'> 0 </td>";}
            }
            else{echo "<td align='center'> - </td>\n";}
            if(pg_result($result2, $lt, 57) == 1) //RWX
            {
                if(pg_result($result2, $lt, 43) > 0){
                  echo "<td align='center'> <input type='radio' name='train1seat' value='6'>余" . pg_result($result2, $lt,43) . "</br>￥" . pg_result($result2, $lt, 35) . "</td>\n" ;}
                else {echo "<td align='center'> 0 </td>";}
            }
            else{echo "<td align='center'> - </td>\n";}
            
        echo "<td rowspan= '2'>
                <button type='submit' class='btn orange'>立即</br>预定</button>
                </td>";

        echo "</tr>\n";
            //Train2
        echo "<tr>\n";
                echo "<td >" . pg_result($result2, $lt,13) .  "</td>\n";  //Train2ID
                echo "<td >" . pg_result($result2, $lt,16) . "</br>" . pg_result($result2, $lt,19) . "</td>\n";  
                echo "<td >" . pg_result($result2, $lt,14) ." ". pg_result($result2, $lt,21) . "</br>" . pg_result($result2, $lt,15) ." " . pg_result($result2, $lt,22) ."</td>\n"; 
                //Train2-Price - 2 rows
            if(pg_result($result2, $lt, 58) == 1) //Train2 YZ
            {
                if(pg_result($result2, $lt, 44) > 0){
                    echo "<td align='center'> <input type='radio' name='train2seat' value='0'>余" . pg_result($result2, $lt,44) . "</br>￥" . pg_result($result2, $lt, 24) . "</td>\n" ;}
                else {echo "<td align='center'> 0 </td>";}
            }
            else{echo "<td align='center'> - </td>\n";}
            if(pg_result($result2, $lt, 59) == 1) //RZ
            {
                if(pg_result($result2, $lt, 45) > 0){
                echo "<td align='center'> <input type='radio' name='train2seat' value='1'>余" . pg_result($result2, $lt,45) ."</br>￥" . pg_result($result2, $lt, 26) .  "</td>\n" ;}
                else {echo "<td align='center'> 0 </td>";}
            }
            else{echo "<td align='center'> - </td>\n";}
            if(pg_result($result2, $lt, 60) == 1) //YWS
            {
                if(pg_result($result2, $lt, 46) > 0){
                    echo "<td align='center'> <input type='radio' name='train2seat' value='2'>余" . pg_result($result2, $lt,46) . "</br>￥" . pg_result($result2, $lt, 28) . "</td>\n" ;}
                else {echo "<td align='center'> 0 </td>";}
            }
            else{echo "<td align='center'> - </td>\n";}
            if(pg_result($result2, $lt, 61) == 1) //YWZ
            {
                if(pg_result($result2, $lt, 47) > 0){
                    echo "<td align='center'> <input type='radio' name='train2seat' value='3'>余" . pg_result($result2, $lt,47) . "</br>￥" . pg_result($result2, $lt, 30) . "</td>\n" ;}
                else {echo "<td align='center'> 0 </td>";}
            }
            else{echo "<td align='center'> - </td>\n";}
            if(pg_result($result2, $lt, 62) == 1) //YWX
            {
                if(pg_result($result2, $lt, 48) > 0){
                    echo "<td align='center'> <input type='radio' name='train2seat' value='4'>余" . pg_result($result2, $lt,48) ."</br>￥" . pg_result($result2, $lt, 32) .  "</td>\n" ;}
                else {echo "<td align='center'> 0 </td>";}
            }
            else{echo "<td align='center'> - </td>\n";}
            if(pg_result($result2, $lt, 63) == 1) //RWS
            {
                if(pg_result($result2, $lt, 49) > 0){
                    echo "<td align='center'> <input type='radio' name='train2seat' value='5'>余" . pg_result($result2, $lt,49) . "</br>￥" . pg_result($result2, $lt, 34) . "</td>\n" ;}
                else {echo "<td align='center'> 0 </td>";}
            }
            else{echo "<td align='center'> - </td>\n";}
            if(pg_result($result2, $lt, 64) == 1) //RWX
            {
                if(pg_result($result2, $lt, 50) > 0){
                    echo "<td align='center'> <input type='radio' name='train2seat' value='6'>余" . pg_result($result2, $lt,50) ."</br>￥" . pg_result($result2, $lt, 36) .  "</td>\n" ;}
                else {echo "<td align='center'> 0 </td>";}
            }
            else{echo "<td align='center'> - </td>\n";}
            echo "<input  type = 'hidden' name = 'hidden'  value = 'hidden'  />";
            echo "</form> ";
        echo "</tr>\n";
    }
    pg_query("drop table TransferTickets;");
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

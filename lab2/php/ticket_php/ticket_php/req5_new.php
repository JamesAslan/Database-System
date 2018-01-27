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
              <li><a href="myorder.php" class="page-scroll">我的订单</a></li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
$dbconn = pg_connect("dbname=ticket user=dbms password=dbms")
    or die('Could not connect: ' . pg_last_error());
$fancheng=$_POST['checkbox2'];
if($fancheng[0])
{
  $startcity = $_POST["endcity"];
  $endcity = $_POST["startcity"];
  $date_initial = $_POST["date"];
  $query_time ="select (Startdate +1) as date from AvailableSeat where TrainID='G1' and Startdate='$date_initial' and InnerStationID=1;";
  $result_time = pg_query($query_time) or die('Query failed: ' . pg_last_error());
  $date = pg_result($result_time, 0, 0);
  $time = $_POST["time"];
}
else{
$startcity = $_POST["startcity"];
$endcity = $_POST["endcity"];
$date = $_POST["date"];
$time = $_POST["time"];
}
?>

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
                  <input type="date" value="2017-11-30" name="date" class="form-control" />
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
              <form action= "req5_new.php#begin" method="post" class="searchwithcity">
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                  <input type="text" class="form-control" name="startcity" value=<?php echo "'".$startcity."'"?>>
                </div>
                <div class="form-group">
                <input type="date" class="form-control" value=<?php echo "'".$date."'"?> name="date">
                </div>

                <div class="form-group">
               <input type="checkbox" Name='checkbox2[]' id="brand2" value="1">             
                <label for="brand2"><span></span>查询返程</label>
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
<div id="result" align ="center" class="table-title">
<h5><font size="5">直达车次</font></h5>
</div>
</br>
<table class="table-fill">
<thead>
<tr>
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
</tr>
</thead>
<tbody class="table-hover">
<?php
// Performing SQL query
$query1 = " select  
            ot.MinPrice, 
            ot.TripTimemin, 
            ot.BeginCityName,
            ot.EndCityName, 
            ot.TrainID, 
            (ast.StartDate + ot.BeginDeltaDay) :: date as StartDate, 
            ot.BeginStationName,
            ot.EndStationName,
            ot.BeginTime, 
            ot.EndTime, 
            min(ast.YZCount) as YZCount,   
            min(ast.RZCount) as RZCount, 
            min(ast.YWSCount) as YWSCount,
            min(ast.YWZCount) as YWZCount, 
            min(ast.YWXCount) as YWXCount, 
            min(ast.RWSCount) as RWSCount,
            min(ast.RWXCount) as RWXCount, 
            ot.PriceYZ,ot.PriceRZ, ot.PriceYWS, ot.PriceYWZ, ot.PriceYWX, 
            ot.PriceRWS, ot.PriceRWX, 
            YZen,RZen,YWSen,YWZen,YWXen,RWSen,RWXen,
            (ast.StartDate + ot.EndDeltaday ):: date as EndDate,
            ot.BeginStationID, ot.BeginStationOut,
            ot.EndStationID, ot.EndStationOut,
            ast.StartDate as realstartdate,
            (StartDate + 1) as returnday

            into OneTicket
            from    OneTrip as ot, AvailableSeat as ast, TrainList
            where   (ot.BeginTime - '$time') > '0 min' and 
                    (ast.StartDate + ot.BeginDeltaDay) = '$date'and
                    ot.BeginCityName = '$startcity'and ot.EndCityName = '$endcity' and 
                    ot.TrainID = ast.TrainID and ast.InnerStationID > ot.BeginStationID and ast.InnerStationID <= ot.EndStationID   and
                    TrainList.TrainID = ot.TrainID
            group by 
                    ot.BeginCityName,ot.EndCityName,        
                    ot.TrainID, ot.BeginDeltaday,ot.EndDeltaday,
                    ast.StartDate, 
                    ot.BeginStationName,ot.EndStationName,
                    ot.BeginTime, ot.EndTime,ot.Minprice,ot.TripTimemin,
                    ot.PriceYZ,ot.PriceRZ, ot.PriceYWS, ot.PriceYWZ, ot.PriceYWX, 
                    ot.PriceRWS, ot.PriceRWX,ot.TripTimeMin, ot.TripTimemin,
                    YZen,RZen,YWSen,YWZen,YWXen,RWSen,RWXen,
                    ot.BeginStationID, ot.BeginStationOut,
                    ot.EndStationID, ot.EndStationOut
            order by MinPrice, TripTimemin, BeginTime
            asc limit  10 offset  0;";
pg_query($query1);
$query2 = "select * from oneticket;";
$result = pg_query($query2) or die('Query failed: ' . pg_last_error());
    for($lt = 0; $lt < pg_num_rows($result); $lt++) 
    {
        echo "<tr>\n";
                echo "<td >" . pg_result($result, $lt,4) . "</td>\n";
                echo "<td >" . pg_result($result, $lt,6) . "</br>" . pg_result($result, $lt,7) . "</td>\n";  
                echo "<td >" . pg_result($result, $lt,8) . "</br>" . pg_result($result, $lt,9) . "</td>\n";   
            if(pg_result($result, $lt, 24) == 1) //YZ
            {
                if(pg_result($result, $lt, 10) > 0){
                echo "<td align='center'> 余<a href='booking_new.php" ."?startstation=" . pg_result($result, $lt, 6) ."&arrivestation=" . pg_result($result, $lt, 7) . "&trainid=" . pg_result($result, $lt, 4) . "&startdate=" . $date . "&starttime=" . pg_result($result, $lt, 8) . "&arrivetime=" . pg_result($result, $lt, 9) ."&price=" . pg_result($result, $lt, 17) . "&seattype=0" . "&beginid=" .pg_result($result, $lt, 32). "&beginoutid=" .pg_result($result, $lt, 33). "&endid=" .pg_result($result, $lt, 34). "&endoutid=" .pg_result($result, $lt, 35). "&realstartdate=".pg_result($result, $lt, 36). "'>" . pg_result($result, $lt, 10) . "</a></br>￥" . pg_result($result, $lt, 17) . "</td>\n";}
                else {echo "<td align='center'> 0 </td>";}
            }
            else{echo "<td align='center'> - </td>\n";}
            if(pg_result($result, $lt, 25) == 1) //RZ
            {
                if(pg_result($result, $lt, 11) > 0){
                echo "<td align='center'> 余<a href='booking_new.php" ."?startstation=" . pg_result($result, $lt, 6) ."&arrivestation=" . pg_result($result, $lt, 7) ."&trainid=" . pg_result($result, $lt, 4) . "&startdate=" . $date . "&starttime=" . pg_result($result, $lt, 8) . "&arrivetime=" . pg_result($result, $lt, 9) ."&price=" . pg_result($result, $lt, 18) .  "&seattype=1" . "&beginid=" .pg_result($result, $lt, 32). "&beginoutid=" .pg_result($result, $lt, 33). "&endid=" .pg_result($result, $lt, 34). "&endoutid=" .pg_result($result, $lt, 35). "&realstartdate=".pg_result($result, $lt, 36)."'>" . pg_result($result, $lt, 11) . "</a></br>￥" . pg_result($result, $lt, 18) . " </td>\n";}
                else {echo "<td align='center'> 0 </td>";}
            }
            else{echo "<td align='center'> - </td>\n";}
            if(pg_result($result, $lt, 26) == 1) //YWS
            {
                if(pg_result($result, $lt, 12) > 0){
                echo "<td align='center'> 余<a href='booking_new.php" ."?startstation=" . pg_result($result, $lt, 6) ."&arrivestation=" . pg_result($result, $lt, 7) . "&trainid=" . pg_result($result, $lt, 4) ."&startdate=" . $date . "&starttime=" . pg_result($result, $lt, 8) . "&arrivetime=" . pg_result($result, $lt, 9) ."&price=" . pg_result($result, $lt, 19) . "&seattype=2" . "&beginid=" .pg_result($result, $lt, 32). "&beginoutid=" .pg_result($result, $lt, 33). "&endid=" .pg_result($result, $lt, 34). "&endoutid=" .pg_result($result, $lt, 35). "&realstartdate=".pg_result($result, $lt, 36). "'>" . pg_result($result, $lt, 12) . "</a></br>￥" . pg_result($result, $lt, 19) . " </td>\n";}
                else {echo "<td align='center'> 0 </td>";}
            }
            else{echo "<td align='center'> - </td>\n";}
            if(pg_result($result, $lt, 27) == 1) //YWZ
            {
                if(pg_result($result, $lt, 13) > 0){
                echo "<td align='center'> 余<a href='booking_new.php" ."?startstation=" . pg_result($result, $lt, 6) ."&arrivestation=" . pg_result($result, $lt, 7) . "&trainid=" . pg_result($result, $lt, 4) ."&startdate=" . $date . "&starttime=" . pg_result($result, $lt, 8) . "&arrivetime=" . pg_result($result, $lt, 9) ."&price=" . pg_result($result, $lt, 20) . "&seattype=3" .  "&beginid=" .pg_result($result, $lt, 32). "&beginoutid=" .pg_result($result, $lt, 33). "&endid=" .pg_result($result, $lt, 34). "&endoutid=" .pg_result($result, $lt, 35)."&realstartdate=".pg_result($result, $lt, 36). "'>" . pg_result($result, $lt, 13) . "</a></br>￥" . pg_result($result, $lt, 20) . " </td>\n";}
                else {echo "<td align='center'> 0 </td>";}
            }
            else{echo "<td align='center'> - </td>\n";}
            if(pg_result($result, $lt, 28) == 1) //YWX
            {
                if(pg_result($result, $lt, 14) > 0){
                echo "<td align='center'> 余<a href='booking_new.php" ."?startstation=" . pg_result($result, $lt, 6) ."&arrivestation=" . pg_result($result, $lt, 7) . "&trainid=" . pg_result($result, $lt, 4) ."&startdate=" . $date . "&starttime=" . pg_result($result, $lt, 8) . "&arrivetime=" . pg_result($result, $lt, 9) ."&price=" . pg_result($result, $lt, 21) . "&seattype=4" . "&beginid=" .pg_result($result, $lt, 32). "&beginoutid=" .pg_result($result, $lt, 33). "&endid=" .pg_result($result, $lt, 34). "&endoutid=" .pg_result($result, $lt, 35)."&realstartdate=".pg_result($result, $lt, 36).  "'>" . pg_result($result, $lt, 14) . "</a></br>￥" . pg_result($result, $lt, 21) . " </td>\n";}
                else {echo "<td align='center'> 0 </td>";}
            }
            else{echo "<td align='center'> - </td>\n";}
            if(pg_result($result, $lt, 29) == 1) //RWS
            {
                if(pg_result($result, $lt, 15) > 0){
                echo "<td align='center'> 余<a href='booking_new.php" ."?startstation=" . pg_result($result, $lt, 6) ."&arrivestation=" . pg_result($result, $lt, 7) . "&trainid=" . pg_result($result, $lt, 4) . "&startdate=" . $date . "&starttime=" . pg_result($result, $lt, 8) . "&arrivetime=" . pg_result($result, $lt, 9) ."&price=" . pg_result($result, $lt, 22) . "&seattype=5" . "&beginid=" .pg_result($result, $lt, 32). "&beginoutid=" .pg_result($result, $lt, 33). "&endid=" .pg_result($result, $lt, 34). "&endoutid=" .pg_result($result, $lt, 35). "&realstartdate=".pg_result($result, $lt, 36). "'>" . pg_result($result, $lt, 15) . "</a></br>￥" . pg_result($result, $lt, 22) . " </td>\n";}
                else {echo "<td align='center'> 0 </td>";}
            }
            else{echo "<td align='center'> - </td>\n";}
            if(pg_result($result, $lt, 30) == 1) //RWX
            {
                if(pg_result($result, $lt, 16) > 0){
                echo "<td align='center'> 余<a href='booking_new.php" ."?startstation=" . pg_result($result, $lt, 6) ."&arrivestation=" . pg_result($result, $lt, 7) . "&trainid=" . pg_result($result, $lt, 4) . "&startdate=" . $date . "&starttime=" . pg_result($result, $lt, 8) . "&arrivetime=" . pg_result($result, $lt, 9) ."&price=" . pg_result($result, $lt, 23) . "&seattype=6" . "&beginid=" .pg_result($result, $lt, 32). "&beginoutid=" .pg_result($result, $lt, 33). "&endid=" .pg_result($result, $lt, 34). "&endoutid=" .pg_result($result, $lt, 35). "&realstartdate=".pg_result($result, $lt, 36). "'>" . pg_result($result, $lt, 16) . "</a></br>￥" . pg_result($result, $lt, 23) . " </td>\n";}
                else {echo "<td align='center'> 0 </td>";}
            }
            else{echo "<td align='center'> - </td>\n";}
        echo "</tr>\n";
    }
// Free resultset
//pg_free_result($result);
pg_query("drop table oneticket;");
pg_close($dbconn);
?>
</tbody>
</table>

<div>
<?php
echo "<div align='center'><a href='req5_new2.php?startcity=" . $startcity ."&endcity=".$endcity. "&date=". $date. "&time=" .$time. "'> 没有合适的直达列车？欢迎使用接续换乘功能</a></div>";
?>
</div>
</br>
</br>

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

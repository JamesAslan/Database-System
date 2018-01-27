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
  border-top-left-radius:3px;
}
 
th:last-child {
  border-top-right-radius:3px;
  border-right:none;
}
  
tr {
  border-top: 1px solid #C1C3D1;
  border-bottom-: 1px solid #C1C3D1;
  color:#666B85;
  font-size:16px;
  font-weight:normal;
  text-shadow: 0 1px 1px rgba(256, 256, 256, 0.1);
}
 
tr:hover td {
  background:#4E5066;
  color:#FFFFFF;
  border-top: 1px solid #22262e;
}
 
tr:first-child {
  border-top:none;
}

tr:last-child {
  border-bottom:none;
}
 
tr:nth-child(odd) td {
  background:#EBEBEB;
}
 
tr:nth-child(odd):hover td {
  background:#4E5066;
}

tr:last-child td:first-child {
  border-bottom-left-radius:3px;
}
 
tr:last-child td:last-child {
  border-bottom-right-radius:3px;
}
 
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
  border-right: 0px;
}

th.text-left {
  text-align: center;
}

th.text-center {
  text-align: center;
}

th.text-right {
  text-align: right;
}

td.text-left {
  text-align: left;
}

td.text-center {
  text-align: center;
}

td.text-right {
  text-align: right;
}

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
<!--  <h1 style="font-family:verdana;color:red">hello.sss</h1> -->
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
                  <input type="text" class="form-control" name="startcity" placeholder="请在此输入出发城市">
                </div>
                <div class="form-group">
                <input type="date" class="form-control" value="2017-11-24" name="date" placeholder="请在此输入出发日期">
                 
                </div>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                 <input type="text" class="form-control" name="endcity" placeholder="请在此输入到达城市">  
                </div>
                <div class="form-group">
                  <input type="time" class="form-control" name="time" value="07:00">
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
<div align ="center" class="table-title">
<h5><font size="5">查询结果</font></h5>
</div>
</br>
<table class="table-fill">
<thead>
<tr>
<th class="text-left">站名</th>
<th class="text-left">到达时间</th>
<th class="text-left">发车时间</th>
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
$arr = "";
$dbconn = pg_connect("dbname=ticket user=dbms password=dbms")
    or die('Could not connect: ' . pg_last_error());
$trainid = $_POST["trainid"];
$date = $_POST["date"];
// Performing SQL query
$query = "
(
select  ts.InnerStationID, ts.StationName, ts.ArriveTime, ts.StartTime, 
    ts.PriceYZ, (ast.YZCount) as YZCount, 
    ts.PriceRZ, (ast.RZCount) as RZCount, 
    ts.PriceYWS, (ast.YWSCount) as YWSCount, 
    ts.PriceYWZ, (ast.YWZCount) as YWZCount, 
    ts.PriceYWX, (ast.YWXCount) as YWXCount,
    ts.PriceRWS, (ast.RWSCount) as RWSCount, 
    ts.PriceRWX, (ast.RWXCount) as RWXCount, 
    tl.YZEn, tl.RZEn, tl.YWSEn, tl.YWZEn, tl.YWXEn, tl.RWSEn, tl.RWXEn, 
    ts.ForbidFlag, ts.OuterStationID
from TrainStation as ts, AvailableSeat as ast , TrainList as tl
where ( ts.TrainID = '$trainid' and
    ast.TrainID = '$trainid' and
    tl.TrainID = '$trainid' and 
    ast.StartDate = '$date' and
    ast.InnerStationID = 1 and 
    ts.InnerStationID = 1
    )
order by ts.InnerStationID
)
union
(
select  ts.InnerStationID, ts.StationName, ts.ArriveTime, ts.StartTime, 
    ts.PriceYZ, min(ast.YZCount) as YZCount, 
    ts.PriceRZ, min(ast.RZCount) as RZCount, 
    ts.PriceYWS, min(ast.YWSCount) as YWSCount, 
    ts.PriceYWZ, min(ast.YWZCount) as YWZCount, 
    ts.PriceYWX, min(ast.YWXCount) as YWXCount,
    ts.PriceRWS, min(ast.RWSCount) as RWSCount, 
    ts.PriceRWX, min(ast.RWXCount) as RWXCount, 
    tl.YZEn, tl.RZEn, tl.YWSEn, tl.YWZEn, tl.YWXEn, tl.RWSEn, tl.RWXEn,
    ts.ForbidFlag, ts.OuterStationID
from TrainStation as ts, AvailableSeat as ast , TrainList as tl
where ( ts.TrainID = '$trainid' and
    ast.TrainID = '$trainid' and
    tl.TrainID = '$trainid' and 
    ast.StartDate = '$date' and
    ((ast.InnerStationID <= ts.InnerStationID and
    ast.InnerStationID > 1)
    ))
group by ts.InnerStationID, ts.StationName, ts.ArriveTime, ts.StartTime,
     ts.PriceYZ, ts.PriceRZ, ts.PriceYWS, ts.PriceYWZ, ts.PriceYWX,
     ts.PriceRWS, ts.PriceRWX, 
     tl.YZEn, tl.RZEn, tl.YWSEn, tl.YWZEn, tl.YWXEn, tl.RWSEn, tl.RWXEn,
     ts.ForbidFlag,ts.OuterStationID
order by ts.InnerStationID
);
";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

$cnt = 1;
$startstation = pg_result($result, 0, 1);
$starttime = pg_result($result, 0, 3);
$beginoutid = pg_result($result, 0, 26);

while ($line = pg_fetch_array($result, null, PGSQL_BOTH)) {
  
    if ($cnt == 1) { //Start-station
    $arr = $arr . "<tr>";
    $arr = $arr . "<td>" . $line[1] ;
    $arr = $arr . "<td>" . "-";
    $arr = $arr . "<td>" . $line[3];
    for ($x=0; $x <=6; $x++) {
      $arr = $arr . "<td>" . "-";
    }
    $arr = $arr . "<tr>";
  }
    else if ($line[2] != $line[3]) //Mid-station
    {
        $arr = $arr . "<tr>";
    for ($x=1; $x <=3; $x++) {
      $arr = $arr . "<td>" . $line[$x];
    }
    if ($line[25] == "0" ) {
      for ($x=0; $x <=6; $x++) {
        if ($line[$x + 18]=="1") {
          if ($line[$x*2 + 5] == "0")
            $arr = $arr . "<td>" . $line[$x*2 + 5];
          else
            { 
              $arr = $arr . "<td>" . "<a href=booking_new.php?trainid=" . $trainid . "&seattype=" . $x . "&startstation=" . $startstation. "&arrivestation=". $line[1] . "&starttime=". $starttime. "&arrivetime=". $line[3]. "&price=". $line[$x*2 + 4]. "&startdate=" . $date.   "&beginid=1&endid=" . $cnt . "&beginoutid=" .$beginoutid. "&endoutid=". $line[26]."&realstartdate=" . $date. ">" . $line[$x*2 + 5]. "</a>";
              $arr = $arr . "</br>￥" . $line[$x*2 + 4];
            }
        }
        else { //不开某座位类型
          $arr = $arr . "<td>" . "-";
        }
      }
    }
    else { //禁止上下车
      for ($x=0; $x <=6; $x++) {
          $arr = $arr . "<td>" . "-";
        }
    }
        $arr = $arr . "<tr>";
    }
  else { //End-station
    $arr = $arr . "<tr>";
    $arr = $arr . "<td>" . $line[1];
    $arr = $arr . "<td>" . $line[2];
    $arr = $arr . "<td>" . "-";
    
    for ($x=0; $x <=6; $x++) {
      if ($line[$x + 18]=="1") {
        $arr = $arr . "<td>" . "<a href=booking_new.php?trainid=" . $trainid . "&seattype=" . $x . "&startstation=" . $startstation. "&arrivestation=". $line[1] . "&starttime=". $starttime. "&arrivetime=". $line[3]. "&price=". $line[$x*2 + 4]. "&startdate=" . $date.   "&beginid=1&endid=" . $cnt . "&beginoutid=" .$beginoutid. "&endoutid=". $line[26]."&realstartdate=" . $date .">" . $line[$x*2 + 5].  "</a>";
        $arr = $arr . "</br>￥" . $line[$x*2 + 4];
      }
      else {
        $arr = $arr . "<td>" . "-";
      }
    }
        $arr = $arr . "<tr>";
  }
    $cnt++;
}
// Free resultset
pg_free_result($result);

// Closing connection
pg_close($dbconn);

  
//$jarr='';
//$jarr=json_encode($arr, JSON_UNESCAPED_UNICODE);
//echo $jarr;
echo $arr;
?>
</tbody>
</table>


<div class="footer">
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="quicklinks">
          <h4 class="footerh">Quick Links</h4>
          <ul>
            <li><i class="fa fa-angle-right"></i> <a href="index.php">Home</a></li>
            <li><i class="fa fa-angle-right"></i> <a href="index.php">About us</a></li>
          </ul>
        </div>
      </div>
      <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="quickcontact">
          <h4 class="footerh">Quick Contact</h4>
          <ul>
            <li><i class="fa fa-phone"></i> 123456789</li>
            <li><i class="fa fa-envelope"></i> ucas.ac.cn</li>
            <li><i class="fa fa-map-marker"></i> UCAS</li>
          </ul>
        </div>
      </div>
      <div class="col-md-4 col-sm-12 col-xs-12">
        <div class="follow">
          <h4 class="footerh">Follow us</h4>
          <ul class="footer-social text-center">
            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
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

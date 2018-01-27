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
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 text-center">
        <div class="schbox">
          
          <div class="col-md-6 col-sm-12 col-xs-12 working">
              <div class="schbox-title">
                <h2><?php   echo $_SESSION['loginname'] . ",";
                echo "您的购票信息如下：</br>"; ?></h2>
            </div>
<?php 
$dbconn = pg_connect("dbname=ticket user=dbms password=dbms")
    or die('Could not connect: ' . pg_last_error());
$orderid = $_REQUEST['orderid'];
$query = "update orders set status=1 where orderid='$orderid';";
pg_query($query);
$trainid = $_REQUEST['trainid'];
$startdate = $_REQUEST['realstartdate'];
$beginid = $_REQUEST['beginid'];
$endid = $_REQUEST['endid'];
$hc = $_REQUEST['hc'];
if($hc==0)
	{
		$seattype = $_REQUEST['seattype'];
		switch ($seattype) {
			case 0:
			$query2 = "update  	AvailableSeat
				set 	YZCount = YZCount - 1
				where 	TrainID = '$trainid' 
			and StartDate = '$startdate'
			and  InnerStationID > '$beginid'
			and  InnerStationID <= '$endid';";
				break;
			case 1:
			$query2 = "update  	AvailableSeat
				set 	RZCount = RZCount - 1
				where 	TrainID = '$trainid' 
			and StartDate = '$startdate'
			and  InnerStationID > '$beginid'
			and  InnerStationID <= '$endid';";
				break;
			case 2:
			$query2 = "update  	AvailableSeat
				set 	YWSCount = YWSCount - 1
				where 	TrainID = '$trainid' 
			and StartDate = '$startdate'
			and  InnerStationID > '$beginid'
			and  InnerStationID <= '$endid';";
				break;
			case 3:
			$query2 = "update  	AvailableSeat
				set 	YWZCount = YWZCount - 1
				where 	TrainID = '$trainid' 
			and StartDate = '$startdate'
			and  InnerStationID > '$beginid'
			and  InnerStationID <= '$endid';";
				break;
			case 4:
			$query2 = "update  	AvailableSeat
				set 	YWXCount = YWXCount - 1
				where 	TrainID = '$trainid' 
			and StartDate = '$startdate'
			and  InnerStationID > '$beginid'
			and  InnerStationID <= '$endid';";
				break;
			case 5:
			$query2 = "update  	AvailableSeat
				set 	RWSCount = RWSCount - 1
				where 	TrainID = '$trainid' 
			and StartDate = '$startdate'
			and  InnerStationID > '$beginid'
			and  InnerStationID <= '$endid';";
				break;
			case 6:
			$query2 = "update  	AvailableSeat
				set 	RWXCount = RWXCount - 1
				where 	TrainID = '$trainid' 
			and StartDate = '$startdate'
			and  InnerStationID > '$beginid'
			and  InnerStationID <= '$endid';";
				break;									
		}
		pg_query($query2);
	}
	else{
		$train1seat = $_REQUEST['train1seat'];
		$train2seat = $_REQUEST['train2seat'];
		$startdate1 = $_REQUEST['startdate1'];
		$startdate2 = $_REQUEST['startdate2'];
		$train1id = $_REQUEST['train1id'];
		$train2id = $_REQUEST['train2id'];
		$startinid1 = $_REQUEST['startinid1'];
		$endinid1 = $_REQUEST['endinid1'];
		$startinid2 = $_REQUEST['startinid2'];
		$endinid2 = $_REQUEST['endinid2'];


		switch ($train1seat) {
			case 0:
			$query_train1 = "update  	AvailableSeat
				set 	YZCount = YZCount - 1
				where 	TrainID = '$train1id' 
			and StartDate = '$startdate1'
			and  InnerStationID > '$startinid1'
			and  InnerStationID <= '$endinid1';";
				break;
			case 1:
			$query_train1 = "update  	AvailableSeat
				set 	RZCount = RZCount - 1
				where 	TrainID = '$train1id' 
			and StartDate = '$startdate1'
			and  InnerStationID > '$startinid1'
			and  InnerStationID <= '$endinid1';";
				break;		
			case 2:
			$query_train1 = "update  	AvailableSeat
				set 	YWSCount = YWSCount - 1
				where 	TrainID = '$train1id' 
			and StartDate = '$startdate1'
			and  InnerStationID > '$startinid1'
			and  InnerStationID <= '$endinid1';";
				break;
			case 3:
			$query_train1 = "update  	AvailableSeat
				set 	YWZCount = YWZCount - 1
				where 	TrainID = '$train1id' 
			and StartDate = '$startdate1'
			and  InnerStationID > '$startinid1'
			and  InnerStationID <= '$endinid1';";
				break;		
			case 4:
			$query_train1 = "update  	AvailableSeat
				set 	YWXCount = YWXCount - 1
				where 	TrainID = '$train1id' 
			and StartDate = '$startdate1'
			and  InnerStationID > '$startinid1'
			and  InnerStationID <= '$endinid1';";
				break;
			case 5:
			$query_train1 = "update  	AvailableSeat
				set 	RWSCount = RWSCount - 1
				where 	TrainID = '$train1id' 
			and StartDate = '$startdate1'
			and  InnerStationID > '$startinid1'
			and  InnerStationID <= '$endinid1';";
				break;		
			case 6:
			$query_train1 = "update  	AvailableSeat
				set 	RWXCount = RWXCount - 1
				where 	TrainID = '$train1id' 
			and StartDate = '$startdate1'
			and  InnerStationID > '$startinid1'
			and  InnerStationID <= '$endinid1';";
				break;	
		}

		switch ($train2seat) {
			case 0:
			$query_train2 = "update  	AvailableSeat
				set 	YZCount = YZCount - 1
				where 	TrainID = '$train2id' 
			and StartDate = '$startdate2'
			and  InnerStationID > '$startinid2'
			and  InnerStationID <= '$endinid2';";
				break;
			case 1:
			$query_train2 = "update  	AvailableSeat
				set 	RZCount = RZCount - 1
				where 	TrainID = '$train2id' 
			and StartDate = '$startdate2'
			and  InnerStationID > '$startinid2'
			and  InnerStationID <= '$endinid2';";
				break;		
			case 2:
			$query_train2 = "update  	AvailableSeat
				set 	YWSCount = YWSCount - 1
				where 	TrainID = '$train2id' 
			and StartDate = '$startdate2'
			and  InnerStationID > '$startinid2'
			and  InnerStationID <= '$endinid2';";
				break;
			case 3:
			$query_train2 = "update  	AvailableSeat
				set 	YWZCount = YWZCount - 1
				where 	TrainID = '$train2id' 
			and StartDate = '$startdate2'
			and  InnerStationID > '$startinid2'
			and  InnerStationID <= '$endinid2';";
				break;		
			case 4:
			$query_train2 = "update  	AvailableSeat
				set 	YWXCount = YWXCount - 1
				where 	TrainID = '$train2id' 
			and StartDate = '$startdate2'
			and  InnerStationID > '$startinid2'
			and  InnerStationID <= '$endinid2';";
				break;
			case 5:
			$query_train2 = "update  	AvailableSeat
				set 	RWSCount = RWSCount - 1
				where 	TrainID = '$train2id' 
			and StartDate = '$startdate2'
			and  InnerStationID > '$startinid2'
			and  InnerStationID <= '$endinid2';";
				break;		
			case 6:
			$query_train2 = "update  	AvailableSeat
				set 	RWXCount = RWXCount - 1
				where 	TrainID = '$train2id' 
			and StartDate = '$startdate2'
			and  InnerStationID > '$startinid2'
			and  InnerStationID <= '$endinid2';";
				break;	
		}
		pg_query($query_train1);
		pg_query($query_train2);

	}
?>
<font size=10>恭喜你订票成功</font>！

<p>
<a href="index.php"> 返回首页</a>
</p>
    </div>
</div>
          </div>

        </div>
      </div>
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

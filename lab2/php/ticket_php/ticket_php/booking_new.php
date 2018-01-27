<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>12306</title>

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
          <a class="navbar-brand logo" href="#">12306</a> </div>
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
  $user = $_SESSION['loginname'];

  if(isset($_POST["hidden"]) && $_POST["hidden"] == "hidden" && ($_POST['train1seat'] == ""||$_POST['train2seat'] == ""))  
        {  
            echo "<script>alert('请确认信息完整性！'); history.go(-1);</script>";  
        }

  if($user=="")
  {
    echo "<script>alert('请先登录！');window.location.href='login.php';</script>"; 
  }

$dbconn = pg_connect("dbname=ticket user=dbms password=dbms")
    or die('Could not connect: ' . pg_last_error());
  $yCode = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
  $OrderID = $yCode[intval(date('Y')) - 2011] . strtoupper(dechex(date('m'))) . date('d') . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf('%02d', rand(0, 99));

    if(isset($_POST["hidden"]) && $_POST["hidden"] == "hidden")  
    {
    $train1id = $_REQUEST['train1id'];
      $startoutid1 = $_REQUEST['startoutid1'];
      $endoutid1 = $_REQUEST['endoutid1'];
      $startinid1 = $_REQUEST['startinid1'];
      $endinid1 = $_REQUEST['endinid1'];  
      switch($_POST['train1seat'])
      {
        case 0 : $price1 = $_REQUEST['train1yz']; break;
        case 1 : $price1 = $_REQUEST['train1rz']; break;
        case 2 : $price1 = $_REQUEST['train1yws']; break;
        case 3 : $price1 = $_REQUEST['train1ywz']; break;
        case 4 : $price1 = $_REQUEST['train1ywx']; break;
        case 5 : $price1 = $_REQUEST['train1rws']; break;
        case 6 : $price1 = $_REQUEST['train1rwx']; break;
      }   
      $startstation1= $_REQUEST['startstation1'];
      $arrivestation1= $_REQUEST['arrivestation1'];
      $startdate1 = $_REQUEST['startdate1'];
      $starttime1 = $_REQUEST['starttime1'];
      $enddate1 = $_REQUEST['enddate1'];
      $endtime1 = $_REQUEST['endtime1'];   
      $train1seat = $_POST['train1seat'];

      $train2id = $_REQUEST['train2id'];
      $startoutid2 = $_REQUEST['startoutid2'];
      $endoutid2 = $_REQUEST['endoutid2'];
      $startinid2 = $_REQUEST['startinid2'];
      $endinid2 = $_REQUEST['endinid2'];  
      switch($_POST['train2seat'])
      {
        case 0 : $price2 = $_REQUEST['train2yz']; break;
        case 1 : $price2 = $_REQUEST['train2rz']; break;
        case 2 : $price2 = $_REQUEST['train2yws']; break;
        case 3 : $price2 = $_REQUEST['train2ywz']; break;
        case 4 : $price2 = $_REQUEST['train2ywx']; break;
        case 5 : $price2 = $_REQUEST['train2rws']; break;
        case 6 : $price2 = $_REQUEST['train2rwx']; break;
      }   
      $startstation2= $_REQUEST['startstation2'];
      $arrivestation2= $_REQUEST['arrivestation2'];
      $startdate2 = $_REQUEST['startdate2'];
      $starttime2 = $_REQUEST['starttime2'];
      $enddate2 = $_REQUEST['enddate2'];
      $endtime2 = $_REQUEST['endtime2'];   
      $train2seat = $_POST['train2seat'];

      $totalprice_hc = $price1 + $price2;
    echo "订单号:" . $OrderID . "</br>";
      echo "您选择的换乘方案为：</br>"; 
      echo "行程1</br>";
      echo "车次:" . $train1id . "</br>";
    echo "起点站:" . $startstation1 . "</br>";
    echo "终点站:" . $arrivestation1. "</br>";
    echo "出发日期:" . $startdate1 . "</br>";
    echo "出发时间:" . $starttime1. "</br>";
    echo "座位类型:";
    switch($_POST['train1seat'])
    {
      case 0 : echo "硬座</br>"; break;
      case 1 : echo "软座</br>"; break;
      case 2 : echo "硬卧（上）</br>"; break;
      case 3 : echo "硬卧（中）</br>"; break;
      case 4 : echo "硬卧（下）</br>"; break;
      case 5 : echo "软卧（上）</br>"; break;
      case 6 : echo "软卧（下）</br>"; break;          
    }
    echo "票价:" . $price1. "</br>";
    echo "订票费: 5元/张 </br></br>";
    echo "行程2</br>";
      echo "车次:" . $train2id . "</br>";
    echo "起点站:" . $startstation2 . "</br>";
    echo "终点站:" . $arrivestation2. "</br>";
    echo "出发日期:" . $startdate2 . "</br>";
    echo "出发时间:" . $starttime2. "</br>";
    echo "座位类型:";
    switch($_POST['train2seat'])
    {
      case 0 : echo "硬座</br>"; break;
      case 1 : echo "软座</br>"; break;
      case 2 : echo "硬卧（上）</br>"; break;
      case 3 : echo "硬卧（中）</br>"; break;
      case 4 : echo "硬卧（下）</br>"; break;
      case 5 : echo "软卧（上）</br>"; break;
      case 6 : echo "软卧（下）</br>"; break;          
    }
    echo "票价:" . $price2. "</br>";
    echo "订票费: 5元/张 </br>";
    echo "总价：" . $totalprice_hc . "</br>";

    $query1 = "Insert into Orders
            values(0, '$OrderID', '$train1id', '$startdate1', '$startoutid1', '$endoutid1', '$startinid1', '$endinid1', '$train1seat', '$price1', '$user');";
    $query2 = "Insert into Orders
            values(0, '$OrderID', '$train2id', '$startdate2', '$startoutid2', '$endoutid2', '$startinid2', '$endinid2', '$train2seat', '$price2', '$user');";
    $result1 = pg_query($query1) or die('Query failed: ' . pg_last_error());
    $result2 = pg_query($query2) or die('Query failed: ' . pg_last_error());

    }
    else{

    $startstation = $_REQUEST['startstation']; 
    $arrivestation = $_REQUEST['arrivestation']; 
    $arrivetime = $_REQUEST['arrivetime']; 
    $starttime = $_REQUEST['starttime'];
    $price = $_REQUEST['price']; 
    $startdate = $_REQUEST['startdate'];
    $trainid = $_REQUEST['trainid'];
    $seattype = $_REQUEST['seattype'];
    $totalprice = $price + 5;
    $beginid = $_REQUEST['beginid'];
    $beginoutid = $_REQUEST['beginoutid'];
    $endid = $_REQUEST['endid'];
    $endoutid = $_REQUEST['endoutid'];
    $realstartdate = $_REQUEST['realstartdate'];

    echo "订单号:" . $OrderID . "</br>";
    echo "起点站:" . $startstation . "</br>";
    echo "终点站:" . $arrivestation. "</br>";
    echo "出发日期:" . $startdate . "</br>";
    echo "出发时间:" . $starttime. "</br>";
    echo "座位类型:";
    switch($seattype)
    {
      case 0 : echo "硬座</br>"; break;
      case 1 : echo "软座</br>"; break;
      case 2 : echo "硬卧（上）</br>"; break;
      case 3 : echo "硬卧（中）</br>"; break;
      case 4 : echo "硬卧（下）</br>"; break;
      case 5 : echo "软卧（上）</br>"; break;
      case 6 : echo "软卧（下）</br>"; break;            
    }
    echo "票价:" . $price. "</br>";
    echo "订票费: 5元/张 </br>";
    echo "总价：" . $totalprice . "</br>";
    $query = "Insert into Orders
            values(0, '$OrderID', '$trainid', '$startdate', '$beginoutid', '$endoutid', '$beginid', '$endid', '$seattype', '$totalprice', '$user');";
    $result = pg_query($query) or die('Query failed: ' . pg_last_error());
  }
?>
<div>
请确认信息是否正确
</div>
<div>
    <div >
    <?php 
    $ticketdate1= $_REQUEST['ticketdate1'];
    $ticketdate2= $_REQUEST['ticketdate2'];

    if(isset($_POST["hidden"]) && $_POST["hidden"] == "hidden") 
      {echo "<a href='success.php?hc=1&orderid=" . $OrderID ."&train1id=".$train1id. "&startdate1=". $ticketdate1. "&startinid1=" .$startinid1. "&endinid1=".$endinid1. "&train1seat=".$train1seat."&train2id=".$train2id. "&startdate2=". $ticketdate2. "&startinid2=" .$startinid2. "&endinid2=".$endinid2. "&train2seat=".$train2seat. "'> 确认</a>";  }
  else    {echo "<a href='success.php?hc=0&orderid=" . $OrderID . "&trainid=".$trainid. "&startdate=". $startdate. "&beginid=" .$beginid. "&endid=".$endid. "&seattype=".$seattype. "&realstartdate=".$realstartdate. "'> 确认</a>";}
    ?>
    </div>     
    <div >
    <?php 
    echo "<a href='cancel.php?orderid=" . $OrderID . "'> 取消</a>";
    ?>
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

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
<?php
  $user = $_SESSION['loginname'];

  if($user=="")
  {
    echo "<script>alert('请先登录！');window.location.href='login.php';</script>"; 
  }
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

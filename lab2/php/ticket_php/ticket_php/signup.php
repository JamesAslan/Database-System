<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>12307</title>
 <script>
 function init(){
    if(myform.username.value=="")
    {
        alert("请输入用户名");
        myform.username.focus();
        return false;
    }
    if (myform.userpwd.value=="")
    {
        alert("请输入密码");
        myform.userpwd.focus();
        return false;
    }
    if (myform.confirm.value=="")
    {
        alert("请再输入一次密码");
        myform.confirm.focus();
        return false;
    }
}
</script>
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
                <h2>用户注册</h2>
              </div>
              <form action="signupcheck.php" method="post" onsubmit="return init();" name="myform" >
              <div class="col-md-12 col-sm-12 col-xs-12">
<div class="bd">
    <div >
        <span >用户名:</span>
        <span><input type="text" name="username" id="username" placeholder="请输入用户名" /></span>
    </div>
    </br>
    <div >
        <span >真实姓名:</span>
        <span><input type="text" name="realname" id="realname" placeholder="请输入真实姓名" /></span>
    </div>
    </br>
    <div >
        <span >身份证号:</span>
        <span><input type="text" name="userid" id="userid" placeholder="请输入身份证号" /></span>
    </div>
    </br>
    <div >
        <span >手机号码:</span>
        <span><input type="text" name="phone" id="phone" placeholder="请输入手机号码" /></span>
    </div>
    </br>
    <div >
        <span >信用卡号:</span>
        <span><input type="text" name="creditcard" id="creditcard" placeholder="请输入信用卡号" /></span>
    </div>
      </br>  
    <div >
        <span >密码:</span>
        <span><input type="password" name="userpwd" id="userpwd" placeholder="请输入密码" ></span>
    </div>
      </br>  
    <div >
        <span >确认密码:</span>
        <span><input type="password" name="confirm" id="confirm" placeholder="请再输入一次密码" ></span>
    </div>
      </br>  
    <span><input  type = "hidden" name = "hidden"  value = "hidden"  /></span>
</form>
              </div>
              <span><input  type = "hidden" name = "hidden"  value = "hidden"  /></span>
              <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                <button type="submit" class="btn orange">立即注册</button>
              </div>
            </form>
            <button  class="btn orange" onclick="window.location.href='signup.php'">已有账号？立即登录</button>
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

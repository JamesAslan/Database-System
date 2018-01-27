<?php
session_start();
header("Content-Type: text/html;charset=utf-8"); 

 if(isset($_POST["hidden"]) && $_POST["hidden"] == "hidden") 
 { 
	 $user = trim($_POST["username"]);
	 $psw = trim($_POST["userpwd"]);
	 if($user == "" || $psw == "") { 
	 	echo "<script>alert('请输入用户名或者密码！'); history.go(-1);</script>"; 
	 }
	 else { 
	 $dbconn = pg_connect("dbname=ticket user=dbms password=dbms") or die('Could not connect: ' . pg_last_error());
	 $sql = "select username,userpwd from users where username = '$user' and userpwd = '$psw'"; 
	 $result = pg_query($sql); 
	 $num = pg_num_rows($result); 
	 if($num) { 
	 	$_SESSION['loginname'] = $user;
	 	echo "<script>alert('成功登录'); window.location.href='index.php';</script>"; 
	 } 
	 else { 
	 	echo "<script>alert('用户名或密码不正确！');history.go(-1);</script>"; 
	 } 
	} 
} 
else { 
	echo "<script>alert('提交未成功！');</script>"; 
} 

?> 

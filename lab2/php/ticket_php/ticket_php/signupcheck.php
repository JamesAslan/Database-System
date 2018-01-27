<?php
session_start();
unset($_SESSION['loginname']);
header("Content-Type: text/html;charset=utf-8"); 
    if(isset($_POST["hidden"]) && $_POST["hidden"] == "hidden")  
    {  
        $username = trim($_POST["username"]);
        $realname = trim($_POST["realname"]);
        $userid = trim($_POST["userid"]);
        $phone = trim($_POST["phone"]);
        $creditcard = trim($_POST["creditcard"]);
        $psw = trim($_POST["userpwd"]);  
        $psw_confirm = trim($_POST["confirm"]); 
        if($username == "" || $realname == ""|| $userid == ""|| $phone == ""|| $creditcard == ""|| $psw == "" || $psw_confirm == "")  
        {  
            echo "<script>alert('请确认信息完整性！'); history.go(-1);</script>";  
        }
        else   
        {  
            if($psw == $psw_confirm)  
            {  
                $dbconn = pg_connect("dbname=ticket user=dbms password=dbms")
                              or die('Could not connect: ' . pg_last_error());
                $query = "select username from users where username = '$username'"; 
                $result = pg_query($query);
                $num = pg_num_rows($result);  
                
                if($num)    
                {  
                    echo "<script>alert('用户名已存在'); history.go(-1);</script>";  
                }  
                else    
                {   
                    $query2 = "select userid from users where userid = '$userid'"; 
                    $result2 = pg_query($query2);
                    $num2 = pg_num_rows($result2);
                    if($num2)    
                    {  
                    echo "<script>alert('身份证号已存在'); history.go(-1);</script>";  
                    }  
                else  
                    {   
                    $sql_insert = "insert into users values('$userid','$phone','$creditcard', '$username', '$realname', '$psw') ;"; 
                    $result = pg_query($sql_insert)or die('Query failed: ' . pg_last_error());
                        echo "<script>alert('注册成功！');window.location.href='index.php';</script>";  
                    }
                }  
            }  
            else  
            {  
                echo "<script>alert('密码不一致！'); history.go(-1);</script>";  
            }  
        }  
    }  
    else  
    {  
        echo "<script>alert('提交未成功！');</script>";  
    }  
?>

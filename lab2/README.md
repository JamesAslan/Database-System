目录结构：

  |--db_wash2 导入数据的c#工程代码,里面有较详细的注释

  |--data     生成好的tbl文件,6个文件对应createtable.sql里6个表

  |--实体er图.svg

  |--sql      实现需求的sql文件

  |-----req4.sql

  |-----req8.sql

  |-----req9.sql

  |-----conflict_order.sql

  |-----task5.sql

  |--php

	||--ticket_php

	||----css 					网站样式文件

	||----fonts 				网站字体文件

	||----image 				网站图片

	||----js					网站js代码

	||----admin.php				管理员界面

	||----booking_new.php		订票界面

	||----cancel.php			取消订单界面

	||----detail.php			订单详情

	||----index.php				网站主页 **

	||----login.php				登录页面

	||----logincheck.php		检查能否成功登录

	||----myorder.php			查询订单页面	

	||----myorder_result.php	查询结果页面

	||----orderpage.php			管理员状态下查看订单

	||----req4_new.php			需求4,按车次查列车

	||----req5_new.php			需求5,按城市查列车

	||----req5_new.php			需求5 换乘页面

	||----signup.php			注册页面

	||----signupcheck.php		检查是否符合注册条件

	||----success.php			成功购票页面







搭建环境的步骤：

  已知：
  
	老师的lab2虚拟机 

	train_v4数据
    
  1. 导入并生成随机数据(在data文件夹内已经有生成好的数据，可以跳过此步骤)

		1.1 运行dbwash2\dbwash2.sln (vs2010 c#)

		***在程序内有注释 可以支持导入数据模式和生成随机orders模式***

		1.2 运行Function3 生成users.tbl

		1.3 运行Function2 生成trainsofcity.tbl

		1.4 运行Function1 生成其余的表

		1.5 复制data数据包到虚拟机

  2. 虚拟机psql中 配置数据库环境

		2.1 =# create database ticket;

		2.2 =# \c ticket

		2.3 (把createtable.sql)中所有create table语句复制进psql

		2.4 录入表(具体路径可能需要修改)

			copy table_name from '/home/dbms/trainv1/data/g101_w.tbl' with (format csv, delimiter ',');

			copy trainstation from '/home/dbms/train_v7/data/trainstation.tbl' with (format csv, delimiter ',');

			copy trainsofcity from '/home/dbms/train_v7/data/trainsofcity.tbl' with (format csv, delimiter ',');

			copy trainlist from '/home/dbms/train_v7/data/trainlist.tbl' with (format csv, delimiter ',');

			copy availableseat from '/home/dbms/train_v7/data/availableseat.tbl' with (format csv, delimiter ',');

			copy orders from '/home/dbms/train_v7/data/orders.tbl' with (format csv, delimiter ',');

			copy users from '/home/dbms/train_v7/data/users.tbl' with (format csv, delimiter ',');

		2.5 生成预操作onetrip:

			将onetrip.sql复制到虚拟机 生成全国两两直达的信息
			
	    ***此时应该已经能够在terminal跑各种sql了***

  3. 配置php运行环境

		3.1 复制php文件夹到/var/www/html文件下

		3.2 firefox中(推荐chrome，可以展示日期下拉单)运行localhost/index.php

		
		***结束***
		
SQL语句

  1. OneTrip.sql

  select into OneTrip

  建立一个新表,包含全国所有城市之间的直达车辆信息，显示起始站和结束站，和其他和与车次相关的信息

  后续的查询都是查询该表来找到对应的车次

  2. task5.sql

  实现了查票需求的sql语句，其中默认了部分用户输入条件

  单程为：北京到长沙，要求出发日期2017/11/30 时间为06:30

  换乘为：长沙到哈尔冰，要除法日期为2017/11/30 时间 06:00

  Oneticket为直达车票信息，直接根据用户输入查询OneTrip表，联系AvailableSeat表来输出余票
  TransferTickets为换乘一次车票信息，根据用户输入和换乘条件，联系AvailableSeat来输出余票

  3. req4.sql
  
  实现了按车次查车站和余票信息

  输入：出发日期 和 车次号

  输出：经停车站信息和余票信息（从起点站到第i站）

  4. req8.sql

  输入：用户名 lgd    查询起点2017-11-25 查询终点2017-11-25

  输出：订单状态等信息  

  6. conflict_order.sql

  输入：当前userid trainid startinnerstationid endinnerstationid whichday          

  输出 orderid trainid startstationname endstationname startdate starttime arrivetime        

  

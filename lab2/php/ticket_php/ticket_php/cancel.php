<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<body>
<?php 
$dbconn = pg_connect("dbname=ticket user=dbms password=dbms")
    or die('Could not connect: ' . pg_last_error());

$orderid = $_REQUEST['orderid'];
$trainid = $_REQUEST['trainid'];

$query1 = "select trainid, startdate, StartStationOuterID, StartStationInnerID, EndStationInnerID, seattype, status
from Orders
where orderid = '$orderid';";

$result1=pg_query($query1) or die('Query failed: ' . pg_last_error());

if(pg_num_rows($result1) == 1)
{
if(pg_result($result1, 0, 6)==1)
{
	$startinid = pg_result($result1,0,3);
	$endinid = pg_result($result1,0,4);
	$startoutid = pg_result($result1,0,2);
	$seattype = pg_result($result1,0,5);
	$startdate = pg_result($result1,0,1);
	$query2= "select DeltaDay
from TrainStation
where trainid = '$trainid' and OuterStationID = '$startoutid';";
$result2 = pg_query($query2) or die('Query failed: ' . pg_last_error());

	$deltaday = pg_result($result2,0,0);

	switch ($seattype) {
			case 0:
			$increase = "update  	AvailableSeat
				set 	YZCount = YZCount + 1
				where 	TrainID = '$trainid' 
			and StartDate = (date'$startdate' - $deltaday)
			and  InnerStationID > '$startinid'
			and  InnerStationID <= '$endinid';";
				break;
			case 1:
			$increase = "update  	AvailableSeat
				set 	RZCount = RZCount + 1
				where 	TrainID = '$trainid' 
			and StartDate = (date'$startdate' - $deltaday)
			and  InnerStationID > '$startinid'
			and  InnerStationID <= '$endinid';";
				break;
			case 2:
			$increase = "update  	AvailableSeat
				set 	YWSCount = YWSCount + 1
				where 	TrainID = '$trainid' 
			and StartDate = (date'$startdate' - $deltaday)
			and  InnerStationID > '$startinid'
			and  InnerStationID <= '$endinid';";
				break;
			case 3:
			$increase = "update  	AvailableSeat
				set 	YWZCount = YWZCount + 1
				where 	TrainID = '$trainid' 
			and StartDate = (date'$startdate' - $deltaday)
			and  InnerStationID > '$startinid'
			and  InnerStationID <= '$endinid';";
				break;	
			case 4:
			$increase = "update  	AvailableSeat
				set 	YWXCount = YWXCount + 1
				where 	TrainID = '$trainid' 
			and StartDate = (date'$startdate' - $deltaday)
			and  InnerStationID > '$startinid'
			and  InnerStationID <= '$endinid';";
				break;
			case 5:
			$increase = "update  	AvailableSeat
				set 	RWSCount = RWSCount + 1
				where 	TrainID = '$trainid' 
			and StartDate = (date'$startdate' - $deltaday)
			and  InnerStationID > '$startinid'
			and  InnerStationID <= '$endinid';";
				break;	
			case 6:
			$increase = "update  	AvailableSeat
				set 	RWXCount = RwXCount + 1
				where 	TrainID = '$trainid' 
			and StartDate = (date'$startdate' - $deltaday)
			and  InnerStationID > '$startinid'
			and  InnerStationID <= '$endinid';";
				break;
		}
	$result_inc = pg_query($increase) or die('Query failed: ' . pg_last_error());
}

}
else{
	if(pg_result($result1, 0, 6)==1)
{
	$trainid1 = pg_result($result1,0,0);
	$startinid1 = pg_result($result1,0,3);
	$endinid1 = pg_result($result1,0,4);
	$startoutid1 = pg_result($result1,0,2);
	$seattype1 = pg_result($result1,0,5);
	$startdate1 = pg_result($result1,0,1);

	$trainid2 = pg_result($result1,1,0);
	$startinid2 = pg_result($result1,1,3);
	$endinid2 = pg_result($result1,1,4);
	$startoutid2 = pg_result($result1,1,2);
	$seattype2 = pg_result($result1,1,5);
	$startdate2 = pg_result($result1,1,1);

	$query2 = "select DeltaDay
from TrainStation
where trainid = '$trainid1' and OuterStationID = '$startoutid1';";
$result2 = pg_query($query2) or die('Query failed: ' . pg_last_error());
	$deltaday1 = pg_result($result2,0,0);

	$query3 = "select DeltaDay
from TrainStation
where trainid = '$trainid2' and OuterStationID = '$startoutid2';";
$result3 = pg_query($query3) or die('Query failed: ' . pg_last_error());

	$deltaday2 = pg_result($result3,0,0);


	switch ($seattype1) {
			case 0:
			$increase1 = "update  	AvailableSeat
				set 	YZCount = YZCount + 1
				where 	TrainID = '$trainid1' 
			and StartDate = (date'$startdate1' - $deltaday1)
			and  InnerStationID > '$startinid1'
			and  InnerStationID <= '$endinid1';";
				break;
			case 1:
			$increase1 = "update  	AvailableSeat
				set 	RZCount = RZCount + 1
				where 	TrainID = '$trainid1' 
			and StartDate = (date'$startdate1' - $deltaday1)
			and  InnerStationID > '$startinid1'
			and  InnerStationID <= '$endinid1';";
				break;
			case 2:
			$increase1 = "update  	AvailableSeat
				set 	YWSCount = YWSCount + 1
				where 	TrainID = '$trainid1' 
			and StartDate = (date'$startdate1' - $deltaday1)
			and  InnerStationID > '$startinid1'
			and  InnerStationID <= '$endinid1';";
				break;
			case 3:
			$increase1 = "update  	AvailableSeat
				set 	YWZCount = YWZCount + 1
				where 	TrainID = '$trainid1' 
			and StartDate = (date'$startdate1' - $deltaday1)
			and  InnerStationID > '$startinid1'
			and  InnerStationID <= '$endinid1';";
				break;	
			case 4:
			$increase1 = "update  	AvailableSeat
				set 	YWXCount = YWXCount + 1
				where 	TrainID = '$trainid1' 
			and StartDate = (date'$startdate1' - $deltaday1)
			and  InnerStationID > '$startinid1'
			and  InnerStationID <= '$endinid1';";
				break;
			case 5:
			$increase1 = "update  	AvailableSeat
				set 	RWSCount = RWSCount + 1
				where 	TrainID = '$trainid1' 
			and StartDate = (date'$startdate1' - $deltaday1)
			and  InnerStationID > '$startinid1'
			and  InnerStationID <= '$endinid1';";
				break;	
			case 6:
			$increase1 = "update  	AvailableSeat
				set 	RWXCount = RwXCount + 1
				where 	TrainID = '$trainid1' 
			and StartDate = (date'$startdate1' - $deltaday1)
			and  InnerStationID > '$startinid1'
			and  InnerStationID <= '$endinid1';";
				break;
		}
	$result_inc1 = pg_query($increase1) or die('Query failed: ' . pg_last_error());

	switch ($seattype2) {
			case 0:
			$increase2 = "update  	AvailableSeat
				set 	YZCount = YZCount + 1
				where 	TrainID = '$trainid2' 
			and StartDate = (date'$startdate2' - $deltaday2)
			and  InnerStationID > '$startinid2'
			and  InnerStationID <= '$endinid2';";
				break;
			case 1:
			$increase2 = "update  	AvailableSeat
				set 	RZCount = RZCount + 1
				where 	TrainID = '$trainid2' 
			and StartDate = (date'$startdate2' - $deltaday2)
			and  InnerStationID > '$startinid2'
			and  InnerStationID <= '$endinid2';";
				break;
			case 2:
			$increase2 = "update  	AvailableSeat
				set 	YWSCount = YWSCount + 1
				where 	TrainID = '$trainid2' 
			and StartDate = (date'$startdate2' - $deltaday2)
			and  InnerStationID > '$startinid2'
			and  InnerStationID <= '$endinid2';";
				break;
			case 3:
			$increase2 = "update  	AvailableSeat
				set 	YWZCount = YWZCount + 1
				where 	TrainID = '$trainid2' 
			and StartDate = (date'$startdate2' - $deltaday2)
			and  InnerStationID > '$startinid2'
			and  InnerStationID <= '$endinid2';";
				break;	
			case 4:
			$increase2 = "update  	AvailableSeat
				set 	YWXCount = YWXCount + 1
				where 	TrainID = '$trainid2' 
			and StartDate = (date'$startdate2' - $deltaday2)
			and  InnerStationID > '$startinid2'
			and  InnerStationID <= '$endinid2';";
				break;
			case 5:
			$increase2 = "update  	AvailableSeat
				set 	RWSCount = RWSCount + 1
				where 	TrainID = '$trainid2' 
			and StartDate = (date'$startdate2' - $deltaday2)
			and  InnerStationID > '$startinid2'
			and  InnerStationID <= '$endinid2';";
				break;	
			case 6:
			$increase2 = "update  	AvailableSeat
				set 	RWXCount = RwXCount + 1
				where 	TrainID = '$trainid2' 
			and StartDate = (date'$startdate2' - $deltaday2)
			and  InnerStationID > '$startinid2'
			and  InnerStationID <= '$endinid2';";
				break;
		}
	$result_inc2 = pg_query($increase2) or die('Query failed: ' . pg_last_error());
}


}

$query = "update orders set status=-1 where orderid='$orderid'";
pg_query($query);
	$cancel = pg_query($query) or die('Query failed: ' . pg_last_error());

?>
订单已经成功取消！

<p>
<a href="index.php"> 返回首页</a>
</p>
</body>
</html>
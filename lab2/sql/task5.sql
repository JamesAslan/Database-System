/*Oneticket*/
/*查询一次直达的火车票，输入出发时间，起点*/
/*和终点城市，出发日期                  */
select  ot.MinPrice, ot.TripTimemin, 
		ot.BeginCityName,ot.EndCityName, 
		ot.TrainID, 
		(ast.StartDate + ot.BeginDeltaDay) :: date as StartDate, 
		(ast.StartDate + ot.EndDeltaday ):: date as EndDate,
		ot.BeginStationName,ot.EndStationName,
		ot.BeginTime, ot.EndTime, 
		min(ast.YZCount) as YZCount,   min(ast.RZCount) as RZCount, min(ast.YWSCount) as YWSCount,
		min(ast.YWZCount) as YWZCount, min(ast.YWXCount) as YWXCount, min(ast.RWSCount) as RWSCount,
		min(ast.RWXCount) as RWXCount, 
		ot.PriceYZ,ot.PriceRZ, ot.PriceYWS, ot.PriceYWZ, ot.PriceYWX, 
		ot.PriceRWS, ot.PriceRWX,
		ot.YZen, ot.RZen , ot.YWSen , ot.YWZen,
		ot.YWXen, ot.RWSen , ot.RWXen

into OneTicket
from  	OneTrip as ot, AvailableSeat as ast
where 	(ot.BeginTime - time '06:30:00') > '0 min' and /*默认用户要求时间为06:30：*/
		(ast.StartDate + ot.BeginDeltaDay) = '2017/11/30'and/*默认时间为17/11/30*/
		ot.BeginCityName = '北京'and ot.EndCityName = '长沙' and /*在此sql语句中实现为北京到长沙*/
		ot.TrainID = ast.TrainID and ast.InnerStationID > ot.BeginStationID and 
		ast.InnerStationID <= ot.EndStationID	               /*保证内部的站的顺序*/
group by 
		ot.BeginCityName,ot.EndCityName, 		
		ot.TrainID, ot.BeginDeltaday,ot.EndDeltaday,
		ast.StartDate, 
		ot.BeginStationName,ot.EndStationName,
		ot.BeginTime, ot.EndTime,ot.Minprice,ot.TripTimemin,
		ot.PriceYZ,ot.PriceRZ, ot.PriceYWS, ot.PriceYWZ, ot.PriceYWX, 
		ot.PriceRWS, ot.PriceRWX,ot.TripTimeMin, ot.TripTimemin,
		ot.YZen, ot.RZen , ot.YWSen , ot.YWZen,
		ot.YWXen, ot.RWSen , ot.RWXen

order by MinPrice, TripTimemin, BeginTime/*根据最低价格，旅程时间，出发时间排序*/
asc limit  10 offset  0;


/*Transfertickets*/
/*查询一次换乘的火车票，输入出发时间，起点*/
/*和终点城市，出发日期                  */
/*中途换乘城市相同                     */
/*从OneTrip中挑选两个直达，组成换乘     */

/*同一天换乘的情况                     */
(select 	
		(ot1.MinPrice + ot2.MinPrice )as FinalMinPrice,
		(ot2.TripTimemin + ot2.TripTimemin) as FinalTripTimeMin,
		ot1.TrainID as Train1ID, 
		(ast1.StartDate + ot1.BeginDeltaday) :: date as Train1StartDate, (ast1.StartDate + ot1.EndDeltaDay) :: date as Train1EndDate, 
		ot1.BeginStationName,ot1.BeginCityName, ot1.MinPrice as Train1MinPrice, ot1.TripTimemin as Train1TripTimeMin,
		ot1.BeginTime as Train1BeginTime, ot1.EndTime as Train1EndTime,

		ot1.EndStationName as Train1EndStationName, 
		ot1.EndCityName as TransferCityName,

		ot2.TrainID as Train2ID, 
		(ast2.StartDate + ot2.BeginDeltaday):: date as Train2STartDate,(ast2.StartDate + ot2.EndDeltaday):: date as Train2EndDate,
		ot2.BeginStationName as Train2BeginStationName,ot2.MinPrice as Train2MinPrice, ot2.TripTimemin as Train2TripTimeMin,
		ot2.EndStationName,  ot2.EndCityName,
		ot2.BeginTime as Train2BeginTime, ot2.EndTime as Train2EndTime,
		
		ot1.PriceYZ  as Train1PriceYZ, ot2.PriceYZ as Train2PriceYZ, ot1.PriceRZ as Train1PriceRZ, ot2.PriceRZ as Train2PriceRZ, 
		ot1.PriceYWS as Train1PriceYWS, ot2.PriceYWS as Train2PriceYWS, ot1.PriceYWZ as Train1PriceYWZ, ot2.PriceYWZ as  Train2PriceYWZ, 
		ot1.PriceYWX as Train1PriceYWX,ot2.PriceYWX as Train2PriceYWX, ot1.PriceRWS as Train1PriceRWS,ot2.PriceRWS as Train2PriceRWS, 
		ot1.PriceRWX as Train1PriceRWX, ot2.PriceRWX as Train2PriceRWX,

		min(ast1.YZCount)  as Train1YZCount,  min(ast1.RZCount) as Train1RZCount,
		min(ast1.YWSCount) as Train1YWSCount, min(ast1.YWZCount)  as Train1YWZCount, min(ast1.YWXCount) as Train1YWXCount, 
		min(ast1.RWSCount) as Train1RWSCount, min(ast1.RWXCount) as Train1RWXCount,	

		min(ast2.YZCount)  as  Train2YZCount,  min(ast2.RZCount) as Train2RZCount,
		min(ast2.YWSCount) as Train2YWSCount, min(ast2.YWZCount)  as Train2YWZCount, min(ast2.YWXCount) as Train2YWXCount, 
		min(ast2.RWSCount) as Train2RWSCount, min(ast2.RWXCount) as Train2RWXCount,
		ot1.YZen as Train1YZen, ot1.RZen as Train1RZen, ot1.YWSen as Train1YWSen, ot1.YWZen as Train1YWZen,
		ot1.YWXen as Train1YWXen ,ot1.RWSen as Train1RWSen, ot1.RWXen as Train1RWXen,
		ot2.YZen as Train2YZen, ot2.RZen as Train2RZen, ot2.YWSen as Train2YWSen, ot2.YWZen as Train2YWZen,
		ot2.YWXen as Train2YWXen, ot2.RWSen as Train2RWSen, ot2.RWXen as Train2RWXen,
		(ot2.BeginTime - ot1.EndTime) :: time as WaitTime
into TransferTickets
from	  OneTrip as ot1, OneTrip as ot2 , AvailableSeat as ast1, AvailableSeat ast2
where 	
		ot1.BeginCityName = '长沙'and ot2.EndCityName = '哈尔滨' and /*默认地点为长沙到哈尔滨 */
		ot1.EndCityName = ot2.BeginCityName and 

		(	(ot1.EndStationOut = ot2.BeginStationOut  
		and (  ((ot2.BeginTime - ot1.EndTime)> '0 min' and ((ot2.BeginTime - ot1.EndTime ) between interval'1 hour' and  interval'4 hour')) 
			))  or
			(ot1.EndStationOut <>ot2.BeginStationOut  
		and (  ((ot2.BeginTime - ot1.EndTime)> '0 min' and ((ot2.BeginTime - ot1.EndTime ) between interval'2 hour' and  interval'4 hour')) 
		)) ) /*换乘时间关系*/
		and 
		(ot1.BeginTime - time'06:00:00') >= '0 min' and /*起始时间默认为06:00*/
		(ast1.StartDate + ot1.BeginDeltaday) = '2017/11/25'and   ( ast2.StartDate + ot2.BeginDeltaday) = (ast1.StartDate + ot1.EndDeltaday)  and/*同一天换乘的情况*/
		ot1.TrainID = ast1.TrainID and ast1.InnerStationID > ot1.BeginStationID and ast1.InnerStationID <= ot1.EndStationID	and/*从OneTrip中挑选*/
		ot2.TrainID = ast2.TrainID and 
		(ast2.InnerStationID > ot2.BeginStationID and ast2.InnerStationID <= ot2.EndStationID	) 

group by
		ot1.BeginCityName,ot1.EndCityName ,ot2.EndCityName,
		ot1.TrainID ,ast1.StartDate, ot1.BeginDeltaday,ot2.BeginDeltaday,ot2.BeginDeltaday,ot1.EndDeltaday,ot2.EndDeltaday,
		ot1.BeginStationName, ot1.EndStationName , Train1MinPrice, Train1TripTimeMin,
		ot1.BeginTime, ot1.EndTime ,

		ot2.TrainID , ast2.StartDate,
		ot2.BeginStationName ,ot2.EndStationName, Train2MinPrice, Train2TripTimeMin,
		ot2.BeginTime , ot2.EndTime,	

		ot1.PriceYZ ,  ot1.PriceRZ ,ot1.PriceYWS ,ot1.PriceYWZ ,ot1.PriceYWX, ot1.PriceRWS,
		ot1.PriceRWX,
		ot2.PriceYZ,ot2.PriceRZ ,  ot2.PriceYWS ,  ot2.PriceYWZ, ot2.PriceYWX,ot2.PriceRWS,  ot2.PriceRWX  ,
		Train1YZen, Train1RZen, Train1YWSen, Train1YWZen,
		Train1YWXen , Train1RWSen, Train1RWXen,
		Train2YZen, Train2RZen,  Train2YWSen, Train2YWZen,
		Train2YWXen , Train2RWSen,  Train2RWXen,
		WaitTime
 )union(
 /*换乘时间为隔日                           */

		select
		(ot1.MinPrice + ot2.MinPrice )as FinalMinPrice,
		(ot2.TripTimemin + ot2.TripTimemin) as FinalTripTimeMin,
		ot1.TrainID as Train1ID, 
		(ast1.StartDate + ot1.BeginDeltaday) :: date as Train1StartDate, (ast1.StartDate + ot1.EndDeltaDay) :: date as Train1EndDate, 
		ot1.BeginStationName,ot1.BeginCityName, ot1.MinPrice as Train1MinPrice, ot1.TripTimemin as Train1TripTimeMin,
		ot1.BeginTime as Train1BeginTime, ot1.EndTime as Train1EndTime,

		ot1.EndStationName as Train1EndStationName, 
		ot1.EndCityName as TransferCityName,

		ot2.TrainID as Train2ID, 
		(ast2.StartDate + ot2.BeginDeltaday):: date as Train2STartDate,(ast2.StartDate + ot2.EndDeltaday):: date as Train2EndDate,
		ot2.BeginStationName as Train2BeginStationName,ot2.MinPrice as Train2MinPrice, ot2.TripTimemin as Train2TripTimeMin,
		ot2.EndStationName,  ot2.EndCityName,
		ot2.BeginTime as Train2BeginTime, ot2.EndTime as Train2EndTime,
		
		ot1.PriceYZ  as Train1PriceYZ, ot2.PriceYZ as Train2PriceYZ, ot1.PriceRZ as Train1PriceRZ, ot2.PriceRZ as Train2PriceRZ, 
		ot1.PriceYWS as Train1PriceYWS, ot2.PriceYWS as Train2PriceYWS, ot1.PriceYWZ as Train1PriceYWZ, ot2.PriceYWZ as  Train2PriceYWZ, 
		ot1.PriceYWX as Train1PriceYWX,ot2.PriceYWX as Train2PriceYWX, ot1.PriceRWS as Train1PriceRWS,ot2.PriceRWS as Train2PriceRWS, 
		ot1.PriceRWX as Train1PriceRWX, ot2.PriceRWX as Train2PriceRWX,

		min(ast1.YZCount)  as Train1YZCount,  min(ast1.RZCount) as Train1RZCount,
		min(ast1.YWSCount) as Train1YWSCount, min(ast1.YWZCount)  as Train1YWZCount, min(ast1.YWXCount) as Train1YWXCount, 
		min(ast1.RWSCount) as Train1RWSCount, min(ast1.RWXCount) as Train1RWXCount,	

		min(ast2.YZCount)  as  Train2YZCount,  min(ast2.RZCount) as Train2RZCount,
		min(ast2.YWSCount) as Train2YWSCount, min(ast2.YWZCount)  as Train2YWZCount, min(ast2.YWXCount) as Train2YWXCount, 
		min(ast2.RWSCount) as Train2RWSCount, min(ast2.RWXCount) as Train2RWXCount,

		ot1.YZen as Train1YZen, ot1.RZen as Train1RZen, ot1.YWSen as Train1YWSen, ot1.YWZen as Train1YWZen,
		ot1.YWXen as Train1YWXen ,ot1.RWSen as Train1RWSen, ot1.RWXen as Train1RWXen,
		ot2.YZen as Train2YZen, ot2.RZen as Train2RZen, ot2.YWSen as Train2YWSen, ot2.YWZen as Train2YWZen,
		ot2.YWXen as Train2YWXen, ot2.RWSen as Train2RWSen, ot2.RWXen as Train2RWXen,
		(ot2.BeginTime - ot1.EndTime + time'24:00:00' ) :: time as WaitTime

from	OneTrip as ot1, OneTrip as ot2 , AvailableSeat as ast1, AvailableSeat ast2
where 	
		ot1.BeginCityName = '长沙'and ot2.EndCityName = '哈尔滨' and /*默认为长沙到哈尔滨*/
		ot1.EndCityName = ot2.BeginCityName and 
		(	(ot1.EndStationOut = ot2.BeginStationOut  /*隔日换乘*/
		and (  ((ot2.BeginTime - ot1.EndTime)< '0 min'and ((ot2.BeginTime - ot1.EndTime+ interval'1 day') between interval'1 hour' and  interval'4 hour'))
			))  or
			(ot1.EndStationOut <>ot2.BeginStationOut  
		and (   ((ot2.BeginTime - ot1.EndTime)< '0 min'and ((ot2.BeginTime - ot1.EndTime+ interval'1 day') between interval'2 hour' and  interval'4 hour'))
			) ))
		and 

		(ot1.BeginTime -  time'06:00:00') >= '0 min' and /*出发时间默认为06:00*/
		(ast1.StartDate + ot1.BeginDeltaday) = '2017/11/25'and   ( ast2.StartDate + ot2.BeginDeltaday) =(ast1.StartDate + ot1.EndDeltaday + '1 day') and
		ot1.TrainID = ast1.TrainID and ast1.InnerStationID > ot1.BeginStationID and ast1.InnerStationID <= ot1.EndStationID	and
		ot2.TrainID = ast2.TrainID and 
		(ast2.InnerStationID > ot2.BeginStationID and ast2.InnerStationID <= ot2.EndStationID	) 

group by
		ot1.BeginCityName,ot1.EndCityName ,ot2.EndCityName,
		ot1.TrainID ,ast1.StartDate,ot1.BeginDeltaday,ot2.BeginDeltaday,ot1.EndDeltaday,ot2.EndDeltaday,
		ot1.BeginStationName, ot1.EndStationName , Train1MinPrice, Train1TripTimeMin,
		ot1.BeginTime, ot1.EndTime ,

		ot2.TrainID , ast2.StartDate,
		ot2.BeginStationName ,ot2.EndStationName, Train2MinPrice, Train2TripTimeMin,
		ot2.BeginTime , ot2.EndTime,	

		ot1.PriceYZ ,  ot1.PriceRZ ,ot1.PriceYWS ,ot1.PriceYWZ ,ot1.PriceYWX, ot1.PriceRWS,
		ot1.PriceRWX,
		ot2.PriceYZ,ot2.PriceRZ ,  ot2.PriceYWS ,  ot2.PriceYWZ, ot2.PriceYWX,ot2.PriceRWS,  ot2.PriceRWX ,
		Train1YZen, Train1RZen, Train1YWSen, Train1YWZen,
		Train1YWXen , Train1RWSen, Train1RWXen,
		Train2YZen, Train2RZen,  Train2YWSen, Train2YWZen,
		Train2YWXen , Train2RWSen,  Train2RWXen,
		WaitTime		
)
order by FinalMinPrice, FinalTripTimeMin, Train1BeginTime, Train2BeginTime/*根据最低价格，旅程时间，出发时间排序*/
asc limit 10 offset 0;

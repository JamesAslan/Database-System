/*Table OneTrip*/
/*全国所有城市之间的直达车辆信息，显示起始站和结束站，和其他和车次相关的信息*/
/*此表单只在内部使用，不需要显示*/
select 	ts1.TrainID as TrainID,c1.CityName as BeginCityName, ts1.StationName as BeginStationName,
		ts1.OuterStationID as BeginStationOut, ts1.InnerStationID as BeginStationID, 
		ts1.StartTime BeginTime,ts2.ArriveTime as EndTime,
		ts2.StationName as EndStationName,ts2.OuterStationID as EndStationOut, 
		ts2.InnerStationID as EndStationID,  c2.CityName as EndCityName,
		(ts2.ArriveTimeMin - ts1.StartTimeMin) as TripTimeMin,
		(ts1.Deltaday || 'day')  :: interval as BeginDeltaDay,
		(ts2.DeltaDay || 'day')  :: interval as EndDeltaDay,

		(ts2.PriceYZ -   ts1.PriceYZ) as PriceYZ, (ts2.PriceRZ - ts1.PriceRZ) as PriceRZ,
		(ts2.PriceYWS - ts1.PriceYWS) as PriceYWS, (ts2.PriceYWZ - ts1.PriceYWZ) as PriceYWZ,
		(ts2.PriceYWX - ts1.PriceYWX) as PriceYWX, (ts2.PriceRWS - ts1.PriceRWS) as PriceRWS,
		(ts2.PriceRWX - ts1.PriceRWX) as PriceRWX,
		tl1.YZen, tl1.RZen , tl1.YWSen , tl1.YWZen,
		tl1.YWXen  , tl1.RWSen , tl1.RWXen

into OneTrip
from	TrainStation as ts1, TrainStation as ts2, TrainsOfCity as c1, TrainsOfCity as c2, TrainList as tl1
where  	ts1.TrainID = ts2.TrainID and ts1.TrainID = tl1.TrainID and /*保证是同一辆车*/	
		ts1.OuterStationID = c1.OuterStationID 	and ts1.ForbidFlag = 0 and /*排除不能上下车的站*/
		ts2.OuterStationID = c2.OuterStationID  and ts2.ForbidFlag = 0 and
		ts1.InnerStationID < ts2.InnerStationID ;/*保证 出发站 在前，到达站在后*/

		
/*排除掉因为中途不能上下车fobitflag = 1*/
/*导致的价格为负数                    */
/*将负数转化为正数                    */
update OneTrip
	set PriceYz = 0
	where PriceYz < 0;

update OneTrip
	set PriceYWS = 0
	where PriceYWS < 0;

update OneTrip
	set PriceYWZ = 0
	where PriceYWZ < 0;

update OneTrip
	set PriceYWX = 0
	where PriceYWX < 0;

update OneTrip
	set PriceRZ = 0
	where PriceRZ < 0;

update OneTrip
	set PriceRWS = 0
	where PriceRWS < 0;

update OneTrip
	set PriceRWX = 0
	where PriceRWX < 0;

/*增加OneTrip一列，为最低价格          */
/*记录价格中最低的一列                 */
alter table OneTrip add MinPrice decimal(5,1) default 9000.0;/*价格最便宜的*/

/*更新MinPrice                       */
update OneTrip
set MinPrice = PriceYZ
where MinPrice > PriceYZ and PriceYZ > 0;


update OneTrip
set MinPrice = PriceYWS
where MinPrice > PriceYWS and PriceYWS> 0;


update OneTrip
set MinPrice = PriceYWZ
where MinPrice > PriceYWZ and PriceYWZ > 0;

update OneTrip
set MinPrice = PriceYWX
where MinPrice > PriceYWX and PriceYWX > 0;

update OneTrip
set MinPrice = PriceRZ
where MinPrice > PriceRZ and PriceRZ > 0;


update OneTrip
set MinPrice = PriceRWS
where MinPrice > PriceRWS and PriceRWS > 0;


update OneTrip
set MinPrice = PriceRWX
where MinPrice > PriceRWX and PriceRWX > 0;
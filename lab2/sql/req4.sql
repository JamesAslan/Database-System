/*功能需求：按车次查车站余票信息
	给定输入  	车次 G351
				查询日期 2017/11/26
	输出 按车站排序的站名、时间、余座（从起点站到第i站）、票价等信息
*/

(
select  ts.InnerStationID, ts.StationName, ts.ArriveTime, ts.StartTime, 
		ts.PriceYZ, (ast.YZCount) as YZCount, 
		ts.PriceRZ, (ast.RZCount) as RZCount, 
		ts.PriceYWS, (ast.YWSCount) as YWSCount, 
		ts.PriceYWZ, (ast.YWZCount) as YWZCount, 
		ts.PriceYWX, (ast.YWXCount) as YWXCount,
		ts.PriceRWS, (ast.RWSCount) as RWSCount, 
		ts.PriceRWX, (ast.RWXCount) as RWXCount, 
		tl.YZEn, tl.RZEn, tl.YWSEn, tl.YWZEn, tl.YWXEn, tl.RWSEn, tl.RWXEn, /* 输出这列车是否开了某座位类型 交给网页输出‘-’ */
		ts.ForbidFlag /*是否在这站不售票 如果是 网页输出 '-' */
from TrainStation as ts, AvailableSeat as ast , TrainList as tl
where ( ts.TrainID = 'G351' and
		ast.TrainID = 'G351' and
		tl.TrainID = 'G351' and 
		ast.StartDate = '2017/11/26' and
		ast.InnerStationID = 1 and /*单独处理起始站的情况(不能买到起始站的票) 网页输出全为'-' */
		ts.InnerStationID = 1
		)
order by ts.InnerStationID
) /*上一部分完全是因为起始站需要单独处理余座的情况*/
union
(
select  ts.InnerStationID, ts.StationName, ts.ArriveTime, ts.StartTime, 
		ts.PriceYZ, min(ast.YZCount) as YZCount, 
		ts.PriceRZ, min(ast.RZCount) as RZCount, 
		ts.PriceYWS, min(ast.YWSCount) as YWSCount, 
		ts.PriceYWZ, min(ast.YWZCount) as YWZCount, 
		ts.PriceYWX, min(ast.YWXCount) as YWXCount,
		ts.PriceRWS, min(ast.RWSCount) as RWSCount, 
		ts.PriceRWX, min(ast.RWXCount) as RWXCount, 
		tl.YZEn, tl.RZEn, tl.YWSEn, tl.YWZEn, tl.YWXEn, tl.RWSEn, tl.RWXEn,
		ts.ForbidFlag
from TrainStation as ts, AvailableSeat as ast , TrainList as tl
where ( ts.TrainID = 'G351' and
		ast.TrainID = 'G351' and
		tl.TrainID = 'G351' and 
		ast.StartDate = '2017/11/26' and
		((ast.InnerStationID <= ts.InnerStationID and /*在余座表大于起点(第1站)小于第i站的情况下求所有余座Count的最小值,即这条路段的最小值*/
		ast.InnerStationID > 1)
		))
group by ts.InnerStationID, ts.StationName, ts.ArriveTime, ts.StartTime,
		 ts.PriceYZ, ts.PriceRZ, ts.PriceYWS, ts.PriceYWZ, ts.PriceYWX,
		 ts.PriceRWS, ts.PriceRWX, 
		 tl.YZEn, tl.RZEn, tl.YWSEn, tl.YWZEn, tl.YWXEn, tl.RWSEn, tl.RWXEn,
		 ts.ForbidFlag
order by ts.InnerStationID
);

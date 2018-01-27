/*功能：查询历史订单
输入：用户名 lgd    查询起点2017-11-25 查询终点2017-11-25
输出：订单状态等信息
*/

select OrderID, Orders.StartDate, TS1.StationName, TS2.StationName, Sum(OrderPrice), Status, TS1.StartTime
from Orders, TrainStation as TS1, TrainStation as TS2
where TS1.OuterStationID = Orders.StartStationOuterID and
		TS2.OuterStationID = Orders.EndStationOuterID and
		TS1.TrainID = Orders.TrainID and
		TS2.TrainID = Orders.TrainID and /*限定是orders里才有的车次*/
		Orders.UserId = 'lgd' and
		Orders.StartDate >= '2017-11-25' and /*查询范围是起点到终点*/
		Orders.StartDate <= '2017-11-25'
group by OrderID, Orders.StartDate, TS1.StationName, TS2.StationName, Status
order by OrderID;
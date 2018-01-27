/* 输入：当前userid trainid startinnerstationid endinnerstationid whichday            st1->st2*/
/* 输出 orderid trainid startstationname endstationname startdate starttime arrivetime         st3->st4*/
select od.orderid, od.trainid, ts3.stationname, ts4.stationname, od.startdate, ts3.starttime, ts4.arrivetime
from orders as od, 
	trainstation as ts1, trainstation as ts2, trainstation as ts3, trainstation as ts4
where 
	od.userid = 'lyw' and 
	ts1.trainid = 'G1' and ts2.trainid = 'G1' and
	od.status != -1 and 
	od.startdate + ts1.deltaday = '2017-11-30' and
	
	ts3.trainid = od.trainid and ts4.trainid = od.trainid and
	
	ts1.innerstationid = '1' and
	ts2.innerstationid = '2' and
	ts3.innerstationid = od.startstationinnerid and
	ts4.innerstationid = od.endstationinnerid and
	
	(
	((ts1.starttimemin >= ts3.starttimemin) and (ts1.starttimemin  <= ts4.arrivetimemin)) or  /*st3---st1--->st4  (st2) */
	((ts2.starttimemin >= ts3.starttimemin) and (ts2.arrivetimemin <= ts4.arrivetimemin)) or  /*(st1)  st3---st2--->st4 */
	((ts1.starttimemin <= ts3.starttimemin) and (ts4.arrivetimemin <= ts2.arrivetimemin))     /*st1  st3------>st4   st2*/
	)
;



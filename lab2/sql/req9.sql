/*9_1 总订单数*/

select count(distinct OrderID) 
from orders;

/*9_2 总票价*/

select sum(OrderPrice)
from orders;

/*9_3 最热点车次排序*/
select TrainID, count(*) as OrderTimes
from orders
group by TrainID
order by OrderTimes desc limit 10;

/*9_4 当前注册用户列表*/
select *
from users;

/*9_5 查看每个用户的订单*/
/*refers to req_8*/



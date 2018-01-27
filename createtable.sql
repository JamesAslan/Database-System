
/* v5 17-11-23 */
/* 修改了 TrainStation */
/* 增加了 TrainList*/
/* replace 'float' -> 'decimal(5,1)' */

create table TrainList (
	TrainID varchar(5) primary key,
	YZen integer,
	RZen integer,
	YWSen integer,
	YWZen integer,
	YWXen integer,
	RWSen integer,
	RWXen integer
	);


create table TrainStation (
	InnerStationID integer,
	TrainID varchar(5),
	OuterStationID integer,
	StationName varchar(20),
	Mile integer,
	PriceYZ decimal(5,1),
	PriceRZ decimal(5,1),
	PriceYWS decimal(5,1),
	PriceYWZ decimal(5,1),
	PriceYWX decimal(5,1),
	PriceRWS decimal(5,1),
	PriceRWX decimal(5,1),
	
	DeltaDay integer,
	ArriveTime Time,
	StartTime Time,
	ArriveTimeMin integer,
	StartTimeMin integer,
	ForbidFlag integer,
	primary key(TrainID, OuterStationID)
	);

create table TrainsOfCity (
	StationName varchar(20),
	OuterStationID integer not null,
	primary key(CityName, OuterStationID));

create table Orders (
	Status integer, /* 0 = 未付款    1 = 付款    -1 = 取消 */
	OrderID varchar(20),
	TrainID varchar(5),
	StartDate date,
	StartStationOuterID integer,
	EndStationOuterID integer,
	StartStationInnerID integer,
	EndStationInnerID integer,
	SeatType integer, /* 0 YZ  1 RZ  2 YWS  3 YWZ  4 YWX  5 RWS  6 RWX */
	OrderPrice decimal(5,1),
	Username varchar(20),
	
	TrainStartDate date,
	primary key (OrderID, TrainID)
	);
	
create table Users (
	UserID varchar(18) primary key,
	Phone varchar(11) unique,
	CreditCard varchar(16),
	Username varchar(20) unique,
	Realname varchar(20),
	Userpwd varchar(20)
	);
	
create table AvailableSeat (
	TrainID varchar(5),
	StartDate date, 
	InnerStationID integer,
	YZCount integer,
	RZCount integer,
	YWSCount integer,
	YWZCount integer,
	YWXCount integer,
	RWSCount integer,
	RWXCount integer,
	primary key (TrainID, StartDate, InnerStationID)
	);
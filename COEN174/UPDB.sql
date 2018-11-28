Drop Table UserPass;
Drop Table UserInfo;
Drop Table AlumniEvents; 
Drop Table EventsDescription;
Drop Table CheckIn;

Create Table UserInfo(
	firstName varchar(20),
	lastName varchar(20),
	email varchar(30) PRIMARY KEY,
	gradYear int,
	username varchar(20),
	pass varchar(20)
);

Create Table UserPass(
	userName varchar(20) PRIMARY KEY,
	pass varchar(20)
);

Create Table AlumniEvents(
	eventsId int PRIMARY KEY,
	eventName varchar(40),
	firstname varchar(20),
	lastname varchar(20),
	gradyear int,
	major varchar(50),
	location varchar(40),
	eventDate varchar(15),
	eventsDescription varchar(1000)
);

Create Table pendingEvents(
	eventsId int PRIMARY KEY,
	eventName varchar(40),
	firstname varchar(20),
	lastname varchar(20),
	gradyear int,
	major varchar(50),
	location varchar(40),
	eventDate varchar(15),
	eventsDescription varchar(1000)
);

Create Table Alumnioffice(
	officeId int PRIMARY KEY,
	firstname varchar(20),
	lastname varchar(20)
);


Create Table CheckIn(
	email varchar(50),
	eventId int,
	firstname varchar(20),
	lastname varchar(20),
	gradYear int,
	major varchar(50)
);

Create Table Temp(
	eventsId int,
	eventsName varchar(30)
);

Create Table AlumniDB(
	firstname varchar(20),
	lastname varchar(20),
	gradYear int,
	major varchar(50)
);

insert into AlumniDB values('Alexander', 'Adranly', 2018, 'Computer Science and Engineering');
insert into AlumniDB values('Andrew', 'Nguyen', 2019, 'Computer Science and Engineering');
insert into AlumniDB values('Daisuke', 'Kurita', 2019, 'Computer Science and Engineering');
insert into AlumniDB values('Miguel', 'Camblor', 2019, 'Computer Science and Engineering');
insert into AlumniDB values('Lily', 'Rodgers', 2019, 'Psychology');


create sequence eventsId
start with 1
increment by 1
minvalue 1
maxvalue 10000;

create sequence officeId
start with 100
increment by 1
minvalue 100
maxvalue 10000;

insert into alumnioffice values(officeId.nextval, 'Andrew', 'Nguyen');
insert into alumnioffice values(officeId.nextval, 'Daisuke', 'Kurita');
insert into alumnioffice values(officeId.nextval, 'Miguel', 'Camblor');

insert into alumnievents (eventsid, eventname, firstname, lastname, gradyear, location, eventdate, eventsdescription) select eventsid, eventname, firstname, lastname, gradyear, location, eventdate, eventsdescription from pendingevents where pendingevents.eventsid = 71;

delete from alumnievents where eventsid = 71;



select eventName, eventsId from Alumnievents where eventsId in (select eventId from checkin);
insert into temp select checkin.eventId, Alumnievents.eventName from checkin inner join AlumniEvents on checkIn.eventId = Alumnievents.eventsId order by checkin.eventId;
select count(*) as NumberOfAttendees, eventsId from Temp group by eventsId order by eventsId;

insert into userpass values('anguyen', 'nguyen');
insert into userpass values('scu', 'alumni');
select username, pass from UserPass where userName = 'scu' and pass = 'alumni';
select username from UserPass where userName = 'scu' and pass = 'nguyen';

select eventid, firstname, lastname, gradyear, major from checkin order by eventid;

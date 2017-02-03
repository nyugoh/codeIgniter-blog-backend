
--create a database
create database if not exists blogie;

--select the database
use blogie;

--create a table
create table if not exists stories(
	id int not null auto_increment primary key,
	title varchar(500) not null,
	author varchar(250) not null,
	description varchar(250) not null,
	body text not null,
	tags varchar(500) not null,
	status int default 0,
	date_created datetime not null,
	date_modified datetime not null,
	category int not null default 1,
	likes int default 0,
	cover varchar(60) default 'cover.jpg',
	shares int default 0
)Engine=InnoDB, Charset=utf8;

--create users table
create table if not exists authors(
	id int not null auto_increment primary key,
	fname varchar(60) not null,
	lname varchar(60) not null,
	password varchar(41) not null,
	username varchar(60) not null,
	photo varchar(60) default 'avater.png',
	level int default 1,
	profession varchar(60) not null,
	genre int default 1,
	email varchar(100) not null,
	articles int default 0
)Engine=InnoDB, Charset='utf8';


--insert one record
--insert into authors values('Admin','Nyugoh','Super-Admin', 'user.png',5,'Web developer',2,10 ,'123456789');
--insert into authors values('Joe','Nyugoh','Admin', 'user.png',5,'Web developer',2,10 ,'987654321');




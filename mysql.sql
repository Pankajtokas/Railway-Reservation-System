/*
SQLyog Enterprise - MySQL GUI v8.05 
MySQL - 5.6.21 : Database - reservationsystem
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`reservationsystem` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `reservationsystem`;

/*Table structure for table `booking` */

DROP TABLE IF EXISTS `booking`;

CREATE TABLE `booking` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `route_id` bigint(20) DEFAULT NULL,
  `train_id` bigint(20) DEFAULT NULL,
  `pnr_no` varchar(10) DEFAULT NULL,
  `no_of_seat` int(10) DEFAULT NULL,
  `booking_amount` decimal(10,2) DEFAULT NULL,
  `booking_status` varchar(20) DEFAULT NULL,
  `journey_date` varchar(20) DEFAULT NULL,
  `booking_class` varchar(50) DEFAULT NULL,
  `card_no` varchar(20) DEFAULT NULL,
  `expiry_date` varchar(20) DEFAULT NULL,
  `cvv` varchar(4) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `booking` */

insert  into `booking`(`id`,`user_id`,`route_id`,`train_id`,`pnr_no`,`no_of_seat`,`booking_amount`,`booking_status`,`journey_date`,`booking_class`,`card_no`,`expiry_date`,`cvv`,`created`) values (1,10,3,5,'1234567899',2,'3000.00','Book','2017-03-30','Sleeper','7878787878787878','10/20120','123','2017-03-28 01:44:41'),(2,10,7,5,'1234569890',2,'3000.00','Cancelled','2017-03-30','Sleeper','7878787878787878','10/20120','123','2017-03-28 01:44:41'),(3,10,3,5,'58d98a3649',2,'800.00','Book','2017-03-30','Sleeper','8989898989898989','10/2018','123','2017-03-28 00:00:00'),(4,10,3,5,'58d98a7f36',2,'800.00','Book','2017-03-30','Sleeper','8989898989898989','10/2018','123','2017-03-28 00:00:00'),(5,10,1,3,'58d98add24',1,'700.00','Book','2017-04-01','First AC','7687878787878787','10/2018','123','2017-03-28 00:00:00');

/*Table structure for table `booking_details` */

DROP TABLE IF EXISTS `booking_details`;

CREATE TABLE `booking_details` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `booking_id` bigint(20) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `gender` varchar(100) DEFAULT NULL,
  `age` varchar(5) DEFAULT NULL,
  `booking_status` varchar(20) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `booking_details` */

insert  into `booking_details`(`id`,`user_id`,`booking_id`,`name`,`gender`,`age`,`booking_status`,`created`) values (1,10,1,'Kamal Kant','Male','25','Book','2017-03-28 01:45:15'),(2,10,1,'Hemant','Male','20','Book','2017-03-28 01:45:33'),(3,10,2,'Kamal Kant','Male','25','Book','2017-03-28 01:45:33'),(4,10,2,'Hemant','Male','20','Book','2017-03-28 01:45:33'),(5,10,3,'Pawan','Male','25','Book','2017-03-28 00:00:00'),(6,10,3,'Priyanka','Female','20','Book','2017-03-28 00:00:00'),(7,10,4,'Pawan','Male','25','Book','2017-03-28 00:00:00'),(8,10,4,'Priyanka','Female','20','Book','2017-03-28 00:00:00'),(9,10,5,'Raj Gupta','Male','20','Book','2017-03-28 00:00:00');

/*Table structure for table `routes` */

DROP TABLE IF EXISTS `routes`;

CREATE TABLE `routes` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `source` varchar(255) DEFAULT NULL,
  `destination` varchar(255) DEFAULT NULL,
  `distance` int(10) DEFAULT NULL,
  `route_via` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `routes` */

insert  into `routes`(`id`,`source`,`destination`,`distance`,`route_via`,`created`) values (1,'Delhi','Mumbai',1500,'Bhopal, Nagpur, Jhansi','2017-03-27 00:41:24'),(2,'Delhi','Pune',1300,'Bhopal, Nagpur, Jhansi','2017-03-27 00:42:40'),(3,'Pune','Bhopal',900,'','2017-03-27 00:43:22'),(4,'Delhi','Banglor',2500,'Jaipur','2017-03-27 00:43:51'),(5,'Delhi','Habra',2400,'Patna','2017-03-27 00:44:05');

/*Table structure for table `train_running_details` */

DROP TABLE IF EXISTS `train_running_details`;

CREATE TABLE `train_running_details` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `train_id` bigint(20) DEFAULT NULL,
  `train_status` varchar(200) DEFAULT NULL,
  `train_reached` varchar(200) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `train_running_details` */

insert  into `train_running_details`(`id`,`train_id`,`train_status`,`train_reached`,`created`) values (1,3,'Delay','Not Reached','2017-03-25 23:43:19'),(2,3,'2 hour running late','rach sabarmati','2017-03-27 00:51:40'),(3,3,'2 hour running late','rach sabarmati','2017-03-27 00:53:32');

/*Table structure for table `trains` */

DROP TABLE IF EXISTS `trains`;

CREATE TABLE `trains` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `start_time` varchar(20) DEFAULT NULL,
  `reached_time` varchar(20) DEFAULT NULL,
  `route_id` bigint(20) NOT NULL,
  `train_no` varchar(10) NOT NULL,
  `train_name` varchar(200) NOT NULL,
  `sleeper_seat` int(10) DEFAULT NULL,
  `sleeper_fare` decimal(10,2) DEFAULT NULL,
  `third_ac_seat` int(10) DEFAULT NULL,
  `third_ac_fare` decimal(10,2) DEFAULT NULL,
  `second_ac_seat` int(10) DEFAULT NULL,
  `second_ac_fare` decimal(10,2) DEFAULT NULL,
  `first_ac_seat` int(10) DEFAULT NULL,
  `first_ac_fare` decimal(20,0) DEFAULT NULL,
  `running_day` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `trains` */

insert  into `trains`(`id`,`start_time`,`reached_time`,`route_id`,`train_no`,`train_name`,`sleeper_seat`,`sleeper_fare`,`third_ac_seat`,`third_ac_fare`,`second_ac_seat`,`second_ac_fare`,`first_ac_seat`,`first_ac_fare`,`running_day`,`created`) values (3,'10:00','23:40',1,'1238','Basali',12,'400.00',12,'500.00',12,'600.00',12,'700','2','2017-03-25 23:03:24'),(4,'11:00','24:00',1,'12456','Delhi Mumbai Expres',10,'700.00',10,'1000.00',10,'1500.00',10,'2000','Daily','2017-03-27 01:00:00'),(5,'11:00','24:00',3,'1238','Vaishali',10,'400.00',12,'500.00',12,'1500.00',12,'2345','Daily','2017-03-27 01:02:02');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(25) DEFAULT NULL,
  `phone_no` varchar(20) DEFAULT NULL,
  `gender` varchar(16) NOT NULL DEFAULT '',
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `country` varchar(255) DEFAULT 'India',
  `pin_no` varchar(6) DEFAULT NULL,
  `status` char(1) DEFAULT '1',
  `user_type` varchar(20) DEFAULT NULL,
  `adding_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `phone_no` (`phone_no`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`password`,`phone_no`,`gender`,`city`,`state`,`address`,`country`,`pin_no`,`status`,`user_type`,`adding_date`) values (1,'Administrator','admin@gmail.com','admin','8826909463','Male','delhi','Delhi','c-144','India','100127','1','admin','2015-01-26 16:08:20'),(7,'Ghanshyam Kumar','ghanshyam.it.kr@gmail.com','12345','9898989898','Male','New Delhi','Delhi','Testing','India','110018','1','user','2016-09-07 20:46:42'),(10,'Hemant Kumar','hemant@gmail.com','testing','9898989893','Male','testing','Bihar','testing address','India','110019','1','user','2016-10-04 21:54:21'),(11,'Pawan Kumar','pawan12@gmail.com','1234','9098787677','Male','testing','Andaman and Nicobar Islands','testing','India','1234','1','user','2016-10-11 21:09:19'),(19,'Priyanka','info@ankuarvibhu.com','123456','7820866619','Male','delhi','Kerala','ghgduydf','India','123456','1','user','2017-03-25 11:16:55'),(23,'Pawan Bansal','pawan@gmail.com','12345','9899999999','Male','delhi','Dadra and Nagar Haveli','testing 123','India','110016','1','user','2017-03-27 12:34:22');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;

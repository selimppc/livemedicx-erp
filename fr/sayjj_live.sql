/*
SQLyog Ultimate v8.55 
MySQL - 5.5.32 : Database - ur
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`ur` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `ur`;

/*Table structure for table `am_apalc` */

DROP TABLE IF EXISTS `am_apalc`;

CREATE TABLE `am_apalc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `am_vouchernumber` varchar(50) DEFAULT NULL,
  `am_invnumber` varchar(20) DEFAULT NULL,
  `am_currency` varchar(20) DEFAULT NULL,
  `am_exchagerate` decimal(20,2) DEFAULT NULL,
  `am_primeamt` decimal(20,2) DEFAULT NULL,
  `am_amount` decimal(20,2) DEFAULT NULL,
  `inserttime` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `insertuser` varchar(20) DEFAULT NULL,
  `updateuser` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `am_vouchernumber` (`am_vouchernumber`,`am_invnumber`),
  CONSTRAINT `am_apalc_ibfk_1` FOREIGN KEY (`am_vouchernumber`) REFERENCES `am_vouhcerheader` (`am_vouchernumber`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

/*Data for the table `am_apalc` */

insert  into `am_apalc`(`id`,`am_vouchernumber`,`am_invnumber`,`am_currency`,`am_exchagerate`,`am_primeamt`,`am_amount`,`inserttime`,`updatetime`,`insertuser`,`updateuser`) values (13,'APV-14000001','INVC14000001','BUR','1.00','750.00','750.00','2014-04-29 12:15:00',NULL,'admin',NULL),(14,'APV-14000003','INVC14000002','BUR','1.00','1201.92','1201.92','2014-04-29 13:14:00',NULL,'admin',NULL);

/*Table structure for table `am_balance` */

DROP TABLE IF EXISTS `am_balance`;

CREATE TABLE `am_balance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `c_vouchernumber` varchar(50) NOT NULL,
  `c_accountcode` varchar(50) NOT NULL,
  `c_subacc` varchar(50) DEFAULT NULL,
  `c_date` date DEFAULT NULL,
  `c_branch` varchar(50) DEFAULT NULL,
  `c_referance` varchar(50) DEFAULT NULL,
  `c_year` int(11) DEFAULT NULL,
  `c_period` int(11) DEFAULT NULL,
  `c_currency` varchar(50) DEFAULT NULL,
  `c_exchagerate` decimal(20,2) DEFAULT NULL,
  `c_primeamt` decimal(20,2) DEFAULT NULL,
  `c_baseamt` decimal(20,2) DEFAULT NULL,
  `c_status` varchar(50) DEFAULT NULL,
  `inserttime` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `insertuser` varchar(50) DEFAULT NULL,
  `updateuser` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `c_vouchernumber` (`c_vouchernumber`,`c_accountcode`),
  KEY `c_accountcode` (`c_accountcode`),
  CONSTRAINT `am_balance_ibfk_1` FOREIGN KEY (`c_vouchernumber`) REFERENCES `am_vouhcerheader` (`am_vouchernumber`),
  CONSTRAINT `am_balance_ibfk_2` FOREIGN KEY (`c_accountcode`) REFERENCES `am_chartofaccounts` (`am_accountcode`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

/*Data for the table `am_balance` */

insert  into `am_balance`(`id`,`c_vouchernumber`,`c_accountcode`,`c_subacc`,`c_date`,`c_branch`,`c_referance`,`c_year`,`c_period`,`c_currency`,`c_exchagerate`,`c_primeamt`,`c_baseamt`,`c_status`,`inserttime`,`updatetime`,`insertuser`,`updateuser`) values (1,'INVC14000001','13100','','2014-04-29','BURUNDI','Invoiced for GRN number GRN-14000001',2013,10,'BUR','1.00','100.00','100.00','Post','2014-05-11 08:41:05',NULL,'admin',NULL),(2,'INVC14000001','13101','','2014-04-29','BURUNDI','Invoiced for GRN number GRN-14000001',2013,10,'BUR','1.00','680.00','680.00','Post','2014-05-11 08:41:05',NULL,'admin',NULL),(3,'INVC14000001','20101','','2014-04-29','BURUNDI','Invoiced for GRN number GRN-14000001',2013,10,'BUR','1.00','-30.00','-30.00','Post','2014-05-11 08:41:05',NULL,'admin',NULL),(4,'INVC14000001','21000','SUP00001','2014-04-29','BURUNDI','Invoiced for GRN number GRN-14000001',2013,10,'BUR','1.00','-750.00','-750.00','Post','2014-05-11 08:41:05',NULL,'admin',NULL),(5,'APV-14000001','10600','','2014-04-29','BURUNDI',NULL,2013,10,'BUR','1.00','-750.00','-750.00','Post','2014-05-11 08:41:05',NULL,'admin',NULL),(6,'APV-14000001','21000','SUP00001','2014-04-29','BURUNDI',NULL,2013,10,'BUR','1.00','750.00','750.00','Post','2014-05-11 08:41:05',NULL,'admin',NULL),(7,'INVC14000002','13101','','2014-04-29','BURUNDI','Invoiced for GRN number GRN-14000004',2013,10,'BUR','1.00','1250.00','1250.00','Post','2014-05-11 08:41:05',NULL,'admin',NULL),(8,'INVC14000002','20101','','2014-04-29','BURUNDI','Invoiced for GRN number GRN-14000004',2013,10,'BUR','1.00','-48.08','-48.08','Post','2014-05-11 08:41:05',NULL,'admin',NULL),(9,'INVC14000002','21000','SUP00001','2014-04-29','BURUNDI','Invoiced for GRN number GRN-14000004',2013,10,'BUR','1.00','-1201.92','-1201.92','Post','2014-05-11 08:41:05',NULL,'admin',NULL),(10,'APV-14000003','10600','','2014-04-29','BURUNDI',NULL,2013,10,'BUR','1.00','-1201.92','-1201.92','Post','2014-05-11 08:41:05',NULL,'admin',NULL),(11,'APV-14000003','21000','SUP00001','2014-04-29','BURUNDI',NULL,2013,10,'BUR','1.00','1201.92','1201.92','Post','2014-05-11 08:41:05',NULL,'admin',NULL),(12,'JV--14000001','12100','','2014-05-02','BURUNDI','This Voucher for RETAIL',2013,11,'BUR','1.00','67.98','67.98','Post','2014-05-11 08:41:05',NULL,'admin',NULL),(13,'JV--14000001','20102','','2014-05-02','BURUNDI','This Voucher for RETAIL',2013,11,'BUR','1.00','-1.98','-1.98','Post','2014-05-11 08:41:05',NULL,'admin',NULL),(14,'JV--14000001','31022','','2014-05-02','BURUNDI','This Voucher for RETAIL',2013,11,'BUR','1.00','-66.00','-66.00','Post','2014-05-11 08:41:05',NULL,'admin',NULL),(15,'IM--14000001','13100','','2014-05-02','BURUNDI','Inventory transfer',2013,11,'BUR','1.00','-60.00','-60.00','Post','2014-05-11 08:41:05',NULL,'admin',NULL),(16,'IM--14000001','41010','','2014-05-02','BURUNDI','Inventory transfer',2013,11,'BUR','1.00','60.00','60.00','Post','2014-05-11 08:41:05',NULL,'admin',NULL),(17,'MRCT14000001','10600','','2014-05-02','BURUNDI','This Voucher for RETAIL',2013,11,'BUR','1.00','67.98','67.98','Post','2014-05-11 08:41:05',NULL,'admin',NULL),(18,'MRCT14000001','12100','','2014-05-02','BURUNDI','This Voucher for RETAIL',2013,11,'BUR','1.00','-67.98','-67.98','Post','2014-05-11 08:41:05',NULL,'admin',NULL),(19,'INVC14000003','13101','','2014-05-07','GLM','Invoiced for GRN number GRN-14000006',2013,11,'KLM','1.00','0.00','0.00','Post','2014-05-11 08:41:05',NULL,'admin',NULL),(20,'INVC14000003','21000','SUP00001','2014-05-07','GLM','Invoiced for GRN number GRN-14000006',2013,11,'KLM','1.00','0.00','0.00','Post','2014-05-11 08:41:05',NULL,'admin',NULL),(22,'APV-14000006','21000','SUP00001','2014-05-07','GLM',NULL,2013,11,'','1.00','50000.00','50000.00','Post','2014-05-11 08:41:05',NULL,'admin',NULL),(23,'APV-14000006','41010','','2014-05-07','GLM',NULL,2013,11,'','1.00','-50000.00','-50000.00','Post','2014-05-11 08:41:05',NULL,'admin',NULL);

/*Table structure for table `am_chartofaccounts` */

DROP TABLE IF EXISTS `am_chartofaccounts`;

CREATE TABLE `am_chartofaccounts` (
  `am_accountcode` varchar(50) NOT NULL,
  `am_description` varchar(100) NOT NULL,
  `am_accounttype` varchar(50) DEFAULT NULL,
  `am_accountusage` varchar(50) DEFAULT NULL,
  `am_groupone` varchar(50) DEFAULT NULL,
  `am_grouptwo` varchar(50) DEFAULT NULL,
  `am_groupthree` varchar(50) DEFAULT NULL,
  `am_groupfour` varchar(50) DEFAULT NULL,
  `am_analyticalcode` varchar(10) DEFAULT NULL,
  `am_branch` varchar(50) DEFAULT NULL,
  `am_status` varchar(50) DEFAULT NULL,
  `inserttime` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `insertuser` varchar(50) DEFAULT NULL,
  `updateuser` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`am_accountcode`),
  KEY `am_description` (`am_description`,`am_accounttype`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `am_chartofaccounts` */

insert  into `am_chartofaccounts`(`am_accountcode`,`am_description`,`am_accounttype`,`am_accountusage`,`am_groupone`,`am_grouptwo`,`am_groupthree`,`am_groupfour`,`am_analyticalcode`,`am_branch`,`am_status`,`inserttime`,`updatetime`,`insertuser`,`updateuser`) values ('10100','Cash - Regular Checking','Asset','Ledger','10','0','',NULL,'Cash','','Open','2014-04-13 16:32:00','0000-00-00 00:00:00','admin',''),('10200','Cash - Payroll Checking','Asset','Ledger','10','0','',NULL,'Cash','','Open','2014-04-13 16:33:00','0000-00-00 00:00:00','admin',''),('10600','Petty Cash Fund','Asset','Ledger','10','0','',NULL,'Cash','','Open','2014-04-13 16:34:00','0000-00-00 00:00:00','admin',''),('12100','Accounts Receivable','Asset','AR','10','','',NULL,'Non-Cash','','Open','2014-04-13 16:35:00','2014-04-13 16:40:00','admin','admin'),('12500','Allowance for Doubtful Accounts','Asset','Ledger','10','0','',NULL,'Non-Cash','','Open','2014-04-13 16:36:00','0000-00-00 00:00:00','admin',''),('13100','Inventory Document 1','Asset','Ledger','10','','',NULL,'Non-Cash','','Open','2014-04-13 16:37:00','2014-04-16 12:19:00','admin','admin'),('13101','Inventory Document 2','Asset','Ledger','10','0','',NULL,'Non-Cash','','Open','2014-04-16 12:20:00','0000-00-00 00:00:00','admin',''),('14100','Supplies','Asset','Ledger','10','0','',NULL,'Non-Cash','','Open','2014-04-13 16:37:00','0000-00-00 00:00:00','admin',''),('15300','Prepaid Insurance','Asset','Ledger','10','0','',NULL,'Non-Cash','','Open','2014-04-13 16:38:00','0000-00-00 00:00:00','admin',''),('17000','Land','Asset','Ledger','17','0','',NULL,'Non-Cash','','Open','2014-04-13 16:39:00','0000-00-00 00:00:00','admin',''),('17100','Buildings','Asset','Ledger','17','0','',NULL,'Non-Cash','','Open','2014-04-13 16:40:00','0000-00-00 00:00:00','admin',''),('17300','Equipment','Asset','Ledger','17','0','',NULL,'Non-Cash','','Open','2014-04-13 16:41:00','0000-00-00 00:00:00','admin',''),('17800','Vehicles','Asset','Ledger','17','0','',NULL,'Non-Cash','','Open','2014-04-13 16:42:00','0000-00-00 00:00:00','admin',''),('18100','Accumulated Depreciation - Buildings','Asset','Ledger','17','0','',NULL,'Non-Cash','','Open','2014-04-13 16:43:00','0000-00-00 00:00:00','admin',''),('18300',' Accumulated Depreciation - Equipment','Asset','Ledger','17','0','',NULL,'Non-Cash','','Open','2014-04-13 16:43:00','0000-00-00 00:00:00','admin',''),('18800','Accumulated Depreciation - Vehicles','Asset','Ledger','17','0','',NULL,'Non-Cash','','Open','2014-04-13 16:44:00','0000-00-00 00:00:00','admin',''),('20100','Notes Payable - Credit Line #1','Liability','Ledger','20','0','',NULL,'Non-Cash','','Open','2014-04-13 16:45:00','2014-04-13 16:46:00','admin','admin'),('20101','Purchase Tax','Liability','Ledger','20','0','',NULL,'Non-Cash','','Open','2014-04-16 09:34:00','0000-00-00 00:00:00','admin',''),('20102','Sale Tax','Liability','Ledger','20','0','',NULL,'Non-Cash','BURUNDI','Open','2014-04-20 06:21:00','0000-00-00 00:00:00','admin',''),('20200','Notes Payable - Credit Line #2','Liability','Ledger','20','0','',NULL,'Non-Cash','','Open','2014-04-13 16:47:00','0000-00-00 00:00:00','admin',''),('20201','Profit & Loss Acount','Liability','Ledger','20','0','',NULL,'Non-Cash','','Open','2014-04-13 17:30:00','0000-00-00 00:00:00','admin',''),('21000','Accounts Payable','Liability','AP','20','0','',NULL,'Non-Cash','','Open','2014-04-13 16:47:00','0000-00-00 00:00:00','admin',''),('22100','Wages Payable','Liability','Ledger','20','0','',NULL,'Non-Cash','','Open','2014-04-13 16:48:00','0000-00-00 00:00:00','admin',''),('23100','Interest Payable','Liability','Ledger','20','0','',NULL,'Non-Cash','','Open','2014-04-13 16:48:00','0000-00-00 00:00:00','admin',''),('24500','Unearned Revenues','Liability','Ledger','20','0','',NULL,'Non-Cash','','Open','2014-04-13 16:49:00','0000-00-00 00:00:00','admin',''),('25100','Mortgage Loan Payable','Liability','Ledger','25','0','',NULL,'Non-Cash','','Open','2014-04-13 16:49:00','0000-00-00 00:00:00','admin',''),('25600','Bonds Payable','Liability','Ledger','25','0','',NULL,'Non-Cash','','Open','2014-04-13 16:50:00','0000-00-00 00:00:00','admin',''),('25650','Discount on Bonds Payable','Liability','Ledger','25','0','',NULL,'Non-Cash','','Open','2014-04-13 16:50:00','0000-00-00 00:00:00','admin',''),('27100','Common Stock, No Par','Liability','Ledger','27','0','',NULL,'Non-Cash','','Open','2014-04-13 16:51:00','0000-00-00 00:00:00','admin',''),('27500','Retained Earnings','Income','Ledger','27','','',NULL,'Non-Cash','','Open','2014-04-13 16:53:00','2014-04-17 05:19:00','admin','admin'),('29500','Treasury Stock','Liability','Ledger','27','0','',NULL,'Non-Cash','','Open','2014-04-13 16:53:00','0000-00-00 00:00:00','admin',''),('31010','Sales - Division #1, Product Line 010','Income','Ledger','30','0','',NULL,'Non-Cash','','Open','2014-04-13 16:54:00','0000-00-00 00:00:00','admin',''),('31022','Sales - Division #1, Product Line 022','Income','Ledger','30','0','',NULL,'Non-Cash','','Open','2014-04-13 16:55:00','0000-00-00 00:00:00','admin',''),('32015','Sales - Division #2, Product Line 015','Income','Ledger','30','0','',NULL,'Non-Cash','','Open','2014-04-13 16:55:00','0000-00-00 00:00:00','admin',''),('33110','Sales - Division #3, Product Line 110','Income','Ledger','30','0','',NULL,'Non-Cash','','Open','2014-04-13 16:57:00','0000-00-00 00:00:00','admin',''),('40001','Sales Discount','Expenses','Ledger','50','','',NULL,'Non-Cash','BURUNDI','Open','2014-04-20 06:20:00','2014-04-20 06:22:00','admin','admin'),('41010','COGS - Division #1, Product Line 010','Expenses','Ledger','40','0','',NULL,'Non-Cash','','Open','2014-04-13 16:57:00','0000-00-00 00:00:00','admin',''),('41022','COGS - Division #1, Product Line 022','Expenses','Ledger','40','0','',NULL,'Non-Cash','','Open','2014-04-13 16:59:00','0000-00-00 00:00:00','admin',''),('42015','COGS - Division #2, Product Line 015','','Ledger','40','0','',NULL,'Non-Cash','','Open','2014-04-13 17:00:00','0000-00-00 00:00:00','admin',''),('50100','Marketing Dept. Salaries','Expenses','Ledger','50','0','',NULL,'Non-Cash','','Open','2014-04-13 17:00:00','0000-00-00 00:00:00','admin',''),('50150','Marketing Dept. Payroll Taxes','Expenses','Ledger','50','0','',NULL,'Non-Cash','','Open','2014-04-13 17:01:00','0000-00-00 00:00:00','admin',''),('50200','Marketing Dept. Supplies','Expenses','Ledger','50','0','',NULL,'Non-Cash','','Open','2014-04-13 17:01:00','0000-00-00 00:00:00','admin',''),('50600','Marketing Dept. Telephone','Expenses','Ledger','50','0','',NULL,'Non-Cash','','Open','2014-04-13 17:02:00','0000-00-00 00:00:00','admin',''),('59100','Payroll Dept. Salaries','Expenses','Ledger','59','0','',NULL,'Non-Cash','','Open','2014-04-13 17:02:00','0000-00-00 00:00:00','admin',''),('59150','Payroll Dept. Payroll Taxes','Expenses','Ledger','59','0','',NULL,'Non-Cash','','Open','2014-04-13 17:03:00','0000-00-00 00:00:00','admin',''),('59200','Payroll Dept. Supplies','Expenses','Ledger','59','0','',NULL,'Non-Cash','','Open','2014-04-13 17:03:00','0000-00-00 00:00:00','admin',''),('59600','Payroll Dept. Telephone','Expenses','Ledger','59','0','',NULL,'Non-Cash','','Open','2014-04-13 17:04:00','0000-00-00 00:00:00','admin','');

/*Table structure for table `am_default` */

DROP TABLE IF EXISTS `am_default`;

CREATE TABLE `am_default` (
  `id` int(11) NOT NULL,
  `am_offset` int(11) DEFAULT NULL,
  `am_pnlacount` varchar(50) DEFAULT NULL,
  `am_year` int(11) DEFAULT NULL,
  `am_period` int(11) DEFAULT NULL,
  `inserttime` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `insertuser` varchar(50) DEFAULT NULL,
  `updateuser` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `am_default` */

insert  into `am_default`(`id`,`am_offset`,`am_pnlacount`,`am_year`,`am_period`,`inserttime`,`updatetime`,`insertuser`,`updateuser`) values (1,6,'20201',2014,1,'2014-01-01 12:23:00',NULL,'admin',NULL);

/*Table structure for table `am_group_four` */

DROP TABLE IF EXISTS `am_group_four`;

CREATE TABLE `am_group_four` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `am_groupone` varchar(50) DEFAULT NULL,
  `am_grouptwo` varchar(50) DEFAULT NULL,
  `am_groupthree` varchar(50) DEFAULT NULL,
  `am_groupfour` varchar(50) DEFAULT NULL,
  `am_description` varchar(50) DEFAULT NULL,
  `inserttime` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `insertuser` varchar(50) DEFAULT NULL,
  `updateuser` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `am_groupone` (`am_groupone`,`am_grouptwo`,`am_groupthree`,`am_groupfour`),
  CONSTRAINT `am_group_four_ibfk_1` FOREIGN KEY (`am_groupone`, `am_grouptwo`, `am_groupthree`) REFERENCES `am_group_three` (`am_groupone`, `am_grouptwo`, `am_groupthree`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `am_group_four` */

/*Table structure for table `am_group_one` */

DROP TABLE IF EXISTS `am_group_one`;

CREATE TABLE `am_group_one` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `am_groupone` varchar(50) DEFAULT NULL,
  `am_description` varchar(50) DEFAULT NULL,
  `inserttime` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `insertuser` varchar(50) DEFAULT NULL,
  `updateuser` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `am_groupone` (`am_groupone`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

/*Data for the table `am_group_one` */

insert  into `am_group_one`(`id`,`am_groupone`,`am_description`,`inserttime`,`updatetime`,`insertuser`,`updateuser`) values (11,'10','Current Assets','2014-04-13 16:28:00','0000-00-00 00:00:00','admin',''),(12,'17','Property, Plant, and Equipment','2014-04-13 16:29:00','0000-00-00 00:00:00','admin',''),(13,'20','Current Liabilities','2014-04-13 16:30:00','0000-00-00 00:00:00','admin',''),(14,'25','Long-term Liabilities','2014-04-13 16:30:00','0000-00-00 00:00:00','admin',''),(15,'27','Stockholders\' Equity','2014-04-13 16:30:00','0000-00-00 00:00:00','admin',''),(16,'30','Operating Revenues','2014-04-13 16:31:00','0000-00-00 00:00:00','admin',''),(17,'40','Cost of Goods Sold','2014-04-13 16:31:00','0000-00-00 00:00:00','admin',''),(18,'50','Marketing Expenses','2014-04-13 16:31:00','0000-00-00 00:00:00','admin',''),(19,'59','Payroll Dept. Expenses','2014-04-13 16:32:00','0000-00-00 00:00:00','admin',''),(20,'90','Other','2014-04-13 16:32:00','0000-00-00 00:00:00','admin','');

/*Table structure for table `am_group_three` */

DROP TABLE IF EXISTS `am_group_three`;

CREATE TABLE `am_group_three` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `am_groupone` varchar(50) DEFAULT NULL,
  `am_grouptwo` varchar(50) DEFAULT NULL,
  `am_groupthree` varchar(50) DEFAULT NULL,
  `am_description` varchar(50) DEFAULT NULL,
  `inserttime` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `insertuser` varchar(50) DEFAULT NULL,
  `updateuser` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `am_groupone` (`am_groupone`,`am_grouptwo`,`am_groupthree`),
  CONSTRAINT `am_group_three_ibfk_1` FOREIGN KEY (`am_groupone`, `am_grouptwo`) REFERENCES `am_group_two` (`am_groupone`, `am_grouptwo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `am_group_three` */

insert  into `am_group_three`(`id`,`am_groupone`,`am_grouptwo`,`am_groupthree`,`am_description`,`inserttime`,`updatetime`,`insertuser`,`updateuser`) values (1,'10','10.2','10.3','ten point three',NULL,NULL,NULL,NULL);

/*Table structure for table `am_group_two` */

DROP TABLE IF EXISTS `am_group_two`;

CREATE TABLE `am_group_two` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `am_groupone` varchar(50) DEFAULT NULL,
  `am_grouptwo` varchar(50) DEFAULT NULL,
  `am_description` varchar(50) DEFAULT NULL,
  `inserttime` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `insertuser` varchar(50) DEFAULT NULL,
  `updateuser` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `am_groupone` (`am_groupone`,`am_grouptwo`),
  CONSTRAINT `am_group_two_ibfk_1` FOREIGN KEY (`am_groupone`) REFERENCES `am_group_one` (`am_groupone`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `am_group_two` */

insert  into `am_group_two`(`id`,`am_groupone`,`am_grouptwo`,`am_description`,`inserttime`,`updatetime`,`insertuser`,`updateuser`) values (1,'10','10.2','ten point two',NULL,NULL,NULL,NULL);

/*Table structure for table `am_voucherdetail` */

DROP TABLE IF EXISTS `am_voucherdetail`;

CREATE TABLE `am_voucherdetail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `am_vouchernumber` varchar(50) NOT NULL,
  `am_accountcode` varchar(50) NOT NULL,
  `am_subacccode` varchar(50) NOT NULL,
  `am_currency` varchar(10) DEFAULT NULL,
  `am_exchagerate` decimal(20,2) DEFAULT NULL,
  `am_primeamt` decimal(20,2) DEFAULT NULL,
  `am_baseamt` decimal(20,2) DEFAULT NULL,
  `am_branch` varchar(50) DEFAULT NULL,
  `am_note` varchar(255) DEFAULT NULL,
  `inserttime` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `insertuser` varchar(50) DEFAULT NULL,
  `updateuser` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `am_vouchernumber` (`am_vouchernumber`,`am_accountcode`),
  KEY `am_accountcode` (`am_accountcode`),
  CONSTRAINT `am_voucherdetail_ibfk_2` FOREIGN KEY (`am_accountcode`) REFERENCES `am_chartofaccounts` (`am_accountcode`),
  CONSTRAINT `am_voucherdetail_ibfk_1` FOREIGN KEY (`am_vouchernumber`) REFERENCES `am_vouhcerheader` (`am_vouchernumber`)
) ENGINE=InnoDB AUTO_INCREMENT=160 DEFAULT CHARSET=utf8;

/*Data for the table `am_voucherdetail` */

insert  into `am_voucherdetail`(`id`,`am_vouchernumber`,`am_accountcode`,`am_subacccode`,`am_currency`,`am_exchagerate`,`am_primeamt`,`am_baseamt`,`am_branch`,`am_note`,`inserttime`,`updatetime`,`insertuser`,`updateuser`) values (135,'INVC14000001','13100','','BUR','1.00','100.00','100.00','BURUNDI','Inventory Debit automatic','2014-04-29 14:13:24',NULL,'admin',NULL),(136,'INVC14000001','13101','','BUR','1.00','680.00','680.00','BURUNDI','Inventory Debit automatic','2014-04-29 14:13:24',NULL,'admin',NULL),(137,'INVC14000001','21000','SUP00001','BUR','1.00','-750.00','-750.00','BURUNDI','Inventory Credit automatic','2014-04-29 14:13:24',NULL,'admin',NULL),(138,'INVC14000001','20101','','BUR','1.00','-30.00','-30.00','BURUNDI','Inventory Credit automatic','2014-04-29 14:13:24',NULL,'admin',NULL),(139,'APV-14000001','10600','','BUR','1.00','-750.00','-750.00',NULL,NULL,'2014-04-29 12:15:00',NULL,'admin',NULL),(140,'APV-14000001','21000','SUP00001','BUR','1.00','750.00','750.00',NULL,NULL,'2014-04-29 12:15:00',NULL,'admin',NULL),(141,'INVC14000002','13101','','BUR','1.00','1250.00','1250.00','BURUNDI','Inventory Debit automatic','2014-04-29 15:13:46',NULL,'admin',NULL),(142,'INVC14000002','21000','SUP00001','BUR','1.00','-1201.92','-1201.92','BURUNDI','Inventory Credit automatic','2014-04-29 15:13:46',NULL,'admin',NULL),(143,'INVC14000002','20101','','BUR','1.00','-48.08','-48.08','BURUNDI','Inventory Credit automatic','2014-04-29 15:13:46',NULL,'admin',NULL),(144,'APV-14000003','10600','','BUR','1.00','-1201.92','-1201.92',NULL,NULL,'2014-04-29 13:14:00',NULL,'admin',NULL),(145,'APV-14000003','21000','SUP00001','BUR','1.00','1201.92','1201.92',NULL,NULL,'2014-04-29 13:14:00',NULL,'admin',NULL),(146,'JV--14000001','12100','','BUR','1.00','67.98','67.98','BURUNDI','Account Receivable','2014-05-02 15:05:07',NULL,'admin',NULL),(147,'JV--14000001','20102','','BUR','1.00','-1.98','-1.98','BURUNDI','Tax','2014-05-02 15:05:07',NULL,'admin',NULL),(148,'JV--14000001','31022','','BUR','1.00','-66.00','-66.00','BURUNDI','Sales by HEART MEDICINE','2014-05-02 15:05:07',NULL,'admin',NULL),(149,'IM--14000001','41010','','BUR','1.00','60.00','60.00','BURUNDI','HEART MEDICINE','2014-05-02 15:07:32',NULL,'admin',NULL),(150,'IM--14000001','13100','','BUR','1.00','-60.00','-60.00','BURUNDI','HEART MEDICINE','2014-05-02 15:07:32',NULL,'admin',NULL),(151,'MRCT14000001','10600','','BUR','1.00','67.98','67.98','BURUNDI','Cash/Bank','2014-05-02 15:17:22',NULL,'admin',NULL),(152,'MRCT14000001','12100','','BUR','1.00','-67.98','-67.98','BURUNDI','Account Receivable','2014-05-02 15:17:22',NULL,'admin',NULL),(153,'INVC14000003','13101','','KLM','1.00','0.00','0.00','GLM','Inventory Debit automatic','2014-05-07 17:24:03',NULL,'admin',NULL),(154,'INVC14000003','21000','SUP00001','KLM','1.00','0.00','0.00','GLM','Inventory Credit automatic','2014-05-07 17:24:03',NULL,'admin',NULL),(155,'INVC14000004','21000','SUP00001',NULL,NULL,'0.00',NULL,NULL,'Inventory Credit automatic','2014-05-07 17:24:07',NULL,'admin',NULL),(156,'APV-14000006','41010','','','0.00','-50000.00','0.00',NULL,NULL,'2014-05-07 15:25:00',NULL,'admin',NULL),(157,'APV-14000006','21000','SUP00001','','0.00','50000.00','0.00',NULL,NULL,'2014-05-07 15:25:00',NULL,'admin',NULL),(158,'JV--14000002','10600','','BUR','1.00','2000.00','2000.00',NULL,'','2014-05-20 04:01:00',NULL,'admin',NULL),(159,'JV--14000002','31010','','BUR','1.00','-2000.00','-2000.00',NULL,'','2014-05-20 04:01:00',NULL,'admin',NULL);

/*Table structure for table `am_vouhcerheader` */

DROP TABLE IF EXISTS `am_vouhcerheader`;

CREATE TABLE `am_vouhcerheader` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `am_vouchernumber` varchar(50) NOT NULL,
  `am_date` date DEFAULT NULL,
  `am_referance` varchar(150) DEFAULT NULL,
  `am_year` int(11) DEFAULT NULL,
  `am_period` int(11) DEFAULT NULL,
  `am_branch` varchar(50) DEFAULT NULL,
  `am_note` varchar(255) DEFAULT NULL,
  `am_status` varchar(20) DEFAULT NULL,
  `inserttime` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `insertuser` varchar(50) DEFAULT NULL,
  `updateuser` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `am_vouchernumber` (`am_vouchernumber`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8;

/*Data for the table `am_vouhcerheader` */

insert  into `am_vouhcerheader`(`id`,`am_vouchernumber`,`am_date`,`am_referance`,`am_year`,`am_period`,`am_branch`,`am_note`,`am_status`,`inserttime`,`updatetime`,`insertuser`,`updateuser`) values (49,'INVC14000001','2014-04-29','Invoiced for GRN number GRN-14000001',2013,10,'BURUNDI','This invoice automatic create from GRN','Balanced','2014-04-29 14:13:24',NULL,'admin',NULL),(50,'APV-14000001','2014-04-29',NULL,2013,10,'BURUNDI','','Balanced','2014-04-29 12:15:00','0000-00-00 00:00:00','admin',''),(51,'INVC14000002','2014-04-29','Invoiced for GRN number GRN-14000004',2013,10,'BURUNDI','This invoice automatic create from GRN','Balanced','2014-04-29 15:13:46',NULL,'admin',NULL),(52,'APV-14000003','2014-04-29',NULL,2013,10,'BURUNDI','','Balanced','2014-04-29 13:14:00','0000-00-00 00:00:00','admin',''),(53,'JV--14000001','2014-05-02','This Voucher for RETAIL',2013,11,'BURUNDI','This invoice automatic create from Sales Invoice','Balanced','2014-05-02 15:05:07',NULL,'admin',NULL),(54,'IM--14000001','2014-05-02','Inventory transfer',2013,11,'BURUNDI','All DO--From 2014-05-02 To 2014-05-02','Balanced','2014-05-02 15:07:32',NULL,'admin',NULL),(55,'MRCT14000001','2014-05-02','This Voucher for RETAIL',2013,11,'BURUNDI','This is Money Receipt','Balanced','2014-05-02 15:17:22',NULL,'admin',NULL),(56,'INVC14000003','2014-05-07','Invoiced for GRN number GRN-14000006',2013,11,'GLM','This invoice automatic create from GRN','Balanced','2014-05-07 17:24:03',NULL,'admin',NULL),(57,'INVC14000004','2014-05-07',NULL,2013,11,NULL,'This invoice automatic create from GRN','Balanced','2014-05-07 17:24:07',NULL,'admin',NULL),(58,'APV-14000006','2014-05-07',NULL,2013,11,'xxxx','','Balanced','2014-05-07 15:25:00','0000-00-00 00:00:00','admin',''),(61,'JV--14000002','2014-05-20','0',2013,11,'BURUNDI','','Balanced','2014-05-20 04:01:00','0000-00-00 00:00:00','admin','');

/*Table structure for table `authassignment` */

DROP TABLE IF EXISTS `authassignment`;

CREATE TABLE `authassignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`),
  CONSTRAINT `authassignment_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `authassignment` */

insert  into `authassignment`(`itemname`,`userid`,`bizrule`,`data`) values ('admin','1',NULL,NULL),('Operator ','2',NULL,'N;'),('Operator ','3',NULL,'N;'),('Operator ','9',NULL,'N;');

/*Table structure for table `authitem` */

DROP TABLE IF EXISTS `authitem`;

CREATE TABLE `authitem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `authitem` */

insert  into `authitem`(`name`,`type`,`description`,`bizrule`,`data`) values ('admin',1,NULL,NULL,NULL),('Batchtransfer.Admin',0,NULL,NULL,'N;'),('Batchtransfer.Create',0,NULL,NULL,'N;'),('Batchtransfer.View',0,NULL,NULL,'N;'),('Branchcurrency.Admin',0,NULL,NULL,'N;'),('Branchcurrency.Create',0,NULL,NULL,'N;'),('Branchcurrency.View',0,NULL,NULL,'N;'),('Branchmaster.Admin',0,NULL,NULL,'N;'),('Branchmaster.Create',0,NULL,NULL,'N;'),('Branchmaster.View',0,NULL,NULL,'N;'),('Codesparam.Admin',0,NULL,NULL,'N;'),('Codesparam.Create',0,NULL,NULL,'N;'),('Codesparam.View',0,NULL,NULL,'N;'),('Codesparam.ViewCurrency',0,NULL,NULL,'N;'),('Codesparam.ViewSm',0,NULL,NULL,'N;'),('Companyprofile.View',0,NULL,NULL,'N;'),('Grndetail.Admin',0,NULL,NULL,'N;'),('Grndetail.Create',0,NULL,NULL,'N;'),('Grndetail.View',0,NULL,NULL,'N;'),('Imtransaction.Admin',0,NULL,NULL,'N;'),('Imtransaction.Create',0,NULL,NULL,'N;'),('Imtransaction.View',0,NULL,NULL,'N;'),('Operator ',2,NULL,NULL,'N;'),('Productmaster.Admin',0,NULL,NULL,'N;'),('Productmaster.Create',0,NULL,NULL,'N;'),('Productmaster.View',0,NULL,NULL,'N;'),('Purchaseorddt.Admin',0,NULL,NULL,'N;'),('Purchaseorddt.Create',0,NULL,NULL,'N;'),('Purchaseorddt.View',0,NULL,NULL,'N;'),('Purchaseordhd.Admin',0,NULL,NULL,'N;'),('Purchaseordhd.Create',0,NULL,NULL,'N;'),('Purchaseordhd.CreateGRN',0,NULL,NULL,'N;'),('Purchaseordhd.View',0,NULL,NULL,'N;'),('Purchaseordhd.ViewGrn',0,NULL,NULL,'N;'),('Purchaseordhd.ViewPurchaseOrderHd',0,NULL,NULL,'N;'),('Requisitiondt.Admin',0,NULL,NULL,'N;'),('Requisitiondt.Create',0,NULL,NULL,'N;'),('Requisitiondt.View',0,NULL,NULL,'N;'),('Requisitionhd.Admin',0,NULL,NULL,'N;'),('Requisitionhd.Create',0,NULL,NULL,'N;'),('Requisitionhd.View',0,NULL,NULL,'N;'),('Site.Login',0,NULL,NULL,'N;'),('Site.Logout',0,NULL,NULL,'N;'),('Suppliermaster.Admin',0,NULL,NULL,'N;'),('Suppliermaster.Create',0,NULL,NULL,'N;'),('Suppliermaster.View',0,NULL,NULL,'N;'),('Transaction.Admin',0,NULL,NULL,'N;'),('Transaction.Create',0,NULL,NULL,'N;'),('Transaction.View',0,NULL,NULL,'N;'),('Transferdt.Admin',0,NULL,NULL,'N;'),('Transferdt.Create',0,NULL,NULL,'N;'),('Transferdt.View',0,NULL,NULL,'N;'),('Transferhd.Admin',0,NULL,NULL,'N;'),('Transferhd.Create',0,NULL,NULL,'N;'),('Transferhd.View',0,NULL,NULL,'N;'),('User.Admin.View',0,NULL,NULL,'N;'),('User.Profile.Changepassword',0,NULL,NULL,'N;'),('User.ProfileField.View',0,NULL,NULL,'N;'),('VwStock.Admin',0,NULL,NULL,'N;');

/*Table structure for table `authitemchild` */

DROP TABLE IF EXISTS `authitemchild`;

CREATE TABLE `authitemchild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `authitemchild_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `authitemchild_ibfk_2` FOREIGN KEY (`child`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `authitemchild` */

insert  into `authitemchild`(`parent`,`child`) values ('admin','admin'),('Operator ','Batchtransfer.Admin'),('Operator ','Batchtransfer.Create'),('Operator ','Batchtransfer.View'),('Operator ','Branchcurrency.Admin'),('Operator ','Branchcurrency.Create'),('Operator ','Branchcurrency.View'),('Operator ','Branchmaster.Admin'),('Operator ','Branchmaster.Create'),('Operator ','Branchmaster.View'),('Operator ','Codesparam.Admin'),('Operator ','Codesparam.Create'),('Operator ','Codesparam.View'),('Operator ','Codesparam.ViewCurrency'),('Operator ','Codesparam.ViewSm'),('Operator ','Companyprofile.View'),('Operator ','Grndetail.Admin'),('Operator ','Grndetail.Create'),('Operator ','Grndetail.View'),('Operator ','Imtransaction.Admin'),('Operator ','Imtransaction.Create'),('Operator ','Imtransaction.View'),('Operator ','Productmaster.Admin'),('Operator ','Productmaster.Create'),('Operator ','Productmaster.View'),('Operator ','Purchaseorddt.Admin'),('Operator ','Purchaseorddt.Create'),('Operator ','Purchaseorddt.View'),('Operator ','Purchaseordhd.Admin'),('Operator ','Purchaseordhd.Create'),('Operator ','Purchaseordhd.CreateGRN'),('Operator ','Purchaseordhd.View'),('Operator ','Purchaseordhd.ViewGrn'),('Operator ','Purchaseordhd.ViewPurchaseOrderHd'),('Operator ','Requisitiondt.Admin'),('Operator ','Requisitiondt.Create'),('Operator ','Requisitiondt.View'),('Operator ','Requisitionhd.Admin'),('Operator ','Requisitionhd.Create'),('Operator ','Requisitionhd.View'),('Operator ','Site.Login'),('Operator ','Site.Logout'),('Operator ','Suppliermaster.Admin'),('Operator ','Suppliermaster.Create'),('Operator ','Suppliermaster.View'),('Operator ','Transaction.Admin'),('Operator ','Transaction.Create'),('Operator ','Transaction.View'),('Operator ','Transferdt.Admin'),('Operator ','Transferdt.Create'),('Operator ','Transferdt.View'),('Operator ','Transferhd.Admin'),('Operator ','Transferhd.Create'),('Operator ','Transferhd.View'),('Operator ','User.Admin.View'),('Operator ','User.Profile.Changepassword'),('Operator ','User.ProfileField.View'),('Operator ','VwStock.Admin');

/*Table structure for table `cm_branchcurrency` */

DROP TABLE IF EXISTS `cm_branchcurrency`;

CREATE TABLE `cm_branchcurrency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cm_branch` varchar(50) DEFAULT NULL,
  `cm_currency` varchar(10) DEFAULT NULL,
  `cm_description` varchar(100) DEFAULT NULL,
  `cm_exchangerate` decimal(20,2) DEFAULT NULL,
  `cm_active` int(11) DEFAULT NULL,
  `inserttime` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `insertuser` varchar(50) DEFAULT NULL,
  `updateuser` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cm_branch` (`cm_branch`,`cm_currency`),
  CONSTRAINT `cm_branchcurrency_ibfk_1` FOREIGN KEY (`cm_branch`) REFERENCES `cm_branchmaster` (`cm_branch`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*Data for the table `cm_branchcurrency` */

insert  into `cm_branchcurrency`(`id`,`cm_branch`,`cm_currency`,`cm_description`,`cm_exchangerate`,`cm_active`,`inserttime`,`updatetime`,`insertuser`,`updateuser`) values (10,'HE','','','0.00',1,'2014-01-03 11:33:00','0000-00-00 00:00:00','admin',''),(11,'GLM','BDT','','12.00',1,'2014-01-06 07:53:00','0000-00-00 00:00:00','admin',''),(12,'GLM','KLM','','1.00',1,'2014-04-13 04:02:00','0000-00-00 00:00:00','admin',''),(13,'BURUNDI','BUR','1','1.00',1,'2014-04-13 04:03:00','2014-04-13 04:03:00','admin','admin'),(14,'BURUNDI','KLM','','2.30',1,'2014-04-13 04:04:00','0000-00-00 00:00:00','admin',''),(15,'RWANDA','KLM','','1.00',1,'2014-04-21 04:45:00','0000-00-00 00:00:00','admin',''),(16,'RWANDA','BUR','','2.12',1,'2014-04-21 04:45:00','0000-00-00 00:00:00','admin','');

/*Table structure for table `cm_branchmaster` */

DROP TABLE IF EXISTS `cm_branchmaster`;

CREATE TABLE `cm_branchmaster` (
  `cm_branch` varchar(50) NOT NULL,
  `cm_description` varchar(100) DEFAULT NULL,
  `cm_currency` varchar(50) DEFAULT NULL,
  `cm_contacperson` varchar(50) DEFAULT NULL,
  `cm_designation` varchar(50) DEFAULT NULL,
  `cm_mailingaddress` varchar(250) DEFAULT NULL,
  `cm_phone` varchar(10) DEFAULT NULL,
  `cm_cell` varchar(10) DEFAULT NULL,
  `cm_fax` varchar(10) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  `inserttime` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `insertuser` varchar(50) DEFAULT NULL,
  `updateuser` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cm_branch`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cm_branchmaster` */

insert  into `cm_branchmaster`(`cm_branch`,`cm_description`,`cm_currency`,`cm_contacperson`,`cm_designation`,`cm_mailingaddress`,`cm_phone`,`cm_cell`,`cm_fax`,`active`,`inserttime`,`updatetime`,`insertuser`,`updateuser`) values ('BURUNDI','Burundi ','BUR','','','','','','',1,'2014-01-03 10:08:00','0000-00-00 00:00:00','admin',''),('Chittagong','China','BDT','','','','','','',1,'2014-01-05 09:44:00','2014-05-07 10:19:00','admin','admin'),('DRC','Dominican Republic of Congo','DRC','','','','','','',1,'2014-01-03 10:09:00','0000-00-00 00:00:00','admin',''),('GLM','Great Lake Medicine','KLM','','','','','','',1,'2014-01-03 10:07:00','0000-00-00 00:00:00','admin',''),('HE','Healthy Enterprise  ','URO','','','','','','',1,'2014-01-03 10:06:00','0000-00-00 00:00:00','admin',''),('RWANDA','Rwanda','KLM','','','','','','',1,'2014-01-03 10:08:00','2014-04-21 04:44:00','admin','admin');

/*Table structure for table `cm_codesparam` */

DROP TABLE IF EXISTS `cm_codesparam`;

CREATE TABLE `cm_codesparam` (
  `cm_type` varchar(50) NOT NULL,
  `cm_code` varchar(50) NOT NULL,
  `cm_desc` varchar(150) DEFAULT NULL,
  `cm_accdisc` varchar(50) DEFAULT NULL,
  `cm_acccode` varchar(50) DEFAULT NULL,
  `cm_props` varchar(50) DEFAULT NULL,
  `cm_long` varchar(200) DEFAULT NULL,
  `cm_percent` decimal(20,2) DEFAULT NULL,
  `cm_purtax` varchar(50) DEFAULT NULL,
  `cm_acctax` varchar(50) DEFAULT NULL,
  `cm_branch` varchar(50) DEFAULT NULL,
  `cm_active` int(11) DEFAULT NULL,
  `inserttime` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `insertuser` varchar(50) DEFAULT NULL,
  `updateuser` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cm_type`,`cm_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cm_codesparam` */

insert  into `cm_codesparam`(`cm_type`,`cm_code`,`cm_desc`,`cm_accdisc`,`cm_acccode`,`cm_props`,`cm_long`,`cm_percent`,`cm_purtax`,`cm_acctax`,`cm_branch`,`cm_active`,`inserttime`,`updatetime`,`insertuser`,`updateuser`) values ('BankCash','02','HSBC Bank',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2014-04-13 18:07:00','0000-00-00 00:00:00','admin',''),('Currency','BDT','Bangladeshi Taka',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2014-01-04 16:03:00','0000-00-00 00:00:00','admin',''),('Currency','BUR','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2014-04-13 04:03:00','0000-00-00 00:00:00','admin',''),('Currency','KLM','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2014-04-13 04:01:00','0000-00-00 00:00:00','admin',''),('Currency','URO','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2014-01-27 04:11:00','0000-00-00 00:00:00','admin',''),('Currency','USD','US Dollar',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2014-01-04 16:05:00','0000-00-00 00:00:00','admin',''),('Customer Group','INSTITUTE','INSTITUTE','40001','12100',NULL,NULL,NULL,NULL,'20102','BURUNDI',1,'2014-04-20 06:54:00','0000-00-00 00:00:00','admin',''),('Customer Group','RETAIL','RETAIL','40001','12100',NULL,NULL,NULL,NULL,'20102','BURUNDI',1,'2014-04-20 06:54:00','0000-00-00 00:00:00','admin',''),('Customer Group','WHOLESALE',NULL,'WHOLESALE','WHOLESALE',NULL,NULL,NULL,NULL,'WHOLESALE','BURUNDI',1,'2014-05-07 10:20:00','0000-00-00 00:00:00','admin',''),('Department','01','Accounts',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2014-04-13 18:10:00','0000-00-00 00:00:00','admin',''),('Designation','01','Executive',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2014-04-13 18:10:00','0000-00-00 00:00:00','admin',''),('Leave Plan','01','General Leave Plan',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2014-04-13 18:12:00','0000-00-00 00:00:00','admin',''),('Market','0021','Test',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2014-05-08 11:07:00','0000-00-00 00:00:00','admin',''),('Market','CONSUMERS','CONSUMERS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2014-05-07 10:23:00','0000-00-00 00:00:00','admin',''),('Market','HEALTH CARE','HEALTH CARE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2014-05-07 10:22:00','0000-00-00 00:00:00','admin',''),('Position','101','A',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2014-04-13 18:09:00','0000-00-00 00:00:00','admin',''),('Product Category','HJH','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2014-01-04 16:20:00','0000-00-00 00:00:00','admin',''),('Product Class','DHAKA','Dhaka',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2014-01-19 11:56:00','0000-00-00 00:00:00','admin',''),('Product Class','DISPOSABLE','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2014-01-03 04:32:00','0000-00-00 00:00:00','admin',''),('Product Class','MEDICINE','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2014-01-03 04:26:00','0000-00-00 00:00:00','admin',''),('Product Class','NON CARE','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2014-01-18 14:57:00','2014-05-07 10:10:00','admin','admin'),('Product Class','SERVICE','Service for services item',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2014-01-03 04:33:00','2014-01-03 09:02:00','admin','admin'),('Product Class','TEST2','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2014-01-03 10:29:00','2014-01-04 17:24:00','admin','admin'),('Product Group','ACCESSORIES','non health, non care',NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,1,'2014-05-07 10:07:00','0000-00-00 00:00:00','admin',''),('Product Group','CARE','CARE PRODUCTS',NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,1,'2014-05-07 10:08:00','0000-00-00 00:00:00','admin',''),('Product Group','DF','',NULL,'df',NULL,NULL,NULL,NULL,NULL,NULL,1,'2014-04-18 16:05:00','0000-00-00 00:00:00','admin',''),('Product Group','DHAKA','11111',NULL,'32015',NULL,NULL,NULL,'4',NULL,NULL,1,'2014-01-19 11:58:00','2014-04-18 16:02:00','admin','admin'),('Product Group','HEART MEDICINE','',NULL,'31022',NULL,NULL,NULL,'4',NULL,NULL,1,'2014-01-03 09:14:00','0000-00-00 00:00:00','admin',''),('Product Group','PAIN KILLER','Pain killer table',NULL,'31010',NULL,NULL,NULL,'4',NULL,NULL,1,'2014-01-03 09:06:00','0000-00-00 00:00:00','admin',''),('Salary Type','BASIC',NULL,NULL,NULL,'Addition','Main Component Addition','50.00',NULL,NULL,NULL,1,'2014-04-13 18:14:00','0000-00-00 00:00:00','admin',''),('Salary Type','HOUSE RENT',NULL,NULL,NULL,'Addition','Main Component Addition','10.00',NULL,NULL,NULL,1,'2014-04-13 18:15:00','0000-00-00 00:00:00','admin',''),('Supplier Group','INTERNATIONAL SUPPLIER','INTERNATIONAL SUPPLIER',NULL,'',NULL,NULL,NULL,NULL,'','HE',1,'2014-05-07 10:15:00','0000-00-00 00:00:00','admin',''),('Supplier Group','LOCAL SUPPLIER','',NULL,'21000',NULL,NULL,NULL,NULL,'20101','BURUNDI',1,'2014-04-13 18:20:00','2014-04-16 09:38:00','admin','admin'),('Unit Of Measurement','BOTTLE','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2014-01-18 12:10:00','0000-00-00 00:00:00','admin',''),('Unit Of Measurement','KG','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2014-01-03 04:25:00','0000-00-00 00:00:00','admin',''),('Unit Of Measurement','PACK','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2014-01-03 09:24:00','0000-00-00 00:00:00','admin',''),('Unit Of Measurement','PCS','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2014-01-03 04:24:00','0000-00-00 00:00:00','admin',''),('Unit Of Measurement','SET','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2014-01-18 12:11:00','0000-00-00 00:00:00','admin',''),('Unit Of Measurement','STRIP','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2014-04-24 05:13:00','0000-00-00 00:00:00','admin','');

/*Table structure for table `cm_customermst` */

DROP TABLE IF EXISTS `cm_customermst`;

CREATE TABLE `cm_customermst` (
  `cm_cuscode` varchar(20) NOT NULL,
  `cm_name` varchar(100) DEFAULT NULL,
  `cm_address` varchar(250) DEFAULT NULL,
  `cm_territory` varchar(50) DEFAULT NULL,
  `cm_group` varchar(50) NOT NULL,
  `c_type` varchar(50) NOT NULL,
  `cm_cellnumber` varchar(50) DEFAULT NULL,
  `cm_phone` varchar(50) DEFAULT NULL,
  `cm_fax` varchar(50) DEFAULT NULL,
  `cm_email` varchar(150) DEFAULT NULL,
  `cm_branch` varchar(50) NOT NULL,
  `cm_market` varchar(50) DEFAULT NULL,
  `cm_sp` varchar(50) DEFAULT NULL,
  `cm_creditlimit` decimal(20,2) DEFAULT NULL,
  `cm_hub` varchar(50) DEFAULT NULL,
  `c_status` varchar(20) NOT NULL,
  `inserttime` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `insertuser` varchar(50) DEFAULT NULL,
  `updateuser` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cm_cuscode`),
  KEY `cm_branch` (`cm_branch`,`cm_hub`),
  KEY `cm_name` (`cm_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cm_customermst` */

insert  into `cm_customermst`(`cm_cuscode`,`cm_name`,`cm_address`,`cm_territory`,`cm_group`,`c_type`,`cm_cellnumber`,`cm_phone`,`cm_fax`,`cm_email`,`cm_branch`,`cm_market`,`cm_sp`,`cm_creditlimit`,`cm_hub`,`c_status`,`inserttime`,`updatetime`,`insertuser`,`updateuser`) values ('CUS00001','Rahim Pharma','Dhaka',NULL,'RETAIL','General','','','','','BURUNDI',NULL,'','0.00','','Open','2014-04-24 05:21:00','0000-00-00 00:00:00','admin',''),('CUS00002','Fahim Pharma','Dhaka',NULL,'RETAIL','General','','','','','BURUNDI',NULL,'A','0.00','','Open','2014-04-24 05:23:00','0000-00-00 00:00:00','admin',''),('CUS00003','Samarita Hospital','Dhaka',NULL,'INSTITUTE','Credit','','','','','BURUNDI',NULL,'Z','150000.00','','Open','2014-04-24 05:25:00','0000-00-00 00:00:00','admin','');

/*Table structure for table `cm_productmaster` */

DROP TABLE IF EXISTS `cm_productmaster`;

CREATE TABLE `cm_productmaster` (
  `cm_code` varchar(50) NOT NULL,
  `cm_name` varchar(200) NOT NULL,
  `cm_description` varchar(200) DEFAULT NULL,
  `cm_class` varchar(50) DEFAULT NULL,
  `cm_group` varchar(50) DEFAULT NULL,
  `cm_category` varchar(50) DEFAULT NULL,
  `cm_sellrate` decimal(20,2) DEFAULT NULL,
  `cm_costprice` decimal(20,2) DEFAULT NULL,
  `cm_sellunit` varchar(50) DEFAULT NULL,
  `cm_sellconfact` decimal(20,2) DEFAULT NULL,
  `cm_purunit` varchar(50) DEFAULT NULL,
  `cm_purconfact` decimal(20,2) DEFAULT NULL,
  `cm_selltax` decimal(20,2) NOT NULL,
  `cm_stkunit` varchar(50) DEFAULT NULL,
  `cm_stkconfac` decimal(20,2) DEFAULT NULL,
  `cm_packsize` varchar(50) DEFAULT NULL,
  `cm_stocktype` varchar(50) DEFAULT NULL,
  `cm_generic` varchar(100) DEFAULT NULL,
  `cm_supplierid` varchar(50) DEFAULT NULL,
  `cm_mfgcode` varchar(50) DEFAULT NULL,
  `cm_maxlevel` int(11) DEFAULT NULL,
  `cm_minlevel` int(11) DEFAULT NULL,
  `cm_reorder` int(11) DEFAULT NULL,
  `inserttime` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `insertuser` varchar(50) DEFAULT NULL,
  `updateuser` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cm_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cm_productmaster` */

insert  into `cm_productmaster`(`cm_code`,`cm_name`,`cm_description`,`cm_class`,`cm_group`,`cm_category`,`cm_sellrate`,`cm_costprice`,`cm_sellunit`,`cm_sellconfact`,`cm_purunit`,`cm_purconfact`,`cm_selltax`,`cm_stkunit`,`cm_stkconfac`,`cm_packsize`,`cm_stocktype`,`cm_generic`,`cm_supplierid`,`cm_mfgcode`,`cm_maxlevel`,`cm_minlevel`,`cm_reorder`,`inserttime`,`updatetime`,`insertuser`,`updateuser`) values ('00007777','Flip flops','Flip flops for children','NON CARE','ACCESSORIES','HJH','200.00','50.00','SET','0.00','SET','0.00','0.00','SET','0.00','','Stock N Sell','','','',NULL,NULL,NULL,'2014-05-07 10:04:00','2014-05-07 10:10:00','admin','admin'),('1320001','Dalacin-C-300 mg - Capsule','','MEDICINE','PAIN KILLER','HJH','1.30','9.00','PCS','1.00','SET','10.00','2.50','PCS','1.00','','Stock N Sell','','','',NULL,NULL,NULL,'2014-04-24 05:01:00','0000-00-00 00:00:00','admin',''),('1320002','Sugatrol - 50 mg - Tablet','','MEDICINE','PAIN KILLER','HJH','2.00','50.00','PCS','1.00','BOTTLE','50.00','2.50','PCS','1.00','','Stock N Sell','','','',NULL,NULL,NULL,'2014-04-24 05:06:00','2014-04-24 05:16:00','admin','admin'),('1320003','Zolium-0.5 mg - Tablet','','MEDICINE','HEART MEDICINE','HJH','22.00','20.00','BOTTLE','1.00','BOTTLE','1.00','3.00','BOTTLE','1.00','','Stock N Sell','','','',NULL,NULL,NULL,'2014-04-24 05:08:00','0000-00-00 00:00:00','admin',''),('1320004','Ecosprin-300 mg - Tablet','','MEDICINE','HEART MEDICINE','HJH','15.00','100.00','STRIP','1.00','PACK','10.00','2.50','STRIP','1.00','','Stock N Sell','','','',NULL,NULL,NULL,'2014-04-24 05:13:00','0000-00-00 00:00:00','admin',''),('1320005','Lioresal-10 mg - Tablet','','MEDICINE','PAIN KILLER','HJH','2.50','100.00','PCS','1.00','PACK','100.00','3.00','PCS','1.00','','Stock N Sell','','','',NULL,NULL,NULL,'2014-04-24 05:17:00','0000-00-00 00:00:00','admin','');

/*Table structure for table `cm_suppliermaster` */

DROP TABLE IF EXISTS `cm_suppliermaster`;

CREATE TABLE `cm_suppliermaster` (
  `cm_supplierid` varchar(50) NOT NULL,
  `cm_group` varchar(50) NOT NULL,
  `cm_orgname` varchar(100) NOT NULL,
  `cm_address` varchar(200) DEFAULT NULL,
  `cm_district` varchar(50) DEFAULT NULL,
  `cm_post` varchar(50) DEFAULT NULL,
  `cm_policest` varchar(50) DEFAULT NULL,
  `cm_postcode` varchar(10) DEFAULT NULL,
  `cm_contactperson` varchar(100) NOT NULL,
  `cm_phone` varchar(20) DEFAULT NULL,
  `cm_cellphone` varchar(50) DEFAULT NULL,
  `cm_fax` varchar(10) DEFAULT NULL,
  `cm_email` varchar(50) DEFAULT NULL,
  `cm_url` varchar(50) DEFAULT NULL,
  `cm_status` varchar(50) DEFAULT NULL,
  `inserttime` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `insertuser` varchar(50) DEFAULT NULL,
  `updateuser` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cm_supplierid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cm_suppliermaster` */

insert  into `cm_suppliermaster`(`cm_supplierid`,`cm_group`,`cm_orgname`,`cm_address`,`cm_district`,`cm_post`,`cm_policest`,`cm_postcode`,`cm_contactperson`,`cm_phone`,`cm_cellphone`,`cm_fax`,`cm_email`,`cm_url`,`cm_status`,`inserttime`,`updatetime`,`insertuser`,`updateuser`) values ('SUP00001','LOCAL SUPPLIER','Nuvista Pharmaceutical Limited ','','','','','','Mr. X','','','','','','1','2014-01-03 17:36:00','2014-04-16 09:38:00','admin','admin'),('SUP00002','LOCAL SUPPLIER','Novatis','','','','','','M. Z','','','','','','1','2014-04-24 05:20:00','0000-00-00 00:00:00','admin',''),('SUP00003','INTERNATIONAL SUPPLIER','Mascot','','Bejing, China','','','','Mr. ChingChong','','','','','','1','2014-05-07 10:17:00','0000-00-00 00:00:00','admin','');

/*Table structure for table `cm_transaction` */

DROP TABLE IF EXISTS `cm_transaction`;

CREATE TABLE `cm_transaction` (
  `cm_type` varchar(50) NOT NULL,
  `cm_trncode` varchar(50) NOT NULL,
  `cm_branch` varchar(50) DEFAULT NULL,
  `cm_lastnumber` int(11) DEFAULT NULL,
  `cm_increment` int(11) DEFAULT NULL,
  `cm_active` int(11) DEFAULT NULL,
  `inserttime` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `insertuser` varchar(50) DEFAULT NULL,
  `updateuser` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cm_type`,`cm_trncode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cm_transaction` */

insert  into `cm_transaction`(`cm_type`,`cm_trncode`,`cm_branch`,`cm_lastnumber`,`cm_increment`,`cm_active`,`inserttime`,`updatetime`,`insertuser`,`updateuser`) values ('Account Payable','APV-','Dhaka',8,1,1,NULL,'2014-05-07 17:26:15',NULL,NULL),('Customer TRN Number','CUS-',NULL,1,1,1,'2014-05-18 08:21:00','2014-05-18 10:22:40','admin',''),('GRN Number','GRN-','',7,1,1,'2013-12-27 11:45:00','2014-05-07 13:47:08','admin','admin'),('GRN Number','GRN00001','Burundi',0,1,1,'2014-05-07 11:27:00','0000-00-00 00:00:00','admin',''),('GRN Number','GRN00002','Rwanda',0,1,1,'2014-05-07 11:27:00','0000-00-00 00:00:00','admin',''),('HR Transaction','TRN-',NULL,0,1,1,'2014-04-13 17:57:00','0000-00-00 00:00:00','admin',''),('IM Transaction','BO--','',0,1,1,'2014-04-17 17:09:00','0000-00-00 00:00:00','admin',''),('IM Transaction','DO--','',4,1,1,'2014-04-17 17:08:00','2014-05-06 12:17:48','admin',''),('IM Transaction','GRN00001','',0,1,1,'2014-05-07 12:08:00','0000-00-00 00:00:00','admin',''),('IM Transaction','IT--','',3,1,1,'2014-04-12 03:56:00','2014-05-07 14:29:30','admin',''),('IM Transaction','PO--','',6,1,1,'2014-04-16 09:43:00','2014-05-07 13:54:26','admin',''),('IM Transaction','RE--','',3,1,1,'2014-01-02 15:17:00','2014-05-07 14:29:30','admin',''),('IM Transfer Number','IMTN','HE',7,1,1,'2014-01-02 08:15:00','2014-05-07 14:45:18','admin',''),('Invoice No','IN--','Dhaka',55,1,1,'2014-02-25 00:00:00','2014-05-10 13:15:32','admin','admin'),('Money Receipt','MR--','Dhaka',7,1,1,NULL,'2014-05-15 15:33:53',NULL,NULL),('Purchase Order Number','PORD','',6,1,1,'2014-01-11 13:22:00','2014-05-08 12:27:57','admin',''),('Purchase Order Number','PORE','',4,1,1,'2014-04-14 07:27:00','2014-05-07 13:34:36','admin',''),('Requisition Number','RE','RE',9,1,1,'2014-01-04 17:26:00','2014-05-08 15:18:58','admin','admin'),('Requisition Number','RE00002','Burundi',NULL,1,1,'2014-05-07 10:27:00','0000-00-00 00:00:00','admin',''),('Requisition Number','RE00003','Rwanda',NULL,1,1,'2014-05-07 10:28:00','0000-00-00 00:00:00','admin',''),('Sales Return','1','DRC',0,1,1,'2014-04-07 20:48:00','0000-00-00 00:00:00','admin',''),('Sales Return','SR--','holand',2,1,1,'2014-02-25 00:00:00','2014-05-07 15:16:09','admin',NULL),('Voucher No','APV-','',6,1,1,'2014-04-16 13:54:00','2014-05-20 06:01:54','admin',''),('Voucher No','IM--','BURUNDI',1,1,1,'2014-05-02 12:58:00','2014-05-02 15:07:32','admin',''),('Voucher No','INVC','',5,1,1,'2014-04-16 10:00:00','2014-05-08 12:34:32','admin',''),('Voucher No','JV--','',2,1,1,'2014-04-20 10:16:00','2014-05-20 06:02:06','admin',''),('Voucher No','MRCT','',2,1,1,'2014-04-20 18:46:00','2014-05-19 08:13:56','admin',''),('Voucher No','PAY-','',0,1,1,'2014-04-13 17:22:00','2014-04-17 07:17:36','admin','');

/*Table structure for table `companyprofile` */

DROP TABLE IF EXISTS `companyprofile`;

CREATE TABLE `companyprofile` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `title` varchar(64) NOT NULL,
  `shortdescription` text NOT NULL,
  `longdescription` text NOT NULL,
  `photo` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Data for the table `companyprofile` */

insert  into `companyprofile`(`id`,`title`,`shortdescription`,`longdescription`,`photo`) values (1,'Haiti Medicine S.A.','FOR GLOBAL HEALTH ','Haiti Medicine’s mission is to improve the health of the Haitian people. The best way to do this is to provide high quality medicines that are available (kept in stock) and affordably priced. We deliver directly to missions, clinics and hospitals. We sit down with these organizations and plan for their future supply chain needs. This is required to insure that medicine is on the shelves when the patients need them. ','logo_he.png'),(12,'New Image','New Image','New Image','8594-user.gif'),(13,'New Image','New Image','New Image','user.gif');

/*Table structure for table `hr_default` */

DROP TABLE IF EXISTS `hr_default`;

CREATE TABLE `hr_default` (
  `id` int(11) NOT NULL,
  `pfconrate` decimal(20,2) DEFAULT NULL,
  `othours` int(11) DEFAULT NULL,
  `otrate` decimal(20,2) DEFAULT NULL,
  `taxyear` int(11) DEFAULT NULL,
  `taxoffset` int(11) DEFAULT NULL,
  `inserttime` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `insertuser` varchar(50) DEFAULT NULL,
  `updateuser` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hr_default` */

insert  into `hr_default`(`id`,`pfconrate`,`othours`,`otrate`,`taxyear`,`taxoffset`,`inserttime`,`updatetime`,`insertuser`,`updateuser`) values (1,'10.00',0,'0.00',2014,6,'2014-03-25 00:00:00',NULL,'admin',NULL);

/*Table structure for table `hr_personalinfo` */

DROP TABLE IF EXISTS `hr_personalinfo`;

CREATE TABLE `hr_personalinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empid` varchar(50) DEFAULT NULL,
  `empname` varchar(150) DEFAULT NULL,
  `doj` date DEFAULT NULL,
  `doc` date DEFAULT NULL,
  `grade` varchar(10) DEFAULT NULL,
  `deptname` varchar(100) DEFAULT NULL,
  `designation` varchar(100) DEFAULT NULL,
  `bank` varchar(50) DEFAULT NULL,
  `acccode` varchar(50) DEFAULT NULL,
  `currency` varchar(20) DEFAULT NULL,
  `exchangerate` decimal(20,2) DEFAULT NULL,
  `amount` decimal(20,2) DEFAULT NULL,
  `leaveplan` varchar(50) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `present` varchar(300) DEFAULT NULL,
  `parmanent` varchar(300) DEFAULT NULL,
  `cellno` varchar(20) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `branch` varchar(50) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `inserttime` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `insertuser` varchar(20) DEFAULT NULL,
  `updateuser` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `empid` (`empid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `hr_personalinfo` */

/*Table structure for table `hr_salarydetail` */

DROP TABLE IF EXISTS `hr_salarydetail`;

CREATE TABLE `hr_salarydetail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empid` varchar(50) DEFAULT NULL,
  `salarytype` varchar(50) DEFAULT NULL,
  `primeamt` decimal(20,2) DEFAULT NULL,
  `baseamt` decimal(20,2) DEFAULT NULL,
  `SIGN` int(11) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `transactionnum` varchar(50) DEFAULT NULL,
  `inserttime` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `insertuser` varchar(20) DEFAULT NULL,
  `updateuser` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `empid` (`empid`,`salarytype`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hr_salarydetail` */

/*Table structure for table `hr_trndetail` */

DROP TABLE IF EXISTS `hr_trndetail`;

CREATE TABLE `hr_trndetail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trnnumber` varchar(50) DEFAULT NULL,
  `empid` varchar(50) DEFAULT NULL,
  `salarytype` varchar(50) DEFAULT NULL,
  `amount` decimal(20,2) DEFAULT NULL,
  `percent` decimal(20,2) DEFAULT NULL,
  `timeofbasic` int(11) DEFAULT NULL,
  `areaamt` decimal(20,2) DEFAULT NULL,
  `adjustment` decimal(20,2) DEFAULT NULL,
  `othour` decimal(20,2) DEFAULT NULL,
  `daydeduction` int(11) DEFAULT NULL,
  `inserttime` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `insertuser` varchar(50) DEFAULT NULL,
  `updateuser` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `empid` (`empid`,`salarytype`),
  KEY `trnnumber` (`trnnumber`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `hr_trndetail` */

/*Table structure for table `hr_trnheader` */

DROP TABLE IF EXISTS `hr_trnheader`;

CREATE TABLE `hr_trnheader` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trnnumber` varchar(50) DEFAULT NULL,
  `trndate` date DEFAULT NULL,
  `trnyear` int(11) DEFAULT NULL,
  `trnperiod` int(11) DEFAULT NULL,
  `inserttime` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `insertuser` varchar(50) DEFAULT NULL,
  `updateuser` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `trnnumber` (`trnnumber`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `hr_trnheader` */

/*Table structure for table `im_batchtransfer` */

DROP TABLE IF EXISTS `im_batchtransfer`;

CREATE TABLE `im_batchtransfer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `im_transfernum` varchar(50) DEFAULT NULL,
  `cm_code` varchar(50) DEFAULT NULL,
  `im_BatchNumber` varchar(50) DEFAULT NULL,
  `im_ExpDate` date DEFAULT NULL,
  `im_quantity` int(11) DEFAULT NULL,
  `im_unit` varchar(50) DEFAULT NULL,
  `im_rate` decimal(20,2) DEFAULT NULL,
  `inserttime` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `insertuser` varchar(50) DEFAULT NULL,
  `updateuser` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `im_transfernum` (`im_transfernum`,`cm_code`,`im_BatchNumber`),
  CONSTRAINT `im_batchtransfer_ibfk_1` FOREIGN KEY (`im_transfernum`) REFERENCES `im_transferhd` (`im_transfernum`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `im_batchtransfer` */

insert  into `im_batchtransfer`(`id`,`im_transfernum`,`cm_code`,`im_BatchNumber`,`im_ExpDate`,`im_quantity`,`im_unit`,`im_rate`,`inserttime`,`updatetime`,`insertuser`,`updateuser`) values (4,'IMTN14000004','1320002','S-20140429-01','2014-09-30',200,'PCS','1.00','2014-05-07 14:26:12',NULL,'admin',NULL),(5,'IMTN14000004','1320003','Z-20140429-01','2014-08-31',1,'BOTTLE','20.00','2014-05-07 14:26:44',NULL,'admin',NULL),(6,'IMTN14000004','1320001','D-20140429-01','2014-08-31',134,'PCS','0.90','2014-05-07 14:27:36',NULL,'admin',NULL),(7,'IMTN14000006','1320002','S-20140429-01','2014-09-30',111,'PCS','2.12','2014-05-07 14:45:29',NULL,'admin',NULL);

/*Table structure for table `im_grndetail` */

DROP TABLE IF EXISTS `im_grndetail`;

CREATE TABLE `im_grndetail` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `im_grnnumber` varchar(50) DEFAULT NULL,
  `cm_code` varchar(50) DEFAULT NULL,
  `im_BatchNumber` varchar(50) DEFAULT NULL,
  `im_ExpireDate` date DEFAULT NULL,
  `im_RcvQuantity` int(11) DEFAULT NULL,
  `im_costprice` decimal(20,2) DEFAULT NULL,
  `im_unit` varchar(50) DEFAULT NULL,
  `im_unitqty` int(11) DEFAULT NULL,
  `im_taxrate` decimal(20,2) DEFAULT NULL,
  `im_taxamt` decimal(20,2) DEFAULT NULL,
  `im_rowamount` decimal(20,2) DEFAULT NULL,
  `inserttime` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `insertuser` varchar(50) DEFAULT NULL,
  `updateuser` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `im_grnnumber` (`im_grnnumber`,`cm_code`),
  KEY `cm_code` (`cm_code`),
  CONSTRAINT `im_grndetail_ibfk_1` FOREIGN KEY (`im_grnnumber`) REFERENCES `im_grnheader` (`im_grnnumber`),
  CONSTRAINT `im_grndetail_ibfk_2` FOREIGN KEY (`cm_code`) REFERENCES `cm_productmaster` (`cm_code`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;

/*Data for the table `im_grndetail` */

insert  into `im_grndetail`(`id`,`im_grnnumber`,`cm_code`,`im_BatchNumber`,`im_ExpireDate`,`im_RcvQuantity`,`im_costprice`,`im_unit`,`im_unitqty`,`im_taxrate`,`im_taxamt`,`im_rowamount`,`inserttime`,`updatetime`,`insertuser`,`updateuser`) values (43,'GRN-14000001','1320001','D-20140429-01','2014-08-31',20,'9.00','SET',10,'4.00','6.92','180.00','2014-04-29 04:49:00','0000-00-00 00:00:00','admin',''),(44,'GRN-14000001','1320005','L-20140429-01','2014-08-31',5,'100.00','PACK',100,'4.00','19.23','500.00','2014-04-29 04:50:00','0000-00-00 00:00:00','admin',''),(45,'GRN-14000001','1320003','Z-20140429-01','2014-08-31',5,'20.00','BOTTLE',1,'4.00','3.85','100.00','2014-04-29 04:52:00','0000-00-00 00:00:00','admin',''),(52,'GRN-14000004','1320005','L-20140429-02','2014-09-30',5,'100.00','PACK',100,'4.00','19.23','500.00','2014-04-29 13:11:00','0000-00-00 00:00:00','admin',''),(53,'GRN-14000004','1320002','S-20140429-01','2014-09-30',15,'50.00','BOTTLE',50,'4.00','28.85','750.00','2014-04-29 13:11:00','0000-00-00 00:00:00','admin',''),(54,'GRN-14000006','1320001','222222','2014-05-08',1200,'0.00','BOTTLE',NULL,'4.00','0.00','0.00','2014-05-07 11:42:00','0000-00-00 00:00:00','admin','');

/*Table structure for table `im_grnheader` */

DROP TABLE IF EXISTS `im_grnheader`;

CREATE TABLE `im_grnheader` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `im_grnnumber` varchar(50) NOT NULL,
  `im_purordnum` varchar(50) DEFAULT NULL,
  `am_vouchernumber` varchar(50) DEFAULT NULL,
  `im_date` date DEFAULT NULL,
  `cm_supplierid` varchar(50) DEFAULT NULL,
  `pp_requisitionno` varchar(50) DEFAULT NULL,
  `im_payterms` varchar(50) DEFAULT NULL,
  `im_store` varchar(50) DEFAULT NULL,
  `im_taxrate` decimal(20,2) DEFAULT NULL,
  `im_taxamt` decimal(20,2) DEFAULT NULL,
  `im_discrate` decimal(20,2) DEFAULT NULL,
  `im_discamt` decimal(20,2) DEFAULT NULL,
  `im_currency` varchar(50) DEFAULT NULL,
  `im_amount` decimal(20,2) DEFAULT NULL,
  `im_netamt` decimal(20,2) DEFAULT NULL,
  `im_status` varchar(50) DEFAULT NULL,
  `inserttime` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `insertuser` varchar(50) DEFAULT NULL,
  `updateuser` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `im_grnnumber` (`im_grnnumber`),
  KEY `cm_supplierid` (`cm_supplierid`),
  CONSTRAINT `im_grnheader_ibfk_1` FOREIGN KEY (`cm_supplierid`) REFERENCES `cm_suppliermaster` (`cm_supplierid`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

/*Data for the table `im_grnheader` */

insert  into `im_grnheader`(`id`,`im_grnnumber`,`im_purordnum`,`am_vouchernumber`,`im_date`,`cm_supplierid`,`pp_requisitionno`,`im_payterms`,`im_store`,`im_taxrate`,`im_taxamt`,`im_discrate`,`im_discamt`,`im_currency`,`im_amount`,`im_netamt`,`im_status`,`inserttime`,`updatetime`,`insertuser`,`updateuser`) values (20,'GRN-14000001','PORE14000001','INVC14000001','2014-04-29','SUP00001','RE14000001','Cash','BURUNDI','4.00','30.00','0.00','0.00','BUR','780.00','750.00','Invoiced','2014-04-29 06:49:33',NULL,'admin',NULL),(23,'GRN-14000004','PORE14000001','INVC14000002','2014-04-29','SUP00001','RE14000001','Cash','BURUNDI','4.00','48.08','0.00','0.00','BUR','1250.00','1201.92','Invoiced','2014-04-29 15:05:18',NULL,'admin',NULL),(24,'GRN-14000005','PORD14000001',NULL,'2014-05-07','SUP00002','RE14000003','Cash','RWANDA','4.00','0.00','0.00','0.00','KLM','0.00','0.00','Open','2014-05-07 13:39:07',NULL,'admin',NULL),(25,'GRN-14000006','PORD14000003','INVC14000003','2014-05-07','SUP00001','RE14000007','Cash','GLM','4.00','0.00','0.00','0.00','KLM','0.00','0.00','Invoiced','2014-05-07 13:42:45',NULL,'admin',NULL),(26,'GRN-14000007','PORD14000003','INVC14000004','2014-05-07','SUP00001','RE14000007','Cash','GLM','4.00','0.00','0.00','0.00','KLM','0.00','0.00','Invoiced','2014-05-07 13:47:08',NULL,'admin',NULL);

/*Table structure for table `im_transaction` */

DROP TABLE IF EXISTS `im_transaction`;

CREATE TABLE `im_transaction` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `im_number` varchar(50) DEFAULT NULL,
  `cm_code` varchar(50) DEFAULT NULL,
  `im_storeid` varchar(50) DEFAULT NULL,
  `im_BatchNumber` varchar(50) DEFAULT NULL,
  `im_date` date DEFAULT NULL,
  `im_ExpireDate` date DEFAULT NULL,
  `im_quantity` int(11) DEFAULT NULL,
  `im_sign` int(11) DEFAULT NULL,
  `im_unit` varchar(50) DEFAULT NULL,
  `im_rate` decimal(20,2) DEFAULT NULL,
  `im_totalprice` decimal(20,2) DEFAULT NULL,
  `im_RefNumber` varchar(50) DEFAULT NULL,
  `im_RefRow` int(11) DEFAULT NULL,
  `im_note` varchar(250) DEFAULT NULL,
  `im_status` varchar(50) DEFAULT NULL,
  `im_voucherno` varchar(50) DEFAULT NULL,
  `cm_supplierid` varchar(50) DEFAULT NULL,
  `im_currency` varchar(50) DEFAULT NULL,
  `im_ExchangeRate` decimal(20,2) DEFAULT NULL,
  `inserttime` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `insertuser` varchar(50) DEFAULT NULL,
  `updateuser` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `im_number` (`im_number`),
  KEY `cm_code` (`cm_code`),
  CONSTRAINT `im_transaction_ibfk_1` FOREIGN KEY (`cm_code`) REFERENCES `cm_productmaster` (`cm_code`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8;

/*Data for the table `im_transaction` */

insert  into `im_transaction`(`id`,`im_number`,`cm_code`,`im_storeid`,`im_BatchNumber`,`im_date`,`im_ExpireDate`,`im_quantity`,`im_sign`,`im_unit`,`im_rate`,`im_totalprice`,`im_RefNumber`,`im_RefRow`,`im_note`,`im_status`,`im_voucherno`,`cm_supplierid`,`im_currency`,`im_ExchangeRate`,`inserttime`,`updatetime`,`insertuser`,`updateuser`) values (62,'PO--14000001','1320001','BURUNDI','D-20140429-01','2014-04-29','2014-08-31',200,1,'PCS','0.90','180.00','GRN-14000001',43,'Goods Received From PO','Open','','SUP00001','','0.00','2014-04-29 06:55:02','0000-00-00 00:00:00','admin',''),(63,'PO--14000002','1320005','BURUNDI','L-20140429-01','2014-04-29','2014-08-31',500,1,'PCS','1.00','500.00','GRN-14000001',44,'Goods Received From PO','Open',NULL,'SUP00001','BUR',NULL,'2014-04-29 06:55:02',NULL,'admin',NULL),(64,'PO--14000003','1320003','BURUNDI','Z-20140429-01','2014-04-29','2014-08-31',5,1,'BOTTLE','20.00','100.00','GRN-14000001',45,'Goods Received From PO','Open',NULL,'SUP00001','BUR',NULL,'2014-04-29 06:55:02',NULL,'admin',NULL),(65,'PO--14000004','1320002','BURUNDI','S-20140429-01','2014-04-29','2014-09-30',1000,1,'PCS','1.00','1000.00','GRN-14000004',53,'Goods Received From PO','Open','','SUP00001','1','0.00','2014-04-29 15:12:30','0000-00-00 00:00:00','admin',''),(66,'PO--14000005','1320005','BURUNDI','L-20140429-02','2014-04-29','2014-09-30',500,1,'PCS','1.00','500.00','GRN-14000004',52,'Goods Received From PO','Open',NULL,'SUP00001','BUR',NULL,'2014-04-29 15:12:30',NULL,'admin',NULL),(67,'DO--14000001','1320003','BURUNDI','Z-20140429-01','2014-05-02','2014-08-31',3,-1,'BOTTLE','20.00','60.00','IN--14000003',0,'Item was sell by sales module','Post to GL','IM--14000001','CUS00002','BUR','1.00','2014-05-02 15:03:35',NULL,'admin',NULL),(68,'DO--14000002','1320005','BURUNDI','L-20140429-01','2014-05-06','2014-08-31',50,-1,'PCS','1.00','50.00','IN--14000025',0,'Item was sell by sales module','Open',NULL,'CUS00003','BUR','1.00','2014-05-06 12:17:48',NULL,'admin',NULL),(69,'DO--14000003','1320002','BURUNDI','S-20140429-01','2014-05-06','2014-09-30',10,-1,'PCS','1.00','10.00','IN--14000025',0,'Item was sell by sales module','Open',NULL,'CUS00003','BUR','1.00','2014-05-06 12:17:48',NULL,'admin',NULL),(70,'DO--14000004','1320001','BURUNDI','D-20140429-01','2014-05-06','2014-08-31',66,-1,'PCS','0.90','59.40','IN--14000025',0,'Item was sell by sales module','Open',NULL,'CUS00003','BUR','1.00','2014-05-06 12:17:48',NULL,'admin',NULL),(71,'PO--14000006','1320001','GLM','222222','2014-05-07','2014-05-08',1200,1,'BOTTLE','10.00','12000.00','GRN-14000006',54,'Goods Received From PO','Open','','SUP00001','1','0.00','2014-05-07 13:54:26','0000-00-00 00:00:00','admin',''),(72,'IT--14000001','1320002','BURUNDI','S-20140429-01','2014-05-07','2014-09-30',200,-1,'PCS','1.00','200.00','IMTN14000004',4,'Transfer to RWANDA','Open',NULL,NULL,'BUR','1.00','2014-05-07 14:29:29',NULL,'admin',NULL),(73,'RE--14000001','1320002','RWANDA','S-20140429-01','2014-05-07','2014-09-30',200,1,'PCS','2.12','424.00','IMTN14000004',4,'Received from BURUNDI','Open',NULL,NULL,'KLM','1.00','2014-05-07 14:29:30',NULL,'admin',NULL),(74,'IT--14000002','1320003','BURUNDI','Z-20140429-01','2014-05-07','2014-08-31',1,-1,'BOTTLE','20.00','20.00','IMTN14000004',5,'Transfer to RWANDA','Open',NULL,NULL,'BUR','1.00','2014-05-07 14:29:30',NULL,'admin',NULL),(75,'RE--14000002','1320003','RWANDA','Z-20140429-01','2014-05-07','2014-08-31',1,1,'BOTTLE','42.40','42.40','IMTN14000004',5,'Received from BURUNDI','Open',NULL,NULL,'KLM','1.00','2014-05-07 14:29:30',NULL,'admin',NULL),(76,'IT--14000003','1320001','BURUNDI','D-20140429-01','2014-05-07','2014-08-31',134,-1,'PCS','0.90','120.60','IMTN14000004',6,'Transfer to RWANDA','Open',NULL,NULL,'BUR','1.00','2014-05-07 14:29:30',NULL,'admin',NULL),(77,'RE--14000003','1320001','RWANDA','D-20140429-01','2014-05-07','2014-08-31',134,1,'PCS','1.91','255.67','IMTN14000004',6,'Received from BURUNDI','Open',NULL,NULL,'KLM','1.00','2014-05-07 14:29:30',NULL,'admin',NULL);

/*Table structure for table `im_transferdt` */

DROP TABLE IF EXISTS `im_transferdt`;

CREATE TABLE `im_transferdt` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `im_transfernum` varchar(50) DEFAULT NULL,
  `cm_code` varchar(50) DEFAULT NULL,
  `im_unit` varchar(50) DEFAULT NULL,
  `im_quantity` int(11) DEFAULT NULL,
  `im_rate` decimal(20,2) DEFAULT NULL,
  `inserttime` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `insertuser` varchar(50) DEFAULT NULL,
  `updateuser` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `im_transfernum` (`im_transfernum`,`cm_code`),
  KEY `cm_code` (`cm_code`),
  CONSTRAINT `im_transferdt_ibfk_1` FOREIGN KEY (`im_transfernum`) REFERENCES `im_transferhd` (`im_transfernum`),
  CONSTRAINT `im_transferdt_ibfk_2` FOREIGN KEY (`cm_code`) REFERENCES `cm_productmaster` (`cm_code`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

/*Data for the table `im_transferdt` */

insert  into `im_transferdt`(`id`,`im_transfernum`,`cm_code`,`im_unit`,`im_quantity`,`im_rate`,`inserttime`,`updatetime`,`insertuser`,`updateuser`) values (14,'IMTN14000002','1320002','PCS',77,'0.00','2014-05-07 12:24:00','0000-00-00 00:00:00','admin',''),(15,'IMTN14000004','1320002','PCS',200,'0.00','2014-05-07 12:25:00','0000-00-00 00:00:00','admin',''),(16,'IMTN14000004','1320003','BOTTLE',1,'0.00','2014-05-07 12:26:00','0000-00-00 00:00:00','admin',''),(17,'IMTN14000004','1320001','PCS',400,'0.00','2014-05-07 12:27:00','0000-00-00 00:00:00','admin',''),(18,'IMTN14000006','1320002','PCS',111,'0.00','2014-05-07 12:45:00','0000-00-00 00:00:00','admin','');

/*Table structure for table `im_transferhd` */

DROP TABLE IF EXISTS `im_transferhd`;

CREATE TABLE `im_transferhd` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `im_transfernum` varchar(50) DEFAULT NULL,
  `im_date` date DEFAULT NULL,
  `im_condate` date DEFAULT NULL,
  `im_note` varchar(250) DEFAULT NULL,
  `im_fromstore` varchar(50) DEFAULT NULL,
  `im_tostore` varchar(50) DEFAULT NULL,
  `im_status` varchar(50) DEFAULT NULL,
  `inserttime` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `insertuser` varchar(50) DEFAULT NULL,
  `updateuser` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `im_transfernum` (`im_transfernum`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*Data for the table `im_transferhd` */

insert  into `im_transferhd`(`id`,`im_transfernum`,`im_date`,`im_condate`,`im_note`,`im_fromstore`,`im_tostore`,`im_status`,`inserttime`,`updatetime`,`insertuser`,`updateuser`) values (14,'IMTN14000002','2014-05-07','2014-05-08','description','RWANDA','BURUNDI','Confirmed','2014-05-07 12:23:00','0000-00-00 00:00:00','admin',''),(15,'IMTN14000004','2014-05-07','2014-05-08','description','BURUNDI','RWANDA','Confirmed','2014-05-07 12:25:00','0000-00-00 00:00:00','admin',''),(16,'IMTN14000006','2014-05-07','2014-05-08','sssss','RWANDA','BURUNDI','Open','2014-05-07 12:44:00','0000-00-00 00:00:00','admin','');

/*Table structure for table `it_imtoap` */

DROP TABLE IF EXISTS `it_imtoap`;

CREATE TABLE `it_imtoap` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_group` varchar(50) NOT NULL,
  `sup_group` varchar(50) NOT NULL,
  `debit_account` varchar(50) NOT NULL,
  `active` int(11) DEFAULT NULL,
  `inserttime` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `insertuser` varchar(50) DEFAULT NULL,
  `updateuser` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `item_group` (`item_group`),
  KEY `debit_account` (`debit_account`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `it_imtoap` */

insert  into `it_imtoap`(`id`,`item_group`,`sup_group`,`debit_account`,`active`,`inserttime`,`updatetime`,`insertuser`,`updateuser`) values (1,'HEART MEDICINE','LOCAL SUPPLIER','13100',1,'2014-04-16 09:53:00','0000-00-00 00:00:00','admin',''),(2,'PAIN KILLER','LOCAL SUPPLIER','13101',1,'2014-04-16 12:21:00','0000-00-00 00:00:00','admin','');

/*Table structure for table `it_imtogl` */

DROP TABLE IF EXISTS `it_imtogl`;

CREATE TABLE `it_imtogl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `c_branch` varchar(10) DEFAULT NULL,
  `c_trncode` varchar(10) DEFAULT NULL,
  `c_group` varchar(50) DEFAULT NULL,
  `c_accdr` varchar(10) DEFAULT NULL,
  `c_acccr` varchar(10) DEFAULT NULL,
  `inserttime` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `insertuser` varchar(10) DEFAULT NULL,
  `updateuser` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `c_trncode` (`c_trncode`,`c_group`,`c_branch`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `it_imtogl` */

insert  into `it_imtogl`(`id`,`c_branch`,`c_trncode`,`c_group`,`c_accdr`,`c_acccr`,`inserttime`,`updatetime`,`insertuser`,`updateuser`) values (1,'BURUNDI','DO--','HEART MEDICINE','41010','13100','2014-05-01 19:03:54',NULL,'admin',NULL),(2,'BURUNDI','DO--','PAIN KILLER','41022','13101','2014-05-08 11:19:00','0000-00-00 00:00:00','admin','');

/*Table structure for table `pp_purchaseorddt` */

DROP TABLE IF EXISTS `pp_purchaseorddt`;

CREATE TABLE `pp_purchaseorddt` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `pp_purordnum` varchar(50) NOT NULL,
  `cm_code` varchar(50) NOT NULL,
  `pp_quantity` int(11) DEFAULT NULL,
  `pp_grnqty` int(11) DEFAULT NULL,
  `pp_taxrate` decimal(20,2) DEFAULT NULL,
  `pp_taxamt` decimal(20,2) DEFAULT NULL,
  `pp_unit` varchar(50) DEFAULT NULL,
  `pp_unitqty` int(11) DEFAULT NULL,
  `pp_purchasrate` decimal(20,2) DEFAULT NULL,
  `pp_rowamt` decimal(20,2) DEFAULT NULL,
  `inserttime` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `insertuser` varchar(50) DEFAULT NULL,
  `updateuser` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pp_purordnum` (`pp_purordnum`,`cm_code`),
  KEY `cm_code` (`cm_code`),
  CONSTRAINT `pp_purchaseorddt_ibfk_1` FOREIGN KEY (`cm_code`) REFERENCES `cm_productmaster` (`cm_code`),
  CONSTRAINT `pp_purchaseorddt_ibfk_2` FOREIGN KEY (`pp_purordnum`) REFERENCES `pp_purchaseordhd` (`pp_purordnum`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8;

/*Data for the table `pp_purchaseorddt` */

insert  into `pp_purchaseorddt`(`id`,`pp_purordnum`,`cm_code`,`pp_quantity`,`pp_grnqty`,`pp_taxrate`,`pp_taxamt`,`pp_unit`,`pp_unitqty`,`pp_purchasrate`,`pp_rowamt`,`inserttime`,`updatetime`,`insertuser`,`updateuser`) values (69,'PORE14000001','1320001',20,20,'4.00','6.92','SET',10,'9.00','180.00','2014-04-29 06:36:34',NULL,'admin',NULL),(70,'PORE14000001','1320002',15,15,'4.00','28.85','BOTTLE',50,'50.00','750.00','2014-04-29 06:36:34',NULL,'admin',NULL),(71,'PORE14000001','1320003',5,5,'4.00','3.85','BOTTLE',1,'20.00','100.00','2014-04-29 06:36:34',NULL,'admin',NULL),(72,'PORE14000001','1320005',10,10,'4.00','38.46','PACK',100,'100.00','1000.00','2014-04-29 06:36:34',NULL,'admin',NULL),(73,'PORD14000001','1320001',20,NULL,'4.00','0.00','SET',NULL,'0.00','0.00','2014-05-07 11:35:00','0000-00-00 00:00:00','admin',''),(74,'PORD14000001','1320003',150,NULL,'4.00','0.00','BOTTLE',NULL,'0.00','0.00','2014-05-07 11:36:00','0000-00-00 00:00:00','admin',''),(75,'PORD14000001','1320002',80,NULL,'4.00','0.00','PACK',NULL,'0.00','0.00','2014-05-07 11:36:00','0000-00-00 00:00:00','admin',''),(76,'PORD14000003','1320001',1500,1200,'4.00','0.00','BOTTLE',NULL,'0.00','0.00','2014-05-07 11:40:00','0000-00-00 00:00:00','admin',''),(81,'PORD14000003','1320002',300,NULL,'4.00','0.00','PACK',NULL,'0.00','0.00','2014-05-07 11:41:00','0000-00-00 00:00:00','admin',''),(82,'PORD14000003','1320003',100,NULL,'4.00','0.00','STRIP',NULL,'0.00','0.00','2014-05-07 11:41:00','0000-00-00 00:00:00','admin','');

/*Table structure for table `pp_purchaseordhd` */

DROP TABLE IF EXISTS `pp_purchaseordhd`;

CREATE TABLE `pp_purchaseordhd` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `pp_purordnum` varchar(50) NOT NULL,
  `pp_date` date DEFAULT NULL,
  `cm_supplierid` varchar(50) NOT NULL,
  `pp_requisitionno` varchar(50) DEFAULT NULL,
  `pp_payterms` varchar(500) DEFAULT NULL,
  `pp_deliverydate` date DEFAULT NULL,
  `pp_store` varchar(50) DEFAULT NULL,
  `pp_taxrate` decimal(20,2) DEFAULT NULL,
  `pp_taxamt` decimal(20,2) DEFAULT NULL,
  `pp_discrate` decimal(20,2) DEFAULT NULL,
  `pp_discamt` decimal(20,2) DEFAULT NULL,
  `pp_amount` decimal(20,2) DEFAULT NULL,
  `pp_netamt` decimal(20,2) DEFAULT NULL,
  `pp_status` varchar(20) DEFAULT NULL,
  `pp_currency` varchar(50) DEFAULT NULL,
  `inserttime` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `insertuser` varchar(50) DEFAULT NULL,
  `updateuser` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pp_purordnum` (`pp_purordnum`),
  KEY `cm_supplierid` (`cm_supplierid`),
  CONSTRAINT `pp_purchaseordhd_ibfk_1` FOREIGN KEY (`cm_supplierid`) REFERENCES `cm_suppliermaster` (`cm_supplierid`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

/*Data for the table `pp_purchaseordhd` */

insert  into `pp_purchaseordhd`(`id`,`pp_purordnum`,`pp_date`,`cm_supplierid`,`pp_requisitionno`,`pp_payterms`,`pp_deliverydate`,`pp_store`,`pp_taxrate`,`pp_taxamt`,`pp_discrate`,`pp_discamt`,`pp_amount`,`pp_netamt`,`pp_status`,`pp_currency`,`inserttime`,`updatetime`,`insertuser`,`updateuser`) values (28,'PORE14000001','2014-04-29','SUP00001','RE14000001','Cash','2014-04-29','BURUNDI','4.00','78.08','0.00','0.00','2030.00','1951.92','Received','BUR','2014-04-29 06:36:34',NULL,'admin',NULL),(29,'PORD14000001','2014-05-07','SUP00002','RE14000003','Cash','2014-05-08','RWANDA','4.00','0.00','0.00','0.00','0.00','0.00','GRN Created','KLM','2014-05-07 11:34:00','0000-00-00 00:00:00','admin',''),(30,'PORD14000003','2014-05-07','SUP00001','RE14000007','Cash','2014-05-08','GLM','4.00','0.00','0.00','0.00','0.00','0.00','GRN Created','KLM','2014-05-07 11:40:00','0000-00-00 00:00:00','admin',''),(31,'PORD14000005','2014-05-08','SUP00002','','Cash','2014-05-09','BURUNDI',NULL,NULL,'0.00','0.00','0.00',NULL,'Open','BUR','2014-05-08 10:26:00','0000-00-00 00:00:00','admin','');

/*Table structure for table `pp_requisitiondt` */

DROP TABLE IF EXISTS `pp_requisitiondt`;

CREATE TABLE `pp_requisitiondt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pp_requisitionno` varchar(50) NOT NULL,
  `cm_code` varchar(50) NOT NULL,
  `pp_unit` varchar(50) DEFAULT NULL,
  `pp_quantity` int(11) DEFAULT NULL,
  `inserttime` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `insertuser` varchar(50) DEFAULT NULL,
  `updateuser` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cm_code` (`cm_code`),
  KEY `pp_requisitionno` (`pp_requisitionno`),
  CONSTRAINT `pp_requisitiondt_ibfk_1` FOREIGN KEY (`cm_code`) REFERENCES `cm_productmaster` (`cm_code`),
  CONSTRAINT `pp_requisitiondt_ibfk_2` FOREIGN KEY (`pp_requisitionno`) REFERENCES `pp_requisitionhd` (`pp_requisitionno`)
) ENGINE=InnoDB AUTO_INCREMENT=118 DEFAULT CHARSET=utf8;

/*Data for the table `pp_requisitiondt` */

insert  into `pp_requisitiondt`(`id`,`pp_requisitionno`,`cm_code`,`pp_unit`,`pp_quantity`,`inserttime`,`updatetime`,`insertuser`,`updateuser`) values (114,'RE14000001','1320001','SET',20,'2014-04-29 04:34:00','0000-00-00 00:00:00','admin',''),(115,'RE14000001','1320005','PACK',10,'2014-04-29 04:34:00','0000-00-00 00:00:00','admin',''),(116,'RE14000001','1320002','BOTTLE',15,'2014-04-29 04:35:00','0000-00-00 00:00:00','admin',''),(117,'RE14000001','1320003','BOTTLE',5,'2014-04-29 04:35:00','0000-00-00 00:00:00','admin','');

/*Table structure for table `pp_requisitionhd` */

DROP TABLE IF EXISTS `pp_requisitionhd`;

CREATE TABLE `pp_requisitionhd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pp_requisitionno` varchar(50) NOT NULL,
  `cm_supplierid` varchar(50) DEFAULT NULL,
  `pp_date` date DEFAULT NULL,
  `pp_branch` varchar(50) DEFAULT NULL,
  `pp_note` varchar(250) DEFAULT NULL,
  `pp_status` varchar(50) DEFAULT NULL,
  `inserttime` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `insertuser` varchar(50) DEFAULT NULL,
  `updateuser` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pp_requisitionno` (`pp_requisitionno`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

/*Data for the table `pp_requisitionhd` */

insert  into `pp_requisitionhd`(`id`,`pp_requisitionno`,`cm_supplierid`,`pp_date`,`pp_branch`,`pp_note`,`pp_status`,`inserttime`,`updatetime`,`insertuser`,`updateuser`) values (22,'RE14000001','SUP00001','2014-04-29','BURUNDI','Request for new product','PO Created','2014-04-29 04:34:00','0000-00-00 00:00:00','admin',''),(23,'RE14000003','SUP00003','2014-05-07','BURUNDI','10 packs of paracetamol\r\n5 bottles of syrup','PO Created','2014-05-07 10:28:00','0000-00-00 00:00:00','admin',''),(24,'RE14000005','SUP00002','2014-05-07','RWANDA','order for medicines','PO Created','2014-05-07 10:30:00','0000-00-00 00:00:00','admin',''),(25,'RE14000007','SUP00001','2014-05-07','DRC','','PO Created','2014-05-07 10:32:00','0000-00-00 00:00:00','admin','');

/*Table structure for table `profiles` */

DROP TABLE IF EXISTS `profiles`;

CREATE TABLE `profiles` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `lastname` varchar(50) NOT NULL DEFAULT '',
  `firstname` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`user_id`),
  CONSTRAINT `user_profile_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `profiles` */

insert  into `profiles`(`user_id`,`lastname`,`firstname`) values (1,'Admin','Administrator'),(2,'Demo','Demo'),(3,'Reza','Selim'),(8,'neve','maarten'),(9,'Rustenhoven','Cees ');

/*Table structure for table `profiles_fields` */

DROP TABLE IF EXISTS `profiles_fields`;

CREATE TABLE `profiles_fields` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `varname` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `field_type` varchar(50) NOT NULL,
  `field_size` varchar(15) NOT NULL DEFAULT '0',
  `field_size_min` varchar(15) NOT NULL DEFAULT '0',
  `required` int(1) NOT NULL DEFAULT '0',
  `match` varchar(255) NOT NULL DEFAULT '',
  `range` varchar(255) NOT NULL DEFAULT '',
  `error_message` varchar(255) NOT NULL DEFAULT '',
  `other_validator` varchar(5000) NOT NULL DEFAULT '',
  `default` varchar(255) NOT NULL DEFAULT '',
  `widget` varchar(255) NOT NULL DEFAULT '',
  `widgetparams` varchar(5000) NOT NULL DEFAULT '',
  `position` int(3) NOT NULL DEFAULT '0',
  `visible` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `varname` (`varname`,`widget`,`visible`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `profiles_fields` */

insert  into `profiles_fields`(`id`,`varname`,`title`,`field_type`,`field_size`,`field_size_min`,`required`,`match`,`range`,`error_message`,`other_validator`,`default`,`widget`,`widgetparams`,`position`,`visible`) values (1,'lastname','Last Name','VARCHAR','50','3',1,'','','Incorrect Last Name (length between 3 and 50 characters).','','','','',1,3),(2,'firstname','First Name','VARCHAR','50','3',1,'','','Incorrect First Name (length between 3 and 50 characters).','','','','',0,3);

/*Table structure for table `rights` */

DROP TABLE IF EXISTS `rights`;

CREATE TABLE `rights` (
  `itemname` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  PRIMARY KEY (`itemname`),
  CONSTRAINT `rights_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `rights` */

insert  into `rights`(`itemname`,`type`,`weight`) values ('admin',1,1);

/*Table structure for table `sm_batchsale` */

DROP TABLE IF EXISTS `sm_batchsale`;

CREATE TABLE `sm_batchsale` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sm_number` varchar(20) NOT NULL,
  `cm_code` varchar(50) NOT NULL,
  `sm_batchnumber` varchar(50) NOT NULL,
  `sm_expdate` date DEFAULT NULL,
  `sm_unit` varchar(20) DEFAULT NULL,
  `sm_quantity` int(11) DEFAULT NULL,
  `sm_bonusqty` int(11) DEFAULT NULL,
  `sm_rate` decimal(20,2) DEFAULT NULL,
  `sm_tax_rate` decimal(20,2) DEFAULT NULL,
  `sm_tax_amt` decimal(20,2) DEFAULT NULL,
  `sm_line_amt` decimal(20,2) DEFAULT NULL,
  `inserttime` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `insertuser` varchar(20) DEFAULT NULL,
  `updateuser` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sm_number` (`sm_number`,`cm_code`,`sm_batchnumber`),
  KEY `cm_code` (`cm_code`),
  CONSTRAINT `sm_batchsale_ibfk_1` FOREIGN KEY (`sm_number`) REFERENCES `sm_header` (`sm_number`),
  CONSTRAINT `sm_batchsale_ibfk_2` FOREIGN KEY (`cm_code`) REFERENCES `cm_productmaster` (`cm_code`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

/*Data for the table `sm_batchsale` */

insert  into `sm_batchsale`(`id`,`sm_number`,`cm_code`,`sm_batchnumber`,`sm_expdate`,`sm_unit`,`sm_quantity`,`sm_bonusqty`,`sm_rate`,`sm_tax_rate`,`sm_tax_amt`,`sm_line_amt`,`inserttime`,`updatetime`,`insertuser`,`updateuser`) values (27,'IN--14000003','1320003','Z-20140429-01','2014-08-31','BOTTLE',3,0,'20.00',NULL,NULL,NULL,'2014-05-02 15:02:53',NULL,'admin',NULL),(28,'IN--14000025','1320005','L-20140429-01','2014-08-31','PCS',50,0,'1.00',NULL,NULL,NULL,'2014-05-06 12:11:36',NULL,'admin',NULL),(29,'IN--14000025','1320002','S-20140429-01','2014-09-30','PCS',10,0,'1.00',NULL,NULL,NULL,'2014-05-06 12:11:36',NULL,'admin',NULL),(30,'IN--14000025','1320001','D-20140429-01','2014-08-31','PCS',66,0,'0.90',NULL,NULL,NULL,'2014-05-06 12:11:36',NULL,'admin',NULL);

/*Table structure for table `sm_detail` */

DROP TABLE IF EXISTS `sm_detail`;

CREATE TABLE `sm_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sm_number` varchar(20) NOT NULL,
  `cm_code` varchar(50) DEFAULT NULL,
  `sm_unit` varchar(50) DEFAULT NULL,
  `sm_rate` decimal(20,2) DEFAULT NULL,
  `sm_bonusqty` int(11) DEFAULT NULL,
  `sm_quantity` int(11) DEFAULT NULL,
  `sm_tax_rate` decimal(20,2) DEFAULT NULL,
  `sm_tax_amt` decimal(20,2) DEFAULT NULL,
  `sm_lineamt` decimal(20,2) DEFAULT NULL,
  `inserttime` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `insertuser` varchar(50) DEFAULT NULL,
  `updateuser` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sm_number` (`sm_number`,`cm_code`),
  KEY `cm_code` (`cm_code`),
  CONSTRAINT `sm_detail_ibfk_1` FOREIGN KEY (`cm_code`) REFERENCES `cm_productmaster` (`cm_code`),
  CONSTRAINT `sm_detail_ibfk_2` FOREIGN KEY (`sm_number`) REFERENCES `sm_header` (`sm_number`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

/*Data for the table `sm_detail` */

insert  into `sm_detail`(`id`,`sm_number`,`cm_code`,`sm_unit`,`sm_rate`,`sm_bonusqty`,`sm_quantity`,`sm_tax_rate`,`sm_tax_amt`,`sm_lineamt`,`inserttime`,`updatetime`,`insertuser`,`updateuser`) values (42,'IN--14000003','1320003','BOTTLE','22.00',0,3,'3.00','0.00','66.00','2014-05-02 13:02:00',NULL,'admin',NULL),(43,'IN--14000025','1320005','PCS','2.50',0,50,'3.00','0.00','125.00','2014-05-06 10:06:00',NULL,'admin',NULL),(44,'IN--14000025','1320002','PCS','2.00',0,10,'2.50','0.00','20.00','2014-05-06 10:06:00',NULL,'admin',NULL),(45,'IN--14000025','1320001','PCS','1.30',0,66,'2.50','0.00','85.80','2014-05-06 10:06:00',NULL,'admin',NULL);

/*Table structure for table `sm_header` */

DROP TABLE IF EXISTS `sm_header`;

CREATE TABLE `sm_header` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sm_number` varchar(20) DEFAULT NULL,
  `sm_date` date DEFAULT NULL,
  `cm_cuscode` varchar(20) DEFAULT NULL,
  `sm_sp` varchar(20) DEFAULT NULL,
  `sm_doc_type` varchar(20) DEFAULT NULL,
  `sm_storeid` varchar(20) DEFAULT NULL,
  `sm_territory` varchar(20) DEFAULT NULL,
  `sm_rsm` varchar(20) DEFAULT NULL,
  `sm_area` varchar(20) DEFAULT NULL,
  `sm_payterms` varchar(20) DEFAULT NULL,
  `am_accountcode` varchar(50) DEFAULT NULL,
  `sm_chequeno` varchar(50) DEFAULT NULL,
  `sm_totalamt` decimal(20,2) DEFAULT NULL,
  `sm_total_tax_amt` decimal(20,2) DEFAULT NULL,
  `sm_disc_rate` decimal(20,2) DEFAULT NULL,
  `sm_disc_amt` decimal(20,2) DEFAULT NULL,
  `sm_netamt` decimal(20,2) DEFAULT NULL,
  `sm_sign` int(11) DEFAULT NULL,
  `sm_stataus` varchar(20) DEFAULT NULL,
  `sm_refe_code` varchar(20) DEFAULT NULL,
  `glvoucher` varchar(50) DEFAULT NULL,
  `inserttime` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `insertuser` varchar(20) DEFAULT NULL,
  `updateuser` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sm_number` (`sm_number`),
  KEY `sm_date` (`sm_date`),
  KEY `cm_cuscode` (`cm_cuscode`),
  CONSTRAINT `sm_header_ibfk_1` FOREIGN KEY (`cm_cuscode`) REFERENCES `cm_customermst` (`cm_cuscode`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8;

/*Data for the table `sm_header` */

insert  into `sm_header`(`id`,`sm_number`,`sm_date`,`cm_cuscode`,`sm_sp`,`sm_doc_type`,`sm_storeid`,`sm_territory`,`sm_rsm`,`sm_area`,`sm_payterms`,`am_accountcode`,`sm_chequeno`,`sm_totalamt`,`sm_total_tax_amt`,`sm_disc_rate`,`sm_disc_amt`,`sm_netamt`,`sm_sign`,`sm_stataus`,`sm_refe_code`,`glvoucher`,`inserttime`,`updatetime`,`insertuser`,`updateuser`) values (47,'IN--14000003','2014-05-02','CUS00002','A','Sales','BURUNDI',NULL,NULL,NULL,'Cash',NULL,NULL,'66.00','1.98','0.00','0.00','67.98',1,'Post to GL','IN--14000003','JV--14000001','2014-05-02 13:02:00','2014-05-02 15:03:35','admin','admin'),(48,'MR--14000001','2014-05-02','CUS00002','Fahim Pharma','Receipt','BURUNDI',NULL,NULL,NULL,NULL,'10600','',NULL,NULL,NULL,NULL,'67.98',-1,'Post to GL',NULL,'MRCT14000001','2014-05-02 13:16:00','0000-00-00 00:00:00','admin',''),(54,'IN--14000025','2014-05-06','CUS00003','Z','Sales','BURUNDI',NULL,NULL,NULL,'Cash',NULL,NULL,'230.80','6.40','0.00','0.00','237.20',1,'Delivered','IN--14000025',NULL,'2014-05-06 10:06:00','2014-05-06 12:17:48','admin','admin'),(61,'MR--14000003','2014-05-07','CUS00002','Fahim Pharma','Receipt','BURUNDI',NULL,NULL,NULL,NULL,'10100','',NULL,NULL,NULL,NULL,'2000.00',-1,'Open',NULL,NULL,'2014-05-07 13:41:00','0000-00-00 00:00:00','admin','');

/*Table structure for table `sm_invalc` */

DROP TABLE IF EXISTS `sm_invalc`;

CREATE TABLE `sm_invalc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sm_number` varchar(20) DEFAULT NULL,
  `sm_invnumber` varchar(20) DEFAULT NULL,
  `sm_amount` decimal(20,2) DEFAULT NULL,
  `sm_balanceamt` decimal(20,2) DEFAULT NULL,
  `inserttime` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `insertuser` varchar(20) DEFAULT NULL,
  `updateuser` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sm_number` (`sm_number`,`sm_invnumber`),
  CONSTRAINT `sm_invalc_ibfk_1` FOREIGN KEY (`sm_number`) REFERENCES `sm_header` (`sm_number`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Data for the table `sm_invalc` */

insert  into `sm_invalc`(`id`,`sm_number`,`sm_invnumber`,`sm_amount`,`sm_balanceamt`,`inserttime`,`updatetime`,`insertuser`,`updateuser`) values (10,'MR--14000001','IN--14000003','67.98','0.00','2014-05-02 13:16:00',NULL,'admin',NULL);

/*Table structure for table `tbl_reports` */

DROP TABLE IF EXISTS `tbl_reports`;

CREATE TABLE `tbl_reports` (
  `report_id` int(11) NOT NULL AUTO_INCREMENT,
  `report` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL,
  `host` varchar(100) DEFAULT 'localhost',
  `bd` varchar(20) DEFAULT NULL,
  `ppal_table` varchar(40) NOT NULL,
  `field_key` varchar(40) NOT NULL,
  `sql_query` text,
  `toolbarfilter` int(1) DEFAULT '1',
  `show_title` int(1) DEFAULT '1',
  `manual` int(1) DEFAULT '0',
  `toppager` int(1) DEFAULT '1',
  `width` int(11) DEFAULT '99' COMMENT 'Porcentaje',
  `edit_inline` int(1) DEFAULT '1',
  `edit` int(1) DEFAULT '0',
  `insert_` int(1) DEFAULT '0',
  `delete_` int(1) DEFAULT '0',
  `status` int(1) DEFAULT '1' COMMENT '1 Activo, 0 Inactivo',
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `modified_by` varchar(100) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`report_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_reports` */

insert  into `tbl_reports`(`report_id`,`report`,`description`,`host`,`bd`,`ppal_table`,`field_key`,`sql_query`,`toolbarfilter`,`show_title`,`manual`,`toppager`,`width`,`edit_inline`,`edit`,`insert_`,`delete_`,`status`,`create_by`,`create_date`,`modified_by`,`modified_date`) values (1,'Informes','Informess','localhost','','tbl_reports','report_id','',1,1,1,1,99,1,0,0,1,1,NULL,NULL,NULL,NULL),(2,'Campos Informe','Campos Informe','localhost','','tbl_reports_fields','field_id',NULL,1,0,1,1,99,1,0,0,1,1,NULL,NULL,NULL,NULL),(4,'ui','ui','localhost','ur','cm_productmaster','cm_code','',1,1,0,1,99,1,0,0,0,1,'admin','2013-12-19 12:06:38',NULL,NULL);

/*Table structure for table `tbl_reports_field_type` */

DROP TABLE IF EXISTS `tbl_reports_field_type`;

CREATE TABLE `tbl_reports_field_type` (
  `field_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `field_type` varchar(255) DEFAULT NULL,
  `searchtype` varchar(100) DEFAULT NULL,
  `expreg` varchar(50) DEFAULT NULL,
  `msg_expreg` varchar(255) DEFAULT NULL,
  `comparisons` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`field_type_id`),
  UNIQUE KEY `tipo_campo_id` (`field_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_reports_field_type` */

insert  into `tbl_reports_field_type`(`field_type_id`,`field_type`,`searchtype`,`expreg`,`msg_expreg`,`comparisons`) values (1,'alfabetico','text','[a-zA-ZÑñ]','Debe ingresar solo letras','cn,nc,eq,bw,bn,ni,ew,en,in,ni'),(2,'alfanumerico','text','[a-zA-ZÑñ0-9]','Debe ingresar solo letras o números ','cn,nc,eq,bw,bn,ni,ew,en,in,ni'),(3,'checkbox','text',NULL,NULL,'cn,nc,eq,bw,bn,ni,ew,en,in,ni'),(4,'email','text',NULL,NULL,'cn,nc,eq,bw,bn,ni,ew,en,in,ni'),(5,'date','text',NULL,NULL,'cn,nc,eq,bw,bn,ni,ew,en,in,ni'),(6,'float','number',NULL,NULL,'eq,ne,lt,le,gt,ge,in,ni'),(7,'hidden','text',NULL,NULL,'cn,nc,eq,bw,bn,ni,ew,en,in,ni'),(8,'html','text',NULL,NULL,'cn,nc,eq,bw,bn,ni,ew,en,in,ni'),(9,'combox_array','text',NULL,NULL,'eq'),(10,'combox_table','text',NULL,NULL,'eq'),(11,'numeric','number','[0-9]','Debe ingresar solo números','eq,ne,lt,le,gt,ge,in,ni'),(12,'text','text',NULL,NULL,'cn,nc,eq,bw,bn,ni,ew,en,in,ni'),(13,'currency','number',NULL,NULL,'eq,ne,lt,le,gt,ge,in,ni'),(14,'password','text',NULL,NULL,'cn,nc,eq,bw,bn,ni,ew,en,in,ni'),(15,'radio','text',NULL,NULL,'cn,nc,eq,bw,bn,ni,ew,en,in,ni'),(16,'textarea','text',NULL,NULL,'cn,nc,eq,bw,bn,ni,ew,en,in,ni'),(17,'observations','text',NULL,NULL,'cn,nc,eq,bw,bn,ni,ew,en,in,ni'),(18,'checkboxMultiple','text',NULL,NULL,'cn,nc,eq,bw,bn,ni,ew,en,in,ni'),(19,'percentaje','number',NULL,NULL,'eq,ne,lt,le,gt,ge,in,ni'),(20,'combox_autocomple','text',NULL,NULL,'eq'),(21,'currency_no_decimals','number',NULL,NULL,'eq,ne,lt,le,gt,ge,in,ni');

/*Table structure for table `tbl_reports_fields` */

DROP TABLE IF EXISTS `tbl_reports_fields`;

CREATE TABLE `tbl_reports_fields` (
  `field_id` int(11) NOT NULL AUTO_INCREMENT,
  `report_id` int(11) NOT NULL COMMENT 'Id del informe relacionado con la tabla tbl_informes',
  `table_field` varchar(100) NOT NULL COMMENT 'Nombre de la tabla del campo por lo general es la misma tabla principal ',
  `field` varchar(1000) NOT NULL COMMENT 'Campo tal cual se tomaría del select, puede incluir una sentencia compleja, IF, CASE ect., en ese se marca la casilla select_complejo como true',
  `alias` varchar(30) NOT NULL COMMENT 'alias único de la consulta',
  `label` varchar(500) NOT NULL COMMENT 'Titulo de la columna que se mostrará en la Grid',
  `field_find` varchar(100) NOT NULL COMMENT 'Columna con la tabla por la cual se hará la consulta aplica para cuando se quiere buscar por texto en tablas cruzadas',
  `align` varchar(10) DEFAULT 'left' COMMENT 'Alineación del campo left,rigth,center',
  `field_type_id` int(11) NOT NULL DEFAULT '1' COMMENT 'Id del Tipo de campo que se encuentra en la tabla tbl_p_tipo_campo_form',
  `option_list` varchar(500) DEFAULT NULL COMMENT 'Opcione de las listas estáctica separadas por pipe |',
  `select_sql` varchar(500) DEFAULT NULL COMMENT 'SQL de la consulta a la tabla de opciones',
  `field_id_list` varchar(100) DEFAULT NULL COMMENT 'nombre del campo id del cual se toman los valores dela lista para los campos tipo lista_tabla',
  `field_desc_list` varchar(1000) DEFAULT NULL COMMENT 'nombre del campo descripción del cual se toman las descripción de la lista para los campos tipo lista_tabla',
  `select_complex` int(1) DEFAULT '0' COMMENT 'Si el campo "campo" contiene IF, CASE u otro tipo de sentencia que no sea el campo solo, se debe marcar como verdadero para que funcione la consulta',
  `function_aggregate` varchar(400) DEFAULT NULL COMMENT 'Si ejecuta alguna función agregada tipo MAX, COUNT etc',
  `foreign_table` varchar(40) DEFAULT NULL COMMENT 'Nombre de la tabla a la cual se realizará la relación con la tabla ingresada en el campo ''Tabla'' (LEFT JOIN)',
  `foreign_table_field_id` varchar(100) DEFAULT NULL COMMENT 'Nombre del campo por medio del cual se realiza la relación la relación con el campo ingresada en la opción ''Campo'' (Tabla.Campo = Tabla Foranea.Campo ID Tabla Foranea)',
  `foreign_table_desc` varchar(1000) DEFAULT NULL COMMENT 'Nombre del campo que se mostrará en la consulta',
  `select_filter` varchar(500) DEFAULT '' COMMENT 'En este campo se envia el select completo de la lista, , el primer campo se toma con el ID y el segundo como la Descripción',
  `comparison` varchar(2) DEFAULT 'eq' COMMENT '"eq" => "=","ne" => "<>", "lt" => "<", "le" => "<=","gt" => ">","ge" => ">="',
  `order_by` varchar(4) DEFAULT NULL COMMENT 'Solo se debe colocar el tipo ASC, DESC',
  `group_by` int(1) DEFAULT NULL COMMENT 'Determina si un campo se devuelve para hacer group by',
  `field_where` int(1) DEFAULT NULL COMMENT 'Indica si a una consulta se le aplica where a traves de éste campo',
  `find_form` int(1) DEFAULT NULL COMMENT 'Indica si es un filtro del formulario de busqueda',
  `show_in_grid` int(1) DEFAULT '1' COMMENT '1 Si, 0 No',
  `show_in_form` int(1) DEFAULT '0',
  `group_header` varchar(400) DEFAULT NULL COMMENT 'Nombre de la columna agrupadas a partir de esta',
  `group_header_columns` int(11) DEFAULT NULL COMMENT 'Número de columnas a agrupar a partir de esta',
  `frozen_column` int(1) DEFAULT NULL COMMENT 'Si la columna se inmoviliza cuando se desplazan a la derecha',
  `order_field` int(11) DEFAULT NULL COMMENT 'Orden en que se toman las variables',
  `width` int(5) DEFAULT NULL,
  `width_column` int(11) DEFAULT '10' COMMENT 'Ancho de la columna en la grid',
  `editable` int(1) DEFAULT '1' COMMENT 'Si el campo es editable o no 0 ó 1',
  `required` int(1) DEFAULT NULL COMMENT 'Si el campo es requerido al momento de la edición',
  `max_length` int(3) DEFAULT NULL COMMENT 'Longitud máxima del campo para cuando es edición',
  `val_min` int(11) DEFAULT NULL,
  `val_max` int(11) DEFAULT NULL,
  `expreg` varchar(100) DEFAULT NULL,
  `search` int(1) DEFAULT '1',
  `searchrules` varchar(300) DEFAULT NULL,
  `field_rel_id` int(11) DEFAULT NULL,
  `text_help` varchar(1500) DEFAULT NULL,
  `js` text,
  `readonly` int(11) DEFAULT '0',
  `defaultvalue` varchar(100) DEFAULT NULL,
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `modified_by` varchar(100) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`field_id`),
  KEY `report_id` (`report_id`) USING BTREE,
  KEY `field_type_id` (`field_type_id`),
  CONSTRAINT `tbl_reports_fields_ibfk_1` FOREIGN KEY (`report_id`) REFERENCES `tbl_reports` (`report_id`),
  CONSTRAINT `tbl_reports_fields_ibfk_2` FOREIGN KEY (`field_type_id`) REFERENCES `tbl_reports_field_type` (`field_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_reports_fields` */

insert  into `tbl_reports_fields`(`field_id`,`report_id`,`table_field`,`field`,`alias`,`label`,`field_find`,`align`,`field_type_id`,`option_list`,`select_sql`,`field_id_list`,`field_desc_list`,`select_complex`,`function_aggregate`,`foreign_table`,`foreign_table_field_id`,`foreign_table_desc`,`select_filter`,`comparison`,`order_by`,`group_by`,`field_where`,`find_form`,`show_in_grid`,`show_in_form`,`group_header`,`group_header_columns`,`frozen_column`,`order_field`,`width`,`width_column`,`editable`,`required`,`max_length`,`val_min`,`val_max`,`expreg`,`search`,`searchrules`,`field_rel_id`,`text_help`,`js`,`readonly`,`defaultvalue`,`create_by`,`create_date`,`modified_by`,`modified_date`) values (1,1,'tbl_reports','report','report','Informe','','left',12,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,1,1,1,NULL,NULL,NULL,1,40,13,1,1,NULL,NULL,NULL,'[a-zA-Z0-9_.áéíóúÁÉÍÓÚ]',1,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL),(2,1,'tbl_reports','description','description','Descripción','','left',12,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,1,1,NULL,NULL,NULL,2,40,15,1,1,NULL,NULL,NULL,'[a-zA-Z0-9_.áéíóúÁÉÍÓÚ]',1,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL),(3,1,'tbl_reports','ppal_table','ppal_table','Tabla Ppal','','left',12,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,1,1,NULL,NULL,NULL,3,20,15,1,1,NULL,NULL,NULL,'[a-zA-ZÑñ0-9 _]',1,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL),(4,1,'tbl_reports','field_key','field_key','Campo Clave','','left',12,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,1,1,NULL,NULL,NULL,4,15,11,1,1,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL),(5,1,'tbl_reports','bd','bd','Base de Datos','','left',9,'testdrive|TestDrive',NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,'eq',NULL,0,0,0,1,1,NULL,NULL,NULL,22,30,11,1,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL),(6,1,'tbl_reports','toppager','toppager','Paginación Top','','left',3,'','','','',0,'','','','','','eq','',NULL,NULL,NULL,0,1,NULL,NULL,NULL,37,NULL,10,1,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL),(7,1,'tbl_reports','edit','editar','Editar','','left',3,'','','','',0,'','','','','','eq','',NULL,NULL,NULL,0,1,'',NULL,NULL,37,NULL,10,1,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL),(8,1,'tbl_reports','insert_','insertar','Insertar','','left',3,'','','','',0,'','','','','','eq','',NULL,NULL,NULL,0,1,'',NULL,NULL,37,NULL,10,1,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL),(9,1,'tbl_reports','delete_','eliminar','Eliminar','','left',3,'','','','',0,'','','','','','eq','',NULL,NULL,NULL,0,1,'',NULL,NULL,37,NULL,10,1,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL),(10,2,'tbl_reports_fields','report_id','report_id','Informe','','left',10,NULL,'SELECT report_id, report FROM tbl_reports','report_id','report',0,NULL,'tbl_reports','report_id','report','SELECT report_id, report FROM tbl_reports',NULL,NULL,NULL,1,NULL,1,1,NULL,NULL,NULL,1,NULL,13,1,1,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL),(11,2,'tbl_reports_fields','table_field','table_field','Tabla','','left',1,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,0,NULL,1,1,NULL,NULL,NULL,2,NULL,24,1,1,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL),(12,2,'tbl_reports_fields','field','field','Campo','','left',16,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,'',NULL,'ASC',0,0,0,1,1,NULL,NULL,NULL,3,50,8,1,1,NULL,NULL,NULL,'[a-zA-Z0-9_.\'(),-=]',1,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL),(13,2,'tbl_reports_fields','alias','alias','Alias','','left',12,'',NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,0,1,1,NULL,NULL,NULL,4,NULL,10,1,1,NULL,NULL,NULL,'[a-zA-Z0-9_.]',1,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL),(14,2,'tbl_reports_fields','label','label','Label','','left',12,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,0,0,1,1,NULL,NULL,NULL,5,NULL,8,1,1,NULL,NULL,NULL,'[a-zA-Z0-9_.áéíóúÁÉÍÓÚ]',1,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL),(15,2,'tbl_reports_fields','field_type_id','field_type_id','Tipo de Campo','','left',10,NULL,'SELECT field_type_id, field_type  FROM tbl_reports_field_type','field_type_id','field_type',0,'','tbl_reports_field_type','field_type_id','field_type','',NULL,NULL,NULL,NULL,NULL,1,1,NULL,NULL,NULL,6,NULL,10,1,1,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,'//10 = lista_estatica\r\n//11 = lista_tabla\r\n$(\'#tbl_informes_campo-opciones_lista\').attr(\'disabled\',\'disabled\'); \r\n$(\'#tbl_informes_campo-campo_id_lista\').val(\'\'); \r\n$(\'#tbl_informes_campo-campo_id_lista\').attr(\'disabled\',\'disabled\'); \r\n$(\'#tbl_informes_campo-campo_desc_lista\').val(\'\'); \r\n$(\'#tbl_informes_campo-campo_desc_lista\').attr(\'disabled\',\'disabled\'); \r\n$(\'#tbl_informes_campo-select_sql\').val(\'\'); \r\n$(\'#tbl_informes_campo-select_sql\').attr(\'disabled\',\'disabled\');\r\n\r\nif($(\'#tbl_informes_campo-tipo_campo_id\').val() == \'10\'){\r\n  $(\'#tbl_informes_campo-opciones_lista\').removeAttr(\'disabled\');\r\n}else if($(\'#tbl_informes_campo-tipo_campo_id\').val() == \'11\'){ \r\n    $(\'#tbl_informes_campo-opciones_lista\').val(\'\'); \r\n  $(\'#tbl_informes_campo-campo_id_lista\').removeAttr(\'disabled\');\r\n  $(\'#tbl_informes_campo-campo_desc_lista\').removeAttr(\'disabled\');\r\n  $(\'#tbl_informes_campo-select_sql\').removeAttr(\'disabled\');\r\n}',0,NULL,NULL,NULL,NULL,NULL),(16,2,'tbl_reports_fields','foreign_table','foreign_table','Tabla Foranea','','left',12,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,1,1,NULL,NULL,NULL,24,NULL,10,1,NULL,NULL,NULL,NULL,'[a-zA-Z0-9_.]',1,NULL,NULL,'Nombre de la tabla a la cual se realizará la relación con la tabla ingresada en el campo \'Tabla\' (LEFT JOIN)',NULL,0,NULL,NULL,NULL,NULL,NULL),(17,2,'tbl_reports_fields','foreign_table_field_id','foreign_table_field_id','Campo ID Tabla Foranea','','left',12,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,1,1,NULL,NULL,NULL,25,NULL,10,1,NULL,NULL,NULL,NULL,'[a-zA-Z0-9_.]',1,NULL,NULL,'Nombre del campo por medio del cual se realiza la relación la relación con el campo ingresada en la opción \'Campo\' (Tabla.Campo = Tabla Foranea.Campo ID Tabla Foranea)',NULL,0,NULL,NULL,NULL,NULL,NULL),(18,2,'tbl_reports_fields','foreign_table_desc','foreign_table_desc','Campo Desc. Tabla Foranea','','left',12,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,1,1,NULL,NULL,NULL,26,NULL,10,1,NULL,NULL,NULL,NULL,'[a-zA-Z0-9_.]',1,NULL,NULL,'Nombre del campo que se mostrará en la consulta',NULL,0,NULL,NULL,NULL,NULL,NULL),(19,2,'tbl_reports_fields','order_field','order_field','Orden','','left',11,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,0,1,1,NULL,NULL,NULL,7,4,5,1,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL),(86,4,'cm_productmaster','cm_name','cm_name','Cm name','','left',1,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,'','eq',NULL,NULL,NULL,NULL,1,0,NULL,NULL,NULL,0,NULL,10,1,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,0,NULL,'admin','2013-12-19 12:06:38',NULL,NULL),(87,4,'cm_productmaster','cm_description','cm_description','Cm description','','left',1,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,'','eq',NULL,NULL,NULL,NULL,1,0,NULL,NULL,NULL,1,NULL,10,1,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,0,NULL,'admin','2013-12-19 12:06:38',NULL,NULL),(88,4,'cm_productmaster','cm_class','cm_class','Cm class','','left',1,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,'','eq',NULL,NULL,NULL,NULL,1,0,NULL,NULL,NULL,2,NULL,10,1,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,0,NULL,'admin','2013-12-19 12:06:38',NULL,NULL),(89,4,'cm_productmaster','cm_group','cm_group','Cm group','','left',1,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,'','eq',NULL,NULL,NULL,NULL,1,0,NULL,NULL,NULL,3,NULL,10,1,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,0,NULL,'admin','2013-12-19 12:06:38',NULL,NULL),(90,4,'cm_productmaster','cm_category','cm_category','Cm category','','left',1,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,'','eq',NULL,NULL,NULL,NULL,1,0,NULL,NULL,NULL,4,NULL,10,1,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,0,NULL,'admin','2013-12-19 12:06:38',NULL,NULL),(91,4,'cm_productmaster','cm_sellrate','cm_sellrate','Cm sellrate','','left',1,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,'','eq',NULL,NULL,NULL,NULL,1,0,NULL,NULL,NULL,5,NULL,10,1,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,0,NULL,'admin','2013-12-19 12:06:38',NULL,NULL),(92,4,'cm_productmaster','cm_costprice','cm_costprice','Cm costprice','','left',1,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,'','eq',NULL,NULL,NULL,NULL,1,0,NULL,NULL,NULL,6,NULL,10,1,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,0,NULL,'admin','2013-12-19 12:06:38',NULL,NULL),(93,4,'cm_productmaster','cm_sellunit','cm_sellunit','Cm sellunit','','left',1,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,'','eq',NULL,NULL,NULL,NULL,1,0,NULL,NULL,NULL,7,NULL,10,1,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,0,NULL,'admin','2013-12-19 12:06:38',NULL,NULL),(94,4,'cm_productmaster','cm_sellconfact','cm_sellconfact','Cm sellconfact','','left',1,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,'','eq',NULL,NULL,NULL,NULL,1,0,NULL,NULL,NULL,8,NULL,10,1,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,0,NULL,'admin','2013-12-19 12:06:38',NULL,NULL),(95,4,'cm_productmaster','cm_purunit','cm_purunit','Cm purunit','','left',1,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,'','eq',NULL,NULL,NULL,NULL,1,0,NULL,NULL,NULL,9,NULL,10,1,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,0,NULL,'admin','2013-12-19 12:06:38',NULL,NULL),(96,4,'cm_productmaster','cm_purconfact','cm_purconfact','Cm purconfact','','left',1,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,'','eq',NULL,NULL,NULL,NULL,1,0,NULL,NULL,NULL,10,NULL,10,1,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,0,NULL,'admin','2013-12-19 12:06:38',NULL,NULL),(97,4,'cm_productmaster','cm_stkunit','cm_stkunit','Cm stkunit','','left',1,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,'','eq',NULL,NULL,NULL,NULL,1,0,NULL,NULL,NULL,11,NULL,10,1,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,0,NULL,'admin','2013-12-19 12:06:38',NULL,NULL),(98,4,'cm_productmaster','cm_stkconfac','cm_stkconfac','Cm stkconfac','','left',1,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,'','eq',NULL,NULL,NULL,NULL,1,0,NULL,NULL,NULL,12,NULL,10,1,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,0,NULL,'admin','2013-12-19 12:06:38',NULL,NULL),(99,4,'cm_productmaster','cm_packsize','cm_packsize','Cm packsize','','left',1,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,'','eq',NULL,NULL,NULL,NULL,1,0,NULL,NULL,NULL,13,NULL,10,1,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,0,NULL,'admin','2013-12-19 12:06:38',NULL,NULL),(100,4,'cm_productmaster','cm_stocktype','cm_stocktype','Cm stocktype','','left',1,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,'','eq',NULL,NULL,NULL,NULL,1,0,NULL,NULL,NULL,14,NULL,10,1,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,0,NULL,'admin','2013-12-19 12:06:38',NULL,NULL),(101,4,'cm_productmaster','cm_generic','cm_generic','Cm generic','','left',1,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,'','eq',NULL,NULL,NULL,NULL,1,0,NULL,NULL,NULL,15,NULL,10,1,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,0,NULL,'admin','2013-12-19 12:06:38',NULL,NULL),(102,4,'cm_productmaster','cm_supplierid','cm_supplierid','Cm supplierid','','left',1,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,'','eq',NULL,NULL,NULL,NULL,1,0,NULL,NULL,NULL,16,NULL,10,1,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,0,NULL,'admin','2013-12-19 12:06:38',NULL,NULL),(103,4,'cm_productmaster','cm_mfgcode','cm_mfgcode','Cm mfgcode','','left',1,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,'','eq',NULL,NULL,NULL,NULL,1,0,NULL,NULL,NULL,17,NULL,10,1,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,0,NULL,'admin','2013-12-19 12:06:38',NULL,NULL),(104,4,'cm_productmaster','cm_maxlevel','cm_maxlevel','Cm maxlevel','','left',11,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,'','eq',NULL,NULL,NULL,NULL,1,0,NULL,NULL,NULL,18,NULL,10,1,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,0,NULL,'admin','2013-12-19 12:06:38',NULL,NULL),(105,4,'cm_productmaster','cm_minlevel','cm_minlevel','Cm minlevel','','left',11,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,'','eq',NULL,NULL,NULL,NULL,1,0,NULL,NULL,NULL,19,NULL,10,1,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,0,NULL,'admin','2013-12-19 12:06:38',NULL,NULL),(106,4,'cm_productmaster','cm_reorder','cm_reorder','Cm reorder','','left',11,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,'','eq',NULL,NULL,NULL,NULL,1,0,NULL,NULL,NULL,20,NULL,10,1,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,0,NULL,'admin','2013-12-19 12:06:38',NULL,NULL),(107,4,'cm_productmaster','inserttime','inserttime','Inserttime','','left',1,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,'','eq',NULL,NULL,NULL,NULL,1,0,NULL,NULL,NULL,21,NULL,10,1,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,0,NULL,'admin','2013-12-19 12:06:38',NULL,NULL),(108,4,'cm_productmaster','updatetime','updatetime','Updatetime','','left',1,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,'','eq',NULL,NULL,NULL,NULL,1,0,NULL,NULL,NULL,22,NULL,10,1,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,0,NULL,'admin','2013-12-19 12:06:38',NULL,NULL),(109,4,'cm_productmaster','insertuser','insertuser','Insertuser','','left',1,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,'','eq',NULL,NULL,NULL,NULL,1,0,NULL,NULL,NULL,23,NULL,10,1,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,0,NULL,'admin','2013-12-19 12:06:38',NULL,NULL),(110,4,'cm_productmaster','updateuser','updateuser','Updateuser','','left',1,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,'','eq',NULL,NULL,NULL,NULL,1,0,NULL,NULL,NULL,24,NULL,10,1,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,0,NULL,'admin','2013-12-19 12:06:38',NULL,NULL);

/*Table structure for table `tbl_reports_permissions` */

DROP TABLE IF EXISTS `tbl_reports_permissions`;

CREATE TABLE `tbl_reports_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `report_id` int(11) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `view_` int(1) DEFAULT '1',
  `insert_` int(1) DEFAULT '1',
  `edit` int(1) DEFAULT '1',
  `delete_` int(1) DEFAULT '1',
  `excel` int(1) DEFAULT '1',
  `pdf` int(1) DEFAULT '1',
  `word` int(1) DEFAULT '1',
  `txt` int(1) DEFAULT '1',
  `edit_label` int(1) DEFAULT '0',
  `edit_help` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `report_id` (`report_id`,`username`) USING BTREE,
  KEY `usuario_id` (`username`),
  CONSTRAINT `tbl_reports_permissions_ibfk_4` FOREIGN KEY (`report_id`) REFERENCES `tbl_reports` (`report_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_reports_permissions` */

insert  into `tbl_reports_permissions`(`id`,`report_id`,`username`,`view_`,`insert_`,`edit`,`delete_`,`excel`,`pdf`,`word`,`txt`,`edit_label`,`edit_help`) values (1,1,'admin',1,1,1,1,1,1,1,1,0,0),(2,2,'admin',1,1,1,1,1,1,1,1,0,0),(3,4,'admin',1,0,0,0,1,1,1,1,0,0);

/*Table structure for table `tbl_reports_permissions_roles` */

DROP TABLE IF EXISTS `tbl_reports_permissions_roles`;

CREATE TABLE `tbl_reports_permissions_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `report_id` int(11) DEFAULT NULL,
  `rol_id` int(11) DEFAULT NULL,
  `view_` int(1) DEFAULT '1',
  `insert_` int(1) DEFAULT '1',
  `edit` int(1) DEFAULT '1',
  `delete_` int(1) DEFAULT '1',
  `excel` int(1) DEFAULT '1',
  `pdf` int(1) DEFAULT '1',
  `word` int(1) DEFAULT '1',
  `txt` int(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `report_id` (`report_id`,`rol_id`) USING BTREE,
  KEY `rol_id` (`rol_id`),
  CONSTRAINT `tbl_reports_permissions_roles_ibfk_2` FOREIGN KEY (`rol_id`) REFERENCES `tbl_roles` (`rol_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_reports_permissions_roles_ibfk_5` FOREIGN KEY (`report_id`) REFERENCES `tbl_reports` (`report_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_reports_permissions_roles` */

insert  into `tbl_reports_permissions_roles`(`id`,`report_id`,`rol_id`,`view_`,`insert_`,`edit`,`delete_`,`excel`,`pdf`,`word`,`txt`) values (1,1,1,1,1,1,1,1,1,1,1),(2,2,1,1,1,1,1,1,1,1,1),(3,4,1,1,0,0,0,1,1,1,1);

/*Table structure for table `tbl_roles` */

DROP TABLE IF EXISTS `tbl_roles`;

CREATE TABLE `tbl_roles` (
  `rol_id` int(11) NOT NULL AUTO_INCREMENT,
  `rol` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`rol_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_roles` */

insert  into `tbl_roles`(`rol_id`,`rol`) values (1,'Administrator');

/*Table structure for table `tbl_users` */

DROP TABLE IF EXISTS `tbl_users`;

CREATE TABLE `tbl_users` (
  `username` varchar(100) NOT NULL DEFAULT '',
  `name` varchar(100) DEFAULT NULL,
  `rol_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `username` (`username`),
  KEY `rol_id` (`rol_id`),
  CONSTRAINT `tbl_users_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `tbl_roles` (`rol_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tbl_users` */

insert  into `tbl_users`(`username`,`name`,`rol_id`) values ('admin','admin',1);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `employeeid` varchar(10) NOT NULL,
  `employeebranch` varchar(20) NOT NULL,
  `activkey` varchar(128) NOT NULL DEFAULT '',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastvisit_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `superuser` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `status` (`status`),
  KEY `superuser` (`superuser`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`password`,`email`,`employeeid`,`employeebranch`,`activkey`,`create_at`,`lastvisit_at`,`superuser`,`status`) values (1,'admin','21232f297a57a5a743894a0e4a801fc3','webmaster@example.com','admin','BURUNDI','9a24eff8c15a6a141ece27eb6947da0f','2013-11-24 14:01:06','2013-11-26 01:39:29',1,1),(2,'demo','fe01ce2a7fbac8fafaed7c982a04e229','demo@example.com','demo','Haiti','099f825543f7850cc038b90aaff39fac','2013-11-24 14:01:06','2014-03-07 03:14:10',0,1),(3,'selim','f48ac822376a54dbe8667a5b3a649058','me@selimreza.com','selim','Uganda','4384f6ea25ed45e12be752b639e69328','2013-11-24 09:38:23','2014-01-18 11:27:18',0,1),(8,'maarten','c0b69b2a1fa5d216edbb43fd2758fb0b','maarten@healthyentrepreneurs.nl','','001','32d27fd7c58751b40184ba991dad6562','2014-04-03 04:14:13','0000-00-00 00:00:00',1,1),(9,'Cees','e7c83c5df7cc44681d872b63f96da820','cees@healthyentrepreneurs.nl','','Rwanda','477d23c26e7f87afc789a86e133432f3','2014-05-07 09:20:40','0000-00-00 00:00:00',1,1);

/* Trigger structure for table `am_voucherdetail` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tr_voucherdt_insert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'%' */ /*!50003 TRIGGER `tr_voucherdt_insert` AFTER INSERT ON `am_voucherdetail` FOR EACH ROW BEGIN
			update am_vouhcerheader as a
			set a.am_status=(select case when sum(am_primeamt)=0 then 'Balanced' else 'Suspend' end 
											 from am_voucherdetail 
											 where am_vouchernumber=new.am_vouchernumber
											 group by am_vouchernumber)
			where am_vouchernumber=new.am_vouchernumber;
    end */$$


DELIMITER ;

/* Trigger structure for table `am_voucherdetail` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tr_voucherdt_update` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'%' */ /*!50003 TRIGGER `tr_voucherdt_update` AFTER UPDATE ON `am_voucherdetail` FOR EACH ROW BEGIN
			UPDATE am_vouhcerheader AS a
			SET a.am_status=(SELECT CASE WHEN SUM(am_primeamt)=0 THEN 'Balanced' ELSE 'Suspend' END 
											 FROM am_voucherdetail 
											 WHERE am_vouchernumber=new.am_vouchernumber
											 GROUP BY am_vouchernumber)
			WHERE am_vouchernumber=new.am_vouchernumber;
    END */$$


DELIMITER ;

/* Trigger structure for table `im_grndetail` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tr_im_grndetail_insert_bf` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'%' */ /*!50003 TRIGGER `tr_im_grndetail_insert_bf` BEFORE INSERT ON `im_grndetail` FOR EACH ROW BEGIN
			DECLARE vTaxRate DECIMAL(20,2);
			
			/*Tax rate and tax amount collection from purchase order. because tax already calcuted in purchase order*/
			SELECT a.pp_taxrate INTO vTaxRate
			FROM pp_purchaseorddt a
			INNER JOIN im_grnheader b ON a.pp_purordnum=b.im_purordnum
			WHERE a.cm_code=new.cm_code AND b.im_grnnumber=new.im_grnnumber;			
			
			/*Update self by tax rate and tax amount*/
			SET new.im_rowamount=ROUND((new.im_RcvQuantity*new.im_costprice),2);
			SET new.im_taxrate=vTaxRate;
			SET new.im_taxamt=new.im_rowamount-ROUND(new.im_rowamount/((vTaxRate+100)/100),2);
	
		END */$$


DELIMITER ;

/* Trigger structure for table `im_grndetail` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tr_im_grndetail_insert_af` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'%' */ /*!50003 TRIGGER `tr_im_grndetail_insert_af` AFTER INSERT ON `im_grndetail` FOR EACH ROW BEGIN
			DECLARE vAvgTaxRate DECIMAL(10,2);
			declare vPoNumber varchar(50);
			
			/*Purchase order detail updated grn quantity*/
			SELECT im_purordnum into vPoNumber
			FROM im_grnheader WHERE im_grnnumber=new.im_grnnumber;
			
			UPDATE pp_purchaseorddt 
			SET pp_grnqty=(SELECT SUM(im_RcvQuantity) 
				       FROM im_grnheader a, im_grndetail b
				       WHERE a.im_grnnumber=b.im_grnnumber 
						AND a.im_purordnum=vPoNumber 
						AND b.cm_code=new.cm_code) 
			WHERE pp_purordnum=vPoNumber AND cm_code=new.cm_code;
						
			/*Purchase order update by Status Received=Full Received*/
			UPDATE pp_purchaseordhd AS a
			INNER JOIN im_grnheader AS b ON a.pp_purordnum=b.im_purordnum
			SET pp_status=(SELECT CASE WHEN (SUM(pp_quantity)-SUM(pp_grnqty))>0 THEN 'Part Received' ELSE 'Received' END AS pp_status
										 FROM pp_purchaseorddt a 
										 INNER JOIN im_grnheader b ON a.pp_purordnum=b.im_purordnum
										 WHERE b.im_grnnumber=new.im_grnnumber
										 GROUP BY a.pp_purordnum)
			WHERE b.im_grnnumber=new.im_grnnumber;
			
			/*Finding vAVG Tex rate*/
			SELECT CONVERT(SUM(im_taxrate)/COUNT(im_grnnumber), DECIMAL(10,2)) INTO vAvgTaxRate
			FROM im_grndetail 
			WHERE im_grnnumber=new.im_grnnumber
			GROUP BY im_grnnumber;
			
			/*GRN Header table update by net, tax and total amount*/
			UPDATE im_grnheader a
			LEFT JOIN(SELECT im_grnnumber, SUM(im_taxamt) AS taxamt, SUM(im_rowamount) AS rowamt
								FROM im_grndetail
								WHERE im_grnnumber=new.im_grnnumber
								GROUP BY im_grnnumber) b ON a.im_grnnumber=b.im_grnnumber
			SET a.im_taxamt=b.taxamt, 
					a.im_amount=b.rowamt, 
					a.im_netamt=b.rowamt-b.taxamt,
					a.im_taxrate=vAvgTaxRate
			WHERE a.im_grnnumber=new.im_grnnumber;
			
		END */$$


DELIMITER ;

/* Trigger structure for table `im_grndetail` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tr_im_grndetail_update_bf` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'%' */ /*!50003 TRIGGER `tr_im_grndetail_update_bf` BEFORE UPDATE ON `im_grndetail` FOR EACH ROW BEGIN
			DECLARE vTaxRate DECIMAL(20,2);
			
			/*Tax rate and tax amount collection from purchase order. because tax already calcuted in purchase order*/
			SELECT a.pp_taxrate INTO vTaxRate
			FROM pp_purchaseorddt a
			INNER JOIN im_grnheader b ON a.pp_purordnum=b.im_purordnum
			WHERE a.cm_code=new.cm_code AND b.im_grnnumber=new.im_grnnumber;			
			
			/*Update self by tax rate and tax amount*/
			SET new.im_rowamount=ROUND((new.im_RcvQuantity*new.im_costprice),2);
			SET new.im_taxrate=vTaxRate;
			SET new.im_taxamt=new.im_rowamount-ROUND(new.im_rowamount/((vTaxRate+100)/100),2);
				
		END */$$


DELIMITER ;

/* Trigger structure for table `im_grndetail` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tr_im_grndetail_update_af` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'%' */ /*!50003 TRIGGER `tr_im_grndetail_update_af` AFTER UPDATE ON `im_grndetail` FOR EACH ROW BEGIN
			DECLARE vAvgTaxRate DECIMAL(10,2);
			
			/*Purchase order detail updated grn quantity*/
			UPDATE pp_purchaseorddt AS a
			INNER JOIN im_grnheader AS b ON a.pp_purordnum=b.im_purordnum
			SET a.pp_grnqty=IFNULL(a.pp_grnqty,0)+new.im_RcvQuantity
			WHERE a.cm_code=new.cm_code AND b.im_grnnumber=new.im_grnnumber;
			
			/*Purchase order update by Status Received=Full Received*/
			UPDATE pp_purchaseordhd AS a
			INNER JOIN im_grnheader AS b ON a.pp_purordnum=b.im_purordnum
			SET pp_status=(SELECT CASE WHEN (SUM(pp_quantity)-SUM(pp_grnqty))>0 THEN 'Part Received' ELSE 'Received' END AS pp_status
										 FROM pp_purchaseorddt a 
										 INNER JOIN im_grnheader b ON a.pp_purordnum=b.im_purordnum
										 WHERE b.im_grnnumber=new.im_grnnumber
										 GROUP BY a.pp_purordnum)
			WHERE b.im_grnnumber=new.im_grnnumber;
			/*Finding vAVG Tex rate*/
			SELECT CONVERT(SUM(im_taxrate)/COUNT(im_grnnumber), DECIMAL(10,2)) INTO vAvgTaxRate
			FROM im_grndetail 
			WHERE im_grnnumber=new.im_grnnumber
			GROUP BY im_grnnumber;
						
			/*GRN Header table update by net, tax and total amount*/
			UPDATE im_grnheader a
			LEFT JOIN(SELECT im_grnnumber, SUM(im_taxamt) AS taxamt, SUM(im_rowamount) AS rowamt
								FROM im_grndetail
								WHERE im_grnnumber=new.im_grnnumber
								GROUP BY im_grnnumber) b ON a.im_grnnumber=b.im_grnnumber
			SET a.im_taxamt=b.taxamt, 
					a.im_amount=b.rowamt, 
					a.im_netamt=b.rowamt-b.taxamt,
					a.im_taxrate=vAvgTaxRate
			WHERE a.im_grnnumber=new.im_grnnumber;    
			
		END */$$


DELIMITER ;

/* Trigger structure for table `im_transferdt` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tr_im_batchtransfer_insert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `tr_im_batchtransfer_insert` AFTER INSERT ON `im_transferdt` FOR EACH ROW BEGIN
			DECLARE v_FromStore VARCHAR(50);
			DECLARE v_IssueQty INT;
			DECLARE v_Date DATE;
			DECLARE v_Unit VARCHAR(50);
			
			DECLARE v_Batch VARCHAR(50);
			DECLARE v_ExpDate DATE;
			DECLARE v_Rate DECIMAL(20,2);
			DECLARE v_AvlQty INT;
			
			DECLARE No_DATA INT DEFAULT 0;
			
			DECLARE CurBatch CURSOR FOR
			SELECT im_BatchNumber,im_ExpireDate,im_rate,Available
			FROM im_vw_stock
			WHERE cm_code=new.cm_code AND im_storeid=v_FromStore AND im_ExpireDate>v_Date AND Available>0
			GROUP BY im_ExpireDate;
			
			DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET NO_DATA=-2;
			DECLARE CONTINUE HANDLER FOR NOT FOUND SET NO_DATA=-1;
			
			SET v_IssueQty=new.im_quantity;
			SET v_Unit=new.im_unit;
			SELECT im_fromstore, im_date INTO v_FromStore, v_Date FROM im_transferhd WHERE im_transfernum=new.im_transfernum;
			
			OPEN CurBatch;
			FETCH FROM CurBatch INTO v_Batch, v_ExpDate, v_Rate, v_AvlQty;
			a: WHILE NO_DATA=0 DO -- 1
			
				IF v_AvlQty>=v_IssueQty THEN
					INSERT INTO im_batchtransfer
					(im_transfernum, cm_code, im_BatchNumber, im_ExpDate, im_quantity, im_unit, im_rate, inserttime, insertuser)
					VALUES
					(new.im_transfernum, new.cm_code, v_Batch, v_ExpDate, v_IssueQty, v_Unit, v_Rate, CURRENT_TIMESTAMP,new.insertuser);
					LEAVE a;
				ELSEIF v_IssueQty>v_AvlQty THEN
					INSERT INTO im_batchtransfer
					(im_transfernum, cm_code, im_BatchNumber, im_ExpDate, im_quantity, im_unit, im_rate, inserttime, insertuser)
					VALUES
					(new.im_transfernum, new.cm_code, v_Batch, v_ExpDate, v_AvlQty, v_Unit, v_Rate, CURRENT_TIMESTAMP,new.insertuser);
					SET v_IssueQty=v_IssueQty-v_AvlQty;
				END IF;
				
			FETCH FROM CurBatch INTO v_Batch, v_ExpDate, v_Rate, v_AvlQty;
			END WHILE; -- 1
			CLOSE CurBatch;
    END */$$


DELIMITER ;

/* Trigger structure for table `im_transferdt` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tr_im_batchtransfer_update` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `tr_im_batchtransfer_update` AFTER UPDATE ON `im_transferdt` FOR EACH ROW BEGIN
			DECLARE v_FromStore VARCHAR(50);
			DECLARE v_IssueQty INT;
			DECLARE v_Date DATE;
			DECLARE v_Unit VARCHAR(50);
			
			DECLARE v_Batch VARCHAR(50);
			DECLARE v_ExpDate DATE;
			DECLARE v_Rate DECIMAL(20,2);
			DECLARE v_AvlQty INT;
			
			DECLARE No_DATA INT DEFAULT 0;
			
			DECLARE CurBatch CURSOR FOR
			SELECT im_BatchNumber,im_ExpireDate,im_rate,Available
			FROM im_vw_Stock
			WHERE cm_code=new.cm_code AND im_storeid=v_FromStore AND im_ExpireDate>v_Date AND Available>0
			GROUP BY im_ExpireDate;
			
			DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET NO_DATA=-2;
			DECLARE CONTINUE HANDLER FOR NOT FOUND SET NO_DATA=-1;
			DELETE FROM im_BatchTransfer WHERE im_transfernum=old.im_transfernum AND cm_code=old.cm_code;
						
			SET v_IssueQty=new.im_quantity;
			SET v_Unit=new.im_unit;
			SELECT im_fromstore, im_date INTO v_FromStore, v_Date FROM im_transferhd WHERE im_transfernum=new.im_transfernum;
			
			OPEN CurBatch;
			FETCH FROM CurBatch INTO v_Batch, v_ExpDate, v_Rate, v_AvlQty;
			a: WHILE NO_DATA=0 DO -- 1
			
				IF v_AvlQty>=v_IssueQty THEN
					INSERT INTO im_BatchTransfer
					(im_transfernum, cm_code, im_BatchNumber, im_ExpDate, im_quantity, im_unit, im_rate, inserttime, insertuser)
					VALUES
					(new.im_transfernum, new.cm_code, v_Batch, v_ExpDate, v_IssueQty, v_Unit, v_Rate, CURRENT_TIMESTAMP,new.insertuser);
					LEAVE a;
				ELSEIF v_IssueQty>v_AvlQty THEN
					INSERT INTO im_BatchTransfer
					(im_transfernum, cm_code, im_BatchNumber, im_ExpDate, im_quantity, im_unit, im_rate, inserttime, insertuser)
					VALUES
					(new.im_transfernum, new.cm_code, v_Batch, v_ExpDate, v_AvlQty, v_Unit, v_Rate, CURRENT_TIMESTAMP,new.insertuser);
					SET v_IssueQty=v_IssueQty-v_AvlQty;
				END IF;
				
			FETCH FROM CurBatch INTO v_Batch, v_ExpDate, v_Rate, v_AvlQty;
			END WHILE; -- 1
			CLOSE CurBatch;
    END */$$


DELIMITER ;

/* Trigger structure for table `im_transferdt` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tr_im_batchtransfer_delete` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `tr_im_batchtransfer_delete` AFTER DELETE ON `im_transferdt` FOR EACH ROW BEGIN
  IF EXISTS(SELECT 1 FROM im_transferdt WHERE im_transfernum=old.im_transfernum AND cm_code=old.cm_code) THEN
    DELETE FROM im_BatchTransfer WHERE im_transfernum=old.im_transfernum AND cm_code=old.cm_code;
  END IF;
END */$$


DELIMITER ;

/* Trigger structure for table `pp_purchaseorddt` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tr_pp_PurchaseOrdDt_insert_bf` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'%' */ /*!50003 TRIGGER `tr_pp_PurchaseOrdDt_insert_bf` BEFORE INSERT ON `pp_purchaseorddt` FOR EACH ROW BEGIN
			DECLARE vTaxRate DECIMAL(20,2);
			
			/*Finding Tax Rate from cm_codesparam table which was define by product group*/
			SELECT a.cm_purtax INTO vTaxRate
			FROM cm_codesparam a
			INNER JOIN cm_productmaster b ON a.cm_code=b.cm_group
			WHERE b.cm_code=new.cm_code AND a.cm_type='Product Group';
			
			/*THIS IS THE RIGHT WAY TO SAME TRIGGER SAME TABLE UPDATE*/
			SET new.pp_rowamt=(new.pp_quantity*new.pp_purchasrate);
			SET new.pp_taxrate=vTaxRate;
			set new.pp_taxamt=ROUND(new.pp_rowamt-(new.pp_rowamt/((vTaxRate+100)/100)),2);
			
		END */$$


DELIMITER ;

/* Trigger structure for table `pp_purchaseorddt` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tr_pp_PurchaseOrdDt_insert_af` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'%' */ /*!50003 TRIGGER `tr_pp_PurchaseOrdDt_insert_af` AFTER INSERT ON `pp_purchaseorddt` FOR EACH ROW BEGIN
			DECLARE vAvgTaxRate DECIMAL(10,2);
			SELECT CONVERT(SUM(pp_taxrate)/COUNT(pp_purordnum), DECIMAL(10,2)) INTO vAvgTaxRate
			FROM pp_purchaseorddt
			WHERE pp_purordnum=new.pp_purordnum
			GROUP BY pp_purordnum;
		
			/*Update purchase header table with tax amount and total row amount pluss net amount*/
			UPDATE pp_purchaseordhd a
			LEFT JOIN(SELECT pp_purordnum,sum(pp_taxamt)as tottaxamt, SUM(pp_rowamt) AS totlineamt
								FROM pp_purchaseorddt
								WHERE pp_purordnum=new.pp_purordnum
								GROUP BY pp_purordnum) b ON a.pp_purordnum=b.pp_purordnum
			SET a.pp_amount=b.totlineamt, 
					a.pp_taxamt=b.tottaxamt, 
					a.pp_netamt=b.totlineamt-b.tottaxamt,
					a.pp_taxrate=vAvgTaxRate
			WHERE a.pp_purordnum=new.pp_purordnum;
    END */$$


DELIMITER ;

/* Trigger structure for table `pp_purchaseorddt` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tr_pp_PurchaseOrdDt_update_bf` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'%' */ /*!50003 TRIGGER `tr_pp_PurchaseOrdDt_update_bf` BEFORE UPDATE ON `pp_purchaseorddt` FOR EACH ROW BEGIN
			DECLARE vTaxRate DECIMAL(20,2);
			
			/*Finding Tax Rate from cm_codesparam table which was define by product group*/
			SELECT a.cm_purtax INTO vTaxRate
			FROM cm_codesparam a
			INNER JOIN cm_productmaster b ON a.cm_code=b.cm_group
			WHERE b.cm_code=new.cm_code AND a.cm_type='Product Group';
			
			/*THIS IS THE RIGHT WAY TO SAME TRIGGER SAME TABLE UPDATE*/
			SET new.pp_rowamt=(new.pp_quantity*new.pp_purchasrate);
			SET new.pp_taxrate=vTaxRate;
			SET new.pp_taxamt=ROUND(new.pp_rowamt-(new.pp_rowamt/((vTaxRate+100)/100)),2);
		END */$$


DELIMITER ;

/* Trigger structure for table `pp_purchaseorddt` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tr_pp_PurchaseOrdDt_update_af` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'%' */ /*!50003 TRIGGER `tr_pp_PurchaseOrdDt_update_af` AFTER UPDATE ON `pp_purchaseorddt` FOR EACH ROW BEGIN
			DECLARE vAvgTaxRate DECIMAL(10,2);
			SELECT CONVERT(SUM(pp_taxrate)/COUNT(pp_purordnum), DECIMAL(10,2)) INTO vAvgTaxRate
			FROM pp_purchaseorddt
			WHERE pp_purordnum=new.pp_purordnum
			GROUP BY pp_purordnum;
		
			/*Update purchase header table with tax amount and total row amount pluss net amount*/
			UPDATE pp_purchaseordhd a
			LEFT JOIN(SELECT pp_purordnum,SUM(pp_taxamt)AS tottaxamt, SUM(pp_rowamt) AS totlineamt
								FROM pp_purchaseorddt
								WHERE pp_purordnum=new.pp_purordnum
								GROUP BY pp_purordnum) b ON a.pp_purordnum=b.pp_purordnum
			SET a.pp_amount=b.totlineamt, 
					a.pp_taxamt=b.tottaxamt, 
					a.pp_netamt=b.totlineamt-b.tottaxamt,
					a.pp_taxrate=vAvgTaxRate
			WHERE a.pp_purordnum=new.pp_purordnum;
    END */$$


DELIMITER ;

/* Trigger structure for table `pp_purchaseorddt` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tr_pp_PurchaseOrdDt_delete` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'%' */ /*!50003 TRIGGER `tr_pp_PurchaseOrdDt_delete` AFTER DELETE ON `pp_purchaseorddt` FOR EACH ROW BEGIN
			DECLARE vAvgTaxRate DECIMAL(10,2);
			SELECT CONVERT(SUM(pp_taxrate)/COUNT(pp_purordnum), DECIMAL(10,2)) INTO vAvgTaxRate
			FROM pp_purchaseorddt
			WHERE pp_purordnum=old.pp_purordnum
			GROUP BY pp_purordnum;
			
			/*Update purchase header table with tax amount and total row amount pluss net amount*/
			UPDATE pp_purchaseordhd a
			LEFT JOIN(SELECT pp_purordnum,ifnull(SUM(pp_taxamt),0)AS tottaxamt, ifnull(SUM(pp_rowamt),0) AS totlineamt
								FROM pp_purchaseorddt
								WHERE pp_purordnum=old.pp_purordnum
								GROUP BY pp_purordnum) b ON a.pp_purordnum=b.pp_purordnum
			SET a.pp_amount=b.totlineamt, 
					a.pp_taxamt=b.tottaxamt, 
					a.pp_netamt=b.totlineamt-b.tottaxamt,
					a.pp_taxrate=vAvgTaxRate
			WHERE a.pp_purordnum=old.pp_purordnum;
			
    END */$$


DELIMITER ;

/* Trigger structure for table `sm_detail` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tr_sm_batchsale_insert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'%' */ /*!50003 TRIGGER `tr_sm_batchsale_insert` AFTER INSERT ON `sm_detail` FOR EACH ROW BEGIN
			DECLARE v_FromStore VARCHAR(50);
			DECLARE v_IssueQty INT;
			DECLARE v_BonusQty INT;
			DECLARE v_Date DATE;
			DECLARE v_Unit VARCHAR(50);
			
			DECLARE v_Batch VARCHAR(50);
			DECLARE v_ExpDate DATE;
			DECLARE v_Rate DECIMAL(20,2);
			DECLARE v_AvlQty INT;
			
			DECLARE No_DATA INT DEFAULT 0;
			
			DECLARE CurBatch CURSOR FOR
			SELECT im_BatchNumber,im_ExpireDate,im_rate,SUM(Available)
			FROM im_vw_stock
			WHERE cm_code=new.cm_code AND im_storeid=v_FromStore AND im_ExpireDate>v_Date AND Available>0
			GROUP BY im_ExpireDate,im_BatchNumber;
			
			DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET NO_DATA=-2;
			DECLARE CONTINUE HANDLER FOR NOT FOUND SET NO_DATA=-1;
			
			SET v_BonusQty=new.sm_bonusqty;
			SET v_IssueQty=new.sm_quantity+new.sm_bonusqty;
			SET v_Unit=new.sm_unit;
			SELECT sm_storeid, sm_date INTO v_FromStore, v_Date FROM sm_header WHERE sm_number=new.sm_number;
			
			OPEN CurBatch;
			FETCH FROM CurBatch INTO v_Batch, v_ExpDate, v_Rate, v_AvlQty;
			a: WHILE NO_DATA=0 DO -- 1
			
				IF v_AvlQty>=v_IssueQty THEN -- 2
					INSERT INTO sm_batchsale(sm_number,cm_code,sm_batchnumber,sm_expdate,sm_unit,sm_quantity,
																	 sm_bonusqty,sm_rate,inserttime,insertuser)
					VALUES(new.sm_number,new.cm_code,v_Batch, v_ExpDate, v_Unit, (v_IssueQty-v_BonusQty),
									v_BonusQty, v_Rate,CURRENT_TIMESTAMP,new.insertuser);
					LEAVE a;
				ELSEIF v_IssueQty>v_AvlQty THEN
					INSERT INTO sm_batchsale(sm_number,cm_code,sm_batchnumber,sm_expdate,sm_unit,sm_quantity,
																	 sm_bonusqty,sm_rate,inserttime,insertuser)
					VALUES(new.sm_number,new.cm_code,v_Batch, v_ExpDate, v_Unit,
								 CASE WHEN v_AvlQty>v_BonusQty THEN (v_AvlQty-v_BonusQty) ELSE v_AvlQty END,
								 CASE WHEN v_AvlQty>v_BonusQty THEN v_BonusQty ELSE 0 END, 
								 v_Rate,CURRENT_TIMESTAMP,new.insertuser);
									
					IF v_AvlQty>v_BonusQty THEN -- 3
						SET v_IssueQty=v_IssueQty-v_AvlQty;
						SET v_BonusQty=0;
					ELSE
						SET v_IssueQty=v_IssueQty-v_AvlQty;
					END IF; -- 3
					
				END IF; -- 2
				
			FETCH FROM CurBatch INTO v_Batch, v_ExpDate, v_Rate, v_AvlQty;
			END WHILE; -- 1
			CLOSE CurBatch;
    END */$$


DELIMITER ;

/* Trigger structure for table `tbl_reports` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tr_create_permission_reports` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `tr_create_permission_reports` AFTER INSERT ON `tbl_reports` FOR EACH ROW CALL pr_create_permission_reports(NEW.report_id) */$$


DELIMITER ;

/* Function  structure for function  `Fu_GetTrn` */

/*!50003 DROP FUNCTION IF EXISTS `Fu_GetTrn` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` FUNCTION `Fu_GetTrn`(p_type VARCHAR(50),p_trncode VARCHAR(4),p_len INT,p_year BOOLEAN) RETURNS varchar(50) CHARSET utf8
    DETERMINISTIC
BEGIN
	DECLARE vLastNum INT;
	DECLARE vIncri INT;
	DECLARE vTrnNumber VARCHAR(50);
	DECLARE vLength INT;
	DECLARE vCnt INT DEFAULT 1;
	SELECT cm_lastnumber,cm_increment INTO vLastNum,vIncri FROM cm_transaction WHERE cm_type=p_type AND cm_trncode=p_trncode AND cm_active=1;
	SET vTrnNumber = vLastNum+vIncri;
	
	SET vLength=(p_len-LENGTH(vTrnNumber));
	WHILE vCnt<=vLength DO
		SET vTrnNumber=CONCAT('0',vTrnNumber);-- This concat padding zero before transaction number.
		SET vCnt=vCnt+1;
	END WHILE;
	UPDATE cm_transaction 
		SET cm_lastnumber=vTrnNumber, updatetime=CURRENT_TIMESTAMP
	WHERE cm_type=p_type AND cm_trncode=p_trncode;
	
	IF p_year=FALSE THEN
		SET vTrnNumber=CONCAT(p_trncode,vTrnNumber);
	ELSE
		SET vTrnNumber=CONCAT(p_trncode,SUBSTRING(CURRENT_DATE,3,2),vTrnNumber);
	END IF;
	RETURN vTrnNumber;	
END */$$
DELIMITER ;

/* Function  structure for function  `Fu_Period` */

/*!50003 DROP FUNCTION IF EXISTS `Fu_Period` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `Fu_Period`(p_date DATE) RETURNS int(11)
BEGIN
		DECLARE vfperiod INT;
		DECLARE vPer INT;
		SELECT am_offset INTO vfperiod FROM am_default;
		
		SET vPer=12+MONTH(p_date)-vfperiod;
		IF vPer>12 THEN
			SET vPer=vPer-12;
		END IF;
		
		RETURN vPer;
	END */$$
DELIMITER ;

/* Function  structure for function  `Fu_Year` */

/*!50003 DROP FUNCTION IF EXISTS `Fu_Year` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `Fu_Year`(p_date DATE) RETURNS int(11)
BEGIN
		DECLARE vfperiod INT;
		DECLARE vYear INT;
		DECLARE vPer INT;
		SELECT am_offset INTO vfperiod FROM am_default;
		
		SET vYear=YEAR(p_date);
		SET vPer=12+MONTH(p_date)-vfperiod;
		IF vPer<=12 THEN
			SET vYear=vYear-1;
		END IF;
		
		RETURN vYear;
	END */$$
DELIMITER ;

/* Procedure structure for procedure `pr_create_permission_reports` */

/*!50003 DROP PROCEDURE IF EXISTS  `pr_create_permission_reports` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `pr_create_permission_reports`(IN `p_report_id` int)
BEGIN
	DECLARE done INT DEFAULT 0;
	DECLARE c_username  varchar(100);
	DECLARE c_rol_id  int(11);

  DECLARE cur1 CURSOR FOR SELECT username FROM tbl_users; 
	DECLARE cur2 CURSOR FOR SELECT rol_id FROM tbl_roles; 
  DECLARE CONTINUE HANDLER FOR SQLSTATE '02000' SET done = 1;

  OPEN cur1; 
	REPEAT
    FETCH cur1 INTO c_username; 
		IF NOT done THEN
			INSERT INTO tbl_reports_permissions(username, report_id, insert_, edit, delete_, view_) 
				VALUES (c_username, p_report_id, 0, 0, 0, 1); 
			
		END IF;
  UNTIL done END REPEAT;
	CLOSE cur1;	

	SET done = 0;
	OPEN cur2; 
	REPEAT
		FETCH cur2 INTO c_rol_id;    
		IF NOT done THEN   
			INSERT INTO tbl_reports_permissions_roles(rol_id, report_id, insert_, edit, delete_, view_) 
				VALUES (c_rol_id, p_report_id, 0, 0, 0, 1); 
		END IF;
  UNTIL done END REPEAT;
  CLOSE cur2;
END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_gl_postunpost_v` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_gl_postunpost_v` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `sp_gl_postunpost_v`(
	pfvoucher varchar(50),
	ptvoucher varchar(50),
	paction int,
	pUser varchar(10)
)
begin
	declare v_voucherno varchar(50);
	
	declare NO_DATA int default 0;
	
	declare cursor_post cursor for
	select am_vouchernumber
	from am_vouhcerheader 
	where am_vouchernumber between pfvoucher and ptvoucher and am_status in('Balanced','Un-Post');
	
	DECLARE cursor_unpost CURSOR FOR
	SELECT am_vouchernumber
	FROM am_vouhcerheader 
	WHERE am_vouchernumber BETWEEN pfvoucher AND ptvoucher AND am_status='Posted';
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET NO_DATA=-2;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET NO_DATA=-1;
	if paction=1 then -- if1
		open cursor_post;
		fetch from cursor_post into v_voucherno;
		while NO_DATA=0 do -- w1
		
			INSERT INTO am_balance(c_vouchernumber,c_accountcode,c_subacc,c_date,c_branch,c_referance,c_year,c_period,c_currency,
														 c_exchagerate,c_primeamt,c_baseamt,c_status,inserttime,insertuser)
			SELECT a.am_vouchernumber,b.am_accountcode,b.am_subacccode,a.am_date,a.am_branch,a.am_referance,a.am_year,a.am_period,b.am_currency,
						 b.am_exchagerate,b.am_primeamt,b.am_baseamt,'Post',CURRENT_TIMESTAMP,pUser
			FROM am_vouhcerheader a
			INNER JOIN am_voucherdetail b ON a.am_vouchernumber=b.am_vouchernumber
			WHERE a.am_status='Balanced' AND a.am_vouchernumber=v_voucherno;
			
			update am_vouhcerheader 
			set am_status='Posted',updatetime=current_timestamp, updateuser=pUser 
			where am_vouchernumber=v_voucherno;
			
		FETCH FROM cursor_post INTO v_voucherno;
		end while; -- w1
		close cursor_post;
	end if; -- if1
	IF paction=0 THEN -- if2
		OPEN cursor_unpost;
		FETCH FROM cursor_unpost INTO v_voucherno;
		WHILE NO_DATA=0 DO -- w1
			
			delete from am_balance where c_vouchernumber=v_voucherno and c_status='Post';
						
			UPDATE am_vouhcerheader 
			SET am_status='Un-Post',updatetime=CURRENT_TIMESTAMP, updateuser=pUser 
			WHERE am_vouchernumber=v_voucherno;
			
		FETCH FROM cursor_unpost INTO v_voucherno;
		END WHILE; -- w1
		CLOSE cursor_unpost;
	END IF; -- if2
	
end */$$
DELIMITER ;

/* Procedure structure for procedure `sp_imled_rpt` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_imled_rpt` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `sp_imled_rpt`(
	pBranch VARCHAR(20),
	pFromDate DATE,
	pToDate DATE
)
BEGIN
	SELECT a.cm_code, b.cm_name,
				CASE WHEN pFromDate>a.im_date THEN SUM(a.im_quantity*a.im_sign) ELSE 0 END AS OB,
				CASE WHEN a.im_date BETWEEN pFromDate AND pToDate THEN SUM(CASE WHEN (a.im_quantity*a.im_sign)>0 THEN (a.im_quantity*a.im_sign) ELSE 0 END) ELSE 0 END AS Receive,
				CASE WHEN a.im_date BETWEEN pFromDate AND pToDate THEN SUM(CASE WHEN (a.im_quantity*a.im_sign)<0 THEN ABS((a.im_quantity*a.im_sign)) ELSE 0 END) ELSE 0 END AS Issue,
				CASE WHEN a.im_date<=pToDate THEN SUM(a.im_quantity*a.im_sign) ELSE 0 END AS CB
	 FROM im_transaction a, cm_productmaster b
	 WHERE a.cm_code=b.cm_code AND a.im_date<=pToDate AND a.im_storeid=pBranch
	 GROUP BY a.cm_code,a.im_date;
END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_im_ConfirmGRN` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_im_ConfirmGRN` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `sp_im_ConfirmGRN`(p_id INT, p_insertuser VARCHAR(50))
BEGIN
	DECLARE vImNumber VARCHAR(50);
	DECLARE vStoreCur VARCHAR(50);
	DECLARE vExchangeRate DECIMAL(20,2);
	
	DECLARE vId INT;
	DECLARE vGrnNumber VARCHAR(50);
	DECLARE vStore VARCHAR(50);
	DECLARE vProCode VARCHAR(50);
	DECLARE vBatchNumber VARCHAR(50);
	DECLARE vExpireDate DATE;
	DECLARE vSupplierId VARCHAR(50);
	DECLARE vRcvQuantity INT;
	DECLARE vUnit VARCHAR(50);
	DECLARE vRate DECIMAL(20,3);
	DECLARE vCurrency VARCHAR(50);
	
	DECLARE No_DATA INT DEFAULT 0;
	
	DECLARE CurGrn CURSOR FOR -- This cursor declare for GRN Table
	SELECT b.id, a.im_grnnumber, a.im_store, b.cm_code, b.im_BatchNumber, b.im_ExpireDate, a.cm_supplierid,
				 b.im_RcvQuantity*b.im_unitqty AS Quantity, ROUND((b.im_costprice/b.im_unitqty),2) AS CostPrice, a.im_currency
	FROM im_grnheader a 
	INNER JOIN im_grndetail b ON a.im_grnnumber=b.im_grnnumber
	WHERE a.id=p_id AND a.im_status='Open'; -- Declaration close
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET NO_DATA=-2;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET NO_DATA=-1;
	
	OPEN CurGrn; /******Cursor open here**********/
	FETCH FROM CurGrn INTO vId, vGrnNumber, vStore, vProCode, vBatchNumber, vExpireDate, vSupplierId, vRcvQuantity, vRate, vCurrency;
	WHILE No_DATA=0 DO -- 1
		SELECT cm_stkunit INTO vUnit FROM cm_productmaster WHERE cm_code=vProCode;
		SELECT Fu_GetTrn('Im Transaction','PO--',6,1) INTO vImNumber;
		
		INSERT INTO im_transaction
		(im_number, cm_code, im_storeid, im_BatchNumber, im_date, im_ExpireDate, im_quantity, im_sign, im_unit, 
		 im_rate, im_totalprice, im_RefNumber, im_RefRow, im_note, im_status,cm_supplierid, im_currency, inserttime, insertuser)
		VALUES
		(vImNumber, vProCode, vStore, vBatchNumber, CURRENT_DATE, vExpireDate, vRcvQuantity, 1, vUnit, 
		 vRate, vRate*vRcvQuantity, vGrnNumber, vId, 'Goods Received From PO', 'Open', vSupplierId, vCurrency, CURRENT_TIMESTAMP, p_insertuser); 
		 
	FETCH FROM CurGrn INTO vId, vGrnNumber, vStore, vProCode, vBatchNumber, vExpireDate, vSupplierId, vRcvQuantity, vRate, vCurrency;
	END WHILE; -- 1
	CLOSE CurGrn;
	
	UPDATE im_grnheader SET im_status='Confirmed' WHERE id=p_id;
	
END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_im_CreateGRN` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_im_CreateGRN` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `sp_im_CreateGRN`(p_id INT,p_username VARCHAR(50))
BEGIN
		DECLARE vGrnNumber VARCHAR(50);
		
		SELECT Fu_GetTrn('GRN Number','GRN-',6,1) INTO vGrnNumber;
		
		INSERT INTO im_grnheader(im_grnnumber,im_purordnum,im_date,cm_supplierid,pp_requisitionno,im_payterms,im_store,
														 im_discrate,im_discamt,im_currency,im_taxrate,im_taxamt,im_amount,im_netamt,im_status,inserttime,insertuser)
		SELECT vGrnNumber,pp_purordnum,CURRENT_DATE,cm_supplierid,pp_requisitionno,pp_payterms,pp_store,pp_discrate,
					 pp_discamt,pp_currency,pp_taxrate,pp_taxamt,pp_amount,pp_netamt,'Open',CURRENT_TIMESTAMP,p_username 
		FROM pp_purchaseordhd WHERE id=p_id AND pp_status IN('Approved','Part Received');
		
		UPDATE pp_purchaseordhd SET pp_status='GRN Created' WHERE id=p_id;
		
		SELECT pp_purordnum, vGrnNumber FROM pp_purchaseordhd WHERE id=p_id;
		
	END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_im_imtogltrn` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_im_imtogltrn` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `sp_im_imtogltrn`(
	pBranch varchar(10),
	pFromDate DATE,
	pToDate date,
	pUser VARCHAR(10)
)
BEGIN
	declare v_TrnCode, v_Group, v_AccDr, v_AccCr, v_currency, v_voucher varchar(50);
	declare v_Prime, v_exchange decimal(10,2);
	
	declare NO_DATA int default 0;
	
	declare cursor_one cursor for
	SELECT c_trncode FROM it_imtogl
	where c_branch=pBranch
	GROUP BY c_branch, c_trncode;
		
	declare cursor_two cursor for
	SELECT b.cm_group,c.c_accdr,c.c_acccr, SUM(a.im_totalprice)
	FROM im_transaction a
	INNER JOIN cm_productmaster b ON a.cm_code=b.cm_code
	INNER JOIN it_imtogl c ON LEFT(a.im_number,4)=c.c_trncode AND b.cm_group=c.c_group
	WHERE a.im_storeid=pBranch and c.c_trncode=v_TrnCode and a.im_date BETWEEN pFromDate AND pToDate	
	GROUP BY c.c_trncode, b.cm_group;
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET NO_DATA=-2;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET NO_DATA=-1;
	
	SELECT a.cm_currency,b.cm_exchangerate INTO v_currency, v_exchange 
	FROM cm_branchmaster a, cm_branchcurrency b 
	WHERE a.cm_branch=b.cm_branch 
				AND a.cm_currency=b.cm_currency 
				AND a.cm_branch=pBranch;
	
	open cursor_one;
	fetch from cursor_one into v_TrnCode;
	while NO_DATA=0 do -- W1
		SELECT Fu_GetTrn('Voucher No','IM--',6,1) INTO v_voucher;
		/*Create New Voucher Header*/
		INSERT INTO am_vouhcerheader(am_vouchernumber,am_date,am_referance,am_year,am_period,am_branch,am_note,inserttime,insertuser)
		VALUES(v_voucher,CURRENT_DATE,'Inventory transfer',Fu_Year(CURRENT_DATE),Fu_Period(CURRENT_DATE),pBranch,
			 concat('All ',v_TrnCode,'From ',pFromDate,' To ',pToDate),CURRENT_TIMESTAMP,pUser);
		
		open cursor_two;
		fetch from cursor_two into v_Group, v_AccDr, v_AccCr, v_Prime;
		while NO_DATA=0 do -- W2
		
			/*INSERT DEBIT ACCOUNT*/
			INSERT INTO am_voucherdetail(am_vouchernumber,am_accountcode,am_subacccode,am_currency,am_exchagerate,am_primeamt,am_baseamt,am_branch,am_note,inserttime,insertuser)
			VALUES(v_voucher,v_AccDr,'',v_currency,v_exchange,v_Prime,v_exchange*v_Prime,pBranch,v_Group,CURRENT_TIMESTAMP,pUser);
			/*INSERT CREDIT ACCOUNT*/
			INSERT INTO am_voucherdetail(am_vouchernumber,am_accountcode,am_subacccode,am_currency,am_exchagerate,am_primeamt,am_baseamt,am_branch,am_note,inserttime,insertuser)
			VALUES(v_voucher,v_AccCr,'',v_currency,v_exchange,0-v_Prime,0-(v_exchange*v_Prime),pBranch,v_Group,CURRENT_TIMESTAMP,pUser);
			
			
		FETCH FROM cursor_two INTO v_Group, v_AccDr, v_AccCr, v_Prime;
		end while; -- W2
		CLOSE cursor_two;
		
		update im_transaction 
		set im_voucherno=v_voucher, im_status='Post to GL'
		WHERE im_storeid=pBranch AND left(im_number,4)=v_TrnCode AND im_date BETWEEN pFromDate AND pToDate;
		
	FETCH FROM cursor_one INTO v_TrnCode;
	end while; -- W1
	close cursor_one;
end */$$
DELIMITER ;

/* Procedure structure for procedure `sp_im_invoice` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_im_invoice` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `sp_im_invoice`(
	p_id INT,
	p_User VARCHAR(50)
)
BEGIN
	DECLARE v_grnnumber VARCHAR(50);
	DECLARE v_branch VARCHAR(50);
	DECLARE v_itemgroup VARCHAR(50);
	DECLARE v_suppgorup VARCHAR(50);
	DECLARE v_debitamt DECIMAL(20,2);
	DECLARE v_voucher VARCHAR(50);
	DECLARE v_dbacc VARCHAR(50);
	DECLARE v_currency VARCHAR(20);
	DECLARE v_exchange DECIMAL(20,2);
	DECLARE v_acccode VARCHAR(20);
	DECLARE v_acctax VARCHAR(20);
	DECLARE v_taxamt DECIMAL(20,2);
	DECLARE v_netamt DECIMAL(20,2);
	DECLARE v_subacc VARCHAR(50);
	DECLARE NO_DATA INT DEFAULT 0;
	
	DECLARE cur_imgrn CURSOR FOR
	SELECT b.cm_group,d.cm_group,CONVERT(SUM(a.im_rowamount), DECIMAL(20,2)) AS debitamount, e.debit_account, c.im_grnnumber,c.im_store
	FROM im_grndetail a
	INNER JOIN im_grnheader c ON a.im_grnnumber=c.im_grnnumber
	INNER JOIN cm_productmaster b ON a.cm_code=b.cm_code
	INNER JOIN cm_suppliermaster d ON c.cm_supplierid=d.cm_supplierid
	LEFT JOIN it_imtoap e ON e.item_group=b.cm_group AND e.sup_group=d.cm_group
  WHERE c.id=p_id and c.im_status='Confirmed'
	GROUP BY b.cm_group;
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET NO_DATA=-2;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET NO_DATA=-1;
	SELECT Fu_GetTrn('Voucher No','INVC',6,1) INTO v_voucher;
	
  OPEN cur_imgrn;
  FETCH FROM cur_imgrn INTO v_itemgroup, v_suppgorup, v_debitamt, v_dbacc, v_grnnumber, v_branch;
	
	SELECT a.cm_currency,b.cm_exchangerate INTO v_currency, v_exchange FROM cm_branchmaster a 
	INNER JOIN cm_branchcurrency b 
	ON a.cm_branch=b.cm_branch AND a.cm_currency=b.cm_currency AND a.cm_branch=v_branch;
	
	/*Create New Invoice Header */
	INSERT INTO am_vouhcerheader(am_vouchernumber,am_date,am_referance,am_year,am_period,am_branch,am_note,inserttime,insertuser)
	VALUES(v_voucher,CURRENT_DATE,CONCAT('Invoiced for GRN number ',v_grnnumber),Fu_Year(CURRENT_DATE),Fu_Period(CURRENT_DATE),v_branch,
				 'This invoice automatic create from GRN',CURRENT_TIMESTAMP,p_User);
	
	WHILE NO_DATA=0 DO -- 1 Insert in debit amount
		
		INSERT INTO am_voucherdetail(am_vouchernumber,am_accountcode,am_subacccode,am_currency,am_exchagerate,am_primeamt,am_baseamt,am_branch,am_note,inserttime,insertuser)
		VALUES(v_voucher,v_dbacc,'',v_currency,v_exchange,v_debitamt,v_exchange*v_debitamt,v_branch,'Inventory Debit automatic',CURRENT_TIMESTAMP,p_User);
		
	FETCH FROM cur_imgrn INTO v_itemgroup, v_suppgorup, v_debitamt, v_dbacc, v_grnnumber, v_branch;
  END WHILE; -- 1
	CLOSE cur_imgrn;
	
	/*Insert Credit Account*/
	SELECT IFNULL(a.im_taxamt,0) AS v_taxamt,a.im_netamt,b.cm_group,a.cm_supplierid,c.cm_acccode,c.cm_acctax
	INTO v_taxamt,v_netamt,v_suppgorup,v_subacc,v_acccode,v_acctax 
	FROM im_grnheader a 
	INNER JOIN cm_suppliermaster b ON a.cm_supplierid=b.cm_supplierid
	LEFT JOIN cm_codesparam c ON c.cm_type='Supplier Group' AND c.cm_code=b.cm_group
	WHERE a.id=p_id;
	
	INSERT INTO am_voucherdetail(am_vouchernumber,am_accountcode,am_subacccode,am_currency,am_exchagerate,am_primeamt,am_baseamt,am_branch,am_note,inserttime,insertuser)
	VALUES(v_voucher,v_acccode,v_subacc,v_currency,v_exchange,0-v_netamt,0-(v_exchange*v_netamt),v_branch,'Inventory Credit automatic',CURRENT_TIMESTAMP,p_User);
	
	IF v_taxamt<>0 THEN -- 2 If tax amount is not zero then credit account will enter.
		INSERT INTO am_voucherdetail(am_vouchernumber,am_accountcode,am_subacccode,am_currency,am_exchagerate,am_primeamt,am_baseamt,am_branch,am_note,inserttime,insertuser)
		VALUES(v_voucher,v_acctax,'',v_currency,v_exchange,0-v_taxamt,0-(v_exchange*v_taxamt),v_branch,'Inventory Credit automatic',CURRENT_TIMESTAMP,p_User);
	END IF; -- 2
	
	UPDATE im_grnheader SET im_status='Invoiced',am_vouchernumber=v_voucher WHERE id=p_id and im_status='Confirmed';
	
END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_im_TransferConfirm` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_im_TransferConfirm` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `sp_im_TransferConfirm`(p_id INT, p_username VARCHAR(50))
BEGIN
	DECLARE v_Id INT(20);
	DECLARE v_TransferNum VARCHAR(50);
	DECLARE v_FromStore VARCHAR(50);
	DECLARE v_ToStore VARCHAR(50);
	DECLARE v_ProCode VARCHAR(50);
	DECLARE v_Batch VARCHAR(50);
	DECLARE v_ExpDate DATE;
	DECLARE v_Rate DECIMAL(20,2);
	DECLARE v_Quantity INT;
	DECLARE v_Unit VARCHAR(50);
	
	DECLARE v_FromCur VARCHAR(50);
	DECLARE v_ToCur VARCHAR(50);
	DECLARE v_ExchangeRate DECIMAL(20,2);
	
	DECLARE v_ImTrnNumber VARCHAR(50);
	
	DECLARE NO_DATA INT DEFAULT 0;
	
	DECLARE CurTransfer CURSOR FOR
	SELECT a.id, a.im_transfernum, b.im_fromstore, b.im_ToStore, a.cm_code, a.im_BatchNumber, a.im_ExpDate, a.im_rate, a.im_quantity, 
				 a.im_unit
	FROM im_batchtransfer a 
	INNER JOIN im_transferhd b 
	ON a.im_transfernum=b.im_transfernum
	WHERE b.id=p_id AND b.im_status='Open';
	
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET NO_DATA=-2;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET NO_DATA=-1;
	
	OPEN CurTransfer;
	FETCH	FROM CurTransfer INTO v_Id, v_TransferNum, v_FromStore, v_ToStore, v_ProCode, v_Batch, v_ExpDate, v_Rate, v_Quantity, v_Unit;
		
	SELECT cm_currency INTO v_FromCur 		-- Find from branch/warehouse currency
	FROM cm_branchmaster 								
	WHERE cm_branch=v_FromStore;
	
	SELECT cm_currency INTO v_ToCur				-- Find to branch/warehouse currency
	FROM cm_branchmaster 
	WHERE cm_branch=v_ToStore;
	SELECT IFNULL(cm_exchangerate,0) INTO v_ExchangeRate -- from warehouse exchange rate to warehouse exchange rate. 
	FROM cm_branchcurrency 
	WHERE cm_branch=v_ToStore AND cm_currency=v_FromCur;
	select v_ExchangeRate,v_ToCur,v_FromCur,v_FromStore;
	WHILE NO_DATA=0 DO -- 1
		SELECT Fu_GetTrn('Im Transaction','IT--',6,1) INTO v_ImTrnNumber; -- Issue Transfer
		INSERT INTO im_transaction -- Issue Item.
		(im_number, cm_code, im_storeid, im_BatchNumber, im_date, im_ExpireDate, im_quantity, im_sign, im_unit, im_rate, im_totalprice, 
		 im_RefNumber, im_RefRow, im_note, im_status, im_currency,im_ExchangeRate, inserttime, insertuser)
		VALUES
		(v_ImTrnNumber, v_ProCode, v_FromStore, v_Batch, CURRENT_DATE, v_ExpDate, v_Quantity, -1, v_Unit, v_Rate, v_Quantity*v_Rate,
		 v_TransferNum, v_Id, CONCAT('Transfer to ',v_ToStore), 'Open', v_FromCur, 1, CURRENT_TIMESTAMP, p_username);
		 
		SELECT Fu_GetTrn('Im Transaction','RE--',6,1) INTO v_ImTrnNumber; -- Received Transfer
		INSERT INTO im_transaction -- Received Item
		(im_number, cm_code, im_storeid, im_BatchNumber, im_date, im_ExpireDate, im_quantity, im_sign, im_unit, im_rate, im_totalprice, 
		 im_RefNumber, im_RefRow, im_note, im_status, im_currency, im_ExchangeRate, inserttime, insertuser)
		VALUES
		(v_ImTrnNumber, v_ProCode, v_ToStore, v_Batch, CURRENT_DATE, v_ExpDate, v_Quantity, 1, v_Unit, v_Rate*v_ExchangeRate, v_Quantity*(v_Rate*v_ExchangeRate),
		 v_TransferNum, v_Id, CONCAT('Received from ',v_FromStore), 'Open', v_ToCur, 1, CURRENT_TIMESTAMP, p_username);
		 
	FETCH	FROM CurTransfer INTO v_Id, v_TransferNum, v_FromStore, v_ToStore, v_ProCode, v_Batch, v_ExpDate, v_Rate, v_Quantity, v_Unit;
	END WHILE;  -- 1
	CLOSE CurTransfer;
	
	update im_transferhd set im_status='Confirmed' where id=p_id;
	
END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_pp_PoCreatebyRe` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_pp_PoCreatebyRe` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `sp_pp_PoCreatebyRe`(
	pID INT,
	pUser VARCHAR(50)
)
BEGIN
	DECLARE v_ReqNo VARCHAR(20);
	DECLARE v_SuppID VARCHAR(20);
	DECLARE v_StoreID VARCHAR(20);
	DECLARE v_Currency VARCHAR(10);
	DECLARE v_ProCode VARCHAR(20);
	DECLARE v_CostPrice DECIMAL(20,2);
	DECLARE	v_Qty INT;
	DECLARE v_Unit VARCHAR(20);
	DECLARE v_UnitQty INT;
	DECLARE v_RowAmt DECIMAL(20,2);
	
	DECLARE v_PoNumber VARCHAR(20);
	DECLARE v_Amount DECIMAL(20,2) DEFAULT 0;
		
	DECLARE NO_DATA INT DEFAULT 0;
	
	/*Requisition Header and Detail (product master and branch master) table join query*/
	DECLARE CurRequisition CURSOR FOR 
	SELECT a.pp_requisitionno,a.cm_supplierid,a.pp_branch,d.cm_currency,b.cm_code,c.cm_costprice,b.pp_quantity,b.pp_unit,c.cm_purconfact,
				 (c.cm_costprice*b.pp_quantity) AS rowamount
	FROM pp_requisitionhd a 
	INNER JOIN pp_requisitiondt b ON a.pp_requisitionno=b.pp_requisitionno
	INNER JOIN cm_productmaster c ON b.cm_code=c.cm_code
	INNER JOIN cm_branchmaster d ON a.pp_branch=d.cm_branch
	WHERE a.id=pID AND a.pp_status='Open';
	
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET NO_DATA=-2;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET NO_DATA=-1;
		
	/*Get the purchase order number from Function Get Trn. Which means Function get transaction number return auto number*/
	SELECT Fu_GetTrn('Purchase Order Number','PORE',6,1) INTO v_PoNumber;
	
	OPEN CurRequisition;
	FETCH FROM CurRequisition INTO v_ReqNo, v_SuppID, v_StoreID, v_Currency, v_ProCode, v_CostPrice, v_Qty, v_Unit, v_UnitQty, v_RowAmt;
	
	/*Insert Purchase order header*/
	INSERT INTO pp_purchaseordhd(pp_purordnum,pp_date,cm_supplierid,pp_requisitionno,pp_payterms,pp_deliverydate,pp_store,pp_taxrate,pp_taxamt,
															 pp_discrate,pp_discamt,pp_amount,pp_netamt,pp_status,pp_currency,inserttime,insertuser)
	VALUES(v_PoNumber, CURRENT_DATE, v_SuppID, v_ReqNo, 'Cash', CURRENT_DATE, v_StoreID, 0, 0, 0, 0, 0, 0, 'Open', v_Currency, CURRENT_TIMESTAMP, pUser);
	/**************END**************/
	
	WHILE NO_DATA=0 DO -- W1
		/*Start Insert Purchase Order Detail Table*/
		INSERT INTO pp_purchaseorddt(pp_purordnum,cm_code,pp_quantity,pp_grnqty,pp_unit,pp_unitqty,pp_purchasrate,inserttime,insertuser)
		VALUES(v_PoNumber,v_ProCode,v_Qty,0,v_Unit,v_UnitQty,v_CostPrice,CURRENT_TIMESTAMP,pUser);
		/************END****************/
		SET v_Amount=v_Amount+v_RowAmt;
		
		FETCH FROM CurRequisition INTO v_ReqNo, v_SuppID, v_StoreID, v_Currency, v_ProCode, v_CostPrice, v_Qty, v_Unit, v_UnitQty, v_RowAmt;
	END WHILE; -- W1
	
	-- UPDATE pp_purchaseordhd SET pp_amount=v_Amount WHERE pp_purordnum=v_PoNumber;
	UPDATE pp_requisitionhd SET pp_status='PO Created' WHERE id=pID;
END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_sm_dotoar` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_sm_dotoar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `sp_sm_dotoar`(
	pDate DATE,
	pBranch VARCHAR(10),
	pUser VARCHAR(10)
)
BEGIN
	DECLARE v_gcus VARCHAR(50);
	DECLARE v_accar VARCHAR(10);
	DECLARE v_accdisc VARCHAR(10);
	DECLARE v_acctax VARCHAR(10);
	DECLARE v_amtdisc DECIMAL(20,2);
	DECLARE v_amttax DECIMAL(20,2);
	DECLARE v_amtnet DECIMAL(20,2);
	DECLARE	v_currency VARCHAR(10);
	DECLARE v_exchange DECIMAL(20,2);
	DECLARE v_voucher VARCHAR(50);
	DECLARE v_gprod VARCHAR(50);
	DECLARE v_accsell VARCHAR(10);
	DECLARE v_amttot DECIMAL(20,2);
	DECLARE NO_DATA INT DEFAULT 0;
	
	DECLARE cur_smheader CURSOR FOR
	SELECT b.cm_group,c.cm_acccode,c.cm_accdisc,c.cm_acctax,
				 SUM(a.sm_disc_amt),SUM(a.sm_total_tax_amt),SUM(a.sm_netamt)
	FROM sm_header a, cm_customermst b, cm_codesparam c
	WHERE c.cm_type='Customer Group' 
				AND b.cm_group=c.cm_code 
				AND a.cm_cuscode=b.cm_cuscode
				AND a.sm_doc_type='Sales'
				AND a.sm_storeid=pBranch
				AND a.sm_date=pDate
				AND a.sm_stataus='Delivered'
	GROUP BY b.cm_group,c.cm_acccode,c.cm_accdisc,c.cm_acctax;
	DECLARE cur_smdetail CURSOR FOR
	SELECT c.cm_group,d.cm_acccode,SUM(b.sm_lineamt)
	FROM sm_header a, sm_detail b, cm_productmaster c, cm_codesparam d
	WHERE a.sm_number=b.sm_number
				AND a.sm_doc_type='Sales'
				AND a.sm_storeid=pBranch
				AND b.cm_code=c.cm_code
				AND c.cm_group=d.cm_code
				AND d.cm_type='Product Group'
				AND a.sm_date=pDate
				AND a.sm_stataus='Delivered'
	GROUP BY c.cm_group,d.cm_acccode;
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET NO_DATA=-2;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET NO_DATA=-1;
	
	SELECT a.cm_currency,b.cm_exchangerate INTO v_currency, v_exchange 
	FROM cm_branchmaster a, cm_branchcurrency b 
	WHERE a.cm_branch=b.cm_branch 
				AND a.cm_currency=b.cm_currency 
				AND a.cm_branch=pBranch;
	OPEN cur_smheader;
	FETCH FROM cur_smheader INTO v_gcus,v_accar,v_accdisc,v_acctax,v_amtdisc,v_amttax,v_amtnet;
	WHILE NO_DATA=0 DO -- w1
		SELECT Fu_GetTrn('Voucher No','JV--',6,1) INTO v_voucher;
		
		/*Create New Voucher Header*/
		INSERT INTO am_vouhcerheader(am_vouchernumber,am_date,am_referance,am_year,am_period,am_branch,am_note,inserttime,insertuser)
		VALUES(v_voucher,CURRENT_DATE,CONCAT('This Voucher for ',v_gcus),Fu_Year(CURRENT_DATE),Fu_Period(CURRENT_DATE),pBranch,
					 'This invoice automatic create from Sales Invoice',CURRENT_TIMESTAMP,pUser);
		/*Insert Acount receiveable*/
		INSERT INTO am_voucherdetail(am_vouchernumber,am_accountcode,am_subacccode,am_currency,am_exchagerate,am_primeamt,am_baseamt,am_branch,am_note,inserttime,insertuser)
		VALUES(v_voucher,v_accar,'',v_currency,v_exchange,v_amtnet,v_exchange*v_amtnet,pBranch,'Account Receivable',CURRENT_TIMESTAMP,pUser);
		
		IF v_amtdisc<>0 THEN -- f1 
			/*Insert Discount amount as debit*/
			INSERT INTO am_voucherdetail(am_vouchernumber,am_accountcode,am_subacccode,am_currency,am_exchagerate,am_primeamt,am_baseamt,am_branch,am_note,inserttime,insertuser)
			VALUES(v_voucher,v_accdisc,'',v_currency,v_exchange,v_amtdisc,v_exchange*v_amtdisc,pBranch,'Discount',CURRENT_TIMESTAMP,pUser);
		END IF; -- f1
		
		IF v_amttax<>0 THEN -- f2
			/*Insert Tax amount as Credit*/
			INSERT INTO am_voucherdetail(am_vouchernumber,am_accountcode,am_subacccode,am_currency,am_exchagerate,am_primeamt,am_baseamt,am_branch,am_note,inserttime,insertuser)
			VALUES(v_voucher,v_acctax,'',v_currency,v_exchange,0-v_amttax,0-(v_exchange*v_amttax),pBranch,'Tax',CURRENT_TIMESTAMP,pUser);
		END IF; -- f2
		
		OPEN cur_smdetail;
		FETCH FROM cur_smdetail INTO v_gprod, v_accsell, v_amttot;
		WHILE NO_DATA=0 DO -- W2
			/*Insert sales as credit*/
			INSERT INTO am_voucherdetail(am_vouchernumber,am_accountcode,am_subacccode,am_currency,am_exchagerate,am_primeamt,am_baseamt,am_branch,am_note,inserttime,insertuser)
			VALUES(v_voucher,v_accsell,'',v_currency,v_exchange,0-v_amttot,0-(v_exchange*v_amttot),pBranch,CONCAT('Sales by ',v_gprod),CURRENT_TIMESTAMP,pUser);
			
		FETCH FROM cur_smdetail INTO v_gprod, v_accsell, v_amttot;
		END WHILE; -- W2
		CLOSE cur_smdetail;
		
		UPDATE sm_header a, cm_customermst b
		SET a.glvoucher=v_voucher,a.sm_stataus='Post to GL'
		WHERE a.cm_cuscode=b.cm_cuscode 
			AND b.cm_group=v_gcus
			AND a.sm_doc_type='Sales';	
	
	FETCH FROM cur_smheader INTO v_gcus,v_accar,v_accdisc,v_acctax,v_amtdisc,v_amttax,v_amtnet;
	END WHILE; -- w1
	CLOSE cur_smheader;
	
END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_sm_mrtogl` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_sm_mrtogl` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `sp_sm_mrtogl`(
	pDate date,
	pBranch varchar(20),
	pUser varchar(10)
)
begin
	declare v_gcus varchar(50);
	declare v_accdr varchar(10);
	declare v_acccr varchar(10);
	declare v_amtnet decimal(20,2);
	declare v_currency varchar(10);
	declare v_exchange decimal(20,2);
	
	declare v_voucher varchar(50);
	
	DECLARE NO_DATA INT DEFAULT 0;
	declare cur_mrct cursor for
	SELECT b.cm_group,a.am_accountcode,c.cm_acccode,SUM(a.sm_netamt)
	FROM sm_header a, cm_customermst b, cm_codesparam c
	WHERE a.cm_cuscode=b.cm_cuscode
		AND c.cm_type='Customer Group'
		AND b.cm_group=c.cm_code
		AND a.sm_doc_type='Receipt'
		AND a.sm_storeid=pBranch
		AND a.sm_date=pDate;
	
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET NO_DATA=-2;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET NO_DATA=-1;
	
	SELECT a.cm_currency,b.cm_exchangerate INTO v_currency, v_exchange 
	FROM cm_branchmaster a, cm_branchcurrency b 
	WHERE a.cm_branch=b.cm_branch 
				AND a.cm_currency=b.cm_currency 
				AND a.cm_branch=pBranch;
				
	open cur_mrct;
	fetch from cur_mrct into v_gcus,v_accdr,v_acccr,v_amtnet;
	
	while NO_DATA=0 do -- w1
		SELECT Fu_GetTrn('Voucher No','MRCT',6,1) INTO v_voucher;
		/*Create New Voucher Header*/
		INSERT INTO am_vouhcerheader(am_vouchernumber,am_date,am_referance,am_year,am_period,am_branch,am_note,inserttime,insertuser)
		VALUES(v_voucher,CURRENT_DATE,CONCAT('This Voucher for ',v_gcus),Fu_Year(CURRENT_DATE),Fu_Period(CURRENT_DATE),pBranch,
					 'This is Money Receipt',CURRENT_TIMESTAMP,pUser);
		/*Insert debit account*/
		INSERT INTO am_voucherdetail(am_vouchernumber,am_accountcode,am_subacccode,am_currency,am_exchagerate,am_primeamt,am_baseamt,am_branch,am_note,inserttime,insertuser)
		VALUES(v_voucher,v_accdr,'',v_currency,v_exchange,v_amtnet,v_exchange*v_amtnet,pBranch,'Cash/Bank',CURRENT_TIMESTAMP,pUser);
		
		/*Insert credit account*/
		INSERT INTO am_voucherdetail(am_vouchernumber,am_accountcode,am_subacccode,am_currency,am_exchagerate,am_primeamt,am_baseamt,am_branch,am_note,inserttime,insertuser)
		VALUES(v_voucher,v_acccr,'',v_currency,v_exchange,0-v_amtnet,0-(v_exchange*v_amtnet),pBranch,'Account Receivable',CURRENT_TIMESTAMP,pUser);
		UPDATE sm_header a, cm_customermst b
		SET a.glvoucher=v_voucher,a.sm_stataus='Post to GL'
		WHERE a.cm_cuscode=b.cm_cuscode 
			AND b.cm_group=v_gcus
			AND a.sm_doc_type='Receipt';
				
	FETCH FROM cur_mrct INTO v_gcus,v_accdr,v_acccr,v_amtnet;
	end while; -- w1
end */$$
DELIMITER ;

/* Procedure structure for procedure `sp_sm_orddeliverd` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_sm_orddeliverd` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `sp_sm_orddeliverd`(
	p_id INT,
	p_user VARCHAR(50)
)
BEGIN
	DECLARE v_smnumber VARCHAR(50);
	DECLARE v_cuscode	VARCHAR(50);
	DECLARE v_procode VARCHAR(50);
	DECLARE v_storeid	VARCHAR(50);
	DECLARE v_batch VARCHAR(50);
	DECLARE v_expdate DATE;
	DECLARE v_unit VARCHAR(10);
	DECLARE v_boqty INT;
	DECLARE v_qty INT;
	DECLARE v_rate DECIMAL(20,2);
	DECLARE v_value DECIMAL(20,2);
	DECLARE v_sign INT;
	DECLARE v_currency VARCHAR(10);
	DECLARE v_exchange DECIMAL(20,2);
	DECLARE v_ImNumber VARCHAR(50);
	
	DECLARE NO_DATA INT DEFAULT 0;
	
	DECLARE CursorOne CURSOR FOR
	SELECT a.sm_number,a.cm_cuscode,b.cm_code,a.sm_storeid,b.sm_batchnumber,
				 b.sm_expdate,b.sm_unit,IFNULL(b.sm_bonusqty,0),b.sm_quantity,b.sm_rate,-1
	FROM sm_header a
	INNER JOIN sm_batchsale b ON a.sm_number=b.sm_number
	WHERE a.id=p_id AND a.sm_doc_type='Sales' AND a.sm_stataus='Confirmed';	
	
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET NO_DATA=-2;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET NO_DATA=-1;
	
	OPEN CursorOne;
	FETCH FROM CursorOne INTO v_smnumber,v_cuscode,v_procode,v_storeid,v_batch,v_expdate,v_unit,v_boqty,v_qty,v_rate,v_sign;
	WHILE NO_DATA=0 DO -- W1
	
		/*Find the branch currency*/
		SELECT a.cm_currency,b.cm_exchangerate INTO v_currency, v_exchange 
		FROM cm_branchmaster a 
		INNER JOIN cm_branchcurrency b 
		ON a.cm_branch=b.cm_branch AND a.cm_currency=b.cm_currency AND a.cm_branch=v_storeid;
		
		/*Insert into im_transaction table as sales issue*/	
		SELECT Fu_GetTrn('Im Transaction','DO--',6,1) INTO v_ImNumber;
		
		INSERT INTO im_transaction(im_number,cm_code,im_storeid,im_BatchNumber,im_date,im_ExpireDate,im_quantity,im_sign,im_unit,im_rate,
															 im_totalprice,im_RefNumber,im_RefRow,im_note,im_status,cm_supplierid,im_currency,im_ExchangeRate,
															 inserttime,insertuser)
		VALUE(v_ImNumber,v_procode,v_storeid,v_batch,CURRENT_DATE,v_expdate,v_qty,v_sign,v_unit,v_rate,(v_qty*v_rate),v_smnumber,0,
				  'Item was sell by sales module','Open',v_cuscode,v_currency,v_exchange,CURRENT_TIMESTAMP,p_user);
		
		IF v_boqty>0 THEN -- IF 1
			SELECT Fu_GetTrn('Im Transaction','BO--',6,1) INTO v_ImNumber;
			INSERT INTO im_transaction(im_number,cm_code,im_storeid,im_BatchNumber,im_date,im_ExpireDate,im_quantity,im_sign,im_unit,im_rate,
																 im_totalprice,im_RefNumber,im_RefRow,im_note,im_status,cm_supplierid,im_currency,im_ExchangeRate,
																 inserttime,insertuser)
			VALUE(v_ImNumber,v_procode,v_storeid,v_batch,CURRENT_DATE,v_expdate,v_boqty,v_sign,v_unit,v_rate,(v_boqty*v_rate),v_smnumber,0,
						'Item was sell by sales module','Open',v_cuscode,v_currency,v_exchange,CURRENT_TIMESTAMP,p_user);
		END IF; -- IF 1
	
	FETCH FROM CursorOne INTO v_smnumber,v_cuscode,v_procode,v_storeid,v_batch,v_expdate,v_unit,v_boqty,v_qty,v_rate,v_sign;
	END WHILE; -- W1
	CLOSE CursorOne;
	
	UPDATE sm_header SET sm_stataus='Delivered', updatetime=CURRENT_TIMESTAMP, updateuser=p_user WHERE id=p_id;
END */$$
DELIMITER ;

/*Table structure for table `am_vw_apayable` */

DROP TABLE IF EXISTS `am_vw_apayable`;

/*!50001 DROP VIEW IF EXISTS `am_vw_apayable` */;
/*!50001 DROP TABLE IF EXISTS `am_vw_apayable` */;

/*!50001 CREATE TABLE  `am_vw_apayable`(
 `suppliercode` varchar(50) ,
 `suppliername` varchar(100) ,
 `accoutcode` varchar(50) ,
 `conperson` varchar(100) ,
 `payableamt` decimal(42,2) 
)*/;

/*Table structure for table `am_vw_gltrn` */

DROP TABLE IF EXISTS `am_vw_gltrn`;

/*!50001 DROP VIEW IF EXISTS `am_vw_gltrn` */;
/*!50001 DROP TABLE IF EXISTS `am_vw_gltrn` */;

/*!50001 CREATE TABLE  `am_vw_gltrn`(
 `am_vouchernumber` varchar(50) ,
 `am_accountcode` varchar(50) ,
 `am_description` varchar(100) ,
 `debit` decimal(20,2) ,
 `credit` decimal(20,2) 
)*/;

/*Table structure for table `am_vw_payinvc` */

DROP TABLE IF EXISTS `am_vw_payinvc`;

/*!50001 DROP VIEW IF EXISTS `am_vw_payinvc` */;
/*!50001 DROP TABLE IF EXISTS `am_vw_payinvc` */;

/*!50001 CREATE TABLE  `am_vw_payinvc`(
 `suppliercode` varchar(50) ,
 `invoicnumber` varchar(50) ,
 `currency` varchar(20) ,
 `exchange` decimal(20,2) ,
 `primaamt` decimal(20,2) ,
 `amount` decimal(20,2) 
)*/;

/*Table structure for table `am_vw_unpaidinv` */

DROP TABLE IF EXISTS `am_vw_unpaidinv`;

/*!50001 DROP VIEW IF EXISTS `am_vw_unpaidinv` */;
/*!50001 DROP TABLE IF EXISTS `am_vw_unpaidinv` */;

/*!50001 CREATE TABLE  `am_vw_unpaidinv`(
 `suppliercode` varchar(50) ,
 `invoicnumber` varchar(50) ,
 `currency` varchar(20) ,
 `exchange` decimal(20,2) ,
 `primaamt` decimal(42,2) ,
 `amount` decimal(42,2) 
)*/;

/*Table structure for table `im_vw_grndetail` */

DROP TABLE IF EXISTS `im_vw_grndetail`;

/*!50001 DROP VIEW IF EXISTS `im_vw_grndetail` */;
/*!50001 DROP TABLE IF EXISTS `im_vw_grndetail` */;

/*!50001 CREATE TABLE  `im_vw_grndetail`(
 `id` int(20) ,
 `im_grnnumber` varchar(50) ,
 `im_purordnum` varchar(50) ,
 `cm_code` varchar(50) ,
 `cm_name` varchar(200) ,
 `im_BatchNumber` varchar(50) ,
 `im_ExpireDate` date ,
 `im_RcvQuantity` int(11) ,
 `im_costprice` decimal(20,2) ,
 `im_unit` varchar(50) ,
 `im_unitqty` int(11) ,
 `im_rowamount` decimal(20,2) 
)*/;

/*Table structure for table `im_vw_purchasedt` */

DROP TABLE IF EXISTS `im_vw_purchasedt`;

/*!50001 DROP VIEW IF EXISTS `im_vw_purchasedt` */;
/*!50001 DROP TABLE IF EXISTS `im_vw_purchasedt` */;

/*!50001 CREATE TABLE  `im_vw_purchasedt`(
 `pp_purordnum` varchar(50) ,
 `cm_code` varchar(50) ,
 `cm_name` varchar(200) ,
 `pp_unit` varchar(50) ,
 `pp_unitqty` int(11) ,
 `pp_quantity` bigint(12) ,
 `pp_purchasrate` decimal(20,2) ,
 `pp_totalamount` decimal(30,0) 
)*/;

/*Table structure for table `im_vw_purchaseordhd` */

DROP TABLE IF EXISTS `im_vw_purchaseordhd`;

/*!50001 DROP VIEW IF EXISTS `im_vw_purchaseordhd` */;
/*!50001 DROP TABLE IF EXISTS `im_vw_purchaseordhd` */;

/*!50001 CREATE TABLE  `im_vw_purchaseordhd`(
 `id` int(20) ,
 `pp_purordnum` varchar(50) ,
 `cm_supplierid` varchar(50) ,
 `cm_orgname` varchar(100) ,
 `Order_Date` date ,
 `Delivery_Date` date ,
 `pp_status` varchar(20) 
)*/;

/*Table structure for table `im_vw_stock` */

DROP TABLE IF EXISTS `im_vw_stock`;

/*!50001 DROP VIEW IF EXISTS `im_vw_stock` */;
/*!50001 DROP TABLE IF EXISTS `im_vw_stock` */;

/*!50001 CREATE TABLE  `im_vw_stock`(
 `cm_code` varchar(50) ,
 `cm_name` varchar(200) ,
 `im_BatchNumber` varchar(50) ,
 `im_ExpireDate` date ,
 `im_storeid` varchar(50) ,
 `im_rate` decimal(20,2) ,
 `im_unit` varchar(50) ,
 `issueqty` decimal(32,0) ,
 `saleqty` decimal(43,0) ,
 `inhandqty` decimal(42,0) ,
 `available` decimal(44,0) 
)*/;

/*Table structure for table `im_vw_transferissue` */

DROP TABLE IF EXISTS `im_vw_transferissue`;

/*!50001 DROP VIEW IF EXISTS `im_vw_transferissue` */;
/*!50001 DROP TABLE IF EXISTS `im_vw_transferissue` */;

/*!50001 CREATE TABLE  `im_vw_transferissue`(
 `ProCode` varchar(50) ,
 `Batch` varchar(50) ,
 `FromStore` varchar(50) ,
 `IssueQty` decimal(32,0) 
)*/;

/*Table structure for table `im_vw_transferre` */

DROP TABLE IF EXISTS `im_vw_transferre`;

/*!50001 DROP VIEW IF EXISTS `im_vw_transferre` */;
/*!50001 DROP TABLE IF EXISTS `im_vw_transferre` */;

/*!50001 CREATE TABLE  `im_vw_transferre`(
 `ProCode` varchar(50) ,
 `Batch` varchar(50) ,
 `ToStore` varchar(50) ,
 `ReQty` decimal(32,0) 
)*/;

/*Table structure for table `im_vw_trn` */

DROP TABLE IF EXISTS `im_vw_trn`;

/*!50001 DROP VIEW IF EXISTS `im_vw_trn` */;
/*!50001 DROP TABLE IF EXISTS `im_vw_trn` */;

/*!50001 CREATE TABLE  `im_vw_trn`(
 `trnnumber` varchar(50) ,
 `procode` varchar(50) ,
 `proname` varchar(200) ,
 `store` varchar(100) ,
 `bnumber` varchar(50) ,
 `expdate` date ,
 `qty` int(11) ,
 `unit` varchar(50) ,
 `rate` decimal(20,2) ,
 `value` decimal(30,2) ,
 `status` varchar(50) 
)*/;

/*Table structure for table `sm_vw_cusreceivable` */

DROP TABLE IF EXISTS `sm_vw_cusreceivable`;

/*!50001 DROP VIEW IF EXISTS `sm_vw_cusreceivable` */;
/*!50001 DROP TABLE IF EXISTS `sm_vw_cusreceivable` */;

/*!50001 CREATE TABLE  `sm_vw_cusreceivable`(
 `cm_code` varchar(20) ,
 `cm_name` varchar(100) ,
 `cm_group` varchar(50) ,
 `cm_address` varchar(250) ,
 `cm_cellnumber` varchar(50) ,
 `sm_receivable` decimal(52,2) 
)*/;

/*Table structure for table `sm_vw_mralc` */

DROP TABLE IF EXISTS `sm_vw_mralc`;

/*!50001 DROP VIEW IF EXISTS `sm_vw_mralc` */;
/*!50001 DROP TABLE IF EXISTS `sm_vw_mralc` */;

/*!50001 CREATE TABLE  `sm_vw_mralc`(
 `sm_invnumber` varchar(20) ,
 `cm_cuscode` varchar(20) ,
 `sm_sign` int(11) ,
 `sm_rcvamt` decimal(20,2) 
)*/;

/*Table structure for table `sm_vw_mrrcv` */

DROP TABLE IF EXISTS `sm_vw_mrrcv`;

/*!50001 DROP VIEW IF EXISTS `sm_vw_mrrcv` */;
/*!50001 DROP TABLE IF EXISTS `sm_vw_mrrcv` */;

/*!50001 CREATE TABLE  `sm_vw_mrrcv`(
 `sm_invnumber` varchar(20) ,
 `cm_cuscode` varchar(20) ,
 `sm_amount` decimal(52,2) 
)*/;

/*Table structure for table `sm_vw_salealc` */

DROP TABLE IF EXISTS `sm_vw_salealc`;

/*!50001 DROP VIEW IF EXISTS `sm_vw_salealc` */;
/*!50001 DROP TABLE IF EXISTS `sm_vw_salealc` */;

/*!50001 CREATE TABLE  `sm_vw_salealc`(
 `sm_store` varchar(20) ,
 `sm_code` varchar(50) ,
 `sm_batchnumber` varchar(50) ,
 `sm_quantity` decimal(43,0) 
)*/;

/*View structure for view am_vw_apayable */

/*!50001 DROP TABLE IF EXISTS `am_vw_apayable` */;
/*!50001 DROP VIEW IF EXISTS `am_vw_apayable` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `am_vw_apayable` AS select `a`.`am_subacccode` AS `suppliercode`,`b`.`cm_orgname` AS `suppliername`,`a`.`am_accountcode` AS `accoutcode`,`b`.`cm_contactperson` AS `conperson`,abs(sum(`a`.`am_baseamt`)) AS `payableamt` from (`am_voucherdetail` `a` join `cm_suppliermaster` `b` on((`a`.`am_subacccode` = `b`.`cm_supplierid`))) group by `a`.`am_subacccode` */;

/*View structure for view am_vw_gltrn */

/*!50001 DROP TABLE IF EXISTS `am_vw_gltrn` */;
/*!50001 DROP VIEW IF EXISTS `am_vw_gltrn` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `am_vw_gltrn` AS select `a`.`am_vouchernumber` AS `am_vouchernumber`,`a`.`am_accountcode` AS `am_accountcode`,`b`.`am_description` AS `am_description`,(case when (`a`.`am_baseamt` > 0) then `a`.`am_baseamt` end) AS `debit`,(case when (`a`.`am_baseamt` < 0) then abs(`a`.`am_baseamt`) end) AS `credit` from (`am_voucherdetail` `a` join `am_chartofaccounts` `b`) where (`a`.`am_accountcode` = `b`.`am_accountcode`) */;

/*View structure for view am_vw_payinvc */

/*!50001 DROP TABLE IF EXISTS `am_vw_payinvc` */;
/*!50001 DROP VIEW IF EXISTS `am_vw_payinvc` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `am_vw_payinvc` AS select `a`.`am_subacccode` AS `suppliercode`,`a`.`am_vouchernumber` AS `invoicnumber`,`a`.`am_currency` AS `currency`,`a`.`am_exchagerate` AS `exchange`,`a`.`am_primeamt` AS `primaamt`,`a`.`am_baseamt` AS `amount` from (`am_voucherdetail` `a` join `cm_suppliermaster` `b` on(((`a`.`am_subacccode` = `b`.`cm_supplierid`) and (left(`a`.`am_vouchernumber`,4) = 'INVC')))) union all select `d`.`am_subacccode` AS `am_subacccode`,`c`.`am_invnumber` AS `am_invnumber`,`c`.`am_currency` AS `am_currency`,`c`.`am_exchagerate` AS `am_exchagerate`,`c`.`am_primeamt` AS `am_primeamt`,`c`.`am_amount` AS `am_amount` from ((`am_apalc` `c` join `am_voucherdetail` `d` on((`c`.`am_vouchernumber` = `d`.`am_vouchernumber`))) join `cm_suppliermaster` `e` on((`d`.`am_subacccode` = `e`.`cm_supplierid`))) */;

/*View structure for view am_vw_unpaidinv */

/*!50001 DROP TABLE IF EXISTS `am_vw_unpaidinv` */;
/*!50001 DROP VIEW IF EXISTS `am_vw_unpaidinv` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `am_vw_unpaidinv` AS select `am_vw_payinvc`.`suppliercode` AS `suppliercode`,`am_vw_payinvc`.`invoicnumber` AS `invoicnumber`,`am_vw_payinvc`.`currency` AS `currency`,`am_vw_payinvc`.`exchange` AS `exchange`,abs(sum(`am_vw_payinvc`.`primaamt`)) AS `primaamt`,abs(sum(`am_vw_payinvc`.`amount`)) AS `amount` from `am_vw_payinvc` group by `am_vw_payinvc`.`suppliercode`,`am_vw_payinvc`.`invoicnumber` having (abs(sum(`am_vw_payinvc`.`amount`)) > 0) */;

/*View structure for view im_vw_grndetail */

/*!50001 DROP TABLE IF EXISTS `im_vw_grndetail` */;
/*!50001 DROP VIEW IF EXISTS `im_vw_grndetail` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `im_vw_grndetail` AS select `a`.`id` AS `id`,`a`.`im_grnnumber` AS `im_grnnumber`,`c`.`im_purordnum` AS `im_purordnum`,`a`.`cm_code` AS `cm_code`,`b`.`cm_name` AS `cm_name`,`a`.`im_BatchNumber` AS `im_BatchNumber`,`a`.`im_ExpireDate` AS `im_ExpireDate`,`a`.`im_RcvQuantity` AS `im_RcvQuantity`,`a`.`im_costprice` AS `im_costprice`,`a`.`im_unit` AS `im_unit`,`a`.`im_unitqty` AS `im_unitqty`,`a`.`im_rowamount` AS `im_rowamount` from ((`im_grndetail` `a` join `cm_productmaster` `b` on((convert(`a`.`cm_code` using utf8) = `b`.`cm_code`))) join `im_grnheader` `c` on((`a`.`im_grnnumber` = `c`.`im_grnnumber`))) */;

/*View structure for view im_vw_purchasedt */

/*!50001 DROP TABLE IF EXISTS `im_vw_purchasedt` */;
/*!50001 DROP VIEW IF EXISTS `im_vw_purchasedt` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `im_vw_purchasedt` AS select `a`.`pp_purordnum` AS `pp_purordnum`,`a`.`cm_code` AS `cm_code`,`b`.`cm_name` AS `cm_name`,`a`.`pp_unit` AS `pp_unit`,`a`.`pp_unitqty` AS `pp_unitqty`,(`a`.`pp_quantity` - ifnull(`a`.`pp_grnqty`,0)) AS `pp_quantity`,`a`.`pp_purchasrate` AS `pp_purchasrate`,round((`a`.`pp_purchasrate` * (`a`.`pp_quantity` - ifnull(`a`.`pp_grnqty`,0))),0) AS `pp_totalamount` from (`pp_purchaseorddt` `a` join `cm_productmaster` `b` on((`a`.`cm_code` = `b`.`cm_code`))) group by `a`.`pp_purordnum`,`a`.`cm_code` having (sum((`a`.`pp_quantity` - ifnull(`a`.`pp_grnqty`,0))) > 0) */;

/*View structure for view im_vw_purchaseordhd */

/*!50001 DROP TABLE IF EXISTS `im_vw_purchaseordhd` */;
/*!50001 DROP VIEW IF EXISTS `im_vw_purchaseordhd` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `im_vw_purchaseordhd` AS select `a`.`id` AS `id`,`a`.`pp_purordnum` AS `pp_purordnum`,`a`.`cm_supplierid` AS `cm_supplierid`,`b`.`cm_orgname` AS `cm_orgname`,`a`.`pp_date` AS `Order_Date`,`a`.`pp_deliverydate` AS `Delivery_Date`,`a`.`pp_status` AS `pp_status` from (`pp_purchaseordhd` `a` join `cm_suppliermaster` `b` on((`a`.`cm_supplierid` = `b`.`cm_supplierid`))) where (`a`.`pp_status` in ('Approved','Part Received')) */;

/*View structure for view im_vw_stock */

/*!50001 DROP TABLE IF EXISTS `im_vw_stock` */;
/*!50001 DROP VIEW IF EXISTS `im_vw_stock` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `im_vw_stock` AS select `a`.`cm_code` AS `cm_code`,`c`.`cm_name` AS `cm_name`,`a`.`im_BatchNumber` AS `im_BatchNumber`,`a`.`im_ExpireDate` AS `im_ExpireDate`,`a`.`im_storeid` AS `im_storeid`,`a`.`im_rate` AS `im_rate`,`a`.`im_unit` AS `im_unit`,ifnull(`b`.`IssueQty`,0) AS `issueqty`,ifnull(`d`.`sm_quantity`,0) AS `saleqty`,ifnull(sum(ifnull((`a`.`im_quantity` * `a`.`im_sign`),0)),0) AS `inhandqty`,ifnull(((sum(ifnull((`a`.`im_quantity` * `a`.`im_sign`),0)) - ifnull(`b`.`IssueQty`,0)) - ifnull(`d`.`sm_quantity`,0)),0) AS `available` from (((`im_transaction` `a` left join `im_vw_transferissue` `b` on(((`a`.`im_BatchNumber` = `b`.`Batch`) and (`a`.`im_storeid` = `b`.`FromStore`) and (`a`.`cm_code` = `b`.`ProCode`)))) left join `sm_vw_salealc` `d` on(((`a`.`im_BatchNumber` = `d`.`sm_batchnumber`) and (`a`.`im_storeid` = `d`.`sm_store`) and (`a`.`cm_code` = `d`.`sm_code`)))) left join `cm_productmaster` `c` on((`a`.`cm_code` = `c`.`cm_code`))) group by `a`.`im_ExpireDate`,`a`.`im_BatchNumber`,`a`.`im_storeid` */;

/*View structure for view im_vw_transferissue */

/*!50001 DROP TABLE IF EXISTS `im_vw_transferissue` */;
/*!50001 DROP VIEW IF EXISTS `im_vw_transferissue` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `im_vw_transferissue` AS select `a`.`cm_code` AS `ProCode`,`a`.`im_BatchNumber` AS `Batch`,`b`.`im_fromstore` AS `FromStore`,sum(`a`.`im_quantity`) AS `IssueQty` from (`im_batchtransfer` `a` join `im_transferhd` `b` on((`a`.`im_transfernum` = `b`.`im_transfernum`))) where (`b`.`im_status` = 'Open') group by `a`.`cm_code`,`a`.`im_BatchNumber`,`b`.`im_tostore` */;

/*View structure for view im_vw_transferre */

/*!50001 DROP TABLE IF EXISTS `im_vw_transferre` */;
/*!50001 DROP VIEW IF EXISTS `im_vw_transferre` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `im_vw_transferre` AS select `a`.`cm_code` AS `ProCode`,`a`.`im_BatchNumber` AS `Batch`,`b`.`im_tostore` AS `ToStore`,sum(`a`.`im_quantity`) AS `ReQty` from (`im_batchtransfer` `a` join `im_transferhd` `b` on((`a`.`im_transfernum` = `b`.`im_transfernum`))) where (`b`.`im_status` = 'Open') group by `a`.`cm_code`,`a`.`im_BatchNumber`,`b`.`im_tostore` */;

/*View structure for view im_vw_trn */

/*!50001 DROP TABLE IF EXISTS `im_vw_trn` */;
/*!50001 DROP VIEW IF EXISTS `im_vw_trn` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `im_vw_trn` AS select `a`.`im_number` AS `trnnumber`,`a`.`cm_code` AS `procode`,`b`.`cm_name` AS `proname`,`c`.`cm_description` AS `store`,`a`.`im_BatchNumber` AS `bnumber`,`a`.`im_ExpireDate` AS `expdate`,`a`.`im_quantity` AS `qty`,`a`.`im_unit` AS `unit`,`a`.`im_rate` AS `rate`,(`a`.`im_quantity` * `a`.`im_rate`) AS `value`,`a`.`im_status` AS `status` from ((`im_transaction` `a` join `cm_productmaster` `b`) join `cm_branchmaster` `c`) where ((`a`.`cm_code` = `b`.`cm_code`) and (`a`.`im_storeid` = `c`.`cm_branch`)) */;

/*View structure for view sm_vw_cusreceivable */

/*!50001 DROP TABLE IF EXISTS `sm_vw_cusreceivable` */;
/*!50001 DROP VIEW IF EXISTS `sm_vw_cusreceivable` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `sm_vw_cusreceivable` AS select `a`.`cm_cuscode` AS `cm_code`,`b`.`cm_name` AS `cm_name`,`b`.`cm_group` AS `cm_group`,`b`.`cm_address` AS `cm_address`,`b`.`cm_cellnumber` AS `cm_cellnumber`,sum((`a`.`sm_netamt` * `a`.`sm_sign`)) AS `sm_receivable` from (`sm_header` `a` join `cm_customermst` `b`) where (`a`.`cm_cuscode` = `b`.`cm_cuscode`) group by `a`.`cm_cuscode` */;

/*View structure for view sm_vw_mralc */

/*!50001 DROP TABLE IF EXISTS `sm_vw_mralc` */;
/*!50001 DROP VIEW IF EXISTS `sm_vw_mralc` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `sm_vw_mralc` AS select `sm_header`.`sm_refe_code` AS `sm_invnumber`,`sm_header`.`cm_cuscode` AS `cm_cuscode`,`sm_header`.`sm_sign` AS `sm_sign`,`sm_header`.`sm_netamt` AS `sm_rcvamt` from `sm_header` where ((`sm_header`.`sm_doc_type` in ('Sales','Return')) and (`sm_header`.`sm_stataus` = 'Post to GL')) union all select `b`.`sm_invnumber` AS `sm_invnumber`,`a`.`cm_cuscode` AS `cm_cuscode`,`a`.`sm_sign` AS `sm_sign`,`b`.`sm_amount` AS `sm_amount` from (`sm_header` `a` join `sm_invalc` `b` on(((`a`.`sm_number` = `b`.`sm_number`) and (`a`.`sm_doc_type` = 'Receipt')))) */;

/*View structure for view sm_vw_mrrcv */

/*!50001 DROP TABLE IF EXISTS `sm_vw_mrrcv` */;
/*!50001 DROP VIEW IF EXISTS `sm_vw_mrrcv` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `sm_vw_mrrcv` AS select `sm_vw_mralc`.`sm_invnumber` AS `sm_invnumber`,`sm_vw_mralc`.`cm_cuscode` AS `cm_cuscode`,sum((`sm_vw_mralc`.`sm_sign` * `sm_vw_mralc`.`sm_rcvamt`)) AS `sm_amount` from `sm_vw_mralc` group by `sm_vw_mralc`.`sm_invnumber` having (sum((`sm_vw_mralc`.`sm_sign` * `sm_vw_mralc`.`sm_rcvamt`)) > 0) */;

/*View structure for view sm_vw_salealc */

/*!50001 DROP TABLE IF EXISTS `sm_vw_salealc` */;
/*!50001 DROP VIEW IF EXISTS `sm_vw_salealc` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `sm_vw_salealc` AS select `a`.`sm_storeid` AS `sm_store`,`b`.`cm_code` AS `sm_code`,`b`.`sm_batchnumber` AS `sm_batchnumber`,sum(((`b`.`sm_quantity` + ifnull(`b`.`sm_bonusqty`,0)) * `a`.`sm_sign`)) AS `sm_quantity` from (`sm_header` `a` join `sm_batchsale` `b` on(((`a`.`sm_number` = `b`.`sm_number`) and (`a`.`sm_doc_type` = 'Sales') and (`a`.`sm_stataus` not in ('Delivered','Post to GL'))))) group by `b`.`cm_code`,`b`.`sm_batchnumber`,`a`.`sm_storeid` */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

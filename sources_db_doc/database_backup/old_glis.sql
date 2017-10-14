/*
SQLyog Ultimate v8.55 
MySQL - 5.6.20 : Database - glis
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
USE `glis`;

/*Table structure for table `am_apalc` */

DROP TABLE IF EXISTS `am_apalc`;

CREATE TABLE `am_apalc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `am_vouchernumber` varchar(50) DEFAULT NULL,
  `am_invnumber` varchar(20) DEFAULT NULL,
  `am_date` date DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8;

/*Data for the table `am_apalc` */

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
  `c_exchagerate` decimal(20,5) DEFAULT NULL,
  `c_primeamt` decimal(20,2) DEFAULT NULL,
  `c_baseamt` decimal(20,5) DEFAULT NULL,
  `c_status` varchar(50) DEFAULT NULL,
  `inserttime` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `insertuser` varchar(50) DEFAULT NULL,
  `updateuser` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `c_accountcode` (`c_accountcode`),
  KEY `c_vouchernumber` (`c_vouchernumber`,`c_accountcode`),
  CONSTRAINT `am_balance_ibfk_1` FOREIGN KEY (`c_vouchernumber`) REFERENCES `am_vouhcerheader` (`am_vouchernumber`),
  CONSTRAINT `am_balance_ibfk_2` FOREIGN KEY (`c_accountcode`) REFERENCES `am_chartofaccounts` (`am_accountcode`)
) ENGINE=InnoDB AUTO_INCREMENT=682 DEFAULT CHARSET=utf8;

/*Data for the table `am_balance` */

insert  into `am_balance`(`id`,`c_vouchernumber`,`c_accountcode`,`c_subacc`,`c_date`,`c_branch`,`c_referance`,`c_year`,`c_period`,`c_currency`,`c_exchagerate`,`c_primeamt`,`c_baseamt`,`c_status`,`inserttime`,`updatetime`,`insertuser`,`updateuser`) values (675,'AP--00000001','103-002','','2014-11-11','RUSIZI','Invoiced for GRN number GRN-00000001',2014,11,'USD','1.00000','240.00','240.00000','Post','2014-11-11 16:38:36',NULL,'admin',NULL),(676,'AP--00000001','103-006','','2014-11-11','RUSIZI','Invoiced for GRN number GRN-00000001',2014,11,'USD','1.00000','16.00','16.00000','Post','2014-11-11 16:38:36',NULL,'admin',NULL),(677,'AP--00000001','103-005','','2014-11-11','RUSIZI','Invoiced for GRN number GRN-00000001',2014,11,'USD','1.00000','50.00','50.00000','Post','2014-11-11 16:38:36',NULL,'admin',NULL),(678,'AP--00000001','203-002','ACT','2014-11-11','RUSIZI','Invoiced for GRN number GRN-00000001',2014,11,'USD','1.00000','-321.30','-321.30000','Post','2014-11-11 16:38:36',NULL,'admin',NULL),(679,'AP--00000001','103-7701','','2014-11-11','RUSIZI','Invoiced for GRN number GRN-00000001',2014,11,'USD','1.00000','15.30','15.30000','Post','2014-11-11 16:38:36',NULL,'admin',NULL);

/*Table structure for table `am_chartofaccounts` */

DROP TABLE IF EXISTS `am_chartofaccounts`;

CREATE TABLE `am_chartofaccounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `am_accountcode` (`am_accountcode`),
  KEY `am_description` (`am_description`,`am_accounttype`)
) ENGINE=InnoDB AUTO_INCREMENT=265 DEFAULT CHARSET=utf8;

/*Data for the table `am_chartofaccounts` */

insert  into `am_chartofaccounts`(`id`,`am_accountcode`,`am_description`,`am_accounttype`,`am_accountusage`,`am_groupone`,`am_grouptwo`,`am_groupthree`,`am_groupfour`,`am_analyticalcode`,`am_branch`,`am_status`,`inserttime`,`updatetime`,`insertuser`,`updateuser`) values (146,'101-001','Buildings','Asset','Ledger','101','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(147,'101-002','Motor Vehicles','Asset','Ledger','101','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(148,'101-003','Plant, Machinery & Generators','Asset','Ledger','101','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(150,'101-005','Office equipment, Furniture & fixtures ','Asset','Ledger','101','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(151,'101-006','Computer & peripherals','Asset','Ledger','101','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(152,'102-001','Accumulated depreciation on Buildings','Asset','Ledger','102','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(153,'102-002','Accumulated depreciation on Motor Vehicles ','Asset','Ledger','102','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(154,'102-003','Accumulated depreciation on Plant, Machinery & Generators','Asset','Ledger','102','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(155,'102-004','Accumulated depreciation on Medical- & Lab equipment','Asset','Ledger','102','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(156,'102-005','Accumulated depreciation on Office equipment, Furniture & fixtures','Asset','Ledger','102','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(157,'102-106','Accumulated depreciation on Computer & peripherals','Asset','Ledger','102','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(158,'103-001','Stock of Medicines','Asset','Ledger','103','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(159,'103-002','Stock of Medical Supplies','Asset','Ledger','103','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(160,'103-003','Stock of Nutrition','Asset','Ledger','103','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(161,'103-004','Stock of Household','Asset','Ledger','103','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(162,'103-005','Stock of Fashion','Asset','Ledger','103','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(163,'103-006','Stock of Personal Care','Asset','Ledger','103','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(164,'103-007','Stock of Entertainment','Asset','Ledger','103','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(165,'103-008','Stock of Gerant','Asset','Ledger','103','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(166,'103-009','Stock of Fuel, oil & lubricants','Asset','Ledger','103','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(167,'103-010','Stock of office supplies & stationary','Asset','Ledger','103','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(168,'103-011','Stock of building materials','Asset','Ledger','103','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(169,'103-0100','Receivables - Entrepreneurs','Asset','AR','103','',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin','admin'),(170,'103-6000','Receivables - Staff','Asset','AR','103','',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin','admin'),(171,'103-7000','Receivables - Wholesale clients','Asset','AR','103','',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin','admin'),(172,'103-7300','Receivables - Credit entrepreneurs','Asset','AR','103','',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin','admin'),(173,'103-7501','Receivables - Staff imprest','Asset','AR','103','',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin','admin'),(174,'103-7701','VAT claim (VAT on purchases)','Asset','Ledger','103','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(175,'103-7751','Other receivables','Asset','AR','103','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(176,'103-8001','Pre-paid expenses','Asset','Ledger','103','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(177,'103-8801','Staff advances','Asset','Ledger','103','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(178,'103-9501','Staff loan','Asset','Ledger','103','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(179,'104-001','Cash in Hand (RWF)','Asset','Ledger','104','0',NULL,NULL,'Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(180,'104-002','Cash in Hand (USD)','Asset','Ledger','104','0',NULL,NULL,'Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(181,'104-003','Cash in Hand (EUR)','Asset','Ledger','104','0',NULL,NULL,'Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(182,'104-004','Cash in hand (Other)','Asset','Ledger','104','0',NULL,NULL,'Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(183,'104-200','Bank account RWF - 1','Asset','Ledger','104','0',NULL,NULL,'Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(184,'103-201','Bank account RWF - 2','Asset','Ledger','104','0',NULL,NULL,'Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(185,'104-202','Bank account RWF - 3','Asset','Ledger','104','0',NULL,NULL,'Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(186,'104-203','Bank account USD','Asset','Ledger','104','0',NULL,NULL,'Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(187,'104-204','Bank account EUR','Asset','Ledger','104','0',NULL,NULL,'Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(188,'104-205','Bank account Other','Asset','Ledger','104','0',NULL,NULL,'Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(189,'201-001','Non restricted Capital Fund','Liability','Ledger','201','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(190,'201-002','Restricted Capital Fund','Liability','Ledger','201','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(191,'201-003','Operating fund','Liability','Ledger','201','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(192,'202-001','Long term subordinated loan','Liability','Ledger','202','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(193,'202-002','Long term senior loan','Liability','Ledger','202','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(194,'203-001','Account payable domestic suppliers','Liability','AP','203','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(195,'203-002','Account payable International suppliers','Liability','AP','203','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(196,'203-003','Account payable wholesale suppliers','Liability','AP','203','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(197,'203-004','VAT on sales','Liability','Ledger','203','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(198,'203-005','VAT payable (settlement of VAT)','Liability','Ledger','203','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(199,'203-006','PAYE payable','Liability','AP','203','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(200,'203-007','NHIF payable','Liability','AP','203','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(201,'203-008','Withholding tax payable','Liability','AP','203','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(202,'203-009','Salary & Allowances payable','Liability','AP','203','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(205,'204-010','Other payables','Liability','AP','203','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(206,'204-011','Salary payables','Liability','AP','203','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(207,'204-012','Working capital facility','Liability','Ledger','203','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(208,'204-013','Other short term loans','Liability','Ledger','203','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(209,'301-001','Revenues from Medicines','Income','Ledger','301','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(210,'301-002','Revenues from Medical Supplies','Income','Ledger','301','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(211,'301-003','Revenues from Nutrition','Income','Ledger','301','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(212,'301-004','Revenues from Household','Income','Ledger','301','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(213,'301-005','Revenues from Fashion','Income','Ledger','301','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(214,'301-006','Revenues from Personal Care','Income','Ledger','301','',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin','admin'),(215,'301-007','Revenues from Entertainment','Income','Ledger','301','',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin','admin'),(216,'301-008','Revenues from Gerant','Income','Ledger','301','',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin','admin'),(217,'301-009','Revenues from Direct Sales','Income','Ledger','301','',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin','admin'),(218,'301-010','Revenues from (Consultancy) Services','Income','Ledger','301','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(219,'301-011','Revenues from other operational activities (hiring assets)','Income','Ledger','301','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(220,'302-001','Revenues from restricted grants','Income','Ledger','302','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(221,'302-002','Revenues from non-restricted grants','Income','Ledger','302','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(222,'302-003','Revenues from domestic donors','Income','Ledger','302','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(223,'302-004','Revenues from private donors','Income','Ledger','302','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(224,'302-005','Revenues from HE HQs','Income','Ledger','302','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(225,'302-006','Revenues from other grants','Income','Ledger','302','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(226,'303-001','Revenues from patents & royalties','Income','Ledger','303','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(227,'303-002','Revenues from interest, dividends & derivatives','Income','Ledger','303','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(229,'303-003','Revenues from sale of assets/disposals','Income','Ledger','303','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(230,'303-005','Other miscellaneous revenues','Income','Ledger','303','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(231,'401-001','Expenditures from Medicines','Expenses','Ledger','401','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(232,'401-002','Expenditures from Medical Supplies','Expenses','Ledger','401','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(233,'401-003','Expenditures from Nutrition','Expenses','Ledger','401','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(234,'401-004','Expenditures from Household','Expenses','Ledger','401','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(235,'401-005','Expenditures from Fashion','Expenses','Ledger','401','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(236,'401-006','Expenditures from Personal Care','Expenses','Ledger','401','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(237,'401-007','Expenditures from Entertainment','Expenses','Ledger','401','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(238,'401-008','Expenditures from Gerant','Expenses','Ledger','401','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(239,'401-009','Expenditures from Direct Sales','Expenses','Ledger','401','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(240,'401-010','Expenditures from (Consultancy) Services','Expenses','Ledger','401','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(241,'401-011','Expenditures from other operational activities','Expenses','Ledger','401','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(242,'402-001','Salary, Wages & Allowances ','Expenses','Ledger','402','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(243,'402-002','Pension scheme contribution','Expenses','Ledger','402','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(244,'402-003','Office & warehouse rent','Expenses','Ledger','402','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(245,'402-004','Telephone & internet','Expenses','Ledger','402','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(246,'402-005','Office supplies & stationery','Expenses','Ledger','402','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(247,'402-006','Travelling & accommodation','Expenses','Ledger','402','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(248,'402-007','Fuel, oil & lubricants','Expenses','Ledger','402','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(249,'402-008','Transport clearing & handling','Expenses','Ledger','402','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(250,'402-009','Audit, lawyer & other professional fees','Expenses','Ledger','402','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(251,'402-010','Provision of bad debts','Expenses','Ledger','402','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(252,'402-011','Donation / Charity','Expenses','Ledger','402','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(253,'402-012','Depreciation','Expenses','Ledger','402','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(254,'402-013','Building & other materials','Expenses','Ledger','402','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(255,'402-014','Maintenance & road licenses & insurances','Expenses','Ledger','402','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(256,'402-015','Marketing & promotion','Expenses','Ledger','402','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(257,'402-016','Training','Expenses','Ledger','402','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(258,'402-017','Other Administrative expenditures','Expenses','Ledger','402','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(259,'403-001','Bank & transfer charges','Expenses','Ledger','403','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(260,'403-002','Exchange gain / loss','Expenses','Ledger','403','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(261,'403-003','Impairments','Expenses','Ledger','403','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(262,'403-004','Interest & other financial expenditures','Expenses','Ledger','403','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 10:41:12','0000-00-00 00:00:00','admin',''),(263,'403-005','Sales Discount','Expenses','Ledger','404','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 05:53:00','0000-00-00 00:00:00','admin',''),(264,'303-006','Misc loss due to pilferage','Expenses','Ledger','404','0',NULL,NULL,'Non-Cash',NULL,'Open','2014-11-05 07:30:00','0000-00-00 00:00:00','admin','');

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

insert  into `am_default`(`id`,`am_offset`,`am_pnlacount`,`am_year`,`am_period`,`inserttime`,`updatetime`,`insertuser`,`updateuser`) values (1,0,'20201',2014,1,'2014-01-01 12:23:00',NULL,'admin',NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

/*Data for the table `am_group_one` */

insert  into `am_group_one`(`id`,`am_groupone`,`am_description`,`inserttime`,`updatetime`,`insertuser`,`updateuser`) values (31,'101','FIXED ASSETS','2014-11-05 10:37:45','0000-00-00 00:00:00','admin',''),(32,'102','DEPRECIATION','2014-11-05 10:37:53','0000-00-00 00:00:00','admin',''),(34,'104','CASH & BANK','2014-11-05 10:37:54','0000-00-00 00:00:00','admin',''),(35,'105','OTHER MISCELLANEOUS ASSETS','2014-11-05 10:37:54','0000-00-00 00:00:00','admin',''),(36,'201','FUNDS OR GRANTS','2014-11-05 10:37:55','0000-00-00 00:00:00','admin',''),(37,'202','LONG TERM LIABILITIES','2014-11-05 10:37:55','0000-00-00 00:00:00','admin',''),(38,'203','CURRENT LIABILITIES','2014-11-05 10:37:56','0000-00-00 00:00:00','admin',''),(39,'301','OPERATIONAL REVENUES','2014-11-05 10:37:56','0000-00-00 00:00:00','admin',''),(40,'302','REVENUES GRANTS','2014-11-05 10:37:57','0000-00-00 00:00:00','admin',''),(41,'303','MISCELLANEOUS REVENUES','2014-11-05 10:37:57','0000-00-00 00:00:00','admin',''),(42,'401','COSTS OF GOODS SOLD (COGS)','2014-11-05 10:37:58','0000-00-00 00:00:00','admin',''),(43,'402','SG&A EXPENDITURES','2014-11-05 10:37:58','0000-00-00 00:00:00','admin',''),(44,'403','FINANCIAL EXPENSES','2014-11-05 10:38:00','0000-00-00 00:00:00','admin',''),(45,'404','OTHER MISCELLANEOUS EXPENSES','2014-11-05 10:37:59','0000-00-00 00:00:00','admin','');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `am_group_three` */

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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

/*Data for the table `am_group_two` */

/*Table structure for table `am_voucherdetail` */

DROP TABLE IF EXISTS `am_voucherdetail`;

CREATE TABLE `am_voucherdetail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `am_vouchernumber` varchar(50) NOT NULL,
  `am_accountcode` varchar(50) NOT NULL,
  `am_subacccode` varchar(50) DEFAULT NULL,
  `am_currency` varchar(10) DEFAULT NULL,
  `am_exchagerate` decimal(20,5) DEFAULT NULL,
  `am_primeamt` decimal(20,2) DEFAULT NULL,
  `am_baseamt` decimal(20,5) DEFAULT NULL,
  `am_branch` varchar(50) DEFAULT NULL,
  `am_note` varchar(255) DEFAULT NULL,
  `c_status` varchar(50) DEFAULT NULL,
  `inserttime` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `insertuser` varchar(50) DEFAULT NULL,
  `updateuser` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `am_vouchernumber` (`am_vouchernumber`,`am_accountcode`),
  KEY `am_accountcode` (`am_accountcode`),
  CONSTRAINT `am_voucherdetail_ibfk_1` FOREIGN KEY (`am_vouchernumber`) REFERENCES `am_vouhcerheader` (`am_vouchernumber`),
  CONSTRAINT `am_voucherdetail_ibfk_2` FOREIGN KEY (`am_accountcode`) REFERENCES `am_chartofaccounts` (`am_accountcode`)
) ENGINE=InnoDB AUTO_INCREMENT=782 DEFAULT CHARSET=utf8;

/*Data for the table `am_voucherdetail` */

insert  into `am_voucherdetail`(`id`,`am_vouchernumber`,`am_accountcode`,`am_subacccode`,`am_currency`,`am_exchagerate`,`am_primeamt`,`am_baseamt`,`am_branch`,`am_note`,`c_status`,`inserttime`,`updatetime`,`insertuser`,`updateuser`) values (777,'AP--00000001','103-002','','USD','1.00000','240.00','240.00000','RUSIZI','Inventory Debit automatic',NULL,'2014-11-11 16:38:35',NULL,'admin',NULL),(778,'AP--00000001','103-006','','USD','1.00000','16.00','16.00000','RUSIZI','Inventory Debit automatic',NULL,'2014-11-11 16:38:36',NULL,'admin',NULL),(779,'AP--00000001','103-005','','USD','1.00000','50.00','50.00000','RUSIZI','Inventory Debit automatic',NULL,'2014-11-11 16:38:36',NULL,'admin',NULL),(780,'AP--00000001','203-002','ACT','USD','1.00000','-321.30','-321.30000','RUSIZI','Receiveable Credit automatic',NULL,'2014-11-11 16:38:36',NULL,'admin',NULL),(781,'AP--00000001','103-7701','','USD','1.00000','15.30','15.30000','RUSIZI','Inventory Credit automatic',NULL,'2014-11-11 16:38:36',NULL,'admin',NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=422 DEFAULT CHARSET=utf8;

/*Data for the table `am_vouhcerheader` */

insert  into `am_vouhcerheader`(`id`,`am_vouchernumber`,`am_date`,`am_referance`,`am_year`,`am_period`,`am_branch`,`am_note`,`am_status`,`inserttime`,`updatetime`,`insertuser`,`updateuser`) values (421,'AP--00000001','2014-11-11','Invoiced for GRN number GRN-00000001',2014,11,'RUSIZI','This invoice automatic create from GRN-00000001','Posted','2014-11-11 16:38:35',NULL,'admin',NULL);

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

insert  into `authassignment`(`itemname`,`userid`,`bizrule`,`data`) values ('admin','1',NULL,NULL),('Operator ','10',NULL,'N;'),('Operator ','2',NULL,'N;'),('Operator ','3',NULL,'N;'),('Operator ','9',NULL,'N;');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cm_branchcurrency` */

/*Table structure for table `cm_branchmaster` */

DROP TABLE IF EXISTS `cm_branchmaster`;

CREATE TABLE `cm_branchmaster` (
  `cm_branch` varchar(50) NOT NULL,
  `cm_description` varchar(100) DEFAULT NULL,
  `cm_currency` varchar(50) DEFAULT NULL,
  `cm_exchrate` decimal(20,5) DEFAULT NULL,
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

insert  into `cm_branchmaster`(`cm_branch`,`cm_description`,`cm_currency`,`cm_exchrate`,`cm_contacperson`,`cm_designation`,`cm_mailingaddress`,`cm_phone`,`cm_cell`,`cm_fax`,`active`,`inserttime`,`updatetime`,`insertuser`,`updateuser`) values ('RUSIZI','Main Warehouse','USD','1.00000','','','','','','',1,'2014-11-02 10:49:00','2014-11-03 05:57:00','admin','admin');

/*Table structure for table `cm_codesparam` */

DROP TABLE IF EXISTS `cm_codesparam`;

CREATE TABLE `cm_codesparam` (
  `cm_type` varchar(50) NOT NULL,
  `cm_code` varchar(50) NOT NULL,
  `cm_desc` varchar(150) DEFAULT NULL,
  `cm_accdisc` varchar(50) DEFAULT NULL,
  `cm_acccode` varchar(50) DEFAULT NULL,
  `cm_accrtn` varchar(50) DEFAULT NULL,
  `cm_accdr` varchar(50) DEFAULT NULL,
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

insert  into `cm_codesparam`(`cm_type`,`cm_code`,`cm_desc`,`cm_accdisc`,`cm_acccode`,`cm_accrtn`,`cm_accdr`,`cm_props`,`cm_long`,`cm_percent`,`cm_purtax`,`cm_acctax`,`cm_branch`,`cm_active`,`inserttime`,`updatetime`,`insertuser`,`updateuser`) values ('BankCash','02','HSBC Bank',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2014-04-13 18:07:00','0000-00-00 00:00:00','admin',''),('Currency','BIF','Burundian Franc',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2014-06-11 09:32:00','0000-00-00 00:00:00','admin',''),('Currency','CDF','Congolese Franc',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2014-06-11 09:33:00','0000-00-00 00:00:00','admin',''),('Currency','FRN','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2014-07-02 13:47:00','0000-00-00 00:00:00','admin',''),('Currency','RWA','Rwandan Franc',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2014-06-11 09:32:00','0000-00-00 00:00:00','admin',''),('Currency','USD','US Dollar',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2014-06-11 09:36:00','0000-00-00 00:00:00','admin',''),('Customer Group','WHOLESALE',NULL,'403-005','103-7000',NULL,'301-009',NULL,NULL,NULL,NULL,'203-004',NULL,1,'2014-11-03 06:27:00','2014-11-05 05:54:00','admin','admin'),('Department','01','Accounts',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2014-04-13 18:10:00','0000-00-00 00:00:00','admin',''),('Designation','01','Executive',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2014-04-13 18:10:00','0000-00-00 00:00:00','admin',''),('Leave Plan','01','General Leave Plan',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2014-04-13 18:12:00','0000-00-00 00:00:00','admin',''),('Market','0021','Test',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2014-05-08 11:07:00','0000-00-00 00:00:00','admin',''),('Market','CONSUMERS','CONSUMERS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2014-05-07 10:23:00','0000-00-00 00:00:00','admin',''),('Market','HEALTH CARE','HEALTH CARE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2014-05-07 10:22:00','0000-00-00 00:00:00','admin',''),('Position','101','A',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2014-04-13 18:09:00','0000-00-00 00:00:00','admin',''),('Product Category','ENTERTAINMENT','ENTERTAINMENT',NULL,'301-007','407-002','103-007',NULL,NULL,NULL,'0',NULL,NULL,1,'2014-05-27 10:12:00','2014-11-05 05:46:00','admin','admin'),('Product Category','FASHION','FASHION',NULL,'301-005','407-003','103-005',NULL,NULL,NULL,'0',NULL,NULL,1,'2014-05-27 10:11:00','2014-11-05 05:47:00','admin','admin'),('Product Category','GERANT','GERANT',NULL,'301-008','407-004','103-008',NULL,NULL,NULL,'0',NULL,NULL,1,'2014-07-03 06:50:00','2014-11-05 05:47:00','admin','admin'),('Product Category','HOUSEHOLD','HOUSEHOLD',NULL,'301-004','407-005','103-004',NULL,NULL,NULL,'0',NULL,NULL,1,'2014-01-04 16:20:00','2014-11-05 05:47:00','admin','admin'),('Product Category','MEDICAL SUPPLIES','Medical Supplies',NULL,'301-002',NULL,'103-002',NULL,NULL,NULL,NULL,NULL,NULL,1,'2014-11-02 12:08:00','2014-11-05 05:47:00','admin','admin'),('Product Category','MEDICINE','MEDICINE',NULL,'301-001','407-006','103-001',NULL,NULL,NULL,'0',NULL,NULL,1,'2014-05-27 10:11:00','2014-11-05 05:48:00','admin','admin'),('Product Category','NUTRITION','NUTRITION',NULL,'301-003','407-007','103-003',NULL,NULL,NULL,'0',NULL,NULL,1,'2014-05-27 10:12:00','2014-11-05 05:48:00','admin','admin'),('Product Category','PERSONAL','PERSONAL',NULL,'301-006','407-008','103-006',NULL,NULL,NULL,'0',NULL,NULL,1,'2014-05-27 10:11:00','2014-11-05 05:49:00','admin','admin'),('Product Class','PRODUCT','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2014-07-15 06:20:00','0000-00-00 00:00:00','admin',''),('Product Class','SERVICE','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2014-07-15 06:21:00','0000-00-00 00:00:00','admin',''),('Product Group','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2014-07-03 06:48:00','0000-00-00 00:00:00','admin',''),('Product Group','ACCESSOIRES','Accessoires',NULL,'31010',NULL,NULL,NULL,NULL,NULL,'0',NULL,NULL,1,'2014-06-11 11:26:00','2014-06-26 13:41:00','admin','admin'),('Product Group','BODY CARE','Body care',NULL,'31010',NULL,NULL,NULL,NULL,NULL,'0',NULL,NULL,1,'2014-06-11 11:27:00','2014-06-23 14:35:00','admin','admin'),('Product Group','CONTRACEPTIVE','Contraceptive',NULL,'31022',NULL,NULL,NULL,NULL,NULL,'0',NULL,NULL,1,'2014-06-11 11:27:00','2014-06-23 14:35:00','admin','admin'),('Product Group','COSMETICS','Cosmetics',NULL,'31022',NULL,NULL,NULL,NULL,NULL,'0',NULL,NULL,1,'2014-06-11 11:27:00','2014-06-23 14:35:00','admin','admin'),('Product Group','ELECTRONICS','Electroniks',NULL,'32015',NULL,NULL,NULL,NULL,NULL,'0',NULL,NULL,1,'2014-06-11 11:20:00','2014-07-01 13:11:00','admin','admin'),('Product Group','EYE CARE','Eye care',NULL,'32015',NULL,NULL,NULL,NULL,NULL,'0',NULL,NULL,1,'2014-06-11 11:27:00','2014-06-23 14:36:00','admin','admin'),('Product Group','FOOD','Food',NULL,'33110',NULL,NULL,NULL,NULL,NULL,'0',NULL,NULL,1,'2014-06-11 11:28:00','2014-06-23 14:36:00','admin','admin'),('Product Group','FUN','Fun',NULL,'33110',NULL,NULL,NULL,NULL,NULL,'0',NULL,NULL,1,'2014-06-11 11:21:00','2014-06-23 14:37:00','admin','admin'),('Product Group','HAIR CARE','Hair care',NULL,'31010',NULL,NULL,NULL,NULL,NULL,'0',NULL,NULL,1,'2014-06-11 11:27:00','2014-06-23 14:37:00','admin','admin'),('Product Group','HOME','Home',NULL,'33110',NULL,NULL,NULL,NULL,NULL,'0',NULL,NULL,1,'2014-06-11 11:26:00','2014-06-23 14:38:00','admin','admin'),('Product Group','HYGIENE','Hygiene',NULL,'31010',NULL,NULL,NULL,NULL,NULL,'0',NULL,NULL,1,'2014-06-11 11:26:00','2014-06-23 14:38:00','admin','admin'),('Product Group','JEWELRY','Jewelry',NULL,'33110',NULL,NULL,NULL,NULL,NULL,'0',NULL,NULL,1,'2014-06-11 11:25:00','2014-06-23 14:39:00','admin','admin'),('Product Group','SCHOOL','School',NULL,'31022',NULL,NULL,NULL,NULL,NULL,'0',NULL,NULL,1,'2014-06-11 11:26:00','2014-06-23 14:39:00','admin','admin'),('Product Group','SOLAR','Solar',NULL,'31022',NULL,NULL,NULL,NULL,NULL,'0',NULL,NULL,1,'2014-06-11 11:26:00','2014-06-23 14:39:00','admin','admin'),('Product Group','SUPPLEMENT','Supplement',NULL,'31022',NULL,NULL,NULL,NULL,NULL,'0',NULL,NULL,1,'2014-06-11 11:27:00','2014-06-23 14:40:00','admin','admin'),('Product Group','WATER','Water',NULL,'31022',NULL,NULL,NULL,NULL,NULL,'0',NULL,NULL,1,'2014-06-11 11:28:00','2014-06-23 14:40:00','admin','admin'),('Salary Type','BASIC',NULL,NULL,NULL,NULL,NULL,'Addition','Main Component Addition','50.00',NULL,NULL,NULL,1,'2014-04-13 18:14:00','0000-00-00 00:00:00','admin',''),('Salary Type','HOUSE RENT',NULL,NULL,NULL,NULL,NULL,'Addition','Main Component Addition','10.00',NULL,NULL,NULL,1,'2014-04-13 18:15:00','0000-00-00 00:00:00','admin',''),('Supplier Group','SUPPLIER','SUPPLIER',NULL,'203-002',NULL,NULL,NULL,NULL,NULL,NULL,'103-7701',NULL,1,'2014-11-03 07:07:00','2014-11-05 05:50:00','admin','admin'),('Unit Of Measurement','BOX','Box',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2014-11-02 05:23:00','0000-00-00 00:00:00','admin',''),('Unit Of Measurement','KG','kg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2014-11-02 05:23:00','0000-00-00 00:00:00','admin',''),('Unit Of Measurement','PACK','Packet',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2014-11-02 05:23:00','0000-00-00 00:00:00','admin',''),('Unit Of Measurement','PCS','Piece',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2014-11-02 05:21:00','0000-00-00 00:00:00','admin',''),('Unit Of Measurement','PKT','Packet',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2014-11-03 05:46:00','0000-00-00 00:00:00','admin',''),('Unit Of Measurement','SACHETS','Sachets',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2014-11-03 05:47:00','0000-00-00 00:00:00','admin',''),('Unit Of Measurement','SIZE','Size',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2014-11-02 05:23:00','0000-00-00 00:00:00','admin',''),('Unit Of Measurement','TABS','Tablet',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2014-11-03 05:46:00','0000-00-00 00:00:00','admin','');

/*Table structure for table `cm_currency` */

DROP TABLE IF EXISTS `cm_currency`;

CREATE TABLE `cm_currency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cm_currency` varchar(10) DEFAULT NULL,
  `cm_description` varchar(100) DEFAULT NULL,
  `cm_exchangerate` decimal(20,5) DEFAULT NULL,
  `cm_active` int(11) DEFAULT NULL,
  `inserttime` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `insertuser` varchar(50) DEFAULT NULL,
  `updateuser` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cm_currency` (`cm_currency`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

/*Data for the table `cm_currency` */

insert  into `cm_currency`(`id`,`cm_currency`,`cm_description`,`cm_exchangerate`,`cm_active`,`inserttime`,`updatetime`,`insertuser`,`updateuser`) values (13,'USD','US Dollar','1.00000',1,'2014-11-02 10:49:00','0000-00-00 00:00:00','admin',''),(14,'EUR','European Union Euro','1.00000',1,'2014-11-02 10:49:00','0000-00-00 00:00:00','admin','');

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

insert  into `cm_customermst`(`cm_cuscode`,`cm_name`,`cm_address`,`cm_territory`,`cm_group`,`c_type`,`cm_cellnumber`,`cm_phone`,`cm_fax`,`cm_email`,`cm_branch`,`cm_market`,`cm_sp`,`cm_creditlimit`,`cm_hub`,`c_status`,`inserttime`,`updatetime`,`insertuser`,`updateuser`) values ('RWA-GI-0006','MBYAYINGABO JEAN BOSCO','','','WHOLESALE','Franchise','(+250) 787264883','','','','RUSIZI','','3035','0.00','','Open',NULL,NULL,NULL,NULL),('RWA-GI-0007','UWANYIRIGIRA FRANCINE','','','WHOLESALE','Franchise','(+250) 787959860','','','','RUSIZI','','3020','0.00','','Open',NULL,NULL,NULL,NULL),('RWA-GIH-0004','BANAMWANA PATIENCE','','','WHOLESALE','Franchise','(+250) 783498919','','','','RUSIZI','','3034','0.00','','Open',NULL,NULL,NULL,NULL),('RWA-GIH-0005','INGABIRE ADELPHINE','','','WHOLESALE','Franchise','(+250) 783122770','','','','RUSIZI','','3024','0.00','','Open',NULL,NULL,NULL,NULL),('RWA-KAM-0003','MUSABYIMANA DANIEL','','','WHOLESALE','Franchise','(+250) 728264732','','','','RUSIZI','','3019','0.00','','Open',NULL,NULL,NULL,NULL),('RWA-NKA-0008','MUJAWAYEZU VALENCIE','','','WHOLESALE','Franchise','(+250) 781100279','','','','RUSIZI','','3014','0.00','','Open',NULL,NULL,NULL,NULL),('RWA-NKO-0009','SAFARI JEAN PAUL','','','WHOLESALE','Franchise','(+250) 788712051','','','','RUSIZI','','3017','0.00','','Open',NULL,NULL,NULL,NULL),('RWA-NKO-0010','NYIRANEZA VALENTINE','','','WHOLESALE','Franchise','(+250) 787927101','','','','RUSIZI','','3016','0.00','','Open',NULL,NULL,NULL,NULL),('RWA-NYA-0002','MUNYANEZA DOMINIQUE XAVIER','','','WHOLESALE','Franchise','(+250) 787628317','','','','RUSIZI','','3065','0.00','','Open',NULL,NULL,NULL,NULL),('RWA-RWI-0001','NIZEYIMANA CALLIOPE','','','WHOLESALE','Franchise','(+250) 783552899','','','','RUSIZI','','3050','0.00','','Open',NULL,NULL,NULL,NULL);

/*Table structure for table `cm_productmaster` */

DROP TABLE IF EXISTS `cm_productmaster`;

CREATE TABLE `cm_productmaster` (
  `cm_code` varchar(50) NOT NULL,
  `cm_name` varchar(200) NOT NULL,
  `cm_description` varchar(200) DEFAULT NULL,
  `image` varchar(256) NOT NULL,
  `cm_class` varchar(50) DEFAULT NULL,
  `cm_group` varchar(50) DEFAULT NULL,
  `cm_category` varchar(50) DEFAULT NULL,
  `currency` varchar(15) NOT NULL,
  `exchange_rate` decimal(20,2) NOT NULL,
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

insert  into `cm_productmaster`(`cm_code`,`cm_name`,`cm_description`,`image`,`cm_class`,`cm_group`,`cm_category`,`currency`,`exchange_rate`,`cm_sellrate`,`cm_costprice`,`cm_sellunit`,`cm_sellconfact`,`cm_purunit`,`cm_purconfact`,`cm_selltax`,`cm_stkunit`,`cm_stkconfac`,`cm_packsize`,`cm_stocktype`,`cm_generic`,`cm_supplierid`,`cm_mfgcode`,`cm_maxlevel`,`cm_minlevel`,`cm_reorder`,`inserttime`,`updatetime`,`insertuser`,`updateuser`) values ('E1500FLA','USB stick, 4GB','An USB stick for all your important data.','http://localhost/images/8.png','PRODUCT','ELECTRONICS','ENTERTAINMENT','EUR','1.00','14.00','5.00','PCS','1.00','PACK','10.00','18.00','PCS','1.00','1','Stock N Sell','','FLA','',1000,200,NULL,'0000-00-00 00:00:00','2014-11-09 06:53:00','','admin'),('E1501ACT','Headphone Miroir','Perfect sounds! Listen to all your favorite music.','http://localhost/images/8.png','PRODUCT','ELECTRONICS','ENTERTAINMENT','USD','1.00','14.00','5.00','PCS','1.00','PCS','1.00','18.00','PCS','1.00','1','Stock N Sell','','ACT','',1000,200,NULL,'0000-00-00 00:00:00','2014-11-09 07:10:00','','admin'),('E1503BCC','MP3 player','All your music within reach with this MP3 player.','','PRODUCT','ELECTRONICS','ENTERTAINMENT','USD','1.00','14.00','5.00','PCS','1.00','PCS','1.00','18.00','PCS','1.00','1','Stock N Sell','','BCC','',1000,200,NULL,NULL,NULL,NULL,NULL),('E2014SHI01','Earphones, white','Listen to all your favorite music.','','PRODUCT','ELECTRONICS','ENTERTAINMENT','USD','1.00','4.20','1.50','PCS','1.00','PCS','1.00','18.00','PCS','1.00','1','Stock N Sell','','SHI01','',1000,200,NULL,NULL,NULL,NULL,NULL),('E2014SHI02','Earphones, black','Listen to all your favorite music.','','PRODUCT','ELECTRONICS','ENTERTAINMENT','USD','1.00','4.20','1.50','PCS','1.00','PCS','1.00','18.00','PCS','1.00','1','Stock N Sell','','SHI02','',1000,200,NULL,NULL,NULL,NULL,NULL),('E2021MUL01','Headphone Stereo, black','Perfect sounds! Listen to all your favorite music.','','PRODUCT','ELECTRONICS','ENTERTAINMENT','USD','1.00','11.20','4.00','PCS','1.00','PACK','20.00','18.00','PCS','1.00','1','Stock N Sell','','MUL','',1000,200,NULL,NULL,NULL,NULL,NULL),('E2021MUL02','Headphone Stereo, white','Perfect sounds! Listen to all your favorite music.','','PRODUCT','ELECTRONICS','ENTERTAINMENT','USD','1.00','11.20','4.00','PCS','1.00','PACK','20.00','18.00','PCS','1.00','1','Stock N Sell','','MUL','',1000,200,NULL,NULL,NULL,NULL,NULL),('E2021MUL03','Headphone Stereo, blue','Perfect sounds! Listen to all your favorite music.','','PRODUCT','ELECTRONICS','ENTERTAINMENT','USD','1.00','11.20','4.00','PCS','1.00','PACK','20.00','18.00','PCS','1.00','1','Stock N Sell','','MUL','',1000,200,NULL,NULL,NULL,NULL,NULL),('E2021MUL04','Headphone Stereo, red','Perfect sounds! Listen to all your favorite music.','','PRODUCT','ELECTRONICS','ENTERTAINMENT','USD','1.00','11.20','4.00','PCS','1.00','PACK','20.00','18.00','PCS','1.00','1','Stock N Sell','','MUL','',1000,200,NULL,NULL,NULL,NULL,NULL),('E2021MUL05','Headphone Stereo, green','Perfect sounds! Listen to all your favorite music.','','PRODUCT','ELECTRONICS','ENTERTAINMENT','USD','1.00','11.20','4.00','PCS','1.00','PACK','20.00','18.00','PCS','1.00','1','Stock N Sell','','MUL','',1000,200,NULL,NULL,NULL,NULL,NULL),('E2022MUL','Music boxes with radio','Listen to all your favorite music together with your friends.','','PRODUCT','ELECTRONICS','ENTERTAINMENT','USD','1.00','8.34','2.98','PCS','1.00','PCS','1.00','18.00','PCS','1.00','1','Stock N Sell','','MUL','',1000,200,NULL,NULL,NULL,NULL,NULL),('E2023MUL','Football','Play with your friend with this high quality football.','','PRODUCT','FUN','ENTERTAINMENT','USD','1.00','7.45','2.66','PCS','1.00','PCS','1.00','18.00','PCS','1.00','1','Stock N Sell','','MUL','',1000,200,NULL,NULL,NULL,NULL,NULL),('F1207ACT','Bracelet men','Beautifull jewelry for around your wrist.','','PRODUCT','JEWELRY','FASHION','EUR','1.00','2.80','1.00','PCS','1.00','PCS','1.00','18.00','PCS','1.00','1','Stock N Sell','','NIS','',1000,200,NULL,NULL,NULL,NULL,NULL),('F1208ACT','Bracelet, 3 black stone, purple/black/blue','Beautifull jewelry for around your wrist.','','PRODUCT','JEWELRY','FASHION','EUR','1.00','2.80','1.00','PCS','1.00','PCS','1.00','18.00','PCS','1.00','1','Stock N Sell','','NIS','',1000,200,NULL,NULL,NULL,NULL,NULL),('F1209ACT','Bracelet, 3 black stone, pink/black/white','Beautifull jewelry for around your wrist.','','PRODUCT','JEWELRY','FASHION','EUR','1.00','2.80','1.00','PCS','1.00','PCS','1.00','18.00','PCS','1.00','1','Stock N Sell','','NIS','',1000,200,NULL,NULL,NULL,NULL,NULL),('F1219ACT','Bracelet, leather, green','Beautifull jewelry for around your wrist.','','PRODUCT','JEWELRY','FASHION','EUR','1.00','2.80','1.00','PCS','1.00','PCS','1.00','18.00','PCS','1.00','1','Stock N Sell','','NIS','',1000,200,NULL,NULL,NULL,NULL,NULL),('F1220ACT','Bracelet, leather, red','Beautifull jewelry for around your wrist.','','PRODUCT','JEWELRY','FASHION','EUR','1.00','2.80','1.00','PCS','1.00','PCS','1.00','18.00','PCS','1.00','1','Stock N Sell','','NIS','',1000,200,NULL,NULL,NULL,NULL,NULL),('F1221ACT','Bracelet, leather, purple','Beautifull jewelry for around your wrist.','','PRODUCT','JEWELRY','FASHION','EUR','1.00','2.80','1.00','PCS','1.00','PCS','1.00','18.00','PCS','1.00','1','Stock N Sell','','NIS','',1000,200,NULL,NULL,NULL,NULL,NULL),('F1227ACT','Bracelet, light beadings','Beautifull jewelry for around your wrist.','','PRODUCT','JEWELRY','FASHION','EUR','1.00','2.80','1.00','PCS','1.00','PCS','1.00','18.00','PCS','1.00','1','Stock N Sell','','NIS','',1000,200,NULL,NULL,NULL,NULL,NULL),('F1228ACT','Bracelet, dark beadings','Beautifull jewelry for around your wrist.','','PRODUCT','JEWELRY','FASHION','EUR','1.00','2.80','1.00','PCS','1.00','PCS','1.00','18.00','PCS','1.00','1','Stock N Sell','','NIS','',1000,200,NULL,NULL,NULL,NULL,NULL),('F1270ACT','Hairband, gold chains, black','Nice accessory for in your hair.','','PRODUCT','ACCESSOIRES','FASHION','EUR','1.00','2.24','0.80','PCS','1.00','PCS','1.00','18.00','PCS','1.00','1','Stock N Sell','','NIS','',1000,200,NULL,NULL,NULL,NULL,NULL),('F1271ACT','Hairband, gold chains, white','Nice accessory for in your hair.','','PRODUCT','ACCESSOIRES','FASHION','EUR','1.00','2.24','0.80','PCS','1.00','PCS','1.00','18.00','PCS','1.00','1','Stock N Sell','','NIS','',1000,200,NULL,NULL,NULL,NULL,NULL),('F1309ACT','Cap, white','Nice cap to complete your outfit.','','PRODUCT','ACCESSOIRES','FASHION','EUR','1.00','8.40','3.00','PCS','1.00','PCS','1.00','18.00','PCS','1.00','1','Stock N Sell','','NIS','',1000,200,NULL,NULL,NULL,NULL,NULL),('F1310ACT','Cap, grey','Nice cap to complete your outfit.','','PRODUCT','ACCESSOIRES','FASHION','EUR','1.00','8.40','3.00','PCS','1.00','PCS','1.00','18.00','PCS','1.00','1','Stock N Sell','','NIS','',1000,200,NULL,NULL,NULL,NULL,NULL),('H1400WAK','Solar light WakaWaka','Get bright light by putting this lamp in the sun!','','PRODUCT','SOLAR','HOUSEHOLD','USD','1.00','36.40','13.00','PCS','1.00','PCS','1.00','18.00','PCS','1.00','1','Stock N Sell','','WAK','',1000,200,NULL,NULL,NULL,NULL,NULL),('H1401WAK','Solar light WakaWaka Power','Get bright light and energy by putting this lamp in the sun!','','PRODUCT','SOLAR','HOUSEHOLD','USD','1.00','75.60','27.00','PCS','1.00','PCS','1.00','18.00','PCS','1.00','1','Stock N Sell','','WAK','',1000,200,NULL,NULL,NULL,NULL,NULL),('H1402SOL','Solar light Solartend Lantern','Get bright light by putting this lamp in the sun!','','PRODUCT','SOLAR','HOUSEHOLD','USD','1.00','25.20','9.00','PCS','1.00','PCS','1.00','18.00','PCS','1.00','1','Stock N Sell','','SOL','',1000,200,NULL,NULL,NULL,NULL,NULL),('H1403SOL','Solar light Solartend Reading light','Get bright light by putting this lamp in the sun!','','PRODUCT','SOLAR','HOUSEHOLD','USD','1.00','25.20','9.00','PCS','1.00','PCS','1.00','18.00','PCS','1.00','1','Stock N Sell','','SOL','',1000,200,NULL,NULL,NULL,NULL,NULL),('H1404DLI','Solar light D.light Reading light','Get bright light by putting this lamp in the sun!','','PRODUCT','SOLAR','HOUSEHOLD','USD','1.00','19.60','7.00','PCS','1.00','PCS','1.00','18.00','PCS','1.00','1','Stock N Sell','','DLI','',1000,200,NULL,NULL,NULL,NULL,NULL),('H1405DLI','Solar light D.light Lantern','Get bright light by putting this lamp in the sun!','','PRODUCT','SOLAR','HOUSEHOLD','USD','1.00','19.60','7.00','PCS','1.00','PCS','1.00','18.00','PCS','1.00','1','Stock N Sell','','DLI','',1000,200,NULL,NULL,NULL,NULL,NULL),('H1406LAN','Pencil with eraser HB','Perfect writing and drawing with this pencil.','','PRODUCT','SCHOOL','HOUSEHOLD','USD','1.00','0.56','2.00','PCS','1.00','PACK','10.00','18.00','PCS','1.00','1','Stock N Sell','','LAN','',1000,200,NULL,NULL,NULL,NULL,NULL),('H1407NIN','Felt tip pens (color)','Perfect writing and drawing with this color pens.','','PRODUCT','SCHOOL','HOUSEHOLD','USD','1.00','1.68','0.60','PCS','1.00','PACK','8.00','18.00','PCS','1.00','1','Stock N Sell','','NIN','',1000,200,NULL,NULL,NULL,NULL,NULL),('H1408CAN','Document Folder','Keep your documents safe and organised.','','PRODUCT','SCHOOL','HOUSEHOLD','USD','1.00','0.84','0.30','PCS','1.00','PCS','1.00','18.00','PCS','1.00','1','Stock N Sell','','CAN','',1000,200,NULL,NULL,NULL,NULL,NULL),('H2061ANH','Poncho Rain Children','Keep your children dry from rain.','','PRODUCT','SCHOOL','HOUSEHOLD','USD','1.00','7.00','2.50','PCS','1.00','PCS','1.00','18.00','PCS','1.00','1','Stock N Sell','','ANH','',1000,200,NULL,NULL,NULL,NULL,NULL),('H2063LET','Solar home system, basic, black','Get bright light and energy by putting this lamp in the sun!','','PRODUCT','SOLAR','HOUSEHOLD','USD','1.00','42.00','15.00','PCS','1.00','PCS','1.00','18.00','PCS','1.00','1','Stock N Sell','','DLI','',1000,200,NULL,NULL,NULL,NULL,NULL),('M3107IDA','Quinine c','','','PRODUCT','MEDICINES','MEDICINES','USD','1.00','13.20','99.50','TABS','10.00','TABS','100.00','18.00','TABS','10.00','','Stock N Sell','','IDA','',1000,200,NULL,NULL,NULL,NULL,NULL),('M3107IMR','Quinine c','','','PRODUCT','MEDICINES','MEDICINES','USD','1.00','15.20','103.20','TABS','10.00','TABS','100.00','18.00','TABS','10.00','','Stock N Sell','','IMR','',1000,200,NULL,NULL,NULL,NULL,NULL),('M3108IDA','Salbutamol cp','','','PRODUCT','MEDICINES','MEDICINES','USD','1.00','11.00','101.00','TABS','10.00','TABS','100.00','18.00','TABS','10.00','','Stock N Sell','','IDA','',1000,200,NULL,NULL,NULL,NULL,NULL),('M3108IMR','Salbutamol cp','','','PRODUCT','MEDICINES','MEDICINES','USD','1.00','10.23','95.26','TABS','10.00','TABS','100.00','18.00','TABS','10.00','','Stock N Sell','','IMR','',1000,200,NULL,NULL,NULL,NULL,NULL),('M3108MED','Salbutamol cp','','','PRODUCT','MEDICINES','MEDICINES','USD','1.00','14.00','101.00','TABS','10.00','TABS','100.00','18.00','TABS','10.00','','Stock N Sell','','MED','',1000,200,NULL,NULL,NULL,NULL,NULL),('M3109IDA','ORS','','','PRODUCT','MEDICINES','MEDICINES','USD','1.00','6.00','320.00','SACHETS','1.00','SACHETS','100.00','18.00','SACHETS','1.00','','Stock N Sell','','IDA','',1000,200,NULL,NULL,NULL,NULL,NULL),('M3109IMR','ORS','','','PRODUCT','MEDICINES','MEDICINES','USD','1.00','4.50','115.00','SACHETS','1.00','SACHETS','50.00','18.00','SACHETS','1.00','','Stock N Sell','','IMR','',1000,200,NULL,NULL,NULL,NULL,NULL),('M3109MED','ORS','','','PRODUCT','MEDICINES','MEDICINES','USD','1.00','5.00','230.00','SACHETS','1.00','SACHETS','100.00','18.00','SACHETS','1.00','','Stock N Sell','','MED','',1000,200,NULL,NULL,NULL,NULL,NULL),('M3110IDA','Tramadol gel 50mg','','','PRODUCT','MEDICINES','MEDICINES','USD','1.00','12.23','76.00','TABS','10.00','TABS','100.00','18.00','TABS','10.00','','Stock N Sell','','IDA','',1000,200,NULL,NULL,NULL,NULL,NULL),('M3110IMR','Tramadol gel 50mg','','','PRODUCT','MEDICINES','MEDICINES','USD','1.00','12.23','76.00','TABS','10.00','TABS','100.00','18.00','TABS','10.00','','Stock N Sell','','IMR','',1000,200,NULL,NULL,NULL,NULL,NULL),('M3110MED','Tramadol gel 50mg','','','PRODUCT','MEDICINES','MEDICINES','USD','1.00','12.23','76.00','TABS','10.00','TABS','100.00','18.00','TABS','10.00','','Stock N Sell','','MED','',1000,200,NULL,NULL,NULL,NULL,NULL),('M3111GRE','Abaisse-langue en bois','Tongue depressors, sterile, adult, wood, 6\"x0.6875\", 100/bx','','PRODUCT','ACCESSOIRES','MEDICAL SUPPLIES','USD','1.00','2.00','1.20','BOX','10.00','BOX','100.00','18.00','PCS','1.00','','Stock N Sell','','GRE','',1000,200,NULL,'0000-00-00 00:00:00','2014-11-11 11:36:00','','admin'),('M3111IDA','Abaisse-langue en bois','Tongue depressors, sterile, adult, wood, 6\"x0.6875\", 100/bx','','PRODUCT','CONSUMABLES','MEDICAL SUPPLIES','USD','1.00','25.00','17.50','BOX','1.00','BOX','1.00','18.00','BOX','1.00','','Stock N Sell','','IDA','',1000,200,NULL,NULL,NULL,NULL,NULL),('M3111IMR','Abaisse-langue en bois','Tongue depressors, sterile, adult, wood, 6\"x0.6875\", 100/bx','','PRODUCT','CONSUMABLES','MEDICAL SUPPLIES','USD','1.00','25.00','17.50','BOX','1.00','BOX','1.00','18.00','BOX','1.00','','Stock N Sell','','IMR','',1000,200,NULL,NULL,NULL,NULL,NULL),('M3112GRE','Aiguille  dentaire  27 G bte de 100','Dental needles 27G long 27g x 1 1/4\" (0.40 x 32mm) boxes of 100pieces','','PRODUCT','CONSUMABLES','MEDICAL SUPPLIES','USD','1.00','0.65','25.00','PCS','1.00','BOX','100.00','18.00','PCS','1.00','','Stock N Sell','','GRE','',1000,200,NULL,NULL,NULL,NULL,NULL),('M3112IDA','Aiguille  dentaire  27 G bte de 100','Dental needles 27G long 27g x 1 1/4\" (0.40 x 32mm) boxes of 100pieces','','PRODUCT','CONSUMABLES','MEDICAL SUPPLIES','USD','1.00','0.65','25.00','PCS','1.00','BOX','100.00','18.00','PCS','1.00','','Stock N Sell','','IDA','',1000,200,NULL,NULL,NULL,NULL,NULL),('M3112IMR','Aiguille  dentaire  27 G bte de 100','Dental needles 27G long 27g x 1 1/4\" (0.40 x 32mm) boxes of 100pieces','','PRODUCT','CONSUMABLES','MEDICAL SUPPLIES','USD','1.00','0.65','25.00','PCS','1.00','BOX','100.00','18.00','PCS','1.00','','Stock N Sell','','IMR','',1000,200,NULL,NULL,NULL,NULL,NULL),('M3113GRE','Aiguille a ponction lombaire  luer 22G 90mm','Spinal needles, sterile, single use, 22 G x 3 1/2 in(90mm).( black)','','PRODUCT','CONSUMABLES','MEDICAL SUPPLIES','USD','1.00','5.00','3.00','PKT','1.00','PKT','1.00','18.00','PKT','1.00','','Stock N Sell','','GRE','',1000,200,NULL,NULL,NULL,NULL,NULL),('M3113IDA','Aiguille a ponction lombaire  luer 22G 90mm','Spinal needles, sterile, single use, 22 G x 3 1/2 in(90mm).( black)','','PRODUCT','CONSUMABLES','MEDICAL SUPPLIES','USD','1.00','5.00','3.00','PKT','1.00','PKT','1.00','18.00','PKT','1.00','','Stock N Sell','','IDA','',1000,200,NULL,NULL,NULL,NULL,NULL),('M3113IMR','Aiguille a ponction lombaire  luer 22G 90mm','Spinal needles, sterile, single use, 22 G x 3 1/2 in(90mm).( black)','','PRODUCT','CONSUMABLES','MEDICAL SUPPLIES','USD','1.00','5.00','3.00','PKT','1.00','PKT','1.00','18.00','PKT','1.00','','Stock N Sell','','IMR','',1000,200,NULL,NULL,NULL,NULL,NULL),('M3114GRE','Aiguille a ponction lombaire luer 25G  90mm','Spinal needles, sterile, single use 25 G x 3 1/2 in(90mm). Blue','','PRODUCT','CONSUMABLES','MEDICAL SUPPLIES','USD','1.00','5.00','3.00','PKT','1.00','PKT','1.00','18.00','PKT','1.00','','Stock N Sell','','GRE','',1000,200,NULL,NULL,NULL,NULL,NULL),('M3114IDA','Aiguille a ponction lombaire luer 25G  90mm','Spinal needles, sterile, single use 25 G x 3 1/2 in(90mm). Blue','','PRODUCT','CONSUMABLES','MEDICAL SUPPLIES','USD','1.00','5.00','3.00','PKT','1.00','PKT','1.00','18.00','PKT','1.00','','Stock N Sell','','IDA','',1000,200,NULL,NULL,NULL,NULL,NULL),('M3114IMR','Aiguille a ponction lombaire luer 25G  90mm','Spinal needles, sterile, single use 25 G x 3 1/2 in(90mm). Blue','','PRODUCT','CONSUMABLES','MEDICAL SUPPLIES','USD','1.00','5.00','3.00','PKT','1.00','PKT','1.00','18.00','PKT','1.00','','Stock N Sell','','IMR','',1000,200,NULL,NULL,NULL,NULL,NULL),('N2029BAS','Table top filter','','','PRODUCT','WATER','NUTRITION','USD','1.00','31.50','11.25','PCS','1.00','PCS','1.00','18.00','PCS','1.00','10','Stock N Sell','','BAS','',1000,200,NULL,NULL,NULL,NULL,NULL),('N2030BAS','Candle filter, replacement','','','PRODUCT','WATER','NUTRITION','USD','1.00','9.10','3.25','PCS','1.00','PCS','1.00','18.00','PCS','1.00','10','Stock N Sell','','BAS','',1000,200,NULL,NULL,NULL,NULL,NULL),('N2031BAS','Shiphon filter, tulip','','','PRODUCT','WATER','NUTRITION','USD','1.00','22.40','8.00','PCS','1.00','PCS','1.00','18.00','PCS','1.00','10','Stock N Sell','','BAS','',1000,200,NULL,NULL,NULL,NULL,NULL),('N2070ALM','Multivitamine child, week','','','PRODUCT','SUPPLEMENTS','NUTRITION','USD','1.00','0.28','0.10','PCS','1.00','PCS','7.00','18.00','PCS','1.00','10','Stock N Sell','','ALM','',1000,200,NULL,NULL,NULL,NULL,NULL),('N2071ALM','Multivitamine adult, week','','','PRODUCT','SUPPLEMENTS','NUTRITION','USD','1.00','0.28','0.10','PCS','1.00','PCS','7.00','18.00','PCS','1.00','10','Stock N Sell','','IMR','',1000,200,NULL,NULL,NULL,NULL,NULL),('N2072ZAF','Sprinkles Children, 15 mg','','','PRODUCT','SUPPLEMENTS','NUTRITION','USD','1.00','0.56','0.20','PCS','1.00','PCS','1.00','18.00','PCS','1.00','1','Stock N Sell','','DSM','',1000,200,NULL,NULL,NULL,NULL,NULL),('N2073SOM','Porridge, ... fortified','','','PRODUCT','FOOD','NUTRITION','USD','1.00','3.50','1.25','PCS','1.00','PCS','1.00','18.00','PCS','1.00','10','Stock N Sell','','IMR','',1000,200,NULL,NULL,NULL,NULL,NULL),('N2074IMR','ORS, 15 gr','','','PRODUCT','FOOD','NUTRITION','USD','1.00','0.20','0.07','PKT','1.00','PKT','1.00','18.00','PKT','1.00','10','Stock N Sell','','IMR','',1000,200,NULL,NULL,NULL,NULL,NULL),('N2075DUT','Aquaprove chloordioxide','','','PRODUCT','WATER','NUTRITION','USD','1.00','1.40','12.00','BOTTLE','1.00','BOX','24.00','18.00','BOTTLE','1.00','10','Stock N Sell','','AQU','',1000,200,NULL,NULL,NULL,NULL,NULL),('P1153RAF','Soother','','','PRODUCT','BABY CARE','PERSONAL','USD','1.00','0.84','0.30','PCS','1.00','PCS','1.00','18.00','PCS','1.00','1','Stock N Sell','','RAF','',1000,200,NULL,NULL,NULL,NULL,NULL),('P1154RAF','Sippy cup, non-spilling, 180 ml','bottle of 180ml','','PRODUCT','BABY CARE','PERSONAL','USD','1.00','2.80','1.00','PCS','1.00','PCS','1.00','18.00','PCS','1.00','1','Stock N Sell','','RAF','',1000,200,NULL,NULL,NULL,NULL,NULL),('P1155RAF','Feeding bottle with nipple, 250 ml','Bottle of 250ml','','PRODUCT','BABY CARE','PERSONAL','USD','1.00','2.80','1.00','PCS','1.00','PCS','1.00','18.00','PCS','1.00','1','Stock N Sell','','RAF','',1000,200,NULL,NULL,NULL,NULL,NULL),('P1156RAF','Single nipple for bottle','','','PRODUCT','BABY CARE','PERSONAL','USD','1.00','2.80','1.00','PCS','1.00','PCS','1.00','18.00','PCS','1.00','1','Stock N Sell','','RAF','',1000,200,NULL,NULL,NULL,NULL,NULL),('P1157FUZ-01','Children shoes, size 20, blue','','','PRODUCT','BABY CARE','PERSONAL','USD','1.00','2.24','0.80','PCS','1.00','PCS','1.00','18.00','PCS','1.00','1','Stock N Sell','','FUZ','',1000,200,NULL,NULL,NULL,NULL,NULL),('P1157FUZ-02','Children shoes, size 21, blue','','','PRODUCT','BABY CARE','PERSONAL','USD','1.00','2.24','0.80','PCS','1.00','PCS','1.00','18.00','PCS','1.00','1','Stock N Sell','','FUZ','',1000,200,NULL,NULL,NULL,NULL,NULL),('P1157FUZ-03','Children shoes, size 22, blue','','','PRODUCT','BABY CARE','PERSONAL','USD','1.00','2.24','0.80','PCS','1.00','PCS','1.00','18.00','PCS','1.00','1','Stock N Sell','','FUZ','',1000,200,NULL,NULL,NULL,NULL,NULL),('P1157FUZ-04','Children shoes, size 23, blue','','','PRODUCT','BABY CARE','PERSONAL','USD','1.00','2.24','0.80','PCS','1.00','PCS','1.00','18.00','PCS','1.00','1','Stock N Sell','','FUZ','',1000,200,NULL,NULL,NULL,NULL,NULL),('P1157FUZ-05','Children shoes, size 24, blue','','','PRODUCT','BABY CARE','PERSONAL','USD','1.00','2.24','0.80','PCS','1.00','PCS','1.00','18.00','PCS','1.00','1','Stock N Sell','','FUZ','',1000,200,NULL,NULL,NULL,NULL,NULL),('P1157FUZ-06','Children shoes, size 25, blue','','','PRODUCT','BABY CARE','PERSONAL','USD','1.00','2.24','0.80','PCS','1.00','PCS','1.00','18.00','PCS','1.00','1','Stock N Sell','','FUZ','',1000,200,NULL,NULL,NULL,NULL,NULL),('P1157FUZ-07','Children shoes, size 26, blue','','','PRODUCT','BABY CARE','PERSONAL','USD','1.00','2.24','0.80','PCS','1.00','PCS','1.00','18.00','PCS','1.00','1','Stock N Sell','','FUZ','',1000,200,NULL,NULL,NULL,NULL,NULL),('P1157FUZ-08','Children shoes, size 27, blue','','','PRODUCT','BABY CARE','PERSONAL','USD','1.00','2.24','0.80','PCS','1.00','PCS','1.00','18.00','PCS','1.00','1','Stock N Sell','','FUZ','',1000,200,NULL,NULL,NULL,NULL,NULL),('P1158FUZ-01','Children shoes, size 20, pink','','','PRODUCT','BABY CARE','PERSONAL','USD','1.00','2.24','0.80','PCS','1.00','PCS','1.00','18.00','PCS','1.00','1','Stock N Sell','','FUZ','',1000,200,NULL,NULL,NULL,NULL,NULL),('P1158FUZ-02','Children shoes, size 21, pink','','','PRODUCT','BABY CARE','PERSONAL','USD','1.00','2.24','0.80','PCS','1.00','PCS','1.00','18.00','PCS','1.00','1','Stock N Sell','','FUZ','',1000,200,NULL,NULL,NULL,NULL,NULL),('P1158FUZ-03','Children shoes, size 22, pink','','','PRODUCT','BABY CARE','PERSONAL','USD','1.00','2.24','0.80','PCS','1.00','PCS','1.00','18.00','PCS','1.00','1','Stock N Sell','','FUZ','',1000,200,NULL,NULL,NULL,NULL,NULL),('P1158FUZ-04','Children shoes, size 23, pink','','','PRODUCT','BABY CARE','PERSONAL','USD','1.00','2.24','0.80','PCS','1.00','PCS','1.00','18.00','PCS','1.00','1','Stock N Sell','','FUZ','',1000,200,NULL,NULL,NULL,NULL,NULL),('P1158FUZ-05','Children shoes, size 24, pink','','','PRODUCT','BABY CARE','PERSONAL','USD','1.00','2.24','0.80','PCS','1.00','PCS','1.00','18.00','PCS','1.00','1','Stock N Sell','','FUZ','',1000,200,NULL,NULL,NULL,NULL,NULL),('P1158FUZ-06','Children shoes, size 25, pink','','','PRODUCT','BABY CARE','PERSONAL','USD','1.00','2.24','0.80','PCS','1.00','PCS','1.00','18.00','PCS','1.00','1','Stock N Sell','','FUZ','',1000,200,NULL,NULL,NULL,NULL,NULL),('P1158FUZ-07','Children shoes, size 26, pink','','','PRODUCT','BABY CARE','PERSONAL','USD','1.00','2.24','0.80','PCS','1.00','PCS','1.00','18.00','PCS','1.00','1','Stock N Sell','','FUZ','',1000,200,NULL,NULL,NULL,NULL,NULL),('P1158FUZ-08','Children shoes, size 27, pink','','','PRODUCT','BABY CARE','PERSONAL','USD','1.00','2.24','0.80','PCS','1.00','PCS','1.00','18.00','PCS','1.00','1','Stock N Sell','','FUZ','',1000,200,NULL,NULL,NULL,NULL,NULL),('P1311VIS','Sunglasses Pilot','Protect your eyes and improve your looks with these sunglasses.','','PRODUCT','EYE CARE','PERSONAL','USD','1.00','3.36','1.20','PCS','1.00','PCS','1.00','18.00','PCS','1.00','1','Stock N Sell','','VIS','',1000,200,NULL,NULL,NULL,NULL,NULL),('P1312VIS','Sunglasses Jacket','Protect your eyes and improve your looks with these sunglasses.','','PRODUCT','EYE CARE','PERSONAL','USD','1.00','3.36','1.20','PCS','1.00','PCS','1.00','18.00','PCS','1.00','1','Stock N Sell','','VIS','',1000,200,NULL,NULL,NULL,NULL,NULL),('P1313VIS','Sunglasses Flight','Protect your eyes and improve your looks with these sunglasses.','','PRODUCT','EYE CARE','PERSONAL','USD','1.00','3.36','1.20','PCS','1.00','PCS','1.00','18.00','PCS','1.00','1','Stock N Sell','','VIS','',1000,200,NULL,NULL,NULL,NULL,NULL),('P2007SEN','Diaper Cream, jar, 100 ml','packed in jar of 100ml','','PRODUCT','BABY CARE','PERSONAL','USD','1.00','0.84','0.30','PCS','1.00','PCS','1.00','18.00','PCS','1.00','1','Stock N Sell','','SEN','',1000,200,NULL,NULL,NULL,NULL,NULL),('P2008SEN','Baby oil, flacon, 100 ml','packed in flacon of 100ml','','PRODUCT','BABY CARE','PERSONAL','USD','1.00','0.84','0.30','PCS','1.00','PCS','1.00','18.00','PCS','1.00','1','Stock N Sell','','SEN','',1000,200,NULL,NULL,NULL,NULL,NULL),('P2020HUB','Toothbrush kids','','','PRODUCT','BABY CARE','PERSONAL','USD','1.00','0.39','0.14','PCS','1.00','PCS','1.00','18.00','PCS','1.00','1','Stock N Sell','','HUB','',1000,200,NULL,NULL,NULL,NULL,NULL),('P2027LON','Toothpaste kids, tube, 40 ml','packed in tube 40ml','','PRODUCT','BABY CARE','PERSONAL','USD','1.00','2.80','1.00','PCS','1.00','PCS','1.00','18.00','PCS','1.00','1','Stock N Sell','','LON','',1000,200,NULL,NULL,NULL,NULL,NULL),('P2051JIN-01','Washable diaper, pink','includes 3 inserts + outer cover','','PRODUCT','BABY CARE','PERSONAL','USD','1.00','2.50','1.50','PCS','1.00','PCS','1.00','18.00','PCS','1.00','1','Stock N Sell','','JIN-01','',1000,200,NULL,NULL,NULL,NULL,NULL),('P2051JIN-02','Washable diaper, blue','includes 3 inserts + outer cover','','PRODUCT','BABY CARE','PERSONAL','USD','1.00','2.80','1.00','PCS','1.00','PCS','1.00','18.00','PCS','1.00','1','Stock N Sell','','JIN-02','',1000,200,NULL,NULL,NULL,NULL,NULL),('P2052JIN','Single insert for washable diaper','','','PRODUCT','BABY CARE','PERSONAL','USD','1.00','2.50','1.50','PCS','1.00','PCS','1.00','18.00','PCS','1.00','1','Stock N Sell','','JIN','',1000,200,NULL,NULL,NULL,NULL,NULL);

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

insert  into `cm_suppliermaster`(`cm_supplierid`,`cm_group`,`cm_orgname`,`cm_address`,`cm_district`,`cm_post`,`cm_policest`,`cm_postcode`,`cm_contactperson`,`cm_phone`,`cm_cellphone`,`cm_fax`,`cm_email`,`cm_url`,`cm_status`,`inserttime`,`updatetime`,`insertuser`,`updateuser`) values ('ACT','SUPPLIER','Action','westerblokker 82, blokker','Blokker','Netherlands','','','not assigned','T +31 228565656','','','info@ action.nl','www.action.nl','Open',NULL,NULL,NULL,NULL),('AFP','SUPPLIER','Afri-pads-','Plot 263 Mutebe Close. Bukoto. Kampala.Uganda','Kampala','Uganda','','','Karin','T +256(0)392 174 561','T +256(0)781 481 111','','info@afripads.com','http://afripads.com','Open',NULL,NULL,NULL,NULL),('ALB','SUPPLIER','Albert David Limited','Chittaranjan Avenue, 2nd floor, Kolkata, India','Kolkata','India','','','mr Kabra','T+919830064380','','','hpk@adlindia.in','www.albertdavidindia.com','Open',NULL,NULL,NULL,NULL),('ALM','SUPPLIER','Almires ','Laserpoortweg 26, 8218 NK, Netherlands','Lelystad','Netherlands','','','Dirk Bouma','T ++31320296989','','','DirkBouma@almires.nl','www.almires.nl','Open',NULL,NULL,NULL,NULL),('BAS','SUPPLIER','Basic Water Needs','Van Diemenstraat 116, 1013 CN, Amsterdam','Amsterdam','Netherlands','','','Martijn Smid','T +31681901264','','','martijnsmid@basicwaterneeds.com','http://www.basicwaterneeds.com','Open',NULL,NULL,NULL,NULL),('CAN','SUPPLIER','China Textile','Via Everlast Business Trading, room 1703, Wante Business Centre, 487 Yandmuqi Road, Ningbo China. ','Ningbo','China','','','Kiko','T +86-18969896633','','','kiko@mascot-ningbo.com','na','Open',NULL,NULL,NULL,NULL),('CIR','SUPPLIER','Cirion Pharma ','Prabhat Nagar, Jogeshwari, Mumbai 400102, Maharastra, India','Mumbai','India','','','Pradeep ','T+ 91-2226789322','','','srs@cirionpharma.com','www.cirionpharma.com','Open',NULL,NULL,NULL,NULL),('CYC','SUPPLIER','Cycle out of Poverty','Kasteelselaan 4, Ubbergen, Nederland','Ubbergen','Netherlands','','','Luuk','T +31615895529','','','luuk@coop-africa.org','www.coop-africa.org','Open',NULL,NULL,NULL,NULL),('DDU','SUPPLIER','D-Dutch ','Handvastwater 48, 1601 PR Enkhuizen','Enkhuizen','Netherlands','','','Klaas','T +31654738150','','','kkeekstra@online.nl','www.d-dutch.com','Open',NULL,NULL,NULL,NULL),('DLI','SUPPLIER','D-light','Off James Gichuru Road, Next to Muthangari Police Station, Nairobi, Kenya','Nairobi','Kenya','','','Michael Muthigani','T +254 703 896 996','T +254 731 896 899','','michael.muthigani@dlightdesign.com','www.dlightdesign.com','Open',NULL,NULL,NULL,NULL),('DUT','SUPPLIER','Dutrion & aquaprove','Vermeerstraat 1, 7730 AA Ommen','Ommen','Netherlands','','','Wim ten Kate','T+ 3125562770','','','wim@dutrion.com','www.dutrion.nl','Open',NULL,NULL,NULL,NULL),('ENC','SUPPLIER','China Enclosure','Via Everlast Business Trading, room 1703, Wante Business Centre, 487 Yandmuqi Road, Ningbo China. ','Ningbo','China','','','Vicky ','T +86-18969896633','','','Vicky@mascot-ningbo.com','na','Open',NULL,NULL,NULL,NULL),('ETO','SUPPLIER','Etos Nederland','Rijnstraat 22, Amsterdam','Amsterdam','Netherlands','','','Janneke','T+31206420314','','','info@etos.nl','www.etos.nl','Open',NULL,NULL,NULL,NULL),('EVE','SUPPLIER','Everlast Business Trading','Everlast Business Trading, room 1703, Wante Business Centre, 487 Yandmuqi Road, Ningbo China. ','Ningbo','China','','','Dan','T +8657487079152','','','dan@mascot-ningbo.com','na','Open',NULL,NULL,NULL,NULL),('FLA','SUPPLIER','Flashbay','Joo Geesinkweg 901, Amsterdam','Amsterdam','Netherlands','','','Hasnae Kerach','T+3120 8907779','','','specials@flashbay.com','www.flashbay.com','Open',NULL,NULL,NULL,NULL),('FUZ','SUPPLIER','Fuzhou Fuyan Shoe Factory','Ningbo China','Ningbo','China','','','Kiko ','T +86-18969896633','','','na','na','Open',NULL,NULL,NULL,NULL),('GLA','SUPPLIER','Gland pharma','Near Gandimaisamma X Road, Quthbullapur Mandal, Hyderabad, India','Hyderabad','India','','','mr Prasada','T+914030510999','','','g.prasadarao@glandpharma.com','www.glandpharma.com','Open',NULL,NULL,NULL,NULL),('HAI','SUPPLIER','Hai electronics','Via Everlast Business Trading, room 1703, Wante Business Centre, 487 Yandmuqi Road, Ningbo China. ','Ningbo','China','','','Kiko','T +86-18969896633','','','kiko@mascot-ningbo.com','na','Open',NULL,NULL,NULL,NULL),('HUB','SUPPLIER','Hubei Wei','24F., CENTURY BUILDING, NO.206,JIANGHAN ROAD, WUHAN, CHINA','Wuhan','China','','','wuwen','T +86-574-87079152','','','wuwen@hubeicrown.com','www.hubeicrown.com','Open',NULL,NULL,NULL,NULL),('ICA','SUPPLIER','Afri-Can Foundation\n\n','Kondele, Migosi junction, along kisumum kakamega road, kenya','Kondele','Kenya','','','Chantal Heutink ','T+31616784488','','','Chantal.Heutink@afri-can.nl','www.icarepads.com','Open',NULL,NULL,NULL,NULL),('IDA','SUPPLIER','IDA Foundation','Slochterweg 35, 1027 AA, Amsterdam','Amsterdam','Netherlands','','','Diego Camboni','T +31204033051','','','dcamboni@idafoundation.org','www.idafoundation.org','Open',NULL,NULL,NULL,NULL),('IMR','SUPPLIER','Imres','Laserpoortweg 26, 8218 NK, Lelystad','Lelystad','Netherlands','','','Mark Hesseling','T+13450276768','','','hesseling@imres.nl','www.imres.nl','Open',NULL,NULL,NULL,NULL),('JIN','SUPPLIER','Jinwei Backpack Factory','Yiwu trading center, Yiwu China','Yiwu','China','','','Roger','T+8657985680478','','','roger@','','Open',NULL,NULL,NULL,NULL),('JOW','SUPPLIER','Joway Electronics','Dejin Industrial Park, Fuyuan 1st Rd, Fuyong town, Shenzhen','Shenzhen','China','','','Steven Ye','T +8675529607293','','','ye@szqway.com','www.szqway.com','Open',NULL,NULL,NULL,NULL),('LET','SUPPLIER','Letsolar','HuaLian Industrial Area, DaLang,Longhua,ShenZhen,China','Shenzhen','China','','','Julie Lucky ','T +86-755-8255 6336','','','julie@letsolar.com','www.letsolar.com','Open',NULL,NULL,NULL,NULL),('LON ','SUPPLIER','Jiangsu Longliqi','Longliqi Biological Industry Park, Changsu, Jiangsu China','Jiangsu','China','','','Jack','T +86-512-52991659','','','jack_longliqi@vip.163.com','www.lonliqicn.cn','Open',NULL,NULL,NULL,NULL),('MAS','SUPPLIER','Mascot Europe','Westerblokker 32-b 1695 PR, Blokker','Blokker','Netherlands','','','Rogier','T +31652441381','','','rogier@mascot-europe.nl','www.mascot-europe.nl','Open',NULL,NULL,NULL,NULL),('MED','SUPPLIER','Medopharm','Puliyur 2nd main Rd, Trustpuram, Kodabakkam, Chennai','Chennai','India','','','mr Kannan ','T +9104430149999','','','kannan@medopharm.com','www.medopharm.com','Open',NULL,NULL,NULL,NULL),('MIN','SUPPLIER','Minigrip Nederland','Kamerling Onneslaan 6, Lelystad','Lelystad','Netherlands','','','Renee schaaphok','T +31320277900','','','Renee.Schaaphok@daklapack.com','www.dacklapack.com','Open',NULL,NULL,NULL,NULL),('MUL','SUPPLIER','Mulitchannel','Hi tech science & tech square No 1498 Jiangnan Road, Ningbo, China','Ningbo','China','','','Jessica Huang','T +8657427833758','','','auto@multi-channel.com.cn','www.multi-channel.com.cn','Open',NULL,NULL,NULL,NULL),('NIN','SUPPLIER','Ningbo Multichannel co Ningbo','Hi tech science & tech square No 1498 Jiangnan Road, Ningbo, China','Ningbo','China','','','Jessica Huang','T +8657427833758','','','auto@multi-channel.com.cn','www.multi-channel.com.cn','Open',NULL,NULL,NULL,NULL),('OUP','SUPPLIER','Dalian Oupai Technology co','no21 Longqab Rd, Zhangqian St, Jinzhou Dist, Dalian China. ','Dalian','China','','','Danny Bai','T+8641139317879','','','danny@dloupai.com','www.dloupai.com','Open',NULL,NULL,NULL,NULL),('RAF','SUPPLIER','Raffini ','188 ChangYang Road, Hongtang Jiangbei District, Ningbo China','Ningbo','China','','','Jenny Han','T+ 86 574 8756 2952','','','sales5@raffini.com','http://www.raffini.com','Open',NULL,NULL,NULL,NULL),('SEN','SUPPLIER','Senos','1501, Building 8, Jingxiuwan, Tangjiaqiao, Wenzhou, China ','Wenzhou','China','','','Nikki','T+8618106710703','','','nikki@senosmarketing.com','www.senosmarketing.com','Open',NULL,NULL,NULL,NULL),('SHI','SUPPLIER','Shinestone ','Bright Way Tower no 33 Mong Kok rd Mongko, KL, Hong Kong','Hongkong','Hong Kong','','','Linda Wang','T +8613450276768','','','sales05@zzwsst.com','www.zzwsst.com','Open',NULL,NULL,NULL,NULL),('SUL','SUPPLIER','Sulfo ','Avenue de la Justice, Kigali, Rwanda','Kigali','Rwanda','','','Atma Prakash','T+252 574556','','','ap@sulfo.com','http://www.sulfo.com','Open',NULL,NULL,NULL,NULL),('VIS','SUPPLIER','VisionSpring','322 Eighth Avenue, Suite 201, New York, NY 10001','New York','United States','','','Peter Eliassen','T +1 212 375 2599','','','PEliassen@visionspring.org','www.visionspring.org','Open',NULL,NULL,NULL,NULL),('WAK','SUPPLIER','Waka Waka ','Wilhelminastraat 18, 2011 VM Haarlem','Haarlem','Netherlands','','','Cas van Kleef','T+31235176611','','','cas@wakawakafoundation.org','www.wakawakafoundation.org','Open',NULL,NULL,NULL,NULL),('YON ','SUPPLIER','Yonan Industry','Hi tech zone Wante, 1324 Rumqi road','','China','','','Diana','T+8657413146932','','','salesnin@ningboffice.com','na','Open',NULL,NULL,NULL,NULL),('YOU','SUPPLIER','Youbang Light Industry Co','Ningbo, China ','Ningbo','China','','','Jessy','T+8657438721231','','','Han Wang','na','Open',NULL,NULL,NULL,NULL);

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

insert  into `cm_transaction`(`cm_type`,`cm_trncode`,`cm_branch`,`cm_lastnumber`,`cm_increment`,`cm_active`,`inserttime`,`updatetime`,`insertuser`,`updateuser`) values ('Account Payable','APV-','Dhaka',0,1,1,NULL,'2014-07-20 10:03:29',NULL,NULL),('Adjustment Number','AD--',NULL,0,1,1,'2014-08-19 10:37:00','2014-11-03 15:24:29','admin',''),('Customer TRN Number','CUS-','Customer Code',0,1,1,'2014-05-18 08:21:00','2014-09-09 10:26:17','admin','admin'),('GRN Number','GRN-','Goods Receipt Note',1,1,1,'2014-07-14 05:12:00','2014-11-11 11:16:51','admin',''),('HR Transaction','TRN-',NULL,0,1,1,'2014-04-13 17:57:00','0000-00-00 00:00:00','admin',''),('IM Transaction','AJIS','Adjust Issue',0,1,1,'2014-08-20 03:49:00','2014-11-03 15:21:43','admin',''),('IM Transaction','AJRE','Adjust Received',0,1,1,'2014-08-20 03:50:00','2014-09-09 12:50:53','admin',''),('IM Transaction','BO--','Bonus Order',0,1,1,'2014-04-17 17:09:00','0000-00-00 00:00:00','admin',''),('IM Transaction','BR--','Bonus Order Return',0,1,1,'2014-07-08 17:28:00','0000-00-00 00:00:00','admin',''),('IM Transaction','DO--','Delivery Order',0,1,1,'2014-04-17 17:08:00','2014-11-03 15:18:50','admin',''),('IM Transaction','IT--','Issue Transfer',0,1,1,'2014-04-12 03:56:00','2014-09-09 11:19:48','admin',''),('IM Transaction','PO--','Purchase Order',3,1,1,'2014-04-16 09:43:00','2014-11-11 16:37:10','admin','admin'),('IM Transaction','RE--','Receive Transfer',0,1,1,'2014-01-02 15:17:00','2014-09-09 11:20:08','admin',''),('IM Transaction','SR--','Sales Return Receive',0,1,1,'2014-07-14 06:46:00','0000-00-00 00:00:00','admin',''),('IM Transfer Number','TRN-','Transfer Transaction Code',0,1,1,'2014-01-02 08:15:00','2014-09-10 09:03:58','admin',''),('Invoice No','DS--',NULL,0,1,1,'2014-08-18 07:02:00','2014-09-09 11:44:31','admin',''),('Invoice No','IN--','Sales Invoice No',0,1,1,'2014-02-25 00:00:00','2014-11-03 15:04:42','admin','admin'),('Money Receipt','MR--','Money Receipt',0,1,1,NULL,'2014-11-03 15:26:10',NULL,NULL),('Purchase Order Number','LPO-',NULL,0,1,1,'2014-07-24 09:28:00','0000-00-00 00:00:00','admin',''),('Purchase Order Number','PO--','Purchase Oreder',1,1,1,'2014-01-11 13:22:00','2014-11-11 11:38:34','admin',''),('Purchase Order Number','PR--','Purchase Order from Requisition',2,1,1,'2014-07-19 14:46:00','2014-11-11 11:12:09','admin',''),('Requisition Number','RE',NULL,0,1,1,'2014-08-21 08:05:00','0000-00-00 00:00:00','admin',''),('Requisition Number','RE--','Requisition No',1,1,1,'2014-06-26 06:07:00','2014-11-11 10:28:34','admin','admin'),('Sales Return','SR--','Sales Return',0,1,1,'2014-02-25 00:00:00','2014-07-18 15:28:26','admin',NULL),('Supplier Number','SUP-','Supplier Code',0,1,1,NULL,'2014-06-11 12:02:22',NULL,NULL),('Voucher No','AJIS',NULL,0,1,1,'2014-08-23 08:36:00','2014-11-03 15:21:43','admin',''),('Voucher No','AJRE',NULL,0,1,1,'2014-08-23 08:36:00','2014-09-09 12:50:53','admin',''),('Voucher No','AP--','Accounts Payable',1,1,1,'2014-07-14 05:13:00','2014-11-11 16:38:35','admin','admin'),('Voucher No','APV-','Accounts Payment Voucher',0,1,1,'2014-04-16 13:54:00','2014-11-03 15:02:27','admin',''),('Voucher No','AR--','Accounts Receivable',0,1,1,'2014-07-04 06:42:00','2014-11-03 15:04:54','admin',''),('Voucher No','ARDR',NULL,0,1,1,'2014-08-19 06:24:00','2014-09-09 11:44:59','admin',''),('Voucher No','IM--','Inventory Transaction Code',0,1,1,'2014-05-02 12:58:00','2014-11-03 15:18:50','admin',''),('Voucher No','JV--','Journal Voucher',0,1,1,'2014-04-20 10:16:00','2014-09-09 12:52:20','admin',''),('Voucher No','MR--','Money Receipt',0,1,1,'2014-04-20 18:46:00','2014-11-03 15:26:20','admin','admin'),('Voucher No','PAY-','Payment Voucher Code',0,1,1,'2014-04-13 17:22:00','2014-09-09 12:13:52','admin',''),('Voucher No','RCV-','Received Voucher Code',0,1,1,'2014-05-22 13:05:00','2014-08-30 06:11:09','admin',''),('Voucher No','REV-','Revers Entry Voucher',0,1,1,'2014-05-22 13:06:00','2014-09-09 12:14:53','admin','');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hr_trnheader` */

/*Table structure for table `im_adjustdt` */

DROP TABLE IF EXISTS `im_adjustdt`;

CREATE TABLE `im_adjustdt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_number` varchar(50) DEFAULT NULL,
  `product_code` varchar(50) DEFAULT NULL,
  `batch_number` varchar(50) DEFAULT NULL,
  `expirry_date` date DEFAULT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `stock_rate` decimal(20,2) DEFAULT NULL,
  `inserttime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `insertuser` varchar(50) DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `updateuser` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transaction_number` (`transaction_number`),
  KEY `product_code` (`product_code`),
  CONSTRAINT `im_adjustdt_ibfk_1` FOREIGN KEY (`transaction_number`) REFERENCES `im_adjusthd` (`transaction_number`),
  CONSTRAINT `im_adjustdt_ibfk_2` FOREIGN KEY (`product_code`) REFERENCES `cm_productmaster` (`cm_code`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

/*Data for the table `im_adjustdt` */

/*Table structure for table `im_adjusthd` */

DROP TABLE IF EXISTS `im_adjusthd`;

CREATE TABLE `im_adjusthd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_number` varchar(50) DEFAULT NULL,
  `DATE` date DEFAULT NULL,
  `branch` varchar(50) DEFAULT NULL,
  `adjustment_type` int(11) DEFAULT NULL,
  `confirm_date` datetime DEFAULT NULL,
  `currency` varchar(10) DEFAULT NULL,
  `exchange_rate` decimal(20,5) DEFAULT NULL,
  `STATUS` varchar(50) DEFAULT NULL,
  `voucherno` varchar(50) DEFAULT NULL,
  `inserttime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `insertuser` varchar(50) DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `updateuser` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `transaction_number` (`transaction_number`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

/*Data for the table `im_adjusthd` */

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `im_batchtransfer` */

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
  `c_status` varchar(50) DEFAULT NULL,
  `inserttime` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `insertuser` varchar(50) DEFAULT NULL,
  `updateuser` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `im_grnnumber` (`im_grnnumber`,`cm_code`),
  KEY `cm_code` (`cm_code`),
  CONSTRAINT `im_grndetail_ibfk_1` FOREIGN KEY (`im_grnnumber`) REFERENCES `im_grnheader` (`im_grnnumber`),
  CONSTRAINT `im_grndetail_ibfk_2` FOREIGN KEY (`cm_code`) REFERENCES `cm_productmaster` (`cm_code`)
) ENGINE=InnoDB AUTO_INCREMENT=178 DEFAULT CHARSET=utf8;

/*Data for the table `im_grndetail` */

insert  into `im_grndetail`(`id`,`im_grnnumber`,`cm_code`,`im_BatchNumber`,`im_ExpireDate`,`im_RcvQuantity`,`im_costprice`,`im_unit`,`im_unitqty`,`im_taxrate`,`im_taxamt`,`im_rowamount`,`c_status`,`inserttime`,`updatetime`,`insertuser`,`updateuser`) values (175,'GRN-00000001','M3111GRE','N01','2014-12-11',2,'1.20','BOX',100,'0.00','0.00','240.00',NULL,'2014-11-11 07:19:00','0000-00-00 00:00:00','admin',''),(176,'GRN-00000001','P1158FUZ-01','KO1','2014-12-11',20,'0.80','PCS',1,'0.00','0.00','16.00',NULL,'2014-11-11 07:21:00','0000-00-00 00:00:00','admin',''),(177,'GRN-00000001','F1207ACT','PO1','2014-12-11',50,'1.00','PCS',1,'0.00','0.00','50.00',NULL,'2014-11-11 07:21:00','0000-00-00 00:00:00','admin','');

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
  `im_exchrate` decimal(20,5) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=131 DEFAULT CHARSET=utf8;

/*Data for the table `im_grnheader` */

insert  into `im_grnheader`(`id`,`im_grnnumber`,`im_purordnum`,`am_vouchernumber`,`im_date`,`cm_supplierid`,`pp_requisitionno`,`im_payterms`,`im_store`,`im_taxrate`,`im_taxamt`,`im_discrate`,`im_discamt`,`im_currency`,`im_exchrate`,`im_amount`,`im_netamt`,`im_status`,`inserttime`,`updatetime`,`insertuser`,`updateuser`) values (130,'GRN-00000001','PR--00000002','AP--00000001','2014-11-11','ACT','RE--00000001','Cash','RUSIZI','5.00','15.30','0.00','0.00','USD','1.00000','306.00','321.30','Invoiced','2014-11-11 11:16:51',NULL,'admin',NULL);

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
  `im_foreignrate` decimal(20,2) DEFAULT NULL,
  `im_rate` decimal(20,2) DEFAULT NULL,
  `im_totalprice` decimal(20,2) DEFAULT NULL,
  `im_basevalue` decimal(20,5) DEFAULT NULL,
  `im_RefNumber` varchar(50) DEFAULT NULL,
  `im_RefRow` int(11) DEFAULT NULL,
  `im_note` varchar(250) DEFAULT NULL,
  `im_status` varchar(50) DEFAULT NULL,
  `im_voucherno` varchar(50) DEFAULT NULL,
  `cm_supplierid` varchar(50) DEFAULT NULL,
  `im_currency` varchar(50) DEFAULT NULL,
  `im_ExchangeRate` decimal(20,5) DEFAULT NULL,
  `inserttime` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `insertuser` varchar(50) DEFAULT NULL,
  `updateuser` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `im_number` (`im_number`),
  KEY `cm_code` (`cm_code`),
  CONSTRAINT `im_transaction_ibfk_1` FOREIGN KEY (`cm_code`) REFERENCES `cm_productmaster` (`cm_code`)
) ENGINE=InnoDB AUTO_INCREMENT=397 DEFAULT CHARSET=utf8;

/*Data for the table `im_transaction` */

insert  into `im_transaction`(`id`,`im_number`,`cm_code`,`im_storeid`,`im_BatchNumber`,`im_date`,`im_ExpireDate`,`im_quantity`,`im_sign`,`im_unit`,`im_foreignrate`,`im_rate`,`im_totalprice`,`im_basevalue`,`im_RefNumber`,`im_RefRow`,`im_note`,`im_status`,`im_voucherno`,`cm_supplierid`,`im_currency`,`im_ExchangeRate`,`inserttime`,`updatetime`,`insertuser`,`updateuser`) values (394,'PO--00000001','M3111GRE','RUSIZI','N01','2014-11-11','2014-12-11',200,1,'PCS','1.20','1.20','240.00','240.00000','GRN-00000001',175,'Action','Open',NULL,'ACT','USD','1.00000','2014-11-11 16:37:10',NULL,'admin',NULL),(395,'PO--00000002','P1158FUZ-01','RUSIZI','KO1','2014-11-11','2014-12-11',20,1,'PCS','0.80','0.80','16.00','16.00000','GRN-00000001',176,'Action','Open',NULL,'ACT','USD','1.00000','2014-11-11 16:37:10',NULL,'admin',NULL),(396,'PO--00000003','F1207ACT','RUSIZI','PO1','2014-11-11','2014-12-11',50,1,'PCS','1.00','1.00','50.00','50.00000','GRN-00000001',177,'Action','Open',NULL,'ACT','USD','1.00000','2014-11-11 16:37:10',NULL,'admin',NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `im_transferdt` */

/*Table structure for table `im_transferhd` */

DROP TABLE IF EXISTS `im_transferhd`;

CREATE TABLE `im_transferhd` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `im_transfernum` varchar(50) DEFAULT NULL,
  `im_date` date DEFAULT NULL,
  `im_condate` date DEFAULT NULL,
  `im_note` varchar(250) DEFAULT NULL,
  `im_fromstore` varchar(50) DEFAULT NULL,
  `im_fcur` varchar(50) DEFAULT NULL,
  `im_fexchrate` decimal(20,5) DEFAULT NULL,
  `im_tostore` varchar(50) DEFAULT NULL,
  `im_tcur` varchar(50) DEFAULT NULL,
  `im_texchrate` decimal(20,5) DEFAULT NULL,
  `im_status` varchar(50) DEFAULT NULL,
  `inserttime` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `insertuser` varchar(50) DEFAULT NULL,
  `updateuser` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `im_transfernum` (`im_transfernum`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `im_transferhd` */

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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

/*Data for the table `it_imtoap` */

insert  into `it_imtoap`(`id`,`item_group`,`sup_group`,`debit_account`,`active`,`inserttime`,`updatetime`,`insertuser`,`updateuser`) values (21,'ENTERTAINMENT','BABY PRODUCTS','13100',1,'2014-07-03 07:13:00','0000-00-00 00:00:00','admin',''),(24,'FASHION','BABY PRODUCTS','13101',1,'2014-07-03 07:14:00','0000-00-00 00:00:00','admin',''),(25,'GERANT','BABY PRODUCTS','13102',1,'2014-07-03 07:14:00','0000-00-00 00:00:00','admin',''),(26,'HOUSEHOLD','BABY PRODUCTS','13103',1,'2014-07-03 07:14:00','0000-00-00 00:00:00','admin',''),(27,'MEDICINE','BABY PRODUCTS','13104',1,'2014-07-03 07:14:00','0000-00-00 00:00:00','admin',''),(28,'NUTRITION','BABY PRODUCTS','13105',1,'2014-07-03 07:15:00','0000-00-00 00:00:00','admin',''),(29,'PERSONAL','BABY PRODUCTS','13106',1,'2014-07-03 07:15:00','0000-00-00 00:00:00','admin','');

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
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8;

/*Data for the table `it_imtogl` */

insert  into `it_imtogl`(`id`,`c_branch`,`c_trncode`,`c_group`,`c_accdr`,`c_acccr`,`inserttime`,`updatetime`,`insertuser`,`updateuser`) values (21,'RUSIZI','DO--','ENTERTAINMENT','103-007','401-007','2014-11-05 07:00:00','0000-00-00 00:00:00','admin',''),(22,'RUSIZI','DO--','FASHION','103-005','401-005','2014-11-05 07:03:00','0000-00-00 00:00:00','admin',''),(23,'RUSIZI','DO--','GERANT','103-008','401-008','2014-11-05 07:13:00','0000-00-00 00:00:00','admin',''),(24,'RUSIZI','DO--','HOUSEHOLD','103-004','401-004','2014-11-05 07:13:00','0000-00-00 00:00:00','admin',''),(25,'RUSIZI','DO--','MEDICINE','103-001','401-001','2014-11-05 07:13:00','0000-00-00 00:00:00','admin',''),(26,'RUSIZI','DO--','NUTRITION','103-003','401-003','2014-11-05 07:14:00','0000-00-00 00:00:00','admin',''),(27,'RUSIZI','DO--','PERSONAL','103-006','401-006','2014-11-05 07:16:00','0000-00-00 00:00:00','admin',''),(49,'RUSIZI','AJIS','ENTERTAINMENT','303-006','103-007','2014-11-05 07:33:00','0000-00-00 00:00:00','admin',''),(50,'RUSIZI','AJIS','FASHION','303-006','103-005','2014-11-05 07:34:00','0000-00-00 00:00:00','admin',''),(51,'RUSIZI','AJIS','GERANT','303-006','103-008','2014-11-05 07:34:00','0000-00-00 00:00:00','admin',''),(52,'RUSIZI','AJIS','HOUSEHOLD','303-006','103-004','2014-11-05 07:35:00','0000-00-00 00:00:00','admin',''),(53,'RUSIZI','AJIS','MEDICINE','303-006','103-001','2014-11-05 07:35:00','0000-00-00 00:00:00','admin',''),(54,'RUSIZI','AJIS','NUTRITION','303-006','103-003','2014-11-05 07:35:00','0000-00-00 00:00:00','admin',''),(55,'RUSIZI','AJIS','PERSONAL','303-006','103-006','2014-11-05 07:36:00','0000-00-00 00:00:00','admin',''),(56,'RUSIZI','AJRE','ENTERTAINMENT','103-007','303-006','2014-11-05 07:36:00','0000-00-00 00:00:00','admin',''),(57,'RUSIZI','AJRE','FASHION','103-005','303-006','2014-11-05 07:37:00','0000-00-00 00:00:00','admin',''),(58,'RUSIZI','AJRE','GERANT','103-008','303-006','2014-11-05 07:37:00','0000-00-00 00:00:00','admin',''),(59,'RUSIZI','AJRE','HOUSEHOLD','103-004','303-006','2014-11-05 07:38:00','0000-00-00 00:00:00','admin',''),(60,'RUSIZI','AJRE','MEDICINE','103-001','303-006','2014-11-05 07:39:00','0000-00-00 00:00:00','admin',''),(61,'RUSIZI','AJRE','NUTRITION','103-003','303-006','2014-11-05 07:39:00','0000-00-00 00:00:00','admin',''),(62,'RUSIZI','AJRE','PERSONAL','103-006','303-006','2014-11-05 07:39:00','0000-00-00 00:00:00','admin',''),(92,'RUSIZI','DO--','MEDICAL SUPPLIES','401-002','103-002','2014-11-05 07:40:00','0000-00-00 00:00:00','admin',''),(93,'RUSIZI','AJIS','MEDICAL SUPPLIES','303-006','103-002','2014-11-05 07:40:00','0000-00-00 00:00:00','admin',''),(94,'RUSIZI','AJRE','MEDICAL SUPPLIES','103-002','303-006','2014-11-05 07:41:00','0000-00-00 00:00:00','admin','');

/*Table structure for table `numname` */

DROP TABLE IF EXISTS `numname`;

CREATE TABLE `numname` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numname` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

/*Data for the table `numname` */

insert  into `numname`(`id`,`numname`) values (1,''),(2,' One'),(3,' Two'),(4,' Three'),(5,' Four'),(6,' Five'),(7,' Six'),(8,' Seven'),(9,' Eight'),(10,' Nine'),(11,' Ten'),(12,' Eleven'),(13,' Twelve'),(14,' Thirteen'),(15,' Fourteen'),(16,' Fifteen'),(17,' Sixteen'),(18,' Seventeen'),(19,' Eighteen'),(20,' Nineteen');

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
  `c_status` varchar(50) DEFAULT NULL,
  `inserttime` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `insertuser` varchar(50) DEFAULT NULL,
  `updateuser` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pp_purordnum` (`pp_purordnum`,`cm_code`),
  KEY `cm_code` (`cm_code`),
  CONSTRAINT `pp_purchaseorddt_ibfk_1` FOREIGN KEY (`cm_code`) REFERENCES `cm_productmaster` (`cm_code`),
  CONSTRAINT `pp_purchaseorddt_ibfk_2` FOREIGN KEY (`pp_purordnum`) REFERENCES `pp_purchaseordhd` (`pp_purordnum`)
) ENGINE=InnoDB AUTO_INCREMENT=201 DEFAULT CHARSET=utf8;

/*Data for the table `pp_purchaseorddt` */

insert  into `pp_purchaseorddt`(`id`,`pp_purordnum`,`cm_code`,`pp_quantity`,`pp_grnqty`,`pp_taxrate`,`pp_taxamt`,`pp_unit`,`pp_unitqty`,`pp_purchasrate`,`pp_rowamt`,`c_status`,`inserttime`,`updatetime`,`insertuser`,`updateuser`) values (197,'PR--00000002','M3111GRE',2,2,'0.00','0.00','BOX',100,'1.20','240.00','GRN Created','2014-11-11 11:12:09',NULL,'admin',NULL),(198,'PR--00000002','F1207ACT',100,50,'0.00','0.00','PCS',1,'1.00','100.00','GRN Created','2014-11-11 11:12:09',NULL,'admin',NULL),(199,'PR--00000002','P1158FUZ-01',20,20,'0.00','0.00','PCS',1,'0.80','16.00','GRN Created','2014-11-11 11:12:09',NULL,'admin',NULL),(200,'PO--00000001','M3111GRE',3,NULL,'0.00','0.00','BOX',100,'1.20','360.00',NULL,'2014-11-11 06:38:00','0000-00-00 00:00:00','admin','');

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
  `pp_exchrate` decimal(20,5) DEFAULT NULL,
  `inserttime` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `insertuser` varchar(50) DEFAULT NULL,
  `updateuser` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pp_purordnum` (`pp_purordnum`),
  KEY `cm_supplierid` (`cm_supplierid`),
  CONSTRAINT `pp_purchaseordhd_ibfk_1` FOREIGN KEY (`cm_supplierid`) REFERENCES `cm_suppliermaster` (`cm_supplierid`)
) ENGINE=InnoDB AUTO_INCREMENT=134 DEFAULT CHARSET=utf8;

/*Data for the table `pp_purchaseordhd` */

insert  into `pp_purchaseordhd`(`id`,`pp_purordnum`,`pp_date`,`cm_supplierid`,`pp_requisitionno`,`pp_payterms`,`pp_deliverydate`,`pp_store`,`pp_taxrate`,`pp_taxamt`,`pp_discrate`,`pp_discamt`,`pp_amount`,`pp_netamt`,`pp_status`,`pp_currency`,`pp_exchrate`,`inserttime`,`updatetime`,`insertuser`,`updateuser`) values (132,'PR--00000002','2014-11-11','ACT','RE--00000001','Cash','2014-11-11','RUSIZI','0.00','0.00','0.00','0.00','356.00','356.00','Part Received','USD','1.00000','2014-11-11 11:12:09',NULL,'admin',NULL),(133,'PO--00000001','2014-11-11','AFP',NULL,'Cash','2014-11-12','RUSIZI','0.00','0.00','0.00',NULL,'360.00','360.00','Open','USD','1.00000','2014-11-11 06:38:00','0000-00-00 00:00:00','admin','');

/*Table structure for table `pp_requisitiondt` */

DROP TABLE IF EXISTS `pp_requisitiondt`;

CREATE TABLE `pp_requisitiondt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pp_requisitionno` varchar(50) NOT NULL,
  `cm_code` varchar(50) NOT NULL,
  `pp_unit` varchar(50) DEFAULT NULL,
  `pp_quantity` int(11) DEFAULT NULL,
  `c_status` varchar(50) DEFAULT NULL,
  `inserttime` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `insertuser` varchar(50) DEFAULT NULL,
  `updateuser` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pp_requisitionno` (`pp_requisitionno`,`cm_code`),
  KEY `cm_code` (`cm_code`),
  CONSTRAINT `pp_requisitiondt_ibfk_1` FOREIGN KEY (`cm_code`) REFERENCES `cm_productmaster` (`cm_code`),
  CONSTRAINT `pp_requisitiondt_ibfk_2` FOREIGN KEY (`pp_requisitionno`) REFERENCES `pp_requisitionhd` (`pp_requisitionno`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `pp_requisitiondt` */

insert  into `pp_requisitiondt`(`id`,`pp_requisitionno`,`cm_code`,`pp_unit`,`pp_quantity`,`c_status`,`inserttime`,`updatetime`,`insertuser`,`updateuser`) values (1,'RE--00000001','M3111GRE','BOX',2,'PO Created','2014-11-11 05:28:00','0000-00-00 00:00:00','admin',''),(2,'RE--00000001','F1207ACT','PCS',100,'PO Created','2014-11-11 05:28:00','0000-00-00 00:00:00','admin',''),(3,'RE--00000001','P1158FUZ-01','PCS',20,'PO Created','2014-11-11 05:28:00','0000-00-00 00:00:00','admin','');

/*Table structure for table `pp_requisitionhd` */

DROP TABLE IF EXISTS `pp_requisitionhd`;

CREATE TABLE `pp_requisitionhd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pp_requisitionno` varchar(50) NOT NULL,
  `cm_supplierid` varchar(50) DEFAULT NULL,
  `pp_date` date DEFAULT NULL,
  `pp_currency` varchar(50) DEFAULT NULL,
  `pp_exchrate` decimal(20,5) DEFAULT NULL,
  `pp_branch` varchar(50) DEFAULT NULL,
  `pp_note` varchar(250) DEFAULT NULL,
  `pp_status` varchar(50) DEFAULT NULL,
  `pp_ponumber` varchar(50) DEFAULT NULL,
  `inserttime` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `insertuser` varchar(50) DEFAULT NULL,
  `updateuser` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pp_requisitionno` (`pp_requisitionno`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `pp_requisitionhd` */

insert  into `pp_requisitionhd`(`id`,`pp_requisitionno`,`cm_supplierid`,`pp_date`,`pp_currency`,`pp_exchrate`,`pp_branch`,`pp_note`,`pp_status`,`pp_ponumber`,`inserttime`,`updatetime`,`insertuser`,`updateuser`) values (1,'RE--00000001','ACT','2014-11-11','USD','1.00000','RUSIZI','Testing','PO Created','PR--00000002','2014-11-11 05:28:00','0000-00-00 00:00:00','admin','');

/*Table structure for table `profiles` */

DROP TABLE IF EXISTS `profiles`;

CREATE TABLE `profiles` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `lastname` varchar(50) NOT NULL DEFAULT '',
  `firstname` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`user_id`),
  CONSTRAINT `user_profile_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Data for the table `profiles` */

insert  into `profiles`(`user_id`,`lastname`,`firstname`) values (1,'Admin','Administrator');

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
  `sm_sellrate` decimal(20,2) DEFAULT NULL,
  `sm_rate` decimal(20,2) DEFAULT NULL,
  `sm_tax_rate` decimal(20,2) DEFAULT NULL,
  `sm_tax_amt` decimal(20,2) DEFAULT NULL,
  `sm_line_amt` decimal(20,2) DEFAULT NULL,
  `sm_currency` varchar(50) DEFAULT NULL,
  `sm_exchrate` decimal(20,5) DEFAULT NULL,
  `sm_ref_code` varchar(50) DEFAULT NULL,
  `inserttime` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `insertuser` varchar(20) DEFAULT NULL,
  `updateuser` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sm_number` (`sm_number`,`cm_code`,`sm_batchnumber`),
  KEY `cm_code` (`cm_code`),
  CONSTRAINT `sm_batchsale_ibfk_1` FOREIGN KEY (`sm_number`) REFERENCES `sm_header` (`sm_number`),
  CONSTRAINT `sm_batchsale_ibfk_2` FOREIGN KEY (`cm_code`) REFERENCES `cm_productmaster` (`cm_code`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8;

/*Data for the table `sm_batchsale` */

/*Table structure for table `sm_detail` */

DROP TABLE IF EXISTS `sm_detail`;

CREATE TABLE `sm_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sm_number` varchar(20) NOT NULL,
  `cm_code` varchar(50) DEFAULT NULL,
  `sm_unit` varchar(50) DEFAULT NULL,
  `sm_unit_qty` int(11) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=133 DEFAULT CHARSET=utf8;

/*Data for the table `sm_detail` */

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
  `sm_currency` varchar(50) DEFAULT NULL,
  `sm_exchrate` decimal(20,5) DEFAULT NULL,
  `sm_note` text,
  `sm_totalamt` decimal(20,2) DEFAULT NULL,
  `sm_total_tax_amt` decimal(20,2) DEFAULT NULL,
  `sm_disc_rate` decimal(20,2) DEFAULT NULL,
  `sm_disc_amt` decimal(20,2) DEFAULT NULL,
  `sm_netamt` decimal(20,2) DEFAULT NULL,
  `sm_sign` int(11) DEFAULT NULL,
  `sm_stataus` varchar(20) DEFAULT NULL,
  `sm_refe_code` varchar(20) DEFAULT NULL,
  `glvoucher` varchar(50) DEFAULT NULL,
  `imvoucher` varchar(50) DEFAULT NULL,
  `inserttime` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `insertuser` varchar(20) DEFAULT NULL,
  `updateuser` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sm_number` (`sm_number`),
  KEY `sm_date` (`sm_date`),
  KEY `cm_cuscode` (`cm_cuscode`),
  CONSTRAINT `sm_header_ibfk_1` FOREIGN KEY (`cm_cuscode`) REFERENCES `cm_customermst` (`cm_cuscode`)
) ENGINE=InnoDB AUTO_INCREMENT=160 DEFAULT CHARSET=utf8;

/*Data for the table `sm_header` */

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
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;

/*Data for the table `sm_invalc` */

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

/*Table structure for table `tensname` */

DROP TABLE IF EXISTS `tensname`;

CREATE TABLE `tensname` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tensname` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Data for the table `tensname` */

insert  into `tensname`(`id`,`tensname`) values (1,''),(2,' Ten'),(3,' Twenty'),(4,' Thirty'),(5,' Forty'),(6,' Fifty'),(7,' Sixty'),(8,' Seventy'),(9,' Eighty'),(10,' Ninety');

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
  `user_type` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `status` (`status`),
  KEY `superuser` (`superuser`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`password`,`email`,`employeeid`,`employeebranch`,`activkey`,`create_at`,`lastvisit_at`,`superuser`,`status`,`user_type`) values (1,'admin','21232f297a57a5a743894a0e4a801fc3','webmaster@example.com','admin','RUSIZI','9a24eff8c15a6a141ece27eb6947da0f','2013-11-24 14:01:06','2014-11-11 11:35:50',1,1,'Admin');

/* Trigger structure for table `am_voucherdetail` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tr_voucherdt_insert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `tr_voucherdt_insert` AFTER INSERT ON `am_voucherdetail` FOR EACH ROW BEGIN
			UPDATE am_vouhcerheader AS a
			SET a.am_status=(SELECT CASE WHEN SUM(am_primeamt)=0 THEN 'Balanced' ELSE 'Suspend' END 
											 FROM am_voucherdetail 
											 WHERE am_vouchernumber=new.am_vouchernumber
											 GROUP BY am_vouchernumber)
			WHERE am_vouchernumber=new.am_vouchernumber;
    END */$$


DELIMITER ;

/* Trigger structure for table `am_voucherdetail` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tr_voucherdt_update` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `tr_voucherdt_update` AFTER UPDATE ON `am_voucherdetail` FOR EACH ROW BEGIN
			UPDATE am_vouhcerheader AS a
			SET a.am_status=(SELECT CASE WHEN SUM(am_primeamt)=0 THEN 'Balanced' ELSE 'Suspend' END 
											 FROM am_voucherdetail 
											 WHERE am_vouchernumber=new.am_vouchernumber
											 GROUP BY am_vouchernumber)
			WHERE am_vouchernumber=new.am_vouchernumber;
    END */$$


DELIMITER ;

/* Trigger structure for table `am_voucherdetail` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tr_voucherdt_delete` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `tr_voucherdt_delete` AFTER DELETE ON `am_voucherdetail` FOR EACH ROW BEGIN
			UPDATE am_vouhcerheader AS a
			SET a.am_status=(SELECT CASE WHEN SUM(am_primeamt)=0 THEN 'Balanced' ELSE 'Suspend' END 
											 FROM am_voucherdetail 
											 WHERE am_vouchernumber=old.am_vouchernumber
											 GROUP BY am_vouchernumber)
			WHERE am_vouchernumber=old.am_vouchernumber;
    END */$$


DELIMITER ;

/* Trigger structure for table `im_grndetail` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tr_im_grndetail_insert_bf` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `tr_im_grndetail_insert_bf` BEFORE INSERT ON `im_grndetail` FOR EACH ROW BEGIN
			DECLARE vTaxRate DECIMAL(20,2);
			
			/*Tax rate and tax amount collection from purchase order. because tax already calcuted in purchase order*/
			SELECT a.pp_taxrate INTO vTaxRate
			FROM pp_purchaseorddt a
			INNER JOIN im_grnheader b ON a.pp_purordnum=b.im_purordnum
			WHERE a.cm_code=new.cm_code AND b.im_grnnumber=new.im_grnnumber;			
			
			/*Update self by tax rate and tax amount*/
			SET new.im_rowamount=ROUND((new.im_RcvQuantity*new.im_costprice*new.im_unitqty),2);
			SET new.im_taxrate=vTaxRate;
			SET new.im_taxamt=new.im_rowamount-ROUND(new.im_rowamount/((vTaxRate+100)/100),2);
	
		END */$$


DELIMITER ;

/* Trigger structure for table `im_grndetail` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tr_im_grndetail_insert_af` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `tr_im_grndetail_insert_af` AFTER INSERT ON `im_grndetail` FOR EACH ROW BEGIN
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

/* Trigger structure for table `im_grndetail` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tr_im_grndetail_update_bf` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `tr_im_grndetail_update_bf` BEFORE UPDATE ON `im_grndetail` FOR EACH ROW BEGIN
			DECLARE vTaxRate DECIMAL(20,2);
			
			/*Tax rate and tax amount collection from purchase order. because tax already calcuted in purchase order*/
			SELECT a.pp_taxrate INTO vTaxRate
			FROM pp_purchaseorddt a
			INNER JOIN im_grnheader b ON a.pp_purordnum=b.im_purordnum
			WHERE a.cm_code=new.cm_code AND b.im_grnnumber=new.im_grnnumber;			
			
			/*Update self by tax rate and tax amount*/
			SET new.im_rowamount=ROUND((new.im_RcvQuantity*new.im_costprice*new.im_unitqty),2);
			SET new.im_taxrate=vTaxRate;
			SET new.im_taxamt=new.im_rowamount-ROUND(new.im_rowamount/((vTaxRate+100)/100),2);
				
		END */$$


DELIMITER ;

/* Trigger structure for table `im_grndetail` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tr_im_grndetail_delete` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `tr_im_grndetail_delete` AFTER DELETE ON `im_grndetail` FOR EACH ROW BEGIN
		DECLARE vAvgTaxRate DECIMAL(10,2);
		
		/*Purchase order detail updated grn quantity*/
		UPDATE pp_purchaseorddt AS a
		INNER JOIN im_grnheader AS b ON a.pp_purordnum=b.im_purordnum
		SET a.pp_grnqty=IFNULL(a.pp_grnqty,0)-old.im_RcvQuantity
		WHERE a.cm_code=old.cm_code AND b.im_grnnumber=old.im_grnnumber;
		
		/*Purchase order update by Status Received=Full Received*/
		UPDATE pp_purchaseordhd AS a
		INNER JOIN im_grnheader AS b ON a.pp_purordnum=b.im_purordnum
		SET pp_status=(SELECT CASE WHEN (SUM(pp_quantity)-SUM(pp_grnqty))>0 THEN 'Part Received' ELSE 'Received' END AS pp_status
									 FROM pp_purchaseorddt a 
									 INNER JOIN im_grnheader b ON a.pp_purordnum=b.im_purordnum
									 WHERE b.im_grnnumber=old.im_grnnumber
									 GROUP BY a.pp_purordnum)
		WHERE b.im_grnnumber=old.im_grnnumber;
		/*Finding vAVG Tex rate*/
		SELECT CONVERT(SUM(im_taxrate)/COUNT(im_grnnumber), DECIMAL(10,2)) INTO vAvgTaxRate
		FROM im_grndetail 
		WHERE im_grnnumber=old.im_grnnumber
		GROUP BY im_grnnumber;
					
		/*GRN Header table update by net, tax and total amount*/
		UPDATE im_grnheader a
		LEFT JOIN(SELECT im_grnnumber, SUM(im_taxamt) AS taxamt, SUM(im_rowamount) AS rowamt
							FROM im_grndetail
							WHERE im_grnnumber=old.im_grnnumber
							GROUP BY im_grnnumber) b ON a.im_grnnumber=b.im_grnnumber
		SET a.im_taxamt=a.im_taxamt-b.taxamt, 
				a.im_amount=a.im_amount-b.rowamt, 
				a.im_netamt=b.rowamt-b.taxamt,
				a.im_taxrate=a.im_taxrate-vAvgTaxRate
		WHERE a.im_grnnumber=old.im_grnnumber;    
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

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `tr_pp_PurchaseOrdDt_insert_bf` BEFORE INSERT ON `pp_purchaseorddt` FOR EACH ROW BEGIN
			DECLARE vTaxRate DECIMAL(20,2);
			
			/*Finding Tax Rate from cm_codesparam table which was define by product group*/
			SELECT IFNULL(a.cm_purtax,0) INTO vTaxRate
			FROM cm_codesparam a
			INNER JOIN cm_productmaster b ON a.cm_code=b.cm_category
			WHERE b.cm_code=new.cm_code AND a.cm_type='Product Category';
			
			/*THIS IS THE RIGHT WAY TO SAME TRIGGER SAME TABLE UPDATE*/
			SET new.pp_rowamt=(new.pp_quantity*new.pp_purchasrate*new.pp_unitqty);
			SET new.pp_taxrate=vTaxRate;
			SET new.pp_taxamt=ROUND(new.pp_rowamt-(new.pp_rowamt/((vTaxRate+100)/100)),2);
			
		END */$$


DELIMITER ;

/* Trigger structure for table `pp_purchaseorddt` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tr_pp_PurchaseOrdDt_insert_af` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `tr_pp_PurchaseOrdDt_insert_af` AFTER INSERT ON `pp_purchaseorddt` FOR EACH ROW BEGIN
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

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tr_pp_PurchaseOrdDt_update_bf` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `tr_pp_PurchaseOrdDt_update_bf` BEFORE UPDATE ON `pp_purchaseorddt` FOR EACH ROW BEGIN
			DECLARE vTaxRate DECIMAL(20,2);
			
			/*Finding Tax Rate from cm_codesparam table which was define by product group*/
			SELECT IFNULL(a.cm_purtax,0) INTO vTaxRate
			FROM cm_codesparam a
			INNER JOIN cm_productmaster b ON a.cm_code=b.cm_category
			WHERE b.cm_code=new.cm_code AND a.cm_type='Product Category';
			
			/*THIS IS THE RIGHT WAY TO SAME TRIGGER SAME TABLE UPDATE*/
			SET new.pp_rowamt=(new.pp_quantity*new.pp_purchasrate*new.pp_unitqty);
			SET new.pp_taxrate=vTaxRate;
			SET new.pp_taxamt=ROUND(new.pp_rowamt-(new.pp_rowamt/((vTaxRate+100)/100)),2);
		END */$$


DELIMITER ;

/* Trigger structure for table `pp_purchaseorddt` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tr_pp_PurchaseOrdDt_update_af` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `tr_pp_PurchaseOrdDt_update_af` AFTER UPDATE ON `pp_purchaseorddt` FOR EACH ROW BEGIN
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

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `tr_pp_PurchaseOrdDt_delete` AFTER DELETE ON `pp_purchaseorddt` FOR EACH ROW BEGIN
			DECLARE vAvgTaxRate DECIMAL(10,2);
			SELECT CONVERT(SUM(pp_taxrate)/COUNT(pp_purordnum), DECIMAL(10,2)) INTO vAvgTaxRate
			FROM pp_purchaseorddt
			WHERE pp_purordnum=old.pp_purordnum
			GROUP BY pp_purordnum;
			
			/*Update purchase header table with tax amount and total row amount pluss net amount*/
			UPDATE pp_purchaseordhd a
			LEFT JOIN(SELECT pp_purordnum,IFNULL(SUM(pp_taxamt),0)AS tottaxamt, IFNULL(SUM(pp_rowamt),0) AS totlineamt
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

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tr_sm_detail_insert_bf` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `tr_sm_detail_insert_bf` BEFORE INSERT ON `sm_detail` FOR EACH ROW begin
	
	set new.sm_lineamt=(new.sm_unit_qty*new.sm_quantity)*new.sm_rate;
	set new.sm_tax_amt=new.sm_lineamt*(new.sm_tax_rate/100);
	
	end */$$


DELIMITER ;

/* Trigger structure for table `sm_detail` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tr_sm_batchsale_insert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `tr_sm_batchsale_insert` AFTER INSERT ON `sm_detail` FOR EACH ROW BEGIN
	DECLARE v_FromStore,v_Unit,v_Batch,v_Currency VARCHAR(50);
	DECLARE v_IssueQty,v_BonusQty,v_AvlQty INT;
	DECLARE v_Date,v_ExpDate DATE;
	DECLARE v_Rate,v_ExchRate DECIMAL(20,5);
	
	DECLARE No_DATA INT DEFAULT 0;
	
	DECLARE CurBatch CURSOR FOR
	SELECT a.im_BatchNumber,a.im_ExpireDate,a.im_rate,SUM(a.Available),b.cm_currency,b.cm_exchrate
	FROM im_vw_stock a
	INNER JOIN cm_branchmaster b ON a.im_storeid=b.cm_branch
	WHERE a.cm_code=new.cm_code AND a.im_storeid=v_FromStore AND a.im_ExpireDate>v_Date AND a.Available>0
	GROUP BY a.im_ExpireDate,a.im_BatchNumber;
	
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET NO_DATA=-2;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET NO_DATA=-1;

	SET v_BonusQty=new.sm_bonusqty;
	SET v_IssueQty=(new.sm_quantity*new.sm_unit_qty)+new.sm_bonusqty;
	SET v_Unit=new.sm_unit;
	SELECT sm_storeid, sm_date INTO v_FromStore, v_Date FROM sm_header WHERE sm_number=new.sm_number;
	
	OPEN CurBatch;
	FETCH FROM CurBatch INTO v_Batch,v_ExpDate,v_Rate,v_AvlQty,v_Currency,v_ExchRate;
	a: WHILE NO_DATA=0 DO -- 1
	
		IF v_AvlQty>=v_IssueQty THEN -- 2
			INSERT INTO sm_batchsale(sm_number,cm_code,sm_batchnumber,sm_expdate,sm_unit,sm_quantity,
															 sm_bonusqty,sm_rate,sm_sellrate,sm_tax_rate,sm_tax_amt,sm_line_amt,inserttime,insertuser,
															 sm_currency,sm_exchrate,sm_ref_code)
			VALUES(new.sm_number,new.cm_code,v_Batch, v_ExpDate, v_Unit, (v_IssueQty-v_BonusQty),
							v_BonusQty,v_Rate,new.sm_rate,new.sm_tax_rate,new.sm_tax_amt,new.sm_lineamt,
							CURRENT_TIMESTAMP,new.insertuser,v_Currency,v_ExchRate,new.sm_number);
			LEAVE a;
		ELSEIF v_IssueQty>v_AvlQty THEN
			INSERT INTO sm_batchsale(sm_number,cm_code,sm_batchnumber,sm_expdate,sm_unit,sm_quantity,
															 sm_bonusqty,sm_rate,sm_sellrate,sm_tax_rate,sm_tax_amt,sm_line_amt,inserttime,insertuser,
															 sm_currency,sm_exchrate,sm_ref_code)
			VALUES(new.sm_number,new.cm_code,v_Batch, v_ExpDate, v_Unit,
						 CASE WHEN v_AvlQty>v_BonusQty THEN (v_AvlQty-v_BonusQty) ELSE v_AvlQty END,
						 CASE WHEN v_AvlQty>v_BonusQty THEN v_BonusQty ELSE 0 END, 
						 v_Rate,new.sm_rate,new.sm_tax_rate,new.sm_tax_amt,new.sm_lineamt,CURRENT_TIMESTAMP,new.insertuser,
						 v_Currency,v_ExchRate,new.sm_number);
							
			IF v_AvlQty>v_BonusQty THEN -- 3
				SET v_IssueQty=v_IssueQty-v_AvlQty;
				SET v_BonusQty=0;
			ELSE
				SET v_IssueQty=v_IssueQty-v_AvlQty;
			END IF; -- 3
			
		END IF; -- 2
		
	FETCH FROM CurBatch INTO v_Batch,v_ExpDate,v_Rate,v_AvlQty,v_Currency,v_ExchRate;
	END WHILE; -- 1
	CLOSE CurBatch;
	
	/*Update Sales Header*/
	UPDATE sm_header a
	LEFT JOIN (SELECT sm_number,IFNULL(SUM(sm_tax_amt),0) AS TaxAmt,IFNULL(SUM(sm_lineamt),0) AS TotalAmt
						 FROM sm_detail 
						 WHERE sm_number=new.sm_number
						 GROUP BY sm_number) b ON a.sm_number=b.sm_number
	SET a.sm_disc_amt=b.TotalAmt*(a.sm_disc_rate/100),
			a.sm_total_tax_amt=b.TaxAmt,
			a.sm_totalamt=b.TotalAmt,
			a.sm_netamt=(b.TotalAmt+b.TaxAmt)-b.TotalAmt*(a.sm_disc_rate/100)
	WHERE a.sm_number=new.sm_number;
	/********************************/
	
	END */$$


DELIMITER ;

/* Trigger structure for table `sm_detail` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tr_sm_detail_update_bf` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `tr_sm_detail_update_bf` BEFORE UPDATE ON `sm_detail` FOR EACH ROW BEGIN
	
	SET new.sm_lineamt=(new.sm_unit_qty*new.sm_quantity)*new.sm_rate;
	SET new.sm_tax_amt=new.sm_lineamt*(new.sm_tax_rate/100);
	
	end */$$


DELIMITER ;

/* Trigger structure for table `sm_detail` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tr_sm_batchsale_update` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `tr_sm_batchsale_update` AFTER UPDATE ON `sm_detail` FOR EACH ROW BEGIN
	DECLARE v_FromStore,v_Unit,v_Batch,v_Currency VARCHAR(50);
	DECLARE v_IssueQty,v_BonusQty,v_AvlQty INT;
	DECLARE v_Date,v_ExpDate DATE;
	DECLARE v_Rate,v_ExchRate DECIMAL(20,5);
	
	DECLARE No_DATA INT DEFAULT 0;
	
	DECLARE CurBatch CURSOR FOR
	SELECT im_BatchNumber,im_ExpireDate,im_rate,SUM(Available)
	FROM im_vw_stock
	WHERE cm_code=new.cm_code AND im_storeid=v_FromStore AND im_ExpireDate>v_Date AND Available>0
	GROUP BY im_ExpireDate,im_BatchNumber;
	
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET NO_DATA=-2;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET NO_DATA=-1;
	DELETE FROM sm_batchsale WHERE sm_number=old.sm_number AND cm_code=old.cm_code;
	SET v_BonusQty=new.sm_bonusqty;
	SET v_IssueQty=(new.sm_quantity*new.sm_unit_qty)+new.sm_bonusqty;
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

	/*Update Sales Header*/
	UPDATE sm_header a
	LEFT JOIN (SELECT sm_number,ifnull(SUM(sm_tax_amt),0) AS TaxAmt,ifnull(SUM(sm_lineamt),0) AS TotalAmt
						 FROM sm_detail 
						 WHERE sm_number=new.sm_number
						 GROUP BY sm_number) b ON a.sm_number=b.sm_number
	SET a.sm_disc_amt=b.TotalAmt*(a.sm_disc_rate/100),
			a.sm_total_tax_amt=b.TaxAmt,
			a.sm_totalamt=b.TotalAmt,
			a.sm_netamt=(b.TotalAmt+b.TaxAmt)-b.TotalAmt*(a.sm_disc_rate/100)
	WHERE a.sm_number=new.sm_number;
	/********************************/
	
	END */$$


DELIMITER ;

/* Trigger structure for table `sm_detail` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tr_sm_batchsale_delete` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `tr_sm_batchsale_delete` AFTER DELETE ON `sm_detail` FOR EACH ROW BEGIN
	DELETE FROM sm_batchsale WHERE sm_number=old.sm_number AND cm_code=old.cm_code;
	
	/*Update Sales Header*/
	UPDATE sm_header a
	LEFT JOIN (SELECT sm_number,IFNULL(SUM(sm_tax_amt),0) AS TaxAmt,IFNULL(SUM(sm_lineamt),0) AS TotalAmt
						 FROM sm_detail 
						 WHERE sm_number=old.sm_number
						 GROUP BY sm_number) b ON a.sm_number=b.sm_number
	SET a.sm_disc_amt=b.TotalAmt*(a.sm_disc_rate/100),
			a.sm_total_tax_amt=b.TaxAmt,
			a.sm_totalamt=b.TotalAmt,
			a.sm_netamt=(b.TotalAmt+b.TaxAmt)-b.TotalAmt*(a.sm_disc_rate/100)
	WHERE a.sm_number=old.sm_number;
	/********************************/
	
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

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `Fu_GetTrn`(p_type VARCHAR(50),p_trncode VARCHAR(4),p_len INT,p_year BOOLEAN) RETURNS varchar(50) CHARSET utf8
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

/* Function  structure for function  `Fu_ToWord` */

/*!50003 DROP FUNCTION IF EXISTS `Fu_ToWord` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `Fu_ToWord`(pNumber Int) RETURNS varchar(250) CHARSET utf8
BEGIN
	Declare soFar varchar(100);
	
	if (mod(pNumber,100))<20 then
		set soFar=(select numname from numName where id=mod(pNumber,100));
		-- set pNumber = pNumber/100;
	else
		set soFar=(select numname from numName where id=mod(pNumber,10));
		set pNumber=pNumber/10;
		set soFar=(select tensname from tensName where id=mod(pNumber,10))+soFar;
		set pNumber=pNumber/10;
	end if;
	if(pNumber=0) then Return soFar+"4544"; end if;
	-- set soFar=(select numname from numName where id=pNumber)+" Hundred "+ soFar;
RETURN soFar;
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

/* Procedure structure for procedure `sp_am_voucherpost` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_am_voucherpost` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_am_voucherpost`(
	v_voucherno varchar(50),
	pUser varchar(50)
)
begin
	INSERT INTO am_balance(c_vouchernumber,c_accountcode,c_subacc,c_date,c_branch,c_referance,c_year,c_period,c_currency,
												 c_exchagerate,c_primeamt,c_baseamt,c_status,inserttime,insertuser)
	SELECT a.am_vouchernumber,b.am_accountcode,b.am_subacccode,a.am_date,a.am_branch,a.am_referance,a.am_year,a.am_period,b.am_currency,
				 b.am_exchagerate,b.am_primeamt,b.am_baseamt,'Post',CURRENT_TIMESTAMP,pUser
	FROM am_vouhcerheader a
	INNER JOIN am_voucherdetail b ON a.am_vouchernumber=b.am_vouchernumber
	WHERE a.am_status='Balanced' AND a.am_vouchernumber=v_voucherno;
	
	update am_vouhcerheader set am_status='Posted' where am_vouchernumber=v_voucherno and am_status='Balanced';
end */$$
DELIMITER ;

/* Procedure structure for procedure `sp_gl_postunpost_d` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_gl_postunpost_d` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_gl_postunpost_d`(
	pfromdate DATE,
	ptodate DATE,
	paction INT, -- this parameter use for 1=Post to the balase table. 0=un post from balance table.
	pUser VARCHAR(10)
)
BEGIN
	DECLARE v_voucherno VARCHAR(50);
	
	DECLARE NO_DATA INT DEFAULT 0;
	
	DECLARE cursor_post CURSOR FOR
	SELECT am_vouchernumber
	FROM am_vouhcerheader 
	WHERE am_date BETWEEN pfromdate AND ptodate AND am_status IN('Balanced');
	
	DECLARE cursor_unpost CURSOR FOR
	SELECT am_vouchernumber
	FROM am_vouhcerheader 
	WHERE am_date BETWEEN pfromdate AND ptodate AND am_status='Posted';
	-- DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET NO_DATA=-2;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET NO_DATA=1;
	IF paction=1 THEN -- if1
		OPEN cursor_post;
		FETCH FROM cursor_post INTO v_voucherno;
		WHILE NO_DATA=0 DO -- w1
			INSERT INTO am_balance(c_vouchernumber,c_accountcode,c_subacc,c_date,c_branch,c_referance,c_year,c_period,c_currency,
														 c_exchagerate,c_primeamt,c_baseamt,c_status,inserttime,insertuser)
			SELECT a.am_vouchernumber,b.am_accountcode,b.am_subacccode,a.am_date,a.am_branch,a.am_referance,a.am_year,a.am_period,b.am_currency,
						 b.am_exchagerate,b.am_primeamt,b.am_baseamt,'Post',CURRENT_TIMESTAMP,pUser
			FROM am_vouhcerheader a
			INNER JOIN am_voucherdetail b ON a.am_vouchernumber=b.am_vouchernumber
			WHERE a.am_status='Balanced' AND a.am_vouchernumber=v_voucherno;
			
			UPDATE am_voucherdetail 
			SET c_status='Posted',updatetime=CURRENT_TIMESTAMP,updateuser=pUser 
			WHERE am_vouchernumber=v_voucherno;
			UPDATE am_vouhcerheader 
			SET am_status='Posted', updatetime=CURRENT_TIMESTAMP,updateuser=pUser
			WHERE am_vouchernumber=v_voucherno;
			
		FETCH next FROM cursor_post INTO v_voucherno;
		END WHILE; -- w1
		CLOSE cursor_post;
	END IF; -- if1
	IF paction=0 THEN -- if2
		OPEN cursor_unpost;
		FETCH FROM cursor_unpost INTO v_voucherno;
		WHILE NO_DATA=0 DO -- w1
			
			DELETE FROM am_balance WHERE c_vouchernumber=v_voucherno AND c_status='Post';
						
			UPDATE am_voucherdetail 
			SET c_status='Balanced',updatetime=CURRENT_TIMESTAMP,updateuser=pUser 
			WHERE am_vouchernumber=v_voucherno;
			
		FETCH next FROM cursor_unpost INTO v_voucherno;
		END WHILE; -- w1
		CLOSE cursor_unpost;
	END IF; -- if2
	
END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_gl_postunpost_v` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_gl_postunpost_v` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_gl_postunpost_v`(
	pfvoucher VARCHAR(50),
	ptvoucher VARCHAR(50),
	paction INT, -- this parameter use for 1=Post to the balase table. 0=un post from balance table.
	pUser VARCHAR(10)
)
BEGIN
	DECLARE v_voucherno VARCHAR(50);
	
	DECLARE NO_DATA INT DEFAULT 0;
	
	DECLARE cursor_post CURSOR FOR
	SELECT am_vouchernumber
	FROM am_vouhcerheader 
	WHERE am_vouchernumber BETWEEN pfvoucher AND ptvoucher AND am_status IN('Balanced');
	
	DECLARE cursor_unpost CURSOR FOR
	SELECT am_vouchernumber
	FROM am_vouhcerheader 
	WHERE am_vouchernumber BETWEEN pfvoucher AND ptvoucher AND am_status='Posted';
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET NO_DATA=-2;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET NO_DATA=-1;
	IF paction=1 THEN -- if1
		OPEN cursor_post;
		FETCH FROM cursor_post INTO v_voucherno;
		WHILE NO_DATA=0 DO -- w1
		
			INSERT INTO am_balance(c_vouchernumber,c_accountcode,c_subacc,c_date,c_branch,c_referance,c_year,c_period,c_currency,
														 c_exchagerate,c_primeamt,c_baseamt,c_status,inserttime,insertuser)
			SELECT a.am_vouchernumber,b.am_accountcode,b.am_subacccode,a.am_date,a.am_branch,a.am_referance,a.am_year,a.am_period,b.am_currency,
						 b.am_exchagerate,b.am_primeamt,b.am_baseamt,'Post',CURRENT_TIMESTAMP,pUser
			FROM am_vouhcerheader a
			INNER JOIN am_voucherdetail b ON a.am_vouchernumber=b.am_vouchernumber
			WHERE a.am_status='Balanced' AND a.am_vouchernumber=v_voucherno;
			
			UPDATE am_voucherdetail 
			SET c_status='Posted',updatetime=CURRENT_TIMESTAMP,updateuser=pUser 
			WHERE am_vouchernumber=v_voucherno;
			UPDATE am_vouhcerheader 
			SET am_status='Posted', updatetime=CURRENT_TIMESTAMP,updateuser=pUser
			WHERE am_vouchernumber=v_voucherno;
			
		FETCH FROM cursor_post INTO v_voucherno;
		END WHILE; -- w1
		CLOSE cursor_post;
	END IF; -- if1
	IF paction=0 THEN -- if2
		OPEN cursor_unpost;
		FETCH FROM cursor_unpost INTO v_voucherno;
		WHILE NO_DATA=0 DO -- w1
			
			DELETE FROM am_balance WHERE c_vouchernumber=v_voucherno AND c_status='Post';
						
			UPDATE am_voucherdetail 
			SET c_status='Balanced',updatetime=CURRENT_TIMESTAMP,updateuser=pUser 
			WHERE am_vouchernumber=v_voucherno;
			
		FETCH FROM cursor_unpost INTO v_voucherno;
		END WHILE; -- w1
		CLOSE cursor_unpost;
	END IF; -- if2
	
END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_gl_postunpost_y` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_gl_postunpost_y` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_gl_postunpost_y`(
	pYear INT,
	pPeriod INT,
	paction INT, -- this parameter use for 1=Post to the balase table. 0=un post from balance table.
	pUser VARCHAR(10)
)
BEGIN
	DECLARE v_voucherno VARCHAR(50);
	
	DECLARE NO_DATA INT DEFAULT 0;
	
	DECLARE cursor_post CURSOR FOR
	SELECT am_vouchernumber
	FROM am_vouhcerheader 
	WHERE am_year=pYear AND am_period=pPeriod AND am_status IN('Balanced','Un-Post');
	
	DECLARE cursor_unpost CURSOR FOR
	SELECT am_vouchernumber
	FROM am_vouhcerheader 
	WHERE am_year=pYear AND am_period=pPeriod AND am_status='Posted';
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET NO_DATA=-2;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET NO_DATA=-1;
	IF paction=1 THEN -- if1
		OPEN cursor_post;
		FETCH FROM cursor_post INTO v_voucherno;
		WHILE NO_DATA=0 DO -- w1
		
			INSERT INTO am_balance(c_vouchernumber,c_accountcode,c_subacc,c_date,c_branch,c_referance,c_year,c_period,c_currency,
														 c_exchagerate,c_primeamt,c_baseamt,c_status,inserttime,insertuser)
			SELECT a.am_vouchernumber,b.am_accountcode,b.am_subacccode,a.am_date,a.am_branch,a.am_referance,a.am_year,a.am_period,b.am_currency,
						 b.am_exchagerate,b.am_primeamt,b.am_baseamt,'Post',CURRENT_TIMESTAMP,pUser
			FROM am_vouhcerheader a
			INNER JOIN am_voucherdetail b ON a.am_vouchernumber=b.am_vouchernumber
			WHERE a.am_status='Balanced' AND a.am_vouchernumber=v_voucherno;
			
			UPDATE am_voucherdetail 
			SET c_status='Posted',updatetime=CURRENT_TIMESTAMP,updateuser=pUser 
			WHERE am_vouchernumber=v_voucherno;
			UPDATE am_vouhcerheader 
			SET am_status='Posted', updatetime=CURRENT_TIMESTAMP,updateuser=pUser
			WHERE am_vouchernumber=v_voucherno;
			
		FETCH FROM cursor_post INTO v_voucherno;
		END WHILE; -- w1
		CLOSE cursor_post;
	END IF; -- if1
	IF paction=0 THEN -- if2
		OPEN cursor_unpost;
		FETCH FROM cursor_unpost INTO v_voucherno;
		WHILE NO_DATA=0 DO -- w1
			
			DELETE FROM am_balance WHERE c_vouchernumber=v_voucherno AND c_status='Post';
						
			UPDATE am_voucherdetail 
			SET c_status='Balanced',updatetime=CURRENT_TIMESTAMP,updateuser=pUser 
			WHERE am_vouchernumber=v_voucherno;
			
		FETCH FROM cursor_unpost INTO v_voucherno;
		END WHILE; -- w1
		CLOSE cursor_unpost;
	END IF; -- if2
	
END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_imled_rpt` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_imled_rpt` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_imled_rpt`(
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

/* Procedure structure for procedure `sp_im_adjustcon` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_im_adjustcon` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_im_adjustcon`(
	pID INT,
	pUser VARCHAR(50)
)
BEGIN
	DECLARE v_ImNumber,v_procode,v_storeid,v_batch,v_adjustnumber,v_currency,v_unit,v_imvoucher VARCHAR(50);
	DECLARE v_date,v_expdate DATE;
	DECLARE v_exchange DECIMAL(20,5);
	DECLARE v_rate DECIMAL(20,2);
	DECLARE v_sign,v_qty INT;
	DECLARE NO_DATA INT DEFAULT 0;
	
	DECLARE cursor_1 CURSOR FOR
	SELECT a.adjustment_type,a.transaction_number,a.DATE,a.branch,a.currency,a.exchange_rate,
				 b.product_code,b.batch_number,b.expirry_date,b.quantity,b.stock_rate,unit
	FROM im_adjusthd a 
	INNER JOIN im_adjustdt b ON a.transaction_number=b.transaction_number
	WHERE a.id=pID AND a.STATUS='Open';	
	
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET NO_DATA=-2;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET NO_DATA=-1;	
	
	OPEN cursor_1;
	FETCH FROM cursor_1 INTO v_sign,v_adjustnumber,v_date,v_storeid,v_currency,v_exchange,v_procode,v_batch,v_expdate,v_qty,v_rate,v_unit;
	WHILE NO_DATA=0 DO
		IF v_sign>0 THEN
			SELECT Fu_GetTrn('Im Transaction','AJRE',8,0) INTO v_ImNumber;
		ELSE
			SELECT Fu_GetTrn('Im Transaction','AJIS',8,0) INTO v_ImNumber;
		END IF;
		
		INSERT INTO im_transaction(im_number,cm_code,im_storeid,im_BatchNumber,im_date,im_ExpireDate,
															 im_quantity,im_sign,im_unit,im_rate,
															 im_totalprice,im_basevalue,im_RefNumber,im_RefRow,
															 im_note,im_status,cm_supplierid,im_currency,im_ExchangeRate,
															 inserttime,insertuser,im_foreignrate)
		VALUE(v_ImNumber,v_procode,v_storeid,v_batch,v_date,v_expdate,
					v_qty,v_sign,v_unit,v_rate*v_exchange,
					(v_qty*v_rate),(v_qty*v_rate),v_adjustnumber,0,
					v_adjustnumber,'Open',v_adjustnumber,v_currency,v_exchange,
					CURRENT_TIMESTAMP,pUser,v_rate);
	FETCH FROM cursor_1 INTO v_sign,v_adjustnumber,v_date,v_storeid,v_currency,v_exchange,v_procode,v_batch,v_expdate,v_qty,v_rate,v_unit;	
	END WHILE;
	CLOSE cursor_1;
	
	if v_sign=1 then
		CALL sp_im_imtoglpost('AJRE',v_adjustnumber,pUser,v_imvoucher);
	elseif v_sign=-1 then
		CALL sp_im_imtoglpost('AJIS',v_adjustnumber,pUser,v_imvoucher);
	end if;
	
	UPDATE im_adjusthd 
	SET STATUS='Confirmed',confirm_date=CURRENT_DATE,updateuser=pUser,updatetime=CURRENT_TIMESTAMP,voucherno=v_imvoucher
	WHERE id=pID;
END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_im_ConfirmGRN` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_im_ConfirmGRN` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_im_ConfirmGRN`(p_id INT, p_insertuser VARCHAR(50))
BEGIN
	DECLARE vImNumber,vGrnNumber,vStore,vProCode,vBatchNumber,vSupplierId,vSupNmae,vUnit,vCurrency,vStoreCur VARCHAR(50);
	DECLARE vExchangeRate,vRate,vExchRate DECIMAL(20,5);
	
	DECLARE vId,vRcvQuantity INT;
	DECLARE vExpireDate DATE;
	
	DECLARE No_DATA INT DEFAULT 0;
	
	DECLARE CurGrn CURSOR FOR -- This cursor declare for GRN Table
	SELECT b.id, a.im_grnnumber, a.im_store, b.cm_code, b.im_BatchNumber, b.im_ExpireDate, a.cm_supplierid,
				 (b.im_RcvQuantity*b.im_unitqty)/c.cm_stkconfac AS Quantity, ROUND(b.im_costprice,2) AS CostPrice, 
				 a.im_currency, a.im_exchrate,c.cm_stkunit
	FROM im_grnheader a 
	INNER JOIN im_grndetail b ON a.im_grnnumber=b.im_grnnumber
	INNER JOIN cm_productmaster c ON b.cm_code=c.cm_code
	WHERE a.id=p_id AND a.im_status='Open'; -- Declaration close
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET NO_DATA=-2;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET NO_DATA=-1;
	OPEN CurGrn; /******Cursor open here**********/
	FETCH FROM CurGrn INTO vId, vGrnNumber, vStore, vProCode, vBatchNumber, vExpireDate, vSupplierId, vRcvQuantity, vRate, vCurrency, vExchRate,vUnit;
	WHILE No_DATA=0 DO -- 1
		SELECT cm_orgname INTO vSupNmae FROM cm_suppliermaster WHERE cm_supplierid=vSupplierId;
		SELECT Fu_GetTrn('Im Transaction','PO--',8,0) INTO vImNumber;
		
		INSERT INTO im_transaction
		(im_number, cm_code, im_storeid, im_BatchNumber, im_date, im_ExpireDate, im_quantity, im_sign, im_unit, 
		 im_rate, im_totalprice, im_basevalue, im_RefNumber, im_RefRow, im_note, im_status,cm_supplierid, im_currency, 
		 im_ExchangeRate, inserttime, insertuser,im_foreignrate)
		VALUES
		(vImNumber, vProCode, vStore, vBatchNumber, CURRENT_DATE, vExpireDate, vRcvQuantity, 1, vUnit, 
		 vRate*vExchRate, vRate*vRcvQuantity,(vRate*vRcvQuantity)*vExchRate, vGrnNumber, vId, vSupNmae, 'Open', vSupplierId, vCurrency, 
		 vExchRate, CURRENT_TIMESTAMP, p_insertuser,vRate); 
		 
	FETCH FROM CurGrn INTO vId, vGrnNumber, vStore, vProCode, vBatchNumber, vExpireDate, vSupplierId, vRcvQuantity, vRate, vCurrency, vExchRate,vUnit;
	END WHILE; -- 1
	CLOSE CurGrn;
	
	-- Update im_grndetail Set c_status='Confirmed' Where im_grnnumber=vGrnNumber;
	UPDATE im_grnheader SET im_status='Confirmed' WHERE id=p_id;
	
END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_im_CreateGRN` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_im_CreateGRN` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_im_CreateGRN`(p_id INT,p_username VARCHAR(50))
BEGIN
		DECLARE vGrnNumber, vPoNumber VARCHAR(50);
		
		SELECT Fu_GetTrn('GRN Number','GRN-',8,0) INTO vGrnNumber;
		
		INSERT INTO im_grnheader(im_grnnumber,im_purordnum,im_date,cm_supplierid,pp_requisitionno,im_payterms,im_store,
								im_discrate,im_discamt,im_currency,im_exchrate,im_taxrate,im_taxamt,im_amount,im_netamt,
								im_status,inserttime,insertuser)
		SELECT vGrnNumber,pp_purordnum,CURRENT_DATE,cm_supplierid,pp_requisitionno,pp_payterms,pp_store,pp_discrate,
					 pp_discamt,pp_currency,pp_exchrate,pp_taxrate,pp_taxamt,pp_amount,pp_netamt,'Open',CURRENT_TIMESTAMP,p_username 
		FROM pp_purchaseordhd WHERE id=p_id AND pp_status IN('Approved','Part Received');
			
		select pp_purordnum into vPoNumber from pp_purchaseordhd where id=p_id;
		Update pp_purchaseorddt Set c_status='GRN Created' where pp_purordnum=vPoNumber;
		Update pp_purchaseordhd Set pp_status='GRN Created' Where id=p_id;
		SELECT pp_purordnum, vGrnNumber FROM pp_purchaseordhd WHERE id=p_id;
		
	END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_im_imtoglpost` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_im_imtoglpost` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_im_imtoglpost`(
	v_TrnCode VARCHAR(50),
	v_RefNumber VARCHAR(50),
	pUser VARCHAR(50),
	OUT v_RtnVoucher VARCHAR(50)
)
BEGIN
	DECLARE v_Group, v_AccDr, v_AccCr, v_currency, v_voucher,pBranch VARCHAR(50);
	DECLARE v_Prime, v_Base, v_exchange DECIMAL(10,5);
	
	DECLARE NO_DATA INT DEFAULT 0;
	DECLARE cursor_1 CURSOR FOR
	SELECT b.cm_category,c.c_accdr,c.c_acccr, SUM(a.im_totalprice), SUM(a.im_basevalue), a.im_currency, a.im_ExchangeRate, a.im_storeid
	FROM im_transaction a
	INNER JOIN cm_productmaster b ON a.cm_code=b.cm_code
	INNER JOIN it_imtogl c ON LEFT(a.im_number,4)=c.c_trncode AND b.cm_category=c.c_group AND c.c_branch=a.im_storeid
	WHERE c.c_trncode=v_TrnCode AND a.im_status='Open' AND a.im_RefNumber=v_RefNumber
	GROUP BY c.c_trncode, b.cm_group;
	
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET NO_DATA=-2;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET NO_DATA=-1;
	OPEN cursor_1;
	FETCH FROM cursor_1 INTO v_Group, v_AccDr, v_AccCr, v_Prime, v_Base, v_currency, v_exchange, pBranch;
	IF NO_DATA=0 THEN
	
		IF v_TrnCode='DO--' THEN
			SELECT Fu_GetTrn('Voucher No','IM--',8,0) INTO v_voucher;
		ELSEIF v_TrnCode='AJIS' THEN
			SELECT Fu_GetTrn('Voucher No','AJIS',8,0) INTO v_voucher;
		ELSEIF v_TrnCode='AJRE' THEN
			SELECT Fu_GetTrn('Voucher No','AJRE',8,0) INTO v_voucher;
		ELSE
			SELECT Fu_GetTrn('Voucher No','IM--',8,0) INTO v_voucher;
		END IF;
		
		/*Create New Voucher Header*/
		INSERT INTO am_vouhcerheader(am_vouchernumber,am_date,am_referance,am_year,am_period,am_branch,am_note,inserttime,insertuser)
		VALUES(v_voucher,CURRENT_DATE,'Inventory transfer',Fu_Year(CURRENT_DATE),Fu_Period(CURRENT_DATE),pBranch,
		CONCAT('Transfer from Inventory. References Number ',v_RefNumber),CURRENT_TIMESTAMP,pUser);
	
		SET v_RtnVoucher=v_voucher;
	END IF;
	
	WHILE NO_DATA=0 DO -- W2
		/*INSERT DEBIT ACCOUNT*/
		INSERT INTO am_voucherdetail(am_vouchernumber,am_accountcode,am_subacccode,am_currency,am_exchagerate,am_primeamt,am_baseamt,am_branch,am_note,inserttime,insertuser)
		VALUES(v_voucher,v_AccDr,'',v_currency,v_exchange,v_Prime,v_exchange*v_Prime,pBranch,v_Group,CURRENT_TIMESTAMP,pUser);
		/*INSERT CREDIT ACCOUNT*/
		INSERT INTO am_voucherdetail(am_vouchernumber,am_accountcode,am_subacccode,am_currency,am_exchagerate,am_primeamt,am_baseamt,am_branch,am_note,inserttime,insertuser)
		VALUES(v_voucher,v_AccCr,'',v_currency,v_exchange,0-v_Prime,0-(v_exchange*v_Prime),pBranch,v_Group,CURRENT_TIMESTAMP,pUser);
	FETCH FROM cursor_1 INTO v_Group, v_AccDr, v_AccCr, v_Prime, v_Base, v_currency, v_exchange, pBranch;
	END WHILE; -- W2
	CLOSE cursor_1;
	
	UPDATE im_transaction 
	SET im_voucherno=v_voucher,im_status='Post To GL'
	WHERE im_RefNumber=v_RefNumber;
	
	CALL sp_am_voucherpost(v_voucher,pUser);
	
END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_im_imtogltrn` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_im_imtogltrn` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_im_imtogltrn`(
	pBranch VARCHAR(10),
	pFromDate DATE,
	pToDate DATE,
	pUser VARCHAR(10)
)
BEGIN
	DECLARE v_TrnCode, v_Group, v_AccDr, v_AccCr, v_currency, v_voucher VARCHAR(50);
	DECLARE v_Prime, v_Base, v_exchange DECIMAL(10,5);
	
	DECLARE NO_DATA INT DEFAULT 0;
	
	DECLARE cursor_one CURSOR FOR
	SELECT c_trncode FROM it_imtogl
	WHERE c_branch=pBranch
	GROUP BY c_branch, c_trncode;
		
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET NO_DATA=-2;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET NO_DATA=-1;
	
	OPEN cursor_one;
	FETCH FROM cursor_one INTO v_TrnCode;
	WHILE NO_DATA=0 DO -- W1
	
	BLOCK: begin
		declare NO_DATA2 INT default 0;
		
		DECLARE cursor_two CURSOR FOR
		SELECT b.cm_group,c.c_accdr,c.c_acccr, SUM(a.im_totalprice), SUM(a.im_basevalue), a.im_currency, a.im_ExchangeRate
		FROM im_transaction a
		INNER JOIN cm_productmaster b ON a.cm_code=b.cm_code
		INNER JOIN it_imtogl c ON LEFT(a.im_number,4)=c.c_trncode AND b.cm_group=c.c_group AND c.c_branch=a.im_storeid
		WHERE a.im_storeid=pBranch AND c.c_trncode=v_TrnCode AND a.im_status='Open' AND a.im_date BETWEEN pFromDate AND pToDate	
		GROUP BY c.c_trncode, b.cm_group;
		DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET NO_DATA2=-2;
		DECLARE CONTINUE HANDLER FOR NOT FOUND SET NO_DATA2=-1;
		OPEN cursor_two;
		FETCH FROM cursor_two INTO v_Group, v_AccDr, v_AccCr, v_Prime, v_Base, v_currency, v_exchange;
		IF NO_DATA2=0 THEN
			SELECT Fu_GetTrn('Voucher No','IM--',8,0) INTO v_voucher;
			/*Create New Voucher Header*/
			INSERT INTO am_vouhcerheader(am_vouchernumber,am_date,am_referance,am_year,am_period,am_branch,am_note,inserttime,insertuser)
			VALUES(v_voucher,CURRENT_DATE,'Inventory transfer',Fu_Year(CURRENT_DATE),Fu_Period(CURRENT_DATE),pBranch,
				 CONCAT('All ',v_TrnCode,'From ',pFromDate,' To ',pToDate),CURRENT_TIMESTAMP,pUser);
		END IF;
		
		WHILE NO_DATA2=0 DO -- W2
		
			/*INSERT DEBIT ACCOUNT*/
			INSERT INTO am_voucherdetail(am_vouchernumber,am_accountcode,am_subacccode,am_currency,am_exchagerate,am_primeamt,am_baseamt,am_branch,am_note,inserttime,insertuser)
			VALUES(v_voucher,v_AccDr,'',v_currency,v_exchange,v_Prime,v_exchange*v_Prime,pBranch,v_Group,CURRENT_TIMESTAMP,pUser);
			/*INSERT CREDIT ACCOUNT*/
			INSERT INTO am_voucherdetail(am_vouchernumber,am_accountcode,am_subacccode,am_currency,am_exchagerate,am_primeamt,am_baseamt,am_branch,am_note,inserttime,insertuser)
			VALUES(v_voucher,v_AccCr,'',v_currency,v_exchange,0-v_Prime,0-(v_exchange*v_Prime),pBranch,v_Group,CURRENT_TIMESTAMP,pUser);
			
			
		FETCH FROM cursor_two INTO v_Group, v_AccDr, v_AccCr, v_Prime, v_Base, v_currency, v_exchange;
		END WHILE; -- W2
		CLOSE cursor_two;
		
	end BLOCK;
		
		UPDATE im_transaction 
		SET im_voucherno=v_voucher, im_status='Post to GL'
		WHERE im_storeid=pBranch 
			AND LEFT(im_number,4)=v_TrnCode 
			AND im_date BETWEEN pFromDate AND pToDate
			AND im_status='Open';
		
	FETCH FROM cursor_one INTO v_TrnCode;
	END WHILE; -- W1
	CLOSE cursor_one;
END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_im_invoice` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_im_invoice` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_im_invoice`(
	p_id INT,
	p_User VARCHAR(50)
)
BEGIN
	DECLARE v_grnnumber,v_branch,v_itemgroup,v_suppgorup,v_voucher,v_dbacc,v_currency,v_subacc,v_acccode,v_acctax VARCHAR(50);
	DECLARE v_debitamt,v_netamt,v_exchange,v_taxamt DECIMAL(20,5);
	DECLARE NO_DATA INT DEFAULT 0;
	
	DECLARE cur_imgrn CURSOR FOR
	SELECT b.cm_category,d.cm_group AS supgroup,CONVERT(SUM(a.im_rowamount), DECIMAL(20,2)) AS debitamount, e.cm_accdr, 
				 c.im_grnnumber,c.im_store,c.im_currency,c.im_exchrate
	FROM im_grndetail a
	INNER JOIN im_grnheader c ON a.im_grnnumber=c.im_grnnumber
	INNER JOIN cm_productmaster b ON a.cm_code=b.cm_code
	INNER JOIN cm_suppliermaster d ON c.cm_supplierid=d.cm_supplierid
	LEFT JOIN cm_codesparam e ON e.cm_code=b.cm_category AND e.cm_type='Product Category'
	WHERE c.id=p_id AND c.im_status='Confirmed'
	GROUP BY b.cm_group;
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET NO_DATA=-2;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET NO_DATA=-1;
	SELECT Fu_GetTrn('Voucher No','AP--',8,0) INTO v_voucher;
	
  OPEN cur_imgrn;
  FETCH FROM cur_imgrn INTO v_itemgroup, v_suppgorup, v_debitamt, v_dbacc, v_grnnumber, v_branch, v_currency, v_exchange;
	
	/*Create New Invoice Header */
	INSERT INTO am_vouhcerheader(am_vouchernumber,am_date,am_referance,am_year,am_period,am_branch,am_note,inserttime,insertuser)
	VALUES(v_voucher,CURRENT_DATE,CONCAT('Invoiced for GRN number ',v_grnnumber),Fu_Year(CURRENT_DATE),Fu_Period(CURRENT_DATE),v_branch,
				 CONCAT('This invoice automatic create from ',v_grnnumber),CURRENT_TIMESTAMP,p_User);
	
	WHILE NO_DATA=0 DO -- 1 Insert in debit amount
		INSERT INTO am_voucherdetail(am_vouchernumber,am_accountcode,am_subacccode,am_currency,am_exchagerate,am_primeamt,
															   am_baseamt,am_branch,am_note,inserttime,insertuser)
		VALUES(v_voucher,v_dbacc,'',v_currency,v_exchange,v_debitamt,(v_exchange*v_debitamt),
					 v_branch,'Inventory Debit automatic',CURRENT_TIMESTAMP,p_User);
	FETCH FROM cur_imgrn INTO v_itemgroup, v_suppgorup, v_debitamt, v_dbacc, v_grnnumber, v_branch, v_currency, v_exchange;
  END WHILE; -- 1
	CLOSE cur_imgrn;
	
	/*Insert Credit Account*/
	SELECT IFNULL(a.im_taxamt,0) AS v_taxamt,a.im_netamt,b.cm_group,a.cm_supplierid,c.cm_acccode,c.cm_acctax,a.im_currency,a.im_exchrate
	INTO v_taxamt,v_netamt,v_suppgorup,v_subacc,v_acccode,v_acctax,v_currency,v_exchange
	FROM im_grnheader a 
	INNER JOIN cm_suppliermaster b ON a.cm_supplierid=b.cm_supplierid
	LEFT JOIN cm_codesparam c ON c.cm_type='Supplier Group' AND c.cm_code=b.cm_group
	WHERE a.id=p_id;
	
	INSERT INTO am_voucherdetail(am_vouchernumber,am_accountcode,am_subacccode,am_currency,am_exchagerate,am_primeamt,am_baseamt,am_branch,am_note,inserttime,insertuser)
	VALUES(v_voucher,v_acccode,v_subacc,v_currency,v_exchange,0-v_netamt,0-(v_exchange*v_netamt),v_branch,'Receiveable Credit automatic',CURRENT_TIMESTAMP,p_User);
	
	IF v_taxamt<>0 THEN -- 2 If tax amount is not zero then credit account will enter.
		INSERT INTO am_voucherdetail(am_vouchernumber,am_accountcode,am_subacccode,am_currency,am_exchagerate,am_primeamt,am_baseamt,am_branch,am_note,inserttime,insertuser)
		VALUES(v_voucher,v_acctax,'',v_currency,v_exchange,v_taxamt,(v_exchange*v_taxamt),v_branch,'Inventory Credit automatic',CURRENT_TIMESTAMP,p_User);
	END IF; -- 2
	
	UPDATE im_grnheader SET im_status='Invoiced',am_vouchernumber=v_voucher WHERE id=p_id AND im_status='Confirmed';
	
	CALL sp_am_voucherpost(v_voucher,p_User);
END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_im_test` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_im_test` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_im_test`(
	pBranch VARCHAR(10),
	pFromDate DATE,
	pToDate DATE,
	pUser VARCHAR(10)
)
BEGIN
	DECLARE v_TrnCode, v_Group, v_AccDr, v_AccCr, v_currency, v_voucher VARCHAR(50);
	DECLARE v_Prime, v_Base, v_exchange DECIMAL(10,5);
	
	DECLARE NO_DATA INT DEFAULT 0;
	
	DECLARE cursor_one CURSOR FOR
	SELECT c_trncode FROM it_imtogl
	WHERE c_branch=pBranch
	GROUP BY c_branch, c_trncode;
	
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET NO_DATA=-2;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET NO_DATA=-1;
		
	OPEN cursor_one;
	FETCH FROM cursor_one INTO v_TrnCode;
	WHILE NO_DATA=0 DO -- W1
		SELECT NO_DATA,'LAST cursor',v_TrnCode;
		Block1: begin
			declare NO_DATA2 int default 0;
			
			DECLARE cursor_two CURSOR FOR
			SELECT b.cm_group,c.c_accdr,c.c_acccr, SUM(a.im_totalprice), SUM(a.im_basevalue), a.im_currency, a.im_ExchangeRate
			FROM im_transaction a
			INNER JOIN cm_productmaster b ON a.cm_code=b.cm_code
			INNER JOIN it_imtogl c ON LEFT(a.im_number,4)=c.c_trncode AND b.cm_group=c.c_group AND c.c_branch=a.im_storeid
			WHERE a.im_storeid=pBranch AND c.c_trncode=v_TrnCode AND a.im_date BETWEEN pFromDate AND pToDate and a.im_status='Open'
			GROUP BY c.c_trncode, b.cm_group;
			
			DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET NO_DATA2=-2;
			DECLARE CONTINUE HANDLER FOR NOT FOUND SET NO_DATA2=-1;
		
			OPEN cursor_two;
			FETCH FROM cursor_two INTO v_Group, v_AccDr, v_AccCr, v_Prime, v_Base, v_currency, v_exchange;
			-- SELECT NO_DATA2,'After second cursor',v_TrnCode;
			WHILE NO_DATA2=0 DO -- W2
			
				select 'Test Enter Block',v_TrnCode;
				
			FETCH FROM cursor_two INTO v_Group, v_AccDr, v_AccCr, v_Prime, v_Base, v_currency, v_exchange;
			END WHILE; -- W2
			CLOSE cursor_two;
			
		end Block1;
				
	FETCH FROM cursor_one INTO v_TrnCode;
	END WHILE; -- W1
	CLOSE cursor_one;
END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_im_trn_dispatch` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_im_trn_dispatch` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_im_trn_dispatch`(
	p_id INT,
	p_username VARCHAR(50)
)
BEGIN
	DECLARE v_Id, v_Quantity INT;
	DECLARE v_ImTrnNumber,v_TransferNum,v_FromStore,v_ToStore,v_ProCode,v_Batch,v_Unit,v_FromCur VARCHAR(50);
	DECLARE v_ExpDate DATE;
	DECLARE v_Rate, v_ExchRate DECIMAL(20,5);
	
	DECLARE NO_DATA INT DEFAULT 0;
	
	DECLARE CurTransfer CURSOR FOR
	SELECT a.id,a.im_transfernum,b.im_fromstore,b.im_tostore,a.cm_code,a.im_BatchNumber,a.im_ExpDate,a.im_rate,a.im_quantity, 
				 a.im_unit, b.im_fcur, b.im_fexchrate
	FROM im_batchtransfer a 
	INNER JOIN im_transferhd b 
	ON a.im_transfernum=b.im_transfernum
	WHERE b.id=p_id AND b.im_status='Open';
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET NO_DATA=-2;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET NO_DATA=-1;
	OPEN CurTransfer;
	FETCH FROM CurTransfer INTO v_Id,v_TransferNum,v_FromStore,v_ToStore,v_ProCode,v_Batch,v_ExpDate,v_Rate,v_Quantity,v_Unit,v_FromCur,v_ExchRate;
	WHILE NO_DATA=0 DO -- 1
		SELECT Fu_GetTrn('Im Transaction','IT--',8,0) INTO v_ImTrnNumber; -- Issue Transfer
		INSERT INTO im_transaction -- Issue Item.
		(im_number,cm_code,im_storeid,im_BatchNumber,im_date,im_ExpireDate,im_quantity,im_sign,im_unit,im_rate,im_totalprice,im_basevalue,
		 im_RefNumber,im_RefRow,im_note,im_status,im_currency,im_ExchangeRate,inserttime,insertuser,im_foreignrate)
		VALUES
		(v_ImTrnNumber,v_ProCode,v_FromStore,v_Batch,CURRENT_DATE,v_ExpDate,v_Quantity,-1,v_Unit,v_Rate,v_Quantity*v_Rate,(v_Quantity*v_Rate),
		 v_TransferNum, v_Id,v_ToStore,'Open',v_FromCur,v_ExchRate,CURRENT_TIMESTAMP, p_username,v_Rate);
		 
	FETCH FROM CurTransfer INTO v_Id,v_TransferNum,v_FromStore,v_ToStore,v_ProCode,v_Batch,v_ExpDate,v_Rate,v_Quantity,v_Unit,v_FromCur,v_ExchRate;
	END WHILE;  -- 1
	CLOSE CurTransfer;
	
	UPDATE im_transferhd SET im_status='Dispatch' WHERE id=p_id;
	
END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_im_trn_receive` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_im_trn_receive` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_im_trn_receive`(
	p_id INT,
	p_username VARCHAR(50)
)
BEGIN
	DECLARE v_Id, v_Quantity INT;
	DECLARE v_ImTrnNumber, v_TransferNum, v_FromStore, v_ToStore, v_ProCode, v_Batch, v_Unit, v_Cur VARCHAR(50);
	DECLARE v_ExpDate DATE;
	DECLARE v_Rate, v_ExchRate DECIMAL(20,5);
	
	DECLARE NO_DATA INT DEFAULT 0;
	
	DECLARE CurTransfer CURSOR FOR
	SELECT a.id, a.im_transfernum,b.im_fromstore,b.im_tostore,a.cm_code,a.im_BatchNumber,a.im_ExpDate,a.im_rate,a.im_quantity, 
				 a.im_unit,b.im_tcur,b.im_texchrate
	FROM im_batchtransfer a 
	INNER JOIN im_transferhd b 
	ON a.im_transfernum=b.im_transfernum
	WHERE b.id=p_id AND b.im_status='Dispatch';
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET NO_DATA=-2;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET NO_DATA=-1;
	OPEN CurTransfer;
	FETCH	FROM CurTransfer INTO v_Id,v_TransferNum,v_FromStore,v_ToStore,v_ProCode,v_Batch,v_ExpDate,v_Rate,v_Quantity,v_Unit,v_Cur,v_ExchRate;
	WHILE NO_DATA=0 DO -- 1
		SELECT Fu_GetTrn('Im Transaction','RE--',8,0) INTO v_ImTrnNumber; -- Issue Transfer
		INSERT INTO im_transaction -- Issue Item.
		(im_number,cm_code,im_storeid,im_BatchNumber,im_date,im_ExpireDate,im_quantity,im_sign,im_unit,im_rate,im_totalprice,im_basevalue,
		 im_RefNumber,im_RefRow,im_note,im_status,im_currency,im_ExchangeRate,inserttime,insertuser,im_foreignrate)
		VALUES
		(v_ImTrnNumber,v_ProCode,v_ToStore,v_Batch,CURRENT_DATE,v_ExpDate,v_Quantity,1,v_Unit,v_Rate*v_ExchRate,v_Quantity*v_Rate,(v_Quantity*v_Rate)*v_ExchRate,
		 v_TransferNum, v_Id,v_FromStore,'Open',v_Cur,v_ExchRate, CURRENT_TIMESTAMP,p_username,v_Rate);
		 
	FETCH	FROM CurTransfer INTO v_Id,v_TransferNum,v_FromStore,v_ToStore,v_ProCode,v_Batch,v_ExpDate,v_Rate,v_Quantity,v_Unit,v_Cur,v_ExchRate;
	END WHILE;  -- 1
	CLOSE CurTransfer;
	
	UPDATE im_transferhd SET im_status='Received' WHERE id=p_id;
	
END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_pp_PoCreatebyRe` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_pp_PoCreatebyRe` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_pp_PoCreatebyRe`(
	pID INT,
	pUser VARCHAR(50)
)
BEGIN
	DECLARE v_ReqNo,v_SuppID,v_StoreID,v_Currency,v_ProCode,v_Unit,v_PoNumber VARCHAR(50);
	DECLARE v_CostPrice,v_ExchRate,v_RowAmt,v_Amount DECIMAL(20,5);
	DECLARE v_Qty,v_UnitQty INT;
		
	DECLARE NO_DATA INT DEFAULT 0;
	
	/*Requisition Header and Detail (product master and branch master) table join query*/
	DECLARE CurRequisition CURSOR FOR 
	SELECT a.pp_requisitionno,a.cm_supplierid,a.pp_branch,a.pp_currency,a.pp_exchrate,b.cm_code,c.cm_costprice,
		   b.pp_quantity,b.pp_unit,c.cm_purconfact,(c.cm_costprice*b.pp_quantity*c.cm_purconfact) AS rowamount
	FROM pp_requisitionhd a 
	INNER JOIN pp_requisitiondt b ON a.pp_requisitionno=b.pp_requisitionno
	INNER JOIN cm_productmaster c ON b.cm_code=c.cm_code
	WHERE a.pp_status='Open' AND a.id=pID;
	
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET NO_DATA=-2;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET NO_DATA=-1;
		
	/*Get the purchase order number from Function Get Trn. Which means Function get transaction number return auto number*/
	SELECT Fu_GetTrn('Purchase Order Number','PR--',8,0) INTO v_PoNumber;
	
	OPEN CurRequisition;
	FETCH FROM CurRequisition INTO v_ReqNo,v_SuppID,v_StoreID,v_Currency,v_ExchRate,v_ProCode,v_CostPrice,v_Qty,v_Unit,v_UnitQty,v_RowAmt;
	
	/*Insert Purchase order header*/
	INSERT INTO pp_purchaseordhd(pp_purordnum,pp_date,cm_supplierid,pp_requisitionno,pp_payterms,pp_deliverydate,pp_store,pp_taxrate,pp_taxamt,
								 pp_discrate,pp_discamt,pp_amount,pp_netamt,pp_status,pp_currency,pp_exchrate,inserttime,insertuser)
	VALUES(v_PoNumber,CURRENT_DATE,v_SuppID,v_ReqNo,'Cash',CURRENT_DATE,v_StoreID,0,0,0,0,0,0,'Open',v_Currency,v_ExchRate,CURRENT_TIMESTAMP,pUser);
	/**************END**************/
	
	WHILE NO_DATA=0 DO -- W1
		/*Start Insert Purchase Order Detail Table*/
		INSERT INTO pp_purchaseorddt(pp_purordnum,cm_code,pp_quantity,pp_grnqty,pp_unit,pp_unitqty,pp_purchasrate,inserttime,insertuser)
		VALUES(v_PoNumber,v_ProCode,v_Qty,0,v_Unit,v_UnitQty,v_CostPrice,CURRENT_TIMESTAMP,pUser);
		/************END****************/
		-- SET v_Amount=v_Amount+v_RowAmt;
		
	FETCH FROM CurRequisition INTO v_ReqNo,v_SuppID,v_StoreID,v_Currency,v_ExchRate,v_ProCode,v_CostPrice,v_Qty,v_Unit,v_UnitQty,v_RowAmt;
	END WHILE; -- W1
	
	UPDATE pp_requisitionhd a
	INNER JOIN pp_requisitiondt b ON a.pp_requisitionno=b.pp_requisitionno
	SET a.pp_status='PO Created',b.c_status='PO Created',a.pp_ponumber=v_PoNumber
	WHERE a.id=pID;
END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_sm_directsellconfirm` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_sm_directsellconfirm` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_sm_directsellconfirm`(
	pID int,
	pUser varchar(50)
)
begin
	Declare CusGroup, AR_AccCode, VAT_AccCode, Sales_AccCode, v_currency, v_voucher, v_smnumber, v_branch, v_cuscode varchar(50);
	Declare Total_Amount, VAT_Amount, Net_Amount decimal(20,2);
	Declare v_exchange decimal(20,5);
	Select b.cm_group,c.cm_acccode,c.cm_accdr as accsale,c.cm_acctax,a.sm_currency,sm_exchrate,
			sum(a.sm_totalamt),sum(a.sm_total_tax_amt),sum(a.sm_netamt),a.sm_number,a.sm_storeid,a.cm_cuscode
	into CusGroup,AR_AccCode,Sales_AccCode,VAT_AccCode,v_currency,v_exchange,
		 Total_Amount,VAT_Amount,Net_Amount,v_smnumber,v_branch,v_cuscode
	from sm_header a, cm_customermst b, cm_codesparam c
	where a.cm_cuscode=b.cm_cuscode
		and b.cm_group=c.cm_code
		and a.sm_doc_type='Sales'
		and a.sm_stataus='Open'
		and c.cm_type='Customer Group'
		and a.id=pID
	group by b.cm_group,c.cm_acccode,c.cm_accdr,c.cm_acctax;
	Select Fu_GetTrn('Voucher No','ARDR',8,0) INTO v_voucher;
	/*Create New Voucher Header*/
	Insert into am_vouhcerheader(am_vouchernumber,am_date,am_referance,am_year,am_period,am_branch,am_note,inserttime,insertuser)
	values(v_voucher,CURRENT_DATE,CONCAT('This Voucher for ',CusGroup),Fu_Year(CURRENT_DATE),Fu_Period(CURRENT_DATE),v_Branch,
				 CONCAT('Create from Direct Sales No ',v_smnumber),CURRENT_TIMESTAMP,pUser);
	/*Insert Acount receiveable*/
	Insert into am_voucherdetail(am_vouchernumber,am_accountcode,am_subacccode,am_currency,am_exchagerate,am_primeamt,am_baseamt,am_branch,am_note,inserttime,insertuser)
	values(v_voucher,AR_AccCode,v_cuscode,v_currency,v_exchange,Net_Amount,v_exchange*Net_Amount,v_branch,'Account Receivable',CURRENT_TIMESTAMP,pUser);
	IF VAT_Amount<>0 THEN -- f1
		/*'Insert Tax amount as Credit'*/
		Insert into am_voucherdetail(am_vouchernumber,am_accountcode,am_subacccode,am_currency,am_exchagerate,am_primeamt,am_baseamt,am_branch,am_note,inserttime,insertuser)
		Values(v_voucher,VAT_AccCode,'',v_currency,v_exchange,0-VAT_Amount,0-(v_exchange*VAT_Amount),v_branch,'VAT',CURRENT_TIMESTAMP,pUser);
	END IF; -- f1
	/*Insert Acount Sales or Revenue*/
	Insert into am_voucherdetail(am_vouchernumber,am_accountcode,am_subacccode,am_currency,am_exchagerate,am_primeamt,am_baseamt,am_branch,am_note,inserttime,insertuser)
	values(v_voucher,Sales_AccCode,'',v_currency,v_exchange,0-Total_Amount,0-(v_exchange*Total_Amount),v_branch,'Sales',CURRENT_TIMESTAMP,pUser);
	update sm_header set sm_stataus='Confirmed', glvoucher=v_voucher where id=pID;
	CALL sp_am_voucherpost(v_voucher,pUser);
	
end */$$
DELIMITER ;

/* Procedure structure for procedure `sp_sm_doconfirm` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_sm_doconfirm` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_sm_doconfirm`(
	pID INT,
	pUser VARCHAR(10)
)
BEGIN
	DECLARE v_smnumber,v_cuscode,v_gcus,v_accar,v_accdisc,v_acctax,v_Branch,v_currency,v_voucher,v_gprod,v_accsell VARCHAR(50);
	DECLARE v_amtdisc,v_amttax,v_amtnet,v_amttot DECIMAL(20,2);
	DECLARE v_exchange DECIMAL(20,5);
	DECLARE NO_DATA INT DEFAULT 0;
	
	DECLARE cur_smheader CURSOR FOR /*Account Receivable debit.Discount Debit,Tax Credit */
	SELECT a.sm_number, b.cm_group,c.cm_acccode,c.cm_accdisc,c.cm_acctax,
				 SUM(a.sm_disc_amt),SUM(a.sm_total_tax_amt),SUM(a.sm_netamt),a.sm_storeid,a.sm_currency,a.sm_exchrate,a.cm_cuscode
	FROM sm_header a, cm_customermst b, cm_codesparam c
	WHERE c.cm_type='Customer Group' 
				AND b.cm_group=c.cm_code 
				AND a.cm_cuscode=b.cm_cuscode
				AND a.sm_doc_type='Sales'
				AND a.id=pID
				AND a.sm_stataus='Open'
	GROUP BY b.cm_group,c.cm_acccode,c.cm_accdisc,c.cm_acctax;
	DECLARE cur_smdetail CURSOR FOR /*Sales credit*/
	SELECT c.cm_category,d.cm_acccode,SUM(b.sm_lineamt)
	FROM sm_header a, sm_detail b, cm_productmaster c, cm_codesparam d
	WHERE a.sm_number=b.sm_number
				AND a.sm_doc_type='Sales'
				AND b.cm_code=c.cm_code
				AND c.cm_category=d.cm_code
				AND d.cm_type='Product Category'
				AND a.id=pID
				AND a.sm_stataus='Open'
	GROUP BY c.cm_group,d.cm_acccode;
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET NO_DATA=-2;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET NO_DATA=-1;
	
	OPEN cur_smheader;
	FETCH cur_smheader INTO v_smnumber,v_gcus,v_accar,v_accdisc,v_acctax,v_amtdisc,v_amttax,v_amtnet,v_Branch,v_currency,v_exchange,v_cuscode;
		SELECT Fu_GetTrn('Voucher No','AR--',8,0) INTO v_voucher;
		/*Create New Voucher Header*/
		INSERT INTO am_vouhcerheader(am_vouchernumber,am_date,am_referance,am_year,am_period,am_branch,am_note,inserttime,insertuser)
		VALUES(v_voucher,CURRENT_DATE,CONCAT('This Voucher for ',v_gcus),Fu_Year(CURRENT_DATE),Fu_Period(CURRENT_DATE),v_Branch,
					 CONCAT('Create from Sales Invoice No ',v_smnumber),CURRENT_TIMESTAMP,pUser);
		/*Insert Acount receiveable*/
		INSERT INTO am_voucherdetail(am_vouchernumber,am_accountcode,am_subacccode,am_currency,am_exchagerate,am_primeamt,am_baseamt,am_branch,am_note,inserttime,insertuser)
		VALUES(v_voucher,v_accar,v_cuscode,v_currency,v_exchange,v_amtnet,v_exchange*v_amtnet,v_Branch,'Account Receivable',CURRENT_TIMESTAMP,pUser);
		
		IF v_amtdisc<>0 THEN -- f1
			/*'Insert Discount amount as debit'*/
			INSERT INTO am_voucherdetail(am_vouchernumber,am_accountcode,am_subacccode,am_currency,am_exchagerate,am_primeamt,am_baseamt,am_branch,am_note,inserttime,insertuser)
			VALUES(v_voucher,v_accdisc,'',v_currency,v_exchange,v_amtdisc,v_exchange*v_amtdisc,v_Branch,'Discount',CURRENT_TIMESTAMP,pUser);
		END IF; -- f1
		
		IF v_amttax<>0 THEN -- f2
			/*'Insert Tax amount as Credit'*/
			INSERT INTO am_voucherdetail(am_vouchernumber,am_accountcode,am_subacccode,am_currency,am_exchagerate,am_primeamt,am_baseamt,am_branch,am_note,inserttime,insertuser)
			VALUES(v_voucher,v_acctax,'',v_currency,v_exchange,0-v_amttax,0-(v_exchange*v_amttax),v_Branch,'Tax',CURRENT_TIMESTAMP,pUser);
		END IF; -- f2
		CLOSE cur_smheader;
		
		OPEN cur_smdetail;
		FETCH FROM cur_smdetail INTO v_gprod, v_accsell, v_amttot;
		WHILE NO_DATA=0 DO -- W2
			/*Insert sales as credit*/
			INSERT INTO am_voucherdetail(am_vouchernumber,am_accountcode,am_subacccode,am_currency,am_exchagerate,am_primeamt,am_baseamt,am_branch,am_note,inserttime,insertuser)
			VALUES(v_voucher,v_accsell,'',v_currency,v_exchange,0-v_amttot,0-(v_exchange*v_amttot),v_Branch,CONCAT('Sales by ',v_gprod),CURRENT_TIMESTAMP,pUser);
			
		FETCH FROM cur_smdetail INTO v_gprod, v_accsell, v_amttot;
		END WHILE; -- W2
		CLOSE cur_smdetail;
		UPDATE sm_header SET glvoucher=v_voucher,sm_stataus='Confirmed'	WHERE id=pID;
		
		CALL sp_am_voucherpost(v_voucher,pUser);
END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_sm_mrtogl` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_sm_mrtogl` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_sm_mrtogl`(
	pID INT,
	pUser VARCHAR(10)
)
BEGIN
	DECLARE v_gcus,v_accdr,v_acccr,v_Branch,v_currency,v_voucher,v_cuscode VARCHAR(50);
	DECLARE v_amtnet DECIMAL(20,2);
	DECLARE v_exchange DECIMAL(20,5);
	
	DECLARE NO_DATA INT DEFAULT 0;
	DECLARE cur_mrct CURSOR FOR
	SELECT b.cm_group,a.am_accountcode,c.cm_acccode,SUM(a.sm_netamt),a.sm_currency,a.sm_exchrate,a.sm_storeid,a.cm_cuscode
	FROM sm_header a, cm_customermst b, cm_codesparam c
	WHERE a.cm_cuscode=b.cm_cuscode
		AND c.cm_type='Customer Group'
		AND b.cm_group=c.cm_code
		AND a.sm_doc_type='Receipt'
		AND id=pID;
	
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET NO_DATA=-2;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET NO_DATA=-1;
	
	OPEN cur_mrct;
	FETCH FROM cur_mrct INTO v_gcus,v_accdr,v_acccr,v_amtnet, v_currency, v_exchange, v_Branch, v_cuscode;
	
		SELECT Fu_GetTrn('Voucher No','MR--',8,0) INTO v_voucher;
		/*Create New Voucher Header*/
		INSERT INTO am_vouhcerheader(am_vouchernumber,am_date,am_referance,am_year,am_period,am_branch,am_note,inserttime,insertuser)
		VALUES(v_voucher,CURRENT_DATE,CONCAT('This Voucher for ',v_gcus),Fu_Year(CURRENT_DATE),Fu_Period(CURRENT_DATE),v_Branch,
					 'This is Money Receipt',CURRENT_TIMESTAMP,pUser);
		/*Insert debit account*/
		INSERT INTO am_voucherdetail(am_vouchernumber,am_accountcode,am_subacccode,am_currency,am_exchagerate,am_primeamt,am_baseamt,am_branch,am_note,inserttime,insertuser)
		VALUES(v_voucher,v_accdr,'',v_currency,v_exchange,v_amtnet,v_exchange*v_amtnet,v_Branch,'Cash/Bank',CURRENT_TIMESTAMP,pUser);
		
		/*Insert credit account*/
		INSERT INTO am_voucherdetail(am_vouchernumber,am_accountcode,am_subacccode,am_currency,am_exchagerate,am_primeamt,am_baseamt,am_branch,am_note,inserttime,insertuser)
		VALUES(v_voucher,v_acccr,v_cuscode,v_currency,v_exchange,0-v_amtnet,0-(v_exchange*v_amtnet),v_Branch,'Account Receivable',CURRENT_TIMESTAMP,pUser);
	
		UPDATE sm_header SET glvoucher=v_voucher, sm_stataus='Confirmed' WHERE id=pID;
		
		CALL sp_am_voucherpost(v_voucher,pUser);
		
	CLOSE cur_mrct;
END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_sm_orddeliverd` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_sm_orddeliverd` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_sm_orddeliverd`(
	p_id INT,
	p_user VARCHAR(50)
)
BEGIN
	DECLARE v_smnumber,v_cuscode,v_procode,v_storeid,v_batch,v_unit,v_currency,v_ImNumber,v_imvoucher VARCHAR(50);
	DECLARE v_expdate DATE;
	DECLARE v_boqty,v_qty,v_sign INT;
	DECLARE v_rate,v_value,v_exchange DECIMAL(20,5);
	
	DECLARE NO_DATA INT DEFAULT 0;
	
	DECLARE CursorOne CURSOR FOR
	SELECT a.sm_number,c.cm_name,b.cm_code,a.sm_storeid,b.sm_batchnumber,
				 b.sm_expdate,b.sm_unit,IFNULL(b.sm_bonusqty,0),b.sm_quantity,b.sm_rate,-1,
				 b.sm_currency,b.sm_exchrate
	FROM sm_header a
	INNER JOIN sm_batchsale b ON a.sm_number=b.sm_number
	INNER JOIN cm_customermst c ON a.cm_cuscode=c.cm_cuscode
	WHERE a.id=p_id AND a.sm_doc_type='Sales' AND a.sm_stataus='Confirmed';	
	
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET NO_DATA=-2;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET NO_DATA=-1;
	
	OPEN CursorOne;
	FETCH FROM CursorOne INTO v_smnumber,v_cuscode,v_procode,v_storeid,v_batch,v_expdate,v_unit,v_boqty,v_qty,v_rate,v_sign,v_currency,v_exchange;
	WHILE NO_DATA=0 DO -- W1
		
		/*Insert into im_transaction table as sales issue*/	
		SELECT Fu_GetTrn('Im Transaction','DO--',8,0) INTO v_ImNumber;
		SELECT v_ImNumber,v_smnumber,v_cuscode,v_procode,v_storeid,v_batch,v_expdate,v_unit,v_boqty,v_qty,v_rate,v_sign,v_currency,v_exchange;
		
		INSERT INTO im_transaction(im_number,cm_code,im_storeid,im_BatchNumber,im_date,im_ExpireDate,
															 im_quantity,im_sign,im_unit,im_rate,
															 im_totalprice,im_basevalue,im_RefNumber,im_RefRow,
															 im_note,im_status,cm_supplierid,im_currency,im_ExchangeRate,
															 inserttime,insertuser,im_foreignrate)
		VALUE(v_ImNumber,v_procode,v_storeid,v_batch,CURRENT_DATE,v_expdate,
				  v_qty,v_sign,v_unit,v_rate,
				  (v_qty*v_rate),(v_qty*v_rate),v_smnumber,0,
				  v_cuscode,'Open',v_cuscode,v_currency,v_exchange,
				  CURRENT_TIMESTAMP,p_user,v_rate);
		
		IF v_boqty>0 THEN -- IF 1
			SELECT Fu_GetTrn('Im Transaction','BO--',8,0) INTO v_ImNumber;
			INSERT INTO im_transaction(im_number,cm_code,im_storeid,im_BatchNumber,im_date,im_ExpireDate,im_quantity,im_sign,im_unit,im_rate,
																 im_totalprice,im_basevalue,im_RefNumber,im_RefRow,
																 im_note,im_status,cm_supplierid,im_currency,im_ExchangeRate,inserttime,insertuser,im_foreignrate)
			VALUE(v_ImNumber,v_procode,v_storeid,v_batch,CURRENT_DATE,v_expdate,v_boqty,v_sign,v_unit,v_rate,(v_boqty*v_rate),(v_boqty*v_rate),v_smnumber,0,
						v_cuscode,'Open',v_cuscode,v_currency,v_exchange,CURRENT_TIMESTAMP,p_user,v_rate);
		END IF; -- IF 1
	
	FETCH FROM CursorOne INTO v_smnumber,v_cuscode,v_procode,v_storeid,v_batch,v_expdate,v_unit,v_boqty,v_qty,v_rate,v_sign,v_currency,v_exchange;
	END WHILE; -- W1
	CLOSE CursorOne;
	
	CALL sp_im_imtoglpost('DO--',v_smnumber,p_user,v_imvoucher);
	
	UPDATE sm_header 
	SET sm_stataus='Delivered', updatetime=CURRENT_TIMESTAMP, updateuser=p_user, imvoucher=v_imvoucher
	WHERE id=p_id;
	
END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_sm_ordreturn` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_sm_ordreturn` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_sm_ordreturn`(
	p_id INT,
	p_user VARCHAR(20)
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
		   b.sm_expdate,b.sm_unit,IFNULL(b.sm_bonusqty,0),b.sm_quantity,
		   b.sm_rate,a.sm_currency,a.sm_exchrate,1
	FROM sm_header a
	INNER JOIN sm_batchsale b ON a.sm_number=b.sm_number
	WHERE a.id=p_id AND a.sm_doc_type='Return';	
	
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET NO_DATA=-2;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET NO_DATA=-1;
	
	OPEN CursorOne;
	FETCH FROM CursorOne INTO v_smnumber,v_cuscode,v_procode,v_storeid,v_batch,v_expdate,v_unit,v_boqty,v_qty,v_rate,v_currency,v_exchange,v_sign;
	WHILE NO_DATA=0 DO -- W1
			
		/*Insert into im_transaction table as sales issue*/	
		SELECT Fu_GetTrn('Im Transaction','SR--',8,0) INTO v_ImNumber;
		
		INSERT INTO im_transaction(im_number,cm_code,im_storeid,im_BatchNumber,im_date,im_ExpireDate,im_quantity,im_sign,im_unit,im_rate,
					im_totalprice,im_RefNumber,im_RefRow,im_note,im_status,cm_supplierid,im_currency,im_ExchangeRate,
					inserttime,insertuser)
		VALUE(v_ImNumber,v_procode,v_storeid,v_batch,CURRENT_DATE,v_expdate,v_qty,v_sign,v_unit,v_rate,(v_qty*v_rate),v_smnumber,0,
				  'Item was sell by sales module','Open',v_cuscode,v_currency,v_exchange,CURRENT_TIMESTAMP,p_user);
		
		IF v_boqty>0 THEN -- IF 1
			SELECT Fu_GetTrn('Im Transaction','BR--',8,0) INTO v_ImNumber;
			INSERT INTO im_transaction(im_number,cm_code,im_storeid,im_BatchNumber,im_date,im_ExpireDate,im_quantity,im_sign,im_unit,im_rate,
																 im_totalprice,im_RefNumber,im_RefRow,im_note,im_status,cm_supplierid,im_currency,im_ExchangeRate,
																 inserttime,insertuser)
			VALUE(v_ImNumber,v_procode,v_storeid,v_batch,CURRENT_DATE,v_expdate,v_boqty,v_sign,v_unit,v_rate,(v_boqty*v_rate),v_smnumber,0,
						'Item was sell by sales module','Open',v_cuscode,v_currency,v_exchange,CURRENT_TIMESTAMP,p_user);
		END IF; -- IF 1
	
	FETCH FROM CursorOne INTO v_smnumber,v_cuscode,v_procode,v_storeid,v_batch,v_expdate,v_unit,v_boqty,v_qty,v_rate,v_currency,v_exchange,v_sign;
	END WHILE; -- W1
	CLOSE CursorOne;
	
	UPDATE sm_header SET sm_status='Returned', updatetime=CURRENT_TIMESTAMP, updateuser=p_user WHERE id=p_id;
END */$$
DELIMITER ;

/*Table structure for table `am_vw_apayable` */

DROP TABLE IF EXISTS `am_vw_apayable`;

/*!50001 DROP VIEW IF EXISTS `am_vw_apayable` */;
/*!50001 DROP TABLE IF EXISTS `am_vw_apayable` */;

/*!50001 CREATE TABLE  `am_vw_apayable`(
 `suppliercode` varchar(50) ,
 `suppliername` varchar(100) ,
 `branch` varchar(50) ,
 `accoutcode` varchar(50) ,
 `description` varchar(100) ,
 `conperson` varchar(100) ,
 `payableamt` decimal(42,2) 
)*/;

/*Table structure for table `am_vw_chartofacc` */

DROP TABLE IF EXISTS `am_vw_chartofacc`;

/*!50001 DROP VIEW IF EXISTS `am_vw_chartofacc` */;
/*!50001 DROP TABLE IF EXISTS `am_vw_chartofacc` */;

/*!50001 CREATE TABLE  `am_vw_chartofacc`(
 `id` int(11) ,
 `am_accounttype` varchar(50) ,
 `Group_One` varchar(101) ,
 `Group_Two` varchar(101) ,
 `Group_Three` varchar(101) ,
 `Group_Four` varchar(101) ,
 `am_accountcode` varchar(50) ,
 `am_description` varchar(100) ,
 `am_accountusage` varchar(50) ,
 `am_analyticalcode` varchar(10) ,
 `am_status` varchar(50) 
)*/;

/*Table structure for table `am_vw_gltrn` */

DROP TABLE IF EXISTS `am_vw_gltrn`;

/*!50001 DROP VIEW IF EXISTS `am_vw_gltrn` */;
/*!50001 DROP TABLE IF EXISTS `am_vw_gltrn` */;

/*!50001 CREATE TABLE  `am_vw_gltrn`(
 `am_vouchernumber` varchar(50) ,
 `am_referance` varchar(150) ,
 `am_date` date ,
 `am_year` int(11) ,
 `am_period` int(11) ,
 `am_branch` varchar(50) ,
 `am_accountcode` varchar(50) ,
 `am_description` varchar(100) ,
 `debit` decimal(20,5) ,
 `credit` decimal(20,5) 
)*/;

/*Table structure for table `am_vw_payinvc` */

DROP TABLE IF EXISTS `am_vw_payinvc`;

/*!50001 DROP VIEW IF EXISTS `am_vw_payinvc` */;
/*!50001 DROP TABLE IF EXISTS `am_vw_payinvc` */;

/*!50001 CREATE TABLE  `am_vw_payinvc`(
 `suppliercode` varchar(50) ,
 `invoicnumber` varchar(50) ,
 `date` date ,
 `branch` varchar(50) ,
 `currency` varchar(20) ,
 `exchange` decimal(23,5) ,
 `primaamt` decimal(20,2) ,
 `amount` decimal(23,5) 
)*/;

/*Table structure for table `am_vw_unpaidinv` */

DROP TABLE IF EXISTS `am_vw_unpaidinv`;

/*!50001 DROP VIEW IF EXISTS `am_vw_unpaidinv` */;
/*!50001 DROP TABLE IF EXISTS `am_vw_unpaidinv` */;

/*!50001 CREATE TABLE  `am_vw_unpaidinv`(
 `suppliercode` varchar(50) ,
 `invoicnumber` varchar(50) ,
 `date` date ,
 `branch` varchar(50) ,
 `currency` varchar(20) ,
 `exchange` decimal(23,5) ,
 `primaamt` decimal(45,5) ,
 `amount` decimal(42,2) 
)*/;

/*Table structure for table `am_vw_voucher` */

DROP TABLE IF EXISTS `am_vw_voucher`;

/*!50001 DROP VIEW IF EXISTS `am_vw_voucher` */;
/*!50001 DROP TABLE IF EXISTS `am_vw_voucher` */;

/*!50001 CREATE TABLE  `am_vw_voucher`(
 `am_vouchernumber` varchar(50) ,
 `am_accountcode` varchar(50) ,
 `am_description` varchar(100) ,
 `am_subacccode` varchar(50) ,
 `am_currency` varchar(10) ,
 `am_exchagerate` decimal(20,5) ,
 `prime_debit` decimal(20,2) ,
 `prime_credit` decimal(20,2) ,
 `base_debit` decimal(20,5) ,
 `base_credit` decimal(20,5) 
)*/;

/*Table structure for table `ap_vw_invsupplier` */

DROP TABLE IF EXISTS `ap_vw_invsupplier`;

/*!50001 DROP VIEW IF EXISTS `ap_vw_invsupplier` */;
/*!50001 DROP TABLE IF EXISTS `ap_vw_invsupplier` */;

/*!50001 CREATE TABLE  `ap_vw_invsupplier`(
 `am_subacccode` varchar(50) ,
 `cm_orgname` varchar(100) ,
 `paidvoucherno` varchar(50) ,
 `am_vouchernumber` varchar(50) ,
 `am_date` date ,
 `am_branch` varchar(50) ,
 `am_currency` varchar(20) ,
 `am_exchagerate` decimal(23,5) ,
 `am_primeamt` decimal(20,2) ,
 `am_baseamt` decimal(23,5) 
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

/*Table structure for table `im_vw_postimtogl` */

DROP TABLE IF EXISTS `im_vw_postimtogl`;

/*!50001 DROP VIEW IF EXISTS `im_vw_postimtogl` */;
/*!50001 DROP TABLE IF EXISTS `im_vw_postimtogl` */;

/*!50001 CREATE TABLE  `im_vw_postimtogl`(
 `im_number` varchar(50) ,
 `im_storeid` varchar(50) ,
 `im_date` date ,
 `cm_code` varchar(50) ,
 `cm_name` varchar(200) ,
 `im_currency` varchar(50) ,
 `im_ExchangeRate` decimal(20,5) ,
 `im_quantity` int(11) ,
 `im_totalprice` decimal(20,2) ,
 `im_basevalue` decimal(20,5) ,
 `im_status` varchar(50) ,
 `im_voucherno` varchar(50) 
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
 `pp_totalamount` decimal(40,0) 
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
 `cm_sellrate` decimal(20,2) ,
 `cm_selltax` decimal(20,2) ,
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
 `cm_branch` varchar(20) ,
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
 `sm_branch` varchar(20) ,
 `sm_sign` int(11) ,
 `sm_currency` varchar(50) ,
 `sm_exchrate` decimal(20,5) ,
 `sm_rcvamt` decimal(20,2) 
)*/;

/*Table structure for table `sm_vw_mrrcv` */

DROP TABLE IF EXISTS `sm_vw_mrrcv`;

/*!50001 DROP VIEW IF EXISTS `sm_vw_mrrcv` */;
/*!50001 DROP TABLE IF EXISTS `sm_vw_mrrcv` */;

/*!50001 CREATE TABLE  `sm_vw_mrrcv`(
 `sm_invnumber` varchar(20) ,
 `cm_cuscode` varchar(20) ,
 `sm_branch` varchar(20) ,
 `sm_currency` varchar(50) ,
 `sm_exchrate` decimal(20,5) ,
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

/*Table structure for table `sm_vw_sm_batchsale` */

DROP TABLE IF EXISTS `sm_vw_sm_batchsale`;

/*!50001 DROP VIEW IF EXISTS `sm_vw_sm_batchsale` */;
/*!50001 DROP TABLE IF EXISTS `sm_vw_sm_batchsale` */;

/*!50001 CREATE TABLE  `sm_vw_sm_batchsale`(
 `sm_number` varchar(50) ,
 `cm_code` varchar(50) ,
 `cm_name` varchar(200) ,
 `sm_batchnumber` varchar(50) ,
 `sm_expdate` date ,
 `sm_unit` varchar(20) ,
 `sm_sellrate` decimal(20,2) ,
 `sm_rate` decimal(20,2) ,
 `sm_quantity` decimal(42,0) ,
 `sm_tax_rate` decimal(20,2) ,
 `sm_line_amt` decimal(62,2) 
)*/;

/*View structure for view am_vw_apayable */

/*!50001 DROP TABLE IF EXISTS `am_vw_apayable` */;
/*!50001 DROP VIEW IF EXISTS `am_vw_apayable` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `am_vw_apayable` AS select `a`.`am_subacccode` AS `suppliercode`,`b`.`cm_orgname` AS `suppliername`,`c`.`am_branch` AS `branch`,`a`.`am_accountcode` AS `accoutcode`,`d`.`am_description` AS `description`,`b`.`cm_contactperson` AS `conperson`,abs(sum(`a`.`am_primeamt`)) AS `payableamt` from (((`am_voucherdetail` `a` join `cm_suppliermaster` `b` on((`a`.`am_subacccode` = `b`.`cm_supplierid`))) join `am_vouhcerheader` `c` on((`c`.`am_vouchernumber` = `a`.`am_vouchernumber`))) join `am_chartofaccounts` `d` on((`d`.`am_accountcode` = `a`.`am_accountcode`))) group by `a`.`am_subacccode`,`c`.`am_branch` */;

/*View structure for view am_vw_chartofacc */

/*!50001 DROP TABLE IF EXISTS `am_vw_chartofacc` */;
/*!50001 DROP VIEW IF EXISTS `am_vw_chartofacc` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `am_vw_chartofacc` AS select `a`.`id` AS `id`,`a`.`am_accounttype` AS `am_accounttype`,concat(`b`.`am_groupone`,'-',`b`.`am_description`) AS `Group_One`,ifnull(concat(`c`.`am_grouptwo`,'-',`c`.`am_description`),'') AS `Group_Two`,ifnull(concat(`d`.`am_groupthree`,'-',`d`.`am_description`),'') AS `Group_Three`,ifnull(concat(`e`.`am_groupfour`,'-',`e`.`am_description`),'') AS `Group_Four`,`a`.`am_accountcode` AS `am_accountcode`,`a`.`am_description` AS `am_description`,`a`.`am_accountusage` AS `am_accountusage`,`a`.`am_analyticalcode` AS `am_analyticalcode`,`a`.`am_status` AS `am_status` from ((((`am_chartofaccounts` `a` left join `am_group_one` `b` on((`a`.`am_groupone` = `b`.`am_groupone`))) left join `am_group_two` `c` on(((`b`.`am_groupone` = `c`.`am_groupone`) and (`a`.`am_grouptwo` = `c`.`am_grouptwo`)))) left join `am_group_three` `d` on(((`b`.`am_groupone` = `d`.`am_groupone`) and (`c`.`am_grouptwo` = `d`.`am_grouptwo`) and (`a`.`am_groupthree` = `d`.`am_groupthree`)))) left join `am_group_four` `e` on(((`b`.`am_groupone` = `e`.`am_groupone`) and (`c`.`am_grouptwo` = `e`.`am_grouptwo`) and (`d`.`am_groupthree` = `e`.`am_groupthree`) and (`a`.`am_groupfour` = `e`.`am_groupfour`)))) */;

/*View structure for view am_vw_gltrn */

/*!50001 DROP TABLE IF EXISTS `am_vw_gltrn` */;
/*!50001 DROP VIEW IF EXISTS `am_vw_gltrn` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `am_vw_gltrn` AS select `a`.`am_vouchernumber` AS `am_vouchernumber`,`c`.`am_referance` AS `am_referance`,`c`.`am_date` AS `am_date`,`c`.`am_year` AS `am_year`,`c`.`am_period` AS `am_period`,`c`.`am_branch` AS `am_branch`,`a`.`am_accountcode` AS `am_accountcode`,`b`.`am_description` AS `am_description`,(case when (`a`.`am_baseamt` > 0) then `a`.`am_baseamt` end) AS `debit`,(case when (`a`.`am_baseamt` < 0) then abs(`a`.`am_baseamt`) end) AS `credit` from ((`am_voucherdetail` `a` join `am_chartofaccounts` `b`) join `am_vouhcerheader` `c`) where ((`a`.`am_accountcode` = `b`.`am_accountcode`) and (`a`.`am_vouchernumber` = `c`.`am_vouchernumber`)) */;

/*View structure for view am_vw_payinvc */

/*!50001 DROP TABLE IF EXISTS `am_vw_payinvc` */;
/*!50001 DROP VIEW IF EXISTS `am_vw_payinvc` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `am_vw_payinvc` AS select `a`.`am_subacccode` AS `suppliercode`,`a`.`am_vouchernumber` AS `invoicnumber`,`f`.`am_date` AS `date`,`f`.`am_branch` AS `branch`,`a`.`am_currency` AS `currency`,`a`.`am_exchagerate` AS `exchange`,`a`.`am_primeamt` AS `primaamt`,`a`.`am_baseamt` AS `amount` from ((`am_voucherdetail` `a` join `cm_suppliermaster` `b` on(((`a`.`am_subacccode` = `b`.`cm_supplierid`) and (left(`a`.`am_vouchernumber`,4) = 'AP--')))) join `am_vouhcerheader` `f` on((`f`.`am_vouchernumber` = `a`.`am_vouchernumber`))) union all select `d`.`am_subacccode` AS `am_subacccode`,`c`.`am_invnumber` AS `am_invnumber`,`g`.`am_date` AS `am_date`,`g`.`am_branch` AS `am_branch`,`c`.`am_currency` AS `am_currency`,`c`.`am_exchagerate` AS `am_exchagerate`,`c`.`am_primeamt` AS `am_primeamt`,`c`.`am_amount` AS `am_amount` from (((`am_apalc` `c` join `am_voucherdetail` `d` on((`c`.`am_vouchernumber` = `d`.`am_vouchernumber`))) join `am_vouhcerheader` `g` on((`g`.`am_vouchernumber` = `d`.`am_vouchernumber`))) join `cm_suppliermaster` `e` on((`d`.`am_subacccode` = `e`.`cm_supplierid`))) */;

/*View structure for view am_vw_unpaidinv */

/*!50001 DROP TABLE IF EXISTS `am_vw_unpaidinv` */;
/*!50001 DROP VIEW IF EXISTS `am_vw_unpaidinv` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `am_vw_unpaidinv` AS select `am_vw_payinvc`.`suppliercode` AS `suppliercode`,`am_vw_payinvc`.`invoicnumber` AS `invoicnumber`,`am_vw_payinvc`.`date` AS `date`,`am_vw_payinvc`.`branch` AS `branch`,`am_vw_payinvc`.`currency` AS `currency`,`am_vw_payinvc`.`exchange` AS `exchange`,abs(sum(`am_vw_payinvc`.`amount`)) AS `primaamt`,abs(sum(`am_vw_payinvc`.`primaamt`)) AS `amount` from `am_vw_payinvc` group by `am_vw_payinvc`.`suppliercode`,`am_vw_payinvc`.`invoicnumber`,`am_vw_payinvc`.`branch` having (abs(sum(`am_vw_payinvc`.`primaamt`)) > 0) */;

/*View structure for view am_vw_voucher */

/*!50001 DROP TABLE IF EXISTS `am_vw_voucher` */;
/*!50001 DROP VIEW IF EXISTS `am_vw_voucher` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `am_vw_voucher` AS select `a`.`am_vouchernumber` AS `am_vouchernumber`,`a`.`am_accountcode` AS `am_accountcode`,`b`.`am_description` AS `am_description`,`a`.`am_subacccode` AS `am_subacccode`,`a`.`am_currency` AS `am_currency`,`a`.`am_exchagerate` AS `am_exchagerate`,(case when (`a`.`am_primeamt` > 0) then `a`.`am_primeamt` end) AS `prime_debit`,(case when (`a`.`am_primeamt` < 0) then abs(`a`.`am_primeamt`) end) AS `prime_credit`,(case when (`a`.`am_baseamt` > 0) then `a`.`am_baseamt` end) AS `base_debit`,(case when (`a`.`am_baseamt` < 0) then abs(`a`.`am_baseamt`) end) AS `base_credit` from (`am_voucherdetail` `a` join `am_chartofaccounts` `b` on((`a`.`am_accountcode` = `b`.`am_accountcode`))) */;

/*View structure for view ap_vw_invsupplier */

/*!50001 DROP TABLE IF EXISTS `ap_vw_invsupplier` */;
/*!50001 DROP VIEW IF EXISTS `ap_vw_invsupplier` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ap_vw_invsupplier` AS select `a`.`am_subacccode` AS `am_subacccode`,`b`.`cm_orgname` AS `cm_orgname`,'' AS `paidvoucherno`,`a`.`am_vouchernumber` AS `am_vouchernumber`,`f`.`am_date` AS `am_date`,`f`.`am_branch` AS `am_branch`,`a`.`am_currency` AS `am_currency`,`a`.`am_exchagerate` AS `am_exchagerate`,`a`.`am_primeamt` AS `am_primeamt`,`a`.`am_baseamt` AS `am_baseamt` from ((`am_voucherdetail` `a` join `cm_suppliermaster` `b` on(((`a`.`am_subacccode` = `b`.`cm_supplierid`) and (left(`a`.`am_vouchernumber`,4) = 'AP--')))) join `am_vouhcerheader` `f` on((`f`.`am_vouchernumber` = `a`.`am_vouchernumber`))) union all select `d`.`am_subacccode` AS `am_subacccode`,`e`.`cm_orgname` AS `cm_orgname`,`c`.`am_vouchernumber` AS `am_vouchernumber`,`c`.`am_invnumber` AS `am_invnumber`,`c`.`am_date` AS `am_date`,`g`.`am_branch` AS `am_branch`,`c`.`am_currency` AS `am_currency`,`c`.`am_exchagerate` AS `am_exchagerate`,`c`.`am_primeamt` AS `am_primeamt`,`c`.`am_amount` AS `am_amount` from (((`am_apalc` `c` join `am_voucherdetail` `d` on((`c`.`am_vouchernumber` = `d`.`am_vouchernumber`))) join `am_vouhcerheader` `g` on((`g`.`am_vouchernumber` = `d`.`am_vouchernumber`))) join `cm_suppliermaster` `e` on((`d`.`am_subacccode` = `e`.`cm_supplierid`))) */;

/*View structure for view im_vw_grndetail */

/*!50001 DROP TABLE IF EXISTS `im_vw_grndetail` */;
/*!50001 DROP VIEW IF EXISTS `im_vw_grndetail` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `im_vw_grndetail` AS select `a`.`id` AS `id`,`a`.`im_grnnumber` AS `im_grnnumber`,`c`.`im_purordnum` AS `im_purordnum`,`a`.`cm_code` AS `cm_code`,`b`.`cm_name` AS `cm_name`,`a`.`im_BatchNumber` AS `im_BatchNumber`,`a`.`im_ExpireDate` AS `im_ExpireDate`,`a`.`im_RcvQuantity` AS `im_RcvQuantity`,`a`.`im_costprice` AS `im_costprice`,`a`.`im_unit` AS `im_unit`,`a`.`im_unitqty` AS `im_unitqty`,`a`.`im_rowamount` AS `im_rowamount` from ((`im_grndetail` `a` join `cm_productmaster` `b` on((convert(`a`.`cm_code` using utf8) = `b`.`cm_code`))) join `im_grnheader` `c` on((`a`.`im_grnnumber` = `c`.`im_grnnumber`))) */;

/*View structure for view im_vw_postimtogl */

/*!50001 DROP TABLE IF EXISTS `im_vw_postimtogl` */;
/*!50001 DROP VIEW IF EXISTS `im_vw_postimtogl` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `im_vw_postimtogl` AS select `a`.`im_number` AS `im_number`,`a`.`im_storeid` AS `im_storeid`,`a`.`im_date` AS `im_date`,`a`.`cm_code` AS `cm_code`,`b`.`cm_name` AS `cm_name`,`a`.`im_currency` AS `im_currency`,`a`.`im_ExchangeRate` AS `im_ExchangeRate`,`a`.`im_quantity` AS `im_quantity`,`a`.`im_totalprice` AS `im_totalprice`,`a`.`im_basevalue` AS `im_basevalue`,`a`.`im_status` AS `im_status`,`a`.`im_voucherno` AS `im_voucherno` from ((`im_transaction` `a` join `cm_productmaster` `b` on((`a`.`cm_code` = `b`.`cm_code`))) join `it_imtogl` `c` on(((left(`a`.`im_number`,4) = `c`.`c_trncode`) and (`b`.`cm_group` = `c`.`c_group`) and (`c`.`c_branch` = `a`.`im_storeid`) and (`a`.`im_status` = 'Open')))) group by `a`.`im_number` */;

/*View structure for view im_vw_purchasedt */

/*!50001 DROP TABLE IF EXISTS `im_vw_purchasedt` */;
/*!50001 DROP VIEW IF EXISTS `im_vw_purchasedt` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `im_vw_purchasedt` AS select `a`.`pp_purordnum` AS `pp_purordnum`,`a`.`cm_code` AS `cm_code`,`b`.`cm_name` AS `cm_name`,`a`.`pp_unit` AS `pp_unit`,`a`.`pp_unitqty` AS `pp_unitqty`,(`a`.`pp_quantity` - ifnull(`a`.`pp_grnqty`,0)) AS `pp_quantity`,`a`.`pp_purchasrate` AS `pp_purchasrate`,round(((`a`.`pp_purchasrate` * `a`.`pp_unitqty`) * (`a`.`pp_quantity` - ifnull(`a`.`pp_grnqty`,0))),0) AS `pp_totalamount` from (`pp_purchaseorddt` `a` join `cm_productmaster` `b` on((`a`.`cm_code` = `b`.`cm_code`))) group by `a`.`pp_purordnum`,`a`.`cm_code` having (sum((`a`.`pp_quantity` - ifnull(`a`.`pp_grnqty`,0))) > 0) */;

/*View structure for view im_vw_purchaseordhd */

/*!50001 DROP TABLE IF EXISTS `im_vw_purchaseordhd` */;
/*!50001 DROP VIEW IF EXISTS `im_vw_purchaseordhd` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `im_vw_purchaseordhd` AS select `a`.`id` AS `id`,`a`.`pp_purordnum` AS `pp_purordnum`,`a`.`cm_supplierid` AS `cm_supplierid`,`b`.`cm_orgname` AS `cm_orgname`,`a`.`pp_date` AS `Order_Date`,`a`.`pp_deliverydate` AS `Delivery_Date`,`a`.`pp_status` AS `pp_status` from (`pp_purchaseordhd` `a` join `cm_suppliermaster` `b` on((`a`.`cm_supplierid` = `b`.`cm_supplierid`))) where (`a`.`pp_status` not in ('Open','Cancel')) */;

/*View structure for view im_vw_stock */

/*!50001 DROP TABLE IF EXISTS `im_vw_stock` */;
/*!50001 DROP VIEW IF EXISTS `im_vw_stock` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `im_vw_stock` AS select `a`.`cm_code` AS `cm_code`,`c`.`cm_name` AS `cm_name`,`a`.`im_BatchNumber` AS `im_BatchNumber`,`a`.`im_ExpireDate` AS `im_ExpireDate`,`a`.`im_storeid` AS `im_storeid`,`c`.`cm_sellrate` AS `cm_sellrate`,`c`.`cm_selltax` AS `cm_selltax`,`a`.`im_rate` AS `im_rate`,`a`.`im_unit` AS `im_unit`,ifnull(`b`.`IssueQty`,0) AS `issueqty`,ifnull(`d`.`sm_quantity`,0) AS `saleqty`,ifnull(sum(ifnull((`a`.`im_quantity` * `a`.`im_sign`),0)),0) AS `inhandqty`,ifnull(((sum(ifnull((`a`.`im_quantity` * `a`.`im_sign`),0)) - ifnull(`b`.`IssueQty`,0)) - ifnull(`d`.`sm_quantity`,0)),0) AS `available` from (((`im_transaction` `a` left join `im_vw_transferissue` `b` on(((`a`.`im_BatchNumber` = `b`.`Batch`) and (`a`.`im_storeid` = `b`.`FromStore`) and (`a`.`cm_code` = `b`.`ProCode`)))) left join `sm_vw_salealc` `d` on(((`a`.`im_BatchNumber` = `d`.`sm_batchnumber`) and (`a`.`im_storeid` = `d`.`sm_store`) and (`a`.`cm_code` = `d`.`sm_code`)))) left join `cm_productmaster` `c` on((`a`.`cm_code` = `c`.`cm_code`))) group by `a`.`im_ExpireDate`,`a`.`im_BatchNumber`,`a`.`im_storeid`,`a`.`cm_code` */;

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

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `im_vw_trn` AS select `a`.`im_number` AS `trnnumber`,`a`.`cm_code` AS `procode`,`b`.`cm_name` AS `proname`,`c`.`cm_description` AS `store`,`a`.`im_BatchNumber` AS `bnumber`,`a`.`im_ExpireDate` AS `expdate`,`a`.`im_quantity` AS `qty`,`a`.`im_unit` AS `unit`,`a`.`im_rate` AS `rate`,(`a`.`im_quantity` * `a`.`im_rate`) AS `value`,`a`.`im_status` AS `status` from ((`im_transaction` `a` join `cm_productmaster` `b`) join `cm_branchmaster` `c`) where ((`a`.`cm_code` = `b`.`cm_code`) and (`a`.`im_storeid` = `c`.`cm_branch`)) */;

/*View structure for view sm_vw_cusreceivable */

/*!50001 DROP TABLE IF EXISTS `sm_vw_cusreceivable` */;
/*!50001 DROP VIEW IF EXISTS `sm_vw_cusreceivable` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `sm_vw_cusreceivable` AS select `a`.`cm_cuscode` AS `cm_code`,`b`.`cm_name` AS `cm_name`,`b`.`cm_group` AS `cm_group`,`a`.`sm_storeid` AS `cm_branch`,`b`.`cm_address` AS `cm_address`,`b`.`cm_cellnumber` AS `cm_cellnumber`,sum((`a`.`sm_netamt` * `a`.`sm_sign`)) AS `sm_receivable` from (`sm_header` `a` join `cm_customermst` `b`) where ((`a`.`cm_cuscode` = `b`.`cm_cuscode`) and (`a`.`sm_stataus` <> 'Cancel')) group by `a`.`cm_cuscode`,`a`.`sm_storeid` */;

/*View structure for view sm_vw_mralc */

/*!50001 DROP TABLE IF EXISTS `sm_vw_mralc` */;
/*!50001 DROP VIEW IF EXISTS `sm_vw_mralc` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `sm_vw_mralc` AS select `sm_header`.`sm_refe_code` AS `sm_invnumber`,`sm_header`.`cm_cuscode` AS `cm_cuscode`,`sm_header`.`sm_storeid` AS `sm_branch`,`sm_header`.`sm_sign` AS `sm_sign`,`sm_header`.`sm_currency` AS `sm_currency`,`sm_header`.`sm_exchrate` AS `sm_exchrate`,`sm_header`.`sm_netamt` AS `sm_rcvamt` from `sm_header` where ((`sm_header`.`sm_doc_type` in ('Sales','Return')) and (`sm_header`.`sm_stataus` in ('Confirmed','Delivered'))) union all select `b`.`sm_invnumber` AS `sm_invnumber`,`a`.`cm_cuscode` AS `cm_cuscode`,`a`.`sm_storeid` AS `sm_storeid`,`a`.`sm_sign` AS `sm_sign`,`a`.`sm_currency` AS `sm_currency`,`a`.`sm_exchrate` AS `sm_exchrate`,`b`.`sm_amount` AS `sm_amount` from (`sm_header` `a` join `sm_invalc` `b` on(((`a`.`sm_number` = `b`.`sm_number`) and (`a`.`sm_doc_type` = 'Receipt')))) */;

/*View structure for view sm_vw_mrrcv */

/*!50001 DROP TABLE IF EXISTS `sm_vw_mrrcv` */;
/*!50001 DROP VIEW IF EXISTS `sm_vw_mrrcv` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `sm_vw_mrrcv` AS select `sm_vw_mralc`.`sm_invnumber` AS `sm_invnumber`,`sm_vw_mralc`.`cm_cuscode` AS `cm_cuscode`,`sm_vw_mralc`.`sm_branch` AS `sm_branch`,`sm_vw_mralc`.`sm_currency` AS `sm_currency`,`sm_vw_mralc`.`sm_exchrate` AS `sm_exchrate`,sum((`sm_vw_mralc`.`sm_sign` * `sm_vw_mralc`.`sm_rcvamt`)) AS `sm_amount` from `sm_vw_mralc` group by `sm_vw_mralc`.`sm_invnumber` having (sum((`sm_vw_mralc`.`sm_sign` * `sm_vw_mralc`.`sm_rcvamt`)) > 0) */;

/*View structure for view sm_vw_salealc */

/*!50001 DROP TABLE IF EXISTS `sm_vw_salealc` */;
/*!50001 DROP VIEW IF EXISTS `sm_vw_salealc` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `sm_vw_salealc` AS select `a`.`sm_storeid` AS `sm_store`,`b`.`cm_code` AS `sm_code`,`b`.`sm_batchnumber` AS `sm_batchnumber`,sum(((`b`.`sm_quantity` + ifnull(`b`.`sm_bonusqty`,0)) * `a`.`sm_sign`)) AS `sm_quantity` from (`sm_header` `a` join `sm_batchsale` `b` on(((`a`.`sm_number` = `b`.`sm_number`) and (`a`.`sm_doc_type` = 'Sales') and (`a`.`sm_stataus` not in ('Delivered','Cancel'))))) group by `b`.`cm_code`,`b`.`sm_batchnumber`,`a`.`sm_storeid` */;

/*View structure for view sm_vw_sm_batchsale */

/*!50001 DROP TABLE IF EXISTS `sm_vw_sm_batchsale` */;
/*!50001 DROP VIEW IF EXISTS `sm_vw_sm_batchsale` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `sm_vw_sm_batchsale` AS select `a`.`sm_ref_code` AS `sm_number`,`a`.`cm_code` AS `cm_code`,`c`.`cm_name` AS `cm_name`,`a`.`sm_batchnumber` AS `sm_batchnumber`,`a`.`sm_expdate` AS `sm_expdate`,`a`.`sm_unit` AS `sm_unit`,`a`.`sm_sellrate` AS `sm_sellrate`,`a`.`sm_rate` AS `sm_rate`,sum((`a`.`sm_quantity` * `b`.`sm_sign`)) AS `sm_quantity`,`a`.`sm_tax_rate` AS `sm_tax_rate`,sum(((`a`.`sm_quantity` * `b`.`sm_sign`) * `a`.`sm_line_amt`)) AS `sm_line_amt` from ((`sm_batchsale` `a` join `sm_header` `b` on((`a`.`sm_number` = `b`.`sm_number`))) join `cm_productmaster` `c` on((`a`.`cm_code` = `c`.`cm_code`))) group by `a`.`sm_ref_code`,`a`.`cm_code` */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

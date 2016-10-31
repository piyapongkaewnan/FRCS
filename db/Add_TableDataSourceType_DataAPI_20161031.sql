/*
SQLyog Enterprise - MySQL GUI v8.18 
MySQL - 5.5.5-10.1.13-MariaDB : Database - true_db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


/*Table structure for table `datasourcetype` */

DROP TABLE IF EXISTS `datasourcetype`;

CREATE TABLE `datasourcetype` (
  `id` tinyint(5) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `datasourcetype` */

insert  into `datasourcetype`(`id`,`type`) values (1,'App store (google)'),(2,'App store (facebook)'),(3,'App store (apple)'),(4,'TPGG Total Settlement (THB)'),(5,'GG Shop'),(6,'IVR'),(7,'Event'),(8,'Bill3'),(9,'Bill7');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

DROP TABLE IF EXISTS `dataapi`;
CREATE TABLE `dataapi` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `APIRefCode` varchar(16) NOT NULL COMMENT 'APIRef Code',
  `APIName` varchar(100) NOT NULL COMMENT 'API Name',
  `APIUrl` varchar(100) NOT NULL COMMENT 'API Url',
  `UserName` varchar(100) DEFAULT NULL COMMENT 'UserName',
  `Password` varchar(100) DEFAULT NULL COMMENT 'Password',
  `DataSourceType` tinyint(5) DEFAULT NULL COMMENT 'DataSourceType link from DataSourceType table',
  `IsActive` tinyint(1) DEFAULT '1',
  `IsDelete` tinyint(1) DEFAULT NULL COMMENT 'soft delete flag',
  `DeletedBy` int(10) DEFAULT NULL COMMENT 'activity audit trail capture',
  `DeletedOn` datetime DEFAULT NULL COMMENT 'activity audit trail capture',
  `CreatedBy` int(10) DEFAULT NULL COMMENT 'activity audit trail capture',
  `CreatedOn` datetime DEFAULT NULL COMMENT 'activity audit trail capture',
  `ModifiedBy` int(10) DEFAULT NULL COMMENT 'activity audit trail capture',
  `ModifiedOn` datetime DEFAULT NULL COMMENT 'activity audit trail capture',
  PRIMARY KEY (`id`),
  KEY `FK_DataAPI` (`DeletedBy`),
  KEY `FK_DataAPI1` (`CreatedBy`),
  KEY `FK_DataAPI2` (`ModifiedBy`),
  KEY `FK_dataapi_dataapi_type` (`DataSourceType`),
  CONSTRAINT `FK_DataAPI` FOREIGN KEY (`DeletedBy`) REFERENCES `user` (`user_id`),
  CONSTRAINT `FK_DataAPI1` FOREIGN KEY (`CreatedBy`) REFERENCES `user` (`user_id`),
  CONSTRAINT `FK_DataAPI2` FOREIGN KEY (`ModifiedBy`) REFERENCES `user` (`user_id`),
  CONSTRAINT `FK_dataapi_dataapi_type` FOREIGN KEY (`DataSourceType`) REFERENCES `datasourcetype` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8

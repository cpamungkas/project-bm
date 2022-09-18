-- MySQL dump 10.13  Distrib 5.5.62, for Win64 (AMD64)
--
-- Host: localhost    Database: bmdb
-- ------------------------------------------------------
-- Server version	5.7.33

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tb_gas_station`
--

DROP TABLE IF EXISTS `tb_gas_station`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_gas_station` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location` int(11) NOT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL,
  `worker` int(11) NOT NULL,
  `equipment_checklist` enum('DAILY','WEEKLY','MONTHLY') NOT NULL DEFAULT 'DAILY',
  `pressure` decimal(6,2) DEFAULT NULL,
  `selenoid_valve` enum('0','1') DEFAULT NULL,
  `detector` enum('0','1') DEFAULT NULL,
  `selang_gas` enum('0','1') DEFAULT NULL,
  `meter_gas` char(10) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_gas_station`
--

LOCK TABLES `tb_gas_station` WRITE;
/*!40000 ALTER TABLE `tb_gas_station` DISABLE KEYS */;
INSERT INTO `tb_gas_station` VALUES (2,1,'13:00:00','2022-09-13',12,'WEEKLY',1312.00,'1','1','1','1','2022-09-13 10:34:12','2022-09-13 10:34:12'),(4,2,'13:00:00','2022-09-13',12,'DAILY',12.00,'1','0','1','43','2022-09-13 10:49:12','2022-09-13 11:17:00'),(5,1,'19:00:00','2022-09-13',12,'DAILY',11.00,'0','0','0','22','2022-09-13 11:47:47','2022-09-13 11:47:47'),(6,1,'19:00:00','2022-09-13',12,'MONTHLY',19.99,'1','1','0','191','2022-09-13 11:51:22','2022-09-13 14:03:46'),(8,1,'08:00:00','2022-09-13',12,'WEEKLY',2312.00,'0','0','0','232','2022-09-13 13:52:48','2022-09-13 13:52:48'),(9,1,'19:00:00','2022-09-16',12,'DAILY',12.00,'1','1','1','33','2022-09-16 16:02:10','2022-09-16 16:02:10');
/*!40000 ALTER TABLE `tb_gas_station` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_plumbing`
--

DROP TABLE IF EXISTS `tb_plumbing`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_plumbing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location` int(11) NOT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL,
  `worker` int(11) NOT NULL,
  `equipment_checklist` enum('DAILY','WEEKLY','MONTHLY') NOT NULL DEFAULT 'DAILY',
  `instalasi_air_bersih_p_transfer1` enum('0','1') DEFAULT NULL,
  `instalasi_air_bersih_p_transfer2` enum('0','1') DEFAULT NULL,
  `fire_pump_jockey_pump` enum('0','1') DEFAULT NULL,
  `fire_pump_jockey_pressure` decimal(10,2) DEFAULT NULL,
  `fire_pump_hydrant_pump` enum('0','1') DEFAULT NULL,
  `fire_pump_hydrant_pressure` decimal(10,2) DEFAULT NULL,
  `gwt_level_air` enum('0','1') DEFAULT NULL,
  `gwt_elektrode` enum('0','1') DEFAULT NULL,
  `roof_tank_level_air` enum('0','1') DEFAULT NULL,
  `roof_tank_elektrode` enum('0','1') DEFAULT NULL,
  `recycle_tank_level_air` enum('0','1') DEFAULT NULL,
  `recycle_tank_elektrode` enum('0','1') DEFAULT NULL,
  `keterangan` varchar(2000) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `tb_plumbing_FK` (`location`),
  KEY `tb_plumbing_FK_1` (`worker`),
  CONSTRAINT `tb_plumbing_FK` FOREIGN KEY (`location`) REFERENCES `tb_store` (`idStore`) ON UPDATE CASCADE,
  CONSTRAINT `tb_plumbing_FK_1` FOREIGN KEY (`worker`) REFERENCES `tb_user` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_plumbing`
--

LOCK TABLES `tb_plumbing` WRITE;
/*!40000 ALTER TABLE `tb_plumbing` DISABLE KEYS */;
INSERT INTO `tb_plumbing` VALUES (3,1,'08:00:00','2022-09-16',12,'DAILY','1','1','0',3.00,'0',2.00,'0','0','0','0','0','0','sfse','2022-09-16 14:05:16','2022-09-16 14:05:16');
/*!40000 ALTER TABLE `tb_plumbing` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_equipment`
--

DROP TABLE IF EXISTS `tb_equipment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_equipment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `equipment` varchar(255) NOT NULL,
  `equipment_name` varchar(255) NOT NULL COMMENT 'nama equipment (untuk tampilan)',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status_deleted` enum('0','1') NOT NULL DEFAULT '0' COMMENT '1 == DELETED',
  `default_checklist` enum('DAILY','WEEKLY','MONTHLY') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_equipment`
--

LOCK TABLES `tb_equipment` WRITE;
/*!40000 ALTER TABLE `tb_equipment` DISABLE KEYS */;
INSERT INTO `tb_equipment` VALUES (1,'equipment_trafocubicle','Trafo dan Cubicle','2022-09-08 10:05:52','2022-09-08 14:16:50','0','DAILY'),(2,'equipment_kwhmeter1','KWH Meter 1','2022-09-08 10:07:07','2022-09-08 14:16:50','0','DAILY'),(3,'equipment_kwhmeter2','KWH Meter 2','2022-09-08 10:10:30','2022-09-08 14:16:50','0','DAILY'),(4,'equipment_lvmdp','Panel LVMDP','2022-09-08 10:11:34','2022-09-08 14:16:50','0','DAILY'),(5,'equipment_capbank','Panel Cap. Bank','2022-09-08 10:12:46','2022-09-08 14:16:50','0','DAILY'),(6,'equipment_genset','Genset','2022-09-08 10:13:06','2022-09-08 14:16:50','0','MONTHLY'),(7,'equipment_dieselhydrant','Diesel Hydrant','2022-09-08 10:33:28','2022-09-08 14:16:50','0','WEEKLY'),(8,'equipment_acchiller','AC Chiller','2022-09-08 10:33:28','2022-09-08 14:16:50','0','DAILY'),(9,'equipment_accoolingtower','AC Cooling Tower','2022-09-08 10:33:28','2022-09-08 14:16:50','0','DAILY'),(10,'equipment_acahu','AC AHU','2022-09-08 10:33:28','2022-09-08 14:16:50','0','DAILY'),(11,'equipment_acsplitwall','AC Splitwall, Duct, Cassette, VRV','2022-09-08 10:33:28','2022-09-08 14:16:50','0','MONTHLY'),(12,'equipment_suhu','Suhu','2022-09-08 10:33:28','2022-09-08 14:16:50','0','DAILY'),(13,'equipment_lighting','Lighting','2022-09-08 10:33:28','2022-09-08 14:16:50','0','MONTHLY'),(14,'equipment_escalator','Escalator','2022-09-08 10:33:28','2022-09-08 14:16:50','0','WEEKLY'),(15,'equipment_elevator','Elevator','2022-09-08 10:33:28','2022-09-08 14:16:50','0','WEEKLY'),(16,'equipment_dumbwaiter','Dumbwaiter','2022-09-08 10:33:28','2022-09-08 14:16:50','0','WEEKLY'),(17,'equipment_sanitary','Sanitary','2022-09-08 10:33:28','2022-09-08 14:16:50','0','WEEKLY'),(18,'equipment_ups','UPS','2022-09-08 10:33:28','2022-09-08 14:16:50','0','MONTHLY'),(19,'equipment_stp','STP','2022-09-08 10:33:28','2022-09-08 14:16:50','0','DAILY'),(20,'equipment_cctv','CCTV','2022-09-08 10:33:28','2022-09-08 14:16:50','0','WEEKLY'),(21,'equipment_plumbing','Plumbing','2022-09-08 10:33:28','2022-09-08 14:16:50','0','DAILY'),(22,'equipment_metersumber','Meter Sumber dan Air Olahan','2022-09-08 10:33:28','2022-09-08 14:16:50','0','DAILY'),(23,'equipment_dindingpartisi','Dinding Partisi','2022-09-08 10:33:28','2022-09-08 14:16:50','0','MONTHLY'),(24,'equipment_pintu','Pintu','2022-09-08 10:33:28','2022-09-08 14:16:50','0','MONTHLY'),(25,'equipment_foldinggate','Folding Gate','2022-09-08 10:33:28','2022-09-08 14:16:50','0','MONTHLY'),(26,'equipment_rollingdoor','Rolling Door','2022-09-08 10:33:28','2022-09-08 14:16:50','0','MONTHLY'),(27,'equipment_firefighting','Fire Fighting','2022-09-08 10:33:28','2022-09-08 14:16:50','0','MONTHLY'),(28,'equipment_telephonepabx','Telephone dan PABX','2022-09-08 10:33:28','2022-09-08 14:16:50','0','MONTHLY'),(29,'equipment_housekeeping','Housekeeping','2022-09-08 10:33:28','2022-09-08 14:16:50','0','DAILY'),(30,'equipment_gondola','Gondola','2022-09-08 10:33:28','2022-09-08 14:16:50','0','WEEKLY'),(31,'equipment_soundsystem','Sound System ','2022-09-08 10:33:28','2022-09-08 14:16:50','0','MONTHLY'),(32,'equipment_gasstation','Gas Station','2022-09-16 15:05:12','2022-09-16 15:05:12','0','DAILY');
/*!40000 ALTER TABLE `tb_equipment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_ups`
--

DROP TABLE IF EXISTS `tb_ups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_ups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location` int(11) NOT NULL,
  `date` date NOT NULL,
  `worker` int(11) NOT NULL,
  `equipment_checklist` enum('DAILY','WEEKLY','MONTHLY') NOT NULL DEFAULT 'MONTHLY',
  `merk` varchar(25) DEFAULT NULL,
  `type` varchar(25) DEFAULT NULL,
  `serial_number` varchar(25) DEFAULT NULL,
  `lokasi_ruang` varchar(30) DEFAULT NULL,
  `lokasi_lantai` char(2) DEFAULT NULL,
  `peruntukan` varchar(50) DEFAULT NULL,
  `tegangan_input` decimal(10,2) DEFAULT NULL,
  `tegangan_output` decimal(10,2) DEFAULT NULL,
  `tegangan_n_g` decimal(10,2) DEFAULT NULL,
  `load_percent` decimal(4,2) DEFAULT NULL,
  `load_amp` decimal(10,2) DEFAULT NULL,
  `inspeksi_kebersihan` enum('0','1') DEFAULT NULL,
  `inspeksi_fan` enum('0','1') DEFAULT NULL,
  `inspeksi_suhu` decimal(10,0) DEFAULT NULL,
  `inspeksi_alarm` varchar(50) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `tb_ups_FK` (`location`),
  KEY `tb_ups_FK_1` (`worker`),
  CONSTRAINT `tb_ups_FK` FOREIGN KEY (`location`) REFERENCES `tb_store` (`idStore`) ON UPDATE CASCADE,
  CONSTRAINT `tb_ups_FK_1` FOREIGN KEY (`worker`) REFERENCES `tb_user` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_ups`
--

LOCK TABLES `tb_ups` WRITE;
/*!40000 ALTER TABLE `tb_ups` DISABLE KEYS */;
INSERT INTO `tb_ups` VALUES (1,1,'2022-09-12',12,'MONTHLY','lala','baru','999111','ruang','2','untuk',200.00,300.00,400.00,20.00,400.00,'1','0',25,'good',NULL,'2022-09-12 11:38:38','2022-09-12 11:38:38'),(3,1,'2022-09-12',12,'DAILY','dai edit','dawdedit','32424edit','sfeedit','3','vdvs esfeedit',11.00,22.00,32.00,43.00,54.00,'1','0',65,'edit',NULL,'2022-09-12 15:23:10','2022-09-12 16:22:32'),(4,1,'2022-09-13',12,'MONTHLY','keterangan','adaw','123123','dfs','2','gsfsw',212.00,22.00,33.00,44.00,55.00,'1','1',66,'sad','awdawd ket edit','2022-09-13 08:08:10','2022-09-13 08:08:31'),(5,1,'2022-09-13',12,'DAILY',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-09-13 10:29:34','2022-09-13 10:29:34');
/*!40000 ALTER TABLE `tb_ups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_store_equipment`
--

DROP TABLE IF EXISTS `tb_store_equipment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_store_equipment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idStore` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status_deleted` enum('0','1') NOT NULL DEFAULT '0' COMMENT '1 == DELETED',
  `idEquipment` int(11) DEFAULT NULL,
  `checklist` enum('DAILY','WEEKLY','MONTHLY') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tb_store_equipment_FK` (`idStore`),
  KEY `tb_store_equipment_FK_1` (`idEquipment`),
  CONSTRAINT `tb_store_equipment_FK` FOREIGN KEY (`idStore`) REFERENCES `tb_store` (`idStore`) ON UPDATE CASCADE,
  CONSTRAINT `tb_store_equipment_FK_1` FOREIGN KEY (`idEquipment`) REFERENCES `tb_equipment` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=194 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_store_equipment`
--

LOCK TABLES `tb_store_equipment` WRITE;
/*!40000 ALTER TABLE `tb_store_equipment` DISABLE KEYS */;
INSERT INTO `tb_store_equipment` VALUES (36,8,'2022-09-09 10:31:35','2022-09-09 13:39:12','1',1,'MONTHLY'),(39,10,'2022-09-09 10:55:57','2022-09-09 14:59:57','1',2,'MONTHLY'),(40,10,'2022-09-09 10:55:57','2022-09-09 14:59:57','1',4,'DAILY'),(41,10,'2022-09-09 10:55:57','2022-09-09 14:59:57','1',5,'DAILY'),(42,10,'2022-09-09 10:55:57','2022-09-09 14:59:57','1',6,'MONTHLY'),(43,10,'2022-09-09 10:55:57','2022-09-09 14:59:57','1',7,'WEEKLY'),(44,10,'2022-09-09 10:55:57','2022-09-09 14:59:57','1',8,'DAILY'),(45,10,'2022-09-09 10:55:57','2022-09-09 14:59:57','1',9,'DAILY'),(46,10,'2022-09-09 10:55:57','2022-09-09 14:59:57','1',10,'DAILY'),(47,10,'2022-09-09 10:55:57','2022-09-09 14:59:57','1',11,'MONTHLY'),(48,10,'2022-09-09 10:55:57','2022-09-09 14:59:57','1',12,'WEEKLY'),(49,10,'2022-09-09 10:55:57','2022-09-09 14:59:57','1',15,'WEEKLY'),(50,10,'2022-09-09 10:55:57','2022-09-09 14:59:57','1',16,'WEEKLY'),(51,10,'2022-09-09 10:55:57','2022-09-09 14:59:57','1',17,'WEEKLY'),(52,10,'2022-09-09 10:55:57','2022-09-09 14:59:57','1',18,'MONTHLY'),(53,10,'2022-09-09 10:55:57','2022-09-09 14:59:57','1',19,'DAILY'),(54,10,'2022-09-09 10:55:57','2022-09-09 14:59:57','1',20,'WEEKLY'),(55,10,'2022-09-09 10:55:57','2022-09-09 14:59:57','1',21,'DAILY'),(56,10,'2022-09-09 10:55:57','2022-09-09 14:59:57','1',22,'DAILY'),(57,10,'2022-09-09 10:55:57','2022-09-09 14:59:57','1',23,'WEEKLY'),(58,10,'2022-09-09 10:55:57','2022-09-09 14:59:57','1',26,'MONTHLY'),(59,10,'2022-09-09 10:55:57','2022-09-09 14:59:57','1',27,'MONTHLY'),(60,10,'2022-09-09 10:55:57','2022-09-09 14:59:57','1',28,'MONTHLY'),(61,10,'2022-09-09 10:55:57','2022-09-09 14:59:57','1',29,'DAILY'),(62,10,'2022-09-09 10:55:57','2022-09-09 14:59:57','1',30,'WEEKLY'),(63,10,'2022-09-09 10:55:57','2022-09-09 14:59:57','1',31,'MONTHLY'),(70,4,'2022-09-09 13:33:46','2022-09-09 13:33:46','0',1,'MONTHLY'),(71,4,'2022-09-09 13:33:46','2022-09-09 13:33:46','0',2,'DAILY'),(72,4,'2022-09-09 13:33:46','2022-09-09 13:33:46','0',3,'WEEKLY'),(73,4,'2022-09-09 13:33:46','2022-09-09 13:33:46','0',4,'MONTHLY'),(74,4,'2022-09-09 13:33:46','2022-09-09 13:33:46','0',12,'WEEKLY'),(75,4,'2022-09-09 13:33:46','2022-09-09 13:33:46','0',13,'WEEKLY'),(76,4,'2022-09-09 13:33:46','2022-09-09 13:33:46','0',14,'DAILY'),(77,4,'2022-09-09 13:33:46','2022-09-09 13:33:46','0',15,'MONTHLY'),(78,4,'2022-09-09 13:33:46','2022-09-09 13:33:46','0',23,'DAILY'),(79,4,'2022-09-09 13:33:46','2022-09-09 13:33:46','0',24,'MONTHLY'),(80,4,'2022-09-09 13:33:46','2022-09-09 13:33:46','0',25,'WEEKLY'),(81,4,'2022-09-09 13:33:46','2022-09-09 13:33:46','0',26,'MONTHLY'),(82,8,'2022-09-09 13:41:17','2022-09-09 13:41:17','0',2,'WEEKLY'),(83,8,'2022-09-09 13:41:17','2022-09-09 13:41:17','0',24,'MONTHLY'),(84,10,'2022-09-09 15:00:21','2022-09-09 15:00:21','0',1,'DAILY'),(85,10,'2022-09-09 15:00:21','2022-09-09 15:00:21','0',11,'MONTHLY'),(86,10,'2022-09-09 15:00:21','2022-09-09 15:00:21','0',22,'DAILY'),(87,10,'2022-09-09 15:00:21','2022-09-09 15:00:21','0',31,'MONTHLY'),(93,2,'2022-09-14 09:37:54','2022-09-14 09:38:05','1',1,'MONTHLY'),(94,2,'2022-09-14 09:37:54','2022-09-14 09:38:05','1',15,'DAILY'),(95,2,'2022-09-14 09:37:54','2022-09-14 09:38:05','1',16,'DAILY'),(96,2,'2022-09-14 09:37:54','2022-09-14 09:38:05','1',26,'MONTHLY'),(97,2,'2022-09-14 09:37:54','2022-09-14 09:38:05','1',27,'MONTHLY'),(98,2,'2022-09-14 09:38:29','2022-09-14 09:38:29','0',1,'DAILY'),(99,2,'2022-09-14 09:38:29','2022-09-14 09:38:29','0',13,'MONTHLY'),(100,2,'2022-09-14 09:38:29','2022-09-14 09:38:29','0',14,'WEEKLY'),(163,1,'2022-09-16 14:04:32','2022-09-16 14:04:32','0',1,'DAILY'),(164,1,'2022-09-16 14:04:32','2022-09-16 14:04:32','0',2,'DAILY'),(165,1,'2022-09-16 14:04:32','2022-09-16 14:04:32','0',3,'DAILY'),(166,1,'2022-09-16 14:04:32','2022-09-16 14:04:32','0',4,'DAILY'),(167,1,'2022-09-16 14:04:32','2022-09-16 14:04:32','0',5,'DAILY'),(168,1,'2022-09-16 14:04:32','2022-09-16 14:04:32','0',6,'MONTHLY'),(169,1,'2022-09-16 14:04:32','2022-09-16 14:04:32','0',7,'WEEKLY'),(170,1,'2022-09-16 14:04:32','2022-09-16 14:04:32','0',8,'DAILY'),(171,1,'2022-09-16 14:04:32','2022-09-16 14:04:32','0',9,'DAILY'),(172,1,'2022-09-16 14:04:32','2022-09-16 14:04:32','0',10,'DAILY'),(173,1,'2022-09-16 14:04:32','2022-09-16 14:04:32','0',11,'MONTHLY'),(174,1,'2022-09-16 14:04:32','2022-09-16 14:04:32','0',12,'DAILY'),(175,1,'2022-09-16 14:04:32','2022-09-16 14:04:32','0',13,'MONTHLY'),(176,1,'2022-09-16 14:04:32','2022-09-16 14:04:32','0',14,'WEEKLY'),(177,1,'2022-09-16 14:04:32','2022-09-16 14:04:32','0',15,'WEEKLY'),(178,1,'2022-09-16 14:04:32','2022-09-16 14:04:32','0',16,'WEEKLY'),(179,1,'2022-09-16 14:04:32','2022-09-16 14:04:32','0',17,'WEEKLY'),(180,1,'2022-09-16 14:04:32','2022-09-16 14:04:32','0',18,'MONTHLY'),(181,1,'2022-09-16 14:04:32','2022-09-16 14:04:32','0',19,'DAILY'),(182,1,'2022-09-16 14:04:32','2022-09-16 14:04:32','0',20,'MONTHLY'),(183,1,'2022-09-16 14:04:32','2022-09-16 14:04:32','0',21,'WEEKLY'),(184,1,'2022-09-16 14:04:32','2022-09-16 14:04:32','0',22,'DAILY'),(185,1,'2022-09-16 14:04:32','2022-09-16 14:04:32','0',23,'MONTHLY'),(186,1,'2022-09-16 14:04:32','2022-09-16 14:04:32','0',24,'MONTHLY'),(187,1,'2022-09-16 14:04:32','2022-09-16 14:04:32','0',25,'MONTHLY'),(188,1,'2022-09-16 14:04:32','2022-09-16 14:04:32','0',26,'MONTHLY'),(189,1,'2022-09-16 14:04:32','2022-09-16 14:04:32','0',27,'MONTHLY'),(190,1,'2022-09-16 14:04:32','2022-09-16 14:04:32','0',28,'MONTHLY'),(191,1,'2022-09-16 14:04:32','2022-09-16 14:04:32','0',29,'DAILY'),(192,1,'2022-09-16 14:04:32','2022-09-16 14:04:32','0',30,'WEEKLY'),(193,1,'2022-09-16 14:04:32','2022-09-16 14:04:32','0',31,'MONTHLY');
/*!40000 ALTER TABLE `tb_store_equipment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_cctv`
--

DROP TABLE IF EXISTS `tb_cctv`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_cctv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location` int(11) NOT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL,
  `worker` int(11) NOT NULL,
  `equipment_checklist` enum('DAILY','WEEKLY','MONTHLY') NOT NULL DEFAULT 'WEEKLY',
  `dvr` enum('DVR1','DVR2','DVR3','DVR4','DVR5') DEFAULT NULL,
  `hdd_internal` enum('0','1') DEFAULT NULL,
  `usb_extender` enum('0','1') DEFAULT NULL,
  `hdmi_vga_ext` enum('0','1') DEFAULT NULL,
  `jumlah_rekaman` decimal(10,2) DEFAULT NULL COMMENT 'DAYS',
  `camera_jumlah` int(11) DEFAULT NULL,
  `camera_keterangan` varchar(500) DEFAULT NULL,
  `adaptor_power_jumlah` int(11) DEFAULT NULL,
  `adaptor_power_keterangan` varchar(500) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `tb_cctv_FK` (`worker`),
  KEY `tb_cctv_FK_1` (`location`),
  CONSTRAINT `tb_cctv_FK` FOREIGN KEY (`worker`) REFERENCES `tb_user` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `tb_cctv_FK_1` FOREIGN KEY (`location`) REFERENCES `tb_store` (`idStore`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_cctv`
--

LOCK TABLES `tb_cctv` WRITE;
/*!40000 ALTER TABLE `tb_cctv` DISABLE KEYS */;
INSERT INTO `tb_cctv` VALUES (3,1,'10:00:00','2022-09-15',12,'DAILY','DVR1','1','0','1',11.00,5,'full 3',3,NULL,'2022-09-15 11:40:05','2022-09-15 11:40:05'),(4,1,'10:00:00','2022-09-15',12,'DAILY','DVR3','1','1','1',4.00,4,'44',4,NULL,'2022-09-15 11:40:05','2022-09-15 11:40:05'),(5,1,'10:00:00','2022-09-15',12,'DAILY','DVR1','0','1','1',2.00,12,'cam ket edit 12',22,'adap ket edit 22','2022-09-15 14:02:43','2022-09-15 14:22:01'),(6,1,'10:00:00','2022-09-15',12,'WEEKLY','DVR1','0','0','1',2.00,1,'weekr',1,'weekrr','2022-09-15 15:21:41','2022-09-15 16:23:25');
/*!40000 ALTER TABLE `tb_cctv` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_stp`
--

DROP TABLE IF EXISTS `tb_stp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_stp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location` int(11) NOT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL,
  `worker` int(11) NOT NULL,
  `equipment_checklist` enum('DAILY','WEEKLY','MONTHLY') NOT NULL DEFAULT 'DAILY',
  `blower1` enum('0','1') DEFAULT NULL,
  `blower2` enum('0','1') DEFAULT NULL,
  `transfer_pump1` enum('0','1') DEFAULT NULL,
  `transfer_pump2` enum('0','1') DEFAULT NULL,
  `effluent_pump1` enum('0','1') DEFAULT NULL,
  `effluent_pump2` enum('0','1') DEFAULT NULL,
  `equalizing_pump1` enum('0','1') DEFAULT NULL,
  `equalizing_pump2` enum('0','1') DEFAULT NULL,
  `filter_pump1` enum('0','1') DEFAULT NULL,
  `filter_pump2` enum('0','1') DEFAULT NULL,
  `dozing_pump` enum('0','1') DEFAULT NULL,
  `fresh_air_fan` enum('0','1') DEFAULT NULL,
  `exhaust_fan` enum('0','1') DEFAULT NULL,
  `inspeksi_cleaning_grease_trap` enum('0','1') DEFAULT NULL,
  `inspeksi_chlorine` enum('0','1') DEFAULT NULL,
  `inspeksi_flow_meter` enum('0','1') DEFAULT NULL,
  `inspeksi_ph_water` decimal(10,2) DEFAULT NULL,
  `keterangan` varchar(2000) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `tb_stp_FK` (`worker`),
  KEY `tb_stp_FK_1` (`location`),
  CONSTRAINT `tb_stp_FK` FOREIGN KEY (`worker`) REFERENCES `tb_user` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `tb_stp_FK_1` FOREIGN KEY (`location`) REFERENCES `tb_store` (`idStore`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_stp`
--

LOCK TABLES `tb_stp` WRITE;
/*!40000 ALTER TABLE `tb_stp` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_stp` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-09-18 18:23:38

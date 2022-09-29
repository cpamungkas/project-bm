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
-- Table structure for table `tb_equipment`
--

DROP TABLE IF EXISTS `tb_equipment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_equipment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `equipment` varchar(255) NOT NULL,
  `equipment_name` varchar(255) NOT NULL COMMENT 'nama equipment (untuk tampilan)',
  `default_checklist` enum('DAILY','WEEKLY','MONTHLY') DEFAULT NULL,
  `status_deleted` enum('0','1') NOT NULL DEFAULT '0' COMMENT '1 == DELETED',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_equipment`
--

LOCK TABLES `tb_equipment` WRITE;
/*!40000 ALTER TABLE `tb_equipment` DISABLE KEYS */;
INSERT INTO `tb_equipment` VALUES (1,'trafocubicle','equipment_trafocubicle','Trafo dan Cubicle','DAILY','0','2022-09-08 10:05:52','2022-09-22 13:48:15'),(2,'kwhmeter','equipment_kwhmeter1','KWH Meter 1','DAILY','0','2022-09-08 10:07:07','2022-09-22 13:48:15'),(3,'','equipment_kwhmeter2','KWH Meter 2','DAILY','0','2022-09-08 10:10:30','2022-09-08 14:16:50'),(4,'panellvmdp','equipment_lvmdp','Panel LVMDP','DAILY','0','2022-09-08 10:11:34','2022-09-22 13:48:15'),(5,'panelcapacitorbank','equipment_capbank','Panel Cap. Bank','DAILY','0','2022-09-08 10:12:46','2022-09-22 13:48:15'),(6,'genset1','equipment_genset','Genset','MONTHLY','0','2022-09-08 10:13:06','2022-09-22 13:48:15'),(7,'dieselhydrant','equipment_dieselhydrant','Diesel Hydrant','WEEKLY','0','2022-09-08 10:33:28','2022-09-22 13:48:15'),(8,'acchiller','equipment_acchiller','AC Chiller','DAILY','0','2022-09-08 10:33:28','2022-09-22 13:48:15'),(9,'accoolingtower','equipment_accoolingtower','AC Cooling Tower','DAILY','0','2022-09-08 10:33:28','2022-09-22 14:55:37'),(10,'acahu','equipment_acahu','AC AHU','DAILY','0','2022-09-08 10:33:28','2022-09-22 14:55:37'),(11,'acsplitwallduckcassettevrv','equipment_acsplitwall','AC Splitwall, Duct, Cassette, VRV','MONTHLY','0','2022-09-08 10:33:28','2022-09-22 14:55:37'),(12,'temperature','equipment_suhu','Suhu','DAILY','0','2022-09-08 10:33:28','2022-09-22 14:55:37'),(13,'lighting','equipment_lighting','Lighting','MONTHLY','0','2022-09-08 10:33:28','2022-09-22 14:55:37'),(14,'escalator','equipment_escalator','Escalator','WEEKLY','0','2022-09-08 10:33:28','2022-09-22 14:55:37'),(15,'elevator','equipment_elevator','Elevator','WEEKLY','0','2022-09-08 10:33:28','2022-09-22 14:55:37'),(16,'dumbwaiter','equipment_dumbwaiter','Dumbwaiter','WEEKLY','0','2022-09-08 10:33:28','2022-09-22 14:55:37'),(17,'sanitary','equipment_sanitary','Sanitary','WEEKLY','0','2022-09-08 10:33:28','2022-09-22 14:55:37'),(18,'ups','equipment_ups','UPS','MONTHLY','0','2022-09-08 10:33:28','2022-09-22 13:48:15'),(19,'stp','equipment_stp','STP','DAILY','0','2022-09-08 10:33:28','2022-09-22 13:48:15'),(20,'cctv','equipment_cctv','CCTV','WEEKLY','0','2022-09-08 10:33:28','2022-09-22 13:48:15'),(21,'plumbing','equipment_plumbing','Plumbing','DAILY','0','2022-09-08 10:33:28','2022-09-22 13:48:15'),(22,'metersumber','equipment_metersumber','Meter Sumber dan Air Olahan','DAILY','0','2022-09-08 10:33:28','2022-09-22 13:48:15'),(23,'dindingpartisi','equipment_dindingpartisi','Dinding Partisi','MONTHLY','0','2022-09-08 10:33:28','2022-09-22 13:48:15'),(24,'pintu','equipment_pintu','Pintu','MONTHLY','0','2022-09-08 10:33:28','2022-09-22 13:48:15'),(25,'foldinggate','equipment_foldinggate','Folding Gate','MONTHLY','0','2022-09-08 10:33:28','2022-09-22 13:48:15'),(26,'rollingdoor','equipment_rollingdoor','Rolling Door','MONTHLY','0','2022-09-08 10:33:28','2022-09-22 13:48:15'),(27,'firefighting','equipment_firefighting','Fire Fighting','MONTHLY','0','2022-09-08 10:33:28','2022-09-22 13:48:15'),(28,'telppabx','equipment_telephonepabx','Telephone dan PABX','MONTHLY','0','2022-09-08 10:33:28','2022-09-22 13:48:15'),(29,'housekeeping','equipment_housekeeping','Housekeeping','DAILY','0','2022-09-08 10:33:28','2022-09-22 13:48:15'),(30,'gondola','equipment_gondola','Gondola','WEEKLY','0','2022-09-08 10:33:28','2022-09-22 13:48:15'),(31,'soundsystem','equipment_soundsystem','Sound System ','MONTHLY','0','2022-09-08 10:33:28','2022-09-22 13:48:15'),(32,'gasstation','equipment_gasstation','Gas Station','DAILY','0','2022-09-16 15:05:12','2022-09-22 13:48:15');
/*!40000 ALTER TABLE `tb_equipment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_gas_station`
--

DROP TABLE IF EXISTS `tb_gas_station`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_gas_station` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location` int(11) NOT NULL,
  `time` time DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_gas_station`
--

LOCK TABLES `tb_gas_station` WRITE;
/*!40000 ALTER TABLE `tb_gas_station` DISABLE KEYS */;
INSERT INTO `tb_gas_station` VALUES (4,2,'13:00:00','2022-09-13',12,'DAILY',12.00,'1','0','1','43','2022-09-13 10:49:12','2022-09-13 11:17:00'),(10,1,'10:00:00','2022-09-28',12,'WEEKLY',12.00,'1','1','1','34','2022-09-28 08:02:23','2022-09-28 08:02:23'),(11,1,'19:00:00','2022-09-28',12,'WEEKLY',56.00,'1','0','0','78','2022-09-28 08:03:08','2022-09-28 08:06:30');
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
  `time` time DEFAULT NULL,
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
INSERT INTO `tb_plumbing` VALUES (3,1,'08:00:00','2022-09-16',12,'DAILY','0','1','0',3.00,'0',2.00,'0','0','0','0','0','0','sfse','2022-09-16 14:05:16','2022-09-28 10:12:48');
/*!40000 ALTER TABLE `tb_plumbing` ENABLE KEYS */;
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
  `time` time DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_cctv`
--

LOCK TABLES `tb_cctv` WRITE;
/*!40000 ALTER TABLE `tb_cctv` DISABLE KEYS */;
INSERT INTO `tb_cctv` VALUES (7,1,'18:00:00','2022-09-20',12,'WEEKLY','DVR1','0','1','1',2.00,2,'222',2,'2','2022-09-19 14:51:51','2022-09-28 10:11:30'),(8,1,'10:00:00','2022-09-19',12,'WEEKLY','DVR1','1','1','1',2.00,2,'222',2,'2','2022-09-19 14:51:51','2022-09-19 15:05:21');
/*!40000 ALTER TABLE `tb_cctv` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_fire_fighting`
--

DROP TABLE IF EXISTS `tb_fire_fighting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_fire_fighting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location` int(11) NOT NULL,
  `time` time DEFAULT NULL,
  `date` date NOT NULL,
  `worker` int(11) NOT NULL,
  `equipment_checklist` enum('DAILY','WEEKLY','MONTHLY') NOT NULL,
  `type` varchar(30) DEFAULT NULL,
  `jumlah_zona` int(10) DEFAULT NULL,
  `mcfa_normal` enum('0','1') DEFAULT '0',
  `mcfa_alarm_silenced` enum('0','1') DEFAULT '0',
  `mcfa_fire` enum('0','1') DEFAULT '0',
  `mcfa_trouble` enum('0','1') DEFAULT '0',
  `lt1_smoke_detector` enum('0','1') DEFAULT NULL,
  `lt1_heat_detector` enum('0','1') DEFAULT NULL,
  `lt1_flow_switch` enum('0','1') DEFAULT NULL,
  `hydrant_pillar` enum('0','1') DEFAULT NULL,
  `siamese_connection` enum('0','1') DEFAULT NULL,
  `lampu_dan_bell` enum('0','1') DEFAULT NULL,
  `break_glass` enum('0','1') DEFAULT NULL,
  `jumlah_temuan` int(11) DEFAULT NULL,
  `penjelasan` varchar(2000) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lt2_smoke_detector` enum('0','1') DEFAULT NULL,
  `lt2_heat_detector` enum('0','1') DEFAULT NULL,
  `lt2_flow_switch` enum('0','1') DEFAULT NULL,
  `lt3_smoke_detector` enum('0','1') DEFAULT NULL,
  `lt3_heat_detector` enum('0','1') DEFAULT NULL,
  `lt3_flow_switch` enum('0','1') DEFAULT NULL,
  `lt4_smoke_detector` enum('0','1') DEFAULT NULL,
  `lt4_heat_detector` enum('0','1') DEFAULT NULL,
  `lt4_flow_switch` enum('0','1') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tb_fire_fighting_FK` (`location`),
  KEY `tb_fire_fighting_FK_1` (`worker`),
  CONSTRAINT `tb_fire_fighting_FK` FOREIGN KEY (`location`) REFERENCES `tb_store` (`idStore`) ON UPDATE CASCADE,
  CONSTRAINT `tb_fire_fighting_FK_1` FOREIGN KEY (`worker`) REFERENCES `tb_user` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_fire_fighting`
--

LOCK TABLES `tb_fire_fighting` WRITE;
/*!40000 ALTER TABLE `tb_fire_fighting` DISABLE KEYS */;
INSERT INTO `tb_fire_fighting` VALUES (3,1,NULL,'2022-08-21',12,'MONTHLY','sesedit',234,'1','1',NULL,NULL,'0','1','1','0','0','0','0',15,'lalalaup','2022-09-21 10:23:24','2022-09-21 10:30:44','1','0','0','0','0','0','0','0','0'),(4,1,NULL,'2022-09-28',12,'MONTHLY','baru',4,NULL,'1','1',NULL,'0','1','1','1','1','1','1',1,'smoke rusak','2022-09-28 10:56:18','2022-09-28 10:57:29','1','1','1','1','1','1','1','1','1');
/*!40000 ALTER TABLE `tb_fire_fighting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_sound_system`
--

DROP TABLE IF EXISTS `tb_sound_system`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_sound_system` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location` int(11) NOT NULL,
  `time` time DEFAULT NULL,
  `date` date NOT NULL,
  `worker` int(11) NOT NULL,
  `equipment_checklist` enum('DAILY','WEEKLY','MONTHLY') NOT NULL,
  `amplifier` enum('0','1') DEFAULT NULL,
  `mixer` enum('0','1') DEFAULT NULL,
  `radio_fm` enum('0','1') DEFAULT NULL,
  `cd_mp3_player` enum('0','1') DEFAULT NULL,
  `switch_zone` enum('0','1') DEFAULT NULL,
  `mic_announcer` enum('0','1') DEFAULT NULL,
  `speaker_jumlah` int(11) DEFAULT NULL,
  `speaker_keterangan` varchar(500) DEFAULT NULL,
  `car_call` enum('0','1') DEFAULT NULL,
  `emergency_evac_system` enum('0','1') DEFAULT NULL,
  `keterangan` varchar(2000) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `tb_sound_system_FK` (`location`),
  KEY `tb_sound_system_FK_1` (`worker`),
  CONSTRAINT `tb_sound_system_FK` FOREIGN KEY (`location`) REFERENCES `tb_store` (`idStore`) ON UPDATE CASCADE,
  CONSTRAINT `tb_sound_system_FK_1` FOREIGN KEY (`worker`) REFERENCES `tb_user` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_sound_system`
--

LOCK TABLES `tb_sound_system` WRITE;
/*!40000 ALTER TABLE `tb_sound_system` DISABLE KEYS */;
INSERT INTO `tb_sound_system` VALUES (2,1,NULL,'2022-08-22',12,'MONTHLY','0','0','0','0','0','0',12,'bagus edit','1','0','bagus','2022-09-22 11:21:18','2022-09-28 11:03:03'),(3,1,NULL,'2022-09-28',12,'MONTHLY','0','1','1','1','1','1',0,'ok','1','1','amp rusak','2022-09-28 11:03:34','2022-09-28 11:04:25');
/*!40000 ALTER TABLE `tb_sound_system` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_dinding_partisi`
--

DROP TABLE IF EXISTS `tb_dinding_partisi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_dinding_partisi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location` int(11) NOT NULL,
  `time` time DEFAULT NULL,
  `date` date NOT NULL,
  `worker` int(11) NOT NULL,
  `equipment_checklist` enum('DAILY','WEEKLY','MONTHLY') NOT NULL DEFAULT 'DAILY',
  `ruang` varchar(30) DEFAULT NULL,
  `lantai` char(2) DEFAULT NULL,
  `cat` enum('0','1') DEFAULT NULL,
  `kaca` enum('0','1') DEFAULT NULL,
  `kusen` enum('0','1') DEFAULT NULL,
  `wallpaper` enum('0','1') DEFAULT NULL,
  `jumlah_temuan` int(11) DEFAULT NULL,
  `penjelasan` varchar(2000) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `tb_dinding_partisi_FK` (`location`),
  KEY `tb_dinding_partisi_FK_1` (`worker`),
  CONSTRAINT `tb_dinding_partisi_FK` FOREIGN KEY (`location`) REFERENCES `tb_store` (`idStore`) ON UPDATE CASCADE,
  CONSTRAINT `tb_dinding_partisi_FK_1` FOREIGN KEY (`worker`) REFERENCES `tb_user` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_dinding_partisi`
--

LOCK TABLES `tb_dinding_partisi` WRITE;
/*!40000 ALTER TABLE `tb_dinding_partisi` DISABLE KEYS */;
INSERT INTO `tb_dinding_partisi` VALUES (2,1,NULL,'2022-08-19',12,'MONTHLY','adw','1','1','1','1','1',3,'awa','2022-09-19 13:48:44','2022-09-19 13:49:21'),(4,1,NULL,'2022-09-28',12,'MONTHLY','sit','6','0','1','1','1',1,'cat rusak','2022-09-28 10:14:39','2022-09-28 10:15:14');
/*!40000 ALTER TABLE `tb_dinding_partisi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_gondola`
--

DROP TABLE IF EXISTS `tb_gondola`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_gondola` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location` int(11) NOT NULL,
  `time` time DEFAULT NULL,
  `date` date NOT NULL,
  `worker` int(11) NOT NULL,
  `equipment_checklist` enum('DAILY','WEEKLY','MONTHLY') NOT NULL,
  `paket_kontrol` enum('0','1') DEFAULT NULL,
  `motor_gerak_rail` enum('0','1') DEFAULT NULL,
  `motor_gerak_putar` enum('0','1') DEFAULT NULL,
  `motor_gerak_arm` enum('0','1') DEFAULT NULL,
  `motor_gerak_keranjang` enum('0','1') DEFAULT NULL,
  `wire_rope` enum('0','1') DEFAULT NULL,
  `safety_block` enum('0','1') DEFAULT NULL,
  `gear_box` enum('0','1') DEFAULT NULL,
  `noise` enum('0','1') DEFAULT NULL,
  `vibrasi` enum('0','1') DEFAULT NULL,
  `pelumasan` enum('0','1') DEFAULT NULL,
  `seragam` enum('0','1') DEFAULT NULL,
  `id_card` enum('0','1') DEFAULT NULL,
  `helmet` enum('0','1') DEFAULT NULL,
  `safety_glasses` enum('0','1') DEFAULT NULL,
  `full_body_harnetz` enum('0','1') DEFAULT NULL,
  `auto_stop` enum('0','1') DEFAULT NULL,
  `carbiner` enum('0','1') DEFAULT NULL,
  `sarung_tangan` enum('0','1') DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `tb_gondola_FK` (`worker`),
  KEY `tb_gondola_FK_1` (`location`),
  CONSTRAINT `tb_gondola_FK` FOREIGN KEY (`worker`) REFERENCES `tb_user` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `tb_gondola_FK_1` FOREIGN KEY (`location`) REFERENCES `tb_store` (`idStore`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_gondola`
--

LOCK TABLES `tb_gondola` WRITE;
/*!40000 ALTER TABLE `tb_gondola` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_gondola` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_pintu`
--

DROP TABLE IF EXISTS `tb_pintu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_pintu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location` int(11) NOT NULL,
  `time` time DEFAULT NULL,
  `date` date NOT NULL,
  `worker` int(11) NOT NULL,
  `equipment_checklist` enum('DAILY','WEEKLY','MONTHLY') NOT NULL,
  `ruang` varchar(30) DEFAULT NULL,
  `lantai` char(2) DEFAULT NULL,
  `cat` enum('0','1') DEFAULT NULL,
  `kunci` enum('0','1') DEFAULT NULL,
  `kusen` enum('0','1') DEFAULT NULL,
  `handle_pintu` enum('0','1') DEFAULT NULL,
  `engsel` enum('0','1') DEFAULT NULL,
  `jumlah_temuan` int(11) DEFAULT NULL,
  `penjelasan` varchar(2000) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `tb_pintu_FK` (`worker`),
  KEY `tb_pintu_FK_1` (`location`),
  CONSTRAINT `tb_pintu_FK` FOREIGN KEY (`worker`) REFERENCES `tb_user` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `tb_pintu_FK_1` FOREIGN KEY (`location`) REFERENCES `tb_store` (`idStore`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_pintu`
--

LOCK TABLES `tb_pintu` WRITE;
/*!40000 ALTER TABLE `tb_pintu` DISABLE KEYS */;
INSERT INTO `tb_pintu` VALUES (3,1,NULL,'2022-08-20',12,'MONTHLY','satu','1','1','1','0','1','1',1,'kusen rusak','2022-09-20 09:05:07','2022-09-20 09:05:22'),(4,1,NULL,'2022-09-28',12,'MONTHLY','sit','6','1','0','1','1','1',1,'gabisa dikunci','2022-09-28 10:16:34','2022-09-28 10:17:27');
/*!40000 ALTER TABLE `tb_pintu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_meter_sumber_dan_air_olahan`
--

DROP TABLE IF EXISTS `tb_meter_sumber_dan_air_olahan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_meter_sumber_dan_air_olahan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location` int(11) NOT NULL,
  `time` time DEFAULT NULL,
  `date` date NOT NULL,
  `worker` int(11) NOT NULL,
  `equipment_checklist` enum('DAILY','WEEKLY','MONTHLY') NOT NULL DEFAULT 'DAILY',
  `meter_pdam_floating_valve` enum('0','1') DEFAULT NULL,
  `meter_pdam_m3` decimal(10,2) DEFAULT NULL COMMENT 'M Cubic',
  `meter_deep_well_m3` decimal(10,2) DEFAULT NULL COMMENT 'M Cubic',
  `meter_air_effluent_m3` decimal(10,2) DEFAULT NULL COMMENT 'M Cubic',
  `keterangan` varchar(2000) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `tb_meter_sumber_dan_air_olahan_FK` (`location`),
  KEY `tb_meter_sumber_dan_air_olahan_FK_1` (`worker`),
  CONSTRAINT `tb_meter_sumber_dan_air_olahan_FK` FOREIGN KEY (`location`) REFERENCES `tb_store` (`idStore`) ON UPDATE CASCADE,
  CONSTRAINT `tb_meter_sumber_dan_air_olahan_FK_1` FOREIGN KEY (`worker`) REFERENCES `tb_user` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_meter_sumber_dan_air_olahan`
--

LOCK TABLES `tb_meter_sumber_dan_air_olahan` WRITE;
/*!40000 ALTER TABLE `tb_meter_sumber_dan_air_olahan` DISABLE KEYS */;
INSERT INTO `tb_meter_sumber_dan_air_olahan` VALUES (2,1,'19:00:00','2022-09-19',12,'DAILY','1',77.00,66.00,55.00,'fnftb','2022-09-19 10:15:36','2022-09-19 10:15:36'),(3,1,'13:00:00','2022-09-19',12,'DAILY','1',33.00,44.00,55.00,'ttt','2022-09-19 10:15:55','2022-09-19 10:15:55'),(4,1,NULL,'2022-09-27',12,'MONTHLY','1',12.00,34.00,56.00,'bulanan','2022-09-27 11:20:35','2022-09-27 11:20:35');
/*!40000 ALTER TABLE `tb_meter_sumber_dan_air_olahan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_folding_gate`
--

DROP TABLE IF EXISTS `tb_folding_gate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_folding_gate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location` int(11) NOT NULL,
  `time` time DEFAULT NULL,
  `date` date NOT NULL,
  `worker` int(11) NOT NULL,
  `equipment_checklist` enum('DAILY','WEEKLY','MONTHLY') NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `kunci_set` enum('0','1') DEFAULT NULL,
  `daun` enum('0','1') DEFAULT NULL,
  `silangan` enum('0','1') DEFAULT NULL,
  `rangka_cnp` enum('0','1') DEFAULT NULL,
  `rangka_unp` enum('0','1') DEFAULT NULL,
  `handle` enum('0','1') DEFAULT NULL,
  `roda_bearing` enum('0','1') DEFAULT NULL,
  `rel` enum('0','1') DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `jumlah_temuan` int(11) DEFAULT NULL,
  `penjelasan` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tb_folding_gate_FK` (`location`),
  KEY `tb_folding_gate_FK_1` (`worker`),
  CONSTRAINT `tb_folding_gate_FK` FOREIGN KEY (`location`) REFERENCES `tb_store` (`idStore`) ON UPDATE CASCADE,
  CONSTRAINT `tb_folding_gate_FK_1` FOREIGN KEY (`worker`) REFERENCES `tb_user` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_folding_gate`
--

LOCK TABLES `tb_folding_gate` WRITE;
/*!40000 ALTER TABLE `tb_folding_gate` DISABLE KEYS */;
INSERT INTO `tb_folding_gate` VALUES (2,1,NULL,'2022-08-20',12,'MONTHLY','nmz','0','0','0','0','0','1','1','1','2022-09-20 11:03:59','2022-09-28 10:26:09',4,'asad'),(3,1,NULL,'2022-09-28',12,'MONTHLY','gate sit','1','1','1','1','1','1','1','0','2022-09-28 10:26:40','2022-09-28 10:27:44',1,'rel rusak');
/*!40000 ALTER TABLE `tb_folding_gate` ENABLE KEYS */;
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
  `time` time DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_stp`
--

LOCK TABLES `tb_stp` WRITE;
/*!40000 ALTER TABLE `tb_stp` DISABLE KEYS */;
INSERT INTO `tb_stp` VALUES (1,1,'13:00:00','2022-09-28',12,'DAILY','0','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1',7.00,'bagus semua','2022-09-28 09:53:42','2022-09-28 10:02:14');
/*!40000 ALTER TABLE `tb_stp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_telephone_pabx`
--

DROP TABLE IF EXISTS `tb_telephone_pabx`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_telephone_pabx` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location` int(11) NOT NULL,
  `time` time DEFAULT NULL,
  `date` date NOT NULL,
  `worker` int(11) NOT NULL,
  `equipment_checklist` enum('DAILY','WEEKLY','MONTHLY') NOT NULL,
  `ruang` varchar(30) DEFAULT NULL,
  `lantai` varchar(30) DEFAULT NULL,
  `line_co` enum('0','1') DEFAULT NULL,
  `line_ext` enum('0','1') DEFAULT NULL,
  `microphone` enum('0','1') DEFAULT NULL,
  `kabel_handle` enum('0','1') DEFAULT NULL,
  `speaker` enum('0','1') DEFAULT NULL,
  `roset` enum('0','1') DEFAULT NULL,
  `jumlah_temuan` int(11) DEFAULT NULL,
  `penjelasan` varchar(2000) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `layar_display` enum('0','1') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tb_telephone_pbax_FK` (`worker`),
  KEY `tb_telephone_pbax_FK_1` (`location`),
  CONSTRAINT `tb_telephone_pbax_FK` FOREIGN KEY (`worker`) REFERENCES `tb_user` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `tb_telephone_pbax_FK_1` FOREIGN KEY (`location`) REFERENCES `tb_store` (`idStore`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_telephone_pabx`
--

LOCK TABLES `tb_telephone_pabx` WRITE;
/*!40000 ALTER TABLE `tb_telephone_pabx` DISABLE KEYS */;
INSERT INTO `tb_telephone_pabx` VALUES (2,1,NULL,'2022-08-21',12,'MONTHLY','33','22','0','0','1','1','1','1',66,'111','2022-09-21 11:45:52','2022-09-28 10:58:04','1'),(3,1,NULL,'2022-09-28',12,'MONTHLY','sit','6','0','1','1','1','1','1',1,'line co rusak','2022-09-28 10:58:36','2022-09-28 10:59:38','1');
/*!40000 ALTER TABLE `tb_telephone_pabx` ENABLE KEYS */;
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
  `time` time DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_ups`
--

LOCK TABLES `tb_ups` WRITE;
/*!40000 ALTER TABLE `tb_ups` DISABLE KEYS */;
INSERT INTO `tb_ups` VALUES (8,1,NULL,'2022-08-22',12,'MONTHLY','lalaeditlg','123','2323','satu','2','untuk',12.00,34.00,56.00,77.00,8.00,'1','0',23,'sa','keteditlg','2022-09-22 11:19:17','2022-09-26 08:06:59'),(9,1,NULL,'2022-09-28',12,'MONTHLY','tes merk','tes type','1234567','sit','1','saya',200.00,300.00,4.00,5.00,6.00,'1','1',25,'yes','tes ket','2022-09-28 08:18:09','2022-09-28 08:18:09');
/*!40000 ALTER TABLE `tb_ups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_housekeeping`
--

DROP TABLE IF EXISTS `tb_housekeeping`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_housekeeping` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location` int(11) NOT NULL,
  `time` time DEFAULT NULL,
  `date` date NOT NULL,
  `worker` int(11) NOT NULL,
  `equipment_checklist` enum('DAILY','WEEKLY','MONTHLY') NOT NULL,
  `ruang` varchar(30) DEFAULT NULL,
  `lantai` varchar(3) DEFAULT NULL,
  `kloset` enum('0','1') DEFAULT NULL,
  `urinoir` enum('0','1') DEFAULT NULL,
  `washtafel` enum('0','1') DEFAULT NULL,
  `grease_trap` enum('0','1') DEFAULT NULL,
  `diffuser` enum('0','1') DEFAULT NULL,
  `kebersihan_lantai` enum('0','1') DEFAULT NULL,
  `dinding` enum('0','1') DEFAULT NULL,
  `cermin` enum('0','1') DEFAULT NULL,
  `tempat_sampah` enum('0','1') DEFAULT NULL,
  `floor_drainage` enum('0','1') DEFAULT NULL,
  `kap_lampu` enum('0','1') DEFAULT NULL,
  `hand_dryer` enum('0','1') DEFAULT NULL,
  `exhaust_fan` enum('0','1') DEFAULT NULL,
  `air_curtain` enum('0','1') DEFAULT NULL,
  `jumlah_temuan` int(11) DEFAULT NULL,
  `penjelasan` varchar(2000) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `plafond` enum('0','1') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tb_housekeeping_FK` (`location`),
  KEY `tb_housekeeping_FK_1` (`worker`),
  CONSTRAINT `tb_housekeeping_FK` FOREIGN KEY (`location`) REFERENCES `tb_store` (`idStore`) ON UPDATE CASCADE,
  CONSTRAINT `tb_housekeeping_FK_1` FOREIGN KEY (`worker`) REFERENCES `tb_user` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_housekeeping`
--

LOCK TABLES `tb_housekeeping` WRITE;
/*!40000 ALTER TABLE `tb_housekeeping` DISABLE KEYS */;
INSERT INTO `tb_housekeeping` VALUES (1,1,'13:00:00','2022-09-22',12,'DAILY','sit','6','1','1','1','1','1','1','1','1','1','1','1','1','1','1',0,'bagus','2022-09-22 11:46:00','2022-09-22 11:46:00','1'),(2,1,'13:00:00','2022-09-28',12,'DAILY','sit','6','0','1','1','1','1','1','1','1','1','1','1','1','1','1',1,'kloset kotor','2022-09-28 11:00:48','2022-09-28 11:01:39','1');
/*!40000 ALTER TABLE `tb_housekeeping` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_rolling_door`
--

DROP TABLE IF EXISTS `tb_rolling_door`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_rolling_door` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location` int(11) NOT NULL,
  `time` time DEFAULT NULL,
  `date` date NOT NULL,
  `worker` int(11) NOT NULL,
  `equipment_checklist` enum('DAILY','WEEKLY','MONTHLY') NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `kunci_set` enum('0','1') DEFAULT NULL,
  `daun_slot` enum('0','1') DEFAULT NULL,
  `pulley` enum('0','1') DEFAULT NULL,
  `pegas` enum('0','1') DEFAULT NULL,
  `as_batang` enum('0','1') DEFAULT NULL,
  `side_bracket` enum('0','1') DEFAULT NULL,
  `bottom_t_rail` enum('0','1') DEFAULT NULL,
  `pilar_rel` enum('0','1') DEFAULT NULL,
  `jumlah_temuan` int(11) DEFAULT NULL,
  `penjelasan` varchar(2000) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `tb_rolling_door_FK` (`worker`),
  KEY `tb_rolling_door_FK_1` (`location`),
  CONSTRAINT `tb_rolling_door_FK` FOREIGN KEY (`worker`) REFERENCES `tb_user` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `tb_rolling_door_FK_1` FOREIGN KEY (`location`) REFERENCES `tb_store` (`idStore`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_rolling_door`
--

LOCK TABLES `tb_rolling_door` WRITE;
/*!40000 ALTER TABLE `tb_rolling_door` DISABLE KEYS */;
INSERT INTO `tb_rolling_door` VALUES (1,1,NULL,'2022-09-28',12,'MONTHLY','rol sit','0','0','0','0','0','0','0','1',9,'rel fix','2022-09-28 10:28:25','2022-09-28 10:53:49');
/*!40000 ALTER TABLE `tb_rolling_door` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-09-28 11:23:40

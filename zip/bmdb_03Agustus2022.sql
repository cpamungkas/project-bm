/*
SQLyog Enterprise v13.1.1 (64 bit)
MySQL - 10.4.24-MariaDB : Database - bmdb
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`bmdb` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `b22_32302576_bmapp`;

/*Table structure for table `tb_kwhmeter1` */

DROP TABLE IF EXISTS `tb_kwhmeter1`;

CREATE TABLE `tb_kwhmeter1` (
  `idkwhmeter1` int(11) NOT NULL AUTO_INCREMENT COMMENT ' ',
  `kwhmeter1` double NOT NULL,
  `user_created` varchar(255) NOT NULL,
  `date_created` int(11) NOT NULL,
  `date_updated` int(11) DEFAULT NULL,
  `status_deleted` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`idkwhmeter1`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_kwhmeter1` */

insert  into `tb_kwhmeter1`(`idkwhmeter1`,`kwhmeter1`,`user_created`,`date_created`,`date_updated`,`status_deleted`) values 
(1,0,'cpamungkas',1622622485,NULL,0),
(2,2.2,'cpamungkas',1634930801,NULL,0),
(3,41.5,'cpamungkas',1622622485,NULL,0),
(4,53,'cpamungkas',1634930801,NULL,0),
(5,66,'cpamungkas',1622622485,NULL,0),
(6,82.5,'cpamungkas',1622622485,NULL,0),
(7,105,'cpamungkas',1622622485,NULL,0),
(8,131,'cpamungkas',1634930801,NULL,0),
(9,135,'cpamungkas',1622622485,NULL,0),
(10,147,'cpamungkas',1622622485,NULL,0),
(11,164,'cpamungkas',1622622485,NULL,0),
(12,165,'cpamungkas',1622622485,NULL,0),
(13,197,'cpamungkas',1622622485,NULL,0),
(14,240,'cpamungkas',1622622485,NULL,0),
(15,270,'cpamungkas',1622622485,NULL,0),
(16,345,'cpamungkas',1634930801,NULL,0),
(17,415,'cpamungkas',1622622485,NULL,0),
(18,555,'cpamungkas',1634930801,NULL,0),
(19,865,'cpamungkas',1622622485,NULL,0),
(20,1110,'cpamungkas',1634930801,NULL,0),
(21,1240,'cpamungkas',1622622485,NULL,0),
(22,1250,'cpamungkas',1634930801,NULL,0),
(23,1358,'cpamungkas',1622622485,NULL,0);

/*Table structure for table `tb_kwhmeter2` */

DROP TABLE IF EXISTS `tb_kwhmeter2`;

CREATE TABLE `tb_kwhmeter2` (
  `idkwhmeter2` int(11) NOT NULL AUTO_INCREMENT,
  `kwhmeter2` double NOT NULL,
  `user_created` varchar(255) NOT NULL,
  `date_created` int(11) NOT NULL,
  `date_updated` int(11) DEFAULT NULL,
  `status_deleted` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`idkwhmeter2`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_kwhmeter2` */

insert  into `tb_kwhmeter2`(`idkwhmeter2`,`kwhmeter2`,`user_created`,`date_created`,`date_updated`,`status_deleted`) values 
(1,0,'cpamungkas',1622622485,NULL,0),
(2,2.2,'cpamungkas',1622622485,NULL,0),
(3,82.5,'cpamungkas',1622622485,NULL,0),
(4,147,'cpamungkas',1622622485,NULL,0),
(5,197,'cpamungkas',1622622485,NULL,0);

/*Table structure for table `tb_level` */

DROP TABLE IF EXISTS `tb_level`;

CREATE TABLE `tb_level` (
  `idLevel` int(11) NOT NULL AUTO_INCREMENT,
  `Level` varchar(255) NOT NULL,
  `menu_access` int(11) NOT NULL,
  `date_created` int(11) NOT NULL,
  `date_updated` int(11) NOT NULL,
  `status_deleted` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`idLevel`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_level` */

insert  into `tb_level`(`idLevel`,`Level`,`menu_access`,`date_created`,`date_updated`,`status_deleted`) values 
(1,'Admin',0,1657598405,1657598405,0),
(2,'Manager',0,1657599918,1657599918,0),
(3,'Viewer',0,1657599922,1657599922,0),
(4,'User Level Baru',0,1657600236,1657607167,0),
(5,'Nyoba Level Baru Coba Delete',1,1657602437,1657603095,1);

/*Table structure for table `tb_role` */

DROP TABLE IF EXISTS `tb_role`;

CREATE TABLE `tb_role` (
  `idRole` int(11) NOT NULL AUTO_INCREMENT,
  `idLevel` int(11) NOT NULL,
  `idStore` int(11) NOT NULL,
  `idSuperiorRole` int(11) NOT NULL,
  `Role` varchar(255) NOT NULL,
  PRIMARY KEY (`idRole`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_role` */

/*Table structure for table `tb_shift` */

DROP TABLE IF EXISTS `tb_shift`;

CREATE TABLE `tb_shift` (
  `idShift` int(11) NOT NULL AUTO_INCREMENT,
  `shift` varchar(5) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `date_created` int(11) DEFAULT NULL,
  `date_updated` int(11) DEFAULT NULL,
  `date_deleted` int(11) DEFAULT NULL,
  `status_deleted` int(11) DEFAULT NULL,
  PRIMARY KEY (`idShift`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_shift` */

insert  into `tb_shift`(`idShift`,`shift`,`description`,`date_created`,`date_updated`,`date_deleted`,`status_deleted`) values 
(1,'P','Pagi (08.00-15.00)',1659229112,NULL,NULL,0),
(2,'S','Siang (14.30-22.00)',1659229112,NULL,NULL,0),
(3,'M','Malam (21.30-05.30)',1659229112,NULL,NULL,0),
(4,'O','Off/Libur',1659229112,NULL,NULL,0),
(5,'L','Lembur',1659229112,NULL,NULL,0),
(6,'CT','Cuti',1659229112,NULL,NULL,0),
(7,'OP','Off Pengganti',1659229112,NULL,NULL,0),
(8,'DLK','Dinas Luar Kota',1659229112,NULL,NULL,0);

/*Table structure for table `tb_store` */

DROP TABLE IF EXISTS `tb_store`;

CREATE TABLE `tb_store` (
  `idStore` int(11) NOT NULL AUTO_INCREMENT,
  `StoreName` varchar(255) NOT NULL,
  `StoreCode` int(5) NOT NULL,
  `KWHMeter1` decimal(10,0) NOT NULL,
  `KWHMeter2` decimal(10,0) DEFAULT NULL,
  `idPLN1` varchar(15) NOT NULL,
  `idPLN2` varchar(15) DEFAULT NULL,
  `date_created` int(11) DEFAULT NULL,
  `date_updated` int(11) DEFAULT NULL,
  `date_deleted` int(11) DEFAULT NULL,
  `status_deleted` int(1) DEFAULT NULL,
  PRIMARY KEY (`idStore`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_store` */

insert  into `tb_store`(`idStore`,`StoreName`,`StoreCode`,`KWHMeter1`,`KWHMeter2`,`idPLN1`,`idPLN2`,`date_created`,`date_updated`,`date_deleted`,`status_deleted`) values 
(1,'Gramedia Matramansfsdfs',10180,17,1,'0','0',1657481039,1659432787,NULL,0),
(2,'Gramedia Sudirman',10119,10,1,'1234567890','0',1657479291,1659328258,NULL,0),
(3,'Gramedia Harapan Indah',10120,13,1,'1478523690','0',1657479291,1659328140,NULL,0),
(4,'Gramedia Mega Bekasi',10128,8,1,'1258963470','0',1657479291,1659328273,NULL,0),
(5,'Gramedia Panandaran',10100,10,1,'1597423680','0',1657479291,1659341995,NULL,0),
(6,'Gramedia Slamet Riyadi',10121,14,1,'1793248650','0',1657479291,1657479291,NULL,0),
(7,'Gramedia Bale Kota',10166,11,1,'1346798520','0',1657479291,1659406836,NULL,0),
(8,'Gramedia CIbinong',10145,6,1,'9632147850','0',1657483651,1659406850,NULL,0),
(9,'Gramedia Harapan Indah 2',12457,5,2,'9874632122','31124445722',1657505103,1659347166,1659347166,1),
(10,'Gramedia Karawang',12345,7,1,'523010223945','0',1658126318,1658126318,NULL,0),
(11,'Gramedia Rita Purwokerto',54321,9,1,'852014796302','0',1658170076,1658170076,NULL,0),
(12,'Gramedia Panakukang',96325,7,1,'789654123012','0',1658172747,1658174641,NULL,0),
(13,'Gramedia Harapan Indah 3',12345,11,1,'523010223945','0',1658769092,1659347147,1659347147,1),
(14,'Gramedia Bintaro',10161,18,1,'548400530366','0',1659081155,1659081155,NULL,0),
(15,'Gramedia Pintu Air',10101,13,1,'1010110101','0',1659411374,1659411625,NULL,0),
(16,'Gramedia Surabaya Manyar',10111,13,1,'10111','0',1659412102,1659412102,NULL,0),
(17,'Gramedia Bekasi Mal Metropolitan',10123,14,1,'101231012310','0',1659422368,1659422390,NULL,0),
(18,'Gramedia Mal Pondok Indah',10115,17,4,'101151011510','101151011510',1659425014,1659428140,NULL,0);

/*Table structure for table `tb_superior_name` */

DROP TABLE IF EXISTS `tb_superior_name`;

CREATE TABLE `tb_superior_name` (
  `idSuperior` int(11) NOT NULL AUTO_INCREMENT,
  `idSuperiorRole` int(11) NOT NULL,
  `SuperiorName` varchar(255) NOT NULL,
  `date_created` int(11) DEFAULT NULL,
  `date_updated` int(11) NOT NULL,
  `status_deleted` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`idSuperior`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_superior_name` */

insert  into `tb_superior_name`(`idSuperior`,`idSuperiorRole`,`SuperiorName`,`date_created`,`date_updated`,`status_deleted`) values 
(1,3,'R. Krisna Wardhana',1657701833,1657701833,0),
(2,4,'IR. Heru Yudianto',1657701853,1657701853,0),
(3,4,'Adhy Prasetyo',1657701873,1657701873,0),
(4,5,'Junaidi',1657702005,1657702005,0),
(5,5,'Wahyu Mardiansyah',1657702030,1657702030,0),
(6,6,'Supriadi',1657702050,1657702050,0),
(7,7,'Edy Supriadi',1657702075,1657702075,0),
(8,7,'Yulianto',1657702108,1657702108,0),
(9,7,'Samtari Hasbi',1657702127,1657702127,0),
(10,7,'Koesni Harijanto',1657702145,1657702145,0),
(11,7,'Giyarno Ahmad Sanusi',1657702162,1657702162,0),
(12,7,'Suwito',1657702174,1657702174,0),
(13,7,'Fadhil Hadi Jatmiko',1657702188,1657702188,0),
(14,7,'Candra Mas Bayu Putra P',1657702218,1657702218,0),
(15,7,'Muh. Ali Mufrodi',1657702233,1657702233,0),
(16,7,'Nur Cahyadi Sunanta',1657702249,1657702249,0),
(17,7,'Palma Aditya Novanda',1657702265,1657702265,0),
(18,7,'Hendro Prasetyo Utomo',1657702284,1657702284,0),
(19,8,'Achmad Basori',1657702311,1657702311,0),
(20,9,'Tuyono',1657702330,1657702330,0),
(21,10,'Kasiman',1657702364,1657702364,0),
(22,10,'Eko Bimo Sutopo',1657702433,1657702433,0),
(23,10,'Sunarko',1657702480,1657702480,0),
(24,10,'Gatot Sumi Arianto',1657702500,1657702500,0),
(25,10,'Purwanto',1657702516,1657702516,0),
(26,10,'Sipit Priyantoro',1657702532,1657702532,0),
(27,10,'Mahdi Amin Umar',1657702672,1657702672,0),
(28,10,'Yohanes Usman',1657702720,1657702720,0),
(29,10,'Bunga Pamilo Sunardi',1657702737,1657702737,0),
(30,10,'Eandi Apriansyah Ramadhan',1657702798,1657702798,0),
(31,10,'Medi Aryadi',1657702825,1657702825,0),
(32,10,'Muhajir',1657702841,1657702841,0),
(99,0,'None',1657702841,1657702841,0);

/*Table structure for table `tb_superior_role` */

DROP TABLE IF EXISTS `tb_superior_role`;

CREATE TABLE `tb_superior_role` (
  `idSuperiorRole` int(11) NOT NULL AUTO_INCREMENT,
  `SuperiorName` varchar(255) NOT NULL,
  `date_created` int(11) DEFAULT NULL,
  `status_deleted` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`idSuperiorRole`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_superior_role` */

insert  into `tb_superior_role`(`idSuperiorRole`,`SuperiorName`,`date_created`,`status_deleted`) values 
(1,'None',1657516393,0),
(2,'Building Maintenance Manager',1657516393,0),
(3,'Building Maintenance Ast. Manager',1657516393,0),
(4,'Building Operational Superintendent',1657516393,0),
(5,'Building Maintenance Superintendent',1657516393,0),
(6,'Building Operational Supervisor',1657516393,0),
(7,'Troubleshooting Supervisor',1657516393,0),
(8,'General Services Team Leader',1657516393,0),
(9,'General Services Supervisor',1657516393,0);

/*Table structure for table `tb_user` */

DROP TABLE IF EXISTS `tb_user`;

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nik` varchar(6) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `initial` varchar(5) DEFAULT NULL,
  `is_active` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `superior_role_id` int(11) NOT NULL,
  `superior_name_id` int(11) NOT NULL,
  `location` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `date_created` int(11) DEFAULT NULL,
  `date_updated` int(11) DEFAULT NULL,
  `date_deleted` int(11) DEFAULT NULL,
  `status_deleted` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_user` */

insert  into `tb_user`(`id`,`username`,`password`,`nik`,`name`,`email`,`image`,`initial`,`is_active`,`role_id`,`superior_role_id`,`superior_name_id`,`location`,`level`,`date_created`,`date_updated`,`date_deleted`,`status_deleted`) values 
(1,'cpamungkas','$2y$10$C90eIrdMzb3vCCU5CTM5oOA6s7Hhb.XBJZSd771Wgc3D.g6LLcNCK','020024','Charlie Pamungkas','cpamungkas@gramedia.com','default.jpg','',1,99,0,0,1,99,1654536480,1654536480,NULL,0),
(2,'kangcp','$2y$10$q/28knRQAy7rZUU.5HKRj.jgYaud9GqQuAfotWi4IdWnRGgCv9FBK','020025','kang CP','sit.gorpofficial@gmail.com','default.jpg','',1,2,0,0,1,3,1655659736,1655659736,NULL,0),
(3,'superintendent','$2y$10$daPnKRkkFBAPdheN4.N/K.DC0zx7Dtfqw6soV1Sqh82tvGY2g0i7m','020026','Kang Superintendent','superintendent@test.com','default.jpg','',1,1,0,0,2,1,1656265789,1656265789,NULL,0),
(4,'tatangcs','$2y$10$UHGqDGSajDnraULsj.Qnhe0DAJBc6poX1XioqYVQpiBLsYHMmj4IS','123456','Tatang','tatang@email.com',NULL,'Ta',1,5,7,7,8,2,1658094661,1658094661,NULL,0),
(5,'rudi123','$2y$10$QtxsY4UJ1HRZdv40veBKB.dFMSJbf30v/1d9qYtPOyL2GhKNZtgcO','020027','Rudihartono','',NULL,'RH',1,12,19,19,1,2,1658297308,1658996200,NULL,0),
(6,'alimufrodi@gramedia.com','$2y$10$ko4X0lQL0Opk4WRg4dx0zumqcViwnPgwd4TPCuDAiVibwm.y7Dlme','040309','MUH. ALI MUFRODI','alimufrodi@gramedia.com','default.jpg','AM',1,7,8,8,1,1,1658979087,1658995624,NULL,0),
(7,'Krisna Wardhana','$2y$10$C4881Xb6Ukdi5Ne/o0nNI.JzDXebiBVvzsGUFZ/pt93.vCZ2KGZo.','005198','Krisna Wardhana','krisna_pml@gramedia.com','default.jpg','',1,3,13,13,1,3,1658983859,1658983859,NULL,0);

/*Table structure for table `tb_user_access_menu` */

DROP TABLE IF EXISTS `tb_user_access_menu`;

CREATE TABLE `tb_user_access_menu` (
  `idusermenu` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  PRIMARY KEY (`idusermenu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_user_access_menu` */

/*Table structure for table `tb_user_menu` */

DROP TABLE IF EXISTS `tb_user_menu`;

CREATE TABLE `tb_user_menu` (
  `idusermenu` int(11) NOT NULL AUTO_INCREMENT,
  `menu` varchar(255) NOT NULL,
  PRIMARY KEY (`idusermenu`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_user_menu` */

insert  into `tb_user_menu`(`idusermenu`,`menu`) values 
(1,'Administrator'),
(2,'Superintendent'),
(3,'Worker'),
(4,'Report'),
(5,'Equipment'),
(6,'Schedule'),
(7,'Job Assignment');

/*Table structure for table `tb_user_role` */

DROP TABLE IF EXISTS `tb_user_role`;

CREATE TABLE `tb_user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `role` varchar(255) NOT NULL,
  `date_created` int(11) NOT NULL,
  `date_updated` int(11) NOT NULL,
  `status_deleted` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_user_role` */

insert  into `tb_user_role`(`id`,`role_id`,`role`,`date_created`,`date_updated`,`status_deleted`) values 
(1,99,'Administrator',1657598405,1657598405,0),
(2,1,'Superintendent',1657598405,1657599918,0),
(3,2,'Worker',1657598405,1657607167,0),
(4,3,'Building Maintenance Manager',1657618325,1657618325,0),
(5,4,'Building Maintenance Ast. Manager',1657618778,1657618778,0),
(6,5,'Building Operational Superintendent',1657618808,1657618808,0),
(7,6,'Building Maintenance Superintendent',1657618881,1657618881,0),
(8,7,'Building Operational Supervisor',1657618906,1657618906,0),
(9,8,'Troubleshooting Supervisor',1657618924,1657618924,0),
(10,9,'General Services Team Leader',1657618938,1657618938,0),
(11,10,'General Services Supervisor',1657618953,1657619582,0),
(12,11,'Operational Technician',1657618970,1657619424,0),
(13,12,'Troubleshooting Technician',1657618984,1657619637,0),
(14,13,'None',1657686486,1657686486,0);

/*Table structure for table `tb_user_sub_menu` */

DROP TABLE IF EXISTS `tb_user_sub_menu`;

CREATE TABLE `tb_user_sub_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `is_active` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_user_sub_menu` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

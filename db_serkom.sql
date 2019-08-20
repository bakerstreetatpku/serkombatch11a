/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 10.1.38-MariaDB : Database - db_serkom
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `srk_dokter` */

DROP TABLE IF EXISTS `srk_dokter`;

CREATE TABLE `srk_dokter` (
  `dok_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `dok_nip` varchar(50) DEFAULT NULL,
  `dok_nama` varchar(150) DEFAULT NULL,
  `dok_jk` enum('Laki-Laki','Perempuan') DEFAULT NULL,
  `dok_jenis` enum('Umum','Spesialis') DEFAULT NULL,
  `dok_tempat_lahir` varchar(100) DEFAULT NULL,
  `dok_tgl_lahir` date DEFAULT NULL,
  `dok_alamat` varchar(150) DEFAULT NULL,
  `dok_telp` varchar(30) DEFAULT NULL,
  `dok_foto` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`dok_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `srk_dokter` */

LOCK TABLES `srk_dokter` WRITE;

insert  into `srk_dokter`(`dok_id`,`dok_nip`,`dok_nama`,`dok_jk`,`dok_jenis`,`dok_tempat_lahir`,`dok_tgl_lahir`,`dok_alamat`,`dok_telp`,`dok_foto`) values (1,'11224510','Rahman','Laki-Laki','Umum','Jakarta','1989-01-16','Jl. Suka Karya','081261137148','Umum.jpg');

UNLOCK TABLES;

/*Table structure for table `srk_login` */

DROP TABLE IF EXISTS `srk_login`;

CREATE TABLE `srk_login` (
  `log_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `log_user` varchar(50) DEFAULT NULL,
  `log_pass` varchar(50) DEFAULT NULL,
  `log_nama` varchar(100) DEFAULT NULL,
  `log_level` smallint(1) DEFAULT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `srk_login` */

LOCK TABLES `srk_login` WRITE;

insert  into `srk_login`(`log_id`,`log_user`,`log_pass`,`log_nama`,`log_level`) values (1,'admin','704b037a97fa9b25522b7c014c300f8a','Admin Sistem',1);

UNLOCK TABLES;

/*Table structure for table `srk_pasien` */

DROP TABLE IF EXISTS `srk_pasien`;

CREATE TABLE `srk_pasien` (
  `psn_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `psn_nama` varchar(150) DEFAULT NULL,
  `psn_gelar` enum('Mr.','Ms.','Mrs.') DEFAULT NULL,
  `psn_jk` enum('Laki-Laki','Perempuan') DEFAULT NULL,
  `psn_tempat_lahir` varchar(100) DEFAULT NULL,
  `psn_tgl_lahir` date DEFAULT NULL,
  `psn_alamat` text,
  `psn_jkitas` enum('KTP','SIM','Passport') DEFAULT NULL,
  `psn_nokitas` varchar(50) DEFAULT NULL,
  `psn_telp` varchar(50) DEFAULT NULL,
  `psn_pekerjaan` varchar(150) DEFAULT NULL,
  `psn_foto` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`psn_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `srk_pasien` */

LOCK TABLES `srk_pasien` WRITE;

insert  into `srk_pasien`(`psn_id`,`psn_nama`,`psn_gelar`,`psn_jk`,`psn_tempat_lahir`,`psn_tgl_lahir`,`psn_alamat`,`psn_jkitas`,`psn_nokitas`,`psn_telp`,`psn_pekerjaan`,`psn_foto`) values (1,'Rachman','Mr.','Laki-Laki','Jakarta','1989-01-16','Jl. Suka Karya','KTP','1472011601890041','081261137148',NULL,'Mr_.jpg'),(2,'Okfalisa','Mrs.','Laki-Laki','Jakarta','2003-01-01','Jl. Suka Karya','KTP','1472011601890041','081261137148',NULL,'Mrs_.jpg');

UNLOCK TABLES;

/*Table structure for table `srk_poly` */

DROP TABLE IF EXISTS `srk_poly`;

CREATE TABLE `srk_poly` (
  `ply_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ply_kode` varchar(20) DEFAULT NULL,
  `ply_nama` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`ply_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `srk_poly` */

LOCK TABLES `srk_poly` WRITE;

insert  into `srk_poly`(`ply_id`,`ply_kode`,`ply_nama`) values (1,'UM','Umum'),(2,'AN','Anak'),(3,'GI','Gigi');

UNLOCK TABLES;

/*Table structure for table `srk_polydokter` */

DROP TABLE IF EXISTS `srk_polydokter`;

CREATE TABLE `srk_polydokter` (
  `pdk_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `pdk_dok_id` bigint(20) DEFAULT NULL,
  `pdk_ply_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`pdk_id`),
  KEY `pdk_dok_id` (`pdk_dok_id`),
  KEY `pdk_ply_id` (`pdk_ply_id`),
  CONSTRAINT `srk_polydokter_ibfk_1` FOREIGN KEY (`pdk_dok_id`) REFERENCES `srk_dokter` (`dok_id`) ON DELETE CASCADE,
  CONSTRAINT `srk_polydokter_ibfk_2` FOREIGN KEY (`pdk_ply_id`) REFERENCES `srk_poly` (`ply_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `srk_polydokter` */

LOCK TABLES `srk_polydokter` WRITE;

insert  into `srk_polydokter`(`pdk_id`,`pdk_dok_id`,`pdk_ply_id`) values (1,1,3);

UNLOCK TABLES;

/*Table structure for table `srk_registrasi` */

DROP TABLE IF EXISTS `srk_registrasi`;

CREATE TABLE `srk_registrasi` (
  `reg_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `reg_tgl` date DEFAULT NULL,
  `reg_psn_id` bigint(20) DEFAULT NULL,
  `reg_jenis` enum('Umum','Spesialis') DEFAULT NULL,
  `reg_ply_id` bigint(20) DEFAULT NULL,
  `reg_dok_id` bigint(20) DEFAULT NULL,
  `reg_urut` int(11) DEFAULT NULL,
  PRIMARY KEY (`reg_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `srk_registrasi` */

LOCK TABLES `srk_registrasi` WRITE;

insert  into `srk_registrasi`(`reg_id`,`reg_tgl`,`reg_psn_id`,`reg_jenis`,`reg_ply_id`,`reg_dok_id`,`reg_urut`) values (9,'2019-08-20',1,'Umum',1,1,1),(10,'2019-08-20',1,'Umum',1,1,2),(12,'2019-08-20',1,'Umum',1,1,3),(13,'2019-08-13',1,'Umum',1,1,1);

UNLOCK TABLES;

/*Table structure for table `srk_spesialis` */

DROP TABLE IF EXISTS `srk_spesialis`;

CREATE TABLE `srk_spesialis` (
  `sps_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `sps_nama` varchar(100) DEFAULT NULL,
  `sps_gelar` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`sps_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `srk_spesialis` */

LOCK TABLES `srk_spesialis` WRITE;

insert  into `srk_spesialis`(`sps_id`,`sps_nama`,`sps_gelar`) values (1,'Anak','Sp.A'),(2,'Kandungan','Sp.OG');

UNLOCK TABLES;

/*Table structure for table `srk_spesialisdokter` */

DROP TABLE IF EXISTS `srk_spesialisdokter`;

CREATE TABLE `srk_spesialisdokter` (
  `sdk_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `sdk_dok_id` bigint(20) DEFAULT NULL,
  `sdk_sps_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`sdk_id`),
  KEY `sdk_dok_id` (`sdk_dok_id`),
  KEY `sdk_sps_id` (`sdk_sps_id`),
  CONSTRAINT `srk_spesialisdokter_ibfk_1` FOREIGN KEY (`sdk_dok_id`) REFERENCES `srk_dokter` (`dok_id`) ON DELETE CASCADE,
  CONSTRAINT `srk_spesialisdokter_ibfk_2` FOREIGN KEY (`sdk_sps_id`) REFERENCES `srk_spesialis` (`sps_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `srk_spesialisdokter` */

LOCK TABLES `srk_spesialisdokter` WRITE;

insert  into `srk_spesialisdokter`(`sdk_id`,`sdk_dok_id`,`sdk_sps_id`) values (1,1,1);

UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

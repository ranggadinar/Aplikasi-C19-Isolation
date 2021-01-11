/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.10-MariaDB : Database - tubes_ken
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `kategori` */

DROP TABLE IF EXISTS `kategori`;

CREATE TABLE `kategori` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(200) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

/*Data for the table `kategori` */

insert  into `kategori`(`id`,`nama_kategori`,`created_at`) values 
(9,'Klinik','2020-12-29 09:14:05'),
(10,'Rumah Sakit','2020-12-29 09:15:10'),
(11,'Hotel','2020-12-29 09:15:14'),
(12,'Bilik Karantina','2020-12-29 09:15:36');

/*Table structure for table `lokasi` */

DROP TABLE IF EXISTS `lokasi`;

CREATE TABLE `lokasi` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nama_lokasi` varchar(200) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

/*Data for the table `lokasi` */

insert  into `lokasi`(`id`,`nama_lokasi`,`created_at`) values 
(2,'Bandung','2020-12-29 09:38:57'),
(3,'Jakarta Utara','2020-12-29 09:39:04'),
(4,'Jakarta Pusat','2020-12-29 09:39:10'),
(5,'Bekasi','2020-12-29 09:39:17'),
(6,'Depok','2020-12-29 09:39:21'),
(7,'Tangerang','2020-12-29 09:39:25');

/*Table structure for table `tempat` */

DROP TABLE IF EXISTS `tempat`;

CREATE TABLE `tempat` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `kategori_id` int(10) DEFAULT NULL,
  `lokasi_id` int(10) DEFAULT NULL,
  `foto` varchar(200) DEFAULT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `harga` int(50) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `deskripsi` longtext DEFAULT NULL,
  `kuota` int(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kategori_id` (`kategori_id`),
  KEY `lokasi_id` (`lokasi_id`),
  CONSTRAINT `tempat_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tempat_ibfk_2` FOREIGN KEY (`lokasi_id`) REFERENCES `lokasi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tempat` */

insert  into `tempat`(`id`,`kategori_id`,`lokasi_id`,`foto`,`nama`,`harga`,`alamat`,`deskripsi`,`kuota`,`created_at`) values 
(5,12,6,'Online Doctor-bro.png','RS Mangunkusumos',12500,'Jl. Dago Atas No.532s','asdasd\r\n\r\n\r\nasdas\r\ndasdad',2,'2020-12-29 10:01:53'),
(6,11,6,'Veterinary-amico.png','asdas',54000,'asdas','asdas\r\nasd\r\nadasdasdasd\r\n\r\n\r\nasdasdad',8,'2020-12-31 04:04:25'),
(7,9,5,'Adopt a pet-pana.png','asdasd',500000,'asdasd','Tes PAsar',5,'2020-12-31 04:08:36');

/*Table structure for table `transaksi` */

DROP TABLE IF EXISTS `transaksi`;

CREATE TABLE `transaksi` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `kode_booking` varchar(50) DEFAULT NULL,
  `tempat_id` int(10) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  `nama_pasien` varchar(200) DEFAULT NULL,
  `no_hp_pasien` varchar(200) DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `durasi` int(50) DEFAULT NULL,
  `tanggal_pesan` datetime DEFAULT NULL,
  `tanggal_konfirmasi` datetime DEFAULT NULL,
  `status` enum('pending','selesai','tolak') DEFAULT 'pending',
  `total_transaksi` int(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `dokter_id` (`tempat_id`),
  CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`tempat_id`) REFERENCES `tempat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

/*Data for the table `transaksi` */

insert  into `transaksi`(`id`,`kode_booking`,`tempat_id`,`user_id`,`nama_pasien`,`no_hp_pasien`,`tanggal_mulai`,`tanggal_selesai`,`durasi`,`tanggal_pesan`,`tanggal_konfirmasi`,`status`,`total_transaksi`) values 
(5,'1708471369',5,1,'Bellatrix Lestrange','0831231','2020-12-31','2021-01-02',2,'2020-12-30 21:50:59','2020-12-31 03:57:12','selesai',25000),
(6,'1212058232',5,1,'Byorgue','089742132452','2020-12-31','2021-01-02',2,'2020-12-31 04:23:59','2020-12-31 04:25:41','tolak',25000),
(7,'997393517',5,1,'Jenkies','089232141234','2020-12-31','2021-01-01',1,'2020-12-31 04:29:23','2020-12-31 04:30:29','selesai',12500);

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nama` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `no_hp` varchar(200) DEFAULT NULL,
  `akses` enum('user','admin') DEFAULT 'user',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `user` */

insert  into `user`(`id`,`nama`,`email`,`password`,`no_hp`,`akses`) values 
(1,'Muhammad Ilhams','user@gmail.com','123456','083181','user'),
(4,'Kenny','kenny@gmail.com','123456','08318182','admin'),
(5,'Bellatrix Lestranges','bella@gmail.com','123456789','0831818264881','user');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

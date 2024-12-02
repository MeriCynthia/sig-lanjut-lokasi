-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 8.0.30 - MySQL Community Server - GPL
-- OS Server:                    Win64
-- HeidiSQL Versi:               12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Membuang struktur basisdata untuk pois_db
DROP DATABASE IF EXISTS `pois_db`;
CREATE DATABASE IF NOT EXISTS `pois_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `pois_db`;

-- membuang struktur untuk table pois_db.produk
DROP TABLE IF EXISTS `produk`;
CREATE TABLE IF NOT EXISTS `produk` (
  `id` char(13) NOT NULL DEFAULT '',
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Membuang data untuk tabel pois_db.produk: ~5 rows (lebih kurang)
DELETE FROM `produk`;
INSERT INTO `produk` (`id`, `name`) VALUES
  ('2234567890120', 'Cleo 100ml'),
  ('2234567890121', 'Golden Bread'),
  ('1234567890123', 'Lemonade 250ml'),
  ('1234567890124', 'Tokyo Juice 250ml'),
  ('2234567890129', 'Pure Water');


-- membuang struktur untuk table pois_db.toko
DROP TABLE IF EXISTS `toko`;
CREATE TABLE IF NOT EXISTS `toko` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `lat` double DEFAULT NULL,
  `lng` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Membuang data untuk tabel pois_db.toko: ~7 rows (lebih kurang)
DELETE FROM `toko`;
INSERT INTO `toko` (`id`, `name`, `alamat`, `lat`, `lng`) VALUES
	(1, 'Toko A', 'Jl. Merdeka', -0.042143916180070934, 109.36035124986022), 
(2, 'Toko B', 'Jl. Raya', -0.04520722723041784, 109.36358881291396),
(3, 'Toko C', 'Jl. Sudirman', -0.05623711446160067, 109.3372446919995);



DROP TABLE IF EXISTS `pengguna`;
CREATE TABLE IF NOT EXISTS `pengguna` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pin` char(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `emailtelp` (`email`,`telp`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DELETE FROM `pengguna`;
INSERT INTO `pengguna` (`id`, `name`, `email`, `telp`, `pin`) VALUES
	(1, 'Amelia Putri', 'a@a.a', '081234567891', '123456'),
	(2, 'Rohan Sebastian', 'b@b.b', '082148213646', '123458');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

-- membuang struktur untuk table pois_db.transaksi
DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE IF NOT EXISTS `transaksi` (
  `id` int NOT NULL AUTO_INCREMENT,
  `prod_id` char(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `toko_id` int NOT NULL,
  `harga` int DEFAULT NULL,
  `pengguna_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_transaksi_pengguna` (`pengguna_id`),
  KEY `FK_transaksi_produk` (`prod_id`),
  KEY `FK_transaksi_toko` (`toko_id`),
  CONSTRAINT `FK_transaksi_produk` FOREIGN KEY (`prod_id`) REFERENCES `produk` (`id`),
  CONSTRAINT `FK_transaksi_toko` FOREIGN KEY (`toko_id`) REFERENCES `toko` (`id`),
  CONSTRAINT `FK_transaksi_pengguna` FOREIGN KEY (`pengguna_id`) REFERENCES `pengguna` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Membuang data untuk tabel pois_db.transaksi: ~2 rows (lebih kurang)
DELETE FROM `transaksi`;
INSERT INTO `transaksi` (`id`, `prod_id`, `toko_id`, `harga`, `pengguna_id`) VALUES
	(1, '1234567890123', 1, 3000, 1),
	(2, '1234567890123', 2, 3000, 1),
	(3, '1234567890123', 3, 3000, 1),
	(4, '1234567890124', 1, 3000, 1),
	(5, '1234567890124', 2, 3000, 1),
	(6, '1234567890124', 3, 3000, 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

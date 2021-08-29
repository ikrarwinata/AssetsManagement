-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Agu 2021 pada 03.34
-- Versi server: 10.4.18-MariaDB
-- Versi PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assetsmanagement`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(250) NOT NULL,
  `category_detail` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `category`
--

INSERT INTO `category` (`id`, `category_name`, `category_detail`) VALUES
(1, 'cryptocurrency', 'Cryptocurrency assets'),
(2, 'Money', 'Money');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master`
--

DROP TABLE IF EXISTS `master`;
CREATE TABLE IF NOT EXISTS `master` (
  `id` varchar(100) NOT NULL,
  `master_name` varchar(250) NOT NULL,
  `category_id` int(11) NOT NULL,
  `quantity` float NOT NULL,
  `date` int(10) NOT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `purchases`
--

DROP TABLE IF EXISTS `purchases`;
CREATE TABLE IF NOT EXISTS `purchases` (
  `id` varchar(100) NOT NULL,
  `master_id` varchar(100) NOT NULL,
  `quantity` float NOT NULL,
  `price` bigint(15) NOT NULL,
  `date` int(11) NOT NULL,
  `user_account` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `sold` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sales`
--

DROP TABLE IF EXISTS `sales`;
CREATE TABLE IF NOT EXISTS `sales` (
  `id` varchar(100) NOT NULL,
  `master_id` varchar(100) NOT NULL,
  `quantity` bigint(15) NOT NULL,
  `price` bigint(15) NOT NULL,
  `date` int(11) NOT NULL,
  `user_account` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users_account`
--

DROP TABLE IF EXISTS `users_account`;
CREATE TABLE IF NOT EXISTS `users_account` (
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `full_name` varchar(250) NOT NULL,
  `nick_name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `level` enum('user','administrator','superadministrator') NOT NULL DEFAULT 'user',
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users_account`
--

INSERT INTO `users_account` (`username`, `password`, `full_name`, `nick_name`, `email`, `phone`, `level`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'Ikrar Winata', 'Nata', 'ikrarwinata@gmail.com', '089531623627', 'administrator'),
('superadmin', '17c4520f6cfd1ab53d8745e84681eb49', 'Ikrar Winata', 'Nata', 'ikrarwinata@gmail.com', '089531623627', 'superadministrator'),
('user', 'ee11cbb19052e40b07aac0ca060c23ee', 'Ikrar Winata', 'Nata', 'ikrarwinata@gmail.com', '089531623627', 'user');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

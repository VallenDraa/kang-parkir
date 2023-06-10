-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 08, 2023 at 10:38 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parkiran-dua`
--

-- --------------------------------------------------------

--
-- Table structure for table `histori_parkir`
--

CREATE TABLE `histori_parkir` (
  `id` int(11) NOT NULL,
  `lokasi_parkir` varchar(3) NOT NULL,
  `plat_motor` varchar(100) NOT NULL,
  `tanggal_masuk` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tanggal_keluar` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `histori_parkir`
--

INSERT INTO `histori_parkir` (`id`, `lokasi_parkir`, `plat_motor`, `tanggal_masuk`, `tanggal_keluar`) VALUES
(2, 'a1', 'wewewe', '2023-06-07 14:35:51', NULL),
(7, 'a1', '123123213', '2023-06-07 15:06:01', NULL),
(8, 'a2', 'dsdsds', '2023-06-07 15:06:27', NULL),
(9, 'a1', '123123213', NULL, '2023-06-07 15:06:47'),
(10, 'a1', '123', '2023-06-07 15:07:27', NULL),
(11, 'a3', 'adccc', '2023-06-07 15:07:42', NULL),
(12, 'a1', '123', NULL, '2023-06-07 15:07:49');

-- --------------------------------------------------------

--
-- Table structure for table `motor`
--

CREATE TABLE `motor` (
  `plat` varchar(100) NOT NULL,
  `lokasi_parkir` varchar(3) NOT NULL,
  `tanggal_masuk` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_user_pemilik` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `motor`
--

INSERT INTO `motor` (`plat`, `lokasi_parkir`, `tanggal_masuk`, `id_user_pemilik`) VALUES
('adccc', 'a3', '2023-06-07 15:07:42', 10),
('dsdsds', 'a2', '2023-06-07 15:06:26', 9);

-- --------------------------------------------------------

--
-- Table structure for table `tempat_parkir`
--

CREATE TABLE `tempat_parkir` (
  `lokasi_parkir` varchar(3) NOT NULL,
  `plat_motor` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tempat_parkir`
--

INSERT INTO `tempat_parkir` (`lokasi_parkir`, `plat_motor`) VALUES
('a1', NULL),
('a4', NULL),
('a5', NULL),
('b1', NULL),
('b2', NULL),
('b3', NULL),
('b4', NULL),
('b5', NULL),
('c1', NULL),
('c2', NULL),
('c3', NULL),
('c4', NULL),
('c5', NULL),
('d1', NULL),
('d2', NULL),
('d3', NULL),
('d4', NULL),
('d5', NULL),
('e1', NULL),
('e2', NULL),
('e3', NULL),
('e4', NULL),
('e5', NULL),
('f1', NULL),
('f2', NULL),
('f3', NULL),
('f4', NULL),
('f5', NULL),
('a3', 'adccc'),
('a2', 'dsdsds');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(120) NOT NULL,
  `password` varchar(120) NOT NULL,
  `is_admin` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `is_admin`, `created_at`) VALUES
(8, 'wewewe', 'wewewe', 0, '2023-06-07 14:35:51'),
(9, '123123213', '123123213', 0, '2023-06-07 15:06:01'),
(10, 'adccc', 'adccc', 0, '2023-06-07 15:07:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `histori_parkir`
--
ALTER TABLE `histori_parkir`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `motor`
--
ALTER TABLE `motor`
  ADD PRIMARY KEY (`plat`),
  ADD UNIQUE KEY `lokasi_parkir` (`lokasi_parkir`);

--
-- Indexes for table `tempat_parkir`
--
ALTER TABLE `tempat_parkir`
  ADD PRIMARY KEY (`lokasi_parkir`),
  ADD UNIQUE KEY `id_motor` (`plat_motor`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `histori_parkir`
--
ALTER TABLE `histori_parkir`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

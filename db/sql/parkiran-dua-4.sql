-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 14, 2023 at 05:58 PM
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
  `tanggal_masuk` timestamp NULL DEFAULT current_timestamp(),
  `tanggal_keluar` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `histori_parkir`
--

INSERT INTO `histori_parkir` (`id`, `lokasi_parkir`, `plat_motor`, `tanggal_masuk`, `tanggal_keluar`) VALUES
(156, 'A1', 'B 123-234 432', '2023-06-11 13:11:56', NULL);

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
('B 123-234 432', 'A1', '2023-06-11 13:11:56', 43);

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
('A2', NULL),
('A3', NULL),
('A4', NULL),
('A5', NULL),
('B1', NULL),
('B2', NULL),
('B3', NULL),
('B4', NULL),
('B5', NULL),
('C1', NULL),
('C2', NULL),
('C3', NULL),
('C4', NULL),
('C5', NULL),
('D1', NULL),
('D2', NULL),
('D3', NULL),
('D4', NULL),
('D5', NULL),
('E1', NULL),
('E2', NULL),
('E3', NULL),
('E4', NULL),
('E5', NULL),
('F1', NULL),
('F2', NULL),
('F3', NULL),
('F4', NULL),
('F5', NULL),
('A1', 'B 123-234 432');

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
(43, 'B 123-234 432', '$2y$12$L4lSyOV7Q71YNC8kTiWOEOxtPnh5elOjlc9ES6m2.HKRCtWTf7oGC', 0, '2023-06-11 13:11:56');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

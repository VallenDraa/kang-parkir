-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 18, 2023 at 08:35 AM
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
(242, 'B2', 'B 123-234-432', '2023-06-18 05:01:58', NULL),
(243, 'A1', 'wewewe', '2023-06-18 06:29:09', NULL);

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
('B 123-234-432', 'B2', '2023-06-18 05:01:58', 92),
('wewewe', 'A1', '2023-06-18 06:29:08', 91);

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
('G1', NULL),
('G2', NULL),
('G3', NULL),
('G4', NULL),
('G5', NULL),
('H1', NULL),
('H2', NULL),
('H3', NULL),
('H4', NULL),
('H5', NULL),
('I1', NULL),
('I2', NULL),
('I3', NULL),
('I4', NULL),
('I5', NULL),
('J1', NULL),
('J2', NULL),
('J3', NULL),
('J4', NULL),
('J5', NULL),
('K1', NULL),
('K2', NULL),
('K3', NULL),
('K4', NULL),
('K5', NULL),
('L1', NULL),
('L2', NULL),
('L3', NULL),
('L4', NULL),
('L5', NULL),
('B2', 'B 123-234-432'),
('A1', 'wewewe');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(120) NOT NULL,
  `password` varchar(120) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `is_admin`, `created_at`) VALUES
(91, 'admin', '$2a$12$VbSE9/cse0gMJMGbfBBHc.ncF2UsxG8.tVK47sr06h29h0Qq/Sa.6', 1, '2023-06-18 00:12:17'),
(92, 'Marko', '$2y$12$sk5nCuGtwe.aklCceXDWLOQuq7zNNE726dBvuk9jhCEZCw2mh5Q2m', 0, '2023-06-18 05:01:58');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=244;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
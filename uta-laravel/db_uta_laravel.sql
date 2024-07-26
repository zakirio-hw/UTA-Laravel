-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2024 at 06:39 AM
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
-- Database: `db_uta_laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id` varchar(5) NOT NULL,
  `kriteria` varchar(50) NOT NULL,
  `n_interval` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id`, `kriteria`, `n_interval`) VALUES
('C1', 'Jumlah Konsultan', 4),
('C2', 'Tahun Pengalaman', 3),
('C3', 'Skill Teknis', 3),
('C4', 'Referensi', 4),
('C5', 'Biaya', 3);

-- --------------------------------------------------------

--
-- Table structure for table `matriks`
--

CREATE TABLE `matriks` (
  `id` varchar(11) NOT NULL,
  `alternatif` varchar(50) NOT NULL,
  `nilai` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `matriks`
--

INSERT INTO `matriks` (`id`, `alternatif`, `nilai`) VALUES
('A1', 'Alt1', '5|4|16|50|2000'),
('A10', 'Alt10', '5|10|11|170|900'),
('A2', 'Alt2', '2|6|36|70|900'),
('A3', 'Alt3', '3|6|32|12|1200'),
('A4', 'Alt4', '8|12|31|650|2000'),
('A5', 'Alt5', '4|15|42|425|700'),
('A6', 'Alt6', '30|11|28|430|2100'),
('A7', 'Alt7', '21|5|12|152|2100'),
('A8', 'Alt8', '24|10|28|850|900'),
('A9', 'Alt9', '11|13|16|830|700');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `matriks`
--
ALTER TABLE `matriks`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

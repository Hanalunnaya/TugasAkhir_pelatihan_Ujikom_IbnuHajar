-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2025 at 01:24 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk_saw_tahfizh`
--

-- --------------------------------------------------------

--
-- Table structure for table `costumer`
--

CREATE TABLE `costumer` (
  `id_costumer` int(11) NOT NULL,
  `nama_costumer` varchar(30) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `telp` int(20) NOT NULL,
  `fax` int(20) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `costumer`
--

INSERT INTO `costumer` (`id_costumer`, `nama_costumer`, `alamat`, `telp`, `fax`, `email`) VALUES
(5, 'bani', 'serpong', 1, 1, 'apa123@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id_item` int(11) NOT NULL,
  `nama_item` varchar(30) NOT NULL,
  `uom` int(15) NOT NULL,
  `harga_beli` int(15) NOT NULL,
  `harga_jual` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id_item`, `nama_item`, `uom`, `harga_beli`, `harga_jual`) VALUES
(1, 'RTX 3060 ', 4000000, 3500000, 3700000),
(2, 'RX6600', 3000000, 2000000, 2500000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jabatan` enum('Admin','Petugas') NOT NULL,
  `dibuat_pada` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `jabatan`, `dibuat_pada`) VALUES
(1, 'admin', '$2y$10$eZTNeQSWW9FOS8H21khtIuyQaNf7DMQXtGSzm6RI5CrNz.rilbPoi', 'Administrator', 'Admin', '2025-02-10 14:27:42'),
(6, 'guru', '$2y$10$pLR21DQbjBSz6cJaAhgMauHXvTR5R75AezGOGk..LastENFKOMKgq', 'Ibnu Hajar', 'Petugas', '2025-02-22 15:16:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `costumer`
--
ALTER TABLE `costumer`
  ADD PRIMARY KEY (`id_costumer`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id_item`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `costumer`
--
ALTER TABLE `costumer`
  MODIFY `id_costumer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

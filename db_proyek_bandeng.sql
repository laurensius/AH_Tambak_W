-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 24, 2018 at 12:15 AM
-- Server version: 5.7.23-0ubuntu0.18.04.1
-- PHP Version: 7.2.10-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_proyek_bandeng`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_log`
--

CREATE TABLE `t_log` (
  `id` int(255) NOT NULL,
  `val_suhu` decimal(10,2) NOT NULL,
  `val_kekeruhan` decimal(10,2) NOT NULL,
  `val_kedalaman` decimal(10,2) NOT NULL,
  `cat_suhu` varchar(255) NOT NULL,
  `cat_kekeruhan` varchar(255) NOT NULL,
  `cat_kedalaman` varchar(255) NOT NULL,
  `datetime` datetime NOT NULL,
  `pesan_notifikasi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_log`
--

INSERT INTO `t_log` (`id`, `val_suhu`, `val_kekeruhan`, `val_kedalaman`, `cat_suhu`, `cat_kekeruhan`, `cat_kedalaman`, `datetime`, `pesan_notifikasi`) VALUES
(1, '29.00', '99.00', '24.00', 'Tinggi', 'Tinggi', 'Tinggi', '2018-09-19 23:30:44', 'Kondisi suhu di bawah batas normal. Kondisi kekeruhan air di atas batas normal. Kondisi air tambak di atas batas normal.'),
(2, '29.00', '99.00', '24.00', 'Tinggi', 'Tinggi', 'Tinggi', '2018-09-19 23:31:27', 'Kondisi suhu di bawah batas normal. Kondisi kekeruhan air di atas batas normal. Kondisi air tambak di atas batas normal.'),
(3, '29.00', '99.00', '24.00', 'Tinggi', 'Tinggi', 'Tinggi', '2018-09-19 23:31:32', 'Kondisi suhu di bawah batas normal. Kondisi kekeruhan air di atas batas normal. Kondisi air tambak di atas batas normal.'),
(4, '29.00', '99.00', '24.00', 'Tinggi', 'Tinggi', 'Tinggi', '2018-09-19 23:31:58', 'Kondisi suhu di bawah batas normal. Kondisi kekeruhan air di atas batas normal. Kondisi air tambak di atas batas normal.'),
(5, '19.00', '99.00', '24.00', 'Normal', 'Tinggi', 'Tinggi', '2018-09-19 23:32:40', 'Kondisi kekeruhan air di atas batas normal. Kondisi air tambak di atas batas normal.'),
(6, '19.00', '450.00', '18.00', 'Normal', 'Normal', 'Normal', '2018-09-19 23:33:10', ''),
(7, '28.00', '450.00', '18.00', 'Tinggi', 'Normal', 'Normal', '2018-09-20 15:58:19', 'Kondisi suhu di bawah batas normal. Kondisi kekeruhan normal. Kondisi kedalaman normal.'),
(8, '28.00', '450.00', '18.00', 'Tinggi', 'Normal', 'Normal', '2018-09-20 23:02:00', 'Kondisi suhu di bawah batas normal.'),
(9, '28.00', '450.00', '18.00', 'Tinggi', 'Normal', 'Normal', '2018-09-20 23:13:30', 'Kondisi suhu di atas batas normal.');

-- --------------------------------------------------------

--
-- Table structure for table `t_monitoring`
--

CREATE TABLE `t_monitoring` (
  `id` int(255) NOT NULL,
  `val_suhu` decimal(10,2) NOT NULL,
  `val_kekeruhan` decimal(10,2) NOT NULL,
  `val_kedalaman` decimal(10,2) NOT NULL,
  `cat_suhu` varchar(255) NOT NULL,
  `cat_kekeruhan` varchar(255) NOT NULL,
  `cat_kedalaman` varchar(255) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_monitoring`
--

INSERT INTO `t_monitoring` (`id`, `val_suhu`, `val_kekeruhan`, `val_kedalaman`, `cat_suhu`, `cat_kekeruhan`, `cat_kedalaman`, `datetime`) VALUES
(1, '30.00', '400.00', '20.00', 'Tinggi', 'Normal', 'Normal', '2018-09-20 23:13:30');

-- --------------------------------------------------------

--
-- Table structure for table `t_user`
--

CREATE TABLE `t_user` (
  `id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nama` varchar(99) NOT NULL,
  `last_login` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_user`
--

INSERT INTO `t_user` (`id`, `username`, `password`, `nama`, `last_login`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', '2018-09-15 00:00:00'),
(2, 'afif', '37f3c4ac0ecd4a50c7f7ea1bd2b017c7', 'Afif Hidayat', '2018-09-15 00:00:00'),
(3, 'renzcybermedia', '418eab707e84c6223060fc704e9527c7', 'Laurensius Dede Suhardiman', '2018-09-15 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_log`
--
ALTER TABLE `t_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_monitoring`
--
ALTER TABLE `t_monitoring`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_log`
--
ALTER TABLE `t_log`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `t_monitoring`
--
ALTER TABLE `t_monitoring`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

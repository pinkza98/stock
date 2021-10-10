-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2021 at 12:34 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `warehouse`
--

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `unit_id` int(11) NOT NULL,
  `unit_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`unit_id`, `unit_name`) VALUES
(1, 'แพ็ค'),
(2, 'เล่ม'),
(3, 'ลัง'),
(4, 'กล่อง'),
(5, 'แกลลอน'),
(6, 'ถัง'),
(7, 'ถุง'),
(8, 'ขวด'),
(9, 'กระป๋อง'),
(10, 'อัน'),
(11, 'ใบ'),
(12, 'เซ็ต'),
(13, 'เครื่อง'),
(14, 'ม้วน'),
(15, 'เส้น'),
(16, 'รีม'),
(17, 'แท่ง'),
(18, 'ตลับ'),
(19, 'ชิ้น'),
(20, 'หลอด'),
(21, 'ชุด'),
(22, 'ตัว'),
(23, 'โหล'),
(24, 'ลูก'),
(25, 'กระปุก'),
(26, 'กล่องละ 50 คู่'),
(27, 'ถุงละ 50 ชิ้น'),
(28, 'ลัง 6 ม้วน'),
(29, 'หัว'),
(30, 'เม็ด'),
(31, 'ห่อ'),
(32, 'แผ่น'),
(33, 'ซอง 10 แผ่น'),
(34, 'กล่อง 12 หัว'),
(35, 'แผง'),
(36, 'กล่อง 12 ชิ้น'),
(37, 'ซอง10เส้น'),
(38, 'ซอง1เส้น'),
(39, 'ห่อ 1 เส้น'),
(40, 'ห่อ10 ตัว'),
(41, 'ซอง'),
(42, 'กล่อง(6หลอด)'),
(43, 'แพ็ค 25 ตัว'),
(44, 'แพ็ค 10 ตัว'),
(45, 'ซี่'),
(46, 'ถุง/กล่อง'),
(47, 'ด้าม'),
(48, 'คู่'),
(49, 'ถ้วย'),
(50, 'Kit'),
(51, 'licenses'),
(52, 'แกลอน');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`unit_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

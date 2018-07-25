-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2018 at 08:13 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tts`
--

-- --------------------------------------------------------

--
-- Table structure for table `corpus`
--

CREATE TABLE `corpus` (
  `id_user` int(11) NOT NULL,
  `id` int(11) NOT NULL COMMENT 'id  ของคลัง',
  `name` varchar(140) CHARACTER SET utf8 COLLATE utf8_thai_520_w2 NOT NULL,
  `txt` text CHARACTER SET utf8 COLLATE utf8_thai_520_w2 NOT NULL,
  `license` text CHARACTER SET utf8 COLLATE utf8_thai_520_w2 NOT NULL,
  `author` varchar(255) CHARACTER SET utf8 COLLATE utf8_thai_520_w2 NOT NULL,
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_thai_520_w2 NOT NULL,
  `language` varchar(255) CHARACTER SET utf8 COLLATE utf8_thai_520_w2 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `corpus`
--

INSERT INTO `corpus` (`id_user`, `id`, `name`, `txt`, `license`, `author`, `url`, `language`) VALUES
(1, 3, 'test', 'ข้อความชุดทดสอบ', 'CC-BY 3.0', 'วรรณพงษ์ ภัททิยไพบูลย์', '', 'thai'),
(1, 4, 'แมว', 'พูดเกี่ยวกับแมว', 'CC-BY 3.0', 'วรรณพงษ์ ภัททิยไพบูลย์', 'https://github.com/wannaphongcom/', 'thai');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `email` varchar(50) COLLATE utf8_thai_520_w2 NOT NULL,
  `password` varchar(50) COLLATE utf8_thai_520_w2 NOT NULL,
  `name` varchar(50) COLLATE utf8_thai_520_w2 NOT NULL,
  `address` text COLLATE utf8_thai_520_w2 NOT NULL,
  `phone` varchar(12) COLLATE utf8_thai_520_w2 NOT NULL,
  `dateregister` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_thai_520_w2;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `email`, `password`, `name`, `address`, `phone`, `dateregister`) VALUES
(1, 'wannaphong@kkumail.com', '10d579e9d698fec699da8ce69ca68e76c7f4a4da', 'Wannaphong Phatthiyaphaibun', '', '', '2018-07-14 19:00:12'),
(2, 'wannaphong@yahoo.com', 'c11c9d76390a296b8338aeaa5bc2a2a14e13c4a0', 'ต้นตาล', '', '', '2018-07-16 20:58:10');

-- --------------------------------------------------------

--
-- Table structure for table `textcorpus`
--

CREATE TABLE `textcorpus` (
  `id` int(11) NOT NULL,
  `txt` text COLLATE utf8_thai_520_w2 NOT NULL,
  `txt_read` text COLLATE utf8_thai_520_w2 NOT NULL,
  `idcorpus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_thai_520_w2;

--
-- Dumping data for table `textcorpus`
--

INSERT INTO `textcorpus` (`id`, `txt`, `txt_read`, `idcorpus`) VALUES
(1, 'ทดสอบระบบ', 'ทดสอบระบบ', 3),
(2, 'ต้นตาล', 'ต้นตาล', 3),
(3, 'แมว', 'แมว', 3),
(4, 'คนดี', 'คนดี', 3),
(5, 'คืนความสุขให้เธอ', 'คืนความสุขให้เธอ', 3),
(6, 'แมว', 'แมว', 4),
(7, 'เหมียว', 'เหมียว', 4),
(8, 'คนดีดี', 'คนดีดี', 3),
(9, '1', 'หนึ่ง', 3),
(10, '2', 'สอง', 3);

-- --------------------------------------------------------

--
-- Table structure for table `voice`
--

CREATE TABLE `voice` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL COMMENT 'เก็บ id user',
  `path` text COLLATE utf8_thai_520_w2 NOT NULL COMMENT 'เก็บ path ไฟล์',
  `id_txt` int(11) NOT NULL COMMENT 'เก็บ id ของ text ที่อ่าน',
  `date_save` datetime NOT NULL COMMENT 'เก็บวันเวลาเก็บ',
  `is_use` tinyint(1) NOT NULL COMMENT 'ใช้เก็บว่าใช้หรือไม่'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_thai_520_w2;

--
-- Dumping data for table `voice`
--

INSERT INTO `voice` (`id`, `id_user`, `path`, `id_txt`, `date_save`, `is_use`) VALUES
(2, 1, '1_2018_07_16_00_53_26.wav', 0, '2018-07-16 00:53:26', 0),
(3, 1, '1_2018_07_16_13_51_08.wav', 0, '2018-07-16 13:51:08', 0),
(4, 1, '1_2018_07_16_14_18_19.wav', 0, '2018-07-16 14:18:19', 0),
(5, 1, '1_2018_07_16_14_43_10.wav', 0, '2018-07-16 14:43:10', 0),
(6, 1, '1_2018_07_16_14_45_40.wav', 0, '2018-07-16 14:45:40', 0),
(7, 1, '1_2018_07_16_14_48_19.wav', 0, '2018-07-16 14:48:19', 0),
(8, 1, '1_2018_07_16_14_49_17.wav', 0, '2018-07-16 14:49:17', 0),
(9, 1, '1_2018_07_16_14_49_28.wav', 0, '2018-07-16 14:49:28', 0),
(10, 1, '1_2018_07_16_14_50_19.wav', 1, '2018-07-16 14:50:19', 0),
(11, 1, '1_2018_07_16_15_07_54.wav', 1, '2018-07-16 15:07:54', 1),
(12, 1, '1_2018_07_16_15_38_55.wav', 2, '2018-07-16 15:38:55', 0),
(13, 1, '1_2018_07_16_15_48_19.wav', 1, '2018-07-16 15:48:19', 0),
(14, 1, '1_2018_07_16_16_13_30.wav', 2, '2018-07-16 16:13:30', 0),
(15, 1, '1_2018_07_16_17_04_59.wav', 2, '2018-07-16 17:04:59', 0),
(16, 1, '1_2018_07_16_17_05_58.wav', 2, '2018-07-16 17:05:58', 1),
(17, 1, '1_2018_07_16_17_23_05.wav', 3, '2018-07-16 17:23:05', 0),
(18, 1, '1_2018_07_16_17_52_29.wav', 4, '2018-07-16 17:52:29', 0),
(19, 1, '1_2018_07_16_17_55_33.wav', 4, '2018-07-16 17:55:33', 1),
(20, 1, '1_2018_07_16_18_22_35.wav', 5, '2018-07-16 18:22:35', 1),
(21, 2, '2_2018_07_16_20_58_59.wav', 1, '2018-07-16 20:58:59', 1),
(22, 1, '1_2018_07_16_21_24_08.wav', 3, '2018-07-16 21:24:08', 1),
(23, 1, '1_2018_07_16_22_08_04.wav', 6, '2018-07-16 22:08:04', 1),
(24, 1, '1_2018_07_16_22_25_52.wav', 7, '2018-07-16 22:25:52', 1),
(25, 1, '1_2018_07_16_23_24_10.wav', 9, '2018-07-16 23:24:10', 1),
(26, 1, '1_2018_07_16_23_39_28.wav', 10, '2018-07-16 23:39:28', 1),
(27, 1, '1_2018_07_16_23_39_52.wav', 10, '2018-07-16 23:39:52', 0),
(28, 1, '1_2018_07_16_23_41_02.wav', 8, '2018-07-16 23:41:02', 1),
(29, 2, '2_2018_07_25_12_58_40.wav', 3, '2018-07-25 12:58:40', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `corpus`
--
ALTER TABLE `corpus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `textcorpus`
--
ALTER TABLE `textcorpus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voice`
--
ALTER TABLE `voice`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `corpus`
--
ALTER TABLE `corpus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id  ของคลัง', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `textcorpus`
--
ALTER TABLE `textcorpus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `voice`
--
ALTER TABLE `voice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

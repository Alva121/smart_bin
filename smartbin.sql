-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2020 at 10:31 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smartbin`
--

-- --------------------------------------------------------

--
-- Table structure for table `bin_location`
--

CREATE TABLE `bin_location` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `enable` int(11) NOT NULL DEFAULT 1,
  `type` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bin_location`
--

INSERT INTO `bin_location` (`id`, `name`, `lat`, `lng`, `status`, `enable`, `type`) VALUES
(1, 'slekin', 12.8802921, 74.8427438, 1, 1, 1),
(2, 'slekin', 12.8802921, 74.8427438, 0, 1, 0),
(3, 'Dharmashastha Temple', 12.887292, 74.8644827, 2, 1, 1),
(4, 'Dharmashastha Temple', 12.887292, 74.8644827, 0, 1, 0),
(5, 'A.J. Hospital', 12.887292, 74.8644827, 0, 1, 1),
(6, 'A.J. Hospital', 12.887292, 74.8644827, 0, 1, 0),
(7, 'St. Anne Church', 12.887292, 74.8644827, 0, 1, 1),
(8, 'St. Anne Church', 12.887292, 74.8644827, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `collector`
--

CREATE TABLE `collector` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `type` varchar(30) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `collector`
--

INSERT INTO `collector` (`id`, `name`, `lat`, `lng`, `type`, `created_at`) VALUES
(1, 'slekin', 12.8802921, 74.8427438, 'Degradable', '2020-03-12 15:35:02'),
(2, 'slekin', 12.8802921, 74.8427438, 'Degradable', '2020-03-12 15:35:12'),
(3, 'slekin', 12.8802921, 74.8427438, 'Plastic', '2020-03-12 15:35:14'),
(4, 'slekin', 12.8802921, 74.8427438, 'Degradable', '2020-03-12 15:35:27'),
(5, 'slekin', 12.8802921, 74.8427438, 'Plastic', '2020-03-12 15:35:30'),
(6, 'slekin', 12.8802921, 74.8427438, 'Degradable', '2020-03-12 16:03:59'),
(7, 'slekin', 12.8802921, 74.8427438, 'Plastic', '2020-03-12 16:04:02'),
(8, 'slekin', 12.8802921, 74.8427438, 'Degradable', '2020-03-12 17:31:41'),
(9, 'slekin', 12.8802921, 74.8427438, 'Plastic', '2020-03-12 17:31:43'),
(10, 'slekin', 12.8802921, 74.8427438, 'Degradable', '2020-03-12 17:31:47'),
(11, 'slekin', 12.8802921, 74.8427438, 'Plastic', '2020-03-12 17:31:48'),
(12, 'slekin', 12.8802921, 74.8427438, 'Degradable', '2020-03-12 17:31:50'),
(13, 'slekin', 12.8802921, 74.8427438, 'Plastic', '2020-03-12 17:31:52'),
(14, 'slekin', 12.8802921, 74.8427438, 'Degradable', '2020-03-12 17:31:55'),
(15, 'slekin', 12.8802921, 74.8427438, 'Degradable', '2020-03-12 17:38:00'),
(16, 'slekin', 12.8802921, 74.8427438, 'Degradable', '2020-03-12 17:38:47'),
(17, 'slekin', 12.8802921, 74.8427438, 'Degradable', '2020-03-12 22:01:34'),
(18, 'slekin', 12.8802921, 74.8427438, 'Plastic', '2020-03-12 22:02:09'),
(19, 'slekin', 12.8802921, 74.8427438, 'Plastic', '2020-03-12 22:02:35'),
(20, 'slekin', 12.8802921, 74.8427438, 'Degradable', '2020-03-12 22:03:15'),
(21, 'slekin', 12.8802921, 74.8427438, 'Degradable', '2020-03-13 14:50:55'),
(22, 'slekin', 12.8802921, 74.8427438, 'Degradable', '2020-03-13 14:55:06');

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `d_lat` double DEFAULT NULL,
  `d_lng` double DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `type` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`id`, `name`, `phone`, `status`, `d_lat`, `d_lng`, `password`, `email`, `type`) VALUES
(4, 'Manish', '6360090436', 0, 0, 0, '1234', 'a', 0),
(15, 'alva', '123456', 0, NULL, NULL, 'wenewn', 'alva@gmail.com', 1),
(17, '', '', 0, NULL, NULL, '', '', 1),
(20, 'Chethan S', '9611825370', 0, NULL, NULL, '1234', 'scchethu@gmail.com', 1),
(21, 'Chethan', '123', 0, NULL, NULL, '123', 'scchethu@gmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_feedback`
--

CREATE TABLE `user_feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `message` text NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_feedback`
--

INSERT INTO `user_feedback` (`id`, `name`, `phone`, `message`, `lat`, `lng`, `created_at`) VALUES
(15, 'Chethan S ', '961182537', 'Hai', 12.880371, 74.844993, '2020-03-12 15:05:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bin_location`
--
ALTER TABLE `bin_location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `collector`
--
ALTER TABLE `collector`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `user_feedback`
--
ALTER TABLE `user_feedback`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bin_location`
--
ALTER TABLE `bin_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `collector`
--
ALTER TABLE `collector`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user_feedback`
--
ALTER TABLE `user_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

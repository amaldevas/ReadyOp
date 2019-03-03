-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2019 at 02:45 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `luggo`
--

-- --------------------------------------------------------

--
-- Table structure for table `hub`
--

CREATE TABLE `hub` (
  `id` bigint(20) NOT NULL,
  `name` varchar(500) NOT NULL,
  `number` bigint(20) DEFAULT NULL,
  `landmark` varchar(5000) DEFAULT NULL,
  `description` varchar(5000) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `date_created` datetime NOT NULL,
  `email` varchar(5000) NOT NULL,
  `address` int(11) NOT NULL,
  `rst` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hub`
--

INSERT INTO `hub` (`id`, `name`, `number`, `landmark`, `description`, `password`, `date_created`, `email`, `address`, `rst`) VALUES
(10001, 'Trivandrum', NULL, NULL, NULL, 'trivandrum', '2019-03-02 07:04:07', 'trivandrum@luggo.com', 0, NULL),
(10003, 'Kochi', NULL, NULL, NULL, 'kochi', '2019-03-02 12:00:37', 'kochi@luggo.com', 0, NULL),
(10004, 'Banglore', NULL, NULL, NULL, 'banglore', '2019-03-02 12:01:03', 'banglore@luggo.com', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ksrtc`
--

CREATE TABLE `ksrtc` (
  `id` bigint(20) NOT NULL,
  `from_hub` bigint(20) NOT NULL,
  `to_hub` bigint(20) NOT NULL,
  `arrival` time NOT NULL,
  `departure` time NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ksrtc`
--

INSERT INTO `ksrtc` (`id`, `from_hub`, `to_hub`, `arrival`, `departure`, `date_created`) VALUES
(50000, 10001, 10003, '11:55:00', '06:00:00', '2019-03-02 12:55:59');

-- --------------------------------------------------------

--
-- Table structure for table `luggage`
--

CREATE TABLE `luggage` (
  `id` bigint(20) NOT NULL,
  `from_hub` bigint(20) NOT NULL,
  `to_hub` bigint(20) NOT NULL,
  `ksrtc_cm` int(11) NOT NULL DEFAULT '1',
  `received` int(11) NOT NULL DEFAULT '0',
  `received_date` date DEFAULT NULL,
  `received_time` time DEFAULT NULL,
  `send` int(11) NOT NULL DEFAULT '0',
  `send_date` date DEFAULT NULL,
  `send_time` time DEFAULT NULL,
  `transporter_id` bigint(20) NOT NULL,
  `reached` int(11) NOT NULL DEFAULT '0',
  `reached_date` date DEFAULT NULL,
  `reached_time` time DEFAULT NULL,
  `delivered` int(11) NOT NULL DEFAULT '0',
  `delivered_date` date DEFAULT NULL,
  `delivered_time` time DEFAULT NULL,
  `arrival_date` date NOT NULL,
  `departure_date` date NOT NULL,
  `arrival_time` time NOT NULL,
  `departure_time` time NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `date_created` datetime NOT NULL,
  `arrival_date_user` date NOT NULL,
  `arrival_time_user` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `luggage`
--

INSERT INTO `luggage` (`id`, `from_hub`, `to_hub`, `ksrtc_cm`, `received`, `received_date`, `received_time`, `send`, `send_date`, `send_time`, `transporter_id`, `reached`, `reached_date`, `reached_time`, `delivered`, `delivered_date`, `delivered_time`, `arrival_date`, `departure_date`, `arrival_time`, `departure_time`, `user_id`, `date_created`, `arrival_date_user`, `arrival_time_user`) VALUES
(80002, 10001, 10003, 1, 1, '2019-03-02', '22:34:43', 0, NULL, NULL, 50000, 0, NULL, NULL, 0, NULL, NULL, '0000-00-00', '0000-00-00', '11:55:00', '06:00:00', 20000, '2019-03-02 22:34:43', '2019-03-04', '06:00:00'),
(80003, 10001, 10003, 1, 1, '2019-03-02', '22:42:04', 0, NULL, NULL, 50000, 0, NULL, NULL, 0, NULL, NULL, '0000-00-00', '0000-00-00', '11:55:00', '06:00:00', 20000, '2019-03-02 22:42:04', '2019-03-04', '06:00:00'),
(80004, 10001, 10003, 1, 1, '2019-03-02', '22:42:27', 0, NULL, NULL, 50000, 0, NULL, NULL, 0, NULL, NULL, '0000-00-00', '0000-00-00', '11:55:00', '06:00:00', 20000, '2019-03-02 22:42:27', '2019-03-04', '06:00:00'),
(80005, 10001, 10003, 1, 1, '2019-03-02', '22:43:23', 0, NULL, NULL, 50000, 0, NULL, NULL, 0, NULL, NULL, '0000-00-00', '0000-00-00', '11:55:00', '06:00:00', 20000, '2019-03-02 22:43:23', '2019-03-04', '06:00:00'),
(80006, 10001, 10003, 1, 1, '2019-03-02', '22:45:02', 0, NULL, NULL, 50000, 0, NULL, NULL, 0, NULL, NULL, '0000-00-00', '0000-00-00', '11:55:00', '06:00:00', 20000, '2019-03-02 22:45:02', '2019-03-04', '06:00:00'),
(80007, 10001, 10003, 1, 1, '2019-03-02', '22:45:07', 0, NULL, NULL, 50000, 0, NULL, NULL, 0, NULL, NULL, '0000-00-00', '0000-00-00', '11:55:00', '06:00:00', 20000, '2019-03-02 22:45:07', '2019-03-04', '06:00:00'),
(80008, 10001, 10003, 1, 1, '2019-03-02', '22:47:08', 0, NULL, NULL, 50000, 0, NULL, NULL, 0, NULL, NULL, '0000-00-00', '0000-00-00', '11:55:00', '06:00:00', 20000, '2019-03-02 22:47:08', '2019-03-04', '06:00:00'),
(80009, 10001, 10003, 1, 1, '2019-03-02', '22:50:56', 0, NULL, NULL, 50000, 0, NULL, NULL, 0, NULL, NULL, '0000-00-00', '0000-00-00', '11:55:00', '06:00:00', 20000, '2019-03-02 22:50:56', '2019-03-04', '06:00:00'),
(80010, 10001, 10003, 1, 1, '2019-03-02', '22:51:48', 0, NULL, NULL, 50000, 0, NULL, NULL, 0, NULL, NULL, '0000-00-00', '0000-00-00', '11:55:00', '06:00:00', 20000, '2019-03-02 22:51:48', '2019-03-04', '06:00:00'),
(80011, 10001, 10003, 1, 1, '2019-03-02', '22:58:44', 0, NULL, NULL, 50000, 0, NULL, NULL, 0, NULL, NULL, '0000-00-00', '0000-00-00', '11:55:00', '06:00:00', 20000, '2019-03-02 22:58:44', '2019-03-04', '06:00:00'),
(80012, 10001, 10003, 1, 1, '2019-03-02', '22:59:31', 0, NULL, NULL, 50000, 0, NULL, NULL, 0, NULL, NULL, '0000-00-00', '0000-00-00', '11:55:00', '06:00:00', 20000, '2019-03-02 22:59:31', '2019-03-04', '06:00:00'),
(80013, 10001, 10003, 1, 1, '2019-03-02', '23:00:18', 0, NULL, NULL, 50000, 0, NULL, NULL, 0, NULL, NULL, '0000-00-00', '0000-00-00', '11:55:00', '06:00:00', 20000, '2019-03-02 23:00:18', '2019-03-04', '06:00:00'),
(80014, 10001, 10003, 1, 1, '2019-03-02', '23:04:33', 0, NULL, NULL, 50000, 0, NULL, NULL, 0, NULL, NULL, '0000-00-00', '0000-00-00', '11:55:00', '06:00:00', 20000, '2019-03-02 23:04:33', '2019-03-04', '06:00:00'),
(80015, 10001, 10003, 1, 1, '2019-03-02', '23:26:44', 0, NULL, NULL, 50000, 0, NULL, NULL, 0, NULL, NULL, '0000-00-00', '0000-00-00', '11:55:00', '06:00:00', 20000, '2019-03-02 23:26:44', '2019-03-04', '06:00:00'),
(80016, 10001, 10003, 1, 1, '2019-03-02', '23:27:19', 0, NULL, NULL, 50000, 0, NULL, NULL, 0, NULL, NULL, '0000-00-00', '0000-00-00', '11:55:00', '06:00:00', 20000, '2019-03-02 23:27:19', '2019-03-04', '06:00:00'),
(80017, 10001, 10003, 1, 1, '2019-03-02', '23:29:39', 0, NULL, NULL, 50000, 0, NULL, NULL, 0, NULL, NULL, '0000-00-00', '0000-00-00', '11:55:00', '06:00:00', 20000, '2019-03-02 23:29:39', '2019-03-04', '06:00:00'),
(80018, 10001, 10003, 1, 1, '2019-03-03', '00:00:51', 0, NULL, NULL, 50000, 0, NULL, NULL, 0, NULL, NULL, '0000-00-00', '0000-00-00', '11:55:00', '06:00:00', 0, '2019-03-03 00:00:51', '2019-03-07', '05:00:00'),
(80019, 10001, 10003, 1, 1, '2019-03-03', '00:06:49', 0, NULL, NULL, 50000, 0, NULL, NULL, 0, NULL, NULL, '0000-00-00', '0000-00-00', '11:55:00', '06:00:00', 20000, '2019-03-03 00:06:49', '2019-03-14', '06:00:00'),
(80020, 10001, 10003, 1, 1, '2019-03-03', '00:10:10', 0, NULL, NULL, 50000, 0, NULL, NULL, 0, NULL, NULL, '0000-00-00', '0000-00-00', '11:55:00', '06:00:00', 20000, '2019-03-03 00:10:10', '2019-03-07', '12:00:00'),
(80021, 10001, 10003, 1, 1, '2019-03-03', '00:11:16', 0, NULL, NULL, 50000, 0, NULL, NULL, 0, NULL, NULL, '0000-00-00', '0000-00-00', '11:55:00', '06:00:00', 20000, '2019-03-03 00:11:16', '2019-03-07', '12:00:00'),
(80022, 10001, 10003, 0, 1, '2019-03-03', '00:22:45', 0, NULL, NULL, 30006, 0, NULL, NULL, 0, NULL, NULL, '2019-03-05', '2019-03-04', '21:00:00', '06:00:00', 20000, '2019-03-03 00:22:45', '2019-03-07', '12:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `transporter`
--

CREATE TABLE `transporter` (
  `id` bigint(20) NOT NULL,
  `name` text NOT NULL,
  `vehicle_name` text,
  `vehicle_number` text,
  `phone` bigint(20) DEFAULT NULL,
  `email` text NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `rst` text,
  `password` text NOT NULL,
  `biometric` text NOT NULL,
  `vehicle` text NOT NULL,
  `noc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transporter`
--

INSERT INTO `transporter` (`id`, `name`, `vehicle_name`, `vehicle_number`, `phone`, `email`, `date_created`, `rst`, `password`, `biometric`, `vehicle`, `noc`) VALUES
(30005, 'Reshma', NULL, NULL, NULL, 'reshmamariyamb@gmail.com', '2019-03-02 19:36:02', NULL, 'reshma', 'maxresdefault.jpg', 'RC_Book_New4.jpg', 'index.jpg'),
(30006, 'AmalDev A S', NULL, NULL, NULL, 'amaldevastvm@gmail.com', '2019-03-02 23:56:17', NULL, 'amal', 'maxresdefault.jpg', 'RC_Book_New5.jpg', 'index.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `traveller`
--

CREATE TABLE `traveller` (
  `id` bigint(20) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `date_created` datetime NOT NULL,
  `phone` bigint(20) DEFAULT NULL,
  `rst` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `traveller`
--

INSERT INTO `traveller` (`id`, `name`, `email`, `password`, `date_created`, `phone`, `rst`) VALUES
(20000, 'Ajay Mohan', 'ajaymohan2529@gmail.com', 'ajay', '2019-03-02 09:44:16', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trip`
--

CREATE TABLE `trip` (
  `id` bigint(20) NOT NULL,
  `from_hub` bigint(20) NOT NULL,
  `to_hub` bigint(20) NOT NULL,
  `departure_date` date NOT NULL,
  `arrival_date` date NOT NULL,
  `departure_time` time NOT NULL,
  `arrival_time` time NOT NULL,
  `transporter_id` bigint(20) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trip`
--

INSERT INTO `trip` (`id`, `from_hub`, `to_hub`, `departure_date`, `arrival_date`, `departure_time`, `arrival_time`, `transporter_id`, `date_created`) VALUES
(3, 10001, 10003, '2019-03-04', '2019-03-05', '06:00:00', '08:00:00', 30005, '2019-03-02 19:59:44'),
(4, 10001, 10003, '2019-03-04', '2019-03-05', '06:00:00', '21:00:00', 30006, '2019-03-02 23:57:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hub`
--
ALTER TABLE `hub`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ksrtc`
--
ALTER TABLE `ksrtc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `luggage`
--
ALTER TABLE `luggage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transporter`
--
ALTER TABLE `transporter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `traveller`
--
ALTER TABLE `traveller`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trip`
--
ALTER TABLE `trip`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hub`
--
ALTER TABLE `hub`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10005;

--
-- AUTO_INCREMENT for table `ksrtc`
--
ALTER TABLE `ksrtc`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50001;

--
-- AUTO_INCREMENT for table `luggage`
--
ALTER TABLE `luggage`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80023;

--
-- AUTO_INCREMENT for table `transporter`
--
ALTER TABLE `transporter`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30007;

--
-- AUTO_INCREMENT for table `traveller`
--
ALTER TABLE `traveller`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20001;

--
-- AUTO_INCREMENT for table `trip`
--
ALTER TABLE `trip`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

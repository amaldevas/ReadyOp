-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2019 at 02:47 PM
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
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transporter`
--

INSERT INTO `transporter` (`id`, `name`, `vehicle_name`, `vehicle_number`, `phone`, `email`, `date_created`, `rst`, `password`) VALUES
(30000, 'Reshma', NULL, NULL, NULL, 'reshmamariyamb@gmail.com', '2019-03-02 11:49:35', NULL, 'reshma');

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
-- AUTO_INCREMENT for table `transporter`
--
ALTER TABLE `transporter`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30001;

--
-- AUTO_INCREMENT for table `traveller`
--
ALTER TABLE `traveller`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20001;

--
-- AUTO_INCREMENT for table `trip`
--
ALTER TABLE `trip`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

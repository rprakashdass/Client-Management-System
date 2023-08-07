-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2023 at 08:29 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `client_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_info`
--

CREATE TABLE `admin_info` (
  `admin_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_info`
--

INSERT INTO `admin_info` (`admin_id`, `name`, `email`, `password`) VALUES
(1, 'admin', 'admin@gmail.com', '1d5ae619905ad6e9bedf77f776a529f294eafd8f');

-- --------------------------------------------------------

--
-- Table structure for table `client_info`
--

CREATE TABLE `client_info` (
  `client_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `contact` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_maps`
--

CREATE TABLE `data_maps` (
  `client_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `date_of_progress` date DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `t_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `client_id` int(100) NOT NULL,
  `staff_id` int(100) NOT NULL,
  `date` date DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `t_count` int(11) NOT NULL,
  `next_contactable` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff_info`
--

CREATE TABLE `staff_info` (
  `staff_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff_info`
--

INSERT INTO `staff_info` (`staff_id`, `name`, `email`, `department`, `password`) VALUES
(1, 'anburaj M', 'anbu@gmail.com', 'cse', 'ca86f3e1746cb125b89af57c325efbba9ccb406a'),
(2, 'robin anbu raj', 'robin@gmail.com', 'AIDS', 'robin');

-- --------------------------------------------------------

--
-- Table structure for table `status_info`
--

CREATE TABLE `status_info` (
  `status_id` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status_info`
--

INSERT INTO `status_info` (`status_id`, `description`) VALUES
(-1, 'Closed with negative feedback'),
(0, 'In Progress'),
(1, 'Yet to reach'),
(2, 'Closed with positive feedback');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_info`
--
ALTER TABLE `admin_info`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `client_info`
--
ALTER TABLE `client_info`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `data_maps`
--
ALTER TABLE `data_maps`
  ADD PRIMARY KEY (`t_count`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `staff_id` (`staff_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`t_count`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `staff_id` (`staff_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `staff_info`
--
ALTER TABLE `staff_info`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `status_info`
--
ALTER TABLE `status_info`
  ADD PRIMARY KEY (`status_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_info`
--
ALTER TABLE `admin_info`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `client_info`
--
ALTER TABLE `client_info`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `data_maps`
--
ALTER TABLE `data_maps`
  MODIFY `t_count` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `t_count` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `staff_info`
--
ALTER TABLE `staff_info`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_maps`
--
ALTER TABLE `data_maps`
  ADD CONSTRAINT `data_maps_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client_info` (`client_id`),
  ADD CONSTRAINT `data_maps_ibfk_2` FOREIGN KEY (`staff_id`) REFERENCES `staff_info` (`staff_id`),
  ADD CONSTRAINT `data_maps_ibfk_3` FOREIGN KEY (`client_id`) REFERENCES `client_info` (`client_id`),
  ADD CONSTRAINT `data_maps_ibfk_4` FOREIGN KEY (`staff_id`) REFERENCES `staff_info` (`staff_id`),
  ADD CONSTRAINT `data_maps_ibfk_5` FOREIGN KEY (`status_id`) REFERENCES `status_info` (`status_id`);

--
-- Constraints for table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `history_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client_info` (`client_id`),
  ADD CONSTRAINT `history_ibfk_2` FOREIGN KEY (`staff_id`) REFERENCES `staff_info` (`staff_id`),
  ADD CONSTRAINT `history_ibfk_3` FOREIGN KEY (`client_id`) REFERENCES `client_info` (`client_id`),
  ADD CONSTRAINT `history_ibfk_4` FOREIGN KEY (`staff_id`) REFERENCES `staff_info` (`staff_id`),
  ADD CONSTRAINT `history_ibfk_5` FOREIGN KEY (`status_id`) REFERENCES `status_info` (`status_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

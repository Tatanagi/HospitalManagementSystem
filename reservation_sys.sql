-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2025 at 02:23 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reservation_sys`
--

-- --------------------------------------------------------

--
-- Table structure for table `apt_info`
--

CREATE TABLE `apt_info` (
  `id` int(11) NOT NULL,
  `Fname` varchar(50) NOT NULL,
  `Lname` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Contact_num` varchar(20) NOT NULL,
  `Address` text NOT NULL,
  `Emergency_fullname` varchar(100) NOT NULL,
  `Emergency_num` varchar(20) NOT NULL,
  `Btype` varchar(3) NOT NULL,
  `Gender` char(1) NOT NULL,
  `Birthdate` date NOT NULL,
  `Med_condition` varchar(100) NOT NULL,
  `Reservation` datetime NOT NULL,
  `payment_method` varchar(20) NOT NULL,
  `payment_details` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apt_info`
--

INSERT INTO `apt_info` (`id`, `Fname`, `Lname`, `Email`, `Contact_num`, `Address`, `Emergency_fullname`, `Emergency_num`, `Btype`, `Gender`, `Birthdate`, `Med_condition`, `Reservation`, `payment_method`, `payment_details`, `created_at`) VALUES
(3, 'dcasdca', 'casdca', 'cacas@gmail.com', '9012039', 'adwa 1231 aaa', 'asdwa', '123124', 'A+', 'M', '2003-12-23', 'none', '2025-04-05 15:00:00', 'cash', '{\"method\":\"cash\"}', '2025-04-04 12:04:48'),
(4, 'sacasscas', 'dascasc', 'cascas@gmail.com', '123123', 'sdwasd', 'asdaw', '123123', 'A+', 'M', '2003-02-07', 'dasdwa', '2025-04-06 15:00:00', 'cash', '{\"method\":\"cash\"}', '2025-04-04 12:16:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apt_info`
--
ALTER TABLE `apt_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apt_info`
--
ALTER TABLE `apt_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

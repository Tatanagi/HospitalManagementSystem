-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2025 at 12:47 PM
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
  `Apt_id` int(11) NOT NULL,
  `Fname` varchar(64) NOT NULL,
  `Lname` varchar(64) NOT NULL,
  `Email` varchar(128) NOT NULL,
  `Contact_num` int(15) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Emergency_fullname` varchar(128) NOT NULL,
  `Emergency_num` int(15) NOT NULL,
  `Btype` varchar(3) NOT NULL CHECK (`Btype` in ('A+','A-','B+','B-','AB+','AB-','O+','O-')),
  `Gender` char(1) NOT NULL CHECK (`Gender` in ('M','F','O')),
  `Birthdate` date NOT NULL,
  `Med_condition` text NOT NULL,
  `Reservation` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apt_info`
--
ALTER TABLE `apt_info`
  ADD PRIMARY KEY (`Apt_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apt_info`
--
ALTER TABLE `apt_info`
  MODIFY `Apt_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

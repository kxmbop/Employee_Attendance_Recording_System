-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2024 at 10:11 PM
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
-- Database: `attendance`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attRN` int(11) NOT NULL,
  `empID` int(11) DEFAULT NULL,
  `attDate` date DEFAULT NULL,
  `attTimeIn` time DEFAULT NULL,
  `attTimeOut` time DEFAULT NULL,
  `attStatus` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attRN`, `empID`, `attDate`, `attTimeIn`, `attTimeOut`, `attStatus`) VALUES
(1, 24004, '2024-10-29', '00:00:00', '00:00:00', 'cancelled'),
(2, 24004, '2024-10-29', '03:13:00', '03:14:00', 'cancelled'),
(3, 24004, '2024-10-29', '03:13:00', '03:14:00', 'active'),
(4, 24004, '2024-10-30', '05:22:00', '07:22:00', 'active'),
(5, 24007, '2024-10-29', '06:34:00', '00:35:00', 'active'),
(6, 24009, '2024-10-29', '07:02:00', '22:03:00', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `depCode` int(11) NOT NULL,
  `depFName` varchar(50) DEFAULT NULL,
  `depHead` varchar(50) DEFAULT NULL,
  `depTelNo` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`depCode`, `depFName`, `depHead`, `depTelNo`) VALUES
(1001, 'Accounting', 'Iris', '21777832'),
(1004, 'Human Resource', 'Danica', '3212389'),
(1006, 'Finance', 'Joe', '29310398'),
(1007, 'Facility', 'Jini', '231231'),
(1008, 'Security', 'Jini', '1231231');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `empID` int(11) NOT NULL,
  `depCode` int(11) DEFAULT NULL,
  `empLName` varchar(50) DEFAULT NULL,
  `empFName` varchar(50) DEFAULT NULL,
  `empRPH` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`empID`, `depCode`, `empLName`, `empFName`, `empRPH`) VALUES
(24004, 1001, 'Luga', 'Irene ', 20.00),
(24007, 1004, 'Alipin', 'Kimberly Mae', 100.00),
(24008, 1006, 'Niones', 'Mary Anne', 21.00),
(24009, 1001, 'Banteccil', 'Trisha Mitch', 50.00),
(24010, 1007, 'Lausa', 'Jheny', 1.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attRN`),
  ADD KEY `empID` (`empID`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`depCode`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`empID`),
  ADD KEY `depCode` (`depCode`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attRN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `depCode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1009;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `empID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24011;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`empID`) REFERENCES `employees` (`empID`);

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`depCode`) REFERENCES `departments` (`depCode`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

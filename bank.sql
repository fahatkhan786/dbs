-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2021 at 02:53 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bank`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Account` int(12) NOT NULL,
  `Balance` decimal(16,2) NOT NULL,
  `Withdraw` decimal(16,2) NOT NULL,
  `Deposit` decimal(16,2) NOT NULL,
  `Date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`ID`, `Name`, `Email`, `Account`, `Balance`, `Withdraw`, `Deposit`, `Date`) VALUES
(1, 'Fahat', 'khanfahat786@gmail.com', 658220558, '0.00', '0.00', '80.00', '2021-12-04'),
(2, 'Fahat', 'khanfahat786@gmail.com', 658220558, '100.00', '0.00', '100.00', '2021-12-04'),
(3, 'Fahat', 'khanfahat786@gmail.com', 658220558, '75.00', '25.00', '0.00', '2021-12-04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `Type` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Token` varchar(32) NOT NULL,
  `Date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `Type`, `Name`, `Email`, `Password`, `Token`, `Date`) VALUES
(1, 'Client', 'Fahat', 'khanfahat786@gmail.com', '$2y$10$wJXZa76zDZ5RLHDrjM9Az.VJN2Jx7xEJ8wLwCvFwl9z5YOthUac7i', '769070aac819b813dff03dc166813370', '2021-12-04 12:31:55'),
(2, 'Employee', 'Fahad', 'khanfahad@gmail.com', '$2y$10$e21y7PlEKNsOBjEcmditb..8NJRIqHnAsxm9XanpVI5S6Z84YjK5m', '18ad62155bbb2db73809f6bbf77d0e53', '2021-12-04 18:30:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

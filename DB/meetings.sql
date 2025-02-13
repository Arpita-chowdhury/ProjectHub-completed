-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2024 at 07:33 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_hub`
--

-- --------------------------------------------------------

--
-- Table structure for table `meetings`
--

CREATE TABLE `meetings` (
  `serial` int(5) NOT NULL,
  `team_id` int(6) NOT NULL,
  `supervisor` varchar(5) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `details` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL,
  `date` varchar(10) NOT NULL,
  `time` varchar(10) NOT NULL,
  `note` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `meetings`
--

INSERT INTO `meetings` (`serial`, `team_id`, `supervisor`, `subject`, `details`, `status`, `date`, `time`, `note`) VALUES
(1, 633041, 'TEST', 'test', 'test', 'scheduled', '08/02/2024', '10:06 AM', ''),
(2, 633041, 'TEST', 'test', 'kj\r\nlk', 'scheduled', '14/02/2024', '01:45 PM', 'All member must present.'),
(3, 633041, 'TEST', 'back end function', 'sir, we need supervision on some functions we want to implement.', 'rejected', '', '', ''),
(4, 633041, 'TEST', 'test final', 'test test', 'rejected', '', '', ''),
(5, 633041, 'TEST', 'test final 1', 'ghj\r\njkh', 'rejected', '', '', 'will inform you later');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `meetings`
--
ALTER TABLE `meetings`
  ADD PRIMARY KEY (`serial`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `meetings`
--
ALTER TABLE `meetings`
  MODIFY `serial` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

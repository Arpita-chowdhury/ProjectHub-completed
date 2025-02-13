-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2024 at 08:21 PM
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
-- Table structure for table `proposals`
--

CREATE TABLE `proposals` (
  `serial` int(5) NOT NULL,
  `team_id` int(6) NOT NULL,
  `project_title` varchar(200) NOT NULL,
  `descipline` varchar(100) NOT NULL,
  `year` varchar(50) NOT NULL,
  `supervisor_preference` varchar(200) NOT NULL,
  `assigned_supervisor` varchar(255) NOT NULL,
  `approval_status` varchar(50) NOT NULL,
  `message` varchar(255) NOT NULL,
  `github` varchar(200) NOT NULL,
  `proposal` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `proposals`
--

INSERT INTO `proposals` (`serial`, `team_id`, `project_title`, `descipline`, `year`, `supervisor_preference`, `assigned_supervisor`, `approval_status`, `message`, `github`, `proposal`) VALUES
(57, 633041, 'project hub', 'web', '4th', 'TEST', 'TEST', 'Pending', 'submit again', 'https://github.com/', 'uploads/Education Board Bangladesh.pdf');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `proposals`
--
ALTER TABLE `proposals`
  ADD PRIMARY KEY (`serial`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `proposals`
--
ALTER TABLE `proposals`
  MODIFY `serial` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

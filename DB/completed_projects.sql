-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2024 at 06:11 PM
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
-- Table structure for table `completed_projects`
--

CREATE TABLE `completed_projects` (
  `serial` int(5) NOT NULL,
  `team_id` int(6) NOT NULL,
  `batch` varchar(20) NOT NULL,
  `section` varchar(25) NOT NULL,
  `project_title` varchar(200) NOT NULL,
  `descipline` varchar(50) NOT NULL,
  `supervisor` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL,
  `github` varchar(200) NOT NULL,
  `file` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `completed_projects`
--

INSERT INTO `completed_projects` (`serial`, `team_id`, `batch`, `section`, `project_title`, `descipline`, `supervisor`, `description`, `github`, `file`, `status`) VALUES
(6, 156860, '53', 'D', 'E-library', 'web', 'TEST', 'An internet based library system, for managing remotely and reading books or getting membership.\r\n                            ', 'http://github/asdf/e-library', 'uploads/presentation.pdf', 'completed'),
(7, 746384, '53', 'E', 'Blood Bank', 'web', 'TEST', 'Blood donation through an android app , for getting desired blood group donar available realtime and near location.\r\n                            ', 'http://github/asdf/blood-bank', 'uploads/presentation.pdf', 'completed'),
(8, 856048, '53', 'A', 'Gadget Bazar', 'android', 'TEST', '    A e-commerce site for buying and selling electronics and digital products .\r\n                            ', 'http://github/asdf/gadget-bazar', 'uploads/presentation.pdf', 'completed'),
(9, 317165, '53', 'C', 'projectHub', 'web', 'TEST', '    A project management system which will assist students to complete their projects under supeervision of a teacher and manage their tasks and workflow in a systematic way.\r\n                            ', 'http://github/asdf/project-hub', 'uploads/presentation.pdf', 'completed'),
(13, 633041, '53', 'C', 'project hub', 'web', 'TEST', 'asdf ghjk', 'https://github.com/Arpita-chowdhury/project-hub', 'uploads/presentation.pdf', 'completed');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `completed_projects`
--
ALTER TABLE `completed_projects`
  ADD PRIMARY KEY (`serial`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `completed_projects`
--
ALTER TABLE `completed_projects`
  MODIFY `serial` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

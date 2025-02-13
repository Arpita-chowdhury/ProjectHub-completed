-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2024 at 06:47 PM
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
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `serial` int(5) NOT NULL,
  `team_id` int(6) NOT NULL,
  `project_title` varchar(50) NOT NULL,
  `supervisor` varchar(20) NOT NULL,
  `task` varchar(255) NOT NULL,
  `assign_date` date NOT NULL,
  `assign_time` time(5) NOT NULL,
  `deadline` date NOT NULL,
  `instruction` varchar(255) NOT NULL,
  `progress` varchar(100) NOT NULL,
  `report` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`serial`, `team_id`, `project_title`, `supervisor`, `task`, `assign_date`, `assign_time`, `deadline`, `instruction`, `progress`, `report`) VALUES
(14, 633041, 'test', 'TEST', 'test g2', '2024-02-05', '20:10:45.00000', '2024-02-19', 'kjk\r\nll\r\n', 'In-progress', ''),
(15, 633041, 'test', 'TEST', 'test', '2024-02-05', '22:54:20.00000', '2024-02-04', 'jh\r\nkj\r\nkj', 'Not Started', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`serial`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `serial` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2020 at 07:31 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `axiomsltd`
--

-- --------------------------------------------------------

--
-- Table structure for table `scores`
--

CREATE TABLE `scores` (
  `SN` int(11) NOT NULL,
  `team_name` varchar(50) NOT NULL,
  `played` int(11) NOT NULL,
  `wins` int(11) NOT NULL,
  `loss` int(11) NOT NULL,
  `draw` int(11) NOT NULL,
  `goals` int(11) NOT NULL,
  `conceded` int(11) NOT NULL,
  `goal_aggr` int(11) NOT NULL,
  `pts` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `scores`
--

INSERT INTO `scores` (`SN`, `team_name`, `played`, `wins`, `loss`, `draw`, `goals`, `conceded`, `goal_aggr`, `pts`) VALUES
(1, 'Manchester United FC', 10, 5, 2, 3, 27, 16, 11, 18),
(2, 'Chelsea FC', 10, 4, 4, 2, 32, 28, 4, 14),
(3, 'Arsenal FC', 10, 3, 6, 1, 19, 29, -10, 10),
(4, 'Manchester City', 10, 5, 3, 2, 27, 18, 9, 17),
(5, 'Liverpool FC', 10, 5, 3, 2, 19, 21, -2, 17),
(6, 'Tottenham Hotspur', 10, 2, 6, 2, 19, 31, -12, 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `scores`
--
ALTER TABLE `scores`
  ADD PRIMARY KEY (`SN`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `scores`
--
ALTER TABLE `scores`
  MODIFY `SN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

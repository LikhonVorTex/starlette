-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2022 at 12:08 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `checkerbot`
--

-- --------------------------------------------------------

--
-- Table structure for table `premium`
--

CREATE TABLE `premium` (
  `prems_id` int(11) NOT NULL,
  `subs_date` varchar(50) NOT NULL,
  `userid` varchar(50) NOT NULL,
  `prem_timer` varchar(50) NOT NULL,
  `add_time` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `premium`
--

INSERT INTO `premium` (`prems_id`, `subs_date`, `userid`, `prem_timer`, `add_time`) VALUES
(51, '1654155924', '1087333523', '1656747924', '30d'),
(52, '1654156090', '1087333523', '1659339924', '30d'),
(53, '1654156126', '1087333523', '1661931924', '30d'),
(54, '1654156153', '1087333523', '1664523924', '30d'),
(55, '1654156255', '1087333523', '1667115924', '30d'),
(56, '1654156360', '1087333523', '1669707924', '30d'),
(57, '1654156492', '1087333523', '1672299924', '30d'),
(58, '1654156584', '1087333523', '1674891924', '30d'),
(59, '1654156615', '1087333523', '1677483924', '30d'),
(60, '1654156729', '1087333523', '1680075924', '30d'),
(61, '1654156753', '1087333523', '1682667924', '30d');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `premium`
--
ALTER TABLE `premium`
  ADD PRIMARY KEY (`prems_id`),
  ADD UNIQUE KEY `prems_id` (`prems_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `premium`
--
ALTER TABLE `premium`
  MODIFY `prems_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2022 at 12:20 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `userid` varchar(50) NOT NULL,
  `registered_on` varchar(50) NOT NULL,
  `is_banned` varchar(50) NOT NULL,
  `is_muted` varchar(50) NOT NULL,
  `mute_timer` varchar(50) NOT NULL,
  `name` varchar(500) NOT NULL,
  `total_checked` varchar(50) NOT NULL,
  `total_cvv` varchar(50) NOT NULL,
  `total_ccn` varchar(50) NOT NULL,
  `isPremium` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `userid`, `registered_on`, `is_banned`, `is_muted`, `mute_timer`, `name`, `total_checked`, `total_cvv`, `total_ccn`, `isPremium`) VALUES
(1, '1087333523', '1651673784', 'False', 'False', '0', '0', '1245', '317', '316', 'yes'),
(2, '691766336', '1652697580', 'False', 'False', '0', '0', '50', '12', '12', 'no'),
(3, '5329433848', '1654121477', 'False', 'False', '0', '0', '104', '10', '15', 'yes'),
(4, '1239474876', '1657213248', 'False', 'False', '0', '0', '0', '0', '0', 'no'),
(5, '1488234939', '1657604942', 'False', 'False', '0', '0', '38', '1', '2', 'no'),
(6, '1883597996', '1657613736', 'False', 'False', '0', '0', '86', '1', '8', 'no'),
(7, '745059204', '1657617995', 'False', 'False', '0', '0', '42', '0', '6', 'no'),
(8, '5324500252', '1657618907', 'False', 'False', '0', '0', '22', '0', '3', 'no'),
(9, '760224907', '1657622146', 'False', 'False', '0', '0', '17', '2', '2', 'no'),
(10, '779806930', '1657659834', 'False', 'False', '0', '0', '70', '5', '5', 'no'),
(11, '1351120602', '1657714746', 'False', 'False', '0', '0', '0', '0', '0', 'no'),
(12, '1188028420', '1657714766', 'False', 'False', '0', '0', '24', '1', '1', 'no');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

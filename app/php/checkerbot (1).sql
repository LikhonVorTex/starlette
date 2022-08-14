-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2022 at 04:48 PM
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
-- Table structure for table `antispam`
--

CREATE TABLE `antispam` (
  `id` int(11) NOT NULL,
  `userid` varchar(50) NOT NULL,
  `last_checked_on` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `antispam`
--

INSERT INTO `antispam` (`id`, `userid`, `last_checked_on`) VALUES
(1, '691766336', '1659969772'),
(2, '5329433848', '1658947460'),
(3, '1488234939', '1659963775'),
(4, '1883597996', '1659627668'),
(5, '745059204', '1659704046'),
(6, '5324500252', '1659692072'),
(7, '760224907', '1658565828'),
(8, '779806930', '1659786828'),
(9, '1351120602', '1657714746'),
(10, '1188028420', '1659967310'),
(11, '2098021866', '1657867207'),
(12, '5413370206', '1658922020'),
(13, '5137972528', '1659960153');

-- --------------------------------------------------------

--
-- Table structure for table `credentials`
--

CREATE TABLE `credentials` (
  `cuserid` int(100) NOT NULL,
  `userid` varchar(100) NOT NULL,
  `passwd` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `credentials`
--

INSERT INTO `credentials` (`cuserid`, `userid`, `passwd`, `status`) VALUES
(8, '1087333523', 'YuaiJilIeWcm', '1'),
(9, '-1001648369654', 'd1nsYww1wGgu', '1'),
(10, '1883597996', 'RwdGxrCXoiF1', '1'),
(11, '5329433848', 'XBg8meKIBagG', '1'),
(12, '1488234939', 'E2FJJFjRocuJ', '1'),
(13, '1188028420', 'hCw7AJCaUjid', '1'),
(14, '745059204', 'cpVU2pn0PyrJ', '1'),
(15, '1239721881', '2QP24qvPBSqc', '1'),
(16, '5413370206', 'pzIT5REEAU3T', '1'),
(17, '5137972528', '0qtC3tuNpzl1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `global_checker_stats`
--

CREATE TABLE `global_checker_stats` (
  `total_checked` varchar(100) NOT NULL,
  `total_ccn` varchar(100) NOT NULL,
  `total_cvv` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `global_checker_stats`
--

INSERT INTO `global_checker_stats` (`total_checked`, `total_ccn`, `total_cvv`) VALUES
('2576', '463', '459');

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
  `xname` varchar(500) NOT NULL,
  `total_checked` varchar(50) NOT NULL,
  `total_cvv` varchar(50) NOT NULL,
  `total_ccn` varchar(50) NOT NULL,
  `isPremium` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `userid`, `registered_on`, `is_banned`, `is_muted`, `mute_timer`, `xname`, `total_checked`, `total_cvv`, `total_ccn`, `isPremium`) VALUES
(1, '1087333523', '1651673784', 'False', 'False', '0', '0', '1336', '326', '323', 'yes'),
(2, '691766336', '1652697580', 'False', 'False', '0', '0', '244', '61', '53', 'no'),
(3, '5329433848', '1654121477', 'False', 'False', '0', '0', '106', '10', '15', 'yes'),
(4, '1239474876', '1657213248', 'False', 'False', '0', '0', '0', '0', '0', 'no'),
(5, '1488234939', '1657604942', 'False', 'False', '0', '0', '414', '6', '6', 'no'),
(6, '1883597996', '1657613736', 'False', 'False', '0', '0', '109', '3', '9', 'no'),
(7, '745059204', '1657617995', 'False', 'False', '0', '0', '45', '0', '6', 'no'),
(8, '5324500252', '1657618907', 'False', 'False', '0', '0', '34', '0', '3', 'no'),
(9, '760224907', '1657622146', 'False', 'False', '0', '0', '17', '2', '2', 'no'),
(10, '779806930', '1657659834', 'False', 'False', '0', '0', '102', '8', '8', 'no'),
(11, '1351120602', '1657714746', 'False', 'False', '0', '0', '0', '0', '0', 'no'),
(12, '1188028420', '1657714766', 'False', 'False', '0', '0', '151', '28', '25', 'no'),
(13, '5413370206', '1658921263', 'False', 'False', '0', 'YMMLLL', '2', '0', '0', 'no'),
(14, '5338135771', '1659197272', 'False', 'False', '0', '', '0', '0', '0', 'no'),
(15, '891472313', '1659359433', 'False', 'False', '0', '', '0', '0', '0', 'no'),
(16, '5137972528', '1659929781', 'False', 'False', '0', 'mzhyde59', '3', '2', '0', 'no');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `antispam`
--
ALTER TABLE `antispam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `credentials`
--
ALTER TABLE `credentials`
  ADD PRIMARY KEY (`cuserid`);

--
-- Indexes for table `premium`
--
ALTER TABLE `premium`
  ADD PRIMARY KEY (`prems_id`),
  ADD UNIQUE KEY `prems_id` (`prems_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `antispam`
--
ALTER TABLE `antispam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `credentials`
--
ALTER TABLE `credentials`
  MODIFY `cuserid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `premium`
--
ALTER TABLE `premium`
  MODIFY `prems_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

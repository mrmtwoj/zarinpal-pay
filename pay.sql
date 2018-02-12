-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2017 at 05:23 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pay`
--

-- --------------------------------------------------------

--
-- Table structure for table `pay`
--

CREATE TABLE `pay` (
  `id` int(11) NOT NULL,
  `amount` int(11) DEFAULT NULL,
  `authority` varchar(100) CHARACTER SET utf8 COLLATE utf8_persian_ci DEFAULT NULL,
  `refid` varchar(100) CHARACTER SET utf8 COLLATE utf8_persian_ci DEFAULT NULL,
  `tokenid` int(20) DEFAULT NULL,
  `data` text,
  `ip` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pay`
--

INSERT INTO `pay` (`id`, `amount`, `authority`, `refid`, `tokenid`, `data`, `ip`) VALUES
(151, 100, '000000000000000000000000000000010391', '1', 5681, '2017-03-05', '192.168.1.7'),
(152, 200, '000000000000000000000000000000010392', NULL, 2432, '2017-03-05', '192.168.1.7'),
(153, 100, '000000000000000000000000000000010393', NULL, 24415, '2017-03-05', '192.168.1.7'),
(154, 200, '000000000000000000000000000000010394', NULL, 23157, '2017-03-05', '192.168.1.7'),
(155, 100, '000000000000000000000000000000010396', NULL, 25709, '2017-03-05', '192.168.1.7'),
(156, 200, '000000000000000000000000000000010397', NULL, 3286, '2017-03-06', '192.168.1.7'),
(157, 200, '000000000000000000000000000000010399', NULL, 13552, '2017-03-06', '192.168.1.7');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pay`
--
ALTER TABLE `pay`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pay`
--
ALTER TABLE `pay`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

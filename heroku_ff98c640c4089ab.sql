-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Dec 08, 2016 at 08:49 AM
-- Server version: 5.6.28
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `heroku_ff98c640c4089ab`
--
CREATE DATABASE IF NOT EXISTS `heroku_ff98c640c4089ab` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `heroku_ff98c640c4089ab`;

-- --------------------------------------------------------

--
-- Table structure for table `cuisines`
--

DROP TABLE IF EXISTS `cuisines`;
CREATE TABLE `cuisines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cuisines`
--

INSERT INTO `cuisines` (`id`, `name`) VALUES
(1, 'Indian'),
(2, 'German'),
(6, 'Thai'),
(8, 'Mexican');

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

DROP TABLE IF EXISTS `restaurants`;
CREATE TABLE `restaurants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `cuisine_id` int(11) DEFAULT NULL,
  `total_rating` float DEFAULT NULL,
  `rating_count` int(11) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`id`, `name`, `address`, `phone`, `cuisine_id`, `total_rating`, `rating_count`, `picture`) VALUES
(10, 'new', 'new', 'new', 6, 1, 1, NULL),
(11, 'Weiner Schnitzel', 'Berlin', '+32 32333 323233', 2, 318, 57, NULL),
(13, 'jjhjkh', 'hjkh', 'hkjdsa', 2, 1, 1, NULL),
(14, 'sdakhjkj', 'jkh', 'jkhjk', 2, 25, 4, NULL),
(16, 'Z', 'cfgc', 'gfcg', 2, 31, 4, NULL),
(18, 'asdf', 'asdf', 'asdf', 2, 0, 0, ''),
(19, 'Fancy German Place', 'asdfasdfasdf', 'asdfasdfasdf', 2, 101, 20, 'http://www.pdcdc.org/wp-content/uploads/2016/03/restaurant-939435_960_720.jpg'),
(20, 'hjkhs', 'hjkh', 'jk', 1, 11.5, 4, 'hjk');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `author` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `rating` float DEFAULT NULL,
  `restaurant_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `author`, `description`, `rating`, `restaurant_id`) VALUES
(5, 'asdf', 'asdf', 1, 16),
(6, '1234', '12342', 10, 16),
(7, '1234', '12342', 10, 16),
(8, '1234', '12342', 10, 16),
(9, 'asdf', 'asdf', 10, 11),
(10, 'asdf', 'asdf', 10, 11),
(11, 'asdf', 'asdf', 10, 11),
(12, 'asdf', 'asdf', 10, 11),
(13, 'asdf', 'asdf', 10, 11),
(14, 'asdf', 'asdf', 10, 11),
(15, 'asdf', 'asdf', 10, 11),
(16, 'asdf', 'asdf', 10, 11),
(17, 'asdf', 'asdf', 10, 11),
(18, 'asdf', 'asdf', 10, 11),
(19, 'asdf', 'asdf', 10, 11),
(20, 'asdf', 'asdf', 10, 11),
(21, 'asdf', 'asdf', 10, 11),
(22, 'asdf', 'asdf', 10, 11),
(23, 'asdf', 'asdf', 10, 11),
(24, 'TEST', 'GOOD', 1, 11),
(25, 'TEST', 'GOOD', 1, 11),
(26, 'TEST', 'GOOD', 1, 11),
(27, 'TEST', 'GOOD', 1, 11),
(28, 'TEST', 'GOOD', 1, 11),
(29, 'TEST', 'GOOD', 1, 11),
(30, 'TEST', 'GOOD', 1, 11),
(31, 'TEST', 'GOOD', 1, 11),
(32, 'TEST', 'GOOD', 1, 11),
(33, 'TEST', 'GOOD', 1, 11),
(34, 'TEST', 'GOOD', 1, 11),
(35, 'TEST', 'GOOD', 1, 11),
(36, 'TEST', 'GOOD', 1, 11),
(37, 'TEST', 'GOOD', 1, 11),
(38, 'TEST', 'GOOD', 1, 11),
(39, 'TEST', 'GOOD', 1, 11),
(40, 'TEST', 'GOOD', 1, 11),
(41, 'TEST', 'GOOD', 1, 11),
(42, 'TEST', 'GOOD', 1, 11),
(43, 'TEST', 'GOOD', 1, 11),
(44, 'TEST', 'GOOD', 1, 11),
(45, 'TEST', 'GOOD', 1, 11),
(46, 'TEST', 'GOOD', 1, 11),
(47, 'TEST', 'GOOD', 1, 11),
(48, 'TEST', 'GOOD', 1, 11),
(49, 'TEST', 'GOOD', 1, 11),
(50, 'yes', 'yes', 8, 19),
(51, 'yes', 'yes', 8, 19),
(52, 'yes', 'yes', 8, 19),
(53, 'yes', 'yes', 8, 19),
(54, 'yes', 'yes', 8, 19),
(55, 'yes', 'yes', 8, 19),
(56, 'yes', 'yes', 8, 19),
(57, 'yes', 'yes', 8, 19),
(58, 'yes', 'yes', 8, 19),
(59, 'no', 'no', 1, 19),
(60, 'no', 'no', 1, 19),
(61, 'dsd', 'sad', 5.5, 20),
(62, 'asdfasdf', 'ads', 1, 20),
(63, 'bob', 'bob', 2.5, 20),
(64, 'bob', 'bob', 2.5, 20);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cuisines`
--
ALTER TABLE `cuisines`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cuisines`
--
ALTER TABLE `cuisines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

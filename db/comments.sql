-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2020 at 12:25 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `findawork`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `movie_id` varchar(100) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `comment` text NOT NULL,
  `name` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `post_date` varchar(100) NOT NULL,
  `date_of_birth` varchar(100) NOT NULL,
  `ipaddress` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `movie_id`, `user_id`, `comment`, `name`, `gender`, `post_date`, `date_of_birth`, `ipaddress`) VALUES
(1, '4', '1', 'hello world', 'Luke Skywalker', 'male', '2020-20-02UTC21:53:1850', '19BBY', '::1'),
(2, '4', '1', 'hello world', 'Luke Skywalker', 'male', '2020-20-02UTC22:08:1050', '19BBY', '::1'),
(3, '4', '1', 'hello world', 'Luke Skywalker', 'male', '2020-20-02UTC22:16:0850', '19BBY', '::1'),
(4, '4', '1', 'hello world', 'Luke Skywalker', 'male', '2020-20-02UTC22:16:4850', '19BBY', '::1'),
(5, '4', '1', 'hello world', 'Luke Skywalker', 'male', '2020-20-02UTC22:18:4750', '19BBY', '::1'),
(6, '3', '1', 'lorem ipsumlorem ipsum lorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsum', 'Luke Skywalker', 'male', '2020-20-02UTC22:42:5650', '19BBY', '::1'),
(7, '3', '1', 'lorem ipsumlorem ipsum lorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsum', 'Luke Skywalker', 'male', '2020-20-02UTC22:55:0850', '19BBY', '::1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2025 at 07:45 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `votings`
--

-- --------------------------------------------------------

--
-- Table structure for table `candidate`
--

CREATE TABLE `candidate` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `slogan` varchar(100) DEFAULT NULL,
  `party_id` int(11) DEFAULT NULL,
  `position` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `candidate`
--

INSERT INTO `candidate` (`id`, `name`, `slogan`, `party_id`, `position`) VALUES
(1, 'nrm', 'uwdwuhwuh', 1, 'FOOD CHIEF'),
(2, 'unar', 'uwdwuhwuh', 2, 'Guild president'),
(3, 'junior', 'uwdwuhwuh', 1, 'FOOD CHIEF'),
(4, 'bobi', 'uwdwuhwuh', 2, 'Guild president'),
(5, 'peter', 'uwdwuhwuh', 2, 'Vice president'),
(6, 'martin', 'uwdwuhwuh', 1, 'FOOD CHIEF'),
(7, 'marvin', 'uwdwuhwuh', 2, 'Guild president');

-- --------------------------------------------------------

--
-- Table structure for table `done_voting`
--

CREATE TABLE `done_voting` (
  `id` int(11) NOT NULL,
  `voter_name` varchar(30) DEFAULT NULL,
  `candidate_party_name` varchar(20) DEFAULT NULL,
  `candidate_name` varchar(20) DEFAULT NULL,
  `position` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `done_voting`
--

INSERT INTO `done_voting` (`id`, `voter_name`, `candidate_party_name`, `candidate_name`, `position`) VALUES
(5, 'admin', 'nup', 'bobi', 'Guild president');

-- --------------------------------------------------------

--
-- Table structure for table `party`
--

CREATE TABLE `party` (
  `id` int(3) NOT NULL,
  `name` varchar(20) NOT NULL,
  `slogan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `party`
--

INSERT INTO `party` (`id`, `name`, `slogan`) VALUES
(1, 'nrm', 'uwdwuhwuh'),
(2, 'nup', 'uwdwuhwuh'),
(4, 'dp', 'programming');

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `name`, `status`) VALUES
(1, 'Guild president', 'active'),
(6, 'FOOD CHIEF', 'active'),
(7, 'Vice president', 'disabled');

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE `user_profiles` (
  `id` int(11) NOT NULL,
  `email` varchar(40) NOT NULL,
  `pwd` varchar(110) DEFAULT NULL,
  `confirm_pwd` varchar(110) DEFAULT NULL,
  `tel` int(11) DEFAULT NULL,
  `images` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_profiles`
--

INSERT INTO `user_profiles` (`id`, `email`, `pwd`, `confirm_pwd`, `tel`, `images`) VALUES
(1, 'admin@gmail.com', 'wew', 'dd', 889, 'home-img-2.png'),
(2, 'Raymond@gmail.com', '1234', '1234', 123456789, 'home-img-3.png'),
(3, 'mvn@gmail.com', 'marvins123', 'marvin', 89439847, 'sda'),
(4, 'mark@gmail.com', 'mark994', 'mark994', 758239277, 'gyguuy'),
(5, 'peter@gmail.com', '12peter', 'peter', 705786643, 'drukmki'),
(6, 'umaru@gmail.com', 'umaru123', 'umaru123', 2147483647, 'jakdlsji');

-- --------------------------------------------------------

--
-- Table structure for table `voters`
--

CREATE TABLE `voters` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `Reg_number` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `phone_no` int(11) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `confirm_pwd` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `voters`
--

INSERT INTO `voters` (`id`, `name`, `Reg_number`, `email`, `password`, `status`, `phone_no`, `photo`, `confirm_pwd`) VALUES
(1, 'peter', 'computer23', 'peter@gmail.com', 'peter8', 'user', 704849243, NULL, NULL),
(2, 'admin', 'admin333', 'admin@gmail.com', 'admin123', 'admin', 759204938, NULL, NULL),
(3, 'marvin', '77IT04', 'marvin@gmail.com', 'ddddd3', 'user', 739444758, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `candidate`
--
ALTER TABLE `candidate`
  ADD PRIMARY KEY (`id`),
  ADD KEY `part_id` (`party_id`),
  ADD KEY `fk_position_name` (`position`);

--
-- Indexes for table `done_voting`
--
ALTER TABLE `done_voting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `party`
--
ALTER TABLE `party`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voters`
--
ALTER TABLE `voters`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `candidate`
--
ALTER TABLE `candidate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `done_voting`
--
ALTER TABLE `done_voting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `party`
--
ALTER TABLE `party`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_profiles`
--
ALTER TABLE `user_profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `voters`
--
ALTER TABLE `voters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `candidate`
--
ALTER TABLE `candidate`
  ADD CONSTRAINT `candidate_ibfk_1` FOREIGN KEY (`party_id`) REFERENCES `party` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_position_name` FOREIGN KEY (`position`) REFERENCES `positions` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

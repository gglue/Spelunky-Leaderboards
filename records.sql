-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2021 at 02:07 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `records`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `accountID` int(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`accountID`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$OabYLeaTGVwP3d.meq1ME.685NxzfQMxrBVrcEev4fKY6w6VHB0Rm'),
(13, 'generalglue', '$2y$10$JCKHyqkAEI23omBdmv35i.ecWo.mPW59LuNd2uj5VLUKvtaCfS/xO'),
(14, 'twentyletterslongpls', '$2y$10$PTNtXOkTbY0xgL6fCDBU4.CkWEs8rOtOKZwJ8NVG9Zk1x4ge1OiPq'),
(15, 'ihateyou', '$2y$10$isKVcVU6kxjYvLnT7Vuh9.AhqEmj77u88EWHHEufeCd2z./oikBuu');

-- --------------------------------------------------------

--
-- Table structure for table `characters`
--

CREATE TABLE `characters` (
  `characterID` int(2) NOT NULL,
  `characterName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `characters`
--

INSERT INTO `characters` (`characterID`, `characterName`) VALUES
(1, 'Ana Speleunky'),
(2, 'Margaret Tunnel'),
(3, 'Colin Northward'),
(4, 'Roffy D. Sloth'),
(5, 'Alto Singh'),
(6, 'Liz Mutton'),
(7, 'Nekka the Eagle'),
(8, 'LISE Project'),
(9, 'Coco von Diamonds'),
(10, 'Manfred Tunnel'),
(11, 'Little Jay'),
(12, 'Tina Flan'),
(13, 'Valerie Crump'),
(14, 'Au'),
(15, 'Demi von Diamonds'),
(16, 'Pilot'),
(17, 'Princess Airyn'),
(18, 'Dirk Yamoaka'),
(19, 'Guy Spelunky'),
(20, 'Classic Guy');

-- --------------------------------------------------------

--
-- Table structure for table `places`
--

CREATE TABLE `places` (
  `placeID` int(2) NOT NULL,
  `placeName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `places`
--

INSERT INTO `places` (`placeID`, `placeName`) VALUES
(1, 'The Dwellings (1-1)'),
(2, 'The Dwellings (1-2)'),
(3, 'The Dwellings (1-3)'),
(4, 'The Dwellings (1-4)'),
(5, 'The Jungle (2-1)'),
(6, 'The Jungle (2-2)'),
(7, 'The Jungle (2-3)'),
(8, 'The Jungle (2-4)'),
(9, 'The Volcana (2-1)'),
(10, 'The Volcana (2-2)'),
(11, 'The Volcana (2-3)'),
(12, 'The Volcana (2-4)'),
(13, 'Olmec\'s Lair (3-1)'),
(14, 'The Tide Pool (4-1)'),
(15, 'The Tide Pool (4-2)'),
(16, 'The Tide Pool (4-3)'),
(17, 'The Tide Pool (4-4)'),
(18, 'Abzu (4-4)'),
(19, 'The Temple of Anubis (4-1)'),
(20, 'The Temple of Anubis (4-2)'),
(21, 'The Temple of Anubis (4-3)'),
(22, 'City of Gold (4-3)'),
(23, 'The Temple of Anubis (4-4)'),
(24, 'Duat (4-4)'),
(25, 'Ice Caves (5-1)'),
(26, 'The Neo Babylon (6-1)'),
(27, 'The Neo Babylon (6-2)'),
(28, 'The Neo Babylon (6-3)'),
(29, 'Tiamat\'s Throne (6-4)'),
(30, 'The Sunken City (7-1)'),
(31, 'The Sunken City (7-2)'),
(32, 'Eggplant World (7-2)'),
(33, 'The Sunken City (7-3)'),
(34, 'Hundun\'s Hideaway (7-4)'),
(35, 'Cosmic Ocean');

-- --------------------------------------------------------

--
-- Table structure for table `run`
--

CREATE TABLE `run` (
  `runID` int(20) NOT NULL,
  `characterID` int(2) NOT NULL,
  `time` varchar(8) NOT NULL,
  `placeID` int(2) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `comment` text NOT NULL,
  `accountID` int(10) NOT NULL,
  `money` int(20) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `run`
--

INSERT INTO `run` (`runID`, `characterID`, `time`, `placeID`, `url`, `comment`, `accountID`, `money`, `createdAt`) VALUES
(4, 8, '00:44:25', 34, '', 'hi', 1, 312312, '2020-12-30 08:24:41'),
(5, 4, '00:22:33', 6, 'https://www.youtube.com/embed/87je-QAPZIU', 'tset 2', 1, 95128312, '2020-12-30 08:28:27'),
(6, 2, '23:59:59', 14, '', 'fuck you', 1, 5341, '2020-12-30 08:29:42'),
(7, 20, '00:11:22', 3, 'https://www.youtube.com/embed/3YL6SwxYrc0', 'cringe', 1, 694591, '2020-12-30 22:25:54'),
(8, 16, '00:01:55', 25, 'https://www.youtube.com/embed/39UDZMgPg5k', 'hello', 1, 0, '2020-12-30 22:41:32'),
(9, 17, '00:44:25', 24, '', '', 1, 0, '2020-12-30 22:48:03'),
(10, 11, '00:44:25', 16, '', '', 1, 0, '2020-12-30 22:48:27'),
(11, 14, '00:27:32', 27, 'https://www.youtube.com/embed/h4SMSCKOXO8', 'i hate myself', 1, 77250, '2020-12-30 22:59:32'),
(13, 8, '00:18:27', 14, '', 'day 1 of 2020', 1, 75025, '2021-01-02 10:53:49'),
(27, 14, '00:44:25', 7, '', '', 14, 312312, '2021-01-03 14:41:11'),
(28, 8, '00:18:27', 14, '', '', 13, 75025, '2021-01-03 22:01:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`accountID`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `accountID` (`accountID`);

--
-- Indexes for table `characters`
--
ALTER TABLE `characters`
  ADD PRIMARY KEY (`characterID`),
  ADD UNIQUE KEY `characterID` (`characterID`);

--
-- Indexes for table `places`
--
ALTER TABLE `places`
  ADD PRIMARY KEY (`placeID`);

--
-- Indexes for table `run`
--
ALTER TABLE `run`
  ADD PRIMARY KEY (`runID`),
  ADD UNIQUE KEY `runID` (`runID`),
  ADD KEY `characterID` (`characterID`),
  ADD KEY `placeID` (`placeID`),
  ADD KEY `accountID` (`accountID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `accountID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `characters`
--
ALTER TABLE `characters`
  MODIFY `characterID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `places`
--
ALTER TABLE `places`
  MODIFY `placeID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `run`
--
ALTER TABLE `run`
  MODIFY `runID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `run`
--
ALTER TABLE `run`
  ADD CONSTRAINT `run_ibfk_1` FOREIGN KEY (`placeID`) REFERENCES `places` (`placeID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `run_ibfk_2` FOREIGN KEY (`characterID`) REFERENCES `characters` (`characterID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `run_ibfk_3` FOREIGN KEY (`accountID`) REFERENCES `accounts` (`accountID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

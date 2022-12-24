-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 25, 2022 at 12:41 AM
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
-- Database: `inshield`
--

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `playerID` int(11) NOT NULL,
  `iv` varchar(32) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `points` varchar(256) NOT NULL,
  `leaderboard_position` varchar(256) NOT NULL,
  `streak` varchar(256) NOT NULL,
  `last_login_time` varchar(256) NOT NULL,
  `badge` varchar(256) NOT NULL,
  `ranking_category1` varchar(256) NOT NULL,
  `ranking_category2` varchar(256) NOT NULL,
  `ranking_category3` varchar(256) NOT NULL,
  `ranking_category4` varchar(256) NOT NULL,
  `levels` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`playerID`, `iv`, `email`, `password`, `points`, `leaderboard_position`, `streak`, `last_login_time`, `badge`, `ranking_category1`, `ranking_category2`, `ranking_category3`, `ranking_category4`, `levels`) VALUES
(1, 'ff06726e8e100b0eca1fd2c1276f0cd0', 'thanosDaTitan1234@gmail.com', 'ed09024decdd54035d7e68699d6d71d46049deb04c16dc94c3d0e8c2057c69fb', '963c9419a7bfd983bd8cef0ffa5a96fa', '963c9419a7bfd983bd8cef0ffa5a96fa', '963c9419a7bfd983bd8cef0ffa5a96fa', '52153a03ea850e80ff9ae26f58bcfe3952a15fa3759206490126f1a65d1b173e', '963c9419a7bfd983bd8cef0ffa5a96fa', '963c9419a7bfd983bd8cef0ffa5a96fa', '963c9419a7bfd983bd8cef0ffa5a96fa', '963c9419a7bfd983bd8cef0ffa5a96fa', '963c9419a7bfd983bd8cef0ffa5a96fa', '34834a083f97cb989062ece895b6e304'),
(2, 'ff9280ddd5de03ad66ae80e679c3cb33', 'pikachuInAPokeball1234@gmail.com', '3b329ff7c9051584eed1b3923685e63a09d754c10520f3833f052b1ffec67d67', '090b607e0145b4630f1f8b3112f462fb', '7c862f40cda2dd52fa2ed15820c9685f', '7c862f40cda2dd52fa2ed15820c9685f', 'ae3b2be76e4695917426c1a638c8d9ad6c7cef540c7e216721649b15f465bbd2', '7c862f40cda2dd52fa2ed15820c9685f', '17336ddab7d57a1b4c1f50fe7316e940', '17336ddab7d57a1b4c1f50fe7316e940', '17336ddab7d57a1b4c1f50fe7316e940', '92e92f4a0f7565b3e868a097a7d2563b', '17336ddab7d57a1b4c1f50fe7316e940');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`playerID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `players`
--
ALTER TABLE `players`
  MODIFY `playerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

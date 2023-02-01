-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2023 at 07:24 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

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
  `displayName` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `points` varchar(256) NOT NULL,
  `leaderboard_position` varchar(256) NOT NULL,
  `streak` varchar(256) NOT NULL,
  `last_login_time` varchar(256) NOT NULL,
  `latest_login_time` varchar(256) NOT NULL,
  `badge` varchar(256) NOT NULL,
  `ranking_category1` varchar(256) NOT NULL,
  `ranking_category2` varchar(256) NOT NULL,
  `ranking_category3` varchar(256) NOT NULL,
  `ranking_category4` varchar(256) NOT NULL,
  `levels` varchar(256) NOT NULL,
  `google2FA_secretKey` varchar(256) DEFAULT NULL,
  `profilePic` varchar(256) DEFAULT NULL,
  `time_lvl1` varchar(256) DEFAULT NULL,
  `time_lvl2` varchar(256) DEFAULT NULL,
  `time_lvl3` varchar(256) DEFAULT NULL,
  `time_lvl4` varchar(256) DEFAULT NULL,
  `time_lvl5` varchar(256) DEFAULT NULL,
  `time_lvl6` varchar(256) DEFAULT NULL,
  `time_lvl7` varchar(256) DEFAULT NULL,
  `time_lvl8` varchar(256) DEFAULT NULL,
  `time_lvl9` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`playerID`, `iv`, `email`, `displayName`, `password`, `points`, `leaderboard_position`, `streak`, `last_login_time`, `latest_login_time`, `badge`, `ranking_category1`, `ranking_category2`, `ranking_category3`, `ranking_category4`, `levels`, `google2FA_secretKey`, `profilePic`, `time_lvl1`, `time_lvl2`, `time_lvl3`, `time_lvl4`, `time_lvl5`, `time_lvl6`, `time_lvl7`, `time_lvl8`, `time_lvl9`) VALUES
(1, '7f199c03727b139c22a0bb1d7de2b986', 'c5e8487c181e948510de1baf29ef30c743b8a53ef7e2eda971637e067f90ccc7', '8e0e48a8da0ed730e0130e746b4406e90dcd9db53df08334a5d9f86a008eb8ee', 'bbad491d82d8d6e2ab86f59c02c108a536ca4a6a3d38491fbb59c25c6a46b3fa', '2c297385e19a48925e17b27adf706c79', '4c9e39cec227e76fab3d2e38b4d83ad7', '543e111fe8b65f18e6dfd8f73c1a13d4', 'd3c1ccb5f281fbdeabff63b41e892a57492192dc1ab2eae572b2b303379d0c69', 'd3c1ccb5f281fbdeabff63b41e892a57363a855e8ee63208129532d53d4dde8e', 'd16b257971dd91e624df8456ee0dbec8', '543e111fe8b65f18e6dfd8f73c1a13d4', '543e111fe8b65f18e6dfd8f73c1a13d4', '543e111fe8b65f18e6dfd8f73c1a13d4', '543e111fe8b65f18e6dfd8f73c1a13d4', 'd16b257971dd91e624df8456ee0dbec8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'dfd221a06fa8bf83b78619982f8bcb66', '895004fd5fbe99bde8a55bb50cee08b7a9b6d7a505d8ebbc07c82f810dd62883', '4c7c8533ca0caf9c763b357c02f94257ebc4b237d8df031b26ea9e05dca64896058d83732a7b3938070ddd147c18de88', '3b329ff7c9051584eed1b3923685e63a09d754c10520f3833f052b1ffec67d67', 'e154248a2df6e72c328d1bf514a51fad', 'add66857b62032e932715f7399565e47', '62344039978d1d4bc734d4b52ed119b0', 'ebc6e7c0fa88267be7d17e6956a435c145908260ee23324cd19125869f787c98', 'ebc6e7c0fa88267be7d17e6956a435c145908260ee23324cd19125869f787c98', '62344039978d1d4bc734d4b52ed119b0', '62344039978d1d4bc734d4b52ed119b0', '62344039978d1d4bc734d4b52ed119b0', '62344039978d1d4bc734d4b52ed119b0', '62344039978d1d4bc734d4b52ed119b0', 'efda4f2fd3875bd154b31ef31a0d47c7', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, '62e596665a2372baea7adde394dee9a3', 'c5c29656d213b8a81c739e9fb7a87a1ce00359c0e7c1b13c1d8cf921f8732c6f', 'b1ba93068d4200839194cd82948a99d8e00b4da2f543cbaf3657079dceeb6ef5', '9d98fb8cd559fbb9f122185df91b6a889dcb42db9f8be9f69e351ff9ea4151ca', '173b5c4f4f9ccb035f0349e5d4f9978b', '8802271d98e99ef9e77a6ecf4e546817', '69618f64c6d8a45f93567fb8183c8639', '29b122c47a67c606c34ee0d407c4f371bf656bc5a17c162721238032cdc85645', '29b122c47a67c606c34ee0d407c4f371bf656bc5a17c162721238032cdc85645', '69618f64c6d8a45f93567fb8183c8639', '69618f64c6d8a45f93567fb8183c8639', '69618f64c6d8a45f93567fb8183c8639', '69618f64c6d8a45f93567fb8183c8639', '69618f64c6d8a45f93567fb8183c8639', '5b1c8878459264014f3a9cbe37d75718', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, '1c5c8e3859281487b66a6a074d58389a', 'bb2f8eee409cdaf2573ee9927a1e36cb54d154069d795a1509efc5924c12a0bf', '11c648bc875ad44b6607068734c16f8a70e7aea254d5baf95437650205e8efe3', 'b20595a9effb713b8760c8ef06e4e071dbaa5ae89282995caa8e8acddf367aae', '90e4c60553867dddb49cc35303fd23b1', '5d5c93b82c5aba56af2f1f558d0be126', '2fa00b3b5c7dc0a7b37e7d17e92fc62d', 'bf9022255c063dae282315efef4f190fd57556aa5369fc1c73a0d7543065cce4', 'bf9022255c063dae282315efef4f190fd57556aa5369fc1c73a0d7543065cce4', '2fa00b3b5c7dc0a7b37e7d17e92fc62d', '2fa00b3b5c7dc0a7b37e7d17e92fc62d', '2fa00b3b5c7dc0a7b37e7d17e92fc62d', '2fa00b3b5c7dc0a7b37e7d17e92fc62d', '2fa00b3b5c7dc0a7b37e7d17e92fc62d', '5d5c93b82c5aba56af2f1f558d0be126', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, '9bfdeb0b4fc426a8e456ef1a670993fa', '3024fac3289e5cc72bfc67566fbcc3be264596c5009bae9254bfa36a87b8c596', '71121685bd1239df0154e581511796a95324c7ec22a1d2148c6996b56ee4c2de', '8689499c8d54848c6d39eadef874bc39cef6dd02c44fed114100ef5d5c9f5d2a', '4ae5f93beac8d210a1fa82b1cf735c16', '17ddfee79fb289e386c9414d416ca0c0', '39f4dba32801bd5d8216ca0d8fbb91e4', '8742de6456d3afe3c43b203706ba54a490fa60bb7c879001a3b60e57e97d1222', '8742de6456d3afe3c43b203706ba54a490fa60bb7c879001a3b60e57e97d1222', '39f4dba32801bd5d8216ca0d8fbb91e4', '39f4dba32801bd5d8216ca0d8fbb91e4', '39f4dba32801bd5d8216ca0d8fbb91e4', '39f4dba32801bd5d8216ca0d8fbb91e4', '39f4dba32801bd5d8216ca0d8fbb91e4', '3c77d078fd6ebd47dc0f3a20bb58757d', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, '3602e67b3dc4c19677f69bd1e2e4e80e', 'c084283d6a54d5c5e0b48ac8aa7711bb189d72167ffc1b2d36290bed4a24bfee', 'f6fbc0aac5fad0b7b77798b1f2fac5ddd7eca7956dca3a79a1bb4defe88bf12d', '2425742ced1aeff9d7e657bda642b858a20ececc22379825dd5ad117ea237a38', '059cdccdc2e199afb81873722bc8eed4', 'f288326fa42dd4124491189a647d151a', '059cdccdc2e199afb81873722bc8eed4', '97d3842602512a6dbd611d27e2551db8586132925540a42ebc193283532c2a3a', '97d3842602512a6dbd611d27e2551db8586132925540a42ebc193283532c2a3a', '059cdccdc2e199afb81873722bc8eed4', '059cdccdc2e199afb81873722bc8eed4', '059cdccdc2e199afb81873722bc8eed4', '059cdccdc2e199afb81873722bc8eed4', '059cdccdc2e199afb81873722bc8eed4', '1833a9ebba05d3953b66c87772ca9a94', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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
  MODIFY `playerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

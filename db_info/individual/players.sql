-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2023 at 09:26 PM
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
  `displayEmail` varchar(256) NOT NULL,
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
  `profilePic` mediumtext DEFAULT NULL,
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

INSERT INTO `players` (`playerID`, `iv`, `email`, `displayEmail`, `displayName`, `password`, `points`, `leaderboard_position`, `streak`, `last_login_time`, `latest_login_time`, `badge`, `ranking_category1`, `ranking_category2`, `ranking_category3`, `ranking_category4`, `levels`, `google2FA_secretKey`, `profilePic`, `time_lvl1`, `time_lvl2`, `time_lvl3`, `time_lvl4`, `time_lvl5`, `time_lvl6`, `time_lvl7`, `time_lvl8`, `time_lvl9`) VALUES
(1, '0ba85bd2a1b3fdce7aaf51c1ad6e707c', 'c5e8487c181e948510de1baf29ef30c743b8a53ef7e2eda971637e067f90ccc7', '6882678947bfe95e27e1ffc9a8050f76fe8bfa91c02bc92e9a3bec911c2266e2', '6882678947bfe95e27e1ffc9a8050f76159633c2f5a77c102479461cd2cfa118', 'bbad491d82d8d6e2ab86f59c02c108a536ca4a6a3d38491fbb59c25c6a46b3fa', 'a51ffaa6308835a72fc759b83c987205', '537e161eb57bba42f88494e19186a64f', 'bd512d62f6d2e8c34ef1f6aef2eb987b', '2ae0e4d7468a163205ed68af5952de169999d5a1c560d4c17e558a08edba501d', '2ae0e4d7468a163205ed68af5952de16ee9fb1192aee80428594f9121434412a', '0a22b376f4ae6bacd9d79c265f0656f0', '366762f13143ec5838e5ca190a8b37d0', '59170eed4876f4ea02bd68aaad64d220', '458276061621f721145480882ae01dba', 'bd512d62f6d2e8c34ef1f6aef2eb987b', '0a22b376f4ae6bacd9d79c265f0656f0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, '58527ea87dd0e60915c8707f75601605', '895004fd5fbe99bde8a55bb50cee08b7a9b6d7a505d8ebbc07c82f810dd62883', '1df4ae9602ea6f2c6cd58a612ffee0a03709e35464941fde972e61b317778ce0cd68c6b55486b6c64e7b212278b0fe71', '1df4ae9602ea6f2c6cd58a612ffee0a0635bb554dd853d6dd08cb5b00dc8285c', '3b329ff7c9051584eed1b3923685e63a09d754c10520f3833f052b1ffec67d67', 'deb093439b2024b411730cd5e61727de', '16938af8bfb11f17af39be41a3806a90', '472f3d1aac6dac4b1c0978dfc4137dce', 'c55e30140f1ec1faa050b916c8b66d97cc2df7fd43aafd2b295f26976b99f651', 'c55e30140f1ec1faa050b916c8b66d97cc2df7fd43aafd2b295f26976b99f651', '472f3d1aac6dac4b1c0978dfc4137dce', '9a70eb9749de029485ddd4db083cc7d8', 'abe00deac88555adc42aa86e0211b4a9', 'aeed2f730f06082029ac911cf06302a5', '06722584ce5b3962a62cb10f80801ec2', '84937183e802da9bf8512637748f03cd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, '24d6225ae371d457a07d7a4e7c136d2b', 'c5c29656d213b8a81c739e9fb7a87a1ce00359c0e7c1b13c1d8cf921f8732c6f', '56c5e291c76c4b6f87ae32517cee74629ff94a4232d0b4059a307ed4c2358acf', 'de238ae7fbf7365e26812bb7f8d890aa', '9d98fb8cd559fbb9f122185df91b6a889dcb42db9f8be9f69e351ff9ea4151ca', '973b61a5c8f678f81fd23c3bfa2ce85a', 'c8da30e42df660ae354687bcd5708021', '9c74b1d349d6dfccf6644b6b7938c8d5', '22eafc70461753e5df48788c0de78a9170cbf286d2ae286f666fd179a2709cb9', '22eafc70461753e5df48788c0de78a9170cbf286d2ae286f666fd179a2709cb9', '9c74b1d349d6dfccf6644b6b7938c8d5', 'ff71d81cda27d6a6a85c5e3cf6cf5567', 'ff71d81cda27d6a6a85c5e3cf6cf5567', 'be70ca3a17f79cbc3333cb8b489af5e2', '8babee16cad3bb5c1f805a7a9336cacc', '1eb6f7f5d85f6f4ec84d2e38060553e0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, '3a5bfdfc080a2890a4f674ac6b163e10', 'bb2f8eee409cdaf2573ee9927a1e36cb54d154069d795a1509efc5924c12a0bf', 'c6eb9a48968b1cc18946214f6708b3c647f488e5fda5943a3cf2b5d68559a8a4', '977d0e91f90b86ed1531cec2bd2e6ac3', 'b20595a9effb713b8760c8ef06e4e071dbaa5ae89282995caa8e8acddf367aae', 'e408c90a3e59684138ed20a45b049d9e', '1b381333f8106a4944f69e8b59376a91', 'a703e67ba01dcd9d9428cd242d46affa', 'e08de90764270fce08c370f0202d4d426983a3a5ac07e9dcbc44b27cf7cd26a2', 'e08de90764270fce08c370f0202d4d426983a3a5ac07e9dcbc44b27cf7cd26a2', 'a703e67ba01dcd9d9428cd242d46affa', '0bdc919695004c94368cf56bad820aa2', '70b27d00e732c3a273f152e0bafdce53', 'e5dae2921ad2236d869388f4f787521e', 'e5dae2921ad2236d869388f4f787521e', '1b381333f8106a4944f69e8b59376a91', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'cf50d2c306bdcf3a564cc8e77d506fee', '3024fac3289e5cc72bfc67566fbcc3be264596c5009bae9254bfa36a87b8c596', 'd85ff7d0f960dbad2fb9110473b0558adbf020987bcb5b723b004f632668b76f', 'f8a1ef2ca01c5b54ea07dd945fa52099', '8689499c8d54848c6d39eadef874bc39cef6dd02c44fed114100ef5d5c9f5d2a', 'c9131e5d8dde6553f841d2401495788f', '3add6d436106cce655b5c0106adbc4d6', 'c55993b1ab937527832ebe8ff2808e58', '7b462771acf6bedfe5b8d37bce573c0016a900c97912bd3d69808cfbd9184414', '7b462771acf6bedfe5b8d37bce573c0016a900c97912bd3d69808cfbd9184414', 'c55993b1ab937527832ebe8ff2808e58', '123dc445dd151d8ff940596941996dee', 'ebbf0fd0acceee0342285a049176b70b', '3b8fd87a6a38e1cc90f92bcf5b09ef1c', '5d6ea010c74cb697a3f42e7b45ce6882', 'ff330c4d1e5fc6be1c432aaa68865e99', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, '2c6c32f2c56740fbf6fdfe8175db8317', 'c084283d6a54d5c5e0b48ac8aa7711bb189d72167ffc1b2d36290bed4a24bfee', '8c4cbfffe618e10076e48f4c50250f07fba25cb3c2bb1c77f1d1fd34c2344e50', '6e5786e5ff92917c05e26a15eb44ac4f', '2425742ced1aeff9d7e657bda642b858a20ececc22379825dd5ad117ea237a38', '1790100f645b3d7fdf0e7555029deb1c', 'dc4423b8802563a3dc6012de40081e16', '1790100f645b3d7fdf0e7555029deb1c', '99dc1e426b35e927b179ee410a30266740f8a8bca35660dda87995ca917d7331', '99dc1e426b35e927b179ee410a30266740f8a8bca35660dda87995ca917d7331', '1790100f645b3d7fdf0e7555029deb1c', '1790100f645b3d7fdf0e7555029deb1c', '1790100f645b3d7fdf0e7555029deb1c', '1790100f645b3d7fdf0e7555029deb1c', '1790100f645b3d7fdf0e7555029deb1c', 'f65f84475a2069f21813eec2c5bc59f4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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

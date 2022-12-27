-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2022 at 03:45 PM
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
  `latest_login_time` varchar(256) NOT NULL,
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

INSERT INTO `players` (`playerID`, `iv`, `email`, `password`, `points`, `leaderboard_position`, `streak`, `last_login_time`, `latest_login_time`, `badge`, `ranking_category1`, `ranking_category2`, `ranking_category3`, `ranking_category4`, `levels`) VALUES
(1, 'fb4f5eb9a865af0a43790300d2eaf10a', 'thanosDaTitan1234@gmail.com', 'ed09024decdd54035d7e68699d6d71d46049deb04c16dc94c3d0e8c2057c69fb', 'b363c8fae36125da7cea78918a52c1cf', '78efb379ea2784f9beef55c31f23b4a1', '1e2ac976e5b59fd471b88149d0e6e5b4', '50221b20a90aff4acf84b35d9444d773a15f5ba93cdef93fa2a3fa2edccde27a', '04b488c6a0a6a186369f168dd7bb0a37e5b6b09927e1a58602f21d340a95179f', '157026f6294b3a9662a9803aff16b820', '45ad6bba3f52b116760d0a32dd933b27', 'a6642101991efe20323384cece4ba820', 'e0e82e76e1446cf45627b39b806fa2f4', '9cade7219dbad1c655ea27945f658319', 'cc4790f5ba7d5fc59ced06a817fbfac5'),
(2, '4257f285ef0fa3511998809f127207ed', 'pikachuInAPokeball1234@gmail.com', '3b329ff7c9051584eed1b3923685e63a09d754c10520f3833f052b1ffec67d67', '9b519b4ef40d3acd280067e7f6747f50', '3331e83a8f5d76d099b3d7359bcca486', 'f0678197855d1d814500c4dd7d36534b', '1a7417517d07489c1bd8c0b06889767132eb70559c3f9edbef116eb52075c361', '1a7417517d07489c1bd8c0b0688976717cae34caa48ad7f36edef35059cf4b3e', 'ecf74f1d592abcdfb298cd76369b98ec', 'c5cc88eec134e9c2acddb26f8cda3ca5', 'c5cc88eec134e9c2acddb26f8cda3ca5', '2bfc63377e4dedf2d469c215b04f4b18', '2a64ff0f698dde475f9162879f628758', 'b17fbc2e053610b09e21658c5ea13409'),
(3, 'aa6aace68ebff1adca393e4605b9c911', 'peterparker@gmail.com', '9d98fb8cd559fbb9f122185df91b6a889dcb42db9f8be9f69e351ff9ea4151ca', '6afc48a12ffb42c99dc2da1e57799abc', '054848b34e8b36f824f5ad5cea4eae8a', '0ed87fba5c9bdcc1717835d08eeac79d', '1766c9616d5303b3b3b457fd6476fae7b21f64885704e604ce8ac2791602c98e', '1766c9616d5303b3b3b457fd6476fae7749a08e9e11f1a4d5210bcd4782f1aab', '0ed87fba5c9bdcc1717835d08eeac79d', 'f9218f838951624ded9cfe8727e9329e', '7a96af47c8d425b2ed63ff8d8596732e', 'e76eecd1fd4c2258782362282e97d2a7', '1d1eb64b9c61829cfc90f8d57e38b9c1', 'b516d14fe45d6fc32949a49a2504f56a'),
(4, 'e580d6a7fff5bc194ffd93d80ddd560d', 'spongebob@yahoo.com', 'b20595a9effb713b8760c8ef06e4e071dbaa5ae89282995caa8e8acddf367aae', 'c34bc474fbbd3e8fb90e0a0c3bc1d093', 'c5ffb0c48c1d07886afa2d52a0ae657b', 'cba5a1f769856f559003852166753fdb', 'ade3a7cd3dccea13f380396a7b79d0d564f5c34aa5c9d5bdacfbfdec4dafed7b', 'ade3a7cd3dccea13f380396a7b79d0d5add13086282c67f12a31da6a4b8a113a', '49663fa6b5c17a633fd436e39a6f25d7', 'c0aaf9609ad0809b904b071ae8e8c634', '6e619fa013d290985f7828d05a165e4b', 'b854316674026f7cc6ddce07c3243a2f', 'cee8324804aed683a72c23a9b26a4068', '826d8bb608c615e98addb0a2c8c13072'),
(5, '82b2976fe2f9a0ce20edb3dc6f8e0086', 'timBear@gmail.com', '8689499c8d54848c6d39eadef874bc39cef6dd02c44fed114100ef5d5c9f5d2a', '7d6d6615fd849c531c83f99806d28881', '2dfc932849b88275a722676bf8217c5e', 'ae01fb9288655eba2a0fa5dc3eb8a31a', '2f446019c94548db09f0a96f8a14fe0fc357e5207c09ccdf51a6e741d6eb35db', '2f446019c94548db09f0a96f8a14fe0f8a17aa99ce0ab1507c17570ac4eaaf0d', '2dfc932849b88275a722676bf8217c5e', '5e744f02ae9e24b74ab969a6d5ff9089', 'bffe5decfaa19d75db44bdbe942131d3', 'cae1b2297ff6e639b59b9855c3ccddac', 'ad38e4e4fe847992d2f2badbfc10641c', '43016c8d488f1ea25dea5129e7b080c6'),
(6, '6b66be222f5c8d17c6b7f4740a59c3ed', 'bean555@gmail.com', '2425742ced1aeff9d7e657bda642b858a20ececc22379825dd5ad117ea237a38', '79f4b0eb8ca6a0ed2fd17d13a1dd68d4', 'd3b345e2525926433a0546156752a5e3', '79f4b0eb8ca6a0ed2fd17d13a1dd68d4', 'f9f0b7abb5d8d1c133e6adb5aa8e67273cb882d1efc2894a45c121a2913c5f95', 'f9f0b7abb5d8d1c133e6adb5aa8e672771f9593f7fd1923298dd26d900043ef1', '8d9185533fa1c258b4e0f1449746c106', '8d9185533fa1c258b4e0f1449746c106', '8d9185533fa1c258b4e0f1449746c106', '8d9185533fa1c258b4e0f1449746c106', '79f4b0eb8ca6a0ed2fd17d13a1dd68d4', '56367facd8008de309871ed7ba24f2f9');

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

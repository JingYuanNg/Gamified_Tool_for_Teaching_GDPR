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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` int(11) NOT NULL,
  `iv` varchar(32) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `google2FA_secretKey` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `iv`, `email`, `password`, `google2FA_secretKey`) VALUES
(1, '3e6fa7cfdc68ae3bb317028f2a35789c', '0ecbfbe62ef5f9c71d8e307d008967cb9fe264c7d5ce1b90ef93ab4151dfc3a1', '2d0ba04bc2cf9fc6c7a8a6d6a7c29cdab5831f8b3e312d2541bcd62af10bf525', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset`
--

CREATE TABLE `password_reset` (
  `eventID` int(11) NOT NULL,
  `iv` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `token` varchar(256) NOT NULL,
  `timestamp` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `questionID` int(11) NOT NULL,
  `question` varchar(256) NOT NULL,
  `category` varchar(256) NOT NULL,
  `optionA` varchar(256) NOT NULL,
  `optionB` varchar(256) NOT NULL,
  `optionC` varchar(256) NOT NULL,
  `optionD` varchar(256) NOT NULL,
  `answer` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`questionID`, `question`, `category`, `optionA`, `optionB`, `optionC`, `optionD`, `answer`) VALUES
(1, 'General Data Protection Regulation (GDPR) is defined as', '1', 'An act to revise the law relating to the main non-fatal offences against the person and to provide for connected matters', 'A set of principles and rules that regulated financial firms must follow when they: Sell financial products and services to you', 'A piece of Pan-European legislation enacted by the European Parliament and Council to considerably increase Data Subjects\' rights in terms of how their data is handled', 'An act to revise the law relating to the health and welfare of animals and their protection and identification', 'c'),
(2, 'What are the two types of data that covered by GDPR?', '1', 'Personal Data, Restricted Data', 'Personal Data, Sensitive Data', 'Quantitative Data, Confidential Data', 'Internal Data, Confidential Data', 'b'),
(3, 'Who is not protected by GDPR?', '1', 'Vivian who is a German and is living in Taiwan', 'Lily who is a Spanish and get married with an Australian', 'Jamie who is born in Ireland', 'Phil who is a Polish and is dead', 'd'),
(4, 'Why is the reason data such as political opinion considered as sensitive data?', '1', 'Because people can send out hate mail or target people for physical violence according to their political opinion', 'Because political opinion is the information that nobody wants to share publicly', 'Because we have more power to act, according to the political party that we support', 'Because people can know more about how we think if our political opinion is known by them', 'a'),
(5, 'What are the two ways that GDPR used to process the sensitive data?', '1', 'Specification, Generalization', 'Anonymization, Randomization', 'Anonymization, Pseudonymization', 'Hashing of data, Generalization', 'c'),
(6, 'What does ‘processing’ mean in GDPR?', '1', 'The marking of stored personal data with the aim of limiting their processing in the future', 'Any operation or set of operations which is performed on personal data or on sets of personal data', 'Any form of automated processing of personal data consisting of the use of personal data to evaluate certain personal aspects relating to a natural person', 'A natural or legal person, public authority, agency or other body which processes personal data on behalf of the controller', 'b'),
(7, 'What does ‘recipient’ mean in GDPR?', '1', 'A natural or legal person, public authority, agency, or other body which processes personal data on behalf of the controller', 'A natural or legal person, public authority, agency, or body other than the data subject, controller, processor, and persons who, under the direct authority of the controller or processor, are authorised to process personal data', 'A natural or legal person, public authority, agency, or another body, to which the personal data are disclosed, whether a third party or not', 'Any information relating to an identified or identifiable natural person', 'c'),
(8, 'What does ‘genetic data’ mean in GDPR?', '1', 'Personal data resulting from specific technical processing relating to the physical, physiological, or behavioural characteristics of a natural person', 'Personal data that can be freely used, reused, and redistributed by anyone with no existing local, national or international legal restrictions on access or usage', 'Personal data that cannot be freely used, reused, and redistributed by anyone with no existing local, national or international legal restrictions on access or usage', 'Personal data relating to the inherited or acquired genetic characteristics of a natural person which give unique information about the physiology or the health of that natural person', 'd'),
(9, 'What does ‘biometric data’ mean in GDPR?', '1', 'Personal data resulting from specific technical processing relating to the physical, physiological, or behavioural characteristics of a natural person', 'Personal data that can be freely used, reused, and redistributed by anyone with no existing local, national or international legal restrictions on access or usage', 'Personal data that cannot be freely used, reused, and redistributed by anyone with no existing local, national or international legal restrictions on access or usage', 'Personal data relating to the inherited or acquired genetic characteristics of a natural person which give unique information about the physiology or the health of that natural person', 'a'),
(10, 'What does ‘data concerning health’ mean in GDPR?', '1', 'Personal data resulting from specific technical processing relating to the physical, physiological, or behavioural characteristics of a natural person', 'Personal data that can be freely used, reused, and redistributed by anyone with no existing local, national or international legal restrictions on access or usage', 'Personal data related to the physical or mental health of a natural person', 'Personal data relating to the inherited or acquired genetic characteristics of a natural person which give unique information about the physiology or the health of that natural person', 'c'),
(11, 'Who is not protected by GDPR?', '2', 'Tristan, a France went browsing an online store in Singapore', 'Jimmy, a Lithuanians went online shopping in an online store in Malta', 'Abraham, a Mexican went online shopping in an online store in Morocco', 'Andrew, a British who signed up for an online fitness plan in Ireland', 'c'),
(12, 'Is the following statement true or false?  GDPR is only applied in countries from the EU', '2', 'True', 'False', 'Depends on which country it is', '–', 'b'),
(13, 'Which of the following statements is the most accurate statement about the location that GDPR apply?', '2', 'GDPR only applies in the EU', 'GDPR only applies in Ireland', 'GDPR only applies if the organization is in the EU, or the organization has EU customers', 'GDPR only applies if the organization is not in the EU but has EU customers', 'c'),
(14, 'What is the definition for extra territorial applicability in GDPR?', '2', 'Law applying alike to all persons regardless of their nationality or citizenship within a given territory', 'Law applying to the processing of EU personal data by Controllers that are not established in the EU, but in a place where Member State law applies by public international law', 'Law applying when the organization conduct business in within a certain territory', 'Law applying when the organization conduct business for people within EU and any countries that is 125km from the EU', 'b'),
(15, 'Which of the following countries is not covered by the General Data Protection Regulation (GDPR)?', '2', 'Sweden', 'France', 'Germany', 'Australia', 'd'),
(16, 'Which of the following is not a requirement for companies to be subject to the GDPR?', '2', 'Having a physical presence in the EU', 'Collecting and processing the personal data of EU citizens', 'Offering goods or services to EU citizens', 'Being incorporated in the EU', 'a'),
(17, 'If a company based in the EU processes the personal data of individuals in the United States, is the GDPR applicable to the company?', '2', 'Yes, the GDPR always applies to the processing of personal data by companies based in the EU', 'No, the GDPR only applies to the processing of personal data of EU citizens', 'Yes, if the company is offering goods or services to individuals in the EU', 'No, the GDPR only applies to the processing of personal data of individuals within the EU', 'd'),
(18, 'Can a company based outside of the EU be subject to the GDPR if it processes the personal data of individuals located within the EU, but not for the purpose of offering goods or services to those individuals?', '2', 'No, the GDPR only applies to the processing of personal data for the purpose of offering goods or services', 'Yes, the GDPR applies to all processing of personal data within the EU', 'Yes, but only if the company monitors the behaviour of the individuals', 'Yes, but only if the company processes the personal data of EU citizens', 'c'),
(19, 'Can a company based in the EU be subject to the GDPR if it processes the personal data of individuals located outside of the EU, but not for the purpose of offering goods or services to those individuals or monitoring their behaviour?', '2', 'No, the GDPR only applies to the processing of personal data for the purpose of offering goods or services or monitoring behaviour', 'Yes, the GDPR applies to all processing of personal data, regardless of location', 'Yes, but only if the company processes the personal data of EU citizens', 'Yes, but only if the company processes the personal data of non-EU citizens', 'a'),
(20, 'Is it possible for a company based outside of the EU to be subject to the GDPR?', '2', 'No, the GDPR only applies to companies within the EU', 'Yes, if the company offers goods or services to individuals in the EU', 'Yes, if the company monitors the behaviour of individuals in the EU', 'Yes, if the company processes the personal data of individuals in the EU', 'b'),
(21, 'Which of the following statement is false or not related about lawfulness in GDPR?', '3', 'Consent to process the person is given by the user', 'Personal data must be processed to fulfil a contract', 'It is required to satisfy a legal responsibility', 'It is a private task carried out in the private interest', 'd'),
(22, 'Which of the following is the true about fairness in GDPR?', '3', 'You are allowed to keep information about what or why you are collecting data on purpose', 'You are not allowed to mishandle or abuse the information collected, unless you are not a native speaker of English', 'You must be clear, open, and honest with data subjects about who you are, and why you are processing their data', 'You can demonstrate that there is a legitimate interest that is not outweighed by the rights and interests of the data subject', 'c'),
(23, 'Is the following statement complying and related to purpose limitation?  Privacy policy include a lawful basis to explain why the company needs to process personal information. The reason for data processing, eg the fulfilment of a contract is stated', '3', 'Yes', 'No', 'Yes, if the reason is related, No if it is not', '-', 'b'),
(24, 'Which of the following statement is false or not related about purpose limitation in GDPR?', '3', 'The consent to process the data should be asked again if the data collected wanted to be used for a new purpose that is incompatible with the original purpose even though there is a clear obligation or function set out in law', 'The purpose of this principle is to ensure that data is only collected for stated, explicit, and lawful purposes', 'The data processing purposes should be strictly adhered to, restricting data processing to the indicated reasons only', 'One of the purposes of this principle is to restrict the use of data for certain activities', 'a'),
(25, 'Which of the following is complying to the data minimization principle in GDPR?', '3', 'Email, phone numbers, home address of the users is collected for an email newsletter subscription', 'Users need to provide the home address for a reservation of table in a restaurant', 'Home address and phone numbers are required, microphone of the device also have to be enabled for online shopping', 'Fingerprint is collected at the entrance of a building is to prevent unauthorised persons from entering', 'd'),
(26, 'Which of the following is false or not related about the principle accuracy in GDPR?', '3', 'All personal data collected, stored, or processed by a controller must be accurate and up to date', 'Controller should take all reasonable steps to correct any inaccuracies promptly', 'The users should go and update the information themselves if any of the information on the website is changed', 'The purpose of this principle is to make sure the personal data are accurate and where needed, kept up to date', 'c'),
(27, 'Which of the following statements is true about the principle storage limitation in GDPR?', '3', 'Personal data is only allowed to be stored for longer periods when they will process solely for archiving purposes in the public interest, scientific or historical research purposes or statistical purposes', 'Controllers have the choice to delete personal data as soon as it stops being needed for the purposes for which it was originally collected or keep it in the database', 'The controllers have a choice to justify how long each piece of data will be kept', 'Under GDPR, personal data in a form which permits the identification of individuals should be held no longer than necessary for the purposes unless stated', 'a'),
(28, 'Which of the following is the protection that are included in Integrity and confidentiality principle in GDPR?', '3', 'Unauthorized or unlawful processing, human-caused loss', 'Accidental destruction, unlawful processing', 'Unauthorized but lawful processing, human-caused loss', 'Damage caused by natural disaster, Authorized but unlawful processing', 'b'),
(29, 'Which of the following statements is false or not related about the accountability principle in GDPR?', '3', 'It is a new principle in GDPR', 'The organization or a person must have appropriate measures and records in place as proof of compliance with the data processing principles', 'One of the way to achieve accountability is the controller always ask the users if they wanted to update their personal information stored in the website', 'The purpose of this principle is to prevent the organization from saying that they are following all the rules without doing it', 'c'),
(30, 'Until the year of 2022, how many principles are there in total for GDPR?', '3', '6', '7', '8', '9', 'b'),
(31, 'Which articles of GDPR contains all the information that must be provided when collecting personal data?', '4', '11', '12', '13', '14', 'c'),
(32, 'Which articles of GDPR contains the responsibilities when obtaining data about the data subject from a third party or indirectly?', '4', '11', '12', '13', '14', 'd'),
(33, 'According to Article 13 of GDPR, which of the following information is not one of the information that is needed to be provided when personal data is being collected?', '4', 'The reasons and the way their personal data is being processed', 'Legal basis for processing and the purposes of the processing', 'Country where the processing of data occurs', 'Legitimate interests of the processor and third parties', 'a'),
(34, 'Which of the following statement is false or not related about the right of access in GDPR?', '4', 'The data subject or the natural person can ask specifically about their personal data file', 'The data subject or the natural person can request for as many copies of the data as they want without getting charged', 'The data subject or the natural person can ask the period that their personal data is intended to be stored', 'The data subject or the natural person can request to know any information available to the source of data when the data are not collected from the data subject', 'b'),
(35, 'Which of the following is false or not related to the right to rectification in GDPR?', '4', 'The data subjects have the right to change or modify the data they provide when the data is inaccurate or out-of-date without undue delay', 'One of the reasons holding accurate data is so important for the organization and the data subject is because incorrect data threatens the privacy of other individuals', 'The right to rectification adds an extra layer of transparency to the processing activities', 'One example of ways to comply to this right to rectification is providing the data subjects can update their information on their own time through a customer account and profile', 'c'),
(36, 'Which of the following statement is not one of the circumstances when the data subject has the right to ask a data controller to erase their data without undue delay?', '4', 'The personal data must be erased for compliance with a legal obligation in Union or Member State law to which the controller is subject', 'The personal data are no longer necessary in relation to the purposes for which they were collected or otherwise processed', 'The personal data have been unlawfully processed', 'When the personal data is in the process of being updated', 'd'),
(37, 'What happened if a data subject has the right to restriction of processing and the controller wishes to continue processing?', '4', 'The controller will receive a warning not to continue processing the data and is not allowed to continue processing the data because the data subject has the right to restriction to processing', 'The controller will be imposed a fine up to 20 million Euro or 4% of worldwide annual turnover (whichever is higher)', 'The controller needs to prove that there is a legitimate reason for continuing to process the data', 'The controller needs to show evidence that the personal data will be used for processing that is to have no effect or discloses sensitive information', 'c'),
(38, 'Which of the following is the purpose of the right to data portability?', '4', 'To enable a user to reuse their data for the purpose to transfer it to another controller', 'To avoid the controller from making any automated decisions towards their transferable personal data', 'To restrict the transfer of their personal data from controller to another controller', 'To enable a user to voice out and object when their personal data is being transferred to another controller', 'a'),
(39, 'According to Article 21 of GDPR, the data subject has the right to object to their data being processed. What happened if the objections are failed?', '4', 'The controller will not be allowed to process the data', 'The controller must still have sufficient legal grounds to continue using or processing the data', 'The data subject needs to make other objections until it is successfully objected', 'The controller will be imposed a fine up to 20 million Euro or 4% of worldwide annual turnover (whichever is higher)', 'b'),
(40, 'Which of the following is not the condition when the right to avoid automated decision-making cannot be implemented?', '4', 'When automated decision-making is needed to enter or complete a contract', 'When the control has authorization from the EU or a Member State and uses safeguards to protect the subject’s interests and freedom', 'When the profiling or decision-making occurs with the subject’s explicit consent', 'When the data subject is conducting objection to the processing of their personal data', 'd');

-- --------------------------------------------------------

--
-- Table structure for table `question_category`
--

CREATE TABLE `question_category` (
  `question_categoryID` int(11) NOT NULL,
  `question_categoryName` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `question_category`
--

INSERT INTO `question_category` (`question_categoryID`, `question_categoryName`) VALUES
(1, 'What is GDPR?'),
(2, 'Where does the regulation apply '),
(3, 'The seven principles'),
(4, 'The eight rights ');

-- --------------------------------------------------------

--
-- Table structure for table `verify_email`
--

CREATE TABLE `verify_email` (
  `eventID` int(11) NOT NULL,
  `iv` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `token` varchar(256) NOT NULL,
  `timestamp` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `password_reset`
--
ALTER TABLE `password_reset`
  ADD PRIMARY KEY (`eventID`);

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`playerID`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`questionID`);

--
-- Indexes for table `question_category`
--
ALTER TABLE `question_category`
  ADD PRIMARY KEY (`question_categoryID`);

--
-- Indexes for table `verify_email`
--
ALTER TABLE `verify_email`
  ADD PRIMARY KEY (`eventID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `password_reset`
--
ALTER TABLE `password_reset`
  MODIFY `eventID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `players`
--
ALTER TABLE `players`
  MODIFY `playerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `questionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `question_category`
--
ALTER TABLE `question_category`
  MODIFY `question_categoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `verify_email`
--
ALTER TABLE `verify_email`
  MODIFY `eventID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

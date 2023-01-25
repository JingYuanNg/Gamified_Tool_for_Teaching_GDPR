-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2023 at 08:38 PM
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
  `google2FA_secretKey` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`playerID`, `iv`, `email`, `displayName`, `password`, `points`, `leaderboard_position`, `streak`, `last_login_time`, `latest_login_time`, `badge`, `ranking_category1`, `ranking_category2`, `ranking_category3`, `ranking_category4`, `levels`, `google2FA_secretKey`) VALUES
(1, '7f199c03727b139c22a0bb1d7de2b986', 'c5e8487c181e948510de1baf29ef30c743b8a53ef7e2eda971637e067f90ccc7', '8e0e48a8da0ed730e0130e746b4406e90dcd9db53df08334a5d9f86a008eb8ee', 'ed09024decdd54035d7e68699d6d71d46049deb04c16dc94c3d0e8c2057c69fb', '2c297385e19a48925e17b27adf706c79', '4c9e39cec227e76fab3d2e38b4d83ad7', '543e111fe8b65f18e6dfd8f73c1a13d4', 'c442c851138f76f7ca1d70f913cefe3c89b7edfae29c7d4fd68349437f457c6c', 'c442c851138f76f7ca1d70f913cefe3ce61f74896fc070eef389a7f5df8bdf35', 'd16b257971dd91e624df8456ee0dbec8', '543e111fe8b65f18e6dfd8f73c1a13d4', '543e111fe8b65f18e6dfd8f73c1a13d4', '543e111fe8b65f18e6dfd8f73c1a13d4', '543e111fe8b65f18e6dfd8f73c1a13d4', 'd16b257971dd91e624df8456ee0dbec8', NULL),
(2, 'dfd221a06fa8bf83b78619982f8bcb66', '895004fd5fbe99bde8a55bb50cee08b7a9b6d7a505d8ebbc07c82f810dd62883', '4c7c8533ca0caf9c763b357c02f94257ebc4b237d8df031b26ea9e05dca64896058d83732a7b3938070ddd147c18de88', '3b329ff7c9051584eed1b3923685e63a09d754c10520f3833f052b1ffec67d67', 'e154248a2df6e72c328d1bf514a51fad', 'add66857b62032e932715f7399565e47', '62344039978d1d4bc734d4b52ed119b0', 'ebc6e7c0fa88267be7d17e6956a435c145908260ee23324cd19125869f787c98', 'ebc6e7c0fa88267be7d17e6956a435c145908260ee23324cd19125869f787c98', '62344039978d1d4bc734d4b52ed119b0', '62344039978d1d4bc734d4b52ed119b0', '62344039978d1d4bc734d4b52ed119b0', '62344039978d1d4bc734d4b52ed119b0', '62344039978d1d4bc734d4b52ed119b0', 'efda4f2fd3875bd154b31ef31a0d47c7', NULL),
(3, '62e596665a2372baea7adde394dee9a3', 'c5c29656d213b8a81c739e9fb7a87a1ce00359c0e7c1b13c1d8cf921f8732c6f', 'b1ba93068d4200839194cd82948a99d8e00b4da2f543cbaf3657079dceeb6ef5', '9d98fb8cd559fbb9f122185df91b6a889dcb42db9f8be9f69e351ff9ea4151ca', '173b5c4f4f9ccb035f0349e5d4f9978b', '8802271d98e99ef9e77a6ecf4e546817', '69618f64c6d8a45f93567fb8183c8639', '29b122c47a67c606c34ee0d407c4f371bf656bc5a17c162721238032cdc85645', '29b122c47a67c606c34ee0d407c4f371bf656bc5a17c162721238032cdc85645', '69618f64c6d8a45f93567fb8183c8639', '69618f64c6d8a45f93567fb8183c8639', '69618f64c6d8a45f93567fb8183c8639', '69618f64c6d8a45f93567fb8183c8639', '69618f64c6d8a45f93567fb8183c8639', '5b1c8878459264014f3a9cbe37d75718', NULL),
(4, '1c5c8e3859281487b66a6a074d58389a', 'bb2f8eee409cdaf2573ee9927a1e36cb54d154069d795a1509efc5924c12a0bf', '11c648bc875ad44b6607068734c16f8a70e7aea254d5baf95437650205e8efe3', 'b20595a9effb713b8760c8ef06e4e071dbaa5ae89282995caa8e8acddf367aae', '90e4c60553867dddb49cc35303fd23b1', '5d5c93b82c5aba56af2f1f558d0be126', '2fa00b3b5c7dc0a7b37e7d17e92fc62d', 'bf9022255c063dae282315efef4f190fd57556aa5369fc1c73a0d7543065cce4', 'bf9022255c063dae282315efef4f190fd57556aa5369fc1c73a0d7543065cce4', '2fa00b3b5c7dc0a7b37e7d17e92fc62d', '2fa00b3b5c7dc0a7b37e7d17e92fc62d', '2fa00b3b5c7dc0a7b37e7d17e92fc62d', '2fa00b3b5c7dc0a7b37e7d17e92fc62d', '2fa00b3b5c7dc0a7b37e7d17e92fc62d', '5d5c93b82c5aba56af2f1f558d0be126', NULL),
(5, '9bfdeb0b4fc426a8e456ef1a670993fa', '3024fac3289e5cc72bfc67566fbcc3be264596c5009bae9254bfa36a87b8c596', '71121685bd1239df0154e581511796a95324c7ec22a1d2148c6996b56ee4c2de', '8689499c8d54848c6d39eadef874bc39cef6dd02c44fed114100ef5d5c9f5d2a', '4ae5f93beac8d210a1fa82b1cf735c16', '17ddfee79fb289e386c9414d416ca0c0', '39f4dba32801bd5d8216ca0d8fbb91e4', '8742de6456d3afe3c43b203706ba54a490fa60bb7c879001a3b60e57e97d1222', '8742de6456d3afe3c43b203706ba54a490fa60bb7c879001a3b60e57e97d1222', '39f4dba32801bd5d8216ca0d8fbb91e4', '39f4dba32801bd5d8216ca0d8fbb91e4', '39f4dba32801bd5d8216ca0d8fbb91e4', '39f4dba32801bd5d8216ca0d8fbb91e4', '39f4dba32801bd5d8216ca0d8fbb91e4', '3c77d078fd6ebd47dc0f3a20bb58757d', NULL),
(6, '3602e67b3dc4c19677f69bd1e2e4e80e', 'c084283d6a54d5c5e0b48ac8aa7711bb189d72167ffc1b2d36290bed4a24bfee', 'f6fbc0aac5fad0b7b77798b1f2fac5ddd7eca7956dca3a79a1bb4defe88bf12d', '2425742ced1aeff9d7e657bda642b858a20ececc22379825dd5ad117ea237a38', '059cdccdc2e199afb81873722bc8eed4', 'f288326fa42dd4124491189a647d151a', '059cdccdc2e199afb81873722bc8eed4', '97d3842602512a6dbd611d27e2551db8586132925540a42ebc193283532c2a3a', '97d3842602512a6dbd611d27e2551db8586132925540a42ebc193283532c2a3a', '059cdccdc2e199afb81873722bc8eed4', '059cdccdc2e199afb81873722bc8eed4', '059cdccdc2e199afb81873722bc8eed4', '059cdccdc2e199afb81873722bc8eed4', '059cdccdc2e199afb81873722bc8eed4', '1833a9ebba05d3953b66c87772ca9a94', NULL);

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
  MODIFY `eventID` int(11) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `verify_email`
--
ALTER TABLE `verify_email`
  MODIFY `eventID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

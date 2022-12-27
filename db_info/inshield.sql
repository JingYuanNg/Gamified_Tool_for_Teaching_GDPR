-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2022 at 03:47 PM
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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` int(11) NOT NULL,
  `iv` varchar(32) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `iv`, `email`, `password`) VALUES
(1, 'cdf599304043d02514f40aed822466ad', 'developerInshield@gmail.com', '2d0ba04bc2cf9fc6c7a8a6d6a7c29cdab5831f8b3e312d2541bcd62af10bf525');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `question_category`
--

INSERT INTO `question_category` (`question_categoryID`, `question_categoryName`) VALUES
(1, 'What is GDPR?'),
(2, 'Where does the regulation apply '),
(3, 'The seven principles'),
(4, 'The eight rights ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

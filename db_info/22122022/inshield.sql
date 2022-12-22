-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2022 at 12:08 AM
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
  `badge` varchar(256) NOT NULL,
  `ranking_category1` varchar(256) NOT NULL,
  `ranking_category2` varchar(256) NOT NULL,
  `ranking_category3` varchar(256) NOT NULL,
  `ranking_category4` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`playerID`, `iv`, `email`, `password`, `points`, `leaderboard_position`, `streak`, `last_login_time`, `badge`, `ranking_category1`, `ranking_category2`, `ranking_category3`, `ranking_category4`) VALUES
(1, '3f36ca1a97a6157ad3ec7a8c77c92e74', 'thanosDaTitan1234@gmail.com', 'ed09024decdd54035d7e68699d6d71d46049deb04c16dc94c3d0e8c2057c69fb', 'fc959bb4500712b97a051a4ec5a6be1c', 'fc959bb4500712b97a051a4ec5a6be1c', 'fc959bb4500712b97a051a4ec5a6be1c', '749277d6708e4b81ae545a2f44971a44d2ddd54f5cac12a1ed60b7af8fb111df', 'fc959bb4500712b97a051a4ec5a6be1c', 'fc959bb4500712b97a051a4ec5a6be1c', 'fc959bb4500712b97a051a4ec5a6be1c', 'fc959bb4500712b97a051a4ec5a6be1c', 'fc959bb4500712b97a051a4ec5a6be1c');

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
(15, 'Which of the following statement is false or not related about lawfulness in GDPR?', '3', 'Consent to process the person is given by the user', 'Personal data must be processed to fulfil a contract', 'It is required to satisfy a legal responsibility', 'It is a private task carried out in the private interest', 'd'),
(16, 'Which of the following is the true about fairness in GDPR?', '3', 'You are allowed to keep information about what or why you are collecting data on purpose', 'You are not allowed to mishandle or abuse the information collected, unless you are not a native speaker of English', 'You must be clear, open, and honest with data subjects about who you are, and why you are processing their data', 'You can demonstrate that there is a legitimate interest that is not outweighed by the rights and interests of the data subject', 'c'),
(17, 'Is the following statement complying and related to purpose limitation?  Privacy policy include a lawful basis to explain why the company needs to process personal information. The reason for data processing, eg the fulfilment of a contract is stated', '3', 'Yes', 'No', 'Yes, if the reason is related, No if it is not', '-', 'b'),
(18, 'Which of the following statement is false or not related about purpose limitation in GDPR?', '3', 'The consent to process the data should be asked again if the data collected wanted to be used for a new purpose that is incompatible with the original purpose even though there is a clear obligation or function set out in law', 'The purpose of this principle is to ensure that data is only collected for stated, explicit, and lawful purposes', 'The data processing purposes should be strictly adhered to, restricting data processing to the indicated reasons only', 'One of the purposes of this principle is to restrict the use of data for certain activities', 'a'),
(19, 'Which of the following is complying to the data minimization principle in GDPR?', '3', 'Email, phone numbers, home address of the users is collected for an email newsletter subscription', 'Users need to provide the home address for a reservation of table in a restaurant', 'Home address and phone numbers are required, microphone of the device also have to be enabled for online shopping', 'Fingerprint is collected at the entrance of a building is to prevent unauthorised persons from entering', 'd'),
(20, 'Which of the following is false or not related about the principle accuracy in GDPR?', '3', 'All personal data collected, stored, or processed by a controller must be accurate and up to date', 'Controller should take all reasonable steps to correct any inaccuracies promptly', 'The users should go and update the information themselves if any of the information on the website is changed', 'The purpose of this principle is to make sure the personal data are accurate and where needed, kept up to date', 'c'),
(21, 'Which of the following statements is true about the principle storage limitation in GDPR?', '3', 'Personal data is only allowed to be stored for longer periods when they will process solely for archiving purposes in the public interest, scientific or historical research purposes or statistical purposes', 'Controllers have the choice to delete personal data as soon as it stops being needed for the purposes for which it was originally collected or keep it in the database', 'The controllers have a choice to justify how long each piece of data will be kept', 'Under GDPR, personal data in a form which permits the identification of individuals should be held no longer than necessary for the purposes unless stated', 'a'),
(22, 'Which of the following is the protection that are included in Integrity and confidentiality principle in GDPR?', '3', 'Unauthorized or unlawful processing, human-caused loss', 'Accidental destruction, unlawful processing', 'Unauthorized but lawful processing, human-caused loss', 'Damage caused by natural disaster, Authorized but unlawful processing', 'b'),
(23, 'Which of the following statements is false or not related about the accountability principle in GDPR?', '3', 'It is a new principle in GDPR', 'The organization or a person must have appropriate measures and records in place as proof of compliance with the data processing principles', 'One of the way to achieve accountability is the controller always ask the users if they wanted to update their personal information stored in the website', 'The purpose of this principle is to prevent the organization from saying that they are following all the rules without doing it', 'c'),
(24, 'Until the year of 2022, how many principles are there in total for GDPR?', '3', '6', '7', '8', '9', 'b'),
(25, 'Which articles of GDPR contains all the information that must be provided when collecting personal data?', '4', '11', '12', '13', '14', 'c'),
(26, 'Which articles of GDPR contains the responsibilities when obtaining data about the data subject from a third party or indirectly?', '4', '11', '12', '13', '14', 'd'),
(27, 'According to Article 13 of GDPR, which of the following information is not one of the information that is needed to be provided when personal data is being collected?', '4', 'The reasons and the way their personal data is being processed', 'Legal basis for processing and the purposes of the processing', 'Country where the processing of data occurs', 'Legitimate interests of the processor and third parties', 'a'),
(28, 'Which of the following statement is false or not related about the right of access in GDPR?', '4', 'The data subject or the natural person can ask specifically about their personal data file', 'The data subject or the natural person can request for as many copies of the data as they want without getting charged', 'The data subject or the natural person can ask the period that their personal data is intended to be stored', 'The data subject or the natural person can request to know any information available to the source of data when the data are not collected from the data subject', 'b'),
(29, 'Which of the following is false or not related to the right to rectification in GDPR?', '4', 'The data subjects have the right to change or modify the data they provide when the data is inaccurate or out-of-date without undue delay', 'One of the reasons holding accurate data is so important for the organization and the data subject is because incorrect data threatens the privacy of other individuals', 'The right to rectification adds an extra layer of transparency to the processing activities', 'One example of ways to comply to this right to rectification is providing the data subjects can update their information on their own time through a customer account and profile', 'c'),
(30, 'Which of the following statement is not one of the circumstances when the data subject has the right to ask a data controller to erase their data without undue delay?', '4', 'The personal data must be erased for compliance with a legal obligation in Union or Member State law to which the controller is subject', 'The personal data are no longer necessary in relation to the purposes for which they were collected or otherwise processed', 'The personal data have been unlawfully processed', 'When the personal data is in the process of being updated', 'd'),
(31, 'What happened if a data subject has the right to restriction of processing and the controller wishes to continue processing?', '4', 'The controller will receive a warning not to continue processing the data and is not allowed to continue processing the data because the data subject has the right to restriction to processing', 'The controller will be imposed a fine up to 20 million Euro or 4% of worldwide annual turnover (whichever is higher)', 'The controller needs to prove that there is a legitimate reason for continuing to process the data', 'The controller needs to show evidence that the personal data will be used for processing that is to have no effect or discloses sensitive information', 'c'),
(32, 'Which of the following is the purpose of the right to data portability?', '4', 'To enable a user to reuse their data for the purpose to transfer it to another controller', 'To avoid the controller from making any automated decisions towards their transferable personal data', 'To restrict the transfer of their personal data from controller to another controller', 'To enable a user to voice out and object when their personal data is being transferred to another controller', 'a'),
(33, 'According to Article 21 of GDPR, the data subject has the right to object to their data being processed. What happened if the objections are failed?', '4', 'The controller will not be allowed to process the data', 'The controller must still have sufficient legal grounds to continue using or processing the data', 'The data subject needs to make other objections until it is successfully objected', 'The controller will be imposed a fine up to 20 million Euro or 4% of worldwide annual turnover (whichever is higher)', 'b'),
(34, 'Which of the following is not the condition when the right to avoid automated decision-making cannot be implemented?', '4', 'When automated decision-making is needed to enter or complete a contract', 'When the control has authorization from the EU or a Member State and uses safeguards to protect the subject’s interests and freedom', 'When the profiling or decision-making occurs with the subject’s explicit consent', 'When the data subject is conducting objection to the processing of their personal data', 'd');

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
  MODIFY `playerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `questionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `question_category`
--
ALTER TABLE `question_category`
  MODIFY `question_categoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 16, 2017 at 11:45 PM
-- Server version: 5.6.38-log
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zirafapp_zirafers`
--

-- --------------------------------------------------------

--
-- Table structure for table `BADGE`
--

CREATE TABLE `BADGE` (
  `badgeId` int(11) NOT NULL,
  `badgeTitle` varchar(30) NOT NULL,
  `badgeContent` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `CHAT`
--

CREATE TABLE `CHAT` (
  `chatId` int(11) NOT NULL,
  `chatName` varchar(50) NOT NULL,
  `participantsCount` int(11) NOT NULL,
  `messageCount` int(11) NOT NULL,
  `dateCreated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `MESSAGE`
--

CREATE TABLE `MESSAGE` (
  `messageId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `chatId` int(11) NOT NULL,
  `userName` varchar(30) NOT NULL,
  `content` text NOT NULL,
  `dateCreated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `POLL`
--

CREATE TABLE `POLL` (
  `pollId` int(11) NOT NULL,
  `pollStatement` varchar(50) NOT NULL,
  `dateCreated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `POLL_OPTION`
--

CREATE TABLE `POLL_OPTION` (
  `optionId` int(11) NOT NULL,
  `pollId` int(11) NOT NULL,
  `content` text NOT NULL,
  `votes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `POST`
--

CREATE TABLE `POST` (
  `postId` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `likes` int(11) NOT NULL,
  `dateCreated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `REVIEW`
--

CREATE TABLE `REVIEW` (
  `reviewId` int(11) NOT NULL,
  `locationName` varchar(50) NOT NULL,
  `dishList` text NOT NULL,
  `foodRating` int(11) NOT NULL,
  `ambienceRating` int(11) NOT NULL,
  `serviceRating` int(11) NOT NULL,
  `valueForMoney` int(11) NOT NULL,
  `foodReview` text NOT NULL,
  `xFactor` text NOT NULL,
  `dateCreated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `USER`
--

CREATE TABLE `USER` (
  `userId` int(11) NOT NULL,
  `userName` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `socialHandle` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `phone` varchar(13) NOT NULL,
  `rank` varchar(30) NOT NULL,
  `score` int(11) NOT NULL,
  `clearance` tinyint(1) NOT NULL,
  `salt` text NOT NULL,
  `activationKey` text NOT NULL,
  `emailActivation` tinyint(1) NOT NULL,
  `execActivation` tinyint(1) NOT NULL,
  `dateJoined` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `USER_BADGE`
--

CREATE TABLE `USER_BADGE` (
  `userId` int(11) NOT NULL,
  `badgeId` int(11) NOT NULL,
  `dateObtained` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `USER_CHAT`
--

CREATE TABLE `USER_CHAT` (
  `userId` int(11) NOT NULL,
  `chatId` int(11) NOT NULL,
  `dateAdded` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `USER_POLL`
--

CREATE TABLE `USER_POLL` (
  `userId` int(11) NOT NULL,
  `pollId` int(11) NOT NULL,
  `userName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `USER_POST`
--

CREATE TABLE `USER_POST` (
  `userId` int(11) NOT NULL,
  `postId` int(11) NOT NULL,
  `userName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `USER_REVIEW`
--

CREATE TABLE `USER_REVIEW` (
  `userId` int(11) NOT NULL,
  `reviewId` int(11) NOT NULL,
  `userName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `BADGE`
--
ALTER TABLE `BADGE`
  ADD PRIMARY KEY (`badgeId`);

--
-- Indexes for table `CHAT`
--
ALTER TABLE `CHAT`
  ADD PRIMARY KEY (`chatId`);

--
-- Indexes for table `MESSAGE`
--
ALTER TABLE `MESSAGE`
  ADD PRIMARY KEY (`messageId`,`userId`,`chatId`),
  ADD KEY `userId` (`userId`),
  ADD KEY `chatId` (`chatId`);

--
-- Indexes for table `POLL`
--
ALTER TABLE `POLL`
  ADD PRIMARY KEY (`pollId`);

--
-- Indexes for table `POLL_OPTION`
--
ALTER TABLE `POLL_OPTION`
  ADD PRIMARY KEY (`optionId`,`pollId`),
  ADD KEY `pollId` (`pollId`);

--
-- Indexes for table `POST`
--
ALTER TABLE `POST`
  ADD PRIMARY KEY (`postId`);

--
-- Indexes for table `REVIEW`
--
ALTER TABLE `REVIEW`
  ADD PRIMARY KEY (`reviewId`);

--
-- Indexes for table `USER`
--
ALTER TABLE `USER`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `USER_BADGE`
--
ALTER TABLE `USER_BADGE`
  ADD PRIMARY KEY (`userId`,`badgeId`),
  ADD KEY `badgeId` (`badgeId`);

--
-- Indexes for table `USER_CHAT`
--
ALTER TABLE `USER_CHAT`
  ADD PRIMARY KEY (`userId`,`chatId`),
  ADD KEY `chatId` (`chatId`);

--
-- Indexes for table `USER_POLL`
--
ALTER TABLE `USER_POLL`
  ADD PRIMARY KEY (`userId`,`pollId`);

--
-- Indexes for table `USER_POST`
--
ALTER TABLE `USER_POST`
  ADD PRIMARY KEY (`userId`,`postId`),
  ADD KEY `postId` (`postId`);

--
-- Indexes for table `USER_REVIEW`
--
ALTER TABLE `USER_REVIEW`
  ADD PRIMARY KEY (`userId`,`reviewId`),
  ADD KEY `reviewId` (`reviewId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `BADGE`
--
ALTER TABLE `BADGE`
  MODIFY `badgeId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `CHAT`
--
ALTER TABLE `CHAT`
  MODIFY `chatId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `MESSAGE`
--
ALTER TABLE `MESSAGE`
  MODIFY `messageId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `POLL`
--
ALTER TABLE `POLL`
  MODIFY `pollId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `POLL_OPTION`
--
ALTER TABLE `POLL_OPTION`
  MODIFY `optionId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `POST`
--
ALTER TABLE `POST`
  MODIFY `postId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `REVIEW`
--
ALTER TABLE `REVIEW`
  MODIFY `reviewId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `USER`
--
ALTER TABLE `USER`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `MESSAGE`
--
ALTER TABLE `MESSAGE`
  ADD CONSTRAINT `MESSAGE_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `USER_CHAT` (`userId`) ON DELETE CASCADE,
  ADD CONSTRAINT `MESSAGE_ibfk_2` FOREIGN KEY (`chatId`) REFERENCES `CHAT` (`chatId`) ON DELETE CASCADE;

--
-- Constraints for table `POLL_OPTION`
--
ALTER TABLE `POLL_OPTION`
  ADD CONSTRAINT `POLL_OPTION_ibfk_1` FOREIGN KEY (`pollId`) REFERENCES `POLL` (`pollId`) ON DELETE CASCADE;

--
-- Constraints for table `USER_BADGE`
--
ALTER TABLE `USER_BADGE`
  ADD CONSTRAINT `USER_BADGE_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `USER` (`userId`) ON DELETE CASCADE,
  ADD CONSTRAINT `USER_BADGE_ibfk_2` FOREIGN KEY (`badgeId`) REFERENCES `BADGE` (`badgeId`) ON DELETE CASCADE;

--
-- Constraints for table `USER_CHAT`
--
ALTER TABLE `USER_CHAT`
  ADD CONSTRAINT `USER_CHAT_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `USER` (`userId`) ON DELETE CASCADE,
  ADD CONSTRAINT `USER_CHAT_ibfk_2` FOREIGN KEY (`chatId`) REFERENCES `CHAT` (`chatId`) ON DELETE CASCADE;

--
-- Constraints for table `USER_POST`
--
ALTER TABLE `USER_POST`
  ADD CONSTRAINT `USER_POST_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `USER` (`userId`) ON DELETE CASCADE,
  ADD CONSTRAINT `USER_POST_ibfk_2` FOREIGN KEY (`postId`) REFERENCES `POST` (`postId`) ON DELETE CASCADE;

--
-- Constraints for table `USER_REVIEW`
--
ALTER TABLE `USER_REVIEW`
  ADD CONSTRAINT `USER_REVIEW_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `USER` (`userId`) ON DELETE CASCADE,
  ADD CONSTRAINT `USER_REVIEW_ibfk_2` FOREIGN KEY (`reviewId`) REFERENCES `REVIEW` (`reviewId`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

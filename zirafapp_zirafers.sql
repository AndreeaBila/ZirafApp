-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2017 at 03:00 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

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
-- Table structure for table `badges`
--

CREATE TABLE `badges` (
  `badgeId` int(11) NOT NULL,
  `badgeTitle` varchar(30) NOT NULL,
  `badgeContent` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `chatId` int(11) NOT NULL,
  `chatName` varchar(50) NOT NULL,
  `dateCreated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`chatId`, `chatName`, `dateCreated`) VALUES
(1, 'All Zirafers', '2017-12-24');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `messageId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `chatId` int(11) NOT NULL,
  `content` text NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `polls`
--

CREATE TABLE `polls` (
  `pollId` int(11) NOT NULL,
  `pollStatement` varchar(50) NOT NULL,
  `dateCreated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `poll_options`
--

CREATE TABLE `poll_options` (
  `optionId` int(11) NOT NULL,
  `pollId` int(11) NOT NULL,
  `content` text NOT NULL,
  `votes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `postId` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `likes` int(11) NOT NULL,
  `dateCreated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
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
-- Table structure for table `users`
--

CREATE TABLE `users` (
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
  `iconExtension` varchar(10) NOT NULL,
  `salt` text NOT NULL,
  `activationKey` text NOT NULL,
  `emailActivation` tinyint(1) NOT NULL,
  `execActivation` tinyint(1) NOT NULL,
  `cookieHash` text NOT NULL,
  `dateJoined` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `userName`, `email`, `password`, `socialHandle`, `description`, `phone`, `rank`, `score`, `clearance`, `iconExtension`, `salt`, `activationKey`, `emailActivation`, `execActivation`, `cookieHash`, `dateJoined`) VALUES
(85, 'Vlad', 'vlad@email.com', 'ef6cbfb01ab4aa0c00e0207bb795151b54d0c0b5', 'vlad', 'vlad', '123456789', 'Baby Zirafer', 0, 1, 'jpg', '96df8ac2b06a9abce13ee9e0a6c4f5ec1889e3d5', '97a7c7e3006eda88cab06e28b46bce9e8aa3aea0', 1, 1, 'cc89904249120d0fce2b81dc68ee9435bcc9bd70', '2017-12-30'),
(86, 'Andreea', 'andreea@email.com', 'bfa4fac4bf85bae6bb44ec168935d4ed301fe5f3', 'andreea', 'andreea', '123456789', 'Baby Zirafer', 0, 1, 'jpg', 'dba795a25f16fa02d365b446680e601a3e5a2274', '0e4f672e61cf331a86dbc29a79e27ff90909f09b', 1, 1, '2c33019102b18874ec32209bda9337da24ae7a2a', '2017-12-30'),
(87, 'Maria', 'maria@email.com', '45d21d16e5caf83322d38489e8dd549be7e20286', 'maria', 'maria', '123456789', 'Baby Zirafer', 0, 0, 'jpeg', '3325f046fc59694d37f2b88ca9d30f6ce0e3e69b', '20bb3a40db719e5f31c1e5209c904d95b0b5e151', 1, 1, '07d75bef6e39fb867ea615e52378c7822ccbc4be', '2017-12-30');

-- --------------------------------------------------------

--
-- Table structure for table `user_badges`
--

CREATE TABLE `user_badges` (
  `userId` int(11) NOT NULL,
  `badgeId` int(11) NOT NULL,
  `dateObtained` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_chats`
--

CREATE TABLE `user_chats` (
  `userId` int(11) NOT NULL,
  `chatId` int(11) NOT NULL,
  `dateAdded` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_chats`
--

INSERT INTO `user_chats` (`userId`, `chatId`, `dateAdded`) VALUES
(85, 1, '2017-12-30'),
(86, 1, '2017-12-30'),
(87, 1, '2017-12-30');

-- --------------------------------------------------------

--
-- Table structure for table `user_polls`
--

CREATE TABLE `user_polls` (
  `userId` int(11) NOT NULL,
  `pollId` int(11) NOT NULL,
  `userName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_posts`
--

CREATE TABLE `user_posts` (
  `userId` int(11) NOT NULL,
  `postId` int(11) NOT NULL,
  `userName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_reviews`
--

CREATE TABLE `user_reviews` (
  `userId` int(11) NOT NULL,
  `reviewId` int(11) NOT NULL,
  `userName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `badges`
--
ALTER TABLE `badges`
  ADD PRIMARY KEY (`badgeId`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`chatId`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`messageId`,`userId`,`chatId`),
  ADD KEY `userId` (`userId`),
  ADD KEY `chatId` (`chatId`);

--
-- Indexes for table `polls`
--
ALTER TABLE `polls`
  ADD PRIMARY KEY (`pollId`);

--
-- Indexes for table `poll_options`
--
ALTER TABLE `poll_options`
  ADD PRIMARY KEY (`optionId`,`pollId`),
  ADD KEY `pollId` (`pollId`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`postId`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`reviewId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `user_badges`
--
ALTER TABLE `user_badges`
  ADD PRIMARY KEY (`userId`,`badgeId`),
  ADD KEY `badgeId` (`badgeId`);

--
-- Indexes for table `user_chats`
--
ALTER TABLE `user_chats`
  ADD PRIMARY KEY (`userId`,`chatId`),
  ADD KEY `chatId` (`chatId`);

--
-- Indexes for table `user_polls`
--
ALTER TABLE `user_polls`
  ADD PRIMARY KEY (`userId`,`pollId`);

--
-- Indexes for table `user_posts`
--
ALTER TABLE `user_posts`
  ADD PRIMARY KEY (`userId`,`postId`),
  ADD KEY `postId` (`postId`);

--
-- Indexes for table `user_reviews`
--
ALTER TABLE `user_reviews`
  ADD PRIMARY KEY (`userId`,`reviewId`),
  ADD KEY `reviewId` (`reviewId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `badges`
--
ALTER TABLE `badges`
  MODIFY `badgeId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `chatId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `messageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `polls`
--
ALTER TABLE `polls`
  MODIFY `pollId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `poll_options`
--
ALTER TABLE `poll_options`
  MODIFY `optionId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `postId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `reviewId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `MESSAGE_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user_chats` (`userId`) ON DELETE CASCADE,
  ADD CONSTRAINT `MESSAGE_ibfk_2` FOREIGN KEY (`chatId`) REFERENCES `chats` (`chatId`) ON DELETE CASCADE;

--
-- Constraints for table `poll_options`
--
ALTER TABLE `poll_options`
  ADD CONSTRAINT `POLL_OPTION_ibfk_1` FOREIGN KEY (`pollId`) REFERENCES `polls` (`pollId`) ON DELETE CASCADE;

--
-- Constraints for table `user_badges`
--
ALTER TABLE `user_badges`
  ADD CONSTRAINT `USER_BADGE_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE CASCADE,
  ADD CONSTRAINT `USER_BADGE_ibfk_2` FOREIGN KEY (`badgeId`) REFERENCES `badges` (`badgeId`) ON DELETE CASCADE;

--
-- Constraints for table `user_chats`
--
ALTER TABLE `user_chats`
  ADD CONSTRAINT `USER_CHAT_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE CASCADE,
  ADD CONSTRAINT `USER_CHAT_ibfk_2` FOREIGN KEY (`chatId`) REFERENCES `chats` (`chatId`) ON DELETE CASCADE;

--
-- Constraints for table `user_posts`
--
ALTER TABLE `user_posts`
  ADD CONSTRAINT `USER_POST_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE CASCADE,
  ADD CONSTRAINT `USER_POST_ibfk_2` FOREIGN KEY (`postId`) REFERENCES `posts` (`postId`) ON DELETE CASCADE;

--
-- Constraints for table `user_reviews`
--
ALTER TABLE `user_reviews`
  ADD CONSTRAINT `USER_REVIEW_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE CASCADE,
  ADD CONSTRAINT `USER_REVIEW_ibfk_2` FOREIGN KEY (`reviewId`) REFERENCES `reviews` (`reviewId`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2018 at 03:13 PM
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
-- Table structure for table `dishes`
--

CREATE TABLE `dishes` (
  `dishId` int(11) NOT NULL,
  `dishName` varchar(75) NOT NULL,
  `reviewId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `image_uploads`
--

CREATE TABLE `image_uploads` (
  `imageId` int(11) NOT NULL,
  `fileName` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `dateCreated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `pollDescription` text NOT NULL,
  `dateCreated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `poll_options`
--

CREATE TABLE `poll_options` (
  `optionId` int(11) NOT NULL,
  `pollId` int(11) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `postId` int(11) NOT NULL,
  `content` text NOT NULL,
  `dateCreated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `reviewId` int(11) NOT NULL,
  `locationName` varchar(50) NOT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `user_imagelikes`
--

CREATE TABLE `user_imagelikes` (
  `userId` int(11) NOT NULL,
  `imageId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_images`
--

CREATE TABLE `user_images` (
  `userId` int(11) NOT NULL,
  `imageId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_polllikes`
--

CREATE TABLE `user_polllikes` (
  `userId` int(11) NOT NULL,
  `pollId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_polls`
--

CREATE TABLE `user_polls` (
  `userId` int(11) NOT NULL,
  `pollId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_postlikes`
--

CREATE TABLE `user_postlikes` (
  `userId` int(11) NOT NULL,
  `postId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_posts`
--

CREATE TABLE `user_posts` (
  `userId` int(11) NOT NULL,
  `postId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_reviews`
--

CREATE TABLE `user_reviews` (
  `userId` int(11) NOT NULL,
  `reviewId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_votes`
--

CREATE TABLE `user_votes` (
  `userId` int(11) NOT NULL,
  `pollId` int(11) NOT NULL,
  `optionId` int(11) NOT NULL
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
-- Indexes for table `dishes`
--
ALTER TABLE `dishes`
  ADD PRIMARY KEY (`dishId`,`reviewId`),
  ADD KEY `reviewId` (`reviewId`);

--
-- Indexes for table `image_uploads`
--
ALTER TABLE `image_uploads`
  ADD PRIMARY KEY (`imageId`);

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
-- Indexes for table `user_imagelikes`
--
ALTER TABLE `user_imagelikes`
  ADD PRIMARY KEY (`userId`,`imageId`),
  ADD KEY `imageId` (`imageId`);

--
-- Indexes for table `user_images`
--
ALTER TABLE `user_images`
  ADD PRIMARY KEY (`userId`,`imageId`),
  ADD KEY `imageId` (`imageId`);

--
-- Indexes for table `user_polllikes`
--
ALTER TABLE `user_polllikes`
  ADD PRIMARY KEY (`userId`,`pollId`),
  ADD KEY `pollId` (`pollId`);

--
-- Indexes for table `user_polls`
--
ALTER TABLE `user_polls`
  ADD PRIMARY KEY (`userId`,`pollId`),
  ADD KEY `pollId` (`pollId`);

--
-- Indexes for table `user_postlikes`
--
ALTER TABLE `user_postlikes`
  ADD PRIMARY KEY (`userId`,`postId`),
  ADD KEY `postId` (`postId`);

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
-- Indexes for table `user_votes`
--
ALTER TABLE `user_votes`
  ADD PRIMARY KEY (`userId`,`pollId`,`optionId`),
  ADD KEY `pollId` (`pollId`),
  ADD KEY `optionId` (`optionId`);

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
  MODIFY `chatId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dishes`
--
ALTER TABLE `dishes`
  MODIFY `dishId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `image_uploads`
--
ALTER TABLE `image_uploads`
  MODIFY `imageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `messageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `polls`
--
ALTER TABLE `polls`
  MODIFY `pollId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `poll_options`
--
ALTER TABLE `poll_options`
  MODIFY `optionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `postId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `reviewId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dishes`
--
ALTER TABLE `dishes`
  ADD CONSTRAINT `dishes_ibfk_1` FOREIGN KEY (`reviewId`) REFERENCES `reviews` (`reviewId`) ON DELETE CASCADE;

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
-- Constraints for table `user_imagelikes`
--
ALTER TABLE `user_imagelikes`
  ADD CONSTRAINT `user_imagelikes_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_imagelikes_ibfk_2` FOREIGN KEY (`imageId`) REFERENCES `image_uploads` (`imageId`) ON DELETE CASCADE;

--
-- Constraints for table `user_images`
--
ALTER TABLE `user_images`
  ADD CONSTRAINT `user_images_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_images_ibfk_2` FOREIGN KEY (`imageId`) REFERENCES `image_uploads` (`imageId`) ON DELETE CASCADE;

--
-- Constraints for table `user_polllikes`
--
ALTER TABLE `user_polllikes`
  ADD CONSTRAINT `user_polllikes_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_polllikes_ibfk_2` FOREIGN KEY (`pollId`) REFERENCES `polls` (`pollId`) ON DELETE CASCADE;

--
-- Constraints for table `user_polls`
--
ALTER TABLE `user_polls`
  ADD CONSTRAINT `user_polls_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_polls_ibfk_2` FOREIGN KEY (`pollId`) REFERENCES `polls` (`pollId`) ON DELETE CASCADE;

--
-- Constraints for table `user_postlikes`
--
ALTER TABLE `user_postlikes`
  ADD CONSTRAINT `user_postlikes_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_postlikes_ibfk_2` FOREIGN KEY (`postId`) REFERENCES `posts` (`postId`) ON DELETE CASCADE;

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

--
-- Constraints for table `user_votes`
--
ALTER TABLE `user_votes`
  ADD CONSTRAINT `user_votes_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_votes_ibfk_2` FOREIGN KEY (`pollId`) REFERENCES `polls` (`pollId`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_votes_ibfk_3` FOREIGN KEY (`optionId`) REFERENCES `poll_options` (`optionId`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

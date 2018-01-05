-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2018 at 07:38 PM
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
(1, 'All Zirafers', '2017-12-24'),
(2, 'Test', '2017-12-30'),
(3, 'Second test', '2017-12-30'),
(4, 'New', '2017-12-30'),
(5, 'Tweeks', '2018-01-03'),
(6, 'Test', '2018-01-03'),
(7, 'Last Test', '2018-01-03');

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

--
-- Dumping data for table `image_uploads`
--

INSERT INTO `image_uploads` (`imageId`, `fileName`, `description`, `dateCreated`) VALUES
(11, '85_default.jpeg', 'First image', '2018-01-05 18:54:34'),
(12, '85_Testing.jpg', 'Second\r\nphoto', '2018-01-05 19:09:26');

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

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`messageId`, `userId`, `chatId`, `content`, `dateCreated`) VALUES
(20, 85, 1, 'hi there', '2018-01-03 23:47:00'),
(21, 85, 1, 'this is my second message', '2018-01-03 23:47:00'),
(22, 86, 1, 'hi vlad', '2018-01-03 23:48:00'),
(23, 85, 1, 'hi andreea', '2018-01-03 23:48:00'),
(24, 85, 1, 'how you doin', '2018-01-03 23:48:00'),
(25, 86, 1, 'i.m good', '2018-01-03 23:48:00'),
(26, 86, 1, 'what about you', '2018-01-03 23:48:00'),
(27, 85, 1, 'i\'m good too', '2018-01-03 23:48:00'),
(28, 85, 1, 'working ', '2018-01-03 23:48:00'),
(29, 85, 1, 'what are you doing right now?', '2018-01-03 23:49:00'),
(30, 86, 1, 'nothing much', '2018-01-03 23:49:00'),
(31, 86, 1, 'just testing the website', '2018-01-03 23:49:00'),
(32, 86, 1, 'i want to sleep', '2018-01-03 23:49:00'),
(33, 86, 1, 'but i cant', '2018-01-03 23:49:00'),
(34, 86, 1, 'cuz i hva to test the website', '2018-01-03 23:50:00'),
(35, 85, 1, 'oh', '2018-01-03 23:50:00'),
(36, 85, 1, 'that soubds naspa', '2018-01-03 23:50:00'),
(37, 85, 1, 'i\'m sorry to hear that', '2018-01-03 23:50:00'),
(38, 85, 1, 'i think', '2018-01-04 00:27:00'),
(39, 85, 1, 'i just fixed the messages', '2018-01-04 00:27:00'),
(40, 86, 1, 'wow', '2018-01-04 00:27:00'),
(41, 86, 1, 'that woulkd be great', '2018-01-04 00:27:00'),
(42, 86, 1, 'you surwe it works?', '2018-01-04 00:28:00'),
(43, 85, 1, 'not much', '2018-01-04 00:28:00'),
(44, 85, 1, 'but yes', '2018-01-04 00:28:00'),
(45, 85, 1, 'it seems that the problem was solved', '2018-01-04 00:28:00'),
(46, 85, 1, 'ill test a lil more tomowrrow', '2018-01-04 00:28:00'),
(47, 86, 1, 'great', '2018-01-04 00:28:00'),
(48, 86, 1, 'good to hear it', '2018-01-04 00:28:00'),
(49, 86, 1, 'and you wanna go to slee[p now?', '2018-01-04 00:28:00'),
(50, 85, 1, 'yes', '2018-01-04 00:29:00'),
(51, 85, 1, 'I would love to', '2018-01-04 00:29:00'),
(52, 85, 1, 'do wyou want to go?', '2018-01-04 00:29:00'),
(53, 85, 1, 'heeei', '2018-01-04 00:29:00'),
(54, 86, 1, 'hey', '2018-01-04 00:29:00'),
(55, 85, 1, 'hey', '2018-01-04 00:29:00'),
(56, 86, 1, 'yeah', '2018-01-04 00:29:00'),
(57, 86, 1, 'sorry', '2018-01-04 00:29:00'),
(58, 86, 1, 'I didnt pay attention', '2018-01-04 00:29:00'),
(59, 86, 1, 'yes', '2018-01-04 00:30:00'),
(60, 86, 1, 'I would love to go', '2018-01-04 00:30:00'),
(61, 85, 1, 'great', '2018-01-04 00:30:00'),
(62, 87, 1, 'hi guuuuys', '2018-01-04 12:18:00'),
(63, 87, 1, 'mornin', '2018-01-04 12:18:00'),
(64, 85, 1, 'mornin marie', '2018-01-04 12:18:00'),
(65, 85, 1, 'ce faci?', '2018-01-04 12:18:00'),
(66, 87, 1, ']bine bai', '2018-01-04 12:18:00'),
(67, 87, 1, 'blana', '2018-01-04 12:18:00'),
(68, 85, 1, 'perf', '2018-01-04 12:18:00'),
(69, 87, 1, 'voi?', '2018-01-04 12:18:00'),
(70, 85, 1, 'bineee', '2018-01-04 12:18:00'),
(71, 85, 1, 'la calculator', '2018-01-04 12:19:00'),
(72, 87, 1, 'marfa', '2018-01-04 12:19:00'),
(73, 85, 1, 'gataaaa', '2018-01-04 12:35:00'),
(74, 85, 1, 'cred ca am re[arat tot', '2018-01-04 12:35:00'),
(75, 87, 1, 'blana', '2018-01-04 12:36:00'),
(76, 87, 1, 'parca merge', '2018-01-04 12:36:00'),
(77, 87, 1, 'ti se pare ceva ciudat?', '2018-01-04 12:36:00'),
(78, 85, 1, 'nup', '2018-01-04 12:36:00'),
(79, 85, 1, 'all seems good', '2018-01-04 12:36:00'),
(80, 87, 1, 'perf', '2018-01-04 12:36:00'),
(81, 85, 1, 'yep', '2018-01-04 12:36:00'),
(82, 85, 1, 'hai ca merge', '2018-01-04 12:37:00'),
(83, 87, 1, 'ok', '2018-01-04 12:37:00'),
(84, 87, 1, 'lets do posts', '2018-01-04 12:37:00');

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

--
-- Dumping data for table `polls`
--

INSERT INTO `polls` (`pollId`, `pollStatement`, `pollDescription`, `dateCreated`) VALUES
(23, 'Poll', 'First Poll', '2018-01-05 18:54:18'),
(24, 'Seocnd poll', 'bla', '2018-01-05 19:09:46');

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

--
-- Dumping data for table `poll_options`
--

INSERT INTO `poll_options` (`optionId`, `pollId`, `content`, `votes`) VALUES
(68, 23, 'Answer 1', 0),
(69, 23, 'Answer 2', 0),
(70, 23, 'Answer 3', 0),
(71, 24, 'answer', 0),
(72, 24, '1', 0),
(73, 24, '2', 0),
(74, 24, '3', 0);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `postId` int(11) NOT NULL,
  `content` text NOT NULL,
  `dateCreated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`postId`, `content`, `dateCreated`) VALUES
(27, 'First announcement', '2018-01-05 18:52:37'),
(28, 'Second announcement', '2018-01-05 19:07:58');

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
(85, 1, '2018-01-03'),
(85, 7, '2018-01-03'),
(86, 1, '2018-01-03'),
(86, 2, '2017-12-30'),
(86, 7, '2018-01-03'),
(87, 1, '2018-01-03'),
(87, 7, '2018-01-03');

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

--
-- Dumping data for table `user_images`
--

INSERT INTO `user_images` (`userId`, `imageId`) VALUES
(85, 11),
(85, 12);

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

--
-- Dumping data for table `user_polls`
--

INSERT INTO `user_polls` (`userId`, `pollId`) VALUES
(85, 23),
(85, 24);

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

--
-- Dumping data for table `user_posts`
--

INSERT INTO `user_posts` (`userId`, `postId`) VALUES
(85, 27),
(85, 28);

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
  MODIFY `chatId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `image_uploads`
--
ALTER TABLE `image_uploads`
  MODIFY `imageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `messageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `polls`
--
ALTER TABLE `polls`
  MODIFY `pollId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `poll_options`
--
ALTER TABLE `poll_options`
  MODIFY `optionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `postId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

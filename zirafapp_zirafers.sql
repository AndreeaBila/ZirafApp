-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2017 at 06:01 PM
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
  `dateCreated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`messageId`, `userId`, `chatId`, `content`, `dateCreated`) VALUES
(4, 46, 1, 'fisrt message', '2017-12-24'),
(5, 70, 1, 'second message', '2017-12-24'),
(6, 70, 1, 'third message', '2017-12-24'),
(7, 46, 1, 'fourth message', '2017-12-24'),
(8, 70, 1, 'fifth messagew', '2017-12-24'),
(9, 70, 1, 'mesaj de la marioutza', '2017-12-24'),
(10, 46, 1, 'asd', '2017-12-24');

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

INSERT INTO `users` (`userId`, `userName`, `email`, `password`, `socialHandle`, `description`, `phone`, `rank`, `score`, `clearance`, `salt`, `activationKey`, `emailActivation`, `execActivation`, `cookieHash`, `dateJoined`) VALUES
(44, 'notactivated', 'notactivated@email.com', '15ce6105f2d0ce9a7fdbee5b00316bc55fa6583a', 'notactivated', 'notactivated', '123456789', 'Baby Zirafer', 0, 0, '6b207fb80e03e2882240f4d7c5af843fd60c09f2', '2b1054765d3a5f4e84c7e0d6435aa47b22b6f5ee', 0, 0, '52934e243fc5437eeb6b30e16734613ca0441793', '2017-12-19'),
(45, 'zirafer', 'zirafer@email.com', '317a4892e06980a8979741776b099828fd1be53e', 'zirafer', 'zirafer', '123456789', 'Baby Zirafer', 0, 0, '936665c615b35941bfa103d921fc818c4040cc00', '36a3276c3fb8c6d9ed26dd26a5f5a52e0c2194a5', 1, 1, '778864379ffec8036d35a72b4b9b68d7a6a52e0e', '2017-12-19'),
(46, 'exec', 'exec@email.com', 'b2cdf787f07c63db781291a57c739226621286c9', 'exec', 'exec', '123456789', 'Baby Zirafer', 0, 1, 'aa1ab1dc59ee7fe51ea2e70321603234dddfc91e', '092f3ee3f89337de5f879f29abd50a9136225443', 1, 1, '9d6806bf617fd09c9f51daaa982e57cf015e1222', '2017-12-19'),
(62, 'test', 'test@test.com', '2de08f12b58dc4c12e4a4668bcd7d3d91de32676', 'test', 'test', 'test', 'Baby Zirafer', 0, 0, 'd6ae05e4845259eef1404f50e9a9d0aaf0a99720', '63c0c89c7e3271ff977f5a4c890388ce47788579', 0, 1, 'dc5df082ad21167170375656784ec6bbad462d55', '2017-12-21'),
(63, 'test', 'test1@test.com', '078783144fd3359382444c06ddaa28726dfa6dc8', 'test', 'test', 'test', 'Baby Zirafer', 0, 0, '07157125213442b9ea888556e2f41cb7e9fd4a49', 'a449406760d47e13e62d3afb4d6df5878baadaf5', 0, 1, 'bdbb4222f516df0d602bcef3254b2ca3bf518b26', '2017-12-21'),
(65, 'test', 'test2@test.com', 'efe9556887ece523c40abc790cbfc44370b5a61e', 'test', 'test', 'test', 'Baby Zirafer', 0, 0, '7a7f9727f16a29f5cfd107ab2c7abc605206ff31', '875668681be6c8ff25115813b575c7027d2b8b12', 0, 1, 'a4389e873f0f32ebbafff7e5cd8def1f3f84370f', '2017-12-24'),
(66, 'test', 'tesdfsst@test.com', 'f58e91d9aec9f0d45b8c815e4f924ecc50638130', 'test', 'test', 'test', 'Baby Zirafer', 0, 0, '93de039b5911733374a3c4e2e2288e3260646971', '06989053b974c3c34b05433b2ab26922f7e204c0', 0, 0, 'cb356fc4ffe526f728bbd78631c632f2b8ebcbcd', '2017-12-24'),
(67, 'test', 'tessssaaast@test.com', '2deedda6132a5af7ac413d6f977122f5cf2d69f7', 'test', 'test', 'test', 'Baby Zirafer', 0, 0, '3d554d9d7d91efd5f7028a2e5d652e90872f7cf0', '08a9ade436cd6d2377b75cb02e8b1ed9b2d075e9', 0, 0, 'ccf957f21de4f4703dcce4190e70d8236ebbbaa4', '2017-12-24'),
(68, 'test', 'tesaswezst@test.com', '496e929b34f1ed7123602ebf75d3c422669e321c', 'test', 'test', 'test', 'Baby Zirafer', 0, 0, '56f1a44cfaab13c4f802fc6db8927910794ecc83', '72bde96ec61ff9b681f04d52497777cfc43e4aa5', 0, 0, '5c220e6555b662ddb920d230db47dac27f90f2cf', '2017-12-24'),
(69, 'test', 'tesgffddfgfdgt@test.com', '385dd672afbc6b88b9dc13a8da4fa867e4722b65', 'test', 'test', 'test', 'Baby Zirafer', 0, 0, '833e6da5ff184e6299ac6357ed8cb83cdb885e67', 'be8b617a87a83fbb1ba3359f6aa0830604049dd7', 0, 0, '4338f1acf145f1a1d5c20c63b79fd551b4abbed0', '2017-12-24'),
(70, 'message', 'message@email.com', '15d179bd05e730681ca49c2e0bd379503bdb8c72', 'message', 'message', '123456789', 'Baby Zirafer', 0, 0, 'cfce95cd07a9d394841190342aab9f7e051c6819', '8ed8bfdee205e73b73f5c568e3fbb5f1ae5eb8a0', 1, 1, 'af34eb1a5f14280bd93178e7adf95ab0c0baedf6', '2017-12-24');

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
(46, 1, '2017-12-13'),
(66, 1, '0000-00-00'),
(67, 1, '0000-00-00'),
(68, 1, '0000-00-00'),
(69, 1, '2017-12-24'),
(70, 1, '2017-12-24');

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
  MODIFY `chatId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `messageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

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

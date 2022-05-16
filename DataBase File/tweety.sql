-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2021 at 09:50 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tweety`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `commentID` int(11) NOT NULL,
  `comment` varchar(140) NOT NULL,
  `commentOn` int(11) NOT NULL,
  `commentBy` int(11) NOT NULL,
  `commentAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`commentID`, `comment`, `commentOn`, `commentBy`, `commentAt`) VALUES
(1, 'Interested', 3, 5, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `follow`
--

CREATE TABLE `follow` (
  `followID` int(11) NOT NULL,
  `sender` int(11) NOT NULL,
  `receiver` int(11) NOT NULL,
  `followOn` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `follow`
--

INSERT INTO `follow` (`followID`, `sender`, `receiver`, `followOn`) VALUES
(1, 4, 3, '2021-04-28 09:45:14'),
(2, 5, 4, '2021-04-28 09:47:51'),
(3, 5, 3, '2021-04-28 09:48:47'),
(4, 4, 5, '2021-04-28 09:49:25');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `likeID` int(11) NOT NULL,
  `likeBy` int(11) NOT NULL,
  `likeOn` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`likeID`, `likeBy`, `likeOn`) VALUES
(1, 5, 3);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `messageID` int(11) NOT NULL,
  `message` text NOT NULL,
  `messageTo` int(11) NOT NULL,
  `messageFrom` int(11) NOT NULL,
  `messageOn` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`messageID`, `message`, `messageTo`, `messageFrom`, `messageOn`, `status`) VALUES
(1, 'Hii....How are you', 4, 5, '2021-04-28 09:48:33', 1),
(2, 'Hey, I am good', 5, 4, '2021-04-28 09:49:57', 0),
(3, 'what\'s about you', 5, 4, '2021-04-28 09:50:05', 0);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `ID` int(11) NOT NULL,
  `notificationFor` int(11) NOT NULL,
  `notificationFrom` int(11) NOT NULL,
  `target` int(11) NOT NULL,
  `type` enum('follow','retweet','like','mention') NOT NULL,
  `time` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`ID`, `notificationFor`, `notificationFrom`, `target`, `type`, `time`, `status`) VALUES
(1, 3, 4, 4, 'follow', '2021-04-28 09:45:14', 0),
(2, 4, 5, 4, 'mention', '2021-04-28 09:47:45', 1),
(3, 4, 5, 5, 'follow', '2021-04-28 09:47:52', 1),
(4, 4, 5, 3, 'like', '2021-04-28 09:48:01', 1),
(5, 3, 5, 5, 'follow', '2021-04-28 09:48:47', 0),
(6, 5, 4, 4, 'follow', '2021-04-28 09:49:25', 0);

-- --------------------------------------------------------

--
-- Table structure for table `trends`
--

CREATE TABLE `trends` (
  `trendID` int(11) NOT NULL,
  `hashtag` varchar(140) NOT NULL,
  `createdOn` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trends`
--

INSERT INTO `trends` (`trendID`, `hashtag`, `createdOn`) VALUES
(1, '100daysofcode', '2021-04-28 13:03:19'),
(6, 'GoogleIO', '2021-04-28 13:13:22'),
(8, 'IndiaFacultySummit', '2021-04-28 13:14:49'),
(10, 'tweets', '2021-04-28 13:17:45');

-- --------------------------------------------------------

--
-- Table structure for table `tweets`
--

CREATE TABLE `tweets` (
  `tweetID` int(11) NOT NULL,
  `status` varchar(1000) NOT NULL,
  `tweetBy` int(11) NOT NULL,
  `retweetID` int(11) NOT NULL,
  `retweetBy` int(11) NOT NULL,
  `tweetImage` varchar(255) NOT NULL,
  `likesCount` int(11) NOT NULL,
  `retweetCount` int(11) NOT NULL,
  `postedOn` datetime NOT NULL,
  `retweetMsg` varchar(140) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tweets`
--

INSERT INTO `tweets` (`tweetID`, `status`, `tweetBy`, `retweetID`, `retweetBy`, `tweetImage`, `likesCount`, `retweetCount`, `postedOn`, `retweetMsg`) VALUES
(1, 'Day 6 of #100daysofcode Learned about Recursions and Recursive Function. Done Problems on Fibonacci series &amp; Factorial. Need More Focus on Building Logic, Problem solving and thinking ability. #codingnewbies #coding #problemsolvingskills #programming', 4, 0, 0, 'users/code.jpg', 0, 0, '2021-04-28 09:33:19', ''),
(2, 'Let’s go to #GoogleIO!\r\n\r\n#GoogleIO brings together developers from around the world for thoughtful discussions, interactive learning with Google experts and a first look at Google’s latest developer products.\r\n\r\nDetails → https://goo.gle', 4, 0, 0, 'users/google.png', 0, 0, '2021-04-28 09:43:21', ''),
(3, 'We are all excited for the #IndiaFacultySummit! Connect with #Google experts, get inspired, and expand your knowledge on Google technologies. Block your dates: April 23rd, 10:00 AM to 12:30 PM IST Have you registered for it? If not, register here https://goo.gle', 4, 0, 0, '', 1, 0, '2021-04-28 09:44:49', ''),
(4, 'Developed a web Application &quot;Twitter - The Social Media Platform&quot; with @nikhil01 It is a platform where user can interact with each other, share their thoughts, and messages known as #tweets. Frontend: #HTML #CSS #javaScript Backend: #php Framework: #Bootstrap Database: #MySql', 5, 0, 0, '', 0, 0, '2021-04-28 09:47:45', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(32) NOT NULL,
  `screenName` varchar(40) NOT NULL,
  `profileImage` varchar(255) NOT NULL,
  `profileCover` varchar(255) NOT NULL,
  `following` int(11) NOT NULL,
  `followers` int(11) NOT NULL,
  `bio` varchar(140) NOT NULL,
  `country` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `screenName`, `profileImage`, `profileCover`, `following`, `followers`, `bio`, `country`, `website`) VALUES
(1, 'chaurasia20', 'chaurasia@gmail.com', 'ab84e1ad31337246d6d98e3ca709eeaf', 'Yash Chaurasia', 'users/eat-sleep-code-repeat-saying-t-shirt-for-coder-vector-31386255.jpg', 'users/coding.png', 0, 0, 'Full Stack Developer | Freelancer', 'India', 'www.chaurasia.com'),
(2, 'kartik001', 'kartik@gmail.com', 'c8d39cdb56a46ad807969ee04c4e660b', 'Kartik Choubey', 'users/download.png', 'users/Dev wallpaper 1.jpg', 0, 0, 'BCA Student | Freelancer', 'India', 'www.kartik.com'),
(3, 'naman1999', 'naman@gmail.com', '98c8bc837481b93acfb0deef65e50127', 'Naman Jain', 'users/avtar2.jpg', 'users/Dev wallpaper 2.jpg', 0, 2, 'UI/UX Designer | Website Designer', 'India', 'www.naman.com'),
(4, 'nikhil01', 'nikhil@gmail.com', '350d89c1cd6592bbbd1ed2e8a4f3ddba', 'Nikhil Yadav', 'users/avtar.png', 'users/code.jpg', 2, 1, 'Software Developer | Freelancer', 'India', 'www.nikhil.com'),
(5, 'yashgaur908', 'yash@gmail.com', 'e76eb8a75988cb07c8428733a5dd4684', 'Yash Gaur', 'users/avtar1.jpg', 'users/Dev wallpaper.jpg', 2, 1, 'Software Developer | Website Designer', 'India', 'www.yashgaur.tk');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`commentID`);

--
-- Indexes for table `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`followID`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`likeID`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`messageID`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `trends`
--
ALTER TABLE `trends`
  ADD PRIMARY KEY (`trendID`),
  ADD UNIQUE KEY `createdOn` (`createdOn`);

--
-- Indexes for table `tweets`
--
ALTER TABLE `tweets`
  ADD PRIMARY KEY (`tweetID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `commentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `follow`
--
ALTER TABLE `follow`
  MODIFY `followID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `likeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `messageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `trends`
--
ALTER TABLE `trends`
  MODIFY `trendID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tweets`
--
ALTER TABLE `tweets`
  MODIFY `tweetID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

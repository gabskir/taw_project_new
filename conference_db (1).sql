-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2024 at 03:40 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `conference_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `track_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `authors` varchar(250) NOT NULL,
  `description` varchar(2000) DEFAULT NULL,
  `pdf_link` varchar(255) DEFAULT NULL,
  `likes` int(11) DEFAULT 0,
  `image_url` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `track_id`, `title`, `authors`, `description`, `pdf_link`, `likes`, `image_url`) VALUES
(3, 1, 'Introduction to Supervised Learning', 'John Doe, Jane Smith', 'A beginner\'s guide to supervised learning, covering basic concepts, algorithms, and applications.', 'http://example.com/article1.pdf', 150, 'https://media.istockphoto.com/id/1949501832/photo/handsome-hispanic-senior-business-man-with-crossed-arms-smiling-at-camera-indian-or-latin.webp?b=1&s=170667a&w=0&k=20&c=c2lO2KWbZieFfGeu8bcjRDyxAnnGufFDDixQ0mh7kcw='),
(4, 2, 'Reinforcement Learning in Robotics', 'Alice Johnson, Bob Brown', 'Exploring the use of reinforcement learning techniques in the field of robotics.', 'http://example.com/article2.pdf', 200, 'https://t3.ftcdn.net/jpg/05/92/54/68/360_F_592546889_M2RqlnWKRolXO9UQEl59mHuwdz6XHojP.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `conference`
--

CREATE TABLE `conference` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `inviting_paragraph` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `conference`
--

INSERT INTO `conference` (`id`, `name`, `location`, `start_date`, `end_date`, `inviting_paragraph`) VALUES
(1, 'International Conference on Machine Learning', 'New York, USA', '2024-06-21', '2024-06-24', 'Join us for an exciting conference where leading experts in the field of machine learning gather to share their latest research and developments. Network with professionals, attend insightful sessions, and expand your knowledge!');

-- --------------------------------------------------------

--
-- Table structure for table `info_requests`
--

CREATE TABLE `info_requests` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `info_requests`
--

INSERT INTO `info_requests` (`id`, `user_id`, `name`, `email`, `message`) VALUES
(1, 3, 'Jane Doe', 'jane.doe@example.com', 'Can you provide more details about the conference schedule?');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `id` int(11) NOT NULL,
  `conference_id` int(11) NOT NULL,
  `track_id` int(11) NOT NULL,
  `day` date NOT NULL,
  `time` time NOT NULL,
  `room` varchar(50) NOT NULL,
  `article_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tracks`
--

CREATE TABLE `tracks` (
  `id` int(11) NOT NULL,
  `conference_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tracks`
--

INSERT INTO `tracks` (`id`, `conference_id`, `name`, `description`) VALUES
(1, 1, 'Machine Learning', 'All about machine learning'),
(2, 1, 'Robotics', 'Innovations in robotics'),
(3, 1, 'Neural Networks', 'Deep dive into neural networks');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','trackadmin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', 'adminpasswordhash', 'admin'),
(2, 'trackadmin1', 'trackadminpasswordhash', 'trackadmin'),
(3, 'user1', 'userpasswordhash', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `vote` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `track_id` (`track_id`);

--
-- Indexes for table `conference`
--
ALTER TABLE `conference`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `info_requests`
--
ALTER TABLE `info_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article_id` (`article_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `conference_id` (`conference_id`),
  ADD KEY `track_id` (`track_id`),
  ADD KEY `article_id` (`article_id`);

--
-- Indexes for table `tracks`
--
ALTER TABLE `tracks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `conference_id` (`conference_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article_id` (`article_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `conference`
--
ALTER TABLE `conference`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `info_requests`
--
ALTER TABLE `info_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tracks`
--
ALTER TABLE `tracks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`track_id`) REFERENCES `tracks` (`id`);

--
-- Constraints for table `info_requests`
--
ALTER TABLE `info_requests`
  ADD CONSTRAINT `info_requests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`),
  ADD CONSTRAINT `questions_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`conference_id`) REFERENCES `conference` (`id`),
  ADD CONSTRAINT `schedule_ibfk_2` FOREIGN KEY (`track_id`) REFERENCES `tracks` (`id`),
  ADD CONSTRAINT `schedule_ibfk_3` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`);

--
-- Constraints for table `tracks`
--
ALTER TABLE `tracks`
  ADD CONSTRAINT `tracks_ibfk_1` FOREIGN KEY (`conference_id`) REFERENCES `conference` (`id`);

--
-- Constraints for table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`),
  ADD CONSTRAINT `votes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

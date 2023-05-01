-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2023 at 12:38 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pdomoodsense`
--

-- --------------------------------------------------------

--
-- Table structure for table `moodsense_api`
--

CREATE TABLE `moodsense_api` (
  `api_key_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `api_key` varchar(255) NOT NULL,
  `is_valid` int(1) NOT NULL DEFAULT 1,
  `date_generated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `moodsense_api`
--

INSERT INTO `moodsense_api` (`api_key_id`, `users_id`, `api_key`, `is_valid`, `date_generated`) VALUES
(1, 14, '81edab9f-0735-4d1a-9b1f-7871713cbdbf', 1, '2023-02-20 20:37:54'),
(3, 23, '12345678', 1, '2023-03-23 11:16:11'),
(11, 33, '37672e5bc49cbd2e21f8bf8e2b06aa9f', 1, '2023-03-23 12:35:40'),
(12, 34, '4e22c6e358dffbec443250b7ff9f0799', 1, '2023-03-23 15:53:00'),
(13, 35, 'e7ef8285f60975764864531721cbb7c7', 1, '2023-03-23 22:38:36'),
(15, 37, '635612c9d0865477e5b89aa24be4952f', 1, '2023-03-23 22:43:06');

-- --------------------------------------------------------

--
-- Table structure for table `mood_log`
--

CREATE TABLE `mood_log` (
  `mood_log_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `mood_score` int(1) NOT NULL,
  `mood_desc` text NOT NULL,
  `date_posted` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mood_log`
--

INSERT INTO `mood_log` (`mood_log_id`, `users_id`, `mood_score`, `mood_desc`, `date_posted`) VALUES
(25, 14, 1, 'felt better', '2023-02-20 19:42:33'),
(27, 14, 6, 'I feel a good bit better but not fantastic.', '2023-02-20 19:42:33'),
(30, 23, 0, 'Hello, anne!', '2023-03-14 21:08:20'),
(33, 23, 5, 'I am feel', '2023-03-22 13:08:01'),
(48, 23, 10, 'Mood Log Test', '2023-03-22 16:47:41'),
(50, 23, 2, 'sadddd', '2023-03-23 22:07:02'),
(51, 23, 3, 'sadddddddd', '2023-03-23 22:07:02'),
(52, 23, 2, 'saddddddddddd', '2023-03-23 22:07:28'),
(53, 23, 2, 'sadddddddddddddddddd', '2023-03-23 22:07:28'),
(54, 23, 5, 'mehhhhh', '2023-03-23 22:07:49'),
(56, 37, 1, 'data', '2023-03-23 22:54:27'),
(57, 37, 4, 'mood', '2023-03-23 22:55:13'),
(58, 37, 3, '1234', '2023-03-23 22:57:20');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `session_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `created` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  `session_data` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`session_id`, `users_id`, `created`, `session_data`) VALUES
(1, 14, '2023-02-28 13:21:35.000000', '4go12l23dq73tgrdaekplnqfi7'),
(5, 33, '2023-03-23 13:53:10.000000', 'ibb7p2hnmt4h69m37u26blotfg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users_username` varchar(255) NOT NULL,
  `users_password` varchar(255) NOT NULL,
  `users_email` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_username`, `users_password`, `users_email`, `date_created`, `users_id`) VALUES
('conall@live.co.uk', '123456', '', '2023-02-20 19:42:05', 14),
('tony@moreno.co.uk', 'fattone', '', '2023-02-20 19:42:05', 15),
('postman_username', '$2y$10$fcL4GyjdFAjTN8m94jIjL.Ub7gK85LvxYin7JnECMxLYn5oD7SPKq', '', '2023-02-20 19:42:05', 16),
('xavier@lom.com', '$2y$10$puBHETj9HflOHnVly4i5JOkIV5LQfp.IxSzFROMbqoB724cuwx2W.', '', '2023-02-21 21:25:41', 17),
('HeCtoR@lim.com', '$2y$10$TAuqzaOeqbUD/L7LsNf1/uO5zot1P2WI1GhDGF0QyF/azSAuUFey.', '', '2023-02-21 21:43:24', 18),
('amca@gmail.com', '$2y$10$vCfcbVt1xQ/xnM/qMz8hhuNaGki29jv08rqI4XMcLUr/2A7Y1d.Fq', '', '2023-02-21 21:45:15', 19),
('anne', '$2y$10$AyQ7IJok/MqY6cgJVuYup.QnLRAgp/s5A7ghYAHbZlThSeSpXQ.QS', 'amca768@gmail.com', '2023-03-14 21:08:20', 23),
('conall', '$2y$10$EPvO1vARjMXbaukKAhzHyurWPj2GCQn/DCcryQqmFj7Y9uDP5AgK6', 'conall@conall.com', '2023-03-23 12:35:40', 33),
('conor', '$2y$10$79.P3fAdEc4V79gUyKJMTudWwm1/2OSMQu.k2ysJTCkdrWoRXgh9S', 'conor@conor.com', '2023-03-23 15:53:00', 34),
('user1', '$2y$10$sQ.9l/omM7PHXY5Hj7jz3OMNu5v/eB9wcBGryBzWlqRb4XzEA7Vkm', 'user@user.com', '2023-03-23 22:38:36', 35),
('1234', '$2y$10$OK3qe5gJANYZH8FGhkD0euXCYV.OrmWHf70Afp68ESUwLMdS0KxgS', '12345@gmail.com', '2023-03-23 22:43:06', 37);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `moodsense_api`
--
ALTER TABLE `moodsense_api`
  ADD PRIMARY KEY (`api_key_id`),
  ADD KEY `FK_moodsense_api_customer_id` (`users_id`);

--
-- Indexes for table `mood_log`
--
ALTER TABLE `mood_log`
  ADD PRIMARY KEY (`mood_log_id`),
  ADD KEY `FK_Customer_Customer_id` (`users_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD UNIQUE KEY `session_data` (`session_data`),
  ADD UNIQUE KEY `customer_id` (`users_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `moodsense_api`
--
ALTER TABLE `moodsense_api`
  MODIFY `api_key_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `mood_log`
--
ALTER TABLE `mood_log`
  MODIFY `mood_log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `session_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `moodsense_api`
--
ALTER TABLE `moodsense_api`
  ADD CONSTRAINT `FK_moodsense_api_customer_id` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`);

--
-- Constraints for table `mood_log`
--
ALTER TABLE `mood_log`
  ADD CONSTRAINT `FK_Customer_Customer_id` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`);

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `FK_sessions_customer_id` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

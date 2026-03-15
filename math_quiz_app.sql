-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2026 at 03:43 PM
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
-- Database: `math_quiz_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `login_history`
--

CREATE TABLE `login_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `login_time` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_history`
--

INSERT INTO `login_history` (`id`, `user_id`, `username`, `login_time`) VALUES
(2, 5, NULL, '2026-03-03 22:47:06'),
(3, 5, NULL, '2026-03-03 22:49:41'),
(4, 5, NULL, '2026-03-03 22:51:12'),
(5, 5, NULL, '2026-03-03 22:56:53'),
(6, 5, NULL, '2026-03-03 22:57:15'),
(7, 5, NULL, '2026-03-05 10:35:58'),
(8, 5, NULL, '2026-03-05 10:46:05'),
(9, 5, NULL, '2026-03-05 10:50:03'),
(10, 5, NULL, '2026-03-05 10:51:17'),
(11, 5, NULL, '2026-03-05 10:56:31'),
(12, 5, NULL, '2026-03-05 11:00:45'),
(13, 5, NULL, '2026-03-05 15:12:41'),
(14, 5, NULL, '2026-03-05 15:18:25'),
(15, 5, NULL, '2026-03-05 15:19:10'),
(16, 5, NULL, '2026-03-05 15:22:55'),
(17, 5, NULL, '2026-03-05 15:31:21'),
(18, 5, NULL, '2026-03-05 15:32:56'),
(19, 5, NULL, '2026-03-05 23:07:39'),
(20, 5, NULL, '2026-03-05 23:18:38'),
(21, 5, NULL, '2026-03-05 23:19:31'),
(22, 5, NULL, '2026-03-05 23:19:58'),
(23, 5, NULL, '2026-03-12 18:14:09'),
(24, 5, NULL, '2026-03-12 18:28:04'),
(25, 5, NULL, '2026-03-12 18:30:09'),
(26, 5, NULL, '2026-03-12 18:34:38'),
(27, 5, NULL, '2026-03-12 18:36:23'),
(28, 5, NULL, '2026-03-12 18:46:08'),
(29, 5, NULL, '2026-03-12 18:50:16'),
(30, 5, NULL, '2026-03-12 18:53:47'),
(31, 5, NULL, '2026-03-12 19:59:48'),
(32, 5, NULL, '2026-03-12 20:23:18'),
(33, 5, NULL, '2026-03-12 20:24:00'),
(34, 5, NULL, '2026-03-12 20:35:15'),
(35, 5, NULL, '2026-03-12 20:36:17'),
(36, 5, NULL, '2026-03-12 20:41:41'),
(37, 5, NULL, '2026-03-12 20:43:01'),
(38, 5, NULL, '2026-03-12 20:43:59'),
(39, 5, NULL, '2026-03-12 20:45:43'),
(40, 5, NULL, '2026-03-12 20:48:04'),
(41, 5, NULL, '2026-03-12 20:49:41'),
(42, 5, NULL, '2026-03-12 21:15:23'),
(43, 5, NULL, '2026-03-12 21:36:37'),
(44, 5, NULL, '2026-03-12 21:45:51'),
(45, 5, NULL, '2026-03-12 21:51:07'),
(46, 5, NULL, '2026-03-12 21:51:41'),
(47, 6, NULL, '2026-03-12 22:06:27'),
(48, 5, NULL, '2026-03-12 22:40:44');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_history`
--

CREATE TABLE `quiz_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `accuracy` decimal(5,2) NOT NULL,
  `played_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_history`
--

INSERT INTO `quiz_history` (`id`, `user_id`, `score`, `accuracy`, `played_at`) VALUES
(1, 5, 7, 70.00, '2026-03-12 20:36:09'),
(2, 5, 1, 10.00, '2026-03-12 20:48:31'),
(3, 5, 2, 20.00, '2026-03-12 21:40:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(64) NOT NULL,
  `high_score` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password_hash`, `high_score`, `created_at`) VALUES
(5, 'Shan', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 80, '2026-02-23 12:07:07'),
(6, 'sasa', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 0, '2026-02-26 07:07:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login_history`
--
ALTER TABLE `login_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_history`
--
ALTER TABLE `quiz_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login_history`
--
ALTER TABLE `login_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `quiz_history`
--
ALTER TABLE `quiz_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `quiz_history`
--
ALTER TABLE `quiz_history`
  ADD CONSTRAINT `quiz_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

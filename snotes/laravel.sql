-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2017 at 10:05 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `backgrounds`
--

CREATE TABLE `backgrounds` (
  `id` int(11) NOT NULL,
  `background` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `backgrounds`
--

INSERT INTO `backgrounds` (`id`, `background`) VALUES
(1, '#ecf0f1'),
(2, '#bdc3c7'),
(3, '#95a5a6'),
(4, '#7f8c8d'),
(5, '#f1c40f'),
(6, '#f39c12'),
(7, '#e67e22'),
(8, '#d35400'),
(9, '#e74c3c'),
(10, '#c0392b'),
(11, '#1abc9c'),
(12, '#16a085'),
(13, '#2ecc71'),
(14, '#27ae60'),
(15, '#3498db'),
(16, '#2980b9'),
(17, '#9b59b6'),
(18, '#8e44ad'),
(19, '#34495e'),
(20, '#2c3e50'),
(21, '#FFF2B5');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `title` varchar(1000) DEFAULT NULL,
  `content` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) DEFAULT NULL,
  `background_id` int(11) DEFAULT '1',
  `num_order` int(11) DEFAULT '0',
  `_token` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `title`, `content`, `created_at`, `updated_at`, `user_id`, `background_id`, `num_order`, `_token`) VALUES
(32, 'Xã hội', NULL, '2017-10-26 02:50:22', '2017-10-26 02:50:22', 1, 1, 0, NULL),
(33, 'Pháp luật', NULL, '2017-10-26 02:50:42', '2017-10-26 02:50:42', 1, 1, 0, NULL),
(34, 'Sức khỏe', NULL, '2017-10-26 02:51:10', '2017-10-26 02:51:10', 1, 1, 0, NULL),
(36, 'Giải trí', NULL, '2017-10-26 02:52:15', '2017-10-26 02:52:15', 1, 1, 0, NULL),
(38, 'Báo mới', NULL, '2017-10-26 02:56:28', '2017-10-26 02:56:28', 1, 1, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `title` varchar(1000) DEFAULT NULL,
  `content` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) DEFAULT NULL,
  `background_id` int(11) DEFAULT '1',
  `num_order` int(11) DEFAULT '0',
  `important` tinyint(4) DEFAULT '0',
  `trash` tinyint(4) DEFAULT '0',
  `_token` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `title`, `content`, `created_at`, `updated_at`, `user_id`, `background_id`, `num_order`, `important`, `trash`, `_token`) VALUES
(77, '123123', '123', '2017-10-31 09:04:37', '2017-10-31 09:05:35', 1, 21, 0, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `relationships`
--

CREATE TABLE `relationships` (
  `id` int(11) NOT NULL,
  `note_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `relationships`
--

INSERT INTO `relationships` (`id`, `note_id`, `group_id`, `user_id`) VALUES
(299, 77, 38, 1),
(300, 77, 36, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `email` varchar(500) DEFAULT NULL,
  `display_name` varchar(500) DEFAULT NULL,
  `thumbnail` varchar(500) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(4) DEFAULT '0',
  `num_order` int(11) DEFAULT '0',
  `trash` tinyint(4) DEFAULT '0',
  `_token` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `display_name`, `thumbnail`, `created_at`, `updated_at`, `status`, `num_order`, `trash`, `_token`) VALUES
(1, 'wpadmin', 'f1887d3f9e6ee7a32fe5e76f4ab80d63', NULL, 'Si', NULL, '2017-10-19 05:38:11', '2017-10-20 06:26:05', 1, 0, 0, ''),
(2, 'ninhgia', '90b64fb044612b389b859fd906470f67', NULL, 'Ninh', NULL, '2017-10-20 06:09:09', '2017-10-20 06:26:01', 1, 0, 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `backgrounds`
--
ALTER TABLE `backgrounds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `relationships`
--
ALTER TABLE `relationships`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `backgrounds`
--
ALTER TABLE `backgrounds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
--
-- AUTO_INCREMENT for table `relationships`
--
ALTER TABLE `relationships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=301;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

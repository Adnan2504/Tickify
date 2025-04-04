-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 04, 2025 at 10:34 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tickify`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `message_text` text NOT NULL,
  `attachment_path` varchar(255) DEFAULT NULL,
  `sent_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_internal` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `ticket_id`, `sender_id`, `message_text`, `attachment_path`, `sent_at`, `is_internal`) VALUES
(7, 1, 1, 'dwadwadwa', '67aa5d66a255d_IMG_6744.HEIC', '2025-02-10 20:11:19', 0),
(8, 3, 1, 'Test3', NULL, '2025-02-10 20:12:53', 0),
(9, 1, 1, 'test', 'images/1/67aa5fa972d17_istockphoto-1160791767-612x612.jpg', '2025-02-10 20:20:57', 0),
(10, 1, 1, 'test', NULL, '2025-02-10 20:38:38', 0),
(11, 4, 1, 'Test Image', 'images/1/67bef2316a112_board-361516_1280.webp', '2025-02-26 10:51:29', 0),
(12, 4, 1, 'Test Image', 'images/1/67bef2574a9df_board-361516_1280.webp', '2025-02-26 10:52:07', 0),
(13, 4, 1, 'more testing', 'images/1/67c02da528d9c_board-361516_1280.webp', '2025-02-27 09:17:25', 0),
(14, 4, 1, 'Test', NULL, '2025-02-27 09:17:31', 0),
(15, 4, 1, 'Test by Admin', NULL, '2025-02-27 09:17:37', 0),
(16, 7, 1, 'dwadwadwa', 'images/1/67c5a196566a6_board-361516_1280.webp', '2025-03-03 12:33:26', 0),
(17, 3, 1, 'test', 'images/1/67c5c561168fe_board-361516_1280.webp', '2025-03-03 15:06:09', 0),
(18, 5, 1, 'Hello', 'images/1/67c6ac678ae85_board-361516_1280.webp', '2025-03-04 07:31:51', 0);

-- --------------------------------------------------------

--
-- Table structure for table `support_tickets`
--

CREATE TABLE `support_tickets` (
  `id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `priority` enum('low','mid','high') NOT NULL,
  `attachment_path` varchar(255) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('open','resolved','waiting') NOT NULL DEFAULT 'open'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `support_tickets`
--

INSERT INTO `support_tickets` (`id`, `subject`, `description`, `priority`, `attachment_path`, `category`, `created_by`, `created_at`, `status`) VALUES
(1, 'Test Ticket Subject', 'This is a test description for the support ticket.', 'mid', '/path/to/test-image.png', 'General Inquiry', 1, '2025-02-06 08:47:20', 'resolved'),
(3, 'test123', 'test123', 'high', NULL, 'test123', 1, '2025-02-06 09:22:11', 'resolved'),
(4, 'Test ticket by adnan', 'some random text', 'low', NULL, 'test', 1, '2025-02-11 10:12:10', 'open'),
(5, 'test', 'test', 'low', NULL, 'test', 2, '2025-02-13 10:38:19', 'open'),
(6, 'test_file', 'file', 'high', NULL, 'file', 2, '2025-02-13 10:41:19', 'open'),
(7, 'Test by admin', 'Admin testing :D', 'high', NULL, 'Random Category', 1, '2025-02-27 09:10:22', 'open'),
(8, 'Subject of ticket', 'random ticket', 'mid', NULL, 'test', 1, '2025-02-28 07:51:31', 'open'),
(9, 'Test', 'test', 'high', NULL, 'test iwas', 1, '2025-03-03 12:32:16', 'open');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL COMMENT 'auto incrementing user_id of each user, unique index',
  `session_id` varchar(48) DEFAULT NULL COMMENT 'stores session cookie id to prevent session concurrency',
  `user_name` varchar(64) NOT NULL COMMENT 'user''s name, unique',
  `user_password_hash` varchar(255) DEFAULT NULL COMMENT 'user''s password in salted and hashed format',
  `user_email` varchar(254) NOT NULL COMMENT 'user''s email, unique',
  `user_active` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'user''s activation status',
  `user_deleted` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'user''s deletion status',
  `user_account_type` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'user''s account type (basic, premium, etc)',
  `user_has_avatar` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1 if user has a local avatar, 0 if not',
  `user_remember_me_token` varchar(64) DEFAULT NULL COMMENT 'user''s remember-me cookie token',
  `user_creation_timestamp` bigint(20) DEFAULT NULL COMMENT 'timestamp of the creation of user''s account',
  `user_suspension_timestamp` bigint(20) DEFAULT NULL COMMENT 'Timestamp till the end of a user suspension',
  `user_last_login_timestamp` bigint(20) DEFAULT NULL COMMENT 'timestamp of user''s last login',
  `user_failed_logins` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'user''s failed login attempts',
  `user_last_failed_login` int(10) DEFAULT NULL COMMENT 'unix timestamp of last failed login attempt',
  `user_activation_hash` varchar(80) DEFAULT NULL COMMENT 'user''s email verification hash string',
  `user_password_reset_hash` char(80) DEFAULT NULL COMMENT 'user''s password reset code',
  `user_password_reset_timestamp` bigint(20) DEFAULT NULL COMMENT 'timestamp of the password reset request',
  `user_provider_type` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `session_id`, `user_name`, `user_password_hash`, `user_email`, `user_active`, `user_deleted`, `user_account_type`, `user_has_avatar`, `user_remember_me_token`, `user_creation_timestamp`, `user_suspension_timestamp`, `user_last_login_timestamp`, `user_failed_logins`, `user_last_failed_login`, `user_activation_hash`, `user_password_reset_hash`, `user_password_reset_timestamp`, `user_provider_type`) VALUES
(1, '481ru06i034glo3ofaple9t808', 'demo', '$2y$10$OvprunjvKOOhM1h9bzMPs.vuwGIsOqZbw88rzSyGCTJTcE61g5WXi', 'demo@demo.com', 1, 0, 7, 1, NULL, 1422205178, NULL, 1741073433, 0, NULL, NULL, NULL, NULL, 'DEFAULT'),
(2, NULL, 'demo2', '$2y$10$OvprunjvKOOhM1h9bzMPs.vuwGIsOqZbw88rzSyGCTJTcE61g5WXi', 'demo2@demo.com', 1, 0, 1, 0, NULL, 1422205178, NULL, 1739443354, 0, NULL, NULL, NULL, NULL, 'DEFAULT'),
(3, NULL, 'adnan', '$2y$10$xBjWm9OnIwh1pCoAtv2iYePNgtTBHAC2sbaCFH6UkoB8jyb6bK0/y', 'adnan2@gmail.com', 0, 0, 1, 0, NULL, 1739444047, NULL, NULL, 0, NULL, 'f079e2bd26575d5fdaa2d318040c62603488d5b2a956165813b73500196b69d728a3cf78eb60cc58', NULL, NULL, 'DEFAULT'),
(4, NULL, 'random', '$2y$10$UtW4jYeFrPpeKFFZWQs6rObgRcM7PmRoxlZF/riTYJM2dmTvw9QwO', 'random@gmail.com', 1, 0, 1, 0, NULL, 1739444430, NULL, NULL, 0, NULL, '2a2ee57fb6b760e49665ba4e42bc2d062884b6eb366946892f82bf10c41409c49d6c6ce97e0fb2bb', NULL, NULL, 'DEFAULT'),
(5, NULL, 'random2', '$2y$10$iSbj6SsG6DJdds11i69y9.HcNt1yYmDROB.MHPasweLYOAWDlHAc6', 'random2@gmail.com', 1, 0, 1, 0, NULL, 1739444489, NULL, NULL, 0, NULL, '7996bde20ec7fb21e6d04546db6c734879f643ff56c9c7d8feaf1d8d80d97c664aa26d1680c3bc00', NULL, NULL, 'DEFAULT'),
(6, NULL, 'finishtest', '$2y$10$2inOlK8F9bkTA5H7.Hw2GeYCvbb2Z9xV5BKc5Js8I/dm82qaKgcWy', 'random321@gmail.com', 1, 0, 1, 0, NULL, 1739444553, NULL, NULL, 0, NULL, '407a6aca61a47003291048ed25914fd17ace0dba9e518d578ec27483f9a32aad52fbb49637c4560a', NULL, NULL, 'DEFAULT');

-- --------------------------------------------------------

--
-- Table structure for table `user_groups_long`
--

CREATE TABLE `user_groups_long` (
  `id` int(11) NOT NULL,
  `account_type` int(11) NOT NULL,
  `lang` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_groups_long`
--

INSERT INTO `user_groups_long` (`id`, `account_type`, `lang`) VALUES
(1, 1, 'Guest'),
(2, 2, 'User'),
(3, 7, 'Admin'),
(4, 5, 'Moderator');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `ticket_id` (`ticket_id`),
  ADD KEY `sender_id` (`sender_id`);

--
-- Indexes for table `support_tickets`
--
ALTER TABLE `support_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- Indexes for table `user_groups_long`
--
ALTER TABLE `user_groups_long`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `support_tickets`
--
ALTER TABLE `support_tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing user_id of each user, unique index', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_groups_long`
--
ALTER TABLE `user_groups_long`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`ticket_id`) REFERENCES `support_tickets` (`id`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`sender_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

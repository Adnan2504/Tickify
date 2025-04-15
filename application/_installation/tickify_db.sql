-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 15, 2025 at 08:51 AM
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
(8, 3, 1, 'Test3', NULL, '2025-02-10 20:12:53', 0),
(11, 4, 1, 'Test Image', 'images/1/67bef2316a112_board-361516_1280.webp', '2025-02-26 10:51:29', 0),
(12, 4, 1, 'Test Image', 'images/1/67bef2574a9df_board-361516_1280.webp', '2025-02-26 10:52:07', 0),
(13, 4, 1, 'more testing', 'images/1/67c02da528d9c_board-361516_1280.webp', '2025-02-27 09:17:25', 0),
(14, 4, 1, 'Test', NULL, '2025-02-27 09:17:31', 0),
(15, 4, 1, 'Test by Admin', NULL, '2025-02-27 09:17:37', 0),
(17, 3, 1, 'test', 'images/1/67c5c561168fe_board-361516_1280.webp', '2025-03-03 15:06:09', 0),
(18, 5, 1, 'Hello', 'images/1/67c6ac678ae85_board-361516_1280.webp', '2025-03-04 07:31:51', 0),
(20, 5, 1, 'test', NULL, '2025-03-18 11:05:30', 0),
(21, 5, 1, 'test', NULL, '2025-03-18 11:08:20', 0),
(22, 5, 1, 'more tesing', NULL, '2025-03-18 11:08:24', 0),
(23, 5, 1, 'a', NULL, '2025-03-18 11:10:01', 0),
(24, 5, 1, 'a', NULL, '2025-03-18 11:10:03', 0),
(25, 5, 1, 'a', NULL, '2025-03-18 11:10:05', 0),
(26, 5, 1, 'a', NULL, '2025-03-18 11:10:06', 0),
(33, 5, 1, '213', NULL, '2025-03-27 06:49:18', 0),
(34, 5, 1, 'Test', NULL, '2025-03-27 06:49:21', 0),
(35, 5, 1, 'horse', 'images/1/67e4f4fc30490_123.png.jpg', '2025-03-27 06:49:32', 0),
(66, 27, 14, 'My screen is black', NULL, '2025-04-04 06:07:08', 0),
(67, 27, 14, 'My screen is black this is image of it', 'images/14/67ef771f68c3a_download.jpg', '2025-04-04 06:07:27', 0),
(68, 27, 14, '321', 'images/14/67ef775423fcf_download.jpg', '2025-04-04 06:08:20', 0);

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
(3, 'test123', 'test123', 'high', NULL, 'test', 1, '2025-02-06 09:22:11', 'resolved'),
(4, 'Test ticket by adnan', 'some random text', 'low', NULL, 'test123', 1, '2025-02-11 10:12:10', 'resolved'),
(5, 'test', 'test', 'low', NULL, 'test', 2, '2025-02-13 10:38:19', 'open'),
(6, 'test_file', 'file', 'high', NULL, 'test', 2, '2025-02-13 10:41:19', 'open'),
(8, 'Subject of ticket', 'random ticket', 'low', NULL, 'Support', 1, '2025-02-28 07:51:31', 'open'),
(14, 'Ordering test', 'Ordering test', 'low', NULL, 'Improvement', 1, '2025-03-27 07:01:02', 'open'),
(15, 'oder 15', 'oder 15', 'low', NULL, 'Bug', 1, '2025-03-27 07:01:22', 'open'),
(16, 'Adnan', 'ad', 'low', NULL, 'Bug', 1, '2025-03-27 07:59:52', 'open'),
(26, '1', '1', 'low', NULL, 'Bug', 14, '2025-04-04 04:58:13', 'open'),
(27, 'My screen is black i need it until tomorrow', 'My screen is black', 'low', NULL, 'Support', 14, '2025-04-04 06:06:56', 'open');

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
(1, 'i4l0pagj6sbegjkuusibio5a1i', 'Admin', '$2y$10$OvprunjvKOOhM1h9bzMPs.vuwGIsOqZbw88rzSyGCTJTcE61g5WXi', 'adnanbajric74@gmail.com', 1, 0, 7, 1, NULL, 1422205178, NULL, 1743747711, 0, NULL, NULL, '7a36dbf81316e553f77a34798a4dfdd316c307ead9304df2b512cd7b0ff47a4b3ab2a598c749e11d', 1741330374, 'DEFAULT'),
(2, NULL, 'demo2', '$2y$10$OvprunjvKOOhM1h9bzMPs.vuwGIsOqZbw88rzSyGCTJTcE61g5WXi', 'demo2@demo.at', 1, 0, 5, 0, NULL, 1422205178, NULL, 1739443354, 0, NULL, NULL, NULL, NULL, 'DEFAULT'),
(14, NULL, 'adnan_2504', '$2y$10$PLUmoAlkY/vDqzwC6WomWO69jzh/sNkR.7Xn2EBG2XxJpXOneHNde', 'adnanbajric@gmail.com', 1, 0, 7, 1, NULL, 1742542505, NULL, 1743746745, 0, NULL, 'f1e909d280ec248c2ac71b245881718ac37bdf844f1c06290ecbcc373c904dd99aa14dffa51074be', NULL, NULL, 'DEFAULT'),
(19, NULL, 'livedemo', '$2y$10$YSjH7.kutw.GgA330hB.3ecSHe7hoqdwbiCp7p2GgsAl4mfiJMRQC', 'livedemo@gmail.com', 1, 0, 1, 0, NULL, 1743746730, NULL, NULL, 3, 1743746743, 'a0bd72d0cd176e4d7a15f5014f5c822585649605681fa6ee88c8485c7eab9c4708ece1bbf3e37f79', NULL, NULL, 'DEFAULT'),
(20, NULL, 'adnan123', '$2y$10$Eg8fb64q.Iq9H3rPn2TmqesLT.3b2y9pgC6PCDoFvfoL0aI4t4qba', 'adnan123321321@gmail.com', 1, 0, 1, 0, NULL, 1743747602, NULL, 1743747613, 0, NULL, 'cea2b749010b2090837a01542f60404b6bf78656eaa2227c40235114576149e62fd66a0a051f4c3d', NULL, NULL, 'DEFAULT');

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
(1, 1, 'User'),
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
  ADD KEY `messages_ibfk_1` (`ticket_id`),
  ADD KEY `messages_ibfk_2` (`sender_id`);

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
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `support_tickets`
--
ALTER TABLE `support_tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing user_id of each user, unique index', AUTO_INCREMENT=21;

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
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`ticket_id`) REFERENCES `support_tickets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`sender_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

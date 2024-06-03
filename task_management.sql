-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Jun 03, 2024 at 04:25 AM
-- Server version: 8.0.37
-- PHP Version: 8.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `task_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `created_by` int DEFAULT NULL,
  `pm_id` int DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT '0',
  `created_ip` varchar(45) DEFAULT NULL,
  `modified_ip` varchar(45) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `description`, `created_by`, `pm_id`, `is_deleted`, `created_ip`, `modified_ip`, `created_date`, `modified_date`) VALUES
(1, 'Test Project', 'Test Project Description', 2, NULL, 0, NULL, NULL, '2024-06-02 22:04:57', '2024-06-02 22:04:57'),
(2, 'Test Project', 'Test Project Description', 2, NULL, 0, NULL, NULL, '2024-06-02 22:05:01', '2024-06-02 22:05:01');

-- --------------------------------------------------------

--
-- Table structure for table `project_members`
--

CREATE TABLE `project_members` (
  `project_id` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int NOT NULL,
  `project_id` int DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `assigned_to` int DEFAULT NULL,
  `status` enum('pending','in_progress','completed') DEFAULT 'pending',
  `is_deleted` tinyint(1) DEFAULT '0',
  `created_ip` varchar(45) DEFAULT NULL,
  `modified_ip` varchar(45) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `priority` enum('low','medium','high') DEFAULT 'medium'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `task_notes`
--

CREATE TABLE `task_notes` (
  `id` int NOT NULL,
  `task_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `note` text NOT NULL,
  `photo_filenames` text,
  `created_ip` varchar(45) DEFAULT NULL,
  `modified_ip` varchar(45) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','pm','member') NOT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `created_ip` varchar(45) DEFAULT NULL,
  `modified_ip` varchar(45) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `profile_photo` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `is_active`, `created_ip`, `modified_ip`, `created_date`, `modified_date`, `first_name`, `last_name`, `profile_photo`) VALUES
(2, 'test_pm1', '$2y$10$EDsVNte49LQlgjkY99FUoOJu2qJSiZfV/aVUdZMakhFumgVO96kv.', 'pm', 1, '192.168.65.1', NULL, '2024-06-02 17:37:40', '2024-06-02 17:37:40', 'Test', 'PM', ''),
(3, 'test_user1', '$2y$10$zqaUxx3R0d.I.F1MZ9J0x./lpRDR51miav9WnotHHNiHa4Qq2oJbC', 'member', 1, '192.168.65.1', NULL, '2024-06-02 17:38:41', '2024-06-02 17:38:41', 'Test', 'PM', ''),
(4, 'test_member1', '$2y$10$RfCb0yUsGos.rU85Q3Q1oO3LXoTalgLWg72VQ9yeKtF/i3J08ulyS', 'member', 1, '192.168.65.1', NULL, '2024-06-02 17:40:39', '2024-06-02 17:40:39', 'Test', 'Member', ''),
(5, 'fdc.beethoven', '$2y$10$uBV5a3aPdW7f/lT2yvEJhe7/Jusod32cHF.bm73onhw91Nyr4EUHO', 'member', 1, '192.168.65.1', NULL, '2024-06-02 20:47:27', '2024-06-02 20:47:27', 'Beethoven', 'Etol', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `profile_photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `pm_id` (`pm_id`);

--
-- Indexes for table `project_members`
--
ALTER TABLE `project_members`
  ADD PRIMARY KEY (`project_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `assigned_to` (`assigned_to`);

--
-- Indexes for table `task_notes`
--
ALTER TABLE `task_notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_id` (`task_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `task_notes`
--
ALTER TABLE `task_notes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `projects_ibfk_2` FOREIGN KEY (`pm_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `project_members`
--
ALTER TABLE `project_members`
  ADD CONSTRAINT `project_members_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`),
  ADD CONSTRAINT `project_members_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`),
  ADD CONSTRAINT `tasks_ibfk_2` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`);

--
-- Constraints for table `task_notes`
--
ALTER TABLE `task_notes`
  ADD CONSTRAINT `task_notes_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`),
  ADD CONSTRAINT `task_notes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `user_details_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

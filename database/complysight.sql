-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2024 at 12:19 PM
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
-- Database: `complysight`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `controls`
--

CREATE TABLE `controls` (
  `id` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `section_id` char(36) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `controls`
--

INSERT INTO `controls` (`id`, `name`, `section_id`, `created_at`, `updated_at`) VALUES
('2cbcf278-39d3-4a69-9fa6-9c1354c57c86', 'Information Audit', '6054e348-babe-4bb8-859c-a59f080ced32', '2024-03-26 04:04:53', '2024-03-27 05:35:26'),
('593176dc-67a9-4137-a124-d129d9473a5f', 'Ongoing Consent Management', '96920581-c063-4bf1-bbaa-f886f1bbf285', '2024-03-25 05:59:20', '2024-03-25 05:59:20'),
('5deb473e-96cd-4eb8-b3d5-30c1f7433fd2', 'Data Protection Training and Awareness Review', 'acbb59eb-b784-4d31-9611-565931c618b0', '2024-03-25 18:24:49', '2024-03-25 18:36:14'),
('a456e983-5039-4529-b746-4c5b8ecf5a83', 'Lawful Basis Identification and Documentation', '96920581-c063-4bf1-bbaa-f886f1bbf285', '2024-03-25 05:58:01', '2024-03-25 05:58:01'),
('c26aa4c4-c3c1-48f4-b209-1b2fd33a6e0e', 'Vital Interest', '96920581-c063-4bf1-bbaa-f886f1bbf285', '2024-03-25 06:03:54', '2024-03-25 18:36:30'),
('d442b626-512d-466e-aa80-9abeeda0456d', 'necessitatibus', 'fd280509-f56d-4554-8b09-ddf8f05f4bcb', '2024-03-20 11:54:00', '2024-03-20 11:54:00'),
('e5aea5c6-f609-49ad-b29b-87e8e63b7847', 'Consent Review', '96920581-c063-4bf1-bbaa-f886f1bbf285', '2024-03-25 05:59:03', '2024-03-25 05:59:03'),
('fcc652b2-e624-4f4f-850f-8e51ecb1d8f6', 'Documentation of Personal Data', '6054e348-babe-4bb8-859c-a59f080ced32', '2024-03-25 05:47:06', '2024-03-25 05:47:06');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `information`
--

CREATE TABLE `information` (
  `id` char(36) NOT NULL,
  `content` text NOT NULL,
  `question_id` char(36) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `information`
--

INSERT INTO `information` (`id`, `content`, `question_id`, `created_at`, `updated_at`) VALUES
('b59e886c-b748-4622-b5cd-23b42173c751', 'Conducting an information audit helps organizations understand the types of personal data they collect, process, and share, which is essential for Data Protection  compliance. Failure to conduct an audit may result in incomplete or inaccurate knowledge of data flows, leading to compliance gaps.', '1ed9c4a3-cfa3-4cf2-8cbc-2e1e70340c51', '2024-03-26 12:57:28', '2024-03-27 08:09:48'),
('f59de7a3-7c7d-46c3-a874-a424a3823d49', 'Documenting personal data inventory, including its origin, processing activities, and sharing practices, is crucial for Data Protection  compliance and accountability. Without accurate documentation, organizations may struggle to demonstrate compliance or respond effectively to data subject requests.', '6ef07ddb-9807-4305-9b21-89c9a503efe5', '2024-03-27 08:10:12', '2024-03-27 08:10:12');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(85, '0001_01_01_000000_create_users_table', 1),
(86, '0001_01_01_000001_create_cache_table', 1),
(87, '0001_01_01_000002_create_jobs_table', 1),
(88, '2024_03_19_201429_create_sections_table', 1),
(89, '2024_03_19_201455_create_controls_table', 1),
(90, '2024_03_19_201512_create_questions_table', 1),
(91, '2024_03_19_201523_create_information_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` char(36) NOT NULL,
  `text` text NOT NULL,
  `control_id` char(36) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `text`, `control_id`, `created_at`, `updated_at`) VALUES
('1ed9c4a3-cfa3-4cf2-8cbc-2e1e70340c51', 'Has your business conducted an information audit to map data flows?', '2cbcf278-39d3-4a69-9fa6-9c1354c57c86', '2024-03-26 12:53:26', '2024-03-26 12:53:26'),
('6ef07ddb-9807-4305-9b21-89c9a503efe5', 'Has your business documented what personal data you hold, where it came from, who you share it with, and what you do with it?', 'fcc652b2-e624-4f4f-850f-8e51ecb1d8f6', '2024-03-26 04:47:38', '2024-03-26 04:47:38'),
('88c07549-7082-44b6-a071-a90e6bc1c91c', 'Does your business have systems to record and manage ongoing consent?', '593176dc-67a9-4137-a124-d129d9473a5f', '2024-03-26 11:19:19', '2024-03-26 11:19:19'),
('a6672da1-ac37-48ea-a46c-18742b03164d', 'Has your business identified your lawful bases for processing personal data and documented these?', 'a456e983-5039-4529-b746-4c5b8ecf5a83', '2024-03-26 16:17:57', '2024-03-26 16:17:57'),
('c95e23ee-7938-4b8e-8ad3-25b9f86a9add', 'Has your business reviewed how you ask for and record consent?', 'c26aa4c4-c3c1-48f4-b209-1b2fd33a6e0e', '2024-03-26 16:31:35', '2024-03-27 07:59:05'),
('d2e6f83f-4f5d-4fd8-ae0e-f3e4d8399b07', 'If your business may be required to process data to protect the vital interests of an individual, have you clearly documented the circumstances where it will be relevant?', 'c26aa4c4-c3c1-48f4-b209-1b2fd33a6e0e', '2024-03-26 12:54:11', '2024-03-26 12:54:11'),
('e50d2b36-d41f-404f-812f-a48c087f00ef', 'Has your business reviewed how you ask for and record consent?', 'e5aea5c6-f609-49ad-b29b-87e8e63b7847', '2024-03-26 11:18:58', '2024-03-26 11:18:58');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `name`, `created_at`, `updated_at`) VALUES
('0047f226-f163-4b1d-bd77-93cd9eb21506', 'Vendors and Processors', '2024-03-21 08:28:57', '2024-03-21 08:28:57'),
('2fecb5f1-80bc-4a70-9288-8b161b9e66fe', 'Data Privacy Risks Management 4', '2024-03-21 08:29:08', '2024-03-27 05:32:11'),
('6054e348-babe-4bb8-859c-a59f080ced32', 'Data Management', '2024-03-21 08:24:44', '2024-03-21 08:24:44'),
('96920581-c063-4bf1-bbaa-f886f1bbf285', 'Legal Basis for Processing Data', '2024-03-21 08:25:38', '2024-03-25 17:33:10'),
('acbb59eb-b784-4d31-9611-565931c618b0', 'Employee Training and Awareness', '2024-03-25 18:23:03', '2024-03-25 18:23:03'),
('db5cff49-cd44-4488-96b4-dafe661846d8', 'Accountability', '2024-03-21 08:28:33', '2024-03-21 08:28:33'),
('e42fd095-36f0-46c5-b9d1-bd9dc787446f', 'Registration', '2024-03-21 08:27:36', '2024-03-25 17:32:53'),
('e5379413-9479-4963-9527-9373af74c306', 'Data Subject Rights', '2024-03-21 08:27:49', '2024-03-21 08:27:49'),
('eab0bbce-ecf1-4b6b-a242-24e198907eb6', 'consequntial', '2024-03-20 11:53:59', '2024-03-25 17:33:43'),
('f2861dab-76c0-4aa4-8704-98d987d0e456', 'authority', '2024-03-20 11:53:59', '2024-03-25 17:33:25');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('ja7Ncp9HAi4ESrQBzf5d32GSipngYf2Vim9kn2Wm', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiek5iUWZZcDROdFJ6WlltSmZRYWRZaTBzcGhNaEo4N3B4YUlBZjFVSSI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MjtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozMzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2luZm9ybWF0aW9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1711537914);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Test User', 'test@example.com', '2024-03-20 11:53:59', '$2y$12$D5unWVOyy.8NAbm8lPy8c./i8XtCSYlsOuYdBZwwBw3hIsrxwIrj2', 'EE39TngIF3', '2024-03-20 11:53:59', '2024-03-20 11:53:59'),
(2, 'Moses Asiago', 'asiago.mo@gmail.com', NULL, '$2y$12$ZHtRa.k2WA82JWskMx4UmOBtrX.ZQxuFWfiHOgBRpjVbjbwJ5xAh6', 'xwhA3MoXULAVv7ftvtln5kFm5CcqdOrVEe68say5mq7ag7l1f0aawKLBXlG7', '2024-03-20 15:04:41', '2024-03-20 15:04:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `controls`
--
ALTER TABLE `controls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `controls_section_id_index` (`section_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `information`
--
ALTER TABLE `information`
  ADD PRIMARY KEY (`id`),
  ADD KEY `information_question_id_index` (`question_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_control_id_index` (`control_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `controls`
--
ALTER TABLE `controls`
  ADD CONSTRAINT `controls_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`);

--
-- Constraints for table `information`
--
ALTER TABLE `information`
  ADD CONSTRAINT `information_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`);

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_control_id_foreign` FOREIGN KEY (`control_id`) REFERENCES `controls` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

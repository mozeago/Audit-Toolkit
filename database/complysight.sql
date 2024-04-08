-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2024 at 05:13 AM
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

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('82bb3add6fd3e748bbc77da2338ab556b17c1fa6', 'i:2;', 1712413130),
('82bb3add6fd3e748bbc77da2338ab556b17c1fa6:timer', 'i:1712413130;', 1712413130);

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
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `controls`
--

INSERT INTO `controls` (`id`, `name`, `section_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
('2cbcf278-39d3-4a69-9fa6-9c1354c57c86', 'Information Audit', '6054e348-babe-4bb8-859c-a59f080ced32', '2024-03-25 22:04:53', '2024-03-26 23:35:26', NULL),
('593176dc-67a9-4137-a124-d129d9473a5f', 'Ongoing Consent Management', '96920581-c063-4bf1-bbaa-f886f1bbf285', '2024-03-24 23:59:20', '2024-03-24 23:59:20', NULL),
('5deb473e-96cd-4eb8-b3d5-30c1f7433fd2', 'Data Protection Training and Awareness Review', 'acbb59eb-b784-4d31-9611-565931c618b0', '2024-03-25 12:24:49', '2024-03-25 12:36:14', NULL),
('a456e983-5039-4529-b746-4c5b8ecf5a83', 'Lawful Basis Identification and Documentation', '96920581-c063-4bf1-bbaa-f886f1bbf285', '2024-03-24 23:58:01', '2024-03-24 23:58:01', NULL),
('c26aa4c4-c3c1-48f4-b209-1b2fd33a6e0e', 'Vital Interest', '96920581-c063-4bf1-bbaa-f886f1bbf285', '2024-03-25 00:03:54', '2024-03-25 12:36:30', NULL),
('d442b626-512d-466e-aa80-9abeeda0456d', 'necessitatibus', 'fd280509-f56d-4554-8b09-ddf8f05f4bcb', '2024-03-20 05:54:00', '2024-03-20 05:54:00', NULL),
('e5aea5c6-f609-49ad-b29b-87e8e63b7847', 'Consent Review', '96920581-c063-4bf1-bbaa-f886f1bbf285', '2024-03-24 23:59:03', '2024-03-24 23:59:03', NULL),
('fcc652b2-e624-4f4f-850f-8e51ecb1d8f6', 'Documentation of Personal Data', '6054e348-babe-4bb8-859c-a59f080ced32', '2024-03-24 23:47:06', '2024-03-24 23:47:06', NULL);

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
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `information`
--

INSERT INTO `information` (`id`, `content`, `question_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
('b59e886c-b748-4622-b5cd-23b42173c751', 'Conducting an information audit helps organizations understand the types of personal data they collect, process, and share, which is essential for Data Protection  compliance. Failure to conduct an audit may result in incomplete or inaccurate knowledge of data flows, leading to compliance gaps.', '1ed9c4a3-cfa3-4cf2-8cbc-2e1e70340c51', '2024-03-26 06:57:28', '2024-03-27 02:09:48', NULL),
('b743c95a-8f42-49f2-8ce4-db4f0ff398cd', 'Conducting an information audit helps organizations understand the types of personal data they collect, process, and share, which is essential for Data Protection  compliance. Failure to conduct an audit may result in incomplete or inaccurate knowledge of data flows, leading to compliance gaps.', '1ed9c4a3-cfa3-4cf2-8cbc-2e1e70340c51', '2024-03-28 06:33:58', '2024-03-28 06:33:58', NULL),
('f59de7a3-7c7d-46c3-a874-a424a3823d49', 'Documenting personal data inventory, including its origin, processing activities, and sharing practices, is crucial for Data Protection  compliance and accountability. Without accurate documentation, organizations may struggle to demonstrate compliance or respond effectively to data subject requests.', '6ef07ddb-9807-4305-9b21-89c9a503efe5', '2024-03-27 02:10:12', '2024-03-27 02:10:12', NULL);

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_03_19_201429_create_sections_table', 1),
(5, '2024_03_19_201455_create_controls_table', 1),
(6, '2024_03_19_201512_create_questions_table', 1),
(7, '2024_03_19_201523_create_information_table', 1),
(8, '2024_03_27_111545_create_recommendations_table', 1),
(10, '2024_03_30_101436_create_templates_table', 1),
(11, '2024_04_01_022113_create_risk_profiles_table', 1),
(12, '2024_04_01_144447_create_risk_sections_table', 1),
(13, '2024_04_01_144506_create_risk_sub_sections_table', 1),
(14, '2024_04_01_144517_create_risk_information_table', 1),
(15, '2024_04_01_144531_create_risk_recommendations_table', 1),
(16, '2024_03_27_185338_create_user_responses_table', 2),
(17, '2024_04_07_203129_create_risk_analysis_responses_table', 3);

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
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `text`, `control_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
('1ed9c4a3-cfa3-4cf2-8cbc-2e1e70340c51', 'Has your business conducted an information audit to map data flows?', '2cbcf278-39d3-4a69-9fa6-9c1354c57c86', '2024-03-26 06:53:26', '2024-03-26 06:53:26', NULL),
('6ef07ddb-9807-4305-9b21-89c9a503efe5', 'Has your business documented what personal data you hold, where it came from, who you share it with, and what you do with it?', 'fcc652b2-e624-4f4f-850f-8e51ecb1d8f6', '2024-03-25 22:47:38', '2024-03-25 22:47:38', NULL),
('88c07549-7082-44b6-a071-a90e6bc1c91c', 'Does your business have systems to record and manage ongoing consent?', '593176dc-67a9-4137-a124-d129d9473a5f', '2024-03-26 05:19:19', '2024-03-26 05:19:19', NULL),
('a6672da1-ac37-48ea-a46c-18742b03164d', 'Has your business identified your lawful bases for processing personal data and documented these?', 'a456e983-5039-4529-b746-4c5b8ecf5a83', '2024-03-26 10:17:57', '2024-03-26 10:17:57', NULL),
('c95e23ee-7938-4b8e-8ad3-25b9f86a9add', 'Has your business reviewed how you ask for and record consent?', 'c26aa4c4-c3c1-48f4-b209-1b2fd33a6e0e', '2024-03-26 10:31:35', '2024-03-27 01:59:05', NULL),
('d2e6f83f-4f5d-4fd8-ae0e-f3e4d8399b07', 'If your business may be required to process data to protect the vital interests of an individual, have you clearly documented the circumstances where it will be relevant?', 'c26aa4c4-c3c1-48f4-b209-1b2fd33a6e0e', '2024-03-26 06:54:11', '2024-03-26 06:54:11', NULL),
('e50d2b36-d41f-404f-812f-a48c087f00ef', 'Has your business reviewed how you ask for and record consent?', 'e5aea5c6-f609-49ad-b29b-87e8e63b7847', '2024-03-26 05:18:58', '2024-03-26 05:18:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `recommendations`
--

CREATE TABLE `recommendations` (
  `id` char(36) NOT NULL,
  `content` text NOT NULL,
  `question_response` enum('true','false') NOT NULL,
  `question_id` char(36) NOT NULL,
  `information_id` char(36) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `recommendations`
--

INSERT INTO `recommendations` (`id`, `content`, `question_response`, `question_id`, `information_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
('9babeb5a-c82b-420c-9ee5-bdaded00eef5', 'Establish robust documentation practices to record all personal data held by the organization, including its sources, processing purposes, recipients, and retention periods. Ensure documentation is regularly updated and accessible to relevant stakeholders involved in Data Protection compliance activities.', 'false', '6ef07ddb-9807-4305-9b21-89c9a503efe5', 'b59e886c-b748-4622-b5cd-23b42173c751', '2024-03-28 05:55:03', '2024-04-02 21:52:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `risk_analysis_responses`
--

CREATE TABLE `risk_analysis_responses` (
  `id` char(36) NOT NULL,
  `answer` enum('true','false') NOT NULL,
  `organization` text NOT NULL,
  `department` text NOT NULL,
  `user_id` char(36) NOT NULL,
  `risk_sub_section_id` char(36) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `risk_information`
--

CREATE TABLE `risk_information` (
  `id` char(36) NOT NULL,
  `text` text NOT NULL,
  `risk_sub_section_id` char(36) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `risk_information`
--

INSERT INTO `risk_information` (`id`, `text`, `risk_sub_section_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
('00e7bc03-1dbe-4fa4-b8b3-6fa390b6abce', 'Example of such processing includes: \n1) Imposing speeding fines purely on the basis of evidence from speed cameras is an automated decision-making process.\n2) Loan facillity application purely based on credit rating is a combination of profiling and automated decision.\n3) An aptitude test used for recruitment which uses pre-programmed algorithms and criteria\n\n It can be based on any type of data, such as:\n- data provided directly by individuals\n- observed data \n- derived or inferred data\n\nThere are exceptions to this prohibition, however. Automated decision-making is permitted if the decision is necessary for entering into, or performance of, a contract between the data subject and a data controller\nis authorised by Union or Member State law to which the controller is subject or\nis based on the data subject\'s explicit consent.', '075ca43d-32ae-4dcd-9ea0-b4264b5e6cd1', '2024-04-02 13:30:38', '2024-04-02 13:41:52', NULL),
('f424da50-230b-45f2-897f-aedac26b30a2', 'Example of large scale processing:\n1) processing of patient data in the regular course of business by a hospital\n2) processing of travel data of individuals using a city’s public transport system (e.g. tracking via travel cards)\n3) processing of real time geo-location data of customers of an international fast food chain for statistical purposes by a processor specialised in these activities\n4) processing of customer data in the regular course of business by an insurance company or a bank\n5) processing of personal data for behavioural advertising by a search engine\n6) processing of data (content, traffic, location) by telephone or internet service providers\nExamples that do not constitute large-scale processing include:\n• processing of patient data by an individual physician\n• processing of personal data relating to criminal convictions and offences by an individual lawyer', 'a2ab62a3-855d-42ed-a14b-7a12518c67c2', '2024-04-02 20:58:47', '2024-04-02 20:58:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `risk_profiles`
--

CREATE TABLE `risk_profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `risk_recommendations`
--

CREATE TABLE `risk_recommendations` (
  `id` char(36) NOT NULL,
  `text` text NOT NULL,
  `question_response` enum('true','false') NOT NULL,
  `risk_information_id` char(36) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `risk_recommendations`
--

INSERT INTO `risk_recommendations` (`id`, `text`, `question_response`, `risk_information_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
('4e2053bd-ab60-4b0d-b891-3d1cecf4c8b1', 'Conduct impact assessment to determine the amount of personal data held and processed by your organisation. Its important to note that this data may also change over time.  \n\nYou should  ensure that you:\no periodically review the scope and nature of your processing together with any updated guidance which may be published\no document the outcome of such reviews.', 'false', '00e7bc03-1dbe-4fa4-b8b3-6fa390b6abce', '2024-04-02 20:59:36', '2024-04-02 21:32:23', NULL),
('b4f451c8-1537-4541-96e0-0f4f3a0b7cfb', 'Example of such processing includes: \n1) Imposing speeding fines purely on the basis of evidence from speed cameras is an automated decision-making process.\n2) Loan facillity application purely based on credit rating is a combination of profiling and automated decision.\n3) An aptitude test used for recruitment which uses pre-programmed algorithms and criteria\n\n It can be based on any type of data, such as:\n- data provided directly by individuals\n- observed data \n- derived or inferred data\n\nThere are exceptions to this prohibition, however. Automated decision-making is permitted if the decision is necessary for entering into, or performance of, a contract between the data subject and a data controller\nis authorised by Union or Member State law to which the controller is subject or\nis based on the data subject\'s explicit consent.', 'false', '00e7bc03-1dbe-4fa4-b8b3-6fa390b6abce', '2024-04-02 15:57:52', '2024-04-02 21:32:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `risk_sections`
--

CREATE TABLE `risk_sections` (
  `id` char(36) NOT NULL,
  `name` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `risk_sections`
--

INSERT INTO `risk_sections` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
('44ab7021-112c-4e63-a871-baa6235f442f', 'Type of personal data processed by the organisation', '2024-04-02 13:11:09', '2024-04-02 13:11:09', NULL),
('93f2548d-24d8-4e75-ac68-0e5f042db822', 'Commercial use of data', '2024-04-02 13:11:46', '2024-04-02 13:11:46', NULL),
('9f9e24a5-e2c2-4e1f-b53a-c140b61f4b3e', 'Processing of sensitive personal data.', '2024-04-02 13:11:31', '2024-04-02 13:11:31', NULL),
('ab2869bc-791c-4fa8-8618-f4db8ccf5fa8', 'Type of processing activity conducted by controller/processor', '2024-04-02 13:10:39', '2024-04-02 13:10:39', NULL),
('b0c2677c-327c-494c-851f-b1752b3ab9e4', 'Business Operation', '2024-04-02 13:11:58', '2024-04-02 13:11:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `risk_sub_sections`
--

CREATE TABLE `risk_sub_sections` (
  `id` char(36) NOT NULL,
  `text` text NOT NULL,
  `risk_section_id` char(36) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `risk_sub_sections`
--

INSERT INTO `risk_sub_sections` (`id`, `text`, `risk_section_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
('075ca43d-32ae-4dcd-9ea0-b4264b5e6cd1', 'Automated Decision and Profiling\nWe use automated tools, profiling or algorithmic means make legal decisions, determine who gets access to services or other significant effects.', 'ab2869bc-791c-4fa8-8618-f4db8ccf5fa8', '2024-04-02 13:27:47', '2024-04-02 13:27:47', NULL),
('5022bf31-8b6d-4b84-8ed6-4ef8bf393f28', 'Systematic monitoring\nWe perform systematic monitoring of publicly accessible areas on a large scale;', 'ab2869bc-791c-4fa8-8618-f4db8ccf5fa8', '2024-04-02 13:28:21', '2024-04-02 13:28:21', NULL),
('9c4e454b-2ef3-4859-8b55-71b91865e733', 'Business innovation, expanpansion and use of technology\nWe have made some changes in our internal processing that may result in higher risk to data subjects;\nWe have adopted innovative use or application of new technological or organizational solutions\nWe combine, link or cross-reference datasets from different sources and process these for new/different purposes;', 'ab2869bc-791c-4fa8-8618-f4db8ccf5fa8', '2024-04-02 13:28:53', '2024-04-02 13:28:53', NULL),
('a2ab62a3-855d-42ed-a14b-7a12518c67c2', 'Large Scale Processing\nWe use of personal data on a large-scale for a purpose other than that for which the data was initially collected;', 'ab2869bc-791c-4fa8-8618-f4db8ccf5fa8', '2024-04-02 13:28:01', '2024-04-02 13:28:01', NULL),
('a93ff36f-2210-4a5f-9589-b2a1232cb72a', 'Sensitive data processing\nWe process sensitive data and data relating to children or vulnerable groups;)', 'ab2869bc-791c-4fa8-8618-f4db8ccf5fa8', '2024-04-02 13:28:33', '2024-04-02 13:28:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
('0047f226-f163-4b1d-bd77-93cd9eb21506', 'Vendors and Processors', '2024-03-21 02:28:57', '2024-03-21 02:28:57', NULL),
('2fecb5f1-80bc-4a70-9288-8b161b9e66fe', 'Data Privacy Risks Management 4', '2024-03-21 02:29:08', '2024-03-26 23:32:11', NULL),
('6054e348-babe-4bb8-859c-a59f080ced32', 'Data Management', '2024-03-21 02:24:44', '2024-03-21 02:24:44', NULL),
('96920581-c063-4bf1-bbaa-f886f1bbf285', 'Legal Basis for Processing Data', '2024-03-21 02:25:38', '2024-03-25 11:33:10', NULL),
('acbb59eb-b784-4d31-9611-565931c618b0', 'Employee Training and Awareness', '2024-03-25 12:23:03', '2024-03-25 12:23:03', NULL),
('db5cff49-cd44-4488-96b4-dafe661846d8', 'Accountability', '2024-03-21 02:28:33', '2024-03-21 02:28:33', NULL),
('e42fd095-36f0-46c5-b9d1-bd9dc787446f', 'Registration', '2024-03-21 02:27:36', '2024-03-25 11:32:53', NULL),
('e5379413-9479-4963-9527-9373af74c306', 'Data Subject Rights', '2024-03-21 02:27:49', '2024-03-21 02:27:49', NULL),
('eab0bbce-ecf1-4b6b-a242-24e198907eb6', 'consequntial', '2024-03-20 05:53:59', '2024-03-25 11:33:43', NULL),
('f2861dab-76c0-4aa4-8704-98d987d0e456', 'authority', '2024-03-20 05:53:59', '2024-03-25 11:33:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` char(36) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('pptYOjTn3Cxe0L1mAaIOpknBV4JO0Em2LoskjO1t', '9bc06ddc-51ed-4296-9a17-e307c0e3665d', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZWhnWkZJS3VzU0FveHVGRGVBanROVEQ0R3VadllTRHpiMTdLMHVkTSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9yaXNrLWFuYWx5c2lzLXF1ZXN0aW9ubmFpcmUiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7czozNjoiOWJjMDZkZGMtNTFlZC00Mjk2LTlhMTctZTMwN2MwZTM2NjVkIjt9', 1712525899),
('rVl2VvJuMj4N0o6BLC4uz2WHWkPDirRKxSfXyG3E', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSkFiWEtqR2dCS2pMVlRWaDFDOTNzT2NqRGl3WFd6TkkyZFIyTnJtVyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0OToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3Jpc2stYW5hbHlzaXMtcXVlc3Rpb25uYWlyZSI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI3OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1712545998);

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE `templates` (
  `id` char(36) NOT NULL,
  `name` text NOT NULL,
  `category` text NOT NULL,
  `url` text NOT NULL,
  `thumbnail` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
('9bbe0a99-a388-4977-b090-cbb939911ca4', 'Moses Asiago', 'mozzeago@gmail.com', NULL, '$2y$12$0NKrJO9DhkdaDOf1LVBSCO8Wa3OlbITLjLCAjPYyt/OiHdxvrRvF.', NULL, '2024-04-06 09:07:19', '2024-04-06 09:07:19', NULL),
('9bc02a3a-d77f-4110-96ea-846b320b048b', 'Moses Asiago', 'asiago.mo@gmail.com', NULL, '$2y$12$cC0BoU/V7TN2W12hwfblAuCQSJct0LOdFtkj/EUXBbSKckREj41ty', NULL, '2024-04-07 10:27:25', '2024-04-07 10:27:25', NULL),
('9bc06ddc-51ed-4296-9a17-e307c0e3665d', 'The Mass', 'themassinfo@gmail.com', NULL, '$2y$12$aslLlsXMt31YnbxvboYxtO0pU71C2nhQs6ioYv/BauXViRz9khH9u', NULL, '2024-04-07 13:36:31', '2024-04-07 13:36:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_responses`
--

CREATE TABLE `user_responses` (
  `id` char(36) NOT NULL,
  `answer` enum('true','false') NOT NULL,
  `organization` text NOT NULL,
  `department` text NOT NULL,
  `user_id` char(36) NOT NULL,
  `question_id` char(36) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_responses`
--

INSERT INTO `user_responses` (`id`, `answer`, `organization`, `department`, `user_id`, `question_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
('59e77d15-b1c7-497f-b826-70d47c657490', 'true', 'unilever', 'IT', '9bc06ddc-51ed-4296-9a17-e307c0e3665d', '1ed9c4a3-cfa3-4cf2-8cbc-2e1e70340c51', '2024-04-07 17:13:04', '2024-04-07 17:13:04', NULL),
('5db2ae20-1c0c-4ff2-a774-025439e9ea00', 'true', 'unilever', 'IT', '9bc06ddc-51ed-4296-9a17-e307c0e3665d', '88c07549-7082-44b6-a071-a90e6bc1c91c', '2024-04-07 17:13:10', '2024-04-07 17:13:10', NULL),
('5f78c428-bd89-4a95-8629-c1f80cad1ce8', 'true', 'unilever', 'IT', '9bc06ddc-51ed-4296-9a17-e307c0e3665d', 'e50d2b36-d41f-404f-812f-a48c087f00ef', '2024-04-07 17:13:21', '2024-04-07 17:13:21', NULL),
('c176355a-c8b0-41d1-ac3a-b43d799f1dd1', 'true', 'unilever', 'IT', '9bc06ddc-51ed-4296-9a17-e307c0e3665d', 'a6672da1-ac37-48ea-a46c-18742b03164d', '2024-04-07 17:13:13', '2024-04-07 17:13:13', NULL),
('d903f431-0710-48cf-bd4d-f65e4d4141f5', 'false', 'unilever', 'IT', '9bc06ddc-51ed-4296-9a17-e307c0e3665d', 'd2e6f83f-4f5d-4fd8-ae0e-f3e4d8399b07', '2024-04-07 17:13:19', '2024-04-07 17:13:19', NULL),
('e1261fd2-95c2-4383-add2-941243069a74', 'true', 'unilever', 'IT', '9bc06ddc-51ed-4296-9a17-e307c0e3665d', 'c95e23ee-7938-4b8e-8ad3-25b9f86a9add', '2024-04-07 17:13:16', '2024-04-07 17:13:16', NULL),
('f97bd5ef-2044-42a0-baa4-2812f992b827', 'false', 'unilever', 'IT', '9bc06ddc-51ed-4296-9a17-e307c0e3665d', '6ef07ddb-9807-4305-9b21-89c9a503efe5', '2024-04-07 17:13:08', '2024-04-07 17:13:08', NULL);

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
-- Indexes for table `recommendations`
--
ALTER TABLE `recommendations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recommendations_question_id_foreign` (`question_id`),
  ADD KEY `recommendations_information_id_index` (`information_id`);

--
-- Indexes for table `risk_analysis_responses`
--
ALTER TABLE `risk_analysis_responses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `risk_analysis_responses_user_id_foreign` (`user_id`),
  ADD KEY `risk_analysis_responses_risk_sub_section_id_foreign` (`risk_sub_section_id`);

--
-- Indexes for table `risk_information`
--
ALTER TABLE `risk_information`
  ADD PRIMARY KEY (`id`),
  ADD KEY `risk_information_risk_sub_section_id_index` (`risk_sub_section_id`);

--
-- Indexes for table `risk_profiles`
--
ALTER TABLE `risk_profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `risk_recommendations`
--
ALTER TABLE `risk_recommendations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `risk_recommendations_risk_information_id_index` (`risk_information_id`);

--
-- Indexes for table `risk_sections`
--
ALTER TABLE `risk_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `risk_sub_sections`
--
ALTER TABLE `risk_sub_sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `risk_sub_sections_risk_section_id_index` (`risk_section_id`);

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
-- Indexes for table `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_responses`
--
ALTER TABLE `user_responses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_responses_user_id_foreign` (`user_id`),
  ADD KEY `user_responses_question_id_foreign` (`question_id`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `risk_profiles`
--
ALTER TABLE `risk_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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

--
-- Constraints for table `recommendations`
--
ALTER TABLE `recommendations`
  ADD CONSTRAINT `recommendations_information_id_foreign` FOREIGN KEY (`information_id`) REFERENCES `information` (`id`),
  ADD CONSTRAINT `recommendations_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`);

--
-- Constraints for table `risk_analysis_responses`
--
ALTER TABLE `risk_analysis_responses`
  ADD CONSTRAINT `risk_analysis_responses_risk_sub_section_id_foreign` FOREIGN KEY (`risk_sub_section_id`) REFERENCES `risk_sub_sections` (`id`),
  ADD CONSTRAINT `risk_analysis_responses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `risk_information`
--
ALTER TABLE `risk_information`
  ADD CONSTRAINT `risk_information_risk_sub_section_id_foreign` FOREIGN KEY (`risk_sub_section_id`) REFERENCES `risk_sub_sections` (`id`);

--
-- Constraints for table `risk_recommendations`
--
ALTER TABLE `risk_recommendations`
  ADD CONSTRAINT `risk_recommendations_risk_information_id_foreign` FOREIGN KEY (`risk_information_id`) REFERENCES `risk_information` (`id`);

--
-- Constraints for table `risk_sub_sections`
--
ALTER TABLE `risk_sub_sections`
  ADD CONSTRAINT `risk_sub_sections_risk_section_id_foreign` FOREIGN KEY (`risk_section_id`) REFERENCES `risk_sections` (`id`);

--
-- Constraints for table `user_responses`
--
ALTER TABLE `user_responses`
  ADD CONSTRAINT `user_responses_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`),
  ADD CONSTRAINT `user_responses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

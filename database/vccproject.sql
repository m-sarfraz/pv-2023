-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2021 at 10:20 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vccproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `candidate_educations`
--

CREATE TABLE `candidate_educations` (
  `id` int(11) NOT NULL,
  `educational_attain` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `qualification` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `candidate_informations`
--

CREATE TABLE `candidate_informations` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` int(11) NOT NULL,
  `gender` varchar(15) NOT NULL,
  `dob` date NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '1 for active 0 for inactive',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `candidate_ownership` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `a_entry_level` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `executive_level` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `e_rates` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Entry level rates',
  `e_c_s_rates` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'entry/complex/specialized level rates',
  `c_v_r_programs` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Agent/complex-Voice Relay Programs/TSR/ Collections',
  `c_hires` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Project Base and Contractual hires',
  `night_shift` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gateway_hire` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Agent/Gateway hire/SET',
  `google_sr` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Google NA Sales Representative',
  `csr_tsr` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Sales CSR & TSR (Air BnB & Google)',
  `in_luzon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'International Account luzon',
  `in_visayas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'International Account Visayas',
  `local_acccount` bigint(20) UNSIGNED DEFAULT NULL,
  `aa_intl` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'Achieve Academy Intl',
  `aa_local` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'Achieve Academy Local',
  `trainee_ncr` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'trainee NCR',
  `trainee_vm` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'trainee Visayas and Mindanao',
  `pfsc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Premium Financial Services Account',
  `cl13_v` bigint(20) UNSIGNED DEFAULT NULL,
  `cl13_nv` bigint(20) UNSIGNED DEFAULT NULL,
  `cl12_v` bigint(20) UNSIGNED DEFAULT NULL,
  `cl12_nv` bigint(20) UNSIGNED DEFAULT NULL,
  `cl11` bigint(20) UNSIGNED DEFAULT NULL,
  `cl10_sa` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'cl 10 senior analyst',
  `cl10_usrn` bigint(20) UNSIGNED DEFAULT NULL,
  `cl9` bigint(20) UNSIGNED DEFAULT NULL,
  `cl8` bigint(20) UNSIGNED DEFAULT NULL,
  `cl7` bigint(20) UNSIGNED DEFAULT NULL,
  `cl6` bigint(20) UNSIGNED DEFAULT NULL,
  `cl5` bigint(20) UNSIGNED DEFAULT NULL,
  `executive` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `md` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `director` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sm` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `m` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `am` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Asst. Manager/Assoc Manager',
  `team_lead` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supervisor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `non_supervisory` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `multilingual` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bilingual` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usrn_active_license` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usrn_inactive_license` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nclex` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `na_entry_level` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `specialized_account` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `specialist` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `associate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `advisor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `senior_level` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mid_level` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `junior_level` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `assoc_analyst` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sen_analyst` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `analyst` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `b6` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `b7` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `b8` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `b9` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `b10` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sme_level` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `advisor_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `advisor_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `company_name`, `start_date`, `end_date`, `candidate_ownership`, `a_entry_level`, `executive_level`, `e_rates`, `e_c_s_rates`, `c_v_r_programs`, `c_hires`, `night_shift`, `gateway_hire`, `google_sr`, `csr_tsr`, `in_luzon`, `in_visayas`, `local_acccount`, `aa_intl`, `aa_local`, `trainee_ncr`, `trainee_vm`, `pfsc`, `cl13_v`, `cl13_nv`, `cl12_v`, `cl12_nv`, `cl11`, `cl10_sa`, `cl10_usrn`, `cl9`, `cl8`, `cl7`, `cl6`, `cl5`, `executive`, `md`, `director`, `vp`, `avp`, `sm`, `m`, `am`, `team_lead`, `supervisor`, `non_supervisory`, `multilingual`, `bilingual`, `usrn_active_license`, `usrn_inactive_license`, `nclex`, `na_entry_level`, `specialized_account`, `specialist`, `associate`, `advisor`, `senior_level`, `mid_level`, `junior_level`, `assoc_analyst`, `sen_analyst`, `analyst`, `b6`, `b7`, `b8`, `b9`, `b10`, `sme_level`, `advisor_2`, `advisor_1`, `created_at`, `updated_at`) VALUES
(11, 'EWD TECH FSD', '2021-09-10', '2021-09-03', 'sarfraz', 'GfgDQIErSX', 'u4QrcgxV1j', '2', '2', '2', '2', '2', '2', 'rc4XyHsb9e', '2', '2', '2', 12123, 123123, 123123, 123, 33, '34534', 345, 5554, 345435, 34545, 34545, 345435, 345435, 34545, 3454, 555, 345435, 3345, '34543', '34534', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', NULL, '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2021-09-02 00:20:46', '2021-09-03 01:51:09'),
(12, 'Test Company FSD', '2021-09-10', '2021-09-03', 'sdfsdf', 'GfgDQIErSX', 'u4QrcgxV1j', '5555', '457', '574', '4555', '444', 'IGnwb9vlTQ', 'rc4XyHsb9e', '444', '5555', '888', 12123, 123123, 123123, 123, 33, '34534', 345, 5554, 345435, 34545, 34545, 345435, 345435, 34545, 3454, 555, 345435, 3345, '34543', '34534', '546757', '47457', '57457', '47457', '57457', '4747', '74574575', '747', '7457', '7474', '457457', '574574', '2', '74574', '2', '47457', NULL, '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2021-09-02 00:20:46', '2021-09-03 01:57:41');

-- --------------------------------------------------------

--
-- Table structure for table `domains`
--

CREATE TABLE `domains` (
  `id` int(11) NOT NULL,
  `domain_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `domains`
--

INSERT INTO `domains` (`id`, `domain_name`, `created_at`, `updated_at`) VALUES
(1, 'test domain', '2021-09-06 07:51:36', '2021-09-06 07:51:36'),
(2, 'test domain 2', '2021-09-06 07:51:36', '2021-09-06 07:51:36');

-- --------------------------------------------------------

--
-- Table structure for table `drop_downs`
--

CREATE TABLE `drop_downs` (
  `id` int(11) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `drop_downs`
--

INSERT INTO `drop_downs` (`id`, `type`, `name`, `created_at`, `updated_at`) VALUES
(1, 'application_status', 'Application status', '2021-08-25 07:53:06', '2021-08-25 07:53:06'),
(2, 'candidates_profile', 'Candidates profile', '2021-08-25 07:53:06', '2021-08-25 07:53:06'),
(3, 'career_level', 'Career level', '2021-08-25 07:53:06', '2021-08-25 07:53:06'),
(4, 'remarks_for_finance', 'Remarks For Finance', '2021-08-30 05:49:21', '2021-08-30 05:49:21'),
(5, 'course', 'COURSE', '2021-09-03 06:40:53', '2021-09-03 06:40:53'),
(6, 'educational_attainment', 'EDUCATIONAL_ATTAINTMENT', '2021-09-03 06:41:43', '2021-09-03 06:41:43');

-- --------------------------------------------------------

--
-- Table structure for table `drop_down_options`
--

CREATE TABLE `drop_down_options` (
  `id` int(11) NOT NULL,
  `drop_down_id` int(11) NOT NULL,
  `sec_dropdown_id` int(11) DEFAULT NULL,
  `option_name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1 for active 0 for inactive',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `drop_down_options`
--

INSERT INTO `drop_down_options` (`id`, `drop_down_id`, `sec_dropdown_id`, `option_name`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, NULL, 'test 2', 1, '2021-08-26 06:50:20', '2021-08-26 06:50:20'),
(3, 1, NULL, 'test 3', 1, '2021-08-26 07:03:00', '2021-08-26 07:03:00'),
(4, 1, NULL, 'test 4', 1, '2021-08-26 07:03:00', '2021-08-26 07:03:00'),
(5, 2, NULL, 'can 1', 1, '2021-08-26 07:03:25', '2021-08-26 07:03:25'),
(6, 2, NULL, 'can 2', 1, '2021-08-26 07:03:25', '2021-08-26 07:03:25'),
(8, 3, NULL, 'test 6', 1, '2021-08-26 08:10:26', '2021-08-26 08:10:26'),
(9, 3, NULL, 'test 7', 1, '2021-08-26 08:10:26', '2021-08-26 08:10:26'),
(10, 1, NULL, 't1', 1, '2021-08-30 06:39:36', '2021-08-30 06:39:36'),
(11, 4, 1, 't1i', 1, '2021-08-30 06:40:15', '2021-08-30 04:35:54'),
(12, 4, 1, 't2i', 1, '2021-08-30 06:40:15', '2021-08-30 06:40:15'),
(13, 4, 1, 't3i', 1, '2021-08-30 06:40:15', '2021-08-30 06:40:15'),
(14, 4, 2, 't1m', 0, '2021-08-30 07:00:29', '2021-08-30 02:23:24'),
(15, 4, 2, 't2m', 1, '2021-08-30 07:00:29', '2021-08-30 07:00:29'),
(16, 4, 3, 't1f', 1, '2021-08-30 07:19:46', '2021-08-30 07:19:46'),
(17, 4, 3, 't2f', 1, '2021-08-30 07:19:46', '2021-08-30 07:19:46'),
(18, 5, NULL, 'HUMANITIES', 1, '2021-09-03 06:43:42', '2021-09-03 06:43:42'),
(19, 5, NULL, 'NATURAL SCIENCES', 1, '2021-09-03 06:43:59', '2021-09-03 06:43:59'),
(20, 5, NULL, 'SOCIAL SCIENCES', 1, '2021-09-03 06:44:14', '2021-09-03 06:44:14'),
(21, 6, NULL, 'ASSOCIATE COURSE GRADUATE', 1, '2021-09-03 06:44:42', '2021-09-03 06:44:42'),
(22, 6, NULL, 'DOCTORIATE', 1, '2021-09-03 06:44:58', '2021-09-03 06:44:58'),
(23, 6, NULL, 'GRADUATE', 1, '2021-09-03 06:45:11', '2021-09-03 06:45:11'),
(24, 6, NULL, 'HIGH SCHOOL GRADUATE', 1, '2021-09-03 06:45:25', '2021-09-03 06:45:25'),
(25, 6, NULL, 'MASTERS', 1, '2021-09-03 06:45:40', '2021-09-03 06:45:40'),
(26, 6, NULL, 'MBA', 1, '2021-09-03 06:45:53', '2021-09-03 06:45:53'),
(27, 6, NULL, 'SENIOR HIGH SCHOOL GRADUATE', 1, '2021-09-03 06:46:05', '2021-09-03 06:46:05'),
(28, 6, NULL, 'UNDERGRADUATE', 1, '2021-09-03 06:46:15', '2021-09-03 06:46:15'),
(29, 6, NULL, 'VOCATIONAL', 1, '2021-09-03 06:46:25', '2021-09-03 06:46:25'),
(30, 1, NULL, 'as1', 1, '2021-09-03 13:47:01', '2021-09-03 13:47:01'),
(31, 1, NULL, 'as2', 1, '2021-09-03 13:47:01', '2021-09-03 13:47:01');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gl`
--

CREATE TABLE `gl` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `gl23_tech` bigint(20) UNSIGNED DEFAULT NULL,
  `gl24_tech` bigint(20) UNSIGNED DEFAULT NULL,
  `gl25_tech` bigint(20) UNSIGNED DEFAULT NULL,
  `gl26_tech` bigint(20) UNSIGNED DEFAULT NULL,
  `gl27_tech` bigint(20) UNSIGNED DEFAULT NULL,
  `gl28_tech` bigint(20) UNSIGNED DEFAULT NULL,
  `gl29_tech` bigint(20) UNSIGNED DEFAULT NULL,
  `gl30_tech` bigint(20) UNSIGNED DEFAULT NULL,
  `gl22_bo` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'BUSINESS OPS',
  `gl23_bo` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'BUSINESS OPS',
  `gl24_bo_usrn` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'BUSINESS OPS',
  `gl_24_bo` bigint(20) UNSIGNED DEFAULT NULL,
  `gl_25_bo` bigint(20) UNSIGNED DEFAULT NULL,
  `gl_26_bo` bigint(20) UNSIGNED DEFAULT NULL,
  `gl_27_bo` bigint(20) UNSIGNED DEFAULT NULL,
  `gl_28_bo` bigint(20) UNSIGNED DEFAULT NULL,
  `gl_29_bo` bigint(20) UNSIGNED DEFAULT NULL,
  `gl_30_bo` bigint(20) UNSIGNED DEFAULT NULL,
  `gl22_ss` bigint(20) UNSIGNED DEFAULT NULL COMMENT ' SHARED SERVICES',
  `gl23_ss` bigint(20) UNSIGNED DEFAULT NULL COMMENT ' SHARED SERVICES',
  `gl24_ss` bigint(20) UNSIGNED DEFAULT NULL COMMENT ' SHARED SERVICES',
  `gl25_ss` bigint(20) UNSIGNED DEFAULT NULL,
  `gl26_ss` bigint(20) UNSIGNED DEFAULT NULL,
  `gl27_ss` bigint(20) UNSIGNED DEFAULT NULL,
  `gl28_ss` bigint(20) UNSIGNED DEFAULT NULL,
  `gl29_ss` bigint(20) UNSIGNED DEFAULT NULL,
  `gl30_ss` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gl`
--

INSERT INTO `gl` (`id`, `company_id`, `gl23_tech`, `gl24_tech`, `gl25_tech`, `gl26_tech`, `gl27_tech`, `gl28_tech`, `gl29_tech`, `gl30_tech`, `gl22_bo`, `gl23_bo`, `gl24_bo_usrn`, `gl_24_bo`, `gl_25_bo`, `gl_26_bo`, `gl_27_bo`, `gl_28_bo`, `gl_29_bo`, `gl_30_bo`, `gl22_ss`, `gl23_ss`, `gl24_ss`, `gl25_ss`, `gl26_ss`, `gl27_ss`, `gl28_ss`, `gl29_ss`, `gl30_ss`, `created_at`, `updated_at`) VALUES
(8, 11, 2, 2, 2, 2, 2, 2, 2, 2, 2200, 2200, 2, 200, 200, 200, 200, 200, 200, 200, 200, 200, 200, 200, 200, 200, 200, 3, 200, '2021-09-02 00:20:46', '2021-09-03 01:51:09'),
(9, 12, 2, 2, 2, 2, 2, 2, 2, 2, 22, 22, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, '2021-09-02 00:20:46', '2021-09-03 01:57:41');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_08_23_054139_create_permission_tables', 2),
(5, '2021_09_01_072650_create_companies_table', 3),
(6, '2021_09_01_095441_create_gl_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 4),
(3, 'App\\User', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'user-list', 'web', '2021-09-06 02:11:28', '2021-09-06 02:11:28'),
(2, 'user-create', 'web', '2021-09-06 02:11:28', '2021-09-06 02:11:28'),
(3, 'user-edit', 'web', '2021-09-06 02:11:28', '2021-09-06 02:11:28'),
(4, 'role-list', 'web', '2021-09-06 02:11:28', '2021-09-06 02:11:28'),
(5, 'role-create', 'web', '2021-09-06 02:11:28', '2021-09-06 02:11:28'),
(6, 'role-edit', 'web', '2021-09-06 02:11:28', '2021-09-06 02:11:28'),
(7, 'role-delete', 'web', '2021-09-06 02:11:28', '2021-09-06 02:11:28'),
(8, 'view-profile', 'web', '2021-09-06 02:11:28', '2021-09-06 02:11:28'),
(9, 'save-profile', 'web', '2021-09-06 02:11:28', '2021-09-06 02:11:28'),
(10, 'list-dropdown', 'web', '2021-09-06 02:11:28', '2021-09-06 02:11:28'),
(11, 'add-option', 'web', '2021-09-06 02:11:28', '2021-09-06 02:11:28'),
(12, 'delete-option', 'web', '2021-09-06 02:11:28', '2021-09-06 02:11:28'),
(13, 'option-status', 'web', '2021-09-06 02:11:28', '2021-09-06 02:11:28'),
(14, 'add-domain', 'web', '2021-09-06 02:11:28', '2021-09-06 02:11:28'),
(15, 'add-segment', 'web', '2021-09-06 02:11:28', '2021-09-06 02:11:28'),
(16, 'add-sub-segment', 'web', '2021-09-06 02:11:28', '2021-09-06 02:11:28'),
(17, 'list-domain', 'web', '2021-09-06 02:11:29', '2021-09-06 02:11:29');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', '2021-08-23 01:39:01', '2021-08-23 01:39:01'),
(3, 'test role 1', 'web', '2021-08-23 01:58:09', '2021-08-23 01:58:09');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(9, 3),
(10, 1),
(10, 3),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1);

-- --------------------------------------------------------

--
-- Table structure for table `segments`
--

CREATE TABLE `segments` (
  `id` int(11) NOT NULL,
  `segment_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `segments`
--

INSERT INTO `segments` (`id`, `segment_name`, `created_at`, `updated_at`) VALUES
(1, 'test segment', '2021-09-06 08:16:30', '2021-09-06 08:16:30'),
(2, 'segment 1', '2021-09-06 08:16:30', '2021-09-06 08:16:30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` tinyint(4) NOT NULL COMMENT '1 for admin 2 for team 3 for user',
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `type`, `image`, `phone`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'malik irfann', 'testirfan@gmail.com', 3, 'public/1/profile/11629440604.jpg', NULL, NULL, '$2y$10$qyc3kXUp5YU19AHz0R4c/.PtRs.btQ.BbYhLdF.7iOzSMtEgGgRpy', 'KKWAiSrWJ4BZPok4LZCZk1H1fV3OVaFxoKVIVmDwI7T65SfEuy7eWC8YtkL4', '2021-08-12 01:56:46', '2021-08-20 23:51:39'),
(4, 'Test User', 'admin@gmail.com', 1, 'public/4/profile/41630309686.png', NULL, NULL, '$2y$10$ALa9tfuJNtcR3z5kTJm1KuKqJZNmVR/Oc0BhPs1bJBA0K7Zq4AeYm', NULL, '2021-08-23 01:39:01', '2021-08-30 02:48:06'),
(5, 'test irfan update', 'testirf@gmail.com', 3, NULL, '123412311', NULL, '$2y$10$corzNgVjrdTmG8cxPVqQcOisBbMY3.5lWAMg8a8rkQvRdBm3veYTq', NULL, '2021-08-23 02:41:25', '2021-09-06 02:12:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `candidate_educations`
--
ALTER TABLE `candidate_educations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `candidate_informations`
--
ALTER TABLE `candidate_informations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `domains`
--
ALTER TABLE `domains`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drop_downs`
--
ALTER TABLE `drop_downs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drop_down_options`
--
ALTER TABLE `drop_down_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gl`
--
ALTER TABLE `gl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gl_company_id_foreign` (`company_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `segments`
--
ALTER TABLE `segments`
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
-- AUTO_INCREMENT for table `candidate_educations`
--
ALTER TABLE `candidate_educations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `candidate_informations`
--
ALTER TABLE `candidate_informations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `domains`
--
ALTER TABLE `domains`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `drop_downs`
--
ALTER TABLE `drop_downs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `drop_down_options`
--
ALTER TABLE `drop_down_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gl`
--
ALTER TABLE `gl`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `segments`
--
ALTER TABLE `segments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gl`
--
ALTER TABLE `gl`
  ADD CONSTRAINT `gl_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

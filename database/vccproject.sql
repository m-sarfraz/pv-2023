-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 08, 2021 at 08:14 AM
-- Server version: 5.7.35
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ewdtech_vccproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `candidate_domains`
--

CREATE TABLE `candidate_domains` (
  `id` int(11) NOT NULL,
  `candidate_id` int(11) NOT NULL,
  `date_shifted` date NOT NULL,
  `domain` int(11) NOT NULL,
  `emp_history` text NOT NULL,
  `interview_note` text NOT NULL,
  `segment` int(11) NOT NULL,
  `sub_segment` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `candidate_domains`
--

INSERT INTO `candidate_domains` (`id`, `candidate_id`, `date_shifted`, `domain`, `emp_history`, `interview_note`, `segment`, `sub_segment`, `created_at`, `updated_at`) VALUES
(2, 11, '2021-09-01', 32, 'zUh368N3MR', 'CFZgLsmtep', 45, 63, '2021-09-06 07:10:14', '2021-09-06 07:10:14'),
(3, 12, '2021-09-01', 32, '5Ot25reOHm', 'Q0HmDHsgim', 45, 63, '2021-09-07 00:14:53', '2021-09-07 00:14:53'),
(4, 14, '2021-09-01', 32, 'onyASYgQBt', 'YmWeBfH4hL', 45, 63, '2021-09-07 01:02:21', '2021-09-07 01:02:21'),
(5, 15, '2021-09-01', 32, 'onyASYgQBt', 'YmWeBfH4hL', 45, 63, '2021-09-07 01:03:26', '2021-09-07 01:03:26'),
(6, 17, '2021-09-01', 32, '7JrO5Xz5Of', '6od4pidT4o', 45, 63, '2021-09-07 01:58:07', '2021-09-07 01:58:07'),
(7, 18, '2021-09-01', 32, '7JrO5Xz5Of', '6od4pidT4o', 45, 63, '2021-09-07 01:58:23', '2021-09-07 01:58:23'),
(8, 19, '2021-09-01', 32, '7JrO5Xz5Of', '6od4pidT4o', 45, 63, '2021-09-07 01:58:35', '2021-09-07 01:58:35'),
(9, 20, '2021-09-01', 32, 'fxgx3nb8SQ', 'zNijhnYXUz', 45, 63, '2021-09-07 02:06:18', '2021-09-07 02:06:18'),
(10, 21, '2021-09-01', 32, 'sLK9YB0tCz', 'Uy7am5BXI8', 45, 63, '2021-09-07 02:07:00', '2021-09-07 02:07:00'),
(11, 22, '2021-09-01', 32, 'eqOoOT25ax', 'JArwQGZQCx', 45, 63, '2021-09-07 02:07:29', '2021-09-07 02:07:29'),
(12, 23, '2021-09-01', 32, 'uUOgattTMD', 'SWgRF7Gdud', 45, 63, '2021-09-07 02:17:56', '2021-09-07 02:17:56'),
(13, 24, '2021-09-01', 32, 'xg1t07uOAV', 'KpIhPMddmC', 45, 63, '2021-09-07 02:18:30', '2021-09-07 02:18:30'),
(14, 25, '2021-09-01', 32, 'RKhhCErQrx', '8otGpWcqI4', 45, 63, '2021-09-07 02:29:38', '2021-09-07 02:29:38'),
(15, 26, '2021-09-01', 32, 'RKhhCErQrx', '8otGpWcqI4', 45, 63, '2021-09-07 02:29:56', '2021-09-07 02:29:56'),
(16, 27, '2021-09-01', 32, 'RKhhCErQrx', '8otGpWcqI4', 45, 63, '2021-09-07 02:32:00', '2021-09-07 02:32:00'),
(17, 28, '2021-09-01', 32, 'RKhhCErQrx', '8otGpWcqI4', 45, 63, '2021-09-07 02:34:09', '2021-09-07 02:34:09'),
(18, 29, '2021-09-01', 32, 'RKhhCErQrx', '8otGpWcqI4', 45, 63, '2021-09-07 02:34:35', '2021-09-07 02:34:35'),
(19, 30, '2021-09-01', 32, 'RKhhCErQrx', '8otGpWcqI4', 45, 63, '2021-09-07 02:34:53', '2021-09-07 02:34:53'),
(20, 31, '2021-09-01', 32, 'RKhhCErQrx', '8otGpWcqI4', 45, 63, '2021-09-07 02:36:41', '2021-09-07 02:36:41'),
(21, 32, '2021-09-01', 32, 'RKhhCErQrx', '8otGpWcqI4', 45, 63, '2021-09-07 02:38:01', '2021-09-07 02:38:01'),
(22, 33, '2021-09-01', 32, 'RKhhCErQrx', '8otGpWcqI4', 45, 63, '2021-09-07 02:38:46', '2021-09-07 02:38:46'),
(23, 34, '2021-09-01', 32, 'RKhhCErQrx', '8otGpWcqI4', 45, 63, '2021-09-07 02:38:51', '2021-09-07 02:38:51'),
(24, 35, '2021-09-01', 32, 'RKhhCErQrx', '8otGpWcqI4', 45, 63, '2021-09-07 02:39:02', '2021-09-07 02:39:02'),
(25, 36, '2021-09-01', 32, 'RKhhCErQrx', '8otGpWcqI4', 45, 63, '2021-09-07 02:39:15', '2021-09-07 02:39:15'),
(26, 37, '2021-09-01', 32, 'RKhhCErQrx', '8otGpWcqI4', 45, 63, '2021-09-07 02:39:25', '2021-09-07 02:39:25'),
(27, 38, '2021-09-01', 32, 'RKhhCErQrx', '8otGpWcqI4', 45, 63, '2021-09-07 02:40:13', '2021-09-07 02:40:13'),
(28, 39, '2021-09-01', 32, 'RKhhCErQrx', '8otGpWcqI4', 45, 63, '2021-09-07 02:40:22', '2021-09-07 02:40:22'),
(29, 40, '2021-09-01', 32, 'RKhhCErQrx', '8otGpWcqI4', 45, 63, '2021-09-07 02:40:25', '2021-09-07 02:40:25'),
(30, 41, '2021-09-01', 32, 'HXZrvRYeKG', 'cP5glSiFbQ', 45, 63, '2021-09-07 02:40:41', '2021-09-07 02:40:41'),
(31, 42, '2021-09-01', 32, 'HXZrvRYeKG', 'cP5glSiFbQ', 45, 63, '2021-09-07 02:40:43', '2021-09-07 02:40:43'),
(32, 43, '2021-09-01', 32, 'HXZrvRYeKG', 'cP5glSiFbQ', 45, 63, '2021-09-07 02:41:11', '2021-09-07 02:41:11'),
(33, 44, '2021-09-01', 32, 'HXZrvRYeKG', 'cP5glSiFbQ', 45, 63, '2021-09-07 02:41:59', '2021-09-07 02:41:59'),
(34, 45, '2021-09-01', 32, 'HXZrvRYeKG', 'cP5glSiFbQ', 45, 63, '2021-09-07 02:42:08', '2021-09-07 02:42:08'),
(35, 46, '2021-09-01', 32, 'HXZrvRYeKG', 'cP5glSiFbQ', 45, 63, '2021-09-07 02:42:43', '2021-09-07 02:42:43'),
(36, 47, '2021-09-01', 32, 'HXZrvRYeKG', 'cP5glSiFbQ', 45, 63, '2021-09-07 02:44:02', '2021-09-07 02:44:02'),
(37, 48, '2021-09-01', 32, 'HXZrvRYeKG', 'cP5glSiFbQ', 45, 63, '2021-09-07 02:44:11', '2021-09-07 02:44:11'),
(38, 49, '2021-09-01', 32, 'HXZrvRYeKG', 'cP5glSiFbQ', 45, 63, '2021-09-07 02:44:26', '2021-09-07 02:44:26'),
(39, 50, '2021-09-01', 32, 'HXZrvRYeKG', 'cP5glSiFbQ', 45, 63, '2021-09-07 02:46:06', '2021-09-07 02:46:06'),
(40, 51, '2021-09-01', 32, 'HXZrvRYeKG', 'cP5glSiFbQ', 45, 63, '2021-09-07 02:46:13', '2021-09-07 02:46:13'),
(41, 52, '2021-09-01', 32, 'HXZrvRYeKG', 'cP5glSiFbQ', 45, 63, '2021-09-07 02:46:19', '2021-09-07 02:46:19');

-- --------------------------------------------------------

--
-- Table structure for table `candidate_educations`
--

CREATE TABLE `candidate_educations` (
  `id` int(11) NOT NULL,
  `educational_attain` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `qualification` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `candidate_educations`
--

INSERT INTO `candidate_educations` (`id`, `educational_attain`, `course`, `qualification`, `created_at`, `updated_at`) VALUES
(11, '21', 'N/A', 'MvkYpSsAgC', '2021-09-06 07:10:14', '2021-09-06 07:10:14'),
(12, '22', 'N/A', 'knH8KuxfsE', '2021-09-07 00:14:53', '2021-09-07 00:14:53'),
(13, '22', 'N/A', 'myLvrRVEbx', '2021-09-07 00:49:54', '2021-09-07 00:49:54'),
(14, '22', 'N/A', '3K6ZyYnZEM', '2021-09-07 01:02:21', '2021-09-07 01:02:21'),
(15, '22', 'N/A', '3K6ZyYnZEM', '2021-09-07 01:03:26', '2021-09-07 01:03:26'),
(16, '22', 'N/A', 'Mpq2lj2hqc', '2021-09-07 01:03:33', '2021-09-07 01:03:33'),
(17, '22', 'N/A', 'qqjzaI6oH8', '2021-09-07 01:58:07', '2021-09-07 01:58:07'),
(18, '22', 'N/A', 'qqjzaI6oH8', '2021-09-07 01:58:23', '2021-09-07 01:58:23'),
(19, '22', 'N/A', 'qqjzaI6oH8', '2021-09-07 01:58:35', '2021-09-07 01:58:35'),
(20, '22', 'N/A', 'gBtEifiPno', '2021-09-07 02:06:18', '2021-09-07 02:06:18'),
(21, '22', 'N/A', '4OBoGPujir', '2021-09-07 02:07:00', '2021-09-07 02:07:00'),
(22, '22', 'N/A', 'augM4dRkpS', '2021-09-07 02:07:29', '2021-09-07 02:07:29'),
(23, '22', 'N/A', '3Rup8dylrI', '2021-09-07 02:17:56', '2021-09-07 02:17:56'),
(24, '22', 'N/A', '96RjLcB6L2', '2021-09-07 02:18:30', '2021-09-07 02:18:30'),
(25, '22', 'N/A', 'HwoNnHOCSP', '2021-09-07 02:29:38', '2021-09-07 02:29:38'),
(26, '22', 'N/A', 'HwoNnHOCSP', '2021-09-07 02:29:56', '2021-09-07 02:29:56'),
(27, '22', 'N/A', 'HwoNnHOCSP', '2021-09-07 02:32:00', '2021-09-07 02:32:00'),
(28, '22', 'N/A', 'HwoNnHOCSP', '2021-09-07 02:34:09', '2021-09-07 02:34:09'),
(29, '22', 'N/A', 'HwoNnHOCSP', '2021-09-07 02:34:35', '2021-09-07 02:34:35'),
(30, '22', 'N/A', 'HwoNnHOCSP', '2021-09-07 02:34:53', '2021-09-07 02:34:53'),
(31, '22', 'N/A', 'HwoNnHOCSP', '2021-09-07 02:36:41', '2021-09-07 02:36:41'),
(32, '22', 'N/A', 'HwoNnHOCSP', '2021-09-07 02:38:01', '2021-09-07 02:38:01'),
(33, '22', 'N/A', 'HwoNnHOCSP', '2021-09-07 02:38:46', '2021-09-07 02:38:46'),
(34, '22', 'N/A', 'HwoNnHOCSP', '2021-09-07 02:38:51', '2021-09-07 02:38:51'),
(35, '22', 'N/A', 'HwoNnHOCSP', '2021-09-07 02:39:02', '2021-09-07 02:39:02'),
(36, '22', 'N/A', 'HwoNnHOCSP', '2021-09-07 02:39:15', '2021-09-07 02:39:15'),
(37, '22', 'N/A', 'HwoNnHOCSP', '2021-09-07 02:39:25', '2021-09-07 02:39:25'),
(38, '22', 'N/A', 'HwoNnHOCSP', '2021-09-07 02:40:13', '2021-09-07 02:40:13'),
(39, '22', 'N/A', 'HwoNnHOCSP', '2021-09-07 02:40:22', '2021-09-07 02:40:22'),
(40, '22', 'N/A', 'HwoNnHOCSP', '2021-09-07 02:40:25', '2021-09-07 02:40:25'),
(41, '22', 'N/A', 'IrKM2Cf64C', '2021-09-07 02:40:41', '2021-09-07 02:40:41'),
(42, '22', 'N/A', 'IrKM2Cf64C', '2021-09-07 02:40:43', '2021-09-07 02:40:43'),
(43, '22', 'N/A', 'IrKM2Cf64C', '2021-09-07 02:41:11', '2021-09-07 02:41:11'),
(44, '22', 'N/A', 'IrKM2Cf64C', '2021-09-07 02:41:59', '2021-09-07 02:41:59'),
(45, '22', 'N/A', 'IrKM2Cf64C', '2021-09-07 02:42:08', '2021-09-07 02:42:08'),
(46, '22', 'N/A', 'IrKM2Cf64C', '2021-09-07 02:42:43', '2021-09-07 02:42:43'),
(47, '22', 'N/A', 'IrKM2Cf64C', '2021-09-07 02:44:02', '2021-09-07 02:44:02'),
(48, '22', 'N/A', 'IrKM2Cf64C', '2021-09-07 02:44:11', '2021-09-07 02:44:11'),
(49, '22', 'N/A', 'IrKM2Cf64C', '2021-09-07 02:44:26', '2021-09-07 02:44:26'),
(50, '22', 'N/A', 'IrKM2Cf64C', '2021-09-07 02:46:06', '2021-09-07 02:46:06'),
(51, '22', 'N/A', 'IrKM2Cf64C', '2021-09-07 02:46:13', '2021-09-07 02:46:13'),
(52, '22', 'N/A', 'IrKM2Cf64C', '2021-09-07 02:46:19', '2021-09-07 02:46:19'),
(53, '22', 'N/A', 'dEfloFSsp3', '2021-09-07 02:48:50', '2021-09-07 02:48:50'),
(54, '22', 'N/A', 'qtVusKCbcM', '2021-09-07 03:07:44', '2021-09-07 03:07:44');

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
  `address` varchar(255) DEFAULT NULL,
  `phone` int(11) NOT NULL,
  `gender` varchar(15) NOT NULL,
  `dob` date NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '1 for active 0 for inactive',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `candidate_informations`
--

INSERT INTO `candidate_informations` (`id`, `first_name`, `middle_name`, `last_name`, `email`, `address`, `phone`, `gender`, `dob`, `status`, `created_at`, `updated_at`) VALUES
(11, 'a', 'a', 'a', 'o3E7Efh8LO', 'sdf', 1, 'Male', '2021-09-01', 1, '2021-09-07 07:34:31', '2021-09-06 07:10:14'),
(12, 'gPf6D8duc0as', 'XE8wSjfzM1', 'sdfd', 'mpueygfeU5', 'sdf', 2342, 'Male', '2021-09-01', 1, '2021-09-07 00:14:53', '2021-09-07 00:14:53'),
(13, 'a', 'KZYTQ2Hpbs', 'b', 'OFLki2dkTT', 'sdf', 5, 'Male', '2021-09-01', 1, '2021-09-07 07:39:49', '2021-09-07 00:49:54'),
(14, 'gPf6D8duc0as', 'Rf9svZjaPw', 'sdfd', 'Tl3jKz2g3i', 'sdf', 2342, 'Male', '2021-09-01', 1, '2021-09-07 01:02:21', '2021-09-07 01:02:21'),
(15, 'gPf6D8duc0as', 'Rf9svZjaPw', 'sdfd', 'Tl3jKz2g3i', 'sdf', 2342, 'Male', '2021-09-01', 1, '2021-09-07 01:03:26', '2021-09-07 01:03:26'),
(16, 'gPf6D8duc0as', 'sDaStLsQFC', 'sdfd', 'LBsT4ncEuC', 'sdf', 2342, 'Male', '2021-09-01', 1, '2021-09-07 01:03:33', '2021-09-07 01:03:33'),
(17, 'gPf6D8duc0as', 'vasa9VcvGx', 'aa', 'rW5dchhaGt', 'sdf', 2342, 'Male', '2021-09-01', 1, '2021-09-07 01:58:07', '2021-09-07 01:58:07'),
(18, 'gPf6D8duc0as', 'vasa9VcvGx', 'aa', 'rW5dchhaGt', 'sdf', 2342, 'Male', '2021-09-01', 1, '2021-09-07 01:58:23', '2021-09-07 01:58:23'),
(19, 'gPf6D8duc0as', 'vasa9VcvGx', 'sdfd', 'rW5dchhaGt', 'sdf', 2342, 'Male', '2021-09-01', 1, '2021-09-07 01:58:35', '2021-09-07 01:58:35'),
(20, 'gPf6D8duc0as', '2oTUgrRVO1', 'www', '45b59En7dX', 'sdf', 2342, 'Male', '2021-09-01', 1, '2021-09-07 02:06:18', '2021-09-07 02:06:18'),
(21, 'gPf6D8duc0as', 'u8C7N2HPzQ', 'tryu', '5APoilsyCo', 'sdf', 2342, 'Male', '2021-09-01', 1, '2021-09-07 02:07:00', '2021-09-07 02:07:00'),
(22, 'gPf6D8duc0as', 'k1rWoE9JDN', 'fghj', 'VA0suZACJu', 'sdf', 2342, 'Male', '2021-09-01', 1, '2021-09-07 02:07:29', '2021-09-07 02:07:29'),
(23, 'gPf6D8duc0as', 'i6Y252aQka', 'fghj', 'NJtkCaTFkA', 'sdf', 2342, 'Male', '2021-09-01', 1, '2021-09-07 02:17:56', '2021-09-07 02:17:56'),
(24, 'a', 'QvxZYQLLsv', 'a', 'ep0ujRnxJe', 'sdf', 1, 'Male', '2021-09-01', 1, '2021-09-07 02:18:30', '2021-09-07 02:18:30'),
(25, 'a', 'Bd4nEkavWp', 'a', '7sQKwTqRPA', 'sdf', 1, 'Male', '2021-09-01', 1, '2021-09-07 02:29:38', '2021-09-07 02:29:38'),
(26, 'a', 'Bd4nEkavWp', 'a', '7sQKwTqRPA', 'sdf', 1, 'Male', '2021-09-01', 1, '2021-09-07 02:29:56', '2021-09-07 02:29:56'),
(27, 'a', 'Bd4nEkavWp', 'dd', '7sQKwTqRPA', 'sdf', 1, 'Male', '2021-09-01', 1, '2021-09-07 02:32:00', '2021-09-07 02:32:00'),
(28, 'a', 'Bd4nEkavWp', 'a', '7sQKwTqRPA', 'sdf', 1, 'Male', '2021-09-01', 1, '2021-09-07 02:34:09', '2021-09-07 02:34:09'),
(29, 'a', 'Bd4nEkavWp', 'a', '7sQKwTqRPA', 'sdf', 1, 'Male', '2021-09-01', 1, '2021-09-07 02:34:35', '2021-09-07 02:34:35'),
(30, 'a', 'Bd4nEkavWp', 'a', '7sQKwTqRPA', 'sdf', 1, 'Male', '2021-09-01', 1, '2021-09-07 02:34:53', '2021-09-07 02:34:53'),
(31, 'a', 'Bd4nEkavWp', 'sadasd', '7sQKwTqRPA', 'sdf', 1, 'Male', '2021-09-01', 1, '2021-09-07 02:36:41', '2021-09-07 02:36:41'),
(32, 'a', 'Bd4nEkavWp', 'ssd', '7sQKwTqRPA', 'sdf', 1, 'Male', '2021-09-01', 1, '2021-09-07 02:38:01', '2021-09-07 02:38:01'),
(33, 'a', 'Bd4nEkavWp', '3', '7sQKwTqRPA', 'sdf', 1, 'Male', '2021-09-01', 1, '2021-09-07 02:38:46', '2021-09-07 02:38:46'),
(34, 'a', 'Bd4nEkavWp', 'a', '7sQKwTqRPA', 'sdf', 1, 'Male', '2021-09-01', 1, '2021-09-07 02:38:51', '2021-09-07 02:38:51'),
(35, 'a', 'Bd4nEkavWp', 'sdfd', '7sQKwTqRPA', 'sdf', 1, 'Male', '2021-09-01', 1, '2021-09-07 02:39:02', '2021-09-07 02:39:02'),
(36, 'gPf6D8duc0as', 'Bd4nEkavWp', 'sdfd', '7sQKwTqRPA', 'sdf', 1, 'Male', '2021-09-01', 1, '2021-09-07 02:39:15', '2021-09-07 02:39:15'),
(37, 'gPf6D8duc0as', 'Bd4nEkavWp', 'sdfd', '7sQKwTqRPA', 'sdf', 2342, 'Male', '2021-09-01', 1, '2021-09-07 02:39:25', '2021-09-07 02:39:25'),
(38, 'a', 'Bd4nEkavWp', 'b', '7sQKwTqRPA', 'sdf', 5, 'Male', '2021-09-01', 1, '2021-09-07 02:40:13', '2021-09-07 02:40:13'),
(39, 'a', 'Bd4nEkavWp', 'a', '7sQKwTqRPA', 'sdf', 5, 'Male', '2021-09-01', 1, '2021-09-07 02:40:22', '2021-09-07 02:40:22'),
(40, 'a', 'Bd4nEkavWp', 'a', '7sQKwTqRPA', 'sdf', 1, 'Male', '2021-09-01', 1, '2021-09-07 02:40:25', '2021-09-07 02:40:25'),
(41, 'a', 'xWddGPzDYv', 'a', 'bZzE9fSRtb', 'sdf', 1, 'Male', '2021-09-01', 1, '2021-09-07 02:40:41', '2021-09-07 02:40:41'),
(42, 'a', 'xWddGPzDYv', 'a', 'bZzE9fSRtb', 'sdf', 1, 'Male', '2021-09-01', 1, '2021-09-07 02:40:43', '2021-09-07 02:40:43'),
(43, 'a', 'xWddGPzDYv', 'h', 'bZzE9fSRtb', 'sdf', 1, 'Male', '2021-09-01', 1, '2021-09-07 02:41:11', '2021-09-07 02:41:11'),
(44, 'asd', 'xWddGPzDYv', 'asd', 'bZzE9fSRtb3', 'sdf', 34, 'Male', '2021-09-01', 1, '2021-09-07 02:41:59', '2021-09-07 02:41:59'),
(45, 'asd', 'xWddGPzDYv', 'asdd', 'bZzE9fSRtb3', 'sdf', 34, 'Male', '2021-09-01', 1, '2021-09-07 02:42:08', '2021-09-07 02:42:08'),
(46, 'asddd', 'xWddGPzDYv', 'asddd', 'bZzE9fSRtb3', 'sdf', 34, 'Male', '2021-09-01', 1, '2021-09-07 02:42:43', '2021-09-07 02:42:43'),
(47, 'asdddd', 'xWddGPzDYv', 'asddd', 'bZzE9fSRtb3', 'sdf', 34, 'Male', '2021-09-01', 1, '2021-09-07 02:44:02', '2021-09-07 02:44:02'),
(48, 'asdddd', 'xWddGPzDYv', 'asddd', 'bZzE9fSRtb3', 'sdf', 34, 'Male', '2021-09-01', 1, '2021-09-07 02:44:11', '2021-09-07 02:44:11'),
(49, 'asdddd', 'xWddGPzDYv', 'asddd', 'bZzE9fSRtb3', 'sdf', 34, 'Male', '2021-09-01', 1, '2021-09-07 02:44:26', '2021-09-07 02:44:26'),
(50, 'asddddsds', 'xWddGPzDYv', 'asddd', 'bZzE9fSRtb3', 'sdf', 34, 'Male', '2021-09-01', 1, '2021-09-07 02:46:06', '2021-09-07 02:46:06'),
(51, 'asddddsdss', 'xWddGPzDYv', 'asddd', 'bZzE9fSRtb3', 'sdf', 34, 'Male', '2021-09-01', 1, '2021-09-07 02:46:12', '2021-09-07 02:46:12'),
(52, 'asddddsdss', 'xWddGPzDYv', 'asddds', 'bZzE9fSRtb3', 'sdf', 34, 'Male', '2021-09-01', 1, '2021-09-07 02:46:19', '2021-09-07 02:46:19'),
(53, 'asddddsdss', 'K0nHyixnDz', 'asdddsd', 'bZzE9fSRtb3', 'sdf', 34, 'Male', '2021-09-01', 1, '2021-09-07 02:48:50', '2021-09-07 02:48:50'),
(54, 'asddd5dsdss', 'EVaCVwDCTE', 'asdddsd', 'bZzE9fSRtb3', 'sdf', 34, 'Male', '2021-09-01', 1, '2021-09-07 03:07:44', '2021-09-07 03:07:44');

-- --------------------------------------------------------

--
-- Table structure for table `candidate_positions`
--

CREATE TABLE `candidate_positions` (
  `id` int(11) NOT NULL,
  `candidate_id` int(11) NOT NULL,
  `candidate_profile` int(11) NOT NULL,
  `position_applied` varchar(255) NOT NULL,
  `date_invited` date NOT NULL,
  `manner_of_invite` int(11) NOT NULL,
  `curr_salary` bigint(20) NOT NULL COMMENT 'current',
  `exp_salary` bigint(20) NOT NULL COMMENT 'expected',
  `off_salary` bigint(20) NOT NULL COMMENT 'offered',
  `curr_allowance` bigint(20) NOT NULL,
  `off_allowance` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `candidate_positions`
--

INSERT INTO `candidate_positions` (`id`, `candidate_id`, `candidate_profile`, `position_applied`, `date_invited`, `manner_of_invite`, `curr_salary`, `exp_salary`, `off_salary`, `curr_allowance`, `off_allowance`, `created_at`, `updated_at`) VALUES
(4, 11, 71, 'AMhUtEcD3x', '2021-09-08', 67, 626156, 212, 364920, 420882, 477675, '2021-09-06 07:10:14', '2021-09-06 07:10:14'),
(5, 12, 71, 'kOG3AqtK63', '2021-09-08', 67, 396937, 212, 728331, 108170, 316706, '2021-09-07 00:14:53', '2021-09-07 00:14:53'),
(6, 13, 71, 'l9jvodddZh', '2021-09-08', 67, 891784, 212, 733730, 853165, 560343, '2021-09-07 00:49:54', '2021-09-07 00:49:54'),
(7, 14, 71, 'qtRKQtVP2o', '2021-09-08', 67, 343427, 212, 82164, 22145, 195133, '2021-09-07 01:02:21', '2021-09-07 01:02:21'),
(8, 15, 71, 'qtRKQtVP2o', '2021-09-08', 67, 343427, 212, 82164, 22145, 195133, '2021-09-07 01:03:26', '2021-09-07 01:03:26'),
(9, 16, 71, '1h2ZpZvEH9', '2021-09-08', 67, 551879, 212, 252440, 597488, 750230, '2021-09-07 01:03:33', '2021-09-07 01:03:33'),
(10, 17, 71, '2DwQrCNn0b', '2021-09-08', 67, 753243, 212, 130132, 777391, 701402, '2021-09-07 01:58:07', '2021-09-07 01:58:07'),
(11, 18, 71, '2DwQrCNn0b', '2021-09-08', 67, 753243, 212, 130132, 777391, 701402, '2021-09-07 01:58:23', '2021-09-07 01:58:23'),
(12, 19, 71, '2DwQrCNn0b', '2021-09-08', 67, 753243, 212, 130132, 777391, 701402, '2021-09-07 01:58:35', '2021-09-07 01:58:35'),
(13, 20, 71, 'OFUB16DPA7', '2021-09-08', 67, 707604, 212, 28038, 668897, 866968, '2021-09-07 02:06:18', '2021-09-07 02:06:18'),
(14, 21, 71, 'D5h2YzHN5c', '2021-09-08', 67, 718806, 212, 140075, 205341, 886984, '2021-09-07 02:07:00', '2021-09-07 02:07:00'),
(15, 22, 71, '5dTXGdwLZF', '2021-09-08', 67, 732455, 212, 819680, 900357, 337261, '2021-09-07 02:07:29', '2021-09-07 02:07:29'),
(16, 23, 71, 'GCsIzKRZcR', '2021-09-08', 67, 521894, 212, 153107, 300929, 879909, '2021-09-07 02:17:56', '2021-09-07 02:17:56'),
(17, 24, 71, 'uONOgujxg6', '2021-09-08', 67, 955225, 212, 36023, 885932, 276593, '2021-09-07 02:18:30', '2021-09-07 02:18:30'),
(18, 25, 71, 'FmMyYFuCTC', '2021-09-08', 67, 192304, 212, 261692, 878021, 656985, '2021-09-07 02:29:38', '2021-09-07 02:29:38'),
(19, 26, 71, 'FmMyYFuCTC', '2021-09-08', 67, 192304, 212, 261692, 878021, 656985, '2021-09-07 02:29:56', '2021-09-07 02:29:56'),
(20, 27, 71, 'FmMyYFuCTC', '2021-09-08', 67, 192304, 212, 261692, 878021, 656985, '2021-09-07 02:32:00', '2021-09-07 02:32:00'),
(21, 28, 71, 'FmMyYFuCTC', '2021-09-08', 67, 192304, 212, 261692, 878021, 656985, '2021-09-07 02:34:09', '2021-09-07 02:34:09'),
(22, 29, 71, 'FmMyYFuCTC', '2021-09-08', 67, 192304, 212, 261692, 878021, 656985, '2021-09-07 02:34:35', '2021-09-07 02:34:35'),
(23, 30, 71, 'FmMyYFuCTC', '2021-09-08', 67, 192304, 212, 261692, 878021, 656985, '2021-09-07 02:34:53', '2021-09-07 02:34:53'),
(24, 31, 71, 'FmMyYFuCTC', '2021-09-08', 67, 192304, 212, 261692, 878021, 656985, '2021-09-07 02:36:41', '2021-09-07 02:36:41'),
(25, 32, 71, 'FmMyYFuCTC', '2021-09-08', 67, 192304, 212, 261692, 878021, 656985, '2021-09-07 02:38:01', '2021-09-07 02:38:01'),
(26, 33, 71, 'FmMyYFuCTC', '2021-09-08', 67, 192304, 212, 261692, 878021, 656985, '2021-09-07 02:38:46', '2021-09-07 02:38:46'),
(27, 34, 71, 'FmMyYFuCTC', '2021-09-08', 67, 192304, 212, 261692, 878021, 656985, '2021-09-07 02:38:51', '2021-09-07 02:38:51'),
(28, 35, 71, 'FmMyYFuCTC', '2021-09-08', 67, 192304, 212, 261692, 878021, 656985, '2021-09-07 02:39:02', '2021-09-07 02:39:02'),
(29, 36, 71, 'FmMyYFuCTC', '2021-09-08', 67, 192304, 212, 261692, 878021, 656985, '2021-09-07 02:39:15', '2021-09-07 02:39:15'),
(30, 37, 71, 'FmMyYFuCTC', '2021-09-08', 67, 192304, 212, 261692, 878021, 656985, '2021-09-07 02:39:25', '2021-09-07 02:39:25'),
(31, 38, 71, 'FmMyYFuCTC', '2021-09-08', 67, 192304, 212, 261692, 878021, 656985, '2021-09-07 02:40:13', '2021-09-07 02:40:13'),
(32, 39, 71, 'FmMyYFuCTC', '2021-09-08', 67, 192304, 212, 261692, 878021, 656985, '2021-09-07 02:40:22', '2021-09-07 02:40:22'),
(33, 40, 71, 'FmMyYFuCTC', '2021-09-08', 67, 192304, 212, 261692, 878021, 656985, '2021-09-07 02:40:25', '2021-09-07 02:40:25'),
(34, 41, 71, 'oho0yZqB2t', '2021-09-08', 67, 613103, 212, 794038, 450575, 514962, '2021-09-07 02:40:41', '2021-09-07 02:40:41'),
(35, 42, 71, 'oho0yZqB2t', '2021-09-08', 67, 613103, 212, 794038, 450575, 514962, '2021-09-07 02:40:43', '2021-09-07 02:40:43'),
(36, 43, 71, 'oho0yZqB2t', '2021-09-08', 67, 613103, 212, 794038, 450575, 514962, '2021-09-07 02:41:11', '2021-09-07 02:41:11'),
(37, 44, 71, 'oho0yZqB2t', '2021-09-08', 67, 613103, 212, 794038, 450575, 514962, '2021-09-07 02:41:59', '2021-09-07 02:41:59'),
(38, 45, 71, 'oho0yZqB2t', '2021-09-08', 67, 613103, 212, 794038, 450575, 514962, '2021-09-07 02:42:08', '2021-09-07 02:42:08'),
(39, 46, 71, 'oho0yZqB2t', '2021-09-08', 67, 613103, 212, 794038, 450575, 514962, '2021-09-07 02:42:43', '2021-09-07 02:42:43'),
(40, 47, 71, 'oho0yZqB2t', '2021-09-08', 67, 613103, 212, 794038, 450575, 514962, '2021-09-07 02:44:02', '2021-09-07 02:44:02'),
(41, 48, 71, 'oho0yZqB2t', '2021-09-08', 67, 613103, 212, 794038, 450575, 514962, '2021-09-07 02:44:11', '2021-09-07 02:44:11'),
(42, 49, 71, 'oho0yZqB2t', '2021-09-08', 67, 613103, 212, 794038, 450575, 514962, '2021-09-07 02:44:26', '2021-09-07 02:44:26'),
(43, 50, 71, 'oho0yZqB2t', '2021-09-08', 67, 613103, 212, 794038, 450575, 514962, '2021-09-07 02:46:06', '2021-09-07 02:46:06'),
(44, 51, 71, 'oho0yZqB2t', '2021-09-08', 67, 613103, 212, 794038, 450575, 514962, '2021-09-07 02:46:13', '2021-09-07 02:46:13'),
(45, 52, 71, 'oho0yZqB2t', '2021-09-08', 67, 613103, 212, 794038, 450575, 514962, '2021-09-07 02:46:19', '2021-09-07 02:46:19'),
(46, 53, 71, '6XXZvjol6U', '2021-09-08', 67, 575684, 212, 382102, 881300, 165435, '2021-09-07 02:48:50', '2021-09-07 02:48:50'),
(47, 54, 71, 'wdALsrJBTd', '2021-09-08', 67, 579715, 212, 2121525252, 251562, 54455242525, '2021-09-07 03:07:44', '2021-09-07 03:07:44');

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
  `c_hires` text COLLATE utf8mb4_unicode_ci COMMENT 'Project Base and Contractual hires',
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
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `domains`
--

INSERT INTO `domains` (`id`, `domain_name`, `created_at`, `updated_at`) VALUES
(1, 'TECHNOLOGY', '2021-09-08 07:10:38', '2021-09-08 07:10:38'),
(2, 'CORPORATE FUNCTIONS', '2021-09-08 07:10:38', '2021-09-08 07:10:38'),
(3, 'OPERATIONS', '2021-09-08 07:10:38', '2021-09-08 07:10:38');

-- --------------------------------------------------------

--
-- Table structure for table `drop_downs`
--

CREATE TABLE `drop_downs` (
  `id` int(11) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `drop_downs`
--

INSERT INTO `drop_downs` (`id`, `type`, `name`, `created_at`, `updated_at`) VALUES
(1, 'application_status', 'Application status', '2021-08-25 07:53:06', '2021-08-25 07:53:06'),
(2, 'candidates_profile', 'Candidates profile', '2021-08-25 07:53:06', '2021-08-25 07:53:06'),
(3, 'career_level', 'Career level', '2021-08-25 07:53:06', '2021-08-25 07:53:06'),
(5, 'course', 'COURSE', '2021-09-03 06:40:53', '2021-09-03 06:40:53'),
(6, 'educational_attainment', 'EDUCATIONAL_ATTAINTMENT', '2021-09-03 06:41:43', '2021-09-03 06:41:43'),
(7, 'domains', 'Domains', '2021-09-06 11:08:31', '2021-09-06 11:08:31'),
(8, 'segments', 'SEGMENTS', '2021-09-06 11:12:43', '2021-09-06 11:12:43'),
(9, 'sub_segment', 'SUB SEGMENTS', '2021-09-06 11:25:16', '2021-09-06 11:25:16'),
(10, 'manner_of_invite', 'MANNER OF INVITE', '2021-09-06 11:36:30', '2021-09-06 11:36:30'),
(12, 'position_title', 'Position Title', '2021-09-07 03:03:55', '2021-09-07 03:03:55'),
(13, 'reason_for_not_progressing', 'Reason For Not Progressing', '2021-09-07 03:04:59', '2021-09-07 03:04:59'),
(15, 'status', 'Status', '2021-09-07 03:06:17', '2021-09-07 03:06:17'),
(16, 'clients', 'Clients', '2021-09-07 03:06:38', '2021-09-07 03:06:38'),
(17, 'endorsement_type', 'Endorsement Type', '2021-09-07 03:07:02', '2021-09-07 03:07:02'),
(18, 'remarks_from_finance', 'Remarks (From Finance)', '2021-09-07 09:15:20', '2021-09-07 09:15:20'),
(19, 'sight', 'Sight', '2021-09-07 09:15:20', '2021-09-07 09:15:20'),
(20, 'source', 'SOURCE', '2021-09-08 06:27:07', '2021-09-08 06:27:07'),
(21, 'gender', 'GENDER', '2021-09-08 06:39:42', '2021-09-08 06:39:42'),
(22, 'certifications', 'CERTIFICATIONS', '2021-09-08 06:50:50', '2021-09-08 06:50:50'),
(23, 'remarks_for_finance', 'REMARKS (For Finance)', '2021-09-08 07:00:54', '2021-09-08 07:00:54');

-- --------------------------------------------------------

--
-- Table structure for table `drop_down_options`
--

CREATE TABLE `drop_down_options` (
  `id` int(11) NOT NULL,
  `drop_down_id` int(11) NOT NULL,
  `sec_dropdown_id` int(11) DEFAULT NULL,
  `option_name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 for active 0 for inactive',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `drop_down_options`
--

INSERT INTO `drop_down_options` (`id`, `drop_down_id`, `sec_dropdown_id`, `option_name`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, NULL, 'Active File', 1, '2021-08-26 06:50:20', '2021-08-26 06:50:20'),
(11, 4, 1, 't1i', 1, '2021-08-30 06:40:15', '2021-08-30 04:35:54'),
(12, 4, 1, 't2i', 1, '2021-08-30 06:40:15', '2021-08-30 06:40:15'),
(13, 4, 1, 't3i', 1, '2021-08-30 06:40:15', '2021-08-30 06:40:15'),
(14, 4, 2, 't1m', 0, '2021-08-30 07:00:29', '2021-08-30 02:23:24'),
(15, 4, 2, 't2m', 1, '2021-08-30 07:00:29', '2021-08-30 07:00:29'),
(16, 4, 3, 't1f', 1, '2021-08-30 07:19:46', '2021-08-30 07:19:46'),
(17, 4, 3, 't2f', 1, '2021-08-30 07:19:46', '2021-08-30 07:19:46'),
(21, 6, NULL, 'ASSOCIATE COURSE GRADUATE', 1, '2021-09-03 06:44:42', '2021-09-03 06:44:42'),
(22, 6, NULL, 'DOCTORIATE', 1, '2021-09-03 06:44:58', '2021-09-03 06:44:58'),
(23, 6, NULL, 'GRADUATE', 1, '2021-09-03 06:45:11', '2021-09-03 06:45:11'),
(24, 6, NULL, 'HIGH SCHOOL GRADUATE', 1, '2021-09-03 06:45:25', '2021-09-03 06:45:25'),
(25, 6, NULL, 'MASTERS', 1, '2021-09-03 06:45:40', '2021-09-03 06:45:40'),
(26, 6, NULL, 'MBA', 1, '2021-09-03 06:45:53', '2021-09-03 06:45:53'),
(27, 6, NULL, 'SENIOR HIGH SCHOOL GRADUATE', 1, '2021-09-03 06:46:05', '2021-09-03 06:46:05'),
(28, 6, NULL, 'UNDERGRADUATE', 1, '2021-09-03 06:46:15', '2021-09-03 06:46:15'),
(29, 6, NULL, 'VOCATIONAL', 1, '2021-09-03 06:46:25', '2021-09-03 06:46:25'),
(32, 7, NULL, 'OPERATIONS', 1, '2021-09-06 11:10:03', '2021-09-06 11:10:03'),
(33, 7, NULL, 'TECHNOLOGY', 1, '2021-09-06 11:10:03', '2021-09-06 11:10:03'),
(34, 7, NULL, 'CORPORATE FUNCTIONS', 1, '2021-09-06 11:10:03', '2021-09-06 11:10:03'),
(35, 8, NULL, 'Data Management', 1, '2021-09-06 11:18:55', '2021-09-06 11:18:55'),
(36, 0, 8, 'Database Management', 1, '2021-09-06 11:18:55', '2021-09-06 11:18:55'),
(40, 8, 0, 'Solutions Architecture', 1, '2021-09-06 11:18:55', '2021-09-06 11:18:55'),
(45, 8, NULL, 'ERP', 1, '2021-09-06 11:22:48', '2021-09-06 11:22:48'),
(49, 8, NULL, 'Support and Infrastructure', 1, '2021-09-06 11:22:48', '2021-09-06 11:22:48'),
(54, 8, NULL, 'Project Management', 1, '2021-09-06 11:22:48', '2021-09-06 11:22:48'),
(55, 8, NULL, 'Software Development Life Cycle', 1, '2021-09-06 11:22:48', '2021-09-06 11:22:48'),
(61, 9, NULL, 'Coupa', 1, '2021-09-06 11:26:59', '2021-09-06 11:26:59'),
(62, 9, NULL, 'HCM', 1, '2021-09-06 11:26:59', '2021-09-06 11:26:59'),
(63, 9, NULL, 'Netsuite', 1, '2021-09-06 11:26:59', '2021-09-06 11:26:59'),
(64, 9, NULL, 'test sub segment', 1, '2021-09-06 11:26:59', '2021-09-06 11:26:59'),
(65, 9, NULL, 'Webmethods', 1, '2021-09-06 11:26:59', '2021-09-06 11:26:59'),
(66, 9, NULL, 'Workday', 1, '2021-09-06 11:26:59', '2021-09-06 11:26:59'),
(71, 2, NULL, 'IT Security Audit', 1, '2021-09-06 07:01:15', '2021-09-06 07:01:15'),
(72, 2, NULL, '.Net Developer', 1, '2021-09-06 07:01:18', '2021-09-06 07:01:18'),
(73, 2, NULL, 'Account Coordinator', 1, '2021-09-07 01:36:54', '2021-09-07 01:36:54'),
(74, 2, NULL, 'Account Manager', 1, '2021-09-07 01:37:00', '2021-09-07 01:37:00'),
(75, 2, NULL, 'Accounts Payable', 1, '2021-09-07 01:37:06', '2021-09-07 01:37:06'),
(76, 2, NULL, 'Accounts Receivable', 1, '2021-09-07 01:37:12', '2021-09-07 01:37:12'),
(77, 2, NULL, 'AD of Procurement & Sourcing', 1, '2021-09-07 01:37:17', '2021-09-07 01:37:17'),
(78, 2, NULL, 'Admin', 1, '2021-09-07 01:37:23', '2021-09-07 01:37:23'),
(79, 2, NULL, 'AEM Specialist', 1, '2021-09-07 01:37:27', '2021-09-07 01:37:27'),
(80, 2, NULL, 'Analytics (Operation)', 1, '2021-09-07 01:37:32', '2021-09-07 01:37:32'),
(81, 2, NULL, 'Analytics (Tech)', 1, '2021-09-07 01:39:31', '2021-09-07 01:39:31'),
(82, 2, NULL, 'Android Developer', 1, '2021-09-07 01:39:45', '2021-09-07 01:39:45'),
(83, 2, NULL, 'Animator', 1, '2021-09-07 06:41:56', '2021-09-07 06:41:56'),
(84, 2, NULL, 'Art Director', 1, '2021-09-07 06:54:50', '2021-09-07 06:54:50'),
(85, 2, NULL, 'Asset Protection Administrator', 1, '2021-09-07 06:54:50', '2021-09-07 06:54:50'),
(86, 2, NULL, 'Associate Software Engineer', 1, '2021-09-07 06:54:50', '2021-09-07 06:54:50'),
(87, 2, NULL, 'Audit Associate', 1, '2021-09-07 06:54:50', '2021-09-07 06:54:50'),
(88, 2, NULL, 'Audit Lead', 1, '2021-09-07 06:54:50', '2021-09-07 06:54:50'),
(89, 2, NULL, 'Audit Manager', 1, '2021-09-07 06:54:50', '2021-09-07 06:54:50'),
(90, 2, NULL, 'Azure', 1, '2021-09-07 06:54:50', '2021-09-07 06:54:50'),
(91, 2, NULL, 'Back end developer', 1, '2021-09-07 06:57:00', '2021-09-07 06:57:00'),
(92, 2, NULL, 'BI Developer', 1, '2021-09-07 06:57:00', '2021-09-07 06:57:00'),
(93, 2, NULL, 'Biligual', 1, '2021-09-07 06:57:00', '2021-09-07 06:57:00'),
(94, 2, NULL, 'Billing', 1, '2021-09-07 06:57:00', '2021-09-07 06:57:00'),
(95, 2, NULL, 'Bot Builder', 1, '2021-09-07 06:57:00', '2021-09-07 06:57:00'),
(96, 2, NULL, 'Brand Marketing', 1, '2021-09-07 06:57:00', '2021-09-07 06:57:00'),
(97, 2, NULL, 'Budgeting and Forecasting', 1, '2021-09-07 06:57:00', '2021-09-07 06:57:00'),
(98, 2, NULL, 'Business Analyst', 1, '2021-09-07 07:24:08', '2021-09-07 07:24:08'),
(99, 2, NULL, 'Business Development', 1, '2021-09-07 07:24:08', '2021-09-07 07:24:08'),
(100, 2, NULL, 'Business Excellence Analyst', 1, '2021-09-07 07:24:08', '2021-09-07 07:24:08'),
(101, 2, NULL, 'Business Intelligence', 1, '2021-09-07 07:24:08', '2021-09-07 07:24:08'),
(102, 2, NULL, 'C++ Developer', 1, '2021-09-07 07:24:08', '2021-09-07 07:24:08'),
(103, 2, NULL, 'Campaign Marketing', 1, '2021-09-07 07:24:08', '2021-09-07 07:24:08'),
(104, 2, NULL, 'Campus Sourcing Lead', 1, '2021-09-07 07:24:08', '2021-09-07 07:24:08'),
(105, 2, NULL, 'Catalouging Analyst', 1, '2021-09-07 07:24:08', '2021-09-07 07:24:08'),
(106, 2, NULL, 'Chat Support Representative', 1, '2021-09-07 07:24:08', '2021-09-07 07:24:08'),
(107, 2, NULL, 'Citrix Engineer', 1, '2021-09-07 07:24:08', '2021-09-07 07:24:08'),
(108, 2, NULL, 'Classroom Training (soft Skill/product)', 1, '2021-09-07 07:24:08', '2021-09-07 07:24:08'),
(109, 2, NULL, 'Classroom Training (soft Skill/product)', 1, '2021-09-07 07:24:08', '2021-09-07 07:24:08'),
(110, 2, NULL, 'Cleaning Services', 1, '2021-09-07 07:24:08', '2021-09-07 07:24:08'),
(111, 2, NULL, 'Client Services Magement', 1, '2021-09-07 07:24:08', '2021-09-07 07:24:08'),
(112, 2, NULL, 'Cloud Engineer', 1, '2021-09-07 07:24:08', '2021-09-07 07:24:08'),
(113, 2, NULL, 'Collaboration Architect', 1, '2021-09-07 07:24:08', '2021-09-07 07:24:08'),
(114, 2, NULL, 'Collections', 1, '2021-09-07 07:24:08', '2021-09-07 07:24:08'),
(115, 2, NULL, 'Compensation & Benefits Lead', 1, '2021-09-07 07:24:08', '2021-09-07 07:24:08'),
(116, 2, NULL, 'Compliance (tech)', 1, '2021-09-07 07:24:08', '2021-09-07 07:24:08'),
(117, 2, NULL, 'Compliance Analyst', 1, '2021-09-07 07:24:08', '2021-09-07 07:24:08'),
(118, 2, NULL, 'Concierge Analyst', 1, '2021-09-07 07:24:08', '2021-09-07 07:24:08'),
(119, 2, NULL, 'Configuration Management Database', 1, '2021-09-07 07:24:08', '2021-09-07 07:24:08'),
(120, 2, NULL, 'Content (elearnning)', 1, '2021-09-07 07:24:08', '2021-09-07 07:24:08'),
(121, 2, NULL, 'Content Administrator (elearnning)', 1, '2021-09-07 07:31:35', '2021-09-07 07:31:35'),
(122, 2, NULL, 'Contract Management', 1, '2021-09-07 07:31:35', '2021-09-07 07:31:35'),
(123, 2, NULL, 'Contract Management Lawyer', 1, '2021-09-07 07:31:35', '2021-09-07 07:31:35'),
(124, 2, NULL, 'Creative Designer', 1, '2021-09-07 07:31:35', '2021-09-07 07:31:35'),
(125, 2, NULL, 'CRM S/4 HANA', 1, '2021-09-07 07:31:35', '2021-09-07 07:31:35'),
(126, 2, NULL, 'Customer Service Representative', 1, '2021-09-07 07:31:35', '2021-09-07 07:31:35'),
(127, 2, NULL, 'Cyber Security', 1, '2021-09-07 07:31:35', '2021-09-07 07:31:35'),
(128, 2, NULL, 'Data Analyst (operation)', 1, '2021-09-07 07:31:35', '2021-09-07 07:31:35'),
(129, 2, NULL, 'Data Analyst (tech)', 1, '2021-09-07 07:31:35', '2021-09-07 07:31:35'),
(130, 2, NULL, 'Data Engineer', 1, '2021-09-07 07:31:35', '2021-09-07 07:31:35'),
(131, 2, NULL, 'Data Science (operation)', 1, '2021-09-07 07:31:35', '2021-09-07 07:31:35'),
(132, 2, NULL, 'Data Science (tech)', 1, '2021-09-07 07:31:35', '2021-09-07 07:31:35'),
(133, 2, NULL, 'Data Visualization', 1, '2021-09-07 07:31:35', '2021-09-07 07:31:35'),
(134, 2, NULL, 'Database Administrator', 1, '2021-09-07 07:31:35', '2021-09-07 07:31:35'),
(135, 2, NULL, 'Desktop Engineer', 1, '2021-09-07 07:31:35', '2021-09-07 07:31:35'),
(136, 2, NULL, 'Devops', 1, '2021-09-07 07:31:35', '2021-09-07 07:31:35'),
(137, 2, NULL, 'Digital Marketer', 1, '2021-09-07 07:31:35', '2021-09-07 07:31:35'),
(138, 2, NULL, 'Director Of Operations', 1, '2021-09-07 07:31:35', '2021-09-07 07:31:35'),
(139, 2, NULL, 'Director Of Transformation', 1, '2021-09-07 07:31:35', '2021-09-07 07:31:35'),
(140, 2, NULL, 'Dpa Officer', 1, '2021-09-07 07:31:35', '2021-09-07 07:31:35'),
(141, 2, NULL, 'Drupal Developer', 1, '2021-09-07 07:31:35', '2021-09-07 07:31:35'),
(142, 2, NULL, 'E-mail Marketing', 1, '2021-09-07 07:31:35', '2021-09-07 07:31:35'),
(143, 2, NULL, 'Electrical Maintenance', 1, '2021-09-07 07:31:35', '2021-09-07 07:31:35'),
(144, 2, NULL, 'Embedded Software Engineer', 1, '2021-09-07 07:31:35', '2021-09-07 07:31:35'),
(145, 2, NULL, 'Emc Data Domain Operations', 1, '2021-09-07 07:31:35', '2021-09-07 07:31:35'),
(146, 2, NULL, 'Enterprise Storage Administrator', 1, '2021-09-07 07:31:35', '2021-09-07 07:31:35'),
(147, 2, NULL, 'Enterprise Support Specialist', 1, '2021-09-07 07:31:35', '2021-09-07 07:31:35'),
(148, 2, NULL, 'ERP/HCM SALES', 1, '2021-09-07 07:31:35', '2021-09-07 07:31:35'),
(149, 2, NULL, 'Executive Assistant', 1, '2021-09-07 07:34:04', '2021-09-07 07:34:04'),
(150, 2, NULL, 'Facilities Management', 1, '2021-09-07 07:34:04', '2021-09-07 07:34:04'),
(151, 2, NULL, 'Finance Analytics Specialist', 1, '2021-09-07 07:34:04', '2021-09-07 07:34:04'),
(152, 2, NULL, 'Finance Controller', 1, '2021-09-07 07:34:04', '2021-09-07 07:34:04'),
(153, 2, NULL, 'Financial Reporting', 1, '2021-09-07 07:34:04', '2021-09-07 07:34:04'),
(154, 2, NULL, 'Fire Alarm & Cctv', 1, '2021-09-07 07:34:04', '2021-09-07 07:34:04'),
(155, 2, NULL, 'Front End Developer', 1, '2021-09-07 07:38:41', '2021-09-07 07:38:41'),
(156, 2, NULL, 'FULL STACK DEVELOPER', 1, '2021-09-07 07:38:41', '2021-09-07 07:38:41'),
(157, 2, NULL, 'General Ledger', 1, '2021-09-07 07:38:41', '2021-09-07 07:38:41'),
(158, 2, NULL, 'Graphic Designer', 1, '2021-09-07 07:38:41', '2021-09-07 07:38:41'),
(159, 2, NULL, 'Head Of Business Continuity', 1, '2021-09-07 07:38:41', '2021-09-07 07:38:41'),
(160, 2, NULL, 'Head Of It', 1, '2021-09-07 07:38:41', '2021-09-07 07:38:41'),
(161, 2, NULL, 'Hospitality Services', 1, '2021-09-07 07:38:41', '2021-09-07 07:38:41'),
(162, 2, NULL, 'Hosting & Server Engineer', 1, '2021-09-07 07:38:41', '2021-09-07 07:38:41'),
(163, 2, NULL, 'HR Analytics Lead', 1, '2021-09-07 07:38:41', '2021-09-07 07:38:41'),
(164, 2, NULL, 'HR Employee Relations Director', 1, '2021-09-07 07:38:41', '2021-09-07 07:38:41'),
(165, 2, NULL, 'HR Health & Welness', 1, '2021-09-07 07:38:41', '2021-09-07 07:38:41'),
(166, 2, NULL, 'HR Operations', 1, '2021-09-07 07:38:41', '2021-09-07 07:38:41'),
(167, 2, NULL, 'HR Organizational Developement Lead', 1, '2021-09-07 07:38:41', '2021-09-07 07:38:41'),
(168, 2, NULL, 'HRBP', 1, '2021-09-07 07:38:41', '2021-09-07 07:38:41'),
(169, 2, NULL, 'HVAC Maintenenance', 1, '2021-09-07 07:38:41', '2021-09-07 07:38:41'),
(170, 2, NULL, 'Identity & Access Management Specialist', 1, '2021-09-07 07:38:41', '2021-09-07 07:38:41'),
(171, 2, NULL, 'Implementation/ Support Engineer', 1, '2021-09-07 07:38:41', '2021-09-07 07:38:41'),
(172, 2, NULL, 'Incident Management', 1, '2021-09-07 07:38:41', '2021-09-07 07:38:41'),
(173, 2, NULL, 'Infrastructure Service Management', 1, '2021-09-07 07:38:41', '2021-09-07 07:38:41'),
(174, 2, NULL, 'Instructional Designer', 1, '2021-09-07 07:38:41', '2021-09-07 07:38:41'),
(175, 2, NULL, 'Instructional Designer', 1, '2021-09-07 07:38:41', '2021-09-07 07:38:41'),
(176, 2, NULL, 'Integration Engineer', 1, '2021-09-07 07:46:49', '2021-09-07 07:46:49'),
(177, 2, NULL, 'Internal & External Communications Marketing', 1, '2021-09-07 07:46:49', '2021-09-07 07:46:49'),
(178, 2, NULL, 'IOS Developer', 1, '2021-09-07 07:46:49', '2021-09-07 07:46:49'),
(179, 2, NULL, 'IT Director', 1, '2021-09-07 07:46:49', '2021-09-07 07:46:49'),
(180, 2, NULL, 'IT Security Manager', 1, '2021-09-07 07:46:49', '2021-09-07 07:46:49'),
(181, 2, NULL, 'Java Developers', 1, '2021-09-07 07:46:49', '2021-09-07 07:46:49'),
(182, 2, NULL, 'Java Technical Lead', 1, '2021-09-07 07:46:49', '2021-09-07 07:46:49'),
(183, 2, NULL, 'Javascript Developer', 1, '2021-09-07 07:46:49', '2021-09-07 07:46:49'),
(184, 2, NULL, 'Knowledge Management', 1, '2021-09-07 07:46:49', '2021-09-07 07:46:49'),
(185, 2, NULL, 'Labor Relations Lawyer', 1, '2021-09-07 07:46:49', '2021-09-07 07:46:49'),
(186, 2, NULL, 'Langauge Trainer', 1, '2021-09-07 07:46:49', '2021-09-07 07:46:49'),
(187, 2, NULL, 'Langauge Trainer', 1, '2021-09-07 07:46:49', '2021-09-07 07:46:49'),
(188, 2, NULL, 'Lead Azure Application Architect', 1, '2021-09-07 07:46:49', '2021-09-07 07:46:49'),
(189, 2, NULL, 'Lead Generation Manager', 1, '2021-09-07 07:46:49', '2021-09-07 07:46:49'),
(190, 2, NULL, 'Learning & Development Manager', 1, '2021-09-07 07:46:49', '2021-09-07 07:46:49'),
(191, 2, NULL, 'Learning & Development Manager', 1, '2021-09-07 07:46:49', '2021-09-07 07:46:49'),
(192, 2, NULL, 'Linux System Admin', 1, '2021-09-07 07:46:49', '2021-09-07 07:46:49'),
(193, 2, NULL, 'LMS Designer', 1, '2021-09-07 07:46:49', '2021-09-07 07:46:49'),
(194, 2, NULL, 'Logistics Coordinator', 1, '2021-09-07 07:46:49', '2021-09-07 07:46:49'),
(195, 2, NULL, 'Market Research Manager', 1, '2021-09-07 07:46:49', '2021-09-07 07:46:49'),
(196, 2, NULL, 'Mechanical Services', 1, '2021-09-07 07:46:49', '2021-09-07 07:46:49'),
(197, 2, NULL, 'Medical Coder', 1, '2021-09-07 07:46:49', '2021-09-07 07:46:49'),
(198, 2, NULL, 'Messaging and Collaboration', 1, '2021-09-07 07:46:49', '2021-09-07 07:46:49'),
(199, 2, NULL, 'Microsoft Sql Server Database Administration', 1, '2021-09-07 07:46:49', '2021-09-07 07:46:49'),
(200, 2, NULL, 'Mobile Application Developers', 1, '2021-09-07 07:46:49', '2021-09-07 07:46:49'),
(201, 2, NULL, 'Mobile Application Technical Architect', 1, '2021-09-07 07:46:49', '2021-09-07 07:46:49'),
(202, 2, NULL, 'IT Helpdesk Support', 1, '2021-09-07 07:51:46', '2021-09-07 07:51:46'),
(203, 2, NULL, 'IT Manager', 1, '2021-09-07 07:51:46', '2021-09-07 07:51:46'),
(204, 2, NULL, 'Mobile Developer', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(205, 2, NULL, 'MS Azure Administrators', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(206, 2, NULL, 'Multi Lingual', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(207, 2, NULL, 'Network Engineer', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(208, 2, NULL, 'NOC Engineer', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(209, 2, NULL, 'NOC Manager', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(210, 2, NULL, 'NOC Supervisor', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(211, 2, NULL, 'NodeJs Developer', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(212, 2, NULL, 'Offerings & Counsel Manager', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(213, 2, NULL, 'Opentext Ecm Tools', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(214, 2, NULL, 'Operational Risk Manager', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(215, 2, NULL, 'Operations Manager', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(216, 2, NULL, 'Oracle Administrator', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(217, 2, NULL, 'OTC', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(218, 2, NULL, 'Payroll', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(219, 2, NULL, 'Peoplesoft Financials', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(220, 2, NULL, 'PEST Control', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(221, 2, NULL, 'PEZA', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(222, 2, NULL, 'Php Developer', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(223, 2, NULL, 'PHRN', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(224, 2, NULL, 'PHRN Manager', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(225, 2, NULL, 'PHRN QA', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(226, 2, NULL, 'PHRN Team Lead', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(227, 2, NULL, 'Physical Security Lead', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(228, 2, NULL, 'Powerbi Developer', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(229, 2, NULL, 'Powerbi Developer', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(230, 2, NULL, 'PR Marketing Officer', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(231, 2, NULL, 'Pre Sales', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(232, 2, NULL, 'Problem Management', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(233, 2, NULL, 'Process Architect Manager', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(234, 2, NULL, 'Process Excellence Service Delivery Manager', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(235, 2, NULL, 'Process Specialist', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(236, 2, NULL, 'Product Owner', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(237, 2, NULL, 'Product Trainer', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(238, 2, NULL, 'Professional Development Manager', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(239, 2, NULL, 'Project Manager (operation)', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(240, 2, NULL, 'Project Manager (tech)', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(241, 2, NULL, 'PTP', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(242, 2, NULL, 'Purchasing Manager', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(243, 2, NULL, 'Python Developer', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(244, 2, NULL, 'Quality Assurance Analyst', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(245, 2, NULL, 'Quality Assurance Engineer', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(246, 2, NULL, 'Quality Manager', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(247, 2, NULL, 'Quality Supervisor', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(248, 2, NULL, 'Recruitment Director', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(249, 2, NULL, 'Recruitment Manager', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(250, 2, NULL, 'Recruitment Specialist', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(251, 2, NULL, 'Recuitment Associate', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(252, 2, NULL, 'Remote Assistant', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(253, 2, NULL, 'Reports Analyst', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(254, 2, NULL, 'Reports Developer', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(255, 2, NULL, 'Reports Specialist', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(256, 2, NULL, 'RPA (blueprism)', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(257, 2, NULL, 'SAP Abap Developer', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(258, 2, NULL, 'SAP Abap Developer', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(259, 2, NULL, 'SAP Abap Development For Hana', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(260, 2, NULL, 'SAP Abap Web Dynpro Development', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(261, 2, NULL, 'SAP Basis Administration', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(262, 2, NULL, 'SAP Bpc Consultant', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(263, 2, NULL, 'SAP Bpc Senior Consultant', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(264, 2, NULL, 'SAP Business Intelligence (bi)', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(265, 2, NULL, 'SAP Business Planning And Consolidation', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(266, 2, NULL, 'SAP Businessobjects Data Services', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(267, 2, NULL, 'SAP Bw Hana Senior Consultant', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(268, 2, NULL, 'SAP Bw On Hana Data Modeling & Development', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(269, 2, NULL, 'SAP Co Management Accounting', 1, '2021-09-07 11:12:33', '2021-09-07 11:12:33'),
(270, 2, NULL, 'SAP Co Profitability Analysis', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(271, 2, NULL, 'SAP CRM Marketing Campaign Management', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(272, 2, NULL, 'SAP CRM Sales & Service', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(273, 2, NULL, 'SAP CRM Sales Pricing & Contracts', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(274, 2, NULL, 'SAP CRM Service Order Management', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(275, 2, NULL, 'SAP Data & Development', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(276, 2, NULL, 'SAP Ecc LE Warehouse Management', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(277, 2, NULL, 'SAP Ecc PM Plant Maintenance', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(278, 2, NULL, 'SAP Ecc PP Production Planning & Control For Discrete Industries', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(279, 2, NULL, 'SAP Ecc Quality Management', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(280, 2, NULL, 'SAP Ewm Abap Senior Consultant', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(281, 2, NULL, 'SAP Ewm Functional Senior Consultant', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(282, 2, NULL, 'SAP Fi General Ledger', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(283, 2, NULL, 'SAP Fi S/4 Hana Accounting', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(284, 2, NULL, 'SAP Fico', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(285, 2, NULL, 'SAP Financial Accounting & Operations', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(286, 2, NULL, 'SAP Financial Supply Chain Management', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(287, 2, NULL, 'SAP Fiori Consultant', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(288, 2, NULL, 'SAP Fiori/UI5 & Responsive Design Architecture', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(289, 2, NULL, 'SAP For Banking Fi Contract Accounts Receivables And Payables', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(290, 2, NULL, 'SAP For Governance, Risk & Compliance (GRC)', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(291, 2, NULL, 'SAP For Telecommunications Convergent Charging', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(292, 2, NULL, 'SAP For Utilities', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(293, 2, NULL, 'SAP Hana Administration & Performance Engineering', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(294, 2, NULL, 'SAP Hana Upgrades & Migrations', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(295, 2, NULL, 'SAP HCM', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(296, 2, NULL, 'SAP HCM On Premise Human Capital Management', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(297, 2, NULL, 'SAP HCM Payroll', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(298, 2, NULL, 'SAP Hybris Cloud For Sales', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(299, 2, NULL, 'SAP Identity And Access Management', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(300, 2, NULL, 'SAP Master Data Governance', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(301, 2, NULL, 'SAP Master Data Governance Development Tool (mdg Tool)', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(302, 2, NULL, 'SAP Master Data Migration', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(303, 2, NULL, 'SAP Mdg Consultant', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(304, 2, NULL, 'SAP Mm Inventory Management', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(305, 2, NULL, 'SAP Native Hana Sql Modeling & Development', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(306, 2, NULL, 'SAP Po/Pi & Apis Development', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(307, 2, NULL, 'SAP Pp Production Planning & Control Discrete Industries', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(308, 2, NULL, 'SAP Pp Production Planning & Control For Repetitive Manufacturing', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(309, 2, NULL, 'SAP Pp Production Planning & Control Process Industries', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(310, 2, NULL, 'SAP Professionals', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(311, 2, NULL, 'SAP Project System', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(312, 2, NULL, 'SAP Purchasing (mm PO)', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(313, 2, NULL, 'SAP S/4hana Em Logistics Execution', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(314, 2, NULL, 'SAP S/4hana Em Mm Inventory Management', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(315, 2, NULL, 'SAP S/4hana Ewm Extended Warehouse Management', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(316, 2, NULL, 'SAP SCM Apo Demand Planning', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(317, 2, NULL, 'SAP SCM Apo Supply Network Planning', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(318, 2, NULL, 'SAP Sd Sales Order Management', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(319, 2, NULL, 'SAP Sf Senior Consultant', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(320, 2, NULL, 'SAP Technical Architecture', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(321, 2, NULL, 'SAP UI5 Fiori Development (HTML5 & Java)', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(322, 2, NULL, 'SAP Analytics', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(323, 2, NULL, 'SAS Data Integration', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(324, 2, NULL, 'SAS Programmer', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(325, 2, NULL, 'Security Information And Event Management', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(326, 2, NULL, 'Security Operation Center', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(327, 2, NULL, 'Senior Operations Manager', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(328, 2, NULL, 'Senior Siem Administrator', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(329, 2, NULL, 'SEO Specialist', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(330, 2, NULL, 'Service Delivery Manager', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(331, 2, NULL, 'Service Desk', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(332, 2, NULL, 'Service Desk Director', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(333, 2, NULL, 'Service Desk Manager', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(334, 2, NULL, 'Service Desk Supervisor', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(335, 2, NULL, 'Servicenow Admin', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(336, 2, NULL, 'Servicenow Developer', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(337, 2, NULL, 'Sharepoint Developer', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(338, 2, NULL, 'Social Media Manager', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(339, 2, NULL, 'Software Development Lead', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(340, 2, NULL, 'Solution Planning Costing & Pricing', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(341, 2, NULL, 'Sourcing Lead', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(342, 2, NULL, 'Springbot Developer', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(343, 2, NULL, 'Sql Administrator', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(344, 2, NULL, 'Strategic Marketing', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(345, 2, NULL, 'Supply Chain Officer', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(346, 2, NULL, 'System Administrator', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(347, 2, NULL, 'System Engineer', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(348, 2, NULL, 'Tax Manager', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(349, 2, NULL, 'Team Lead', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(350, 2, NULL, 'Tech Recruiter', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(351, 2, NULL, 'Technical Support Engineer', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(352, 2, NULL, 'Technical Support Supervisor', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(353, 2, NULL, 'Technical Support Representative', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(354, 2, NULL, 'Telecom Engineer', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(355, 2, NULL, 'Telesales', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(356, 2, NULL, 'Tenant Representation', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(357, 2, NULL, 'Total Rewards Lead', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(358, 2, NULL, 'Trainer', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(359, 2, NULL, 'Training Director', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(360, 2, NULL, 'Training Manager', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(361, 2, NULL, 'UI Developer', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(362, 2, NULL, 'UI/UX Designer', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(363, 2, NULL, 'Unix Shell Scripting', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(364, 2, NULL, 'USRN', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(365, 2, NULL, 'USRN Manager', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(366, 2, NULL, 'USRN QA', 1, '2021-09-07 11:23:04', '2021-09-07 11:23:04'),
(380, 1, NULL, 'Drop/Rejected Call', 1, '2021-09-07 12:15:18', '2021-09-07 12:15:18'),
(382, 1, NULL, 'To be endorsed', 1, '2021-09-07 12:15:18', '2021-09-07 12:15:18'),
(383, 1, NULL, 'Unresponsive', 1, '2021-09-07 12:15:18', '2021-09-07 12:15:18'),
(384, 16, NULL, 'ACCENTURE', 1, '2021-09-07 12:23:51', '2021-09-07 12:23:51'),
(385, 16, NULL, 'ACCESS HEALTHCARE', 1, '2021-09-07 12:23:51', '2021-09-07 12:23:51'),
(386, 16, NULL, 'ACQUIRE BPO', 1, '2021-09-07 12:28:36', '2021-09-07 12:28:36'),
(387, 16, NULL, 'ADRENALIN', 1, '2021-09-07 12:28:36', '2021-09-07 12:28:36'),
(388, 16, NULL, 'AHSAY', 1, '2021-09-07 12:28:36', '2021-09-07 12:28:36'),
(389, 16, NULL, 'ALORICA', 1, '2021-09-07 12:28:36', '2021-09-07 12:28:36'),
(390, 16, NULL, 'AXA', 1, '2021-09-07 12:28:36', '2021-09-07 12:28:36'),
(391, 16, NULL, 'BOXY CHARM INCORPORATION', 1, '2021-09-07 12:28:36', '2021-09-07 12:28:36'),
(392, 16, NULL, 'CAMPGEMINI', 1, '2021-09-07 12:28:36', '2021-09-07 12:28:36'),
(393, 16, NULL, 'CAPGEMINI', 1, '2021-09-07 12:28:36', '2021-09-07 12:28:36'),
(394, 16, NULL, 'CHARISMA', 1, '2021-09-07 12:28:36', '2021-09-07 12:28:36'),
(395, 16, NULL, 'CLOUDSTAFF', 1, '2021-09-07 12:28:36', '2021-09-07 12:28:36'),
(396, 16, NULL, 'COGNIZANT', 1, '2021-09-07 12:28:36', '2021-09-07 12:28:36'),
(397, 17, NULL, 'Endorsed', 1, '2021-09-07 12:30:10', '2021-09-07 12:30:10'),
(398, 17, NULL, 'Re-endorsed', 1, '2021-09-07 12:30:10', '2021-09-07 12:30:10'),
(399, 17, NULL, 'Reprofile', 1, '2021-09-07 12:30:10', '2021-09-07 12:30:10'),
(400, 13, NULL, 'Accepted an offer from another company', 1, '2021-09-07 12:32:57', '2021-09-07 12:32:57'),
(401, 13, NULL, 'Background Check', 1, '2021-09-07 12:32:57', '2021-09-07 12:32:57'),
(402, 13, NULL, 'Behavioral issues', 1, '2021-09-07 12:32:57', '2021-09-07 12:32:57'),
(403, 13, NULL, 'Candidate can\'t start on the given start date', 1, '2021-09-07 12:32:57', '2021-09-07 12:32:57'),
(404, 13, NULL, 'Cannot articulate well', 1, '2021-09-07 12:32:57', '2021-09-07 12:32:57'),
(405, 13, NULL, 'Counter offer', 1, '2021-09-07 12:32:57', '2021-09-07 12:32:57'),
(406, 3, NULL, 'CL5', 1, '2021-09-07 12:35:28', '2021-09-07 12:35:28'),
(407, 3, NULL, 'CL6', 1, '2021-09-07 12:35:28', '2021-09-07 12:35:28'),
(408, 3, NULL, 'CL7', 1, '2021-09-07 12:35:28', '2021-09-07 12:35:28'),
(409, 3, NULL, 'CL8', 1, '2021-09-07 12:35:28', '2021-09-07 12:35:28'),
(410, 3, NULL, 'CL9', 1, '2021-09-07 12:35:28', '2021-09-07 12:35:28'),
(411, 3, NULL, 'CL10', 1, '2021-09-07 12:35:28', '2021-09-07 12:35:28'),
(412, 3, NULL, 'CL11', 1, '2021-09-07 12:35:28', '2021-09-07 12:35:28'),
(413, 3, NULL, 'CL12', 1, '2021-09-07 12:35:28', '2021-09-07 12:35:28'),
(414, 3, NULL, 'CL13', 1, '2021-09-07 12:35:28', '2021-09-07 12:35:28'),
(415, 3, NULL, 'CL14', 1, '2021-09-07 12:35:28', '2021-09-07 12:35:28'),
(416, 3, NULL, 'CL15', 1, '2021-09-07 12:35:28', '2021-09-07 12:35:28'),
(422, 18, NULL, 'Billed', 1, '2021-09-07 12:40:03', '2021-09-07 12:40:03'),
(423, 18, NULL, 'Collected', 1, '2021-09-07 12:40:03', '2021-09-07 12:40:03'),
(424, 18, NULL, 'fall out', 1, '2021-09-07 12:40:03', '2021-09-07 12:40:03'),
(425, 18, NULL, 'For Replacement', 1, '2021-09-07 12:40:03', '2021-09-07 12:40:03'),
(426, 18, NULL, 'Replaced', 1, '2021-09-07 12:40:03', '2021-09-07 12:40:03'),
(427, 18, NULL, 'Replacement', 1, '2021-09-07 12:40:03', '2021-09-07 12:40:03'),
(428, 18, NULL, 'Unbilled', 1, '2021-09-07 12:40:03', '2021-09-07 12:40:03'),
(429, 19, NULL, 'Toronto, Canada', 1, '2021-09-08 05:00:47', '2021-09-08 05:00:47'),
(430, 19, NULL, 'Lahore, Pakistan', 1, '2021-09-08 05:00:47', '2021-09-08 05:00:47'),
(431, 19, NULL, 'Tokyo, Japan', 1, '2021-09-08 05:00:47', '2021-09-08 05:00:47'),
(432, 19, NULL, 'New York, US', 1, '2021-09-08 05:00:47', '2021-09-08 05:00:47'),
(433, 19, NULL, 'Manchester, UK', 1, '2021-09-08 05:00:47', '2021-09-08 05:00:47'),
(434, 19, NULL, 'Rome, Italy', 1, '2021-09-08 05:00:47', '2021-09-08 05:00:47'),
(435, 19, NULL, 'Berlin, Germany', 1, '2021-09-08 05:00:47', '2021-09-08 05:00:47'),
(436, 19, NULL, 'Canberra, Australia', 1, '2021-09-08 05:00:47', '2021-09-08 05:00:47'),
(437, 20, NULL, 'Jobstreet', 1, '2021-09-08 06:27:46', '2021-09-08 06:27:46'),
(438, 20, NULL, 'BestJobs', 1, '2021-09-08 06:27:46', '2021-09-08 06:27:46'),
(439, 20, NULL, 'Linked In', 1, '2021-09-08 06:32:39', '2021-09-08 06:32:39'),
(440, 20, NULL, 'VCC DB', 1, '2021-09-08 06:32:39', '2021-09-08 06:32:39'),
(441, 20, NULL, 'Referral', 1, '2021-09-08 06:32:39', '2021-09-08 06:32:39'),
(442, 20, NULL, 'Facebook', 1, '2021-09-08 06:32:39', '2021-09-08 06:32:39'),
(443, 20, NULL, 'Craigslist', 1, '2021-09-08 06:32:39', '2021-09-08 06:32:39'),
(444, 20, NULL, 'Chaos Ads', 1, '2021-09-08 06:32:39', '2021-09-08 06:32:39'),
(445, 20, NULL, 'Get Call Center Jobs', 1, '2021-09-08 06:32:39', '2021-09-08 06:32:39'),
(446, 20, NULL, 'Jobs4Jobs', 1, '2021-09-08 06:32:39', '2021-09-08 06:32:39'),
(447, 20, NULL, 'Jobfinder', 1, '2021-09-08 06:32:39', '2021-09-08 06:32:39'),
(448, 20, NULL, 'Jora', 1, '2021-09-08 06:32:39', '2021-09-08 06:32:39'),
(449, 20, NULL, 'Locanto', 1, '2021-09-08 06:32:39', '2021-09-08 06:32:39'),
(450, 20, NULL, 'Sheryna', 1, '2021-09-08 06:32:39', '2021-09-08 06:32:39'),
(451, 20, NULL, 'Jobaxy', 1, '2021-09-08 06:32:39', '2021-09-08 06:32:39'),
(452, 20, NULL, 'Postjobsfree', 1, '2021-09-08 06:32:39', '2021-09-08 06:32:39'),
(453, 10, NULL, 'SMS', 1, '2021-09-08 06:35:23', '2021-09-08 06:35:23'),
(454, 10, NULL, 'Email', 1, '2021-09-08 06:35:23', '2021-09-08 06:35:23'),
(455, 10, NULL, 'Viber', 1, '2021-09-08 06:35:23', '2021-09-08 06:35:23'),
(456, 10, NULL, 'Skype', 1, '2021-09-08 06:35:23', '2021-09-08 06:35:23'),
(457, 10, NULL, 'Messenger', 1, '2021-09-08 06:37:56', '2021-09-08 06:37:56'),
(458, 10, NULL, 'Linkedin', 1, '2021-09-08 06:37:56', '2021-09-08 06:37:56'),
(459, 10, NULL, 'Cold Call', 1, '2021-09-08 06:37:56', '2021-09-08 06:37:56'),
(460, 10, NULL, 'Pending', 1, '2021-09-08 06:37:56', '2021-09-08 06:37:56'),
(461, 21, NULL, 'F', 1, '2021-09-08 06:40:38', '2021-09-08 06:40:38'),
(462, 21, NULL, 'M', 1, '2021-09-08 06:40:38', '2021-09-08 06:40:38'),
(463, 13, NULL, 'Did not meet minimum qualifications required for the post', 1, '2021-09-08 06:47:52', '2021-09-08 06:47:52'),
(464, 13, NULL, 'Did not meet salary expectations', 1, '2021-09-08 06:47:52', '2021-09-08 06:47:52'),
(465, 13, NULL, 'Doesn’t have a leadership experience', 1, '2021-09-08 06:47:52', '2021-09-08 06:47:52'),
(466, 13, NULL, 'Doesn’t have hands on experienced using a specific tool needed for the post', 1, '2021-09-08 06:47:52', '2021-09-08 06:47:52'),
(468, 13, NULL, 'Expected salary is above the budget', 1, '2021-09-08 06:51:42', '2021-09-08 06:51:42'),
(469, 13, NULL, 'Fail to express well Situational/Case Based Question', 1, '2021-09-08 06:51:42', '2021-09-08 06:51:42'),
(470, 13, NULL, 'Lacks relevant years of experience needed for the post', 1, '2021-09-08 06:51:42', '2021-09-08 06:51:42'),
(471, 13, NULL, 'Not amenable to the post\'s work schedule', 1, '2021-09-08 06:51:42', '2021-09-08 06:51:42'),
(472, 13, NULL, 'Not amenable to work on the location', 1, '2021-09-08 06:51:42', '2021-09-08 06:51:42'),
(474, 22, NULL, 'Greenbelt Trained', 1, '2021-09-08 06:52:20', '2021-09-08 06:52:20'),
(475, 22, NULL, 'Blackbelt Trained', 1, '2021-09-08 06:52:20', '2021-09-08 06:52:20'),
(476, 22, NULL, 'Blackbelt Certified', 1, '2021-09-08 06:52:20', '2021-09-08 06:52:20'),
(477, 22, NULL, 'Masterblackbelt Trained', 1, '2021-09-08 06:52:20', '2021-09-08 06:52:20'),
(478, 22, NULL, 'Masterblackbelt Certified', 1, '2021-09-08 06:52:20', '2021-09-08 06:52:20'),
(479, 13, NULL, 'Profile mismatch', 1, '2021-09-08 06:52:43', '2021-09-08 06:52:43'),
(480, 13, NULL, 'The role was moved to a different location', 1, '2021-09-08 06:52:43', '2021-09-08 06:52:43'),
(481, 13, NULL, 'Too junior for the role', 1, '2021-09-08 06:52:43', '2021-09-08 06:52:43'),
(482, 13, NULL, 'Too senior for the role', 1, '2021-09-08 06:52:43', '2021-09-08 06:52:43'),
(483, 13, NULL, 'Will prioritize local talents', 1, '2021-09-08 06:52:43', '2021-09-08 06:52:43'),
(484, 22, NULL, 'ISO 9001 Certified', 1, '2021-09-08 06:53:53', '2021-09-08 06:53:53'),
(485, 22, NULL, 'QMS', 1, '2021-09-08 06:53:53', '2021-09-08 06:53:53'),
(486, 22, NULL, 'Project Management Certified', 1, '2021-09-08 06:53:53', '2021-09-08 06:53:53'),
(487, 22, NULL, 'Certified Public Accountant', 1, '2021-09-08 06:53:53', '2021-09-08 06:53:53'),
(488, 22, NULL, 'Affiliate', 1, '2021-09-08 06:53:53', '2021-09-08 06:53:53'),
(489, 22, NULL, 'Associate', 1, '2021-09-08 06:53:53', '2021-09-08 06:53:53'),
(490, 22, NULL, 'Fellow', 1, '2021-09-08 06:53:53', '2021-09-08 06:53:53'),
(491, 22, NULL, 'Licensed Mechanical Engineer', 1, '2021-09-08 06:53:53', '2021-09-08 06:53:53'),
(492, 22, NULL, 'Business Continuity Management Professional', 1, '2021-09-08 06:53:53', '2021-09-08 06:53:53'),
(493, 22, NULL, 'Scrum Master', 1, '2021-09-08 06:53:53', '2021-09-08 06:53:53'),
(494, 22, NULL, 'Project Management Professional (PMP)', 1, '2021-09-08 06:55:41', '2021-09-08 06:55:41'),
(495, 22, NULL, 'Certified Scrum Master (CSM)', 1, '2021-09-08 06:55:41', '2021-09-08 06:55:41'),
(496, 22, NULL, 'AWS Certified Solutions Architect – Associate', 1, '2021-09-08 06:55:41', '2021-09-08 06:55:41'),
(497, 22, NULL, 'AWS Certified Developer – Associate', 1, '2021-09-08 06:55:41', '2021-09-08 06:55:41'),
(498, 22, NULL, 'Certified Information Security Manager (CISM)', 1, '2021-09-08 06:55:41', '2021-09-08 06:55:41'),
(499, 22, NULL, 'Certified Ethical Hacker (CEH)', 1, '2021-09-08 06:55:41', '2021-09-08 06:55:41'),
(500, 22, NULL, 'Certified Information Systems Security Professional (CISSP)', 1, '2021-09-08 06:55:41', '2021-09-08 06:55:41'),
(501, 22, NULL, 'Certified in Risk and Information Systems Control (CRISC)', 1, '2021-09-08 06:55:41', '2021-09-08 06:55:41'),
(502, 22, NULL, 'Certified Information Systems Auditor (CISA)', 1, '2021-09-08 06:55:41', '2021-09-08 06:55:41'),
(503, 22, NULL, 'Google Certified Professional Cloud Architect', 1, '2021-09-08 06:55:41', '2021-09-08 06:55:41'),
(504, 22, NULL, 'Certified data professional (CDP)', 1, '2021-09-08 06:55:41', '2021-09-08 06:55:41'),
(505, 18, NULL, 'Preparing Invoice', 1, '2021-09-08 06:58:52', '2021-09-08 06:58:52'),
(506, 18, NULL, 'Invoice Sent to Client', 1, '2021-09-08 06:58:52', '2021-09-08 06:58:52'),
(507, 22, NULL, 'Cisco certified internetwork expert (CCIE)', 1, '2021-09-08 07:01:28', '2021-09-08 07:01:28'),
(508, 22, NULL, 'Cisco certified network associate (CCNA)', 1, '2021-09-08 07:01:28', '2021-09-08 07:01:28'),
(509, 22, NULL, 'Cisco certified network professional (CCNP)', 1, '2021-09-08 07:01:28', '2021-09-08 07:01:28'),
(510, 22, NULL, 'CompTIA A+', 1, '2021-09-08 07:01:28', '2021-09-08 07:01:28'),
(511, 22, NULL, 'Microsoft technology associate (MTA)', 1, '2021-09-08 07:01:28', '2021-09-08 07:01:28'),
(512, 22, NULL, 'Oracle certified professional', 1, '2021-09-08 07:01:28', '2021-09-08 07:01:28'),
(513, 22, NULL, 'Salesforce certified development lifecycle and deployment', 1, '2021-09-08 07:01:28', '2021-09-08 07:01:28'),
(514, 22, NULL, 'Global information assurance certification (GIAC)', 1, '2021-09-08 07:01:28', '2021-09-08 07:01:28'),
(515, 22, NULL, 'ITIL', 1, '2021-09-08 07:01:28', '2021-09-08 07:01:28'),
(516, 23, NULL, 'Pending DB Validation', 1, '2021-09-08 07:02:52', '2021-09-08 07:02:52'),
(517, 23, NULL, 'In Client\'s DB/Portal', 1, '2021-09-08 07:02:52', '2021-09-08 07:02:52'),
(518, 23, NULL, 'No show (initial)', 1, '2021-09-08 07:02:52', '2021-09-08 07:02:52'),
(519, 23, NULL, 'For Initial Paper Screening', 1, '2021-09-08 07:02:52', '2021-09-08 07:02:52'),
(520, 23, NULL, 'Pending HRI', 1, '2021-09-08 07:02:52', '2021-09-08 07:02:52'),
(521, 23, NULL, 'Pending Skills Interview', 1, '2021-09-08 07:04:23', '2021-09-08 07:04:23'),
(522, 23, NULL, 'Pending for online exam', 1, '2021-09-08 07:04:23', '2021-09-08 07:04:23'),
(523, 23, NULL, 'Pending Behavioral Interview', 1, '2021-09-08 07:04:23', '2021-09-08 07:04:23'),
(524, 23, NULL, 'Pending Call Simulation/mock call', 1, '2021-09-08 07:04:23', '2021-09-08 07:04:23'),
(525, 23, NULL, 'Scheduled for HRI', 1, '2021-09-08 07:04:23', '2021-09-08 07:04:23'),
(526, 23, NULL, 'Scheduled for Online Exam', 1, '2021-09-08 07:05:40', '2021-09-08 07:05:40'),
(527, 23, NULL, 'Scheduled Call Simulation/mock call', 1, '2021-09-08 07:05:40', '2021-09-08 07:05:40'),
(528, 23, NULL, 'Failed HRI', 1, '2021-09-08 07:05:40', '2021-09-08 07:05:40'),
(529, 23, NULL, 'Failed Initial Paper Screening', 1, '2021-09-08 07:05:40', '2021-09-08 07:05:40'),
(530, 23, NULL, 'Failed Language Assessment exam', 1, '2021-09-08 07:05:40', '2021-09-08 07:05:40'),
(531, 23, NULL, 'Failed Call Simulation/Mock Call', 1, '2021-09-08 07:07:55', '2021-09-08 07:07:55'),
(532, 23, NULL, 'Withdraw - CNI', 1, '2021-09-08 07:07:55', '2021-09-08 07:07:55'),
(533, 23, NULL, 'Done Initial Interview', 1, '2021-09-08 07:07:55', '2021-09-08 07:07:55'),
(534, 23, NULL, 'Done Language Assessment Exam', 1, '2021-09-08 07:07:55', '2021-09-08 07:07:55'),
(535, 23, NULL, 'Withdraw / CNI - Initial', 1, '2021-09-08 07:07:55', '2021-09-08 07:07:55'),
(536, 23, NULL, 'Position On Hold (Initial)', 1, '2021-09-08 07:08:53', '2021-09-08 07:08:53'),
(537, 23, NULL, 'Done Online exam', 1, '2021-09-08 07:08:53', '2021-09-08 07:08:53'),
(538, 23, NULL, 'Scheduled for Skills Interview', 1, '2021-09-08 07:14:33', '2021-09-08 07:14:33'),
(539, 23, NULL, 'Scheduled for Technical Interview', 1, '2021-09-08 07:14:33', '2021-09-08 07:14:33'),
(540, 23, NULL, 'Scheduled for Technical exam', 1, '2021-09-08 07:14:33', '2021-09-08 07:14:33'),
(541, 23, NULL, 'Sheduled for Behavioral Interview', 1, '2021-09-08 07:14:33', '2021-09-08 07:14:33'),
(542, 23, NULL, 'Scheduled for account validation', 1, '2021-09-08 07:14:33', '2021-09-08 07:14:33'),
(543, 23, NULL, 'Done Skills interview/ Awaiting Feedback', 1, '2021-09-08 07:14:33', '2021-09-08 07:14:33'),
(544, 23, NULL, 'Done Techincal Interview /Awaiting Feedback', 1, '2021-09-08 07:14:33', '2021-09-08 07:14:33'),
(545, 23, NULL, 'Done Technical exam /Awaiting Feedback', 1, '2021-09-08 07:14:33', '2021-09-08 07:14:33'),
(546, 23, NULL, 'Done Behavioral /Awaiting Feedback', 1, '2021-09-08 07:14:33', '2021-09-08 07:14:33'),
(547, 23, NULL, 'Failed Skills interview', 1, '2021-09-08 07:14:33', '2021-09-08 07:14:33'),
(548, 23, NULL, 'Failed Techincal Interview', 1, '2021-09-08 07:21:35', '2021-09-08 07:21:35'),
(549, 23, NULL, 'Failed Technical exam', 1, '2021-09-08 07:21:35', '2021-09-08 07:21:35'),
(550, 23, NULL, 'Failed Behavioral Interview', 1, '2021-09-08 07:21:35', '2021-09-08 07:21:35'),
(551, 23, NULL, 'Pending Country Head Interview', 1, '2021-09-08 07:21:35', '2021-09-08 07:21:35'),
(552, 23, NULL, 'Pending Final Interview', 1, '2021-09-08 07:21:35', '2021-09-08 07:21:35'),
(553, 23, NULL, 'Pending Hiring Manager\'s Interview', 1, '2021-09-08 07:21:35', '2021-09-08 07:21:35'),
(554, 23, NULL, 'Withdraw / CNI - Mid', 1, '2021-09-08 07:21:35', '2021-09-08 07:21:35'),
(555, 23, NULL, 'Position Closed (Mid Stage)', 1, '2021-09-08 07:21:35', '2021-09-08 07:21:35'),
(556, 23, NULL, 'Scheduled for Country Head Interview', 1, '2021-09-08 07:24:04', '2021-09-08 07:24:04'),
(557, 23, NULL, 'Scheduled for Final Interview', 1, '2021-09-08 07:24:04', '2021-09-08 07:24:04'),
(558, 23, NULL, 'Scheduled for Hiring Manager\'s Interview', 1, '2021-09-08 07:24:04', '2021-09-08 07:24:04'),
(559, 23, NULL, 'Done Behavioral Interview / Awaiting Feedback', 1, '2021-09-08 07:24:04', '2021-09-08 07:24:04'),
(560, 23, NULL, 'Done Final Interview / Awaiting Feedback', 1, '2021-09-08 07:24:04', '2021-09-08 07:24:04'),
(561, 23, NULL, 'Done Country Head Interview / Awaiting Feedback', 1, '2021-09-08 07:24:04', '2021-09-08 07:24:04'),
(562, 23, NULL, 'Done Hiring Manager\'s Interview / Awaiting Feedback', 1, '2021-09-08 07:24:04', '2021-09-08 07:24:04'),
(563, 23, NULL, 'Failed Country Head Interview', 1, '2021-09-08 07:24:04', '2021-09-08 07:24:04'),
(564, 23, NULL, 'Failed Final Interview', 1, '2021-09-08 07:24:04', '2021-09-08 07:24:04'),
(565, 5, NULL, 'Humanities', 1, '2021-09-08 07:24:13', '2021-09-08 07:24:13'),
(566, 5, NULL, 'Social Sciences', 1, '2021-09-08 07:24:13', '2021-09-08 07:24:13'),
(567, 5, NULL, 'Natural Sciences', 1, '2021-09-08 07:24:13', '2021-09-08 07:24:13'),
(568, 5, NULL, 'Formal Sciences', 1, '2021-09-08 07:24:13', '2021-09-08 07:24:13'),
(569, 5, NULL, 'Professions and Applied Sciences', 1, '2021-09-08 07:24:13', '2021-09-08 07:24:13'),
(570, 23, NULL, 'Failed Hiring Manager\'s Interview', 1, '2021-09-08 07:26:05', '2021-09-08 07:26:05'),
(571, 23, NULL, 'Scheduled for Job Offer', 1, '2021-09-08 07:26:05', '2021-09-08 07:26:05'),
(572, 23, NULL, 'Shortlisted/For Comparison', 1, '2021-09-08 07:26:05', '2021-09-08 07:26:05'),
(573, 23, NULL, 'Onboarded', 1, '2021-09-08 07:26:05', '2021-09-08 07:26:05'),
(574, 23, NULL, 'Offer accepted', 1, '2021-09-08 07:26:05', '2021-09-08 07:26:05'),
(575, 23, NULL, 'Offer Rejected', 1, '2021-09-08 07:26:05', '2021-09-08 07:26:05'),
(576, 23, NULL, 'Position Closed (Final Stage)', 1, '2021-09-08 07:26:05', '2021-09-08 07:26:05'),
(577, 23, NULL, 'Withdraw / CNI - Final', 1, '2021-09-08 07:26:05', '2021-09-08 07:26:05'),
(578, 23, NULL, 'Fallout', 1, '2021-09-08 07:26:05', '2021-09-08 07:26:05'),
(579, 23, NULL, 'Reneged', 1, '2021-09-08 07:26:05', '2021-09-08 07:26:05'),
(580, 5, NULL, 'Agriculture', 1, '2021-09-08 07:26:26', '2021-09-08 07:26:26'),
(581, 5, NULL, 'Architecture and Design', 1, '2021-09-08 07:26:26', '2021-09-08 07:26:26'),
(582, 5, NULL, 'Business', 1, '2021-09-08 07:26:26', '2021-09-08 07:26:26'),
(583, 5, NULL, 'Health Sciences', 1, '2021-09-08 07:26:26', '2021-09-08 07:26:26'),
(584, 5, NULL, 'Education', 1, '2021-09-08 07:26:26', '2021-09-08 07:26:26'),
(585, 5, NULL, 'Engineering', 1, '2021-09-08 07:28:13', '2021-09-08 07:28:13'),
(586, 5, NULL, 'Media and Communication', 1, '2021-09-08 07:28:13', '2021-09-08 07:28:13'),
(587, 5, NULL, 'Public Administration', 1, '2021-09-08 07:28:13', '2021-09-08 07:28:13'),
(588, 5, NULL, 'Transportation', 1, '2021-09-08 07:28:13', '2021-09-08 07:28:13'),
(589, 5, NULL, 'Nutrition', 1, '2021-09-08 07:28:13', '2021-09-08 07:28:13'),
(590, 1, NULL, 'Pending for processing (Invited)', 1, '2021-09-08 07:31:39', '2021-09-08 07:31:39'),
(591, 1, NULL, 'Pending for processing (Uninvited)', 1, '2021-09-08 07:31:39', '2021-09-08 07:31:39'),
(592, 16, NULL, 'CONCENTRIX', 1, '2021-09-08 07:34:38', '2021-09-08 07:34:38'),
(593, 16, NULL, 'CONCENTRIX TECH', 1, '2021-09-08 07:34:38', '2021-09-08 07:34:38'),
(594, 16, NULL, 'CONDUENT', 1, '2021-09-08 07:34:38', '2021-09-08 07:34:38'),
(595, 16, NULL, 'CTRIP', 1, '2021-09-08 07:34:38', '2021-09-08 07:34:38'),
(596, 16, NULL, 'DATA1 ASIA', 1, '2021-09-08 07:34:38', '2021-09-08 07:34:38'),
(597, 16, NULL, 'DELAWARE', 1, '2021-09-08 07:34:38', '2021-09-08 07:34:38'),
(598, 16, NULL, 'DIGITAL ROOM LLC.', 1, '2021-09-08 07:34:38', '2021-09-08 07:34:38'),
(599, 16, NULL, 'DKS', 1, '2021-09-08 07:34:38', '2021-09-08 07:34:38'),
(600, 16, NULL, 'EMAPTA', 1, '2021-09-08 07:34:38', '2021-09-08 07:34:38'),
(601, 16, NULL, 'ERNST & YOUNG', 1, '2021-09-08 07:34:38', '2021-09-08 07:34:38'),
(602, 16, NULL, 'EXL', 1, '2021-09-08 07:34:38', '2021-09-08 07:34:38'),
(603, 16, NULL, 'FAST RETAILING', 1, '2021-09-08 07:34:38', '2021-09-08 07:34:38'),
(604, 16, NULL, 'FITRIA', 1, '2021-09-08 07:36:25', '2021-09-08 07:36:25'),
(605, 16, NULL, 'GENPACT', 1, '2021-09-08 07:36:25', '2021-09-08 07:36:25'),
(606, 16, NULL, 'IBM', 1, '2021-09-08 07:36:25', '2021-09-08 07:36:25'),
(607, 16, NULL, 'IBM ML', 1, '2021-09-08 07:36:25', '2021-09-08 07:36:25'),
(608, 16, NULL, 'INFOSYS', 1, '2021-09-08 07:36:25', '2021-09-08 07:36:25'),
(609, 16, NULL, 'INSPIRO', 1, '2021-09-08 07:36:25', '2021-09-08 07:36:25'),
(610, 16, NULL, 'INTELLECT DESIGN', 1, '2021-09-08 07:36:25', '2021-09-08 07:36:25'),
(611, 16, NULL, 'JLL', 1, '2021-09-08 07:36:25', '2021-09-08 07:36:25'),
(612, 16, NULL, 'JPMC', 1, '2021-09-08 07:36:25', '2021-09-08 07:36:25'),
(613, 16, NULL, 'JWS', 1, '2021-09-08 07:36:25', '2021-09-08 07:36:25'),
(614, 16, NULL, 'KOMBEA', 1, '2021-09-08 07:36:25', '2021-09-08 07:36:25'),
(615, 16, NULL, 'LAMUDI', 1, '2021-09-08 07:36:25', '2021-09-08 07:36:25'),
(616, 16, NULL, 'LAZADA', 1, '2021-09-08 07:36:25', '2021-09-08 07:36:25'),
(617, 16, NULL, 'LEADSRUS', 1, '2021-09-08 07:37:53', '2021-09-08 07:37:53'),
(618, 16, NULL, 'LEGATO', 1, '2021-09-08 07:37:53', '2021-09-08 07:37:53'),
(619, 16, NULL, 'MANULIFE', 1, '2021-09-08 07:37:53', '2021-09-08 07:37:53'),
(620, 16, NULL, 'MICROSOURCING', 1, '2021-09-08 07:37:53', '2021-09-08 07:37:53'),
(621, 16, NULL, 'MRM', 1, '2021-09-08 07:37:53', '2021-09-08 07:37:53'),
(622, 16, NULL, 'NEEYAMO', 1, '2021-09-08 07:37:53', '2021-09-08 07:37:53'),
(623, 16, NULL, 'NEUSOFT', 1, '2021-09-08 07:37:53', '2021-09-08 07:37:53'),
(624, 16, NULL, 'OPTUM/UHG', 1, '2021-09-08 07:37:53', '2021-09-08 07:37:53'),
(625, 16, NULL, 'PICNIC HEALTH', 1, '2021-09-08 07:37:53', '2021-09-08 07:37:53'),
(626, 16, NULL, 'PROFORMATION', 1, '2021-09-08 07:39:15', '2021-09-08 07:39:15'),
(627, 16, NULL, 'PUNONG BAYAN', 1, '2021-09-08 07:39:15', '2021-09-08 07:39:15'),
(628, 16, NULL, 'QBE', 1, '2021-09-08 07:39:15', '2021-09-08 07:39:15'),
(629, 16, NULL, 'QUANTRICS', 1, '2021-09-08 07:39:15', '2021-09-08 07:39:15');
INSERT INTO `drop_down_options` (`id`, `drop_down_id`, `sec_dropdown_id`, `option_name`, `status`, `created_at`, `updated_at`) VALUES
(630, 16, NULL, 'REBUS', 1, '2021-09-08 07:39:15', '2021-09-08 07:39:15'),
(631, 16, NULL, 'REMITLY', 1, '2021-09-08 07:39:15', '2021-09-08 07:39:15'),
(632, 16, NULL, 'RJ GLOBUS', 1, '2021-09-08 07:39:15', '2021-09-08 07:39:15'),
(633, 16, NULL, 'SITEL', 1, '2021-09-08 07:39:15', '2021-09-08 07:39:15'),
(634, 15, NULL, 'Valid', 1, '2021-09-08 07:41:22', '2021-09-08 07:41:22'),
(635, 15, NULL, 'Invalid', 1, '2021-09-08 07:41:22', '2021-09-08 07:41:22'),
(636, 15, NULL, 'Pending Validation', 1, '2021-09-08 07:41:22', '2021-09-08 07:41:22'),
(637, 16, NULL, 'STARTEK', 1, '2021-09-08 07:42:08', '2021-09-08 07:42:08'),
(638, 16, NULL, 'SUTHERLAND', 1, '2021-09-08 07:42:08', '2021-09-08 07:42:08'),
(639, 16, NULL, 'SYNCHRONY', 1, '2021-09-08 07:42:08', '2021-09-08 07:42:08'),
(640, 16, NULL, 'TELEDIRECT', 1, '2021-09-08 07:42:08', '2021-09-08 07:42:08'),
(641, 16, NULL, 'TELEPERFORMANCE', 1, '2021-09-08 07:42:08', '2021-09-08 07:42:08'),
(642, 16, NULL, 'THAKRAL ONE', 1, '2021-09-08 07:42:08', '2021-09-08 07:42:08'),
(643, 16, NULL, 'TOPDATA', 1, '2021-09-08 07:42:08', '2021-09-08 07:42:08'),
(644, 16, NULL, 'TRANSCOM', 1, '2021-09-08 07:42:08', '2021-09-08 07:42:08'),
(645, 16, NULL, 'TRANSCOSMOS', 1, '2021-09-08 07:42:08', '2021-09-08 07:42:08'),
(646, 16, NULL, 'TSA GROUP', 1, '2021-09-08 07:42:08', '2021-09-08 07:42:08'),
(647, 16, NULL, 'UBER', 1, '2021-09-08 07:42:08', '2021-09-08 07:42:08'),
(648, 16, NULL, 'UPS', 1, '2021-09-08 07:42:08', '2021-09-08 07:42:08'),
(649, 16, NULL, 'VERTIV', 1, '2021-09-08 07:42:08', '2021-09-08 07:42:08'),
(650, 16, NULL, 'VISTAPRINT', 1, '2021-09-08 07:42:08', '2021-09-08 07:42:08'),
(651, 16, NULL, 'VXI', 1, '2021-09-08 07:42:08', '2021-09-08 07:42:08'),
(652, 16, NULL, 'WDC', 1, '2021-09-08 07:42:08', '2021-09-08 07:42:08'),
(653, 16, NULL, 'WEST TECH/INTRADO', 1, '2021-09-08 07:42:08', '2021-09-08 07:42:08'),
(654, 16, NULL, 'WILLIS TOWERS WATSON', 1, '2021-09-08 07:42:08', '2021-09-08 07:42:08'),
(655, 16, NULL, 'WONDERS', 1, '2021-09-08 07:42:08', '2021-09-08 07:42:08'),
(656, 12, NULL, 'Accenture Delivery Architectures (Ada)', 1, '2021-09-08 07:46:57', '2021-09-08 07:46:57'),
(657, 12, NULL, 'Accenture Operations Finance Associate Manager', 1, '2021-09-08 07:46:57', '2021-09-08 07:46:57'),
(658, 12, NULL, 'Account Coordinator - Senior Associate', 1, '2021-09-08 07:46:57', '2021-09-08 07:46:57'),
(659, 12, NULL, 'Account Manager - Sales Specialist', 1, '2021-09-08 07:46:57', '2021-09-08 07:46:57'),
(660, 12, NULL, 'Account Manager (Bpo)', 1, '2021-09-08 07:46:57', '2021-09-08 07:46:57'),
(661, 12, NULL, 'Account Manager (Sales Manager)', 1, '2021-09-08 07:46:57', '2021-09-08 07:46:57'),
(662, 12, NULL, 'Account Manager (Sales)', 1, '2021-09-08 07:46:57', '2021-09-08 07:46:57'),
(663, 12, NULL, 'Account Manager (Telco)', 1, '2021-09-08 07:46:57', '2021-09-08 07:46:57'),
(664, 12, NULL, 'Accounting Administrator', 1, '2021-09-08 07:46:57', '2021-09-08 07:46:57'),
(665, 12, NULL, 'Accounting Ap Manager', 1, '2021-09-08 07:46:57', '2021-09-08 07:46:57'),
(666, 12, NULL, 'Accounting Assistant', 1, '2021-09-08 07:46:57', '2021-09-08 07:46:57'),
(667, 12, NULL, 'Accounts Payable - Expense', 1, '2021-09-08 08:03:21', '2021-09-08 08:03:21'),
(668, 12, NULL, 'Accounts Receivable Analyst 3', 1, '2021-09-08 08:03:21', '2021-09-08 08:03:21'),
(669, 12, NULL, 'Accounts Receivable Senior Manager', 1, '2021-09-08 08:03:21', '2021-09-08 08:03:21'),
(670, 12, NULL, 'Actuarial Business Manager', 1, '2021-09-08 08:03:21', '2021-09-08 08:03:21'),
(671, 12, NULL, 'Actuarial Valuation Head', 1, '2021-09-08 08:03:21', '2021-09-08 08:03:21'),
(672, 12, NULL, 'Ad Controller', 1, '2021-09-08 08:04:54', '2021-09-08 08:04:54'),
(673, 12, NULL, 'Ad Controller (Confidential)', 1, '2021-09-08 08:04:54', '2021-09-08 08:04:54'),
(674, 12, NULL, 'Ad For Procurement & Supply Chain', 1, '2021-09-08 08:04:54', '2021-09-08 08:04:54'),
(675, 12, NULL, 'Ad Recruitment', 1, '2021-09-08 08:04:54', '2021-09-08 08:04:54'),
(676, 12, NULL, 'Admin Officer', 1, '2021-09-08 08:04:54', '2021-09-08 08:04:54'),
(677, 12, NULL, 'Administration & Facilities Specialist', 1, '2021-09-08 08:09:02', '2021-09-08 08:09:02'),
(678, 12, NULL, 'Administrator (Rhel / Cloud)', 1, '2021-09-08 08:09:02', '2021-09-08 08:09:02'),
(679, 12, NULL, 'Administrator (Windows / Iis)', 1, '2021-09-08 08:09:02', '2021-09-08 08:09:02'),
(680, 12, NULL, 'Adobe Aem/Cq', 1, '2021-09-08 08:09:02', '2021-09-08 08:09:02'),
(681, 12, NULL, 'Advance Front End Development Reactjs', 1, '2021-09-08 08:09:02', '2021-09-08 08:09:02'),
(682, 12, NULL, 'Advanced Analytics Head', 1, '2021-09-08 08:10:18', '2021-09-08 08:10:18'),
(683, 12, NULL, 'Aee Finance Financial Reporting Senior Analyst', 1, '2021-09-08 08:10:18', '2021-09-08 08:10:18'),
(684, 12, NULL, 'Aee Finance Financial Reporting Specialist', 1, '2021-09-08 08:10:18', '2021-09-08 08:10:18'),
(685, 12, NULL, 'Aee Finance Rtr Analyst', 1, '2021-09-08 08:10:18', '2021-09-08 08:10:18'),
(686, 12, NULL, 'Aee Finance Rtr Senior Analyst', 1, '2021-09-08 08:10:18', '2021-09-08 08:10:18'),
(687, 12, NULL, 'Aee Finance Rtr Specialist', 1, '2021-09-08 08:11:58', '2021-09-08 08:11:58'),
(688, 12, NULL, 'Aee Rtr Otc General Accounting Senior Anayst', 1, '2021-09-08 08:11:58', '2021-09-08 08:11:58'),
(689, 12, NULL, 'Aee Space Solutions And Seat Movement Sr Analyst', 1, '2021-09-08 08:11:58', '2021-09-08 08:11:58'),
(690, 12, NULL, 'Aem Front-End Developer', 1, '2021-09-08 08:11:58', '2021-09-08 08:11:58'),
(691, 12, NULL, 'Aem Java Developer', 1, '2021-09-08 08:11:58', '2021-09-08 08:11:58'),
(692, 12, NULL, 'Aem Senior Associate', 1, '2021-09-08 08:11:58', '2021-09-08 08:11:58');

-- --------------------------------------------------------

--
-- Table structure for table `endorsements`
--

CREATE TABLE `endorsements` (
  `id` int(11) NOT NULL,
  `app_status` int(11) NOT NULL,
  `remarks` int(11) NOT NULL,
  `client` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `site` int(11) NOT NULL,
  `domain` int(11) NOT NULL,
  `interview_date` date NOT NULL,
  `career` int(11) NOT NULL,
  `segment` int(11) NOT NULL,
  `sub_segment` int(11) NOT NULL,
  `endi_date` int(11) NOT NULL,
  `remarks_for_finance` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fianace`
--

CREATE TABLE `fianace` (
  `id` int(11) NOT NULL,
  `candidate_id` int(11) NOT NULL,
  `endorsement_id` int(11) NOT NULL,
  `remarks_recruiter` int(11) DEFAULT NULL,
  `onboardnig_date` date DEFAULT NULL,
  `invoice_number` bigint(20) NOT NULL,
  `client` bigint(20) NOT NULL,
  `career` bigint(20) NOT NULL,
  `rate` bigint(20) NOT NULL,
  `Total_bilable_ammount` bigint(20) NOT NULL,
  `srp` bigint(20) NOT NULL COMMENT 'standard project ravenue',
  `offered_salary` bigint(20) DEFAULT NULL,
  `placement_fee` bigint(20) NOT NULL,
  `allowance` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(9, 3),
(10, 3);

-- --------------------------------------------------------

--
-- Table structure for table `segments`
--

CREATE TABLE `segments` (
  `id` int(11) NOT NULL,
  `segment_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sub_segments`
--

CREATE TABLE `sub_segments` (
  `id` int(11) NOT NULL,
  `sub_segment_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` tinyint(4) NOT NULL COMMENT '1 for admin 2 for team 3 for user',
  `image` text COLLATE utf8mb4_unicode_ci,
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
-- Indexes for table `candidate_domains`
--
ALTER TABLE `candidate_domains`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `candidate_positions`
--
ALTER TABLE `candidate_positions`
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
-- Indexes for table `endorsements`
--
ALTER TABLE `endorsements`
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
-- Indexes for table `sub_segments`
--
ALTER TABLE `sub_segments`
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
-- AUTO_INCREMENT for table `candidate_domains`
--
ALTER TABLE `candidate_domains`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `candidate_educations`
--
ALTER TABLE `candidate_educations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `candidate_informations`
--
ALTER TABLE `candidate_informations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `candidate_positions`
--
ALTER TABLE `candidate_positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `domains`
--
ALTER TABLE `domains`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `drop_downs`
--
ALTER TABLE `drop_downs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `drop_down_options`
--
ALTER TABLE `drop_down_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=693;

--
-- AUTO_INCREMENT for table `endorsements`
--
ALTER TABLE `endorsements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_segments`
--
ALTER TABLE `sub_segments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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

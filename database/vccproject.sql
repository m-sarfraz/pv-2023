-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 07, 2021 at 02:35 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.3.29

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
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
(6, 'educational_attainment', 'EDUCATIONAL_ATTAINTMENT', '2021-09-03 06:41:43', '2021-09-03 06:41:43'),
(7, 'domains', 'Domains', '2021-09-06 11:08:31', '2021-09-06 11:08:31'),
(8, 'segments', 'SEGMENTS', '2021-09-06 11:12:43', '2021-09-06 11:12:43'),
(9, 'sub_segment', 'SUB SEGMENTS', '2021-09-06 11:25:16', '2021-09-06 11:25:16'),
(10, 'manner_of_invite', 'MANNER OF INVITE', '2021-09-06 11:36:30', '2021-09-06 11:36:30'),
(12, 'position_title', 'Position Title', '2021-09-07 03:03:55', '2021-09-07 03:03:55'),
(13, 'reason_for_not_progressing', 'Reason For Not Progressing', '2021-09-07 03:04:59', '2021-09-07 03:04:59'),
(14, 'remarks_for_recruiter', 'Remarks (For Recruiter)', '2021-09-07 03:05:39', '2021-09-07 03:05:39'),
(15, 'status', 'Status', '2021-09-07 03:06:17', '2021-09-07 03:06:17'),
(16, 'clients', 'Clients', '2021-09-07 03:06:38', '2021-09-07 03:06:38'),
(17, 'endorsement_type', 'Endorsement Type', '2021-09-07 03:07:02', '2021-09-07 03:07:02');

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
(2, 1, NULL, 'To Be Endorsed', 1, '2021-08-26 06:50:20', '2021-08-26 06:50:20'),
(3, 1, NULL, 'test 3', 1, '2021-08-26 07:03:00', '2021-08-26 07:03:00'),
(4, 1, NULL, 'test 4', 1, '2021-08-26 07:03:00', '2021-08-26 07:03:00'),
(8, 3, NULL, 'test 6', 1, '2021-08-26 08:10:26', '2021-08-26 08:10:26'),
(9, 3, NULL, 'test 7', 1, '2021-08-26 08:10:26', '2021-08-26 08:10:26'),
(10, 1, NULL, 'Failed to proceed', 1, '2021-08-30 06:39:36', '2021-08-30 06:39:36'),
(11, 4, 1, 'Withdrawn', 1, '2021-08-30 06:40:15', '2021-08-30 04:35:54'),
(12, 4, 1, 'Offer Accepted', 1, '2021-08-30 06:40:15', '2021-08-30 06:40:15'),
(13, 4, 1, 'On Boarded', 1, '2021-08-30 06:40:15', '2021-08-30 06:40:15'),
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
(31, 1, NULL, 'as2', 1, '2021-09-03 13:47:01', '2021-09-03 13:47:01'),
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
(67, 10, NULL, 'Pending', 1, '2021-09-06 11:37:19', '2021-09-06 11:37:19'),
(68, 10, NULL, 'EMAIL', 1, '2021-09-06 11:37:19', '2021-09-06 11:37:19'),
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
(203, 2, NULL, 'IT Manager', 1, '2021-09-07 07:51:46', '2021-09-07 07:51:46');

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
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
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
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
-- Table structure for table `sub_segments`
--

CREATE TABLE `sub_segments` (
  `id` int(11) NOT NULL,
  `sub_segment_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sub_segments`
--

INSERT INTO `sub_segments` (`id`, `sub_segment_name`, `created_at`, `updated_at`) VALUES
(2, 'sub segment 2', '2021-09-07 05:59:16', '2021-09-07 05:59:16'),
(3, 'sub segment 3', '2021-09-07 05:59:16', '2021-09-07 05:59:16');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `drop_downs`
--
ALTER TABLE `drop_downs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `drop_down_options`
--
ALTER TABLE `drop_down_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=204;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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

-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2019 at 09:02 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `medbase`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `admin_type` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `admin_type`) VALUES
(1, 'admin', 'admin', 'Primary Admin');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `doctor_specialty` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `secretary`
--

CREATE TABLE `secretary` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `department` varchar(200) NOT NULL,
  `secr_type` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `first_name` varchar(250) NOT NULL,
  `last_name` varchar(250) NOT NULL,
  `age` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `p_job` varchar(250) NOT NULL,
  `c_job` varchar(250) NOT NULL,
  `looking_for` varchar(250) NOT NULL,
  `education_lvl` varchar(250) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_pic` varchar(150) DEFAULT NULL,
  `upload_cv` varchar(255) DEFAULT NULL,
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `first_name`, `last_name`, `age`, `email`, `p_job`, `c_job`, `looking_for`, `education_lvl`, `password`, `profile_pic`, `upload_cv`, `time`) VALUES
(1, '', 'Kostas1', 'Zotos1', 22, 'kzwtos@gmail.com', 'IT2', 'Frontend developer2', 'Frontend developer2', 'BSC CS2', 'a2sxOGVmNDk5NWU1MDRjZGMxNGE1ODdhZjQ3ZTY0MzJmZg==', NULL, NULL, '2019-04-20 15:47:48'),
(2, '', 'Arnold', 'Zeis', 55, 'zeis@gmail.com', 'IT', 'Backend', 'Frontend engineer', 'BSC CS', 'ejE4ZWY0OTk1ZTUwNGNkYzE0YTU4N2FmNDdlNjQzMmZm', NULL, NULL, '2019-04-20 16:09:43'),
(6, '', 'Kostasaaaa', '', 0, '', '', '', '', '', 'MThlZjQ5OTVlNTA0Y2RjMTRhNTg3YWY0N2U2NDMyZmY=', NULL, NULL, '2019-04-21 23:10:29'),
(7, '', 'asd', 'asd', 0, 'asd@asd.gr', '', '', 'asd', '', 'YXNkMThlZjQ5OTVlNTA0Y2RjMTRhNTg3YWY0N2U2NDMyZmY=', NULL, NULL, '2019-04-21 23:12:06'),
(8, '', 'uploadTest', 'upload', 0, 'upload@upload.gr', '', '', 'upload', '', 'dXBsb2FkMThlZjQ5OTVlNTA0Y2RjMTRhNTg3YWY0N2U2NDMyZmY=', NULL, '150995.png', '2019-04-22 00:00:37'),
(19, '', 'ii', 'ii', 44, 'ii@ii.gr', 'ii', 'ii', 'ii', 'ii', 'aWkxOGVmNDk5NWU1MDRjZGMxNGE1ODdhZjQ3ZTY0MzJmZg==', NULL, '601044.png', '2019-04-27 13:59:33'),
(20, '', 'yy', 'yy', 34, 'yy@yy.gr', 'IT', 'Frontend', 'Backend', 'yy', 'eXkxOGVmNDk5NWU1MDRjZGMxNGE1ODdhZjQ3ZTY0MzJmZg==', NULL, '345658.png', '2019-04-27 14:01:06'),
(21, '', 'test11', 'test11', 22, 'test11@test.gr', 'React', 'Frontend', 'Frontend', 'test', 'dGVzdDE4ZWY0OTk1ZTUwNGNkYzE0YTU4N2FmNDdlNjQzMmZm', NULL, '261372.png', '2019-04-27 14:02:57'),
(22, '', 'CityUnity', 'City2', 23, 'cityu@city.gr', 'Student', 'Frontend', 'Backend', 'CS', 'MTE4ZWY0OTk1ZTUwNGNkYzE0YTU4N2FmNDdlNjQzMmZm', NULL, '954729.png', '2019-04-27 14:04:37'),
(23, 'admin', 'admin', 'admin', 22, 'a@a.gmail.com', '', '', '', '', 'a', '', NULL, '2019-08-17 19:28:00'),
(24, 'n', 'n', 'n', 44, 'n@gmail.com', 'n', 'n', 'n', '', 'n', NULL, NULL, '2019-08-17 20:28:24'),
(25, '', '', '', 0, 'd', '', '', '', '', 'MThlZjQ5OTVlNTA0Y2RjMTRhNTg3YWY0N2U2NDMyZmY=', NULL, NULL, '2019-08-23 12:35:56'),
(26, '', 'd', 'd', 0, 'asdf@gmail.com', '', '', '', '', 'MTE4ZWY0OTk1ZTUwNGNkYzE0YTU4N2FmNDdlNjQzMmZm', NULL, NULL, '2019-08-23 12:39:47'),
(27, '', 'c', 'c', 0, 'c@gmail.com', '', '', '', '', 'YzE4ZWY0OTk1ZTUwNGNkYzE0YTU4N2FmNDdlNjQzMmZm', NULL, NULL, '2019-08-26 13:10:03'),
(28, '', 'b', 'b', 0, 'b@gmail.com', '', '', '', '', 'YjE4ZWY0OTk1ZTUwNGNkYzE0YTU4N2FmNDdlNjQzMmZm', NULL, NULL, '2019-08-26 13:11:09'),
(29, '', 'm', 'm', 0, 'm', '', '', '', '', 'MThlZjQ5OTVlNTA0Y2RjMTRhNTg3YWY0N2U2NDMyZmY=', NULL, NULL, '2019-08-26 13:13:37'),
(30, '', 'h', 'h', 0, 'h', '', '', '', '', 'aDE4ZWY0OTk1ZTUwNGNkYzE0YTU4N2FmNDdlNjQzMmZm', NULL, NULL, '2019-08-26 13:15:06'),
(31, '', 't', 't', 0, 't', '', '', '', '', 'dDE4ZWY0OTk1ZTUwNGNkYzE0YTU4N2FmNDdlNjQzMmZm', NULL, NULL, '2019-08-26 14:22:19'),
(32, '', 'k', 'k', 0, 'k', '', '', '', '', 'azE4ZWY0OTk1ZTUwNGNkYzE0YTU4N2FmNDdlNjQzMmZm', NULL, NULL, '2019-08-26 14:31:48'),
(33, '', 'f', 'f', 0, 'f', '', '', '', '', 'ZjE4ZWY0OTk1ZTUwNGNkYzE0YTU4N2FmNDdlNjQzMmZm', NULL, NULL, '2019-09-01 19:26:03'),
(34, '', 'e', 'e', 0, 'e', '', '', '', '', 'ZTE4ZWY0OTk1ZTUwNGNkYzE0YTU4N2FmNDdlNjQzMmZm', NULL, NULL, '2019-09-01 19:28:49'),
(35, '', 'i', 'i', 0, 'i', '', '', '', '', 'aTE4ZWY0OTk1ZTUwNGNkYzE0YTU4N2FmNDdlNjQzMmZm', NULL, NULL, '2019-09-01 19:29:59'),
(36, '', 'p', 'p', 0, 'p', '', '', '', '', 'cDE4ZWY0OTk1ZTUwNGNkYzE0YTU4N2FmNDdlNjQzMmZm', NULL, NULL, '2019-09-01 19:31:31'),
(37, '', 'o', 'o', 0, 'o', '', '', '', '', 'bzE4ZWY0OTk1ZTUwNGNkYzE0YTU4N2FmNDdlNjQzMmZm', NULL, NULL, '2019-09-01 19:33:02'),
(38, '', 'v', 'v', 0, 'v', '', '', '', '', 'djE4ZWY0OTk1ZTUwNGNkYzE0YTU4N2FmNDdlNjQzMmZm', NULL, NULL, '2019-09-01 19:33:29'),
(39, '', 'r', 'r', 0, 'r', '', '', '', '', 'cjE4ZWY0OTk1ZTUwNGNkYzE0YTU4N2FmNDdlNjQzMmZm', NULL, NULL, '2019-09-01 19:34:35'),
(40, '', 'a', 'a', 0, 'a', '', '', '', '', 'YTE4ZWY0OTk1ZTUwNGNkYzE0YTU4N2FmNDdlNjQzMmZm', NULL, NULL, '2019-09-01 19:40:05'),
(41, '', 'gg', 'gg', 0, 'gg', '', '', '', '', 'Z2cxOGVmNDk5NWU1MDRjZGMxNGE1ODdhZjQ3ZTY0MzJmZg==', NULL, NULL, '2019-09-01 19:49:16'),
(42, '', 'q', 'q', 0, 'q', '', '', '', '', 'cTE4ZWY0OTk1ZTUwNGNkYzE0YTU4N2FmNDdlNjQzMmZm', NULL, NULL, '2019-09-07 12:44:36'),
(43, '', 'asdasd', 'asdsad', 0, 'asdsad', '', '', '', '', 'YXNkYXNkMThlZjQ5OTVlNTA0Y2RjMTRhNTg3YWY0N2U2NDMyZmY=', NULL, NULL, '2019-09-07 13:44:17'),
(44, '', 'bb', 'bb', 0, 'bb', '', '', '', '', 'YmIxOGVmNDk5NWU1MDRjZGMxNGE1ODdhZjQ3ZTY0MzJmZg==', NULL, NULL, '2019-09-07 13:52:36'),
(45, '', 'nn', 'nn', 0, 'nn', '', '', '', '', 'bm4xOGVmNDk5NWU1MDRjZGMxNGE1ODdhZjQ3ZTY0MzJmZg==', NULL, NULL, '2019-09-07 14:12:47'),
(46, '', 'ss', 'ss', 0, 'ss', '', '', '', '', 'c3MxOGVmNDk5NWU1MDRjZGMxNGE1ODdhZjQ3ZTY0MzJmZg==', NULL, NULL, '2019-09-07 14:15:41'),
(47, '', 'ss', 'ss', 0, 'asd@', '', '', '', '', 'czE4ZWY0OTk1ZTUwNGNkYzE0YTU4N2FmNDdlNjQzMmZm', NULL, NULL, '2019-09-07 14:20:38'),
(48, '', 'ss', 'ss', 0, 'dd@dd.gr', '', '', '', '', 'c3MxOGVmNDk5NWU1MDRjZGMxNGE1ODdhZjQ3ZTY0MzJmZg==', NULL, NULL, '2019-09-07 14:24:26'),
(49, '', 'dd', 'dd', 0, 'dd@dd', '', '', '', '', 'ZGQxOGVmNDk5NWU1MDRjZGMxNGE1ODdhZjQ3ZTY0MzJmZg==', NULL, NULL, '2019-09-07 14:26:02'),
(50, '', 'dddddd', 'ddddd', 0, 'ss@ss', '', '', '', '', 'c2QxOGVmNDk5NWU1MDRjZGMxNGE1ODdhZjQ3ZTY0MzJmZg==', NULL, NULL, '2019-09-07 14:27:01'),
(51, '', 'ssdsds', 'dsds', 0, 'sdsdsd@sd.gr', '', '', '', '', 'c2QxOGVmNDk5NWU1MDRjZGMxNGE1ODdhZjQ3ZTY0MzJmZg==', NULL, NULL, '2019-09-07 14:28:55'),
(52, '', 'ss', 'ss', 0, 'ss@sss.gr', '', '', '', '', 'c3MxOGVmNDk5NWU1MDRjZGMxNGE1ODdhZjQ3ZTY0MzJmZg==', NULL, NULL, '2019-09-07 14:43:12'),
(53, '', 'dd', 'dd', 0, 'tre@tre', '', '', '', '', 'ZGQxOGVmNDk5NWU1MDRjZGMxNGE1ODdhZjQ3ZTY0MzJmZg==', NULL, NULL, '2019-09-07 14:43:28'),
(54, '', 'asd', 'asd', 0, 'asd', '', '', '', '', 'YXNkMThlZjQ5OTVlNTA0Y2RjMTRhNTg3YWY0N2U2NDMyZmY=', NULL, NULL, '2019-09-07 15:04:17'),
(55, '', 'dsd', 'sd', 0, 'sd@gmail.com', '', '', '', '', 'c2QxOGVmNDk5NWU1MDRjZGMxNGE1ODdhZjQ3ZTY0MzJmZg==', NULL, NULL, '2019-09-07 15:13:43'),
(56, '', 'sd', 'sd', 0, 'sdfsdfsdf@hotmail.com', '', '', '', '', 'c2QxOGVmNDk5NWU1MDRjZGMxNGE1ODdhZjQ3ZTY0MzJmZg==', NULL, NULL, '2019-09-07 15:23:43'),
(57, '', 'gfhjgfh', 'jgfhjh', 0, 'fghjfhj@sadsad.co', '', '', '', '', 'Z2ZoajE4ZWY0OTk1ZTUwNGNkYzE0YTU4N2FmNDdlNjQzMmZm', NULL, NULL, '2019-09-07 16:18:05'),
(58, '', 'aa', 'aa', 0, 'conzwt@hotmail.com', '', '', '', '', 'YVNkMyM0ZGYxOGVmNDk5NWU1MDRjZGMxNGE1ODdhZjQ3ZTY0MzJmZg==', NULL, NULL, '2019-10-19 20:49:49'),
(59, 'a', '', '', 0, '', '', '', '', '', 'a', NULL, NULL, '2019-10-19 20:58:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `secretary`
--
ALTER TABLE `secretary`
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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

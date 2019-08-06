-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2019 at 05:10 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `great_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `ability`
--

CREATE TABLE `ability` (
  `ability_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subject` varchar(20) NOT NULL,
  `resume` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `add_date` varchar(10) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `seen_num` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `chat_message`
--

CREATE TABLE `chat_message` (
  `m_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `send_date` varchar(10) NOT NULL,
  `send_time` varchar(5) NOT NULL,
  `m_text` varchar(500) NOT NULL,
  `m_seen` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `file_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `file_inf`
--

CREATE TABLE `file_inf` (
  `f_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `eye_level` tinyint(1) NOT NULL DEFAULT '0',
  `send_date` varchar(10) NOT NULL,
  `send_time` varchar(5) NOT NULL,
  `file_url` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `student_profile`
--

CREATE TABLE `student_profile` (
  `s_id` varchar(7) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `email` varchar(40) DEFAULT NULL,
  `friend_list` varchar(1000) DEFAULT NULL,
  `chat_list` varchar(1000) DEFAULT NULL,
  `about_me` varchar(100) DEFAULT ' ',
  `last_date` varchar(10) NOT NULL,
  `last_time` varchar(5) NOT NULL,
  `name_el` tinyint(1) NOT NULL DEFAULT '1',
  `phone_el` tinyint(1) NOT NULL DEFAULT '1',
  `img_el` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_profile`
--

INSERT INTO `student_profile` (`s_id`, `user_id`, `user_name`, `email`, `friend_list`, `chat_list`, `about_me`, `last_date`, `last_time`, `name_el`, `phone_el`, `img_el`) VALUES
('3333333', 2, 'javad', NULL, '[\"3\",\"1\"]', NULL, ' ', '', '', 1, 1, 1),
('9431443', 1, 'mostafa', NULL, '[\"2\"]', NULL, ' ', '', '', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `api_code` varchar(30) NOT NULL,
  `pass` varchar(12) DEFAULT NULL,
  `kind` tinyint(1) NOT NULL,
  `join_date` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `phone`, `api_code`, `pass`, `kind`, `join_date`) VALUES
(1, '915', '915', '123', 1, '1397/08/05'),
(2, '9', '9', '123', 1, '1397/12/21');

-- --------------------------------------------------------

--
-- Table structure for table `verify_code`
--

CREATE TABLE `verify_code` (
  `code` varchar(6) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `send_date` varchar(10) NOT NULL,
  `send_time` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `work_sample`
--

CREATE TABLE `work_sample` (
  `work_sample_id` int(11) NOT NULL,
  `ability_id` int(11) NOT NULL,
  `subject` varchar(20) NOT NULL,
  `description` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `add_date` varchar(10) NOT NULL,
  `seen_num` int(11) NOT NULL DEFAULT '0',
  `like_num` int(11) NOT NULL DEFAULT '0',
  `img_num` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ability`
--
ALTER TABLE `ability`
  ADD PRIMARY KEY (`ability_id`);

--
-- Indexes for table `chat_message`
--
ALTER TABLE `chat_message`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `file_inf`
--
ALTER TABLE `file_inf`
  ADD PRIMARY KEY (`f_id`);

--
-- Indexes for table `student_profile`
--
ALTER TABLE `student_profile`
  ADD PRIMARY KEY (`s_id`,`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`,`phone`,`api_code`);

--
-- Indexes for table `verify_code`
--
ALTER TABLE `verify_code`
  ADD PRIMARY KEY (`phone`);

--
-- Indexes for table `work_sample`
--
ALTER TABLE `work_sample`
  ADD PRIMARY KEY (`work_sample_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ability`
--
ALTER TABLE `ability`
  MODIFY `ability_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chat_message`
--
ALTER TABLE `chat_message`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `file_inf`
--
ALTER TABLE `file_inf`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `work_sample`
--
ALTER TABLE `work_sample`
  MODIFY `work_sample_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

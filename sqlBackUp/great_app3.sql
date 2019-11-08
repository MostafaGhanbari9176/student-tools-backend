-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2019 at 08:25 PM
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
  `subject` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `resume` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `add_date` varchar(10) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `seen_num` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ads_group`
--

CREATE TABLE `ads_group` (
  `g_id` int(11) NOT NULL,
  `g_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ads_group`
--

INSERT INTO `ads_group` (`g_id`, `g_name`) VALUES
(1, 'تخفیف خورده');

-- --------------------------------------------------------

--
-- Table structure for table `ads_table`
--

CREATE TABLE `ads_table` (
  `a_id` int(11) NOT NULL,
  `a_sub` varchar(30) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `a_text` varchar(500) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `store_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `a_link` varchar(30) CHARACTER SET utf8 COLLATE utf8_persian_ci DEFAULT NULL,
  `group_id` int(11) NOT NULL,
  `feild_id` int(11) NOT NULL,
  `a_date` varchar(10) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `seen` int(11) NOT NULL DEFAULT '0',
  `special` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `m_id` int(11) NOT NULL,
  `m_text` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `m_date` varchar(10) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `m_time` varchar(5) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `like_list` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seen_num` int(11) NOT NULL DEFAULT '0',
  `file_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`m_id`, `m_text`, `m_date`, `m_time`, `like_list`, `seen_num`, `file_id`, `user_id`, `status`) VALUES
(1, 'تست', '1398-06-18', '22:32', '[\"1\",\"2\"]', 0, 1, 1, '1'),
(2, 'Hello every body :)\n\nwhen i use drawMarquee to show message, i would letter close together but i see one pixel space between letters.\n\nhow i can remove this one pixel space (maybe : with rebuild library) ?\n\nthanks.', '1397-02-02', '16:30', '[\"2\"]', 0, 1, 2, '0'),
(3, 'in first I thanks again for fart in my project', '1398-07-04', '14:29', '[\"1\"]', 0, 0, 1, '0'),
(4, 'لاوا لابا داب داب', '1398-07-04', '17:03', NULL, 0, 1, 2, '0');

-- --------------------------------------------------------

--
-- Table structure for table `course_group`
--

CREATE TABLE `course_group` (
  `g_id` int(11) NOT NULL,
  `g_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_group`
--

INSERT INTO `course_group` (`g_id`, `g_name`) VALUES
(1, 'ریاتیک'),
(2, 'برق');

-- --------------------------------------------------------

--
-- Table structure for table `course_table`
--

CREATE TABLE `course_table` (
  `c_id` int(11) NOT NULL,
  `c_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `c_text` varchar(150) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `c_date` varchar(10) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `group_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL DEFAULT '0',
  `owner_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seen` int(11) NOT NULL DEFAULT '0',
  `special` tinyint(1) NOT NULL DEFAULT '0',
  `phone` varchar(11) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL,
  `email` varchar(30) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL,
  `website` varchar(30) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL,
  `social` varchar(30) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_table`
--

INSERT INTO `course_table` (`c_id`, `c_name`, `c_text`, `c_date`, `group_id`, `field_id`, `owner_name`, `seen`, `special`, `phone`, `email`, `website`, `social`) VALUES
(1, 'آموزش مقدماتی آردوینو', 'در این دوره دانشجو ایتدا اشنا می شود', '1397-02-05', 1, 0, 'قنبری', 11, 0, '09157474', NULL, NULL, NULL),
(2, 'آموزش الکترومغناطیس', 'در این دوره', '1397-08-08', 2, 0, 'قنبری', 0, 0, '09157474087', NULL, 'www.mostafaghanbari.ir', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `field`
--

CREATE TABLE `field` (
  `field_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `name_text` varchar(40) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `field`
--

INSERT INTO `field` (`field_id`, `parent_id`, `name_text`) VALUES
(1, -1, 'دانشکده مهندسی برق و کامپیوتر'),
(2, -1, 'دانشکده مهندسی شهید نیکبخت'),
(3, -1, 'دانشکده مدیریت و اقتصاد'),
(4, -1, 'دانشکده هنر و معماری'),
(5, -1, 'دانشکده ادبیات و علوم انسانی'),
(6, -1, 'دانشکده الهیات و معارف اسلامی'),
(7, -1, 'دانشکده علوم تربیتی و روانشناس'),
(8, -1, 'علوم پایه'),
(9, -1, 'دانشکده جغرافیا و برنامه ریزی'),
(10, -1, 'دانشکده علوم زیست محیطی و کشاو'),
(11, -1, 'دانشکده ریاضی، آمار و علوم کام'),
(12, 1, 'مهندسی کامپیوتر'),
(13, 1, 'مهندسی برق'),
(14, 2, 'مهندسی شیمی'),
(15, 2, 'مهندسی مواد'),
(16, 2, 'مهندسی صنایع'),
(17, 2, 'مهندسی عمران'),
(18, 2, 'مهندسی معدن'),
(19, 2, 'مهندسی مکانیک'),
(20, 3, 'علوم اقتصادی'),
(21, 3, 'حسابداری'),
(22, 3, 'مدیریت دولتی و فناوری اطلاعات'),
(23, 3, 'مدیریت مالی و بازرگانی'),
(24, 3, 'کارآفرینی'),
(25, 4, 'پژوهش هنر'),
(26, 4, 'حفاظت و مرمت بناهای تاریخی'),
(27, 4, 'صنایع دستی'),
(28, 4, 'فرش'),
(29, 4, 'نقاشی'),
(30, 4, 'مهندسی معماری'),
(31, 5, 'زبان و ادبیات فارسی'),
(32, 5, 'زبان و ادبیات انگلیسی'),
(33, 5, 'زبان و ادبیات عربی'),
(34, 5, 'علوم اجتماعی'),
(35, 5, 'تاریخ'),
(36, 5, 'باستان شناسی'),
(37, 5, 'علوم سیاسی'),
(38, 6, 'معارف اسلامی'),
(39, 6, 'فقه و مبانی حقوق اسلامی'),
(40, 6, 'فلسفه و حکمت اسلامی'),
(41, 6, 'علوم قرآن و حدیث'),
(42, 6, 'ادیان و عرفان تطبیقی'),
(43, 7, 'علوم تربیتی'),
(44, 7, 'روانشناسی'),
(45, 7, 'تربیت بدنی'),
(46, 8, 'شیمی'),
(47, 8, 'فیزیک'),
(48, 8, 'زمین شناسی'),
(49, 8, 'زیست شناسی'),
(50, 9, 'جغرافیا و برنامه ریزی شهری'),
(51, 9, 'جغرافیا و برنامه ریزی روستایی'),
(52, 9, 'جغرافیای طبیعی'),
(53, 10, 'اقتصاد کشاورزی'),
(54, 10, 'مهندسی فضای سبز'),
(55, 11, 'ریاضی'),
(56, 11, 'آمار'),
(57, 11, 'علوم کامپیوتر');

-- --------------------------------------------------------

--
-- Table structure for table `file_inf`
--

CREATE TABLE `file_inf` (
  `f_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `eye_level` tinyint(1) NOT NULL DEFAULT '0',
  `up_date` varchar(10) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `up_time` varchar(5) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `dir_name` varchar(20) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `f_type` varchar(10) CHARACTER SET ascii COLLATE ascii_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `group_chat`
--

CREATE TABLE `group_chat` (
  `g_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `g_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `c_date` varchar(10) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `c_time` varchar(5) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `member_list` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `join_mode` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 => inviteOnly',
  `invite_mode` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 => OnlyMe',
  `g_info` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invite`
--

CREATE TABLE `invite` (
  `i_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `expired` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `news_agency`
--

CREATE TABLE `news_agency` (
  `a_id` int(11) NOT NULL,
  `a_sub` varchar(30) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `a_link` varchar(30) CHARACTER SET ascii COLLATE ascii_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news_agency`
--

INSERT INTO `news_agency` (`a_id`, `a_sub`, `a_link`) VALUES
(1, 'agency1', 'www.agency1.com'),
(2, 'agency2', 'www.agency2.com');

-- --------------------------------------------------------

--
-- Table structure for table `news_group`
--

CREATE TABLE `news_group` (
  `g_id` int(11) NOT NULL,
  `g_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news_group`
--

INSERT INTO `news_group` (`g_id`, `g_name`) VALUES
(1, 'college'),
(2, 'sport'),
(3, 'technology');

-- --------------------------------------------------------

--
-- Table structure for table `news_table`
--

CREATE TABLE `news_table` (
  `n_id` int(11) NOT NULL,
  `n_sub` varchar(30) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `lead` varchar(100) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `n_text` varchar(500) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `agency_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `n_date` varchar(10) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `n_link` varchar(30) CHARACTER SET utf8 COLLATE utf8_persian_ci DEFAULT NULL,
  `seen` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news_table`
--

INSERT INTO `news_table` (`n_id`, `n_sub`, `lead`, `n_text`, `agency_id`, `group_id`, `n_date`, `n_link`, `seen`, `status`) VALUES
(1, 'استقلال', 'esteghlal lead lead leadesteghlal lead lead leadesteghlal lead lead lead', 'esteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal text', 1, 2, '1397-02-02', 'www.com', 4, 0),
(2, 'استقلال', 'esteghlal lead lead leadesteghlal lead lead leadesteghlal lead lead lead', 'esteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal text', 2, 1, '1397-02-02', 'www.com', 0, 1),
(3, 'استقلال', 'esteghlal lead lead leadesteghlal lead lead leadesteghlal lead lead lead', 'esteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal text', 1, 1, '1397-02-02', 'www.com', 19, 0),
(4, 'استقلال', 'esteghlal lead lead leadesteghlal lead lead leadesteghlal lead lead lead', 'esteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal text', 2, 3, '1397-02-02', 'www.com', 5, 0),
(5, 'استقلال', 'esteghlal lead lead leadesteghlal lead lead leadesteghlal lead lead lead', 'esteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal text', 1, 1, '1397-02-02', 'www.com', 2, 0),
(6, 'استقلال', 'esteghlal lead lead leadesteghlal lead lead leadesteghlal lead lead lead', 'esteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal text', 2, 1, '1397-02-02', 'www.com', 1, 0),
(7, 'استقلال', 'esteghlal lead lead leadesteghlal lead lead leadesteghlal lead lead lead', 'esteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal text', 1, 1, '1397-02-02', 'www.com', 18, 0),
(8, 'استقلال', 'esteghlal lead lead leadesteghlal lead lead leadesteghlal lead lead lead', 'esteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal text', 2, 1, '1397-02-02', 'www.com', 2, 0),
(9, 'استقلال', 'esteghlal lead lead leadesteghlal lead lead leadesteghlal lead lead lead', 'esteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal text', 1, 1, '1397-02-02', 'www.com', 2, 0),
(10, 'استقلال', 'esteghlal lead lead leadesteghlal lead lead leadesteghlal lead lead lead', 'esteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal text', 1, 1, '1397-02-02', 'www.com', 19, 0),
(11, 'استقلال', 'esteghlal lead lead leadesteghlal lead lead leadesteghlal lead lead lead', 'esteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal text', 2, 1, '1397-02-02', 'www.com', 2, 0),
(12, 'استقلال', 'esteghlal lead lead leadesteghlal lead lead leadesteghlal lead lead lead', 'esteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal text', 1, 1, '1397-02-02', 'www.com', 2, 0),
(13, 'استقلال', 'esteghlal lead lead leadesteghlal lead lead leadesteghlal lead lead lead', 'esteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal text', 2, 1, '1397-02-02', 'www.com', 0, 0),
(14, 'استقلال', 'esteghlal lead lead leadesteghlal lead lead leadesteghlal lead lead lead', 'esteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal text', 1, 1, '1397-02-02', 'www.com', 18, 0),
(15, 'استقلال', 'esteghlal lead lead leadesteghlal lead lead leadesteghlal lead lead lead', 'esteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal textesteghlal text', 2, 1, '1397-02-02', 'www.com', 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `student_profile`
--

CREATE TABLE `student_profile` (
  `s_id` varchar(7) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `field_id` int(11) NOT NULL,
  `friend_list` varchar(1000) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL,
  `chat_list` varchar(1000) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL,
  `group_list` varchar(1000) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL,
  `channel_list` varchar(1000) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL,
  `about_me` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `last_date` varchar(10) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `last_time` varchar(5) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `name_el` tinyint(1) NOT NULL DEFAULT '1',
  `phone_el` tinyint(1) NOT NULL DEFAULT '1',
  `img_el` tinyint(1) NOT NULL DEFAULT '1',
  `on_line` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `phone` varchar(11) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `api_code` varchar(30) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `pass` varchar(12) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL,
  `kind` tinyint(1) NOT NULL,
  `join_date` varchar(10) CHARACTER SET ascii COLLATE ascii_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `verify_code`
--

CREATE TABLE `verify_code` (
  `code` varchar(6) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `phone` varchar(11) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `send_date` varchar(10) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `send_time` varchar(5) CHARACTER SET ascii COLLATE ascii_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `work_sample`
--

CREATE TABLE `work_sample` (
  `work_sample_id` int(11) NOT NULL,
  `ability_id` int(11) NOT NULL,
  `subject` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `add_date` varchar(10) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `seen_num` int(11) NOT NULL DEFAULT '0',
  `like_list` varchar(500) CHARACTER SET armscii8 COLLATE armscii8_bin DEFAULT NULL,
  `img_num` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ability`
--
ALTER TABLE `ability`
  ADD PRIMARY KEY (`ability_id`);

--
-- Indexes for table `ads_group`
--
ALTER TABLE `ads_group`
  ADD PRIMARY KEY (`g_id`);

--
-- Indexes for table `ads_table`
--
ALTER TABLE `ads_table`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `course_group`
--
ALTER TABLE `course_group`
  ADD PRIMARY KEY (`g_id`);

--
-- Indexes for table `course_table`
--
ALTER TABLE `course_table`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `field`
--
ALTER TABLE `field`
  ADD PRIMARY KEY (`field_id`);

--
-- Indexes for table `file_inf`
--
ALTER TABLE `file_inf`
  ADD PRIMARY KEY (`f_id`);

--
-- Indexes for table `group_chat`
--
ALTER TABLE `group_chat`
  ADD PRIMARY KEY (`g_id`);

--
-- Indexes for table `invite`
--
ALTER TABLE `invite`
  ADD PRIMARY KEY (`i_id`);

--
-- Indexes for table `news_agency`
--
ALTER TABLE `news_agency`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `news_group`
--
ALTER TABLE `news_group`
  ADD PRIMARY KEY (`g_id`);

--
-- Indexes for table `news_table`
--
ALTER TABLE `news_table`
  ADD PRIMARY KEY (`n_id`);

--
-- Indexes for table `student_profile`
--
ALTER TABLE `student_profile`
  ADD PRIMARY KEY (`s_id`,`user_id`);
ALTER TABLE `student_profile` ADD FULLTEXT KEY `s_id` (`s_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`,`api_code`) USING BTREE,
  ADD UNIQUE KEY `phone` (`phone`);

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
-- AUTO_INCREMENT for table `ads_group`
--
ALTER TABLE `ads_group`
  MODIFY `g_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ads_table`
--
ALTER TABLE `ads_table`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `course_group`
--
ALTER TABLE `course_group`
  MODIFY `g_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `course_table`
--
ALTER TABLE `course_table`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `field`
--
ALTER TABLE `field`
  MODIFY `field_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `file_inf`
--
ALTER TABLE `file_inf`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `group_chat`
--
ALTER TABLE `group_chat`
  MODIFY `g_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invite`
--
ALTER TABLE `invite`
  MODIFY `i_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news_agency`
--
ALTER TABLE `news_agency`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `news_group`
--
ALTER TABLE `news_group`
  MODIFY `g_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `news_table`
--
ALTER TABLE `news_table`
  MODIFY `n_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `work_sample`
--
ALTER TABLE `work_sample`
  MODIFY `work_sample_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

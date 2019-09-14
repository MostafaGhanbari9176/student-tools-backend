-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2019 at 03:33 PM
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
-- Table structure for table `1s1`
--

CREATE TABLE `1s1` (
  `m_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `send_date` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `send_time` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `m_text` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `file_id` int(11) NOT NULL DEFAULT '0',
  `path_id` int(11) NOT NULL DEFAULT '0',
  `i_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `1s1`
--

INSERT INTO `1s1` (`m_id`, `user_id`, `send_date`, `send_time`, `m_text`, `status`, `file_id`, `path_id`, `i_id`) VALUES
(1, 1, '1398-06-18', '00:47', 'hi', 1, 0, 0, 0),
(2, 1, '1398-06-18', '12:12', 'jjjjjjjjjjjjjjj', 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `1s2`
--

CREATE TABLE `1s2` (
  `m_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `send_date` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `send_time` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `m_text` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `file_id` int(11) NOT NULL DEFAULT '0',
  `path_id` int(11) NOT NULL DEFAULT '0',
  `i_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `1s2`
--

INSERT INTO `1s2` (`m_id`, `user_id`, `send_date`, `send_time`, `m_text`, `status`, `file_id`, `path_id`, `i_id`) VALUES
(1, 1, '1398-06-18', '00:30', 'go', 1, 0, 0, 0),
(2, 1, '1398-06-18', '00:42', 'find', 1, 0, 0, 0),
(3, 1, '1398-06-18', '21:36', 'got', 1, 1, 2, 0),
(4, 1, '1398-06-18', '21:57', 'to', 1, 2, 3, 0),
(5, 1, '1398-06-18', '21:58', 'to his are', 1, 3, 4, 0),
(6, 1, '1398-06-18', '22:18', 'good day', 1, 4, 5, 0),
(7, 2, '1398-06-18', '22:31', 'did', 1, 0, 0, 0),
(8, 1, '1398-06-18', '22:31', 'hello bro', 1, 0, 0, 0),
(9, 2, '1398-06-19', '20:14', 'good', 1, 0, 0, 0),
(10, 1, '1398-06-19', '20:14', 'fgujb', 1, 0, 0, 0),
(11, 2, '1398-06-22', '01:06', 'message', 1, 0, 0, 4),
(12, 2, '1398-06-22', '01:11', 'message', 1, 0, 0, 5),
(13, 1, '1398-06-22', '01:17', 'hello', 1, 0, 0, 0),
(14, 2, '1398-06-22', '01:17', 'message', 1, 0, 0, 6),
(15, 2, '1398-06-22', '01:34', 'message', 1, 0, 0, 7),
(16, 2, '1398-06-22', '01:35', 'message', 1, 0, 0, 8),
(17, 2, '1398-06-22', '02:33', 'message', 1, 0, 0, 9),
(18, 2, '1398-06-22', '02:34', 'message', 1, 0, 0, 10),
(19, 2, '1398-06-22', '15:07', 'message', 1, 0, 0, 11);

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
  `add_date` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `seen_num` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `m_id` int(11) NOT NULL,
  `m_text` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `m_date` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `m_time` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(1, 'تست', '1398-06-18', '22:32', '[\"1\",\"2\"]', 0, 1, 1, '0'),
(2, 'Hello every body :)\n\nwhen i use drawMarquee to show message, i would letter close together but i see one pixel space between letters.\n\nhow i can remove this one pixel space (maybe : with rebuild library) ?\n\nthanks.', '1398-06-21', '16:30', '[\"2\",\"1\"]', 0, 1, 2, '0');

-- --------------------------------------------------------

--
-- Table structure for table `chat_message`
--

CREATE TABLE `chat_message` (
  `m_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `send_date` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `send_time` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `m_text` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `m_seen` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `file_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `field`
--

CREATE TABLE `field` (
  `field_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `name_text` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL
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
  `up_date` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `up_time` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dir_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `f_type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `file_inf`
--

INSERT INTO `file_inf` (`f_id`, `user_id`, `eye_level`, `up_date`, `up_time`, `dir_name`, `f_type`) VALUES
(1, 1, 0, '1398-06-18', '21:36', 'img', 'png'),
(2, 1, 0, '1398-06-18', '21:57', 'img', 'png'),
(3, 1, 0, '1398-06-18', '21:58', 'img', 'png'),
(4, 1, 0, '1398-06-18', '22:18', 'img', 'png'),
(5, 1, 0, '1398-06-21', '16:21', 'img', 'jpg');

-- --------------------------------------------------------

--
-- Table structure for table `g1`
--

CREATE TABLE `g1` (
  `m_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `send_date` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `send_time` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `m_text` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `file_id` int(11) NOT NULL DEFAULT '0',
  `path_id` int(11) NOT NULL DEFAULT '0',
  `i_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `g2`
--

CREATE TABLE `g2` (
  `m_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `send_date` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `send_time` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `m_text` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `file_id` int(11) NOT NULL DEFAULT '0',
  `path_id` int(11) NOT NULL DEFAULT '0',
  `i_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `g3`
--

CREATE TABLE `g3` (
  `m_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `send_date` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `send_time` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `m_text` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `file_id` int(11) NOT NULL DEFAULT '0',
  `path_id` int(11) NOT NULL DEFAULT '0',
  `i_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `g3`
--

INSERT INTO `g3` (`m_id`, `user_id`, `send_date`, `send_time`, `m_text`, `status`, `file_id`, `path_id`, `i_id`) VALUES
(1, 2, '1398-06-19', '12:46', 'good', 1, 0, 0, 0),
(2, 2, '1398-06-19', '12:59', 'that guy', 1, 0, 0, 0),
(3, 1, '1398-06-21', '16:15', 'hello', 1, 0, 0, 0),
(4, 1, '1398-06-21', '16:21', 'you are', 1, 5, 1, 0),
(5, 1, '1398-06-21', '16:23', 'hello any body online', 1, 0, 0, 0),
(6, 2, '1398-06-21', '16:25', ' I\'m online bro', 1, 0, 0, 0),
(7, 1, '1398-06-22', '15:08', 'hello????', 1, 0, 0, 0),
(8, 1, '1398-06-22', '15:16', 'HelloBro', 1, 0, 0, 0),
(9, 1, '1398-06-22', '15:20', '????', 1, 0, 0, 0),
(10, 1, '1398-06-22', '15:24', '😅', 1, 0, 0, 0),
(11, 1, '1398-06-22', '15:25', '😀😁😂😃😄😅😆😉😊😋😎😍😘😗😙😚☺🙂🤗😇🤔😐😑😶😪😯🤐😮😥😣😏🙄😫😴😌🤓😛😜😝🙁🤒😷🙃😖😕😔😓😒🤕🤑😲😞😟😤😢😭😳😱😰😬😩😨😧😦😵😡😠😈👿👹👺💀😹😸😺💩🤖👾👽👻', 1, 0, 0, 0),
(12, 1, '1398-06-22', '15:26', '🙉🙈😾😿🙀😽😼😻🙊👦👧👨👩👴👵👶🕵💂👸👷👳👲👮👱🎅👼👯💆💇👰🙍🙎🗣🙏🙌🙇🙋💁🙆🙅👤👥🚶🏃💃🕴👫👬👪👩‍❤️‍👩👨‍❤️‍👨💑👩‍❤️‍💋‍👩👨‍❤️‍💋‍👨💏👭👨‍👨‍👦👨‍👨‍👦‍👦👨‍👨‍👧👨‍👨‍👧‍👦👨‍👨‍👧‍👧👨‍👩‍👦👨‍👩‍👦‍👦👨‍👩‍👧💪👩‍👩‍👧‍👧👩‍👩‍👧‍👦👩‍👩‍👧👩‍👩‍👦‍👦👩‍👩‍👦👨‍👩‍👧‍👧👨‍👩‍👧‍👦👈👉☝👆🖕👇✌🖖👎👍👌👊✋✊🖐🤘👋👏👐💅👂👃👣👀💔💓❤💘💋👄👅👁💝💜💛💚💙💗💖💕💦💥💣💢💤💌💟💞🕳👁‍🗨💭🗯🗨💬💫💨👙👘👗👖👕👔🕶👓👟👞🎒🛍👝👜👛👚📿🎓🎩👒👑👢👡👠💎💍💄', 1, 0, 0, 0),
(13, 1, '1398-06-22', '15:27', '🐵🐒🐶🐕🐩🐺🐈🐈🐮🦄🐎🐴🐆🐅🐯🦁🐂🐃🐄🐷🐖🐗🐽🐁🐭🐘🐫🐪', 1, 0, 0, 0),
(14, 1, '1398-06-22', '15:27', 'سلام 😍 خوبی عشقم💓', 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `g4`
--

CREATE TABLE `g4` (
  `m_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `send_date` varchar(10) NOT NULL,
  `send_time` varchar(5) NOT NULL,
  `m_text` varchar(500) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `file_id` int(11) NOT NULL DEFAULT '0',
  `path_id` int(11) NOT NULL DEFAULT '0',
  `i_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `g4`
--

INSERT INTO `g4` (`m_id`, `user_id`, `send_date`, `send_time`, `m_text`, `status`, `file_id`, `path_id`, `i_id`) VALUES
(1, 1, '1398-06-22', '15:29', 'سلام به همه عشقه استیکرها?', 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `g5`
--

CREATE TABLE `g5` (
  `m_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `send_date` varchar(10) NOT NULL,
  `send_time` varchar(5) NOT NULL,
  `m_text` varchar(500) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `file_id` int(11) NOT NULL DEFAULT '0',
  `path_id` int(11) NOT NULL DEFAULT '0',
  `i_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `g5`
--

INSERT INTO `g5` (`m_id`, `user_id`, `send_date`, `send_time`, `m_text`, `status`, `file_id`, `path_id`, `i_id`) VALUES
(1, 1, '1398-06-22', '15:31', '?', 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `group_chat`
--

CREATE TABLE `group_chat` (
  `g_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `g_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `c_date` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `c_time` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `member_list` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `join_mode` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 => inviteOnly',
  `invite_mode` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 => OnlyMe',
  `g_info` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `group_chat`
--

INSERT INTO `group_chat` (`g_id`, `owner_id`, `g_name`, `c_date`, `c_time`, `member_list`, `join_mode`, `invite_mode`, `g_info`) VALUES
(1, 2, 'test', '1398-06-19', '12:33', '', 0, 0, 'test'),
(2, 2, 'test', '1398-06-19', '12:42', '[\"2\"]', 0, 0, 'test'),
(3, 2, 'AdvancedProgrammingUsb', '1398-06-19', '12:44', '[\"2\",\"1\"]', 0, 0, 'test'),
(4, 1, 'گروه تست استیکر', '1398-06-22', '15:28', '[-1,\"1\"]', 0, 0, 'بهترین استیکرهارا از ما بخواهید'),
(5, 1, 'استیکر طلایی', '1398-06-22', '15:30', '[-1,\"1\"]', 0, 0, 'استیکر طلایی تنها شعبه در ایران😎');

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

--
-- Dumping data for table `invite`
--

INSERT INTO `invite` (`i_id`, `group_id`, `user_id`, `owner_id`, `expired`) VALUES
(1, 3, 1, 2, 0),
(2, 3, 1, 2, 0),
(3, 3, 1, 2, 0),
(4, 3, 1, 2, 0),
(5, 3, 1, 2, 0),
(6, 3, 1, 2, 1),
(7, 3, 1, 2, 0),
(8, 3, 1, 2, 1),
(9, 3, 1, 2, 1),
(10, 3, 1, 2, 1),
(11, 3, 1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `student_profile`
--

CREATE TABLE `student_profile` (
  `s_id` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `friend_list` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chat_list` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group_list` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `channel_list` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_me` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `last_date` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_time` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_el` tinyint(1) NOT NULL DEFAULT '1',
  `phone_el` tinyint(1) NOT NULL DEFAULT '1',
  `img_el` tinyint(1) NOT NULL DEFAULT '1',
  `on_line` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_profile`
--

INSERT INTO `student_profile` (`s_id`, `user_id`, `user_name`, `email`, `friend_list`, `chat_list`, `group_list`, `channel_list`, `about_me`, `last_date`, `last_time`, `name_el`, `phone_el`, `img_el`, `on_line`) VALUES
('9431433', 2, 'mostafa2', NULL, '[\"1\"]', '[\"1\"]', '[\"3\"]', NULL, '', '1398-06-22', '01:49', 1, 1, 1, 1),
('9431443', 1, 'mostafaghanbari', NULL, '[]', '[\"2\",\"1\"]', '[\"3\",\"4\",\"5\"]', NULL, 'mostafa ghanbari the beset best', '1398-06-22', '15:31', 1, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `phone` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `api_code` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pass` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kind` tinyint(1) NOT NULL,
  `join_date` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `phone`, `api_code`, `pass`, `kind`, `join_date`) VALUES
(1, '09157474087', '0.78553200 1568329775', '123', 1, '1398-06-09'),
(2, '09157474088', '0.46548900 1568327872', '123', 1, '1398-06-10');

-- --------------------------------------------------------

--
-- Table structure for table `verify_code`
--

CREATE TABLE `verify_code` (
  `code` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `send_date` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `send_time` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `verify_code`
--

INSERT INTO `verify_code` (`code`, `phone`, `send_date`, `send_time`) VALUES
('000000', '09157474087', '1398-06-09', '15:01'),
('000000', '09157474088', '1398-06-10', '12:08');

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
  `add_date` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seen_num` int(11) NOT NULL DEFAULT '0',
  `like_list` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img_num` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `1s1`
--
ALTER TABLE `1s1`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `1s2`
--
ALTER TABLE `1s2`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `ability`
--
ALTER TABLE `ability`
  ADD PRIMARY KEY (`ability_id`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `chat_message`
--
ALTER TABLE `chat_message`
  ADD PRIMARY KEY (`m_id`);

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
-- Indexes for table `g1`
--
ALTER TABLE `g1`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `g2`
--
ALTER TABLE `g2`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `g3`
--
ALTER TABLE `g3`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `g4`
--
ALTER TABLE `g4`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `g5`
--
ALTER TABLE `g5`
  ADD PRIMARY KEY (`m_id`);

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
-- AUTO_INCREMENT for table `1s1`
--
ALTER TABLE `1s1`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `1s2`
--
ALTER TABLE `1s2`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `ability`
--
ALTER TABLE `ability`
  MODIFY `ability_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `chat_message`
--
ALTER TABLE `chat_message`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `field`
--
ALTER TABLE `field`
  MODIFY `field_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `file_inf`
--
ALTER TABLE `file_inf`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `g1`
--
ALTER TABLE `g1`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `g2`
--
ALTER TABLE `g2`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `g3`
--
ALTER TABLE `g3`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `g4`
--
ALTER TABLE `g4`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `g5`
--
ALTER TABLE `g5`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `group_chat`
--
ALTER TABLE `group_chat`
  MODIFY `g_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `invite`
--
ALTER TABLE `invite`
  MODIFY `i_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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

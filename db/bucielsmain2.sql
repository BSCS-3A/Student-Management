-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2021 at 09:50 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bucielsmain2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_fname` varchar(30) NOT NULL,
  `admin_mname` varchar(30) NOT NULL,
  `admin_lname` varchar(30) NOT NULL,
  `admin_position` varchar(30) NOT NULL,
  `comelec_position` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `photo` varchar(30) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_fname`, `admin_mname`, `admin_lname`, `admin_position`, `comelec_position`, `username`, `password`, `photo`, `reg_date`) VALUES
(1, 'John', 'UCANTSEEME', 'Cena', 'admin', 'admin', 'admin', 'admin', 'user.png', '2021-03-31 16:33:20'),
(2, 'Tomas', 'Mutya', 'Sace', 'Adviser', 'adviser', 'taclaskathrindenise@gmail.com', '6QLfkFgK', '', '2021-04-04 14:04:24'),
(3, 'Ariel', 'Bilal', 'Ongpauco', 'Admin', 'chairperson', 'stebo1034@gmail.com', 'CHN8jQWs', '', '2021-03-31 16:31:47'),
(4, 'Isaak', 'Pildilapil', 'Alba', 'Admin', 'secretary', 'makenilla28@gmail.com', 'CX8sCKtx', '', '2021-03-31 16:32:02'),
(5, 'Braedon', 'Lozo', 'Sibug', 'Admin', 'admin', 'eef4de@gmail.com', '8hcTDAjU', '', '2021-03-31 16:32:49'),
(6, 'Julien', 'Cader', 'Puno', 'Admin', 'admin', 'kerbymbart@gmail.com', 'AcsV7how', '', '2021-03-31 16:32:43'),
(7, 'John Wesley', '', 'Atega', 'Admin', 'admin', 'weakerz8@gmail.com', '3LqsTq4Q', '', '2021-03-31 16:32:36'),
(18, 'Anthony', 'Edward', 'Stark', 'Student Admin', 'CEO of bruh', 'iamironman@avengers.com', 'lol', 'IMG-606f1f5d643bb8.31446188.jp', '2021-04-08 15:21:01');

-- --------------------------------------------------------

--
-- Table structure for table `admin_activity_log`
--

CREATE TABLE `admin_activity_log` (
  `activity_log_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `activity_description` varchar(150) NOT NULL,
  `activity_date` date DEFAULT NULL,
  `activity_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_activity_log`
--

INSERT INTO `admin_activity_log` (`activity_log_id`, `admin_id`, `activity_description`, `activity_date`, `activity_time`) VALUES
(321, 1, 'Login', '2021-03-20', '10:55:55'),
(322, 1, 'Login', '2021-03-20', '10:56:41'),
(323, 1, 'Logout', '2021-03-20', '10:57:53'),
(324, 1, 'Login', '2021-03-20', '10:59:25'),
(325, 1, 'Logout', '2021-03-20', '11:00:58'),
(326, 1, 'Logout', '2021-03-20', '11:11:12'),
(327, 1, 'Login', '2021-03-20', '11:12:10'),
(328, 1, 'Logout', '2021-03-20', '11:12:20'),
(329, 4, 'Login', '2021-03-20', '11:55:45'),
(330, 4, 'Logout', '2021-03-20', '12:08:36'),
(331, 1, 'Login', '2021-03-20', '12:11:29'),
(332, 1, 'Login', '2021-03-20', '13:19:22'),
(333, 1, 'Logout', '2021-03-20', '13:22:17'),
(334, 1, 'Login', '2021-03-20', '13:22:52'),
(335, 1, 'Logout', '2021-03-20', '13:23:10'),
(336, 1, 'Login', '2021-03-20', '13:23:23'),
(337, 1, 'Logout', '2021-03-20', '13:24:12'),
(338, 1, 'Login', '2021-03-20', '15:15:48'),
(339, 1, 'Login', '2021-03-20', '15:24:40'),
(340, 1, 'Logout', '2021-03-20', '15:26:09'),
(341, 1, 'Login', '2021-03-20', '15:30:46'),
(342, 1, 'Logout', '2021-03-20', '15:31:39'),
(343, 1, 'Login', '2021-03-20', '15:42:49'),
(344, 1, 'Logout', '2021-03-20', '15:50:35'),
(345, 1, 'Login', '2021-03-20', '17:23:16'),
(346, 1, 'Login', '2021-03-20', '21:17:00'),
(347, 1, 'Login', '2021-03-20', '21:29:56'),
(348, 1, 'Logout', '2021-03-20', '21:31:12'),
(349, 1, 'Login', '2021-03-20', '21:31:52'),
(350, 1, 'Logout', '2021-03-20', '21:33:21'),
(351, 1, 'Login', '2021-03-20', '21:36:15'),
(352, 1, 'Logout', '2021-03-20', '21:43:10'),
(353, 1, 'Login', '2021-03-21', '14:19:11'),
(354, 1, 'Login', '2021-03-21', '14:28:34'),
(355, 1, 'Login', '2021-03-21', '14:40:02'),
(356, 1, 'Login', '2021-03-21', '17:46:27'),
(357, 1, 'Login', '2021-03-21', '18:17:12'),
(358, 1, 'Login', '2021-03-21', '19:35:51'),
(359, 1, 'Login', '2021-03-21', '20:04:55'),
(360, 1, 'Login', '2021-03-21', '20:19:10'),
(361, 1, 'Login', '2021-03-21', '22:31:54'),
(362, 1, 'Login', '2021-03-21', '22:39:30'),
(363, 1, 'Login', '2021-03-21', '22:55:21'),
(364, 1, 'Login', '2021-03-22', '01:14:27'),
(365, 1, 'Login', '2021-03-22', '08:18:17'),
(366, 1, 'Login', '2021-03-22', '10:55:32'),
(367, 1, 'Login', '2021-03-22', '12:47:41'),
(368, 1, 'Login', '2021-03-22', '13:20:46'),
(369, 1, 'Login', '2021-03-22', '13:30:34'),
(370, 1, 'Login', '2021-03-22', '14:02:18'),
(371, 1, 'Login', '2021-03-22', '14:23:40'),
(372, 1, 'Login', '2021-03-22', '20:59:41'),
(373, 1, 'Logout', '2021-03-22', '21:02:34'),
(380, 1, 'Deleted position:', '2021-03-22', '22:33:44'),
(381, 1, 'Login', '2021-03-22', '22:38:15'),
(382, 1, 'Login', '2021-03-23', '01:08:46'),
(383, 1, 'Login', '2021-03-23', '08:10:35'),
(384, 1, 'Login', '2021-03-23', '08:51:56'),
(385, 1, 'Login', '2021-03-23', '21:12:34'),
(386, 1, 'Login', '2021-03-24', '09:37:48'),
(387, 1, 'Login', '2021-03-24', '13:38:27'),
(388, 1, 'Login', '2021-03-25', '13:38:02'),
(389, 1, 'Login', '2021-03-25', '15:42:41'),
(390, 1, 'Login', '2021-03-25', '15:51:18'),
(391, 1, 'Login', '2021-03-25', '15:51:22'),
(392, 1, 'Login', '2021-03-25', '15:55:17'),
(393, 1, 'Login', '2021-03-25', '15:55:21'),
(394, 1, 'Login', '2021-03-25', '18:10:47'),
(395, 1, 'Login', '2021-03-25', '18:10:47'),
(396, 1, 'Login', '2021-03-25', '18:11:57'),
(397, 1, 'Login', '2021-03-26', '11:10:41'),
(398, 1, 'Login', '2021-03-27', '09:33:59'),
(399, 1, 'Login', '2021-03-27', '11:10:46'),
(400, 1, 'Login', '2021-03-27', '12:44:53'),
(401, 1, 'Login', '2021-03-28', '14:36:17'),
(402, 1, 'Login', '2021-03-29', '08:32:41'),
(403, 1, 'Login', '2021-03-29', '10:14:02'),
(404, 1, 'Logout', '2021-03-29', '10:30:59'),
(405, 1, 'Login', '2021-03-29', '10:31:04'),
(406, 1, 'Logout', '2021-03-29', '10:45:02'),
(407, 1, 'Login', '2021-03-29', '20:05:49'),
(408, 1, 'Login', '2021-03-29', '20:15:25'),
(409, 1, 'Login', '2021-03-29', '20:15:25'),
(410, 1, 'Login', '2021-03-30', '14:11:31'),
(411, 1, 'Login', '2021-03-31', '16:08:07'),
(412, 1, 'Logout', '2021-03-31', '16:08:24'),
(413, 1, 'Login', '2021-03-31', '16:09:14'),
(414, 1, 'Logout', '2021-03-31', '16:09:47'),
(415, 1, 'Login', '2021-03-31', '16:40:02'),
(416, 1, 'Logout', '2021-03-31', '16:40:17'),
(417, 1, 'Login', '2021-03-31', '16:40:22'),
(418, 1, 'Logout', '2021-03-31', '16:43:28'),
(419, 1, 'Login', '2021-03-31', '16:48:25'),
(420, 1, 'Logout', '2021-03-31', '16:48:38'),
(421, 1, 'Login', '2021-03-31', '16:55:04'),
(422, 1, 'Logout', '2021-03-31', '16:55:57'),
(423, 1, 'Login', '2021-03-31', '18:21:28'),
(424, 1, 'Logout', '2021-03-31', '18:23:11'),
(425, 1, 'Login', '2021-03-31', '21:22:27'),
(426, 1, 'Logout', '2021-03-31', '21:22:42'),
(427, 1, 'Login', '2021-03-31', '21:24:54'),
(428, 1, 'Login', '2021-03-31', '21:38:08'),
(429, 1, 'Login', '2021-03-31', '22:00:49'),
(430, 1, 'Logout', '2021-03-31', '22:00:57'),
(431, 1, 'Login', '2021-04-01', '01:32:28'),
(432, 1, 'Login', '2021-04-01', '10:24:22'),
(433, 1, 'Login', '2021-04-01', '10:41:25'),
(434, 1, 'Login', '2021-04-01', '15:12:25'),
(435, 1, 'Login', '2021-04-01', '15:22:26'),
(436, 1, 'Login', '2021-04-01', '18:58:43'),
(437, 1, 'Login', '2021-04-01', '21:36:27'),
(438, 1, 'Login', '2021-04-02', '10:08:46'),
(439, 1, 'Login', '2021-04-02', '11:06:31'),
(440, 1, 'Login', '2021-04-04', '20:25:50'),
(441, 1, 'Login', '2021-04-04', '20:56:13'),
(442, 1, 'Login', '2021-04-04', '22:09:35'),
(443, 1, 'Login', '2021-04-04', '22:26:03'),
(444, 1, 'Login', '2021-04-05', '17:57:40'),
(445, 1, 'Login', '2021-04-05', '18:04:12'),
(446, 1, 'Login', '2021-04-05', '18:15:38'),
(447, 1, 'Login', '2021-04-05', '19:13:44'),
(448, 1, 'Login', '2021-04-08', '20:34:56'),
(449, 1, 'Login', '2021-04-08', '22:19:31'),
(450, 1, 'Login', '2021-04-08', '22:20:27'),
(451, 1, 'Login', '2021-04-08', '22:20:47'),
(452, 1, 'Login', '2021-04-08', '22:21:50'),
(453, 1, 'Login', '2021-04-08', '22:29:51'),
(454, 1, 'Login', '2021-04-08', '22:32:00'),
(455, 1, 'Login', '2021-04-08', '22:33:45'),
(456, 1, 'Login', '2021-04-08', '22:38:33'),
(457, 1, 'Login', '2021-04-08', '22:56:21'),
(458, 1, 'Login', '2021-04-08', '23:01:02'),
(459, 1, 'Login', '2021-04-08', '23:01:25'),
(460, 1, 'Login', '2021-04-08', '23:10:27'),
(461, 1, 'Login', '2021-04-08', '23:13:14'),
(462, 1, 'Login', '2021-04-08', '23:35:24'),
(463, 1, 'Login', '2021-04-09', '00:11:28'),
(464, 1, 'Login', '2021-04-09', '18:00:30'),
(465, 1, 'Login', '2021-04-09', '21:02:58'),
(466, 1, 'Login', '2021-04-09', '21:12:44'),
(467, 1, 'Login', '2021-04-09', '22:08:06'),
(468, 1, 'Login', '2021-04-10', '10:58:57'),
(469, 1, 'Login', '2021-04-10', '17:52:51'),
(470, 1, 'Added position:', '2021-04-10', '18:45:45'),
(471, 1, 'Deleted position:', '2021-04-10', '18:45:53'),
(472, 1, 'Added position:', '2021-04-10', '18:46:04'),
(473, 1, 'Deleted position:', '2021-04-10', '18:52:28'),
(474, 1, 'Added position:ceo', '2021-04-10', '18:52:39'),
(475, 1, ' Updated to position ceooooo', '2021-04-10', '18:55:40'),
(476, 1, 'Deleted position:', '2021-04-10', '18:55:46'),
(477, 1, 'Added position:ceo', '2021-04-10', '18:55:53'),
(478, 1, 'Deleted position:', '2021-04-10', '18:56:18'),
(479, 1, 'Added position:asda', '2021-04-10', '18:56:40'),
(480, 1, 'Deleted position:', '2021-04-10', '18:56:50'),
(481, 1, 'Login', '2021-04-11', '19:33:37'),
(482, 1, 'Login', '2021-04-11', '19:33:38'),
(483, 1, 'Login', '2021-04-12', '22:09:01'),
(484, 1, 'Login', '2021-04-12', '22:34:55'),
(485, 1, 'Login', '2021-04-12', '22:53:15'),
(486, 1, 'Login', '2021-04-12', '23:17:10'),
(487, 1, 'Login', '2021-04-13', '13:25:16'),
(488, 1, 'Login', '2021-04-13', '14:17:15'),
(489, 1, 'Login', '2021-04-13', '20:46:21'),
(490, 1, 'Login', '2021-04-13', '20:50:20'),
(491, 1, 'Login', '2021-04-13', '22:03:26'),
(492, 1, 'Login', '2021-04-13', '22:03:48'),
(493, 1, 'Login', '2021-04-13', '22:05:18'),
(494, 1, 'Login', '2021-04-13', '22:24:17'),
(495, 1, 'Login', '2021-04-14', '01:42:05'),
(496, 1, 'Login', '2021-04-14', '16:18:44'),
(497, 1, 'Login', '2021-04-14', '16:46:16'),
(498, 1, 'Login', '2021-04-14', '17:13:11'),
(499, 1, 'Login', '2021-04-14', '19:37:42'),
(500, 1, 'Login', '2021-04-14', '21:42:13'),
(501, 1, 'Login', '2021-04-14', '23:26:26'),
(502, 1, 'Login', '2021-04-15', '01:40:22'),
(503, 1, 'Login', '2021-04-15', '20:10:47'),
(504, 1, 'Added position:ceo', '2021-04-15', '20:11:17'),
(505, 1, 'Deleted position:', '2021-04-15', '20:14:44'),
(506, 1, 'Deleted position:', '2021-04-15', '20:14:50'),
(507, 1, 'Added position:President', '2021-04-15', '20:15:03'),
(508, 1, 'Deleted position:', '2021-04-15', '20:34:37'),
(509, 1, 'Deleted position:', '2021-04-15', '20:35:49'),
(510, 1, 'Added position:Grade 11 Representative', '2021-04-15', '20:36:29'),
(511, 1, 'Deleted position:', '2021-04-15', '20:36:55'),
(512, 1, 'Added position:Grade 11 Representative', '2021-04-15', '20:37:27'),
(513, 1, 'Deleted position:', '2021-04-15', '20:37:33'),
(514, 1, 'Added position:Grade 11', '2021-04-15', '20:37:49'),
(515, 1, 'Deleted position:', '2021-04-15', '20:39:23'),
(516, 1, 'Deleted position:', '2021-04-15', '20:39:55'),
(517, 1, 'Deleted position:', '2021-04-15', '20:39:56'),
(518, 1, 'Deleted position:', '2021-04-15', '20:39:59'),
(519, 1, 'Deleted position:', '2021-04-15', '20:40:42'),
(520, 1, 'Added position:grade11', '2021-04-15', '20:40:58'),
(521, 1, 'Deleted position:', '2021-04-15', '20:41:03'),
(522, 1, 'Added position:gr11', '2021-04-15', '20:41:51'),
(523, 1, 'Deleted position:', '2021-04-15', '20:41:55'),
(524, 1, 'Added position:grade11', '2021-04-15', '20:46:34'),
(525, 1, 'Added position:asd', '2021-04-15', '20:47:30'),
(526, 1, 'Added position:asd', '2021-04-15', '20:56:19'),
(527, 1, 'Added position:as', '2021-04-15', '20:59:30'),
(528, 1, 'Added position:asd', '2021-04-15', '21:01:21'),
(529, 1, 'Added position:asd', '2021-04-15', '21:07:59'),
(530, 1, 'Added position:asd', '2021-04-15', '21:10:03'),
(531, 1, 'Added position:asd', '2021-04-15', '21:10:31'),
(532, 1, 'Added position:asd', '2021-04-15', '21:14:05'),
(533, 1, ' Updated to position asd', '2021-04-15', '21:29:43'),
(534, 1, 'Added position:asd', '2021-04-15', '21:30:42'),
(535, 1, 'Added position:asd', '2021-04-15', '21:31:46'),
(536, 1, 'Added position:asd', '2021-04-15', '21:37:00'),
(537, 1, 'Added position:asd', '2021-04-15', '21:37:13'),
(538, 1, 'Added position:asd', '2021-04-15', '21:39:07'),
(539, 1, 'Added position:asd', '2021-04-15', '22:00:58'),
(540, 1, 'Added position:asd', '2021-04-15', '22:01:49'),
(541, 1, 'Added position:asd', '2021-04-15', '22:05:28'),
(542, 1, 'Added position:asd', '2021-04-15', '22:06:00'),
(543, 1, 'Added position:asd', '2021-04-15', '22:07:22'),
(544, 1, 'Added position:asd', '2021-04-15', '22:08:11'),
(545, 1, 'Added position:asd', '2021-04-15', '22:13:23'),
(546, 1, 'Added position:asd', '2021-04-15', '22:14:34'),
(547, 1, 'Added position:asd', '2021-04-15', '22:15:05'),
(548, 1, 'Added position:asd', '2021-04-15', '22:15:37'),
(549, 1, 'Added position:Grade 11 Representative', '2021-04-15', '22:17:04'),
(550, 1, ' Updated to position Grade 12 Representative', '2021-04-15', '22:17:23'),
(551, 1, ' Updated to position Grade 12 Representative', '2021-04-15', '22:42:56'),
(552, 1, 'Login', '2021-04-15', '23:30:14'),
(553, 1, 'Login', '2021-04-16', '14:42:31'),
(554, 1, 'Added position:Grade 7 Representative', '2021-04-16', '14:43:20'),
(555, 1, ' Updated to position Grade 7 Representative', '2021-04-16', '14:43:38'),
(556, 1, 'Added position:asd', '2021-04-16', '14:43:55'),
(557, 1, ' Updated to position asd', '2021-04-16', '14:44:06'),
(558, 1, ' Updated to position asd', '2021-04-16', '14:44:16'),
(559, 1, 'Deleted position:', '2021-04-16', '14:44:21'),
(560, 1, 'Added position:asd', '2021-04-16', '14:47:53'),
(561, 1, ' Updated to position asdasdas', '2021-04-16', '15:14:22'),
(562, 1, ' Updated to position asdasdassfa', '2021-04-16', '15:19:48'),
(563, 1, 'Deleted position:', '2021-04-16', '15:19:56'),
(564, 1, 'Added position:asd', '2021-04-16', '15:20:03'),
(565, 1, ' Updated to position jdggf', '2021-04-16', '15:20:18'),
(566, 1, 'Deleted position:', '2021-04-16', '15:20:21'),
(567, 1, 'Logout', '2021-04-16', '17:42:52'),
(568, 1, 'Login', '2021-04-17', '23:52:08'),
(569, 1, ' Updated to position President', '2021-04-17', '23:52:31'),
(570, 1, ' Updated to position President', '2021-04-18', '00:13:10'),
(571, 1, ' Updated to position President!', '2021-04-18', '00:21:17'),
(572, 1, ' Updated to position President', '2021-04-18', '00:23:48'),
(573, 1, 'Login', '2021-04-18', '00:41:28'),
(574, 1, 'Login', '2021-04-18', '23:33:10'),
(575, 1, 'Login', '2021-04-19', '01:22:59');

-- --------------------------------------------------------

--
-- Table structure for table `archive`
--

CREATE TABLE `archive` (
  `archive_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `winners_name` varchar(30) NOT NULL,
  `school_year` datetime NOT NULL,
  `platform_info` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `candidate`
--

CREATE TABLE `candidate` (
  `candidate_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `total_votes` int(11) NOT NULL,
  `party_name` varchar(30) NOT NULL,
  `platform_info` varchar(100) NOT NULL,
  `credentials` varchar(500) NOT NULL,
  `photo` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `candidate`
--

INSERT INTO `candidate` (`candidate_id`, `student_id`, `position_id`, `total_votes`, `party_name`, `platform_info`, `credentials`, `photo`) VALUES
(61, 6, 112, 0, 'asd', 'asd', 'asd', '../img/dp/607d301975d689.80636782.jpg'),
(62, 3, 112, 1, 'dsa', 'dsa', 'dsa', '../img/dp/607d3020a97507.70292004.jpg'),
(63, 8, 2, 0, 'asd', 'asd', 'asd', '../img/dp/607d306c710313.34917803.jpg'),
(64, 17, 2, 1, 'dsa', 'dsa', 'dsa', '../img/dp/607d3077d62c90.55827874.jpg'),
(65, 28, 3, 0, 'asd', 'asd', 'asd', '../img/dp/607d3081c93860.64637599.jpg'),
(66, 21, 3, 1, 'dsa', 'dsa', 'dsa', '../img/dp/607d316f875310.56652280.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `candidate_position`
--

CREATE TABLE `candidate_position` (
  `position_id` int(11) NOT NULL,
  `heirarchy_id` int(30) NOT NULL,
  `position_name` varchar(30) NOT NULL,
  `position_description` varchar(100) NOT NULL,
  `vote_allow` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `candidate_position`
--

INSERT INTO `candidate_position` (`position_id`, `heirarchy_id`, `position_name`, `position_description`, `vote_allow`) VALUES
(2, 2, 'Vice President', 'Supports the President and will assume the presidency if the President resigns.', 1),
(3, 3, 'Secretary', 'In charge of organization correspondence and document keeping.', 1),
(4, 4, 'Treasurer', 'Financial officer in charge of book keeping organization expenses, income and savings.', 1),
(5, 5, 'Auditor', 'Audits the financial records of the treasurer.', 1),
(7, 7, 'Grade 8 Representative', 'Represents the voice of the Grade 8 students.', 0),
(8, 8, 'Grade 9 Representative', 'Represents the voice of the Grade 9 students.', 0),
(9, 9, 'Grade 10 Representative', 'Represents the voice of the Grade 10 students.', 0),
(11, 11, 'Grade 12 Representative', 'Represents the voice of the Grade 12 students.', 0),
(112, 1, 'President', 'Head of Supreme Student Government', 1),
(142, 10, 'Grade 11 Representative', 'Represents the voice of Grade 11 students.', 0),
(143, 6, 'Grade 7 Representative', 'Represents the voice of the Grade 7 students.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` int(11) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `Mname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `bumail` varchar(100) NOT NULL,
  `grade_level` int(11) NOT NULL,
  `otp` varchar(6) NOT NULL,
  `voting_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `fname`, `Mname`, `lname`, `gender`, `bumail`, `grade_level`, `otp`, `voting_status`) VALUES
(1, 'Maria', 'Madrona', 'Hanway', 'female', 'dhanjaphetverastigue.ador@bicol-u.edu.ph', 7, '835325', 1),
(2, 'Ariel', 'Bilal', 'Ongpauco', 'male', 'jessicaarimado.ajero@bicol-u.edu.ph', 10, '766692', 1),
(3, 'Isaak', 'Pildilapil', 'Alba', 'male', 'gaybaraquiel.alarcon@bicol-u.edu.ph', 11, '863179', 1),
(4, 'Braedon', 'Lozo', 'Sibug', 'male', 'johnpaulrenevo.asis@bicol-u.edu.ph', 9, '323786', 1),
(5, 'Julien', 'Cader', 'Puno', 'female', 'johnpauljaynario.azore@bicol-u.edu.ph', 9, '927726', 0),
(6, 'John Wesley', '', 'Atega', 'male', 'kayceelanuza.ballesteros@bicol-u.edu.ph', 7, '282916', 1),
(7, 'Jerrald', 'Dura', 'Macatangay', 'male', 'benazirgratela.barrameda@bicol-u.edu.ph', 8, '129861', 1),
(8, 'Adrian', 'Gallora', 'Balangao', 'male', 'stevenandreibansagale.barrios@bicol-u.edu.ph', 11, '132679', 0),
(9, 'Ken', 'Sison', 'Padilla', 'male', 'kerbymaravilla.bartolay@bicol-u.edu.ph', 11, '837187', 0),
(10, 'Horencia', 'Lopa', 'Santiago', 'female', 'christopherbariso.belen@bicol-u.edu.ph', 12, '775325', 1),
(11, 'Mason', 'Felix', 'Montejo', 'male', 'maedeljoicebercasio.castro@bicol-u.edu.ph', 8, '714979', 0),
(12, 'Anna', 'Lacsamana', 'Gevarra', 'female', 'joshuaisaiahmendez.codorniz@bicol-u.edu.ph', 9, '595447', 0),
(13, 'Trevon', 'Daquan', 'Magnaye', 'male', 'janharoldlandicho.delacruz@bicol-u.edu.ph', 7, '112911', 0),
(14, 'Abigail', 'Subrabas', 'Mipa', 'female', 'josedavidmapusao.delossantos@bicol-u.edu.ph', 10, '913368', 0),
(15, 'Sasha', 'Macalipay', 'Buenaventura', 'female', 'carlosgabrielendaya.delrosario@bicol-u.edu.ph', 8, '952991', 0),
(16, 'Noah', 'Moxcir', 'Solas', 'male', 'christianangelodimaano.diesta@bicol-u.edu.ph', 7, '235295', 0),
(17, 'Alliah', 'Lanta', 'Bataller', 'female', 'maveronicasequitin.gallos@bicol-u.edu.ph', 7, '531141', 0),
(18, 'Martin', 'Estevan', 'Pamintuan', 'male', 'mikaellalubiano.jarapa@bicol-u.edu.ph', 7, '344683', 0),
(19, 'Josefa', 'Talon', 'Vicente', 'female', 'iveelozano.jintalan@bicol-u.edu.ph', 8, '653984', 0),
(20, 'Danilo', '', 'Medina', 'male', 'joshuaalexinsuya.llander@bicol-u.edu.ph', 8, '696644', 0),
(21, 'Maurice', 'Clark', 'Madrid', 'female', 'jonjayvegonzales.llaneta@bicol-u.edu.ph', 8, '567171', 0),
(22, 'Sebastiano', 'Gubat', 'Etrone', 'male', 'jaydechosa.majadas@bicol-u.edu.ph', 9, '918922', 0),
(23, 'Marvin', 'Cayco', 'GalÃ­ndez', 'male', 'allianahgaile.malate@bicol-u.edu.ph', 9, '768556', 0),
(24, 'Christy Mae', 'Lotivio', 'Sy', 'female', 'mendrixclarianes.manlangit@bicol-u.edu.ph', 11, '482955', 0),
(25, 'Neo', 'Tuico', 'Hermano', 'female', 'johnkennethestipona.maronilla@bicol-u.edu.ph', 11, '158638', 0),
(26, 'Jazmine', '', 'Lim', 'female', 'darlene.rogero@bicol-u.edu.ph', 12, '185585', 0),
(27, 'Gabriella', 'Regidor', 'Briones', 'female', 'krishalouisesanjose.munoz@bicol-u.edu.ph', 12, '565297', 0),
(28, 'Renz', 'Borras', 'Duclayan', 'male', 'alyssamaecezar.olano@bicol-u.edu.ph', 11, '666237', 0),
(29, 'Nicole', '', 'Tiansay', 'female', 'keenbarrameda.padilla@bicol-u.edu.ph', 9, '943133', 0),
(30, 'Kai', 'Batumbakal', 'Guiriba', 'male', 'lizellearcos.penarubia@bicol-u.edu.ph', 8, '177392', 0),
(31, 'Lila', 'Rodriguez', 'Litana', 'female', 'karlorhommelchua.staana@bicol-u.edu.ph', 10, '747466', 0),
(32, 'Rodrigo', 'Bongo', 'Roque', 'male', 'kathrindenisemontallana.taclas@bicol-u.edu.ph', 12, '157546', 0),
(33, 'Lil', '', 'Eminem', 'female', 'ricamae.vega@bicol-u.edu.ph', 11, '142767', 0),
(34, 'student', 'student', 'student', 'female', 'student', 12, '123456', 1);

-- --------------------------------------------------------

--
-- Table structure for table `student_access_log`
--

CREATE TABLE `student_access_log` (
  `access_log_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `activity_description` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `student_access_log`
--

INSERT INTO `student_access_log` (`access_log_id`, `student_id`, `activity_description`, `date`, `time`) VALUES
(51, 34, 'Login', '2021-04-19', '15:22:35'),
(52, 34, 'Login', '2021-04-19', '15:30:48');

-- --------------------------------------------------------

--
-- Table structure for table `vote`
--

CREATE TABLE `vote` (
  `vote_log_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `candidate_id` int(11) NOT NULL,
  `status` varchar(30) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vote`
--

INSERT INTO `vote` (`vote_log_id`, `student_id`, `candidate_id`, `status`, `time_stamp`) VALUES
(12, 34, 62, 'Voted', '2021-04-19 07:36:35'),
(13, 34, 61, 'Abstain', '2021-04-19 07:36:35'),
(14, 34, 64, 'Voted', '2021-04-19 07:36:35'),
(15, 34, 63, 'Abstain', '2021-04-19 07:36:35'),
(16, 34, 65, 'Abstain', '2021-04-19 07:36:35'),
(17, 34, 66, 'Voted', '2021-04-19 07:36:36');

-- --------------------------------------------------------

--
-- Table structure for table `vote_event`
--

CREATE TABLE `vote_event` (
  `vote_event_id` int(11) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `vote_duration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `vote_event`
--

INSERT INTO `vote_event` (`vote_event_id`, `start_date`, `end_date`, `vote_duration`) VALUES
(1, '2021-04-16 19:47:00', '2021-04-16 19:49:00', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `admin_activity_log`
--
ALTER TABLE `admin_activity_log`
  ADD PRIMARY KEY (`activity_log_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `archive`
--
ALTER TABLE `archive`
  ADD PRIMARY KEY (`archive_id`),
  ADD KEY `position_id` (`position_id`);

--
-- Indexes for table `candidate`
--
ALTER TABLE `candidate`
  ADD PRIMARY KEY (`candidate_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `position_id` (`position_id`);

--
-- Indexes for table `candidate_position`
--
ALTER TABLE `candidate_position`
  ADD PRIMARY KEY (`position_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `student_access_log`
--
ALTER TABLE `student_access_log`
  ADD PRIMARY KEY (`access_log_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`vote_log_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `candidate_id` (`candidate_id`);

--
-- Indexes for table `vote_event`
--
ALTER TABLE `vote_event`
  ADD PRIMARY KEY (`vote_event_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `admin_activity_log`
--
ALTER TABLE `admin_activity_log`
  MODIFY `activity_log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=576;

--
-- AUTO_INCREMENT for table `archive`
--
ALTER TABLE `archive`
  MODIFY `archive_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `candidate`
--
ALTER TABLE `candidate`
  MODIFY `candidate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `candidate_position`
--
ALTER TABLE `candidate_position`
  MODIFY `position_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123456132;

--
-- AUTO_INCREMENT for table `student_access_log`
--
ALTER TABLE `student_access_log`
  MODIFY `access_log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `vote`
--
ALTER TABLE `vote`
  MODIFY `vote_log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `vote_event`
--
ALTER TABLE `vote_event`
  MODIFY `vote_event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_activity_log`
--
ALTER TABLE `admin_activity_log`
  ADD CONSTRAINT `admin_activity_log_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`);

--
-- Constraints for table `archive`
--
ALTER TABLE `archive`
  ADD CONSTRAINT `archive_ibfk_1` FOREIGN KEY (`position_id`) REFERENCES `candidate_position` (`position_id`);

--
-- Constraints for table `candidate`
--
ALTER TABLE `candidate`
  ADD CONSTRAINT `candidate_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`),
  ADD CONSTRAINT `candidate_ibfk_2` FOREIGN KEY (`position_id`) REFERENCES `candidate_position` (`position_id`);

--
-- Constraints for table `student_access_log`
--
ALTER TABLE `student_access_log`
  ADD CONSTRAINT `student_access_log_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`);

--
-- Constraints for table `vote`
--
ALTER TABLE `vote`
  ADD CONSTRAINT `vote_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`),
  ADD CONSTRAINT `vote_ibfk_2` FOREIGN KEY (`candidate_id`) REFERENCES `candidate` (`candidate_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

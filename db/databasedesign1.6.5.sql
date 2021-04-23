-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 23, 2021 at 03:54 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id16218880_buceils`
--
CREATE DATABASE IF NOT EXISTS `id16218880_buceils` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `id16218880_buceils`;

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
(2, 'Tomas', 'Mutya', 'Sace', 'Adviser', 'adviser', 'taclaskathrindenise@gmail.com', '6QLfkFgK', '', '2021-04-08 16:22:57'),
(3, 'Ariel', 'Bilal', 'Ongpauco', 'Adviser', 'chairperson', 'stebo1034@gmail.com', 'CHN8jQWs', '', '2021-04-22 12:24:49'),
(4, 'Isaak', 'Pildilapil', 'Alba', 'Admin', 'secretary', 'makenilla28@gmail.com', 'CX8sCKtx', '', '2021-03-31 16:32:02'),
(5, 'Braedon', 'Lozo', 'Sibug', 'Admin', 'admin', 'eef4de@gmail.com', '8hcTDAjU', '', '2021-03-31 16:32:49'),
(6, 'Julien', 'Cader', 'Puno', 'Admin', 'admin', 'kerbymbart@gmail.com', 'AcsV7how', '', '2021-03-31 16:32:43'),
(7, 'John Wesley', 'sdzfg', 'Atega', 'Student Admin', 'admin', 'weakerz8@gmail.com', '3LqsTq4Q', '', '2021-04-09 14:22:26');

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
(495, 1, 'Login', '2021-04-08', '12:40:30'),
(496, 1, 'Login', '2021-04-08', '23:27:25'),
(497, 1, 'Logout', '2021-04-08', '23:27:32'),
(498, 1, 'Login', '2021-04-09', '00:21:24'),
(499, 1, 'Login', '2021-04-09', '21:56:32'),
(500, 1, 'Login', '2021-04-09', '22:16:54'),
(501, 1, 'Login', '2021-04-09', '22:19:28'),
(502, 1, 'Login', '2021-04-09', '22:21:40'),
(503, 1, 'Login', '2021-04-10', '10:46:11'),
(504, 1, 'Login', '2021-04-10', '17:17:10'),
(505, 1, 'Login', '2021-04-13', '13:00:27'),
(506, 1, 'Login', '2021-04-13', '13:27:13'),
(507, 1, 'Logout', '2021-04-13', '13:27:48'),
(508, 1, 'Logout', '2021-04-13', '13:31:36'),
(509, 1, 'Login', '2021-04-13', '14:23:01'),
(510, 1, 'Logout', '2021-04-13', '14:23:20'),
(511, 1, 'Login', '2021-04-13', '14:25:44'),
(512, 1, 'Logout', '2021-04-13', '14:26:02'),
(513, 1, 'Login', '2021-04-13', '14:42:17'),
(514, 1, 'Logout', '2021-04-13', '14:53:08'),
(515, 1, 'Login', '2021-04-13', '14:53:27'),
(516, 1, 'Logout', '2021-04-13', '15:16:03'),
(517, 1, 'Login', '2021-04-13', '15:55:10'),
(518, 1, 'Logout', '2021-04-13', '15:55:13'),
(519, 1, 'Login', '2021-04-13', '16:30:23'),
(520, 1, 'Login', '2021-04-13', '18:58:46'),
(521, 1, 'Login', '2021-04-13', '20:54:51'),
(522, 1, 'Logout', '2021-04-13', '21:21:24'),
(523, 1, 'Login', '2021-04-14', '11:00:55'),
(524, 1, 'Login', '2021-04-14', '11:05:24'),
(525, 1, 'Logout', '2021-04-14', '11:05:32'),
(526, 1, 'Login', '2021-04-14', '13:55:15'),
(527, 1, 'Login', '2021-04-14', '15:09:36'),
(528, 1, 'Login', '2021-04-14', '21:18:49'),
(529, 1, 'Login', '2021-04-14', '21:24:05'),
(530, 1, 'Login', '2021-04-14', '21:24:06'),
(531, 1, 'Login', '2021-04-14', '23:14:13'),
(532, 1, 'Logout', '2021-04-14', '23:35:21'),
(533, 1, 'Login', '2021-04-14', '23:52:35'),
(534, 1, 'Login', '2021-04-14', '23:55:02'),
(535, 1, 'Logout', '2021-04-15', '00:07:53'),
(536, 1, 'Logout', '2021-04-15', '10:56:07'),
(537, 1, 'Login', '2021-04-15', '10:56:16'),
(538, 1, 'Login', '2021-04-15', '18:04:26'),
(539, 1, 'Login', '2021-04-15', '23:09:21'),
(540, 1, 'Login', '2021-04-16', '03:44:03'),
(541, 1, 'Added position:test', '2021-04-16', '09:14:54'),
(542, 1, 'Deleted position:', '2021-04-16', '09:15:03'),
(543, 1, 'Deleted position:', '2021-04-16', '09:31:06'),
(544, 1, 'Deleted position:', '2021-04-16', '09:32:58'),
(545, 1, 'Deleted position:', '2021-04-16', '09:37:25'),
(546, 1, 'Deleted position:', '2021-04-16', '09:39:55'),
(547, 1, 'Deleted position:', '2021-04-16', '09:42:54'),
(548, 1, 'Deleted position:', '2021-04-16', '09:43:25'),
(549, 1, 'Deleted position:', '2021-04-16', '09:45:04'),
(550, 1, 'Deleted position:', '2021-04-16', '09:46:59'),
(551, 1, 'Deleted position:', '2021-04-16', '09:48:04'),
(552, 1, 'Deleted position:', '2021-04-16', '09:57:06'),
(553, 1, 'Deleted position:', '2021-04-16', '10:08:31'),
(554, 1, 'Deleted position:', '2021-04-16', '10:14:30'),
(555, 1, 'Deleted position:', '2021-04-16', '10:16:48'),
(556, 1, ' Updated to position Grade 9 Representative', '2021-04-16', '10:20:08'),
(557, 1, ' Updated to position Grade 9 Representative', '2021-04-16', '10:22:24'),
(558, 1, ' Updated to position Grade 9 Representative', '2021-04-16', '10:25:37'),
(559, 1, ' Updated to position Grade 10 Representative', '2021-04-16', '10:26:00'),
(560, 1, ' Updated to position Grade 11 Representative', '2021-04-16', '10:26:15'),
(561, 1, ' Updated to position Grade 12 Representative', '2021-04-16', '10:26:22'),
(562, 1, 'Deleted position:', '2021-04-16', '11:41:51'),
(563, 1, ' Updated to position Grade 10 Representative', '2021-04-16', '11:42:07'),
(564, 1, ' Updated to position Grade 11 Representative', '2021-04-16', '11:42:22'),
(565, 1, ' Updated to position Grade 12 Representative', '2021-04-16', '11:42:31'),
(566, 1, 'Deleted position:', '2021-04-16', '11:44:06'),
(567, 1, 'Deleted position:', '2021-04-16', '11:57:47'),
(568, 1, 'Deleted position:', '2021-04-16', '11:58:55'),
(569, 1, 'Deleted position:', '2021-04-16', '12:01:53'),
(570, 1, ' Updated to position Grade 9 Representative', '2021-04-16', '12:02:26'),
(571, 1, ' Updated to position Grade 10 Representative', '2021-04-16', '12:02:36'),
(572, 1, ' Updated to position Grade 10 Representative', '2021-04-16', '12:02:48'),
(573, 1, ' Updated to position Grade 11 Representative', '2021-04-16', '12:02:57'),
(574, 1, ' Updated to position Grade 12 Representative', '2021-04-16', '12:03:05'),
(575, 1, 'Added position:test', '2021-04-16', '13:30:25'),
(576, 1, 'Deleted position:', '2021-04-16', '13:30:31'),
(577, 1, ' Updated to position Grade 9 Representative', '2021-04-16', '13:31:16'),
(578, 1, ' Updated to position Grade 10 Representative', '2021-04-16', '13:31:27'),
(579, 1, ' Updated to position Grade 11 Representative', '2021-04-16', '13:31:34'),
(580, 1, ' Updated to position Grade 12 Representative', '2021-04-16', '13:31:41'),
(581, 1, 'Added position:test', '2021-04-16', '13:42:29'),
(582, 1, ' Updated to position President', '2021-04-16', '13:43:30'),
(583, 1, ' Updated to position Vice President', '2021-04-16', '13:43:38'),
(584, 1, ' Updated to position Secretary', '2021-04-16', '13:43:50'),
(585, 1, ' Updated to position Treasurer', '2021-04-16', '13:43:56'),
(586, 1, ' Updated to position Auditor', '2021-04-16', '13:44:02'),
(587, 1, ' Updated to position Grade 7 Representative', '2021-04-16', '13:44:10'),
(588, 1, ' Updated to position Grade 8 Representative', '2021-04-16', '13:44:17'),
(589, 1, ' Updated to position Grade 9 Representative', '2021-04-16', '13:44:24'),
(590, 1, ' Updated to position Grade 10 Representative', '2021-04-16', '13:44:32'),
(591, 1, ' Updated to position Grade 11 Representative', '2021-04-16', '13:44:40'),
(592, 1, ' Updated to position Grade 12 Representative', '2021-04-16', '13:44:47'),
(593, 1, 'Added position:test', '2021-04-16', '13:45:14'),
(594, 1, 'Deleted position:', '2021-04-16', '13:45:21'),
(595, 1, 'Added position:tetst=', '2021-04-16', '13:46:29'),
(596, 1, 'Deleted position:', '2021-04-16', '13:46:34'),
(597, 1, 'Added position:test', '2021-04-16', '13:46:50'),
(598, 1, 'Deleted position:', '2021-04-16', '13:47:18'),
(599, 1, 'Added position:test', '2021-04-16', '13:47:41'),
(600, 1, 'Deleted position:', '2021-04-16', '13:47:56'),
(601, 1, 'Login', '2021-04-17', '13:20:25'),
(602, 1, 'Login', '2021-04-17', '13:42:24'),
(603, 1, 'Login', '2021-04-17', '13:42:24'),
(604, 1, 'Login', '2021-04-17', '23:55:31'),
(605, 1, 'Login', '2021-04-18', '17:26:44'),
(606, 1, 'Logout', '2021-04-18', '19:11:10'),
(607, 1, 'Login', '2021-04-18', '19:24:37'),
(608, 1, 'Logout', '2021-04-18', '19:26:43'),
(609, 1, 'Login', '2021-04-19', '01:33:01'),
(610, 1, 'Login', '2021-04-19', '14:35:34'),
(611, 1, 'Login', '2021-04-20', '17:38:52'),
(612, 1, 'Login', '2021-04-21', '21:03:17'),
(613, 1, 'Login', '2021-04-21', '22:04:44'),
(614, 1, 'Logout', '2021-04-21', '23:17:13'),
(615, 1, 'Login', '2021-04-21', '23:17:45'),
(616, 1, 'Login', '2021-04-21', '23:20:59'),
(617, 1, 'Login', '2021-04-21', '23:26:14'),
(618, 1, 'Login', '2021-04-21', '23:26:54'),
(619, 1, 'Login', '2021-04-21', '23:36:28'),
(620, 1, 'Login', '2021-04-22', '18:38:55'),
(621, 1, 'Added position:test', '2021-04-22', '19:20:14'),
(622, 1, 'Deleted position:', '2021-04-22', '19:20:34'),
(623, 1, 'Added position:test', '2021-04-22', '19:27:57'),
(624, 1, 'Deleted position:', '2021-04-22', '19:28:24'),
(625, 1, 'Added position:test', '2021-04-22', '19:31:08'),
(626, 1, 'Deleted position:', '2021-04-22', '19:31:15'),
(627, 1, 'Logout', '2021-04-22', '20:11:23'),
(628, 1, 'Login', '2021-04-22', '20:14:19'),
(629, 1, 'Login', '2021-04-22', '20:17:38'),
(630, 1, 'Login', '2021-04-22', '20:21:31'),
(631, 1, 'Added position:test', '2021-04-22', '20:50:38'),
(632, 1, 'Added position:test', '2021-04-22', '20:51:53'),
(633, 1, 'Added position:test', '2021-04-22', '20:54:19'),
(634, 1, 'Added position:test', '2021-04-22', '20:55:01'),
(635, 1, 'Added position:test', '2021-04-22', '20:58:41'),
(636, 1, 'Added position:test', '2021-04-22', '20:59:27'),
(637, 1, 'Added position:test', '2021-04-22', '21:01:08'),
(638, 1, 'Login', '2021-04-23', '08:37:55'),
(639, 1, 'Login', '2021-04-23', '08:49:48'),
(640, 1, 'Login', '2021-04-23', '09:00:54'),
(641, 1, 'Login', '2021-04-23', '09:03:25');

-- --------------------------------------------------------

--
-- Table structure for table `archive`
--

CREATE TABLE `archive` (
  `archive_id` int(11) NOT NULL,
  `position_name` varchar(50) NOT NULL,
  `winner_fname` varchar(30) NOT NULL,
  `winner_mname` varchar(30) NOT NULL,
  `winner_lname` varchar(30) NOT NULL,
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
  `platform_info` varchar(500) NOT NULL,
  `credentials` varchar(500) NOT NULL,
  `photo` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `candidate`
--

INSERT INTO `candidate` (`candidate_id`, `student_id`, `position_id`, `total_votes`, `party_name`, `platform_info`, `credentials`, `photo`) VALUES
(1, 8, 1, 2, 'Run Adrian, Run Partylist', 'I wanna be a billionaire, so freaking bad.\r\nwoah woah', 'Class President for 20 years.', '../IMG/candidateimg/606c1906beede8.42050912.jpg'),
(2, 9, 1, 4, 'Dingdong Dantes Supporters', 'Para kay Tatay Digs, I dig.', 'DU30natics since 1999', '../img/dp/6076ed22adcac1.12411484.jpg'),
(3, 10, 2, 4, 'Run Adrian, Run Partylist', 'I wanna be a billionaire (2)', 'Tiktoker for 2 years.', ''),
(6, 13, 3, 1, 'Dingdong Dantes Supporters', 'I believe in the saying na naniniwala ako sa kasabihan.', 'Sana all may credentials.', ''),
(7, 14, 3, 0, 'Independent', 'Strong independent woman, kaya ko mag-secretary.', 'Independent for 10 years.', ''),
(8, 15, 4, 6, 'Dingdong Dantes Supporters', 'Payaman lang ako dito.', 'Kurakot pero cute.', ''),
(9, 16, 5, 0, 'Independent', 'Isasama kita sa barko ko.', 'I have Noah\'s Arc.\r\nSaving animals for 5 years.', ''),
(10, 17, 6, 1, 'Dingdong Dantes Supporters', 'Boses ng grade 7, malakas.', 'Pabibo yesterday, oday and tomorrow.', ''),
(11, 18, 6, 0, 'Run Adrian, Run Partylist', 'Meron akong Martin\'s crackers.', 'Owner of Martin\'s crackers.', ''),
(12, 19, 7, 1, 'Dingdong Dantes Supporters', 'Kung kailangan mo ng tulang, sabihin mo lang, \"JOSEFA-tulong.\"', 'In the service of grade 8 people...', ''),
(13, 20, 7, 1, 'Run Adrian, Run Partylist', 'Danilook, may nangangailangan ng tulong.', 'Nakikita niya lahat ng nangangailangan ng tulong.', ''),
(14, 21, 7, 0, 'Independent', 'I will take you to Madagascar.', 'King Julien\'s adviser.', ''),
(15, 22, 8, 0, 'Run Adrian, Run Partylist', 'Hello World', 'Bot 77', ''),
(16, 23, 8, 0, 'Dingdong Dantes Supporters', 'Itataas ko bandera ng grade 9.', 'Flag-bearer.\r\nBoyscout for 10 years.', ''),
(17, 24, 10, 1, 'Independent', 'I set fire to the rain...', 'Kaya ko mag-split.', ''),
(18, 25, 10, 0, 'Run Adrian, Run Partylist', 'Kaya NEO ba ang kaya ko?', 'May-kaya sa buhay.', ''),
(19, 26, 11, 0, 'Dingdong Dantes Supporters', 'JAZ call my name, and I\'ll be there.', 'Dancer sa munisipyo.', ''),
(20, 27, 11, 1, 'Run Adrian, Run Partylist', 'Si Gabriella, isinilang...', 'Woman\'s rights ambassador', '');

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
(1, 1, 'President', 'The head of the Supreme Student Government.', 1),
(2, 2, 'Vice President', 'Supports the President and will assume the presidency if the President resigns.', 1),
(3, 3, 'Secretary', 'In charge of organization correspondence and document keeping.', 1),
(4, 4, 'Treasurer', 'Financial officer in charge of book keeping organization expenses, income and savings.', 1),
(5, 5, 'Auditor', 'Audits the financial records of the treasurer.', 1),
(6, 6, 'Grade 7 Representative', 'Represents the voice of the Grade 7 students.', 0),
(7, 7, 'Grade 8 Representative', 'Represents the voice of the Grade 8 students.', 0),
(8, 8, 'Grade 9 Representative', 'Represents the voice of Grade 9 students.', 0),
(9, 9, 'Grade 10 Representative', 'Represents the voice of the Grade 10 students.', 0),
(10, 10, 'Grade 11 Representative', 'Represents the voice of the Grade 11 students.', 0),
(11, 11, 'Grade 12 Representative', 'Represents the voice of the Grade 12 students.', 0);

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
(1, 'Maria', 'Madrona', 'Hanway', 'female', 'dhanjaphetverastigue.ador@bicol-u.edu.ph', 7, '125915', 1),
(2, 'Ariel', 'Bilal', 'Ongpauco', 'male', 'jessicaarimado.ajero@bicol-u.edu.ph', 10, '124622', 1),
(3, 'Isaak', 'Pildilapil', 'Alba', 'male', 'gaybaraquiel.alarcon@bicol-u.edu.ph', 11, '235343', 1),
(4, 'Braedon', 'Lozo', 'Sibug', 'male', 'johnpaulrenevo.asis@bicol-u.edu.ph', 9, '276291', 1),
(5, 'Julien', 'Cader', 'Puno', 'female', 'johnpauljaynario.azore@bicol-u.edu.ph', 9, '217493', 0),
(6, 'John Wesley', '', 'Atega', 'male', 'kayceelanuza.ballesteros@bicol-u.edu.ph', 7, '130104', 1),
(7, 'Jerrald', 'Dura', 'Macatangay', 'male', 'benazirgratela.barrameda@bicol-u.edu.ph', 8, '266719', 1),
(8, 'Adrian', 'Gallora', 'Balangao', 'male', 'stevenandreibansagale.barrios@bicol-u.edu.ph', 11, '869571', 0),
(9, 'Ken', 'Sison', 'Padilla', 'male', 'kerbymaravilla.bartolay@bicol-u.edu.ph', 11, '403364', 0),
(10, 'Horencia', 'Lopa', 'Santiago', 'female', 'christopherbariso.belen@bicol-u.edu.ph', 12, '864223', 1),
(11, 'Mason', 'Felix', 'Montejo', 'male', 'maedeljoicebercasio.castro@bicol-u.edu.ph', 8, '090126', 0),
(12, 'Anna', 'Lacsamana', 'Gevarra', 'female', 'joshuaisaiahmendez.codorniz@bicol-u.edu.ph', 9, '825517', 0),
(13, 'Trevon', 'Daquan', 'Magnaye', 'male', 'janharoldlandicho.delacruz@bicol-u.edu.ph', 7, '927785', 0),
(14, 'Abigail', 'Subrabas', 'Mipa', 'female', 'josedavidmapusao.delossantos@bicol-u.edu.ph', 10, '267220', 0),
(15, 'Sasha', 'Macalipay', 'Buenaventura', 'female', 'carlosgabrielendaya.delrosario@bicol-u.edu.ph', 8, '393606', 0),
(16, 'Noah', 'Moxcir', 'Solas', 'male', 'christianangelodimaano.diesta@bicol-u.edu.ph', 7, '526160', 0),
(17, 'Alliah', 'Lanta', 'Bataller', 'female', 'maveronicasequitin.gallos@bicol-u.edu.ph', 7, '753110', 0),
(18, 'Martin', 'Estevan', 'Pamintuan', 'male', 'mikaellalubiano.jarapa@bicol-u.edu.ph', 7, '252909', 0),
(19, 'Josefa', 'Talon', 'Vicente', 'female', 'iveelozano.jintalan@bicol-u.edu.ph', 8, '072322', 0),
(20, 'Danilo', '', 'Medina', 'male', 'joshuaalexinsuya.llander@bicol-u.edu.ph', 8, '372533', 0),
(21, 'Maurice', 'Clark', 'Madrid', 'female', 'jonjayvegonzales.llaneta@bicol-u.edu.ph', 8, '690885', 0),
(22, 'Sebastiano', 'Gubat', 'Etrone', 'male', 'jaydechosa.majadas@bicol-u.edu.ph', 9, '514101', 0),
(23, 'Marvin', 'Cayco', 'Galíndez', 'male', 'allianahgaile.malate@bicol-u.edu.ph', 9, '159368', 0),
(24, 'Christy Mae', 'Lotivio', 'Sy', 'female', 'mendrixclarianes.manlangit@bicol-u.edu.ph', 11, '465982', 0),
(25, 'Neo', 'Tuico', 'Hermano', 'female', 'johnkennethestipona.maronilla@bicol-u.edu.ph', 11, '619275', 0),
(26, 'Jazmine', '', 'Lim', 'female', 'darlene.rogero@bicol-u.edu.ph', 12, '595719', 0),
(27, 'Gabriella', 'Regidor', 'Briones', 'female', 'krishalouisesanjose.munoz@bicol-u.edu.ph', 12, '000474', 0),
(28, 'Renz', 'Borras', 'Duclayan', 'male', 'alyssamaecezar.olano@bicol-u.edu.ph', 11, '142538', 0),
(29, 'Nicole', '', 'Tiansay', 'female', 'keenbarrameda.padilla@bicol-u.edu.ph', 9, '841182', 0),
(30, 'Kai', 'Batumbakal', 'Guiriba', 'male', 'lizellearcos.penarubia@bicol-u.edu.ph', 8, '921319', 0),
(31, 'Lila', 'Rodriguez', 'Litana', 'female', 'karlorhommelchua.staana@bicol-u.edu.ph', 10, '797244', 0),
(32, 'Rodrigo', 'Bongo', 'Roque', 'male', 'kathrindenisemontallana.taclas@bicol-u.edu.ph', 12, '503908', 0),
(33, 'Lil', '', 'Eminem', 'female', 'ricamae.vega@bicol-u.edu.ph', 11, '097588', 0),
(123456130, 'maria', 'g', 'osawa', '', '123456', 11, '123456', 0);

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
(69, 1, 'Login', '2021-04-08', '23:28:38'),
(70, 24, 'Login', '2021-04-09', '13:03:54'),
(71, 20, 'Login', '2021-04-09', '22:19:08'),
(72, 32, 'Login', '2021-04-09', '22:21:25'),
(73, 1, 'Login', '2021-04-10', '21:12:05'),
(74, 1, 'Logout', '2021-04-10', '21:50:46'),
(75, 1, 'Login', '2021-04-10', '21:51:00'),
(76, 24, 'Login', '2021-04-11', '08:56:19'),
(77, 24, 'Login', '2021-04-11', '09:08:38'),
(78, 24, 'Login', '2021-04-11', '09:10:29'),
(79, 24, 'Login', '2021-04-11', '09:31:53'),
(80, 1, 'Login', '2021-04-11', '09:35:53'),
(81, 24, 'Login', '2021-04-11', '18:50:47'),
(82, 24, 'Login', '2021-04-13', '12:45:32'),
(83, 1, 'Login', '2021-04-13', '12:56:28'),
(84, 24, 'Login', '2021-04-13', '12:57:10'),
(85, 32, 'Login', '2021-04-13', '13:27:58'),
(86, 24, 'Logout', '2021-04-13', '14:42:06'),
(87, 24, 'Login', '2021-04-13', '14:53:19'),
(88, 20, 'Login', '2021-04-13', '15:55:30'),
(89, 24, 'Logout', '2021-04-13', '16:30:00'),
(90, 20, 'Logout', '2021-04-13', '16:30:08'),
(91, 24, 'Login', '2021-04-13', '16:30:21'),
(92, 24, 'Logout', '2021-04-13', '16:49:55'),
(93, 24, 'Login', '2021-04-13', '18:22:55'),
(94, 24, 'Logout', '2021-04-13', '20:54:40'),
(95, 32, 'Login', '2021-04-13', '21:21:47'),
(96, 32, 'Login', '2021-04-14', '20:50:05'),
(97, 24, 'Login', '2021-04-14', '21:20:47'),
(98, 32, 'Login', '2021-04-14', '21:22:20'),
(99, 24, 'Logout', '2021-04-14', '23:14:00'),
(100, 24, 'Login', '2021-04-14', '23:35:35'),
(101, 24, 'Logout', '2021-04-14', '23:52:24'),
(102, 24, 'Login', '2021-04-18', '19:11:23'),
(103, 1, 'Login', '2021-04-18', '19:27:17'),
(104, 24, 'Login', '2021-04-19', '12:11:15'),
(105, 1, 'Login', '2021-04-19', '12:21:40'),
(106, 24, 'Login', '2021-04-19', '12:26:35'),
(107, 24, 'Login', '2021-04-21', '21:02:57'),
(108, 24, 'Logout', '2021-04-21', '21:03:08'),
(109, 24, 'Login', '2021-04-22', '20:11:40'),
(110, 32, 'Login', '2021-04-22', '20:13:22'),
(111, 24, 'Logout', '2021-04-22', '20:14:13'),
(112, 32, 'Login', '2021-04-22', '20:24:40'),
(113, 24, 'Login', '2021-04-22', '21:35:56'),
(114, 7, 'Login', '2021-04-23', '09:02:05');

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
  ADD PRIMARY KEY (`archive_id`);

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
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `admin_activity_log`
--
ALTER TABLE `admin_activity_log`
  MODIFY `activity_log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=642;

--
-- AUTO_INCREMENT for table `archive`
--
ALTER TABLE `archive`
  MODIFY `archive_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `candidate`
--
ALTER TABLE `candidate`
  MODIFY `candidate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `candidate_position`
--
ALTER TABLE `candidate_position`
  MODIFY `position_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123456131;

--
-- AUTO_INCREMENT for table `student_access_log`
--
ALTER TABLE `student_access_log`
  MODIFY `access_log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `vote`
--
ALTER TABLE `vote`
  MODIFY `vote_log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vote_event`
--
ALTER TABLE `vote_event`
  MODIFY `vote_event_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_activity_log`
--
ALTER TABLE `admin_activity_log`
  ADD CONSTRAINT `admin_activity_log_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`);

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

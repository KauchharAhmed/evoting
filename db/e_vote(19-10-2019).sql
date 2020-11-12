-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2019 at 03:32 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.0.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_vote`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `nid` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `father_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `type` tinyint(4) NOT NULL COMMENT '1 = admin',
  `password` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `old_loged_time` datetime NOT NULL,
  `new_loged_time` datetime NOT NULL,
  `recover_code` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '1=active 2=inactive',
  `image` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `added_id` int(10) UNSIGNED NOT NULL,
  `creatd_at` date NOT NULL,
  `modified_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `nid`, `father_name`, `email`, `mobile`, `type`, `password`, `old_loged_time`, `new_loged_time`, `recover_code`, `address`, `status`, `image`, `added_id`, `creatd_at`, `modified_at`) VALUES
(1, 'RAYHAN UDDIN', '', '', '', '01729661197', 1, '0e9f59539b4965997246de771a0d7d2438398307', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 1, '', 0, '2019-10-14', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_candidate`
--

CREATE TABLE `tbl_candidate` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `nid` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `father_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `mother_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `type` tinyint(4) NOT NULL,
  `password` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `recover_code` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0=active 1=in_active ',
  `image` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `added_id` int(10) UNSIGNED NOT NULL,
  `creatd_at` date NOT NULL,
  `modified_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_candidate`
--

INSERT INTO `tbl_candidate` (`id`, `name`, `nid`, `father_name`, `mother_name`, `email`, `mobile`, `type`, `password`, `recover_code`, `address`, `status`, `image`, `added_id`, `creatd_at`, `modified_at`) VALUES
(1, 'Candidate-1', '23423', '', '', 'phpavijit567@gmail.com', '01765568945', 0, 'dd81fef4ef478d22599689fe36a0eeb523f11682', '', 'sirajganj', 0, 'images/candidate-gQJ6BFZOLcJvX8FzwaXp.png', 1, '2019-10-15', '0000-00-00'),
(2, 'Candidate- 2', '45855', '', '', 'candidate-2@gmail.com', '01729555555', 0, 'bd36daff647f3dcaa1837a58b020ef3e31896aad', '', 'Dhaka', 0, '', 1, '2019-10-17', '0000-00-00'),
(3, 'Candidate- 3', '6585544', '', '', 'candidate-3@gmail.com', '01755666666', 0, 'b82f1b477042a0b89ef4d1f0a439b1695e97e5d8', '', 'Sirajganj', 0, '', 1, '2019-10-17', '0000-00-00'),
(4, 'Candidate - 4', '458988888', '', '', 'candidate-4@gmail.com', '01766777777', 0, '6e16126e4380861a760cc563d45a6cc340fe8b5f', '', 'Chattgram', 0, 'images/candidate-UcRWK2fEEZ7dHZbBqAPl.jpg', 1, '2019-10-17', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_election`
--

CREATE TABLE `tbl_election` (
  `id` int(10) UNSIGNED NOT NULL,
  `election_name` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0 = active 1 = inactive',
  `remarks` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` date NOT NULL,
  `modified_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_election`
--

INSERT INTO `tbl_election` (`id`, `election_name`, `status`, `remarks`, `created_at`, `modified_at`) VALUES
(1, '2008 Election', 0, '', '2019-10-15', '0000-00-00'),
(2, '2019 Election', 0, '', '2019-10-15', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_election_active_voter`
--

CREATE TABLE `tbl_election_active_voter` (
  `id` int(10) UNSIGNED NOT NULL,
  `election_id` int(10) UNSIGNED NOT NULL,
  `voter_id` int(10) UNSIGNED NOT NULL,
  `remarks` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` date NOT NULL,
  `modified_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_election_active_voter`
--

INSERT INTO `tbl_election_active_voter` (`id`, `election_id`, `voter_id`, `remarks`, `created_at`, `modified_at`) VALUES
(2, 2, 3, '', '2019-10-17', '0000-00-00'),
(3, 2, 4, '', '2019-10-17', '0000-00-00'),
(4, 2, 5, '', '2019-10-17', '0000-00-00'),
(5, 2, 6, '', '2019-10-17', '0000-00-00'),
(6, 2, 7, '', '2019-10-17', '0000-00-00'),
(7, 2, 8, '', '2019-10-17', '0000-00-00'),
(8, 2, 9, '', '2019-10-17', '0000-00-00'),
(9, 2, 10, '', '2019-10-17', '0000-00-00'),
(10, 2, 11, '', '2019-10-17', '0000-00-00'),
(11, 2, 12, '', '2019-10-17', '0000-00-00'),
(12, 2, 13, '', '2019-10-17', '0000-00-00'),
(13, 2, 14, '', '2019-10-17', '0000-00-00'),
(14, 2, 15, '', '2019-10-17', '0000-00-00'),
(15, 2, 16, '', '2019-10-17', '0000-00-00'),
(16, 2, 17, '', '2019-10-17', '0000-00-00'),
(17, 2, 18, '', '2019-10-17', '0000-00-00'),
(18, 2, 19, '', '2019-10-17', '0000-00-00'),
(19, 2, 20, '', '2019-10-17', '0000-00-00'),
(20, 2, 1, '', '2019-10-17', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_election_candidate_post`
--

CREATE TABLE `tbl_election_candidate_post` (
  `id` int(10) UNSIGNED NOT NULL,
  `election_id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `candidate_id` int(10) UNSIGNED NOT NULL,
  `symbol_id` int(10) UNSIGNED NOT NULL,
  `remarks` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` date NOT NULL,
  `modified_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_election_candidate_post`
--

INSERT INTO `tbl_election_candidate_post` (`id`, `election_id`, `post_id`, `candidate_id`, `symbol_id`, `remarks`, `created_at`, `modified_at`) VALUES
(1, 2, 1, 1, 2, '', '2019-10-17', '0000-00-00'),
(2, 2, 1, 2, 3, '', '2019-10-17', '0000-00-00'),
(3, 2, 2, 3, 4, '', '2019-10-17', '0000-00-00'),
(4, 2, 2, 4, 5, '', '2019-10-17', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_final_vote`
--

CREATE TABLE `tbl_final_vote` (
  `id` int(10) UNSIGNED NOT NULL,
  `election_id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `candidate_id` int(10) UNSIGNED NOT NULL,
  `voter_id` int(10) UNSIGNED NOT NULL,
  `pin_no` varchar(100) NOT NULL,
  `session_id` varchar(100) NOT NULL,
  `created_time` time NOT NULL,
  `created_at` date NOT NULL,
  `modified_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_final_vote`
--

INSERT INTO `tbl_final_vote` (`id`, `election_id`, `post_id`, `candidate_id`, `voter_id`, `pin_no`, `session_id`, `created_time`, `created_at`, `modified_at`) VALUES
(1, 2, 1, 1, 4, '09b4c5', '604e7613b1288107598d022b1414c1c8d2e53f8a', '18:58:39', '2019-10-19', '0000-00-00'),
(2, 2, 2, 4, 4, '7a5b8e', '604e7613b1288107598d022b1414c1c8d2e53f8a', '19:06:14', '2019-10-19', '0000-00-00'),
(3, 2, 1, 2, 8, '6665d9', '604e7613b1288107598d022b1414c1c8d2e53f8a', '19:08:19', '2019-10-19', '0000-00-00'),
(4, 2, 2, 4, 8, '6665d9', '604e7613b1288107598d022b1414c1c8d2e53f8a', '19:08:26', '2019-10-19', '0000-00-00'),
(5, 2, 1, 2, 9, 'a97fdc', '604e7613b1288107598d022b1414c1c8d2e53f8a', '19:09:08', '2019-10-19', '0000-00-00'),
(6, 2, 2, 3, 9, 'a97fdc', '604e7613b1288107598d022b1414c1c8d2e53f8a', '19:09:26', '2019-10-19', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_parcitipate_election`
--

CREATE TABLE `tbl_parcitipate_election` (
  `id` int(10) UNSIGNED NOT NULL,
  `election_id` int(10) UNSIGNED NOT NULL,
  `voter_id` int(10) UNSIGNED NOT NULL,
  `pin_no` varchar(100) NOT NULL,
  `creatd_time` time NOT NULL,
  `created_at` date NOT NULL,
  `modified_time` time NOT NULL,
  `modified_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_parcitipate_election`
--

INSERT INTO `tbl_parcitipate_election` (`id`, `election_id`, `voter_id`, `pin_no`, `creatd_time`, `created_at`, `modified_time`, `modified_at`) VALUES
(1, 2, 4, '7a5b8e', '16:16:44', '2019-10-19', '19:00:19', '2019-10-19'),
(2, 2, 8, '6665d9', '19:07:28', '2019-10-19', '00:00:00', '0000-00-00'),
(3, 2, 9, 'a97fdc', '19:08:44', '2019-10-19', '00:00:00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pin_history`
--

CREATE TABLE `tbl_pin_history` (
  `id` int(10) UNSIGNED NOT NULL,
  `election_id` int(10) UNSIGNED NOT NULL,
  `voter_id` int(10) UNSIGNED NOT NULL,
  `used_pin` varchar(100) NOT NULL,
  `creatd_time` time NOT NULL,
  `created_at` date NOT NULL,
  `modified_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pin_history`
--

INSERT INTO `tbl_pin_history` (`id`, `election_id`, `voter_id`, `used_pin`, `creatd_time`, `created_at`, `modified_at`) VALUES
(1, 2, 4, '01f0d4', '16:16:44', '2019-10-19', '0000-00-00'),
(2, 2, 4, '7795e5', '16:17:24', '2019-10-19', '0000-00-00'),
(3, 2, 4, '602d85', '16:19:00', '2019-10-19', '0000-00-00'),
(4, 2, 4, '2853ed', '16:21:00', '2019-10-19', '0000-00-00'),
(5, 2, 4, '11bd98', '16:22:22', '2019-10-19', '0000-00-00'),
(6, 2, 4, '703f59', '17:14:22', '2019-10-19', '0000-00-00'),
(7, 2, 4, '63125d', '17:50:39', '2019-10-19', '0000-00-00'),
(8, 2, 4, 'cd9c86', '18:18:49', '2019-10-19', '0000-00-00'),
(9, 2, 4, 'f1e4e7', '18:40:45', '2019-10-19', '0000-00-00'),
(10, 2, 4, '869b6a', '18:41:07', '2019-10-19', '0000-00-00'),
(11, 2, 4, '409eb2', '18:50:25', '2019-10-19', '0000-00-00'),
(12, 2, 4, '09b4c5', '18:58:08', '2019-10-19', '0000-00-00'),
(13, 2, 4, '7a5b8e', '19:00:19', '2019-10-19', '0000-00-00'),
(14, 2, 8, '6665d9', '19:07:28', '2019-10-19', '0000-00-00'),
(15, 2, 9, 'a97fdc', '19:08:44', '2019-10-19', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_post`
--

CREATE TABLE `tbl_post` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_name` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `post_rank` int(10) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0 = active 1 = inactive',
  `remarks` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` date NOT NULL,
  `modified_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_post`
--

INSERT INTO `tbl_post` (`id`, `post_name`, `post_rank`, `status`, `remarks`, `created_at`, `modified_at`) VALUES
(1, 'President', 1, 0, '', '2019-10-15', '0000-00-00'),
(2, 'General Secretary', 2, 0, '', '2019-10-15', '0000-00-00'),
(3, 'Sports Secretary', 3, 0, '', '2019-10-17', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_symbol`
--

CREATE TABLE `tbl_symbol` (
  `id` int(10) UNSIGNED NOT NULL,
  `symbol_name` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0 = active 1 = inactive',
  `remarks` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `added_id` int(10) UNSIGNED NOT NULL,
  `created_at` date NOT NULL,
  `modified_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_symbol`
--

INSERT INTO `tbl_symbol` (`id`, `symbol_name`, `image`, `status`, `remarks`, `added_id`, `created_at`, `modified_at`) VALUES
(2, 'Nowka', 'images/symbol-eKbRQPW6c0eaEClzHD90.jpg', 0, 'gg', 1, '2019-10-17', '0000-00-00'),
(3, 'মোমবাতি', 'images/symbol-pVbOd4YTwFIunk2B4q8l.png', 0, '', 1, '2019-10-17', '0000-00-00'),
(4, 'Nangol', 'images/symbol-DxUIjjFr8dLoouHq62mT.jpg', 0, '', 1, '2019-10-17', '0000-00-00'),
(5, 'Tala - Chabi', 'images/symbol-9IBaOItTKThL248uNxAc.png', 0, '', 1, '2019-10-17', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_voter`
--

CREATE TABLE `tbl_voter` (
  `id` int(10) UNSIGNED NOT NULL,
  `voter_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `nid` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `father_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `mother_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `type` tinyint(4) NOT NULL,
  `password` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `added_random_number` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `recover_code` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0=addedd 1=active 2=inactive',
  `image` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `added_id` int(10) UNSIGNED NOT NULL,
  `creatd_at` date NOT NULL,
  `verified_date` date NOT NULL,
  `modified_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_voter`
--

INSERT INTO `tbl_voter` (`id`, `voter_id`, `name`, `nid`, `father_name`, `mother_name`, `email`, `mobile`, `type`, `password`, `added_random_number`, `recover_code`, `address`, `status`, `image`, `added_id`, `creatd_at`, `verified_date`, `modified_at`) VALUES
(1, 1, 'President', 'hjjj', '', '', 'rayhanspi1@gmail.com', '01729661197', 0, 'c1ad62fb44a5920c515a9911a0b8bb8126849fc1', 'a5d6c0bf849ea358c979c3ce64a265', '', 'bggg', 1, '', 0, '2019-10-15', '2019-10-15', '0000-00-00'),
(2, 0, 'Avijit', 'vggg', '', '', 'phpavijit567@gmail.com', '01765568945', 0, '', '5168f9ad066395cb050a53652b4d09', '', 'ff', 0, 'images/download.png', 0, '2019-10-15', '0000-00-00', '0000-00-00'),
(3, 0, 'Voter 2', '655', '', '', 'voter2@gmail.com', '0752764601', 0, 'fea031496f55f7a05412c20124ef135655386f6f', '9e1360944d43fb084328e1acb4782a', '', 'ghgggg', 1, '', 0, '2019-10-17', '0000-00-00', '0000-00-00'),
(4, 0, 'sopon', '1111', 'jobbar', 'halima', 'rayhanspi@gmail.com', '01254789632', 0, '4ee3e7e7004a9d9d3d812066177436a2e0a5efce', '31dac40225b834b32ba2ea4abbbd6d', '', 'ullapara', 1, '', 0, '2019-10-17', '0000-00-00', '0000-00-00'),
(5, 0, 'korim', '855', 'robban', 'Rohima', 'we@hh.com', '458', 0, '6ed8c320e506b6b4d2624210571d51993a5ef526', '7e4c12b1204936019580770d923fd2', '', 'donot', 1, '', 0, '2019-10-17', '0000-00-00', '0000-00-00'),
(6, 0, 'khalek', '123654', 'malek', 'kulsun', 'hjj@jjj.com', '013569874215', 0, 'fde070a6750fddbfdd7f846a5c0f830e819ce254', 'fb4b34e8d0314a62508669054aed02', '', 'malsapara', 1, '', 0, '2019-10-17', '0000-00-00', '0000-00-00'),
(7, 0, 'bellal', '111111111', 'Limon', 'Laki', '4555#@G.com', '0135487621', 0, 'aad3869f085d0db9bccef69a8d8df0bda24c4d16', '2ec4518b7a3d9b2445e999623aee6f', '', 'koyra', 1, '', 0, '2019-10-17', '0000-00-00', '0000-00-00'),
(8, 0, 'lotif', '3333', 'ladin', 'hasi', 'jjhh@g.com', '01345698758', 0, 'bb436b586c4dc481a4ed5a4004785b9339339429', 'cd5d800cc582d9ee3927a2e582dffc', '', 'kodda', 1, '', 0, '2019-10-17', '0000-00-00', '0000-00-00'),
(9, 0, 'mithu', '154875454545454', 'malek', 'halima', 'jkjhhg@gmail.com', '017258496523', 0, '33df1c148180e9026e03f3a99c63875843ebc89e', '4a6663b69f66613c1ecf8a115d9b34', '', 'bongram', 1, '', 0, '2019-10-17', '0000-00-00', '0000-00-00'),
(10, 0, 'Hasan', '44587965', 'hasebul', 'hasina', 'jhh@Gmail.com', '1711587993', 0, '260f867af8488cb193682068628acd439e24d8a1', '0f9b9eaef331003709b0d058ef2107', '', 'soratala', 1, '', 0, '2019-10-17', '0000-00-00', '0000-00-00'),
(11, 0, 'hasibul', '852369', 'hannan', 'hani', '458@gmail.com', '01776838640', 0, '5ae37cdafe4ed80ffba570acd3b68ba8305ad554', '47987a50decd0ef8ba2528702e6672', '', 'horirampur', 1, '', 0, '2019-10-17', '0000-00-00', '0000-00-00'),
(12, 0, 'Quddus', '7412158963', 'Abdul', 'maaleka', '8785844@gmail.com', '1779654122', 0, '09698e58b239f0ed7ecdc78ce3014bf4dceb4340', '0391c956ce47afc43aa60277255e97', '', 'soratil', 1, '', 0, '2019-10-17', '0000-00-00', '0000-00-00'),
(13, 0, 'Hafiz', '96387564', 'Rohim', 'momotaz', '7458@gmail.com', '01766372551', 0, 'a10f23673c86c227988e79d9bc9d142d059b4332', '32ec9ac48f8a38849e393fdf451af3', '', 'holdipara', 1, '', 0, '2019-10-17', '0000-00-00', '0000-00-00'),
(14, 0, 'Golam', '1237879654', 'Robbani', 'parvin', 'poo@gmailo.com', '01756901804', 0, 'fd6b7f5c4344a1b1ef12bddeb163d079efc5239c', '8b3358bff2677fc429b97604038ab0', '', 'Holdigor', 1, '', 0, '2019-10-17', '0000-00-00', '0000-00-00'),
(15, 0, 'matahab', '963147852', 'uddin', 'Nilufa', 'jhhghg@gmail.com', '01718825456', 0, '0e25f3025f0b3d39cd87a118e609d76b85720650', '7f9b5597a830c1ffbe6972b0e69dad', '', 'chuldori', 1, '', 0, '2019-10-17', '0000-00-00', '0000-00-00'),
(16, 0, 'shaiful', '456123789', 'romana', 'rohima', 'jhhggf@gmail.com', '01734168523', 0, 'c52d3b1ad6f68951a33b3d82f27ff484af1af971', '1ff69b27d9f3a7a918120ecac96899', '', 'kayimpur', 1, '', 0, '2019-10-17', '0000-00-00', '0000-00-00'),
(17, 0, 'abdul', '168569', 'halim', 'mou', 'hjhjh@gmail.com', '01727895652', 0, '3ebb77f267ccec667ab7b492918c95d277375de8', '841dc4d30e2491041c5dcf16208a69', '', 'Bongram', 1, '', 0, '2019-10-17', '0000-00-00', '0000-00-00'),
(18, 0, 'Abul', '123654789', 'mazed', 'mazda', 'wsdrew@gmail.com', '01723603161', 0, '4d2a337928ff29988f894972297c58198b8f334f', '298e5c73c8fc9c8a9d8ff87bbdd350', '', 'Horipur', 1, '', 0, '2019-10-17', '0000-00-00', '0000-00-00'),
(19, 0, 'foysal', '74185629', 'tota', 'Feroza', 'sdds@outlook.com', '1760861669', 0, 'e5a05f10f135195c5a1ff0b4780f8e7f8cb4c81f', 'a88cbe0e44e151792114c38acacf43', '', 'ullapara', 1, '', 0, '2019-10-17', '0000-00-00', '0000-00-00'),
(20, 0, 'Bokkor', '2112121212121', 'Halim', 'Bilkis', 'sadsadsdsa@outlook.com', '01772021115', 0, 'ff1e5428f092cb9686d600dd074a43bed857722d', 'bf12cbcf1d25016ffd54ce03c5fcca', '', 'mohonpur', 1, '', 0, '2019-10-17', '0000-00-00', '0000-00-00'),
(21, 0, 'saiful', '458796521', 'Islam', 'Rohima', 'admin21@gmail.com', '01729883742', 0, '1310ae955cd0a555a8ae87858591287af2a94481', '77bacb319f64fed839184ebe5e06df', '', 'boropull', 1, '', 0, '2019-10-17', '0000-00-00', '0000-00-00'),
(22, 0, 'Romahan', '8999965584', 'Kader', 'Nurjahan', 'adminwewqe@gmail.com', '01789562314', 0, '2b8b9e612fbf025a1dcbb70d831334ee4819e8bf', '80b9f337fba68e23c6ee820c97252f', '', 'ffdfdfd', 1, '', 0, '2019-10-17', '0000-00-00', '0000-00-00'),
(23, 0, 'abhi', '45454545454', 'Abdul', 'kulsun', 'qasaan@gmail.com', '01378956231', 0, '72806679363708fd0f9e73db5f98a5d424834fd1', 'fc9f4d9e9a52ec19b47dae5b99c459', '', 'malsapara', 1, '', 0, '2019-10-17', '0000-00-00', '0000-00-00'),
(24, 0, 'MEHEDI HASSAN', 'JHJJ', '', '', 'rayhanspi@gmail.com', '01965905262', 0, '', '5ec1a08e2722c2cef3819721e72b78', '', 'gg', 0, '', 0, '2019-10-31', '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vote_schedule`
--

CREATE TABLE `tbl_vote_schedule` (
  `id` int(10) UNSIGNED NOT NULL,
  `election_id` int(10) UNSIGNED NOT NULL,
  `start_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_date` date NOT NULL,
  `end_time` time NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0 = active 1 = inactive',
  `remarks` mediumtext NOT NULL,
  `created_at` date NOT NULL,
  `modified_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_vote_schedule`
--

INSERT INTO `tbl_vote_schedule` (`id`, `election_id`, `start_date`, `start_time`, `end_date`, `end_time`, `status`, `remarks`, `created_at`, `modified_at`) VALUES
(1, 1, '2019-08-01', '12:30:00', '2019-10-03', '14:15:00', 1, '', '2019-10-19', '0000-00-00'),
(2, 2, '2019-10-19', '00:01:00', '2019-10-31', '12:01:00', 0, '', '2019-10-19', '0000-00-00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_mobile_unique` (`mobile`);

--
-- Indexes for table `tbl_candidate`
--
ALTER TABLE `tbl_candidate`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_mobile_unique` (`mobile`),
  ADD KEY `added_id` (`added_id`);

--
-- Indexes for table `tbl_election`
--
ALTER TABLE `tbl_election`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_election_active_voter`
--
ALTER TABLE `tbl_election_active_voter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `election_id` (`election_id`),
  ADD KEY `voter_id` (`voter_id`);

--
-- Indexes for table `tbl_election_candidate_post`
--
ALTER TABLE `tbl_election_candidate_post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `election_id` (`election_id`),
  ADD KEY `candidate_id` (`candidate_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `symbol_id` (`symbol_id`);

--
-- Indexes for table `tbl_final_vote`
--
ALTER TABLE `tbl_final_vote`
  ADD PRIMARY KEY (`id`),
  ADD KEY `election_id` (`election_id`),
  ADD KEY `candidate_id` (`candidate_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `voter_id` (`voter_id`);

--
-- Indexes for table `tbl_parcitipate_election`
--
ALTER TABLE `tbl_parcitipate_election`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_pin_history`
--
ALTER TABLE `tbl_pin_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_post`
--
ALTER TABLE `tbl_post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_symbol`
--
ALTER TABLE `tbl_symbol`
  ADD PRIMARY KEY (`id`),
  ADD KEY `added_id` (`added_id`);

--
-- Indexes for table `tbl_voter`
--
ALTER TABLE `tbl_voter`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_mobile_unique` (`mobile`),
  ADD KEY `added_id` (`added_id`);

--
-- Indexes for table `tbl_vote_schedule`
--
ALTER TABLE `tbl_vote_schedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `election_id` (`election_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_candidate`
--
ALTER TABLE `tbl_candidate`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_election`
--
ALTER TABLE `tbl_election`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_election_active_voter`
--
ALTER TABLE `tbl_election_active_voter`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `tbl_election_candidate_post`
--
ALTER TABLE `tbl_election_candidate_post`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_final_vote`
--
ALTER TABLE `tbl_final_vote`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_parcitipate_election`
--
ALTER TABLE `tbl_parcitipate_election`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_pin_history`
--
ALTER TABLE `tbl_pin_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `tbl_post`
--
ALTER TABLE `tbl_post`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_symbol`
--
ALTER TABLE `tbl_symbol`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_voter`
--
ALTER TABLE `tbl_voter`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `tbl_vote_schedule`
--
ALTER TABLE `tbl_vote_schedule`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_election_active_voter`
--
ALTER TABLE `tbl_election_active_voter`
  ADD CONSTRAINT `tbl_election_active_voter_ibfk_1` FOREIGN KEY (`election_id`) REFERENCES `tbl_election` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_election_active_voter_ibfk_2` FOREIGN KEY (`voter_id`) REFERENCES `tbl_voter` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_election_candidate_post`
--
ALTER TABLE `tbl_election_candidate_post`
  ADD CONSTRAINT `tbl_election_candidate_post_ibfk_1` FOREIGN KEY (`election_id`) REFERENCES `tbl_election` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_election_candidate_post_ibfk_2` FOREIGN KEY (`candidate_id`) REFERENCES `tbl_candidate` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_election_candidate_post_ibfk_3` FOREIGN KEY (`post_id`) REFERENCES `tbl_post` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_election_candidate_post_ibfk_4` FOREIGN KEY (`symbol_id`) REFERENCES `tbl_symbol` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_final_vote`
--
ALTER TABLE `tbl_final_vote`
  ADD CONSTRAINT `tbl_final_vote_ibfk_1` FOREIGN KEY (`election_id`) REFERENCES `tbl_election` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_final_vote_ibfk_2` FOREIGN KEY (`candidate_id`) REFERENCES `tbl_candidate` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_final_vote_ibfk_3` FOREIGN KEY (`post_id`) REFERENCES `tbl_post` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_final_vote_ibfk_4` FOREIGN KEY (`voter_id`) REFERENCES `tbl_voter` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_symbol`
--
ALTER TABLE `tbl_symbol`
  ADD CONSTRAINT `tbl_symbol_ibfk_1` FOREIGN KEY (`added_id`) REFERENCES `admin` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_vote_schedule`
--
ALTER TABLE `tbl_vote_schedule`
  ADD CONSTRAINT `tbl_vote_schedule_ibfk_1` FOREIGN KEY (`election_id`) REFERENCES `tbl_election` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

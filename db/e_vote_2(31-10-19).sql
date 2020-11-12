-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2019 at 01:25 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_vote_2`
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
(1, 'RAYHAN UDDIN', '', '', 'rayhanspi@gmail.com', '01729661197', 1, '0e9f59539b4965997246de771a0d7d2438398307', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 1, '', 0, '2019-10-14', '0000-00-00'),
(2, 'Avijit', '', '', 'admin@gmail.com', '01765568945', 2, 'dd81fef4ef478d22599689fe36a0eeb523f11682', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'sirajganj sadar, Sirajganj', 1, 'images/admin-AYSsBc2wcQyYmX8Du5Ga.jfif', 1, '2019-10-31', '2019-10-31');

-- --------------------------------------------------------

--
-- Table structure for table `password_change_history`
--

CREATE TABLE `password_change_history` (
  `id` int(10) UNSIGNED NOT NULL,
  `admin_id` int(10) UNSIGNED NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `reconver_code` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `type` tinyint(4) NOT NULL COMMENT '1= admin 2 = manager',
  `status` tinyint(4) NOT NULL COMMENT '1= by normal change 2 = forgotten password',
  `created_time` time NOT NULL,
  `created_at` date NOT NULL,
  `modified_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `password_change_history`
--

INSERT INTO `password_change_history` (`id`, `admin_id`, `password`, `reconver_code`, `type`, `status`, `created_time`, `created_at`, `modified_at`) VALUES
(1, 1, 'e4b1a1f0aa2cb2132c7cd1496b26a4ffe29f1a76', '', 1, 1, '16:43:30', '2019-10-30', '0000-00-00'),
(2, 1, 'e4b1a1f0aa2cb2132c7cd1496b26a4ffe29f1a76', '', 0, 2, '17:09:01', '2019-10-30', '0000-00-00'),
(3, 1, 'e4b1a1f0aa2cb2132c7cd1496b26a4ffe29f1a76', '', 1, 2, '17:15:41', '2019-10-30', '0000-00-00'),
(4, 1, '0e9f59539b4965997246de771a0d7d2438398307', '', 1, 1, '10:41:23', '2019-10-31', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_candidate`
--

CREATE TABLE `tbl_candidate` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `member_no` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `voter_no` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
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

INSERT INTO `tbl_candidate` (`id`, `name`, `member_no`, `voter_no`, `nid`, `father_name`, `mother_name`, `email`, `mobile`, `type`, `password`, `recover_code`, `address`, `status`, `image`, `added_id`, `creatd_at`, `modified_at`) VALUES
(1, 'President 1', 'm-123456', 'v-789654', 'hh', '', '', 'demo1@gmail.com', '01729666666', 0, 'b725357497b3b6556d3c7cfabbd3b3c617809c55', '', 'gg', 0, '', 1, '2019-10-30', '2019-10-31'),
(2, 'President 2', '', '', 'yip;', '', '', 'shahriar921@gmail.com', '01780518519', 0, 'ac0e9dbda6af6efe53a0032ebee83cc002780ed1', '', 'gththuy', 0, '', 1, '2019-10-30', '0000-00-00'),
(3, 'President 3', '123456', '789654', 'hjkftgjh', '', '', 'phpliton@gmail.com', '01685658698', 0, '499d1a5bcb5dd2ec401dc955c7b143666398e10e', '', 'sfhgfrh', 0, '', 1, '2019-10-30', '2019-10-31'),
(4, 'President 4', '', '', '15555', '', '', 'sagfhahfgjh@gmail.com', '017120390520', 0, '3fa1216177f3621ba2eb070510c5013466421d51', '', 'resyery', 0, '', 1, '2019-10-30', '0000-00-00'),
(5, 'Vice President-1', '', '', '85888', '', '', 'sdrgry@gmail.com', '01611646465', 0, 'c7e154ff397fa166b35360752a99fb69bb42e594', '', 'dghth', 0, '', 1, '2019-10-30', '0000-00-00'),
(6, 'Vice President-2', '', '', '1555555', '', '', 'sgsg@gmail.com', '01611343485', 0, '8a1ba9b7a8898f7684d1fb3a45f46ae89baa977e', '', 'sfhdtjh', 0, '', 1, '2019-10-30', '0000-00-00'),
(7, 'Vice President-3', '', '', '245328638635', '', '', 'gfgg@gmail.com', '01712010101', 0, '4720b93943559e01af51544b1324c38a2f46aba2', '', 'rdyirt', 0, '', 1, '2019-10-30', '0000-00-00'),
(8, 'Vice President-4', '', '', 'sryery57', '', '', 'vh@gmail.com', '01710787878', 0, '2b2c0f61ea4934990a7825ed47cf262cb7681aad', '', 'yrey', 0, '', 1, '2019-10-30', '0000-00-00'),
(9, 'Vice President-2-1', '', '', '6525858252', '', '', '85858@gmail.com', '01475826939', 0, '8dbbdc98874c9830993ec3e87861e1655333a91a', '', '65295282', 0, '', 1, '2019-10-30', '0000-00-00'),
(10, 'Vice President-2-2', '', '', '585858', '', '', 'vg@gmail.com', '01614545854', 0, 'd84a184107cfc92b1bf2ae0107f68caf019613d9', '', 'ehre', 0, '', 1, '2019-10-30', '0000-00-00'),
(11, 'Vice President-2-3', '', '', '785665', '', '', 'sdrgrdfy@gmail.com', '01710165454', 0, 'a4f44c20b9335ccc6e44e0d0b0ae3058279aaa41', '', 'tjtruj', 0, '', 1, '2019-10-30', '0000-00-00'),
(12, 'Vice President-2-4', '', '', '8588857', '', '', 'sdrgrytyy@gmail.com', '01415252525', 0, '58bca35df5bf4cce401b6fcc160b4cb4e34ee943', '', 'saghwrh', 0, '', 1, '2019-10-30', '0000-00-00'),
(13, 'General Secretary -1', '', '', '7858767532', '', '', 'hfgh@gmail.com', '01611454545', 0, '701fdd57c70c8ac4b22a12b467acfaa50949ecb7', '', 'yil;tyujrty', 0, '', 1, '2019-10-30', '0000-00-00'),
(14, 'General Secretary-2', '', '', '2453286386375', '', '', 'sagfyhahfgjh@gmail.com', '01611545858', 0, '4a88187e4e0c62b470cec7c8d52c80b22c654398', '', 'asryhwry', 0, '', 1, '2019-10-30', '0000-00-00'),
(15, 'General Secretary-3', '', '', '15555477', '', '', 's6gsg@gmail.com', '016525658568', 0, 'b397aa2700b6190c651814169d1dbcbe7d690cf5', '', 'sfhrRh', 0, '', 1, '2019-10-30', '0000-00-00'),
(16, 'General Secretary-4', '', '', '15555778', '', '', 'sag8fhahfgjh@gmail.com', '01658585858', 0, 'efc19db800fb1d292caa443e08b2fbd3ccfaee40', '', 'sdhrh', 0, '', 1, '2019-10-30', '0000-00-00'),
(17, 'Joint Secretary-2', '', '', '858887858', '', '', 'shahriar9281@gmail.com', '01625658696', 0, '10d201dc1f4e9c50f59ec075784b033483bac03b', '', 'srhwruyh', 0, '', 1, '2019-10-30', '0000-00-00'),
(18, 'Joint Secretary-1', '', '', 'hjkftgjhyy', '', '', 'sgrr5sg@gmail.com', '01710012525', 0, '655eeb052d22ad8a2bac60bd5fba5f78eefdfeb9', '', 'shSHSR', 0, '', 1, '2019-10-30', '0000-00-00'),
(19, 'Joint Secretary-3', '', '', '85888rrr', '', '', 'sdrgryyuy@gmail.com', '016856586989', 0, 'f0ac6c185ffb31697c9fc41d07f7743c1e408de1', '', 'AGAEGEG', 0, '', 1, '2019-10-30', '0000-00-00'),
(20, 'Joint Secretary-4', '', '', '1555545255', '', '', 'sagfha66hfgjh@gmail.com', '01674585959', 0, 'a82863dd4815b1ec95ad6091c4a51360f1a3d7e3', '', 'asrhgrh', 0, '', 1, '2019-10-30', '0000-00-00'),
(21, 'Treasurer-1', '', '', 'dfyuruit', '', '', 'gdh@gmail.com', '01652525258', 0, '874577fa086244e1557c7f75145875bfafbb5f34', '', 'shrtjt', 0, '', 1, '2019-10-30', '0000-00-00'),
(22, 'Treasurer-2', '', '', '24532863863', '', '', 'phplito7n@gmail.com', '0168545454', 0, '0f02ad6e184cf9cdc21bb035a5b3f19c4ede5ba5', '', 'gjhdtjtr', 0, '', 1, '2019-10-30', '0000-00-00'),
(23, 'Treasurer-3', '', '', '858887888', '', '', 'sgsrrrg@gmail.com', '017121525252', 0, '6a2fa6bd692d8c132266f218b4513bd01c76ecb1', '', 'frtjryij', 0, '', 1, '2019-10-30', '0000-00-00'),
(24, 'Board Member (Professional Affairs)-1', '', '', 'rdyuiriuyuy', '', '', 'tyty@gmail.com', '01712545698', 0, '06e9e62fbed7af084483ca9d2fb4fdc4d7402fe2', '', 'dryujrtutuy', 0, '', 1, '2019-10-30', '0000-00-00'),
(25, 'Board Member (Professional Affairs)-2', '', '', '85888rut', '', '', 'sgsgrrrf@gmail.com', '01658585851', 0, '8834d41cbe7a29ba3fd0ade836683072bf112211', '', 'fgjykyu', 0, '', 1, '2019-10-30', '0000-00-00'),
(26, 'Board Member (Academic Affairs)-1', '', '', 'fyur6u4', '', '', 'demodd1@gmail.com', '01685658697', 0, '754c3dc25cfc2fd598eac15c539465dfd332e9a4', '', 'sriu7otyg', 0, '', 1, '2019-10-30', '0000-00-00'),
(27, 'Board Member (Academic Affairs)-2', '', '', '8588848588', '', '', 'sgsfghfg@gmail.com', '01685658252', 0, '80d5e94dad84c8e99d48bc84d3a728a8b6ac8dc1', '', 'djdtjrtuj', 0, '', 1, '2019-10-30', '0000-00-00'),
(28, 'Board Member (Academic Affairs)-2', '', '', '8588etryt8', '', '', 'sdrgr6666y@gmail.com', '01654747788', 0, '2d0e32d20364f6338c6dabe9f8f99d67cd7576c0', '', 'fhkjrtue', 0, '', 1, '2019-10-30', '0000-00-00'),
(29, 'Board Member (Research & Publication)-1', '', '', 'tyolto7oii', '', '', 'demrrro1@gmail.com', '01712525252', 0, '4b2ef4d88b9cd9de4a73428e5d3e413242df4a3b', '', 'sdtgkjryiketuy', 0, '', 1, '2019-10-30', '0000-00-00'),
(30, 'Board Member (Research & Publication)-2', '', '', '85888uuuu', '', '', 'sdeerrergry@gmail.com', '01685587878', 0, 'bc9deb74e8a4ef2e320874c9b9b17df25e1723d9', '', 'jyrshrhj', 0, '', 1, '2019-10-30', '0000-00-00'),
(31, 'Board Member (Research & Publication)-3', '', '', '85888rrrr', '', '', 'sgsyygffg@gmail.com', '01698585858', 0, '360164933c1050d15892fa0ab31a31d0f3266d69', '', 'sdhsRhrweherh', 0, '', 1, '2019-10-30', '0000-00-00'),
(32, 'Board Member (National & International Liason)-1', '', '', 'ryir6ir6i6ri', '', '', 'demorrrr1@gmail.com', '01685454545', 0, '4299301eeacbc782f5fea4d9ac2691678102eda8', '', 'sfjhtjttj', 0, '', 1, '2019-10-30', '0000-00-00'),
(33, 'Board Member (National & International Liason)-2', '', '', '15555tttt', '', '', 'shahriartt921@gmail.com', '01913636363', 0, 'd47a17ea7709a0725978955faaa3d0694e6fbfce', '', 'ggedgerhgererh', 0, '', 1, '2019-10-30', '0000-00-00'),
(34, 'Board Member (National & International Liason)-3', '', '', '85888eteyt', '', '', 'sagfhayythfgjh@gmail.com', '01913654545', 0, 'de8215dafe75f76604ab402bc9f5619b0588ea6c', '', 'ryjkreet', 0, '', 1, '2019-10-30', '0000-00-00'),
(35, 'Board Member (Membership Affairs)-1', '', '', 'hjkfyyytgjh', '', '', 'sdryyygry@gmail.com', '01918757575', 0, '73e0438807008d98d2d577897ae1cf053c2f3844', '', 'sfhsrhsrrfh', 0, '', 1, '2019-10-30', '0000-00-00'),
(36, 'Board Member (Membership Affairs)-2', '', '', '15555ggg', '', '', 'sgsrrrrg@gmail.com', '01712525256', 0, '0385eb6a52e795898a5935dc6191c27086efd358', '', 'rwyteryers', 0, '', 1, '2019-10-30', '0000-00-00'),
(37, 'Board Member (Membership Affairs)-3', '', '', '858eee4488', '', '', 'sagfhtyyahfgjh@gmail.com', '01689685885', 0, 'a3e6e511c09fd8c389108f402ee4788b7391a49f', '', 'rjkrtjr', 0, '', 1, '2019-10-30', '0000-00-00'),
(38, 'Chaurman -1', '', '', '85878586688', '', '', 'sdr5554gry@gmail.com', '01685654552', 0, 'a09893000e6bbe13cf64c57aeb49a3040e25e679', '', 'dzjetDuj', 0, '', 1, '2019-10-30', '0000-00-00'),
(39, 'Chaurman-2', '', '', 'hjkftgjh5555', '', '', 'sagfhaeeeehfgjh@gmail.com', '01712152525', 0, '87d5c5f95a22a4fb2a7de7e24b2ca48c52e0ef7d', '', 'hdhjdfhdfh', 0, '', 1, '2019-10-30', '0000-00-00'),
(40, 'Candidate Member ship 1', 'm- 1', '10', '', '', '', 'm@gmail.com', '01729661188', 0, '7e555df794ead34c3264d81ad1c431fdce00c660', '', 'gg', 0, '', 1, '2019-10-30', '0000-00-00');

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
(1, 'BIP 14th Executive Board (2020-2021) Election', 0, '', '2019-10-27', '0000-00-00'),
(2, 'BIP Board Election 2019', 0, 'updated', '2019-10-28', '2019-10-31');

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
(1, 2, 4, '', '2019-10-31', '0000-00-00'),
(2, 2, 5, '', '2019-10-31', '0000-00-00'),
(3, 2, 6, '', '2019-10-31', '0000-00-00'),
(4, 2, 7, '', '2019-10-31', '0000-00-00'),
(5, 2, 8, '', '2019-10-31', '0000-00-00'),
(6, 2, 9, '', '2019-10-31', '0000-00-00'),
(7, 2, 10, '', '2019-10-31', '0000-00-00'),
(8, 2, 11, '', '2019-10-31', '0000-00-00'),
(9, 2, 12, '', '2019-10-31', '0000-00-00'),
(10, 2, 13, '', '2019-10-31', '0000-00-00'),
(11, 2, 14, '', '2019-10-31', '0000-00-00'),
(12, 2, 15, '', '2019-10-31', '0000-00-00'),
(13, 2, 16, '', '2019-10-31', '0000-00-00'),
(14, 2, 17, '', '2019-10-31', '0000-00-00'),
(15, 2, 18, '', '2019-10-31', '0000-00-00'),
(16, 2, 19, '', '2019-10-31', '0000-00-00'),
(17, 2, 20, '', '2019-10-31', '0000-00-00'),
(18, 2, 21, '', '2019-10-31', '0000-00-00'),
(19, 2, 22, '', '2019-10-31', '0000-00-00'),
(20, 2, 23, '', '2019-10-31', '0000-00-00');

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
(1, 2, 1, 1, 0, '', '2019-10-30', '0000-00-00'),
(2, 2, 1, 2, 0, '', '2019-10-30', '0000-00-00'),
(3, 2, 1, 3, 0, '', '2019-10-30', '0000-00-00'),
(4, 2, 2, 5, 0, '', '2019-10-30', '0000-00-00'),
(5, 2, 2, 6, 0, '', '2019-10-30', '0000-00-00'),
(6, 2, 2, 7, 0, '', '2019-10-30', '0000-00-00'),
(7, 2, 2, 8, 0, '', '2019-10-30', '0000-00-00'),
(8, 2, 3, 9, 0, '', '2019-10-30', '0000-00-00'),
(9, 2, 3, 10, 0, '', '2019-10-30', '0000-00-00'),
(10, 2, 3, 11, 0, '', '2019-10-30', '0000-00-00'),
(11, 2, 4, 13, 0, '', '2019-10-30', '0000-00-00'),
(12, 2, 4, 14, 0, '', '2019-10-30', '0000-00-00'),
(13, 2, 4, 15, 0, '', '2019-10-30', '0000-00-00'),
(14, 2, 4, 16, 0, '', '2019-10-30', '0000-00-00'),
(15, 2, 5, 18, 0, '', '2019-10-30', '0000-00-00'),
(16, 2, 5, 17, 0, '', '2019-10-30', '0000-00-00'),
(17, 2, 5, 19, 0, '', '2019-10-30', '0000-00-00'),
(18, 2, 6, 22, 0, '', '2019-10-30', '0000-00-00'),
(19, 2, 6, 23, 0, '', '2019-10-30', '0000-00-00'),
(20, 2, 9, 29, 0, '', '2019-10-30', '0000-00-00'),
(21, 2, 9, 31, 0, '', '2019-10-30', '0000-00-00'),
(22, 2, 10, 32, 0, '', '2019-10-30', '0000-00-00'),
(23, 2, 10, 33, 0, '', '2019-10-30', '0000-00-00'),
(24, 2, 10, 34, 0, '', '2019-10-30', '0000-00-00'),
(25, 2, 12, 38, 0, '', '2019-10-30', '0000-00-00'),
(26, 2, 12, 39, 0, '', '2019-10-30', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_final_vote`
--

CREATE TABLE `tbl_final_vote` (
  `id` int(10) UNSIGNED NOT NULL,
  `ballot_no` int(10) NOT NULL COMMENT 'global ballot paper',
  `election_id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `post_wise_ballot_paper` int(10) UNSIGNED NOT NULL COMMENT 'election id , post_id , ',
  `candidate_id` int(10) UNSIGNED NOT NULL,
  `voter_id` int(10) UNSIGNED NOT NULL,
  `pin_no` varchar(100) NOT NULL,
  `session_id` varchar(100) NOT NULL,
  `created_time` time NOT NULL,
  `created_at` date NOT NULL,
  `modified_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 2, 4, 'c64688', '10:53:12', '2019-10-31', '13:44:29', '2019-10-31'),
(2, 2, 5, 'c9cd66', '10:58:39', '2019-10-31', '00:00:00', '0000-00-00'),
(3, 2, 6, 'bf7825', '11:01:59', '2019-10-31', '00:00:00', '0000-00-00'),
(4, 2, 7, '53a0f7', '11:03:52', '2019-10-31', '12:33:11', '2019-10-31'),
(5, 2, 8, 'd5ac78', '11:05:38', '2019-10-31', '00:00:00', '0000-00-00'),
(6, 2, 9, 'fa620a', '11:07:52', '2019-10-31', '00:00:00', '0000-00-00'),
(7, 2, 10, '3d4a54', '11:09:46', '2019-10-31', '00:00:00', '0000-00-00'),
(8, 2, 11, 'ba852f', '11:11:20', '2019-10-31', '00:00:00', '0000-00-00'),
(9, 2, 12, 'fbe2ee', '11:12:45', '2019-10-31', '00:00:00', '0000-00-00'),
(10, 2, 13, '3a383d', '11:14:12', '2019-10-31', '00:00:00', '0000-00-00'),
(11, 2, 14, '0b8e3e', '11:15:36', '2019-10-31', '00:00:00', '0000-00-00'),
(12, 2, 15, 'c805dd', '11:17:17', '2019-10-31', '00:00:00', '0000-00-00'),
(13, 2, 16, '89b3cc', '11:18:13', '2019-10-31', '00:00:00', '0000-00-00'),
(14, 2, 17, 'a815d6', '11:19:27', '2019-10-31', '00:00:00', '0000-00-00'),
(15, 2, 18, '5196dc', '11:20:36', '2019-10-31', '00:00:00', '0000-00-00'),
(16, 2, 19, '78ca1a', '11:23:30', '2019-10-31', '00:00:00', '0000-00-00'),
(17, 2, 20, '5cd4e2', '11:25:58', '2019-10-31', '00:00:00', '0000-00-00'),
(18, 2, 21, '0b0756', '11:28:46', '2019-10-31', '00:00:00', '0000-00-00'),
(19, 2, 22, '533dcd', '11:32:03', '2019-10-31', '00:00:00', '0000-00-00'),
(20, 2, 23, 'ada345', '11:35:37', '2019-10-31', '00:00:00', '0000-00-00');

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
(1, 2, 4, 'd4cfa9', '12:02:43', '2019-10-30', '0000-00-00'),
(2, 2, 14, '8654c3', '12:05:18', '2019-10-30', '0000-00-00'),
(3, 2, 4, '533201', '12:14:17', '2019-10-30', '0000-00-00'),
(4, 2, 4, 'fbb9f8', '15:55:08', '2019-10-30', '0000-00-00'),
(5, 2, 4, '0d83fa', '16:03:53', '2019-10-30', '0000-00-00'),
(6, 2, 4, '9eb4e2', '16:04:55', '2019-10-30', '0000-00-00'),
(7, 2, 4, '9209e1', '16:06:39', '2019-10-30', '0000-00-00'),
(8, 2, 5, '7de246', '17:18:30', '2019-10-30', '0000-00-00'),
(9, 2, 6, 'c3fd15', '17:19:48', '2019-10-30', '0000-00-00'),
(10, 2, 6, '36f19c', '17:31:01', '2019-10-30', '0000-00-00'),
(11, 2, 4, 'b3ba86', '10:53:12', '2019-10-31', '0000-00-00'),
(12, 2, 5, 'c9cd66', '10:58:39', '2019-10-31', '0000-00-00'),
(13, 2, 6, 'bf7825', '11:01:59', '2019-10-31', '0000-00-00'),
(14, 2, 7, '528853', '11:03:52', '2019-10-31', '0000-00-00'),
(15, 2, 8, 'd5ac78', '11:05:38', '2019-10-31', '0000-00-00'),
(16, 2, 9, 'fa620a', '11:07:52', '2019-10-31', '0000-00-00'),
(17, 2, 10, '3d4a54', '11:09:46', '2019-10-31', '0000-00-00'),
(18, 2, 11, 'ba852f', '11:11:20', '2019-10-31', '0000-00-00'),
(19, 2, 12, 'fbe2ee', '11:12:45', '2019-10-31', '0000-00-00'),
(20, 2, 13, '3a383d', '11:14:12', '2019-10-31', '0000-00-00'),
(21, 2, 14, '0b8e3e', '11:15:36', '2019-10-31', '0000-00-00'),
(22, 2, 15, 'c805dd', '11:17:17', '2019-10-31', '0000-00-00'),
(23, 2, 16, '89b3cc', '11:18:13', '2019-10-31', '0000-00-00'),
(24, 2, 17, 'a815d6', '11:19:27', '2019-10-31', '0000-00-00'),
(25, 2, 18, '5196dc', '11:20:36', '2019-10-31', '0000-00-00'),
(26, 2, 19, '78ca1a', '11:23:30', '2019-10-31', '0000-00-00'),
(27, 2, 20, '5cd4e2', '11:25:58', '2019-10-31', '0000-00-00'),
(28, 2, 21, '0b0756', '11:28:46', '2019-10-31', '0000-00-00'),
(29, 2, 22, '533dcd', '11:32:03', '2019-10-31', '0000-00-00'),
(30, 2, 23, 'ada345', '11:35:37', '2019-10-31', '0000-00-00'),
(31, 2, 7, '53a0f7', '12:33:11', '2019-10-31', '0000-00-00'),
(32, 2, 4, 'e5b32f', '12:42:52', '2019-10-31', '0000-00-00'),
(33, 2, 4, 'c64688', '13:44:29', '2019-10-31', '0000-00-00');

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
(1, 'President', 20, 0, '', '2019-10-27', '0000-00-00'),
(2, 'Vice President-1', 2, 0, '', '2019-10-27', '0000-00-00'),
(3, 'Vice President-2', 3, 0, '', '2019-10-27', '0000-00-00'),
(4, 'General Secretary', 4, 0, '', '2019-10-27', '0000-00-00'),
(5, 'Joint Secretary', 5, 0, '', '2019-10-27', '0000-00-00'),
(6, 'Treasurer', 6, 0, '', '2019-10-27', '0000-00-00'),
(7, 'Board Member (Professional Affairs)', 7, 0, '', '2019-10-27', '0000-00-00'),
(8, 'Board Member (Academic Affairs)', 8, 0, '', '2019-10-27', '0000-00-00'),
(9, 'Board Member (Research & Publication)', 9, 0, '', '2019-10-27', '0000-00-00'),
(10, 'Board Member (National & International Liason)', 10, 0, '', '2019-10-27', '0000-00-00'),
(11, 'Board Member (Membership Affairs)', 11, 0, '', '2019-10-27', '0000-00-00'),
(12, 'Chairman', 1, 0, 'remarks', '2019-10-28', '2019-10-31');

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

-- --------------------------------------------------------

--
-- Table structure for table `tbl_temp_vote`
--

CREATE TABLE `tbl_temp_vote` (
  `id` int(10) UNSIGNED NOT NULL,
  `ballot_no` int(10) NOT NULL COMMENT 'global ballot paper',
  `election_id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `post_wise_ballot_paper` int(10) UNSIGNED NOT NULL COMMENT 'election id , post_id , ',
  `candidate_id` int(10) UNSIGNED NOT NULL,
  `voter_id` int(10) UNSIGNED NOT NULL,
  `pin_no` varchar(100) NOT NULL,
  `session_id` varchar(100) NOT NULL,
  `random_number` varchar(250) NOT NULL,
  `created_time` time NOT NULL,
  `created_at` date NOT NULL,
  `modified_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_voter`
--

CREATE TABLE `tbl_voter` (
  `id` int(10) UNSIGNED NOT NULL,
  `voter_id` int(10) UNSIGNED NOT NULL,
  `manual_membership_number` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `manual_voter_number` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
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

INSERT INTO `tbl_voter` (`id`, `voter_id`, `manual_membership_number`, `manual_voter_number`, `name`, `nid`, `father_name`, `mother_name`, `email`, `mobile`, `type`, `password`, `added_random_number`, `recover_code`, `address`, `status`, `image`, `added_id`, `creatd_at`, `verified_date`, `modified_at`) VALUES
(1, 1, '', '', 'Voter 1', 'hjjj', '', '', 'rayhanspi1@gmail.com', '01729661197', 0, '0e9f59539b4965997246de771a0d7d2438398307', 'a5d6c0bf849ea358c979c3ce64a265', '', 'bggg', 1, '', 0, '2019-10-15', '2019-10-15', '0000-00-00'),
(2, 0, '', '', 'Avijit', 'vggg', '', '', 'phpavijit567@gmail.com', '01765568945', 0, '', '5168f9ad066395cb050a53652b4d09', '', 'ff', 0, 'images/download.png', 0, '2019-10-15', '0000-00-00', '0000-00-00'),
(3, 2, '', '', 'Voter 2', '655', '', '', 'voter2@gmail.com', '0752764601', 0, 'fea031496f55f7a05412c20124ef135655386f6f', '9e1360944d43fb084328e1acb4782a', '', 'ghgggg', 1, '', 0, '2019-10-17', '0000-00-00', '0000-00-00'),
(4, 3, '123456', '789654', 'Hasibur Rahman Sopon', '1111', 'Jobbar', 'Halima', 'programmer.avijit@gmail.com', '01521417944', 0, 'de0aa6d4c7d0cb5317364fa71c2fded847ff116e', '31dac40225b834b32ba2ea4abbbd6d', '', 'ullapara', 1, '', 0, '2019-10-17', '0000-00-00', '2019-10-31'),
(5, 4, '', '', 'korim', '855', 'robban', 'Rohima', 'we@hh.com', '458', 0, '6ed8c320e506b6b4d2624210571d51993a5ef526', '7e4c12b1204936019580770d923fd2', '', 'donot', 1, '', 0, '2019-10-17', '0000-00-00', '0000-00-00'),
(6, 5, '', '', 'khalek', '123654', 'malek', 'kulsun', 'hjj@jjj.com', '013569874215', 0, 'fde070a6750fddbfdd7f846a5c0f830e819ce254', 'fb4b34e8d0314a62508669054aed02', '', 'malsapara', 1, '', 0, '2019-10-17', '0000-00-00', '0000-00-00'),
(7, 6, '', '', 'bellal', '111111111', 'Limon', 'Laki', '4555#@G.com', '0135487621', 0, 'aad3869f085d0db9bccef69a8d8df0bda24c4d16', '2ec4518b7a3d9b2445e999623aee6f', '', 'koyra', 1, '', 0, '2019-10-17', '0000-00-00', '0000-00-00'),
(8, 7, '', '', 'lotif', '3333', 'ladin', 'hasi', 'jjhh@g.com', '01345698758', 0, 'bb436b586c4dc481a4ed5a4004785b9339339429', 'cd5d800cc582d9ee3927a2e582dffc', '', 'kodda', 1, '', 0, '2019-10-17', '0000-00-00', '0000-00-00'),
(9, 8, '', '', 'mithu', '154875454545454', 'malek', 'halima', 'jkjhhg@gmail.com', '017258496523', 0, '33df1c148180e9026e03f3a99c63875843ebc89e', '4a6663b69f66613c1ecf8a115d9b34', '', 'bongram', 1, '', 0, '2019-10-17', '0000-00-00', '0000-00-00'),
(10, 9, '', '', 'Hasan', '44587965', 'hasebul', 'hasina', 'jhh@Gmail.com', '1711587993', 0, '260f867af8488cb193682068628acd439e24d8a1', '0f9b9eaef331003709b0d058ef2107', '', 'soratala', 1, '', 0, '2019-10-17', '0000-00-00', '0000-00-00'),
(11, 10, '', '', 'hasibul', '852369', 'hannan', 'hani', '458@gmail.com', '01776838640', 0, '5ae37cdafe4ed80ffba570acd3b68ba8305ad554', '47987a50decd0ef8ba2528702e6672', '', 'horirampur', 1, '', 0, '2019-10-17', '0000-00-00', '0000-00-00'),
(12, 11, '', '', 'Quddus', '7412158963', 'Abdul', 'maaleka', '8785844@gmail.com', '1779654122', 0, '09698e58b239f0ed7ecdc78ce3014bf4dceb4340', '0391c956ce47afc43aa60277255e97', '', 'soratil', 1, '', 0, '2019-10-17', '0000-00-00', '0000-00-00'),
(13, 12, '', '', 'Hafiz', '96387564', 'Rohim', 'momotaz', '7458@gmail.com', '01766372551', 0, 'a10f23673c86c227988e79d9bc9d142d059b4332', '32ec9ac48f8a38849e393fdf451af3', '', 'holdipara', 1, '', 0, '2019-10-17', '0000-00-00', '0000-00-00'),
(14, 13, '', '', 'Golam', '1237879654', 'Robbani', 'parvin', 'poo@gmailo.com', '01756901804', 0, 'fd6b7f5c4344a1b1ef12bddeb163d079efc5239c', '8b3358bff2677fc429b97604038ab0', '', 'Holdigor', 1, '', 0, '2019-10-17', '0000-00-00', '0000-00-00'),
(15, 14, '', '', 'matahab', '963147852', 'uddin', 'Nilufa', 'jhhghg@gmail.com', '01718825456', 0, '0e25f3025f0b3d39cd87a118e609d76b85720650', '7f9b5597a830c1ffbe6972b0e69dad', '', 'chuldori', 1, '', 0, '2019-10-17', '0000-00-00', '0000-00-00'),
(16, 15, '', '', 'shaiful', '456123789', 'romana', 'rohima', 'jhhggf@gmail.com', '01734168523', 0, 'c52d3b1ad6f68951a33b3d82f27ff484af1af971', '1ff69b27d9f3a7a918120ecac96899', '', 'kayimpur', 1, '', 0, '2019-10-17', '0000-00-00', '0000-00-00'),
(17, 16, '', '', 'abdul', '168569', 'halim', 'mou', 'hjhjh@gmail.com', '01727895652', 0, '3ebb77f267ccec667ab7b492918c95d277375de8', '841dc4d30e2491041c5dcf16208a69', '', 'Bongram', 1, '', 0, '2019-10-17', '0000-00-00', '0000-00-00'),
(18, 17, '', '', 'Abul', '123654789', 'mazed', 'mazda', 'wsdrew@gmail.com', '01723603161', 0, '4d2a337928ff29988f894972297c58198b8f334f', '298e5c73c8fc9c8a9d8ff87bbdd350', '', 'Horipur', 1, '', 0, '2019-10-17', '0000-00-00', '0000-00-00'),
(19, 18, '', '', 'foysal', '74185629', 'tota', 'Feroza', 'sdds@outlook.com', '1760861669', 0, 'e5a05f10f135195c5a1ff0b4780f8e7f8cb4c81f', 'a88cbe0e44e151792114c38acacf43', '', 'ullapara', 1, '', 0, '2019-10-17', '0000-00-00', '0000-00-00'),
(20, 19, '', '', 'Bokkor', '2112121212121', 'Halim', 'Bilkis', 'sadsadsdsa@outlook.com', '01772021115', 0, 'ff1e5428f092cb9686d600dd074a43bed857722d', 'bf12cbcf1d25016ffd54ce03c5fcca', '', 'mohonpur', 1, '', 0, '2019-10-17', '0000-00-00', '0000-00-00'),
(21, 20, '', '', 'saiful', '458796521', 'Islam', 'Rohima', 'admin21@gmail.com', '01729883742', 0, '1310ae955cd0a555a8ae87858591287af2a94481', '77bacb319f64fed839184ebe5e06df', '', 'boropull', 1, '', 0, '2019-10-17', '0000-00-00', '0000-00-00'),
(22, 21, '', '', 'Romahan', '8999965584', 'Kader', 'Nurjahan', 'adminwewqe@gmail.com', '01789562314', 0, '2b8b9e612fbf025a1dcbb70d831334ee4819e8bf', '80b9f337fba68e23c6ee820c97252f', '', 'ffdfdfd', 1, '', 0, '2019-10-17', '0000-00-00', '0000-00-00'),
(23, 22, '', '', 'abhi', '45454545454', 'Abdul', 'kulsun', 'qasaan@gmail.com', '01378956231', 0, '72806679363708fd0f9e73db5f98a5d424834fd1', 'fc9f4d9e9a52ec19b47dae5b99c459', '', 'malsapara', 1, '', 0, '2019-10-17', '0000-00-00', '0000-00-00'),
(24, 0, '', '', 'MEHEDI HASSAN', 'JHJJ', '', '', 'rayhanspiggggggg@gmail.com', '01965905262', 0, '', '5ec1a08e2722c2cef3819721e72b78', '', 'gg', 0, '', 0, '2019-10-31', '0000-00-00', '0000-00-00'),
(25, 23, '', '', 'Rayhan Uddin', 'hhh', '', '', 'rayhanspi@gmail.com', '01729661111', 0, '054a12d90f6fdeb3291a1fcb955f0961bf6b7ca2', 'cd4f0d5addbe344df05b4119a67814', '', 'ggg', 1, '', 0, '2019-10-20', '2019-10-20', '0000-00-00'),
(26, 0, 'F007', '125', 'Mr. Rahim', 'ASD158', 'Mr. Karim', 'Mrs. Karim', 'n@m.com', '01797670916', 0, '', '272909e0646f10acdbe26e3ccbdcac', '', 'Motijheel, Dhaka', 0, 'images/voter-iNBrFizvDPUgF53snAZf.jpg', 0, '2019-10-27', '0000-00-00', '0000-00-00'),
(27, 24, 'a2338', '223', 'Tanmay Sarker', 'fasdf23432', '', '', 'amio.k.sarker@gmail.com', '01722095816', 0, 'e285cd9a91d19532489e1e107f4c75c27bef82a3', '8923915ca882abb6366a13ba0f0aaf', '', 'Dhaka', 1, 'images/voter-I13is8zp2G8uvdRUSJgF.jpg', 0, '2019-10-28', '2019-10-28', '0000-00-00');

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
(1, 1, '2019-10-27', '04:00:00', '2019-10-27', '11:00:00', 1, '', '2019-10-27', '0000-00-00'),
(2, 2, '2019-10-28', '18:00:00', '2019-10-31', '19:30:00', 0, '', '2019-10-28', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `voter_password_change_history`
--

CREATE TABLE `voter_password_change_history` (
  `id` int(10) UNSIGNED NOT NULL,
  `admin_id` int(10) UNSIGNED NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `reconver_code` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `type` tinyint(4) NOT NULL COMMENT '1= admin 2 = manager',
  `status` tinyint(4) NOT NULL COMMENT '1= by normal change 2 = forgotten password',
  `created_time` time NOT NULL,
  `created_at` date NOT NULL,
  `modified_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `voter_password_change_history`
--

INSERT INTO `voter_password_change_history` (`id`, `admin_id`, `password`, `reconver_code`, `type`, `status`, `created_time`, `created_at`, `modified_at`) VALUES
(1, 4, 'de0aa6d4c7d0cb5317364fa71c2fded847ff116e', '', 0, 1, '13:01:09', '2019-10-31', '0000-00-00'),
(2, 4, '291944668a2843fab3b89f26f3f5a79c77de77d3', '', 0, 2, '13:34:44', '2019-10-31', '0000-00-00'),
(3, 4, 'de0aa6d4c7d0cb5317364fa71c2fded847ff116e', '', 0, 1, '13:35:28', '2019-10-31', '0000-00-00');

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
-- Indexes for table `password_change_history`
--
ALTER TABLE `password_change_history`
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `tbl_final_vote`
--
ALTER TABLE `tbl_final_vote`
  ADD PRIMARY KEY (`id`),
  ADD KEY `election_id` (`election_id`),
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
-- Indexes for table `tbl_temp_vote`
--
ALTER TABLE `tbl_temp_vote`
  ADD PRIMARY KEY (`id`),
  ADD KEY `election_id` (`election_id`),
  ADD KEY `post_id` (`post_id`);

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
-- Indexes for table `voter_password_change_history`
--
ALTER TABLE `voter_password_change_history`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `password_change_history`
--
ALTER TABLE `password_change_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_candidate`
--
ALTER TABLE `tbl_candidate`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_final_vote`
--
ALTER TABLE `tbl_final_vote`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_parcitipate_election`
--
ALTER TABLE `tbl_parcitipate_election`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_pin_history`
--
ALTER TABLE `tbl_pin_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tbl_post`
--
ALTER TABLE `tbl_post`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_symbol`
--
ALTER TABLE `tbl_symbol`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_temp_vote`
--
ALTER TABLE `tbl_temp_vote`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;

--
-- AUTO_INCREMENT for table `tbl_voter`
--
ALTER TABLE `tbl_voter`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tbl_vote_schedule`
--
ALTER TABLE `tbl_vote_schedule`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `voter_password_change_history`
--
ALTER TABLE `voter_password_change_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  ADD CONSTRAINT `tbl_election_candidate_post_ibfk_3` FOREIGN KEY (`post_id`) REFERENCES `tbl_post` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_final_vote`
--
ALTER TABLE `tbl_final_vote`
  ADD CONSTRAINT `tbl_final_vote_ibfk_1` FOREIGN KEY (`election_id`) REFERENCES `tbl_election` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_final_vote_ibfk_3` FOREIGN KEY (`post_id`) REFERENCES `tbl_post` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_final_vote_ibfk_4` FOREIGN KEY (`voter_id`) REFERENCES `tbl_voter` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_symbol`
--
ALTER TABLE `tbl_symbol`
  ADD CONSTRAINT `tbl_symbol_ibfk_1` FOREIGN KEY (`added_id`) REFERENCES `admin` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_temp_vote`
--
ALTER TABLE `tbl_temp_vote`
  ADD CONSTRAINT `tbl_temp_vote_ibfk_1` FOREIGN KEY (`election_id`) REFERENCES `tbl_election` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_temp_vote_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `tbl_post` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_vote_schedule`
--
ALTER TABLE `tbl_vote_schedule`
  ADD CONSTRAINT `tbl_vote_schedule_ibfk_1` FOREIGN KEY (`election_id`) REFERENCES `tbl_election` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

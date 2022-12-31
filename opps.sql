-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 25, 2022 at 12:50 PM
-- Server version: 5.7.38-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `opps`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `image` varchar(100) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `otp` int(11) NOT NULL,
  `adminBalance` double NOT NULL,
  `botWinLossAmt` double NOT NULL,
  `adpass` varchar(233) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`id`, `name`, `email`, `password`, `status`, `image`, `mobile`, `otp`, `adminBalance`, `botWinLossAmt`, `adpass`, `created`, `modified`) VALUES
(1, 'Administrator', 'opps@game.com', 'e10adc3949ba59abbe56e057f20f883e', 'Active', 'AT_4429cartoon.png', '', 0, 4198.5212, 0, 'ec8e7b6e6035a714eb88230417c005f1', '2019-09-10 12:47:00', '2020-10-12 14:36:21');

-- --------------------------------------------------------

--
-- Table structure for table `bank_details`
--

CREATE TABLE `bank_details` (
  `id` int(11) NOT NULL,
  `user_detail_id` varchar(20) DEFAULT NULL,
  `acc_holderName` varchar(255) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `bank_city` varchar(255) DEFAULT NULL,
  `bank_branch` varchar(255) DEFAULT NULL,
  `accno` varchar(255) DEFAULT NULL,
  `ifsc` varchar(255) DEFAULT NULL,
  `is_bankVerified` enum('Pending','Verified','Rejected') DEFAULT 'Pending',
  `bankImage` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `categories_list`
--

CREATE TABLE `categories_list` (
  `id` int(11) NOT NULL,
  `categoryName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories_list`
--

INSERT INTO `categories_list` (`id`, `categoryName`) VALUES
(2, 'Originals'),
(3, 'Short Films'),
(5, 'Award Winning'),
(6, 'Drama'),
(7, 'Romantic Movies'),
(8, 'Comedy Blockbusters'),
(9, 'Web Series');

-- --------------------------------------------------------

--
-- Table structure for table `episodes`
--

CREATE TABLE `episodes` (
  `id` int(11) NOT NULL,
  `seriesId` varchar(255) NOT NULL,
  `seasonId` varchar(255) NOT NULL,
  `episodeId` varchar(255) NOT NULL,
  `episodeNo` int(11) NOT NULL,
  `episodeName` varchar(255) DEFAULT NULL,
  `episodeDetails` text,
  `videoLink` tinyint(1) NOT NULL DEFAULT '0',
  `thumbnailImage` tinyint(1) NOT NULL DEFAULT '0',
  `releaseDate` datetime NOT NULL,
  `addedOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `episodes`
--

INSERT INTO `episodes` (`id`, `seriesId`, `seasonId`, `episodeId`, `episodeNo`, `episodeName`, `episodeDetails`, `videoLink`, `thumbnailImage`, `releaseDate`, `addedOn`) VALUES
(1, 'SER6721599564012', 'SER6721599564012-S-1-275', 'SER6721599564012-S-1-E-1', 1, 'Friends forever', '1st episode of friends', 1, 1, '2020-10-03 17:30:00', '2020-09-08 17:30:14'),
(2, 'SER6721599564012', 'SER6721599564012-S-1-275', 'SER6721599564012-S-1-E-2', 2, 'Friends forever', '2nd episode of friends', 0, 1, '2020-10-03 17:30:00', '2020-09-08 17:30:14'),
(3, 'SER1441600768529', 'SER1441600768529-S-1-827', 'SER1441600768529-S-1-E-1', 1, 'Testing S3-E-1', 'This is really good episode. Inside this there is comedy between...', 1, 1, '2020-09-28 15:57:00', '2020-09-22 15:57:33'),
(4, 'SER6651600949676', 'SER6651600949676-S-1-854', 'SER6651600949676-S-1-E-1', 1, 'Haq Se Single E-1', 'Zakir Khan is an Indian stand-up comedian, writer, presenter and actor. In 2012, he rose to popularity by winning Comedy Central\'s India\'s 3rd Best Stand Up Comedian competition. He has also been a part of a news comedy show, On Air with AIB.', 1, 1, '2020-09-24 18:07:00', '2020-09-24 18:08:39'),
(5, 'SER6651600949676', 'SER6651600949676-S-1-854', 'SER6651600949676-S-1-E-2', 2, 'Haq Se Single E-2', 'Zakir Khan is an Indian stand-up comedian, writer, presenter and actor. In 2012, he rose to popularity by winning Comedy Central\'s India\'s 3rd Best Stand Up Comedian competition. He has also been a part of a news comedy show, On Air with AIB.', 1, 1, '2020-09-24 18:14:00', '2020-09-24 18:14:28'),
(6, 'SER6651600949676', 'SER6651600949676-S-1-854', 'SER6651600949676-S-1-E-3', 3, 'Haq Se Single E-3', 'Zakir Khan is an Indian stand-up comedian, writer, presenter and actor. In 2012, he rose to popularity by winning Comedy Central\'s India\'s 3rd Best Stand Up Comedian competition. He has also been a part of a news comedy show, On Air with AIB.', 1, 1, '2020-09-24 18:16:00', '2020-09-24 18:16:46'),
(7, 'SER6651600949676', 'SER6651600949676-S-2-580', 'SER6651600949676-S-2-E-1', 1, 'Haq Se Single E-1', 'Zakir Khan is an Indian stand-up comedian, writer, presenter and actor. In 2012, he rose to popularity by winning Comedy Central\'s India\'s 3rd Best Stand Up Comedian competition. He has also been a part of a news comedy show, On Air with AIB.', 1, 1, '2020-09-24 18:18:00', '2020-09-24 18:18:07'),
(8, 'SER6651600949676', 'SER6651600949676-S-2-580', 'SER6651600949676-S-2-E-2', 2, 'Haq Se Single E-2', 'Zakir Khan is an Indian stand-up comedian, writer, presenter and actor. In 2012, he rose to popularity by winning Comedy Central\'s India\'s 3rd Best Stand Up Comedian competition. He has also been a part of a news comedy show, On Air with AIB.', 1, 1, '2020-09-24 18:19:00', '2020-09-24 18:19:31'),
(9, 'SER6651600949676', 'SER6651600949676-S-2-580', 'SER6651600949676-S-2-E-3', 3, 'Haq Se Single E-3', 'Zakir Khan is an Indian stand-up comedian, writer, presenter and actor. In 2012, he rose to popularity by winning Comedy Central\'s India\'s 3rd Best Stand Up Comedian competition. He has also been a part of a news comedy show, On Air with AIB.', 1, 1, '2020-09-24 18:20:00', '2020-09-24 18:21:01'),
(10, 'SER2191600950092', 'SER2191600950092-S-1-699', 'SER2191600950092-S-1-E-1', 1, 'Dance India Dance E-1', 'Dance India Dance (also called by the acronym DID; tagline:Dance Ka Asli ID D.I.D.) is an Indian dance competition reality television series that airs on Zee TV', 1, 1, '2020-09-24 18:31:00', '2020-09-24 18:31:57'),
(11, 'SER2191600950092', 'SER2191600950092-S-1-699', 'SER2191600950092-S-1-E-2', 2, 'Dance India Dance E-2', 'Dance India Dance (also called by the acronym DID; tagline:Dance Ka Asli ID D.I.D.) is an Indian dance competition reality television series that airs on Zee TV', 1, 1, '2020-09-24 18:35:00', '2020-09-24 18:35:56'),
(12, 'SER2191600950092', 'SER2191600950092-S-1-699', 'SER2191600950092-S-1-E-3', 3, 'Dance India Dance E-3', 'Dance India Dance (also called by the acronym DID; tagline:Dance Ka Asli ID D.I.D.) is an Indian dance competition reality television series that airs on Zee TV', 1, 1, '2020-09-24 18:37:00', '2020-09-24 18:37:31'),
(15, 'SER6741657536031', 'SER6741657536031-S-1-488', 'SER6741657536031-S-1-E-1', 1, 'CUBICLES SEASON 2 || EP01', 'Enter text here...', 0, 0, '2022-02-01 14:15:00', '2022-07-12 08:45:18'),
(16, 'SER2191657278281', 'SER2191657278281-S-01-265', 'SER2191657278281-S-1-E-1', 1, 'CLASSMATES || EP01', 'CLASSMATES || EP01', 1, 1, '2022-02-01 14:17:00', '2022-07-12 08:47:49'),
(17, 'SER5571657619531', 'SER5571657619531-S-1-232', 'SER5571657619531-S-1-E-1', 1, 'CUBICLES || EP01', 'CUBICLES || EP01', 1, 1, '2021-02-01 15:28:00', '2022-07-12 09:58:19'),
(18, 'SER5571657619531', 'SER5571657619531-S-1-232', 'SER5571657619531-S-1-E-2', 2, 'CUBICLES || EP02', 'CUBICLES || EP02', 1, 1, '2021-02-01 16:51:00', '2022-07-12 11:21:55'),
(19, 'SER5571657619531', 'SER5571657619531-S-1-232', 'SER5571657619531-S-1-E-3', 3, 'CUBICLES || EP03', 'CUBICLES || EP03', 1, 1, '2021-02-01 17:00:00', '2022-07-12 11:31:04'),
(20, 'SER1801657619559', 'SER1801657619559-S-1-840', 'SER1801657619559-S-1-E-1', 1, 'CLASSMATES || EP01', 'CLASSMATES || EP01', 1, 1, '2021-03-01 17:26:00', '2022-07-12 11:56:31'),
(22, 'SER1801657619559', 'SER1801657619559-S-1-840', 'SER1801657619559-S-1-E-2', 2, 'CLASSMATES || EP02', 'CLASSMATES || EP02', 1, 1, '2021-03-01 17:27:00', '2022-07-12 11:57:29'),
(23, 'SER1801657619559', 'SER1801657619559-S-1-840', 'SER1801657619559-S-1-E-3', 3, 'CLASSMATES || EP03', 'CLASSMATES || EP03', 1, 1, '2021-03-01 17:27:00', '2022-07-12 11:57:48'),
(24, 'SER1801657619559', 'SER1801657619559-S-1-840', 'SER1801657619559-S-1-E-4', 4, 'CLASSMATES || EP04', 'CLASSMATES || EP04', 1, 1, '2021-03-01 17:28:00', '2022-07-12 11:58:10'),
(25, 'SER1801657619559', 'SER1801657619559-S-2-639', 'SER1801657619559-S-2-E-1', 1, 'CLASSMATES || season 2 || EP01', 'CLASSMATES || season 2 || EP01', 1, 1, '2020-01-01 11:20:00', '2022-07-19 05:50:57'),
(26, 'SER1801657619559', 'SER1801657619559-S-2-639', 'SER1801657619559-S-2-E-2', 2, 'CLASSMATES || season 2 || EP02', 'CLASSMATES || season 2 || EP02', 1, 1, '2020-01-19 15:06:00', '2022-07-19 09:36:41');

-- --------------------------------------------------------

--
-- Table structure for table `episode_audio_files`
--

CREATE TABLE `episode_audio_files` (
  `id` int(11) NOT NULL,
  `episodeId` varchar(255) NOT NULL,
  `language` int(11) NOT NULL,
  `audioFileLink` varchar(255) DEFAULT NULL,
  `keyName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `episode_audio_files`
--

INSERT INTO `episode_audio_files` (`id`, `episodeId`, `language`, `audioFileLink`, `keyName`) VALUES
(1, 'SER6721599564012-S-1-E-1', 1, NULL, NULL),
(2, 'SER6721599564012-S-1-E-1', 2, NULL, NULL),
(3, 'SER1441600768529-S-1-E-1', 1, NULL, NULL),
(4, 'SER1441600768529-S-1-E-1', 2, NULL, NULL),
(5, 'SER6651600949676-S-1-E-1', 1, NULL, NULL),
(6, 'SER6651600949676-S-1-E-1', 2, NULL, NULL),
(7, 'SER6651600949676-S-1-E-2', 1, NULL, NULL),
(8, 'SER6651600949676-S-1-E-2', 2, NULL, NULL),
(9, 'SER6651600949676-S-1-E-3', 1, NULL, NULL),
(10, 'SER6651600949676-S-1-E-3', 2, NULL, NULL),
(11, 'SER6651600949676-S-2-E-1', 1, NULL, NULL),
(12, 'SER6651600949676-S-2-E-1', 2, NULL, NULL),
(13, 'SER6651600949676-S-2-E-2', 1, NULL, NULL),
(14, 'SER6651600949676-S-2-E-2', 2, NULL, NULL),
(15, 'SER6651600949676-S-2-E-3', 1, NULL, NULL),
(16, 'SER6651600949676-S-2-E-3', 2, NULL, NULL),
(17, 'SER2191600950092-S-1-E-1', 1, NULL, NULL),
(18, 'SER2191600950092-S-1-E-1', 2, NULL, NULL),
(19, 'SER2191600950092-S-1-E-2', 1, NULL, NULL),
(20, 'SER2191600950092-S-1-E-2', 2, NULL, NULL),
(21, 'SER2191600950092-S-1-E-3', 1, NULL, NULL),
(22, 'SER2191600950092-S-1-E-3', 2, NULL, NULL),
(23, 'SER2191657278281-S-1-E-2', 1, NULL, NULL),
(24, 'SER2191657278281-S-1-E-2', 2, NULL, NULL),
(25, 'SER2191657278281-S-1-E-1', 1, NULL, NULL),
(26, 'SER2191657278281-S-1-E-1', 2, NULL, NULL),
(27, 'SER6741657536031-S-1-E-1', 1, NULL, NULL),
(28, 'SER6741657536031-S-1-E-1', 2, NULL, NULL),
(29, 'SER2191657278281-S-1-E-1', 1, NULL, NULL),
(30, 'SER2191657278281-S-1-E-1', 2, NULL, NULL),
(31, 'SER5571657619531-S-1-E-1', 1, NULL, NULL),
(32, 'SER5571657619531-S-1-E-1', 2, NULL, NULL),
(33, 'SER5571657619531-S-1-E-2', 1, NULL, NULL),
(34, 'SER5571657619531-S-1-E-2', 2, NULL, NULL),
(35, 'SER5571657619531-S-1-E-3', 1, NULL, NULL),
(36, 'SER5571657619531-S-1-E-3', 2, NULL, NULL),
(37, 'SER1801657619559-S-1-E-1', 1, NULL, NULL),
(38, 'SER1801657619559-S-1-E-1', 2, NULL, NULL),
(39, 'SER1801657619559-S-1-E-2', 1, NULL, NULL),
(40, 'SER1801657619559-S-1-E-2', 2, NULL, NULL),
(41, 'SER1801657619559-S-1-E-2', 1, NULL, NULL),
(42, 'SER1801657619559-S-1-E-2', 2, NULL, NULL),
(43, 'SER1801657619559-S-1-E-3', 1, NULL, NULL),
(44, 'SER1801657619559-S-1-E-3', 2, NULL, NULL),
(45, 'SER1801657619559-S-1-E-4', 1, NULL, NULL),
(46, 'SER1801657619559-S-1-E-4', 2, NULL, NULL),
(47, 'SER1801657619559-S-2-E-1', 1, NULL, NULL),
(48, 'SER1801657619559-S-2-E-1', 2, NULL, NULL),
(49, 'SER1801657619559-S-2-E-2', 1, NULL, NULL),
(50, 'SER1801657619559-S-2-E-2', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `episode_subtitle`
--

CREATE TABLE `episode_subtitle` (
  `id` int(11) NOT NULL,
  `episodeId` varchar(255) NOT NULL,
  `language` int(11) NOT NULL,
  `subtitle_fileLink` varchar(255) DEFAULT NULL,
  `keyName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `episode_subtitle`
--

INSERT INTO `episode_subtitle` (`id`, `episodeId`, `language`, `subtitle_fileLink`, `keyName`) VALUES
(1, 'SER6721599564012-S-1-E-1', 1, NULL, NULL),
(2, 'SER6721599564012-S-1-E-1', 2, NULL, NULL),
(3, 'SER1441600768529-S-1-E-1', 1, NULL, NULL),
(4, 'SER1441600768529-S-1-E-1', 2, NULL, NULL),
(5, 'SER6651600949676-S-1-E-1', 1, NULL, NULL),
(6, 'SER6651600949676-S-1-E-1', 2, NULL, NULL),
(7, 'SER6651600949676-S-1-E-2', 1, NULL, NULL),
(8, 'SER6651600949676-S-1-E-2', 2, NULL, NULL),
(9, 'SER6651600949676-S-1-E-3', 1, NULL, NULL),
(10, 'SER6651600949676-S-1-E-3', 2, NULL, NULL),
(11, 'SER6651600949676-S-2-E-1', 1, NULL, NULL),
(12, 'SER6651600949676-S-2-E-1', 2, NULL, NULL),
(13, 'SER6651600949676-S-2-E-2', 1, NULL, NULL),
(14, 'SER6651600949676-S-2-E-2', 2, NULL, NULL),
(15, 'SER6651600949676-S-2-E-3', 1, NULL, NULL),
(16, 'SER6651600949676-S-2-E-3', 2, NULL, NULL),
(17, 'SER2191600950092-S-1-E-1', 1, NULL, NULL),
(18, 'SER2191600950092-S-1-E-1', 2, NULL, NULL),
(19, 'SER2191600950092-S-1-E-2', 1, NULL, NULL),
(20, 'SER2191600950092-S-1-E-2', 2, NULL, NULL),
(21, 'SER2191600950092-S-1-E-3', 1, NULL, NULL),
(22, 'SER2191600950092-S-1-E-3', 2, NULL, NULL),
(23, 'SER2191657278281-S-1-E-2', 1, NULL, NULL),
(24, 'SER2191657278281-S-1-E-2', 2, NULL, NULL),
(25, 'SER2191657278281-S-1-E-1', 1, NULL, NULL),
(26, 'SER2191657278281-S-1-E-1', 2, NULL, NULL),
(27, 'SER6741657536031-S-1-E-1', 1, NULL, NULL),
(28, 'SER6741657536031-S-1-E-1', 2, NULL, NULL),
(29, 'SER2191657278281-S-1-E-1', 1, NULL, NULL),
(30, 'SER2191657278281-S-1-E-1', 2, NULL, NULL),
(31, 'SER5571657619531-S-1-E-1', 1, NULL, NULL),
(32, 'SER5571657619531-S-1-E-1', 2, NULL, NULL),
(33, 'SER5571657619531-S-1-E-2', 1, NULL, NULL),
(34, 'SER5571657619531-S-1-E-2', 2, NULL, NULL),
(35, 'SER5571657619531-S-1-E-3', 1, NULL, NULL),
(36, 'SER5571657619531-S-1-E-3', 2, NULL, NULL),
(37, 'SER1801657619559-S-1-E-1', 1, NULL, NULL),
(38, 'SER1801657619559-S-1-E-1', 2, NULL, NULL),
(39, 'SER1801657619559-S-1-E-2', 1, NULL, NULL),
(40, 'SER1801657619559-S-1-E-2', 2, NULL, NULL),
(41, 'SER1801657619559-S-1-E-2', 1, NULL, NULL),
(42, 'SER1801657619559-S-1-E-2', 2, NULL, NULL),
(43, 'SER1801657619559-S-1-E-3', 1, NULL, NULL),
(44, 'SER1801657619559-S-1-E-3', 2, NULL, NULL),
(45, 'SER1801657619559-S-1-E-4', 1, NULL, NULL),
(46, 'SER1801657619559-S-1-E-4', 2, NULL, NULL),
(47, 'SER1801657619559-S-2-E-1', 1, NULL, NULL),
(48, 'SER1801657619559-S-2-E-1', 2, NULL, NULL),
(49, 'SER1801657619559-S-2-E-2', 1, NULL, NULL),
(50, 'SER1801657619559-S-2-E-2', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `episode_thumbnail_data`
--

CREATE TABLE `episode_thumbnail_data` (
  `id` int(11) NOT NULL,
  `episodeId` varchar(255) NOT NULL,
  `thumbnailLink` varchar(255) NOT NULL,
  `keyName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `episode_thumbnail_data`
--

INSERT INTO `episode_thumbnail_data` (`id`, `episodeId`, `thumbnailLink`, `keyName`) VALUES
(1, 'SER6721599564012-S-1-E-1', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/series/thumbnail/Friends.jpg', 'videos/series/thumbnail/Friends.jpg'),
(2, 'SER6721599564012-S-1-E-2', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/series/thumbnail/friends1.jpg', 'videos/series/thumbnail/friends1.jpg'),
(3, 'SER1441600768529-S-1-E-1', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/series/thumbnail/EPImageSER1441600768529-S-1-E-1-5421600770470thumbs_up-wallpaper-1920x1080.jpg', 'videos/series/thumbnail/EPImageSER1441600768529-S-1-E-1-5421600770470thumbs_up-wallpaper-1920x1080.jpg'),
(4, 'SER6651600949676-S-1-E-1', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/series/thumbnail/HaqSeSingleSeries.png', 'videos/series/thumbnail/HaqSeSingleSeries.png'),
(5, 'SER6651600949676-S-1-E-2', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/series/thumbnail/HaqSeSingleSeries.png', 'videos/series/thumbnail/HaqSeSingleSeries.png'),
(6, 'SER6651600949676-S-1-E-3', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/series/thumbnail/HaqSeSingleSeries.png', 'videos/series/thumbnail/HaqSeSingleSeries.png'),
(7, 'SER6651600949676-S-2-E-1', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/series/thumbnail/HaqSeSingleSeries.png', 'videos/series/thumbnail/HaqSeSingleSeries.png'),
(8, 'SER6651600949676-S-2-E-2', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/series/thumbnail/HaqSeSingleSeries.png', 'videos/series/thumbnail/HaqSeSingleSeries.png'),
(9, 'SER6651600949676-S-2-E-3', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/series/thumbnail/HaqSeSingleSeries.png', 'videos/series/thumbnail/HaqSeSingleSeries.png'),
(10, 'SER2191600950092-S-1-E-1', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/series/thumbnail/DIDEpisodeThumbnail.png', 'videos/series/thumbnail/DIDEpisodeThumbnail.png'),
(11, 'SER2191600950092-S-1-E-2', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/series/thumbnail/DIDEpisodeThumbnail.png', 'videos/series/thumbnail/DIDEpisodeThumbnail.png'),
(12, 'SER2191600950092-S-1-E-3', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/series/thumbnail/DIDEpisodeThumbnail.png', 'videos/series/thumbnail/DIDEpisodeThumbnail.png'),
(13, 'SER2191657278281-S-1-E-2', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/series/thumbnail/EPImageSER2191657278281-S-1-E-2-3501657534105ep1.jpg', 'videos/series/thumbnail/EPImageSER2191657278281-S-1-E-2-3501657534105ep1.jpg'),
(14, 'SER2191657278281-S-1-E-1', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/series/thumbnail/EPImageSER2191657278281-S-1-E-1-7331657616148ep1.jpg', 'videos/series/thumbnail/EPImageSER2191657278281-S-1-E-1-7331657616148ep1.jpg'),
(15, 'SER5571657619531-S-1-E-1', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/series/thumbnail/EPImageSER5571657619531-S-1-E-1-1921657620552cubi.jpeg', 'videos/series/thumbnail/EPImageSER5571657619531-S-1-E-1-1921657620552cubi.jpeg'),
(16, 'SER5571657619531-S-1-E-2', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/series/thumbnail/EPImageSER5571657619531-S-1-E-2-831657625014cubicles.jpg', 'videos/series/thumbnail/EPImageSER5571657619531-S-1-E-2-831657625014cubicles.jpg'),
(17, 'SER5571657619531-S-1-E-3', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/series/thumbnail/EPImageSER5571657619531-S-1-E-3-8021657625497ep3.jpg', 'videos/series/thumbnail/EPImageSER5571657619531-S-1-E-3-8021657625497ep3.jpg'),
(18, 'SER1801657619559-S-1-E-1', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/series/thumbnail/EPImageSER1801657619559-S-1-E-1-1801657627111class.jpg', 'videos/series/thumbnail/EPImageSER1801657619559-S-1-E-1-1801657627111class.jpg'),
(19, 'SER1801657619559-S-1-E-2', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/series/thumbnail/EPImageSER1801657619559-S-1-E-2-5171657695028classep2.jpg', 'videos/series/thumbnail/EPImageSER1801657619559-S-1-E-2-5171657695028classep2.jpg'),
(20, 'SER1801657619559-S-1-E-3', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/series/thumbnail/EPImageSER1801657619559-S-1-E-3-7191657695069classEp3.jpg', 'videos/series/thumbnail/EPImageSER1801657619559-S-1-E-3-7191657695069classEp3.jpg'),
(21, 'SER1801657619559-S-1-E-4', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/series/thumbnail/EPImageSER1801657619559-S-1-E-4-7461657695290classep4.jpg', 'videos/series/thumbnail/EPImageSER1801657619559-S-1-E-4-7461657695290classep4.jpg'),
(22, 'SER1801657619559-S-2-E-1', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/series/thumbnail/EPImageSER1801657619559-S-2-E-1-711658209919season2.jpg', 'videos/series/thumbnail/EPImageSER1801657619559-S-2-E-1-711658209919season2.jpg'),
(23, 'SER1801657619559-S-2-E-2', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/series/thumbnail/EPImageSER1801657619559-S-2-E-2-5961658232683season2.jpg', 'videos/series/thumbnail/EPImageSER1801657619559-S-2-E-2-5961658232683season2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `episode_video_data`
--

CREATE TABLE `episode_video_data` (
  `id` int(11) NOT NULL,
  `episodeId` varchar(255) NOT NULL,
  `videoLink` varchar(255) NOT NULL,
  `keyName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `episode_video_data`
--

INSERT INTO `episode_video_data` (`id`, `episodeId`, `videoLink`, `keyName`) VALUES
(1, 'SER6721599564012-S-1-E-1', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/series/video/movSER2181598508805-S-1-E-1-6421598866205big-buck-bunny-360p.mp4', 'video/movSER2181598508805-S-1-E-1-6421598866205big-buck-bunny-360p.mp4'),
(2, 'SER6721599564012-S-1-E-2', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/series/video/movSER2181598508805-S-1-E-1-6421598866205big-buck-bunny-360p.mp4', 'video/movSER2181598508805-S-1-E-1-6421598866205big-buck-bunny-360p.mp4'),
(3, 'SER1441600768529-S-1-E-1', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos%2Fseries%2Fvideo%2FmovSER1441600768529-S-1-E-1-7431600770581SampleVideo_1280x720_1mb.mp4', 'videos/series/video/movSER1441600768529-S-1-E-1-7431600770581SampleVideo_1280x720_1mb.mp4'),
(37, 'SER6651600949676-S-1-E-1', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/series/video/SER6651600949676-S-1-E-1/SER6651600949676-S-1-E-1.m3u8', 'videos/series/video/SER6651600949676-S-1-E-1/SER6651600949676-S-1-E-1.m3u8'),
(38, 'SER6651600949676-S-1-E-2', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/series/video/SER6651600949676-S-1-E-2/SER6651600949676-S-1-E-2.m3u8', 'videos/series/video/SER6651600949676-S-1-E-2/SER6651600949676-S-1-E-2.m3u8'),
(39, 'SER6651600949676-S-1-E-3', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/series/video/SER6651600949676-S-1-E-3/SER6651600949676-S-1-E-3.m3u8', 'videos/series/video/SER6651600949676-S-1-E-3/SER6651600949676-S-1-E-3.m3u8'),
(40, 'SER6651600949676-S-2-E-1', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/series/video/SER6651600949676-S-2-E-1/SER6651600949676-S-2-E-1.m3u8', 'videos/series/video/SER6651600949676-S-2-E-1/SER6651600949676-S-2-E-1.m3u8'),
(41, 'SER6651600949676-S-2-E-2', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/series/video/SER6651600949676-S-2-E-2/SER6651600949676-S-2-E-2.m3u8', 'videos/series/video/SER6651600949676-S-2-E-2/SER6651600949676-S-2-E-2.m3u8'),
(42, 'SER6651600949676-S-2-E-3', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/series/video/SER6651600949676-S-2-E-3/SER6651600949676-S-2-E-3.m3u8', 'videos/series/video/SER6651600949676-S-2-E-3/SER6651600949676-S-2-E-3.m3u8'),
(43, 'SER2191600950092-S-1-E-1', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/series/video/SER2191600950092-S-1-E-1/SER2191600950092-S-1-E-1.m3u8', 'videos/series/video/SER2191600950092-S-1-E-1/SER2191600950092-S-1-E-1.m3u8'),
(44, 'SER2191600950092-S-1-E-2', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/series/video/SER2191600950092-S-1-E-2/SER2191600950092-S-1-E-2.m3u8', 'videos/series/video/SER2191600950092-S-1-E-2/SER2191600950092-S-1-E-2.m3u8'),
(45, 'SER2191600950092-S-1-E-3', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/series/video/SER2191600950092-S-1-E-3/SER2191600950092-S-1-E-3.m3u8', 'videos/series/video/SER2191600950092-S-1-E-3/SER2191600950092-S-1-E-3.m3u8'),
(46, 'SER2191657278281-S-1-E-2', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/series/video/SER2191657278281-S-1-E-2/SER2191657278281-S-1-E-2.m3u8', 'videos/series/video/SER2191657278281-S-1-E-2/SER2191657278281-S-1-E-2.m3u8'),
(47, 'SER2191657278281-S-1-E-1', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/series/video/SER2191657278281-S-1-E-1/SER2191657278281-S-1-E-1.m3u8', 'videos/series/video/SER2191657278281-S-1-E-1/SER2191657278281-S-1-E-1.m3u8'),
(48, 'SER5571657619531-S-1-E-1', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/series/video/SER5571657619531-S-1-E-1/SER5571657619531-S-1-E-1.m3u8', 'videos/series/video/SER5571657619531-S-1-E-1/SER5571657619531-S-1-E-1.m3u8'),
(49, 'SER5571657619531-S-1-E-2', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/series/video/SER5571657619531-S-1-E-2/SER5571657619531-S-1-E-2.m3u8', 'videos/series/video/SER5571657619531-S-1-E-2/SER5571657619531-S-1-E-2.m3u8'),
(50, 'SER5571657619531-S-1-E-3', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/series/video/SER5571657619531-S-1-E-3/SER5571657619531-S-1-E-3.m3u8', 'videos/series/video/SER5571657619531-S-1-E-3/SER5571657619531-S-1-E-3.m3u8'),
(51, 'SER1801657619559-S-1-E-1', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/series/video/SER1801657619559-S-1-E-1/SER1801657619559-S-1-E-1.m3u8', 'videos/series/video/SER1801657619559-S-1-E-1/SER1801657619559-S-1-E-1.m3u8'),
(52, 'SER1801657619559-S-1-E-2', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/series/video/SER1801657619559-S-1-E-2/SER1801657619559-S-1-E-2.m3u8', 'videos/series/video/SER1801657619559-S-1-E-2/SER1801657619559-S-1-E-2.m3u8'),
(53, 'SER1801657619559-S-1-E-3', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/series/video/SER1801657619559-S-1-E-3/SER1801657619559-S-1-E-3.m3u8', 'videos/series/video/SER1801657619559-S-1-E-3/SER1801657619559-S-1-E-3.m3u8'),
(54, 'SER1801657619559-S-1-E-4', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/series/video/SER1801657619559-S-1-E-4/SER1801657619559-S-1-E-4.m3u8', 'videos/series/video/SER1801657619559-S-1-E-4/SER1801657619559-S-1-E-4.m3u8'),
(55, 'SER1801657619559-S-2-E-1', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/series/video/SER1801657619559-S-2-E-1/SER1801657619559-S-2-E-1.m3u8', 'videos/series/video/SER1801657619559-S-2-E-1/SER1801657619559-S-2-E-1.m3u8'),
(56, 'SER1801657619559-S-2-E-2', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/series/video/SER1801657619559-S-2-E-2/SER1801657619559-S-2-E-2.m3u8', 'videos/series/video/SER1801657619559-S-2-E-2/SER1801657619559-S-2-E-2.m3u8');

-- --------------------------------------------------------

--
-- Table structure for table `favourite`
--

CREATE TABLE `favourite` (
  `id` int(11) NOT NULL,
  `userId` varchar(30) NOT NULL,
  `type` enum('Movie','Series') NOT NULL,
  `serMovId` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `favourite`
--

INSERT INTO `favourite` (`id`, `userId`, `type`, `serMovId`, `created`) VALUES
(3, 'OTT8631540', 'Movie', 'MOV1001599635493', '2020-09-23 11:55:52'),
(4, 'OTT8631540', 'Movie', 'MOV9841599635605', '2020-09-23 11:56:28'),
(99, 'OTT8631540', 'Series', 'SER6721599564012', '2020-09-24 14:23:39'),
(110, 'OTT3441378', 'Series', 'SER2191600950092', '2020-09-25 10:58:49'),
(115, 'OTT3441378', 'Series', 'SER6651600949676', '2020-09-25 11:14:19'),
(125, 'OTT3441378', 'Movie', 'MOV6671600945215', '2020-09-25 11:54:38'),
(148, 'OTT4290685', 'Movie', 'MOV1591599725157', '2020-09-25 16:39:26'),
(151, 'OTT9596111', 'Series', 'SER6721599564012', '2020-09-25 16:50:42'),
(155, 'OTT9596111', 'Series', 'SER6651600949676', '2020-09-25 18:10:58'),
(156, 'OTT9596111', 'Series', 'SER2191600950092', '2020-09-25 18:12:36'),
(158, 'OTT3441378', 'Movie', 'MOV2461600946435', '2020-09-25 18:36:47'),
(160, 'OTT3441378', 'Movie', 'MOV9841599635605', '2020-09-25 19:11:41'),
(161, 'OTT4290685', 'Series', 'SER6651600949676', '2020-09-25 20:54:06'),
(162, 'OTT4290685', 'Series', 'SER2191600950092', '2020-09-25 20:54:09'),
(163, 'OTT4290685', 'Series', 'SER1441600768529', '2020-09-25 20:54:12'),
(164, 'OTT9910634', 'Movie', 'MOV6671600945215', '2020-09-25 21:00:16'),
(165, 'OTT9910634', 'Movie', 'MOV9981600927962', '2020-09-25 21:00:19'),
(166, 'OTT9910634', 'Movie', 'MOV2461600946435', '2020-09-25 21:00:22'),
(167, 'OTT9021646', 'Series', 'SER6651600949676', '2020-09-25 22:28:46'),
(170, 'OTT9596111', 'Movie', 'MOV7461599545737', '2020-09-25 23:21:35'),
(171, 'OTT9021646', 'Movie', 'MOV9981600927962', '2020-09-25 23:32:51'),
(172, 'OTT9021646', 'Series', 'SER1441600768529', '2020-09-25 23:32:58'),
(173, 'OTT7368346', 'Movie', 'MOV6671600945215', '2020-09-26 10:25:37'),
(174, 'OTT7368346', 'Movie', 'MOV1001599635493', '2020-09-26 10:56:09'),
(180, 'OTT7368346', 'Movie', 'MOV7461599545737', '2020-09-26 11:10:53'),
(181, 'OTT7368346', 'Movie', 'MOV9841599635605', '2020-09-26 11:33:01'),
(185, 'OTT8172954', 'Movie', 'MOV9981600927962', '2020-09-27 11:44:31'),
(186, 'OTT9615479', 'Movie', 'MOV1001599635493', '2020-09-28 09:47:20'),
(188, 'OTT7788619', 'Movie', 'MOV9981600927962', '2020-09-28 11:30:21'),
(191, 'OTT7788619', 'Series', 'SER6651600949676', '2020-09-28 14:20:00'),
(192, 'OTT8005602', 'Movie', 'MOV7461599545737', '2020-09-28 17:51:59'),
(193, 'OTT8005602', 'Movie', 'MOV2461600946435', '2020-09-28 17:52:48'),
(194, 'OTT8005602', 'Series', 'SER2191600950092', '2020-09-28 17:53:23'),
(196, 'OTT8005602', 'Series', 'SER1441600768529', '2020-09-28 17:55:21'),
(197, 'OTT8005602', 'Series', 'SER6721599564012', '2020-09-28 17:55:24'),
(198, 'OTT8005602', 'Movie', 'MOV9841599635605', '2020-09-28 17:55:28'),
(199, 'OTT8005602', 'Movie', 'MOV9981600927962', '2020-09-28 17:55:56'),
(200, 'OTT8005602', 'Series', 'SER6651600949676', '2020-09-28 17:56:04'),
(201, 'OTT4290685', 'Movie', 'MOV6671600945215', '2020-09-28 17:58:44'),
(202, 'OTT8216628', 'Movie', 'MOV9981600927962', '2020-09-28 18:34:49'),
(203, 'OTT8216628', 'Movie', 'MOV9841599635605', '2020-09-28 18:34:55'),
(204, 'OTT8216628', 'Movie', 'MOV9011600839513', '2020-09-28 18:34:59'),
(205, 'OTT7788619', 'Movie', 'MOV2461600946435', '2020-09-28 18:52:59'),
(206, 'OTT7788619', 'Series', 'SER6721599564012', '2020-09-28 18:53:33'),
(207, 'OTT8799827', 'Movie', 'MOV6671600945215', '2020-09-28 19:53:09'),
(208, 'OTT8216628', 'Movie', 'MOV1591599725157', '2020-09-28 20:07:35'),
(209, 'OTT9699113', 'Movie', 'MOV2461600946435', '2020-09-28 20:22:38'),
(211, 'OTT7183327', 'Movie', 'MOV1001599635493', '2020-09-29 09:25:28'),
(212, 'OTT4911652', 'Movie', 'MOV1001599635493', '2020-09-29 09:29:37'),
(215, 'OTT3074395', 'Movie', 'MOV7461599545737', '2020-09-29 10:51:15'),
(217, 'OTT9699113', 'Movie', 'MOV6671600945215', '2020-09-29 10:56:01'),
(219, 'OTT185534', 'Movie', 'MOV7461599545737', '2020-09-29 11:02:37'),
(230, 'OTT2376117', 'Series', 'SER6721599564012', '2020-09-29 11:22:47'),
(232, 'OTT4879591', 'Series', 'SER6651600949676', '2020-09-29 13:02:08'),
(233, 'OTT4879591', 'Series', 'SER1441600768529', '2020-09-29 13:02:12'),
(234, 'OTT4879591', 'Movie', 'MOV9841599635605', '2020-09-29 13:02:25'),
(235, 'OTT4879591', 'Movie', 'MOV7461599545737', '2020-09-29 13:02:29'),
(236, 'OTT9699113', 'Movie', 'MOV9841599635605', '2020-09-29 13:02:47'),
(238, 'OTT9699113', 'Series', 'SER6651600949676', '2020-09-29 13:06:49'),
(240, 'OTT2167925', 'Movie', 'MOV9841599635605', '2020-09-29 14:33:40'),
(241, 'OTT9632661', 'Movie', 'MOV9841599635605', '2020-09-29 14:53:29'),
(242, 'OTT9632661', 'Series', 'SER6721599564012', '2020-09-29 14:59:26'),
(244, 'OTT1244731', 'Movie', 'MOV7461599545737', '2020-09-29 16:06:24'),
(245, 'OTT1244731', 'Movie', 'MOV9981600927962', '2020-09-29 16:09:47'),
(248, 'OTT7000630', 'Movie', 'MOV9841599635605', '2020-09-29 16:48:47'),
(249, 'OTT1244731', 'Movie', 'MOV6281599635549', '2020-09-29 17:03:07'),
(250, 'OTT4911652', 'Movie', 'MOV7461599545737', '2020-09-30 14:32:45'),
(255, 'OTT2376117', 'Movie', 'MOV6671600945215', '2020-09-30 16:42:13'),
(258, 'OTT1244731', 'Movie', 'MOV9841599635605', '2020-09-30 17:37:24'),
(259, 'OTT1244731', 'Movie', 'MOV2461600946435', '2020-09-30 17:37:46'),
(262, 'OTT1540281', 'Movie', 'MOV7461599545737', '2020-10-01 09:54:04'),
(264, 'OTT1244731', 'Movie', 'MOV6671600945215', '2020-10-02 12:07:54'),
(266, 'OTT2376117', 'Movie', 'MOV1591599725157', '2020-10-02 12:27:56'),
(267, 'OTT5586424', 'Movie', 'MOV6671600945215', '2020-10-05 08:41:29'),
(268, 'OTT2376117', 'Series', 'SER1441600768529', '2020-10-05 12:56:45'),
(269, 'OTT5446687', 'Movie', 'MOV7461599545737', '2020-10-05 18:38:19'),
(277, 'OTT2376117', 'Movie', 'MOV9841599635605', '2020-10-07 17:51:07'),
(278, 'OTT2376117', 'Series', 'SER2191600950092', '2020-10-07 17:51:43'),
(286, 'OTT428085', 'Movie', 'MOV1001599635493', '2020-10-07 19:00:10'),
(289, 'OTT428085', 'Movie', 'MOV9981600927962', '2020-10-07 19:49:45'),
(290, 'OTT2095792', 'Series', 'SER6651600949676', '2020-10-07 20:56:18'),
(291, 'OTT7266159', 'Movie', 'MOV7461599545737', '2020-10-08 11:25:09'),
(293, 'OTT2376117', 'Movie', 'MOV7461599545737', '2020-11-03 15:21:30'),
(295, 'OTT2376117', 'Series', 'SER6651600949676', '2020-11-03 15:43:44'),
(296, 'OTT2417225', 'Movie', 'MOV7461599545737', '2022-06-30 07:05:14'),
(299, 'OTT8508879', 'Movie', 'MOV7461599545737', '2022-07-04 05:13:51'),
(300, 'OTT8508879', 'Movie', 'MOV1001599635493', '2022-07-04 09:41:01'),
(301, 'OTT8508879', 'Movie', 'MOV9841599635605', '2022-07-04 09:45:26'),
(304, 'OTT8508879', 'Movie', 'MOV6361657024182', '2022-07-05 12:59:51'),
(305, 'OTT6003498', 'Movie', 'MOV2521657024925', '2022-07-05 13:00:07'),
(306, 'OTT8508879', 'Movie', 'MOV3921657023233', '2022-07-05 13:26:21'),
(307, 'OTT8508879', 'Movie', 'MOV4331657081848', '2022-07-06 05:46:00'),
(308, 'OTT8508879', 'Movie', 'MOV7141657012157', '2022-07-06 05:53:00'),
(309, 'OTT6003498', 'Movie', 'MOV3271657021342', '2022-07-06 06:07:13'),
(310, 'OTT6003498', 'Movie', 'MOV3231657025794', '2022-07-07 05:40:05'),
(311, 'OTT875628', 'Movie', 'MOV61657082257', '2022-07-07 11:04:38'),
(312, 'OTT6003498', 'Movie', 'MOV2231657089332', '2022-07-08 05:33:15'),
(313, 'OTT819631', 'Movie', 'MOV1001599635493', '2022-07-08 08:43:31'),
(314, 'OTT3159464', 'Movie', 'MOV9891657084090', '2022-07-08 10:37:45'),
(316, 'OTT9171959', 'Movie', 'MOV7461599545737', '2022-07-13 07:46:25'),
(318, 'OTT9171959', 'Movie', 'MOV2231657089332', '2022-07-13 07:48:42'),
(319, 'OTT9171959', 'Movie', 'MOV1001599635493', '2022-07-13 07:49:44'),
(320, 'OTT956934', 'Movie', 'MOV1001599635493', '2022-07-13 08:05:54'),
(321, 'OTT1147407', 'Movie', 'MOV9891657084090', '2022-07-13 08:09:12'),
(322, 'OTT9171959', 'Movie', 'MOV4331657081848', '2022-07-13 08:10:48'),
(325, 'OTT1967602', 'Movie', 'MOV1001599635493', '2022-07-14 13:03:32'),
(328, 'OTT1967602', 'Movie', 'MOV2011657084904', '2022-07-14 16:45:18'),
(331, 'OTT8680898', 'Movie', 'MOV2011657084904', '2022-07-15 04:25:28'),
(333, 'OTT3012474', 'Movie', 'MOV2011657084904', '2022-07-15 04:59:07'),
(334, 'OTT3012474', 'Movie', 'MOV61657082257', '2022-07-15 05:13:13'),
(335, 'OTT9085128', 'Movie', 'MOV2011657084904', '2022-07-15 05:29:00'),
(336, 'OTT3012474', 'Movie', 'MOV2521657024925', '2022-07-15 05:30:58'),
(337, 'OTT3472234', 'Movie', 'MOV2011657084904', '2022-07-15 07:11:48'),
(338, 'OTT9085128', 'Movie', 'MOV7461599545737', '2022-07-15 10:48:20'),
(339, 'OTT3472234', 'Movie', 'MOV1001599635493', '2022-07-15 10:49:27'),
(340, 'OTT6535384', 'Movie', 'MOV61657082257', '2022-07-19 05:04:47'),
(341, 'OTT133037', 'Movie', 'MOV2231657089332', '2022-07-19 13:07:05'),
(342, 'OTT1565320', 'Movie', 'MOV2011657084904', '2022-07-20 03:48:10'),
(350, 'OTT3276224', 'Movie', 'MOV9891657084090', '2022-07-20 08:12:56'),
(351, 'OTT3276224', 'Movie', 'MOV2011657084904', '2022-07-20 08:14:07'),
(354, 'OTT3067348', 'Movie', 'MOV1001599635493', '2022-07-20 14:07:11'),
(355, 'OTT8137783', 'Movie', 'MOV2011657084904', '2022-07-21 03:36:20'),
(359, 'OTT3276224', 'Movie', 'MOV8741657027964', '2022-07-21 06:19:53'),
(360, 'OTT3276224', 'Movie', 'MOV2231657089332', '2022-07-21 06:19:59'),
(361, 'OTT3276224', 'Movie', 'MOV4331657081848', '2022-07-21 06:20:28'),
(362, 'OTT6535384', 'Movie', 'MOV7461599545737', '2022-07-21 11:45:57'),
(363, 'OTT1669325', 'Movie', 'MOV801657015383', '2022-07-21 12:05:58'),
(364, 'OTT1669325', 'Movie', 'MOV1001599635493', '2022-07-21 12:06:02'),
(365, 'OTT1669325', 'Movie', 'MOV6191657014755', '2022-07-21 12:06:05'),
(366, 'OTT1669325', 'Movie', 'MOV2521657024925', '2022-07-21 12:07:44'),
(367, 'OTT1669325', 'Movie', 'MOV4331657081848', '2022-07-21 12:08:52'),
(368, 'OTT6203437', 'Movie', 'MOV61657082257', '2022-07-21 12:17:23'),
(371, 'OTT3276224', 'Movie', 'MOV7461599545737', '2022-07-22 06:05:49'),
(376, 'OTT3623656', 'Movie', 'MOV1001599635493', '2022-07-22 12:34:40'),
(378, 'OTT1565320', 'Movie', 'MOV7461599545737', '2022-07-23 04:33:50'),
(379, 'OTT3623656', 'Series', 'SER1801657619559', '2022-07-25 04:42:37'),
(380, 'OTT3623656', 'Movie', 'MOV7461599545737', '2022-07-25 06:02:23'),
(381, 'OTT3623656', 'Movie', 'MOV2231657089332', '2022-07-25 06:03:23');

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `addedOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `name`, `addedOn`) VALUES
(1, 'Hindi', '2020-08-25 10:46:52'),
(2, 'English', '2020-08-25 10:46:52');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `movieId` varchar(200) DEFAULT NULL,
  `movieName` varchar(255) NOT NULL,
  `movieShortDescription` text,
  `movieLongDescription` text,
  `movieCategory` int(11) NOT NULL,
  `movieType` enum('free','paid') NOT NULL DEFAULT 'free',
  `cast` varchar(255) DEFAULT NULL,
  `director` varchar(255) DEFAULT NULL,
  `totalViews` int(11) NOT NULL DEFAULT '0',
  `trailer` tinyint(1) NOT NULL DEFAULT '0',
  `video` tinyint(1) NOT NULL DEFAULT '0',
  `subtitles` enum('yes','no') NOT NULL DEFAULT 'no',
  `thumbnailImage` tinyint(1) NOT NULL DEFAULT '0',
  `bannerImage` tinyint(1) NOT NULL DEFAULT '0',
  `audioFile` enum('yes','no') NOT NULL DEFAULT 'no',
  `addedOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `releaseDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `movieId`, `movieName`, `movieShortDescription`, `movieLongDescription`, `movieCategory`, `movieType`, `cast`, `director`, `totalViews`, `trailer`, `video`, `subtitles`, `thumbnailImage`, `bannerImage`, `audioFile`, `addedOn`, `releaseDate`) VALUES
(1, 'MOV7461599545737', 'Sintel', 'Catroon Animated Movie ', 'the durian open movie project', 2, 'free', 'Leonardo Di Caprio, Kate Winslet', 'James Cameroon', 0, 0, 0, 'no', 1, 1, 'no', '2020-09-08 11:45:37', '2022-07-08 15:45:00'),
(2, 'MOV1001599635493', 'Big Buck Bunny', 'The story takes place in a dystopian post-apocalyptic future', 'The story takes place in a dystopian post-apocalyptic future in the nation of Panem, where a boy and a girl from each of the nation\'s 12 Districts are chosen annually as \"tributes\" and forced to compete in The Hunger Games, an elaborate televised fight to', 2, 'free', 'NA', 'NA', 0, 0, 0, 'no', 1, 1, 'no', '2020-09-09 07:11:33', '2020-09-24 15:45:00'),
(3, 'MOV6281599635549', '3 idiots', '3 Idiots is a 2009 Indian Hindi-language coming-of-age', ' The film follows the friendship of three students at an Indian engineering college and is a satire about the social pressures under an Indian education system.', 4, 'free', NULL, NULL, 0, 1, 0, 'no', 1, 1, 'no', '2020-09-09 07:12:29', '2020-08-31 12:42:00'),
(5, 'MOV1591599725157', 'Fluffy', 'He was so funny', 'Gabriel \"Fluffy\" Iglesias\' style of comedy is a mixture of story telling with characters and sound effects that bring all his personal issues to life.', 4, 'free', NULL, NULL, 0, 1, 1, 'no', 0, 0, 'no', '2020-09-10 08:05:57', '2019-01-01 13:35:00'),
(17, 'MOV7621656998114', 'Mughal-E-Azam', 'A 16th century prince falls in love with a court dancer and battles with his emperor father.', 'A 16th century prince falls in love with a court dancer and battles with his emperor father.\r\n\r\n', 1, 'paid', 'Prithviraj Kapoor, Madhubala,Dilip Kumar ', 'K. Asif', 0, 1, 0, 'no', 0, 0, 'no', '2022-07-05 05:15:14', '2022-07-05 05:15:14'),
(18, 'MOV5831657005113', 'Cubicles - EP 01 ', '#TheViralFever #Cubicles #TVFOriginal', 'Piyush is super excited for his first day at Synnotech Technologies. He believes that in order to ensure that this new chapter in his life is a memorable one, it is imperative to have a great first day. However, he finds out that it might not be in his control! \r\n\r\nOwned, operated and managed by, Contagious Online Media Network Private Limited.\r\n\r\n#TheViralFever #Cubicles #TVFOriginal', 9, 'free', 'Abhishek Chauhan \r\nArnav Bhasin\r\nNidhi Bisht\r\nBadri Chavan\r\nNiketan Sharma', 'Riz Nasim', 0, 1, 1, 'no', 1, 1, 'no', '2022-07-05 07:11:53', '2019-12-10 12:41:00'),
(19, 'MOV5841657006906', 'Cubicles - EP 02', '#EP 02 #TheViralFever #Cubicles #TVFOriginal', 'The memory of what you did with your first official salary is something most, if not all, remember. Piyush explains it to Kalpesh, it’s like losing your financial virginity so it has to be special. He has his eyes set on a special treat for himself. However, the best-laid plans often go awry. \r\n\r\nOwned, operated and managed by, Contagious Online Media Network Private Limited.\r\n\r\n#TheViralFever #Cubicles #TVFOriginals', 9, 'free', 'Abhishek Chauhan, Arnav Bhasin, Nidhi Bisht, Badri Chavan, Niketan Sharma', 'Riz Nasim', 0, 1, 1, 'no', 1, 1, 'no', '2022-07-05 07:41:46', '2019-12-10 13:11:00'),
(20, 'MOV7141657012157', 'Cubicles - EP 03', '#EP 03 #TheViralFever #Cubicles #TVFOriginal', 'Nowadays, people may forget their own birthdays and anniversaries but a long weekend is something everyone has marked on their calendars right at the start of the year! Some have preset plans while others try to desperately figure something out at the last minute. Look at how Piyush plans for his perfect long weekend and what he actually ends up doing. \r\n\r\nOwned, operated and managed by, Contagious Online Media Network Private Limited.\r\n\r\n#TheViralFever #Cubicles #TVFOriginals', 9, 'free', 'Abhishek Chauhan, Arnav Bhasin, Nidhi Bisht, Badri Chavan, Niketan Sharma', 'Riz Nasim', 0, 0, 1, 'no', 1, 1, 'no', '2022-07-05 09:09:17', '2019-12-10 14:38:00'),
(21, 'MOV2551657012928', 'Cubicles - EP 04', '#EP 04 #TheViralFever #Cubicles #TVFOriginal', 'In offices, resources from teams are often exchanged on a temporary basis depending on project requirements. In one such transfer, Piyush is made to join a team on a different floor for a month. Will he get along with his new colleagues? Watch the episode to find out what happens. \r\n\r\nOwned, operated and managed by, Contagious Online Media Network Private Limited.\r\n\r\n#TheViralFever #Cubicles #TVFOriginal', 9, 'free', 'Abhishek Chauhan, Arnav Bhasin, Nidhi Bisht, Badri Chavan, Niketan Sharma', 'Riz Nasim', 0, 0, 1, 'no', 1, 1, 'no', '2022-07-05 09:22:08', '2019-12-10 14:51:00'),
(22, 'MOV6191657014755', 'Ouch | Manoj Bajpayee', 'Royal Stag Barrel Select Large Short Films', 'Watch Neeraj Pandey\'s perfect take on an extra marital affair gone all wrong. Presented by Royal Stag Barrel Select Large Short Films.', 3, 'free', 'Manoj Bajpayee, Pooja Chopra ', 'Neeraj Pandey\'s', 0, 0, 1, 'no', 1, 1, 'no', '2022-07-05 09:52:35', '2016-10-23 15:22:00'),
(23, 'MOV801657015383', 'Solomates | Short Film', 'Romantic Travel Short film 2022 | Strangers Love Story', 'Four Solo Travellers from different background meet in Manali and they go on a journey in which they got to know a lot about their life.\r\n.\r\nFilm Quote- Solomates before soulmates.\r\n.\r\nWatch this short film till the end!', 3, 'free', 'Pawan Shharma, Vivan Bhatena, Hina Khan, Madhurima Roy', 'Manya Gadhok', 0, 0, 1, 'no', 1, 1, 'no', '2022-07-05 10:03:03', '2020-07-01 15:32:00'),
(24, 'MOV3271657021342', 'Feeki Shakkar', ' Award Winning Hindi Short Film', 'This short film on Husband wife relationship is about the silent sacrifices made by married couple. Wife tries her best to cook food and beverages the way husband likes it but still he complains everyday about the morning tea. Life was going monotonous until one day the wife plans a random date in a restaurant and story takes an emotional twist.. This romantic love story features Honey Sharma, Sonal Gaur Tiwari. This husband wife short film is directed by Abhishek Sharma and written by Priyanka Bansal. This Hindi short movie was awarded at Rajasthan International Film Festival.\r\n#husbandwife ', 3, 'free', 'Feeki Shakkar', 'Manya Gadhok', 0, 0, 1, 'no', 1, 1, 'no', '2022-07-05 11:42:22', '2020-02-01 17:12:00'),
(25, 'MOV461657022413', 'EK VILLAIN RETURNS', 'Presenting Official Trailer of the movie, EK VILLAIN RETURNS starring JOHN ABRAHAM, DISHA PATANI, ARJUN KAPOOR, TARA SUTARIA', 'Presenting Official Trailer of the movie, EK VILLAIN RETURNS starring JOHN ABRAHAM, DISHA PATANI, ARJUN KAPOOR, TARA SUTARIA \r\n\r\nGULSHAN KUMAR, T-SERIES & BALAJI TELEFILMS PRESENT\r\nA BALAJI TELEFILMS LTD PRODUCTION\r\nEK VILLAIN RETURNS', 7, 'free', ' JOHN, DISHA, ARJUN, TARA, MOHIT SURI', 'Mohit Suri', 0, 0, 1, 'no', 1, 1, 'no', '2022-07-05 12:00:13', '2022-07-01 17:30:00'),
(27, 'MOV3921657023233', 'Janhit Mein Jaari (Official Trailer)', ' A Zee Studios Release', 'A social-comedy-drama ‘Janhit Mein Jaari’ headlined by Nushrratt Bharuccha promises to tickle your funny bones and open your mind to possibilities. Narrated in a humorous way, the film encompasses the journey of a young girl who sells condoms for a living despite societal resistance. Its the story of a girl who juggles working towards the betterment of women, telling people the importance of using protection while handling the resistance of her family and in-laws towards her job.\r\n\r\nVinod Bhanushali presents Raaj Shaandilyaa’s ‘JANHIT MEIN JAARI’, a Bhanushali Studios Limited presentation of a Thinkink Picturez production in association with Shree Raghav Entertainment LLP, directed by Jai Basantu Singh,', 8, 'free', 'Nushrratt Bharuccha, Anud Singh, Raaj S ', 'Jai Basantu Singh', 0, 0, 1, 'no', 1, 1, 'no', '2022-07-05 12:13:53', '2022-06-10 17:43:00'),
(28, 'MOV6361657024182', 'Slumdog Millionaire', 'Directed By: Danny Boyle, Loveleen Tandan', 'Starring: Dev Patel, Freida Pinto, Saurabh Shukla\r\nDirected By: Danny Boyle, Loveleen Tandan\r\nSynopsis: A Mumbai teen reflects on his upbringing in the slums when he is accused of cheating on the Indian Version of \"Who Wants to be a Millionaire?\"', 5, 'free', 'Irrfan Khan, Dev patel', 'Danny Boyle', 0, 0, 1, 'no', 1, 1, 'no', '2022-07-05 12:29:42', '2009-01-23 17:59:00'),
(29, 'MOV4961657024521', 'BRAHMĀSTRA OFFICIAL TRAILER', 'Hindi | Amitabh | Ranbir | Alia | Ayan | In Cinemas 9th September', 'Presenting the official Trailer of Brahmāstra. Get ready to experience a new world of Ancient Indian Astras and the magic of this extraordinary journey.\r\n\r\nBrahmāstra Part One: Shiva. In cinemas. September 9th', 6, 'free', 'Amitabh Bacchan, Ranbir kapoor, Alia bhatt, Ayan', 'Ayan Mukerji', 0, 0, 0, 'no', 1, 1, 'no', '2022-07-05 12:35:21', '2022-09-09 18:05:00'),
(30, 'MOV2521657024925', 'RRR Official Trailer (Hindi)', ' India’s Biggest Action Drama', 'From Indian Filmmaker SS Rajamouli (Director of Baahubali) comes India’s Biggest Action Drama #RRRMovie, in theatres 25th March, 2022.\r\n\r\nRRR Official Trailer (Hindi) India’s Biggest Action Drama | NTR, Ram Charan, Ajay Devgn, Alia Bhatt | SS Rajamouli', 6, 'free', 'Ram Charan, NT Rama, Ajay Devgan, alia bhatt', 'S. S. Rajamouli', 0, 0, 1, 'no', 1, 1, 'no', '2022-07-05 12:42:05', '2022-03-24 18:11:00'),
(31, 'MOV3231657025794', 'Kitni Haseen Hogi', 'Presenting the song, \"Kitni Haseen Hogi\" from the ', 'Presenting the song, \"Kitni Haseen Hogi\" from the movie, \"HIT - The First Case\" starring Rajkummar Rao & Sanya Malhotra\r\n\r\nGULSHAN KUMAR & T-SERIES PRESENT\r\nIN ASSOCIATION WITH \'DIL\' RAJU PRODUCTIONS\r\nA T-SERIES FILMS & DIL RAJU PRODUCTIONS', 7, 'free', ' Rajkummar, Sanya', 'Sailesh Kolanu', 0, 0, 1, 'no', 1, 1, 'no', '2022-07-05 12:56:34', '2022-07-01 18:25:00'),
(32, 'MOV8741657027964', 'Vikrant Rona', 'Rules of the maze, look at everything closely, more than once  Presenting the official Hindi trailer of the movie, Vikrant Rona. Starring Kichcha Sudeep, Jacqueline Fernandez, Nirup Bhandari and Neetha Ashok. Written and Directed by Anup Bhandari. ', 'Rules of the maze, look at everything closely, more than once\r\n\r\nPresenting the official Hindi trailer of the movie, Vikrant Rona. Starring Kichcha Sudeep, Jacqueline Fernandez, Nirup Bhandari and Neetha Ashok. Written and Directed by Anup Bhandari. \r\n\r\nMovie Credits: \r\n\r\nStarring: Kichcha Sudeep, Nirup Bhandari, Neetha Ashok and Jacqueline Fernandez\r\nWritten & Directed By: Anup Bhandari\r\nProduced By: Jack Manjunath, Shalini Manjunath \r\nCo-produced by: Alankar Pandian (Invenio Films)', 6, 'free', ' Kichcha Sudeep, Nirup Bhandari, Neetha Ashok and Jacqueline Fernandez', 'Anup Bhandari', 0, 0, 1, 'no', 1, 1, 'no', '2022-07-05 13:32:44', '2022-06-04 19:02:00'),
(33, 'MOV4331657081848', 'Badhaai Do Official Trailer', 'Co-actors: Seema Pahwa, Sheeba Chaddha, Lovleen Mishra, Nitesh Pandey, Shashi Bhushan, Chum Darang and Deepak Arora ', 'Releasing In Theatres: 11th Feb\r\n \r\nPresented by: Junglee Pictures\r\nDirected by: Harshavardhan Kulkarni\r\nProduced by: Vineet Jain\r\nCo-Producer: Amrita Pandey\r\nStory: Akshat Ghildial and Suman Adhikary \r\nScreenplay: Akshat Ghildial, Suman Adhikary & Harshavardhan Kulkarni\r\nDialogue: Akshat Ghildial', 8, 'free', 'Seema Pahwa, Sheeba Chaddha, Lovleen Mishra', 'Harshavardhan Kulkarni', 0, 0, 1, 'no', 1, 1, 'no', '2022-07-06 04:30:48', '2022-02-11 10:00:00'),
(34, 'MOV61657082257', 'OM | Trailer', '#OM: The Battle Within releasing on 1st July 2022', 'Ek ladai ko jeetne ke liye usse kai baar ladna padta hai, rakth rahe ya na rahe rashtra humesha rahega! \r\n#OMTrailer out now.', 6, 'free', ' Aditya Roy Kapur, Sanjana Sanghi, Jackie Shroff, Kapil Verma, Ahmed K', ' KAPIL VERMA', 0, 0, 1, 'no', 1, 1, 'no', '2022-07-06 04:37:37', '2022-07-01 10:07:00'),
(35, 'MOV9891657084090', 'Natsamrat', 'Movie : Natsamrat - Asa Nat Hone Nahi', 'Presenting to you the official trailer of the most awaited film \"Natsamrat - Asa Nat Hone Nahi\" (2016). Nana Patekar Plays a lead role in the movie. Directed by Mahesh Manjarekar. ', 5, 'free', 'Nana Patekar, Vikaram Gokhale, Medha Manjarekar', 'Mahesh Manjarekar', 0, 0, 1, 'no', 1, 1, 'no', '2022-07-06 05:08:10', '2016-01-01 10:38:00'),
(36, 'MOV2011657084904', 'Lagaan', 'After 19 years, here is the trailer of the epic movie Lagaan. #19YearsOfLagaan', 'Lagaan (Agricultural Tax), released internationally as Lagaan: Once Upon a Time in India, is a 2001 Indian Hindi-language epic sports drama film written & directed by Ashutosh Gowariker, produced by Aamir Khan. Aamir Khan stars along with debutant Gracy Singh, with British actors Rachel Shelley and Paul Blackthorne playing supporting roles. The film was shot in villages near Bhuj.', 5, 'free', ' Aamir Khan', 'Ashutosh Gowariker', 0, 0, 1, 'no', 1, 1, 'no', '2022-07-06 05:21:44', '2001-06-15 10:51:00'),
(37, 'MOV2231657089332', 'Pip | A Short Animated Film', 'Dog’s heroics will make you cry! ', 'Dog’s heroics will make you cry! Donate at https://www.guidedogs.org/pip\r\nClick here for the audio description for the visually impaired: https://youtu.be/KqANNQDgkAc\r\n\r\n“Pip” animated short film presented by Southeastern Guide Dogs -- A heartwarming tale for underdogs everywhere, Pip is the story of a small dog with a big dream—to become a Southeastern Guide Dog. Does she have what it takes?', 2, 'free', 'Dog’s', ' Southeastern', 0, 0, 1, 'no', 1, 1, 'no', '2022-07-06 06:35:32', '2020-01-01 12:05:00');

-- --------------------------------------------------------

--
-- Table structure for table `movies_slider`
--

CREATE TABLE `movies_slider` (
  `id` int(11) NOT NULL,
  `movieId` varchar(255) NOT NULL,
  `sequence` int(11) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `movies_slider`
--

INSERT INTO `movies_slider` (`id`, `movieId`, `sequence`, `created`) VALUES
(1, 'MOV61657082257', 1, '2022-07-08 06:07:09'),
(2, 'MOV2231657089332', 2, '2022-07-08 06:07:09'),
(3, 'MOV461657022413', 3, '2022-07-08 06:07:09'),
(4, 'MOV2521657024925', 4, '2022-07-08 06:07:09');

-- --------------------------------------------------------

--
-- Table structure for table `movie_audio_files`
--

CREATE TABLE `movie_audio_files` (
  `id` int(11) NOT NULL,
  `movieId` varchar(255) NOT NULL,
  `language` int(11) NOT NULL,
  `audioFileLink` varchar(255) DEFAULT NULL,
  `keyName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `movie_audio_files`
--

INSERT INTO `movie_audio_files` (`id`, `movieId`, `language`, `audioFileLink`, `keyName`) VALUES
(1, 'MOV7461599545737', 1, NULL, NULL),
(2, 'MOV7461599545737', 2, NULL, NULL),
(3, 'MOV1001599635493', 1, NULL, NULL),
(4, 'MOV1001599635493', 2, NULL, NULL),
(5, 'MOV6281599635549', 1, NULL, NULL),
(6, 'MOV6281599635549', 2, NULL, NULL),
(7, 'MOV9841599635605', 1, NULL, NULL),
(8, 'MOV9841599635605', 2, NULL, NULL),
(9, 'MOV1591599725157', 1, NULL, NULL),
(10, 'MOV1591599725157', 2, NULL, NULL),
(17, 'MOV6671600945215', 1, NULL, NULL),
(18, 'MOV6671600945215', 2, NULL, NULL),
(21, 'MOV61600957877', 1, NULL, NULL),
(22, 'MOV61600957877', 2, NULL, NULL),
(23, 'MOV6741600958206', 1, NULL, NULL),
(24, 'MOV6741600958206', 2, NULL, NULL),
(27, 'MOV5061656941484', 1, NULL, NULL),
(28, 'MOV5061656941484', 2, NULL, NULL),
(29, 'MOV8001656994845', 1, NULL, NULL),
(30, 'MOV8001656994845', 2, NULL, NULL),
(31, 'MOV2111656996604', 1, NULL, NULL),
(32, 'MOV2111656996604', 2, NULL, NULL),
(33, 'MOV7621656998114', 1, NULL, NULL),
(34, 'MOV7621656998114', 2, NULL, NULL),
(35, 'MOV5831657005113', 1, NULL, NULL),
(36, 'MOV5831657005113', 2, NULL, NULL),
(37, 'MOV5841657006906', 1, NULL, NULL),
(38, 'MOV5841657006906', 2, NULL, NULL),
(39, 'MOV7141657012157', 1, NULL, NULL),
(40, 'MOV7141657012157', 2, NULL, NULL),
(41, 'MOV2551657012928', 1, NULL, NULL),
(42, 'MOV2551657012928', 2, NULL, NULL),
(43, 'MOV6191657014755', 1, NULL, NULL),
(44, 'MOV6191657014755', 2, NULL, NULL),
(45, 'MOV801657015383', 1, NULL, NULL),
(46, 'MOV801657015383', 2, NULL, NULL),
(47, 'MOV3271657021342', 1, NULL, NULL),
(48, 'MOV3271657021342', 2, NULL, NULL),
(49, 'MOV461657022413', 1, NULL, NULL),
(50, 'MOV461657022413', 2, NULL, NULL),
(51, 'MOV8611657022773', 1, NULL, NULL),
(52, 'MOV8611657022773', 2, NULL, NULL),
(53, 'MOV3921657023233', 1, NULL, NULL),
(54, 'MOV3921657023233', 2, NULL, NULL),
(55, 'MOV6361657024182', 1, NULL, NULL),
(56, 'MOV6361657024182', 2, NULL, NULL),
(57, 'MOV4961657024521', 1, NULL, NULL),
(58, 'MOV4961657024521', 2, NULL, NULL),
(59, 'MOV2521657024925', 1, NULL, NULL),
(60, 'MOV2521657024925', 2, NULL, NULL),
(61, 'MOV3231657025794', 1, NULL, NULL),
(62, 'MOV3231657025794', 2, NULL, NULL),
(63, 'MOV8741657027964', 1, NULL, NULL),
(64, 'MOV8741657027964', 2, NULL, NULL),
(65, 'MOV4331657081848', 1, NULL, NULL),
(66, 'MOV4331657081848', 2, NULL, NULL),
(67, 'MOV61657082257', 1, NULL, NULL),
(68, 'MOV61657082257', 2, NULL, NULL),
(69, 'MOV9891657084090', 1, NULL, NULL),
(70, 'MOV9891657084090', 2, NULL, NULL),
(71, 'MOV2011657084904', 1, NULL, NULL),
(72, 'MOV2011657084904', 2, NULL, NULL),
(73, 'MOV2231657089332', 1, NULL, NULL),
(74, 'MOV2231657089332', 2, NULL, NULL),
(75, 'MOV7461599545737', 1, NULL, NULL),
(76, 'MOV7461599545737', 2, NULL, NULL),
(77, 'MOV7461599545737', 1, NULL, NULL),
(78, 'MOV7461599545737', 2, NULL, NULL),
(79, 'MOV6191657014755', 1, NULL, NULL),
(80, 'MOV6191657014755', 2, NULL, NULL),
(81, 'MOV9841599635605', 1, NULL, NULL),
(82, 'MOV9841599635605', 2, NULL, NULL),
(83, 'MOV7461599545737', 1, NULL, NULL),
(84, 'MOV7461599545737', 2, NULL, NULL),
(85, 'MOV3271657021342', 1, NULL, NULL),
(86, 'MOV3271657021342', 2, NULL, NULL),
(87, 'MOV3271657021342', 1, NULL, NULL),
(88, 'MOV3271657021342', 2, NULL, NULL),
(89, 'MOV7461599545737', 1, NULL, NULL),
(90, 'MOV7461599545737', 2, NULL, NULL),
(91, 'MOV1001599635493', 1, NULL, NULL),
(92, 'MOV1001599635493', 2, NULL, NULL),
(93, 'MOV2111656996604', 1, NULL, NULL),
(94, 'MOV2111656996604', 2, NULL, NULL),
(95, 'MOV9891657084090', 1, NULL, NULL),
(96, 'MOV9891657084090', 2, NULL, NULL),
(97, 'MOV801657015383', 1, NULL, NULL),
(98, 'MOV801657015383', 2, NULL, NULL),
(99, 'MOV461657022413', 1, NULL, NULL),
(100, 'MOV461657022413', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `movie_banner_data`
--

CREATE TABLE `movie_banner_data` (
  `id` int(11) NOT NULL,
  `movieId` varchar(255) NOT NULL,
  `bannerLink` varchar(255) NOT NULL,
  `keyName` varchar(255) NOT NULL,
  `appBanner` int(11) NOT NULL DEFAULT '0' COMMENT '0 Not selected, 1 Selected'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `movie_banner_data`
--

INSERT INTO `movie_banner_data` (`id`, `movieId`, `bannerLink`, `keyName`, `appBanner`) VALUES
(5, 'MOV1591599725157', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/banner/movBannerMOV1591599725157-41599730462fluffy-one-show-fits-all.jpg', 'videos/movie/banner/movBannerMOV1591599725157-41599730462fluffy-one-show-fits-all.jpg', 1),
(7, 'MOV6671600945215', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/banner/TheBLueelmetBanner.jpg', 'videos/movie/banner/TheBLueelmetBanner.jpg', 1),
(11, 'MOV5061656941484', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/banner/movBannerMOV5061656941484-3221656942243800px-Pizigani_1367_Chart_10MB.jpg', 'videos/movie/banner/movBannerMOV5061656941484-3221656942243800px-Pizigani_1367_Chart_10MB.jpg', 1),
(12, 'MOV5831657005113', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/banner/movBannerMOV5831657005113-5281657005793Screenshot_1.png', 'videos/movie/banner/movBannerMOV5831657005113-5281657005793Screenshot_1.png', 1),
(13, 'MOV5841657006906', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/banner/movBannerMOV5841657006906-7781657007086EP-2.png', 'videos/movie/banner/movBannerMOV5841657006906-7781657007086EP-2.png', 1),
(14, 'MOV7141657012157', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/banner/movBannerMOV7141657012157-881657012466EP-3.png', 'videos/movie/banner/movBannerMOV7141657012157-881657012466EP-3.png', 1),
(15, 'MOV2551657012928', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/banner/movBannerMOV2551657012928-6561657013037EP-4.png', 'videos/movie/banner/movBannerMOV2551657012928-6561657013037EP-4.png', 1),
(16, 'MOV6191657014755', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/banner/movBannerMOV6191657014755-3361657015027ouch.png', 'videos/movie/banner/movBannerMOV6191657014755-3361657015027ouch.png', 1),
(17, 'MOV801657015383', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/banner/movBannerMOV801657015383-8371657015778soulmate.png', 'videos/movie/banner/movBannerMOV801657015383-8371657015778soulmate.png', 1),
(18, 'MOV3271657021342', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/banner/movBannerMOV3271657021342-1311657021767husband.png', 'videos/movie/banner/movBannerMOV3271657021342-1311657021767husband.png', 1),
(21, 'MOV3921657023233', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/banner/movBannerMOV3921657023233-7701657023339janhit.png', 'videos/movie/banner/movBannerMOV3921657023233-7701657023339janhit.png', 1),
(24, 'MOV6361657024182', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/banner/movBannerMOV6361657024182-1431657024265smum.png', 'videos/movie/banner/movBannerMOV6361657024182-1431657024265smum.png', 1),
(25, 'MOV4961657024521', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/banner/movBannerMOV4961657024521-8541657024624bram.png', 'videos/movie/banner/movBannerMOV4961657024521-8541657024624bram.png', 1),
(33, 'MOV6281599635549', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/banner/movBannerMOV6281599635549-7381657030568fbfb.jpeg', 'videos/movie/banner/movBannerMOV6281599635549-7381657030568fbfb.jpeg', 1),
(38, 'MOV2231657089332', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/banner/movBannerMOV2231657089332-5961657089430pip.png', 'videos/movie/banner/movBannerMOV2231657089332-5961657089430pip.png', 1),
(40, 'MOV4331657081848', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/banner/movBannerMOV4331657081848-1811657190723bad.png', 'videos/movie/banner/movBannerMOV4331657081848-1811657190723bad.png', 1),
(41, 'MOV9841599635605', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/banner/movBannerMOV9841599635605-8441657266698singham.png', 'videos/movie/banner/movBannerMOV9841599635605-8441657266698singham.png', 1),
(43, 'MOV2521657024925', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/banner/movBannerMOV2521657024925-791657269852RRR-Movie-Review_1648825470847_1648825479894.jpg', 'videos/movie/banner/movBannerMOV2521657024925-791657269852RRR-Movie-Review_1648825470847_1648825479894.jpg', 1),
(44, 'MOV61657082257', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/banner/movBannerMOV61657082257-3151657269926aditya-roy-kapur-starrer-om-the-battle-within-to-release-on-july-1-01.jpg', 'videos/movie/banner/movBannerMOV61657082257-3151657269926aditya-roy-kapur-starrer-om-the-battle-within-to-release-on-july-1-01.jpg', 1),
(45, 'MOV8741657027964', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/banner/movBannerMOV8741657027964-3391657270032Vikrant-Rona-Movie-620x420.jpg', 'videos/movie/banner/movBannerMOV8741657027964-3391657270032Vikrant-Rona-Movie-620x420.jpg', 1),
(46, 'MOV8611657022773', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/banner/movBannerMOV8611657022773-2961657270218Kitni-Haseen-Hogi-Lyrics-Arijit-Singh.jpg', 'videos/movie/banner/movBannerMOV8611657022773-2961657270218Kitni-Haseen-Hogi-Lyrics-Arijit-Singh.jpg', 1),
(47, 'MOV3231657025794', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/banner/movBannerMOV3231657025794-5161657270307Kitni-Haseen-Hogi-Lyrics-Arijit-Singh.jpg', 'videos/movie/banner/movBannerMOV3231657025794-5161657270307Kitni-Haseen-Hogi-Lyrics-Arijit-Singh.jpg', 1),
(48, 'MOV461657022413', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/banner/movBannerMOV461657022413-1091657270745Ek-Villain-Returns-Release-Date-scaled.jpg', 'videos/movie/banner/movBannerMOV461657022413-1091657270745Ek-Villain-Returns-Release-Date-scaled.jpg', 1),
(50, 'MOV7461599545737', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/banner/movBannerMOV7461599545737-9331657521575sintelba.jpg', 'videos/movie/banner/movBannerMOV7461599545737-9331657521575sintelba.jpg', 0),
(51, 'MOV1001599635493', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/banner/movBannerMOV1001599635493-8851657521842bunny.png', 'videos/movie/banner/movBannerMOV1001599635493-8851657521842bunny.png', 0),
(53, 'MOV2111656996604', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/banner/movBannerMOV2111656996604-521657522310laaganba.jpg', 'videos/movie/banner/movBannerMOV2111656996604-521657522310laaganba.jpg', 0),
(54, 'MOV2011657084904', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/banner/movBannerMOV2011657084904-9191657522697laaganba.jpg', 'videos/movie/banner/movBannerMOV2011657084904-9191657522697laaganba.jpg', 0),
(55, 'MOV9891657084090', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/banner/movBannerMOV9891657084090-31657522858natsam.png', 'videos/movie/banner/movBannerMOV9891657084090-31657522858natsam.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `movie_categories`
--

CREATE TABLE `movie_categories` (
  `id` int(11) NOT NULL,
  `movieId` varchar(255) NOT NULL,
  `categoryId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `movie_subtitle`
--

CREATE TABLE `movie_subtitle` (
  `id` int(11) NOT NULL,
  `movieId` varchar(255) NOT NULL,
  `language` int(11) NOT NULL,
  `subtitle_fileLink` varchar(255) DEFAULT NULL,
  `keyName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `movie_subtitle`
--

INSERT INTO `movie_subtitle` (`id`, `movieId`, `language`, `subtitle_fileLink`, `keyName`) VALUES
(1, 'MOV7461599545737', 1, NULL, NULL),
(2, 'MOV7461599545737', 2, NULL, NULL),
(3, 'MOV1001599635493', 1, NULL, NULL),
(4, 'MOV100159963549333', 2, NULL, NULL),
(5, 'MOV6281599635549', 1, NULL, NULL),
(6, 'MOV6281599635549', 2, NULL, NULL),
(7, 'MOV9841599635605', 1, NULL, NULL),
(8, 'MOV9841599635605', 2, NULL, NULL),
(9, 'MOV1591599725157', 1, NULL, NULL),
(10, 'MOV1591599725157', 2, 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/subtitle/English-MOV1591599725157-2191599726237fluffy.txt', 'videos/movie/subtitle/English-MOV1591599725157-2191599726237fluffy.txt'),
(13, 'MOV2301600920629', 1, NULL, NULL),
(14, 'MOV2301600920629', 2, NULL, NULL),
(17, 'MOV6671600945215', 1, NULL, NULL),
(18, 'MOV6671600945215', 2, NULL, NULL),
(21, 'MOV61600957877', 1, NULL, NULL),
(22, 'MOV61600957877', 2, NULL, NULL),
(23, 'MOV6741600958206', 1, NULL, NULL),
(24, 'MOV6741600958206', 2, NULL, NULL),
(27, 'MOV5061656941484', 1, NULL, NULL),
(28, 'MOV5061656941484', 2, NULL, NULL),
(29, 'MOV8001656994845', 1, NULL, NULL),
(30, 'MOV8001656994845', 2, NULL, NULL),
(31, 'MOV2111656996604', 1, NULL, NULL),
(32, 'MOV2111656996604', 2, NULL, NULL),
(33, 'MOV7621656998114', 1, NULL, NULL),
(34, 'MOV7621656998114', 2, NULL, NULL),
(35, 'MOV5831657005113', 1, NULL, NULL),
(36, 'MOV5831657005113', 2, NULL, NULL),
(37, 'MOV5841657006906', 1, NULL, NULL),
(38, 'MOV5841657006906', 2, NULL, NULL),
(39, 'MOV7141657012157', 1, NULL, NULL),
(40, 'MOV7141657012157', 2, NULL, NULL),
(41, 'MOV2551657012928', 1, NULL, NULL),
(42, 'MOV2551657012928', 2, NULL, NULL),
(43, 'MOV6191657014755', 1, NULL, NULL),
(44, 'MOV6191657014755', 2, NULL, NULL),
(45, 'MOV801657015383', 1, NULL, NULL),
(46, 'MOV801657015383', 2, NULL, NULL),
(47, 'MOV3271657021342', 1, NULL, NULL),
(48, 'MOV3271657021342', 2, NULL, NULL),
(49, 'MOV461657022413', 1, NULL, NULL),
(50, 'MOV461657022413', 2, NULL, NULL),
(51, 'MOV8611657022773', 1, NULL, NULL),
(52, 'MOV8611657022773', 2, NULL, NULL),
(53, 'MOV3921657023233', 1, NULL, NULL),
(54, 'MOV3921657023233', 2, NULL, NULL),
(55, 'MOV6361657024182', 1, NULL, NULL),
(56, 'MOV6361657024182', 2, NULL, NULL),
(57, 'MOV4961657024521', 1, NULL, NULL),
(58, 'MOV4961657024521', 2, NULL, NULL),
(59, 'MOV2521657024925', 1, NULL, NULL),
(60, 'MOV2521657024925', 2, NULL, NULL),
(61, 'MOV3231657025794', 1, NULL, NULL),
(62, 'MOV3231657025794', 2, NULL, NULL),
(63, 'MOV8741657027964', 1, NULL, NULL),
(64, 'MOV8741657027964', 2, NULL, NULL),
(65, 'MOV4331657081848', 1, NULL, NULL),
(66, 'MOV4331657081848', 2, NULL, NULL),
(67, 'MOV61657082257', 1, NULL, NULL),
(68, 'MOV61657082257', 2, NULL, NULL),
(69, 'MOV9891657084090', 1, NULL, NULL),
(70, 'MOV9891657084090', 2, NULL, NULL),
(71, 'MOV2011657084904', 1, NULL, NULL),
(72, 'MOV2011657084904', 2, NULL, NULL),
(73, 'MOV2231657089332', 1, NULL, NULL),
(74, 'MOV2231657089332', 2, NULL, NULL),
(75, 'MOV7461599545737', 1, NULL, NULL),
(76, 'MOV7461599545737', 2, NULL, NULL),
(77, 'MOV7461599545737', 1, NULL, NULL),
(78, 'MOV7461599545737', 2, NULL, NULL),
(79, 'MOV6191657014755', 1, NULL, NULL),
(80, 'MOV6191657014755', 2, NULL, NULL),
(81, 'MOV9841599635605', 1, NULL, NULL),
(82, 'MOV9841599635605', 2, NULL, NULL),
(83, 'MOV7461599545737', 1, NULL, NULL),
(84, 'MOV7461599545737', 2, NULL, NULL),
(85, 'MOV3271657021342', 1, NULL, NULL),
(86, 'MOV3271657021342', 2, NULL, NULL),
(87, 'MOV3271657021342', 1, NULL, NULL),
(88, 'MOV3271657021342', 2, NULL, NULL),
(89, 'MOV7461599545737', 1, NULL, NULL),
(90, 'MOV7461599545737', 2, NULL, NULL),
(91, 'MOV1001599635493', 1, NULL, NULL),
(92, 'MOV1001599635493', 2, NULL, NULL),
(93, 'MOV2111656996604', 1, NULL, NULL),
(94, 'MOV2111656996604', 2, NULL, NULL),
(95, 'MOV9891657084090', 1, NULL, NULL),
(96, 'MOV9891657084090', 2, NULL, NULL),
(97, 'MOV801657015383', 1, NULL, NULL),
(98, 'MOV801657015383', 2, NULL, NULL),
(99, 'MOV461657022413', 1, NULL, NULL),
(100, 'MOV461657022413', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `movie_thumbnail_data`
--

CREATE TABLE `movie_thumbnail_data` (
  `id` int(11) NOT NULL,
  `movieId` varchar(255) NOT NULL,
  `imageLink` varchar(255) NOT NULL,
  `keyName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `movie_thumbnail_data`
--

INSERT INTO `movie_thumbnail_data` (`id`, `movieId`, `imageLink`, `keyName`) VALUES
(4, 'MOV6281599635549', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/thumbnail/movImageMOV6281599635549-50815996370133idiot.jpg', 'videos/movie/thumbnail/movImageMOV6281599635549-50815996370133idiot.jpg'),
(6, 'MOV1591599725157', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/thumbnail/movImageMOV1591599725157-5061599731813tumbnail.jpg', 'videos/movie/thumbnail/movImageMOV1591599725157-5061599731813tumbnail.jpg'),
(8, 'MOV6671600945215', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/thumbnail/TheBLueHelmetThumbnail.jpg', 'videos/movie/thumbnail/TheBLueHelmetThumbnail.jpg'),
(12, 'MOV5061656941484', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/thumbnail/movImageMOV5061656941484-6841656941497download.jpeg', 'videos/movie/thumbnail/movImageMOV5061656941484-6841656941497download.jpeg'),
(14, 'MOV5831657005113', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/thumbnail/movImageMOV5831657005113-1861657005781Screenshot_1.png', 'videos/movie/thumbnail/movImageMOV5831657005113-1861657005781Screenshot_1.png'),
(15, 'MOV5841657006906', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/thumbnail/movImageMOV5841657006906-7401657007069EP-2.png', 'videos/movie/thumbnail/movImageMOV5841657006906-7401657007069EP-2.png'),
(16, 'MOV7141657012157', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/thumbnail/movImageMOV7141657012157-5071657012450EP-3.png', 'videos/movie/thumbnail/movImageMOV7141657012157-5071657012450EP-3.png'),
(17, 'MOV2551657012928', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/thumbnail/movImageMOV2551657012928-8831657013020EP-4.png', 'videos/movie/thumbnail/movImageMOV2551657012928-8831657013020EP-4.png'),
(22, 'MOV8611657022773', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/thumbnail/movImageMOV8611657022773-4921657022942haseen.png', 'videos/movie/thumbnail/movImageMOV8611657022773-4921657022942haseen.png'),
(23, 'MOV3921657023233', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/thumbnail/movImageMOV3921657023233-4111657023327janhit.png', 'videos/movie/thumbnail/movImageMOV3921657023233-4111657023327janhit.png'),
(26, 'MOV6361657024182', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/thumbnail/movImageMOV6361657024182-5821657024254smum.png', 'videos/movie/thumbnail/movImageMOV6361657024182-5821657024254smum.png'),
(27, 'MOV4961657024521', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/thumbnail/movImageMOV4961657024521-2421657024613bram.png', 'videos/movie/thumbnail/movImageMOV4961657024521-2421657024613bram.png'),
(28, 'MOV2521657024925', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/thumbnail/movImageMOV2521657024925-2551657024977rrr.png', 'videos/movie/thumbnail/movImageMOV2521657024925-2551657024977rrr.png'),
(32, 'MOV8741657027964', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/thumbnail/movImageMOV8741657027964-641657028027VK.png', 'videos/movie/thumbnail/movImageMOV8741657027964-641657028027VK.png'),
(37, 'MOV6281599635549', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/thumbnail/movImageMOV6281599635549-6411657030456test.png', 'videos/movie/thumbnail/movImageMOV6281599635549-6411657030456test.png'),
(38, 'MOV6281599635549', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/thumbnail/movImageMOV6281599635549-3731657030554fbfb.jpeg', 'videos/movie/thumbnail/movImageMOV6281599635549-3731657030554fbfb.jpeg'),
(39, 'MOV6281599635549', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/thumbnail/movImageMOV6281599635549-9731657030684fbfb.jpeg', 'videos/movie/thumbnail/movImageMOV6281599635549-9731657030684fbfb.jpeg'),
(47, 'MOV4331657081848', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/thumbnail/movImageMOV4331657081848-5881657190711bad.png', 'videos/movie/thumbnail/movImageMOV4331657081848-5881657190711bad.png'),
(48, 'MOV9841599635605', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/thumbnail/movImageMOV9841599635605-6681657266685singham.png', 'videos/movie/thumbnail/movImageMOV9841599635605-6681657266685singham.png'),
(49, 'MOV3271657021342', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/thumbnail/movImageMOV3271657021342-9031657518220feekisha.jpg', 'videos/movie/thumbnail/movImageMOV3271657021342-9031657518220feekisha.jpg'),
(50, 'MOV6191657014755', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/thumbnail/movImageMOV6191657014755-1051657518310download.jpg', 'videos/movie/thumbnail/movImageMOV6191657014755-1051657518310download.jpg'),
(51, 'MOV801657015383', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/thumbnail/movImageMOV801657015383-7791657518480soulcr.png', 'videos/movie/thumbnail/movImageMOV801657015383-7791657518480soulcr.png'),
(52, 'MOV2231657089332', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/thumbnail/movImageMOV2231657089332-5521657519311pip.jpg', 'videos/movie/thumbnail/movImageMOV2231657089332-5521657519311pip.jpg'),
(53, 'MOV7461599545737', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/thumbnail/movImageMOV7461599545737-2441657519547sintel.jpg', 'videos/movie/thumbnail/movImageMOV7461599545737-2441657519547sintel.jpg'),
(54, 'MOV1001599635493', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/thumbnail/movImageMOV1001599635493-31657521772big.jpg', 'videos/movie/thumbnail/movImageMOV1001599635493-31657521772big.jpg'),
(59, 'MOV2111656996604', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/thumbnail/movImageMOV2111656996604-5101657522458Lagaan.jpg', 'videos/movie/thumbnail/movImageMOV2111656996604-5101657522458Lagaan.jpg'),
(60, 'MOV2011657084904', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/thumbnail/movImageMOV2011657084904-7691657522679Lagaan.jpg', 'videos/movie/thumbnail/movImageMOV2011657084904-7691657522679Lagaan.jpg'),
(61, 'MOV9891657084090', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/thumbnail/movImageMOV9891657084090-631657522803natsamrat.jpg', 'videos/movie/thumbnail/movImageMOV9891657084090-631657522803natsamrat.jpg'),
(62, 'MOV61657082257', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/thumbnail/movImageMOV61657082257-2181657525477om.jpg', 'videos/movie/thumbnail/movImageMOV61657082257-2181657525477om.jpg'),
(63, 'MOV461657022413', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/thumbnail/movImageMOV461657022413-4971657535379ekvill.jpg', 'videos/movie/thumbnail/movImageMOV461657022413-4971657535379ekvill.jpg'),
(64, 'MOV3231657025794', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/thumbnail/movImageMOV3231657025794-5971657535554has.png', 'videos/movie/thumbnail/movImageMOV3231657025794-5971657535554has.png');

-- --------------------------------------------------------

--
-- Table structure for table `movie_trailer_data`
--

CREATE TABLE `movie_trailer_data` (
  `id` int(11) NOT NULL,
  `movieId` varchar(255) NOT NULL,
  `trailerLink` varchar(255) NOT NULL,
  `keyName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `movie_trailer_data`
--

INSERT INTO `movie_trailer_data` (`id`, `movieId`, `trailerLink`, `keyName`) VALUES
(2, '', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos%2Fseries%2Ftrailer%2FserTrailerSER6721599564012-2041599564385big-buck-bunny-360p.mp4', 'videos/series/trailer/serTrailerSER6721599564012-2041599564385big-buck-bunny-360p.mp4'),
(3, 'MOV6281599635549', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos%2Fmovie%2Ftrailer%2FmovTrailerMOV6281599635549-3341599641655big-buck-bunny-360p.mp4', 'videos/movie/trailer/movTrailerMOV6281599635549-3341599641655big-buck-bunny-360p.mp4'),
(4, 'MOV1001599635493', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos%2Fmovie%2Ftrailer%2FmovTrailerMOV1001599635493-4131599641748big-buck-bunny-360p.mp4', 'videos/movie/trailer/movTrailerMOV1001599635493-4131599641748big-buck-bunny-360p.mp4'),
(5, 'MOV9841599635605', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos%2Fmovie%2Ftrailer%2FmovTrailerMOV9841599635605-3781599641885big-buck-bunny-360p.mp4', 'videos/movie/trailer/movTrailerMOV9841599635605-3781599641885big-buck-bunny-360p.mp4'),
(6, 'MOV1591599725157', 'An exception occurred while initiating a multipart upload: Error executing \"CreateMultipartUpload\" on \"hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/trailer/movTrailerMOV1591599725157-3591600759262filename.mp4?uploads\"; AWS HTTP error: Clie', 'videos/movie/trailer/movTrailerMOV1591599725157-3591600759262filename.mp4'),
(12, 'MOV7621656998114', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/video/MOV7621656998114_trailer/MOV7621656998114_trailer.m3u8', 'videos/movie/video/MOV7621656998114_trailer/movTrailerMOV7621656998114-8811657003141movie.mp4'),
(13, 'MOV5831657005113', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/video/MOV5831657005113_trailer/MOV5831657005113_trailer.m3u8', 'videos/movie/video/MOV5831657005113_trailer/movTrailerMOV5831657005113-1791657008245movie.mp4'),
(14, 'MOV5841657006906', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/video/MOV5841657006906_trailer/MOV5841657006906_trailer.m3u8', 'videos/movie/video/MOV5841657006906_trailer/movTrailerMOV5841657006906-4161657008346Cubicles_-_EP_01_-_Access_Denied.mp4');

-- --------------------------------------------------------

--
-- Table structure for table `movie_video_data`
--

CREATE TABLE `movie_video_data` (
  `id` int(11) NOT NULL,
  `movieId` varchar(255) NOT NULL,
  `videoLink` varchar(255) NOT NULL,
  `keyName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `movie_video_data`
--

INSERT INTO `movie_video_data` (`id`, `movieId`, `videoLink`, `keyName`) VALUES
(2, 'MOV7461599545737', 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8', 'videos/movie/video/movMOV7461599545737-7101599552384Raindrops_Videvo.mp4'),
(4, 'MOV1001599635493', 'https://multiplatform-f.akamaihd.net/i/multi/will/bunny/big_buck_bunny_,640x360_400,640x360_700,640x360_1000,950x540_1500,.f4v.csmil/master.m3u8', 'videos/movie/video/movMOV1001599635493-6361599641757big-buck-bunny-360p.mp4'),
(5, 'MOV9841599635605', 'https://multiplatform-f.akamaihd.net/i/multi/will/bunny/big_buck_bunny_,640x360_400,640x360_700,640x360_1000,950x540_1500,.f4v.csmil/master.m3u8', 'videos/movie/video/movMOV9841599635605-6791599641894big-buck-bunny-360p.mp4'),
(6, 'MOV1591599725157', 'https://bitdash-a.akamaihd.net/content/MI201109210084_1/m3u8s/f08e80da-bf1d-4e3d-8899-f0f6155f6efa.m3u8', 'videos/movie/video/movMOV1591599725157-6621599730995fluffy.mp4'),
(12, 'MOV61600957877', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/video/MOV61600957877/MOV61600957877.m3u8', 'videos/movie/video/MOV61600957877/MOV61600957877.m3u8'),
(17, 'MOV5831657005113', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/video/MOV5831657005113/MOV5831657005113.m3u8', 'videos/movie/video/MOV5831657005113/MOV5831657005113.m3u8'),
(18, 'MOV5841657006906', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/video/MOV5841657006906/MOV5841657006906.m3u8', 'videos/movie/video/MOV5841657006906/MOV5841657006906.m3u8'),
(19, 'MOV5841657006906', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/video/MOV5841657006906/MOV5841657006906.m3u8', 'videos/movie/video/MOV5841657006906/MOV5841657006906.m3u8'),
(20, 'MOV7141657012157', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/video/MOV7141657012157/MOV7141657012157.m3u8', 'videos/movie/video/MOV7141657012157/MOV7141657012157.m3u8'),
(21, 'MOV2551657012928', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/video/MOV2551657012928/MOV2551657012928.m3u8', 'videos/movie/video/MOV2551657012928/MOV2551657012928.m3u8'),
(22, 'MOV801657015383', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/video/MOV801657015383/MOV801657015383.m3u8', 'videos/movie/video/MOV801657015383/MOV801657015383.m3u8'),
(23, 'MOV6191657014755', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/video/MOV6191657014755/MOV6191657014755.m3u8', 'videos/movie/video/MOV6191657014755/MOV6191657014755.m3u8'),
(24, 'MOV3271657021342', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/video/MOV3271657021342/MOV3271657021342.m3u8', 'videos/movie/video/MOV3271657021342/MOV3271657021342.m3u8'),
(25, 'MOV461657022413', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/video/MOV461657022413/MOV461657022413.m3u8', 'videos/movie/video/MOV461657022413/MOV461657022413.m3u8'),
(26, 'MOV8611657022773', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/video/MOV8611657022773/MOV8611657022773.m3u8', 'videos/movie/video/MOV8611657022773/MOV8611657022773.m3u8'),
(27, 'MOV3921657023233', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/video/MOV3921657023233/MOV3921657023233.m3u8', 'videos/movie/video/MOV3921657023233/MOV3921657023233.m3u8'),
(28, 'MOV6361657024182', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/video/MOV6361657024182/MOV6361657024182.m3u8', 'videos/movie/video/MOV6361657024182/MOV6361657024182.m3u8'),
(29, 'MOV2521657024925', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/video/MOV2521657024925/MOV2521657024925.m3u8', 'videos/movie/video/MOV2521657024925/MOV2521657024925.m3u8'),
(30, 'MOV3231657025794', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/video/MOV3231657025794/MOV3231657025794.m3u8', 'videos/movie/video/MOV3231657025794/MOV3231657025794.m3u8'),
(31, 'MOV8741657027964', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/video/MOV8741657027964/MOV8741657027964.m3u8', 'videos/movie/video/MOV8741657027964/MOV8741657027964.m3u8'),
(32, 'MOV4331657081848', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/video/MOV4331657081848/MOV4331657081848.m3u8', 'videos/movie/video/MOV4331657081848/MOV4331657081848.m3u8'),
(33, 'MOV61657082257', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/video/MOV61657082257/MOV61657082257.m3u8', 'videos/movie/video/MOV61657082257/MOV61657082257.m3u8'),
(34, 'MOV9891657084090', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/video/MOV9891657084090/MOV9891657084090.m3u8', 'videos/movie/video/MOV9891657084090/MOV9891657084090.m3u8'),
(35, 'MOV2011657084904', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/video/MOV2011657084904/MOV2011657084904.m3u8', 'videos/movie/video/MOV2011657084904/MOV2011657084904.m3u8'),
(36, 'MOV2231657089332', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/movie/video/MOV2231657089332/MOV2231657089332.m3u8', 'videos/movie/video/MOV2231657089332/MOV2231657089332.m3u8');

-- --------------------------------------------------------

--
-- Table structure for table `notification_log`
--

CREATE TABLE `notification_log` (
  `id` int(11) NOT NULL,
  `user_type` enum('free','paid','all') DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification_log`
--

INSERT INTO `notification_log` (`id`, `user_type`, `title`, `message`, `created`) VALUES
(1, 'all', 'Hiii User, Learn about Awaato ', 'Please check out the Latest uploads', '2022-07-22 12:38:17'),
(2, 'all', 'Hiii User, Payment Successfull...!!', 'You have completed your transaction successfully', '2022-07-22 12:39:48'),
(3, 'free', 'Subscribe now....', 'New offers comming soon, get in touch', '2022-07-22 12:40:46'),
(4, 'free', 'New Update Available.......', 'Please update latest app from app store', '2022-07-22 12:44:11'),
(5, 'all', 'Much watch..!! Latest movies only on Awaatoo', 'Much watch..!! Latest movies only on Awaatoo', '2022-07-22 12:47:05'),
(6, 'all', 'Exclusive Offer......', 'Subscribe now....@ $10 for ONE YEAR....', '2022-07-22 12:56:05'),
(7, 'all', 'AWAATO Special Offer ', 'Subscribe at  $3 only for Three months', '2022-07-22 13:11:53'),
(8, 'all', 'Exclusive Offer......', 'Subscribe now....@ $10 for ONE YEAR....', '2022-07-22 14:14:27'),
(9, 'all', 'Exclusive Offer......', 'Exclusive Offer......', '2022-07-22 14:19:18'),
(10, 'all', 'Subscription plan updates.....!!!', 'Subscription plan updates, get exciting offers in a single AWAATO', '2022-07-22 16:23:48'),
(11, 'all', 'hey user, get flat 20% off on First subscription.', 'hurry offer expires in 24 hours or until offer ends', '2022-07-22 17:53:45'),
(12, 'all', 'Subscription plan updates.....!!!', 'Get 30% off on first subscription........', '2022-07-25 11:44:19');

-- --------------------------------------------------------

--
-- Table structure for table `num_device_login_by_user`
--

CREATE TABLE `num_device_login_by_user` (
  `id` int(11) NOT NULL,
  `user_detail_id` int(11) NOT NULL,
  `deviceId` varchar(500) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `num_device_login_by_user`
--

INSERT INTO `num_device_login_by_user` (`id`, `user_detail_id`, `deviceId`, `created`, `modified`) VALUES
(1, 33, 'eT2YNsE0Syu5zqhvhje618:APA91bHL1GaVbVAHmVBo2uwXyUmvwih4cm3sGeGHYUCBnAUWTDpROijdHXC7ah9AahV6UY3hBAv91IXCHTYPfczNetxkIvKl_KcqAxfw1JTmYnzHVPbuWd5reZ3PzKxHU2lFlgaWoabj', '2022-07-22 07:40:07', '2022-07-22 07:40:07'),
(2, 34, 'e95D1lrrTcCziDNLLd5NRF:APA91bFodscaCCcDYpUyavJjXXx5WLJSgasj7c0yHvrtlodGAr5ERAUYnNPTdjHbi9d3A2RS95J7Jwl60ng8PqW3JsWz5r9v6E5nJJlTMUKZt_K_oVjXKxl-iRxuO0OoYN6YgpBDd-Gu', '2022-07-22 07:43:46', '2022-07-22 07:43:46'),
(3, 35, 'eT2YNsE0Syu5zqhvhje618:APA91bHL1GaVbVAHmVBo2uwXyUmvwih4cm3sGeGHYUCBnAUWTDpROijdHXC7ah9AahV6UY3hBAv91IXCHTYPfczNetxkIvKl_KcqAxfw1JTmYnzHVPbuWd5reZ3PzKxHU2lFlgaWoabj', '2022-07-22 08:10:38', '2022-07-22 08:10:38'),
(4, 32, 'e95D1lrrTcCziDNLLd5NRF:APA91bFodscaCCcDYpUyavJjXXx5WLJSgasj7c0yHvrtlodGAr5ERAUYnNPTdjHbi9d3A2RS95J7Jwl60ng8PqW3JsWz5r9v6E5nJJlTMUKZt_K_oVjXKxl-iRxuO0OoYN6YgpBDd-Gu', '2022-07-22 08:59:33', '2022-07-22 08:59:33'),
(5, 27, 'undefined', '2022-07-22 09:48:23', '2022-07-22 09:48:23'),
(6, 36, 'eJWfcJPiTCu12rn5QuSLIR:APA91bFdeB6OMHHjIsm5dkgGOOObqlsegBYlJc30JfwUm0-eu0f_kXI4munaUKo_-KzEafeV_nXjWNRGVxFgtPlf5W88RYnUaqoPqgO3ZUci7WRunEHD0qBOl9umcb66ZLp-qQKMbJS8', '2022-07-22 10:23:59', '2022-07-22 10:23:59'),
(7, 33, 'eF4WdNlVTMCgews5__jmA1:APA91bF695x1oxc4q197rvbvSTNiOnR7L4WYkaLbb7aAGBmOCjTfuV9gOq0K0ASUxPS5NzKnRXheppOBrS8Jy5eCxVWwH8ZtDqv0qu1hpD_fwbAVDcS8kM30CwFuTIzAP5P1bgQy8gNh', '2022-07-22 10:33:20', '2022-07-22 10:33:20'),
(8, 37, 'eJWfcJPiTCu12rn5QuSLIR:APA91bFdeB6OMHHjIsm5dkgGOOObqlsegBYlJc30JfwUm0-eu0f_kXI4munaUKo_-KzEafeV_nXjWNRGVxFgtPlf5W88RYnUaqoPqgO3ZUci7WRunEHD0qBOl9umcb66ZLp-qQKMbJS8', '2022-07-22 10:46:04', '2022-07-22 10:46:04'),
(9, 3, 'dCven3dVQbKWbYYPMmkPUF:APA91bF6a0F62KnfXRDIZ1D6NdUX_yi2OqxJBV2L8Q7BOQMKlKMJaUCOWH7An2FyW_88jB1cnghpslWzmTL7Dtr_AZ7c2lh-Gkl_Ck0-LcOeXfOgXpnJcYbNFta_2-qO33vv10U6WDEk', '2022-07-22 10:53:16', '2022-07-22 10:53:16'),
(10, 25, 'fGd-X9LERB2xGNLDPUmkGb:APA91bH2eOjRDAN1Awhg1p-fVeW0_GIENhtEcpSmLdLGv6dFmzjRMkB2UGqsens_tyezRMaUkFFW5nQcUiA2pBu8Ye3UU-LMs-yevjRs-2F1vb63Jc7PELtARszSqyEakOW377qCQjvX', '2022-07-22 11:08:39', '2022-07-22 11:08:39'),
(11, 38, 'eF4WdNlVTMCgews5__jmA1:APA91bF695x1oxc4q197rvbvSTNiOnR7L4WYkaLbb7aAGBmOCjTfuV9gOq0K0ASUxPS5NzKnRXheppOBrS8Jy5eCxVWwH8ZtDqv0qu1hpD_fwbAVDcS8kM30CwFuTIzAP5P1bgQy8gNh', '2022-07-22 11:28:02', '2022-07-22 11:28:02'),
(12, 38, 'undefined', '2022-07-22 11:30:34', '2022-07-22 11:30:34'),
(13, 39, 'dODhl7InTtuf3CIiQCy_CI:APA91bGpSyrhYhfSX3gQcG2uyuf3yrLhg1MPuwzvdMzDFlD_8W_maGAwJgtzao1NxxePG_beRW92MMN3rvvTBT0b1FcbU3gHqOqJClB-ObFiMzknxIDsU8K6tXmuKK_bL34SXFfFteo9', '2022-07-22 11:41:22', '2022-07-22 11:41:22'),
(14, 40, 'eJWfcJPiTCu12rn5QuSLIR:APA91bFdeB6OMHHjIsm5dkgGOOObqlsegBYlJc30JfwUm0-eu0f_kXI4munaUKo_-KzEafeV_nXjWNRGVxFgtPlf5W88RYnUaqoPqgO3ZUci7WRunEHD0qBOl9umcb66ZLp-qQKMbJS8', '2022-07-22 11:50:29', '2022-07-22 11:50:29'),
(15, 27, 'fnLWA3M2QJutarHlsUSj1Y:APA91bHDjAOojmJaaBC6HW_x6f05t440Ioo59uncFYnerwLQSBWafV6i4OwPNxbFuqw_TQbTqtcb6OD5rSyXGRM_GGKnFgOT23qE59nHfT7_r9NwYmuCNT5NHCnwdlYEbS2KI0VAhEZX', '2022-07-22 12:07:33', '2022-07-22 12:07:33'),
(16, 34, 'facdVwNWQKyWjox4l6ZVC5:APA91bHRZRgioaHQczoHlEXMyYmufmJSL3hH9r70GRnzbAIZ2tZ0tvaP2gkGdm841Pp7qAQ1EV_M4Ed6B5U5to6YPJIJUVYoLXwxIEEjN6Kc-ntcSZ4YMMN_Faq4tqMdyl_751swtw5X', '2022-07-22 12:32:07', '2022-07-22 12:32:07'),
(17, 41, 'f4-IkTf9QzSC2vrKmNvD72:APA91bFrFANGRfJqb9WbLBPdoKih4rR3XqwXFTuhw3s6dEfGcdZEHeeAzvMIJm5GAxgnotT3cABct_pJhJmicbva8jWebMr5LgUoj_ajTOEHPCfuVvku_mTMJTCj1YIL4pb_6fRmUSOD', '2022-07-25 06:04:14', '2022-07-25 06:04:14'),
(18, 1, 'dODhl7InTtuf3CIiQCy_CI:APA91bGpSyrhYhfSX3gQcG2uyuf3yrLhg1MPuwzvdMzDFlD_8W_maGAwJgtzao1NxxePG_beRW92MMN3rvvTBT0b1FcbU3gHqOqJClB-ObFiMzknxIDsU8K6tXmuKK_bL34SXFfFteo9', '2022-07-25 07:35:41', '2022-07-25 07:35:41'),
(19, 1, 'dODhl7InTtuf3CIiQCy_CI:APA91bGpSyrhYhfSX3gQcG2uyuf3yrLhg1MPuwzvdMzDFlD_8W_maGAwJgtzao1NxxePG_beRW92MMN3rvvTBT0b1FcbU3gHqOqJClB-ObFiMzknxIDsU8K6tXmuKK_bL34SXFfFteo9', '2022-07-25 07:44:21', '2022-07-25 07:44:21'),
(20, 10, 'dODhl7InTtuf3CIiQCy_CI:APA91bGpSyrhYhfSX3gQcG2uyuf3yrLhg1MPuwzvdMzDFlD_8W_maGAwJgtzao1NxxePG_beRW92MMN3rvvTBT0b1FcbU3gHqOqJClB-ObFiMzknxIDsU8K6tXmuKK_bL34SXFfFteo9', '2022-07-25 07:44:46', '2022-07-25 07:44:46'),
(21, 42, 'fq_xK001SPagSJMhZ03h5J:APA91bFFUwc4m8oVyyOmPfOlVNkKw_AB9bp1FuiKfP12_7FibB1231PcFYTjHOHwxg3hDjcHbFDzc7ek_QeHzg9RpCoQtM_FdhJZswxGdPr2Qjd9svLwsMHZkuLXa4Ms7LZmeB9exiRZ', '2022-07-25 09:33:10', '2022-07-25 09:33:10'),
(22, 1, 'e6RJ1yZdSYOmp23vEMSj3p:APA91bGRRSUKW6eW6X4XjunbZxm5rt4YfgDRBZ7meG1BFTxA4WZoN-53sOxmj-HqYQA2RB4appdOGbx2FqtLa_OtcGawltXFnef8eMTve54j-aeMFziMBl5JHaXb59NkMUAy1dH3bHcw', '2022-07-25 12:30:12', '2022-07-25 12:30:12'),
(23, 3, 'djjpFv4DS8KnT2_jhs_AYC:APA91bFvQ-iOGFaFSVHELZjYvSTpL7ICQYQrJCwrwdJBWmi98fYlkCEhlfZ-BXvSXH-heCm9zmcAGvWw7Zb_PNnjf2K7RsZnzhSJHhNtoJqKwafolOD-xXjtKCXIseFm636iP7jcTsWV', '2022-07-25 12:46:34', '2022-07-25 12:46:34'),
(24, 3, 'djjpFv4DS8KnT2_jhs_AYC:APA91bFvQ-iOGFaFSVHELZjYvSTpL7ICQYQrJCwrwdJBWmi98fYlkCEhlfZ-BXvSXH-heCm9zmcAGvWw7Zb_PNnjf2K7RsZnzhSJHhNtoJqKwafolOD-xXjtKCXIseFm636iP7jcTsWV', '2022-07-25 12:47:35', '2022-07-25 12:47:35');

-- --------------------------------------------------------

--
-- Table structure for table `plan_details`
--

CREATE TABLE `plan_details` (
  `id` int(11) NOT NULL,
  `planName` varchar(20) NOT NULL,
  `durationType` enum('days','months','year','') NOT NULL,
  `duration` int(11) NOT NULL,
  `noOfDeviceLogin` int(11) NOT NULL DEFAULT '1',
  `planCost` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `plan_details`
--

INSERT INTO `plan_details` (`id`, `planName`, `durationType`, `duration`, `noOfDeviceLogin`, `planCost`, `description`) VALUES
(2, 'ONE MONTH PLAN', 'months', 1, 1, 2, '<p>Watch All Latest Movies</p>\r\n<p>Watch All Originals</p>\r\n<p>Watch All Library Movies</p>\r\n<p>Full 1080p HD Quality</p>'),
(3, 'THREE MONTH PLAN', 'months', 3, 2, 5, '<p>Watch All Latest Movies</p>\r\n<p>Watch All Originals</p>\r\n<p>Watch All Library Movies</p>\r\n<p>Full 1080p HD Quality</p>'),
(4, 'SIX MONTH PLAN', 'months', 6, 2, 8, '<p>Watch All Latest Movies</p>\r\n<p>Watch All Originals</p>\r\n<p>Watch All Library Movies</p>\r\n<p>Full 1080p HD Quality</p>'),
(9, 'ONE YEAR PLAN', 'year', 1, 4, 10, '<p>Watch All Latest Movies</p>\r\n<p>Watch All Originals</p>\r\n<p>Watch All Library Movies</p>\r\n<p>Full 1080p HD Quality</p>');

-- --------------------------------------------------------

--
-- Table structure for table `plan_user_details`
--

CREATE TABLE `plan_user_details` (
  `id` int(11) NOT NULL,
  `userId` varchar(255) NOT NULL,
  `plan_details_id` int(11) NOT NULL,
  `buyDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `endDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plan_user_details`
--

INSERT INTO `plan_user_details` (`id`, `userId`, `plan_details_id`, `buyDate`, `endDate`) VALUES
(1, 'OTT8631540', 2, '2020-09-24 12:13:13', '2020-09-29 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `referal_user_logs`
--

CREATE TABLE `referal_user_logs` (
  `referLogId` int(11) NOT NULL,
  `fromUserId` varchar(20) DEFAULT NULL,
  `toUserId` varchar(20) DEFAULT NULL,
  `referalAmount` double DEFAULT NULL,
  `toUserName` varchar(50) DEFAULT NULL,
  `tableId` int(11) DEFAULT NULL,
  `referalAmountBy` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `seasons`
--

CREATE TABLE `seasons` (
  `id` int(11) NOT NULL,
  `seriesId` varchar(255) NOT NULL,
  `seasonId` varchar(255) NOT NULL,
  `seasonNo` int(11) NOT NULL,
  `seasonDetails` varchar(255) NOT NULL,
  `thumbnail` tinyint(1) NOT NULL DEFAULT '0',
  `trailer` int(11) NOT NULL DEFAULT '0',
  `releaseDate` datetime NOT NULL,
  `addedOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seasons`
--

INSERT INTO `seasons` (`id`, `seriesId`, `seasonId`, `seasonNo`, `seasonDetails`, `thumbnail`, `trailer`, `releaseDate`, `addedOn`) VALUES
(1, 'SER2191657278281', 'SER2191657278281-S-01-265', 1, 'CLASSMATES || Web Series || EP01- SACCHI WALI MOHABBAT || NAZARBATTU ||', 1, 1, '2020-02-12 15:32:00', '2022-07-11 10:02:47'),
(2, 'SER2191657278281', 'SER2191657278281-S-2-505', 2, 'CLASSMATES || EP02', 0, 0, '2021-06-03 14:06:00', '2022-07-12 08:36:33'),
(3, 'SER2191657278281', 'SER2191657278281-S-03-390', 3, 'CLASSMATES || EP03', 0, 0, '2021-02-01 14:09:00', '2022-07-12 08:39:23'),
(4, 'SER6741657536031', 'SER6741657536031-S-1-488', 1, 'CUBICALS SEASON 2 || EP01', 0, 0, '2022-02-01 14:13:00', '2022-07-12 08:43:10'),
(5, 'SER6741657536031', 'SER6741657536031-S-2-286', 2, 'CUBICCALS SEASON 2 || EP02', 0, 0, '2022-02-01 14:13:00', '2022-07-12 08:43:54'),
(6, 'SER6741657536031', 'SER6741657536031-S-3-866', 3, 'CUBICCALS SEASON 2 || EP03', 0, 0, '2022-02-01 14:14:00', '2022-07-12 08:44:21'),
(7, 'SER5571657619531', 'SER5571657619531-S-1-232', 1, 'Cubicles || Season 1  ', 1, 1, '2021-02-01 15:26:00', '2022-07-12 09:56:44'),
(8, 'SER1801657619559', 'SER1801657619559-S-1-840', 1, 'CLASSMATE SEASON 1', 1, 1, '2021-03-01 17:25:00', '2022-07-12 11:55:46'),
(9, 'SER1801657619559', 'SER1801657619559-S-2-639', 2, 'CLASSMATE SEASON 2', 1, 1, '2021-01-19 11:15:00', '2022-07-19 05:45:49');

-- --------------------------------------------------------

--
-- Table structure for table `season_thumbnail`
--

CREATE TABLE `season_thumbnail` (
  `id` int(11) NOT NULL,
  `seasonId` varchar(255) NOT NULL,
  `thumbnailLink` varchar(255) NOT NULL,
  `keyName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `season_thumbnail`
--

INSERT INTO `season_thumbnail` (`id`, `seasonId`, `thumbnailLink`, `keyName`) VALUES
(1, 'SER2191657278281-S-01-265', '', 'videos/series/thumbnail/seasonIMGSER2191657278281-S-01-265-401657533904ep1.jpg'),
(2, 'SER5571657619531-S-1-232', '', 'videos/series/thumbnail/seasonIMGSER5571657619531-S-1-232-6771657619836cubi.jpg'),
(3, 'SER1801657619559-S-1-840', '', 'videos/series/thumbnail/seasonIMGSER1801657619559-S-1-840-9741657626964Classmate.jpg'),
(4, 'SER1801657619559-S-2-639', '', 'videos/series/thumbnail/seasonIMGSER1801657619559-S-2-639-5831658209614classep4.jpg'),
(5, 'SER1801657619559-S-2-639', '', 'videos/series/thumbnail/seasonIMGSER1801657619559-S-2-639-9231658216584season2.jpg'),
(6, 'SER1801657619559-S-1-840', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/series/thumbnail/seasonIMGSER1801657619559-S-1-840-5321658730479Classmate.jpg', 'videos/series/thumbnail/seasonIMGSER1801657619559-S-1-840-5321658730479Classmate.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `season_trailer_data`
--

CREATE TABLE `season_trailer_data` (
  `id` int(11) NOT NULL,
  `seasonId` varchar(255) NOT NULL,
  `trailerLink` varchar(255) NOT NULL,
  `keyName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `season_trailer_data`
--

INSERT INTO `season_trailer_data` (`id`, `seasonId`, `trailerLink`, `keyName`) VALUES
(1, 'SER2191657278281-S-01-265', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/series/season/trailer/SER2191657278281-S-01-265_trailer/SER2191657278281-S-01-265_trailer.m3u8', 'videos/series/season/trailer/SER2191657278281-S-01-265_trailer/SER2191657278281-S-01-265_trailer.m3u8'),
(2, 'SER5571657619531-S-1-232', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/series/season/trailer/SER5571657619531-S-1-232_trailer/SER5571657619531-S-1-232_trailer.m3u8', 'videos/series/season/trailer/SER5571657619531-S-1-232_trailer/SER5571657619531-S-1-232_trailer.m3u8'),
(3, 'SER1801657619559-S-1-840', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/series/season/trailer/SER1801657619559-S-1-840_trailer/SER1801657619559-S-1-840_trailer.m3u8', 'videos/series/season/trailer/SER1801657619559-S-1-840_trailer/SER1801657619559-S-1-840_trailer.m3u8'),
(4, 'SER1801657619559-S-2-639', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/series/season/trailer/SER1801657619559-S-2-639_trailer/SER1801657619559-S-2-639_trailer.m3u8', 'videos/series/season/trailer/SER1801657619559-S-2-639_trailer/SER1801657619559-S-2-639_trailer.m3u8');

-- --------------------------------------------------------

--
-- Table structure for table `series`
--

CREATE TABLE `series` (
  `id` int(11) NOT NULL,
  `seriesId` varchar(255) NOT NULL,
  `seriesName` varchar(266) NOT NULL,
  `seriesShortDescription` text,
  `seriesLongDescription` text,
  `seriesCategory` int(11) NOT NULL,
  `seriesType` enum('free','paid') NOT NULL,
  `cast` varchar(255) DEFAULT NULL,
  `director` varchar(255) DEFAULT NULL,
  `totalViews` int(11) NOT NULL DEFAULT '0',
  `thumbnail` tinyint(1) NOT NULL DEFAULT '0',
  `trailer` tinyint(1) NOT NULL DEFAULT '0',
  `banner` tinyint(1) NOT NULL DEFAULT '0',
  `releaseData` datetime NOT NULL,
  `addedOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `series`
--

INSERT INTO `series` (`id`, `seriesId`, `seriesName`, `seriesShortDescription`, `seriesLongDescription`, `seriesCategory`, `seriesType`, `cast`, `director`, `totalViews`, `thumbnail`, `trailer`, `banner`, `releaseData`, `addedOn`) VALUES
(4, 'SER5571657619531', 'CUBICLES WEB SERIES', 'CUBICLES WEB SERIES', 'CUBICLES WEB SERIES', 9, 'free', 'CUBICLES WEB SERIES', 'CUBICLES WEB SERIES', 0, 0, 0, 1, '0000-00-00 00:00:00', '2022-07-12 09:52:11'),
(5, 'SER1801657619559', 'CLASSMATES || Web Series || ', 'CLASSMATES || Web Series || ', 'CLASSMATES || Web Series || ', 9, 'free', 'CLASSMATES || Web Series || ', 'CLASSMATES || Web Series || ', 0, 1, 1, 1, '0000-00-00 00:00:00', '2022-07-12 09:52:39');

-- --------------------------------------------------------

--
-- Table structure for table `series_banner_data`
--

CREATE TABLE `series_banner_data` (
  `id` int(11) NOT NULL,
  `seriesId` varchar(255) NOT NULL,
  `bannerLink` varchar(255) NOT NULL,
  `keyName` varchar(255) NOT NULL,
  `appBanner` int(11) NOT NULL DEFAULT '0' COMMENT '0 Not selected, 1 Selected'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `series_banner_data`
--

INSERT INTO `series_banner_data` (`id`, `seriesId`, `bannerLink`, `keyName`, `appBanner`) VALUES
(1, 'SER2191657278281', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/series/banner/serBannerSER2191657278281-5811657278694maxres.jpg', 'videos/series/banner/serBannerSER2191657278281-5811657278694maxres.jpg', 0),
(2, 'SER6741657536031', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/series/banner/serBannerSER6741657536031-9151657536100image.png', 'videos/series/banner/serBannerSER6741657536031-9151657536100image.png', 0),
(4, 'SER5571657619531', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/series/banner/serBannerSER5571657619531-941657626595cubicles.jpg', 'videos/series/banner/serBannerSER5571657619531-941657626595cubicles.jpg', 0),
(5, 'SER1801657619559', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/series/banner/serBannerSER1801657619559-391657626911class.jpg', 'videos/series/banner/serBannerSER1801657619559-391657626911class.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `series_thumbnail`
--

CREATE TABLE `series_thumbnail` (
  `id` int(11) NOT NULL,
  `seriesId` varchar(255) NOT NULL,
  `imageLink` varchar(255) NOT NULL,
  `keyName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `series_thumbnail`
--

INSERT INTO `series_thumbnail` (`id`, `seriesId`, `imageLink`, `keyName`) VALUES
(1, 'SER2191657278281', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/series/thumbnail/serImageSER2191657278281-2231657278485Classmate.jpg', 'videos/series/thumbnail/serImageSER2191657278281-2231657278485Classmate.jpg'),
(2, 'SER6741657536031', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/series/thumbnail/serImageSER6741657536031-4521657536110197105.jpg', 'videos/series/thumbnail/serImageSER6741657536031-4521657536110197105.jpg'),
(6, 'SER1801657619559', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/series/thumbnail/serImageSER1801657619559-2781657626900Classmate.jpg', 'videos/series/thumbnail/serImageSER1801657619559-2781657626900Classmate.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `series_trailer_data`
--

CREATE TABLE `series_trailer_data` (
  `id` int(11) NOT NULL,
  `seriesId` varchar(255) NOT NULL,
  `trailerLink` varchar(255) NOT NULL,
  `keyName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `series_trailer_data`
--

INSERT INTO `series_trailer_data` (`id`, `seriesId`, `trailerLink`, `keyName`) VALUES
(1, 'SER1801657619559', 'hhttps://s-drc2.cloud.gcore.lu/oops/videos/series/trailer/SER1801657619559_trailer/SER1801657619559_trailer.m3u8', 'videos/series/trailer/SER1801657619559_trailer/SER1801657619559_trailer.m3u8');

-- --------------------------------------------------------

--
-- Table structure for table `support`
--

CREATE TABLE `support` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `status` enum('Pending','Resolved') NOT NULL DEFAULT 'Pending',
  `reason` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `support`
--

INSERT INTO `support` (`id`, `name`, `mobile`, `email`, `message`, `status`, `reason`) VALUES
(1, 'Peter Parker', '8305705837', 'puneet.mahajan@imuons.com', 'Hello', 'Resolved', NULL),
(2, 'Chris Evans', '9881912837', 'chris@gmail.com', 'Hello, this is just for testing.', 'Resolved', NULL),
(3, 'Amod iMuons', '86696085504', 'amod.gaikwad@imuons.com', 'Test', 'Resolved', 'test done'),
(4, 'Tester', '9403832061', 'teamquality80@gmail.com', 'hello this is to notify you that APK is working fine and able to view all the videos clearly', 'Resolved', 'OK from Admin side'),
(5, 'jeje', '6363636363', 'new@rkr.com', 'jdjdje', 'Resolved', 'solve'),
(6, 'pp', '8669605505', 'teamquality80@gmail.com', 'hello', 'Resolved', 'test done'),
(7, 'Peter Parker', '8305705837', 'peter@gmail.com', 'Hello', 'Pending', NULL),
(8, 'abc', '1234', '1@gmail.com', 'testing', 'Pending', NULL),
(9, 'abc', '1234', '1@gmail.com', 'testing', 'Pending', NULL),
(10, 'abc', '1234', '1@gmail.com', 'testing', 'Pending', NULL),
(11, 'abc', '1234', '1@gmail.com', 'testing', 'Pending', NULL),
(12, 'Sunil Mane', '9029482758', 'sam@gmail.com', 'hiii', 'Pending', NULL),
(13, 'Ankit patil', '9975666575', 'Ankitpatil.JRD@gmail.com', 'testing', 'Pending', NULL),
(14, 'abc', '1234', '1@gmail.com', 'testing uday', 'Pending', NULL),
(15, 'SUNIL RAMCHANDRA MANE', '9029482758', 'sunilmane2311@gmail.com', 'testing sunnnnn', 'Pending', NULL),
(16, 'Sunil Mane', '9029482758', 'sunilmane2312@gmail.com', 'Hi test message', 'Pending', NULL),
(17, 'ankit', '9975666575', 'ankit1001@gmail.com', 'test message', 'Pending', NULL),
(18, 'sunil', '9029482758', 'sunilmane2758@gmail.com', 'fjfufusgshszs', 'Pending', NULL),
(19, 'shd', '6565664343435656476', 'ydududsu', 'dudsu', 'Pending', NULL),
(20, 'Suni', '9029482758', 'sunilmane2758@gmail.com', 'gsghshhshhs hshdb', 'Pending', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tag_list`
--

CREATE TABLE `tag_list` (
  `id` int(11) NOT NULL,
  `tagName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tag_list`
--

INSERT INTO `tag_list` (`id`, `tagName`) VALUES
(1, 'Erotic'),
(2, 'Love'),
(3, 'Sports'),
(4, 'War');

-- --------------------------------------------------------

--
-- Table structure for table `user_account`
--

CREATE TABLE `user_account` (
  `id` int(11) NOT NULL,
  `user_detail_id` varchar(40) NOT NULL,
  `beneId` varchar(255) DEFAULT NULL,
  `appId` varchar(255) NOT NULL DEFAULT '',
  `token` varchar(255) DEFAULT '',
  `orderId` varchar(255) NOT NULL,
  `paymentType` varchar(255) NOT NULL DEFAULT '',
  `txnMode` varchar(255) NOT NULL DEFAULT '',
  `type` enum('Deposit','Withdraw','Gratification') NOT NULL,
  `amount` double NOT NULL,
  `balance` double NOT NULL,
  `mainWallet` double NOT NULL,
  `winWallet` double NOT NULL DEFAULT '0',
  `status` enum('Approved','Pending','Rejected','Success','Failed','Process','BankExport','Cancle') NOT NULL DEFAULT 'Pending',
  `getWayStatus` varchar(150) NOT NULL DEFAULT '',
  `paytmStatus` varchar(255) NOT NULL DEFAULT '',
  `statusMessage` varchar(255) NOT NULL DEFAULT '',
  `transactionId` varchar(255) NOT NULL COMMENT 'value will get from payment gateway response',
  `checkSum` varchar(255) NOT NULL DEFAULT '',
  `rejectedReason` varchar(255) NOT NULL DEFAULT '',
  `isReadNotification` enum('Yes','No') NOT NULL DEFAULT 'No',
  `isAdminReedem` enum('Yes','No') NOT NULL DEFAULT 'No',
  `statusCode` varchar(255) DEFAULT '',
  `created` datetime DEFAULT NULL,
  `signature` varchar(255) NOT NULL DEFAULT '',
  `modified` datetime DEFAULT NULL,
  `txStatus` varchar(50) NOT NULL DEFAULT '',
  `emailId` varchar(50) NOT NULL DEFAULT '',
  `mobileNo` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_account`
--

INSERT INTO `user_account` (`id`, `user_detail_id`, `beneId`, `appId`, `token`, `orderId`, `paymentType`, `txnMode`, `type`, `amount`, `balance`, `mainWallet`, `winWallet`, `status`, `getWayStatus`, `paytmStatus`, `statusMessage`, `transactionId`, `checkSum`, `rejectedReason`, `isReadNotification`, `isAdminReedem`, `statusCode`, `created`, `signature`, `modified`, `txStatus`, `emailId`, `mobileNo`) VALUES
(1, 'OTT9798322', NULL, 'sdfdsfdsfsdsd453dxsfrewr4', 'TV3605RVM016UXhPVEUzTmprMk9UUXpNamt3TkRrMk1EUT0tLS0tMTYwMTM3ODk0N5880w==', '1601378946558', 'Cashfree', '', 'Deposit', 40, 0, 0, 0, 'Cancle', '', '', '', '', '', '', 'No', 'No', '', '2020-09-29 16:59:07', '', '2020-09-29 16:59:07', '', 'bawane1992mayuri@gmail,com', 0),
(2, 'OTT9798322', NULL, 'sdfdsfdsfsdsd453dxsfrewr4', 'TV9451RVMk16QXdPVEUzTmprMk9UUXpNamMyT1RFMk1EUT0tLS0tMTYwMTM3OTA0N5639g==', '1601379046130', 'Cashfree', '', 'Deposit', 40, 0, 0, 0, 'Cancle', '', '', '', '', '', '', 'No', 'No', '', '2020-09-29 17:00:46', '', '2020-09-29 17:00:46', '', 'bawane1992mayuri@gmail,com', 0),
(3, 'OTT9798322', NULL, 'sdfdsfdsfsdsd453dxsfrewr4', 'TV6671RVeE1UQTBPVEUzTmprMk9UUXpNalkzTmpVMk1EUT0tLS0tMTYwMTM3OTQ3N7158A==', '1601379474462', 'Cashfree', '', 'Deposit', 40, 0, 0, 0, 'Cancle', '', '', '', '', '', '', 'No', 'No', '', '2020-09-29 17:07:54', '', '2020-09-29 17:07:54', '', 'bawane1992mayuri@gmail,com', 0),
(4, 'OTT9798322', NULL, 'sdfdsfdsfsdsd453dxsfrewr4', 'TV1888RVeU9EWXhPVEUzTmprMk9UUXpNalE1TlRBMk1EUT0tLS0tMTYwMTM3OTcxN2196Q==', '1601379714688', 'Cashfree', '', 'Deposit', 40, 0, 0, 0, 'Cancle', '', '', '', '', '', '', 'No', 'No', '', '2020-09-29 17:11:55', '', '2020-09-29 17:11:55', '', 'bawane1992mayuri@gmail,com', 0),
(5, 'OTT9798322', NULL, 'sdfdsfdsfsdsd453dxsfrewr4', 'TV7015RVeU56VXhPVEUzTmprMk9UUXpNamM1TXpJMk1EUT0tLS0tMTYwMTM3OTc5M5197A==', '1601379789586', 'Cashfree', '', 'Deposit', 40, 0, 0, 0, 'Cancle', '', '', '', '', '', '', 'No', 'No', '', '2020-09-29 17:13:10', '', '2020-09-29 17:13:10', '', 'bawane1992mayuri@gmail,com', 0),
(6, 'OTT9798322', NULL, 'sdfdsfdsfsdsd453dxsfrewr4', 'TV2077RVMk9EQTJPVEUzTmprMk9UUXpNakU0TWpZMk1EUT0tLS0tMTYwMTM3OTgwO1053Q==', '1601379809641', 'Cashfree', '', 'Deposit', 100, 0, 0, 0, 'Cancle', '', '', '', '', '', '', 'No', 'No', '', '2020-09-29 17:13:29', '', '2020-09-29 17:13:29', '', 'bawane1992mayuri@gmail,com', 0),
(7, 'OTT9798322', NULL, 'sdfdsfdsfsdsd453dxsfrewr4', 'TV5902RVeU16WTFPVEUzTmprMk9UUXpNakkxTlRjMk1EUT0tLS0tMTYwMTM4MDE3M5891g==', '1601380171598', 'Cashfree', '', 'Deposit', 40, 0, 0, 0, 'Cancle', '', '', '', '', '', '', 'No', 'No', '', '2020-09-29 17:19:32', '', '2020-09-29 17:19:32', '', 'bawane1992mayuri@gmail,com', 0),
(8, 'OTT9798322', NULL, 'sdfdsfdsfsdsd453dxsfrewr4', 'TV9196RVNE56YzRPVEUzTmprMk9UUXpNamsxT0RJMk1EUT0tLS0tMTYwMTM4MDY2O5507A==', '1601380668011', 'Cashfree', '', 'Deposit', 40, 0, 0, 0, 'Cancle', '', '', '', '', '', '', 'No', 'No', '', '2020-09-29 17:27:48', '', '2020-09-29 17:27:48', '', 'bawane1992mayuri@gmail,com', 0),
(9, 'OTT9798322', NULL, 'sdfdsfdsfsdsd453dxsfrewr4', 'TV3732RVeE1Ua3pPVEUzTmprMk9UUXpNak0zTURJMk1EUT0tLS0tMTYwMTM4MDcxO4048Q==', '', 'Cashfree', '', 'Deposit', 0, 0, 0, 0, 'Failed', '', '', '', '', '', '', 'No', 'No', '', '2020-09-29 17:39:27', '', '2020-09-29 17:39:27', '', 'bawane1992mayuri@gmail,com', 0),
(10, 'OTT9798322', NULL, 'sdfdsfdsfsdsd453dxsfrewr4', 'TV9676RVME9UYzBPVEUzTmprMk9UUXpNamt4T1RBMk1EUT0tLS0tMTYwMTM4MjY1N9251g==', '1601382655866', 'Cashfree', '', 'Deposit', 40, 0, 0, 0, 'Cancle', '', '', '', '', '', '', 'No', 'No', '', '2020-09-29 18:00:56', '', '2020-09-29 18:00:56', '', 'bawane1992mayuri@gmail,com', 0),
(11, 'OTT2376117', NULL, 'sdfdsfdsfsdsd453dxsfrewr4', 'TV2446RVNE1USXlPVEUzTmprMk9UUXpNamc1TVRnMk1EUT0tLS0tMTYwMTYyMjU1M2661Q==', 'QDuew88aZLpWV33y', 'Cashfree', '', 'Deposit', 300, 0, 0, 0, 'Cancle', '', '', '', '', '', '', 'No', 'No', '', '2020-10-02 12:39:11', '', '2020-10-02 12:39:11', '', 'peter@gmail.com', 0),
(12, 'OTT2376117', NULL, 'sdfdsfdsfsdsd453dxsfrewr4', 'TV8406RVMU16SXhPVEUzTmprMk9UUXpNalk0TVRrMk1EUT0tLS0tMTYwMjA2ODg2M1554w==', '9LQt4uhsMCRqMzqL', 'Cashfree', '', 'Deposit', 100, 0, 0, 0, 'Cancle', '', '', '', '', '', '', 'No', 'No', '', '2020-10-07 16:37:43', '', '2020-10-07 16:37:43', '', 'peter@gmail.com', 0),
(13, 'OTT2376117', NULL, 'sdfdsfdsfsdsd453dxsfrewr4', 'TV8774RVMk16ZzBPVEUzTmprMk9UUXpNak00T0RZMk1EUT0tLS0tMTYwNDM5NTYwM5787A==', '8xuiYXmflz4fV8R3', 'Cashfree', '', 'Deposit', 41, 0, 0, 0, 'Cancle', '', '', '', '', '', '', 'No', 'No', '', '2020-11-03 14:56:41', '', '2020-11-03 14:56:41', '', 'peter@gmail.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_account_logs`
--

CREATE TABLE `user_account_logs` (
  `id` int(11) NOT NULL,
  `user_account_id` varchar(30) NOT NULL,
  `beneId` varchar(133) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `user_detail_id` int(11) NOT NULL,
  `orderId` varchar(255) NOT NULL,
  `paymentType` varchar(255) NOT NULL,
  `txnMode` varchar(255) NOT NULL,
  `amount` double NOT NULL,
  `balance` double NOT NULL,
  `mainWallet` double NOT NULL,
  `winWallet` double NOT NULL,
  `checkSum` varchar(255) NOT NULL,
  `paytmType` varchar(255) NOT NULL,
  `type` enum('Deposit','Withdraw') NOT NULL,
  `paytmStatus` varchar(255) NOT NULL,
  `statusCode` varchar(255) NOT NULL,
  `statusMessage` varchar(255) NOT NULL,
  `status` enum('Approved','Pending','Rejected','Process','Failed','Success','BankExport') NOT NULL DEFAULT 'Pending',
  `transactionId` varchar(255) NOT NULL COMMENT 'value will get from payment gateway response',
  `rejectedReason` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `mobileNo` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `pin` varchar(255) DEFAULT NULL,
  `phone` varchar(20) NOT NULL,
  `subscriptionType` enum('free','paid') NOT NULL DEFAULT 'free',
  `isLogin` enum('yes','no') NOT NULL DEFAULT 'yes',
  `countryName` varchar(255) NOT NULL,
  `isBlocked` enum('yes','no') NOT NULL DEFAULT 'no',
  `socialID` varchar(255) DEFAULT NULL,
  `socialAccount` enum('Facebook','Gmail','Apple','No') NOT NULL DEFAULT 'No',
  `otp` int(20) DEFAULT NULL,
  `deviceId` varchar(500) DEFAULT '',
  `signupDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastLogin` datetime DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `user_name`, `email`, `password`, `pin`, `phone`, `subscriptionType`, `isLogin`, `countryName`, `isBlocked`, `socialID`, `socialAccount`, `otp`, `deviceId`, `signupDate`, `lastLogin`, `status`) VALUES
(1, 'OTT8001267', 'saneh singh', 'saneh2222@gmail.com', '$2b$08$wFF..LYBEOpz/QTB4g8Fv.5k2GPAhW9yFF6a9TggbzMtDYC8U5Seu', '$2b$08$.arlkBuOjo4Sxb.JNaqOqOJ2guEvrIuY3oVm91NHBitOwo1jnp08O', '', 'free', 'no', 'India', 'no', '112841339080152682246', 'Gmail', NULL, 'e6RJ1yZdSYOmp23vEMSj3p:APA91bGRRSUKW6eW6X4XjunbZxm5rt4YfgDRBZ7meG1BFTxA4WZoN-53sOxmj-HqYQA2RB4appdOGbx2FqtLa_OtcGawltXFnef8eMTve54j-aeMFziMBl5JHaXb59NkMUAy1dH3bHcw', '2022-07-18 12:01:13', NULL, 'Active'),
(3, 'OTT3067348', 'Sunil M', 'sunilmane2312@gmail.com', '$2b$08$VSNq9wW5UuV1K2/ABnfrpeLUnS1LrlpXjR5yvBlWGKx1S6qFqtCAO', '$2b$08$3/65BMQaSlAOVAAEeUBzL.K0sewm2IRoEFtS9Tk3ZW/5fmuTh8Nc6', '', 'free', 'yes', 'India', 'no', '114260584451166249218', 'Gmail', NULL, 'djjpFv4DS8KnT2_jhs_AYC:APA91bFvQ-iOGFaFSVHELZjYvSTpL7ICQYQrJCwrwdJBWmi98fYlkCEhlfZ-BXvSXH-heCm9zmcAGvWw7Zb_PNnjf2K7RsZnzhSJHhNtoJqKwafolOD-xXjtKCXIseFm636iP7jcTsWV', '2022-07-18 12:46:29', NULL, 'Active'),
(4, 'OTT8510671', 'Devin', 'devinmurphy908@gmail.com', '$2b$08$ZytTX0XDezj9677CdtpTp.yeToXd5Ykp0ZTeTzp9ly1eQGUKH2oEi', '$2b$08$gcKBA9n.lXeLmSHQu7HPieDYJ3TsSTNDxAxKuvFmFgcdTC0gYDLNq', '1256845696', 'free', 'no', 'undefined', 'no', NULL, 'No', NULL, '', '2022-07-19 04:47:39', '2022-07-19 04:52:17', 'Active'),
(5, 'OTT2848388', 'thomas', 'Thomasshelby9256@gmail.com', '$2b$08$j.QHVqHMz59oLrJQNL1Xx.a2CPSGZaZVvCzfTvD6QLP3TGJvxATxy', '$2b$08$gHnmqr.bFlCOGpBqV7.Gie1KuVtEf/k2Weyh.y/fpa35sCmc5admO', '9175944395', 'free', 'yes', 'undefined', 'no', NULL, 'No', 2285, 'dW9nUoygSZS7f9EPxx8Xqt:APA91bHCUcbUqASwkOvmm2LQGG_tekZ55UTQ_rGJyRr8JvF3p9aeaKuBdiv0Ixoi8b3ZWCWRUefu-znM_etuNkPPTDYYt7_DrUfIFtN3uhkBKTqn5fB6HC-Q-jShGfecGBNgQl0302KS', '2022-07-19 04:50:51', '2022-07-21 05:09:12', 'Active'),
(7, 'OTT8137783', 'Sunil Mane', 'sunilmane2758@gmail.com', '$2b$08$PZckBB8mex6yxOjTQdIEIO7kqzYYG2g.zsXZwfh3B0CRvSVVgTN06', '$2b$08$2N0xclajtrjdM9D3bl7yweJWSQzaDNSnAFXFaM.gLNa3Kiulygz5e', '', 'free', 'yes', 'India', 'no', '114413983615023861636', 'Gmail', NULL, 'dDvfN5N0RRaNr7K95K5o1x:APA91bFAFa3sRF95Q24v1DAnfqvLosRF6zo8424EY5PRjQTkzPbh0hCrvvVJZ3G1K_yBuni6NMeJP-PTx4hOssejN7rPPdt15gj12e0x3gTQmPSazrvIVwM89gUKK_PtpCsDY_BEUpkg', '2022-07-19 05:14:16', NULL, 'Active'),
(8, 'OTT1551499', 'kafeel Quraishy', 'kafeelquraishy@gmail.com', '$2b$08$Vk9Tm7KYFuJuDBVJbNq7eetZzfvW64.QqB5saWoEnfa5KlF5b8CJW', '$2b$08$GaFnEFUJzE5XY2DYNnKY5eYmLBjXamQ9celbf.WzHcwWJOalTJAiS', '+918668762', 'free', 'yes', 'undefined', 'no', NULL, 'No', NULL, 'fnxc_uG3Sl6A0HPSVbpTL4:APA91bHDkpRy3UrPidY9U-Erkjcyhn72lNo7VSmzsokp7yDIRNw_pnDmRM4UyOoJufG91WUjrFX-rafnAmgsC7sTSLX2qdSCSByF8ANyaqkXgUA0ozvys2CNjYiM0AHPEzc6rhxle8Me', '2022-07-19 05:18:15', NULL, 'Active'),
(10, 'OTT3276224', 'Sunil Mane', 'sunilmane2311@gmail.com', '$2b$08$iZEm8GXZ49U4aKaTp7mgD.qjzRHC6aX6sFmqwy15S4savYJpSGXq6', '$2b$08$jWVj36.2XNJp/jeLjP6ujuu2bZcDnm9ZExtLiszk7VuMQLZXqrxem', '', 'free', 'no', 'India', 'no', '112549616665336770514', 'Gmail', NULL, 'dODhl7InTtuf3CIiQCy_CI:APA91bGpSyrhYhfSX3gQcG2uyuf3yrLhg1MPuwzvdMzDFlD_8W_maGAwJgtzao1NxxePG_beRW92MMN3rvvTBT0b1FcbU3gHqOqJClB-ObFiMzknxIDsU8K6tXmuKK_bL34SXFfFteo9', '2022-07-19 06:28:53', NULL, 'Active'),
(11, 'OTT6462819', 'test', 'test@gmailcom', '$2b$08$N4MzARJ.mB/tXwm9fgrK0ec2431Rbdq2LXp63ksFYk6Ts6CJzPGTS', '$2b$08$Vdsz/CNdEZSK48XZsjdc9e1iDtcdVa3m.0eeMFkAYgt9XBfTxPyUS', '8320794848', 'free', 'yes', 'undefined', 'no', NULL, 'No', NULL, 'undefined', '2022-07-19 06:41:47', '2022-07-22 04:51:27', 'Active'),
(12, 'OTT922935', 'test2', 'udaythammaneni@gmail.com', '$2b$08$ePtwy9.iqZJs/KlJ3jVYtelp9QLntahF68FcfJ8Ge/pOzIkNHV5oi', '$2b$08$6726MuSS2vV0M9ny/34mzORZcD8DagWzHErIkIVrNXKjQO4ORpUmS', '1234567890', 'free', 'no', 'undefined', 'no', NULL, 'No', 5186, '', '2022-07-19 06:53:33', NULL, 'Active'),
(13, 'OTT3368669', 'test3', 'test3@gmail', '$2b$08$.SueoMV4XLqg/SZZadwSkuR1VWXkfOOFndH2wskk.ahku.KEWqzD.', '$2b$08$QfrosOKuv1FuGmbWAh35zO6A1owmvzum3EPCAMTiZYnkbDoOcgi7u', '123456789', 'free', 'no', 'undefined', 'no', NULL, 'No', NULL, '', '2022-07-19 07:02:25', NULL, 'Active'),
(14, 'OTT9249675', 'test3', 'test3@gmai.com', '$2b$08$yEAP0LU6X66wxTWeyCZ7LOWno6.HTIm7XvRwKuEGQvmrKm2ThRtXG', '$2b$08$GFTx0hdxs49dpFl9P6/ANe86R6RAiLRLGuPDSi5zjCem3VVSTGMna', '1234567890', 'free', 'yes', 'undefined', 'no', NULL, 'No', NULL, 'ekwros5RT26Z3eQMA8KU2j:APA91bEUXAmd2LEaNBu8Wt0wpB8AN8j7ZU_ArGNHbspacnIEn-cVhkP6DOeGscC7kjBeDZ7_A0xzwPQQfSEVoOt2Gw2A9HP3Do7ungQ2asJaaN6sm1MkN3Vrqacq-aN4aUNJLaTimLaw', '2022-07-19 07:14:38', NULL, 'Active'),
(15, 'OTT2904625', 'test1', 'test1@gggg.com', '$2b$08$1IuqrjezTcoWKfl54/OhYuKm2/5O.iL725cUfkhmN9qMLPHlz0Qwe', '$2b$08$P4KPoaMduAnahkhSXahUweBFvWcm2xoHurJ3XLxX2ZNeI9Q7S5C5u', '12345', 'free', 'no', 'undefined', 'no', NULL, 'No', NULL, '', '2022-07-19 09:04:43', NULL, 'Active'),
(16, 'OTT4945178', 'abc', 'abc@gmail.com', '$2b$08$90.s5wKIDsZ8GuQPXQsC4.DQ3WkFPmbz25TbAue.YCSLWevkaN8xK', '$2b$08$E/deomZSeKKNY/qH4VmXEuX8wTHFVeIxpQKvVKG3jCaVMYEaWzFOe', '1234567890', 'free', 'yes', 'undefined', 'no', NULL, 'No', NULL, 'f-ZRoyOgQKOPbIUk9h6su2:APA91bEPXwEHvh8AElcmsxhH43LfUJGH5hUilhzsTaBI4b4paux4joyDLFydgYoZx2WFUBk5bQfJOZ2jt24ic3oO8XL48TN3vE1fZLzdUeaqfqoa-_hJ3vdKviWCCRnlWHwtdP8z0wGe', '2022-07-19 09:32:30', NULL, 'Active'),
(17, 'OTT1890274', 'abc', 'aac@gmail.com', '$2b$08$XpF8LTQR.64BpsD2bv31MegKFMg.4w4rjiC/RyTrH9XCrHsEs9BSa', '$2b$08$3YlGNvkAEkc63ANfYJo5aeb2gQKpNRgVarxXXge28tzNfY7dkRhpG', '1234567890', 'free', 'no', 'undefined', 'no', NULL, 'No', NULL, '', '2022-07-19 09:33:21', NULL, 'Active'),
(18, 'OTT4477774', 'xyz', 'xyz@gmail.com', '$2b$08$9czKFglKnqK.zw2Bv8sUkeTAOLbt5nTOed8dXrd8vjvFcBVA.rdL.', '$2b$08$ZPjZHbfFGeOGxRvAuCxgPeNtx7PkLwPuptgYSgyCwBc51zvjEbLiy', '1234569870', 'free', 'no', 'undefined', 'no', NULL, 'No', NULL, '', '2022-07-19 09:48:04', NULL, 'Active'),
(19, 'OTT1802679', 'test', 'payalkgoswami@gmail.com', '$2b$08$.ntcLz49VAW2lfl7lnNNWOCR/XuBfzMW3/TYm68YGAX0doZvHfTTy', '$2b$08$QwjjoRO26L.XRCkQ/OTsl.iBA5QRU5kQ.gfkIJrPFb5BYVGuJMO92', '8320794848', 'free', 'no', 'undefined', 'no', NULL, 'No', NULL, '', '2022-07-19 10:09:37', '2022-07-21 12:01:17', 'Active'),
(20, 'OTT2563879', 'gf', 'payalspacetechno@gmail.com', '$2b$08$tbOlvsjzw.yXgi3oJYZeseg9nqW5GNSzwF4oYUaTmOKk7c30cUCEO', '$2b$08$.iyl5KTVtJHnsWh8RVhRAuEqkR.0spz0n8Ub9GlVCgGVgsy7QZ1ja', '1234567890', 'free', 'no', 'undefined', 'no', NULL, 'No', NULL, '', '2022-07-19 10:21:37', NULL, 'Active'),
(22, 'OTT6602747', 'payal', 'aaa@gmail.com', '$2b$08$/C2Qi7mCiT0w35Fh89fEC.NQe0r5cTWI18Gp6KdNmhmY2uGSSF32a', '$2b$08$mpdo1JDctOjjVrjlePpwI.h2xKaWGG4FfWr1SA3A7doFJ4ycSnBfW', '1234564890', 'free', 'no', 'undefined', 'no', NULL, 'No', NULL, '', '2022-07-19 10:50:32', NULL, 'Active'),
(25, 'OTT1565320', 'deepali gaikwad', 'deepaligaikwad160@gmail.com', '$2b$08$JBxMTFoiiGjl5JzS6PnnSOsUMdQ.nk808Pc1ODwFwrQQ52Z.loCSm', '$2b$08$HtVNr1KGNOUn8tDsR2.DLeLJQCAfsVVPMOVJ3qjutBrTx9RMEOzmi', '', 'free', 'yes', 'India', 'no', '110536966223755764047', 'Gmail', NULL, 'fGd-X9LERB2xGNLDPUmkGb:APA91bH2eOjRDAN1Awhg1p-fVeW0_GIENhtEcpSmLdLGv6dFmzjRMkB2UGqsens_tyezRMaUkFFW5nQcUiA2pBu8Ye3UU-LMs-yevjRs-2F1vb63Jc7PELtARszSqyEakOW377qCQjvX', '2022-07-20 02:41:20', NULL, 'Active'),
(27, 'OTT4005693', 'payal', 'payalkg0906@gmail.com', '$2b$08$nBp4K7rcAmGKordFxhxbJeMPwxf9rSDtlYmJazQk/bPhwbx7JdaIC', '$2b$08$Go9BAwfMRLJx4Wo0DWqw0.YJ6Sc3oq69qkk/6/FphiepRRvqtXkg2', '8320794848', 'free', 'yes', 'undefined', 'no', NULL, 'No', NULL, 'fnLWA3M2QJutarHlsUSj1Y:APA91bHDjAOojmJaaBC6HW_x6f05t440Ioo59uncFYnerwLQSBWafV6i4OwPNxbFuqw_TQbTqtcb6OD5rSyXGRM_GGKnFgOT23qE59nHfT7_r9NwYmuCNT5NHCnwdlYEbS2KI0VAhEZX', '2022-07-21 11:29:45', '2022-07-22 10:11:46', 'Active'),
(30, 'OTT9615668', 'Bhushan Risers', 'risersbhushan@gmail.com', '$2b$08$4ZIdOXE5Wv056lvDhcIakugvcASEqmOjrgFuTWr7LL553xc4koB16', '$2b$08$1M81RnHffbfP/B529STlO.20TLd5ca2.LVNOkWJWk2/JvTF7lZTcG', '', 'free', 'no', 'India', 'no', '105146234373955217097', 'Gmail', NULL, '', '2022-07-21 12:50:19', NULL, 'Active'),
(32, 'OTT2828990', 'Awaato Production', 'awatto.info@gmail.com', '$2b$08$pEwZFowUc3nefd0k4.xkNO.7AcuFF1Ohg0YM1GbQl..2gv8QNNwxa', '$2b$08$K/7abTNQk1pbfaGEWQqHn.CuNMTOfpqkRNyQxPYWG1YCm5qf5kciS', '', 'free', 'no', 'India', 'no', '103718917120226148493', 'Gmail', NULL, '', '2022-07-22 05:34:19', NULL, 'Active'),
(33, 'OTT3809557', 'xyzp', 'xyz@yopmail.com', '$2b$08$lfQsdubRBneKjj1HGe1SJeflddxASUhkfNGNjQqWy6Spa8ftszWKO', '$2b$08$K6J04nYahLeSzPzyGyTTTOSIR1nlAjhf9vlqw.mM1grDiOkCmQ7nK', '1234567890', 'free', 'no', 'undefined', 'no', NULL, 'No', 9669, '', '2022-07-22 06:03:57', '2022-07-25 06:02:06', 'Active'),
(34, 'OTT3623656', 'ANKIT', 'ankitpatil.jrd@gmail.com', '$2b$08$RPqXrM.JPxww9BB3Bk8wU.0v2cYm9scIhqQ1fMEMvNUm4ESnlUTne', '$2b$08$QCD4FTvKW9WgMbyPHoszZedSUGB5jZGowUGnvtHncicuGaPk5VWhe', '9975666575', 'free', 'yes', 'undefined', 'no', NULL, 'No', 8802, 'facdVwNWQKyWjox4l6ZVC5:APA91bHRZRgioaHQczoHlEXMyYmufmJSL3hH9r70GRnzbAIZ2tZ0tvaP2gkGdm841Pp7qAQ1EV_M4Ed6B5U5to6YPJIJUVYoLXwxIEEjN6Kc-ntcSZ4YMMN_Faq4tqMdyl_751swtw5X', '2022-07-22 07:43:46', '2022-07-25 09:13:04', 'Active'),
(35, 'OTT1458805', 'abc', 'abc@yopmail.com', '$2b$08$YEwLe/zvJ1PAIRUZBBEgRuQPcEvRSoomrl/Mgz.CNDmvtBfdh5YrC', '$2b$08$LZq9hW6ccXN/XS6TrrLzpOz309RyZjXmshkltMiTFf5w8inMi6Uy.', '1234567890', 'free', 'no', 'undefined', 'no', NULL, 'No', NULL, '', '2022-07-22 08:10:38', '2022-07-22 08:13:03', 'Active'),
(36, 'OTT646897', 'abckg', 'pkg@yopmail.com', '$2b$08$1wsNt.1hIcUR7k1bWEU95OKal1fJLgJijjzRCn7H7hGozOyQ/LQUC', '$2b$08$aJU3NishNmORZ7FqIQl5E.T95KeNK8/aBmuv0ZqbqRQXuDwXH7ASS', '1236547890', 'free', 'no', 'undefined', 'no', NULL, 'No', NULL, '', '2022-07-22 10:23:59', NULL, 'Active'),
(37, 'OTT2629872', 'pravi', 'pravi@yopmail.com', '$2b$08$Zmkn6pDkuqNDL3CK2IFDrupKTcOahMSzjdQGBXATXjAN/CkbAahaW', '$2b$08$DA1yhaIlVAtKbSZ8JcygPuXUR68xVGDqzjIQS./HNIqr7lTyAGtHq', '8320794848', 'free', 'no', 'undefined', 'no', NULL, 'No', NULL, '', '2022-07-22 10:46:04', '2022-07-22 11:37:01', 'Active'),
(38, 'OTT3918969', 'Sunil Kumara', 'sunil@gmail.com', '$2b$08$azMSRjvOWluXPsD2Yr.K7uatshuI7zPm7ieHIsVUF8NfExoGU2wtu', '$2b$08$eA/E4HUgRRGDRecS6vaDo.xBLvuiyyFI5cbA/WPBTrRjnL2f/Zrp.', '9029482758', 'free', 'no', 'undefined', 'no', NULL, 'No', 9725, '', '2022-07-22 11:28:02', '2022-07-22 11:39:16', 'Active'),
(39, 'OTT2992530', 'saneh', 'saneh@gmail.com', '$2b$08$jyhMgyKnYX0vYbP3ZUgjRuzUnwnXI5yIYNfxg0zL50QfXxyKILEwC', '$2b$08$ULUJtyfX3XvW2ttX8uxwaepKln0CraYC6fm4NQuOCh0dgPa.6/AKW', '1234567890', 'free', 'no', 'undefined', 'no', NULL, 'No', NULL, '', '2022-07-22 11:41:22', '2022-07-22 11:44:00', 'Active'),
(40, 'OTT8958652', 'pravi', 'kush@yopmail.com', '$2b$08$YjsM031aKirT5DBrX6bR8uw0VMYZIHVflbZdi04sxSleBdmgd9gFW', '$2b$08$ibMQVQnRQpKGIQeSybmJ7.KwNhagdY402CfbDBWdAnefCy/uFg85y', '1234567890', 'free', 'yes', 'undefined', 'no', NULL, 'No', NULL, 'eJWfcJPiTCu12rn5QuSLIR:APA91bFdeB6OMHHjIsm5dkgGOOObqlsegBYlJc30JfwUm0-eu0f_kXI4munaUKo_-KzEafeV_nXjWNRGVxFgtPlf5W88RYnUaqoPqgO3ZUci7WRunEHD0qBOl9umcb66ZLp-qQKMbJS8', '2022-07-22 11:50:29', NULL, 'Active'),
(41, 'OTT3399163', 'ggg', 'gggg@yopmail.com', '$2b$08$sKzb5YwjpVR1b0EqEtjuSOXt9Swr5ERG3sp70WX91IGGOsEvNtnTu', '$2b$08$rV/jvijENrH1ouF9DE0px.gEHrwOP4EZWOfxK2f0yKDlNoVhqRS9S', '1234567890', 'free', 'yes', 'undefined', 'no', NULL, 'No', NULL, 'f4-IkTf9QzSC2vrKmNvD72:APA91bFrFANGRfJqb9WbLBPdoKih4rR3XqwXFTuhw3s6dEfGcdZEHeeAzvMIJm5GAxgnotT3cABct_pJhJmicbva8jWebMr5LgUoj_ajTOEHPCfuVvku_mTMJTCj1YIL4pb_6fRmUSOD', '2022-07-25 06:04:14', '2022-07-25 08:05:26', 'Active'),
(42, 'OTT6312813', 'Awaato', 'awaato.info@gmail.com', '$2b$08$eJuQM3hPt62fh3s6vuwRO.lEeFnf9HSs4o/OUFqLXodQ1uyFoCnmC', '$2b$08$.qjNQNjzsGoTCYj/0AtGa.EInkDq7NMh3KUFx4XRl5bToYni59cMS', '9999999999', 'free', 'yes', 'undefined', 'no', NULL, 'No', NULL, 'fq_xK001SPagSJMhZ03h5J:APA91bFFUwc4m8oVyyOmPfOlVNkKw_AB9bp1FuiKfP12_7FibB1231PcFYTjHOHwxg3hDjcHbFDzc7ek_QeHzg9RpCoQtM_FdhJZswxGdPr2Qjd9svLwsMHZkuLXa4Ms7LZmeB9exiRZ', '2022-07-25 09:33:10', NULL, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `details` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `keyname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_details`
--
ALTER TABLE `bank_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories_list`
--
ALTER TABLE `categories_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `episodes`
--
ALTER TABLE `episodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `episode_audio_files`
--
ALTER TABLE `episode_audio_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `episode_subtitle`
--
ALTER TABLE `episode_subtitle`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `episode_thumbnail_data`
--
ALTER TABLE `episode_thumbnail_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `episode_video_data`
--
ALTER TABLE `episode_video_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favourite`
--
ALTER TABLE `favourite`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `movieId` (`movieId`);

--
-- Indexes for table `movies_slider`
--
ALTER TABLE `movies_slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movie_audio_files`
--
ALTER TABLE `movie_audio_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movie_banner_data`
--
ALTER TABLE `movie_banner_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movie_categories`
--
ALTER TABLE `movie_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movie_subtitle`
--
ALTER TABLE `movie_subtitle`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movie_thumbnail_data`
--
ALTER TABLE `movie_thumbnail_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movie_trailer_data`
--
ALTER TABLE `movie_trailer_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movie_video_data`
--
ALTER TABLE `movie_video_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_log`
--
ALTER TABLE `notification_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `num_device_login_by_user`
--
ALTER TABLE `num_device_login_by_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plan_details`
--
ALTER TABLE `plan_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plan_user_details`
--
ALTER TABLE `plan_user_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `referal_user_logs`
--
ALTER TABLE `referal_user_logs`
  ADD PRIMARY KEY (`referLogId`),
  ADD KEY `fromUserId` (`fromUserId`),
  ADD KEY `referalAmountBy` (`referalAmountBy`),
  ADD KEY `toUserId` (`toUserId`),
  ADD KEY `tableId` (`tableId`);

--
-- Indexes for table `seasons`
--
ALTER TABLE `seasons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `season_thumbnail`
--
ALTER TABLE `season_thumbnail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `season_trailer_data`
--
ALTER TABLE `season_trailer_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `series`
--
ALTER TABLE `series`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `series_banner_data`
--
ALTER TABLE `series_banner_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `series_thumbnail`
--
ALTER TABLE `series_thumbnail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `series_trailer_data`
--
ALTER TABLE `series_trailer_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support`
--
ALTER TABLE `support`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tag_list`
--
ALTER TABLE `tag_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_account`
--
ALTER TABLE `user_account`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_detail_id` (`user_detail_id`),
  ADD KEY `status` (`status`),
  ADD KEY `created` (`created`),
  ADD KEY `paymentType` (`paymentType`),
  ADD KEY `type` (`type`),
  ADD KEY `id` (`id`),
  ADD KEY `orderId` (`orderId`),
  ADD KEY `statusMessage` (`statusMessage`);

--
-- Indexes for table `user_account_logs`
--
ALTER TABLE `user_account_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_detail_id` (`user_detail_id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_login`
--
ALTER TABLE `admin_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `bank_details`
--
ALTER TABLE `bank_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `categories_list`
--
ALTER TABLE `categories_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `episodes`
--
ALTER TABLE `episodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `episode_audio_files`
--
ALTER TABLE `episode_audio_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `episode_subtitle`
--
ALTER TABLE `episode_subtitle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `episode_thumbnail_data`
--
ALTER TABLE `episode_thumbnail_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `episode_video_data`
--
ALTER TABLE `episode_video_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `favourite`
--
ALTER TABLE `favourite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=382;
--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `movies_slider`
--
ALTER TABLE `movies_slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `movie_audio_files`
--
ALTER TABLE `movie_audio_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
--
-- AUTO_INCREMENT for table `movie_banner_data`
--
ALTER TABLE `movie_banner_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `movie_categories`
--
ALTER TABLE `movie_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `movie_subtitle`
--
ALTER TABLE `movie_subtitle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
--
-- AUTO_INCREMENT for table `movie_thumbnail_data`
--
ALTER TABLE `movie_thumbnail_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT for table `movie_trailer_data`
--
ALTER TABLE `movie_trailer_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `movie_video_data`
--
ALTER TABLE `movie_video_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `notification_log`
--
ALTER TABLE `notification_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `num_device_login_by_user`
--
ALTER TABLE `num_device_login_by_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `plan_details`
--
ALTER TABLE `plan_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `plan_user_details`
--
ALTER TABLE `plan_user_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `referal_user_logs`
--
ALTER TABLE `referal_user_logs`
  MODIFY `referLogId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `seasons`
--
ALTER TABLE `seasons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `season_thumbnail`
--
ALTER TABLE `season_thumbnail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `season_trailer_data`
--
ALTER TABLE `season_trailer_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `series`
--
ALTER TABLE `series`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `series_banner_data`
--
ALTER TABLE `series_banner_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `series_thumbnail`
--
ALTER TABLE `series_thumbnail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `series_trailer_data`
--
ALTER TABLE `series_trailer_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `support`
--
ALTER TABLE `support`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `tag_list`
--
ALTER TABLE `tag_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user_account`
--
ALTER TABLE `user_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `user_account_logs`
--
ALTER TABLE `user_account_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2017 at 08:07 AM
-- Server version: 10.0.17-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_mp3_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `username`, `password`, `email`, `image`) VALUES
(1, 'admin', 'admin', 'viaviwebtech@gmail.com', 'profile.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_artist`
--

CREATE TABLE `tbl_artist` (
  `id` int(11) NOT NULL,
  `artist_name` varchar(255) NOT NULL,
  `artist_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_artist`
--

INSERT INTO `tbl_artist` (`id`, `artist_name`, `artist_image`) VALUES
(2, 'Arijit Singh', '76998_arijit.png'),
(3, 'Pritam', '44616_Pritam.jpg'),
(4, 'Lata Mangeshkar', '7144_latamangeshkar-w250.png'),
(5, 'Kishore Kumar', '71075_kishore-kumar.png'),
(6, 'A. R. Rahman', '19271_ar_rahman.jpg'),
(7, 'Shreya Ghoshal', '58618_ShreyaGhoshal.jpg'),
(8, 'Badshah', '14553_Badshah.jpg'),
(9, 'Sonu Nigam', '57012_sonu_nigam_8_by_suyogjain-d8jyfmv.jpg'),
(10, 'Alka Yagnik', '78121_mirchi-music-awards-2014-29.jpg'),
(11, 'Justin Bieber', '3387_bd32ef2a22a800cb34168e48a276f18c.1000x1000x1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `cid` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`cid`, `category_name`) VALUES
(1, 'Bollywood Music'),
(2, 'DJ Remix Mp3 Songs'),
(3, 'Punjabi Music'),
(4, 'Indipop Mp3 Songs'),
(5, 'Instrumental Songs Collections'),
(6, 'Hollywood');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mp3`
--

CREATE TABLE `tbl_mp3` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `mp3_type` varchar(255) NOT NULL,
  `mp3_title` varchar(100) NOT NULL,
  `mp3_url` text NOT NULL,
  `mp3_thumbnail` varchar(255) NOT NULL,
  `mp3_duration` varchar(255) NOT NULL,
  `mp3_artist` text NOT NULL,
  `mp3_description` text NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_mp3`
--

INSERT INTO `tbl_mp3` (`id`, `cat_id`, `mp3_type`, `mp3_title`, `mp3_url`, `mp3_thumbnail`, `mp3_duration`, `mp3_artist`, `mp3_description`, `status`) VALUES
(7, 1, 'server_url', 'What is mobile number..?', 'http://soundt.mp3slash.net/indian/haseena_maan_jaayegi/hmjg03(www.songs.pk).mp3', '86459_What_Is_Mobile_Number-Haseena_Maan_Jaayegi.gif', '6.12', 'Alka Yagnik,Sonu Nigam', '<p>Amazing song</p>\r\n', 1),
(8, 6, 'server_url', 'Overboard - Justin Bieber', 'http://jugnifm.com/music/temp/Overboard_377447_(JugniFM.CoM).mp3', '47064_bd32ef2a22a800cb34168e48a276f18c.1000x1000x1.jpg', '4.11', 'Justin Bieber', '<p>Title:Overboard<br />\r\nAlbum: My Worlds (The Collection) CD 2<br />\r\nArtists: Justin Bieber</p>\r\n', 1),
(9, 1, 'server_url', 'Hind Mere Jind', 'http://soundz.mp3slash.net/new/128/sachinabilliondreamshindi2017/[Songs.pk]%20Hind%20Mere%20Jind%20-%20Sachin%20A%20Billion%20Dreams%20-%20128Kbps%20-%2001%20-%20Hind%20Mere%20Jind.mp3', '46246_2428.jpg', '5:14', 'A. R. Rahman', '', 1),
(10, 1, 'server_url', 'Raabta', 'http://files.mp3slash.net/download/e0a9f2f41794de98179c27f830a5c410', '43283_2494.jpg', '4:57', 'Arijit Singh', '<p>Raabta</p>\r\n', 1),
(11, 1, 'server_url', 'Ullu Ka Pattha - Jagga Jasoos', 'https://smp3dl.com/fileDownload/Songs/128/29802.mp3', '6887_UlluKaPattha(Jagga Jasoos).jpg', '3:31', 'Arijit Singh', '<p>Staring&nbsp;&nbsp; &nbsp;:&nbsp;&nbsp; &nbsp;Ranbir Kapoor, &nbsp;Katrina Kaif, &nbsp;Sayani Gupta, &nbsp;Saswata Chatterjee, &nbsp;Saurabh Shukla, &nbsp;Denzil Smith, &nbsp;Karan Wahi, &nbsp;Mir Sarwar, &nbsp;Govinda, &nbsp;Bijou Thaangjam<br />\r\nDirector&nbsp;&nbsp; &nbsp;:&nbsp;&nbsp; &nbsp;Anurag Basu<br />\r\nMusic Director(s)&nbsp;&nbsp; &nbsp;:&nbsp;&nbsp; &nbsp;Pritam Chakraborty<br />\r\nComposer(s)&nbsp;&nbsp; &nbsp;:&nbsp;&nbsp; &nbsp;Pritam Chakraborty<br />\r\nSinger(s)&nbsp;&nbsp; &nbsp;:&nbsp;&nbsp; &nbsp;Arijit Singh, &nbsp;Nikita Gandhi</p>\r\n', 1),
(12, 2, 'server_url', 'The Valentine Mashup 2017', 'https://smp3dl.com/fileDownload/Songs/128/29422.mp3', '32632_TheValentineMashup2017.jpg', '6:50', 'A. R. Rahman,Arijit Singh,Pritam', '<p>Singer(s)&nbsp;&nbsp; &nbsp;:&nbsp;&nbsp; &nbsp;DJ Notorious</p>\r\n', 1),
(13, 4, 'server_url', '2 Shots (All Eyez on Me)', 'https://smp3dl.com/fileDownload/Songs/128/29806.mp3', '92660_2Shots.JPG', '4:20', 'Badshah', '<p>Singer(s)&nbsp;&nbsp; &nbsp;:&nbsp;&nbsp; &nbsp;Mika Singh</p>\r\n', 1),
(14, 1, 'server_url', 'Main Hoon - Munna Michael', 'https://smp3dl.com/fileDownload/Songs/128/29809.mp3', '99298_MainHoonMunnaMichael.jpg', '3:30', 'Pritam,Sonu Nigam', '<p>Staring&nbsp;&nbsp; &nbsp;:&nbsp;&nbsp; &nbsp;Tiger Shroff, &nbsp;Nawazuddin Siddiqui, &nbsp;Johnny Lever<br />\r\nDirector&nbsp;&nbsp; &nbsp;:&nbsp;&nbsp; &nbsp;Sabir Khan<br />\r\nMusic Director(s)&nbsp;&nbsp; &nbsp;:&nbsp;&nbsp; &nbsp;Tanishk Bagchi<br />\r\nComposer(s)&nbsp;&nbsp; &nbsp;:&nbsp;&nbsp; &nbsp;Tanishk Bagchi<br />\r\nSinger(s)&nbsp;&nbsp; &nbsp;:&nbsp;&nbsp; &nbsp;Siddharth Mahadevan</p>\r\n', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_settings`
--

CREATE TABLE `tbl_settings` (
  `id` int(11) NOT NULL,
  `app_name` varchar(255) NOT NULL,
  `app_logo` varchar(255) NOT NULL,
  `app_email` varchar(255) NOT NULL,
  `app_version` varchar(255) NOT NULL,
  `app_author` varchar(255) NOT NULL,
  `app_contact` varchar(255) NOT NULL,
  `app_website` varchar(255) NOT NULL,
  `app_description` text NOT NULL,
  `app_developed_by` varchar(255) NOT NULL,
  `app_privacy_policy` text NOT NULL,
  `api_all_order_by` varchar(255) NOT NULL,
  `api_latest_limit` int(3) NOT NULL,
  `api_cat_order_by` varchar(255) NOT NULL,
  `api_cat_post_order_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_settings`
--

INSERT INTO `tbl_settings` (`id`, `app_name`, `app_logo`, `app_email`, `app_version`, `app_author`, `app_contact`, `app_website`, `app_description`, `app_developed_by`, `app_privacy_policy`, `api_all_order_by`, `api_latest_limit`, `api_cat_order_by`, `api_cat_post_order_by`) VALUES
(1, 'Online MP3 App', 'sidebar_logo.png', 'info@viaviweb.in', '1.0.0', 'viaviwebtech', '+91 1234567891', 'www.viaviweb.com', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n', 'Viavi Webtech', '<p><strong>We are committed to protecting your privacy</strong></p>\n\n<p>We collect the minimum amount of information about you that is commensurate with providing you with a satisfactory service. This policy indicates the type of processes that may result in data being collected about you. Your use of this website gives us the right to collect that information.&nbsp;</p>\n\n<p><strong>Information Collected</strong></p>\n\n<p>We may collect any or all of the information that you give us depending on the type of transaction you enter into, including your name, address, telephone number, and email address, together with data about your use of the website. Other information that may be needed from time to time to process a request may also be collected as indicated on the website.</p>\n\n<p><strong>Information Use</strong></p>\n\n<p>We use the information collected primarily to process the task for which you visited the website. Data collected in the UK is held in accordance with the Data Protection Act. All reasonable precautions are taken to prevent unauthorised access to this information. This safeguard may require you to provide additional forms of identity should you wish to obtain information about your account details.</p>\n\n<p><strong>Cookies</strong></p>\n\n<p>Your Internet browser has the in-built facility for storing small files - &quot;cookies&quot; - that hold information which allows a website to recognise your account. Our website takes advantage of this facility to enhance your experience. You have the ability to prevent your computer from accepting cookies but, if you do, certain functionality on the website may be impaired.</p>\n\n<p><strong>Disclosing Information</strong></p>\n\n<p>We do not disclose any personal information obtained about you from this website to third parties unless you permit us to do so by ticking the relevant boxes in registration or competition forms. We may also use the information to keep in contact with you and inform you of developments associated with us. You will be given the opportunity to remove yourself from any mailing list or similar device. If at any time in the future we should wish to disclose information collected on this website to any third party, it would only be with your knowledge and consent.&nbsp;</p>\n\n<p>We may from time to time provide information of a general nature to third parties - for example, the number of individuals visiting our website or completing a registration form, but we will not use any information that could identify those individuals.&nbsp;</p>\n\n<p>In addition Dummy may work with third parties for the purpose of delivering targeted behavioural advertising to the Dummy website. Through the use of cookies, anonymous information about your use of our websites and other websites will be used to provide more relevant adverts about goods and services of interest to you. For more information on online behavioural advertising and about how to turn this feature off, please visit youronlinechoices.com/opt-out.</p>\n\n<p><strong>Changes to this Policy</strong></p>\n\n<p>Any changes to our Privacy Policy will be placed here and will supersede this version of our policy. We will take reasonable steps to draw your attention to any changes in our policy. However, to be on the safe side, we suggest that you read this document each time you use the website to ensure that it still meets with your approval.</p>\n\n<p><strong>Contacting Us</strong></p>\n\n<p>If you have any questions about our Privacy Policy, or if you want to know what information we have collected about you, please email us at hd@dummy.com. You can also correct any factual errors in that information or require us to remove your details form any list under our control.</p>\n', 'ASC', 15, 'category_name', 'DESC');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_artist`
--
ALTER TABLE `tbl_artist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `tbl_mp3`
--
ALTER TABLE `tbl_mp3`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_artist`
--
ALTER TABLE `tbl_artist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_mp3`
--
ALTER TABLE `tbl_mp3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

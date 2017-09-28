-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2017 at 03:00 AM
-- Server version: 5.7.14
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `globe_bank`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `hashed_password` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `first_name`, `last_name`, `email`, `username`, `hashed_password`) VALUES
  (1, 'John', 'Public', 'john@somewhere.com', 'johnqpublic', '$2y$10$lkeLxdtcxhm3QZSvixDkpeI/6qvy2Z8GVKWoSzLMXqv0M5k3J67J6'),
  (2, 'Sam', 'Dahal', 'samdahal2@gmail.com', 'sdahal1995', '$2y$10$78161UBOk.AUZ7Y4T2m8Reu/MtFebjOvmyFFbKzOOdLR.Jm01Z2v6');

-- --------------------------------------------------------

--
-- Table structure for table `artist`
--

CREATE TABLE `artist` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `active` tinyint(4) NOT NULL,
  `img_url` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `artist`
--

INSERT INTO `artist` (`id`, `first_name`, `last_name`, `active`, `img_url`) VALUES
  (27, 'Sam', 'Dahal', 1, '/meromusic/public/images/thumbs/rajesh.jpg'),
  (26, 'Juma', 'Artist', 1, '/meromusic/public/images/thumbs/jhuma.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
  (37, 'testla5050\n        '),
  (38, 'teste'),
  (32, 'Punkninja\n        '),
  (35, 'Testn'),
  (39, 'kjjkj;');

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `config_key` varchar(20) NOT NULL,
  `config_value` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `config_key`, `config_value`) VALUES
  (1, 'APP_NAME', 'Mero Music');

-- --------------------------------------------------------

--
-- Table structure for table `log_audit`
--

CREATE TABLE `log_audit` (
  `id` int(11) NOT NULL,
  `log_level` varchar(10) NOT NULL,
  `log_text` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log_audit`
--

INSERT INTO `log_audit` (`id`, `log_level`, `log_text`) VALUES
  (2291, 'INFO', 'SELECT * FROM admin WHERE id=\'1\''),
  (2292, 'INFO', 'SELECT * FROM admins WHERE id=\'1\''),
  (2293, 'INFO', 'SELECT * FROM admins WHERE id=\'1\''),
  (2294, 'INFO', 'SELECT * FROM admins WHERE id=\'2\''),
  (2295, 'INFO', 'SELECT * FROM admins WHERE id=\'1\''),
  (2296, 'INFO', 'SELECT * FROM admins WHERE id=\'1\''),
  (2297, 'INFO', 'SELECT * FROM admins WHERE id=\'1\''),
  (2298, 'INFO', 'SELECT * FROM admins WHERE id=\'1\''),
  (2299, 'INFO', 'SELECT * FROM category'),
  (2300, 'INFO', 'SELECT * FROM category WHERE name LIKE \'k%\''),
  (2301, 'INFO', 'SELECT * FROM category'),
  (2302, 'INFO', 'SELECT * FROM artist'),
  (2303, 'INFO', 'SELECT * FROM artist'),
  (2304, 'INFO', 'SELECT * FROM category'),
  (2305, 'INFO', 'SELECT * FROM admins WHERE id=\'1\''),
  (2306, 'INFO', 'SELECT * FROM admins WHERE id=\'2\''),
  (2307, 'INFO', 'SELECT * FROM admins WHERE id=\'1\''),
  (2308, 'INFO', 'SELECT * FROM admins WHERE id=\'1\''),
  (2309, 'INFO', 'SELECT * FROM admins WHERE id=\'1\''),
  (2310, 'INFO', 'SELECT * FROM admins WHERE id=\'1\''),
  (2311, 'INFO', 'SELECT * FROM admins WHERE id=\'1\''),
  (2312, 'INFO', 'SELECT * FROM admins WHERE id=\'2\''),
  (2313, 'INFO', 'SELECT * FROM admins WHERE id=\'1\''),
  (2314, 'INFO', 'SELECT * FROM admins WHERE id=\'1\''),
  (2315, 'INFO', 'SELECT * FROM admins WHERE id=\'1\''),
  (2316, 'URL', 'http://localhost/meromusic/public/admin.php');

-- --------------------------------------------------------

--
-- Table structure for table `mp3`
--

CREATE TABLE `mp3` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `duration` varchar(10) NOT NULL,
  `description` text NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mp3`
--

INSERT INTO `mp3` (`id`, `title`, `url`, `duration`, `description`, `active`) VALUES
  (1, 'Banmara le', 'ramsing.mp3', '4:20', '&lt;p&gt;lula lampurdfdsfsd upate&lt;/p&gt;\r\n', 1),
  (2, 'Kodo fulyo', 'google.com.mp3', '3:40', '&lt;p&gt;this is samplesadfdsfadsf&lt;/p&gt;\r\n', 1),
  (3, 'HEy maya', 'dfadfds.mp3', '3:02', '&lt;p&gt;fsdfadsfsdfasd&lt;/p&gt;\r\n', 1),
  (4, 'test test', 'nnn.mp3', '4:45', '&lt;p&gt;fsdfdsfsdfsdfasdf&lt;/p&gt;\r\n', 1),
  (5, 'test 20', 'fsdfds.mp3', '4:60', '&lt;p&gt;dsfdsfdsfsdfd&lt;/p&gt;\r\n', 1),
  (6, 'ninja23', 'fsdfdfs.mp3', '7:80', '&lt;p&gt;sdfasdfasdfsd&lt;/p&gt;\r\n', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mp3_artist`
--

CREATE TABLE `mp3_artist` (
  `id` int(11) NOT NULL,
  `mp3_id` int(11) NOT NULL,
  `artist_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mp3_artist`
--

INSERT INTO `mp3_artist` (`id`, `mp3_id`, `artist_id`) VALUES
  (9, 2, 26),
  (8, 1, 26),
  (10, 1, 27),
  (11, 4, 27),
  (12, 5, 26),
  (13, 6, 27),
  (14, 7, 26);

-- --------------------------------------------------------

--
-- Table structure for table `mp3_category`
--

CREATE TABLE `mp3_category` (
  `id` int(11) NOT NULL,
  `mp3_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mp3_category`
--

INSERT INTO `mp3_category` (`id`, `mp3_id`, `category_id`) VALUES
  (8, 1, 35),
  (10, 1, 37),
  (9, 2, 32),
  (2, 2, 35),
  (11, 4, 37),
  (12, 5, 37),
  (13, 6, 38),
  (14, 7, 32);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `menu_name` varchar(255) DEFAULT NULL,
  `position` int(3) DEFAULT NULL,
  `visible` tinyint(1) DEFAULT NULL,
  `content` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `subject_id`, `menu_name`, `position`, `visible`, `content`) VALUES
  (1, 1, 'Globe Bank', 1, 0, '<div id="hero-image">\r\n  <img src="images/page_assets/about us_96582054.png" width="900" height="200" alt="" />\r\n</div>\r\n\r\n<div id="content">\r\n  <h1>About Globe Bank</h1>\r\n  <p>Our mission at Globe Bank International is simple: To serve every coordinate in every hemisphere as if it were our own. From the beginning, it\'s been our goal to incorporate world-class services with an unmatched level of responsiveness and thoughtfulness, no matter what your level of banking need. </p>\r\n\r\n  <p>Globe Bank International (NYSE: GBI), founded in 1950, is one of the newer financial institutions widely active in the world financial market. Despite our youth, we have a history solidly built on hard work, common-sense business practices, empowering investments, and an unyielding dedication to excellence.</p>\r\n\r\n  <p>We currently operate in 42 countries and have nearly 130,000 employees. Our client base is in the millions, from individuals to worldwide conglomerates, and our assets total approximately $1.8 trillion. Learn more about our services and our history, and let us know how we can work together to help you.</p>\r\n\r\n</div>\r\n'),
  (2, 1, 'History', 2, 1, '<div id="hero-image">\r\n  <img src="images/page_assets/history_643025418.png" width="900" height="200" alt="" />\r\n</div>\r\n\r\n<div id="content">\r\n  <h1>History</h1>\r\n  <p>Founded in 1950 by brothers Otis and Isaac Bott, Globe Bank launched as a community financial institution with a fervent mission to help small businesses get their footing in the new economy of Postwar England. While the promise of prosperity was rampant, it was unfortunate that those willing to help with financial backing were understandably cautious and scarce.</p>\r\n\r\n  <p>The Botts believed in the power of community and ingenuity, so much so that several organizations, even to this day, credit the brothers for both their initial formation and their continued success. Among those businesses in the early days is what we now know as The Landon Hotel chain. As others repeatedly turned down requests for financing from its passionate, but inexperienced founder, Arthur Landon, the Botts appreciated and supported Landon\'s verve and vision. What started as a single hotel in London\'s West End, backed by Globe Bank, is now an impressive hotel empire that thrives in cities all around the world.</p>\r\n\r\n  <p>More recently, Globe Bank International has received acclaim for its high-profile investment in Winged Achene Technologies, giving it the means to expand from a small specialty helicopter blade company to a transnational rotorcraft resource, expanding not only the company\'s financial horizons, but creating several thousand sustainable jobs in three cities.</p>\r\n\r\n  <p>The Botts\' keen instincts for solid investments grew just as swiftly as those companies it supported. In 1974, it moved its home office from London to Washington D.C. to better serve its growing clientele, and changed its name to Globe Bank International. Globe Bank International rapidly became key in corporate, commercial, and investment banking in the United States and internationally, assisting in intercontinental and domestic asset management and growth.</p>\r\n\r\n  <p>Still, at its core, Globe Bank International remains a community bank, focusing on the specific needs of individuals and organizations in each community in which its branches are located. Today, Globe Bank is overseen by Otis Bott, President, alongside his son, Gerald Bott, CEO. They have successfully maintained the values and ideals of the family business, despite the bank\'s tremendous growth over the last half century.</p>\r\n\r\n</div>\r\n'),
  (3, 1, 'Leadership', 3, 1, '<div id="hero-image">\r\n  <img src="images/page_assets/leadership_469723021.png" width="900" height="200" alt="" />\r\n</div>\r\n\r\n<div id="content">\r\n  <h1>Leadership</h1>\r\n\r\n  <h2>Board of Directors</h2>\r\n  <ul>\r\n    <li>Robert Otis Bott, President</li>\r\n    <li>Sarah M. Bott</li>\r\n    <li>Alisha Bryan</li>\r\n    <li>Henry Terry</li>\r\n    <li>Meredith Jewel Coffey</li>\r\n    <li>Jesse Gould</li>\r\n    <li>Lea Sheryl Rodriquez</li>\r\n    <li>Joseph Riley</li>\r\n    <li>Martin Stephens</li>\r\n    <li>Jimmie Frank</li>\r\n  </ul>\r\n\r\n  <h2>Executive Team</h2>\r\n  <ul>\r\n    <li>Gerald Bott,&nbsp;Chairman and Chief Executive Officer</li>\r\n    <li>Stewart Talley, Chief Risk Officer</li>\r\n    <li>Judson Phillips, General Counsel</li>\r\n    <li>Naomi Ballard, VP Human Resources</li>\r\n    <li>Dominique Stein, Asset Management CEO </li>\r\n    <li>Cantby Bott, Chief Financial Officer</li>\r\n    <li>Frederic Owen, Commercial Banking CEO</li>\r\n    <li>Freeman McConnell, Corporate & Investment Bank CEO</li>\r\n    <li>Saul Hunt, Consumer & Community Banking CEO</li>\r\n    <li>Cheri Karla Mann, Chief Operating Officer</li>\r\n  </ul>\r\n\r\n</div>\r\n'),
  (4, 1, 'Contact Us', 4, 1, '<div id="hero-image">\r\n  <img src="images/page_assets/contact_dv1060035.png" width="900" height="200" alt="" />\r\n</div>\r\n\r\n\r\n<div id="content">\r\n  <h1>Contact Us</h1>\r\n  <p>We\'re available 24 hours a day, 7 days a week for all your customer service needs.</p>\r\n  <ul>\r\n    <li><a href="#">General banking</a></li>\r\n    <li><a href="#">Online banking</a></li>\r\n    <li><a href="#">Mobile banking</a></li>\r\n    <li><a href="#">Report fraud</a></li>\r\n  </ul>\r\n\r\n</div>\r\n'),
  (5, 2, 'Banking', 1, 1, '<div id="hero-image">\r\n  <img src="images/page_assets/banking_57278269.png" width="900" height="200" alt="" />\r\n</div>\r\n\r\n<div id="content">\r\n  <h1>Banking</h1>\r\n  <h2>Branch, ATM, and Online Banking </h2>\r\n  <p>Bank from anywhere around the globe! With hundreds of branches and even more ATMs, it\'s almost guaranteed that you\'re within a short walk or drive from one of our locations. We go beyond the typical banking hours with our secure online banking services. If you need to manage or move your money, your accounts are available 24 hours a day. </p>\r\n\r\n  <ul>\r\n    <li><a href="#">Find a branch</a></li>\r\n\r\n    <li><a href="#">Find an ATM</a></li>\r\n\r\n    <li><a href="#">Learn about online banking</a></li>\r\n\r\n    <li><a href="#">Learn about Bott Bill Pay</a></li>\r\n  </ul>\r\n\r\n</div>\r\n'),
  (6, 2, 'Credit Cards', 2, 1, '<div id="hero-image">\r\n  <img src="images/page_assets/creditcards_598949380.png" width="900" height="200" alt="" />\r\n</div>\r\n\r\n<div id="content">\r\n  <h1>Credit Cards</h1>\r\n  <p>Our credit card program has been redesigned to help everyone build and improve their credit rather than sink deep into debt. With variable rates that suite your financial profile and needs, we grow with you, rather than against you.</p>\r\n  <ul>\r\n    <li><a href="#">Compare our credit cards</a></li>\r\n    <li><a href="#">Cash back credit cards</a></li>\r\n    <li><a href="#">Rewards cards</a></li>\r\n    <li><a href="#">Check your credit score</a></li>\r\n    <li><a href="#">Transfer a balance</a></li>\r\n  </ul>\r\n</div>\r\n'),
  (7, 2, 'Mortgages', 3, 1, '<div id="hero-image">\r\n  <img src="images/page_assets/homeloans_84513610.png" width="900" height="200" alt="" />\r\n</div>\r\n\r\n<div id="content">\r\n  <h1>Mortgages</h1>\r\n  <p>People shouldn\'t have to buy the farm before they buy the farm. We believed that in 1950, and we believe that today. A home&mdash;whether a farm or condo or anything in between&mdash;is a place where you should feel safe and secure, not afraid that your mortgage is going to drain you of all happiness. Our home loan and home equity professionals take the time to discuss all options, and combine our pre-approval screening with financial forecasts so you know exactly what you can afford for your first or next home.</p>\r\n  <ul>\r\n    <li><a href="#">Check current mortgage rates</a></li>\r\n    <li><a href="#">Check current refinance rates</a></li>\r\n    <li><a href="#">Learn how to buy a home</a></li>\r\n    <li><a href="#">Learn how to refinance</a></li>\r\n    <li><a href="#">Mortgage rate calculator</a></li>\r\n  </ul>\r\n</div>\r\n'),
  (8, 3, 'Checking', 1, 1, '<div id="hero-image">\r\n  <img src="images/page_assets/bizchecking_86519574.png" width="900" height="200" alt="" />\r\n</div>\r\n\r\n<div id="content">\r\n  <h1>Business Checking</h1>\r\n  <p>Options abound when it comes to selecting a Globe Bank business checking account. With so many choices, it might seem daunting to select the account that\'s right for your business. However, our talented customer service team is always available to help, whether in person, by phone, or online. Take a peek at some of our options, and when you\'re ready to get started, give us a shout.</p>\r\n\r\n  <ul>\r\n    <li><a href="#">Compare our checking accounts</a></li>\r\n    <li><a href="#">What you\'ll need to open an account</a></li>\r\n    <li><a href="#">How to choose the right checking account for your business</a></li>\r\n    <li><a href="#">Accounts with no monthly service fee</a></li>\r\n    <li><a href="#">Order checks</a></li>\r\n  </ul>\r\n\r\n</div>\r\n'),
  (9, 3, 'Loans', 2, 1, '<div id="hero-image">\r\n  <img src="images/page_assets/bizloans_539438468.png" width="900" height="200" alt="" />\r\n</div>\r\n\r\n<div id="content">\r\n  <h1>Business Loans</h1>\r\n  <p>Businesses need upkeep to stay profitable in a competitive market. Whether you need to purchase new equipment, have plans for an expansion, or want to remodel your facility, Globe Bank can help you finance your vision.</p>\r\n  <ul>\r\n    <li><a href="#">Compare our business term loans</a></li>\r\n    <li><a href="#">Learn about SBA loan options</a></li>\r\n    <li><a href="#">Estimate monthly payments</a></li>\r\n    <li><a href="#">Check your application status</a></li>\r\n  </ul>\r\n\r\n</div>\r\n'),
  (10, 3, 'Merchant Services', 3, 1, '<div id="hero-image">\r\n  <img src="images/page_assets/merchant_619738814.png" width="900" height="200" alt="" />\r\n</div>\r\n\r\n<div id="content">\r\n  <h1>Merchant Services</h1>\r\n  <p>Whether onsite, online, or on-the-go, your business needs to be nimble in processing payments. We\'ve got the experience to navigate the ever-changing world of payment processing technology. We\'ll make it easy for you to get started with a merchant account, so you can start taking payments almost immediately. </p>\r\n  <ul>\r\n    <li><a href="#">Compare our merchant accounts</a></li>\r\n    <li><a href="#">Credit card processing options</a></li>\r\n    <li><a href="#">Accepting mobile payments</a></li>\r\n    <li><a href="#">POS systems</a></li>\r\n  </ul>\r\n\r\n</div>\r\n'),
  (11, 5, 'Financing', 1, 1, '<div id="hero-image">\r\n  <img src="images/page_assets/financing_522867260.png" width="900" height="200" alt="" />\r\n</div>\r\n\r\n<div id="content">\r\n  <h1>Financing</h1>\r\n  <p>From simple loans to long-term financing for sustained corporate growth, our advisors are here to help with a comprehensive selection of solutions and products to build your business.</p>\r\n  <ul>\r\n    <li><a href="#">Lines of credit</a></li>\r\n    <li><a href="#">Asset-based loans</a></li>\r\n    <li><a href="#">Real estate loans</a></li>\r\n    <li><a href="#">Employee stock ownership plans</a></li>\r\n  </ul>\r\n\r\n</div>\r\n'),
  (12, 5, 'Investments', 2, 1, '<div id="hero-image">\r\n  <img src="images/page_assets/investments_97489446.png" width="900" height="200" alt="" />\r\n</div>\r\n\r\n<div id="content">\r\n  <h1>Investments and Asset Management</h1>\r\n  <p>We\'ll guide you through the global market like no one else can—from global liquidity, real estate securities, hedge funds, and more. We\'ll help you understand investment risk, dealing with inflation and soft economies, as well as asset allocation and regulatory requirements.</p>\r\n  <ul>\r\n    <li><a href="#">Investments for insurance companies</a></li>\r\n    <li><a href="#">Pension fund investments</a></li>\r\n    <li><a href="#">Investment goals for non-profits and charitable institutions</a></li>\r\n    <li><a href="#">Educational establishments investments and endowments</a></li>\r\n    <li><a href="#">Social and environmental impact of investments</a></li>\r\n  </ul>\r\n\r\n</div>\r\n'),
  (13, 5, 'Treasury Services', 3, 0, '<div id="hero-image">\r\n  <img src="images/page_assets/treasury_591423262.png" width="900" height="200" alt="" />\r\n</div>\r\n\r\n<div id="content">\r\n  <h1>Treasury Services</h1>\r\n  <p>Let Globe Bank be your co-CFO. We\'ll help you improve cash flow, improve efficiency, streamline payroll and payment processing, and help you to build a leaner, cleaner organization.</p>\r\n  <ul>\r\n    <li><a href="#">Collections and cash applications</a></li>\r\n    <li><a href="#">Deposit and account management options</a></li>\r\n    <li><a href="#">Payment processing</a></li>\r\n    <li><a href="#">Payroll procedures</a></li>\r\n    <li><a href="#">Fraud protection</a></li>\r\n    <li><a href="#">Liquidity management</a></li>\r\n    <li><a href="#">International expansion</a></li>\r\n    <li><a href="#">Healthcare program management</a></li>\r\n  </ul>\r\n\r\n</div>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
  (1, 'ADMIN'),
  (2, 'AUTHOR');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `menu_name` varchar(255) DEFAULT NULL,
  `position` int(3) DEFAULT NULL,
  `visible` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `menu_name`, `position`, `visible`) VALUES
  (1, 'About Globe Bank', 1, 1),
  (2, 'Consumer', 2, 1),
  (3, 'Small Business', 3, 0),
  (5, 'Commercial', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `user_id`, `role_id`) VALUES
  (3, 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index_username` (`username`);

--
-- Indexes for table `artist`
--
ALTER TABLE `artist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `config_key` (`config_key`);

--
-- Indexes for table `log_audit`
--
ALTER TABLE `log_audit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mp3`
--
ALTER TABLE `mp3`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mp3_artist`
--
ALTER TABLE `mp3_artist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mp3_category`
--
ALTER TABLE `mp3_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_subject_id` (`subject_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `artist`
--
ALTER TABLE `artist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `log_audit`
--
ALTER TABLE `log_audit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2317;
--
-- AUTO_INCREMENT for table `mp3`
--
ALTER TABLE `mp3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `mp3_artist`
--
ALTER TABLE `mp3_artist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `mp3_category`
--
ALTER TABLE `mp3_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

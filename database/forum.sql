-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 12, 2014 at 01:46 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `cid` int(8) NOT NULL AUTO_INCREMENT,
  `cname` varchar(65) NOT NULL,
  `timedate` datetime NOT NULL,
  `created_by` varchar(20) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`cid`, `cname`, `timedate`, `created_by`) VALUES
(6, 'engineering', '2006-10-14 12:31:04', ''),
(8, 'android', '2006-10-14 17:35:49', ''),
(13, 'engineering', '2009-10-14 18:30:17', ''),
(14, 'hellp', '2010-10-14 11:50:53', ''),
(15, 'christee', '2010-10-14 11:52:04', ''),
(16, 'pappu', '2010-10-14 11:52:10', ''),
(17, 'engineering', '2010-10-14 11:52:22', ''),
(18, 'time pass', '2010-10-14 11:56:43', ''),
(19, 'hell new topic', '2010-10-14 19:10:50', ''),
(20, 'really awsome topic', '2010-10-14 19:11:13', '');

-- --------------------------------------------------------

--
-- Table structure for table `deleted_user`
--

CREATE TABLE IF NOT EXISTS `deleted_user` (
  `duid` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `reason` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forum_answer`
--

CREATE TABLE IF NOT EXISTS `forum_answer` (
  `question_id` int(4) NOT NULL DEFAULT '0',
  `a_id` int(4) NOT NULL AUTO_INCREMENT,
  `a_name` varchar(65) NOT NULL DEFAULT '',
  `a_email` varchar(65) NOT NULL DEFAULT '',
  `a_answer` longtext NOT NULL,
  `a_datetime` varchar(25) NOT NULL DEFAULT '',
  PRIMARY KEY (`a_id`),
  KEY `a_id` (`a_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `forum_answer`
--

INSERT INTO `forum_answer` (`question_id`, `a_id`, `a_name`, `a_email`, `a_answer`, `a_datetime`) VALUES
(7, 1, 'AjayPal', 'ajay04p@gmail.com', 'becoz it has be project along with the never ending assignments and remedials with the shocking syllabus', '06/10/14 15:05:43'),
(7, 2, 'AjayPal', 'ajay04p@gmail.com', '	may be engineering colleges have very boring teachers\r\n', '06/10/14 15:34:23'),
(7, 3, 'AjayPal', 'ajay04p@gmail.com', 'we should improve it by appointing intersting teachers\r\n', '06/10/14 15:36:34'),
(7, 4, 'AjayPal', 'ajay04p@gmail.com', '	\r\nwhat the hack i am talking to my self', '06/10/14 15:37:54'),
(7, 5, 'AjayPal', 'ajay04p@gmail.com', '	\r\nkya be jhandu\r\n', '06/10/14 15:46:12'),
(7, 6, 'VijayPal', 'vijaypal373@gmail.co', '	Because it is in english\r\n', '06/10/14 15:46:16'),
(7, 7, 'AjayPal', 'ajay04p@gmail.com', '	\r\ni think that does not matter', '06/10/14 16:49:38'),
(7, 8, 'AjayPal', 'ajay04p@gmail.com', '	\r\nabe kya paka raha hai tu', '06/10/14 16:50:33'),
(7, 9, 'AjayPal', 'ajay04p@gmail.com', '	ky ayar\r\n', '06/10/14 16:52:56'),
(7, 10, 'AjayPal', 'ajay04p@gmail.com', '	\r\noye teri ma ki jay', '06/10/14 16:55:20'),
(7, 11, 'AjayPal', 'ajay04p@gmail.com', '	\r\nbenchod', '06/10/14 16:58:50'),
(8, 12, 'AjayPal', 'ajay04p@gmail.com', 'if you are a quick learner then learn by your self and when you get the answer please let me know!!!!!!!!!!!', '06/10/14 18:11:14'),
(8, 13, 'AjayPal', 'ajay04p@gmail.com', 'well actually there isnt a WAY by which u can learn php in jst five days\r\nbecause its a huge language that has infinite no of function\r\n', '06/10/14 18:14:01'),
(8, 14, 'VijayPal', 'vijaypal373@gmail.co', 'i know the way if u want to know then pay me $100000000 and i will teach u', '08/10/14 16:57:30'),
(12, 19, 'AjayPal', 'ajay04p@gmail.com', '	ja be land\r\n\r\n', '09/10/14 19:23:22'),
(12, 20, 'AjayPal', 'ajay04p@gmail.com', '	khud to chutiya hai au dusro ko chutiya nabana jaf\r\n', '09/10/14 19:23:41'),
(7, 21, 'AjayPal', 'ajay04p@gmail.com', '	\r\nJst get lost asshole', '10/10/14 11:58:25'),
(7, 22, 'AjayPal', 'ajay04p@gmail.com', '	\r\nJst get lost asshole', '10/10/14 12:03:37'),
(7, 23, 'AjayPal', 'ajay04p@gmail.com', '	\r\nJst get lost asshole', '10/10/14 12:05:23'),
(7, 24, 'vijaypal', 'vijay', 'à¤•à¤¯à¥ˆà¤•à¤¿ à¤¼à¤¼à¤¼à¤¼', '10/10/14 13:18:51'),
(9, 25, 'AjayPal', 'ajay04p@gmail.com', '	\r\nbecoz it has no studies and gives u a be certificate\r\n', '10/10/14 13:19:35'),
(7, 26, 'AjayPal', 'ajay04p@gmail.com', '	\r\nkya be jhandu', '10/10/14 19:46:09'),
(7, 27, 'VijayPal', 'vijaypal373@gmail.co', '	\r\nmai chutiya bas', '10/10/14 19:48:32'),
(7, 28, 'VijayPal', 'vijaypal373@gmail.co', '	\r\nmai hi hun vo chutiya', '11/10/14 19:49:44');

-- --------------------------------------------------------

--
-- Table structure for table `forum_question`
--

CREATE TABLE IF NOT EXISTS `forum_question` (
  `question_id` int(4) NOT NULL AUTO_INCREMENT,
  `detail` longtext NOT NULL,
  `name` varchar(65) NOT NULL DEFAULT '',
  `email` varchar(65) NOT NULL DEFAULT '',
  `datetime` varchar(25) NOT NULL DEFAULT '',
  `view` int(4) NOT NULL DEFAULT '0',
  `reply` int(4) NOT NULL DEFAULT '0',
  `tid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  PRIMARY KEY (`question_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `forum_question`
--

INSERT INTO `forum_question` (`question_id`, `detail`, `name`, `email`, `datetime`, `view`, `reply`, `tid`, `cid`) VALUES
(7, 'why computer engineering is so hard.???', 'AjayPal', 'ajay04p@gmail.com', '06/10/14 12:37:53', 0, 18, 7, 6),
(8, 'i am a quick learner..can any one tell me the way to learn  php in jst 5 days.!!!!!!!!!\r\nthat will be great help.', 'AjayPal', 'ajay04p@gmail.com', '06/10/14 18:10:02', 0, 3, 8, 6),
(9, 'Why should i select engineering', 'pritamgupta', 'pritam16mgupta@gmail', '10/10/14 13:18:22', 0, 1, 9, 6),
(10, 'world is great ~~~', 'AjayPal', 'ajay04p@gmail.com', '10/10/14 14:02:19', 0, 0, 10, 6),
(11, 'SDFD', 'AjayPal', 'ajay04p@gmail.com', '10/10/14 14:07:53', 0, 0, 11, 6),
(12, 'SSS', 'AjayPal', 'ajay04p@gmail.com', '10/10/14 14:09:25', 0, 0, 12, 6),
(13, 'AAAAA', 'AjayPal', 'ajay04p@gmail.com', '10/10/14 14:10:29', 0, 0, 13, 6),
(14, 'AAAAAAAAAAAA', 'AjayPal', 'ajay04p@gmail.com', '10/10/14 14:11:16', 0, 0, 14, 6),
(15, 'AAAAAAAAAA', 'AjayPal', 'ajay04p@gmail.com', '10/10/14 14:12:07', 0, 0, 15, 6),
(16, 'aaaaaaaaaaaaaaaaaaaa', 'AjayPal', 'ajay04p@gmail.com', '10/10/14 14:16:03', 0, 0, 16, 6),
(17, 'aaaaaaaaaaaa', 'AjayPal', 'ajay04p@gmail.com', '10/10/14 14:16:51', 0, 0, 17, 6),
(18, 'AJAYPAL', 'AjayPal', 'ajay04p@gmail.com', '10/10/14 14:17:40', 0, 0, 18, 6),
(19, 'jhand jaisa hota hai ye chutiyafa', 'AjayPal', 'ajay04p@gmail.com', '10/10/14 19:37:49', 0, 0, 19, 15),
(20, 'i dong gh ag', 'AjayPal', 'ajay04p@gmail.com', '10/10/14 19:40:47', 0, 0, 20, 15),
(21, 'kya mai chutiya hun', 'VijayPal', 'vijaypal373@gmail.co', '11/10/14 19:51:25', 0, 0, 21, 6);

-- --------------------------------------------------------

--
-- Table structure for table `topic`
--

CREATE TABLE IF NOT EXISTS `topic` (
  `tid` int(8) NOT NULL AUTO_INCREMENT,
  `tname` varchar(65) NOT NULL,
  `cid` int(8) NOT NULL,
  `created_by` varchar(20) NOT NULL,
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `topic`
--

INSERT INTO `topic` (`tid`, `tname`, `cid`, `created_by`) VALUES
(7, 'computer engineering', 6, ''),
(8, 'learning php in 5 days', 6, ''),
(9, 'selecting enginering', 6, ''),
(10, 'hello world', 6, ''),
(11, 'DSFS', 6, ''),
(12, 'SSS', 6, ''),
(13, 'AAA', 6, ''),
(14, 'AAAAAAA', 6, ''),
(15, 'AAAAAA', 6, ''),
(16, 'aaaaaaaa', 6, ''),
(17, 'aaaa', 6, ''),
(18, 'AJAYPAL', 6, ''),
(19, 'chutiya fa', 15, ''),
(20, 'hey fucj', 15, 'ajay04p@gmail.com'),
(21, 'mai chutiya', 6, 'vijaypal373@gmail.co');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(10) NOT NULL AUTO_INCREMENT,
  `fname` varchar(15) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `privilage` int(10) NOT NULL,
  `stimedate` datetime NOT NULL,
  `lactive` datetime NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `fname`, `lname`, `username`, `password`, `privilage`, `stimedate`, `lactive`) VALUES
(24, 'Ajay', 'Pal', 'ajay04p@gmail.com', 'ajaypal', 100, '2006-10-14 12:37:00', '0000-00-00 00:00:00'),
(25, 'Vijay', 'Pal', 'vijaypal373@gmail.co', '8286864399', 0, '2006-10-14 15:44:36', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE IF NOT EXISTS `user_profile` (
  `profile_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `profile` text NOT NULL,
  `qualification` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

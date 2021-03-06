-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.20-log - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2018-05-15 11:26:14
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping database structure for gmail_db
CREATE DATABASE IF NOT EXISTS `gmail_db` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `gmail_db`;


-- Dumping structure for table gmail_db.messages
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fromid` int(10) DEFAULT '0',
  `toid` int(10) DEFAULT '0',
  `fromname` varchar(50) DEFAULT '0',
  `toname` varchar(50) DEFAULT '0',
  `title` varchar(250) DEFAULT '0',
  `body` text,
  `mstatus` varchar(50) DEFAULT 'inbox',
  `status` tinyint(1) DEFAULT '0',
  `sdate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='Messages log';

-- Dumping data for table gmail_db.messages: ~6 rows (approximately)
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` (`id`, `fromid`, `toid`, `fromname`, `toname`, `title`, `body`, `mstatus`, `status`, `sdate`) VALUES
	(1, 1, 5, 'Ajay SR', 'S SR', 'First message', 'Body message', 'inbox', 1, '2018-05-15 05:56:37'),
	(2, 1, 5, 'Ajay SR', 'S SR', 'Re:First message', 'test<br><div style="margin-left:20px;"><font color="#cccccc">On Tuesday 15th of May 2018 05:56:37 AM,test@gmail.com wrote:</font> <br> Body message</div>', 'inbox', 1, '2018-05-15 09:16:10'),
	(3, 1, 5, 'Ajay SR', 'S SR', 'Re:Re:First message', 'Hi there<br><div style="margin-left:20px;"><font color="#cccccc">On Tuesday 15th of May 2018 09:16:10 AM,test@gmail.com wrote:</font> <br> test<br><div style="margin-left:20px;"><font color="#cccccc">On Tuesday 15th of May 2018 05:56:37 AM,test@gmail.com wrote:</font> <br> Body message</div></div>', 'inbox', 1, '2018-05-15 09:19:28'),
	(4, 5, 1, 'Ajay SR', 'S SR', 'test', 'test', 'inbox', 1, '2018-05-15 09:21:40'),
	(5, 5, 1, 'Ajay SR', 'S SR', 'Re:test', 'test2<br><div style="margin-left:20px;"><font color="#cccccc">On Tuesday 15th of May 2018 09:21:40 AM,test5@gmail.com wrote:</font> <br> test</div>', 'inbox', 1, '2018-05-15 09:22:25'),
	(6, 1, 5, 'Ajay SR', 'S SR', 'Re:Re:test', 'test3<br><div style="margin-left:20px;"><font color="#cccccc">On Tuesday 15th of May 2018 09:22:25 AM,test5@gmail.com wrote:</font> <br> test2<br><div style="margin-left:20px;"><font color="#cccccc">On Tuesday 15th of May 2018 09:21:40 AM,test5@gmail.com wrote:</font> <br> test</div></div>', 'trash', 1, '2018-05-15 09:22:52'),
	(7, 1, 5, 'Ajay SR', 'S SR', 'Test mail', 'asdf asdfasdf dasf', 'draft', 1, '2018-05-15 11:18:28'),
	(8, 1, 7, 'Ajay SR', 'S SR', 'First message title', 'test asdfa fsad fds ad fsa test', 'draft', 1, '2018-05-15 11:22:29'),
	(9, 1, 7, 'Ajay SR', 'S SR', 'First message title', 'test asdfa fsad fds ad fsa test', 'draft', 1, '2018-05-15 11:22:40'),
	(10, 1, 7, 'Ajay SR', 'S SR', 'Re:First message title', 'gfdhggfdhgfdhgfdhgtest asdfa fsad fds ad fsa test', 'inbox', 1, '2018-05-15 11:25:45');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;


-- Dumping structure for table gmail_db.messagestatus
CREATE TABLE IF NOT EXISTS `messagestatus` (
  `mid` int(10) NOT NULL AUTO_INCREMENT,
  `status` varchar(50) DEFAULT 'unread',
  PRIMARY KEY (`mid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='All status of messages';

-- Dumping data for table gmail_db.messagestatus: ~4 rows (approximately)
/*!40000 ALTER TABLE `messagestatus` DISABLE KEYS */;
INSERT INTO `messagestatus` (`mid`, `status`) VALUES
	(1, 'unread'),
	(2, 'read'),
	(3, 'draft'),
	(4, 'deleted');
/*!40000 ALTER TABLE `messagestatus` ENABLE KEYS */;


-- Dumping structure for table gmail_db.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `sdate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='Users table for user information and used for authentication.';

-- Dumping data for table gmail_db.users: ~9 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `password`, `firstname`, `lastname`, `email`, `mobile`, `sdate`) VALUES
	(1, 'test', 'test', 'Aj', 'Rathore', 'test@gmail.com', '8888888888', '2018-05-12 14:59:03'),
	(2, 'test2', 'test2', 'Sapna', 'SR', 'test2@gmail.com', '81109922993', '2018-05-13 00:00:53'),
	(3, 'test3', 'test3', 'Sapna', 'SR', 'test3@gmail.com', '81109922993', '2018-05-13 00:03:53'),
	(4, 'test4', 'test4', 'Jeetu', 'jaiswal', 'test4@gmail.com', '81109922993', '2018-05-13 00:03:53'),
	(5, 'test5', 'test5', 'Goweb', 'Bar', 'test5@gmail.com', '81109922993', '2018-05-13 00:03:53'),
	(6, 'test6', 'test6', 'sid', 'singh', 'test6@gmail.com', '81109922993', '2018-05-13 00:03:53'),
	(7, 'test7', 'test7', 'pooja', 'sinha', 'test7@gmail.com', '81109922993', '2018-05-13 00:03:53'),
	(8, 'test8', 'test8', 'ankit', 'SR', 'test8@gmail.com', '81109922993', '2018-05-13 00:03:53'),
	(9, 'test9', 'test9', 'poonam', 'jha', 'test9@gmail.com', '81109922993', '2018-05-13 00:03:53');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 26, 2013 at 12:38 PM
-- Server version: 5.5.31
-- PHP Version: 5.4.6-1ubuntu1.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `db_cloudsend_001`
--

-- --------------------------------------------------------

--
-- Table structure for table `cloud_config`
--

CREATE TABLE IF NOT EXISTS `{inst_db_prefix}config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `configVar` varchar(25) NOT NULL,
  `configVal` mediumtext NOT NULL,
  `configSection` varchar(30) NOT NULL,
  `configFieldType` enum('textarea','text','password','select', 'folderlist') NOT NULL DEFAULT 'text',
  `configPossibleVal` mediumtext NOT NULL,
  `configNeeded` enum('0','1') NOT NULL DEFAULT '1',
  `configClass` varchar(25) NOT NULL,
  `configInputClass` varchar(255) NOT NULL,
  `ordering` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cloud_config`
--

INSERT INTO `{inst_db_prefix}config` (`id`, `configVar`, `configVal`, `configSection`, `configFieldType`, `configPossibleVal`, `configNeeded`, `configClass`, `configInputClass`, `ordering`) VALUES
(1, 'PRODUCT_NAME', '{inst_app_name}', 'general', 'text', '', '1', '', '', 1),
(2, 'ADD_USER_EMAIL', '<b>Hello {name},\n\n</b><br><br>your access for CloudSend has been created. Please use the following information to login:\n\n<br><br><b>Url:</b> {url}\n<br><b>Email:</b> {email}\n<br><b>Password:</b> {password}\n\n<br><br>In case of questions or problems, feel free to contact us.\n\n<br><br><i>Your CloudSend Team</i>', 'templates', 'textarea', '', '1', '', '', 1),
(3, 'SEND_FILES_CUST', '<b>Hello administrator,\n\n</b><br><br>{sender} has send you the following files:\n<br>{filelist}\n<br><br>You''ll find them in the admin panel:\n<br>{adminurl}\n\n<br><br>Kind regards,\n<br><br><i>{sender}</i>', 'templates', 'textarea', '', '1', '', '', 3),
(4, 'SEND_FILES_EMAIL', '<b>Hello,\n</b><br><br>{sender} has send you the following files:\n<br>{filelist}\n\n<br><br>Message:\n<br>{message}\n\n<br><br>In case of questions or problems, feel free to contact us.\n\n<br><br><i>Your CloudSend Team</i><br>', 'templates', 'textarea', '', '1', '', '', 5),
(5, 'ADD_FILES_EMAIL', '<b>Hello {name},\n\n</b><br><br>{sender} has shared the following files with you:<br>{filelist}\n<br><br>You can access them through your CloudSend account.\n<br><b>URL:</b> {url}\n\n<br><br>In case of questions or problems, feel free to contact us.\n\n<br><br><i>Your CloudSend Team</i><br>', 'templates', 'textarea', '', '1', '', '', 7),
(7, 'EMAIL_PROTOCOL', 'mail', 'email', 'select', '{\\"EMAIL_TYPE_MAIL\\":\\"mail\\",\\"EMAIL_TYPE_SEND\\":\\"sendmail\\",\\"EMAIL_TYPE_SMTP\\":\\"smtp\\"}', '1', 'protocol', '', 1),
(8, 'EMAIL_HOST', '', 'email', 'text', '', '0', 'smtp protval', '', 2),
(9, 'EMAIL_USER', '', 'email', 'text', '', '0', 'smtp protval', '', 3),
(10, 'EMAIL_PASS', '', 'email', 'password', '', '0', 'smtp protval', '', 4),
(11, 'EMAIL_PORT', '', 'email', 'text', '', '0', 'smtp protval', '', 5),
(16, 'SYSTEM_LANGUAGE', '{inst_language}', 'general', 'folderlist', 'cloudsend/language/', '1', '', '', 2),
(17, 'SENDMAIL_PATH', '/usr/sbin/sendmail', 'email', 'text', '', '0', 'sendmail protval', '', 1),
(18, 'ADD_USER_SUBJECT', 'Your access to {product}', 'templates', 'text', '', '1', '', 'span5', 0),
(19, 'SEND_FILES_CSUBJECT', '{recipient} - {sender} has send you new files', 'templates', 'text', '', '1', '', 'span5', 2),
(20, 'SEND_FILES_SUBJECT', 'You have received new files', 'templates', 'text', '', '1', '', 'span5', 4),
(21, 'ADD_FILES_SUBJECT', '{recipient} - We have new files for you', 'templates', 'text', '', '1', '', 'span5', 6),
(23, 'GOOGLE_ANALYTICS', '', 'general', 'text', '', '0', '', '', '4'),
(24, 'THUMB_X', '250', 'thumbnails', 'text', '', '1', '', 'span1', '2'),
(25, 'THUMB_Y', '250', 'thumbnails', 'text', '', '1', '', 'span1', '3'),
(26, 'IMAGE_LIBRARY', 'GD', 'thumbnails', 'select', '{\\"IMGLIB_TYPE_GD\\":\\"GD\\",\\"IMGLIB_TYPE_GD2\\":\\"GD2\\",\\"IMGLIB_TYPE_IMAGEMAGICK\\":\\"ImageMagick\\"}', '1', 'imagelib', '', '0'),
(27, 'IMAGE_LIBRARY_PATH', '/usr/bin', 'thumbnails', 'text', '', '0', 'ImageMagick imgval', '', '1'),
(28, 'CLOUD_VERSION', '1.4', 'hidden', 'text', '', '1', '', '', '0'),
(29 , 'SHOW_FREESPACE_USER', 'yes', 'general', 'select', '{\\"SHOW_FREESPACE_USER_YES\\":\\"yes\\",\\"SHOW_FREESPACE_USER_NO\\":\\"no\\"}', '0', '', '', '6'),
(30 , 'DOWNLOAD_TYPE', 'normal', 'downloads', 'select', '{\\"DOWNLOAD_TYPE_NORMAL\\":\\"normal\\",\\"DOWNLOAD_TYPE_CHUNKED\\":\\"chunked\\"}', '1', 'downloads', '', '1'),
(31 , 'CHUNKED_SIZE', '1024', 'downloads', 'text', '', '1', 'chunked downtype', 'span1', '2'),
(32 , 'SEND_FILES_REQUEST', '<b>Hello administrator, </b><br><br>New files has been uploaded by upload request {request}: <br>{filelist} <br><br>You''ll find them in the admin panel: <br>{adminurl} <br><br>Kind regards', 'templates', 'textarea', '', '1', '', '', '9'),
(33 , 'SEND_FILES_REQSUBJECT', 'Upload request {request} has send you new files', 'templates', 'text', '', '1', '', 'span5', '8'),
(34 , 'SHOW_INDEX',  'yes',  'general',  'select',  '{\\"SHOW_INDEX_YES\\":\\"yes\\",\\"SHOW_INDEX_NO\\":\\"no\\"}',  '0',  '',  '',  '7'),
(35 , 'SHOW_CATFOLDER',  'category',  'general',  'select',  '{\\"SHOW_CATFOLDER_CAT\\":\\"category\\",\\"SHOW_CATFOLDER_FOLD\\":\\"folder\\",\\"SHOW_CATFOLDER_BOTH\\":\\"both\\"}',  '0',  '',  '',  '8');

-- --------------------------------------------------------

--
-- Table structure for table `cloud_file2user`
--

CREATE TABLE IF NOT EXISTS `{inst_db_prefix}file2user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `f2uUniqueID` varchar(30) NOT NULL,
  `userUniqueID` varchar(30) NOT NULL,
  `fileUniqueID` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cloud_file2user`
--


-- --------------------------------------------------------

--
-- Table structure for table `cloud_files`
--

CREATE TABLE IF NOT EXISTS `{inst_db_prefix}files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fileUniqueID` varchar(30) NOT NULL,
  `fileName` varchar(255) NOT NULL,
  `fileNewName` varchar(40) NOT NULL,
  `fileDescription` mediumtext,
  `fileTags` varchar(255) NOT NULL,
  `fileMD5` VARCHAR( 32 ) DEFAULT NULL,
  `fileType` varchar(150) NOT NULL,
  `fileSize` int(11) NOT NULL,
  `fileUploadBy` varchar(30) NOT NULL,
  `uploadRequest` VARCHAR( 40 ) DEFAULT NULL,
  `fileByCustomer` enum('0','1') NOT NULL DEFAULT '0',
  `fileTime` int(11) NOT NULL,
  `fileCounter` int(11) NOT NULL,
  `filePublic` enum('0','1') NOT NULL DEFAULT '0',
  `fileImportID` varchar(30) NOT NULL,
  `folderUniqueID` varchar( 30 ) DEFAULT NULL
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cloud_files`
--


-- --------------------------------------------------------

--
-- Table structure for table `cloud_public2file`
--

CREATE TABLE IF NOT EXISTS `{inst_db_prefix}public2file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `publicUniqueID` varchar(30) NOT NULL,
  `fileUniqueID` varchar(30) NOT NULL,
  `allowedCount` int(11) DEFAULT NULL,
  `downloadCount` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cloud_public2file`
--


-- --------------------------------------------------------

--
-- Table structure for table `cloud_publics`
--

CREATE TABLE IF NOT EXISTS `{inst_db_prefix}publics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `publicUniqueID` varchar(30) NOT NULL,
  `publicUUID` varchar(40) NOT NULL,
  `publicMessage` mediumtext,
  `userUniqueID` varchar(30) NOT NULL,
  `publicPassword` varchar(50) DEFAULT NULL,
  `publicLimit` int(11) DEFAULT NULL,
  `published` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cloud_publics`
--

-- --------------------------------------------------------

--
-- Table structure for table `cloud_sessions`
--

CREATE TABLE IF NOT EXISTS `{inst_db_prefix}sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cloud_sessions`
--


-- --------------------------------------------------------

--
-- Table structure for table `cloud_user`
--

CREATE TABLE IF NOT EXISTS `{inst_db_prefix}user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userUniqueID` varchar(30) NOT NULL,
  `companyName` varchar(255) NOT NULL,
  `timeZone` varchar(255) NOT NULL,
  `timeFormat` varchar(40) NOT NULL DEFAULT 'd.m.Y H:i',
  `password` varchar(255) NOT NULL,
  `emailAddress` varchar(255) NOT NULL,
  `userFile` mediumtext NOT NULL,
  `userURL` varchar(50) NOT NULL,
  `level` int(2) NOT NULL,
  `userReceiveNot` varchar(30) DEFAULT NULL,
  `userMaxFileSize` int(11) DEFAULT NULL,
  `userAcceptTypes` varchar(255) DEFAULT NULL,
  `userMaxNumFiles` int(3) DEFAULT NULL,
  `userCanUpload` ENUM( '0', '1' ) NOT NULL DEFAULT '1',
  `userCanDownload` ENUM( '0', '1' ) NOT NULL DEFAULT '1',
  `date_created` int(11) NOT NULL,
  `expire` int(11) NOT NULL,
  `defaultFolderID` varchar( 30 ) DEFAULT NULL,
  `published` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cloud_user`
--

INSERT INTO `{inst_db_prefix}user` (`id`, `userUniqueID`, `companyName`, `timeZone`, `timeFormat`, `password`, `emailAddress`, `userFile`, `userURL`, `level`, `userReceiveNot`, `userMaxFileSize`, `userAcceptTypes`, `userMaxNumFiles`, `date_created`, `expire`, `published`) VALUES
(NULL, '{inst_user_unique}', '{inst_admin_user}', '{inst_admin_timezone}', '{inst_admin_dateformat}', '{inst_admin_md5pass}', '{inst_admin_email}', '', '', 1, NULL, NULL, NULL, NULL, {inst_time_created}, 0, '1');

-- --------------------------------------------------------

--
-- Table structure for table `cloud_categories`
--

CREATE TABLE IF NOT EXISTS `{inst_db_prefix}categories` (
  `categoryID` int(11) NOT NULL AUTO_INCREMENT,
  `categoryUniqueID` varchar(30) NOT NULL,
  `categoryTitle` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`categoryID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cloud_files2cats`
--

CREATE TABLE IF NOT EXISTS `{inst_db_prefix}files2cats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fileUniqueID` varchar(30) NOT NULL,
  `categoryUniqueID` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Table structure for table `cloud_logs`
--

CREATE TABLE IF NOT EXISTS `{inst_db_prefix}logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `logUniqueID` varchar(30) NOT NULL,
  `logDataID` varchar(30) DEFAULT NULL,
  `logType` enum('error','info','down') NOT NULL DEFAULT 'info',
  `logMessage` mediumtext NOT NULL,
  `logTime` int(11) NOT NULL,
  `logIP` varchar(15) DEFAULT NULL,
  `logBrowser` varchar(255) DEFAULT NULL,
  `logSize` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cloud_uploads`
--

CREATE TABLE IF NOT EXISTS `{inst_db_prefix}uploads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uploadUniqueID` varchar(30) NOT NULL,
  `uploadUUID` varchar(40) NOT NULL,
  `uploadMessage` mediumtext,
  `userUniqueID` varchar(30) NOT NULL,
  `published` enum('0','1') NOT NULL DEFAULT '1',
  `defaultFolderID` VARCHAR( 30 ) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

--
-- Table structure for table `cloud_folders`
--

CREATE TABLE IF NOT EXISTS `{inst_db_prefix}folders` (
  id int(11) NOT NULL AUTO_INCREMENT,
  folderUniqueID varchar(30) NOT NULL,
  folderTitle varchar(150) NOT NULL,
  folderParent varchar(30) DEFAULT NULL,
  folderTime int(11) NOT NULL, 
  PRIMARY KEY (id)
) DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
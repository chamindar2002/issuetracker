-- phpMyAdmin SQL Dump
-- version 4.4.13.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 12, 2016 at 10:07 PM
-- Server version: 5.6.28-0ubuntu0.15.10.1
-- PHP Version: 5.6.11-1ubuntu3.1

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `issuestracking`
--
CREATE DATABASE IF NOT EXISTS `issuestracking` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `issuestracking`;

-- --------------------------------------------------------

--
-- Table structure for table `action_permission`
--

DROP TABLE IF EXISTS `action_permission`;
CREATE TABLE IF NOT EXISTS `action_permission` (
  `id` int(11) NOT NULL COMMENT 'Action ID',
  `module` varchar(50) NOT NULL COMMENT 'Module',
  `action` varchar(100) NOT NULL COMMENT 'Action Name',
  `description` varchar(150) NOT NULL COMMENT 'Description',
  `systemid` int(11) NOT NULL DEFAULT '0' COMMENT 'System ID Number'
) ENGINE=MyISAM AUTO_INCREMENT=155 DEFAULT CHARSET=latin1 COMMENT='Action Permission';

--
-- Dumping data for table `action_permission`
--

INSERT INTO `action_permission` (`id`, `module`, `action`, `description`, `systemid`) VALUES
(13, 'securitydata', 'index', '', 0),
(14, 'securitydata', 'listRoles', '', 0),
(15, 'securitydata', 'editRoles', '', 0),
(16, 'securitydata', 'updateRoles', '', 0),
(23, 'UserManager', 'index', '', 0),
(26, 'actionPermission', 'Create', '', 0),
(27, 'actionPermission', 'Update', '', 0),
(28, 'actionPermission', 'Delete', '', 0),
(29, 'actionPermission', 'Index', '', 0),
(30, 'securitydata', 'ListPermissions', '', 0),
(31, 'actionPermission', 'View', '', 0),
(38, 'user', 'Admin', '', 0),
(33, 'user', 'Create', '', 0),
(34, 'user', 'Update', '', 0),
(35, 'user', 'Delete', '', 0),
(36, 'user', 'Index', '', 0),
(37, 'user', 'View', '', 0),
(39, 'userRoleRef ', 'Admin', '', 0),
(40, 'userRoleRef ', 'Create', '', 0),
(41, 'userRoleRef ', 'Update', '', 0),
(42, 'userRoleRef ', 'Delete', '', 0),
(43, 'userRoleRef ', 'Index', '', 0),
(44, 'userRoleRef ', 'View', '', 0),
(150, 'issues', 'index', '', 0),
(151, 'issues', 'create', '', 0),
(152, 'issues', 'update', '', 0),
(153, 'issues', 'view', '', 0),
(154, 'issues', 'admin', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `issuefeedback`
--

DROP TABLE IF EXISTS `issuefeedback`;
CREATE TABLE IF NOT EXISTS `issuefeedback` (
  `id` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `issueid` int(11) NOT NULL,
  `createdby` int(11) NOT NULL,
  `createddate` datetime NOT NULL,
  `file1` varchar(255) NOT NULL,
  `file1type` varchar(255) NOT NULL,
  `file2` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `issuefeedback`
--

INSERT INTO `issuefeedback` (`id`, `comment`, `issueid`, `createdby`, `createddate`, `file1`, `file1type`, `file2`) VALUES
(1, 'check this out', 2, 1, '2016-06-12 10:02:54', '447157336138733696-DPTP-Switch-in-Robot-1.png', '', ''),
(2, 'check this out', 2, 1, '2016-06-12 10:04:31', '1311415101121110272-DPTP-Switch-in-Robot-1.png', '', ''),
(3, 'time delay', 2, 1, '2016-06-12 10:05:12', '2024540612970527744-dark-sensor-using-relay1.jpg', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `issues`
--

DROP TABLE IF EXISTS `issues`;
CREATE TABLE IF NOT EXISTS `issues` (
  `id` int(11) NOT NULL,
  `task` int(11) NOT NULL,
  `projectid` int(11) NOT NULL,
  `statusid` int(11) NOT NULL,
  `timeline` int(11) NOT NULL,
  `comments` text NOT NULL,
  `createdby` int(11) NOT NULL,
  `createddate` datetime NOT NULL,
  `lastmodifiedby` int(11) NOT NULL,
  `lastmodifieddate` datetime NOT NULL,
  `priority` int(11) NOT NULL,
  `issuetype` int(11) NOT NULL,
  `issue_category` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `issues`
--

INSERT INTO `issues` (`id`, `task`, `projectid`, `statusid`, `timeline`, `comments`, `createdby`, `createddate`, `lastmodifiedby`, `lastmodifieddate`, `priority`, `issuetype`, `issue_category`) VALUES
(1, 0, 1, 1, 2016, 'testing issue tracker', 1, '2016-06-12 09:54:35', 0, '0000-00-00 00:00:00', 1, 1, 1),
(2, 0, 1, 1, 2016, 'testing issue tracker', 1, '2016-06-12 09:56:57', 1, '2016-06-12 10:05:37', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `issuestatus`
--

DROP TABLE IF EXISTS `issuestatus`;
CREATE TABLE IF NOT EXISTS `issuestatus` (
  `id` int(11) NOT NULL,
  `statusname` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `issuestatus`
--

INSERT INTO `issuestatus` (`id`, `statusname`) VALUES
(1, 'Pending'),
(2, 'Done'),
(3, 'Closed');

-- --------------------------------------------------------

--
-- Table structure for table `issuetype`
--

DROP TABLE IF EXISTS `issuetype`;
CREATE TABLE IF NOT EXISTS `issuetype` (
  `id` int(11) NOT NULL,
  `issuetype` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `issuetype`
--

INSERT INTO `issuetype` (`id`, `issuetype`) VALUES
(1, 'UI'),
(2, 'Database'),
(3, 'Coding');

-- --------------------------------------------------------

--
-- Table structure for table `issue_categories`
--

DROP TABLE IF EXISTS `issue_categories`;
CREATE TABLE IF NOT EXISTS `issue_categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `issue_categories`
--

INSERT INTO `issue_categories` (`id`, `category_name`) VALUES
(1, 'issue category 1');

-- --------------------------------------------------------

--
-- Table structure for table `issue_severities`
--

DROP TABLE IF EXISTS `issue_severities`;
CREATE TABLE IF NOT EXISTS `issue_severities` (
  `id` int(11) NOT NULL,
  `severity_label` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `issue_severities`
--

INSERT INTO `issue_severities` (`id`, `severity_label`) VALUES
(1, 'Low'),
(2, 'Mid'),
(3, 'High'),
(4, 'Critical');

-- --------------------------------------------------------

--
-- Table structure for table `lng_languages`
--



--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL,
  `projectname` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `projectname`) VALUES
(1, 'Allison Project');

-- --------------------------------------------------------

--
-- Table structure for table `project_team`
--

DROP TABLE IF EXISTS `project_team`;
CREATE TABLE IF NOT EXISTS `project_team` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_team`
--

INSERT INTO `project_team` (`id`, `project_id`, `user_id`) VALUES
(1, 1, 8),
(2, 1, 8);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `rid` int(11) NOT NULL COMMENT 'Role ID',
  `name` varchar(20) NOT NULL COMMENT 'Role Name',
  `description` varchar(150) NOT NULL COMMENT 'Description'
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COMMENT='User Role';

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`rid`, `name`, `description`) VALUES
(1, 'Admin', 'Administrator'),
(2, 'Team Member', 'Team Member'),
(5, 'Client - Quasar', '');

-- --------------------------------------------------------

--
-- Table structure for table `role_action_permission_ref`
--

DROP TABLE IF EXISTS `role_action_permission_ref`;
CREATE TABLE IF NOT EXISTS `role_action_permission_ref` (
  `rid` int(11) NOT NULL,
  `aid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Role - Action_Permission Mapping';

--
-- Dumping data for table `role_action_permission_ref`
--

INSERT INTO `role_action_permission_ref` (`rid`, `aid`) VALUES
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 23),
(1, 26),
(1, 27),
(1, 28),
(1, 29),
(1, 30),
(1, 31),
(1, 33),
(1, 34),
(1, 35),
(1, 36),
(1, 37),
(1, 38),
(1, 39),
(1, 40),
(1, 41),
(1, 42),
(1, 43),
(1, 44),
(1, 150),
(1, 151),
(1, 152),
(1, 153),
(1, 154),
(2, 150),
(2, 151),
(2, 152),
(2, 153),
(2, 154),
(5, 150),
(5, 151),
(5, 152),
(5, 153),
(5, 154);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `uid` int(11) NOT NULL COMMENT 'User ID',
  `enabled` tinyint(4) NOT NULL COMMENT 'User is enabled',
  `loginname` varchar(200) NOT NULL COMMENT 'User Name',
  `familyname` varchar(200) NOT NULL COMMENT 'Family Name',
  `firstname` varchar(200) NOT NULL COMMENT 'First Name',
  `password` varchar(200) NOT NULL COMMENT 'Password',
  `club_id` int(11) NOT NULL DEFAULT '0',
  `deleted` tinyint(4) DEFAULT '0' COMMENT 'Delete Status'
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 COMMENT='User';

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `enabled`, `loginname`, `familyname`, `firstname`, `password`, `club_id`, `deleted`) VALUES
(1, 0, 'admin', 'admin', 'admin', '24b0712e91489671013c3bc67d4ec894', 0, 0),
(8, 0, 'bhashini', 'bhashini', 'bhashini', '3685014355f6c6bb23a1b60d6b17d9c3', 1, 0),
(9, 0, 'chameera@aranxa.com', 'chameera', 'chameera', '981d7697cf449eca2894f1a5e334f6b4', 1, 0),
(10, 0, 'thushara@aranxa.com', 'thushara', 'thushara', '2cd7a3b1ab1d3b3adc4bd2f98f5eb708', 1, 0),
(11, 0, 'ishara@aranxa.com', 'ishara', 'ishara', '2e826fdb73f8257b881a78ad24fb1aa8', 1, 0),
(12, 0, 'ayesha@aranxa.com', 'ayesha', 'ayesha', '35d0ae71fe2ee678501cc19b015fe4db', 1, 0),
(13, 0, 'quasarsoftware', 'quasar', 'software', 'ceb6c233536387139f654247048c5b4b', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_role_ref`
--

DROP TABLE IF EXISTS `user_role_ref`;
CREATE TABLE IF NOT EXISTS `user_role_ref` (
  `uid` int(11) NOT NULL,
  `rid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='User - Role Mapping';

--
-- Dumping data for table `user_role_ref`
--

INSERT INTO `user_role_ref` (`uid`, `rid`) VALUES
(1, 1),
(13, 5),
(9, 2),
(8, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `action_permission`
--
ALTER TABLE `action_permission`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `action_permission_U_1` (`module`,`action`);

--
-- Indexes for table `issuefeedback`
--
ALTER TABLE `issuefeedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issues`
--
ALTER TABLE `issues`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `issuestatus`
--
ALTER TABLE `issuestatus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issuetype`
--
ALTER TABLE `issuetype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issue_categories`
--
ALTER TABLE `issue_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issue_severities`
--
ALTER TABLE `issue_severities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lng_languages`
--
ALTER TABLE `lng_languages`
  ADD PRIMARY KEY (`language_code`);

--
-- Indexes for table `lng_module`
--
ALTER TABLE `lng_module`
  ADD PRIMARY KEY (`module_id`);

--
-- Indexes for table `lng_text_english`
--
ALTER TABLE `lng_text_english`
  ADD PRIMARY KEY (`english_label_id`);

--
-- Indexes for table `lng_text_translated`
--
ALTER TABLE `lng_text_translated`
  ADD PRIMARY KEY (`translated_label_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_team`
--
ALTER TABLE `project_team`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`rid`),
  ADD UNIQUE KEY `role_U_1` (`name`);

--
-- Indexes for table `role_action_permission_ref`
--
ALTER TABLE `role_action_permission_ref`
  ADD PRIMARY KEY (`rid`,`aid`),
  ADD KEY `role_action_permission_ref_FI_2` (`aid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `user_U_1` (`loginname`);

--
-- Indexes for table `user_role_ref`
--
ALTER TABLE `user_role_ref`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `user_role_ref_FI_2` (`rid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `action_permission`
--
ALTER TABLE `action_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Action ID',AUTO_INCREMENT=155;
--
-- AUTO_INCREMENT for table `issuefeedback`
--
ALTER TABLE `issuefeedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `issues`
--
ALTER TABLE `issues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `issuestatus`
--
ALTER TABLE `issuestatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `issuetype`
--
ALTER TABLE `issuetype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `issue_categories`
--
ALTER TABLE `issue_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `issue_severities`
--
ALTER TABLE `issue_severities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `lng_module`
--
ALTER TABLE `lng_module`
  MODIFY `module_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `lng_text_english`
--
ALTER TABLE `lng_text_english`
  MODIFY `english_label_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=388;
--
-- AUTO_INCREMENT for table `lng_text_translated`
--
ALTER TABLE `lng_text_translated`
  MODIFY `translated_label_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3111;
--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `project_team`
--
ALTER TABLE `project_team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Role ID',AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'User ID',AUTO_INCREMENT=14;SET FOREIGN_KEY_CHECKS=1;

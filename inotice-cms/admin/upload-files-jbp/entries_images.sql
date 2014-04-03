/*
MySQL Data Transfer
Source Host: localhost
Source Database: johnboy_uploadify
Target Host: localhost
Target Database: johnboy_uploadify
Date: 12/6/2011 11:42:45 AM
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for entries
-- ----------------------------
DROP TABLE IF EXISTS `entries`;
CREATE TABLE `entries` (
  `entry_id` int(11) NOT NULL auto_increment,
  `entry_title` varchar(255) default NULL,
  `entry_description` text,
  `entry_code` varchar(255) default NULL,
  PRIMARY KEY  (`entry_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for images
-- ----------------------------
DROP TABLE IF EXISTS `images`;
CREATE TABLE `images` (
  `image_id` int(11) NOT NULL auto_increment,
  `image_entry` varchar(255) default NULL,
  `image_file` varchar(255) default NULL,
  `image_code` varchar(255) default NULL,
  PRIMARY KEY  (`image_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records 
-- ----------------------------

/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50547
Source Host           : localhost:3306
Source Database       : zzyl

Target Server Type    : MYSQL
Target Server Version : 50547
File Encoding         : 65001

Date: 2016-09-11 19:37:49
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tp_flash
-- ----------------------------
DROP TABLE IF EXISTS `tp_flash`;
CREATE TABLE `tp_flash` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(200) DEFAULT NULL,
  `addtime` int(10) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_flash
-- ----------------------------
INSERT INTO `tp_flash` VALUES ('4', 'www.baidu.com', '0', '', '123');

-- ----------------------------
-- Table structure for tp_member
-- ----------------------------
DROP TABLE IF EXISTS `tp_member`;
CREATE TABLE `tp_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `openid` varchar(32) DEFAULT NULL,
  `vip` tinyint(1) DEFAULT '0',
  `headimg` varchar(200) DEFAULT NULL,
  `money` decimal(18,2) DEFAULT '0.00',
  `name` varchar(32) DEFAULT NULL COMMENT '名字',
  `sex` tinyint(1) DEFAULT '0',
  `idCard` char(18) DEFAULT NULL,
  `age` tinyint(1) DEFAULT '0',
  `mobile` varchar(11) DEFAULT NULL,
  `bailor` varchar(32) DEFAULT NULL COMMENT '委托人',
  `bailor_mobile` varchar(11) DEFAULT NULL,
  `domicile` varchar(50) DEFAULT NULL COMMENT '居住地',
  `diagnose` tinyint(1) DEFAULT NULL COMMENT '临床诊断',
  `illness_time` tinyint(1) DEFAULT '0' COMMENT '患病时间',
  `illness_history` text COMMENT '既往病史',
  `gm_history` text COMMENT '过敏史',
  `jz_history` text COMMENT '家族病史',
  `description` text COMMENT '自我评价',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_member
-- ----------------------------

-- ----------------------------
-- Table structure for tp_user
-- ----------------------------
DROP TABLE IF EXISTS `tp_user`;
CREATE TABLE `tp_user` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `group_id` tinyint(1) DEFAULT NULL,
  `name` varchar(32) NOT NULL,
  `pwd` varchar(32) NOT NULL,
  `createtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_user
-- ----------------------------
INSERT INTO `tp_user` VALUES ('1', '1', 'admin', 'e10adc3949ba59abbe56e057f20f883e', '2016-09-08 08:49:18');

-- ----------------------------
-- Table structure for tp_user_group
-- ----------------------------
DROP TABLE IF EXISTS `tp_user_group`;
CREATE TABLE `tp_user_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rules` varchar(32) DEFAULT NULL,
  `title` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_user_group
-- ----------------------------
INSERT INTO `tp_user_group` VALUES ('1', 'all', '超级管理员');
INSERT INTO `tp_user_group` VALUES ('2', '1', '医事审核');
INSERT INTO `tp_user_group` VALUES ('3', '2', '财务审核');
INSERT INTO `tp_user_group` VALUES ('4', '4', '普通管理员');

-- ----------------------------
-- Table structure for tp_weixin_config
-- ----------------------------
DROP TABLE IF EXISTS `tp_weixin_config`;
CREATE TABLE `tp_weixin_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `access_token` varchar(255) DEFAULT NULL,
  `appid` varchar(32) DEFAULT NULL,
  `secret` varchar(50) DEFAULT NULL,
  `dateline` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_weixin_config
-- ----------------------------
INSERT INTO `tp_weixin_config` VALUES ('1', 'PyBWkqqzJaR4l_N6upoESnegM9sN2WZwNOuxQvcwI48IsmxC6PURt6PFPpEXegzztfZrLQ7EYiR11dIUBvqpHlpf0RgNjCr4LbSW7veh720ICUiAJANHZ', 'wxfbd0f9376b82d480', '210a8301db410773f979b0f09ad19033', '1446732300');

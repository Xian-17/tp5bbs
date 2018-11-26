/*
Navicat MySQL Data Transfer

Source Server         : web
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : bbs

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-10-19 19:45:49
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for bbs_login
-- ----------------------------
DROP TABLE IF EXISTS `bbs_login`;
CREATE TABLE `bbs_login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` char(255) NOT NULL,
  `userpwd` char(255) NOT NULL,
  `usersalt` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bbs_login
-- ----------------------------
INSERT INTO `bbs_login` VALUES ('1', 'zhangsan', '99250fa86baad8a74eecc8e9abcdb863', '31626');
INSERT INTO `bbs_login` VALUES ('6', 'lisi', '99250fa86baad8a74eecc8e9abcdb863', '31626');
INSERT INTO `bbs_login` VALUES ('9', 'jack', '044ae5c7f23cbd5816a7db44b52791ab', '61394');

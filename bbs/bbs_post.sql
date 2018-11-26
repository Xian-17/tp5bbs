/*
Navicat MySQL Data Transfer

Source Server         : web
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : bbs

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-10-19 19:45:58
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for bbs_post
-- ----------------------------
DROP TABLE IF EXISTS `bbs_post`;
CREATE TABLE `bbs_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `ptitle` char(255) NOT NULL,
  `pcontent` char(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `u_id` (`uid`),
  CONSTRAINT `bbs_post_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `bbs_login` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bbs_post
-- ----------------------------
INSERT INTO `bbs_post` VALUES ('3', '6', '2ttt', '        we22    uuu');
INSERT INTO `bbs_post` VALUES ('4', '6', '3', 'we333\r\n567');
INSERT INTO `bbs_post` VALUES ('5', '6', '444', '                we444');
INSERT INTO `bbs_post` VALUES ('30', '1', 'test model', 'my name is usermodel');
INSERT INTO `bbs_post` VALUES ('31', '1', 'desc', '这是降序操作');
INSERT INTO `bbs_post` VALUES ('44', '1', '1019', '周五');
INSERT INTO `bbs_post` VALUES ('45', '1', 'hello', '你哈呀');
INSERT INTO `bbs_post` VALUES ('60', '9', 'alter', 'alteralterr');
INSERT INTO `bbs_post` VALUES ('63', '9', 'style', 'feel style');

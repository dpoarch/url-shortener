/*
 Navicat Premium Data Transfer

 Source Server         : locamysql
 Source Server Type    : MySQL
 Source Server Version : 50726
 Source Host           : localhost:3306
 Source Schema         : urlshortener

 Target Server Type    : MySQL
 Target Server Version : 50726
 File Encoding         : 65001

 Date: 02/10/2019 07:01:47
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for urls
-- ----------------------------
DROP TABLE IF EXISTS `urls`;
CREATE TABLE `urls`  (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `url` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `shorturl` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `clicks` bigint(255) NULL DEFAULT NULL,
  `datecreated` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of urls
-- ----------------------------
INSERT INTO `urls` VALUES (1, 'www.google.com', 'C5Qm6f9Dn', 2, '2019-10-02 10:52:53');
INSERT INTO `urls` VALUES (2, 'https://www.google.com', 'qMJyk7Lme', 1, '2019-10-02 10:55:45');
INSERT INTO `urls` VALUES (3, 'http://www.goog.com', 'bYXuSuAkc', 1, '2019-10-02 11:01:04');

SET FOREIGN_KEY_CHECKS = 1;

/*
 Navicat MySQL Data Transfer

 Source Server         : Local MySql
 Source Server Type    : MySQL
 Source Server Version : 50610
 Source Host           : 127.0.0.1
 Source Database       : rivulet

 Target Server Type    : MySQL
 Target Server Version : 50610
 File Encoding         : utf-8

 Date: 11/06/2016 23:08:46 PM
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `budget`
-- ----------------------------
DROP TABLE IF EXISTS `budget`;
CREATE TABLE `budget` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(10) unsigned NOT NULL,
  `code` varchar(8) NOT NULL,
  `cate_name` varchar(45) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `period` int(11) NOT NULL COMMENT '0-monthly; 1-yearly; 2-weekly',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `budget`
-- ----------------------------
BEGIN;
INSERT INTO `budget` VALUES ('6', '2', '1000', 'CLOTHES', '0.00', '0'), ('7', '2', '2000', 'FOOD', '0.00', '0'), ('8', '2', '3000', 'HOUSE', '0.00', '0'), ('9', '2', '4000', 'TRAFFIC', '0.00', '0'), ('10', '2', '5000', 'CANADA RETURN', '0.00', '0'), ('11', '2', '6000', 'SALARY', '0.00', '0'), ('12', '2', '7000', 'EDUCATION', '0.00', '0'), ('13', '2', '8000', 'ENTERTAINMENT', '0.00', '0'), ('14', '2', '9900', 'OTHER', '0.00', '0');
COMMIT;

-- ----------------------------
--  Table structure for `category`
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(8) NOT NULL,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `category`
-- ----------------------------
BEGIN;
INSERT INTO `category` VALUES ('1', '1000', 'CLOTHES'), ('2', '2000', 'FOOD'), ('3', '3000', 'HOUSE'), ('4', '4000', 'TRAFFIC'), ('5', '9900', 'OTHER'), ('10', '5000', 'CANADA RETURN'), ('11', '3001', 'MORTGAGE'), ('12', '4001', 'CAR LEASE'), ('13', '4002', 'CAR GAS'), ('14', '2001', 'RESTAURANT'), ('15', '6000', 'SALARY'), ('16', '3002', 'PROPERTY TAX'), ('17', '3003', 'MANAGEMENT FEE'), ('18', '7000', 'EDUCATION'), ('19', '7001', 'DAYCARE'), ('20', '8000', 'ENTERTAINMENT'), ('21', '8001', 'MOBILE'), ('22', '8002', 'CABLE');
COMMIT;

-- ----------------------------
--  Table structure for `transactions`
-- ----------------------------
DROP TABLE IF EXISTS `transactions`;
CREATE TABLE `transactions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `occur_time` date NOT NULL,
  `cate_code` varchar(8) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `direction` int(11) NOT NULL,
  `remark` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `transactions`
-- ----------------------------
BEGIN;
INSERT INTO `transactions` VALUES ('1', '1', '2016-10-20', '9900', '1.00', '1', 'test'), ('2', '1', '2016-10-25', '1000', '135.00', '-1', 'something'), ('3', '1', '2016-10-26', '1000', '56.00', '-1', 'buy t-shirt'), ('4', '1', '2016-10-26', '9900', '123.00', '1', 'return tax'), ('5', '1', '2016-10-27', '2000', '12.50', '-1', 'Lunch'), ('6', '1', '2016-10-27', '4000', '40.00', '-1', 'Gas'), ('7', '2', '2016-10-05', '5000', '174.25', '1', 'CANADA GST/TPS'), ('8', '2', '2016-10-07', '5000', '72.75', '1', 'CANADA PRO/PRO'), ('9', '2', '2016-10-07', '3001', '505.08', '-1', 'Mortgage bi-weekly'), ('10', '2', '2016-10-21', '3001', '505.08', '-1', 'Mortgage bi-weekly'), ('11', '2', '2016-10-26', '4001', '374.26', '-1', 'VW lease monthly'), ('12', '2', '2016-10-28', '4001', '649.26', '-1', 'Ford lease monthly'), ('13', '2', '2016-10-28', '9900', '35.00', '-1', 'Renew David\'s passport'), ('14', '2', '2016-10-01', '4002', '39.41', '-1', 'ESSO Toronto'), ('15', '2', '2016-10-02', '2001', '77.19', '-1', 'Dinner congee wong'), ('16', '2', '2016-10-04', '4002', '40.00', '-1', 'ESSO Willowdale'), ('17', '2', '2016-10-08', '4002', '40.00', '-1', 'ESSO Toronto'), ('18', '2', '2016-10-09', '4002', '42.30', '-1', 'Oxtongue lake'), ('19', '2', '2016-10-16', '4002', '40.00', '-1', 'Petrocan Toronto'), ('20', '2', '2016-10-18', '4002', '40.00', '-1', 'ESSO Toronto'), ('21', '2', '2016-10-30', '2000', '10.98', '-1', 'shoppers drug mart'), ('22', '2', '2016-10-31', '6000', '3728.93', '1', 'Derek\'s salary'), ('23', '2', '2016-10-14', '6000', '1531.34', '1', 'Natalie\'s salary'), ('24', '2', '2016-10-31', '6000', '1531.34', '1', 'Natalie\'s salary'), ('25', '2', '2016-10-01', '3003', '531.63', '-1', 'MANAGEMENT FEE'), ('26', '2', '2016-10-01', '7001', '150.00', '-1', 'David\'s daycare'), ('27', '2', '2016-10-10', '8001', '180.00', '-1', 'Fido'), ('28', '2', '2016-10-01', '8000', '10.00', '-1', 'Netfiex'), ('29', '2', '2016-10-01', '3002', '260.00', '-1', 'property tax');
COMMIT;

-- ----------------------------
--  Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `user_type` int(11) NOT NULL,
  `status` int(10) NOT NULL DEFAULT '0' COMMENT '0 - default init\n1 - actived\n2 - expired',
  `group` int(11) NOT NULL DEFAULT '0',
  `ip` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `user`
-- ----------------------------
BEGIN;
INSERT INTO `user` VALUES ('1', 'admin', '123456', '1', '1', '0', '127.0.0.1'), ('2', 'derek', '123456', '1', '1', '0', '127.0.0.1'), ('3', 'natalie', '123456', '2', '1', '0', '127.0.0.1');
COMMIT;

-- ----------------------------
--  Table structure for `user_signup`
-- ----------------------------
DROP TABLE IF EXISTS `user_signup`;
CREATE TABLE `user_signup` (
  `signup_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `status` int(10) NOT NULL DEFAULT '0' COMMENT '0 - default init\n1 - actived\n2 - expired',
  `activate_url` varchar(255) NOT NULL,
  `ip` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`signup_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `user_signup`
-- ----------------------------
BEGIN;
INSERT INTO `user_signup` VALUES ('1', 'derek', '123456', '1', 'http://localhost/?/user/activate/abcd1234', '127.0.0.1'), ('2', 'testuser1', '123456', '0', 'http://localhost/?/user/activate/abcd1234', '127.0.0.1');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;

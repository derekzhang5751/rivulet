/**
 * Author:  derek.z
 * Created: Sep 12, 2016
 */
CREATE TABLE `user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `user_type` int(11) NOT NULL,
  `status` int(10) NOT NULL DEFAULT '0' COMMENT '0 - default init\n1 - actived\n2 - expired',
  `ip` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(8) NOT NULL,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE `transactions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `occur_time` datetime NOT NULL,
  `cate_code` varchar(8) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `direction` int(11) NOT NULL,
  `remark` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `transactions` 
CHANGE COLUMN `occur_time` `occur_time` DATE NOT NULL ;

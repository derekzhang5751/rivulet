/**
 * Author:  derek.z
 * Created: Sep 12, 2016
 */
CREATE TABLE `user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `status` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '0 - default init1 - actived2 - expired',
  `ip` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `user_signup` (
  `signup_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `status` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '0 - default init1 - actived2 - expired',
  `activate_url` varchar(255) NOT NULL,
  `ip` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`signup_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

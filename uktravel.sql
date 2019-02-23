# Host: localhost  (Version: 5.5.53)
# Date: 2019-02-23 16:35:45
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "uk_admin"
#

DROP TABLE IF EXISTS `uk_admin`;
CREATE TABLE `uk_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `unicode` varchar(255) DEFAULT NULL,
  `realname` varchar(255) DEFAULT NULL,
  `state` tinyint(3) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

#
# Data for table "uk_admin"
#

/*!40000 ALTER TABLE `uk_admin` DISABLE KEYS */;
INSERT INTO `uk_admin` VALUES (1,'admin','houzhibing','888888','侯治兵',1),(2,'test','123456','201902231007346096','ceshi ',0);
/*!40000 ALTER TABLE `uk_admin` ENABLE KEYS */;

#
# Structure for table "uk_adminjur"
#

DROP TABLE IF EXISTS `uk_adminjur`;
CREATE TABLE `uk_adminjur` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Jurisdiction` tinytext,
  `userid` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

#
# Data for table "uk_adminjur"
#

/*!40000 ALTER TABLE `uk_adminjur` DISABLE KEYS */;
INSERT INTO `uk_adminjur` VALUES (1,'1,1,1,1,0,3,1|2,1,1,1,0,3,1|6,1,1,1,0,3,1|7,1,1,1,0,3,1|5,1,1,1,0,3,1','888888'),(2,'1,0,0,0,0,99,1|2,0,0,0,0,99,0|3,0,0,0,0,99,0|4,0,0,0,0,99,0|5,1,1,1,0,3,1|6,0,0,0,0,99,0|7,0,0,0,0,99,0','201902231007346096');
/*!40000 ALTER TABLE `uk_adminjur` ENABLE KEYS */;

#
# Structure for table "uk_apipass"
#

DROP TABLE IF EXISTS `uk_apipass`;
CREATE TABLE `uk_apipass` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `state` tinyint(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

#
# Data for table "uk_apipass"
#

/*!40000 ALTER TABLE `uk_apipass` DISABLE KEYS */;
INSERT INTO `uk_apipass` VALUES (1,'888888','888888',1);
/*!40000 ALTER TABLE `uk_apipass` ENABLE KEYS */;

#
# Structure for table "uk_base"
#

DROP TABLE IF EXISTS `uk_base`;
CREATE TABLE `uk_base` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "uk_base"
#

/*!40000 ALTER TABLE `uk_base` DISABLE KEYS */;
/*!40000 ALTER TABLE `uk_base` ENABLE KEYS */;

#
# Structure for table "uk_jur"
#

DROP TABLE IF EXISTS `uk_jur`;
CREATE TABLE `uk_jur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `lastid` tinyint(3) DEFAULT '0',
  `url` varchar(255) DEFAULT NULL,
  `sort` tinyint(3) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

#
# Data for table "uk_jur"
#

/*!40000 ALTER TABLE `uk_jur` DISABLE KEYS */;
INSERT INTO `uk_jur` VALUES (1,'订单管理','ddgl',0,'',0),(2,'系统设置','xtsz',0,NULL,0),(3,'管理员管理','glygl',0,NULL,0),(4,'查询统计','cxtj',0,NULL,0),(5,'订单列表','ddlb',1,'ddgl/orderslist.php',0),(6,'授权管理','sqgl',2,'xtgl\\sqgl.php',0),(7,'用户管理','yhgl',2,'xtgl/user.php',0);
/*!40000 ALTER TABLE `uk_jur` ENABLE KEYS */;

#
# Structure for table "uk_log"
#

DROP TABLE IF EXISTS `uk_log`;
CREATE TABLE `uk_log` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "uk_log"
#

/*!40000 ALTER TABLE `uk_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `uk_log` ENABLE KEYS */;

#
# Structure for table "uk_orders"
#

DROP TABLE IF EXISTS `uk_orders`;
CREATE TABLE `uk_orders` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) DEFAULT NULL,
  `cusname` varchar(255) DEFAULT NULL,
  `adultamount` tinyint(3) DEFAULT NULL,
  `chdamount` tinyint(3) DEFAULT NULL,
  `cusphone` varchar(255) DEFAULT NULL,
  `travelroad` varchar(255) DEFAULT NULL,
  `starttime` date DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `state` tinyint(3) DEFAULT '0',
  `orderid` varchar(40) NOT NULL DEFAULT '',
  `cratetime` datetime DEFAULT NULL,
  `onlycode` varchar(40) NOT NULL DEFAULT '',
  `travelstate` tinyint(3) DEFAULT '0',
  PRIMARY KEY (`Id`,`orderid`,`onlycode`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "uk_orders"
#

/*!40000 ALTER TABLE `uk_orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `uk_orders` ENABLE KEYS */;

#
# Structure for table "uk_user"
#

DROP TABLE IF EXISTS `uk_user`;
CREATE TABLE `uk_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `openid` varchar(255) DEFAULT NULL,
  `nickname` varchar(255) DEFAULT NULL,
  `sex` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `headimgurl` varchar(255) DEFAULT NULL,
  `lastpeople` varchar(255) DEFAULT NULL,
  `state` int(11) DEFAULT NULL,
  `realname` varchar(255) DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `hotelphone` varchar(255) DEFAULT NULL,
  `hotel` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "uk_user"
#

/*!40000 ALTER TABLE `uk_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `uk_user` ENABLE KEYS */;

#
# Structure for table "uk_usersjur"
#

DROP TABLE IF EXISTS `uk_usersjur`;
CREATE TABLE `uk_usersjur` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `lastid` tinyint(3) DEFAULT '0',
  `url` varchar(255) DEFAULT NULL,
  `sort` varchar(255) DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

#
# Data for table "uk_usersjur"
#

/*!40000 ALTER TABLE `uk_usersjur` DISABLE KEYS */;
INSERT INTO `uk_usersjur` VALUES (1,'订单管理','ddgl',0,NULL,'0');
/*!40000 ALTER TABLE `uk_usersjur` ENABLE KEYS */;

#
# Structure for table "uk_vchatconfig"
#

DROP TABLE IF EXISTS `uk_vchatconfig`;
CREATE TABLE `uk_vchatconfig` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "uk_vchatconfig"
#

/*!40000 ALTER TABLE `uk_vchatconfig` DISABLE KEYS */;
/*!40000 ALTER TABLE `uk_vchatconfig` ENABLE KEYS */;

#
# Structure for table "uk_vchatmsg"
#

DROP TABLE IF EXISTS `uk_vchatmsg`;
CREATE TABLE `uk_vchatmsg` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "uk_vchatmsg"
#

/*!40000 ALTER TABLE `uk_vchatmsg` DISABLE KEYS */;
/*!40000 ALTER TABLE `uk_vchatmsg` ENABLE KEYS */;

#
# Structure for table "uk_vchatmsgtemp"
#

DROP TABLE IF EXISTS `uk_vchatmsgtemp`;
CREATE TABLE `uk_vchatmsgtemp` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "uk_vchatmsgtemp"
#

/*!40000 ALTER TABLE `uk_vchatmsgtemp` DISABLE KEYS */;
/*!40000 ALTER TABLE `uk_vchatmsgtemp` ENABLE KEYS */;

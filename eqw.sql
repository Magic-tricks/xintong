# Host: localhost  (Version: 5.5.53)
# Date: 2018-10-09 16:43:10
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "qy_article"
#

DROP TABLE IF EXISTS `qy_article`;
CREATE TABLE `qy_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) DEFAULT NULL COMMENT '所属分类id',
  `title` varchar(100) DEFAULT NULL COMMENT '标题',
  `keyword` varchar(150) DEFAULT NULL COMMENT '关键字',
  `desc` varchar(200) DEFAULT NULL COMMENT '描述',
  `remark` varchar(200) DEFAULT NULL COMMENT '摘要',
  `author` varchar(50) DEFAULT NULL COMMENT '作者',
  `views` int(11) DEFAULT '0' COMMENT '浏览次数',
  `content` text COMMENT '内容',
  `addtime` int(10) DEFAULT '0' COMMENT '添加时间',
  `toptime` int(10) DEFAULT '0' COMMENT '置顶时间戳',
  `istop` tinyint(1) DEFAULT '0' COMMENT '是否置顶 1：置顶 0：不置顶',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 CHECKSUM=1 COMMENT='内容表';

#
# Data for table "qy_article"
#

/*!40000 ALTER TABLE `qy_article` DISABLE KEYS */;
INSERT INTO `qy_article` VALUES (1,1,'22222','','','','默认作者',0,NULL,1509975186,0,0),(2,1,'1111','111','111','1111','默认作者',0,'<p>1111111</p>',1509975242,1509975260,1),(3,4,'3333','3','','','默认作者',0,'<p>333333333</p>',1509975323,0,0),(4,1,'444444','4444','444','4444','默认作者',0,'<p>44444444444</p>',1509975410,0,0),(5,1,'66666','6666','','','默认作者',0,NULL,1509978999,0,0),(6,1,'11111111111111','','','','默认作者',0,NULL,1509979093,0,0),(7,1,'23424','2342342','','','默认作者',0,NULL,1509979273,0,0),(8,1,'232323232323','','','','默认作者',0,NULL,1509979749,0,0),(9,9,'内容测试','','','','默认作者',0,'<p>232424</p>',1510157742,0,0);
/*!40000 ALTER TABLE `qy_article` ENABLE KEYS */;

#
# Structure for table "qy_banner"
#

DROP TABLE IF EXISTS `qy_banner`;
CREATE TABLE `qy_banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '图片标题',
  `pic` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '图片地址',
  `url` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '跳转地址',
  `isshow` tinyint(1) DEFAULT '1' COMMENT '是否显示0不显示1显示',
  `sort` int(11) DEFAULT '100' COMMENT '排序',
  `remark` varchar(200) CHARACTER SET utf8 DEFAULT NULL COMMENT '介绍',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='轮播图表';

#
# Data for table "qy_banner"
#

/*!40000 ALTER TABLE `qy_banner` DISABLE KEYS */;
INSERT INTO `qy_banner` VALUES (28,'1','uploads\\20181008\\74ce93cd7947f69c83715272b0a3039b.jpg','',1,100,''),(29,'11','uploads\\20181008\\7465cba6fa27537d1b4d99bd2320ae37.jpg','',1,100,'');
/*!40000 ALTER TABLE `qy_banner` ENABLE KEYS */;

#
# Structure for table "qy_category"
#

DROP TABLE IF EXISTS `qy_category`;
CREATE TABLE `qy_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '栏目标识',
  `name` varchar(32) DEFAULT NULL COMMENT '栏目名称',
  `pid` int(11) DEFAULT NULL COMMENT '上级栏目标识',
  `type` tinyint(1) DEFAULT '1' COMMENT '1：列表 2：图片 3：单页',
  `sort` int(11) DEFAULT '100' COMMENT '排序',
  `pic` tinytext COMMENT '栏目图片',
  `keyword` varchar(100) DEFAULT NULL COMMENT '关键字',
  `desc` varchar(200) DEFAULT NULL COMMENT '描述信息',
  `remark` varchar(200) DEFAULT NULL COMMENT '摘要',
  `content` text COMMENT '内容',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='栏目表';

#
# Data for table "qy_category"
#

/*!40000 ALTER TABLE `qy_category` DISABLE KEYS */;
INSERT INTO `qy_category` VALUES (6,'首页',0,3,100,'','','','',NULL),(7,'产品故事',0,1,100,'','','','',NULL),(8,'产品展示',0,2,100,'','','','',NULL);
/*!40000 ALTER TABLE `qy_category` ENABLE KEYS */;

#
# Structure for table "qy_config"
#

DROP TABLE IF EXISTS `qy_config`;
CREATE TABLE `qy_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `config` text COMMENT '配置信息',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='配置信息';

#
# Data for table "qy_config"
#

/*!40000 ALTER TABLE `qy_config` DISABLE KEYS */;
INSERT INTO `qy_config` VALUES (2,'{\"title\":\"易风课堂\",\"logo\":\"logo.jpg\",\"keyword\":\"易风课堂,php入门,php实战\",\"desc\":\"易风课堂\",\"phone\":\"400-XXX-XXXX\",\"online\":\"4948268650\",\"address\":\"易风课堂-百度传课\",\"author\":\"默认作者\",\"state\":\"1\",\"closeinfo\":\"网站维护中，请稍后重试！\"}');
/*!40000 ALTER TABLE `qy_config` ENABLE KEYS */;

#
# Structure for table "qy_erji"
#

DROP TABLE IF EXISTS `qy_erji`;
CREATE TABLE `qy_erji` (
  `id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(32) DEFAULT NULL COMMENT '栏目名称',
  `pid` int(11) DEFAULT NULL COMMENT '上级栏目标识',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1:列表 2：图片 3：单页',
  `sort` int(11) DEFAULT '100' COMMENT '排序',
  `pic` tinytext COMMENT '栏目图片',
  `keyword` varchar(100) DEFAULT NULL COMMENT '关键字',
  `desc` varchar(200) DEFAULT NULL COMMENT '描述信息',
  `remark` varchar(200) DEFAULT NULL COMMENT '摘要',
  `content` text COMMENT '内容',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='二级栏目';

#
# Data for table "qy_erji"
#

/*!40000 ALTER TABLE `qy_erji` DISABLE KEYS */;
/*!40000 ALTER TABLE `qy_erji` ENABLE KEYS */;

#
# Structure for table "qy_erjineirong"
#

DROP TABLE IF EXISTS `qy_erjineirong`;
CREATE TABLE `qy_erjineirong` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) DEFAULT '0' COMMENT '所属分类id',
  `title` varchar(100) DEFAULT NULL COMMENT '标题',
  `keyword` varchar(150) DEFAULT NULL COMMENT '关键字',
  `desc` varchar(200) DEFAULT NULL COMMENT '描述',
  `remark` varchar(200) DEFAULT NULL COMMENT '摘要',
  `author` varchar(50) DEFAULT NULL COMMENT '作者',
  `views` int(11) DEFAULT '0' COMMENT '浏览次数',
  `content` text COMMENT '内容',
  `addtime` int(10) DEFAULT NULL COMMENT '添加时间',
  `toptime` int(10) DEFAULT NULL COMMENT '置顶时间戳',
  `istop` tinyint(1) DEFAULT '0' COMMENT '1：置顶 2：不置顶',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='二级内容';

#
# Data for table "qy_erjineirong"
#

/*!40000 ALTER TABLE `qy_erjineirong` DISABLE KEYS */;
/*!40000 ALTER TABLE `qy_erjineirong` ENABLE KEYS */;

#
# Structure for table "qy_erjipic"
#

DROP TABLE IF EXISTS `qy_erjipic`;
CREATE TABLE `qy_erjipic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aid` int(11) DEFAULT NULL,
  `pic` varchar(100) DEFAULT NULL COMMENT '图片地址',
  `sort` int(11) DEFAULT '10' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='二级图片';

#
# Data for table "qy_erjipic"
#

/*!40000 ALTER TABLE `qy_erjipic` DISABLE KEYS */;
/*!40000 ALTER TABLE `qy_erjipic` ENABLE KEYS */;

#
# Structure for table "qy_loginlog"
#

DROP TABLE IF EXISTS `qy_loginlog`;
CREATE TABLE `qy_loginlog` (
  `mid` int(11) NOT NULL DEFAULT '0' COMMENT '管理员id',
  `ip` char(15) DEFAULT '' COMMENT '登录ip',
  `logintime` int(10) DEFAULT '0' COMMENT '登录时间',
  `msg` varchar(80) DEFAULT NULL COMMENT '登录信息'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='管理员日志表';

#
# Data for table "qy_loginlog"
#

/*!40000 ALTER TABLE `qy_loginlog` DISABLE KEYS */;
INSERT INTO `qy_loginlog` VALUES (1,'127.0.0.1',1509956809,'登录成功'),(1,'127.0.0.1',1510153173,'登录成功'),(1,'127.0.0.1',1510206969,'登录成功'),(1,'127.0.0.1',1509805127,'登录成功');
/*!40000 ALTER TABLE `qy_loginlog` ENABLE KEYS */;

#
# Structure for table "qy_manager"
#

DROP TABLE IF EXISTS `qy_manager`;
CREATE TABLE `qy_manager` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '管理员id',
  `account` varchar(50) NOT NULL COMMENT '管理账号',
  `password` varchar(32) NOT NULL COMMENT '管理员密码',
  `state` tinyint(1) NOT NULL DEFAULT '1' COMMENT '账号状态 0：锁定，1：正常',
  PRIMARY KEY (`id`),
  UNIQUE KEY `account_UNIQUE` (`account`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

#
# Data for table "qy_manager"
#

/*!40000 ALTER TABLE `qy_manager` DISABLE KEYS */;
INSERT INTO `qy_manager` VALUES (1,'admin','e10adc3949ba59abbe56e057f20f883e',1),(2,'test','0b4e7a0e5fe84ad35fb5f95b9ceeac79',1),(3,'assf','e10adc3949ba59abbe56e057f20f883e',1),(4,'aaaa','96e79218965eb72c92a549dd5a330112',0),(5,'1111','96e79218965eb72c92a549dd5a330112',1),(6,'222222','e3ceb5881a0a1fdaad01296d7554868d',1),(11,'asfasdfsa','96e79218965eb72c92a549dd5a330112',1);
/*!40000 ALTER TABLE `qy_manager` ENABLE KEYS */;

#
# Structure for table "qy_pics"
#

DROP TABLE IF EXISTS `qy_pics`;
CREATE TABLE `qy_pics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aid` int(11) DEFAULT NULL COMMENT '内容id',
  `pic` varchar(100) DEFAULT NULL COMMENT '图片地址',
  `sort` int(11) DEFAULT '10' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='内容图片';

#
# Data for table "qy_pics"
#

/*!40000 ALTER TABLE `qy_pics` DISABLE KEYS */;
INSERT INTO `qy_pics` VALUES (1,4,'uploads\\20171106\\95f9bda45f921c211e45dd46efa8bc02.png',10),(2,4,'uploads\\20171106\\b49a4b6efdedff256cd9846789ab50bc.png',10);
/*!40000 ALTER TABLE `qy_pics` ENABLE KEYS */;

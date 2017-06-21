-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2017 �?06 �?14 �?05:54
-- 服务器版本: 5.5.53
-- PHP 版本: 5.5.38

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `cpzx`
--

-- --------------------------------------------------------

--
-- 表的结构 `tx_ad`
--

CREATE TABLE IF NOT EXISTS `tx_ad` (
  `id` mediumint(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) DEFAULT NULL COMMENT '广告名称',
  `url` varchar(255) DEFAULT NULL COMMENT '广告链接',
  `img` varchar(120) DEFAULT NULL COMMENT '图片地址',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `tx_ad`
--

INSERT INTO `tx_ad` (`id`, `name`, `url`, `img`) VALUES
(1, '右侧一', 'http://118.89.233.35:7878', '/upload/ad/1.jpg'),
(2, '右侧二', 'http://118.89.233.35:7878', '/upload/ad/2.jpg'),
(3, '右侧三', 'http://118.89.233.35:7878', '/upload/ad/3.jpg'),
(4, '底部一', 'http://118.89.233.35:7878', '/upload/ad/4.jpg');

-- --------------------------------------------------------

--
-- 表的结构 `tx_admin`
--

CREATE TABLE IF NOT EXISTS `tx_admin` (
  `id` mediumint(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `username` varchar(100) NOT NULL DEFAULT '' COMMENT '登录名',
  `password` varchar(255) NOT NULL COMMENT '用户密码',
  `ip_address` varchar(15) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `active` int(1) DEFAULT NULL COMMENT '是否活跃',
  `last_login` int(11) DEFAULT NULL COMMENT '最后登录',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `tx_admin`
--

INSERT INTO `tx_admin` (`id`, `username`, `password`, `ip_address`, `phone`, `email`, `active`, `last_login`) VALUES
(1, 'cpzx', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `tx_config`
--

CREATE TABLE IF NOT EXISTS `tx_config` (
  `id` int(100) NOT NULL COMMENT 'id',
  `name` varchar(255) DEFAULT NULL COMMENT '名称',
  `content` varchar(255) DEFAULT NULL COMMENT '内容',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tx_config`
--

INSERT INTO `tx_config` (`id`, `name`, `content`) VALUES
(1, 'web_name', '啪啪啪视频娱乐站'),
(2, 'web_logo', '/upload/config/logo.png'),
(3, 'web_url', '11111'),
(4, 'web_keywords', '11111'),
(5, 'web_inc', '1111'),
(6, 'web_admin', '111'),
(7, 'web_adminphone', '13013356789'),
(8, 'web_admintel', '1111'),
(9, 'web_adminqq', '11@qq.com'),
(10, 'web_address', 'aaaaa'),
(11, 'web_bottommes', 'aaaa'),
(12, 'web_kefuQQ', '12345');

-- --------------------------------------------------------

--
-- 表的结构 `tx_f_link`
--

CREATE TABLE IF NOT EXISTS `tx_f_link` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '链接ID',
  `title` varchar(100) CHARACTER SET utf8 NOT NULL COMMENT '链接名',
  `link` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '链接网址',
  `sort` smallint(3) NOT NULL COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `tx_f_link`
--

INSERT INTO `tx_f_link` (`id`, `title`, `link`, `sort`) VALUES
(1, '哈哈MX', 'http://www.baidu.com', 1),
(2, '牛男网', 'http://118.89.233.35:7878', 2);

-- --------------------------------------------------------

--
-- 表的结构 `tx_img`
--

CREATE TABLE IF NOT EXISTS `tx_img` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(120) NOT NULL DEFAULT '' COMMENT '新闻题目',
  `source` varchar(120) NOT NULL COMMENT '来源',
  `abstract` varchar(255) NOT NULL COMMENT '简介',
  `img` varchar(255) DEFAULT '' COMMENT '新闻首图',
  `addtime` char(32) NOT NULL DEFAULT '' COMMENT '新闻添加时间',
  `author` char(36) DEFAULT '' COMMENT '发布作者',
  `click` int(10) NOT NULL DEFAULT '0' COMMENT '新闻热度',
  `comment` int(10) DEFAULT '0' COMMENT '新闻评论数',
  `status` int(1) DEFAULT '0' COMMENT '状态 -1.禁止查看 1.普通 2.专题首条 3.轮播首页',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `tx_img`
--

INSERT INTO `tx_img` (`id`, `title`, `source`, `abstract`, `img`, `addtime`, `author`, `click`, `comment`, `status`) VALUES
(3, '美女1', '', '', '/upload/a/170428/170428023036121.jpg', '2017-04-28 14:30', '1', 0, 0, 1),
(4, '美女2', '', '', '/upload/a/170428/170428023317248.jpg', '2017-04-28 14:33', '1', 0, 0, 1),
(5, '美女', '', '', '/upload/a/170428/170428023849847.jpg', '2017-04-28 14:39', '1', 0, 0, 1),
(6, '美女3', '', '', '/upload/a/170428/170428041129543.jpg', '2017-04-28 16:12', '1', 0, 0, 1),
(7, '彩票美女', '', '', '/upload/a/170428/170428041902543.jpg', '2017-04-28 16:19', '1', 0, 0, 0),
(8, '彩票美女', '', '', '/upload/a/170428/170428041902543.jpg', '2017-04-28 16:19', '1', 0, 0, 1),
(9, '彩票美女', '', '', '/upload/a/170502/170502093031325.jpg', '2017-05-02 09:31', '1', 0, 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `tx_img_content`
--

CREATE TABLE IF NOT EXISTS `tx_img_content` (
  `listid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id` int(10) NOT NULL COMMENT '主新闻id',
  `content` text NOT NULL,
  PRIMARY KEY (`listid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `tx_img_content`
--

INSERT INTO `tx_img_content` (`listid`, `id`, `content`) VALUES
(3, 3, '["\\/upload\\/a\\/170428\\/170428023045702.jpg","\\/upload\\/a\\/170428\\/170428023045574.jpg","\\/upload\\/a\\/170428\\/170428023045953.jpg","\\/upload\\/a\\/170428\\/170428023045931.jpg"]'),
(4, 4, '["\\/upload\\/a\\/170428\\/170428023330864.jpg","\\/upload\\/a\\/170428\\/170428023330886.jpg","\\/upload\\/a\\/170428\\/170428023330530.jpg","\\/upload\\/a\\/170428\\/170428023330930.jpg"]'),
(5, 5, '["\\/upload\\/a\\/170428\\/170428023903990.jpg","\\/upload\\/a\\/170428\\/170428023903742.jpg","\\/upload\\/a\\/170428\\/170428023903312.jpg","\\/upload\\/a\\/170428\\/170428023903150.jpg"]'),
(6, 6, '["\\/upload\\/a\\/170428\\/170428041205554.jpg","\\/upload\\/a\\/170428\\/17042804120545.jpg","\\/upload\\/a\\/170428\\/170428041205105.jpg","\\/upload\\/a\\/170428\\/170428041205583.jpg","\\/upload\\/a\\/170428\\/170428041205291.jpg","\\/upload\\/a\\/170428\\/170428041205224.jpg"]'),
(7, 7, '["\\/upload\\/a\\/170428\\/170428041922138.jpg","\\/upload\\/a\\/170428\\/170428041922795.jpg"]'),
(8, 8, '["\\/upload\\/a\\/170428\\/170428041922138.jpg","\\/upload\\/a\\/170428\\/170428041922795.jpg"]'),
(9, 9, '["\\/upload\\/a\\/170502\\/170502093106843.jpg","\\/upload\\/a\\/170502\\/170502093106837.jpg","\\/upload\\/a\\/170502\\/170502093106678.jpg","\\/upload\\/a\\/170502\\/170502093106408.jpg","\\/upload\\/a\\/170502\\/170502093106917.jpg","\\/upload\\/a\\/170502\\/170502093106440.jpg","\\/upload\\/a\\/170502\\/170502093106117.jpg","\\/upload\\/a\\/170502\\/170502093106404.jpg"]');

-- --------------------------------------------------------

--
-- 表的结构 `tx_news`
--

CREATE TABLE IF NOT EXISTS `tx_news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `typeid` int(10) NOT NULL COMMENT '新闻类型',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '新闻题目',
  `shorttitle` varchar(255) DEFAULT NULL COMMENT '短标题',
  `img2` varchar(255) DEFAULT NULL COMMENT '备用图片字段',
  `img` varchar(255) DEFAULT '' COMMENT '新闻首图',
  `abstract` varchar(255) DEFAULT '' COMMENT '新闻简介',
  `addtime` char(32) NOT NULL DEFAULT '' COMMENT '新闻添加时间',
  `newstime` char(32) NOT NULL DEFAULT '' COMMENT '新闻发布时间',
  `author` char(36) DEFAULT '' COMMENT '发布作者',
  `click` int(10) NOT NULL DEFAULT '0' COMMENT '新闻热度',
  `comment` int(10) DEFAULT '0' COMMENT '新闻评论数',
  `status` int(1) DEFAULT '0' COMMENT '状态 -1.禁止查看 1.普通 2.专题首条 3.轮播首页',
  `good` int(10) DEFAULT '0',
  `bad` int(10) DEFAULT '0',
  `tag` varchar(255) DEFAULT NULL COMMENT '标签',
  `source` varchar(255) DEFAULT NULL COMMENT '来源',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=51 ;

--
-- 转存表中的数据 `tx_news`
--

INSERT INTO `tx_news` (`id`, `typeid`, `title`, `shorttitle`, `img2`, `img`, `abstract`, `addtime`, `newstime`, `author`, `click`, `comment`, `status`, `good`, `bad`, `tag`, `source`) VALUES
(25, 2, '11', '11', '', '/upload/a/170613/170613090640455.jpg', '11', '2017-06-13 09:07', '2017-06-13 09:07', '1', 63, 0, 3, 0, 0, '', '11'),
(26, 1, '22', '22', '', '/upload/a/170613/170613091213445.jpg', '22', '2017-06-13 09:12', '2017-06-13 09:12', '22', 17, 0, 1, 0, 0, '', '22'),
(27, 3, '33', '33', '', '/upload/a/170613/17061309160277.jpg', '3333', '2017-06-13 09:16', '2017-06-13 09:16', '1', 347, 0, 3, 0, 0, '', '33'),
(32, 1, '88', '88', '', '/upload/a/170613/170613092326873.jpg', '88', '2017-06-13 09:23', '2017-06-13 09:23', '88', 23, 0, 1, 0, 0, '', '88'),
(33, 6, '44', '44', '', '/upload/a/170613/170613092603234.jpg', '44', '2017-06-13 09:26', '2017-06-13 09:26', '1', 33, 0, 1, 0, 0, '', '44'),
(35, 9, '66', '66', '', '/upload/a/170613/170613044039168.jpg', '66', '2017-06-13 16:41', '2017-06-13 16:41', '1', 3, 0, 3, 0, 0, '', '66'),
(36, 9, '77', '77', '', '/upload/a/170613/17061304432543.jpg', '77', '2017-06-13 16:43', '2017-06-13 16:43', '1', 1, 0, 1, 0, 0, '', '77'),
(37, 9, '111', '111', '', '/upload/a/170613/170613051348748.jpg', '6666', '2017-06-13 17:13', '2017-06-13 17:13', '1', 2, 0, 1, 0, 0, '', '11'),
(38, 9, 'ff', 'ff', '', '/upload/a/170613/170613052605434.jpg', 'ffff', '2017-06-13 17:26', '2017-06-13 17:26', '1', 2, 0, 1, 0, 0, '', 'ff'),
(39, 5, 'aa', 'aa', '', '/upload/a/170614/170614084845259.jpg', 'aa', '2017-06-14 08:48', '2017-06-14 08:48', '1', 0, 0, 1, 0, 0, '', 'aa'),
(49, 5, '123', '123', '', '/upload/a/170614/170614103003779.jpg', '123', '2017-06-14 10:30', '2017-06-14 10:30', '1', 0, 0, 1, 0, 0, '', '123'),
(50, 1, '123', '123', '', '/upload/a/170614/170614103551672.jpg', '123', '2017-06-14 10:35', '2017-06-14 10:35', '123', 3, 0, 1, 0, 0, '', '123');

-- --------------------------------------------------------

--
-- 表的结构 `tx_news_content`
--

CREATE TABLE IF NOT EXISTS `tx_news_content` (
  `listid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id` int(10) NOT NULL COMMENT '主新闻id',
  `content` text NOT NULL,
  PRIMARY KEY (`listid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=51 ;

--
-- 转存表中的数据 `tx_news_content`
--

INSERT INTO `tx_news_content` (`listid`, `id`, `content`) VALUES
(25, 25, '/upload/a/170613video/pre_03e0704b5690a2dee1861dc3ad3316c91497316013.mp4'),
(26, 26, '/upload/a/170613video/pre_0a934ecab584f7a4cd0220a7caeccbcc1497316353.mp4'),
(27, 27, '/upload/a/170613video/pre_e077e1a544eec4f0307cf5c3c721d9441497316572.mp4'),
(32, 32, 'yyy'),
(33, 33, 'yyy'),
(35, 35, '/upload/a/170613video/pre_fce34b6aef091b6fb2032870279690f81497343257.mp4'),
(36, 36, '/upload/a/170613video/pre_cec6f62cfb44b1be110b7bf70c8362d81497343415.mp4'),
(37, 37, 'yyy'),
(38, 38, 'yyy'),
(39, 39, 'yyy'),
(49, 49, 'yyy'),
(50, 50, 'yyy');

-- --------------------------------------------------------

--
-- 表的结构 `tx_news_status`
--

CREATE TABLE IF NOT EXISTS `tx_news_status` (
  `id` int(10) NOT NULL,
  `name` char(32) DEFAULT NULL COMMENT '类型名',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tx_news_status`
--

INSERT INTO `tx_news_status` (`id`, `name`) VALUES
(0, '禁止显示'),
(1, '普通新闻'),
(2, '置顶新闻'),
(3, '轮播新闻');

-- --------------------------------------------------------

--
-- 表的结构 `tx_news_tag`
--

CREATE TABLE IF NOT EXISTS `tx_news_tag` (
  `id` mediumint(10) unsigned NOT NULL AUTO_INCREMENT,
  `tagname` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '标签名',
  `click` int(10) NOT NULL DEFAULT '0' COMMENT '游览量',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- 转存表中的数据 `tx_news_tag`
--

INSERT INTO `tx_news_tag` (`id`, `tagname`, `click`) VALUES
(1, '1111', 2),
(2, '11111', 0),
(3, '111', 0),
(4, '大乐透', 15),
(5, '双色球', 13),
(6, 'aaaa', 3),
(7, 'bbb', 3),
(8, 'ccc', 2),
(9, '山东23选5', 0),
(10, '福彩15选5玩法', 3),
(11, '具有丰富创意的培根彩票', 3),
(12, '1', 37),
(13, '88', 1),
(14, '44', 0),
(15, '22', 0);

-- --------------------------------------------------------

--
-- 表的结构 `tx_news_type`
--

CREATE TABLE IF NOT EXISTS `tx_news_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(32) NOT NULL COMMENT '类型名',
  `sort` smallint(3) NOT NULL COMMENT '优先级',
  `key` int(11) NOT NULL,
  `info` int(11) NOT NULL,
  `status` smallint(1) NOT NULL DEFAULT '0' COMMENT '栏目状态 0显示 1隐藏',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `tx_news_type`
--

INSERT INTO `tx_news_type` (`id`, `name`, `sort`, `key`, `info`, `status`) VALUES
(1, '欢乐精选', 1, 1, 1, 0),
(2, '奇闻趣事', 2, 3, 2, 0),
(3, '搞笑达人', 3, 3, 3, 0),
(4, '原创恶搞', 4, 4, 4, 0),
(5, '雷人囧事', 5, 5, 5, 0),
(6, '最强吐槽', 6, 6, 6, 0),
(7, '恶搞新编', 7, 7, 7, 0),
(8, '福利视频APP', 8, 8, 8, 0),
(9, '美女', 9, 9, 9, 0);

-- --------------------------------------------------------

--
-- 表的结构 `tx_vote`
--

CREATE TABLE IF NOT EXISTS `tx_vote` (
  `nid` int(11) unsigned NOT NULL,
  `vote` varchar(32) NOT NULL,
  `dvote` varchar(32) NOT NULL,
  `ip` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tx_vote`
--

INSERT INTO `tx_vote` (`nid`, `vote`, `dvote`, `ip`) VALUES
(27, '1', '', '12.0.0.1'),
(32, '1', '', '127.0.0.1'),
(25, '', '0', '127.0.0.1'),
(27, '1', '', '127.0.0.2'),
(27, '', '0', '127.0.0.3'),
(27, '1', '', '127.0.0.4'),
(27, '', '0', '127.0.0.1'),
(33, '1', '', '127.0.0.1'),
(35, '1', '', '127.0.0.1'),
(37, '', '0', '127.0.0.1'),
(38, '1', '', '127.0.0.1'),
(26, '', '0', '127.0.0.1'),
(50, '1', '', '127.0.0.1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

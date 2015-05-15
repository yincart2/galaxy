-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 05 月 15 日 06:30
-- 服务器版本: 5.6.12-log
-- PHP 版本: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `yincart-home-new`
--
CREATE DATABASE IF NOT EXISTS `yincart-home-new` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `yincart-home-new`;

-- --------------------------------------------------------

--
-- 表的结构 `auth_assignment`
--

CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `auth_item`
--

CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `auth_item_child`
--

CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `auth_rule`
--

CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `parent_id` int(12) DEFAULT NULL,
  `post_id` int(12) NOT NULL,
  `user_id` int(12) NOT NULL DEFAULT '0',
  `text` text,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `owner_name` (`post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- 表的结构 `friend_link`
--

CREATE TABLE IF NOT EXISTS `friend_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `pic` varchar(255) NOT NULL,
  `url` varchar(200) NOT NULL,
  `memo` text NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT '255',
  `language` varchar(45) NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=66 ;

-- --------------------------------------------------------

--
-- 表的结构 `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `item_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Item ID',
  `category_id` int(10) unsigned NOT NULL COMMENT 'Category ID',
  `outer_id` varchar(45) DEFAULT NULL,
  `title` varchar(255) NOT NULL COMMENT '名称',
  `stock` int(10) unsigned NOT NULL COMMENT '库存',
  `min_number` int(10) unsigned NOT NULL DEFAULT '1' COMMENT '最少订货量',
  `price` decimal(10,2) unsigned NOT NULL COMMENT '价格',
  `currency` varchar(20) NOT NULL COMMENT '币种',
  `props` longtext NOT NULL COMMENT '商品属性 格式：pid:vid;pid:vid',
  `props_name` longtext NOT NULL COMMENT '商品属性名称。标识着props内容里面的pid和vid所对应的名称。格式为：pid1:vid1:pid_name1:vid_name1;pid2:vid2:pid_name2:vid_name2……(注：属性名称中的冒号":"被转换为："#cln#"; 分号";"被转换为："#scln#" )',
  `desc` longtext NOT NULL COMMENT '描述',
  `shipping_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '运费',
  `is_show` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否显示',
  `is_promote` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否促销',
  `is_new` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否新品',
  `is_hot` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否热销',
  `is_best` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否精品',
  `click_count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '点击量',
  `wish_count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '收藏数',
  `review_count` int(10) NOT NULL,
  `deal_count` int(10) NOT NULL,
  `create_time` int(10) unsigned NOT NULL COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL COMMENT '更新时间',
  `language` varchar(45) NOT NULL,
  `country` int(10) unsigned NOT NULL,
  `state` int(10) unsigned NOT NULL,
  `city` int(10) unsigned NOT NULL,
  PRIMARY KEY (`item_id`),
  KEY `fk_item_category1_idx` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=60 ;

-- --------------------------------------------------------

--
-- 表的结构 `item_img`
--

CREATE TABLE IF NOT EXISTS `item_img` (
  `img_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Item Img ID',
  `item_id` int(10) unsigned NOT NULL COMMENT 'Item ID',
  `pic` varchar(255) NOT NULL COMMENT '图片url',
  `position` tinyint(3) unsigned NOT NULL COMMENT '图片位置',
  `create_time` int(10) unsigned NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`img_id`),
  KEY `fk_item_img_item1_idx` (`item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

-- --------------------------------------------------------

--
-- 表的结构 `item_prop`
--

CREATE TABLE IF NOT EXISTS `item_prop` (
  `prop_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '属性 ID 例：品牌的PID=20000',
  `category_id` int(10) unsigned NOT NULL,
  `parent_prop_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级属性ID',
  `parent_value_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级属性值ID',
  `prop_name` varchar(100) NOT NULL COMMENT '属性名称',
  `prop_alias` varchar(100) DEFAULT NULL COMMENT '属性别名',
  `type` tinyint(1) unsigned NOT NULL COMMENT '属性值类型。可选值：input(输入)、optional（枚举）multiCheck （多选）',
  `is_key_prop` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否关键属性。可选值:1(是),0(否),搜索属性',
  `is_sale_prop` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否销售属性。可选值:1(是),0(否)',
  `is_color_prop` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否颜色属性。可选值:1(是),0(否)',
  `must` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '发布产品或商品时是否为必选属性。可选值:1(是),0(否)',
  `multi` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '发布产品或商品时是否可以多选。可选值:1(是),0(否)',
  `status` tinyint(1) unsigned DEFAULT '0' COMMENT '状态。可选值:0(正常),1(删除)',
  `sort_order` tinyint(3) unsigned DEFAULT '255' COMMENT '排序',
  PRIMARY KEY (`prop_id`),
  KEY `fk_item_prop_category1_idx` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

-- --------------------------------------------------------

--
-- 表的结构 `lookup`
--

CREATE TABLE IF NOT EXISTS `lookup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `code` int(11) NOT NULL,
  `type` varchar(128) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- 表的结构 `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `route` varchar(256) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `data` text,
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) CHARACTER SET utf8 NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) DEFAULT '0',
  `language_id` int(11) DEFAULT '0',
  `star_id` int(11) DEFAULT '0',
  `cluster_id` int(11) DEFAULT '0',
  `station_id` int(11) DEFAULT '0',
  `title` varchar(200) NOT NULL,
  `url` varchar(100) DEFAULT NULL,
  `source` varchar(50) DEFAULT NULL,
  `summary` text,
  `content` text NOT NULL,
  `tags` text,
  `status` int(11) DEFAULT NULL,
  `views` int(11) NOT NULL DEFAULT '0',
  `allow_comment` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:allow;1:forbid',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_post_author` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=184 ;

-- --------------------------------------------------------

--
-- 表的结构 `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `detail` text NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `product_model`
--

CREATE TABLE IF NOT EXISTS `product_model` (
  `id` int(11) NOT NULL,
  `model` varchar(200) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `public_email` varchar(255) DEFAULT NULL,
  `gravatar_email` varchar(255) DEFAULT NULL,
  `gravatar_id` varchar(32) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `bio` text,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `prop_img`
--

CREATE TABLE IF NOT EXISTS `prop_img` (
  `prop_img_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Prop Img ID',
  `item_id` int(10) unsigned NOT NULL COMMENT 'Item ID',
  `item_prop_value` varchar(255) NOT NULL COMMENT '图片所对应的属性组合的字符串',
  `pic` varchar(255) NOT NULL COMMENT '图片url',
  `create_time` int(10) unsigned NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`prop_img_id`),
  KEY `fk_prop_img_item1_idx` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `prop_value`
--

CREATE TABLE IF NOT EXISTS `prop_value` (
  `value_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '属性值ID',
  `prop_id` int(10) unsigned NOT NULL,
  `value_name` varchar(45) NOT NULL COMMENT '属性值',
  `value_alias` varchar(45) NOT NULL COMMENT '属性值别名',
  `status` tinyint(1) unsigned NOT NULL COMMENT '状态。可选值:normal(正常),deleted(删除)',
  `sort_order` tinyint(3) unsigned NOT NULL DEFAULT '255' COMMENT '排列序号。取值范围:大于零的整数',
  PRIMARY KEY (`value_id`),
  KEY `fk_prop_value_item_prop1_idx` (`prop_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=60 ;

-- --------------------------------------------------------

--
-- 表的结构 `sku`
--

CREATE TABLE IF NOT EXISTS `sku` (
  `sku_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'SKU ID',
  `item_id` int(10) unsigned NOT NULL COMMENT 'Item ID',
  `tag` varchar(45) NOT NULL,
  `props` longtext NOT NULL COMMENT 'sku的销售属性组合字符串（颜色，大小，等等，可通过类目API获取某类目下的销售属性）,格式是p1:v1;p2:v2',
  `props_name` longtext NOT NULL COMMENT 'sku所对应的销售属性的中文名字串，格式如：pid1:vid1:pid_name1:vid_name1;pid2:vid2:pid_name2:vid_name2……',
  `quantity` int(10) unsigned NOT NULL COMMENT 'sku商品库存',
  `price` decimal(10,2) unsigned NOT NULL COMMENT 'sku的商品价格',
  `outer_id` varchar(45) NOT NULL COMMENT '商家设置的外部id',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT 'sku状态。 normal:正常 ；delete:删除',
  PRIMARY KEY (`sku_id`),
  KEY `fk_sku_item1_idx` (`item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=81 ;

-- --------------------------------------------------------

--
-- 表的结构 `social_account`
--

CREATE TABLE IF NOT EXISTS `social_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `provider` varchar(255) NOT NULL,
  `client_id` varchar(255) NOT NULL,
  `data` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `account_unique` (`provider`,`client_id`),
  KEY `fk_user_account` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `star`
--

CREATE TABLE IF NOT EXISTS `star` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `skin_id` int(11) DEFAULT NULL,
  `cluster_id` int(11) DEFAULT NULL,
  `station_id` int(11) DEFAULT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_alias` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `domain` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` tinyint(1) DEFAULT NULL,
  `detail` text COLLATE utf8_unicode_ci,
  `start_date` int(11) DEFAULT NULL,
  `end_date` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `station`
--

CREATE TABLE IF NOT EXISTS `station` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `detail` text COLLATE utf8_unicode_ci,
  `enabled` tinyint(1) NOT NULL DEFAULT '0',
  `start_date` int(11) DEFAULT NULL,
  `end_date` int(11) DEFAULT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- 表的结构 `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `frequency` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

-- --------------------------------------------------------

--
-- 表的结构 `token`
--

CREATE TABLE IF NOT EXISTS `token` (
  `user_id` int(11) NOT NULL,
  `code` varchar(32) NOT NULL,
  `created_at` int(11) NOT NULL,
  `type` smallint(6) NOT NULL,
  UNIQUE KEY `token_unique` (`user_id`,`code`,`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tree`
--

CREATE TABLE IF NOT EXISTS `tree` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `root` int(10) unsigned DEFAULT NULL,
  `lft` int(10) unsigned NOT NULL,
  `rgt` int(10) unsigned NOT NULL,
  `level` smallint(5) unsigned NOT NULL,
  `type` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `root` (`root`),
  KEY `lft` (`lft`),
  KEY `rgt` (`rgt`),
  KEY `level` (`level`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=38 ;

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(60) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `confirmed_at` int(11) DEFAULT NULL,
  `unconfirmed_email` varchar(255) DEFAULT NULL,
  `blocked_at` int(11) DEFAULT NULL,
  `registration_ip` varchar(45) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `flags` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_unique_username` (`username`),
  UNIQUE KEY `user_unique_email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=157 ;

--
-- 限制导出的表
--

--
-- 限制表 `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- 限制表 `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `item_img`
--
ALTER TABLE `item_img`
  ADD CONSTRAINT `fk_item_img_item1` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- 限制表 `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `menu` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- 限制表 `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `fk_user_profile` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- 限制表 `prop_img`
--
ALTER TABLE `prop_img`
  ADD CONSTRAINT `fk_prop_img_item1` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- 限制表 `prop_value`
--
ALTER TABLE `prop_value`
  ADD CONSTRAINT `fk_prop_value_item_prop1` FOREIGN KEY (`prop_id`) REFERENCES `item_prop` (`prop_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- 限制表 `sku`
--
ALTER TABLE `sku`
  ADD CONSTRAINT `fk_sku_item1` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- 限制表 `social_account`
--
ALTER TABLE `social_account`
  ADD CONSTRAINT `fk_user_account` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- 限制表 `token`
--
ALTER TABLE `token`
  ADD CONSTRAINT `fk_user_token` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

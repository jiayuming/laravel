-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2018 �?08 �?01 �?07:53
-- 服务器版本: 5.5.53
-- PHP 版本: 5.6.27

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `laraveladmin`
--
CREATE DATABASE `laraveladmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `laraveladmin`;

-- --------------------------------------------------------

--
-- 表的结构 `laravel_menus`
--

CREATE TABLE IF NOT EXISTS `laravel_menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `class_id` varchar(20) NOT NULL,
  `target` varchar(10) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`),
  KEY `class_id` (`class_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `laravel_menus`
--

INSERT INTO `laravel_menus` (`id`, `name`, `parent_id`, `type`, `address`, `class_id`, `target`, `status`, `created_at`, `updated_at`) VALUES
(1, '首页', 0, 1, '/', '', '', 1, '2018-02-09 06:17:34', '2018-02-09 06:17:34'),
(2, '新闻中心', 0, 2, '', '1-1', '', 1, '2018-02-09 06:21:35', '2018-02-09 06:21:35'),
(3, '测试菜单', 0, 2, '', '1-1', '_blank', 1, '2018-02-09 06:33:41', '2018-02-09 06:33:41'),
(4, '测试页面', 2, 2, '', '2-1', '', 1, '2018-02-09 06:22:21', '2018-02-09 06:22:21'),
(7, 'ssss', 2, 1, '/', '', '_self', 1, '2018-02-11 08:23:49', '2018-02-11 08:23:49'),
(6, '哪个好', 3, 1, 'http://www.baidu.com', '1-3', '_self', 1, '2018-02-09 06:34:09', '2018-02-09 06:34:09');

-- --------------------------------------------------------

--
-- 表的结构 `laravel_migrations`
--

CREATE TABLE IF NOT EXISTS `laravel_migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `laravel_migrations`
--

INSERT INTO `laravel_migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2018_01_30_055950_entrust_setup_tables', 1);

-- --------------------------------------------------------

--
-- 表的结构 `laravel_page`
--

CREATE TABLE IF NOT EXISTS `laravel_page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `describe` text NOT NULL,
  `content` text NOT NULL,
  `uploadpic` varchar(255) NOT NULL,
  `author` varchar(100) NOT NULL,
  `create_time` varchar(100) NOT NULL,
  `click_num` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- 转存表中的数据 `laravel_page`
--

INSERT INTO `laravel_page` (`id`, `title`, `keywords`, `describe`, `content`, `uploadpic`, `author`, `create_time`, `click_num`, `created_at`, `updated_at`) VALUES
(1, '测试文章页面', '测试文章页面1', '测试文章页面2', '<p>测试文章页面3</p>', 'http://www.laravel.com/public/uploads/2018-02-09-10-26-51-5a7d06eb617d8.jpg', 'admin', '2018-02-09 10:26:38', 0, '2018-02-09 02:28:32', '2018-02-09 02:28:32'),
(2, '测试文章222', '测试文章2221', '测试文章222222', '<h1>测试文章222<i>​</i>测试文章222222<u>​</u>测试文章222<u>​</u><i>​sda&nbsp;</i>​大飒飒的<u>sss大神</u></h1>', '', 'admin', '2018-02-09 10:28:41', 0, '2018-02-09 02:29:12', '2018-02-09 02:29:12'),
(3, '12', '', '', '<p><br></p>', '', 'admin', '2018-02-09 10:29:19', 0, '2018-02-09 02:29:21', '2018-02-09 02:29:21'),
(4, '2', '', '', '<p><br></p>', '', 'admin', '2018-02-09 10:29:22', 0, '2018-02-09 02:29:24', '2018-02-09 02:29:24'),
(11, '生生世世', '', '', '<p><br></p>', '', 'admin', '2018-02-09 10:29:43', 0, '2018-02-09 02:29:46', '2018-02-09 02:29:46'),
(12, '啊啊啊', '', '', '<p><br></p>', '', 'admin', '2018-02-09 10:29:47', 0, '2018-02-09 02:29:50', '2018-02-09 02:29:50'),
(13, '点点滴滴', '', '', '<p><br></p>', '', 'admin', '2018-02-09 10:29:51', 0, '2018-02-09 02:29:53', '2018-02-09 02:29:53'),
(14, '啊啊啊', '', '', '<p><br></p>', '', 'admin', '2018-02-09 10:29:54', 0, '2018-02-09 02:29:56', '2018-02-09 02:29:56'),
(15, '范德萨', '', '', '<p><br></p>', '', 'admin', '2018-02-09 10:29:56', 0, '2018-02-09 02:29:59', '2018-02-09 02:29:59'),
(16, '啊啊啊大大', '', '', '<p><br></p>', '', 'admin', '2018-02-09 10:30:00', 0, '2018-02-09 02:30:02', '2018-02-09 02:30:02');

-- --------------------------------------------------------

--
-- 表的结构 `laravel_pages`
--

CREATE TABLE IF NOT EXISTS `laravel_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `describe` text NOT NULL,
  `content` text NOT NULL,
  `uploadpic` varchar(255) NOT NULL,
  `author` varchar(100) NOT NULL,
  `create_time` varchar(100) NOT NULL,
  `click_num` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `class_id` (`class_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- 转存表中的数据 `laravel_pages`
--

INSERT INTO `laravel_pages` (`id`, `class_id`, `title`, `keywords`, `describe`, `content`, `uploadpic`, `author`, `create_time`, `click_num`, `created_at`, `updated_at`) VALUES
(1, 1, '测试新闻标题', '测试新闻关键字', '测试新闻摘要', '<p>sadasd</p><p>sadasdfdsa<b>​dsfdasfdasgf</b>​fdgfdsgfdg<i>​fdgsfdsgfs</i>​dasfdsaf<u>​adsfdasfasd</u></p><p>sadasdsf222</p><p><br></p>', 'http://www.laravel.com/public/uploads/2018-02-07-13-27-33-5a7a8e45095d0.jpg', 'admin', '2018-02-07 15:59:29', 0, '2018-02-07 08:26:54', '2018-02-07 08:26:54'),
(2, 1, '测试标题2', '测试标题2测试标题2测试标题2', '测试标题2测试标题2', '<p>测试标题2测试标题2测试标题2测试标题2测试标题2测试标题2测试标题2</p>', 'http://www.laravel.com/public/uploads/2018-02-07-14-41-56-5a7a9fb48f560.jpg', 'admin', '2018-02-07 14:41:21', 0, '2018-02-07 06:42:00', '2018-02-07 06:42:00'),
(3, 4, '测试新闻标题', '测试新闻关键字', '测试新闻摘要', '<p>测试新闻关键字</p><p><br></p>', 'http://www.laravel.com/public/uploads/2018-02-07-13-27-33-5a7a8e45095d0.jpg', 'admin', '2018-02-07 15:25:14', 0, '2018-02-07 08:32:53', '2018-02-07 08:32:53'),
(5, 2, 'cesad', '', '', '<p><br></p>', '', 'admin', '2018-02-09 09:36:42', 0, '2018-02-09 01:36:48', '2018-02-09 01:36:48'),
(10, 1, 'dfsss', '', '', '<p><br></p>', '', 'admin', '2018-02-09 09:37:06', 0, '2018-02-09 01:37:08', '2018-02-09 01:37:08'),
(11, 1, '随风倒十分', '', '', '<p><br></p>', '', 'admin', '2018-02-09 09:37:09', 0, '2018-02-09 01:37:13', '2018-02-09 01:37:13'),
(12, 1, '反反复复', '', '', '<p><br></p>', '', 'admin', '2018-02-09 09:37:14', 0, '2018-02-09 01:37:17', '2018-02-09 01:37:17'),
(13, 1, '的撒士大夫', '', '', '<p><br></p>', '', 'admin', '2018-02-09 09:37:21', 0, '2018-02-09 01:37:24', '2018-02-09 01:37:24');

-- --------------------------------------------------------

--
-- 表的结构 `laravel_pages_class`
--

CREATE TABLE IF NOT EXISTS `laravel_pages_class` (
  `class_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`class_id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `laravel_pages_class`
--

INSERT INTO `laravel_pages_class` (`class_id`, `name`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, '新闻中心', 0, '2018-02-05 18:37:16', '2018-02-05 18:37:16'),
(2, '测试分类', 0, '2018-02-05 18:37:32', '2018-02-05 18:37:32'),
(3, '测试子分类', 2, '2018-02-05 18:37:45', '2018-02-05 18:37:45'),
(4, '测试二级子分类22', 3, '2018-02-06 05:37:29', '2018-02-05 21:37:29'),
(5, '测试二级1', 3, '2018-02-05 19:01:28', '2018-02-05 19:01:28');

-- --------------------------------------------------------

--
-- 表的结构 `laravel_password_resets`
--

CREATE TABLE IF NOT EXISTS `laravel_password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `laravel_permission_role`
--

CREATE TABLE IF NOT EXISTS `laravel_permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `laravel_permission_role`
--

INSERT INTO `laravel_permission_role` (`permission_id`, `role_id`) VALUES
(1, 3),
(4, 3);

-- --------------------------------------------------------

--
-- 表的结构 `laravel_permissions`
--

CREATE TABLE IF NOT EXISTS `laravel_permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `laravel_permissions`
--

INSERT INTO `laravel_permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Admin::Users::usersIndex', '管理用户', '访问用户列表', '2018-02-04 19:20:00', '2018-02-04 20:11:57'),
(3, 'Admin::Users::usersStore', '编辑用户', '添加修改用户权限', '2018-02-04 22:40:01', '2018-02-04 22:40:01'),
(4, 'Admin::index', '后台首页', '后台首页权限', '2018-02-04 23:50:41', '2018-02-04 23:50:41');

-- --------------------------------------------------------

--
-- 表的结构 `laravel_role_user`
--

CREATE TABLE IF NOT EXISTS `laravel_role_user` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `role_user_role_id_foreign` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `laravel_role_user`
--

INSERT INTO `laravel_role_user` (`user_id`, `role_id`) VALUES
(1, 1),
(2, 3);

-- --------------------------------------------------------

--
-- 表的结构 `laravel_roles`
--

CREATE TABLE IF NOT EXISTS `laravel_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `laravel_roles`
--

INSERT INTO `laravel_roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin', '超级管理员', '后台超级管理员用户角色', '2018-02-04 22:22:42', '2018-02-04 22:22:42'),
(3, 'testRole', '测试角色', '测试角色', '2018-02-04 22:50:27', '2018-02-04 22:50:27');

-- --------------------------------------------------------

--
-- 表的结构 `laravel_setting`
--

CREATE TABLE IF NOT EXISTS `laravel_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `site_icp` varchar(255) NOT NULL,
  `site_tongji` text NOT NULL,
  `site_copyright` varchar(255) NOT NULL,
  `notice` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `laravel_setting`
--

INSERT INTO `laravel_setting` (`id`, `title`, `keywords`, `description`, `site_icp`, `site_tongji`, `site_copyright`, `notice`, `created_at`, `updated_at`) VALUES
(1, '测试标题', '测试1233421', '测试1233421', '测试1233421', '<vresd >sadsa', 'asdsadsss<br>', '您好，这是网站公告，请仔细阅读', '2018-02-22 08:22:49', '2018-02-22 08:22:49');

-- --------------------------------------------------------

--
-- 表的结构 `laravel_users`
--

CREATE TABLE IF NOT EXISTS `laravel_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `laravel_users`
--

INSERT INTO `laravel_users` (`id`, `name`, `email`, `password`, `remember_token`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@admin.com', '$2y$10$kew5bkIKO1VHxu3dsrwMCOfS5jIWPrFBH6rCbgg/GR2NmRuH.pyY.', 'g53MSdhnqfZyEDplfYga6NrLtkDz0hD20svVtdxiTO5sM7YOyhtkc7TwzBgY', 1, '0000-00-00 00:00:00', '2018-02-09 01:34:45'),
(2, 'test', 'test@admin.com', '$2y$10$j9kraHYLQY0PnBDA/t5tQOB/cwOenHmS2GyYGF146IakI0KkfjwQ2', '3ux79F1hxO3xV8RYIINvZEWu544WxKV0Ggm6m8fLfBhCp9VQmvv9IxhmukNO', 1, '2018-01-30 23:25:47', '2018-02-05 00:06:45');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

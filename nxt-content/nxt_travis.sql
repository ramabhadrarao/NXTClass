-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 02, 2012 at 02:37 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `nxtclass`
--

-- --------------------------------------------------------

--
-- Table structure for table `n_commentmeta`
--

CREATE TABLE IF NOT EXISTS `n_commentmeta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `comment_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext,
  PRIMARY KEY (`meta_id`),
  KEY `comment_id` (`comment_id`),
  KEY `meta_key` (`meta_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `n_comments`
--

CREATE TABLE IF NOT EXISTS `n_comments` (
  `comment_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `comment_post_ID` bigint(20) unsigned NOT NULL DEFAULT '0',
  `comment_author` tinytext NOT NULL,
  `comment_author_email` varchar(100) NOT NULL DEFAULT '',
  `comment_author_url` varchar(200) NOT NULL DEFAULT '',
  `comment_author_IP` varchar(100) NOT NULL DEFAULT '',
  `comment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_content` text NOT NULL,
  `comment_karma` int(11) NOT NULL DEFAULT '0',
  `comment_approved` varchar(20) NOT NULL DEFAULT '1',
  `comment_agent` varchar(255) NOT NULL DEFAULT '',
  `comment_type` varchar(20) NOT NULL DEFAULT '',
  `comment_parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`comment_ID`),
  KEY `comment_approved` (`comment_approved`),
  KEY `comment_post_ID` (`comment_post_ID`),
  KEY `comment_approved_date_gmt` (`comment_approved`,`comment_date_gmt`),
  KEY `comment_date_gmt` (`comment_date_gmt`),
  KEY `comment_parent` (`comment_parent`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `n_comments`
--

INSERT INTO `n_comments` (`comment_ID`, `comment_post_ID`, `comment_author`, `comment_author_email`, `comment_author_url`, `comment_author_IP`, `comment_date`, `comment_date_gmt`, `comment_content`, `comment_karma`, `comment_approved`, `comment_agent`, `comment_type`, `comment_parent`, `user_id`) VALUES
(1, 1, 'Mr NXTClass', '', 'http://nxtclass.org/', '', '2012-06-28 12:55:26', '2012-06-28 12:55:26', 'Hi, this is a comment.<br />To delete a comment, just log in and view the post&#039;s comments. There you will have the option to edit or delete them.', 0, '1', '', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `n_links`
--

CREATE TABLE IF NOT EXISTS `n_links` (
  `link_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `link_url` varchar(255) NOT NULL DEFAULT '',
  `link_name` varchar(255) NOT NULL DEFAULT '',
  `link_image` varchar(255) NOT NULL DEFAULT '',
  `link_target` varchar(25) NOT NULL DEFAULT '',
  `link_description` varchar(255) NOT NULL DEFAULT '',
  `link_visible` varchar(20) NOT NULL DEFAULT 'Y',
  `link_owner` bigint(20) unsigned NOT NULL DEFAULT '1',
  `link_rating` int(11) NOT NULL DEFAULT '0',
  `link_updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `link_rel` varchar(255) NOT NULL DEFAULT '',
  `link_notes` mediumtext NOT NULL,
  `link_rss` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`link_id`),
  KEY `link_visible` (`link_visible`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `n_links`
--

INSERT INTO `n_links` (`link_id`, `link_url`, `link_name`, `link_image`, `link_target`, `link_description`, `link_visible`, `link_owner`, `link_rating`, `link_updated`, `link_rel`, `link_notes`, `link_rss`) VALUES
(1, 'http://codex.nxtclass.org/', 'Documentation', '', '', '', 'Y', 1, 0, '0000-00-00 00:00:00', '', '', ''),
(2, 'http://nxtclass.org/news/', 'NXTClass Blog', '', '', '', 'Y', 1, 0, '0000-00-00 00:00:00', '', '', 'http://nxtclass.org/news/feed/'),
(3, 'http://nxtclass.org/extend/ideas/', 'Suggest Ideas', '', '', '', 'Y', 1, 0, '0000-00-00 00:00:00', '', '', ''),
(4, 'http://nxtclass.org/support/', 'Support Forum', '', '', '', 'Y', 1, 0, '0000-00-00 00:00:00', '', '', ''),
(5, 'http://nxtclass.org/extend/plugins/', 'Plugins', '', '', '', 'Y', 1, 0, '0000-00-00 00:00:00', '', '', ''),
(6, 'http://nxtclass.org/extend/themes/', 'Themes', '', '', '', 'Y', 1, 0, '0000-00-00 00:00:00', '', '', ''),
(7, 'http://planet.nxtclass.org/', 'NXTClass Planet', '', '', '', 'Y', 1, 0, '0000-00-00 00:00:00', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `n_options`
--

CREATE TABLE IF NOT EXISTS `n_options` (
  `option_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `blog_id` int(11) NOT NULL DEFAULT '0',
  `option_name` varchar(64) NOT NULL DEFAULT '',
  `option_value` longtext NOT NULL,
  `autoload` varchar(20) NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`option_id`),
  UNIQUE KEY `option_name` (`option_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=429 ;

--
-- Dumping data for table `n_options`
--

INSERT INTO `n_options` (`option_id`, `blog_id`, `option_name`, `option_value`, `autoload`) VALUES
(3, 0, 'siteurl', 'http://localhost/htdocs', 'yes'),
(4, 0, 'blogname', 'nxtclass', 'yes'),
(5, 0, 'blogdescription', 'Another NXTClass site', 'yes'),
(6, 0, 'users_can_register', '1', 'yes'),
(7, 0, 'admin_email', 'arkomitter@in.com', 'yes'),
(8, 0, 'start_of_week', '1', 'yes'),
(9, 0, 'use_balanceTags', '0', 'yes'),
(10, 0, 'use_smilies', '1', 'yes'),
(11, 0, 'require_name_email', '1', 'yes'),
(12, 0, 'comments_notify', '1', 'yes'),
(13, 0, 'mailserver_url', 'mail.example.com', 'yes'),
(14, 0, 'mailserver_login', 'login@example.com', 'yes'),
(15, 0, 'mailserver_pass', 'password', 'yes'),
(16, 0, 'mailserver_port', '110', 'yes'),
(17, 0, 'default_category', '1', 'yes'),
(18, 0, 'default_comment_status', 'open', 'yes'),
(19, 0, 'default_ping_status', 'open', 'yes'),
(20, 0, 'default_pingback_flag', '0', 'yes'),
(21, 0, 'default_post_edit_rows', '20', 'yes'),
(22, 0, 'posts_per_page', '10', 'yes'),
(23, 0, 'date_format', 'F j, Y', 'yes'),
(24, 0, 'time_format', 'g:i a', 'yes'),
(25, 0, 'links_updated_date_format', 'F j, Y g:i a', 'yes'),
(26, 0, 'links_recently_updated_prepend', '<em>', 'yes'),
(27, 0, 'links_recently_updated_append', '</em>', 'yes'),
(28, 0, 'links_recently_updated_time', '120', 'yes'),
(29, 0, 'comment_moderation', '0', 'yes'),
(30, 0, 'moderation_notify', '1', 'yes'),
(31, 0, 'permalink_structure', '', 'yes'),
(32, 0, 'gzipcompression', '0', 'yes'),
(33, 0, 'hack_file', '0', 'yes'),
(34, 0, 'blog_charset', 'UTF-8', 'yes'),
(35, 0, 'moderation_keys', '', 'no'),
(36, 0, 'active_plugins', 'a:9:{i:0;s:23:"achievements/loader.php";i:1;s:27:"bp-template-pack/loader.php";i:2;s:66:"buddypress-user-account-type-lite/buddypress-user-account-type.php";i:3;s:24:"buddypress/bp-loader.php";i:4;s:30:"ckeditor/ckeditor_nxtclass.php";i:5;s:19:"members/members.php";i:6;s:27:"nxt-fb-autoconnect/Main.php";i:7;s:43:"nxtclass-bootstrap-css/hlt-bootstrapcss.php";i:8;s:31:"nxtclass-wiki/nxtclass-wiki.php";}', 'yes'),
(37, 0, 'home', 'http://localhost/htdocs', 'yes'),
(38, 0, 'category_base', '', 'yes'),
(39, 0, 'advanced_edit', '0', 'yes'),
(40, 0, 'comment_max_links', '2', 'yes'),
(41, 0, 'gmt_offset', '0', 'yes'),
(42, 0, 'default_email_category', '1', 'yes'),
(43, 0, 'recently_edited', '', 'no'),
(44, 0, 'template', 'canvas', 'yes'),
(45, 0, 'stylesheet', 'canvas', 'yes'),
(46, 0, 'comment_whitelist', '1', 'yes'),
(47, 0, 'blacklist_keys', '', 'no'),
(48, 0, 'comment_registration', '0', 'yes'),
(49, 0, 'rss_language', 'en', 'yes'),
(50, 0, 'html_type', 'text/html', 'yes'),
(51, 0, 'use_trackback', '0', 'yes'),
(52, 0, 'default_role', 'contibuter', 'yes'),
(53, 0, 'db_version', '19470', 'yes'),
(54, 0, 'uploads_use_yearmonth_folders', '1', 'yes'),
(55, 0, 'upload_path', '', 'yes'),
(56, 0, 'blog_public', '0', 'yes'),
(57, 0, 'default_link_category', '2', 'yes'),
(58, 0, 'show_on_front', 'posts', 'yes'),
(59, 0, 'tag_base', '', 'yes'),
(60, 0, 'show_avatars', '1', 'yes'),
(61, 0, 'avatar_rating', 'G', 'yes'),
(62, 0, 'upload_url_path', '', 'yes'),
(63, 0, 'thumbnail_size_w', '150', 'yes'),
(64, 0, 'thumbnail_size_h', '150', 'yes'),
(65, 0, 'thumbnail_crop', '1', 'yes'),
(66, 0, 'medium_size_w', '300', 'yes'),
(67, 0, 'medium_size_h', '300', 'yes'),
(68, 0, 'avatar_default', 'mystery', 'yes'),
(69, 0, 'enable_app', '0', 'yes'),
(70, 0, 'enable_xmlrpc', '0', 'yes'),
(71, 0, 'large_size_w', '1024', 'yes'),
(72, 0, 'large_size_h', '1024', 'yes'),
(73, 0, 'image_default_link_type', 'file', 'yes'),
(74, 0, 'image_default_size', '', 'yes'),
(75, 0, 'image_default_align', '', 'yes'),
(76, 0, 'close_comments_for_old_posts', '0', 'yes'),
(77, 0, 'close_comments_days_old', '14', 'yes'),
(78, 0, 'thread_comments', '1', 'yes'),
(79, 0, 'thread_comments_depth', '5', 'yes'),
(80, 0, 'page_comments', '0', 'yes'),
(81, 0, 'comments_per_page', '50', 'yes'),
(82, 0, 'default_comments_page', 'newest', 'yes'),
(83, 0, 'comment_order', 'asc', 'yes'),
(84, 0, 'sticky_posts', 'a:0:{}', 'yes'),
(85, 0, 'widget_categories', 'a:2:{i:2;a:4:{s:5:"title";s:0:"";s:5:"count";i:0;s:12:"hierarchical";i:0;s:8:"dropdown";i:0;}s:12:"_multiwidget";i:1;}', 'yes'),
(86, 0, 'widget_text', 'a:0:{}', 'yes'),
(87, 0, 'widget_rss', 'a:0:{}', 'yes'),
(88, 0, 'timezone_string', '', 'yes'),
(89, 0, 'embed_autourls', '1', 'yes'),
(90, 0, 'embed_size_w', '', 'yes'),
(91, 0, 'embed_size_h', '600', 'yes'),
(92, 0, 'page_for_posts', '0', 'yes'),
(93, 0, 'page_on_front', '0', 'yes'),
(94, 0, 'default_post_format', '0', 'yes'),
(95, 0, 'initial_db_version', '19470', 'yes'),
(96, 0, 'n_user_roles', 'a:5:{s:13:"administrator";a:2:{s:4:"name";s:13:"Administrator";s:12:"capabilities";a:69:{s:17:"edit_others_pages";b:1;s:20:"edit_published_pages";b:1;s:13:"publish_pages";b:1;s:12:"delete_pages";b:1;s:19:"delete_others_pages";b:1;s:22:"delete_published_pages";b:1;s:12:"delete_posts";b:1;s:19:"delete_others_posts";b:1;s:22:"delete_published_posts";b:1;s:20:"delete_private_posts";b:1;s:18:"edit_private_posts";b:1;s:18:"read_private_posts";b:1;s:20:"delete_private_pages";b:1;s:18:"edit_private_pages";b:1;s:18:"read_private_pages";b:1;s:12:"delete_users";b:1;s:12:"create_users";b:1;s:13:"switch_themes";b:1;s:11:"edit_themes";b:1;s:16:"activate_plugins";b:1;s:12:"edit_plugins";b:1;s:10:"edit_users";b:1;s:10:"edit_files";b:1;s:14:"manage_options";b:1;s:17:"moderate_comments";b:1;s:17:"manage_categories";b:1;s:12:"manage_links";b:1;s:12:"upload_files";b:1;s:6:"import";b:1;s:15:"unfiltered_html";b:1;s:10:"edit_posts";b:1;s:17:"edit_others_posts";b:1;s:20:"edit_published_posts";b:1;s:13:"publish_posts";b:1;s:10:"edit_pages";b:1;s:4:"read";b:1;s:8:"level_10";b:1;s:7:"level_9";b:1;s:7:"level_8";b:1;s:7:"level_7";b:1;s:7:"level_6";b:1;s:7:"level_5";b:1;s:7:"level_4";b:1;s:7:"level_3";b:1;s:7:"level_2";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:17:"unfiltered_upload";b:1;s:14:"edit_dashboard";b:1;s:14:"update_plugins";b:1;s:14:"delete_plugins";b:1;s:15:"install_plugins";b:1;s:13:"update_themes";b:1;s:14:"install_themes";b:1;s:11:"update_core";b:1;s:10:"list_users";b:1;s:12:"remove_users";b:1;s:9:"add_users";b:1;s:13:"promote_users";b:1;s:18:"edit_theme_options";b:1;s:13:"delete_themes";b:1;s:6:"export";b:1;s:9:"edit_wiki";b:1;s:14:"edit_wiki_page";b:1;s:15:"edit_wiki_pages";b:1;s:22:"edit_others_wiki_pages";b:1;s:18:"publish_wiki_pages";b:1;s:16:"delete_wiki_page";b:1;s:24:"delete_others_wiki_pages";b:1;}}s:6:"editor";a:2:{s:4:"name";s:6:"Editor";s:12:"capabilities";a:41:{s:17:"moderate_comments";b:1;s:17:"manage_categories";b:1;s:12:"manage_links";b:1;s:12:"upload_files";b:1;s:15:"unfiltered_html";b:1;s:10:"edit_posts";b:1;s:17:"edit_others_posts";b:1;s:20:"edit_published_posts";b:1;s:13:"publish_posts";b:1;s:10:"edit_pages";b:1;s:4:"read";b:1;s:7:"level_7";b:1;s:7:"level_6";b:1;s:7:"level_5";b:1;s:7:"level_4";b:1;s:7:"level_3";b:1;s:7:"level_2";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:17:"edit_others_pages";b:1;s:20:"edit_published_pages";b:1;s:13:"publish_pages";b:1;s:12:"delete_pages";b:1;s:19:"delete_others_pages";b:1;s:22:"delete_published_pages";b:1;s:12:"delete_posts";b:1;s:19:"delete_others_posts";b:1;s:22:"delete_published_posts";b:1;s:20:"delete_private_posts";b:1;s:18:"edit_private_posts";b:1;s:18:"read_private_posts";b:1;s:20:"delete_private_pages";b:1;s:18:"edit_private_pages";b:1;s:18:"read_private_pages";b:1;s:9:"edit_wiki";b:1;s:14:"edit_wiki_page";b:1;s:15:"edit_wiki_pages";b:1;s:22:"edit_others_wiki_pages";b:1;s:18:"publish_wiki_pages";b:1;s:16:"delete_wiki_page";b:1;s:24:"delete_others_wiki_pages";b:1;}}s:6:"author";a:2:{s:4:"name";s:6:"Author";s:12:"capabilities";a:17:{s:12:"upload_files";b:1;s:10:"edit_posts";b:1;s:20:"edit_published_posts";b:1;s:13:"publish_posts";b:1;s:4:"read";b:1;s:7:"level_2";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:12:"delete_posts";b:1;s:22:"delete_published_posts";b:1;s:9:"edit_wiki";b:1;s:14:"edit_wiki_page";b:1;s:15:"edit_wiki_pages";b:1;s:22:"edit_others_wiki_pages";b:1;s:18:"publish_wiki_pages";b:1;s:16:"delete_wiki_page";b:1;s:24:"delete_others_wiki_pages";b:1;}}s:11:"contributor";a:2:{s:4:"name";s:11:"Contributor";s:12:"capabilities";a:12:{s:10:"edit_posts";b:1;s:4:"read";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:12:"delete_posts";b:1;s:9:"edit_wiki";b:1;s:14:"edit_wiki_page";b:1;s:15:"edit_wiki_pages";b:1;s:22:"edit_others_wiki_pages";b:1;s:18:"publish_wiki_pages";b:1;s:16:"delete_wiki_page";b:1;s:24:"delete_others_wiki_pages";b:1;}}s:10:"subscriber";a:2:{s:4:"name";s:10:"Subscriber";s:12:"capabilities";a:9:{s:4:"read";b:1;s:7:"level_0";b:1;s:9:"edit_wiki";b:1;s:14:"edit_wiki_page";b:1;s:15:"edit_wiki_pages";b:1;s:22:"edit_others_wiki_pages";b:1;s:18:"publish_wiki_pages";b:1;s:16:"delete_wiki_page";b:1;s:24:"delete_others_wiki_pages";b:1;}}}', 'yes'),
(97, 0, 'widget_search', 'a:2:{i:2;a:1:{s:5:"title";s:0:"";}s:12:"_multiwidget";i:1;}', 'yes'),
(98, 0, 'widget_recent-posts', 'a:2:{i:2;a:2:{s:5:"title";s:0:"";s:6:"number";i:5;}s:12:"_multiwidget";i:1;}', 'yes'),
(99, 0, 'widget_recent-comments', 'a:2:{i:2;a:2:{s:5:"title";s:0:"";s:6:"number";i:5;}s:12:"_multiwidget";i:1;}', 'yes'),
(100, 0, 'widget_archives', 'a:2:{i:2;a:3:{s:5:"title";s:0:"";s:5:"count";i:0;s:8:"dropdown";i:0;}s:12:"_multiwidget";i:1;}', 'yes'),
(101, 0, 'widget_meta', 'a:2:{i:2;a:1:{s:5:"title";s:0:"";}s:12:"_multiwidget";i:1;}', 'yes'),
(102, 0, 'sidebars_widgets', 'a:8:{s:20:"nxt_inactive_widgets";a:0:{}s:7:"primary";a:5:{i:0;s:14:"recent-posts-2";i:1;s:17:"recent-comments-2";i:2;s:10:"archives-2";i:3;s:12:"categories-2";i:4;s:6:"meta-2";}s:9:"secondary";a:0:{}s:8:"footer-1";a:0:{}s:8:"footer-2";a:0:{}s:8:"footer-3";a:0:{}s:8:"footer-4";N;s:13:"array_version";i:3;}', 'yes'),
(103, 0, 'cron', 'a:4:{i:1342875351;a:1:{s:20:"nxt_scheduled_delete";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:5:"daily";s:4:"args";a:0:{}s:8:"interval";i:86400;}}}i:1343264128;a:2:{s:17:"nxt_update_themes";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:10:"twicedaily";s:4:"args";a:0:{}s:8:"interval";i:43200;}}s:17:"nxt_version_check";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:10:"twicedaily";s:4:"args";a:0:{}s:8:"interval";i:43200;}}}i:1343912128;a:1:{s:18:"nxt_update_plugins";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:10:"twicedaily";s:4:"args";a:0:{}s:8:"interval";i:43200;}}}s:7:"version";i:2;}', 'yes'),
(104, 0, 'members_db_version', '2', 'yes'),
(105, 0, 'members_settings', 'a:8:{s:12:"role_manager";i:1;s:19:"content_permissions";i:1;s:12:"private_blog";i:0;s:12:"private_feed";i:0;s:17:"login_form_widget";i:0;s:12:"users_widget";i:0;s:25:"content_permissions_error";s:85:"<p class="restricted">Sorry, but you do not have permission to view this content.</p>";s:18:"private_feed_error";s:80:"<p class="restricted">You must be logged into the site to view this content.</p>";}', 'yes'),
(107, 0, '_site_transient_update_core', 'O:8:"stdClass":3:{s:7:"updates";s:1:"<";s:12:"last_checked";i:1343240076;s:15:"version_checked";s:5:"1.1.0";}', 'yes'),
(108, 0, '_site_transient_update_plugins', 'O:8:"stdClass":1:{s:12:"last_checked";i:1343910933;}', 'yes'),
(109, 0, '_site_transient_update_themes', 'O:8:"stdClass":1:{s:12:"last_checked";i:1343240064;}', 'yes'),
(110, 0, 'hlt_bootstrapcss_upgraded1to2', 'Y', 'yes'),
(111, 0, 'dashboard_widget_options', 'a:4:{s:25:"dashboard_recent_comments";a:1:{s:5:"items";i:5;}s:24:"dashboard_incoming_links";a:5:{s:4:"home";s:23:"http://localhost/htdocs";s:4:"link";s:98:"http://blogsearch.google.com/blogsearch?scoring=d&partner=nxtclass&q=link:http://localhost/htdocs/";s:3:"url";s:131:"http://blogsearch.google.com/blogsearch_feeds?scoring=d&ie=utf-8&num=10&output=rss&partner=nxtclass&q=link:http://localhost/htdocs/";s:5:"items";i:10;s:9:"show_date";b:0;}s:17:"dashboard_primary";a:7:{s:4:"link";s:25:"http://nxtclass.org/news/";s:3:"url";s:30:"http://nxtclass.org/news/feed/";s:5:"title";s:13:"NXTClass Blog";s:5:"items";i:2;s:12:"show_summary";i:1;s:11:"show_author";i:0;s:9:"show_date";i:1;}s:19:"dashboard_secondary";a:7:{s:4:"link";s:27:"http://planet.nxtclass.org/";s:3:"url";s:32:"http://planet.nxtclass.org/feed/";s:5:"title";s:19:"Other NXTClass News";s:5:"items";i:5;s:12:"show_summary";i:0;s:11:"show_author";i:0;s:9:"show_date";i:0;}}', 'yes'),
(116, 0, 'can_compress_scripts', '0', 'yes'),
(131, 0, 'recently_activated', 'a:0:{}', 'yes'),
(132, 0, 'ckeditor_nxtclass', 'a:6:{s:10:"appearance";a:10:{s:4:"skin";s:4:"kama";s:7:"uicolor";s:7:"default";s:12:"uicolor_user";s:0:"";s:13:"default_state";s:1:"t";s:13:"excerpt_state";s:1:"f";s:12:"post_toolbar";s:12:"NXTClassFull";s:18:"post_editor_height";i:300;s:14:"comment_editor";s:1:"t";s:15:"comment_toolbar";s:13:"NXTClassBasic";s:21:"comment_editor_height";i:120;}s:6:"upload";a:6:{s:7:"browser";s:8:"disabled";s:4:"type";s:6:"native";s:14:"user_file_path";s:20:"nxt-content/uploads/";s:17:"files_allowed_ext";s:202:"7z,aiff,asf,avi,bmp,csv,doc,fla,flv,gif,gz,gzip,jpeg,jpg,mid,mov,mp3,mp4,mpc,mpeg,mpg,ods,odt,pdf,png,ppt,pxd,qt,ram,rar,rm,rmi,rmvb,rtf,sdc,sitd,swf,sxc,sxw,tar,tgz,tif,tiff,txt,vsd,wav,wma,wmv,xls,zip";s:18:"images_allowed_ext";s:20:"bmp,gif,jpeg,jpg,png";s:17:"flash_allowed_ext";s:7:"swf,flv";}s:8:"ckfinder";a:11:{s:13:"file_max_size";s:2:"8M";s:12:"images_width";s:4:"1200";s:13:"images_height";s:4:"1600";s:14:"images_quality";s:2:"80";s:16:"thumbnails_width";s:3:"100";s:17:"thumbnails_height";s:3:"100";s:18:"thumbnails_quality";s:2:"80";s:18:"thumbnails_enabled";s:1:"t";s:24:"thumbnails_direct_access";s:1:"f";s:12:"license_name";s:0:"";s:11:"license_key";s:0:"";}s:3:"css";a:4:{s:4:"mode";s:7:"default";s:4:"path";s:0:"";s:6:"styles";s:7:"default";s:10:"style_path";s:0:"";}s:8:"advanced";a:10:{s:11:"load_method";s:11:"ckeditor.js";s:12:"load_timeout";i:0;s:20:"native_spell_checker";s:1:"t";s:17:"scayt_autoStartup";s:1:"f";s:8:"entities";s:1:"t";s:8:"p_indent";s:1:"t";s:19:"p_break_before_open";s:1:"t";s:18:"p_break_after_open";s:1:"t";s:20:"p_break_before_close";s:1:"t";s:19:"p_break_after_close";s:1:"t";}s:7:"plugins";a:3:{s:8:"autogrow";s:1:"f";s:11:"tableresize";s:1:"f";s:10:"nxtgallery";s:1:"t";}}', 'yes'),
(136, 0, 'theme_mods_twentyeleven', 'a:1:{s:16:"sidebars_widgets";a:2:{s:4:"time";i:1340888640;s:4:"data";a:6:{s:20:"nxt_inactive_widgets";a:0:{}s:9:"sidebar-1";a:6:{i:0;s:8:"search-2";i:1;s:14:"recent-posts-2";i:2;s:17:"recent-comments-2";i:3;s:10:"archives-2";i:4;s:12:"categories-2";i:5;s:6:"meta-2";}s:9:"sidebar-2";a:0:{}s:9:"sidebar-3";a:0:{}s:9:"sidebar-4";a:0:{}s:9:"sidebar-5";a:0:{}}}}', 'yes'),
(137, 0, 'template_root', '/themes', 'yes'),
(138, 0, 'stylesheet_root', '/themes', 'yes'),
(140, 0, 'theme_mods_swatch for Buddypress', 'a:2:{i:0;b:0;s:16:"sidebars_widgets";a:2:{s:4:"time";i:1342186275;s:4:"data";a:9:{s:20:"nxt_inactive_widgets";a:0:{}s:7:"primary";a:5:{i:0;s:14:"recent-posts-2";i:1;s:17:"recent-comments-2";i:2;s:10:"archives-2";i:3;s:12:"categories-2";i:4;s:6:"meta-2";}s:13:"homepage-left";a:0:{}s:15:"homepage-middle";a:0:{}s:14:"homepage-right";a:0:{}s:8:"footer-1";a:0:{}s:8:"footer-2";N;s:8:"footer-3";N;s:8:"footer-4";N;}}}', 'yes'),
(141, 0, 'theme_switched', '', 'yes'),
(142, 0, 'woo_timthumb_update', '', 'yes'),
(143, 0, 'woo_framework_version', '5.1.4', 'yes'),
(144, 0, 'woo_custom_seo_template', 'a:3:{i:0;a:5:{s:4:"name";s:10:"seo_info_1";s:3:"std";s:0:"";s:5:"label";s:4:"SEO ";s:4:"type";s:4:"info";s:4:"desc";s:190:"Additional SEO custom fields available: <strong>Custom Page Titles</strong>. Go to <a href="http://localhost/htdocs/nxt-admin/admin.php?page=woothemes_seo">SEO Settings</a> page to activate.";}i:1;a:5:{s:4:"name";s:10:"seo_follow";s:3:"std";s:5:"false";s:5:"label";s:18:"SEO - Set nofollow";s:4:"type";s:8:"checkbox";s:4:"desc";s:81:"Make links from this post/page <strong>not followable</strong> by search engines.";}i:2;a:5:{s:4:"name";s:11:"seo_noindex";s:3:"std";s:5:"false";s:5:"label";s:13:"SEO - Noindex";s:4:"type";s:8:"checkbox";s:4:"desc";s:56:"Set the Page/Post to not be indexed by a search engines.";}}', 'yes'),
(145, 0, 'woo_options', 'a:205:{s:8:"woo_logo";s:0:"";s:18:"woo_custom_favicon";s:0:"";s:20:"woo_google_analytics";s:0:"";s:12:"woo_feed_url";s:0:"";s:19:"woo_subscribe_email";s:0:"";s:21:"woo_contactform_email";s:0:"";s:14:"woo_custom_css";s:0:"";s:12:"woo_comments";s:4:"both";s:16:"woo_post_content";s:7:"excerpt";s:20:"woo_breadcrumbs_show";s:5:"false";s:19:"woo_pagination_type";s:15:"paginated_links";s:25:"woo_layout_manager_notice";s:0:"";s:16:"woo_layout_width";s:5:"940px";s:10:"woo_layout";s:12:"two-col-left";s:19:"woo_footer_sidebars";s:1:"4";s:17:"woo_style_disable";s:5:"false";s:21:"woo_exclude_cats_home";s:0:"";s:21:"woo_exclude_cats_blog";s:0:"";s:12:"woo_style_bg";s:0:"";s:18:"woo_style_bg_image";s:0:"";s:25:"woo_style_bg_image_repeat";s:9:"no-repeat";s:14:"woo_border_top";a:3:{s:5:"width";s:1:"4";s:5:"style";s:5:"solid";s:5:"color";s:7:"#000000";}s:14:"woo_link_color";s:0:"";s:20:"woo_link_hover_color";s:0:"";s:16:"woo_button_color";s:0:"";s:16:"woo_style_border";s:0:"";s:23:"woo_general_font_notice";s:0:"";s:13:"woo_font_text";a:5:{s:4:"size";s:2:"14";s:4:"unit";s:2:"px";s:4:"face";s:17:"Arial, sans-serif";s:5:"style";s:6:"normal";s:5:"color";s:7:"#555555";}s:11:"woo_font_h1";a:5:{s:4:"size";s:2:"28";s:4:"unit";s:2:"px";s:4:"face";s:8:"PT Serif";s:5:"style";s:6:"normal";s:5:"color";s:7:"#222222";}s:11:"woo_font_h2";a:5:{s:4:"size";s:2:"24";s:4:"unit";s:2:"px";s:4:"face";s:8:"PT Serif";s:5:"style";s:6:"normal";s:5:"color";s:7:"#222222";}s:11:"woo_font_h3";a:5:{s:4:"size";s:2:"20";s:4:"unit";s:2:"px";s:4:"face";s:8:"PT Serif";s:5:"style";s:6:"normal";s:5:"color";s:7:"#222222";}s:11:"woo_font_h4";a:5:{s:4:"size";s:2:"16";s:4:"unit";s:2:"px";s:4:"face";s:8:"PT Serif";s:5:"style";s:6:"normal";s:5:"color";s:7:"#222222";}s:11:"woo_font_h5";a:5:{s:4:"size";s:2:"14";s:4:"unit";s:2:"px";s:4:"face";s:8:"PT Serif";s:5:"style";s:6:"normal";s:5:"color";s:7:"#222222";}s:11:"woo_font_h6";a:5:{s:4:"size";s:2:"12";s:4:"unit";s:2:"px";s:4:"face";s:8:"PT Serif";s:5:"style";s:6:"normal";s:5:"color";s:7:"#222222";}s:16:"woo_layout_boxed";s:4:"true";s:16:"woo_style_box_bg";s:0:"";s:18:"woo_box_margin_top";s:0:"";s:21:"woo_box_margin_bottom";s:0:"";s:17:"woo_box_border_tb";a:3:{s:5:"width";s:1:"4";s:5:"style";s:5:"solid";s:5:"color";s:7:"#dbdbdb";}s:17:"woo_box_border_lr";a:3:{s:5:"width";s:1:"4";s:5:"style";s:5:"solid";s:5:"color";s:7:"#dbdbdb";}s:21:"woo_box_border_radius";s:3:"0px";s:14:"woo_box_shadow";s:4:"true";s:13:"woo_header_bg";s:0:"";s:19:"woo_header_bg_image";s:0:"";s:26:"woo_header_bg_image_repeat";s:9:"no-repeat";s:17:"woo_header_border";a:3:{s:5:"width";s:1:"0";s:5:"style";s:5:"solid";s:5:"color";s:0:"";}s:21:"woo_header_margin_top";s:1:"0";s:24:"woo_header_margin_bottom";s:1:"0";s:22:"woo_header_padding_top";s:2:"40";s:25:"woo_header_padding_bottom";s:2:"30";s:23:"woo_header_padding_left";s:0:"";s:24:"woo_header_padding_right";s:0:"";s:13:"woo_font_logo";a:5:{s:4:"size";s:2:"40";s:4:"unit";s:2:"px";s:4:"face";s:8:"PT Serif";s:5:"style";s:6:"normal";s:5:"color";s:7:"#222222";}s:13:"woo_font_desc";a:5:{s:4:"size";s:2:"14";s:4:"unit";s:2:"px";s:4:"face";s:8:"PT Serif";s:5:"style";s:6:"italic";s:5:"color";s:7:"#999999";}s:19:"woo_font_post_title";a:5:{s:4:"size";s:2:"30";s:4:"unit";s:2:"px";s:4:"face";s:17:"Arial, sans-serif";s:5:"style";s:4:"bold";s:5:"color";s:7:"#444444";}s:18:"woo_font_post_meta";a:5:{s:4:"size";s:2:"12";s:4:"unit";s:2:"px";s:4:"face";s:65:""Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", sans-serif";s:5:"style";s:6:"normal";s:5:"color";s:7:"#444444";}s:18:"woo_font_post_text";a:5:{s:4:"size";s:2:"16";s:4:"unit";s:2:"px";s:4:"face";s:8:"PT Serif";s:5:"style";s:6:"normal";s:5:"color";s:7:"#555555";}s:18:"woo_font_post_more";a:5:{s:4:"size";s:2:"12";s:4:"unit";s:2:"px";s:4:"face";s:17:"Arial, sans-serif";s:5:"style";s:6:"normal";s:5:"color";s:7:"#868686";}s:24:"woo_post_more_border_top";a:3:{s:5:"width";s:1:"4";s:5:"style";s:5:"solid";s:5:"color";s:7:"#e6e6e6";}s:27:"woo_post_more_border_bottom";a:3:{s:5:"width";s:1:"1";s:5:"style";s:5:"solid";s:5:"color";s:7:"#e6e6e6";}s:18:"woo_post_author_bg";s:7:"#fafafa";s:26:"woo_post_author_border_top";a:3:{s:5:"width";s:1:"1";s:5:"style";s:5:"solid";s:5:"color";s:7:"#e6e6e6";}s:29:"woo_post_author_border_bottom";a:3:{s:5:"width";s:1:"4";s:5:"style";s:5:"solid";s:5:"color";s:7:"#e6e6e6";}s:23:"woo_disable_post_author";s:5:"false";s:20:"woo_post_comments_bg";s:0:"";s:16:"woo_pagenav_font";a:5:{s:4:"size";s:2:"12";s:4:"unit";s:2:"px";s:4:"face";s:8:"PT Serif";s:5:"style";s:6:"italic";s:5:"color";s:7:"#777777";}s:14:"woo_pagenav_bg";s:0:"";s:22:"woo_pagenav_border_top";a:3:{s:5:"width";s:1:"1";s:5:"style";s:5:"solid";s:5:"color";s:7:"#e6e6e6";}s:25:"woo_pagenav_border_bottom";a:3:{s:5:"width";s:1:"4";s:5:"style";s:5:"solid";s:5:"color";s:7:"#e6e6e6";}s:23:"woo_archive_header_font";a:5:{s:4:"size";s:2:"18";s:4:"unit";s:2:"px";s:4:"face";s:17:"Arial, sans-serif";s:5:"style";s:6:"normal";s:5:"color";s:7:"#555555";}s:32:"woo_archive_header_border_bottom";a:3:{s:5:"width";s:1:"5";s:5:"style";s:5:"solid";s:5:"color";s:7:"#e6e6e6";}s:30:"woo_archive_header_disable_rss";s:5:"false";s:13:"woo_widget_bg";s:0:"";s:17:"woo_widget_border";a:3:{s:5:"width";s:1:"0";s:5:"style";s:5:"solid";s:5:"color";s:7:"#dbdbdb";}s:21:"woo_widget_padding_tb";s:0:"";s:21:"woo_widget_padding_lr";s:0:"";s:21:"woo_widget_font_title";a:5:{s:4:"size";s:2:"14";s:4:"unit";s:2:"px";s:4:"face";s:8:"PT Serif";s:5:"style";s:4:"bold";s:5:"color";s:7:"#555555";}s:23:"woo_widget_title_border";a:3:{s:5:"width";s:1:"3";s:5:"style";s:5:"solid";s:5:"color";s:7:"#e6e6e6";}s:20:"woo_widget_font_text";a:5:{s:4:"size";s:2:"12";s:4:"unit";s:2:"px";s:4:"face";s:17:"Arial, sans-serif";s:5:"style";s:6:"normal";s:5:"color";s:7:"#555555";}s:24:"woo_widget_border_radius";s:3:"0px";s:18:"woo_widget_tabs_bg";s:0:"";s:25:"woo_widget_tabs_bg_inside";s:0:"";s:20:"woo_widget_tabs_font";a:5:{s:4:"size";s:2:"12";s:4:"unit";s:2:"px";s:4:"face";s:8:"PT Serif";s:5:"style";s:4:"bold";s:5:"color";s:7:"#555555";}s:25:"woo_widget_tabs_font_meta";a:5:{s:4:"size";s:2:"11";s:4:"unit";s:2:"px";s:4:"face";s:34:""Trebuchet MS", Tahoma, sans-serif";s:5:"style";s:6:"normal";s:5:"color";s:7:"#777777";}s:15:"woo_footer_font";a:5:{s:4:"size";s:2:"14";s:4:"unit";s:2:"px";s:4:"face";s:8:"PT Serif";s:5:"style";s:6:"italic";s:5:"color";s:7:"#777777";}s:13:"woo_footer_bg";s:0:"";s:21:"woo_footer_border_top";a:3:{s:5:"width";s:1:"4";s:5:"style";s:5:"solid";s:5:"color";s:7:"#dbdbdb";}s:24:"woo_footer_border_bottom";a:3:{s:5:"width";s:1:"0";s:5:"style";s:5:"solid";s:5:"color";s:0:"";}s:20:"woo_footer_border_lr";a:3:{s:5:"width";s:1:"0";s:5:"style";s:5:"solid";s:5:"color";s:0:"";}s:24:"woo_footer_border_radius";s:3:"0px";s:19:"woo_footer_aff_link";s:0:"";s:15:"woo_footer_left";s:5:"false";s:20:"woo_footer_left_text";s:7:"<p></p>";s:16:"woo_footer_right";s:5:"false";s:21:"woo_footer_right_text";s:7:"<p></p>";s:11:"woo_nav_rss";s:4:"true";s:10:"woo_nav_bg";s:0:"";s:12:"woo_nav_font";a:5:{s:4:"size";s:2:"14";s:4:"unit";s:2:"px";s:4:"face";s:17:"Arial, sans-serif";s:5:"style";s:6:"normal";s:5:"color";s:7:"#555555";}s:13:"woo_nav_hover";s:0:"";s:19:"woo_nav_currentitem";s:0:"";s:18:"woo_nav_border_top";a:3:{s:5:"width";s:1:"1";s:5:"style";s:5:"solid";s:5:"color";s:7:"#dbdbdb";}s:18:"woo_nav_border_bot";a:3:{s:5:"width";s:1:"4";s:5:"style";s:5:"solid";s:5:"color";s:7:"#dbdbdb";}s:17:"woo_nav_border_lr";a:3:{s:5:"width";s:1:"0";s:5:"style";s:5:"solid";s:5:"color";s:7:"#dbdbdb";}s:21:"woo_nav_border_radius";s:3:"0px";s:14:"woo_top_nav_bg";s:0:"";s:17:"woo_top_nav_hover";s:0:"";s:16:"woo_top_nav_font";a:5:{s:4:"size";s:2:"14";s:4:"unit";s:2:"px";s:4:"face";s:17:"Arial, sans-serif";s:5:"style";s:6:"normal";s:5:"color";s:4:"#ddd";}s:19:"woo_nxtthumb_notice";s:0:"";s:22:"woo_post_image_support";s:4:"true";s:14:"woo_pis_resize";s:4:"true";s:17:"woo_pis_hard_crop";s:4:"true";s:10:"woo_resize";s:4:"true";s:12:"woo_auto_img";s:5:"false";s:11:"woo_thumb_w";s:3:"100";s:11:"woo_thumb_h";s:3:"100";s:15:"woo_thumb_align";s:10:"alignright";s:16:"woo_thumb_single";s:5:"false";s:12:"woo_single_w";s:3:"200";s:12:"woo_single_h";s:3:"200";s:22:"woo_thumb_align_single";s:10:"alignright";s:13:"woo_rss_thumb";s:5:"false";s:19:"woo_enable_lightbox";s:5:"false";s:10:"woo_ad_top";s:5:"false";s:18:"woo_ad_top_adsense";s:0:"";s:16:"woo_ad_top_image";s:40:"http://www.woothemes.com/ads/468x60b.jpg";s:14:"woo_ad_top_url";s:24:"http://www.woothemes.com";s:23:"woo_woo_magazine_notice";s:0:"";s:23:"woo_magazine_feat_posts";s:1:"2";s:16:"woo_magazine_f_w";s:3:"100";s:16:"woo_magazine_f_h";s:3:"100";s:20:"woo_magazine_f_align";s:9:"alignleft";s:16:"woo_magazine_b_w";s:3:"100";s:16:"woo_magazine_b_h";s:3:"100";s:20:"woo_magazine_b_align";s:9:"alignleft";s:20:"woo_magazine_exclude";s:0:"";s:19:"woo_slider_magazine";s:5:"false";s:24:"woo_slider_magazine_tags";s:0:"";s:27:"woo_slider_magazine_entries";s:1:"3";s:27:"woo_slider_magazine_exclude";s:4:"true";s:25:"woo_slider_magazine_title";s:4:"true";s:30:"woo_slider_magazine_font_title";a:5:{s:4:"size";s:2:"24";s:4:"unit";s:2:"px";s:4:"face";s:17:"Arial, sans-serif";s:5:"style";s:4:"bold";s:5:"color";s:7:"#ffffff";}s:27:"woo_slider_magazine_excerpt";s:4:"true";s:32:"woo_slider_magazine_font_excerpt";a:5:{s:4:"size";s:2:"12";s:4:"unit";s:2:"px";s:4:"face";s:17:"Arial, sans-serif";s:5:"style";s:6:"normal";s:5:"color";s:7:"#cccccc";}s:34:"woo_slider_magazine_excerpt_length";s:2:"15";s:26:"woo_slider_magazine_height";s:0:"";s:18:"woo_magazine_limit";s:2:"10";s:34:"woo_magazine_featured_post_content";s:7:"excerpt";s:30:"woo_magazine_grid_post_content";s:7:"excerpt";s:18:"woo_woo_biz_notice";s:0:"";s:14:"woo_slider_biz";s:4:"true";s:21:"woo_slider_biz_number";s:2:"10";s:20:"woo_slider_biz_order";s:4:"DESC";s:20:"woo_slider_biz_title";s:4:"true";s:25:"woo_slider_biz_font_title";a:5:{s:4:"size";s:2:"24";s:4:"unit";s:2:"px";s:4:"face";s:17:"Arial, sans-serif";s:5:"style";s:4:"bold";s:5:"color";s:7:"#ffffff";}s:27:"woo_slider_biz_font_excerpt";a:5:{s:4:"size";s:2:"12";s:4:"unit";s:2:"px";s:4:"face";s:17:"Arial, sans-serif";s:5:"style";s:6:"normal";s:5:"color";s:7:"#cccccc";}s:21:"woo_slider_biz_height";s:0:"";s:30:"woo_biz_disable_footer_widgets";s:4:"true";s:22:"woo_biz_slides_disable";s:5:"false";s:21:"woo_woo_slider_notice";s:0:"";s:15:"woo_slider_auto";s:5:"false";s:21:"woo_slider_autoheight";s:5:"false";s:16:"woo_slider_hover";s:5:"false";s:25:"woo_slider_containerclick";s:5:"false";s:16:"woo_slider_speed";s:3:"0.6";s:19:"woo_slider_interval";s:1:"4";s:17:"woo_slider_effect";s:5:"slide";s:21:"woo_slider_pagination";s:4:"true";s:20:"woo_portfolio_notice";s:0:"";s:21:"woo_portfolio_gallery";s:4:"true";s:26:"woo_portfolioitems_rewrite";s:15:"portfolio-items";s:24:"woo_portfolio_excludenav";s:0:"";s:25:"woo_portfolio_thumb_width";s:3:"210";s:26:"woo_portfolio_thumb_height";s:3:"120";s:20:"woo_portfolio_layout";s:7:"one-col";s:27:"woo_portfolio_excludesearch";s:5:"false";s:20:"woo_portfolio_linkto";s:8:"lightbox";s:21:"woo_portfolio_disable";s:5:"false";s:20:"woo_feedback_disable";s:5:"false";s:22:"woo_woo_tumblog_notice";s:0:"";s:22:"woo_woo_tumblog_switch";s:5:"false";s:26:"woo_tumblog_content_method";s:11:"post_format";s:14:"woo_custom_rss";s:4:"true";s:17:"woo_image_link_to";s:4:"post";s:23:"woo_tumblog_image_width";s:3:"610";s:30:"woo_woo_tumblog_images_content";s:6:"Before";s:23:"woo_tumblog_audio_width";s:3:"440";s:29:"woo_woo_tumblog_audio_content";s:6:"Before";s:23:"woo_tumblog_video_width";s:3:"610";s:30:"woo_woo_tumblog_videos_content";s:6:"Before";s:30:"woo_woo_tumblog_quotes_content";s:6:"Before";s:32:"woo_tumblog_magazine_media_width";s:3:"300";s:11:"woo_connect";s:5:"false";s:17:"woo_connect_title";s:0:"";s:19:"woo_connect_content";s:0:"";s:25:"woo_connect_newsletter_id";s:0:"";s:30:"woo_connect_mailchimp_list_url";s:0:"";s:15:"woo_connect_rss";s:4:"true";s:19:"woo_connect_twitter";s:0:"";s:20:"woo_connect_facebook";s:0:"";s:19:"woo_connect_youtube";s:0:"";s:18:"woo_connect_flickr";s:0:"";s:20:"woo_connect_linkedin";s:0:"";s:21:"woo_connect_delicious";s:0:"";s:22:"woo_connect_googleplus";s:0:"";s:19:"woo_connect_related";s:4:"true";}', 'yes');
INSERT INTO `n_options` (`option_id`, `blog_id`, `option_name`, `option_value`, `autoload`) VALUES
(146, 0, 'woo_template', 'a:214:{i:0;a:3:{s:4:"name";s:16:"General Settings";s:4:"icon";s:7:"general";s:4:"type";s:7:"heading";}i:1;a:5:{s:4:"name";s:11:"Custom Logo";s:4:"desc";s:63:"Upload a logo for your theme, or specify an image URL directly.";s:2:"id";s:8:"woo_logo";s:3:"std";s:0:"";s:4:"type";s:6:"upload";}i:2;a:5:{s:4:"name";s:14:"Custom Favicon";s:4:"desc";s:78:"Upload a 16px x 16px Png/Gif image that will represent your website''s favicon.";s:2:"id";s:18:"woo_custom_favicon";s:3:"std";s:0:"";s:4:"type";s:6:"upload";}i:3;a:5:{s:4:"name";s:13:"Tracking Code";s:4:"desc";s:117:"Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.";s:2:"id";s:20:"woo_google_analytics";s:3:"std";s:0:"";s:4:"type";s:8:"textarea";}i:4;a:5:{s:4:"name";s:7:"RSS URL";s:4:"desc";s:51:"Enter your preferred RSS URL. (Feedburner or other)";s:2:"id";s:12:"woo_feed_url";s:3:"std";s:0:"";s:4:"type";s:4:"text";}i:5;a:5:{s:4:"name";s:10:"E-Mail URL";s:4:"desc";s:67:"Enter your preferred E-mail subscription URL. (Feedburner or other)";s:2:"id";s:19:"woo_subscribe_email";s:3:"std";s:0:"";s:4:"type";s:4:"text";}i:6;a:5:{s:4:"name";s:19:"Contact Form E-Mail";s:4:"desc";s:156:"Enter your E-mail address to use on the Contact Form Page Template. Add the contact form by adding a new page and selecting "Contact Form" as page template.";s:2:"id";s:21:"woo_contactform_email";s:3:"std";s:0:"";s:4:"type";s:4:"text";}i:7;a:5:{s:4:"name";s:10:"Custom CSS";s:4:"desc";s:62:"Quickly add some CSS to your theme by adding it to this block.";s:2:"id";s:14:"woo_custom_css";s:3:"std";s:0:"";s:4:"type";s:8:"textarea";}i:8;a:5:{s:4:"name";s:18:"Post/Page Comments";s:4:"desc";s:53:"Select if you want to comments on posts and/or pages.";s:2:"id";s:12:"woo_comments";s:4:"type";s:7:"select2";s:7:"options";a:4:{s:4:"post";s:10:"Posts Only";s:4:"page";s:10:"Pages Only";s:4:"both";s:13:"Pages / Posts";s:4:"none";s:4:"None";}}i:9;a:5:{s:4:"name";s:12:"Post Content";s:4:"desc";s:68:"Select if you want to show the full content or the excerpt on posts.";s:2:"id";s:16:"woo_post_content";s:4:"type";s:7:"select2";s:7:"options";a:2:{s:7:"excerpt";s:11:"The Excerpt";s:7:"content";s:12:"Full Content";}}i:10;a:5:{s:4:"name";s:19:"Display Breadcrumbs";s:4:"desc";s:57:"Display dynamic breadcrumbs on each page of your website.";s:2:"id";s:20:"woo_breadcrumbs_show";s:3:"std";s:5:"false";s:4:"type";s:8:"checkbox";}i:11;a:5:{s:4:"name";s:16:"Pagination Style";s:4:"desc";s:65:"Select the style of pagination you would like to use on the blog.";s:2:"id";s:19:"woo_pagination_type";s:4:"type";s:7:"select2";s:7:"options";a:2:{s:15:"paginated_links";s:7:"Numbers";s:6:"simple";s:13:"Next/Previous";}}i:12;a:3:{s:4:"name";s:6:"Layout";s:4:"icon";s:6:"layout";s:4:"type";s:7:"heading";}i:13;a:5:{s:4:"name";s:14:"Layout Manager";s:4:"desc";s:0:"";s:2:"id";s:25:"woo_layout_manager_notice";s:3:"std";s:226:"Below you can set the general site width and layout. To control the width of the columns in your themes layout, please visit the <a href="http://localhost/htdocs/nxt-admin/admin.php?page=woo-layout-manager">Layout Manager</a>.";s:4:"type";s:4:"info";}i:14;a:6:{s:4:"name";s:10:"Site Width";s:4:"desc";s:35:"Set the total site width in pixels.";s:2:"id";s:16:"woo_layout_width";s:3:"std";s:5:"940px";s:4:"type";s:6:"select";s:7:"options";a:6:{s:6:"1200px";s:6:"1200px";s:5:"980px";s:5:"980px";s:5:"960px";s:5:"960px";s:5:"940px";s:5:"940px";s:5:"880px";s:5:"880px";s:5:"760px";s:5:"760px";}}i:15;a:6:{s:4:"name";s:11:"Main Layout";s:4:"desc";s:82:"Select main content and sidebar alignment. Choose between 1, 2 or 3 column layout.";s:2:"id";s:10:"woo_layout";s:3:"std";s:12:"two-col-left";s:4:"type";s:6:"images";s:7:"options";a:6:{s:7:"one-col";s:73:"http://localhost/htdocs/nxt-content/themes/canvas/functions/images/1c.png";s:12:"two-col-left";s:74:"http://localhost/htdocs/nxt-content/themes/canvas/functions/images/2cl.png";s:13:"two-col-right";s:74:"http://localhost/htdocs/nxt-content/themes/canvas/functions/images/2cr.png";s:14:"three-col-left";s:74:"http://localhost/htdocs/nxt-content/themes/canvas/functions/images/3cl.png";s:16:"three-col-middle";s:74:"http://localhost/htdocs/nxt-content/themes/canvas/functions/images/3cm.png";s:15:"three-col-right";s:74:"http://localhost/htdocs/nxt-content/themes/canvas/functions/images/3cr.png";}}i:16;a:6:{s:4:"name";s:19:"Footer Widget Areas";s:4:"desc";s:56:"Select how many footer widget areas you want to display.";s:2:"id";s:19:"woo_footer_sidebars";s:3:"std";s:1:"4";s:4:"type";s:6:"images";s:7:"options";a:5:{i:0;s:87:"http://localhost/htdocs/nxt-content/themes/canvas/functions/images/footer-widgets-0.png";i:1;s:87:"http://localhost/htdocs/nxt-content/themes/canvas/functions/images/footer-widgets-1.png";i:2;s:87:"http://localhost/htdocs/nxt-content/themes/canvas/functions/images/footer-widgets-2.png";i:3;s:87:"http://localhost/htdocs/nxt-content/themes/canvas/functions/images/footer-widgets-3.png";i:4;s:87:"http://localhost/htdocs/nxt-content/themes/canvas/functions/images/footer-widgets-4.png";}}i:17;a:5:{s:4:"name";s:25:"Disable ALL custom styles";s:4:"desc";s:72:"Check this if you want to disable output of all custom CSS in the theme.";s:2:"id";s:17:"woo_style_disable";s:3:"std";s:5:"false";s:4:"type";s:8:"checkbox";}i:18;a:5:{s:4:"name";s:27:"Category Exclude - Homepage";s:4:"desc";s:122:"Specify a comma seperated list of category IDs or slugs that you''d like to exclude from your homepage (eg: uncategorized).";s:2:"id";s:21:"woo_exclude_cats_home";s:3:"std";s:0:"";s:4:"type";s:4:"text";}i:19;a:5:{s:4:"name";s:37:"Category Exclude - Blog Page Template";s:4:"desc";s:134:"Specify a comma seperated list of category IDs or slugs that you''d like to exclude from your ''Blog'' page template (eg: uncategorized).";s:2:"id";s:21:"woo_exclude_cats_blog";s:3:"std";s:0:"";s:4:"type";s:4:"text";}i:20;a:3:{s:4:"name";s:15:"General Styling";s:4:"icon";s:7:"styling";s:4:"type";s:7:"heading";}i:21;a:5:{s:4:"name";s:16:"Background Color";s:4:"desc";s:76:"Pick a custom color for site background or add a hex color code e.g. #e6e6e6";s:2:"id";s:12:"woo_style_bg";s:3:"std";s:0:"";s:4:"type";s:5:"color";}i:22;a:5:{s:4:"name";s:16:"Background Image";s:4:"desc";s:102:"Upload a background image, or specify the image address of your image. (http://yoursite.com/image.png)";s:2:"id";s:18:"woo_style_bg_image";s:3:"std";s:0:"";s:4:"type";s:6:"upload";}i:23;a:5:{s:4:"name";s:23:"Background Image Repeat";s:4:"desc";s:53:"Select how you want your background image to display.";s:2:"id";s:25:"woo_style_bg_image_repeat";s:4:"type";s:6:"select";s:7:"options";a:4:{s:9:"No Repeat";s:9:"no-repeat";s:6:"Repeat";s:6:"repeat";s:19:"Repeat Horizontally";s:8:"repeat-x";s:17:"Repeat Vertically";s:8:"repeat-y";}}i:24;a:5:{s:4:"name";s:10:"Top Border";s:4:"desc";s:45:"Specify border properties for the top border.";s:2:"id";s:14:"woo_border_top";s:3:"std";a:3:{s:5:"width";s:1:"4";s:5:"style";s:5:"solid";s:5:"color";s:7:"#000000";}s:4:"type";s:6:"border";}i:25;a:5:{s:4:"name";s:10:"Link Color";s:4:"desc";s:66:"Pick a custom color for links or add a hex color code e.g. #697e09";s:2:"id";s:14:"woo_link_color";s:3:"std";s:0:"";s:4:"type";s:5:"color";}i:26;a:5:{s:4:"name";s:16:"Link Hover Color";s:4:"desc";s:72:"Pick a custom color for links hover or add a hex color code e.g. #697e09";s:2:"id";s:20:"woo_link_hover_color";s:3:"std";s:0:"";s:4:"type";s:5:"color";}i:27;a:5:{s:4:"name";s:12:"Button Color";s:4:"desc";s:68:"Pick a custom color for buttons or add a hex color code e.g. #697e09";s:2:"id";s:16:"woo_button_color";s:3:"std";s:0:"";s:4:"type";s:5:"color";}i:28;a:5:{s:4:"name";s:20:"General Border Color";s:4:"desc";s:82:"Pick a custom color for general border colors or add a hex color code e.g. #e6e6e6";s:2:"id";s:16:"woo_style_border";s:3:"std";s:0:"";s:4:"type";s:5:"color";}i:29;a:3:{s:4:"name";s:18:"General Typography";s:4:"icon";s:10:"typography";s:4:"type";s:7:"heading";}i:30;a:5:{s:4:"name";s:18:"General Typography";s:4:"desc";s:0:"";s:2:"id";s:23:"woo_general_font_notice";s:3:"std";s:229:"The general typography options below only control typography not covered by other typography options. You can control specific typography on post title, post content, widget titles etc. in the other sections in the options panel.";s:4:"type";s:4:"info";}i:31;a:5:{s:4:"name";s:23:"General Text Font Style";s:4:"desc";s:35:"Select typography for general text.";s:2:"id";s:13:"woo_font_text";s:3:"std";a:5:{s:4:"size";s:2:"14";s:4:"unit";s:2:"px";s:4:"face";s:17:"Arial, sans-serif";s:5:"style";s:6:"normal";s:5:"color";s:7:"#555555";}s:4:"type";s:10:"typography";}i:32;a:5:{s:4:"name";s:13:"H1 Font Style";s:4:"desc";s:45:"Select the typography you want for header H1.";s:2:"id";s:11:"woo_font_h1";s:3:"std";a:5:{s:4:"size";s:2:"28";s:4:"unit";s:2:"px";s:4:"face";s:8:"PT Serif";s:5:"style";s:6:"normal";s:5:"color";s:7:"#222222";}s:4:"type";s:10:"typography";}i:33;a:5:{s:4:"name";s:13:"H2 Font Style";s:4:"desc";s:45:"Select the typography you want for header H2.";s:2:"id";s:11:"woo_font_h2";s:3:"std";a:5:{s:4:"size";s:2:"24";s:4:"unit";s:2:"px";s:4:"face";s:8:"PT Serif";s:5:"style";s:6:"normal";s:5:"color";s:7:"#222222";}s:4:"type";s:10:"typography";}i:34;a:5:{s:4:"name";s:13:"H3 Font Style";s:4:"desc";s:45:"Select the typography you want for header H3.";s:2:"id";s:11:"woo_font_h3";s:3:"std";a:5:{s:4:"size";s:2:"20";s:4:"unit";s:2:"px";s:4:"face";s:8:"PT Serif";s:5:"style";s:6:"normal";s:5:"color";s:7:"#222222";}s:4:"type";s:10:"typography";}i:35;a:5:{s:4:"name";s:13:"H4 Font Style";s:4:"desc";s:45:"Select the typography you want for header H4.";s:2:"id";s:11:"woo_font_h4";s:3:"std";a:5:{s:4:"size";s:2:"16";s:4:"unit";s:2:"px";s:4:"face";s:8:"PT Serif";s:5:"style";s:6:"normal";s:5:"color";s:7:"#222222";}s:4:"type";s:10:"typography";}i:36;a:5:{s:4:"name";s:13:"H5 Font Style";s:4:"desc";s:45:"Select the typography you want for header H5.";s:2:"id";s:11:"woo_font_h5";s:3:"std";a:5:{s:4:"size";s:2:"14";s:4:"unit";s:2:"px";s:4:"face";s:8:"PT Serif";s:5:"style";s:6:"normal";s:5:"color";s:7:"#222222";}s:4:"type";s:10:"typography";}i:37;a:5:{s:4:"name";s:13:"H6 Font Style";s:4:"desc";s:45:"Select the typography you want for header H6.";s:2:"id";s:11:"woo_font_h6";s:3:"std";a:5:{s:4:"size";s:2:"12";s:4:"unit";s:2:"px";s:4:"face";s:8:"PT Serif";s:5:"style";s:6:"normal";s:5:"color";s:7:"#222222";}s:4:"type";s:10:"typography";}i:38;a:3:{s:4:"name";s:12:"Boxed Layout";s:4:"icon";s:3:"box";s:4:"type";s:7:"heading";}i:39;a:5:{s:4:"name";s:18:"Boxed Layout Style";s:4:"desc";s:30:"Enable the boxed layout style.";s:2:"id";s:16:"woo_layout_boxed";s:3:"std";s:5:"false";s:4:"type";s:8:"checkbox";}i:40;a:5:{s:4:"name";s:20:"Box Background Color";s:4:"desc";s:81:"Pick a custom color for the boxed background or add a hex color code e.g. #ffffff";s:2:"id";s:16:"woo_style_box_bg";s:3:"std";s:0:"";s:4:"type";s:5:"color";}i:41;a:5:{s:4:"name";s:10:"Box Margin";s:4:"desc";s:69:"Enter an integer value i.e. 20 for the desired top and bottom margin.";s:2:"id";s:14:"woo_box_margin";s:3:"std";s:0:"";s:4:"type";a:2:{i:0;a:4:{s:2:"id";s:18:"woo_box_margin_top";s:4:"type";s:4:"text";s:3:"std";s:0:"";s:4:"meta";s:3:"Top";}i:1;a:4:{s:2:"id";s:21:"woo_box_margin_bottom";s:4:"type";s:4:"text";s:3:"std";s:0:"";s:4:"meta";s:6:"Bottom";}}}i:42;a:5:{s:4:"name";s:21:"Box Border Top/Bottom";s:4:"desc";s:47:"Specify border properties for the boxed layout.";s:2:"id";s:17:"woo_box_border_tb";s:3:"std";a:3:{s:5:"width";s:1:"4";s:5:"style";s:5:"solid";s:5:"color";s:7:"#dbdbdb";}s:4:"type";s:6:"border";}i:43;a:5:{s:4:"name";s:21:"Box Border Left/Right";s:4:"desc";s:47:"Specify border properties for the boxed layout.";s:2:"id";s:17:"woo_box_border_lr";s:3:"std";a:3:{s:5:"width";s:1:"4";s:5:"style";s:5:"solid";s:5:"color";s:7:"#dbdbdb";}s:4:"type";s:6:"border";}i:44;a:5:{s:4:"name";s:19:"Box Rounded Corners";s:4:"desc";s:100:"Set amount of pixels for border radius (rounded corners). Will only show in CSS3 compatible browser.";s:2:"id";s:21:"woo_box_border_radius";s:4:"type";s:6:"select";s:7:"options";a:21:{i:0;s:3:"0px";i:1;s:3:"1px";i:2;s:3:"2px";i:3;s:3:"3px";i:4;s:3:"4px";i:5;s:3:"5px";i:6;s:3:"6px";i:7;s:3:"7px";i:8;s:3:"8px";i:9;s:3:"9px";i:10;s:4:"10px";i:11;s:4:"11px";i:12;s:4:"12px";i:13;s:4:"13px";i:14;s:4:"14px";i:15;s:4:"15px";i:16;s:4:"16px";i:17;s:4:"17px";i:18;s:4:"18px";i:19;s:4:"19px";i:20;s:4:"20px";}}i:45;a:5:{s:4:"name";s:10:"Box Shadow";s:4:"desc";s:61:"Enable box shadow. Will only show in CSS3 compatible browser.";s:2:"id";s:14:"woo_box_shadow";s:3:"std";s:4:"true";s:4:"type";s:8:"checkbox";}i:46;a:3:{s:4:"name";s:14:"Header Styling";s:4:"icon";s:6:"header";s:4:"type";s:7:"heading";}i:47;a:5:{s:4:"name";s:23:"Header Background Color";s:4:"desc";s:78:"Pick a custom color for header background or add a hex color code e.g. #e6e6e6";s:2:"id";s:13:"woo_header_bg";s:3:"std";s:0:"";s:4:"type";s:5:"color";}i:48;a:5:{s:4:"name";s:23:"Header Background Image";s:4:"desc";s:154:"Upload a background image, or specify the image address of your image (http://yoursite.com/image.png). <br/>Image should be same width as your site width.";s:2:"id";s:19:"woo_header_bg_image";s:3:"std";s:0:"";s:4:"type";s:6:"upload";}i:49;a:5:{s:4:"name";s:30:"Header Background Image Repeat";s:4:"desc";s:53:"Select how you want your background image to display.";s:2:"id";s:26:"woo_header_bg_image_repeat";s:4:"type";s:6:"select";s:7:"options";a:4:{s:9:"No Repeat";s:9:"no-repeat";s:6:"Repeat";s:6:"repeat";s:19:"Repeat Horizontally";s:8:"repeat-x";s:17:"Repeat Vertically";s:8:"repeat-y";}}i:50;a:5:{s:4:"name";s:13:"Header Border";s:4:"desc";s:41:"Specify border properties for the header.";s:2:"id";s:17:"woo_header_border";s:3:"std";a:3:{s:5:"width";s:1:"0";s:5:"style";s:5:"solid";s:5:"color";s:0:"";}s:4:"type";s:6:"border";}i:51;a:5:{s:4:"name";s:24:"Header Margin Top/Bottom";s:4:"desc";s:61:"Enter an integer value i.e. 20 for the desired header margin.";s:2:"id";s:20:"woo_header_margin_tb";s:3:"std";s:0:"";s:4:"type";a:2:{i:0;a:4:{s:2:"id";s:21:"woo_header_margin_top";s:4:"type";s:4:"text";s:3:"std";s:1:"0";s:4:"meta";s:3:"Top";}i:1;a:4:{s:2:"id";s:24:"woo_header_margin_bottom";s:4:"type";s:4:"text";s:3:"std";s:1:"0";s:4:"meta";s:6:"Bottom";}}}i:52;a:5:{s:4:"name";s:25:"Header Padding Top/Bottom";s:4:"desc";s:62:"Enter an integer value i.e. 20 for the desired header padding.";s:2:"id";s:21:"woo_header_padding_tb";s:3:"std";s:0:"";s:4:"type";a:2:{i:0;a:4:{s:2:"id";s:22:"woo_header_padding_top";s:4:"type";s:4:"text";s:3:"std";s:2:"40";s:4:"meta";s:3:"Top";}i:1;a:4:{s:2:"id";s:25:"woo_header_padding_bottom";s:4:"type";s:4:"text";s:3:"std";s:2:"30";s:4:"meta";s:6:"Bottom";}}}i:53;a:5:{s:4:"name";s:25:"Header Padding Left/Right";s:4:"desc";s:62:"Enter an integer value i.e. 20 for the desired header padding.";s:2:"id";s:21:"woo_header_padding_lr";s:3:"std";s:0:"";s:4:"type";a:2:{i:0;a:4:{s:2:"id";s:23:"woo_header_padding_left";s:4:"type";s:4:"text";s:3:"std";s:0:"";s:4:"meta";s:4:"Left";}i:1;a:4:{s:2:"id";s:24:"woo_header_padding_right";s:4:"type";s:4:"text";s:3:"std";s:0:"";s:4:"meta";s:5:"Right";}}}i:54;a:5:{s:4:"name";s:21:"Site Title Font Style";s:4:"desc";s:33:"Select typography for site title.";s:2:"id";s:13:"woo_font_logo";s:3:"std";a:5:{s:4:"size";s:2:"40";s:4:"unit";s:2:"px";s:4:"face";s:8:"PT Serif";s:5:"style";s:6:"normal";s:5:"color";s:7:"#222222";}s:4:"type";s:10:"typography";}i:55;a:5:{s:4:"name";s:27:"Site Description Font Style";s:4:"desc";s:39:"Select typography for site description.";s:2:"id";s:13:"woo_font_desc";s:3:"std";a:5:{s:4:"size";s:2:"14";s:4:"unit";s:2:"px";s:4:"face";s:8:"PT Serif";s:5:"style";s:6:"italic";s:5:"color";s:7:"#999999";}s:4:"type";s:10:"typography";}i:56;a:3:{s:4:"name";s:12:"Post Styling";s:4:"icon";s:4:"main";s:4:"type";s:7:"heading";}i:57;a:5:{s:4:"name";s:21:"Post Title Font Style";s:4:"desc";s:33:"Select typography for post title.";s:2:"id";s:19:"woo_font_post_title";s:3:"std";a:5:{s:4:"size";s:2:"24";s:4:"unit";s:2:"px";s:4:"face";s:8:"PT Serif";s:5:"style";s:6:"normal";s:5:"color";s:7:"#222222";}s:4:"type";s:10:"typography";}i:58;a:5:{s:4:"name";s:20:"Post Meta Font Style";s:4:"desc";s:32:"Select typography for post meta.";s:2:"id";s:18:"woo_font_post_meta";s:3:"std";a:5:{s:4:"size";s:2:"11";s:4:"unit";s:2:"px";s:4:"face";s:8:"PT Serif";s:5:"style";s:6:"normal";s:5:"color";s:7:"#868686";}s:4:"type";s:10:"typography";}i:59;a:5:{s:4:"name";s:20:"Post Text Font Style";s:4:"desc";s:32:"Select typography for post text.";s:2:"id";s:18:"woo_font_post_text";s:3:"std";a:5:{s:4:"size";s:2:"16";s:4:"unit";s:2:"px";s:4:"face";s:8:"PT Serif";s:5:"style";s:6:"normal";s:5:"color";s:7:"#555555";}s:4:"type";s:10:"typography";}i:60;a:5:{s:4:"name";s:29:"Post More (bottom) Font Style";s:4:"desc";s:39:"Select typography for post bottom text.";s:2:"id";s:18:"woo_font_post_more";s:3:"std";a:5:{s:4:"size";s:2:"12";s:4:"unit";s:2:"px";s:4:"face";s:17:"Arial, sans-serif";s:5:"style";s:6:"normal";s:5:"color";s:7:"#868686";}s:4:"type";s:10:"typography";}i:61;a:5:{s:4:"name";s:29:"Post More (bottom) Border Top";s:4:"desc";s:48:"Specify border properties for post more section.";s:2:"id";s:24:"woo_post_more_border_top";s:3:"std";a:3:{s:5:"width";s:1:"4";s:5:"style";s:5:"solid";s:5:"color";s:7:"#e6e6e6";}s:4:"type";s:6:"border";}i:62;a:5:{s:4:"name";s:32:"Post More (bottom) Border Bottom";s:4:"desc";s:48:"Specify border properties for post more section.";s:2:"id";s:27:"woo_post_more_border_bottom";s:3:"std";a:3:{s:5:"width";s:1:"1";s:5:"style";s:5:"solid";s:5:"color";s:7:"#e6e6e6";}s:4:"type";s:6:"border";}i:63;a:5:{s:4:"name";s:28:"Post Author Background Color";s:4:"desc";s:95:"Pick a custom background color for the post author section or add a hex color code e.g. #fafafa";s:2:"id";s:18:"woo_post_author_bg";s:3:"std";s:7:"#fafafa";s:4:"type";s:5:"color";}i:64;a:5:{s:4:"name";s:22:"Post Author Border Top";s:4:"desc";s:50:"Specify border properties for post author section.";s:2:"id";s:26:"woo_post_author_border_top";s:3:"std";a:3:{s:5:"width";s:1:"1";s:5:"style";s:5:"solid";s:5:"color";s:7:"#e6e6e6";}s:4:"type";s:6:"border";}i:65;a:5:{s:4:"name";s:25:"Post Author Border Bottom";s:4:"desc";s:50:"Specify border properties for post author section.";s:2:"id";s:29:"woo_post_author_border_bottom";s:3:"std";a:3:{s:5:"width";s:1:"4";s:5:"style";s:5:"solid";s:5:"color";s:7:"#e6e6e6";}s:4:"type";s:6:"border";}i:66;a:5:{s:4:"name";s:19:"Disable Post Author";s:4:"desc";s:31:"Disable post author below post?";s:2:"id";s:23:"woo_disable_post_author";s:3:"std";s:5:"false";s:4:"type";s:8:"checkbox";}i:67;a:5:{s:4:"name";s:40:"Comments Background Color (even threads)";s:4:"desc";s:102:"Pick a custom background color for the post comments even threads or add a hex color code e.g. #fafafa";s:2:"id";s:20:"woo_post_comments_bg";s:3:"std";s:0:"";s:4:"type";s:5:"color";}i:68;a:5:{s:4:"name";s:26:"Page Navigation Font Style";s:4:"desc";s:43:"Select typography for Page Navigation text.";s:2:"id";s:16:"woo_pagenav_font";s:3:"std";a:5:{s:4:"size";s:2:"12";s:4:"unit";s:2:"px";s:4:"face";s:8:"PT Serif";s:5:"style";s:6:"italic";s:5:"color";s:7:"#777777";}s:4:"type";s:10:"typography";}i:69;a:5:{s:4:"name";s:32:"Page Navigation Background Color";s:4:"desc";s:91:"Pick a custom color for the Page Navigation background or add a hex color code e.g. #fafafa";s:2:"id";s:14:"woo_pagenav_bg";s:3:"std";s:0:"";s:4:"type";s:5:"color";}i:70;a:5:{s:4:"name";s:26:"Page Navigation Border Top";s:4:"desc";s:54:"Specify border properties for Page Navigation section.";s:2:"id";s:22:"woo_pagenav_border_top";s:3:"std";a:3:{s:5:"width";s:1:"1";s:5:"style";s:5:"solid";s:5:"color";s:7:"#e6e6e6";}s:4:"type";s:6:"border";}i:71;a:5:{s:4:"name";s:29:"Page Navigation Border Bottom";s:4:"desc";s:54:"Specify border properties for Page Navigation section.";s:2:"id";s:25:"woo_pagenav_border_bottom";s:3:"std";a:3:{s:5:"width";s:1:"4";s:5:"style";s:5:"solid";s:5:"color";s:7:"#e6e6e6";}s:4:"type";s:6:"border";}i:72;a:5:{s:4:"name";s:25:"Archive Header Font Style";s:4:"desc";s:37:"Select typography for Archive header.";s:2:"id";s:23:"woo_archive_header_font";s:3:"std";a:5:{s:4:"size";s:2:"18";s:4:"unit";s:2:"px";s:4:"face";s:17:"Arial, sans-serif";s:5:"style";s:0:"";s:5:"color";s:7:"#555555";}s:4:"type";s:10:"typography";}i:73;a:5:{s:4:"name";s:28:"Archive Header Border Bottom";s:4:"desc";s:44:"Specify border properties for Archive header";s:2:"id";s:32:"woo_archive_header_border_bottom";s:3:"std";a:3:{s:5:"width";s:1:"5";s:5:"style";s:5:"solid";s:5:"color";s:7:"#e6e6e6";}s:4:"type";s:6:"border";}i:74;a:5:{s:4:"name";s:31:"Disable Archive Header RSS link";s:4:"desc";s:34:"Disable RSS link in Archive header";s:2:"id";s:30:"woo_archive_header_disable_rss";s:3:"std";s:5:"false";s:4:"type";s:8:"checkbox";}i:75;a:3:{s:4:"name";s:14:"Widget Styling";s:4:"icon";s:7:"sidebar";s:4:"type";s:7:"heading";}i:76;a:5:{s:4:"name";s:23:"Widget Background Color";s:4:"desc";s:82:"Pick a custom color for the widget background or add a hex color code e.g. #cccccc";s:2:"id";s:13:"woo_widget_bg";s:3:"std";s:0:"";s:4:"type";s:5:"color";}i:77;a:5:{s:4:"name";s:13:"Widget Border";s:4:"desc";s:38:"Specify border properties for widgets.";s:2:"id";s:17:"woo_widget_border";s:3:"std";a:3:{s:5:"width";s:1:"0";s:5:"style";s:5:"solid";s:5:"color";s:7:"#dbdbdb";}s:4:"type";s:6:"border";}i:78;a:5:{s:4:"name";s:14:"Widget Padding";s:4:"desc";s:62:"Enter an integer value i.e. 20 for the desired widget padding.";s:2:"id";s:18:"woo_widget_padding";s:3:"std";s:0:"";s:4:"type";a:2:{i:0;a:4:{s:2:"id";s:21:"woo_widget_padding_tb";s:4:"type";s:4:"text";s:3:"std";s:0:"";s:4:"meta";s:10:"Top/Bottom";}i:1;a:4:{s:2:"id";s:21:"woo_widget_padding_lr";s:4:"type";s:4:"text";s:3:"std";s:0:"";s:4:"meta";s:10:"Left/Right";}}}i:79;a:5:{s:4:"name";s:12:"Widget Title";s:4:"desc";s:52:"Select the typography you want for the widget title.";s:2:"id";s:21:"woo_widget_font_title";s:3:"std";a:5:{s:4:"size";s:2:"14";s:4:"unit";s:2:"px";s:4:"face";s:8:"PT Serif";s:5:"style";s:4:"bold";s:5:"color";s:7:"#555555";}s:4:"type";s:10:"typography";}i:80;a:5:{s:4:"name";s:26:"Widget Title Bottom Border";s:4:"desc";s:45:"Specify border property for the widget title.";s:2:"id";s:23:"woo_widget_title_border";s:3:"std";a:3:{s:5:"width";s:1:"3";s:5:"style";s:5:"solid";s:5:"color";s:7:"#e6e6e6";}s:4:"type";s:6:"border";}i:81;a:5:{s:4:"name";s:11:"Widget Text";s:4:"desc";s:51:"Select the typography you want for the widget text.";s:2:"id";s:20:"woo_widget_font_text";s:3:"std";a:5:{s:4:"size";s:2:"12";s:4:"unit";s:2:"px";s:4:"face";s:17:"Arial, sans-serif";s:5:"style";s:6:"normal";s:5:"color";s:7:"#555555";}s:4:"type";s:10:"typography";}i:82;a:5:{s:4:"name";s:22:"Widget Rounded Corners";s:4:"desc";s:100:"Set amount of pixels for border radius (rounded corners). Will only show in CSS3 compatible browser.";s:2:"id";s:24:"woo_widget_border_radius";s:4:"type";s:6:"select";s:7:"options";a:21:{i:0;s:3:"0px";i:1;s:3:"1px";i:2;s:3:"2px";i:3;s:3:"3px";i:4;s:3:"4px";i:5;s:3:"5px";i:6;s:3:"6px";i:7;s:3:"7px";i:8;s:3:"8px";i:9;s:3:"9px";i:10;s:4:"10px";i:11;s:4:"11px";i:12;s:4:"12px";i:13;s:4:"13px";i:14;s:4:"14px";i:15;s:4:"15px";i:16;s:4:"16px";i:17;s:4:"17px";i:18;s:4:"18px";i:19;s:4:"19px";i:20;s:4:"20px";}}i:83;a:5:{s:4:"name";s:28:"Tabs Widget Background color";s:4:"desc";s:76:"Pick a custom color for the tabs widget or add a hex color code e.g. #cccccc";s:2:"id";s:18:"woo_widget_tabs_bg";s:3:"std";s:0:"";s:4:"type";s:5:"color";}i:84;a:5:{s:4:"name";s:35:"Tabs Widget Inside Background Color";s:4:"desc";s:76:"Pick a custom color for the tabs widget or add a hex color code e.g. #cccccc";s:2:"id";s:25:"woo_widget_tabs_bg_inside";s:3:"std";s:0:"";s:4:"type";s:5:"color";}i:85;a:5:{s:4:"name";s:17:"Tabs Widget Title";s:4:"desc";s:51:"Select the typography you want for the widget text.";s:2:"id";s:20:"woo_widget_tabs_font";s:3:"std";a:5:{s:4:"size";s:2:"12";s:4:"unit";s:2:"px";s:4:"face";s:8:"PT Serif";s:5:"style";s:4:"bold";s:5:"color";s:7:"#555555";}s:4:"type";s:10:"typography";}i:86;a:5:{s:4:"name";s:30:"Tabs Widget Meta / Tabber Font";s:4:"desc";s:51:"Select the typography you want for the widget text.";s:2:"id";s:25:"woo_widget_tabs_font_meta";s:3:"std";a:5:{s:4:"size";s:2:"11";s:4:"unit";s:2:"px";s:4:"face";s:36:"&quot;Trebuchet MS&quot;, sans-serif";s:5:"style";s:6:"normal";s:5:"color";s:7:"#777777";}s:4:"type";s:10:"typography";}i:87;a:3:{s:4:"name";s:14:"Footer Styling";s:4:"icon";s:6:"footer";s:4:"type";s:7:"heading";}i:88;a:5:{s:4:"name";s:17:"Footer Font Style";s:4:"desc";s:29:"Select typography for footer.";s:2:"id";s:15:"woo_footer_font";s:3:"std";a:5:{s:4:"size";s:2:"14";s:4:"unit";s:2:"px";s:4:"face";s:8:"PT Serif";s:5:"style";s:6:"italic";s:5:"color";s:7:"#777777";}s:4:"type";s:10:"typography";}i:89;a:5:{s:4:"name";s:17:"Footer Background";s:4:"desc";s:53:"Select the background color you want for your footer.";s:2:"id";s:13:"woo_footer_bg";s:3:"std";s:0:"";s:4:"type";s:5:"color";}i:90;a:5:{s:4:"name";s:17:"Footer Border Top";s:4:"desc";s:45:"Specify top border properties for the footer.";s:2:"id";s:21:"woo_footer_border_top";s:3:"std";a:3:{s:5:"width";s:1:"4";s:5:"style";s:5:"solid";s:5:"color";s:7:"#dbdbdb";}s:4:"type";s:6:"border";}i:91;a:5:{s:4:"name";s:20:"Footer Border Bottom";s:4:"desc";s:48:"Specify bottom border properties for the footer.";s:2:"id";s:24:"woo_footer_border_bottom";s:3:"std";a:3:{s:5:"width";s:1:"0";s:5:"style";s:5:"solid";s:5:"color";s:0:"";}s:4:"type";s:6:"border";}i:92;a:5:{s:4:"name";s:24:"Footer Border Left/Right";s:4:"desc";s:52:"Specify left/right border properties for the footer.";s:2:"id";s:20:"woo_footer_border_lr";s:3:"std";a:3:{s:5:"width";s:1:"0";s:5:"style";s:5:"solid";s:5:"color";s:0:"";}s:4:"type";s:6:"border";}i:93;a:5:{s:4:"name";s:22:"Footer Rounded Corners";s:4:"desc";s:100:"Set amount of pixels for border radius (rounded corners). Will only show in CSS3 compatible browser.";s:2:"id";s:24:"woo_footer_border_radius";s:4:"type";s:6:"select";s:7:"options";a:21:{i:0;s:3:"0px";i:1;s:3:"1px";i:2;s:3:"2px";i:3;s:3:"3px";i:4;s:3:"4px";i:5;s:3:"5px";i:6;s:3:"6px";i:7;s:3:"7px";i:8;s:3:"8px";i:9;s:3:"9px";i:10;s:4:"10px";i:11;s:4:"11px";i:12;s:4:"12px";i:13;s:4:"13px";i:14;s:4:"14px";i:15;s:4:"15px";i:16;s:4:"16px";i:17;s:4:"17px";i:18;s:4:"18px";i:19;s:4:"19px";i:20;s:4:"20px";}}i:94;a:5:{s:4:"name";s:21:"Custom Affiliate Link";s:4:"desc";s:71:"Add an affiliate link to the WooThemes logo in the footer of the theme.";s:2:"id";s:19:"woo_footer_aff_link";s:3:"std";s:0:"";s:4:"type";s:4:"text";}i:95;a:6:{s:4:"name";s:27:"Enable Custom Footer (Left)";s:4:"desc";s:58:"Activate to add the custom text below to the theme footer.";s:2:"id";s:15:"woo_footer_left";s:5:"class";s:9:"collapsed";s:3:"std";s:5:"false";s:4:"type";s:8:"checkbox";}i:96;a:6:{s:4:"name";s:18:"Custom Text (Left)";s:4:"desc";s:66:"Custom HTML and Text that will appear in the footer of your theme.";s:2:"id";s:20:"woo_footer_left_text";s:5:"class";s:11:"hidden last";s:3:"std";s:7:"<p></p>";s:4:"type";s:8:"textarea";}i:97;a:6:{s:4:"name";s:28:"Enable Custom Footer (Right)";s:4:"desc";s:58:"Activate to add the custom text below to the theme footer.";s:2:"id";s:16:"woo_footer_right";s:5:"class";s:9:"collapsed";s:3:"std";s:5:"false";s:4:"type";s:8:"checkbox";}i:98;a:6:{s:4:"name";s:19:"Custom Text (Right)";s:4:"desc";s:66:"Custom HTML and Text that will appear in the footer of your theme.";s:2:"id";s:21:"woo_footer_right_text";s:5:"class";s:11:"hidden last";s:3:"std";s:7:"<p></p>";s:4:"type";s:8:"textarea";}i:99;a:3:{s:4:"name";s:18:"Navigation Styling";s:4:"icon";s:3:"nav";s:4:"type";s:7:"heading";}i:100;a:5:{s:4:"name";s:19:"Show Subscribe Link";s:4:"desc";s:51:"Show the Subscribe to RSS link in right navigation.";s:2:"id";s:11:"woo_nav_rss";s:3:"std";s:4:"true";s:4:"type";s:8:"checkbox";}i:101;a:5:{s:4:"name";s:16:"Background Color";s:4:"desc";s:86:"Pick a custom color for the navigation background or add a hex color code e.g. #cccccc";s:2:"id";s:10:"woo_nav_bg";s:3:"std";s:0:"";s:4:"type";s:5:"color";}i:102;a:5:{s:4:"name";s:21:"Navigation Font Style";s:4:"desc";s:33:"Select typography for navigation.";s:2:"id";s:12:"woo_nav_font";s:3:"std";a:5:{s:4:"size";s:2:"14";s:4:"unit";s:2:"px";s:4:"face";s:0:"";s:5:"style";s:0:"";s:5:"color";s:7:"#555555";}s:4:"type";s:10:"typography";}i:103;a:5:{s:4:"name";s:11:"Hover Color";s:4:"desc";s:88:"Pick a custom color for the navigation hover effect or add a hex color code e.g. #eeeeee";s:2:"id";s:13:"woo_nav_hover";s:3:"std";s:0:"";s:4:"type";s:5:"color";}i:104;a:5:{s:4:"name";s:23:"Current Menu Item Color";s:4:"desc";s:114:"Pick a custom color for highlighting the current menu item in the navigation, or add a hex color code e.g. #eeeeee";s:2:"id";s:19:"woo_nav_currentitem";s:3:"std";s:0:"";s:4:"type";s:5:"color";}i:105;a:5:{s:4:"name";s:10:"Border Top";s:4:"desc";s:45:"Specify border properties for the navigation.";s:2:"id";s:18:"woo_nav_border_top";s:3:"std";a:3:{s:5:"width";s:1:"1";s:5:"style";s:5:"solid";s:5:"color";s:7:"#dbdbdb";}s:4:"type";s:6:"border";}i:106;a:5:{s:4:"name";s:13:"Border Bottom";s:4:"desc";s:45:"Specify border properties for the navigation.";s:2:"id";s:18:"woo_nav_border_bot";s:3:"std";a:3:{s:5:"width";s:1:"4";s:5:"style";s:5:"solid";s:5:"color";s:7:"#dbdbdb";}s:4:"type";s:6:"border";}i:107;a:5:{s:4:"name";s:17:"Border Left/Right";s:4:"desc";s:45:"Specify border properties for the navigation.";s:2:"id";s:17:"woo_nav_border_lr";s:3:"std";a:3:{s:5:"width";s:1:"0";s:5:"style";s:5:"solid";s:5:"color";s:7:"#dbdbdb";}s:4:"type";s:6:"border";}i:108;a:5:{s:4:"name";s:26:"Navigation Rounded Corners";s:4:"desc";s:100:"Set amount of pixels for border radius (rounded corners). Will only show in CSS3 compatible browser.";s:2:"id";s:21:"woo_nav_border_radius";s:4:"type";s:6:"select";s:7:"options";a:21:{i:0;s:3:"0px";i:1;s:3:"1px";i:2;s:3:"2px";i:3;s:3:"3px";i:4;s:3:"4px";i:5;s:3:"5px";i:6;s:3:"6px";i:7;s:3:"7px";i:8;s:3:"8px";i:9;s:3:"9px";i:10;s:4:"10px";i:11;s:4:"11px";i:12;s:4:"12px";i:13;s:4:"13px";i:14;s:4:"14px";i:15;s:4:"15px";i:16;s:4:"16px";i:17;s:4:"17px";i:18;s:4:"18px";i:19;s:4:"19px";i:20;s:4:"20px";}}i:109;a:5:{s:4:"name";s:33:"Top Navigation - Background Color";s:4:"desc";s:198:"Pick a custom color for the top navigation background or add a hex color code e.g. #000.<br />Top Navigation can be added with <a href="http://localhost/htdocs/nxt-admin/nav-menus.php">nxt Menus</a>";s:2:"id";s:14:"woo_top_nav_bg";s:3:"std";s:0:"";s:4:"type";s:5:"color";}i:110;a:5:{s:4:"name";s:28:"Top Navigation - Hover Color";s:4:"desc";s:82:"Pick a custom color for the top navigation hover or add a hex color code e.g. #000";s:2:"id";s:17:"woo_top_nav_hover";s:3:"std";s:0:"";s:4:"type";s:5:"color";}i:111;a:5:{s:4:"name";s:25:"Top Navigation Font Style";s:4:"desc";s:33:"Select typography for navigation.";s:2:"id";s:16:"woo_top_nav_font";s:3:"std";a:5:{s:4:"size";s:2:"14";s:4:"unit";s:2:"px";s:4:"face";s:0:"";s:5:"style";s:0:"";s:5:"color";s:4:"#ddd";}s:4:"type";s:10:"typography";}i:112;a:3:{s:4:"name";s:14:"Dynamic Images";s:4:"icon";s:5:"image";s:4:"type";s:7:"heading";}i:113;a:5:{s:4:"name";s:22:"Dynamic Image Resizing";s:4:"desc";s:0:"";s:2:"id";s:19:"woo_nxtthumb_notice";s:3:"std";s:222:"There are two alternative methods of dynamically resizing the thumbnails in the theme, <strong>nxt Post Thumbnail</strong> or <strong>TimThumb - Custom Settings panel</strong>. We recommend using nxt Post Thumbnail option.";s:4:"type";s:4:"info";}i:114;a:6:{s:4:"name";s:18:"nxt Post Thumbnail";s:4:"desc";s:169:"Use NXTClass post thumbnail to assign a post thumbnail. Will enable the <strong>Featured Image panel</strong> in your post sidebar where you can assign a post thumbnail.";s:2:"id";s:22:"woo_post_image_support";s:3:"std";s:4:"true";s:5:"class";s:9:"collapsed";s:4:"type";s:8:"checkbox";}i:115;a:6:{s:4:"name";s:43:"nxt Post Thumbnail - Dynamic Image Resizing";s:4:"desc";s:114:"The post thumbnail will be dynamically resized using native nxt resize functionality. <em>(Requires PHP 5.2+)</em>";s:2:"id";s:14:"woo_pis_resize";s:3:"std";s:4:"true";s:5:"class";s:6:"hidden";s:4:"type";s:8:"checkbox";}i:116;a:6:{s:4:"name";s:30:"nxt Post Thumbnail - Hard Crop";s:4:"desc";s:126:"The post thumbnail will be cropped to match the target aspect ratio (only used if <em>Dynamic Image Resizing</em> is enabled).";s:2:"id";s:17:"woo_pis_hard_crop";s:3:"std";s:4:"true";s:5:"class";s:11:"hidden last";s:4:"type";s:8:"checkbox";}i:117;a:5:{s:4:"name";s:32:"TimThumb - Custom Settings Panel";s:4:"desc";s:358:"This will enable the <a href="http://code.google.com/p/timthumb/">TimThumb</a> (thumb.php) script which dynamically resizes images added through the <strong>custom settings panel below the post</strong>. Make sure your themes <em>cache</em> folder is writable. <a href="http://www.woothemes.com/2008/10/troubleshooting-image-resizer-thumbphp/">Need help?</a>";s:2:"id";s:10:"woo_resize";s:3:"std";s:4:"true";s:4:"type";s:8:"checkbox";}i:118;a:5:{s:4:"name";s:25:"Automatic Image Thumbnail";s:4:"desc";s:79:"If no thumbnail is specified then the first uploaded image in the post is used.";s:2:"id";s:12:"woo_auto_img";s:3:"std";s:5:"false";s:4:"type";s:8:"checkbox";}i:119;a:5:{s:4:"name";s:20:"Thumbnail Dimensions";s:4:"desc";s:109:"Enter an integer value i.e. 250 for the desired size which will be used when dynamically creating the images.";s:2:"id";s:20:"woo_image_dimensions";s:3:"std";s:0:"";s:4:"type";a:2:{i:0;a:4:{s:2:"id";s:11:"woo_thumb_w";s:4:"type";s:4:"text";s:3:"std";s:3:"100";s:4:"meta";s:5:"Width";}i:1;a:4:{s:2:"id";s:11:"woo_thumb_h";s:4:"type";s:4:"text";s:3:"std";i:100;s:4:"meta";s:6:"Height";}}}i:120;a:6:{s:4:"name";s:19:"Thumbnail Alignment";s:4:"desc";s:47:"Select how to align your thumbnails with posts.";s:2:"id";s:15:"woo_thumb_align";s:3:"std";s:9:"alignleft";s:4:"type";s:5:"radio";s:7:"options";a:3:{s:9:"alignleft";s:4:"Left";s:10:"alignright";s:5:"Right";s:11:"aligncenter";s:6:"Center";}}i:121;a:5:{s:4:"name";s:28:"Single Post - Show Thumbnail";s:4:"desc";s:43:"Show the thumbnail in the single post page.";s:2:"id";s:16:"woo_thumb_single";s:3:"std";s:5:"false";s:4:"type";s:8:"checkbox";}i:122;a:5:{s:4:"name";s:34:"Single Post - Thumbnail Dimensions";s:4:"desc";s:51:"Enter an integer value i.e. 250 for the image size.";s:2:"id";s:20:"woo_image_dimensions";s:3:"std";s:0:"";s:4:"type";a:2:{i:0;a:4:{s:2:"id";s:12:"woo_single_w";s:4:"type";s:4:"text";s:3:"std";i:200;s:4:"meta";s:5:"Width";}i:1;a:4:{s:2:"id";s:12:"woo_single_h";s:4:"type";s:4:"text";s:3:"std";i:200;s:4:"meta";s:6:"Height";}}}i:123;a:6:{s:4:"name";s:33:"Single Post - Thumbnail Alignment";s:4:"desc";s:54:"Select how to align your thumbnails with single posts.";s:2:"id";s:22:"woo_thumb_align_single";s:3:"std";s:10:"alignright";s:4:"type";s:5:"radio";s:7:"options";a:3:{s:9:"alignleft";s:4:"Left";s:10:"alignright";s:5:"Right";s:11:"aligncenter";s:6:"Center";}}i:124;a:5:{s:4:"name";s:25:"Add thumbnail to RSS feed";s:4:"desc";s:68:"Add the the image uploaded via your Custom Settings to your RSS feed";s:2:"id";s:13:"woo_rss_thumb";s:3:"std";s:5:"false";s:4:"type";s:8:"checkbox";}i:125;a:5:{s:4:"name";s:15:"Enable Lightbox";s:4:"desc";s:78:"Enable the PrettyPhoto lighbox script on images within your website''s content.";s:2:"id";s:19:"woo_enable_lightbox";s:3:"std";s:5:"false";s:4:"type";s:8:"checkbox";}i:126;a:3:{s:4:"name";s:17:"Ad - Top (468x60)";s:4:"icon";s:3:"ads";s:4:"type";s:7:"heading";}i:127;a:5:{s:4:"name";s:9:"Enable Ad";s:4:"desc";s:19:"Enable the ad space";s:2:"id";s:10:"woo_ad_top";s:3:"std";s:5:"false";s:4:"type";s:8:"checkbox";}i:128;a:5:{s:4:"name";s:12:"Adsense code";s:4:"desc";s:56:"Enter your adsense code (or other ad network code) here.";s:2:"id";s:18:"woo_ad_top_adsense";s:3:"std";s:0:"";s:4:"type";s:8:"textarea";}i:129;a:5:{s:4:"name";s:14:"Image Location";s:4:"desc";s:46:"Enter the URL to the banner ad image location.";s:2:"id";s:16:"woo_ad_top_image";s:3:"std";s:40:"http://www.woothemes.com/ads/468x60b.jpg";s:4:"type";s:6:"upload";}i:130;a:5:{s:4:"name";s:15:"Destination URL";s:4:"desc";s:45:"Enter the URL where this banner ad points to.";s:2:"id";s:14:"woo_ad_top_url";s:3:"std";s:24:"http://www.woothemes.com";s:4:"type";s:4:"text";}i:131;a:3:{s:4:"name";s:17:"Magazine Template";s:4:"icon";s:6:"layout";s:4:"type";s:7:"heading";}i:132;a:5:{s:4:"name";s:22:"Magazine Page Template";s:4:"desc";s:0:"";s:2:"id";s:23:"woo_woo_magazine_notice";s:3:"std";s:202:"Below you can control settings for the Magazine page template. Please refer to <a href="http://www.woothemes.com/support/theme-documentation/canvas/">documentation</a> on how to setup the page template.";s:4:"type";s:4:"info";}i:133;a:5:{s:4:"name";s:14:"Featured Posts";s:4:"desc";s:145:"Select how many featured (full width) posts you would like to show before your two-column posts. Set total number of posts in Settings > Reading.";s:2:"id";s:23:"woo_magazine_feat_posts";s:4:"type";s:6:"select";s:7:"options";a:21:{i:0;s:16:"Select a number:";i:1;s:1:"0";i:2;s:1:"1";i:3;s:1:"2";i:4;s:1:"3";i:5;s:1:"4";i:6;s:1:"5";i:7;s:1:"6";i:8;s:1:"7";i:9;s:1:"8";i:10;s:1:"9";i:11;s:2:"10";i:12;s:2:"11";i:13;s:2:"12";i:14;s:2:"13";i:15;s:2:"14";i:16;s:2:"15";i:17;s:2:"16";i:18;s:2:"17";i:19;s:2:"18";i:20;s:2:"19";}}i:134;a:5:{s:4:"name";s:25:"Featured Image Dimensions";s:4:"desc";s:51:"Enter an integer value i.e. 250 for the image size.";s:2:"id";s:20:"woo_image_dimensions";s:3:"std";s:0:"";s:4:"type";a:2:{i:0;a:4:{s:2:"id";s:16:"woo_magazine_f_w";s:4:"type";s:4:"text";s:3:"std";i:100;s:4:"meta";s:5:"Width";}i:1;a:4:{s:2:"id";s:16:"woo_magazine_f_h";s:4:"type";s:4:"text";s:3:"std";i:100;s:4:"meta";s:6:"Height";}}}i:135;a:6:{s:4:"name";s:29:"Featured Post Image Alignment";s:4:"desc";s:46:"Select how to align your featured post images.";s:2:"id";s:20:"woo_magazine_f_align";s:3:"std";s:9:"alignleft";s:4:"type";s:5:"radio";s:7:"options";a:3:{s:9:"alignleft";s:4:"Left";s:10:"alignright";s:5:"Right";s:11:"aligncenter";s:6:"Center";}}i:136;a:5:{s:4:"name";s:28:"Normal Post Image Dimensions";s:4:"desc";s:51:"Enter an integer value i.e. 250 for the image size.";s:2:"id";s:20:"woo_image_dimensions";s:3:"std";s:0:"";s:4:"type";a:2:{i:0;a:4:{s:2:"id";s:16:"woo_magazine_b_w";s:4:"type";s:4:"text";s:3:"std";i:100;s:4:"meta";s:5:"Width";}i:1;a:4:{s:2:"id";s:16:"woo_magazine_b_h";s:4:"type";s:4:"text";s:3:"std";i:100;s:4:"meta";s:6:"Height";}}}i:137;a:6:{s:4:"name";s:27:"Normal Post Image Alignment";s:4:"desc";s:44:"Select how to align your normal post images.";s:2:"id";s:20:"woo_magazine_b_align";s:3:"std";s:9:"alignleft";s:4:"type";s:5:"radio";s:7:"options";a:3:{s:9:"alignleft";s:4:"Left";s:10:"alignright";s:5:"Right";s:11:"aligncenter";s:6:"Center";}}i:138;a:5:{s:4:"name";s:28:"Exclude Categories From Loop";s:4:"desc";s:162:"Enter a comma-separated list of category <a href="http://support.nxtclass.com/pages/8/">ID''s</a> that you''d like to exclude from the post loop. (e.g. 12,23,27,44)";s:2:"id";s:20:"woo_magazine_exclude";s:3:"std";s:0:"";s:4:"type";s:4:"text";}i:139;a:5:{s:4:"name";s:15:"Featured Slider";s:4:"desc";s:27:"Enable the featured slider.";s:2:"id";s:19:"woo_slider_magazine";s:3:"std";s:5:"false";s:4:"type";s:8:"checkbox";}i:140;a:5:{s:4:"name";s:22:"Featured Slider Tag(s)";s:4:"desc";s:307:"Add comma separated list for the tags that you would like to have displayed in the featured slider on your homepage. For example, if you add "tag1, tag3" here, then all posts tagged with either "tag1" or "tag3" will be shown in the featured area. These posts will be excluded from normal posts below slider.";s:2:"id";s:24:"woo_slider_magazine_tags";s:3:"std";s:0:"";s:4:"type";s:4:"text";}i:141;a:6:{s:4:"name";s:23:"Featured Slider Entries";s:4:"desc";s:71:"Select the number of entries that should appear in the Featured slider.";s:2:"id";s:27:"woo_slider_magazine_entries";s:3:"std";s:1:"3";s:4:"type";s:6:"select";s:7:"options";a:20:{i:0;s:16:"Select a number:";i:1;s:1:"1";i:2;s:1:"2";i:3;s:1:"3";i:4;s:1:"4";i:5;s:1:"5";i:6;s:1:"6";i:7;s:1:"7";i:8;s:1:"8";i:9;s:1:"9";i:10;s:2:"10";i:11;s:2:"11";i:12;s:2:"12";i:13;s:2:"13";i:14;s:2:"14";i:15;s:2:"15";i:16;s:2:"16";i:17;s:2:"17";i:18;s:2:"18";i:19;s:2:"19";}}i:142;a:5:{s:4:"name";s:29:"Featured Slider Exclude Posts";s:4:"desc";s:49:"Exclude the slider posts from posts below slider.";s:2:"id";s:27:"woo_slider_magazine_exclude";s:3:"std";s:4:"true";s:4:"type";s:8:"checkbox";}i:143;a:5:{s:4:"name";s:21:"Featured Slider Title";s:4:"desc";s:30:"Show the post title in slider.";s:2:"id";s:25:"woo_slider_magazine_title";s:3:"std";s:4:"true";s:4:"type";s:8:"checkbox";}i:144;a:5:{s:4:"name";s:32:"Featured Slider Title Font Style";s:4:"desc";s:28:"Select typography for title.";s:2:"id";s:30:"woo_slider_magazine_font_title";s:3:"std";a:5:{s:4:"size";s:2:"24";s:4:"unit";s:2:"px";s:4:"face";s:17:"Arial, sans-serif";s:5:"style";s:4:"bold";s:5:"color";s:7:"#ffffff";}s:4:"type";s:10:"typography";}i:145;a:5:{s:4:"name";s:23:"Featured Slider Excerpt";s:4:"desc";s:32:"Show the post excerpt in slider.";s:2:"id";s:27:"woo_slider_magazine_excerpt";s:3:"std";s:4:"true";s:4:"type";s:8:"checkbox";}i:146;a:5:{s:4:"name";s:34:"Featured Slider Excerpt Font Style";s:4:"desc";s:35:"Select typography for excerpt text.";s:2:"id";s:32:"woo_slider_magazine_font_excerpt";s:3:"std";a:5:{s:4:"size";s:2:"12";s:4:"unit";s:2:"px";s:4:"face";s:17:"Arial, sans-serif";s:5:"style";s:6:"normal";s:5:"color";s:7:"#cccccc";}s:4:"type";s:10:"typography";}i:147;a:5:{s:4:"name";s:30:"Featured Slider Excerpt Length";s:4:"desc";s:51:"Total number of words to show in the slider excerpt";s:2:"id";s:34:"woo_slider_magazine_excerpt_length";s:3:"std";s:2:"15";s:4:"type";s:4:"text";}i:148;a:5:{s:4:"name";s:22:"Featured Slider Height";s:4:"desc";s:69:"Set a manual height for the slider e.g. 250. Default height is 300px.";s:2:"id";s:26:"woo_slider_magazine_height";s:3:"std";s:0:"";s:4:"type";s:4:"text";}i:149;a:6:{s:4:"name";s:26:"Number of Posts To Display";s:4:"desc";s:63:"The number of posts to display on the "Magazine" page template.";s:2:"id";s:18:"woo_magazine_limit";s:3:"std";s:2:"10";s:4:"type";s:6:"select";s:7:"options";a:20:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;i:4;i:5;i:5;i:6;i:6;i:7;i:7;i:8;i:8;i:9;i:9;i:10;i:10;i:11;i:11;i:12;i:12;i:13;i:13;i:14;i:14;i:15;i:15;i:16;i:16;i:17;i:17;i:18;i:18;i:19;i:19;i:20;}}i:150;a:6:{s:4:"name";s:33:"Post Content for "Featured" Posts";s:4:"desc";s:94:"Select if you want to show the full content or the excerpt on posts in the "Featured" section.";s:2:"id";s:34:"woo_magazine_featured_post_content";s:3:"std";s:7:"excerpt";s:4:"type";s:7:"select2";s:7:"options";a:2:{s:7:"excerpt";s:11:"The Excerpt";s:7:"content";s:12:"Full Content";}}i:151;a:6:{s:4:"name";s:29:"Post Content for "Grid" Posts";s:4:"desc";s:90:"Select if you want to show the full content or the excerpt on posts in the "Grid" section.";s:2:"id";s:30:"woo_magazine_grid_post_content";s:3:"std";s:7:"excerpt";s:4:"type";s:7:"select2";s:7:"options";a:2:{s:7:"excerpt";s:11:"The Excerpt";s:7:"content";s:12:"Full Content";}}i:152;a:3:{s:4:"name";s:17:"Business Template";s:4:"icon";s:6:"layout";s:4:"type";s:7:"heading";}i:153;a:5:{s:4:"name";s:22:"Business Page Template";s:4:"desc";s:0:"";s:2:"id";s:18:"woo_woo_biz_notice";s:3:"std";s:287:"Below you can control settings for the Business page template. Please refer to <a href="http://www.woothemes.com/support/theme-documentation/canvas/">documentation</a> on how to setup the page template. You can add slider posts with the <strong><em>Slides</em></strong> custom post type.";s:4:"type";s:4:"info";}i:154;a:5:{s:4:"name";s:15:"Featured Slider";s:4:"desc";s:27:"Enable the featured slider.";s:2:"id";s:14:"woo_slider_biz";s:3:"std";s:5:"false";s:4:"type";s:8:"checkbox";}i:155;a:6:{s:4:"name";s:21:"Featured Slider Posts";s:4:"desc";s:65:"Select how many slide posts you would like to show in the slider.";s:2:"id";s:21:"woo_slider_biz_number";s:3:"std";s:2:"10";s:4:"type";s:6:"select";s:7:"options";a:20:{i:0;s:16:"Select a number:";i:1;s:1:"1";i:2;s:1:"2";i:3;s:1:"3";i:4;s:1:"4";i:5;s:1:"5";i:6;s:1:"6";i:7;s:1:"7";i:8;s:1:"8";i:9;s:1:"9";i:10;s:2:"10";i:11;s:2:"11";i:12;s:2:"12";i:13;s:2:"13";i:14;s:2:"14";i:15;s:2:"15";i:16;s:2:"16";i:17;s:2:"17";i:18;s:2:"18";i:19;s:2:"19";}}i:156;a:6:{s:4:"name";s:27:"Features Slider Posts Order";s:4:"desc";s:61:"Select the order in which you want to show your slider posts.";s:2:"id";s:20:"woo_slider_biz_order";s:4:"type";s:7:"select2";s:3:"std";s:4:"DESC";s:7:"options";a:2:{s:4:"DESC";s:18:"Newest posts first";s:3:"ASC";s:18:"Oldest posts first";}}i:157;a:5:{s:4:"name";s:21:"Featured Slider Title";s:4:"desc";s:124:"Show the page title in slider <strong>(ONLY when using image as background uploaded through Custom Settings panel)</strong>.";s:2:"id";s:20:"woo_slider_biz_title";s:3:"std";s:4:"true";s:4:"type";s:8:"checkbox";}i:158;a:5:{s:4:"name";s:32:"Featured Slider Title Font Style";s:4:"desc";s:58:"Select typography for title (when using image background).";s:2:"id";s:25:"woo_slider_biz_font_title";s:3:"std";a:5:{s:4:"size";s:2:"24";s:4:"unit";s:2:"px";s:4:"face";s:17:"Arial, sans-serif";s:5:"style";s:4:"bold";s:5:"color";s:7:"#ffffff";}s:4:"type";s:10:"typography";}i:159;a:5:{s:4:"name";s:34:"Featured Slider Content Font Style";s:4:"desc";s:65:"Select typography for content text (when using image background).";s:2:"id";s:27:"woo_slider_biz_font_excerpt";s:3:"std";a:5:{s:4:"size";s:2:"12";s:4:"unit";s:2:"px";s:4:"face";s:17:"Arial, sans-serif";s:5:"style";s:6:"normal";s:5:"color";s:7:"#cccccc";}s:4:"type";s:10:"typography";}i:160;a:5:{s:4:"name";s:22:"Featured Slider Height";s:4:"desc";s:69:"Set a manual height for the slider e.g. 250. Default height is 350px.";s:2:"id";s:21:"woo_slider_biz_height";s:3:"std";s:0:"";s:4:"type";s:4:"text";}i:161;a:5:{s:4:"name";s:22:"Disable Footer Widgets";s:4:"desc";s:44:"Disable the footer widgets on this template.";s:2:"id";s:30:"woo_biz_disable_footer_widgets";s:3:"std";s:4:"true";s:4:"type";s:8:"checkbox";}i:162;a:5:{s:4:"name";s:25:"Disable Slides Admin Menu";s:4:"desc";s:44:"Disable the slides admin menu functionality.";s:2:"id";s:22:"woo_biz_slides_disable";s:3:"std";s:5:"false";s:4:"type";s:8:"checkbox";}i:163;a:3:{s:4:"name";s:15:"Slider Settings";s:4:"icon";s:6:"slider";s:4:"type";s:7:"heading";}i:164;a:5:{s:4:"name";s:15:"Slider Settings";s:4:"desc";s:0:"";s:2:"id";s:21:"woo_woo_slider_notice";s:3:"std";s:107:"Below you can control the generic slider settings which will apply to both Business and Magazine templates.";s:4:"type";s:4:"info";}i:165;a:5:{s:4:"name";s:10:"Auto Start";s:4:"desc";s:86:"Set the slider to start sliding automatically. Adjust the speed of sliding underneath.";s:2:"id";s:15:"woo_slider_auto";s:3:"std";s:4:"true";s:4:"type";s:8:"checkbox";}i:166;a:5:{s:4:"name";s:11:"Auto Height";s:4:"desc";s:93:"Set the slider to adjust automatically depending on the height of the current slide contents.";s:2:"id";s:21:"woo_slider_autoheight";s:3:"std";s:5:"false";s:4:"type";s:8:"checkbox";}i:167;a:5:{s:4:"name";s:11:"Hover Pause";s:4:"desc";s:37:"Hovering over slideshow will pause it";s:2:"id";s:16:"woo_slider_hover";s:3:"std";s:5:"false";s:4:"type";s:8:"checkbox";}i:168;a:5:{s:4:"name";s:14:"ContainerClick";s:4:"desc";s:61:"Set the slider to slide on mouseclick in the slider container";s:2:"id";s:25:"woo_slider_containerclick";s:3:"std";s:5:"false";s:4:"type";s:8:"checkbox";}i:169;a:6:{s:4:"name";s:15:"Animation Speed";s:4:"desc";s:74:"The time in <b>seconds</b> the animation between frames will take e.g. 0.6";s:2:"id";s:16:"woo_slider_speed";s:3:"std";d:0.59999999999999997779553950749686919152736663818359375;s:4:"type";s:6:"select";s:7:"options";a:21:{i:0;s:3:"0.0";i:1;s:3:"0.1";i:2;s:3:"0.2";i:3;s:3:"0.3";i:4;s:3:"0.4";i:5;s:3:"0.5";i:6;s:3:"0.6";i:7;s:3:"0.7";i:8;s:3:"0.8";i:9;s:3:"0.9";i:10;s:3:"1.0";i:11;s:3:"1.1";i:12;s:3:"1.2";i:13;s:3:"1.3";i:14;s:3:"1.4";i:15;s:3:"1.5";i:16;s:3:"1.6";i:17;s:3:"1.7";i:18;s:3:"1.8";i:19;s:3:"1.9";i:20;s:3:"2.0";}}i:170;a:6:{s:4:"name";s:19:"Auto Slide Interval";s:4:"desc";s:118:"The time in <b>seconds</b> each slide pauses for, before sliding to the next. Only when using Auto Start option above.";s:2:"id";s:19:"woo_slider_interval";s:3:"std";s:1:"4";s:4:"type";s:6:"select";s:7:"options";a:10:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";i:3;s:1:"4";i:4;s:1:"5";i:5;s:1:"6";i:6;s:1:"7";i:7;s:1:"8";i:8;s:1:"9";i:9;s:2:"10";}}i:171;a:6:{s:4:"name";s:22:"Features Slider Effect";s:4:"desc";s:90:"Select the effect used when transitioning between posts (default: <strong>slide</strong>).";s:2:"id";s:17:"woo_slider_effect";s:4:"type";s:7:"select2";s:3:"std";s:5:"slide";s:7:"options";a:2:{s:5:"slide";s:5:"Slide";s:4:"fade";s:4:"Fade";}}i:172;a:5:{s:4:"name";s:17:"Slider Pagination";s:4:"desc";s:56:"Enable/disable the display of pagination in the sliders.";s:2:"id";s:21:"woo_slider_pagination";s:3:"std";s:5:"false";s:4:"type";s:8:"checkbox";}i:173;a:3:{s:4:"name";s:18:"Portfolio Settings";s:4:"icon";s:9:"portfolio";s:4:"type";s:7:"heading";}i:174;a:5:{s:4:"name";s:17:"Portfolio Manager";s:4:"desc";s:0:"";s:2:"id";s:20:"woo_portfolio_notice";s:3:"std";s:247:"Below you can setup and enable/disable the portfolio settings. When modifying the portfolio settings, please visit the <a href="http://localhost/htdocs/nxt-admin/options-permalink.php">Settings- Permalinks</a> screen to refresh your NXTClass URLs.";s:4:"type";s:4:"info";}i:175;a:5:{s:4:"name";s:31:"Enable Single Portfolio Gallery";s:4:"desc";s:63:"Enable the gallery feature in the single portfolio page layout.";s:2:"id";s:21:"woo_portfolio_gallery";s:3:"std";s:4:"true";s:4:"type";s:8:"checkbox";}i:176;a:5:{s:4:"name";s:24:"Portfolio Items URL Base";s:4:"desc";s:174:"The base of all portfolio item URLs (visit the <a href="http://localhost/htdocs/nxt-admin/options-permalink.php">Settings- Permalinks</a> screen after changing this setting).";s:2:"id";s:26:"woo_portfolioitems_rewrite";s:3:"std";s:15:"portfolio-items";s:4:"type";s:4:"text";}i:177;a:5:{s:4:"name";s:47:"Exclude Galleries from the Portfolio Navigation";s:4:"desc";s:162:"Optionally exclude portfolio galleries from the portfolio gallery navigation switcher. Place the gallery slugs here, separated by commas <br />(eg: one,two,three)";s:2:"id";s:24:"woo_portfolio_excludenav";s:3:"std";s:0:"";s:4:"type";s:4:"text";}i:178;a:5:{s:4:"name";s:30:"Portfolio Thumbnail Dimensions";s:4:"desc";s:51:"Enter an integer value i.e. 250 for the image size.";s:2:"id";s:30:"woo_portfolio_thumb_dimensions";s:3:"std";s:0:"";s:4:"type";a:2:{i:0;a:4:{s:2:"id";s:25:"woo_portfolio_thumb_width";s:4:"type";s:4:"text";s:3:"std";i:210;s:4:"meta";s:5:"Width";}i:1;a:4:{s:2:"id";s:26:"woo_portfolio_thumb_height";s:4:"type";s:4:"text";s:3:"std";i:120;s:4:"meta";s:6:"Height";}}}i:179;a:6:{s:4:"name";s:31:"Portfolio Galleries Page Layout";s:4:"desc";s:82:"Select main content and sidebar alignment. Choose between 1, 2 or 3 column layout.";s:2:"id";s:20:"woo_portfolio_layout";s:3:"std";s:7:"one-col";s:4:"type";s:6:"images";s:7:"options";a:6:{s:7:"one-col";s:73:"http://localhost/htdocs/nxt-content/themes/canvas/functions/images/1c.png";s:12:"two-col-left";s:74:"http://localhost/htdocs/nxt-content/themes/canvas/functions/images/2cl.png";s:13:"two-col-right";s:74:"http://localhost/htdocs/nxt-content/themes/canvas/functions/images/2cr.png";s:14:"three-col-left";s:74:"http://localhost/htdocs/nxt-content/themes/canvas/functions/images/3cl.png";s:16:"three-col-middle";s:74:"http://localhost/htdocs/nxt-content/themes/canvas/functions/images/3cm.png";s:15:"three-col-right";s:74:"http://localhost/htdocs/nxt-content/themes/canvas/functions/images/3cr.png";}}i:180;a:5:{s:4:"name";s:43:"Exclude Portfolio Items from Search Results";s:4:"desc";s:65:"Exclude portfolio items from results when searching your website.";s:2:"id";s:27:"woo_portfolio_excludesearch";s:3:"std";s:5:"false";s:4:"type";s:8:"checkbox";}i:181;a:6:{s:4:"name";s:23:"Portfolio Items Link To";s:4:"desc";s:84:"Do the portfolio items link to the lightbox, or to the single portfolio item screen?";s:2:"id";s:20:"woo_portfolio_linkto";s:3:"std";s:8:"lightbox";s:4:"type";s:7:"select2";s:7:"options";a:2:{s:8:"lightbox";s:8:"Lightbox";s:4:"post";s:14:"Portfolio Item";}}i:182;a:5:{s:4:"name";s:17:"Disable Portfolio";s:4:"desc";s:36:"Disable the portfolio functionality.";s:2:"id";s:21:"woo_portfolio_disable";s:3:"std";s:5:"false";s:4:"type";s:8:"checkbox";}i:183;a:3:{s:4:"name";s:17:"Feedback Settings";s:4:"icon";s:4:"misc";s:4:"type";s:7:"heading";}i:184;a:5:{s:4:"name";s:24:"Disable Feedback Manager";s:4:"desc";s:35:"Disable the feedback functionality.";s:2:"id";s:20:"woo_feedback_disable";s:3:"std";s:5:"false";s:4:"type";s:8:"checkbox";}i:185;a:3:{s:4:"name";s:16:"Tumblog Settings";s:4:"icon";s:7:"tumblog";s:4:"type";s:7:"heading";}i:186;a:5:{s:4:"name";s:21:"Tumblog Functionality";s:4:"desc";s:0:"";s:2:"id";s:22:"woo_woo_tumblog_notice";s:3:"std";s:321:"Tumblog will allow you to publish content using the WooTumblog functionality, including the Express for NXTClass iPhone App. If you would like to use the iPhone app, you will need to enable XML-RPC publishing under Settings->Writing. Find out more at <a href="http://express-app.com/" target="_blank">Express-App.com</a>.";s:4:"type";s:4:"info";}i:187;a:5:{s:4:"name";s:28:"Enable Tumblog Functionality";s:4:"desc";s:39:"Enable Tumblog functionality in Canvas.";s:2:"id";s:22:"woo_woo_tumblog_switch";s:3:"std";s:5:"false";s:4:"type";s:8:"checkbox";}i:188;a:6:{s:4:"name";s:22:"Tumblog Content Method";s:4:"desc";s:94:"Select if you would like to use a Taxonomy of Post Formats to categorize your Tumblog content.";s:2:"id";s:26:"woo_tumblog_content_method";s:3:"std";s:11:"post_format";s:4:"type";s:7:"select2";s:7:"options";a:2:{s:8:"taxonomy";s:8:"Taxonomy";s:11:"post_format";s:12:"Post Formats";}}i:189;a:5:{s:4:"name";s:27:"Use Custom Tumblog RSS Feed";s:4:"desc";s:70:"Replaces the default NXTClass RSS feed output with Tumblog RSS output.";s:2:"id";s:14:"woo_custom_rss";s:3:"std";s:4:"true";s:4:"type";s:8:"checkbox";}i:190;a:6:{s:4:"name";s:14:"Images Link to";s:4:"desc";s:59:"Select where your Tumblog Images will link to when clicked.";s:2:"id";s:17:"woo_image_link_to";s:3:"std";s:4:"post";s:4:"type";s:5:"radio";s:7:"options";a:2:{s:5:"image";s:9:"The Image";s:4:"post";s:8:"The Post";}}i:191;a:5:{s:4:"name";s:20:"Tumblog Images Width";s:4:"desc";s:47:"The output width for Tumblog image post images.";s:2:"id";s:23:"woo_tumblog_image_width";s:3:"std";s:3:"610";s:4:"type";s:4:"text";}i:192;a:6:{s:4:"name";s:32:"Tumblog Content Position: Images";s:4:"desc";s:98:"Select where you would like the Tumblog Specific content to be output around the standard content.";s:2:"id";s:30:"woo_woo_tumblog_images_content";s:3:"std";s:6:"Before";s:4:"type";s:6:"select";s:7:"options";a:3:{i:0;s:8:"Disabled";i:1;s:6:"Before";i:2;s:5:"After";}}i:193;a:5:{s:4:"name";s:19:"Tumblog Audio Width";s:4:"desc";s:42:"The output width for Tumblog Audio player.";s:2:"id";s:23:"woo_tumblog_audio_width";s:3:"std";s:3:"440";s:4:"type";s:4:"text";}i:194;a:6:{s:4:"name";s:31:"Tumblog Content Position: Audio";s:4:"desc";s:98:"Select where you would like the Tumblog Specific content to be output around the standard content.";s:2:"id";s:29:"woo_woo_tumblog_audio_content";s:3:"std";s:6:"Before";s:4:"type";s:6:"select";s:7:"options";a:3:{i:0;s:8:"Disabled";i:1;s:6:"Before";i:2;s:5:"After";}}i:195;a:5:{s:4:"name";s:19:"Tumblog Video Width";s:4:"desc";s:36:"The output width for Tumblog Videos.";s:2:"id";s:23:"woo_tumblog_video_width";s:3:"std";s:3:"610";s:4:"type";s:4:"text";}i:196;a:6:{s:4:"name";s:31:"Tumblog Content Position: Video";s:4:"desc";s:98:"Select where you would like the Tumblog Specific content to be output around the standard content.";s:2:"id";s:30:"woo_woo_tumblog_videos_content";s:3:"std";s:6:"Before";s:4:"type";s:6:"select";s:7:"options";a:3:{i:0;s:8:"Disabled";i:1;s:6:"Before";i:2;s:5:"After";}}i:197;a:6:{s:4:"name";s:32:"Tumblog Content Position: Quotes";s:4:"desc";s:98:"Select where you would like the Tumblog Specific content to be output around the standard content.";s:2:"id";s:30:"woo_woo_tumblog_quotes_content";s:3:"std";s:6:"Before";s:4:"type";s:6:"select";s:7:"options";a:3:{i:0;s:8:"Disabled";i:1;s:6:"Before";i:2;s:5:"After";}}i:198;a:5:{s:4:"name";s:59:"Tumblog Media Widths on the "Magazine" Page Template''s Grid";s:4:"desc";s:98:"The output width for Tumblog media (images, videos, audio) on the "Magazine" page template''s grid.";s:2:"id";s:32:"woo_tumblog_magazine_media_width";s:3:"std";s:3:"300";s:4:"type";s:4:"text";}i:199;a:3:{s:4:"name";s:19:"Subscribe & Connect";s:4:"type";s:7:"heading";s:4:"icon";s:7:"connect";}i:200;a:5:{s:4:"name";s:40:"Enable Subscribe & Connect - Single Post";s:4:"desc";s:163:"Enable the subscribe & connect area on single posts. You can also add this as a <a href="http://localhost/htdocs/nxt-admin/widgets.php">widget</a> in your sidebar.";s:2:"id";s:11:"woo_connect";s:3:"std";s:4:"true";s:4:"type";s:8:"checkbox";}i:201;a:5:{s:4:"name";s:15:"Subscribe Title";s:4:"desc";s:57:"Enter the title to show in your subscribe & connect area.";s:2:"id";s:17:"woo_connect_title";s:3:"std";s:0:"";s:4:"type";s:4:"text";}i:202;a:5:{s:4:"name";s:4:"Text";s:4:"desc";s:37:"Change the default text in this area.";s:2:"id";s:19:"woo_connect_content";s:3:"std";s:0:"";s:4:"type";s:8:"textarea";}i:203;a:5:{s:4:"name";s:35:"Subscribe By E-mail ID (Feedburner)";s:4:"desc";s:146:"Enter your <a href="http://www.google.com/support/feedburner/bin/answer.py?hl=en&answer=78982">Feedburner ID</a> for the e-mail subscription form.";s:2:"id";s:25:"woo_connect_newsletter_id";s:3:"std";s:0:"";s:4:"type";s:4:"text";}i:204;a:5:{s:4:"name";s:32:"Subscribe By E-mail to MailChimp";s:4:"desc";s:189:"If you have a MailChimp account you can enter the <a href="http://woochimp.heroku.com" target="_blank">MailChimp List Subscribe URL</a> to allow your users to subscribe to a MailChimp List.";s:2:"id";s:30:"woo_connect_mailchimp_list_url";s:3:"std";s:0:"";s:4:"type";s:4:"text";}i:205;a:5:{s:4:"name";s:10:"Enable RSS";s:4:"desc";s:34:"Enable the subscribe and RSS icon.";s:2:"id";s:15:"woo_connect_rss";s:3:"std";s:4:"true";s:4:"type";s:8:"checkbox";}i:206;a:5:{s:4:"name";s:11:"Twitter URL";s:4:"desc";s:99:"Enter your  <a href="http://www.twitter.com/">Twitter</a> URL e.g. http://www.twitter.com/woothemes";s:2:"id";s:19:"woo_connect_twitter";s:3:"std";s:0:"";s:4:"type";s:4:"text";}i:207;a:5:{s:4:"name";s:12:"Facebook URL";s:4:"desc";s:102:"Enter your  <a href="http://www.facebook.com/">Facebook</a> URL e.g. http://www.facebook.com/woothemes";s:2:"id";s:20:"woo_connect_facebook";s:3:"std";s:0:"";s:4:"type";s:4:"text";}i:208;a:5:{s:4:"name";s:11:"YouTube URL";s:4:"desc";s:99:"Enter your  <a href="http://www.youtube.com/">YouTube</a> URL e.g. http://www.youtube.com/woothemes";s:2:"id";s:19:"woo_connect_youtube";s:3:"std";s:0:"";s:4:"type";s:4:"text";}i:209;a:5:{s:4:"name";s:10:"Flickr URL";s:4:"desc";s:96:"Enter your  <a href="http://www.flickr.com/">Flickr</a> URL e.g. http://www.flickr.com/woothemes";s:2:"id";s:18:"woo_connect_flickr";s:3:"std";s:0:"";s:4:"type";s:4:"text";}i:210;a:5:{s:4:"name";s:12:"LinkedIn URL";s:4:"desc";s:113:"Enter your  <a href="http://www.www.linkedin.com.com/">LinkedIn</a> URL e.g. http://www.linkedin.com/in/woothemes";s:2:"id";s:20:"woo_connect_linkedin";s:3:"std";s:0:"";s:4:"type";s:4:"text";}i:211;a:5:{s:4:"name";s:13:"Delicious URL";s:4:"desc";s:104:"Enter your <a href="http://www.delicious.com/">Delicious</a> URL e.g. http://www.delicious.com/woothemes";s:2:"id";s:21:"woo_connect_delicious";s:3:"std";s:0:"";s:4:"type";s:4:"text";}i:212;a:5:{s:4:"name";s:11:"Google+ URL";s:4:"desc";s:112:"Enter your <a href="http://plus.google.com/">Google+</a> URL e.g. https://plus.google.com/104560124403688998123/";s:2:"id";s:22:"woo_connect_googleplus";s:3:"std";s:0:"";s:4:"type";s:4:"text";}i:213;a:5:{s:4:"name";s:20:"Enable Related Posts";s:4:"desc";s:158:"Enable related posts in the subscribe area. Uses posts with the same <strong>tags</strong> to find related posts. Note: Will not show in the Subscribe widget.";s:2:"id";s:19:"woo_connect_related";s:3:"std";s:4:"true";s:4:"type";s:8:"checkbox";}}', 'yes');
INSERT INTO `n_options` (`option_id`, `blog_id`, `option_name`, `option_value`, `autoload`) VALUES
(147, 0, 'woo_themename', 'Canvas', 'yes'),
(148, 0, 'woo_shortname', 'woo', 'yes'),
(149, 0, 'woo_manual', 'http://www.woothemes.com/support/theme-documentation/canvas/', 'yes'),
(150, 0, 'woo_custom_template', 'a:17:{i:0;a:4:{s:4:"name";s:5:"image";s:5:"label";s:5:"Image";s:4:"type";s:6:"upload";s:4:"desc";s:19:"Upload file here...";}i:1;a:6:{s:4:"name";s:16:"_image_alignment";s:3:"std";s:6:"Center";s:5:"label";s:20:"Image Crop Alignment";s:4:"type";s:7:"select2";s:4:"desc";s:39:"Select crop alignment for resized image";s:7:"options";a:5:{s:1:"c";s:6:"Center";s:1:"t";s:3:"Top";s:1:"b";s:6:"Bottom";s:1:"l";s:4:"Left";s:1:"r";s:5:"Right";}}i:2;a:5:{s:4:"name";s:6:"layout";s:5:"label";s:6:"Layout";s:4:"type";s:6:"images";s:4:"desc";s:75:"Select a specific layout for this post/page. Overrides default site layout.";s:7:"options";a:7:{s:0:"";s:81:"http://localhost/htdocs/nxt-content/themes/canvas/functions/images/layout-off.png";s:7:"one-col";s:73:"http://localhost/htdocs/nxt-content/themes/canvas/functions/images/1c.png";s:12:"two-col-left";s:74:"http://localhost/htdocs/nxt-content/themes/canvas/functions/images/2cl.png";s:13:"two-col-right";s:74:"http://localhost/htdocs/nxt-content/themes/canvas/functions/images/2cr.png";s:14:"three-col-left";s:74:"http://localhost/htdocs/nxt-content/themes/canvas/functions/images/3cl.png";s:16:"three-col-middle";s:74:"http://localhost/htdocs/nxt-content/themes/canvas/functions/images/3cm.png";s:15:"three-col-right";s:74:"http://localhost/htdocs/nxt-content/themes/canvas/functions/images/3cr.png";}}i:3;a:4:{s:4:"name";s:5:"embed";s:5:"label";s:5:"Embed";s:4:"type";s:8:"textarea";s:4:"desc";s:67:"Enter embed code for use on single posts and with the Video widget.";}i:4;a:4:{s:4:"name";s:5:"image";s:5:"label";s:5:"Image";s:4:"type";s:6:"upload";s:4:"desc";s:66:"Upload an image to be used as background of this slide. (optional)";}i:5;a:4:{s:4:"name";s:3:"url";s:5:"label";s:3:"URL";s:4:"type";s:4:"text";s:4:"desc";s:69:"Enter URL if you want to add a link to the uploaded image. (optional)";}i:6;a:4:{s:4:"name";s:15:"portfolio-image";s:5:"label";s:15:"Portfolio Image";s:4:"type";s:6:"upload";s:4:"desc";s:55:"Upload an image or enter an URL to your portfolio image";}i:7;a:6:{s:4:"name";s:16:"_image_alignment";s:3:"std";s:1:"c";s:5:"label";s:20:"Image Crop Alignment";s:4:"type";s:7:"select2";s:4:"desc";s:39:"Select crop alignment for resized image";s:7:"options";a:5:{s:1:"c";s:6:"Center";s:1:"t";s:3:"Top";s:1:"b";s:6:"Bottom";s:1:"l";s:4:"Left";s:1:"r";s:5:"Right";}}i:8;a:5:{s:4:"name";s:5:"embed";s:3:"std";s:0:"";s:5:"label";s:16:"Video Embed Code";s:4:"type";s:8:"textarea";s:4:"desc";s:103:"Enter the video embed code for your video (YouTube, Vimeo or similar). Will show instead of your image.";}s:12:"lightbox-url";a:4:{s:4:"name";s:12:"lightbox-url";s:5:"label";s:12:"Lightbox URL";s:4:"type";s:4:"text";s:4:"desc";s:176:"Enter an optional URL to show in the <a href="http://www.no-margin-for-errors.com/projects/prettyphoto-jquery-lightbox-clone/">PrettyPhoto lightbox</a> for this portfolio item.";}s:11:"testimonial";a:4:{s:4:"name";s:11:"testimonial";s:5:"label";s:11:"Testimonial";s:4:"type";s:8:"textarea";s:4:"desc";s:81:"Enter a testimonial from your client to be displayed on the single portfolio page";}s:18:"testimonial_author";a:4:{s:4:"name";s:18:"testimonial_author";s:5:"label";s:18:"Testimonial Author";s:4:"type";s:4:"text";s:4:"desc";s:63:"Enter the name of the author of the testimonial e.g. Joe Bloggs";}i:9;a:4:{s:4:"name";s:3:"url";s:5:"label";s:3:"URL";s:4:"type";s:4:"text";s:4:"desc";s:42:"Enter URL of your clients site. (optional)";}s:15:"feedback_author";a:4:{s:4:"name";s:15:"feedback_author";s:5:"label";s:15:"Feedback Author";s:4:"type";s:4:"text";s:4:"desc";s:60:"Enter the name of the author of the feedback e.g. Joe Bloggs";}s:12:"feedback_url";a:4:{s:4:"name";s:12:"feedback_url";s:5:"label";s:12:"Feedback URL";s:4:"type";s:4:"text";s:4:"desc";s:77:"(optional) Enter the URL to the feedback author e.g. http://www.woothemes.com";}i:10;a:6:{s:4:"name";s:11:"_slide-page";s:3:"std";s:0:"";s:5:"label";s:10:"Slide Page";s:4:"type";s:7:"select2";s:4:"desc";s:76:"Optionally select a "Slide Page" to show slides from only that "Slide Page".";s:7:"options";a:1:{s:3:"all";s:3:"All";}}i:11;a:5:{s:4:"name";s:6:"layout";s:5:"label";s:6:"Layout";s:4:"type";s:6:"images";s:4:"desc";s:75:"Select a specific layout for this post/page. Overrides default site layout.";s:7:"options";a:7:{s:0:"";s:81:"http://localhost/htdocs/nxt-content/themes/canvas/functions/images/layout-off.png";s:7:"one-col";s:73:"http://localhost/htdocs/nxt-content/themes/canvas/functions/images/1c.png";s:12:"two-col-left";s:74:"http://localhost/htdocs/nxt-content/themes/canvas/functions/images/2cl.png";s:13:"two-col-right";s:74:"http://localhost/htdocs/nxt-content/themes/canvas/functions/images/2cr.png";s:14:"three-col-left";s:74:"http://localhost/htdocs/nxt-content/themes/canvas/functions/images/3cl.png";s:16:"three-col-middle";s:74:"http://localhost/htdocs/nxt-content/themes/canvas/functions/images/3cm.png";s:15:"three-col-right";s:74:"http://localhost/htdocs/nxt-content/themes/canvas/functions/images/3cr.png";}}}', 'yes'),
(170, 0, '_site_transient_timeout_nxtorg_theme_feature_list', '1342197091', 'yes'),
(171, 0, '_site_transient_nxtorg_theme_feature_list', 'a:0:{}', 'yes'),
(172, 0, 'current_theme', 'Canvas', 'yes'),
(173, 0, 'theme_mods_canvas', 'a:1:{i:0;b:0;}', 'yes'),
(174, 0, 'woo_alt_stylesheet', 'default.css', 'yes'),
(175, 0, 'woo_logo', '', 'yes'),
(176, 0, 'woo_texttitle', 'false', 'yes'),
(177, 0, 'woo_font_site_title', 'a:5:{s:4:"size";s:2:"70";s:4:"unit";s:2:"px";s:4:"face";s:12:"StMarie-Thin";s:5:"style";s:6:"normal";s:5:"color";s:7:"#3E3E3E";}', 'yes'),
(178, 0, 'woo_tagline', 'false', 'yes'),
(179, 0, 'woo_font_tagline', 'a:5:{s:4:"size";s:2:"26";s:4:"unit";s:2:"px";s:4:"face";s:17:"BergamoStd-Italic";s:5:"style";s:6:"italic";s:5:"color";s:7:"#3E3E3E";}', 'yes'),
(180, 0, 'woo_custom_favicon', '', 'yes'),
(181, 0, 'woo_google_analytics', '', 'yes'),
(182, 0, 'woo_feed_url', '', 'yes'),
(183, 0, 'woo_subscribe_email', '', 'yes'),
(184, 0, 'woo_contactform_email', '', 'yes'),
(185, 0, 'woo_custom_css', '', 'yes'),
(186, 0, 'woo_comments', 'both', 'yes'),
(187, 0, 'woo_post_content', 'excerpt', 'yes'),
(188, 0, 'woo_post_author', 'true', 'yes'),
(189, 0, 'woo_breadcrumbs_show', 'false', 'yes'),
(190, 0, 'woo_pagination_type', 'paginated_links', 'yes'),
(191, 0, 'woo_body_color', '', 'yes'),
(192, 0, 'woo_body_img', '', 'yes'),
(193, 0, 'woo_body_repeat', 'no-repeat', 'yes'),
(194, 0, 'woo_body_pos', 'top', 'yes'),
(195, 0, 'woo_link_color', '', 'yes'),
(196, 0, 'woo_link_hover_color', '', 'yes'),
(197, 0, 'woo_button_color', '', 'yes'),
(198, 0, 'woo_typography', 'false', 'yes'),
(199, 0, 'woo_font_body', 'a:5:{s:4:"size";s:2:"14";s:4:"unit";s:2:"px";s:4:"face";s:5:"Arial";s:5:"style";s:0:"";s:5:"color";s:7:"#444444";}', 'yes'),
(200, 0, 'woo_font_nav', 'a:5:{s:4:"size";s:2:"13";s:4:"unit";s:2:"px";s:4:"face";s:5:"Arial";s:5:"style";s:0:"";s:5:"color";s:7:"#FFFFFF";}', 'yes'),
(201, 0, 'woo_font_post_title', 'a:5:{s:4:"size";s:2:"30";s:4:"unit";s:2:"px";s:4:"face";s:17:"Arial, sans-serif";s:5:"style";s:4:"bold";s:5:"color";s:7:"#444444";}', 'yes'),
(202, 0, 'woo_font_post_meta', 'a:5:{s:4:"size";s:2:"12";s:4:"unit";s:2:"px";s:4:"face";s:65:""Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", sans-serif";s:5:"style";s:6:"normal";s:5:"color";s:7:"#444444";}', 'yes'),
(203, 0, 'woo_font_post_entry', 'a:5:{s:4:"size";s:2:"14";s:4:"unit";s:2:"px";s:4:"face";s:5:"Arial";s:5:"style";s:0:"";s:5:"color";s:7:"#444444";}', 'yes'),
(204, 0, 'woo_font_widget_titles', 'a:5:{s:4:"size";s:2:"16";s:4:"unit";s:2:"px";s:4:"face";s:7:"Georgia";s:5:"style";s:4:"bold";s:5:"color";s:7:"#444444";}', 'yes'),
(205, 0, 'woo_font_footer_widget_titles', 'a:5:{s:4:"size";s:2:"10";s:4:"unit";s:2:"px";s:4:"face";s:5:"Arial";s:5:"style";s:6:"normal";s:5:"color";s:7:"#AAA8A8";}', 'yes'),
(206, 0, 'woo_site_layout', 'layout-left-content', 'yes'),
(207, 0, 'woo_exclude_cats_home', '', 'yes'),
(208, 0, 'woo_exclude_cats_blog', '', 'yes'),
(209, 0, 'woo_slider', 'true', 'yes'),
(210, 0, 'woo_slider_entries', '3', 'yes'),
(211, 0, 'woo_slider_effect', 'slide', 'yes'),
(212, 0, 'woo_slider_hover', 'false', 'yes'),
(213, 0, 'woo_slider_speed', '0.6', 'yes'),
(214, 0, 'woo_slider_auto', 'false', 'yes'),
(215, 0, 'woo_slider_interval', '4', 'yes'),
(216, 0, 'woo_slider_autoheight', 'false', 'yes'),
(217, 0, 'woo_slider_title', 'false', 'yes'),
(218, 0, 'woo_slider_content', 'false', 'yes'),
(219, 0, 'woo_slider_nextprev', 'false', 'yes'),
(220, 0, 'woo_slider_pagination', 'true', 'yes'),
(221, 0, 'woo_mini_features', 'true', 'yes'),
(222, 0, 'woo_main_page', 'Select a page:', 'yes'),
(223, 0, 'woo_portfolio_gallery', 'true', 'yes'),
(224, 0, 'woo_portfolioitems_rewrite', 'portfolio-items', 'yes'),
(225, 0, 'woo_portfolio_excludenav', '', 'yes'),
(226, 0, 'woo_portfolio_excludesearch', 'false', 'yes'),
(227, 0, 'woo_feedback_disable', 'false', 'yes'),
(228, 0, 'woo_nxtthumb_notice', '', 'yes'),
(229, 0, 'woo_post_image_support', 'true', 'yes'),
(230, 0, 'woo_pis_resize', 'true', 'yes'),
(231, 0, 'woo_pis_hard_crop', 'true', 'yes'),
(232, 0, 'woo_resize', 'true', 'yes'),
(233, 0, 'woo_auto_img', 'false', 'yes'),
(234, 0, 'woo_thumb_align', 'alignright', 'yes'),
(235, 0, 'woo_thumb_single', 'false', 'yes'),
(236, 0, 'woo_thumb_single_align', 'alignright', 'yes'),
(237, 0, 'woo_rss_thumb', 'false', 'yes'),
(238, 0, 'woo_enable_lightbox', 'false', 'yes'),
(239, 0, 'woo_footer_title', '', 'yes'),
(240, 0, 'woo_footer_sidebars', '4', 'yes'),
(241, 0, 'woo_footer_aff_link', '', 'yes'),
(242, 0, 'woo_footer_left', 'false', 'yes'),
(243, 0, 'woo_footer_left_text', '<p></p>', 'yes'),
(244, 0, 'woo_footer_right', 'false', 'yes'),
(245, 0, 'woo_footer_right_text', '<p></p>', 'yes'),
(246, 0, 'woo_connect', 'false', 'yes'),
(247, 0, 'woo_connect_title', '', 'yes'),
(248, 0, 'woo_connect_content', '', 'yes'),
(249, 0, 'woo_connect_newsletter_id', '', 'yes'),
(250, 0, 'woo_connect_mailchimp_list_url', '', 'yes'),
(251, 0, 'woo_connect_rss', 'true', 'yes'),
(252, 0, 'woo_connect_twitter', '', 'yes'),
(253, 0, 'woo_connect_facebook', '', 'yes'),
(254, 0, 'woo_connect_youtube', '', 'yes'),
(255, 0, 'woo_connect_flickr', '', 'yes'),
(256, 0, 'woo_connect_linkedin', '', 'yes'),
(257, 0, 'woo_connect_delicious', '', 'yes'),
(258, 0, 'woo_connect_googleplus', '', 'yes'),
(259, 0, 'woo_connect_related', 'true', 'yes'),
(260, 0, '_transient_timeout_wooframework_version_data', '1342272707', 'no'),
(261, 0, '_transient_wooframework_version_data', 'a:2:{s:7:"version";s:6:"5.3.12";s:11:"is_critical";b:1;}', 'no'),
(262, 0, '_transient_timeout_woo_framework_critical_update', '1343395907', 'no'),
(263, 0, '_transient_woo_framework_critical_update', '1', 'no'),
(264, 0, '_transient_timeout_woo_framework_critical_update_data', '1343395907', 'no'),
(265, 0, '_transient_woo_framework_critical_update_data', 'a:4:{s:9:"is_update";b:1;s:7:"version";s:6:"5.3.12";s:6:"status";s:4:"none";s:11:"is_critical";b:1;}', 'no'),
(266, 0, 'woo_layout_manager_notice', '', 'yes'),
(267, 0, 'woo_layout_width', '940px', 'yes'),
(268, 0, 'woo_layout', 'two-col-left', 'yes'),
(269, 0, 'woo_style_disable', 'false', 'yes'),
(270, 0, 'woo_style_bg', '', 'yes'),
(271, 0, 'woo_style_bg_image', '', 'yes'),
(272, 0, 'woo_style_bg_image_repeat', 'no-repeat', 'yes'),
(273, 0, 'woo_border_top', 'a:3:{s:5:"width";s:1:"4";s:5:"style";s:5:"solid";s:5:"color";s:7:"#000000";}', 'yes'),
(274, 0, 'woo_style_border', '', 'yes'),
(275, 0, 'woo_general_font_notice', '', 'yes'),
(276, 0, 'woo_font_text', 'a:5:{s:4:"size";s:2:"14";s:4:"unit";s:2:"px";s:4:"face";s:17:"Arial, sans-serif";s:5:"style";s:6:"normal";s:5:"color";s:7:"#555555";}', 'yes'),
(277, 0, 'woo_font_h1', 'a:5:{s:4:"size";s:2:"28";s:4:"unit";s:2:"px";s:4:"face";s:8:"PT Serif";s:5:"style";s:6:"normal";s:5:"color";s:7:"#222222";}', 'yes'),
(278, 0, 'woo_font_h2', 'a:5:{s:4:"size";s:2:"24";s:4:"unit";s:2:"px";s:4:"face";s:8:"PT Serif";s:5:"style";s:6:"normal";s:5:"color";s:7:"#222222";}', 'yes'),
(279, 0, 'woo_font_h3', 'a:5:{s:4:"size";s:2:"20";s:4:"unit";s:2:"px";s:4:"face";s:8:"PT Serif";s:5:"style";s:6:"normal";s:5:"color";s:7:"#222222";}', 'yes'),
(280, 0, 'woo_font_h4', 'a:5:{s:4:"size";s:2:"16";s:4:"unit";s:2:"px";s:4:"face";s:8:"PT Serif";s:5:"style";s:6:"normal";s:5:"color";s:7:"#222222";}', 'yes'),
(281, 0, 'woo_font_h5', 'a:5:{s:4:"size";s:2:"14";s:4:"unit";s:2:"px";s:4:"face";s:8:"PT Serif";s:5:"style";s:6:"normal";s:5:"color";s:7:"#222222";}', 'yes'),
(282, 0, 'woo_font_h6', 'a:5:{s:4:"size";s:2:"12";s:4:"unit";s:2:"px";s:4:"face";s:8:"PT Serif";s:5:"style";s:6:"normal";s:5:"color";s:7:"#222222";}', 'yes'),
(283, 0, 'woo_layout_boxed', 'true', 'yes'),
(284, 0, 'woo_style_box_bg', '', 'yes'),
(285, 0, 'woo_box_margin_top', '', 'yes'),
(286, 0, 'woo_box_margin_bottom', '', 'yes'),
(287, 0, 'woo_box_border_tb', 'a:3:{s:5:"width";s:1:"4";s:5:"style";s:5:"solid";s:5:"color";s:7:"#dbdbdb";}', 'yes'),
(288, 0, 'woo_box_border_lr', 'a:3:{s:5:"width";s:1:"4";s:5:"style";s:5:"solid";s:5:"color";s:7:"#dbdbdb";}', 'yes'),
(289, 0, 'woo_box_border_radius', '0px', 'yes'),
(290, 0, 'woo_box_shadow', 'true', 'yes'),
(291, 0, 'woo_header_bg', '', 'yes'),
(292, 0, 'woo_header_bg_image', '', 'yes'),
(293, 0, 'woo_header_bg_image_repeat', 'no-repeat', 'yes'),
(294, 0, 'woo_header_border', 'a:3:{s:5:"width";s:1:"0";s:5:"style";s:5:"solid";s:5:"color";s:0:"";}', 'yes'),
(295, 0, 'woo_header_margin_top', '0', 'yes'),
(296, 0, 'woo_header_margin_bottom', '0', 'yes'),
(297, 0, 'woo_header_padding_top', '40', 'yes'),
(298, 0, 'woo_header_padding_bottom', '30', 'yes'),
(299, 0, 'woo_header_padding_left', '', 'yes'),
(300, 0, 'woo_header_padding_right', '', 'yes'),
(301, 0, 'woo_font_logo', 'a:5:{s:4:"size";s:2:"40";s:4:"unit";s:2:"px";s:4:"face";s:8:"PT Serif";s:5:"style";s:6:"normal";s:5:"color";s:7:"#222222";}', 'yes'),
(302, 0, 'woo_font_desc', 'a:5:{s:4:"size";s:2:"14";s:4:"unit";s:2:"px";s:4:"face";s:8:"PT Serif";s:5:"style";s:6:"italic";s:5:"color";s:7:"#999999";}', 'yes'),
(303, 0, 'woo_font_post_text', 'a:5:{s:4:"size";s:2:"16";s:4:"unit";s:2:"px";s:4:"face";s:8:"PT Serif";s:5:"style";s:6:"normal";s:5:"color";s:7:"#555555";}', 'yes'),
(304, 0, 'woo_font_post_more', 'a:5:{s:4:"size";s:2:"12";s:4:"unit";s:2:"px";s:4:"face";s:17:"Arial, sans-serif";s:5:"style";s:6:"normal";s:5:"color";s:7:"#868686";}', 'yes'),
(305, 0, 'woo_post_more_border_top', 'a:3:{s:5:"width";s:1:"4";s:5:"style";s:5:"solid";s:5:"color";s:7:"#e6e6e6";}', 'yes'),
(306, 0, 'woo_post_more_border_bottom', 'a:3:{s:5:"width";s:1:"1";s:5:"style";s:5:"solid";s:5:"color";s:7:"#e6e6e6";}', 'yes'),
(307, 0, 'woo_post_author_bg', '#fafafa', 'yes'),
(308, 0, 'woo_post_author_border_top', 'a:3:{s:5:"width";s:1:"1";s:5:"style";s:5:"solid";s:5:"color";s:7:"#e6e6e6";}', 'yes'),
(309, 0, 'woo_post_author_border_bottom', 'a:3:{s:5:"width";s:1:"4";s:5:"style";s:5:"solid";s:5:"color";s:7:"#e6e6e6";}', 'yes'),
(310, 0, 'woo_disable_post_author', 'false', 'yes'),
(311, 0, 'woo_post_comments_bg', '', 'yes'),
(312, 0, 'woo_pagenav_font', 'a:5:{s:4:"size";s:2:"12";s:4:"unit";s:2:"px";s:4:"face";s:8:"PT Serif";s:5:"style";s:6:"italic";s:5:"color";s:7:"#777777";}', 'yes'),
(313, 0, 'woo_pagenav_bg', '', 'yes'),
(314, 0, 'woo_pagenav_border_top', 'a:3:{s:5:"width";s:1:"1";s:5:"style";s:5:"solid";s:5:"color";s:7:"#e6e6e6";}', 'yes'),
(315, 0, 'woo_pagenav_border_bottom', 'a:3:{s:5:"width";s:1:"4";s:5:"style";s:5:"solid";s:5:"color";s:7:"#e6e6e6";}', 'yes'),
(316, 0, 'woo_archive_header_font', 'a:5:{s:4:"size";s:2:"18";s:4:"unit";s:2:"px";s:4:"face";s:17:"Arial, sans-serif";s:5:"style";s:6:"normal";s:5:"color";s:7:"#555555";}', 'yes'),
(317, 0, 'woo_archive_header_border_bottom', 'a:3:{s:5:"width";s:1:"5";s:5:"style";s:5:"solid";s:5:"color";s:7:"#e6e6e6";}', 'yes'),
(318, 0, 'woo_archive_header_disable_rss', 'false', 'yes'),
(319, 0, 'woo_widget_bg', '', 'yes'),
(320, 0, 'woo_widget_border', 'a:3:{s:5:"width";s:1:"0";s:5:"style";s:5:"solid";s:5:"color";s:7:"#dbdbdb";}', 'yes'),
(321, 0, 'woo_widget_padding_tb', '', 'yes'),
(322, 0, 'woo_widget_padding_lr', '', 'yes'),
(323, 0, 'woo_widget_font_title', 'a:5:{s:4:"size";s:2:"14";s:4:"unit";s:2:"px";s:4:"face";s:8:"PT Serif";s:5:"style";s:4:"bold";s:5:"color";s:7:"#555555";}', 'yes'),
(324, 0, 'woo_widget_title_border', 'a:3:{s:5:"width";s:1:"3";s:5:"style";s:5:"solid";s:5:"color";s:7:"#e6e6e6";}', 'yes'),
(325, 0, 'woo_widget_font_text', 'a:5:{s:4:"size";s:2:"12";s:4:"unit";s:2:"px";s:4:"face";s:17:"Arial, sans-serif";s:5:"style";s:6:"normal";s:5:"color";s:7:"#555555";}', 'yes'),
(326, 0, 'woo_widget_border_radius', '0px', 'yes'),
(327, 0, 'woo_widget_tabs_bg', '', 'yes'),
(328, 0, 'woo_widget_tabs_bg_inside', '', 'yes'),
(329, 0, 'woo_widget_tabs_font', 'a:5:{s:4:"size";s:2:"12";s:4:"unit";s:2:"px";s:4:"face";s:8:"PT Serif";s:5:"style";s:4:"bold";s:5:"color";s:7:"#555555";}', 'yes'),
(330, 0, 'woo_widget_tabs_font_meta', 'a:5:{s:4:"size";s:2:"11";s:4:"unit";s:2:"px";s:4:"face";s:34:""Trebuchet MS", Tahoma, sans-serif";s:5:"style";s:6:"normal";s:5:"color";s:7:"#777777";}', 'yes'),
(331, 0, 'woo_footer_font', 'a:5:{s:4:"size";s:2:"14";s:4:"unit";s:2:"px";s:4:"face";s:8:"PT Serif";s:5:"style";s:6:"italic";s:5:"color";s:7:"#777777";}', 'yes'),
(332, 0, 'woo_footer_bg', '', 'yes'),
(333, 0, 'woo_footer_border_top', 'a:3:{s:5:"width";s:1:"4";s:5:"style";s:5:"solid";s:5:"color";s:7:"#dbdbdb";}', 'yes'),
(334, 0, 'woo_footer_border_bottom', 'a:3:{s:5:"width";s:1:"0";s:5:"style";s:5:"solid";s:5:"color";s:0:"";}', 'yes'),
(335, 0, 'woo_footer_border_lr', 'a:3:{s:5:"width";s:1:"0";s:5:"style";s:5:"solid";s:5:"color";s:0:"";}', 'yes'),
(336, 0, 'woo_footer_border_radius', '0px', 'yes'),
(337, 0, 'woo_nav_rss', 'true', 'yes'),
(338, 0, 'woo_nav_bg', '', 'yes'),
(339, 0, 'woo_nav_font', 'a:5:{s:4:"size";s:2:"14";s:4:"unit";s:2:"px";s:4:"face";s:17:"Arial, sans-serif";s:5:"style";s:6:"normal";s:5:"color";s:7:"#555555";}', 'yes'),
(340, 0, 'woo_nav_hover', '', 'yes'),
(341, 0, 'woo_nav_currentitem', '', 'yes'),
(342, 0, 'woo_nav_border_top', 'a:3:{s:5:"width";s:1:"1";s:5:"style";s:5:"solid";s:5:"color";s:7:"#dbdbdb";}', 'yes'),
(343, 0, 'woo_nav_border_bot', 'a:3:{s:5:"width";s:1:"4";s:5:"style";s:5:"solid";s:5:"color";s:7:"#dbdbdb";}', 'yes'),
(344, 0, 'woo_nav_border_lr', 'a:3:{s:5:"width";s:1:"0";s:5:"style";s:5:"solid";s:5:"color";s:7:"#dbdbdb";}', 'yes'),
(345, 0, 'woo_nav_border_radius', '0px', 'yes'),
(346, 0, 'woo_top_nav_bg', '', 'yes'),
(347, 0, 'woo_top_nav_hover', '', 'yes'),
(348, 0, 'woo_top_nav_font', 'a:5:{s:4:"size";s:2:"14";s:4:"unit";s:2:"px";s:4:"face";s:17:"Arial, sans-serif";s:5:"style";s:6:"normal";s:5:"color";s:4:"#ddd";}', 'yes'),
(349, 0, 'woo_thumb_w', '100', 'yes'),
(350, 0, 'woo_thumb_h', '100', 'yes'),
(351, 0, 'woo_single_w', '200', 'yes'),
(352, 0, 'woo_single_h', '200', 'yes'),
(353, 0, 'woo_thumb_align_single', 'alignright', 'yes'),
(354, 0, 'woo_ad_top', 'false', 'yes'),
(355, 0, 'woo_ad_top_adsense', '', 'yes'),
(356, 0, 'woo_ad_top_image', 'http://www.woothemes.com/ads/468x60b.jpg', 'yes'),
(357, 0, 'woo_ad_top_url', 'http://www.woothemes.com', 'yes'),
(358, 0, 'woo_woo_magazine_notice', '', 'yes'),
(359, 0, 'woo_magazine_feat_posts', '2', 'yes'),
(360, 0, 'woo_magazine_f_w', '100', 'yes'),
(361, 0, 'woo_magazine_f_h', '100', 'yes'),
(362, 0, 'woo_magazine_f_align', 'alignleft', 'yes'),
(363, 0, 'woo_magazine_b_w', '100', 'yes'),
(364, 0, 'woo_magazine_b_h', '100', 'yes'),
(365, 0, 'woo_magazine_b_align', 'alignleft', 'yes'),
(366, 0, 'woo_magazine_exclude', '', 'yes'),
(367, 0, 'woo_slider_magazine', 'false', 'yes'),
(368, 0, 'woo_slider_magazine_tags', '', 'yes'),
(369, 0, 'woo_slider_magazine_entries', '3', 'yes'),
(370, 0, 'woo_slider_magazine_exclude', 'true', 'yes'),
(371, 0, 'woo_slider_magazine_title', 'true', 'yes'),
(372, 0, 'woo_slider_magazine_font_title', 'a:5:{s:4:"size";s:2:"24";s:4:"unit";s:2:"px";s:4:"face";s:17:"Arial, sans-serif";s:5:"style";s:4:"bold";s:5:"color";s:7:"#ffffff";}', 'yes'),
(373, 0, 'woo_slider_magazine_excerpt', 'true', 'yes'),
(374, 0, 'woo_slider_magazine_font_excerpt', 'a:5:{s:4:"size";s:2:"12";s:4:"unit";s:2:"px";s:4:"face";s:17:"Arial, sans-serif";s:5:"style";s:6:"normal";s:5:"color";s:7:"#cccccc";}', 'yes'),
(375, 0, 'woo_slider_magazine_excerpt_length', '15', 'yes'),
(376, 0, 'woo_slider_magazine_height', '', 'yes'),
(377, 0, 'woo_magazine_limit', '10', 'yes'),
(378, 0, 'woo_magazine_featured_post_content', 'excerpt', 'yes'),
(379, 0, 'woo_magazine_grid_post_content', 'excerpt', 'yes'),
(380, 0, 'woo_woo_biz_notice', '', 'yes'),
(381, 0, 'woo_slider_biz', 'true', 'yes'),
(382, 0, 'woo_slider_biz_number', '10', 'yes'),
(383, 0, 'woo_slider_biz_order', 'DESC', 'yes'),
(384, 0, 'woo_slider_biz_title', 'true', 'yes'),
(385, 0, 'woo_slider_biz_font_title', 'a:5:{s:4:"size";s:2:"24";s:4:"unit";s:2:"px";s:4:"face";s:17:"Arial, sans-serif";s:5:"style";s:4:"bold";s:5:"color";s:7:"#ffffff";}', 'yes'),
(386, 0, 'woo_slider_biz_font_excerpt', 'a:5:{s:4:"size";s:2:"12";s:4:"unit";s:2:"px";s:4:"face";s:17:"Arial, sans-serif";s:5:"style";s:6:"normal";s:5:"color";s:7:"#cccccc";}', 'yes'),
(387, 0, 'woo_slider_biz_height', '', 'yes'),
(388, 0, 'woo_biz_disable_footer_widgets', 'true', 'yes'),
(389, 0, 'woo_biz_slides_disable', 'false', 'yes'),
(390, 0, 'woo_woo_slider_notice', '', 'yes'),
(391, 0, 'woo_slider_containerclick', 'false', 'yes'),
(392, 0, 'woo_portfolio_notice', '', 'yes'),
(393, 0, 'woo_portfolio_thumb_width', '210', 'yes'),
(394, 0, 'woo_portfolio_thumb_height', '120', 'yes'),
(395, 0, 'woo_portfolio_layout', 'one-col', 'yes'),
(396, 0, 'woo_portfolio_linkto', 'lightbox', 'yes'),
(397, 0, 'woo_portfolio_disable', 'false', 'yes'),
(398, 0, 'woo_woo_tumblog_notice', '', 'yes'),
(399, 0, 'woo_woo_tumblog_switch', 'false', 'yes'),
(400, 0, 'woo_tumblog_content_method', 'post_format', 'yes'),
(401, 0, 'woo_custom_rss', 'true', 'yes'),
(402, 0, 'woo_image_link_to', 'post', 'yes'),
(403, 0, 'woo_tumblog_image_width', '610', 'yes'),
(404, 0, 'woo_woo_tumblog_images_content', 'Before', 'yes'),
(405, 0, 'woo_tumblog_audio_width', '440', 'yes'),
(406, 0, 'woo_woo_tumblog_audio_content', 'Before', 'yes'),
(407, 0, 'woo_tumblog_video_width', '610', 'yes'),
(408, 0, 'woo_woo_tumblog_videos_content', 'Before', 'yes'),
(409, 0, 'woo_woo_tumblog_quotes_content', 'Before', 'yes'),
(410, 0, 'woo_tumblog_magazine_media_width', '300', 'yes'),
(414, 0, '_transient_timeout_dash_20494a3d90a6669585674ed0eb8dcd8f', '1342335062', 'no'),
(415, 0, '_transient_timeout_dash_aa95765b5cc111c56d5993d476b1c2f0', '1342335062', 'no'),
(416, 0, '_transient_dash_20494a3d90a6669585674ed0eb8dcd8f', '<p><strong>RSS Error</strong>: nxt HTTP Error: Could not resolve host: blogsearch.google.com; Host not found</p>', 'no'),
(417, 0, '_transient_dash_aa95765b5cc111c56d5993d476b1c2f0', '<div class="rss-widget"><p><strong>RSS Error</strong>: nxt HTTP Error: Could not resolve host: planet.nxtclass.org; Host not found</p></div>', 'no'),
(418, 0, '_transient_timeout_plugin_slugs', '1342378263', 'no'),
(419, 0, '_transient_plugin_slugs', 'a:23:{i:0;s:23:"achievements/loader.php";i:1;s:38:"bigbluebutton/bigbluebutton-plugin.php";i:2;s:24:"buddypress/bp-loader.php";i:3;s:36:"buddypress-courseware/courseware.php";i:4;s:27:"bp-template-pack/loader.php";i:5;s:66:"buddypress-user-account-type-lite/buddypress-user-account-type.php";i:6;s:30:"ckeditor/ckeditor_nxtclass.php";i:7;s:27:"class-blogs/class-blogs.php";i:8;s:25:"cloudflare/cloudflare.php";i:9;s:43:"google-analyticator/google-analyticator.php";i:10;s:49:"google-xml-sitemaps-v3-for-qtranslate/sitemap.php";i:11;s:19:"members/members.php";i:12;s:25:"membership/membership.php";i:13;s:27:"nxt-fb-autoconnect/Main.php";i:14;s:25:"nxt-math-2/nxt-math-2.php";i:15;s:39:"nxtclass-importer/nxtclass-importer.php";i:16;s:33:"Domain-mapping/domain_mapping.php";i:17;s:43:"nxtclass-bootstrap-css/hlt-bootstrapcss.php";i:18;s:31:"nxtclass-wiki/nxtclass-wiki.php";i:19;s:26:"nxtclass-openid/openid.php";i:20;s:45:"use-google-libraries/use-google-libraries.php";i:21;s:33:"w3-total-cache/w3-total-cache.php";i:22;s:32:"white-label-cms/wlcms-plugin.php";}', 'no'),
(420, 0, '_transient_timeout_dash_de3249c4736ad3bd2cd29147c4a0d43e', '1342335063', 'no'),
(421, 0, '_transient_dash_de3249c4736ad3bd2cd29147c4a0d43e', '', 'no'),
(422, 0, '_transient_timeout_dash_4077549d03da2e451c8b5f002294ff51', '1342335064', 'no'),
(423, 0, '_transient_dash_4077549d03da2e451c8b5f002294ff51', '<div class="rss-widget"><p><strong>RSS Error</strong>: nxt HTTP Error: Could not resolve host: nxtclass.org; Host not found</p></div>', 'no'),
(424, 0, '_transient_doing_cron', '1343910927', 'yes'),
(427, 0, '_site_transient_timeout_theme_roots', '1343247264', 'yes'),
(428, 0, '_site_transient_theme_roots', 'a:7:{s:6:"Modest";s:7:"/themes";s:10:"bp-default";s:29:"/plugins/buddypress/bp-themes";s:6:"canvas";s:7:"/themes";s:6:"huddle";s:7:"/themes";s:8:"infinity";s:7:"/themes";s:21:"swatch for Buddypress";s:7:"/themes";s:10:"whitelight";s:7:"/themes";}', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `n_postmeta`
--

CREATE TABLE IF NOT EXISTS `n_postmeta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext,
  PRIMARY KEY (`meta_id`),
  KEY `post_id` (`post_id`),
  KEY `meta_key` (`meta_key`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `n_postmeta`
--

INSERT INTO `n_postmeta` (`meta_id`, `post_id`, `meta_key`, `meta_value`) VALUES
(1, 2, '_nxt_page_template', 'default');

-- --------------------------------------------------------

--
-- Table structure for table `n_posts`
--

CREATE TABLE IF NOT EXISTS `n_posts` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_author` bigint(20) unsigned NOT NULL DEFAULT '0',
  `post_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content` longtext NOT NULL,
  `post_title` text NOT NULL,
  `post_excerpt` text NOT NULL,
  `post_status` varchar(20) NOT NULL DEFAULT 'publish',
  `comment_status` varchar(20) NOT NULL DEFAULT 'open',
  `ping_status` varchar(20) NOT NULL DEFAULT 'open',
  `post_password` varchar(20) NOT NULL DEFAULT '',
  `post_name` varchar(200) NOT NULL DEFAULT '',
  `to_ping` text NOT NULL,
  `pinged` text NOT NULL,
  `post_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_modified_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content_filtered` text NOT NULL,
  `post_parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `guid` varchar(255) NOT NULL DEFAULT '',
  `menu_order` int(11) NOT NULL DEFAULT '0',
  `post_type` varchar(20) NOT NULL DEFAULT 'post',
  `post_mime_type` varchar(100) NOT NULL DEFAULT '',
  `comment_count` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `post_name` (`post_name`),
  KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`ID`),
  KEY `post_parent` (`post_parent`),
  KEY `post_author` (`post_author`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `n_posts`
--

INSERT INTO `n_posts` (`ID`, `post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES
(1, 1, '2012-06-28 12:55:26', '2012-06-28 12:55:26', 'Welcome to NXTClass. This is your first post. Edit or delete it, then start blogging!', 'Hello world!', '', 'publish', 'open', 'open', '', 'hello-world', '', '', '2012-06-28 12:55:26', '2012-06-28 12:55:26', '', 0, 'http://localhost/htdocs/?p=1', 0, 'post', '', 1),
(2, 1, '2012-06-28 12:55:26', '2012-06-28 12:55:26', 'This is an example page. It''s different from a blog post because it will stay in one place and will show up in your site navigation (in most themes). Most people start with an About page that introduces them to potential site visitors. It might say something like this:\r\n\r\n<blockquote>Hi there! I''m a bike messenger by day, aspiring actor by night, and this is my blog. I live in Los Angeles, have a great dog named Jack, and I like pi&#241;a coladas. (And gettin'' caught in the rain.)</blockquote>\r\n\r\n...or something like this:\r\n\r\n<blockquote>The XYZ Doohickey Company was founded in 1971, and has been providing quality doohickies to the public ever since. Located in Gotham City, XYZ employs over 2,000 people and does all kinds of awesome things for the Gotham community.</blockquote>\r\n\r\nAs a new NXTClass user, you should go to <a href="http://localhost/htdocs/nxt-admin/">your dashboard</a> to delete this page and create new pages for your content. Have fun!', 'Sample Page', '', 'publish', 'open', 'open', '', 'sample-page', '', '', '2012-06-28 12:55:26', '2012-06-28 12:55:26', '', 0, 'http://localhost/htdocs/?page_id=2', 0, 'page', '', 0),
(3, 1, '2012-06-28 12:55:52', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'open', 'open', '', '', '', '', '2012-06-28 12:55:52', '0000-00-00 00:00:00', '', 0, 'http://localhost/htdocs/?p=3', 0, 'post', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `n_terms`
--

CREATE TABLE IF NOT EXISTS `n_terms` (
  `term_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL DEFAULT '',
  `slug` varchar(200) NOT NULL DEFAULT '',
  `term_group` bigint(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`term_id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `n_terms`
--

INSERT INTO `n_terms` (`term_id`, `name`, `slug`, `term_group`) VALUES
(1, 'Uncategorized', 'uncategorized', 0),
(2, 'Blogroll', 'blogroll', 0);

-- --------------------------------------------------------

--
-- Table structure for table `n_term_relationships`
--

CREATE TABLE IF NOT EXISTS `n_term_relationships` (
  `object_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_taxonomy_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`object_id`,`term_taxonomy_id`),
  KEY `term_taxonomy_id` (`term_taxonomy_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `n_term_relationships`
--

INSERT INTO `n_term_relationships` (`object_id`, `term_taxonomy_id`, `term_order`) VALUES
(1, 1, 0),
(1, 2, 0),
(2, 2, 0),
(3, 2, 0),
(4, 2, 0),
(5, 2, 0),
(6, 2, 0),
(7, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `n_term_taxonomy`
--

CREATE TABLE IF NOT EXISTS `n_term_taxonomy` (
  `term_taxonomy_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `term_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `taxonomy` varchar(32) NOT NULL DEFAULT '',
  `description` longtext NOT NULL,
  `parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `count` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`term_taxonomy_id`),
  UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
  KEY `taxonomy` (`taxonomy`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `n_term_taxonomy`
--

INSERT INTO `n_term_taxonomy` (`term_taxonomy_id`, `term_id`, `taxonomy`, `description`, `parent`, `count`) VALUES
(1, 1, 'category', '', 0, 1),
(2, 2, 'link_category', '', 0, 7);

-- --------------------------------------------------------

--
-- Table structure for table `n_usermeta`
--

CREATE TABLE IF NOT EXISTS `n_usermeta` (
  `umeta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext,
  PRIMARY KEY (`umeta_id`),
  KEY `user_id` (`user_id`),
  KEY `meta_key` (`meta_key`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `n_usermeta`
--

INSERT INTO `n_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES
(1, 1, 'first_name', ''),
(2, 1, 'last_name', ''),
(3, 1, 'nickname', 'admin'),
(4, 1, 'description', ''),
(5, 1, 'rich_editing', 'true'),
(6, 1, 'comment_shortcuts', 'false'),
(7, 1, 'admin_color', 'fresh'),
(8, 1, 'use_ssl', '0'),
(9, 1, 'show_admin_bar_front', 'true'),
(10, 1, 'n_capabilities', 'a:2:{s:10:"contibuter";s:1:"1";s:13:"administrator";s:1:"1";}'),
(11, 1, 'n_user_level', '10'),
(12, 1, 'dismissed_nxt_pointers', 'nxt330_toolbar,nxt330_media_uploader,nxt330_saving_widgets'),
(13, 1, 'show_welcome_panel', '1'),
(14, 1, 'n_user-settings', 'editor=tinymce&wooframeworkhidebannerwoodojo=1&wooframeworkhidebannerpresstrends=1'),
(15, 1, 'n_user-settings-time', '1340888146'),
(16, 1, 'n_dashboard_quick_press_last_post_id', '3');

-- --------------------------------------------------------

--
-- Table structure for table `n_users`
--

CREATE TABLE IF NOT EXISTS `n_users` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_login` varchar(60) NOT NULL DEFAULT '',
  `user_pass` varchar(64) NOT NULL DEFAULT '',
  `user_nicename` varchar(50) NOT NULL DEFAULT '',
  `user_email` varchar(100) NOT NULL DEFAULT '',
  `user_url` varchar(100) NOT NULL DEFAULT '',
  `user_registered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_activation_key` varchar(60) NOT NULL DEFAULT '',
  `user_status` int(11) NOT NULL DEFAULT '0',
  `display_name` varchar(250) NOT NULL DEFAULT '',
  PRIMARY KEY (`ID`),
  KEY `user_login_key` (`user_login`),
  KEY `user_nicename` (`user_nicename`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `n_users`
--

INSERT INTO `n_users` (`ID`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`) VALUES
(1, 'admin', '$P$BXCinEFzRbfMtCTh727l.7RdQUWQpY.', 'admin', 'arkomitter@in.com', '', '2012-06-28 12:55:25', '', 0, 'admin');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

<?php
#########################################################
## phpBB2 Update phpBB2 Plus 1.52 -> 1.53 latest
## Author: Niels Chr. R�d
## Nickname: Niels Chr. Denmark
## Email: ncr@db9.dk
##
#########################################################

define('IN_LOGIN', true);
define('IN_PHPBB', true);
###########################
$forum_version = '.0.22';
$plus_version = '1.53a';
$attach_version = '2.4.3';
$ct_version = '4.1.7';

###########################
$phpbb_root_path = './../';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);
include($phpbb_root_path . 'includes/functions_selects.'.$phpEx);

###################################################################################################
$sql=array(
'UPDATE '.$table_prefix.'config SET config_value = "'.$forum_version.'" WHERE config_name = "version"',
'UPDATE '.$table_prefix.'plus SET config_value = "'.$plus_version.'" WHERE config_name = "plus_version"',
'INSERT INTO '.$table_prefix.'plus VALUES ("enable_shorturls", "0")',
'INSERT INTO '.$table_prefix.'plus VALUES ("disable_sid", "0")',
'INSERT INTO '.$table_prefix.'plus VALUES ("enable_antirobot", "1")',
'INSERT INTO '.$table_prefix.'plus VALUES ("enable_banners", "1")',
'INSERT INTO '.$table_prefix.'plus VALUES ("enable_confirm_post", "0")',
'UPDATE '.$table_prefix.'album_config SET config_value = ".0.53" WHERE config_name = "album_version"',
'ALTER TABLE '.$table_prefix.'album_cat ADD cat_user_id MEDIUMINT(8) UNSIGNED DEFAULT "0" NULL AFTER cat_parent',
'INSERT INTO '.$table_prefix.'album_config (config_name, config_value) VALUES ("show_index_pics", "0")', 
'INSERT INTO '.$table_prefix.'album_config (config_name, config_value) VALUES ("show_recent_in_subcats", "1")',
'INSERT INTO '.$table_prefix.'album_config (config_name, config_value) VALUES ("show_recent_instead_of_nopics", "1")',
'INSERT INTO '.$table_prefix.'album_config (config_name, config_value) VALUES ("personal_allow_gallery_mod", "1")',
'INSERT INTO '.$table_prefix.'album_config (config_name, config_value) VALUES ("personal_allow_sub_categories", "1")',
'INSERT INTO '.$table_prefix.'album_config (config_name, config_value) VALUES ("personal_sub_category_limit", "10")',
'INSERT INTO '.$table_prefix.'album_config (config_name, config_value) VALUES ("personal_show_subcats_in_index", "1")',
'INSERT INTO '.$table_prefix.'album_config (config_name, config_value) VALUES ("personal_show_recent_in_subcats", "1")',
'INSERT INTO '.$table_prefix.'album_config (config_name, config_value) VALUES ("personal_show_recent_instead_of_nopics", "1")',
'INSERT INTO '.$table_prefix.'album_config (config_name, config_value) VALUES ("show_personal_gallery_link", "1")',
'INSERT INTO '.$table_prefix.'album_config (config_name, config_value) VALUES ("album_category_sorting", "cat_order")',
'INSERT INTO '.$table_prefix.'album_config (config_name, config_value) VALUES ("album_category_sorting_direction", "ASC")',
'INSERT INTO '.$table_prefix.'album_config (config_name, config_value) VALUES ("album_debug_mode", "0")',
'INSERT INTO '.$table_prefix.'album_config (config_name, config_value) VALUES ("show_all_in_personal_gallery", "0")',
'INSERT INTO '.$table_prefix.'album_config (config_name, config_value) VALUES ("new_pic_check_interval", "1M")',
'INSERT INTO '.$table_prefix.'album_config (config_name, config_value) VALUES ("index_enable_supercells", "1")',
'CREATE TABLE '.$table_prefix.'kb_articles (
article_id mediumint(8) unsigned NOT NULL auto_increment,
article_category_id mediumint(8) unsigned NOT NULL default "0",
article_title varchar(255) binary NOT NULL default "",
article_description varchar(255) binary NOT NULL default "",
article_date varchar(255) binary NOT NULL default "",
article_author_id mediumint(8) unsigned NOT NULL default "0",
username VARCHAR(255),
bbcode_uid varchar(10) binary NOT NULL default "",
article_body text NOT NULL,
article_type mediumint(8) unsigned NOT NULL default "0",
approved tinyint(1) unsigned NOT NULL default "0",
topic_id mediumint(8) unsigned NOT NULL default "0",
views BIGINT(8) NOT NULL DEFAULT "0",
article_rating double(6,4) NOT NULL default "0.0000",
article_totalvotes int(255) NOT NULL default "0",
KEY article_id (article_id)
) TYPE=MyISAM',
'CREATE TABLE '.$table_prefix.'kb_categories (
category_id mediumint(8) unsigned NOT NULL auto_increment, 
category_name VARCHAR(255) binary NOT NULL, 
category_details VARCHAR(255) binary NOT NULL, 
number_articles mediumint(8) unsigned NOT NULL,
parent mediumint(8) unsigned,
cat_order mediumint(8) unsigned NOT NULL,
KEY category_id (category_id)
) TYPE=MyISAM',
'CREATE TABLE '.$table_prefix.'kb_config (
config_name VARCHAR(255) NOT NULL default "", 
config_value varchar(255) NOT NULL default "",
PRIMARY KEY  (config_name)
) TYPE=MyISAM',
'CREATE TABLE '.$table_prefix.'kb_types (
id mediumint(8) unsigned NOT NULL auto_increment, 
type varchar(255) binary DEFAULT "" NOT NULL, 
KEY id (id)
) TYPE=MyISAM',
'CREATE TABLE '.$table_prefix.'kb_votes (
votes_ip varchar(50) NOT NULL default "0",
votes_userid int(50) NOT NULL default "0",
votes_file int(50) NOT NULL default "0"
) TYPE=MyISAM',
'CREATE TABLE '.$table_prefix.'kb_results (
search_id int(11) unsigned NOT NULL default "0",
session_id varchar(32) NOT NULL default "",
search_array text NOT NULL,
PRIMARY KEY  (search_id),
KEY session_id (session_id)
) TYPE=MyISAM',
'CREATE TABLE '.$table_prefix.'kb_wordlist (
word_text varchar(50) binary NOT NULL default "",
word_id mediumint(8) unsigned NOT NULL auto_increment,
word_common tinyint(1) unsigned NOT NULL default "0",
PRIMARY KEY  (word_text),
KEY word_id (word_id)
) TYPE=MyISAM',
'CREATE TABLE '.$table_prefix.'kb_wordmatch (
article_id mediumint(8) unsigned NOT NULL default "0",
word_id mediumint(8) unsigned NOT NULL default "0",
title_match tinyint(1) NOT NULL default "0",
KEY post_id (article_id),
KEY word_id (word_id)
) TYPE=MyISAM',
'INSERT INTO '.$table_prefix.'kb_categories VALUES (1, "Test Category 1", "This is a test category", 1, "0", "10")',
'INSERT INTO '.$table_prefix.'kb_config (config_name, config_value) VALUES ("approve_new", "1")',
'INSERT INTO '.$table_prefix.'kb_config (config_name, config_value) VALUES ("approve_edit", "1")',
'INSERT INTO '.$table_prefix.'kb_config (config_name, config_value) VALUES ("allow_new", "1")',
'INSERT INTO '.$table_prefix.'kb_config (config_name, config_value) VALUES ("allow_edit", "1")',
'INSERT INTO '.$table_prefix.'kb_config (config_name, config_value) VALUES ("notify", "1")',
'INSERT INTO '.$table_prefix.'kb_config (config_name, config_value) VALUES ("admin_id", "2")',
'INSERT INTO '.$table_prefix.'kb_config (config_name, config_value) VALUES ("show_pretext","0")',
'INSERT INTO '.$table_prefix.'kb_config (config_name, config_value) VALUES ("pt_header","Article Submission Instructions")',
'INSERT INTO '.$table_prefix.'kb_config (config_name, config_value) VALUES ("pt_body","Please check your references and include as much information as you can.")',
'INSERT INTO '.$table_prefix.'kb_config (config_name, config_value) VALUES ("forum_id", "1")',
'INSERT INTO '.$table_prefix.'kb_config (config_name, config_value) VALUES ("comments", "1")',
'INSERT INTO '.$table_prefix.'kb_config (config_name, config_value) VALUES ("allow_anon", "0")',
'INSERT INTO '.$table_prefix.'kb_config (config_name, config_value) VALUES ("del_topic", "1")',
'INSERT INTO '.$table_prefix.'kb_config (config_name, config_value) VALUES ("allow_rating", "0")',
'INSERT INTO '.$table_prefix.'kb_config (config_name, config_value) VALUES ("allow_anonymos_rating", "0")',
'INSERT INTO '.$table_prefix.'kb_config (config_name, config_value) VALUES ("comments_show", "1")',
'INSERT INTO '.$table_prefix.'kb_config (config_name, config_value) VALUES ("mod_group", "0")',
'INSERT INTO '.$table_prefix.'kb_config (config_name, config_value) VALUES ("bump_post", "1")',
'INSERT INTO '.$table_prefix.'kb_config (config_name, config_value) VALUES ("stats_list", "1")',
'INSERT INTO '.$table_prefix.'kb_config (config_name, config_value) VALUES ("header_banner", "1")',
'INSERT INTO '.$table_prefix.'kb_config (config_name, config_value) VALUES ("votes_check_userid", "1")',
'INSERT INTO '.$table_prefix.'kb_config (config_name, config_value) VALUES ("votes_check_ip", "1")',
'INSERT INTO '.$table_prefix.'kb_config (config_name, config_value) VALUES ("art_pagination", "5")',
'INSERT INTO '.$table_prefix.'kb_config (config_name, config_value) VALUES ("comments_pagination", "5")',
'INSERT INTO '.$table_prefix.'kb_config (config_name, config_value) VALUES ("news_sort", "Alphabetic")',
'INSERT INTO '.$table_prefix.'kb_config (config_name, config_value) VALUES ("news_sort_par", "ASC")',
'INSERT INTO '.$table_prefix.'kb_types VALUES ("1", "Test Type 1")',
'INSERT INTO '.$table_prefix.'config (config_name, config_value) VALUES ("registration_status", "0")',
'INSERT INTO '.$table_prefix.'config (config_name, config_value) VALUES ("registration_closed", "")',
'INSERT INTO '.$table_prefix.'config (config_name, config_value) VALUES ("use_ajax_preview", "1")',
'INSERT INTO '.$table_prefix.'config (config_name, config_value) VALUES ("use_ajax_edit", "1")',
'ALTER TABLE '.$table_prefix.'users ADD user_use_ajax_preview tinyint(1) default 1',
'ALTER TABLE '.$table_prefix.'users ADD user_use_ajax_edit tinyint(1) default 1',
'INSERT INTO '.$table_prefix.'plus (config_name, config_value) VALUES ("enable_gentime", "0")',
'INSERT INTO '.$table_prefix.'portal (portal_name, portal_value) VALUES ("number_top_posters", "5")',
'CREATE TABLE ' . $table_prefix . 'profile_fields (
	`field_id` MEDIUMINT( 8 ) UNSIGNED NOT NULL AUTO_INCREMENT,
	`field_name` VARCHAR( 255 ) NOT NULL ,
	`field_description` VARCHAR( 255 ) NULL ,
	`field_type` TINYINT( 4 ) UNSIGNED NOT NULL DEFAULT \'0\',
	`text_field_default` VARCHAR( 255 ) NULL ,
	`text_field_maxlen` INT( 255 ) UNSIGNED NOT NULL DEFAULT \'255\',
	`text_area_default` TEXT NULL ,
	`text_area_maxlen` INT( 255 ) UNSIGNED NOT NULL DEFAULT \'1024\',
	`radio_button_default` VARCHAR( 255 ) NULL ,
	`radio_button_values` TEXT NULL ,
	`checkbox_default` TEXT NULL ,
	`checkbox_values` TEXT NULL ,
	`is_required` TINYINT( 2 ) UNSIGNED NOT NULL DEFAULT \'0\',
	`users_can_view` TINYINT( 2 ) UNSIGNED NOT NULL DEFAULT \'1\',
	`view_in_profile` TINYINT( 2 ) UNSIGNED NOT NULL DEFAULT \'1\',
	`profile_location` TINYINT( 2 ) UNSIGNED NOT NULL DEFAULT \'2\',
	`view_in_memberlist` TINYINT( 2 ) UNSIGNED NOT NULL DEFAULT \'0\',
	`view_in_topic` TINYINT( 2 ) UNSIGNED NOT NULL DEFAULT \'0\',
	`topic_location` TINYINT( 2 ) UNSIGNED NOT NULL DEFAULT \'1\',
	PRIMARY KEY (field_id),
	INDEX ( `field_type` ) ,
	UNIQUE (`field_name`)) TYPE=MyISAM',	
'INSERT INTO '.$table_prefix.'plus (config_name, config_value) VALUES ("enable_fulltextsearch", "0")',	

'CREATE TABLE `'.$table_prefix.'captcha_config` (
  `config_name` varchar(255) NOT NULL default "",
  `config_value` varchar(100) NOT NULL default "",
  PRIMARY KEY  (`config_name`)
) TYPE=MyISAM',

'INSERT INTO `'.$table_prefix.'captcha_config` VALUES (\'width\', \'320\')',
'INSERT INTO `'.$table_prefix.'captcha_config` VALUES (\'height\', \'60\')',
'INSERT INTO `'.$table_prefix.'captcha_config` VALUES (\'background_color\', \'#E5ECF9\')',
'INSERT INTO `'.$table_prefix.'captcha_config` VALUES (\'jpeg\', \'0\')',
'INSERT INTO `'.$table_prefix.'captcha_config` VALUES (\'jpeg_quality\', \'50\')',
'INSERT INTO `'.$table_prefix.'captcha_config` VALUES (\'pre_letters\', \'0\')',
'INSERT INTO `'.$table_prefix.'captcha_config` VALUES (\'pre_letters_great\', \'0\')',
'INSERT INTO `'.$table_prefix.'captcha_config` VALUES (\'font\', \'0\')',
'INSERT INTO `'.$table_prefix.'captcha_config` VALUES (\'chess\', \'0\')',
'INSERT INTO `'.$table_prefix.'captcha_config` VALUES (\'ellipses\', \'1\')',
'INSERT INTO `'.$table_prefix.'captcha_config` VALUES (\'arcs\', \'0\')',
'INSERT INTO `'.$table_prefix.'captcha_config` VALUES (\'lines\', \'1\')',
'INSERT INTO `'.$table_prefix.'captcha_config` VALUES (\'image\', \'0\')',
'INSERT INTO `'.$table_prefix.'captcha_config` VALUES (\'gammacorrect\', \'0.8\')',
'INSERT INTO `'.$table_prefix.'captcha_config` VALUES (\'foreground_lattice_x\', \'15\')',
'INSERT INTO `'.$table_prefix.'captcha_config` VALUES (\'foreground_lattice_y\', \'15\')',
'INSERT INTO `'.$table_prefix.'captcha_config` VALUES (\'lattice_color\', \'#FFFFFF\')',

);

$mods = array ( 
'Updating phpBB2 Version','Updating phpBB2 Plus Version','Insert Shorturl Option','Insert SID Option','Adding Option for Antirobotic Mod','Adding Banner Mod Option','Adding Visual Guestconfirmation',
'Updating Album Mod Version','Adding Tables for Album Categories Hierarchie Mod','Adding Tables for Album Categories Hierarchie Mod','Adding Tables for Album Categories Hierarchie Mod','Adding Tables for Album Categories Hierarchie Mod','Adding Tables for Album Categories Hierarchie Mod','Adding Tables for Album Categories Hierarchie Mod','Adding Tables for Album Categories Hierarchie Mod','Adding Tables for Album Categories Hierarchie Mod','Adding Tables for Album Categories Hierarchie Mod','Adding Tables for Album Categories Hierarchie Mod','Adding Tables for Album Categories Hierarchie Mod','Adding Tables for Album Categories Hierarchie Mod','Adding Tables for Album Categories Hierarchie Mod','Adding Tables for Album Categories Hierarchie Mod','Adding Tables for Album Categories Hierarchie Mod','Adding Tables for Album Categories Hierarchie Mod','Adding Tables for Album Categories Hierarchie Mod',
'Installing Knowledge-Base Mod','Installing Knowledge-Base Mod','Installing Knowledge-Base Mod','Installing Knowledge-Base Mod','Installing Knowledge-Base Mod','Installing Knowledge-Base Mod','Installing Knowledge-Base Mod','Installing Knowledge-Base Mod','Installing Knowledge-Base Mod','Installing Knowledge-Base Mod','Installing Knowledge-Base Mod','Installing Knowledge-Base Mod','Installing Knowledge-Base Mod','Installing Knowledge-Base Mod','Installing Knowledge-Base Mod','Installing Knowledge-Base Mod','Installing Knowledge-Base Mod','Installing Knowledge-Base Mod','Installing Knowledge-Base Mod','Installing Knowledge-Base Mod','Installing Knowledge-Base Mod',
'Installing Knowledge-Base Mod','Installing Knowledge-Base Mod','Installing Knowledge-Base Mod','Installing Knowledge-Base Mod','Installing Knowledge-Base Mod','Installing Knowledge-Base Mod','Installing Knowledge-Base Mod','Installing Knowledge-Base Mod','Installing Knowledge-Base Mod','Installing Knowledge-Base Mod','Installing Knowledge-Base Mod','Installing Knowledge-Base Mod','Installing Knowledge-Base Mod','Installing Knowledge-Base Mod','Installing Knowledge-Base Mod',
'Disable Registrations Mod 1.1.0','Disable Registrations Mod 1.1.0','Adding AJAX features','Adding AJAX features','Adding AJAX features','Adding AJAX features','Adding Gentime Mod','Adding Portal Config Value',
'Custom Profile Field',
'Adding MySQL fulltextsearch option',
'Advanced Visual Confirmation','Advanced Visual Confirmation','Advanced Visual Confirmation','Advanced Visual Confirmation','Advanced Visual Confirmation','Advanced Visual Confirmation','Advanced Visual Confirmation','Advanced Visual Confirmation','Advanced Visual Confirmation','Advanced Visual Confirmation','Advanced Visual Confirmation','Advanced Visual Confirmation','Advanced Visual Confirmation','Advanced Visual Confirmation','Advanced Visual Confirmation','Advanced Visual Confirmation','Advanced Visual Confirmation','Advanced Visual Confirmation',
);

if(!$ctracker_config['version']){
	$sql[] = 'DROP TABLE '.$table_prefix.'cracktrack';
	$sql[] = 'ALTER TABLE '.$table_prefix.'users DROP ct_search';
	$sql[] = 'CREATE TABLE '.$table_prefix.'ctrack
	( name varchar(50),
	value varchar(100)) TYPE=MyISAM';
	$sql[] = 'INSERT INTO '.$table_prefix.'ctrack (name, value) VALUES ("lastreg", "0")';
	$sql[] = 'INSERT INTO '.$table_prefix.'ctrack (name, value) VALUES ("version", "'.$ct_version.'")';
	$sql[] = 'INSERT INTO '.$table_prefix.'ctrack (name, value) VALUES ("footer", "3")';
	$sql[] = 'INSERT INTO '.$table_prefix.'ctrack (name, value) VALUES ("floodlog", "100")';
	$sql[] = 'INSERT INTO '.$table_prefix.'ctrack (name, value) VALUES ("proxylog", "100")';
	$sql[] = 'INSERT INTO '.$table_prefix.'ctrack (name, value) VALUES ("filter", "1")';
	$sql[] = 'INSERT INTO '.$table_prefix.'ctrack (name, value) VALUES ("floodprot", "1")';
	$sql[] = 'INSERT INTO '.$table_prefix.'ctrack (name, value) VALUES ("maxsearch", "4")';
	$sql[] = 'INSERT INTO '.$table_prefix.'ctrack (name, value) VALUES ("searchtime", "16")';
	$sql[] = 'INSERT INTO '.$table_prefix.'ctrack (name, value) VALUES ("regblock", "1")';
	$sql[] = 'INSERT INTO '.$table_prefix.'ctrack (name, value) VALUES ("regtime", "1")';
	$sql[] = 'INSERT INTO '.$table_prefix.'ctrack (name, value) VALUES ("autoban", "1")';
	$sql[] = 'INSERT INTO '.$table_prefix.'ctrack (name, value) VALUES ("posttimespan", "200")';
	$sql[] = 'INSERT INTO '.$table_prefix.'ctrack (name, value) VALUES ("postintime", "10")';
	$sql[] = 'INSERT INTO '.$table_prefix.'ctrack (name, value) VALUES ("lastreg_ip", "000.000.000.000")';
	$sql[] = 'ALTER TABLE '.$table_prefix.'users ADD ct_searchtime INT( 10 ) NOT NULL AFTER user_newpasswd';
	$sql[] = 'ALTER TABLE '.$table_prefix.'users ADD ct_searchcount INT( 10 ) NOT NULL AFTER user_newpasswd';
	$sql[] = 'ALTER TABLE '.$table_prefix.'users ADD ct_posttime INT( 10 ) NOT NULL AFTER user_newpasswd';
	$sql[] = 'ALTER TABLE '.$table_prefix.'users ADD ct_postcount INT( 10 ) NOT NULL AFTER user_newpasswd';
	$sql[] = 'CREATE TABLE '.$table_prefix.'ct_filter
	(id mediumint(8) unsigned NOT NULL auto_increment,
	list varchar(250),
	PRIMARY KEY (`id`)) TYPE=MyISAM';
	$sql[] = 'INSERT INTO `'.$table_prefix.'ct_filter` (`id`, `list`) VALUES 
			   (1, "WebStripper"),
			   (2, "NetMechanic"),
			   (3, "CherryPicker"),
			   (4, "EmailCollector"),
			   (5, "EmailSiphon"),
			   (6, "WebBandit"),
			   (7, "EmailWolf"),
			   (8, "ExtractorPro"),
			   (9, "SiteSnagger"),
			   (10, "CheeseBot"),
			   (11, "ia_archiver/1.6"),
			   (12, "Website Quester"),
			   (13, "WebZip"),
			   (14, "moget/2.1"),
			   (15, "WebSauger"),
			   (16, "WebCopier"),
			   (17, "WWW-Collector-E"),
			   (18, "InfoNaviRobot"),
			   (19, "Harvest/1.5"),
			   (20, "Bullseye/1.0"),
			   (21, "lwp-trivial/1.34"),
			   (22, "lwp-trivial"),
			   (23, "LinkWalker"),
			   (24, "LinkextractorPro"),
			   (25, "Offline Explorer"),
			   (26, "BlowFish/1.0"),
			   (27, "WebEnhancer"),
			   (28, "TightTwatBot"),
			   (29, "LinkScan/8.1a Unix"),
			   (30, "WebDownloader"),
			   (31, "lwp-trivial/1.33"),
			   (32, "lwp-trivial/1.38"),
			   (33, "BruteForce"),
			   (34, "lwp")';
	$mods[] = 'Updating Cracker Tracker Professional';
	$mods[] = 'Updating Cracker Tracker Professional';
	$mods[] = 'Updating Cracker Tracker Professional';
	$mods[] = 'Updating Cracker Tracker Professional';
	$mods[] = 'Updating Cracker Tracker Professional';
	$mods[] = 'Updating Cracker Tracker Professional';
	$mods[] = 'Updating Cracker Tracker Professional';
	$mods[] = 'Updating Cracker Tracker Professional';
	$mods[] = 'Updating Cracker Tracker Professional';
	$mods[] = 'Updating Cracker Tracker Professional';
	$mods[] = 'Updating Cracker Tracker Professional';
	$mods[] = 'Updating Cracker Tracker Professional';
	$mods[] = 'Updating Cracker Tracker Professional';
	$mods[] = 'Updating Cracker Tracker Professional';
	$mods[] = 'Updating Cracker Tracker Professional';
	$mods[] = 'Updating Cracker Tracker Professional';
	$mods[] = 'Updating Cracker Tracker Professional';
	$mods[] = 'Updating Cracker Tracker Professional';
	$mods[] = 'Updating Cracker Tracker Professional';
	$mods[] = 'Updating Cracker Tracker Professional';
	$mods[] = 'Updating Cracker Tracker Professional';
	$mods[] = 'Updating Cracker Tracker Professional';
	$mods[] = 'Updating Cracker Tracker Professional';
	$mods[] = 'Updating Cracker Tracker Professional';
	$sql[] = 'CREATE TABLE ' . $table_prefix . 'ct_viskey (
	   confirm_id char(32) NOT NULL default \'\',
	   session_id char(32) NOT NULL default \'\',
	   code char(6) NOT NULL default \'\',
	   PRIMARY KEY  (session_id,confirm_id)) TYPE=MyISAM';
	$sql[] = 'UPDATE ' . $table_prefix . 'ctrack SET value = \''.$ct_version.'\' WHERE name = \'version\'';
	$sql[] = 'INSERT INTO ' . $table_prefix . 'ctrack (name, value) VALUES (\'mailfeature\', \'1\')';
	$sql[] = 'INSERT INTO ' . $table_prefix . 'ctrack (name, value) VALUES (\'pwreset\', \'1\')';
	$sql[] = 'INSERT INTO ' . $table_prefix . 'ctrack (name, value) VALUES (\'loginfeature\', \'1\')';
	$sql[] = 'ALTER TABLE ' . $table_prefix . 'users ADD ct_mailcount INT( 10 ) NOT NULL AFTER user_newpasswd';
	$sql[] = 'ALTER TABLE ' . $table_prefix . 'users ADD ct_pwreset INT( 2 ) NOT NULL AFTER user_newpasswd';
	$sql[] = 'ALTER TABLE ' . $table_prefix . 'users ADD ct_unsucclogin INT( 10 ) DEFAULT NULL AFTER user_newpasswd';
	$sql[] = 'ALTER TABLE ' . $table_prefix . 'users ADD ct_logintry INT( 2 ) DEFAULT 0 AFTER user_newpasswd';
	$mods[] = 'Updating Cracker Tracker Professional';
	$mods[] = 'Updating Cracker Tracker Professional';
	$mods[] = 'Updating Cracker Tracker Professional';
	$mods[] = 'Updating Cracker Tracker Professional';
	$mods[] = 'Updating Cracker Tracker Professional';
	$mods[] = 'Updating Cracker Tracker Professional';
	$mods[] = 'Updating Cracker Tracker Professional';
	$mods[] = 'Updating Cracker Tracker Professional';
	$mods[] = 'Updating Cracker Tracker Professional';
	$sql[] = 'UPDATE ' . $table_prefix . 'ctrack SET value = \''.$ct_version.'\' WHERE name = \'version\'';
	$sql[] = 'ALTER TABLE ' . $table_prefix . 'users ADD ct_logintry INT( 2 ) DEFAULT 0 AFTER user_newpasswd';
	$mods[] = 'Updating Cracker Tracker Professional';
	$mods[] = 'Updating Cracker Tracker Professional';
}

############################################### Do not change anything below this line #######################################

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_INDEX);
init_userprefs($userdata);
//
// End session management
function page_output($text)
{
	global $phpEx, $lang, $db;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $lang['ENCODING']; ?>">
<meta http-equiv="Content-Style-Type" content="text/css">
<title><?php echo $lang['Welcome_install'];?></title>
<link rel="stylesheet" href="./fissh/fisubsilversh.css" type="text/css">
<style type="text/css">
</style>
</head>
<body bgcolor="#E5E5E5" text="#000000" link="#006699" vlink="#5584AA">
<table class="topbkg" width="100%" cellspacing="0" cellpadding="0" border="0">
<tr> 
<td><img src="./fissh/phpbb2_logo.jpg" border="0" width="240" height="110" /></td>
<td><span class="maintitle">Result of the SQL Queries needed for the Update phpBB2 Plus 1.52 to 1.53latest<img src="./fissh/spacer.gif" alt="" width="28" height="4" /></span></td>
<td align="right"><img src="./fissh/phpbb2_logor.jpg" border="0" width="140" height="110" /></td>
</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="10" align="center"> 
	<tr>
		<td class="bodyline" width="100%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
			
			<tr>
				<td><br /><br /></td>
			</tr>
			<tr>
				<td colspan="2">
				<table width="90%" border="0" align="center" cellspacing="0" cellpadding="0">
					<tr>
						<td><span class="gen"><?php echo $text; ?></span></td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td><br /><br /></td>
			</tr>
		</table></td>
	</tr>
</table>

</body>
</html>
<?php

$db->sql_close();
exit;
}
//
//---------------------------------------------
//
if (!isset($_POST['run']))
{
	if ($phpbb_root_path == './../')
		if (file_exists("./index.$phpEx"))
			redirect(append_sid("update/index.$phpEx", true));

	 page_output("Error: upload complete update/-directory"); 
}

if ( !preg_match('(52)', $plus_config['plus_version']) )
      page_output("Error: no Plus 1.52"); 
//
//---------------------------------------------
//
$current_version = explode('.', '2' . $board_config['version']);
$new_version = explode('.', '2' . $forum_version);

if ( ((int) $current_version[2]) < ((int) $new_version[2]) )
      page_output("Please run update_to_latest.php first to update Forum"); 
//
//---------------------------------------------
//
$current_a_version = explode('.', $attach_config['attach_version']);
$new_a_version = explode('.', $attach_version);

if ( ((int) $current_a_version[1].(int) $current_a_version[2]) < ((int) $new_a_version[1].(int) $new_a_version[2]) )
      page_output("Please run update_<b>attach</b>_to_latest.php first to update Attachment Mod"); 
//
//---------------------------------------------
//
if ($userdata['user_level']!=ADMIN)
      page_output("You are not Authorised to do this, log in as Administrator and try again"); 

$n=0;
$message="<br/>";
while($sql[$n])
{
	$message .= ($mods[$n-1] != $mods[$n]) ? '<h3>'.$mods[$n].'</h3>' : '';
	if(!$result = $db->sql_query($sql[$n])) 
	$message .= '<b><font color=#FF0000>[Already added]</font></b> line: '.($n+1).' , '.$sql[$n].'<br />';
	else $message .='<b><font color=#0000fF>[Added/Updated]</font></b> line: '.($n+1).' , '.$sql[$n].'<br />';
	$n++;
}

// migrate Album
	$link_to = '<a href="./'.append_sid("hierarchy_db_migrate.".$phpEx.'?process=yes').'" target="_blank">[  process now  ]</a>';
	$message .= '<br /><br /><h4><span style="color:#FF9900">Convert/Migrate all the personal galleries into the new Album Category Hierarchy 1.1.0 mod :: </span>'. $link_to . '<h4>';
// migrate Album

page_output($message);
?>
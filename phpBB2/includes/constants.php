<?php
/***************************************************************************
 *                               constants.php
 *                            -------------------
 *   begin                : Saturday', Feb 13', 2001
 *   copyright            : ('C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: constants.php,v 1.47.2.4 2003/06/10 00:39:51 psotfx Exp $
 *
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License', or
 *   ('at your option) any later version.
 *
 ***************************************************************************/

if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}
// Album MOD
include($phpbb_root_path . 'album_mod/album_constants.' . $phpEx);

// Debug Level
define('DEBUG', 1); // Debugging on

// advanced Captcha (GD2 with FreeType Support required)
define('ADV_CAPTCHA', true); // adv captcha on

// User Levels <- Do not change the values of USER or ADMIN
define('DELETED', -1);
define('ANONYMOUS', -1);

define('USER', 0);
define('ADMIN', 1);
define('MOD', 2);


// User related
define('USER_ACTIVATION_NONE', 0);
define('USER_ACTIVATION_SELF', 1);
define('USER_ACTIVATION_ADMIN', 2);

define('USER_AVATAR_NONE', 0);
define('USER_AVATAR_UPLOAD', 1);
define('USER_AVATAR_REMOTE', 2);
define('USER_AVATAR_GALLERY', 3);


// Group settings
define('GROUP_OPEN', 0);
define('GROUP_CLOSED', 1);
define('GROUP_HIDDEN', 2);


// Forum state
define('FORUM_UNLOCKED', 0);
define('FORUM_LOCKED', 1);


// Topic status
define('TOPIC_UNLOCKED', 0);
define('TOPIC_LOCKED', 1);
define('TOPIC_MOVED', 2);
define('TOPIC_WATCH_NOTIFIED', 1);
define('TOPIC_WATCH_UN_NOTIFIED', 0);


// Topic types
define('POST_NORMAL', 0);
define('POST_STICKY', 1);
define('POST_ANNOUNCE', 2);
define('POST_GLOBAL_ANNOUNCE', 3);
define('POST_NEWS', 4);


// SQL codes
define('BEGIN_TRANSACTION', 1);
define('END_TRANSACTION', 2);


// Error codes
define('GENERAL_MESSAGE', 200);
define('GENERAL_ERROR', 202);
define('CRITICAL_MESSAGE', 203);
define('CRITICAL_ERROR', 204);


// Private messaging
define('PRIVMSGS_READ_MAIL', 0);
define('PRIVMSGS_NEW_MAIL', 1);
define('PRIVMSGS_SENT_MAIL', 2);
define('PRIVMSGS_SAVED_IN_MAIL', 3);
define('PRIVMSGS_SAVED_OUT_MAIL', 4);
define('PRIVMSGS_UNREAD_MAIL', 5);


// URL PARAMETERS
define('POST_TOPIC_URL', 't');
define('POST_CAT_URL', 'c');
define('POST_FORUM_URL', 'f');
define('POST_USERS_URL', 'u');
define('POST_POST_URL', 'p');
define('POST_GROUPS_URL', 'g');
define('PLUS_VER_URL', 'x');

// Session parameters
define('SESSION_METHOD_COOKIE', 100);
define('SESSION_METHOD_GET', 101);


// Page numbers for session handling
define('PAGE_INDEX', 0);
define('PAGE_LOGIN', -1);
define('PAGE_SEARCH', -2);
define('PAGE_REGISTER', -3);
define('PAGE_PROFILE', -4);
define('PAGE_VIEWONLINE', -6);
define('PAGE_VIEWMEMBERS', -7);
define('PAGE_FAQ', -8);
define('PAGE_POSTING', -9);
define('PAGE_PRIVMSGS', -10);
define('PAGE_GROUPCP', -11);
define('PAGE_DOWNLOAD', -12);
define('PAGE_CARD', -13); 
define('PAGE_LINKS', -14);
define('PAGE_STAFF', -22);
define('PAGE_RECENT', -33);
define('PAGE_TOPIC_OFFSET', 5000);
// Start add - Complete banner MOD
define('PAGE_REDIRECT', -1031);
// Start add - Who viewed a topic MOD
define('PAGE_TOPIC_VIEW', -1032);
// End add - Who viewed a topic MOD
// End add - Complete banner MOD
// Start add - Fully integrated shoutbox MOD
define('PAGE_SHOUTBOX_MAX',-1035);
define('PAGE_SHOUTBOX',-1035);
// End add - Fully integrated shoutbox MOD


// Auth settings
define('AUTH_LIST_ALL', 0);
define('AUTH_ALL', 0);

define('AUTH_REG', 1);
define('AUTH_ACL', 2);
define('AUTH_MOD', 3);
define('AUTH_ADMIN', 5);

define('AUTH_VIEW', 1);
define('AUTH_READ', 2);
define('AUTH_POST', 3);
define('AUTH_REPLY', 4);
define('AUTH_EDIT', 5);
define('AUTH_DELETE', 6);
define('AUTH_ANNOUNCE', 7);
define('AUTH_STICKY', 8);
define('AUTH_POLLCREATE', 9);
define('AUTH_VOTE', 10);
define('AUTH_ATTACH', 11);
define('AUTH_GLOBAL_ANNOUNCE', 21);

// Constants for AJAX
// !!! DO NOT CHANGE THESE VALUES UNLESS YOU CHANGE THE JS-FILES AS WELL !!!
define('AJAX_OP_COMPLETED', 0);
define('AJAX_ERROR', 1);
define('AJAX_CRITICAL_ERROR', 2);
define('AJAX_POST_SUBJECT_EDITED', 3);
define('AJAX_POST_TEXT_EDITED', 4);
define('AJAX_POLL_RESULT', 5);
define('AJAX_WATCH_TOPIC', 6);
define('AJAX_LOCK_TOPIC', 7);
define('AJAX_MARK_TOPIC', 8);
define('AJAX_MARK_FORUM', 9);
define('AJAX_PM_USERNAME_FOUND', 10);
define('AJAX_PM_USERNAME_SELECT', 11);
define('AJAX_PM_USERNAME_ERROR', 12);
define('AJAX_PREVIEW', 13);

// Plus Index Style
define('PLUSLAYOUT_1', 'index_body.tpl');
define('PLUSLAYOUT_2', 'index_body_plus.tpl');
define('PLUSLAYOUT_3', 'index_body2.tpl');

// Table names
define('ACRONYMS_TABLE', $table_prefix.'acronyms');
define('AUTH_ACCESS_TABLE', $table_prefix.'auth_access');
define('ANTI_ROBOT_TABLE', $table_prefix.'anti_robotic_reg');
define('BANLIST_TABLE', $table_prefix.'banlist');
// Start add - Complete banner MOD
define('BANNER_STATS_TABLE', $table_prefix.'banner_stats');
define('BANNERS_TABLE', $table_prefix.'banner');
// End add - Complete banner MOD
define('BOOKMARK_TABLE', $table_prefix.'bookmarks');
define('CAPTCHA_CONFIG_TABLE', $table_prefix.'captcha_config');
define('CATEGORIES_TABLE', $table_prefix.'categories');
define('COLOR_GROUPS_TABLE', $table_prefix.'color_groups');
define('CONFIG_TABLE', $table_prefix.'config');
define('CONFIRM_TABLE', $table_prefix.'confirm');
// CBACK CrackerTracker Professional
define('CTRACK', $table_prefix.'ctrack');
define('CTFILTER', $table_prefix.'ct_filter');
define('CTVISKEY', $table_prefix.'ct_viskey');
// CBACK CrackerTracker Professional
define('DISALLOW_TABLE', $table_prefix.'disallow');
// FLAGHACK-start
define('FLAG_TABLE', $table_prefix.'flags');
// FLAGHACK-end
define('FORUMS_TABLE', $table_prefix.'forums');
define('GROUPS_TABLE', $table_prefix.'groups');
define('HACKS_LIST_TABLE', $table_prefix.'hacks_list');
define('JR_ADMIN_TABLE', $table_prefix.'jr_admin_users');
define('LINKS_TABLE', $table_prefix.'links');
define('LINK_CATEGORIES_TABLE', $table_prefix.'link_categories');
define('LINK_CONFIG_TABLE', $table_prefix.'link_config');
define('MODULES_TABLE', $table_prefix . 'stats_modules');
define('NEWS_TABLE', $table_prefix.'news');
define('PLUS_TABLE', $table_prefix.'plus');
define('PORTAL_TABLE', $table_prefix.'portal');
define('POSTS_TABLE', $table_prefix.'posts');
define('POSTS_TEXT_TABLE', $table_prefix.'posts_text');
define('PRIVMSGS_TABLE', $table_prefix.'privmsgs');
define('PRIVMSGS_TEXT_TABLE', $table_prefix.'privmsgs_text');
define('PRIVMSGS_IGNORE_TABLE', $table_prefix.'privmsgs_ignore');
// Custom Profile Fields MOD
define('PROFILE_FIELDS_TABLE', $table_prefix.'profile_fields');
// END Custom Profile Fields MOD
define('PRUNE_TABLE', $table_prefix.'forum_prune');
define('RANKS_TABLE', $table_prefix.'ranks');
define('SEARCH_TABLE', $table_prefix.'search_results');
define('SEARCH_WORD_TABLE', $table_prefix.'search_wordlist');
define('SEARCH_MATCH_TABLE', $table_prefix.'search_wordmatch');
define('SESSIONS_TABLE', $table_prefix.'sessions');
define('SESSIONS_KEYS_TABLE', $table_prefix.'sessions_keys');
// Start add - Fully integrated shoutbox MOD
define('SHOUTBOX_TABLE', $table_prefix.'shout');
// End add - Fully integrated shoutbox MOD
define('SMILIES_TABLE', $table_prefix.'smilies');
define('STATS_CONFIG_TABLE', $table_prefix . 'stats_config');
define('THEMES_TABLE', $table_prefix.'themes');
define('THEMES_NAME_TABLE', $table_prefix.'themes_name');
define('TOPICS_TABLE', $table_prefix.'topics');
// Start add - Who viewed a topic MOD
define('TOPIC_VIEW_TABLE', $table_prefix.'topic_view');
// End add - Who viewed a topic MOD
define('TOPICS_WATCH_TABLE', $table_prefix.'topics_watch');
define('USER_GROUP_TABLE', $table_prefix.'user_group');
define('USERS_TABLE', $table_prefix.'users');
define('WORDS_TABLE', $table_prefix.'words');
define('VOTE_DESC_TABLE', $table_prefix.'vote_desc');
define('VOTE_RESULTS_TABLE', $table_prefix.'vote_results');
define('VOTE_USERS_TABLE', $table_prefix.'vote_voters');

//added for birthday zodiac
$zodiacdates = array ('0101', '0120',
			'0121', '0219',
			'0220', '0320',
			'0321', '0420',
			'0421', '0520',
			'0521', '0621',
			'0622', '0722',
			'0723', '0823',
			'0824', '0922',
			'0923', '1022',
			'1023', '1122',
			'1123', '1221',
			'1222', '1231');
$zodiacs = array ('Capricorn','Aquarius', 'Pisces', 'Aries', 'Taurus', 'Gemini', 'Cancer', 'Leo', 'Virgo', 'Libra', 'Scorpio', 'Sagittarius','Capricorn');
//-- mod : calendar --------------------------------------------------------------------------------
//-- add
define('AUTH_CAL', 20);
define('POST_BIRTHDAY', 9);
define('POST_CALENDAR', 10);
//-- fin mod : calendar ----------------------------------------------------------------------------
//
// Custom Profile Fields MOD
//
define('TEXT_FIELD',0);
define('TEXTAREA',1);
define('RADIO',2);
define('CHECKBOX',3);
define('REQUIRED',1);
define('NOT_REQUIRED',0);
define('TEXT_FIELD_MINLENGTH',0);
define('TEXT_FIELD_MAXLENGTH',255);
define('TEXTAREA_MINLENGTH',0);
define('TEXTAREA_MAXLENGTH',1024);
define('ALLOW_VIEW',1);
define('DISALLOW_VIEW',0);
define('VIEW_IN_PROFILE',1);
define('NO_VIEW_IN_PROFILE',0);
define('VIEW_IN_MEMBERLIST',1);
define('NO_VIEW_IN_MEMBERLIST',0);
define('VIEW_IN_TOPIC',1);
define('NO_VIEW_IN_TOPIC',0);
define('CONTACTS',1);
define('ABOUT',2);
define('AUTHOR',1);
define('ABOVE_SIGNATURE',2);
define('BELOW_SIGNATURE',3);
//
// END Custom Profile Fields MOD
//

?>
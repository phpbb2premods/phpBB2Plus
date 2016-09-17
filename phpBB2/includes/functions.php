<?php
/***************************************************************************
 *                               functions.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: functions.php,v 1.133.2.31 2003/07/20 13:14:27 acydburn Exp $
 *
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 *
 ***************************************************************************/

define('STYLE_URL', 's');

if ( !defined('IN_PHPBB') )
{
   die('Hacking attempt');
}

//-- mod : post icon -------------------------------------------------------------------------------
//-- add
function get_icon_title($icon, $empty=0, $topic_type=-1, $admin=false)
{
	global $lang, $images, $phpEx, $phpbb_root_path;

	// get icons parameters
	include($phpbb_root_path . './includes/def_icons.' . $phpEx);

	// admin path
	$admin_path = ($admin) ? '../' : './';

	// alignment
	switch ($empty)
	{
		case 1:
			$align= 'middle';
			break;
		case 2:
			$align= 'bottom';
			break;
		default:
			$align = 'absbottom';
			break;
	}

	// find the icon
	$found = false;
	$icon_map = -1;
	for ($i=0; ($i < count($icones)) && !$found; $i++)
	{
		if ($icones[$i]['ind'] == $icon)
		{
			$found = true;
			$icon_map = $i;
		}
	}

	// icon not found : try a default value
	if (!$found || ($found && empty($icones[$icon_map]['img'])))
	{
		$change = true;
		switch($topic_type)
		{
			case POST_NORMAL:
				$icon = $icon_defined_special['POST_NORMAL']['icon'];
				break;
			case POST_STICKY:
				$icon = $icon_defined_special['POST_STICKY']['icon'];
				break;
			case POST_ANNOUNCE:
				$icon = $icon_defined_special['POST_ANNOUNCE']['icon'];
				break;
			case POST_GLOBAL_ANNOUNCE:
				$icon = $icon_defined_special['POST_GLOBAL_ANNOUNCE']['icon'];
				break;
			case POST_BIRTHDAY:
				$icon = $icon_defined_special['POST_BIRTHDAY']['icon'];
				break;
			case POST_CALENDAR:
				$icon = $icon_defined_special['POST_CALENDAR']['icon'];
				break;
			case POST_PICTURE:
				$icon = $icon_defined_special['POST_PICTURE']['icon'];
				break;
			case POST_ATTACHMENT:
				$icon = $icon_defined_special['POST_ATTACHEMENT']['icon'];
				break;
			default:
				$change=false;
				break;
		}

		// a default icon has been sat
		if ($change)
		{
			// find the icon
			$found = false;
			$icon_map = -1;
			for ($i=0; ($i < count($icones)) && !$found; $i++)
			{
				if ($icones[$i]['ind'] == $icon)
				{
					$found = true;
					$icon_map = $i;
				}
			}
		}
	}

	// build the icon image
	if (!$found || ($found && empty($icones[$icon_map]['img'])))
	{
		switch ($empty)
		{
			case 0:
				$res = '';
				break;
			case 1:
				$res = '<img width="20" align="' . $align . '" src="' . $admin_path . $images['spacer'] . '" alt="" border="0">';
				break;
			case 2:
				$res = isset($lang[ $icones[$icon_map]['alt'] ]) ? $lang[ $icones[$icon_map]['alt'] ] : $icones[$icon_map]['alt'];
				break;
		}
	}
	else
	{
		$res = '<img align="' . $align . '" src="' . ( isset($images[ $icones[$icon_map]['img'] ]) ? $admin_path . $images[ $icones[$icon_map]['img'] ] : $admin_path . $icones[$icon_map]['img'] ) . '" alt="' . ( isset($lang[ $icones[$icon_map]['alt'] ]) ? $lang[ $icones[$icon_map]['alt'] ] : $icones[$icon_map]['alt'] ) . '" border="0">';
	}

	return $res;
}
//-- fin mod : post icon ---------------------------------------------------------------------------

function get_db_stat($mode)
{
	global $db;

	switch( $mode )
	{
		case 'usercount':
			$sql = "SELECT COUNT(user_id) AS total
				FROM " . USERS_TABLE . "
				WHERE user_id <> " . ANONYMOUS;
			break;

		case 'newestuser':
			$sql = "SELECT user_id, username
				FROM " . USERS_TABLE . "
				WHERE user_id <> " . ANONYMOUS . "
				ORDER BY user_id DESC
				LIMIT 1";
			break;

		case 'postcount':
		case 'topiccount':
			$sql = "SELECT SUM(forum_topics) AS topic_total, SUM(forum_posts) AS post_total
				FROM " . FORUMS_TABLE;
			break;
	}

	if ( !($result = $db->sql_query($sql)) )
	{
		return false;
	}

	$row = $db->sql_fetchrow($result);

	switch ( $mode )
	{
		case 'usercount':
			return $row['total'];
			break;
		case 'newestuser':
			return $row;
			break;
		case 'postcount':
			return $row['post_total'];
			break;
		case 'topiccount':
			return $row['topic_total'];
			break;
	}

	return false;
}
// added at phpBB 2.0.11 to properly format the username
function phpbb_clean_username($username)
{
	$username = substr(htmlspecialchars(str_replace("\'", "'", trim($username))), 0, 25);
	$username = phpbb_rtrim($username, "\\");
	$username = str_replace("'", "\'", $username);

	return $username;
}

/**
* This function is a wrapper for ltrim, as charlist is only supported in php >= 4.1.0
* Added in phpBB 2.0.18
*/
function phpbb_ltrim($str, $charlist = false)
{
	if ($charlist === false)
	{
		return ltrim($str);
	}
	
	$php_version = explode('.', PHP_VERSION);

	// php version < 4.1.0
	if ((int) $php_version[0] < 4 || ((int) $php_version[0] == 4 && (int) $php_version[1] < 1))
	{
		while ($str{0} == $charlist)
		{
			$str = substr($str, 1);
		}
	}
	else
	{
		$str = ltrim($str, $charlist);
	}

	return $str;
}

/**
* Our own generator of random values
* This uses a constantly changing value as the base for generating the values
* The board wide setting is updated once per page if this code is called
* With thanks to Anthrax101 for the inspiration on this one
* Added in phpBB 2.0.20
*/
function dss_rand()
{
	global $db, $board_config, $dss_seeded;

	$val = $board_config['rand_seed'] . microtime();
	$val = md5($val);
	$board_config['rand_seed'] = md5($board_config['rand_seed'] . $val . 'a');
   
	if($dss_seeded !== true)
	{
		$sql = "UPDATE " . CONFIG_TABLE . " SET
			config_value = '" . $board_config['rand_seed'] . "'
			WHERE config_name = 'rand_seed'";
		
		if( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, "Unable to reseed PRNG", "", __LINE__, __FILE__, $sql);
		}

		$dss_seeded = true;
	}

	return substr($val, 4, 16);
}

// added at phpBB 2.0.12 to fix a bug in PHP 4.3.10 (only supporting charlist in php >= 4.1.0)
function phpbb_rtrim($str, $charlist = false)
{
	if ($charlist === false)
	{
		return rtrim($str);
	}
	
	$php_version = explode('.', PHP_VERSION);

	// php version < 4.1.0
	if ((int) $php_version[0] < 4 || ((int) $php_version[0] == 4 && (int) $php_version[1] < 1))
	{
		while ($str{strlen($str)-1} == $charlist)
		{
			$str = substr($str, 0, strlen($str)-1);
		}
	}
	else
	{
		$str = rtrim($str, $charlist);
	}

	return $str;
} 

//
// Get Userdata, $user can be username or user_id. If force_str is true, the username will be forced.
//
function get_userdata($user, $force_str = false)
{
	global $db;

	if (!is_numeric($user) || $force_str)
	{
		$user = phpbb_clean_username($user);
	}
	else
	{
		$user = intval($user);
	}

	$sql = "SELECT *
		FROM " . USERS_TABLE . " 
		WHERE ";
	$sql .= ( ( is_integer($user) ) ? "user_id = $user" : "username = '" .  str_replace("\'", "''", $user) . "'" ) . " AND user_id <> " . ANONYMOUS;
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Tried obtaining data for a non-existent user', '', __LINE__, __FILE__, $sql);
	}

	return ( $row = $db->sql_fetchrow($result) ) ? $row : false;
}

function make_jumpbox($action, $match_forum_id = 0)
{
	global $template, $userdata, $lang, $db, $nav_links, $phpEx, $SID;
//-- mod : categories hierarchy --------------------------------------------------------------------
//-- add
	return jumpbox($action, $match_forum_id);
//-- fin mod : categories hierarchy ----------------------------------------------------------------

//	$is_auth = auth(AUTH_VIEW, AUTH_LIST_ALL, $userdata);

	$sql = "SELECT c.cat_id, c.cat_title, c.cat_order
		FROM " . CATEGORIES_TABLE . " c, " . FORUMS_TABLE . " f
		WHERE f.cat_id = c.cat_id
		GROUP BY c.cat_id, c.cat_title, c.cat_order
		ORDER BY c.cat_order";
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, "Couldn't obtain category list.", "", __LINE__, __FILE__, $sql);
	}
	
	$category_rows = array();
	while ( $row = $db->sql_fetchrow($result) )
	{
		$category_rows[] = $row;
	}

	if ( $total_categories = count($category_rows) )
	{
		$sql = "SELECT *
			FROM " . FORUMS_TABLE . "
			ORDER BY cat_id, forum_order";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not obtain forums information', '', __LINE__, __FILE__, $sql);
		}

		$boxstring = '<select name="' . POST_FORUM_URL . '" onchange="if(this.options[this.selectedIndex].value != -1){ forms[\'jumpbox\'].submit() }"><option value="-1">' . $lang['Select_forum'] . '</option>';

		$forum_rows = array();
		while ( $row = $db->sql_fetchrow($result) )
		{
			$forum_rows[] = $row;
		}

		if ( $total_forums = count($forum_rows) )
		{
			for($i = 0; $i < $total_categories; $i++)
			{
				$boxstring_forums = '';
				for($j = 0; $j < $total_forums; $j++)
				{
					if ( $forum_rows[$j]['cat_id'] == $category_rows[$i]['cat_id'] && $forum_rows[$j]['auth_view'] <= AUTH_REG )
					{

//					if ( $forum_rows[$j]['cat_id'] == $category_rows[$i]['cat_id'] && $is_auth[$forum_rows[$j]['forum_id']]['auth_view'] )
//					{
						$selected = ( $forum_rows[$j]['forum_id'] == $match_forum_id ) ? 'selected="selected"' : '';
						$boxstring_forums .=  '<option value="' . $forum_rows[$j]['forum_id'] . '"' . $selected . '>' . $forum_rows[$j]['forum_name'] . '</option>';

						//
						// Add an array to $nav_links for the Mozilla navigation bar.
						// 'chapter' and 'forum' can create multiple items, therefore we are using a nested array.
						//
						$nav_links['chapter forum'][$forum_rows[$j]['forum_id']] = array (
							'url' => append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=" . $forum_rows[$j]['forum_id']),
							'title' => $forum_rows[$j]['forum_name']
						);
								
					}
				}

				if ( $boxstring_forums != '' )
				{
					$boxstring .= '<option value="-1">&nbsp;</option>';
					$boxstring .= '<option value="-1">' . $category_rows[$i]['cat_title'] . '</option>';
					$boxstring .= '<option value="-1">----------------</option>';
					$boxstring .= $boxstring_forums;
				}
			}
		}

		$boxstring .= '</select>';
	}
	else
	{
		$boxstring .= '<select name="' . POST_FORUM_URL . '" onchange="if(this.options[this.selectedIndex].value != -1){ forms[\'jumpbox\'].submit() }"></select>';
	}
	// Let the jumpbox work again in sites having additional session id checks.
	//if ( !empty($SID) )
	//{
		$boxstring .= '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" />';
	//}

	$template->set_filenames(array(
		'jumpbox' => 'jumpbox.tpl')
	);
	$template->assign_vars(array(
		'L_GO' => $lang['Go'],
		'L_JUMP_TO' => $lang['Jump_to'],
		'L_SELECT_FORUM' => $lang['Select_forum'],

		'S_JUMPBOX_SELECT' => $boxstring,
		'S_JUMPBOX_ACTION' => append_sid($action))
	);
	$template->assign_var_from_handle('JUMPBOX', 'jumpbox');

	return;
}

//
// Initialise user settings on page load
function init_userprefs($userdata)
{
	global $board_config, $theme, $images;
	global $template, $lang, $phpEx, $phpbb_root_path, $db;
	global $nav_links;
	//-- mod : mods settings ---------------------------------------------------------------------------
//-- add
	global $mods, $list_yes_no, $userdata;

	//	get all the mods settings
	$dir = @opendir($phpbb_root_path . 'includes/mods_settings');
	while( $file = @readdir($dir) )
	{
		if( preg_match("/^mod_.*?\." . $phpEx . "$/", $file) )
		{
			include_once($phpbb_root_path . 'includes/mods_settings/' . $file);
		}
	}
	@closedir($dir);
//-- fin mod : mods settings -----------------------------------------------------------------------

	if ( $userdata['user_id'] != ANONYMOUS )
	{
		if ( !empty($userdata['user_lang']))
		{
			$default_lang = phpbb_ltrim(basename(phpbb_rtrim($userdata['user_lang'])), "'");
		}

		if ( !empty($userdata['user_dateformat']) )
		{
			$board_config['default_dateformat'] = $userdata['user_dateformat'];
		}

		if ( isset($userdata['user_timezone']) )
		{
			$board_config['board_timezone'] = $userdata['user_timezone'];
		}
	}
	else
	{
		$default_lang = phpbb_ltrim(basename(phpbb_rtrim($board_config['default_lang'])), "'");
	}

	if ( !file_exists(@phpbb_realpath($phpbb_root_path . 'language/lang_' . $default_lang . '/lang_main.'.$phpEx)) )
	{
		if ( $userdata['user_id'] != ANONYMOUS )
		{
			// For logged in users, try the board default language next
			$default_lang = phpbb_ltrim(basename(phpbb_rtrim($board_config['default_lang'])), "'");
		}
		else
		{
			// For guests it means the default language is not present, try english
			// This is a long shot since it means serious errors in the setup to reach here,
			// but english is part of a new install so it's worth us trying
			$default_lang = 'english';
		}

		if ( !file_exists(@phpbb_realpath($phpbb_root_path . 'language/lang_' . $default_lang . '/lang_main.'.$phpEx)) )
		{
			message_die(CRITICAL_ERROR, 'Could not locate valid language pack');
		}
	}

	// If we've had to change the value in any way then let's write it back to the database
	// before we go any further since it means there is something wrong with it
	if ( $userdata['user_id'] != ANONYMOUS && $userdata['user_lang'] !== $default_lang )
	{
		$sql = 'UPDATE ' . USERS_TABLE . "
			SET user_lang = '" . $default_lang . "'
			WHERE user_lang = '" . $userdata['user_lang'] . "'";

		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(CRITICAL_ERROR, 'Could not update user language info');
		}

		$userdata['user_lang'] = $default_lang;
	}
	elseif ( $userdata['user_id'] === ANONYMOUS && $board_config['default_lang'] !== $default_lang )
	{
		$sql = 'UPDATE ' . CONFIG_TABLE . "
			SET config_value = '" . $default_lang . "'
			WHERE config_name = 'default_lang'";

		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(CRITICAL_ERROR, 'Could not update user language info');
		}
	}

	$board_config['default_lang'] = $default_lang;

	include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_main.' . $phpEx);
	include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_ctracker.' . $phpEx);
	include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_news.' . $phpEx);
	if ( defined('IN_ADMIN') )
	{
		if( !file_exists(@phpbb_realpath($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_admin.'.$phpEx)) )
		{
			$board_config['default_lang'] = 'english';
		}

		include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_admin.' . $phpEx);
		include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_admin_captcha.' . $phpEx);
	}
	//-- mod : categories hierarchy --------------------------------------------------------------------
//-- add
	global $tree;
	if (empty($tree['auth'])) get_user_tree($userdata);
//-- fin mod : categories hierarchy ----------------------------------------------------------------
//-- mod : language settings -----------------------------------------------------------------------
//-- add
	include($phpbb_root_path . './includes/lang_extend_mac.' . $phpEx);
//-- fin mod : language settings -------------------------------------------------------------------
	include_attach_lang();
	//
	// Mozilla navigation bar
	// Default items that should be valid on all pages.
	// Defined here to correctly assign the Language Variables
	// and be able to change the variables within code.
	//
	$nav_links['top'] = array ( 
		'url' => append_sid($phpbb_root_path . 'index.' . $phpEx),
		'title' => sprintf($lang['Forum_Index'], $board_config['sitename'])
	);
	$nav_links['search'] = array ( 
		'url' => append_sid($phpbb_root_path . 'search.' . $phpEx),
		'title' => $lang['Search']
	);
	$nav_links['help'] = array ( 
		'url' => append_sid($phpbb_root_path . 'faq.' . $phpEx),
		'title' => $lang['FAQ']
	);
	$nav_links['author'] = array ( 
		'url' => append_sid($phpbb_root_path . 'memberlist.' . $phpEx),
		'title' => $lang['Memberlist']
	);
	//
	// Add bookmarks to Navigation bar
	//
	if ($userdata['session_logged_in'] && $board_config['max_link_bookmarks'] > 0)
	{
		$auth_sql = '';
		$is_auth_ary = auth(AUTH_READ, AUTH_LIST_ALL, $userdata); 

		$ignore_forum_sql = '';
		while( list($key, $value) = each($is_auth_ary) )
		{
			if ( !$value['auth_read'] )
			{
				$ignore_forum_sql .= ( ( $ignore_forum_sql != '' ) ? ', ' : '' ) . $key;
			}
		}

		if ( $ignore_forum_sql != '' )
		{
			$auth_sql .= ( $auth_sql != '' ) ? " AND f.forum_id NOT IN ($ignore_forum_sql) " : "f.forum_id NOT IN ($ignore_forum_sql) ";
		}
		if ( $auth_sql != '' )
		{
			$sql = "SELECT t.topic_id, t.topic_title, f.forum_id
				FROM " . TOPICS_TABLE . "  t, " . BOOKMARK_TABLE . " b, " . FORUMS_TABLE . " f, " . POSTS_TABLE . " p
				WHERE t.topic_id = b.topic_id
					AND t.forum_id = f.forum_id
					AND t.topic_last_post_id = p.post_id
					AND b.user_id = " . $userdata['user_id'] . "
					AND $auth_sql
				ORDER BY p.post_time DESC
				LIMIT " . (intval($board_config['max_link_bookmarks']) + 1);
		}
		else
		{
			$sql = "SELECT t.topic_id, t.topic_title
				FROM " . TOPICS_TABLE . " t, " . BOOKMARK_TABLE . " b, " . POSTS_TABLE . " p
				WHERE t.topic_id = b.topic_id
					AND t.topic_last_post_id = p.post_id
					AND b.user_id = " . $userdata['user_id'] . "
				ORDER BY p.post_time DESC
				LIMIT " . (intval($board_config['max_link_bookmarks']) + 1);
		}
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not obtain post ids', '', __LINE__, __FILE__, $sql);
		}
		$post_rows = array();
		while ( $row = $db->sql_fetchrow($result) )
		{
			$post_rows[] = $row;
		}
		$db->sql_freeresult($result);

		if ( $total_posts = count($post_rows) )
		{
			//
			// Define censored word matches
			//
			$orig_word = array();
			$replacement_word = array();
			obtain_word_list($orig_word, $replacement_word);

			for($i = 0; $i < min($total_posts, $board_config['max_link_bookmarks']); $i++)
			{
				$topic_title = ( count($orig_word) ) ? preg_replace($orig_word, $replacement_word, $post_rows[$i]['topic_title']) : $post_rows[$i]['topic_title'];
				//
				// Add an array to $nav_links for the Mozilla navigation bar.
				// 'bookmarks' can create multiple items, therefore we are using a nested array.
				//
				$nav_links['bookmark'][$i] = array (
					'url' => append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=" . $post_rows[$i]['topic_id']),
					'title' => $topic_title
				);
			}
			if ($total_posts > $board_config['max_link_bookmarks'])
			{
				$start = intval($board_config['max_link_bookmarks'] / $board_config['topics_per_page']) * $board_config['topics_per_page'];
				$nav_links['bookmark'][$i] = array (
					'url' => append_sid("search.$phpEx?search_id=bookmarks&start=$start"),
					'title' => $lang['More_bookmarks']
				);
			}
		}
	}

	//
	// Set up style
	//
	if ( !$board_config['override_user_style'] )
	{
		if ( $userdata['user_id'] != ANONYMOUS && $userdata['user_style'] > 0 )
		{
			if ( $theme = setup_style($userdata['user_style']) )
			{
				return;
			}
		}
	}

	$theme = setup_style($board_config['default_style']);

	return;
}

function setup_style($style)
{
	global $db, $board_config, $template, $images, $phpbb_root_path;
	//-- mod : categories hierarchy --------------------------------------------------------------------
//-- add
	global $phpEx, $themes_style;

	if ( defined('CACHE_THEMES') )
	{
		include( $phpbb_root_path . './includes/def_themes.' . $phpEx );
		if ( empty($themes_style) )
		{
			cache_themes();
			@include( $phpbb_root_path . './includes/def_themes.' . $phpEx );
		}
	}
	if ( !empty($themes_style[$style]) )
	{
		$row = $themes_style[$style];
	}
	else
	{
//-- fin mod : categories hierarchy ----------------------------------------------------------------

	$sql = 'SELECT *
		FROM ' . THEMES_TABLE . '
		WHERE themes_id = ' . (int) $style;
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(CRITICAL_ERROR, 'Could not query database for theme info');
	}

	if ( !($row = $db->sql_fetchrow($result)) )
	{
		// We are trying to setup a style which does not exist in the database
		// Try to fallback to the board default (if the user had a custom style)
		// and then any users using this style to the default if it succeeds
		if ( $style != $board_config['default_style'])
		{
			$sql = 'SELECT *
				FROM ' . THEMES_TABLE . '
				WHERE themes_id = ' . (int) $board_config['default_style'];
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(CRITICAL_ERROR, 'Could not query database for theme info');
			}

			if ( $row = $db->sql_fetchrow($result) )
			{
				$db->sql_freeresult($result);

				$sql = 'UPDATE ' . USERS_TABLE . '
					SET user_style = ' . (int) $board_config['default_style'] . "
					WHERE user_style = $style";
				if ( !($result = $db->sql_query($sql)) )
				{
					message_die(CRITICAL_ERROR, 'Could not update user theme info');
				}
			}
			else
			{
				message_die(CRITICAL_ERROR, "Could not get theme data for themes_id [$style]");
			}
		}
		else
		{
			message_die(CRITICAL_ERROR, "Could not get theme data for themes_id [$style]");
		}
	}
	//-- mod : categories hierarchy --------------------------------------------------------------------
//-- add
	}
//-- fin mod : categories hierarchy ----------------------------------------------------------------

	$template_path = 'templates/' ;
	$template_name = $row['template_name'] ;

	$template = new Template($phpbb_root_path . $template_path . $template_name);

	if ( $template )
	{
		$current_template_path = $template_path . $template_name;
		@include($phpbb_root_path . $template_path . $template_name . '/' . $template_name . '.cfg');

		if ( !defined('TEMPLATE_CONFIG') )
		{
			message_die(CRITICAL_ERROR, "Could not open $template_name template config file", '', __LINE__, __FILE__);
		}

		$img_lang = ( file_exists(@phpbb_realpath($phpbb_root_path . $current_template_path . '/images/lang_' . $board_config['default_lang'])) ) ? $board_config['default_lang'] : 'english';

		while( list($key, $value) = @each($images) )
		{
			if ( !is_array($value) )
			{
				$images[$key] = str_replace('{LANG}', 'lang_' . $img_lang, $value);
			}
		}
	}

	return $row;
}

function encode_ip($dotquad_ip)
{
	$ip_sep = explode('.', $dotquad_ip);
	return sprintf('%02x%02x%02x%02x', $ip_sep[0], $ip_sep[1], $ip_sep[2], $ip_sep[3]);
}

function decode_ip($int_ip)
{
	$hexipbang = explode('.', chunk_split($int_ip, 2, '.'));
	return hexdec($hexipbang[0]). '.' . hexdec($hexipbang[1]) . '.' . hexdec($hexipbang[2]) . '.' . hexdec($hexipbang[3]);
}

//
// Create date/time from format and timezone
//
function create_date($format, $gmepoch, $tz)
{
	global $board_config, $lang;
	static $translate;

	if ( empty($translate) && $board_config['default_lang'] != 'english' )
	{
		@reset($lang['datetime']);
		while ( list($match, $replace) = @each($lang['datetime']) )
		{
			$translate[$match] = $replace;
		}
	}

	return ( !empty($translate) ) ? strtr(@gmdate($format, $gmepoch + (3600 * ($tz+date("I")))), $translate) : @gmdate($format, $gmepoch + (3600 * ($tz+date("I"))));

}
//-- mod : today at   yesterday at ------------------------------------------------------------------------ 
//-- add 
// 
// Create date/time/day from format and timezone 
// 
function create_date_day($format, $gmepoch, $tz) 
{ 
   global $board_config, $lang; 

   $date_day = create_date($format, $gmepoch, $tz); 
    if ( $board_config['time_today'] < $gmepoch) 
    { 
       $date_day = sprintf($lang['Today_at'], create_date($board_config['default_timeformat'], $gmepoch, $tz)); 
    } 
      else if ( $board_config['time_yesterday'] < $gmepoch) 
    { 
       $date_day = sprintf($lang['Yesterday_at'], create_date($board_config['default_timeformat'], $gmepoch, $tz)); 
    } 
    
   return $date_day; 
} 
//-- end mod : today at   yesterday at ------------------------------------------------------------------------ 
//
// Pagination routine, generates
// page number sequence
//
function generate_pagination($base_url, $num_items, $per_page, $start_item, $add_prevnext_text = TRUE)
{
	global $lang;

	$total_pages = ceil($num_items/$per_page);

	if ( $total_pages == 1 )
	{
		return '';
	}

	$on_page = floor($start_item / $per_page) + 1;

	$page_string = '';
	if ( $total_pages > 10 )
	{
		$init_page_max = ( $total_pages > 3 ) ? 3 : $total_pages;

		for($i = 1; $i < $init_page_max + 1; $i++)
		{
			$page_string .= ( $i == $on_page ) ? '<b>' . $i . '</b>' : '<a href="' . append_sid($base_url . "&amp;start=" . ( ( $i - 1 ) * $per_page ) ) . '">' . $i . '</a>';
			if ( $i <  $init_page_max )
			{
				$page_string .= ", ";
			}
		}

		if ( $total_pages > 3 )
		{
			if ( $on_page > 1  && $on_page < $total_pages )
			{
				$page_string .= ( $on_page > 5 ) ? ' ... ' : ', ';

				$init_page_min = ( $on_page > 4 ) ? $on_page : 5;
				$init_page_max = ( $on_page < $total_pages - 4 ) ? $on_page : $total_pages - 4;

				for($i = $init_page_min - 1; $i < $init_page_max + 2; $i++)
				{
					$page_string .= ($i == $on_page) ? '<b>' . $i . '</b>' : '<a href="' . append_sid($base_url . "&amp;start=" . ( ( $i - 1 ) * $per_page ) ) . '">' . $i . '</a>';
					if ( $i <  $init_page_max + 1 )
					{
						$page_string .= ', ';
					}
				}

				$page_string .= ( $on_page < $total_pages - 4 ) ? ' ... ' : ', ';
			}
			else
			{
				$page_string .= ' ... ';
			}

			for($i = $total_pages - 2; $i < $total_pages + 1; $i++)
			{
				$page_string .= ( $i == $on_page ) ? '<b>' . $i . '</b>'  : '<a href="' . append_sid($base_url . "&amp;start=" . ( ( $i - 1 ) * $per_page ) ) . '">' . $i . '</a>';
				if( $i <  $total_pages )
				{
					$page_string .= ", ";
				}
			}
		}
	}
	else
	{
		for($i = 1; $i < $total_pages + 1; $i++)
		{
			$page_string .= ( $i == $on_page ) ? '<b>' . $i . '</b>' : '<a href="' . append_sid($base_url . "&amp;start=" . ( ( $i - 1 ) * $per_page ) ) . '">' . $i . '</a>';
			if ( $i <  $total_pages )
			{
				$page_string .= ', ';
			}
		}
	}

	if ( $add_prevnext_text )
	{
		if ( $on_page > 1 )
		{
			$page_string = ' <a href="' . append_sid($base_url . "&amp;start=" . ( ( $on_page - 2 ) * $per_page ) ) . '">' . $lang['Previous'] . '</a>&nbsp;&nbsp;' . $page_string;
		}

		if ( $on_page < $total_pages )
		{
			$page_string .= '&nbsp;&nbsp;<a href="' . append_sid($base_url . "&amp;start=" . ( $on_page * $per_page ) ) . '">' . $lang['Next'] . '</a>';
		}

	}

	$page_string = ($page_string != '') ? $lang['Goto_page'] . ' ' . $page_string : '';

	return $page_string;
}

//
// This does exactly what preg_quote() does in PHP 4-ish
// If you just need the 1-parameter preg_quote call, then don't bother using this.
//
function phpbb_preg_quote($str, $delimiter)
{
	$text = preg_quote($str);
	$text = str_replace($delimiter, '\\' . $delimiter, $text);
	
	return $text;
}

//
// Obtain list of naughty words and build preg style replacement arrays for use by the
// calling script, note that the vars are passed as references this just makes it easier
// to return both sets of arrays
//
function obtain_word_list(&$orig_word, &$replacement_word)
{
	global $db;
	//-- mod : categories hierarchy --------------------------------------------------------------------
//-- add
	global $global_orig_word, $global_replacement_word;

	global $phpbb_root_path, $phpEx;
	if (isset($global_orig_word))
	{
		$orig_word			= $global_orig_word;
		$replacement_word	= $global_replacement_word;
	}
	else
	{
		if ( defined('CACHE_WORDS') )
		{
			@include($phpbb_root_path . './includes/def_words.' . $phpEx);
			if ( !isset($word_replacement) )
			{
				cache_words();
				@include($phpbb_root_path . './includes/def_words.' . $phpEx);
			}
		}
		if ( isset($word_replacement) )
		{
			$orig_word = array();
			$replacement_word = array();
			@reset($word_replacement);
			while ( list($word, $replacement) = @each($word_replacement) )
			{
				$orig_word[] = '#\b(' . str_replace('\*', '\w*?', preg_quote(stripslashes($word), '#')) . ')\b#i';
				$replacement_word[] = $replacement;
			}
		}
		else
		{
//-- fin mod : categories hierarchy ----------------------------------------------------------------

	//
	// Define censored word matches
	//
	$sql = "SELECT word, replacement
		FROM  " . WORDS_TABLE;
	if( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not get censored words from database', '', __LINE__, __FILE__, $sql);
	}

	if ( $row = $db->sql_fetchrow($result) )
	{
		do 
		{
			$orig_word[] = '#\b(' . str_replace('\*', '\w*?', preg_quote($row['word'], '#')) . ')\b#i';
			$replacement_word[] = $row['replacement'];
		}
		while ( $row = $db->sql_fetchrow($result) );
	}
	//-- mod : categories hierarchy --------------------------------------------------------------------
//-- add
		}
		$global_orig_word			= $orig_word;
		$global_replacement_word	= $replacement_word;
	}
//-- fin mod : categories hierarchy ----------------------------------------------------------------

	return true;
}

//
// This is general replacement for die(), allows templated
// output in users (or default) language, etc.
//
// $msg_code can be one of these constants:
//
// GENERAL_MESSAGE : Use for any simple text message, eg. results 
// of an operation, authorisation failures, etc.
//
// GENERAL ERROR : Use for any error which occurs _AFTER_ the 
// common.php include and session code, ie. most errors in 
// pages/functions
//
// CRITICAL_MESSAGE : Used when basic config data is available but 
// a session may not exist, eg. banned users
//
// CRITICAL_ERROR : Used when config data cannot be obtained, eg
// no database connection. Should _not_ be used in 99.5% of cases
//
function message_die($msg_code, $msg_text = '', $msg_title = '', $err_line = '', $err_file = '', $sql = '')
{
	global $db, $template, $board_config, $theme, $lang, $phpEx, $phpbb_root_path, $nav_links, $gen_simple_header, $images;
	global $userdata, $user_ip, $session_length;
	global $starttime, $plus_config;
	global $HTTP_COOKIE_VARS;
	//-- mod : categories hierarchy --------------------------------------------------------------------
//-- add
	global $tree;
//-- fin mod : categories hierarchy ----------------------------------------------------------------

//+MOD: Fix message_die for multiple errors MOD
	static $msg_history;
	if( !isset($msg_history) )
	{
		$msg_history = array();
	}
	$msg_history[] = array(
		'msg_code'	=> $msg_code,
		'msg_text'	=> $msg_text,
		'msg_title'	=> $msg_title,
		'err_line'	=> $err_line,
		'err_file'	=> $err_file,
		'sql'		=> $sql
	);
//-MOD: Fix message_die for multiple errors MOD

	if(defined('HAS_DIED'))
	{
		//+MOD: Fix message_die for multiple errors MOD

		//
		// This message is printed at the end of the report.
		// Of course, you can change it to suit your own needs. ;-)
		//
		$custom_error_message = 'Please, contact the %swebmaster%s. Thank you.';
		if ( !empty($board_config) && !empty($board_config['board_email']) )
		{
			$custom_error_message = sprintf($custom_error_message, '<a href="mailto:' . $board_config['board_email'] . '">', '</a>');
		}
		else
		{
			$custom_error_message = sprintf($custom_error_message, '', '');
		}
		echo "<html>\n<body>\n<b>Critical Error!</b><br />\nmessage_die() was called multiple times.<br />&nbsp;<hr />";
		for( $i = 0; $i < count($msg_history); $i++ )
		{
			echo '<b>Error #' . ($i+1) . "</b>\n<br />\n";
			if( !empty($msg_history[$i]['msg_title']) )
			{
				echo '<b>' . $msg_history[$i]['msg_title'] . "</b>\n<br />\n";
			}
			echo $msg_history[$i]['msg_text'] . "\n<br /><br />\n";
			if( !empty($msg_history[$i]['err_line']) )
			{
				echo '<b>Line :</b> ' . $msg_history[$i]['err_line'] . '<br /><b>File :</b> ' . $msg_history[$i]['err_file'] . "</b>\n<br />\n";
			}
			if( !empty($msg_history[$i]['sql']) )
			{
				echo '<b>SQL :</b> ' . $msg_history[$i]['sql'] . "\n<br />\n";
			}
			echo "&nbsp;<hr />\n";
		}
		echo $custom_error_message . '<hr /><br clear="all">';
		die("</body>\n</html>");
//-MOD: Fix message_die for multiple errors MOD

	}
	
	define('HAS_DIED', 1);
	

	$sql_store = $sql;
	
	//
	// Get SQL error if we are debugging. Do this as soon as possible to prevent 
	// subsequent queries from overwriting the status of sql_error()
	//
	if ( DEBUG && ( $msg_code == GENERAL_ERROR || $msg_code == CRITICAL_ERROR ) )
	{
		$sql_error = $db->sql_error();

		$debug_text = '';

		if ( $sql_error['message'] != '' )
		{
			$debug_text .= '<br /><br />SQL Error : ' . $sql_error['code'] . ' ' . $sql_error['message'];
		}

		if ( $sql_store != '' )
		{
			$debug_text .= "<br /><br />$sql_store";
		}

		if ( $err_line != '' && $err_file != '' )
		{
			$debug_text .= '<br /><br />Line : ' . $err_line . '<br />File : ' . basename($err_file);
		}
	}

	if( empty($userdata) && ( $msg_code == GENERAL_MESSAGE || $msg_code == GENERAL_ERROR ) )
	{
		$userdata = session_pagestart($user_ip, PAGE_INDEX);
		init_userprefs($userdata);
	}

	//
	// If the header hasn't been output then do it
	//
	if ( !defined('HEADER_INC') && $msg_code != CRITICAL_ERROR )
	{
		if ( empty($lang) )
		{
			if ( !empty($board_config['default_lang']) )
			{
				include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_main.'.$phpEx);
			}
			else
			{
				include($phpbb_root_path . 'language/lang_english/lang_main.'.$phpEx);
			}
			//-- mod : language settings -----------------------------------------------------------------------
//-- add
			include($phpbb_root_path . './includes/lang_extend_mac.' . $phpEx);
//-- fin mod : language settings -------------------------------------------------------------------

		}

		if ( empty($template) || empty($theme) )
		{
			$theme = setup_style($board_config['default_style']);
		}

		//
		// Load the Page Header
		//
		if ( !defined('IN_ADMIN') )
		{
			include($phpbb_root_path . 'includes/page_header.'.$phpEx);
		}
		else
		{
			include($phpbb_root_path . 'admin/page_header_admin.'.$phpEx);
		}
	}

	switch($msg_code)
	{
		case GENERAL_MESSAGE:
			if ( $msg_title == '' )
			{
				$msg_title = $lang['Information'];
			}
			break;

		case CRITICAL_MESSAGE:
			if ( $msg_title == '' )
			{
				$msg_title = $lang['Critical_Information'];
			}
			break;

		case GENERAL_ERROR:
			if ( $msg_text == '' )
			{
				$msg_text = $lang['An_error_occured'];
			}

			if ( $msg_title == '' )
			{
				$msg_title = $lang['General_Error'];
			}
			break;

		case CRITICAL_ERROR:
			//
			// Critical errors mean we cannot rely on _ANY_ DB information being
			// available so we're going to dump out a simple echo'd statement
			//
			include($phpbb_root_path . 'language/lang_english/lang_main.'.$phpEx);

			if ( $msg_text == '' )
			{
				$msg_text = $lang['A_critical_error'];
			}

			if ( $msg_title == '' )
			{
				$msg_title = 'phpBB : <b>' . $lang['Critical_Error'] . '</b>';
			}
			break;
	}

	//
	// Add on DEBUG info if we've enabled debug mode and this is an error. This
	// prevents debug info being output for general messages should DEBUG be
	// set TRUE by accident (preventing confusion for the end user!)
	//
	if ( DEBUG && ( $msg_code == GENERAL_ERROR || $msg_code == CRITICAL_ERROR ) )
	{
		if ( $debug_text != '' )
		{
			$msg_text = $msg_text . '<br /><br /><b><u>DEBUG MODE</u></b>' . $debug_text;
		}
	}

	if ( $msg_code != CRITICAL_ERROR )
	{
		if ( !empty($lang[$msg_text]) )
		{
			$msg_text = $lang[$msg_text];
		}

		if ( !defined('IN_ADMIN') )
		{
			$template->set_filenames(array(
				'message_body' => 'message_body.tpl')
			);
		}
		else
		{
			$template->set_filenames(array(
				'message_body' => 'admin/admin_message_body.tpl')
			);
		}

		$template->assign_vars(array(
			'PLUS_VERSION' => $plus_config['plus_version'],
			'MESSAGE_TITLE' => $msg_title,
			'MESSAGE_TEXT' => $msg_text)
		);
		$template->pparse('message_body');

		if ( !defined('IN_ADMIN') )
		{
			include($phpbb_root_path . 'includes/page_tail.'.$phpEx);
		}
		else
		{
			include($phpbb_root_path . 'admin/page_footer_admin.'.$phpEx);
		}
	}
	else
	{
		echo "<html>\n<body>\n" . $msg_title . "\n<br /><br />\n" . $msg_text . "</body>\n</html>";
	}

	exit;
}

//
// This function is for compatibility with PHP 4.x's realpath()
// function.  In later versions of PHP, it needs to be called
// to do checks with some functions.  Older versions of PHP don't
// seem to need this, so we'll just return the original value.
// dougk_ff7 <October 5, 2002>
function phpbb_realpath($path)
{
	global $phpbb_root_path, $phpEx;

	return (!@function_exists('realpath') || !@realpath($phpbb_root_path . 'includes/functions.'.$phpEx)) ? $path : @realpath($path);
}

function redirect($url)
{
	global $db, $board_config;

	if (!empty($db))
	{
		$db->sql_close();
	}
	
	if (strstr(urldecode($url), "\n") || strstr(urldecode($url), "\r") || strstr(urldecode($url), ';url'))
	{
		message_die(GENERAL_ERROR, 'Tried to redirect to potentially insecure url.');
	}
	
	$server_protocol = ($board_config['cookie_secure']) ? 'https://' : 'http://';
	$server_name = preg_replace('#^\/?(.*?)\/?$#', '\1', trim($board_config['server_name']));
	$server_port = ($board_config['server_port'] <> 80) ? ':' . trim($board_config['server_port']) : '';
	$script_name = preg_replace('#^\/?(.*?)\/?$#', '\1', trim($board_config['script_path']));
	$script_name = ($script_name == '') ? $script_name : '/' . $script_name;
	$url = preg_replace('#^\/?(.*?)\/?$#', '/\1', trim($url));

	// Redirect via an HTML form for PITA webservers
	if (@preg_match('/Microsoft|WebSTAR|Xitami/', getenv('SERVER_SOFTWARE')))
	{
		header('Refresh: 0; URL=' . $server_protocol . $server_name . $server_port . $script_name . $url);
		echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><html><head><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><meta http-equiv="refresh" content="0; url=' . $server_protocol . $server_name . $server_port . $script_name . $url . '"><title>Redirect</title></head><body><div align="center">If your browser does not support meta redirection please click <a href="' . $server_protocol . $server_name . $server_port . $script_name . $url . '">HERE</a> to be redirected</div></body></html>';
		exit;
	}

	// Behave as per HTTP/1.1 spec for others
	header('Location: ' . $server_protocol . $server_name . $server_port . $script_name . $url);
	exit;
}
//--- Album Category Hierarchy : begin
//--- version : 1.1.0
//--- FLAG operation functions
function setFlag($flags, $flag)
{
	return $flags | $flag;
}
function clearFlag($flags, $flag)
{
	return ($flags & ~$flag);
}
function checkFlag($flags, $flag)
{
	return (($flags & $flag) == $flag) ? true : false;
}
//--- Album Category Hierarchy : end

// Add function mkrealdate for Birthday MOD
// the originate php "mktime()", does not work proberly on all OS, especially when going back in time
// before year 1970 (year 0), this function "mkrealtime()", has a mutch larger valid date range,
// from 1901 - 2099. it returns a "like" UNIX timestamp divided by 86400, so
// calculation from the originate php date and mktime is easy.
// mkrealdate, returns the number of day (with sign) from 1.1.1970.

function mkrealdate($day,$month,$birth_year)
{
	// range check months
	if ($month<1 || $month>12) return "error";
	// range check days
	switch ($month)
	{
		case 1: if ($day>31) return "error";break;
		case 2: if ($day>29) return "error";
			$epoch=$epoch+31;break;
		case 3: if ($day>31) return "error";
			$epoch=$epoch+59;break;
		case 4: if ($day>30) return "error" ;
			$epoch=$epoch+90;break;
		case 5: if ($day>31) return "error";
			$epoch=$epoch+120;break;
		case 6: if ($day>30) return "error";
			$epoch=$epoch+151;break;
		case 7: if ($day>31) return "error";
			$epoch=$epoch+181;break;
		case 8: if ($day>31) return "error";
			$epoch=$epoch+212;break;
		case 9: if ($day>30) return "error";
			$epoch=$epoch+243;break;
		case 10: if ($day>31) return "error";
			$epoch=$epoch+273;break;
		case 11: if ($day>30) return "error";
			$epoch=$epoch+304;break;
		case 12: if ($day>31) return "error";
			$epoch=$epoch+334;break;
	}
	$epoch=$epoch+$day;
	$epoch_Y=sqrt(($birth_year-1970)*($birth_year-1970));
	$leapyear=round((($epoch_Y+2) / 4)-.5);
	if (($epoch_Y+2)%4==0)
	{// curent year is leapyear
		$leapyear--;
		if ($birth_year >1970 && $month>=3) $epoch=$epoch+1;
		if ($birth_year <1970 && $month<3) $epoch=$epoch-1;
	} else if ($month==2 && $day>28) return "error";//only 28 days in feb.
	//year
	if ($birth_year>1970)
		$epoch=$epoch+$epoch_Y*365-1+$leapyear;
	else
		$epoch=$epoch-$epoch_Y*365-1-$leapyear;
	return $epoch;
}

// Add function realdate for Birthday MOD
// the originate php "date()", does not work proberly on all OS, especially when going back in time
// before year 1970 (year 0), this function "realdate()", has a mutch larger valid date range,
// from 1901 - 2099. it returns a "like" UNIX date format (only date, related letters may be used, due to the fact that
// the given date value should already be divided by 86400 - leaving no time information left)
// a input like a UNIX timestamp divided by 86400 is expected, so
// calculation from the originate php date and mktime is easy.
// e.g. realdate ("m d Y", 3) returns the string "1 3 1970"

// UNIX users should replace this function with the below code, since this should be faster
//
//function realdate($date_syntax="Ymd",$date=0) 
//{ return create_date($date_syntax,$date*86400+1,0); }

function realdate($date_syntax="Ymd",$date=0)
{
	global $lang;
	$i=2;
	if ($date>=0)
	{
	 	return create_date($date_syntax,$date*86400+1,0);
	} else
	{
		$year= -(date%1461);
		$days = $date + $year*1461;
		while ($days<0)
		{
			$year--;
			$days+=365;
			if ($i++==3)
			{
				$i=0;
				$days++;
			}
		}
	}
	$leap_year = ($i==0) ? TRUE : FALSE;
	$months_array = ($i==0) ?
		array (0,31,60,91,121,152,182,213,244,274,305,335,366) :
		array (0,31,59,90,120,151,181,212,243,273,304,334,365);
	for ($month=1;$month<12;$month++)
	{
		if ($days<$months_array[$month]) break;
	}

	$day=$days-$months_array[$month-1]+1;
	//you may gain speed performance by remove som of the below entry's if they are not needed/used
	return strtr ($date_syntax, array(
		'a' => '',
		'A' => '',
		'\\d' => 'd',
		'd' => ($day>9) ? $day : '0'.$day,
		'\\D' => 'D',
		'D' => $lang['day_short'][($date-3)%7],
		'\\F' => 'F',
		'F' => $lang['month_long'][$month-1],
		'g' => '',
		'G' => '',
		'H' => '',
		'h' => '',
		'i' => '',
		'I' => '',
		'\\j' => 'j',
		'j' => $day,
		'\\l' => 'l',
		'l' => $lang['day_long'][($date-3)%7],
		'\\L' => 'L',
		'L' => $leap_year,
		'\\m' => 'm',
		'm' => ($month>9) ? $month : '0'.$month,
		'\\M' => 'M',
		'M' => $lang['month_short'][$month-1],
		'\\n' => 'n',
		'n' => $month,
		'O' => '',
		's' => '',
		'S' => '',
		'\\t' => 't',
		't' => $months_array[$month]-$months_array[$month-1],
		'w' => '',
		'\\y' => 'y',
		'y' => ($year>29) ? $year-30 : $year+70,
		'\\Y' => 'Y',
		'Y' => $year+1970,
		'\\z' => 'z',
		'z' => $days,
		'\\W' => '',
		'W' => '') );
}
// End add - Birthday MOD
// Start add - Last visit MOD
function make_hours($base_time)
{
	global $lang;
	$base_time = intval($base_time);
	$years = floor($base_time/31536000);
	$base_time = $base_time - ($years*31536000);
	$weeks = floor($base_time/604800);
	$base_time = $base_time - ($weeks*604800);
	$days = floor($base_time/86400);
	$base_time = $base_time - ($days*86400);
	$hours = floor($base_time/3600);
	$base_time = $base_time - ($hours*3600);
	$min = floor($base_time/60);
	$sek = $base_time - ($min*60);
	if ($sek<10) $sek ='0'.$sek;
	if ($min<10) $min ='0'.$min;
	if ($hours<10) $hours ='0'.$hours;
	$result=(($years)?$years.' '.(($years==1)?$lang['Year']:$lang['Years']).', ':'').
	(($years || $weeks)?$weeks.' '.(($weeks==1)?$lang['Week']:$lang['Weeks']).', ':'').
	(($years || $weeks || $days) ? $days.' '.(($days==1)?$lang['Day']:$lang['Days']).', ':'').
	(($hours)?$hours.':':'00:').(($min)?$min.':' :'00:').$sek;
	return ($result)?$result:$lang['None'];
}
// End add - Last visit MOD
function create_absence_mode($absence_mode, &$pm_img, &$pm, &$email_img, &$email, &$username, $absent_button = 0)
{
	global $lang, $board_config, $images, $userdata;

	if ( !$userdata['user_lang'] )
	{
		$userdata['user_lang'] = $board_config['default_lang'];
	}

	$button_pos = ( $absent_button == 0 ) ? $board_config['absent_button'] : $absent_button;
	$button_pos = ( $absent_button == 2 ) ? 0 : $button_pos;
	
	switch($absence_mode)
	{
		case 1:
			$absence_img = $images['On_holidays'];
			break;

		case 2:
			$absence_img = $images['User_ill'];
			break;

		case 3:
			$absence_img = $images['Longer_absenct'];
			break;

		default:
			$absence_img = '';
	}

	$absence_img = str_replace('{LANG}', 'lang_'.$userdata['user_lang'], $absence_img);
	$absence_mode = ( $absence_img != '' ) ? '<img src='.$absence_img.' border=0 />' : '';

	$allow_send = allow_send_to_absent();

	if ( $allow_send == FALSE )
	{
		$pm_img = '';
		$pm = '';
		$email_img = ( $button_pos == 0 ) ? ' '.$absence_mode : '';
		$email = '';
	}
	else
	{
		$email_img = ' '.str_replace($images['icon_email'], $absence_img, $email_img);
	}

	if ( $username != '' )
	{
		$username = $username . (($button_pos == 1 && $allow_send == FALSE) ? '<br />'.$absence_mode : '');
	}

	return $absence_mode;
}

function allow_send_to_absent()
{
	global $userdata;
	switch ( $userdata['user_level'] )
	{
		case ADMIN:
			$allow_send = TRUE;
			break;
		case MOD:
			$allow_send = ( $board_config['mod_able_sent_absent'] == TRUE ) ? TRUE : FALSE;
			break;
		default:
			$allow_send = FALSE;
			break;
	}
	return $allow_send;
}

function check_avatar_size($avatar, $max_avatar_size, $remote = FALSE)
{
	if ( $remote && preg_match('/^(http:\/\/)?([\w\-\.]+)\:?([0-9]*)\/(.*)$/', $avatar, $url_ary) )
	{
		$port = ( !empty($url_ary[3]) ) ? $url_ary[3] : 80;

		if ( !($fsock = @fsockopen($url_ary[2], $port, $errno, $errstr, 2)) )
		{
			return $size = '';
		}
		@fclose($fsock);
	}
	
	$pic_size = @getimagesize($avatar); 
	if ( $pic_size !== FALSE )
	{
		$pic_width = $pic_size[0]; 
		$pic_height = $pic_size[1]; 

		if ( $pic_width > $max_avatar_size )
		{
			if ($pic_width > $pic_height)
			{
				$width = $max_avatar_size;
				$height = $max_avatar_size * ($pic_height/$pic_width);
			}
			else
			{
				$height = $max_avatar_size;
				$width = $max_avatar_size * ($pic_width/$pic_height);
			}

			$size = 'width="'.$width.'" height="'.$height.'"';
		}
		else
		{
			$size = '';
		}
	}
	else
	{
		$size = '';
	}

	return $size;
}

function AJAX_headers()
{
	//No caching whatsoever
	header('Content-Type: application/xml');
	header('Expires: Thu, 15 Aug 1984 13:30:00 GMT');
	header('Last-Modified: '. gmdate('D, d M Y H:i:s') .' GMT');
	header('Cache-Control: no-cache, must-revalidate');  // HTTP/1.1
	header('Pragma: no-cache');                          // HTTP/1.0
}

function AJAX_message_die($data_ar)
{
	global $template, $db;
	
	if (!headers_sent())
	{
		AJAX_headers();
	}
	
	$template->set_filenames(array(
		'ajax_result' => 'ajax_result.tpl')
	);
	
	foreach($data_ar as $key => $value)
	{
		if ($value !== '')
		{
			$value = utf8_encode(htmlspecialchars($value));
			// Get special characters in posts back ;)
			$value = preg_replace('#&amp;\#(\d{1,4});#i', '&#\1;', $value);
			
			$template->assign_block_vars('tag', array(
				'TAGNAME' => $key,
				'VALUE' => $value)
			);
		}
	}
	
	$template->pparse('ajax_result');
	
	$db->sql_close();
	exit;
}

// This function is taken from includes/bbcode.php and renamed
// We need this in special occasions
function unhtmlspecialchars($text)
{
	$text = preg_replace("/&gt;/i", ">", $text);
	$text = preg_replace("/&lt;/i", "<", $text);
	$text = preg_replace("/&quot;/i", "\"", $text);
	$text = preg_replace("/&amp;/i", "&", $text);

	return $text;
}

/**
* RFC1738 compliant replacement to PHP's rawurldecode - which actually works with unicode (using utf-8 encoding)
* @author Ronen Botzer
* @param $source [STRING]
* @return unicode safe rawurldecoded string [STRING]
* @access public
*/
function utf8_rawurldecode($source)
{
	// Strip slashes
	$source = stripslashes($source);
	
	$decodedStr = '';
	$pos = 0;
	$len = strlen ($source);
	
	while ($pos < $len)
	{
		$charAt = substr($source, $pos, 1);
		if ($charAt == '%')
		{
			$pos++;
			$charAt = substr($source, $pos, 1);
			if ($charAt == 'u')
			{
				// we got a unicode character
				$pos++;
				$unicodeHexVal = substr($source, $pos, 4);
				$unicode = hexdec($unicodeHexVal);
				$entity = "&#". $unicode .';';
				$decodedStr .= utf8_encode($entity);
				$pos += 4;
			}
			else
			{
				// we have an escaped ascii character
				$hexVal = substr ($source, $pos, 2);
				$decodedStr .= chr (hexdec ($hexVal));
				$pos += 2;
			}
		}
		else
		{
			$decodedStr .= $charAt;
			$pos++;
		}
	}

	// Add slashes before sending it back to the browser; 
	// this keeps people from trying to inject SQL with some malformed string like %2527
	return addslashes($decodedStr);
}

// Used to escape AJAX data correctly.
// functions_post.php must be included before calling this function
function ajax_htmlspecialchars($text)
{
	global $html_entities_match, $html_entities_replace;
	
	return preg_replace($html_entities_match, $html_entities_replace, $text);
}

?>
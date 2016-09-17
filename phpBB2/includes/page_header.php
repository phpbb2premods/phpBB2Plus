<?php
/***************************************************************************
 *                              page_header.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: page_header.php,v 1.106.2.22 2004/03/01 16:46:37 psotfx Exp $
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
 ***************************************************************************/

if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}

define('HEADER_INC', TRUE);

//
// gzip_compression
//
$do_gzip_compress = FALSE;
if ( $board_config['gzip_compress'] && !defined('AJAX_HEADERS') )
{
	$phpver = phpversion();

	$useragent = (isset($HTTP_SERVER_VARS['HTTP_USER_AGENT'])) ? $HTTP_SERVER_VARS['HTTP_USER_AGENT'] : getenv('HTTP_USER_AGENT'); 

	if ( $phpver >= '4.0.4pl1' && ( strstr($useragent,'compatible') || strstr($useragent,'Gecko') ) )
	{
		if ( extension_loaded('zlib') )
		{
			ob_start('ob_gzhandler');
		}
	}
	else if ( $phpver > '4.0' )
	{
		if ( strstr($HTTP_SERVER_VARS['HTTP_ACCEPT_ENCODING'], 'gzip') )
		{
			if ( extension_loaded('zlib') )
			{
				$do_gzip_compress = TRUE;
				ob_start();
				ob_implicit_flush(0);

				header('Content-Encoding: gzip');
			}
		}
	}
}
if( $userdata['session_logged_in'] ) 
{ 
	$sql = "SELECT COUNT(post_id) as total 
		FROM " . POSTS_TABLE . " 
		WHERE post_time >= " . $userdata['user_lastvisit'] . " 
		AND poster_id != " . $userdata['user_id']; 

	$result = $db->sql_query($sql); 
	if( $result ) 
	{ 
		$row = $db->sql_fetchrow($result); 
		$lang['Search_new'] = $lang['Search_new'] . " (" . $row['total'] . ")"; 
		$lang['Search_new2'] = $lang['Search_new2'] . " (" . $row['total'] . ")";
		$lang['Search_new_p'] = $lang['Search_new_p'] . " (" . $row['total'] . ")";
	}
}

//-- mod : today at   yesterday at ------------------------------------------------------------------------ 
//-- add 
// 
// PARSE DATEFORMAT TO GET TIME FORMAT 
// 
$time_reg = '([gh][[:punct:][:space:]]{1,2}[i][[:punct:][:space:]]{0,2}[a]?[[:punct:][:space:]]{0,2}[S]?)'; 
eregi($time_reg, $board_config['default_dateformat'], $regs); 
$board_config['default_timeformat'] = $regs[1]; 
unset($time_reg); 
unset($regs); 

// 
// GET THE TIME TODAY AND YESTERDAY 
// 
$today_ary = explode('|', create_date('m|d|Y', time(),$board_config['board_timezone'])); 
$board_config['time_today'] = gmmktime(0 - $board_config['board_timezone'] - $board_config['summer_time'],0,0,$today_ary[0],$today_ary[1],$today_ary[2]); 
$board_config['time_yesterday'] = $board_config['time_today'] - 86400; 
unset($today_ary); 
//-- end mod : today at   yesterday at ------------------------------------------------------------------------ 
//
// Dr DLP's Google Visit Counter MOD
//
$google_visit_counter = $board_config['google_visit_counter'];

$tmp_list = explode(".", $_SERVER['$REMOTE_ADDR']);

if ( strstr($HTTP_SERVER_VARS['HTTP_USER_AGENT'] ,'Googlebot' )) 
{ 
   $sql = "UPDATE " . CONFIG_TABLE . " 
         SET config_value = config_value+1 
         WHERE config_name = 'google_visit_counter'"; 
   if( !($result = $db->sql_query($sql)) ) 
   { 
      message_die(GENERAL_ERROR, 'Could not update google counter information', '', __LINE__, __FILE__, $sql); 
   } 

   $google_visit_counter++; 
	@unlink($phpbb_root_path . 'cache/config.'.$phpEx);
}
// ------------------------------------
//

//
// Parse and show the overall header.
//
$template->set_filenames(array(
	'overall_header' => ( empty($gen_simple_header) ) ? 'overall_header.tpl' : 'simple_header.tpl')
);

if ($plus_config['enable_shorturls'] == 1 && !defined('AJAX_HEADERS'))
{

//
// Short URL implementation
//
// start buffering
ob_start();

function replace_for_mod_rewrite(&$s) {

	global $phpbb_root_path, $phpEx;
	
	$cache_seo = $phpbb_root_path . 'cache/c_seolist.'.$phpEx;

	if (@file_exists($cache_seo))
	{
		@include($cache_seo);
	    if ( is_array($seo_list_in) && is_array($seo_list_out) )
				$s = preg_replace($seo_list_in, $seo_list_out, $s);
	}


$prefix = '|"(?:./)?';
// now that we know about the correct $prefix we can start the rewriting

$urlin =
array(
$prefix . 'index.php\?c=([0-9]*)"|',
$prefix . 'index.php"|',
$prefix . 'viewforum.php\?f=([0-9]*)&(?:amp;)topicdays=([0-9]*)&(?:amp;)start=([0-9]*)"|',
$prefix . 'viewforum.php\?f=([0-9]*)"|',
$prefix . 'viewtopic.php\?t=([0-9]*)&(?:amp;)view=previous"|',
$prefix . 'viewtopic.php\?t=([0-9]*)&(?:amp;)view=next"|',
$prefix . 'viewtopic.php\?t=([0-9]*)&(?:amp;)postdays=([0-9]*)&(?:amp;)postorder=([a-zA-Z]*)&(?:amp;)start=([0-9]*)"|',
$prefix . 'viewtopic.php\?t=([0-9]*)&(?:amp;)start=([0-9]*)&(?:amp;)postdays=([0-9]*)&(?:amp;)postorder=([a-zA-Z]*)&(?:amp;)highlight=([a-zA-Z0-9]*)"|',
$prefix . 'viewtopic.php\?t=([0-9]*)&(?:amp;)start=([0-9]*)"|',
$prefix . 'viewtopic.php\?t=([0-9]*)"|',
$prefix . 'viewtopic.php\?p=([0-9]*)#([0-9]*)"|',
);
$urlout = array(
'"forumc\\1.html"',
'"forums.html"',
'"viewforum\\1-\\2-\\3.html"',
'"forum\\1.html"',
'"ptopic\\1.html"',
'"ntopic\\1.html"',
'"ftopic\\1-\\2-\\3-\\4.html"',
'"ftopic\\1.html"',
'"ftopic\\1-\\2.html"',
'"ftopic\\1.html"',
'"fpost\\1.html#\\1"',
);

$s = preg_replace($urlin, $urlout, $s);
return $s;
}
}
//
// Generate logged in/logged out status
//
if ( $userdata['session_logged_in'] )
{
	$u_login_logout = 'login.'.$phpEx.'?logout=true&amp;sid=' . $userdata['session_id'];
	$l_login_logout = $lang['Logout'] . ' [ ' . $userdata['username'] . ' ]';
}
else
{
	$u_login_logout = 'login.'.$phpEx;
	$l_login_logout = $lang['Login'];
}

//-- mod : today at   yesterday at ------------------------------------------------------------------------ 
//-- add 
$s_last_visit = ( $userdata['session_logged_in'] ) ? create_date_day($board_config['default_dateformat'], $userdata['user_lastvisit'], $board_config['board_timezone']) : ''; 
//-- end mod : today at   yesterday at ------------------------------------------------------------------------ 

// Start add - Last visit MOD
if ( !$userdata['user_level']==MOD )
{
	$template->assign_block_vars('switch_user_is_not_moderator', array());
} else
{
	$template->assign_block_vars('switch_user_is_moderator', array());
}
// End add - Last visit MOD
//
// Get basic (usernames + totals) online
// situation
//
$logged_visible_online = 0;
$logged_hidden_online = 0;
$guests_online = 0;
$online_userlist = '';
$l_online_users = '';

if (defined('SHOW_ONLINE'))
{
	include_once($phpbb_root_path.'includes/functions_color_groups.'.$phpEx);
	// Start replacement - Topic in Who is online MOD
$user_forum_sql = ( !empty($topic_id) ) ? "AND s.session_topic = " . intval($topic_id) :(( !empty($forum_id) ) ? "AND s.session_page = ".intval($forum_id) : '');
// End replacement - Topic in Who is online MOD
	$sql = "SELECT u.username, u.user_id, u.user_allow_viewonline, u.user_level, s.session_logged_in, s.session_ip
		FROM ".USERS_TABLE." u, ".SESSIONS_TABLE." s
		WHERE u.user_id = s.session_user_id
			AND s.session_time >= ".( time() - 300 ) . "
			$user_forum_sql
		ORDER BY u.username ASC, s.session_ip ASC";
	if( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not obtain user/online information', '', __LINE__, __FILE__, $sql);
	}

	$userlist_ary = array();
	$userlist_visible = array();

	$prev_user_id = 0;
	$prev_user_ip = $prev_session_ip = '';

	while( $row = $db->sql_fetchrow($result) )
	{
		// User is logged in and therefor not a guest
		if ( $row['session_logged_in'] )
		{
			// Skip multiple sessions for one user
			if ( $row['user_id'] != $prev_user_id )
			{
				$user_online_link = color_group_colorize_name($row['user_id']);
				if ( $row['user_allow_viewonline'] )
				{
					$logged_visible_online++;
				}
				else
				{
					$logged_hidden_online++;
				}

				if ( $row['user_allow_viewonline'] || $userdata['user_level'] == ADMIN )
				{
					$online_userlist .= ( $online_userlist != '' ) ? ', ' . $user_online_link : $user_online_link;
				}
			}

			$prev_user_id = $row['user_id'];
		}
		else
		{
			// Skip multiple sessions for one user
			if ( $row['session_ip'] != $prev_session_ip )
			{
				$guests_online++;
			}
		}

		$prev_session_ip = $row['session_ip'];
	}
	$db->sql_freeresult($result);

	if ( empty($online_userlist) )
	{
		$online_userlist = $lang['None'];
	}
	// Start replacement - Topic in Who is online MOD
	if ($plus_config['index_layout'] == 'index_body_plus.tpl')
	{
		$online_userlist = $online_userlist;
	}
	else
	{	
	$online_userlist = $lang['Registered_users'].' ' . $online_userlist;
	}
	// End replacement - Topic in Who is online MOD

	$total_online_users = $logged_visible_online + $logged_hidden_online + $guests_online;

	if ( $total_online_users > $board_config['record_online_users'])
	{
		$board_config['record_online_users'] = $total_online_users;
		$board_config['record_online_date'] = time();

		$sql = "UPDATE " . CONFIG_TABLE . "
			SET config_value = '$total_online_users'
			WHERE config_name = 'record_online_users'";
		if ( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not update online user record (nr of users)', '', __LINE__, __FILE__, $sql);
		}

		$sql = "UPDATE " . CONFIG_TABLE . "
			SET config_value = '" . $board_config['record_online_date'] . "'
			WHERE config_name = 'record_online_date'";
		if ( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not update online user record (date)', '', __LINE__, __FILE__, $sql);
		}
		@unlink($phpbb_root_path . 'cache/config.'.$phpEx);
	}

	// Start replacement - Topic in Who is online MOD
	if ( $total_online_users == 0 )
		{
			$l_t_user_s = ( ( isset($topic_id) ) ? $lang['Browsing_topic'] : ( ( isset($forum_id) ) ? $lang['Browsing_forum'] : $lang['Online_users_zero_total'] ) );
		}
	else
		{
			$l_t_user_s = ( ( isset($topic_id) ) ? $lang['Browsing_topic'] : ( ( isset($forum_id) ) ? $lang['Browsing_forum'] : $lang['Online_users_total'] ) );
		}
	// End replacement - Topic in Who is online MOD


	if ( $logged_visible_online == 0 )
	{
		$l_r_user_s = $lang['Reg_users_zero_total'];
	}
	else if ( $logged_visible_online == 1 )
	{
		$l_r_user_s = $lang['Reg_user_total'];
	}
	else
	{
		$l_r_user_s = $lang['Reg_users_total'];
	}

	if ( $logged_hidden_online == 0 )
	{
		$l_h_user_s = $lang['Hidden_users_zero_total'];
	}
	else if ( $logged_hidden_online == 1 )
	{
		$l_h_user_s = $lang['Hidden_user_total'];
	}
	else
	{
		$l_h_user_s = $lang['Hidden_users_total'];
	}

	if ( $guests_online == 0 )
	{
		$l_g_user_s = $lang['Guest_users_zero_total'];
	}
	else if ( $guests_online == 1 )
	{
		$l_g_user_s = $lang['Guest_user_total'];
	}
	else
	{
		$l_g_user_s = $lang['Guest_users_total'];
	}

	$l_online_users = sprintf($l_t_user_s, $total_online_users);
	$l_online_users .= sprintf($l_r_user_s, $logged_visible_online);
	$l_online_users .= sprintf($l_h_user_s, $logged_hidden_online);
	$l_online_users .= sprintf($l_g_user_s, $guests_online);
}

//
// Obtain number of new private messages
// if user is logged in
//
if ( ($userdata['session_logged_in']) && (empty($gen_simple_header)) )
{
	// Start add - Birthday MOD
// see if user has or have had birthday, also see if greeting are enabled
	if ( $userdata['user_birthday']!=999999 && $board_config['birthday_greeting'] && create_date('Ymd', time(), $board_config['board_timezone'])  >= $userdata['user_next_birthday_greeting'].realdate ('md',$userdata['user_birthday'] ) )
	{
		$sql = "UPDATE " . USERS_TABLE . "
			SET user_next_birthday_greeting = " . (create_date('Y', time(), $board_config['board_timezone'])+1) . "
			WHERE user_id = " . $userdata['user_id'];
		if( !$status = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, "Could not update next_birthday_greeting for user.", "", __LINE__, __FILE__, $sql);
		}
		$template->assign_var("GREETING_POPUP",
			"<script language=\"Javascript\" type=\"text/javascript\"><!--
			window.open('".append_sid('birthday_popup.'.$phpEx)."', '_phpbbprivmsg', 'HEIGHT=225,resizable=yes,WIDTH=400');
			//-->
			</script>");
	} //Sorry user shall not have a greeting this year
// End add - Birthday MOD 
	if ( $userdata['user_new_privmsg'] )
	{
		$l_message_new = ( $userdata['user_new_privmsg'] == 1 ) ? $lang['New_pm'] : $lang['New_pms'];
		$l_privmsgs_text = sprintf($l_message_new, $userdata['user_new_privmsg']);

		if ( $userdata['user_last_privmsg'] > $userdata['user_lastvisit'] )
		{
			$sql = "UPDATE " . USERS_TABLE . "
				SET user_last_privmsg = " . $userdata['user_lastvisit'] . "
				WHERE user_id = " . $userdata['user_id'];
			if ( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not update private message new/read time for user', '', __LINE__, __FILE__, $sql);
			}

			$s_privmsg_new = 1;
			$icon_pm = $images['pm_new_msg'];
		}
		else
		{
			$s_privmsg_new = 0;
			$icon_pm = $images['pm_new_msg'];
		}
	}
	else
	{
		$l_privmsgs_text = $lang['No_new_pm'];

		$s_privmsg_new = 0;
		$icon_pm = $images['pm_no_new_msg'];
	}

	if ( $userdata['user_unread_privmsg'] )
	{
		$l_message_unread = ( $userdata['user_unread_privmsg'] == 1 ) ? $lang['Unread_pm'] : $lang['Unread_pms'];
		$l_privmsgs_text_unread = sprintf($l_message_unread, $userdata['user_unread_privmsg']);
	}
	else
	{
		$l_privmsgs_text_unread = $lang['No_unread_pm'];
	}
}
else
{
	$icon_pm = $images['pm_no_new_msg'];
	$l_privmsgs_text = $lang['Login_check_pm'];
	$l_privmsgs_text_unread = '';
	$s_privmsg_new = 0;
}

//
// Generate HTML required for Mozilla Navigation bar
//
if (!isset($nav_links))
{
	$nav_links = array();
}

$nav_links_html = '';
$nav_link_proto = '<link rel="%s" href="%s" title="%s" />' . "\n";
while( list($nav_item, $nav_array) = @each($nav_links) )
{
	if ( !empty($nav_array['url']) )
	{
		$nav_links_html .= sprintf($nav_link_proto, $nav_item, append_sid($nav_array['url']), $nav_array['title']);
	}
	else
	{
		// We have a nested array, used for items like <link rel='chapter'> that can occur more than once.
		while( list(,$nested_array) = each($nav_array) )
		{
			$nav_links_html .= sprintf($nav_link_proto, $nav_item, $nested_array['url'], $nested_array['title']);
		}
	}
}

// Format Timezone. We are unable to use array_pop here, because of PHP3 compatibility
$l_timezone = explode('.', $board_config['board_timezone']);
$l_timezone = (count($l_timezone) > 1 && $l_timezone[count($l_timezone)-1] != 0) ? $lang[sprintf('%.1f', $board_config['board_timezone'])] : $lang[number_format($board_config['board_timezone'])];
// Start add - Complete banner MOD
if ($plus_config['enable_banners'])
{
	$time_now=time();
	$hour_now=create_date('Hi',$time_now,$board_config['board_timezone']);
	$date_now=create_date('Ymd',$time_now,$board_config['board_timezone']);
	$week_now=create_date('w',$time_now,$board_config['board_timezone']);
	$sql_level= ($userdata['user_id']==ANONYMOUS) ? ANONYMOUS : (($userdata['user_level']==ADMIN) ? MOD : (($userdata['user_level']==MOD) ? ADMIN : $userdata['user_level'])); 
	$sql = "SELECT DISTINCT banner_id, banner_name, banner_spot, banner_description, banner_forum, banner_type, banner_width, banner_height, banner_filter FROM ".BANNERS_TABLE ."
			WHERE banner_active
			AND IF(banner_level_type,IF(banner_level_type=1,".intval($sql_level)."<=banner_level,IF(banner_level_type=2,".intval($sql_level).">=banner_level,".intval($sql_level)."<>banner_level)),banner_level=".intval($sql_level).")
			AND (banner_timetype=0 
			OR (( $hour_now BETWEEN time_begin AND time_end) AND ((banner_timetype=2
			OR (( $week_now BETWEEN date_begin AND date_end) AND banner_timetype=4)
			OR (( $date_now BETWEEN date_begin AND date_end) AND banner_timetype=6)
			)))) ORDER BY banner_spot,banner_weigth*SUBSTRING(RAND(),6,2) DESC";
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, "Couldn't get banners data", "", __LINE__, __FILE__, $sql);
	} 
	$banners = array();
	$i=0;
	while ($banners[$i] = $db->sql_fetchrow($result))
	{
		$cookie_name = $board_config['cookie_name'] . '_b_' . $banners[$i]['banner_id'];
		if ( !($HTTP_COOKIE_VARS[$cookie_name] && $banners[$i]['banner_filter']) )
		{
			$banner_spot=$banners[$i]['banner_spot'];
			if ($banner_spot<>$last_spot  AND ($banners[$i]['banner_forum']==$forum_id || empty($banners[$i]['banner_forum'])))
			{
				$banner_size = ($banners[$i]['banner_width'] && $banners[$i]['banner_height']) ? 'width="'.$banners[$i]['banner_width'].'" height="'.$banners[$i]['banner_height'].'"' : '';
				switch ($banners[$i]['banner_type'])
				{
					case 6 :
						// swf file
						$template->assign_vars(array('BANNER_'.$banner_spot.'_IMG' => '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,23,0" id=macromedia '.$banner_size.' align="abscenter"><param name=movie value="'.$banners[$i]['banner_name'].'"><param name=quality value=high><embed src="'.$banners[$i]['banner_name'].'" quality=high pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" autostart="true" /><noembed><a href="'.append_sid('redirect.'.$phpEx.'?banner_id='.$banners[$i]['banner_id']).'" target="_blank">'.$banners[$i]['banner_description'].'</a></noembed></object>')); 
						break;
					case 4 :
						// custom code
						$template->assign_var('BANNER_'.$banner_spot.'_IMG', $banners[$i]['banner_name'] );
						break;
					case 2 :
						// Text link
						$template->assign_var('BANNER_'.$banner_spot.'_IMG', '<a href="'.append_sid('redirect.'.$phpEx.'?banner_id='.$banners[$i]['banner_id']).'" target="_blank" alt="'.$banners[$i]['banner_description'].'" title="'.$banners[$i]['banner_description'].'">'.$banners[$i]['banner_name'].'</a>');
						break;
					case 0 :
					default: 
						$template->assign_var('BANNER_'.$banner_spot.'_IMG', '<a href="'.append_sid('redirect.'.$phpEx.'?banner_id='.$banners[$i]['banner_id']).'" target="_blank"><img src="'.$banners[$i]['banner_name'].'" '.$banner_size.' border="0" alt="'.$banners[$i]['banner_description'].'" title="'.$banners[$i]['banner_description'].'" /></a>');
				}
				$banner_show_list.= ', '.$banners[$i]['banner_id'];
			}
			$last_spot = ($banners[$i]['banner_forum']==$forum_id || empty($banners[$i]['banner_forum'])) ? $banner_spot : $last_spot;
		}
		$i++;
	}
	$db->sql_freeresult($result);
	$template->assign_block_vars('switch_Banners', array());
}
// End add - Complete banner MOD

//
// The following assigns all _common_ variables that may be used at any point
// in a template.
//

if ($plus_config['index_layout'] == 'index_body_plus.tpl')
{
	$template->assign_vars(array(
	'RECORD_USERS_P' => sprintf($board_config['record_online_users'], create_date($board_config['default_dateformat'], $board_config['record_online_date'], $board_config['board_timezone'])),
	'ONLINE_USERLIST_P' => $online_userlist
	));
}	
	
$site_description = $board_config['site_desc'];
if(strlen($site_description) > 75)
{
	$site_description = substr($board_config['site_desc'],0,75);
	$site_description .= "...";
}
		
$template->assign_vars(array(
	'SITENAME' => $board_config['sitename'],
	'SITE_DESCRIPTION' => $site_description,
	'PHPBB_ROOT_PATH' => $phpbb_root_path,
	'PHPEX' => $phpEx,
	'POST_FORUM_URL' => POST_FORUM_URL,
	'POST_TOPIC_URL' => POST_TOPIC_URL,
	'POST_POST_URL' => POST_POST_URL,
	'PAGE_TITLE' => $page_title,
	'LAST_VISIT_DATE' => sprintf($lang['You_last_visit'], $s_last_visit),
	'CURRENT_TIME' => sprintf($lang['Current_time'], create_date($board_config['default_dateformat'], time(), $board_config['board_timezone'])),
	'TOTAL_USERS_ONLINE' => $l_online_users,
	'LOGGED_IN_USER_LIST' => $online_userlist,
	'RECORD_USERS' => sprintf($lang['Record_online_users'], $board_config['record_online_users'], create_date($board_config['default_dateformat'], $board_config['record_online_date'], $board_config['board_timezone'])),
	'PRIVATE_MESSAGE_INFO' => $l_privmsgs_text,
	'PRIVATE_MESSAGE_INFO_UNREAD' => $l_privmsgs_text_unread,
	'PRIVATE_MESSAGE_NEW_FLAG' => $s_privmsg_new,

	'PRIVMSG_IMG' => $icon_pm,

	'L_USERNAME' => $lang['Username'],
	'L_PASSWORD' => $lang['Password'],
	'L_NAME' => $lang['Name'],
	'L_SEARCH_FOR' => $lang['Search_for'],
	'L_THAT_CONTAINS' => $lang['That_contains'],
	'L_LOGIN_LOGOUT' => $l_login_logout,
	'L_LOGIN' => $lang['Login'],
	'L_LOG_ME_IN' => $lang['Log_me_in'],
	'L_AUTO_LOGIN' => $lang['Log_me_in'],
	'L_INDEX' => sprintf($lang['Forum_Index'], $board_config['sitename']),
	'L_REGISTER' => $lang['Register'],
	'L_PROFILE' => $lang['Profile'],
	'L_SEARCH' => $lang['Search'],
	'L_FORUM_SEARCH' => $lang['Forum_Search'],
	'L_BOOKMARKS' => $lang['Bookmarks'],
	'L_PRIVATEMSGS' => $lang['Private_Messages'],
	'L_WHO_IS_ONLINE' => $lang['Who_is_Online'],
	'L_MEMBERLIST' => $lang['Memberlist'],
	'L_FAQ' => $lang['FAQ'],
	'L_NEWS' => $lang['News'],
	'L_DOWNLOAD' => $lang['Download'],
	'L_NEWEST_DL' => $lang['Newest_Downloads'],
	'L_TOP_DL' => $lang['Top_Downloads'],
	'L_USERGROUPS' => $lang['Usergroups'],
	'L_SEARCH_NEW' => $lang['Search_new'],
	'L_SEARCH_NEW2' => $lang['Search_new2'],
	'L_SEARCH_UNANSWERED' => $lang['Search_unanswered'],
	'L_SEARCH_SELF' => $lang['Search_your_posts'],
	'L_WHOSONLINE_ADMIN' => sprintf($lang['Admin_online_color'], '<span style="color:#' . $theme['fontcolor3'] . '">', '</span>'),
	'L_WHOSONLINE_MOD' => sprintf($lang['Mod_online_color'], '<span style="color:#' . $theme['fontcolor2'] . '">', '</span>'),
	'U_RECENT' => append_sid("recent.$phpEx"),
	'L_RECENT' => $lang['Recent_topics'],
	'U_STATISTICS' => append_sid("statistics.$phpEx"),
	'L_STATISTICS' => $lang['Statistics'],
	
	'U_SEARCH_UNANSWERED' => append_sid('search.'.$phpEx.'?search_id=unanswered'),
	'U_SEARCH_SELF' => append_sid('search.'.$phpEx.'?search_id=egosearch'),
	'U_SEARCH_NEW' => append_sid('search.'.$phpEx.'?search_id=newposts'),
	'U_INDEX' => append_sid('index.'.$phpEx),
	'U_REGISTER' => append_sid('profile.'.$phpEx.'?mode=register'),
	'U_PROFILE' => append_sid('profile.'.$phpEx.'?mode=editprofile'),
	'U_PRIVATEMSGS' => append_sid('privmsg.'.$phpEx.'?folder=inbox'),
	'U_PRIVATEMSGS_POPUP' => append_sid('privmsg.'.$phpEx.'?mode=newpm'),
	'U_ABSENCE_POPUP' => append_sid('absence_notify_popup.'.$phpEx),
	'U_SEARCH' => append_sid('search.'.$phpEx),
	'U_BOOKMARKS' => append_sid('search.'.$phpEx.'?search_id=bookmarks'),
	'U_MEMBERLIST' => append_sid('memberlist.'.$phpEx),
	'U_MODCP' => append_sid('modcp.'.$phpEx),
	'U_FAQ' => append_sid('faq.'.$phpEx),
	'U_NEWS' => append_sid($board_config['news_base_url'] . $board_config['news_index_file']),
	'U_DOWNLOAD' => append_sid('dload.'.$phpEx),
	'U_VIEWONLINE' => append_sid('viewonline.'.$phpEx),
	'U_LOGIN_LOGOUT' => append_sid($u_login_logout),
	'U_GROUP_CP' => append_sid('groupcp.'.$phpEx),
	'U_STAFF' => append_sid('staff.'.$phpEx),
	'L_STAFF' => $lang['Staff'],
	// Album MOD
	'L_ALBUM' => $lang['Album'],
	'U_ALBUM' => append_sid('album.'.$phpEx),
	// ezPortal
	'U_PORTAL' => append_sid('portal.'.$phpEx),
	'L_HOME' => $lang['Home'],
	'L_KB' => $lang['KB_title'],
	'U_KB' => append_sid('kb.'.$phpEx),
	'S_CONTENT_DIRECTION' => $lang['DIRECTION'],
	'S_CONTENT_ENCODING' => $lang['ENCODING'],
	'S_CONTENT_DIR_LEFT' => $lang['LEFT'],
	'S_CONTENT_DIR_RIGHT' => $lang['RIGHT'],
	// Start replacement - Advanced time management MOD
	'S_TIMEZONE' => sprintf($lang['All_times'], $l_timezone),
	// End replacement - Advanced time management MOD
	'S_LOGIN_ACTION' => append_sid('login.'.$phpEx),
	'S_SID' => $userdata['session_id'],

	'T_HEAD_STYLESHEET' => $theme['head_stylesheet'],
	'T_BODY_BACKGROUND' => $theme['body_background'],
	'T_BODY_BGCOLOR' => '#'.$theme['body_bgcolor'],
	'T_BODY_TEXT' => '#'.$theme['body_text'],
	'T_BODY_LINK' => '#'.$theme['body_link'],
	'T_BODY_VLINK' => '#'.$theme['body_vlink'],
	'T_BODY_ALINK' => '#'.$theme['body_alink'],
	'T_BODY_HLINK' => '#'.$theme['body_hlink'],
	'T_TR_COLOR1' => '#'.$theme['tr_color1'],
	'T_TR_COLOR2' => '#'.$theme['tr_color2'],
	'T_TR_COLOR3' => '#'.$theme['tr_color3'],
	'T_TR_CLASS1' => $theme['tr_class1'],
	'T_TR_CLASS2' => $theme['tr_class2'],
	'T_TR_CLASS3' => $theme['tr_class3'],
	'T_TH_COLOR1' => '#'.$theme['th_color1'],
	'T_TH_COLOR2' => '#'.$theme['th_color2'],
	'T_TH_COLOR3' => '#'.$theme['th_color3'],
	'T_TH_CLASS1' => $theme['th_class1'],
	'T_TH_CLASS2' => $theme['th_class2'],
	'T_TH_CLASS3' => $theme['th_class3'],
	'T_TD_COLOR1' => '#'.$theme['td_color1'],
	'T_TD_COLOR2' => '#'.$theme['td_color2'],
	'T_TD_COLOR3' => '#'.$theme['td_color3'],
	'T_TD_CLASS1' => $theme['td_class1'],
	'T_TD_CLASS2' => $theme['td_class2'],
	'T_TD_CLASS3' => $theme['td_class3'],
	'T_FONTFACE1' => $theme['fontface1'],
	'T_FONTFACE2' => $theme['fontface2'],
	'T_FONTFACE3' => $theme['fontface3'],
	'T_FONTSIZE1' => $theme['fontsize1'],
	'T_FONTSIZE2' => $theme['fontsize2'],
	'T_FONTSIZE3' => $theme['fontsize3'],
	'T_FONTCOLOR1' => '#'.$theme['fontcolor1'],
	'T_FONTCOLOR2' => '#'.$theme['fontcolor2'],
	'T_FONTCOLOR3' => '#'.$theme['fontcolor3'],
	'T_SPAN_CLASS1' => $theme['span_class1'],
	'T_SPAN_CLASS2' => $theme['span_class2'],
	'T_SPAN_CLASS3' => $theme['span_class3'],
	'GOOGLE_VISIT_COUNTER' => sprintf($lang['Google_Visit_counter'], $google_visit_counter),
	'NAV_LINKS' => $nav_links_html)
);

//
// Login box?
//
if ( !$userdata['session_logged_in'] )
{
	$template->assign_block_vars('switch_user_logged_out', array());
	//
	// Allow autologin?
	//
	if (!isset($board_config['allow_autologin']) || $board_config['allow_autologin'] )
	{
		$template->assign_block_vars('switch_allow_autologin', array());
		$template->assign_block_vars('switch_user_logged_out.switch_allow_autologin', array());
	}
}
else
{
	$template->assign_block_vars('switch_user_logged_in', array());

	if ( !empty($userdata['user_popup_pm']) )
	{
		$template->assign_block_vars('switch_enable_pm_popup', array());
	}
	if ( $userdata['user_absence'] == TRUE )
	{
		$template->assign_block_vars('switch_absence', array());
	}
}
// Start add - Protect user account MOD
// change password ?
if ($_GET['ch_passwd'])
{
		$template->assign_var("PASSWD_POPUP",  
		"<script language=\"Javascript\" type=\"text/javascript\"><!-- 
		   window.open('".append_sid('change_password.'.$phpEx)."', '_phpbbpasswd', 'HEIGHT=400,resizable=yes,WIDTH=600'); 
		  //--> 
		</script>");
}
// End add - Protect user account MOD

// Add no-cache control for cookies if they are set
//$c_no_cache = (isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_sid']) || isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_data'])) ? 'no-cache="set-cookie", ' : '';

// Work around for "current" Apache 2 + PHP module which seems to not
// cope with private cache control setting
if (!defined('AJAX_HEADERS'))
{
	if (!empty($HTTP_SERVER_VARS['SERVER_SOFTWARE']) && strstr($HTTP_SERVER_VARS['SERVER_SOFTWARE'], 'Apache/2'))
	{
		header ('Cache-Control: no-cache, pre-check=0, post-check=0');
	}
	else
	{
		header ('Cache-Control: private, pre-check=0, post-check=0, max-age=0');
	}
	header ('Expires: 0');
	header ('Pragma: no-cache');
}

//-- mod : categories hierarchy --------------------------------------------------------------------
//-- add
// get the nav sentence
$nav_key = '';
if (isset($_POST[POST_CAT_URL]) || isset($_GET[POST_CAT_URL]))
{
	$nav_key = POST_CAT_URL . ((isset($_POST[POST_CAT_URL])) ? intval($_POST[POST_CAT_URL]) : intval($_GET[POST_CAT_URL]));
}
if (isset($_POST[POST_FORUM_URL]) || isset($_GET[POST_FORUM_URL]))
{
	$nav_key = POST_FORUM_URL . ((isset($_POST[POST_FORUM_URL])) ? intval($_POST[POST_FORUM_URL]) : intval($_GET[POST_FORUM_URL]));
}
if (isset($_POST[POST_TOPIC_URL]) || isset($_GET[POST_TOPIC_URL]))
{
	$nav_key = POST_TOPIC_URL . ((isset($_POST[POST_TOPIC_URL])) ? intval($_POST[POST_TOPIC_URL]) : intval($_GET[POST_TOPIC_URL]));
}
if (isset($_POST[POST_POST_URL]) || isset($_GET[POST_POST_URL]))
{
	$nav_key = POST_POST_URL . ((isset($_POST[POST_POST_URL])) ? intval($_POST[POST_POST_URL]) : intval($_GET[POST_POST_URL]));
}
if ( empty($nav_key) && (isset($_POST['selected_id']) || isset($_GET['selected_id'])) )
{
   $nav_key = isset($_GET['selected_id']) ? $_GET['selected_id'] : $_POST['selected_id'];
}
if (empty($nav_key)) $nav_key = 'Root';
$nav_cat_desc = make_cat_nav_tree($nav_key, $nav_pgm);
if ($nav_cat_desc != '') $nav_cat_desc = $nav_separator . $nav_cat_desc;

// send to template
$template->assign_vars(array(
	'SPACER'		=> $images['spacer'],
	'NAV_SEPARATOR' => $nav_separator,
	'NAV_CAT_DESC'	=> $nav_cat_desc,
	)
);
//-- fin mod : categories hierarchy ----------------------------------------------------------------
//-- mod : mods settings ---------------------------------------------------------------------------
//-- add
$template->assign_vars(array(
	'U_PREFERENCES'	=> append_sid("./profile_options.$phpEx"),
	'L_PREFERENCES'	=> $lang['Preferences'],
	'I_PREFERENCES'	=> $images['Preferences'],
	)
);
//-- fin mod : mods settings -----------------------------------------------------------------------
//-- mod : calendar --------------------------------------------------------------------------------
//-- add
if (!defined('IN_CALENDAR'))
{
	if ( intval($board_config['calendar_header_cells']) > 0 )
	{
		include_once($phpbb_root_path . './includes/functions_calendar.' . $phpEx);
		display_calendar('CALENDAR_BOX', intval($board_config['calendar_header_cells']));
	}
}
$template->assign_vars(array(
	'L_CALENDAR'	=> $lang['Calendar'],
	'I_CALENDAR'	=> $images['menu_calendar'],
	'U_CALENDAR'	=> append_sid("./calendar.$phpEx"),
	'I_RANKS' => '<img src="' . $images['Ranks'] . '" width="12" height="13" border="0" alt="' . $lang['Ranks'] . '" hspace="3" />',
	'U_RANKS' => append_sid("ranks.$phpEx"),
	'L_RANKS' => $lang['Ranks'],
	)
); 
//-- fin mod : calendar ---------------------------------------------------------------------------- 
//-- mod : ranks -----------------------------------------------------------------------------------
//-- add
$check_access = true;
//include( $phpbb_root_path . 'ranks.' . $phpEx );
//-- fin mod : ranks -------------------------------------------------------------------------------

$template->pparse('overall_header');

?>
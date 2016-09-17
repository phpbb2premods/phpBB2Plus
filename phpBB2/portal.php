<?php
/***************************************************************************
 *                                portal.php
 *                            -------------------
 *   begin                : Tuesday, August 13, 2002
 *   copyright            : (C) 2002 Smartor
 *   email                : smartor_xp@hotmail.com
 *
 *   $Id: portal.php,v 2.1.7 2003/01/30, 17:05:58 Smartor Exp $
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

/***************************************************************************
 *
 *   Some code in this file I borrowed from the original index.php, Welcome
 *   Avatar MOD and others...
 *
 ***************************************************************************/

//
// Set configuration for ezPortal
//

// Portal Configuration has moved to phpBB2 plus Admin Panel
//
// END configuration
// --------------------------------------------------------

define('IN_PHPBB', true);
$phpbb_root_path = './';
$album_root_path = $phpbb_root_path . 'album_mod/';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);
include($phpbb_root_path . 'fetchposts.'.$phpEx);
include_once($phpbb_root_path.'includes/functions_color_groups.'.$phpEx);
include_once ($phpbb_root_path . 'includes/news.' . $phpEx ); 
include_once ($phpbb_root_path . 'pafiledb/includes/pafiledb_constants.' . $phpEx ); 
//
// Start session management
//
$userdata = session_pagestart( $user_ip, PAGE_INDEX, $session_length ); 
init_userprefs($userdata);
//
// End session management
//
// Start add  - Photo Album Block
include($album_root_path . 'album_common.'.$phpEx);
// End add  - Photo Album Block

//
// If you don't use these stats on your index you may want to consider
// removing them
//
$total_posts = get_db_stat('postcount');
$total_users = get_db_stat('usercount');
$total_topics = get_db_stat('topiccount');
$newest_userdata = get_db_stat('newestuser');
$newest_user = $newest_userdata['username'];
$newest_uid = $newest_userdata['user_id'];

if( $total_posts == 0 )
{
	$l_total_post_s = $lang['Posted_articles_zero_total'];
}
else if( $total_posts == 1 )
{
	$l_total_post_s = $lang['Posted_article_total'];
}
else
{
	$l_total_post_s = $lang['Posted_articles_total'];
}

if( $total_users == 0 )
{
	$l_total_user_s = $lang['Registered_users_zero_total'];
}
else if( $total_users == 1 )
{
	$l_total_user_s = $lang['Registered_user_total'];
}
else
{
	$l_total_user_s = $lang['Registered_users_total'];
}

// Read Portal Configuration from DB
define('PORTAL_TABLE', $table_prefix.'portal');

$CFG = array();
$sql = "SELECT * FROM " . PORTAL_TABLE;

if( !($result = $db->sql_query($sql)) )
{
	message_die(CRITICAL_ERROR, "Could not query config information", "", __LINE__, __FILE__, $sql);
}

while ( $row = $db->sql_fetchrow($result) )
{
	$CFG[$row['portal_name']] = $row['portal_value'];
}
$db->sql_freeresult($result);

// last seen hack
if ($CFG['last_seen']>0) 
{
	$sql = "SELECT username, user_id, user_level, user_allow_viewonline, user_lastlogon FROM " . USERS_TABLE . " WHERE user_id > 0 AND username <> 'Anonymous' ORDER BY user_lastlogon DESC LIMIT " . $CFG['last_seen'];

	if (!$result = $db->sql_query($sql))
    {
        message_die(GENERAL_ERROR, 'Could not query last seen information', '', __LINE__, __FILE__, $sql);
    }

	while ($row = $db->sql_fetchrow($result))
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
            $template->assign_block_vars('last_seen_row', array(
            'L_LSEEN_USERNAME' => $user_online_link,
            'L_LSEEN_TIME' => create_date($board_config['default_dateformat'], $row['user_lastlogon'], $board_config['board_timezone'])));
        }
    }
	$db->sql_freeresult($result);
	$show_lastvbox = true;
}
//
// Recent Topics
//
if ( $CFG['number_recent_topics'] > 0 )
{
	$sql = "SELECT * FROM ". FORUMS_TABLE . " ORDER BY forum_id";
	if (!$result = $db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, 'Could not query forums information', '', __LINE__, __FILE__, $sql);
	}
	$forum_data = array();
	while( $row = $db->sql_fetchrow($result) )
	{
		$forum_data[] = $row;
	}
	$db->sql_freeresult($result);
	
	$is_auth_ary = array();
	$is_auth_ary = auth(AUTH_ALL, AUTH_LIST_ALL, $userdata, $forum_data);
	
	if( $CFG['exceptional_forums'] == '' )
	{
		$except_forum_id = '\'start\'';
	}
	else
	{
		$except_forum_id = $CFG['exceptional_forums'];
	}
	
	for ($i = 0; $i < count($forum_data); $i++)
	{
		if ((!$is_auth_ary[$forum_data[$i]['forum_id']]['auth_read']) or (!$is_auth_ary[$forum_data[$i]['forum_id']]['auth_view']))
		{
			if ($except_forum_id == '\'start\'')
			{
				$except_forum_id = $forum_data[$i]['forum_id'];
			}
			else
			{
				$except_forum_id .= ',' . $forum_data[$i]['forum_id'];
			}
		}
	}
	$sql = "SELECT t.topic_id, t.topic_title, t.topic_last_post_id, t.forum_id, t.topic_icon, t.topic_type, p.post_id, p.poster_id, p.post_time, u.user_id, u.username
			FROM " . TOPICS_TABLE . " AS t, " . POSTS_TABLE . " AS p, " . USERS_TABLE . " AS u
			WHERE t.forum_id NOT IN (" . $except_forum_id . ")
				AND t.topic_status <> 2
				AND p.post_id = t.topic_last_post_id
				AND p.poster_id = u.user_id
			ORDER BY p.post_id DESC
			LIMIT " . $CFG['number_recent_topics'];
	if (!$result = $db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, 'Could not query recent topics information', '', __LINE__, __FILE__, $sql);
	}
	$number_recent_topics = $db->sql_numrows($result);
	$recent_topic_row = array();
	
	$dateformat = ($userdata['user_id'] == ANONYMOUS) ? $board_config['default_dateformat'] : $userdata['user_dateformat'];
	$timezone = ($userdata['user_id'] == ANONYMOUS) ? $board_config['board_timezone'] : $userdata['user_timezone'];
	
	if ( $number_recent_topics != 0 )
	{
		$template->assign_block_vars('switch_recent_topics_yes', array());
	
		while ($row = $db->sql_fetchrow($result))
		{
			$recent_topic_row[] = $row;
		}
		
		for ($i = 0; $i < $number_recent_topics; $i++)
		{
				$recent_title_short = append_sid("fpost" . $recent_topic_row[$i]['topic_last_post_id'] . ".html" . '#' . $recent_topic_row[$i]['topic_last_post_id']);
				$recent_title_long = append_sid("viewtopic.$phpEx?" . POST_POST_URL . '=' . $recent_topic_row[$i]['post_id']) . '#' .$recent_topic_row[$i]['post_id'];
		
				$recent_title = ($plus_config['enable_shorturls']) ? $recent_title_short : $recent_title_long;
				
				$template->assign_block_vars('switch_recent_topics_yes.recent_topic_row', array(
				'U_TITLE' => $recent_title,
				'L_TITLE' => $recent_topic_row[$i]['topic_title'],
				'LAST_TITLE_ICON' => get_icon_title($recent_topic_row[$i]['topic_icon'], 0, $recent_topic_row[$i]['topic_type']),
				'U_POSTER' => append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=" . $recent_topic_row[$i]['user_id']),
				'S_POSTER' => color_group_colorize_name($recent_topic_row[$i]['user_id'],true),
				'S_POSTTIME' => create_date( $dateformat, $recent_topic_row[$i]['post_time'], $timezone)
				)
			);
		}
	}
	else
	{
		$template->assign_block_vars('switch_recent_topics_no', array());
	
		$template->assign_vars(array(
			'L_NO_RECENT_TOPICS' => $lang['No_recent_topics'])
		);
	}
	$db->sql_freeresult($result);
	$template->assign_block_vars('switch_recent_exp', array());
}  
//
// END - Recent Topics
//

//
// Recent Files
//
if ( $CFG['number_recent_files'] > 0 )
{
	$sql = "SELECT * FROM ". PA_FILES_TABLE . " WHERE file_approved = 1 ORDER BY file_time DESC
		LIMIT " . $CFG['number_recent_files'];
	
	if (!$result = $db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, 'Could not query files information', '', __LINE__, __FILE__, $sql);
	}
	else
	{
	   include($phpbb_root_path . 'pafiledb/includes/functions_pafiledb.'.$phpEx);
	   $paFileDB = new pafiledb();
	   $paFileDB->init();
	}
	$files_data = array();
	while( $row = $db->sql_fetchrow($result) )
	{
		if( !( ($paFileDB->auth[$row['file_catid']]['auth_download']) && ($paFileDB->auth[$row['file_catid']]['auth_view']) ))
		{ 	}
		else
		{
			$files_data[] = $row;
		}
	}
	$number_recent_files = count($files_data);
	$recent_files_row = array();
	
	if ($number_recent_files != 0)
	{
		$template->assign_block_vars('switch_show_recentfiles', array());
	
		while ($row = $db->sql_fetchrow($result))
		{
			$recent_files_row[] = $row;
		}
	
		$db->sql_freeresult($result);
	
		for ($i = 0; $i < $number_recent_files; $i++)
		{
			if(strlen($files_data[$i]['file_name']) > 23)
			 {
					$files_data[$i]['file_name'] = substr($files_data[$i]['file_name'],0,21);
					$files_data[$i]['file_name'] .= "...";
			}
			
			$template->assign_block_vars('switch_show_recentfiles.recent_files_row', array(
				'U_TITLE' => ($files_data[$i]['file_license'] > 0) ? append_sid('dload.'.$phpEx.'?action=license&amp;license_id='.$files_data[$i]['file_license'].'&file_id='.$files_data[$i]['file_id']) : append_sid('dload.'.$phpEx.'?action=download&amp;file_id='.$files_data[$i]['file_id']), 
				'L_TITLE' => $files_data[$i]['file_name']
				)
			);
		
		}
	}
	else
	{
			$template->assign_block_vars('switch_none_recentfiles', array());
	
		$template->assign_vars(array(
			'L_NO_RECENT_FILE' => $lang['No_recent_files'])
		);
	}
	$template->assign_block_vars('switch_recent_files', array());
} 
//
// END - Recent Files
//


// Birthday Mod, Show users with birthday
if ($board_config['birthday_check_day'] > 0 )
{
	$cache_data_file = $phpbb_root_path."cache/birthday_". $board_config['board_timezone'] . ".dat";
	if (@is_file($cache_data_file)  && empty($SID))
	{
		$valid = (date('YmdH',time()) - date('YmdH',@filemtime($cache_data_file))<1) ? true : false;
	} else
	{
	   $valid = false;
	}
	
	if ($valid )
	{
	   include ($cache_data_file);
	   $birthday_today_list = stripslashes($birthday_today_list);
	   $birthday_week_list = stripslashes($birthday_week_list);
	} else
	{
	   $sql = ($board_config['birthday_check_day']) ? "SELECT user_id, username, user_birthday,user_level FROM " . USERS_TABLE. " WHERE user_birthday!=999999 ORDER BY username" :"";
	   if($result = $db->sql_query($sql))
	   {
		  if (!empty($result))
		  {
			 $time_now = time();
			 $this_year = create_date('Y', $time_now, $board_config['board_timezone']);
			 $date_today = create_date('Ymd', $time_now, $board_config['board_timezone']);
			 $date_forward = create_date('Ymd', $time_now+($board_config['birthday_check_day']*86400), $board_config['board_timezone']);
				while ($birthdayrow = $db->sql_fetchrow($result))
			 {
				   $user_birthday2 = $this_year.($user_birthday = realdate("md",$birthdayrow['user_birthday'] ));
				   if ( $user_birthday2 < $date_today ) $user_birthday2 += 10000;
				if ( $user_birthday2 > $date_today  && $user_birthday2 <= $date_forward )
				{
				   // user are having birthday within the next days
				   $user_age = ( $this_year.$user_birthday < $date_today ) ? $this_year - realdate ('Y',$birthdayrow['user_birthday'])+1 : $this_year- realdate ('Y',$birthdayrow['user_birthday']);
				   $style_color = color_group_colorize_name($birthdayrow['user_id'],true);
								 $birthday_week_list .= ' <a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=" . $birthdayrow['user_id']) . '" class="gensmall">' . $style_color . ' ('.$user_age.')</a>,'; 
				} else if ( $user_birthday2 == $date_today )
				   {
				   //user have birthday today
				   $user_age = $this_year - realdate ( 'Y',$birthdayrow['user_birthday'] );
				   $style_color = color_group_colorize_name($birthdayrow['user_id'],true);
				   $birthday_today_list .= ' <a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=" . $birthdayrow['user_id']) . '" class="gensmall">' . $style_color . ' ('.$user_age.')</a>,';
				   }
			 }
			 if ($birthday_today_list) $birthday_today_list[ strlen( $birthday_today_list)-1] = ' ';
			 if ($birthday_week_list) $birthday_week_list[ strlen( $birthday_week_list)-1] = ' ';
		  }
		  $db->sql_freeresult($result);
		  if (empty($SID))
		  {
			 // stores the data set in a cache file
			 $data = "<?php\n";
			 $data .= '$birthday_today_list = \'' . addslashes($birthday_today_list) . "';\n";
			 $data .= '$birthday_week_list = \'' . addslashes($birthday_week_list) . "';\n?>";
			 $fp = fopen( $cache_data_file, "w" );
			 fwrite($fp, $data);
			 fclose($fp);
			 @chmod($cache_data_file, 0666); 
		  }
	   }
	}
}
$birthday_today_list = stripslashes($birthday_today_list);
$birthday_week_list = stripslashes($birthday_week_list);

// Start add - Last visit MOD
if ($plus_config['show_last_visit'] != 0 && (($board_config['display_viewonline'] == 2) || ($board_config['display_viewonline'] == 1)) )
{
	
	$cache_data_file = $phpbb_root_path."cache/last_visit_". $userdata['user_level'] . "_". $board_config['board_timezone'] . ".dat"; 
	if (@is_file($cache_data_file)) 
	{ 
		$valid = (date('YmdH',time()) - date('YmdH',@filemtime($cache_data_file))<1) ? true : false; 
	} else 
	{ 
	   $valid = false; 
	} 
	
	if ($valid ) 
	{ 
	   include ($cache_data_file); 
	} else 
	{
		$time_now=time();
		$time1Hour=$time_now-3600;
		$minutes = date('is', $time_now);
		$hour_now = $time_now - (60*($minutes[0].$minutes[1])) - ($minutes[2].$minutes[3]); 
		$dato=create_date('H', $time_now,$board_config['board_timezone']);
		$timetoday = $hour_now - (3600*$dato); 
		if ($plus_config['show_last_visit'] == 2 )
	   {
		  $sql = 'SELECT session_ip, MAX(session_time) as session_time FROM '.SESSIONS_TABLE.' WHERE session_user_id="'.ANONYMOUS.'" AND session_time >= '.$timetoday.' AND session_time< '.($timetoday+86399).' GROUP BY session_ip';
		  if (!$result = $db->sql_query($sql)) message_die(GENERAL_ERROR, "Couldn't retrieve guest user today data", "", __LINE__, __FILE__, $sql);
		  while( $guest_list = $db->sql_fetchrow($result))
		  {
			 if ($guest_list['session_time'] >$time1Hour) $users_lasthour++;
		  }
		  $guests_today = $db->sql_numrows($result);
	   }
		$sql = 'SELECT user_id,username,user_allow_viewonline,user_level,user_lastlogon FROM ' . USERS_TABLE . ' WHERE user_id!="'.ANONYMOUS.'" AND user_session_time >= '.$timetoday.' AND user_session_time< '.($timetoday+86399).' ORDER BY username';
		if (!$result = $db->sql_query($sql)) message_die(GENERAL_ERROR, "Couldn't retrieve user today data", "", __LINE__, __FILE__, $sql); 
		while( $todayrow = $db->sql_fetchrow($result)) 
		{ 
			$style_color = ""; 
			if ($todayrow['user_lastlogon']>=$time1Hour)
			{
				$users_lasthour++;
			}
			$style_color = addslashes(color_group_colorize_name($todayrow['user_id'],false));
			$users_today_list.=( $todayrow['user_allow_viewonline'])?' <a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=" . $todayrow['user_id']) . '" class="gensmall">' . $style_color . '</a>,' : (($userdata['user_level']==ADMIN) ? ' <a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=" . $todayrow['user_id']) . '" class="gensmall"><i>' . $style_color .'</i></a>,' : '');  
			if (!$todayrow['user_allow_viewonline']) $logged_hidden_today++;
			else $logged_visible_today++;
		}
		if ($users_today_list) 
		{
			$users_today_list[ strlen( $users_today_list)-1] = ' '; 
		} else
		{
			$users_today_list = $lang['None'];
		}
		$total_users_today = $db->sql_numrows($result)+$guests_today;
		$db->sql_freeresult($result);
		if ( isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_sid'])) 
		{ 
		   // stores the data set in a cache file 
		   $data = "<?php\n"; 
		   $data .='$total_users_today = '.intval($total_users_today); 
		   $data .=";\n"; 
		   $data .='$users_lasthour = '.intval($users_lasthour); 
		   $data .=";\n"; 
		   $data .='$guests_today = '.intval($guests_today); 
		   $data .=";\n"; 
		   $data .='$logged_visible_today = '.intval($logged_visible_today); 
		   $data .=";\n"; 
		   $data .='$logged_hidden_today = '.intval($logged_hidden_today); 
		   $data .=";\n"; 
		   $data .='$users_today_list = \''.$users_today_list."'"; 
		   $data .=";\n?>"; 
		   $fp = fopen( $cache_data_file, "w" ); 
		   fwrite($fp, $data); 
		   fclose($fp); 
		   @chmod($cache_data_file, 0666); 
		} 
	}
	
	$users_today_list = $lang['Registered_users'].' ' . $users_today_list;
	$l_today_user_s = ($total_users_today) ? ( ( $total_users_today == 1 )? $lang['User_today_total'] : $lang['Users_today_total'] ) : $lang['Users_today_zero_total'];
	$l_today_r_user_s = ($logged_visible_today) ? ( ( $logged_visible_today == 1 ) ? $lang['Reg_user_total'] : $lang['Reg_users_total'] ) : $lang['Reg_users_zero_total'];
	$l_today_h_user_s = ($logged_hidden_today) ? (($logged_hidden_today == 1) ? $lang['Hidden_user_total'] : $lang['Hidden_users_total'] ) : $lang['Hidden_users_zero_total'];
	$l_today_users = sprintf($l_today_user_s, $total_users_today); 
	
	if ($plus_config['show_last_visit'] == 2 )
	{
		$l_today_g_user_s = ($guests_today) ? (($guests_today == 1) ? $lang['Guest_user_total'] : $lang['Guest_users_total']) : $lang['Guest_users_zero_total'];
		$l_today_users .= sprintf($l_today_r_user_s, $logged_visible_today);
		$l_today_users .= sprintf($l_today_h_user_s, $logged_hidden_today);
		$l_today_users .= sprintf($l_today_g_user_s, $guests_today);
		$l_today_text = ($users_lasthour)?sprintf($lang['Users_lasthour_explain'],$users_lasthour):$lang['Users_lasthour_none_explain'];
	}
	$template->assign_block_vars('lastvisits', array());
	$show_lastvbox = true;
}
// End add - Last visit MOD
if ($show_lastvbox) 
{
	$template->assign_block_vars('switch_lastvbox', array());
	unset($show_lastvbox);
}

//
// Start output of page
//
if ( $board_config['display_viewonline'] )
{
   define('SHOW_ONLINE', true);
} 

$page_title = $lang['Home'];
include($phpbb_root_path . 'includes/page_header.'.$phpEx);

$template->set_filenames(array(
	'news' => 'portal_body.tpl')
);

//
// Avatar On Index MOD
//
$avatar_img = '';
if ( $userdata['user_avatar_type'] && $userdata['user_allowavatar'] )
{
	switch( $userdata['user_avatar_type'] )
	{
		case USER_AVATAR_UPLOAD:
			$size = check_avatar_size($board_config['avatar_path'] . '/' . $userdata['user_avatar'], $CFG['pics_thumbsize']);
			$avatar_img = ( $board_config['allow_avatar_upload'] ) ? '<img src="' . $board_config['avatar_path'] . '/' . $userdata['user_avatar'] . '" '.$size.' alt="" border="0" />' : '';
			break;
		case USER_AVATAR_REMOTE:
			$size = check_avatar_size($userdata['user_avatar'], $CFG['pics_thumbsize'], true);
			$avatar_img = ( $board_config['allow_avatar_remote'] ) ? '<img src="' . $userdata['user_avatar'] . '" '.$size.' alt="" border="0" />' : '';
			break;
		case USER_AVATAR_GALLERY:
			$size = check_avatar_size($board_config['avatar_gallery_path'] . '/' . $userdata['user_avatar'], $CFG['pics_thumbsize']);
			$avatar_img = ( $board_config['allow_avatar_local'] ) ? '<img src="' . $board_config['avatar_gallery_path'] . '/' . $userdata['user_avatar'] . '" '.$size.' alt="" border="0" />' : '';
			break;
	}
}
// Check For Anonymous User
if ($userdata['user_id'] != '-1')
{
	$name_link = color_group_colorize_name($userdata['user_id']);
}
else
{
	$name_link = $lang['Guest'];
}

//
// END: Avatar On Index MOD
//

// Start add  - Photo Album Block
if ( $CFG['pics_number'] > 0 )
{
	// Build Categories Index
	$sql_private_last = ($CFG['pics_all'] == '1') ? '' : ' AND c.cat_user_id = 0';
	$sql = "SELECT c.*, COUNT(p.pic_id) AS count
			FROM ". ALBUM_CAT_TABLE ." AS c
				LEFT JOIN ". ALBUM_TABLE ." AS p ON c.cat_id = p.pic_cat_id
			WHERE cat_id <> 0
			$sql_private_last
			GROUP BY cat_id
			ORDER BY cat_order ASC";
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not query categories list', '', __LINE__, __FILE__, $sql);
	}
	$catrows = array();
	
	while( $row = $db->sql_fetchrow($result) )
	{
		$album_user_access = album_user_access($row['cat_id'], $row, 1, 0, 0, 0, 0, 0); // VIEW
		if ($album_user_access['view'] == 1)
		{
			$catrows[] = $row;
		}
	}
	$db->sql_freeresult($result);
	
	if ( $CFG['pics_all'] == '1' )
	{
		$allowed_cat = '0'; // For Recent Public Pics below
	}
	else
	{
		$allowed_cat = ''; 
	}
	
	//
	// $catrows now stores all categories which this user can view. Dump them out!
	//
	for ($i = 0; $i < count($catrows); $i++)
	{
		// Build allowed category-list (for recent pics after here)
		$allowed_cat .= ($allowed_cat == '') ? $catrows[$i]['cat_id'] : ',' . $catrows[$i]['cat_id'];
	
		// Get Last Pic of this Category
		if ($catrows[$i]['count'] == 0)
		{
			// Category is empty
			$last_pic_info = $lang['No_Pics'];
			$u_last_pic = '';
			$last_pic_title = '';
		}
		else
		{
			// Check Pic Approval
			if ( ($catrows[$i]['cat_approval'] == ALBUM_ADMIN) or ($catrows[$i]['cat_approval'] == ALBUM_MOD) )
			{
				$pic_approval_sql = 'AND p.pic_approval = 1'; // Pic Approval ON
			}
			else
			{
				$pic_approval_sql = ''; // Pic Approval OFF
			}
		}
		// END of Last Pic
	}
	
	// Recent Public Pics
	if ( $CFG['pics_all'] == '1' )
	{
		$pics_allowed = '0';
	}
	else
	{
		$pics_allowed = '';
	}
	
	if ( $allowed_cat != $pics_allowed )
	{
		$CategoryID = $CFG['cat_id'];
	
		if ( $CFG['pics_sort'] == '1' )
		{
			if ( $CategoryID != 0 )
			{
				$sql = "SELECT p.pic_id, p.pic_title, p.pic_thumbnail, p.pic_desc, p.pic_user_id, p.pic_user_ip, p.pic_username, p.pic_time, p.pic_cat_id, p.pic_view_count, u.user_id, u.username, r.rate_pic_id, AVG(r.rate_point) AS rating, COUNT(DISTINCT c.comment_id) AS comments
					FROM ". ALBUM_TABLE ." AS p
						LEFT JOIN ". USERS_TABLE ." AS u ON p.pic_user_id = u.user_id
						LEFT JOIN ". ALBUM_CAT_TABLE ." AS ct ON p.pic_cat_id = ct.cat_id
						LEFT JOIN ". ALBUM_RATE_TABLE ." AS r ON p.pic_id = r.rate_pic_id
						LEFT JOIN ". ALBUM_COMMENT_TABLE ." AS c ON p.pic_id = c.comment_pic_id
					WHERE p.pic_cat_id IN ($allowed_cat) AND ( p.pic_approval = 1 OR ct.cat_approval = 0 ) AND pic_cat_id IN ($CategoryID)
					GROUP BY p.pic_id
					ORDER BY RAND()
					LIMIT ". $CFG['pics_number'];
			}
			else
			{
				$sql = "SELECT p.pic_id, p.pic_title, p.pic_thumbnail, p.pic_desc, p.pic_user_id, p.pic_user_ip, p.pic_username, p.pic_time, p.pic_cat_id, p.pic_view_count, u.user_id, u.username, r.rate_pic_id, AVG(r.rate_point) AS rating, COUNT(DISTINCT c.comment_id) AS comments
					FROM ". ALBUM_TABLE ." AS p
						LEFT JOIN ". USERS_TABLE ." AS u ON p.pic_user_id = u.user_id
						LEFT JOIN ". ALBUM_CAT_TABLE ." AS ct ON p.pic_cat_id = ct.cat_id
						LEFT JOIN ". ALBUM_RATE_TABLE ." AS r ON p.pic_id = r.rate_pic_id
						LEFT JOIN ". ALBUM_COMMENT_TABLE ." AS c ON p.pic_id = c.comment_pic_id
					WHERE p.pic_cat_id IN ($allowed_cat) AND ( p.pic_approval = 1 OR ct.cat_approval = 0 )
					GROUP BY p.pic_id
					ORDER BY RAND()
					LIMIT ". $CFG['pics_number'];
				}
		}
		else if ( $CFG['pics_sort'] == '0' )
		{
			if ( $CategoryID != 0 )
			{
				$sql = "SELECT p.pic_id, p.pic_title, p.pic_thumbnail, p.pic_desc, p.pic_user_id, p.pic_user_ip, p.pic_username, p.pic_time, p.pic_cat_id, p.pic_view_count, u.user_id, u.username, r.rate_pic_id, AVG(r.rate_point) AS rating, COUNT(DISTINCT c.comment_id) AS comments
					FROM ". ALBUM_TABLE ." AS p
						LEFT JOIN ". USERS_TABLE ." AS u ON p.pic_user_id = u.user_id
						LEFT JOIN ". ALBUM_CAT_TABLE ." AS ct ON p.pic_cat_id = ct.cat_id
						LEFT JOIN ". ALBUM_RATE_TABLE ." AS r ON p.pic_id = r.rate_pic_id
						LEFT JOIN ". ALBUM_COMMENT_TABLE ." AS c ON p.pic_id = c.comment_pic_id
					WHERE p.pic_cat_id IN ($allowed_cat) AND ( p.pic_approval = 1 OR ct.cat_approval = 0 ) AND pic_cat_id IN ($CategoryID)
					GROUP BY p.pic_id
					ORDER BY pic_time DESC
					LIMIT ". $CFG['pics_number'];
			}
			else
			{
				$sql = "SELECT p.pic_id, p.pic_title, p.pic_thumbnail, p.pic_desc, p.pic_user_id, p.pic_user_ip, p.pic_username, p.pic_time, p.pic_cat_id, p.pic_view_count, u.user_id, u.username, r.rate_pic_id, AVG(r.rate_point) AS rating, COUNT(DISTINCT c.comment_id) AS comments
					FROM ". ALBUM_TABLE ." AS p
						LEFT JOIN ". USERS_TABLE ." AS u ON p.pic_user_id = u.user_id
						LEFT JOIN ". ALBUM_CAT_TABLE ." AS ct ON p.pic_cat_id = ct.cat_id
						LEFT JOIN ". ALBUM_RATE_TABLE ." AS r ON p.pic_id = r.rate_pic_id
						LEFT JOIN ". ALBUM_COMMENT_TABLE ." AS c ON p.pic_id = c.comment_pic_id
					WHERE p.pic_cat_id IN ($allowed_cat) AND ( p.pic_approval = 1 OR ct.cat_approval = 0 )
					GROUP BY p.pic_id
					ORDER BY pic_time DESC
					LIMIT ". $CFG['pics_number'];
			}
		}
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not query recent pics information', '', __LINE__, __FILE__, $sql);
		}
		$recentrow = array();
	
		while( $row = $db->sql_fetchrow($result) )
		{
			$recentrow[] = $row;
		}
		$db->sql_freeresult($result);
		
		if (count($recentrow) > 0)
		{
			
			for ($i = 0; $i < count($recentrow); $i += $album_config['cols_per_page'])
			{
					$template->assign_block_vars('recent_pics', array());
				
				for ($j = $i; $j < ($i + $album_config['cols_per_page']); $j++)
				{
					if ( $j >= count($recentrow) )
					{
						break;
					}
	
					if (!$recentrow[$j]['rating'])
					{
						$recentrow[$j]['rating'] = $lang['Not_rated'];
					}
					else
					{
						$recentrow[$j]['rating'] = round($recentrow[$j]['rating'], 2);
					}
	
					$pic_size = @getimagesize(ALBUM_CACHE_PATH . $recentrow[$j]['pic_thumbnail']); 
					$pic_width = $pic_size[0]; 
					$pic_height = $pic_size[1]; 
	
					if ($pic_width > $pic_height)
					{
						$width = $CFG['pics_thumbsize'];
						$height = $CFG['pics_thumbsize'] * ($pic_height/$pic_width);
					}
					else if ($pic_width < $pic_height)
					{
						$height = $CFG['pics_thumbsize'];
						$width = $CFG['pics_thumbsize'] * ($pic_width/$pic_height);
					}
					else
					{
						$width = '90%';
						$height = '90%';
					}
	
					// Display pics horizontally
					$template->assign_block_vars('recent_pics.recent_col', array(
						'U_PIC' => ($album_config['fullpic_popup']) ? append_sid("album_pic.$phpEx?pic_id=". $recentrow[$j]['pic_id']) : append_sid("album_showpage.$phpEx?pic_id=". $recentrow[$j]['pic_id']),
						'THUMBNAIL' => append_sid("album_thumbnail.$phpEx?pic_id=". $recentrow[$j]['pic_id']),
						'WIDTH' => $width,
						'HEIGHT' => $height,
						'DESC' => $recentrow[$j]['pic_desc'])
					);
	
					if( ($recentrow[$j]['user_id'] == ALBUM_GUEST) or ($recentrow[$j]['username'] == '') )
					{
						$recent_poster = ($recentrow[$j]['pic_username'] == '') ? $lang['Guest'] : $recentrow[$j]['pic_username'];
					}
					else
					{
						$recent_poster = '<a href="'. append_sid("profile.$phpEx?mode=viewprofile&amp;". POST_USERS_URL .'='. $recentrow[$j]['user_id']) .'">'. $recentrow[$j]['username'] .'</a>';
					}
	
					// Display pics vertically
					$template->assign_block_vars('recent_pics.recent_detail', array(
						'U_PIC' => ($album_config['fullpic_popup']) ? append_sid("album_pic.$phpEx?pic_id=". $recentrow[$j]['pic_id']) : append_sid("album_showpage.$phpEx?pic_id=". $recentrow[$j]['pic_id']),
						'THUMBNAIL' => append_sid("album_thumbnail.$phpEx?pic_id=". $recentrow[$j]['pic_id']),
						'WIDTH' => $width,
						'HEIGHT' => $height,
						'DESC' => $recentrow[$j]['pic_desc'],
						'TITLE' => $recentrow[$j]['pic_title'],
						'POSTER' => $recent_poster,
						'TIME' => create_date($board_config['default_dateformat'], $recentrow[$j]['pic_time'], $board_config['board_timezone']),
						'VIEW' => $recentrow[$j]['pic_view_count'],
						'RATING' => ($album_config['rate'] == 1) ? ( $lang['Rating'] . ': ' . $recentrow[$j]['rating'] . '<br />') : '',
						'COMMENTS' => ($album_config['comment'] == 1) ? ( $lang['Comments'] . ': ' . $recentrow[$j]['comments'] . '<br />') : '')
					);
				}
			}
		}
		else
		{
			// No Pics Found
			$template->assign_block_vars('no_pics', array());
		}
		$template->assign_block_vars('switch_album_pic', array());
	} 
}
// End add  - Photo Album Block
$alb_col = 0;
@$alb_col = (100/$album_config['cols_per_page']); 

$template->assign_vars(array(
	'WELCOME_TEXT' => $CFG['welcome_text'],
	'TOTAL_POSTS' => sprintf($l_total_post_s, $total_posts),
	'TOTAL_USERS' => sprintf($l_total_user_s, $total_users),
	'TOTAL_TOPICS' => sprintf($lang['total_topics'], $total_topics),
	'NEWEST_USER' => sprintf($lang['Newest_user'], '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=$newest_uid") . '">', $newest_user, '</a>'),
	'L_FORUM' => $lang['Forum'],
	// Start add - Birthday MOD
	'L_WHOSBIRTHDAY_WEEK' => ($board_config['birthday_check_day'] > 1) ? sprintf( (($birthday_week_list) ? $lang['Birthday_week'] : $lang['Nobirthday_week']), $board_config['birthday_check_day']).$birthday_week_list : '',
	'L_WHOSBIRTHDAY_TODAY' => ($board_config['birthday_check_day']) ? ($birthday_today_list) ? $lang['Birthday_today'].$birthday_today_list : $lang['Nobirthday_today'] : '',
	// End add - Birthday MOD
	'L_BOARD_NAVIGATION' => $lang['Board_navigation'],
	'L_STATISTICS' => $lang['Statistics'],	
	'L_ANNOUNCEMENT' => $lang['Post_Announcement'],
	'L_POSTED' => $lang['Posted'],
	'L_COMMENTS' => $lang['Comments'],
	'L_VIEW_COMMENTS' => $lang['View_comments'],
	'L_POST_COMMENT' => $lang['Post_your_comment'],
	'L_SEND_PASSWORD' => $lang['Forgotten_password'],
	'U_SEND_PASSWORD' => append_sid("profile.$phpEx?mode=sendpassword"),
	'L_REGISTER_NEW_ACCOUNT' => sprintf($lang['Register_new_account'], '<a href="' . append_sid("profile.$phpEx?mode=register") . '">', '</a>'),
	'L_REMEMBER_ME' => $lang['Remember_me'],
	'L_VIEW_COMPLETE_LIST' => $lang['View_complete_list'],
	'L_POLL' => $lang['Poll'],
	'L_VOTE_BUTTON' => $lang['Vote'],
	'L_RECENT_FILES' => $lang['Recent_files'],
	// Recent Topics
	'L_RECENT_TOPICS' => $lang['Recent_topics'],
	// Start add - Fully integrated shoutbox MOD
	'U_SHOUTBOX' => append_sid("shoutbox.$phpEx"),
	'L_SHOUTBOX' => $lang['Shoutbox'],
	'U_SHOUTBOX_MAX' => append_sid("shoutbox_max.$phpEx"),
	'U_FORUM' => append_sid("index.$phpEx"),
	'U_LINKS' => append_sid("links.$phpEx"),
	'U_CONTACT' => append_sid("kontakt.$phpEx"),
	// Start add - Last visit MOD
	'USERS_TODAY_LIST' => $users_today_list,
	'L_USERS_LASTHOUR' => $l_today_text,
	'L_USERS_TODAY' =>$l_today_users,
	// End add - Last visit MOD

	// End add - Fully integrated shoutbox MOD
	'S_COLS' => $plus_config['cols_per_page'],
	'S_COL_WIDTH' => (100/$plus_config['cols_per_page']) . '%',
	// Photo Album
	'L_NEWEST_PIC' => $lang['Newest_pic'],
	'PIC_IMAGE' => append_sid('album_thumbnail.'. $phpEx . '?pic_id=' . $picrow['pic_id']),
	'PIC_TITLE' => $picrow['pic_title'],
	'PIC_POSTER' => $picrow['pic_username'],
	'U_PIC_LINK' => append_sid('album_showpage.' . $phpEx . '?pic_id=' . $picrow['pic_id']),
	'PIC_TIME' => create_date($board_config['default_dateformat'], $picrow['pic_time'], $board_config['board_timezone']),
	// Start add - Photo Album Block
	'S_COLS1' => $album_config['cols_per_page'],
	'S_COL_WIDTH1' => $alb_col . '%',
	'TARGET_BLANK' => ($album_config['fullpic_popup']) ? 'target="_blank"' : '',
	'L_NEWEST_PICS' => $lang['Newest_pics'],
	'L_NO_PICS' => $lang['No_Pics'],
	'L_PIC_TITLE' => $lang['Pic_Title'],
	'L_VIEW' => $lang['View'],
	'L_POSTER' => $lang['Poster'],
	'L_POSTED' => $lang['Posted'],
	// End add - Photo Album Block

	// Portal News Additions
	'L_WORD_ON' => $lang['L_Word_on'],
	'L_WORD_BY' => $lang['L_Word_by'],
	'MINIPOST_IMG' => $images['icon_minipost'],
	'NEWS_PRINT_IMG' => $images['news_print'],
	'NEWS_EMAIL_IMG' => $images['news_email'],
	'NEWS_REPLY_IMG' => $images['news_reply'],
	'L_REPLY_NEWS' => $lang['News_Reply'],
	'L_PRINT_NEWS' => $lang['News_Print'],
	'L_EMAIL_NEWS' => $lang['News_Email'],
	'L_NEWS_CATEGORIES' => $lang['News_Categories'],
	'L_NEWS_ARCHIEVES' => $lang['News_Archieves'],
	'L_NEWS_SUMMARY' => $lang['News_Summary'],
	'L_NEWS_VIEWS' => $lang['News_Views'],
	'L_NEWS_AND' => $lang['News_And'],
	'L_NEWS_COMMENTS' => $lang['News_Comments'],
	'L_NEWS_CATS' => $lang['News_Cats'],
	'L_NO_NEWS_CATS' => $lang['No_News_Cats'],
	'L_ABOUT_US' => $lang['About_us'],
	'L_NAVIGATE' => $lang['Portal_Navigate'],
	'L_TOOLS' => $lang['Portal_Tools'],
	'L_LINKS' => $lang['Site_links'],
	'L_CONTACT' => $lang['Site_Contact'],
	'L_TOP_POSTERS' => $lang['Top_Posters'],
	'L_TOP_MEMBER' => $lang['Top_Member'],
	'L_TOP_POSTS' => $lang['Top_Posts'],
	'L_QUICK_SEARCH' => $lang['Quick_Search'],
	'L_ADV_SEARCH' => $lang['Advanced_Search'],
	'L_SHOUTBOX' => $lang['Shoutbox'],
	'L_SEARCH_NEW_P' => $lang['Search_new_p'],
	'L_SHOUTBOXMAX' => $lang['Shoutbox'],
	'U_SHOUTBOXMAX' => append_sid("shoutbox_max.$phpEx"),
	// Welcome Avatar
	'L_NAME_WELCOME' => $lang['Welcome'],
	'U_NAME_LINK' => $name_link,
	'L_LAST_SEEN' => $lang['Last_Seen'],
	'AVATAR_IMG' => $avatar_img)
);

// 
// Start Top Posters hack 
if ( $CFG['number_top_posters'] > 0 )
{
	$sql = "SELECT post_id FROM " . POSTS_TABLE . " ORDER BY post_id DESC LIMIT 1"; 
	$result = $db->sql_query($sql); 
	$row = $db->sql_fetchrow($result); 
	$db->sql_freeresult($result);
	$total_post_perc = $row['post_id']; 
	$perc_mult = 3; 
	$perc_mult_set = 0; 
	$rank = 0; 
	$sql = "SELECT user_id, username, user_posts FROM " . USERS_TABLE ." WHERE user_id <> -1 ORDER BY user_posts DESC LIMIT ".$CFG['number_top_posters']; 
	$result = $db->sql_query($sql); 
	while( $row = $db->sql_fetchrow($result)) { 
	   $rank++; 
	   $class = (!($rank % 2)) ? 'row2' : 'row1'; 
	   $percentage = (get_db_stat('postcount') != 0) ? round(100 * $row['user_posts'] / get_db_stat('postcount'),0) : 0; 
	   $bar_perc = round($percentage * $perc_mult,0); 
	   $template->assign_block_vars("users", array( 
		  'RANK' => $rank, 
		  'CLASS' => $class, 
		  'USERNAME' => color_group_colorize_name($row['user_id']),
		  'PERCENTAGE' => $percentage, 
		  'URL' => $phpbb_root_path . "profile.php?mode=viewprofile&u=" . $row['user_id'], 
		  'BAR' => $bar_perc, 
		  'POSTS' => $row['user_posts']) 
	   ); 
	} 
	$db->sql_freeresult($result);
	$template->assign_block_vars('switch_top_posters', array());
}
// End Top 5 Posters hack 
//

//\\ 
//\\ Start - vgan's Portal Poll Mod V. 2.0
//\\


// Set the vote graphic length to 100
// 	Note: If the bars look too long at %100, (only 1 vote) set this value lower.
// 	      Likewise, if it looks too short to you, increase it here.
$length = 65;

//  Get the poll forum from EZportal config above
if( $CFG['poll_forum'] > 0)
{
	$poll_forum = $CFG['poll_forum'];
	$template->assign_block_vars('PORTAL_POLL', array());

	$sql = 'SELECT
 		  t.*, vd.*
		FROM 
		  ' . TOPICS_TABLE . ' AS t,
		  ' . VOTE_DESC_TABLE . ' AS vd
		WHERE
		  t.forum_id IN (' . $poll_forum . ') AND
		  t.topic_status <> 1 AND
		  t.topic_status <> 2 AND
		  t.topic_vote = 1 AND
		  t.topic_id = vd.topic_id
		ORDER BY
		  t.topic_time DESC 
		LIMIT
		  0,1';


	if(!$result = $db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, "Couldn't obtain poll information.", "", __LINE__, __FILE__, $sql);
	}

	$total_polls = $db->sql_numrows($result);

	$pollrow = $db->sql_fetchrowset($result);
	$db->sql_freeresult($result);

	if ( $total_polls != 0 )
	{
	$topic_id = $pollrow[0]['topic_id'] ;

		$sql = "SELECT vd.vote_id, vd.vote_text, vd.vote_start, vd.vote_length, vr.vote_option_id, vr.vote_option_text, vr.vote_result
			FROM " . VOTE_DESC_TABLE . " vd, " . VOTE_RESULTS_TABLE . " vr
			WHERE vd.topic_id = $topic_id
				AND vr.vote_id = vd.vote_id
			ORDER BY vr.vote_option_id ASC";
		if( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, "Couldn't obtain vote data for this topic", "", __LINE__, __FILE__, $sql);
		}

		if( $vote_options = $db->sql_numrows($result) )
		{
			$vote_info = $db->sql_fetchrowset($result);

			$vote_id = $vote_info[0]['vote_id'];
			$vote_title = $vote_info[0]['vote_text'];

			$sql = "SELECT vote_id
				FROM " . VOTE_USERS_TABLE . "
				WHERE vote_id = $vote_id
					AND vote_user_id = " . $userdata['user_id'];
			if( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, "Couldn't obtain user vote data for this topic", "", __LINE__, __FILE__, $sql);
			}

			$user_voted = ( $db->sql_numrows($result) ) ? TRUE : 0;
			$db->sql_freeresult($result);

			if( isset($_GET['vote']) || isset($_POST['vote']) )
			{
				$view_result = ( ( ( isset($_GET['vote']) ) ? $_GET['vote'] : $_POST['vote'] ) == "viewresult" ) ? TRUE : 0;
			}
			else
			{
				$view_result = 0;
			}

			$poll_expired = ( $vote_info[0]['vote_length'] ) ? ( ( $vote_info[0]['vote_start'] + $vote_info[0]['vote_length'] < time() ) ? TRUE : 0 ) : 0;

			if( $user_voted || $view_result || $poll_expired || $forum_row['topic_status'] == TOPIC_LOCKED )
			{

				$template->set_filenames(array(
					"pollbox" => "portal_poll_result.tpl")
				);

				$vote_results_sum = 0;

				for($i = 0; $i < $vote_options; $i++)
				{
					$vote_results_sum += $vote_info[$i]['vote_result'];
				}

				$vote_graphic = 0;
				$vote_graphic_max = count($images['voting_graphic']);

				for($i = 0; $i < $vote_options; $i++)
				{
					$vote_percent = ( $vote_results_sum > 0 ) ? $vote_info[$i]['vote_result'] / $vote_results_sum : 0;
					$portal_vote_graphic_length = round($vote_percent * $length);

					$vote_graphic_img = $images['voting_graphic'][$vote_graphic];
					$vote_graphic = ($vote_graphic < $vote_graphic_max - 1) ? $vote_graphic + 1 : 0;

					if( count($orig_word) )
					{
						$vote_info[$i]['vote_option_text'] = preg_replace($orig_word, $replacement_word, $vote_info[$i]['vote_option_text']);
					}

					$template->assign_block_vars("poll_option", array(
						"POLL_OPTION_CAPTION" => $vote_info[$i]['vote_option_text'],
						"POLL_OPTION_RESULT" => $vote_info[$i]['vote_result'],
						"POLL_OPTION_PERCENT" => sprintf("%.1d%%", ($vote_percent * 100)),

						"POLL_OPTION_IMG" => $vote_graphic_img,
						"POLL_OPTION_IMG_WIDTH" => $portal_vote_graphic_length/1)
					);
				}

				$template->assign_vars(array(
					"L_TOTAL_VOTES" => $lang['Total_votes'],
					"TOTAL_VOTES" => $vote_results_sum,
					"L_VIEW_RESULTS" => $lang['View_results'], 
					"U_VIEW_RESULTS" => append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&postdays=$post_days&postorder=$post_order&vote=viewresult"))
				);

			}
			else
			{
				$template->set_filenames(array(
					"pollbox" => "portal_poll_ballot.tpl")
				);

				for($i = 0; $i < $vote_options; $i++)
				{
					if( count($orig_word) )
					{
						$vote_info[$i]['vote_option_text'] = preg_replace($orig_word, $replacement_word, $vote_info[$i]['vote_option_text']);
					}

					$template->assign_block_vars("poll_option", array(
						"POLL_OPTION_ID" => $vote_info[$i]['vote_option_id'],
						"POLL_OPTION_CAPTION" => $vote_info[$i]['vote_option_text'])		
					);
				}
				$template->assign_vars(array(
					"LOGIN_TO_VOTE" => '<b><a href="' . append_sid("login.$phpEx?redirect=portal.$phpEx") . '">' . $lang['Login_to_vote'] . '</a><b>')
				);

				$s_hidden_fields = '<input type="hidden" name="topic_id" value="' . $topic_id . '"><input type="hidden" name="mode" value="vote">';
			}

			if( count($orig_word) )
			{
				$vote_title = preg_replace($orig_word, $replacement_word, $vote_title);
			}

			$template->assign_vars(array(
				"POLL_QUESTION" => '<b>'.$vote_title.'</b>',
				"L_SUBMIT_VOTE" => '<input type="submit" name="submit" value="'.$lang['Submit_vote'].'" class="liteoption" />',
				"S_HIDDEN_FIELDS" => ( !empty($s_hidden_fields) ) ? $s_hidden_fields : "",
				"S_POLL_ACTION" => append_sid("posting.$phpEx?" . POST_TOPIC_URL . "=$topic_id"))
			);

			$template->assign_var_from_handle("PORTAL_POLL", "pollbox");
		}
}
	else
	{
		$template->set_filenames(array(
			"pollbox" => "portal_poll_ballot.tpl")
		);

		$template->assign_vars(array(
			"POLL_QUESTION" => $lang['No_poll'],
			"L_SUBMIT_VOTE" => '',
			"S_HIDDEN_FIELDS" => "",
			"S_POLL_ACTION" => '',
			"LOGIN_TO_VOTE" => '')
		);

		$template->assign_var_from_handle("PORTAL_POLL", "pollbox");
	}
	
}
//\\ 
//\\ End - vgan's Portal Poll Mod V. 2.0
//\\ 

if ( ($plus_config['show_shoutbox'] == 1 || $plus_config['show_shoutbox'] == 3 ) || ( ($plus_config['show_shoutbox'] == 2 || $plus_config['show_shoutbox'] == 4 ) && ( $userdata['session_user_id'] != ANONYMOUS ) ) )
{
        $template->assign_block_vars('switch_show_shoutbox', array());
}

include($phpbb_root_path . 'mods/netclectic/mini_cal/mini_cal.'.$phpEx); 

$template->assign_vars(array( 
"TELL_LINK" => append_sid("http://".$HTTP_SERVER_VARS['HTTP_HOST'].$HTTP_SERVER_VARS['PHP_SELF']."?t=$topic_id", true)));

$content = new NewsModule( $phpbb_root_path ); 

$content->setVariables( array( 
    'L_INDEX' => $lang['Index'], 
    'L_CATEGORIES' => $lang['Categories'], 
    'L_ARCHIVES' => $lang['Archives'] 
    ) ); 

if( (isset( $_GET['news']  ) && $_GET['news'] == 'categories')) 
{ 
	// View the news categories. 
	$data_access = new NewsDataAccess( $phpbb_root_path );
	$news_cats = $data_access->fetchCategories( );
	$template->assign_block_vars('news_categories', array());
	$cats = count($news_cats);
	
	if ($cats == 0)
	{
		$template->assign_block_vars('no_news', array());
	}
	
	for ($i = 0; $i < count($news_cats); $i += $plus_config['cols_per_page'])
	{
		if ($cats >0)
		{
			$template->assign_block_vars('newsrow', array());
		}
		for ($j = $i; $j < ($i + $plus_config['cols_per_page']); $j++)
		{
			if( $j >= count($news_cats) )
			{
				break;
			}
			$template->assign_block_vars('newsrow.newscol', array(
				'THUMBNAIL' => $N_this->root_path . 'templates/'.$theme['template_name'].'/images/news/' . $news_cats[$j]['news_image'],
				'ID' => $news_cats[$j]['news_id'],
				'DESC' => $news_cats[$j]['news_category'],
				)
			);	
			$template->assign_block_vars('newsrow.news_detail', array(
				'NEWSCAT' => $news_cats[$j]['news_category'],
				'CATEGORY' => $newsrow[$j]['news_category']
				)
			);
		}
	}			
} 
elseif( isset( $_GET['news']  ) && $_GET['news'] == 'archives' ) 
{ 
  // View the news Archives. 
  $year   = (isset( $_GET['year'] )) ? intval($_GET['year']) : 0; 
  $month  = (isset( $_GET['month'] )) ? intval($_GET['month']) : 0; 
  $day    = (isset( $_GET['day'] )) ? intval($_GET['day']) : 0; 
  $key    = (isset( $_GET['key'] )) ? $_GET['key'] : ''; 
  
  $template->assign_block_vars('news_archives', array());
  $content->setVariables( array( 'TITLE' => $lang['News'] . ' ' . $lang['Archives'] ) ); 
  $content->renderArchives( $year, $month, $day, $key ); 
  
} 
elseif (isset ($_GET['topic_id']) || $_GET['cat_id'])
{
	$topic_id = 0; 
  if( isset( $_GET['topic_id'] ) ) 
  { 
    $topic_id = intval($_GET['topic_id']); 
  } 
  elseif( isset( $_GET['news_id'] ) ) 
  { 
    $topic_id = intval($_GET['news_id']); 
  }
  
  $content->setVariables( array( 'TITLE' => $lang['News'] . ' ' . $lang['Articles'] ) ); 
  $content->renderArticles( $topic_id ); 
}
else 
{ 
  // View news articles. 
  $topic_id = 0; 
  if( isset( $_GET['topic_id'] ) ) 
  { 
    $topic_id = intval($_GET['topic_id']); 
  } 
  elseif( isset( $_GET['news_id'] ) ) 
  { 
    $topic_id = intval($_GET['news_id']); 
  } 
  $template->assign_block_vars('welcome_text', array());
  $content->setVariables( array( 'TITLE' => $lang['News'] . ' ' . $lang['Articles'] ) ); 
  $content->renderArticles( $topic_id ); 
} 

$content->renderPagination( ); 

$content->display( ); 
$content->clear( ); 

//
// Generate the page
//

include($phpbb_root_path . 'includes/page_tail.'.$phpEx);

?>

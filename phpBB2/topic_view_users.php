<?php
/***************************************************************************
 *                              memberlist.php
 *                            -------------------
 *   begin                : Friday, May 11, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: memberlist.php,v 1.36.2.8 2003/06/09 13:06:19 psotfx Exp $
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

define('IN_PHPBB', true);
$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);
include_once($phpbb_root_path.'includes/functions_color_groups.'.$phpEx);

// Start add - Who viewed a topic MOD
if ( isset($_GET[POST_TOPIC_URL]) )
{
	$topic_id = intval($_GET[POST_TOPIC_URL]);
}
else if ( isset($_POST[POST_TOPIC_URL]) )
{
	$topic_id = intval($_POST[POST_TOPIC_URL]);
}
else
	message_die(GENERAL_MESSAGE, 'Topic_post_not_exist');

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_TOPIC_VIEW, $topic_id);
init_userprefs($userdata);
//
// End session management
//
if ( !$userdata['session_logged_in'] ) 
{ 
	redirect(append_sid("login.$phpEx?redirect=topic_view_users.$phpEx&" . POST_TOPIC_URL . "=$topic_id", true));
}

// find the forum, in witch the topic are located
$sql = "SELECT f.forum_id 
	FROM " . TOPICS_TABLE . " t, " . FORUMS_TABLE . " f  
	WHERE f.forum_id = t.forum_id AND t.topic_id=$topic_id";
if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, "Could not obtain topic information", '', __LINE__, __FILE__, $sql);
}

if ( !($forum_topic_data = $db->sql_fetchrow($result)) )
{
	message_die(GENERAL_MESSAGE, 'Topic_post_not_exist');
}
$forum_id = $forum_topic_data['forum_id'];
// End add - Who viewed a topic MOD


$start = ( isset($_GET['start']) ) ? intval($_GET['start']) : 0;

if ( isset($_GET['mode']) || isset($_POST['mode']) )
{
	$mode = ( isset($_POST['mode']) ) ? htmlspecialchars($_POST['mode']) : htmlspecialchars($_GET['mode']);
}
else
{
	$mode = 'joined';
}

if(isset($_POST['order']))
{
	$sort_order = ($_POST['order'] == 'ASC') ? 'ASC' : 'DESC';
}
else if(isset($_GET['order']))
{
	$sort_order = ($_GET['order'] == 'ASC') ? 'ASC' : 'DESC';
}
else
{
	$sort_order = 'ASC';
}

//
// Memberlist sorting
//

// Start Replacement - Who viewed a topic MOD
$mode_types_text = array($lang['Sort_Username'], $lang['Sort_Email'], $lang['Sort_Joined'], $lang['Topic_time'], $lang['Topic_count'], $lang['Sort_Website'], $lang['Sort_Top_Ten']);
$mode_types = array('username', 'email', 'joined', 'topic_time', 'topic_count', 'website', 'topten');
// End Replacement - Who viewed a topic MOD

$select_sort_mode = '<select name="mode">';
for($i = 0; $i < count($mode_types_text); $i++)
{
	$selected = ( $mode == $mode_types[$i] ) ? ' selected="selected"' : '';
	$select_sort_mode .= '<option value="' . $mode_types[$i] . '"' . $selected . '>' . $mode_types_text[$i] . '</option>';
}
$select_sort_mode .= '</select>';

$select_sort_order = '<select name="order">';
if($sort_order == 'ASC')
{
	$select_sort_order .= '<option value="ASC" selected="selected">' . $lang['Sort_Ascending'] . '</option><option value="DESC">' . $lang['Sort_Descending'] . '</option>';
}
else
{
	$select_sort_order .= '<option value="ASC">' . $lang['Sort_Ascending'] . '</option><option value="DESC" selected="selected">' . $lang['Sort_Descending'] . '</option>';
}
$select_sort_order .= '</select>';

// Start add - Who viewed a topic MOD
$select_sort_order .= '<input type="hidden" name="'.POST_TOPIC_URL.'" value="'.$topic_id.'"/>';
// End add - Who viewed a topic MOD


//
// Generate page
//
$page_title = $lang['Memberlist'];
include($phpbb_root_path . 'includes/page_header.'.$phpEx);

$template->set_filenames(array(
	'body' => 'topic_view_body.tpl')
);
make_jumpbox('viewforum.'.$phpEx);

$template->assign_vars(array(
	'L_SELECT_SORT_METHOD' => $lang['Select_sort_method'],
	'L_EMAIL' => $lang['Email'],
	'L_WEBSITE' => $lang['Website'],
	// Start replacement - Who viewed a topic MOD
	'L_FROM' => $lang['Joined'],
	'L_LOGON' => $lang['Location'],
	// End replacement - Who viewed a topic MOD
	'L_ORDER' => $lang['Order'],
	'L_SORT' => $lang['Sort'],
	'L_SUBMIT' => $lang['Sort'],
	'L_AIM' => $lang['AIM'],
	'L_YIM' => $lang['YIM'],
	'L_MSNM' => $lang['MSNM'],
	'L_ICQ' => $lang['ICQ'], 
	'L_ON_OFF_STATUS' => $lang['On_off_status'],
	// Start replacement - Who viewed a topic MOD
	'L_JOINED' => $lang['Topic_time'],
	'L_POSTS' => $lang['Topic_count'], 
	// End replacement - Who viewed a topic MOD
	'L_PM' => $lang['Private_Message'], 
	
	'S_MODE_SELECT' => $select_sort_mode,
	'S_ORDER_SELECT' => $select_sort_order,
	// Start replacement - Who viewed a topic MOD
	'S_MODE_ACTION' => append_sid("topic_view_users.$phpEx"))
	// End replacement - Who viewed a topic MOD

);

switch( $mode )
{

// Start replacement - Who viewed a topic MOD
case 'joined':
	$order_by = "u.user_regdate $sort_order LIMIT $start, " . $board_config['topics_per_page'];
	break;
case 'username':
	$order_by = "u.username $sort_order LIMIT $start, " . $board_config['topics_per_page'];
	break;
case 'topic_count':
	$order_by = "tv.view_count $sort_order LIMIT $start, " . $board_config['topics_per_page'];
	break;
case 'topic_time':
	$order_by = "tv.view_time $sort_order LIMIT $start, " . $board_config['topics_per_page'];
	break;
case 'email':
	$order_by = "u.user_email $sort_order LIMIT $start, " . $board_config['topics_per_page'];
	break;
case 'website':
	$order_by = "u.user_website $sort_order LIMIT $start, " . $board_config['topics_per_page'];
	break;
case 'topten':
	$order_by = "u.user_posts $sort_order LIMIT 10";
	break;
default:
	$order_by = "u.user_regdate $sort_order LIMIT $start, " . $board_config['topics_per_page'];
	break;
// End replacement - Who viewed a topic MOD

}


// Start replacement - Who viewed a topic MOD & Admin/mod colors management MOD
$sql = "SELECT u.username, u.user_id, u.user_level, u.user_viewemail, u.user_posts, u.user_regdate, u.user_from, u.user_website, u.user_email, u.user_icq, u.user_aim, u.user_yim, u.user_msnm, u.user_avatar, u.user_avatar_type, u.user_allowavatar, u.user_allow_viewonline, u.user_session_time, tv.view_time, tv.view_count
	FROM " . USERS_TABLE . " u, " . TOPIC_VIEW_TABLE . " tv 
	WHERE u.user_id = tv.user_id AND tv.topic_id= " . $topic_id . "
	ORDER BY $order_by";
// End replacement - Who viewed a topic MOD & Admin/mod colors management MOD

if( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Could not query users', '', __LINE__, __FILE__, $sql);
}

if ( $row = $db->sql_fetchrow($result) )
{
	$i = 0;
	do
	{
		$username = $row['username'];
		$user_id = $row['user_id'];

		$from = ( !empty($row['user_from']) ) ? $row['user_from'] : '&nbsp;';
		$joined = create_date($lang['DATE_FORMAT'], $row['user_regdate'], $board_config['board_timezone']);

		// Start replacement - Who viewed a topic MOD
		$topic_time = ( $row['view_time'] ) ? create_date($board_config['default_dateformat'],$row['view_time'], $board_config['board_timezone']) : $lang['Never_last_logon'];
		$view_count = ( $row['view_count'] ) ? $row['view_count']:'';
		// End replacement - Who viewed a topic MOD


		$poster_avatar = '';
		if ( $row['user_avatar_type'] && $user_id != ANONYMOUS && $row['user_allowavatar'] )
		{
			switch( $row['user_avatar_type'] )
			{
				case USER_AVATAR_UPLOAD:
					$poster_avatar = ( $board_config['allow_avatar_upload'] ) ? '<img src="' . $board_config['avatar_path'] . '/' . $row['user_avatar'] . '" alt="" border="0" />' : '';
					break;
				case USER_AVATAR_REMOTE:
					$poster_avatar = ( $board_config['allow_avatar_remote'] ) ? '<img src="' . $row['user_avatar'] . '" alt="" border="0" />' : '';
					break;
				case USER_AVATAR_GALLERY:
					$poster_avatar = ( $board_config['allow_avatar_local'] ) ? '<img src="' . $board_config['avatar_gallery_path'] . '/' . $row['user_avatar'] . '" alt="" border="0" />' : '';
					break;
			}
		}

		if ( !empty($row['user_viewemail']) || $userdata['user_level'] == ADMIN )
		{
			$email_uri = ( $board_config['board_email_form'] ) ? append_sid("profile.$phpEx?mode=email&amp;" . POST_USERS_URL .'=' . $user_id) : 'mailto:' . $row['user_email'];

			$email_img = '<a href="' . $email_uri . '"><img src="' . $images['icon_email'] . '" alt="' . $lang['Send_email'] . '" title="' . $lang['Send_email'] . '" border="0" /></a>';
			$email = '<a href="' . $email_uri . '">' . $lang['Send_email'] . '</a>';
		}
		else
		{
			$email_img = '&nbsp;';
			$email = '&nbsp;';
		}

		$temp_url = append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=$user_id");
		$profile_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_profile'] . '" alt="' . $lang['Read_profile'] . '" title="' . $lang['Read_profile'] . '" border="0" /></a>';
		$profile = '<a href="' . $temp_url . '">' . $lang['Read_profile'] . '</a>';

		$temp_url = append_sid("privmsg.$phpEx?mode=post&amp;" . POST_USERS_URL . "=$user_id");
		$pm_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_pm'] . '" alt="' . $lang['Send_private_message'] . '" title="' . $lang['Send_private_message'] . '" border="0" /></a>';
		$pm = '<a href="' . $temp_url . '">' . $lang['Send_private_message'] . '</a>';

		$www_img = ( $row['user_website'] ) ? '<a href="' . $row['user_website'] . '" target="_userwww"><img src="' . $images['icon_www'] . '" alt="' . $lang['Visit_website'] . '" title="' . $lang['Visit_website'] . '" border="0" /></a>' : '';
		$www = ( $row['user_website'] ) ? '<a href="' . $row['user_website'] . '" target="_userwww">' . $lang['Visit_website'] . '</a>' : '';

		if ( !empty($row['user_icq']) )
		{
			$icq_status_img = '<a href="http://wwp.icq.com/' . $row['user_icq'] . '#pager"><img src="http://web.icq.com/whitepages/online?icq=' . $row['user_icq'] . '&img=5" width="18" height="18" border="0" /></a>';
			$icq_img = '<a href="http://wwp.icq.com/scripts/search.dll?to=' . $row['user_icq'] . '"><img src="' . $images['icon_icq'] . '" alt="' . $lang['ICQ'] . '" title="' . $lang['ICQ'] . '" border="0" /></a>';
			$icq =  '<a href="http://wwp.icq.com/scripts/search.dll?to=' . $row['user_icq'] . '">' . $lang['ICQ'] . '</a>';
		}
		else
		{
			$icq_status_img = '';
			$icq_img = '';
			$icq = '';
		}

		$aim_img = ( $row['user_aim'] ) ? '<a href="aim:goim?screenname=' . $row['user_aim'] . '&amp;message=Hello+Are+you+there?"><img src="' . $images['icon_aim'] . '" alt="' . $lang['AIM'] . '" title="' . $lang['AIM'] . '" border="0" /></a>' : '';
		$aim = ( $row['user_aim'] ) ? '<a href="aim:goim?screenname=' . $row['user_aim'] . '&amp;message=Hello+Are+you+there?">' . $lang['AIM'] . '</a>' : '';

		$temp_url = append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=$user_id");
		$msn_img = ( $row['user_msnm'] ) ? '<a href="' . $temp_url . '"><img src="' . $images['icon_msnm'] . '" alt="' . $lang['MSNM'] . '" title="' . $lang['MSNM'] . '" border="0" /></a>' : '';
		$msn = ( $row['user_msnm'] ) ? '<a href="' . $temp_url . '">' . $lang['MSNM'] . '</a>' : '';

		$yim_img = ( $row['user_yim'] ) ? '<a href="http://edit.yahoo.com/config/send_webmesg?.target=' . $row['user_yim'] . '&amp;.src=pg"><img src="' . $images['icon_yim'] . '" alt="' . $lang['YIM'] . '" title="' . $lang['YIM'] . '" border="0" /></a>' : '';
		$yim = ( $row['user_yim'] ) ? '<a href="http://edit.yahoo.com/config/send_webmesg?.target=' . $row['user_yim'] . '&amp;.src=pg">' . $lang['YIM'] . '</a>' : '';

		$temp_url = append_sid("search.$phpEx?search_author=" . urlencode($username) . "&amp;showresults=posts");
		$search_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_search'] . '" alt="' . $lang['Search_user_posts'] . '" title="' . $lang['Search_user_posts'] . '" border="0" /></a>';
		$search = '<a href="' . $temp_url . '">' . $lang['Search_user_posts'] . '</a>';
		$temp_url = append_sid("album.$phpEx?user_id=$user_id");
		$gallery_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_gallery'] . '" alt="' . sprintf($lang['Personal_Gallery_Of_User'], $row['username']) . '" title="' . sprintf($lang['Personal_Gallery_Of_User'], $row['username']) . '" border="0" /></a>';
		$gallery = '<a href="' . $temp_url . '">' . $lang['Album'] . '</a>';
		$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
		$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];
		
		//Online/Offline
		if (($row['user_session_time'] >= ( time() - 300 )) && ($row['user_allow_viewonline']))
		{
			$on_off_hidden = '<img src="' . $images['icon_online'] . '" alt="' . $lang['Online'] . '" title="' . $lang['Online'] . '" border="0" />';
		}
		else if (($row['user_allow_viewonline']) == 0)
		{
			$on_off_hidden = '<img src="' . $images['icon_hidden'] . '" alt="' . $lang['Hidden'] . '" title="' . $lang['Hidden'] . '" border="0" />';
		}
		else
		{
			$on_off_hidden = '<img src="' . $images['icon_offline'] . '" alt="' . $lang['Offline'] . '" title="' . $lang['Offline'] . '" border="0" />';
		}

		$template->assign_block_vars('memberrow', array(
			'ROW_NUMBER' => $i + ( $_GET['start'] + 1 ),
			'ROW_COLOR' => '#' . $row_color,
			'ROW_CLASS' => $row_class,
			'USERNAME' => color_group_colorize_name($user_id, true),

			// Start replacement - Who viewed a topic MOD
			'FROM' => $joined,
			'LAST_LOGON' => $from,
			'JOINED' => $topic_time,
			'POSTS' => $view_count,
			// End replacement - Who viewed a topic MOD
			'USER_ONLINE' => ($user_id == ANONYMOUS) ? '' : $on_off_hidden,
			'AVATAR_IMG' => $poster_avatar,
			'PROFILE_IMG' => $profile_img, 
			'PROFILE' => $profile, 
			'SEARCH_IMG' => $search_img,
			'SEARCH' => $search,
			'PM_IMG' => ($user_id == ANONYMOUS) ? '' : $pm_img,
			'PM' => $pm,
			'EMAIL_IMG' => ($user_id == ANONYMOUS) ? '' : $email_img,
			'EMAIL' => $email,
			'WWW_IMG' => $www_img,
			'WWW' => $www,
			'ICQ_STATUS_IMG' => $icq_status_img,
			'ICQ_IMG' => $icq_img, 
			'ICQ' => $icq, 
			'AIM_IMG' => $aim_img,
			'AIM' => $aim,
			'MSN_IMG' => $msn_img,
			'MSN' => $msn,
			'YIM_IMG' => $yim_img,
			'YIM' => $yim,
			'GALLERY_IMG' => ($user_id == ANONYMOUS) ? '' : $gallery_img,
			'GALLERY' => $gallery,

			'U_VIEWPROFILE' => ($user_id == ANONYMOUS) ? $username : color_group_colorize_name($user_id, false))                                                 
		);

		$i++;
	}
	while ( $row = $db->sql_fetchrow($result) );
}

if ( $mode != 'topten' || $board_config['topics_per_page'] < 10 )
{

// Start replacement - Who viewed a topic MOD
	$sql = "SELECT count(*) AS total
		FROM " . TOPIC_VIEW_TABLE . "
		WHERE topic_id = " . $topic_id;
// End replacement - Who viewed a topic MOD
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Error getting total users', '', __LINE__, __FILE__, $sql);
	}

	if ( $total = $db->sql_fetchrow($result) )
	{
		$total_members = $total['total'];
		// Start replacement - Who viewed a topic MOD
		$pagination = generate_pagination("topic_view_users.$phpEx?".POST_TOPIC_URL."=$topic_id&amp;mode=$mode&amp;order=$sort_order", $total_members, $board_config['topics_per_page'], $start). '&nbsp;';
		// End replacement - Who viewed a topic MOD
	}
}
else
{
	$pagination = '&nbsp;';
	$total_members = 10;
}

$template->assign_vars(array(
	'PAGINATION' => $pagination,
	'PAGE_NUMBER' => sprintf($lang['Page_of'], ( floor( $start / $board_config['topics_per_page'] ) + 1 ), ceil( $total_members / $board_config['topics_per_page'] )), 

	'L_GOTO_PAGE' => $lang['Goto_page'])
);

$template->pparse('body');

include($phpbb_root_path . 'includes/page_tail.'.$phpEx);

?>
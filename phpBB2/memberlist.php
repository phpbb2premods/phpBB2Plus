<?php
/***************************************************************************
 *                              memberlist.php
 *                            -------------------
 *   begin                : Friday, May 11, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: memberlist.php,v 1.36.2.9 2004/03/01 15:56:52 psotfx Exp $
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
include_once($phpbb_root_path . 'includes/functions_profile_fields.'.$phpEx);

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_VIEWMEMBERS);
init_userprefs($userdata);
//
// End session management
//

$start = ( isset($_GET['start']) ) ? intval($_GET['start']) : 0;
$start = ($start < 0) ? 0 : $start;

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
$mode_types_text = array($lang['Sort_Joined'], $lang['Last_logon'], $lang['Sort_Username'], $lang['Sort_Location'], $lang['Sort_Posts'], $lang['Sort_Email'],  $lang['Sort_Website'], $lang['Sort_Top_Ten']);
$mode_types = array('joined', 'lastlogon', 'username', 'location', 'posts', 'email', 'website', 'topten');

$select_sort_mode = '<select name="mode">';
for($i = ($userdata['user_level'] == ADMIN ) ? 0:1; $i < count($mode_types_text); $i++)
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

//
// Generate page
//
$page_title = $lang['Memberlist'];
include($phpbb_root_path . 'includes/page_header.'.$phpEx);

$template->set_filenames(array(
	'body' => 'memberlist_body.tpl')
);
make_jumpbox('viewforum.'.$phpEx);

$template->assign_vars(array(
	'L_SELECT_SORT_METHOD' => $lang['Select_sort_method'],
	'L_EMAIL' => $lang['Email'],
	'L_WEBSITE' => $lang['Website'],
	'L_FROM' => $lang['Location'],
	'L_ORDER' => $lang['Order'],
	'L_SORT' => $lang['Sort'],
	'L_SUBMIT' => $lang['Sort'],
	'L_AIM' => $lang['AIM'],
	'L_YIM' => $lang['YIM'],
	'L_MSNM' => $lang['MSNM'],
	'L_ICQ' => $lang['ICQ'], 
	'L_JOINED' => $lang['Joined'], 
	// Start add - Last visit MOD
	'L_LOGON' => $lang['Last_logon'], 
	// End add - Last visit MOD
	'L_POSTS' => $lang['Posts'], 
	'L_PM' => $lang['Private_Message'], 
	'L_ON_OFF_STATUS' => $lang['On_off_status'],

	'S_MODE_SELECT' => $select_sort_mode,
	'S_ORDER_SELECT' => $select_sort_order,
	'S_MODE_ACTION' => append_sid("memberlist.$phpEx"))
);

switch( $mode )
{
	case 'joined':
		$order_by = "user_regdate $sort_order LIMIT $start, " . $board_config['topics_per_page'];
		break;
	// Start add - Last visit MOD
	case 'lastlogon': 
   		$order_by = ($userdata['user_level'] == ADMIN ) ? "user_lastlogon $sort_order LIMIT $start, " . $board_config['topics_per_page'] : "username $sort_order LIMIT $start, " . $board_config['topics_per_page']; 
   		break; 
	// End add - Last visit MOD	
	case 'username':
		$order_by = "username $sort_order LIMIT $start, " . $board_config['topics_per_page'];
		break;
	case 'location':
		$order_by = "user_from $sort_order LIMIT $start, " . $board_config['topics_per_page'];
		break;
	case 'posts':
		$order_by = "user_posts $sort_order LIMIT $start, " . $board_config['topics_per_page'];
		break;
	case 'email':
		$order_by = "user_email $sort_order LIMIT $start, " . $board_config['topics_per_page'];
		break;
	case 'website':
		$order_by = "user_website $sort_order LIMIT $start, " . $board_config['topics_per_page'];
		break;
	case 'topten':
		$order_by = "user_posts $sort_order LIMIT 10";
		break;
	default:
		$order_by = "user_regdate $sort_order LIMIT $start, " . $board_config['topics_per_page'];
		break;
}
// Custom Profile Fields MOD
$profile_data = get_fields('WHERE view_in_memberlist = ' . VIEW_IN_MEMBERLIST . ' AND users_can_view = ' . ALLOW_VIEW);
$profile_data_sql = get_udata_txt($profile_data);
// END Custom Profile Fields MOD

$sql = "SELECT username, user_absence, user_absence_mode, user_id, user_viewemail, user_posts, user_regdate, user_lastlogon, user_allow_viewonline, user_from, user_from_flag, user_website, user_email, user_icq, user_aim, user_yim, user_msnm, user_avatar, user_avatar_type, user_allowavatar, user_allow_viewonline, user_session_time".$profile_data_sql." 
	FROM " . USERS_TABLE . "
	WHERE user_id <> " . ANONYMOUS . "
	ORDER BY $order_by";
if( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Could not query users', '', __LINE__, __FILE__, $sql);
}

if ( $row = $db->sql_fetchrow($result) )
{
	//
	// Custom Profile Fields MOD
	//
	foreach($profile_data as $field)
		$template->assign_block_vars('custom_field_names',array('FIELD_NAME' => $field['field_name']));
	
	$template->assign_vars(array('NUMCOLS' => count($profile_data)+11));
	//
	// END Custom Profile Fields MOD
	//
	$i = 0;
	do
	{
		$username = $row['username'];
		$user_id = $row['user_id'];

		$from = ( !empty($row['user_from']) ) ? $row['user_from'] : '&nbsp;';
		// FLAGHACK-start
		$flag = ( !empty($row['user_from_flag']) ) ? "&nbsp;<img src=\"images/flags/" . $row['user_from_flag'] . "\" alt=\"" . $row['user_from_flag'] . "\">" : '&nbsp;<img src="images/flags/blank.gif" alt="">';
		// FLAGHACK-end
		$joined = create_date($lang['DATE_FORMAT'], $row['user_regdate'], $board_config['board_timezone']);
		$posts = ( $row['user_posts'] ) ? $row['user_posts'] : 0;

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
		$search_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_search'] . '" alt="' . sprintf($lang['Search_user_posts'], $username) . '" title="' . sprintf($lang['Search_user_posts'], $username) . '" border="0" /></a>';
		$search = '<a href="' . $temp_url . '">' . sprintf($lang['Search_user_posts'], $username) . '</a>';
		// Photo Album Link MOD - Daz - ForumImages.com - START
		$temp_url = append_sid("album.$phpEx?user_id=$user_id");
		$gallery_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_gallery'] . '" alt="' . sprintf($lang['Personal_Gallery_Of_User'], $row['username']) . '" title="' . sprintf($lang['Personal_Gallery_Of_User'], $row['username']) . '" border="0" /></a>';
		$gallery = '<a href="' . $temp_url . '">' . $lang['Album'] . '</a>';
		// Photo Album Link MOD - Daz - ForumImages.com - END 
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
		if ( $row['user_absence'] == TRUE )
		{
			$absence_mode = create_absence_mode($row['user_absence_mode'], $pm_img, $pm, $email_img, $email, $nothing, 2);
		}
		$template->assign_block_vars('memberrow', array(
			'ROW_NUMBER' => $i + ( $start + 1 ) . (($userdata['user_level']==ADMIN)?'<a href="' . append_sid("delete_users.$phpEx?mode=user_id&amp;del_user=$user_id") . '"><img src="' . $images['icon_delpost'] . '" alt="' . $lang['Delete'] . ' '.$username.'" title="' . $lang['Delete'] . ' '.$username.'" border="0" /></a>&nbsp;':''),
			'ROW_COLOR' => '#' . $row_color,
			'ROW_CLASS' => $row_class,
			'USERNAME' => color_group_colorize_name($user_id, true),
			'FROM' => $from,
			// FLAGHACK-start
			'FLAG' => $flag,
			// FLAGHACK-end
			'JOINED' => $joined,
			// Start add - Last visit MOD
			'LAST_LOGON' => ($userdata['user_level'] == ADMIN || (!$board_config['hidde_last_logon'] && $row['user_allow_viewonline'])) ? (($row['user_lastlogon'])? create_date($board_config['default_dateformat'], $row['user_lastlogon'], $board_config['board_timezone']):$lang['Never_last_logon']):$lang['Hidde_last_logon'],
			// End add - Last visit MOD
			'POSTS' => $posts,
			'AVATAR_IMG' => $poster_avatar,
			'PROFILE_IMG' => $profile_img, 
			'PROFILE' => $profile, 
			'SEARCH_IMG' => $search_img,
			'SEARCH' => $search,
			'PM_IMG' => $pm_img,
			'PM' => $pm,
			'EMAIL_IMG' => $email_img,
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
			// Photo Album Link MOD - Daz - ForumImages.com - START
			'GALLERY_IMG' => $gallery_img,
			'GALLERY' => $gallery,
			// Photo Album Link MOD - Daz - ForumImages.com - END 
			'USER_ONLINE' => $on_off_hidden,
			'U_VIEWPROFILE' => append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=$user_id"))
		);
		//
		// Custom Profile Fields MOD
		//
		foreach($profile_data as $field)
		{
		  $name = text_to_column($field['field_name']);
		  $val = displayable_field_data($row[$name],$field['field_type']);
		  
		  $template->assign_block_vars('memberrow.custom_fields',array('CUSTOM_FIELD' => $val));
		}
		//
		// END Custom Profile Fields MOD
		//

		$i++;
	}
	while ( $row = $db->sql_fetchrow($result) );
	$db->sql_freeresult($result);
}

if ( $mode != 'topten' || $board_config['topics_per_page'] < 10 )
{
	$sql = "SELECT count(*) AS total
		FROM " . USERS_TABLE . "
		WHERE user_id <> " . ANONYMOUS;

	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Error getting total users', '', __LINE__, __FILE__, $sql);
	}

	if ( $total = $db->sql_fetchrow($result) )
	{
		$total_members = $total['total'];

		$pagination = generate_pagination("memberlist.$phpEx?mode=$mode&amp;order=$sort_order", $total_members, $board_config['topics_per_page'], $start). '&nbsp;';
	}
	$db->sql_freeresult($result);
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
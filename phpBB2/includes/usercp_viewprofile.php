<?php
/***************************************************************************
 *                           usercp_viewprofile.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: usercp_viewprofile.php,v 1.5.2.1 2003/02/25 23:28:30 acydburn Exp $
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

if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
	exit;
}

if ( empty($_GET[POST_USERS_URL]) || $_GET[POST_USERS_URL] == ANONYMOUS )
{
	message_die(GENERAL_MESSAGE, $lang['No_user_id_specified']);
}
$profiledata = get_userdata($_GET[POST_USERS_URL]);
if (!$profiledata)
{
	message_die(GENERAL_MESSAGE, $lang['No_user_id_specified']);
}
$sql = "SELECT *
	FROM " . RANKS_TABLE . "
	ORDER BY rank_special, rank_min";
if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Could not obtain ranks information', '', __LINE__, __FILE__, $sql);
}
$ranksrow = array();
while ( $row = $db->sql_fetchrow($result) )
{
	$ranksrow[] = $row;
}
$db->sql_freeresult($result);

//
// Output page header and profile_view template
//
$template->set_filenames(array(
	'body' => 'profile_view_body.tpl')
);
make_jumpbox('viewforum.'.$phpEx);

//
// Calculate the number of days this user has been a member ($memberdays)
// Then calculate their posts per day
//
$regdate = $profiledata['user_regdate'];
$memberdays = max(1, round( ( time() - $regdate ) / 86400 ));
$posts_per_day = $profiledata['user_posts'] / $memberdays;

// Get the users percentage of total posts
if ( $profiledata['user_posts'] != 0  )
{
	$total_posts = get_db_stat('postcount');
	$percentage = ( $total_posts ) ? min(100, ($profiledata['user_posts'] / $total_posts) * 100) : 0;
}
else
{
	$percentage = 0;
}
//--- Album Category Hierarchy : begin
//--- Version : 1.2.0
$sql = 'SELECT count(*) AS pic_total
			FROM ' . ALBUM_CAT_TABLE . ' AS c, ' . ALBUM_TABLE . ' AS p
			WHERE c.cat_user_id = ' . $profiledata['user_id'] .'
			AND p.pic_cat_id = c.cat_id';

if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Could not obtain ranks information', '', __LINE__, __FILE__, $sql);
}

if ( $row = $db->sql_fetchrow($result) )
{
	$totalpicrow = $row;
}
$db->sql_freeresult($result);

//--- version 1.3.0
$language = $board_config['default_lang'];
if ( !file_exists($phpbb_root_path . 'language/lang_' . $language . '/lang_main_album.'.$phpEx) )
{
	$language = 'english';
}
include($phpbb_root_path . 'language/lang_' . $language . '/lang_main_album.' . $phpEx);

$album_config = array();
$sql = 'SELECT * FROM '. ALBUM_CONFIG_TABLE . ' WHERE config_name = \'show_all_in_personal_gallery\' LIMIT 1';
if(!$result = $db->sql_query($sql))
{
	message_die(GENERAL_ERROR, "Could not query Album config information", "", __LINE__, __FILE__, $sql);
}
$row = $db->sql_fetchrow($result);
$album_config[$row['config_name']] = $row['config_value'];
$db->sql_freeresult($result);
//--- Album Category Hierarchy : end

$avatar_img = '';
if ( $profiledata['user_avatar_type'] && $profiledata['user_allowavatar'] )
{
	switch( $profiledata['user_avatar_type'] )
	{
		case USER_AVATAR_UPLOAD:
			$size = check_avatar_size($board_config['avatar_path'] . '/' . $profiledata['user_avatar'], $board_config['avatar_max_width']);
			$avatar_img = ( $board_config['allow_avatar_upload'] ) ? '<img src="' . $board_config['avatar_path'] . '/' . $profiledata['user_avatar'] . '" '.$size.' alt="" border="0" />' : '';
			break;
		case USER_AVATAR_REMOTE:
			$size = check_avatar_size($profiledata['user_avatar'], $board_config['avatar_max_width']);
			$avatar_img = ( $board_config['allow_avatar_remote'] ) ? '<img src="' . $profiledata['user_avatar'] . '" '.$size.' alt="" border="0" />' : '';
			break;
		case USER_AVATAR_GALLERY:
			$size = check_avatar_size($board_config['avatar_gallery_path'] . '/' . $profiledata['user_avatar'], $board_config['avatar_max_width']);
			$avatar_img = ( $board_config['allow_avatar_local'] ) ? '<img src="' . $board_config['avatar_gallery_path'] . '/' . $profiledata['user_avatar'] . '" '.$size.' alt="" border="0" />' : '';
			break;
	}
}

$poster_rank = '';
$rank_image = '';
if ( $profiledata['user_rank'] )
{
	for($i = 0; $i < count($ranksrow); $i++)
	{
		if ( $profiledata['user_rank'] == $ranksrow[$i]['rank_id'] && $ranksrow[$i]['rank_special'] )
		{
			$poster_rank = $ranksrow[$i]['rank_title'];
			$rank_image = ( $ranksrow[$i]['rank_image'] ) ? '<img src="' . $images['rank_path'] . $ranksrow[$i]['rank_image'] . '" alt="' . $poster_rank . '" title="' . $poster_rank . '" border="0" /><br />' : '';
		}
	}
}
else
{
	for($i = 0; $i < count($ranksrow); $i++)
	{
		if ( $profiledata['user_posts'] >= $ranksrow[$i]['rank_min'] && !$ranksrow[$i]['rank_special'] )
		{
			$poster_rank = $ranksrow[$i]['rank_title'];
			$rank_image = ( $ranksrow[$i]['rank_image'] ) ? '<img src="' . $images['rank_path'] . $ranksrow[$i]['rank_image'] . '" alt="' . $poster_rank . '" title="' . $poster_rank . '" border="0" /><br />' : ''; 
		}
	}
}

$temp_url = append_sid("privmsg.$phpEx?mode=post&amp;" . POST_USERS_URL . "=" . $profiledata['user_id']);
$pm_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_pm'] . '" alt="' . $lang['Send_private_message'] . '" title="' . $lang['Send_private_message'] . '" border="0" /></a>';
// FLAGHACK-start
$location = ( $profiledata['user_from'] ) ? $profiledata['user_from'] : '&nbsp;' ;
$flag = ( !empty($profiledata['user_from_flag']) ) ? "&nbsp;<img src=\"images/flags/" . $profiledata['user_from_flag'] . "\" alt=\"" . $profiledata['user_from_flag'] . "\">" : "";
$location .= $flag ;
// FLAGHACK-end
$pm = '<a href="' . $temp_url . '">' . $lang['Send_private_message'] . '</a>';

if ( !empty($profiledata['user_viewemail']) || $userdata['user_level'] == ADMIN )
{
	$email_uri = ( $board_config['board_email_form'] ) ? append_sid("profile.$phpEx?mode=email&amp;" . POST_USERS_URL .'=' . $profiledata['user_id']) : 'mailto:' . $profiledata['user_email'];

	$email_img = '<a href="' . $email_uri . '"><img src="' . $images['icon_email'] . '" alt="' . $lang['Send_email'] . '" title="' . $lang['Send_email'] . '" border="0" /></a>';
	$email = '<a href="' . $email_uri . '">' . $lang['Send_email'] . '</a>';
}
else
{
	$email_img = '&nbsp;';
	$email = '&nbsp;';
}

$www_img = ( $profiledata['user_website'] ) ? '<a href="' . $profiledata['user_website'] . '" target="_userwww"><img src="' . $images['icon_www'] . '" alt="' . $lang['Visit_website'] . '" title="' . $lang['Visit_website'] . '" border="0" /></a>' : '&nbsp;';
$www = ( $profiledata['user_website'] ) ? '<a href="' . $profiledata['user_website'] . '" target="_userwww">' . $profiledata['user_website'] . '</a>' : '&nbsp;';

if ( !empty($profiledata['user_icq']) )
{
	$icq_status_img = '<a href="http://wwp.icq.com/' . $profiledata['user_icq'] . '#pager"><img src="http://web.icq.com/whitepages/online?icq=' . $profiledata['user_icq'] . '&img=5" width="18" height="18" border="0" /></a>';
	$icq_img = '<a href="http://wwp.icq.com/scripts/search.dll?to=' . $profiledata['user_icq'] . '"><img src="' . $images['icon_icq'] . '" alt="' . $lang['ICQ'] . '" title="' . $lang['ICQ'] . '" border="0" /></a>';
	$icq =  '<a href="http://wwp.icq.com/scripts/search.dll?to=' . $profiledata['user_icq'] . '">' . $lang['ICQ'] . '</a>';
}
else
{
	$icq_status_img = '&nbsp;';
	$icq_img = '&nbsp;';
	$icq = '&nbsp;';
}

$aim_img = ( $profiledata['user_aim'] ) ? '<a href="aim:goim?screenname=' . $profiledata['user_aim'] . '&amp;message=Hello+Are+you+there?"><img src="' . $images['icon_aim'] . '" alt="' . $lang['AIM'] . '" title="' . $lang['AIM'] . '" border="0" /></a>' : '&nbsp;';
$aim = ( $profiledata['user_aim'] ) ? '<a href="aim:goim?screenname=' . $profiledata['user_aim'] . '&amp;message=Hello+Are+you+there?">' . $lang['AIM'] . '</a>' : '&nbsp;';

$msn_img = ( $profiledata['user_msnm'] ) ? '<a href="http://members.msn.com/' . $profiledata['user_msnm'] . '" target="_blank"><img src="' . $images['icon_msnm'] . '" alt="' . $lang['MSNM'] . '" title="' . $lang['MSNM'] . '" border="0" /></a>' : ''; 
$msn = $msn_img;

$yim_img = ( $profiledata['user_yim'] ) ? '<a href="http://edit.yahoo.com/config/send_webmesg?.target=' . $profiledata['user_yim'] . '&amp;.src=pg"><img src="' . $images['icon_yim'] . '" alt="' . $lang['YIM'] . '" title="' . $lang['YIM'] . '" border="0" /></a>' : '';
$yim = ( $profiledata['user_yim'] ) ? '<a href="http://edit.yahoo.com/config/send_webmesg?.target=' . $profiledata['user_yim'] . '&amp;.src=pg">' . $lang['YIM'] . '</a>' : '';

$temp_url = append_sid("search.$phpEx?search_author=" . urlencode($profiledata['username']) . "&amp;showresults=posts");
$search_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_search'] . '" alt="' . sprintf($lang['Search_user_posts'], $profiledata['username']) . '" title="' . sprintf($lang['Search_user_posts'], $profiledata['username']) . '" border="0" /></a>';
$search = '<a href="' . $temp_url . '">' . sprintf($lang['Search_user_posts'], $profiledata['username']) . '</a>';
// Photo Album Link MOD - Daz - ForumImages.com - START
$temp_url = append_sid("album.$phpEx?user_id=" . $profiledata['user_id']);
$gallery_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_gallery'] . '" alt="' . sprintf($lang['Personal_Gallery_Of_User'], $profiledata['username']) . '" title="' . sprintf($lang['Personal_Gallery_Of_User'], $profiledata['username']) . '" border="0" /></a>';
$gallery = '<a href="' . $temp_url . '">' . sprintf($lang['Personal_Gallery_Of_User'], $profiledata['username']) . '</a>';
// Photo Album Link MOD - Daz - ForumImages.com - END 
// Start add - Birthday MOD
if ($profiledata['user_birthday']!=999999)
{
	include($phpbb_root_path . 'includes/chinese.'.$phpEx);
	$chinese = get_chinese_year( realdate('Ymd', $profiledata['user_birthday']) );
	$u_chinese = $images[$chinese];
	$chinese_img = ($chinese=='Unknown') ? '' : '<img src="' . $u_chinese . '" alt="' . $lang[$chinese] . '" title="' . $lang[$chinese] . '" align="top" border="0" />';
	$user_birthdate = realdate('md', $profiledata['user_birthday']);
	$i=0;
	while ($i<26)
	{
		if ($user_birthdate>=$zodiacdates[$n] && $user_birthdate<=$zodiacdates[$i+1])
		{
			$zodiac = $lang[$zodiacs[($i/2)]];
			$u_zodiac = $images[$zodiacs[($i/2)]];
			$zodiac_img = '<img src="' . $u_zodiac . '" alt="' . $zodiac . '" title="' . $zodiac . '" align="top" border="0" />';
			$i=26;
		} else
		{
			$i=$i+2;
		}
	}

	$user_birthday = realdate($lang['DATE_FORMAT'], $profiledata['user_birthday']);
} else
{
	$user_birthday = $lang['No_birthday_specify'];
}
// End add - Birthday MOD
// Start add - Gender MOD
if ( !empty($profiledata['user_gender'])) 
{ 
           switch ($profiledata['user_gender']) 
           { 
                      case 1: $gender=$lang['Male'];break; 
                      case 2: $gender=$lang['Female'];break; 
                      default:$gender=$lang['No_gender_specify']; 
           } 
} else $gender=$lang['No_gender_specify']; 
// End add - Gender MOD
if ( $profiledata['user_absence'] == TRUE )
{
	$nothing = '';
	$absence_mode = create_absence_mode($profiledata['user_absence_mode'], $pm_img, $pm, $email_img, $email, $nothing, 2);
}
//
// Generate page
//
$page_title = $lang['Viewing_profile'];
include($phpbb_root_path . 'includes/page_header.'.$phpEx);
if (function_exists('get_html_translation_table'))
{
	$u_search_author = urlencode(strtr($profiledata['username'], array_flip(get_html_translation_table(HTML_ENTITIES))));
}
else
{
	$u_search_author = urlencode(str_replace(array('&amp;', '&#039;', '&quot;', '&lt;', '&gt;'), array('&', "'", '"', '<', '>'), $profiledata['username']));
}
display_upload_attach_box_limits($profiledata['user_id']);
$template->assign_vars(array(
	'USERNAME' => $profiledata['username'],
	'JOINED' => create_date($lang['DATE_FORMAT'], $profiledata['user_regdate'], $board_config['board_timezone']),
	// Start add - Last visit MOD
	'L_LOGON' => $lang['Last_logon'], 
	'LAST_LOGON' => ($userdata['user_level'] == ADMIN || (!$board_config['hidde_last_logon'] && $profiledata['user_allow_viewonline'])) ? (($profiledata['user_lastlogon'])? create_date($board_config['default_dateformat'], $profiledata['user_lastlogon'], $board_config['board_timezone']):$lang['Never_last_logon']):$lang['Hidde_last_logon'], 

	'L_TOTAL_ONLINE_TIME' => $lang['Total_online_time'],
	'TOTAL_ONLINE_TIME' => make_hours($profiledata['user_totaltime']),
	'L_LAST_ONLINE_TIME' => $lang['Last_online_time'],
	'LAST_ONLINE_TIME' => make_hours($profiledata['user_session_time']-$profiledata['user_lastlogon']),
	'L_NUMBER_OF_VISIT' => $lang['Number_of_visit'],
	'NUMBER_OF_VISIT' => ($profiledata['user_totallogon']>0) ? $profiledata['user_totallogon']: $lang['None'],
	'L_NUMBER_OF_PAGES' => $lang['Number_of_pages'], 
	'NUMBER_OF_PAGES' => ($profiledata['user_totalpages']) ? $profiledata['user_totalpages']: $lang['None'], 
	// End add - Last visit MOD
	'POSTER_RANK' => $poster_rank,
	'RANK_IMAGE' => $rank_image,
	'POSTS_PER_DAY' => $posts_per_day,
	'POSTS' => $profiledata['user_posts'],
	'PERCENTAGE' => $percentage . '%', 
	'POST_DAY_STATS' => sprintf($lang['User_post_day_stats'], $posts_per_day), 
	'POST_PERCENT_STATS' => sprintf($lang['User_post_pct_stats'], $percentage), 

	'SEARCH_IMG' => $search_img,
	'SEARCH' => $search,
	'PM_IMG' => $pm_img,
	'PM' => $pm,
	'EMAIL_IMG' => ( $absence_mode != '' ) ? (( allow_send_to_absent() == TRUE ) ? str_replace($images['icon_email'], $absence_mode, $email_img) : $absence_mode ) : $email_img,
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

	// FLAGHACK-start
	'LOCATION' => $location,
	// FLAGHACK-end
	'OCCUPATION' => ( $profiledata['user_occ'] ) ? $profiledata['user_occ'] : '&nbsp;',
	'INTERESTS' => ( $profiledata['user_interests'] ) ? $profiledata['user_interests'] : '&nbsp;',
	// Start add - Gender MOD
	'GENDER' => $gender, 
	// End add - Gender MOD
	// Start add - Birthday MOD
	'BIRTHDAY' => $user_birthday,
	'CHINESE' => $lang[$chinese],
	'CHINESE_IMG' => $chinese_img,
	'U_CHINESE' => $u_chinese,
	'L_CHINESE' => $lang['Chinese_zodiac'],
	'ZODIAC' => $zodiac,
	'ZODIAC_IMG' => $zodiac_img,
	'L_ZODIAC' => $lang['Zodiac'],
	'U_ZODIAC' => $u_zodiac,

	// End add - Birthday MOD
	'AVATAR_IMG' => $avatar_img,

	'L_VIEWING_PROFILE' => sprintf($lang['Viewing_user_profile'], $profiledata['username']), 
	'L_ABOUT_USER' => sprintf($lang['About_user'], $profiledata['username']), 
	'L_AVATAR' => $lang['Avatar'], 
	'L_POSTER_RANK' => $lang['Poster_rank'], 
	'L_JOINED' => $lang['Joined'], 
	'L_TOTAL_POSTS' => $lang['Total_posts'], 
	'L_SEARCH_USER_POSTS' => sprintf($lang['Search_user_posts'], $profiledata['username']), 
	'L_CONTACT' => $lang['Contact'],
	'L_EMAIL_ADDRESS' => ( $profiledata['user_absence'] == TRUE ) ? $lang['User_absence'] : $lang['Email_address'],
	'L_EMAIL' => ( $profiledata['user_absence'] == TRUE ) ? $lang['User_absence'] : $lang['Email'],
	'L_PM' => ( $profiledata['user_absence'] == 0 || allow_send_to_absent() == TRUE ) ? $lang['Private_Message'].':' : '',
	'L_ABSENCE' => ( $profiledata['user_absence'] == TRUE ) ? $lang['User_absence_text'] : '',
	'ABSENCE_MODE' => $absence_mode, 
	'ABSENCE_MESSAGE' => ( $profiledata['user_absence'] == TRUE ) ? $profiledata['user_absence_text'] : '',
	'L_ICQ_NUMBER' => $lang['ICQ'],
	'L_YAHOO' => $lang['YIM'],
	'L_AIM' => $lang['AIM'],
	'L_MESSENGER' => $lang['MSNM'],
	'L_WEBSITE' => $lang['Website'],
	'L_LOCATION' => $lang['Location'],
	'L_OCCUPATION' => $lang['Occupation'],
	'L_INTERESTS' => $lang['Interests'],
	// Start add - Gender MOD
	'L_GENDER' => $lang['Gender'], 
	// End add - Gender MOD
	// Start add - Birthday MOD
	'L_BIRTHDAY' => $lang['Birthday'],
	// End add - Birthday MOD
	'U_SEARCH_USER' => append_sid("search.$phpEx?search_author=" . $u_search_author),
	//
	// Photo Album Link MOD - Daz - ForumImages.com - START
	'GALLERY_IMG' => $gallery_img,
	'GALLERY' => $gallery,
	// Photo Album Link MOD - Daz - ForumImages.com - END 
	'L_PERSONAL_GALLERY' => sprintf($lang['Personal_Gallery_Of_User_Profile'], $profiledata['username'], $totalpicrow['pic_total']),

	'U_TOGGLE_VIEW_ALL' => append_sid("album.$phpEx?user_id=" . $profiledata['user_id'] . "&mode=" . ALBUM_VIEW_ALL),
	'TOGGLE_VIEW_ALL_IMG' => $images['mini_all_pic_view_mode'],
	'L_TOGGLE_VIEW_ALL' => sprintf($lang['Show_All_Pic_View_Mode_Profile'], $profiledata['username']),

	'U_ALL_IMAGES_BY_USER' => append_sid("album.$phpEx?user_id=" . $profiledata['user_id'] . "&mode=" . ALBUM_VIEW_LIST),
	'L_ALL_IMAGES_BY_USER' => sprintf($lang['Picture_List_Of_User'], $profiledata['username']),
	'S_PROFILE_ACTION' => append_sid("profile.$phpEx"))
);
//
// Custom Profile Fields MOD
//
include_once($phpbb_root_path . 'includes/functions_profile_fields.'.$phpEx);
$profile_data = get_fields('WHERE view_in_profile = ' . VIEW_IN_PROFILE . ' AND users_can_view = ' . ALLOW_VIEW);
$profile_names = array();

$abouts = array();
$contacts = array();
foreach($profile_data as $field)
{
  $name = $field['field_name'];
  $col_name = text_to_column($field['field_name']);
  $id = $profiledata['user_id'];
  $type = $field['field_type'];
  $location = $field['profile_location'];
  
  $profile_names[$name] = displayable_field_data($profiledata[$col_name],$field['field_type']);
  
  if($location == 1) {
    $contacts[$name]['name'] = $name;
    $contacts[$name]['data'] = $profile_names[$name];
  } else {
    $abouts[$name]['name'] = $name;
    $abouts[$name]['data'] = $profile_names[$name];
  }
}

foreach($abouts as $about_field)
  $template->assign_block_vars('custom_about',array('ABOUT_N' => $about_field['name'],'ABOUT_D' => $about_field['data']));

foreach($contacts as $contact_field)
  $template->assign_block_vars('custom_contact',array('CONTACT_N' => $contact_field['name'],'CONTACT_D' => $contact_field['data']));
//
// END Custom Profile Fields MOD
//

if ($album_config['show_all_in_personal_gallery'] == 1)
{
	$template->assign_block_vars('enable_view_toggle', array());
}
$template->pparse('body');

include($phpbb_root_path . 'includes/page_tail.'.$phpEx);

?>
<?php
/***************************************************************************
 *                               album_cat.php
 *                            -------------------
 *   begin                : Tuesday, February 04, 2003
 *   copyright            : (C) 2003 Smartor
 *   email                : smartor_xp@hotmail.com
 *
 *   $Id: album_cat.php,v 2.0.7 2003/03/15 10:16:56 ngoctu Exp $
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
 
  /***************************************************************************
 *                            MODIFICATIONS
 *                           ---------------
 *   started            : Saturday, January 18, 2004
 *   copyright          : © Volodymyr (CLowN) Skoryk
 *   email              : blaatimmy72@yahoo.com
 *	 version            : 1.5
 *
 *	 MODIFICATIONS:
 *		-fixed links to link to album_showpage.php
 *   
 *
 ***************************************************************************/

/***************************************************************************
 *                            MODIFICATIONS
 *                           ---------------
 * copyright    : ï¿½ IdleVoid
 * email        : idlevoid@slater.dk
 * file version : 1.1.8
 * release      : 1.3.0
 *
 ***************************************************************************/

define('IN_PHPBB', true);
$phpbb_root_path = './';
$album_root_path = $phpbb_root_path . 'album_mod/';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_ALBUM_PICTURE);
init_userprefs($userdata);
//
// End session management
//


//
// Get general album information
//
include($album_root_path . 'album_common.'.$phpEx);


// ------------------------------------
// Check the request
// ------------------------------------
//--- Album Category Hierarchy : begin
//--- version : 1.1.0
// Check $album_user_id
// ------------------------------------
if( isset($_POST['user_id']) )
{
	$album_user_id = intval($_POST['user_id']);
}
else if( isset($_GET['user_id']) )
{
	$album_user_id = intval($_GET['user_id']);
}
else
{
	// if no user_id was supplied then we aren't going to show a personal gallery category
	$album_user_id = ALBUM_PUBLIC_GALLERY;
}
//--- Album Category Hierarchy : end
if( isset($_POST['cat_id']) )
{
	$cat_id = intval($_POST['cat_id']);
}
else if( isset($_GET['cat_id']) )
{
	$cat_id = intval($_GET['cat_id']);
}
else
{
	message_die(GENERAL_ERROR, 'No categories specified');
}

//--- Album Category Hierarchy : begin
//--- version : 1.2.0
if (isset ($_POST['mode']))
{
	$album_view_mode = strtolower($_POST['mode']);
}
elseif (isset ($_GET['mode']))
{
	$album_view_mode = strtolower($_GET['mode']);
}
// make sure that it only contains some valid value
switch ($album_view_mode)
{
 	case ALBUM_VIEW_ALL:
 		$album_view_mode = ALBUM_VIEW_ALL;
 		break;
 	case ALBUM_VIEW_LIST:
 		$album_view_mode = ALBUM_VIEW_LIST;
 		break;
 	default:
 		$album_view_mode = '';
}
//--- Album Category Hierarchy : end

//
// END check request
//

//--- Album Category Hierarchy : begin
//--- version : <= 1.1.0
//--- removed
/*
if ($cat_id == PERSONAL_GALLERY)
{
	redirect(append_sid("album_personal.$phpEx"));
}
*/
//--- added
// if requested gallery is the root category of the public categories, OR
// the category is the root category of the personal gallery -
// then show root album instead
if ($cat_id <= ALBUM_ROOT_CATEGORY+1 || album_get_personal_root_id($album_user_id) == $cat_id)
{
	if ($cat_id == ALBUM_JUMPBOX_PUBLIC_GALLERY) 
	{
		redirect(append_sid("album.$phpEx"));
	}

	if ($cat_id == ALBUM_JUMPBOX_USERS_GALLERY) 
	{
		redirect(append_sid(album_append_uid("album_personal_index.$phpEx")));
	}
	redirect( album_append_uid(append_sid("album.$phpEx")) );
}
//--- Album Category Hierarchy : end


// ------------------------------------
// Get this cat info
// ------------------------------------
//--- Album Category Hierarchy : begin
//--- version : 1.1.0
//--- removed
/*
$sql = "SELECT c.*, COUNT(p.pic_id) AS count
		FROM ". ALBUM_CAT_TABLE ." AS c LEFT JOIN ". ALBUM_TABLE ." AS p ON c.cat_id = p.pic_cat_id
		WHERE c.cat_id <> 0
		GROUP BY c.cat_id
		ORDER BY cat_order";
if( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Could not query category information', '', __LINE__, __FILE__, $sql);
}

$thiscat = array(); // this category
$catrows = array(); // all categories for jumpbox

while( $row = $db->sql_fetchrow($result) )
{
	$album_user_access = album_user_access($row['cat_id'], $row, 1, 0, 0, 0, 0, 0); // VIEW
	if ($album_user_access['view'] == 1)
	{
		$catrows[] = $row;

		if( $row['cat_id'] == $cat_id )
		{
			$thiscat = $row;
			$auth_data = album_user_access($cat_id, $row, 1, 1, 1, 1, 1, 1); // ALL
			$total_pics = $thiscat['count'];
		}
	}
}

if (empty($thiscat))
{
	message_die(GENERAL_MESSAGE, $lang['Category_not_exist']);
}
*/
//--- added
$thiscat = array(); // this category
$catrows = array(); // all categories for jumpbox
$auth_data  = array(); // the authothentication data for current category for current user

if ($album_user_id != ALBUM_PUBLIC_GALLERY && !album_check_user_exists($album_user_id))
{
    redirect(append_sid("album.$phpEx"));
}

$read_options = ($album_view_mode == ALBUM_VIEW_LIST ) ? ALBUM_READ_ALL_CATEGORIES|ALBUM_AUTH_VIEW : ALBUM_AUTH_VIEW;
$catrows = album_read_tree($album_user_id, $read_options);

// check if the category exists in the album_tree data
if (@!array_key_exists($cat_id, $album_data['keys']) )
{
	message_die(GENERAL_MESSAGE, $lang['Category_not_exist']);
}

$thiscat = $album_data ['data'][ $album_data ['keys'][$cat_id] ];
$total_pics = $thiscat['count'];
$auth_data = album_get_auth_data($cat_id);
//--- Album Category Hierarchy : end

// ------------------------------------
// Check permissions
// ------------------------------------
if( !$auth_data['view'] )
{
	if (!$userdata['session_logged_in'])
	{
		redirect( append_sid(album_append_uid("login.$phpEx?redirect=album_cat.$phpEx&cat_id=$cat_id") ) );		
	}
	else
	{
		message_die(GENERAL_ERROR, $lang['Not_Authorised']);
	}
}
//
// END check permissions
//
// ------------------------------------
// Build the list of allowed sub category id's
// ------------------------------------
//--- Album Category Hierarchy : begin
//--- version : 1.1.0
$subcats = array();
$allowed_cat = $cat_id;
album_get_sub_cat_ids($cat_id, $subcats);
for ($i = 0; $i < count($subcats); $i++)
{
	$allowed_cat .= ',' . $subcats[$i];
}
//--- Album Category Hierarchy : end
//
// END cat info
//


// ------------------------------------
// Build Auth List
// ------------------------------------
//--- Album Category Hierarchy : begin
//--- version : 1.1.0
//--- removed
/*
$auth_key = array_keys($auth_data);

$auth_list = '';
for ($i = 0; $i < (count($auth_data) - 1); $i++) // ignore MODERATOR in this loop
{
	//
	// we should skip a loop if RATE and COMMENT is disabled
	//
	if( ( ($album_config['rate'] == 0) and ($auth_key[$i] == 'rate') ) or ( ($album_config['comment'] == 0) and ($auth_key[$i] == 'comment') ) )
	{
		continue;
	}

	$auth_list .= ($auth_data[$auth_key[$i]] == 1) ? $lang['Album_'. $auth_key[$i] .'_can'] : $lang['Album_'. $auth_key[$i] .'_cannot'];
	$auth_list .= '<br />';
}

// add Moderator Control Panel here
if( ($userdata['user_level'] == ADMIN) or ($auth_data['moderator'] == 1) )
{
	$auth_list .= sprintf($lang['Album_moderate_can'], '<a href="'. append_sid("album_modcp.$phpEx?cat_id=$cat_id") .'">', '</a>');
}
*/
//--- added
$auth_list = album_build_auth_list($album_user_id, $cat_id);
//--- Album Category Hierarchy : end
//
// END Auth List
//

// ------------------------------------
// Build Moderators List
// ------------------------------------

$grouprows = array();
$moderators_list = '';

//--- Album Category Hierarchy : begin
//--- version : 1.1.0
//--- removed
//if ($thiscat['cat_moderator_groups'] != '')
//--- added
if ($album_user_id == ALBUM_PUBLIC_GALLERY && $thiscat['cat_moderator_groups'] != '')
//--- Album Category Hierarchy : end
{
	// Get the namelist of moderator usergroups
	$sql = "SELECT group_id, group_name, group_type, group_single_user
			FROM " . GROUPS_TABLE . "
			WHERE group_single_user <> 1
				AND group_type <> ". GROUP_HIDDEN ."
				AND group_id IN (". $thiscat['cat_moderator_groups'] .")
			ORDER BY group_name ASC";
	if ( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Could not get group list', '', __LINE__, __FILE__, $sql);
	}

	while( $row = $db->sql_fetchrow($result) )
	{
		$grouprows[] = $row;
	}

	if( count($grouprows) > 0 )
	{
		for ($j = 0; $j < count($grouprows); $j++)
		{
			$group_link = '<a href="'. append_sid("groupcp.$phpEx?". POST_GROUPS_URL .'='. $grouprows[$j]['group_id']) .'">'. $grouprows[$j]['group_name'] .'</a>';

			$moderators_list .= ($moderators_list == '') ? $group_link : ', ' . $group_link;
		}
	}
}

//--- Album Category Hierarchy : begin
//--- version : 1.1.0
//--- removed
//if( empty($moderators_list) )
//{
//	$moderators_list = $lang['None'];
//}
//--- Album Category Hierarchy : end

//
// END Moderator List
//

//--- Album Category Hierarchy : begin
//--- version : 1.1.0
// Update the naVigation tree
$album_nav_cat_desc = album_make_nav_tree($cat_id, "album_cat.$phpEx", "nav" , $album_user_id);
if ($album_nav_cat_desc != '') $album_nav_cat_desc = ALBUM_NAV_ARROW . $album_nav_cat_desc;
//--- Album Category Hierarchy : end

// ------------------------------------
// Build the thumbnail page
// ------------------------------------

if( isset($_GET['start']) )
{
	$start = intval($_GET['start']);
}
else if( isset($_POST['start']) )
{
	$start = intval($_POST['start']);
}
else
{
	$start = 0;
}

if( isset($_GET['sort_method']) )
{
	switch ($_GET['sort_method'])
	{
		case 'pic_time':
			$sort_method = 'pic_time';
			break;
		case 'pic_title':
			$sort_method = 'pic_title';
			break;
		case 'username':
			$sort_method = 'username';
			break;
		case 'pic_view_count':
			$sort_method = 'pic_view_count';
			break;
		case 'rating':
			$sort_method = 'rating';
			break;
		case 'comments':
			$sort_method = 'comments';
			break;
		case 'new_comment':
			$sort_method = 'new_comment';
			break;
		default:
			$sort_method = $album_config['sort_method'];
	}
}
else if( isset($_POST['sort_method']) )
{
	switch ($_POST['sort_method'])
	{
		case 'pic_time':
			$sort_method = 'pic_time';
			break;
		case 'pic_title':
			$sort_method = 'pic_title';
			break;
		case 'username':
			$sort_method = 'username';
			break;
		case 'pic_view_count':
			$sort_method = 'pic_view_count';
			break;
		case 'rating':
			$sort_method = 'rating';
			break;
		case 'comments':
			$sort_method = 'comments';
			break;
		case 'new_comment':
			$sort_method = 'new_comment';
			break;
		default:
			$sort_method = $album_config['sort_method'];
	}
}
else
{
	$sort_method = $album_config['sort_method'];
}

if( isset($_GET['sort_order']) )
{
	switch ($_GET['sort_order'])
	{
		case 'ASC':
			$sort_order = 'ASC';
			break;
		case 'DESC':
			$sort_order = 'DESC';
			break;
		default:
			$sort_order = $album_config['sort_order'];
	}
}
else if( isset($_POST['sort_order']) )
{
	switch ($_POST['sort_order'])
	{
		case 'ASC':
			$sort_order = 'ASC';
			break;
		case 'DESC':
			$sort_order = 'DESC';
			break;
		default:
			$sort_order = $album_config['sort_order'];
	}
}
else
{
	$sort_order = $album_config['sort_order'];
}
//--- Album Category Hierarchy : begin
//--- version : 1.1.0
//--- removed
/*

$pics_per_page = $album_config['rows_per_page'] * $album_config['cols_per_page'];

if ($total_pics > 0)
{
	$limit_sql = ($start == 0) ? $pics_per_page : $start .','. $pics_per_page;

	$pic_approval_sql = 'AND p.pic_approval = 1';
	if ($thiscat['cat_approval'] != ALBUM_USER)
	{
		if( ($userdata['user_level'] == ADMIN) or (($auth_data['moderator'] == 1) and ($thiscat['cat_approval'] == ALBUM_MOD)) )
		{
			$pic_approval_sql = '';
		}
	}

	$sql = "SELECT p.pic_id, p.pic_title, p.pic_desc, p.pic_user_id, p.pic_user_ip, p.pic_username, p.pic_time, p.pic_cat_id, p.pic_view_count, p.pic_lock, p.pic_approval, u.user_id, u.username, r.rate_pic_id, AVG(r.rate_point) AS rating, COUNT(DISTINCT c.comment_id) AS comments, MAX(c.comment_id) as new_comment
			FROM ". ALBUM_TABLE ." AS p
				LEFT JOIN ". USERS_TABLE ." AS u ON p.pic_user_id = u.user_id
				LEFT JOIN ". ALBUM_RATE_TABLE ." AS r ON p.pic_id = r.rate_pic_id
				LEFT JOIN ". ALBUM_COMMENT_TABLE ." AS c ON p.pic_id = c.comment_pic_id
			WHERE p.pic_cat_id = '$cat_id' $pic_approval_sql
			GROUP BY p.pic_id
			ORDER BY $sort_method $sort_order
			LIMIT $limit_sql";
	if( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not query pics information', '', __LINE__, __FILE__, $sql);
	}

	$picrow = array();

	while( $row = $db->sql_fetchrow($result) )
	{
		$picrow[] = $row;
	}


	for ($i = 0; $i < count($picrow); $i += $album_config['cols_per_page'])
	{
		$template->assign_block_vars('picrow', array());

		for ($j = $i; $j < ($i + $album_config['cols_per_page']); $j++)
		{
			if( $j >= count($picrow) )
			{
				break;
			}

			if ($thiscat['cat_approval'] != ALBUM_USER)
			{
				if( ($userdata['user_level'] == ADMIN) or (($auth_data['moderator'] == 1) and ($thiscat['cat_approval'] == ALBUM_MOD)) )
				{
					$approval_mode = ($picrow[$j]['pic_approval'] == 0) ? 'approval' : 'unapproval';

					$approval_link = '<a href="'. append_sid("album_modcp.$phpEx?mode=$approval_mode&amp;pic_id=". $picrow[$j]['pic_id']) .'">';

					$approval_link .= ($picrow[$j]['pic_approval'] == 0) ? '<b>'. $lang['Approve'] .'</b>' : $lang['Unapprove'];

					$approval_link .= '</a>';
				}
			}

			$template->assign_block_vars('picrow.piccol', array(
				'U_PIC' => ($album_config['fullpic_popup']) ? append_sid("album_pic.$phpEx?pic_id=". $picrow[$j]['pic_id']) : append_sid("album_showpage.$phpEx?pic_id=". $picrow[$j]['pic_id']),
				'THUMBNAIL' => append_sid("album_thumbnail.$phpEx?pic_id=". $picrow[$j]['pic_id']),
				'DESC' => $picrow[$j]['pic_desc'],
				'APPROVAL' => $approval_link,
				)
			);

			if( ($picrow[$j]['user_id'] == ALBUM_GUEST) or ($picrow[$j]['username'] == '') )
			{
				$pic_poster = ($picrow[$j]['pic_username'] == '') ? $lang['Guest'] : $picrow[$j]['pic_username'];
			}
			else
			{
				$pic_poster = '<a href="'. append_sid("profile.$phpEx?mode=viewprofile&amp;". POST_USERS_URL .'='. $picrow[$j]['user_id']) .'">'. $picrow[$j]['username'] .'</a>';
			}
			
			$image_rating = ImageRating( $picrow[$j]['rating']);
			
			$template->assign_block_vars('picrow.pic_detail', array(
				'TITLE' => '<a href = "album_showpage.' . $phpEx . '?pic_id=' . $picrow[$j]['pic_id'] . '">' . $picrow[$j]['pic_title'] . '</a>',
				'POSTER' => $pic_poster,
				'TIME' => create_date($board_config['default_dateformat'], $picrow[$j]['pic_time'], $board_config['board_timezone']),

				'VIEW' => $picrow[$j]['pic_view_count'],

				'RATING' => ($album_config['rate'] == 1) ? ( $lang['Rating'] . ': ' . $image_rating . '<br />') : '',

				'COMMENTS' => ($album_config['comment'] == 1) ? ( $lang['Comments'] . ': ' . $picrow[$j]['comments'] . '<br />') : '',

				'EDIT' => ( ( $auth_data['edit'] and ($picrow[$j]['pic_user_id'] == $userdata['user_id']) ) or ($auth_data['moderator'] and ($thiscat['cat_edit_level'] != ALBUM_ADMIN) ) or ($userdata['user_level'] == ADMIN) ) ? '<a href="'. append_sid("album_edit.$phpEx?pic_id=". $picrow[$j]['pic_id']) . '">' . $lang['Edit_pic'] . '</a>' : '',

				'DELETE' => ( ( $auth_data['delete'] and ($picrow[$j]['pic_user_id'] == $userdata['user_id']) ) or ($auth_data['moderator'] and ($thiscat['cat_delete_level'] != ALBUM_ADMIN) ) or ($userdata['user_level'] == ADMIN) ) ? '<a href="'. append_sid("album_delete.$phpEx?pic_id=". $picrow[$j]['pic_id']) . '">' . $lang['Delete_pic'] . '</a>' : '',

				'MOVE' => ($auth_data['moderator']) ? '<a href="'. append_sid("album_modcp.$phpEx?mode=move&amp;pic_id=". $picrow[$j]['pic_id']) .'">'. $lang['Move'] .'</a>' : '',

				'LOCK' => ($auth_data['moderator']) ? '<a href="'. append_sid("album_modcp.$phpEx?mode=". (($picrow[$j]['pic_lock'] == 0) ? 'lock' : 'unlock') ."&amp;pic_id=". $picrow[$j]['pic_id']) .'">'. (($picrow[$j]['pic_lock'] == 0) ? $lang['Lock'] : $lang['Unlock']) .'</a>' : '',

				'IP' => ($userdata['user_level'] == ADMIN) ? $lang['IP_Address'] . ': <a href="http://www.nic.com/cgi-bin/whois.cgi?query=' . decode_ip($picrow[$j]['pic_user_ip']) . '" target="_blank">' . decode_ip($picrow[$j]['pic_user_ip']) .'</a><br />' : ''
				)
			);
		}
	}

	$template->assign_vars(array(
		'PAGINATION' => generate_pagination(append_sid("album_cat.$phpEx?cat_id=$cat_id&amp;sort_method=$sort_method&amp;sort_order=$sort_order"), $total_pics, $pics_per_page, $start),
		'PAGE_NUMBER' => sprintf($lang['Page_of'], ( floor( $start / $pics_per_page ) + 1 ), ceil( $total_pics / $pics_per_page ))
		)
	);
}
else
{
	$template->assign_block_vars('no_pics', array());
}
//
// END thumbnails table
//


// ------------------------------------
// Build Jumpbox - based on $catrows which was created at the top of this file
// ------------------------------------
$album_jumpbox = '<form name="jumpbox" action="'. append_sid("album_cat.$phpEx") .'" method="get">';
$album_jumpbox .= $lang['Jump_to'] . ':&nbsp;<select name="cat_id" onChange="forms[\'jumpbox\'].submit()">';
for ($i = 0; $i < count($catrows); $i++)
{
	$album_jumpbox .= '<option value="'. $catrows[$i]['cat_id'] .'"';
	$album_jumpbox .= ($catrows[$i]['cat_id'] == $cat_id) ? 'selected="selected"' : '';
	$album_jumpbox .= '>' . $catrows[$i]['cat_title'] .'</option>';
}
$album_jumpbox .= '</select>';
$album_jumpbox .= '&nbsp;<input type="submit" class="liteoption" value="'. $lang['Go'] .'" />';
$album_jumpbox .= '<input type="hidden" name="sid" value="'. $userdata['session_id'] .'" />';
$album_jumpbox .= '</form>';
//
// END build jumpbox
//
*/
//--- Album Category Hierarchy : end


// ------------------------------------
// additional sorting options
// ------------------------------------

//--- Album Category Hierarchy : begin
//--- version : 1.1.0
//--- added : $sort_username_option and $sort_new_comment_option
$sort_rating_option = '';
$sort_username_option = '';
$sort_comments_option = '';
$sort_new_comment_option = '';
//--- Album Category Hierarchy : end

if( $album_config['rate'] == 1 )
{
	$sort_rating_option = '<option value="rating" ';
	$sort_rating_option .= ($sort_method == 'rating') ? 'selected="selected"' : '';
	$sort_rating_option .= '>' . $lang['Rating'] .'</option>';
}
if( $album_config['comment'] == 1 )
{
	$sort_comments_option = '<option value="comments" ';
	$sort_comments_option .= ($sort_method == 'comments') ? 'selected="selected"' : '';
	$sort_comments_option .= '>' . $lang['Comments'] .'</option>';

	$sort_new_comment_option = '<option value="new_comment" ';
	$sort_new_comment_option .= ($sort_method == 'new_comment') ? 'selected="selected"' : '';
	$sort_new_comment_option .= '>' . $lang['New_Comment'] .'</option>';
}
//--- Album Category Hierarchy : begin
//--- version : 1.1.0
if( $album_user_id == ALBUM_PUBLIC_GALLERY )
{
 	$sort_username_option = '<option value="username" ';
	$sort_username_option .= ($sort_method == 'pic_user_id') ? 'selected="selected"' : '';
	$sort_username_option .= '>' . $lang['Sort_Username'] .'</option>';
}
// ------------------------------------
// Build Jumpbox
// ------------------------------------
$album_jumpbox = album_build_jumpbox($cat_id, $album_user_id);
//
// END build jumpbox
//
//--- Album Category Hierarchy : end


//
// Start output of page
//
$page_title = $lang['Album'];
//--- Album Category Hierarchy : begin
//--- version : 1.1.0
if ($album_user_id == ALBUM_PUBLIC_GALLERY)
{
	if( empty($moderators_list) )
	{
		$moderators_list = $lang['None'];
	}	
	
    include($phpbb_root_path . 'includes/page_header.'.$phpEx);
	
	$template->set_filenames(array(
	    'body' => 'album_cat_body.tpl')
	);

	if ($total_pics > 0)
	{
		album_build_picture_table($album_user_id, $cat_id, $thiscat, $auth_data, $start, $sort_method, $sort_order, $total_pics);
		
		if ($album_config['show_recent_in_subcats'] == 1)
		{
			album_build_recent_pics($allowed_cat);
		}
	}
	else
	{
		// ------------------------------------
		// Build Recent Public Pics
		// ------------------------------------
		if ($has_sub_cats && $album_config['show_recent_instead_of_nopics'] == 1)
		{
			album_build_recent_pics(allowed_cat);
		}
		else
       	{
		 	$template->assign_block_vars('index_pics_block', array());
			$template->assign_block_vars('index_pics_block.no_pics', array());
		}
	}
	
	//
	// END thumbnails table
	//
	
	// Maybe we should also add a new check to see if user really can upload or not
	// this is not even in the original code by smartor
	$template->assign_block_vars('enable_picture_upload', array());
	
	$template->assign_vars(array(
		'L_ALBUM' => $lang['Album'],
	
		'U_VIEW_CAT' => append_sid(album_append_uid("album_cat.$phpEx?cat_id=$cat_id")),
		'CAT_TITLE' => $thiscat['cat_title'],
	
		'ALBUM_NAVIGATION_ARROW' => ALBUM_NAV_ARROW,
		'NAV_CAT_DESC' => $album_nav_cat_desc,
	
		'L_MODERATORS' => $lang['Moderators'],
		'MODERATORS' => $moderators_list,
	
		'U_UPLOAD_PIC' => append_sid(album_append_uid("album_upload.$phpEx?cat_id=$cat_id")),
		'UPLOAD_PIC_IMG' => $images['upload_pic'],
		'L_UPLOAD_PIC' => $lang['Upload_Pic'],
	
		'L_CATEGORY' => $lang['Category'],
	
		'L_NO_PICS' => $lang['No_Pics'],
		'L_RECENT_PUBLIC_PICS' => $lang['Recent_Public_Pics'],
	
		'S_COLS' => $album_config['cols_per_page'],
		'S_COL_WIDTH' => (100/$album_config['cols_per_page']) . '%',
	
		'L_VIEW' => $lang['View'],
		'L_POSTER' => $lang['Poster'],
		'L_POSTED' => $lang['Posted'],
	
		'ALBUM_JUMPBOX' => $album_jumpbox,
	
		'S_ALBUM_ACTION' => append_sid(album_append_uid("album_cat.$phpEx?cat_id=$cat_id")),
	
		'TARGET_BLANK' => ($album_config['fullpic_popup']) ? 'target="_blank"' : '',
	
		'L_SELECT_SORT_METHOD' => $lang['Select_sort_method'],
		'L_ORDER' => $lang['Order'],
		'L_SORT' => $lang['Sort'],
	
		'L_TIME' => $lang['Time'],
		'L_PIC_TITLE' => $lang['Pic_Title'],
	
		'SORT_TIME' => ($sort_method == 'pic_time') ? 'selected="selected"' : '',
		'SORT_PIC_TITLE' => ($sort_method == 'pic_title') ? 'selected="selected"' : '',
		'SORT_VIEW' => ($sort_method == 'pic_view_count') ? 'selected="selected"' : '',
	
		'SORT_RATING_OPTION' => $sort_rating_option,
		'SORT_COMMENTS_OPTION' => $sort_comments_option,
		'SORT_NEW_COMMENT_OPTION' => $sort_new_comment_option,
	    'SORT_USERNAME_OPTION' => $sort_username_option,
	
		'L_ASC' => $lang['Sort_Ascending'],
		'L_DESC' => $lang['Sort_Descending'],
	
		'SORT_ASC' => ($sort_order == 'ASC') ? 'selected="selected"' : '',
		'SORT_DESC' => ($sort_order == 'DESC') ? 'selected="selected"' : '',
	
		'S_AUTH_LIST' => $auth_list)
	);	
}
else
{
	include($album_root_path . 'album_personal.'.$phpEx);
}

$template->assign_block_vars('index_pics_block.enable_gallery_title', array());

$show_personal_gallery_link = ($album_config['show_personal_gallery_link'] == 1) ? true : false;
if (empty($album_view_mode))
{
	album_display_index($album_user_id, $cat_id, true, $show_personal_gallery_link, true);
}
//--- Album Category Hierarchy : end

//
// Generate the page
//
$template->pparse('body');

include($phpbb_root_path . 'includes/page_tail.'.$phpEx);


// +-------------------------------------------------------------+
// |  Powered by Photo Album 2.x.x (c) 2002-2003 Smartor         |
// |  with Volodymyr (CLowN) Skoryk's Service Pack 1 © 2003-2004 |
// +-------------------------------------------------------------+

?>
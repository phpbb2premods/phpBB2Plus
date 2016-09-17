<?php
/***************************************************************************
 *                              album_modcp.php
 *                            -------------------
 *   begin                : Wednesday, February 05, 2003
 *   copyright            : (C) 2004 Smartor
 *   email                : smartor_xp@hotmail.com
 *
 *   $Id: album_modcp.php,v 2.0.6 2004/07/16 15:54:50 ngoctu Exp $
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

define('IN_PHPBB', true);
$phpbb_root_path = './';
$album_root_path = $phpbb_root_path . 'album_mod/';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_ALBUM);
init_userprefs($userdata);
//
// End session management
//

//
// Get general album information
//
include($album_root_path . 'album_common.'.$phpEx);


// ------------------------------------
// Get the $pic_id from GET method then query out the category
// If $pic_id not found we will assign it to FALSE
// We will check $pic_id[] in POST method later (in $mode carry out)
// ------------------------------------
if( isset($_GET['pic_id']) )
{
	$pic_id = intval($_GET['pic_id']);
}
else
{
	$pic_id = FALSE;
}

if( $pic_id != FALSE )
{
	//
	// Get this pic info
	//
	//--- Album Category Hierarchy : begin
	//--- Version : = 1.1.0
	$sql = "SELECT p.*, c.*
			FROM ". ALBUM_TABLE ." AS p, ". ALBUM_CAT_TABLE ."  AS c
			WHERE p.pic_id = '$pic_id'
				AND c.cat_id = p.pic_cat_id";
				
	if( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not query pic information', '', __LINE__, __FILE__, $sql);
	}
	$thiscat = $db->sql_fetchrow($result);
	if( empty($thiscat) )
	{
		message_die(GENERAL_ERROR, $lang['Pic_not_exist']);
	}
	$cat_id = $thiscat['pic_cat_id'];
	$album_user_id = $thiscat['cat_user_id'];
	//--- Album Category Hierarchy : end

}
else
{
	//
	// No $pic_id found, try to find $cat_id
	//
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
	//--- Version : = 1.1.0

	// ------------------------------------
	// Get the cat info
	// ------------------------------------
	$sql = "SELECT *
			FROM ". ALBUM_CAT_TABLE ."
			WHERE cat_id = '$cat_id'";

	if( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not query category information', '', __LINE__, __FILE__, $sql);
	}

	$thiscat = $db->sql_fetchrow($result);

	if (empty($thiscat))
	{
		message_die(GENERAL_ERROR, $lang['Category_not_exist']);
	}

	$album_user_id = $thiscat['cat_user_id'];
	//--- Album Category Hierarchy : end
}
//
// END check $pic_id and $cat_id
//

//
// END category info
//

// ------------------------------------
// set $mode (select action)
// ------------------------------------
if( isset($_POST['mode']) )
{
	// Oh data from Mod CP
	if( isset($_POST['move']) )
	{
		$mode = 'move';
	}
	else if( isset($_POST['lock']) )
	{
		$mode = 'lock';
	}
	else if( isset($_POST['unlock']) )
	{
		$mode = 'unlock';
	}
	else if( isset($_POST['delete']) )
	{
		$mode = 'delete';
	}
	else if( isset($_POST['approval']) )
	{
		$mode = 'approval';
	}
	else if( isset($_POST['unapproval']) )
	{
		$mode = 'unapproval';
	}
	else
	{
		$mode = '';
	}
}
else if( isset($_GET['mode']) )
{
	$mode = trim($_GET['mode']);
}
else
{
	$mode = '';
}
//
// END $mode (select action)
//


//--- Album Category Hierarchy : begin
//--- version : 1.3.0
album_read_tree($album_user_id);

// ------------------------------------
// Check the permissions
// ------------------------------------
//--- version : 1.2.0
$auth_data = album_permissions($album_user_id, $cat_id, ALBUM_AUTH_VIEW_AND_UPLOAD|ALBUM_AUTH_MODERATOR, $thiscat);

if ( !album_check_permission($auth_data, ALBUM_AUTH_MODERATOR) )
//--- Album Category Hierarchy : end
{
	if (!$userdata['session_logged_in'])
	{
		redirect(append_sid(album_append_uid("login.$phpEx?redirect=album_modcp.$phpEx&amp;cat_id=$cat_id")));
	}
	else
	{
		message_die(GENERAL_ERROR, $lang['Not_Authorised']);
	}
}
//
// END permissions
//


/*
+----------------------------------------------------------
| Main work here...
+----------------------------------------------------------
*/

if ($mode == '')
{
	// --------------------------------
	// Moderator Control Panel
	// --------------------------------

	// Set Variables
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
			case 'pic_title':
				$sort_method = 'pic_title';
				break;
			case 'pic_user_id':
				$sort_method = 'pic_user_id';
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
				$sort_method = 'pic_time';
		}
	}
	else if( isset($_POST['sort_method']) )
	{
		switch ($_POST['sort_method'])
		{
			case 'pic_title':
				$sort_method = 'pic_title';
				break;
			case 'pic_user_id':
				$sort_method = 'pic_user_id';
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
				$sort_method = 'pic_time';
		}
	}
	else
	{
		$sort_method = 'pic_time';
	}

	if( isset($_GET['sort_order']) )
	{
		switch ($_GET['sort_order'])
		{
			case 'ASC':
				$sort_order = 'ASC';
				break;
			default:
				$sort_order = 'DESC';
		}
	}
	else if( isset($_POST['sort_order']) )
	{
		switch ($_POST['sort_order'])
		{
			case 'ASC':
				$sort_order = 'ASC';
				break;
			default:
				$sort_order = 'DESC';
		}
	}
	else
	{
		$sort_order = 'DESC';
	}

	// Count Pics
	$sql = "SELECT COUNT(pic_id) AS count
			FROM ". ALBUM_TABLE ."
			WHERE pic_cat_id = '$cat_id'";
	if( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not count pics in this category', '', __LINE__, __FILE__, $sql);
	}
	$row = $db->sql_fetchrow($result);

	$total_pics = $row['count'];

	$pics_per_page = $board_config['topics_per_page']; // Text list only

	// get information from DB
	if ($total_pics > 0)
	{
		$limit_sql = ($start == 0) ? $pics_per_page : $start .', '. $pics_per_page;

		$pic_approval_sql = '';
		if( ($userdata['user_level'] != ADMIN) and ($thiscat['cat_approval'] == ALBUM_ADMIN) )
		{
			// because he went through my Permission Checking above so he must be at least a Moderator
			$pic_approval_sql = 'AND p.pic_approval = 1';
		}

		$sql = "SELECT p.pic_id, p.pic_title, p.pic_user_id, p.pic_user_ip, p.pic_username, p.pic_time, p.pic_cat_id, p.pic_view_count, p.pic_lock, p.pic_approval, u.user_id, u.username, r.rate_pic_id, AVG(r.rate_point) AS rating, COUNT(c.comment_id) AS comments, MAX(c.comment_id) AS new_comment
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

		for ($i = 0; $i <count($picrow); $i++)
		{
			if( ($picrow[$i]['user_id'] == ALBUM_GUEST) or ($picrow[$i]['username'] == '') )
			{
				$pic_poster = ($picrow[$i]['pic_username'] == '') ? $lang['Guest'] : $picrow[$i]['pic_username'];
			}
			else
			{
				$pic_poster = '<a href="'. append_sid("profile.$phpEx?mode=viewprofile&amp;". POST_USERS_URL .'='. $picrow[$i]['user_id']) .'">'. $picrow[$i]['username'] .'</a>';
			}

			$template->assign_block_vars('picrow', array(
				'PIC_ID' => $picrow[$i]['pic_id'],
				'PIC_TITLE' => '<a href="'. append_sid("album_pic.$phpEx?pic_id=". $picrow[$i]['pic_id']) .'" target="_blank">'. $picrow[$i]['pic_title'] .'</a>',
				'POSTER' => $pic_poster,
				'TIME' => create_date($board_config['default_dateformat'], $picrow[$i]['pic_time'], $board_config['board_timezone']),
				'RATING' => ($picrow[$i]['rating'] == 0) ? $lang['Not_rated'] : round($picrow[$i]['rating'], 2),
				'COMMENTS' => $picrow[$i]['comments'],
				'LOCK' => ($picrow[$i]['pic_lock'] == 0) ? '' : $lang['Locked'],
				'APPROVAL' => ($picrow[$i]['pic_approval'] == 0) ? $lang['Not_approved'] : $lang['Approved']
				)
			);
		}

		$template->assign_vars(array(
			'PAGINATION' => generate_pagination(append_sid(album_append_uid("album_modcp.$phpEx?cat_id=$cat_id&amp;sort_method=$sort_method&amp;sort_order=$sort_order")), $total_pics, $pics_per_page, $start),
			'PAGE_NUMBER' => sprintf($lang['Page_of'], ( floor( $start / $pics_per_page ) + 1 ), ceil( $total_pics / $pics_per_page ))
			)
		);
	}
	else
	{
		// No Pics
		$template->assign_block_vars('no_pics', array());
	}

	//
	// Start output of page (ModCP)
	//
	$page_title = $lang['Album'];
	include($phpbb_root_path . 'includes/page_header.'.$phpEx);

	$template->set_filenames(array(
		'body' => 'album_modcp_body.tpl')
	);

	$sort_rating_option = '';
	$sort_username_option = '';
	$sort_comments_option = '';
	$sort_new_comment_option = '';
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
	//--- Album Category Hierarchy : end
	$template->assign_vars(array(
		'U_VIEW_CAT' => append_sid(album_append_uid("album_modcp.$phpEx?cat_id=$cat_id")),
		'CAT_TITLE' => $thiscat['cat_title'],

		'L_CATEGORY' => $lang['Category'],
		'L_MODCP' => $lang['Mod_CP'],

		'L_NO_PICS' => $lang['No_Pics'],

		'L_VIEW' => $lang['View'],
		'L_POSTER' => $lang['Poster'],
		'L_POSTED' => $lang['Posted'],

		'S_ALBUM_ACTION' => append_sid(album_append_uid("album_modcp.$phpEx?cat_id=$cat_id")),

		'L_SELECT_SORT_METHOD' => $lang['Select_sort_method'],
		'L_ORDER' => $lang['Order'],
		'L_SORT' => $lang['Sort'],

		'L_TIME' => $lang['Time'],
		'L_PIC_TITLE' => $lang['Pic_Title'],
		'L_POSTER' => $lang['Poster'],
		'L_RATING' => $lang['Rating'],
		'L_COMMENTS' => $lang['Comments'],
		'L_STATUS' => $lang['Status'],
		'L_APPROVAL' => $lang['Approval'],
		'L_SELECT' => $lang['Select'],
		'L_DELETE' => $lang['Delete'],
		'L_MOVE' => $lang['Move'],
		'L_LOCK' => $lang['Lock'],
		'L_UNLOCK' => $lang['Unlock'],

		'DELETE_BUTTON' => ($auth_data['delete'] == 1) ? '<input type="submit" class="liteoption" name="delete" value="'. $lang['Delete'] .'" />' : '',

		'APPROVAL_BUTTON' => ( ($userdata['user_level'] != ADMIN) and ($thiscat['cat_approval'] == ALBUM_ADMIN) ) ? '' : '<input type="submit" class="liteoption" name="approval" value="'. $lang['Approve'] .'" />',

		'UNAPPROVAL_BUTTON' => ( ($userdata['user_level'] != ADMIN) and ($thiscat['cat_approval'] == ALBUM_ADMIN) ) ? '' : '<input type="submit" class="liteoption" name="unapproval" value="'. $lang['Unapprove'] .'" />',
		//--- Album Category Hierarchy : begin
//--- version : 1.2.0
		'L_CHECK_ALL' => $lang['Modcp_check_all'],
		'L_UNCHECK_ALL' => $lang['Modcp_uncheck_all'],
		'L_INVERSE_SELECTION' => $lang['Modcp_inverse_selection'],
//--- Album Category Hierarchy : end
		'SORT_TIME' => ($sort_method == 'pic_time') ? 'selected="selected"' : '',
		'SORT_PIC_TITLE' => ($sort_method == 'pic_title') ? 'selected="selected"' : '',
		'SORT_VIEW' => ($sort_method == 'pic_view_count') ? 'selected="selected"' : '',

		'SORT_RATING_OPTION' => $sort_rating_option,
		'SORT_USERNAME_OPTION' => $sort_username_option,
		'SORT_COMMENTS_OPTION' => $sort_comments_option,
		'SORT_NEW_COMMENT_OPTION' => $sort_new_comment_option,

		'L_ASC' => $lang['Sort_Ascending'],
		'L_DESC' => $lang['Sort_Descending'],

		'SORT_ASC' => ($sort_order == 'ASC') ? 'selected="selected"' : '',
		'SORT_DESC' => ($sort_order == 'DESC') ? 'selected="selected"' : ''
		)
	);

	//
	// Generate the page (ModCP)
	//
	$template->pparse('body');

	include($phpbb_root_path . 'includes/page_tail.'.$phpEx);
}
else
{
	//
	// Switch with $mode
	//
	if ($mode == 'move')
	{
		//-----------------------------
		// MOVE
		//-----------------------------

		if( !isset($_POST['target']) )
		{
			// if "target" has not been set, we will open the category select form
			//
			// we must check POST method now
			$pic_id_array = array();
			if ($pic_id != FALSE) // from GET
			{
				$pic_id_array[] = $pic_id;
			}
			else
			{
				// Check $pic_id[] on POST Method now
				if( isset($_POST['pic_id']) )
				{
					$pic_id_array = $_POST['pic_id'];
					if( !is_array($pic_id_array) )
					{
						message_die(GENERAL_ERROR, 'Invalid request');
					}
				}
				else
				{
					message_die(GENERAL_ERROR, 'No pics specified');
				}
			}

			// We must send out the $pic_id_array to store data between page changing
			for ($i = 0; $i < count($pic_id_array); $i++)
			{
				$template->assign_block_vars('pic_id_array', array(
					'VALUE' => $pic_id_array[$i])
				);
			}

			//
			// Create categories select
			//
			//--- Album Category Hierarchy : begin
			//--- Version : <= 1.3.0
			album_read_tree($album_user_id, ALBUM_AUTH_VIEW_AND_UPLOAD); // only categories user can view AND upload too
			$category_select  = '<select name="target">';
			$category_select  .= album_get_tree_option($cat_id, ALBUM_AUTH_MODERATOR);
			$category_select  .= '</select>';
			//--- Album Category Hierarchy : end

			// end write

			//
			// Start output of page
			//
			$page_title = $lang['Album'];
			include($phpbb_root_path . 'includes/page_header.'.$phpEx);

			$template->set_filenames(array(
				'body' => 'album_move_body.tpl')
			);

			$template->assign_vars(array(
				'S_ALBUM_ACTION' => append_sid(album_append_uid("album_modcp.$phpEx?mode=move&amp;cat_id=$cat_id")),
				'L_MOVE' => $lang['Move'],
				'L_MOVE_TO_CATEGORY' => $lang['Move_to_Category'],
				'S_CATEGORY_SELECT' => $category_select)
			);

			//
			// Generate the page
			//
			$template->pparse('body');

			include($phpbb_root_path . 'includes/page_tail.'.$phpEx);
		}
		else
		{
			// Do the MOVE action
			//
			// Now we only get $pic_id[] via POST (after the select target screen)
			if( isset($_POST['pic_id']) )
			{
				$pic_id = $_POST['pic_id'];
				if( is_array($pic_id) )
				{
					$pic_id_sql = implode(',', $pic_id);
				}
				else
				{
					message_die(GENERAL_ERROR, 'Invalid request');
				}
			}
			else
			{
				message_die(GENERAL_ERROR, 'No pics specified');
			}
			//--- Album Category Hierarchy : begin
			//--- Version : <= 1.1.0
			// if we are trying to move picture(s) to root category or a 
			// personal gallary (shouldn't be possible), but better save then sorry
			// ...then return an error
			if (intval($_POST['target']) <= 0) {
			    message_die(GENERAL_ERROR, 'Can\'t move pictures directly to Root category');
			}
			//--- Album Category Hierarchy : end
			// well, we got the array of pic_id but we must do a check to make sure all these
			// pics are in this category (prevent some naughty moderators to access un-authorised pics)
			$sql = "SELECT pic_id
					FROM ". ALBUM_TABLE ."
					WHERE pic_id IN ($pic_id_sql) AND pic_cat_id <> $cat_id";
			if( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not obtain album information', '', __LINE__, __FILE__, $sql);
			}
			if( $db->sql_numrows($result) > 0 )
			{
				message_die(GENERAL_MESSAGE, $lang['Not_Authorised']);
			}

			// Update the DB
			$sql = "UPDATE ". ALBUM_TABLE ."
					SET pic_cat_id = ". intval($_POST['target']) ."
					WHERE pic_id IN ($pic_id_sql)";
			if( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not update album information', '', __LINE__, __FILE__, $sql);
			}

			$message = $lang['Pics_moved_successfully'] .'<br /><br />'. sprintf($lang['Click_return_category'], "<a href=\"" . append_sid(album_append_uid("album_cat.$phpEx?cat_id=$cat_id")) . "\">", "</a>") .'<br /><br />'. sprintf($lang['Click_return_modcp'], "<a href=\"" . append_sid(album_append_uid("album_modcp.$phpEx?cat_id=$cat_id")) . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_album_index'], "<a href=\"" . append_sid(album_append_uid("album.$phpEx")) . "\">", "</a>");

			message_die(GENERAL_MESSAGE, $message);
		}
	}
	else if ($mode == 'lock')
	{
		//-----------------------------
		// LOCK
		//-----------------------------

		// we must check POST method now
		if ($pic_id != FALSE) // from GET
		{
			$pic_id_sql = $pic_id;
		}
		else
		{
			// Check $pic_id[] on POST Method now
			if( isset($_POST['pic_id']) )
			{
				$pic_id = $_POST['pic_id'];
				if( is_array($pic_id) )
				{
					$pic_id_sql = implode(',', $pic_id);
				}
				else
				{
					message_die(GENERAL_ERROR, 'Invalid request');
				}
			}
			else
			{
				message_die(GENERAL_ERROR, 'No pics specified');
			}
		}

		// well, we got the array of pic_id but we must do a check to make sure all these
		// pics are in this category (prevent some naughty moderators to access un-authorised pics)
		$sql = "SELECT pic_id
				FROM ". ALBUM_TABLE ."
				WHERE pic_id IN ($pic_id_sql) AND pic_cat_id <> $cat_id";
		if( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not obtain album information', '', __LINE__, __FILE__, $sql);
		}
		if( $db->sql_numrows($result) > 0 )
		{
			message_die(GENERAL_ERROR, $lang['Not_Authorised']);
		}

		// update the DB
		$sql = "UPDATE ". ALBUM_TABLE ."
				SET pic_lock = 1
				WHERE pic_id IN ($pic_id_sql)";
		if( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not update album information', '', __LINE__, __FILE__, $sql);
		}

		$message = $lang['Pics_locked_successfully'] .'<br /><br />';

		if ($album_user_id != ALBUM_PUBLIC_GALLERY)
		{
			$message .= sprintf($lang['Click_return_category'], "<a href=\"" . append_sid(album_append_uid("album_cat.$phpEx?cat_id=$cat_id")) . "\">", "</a>") .'<br /><br />'. sprintf($lang['Click_return_modcp'], "<a href=\"" . append_sid(album_append_uid("album_modcp.$phpEx?cat_id=$cat_id")) . "\">", "</a>") . "<br /><br />";
		}
		else
		{
			$message .= sprintf($lang['Click_return_personal_gallery'], "<a href=\"" . append_sid(album_append_uid("album.$phpEx")) . "\">", "</a>");
		}

		$message .= '<br /><br />' . sprintf($lang['Click_return_album_index'], "<a href=\"" . append_sid("album.$phpEx") . "\">", "</a>");

		message_die(GENERAL_MESSAGE, $message);
	}
	else if ($mode == 'unlock')
	{
		//-----------------------------
		// UNLOCK
		//-----------------------------

		// we must check POST method now
		if ($pic_id != FALSE) // from GET
		{
			$pic_id_sql = $pic_id;
		}
		else
		{
			// Check $pic_id[] on POST Method now
			if( isset($_POST['pic_id']) )
			{
				$pic_id = $_POST['pic_id'];
				if( is_array($pic_id) )
				{
					$pic_id_sql = implode(',', $pic_id);
				}
				else
				{
					message_die(GENERAL_ERROR, 'Invalid request');
				}
			}
			else
			{
				message_die(GENERAL_ERROR, 'No pics specified');
			}
		}

		// well, we got the array of pic_id but we must do a check to make sure all these
		// pics are in this category (prevent some naughty moderators to access un-authorised pics)
		$sql = "SELECT pic_id
				FROM ". ALBUM_TABLE ."
				WHERE pic_id IN ($pic_id_sql) AND pic_cat_id <> $cat_id";
		if( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not obtain album information', '', __LINE__, __FILE__, $sql);
		}
		if( $db->sql_numrows($result) > 0 )
		{
			message_die(GENERAL_ERROR, $lang['Not_Authorised']);
		}

		// update the DB
		$sql = "UPDATE ". ALBUM_TABLE ."
				SET pic_lock = 0
				WHERE pic_id IN ($pic_id_sql)";
		if( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not update album information', '', __LINE__, __FILE__, $sql);
		}

		$message = $lang['Pics_unlocked_successfully'] .'<br /><br />';

		if ($album_user_id != ALBUM_PUBLIC_GALLERY)
		{
			$message .= sprintf($lang['Click_return_category'], "<a href=\"" . append_sid(album_append_uid("album_cat.$phpEx?cat_id=$cat_id")) . "\">", "</a>") .'<br /><br />'. sprintf($lang['Click_return_modcp'], "<a href=\"" . append_sid(album_append_uid("album_modcp.$phpEx?cat_id=$cat_id")) . "\">", "</a>") . "<br /><br />";
		}
		else
		{
			$message .= sprintf($lang['Click_return_personal_gallery'], "<a href=\"" . append_sid(album_append_uid("album.$phpEx")) . "\">", "</a>");
		}

		$message .= '<br /><br />' . sprintf($lang['Click_return_album_index'], "<a href=\"" . append_sid("album.$phpEx") . "\">", "</a>");

		message_die(GENERAL_MESSAGE, $message);
	}
	else if ($mode == 'approval')
	{
		//-----------------------------
		// APPROVAL
		//-----------------------------

		// we must check POST method now
		if ($pic_id != FALSE) // from GET
		{
			$pic_id_sql = $pic_id;
		}
		else
		{
			// Check $pic_id[] on POST Method now
			if( isset($_POST['pic_id']) )
			{
				$pic_id = $_POST['pic_id'];
				if( is_array($pic_id) )
				{
					$pic_id_sql = implode(',', $pic_id);
				}
				else
				{
					message_die(GENERAL_ERROR, 'Invalid request');
				}
			}
			else
			{
				message_die(GENERAL_ERROR, 'No pics specified');
			}
		}

		// well, we got the array of pic_id but we must do a check to make sure all these
		// pics are in this category (prevent some naughty moderators to access un-authorised pics)
		$sql = "SELECT pic_id
				FROM ". ALBUM_TABLE ."
				WHERE pic_id IN ($pic_id_sql) AND pic_cat_id <> $cat_id";
		if( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not obtain album information', '', __LINE__, __FILE__, $sql);
		}
		if( $db->sql_numrows($result) > 0 )
		{
			message_die(GENERAL_ERROR, $lang['Not_Authorised']);
		}

		// update the DB
		$sql = "UPDATE ". ALBUM_TABLE ."
				SET pic_approval = 1
				WHERE pic_id IN ($pic_id_sql)";
		if( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not update album information', '', __LINE__, __FILE__, $sql);
		}

		$message = $lang['Pics_approved_successfully'] .'<br /><br />'. sprintf($lang['Click_return_category'], "<a href=\"" . append_sid(album_append_uid("album_cat.$phpEx?cat_id=$cat_id")) . "\">", "</a>") .'<br /><br />'. sprintf($lang['Click_return_modcp'], "<a href=\"" . append_sid(album_append_uid("album_modcp.$phpEx?cat_id=$cat_id")) . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_album_index'], "<a href=\"" . append_sid("album.$phpEx") . "\">", "</a>");

		message_die(GENERAL_MESSAGE, $message);
	}
	else if ($mode == 'unapproval')
	{
		//-----------------------------
		// UNAPPROVAL
		//-----------------------------

		// we must check POST method now
		if ($pic_id != FALSE) // from GET
		{
			$pic_id_sql = $pic_id;
		}
		else
		{
			// Check $pic_id[] on POST Method now
			if( isset($_POST['pic_id']) )
			{
				$pic_id = $_POST['pic_id'];
				if( is_array($pic_id) )
				{
					$pic_id_sql = implode(',', $pic_id);
				}
				else
				{
					message_die(GENERAL_ERROR, 'Invalid request');
				}
			}
			else
			{
				message_die(GENERAL_ERROR, 'No pics specified');
			}
		}

		// well, we got the array of pic_id but we must do a check to make sure all these
		// pics are in this category (prevent some naughty moderators to access un-authorised pics)
		$sql = "SELECT pic_id
				FROM ". ALBUM_TABLE ."
				WHERE pic_id IN ($pic_id_sql) AND pic_cat_id <> $cat_id";
		if( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not obtain album information', '', __LINE__, __FILE__, $sql);
		}
		if( $db->sql_numrows($result) > 0 )
		{
			message_die(GENERAL_ERROR, $lang['Not_Authorised']);
		}

		// update the DB
		$sql = "UPDATE ". ALBUM_TABLE ."
				SET pic_approval = 0
				WHERE pic_id IN ($pic_id_sql)";
		if( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not update album information', '', __LINE__, __FILE__, $sql);
		}

		$message = $lang['Pics_unapproved_successfully'] .'<br /><br />'. sprintf($lang['Click_return_category'], "<a href=\"" . append_sid(album_append_uid("album_cat.$phpEx?cat_id=$cat_id")) . "\">", "</a>") .'<br /><br />'. sprintf($lang['Click_return_modcp'], "<a href=\"" . append_sid(album_append_uid("album_modcp.$phpEx?cat_id=$cat_id")) . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_album_index'], "<a href=\"" . append_sid("album.$phpEx") . "\">", "</a>");

		message_die(GENERAL_MESSAGE, $message);
	}
	else if ($mode == 'delete')
	{
		//-----------------------------
		// DELETE
		//-----------------------------

		if ($auth_data['delete'] == 0)
		{
			message_die(GENERAL_ERROR, $lang['Not_Authorised']);
		}

		if( !isset($_POST['confirm']) )
		{
			// we must check POST method now
			$pic_id_array = array();
			if ($pic_id != FALSE) // from GET
			{
				$pic_id_array[] = $pic_id;
			}
			else
			{
				// Check $pic_id[] on POST Method now
				if( isset($_POST['pic_id']) )
				{
					$pic_id_array = $_POST['pic_id'];
					if( !is_array($pic_id_array) )
					{
						message_die(GENERAL_ERROR, 'Invalid request');
					}
				}
				else
				{
					message_die(GENERAL_ERROR, 'No pics specified');
				}
			}

			// We must send out the $pic_id_array to store data between page changing
			$hidden_field = '';
			for ($i = 0; $i < count($pic_id_array); $i++)
			{
				$hidden_field .= '<input name="pic_id[]" type="hidden" value="'. $pic_id_array[$i] .'" />' . "\n";
			}

			//
			// Start output of page
			//
			$page_title = $lang['Album'];
			include($phpbb_root_path . 'includes/page_header.'.$phpEx);

			$template->set_filenames(array(
				'body' => 'confirm_body.tpl')
			);

			$template->assign_vars(array(
				'MESSAGE_TITLE' => $lang['Confirm'],
				'MESSAGE_TEXT' => $lang['Album_delete_confirm'],
				'S_HIDDEN_FIELDS' => $hidden_field,
				'L_NO' => $lang['No'],
				'L_YES' => $lang['Yes'],
				'S_CONFIRM_ACTION' => append_sid(album_append_uid("album_modcp.$phpEx?mode=delete&amp;cat_id=$cat_id")),
				)
			);

			//
			// Generate the page
			//
			$template->pparse('body');

			include($phpbb_root_path . 'includes/page_tail.'.$phpEx);
		}
		else
		{
			//
			// Do the delete here...
			//
			if( isset($_POST['pic_id']) )
			{
				$pic_id = $_POST['pic_id'];
				if( is_array($pic_id) )
				{
					$pic_id_sql = implode(',', $pic_id);
				}
				else
				{
					message_die(GENERAL_ERROR, 'Invalid request');
				}
			}
			else
			{
				message_die(GENERAL_ERROR, 'No pics specified');
			}

			// well, we got the array of pic_id but we must do a check to make sure all these
			// pics are in this category (prevent some naughty moderators to access un-authorised pics)
			$sql = "SELECT pic_id
					FROM ". ALBUM_TABLE ."
					WHERE pic_id IN ($pic_id_sql) AND pic_cat_id <> $cat_id";
			if( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not obtain album information', '', __LINE__, __FILE__, $sql);
			}
			if( $db->sql_numrows($result) > 0 )
			{
				message_die(GENERAL_ERROR, $lang['Not_Authorised']);
			}

			// Delete all comments
			$sql = "DELETE FROM ". ALBUM_COMMENT_TABLE ."
					WHERE comment_pic_id IN ($pic_id_sql)";
			if( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not delete related comments', '', __LINE__, __FILE__, $sql);
			}

			// Delete all ratings
			$sql = "DELETE FROM ". ALBUM_RATE_TABLE ."
					WHERE rate_pic_id IN ($pic_id_sql)";
			if( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not delete related ratings', '', __LINE__, __FILE__, $sql);
			}

			// Delete Physical Files
			// first we need filenames
			$sql = "SELECT pic_filename, pic_thumbnail
					FROM ". ALBUM_TABLE ."
					WHERE pic_id IN ($pic_id_sql)";
			if( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not obtain filenames', '', __LINE__, __FILE__, $sql);
			}
			$filerow = array();
			while( $row = $db->sql_fetchrow($result) )
			{
				$filerow[] = $row;
			}
			for ($i = 0; $i < count($filerow); $i++)
			{
				if( ($filerow[$i]['pic_thumbnail'] != '') and (@file_exists(ALBUM_CACHE_PATH . $filerow[$i]['pic_thumbnail'])) )
				{
					@unlink(ALBUM_CACHE_PATH . $filerow[$i]['pic_thumbnail']);
				}
				@unlink(ALBUM_UPLOAD_PATH . $filerow[$i]['pic_filename']);
			}

			// Delete DB entry
			$sql = "DELETE FROM ". ALBUM_TABLE ."
					WHERE pic_id IN ($pic_id_sql)";
			if( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not delete DB entry', '', __LINE__, __FILE__, $sql);
			}

			$message = $lang['Pics_deleted_successfully'] .'<br /><br />'. sprintf($lang['Click_return_category'], "<a href=\"" . append_sid(album_append_uid("album_cat.$phpEx?cat_id=$cat_id")) . "\">", "</a>") .'<br /><br />'. sprintf($lang['Click_return_modcp'], "<a href=\"" . append_sid(album_append_uid("album_modcp.$phpEx?cat_id=$cat_id")) . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_album_index'], "<a href=\"" . append_sid("album.$phpEx") . "\">", "</a>");

			message_die(GENERAL_MESSAGE, $message);
		}
	}
	else
	{
		message_die(GENERAL_ERROR, 'Invalid_mode');
	}
}


// +------------------------------------------------------+
// |  Powered by Photo Album 2.x.x (c) 2002-2003 Smartor  |
// +------------------------------------------------------+


?>
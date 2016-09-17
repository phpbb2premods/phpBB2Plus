<?php
/***************************************************************************
 *                                album.php
 *                            -------------------
 *   begin                : Tuesday, February 04, 2003
 *   copyright            : (C) 2003 Smartor
 *   email                : smartor_xp@hotmail.com
 *
 *   $Id: album.php,v 2.0.7 2003/03/15 10:16:30 ngoctu Exp $
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
 *		-added images to rating, insted of number for rating
 *		-added random pictures
 *		-added highest rated pictures (@ MarkFulton.com)
 *		-coment # for categories
 *		-last comment in categories
 *
 ***************************************************************************/

/***************************************************************************
 *                            MODIFICATIONS
 *                           ---------------
 *     copyright            : (C) 2004 IdleVoid
 *     email                : idlevoid@slater.dk
 *     file version         : 1.0.8
 *     release              : 1.3.0
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
//--- Album Category Hierarchy : begin
//--- version : 1.1.0
// ------------------------------------
// Check $album_user_id
// ------------------------------------
if (isset ($_POST['user_id']))
{
	$album_user_id = intval($_POST['user_id']);
}
elseif (isset ($_GET['user_id']))
{
	$album_user_id = intval($_GET['user_id']);
}
else
{
	// if no user_id was supplied then we aren't going to show a personal gallery category
	$album_user_id = ALBUM_PUBLIC_GALLERY;
}

//--- version : 1.3.0
if ($album_user_id != ALBUM_PUBLIC_GALLERY)
{
	$cat_id = ALBUM_ROOT_CATEGORY;
	
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

	if (isset ($_POST['cat_id']))
	{
		$cat_id = intval($_POST['cat_id']);
	}
	elseif (isset ($_GET['cat_id']))
	{
		$cat_id = intval($_GET['cat_id']);
	}

	if ($album_user_id < 1)
	{
        if (!$userdata['session_logged_in'])
        {
		    redirect(append_sid(album_append_uid("login.$phpEx?redirect=album.$phpEx", true)));
        }
        else
        {
            $album_user_id = $userdata['user_id'];
            redirect(append_sid(album_append_uid("album.$phpEx", true)));
        }
	}

	if ($cat_id != ALBUM_ROOT_CATEGORY && $cat_id != album_get_personal_root_id($album_user_id))
	{
		redirect(append_sid(album_append_uid("album_cat.$phpEx" . album_build_url_parameters($_GET), true)));
	}
}
//--- Album Category Hierarchy : end

/*
+----------------------------------------------------------
| Build Categories Index
+----------------------------------------------------------
*/
//--- Album Category Hierarchy : begin
//--- version : 1.1.0
//--- removed
/*

$sql = "SELECT c.*, COUNT(p.pic_id) AS count
		FROM ". ALBUM_CAT_TABLE ." AS c
			LEFT JOIN ". ALBUM_TABLE ." AS p ON c.cat_id = p.pic_cat_id
		WHERE cat_id <> 0
		GROUP BY cat_id
		ORDER BY cat_order ASC";
if( !($result = $db->sql_query($sql)) )
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

$allowed_cat = ''; // For Recent Public Pics below

//
// $catrows now stores all categories which this user can view. Dump them out!
//
for ($i = 0; $i < count($catrows); $i++)
{
	// --------------------------------
	// Build allowed category-list (for recent pics after here)
	// --------------------------------

	$allowed_cat .= ($allowed_cat == '') ? $catrows[$i]['cat_id'] : ',' . $catrows[$i]['cat_id'];


	// --------------------------------
	// Build moderators list
	// --------------------------------

	$l_moderators = '';
	$moderators_list = '';

	$grouprows= array();

	if( $catrows[$i]['cat_moderator_groups'] != '')
	{
		// We have usergroup_ID, now we need usergroup name
		$sql = "SELECT group_id, group_name
				FROM " . GROUPS_TABLE . "
				WHERE group_single_user <> 1
					AND group_type <> ". GROUP_HIDDEN ."
					AND group_id IN (". $catrows[$i]['cat_moderator_groups'] .")
				ORDER BY group_name ASC";
		if ( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not obtain usergroups data', '', __LINE__, __FILE__, $sql);
		}

		while( $row = $db->sql_fetchrow($result) )
		{
			$grouprows[] = $row;
		}
	}

	if( count($grouprows) > 0 )
	{
		$l_moderators = $lang['Moderators'];

		for ($j = 0; $j < count($grouprows); $j++)
		{
			$group_link = '<a href="'. append_sid("groupcp.$phpEx?". POST_GROUPS_URL .'='. $grouprows[$j]['group_id']) .'">'. $grouprows[$j]['group_name'] .'</a>';

			$moderators_list .= ($moderators_list == '') ? $group_link : ', ' . $group_link;
		}
	}


	// ------------------------------------------
	// Get Last Pic of this Category
	// ------------------------------------------

	if ($catrows[$i]['count'] == 0)
	{
		//
		// Oh, this category is empty
		//
		$last_pic_info = $lang['No_Pics'];
		$u_last_pic = '';
		$last_pic_title = '';
		
		//last coments
		$last_comment_info = "No Comments";
		$cat_total_comments = 0;
	}
	else
	{
		// ----------------------------
		// Check Pic Approval
		// ----------------------------

		if(($catrows[$i]['cat_approval'] == ALBUM_ADMIN) or ($catrows[$i]['cat_approval'] == ALBUM_MOD))
		{
			$pic_approval_sql = 'AND p.pic_approval = 1'; // Pic Approval ON
		}
		else
		{
			$pic_approval_sql = ''; // Pic Approval OFF
		}


		// ----------------------------
		// OK, we may do a query now...
		// ----------------------------

		$sql = "SELECT p.pic_id, p.pic_title, p.pic_user_id, p.pic_username, p.pic_time, p.pic_cat_id, u.user_id, u.username, COUNT(c.comment_id) AS comment_count
				FROM ". ALBUM_TABLE ." AS p
				LEFT JOIN " . ALBUM_COMMENT_TABLE . " AS c ON p.pic_cat_id = c.comment_cat_id
				LEFT JOIN ". USERS_TABLE ." AS u  ON p.pic_user_id = u.user_id 
				WHERE p.pic_cat_id = '". $catrows[$i]['cat_id'] ."' $pic_approval_sql
				GROUP BY p.pic_time
				ORDER BY p.pic_time DESC
				LIMIT 1";
		if ( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not get last pic information', '', __LINE__, __FILE__, $sql);
		}
		$lastrow = $db->sql_fetchrow($result);
		
		$sql = "SELECT c.comment_pic_id, c.comment_user_id, c.comment_username, c.comment_time, u.user_id, u.username, a.pic_id, a.pic_cat_id
				FROM " . ALBUM_COMMENT_TABLE . " AS c 
				LEFT JOIN " . USERS_TABLE . " AS u ON c.comment_user_id = u.user_id
				LEFT JOIN " . ALBUM_TABLE . " AS a ON c.comment_pic_id = a.pic_id
				WHERE a.pic_cat_id = '" . $catrows[$i]['cat_id'] . "' 
				ORDER BY c.comment_time DESC
				LIMIT 1";
				
		if ( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not get last pic information', '', __LINE__, __FILE__, $sql);
		}
		$lastcrow = $db->sql_fetchrow($result);
		
		// ----------------------------
		// Write the Date
		// ----------------------------

		$last_pic_info = create_date($board_config['default_dateformat'], $lastrow['pic_time'], $board_config['board_timezone']);

		$last_pic_info .= '<br />';


		// ----------------------------
		// Write username of last poster
		// ----------------------------

		if( ($lastrow['user_id'] == ALBUM_GUEST) or ($lastrow['username'] == '') )
		{
			$last_pic_info .= ($lastrow['pic_username'] == '') ? $lang['Guest'] : $lastrow['pic_username'];
		}
		else
		{
			$last_pic_info .= $lang['Poster'] .': <a href="'. append_sid("profile.$phpEx?mode=viewprofile&amp;". POST_USERS_URL .'='. $lastrow['user_id']) .'">'. $lastrow['username'] .'</a>';
		}


		// ----------------------------
		// Write the last pic's title.
		// Truncate it if it's too long
		// ----------------------------

		if( !isset($album_config['last_pic_title_length']) )
		{
			$album_config['last_pic_title_length'] = 25;
		}

		$lastrow['pic_title'] = $lastrow['pic_title'];

		if (strlen($lastrow['pic_title']) > $album_config['last_pic_title_length'])
		{
			$lastrow['pic_title'] = substr($lastrow['pic_title'], 0, $album_config['last_pic_title_length']) . '...';
		}

		$last_pic_info .= '<br />'. $lang['Pic_Title'] .': <a href="';

		$last_pic_info .= ($album_config['fullpic_popup']) ? append_sid("album_pic.$phpEx?pic_id=". $lastrow['pic_id']) .'" target="_blank">' : append_sid("album_showpage.$phpEx?pic_id=". $lastrow['pic_id']) .'">' ;

		$last_pic_info .= $lastrow['pic_title'] .'</a>';
		
		//last comment
		if ( $lastrow['comment_count'] == 0 )
		{
			$last_comment_info = "No Comments";
		}
		else
		{
			$last_comment_info = create_date($board_config['default_dateformat'], $lastcrow['comment_time'], $board_config['board_timezone']);
			$last_comment_info .= '<br />' . $lang['Poster'] . ': ';

			if( ($lastcrow['user_id'] == ALBUM_GUEST) or ($lastcrow['comment_username'] == '') )
				$last_comment_info .= ($lastcrow['comment_username'] == '') ? $lang['Guest'] : $lastcrow['comment_username'];
			else
				$last_comment_info .= '<a href="'. append_sid("profile.$phpEx?mode=viewprofile&amp;". POST_USERS_URL .'='. $lastcrow['user_id']) .'">'. $lastcrow['username'] .'</a>';
		}
		
		//comment count
		$cat_total_comments = $lastrow['comment_count'];
	}
	// END of Last Pic


	// ------------------------------------------
	// Parse to template the info of the current Category
	// ------------------------------------------

	$template->assign_block_vars('catrow', array(
		'U_VIEW_CAT' => append_sid("album_cat.$phpEx?cat_id=". $catrows[$i]['cat_id']),
		'CAT_TITLE' => $catrows[$i]['cat_title'],
		'CAT_DESC' => $catrows[$i]['cat_desc'],
		'L_MODERATORS' => $l_moderators,
		'MODERATORS' => $moderators_list,
		'PICS' => $catrows[$i]['count'],
		'COMMENTS' => $cat_total_comments,
		'LAST_COMMENT_INFO' => $last_comment_info,
		'LAST_PIC_INFO' => $last_pic_info)
	);
}
*/
//--- added
$catrows = array ();
//--- version :  1.3.0
$options = ($album_view_mode == ALBUM_VIEW_LIST ) ? ALBUM_READ_ALL_CATEGORIES|ALBUM_AUTH_VIEW : ALBUM_AUTH_VIEW;
$catrows = album_read_tree($album_user_id, $options);
//--- version : <= 1.1.0
// --------------------------------
// Build allowed category-list (for recent pics after here)
// $catrows array now stores all categories which this user can view.
// --------------------------------
$allowed_cat = ''; // For Recent Public Pics below
for ($i = 0; $i < count($catrows); $i ++)
{
	$allowed_cat .= ($allowed_cat == '') ? $catrows[$i]['cat_id'] : ','.$catrows[$i]['cat_id'];
}
//--- Album Category Hierarchy : end
//
// END of Categories Index
//

/*
+----------------------------------------------------------
| Recent Public Pics
+----------------------------------------------------------
*/
//--- Album Category Hierarchy : begin
//--- version : 1.1.0
//--- removed
/*
if ($album_sp_config['disp_late'] == 1)
{
	if ($allowed_cat != '')
	{
		$sql = "SELECT p.pic_id, p.pic_title, p.pic_desc, p.pic_user_id, p.pic_user_ip, p.pic_username, p.pic_time, p.pic_cat_id, p.pic_view_count, u.user_id, u.username, r.rate_pic_id, AVG(r.rate_point) AS rating, COUNT(DISTINCT c.comment_id) AS comments
				FROM ". ALBUM_TABLE ." AS p
					LEFT JOIN ". USERS_TABLE ." AS u ON p.pic_user_id = u.user_id
					LEFT JOIN ". ALBUM_CAT_TABLE ." AS ct ON p.pic_cat_id = ct.cat_id
					LEFT JOIN ". ALBUM_RATE_TABLE ." AS r ON p.pic_id = r.rate_pic_id
					LEFT JOIN ". ALBUM_COMMENT_TABLE ." AS c ON p.pic_id = c.comment_pic_id
				WHERE p.pic_cat_id IN ($allowed_cat) AND ( p.pic_approval = 1 OR ct.cat_approval = 0 )
				GROUP BY p.pic_id
				ORDER BY pic_time DESC
				LIMIT ". $album_sp_config['img_cols'] * $album_sp_config['img_rows'];
		if( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not query recent pics information', '', __LINE__, __FILE__, $sql);
		}

		$recentrow = array();

		while( $row = $db->sql_fetchrow($result) )
		{
			$recentrow[] = $row;
		}

		 $template->assign_block_vars('recent_pics_block', array());
		
		if (count($recentrow) > 0)
		{
			for ($i = 0; $i < count($recentrow); $i += $album_sp_config['img_cols'])
			{
				$template->assign_block_vars('recent_pics_block.recent_pics', array());

				for ($j = $i; $j < ($i + $album_sp_config['img_cols']); $j++)
				{
					if( $j >= count($recentrow) )
					{
						break;
					}

					$template->assign_block_vars('recent_pics_block.recent_pics.recent_col', array(
						'U_PIC' => ($album_config['fullpic_popup']) ? append_sid("album_pic.$phpEx?pic_id=". $recentrow[$j]['pic_id']) : append_sid("album_showpage.$phpEx?pic_id=". $recentrow[$j]['pic_id']),
						'THUMBNAIL' => append_sid("album_thumbnail.$phpEx?pic_id=". $recentrow[$j]['pic_id']),
						'DESC' => $recentrow[$j]['pic_desc']
						)
					);

					if( ($recentrow[$j]['user_id'] == ALBUM_GUEST) or ($recentrow[$j]['username'] == '') )
					{
						$recent_poster = ($recentrow[$j]['pic_username'] == '') ? $lang['Guest'] : $recentrow[$j]['pic_username'];
					}
					else
					{
						$recent_poster = '<a href="'. append_sid("profile.$phpEx?mode=viewprofile&amp;". POST_USERS_URL .'='. $recentrow[$j]['user_id']) .'">'. $recentrow[$j]['username'] .'</a>';
					}
					
					$rating_image = ImageRating($recentrow[$j]['rating']);
					
					$template->assign_block_vars('recent_pics_block.recent_pics.recent_detail', array(
						'TITLE' => '<a href = "album_showpage.' . $phpEx . '?pic_id=' . $recentrow[$j]['pic_id'] . '">' . $recentrow[$j]['pic_title'] . '</a>',
						'POSTER' => $recent_poster,
						'TIME' => create_date($board_config['default_dateformat'], $recentrow[$j]['pic_time'], $board_config['board_timezone']),

						'VIEW' => $recentrow[$j]['pic_view_count'],

						'RATING' => ($album_config['rate'] == 1) ? ( $lang['Rating'] . ': ' . $rating_image . '<br />') : '',

						'IP' => ($userdata['user_level'] == ADMIN) ? $lang['IP_Address'] . ': <a href="http://www.nic.com/cgi-bin/whois.cgi?query=' . decode_ip($recentrow[$j]['pic_user_ip']) . '" target="_blank">' . decode_ip($recentrow[$j]['pic_user_ip']) .'</a><br />' : ''
						)
					);
				}
			}
		}
		else
		{
			//
			// No Pics Found
			//
			$template->assign_block_vars('recent_pics_block.no_pics', array());
		}
	}
	else
	{
		//
		// No Cats Found
		//
		$template->assign_block_vars('recent_pics_block.no_pics', array());
	}
}
/* 
+---------------------------------------------------------- 
| Highest Rated Pics 
| by MarkFulton.com ...added RAND() part so highest pics dont always appear in same order..
+---------------------------------------------------------- 
*/ 
/*
if ($album_sp_config['disp_high'] == 1)
{
	if ($allowed_cat != '') 
	{ 
	   $sql = "SELECT p.pic_id, p.pic_title, p.pic_desc, p.pic_user_id, p.pic_user_ip, p.pic_username, p.pic_time, p.pic_cat_id, p.pic_view_count, u.user_id, u.username, r.rate_pic_id, AVG(r.rate_point) AS rating, COUNT(DISTINCT c.comment_id) AS comments 
	         FROM ". ALBUM_TABLE ." AS p 
	            LEFT JOIN ". USERS_TABLE ." AS u ON p.pic_user_id = u.user_id 
	            LEFT JOIN ". ALBUM_CAT_TABLE ." AS ct ON p.pic_cat_id = ct.cat_id 
	            LEFT JOIN ". ALBUM_RATE_TABLE ." AS r ON p.pic_id = r.rate_pic_id 
	            LEFT JOIN ". ALBUM_COMMENT_TABLE ." AS c ON p.pic_id = c.comment_pic_id 
	         WHERE p.pic_cat_id IN ($allowed_cat) AND ( p.pic_approval = 1 OR ct.cat_approval = 0 ) 
	         GROUP BY p.pic_id 
	         ORDER BY rating DESC, RAND()
	         LIMIT ". $album_sp_config['img_cols'] * $album_sp_config['img_rows']; 
	   if( !($result = $db->sql_query($sql)) ) 
	   { 
	      message_die(GENERAL_ERROR, 'Could not query highest rated pics information', '', __LINE__, __FILE__, $sql); 
	   } 

	   $highestrow = array(); 

	   while( $row = $db->sql_fetchrow($result) ) 
	   { 
	      $highestrow[] = $row; 
	   } 
		
		$template->assign_block_vars('highest_pics_block', array());

	   if (count($highestrow) > 0) 
	   { 
	      for ($i = 0; $i < count($highestrow); $i += $album_sp_config['img_cols']) 
	      { 
	         $template->assign_block_vars('highest_pics_block.highest_pics', array()); 

	         for ($j = $i; $j < ($i + $album_sp_config['img_cols']); $j++) 
	         { 
	            if( $j >= count($highestrow) ) 
	            { 
	               break; 
	            } 

	            $template->assign_block_vars('highest_pics_block.highest_pics.highest_col', array( 
	               'U_PIC' => ($album_config['fullpic_popup']) ? append_sid("album_pic.$phpEx?pic_id=". $highestrow[$j]['pic_id']) : append_sid("album_showpage.$phpEx?pic_id=". $highestrow[$j]['pic_id']), 
	               'THUMBNAIL' => append_sid("album_thumbnail.$phpEx?pic_id=". $highestrow[$j]['pic_id']), 
	               'DESC' => $highestrow[$j]['pic_desc'] 
	               ) 
	            ); 

	            if( ($highestrow[$j]['user_id'] == ALBUM_GUEST) or ($highestrow[$j]['username'] == '') ) 
	            { 
	               $highest_poster = ($highestrow[$j]['pic_username'] == '') ? $lang['Guest'] : $highestrow[$j]['pic_username']; 
	            } 
	            else 
	            { 
	               $highest_poster = '<a href="'. append_sid("profile.$phpEx?mode=viewprofile&". POST_USERS_URL .'='. $highestrow[$j]['user_id']) .'">'. $highestrow[$j]['username'] .'</a>'; 
	            } 
				
				$rating_image = ImageRating($highestrow[$j]['rating']);
				
	            $template->assign_block_vars('highest_pics_block.highest_pics.highest_detail', array( 
	               'H_TITLE' => '<a href = "album_showpage.' . $phpEx . '?pic_id=' . $highestrow[$j]['pic_id'] . '">' . $highestrow[$j]['pic_title'] . '</a>', 
	               'H_POSTER' => $highest_poster, 
	               'H_TIME' => create_date($board_config['default_dateformat'], $highestrow[$j]['pic_time'], $board_config['board_timezone']), 

	               'H_VIEW' => $highestrow[$j]['pic_view_count'], 

	               'H_RATING' => ($album_config['rate'] == 1) ? ( $lang['Rating'] . ': ' . $rating_image . '<br />') : '', 

	               'H_IP' => ($userdata['user_level'] == ADMIN) ? $lang['IP_Address'] . ': <a href="http://www.nic.com/cgi-bin/whois.cgi?query=' . decode_ip($highestrow[$j]['pic_user_ip']) . '" target="_blank">' . decode_ip($highestrow[$j]['pic_user_ip']) .'</a><br />' : '' 
	               ) 
	            ); 
	         } 
	      } 
	   } 
	   else 
	   { 
	      // 
	      // No Pics Found 
	      // 
	      $template->assign_block_vars('highest_pics_block.no_pics', array()); 
	   } 
	} 
	else 
	{ 
	   // 
	   // No Cats Found 
	   // 
	   $template->assign_block_vars('highest_pics_block.no_pics', array()); 
	} 
}

/*
+----------------------------------------------------------
| Random Pics 
| by CLowN
+----------------------------------------------------------
*/
/*
if ($album_sp_config['disp_rand'] == 1)
{
	if ($allowed_cat != '')
	{
		$sql = "SELECT p.pic_id, p.pic_title, p.pic_desc, p.pic_user_id, p.pic_user_ip, p.pic_username, p.pic_time, p.pic_cat_id, p.pic_view_count, u.user_id, u.username, r.rate_pic_id, AVG(r.rate_point) AS rating, COUNT(DISTINCT c.comment_id) AS comments
				FROM ". ALBUM_TABLE ." AS p
					LEFT JOIN ". USERS_TABLE ." AS u ON p.pic_user_id = u.user_id
					LEFT JOIN ". ALBUM_CAT_TABLE ." AS ct ON p.pic_cat_id = ct.cat_id
					LEFT JOIN ". ALBUM_RATE_TABLE ." AS r ON p.pic_id = r.rate_pic_id
					LEFT JOIN ". ALBUM_COMMENT_TABLE ." AS c ON p.pic_id = c.comment_pic_id
				WHERE p.pic_cat_id IN ($allowed_cat) AND ( p.pic_approval = 1 OR ct.cat_approval = 0 )
				GROUP BY p.pic_id
				ORDER BY RAND()
				LIMIT ". $album_sp_config['img_cols'] * $album_sp_config['img_rows'];
		if( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not query rand pics information', '', __LINE__, __FILE__, $sql);
		}

		$randrow = array();

		while( $row = $db->sql_fetchrow($result) )
		{
			$randrow[] = $row;
		}
		
		$template->assign_block_vars('random_pics_block', array());

		if (count($randrow) > 0)
		{
			for ($i = 0; $i < count($randrow); $i += $album_sp_config['img_cols'])
			{
				$template->assign_block_vars('random_pics_block.rand_pics', array());

				for ($j = $i; $j < ($i + $album_sp_config['img_cols']); $j++)
				{
					if( $j >= count($randrow) )
					{
						break;
					}

					$template->assign_block_vars('random_pics_block.rand_pics.rand_col', array(
						'U_PIC' => ($album_config['fullpic_popup']) ? append_sid("album_pic.$phpEx?pic_id=". $randrow[$j]['pic_id']) : append_sid("album_showpage.$phpEx?pic_id=". $randrow[$j]['pic_id']),
						'THUMBNAIL' => append_sid("album_thumbnail.$phpEx?pic_id=". $randrow[$j]['pic_id']),
						'DESC' => $randrow[$j]['pic_desc']
						)
					);

					if( ($randrow[$j]['user_id'] == ALBUM_GUEST) or ($randrow[$j]['username'] == '') )
					{
						$rand_poster = ($randrow[$j]['pic_username'] == '') ? $lang['Guest'] : $randrow[$j]['pic_username'];
					}
					else
					{
						$rand_poster = '<a href="'. append_sid("profile.$phpEx?mode=viewprofile&amp;". POST_USERS_URL .'='. $randrow[$j]['user_id']) .'">'. $randrow[$j]['username'] .'</a>';
					}
					
					
					$rating_image = ImageRating($randrow[$j]['rating']);
					

					$template->assign_block_vars('random_pics_block.rand_pics.rand_detail', array(
						'TITLE' => '<a href = "album_showpage.' . $phpEx . '?pic_id=' . $randrow[$j]['pic_id'] . '">' . $randrow[$j]['pic_title'] . '</a>',
						'POSTER' => $rand_poster,
						'TIME' => create_date($board_config['default_dateformat'], $randrow[$j]['pic_time'], $board_config['board_timezone']),

						'VIEW' => $randrow[$j]['pic_view_count'],

						'RATING' => ($album_config['rate'] == 1) ? ( $lang['Rating'] . ': ' . $rating_image . '<br />') : '',

						'COMMENTS' => ($album_config['comment'] == 1) ? ( '<a href="'. append_sid("album_showpage.$phpEx?pic_id=". $randrow[$j]['pic_id']) . '">' . $lang['Comments'] . '</a>: ' . $randrow[$j]['comments'] . '<br />') : '',

						'IP' => ($userdata['user_level'] == ADMIN) ? $lang['IP_Address'] . ': <a href="http://www.nic.com/cgi-bin/whois.cgi?query=' . decode_ip($randrow[$j]['pic_user_ip']) . '" target="_blank">' . decode_ip($randrow[$j]['pic_user_ip']) .'</a><br />' : ''
						)
					);
				}
			}
		}
		else
		{
			//
			// No Pics Found
			//
			$template->assign_block_vars('random_pics_block.no_pics', array());
		}
	}
	else
	{
		//
		// No Cats Found
		//
		$template->assign_block_vars('random_pics_block.no_pics', array());
	}
}

/*
+----------------------------------------------------------
| Start output the page
+----------------------------------------------------------
*/
/*
$page_title = $lang['Album'];
include($phpbb_root_path . 'includes/page_header.'.$phpEx);

$template->set_filenames(array(
	'body' => 'album_index_body.tpl')
);

$template->assign_vars(array(
	'L_CATEGORY' => $lang['Category'],
	'L_PICS' => $lang['Pics'],
	'L_LAST_PIC' => $lang['Last_Pic'],

	'U_YOUR_PERSONAL_GALLERY' => append_sid("album_personal.$phpEx?user_id=". $userdata['user_id']),
	'L_YOUR_PERSONAL_GALLERY' => $lang['Your_Personal_Gallery'],

	'U_USERS_PERSONAL_GALLERIES' => append_sid("album_personal_index.$phpEx"),
	'L_USERS_PERSONAL_GALLERIES' => $lang['Users_Personal_Galleries'],

	'S_COLS' => $album_sp_config['img_cols'],
	'S_COL_WIDTH' => (100/$album_sp_config['img_cols']) . '%',
	'TARGET_BLANK' => ($album_config['fullpic_popup']) ? 'target="_blank"' : '',
	'L_RECENT_PUBLIC_PICS' => $lang['Recent_Public_Pics'],
	'L_NO_PICS' => $lang['No_Pics'],
	'L_PIC_TITLE' => $lang['Pic_Title'],
	'L_VIEW' => $lang['View'],
	'L_POSTER' => $lang['Poster'],
	'L_POSTED' => $lang['Posted'],
	'L_PUBLIC_CATS' => $lang['Public_Categories'])
);
*/
//--- added
// ------------------------------------
// Build the sort method and sort order
// information
// ------------------------------------

if (isset ($_GET['start']))
{
	$start = intval($_GET['start']);
}
elseif (isset ($_POST['start']))
{
	$start = intval($_POST['start']);
}
else
{
	$start = 0;
}

if (isset ($_GET['sort_method']))
{
	switch ($_GET['sort_method'])
	{
		case 'pic_time' :
			$sort_method = 'pic_time';
			break;
		case 'pic_title' :
			$sort_method = 'pic_title';
			break;
		case 'username' :
			$sort_method = 'username';
			break;
		case 'pic_view_count' :
			$sort_method = 'pic_view_count';
			break;
		case 'rating' :
			$sort_method = 'rating';
			break;
		case 'comments' :
			$sort_method = 'comments';
			break;
		case 'new_comment' :
			$sort_method = 'new_comment';
			break;
		default :
			$sort_method = $album_config['sort_method'];
	}
}
elseif (isset ($_POST['sort_method']))
{
	switch ($_POST['sort_method'])
	{
		case 'pic_time' :
			$sort_method = 'pic_time';
			break;
		case 'pic_title' :
			$sort_method = 'pic_title';
			break;
		case 'username' :
			$sort_method = 'username';
			break;
		case 'pic_view_count' :
			$sort_method = 'pic_view_count';
			break;
		case 'rating' :
			$sort_method = 'rating';
			break;
		case 'comments' :
			$sort_method = 'comments';
			break;
		case 'new_comment' :
			$sort_method = 'new_comment';
			break;
		default :
			$sort_method = $album_config['sort_method'];
	}
}
else
{
	$sort_method = $album_config['sort_method'];
}

if (isset ($_GET['sort_order']))
{
	switch ($_GET['sort_order'])
	{
		case 'ASC' :
			$sort_order = 'ASC';
			break;
		case 'DESC' :
			$sort_order = 'DESC';
			break;
		default :
			$sort_order = $album_config['sort_order'];
	}
}
elseif (isset ($_POST['sort_order']))
{
	switch ($_POST['sort_order'])
	{
		case 'ASC' :
			$sort_order = 'ASC';
			break;
		case 'DESC' :
			$sort_order = 'DESC';
			break;
		default :
			$sort_order = $album_config['sort_order'];
	}
}
else
{
	$sort_order = $album_config['sort_order'];
}

// ------------------------------------
// additional sorting options
// ------------------------------------
if ($album_user_id != ALBUM_PUBLIC_GALLERY)
{
	$sort_rating_option = '';
	$sort_comments_option = '';
	$sort_new_comment_option = '';

	if ($album_config['rate'] == 1)
	{
		$sort_rating_option = '<option value="rating" ';
		$sort_rating_option .= ($sort_method == 'rating') ? 'selected="selected"' : '';
		$sort_rating_option .= '>'.$lang['Rating'].'</option>';
	}
	if ($album_config['comment'] == 1)
	{
		$sort_comments_option = '<option value="comments" ';
		$sort_comments_option .= ($sort_method == 'comments') ? 'selected="selected"' : '';
		$sort_comments_option .= '>'.$lang['Comments'].'</option>';

		$sort_new_comment_option = '<option value="new_comment" ';
		$sort_new_comment_option .= ($sort_method == 'new_comment') ? 'selected="selected"' : '';
		$sort_new_comment_option .= '>'.$lang['New_Comment'].'</option>';
	}
}

/*
+----------------------------------------------------------
| Start output the page
+----------------------------------------------------------
*/

$page_title = $lang['Album'];

//--- Album Category Hierarchy : begin
//--- version : 1.1.0
// is it a public gallery ?
if ($album_user_id == ALBUM_PUBLIC_GALLERY)
{
	include($phpbb_root_path . 'includes/page_header.'.$phpEx);

	$template->set_filenames(array(
		'body' => 'album_index_body.tpl')
	);

	if (defined('ALBUM_SP_CONFIG_TABLE'))
	{
		$cols = $album_sp_config['img_cols'];
		$cols_width = (100/$album_sp_config['img_cols']) . '%';

		//----------------------------------------------------------
		// Recent Public Pics
		//----------------------------------------------------------
		if ($album_sp_config['disp_late'] == 1)
		{
		    album_build_recent_pics($allowed_cat);
		}

		//----------------------------------------------------------
		// Highest Rated Pics
		// by MarkFulton.com ...added RAND() part so highest pics dont always appear in same order..
		//----------------------------------------------------------
		if ($album_sp_config['disp_high'] == 1)
		{
	        album_build_highest_rated_pics($allowed_cat);
		}
		
		//----------------------------------------------------------
		//Random Pics by CLowN
		//----------------------------------------------------------
		if ($album_sp_config['disp_rand'] == 1)
		{
	        album_build_random_pics($allowed_cat);
		}
	}
	else
	{
		$cols = $album_config['cols_per_page'];
		$cols_width = (100/$album_config['cols_per_page']) . '%';

		//----------------------------------------------------------
  		// recent pictures are always on when not using CLowN's Super Charged Pack
		album_build_recent_pics($allowed_cat);
		
        // these aren't enabled since they are infact part of CLowN's Super Charged Pack;
        // they do work even if you haven't installed his mod.
        //album_build_highest_rated_pics($cat_id, $allowed_cat);
        //album_build_random_pics($cat_id, $allowed_cat);		
	}

	$template->assign_vars(array(
		'S_COLS' => $cols,
		'S_COL_WIDTH' => $cols_width,
		'TARGET_BLANK' => ($album_config['fullpic_popup']) ? 'target="_blank"' : '',
		'L_RECENT_PUBLIC_PICS' => $lang['Recent_Public_Pics'],
		'L_NO_PICS' => $lang['No_Pics'],
		'L_PIC_TITLE' => $lang['Pic_Title'],
		'L_VIEW' => $lang['View'],
		'L_POSTER' => $lang['Poster'],
		'L_HIGHEST_RATED_PICS' => $lang['Highest_Rated_Pics'],
		'L_RANDOM_PICS' => $lang['Random_Pics'],
		'L_POSTED' => $lang['Posted'])
	);	
}
// it's a personal gallery, and in the root folder
else
{
 	if ($album_view_mode == ALBUM_VIEW_LIST)
 	{
 		include ($album_root_path.'album_memberlist.'.$phpEx);
	}
	else
	{
		// include our special personal gallery files
		// this file holds all the code to handle personal galleries
		// except moderation and management of personal gallery categories.
		include ($album_root_path.'album_personal.'.$phpEx);
	}
}

if (empty($album_view_mode))
{
	album_display_index($album_user_id, ALBUM_ROOT_CATEGORY, true, true, true);
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
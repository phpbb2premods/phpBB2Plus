<?php

if ( !defined('IN_PHPBB') )
{
	die('Hacking attempt');
}

/***************************************************************************
 *                          album_hierarchy_sql.php
 *                          ------------------------------------------------
 *     begin                : Friday, June 12, 2004
 *     copyright            : (C) 2004 IdleVoid
 *     email                : idlevoid@slater.dk
 *     file version         : 1.0.9
 *     release              : 1.3.0
 ****************************************************************************/

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
 * This mod is strongly based on the Forum Hiearchy Category Mod by Ptirhiik
 * Alot of credit goes to Ptirhiik and ClowN
 * And some small part of this code is copyrighted by Ptirhiik and ClowN.
 *
 ***************************************************************************/

// ------------------------------------------------------------------------
// Reorder_cat updates the database with the new order value, normally used
// after delete or cat move
// ------------------------------------------------------------------------
function reorder_cat($user_id = ALBUM_PUBLIC_GALLERY)
{
	album_reorder_cat($user_id);
}
function album_reorder_cat($user_id = ALBUM_PUBLIC_GALLERY)
{
	global $album_data , $db;

	if ( count($album_data['data']) == 0 )
    {
		album_read_tree($user_id);
	}

	// update with new order
	$order = 0;
	for ($i = 0; $i < count($album_data['data']); $i++ )
	{
		if ( !empty($album_data['id'][$i]) )
		{
			$order += 10;
			$sql = "UPDATE " . ALBUM_CAT_TABLE . "
					SET cat_order = $order
					WHERE cat_id = " . intval($album_data['id'][$i]);

			if ( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Couldn\'t reorder forums/categories table', '', __LINE__, __FILE__, $sql);
			}
		}
	}

	// re-read the tree
    album_read_tree($user_id);
}

// ------------------------------------------------------------------------
// Read the album information from the database, either public or personal
// ------------------------------------------------------------------------
function album_read_tree($user_id = ALBUM_PUBLIC_GALLERY, $options = ALBUM_AUTH_VIEW)
{
	global $db, $album_data , $userdata;

    $can_view = (int) checkFlag($options, ALBUM_AUTH_VIEW);
    $can_upload = (int) checkFlag($options, ALBUM_AUTH_UPLOAD);
    $can_rate = (int) checkFlag($options, ALBUM_AUTH_RATE);
    $can_comment = (int) checkFlag($options, ALBUM_AUTH_COMMENT);
    $can_edit = (int) checkFlag($options, ALBUM_AUTH_EDIT);
    $can_delete = (int) checkFlag($options, ALBUM_AUTH_DELETE);

	// parent categories
    $parents = array();
	// read categories and categories with right user access rights
    $cats = array();

	if ( count($album_data['data']) > 0)
    {
	    return ALBUM_DATA_ALREADY_READ;
	}

	$parent_root_id = ALBUM_ROOT_CATEGORY;

	if (checkFlag($options, ALBUM_READ_ALL_CATEGORIES))
	{
		// All galleries, both public and personal
	 	$sql = "SELECT c.*, COUNT(p.pic_id) AS count, u.username AS username
				FROM " . ALBUM_CAT_TABLE . " AS c
					LEFT JOIN " . ALBUM_TABLE . " AS p ON c.cat_id = p.pic_cat_id
					LEFT JOIN " . USERS_TABLE . " AS u ON c.cat_user_id = u.user_id					
				WHERE cat_id <> 0
				GROUP BY cat_id " . album_get_sql_category_sort();
	}
	else
    {
		if ($user_id == ALBUM_PUBLIC_GALLERY)
		{
			// Public galleries
			$sql = "SELECT c.*, COUNT(p.pic_id) AS count, '' AS username
					FROM " . ALBUM_CAT_TABLE . " AS c
						LEFT JOIN " . ALBUM_TABLE . " AS p ON c.cat_id = p.pic_cat_id
					WHERE cat_id <> 0 AND c.cat_user_id = 0
					GROUP BY cat_id " . album_get_sql_category_sort();
		}
		else
		{
			// Personal galleries
			$sql = "SELECT c.*, COUNT(p.pic_id) AS count, u.username
					FROM " . ALBUM_CAT_TABLE . " AS c
						LEFT JOIN " . ALBUM_TABLE . " AS p ON c.cat_id = p.pic_cat_id
						LEFT JOIN " . USERS_TABLE . " AS u ON c.cat_user_id = u.user_id
					WHERE u.user_id = " . $user_id ."
					GROUP BY c.cat_id " . album_get_sql_category_sort();				
		}
	}

    if (!$result = $db->sql_query($sql))
        message_die(GENERAL_ERROR, "Couldn't access list of Album Categories", "", __LINE__, __FILE__, $sql);

    if ($db->sql_numrows($result) == 0)
    {
		if (album_is_debug_enabled() == true)
        {
		    album_debugEx('album_read_tree : no rows was selected using this sql = %s', $sql);
        }
        return;
	}

    while ($row = $db->sql_fetchrow($result))
	{
	 	// ------------------------------------------------------------------------
        // if current category id is the same as the parent id, then replace parent id with 0
        // ------------------------------------------------------------------------
        if ($row['cat_parent'] == $row['cat_id'])
            $row['cat_parent'] = 0;

        // store the parent id for this category in the row array
        $row['parent'] = ($row['cat_parent'] == 0) ? $parent_root_id : $row['cat_parent'];
        $idx = count($cats);
        $cats[$idx] = $row;
        $parents[$row['parent']][] = $idx;
    }

	$db->sql_freeresult($result);

    // build the tree
    $album_data  = array();
    album_build_tree($cats, $parents);

    // populate the authentication data to the album tree
    album_create_user_auth($user_id);

    if (album_is_debug_enabled() == true)
    {
        album_debug('album_read_tree : user id = %d, $album_data[\'auth\'] = %s', $user_id, $album_data['auth']);
    }

    // ------------------------------------------------------------------------
	// from the authenticated categories, build alist of allowed categories
	// where the authentication rights fits the one that was specified in the
	// function call (album_read_tree)
	// ------------------------------------------------------------------------
    if (!empty($album_data['auth']) || count($album_data['auth']) > 0 )
	{
		$cats = array(); // re-create an arrsy
		for ($idx = 0; $idx < count($album_data['auth']); $idx++)
		{
			$cat_id = $album_data['id'][$idx];

			if ( ($album_data['auth'][$cat_id]["view"] >= $can_view)		&&
				 ($album_data['auth'][$cat_id]["upload"] >= $can_upload)	&&
				 ($album_data['auth'][$cat_id]["rate"]>= $can_rate)			&&
				 ($album_data['auth'][$cat_id]["comment"] >= $can_comment)	&&
				 ($album_data['auth'][$cat_id]["edit"] >= $can_edit)		&&
				 ($album_data['auth'][$cat_id]["delete"] >= $can_delete)    )
			{	
				if (checkFlag($options, ALBUM_CREATE_CAT_ID_LIST)) 
				{
				    $cats[0] .= ( (empty($cats[0])) ? '' : ',') . $album_data['data'][$idx]['cat_id'];
				}
				else
				{
					$cats[] = $album_data['data'][$idx];				
				}
			}
		}
	}

    if (album_is_debug_enabled() == true)
    {
        album_debug('album_read_tree : $cats = %s', $cats);
    }

	if (checkFlag($options, ALBUM_CREATE_CAT_ID_LIST))
	{
		return $cats[0];
	}
	else
	{
		return $cats;
	}    
}

function album_init_personal_gallery($user_id)
{
	global $db, $album_data , $userdata;
	
	// parent categories
    $parents = array();
	// read categories and categories with right user access rights
    $cats = array();	
	
	$parent_root_id = ALBUM_ROOT_CATEGORY;

	$row = init_personal_gallery_cat($user_id);
	
	if ($row['cat_parent'] == $row['cat_id'])
            $row['cat_parent'] = 0;

	// store the parent id for this category in the row array
	$row['parent'] = ($row['cat_parent'] == 0) ? $parent_root_id : $row['cat_parent'];
	$idx = count($cats);
	$cats[$idx] = $row;
	$parents[$row['parent']][] = $idx;

    // build the tree
    $album_data  = array();
    album_build_tree($cats, $parents);

    // populate the authentication data to the album tree
    album_create_user_auth($user_id);
}

// ------------------------------------------------------------------------
// Returns the category root id for the users personal gallery
// ------------------------------------------------------------------------
function album_get_personal_root_id($user_id)
{
	global $db, $album_data;

	// ------------------------------------------------------------------------
	// if we aren't in a personal gallery cat
	// then return public root category id
	// ------------------------------------------------------------------------
	if ($user_id == ALBUM_PUBLIC_GALLERY)
	    return ALBUM_ROOT_CATEGORY;

	//if ( is_array($album_data ) && count($album_data['data']) > 0)
	if ( $userdata['user_id'] == $user_id && is_array($album_data ) && count($album_data['data']) > 0 && $album_data['personal'][0] == 1)
	{
		return $album_data['id'][0]; // the first array index is always root
	}
	else
	{
		$sql = "SELECT cat_id
				FROM " . ALBUM_CAT_TABLE . "
				WHERE cat_user_id = $user_id AND cat_parent = 0
				LIMIT 1";

		if (!$result = $db->sql_query($sql))
        	message_die(GENERAL_ERROR, "Couldn't get personal root id for user (id: $user_id)", "", __LINE__, __FILE__, $sql);

	    if ($db->sql_numrows($result) == 0)
    	    return ALBUM_ROOT_CATEGORY;

		$row = $db->sql_fetchrow($result);
		
		$db->sql_freeresult($result);

		return $row['cat_id'];
	}
}

// ------------------------------------------------------------------------
// Return a list of user ids and usernames which doesn't have a personal gallery
// ------------------------------------------------------------------------
function album_get_nonexisting_personal_gallery_info()
{
	global $db, $lang;

	$userinfo = array();
	$album_user_ids = ANONYMOUS;

	// ------------------------------------------------------------------------
	// sine MySQL doesn't support sub selects in select statements I have to split
	// this statement up into two statements...or maybe I should try harder to do it in one ;)
	// ------------------------------------------------------------------------

	// first get the list of users who does have a personal gallery
  	$sql = "SELECT DISTINCT user_id, cat_id
			FROM ". USERS_TABLE ." AS u, ". ALBUM_CAT_TABLE ." AS c
			WHERE c.cat_user_id = u.user_id
				AND c.cat_parent = 0";

    if( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Internal Message : Could not read user infor for fake list.', '', __LINE__, __FILE__, $sql);
	}

    while ($row = $db->sql_fetchrow($result) )
	{
	 	$album_user_ids .= ($album_user_ids == '') ? $row['user_id'] : ',' . $row['user_id'];
	}

	// get user names and user ids for info list
	$sql = "SELECT user_id,username
			FROM ". USERS_TABLE . "
	        WHERE user_id NOT IN (" . $album_user_ids .")"; // AND user_id <> " . ANONYMOUS;

	if( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Internal Message : Could not read user info for fake list.', '', __LINE__, __FILE__, $sql);
	}

	if ($db->sql_numrows($result) > 0)
	{
		while ($row = $db->sql_fetchrow($result) )
		{
		 	$userinfo[] = $row;
		}
	}
	
	$db->sql_freeresult($result);

	return $userinfo;
}


// ------------------------------------------------------------------------
// Create a users personal gallery, by creating the root category, IF it
// doens't exists already
// ------------------------------------------------------------------------
function album_create_personal_gallery($user_id, $view_level, $upload_level, $options = 0)
{
	global $album_config, $template, $lang, $phpEx, $userdata, $db;

	if ($user_id == ALBUM_PUBLIC_GALLERY)
		return false;

	// ------------------------------------------------------------------------
	// Check if the personal gallery already exists
	// ------------------------------------------------------------------------
	$sql = "SELECT c.cat_id
			FROM ". ALBUM_CAT_TABLE ." AS c
			WHERE c.cat_user_id = '$user_id' AND c.cat_parent = 0
			LIMIT 1";

	if( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not query category information', '', __LINE__, __FILE__, $sql);
	}

	// ------------------------------------------------------------------------
	// if we didn't find any category then create the root category for the user
	// ------------------------------------------------------------------------
	if ($db->sql_numrows($result) == 0)
	{
		
		// ------------------------------------------------------------------------
		// Build the personal gallery root name (is not directly shown in the php pages)
		// ------------------------------------------------------------------------
		$root_cat_name = sprintf($lang['Personal_Gallery_Of_User'], str_replace("\'", "''", album_get_user_name($user_id)));

		// ------------------------------------------------------------------------
		// insert the personal gallery root category
		// NOTE : the edit and delete level are set to PRIVATE !!
		// ------------------------------------------------------------------------
		$sql = "INSERT INTO ". ALBUM_CAT_TABLE ."
				(cat_title, cat_desc,
				 cat_order, cat_view_level,
				 cat_upload_level, cat_rate_level,
				 cat_comment_level, cat_edit_level,
				 cat_delete_level, cat_approval,
				 cat_parent, cat_user_id)
				VALUES
				('". $root_cat_name ."', '". $root_cat_name ."',
				 '0', '" . $view_level . "',
				 '". $upload_level . "', '0',
				 '0', '".ALBUM_PRIVATE."',
				 '".ALBUM_PRIVATE."', '0',
				 '0', '$user_id')";

		if(!$result = $db->sql_query($sql))
		{
			//message_die(GENERAL_ERROR, 'Could not create new Personal Root Category', '', __LINE__, __FILE__, $sql);
			return false;
		}
	}
	
//	$db->sql_freeresult($result);
	
	return true;
}

// ------------------------------------------------------------------------
// build the sql sorting clause
// ------------------------------------------------------------------------
function album_get_sql_category_sort()
{
    global $album_config;

    switch ($album_config['album_category_sorting_direction'])
    {
     	case 'DESC':
     		$sql_sort_direction = 'DESC';
     		break;
     	default:
     		$sql_sort_direction = 'ASC';
	}

    switch ($album_config['album_category_sorting'])
    {
     	case 'cat_id':
     		$sql_sort_method = 'ORDER BY cat_id ' . $sql_sort_direction;
     		break;
     	case 'cat_title':
     		$sql_sort_method = 'ORDER BY cat_title ' . $sql_sort_direction;
     		break;
     	default:
     		$sql_sort_method = 'ORDER BY cat_order ASC';
	}

    return $sql_sort_method;
}

// ------------------------------------------------------------------------
// move the tree up or down in the category order
// ------------------------------------------------------------------------
function album_move_tree($cat_id, $move, $user_id = ALBUM_PUBLIC_GALLERY)
{
	global $db, $album_data ;

	// if the album_tree is NOT filled then reload the data
	// this will ensure that the album IS populated with data
	if ( count($album_data['data']) == 0)
	{
		album_read_tree($user_id);
	}

	// 'search' the object
	$AC_this = (isset($album_data['keys'][$cat_id])) ? $album_data['keys'][$cat_id] : ALBUM_ROOT_CATEGORY;

	// get the root or parent cat id
	$parent = ($AC_this < 0) ? ALBUM_ROOT_CATEGORY : $album_data['parent'][$AC_this];

	// renum objects of the same level and regenerate all
	$order = 0;
	$cats = array();
	$parents = array();

	// for the nuber of rows read/categories do this loop
	for ($i=0; $i < count($album_data['data']); $i++)
	{
	 	// ------------------------------------------------------------------------
		// if the current itetorated parent id is equal to the selected category's parent id then
		// reorder the cat_order, the way that, if the found category is the selected category
		// then move the category by the sequentual order number + 'move direction value'
		// else give it the sequentual order number...this will ensure that the selected category
		// always is moved up or down compared to its siblings
		// ------------------------------------------------------------------------
		if ($album_data['parent'][$i] == $parent)
		{
			$order = $order + 10;
			$neworder = ($i == $AC_this) ? $order + $move : $order;
			$album_data['data'][$i]['cat_order'] = $neworder;
		}

		// ------------------------------------------------------------------------
		// fill these arrays which are going to be need in building the tree
		// (see album_read_tree for similiar code)
		// ------------------------------------------------------------------------
		$idx = count($cats);
		$cats[$idx] = $album_data['data'][$i];
		$parents[ $album_data['parent'][$i] ][] = $idx;
	}

	// rebuild the tree
	$album_data  = array();
	album_build_tree($cats, $parents);

	// ------------------------------------------------------------------------
	// re-order all categories...in the database acording to the album_tree
	// is really the same things as the reorder_cat in admin/album_cat.php
	// ------------------------------------------------------------------------
	$order = 0;
	for ($i=0; $i < count($album_data['data']); $i++)
	{
		$order = $order + 10;
		$sql = "UPDATE " . ALBUM_CAT_TABLE . " SET cat_order=$order WHERE cat_id=" . $album_data['id'][$i];

		if ( !$db->sql_query($sql) )
        {
			message_die(GENERAL_ERROR, 'Couldn\'t update album category order', '', __LINE__, __FILE__, $sql);
        }
	}
}

// ------------------------------------------------------------------------
// Get the number of new pictures, from a given date, in several categories
// Return the result in an array grouped by catgory id
// ------------------------------------------------------------------------
function album_no_newest_pictures($check_date, $cats, $exclude_cat_id = 0)
{
	global $db, $lang, $ablum_config, $board_config;

	$pictotalrows = array();

	if (is_null($cats))
	{
		return $pictotalrows;
	}

	// --------------------------------------------------------------------
	// NOTE : this function is weighted, meaning that days has higher
	// priority then months, and month higher priority then hours
    //
	// if $check_data = 12HMD, then we uses 12 days to calcuate
	// if $check_data = 12HM, then we uses 12 month calcuate...and so on
    // --------------------------------------------------------------------

    $check_date = strtoupper($check_date);

	// are we checking hours ?
	if (strstr($check_date,'H') != false)
	{
		$multiplier = 60 * 60;
	}

	// are we checking months ?
	if (strstr($check_date,'M') != false)
	{
	 	$multiplier = (30 * 24 * 60 * 60);  // in my world a month is always 30 days ;)
	}

	// are we checking weeks ?
	if (strstr($check_date,'W') != false)
	{
	 	$multiplier = (7 * 24 * 60 * 60);  // in my world a month is always 30 days ;)
	}	
	
  	// are we checking days (default) ? - yes if multiplier is zero
	if (strstr($check_date,'D') != false || $multiplier == 0)
	{
		$multiplier = (24 * 60 * 60);
	}

	// remove all the alpha characters from the string, since they aren't needed anymore
    $check_date = ereg_replace("[A-Z]+", "", trim($check_date));

    // doa final test to see if it's a valid checkm further more
    // if intval should return 0 then we will not find any images
    // that are new, except those that only are a few second old
    // but we don't want to do a trip to the database just because of that
    // the minimum is 1 hour.
    if (intval($check_date) == 0)
    {
       return $pictotalrows;
	}

    // calculate the difference from today and the desired check date (beta code !)
    $curtime = time() - ($multiplier * intval($check_date));

	//album_debug('date = %s',create_date($board_config['default_dateformat'], $curtime, $board_config['board_timezone']));

	$sql_time = ' AND p.pic_time >= ' . $curtime;
	$sql_exclude = ($exclude_cat_id != 0) ? ' AND NOT IN (' . $exclude_cat_id .')' : '';
	$sql_include = (is_array($cats)) ? implode(',', $cats) : $cats;

	$sql = 'SELECT c.cat_id, p.pic_id, COUNT(p.pic_id) AS pic_total
			FROM ' . ALBUM_TABLE . ' AS p, ' . ALBUM_CAT_TABLE . ' AS c
			WHERE c.cat_id IN ('. $sql_include  .')' .  $sql_exclude . '
			AND p.pic_cat_id = c.cat_id ' . $sql_time . '
			GROUP BY c.cat_id';

    if( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not get the cat user id of this category ', '', __LINE__, __FILE__, $sql);
	}


	while ($row = $db->sql_fetchrow($result))
	{
		$pictotalrows[ $row['cat_id'] ] = $row['pic_total'];
	}

	$db->sql_freeresult($result);
	
    if (album_is_debug_enabled() == true)
    {
    	album_debug('album_no_newest_pictures sql = %s', $sql);
    	album_debug('$pictotalrows = %s', $pictotalrows);
    }
	return $pictotalrows;
}

// ------------------------------------------------------------------------
// Check wheter the category is a personal category or apublic one
// Returns the user id if it's a personal category, else FALSE
// ------------------------------------------------------------------------
function album_is_personal_gallery($cat_id) // for backward compability... for now
{
	return album_get_cat_user_id($cat_id);
}
function album_get_cat_user_id($cat_id)
{
	global $db, $album_data;

	if ( @!array_key_exists($cat_id,$album_data['keys']) || !isset($album_data) || !is_array($album_data))
	{
	 	$sql = 'SELECT cat_user_id FROM ' . ALBUM_CAT_TABLE . ' WHERE cat_id = ' . $cat_id . ' LIMIT 1';

        if( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not get the cat user id of this category ', '', __LINE__, __FILE__, $sql);
		}

		$row = $db->sql_fetchrow($result);
		
		$db->sql_freeresult($result);

	    return ($row['cat_user_id'] != 0) ? $row['cat_user_id'] : false;
	}
	else
	{
	 	$index = $album_data['keys'][$cat_id];
		return ($album_data['personal'][$cat_id] != 0) ? $album_data['data'][$index]['cat_user_id'] : false;
	}
}

// ------------------------------------------------------------------------
// Checks where user id exists or not
// ------------------------------------------------------------------------
function album_check_user_exists($user_id)
{
	if ($user_id == ALBUM_PUBLIC_GALLERY)
	    return true;

	$tmpusername = album_get_user_name($user_id);
	return  (!empty($tmpusername)) ? true : false;
}

// ------------------------------------------------------------------------
// Returns the name of an user
// ------------------------------------------------------------------------
function album_get_user_name($user_id)
{
	global $db;

	if ($user_id == ALBUM_PUBLIC_GALLERY)
	    return "";

	$sql = "SELECT username
			FROM ". USERS_TABLE ."
			WHERE user_id = $user_id
			LIMIT 1";

	if( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not get the username of this category owner', '', __LINE__, __FILE__, $sql);
	}

	$row = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);
	
	return $row['username'];
}

// ------------------------------------------------------------------------
// Get last picture info from database in the specified categories ($cats)
// Functions is based on the SP mod by CLowN
// ------------------------------------------------------------------------
function album_get_last_pic_info($cats, &$last_pic_id)
{
    global $phpEx, $board_config, $lang, $db, $album_data , $album_config;

	if (empty($cats))
	{
		$last_pic_id = 0;
		return '';
	}
	
    // check whter we are running an album with CLowN's SP mod..
	// and correct album picture url
    if (defined('ALBUM_SP_CONFIG_TABLE'))
    {
	    $album_pic_url = 'album_showpage.'.$phpEx;
    }
	else
    {
		$album_pic_url = 'album_page'.$phpEx;
    }

	$categories = implode(",", $cats);

	$AC_this = isset($album_data['keys'][$cats[0]]) ? $album_data['keys'][$cats[0]] : ALBUM_ROOT_CATEGORY;
	$cat = $album_data['data'][$AC_this];

	// Check Pic Approval
	// the cat array should be the 'current' category (data)...
    if (($cat['cat_approval'] == ALBUM_ADMIN) or ($cat['cat_approval'] == ALBUM_MOD))
    {
        $pic_approval_sql = 'AND p.pic_approval = 1'; // Pic Approval ON
    }
	else
    {
        $pic_approval_sql = ''; // Pic Approval OFF
    }

    // OK, we may do a query now... get last picture information
	$sql = "SELECT p.pic_id, p.pic_title, p.pic_user_id, p.pic_username, p.pic_time, p.pic_cat_id, u.user_id, u.username
			FROM " . ALBUM_TABLE . " AS p
				LEFT JOIN " . USERS_TABLE . " AS u  ON p.pic_user_id = u.user_id
			WHERE p.pic_cat_id IN (" . $categories  .") $pic_approval_sql
			ORDER BY p.pic_time DESC
			LIMIT 1";

	if (!$result = $db->sql_query($sql))
	{
        message_die(GENERAL_ERROR, 'Could not get last pic information', '', __LINE__, __FILE__, $sql);
    }

	if ($db->sql_numrows($result) == 0)
	{
		$last_pic_id = 0;
		return '';
	}

	$row = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);

    // Write the Date
    $info = create_date($board_config['default_dateformat'], $row['pic_time'], $board_config['board_timezone']);
    $info .= '<br />';

    // Write username of last poster
    if (($row['user_id'] == ALBUM_GUEST) or ($row['username'] == ''))
	{
        $info .= ($row['pic_username'] == '') ? $lang['Guest'] : $row['pic_username'];
    }
	else
	{
        $info .= $lang['Poster'] . ': <a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '=' . $row['user_id']) . '">' . $row['username'] . '</a>';
    }

    // Write the last pic's title. Truncate it if it's too long
    if (!isset($album_config['last_pic_title_length']))
    {
		$album_config['last_pic_title_length'] = 25;
    }

	if (strlen($row['pic_title']) > $album_config['last_pic_title_length'])
    {
		$row['pic_title'] = substr($row['pic_title'], 0, $album_config['last_pic_title_length']) . '...';
    }

    $info .= '<br />' . $lang['Pic_Title'] . ': <a href="';
    $info .= ($album_config['fullpic_popup']) ? append_sid("album_pic.$phpEx?pic_id=" . $row['pic_id']) . '" target="_blank">' : append_sid($album_pic_url . '?pic_id=' . $row['pic_id']) . '">' ;
    $info .= $row['pic_title'] . '</a>';

	$last_pic_id = $row['pic_id'];

	return $info;
}

// ------------------------------------------------------------------------
// Get last comment information from database in the specified categories
// ($cats)
// Functions is based on the SP mod by CLowN
// ------------------------------------------------------------------------
function album_get_last_comment_info($cats)
{
    global $phpEx, $board_config, $lang, $db, $album_data;
    
	if (empty($cats))
	{
		return '';
	}
	
    if (defined('ALBUM_SP_CONFIG_TABLE'))
    {
	    $album_pic_url = 'album_showpage.'.$phpEx;
    }
	else
    {
		$album_pic_url = 'album_page.'.$phpEx;
    }

	$categories = implode(",", $cats);

	// get last comment information, and user, comment and pic informations
    $sql = "SELECT c.comment_pic_id, c.comment_user_id, c.comment_username, c.comment_time, u.user_id, u.username, a.pic_id, a.pic_cat_id, a.pic_title
			FROM " . ALBUM_COMMENT_TABLE . " AS c
				LEFT JOIN " . USERS_TABLE . " AS u ON c.comment_user_id = u.user_id
				LEFT JOIN " . ALBUM_TABLE . " AS a ON c.comment_pic_id = a.pic_id
			WHERE a.pic_cat_id IN (" . $categories  .")
			ORDER BY c.comment_time DESC
			LIMIT 1";

    if (!$result = $db->sql_query($sql))
	{
        message_die(GENERAL_ERROR, 'Could not get last comment information', '', __LINE__, __FILE__, $sql);
    }
    
	$row = $db->sql_fetchrow($result);

    // last comment
    if ($db->sql_numrows($result) == 0)
	{
		return '';
    }

	$db->sql_freeresult($result);
	
	$info = create_date($board_config['default_dateformat'], $row['comment_time'], $board_config['board_timezone']);
    $info .= '<br />' . $lang['Poster'] . ': ';

	if (($row['user_id'] == ALBUM_GUEST) or ($row['comment_username'] == ''))
    {
		$info .= ($row['comment_username'] == '') ? $lang['Guest'] : $row['comment_username'];
    }
	else
    {
		$info .= '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '=' . $row['user_id']) . '">' . $row['username'] . '</a>';
    }

	$info .= '<br />' . $lang['Pic_Title'] . ': <a href="' . append_sid($album_pic_url . '?pic_id=' . $row['pic_id']) . '">' . $row['pic_title'] . '</a>';

	return $info;
}

// ------------------------------------------------------------------------
// Get moderator information for the the category
// ------------------------------------------------------------------------
function album_get_moderator_info($cat) {
    global $phpEx, $lang, $db;

    // Most of this code is copyrighted by Smartor
    // Modifications are done by IdleVoid
    $moderators = '';
    $grouprows = array();

    // We have usergroup_ID, now we need usergroup name
    $sql = "SELECT group_id, group_name
			FROM " . GROUPS_TABLE . "
			WHERE group_single_user <> 1
				AND group_type <> " . GROUP_HIDDEN . "
				AND group_id IN (" . $cat['cat_moderator_groups'] . ")
			ORDER BY group_name ASC";

	if (!$result = $db->sql_query($sql)) 
	{
		message_die(GENERAL_ERROR, 'Could not obtain usergroups data', '', __LINE__, __FILE__, $sql);
	}

	while ($row = $db->sql_fetchrow($result)) 
	{
		$grouprows[] = $row;
	}

	$db->sql_freeresult($result);
	
	if (count($grouprows) > 0) 
	{
		for ($j = 0; $j < count($grouprows); $j++) 
		{
        	$group_link = '<a href="' . append_sid("groupcp.$phpEx?" . POST_GROUPS_URL . '=' . $grouprows[$j]['group_id']) . '">' . $grouprows[$j]['group_name'] . '</a>';
            $moderators .= ($moderators == '') ? $group_link : ', ' . $group_link;
        }
    }

    return $moderators;
}

// ------------------------------------------------------------------------
// Returns the number of comments for current catgory and it subs
// (if cat is anarray)
// ------------------------------------------------------------------------
function album_get_comment_count($cat)
{
	global $db;

	if (is_array($cat))
    {
	    $sql_where = " WHERE pic_cat_id IN (". implode(",", $cat) .")";
	}
    else
    {
		$sql_where = " WHERE pic_cat_id = '" . $cat  ."'";
	}

	$sql = "SELECT COUNT(comment_id) AS comment_count
			FROM " . ALBUM_COMMENT_TABLE . "
			LEFT JOIN " . ALBUM_TABLE . " ON comment_pic_id = pic_id " . $sql_where;

	if (!$result = $db->sql_query($sql))
	{
        message_die(GENERAL_ERROR, 'Could not get category comment count information', '', __LINE__, __FILE__, $sql);
    }
    $comment_row = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);

	return intval($comment_row['comment_count']);
}

// ------------------------------------------------------------------------
// Returns the number of pictures for current catgory and it subs
// ------------------------------------------------------------------------
function album_get_total_pics($cats)
{
	global $db;

	$sql_where = " WHERE c.cat_id " . ( (is_array($cats)) ? "IN (". implode(",", $cats) .")" : "= " . $cats);

	$sql = "SELECT COUNT(p.pic_id) AS count
			FROM " . ALBUM_CAT_TABLE . " AS c
				LEFT JOIN " . ALBUM_TABLE . " AS p ON c.cat_id = p.pic_cat_id " . $sql_where;

	if (!$result = $db->sql_query($sql))
	{
        message_die(GENERAL_ERROR, "Couldn't get total number of pictures for album categories and sub categories", "", __LINE__, __FILE__, $sql);
	}

    if ($db->sql_numrows($result) == 0)
	{
        return 0;
	}

	$row = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);

	return intval($row['count']);
}

// ------------------------------------------------------------------------
// Builds the table showing the pictures in rows and columns, default
// ------------------------------------------------------------------------
function album_build_picture_table($user_id, $cat_ids, $thiscat, $auth_data, $start, $sort_method, $sort_order, $total_pics)
{
	global $board_config, $album_data, $album_config, $template, $lang, $phpEx, $userdata, $db;

	$viewmode = (strpos($cat_ids, ',') != false) ? '&mode=' . ALBUM_VIEW_ALL : '';
	
	if 	(defined('ALBUM_SP_CONFIG_TABLE'))
	{
		$album_show_pic_url = 'album_showpage.'.$phpEx;
        $album_rate_pic_url = $album_show_pic_url;
        $album_comment_pic_url = $album_show_pic_url;
	}
	else
    {
		$album_show_pic_url = 'album_page.'.$phpEx;
		$album_rate_pic_url = 'album_rate.'.$phpEx;
		$album_comment_pic_url = 'album_comment.'.$phpEx;
	}
	
    if (intval($cat_ids) == album_get_personal_root_id($user_id) && $user_id != ALBUM_PUBLIC_GALLERY)
    {
        $album_pagination_page_url = 'album.'.$phpEx;
	}
    else
    {
        $album_pagination_page_url = 'album_cat.'.$phpEx;
	}

	$pics_per_page = $album_config['rows_per_page'] * $album_config['cols_per_page'];

	$limit_sql = ($start == 0) ? $pics_per_page : $start .','. $pics_per_page;

	$pic_approval_sql = 'AND p.pic_approval = 1';

	if ($thiscat['cat_approval'] != ALBUM_USER)
	{
		if( ($userdata['user_level'] == ADMIN) or (($auth_data['moderator'] == 1) and ($thiscat['cat_approval'] == ALBUM_MOD)) )
		{
			$pic_approval_sql = '';
		}
	}

	$sql = "SELECT ct.cat_user_id, ct.cat_id, ct.cat_title, p.pic_id, p.pic_title, p.pic_desc, p.pic_user_id, p.pic_user_ip, p.pic_username, p.pic_time,
				   p.pic_cat_id, p.pic_view_count, p.pic_lock, p.pic_approval, u.user_id, u.username, r.rate_pic_id,
				   AVG(r.rate_point) AS rating, COUNT(DISTINCT c.comment_id) AS comments, MAX(c.comment_id) as new_comment
			FROM ". ALBUM_TABLE ." AS p
				LEFT JOIN ". USERS_TABLE ." AS u ON p.pic_user_id = u.user_id
				LEFT JOIN ". ALBUM_RATE_TABLE ." AS r ON p.pic_id = r.rate_pic_id
				LEFT JOIN ". ALBUM_COMMENT_TABLE ." AS c ON p.pic_id = c.comment_pic_id
				LEFT JOIN ". ALBUM_CAT_TABLE ." AS ct ON p.pic_cat_id = ct.cat_id
			WHERE p.pic_cat_id IN ($cat_ids) $pic_approval_sql
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
	
	$db->sql_freeresult($result);

	$template->assign_block_vars('index_pics_block', array());

	for ($i = 0; $i < count($picrow); $i += $album_config['cols_per_page'])
	{
		$template->assign_block_vars('index_pics_block.picrow', array());

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

			$template->assign_block_vars('index_pics_block.picrow.piccol', array(
				'U_PIC' => ($album_config['fullpic_popup']) ? append_sid("album_pic.$phpEx?pic_id=". $picrow[$j]['pic_id']) : append_sid($album_show_pic_url . '?pic_id='. $picrow[$j]['pic_id']),
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

			if 	(defined('ALBUM_SP_CONFIG_TABLE'))
			{
				$image_rating = ImageRating($picrow[$j]['rating']);
				$image_rating_link_style = ($image_rating == $lang['Not_rated']) ? '' : 'style="text-decoration: none;"';;
			}
			else
			{
				$image_rating = (empty($picrow[$j]['rating'])) ? $lang['Not_rated'] : $picrow[$j]['rating'];
				$image_rating_link_style = '';
			}

			$image_comment = ($picrow[$j]['comments'] == 0) ? $lang['Not_commented'] : $picrow[$j]['comments'];

			$edit_rights = ( ( $auth_data['edit'] and ($picrow[$j]['pic_user_id'] == $userdata['user_id']) ) or
							 ($auth_data['moderator'] and ($thiscat['cat_edit_level'] != ALBUM_ADMIN) ) or
							 ($userdata['user_level'] == ADMIN) ) ? true : false;

			$delete_rights = ( ( $auth_data['delete'] and ($picrow[$j]['pic_user_id'] == $userdata['user_id']) ) or
							 ($auth_data['moderator'] and ($thiscat['cat_delete_level'] != ALBUM_ADMIN) ) or
							 ($userdata['user_level'] == ADMIN) ) ? true : false;

			$template->assign_block_vars('index_pics_block.picrow.pic_detail', array(
				'TITLE' => '<a href = "' . $album_show_pic_url . '?pic_id=' . $picrow[$j]['pic_id'] . '">' . $picrow[$j]['pic_title'] . '</a>',
				'POSTER' => $pic_poster,
				'TIME' => create_date($board_config['default_dateformat'], $picrow[$j]['pic_time'], $board_config['board_timezone']),

				'VIEW' => $picrow[$j]['pic_view_count'],

				'RATING' => ($album_config['rate'] == 1) ?( $lang['Rating'] . ' : <a href="'. append_sid(album_append_uid($album_rate_pic_url .'?pic_id='. $picrow[$j]['pic_id'])) . '"' . $image_rating_link_style .'>' . $image_rating . '</a><br />') : '',

				'COMMENTS' => ($album_config['comment'] == 1) ? ($lang['Comments'] . ' : <a href="'. append_sid(album_append_uid($album_comment_pic_url .'?pic_id='. $picrow[$j]['pic_id'])) . '">' . $image_comment . '</a><br />') : '',

				'EDIT' =>  ($edit_rights) ? '<a href="'. append_sid(album_append_uid("album_edit.$phpEx?pic_id=". $picrow[$j]['pic_id'])) . '">' . $lang['Edit_pic'] . '</a>' : '',

				'DELETE' => ($delete_rights) ? '<a href="'. append_sid(album_append_uid("album_delete.$phpEx?pic_id=". $picrow[$j]['pic_id'])) . '">' . $lang['Delete_pic'] . '</a>' : '',

				'MOVE' => ($auth_data['moderator']) ? '<a href="'. append_sid(album_append_uid("album_modcp.$phpEx?mode=move&amp;pic_id=". $picrow[$j]['pic_id'])) .'">'. $lang['Move'] .'</a>' : '',

				'LOCK' => ($auth_data['moderator']) ? '<a href="'. append_sid(album_append_uid("album_modcp.$phpEx?mode=". (($picrow[$j]['pic_lock'] == 0) ? 'lock' : 'unlock') ."&amp;pic_id=". $picrow[$j]['pic_id'])) .'">'. (($picrow[$j]['pic_lock'] == 0) ? $lang['Lock'] : $lang['Unlock']) .'</a>' : '',

				'IP' => ($userdata['user_level'] == ADMIN) ? $lang['IP_Address'] . ': <a href="http://www.nic.com/cgi-bin/whois.cgi?query=' . decode_ip($picrow[$j]['pic_user_ip']) . '" target="_blank">' . decode_ip($picrow[$j]['pic_user_ip']) .'</a><br />' : ''
				)
			);

			if ( is_array($cats) )
			{
				// is a personal category that the picture belongs to AND
				// is it the main category in the personal gallery ?
				if ($picrow[$j]['cat_user_id'] != 0 && $picrow[$j]['cat_id'] == album_get_personal_root_id($picrow[$j]['cat_user_id']))
				{
				 	 	$album_page_url = "album.$phpEx";
				}
				else
				{
                	$album_page_url = "album_cat.$phpEx";
				}

				$image_cat_url = append_sid("$album_page_url?cat_id=". $picrow[$j]['cat_id'] . '&user_id=' . $picrow[$j]['cat_user_id']);

				$template->assign_block_vars('index_pics_block.picrow.pic_detail.cats', array(
	            	'CATEGORY' => $picrow[$j]['cat_title'],
					'U_PIC_CAT' => $image_cat_url
					)
				);
			}
		}
	}
	
	$template->assign_vars(array(
		'PAGINATION' => generate_pagination(append_sid(album_append_uid($album_pagination_page_url . "?cat_id=" . intval($cat_ids) . "&amp;sort_method=$sort_method&amp;sort_order=$sort_order$viewmode")), $total_pics, $pics_per_page, $start),
		'PAGE_NUMBER' => sprintf($lang['Page_of'], ( floor( $start / $pics_per_page ) + 1 ), ceil( $total_pics / $pics_per_page ))
		)
	);
}


// ------------------------------------------------------------------------
// Creates the table for recent pictures
// Based on CLowN's Super Charged Pack
// ------------------------------------------------------------------------
function album_build_recent_pics($cats)
{
	global $db, $board_config, $album_config, $album_sp_config, $template, $lang, $phpEx;

	if 	(defined('ALBUM_SP_CONFIG_TABLE'))
	{
		$album_show_pic_url = 'album_showpage.' . $phpEx;
		$album_rate_pic_url = $album_show_pic_url;
		$album_comment_pic_url = $album_show_pic_url;
		$limit_sql = $album_sp_config['img_cols'] * $album_sp_config['img_rows'];
		$cols_per_page = $album_sp_config['img_cols'];
	}
	else
	{
		$album_show_pic_url = 'album_page.' . $phpEx;
        $album_rate_pic_url = 'album_rate.' . $phpEx;
		$album_comment_pic_url = 'album_commnet.' . $phpEx;
		$limit_sql = $album_config['cols_per_page'] * $album_config['rows_per_page'];
		$cols_per_page = $album_config['cols_per_page'];
	}

	if ( !empty($cats) )
	{
		$sql = "SELECT p.pic_id, p.pic_title, p.pic_desc, p.pic_user_id, p.pic_user_ip, p.pic_username, p.pic_time, p.pic_cat_id, p.pic_view_count, u.user_id, u.username, r.rate_pic_id, AVG(r.rate_point) AS rating, COUNT(DISTINCT c.comment_id) AS comments
				FROM ". ALBUM_TABLE ." AS p
					LEFT JOIN ". USERS_TABLE ." AS u ON p.pic_user_id = u.user_id
					LEFT JOIN ". ALBUM_CAT_TABLE ." AS ct ON p.pic_cat_id = ct.cat_id
					LEFT JOIN ". ALBUM_RATE_TABLE ." AS r ON p.pic_id = r.rate_pic_id
					LEFT JOIN ". ALBUM_COMMENT_TABLE ." AS c ON p.pic_id = c.comment_pic_id
				WHERE p.pic_cat_id IN ($cats) AND ( p.pic_approval = 1 OR ct.cat_approval = 0 )
				GROUP BY p.pic_id
				ORDER BY pic_time DESC
				LIMIT $limit_sql";

		if( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not query recent pics information', '', __LINE__, __FILE__, $sql);
		}

		$recentrow = array();

		while( $row = $db->sql_fetchrow($result) )
		{
			$recentrow[] = $row;
		}

		$db->sql_freeresult($result);
		
		$template->assign_block_vars('recent_pics_block', array());

		if (count($recentrow) > 0)
		{
			for ($i = 0; $i < count($recentrow); $i += $cols_per_page)
			{
				$template->assign_block_vars('recent_pics_block.recent_pics', array());

				for ($j = $i; $j < ($i + $cols_per_page); $j++)
				{
					if( $j >= count($recentrow) )
					{
						break;
					}

					$template->assign_block_vars('recent_pics_block.recent_pics.recent_col', array(
						'U_PIC' => ($album_config['fullpic_popup']) ? append_sid("album_pic.$phpEx?pic_id=". $recentrow[$j]['pic_id']) : append_sid($album_show_pic_url. '?pic_id='. $recentrow[$j]['pic_id']),
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

					if 	(defined('ALBUM_SP_CONFIG_TABLE'))
					{
						$image_rating = ImageRating($recentrow[$j]['rating']);
                        $image_rating_link_style = ($image_rating == $lang['Not_rated']) ? '' : 'style="text-decoration: none;"';;
					}
					else
					{
						$image_rating = (empty($recentrow[$j]['rating'])) ? $lang['Not_rated'] : $recentrow[$j]['rating'];
                        $image_rating_link_style = '';
					}

					$template->assign_block_vars('recent_pics_block.recent_pics.recent_detail', array(
						'TITLE' => '<a href = "'.$album_show_pic_url . '?pic_id=' . $recentrow[$j]['pic_id'] . '">' . $recentrow[$j]['pic_title'] . '</a>',
						'POSTER' => $recent_poster,
						'TIME' => create_date($board_config['default_dateformat'], $recentrow[$j]['pic_time'], $board_config['board_timezone']),

						'VIEW' => $recentrow[$j]['pic_view_count'],

						'RATING' => ($album_config['rate'] == 1) ?( $lang['Rating'] . ' : <a href="'. append_sid(album_append_uid($album_rate_pic_url .'?pic_id='. $recentrow[$j]['pic_id'])) . '" ' . $image_rating_link_style .'>' . $image_rating . '</a><br />') : '',

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

	if (empty($cats))
	{
		//
		// No Cats Found
		//
		$template->assign_block_vars('recent_pics_block', array());	
		$template->assign_block_vars('recent_pics_block.no_pics', array());
	}
}

// ------------------------------------------------------------------------
// Creates the table for higest rated pictures
// Based on CLowN's Super Charged Pack
// ------------------------------------------------------------------------
function album_build_highest_rated_pics($cats)
{
	global $db, $board_config, $album_config, $album_sp_config, $template, $lang, $phpEx;

	if 	(defined('ALBUM_SP_CONFIG_TABLE'))
	{
		$album_show_pic_url = 'album_showpage.' . $phpEx;
		$album_rate_pic_url = $album_show_pic_url;

		$limit_sql = $album_sp_config['img_cols'] * $album_sp_config['img_rows'];
		$cols_per_page = $album_sp_config['img_cols'];
	}
	else
	{
		$album_show_pic_url = 'album_page.' . $phpEx;
		$album_rate_pic_url = 'album_rate.' . $phpEx;

		$limit_sql = $album_config['cols_per_page'] * $album_config['rows_per_page'];
		$cols_per_page = $album_config['cols_per_page'];
	}

	if ( !empty($cats) )
	{
		$sql = "SELECT p.pic_id, p.pic_title, p.pic_desc, p.pic_user_id, p.pic_user_ip, p.pic_username, p.pic_time, p.pic_cat_id, p.pic_view_count, u.user_id, u.username, r.rate_pic_id, AVG(r.rate_point) AS rating, COUNT(DISTINCT c.comment_id) AS comments
			 FROM ". ALBUM_TABLE ." AS p
				LEFT JOIN ". USERS_TABLE ." AS u ON p.pic_user_id = u.user_id
				LEFT JOIN ". ALBUM_CAT_TABLE ." AS ct ON p.pic_cat_id = ct.cat_id
				LEFT JOIN ". ALBUM_RATE_TABLE ." AS r ON p.pic_id = r.rate_pic_id
				LEFT JOIN ". ALBUM_COMMENT_TABLE ." AS c ON p.pic_id = c.comment_pic_id
			 WHERE p.pic_cat_id IN ($cats) AND ( p.pic_approval = 1 OR ct.cat_approval = 0 )
			 GROUP BY p.pic_id
			 ORDER BY rating DESC, RAND()
			 LIMIT $limit_sql";

		if( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not query highest rated pics information', '', __LINE__, __FILE__, $sql);
		}

		$highestrow = array();

		while( $row = $db->sql_fetchrow($result) )
		{
			$highestrow[] = $row;
		}
		
		$db->sql_freeresult($result);

		$template->assign_block_vars('highest_pics_block', array());

		if (count($highestrow) > 0)
		{
			for ($i = 0; $i < count($highestrow); $i += $cols_per_page)
			{
				$template->assign_block_vars('highest_pics_block.highest_pics', array());

				for ($j = $i; $j < ($i + $cols_per_page); $j++)
				{
					if( $j >= count($highestrow) )
					{
				   		break;
					}

					$template->assign_block_vars('highest_pics_block.highest_pics.highest_col', array(
					   'U_PIC' => ($album_config['fullpic_popup']) ? append_sid("album_pic.$phpEx?pic_id=". $highestrow[$j]['pic_id']) : append_sid($album_show_pic_url.'?pic_id='. $highestrow[$j]['pic_id']),
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

					if 	(defined('ALBUM_SP_CONFIG_TABLE'))
					{
						$image_rating = ImageRating($highestrow[$j]['rating']);
                        $image_rating_link_style = ($image_rating == $lang['Not_rated']) ? '' : 'style="text-decoration: none;"';;
					}
					else
					{
						$image_rating = (empty($highestrow[$j]['rating'])) ? $lang['Not_rated'] : $highestrow[$j]['rating'];
                        $image_rating_link_style = '';
					}

					$template->assign_block_vars('highest_pics_block.highest_pics.highest_detail', array(
					   'H_TITLE' => '<a href = "'.$album_show_pic_url . '?pic_id=' . $highestrow[$j]['pic_id'] . '">' . $highestrow[$j]['pic_title'] . '</a>',
					   'H_POSTER' => $highest_poster,
					   'H_TIME' => create_date($board_config['default_dateformat'], $highestrow[$j]['pic_time'], $board_config['board_timezone']),

					   'H_VIEW' => $highestrow[$j]['pic_view_count'],

					   'H_RATING' => ($album_config['rate'] == 1) ? ( $lang['Rating'] . ' : <a href="'. append_sid(album_append_uid($album_rate_pic_url .'?pic_id='. $highestrow[$j]['pic_id'])) . '" ' . $image_rating_link_style .'>' . $image_rating . '</a><br />') : '',

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

	if (empty($cats))
	{
		//
		// No Cats Found
		//
		$template->assign_block_vars('highest_pics_block', array());
		$template->assign_block_vars('highest_pics_block.no_pics', array());
	}
}

// ------------------------------------------------------------------------
// Creates the table for random pictures
// Based on CLowN's Super Charged Pack
// ------------------------------------------------------------------------
function album_build_random_pics($cats)
{
	global $db, $board_config, $album_config, $album_sp_config, $template, $lang, $phpEx;

	if 	(defined('ALBUM_SP_CONFIG_TABLE'))
	{
		$album_show_pic_url = 'album_showpage.' . $phpEx;
		$album_rate_pic_url = $album_show_pic_url;
		$limit_sql = $album_sp_config['img_cols'] * $album_sp_config['img_rows'];
		$cols_per_page = $album_sp_config['img_cols'];
	}
	else
	{
		$album_show_pic_url = 'album_page.' . $phpEx;
		$album_rate_pic_url = 'album_rate.' . $phpEx;
		$limit_sql = $album_config['cols_per_page'] * $album_config['rows_per_page'];
		$cols_per_page = $album_config['cols_per_page'];
	}

	if ( !empty($cats) )
	{
		$sql = "SELECT p.pic_id, p.pic_title, p.pic_desc, p.pic_user_id, p.pic_user_ip, p.pic_username,
                p.pic_time, p.pic_cat_id, p.pic_view_count, u.user_id, u.username, r.rate_pic_id,
                AVG(r.rate_point) AS rating, COUNT(DISTINCT c.comment_id) AS comments
				FROM ". ALBUM_TABLE ." AS p
					LEFT JOIN ". USERS_TABLE ." AS u ON p.pic_user_id = u.user_id
					LEFT JOIN ". ALBUM_CAT_TABLE ." AS ct ON p.pic_cat_id = ct.cat_id
					LEFT JOIN ". ALBUM_RATE_TABLE ." AS r ON p.pic_id = r.rate_pic_id
					LEFT JOIN ". ALBUM_COMMENT_TABLE ." AS c ON p.pic_id = c.comment_pic_id
				WHERE p.pic_cat_id IN ($cats) AND ( p.pic_approval = 1 OR ct.cat_approval = 0 )
				GROUP BY p.pic_id
				ORDER BY RAND()
				LIMIT $limit_sql";

		if( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not query rand pics information', '', __LINE__, __FILE__, $sql);
		}

		$randrow = array();

		while( $row = $db->sql_fetchrow($result) )
		{
			$randrow[] = $row;
		}
		
		$db->sql_freeresult($result);

		$template->assign_block_vars('random_pics_block', array());

		if (count($randrow) > 0)
		{
			for ($i = 0; $i < count($randrow); $i += $cols_per_page)
			{
				$template->assign_block_vars('random_pics_block.rand_pics', array());

				for ($j = $i; $j < ($i + $cols_per_page); $j++)
				{
					if( $j >= count($randrow) )
					{
						break;
					}

					$template->assign_block_vars('random_pics_block.rand_pics.rand_col', array(
						'U_PIC' => ($album_config['fullpic_popup']) ? append_sid("album_pic.$phpEx?pic_id=". $randrow[$j]['pic_id']) : append_sid($album_show_pic_url . '?pic_id='. $randrow[$j]['pic_id']),
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

					if 	(defined('ALBUM_SP_CONFIG_TABLE'))
					{
						$image_rating = ImageRating($randrow[$j]['rating']);
                        $image_rating_link_style = ($image_rating == $lang['Not_rated']) ? '' : 'style="text-decoration: none;"';
					}
					else
					{
						$image_rating = (empty($randrow[$j]['rating'])) ? $lang['Not_rated'] : $randrow[$j]['rating'];
                        $image_rating_link_style = '';
					}

					$template->assign_block_vars('random_pics_block.rand_pics.rand_detail', array(
						'TITLE' => '<a href = "'.$album_show_pic_url . '?pic_id=' . $randrow[$j]['pic_id'] . '">' . $randrow[$j]['pic_title'] . '</a>',
						'POSTER' => $rand_poster,
						'TIME' => create_date($board_config['default_dateformat'], $randrow[$j]['pic_time'], $board_config['board_timezone']),

						'VIEW' => $randrow[$j]['pic_view_count'],

						'RATING' => ($album_config['rate'] == 1) ?( $lang['Rating'] . ' : <a href="'. append_sid(album_append_uid($album_rate_pic_url .'?pic_id='. $randrow[$j]['pic_id'])) . '" ' . $image_rating_link_style .'>' . $image_rating . '</a><br />') : '',

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

	if (empty($cats))
	{
		//
		// No Cats Found
		//
		$template->assign_block_vars('random_pics_block', array());
		$template->assign_block_vars('random_pics_block.no_pics', array());
	}
}

?>
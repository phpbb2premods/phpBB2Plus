<?php
/***************************************************************************
 *                             admin_forums.php
 *                            -------------------
 *   begin                : Thursday, Jul 12, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: admin_forums.php,v 1.40.2.11 2004/03/25 15:57:19 acydburn Exp $
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

define('IN_PHPBB', 1);

if( !empty($setmodules) )
{
	$file = basename(__FILE__);
	$module['Forums']['Manage'] = $file;
	return;
}

//
// Load default header
//
$phpbb_root_path = "./../";
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);
include($phpbb_root_path . 'includes/functions_admin.'.$phpEx);

$forum_auth_ary = array(
	"auth_view" => AUTH_ALL, 
	"auth_read" => AUTH_ALL, 
	"auth_post" => AUTH_REG, 
	"auth_reply" => AUTH_REG, 
	"auth_edit" => AUTH_REG, 
	"auth_delete" => AUTH_REG, 
	"auth_sticky" => AUTH_MOD, 
	"auth_announce" => AUTH_MOD, 
	"auth_vote" => AUTH_REG, 
	"auth_pollcreate" => AUTH_REG,
	"auth_ban" => AUTH_MOD, 
	"auth_greencard" => AUTH_ADMIN, 
	"auth_bluecard" => AUTH_REG
);
$forum_auth_ary['auth_attachments'] = AUTH_REG;
$forum_auth_ary['auth_download'] = AUTH_REG;
//
// Mode setting
//
if( isset($_POST['mode']) || isset($_GET['mode']) )
{
	$mode = ( isset($_POST['mode']) ) ? $_POST['mode'] : $_GET['mode'];
	$mode = htmlspecialchars($mode);
}
else
{
	$mode = "";
}

// ------------------
// Begin function block
//
//-- mod : categories hierarchy --------------------------------------------------------------------
//-- add

// check the presence of the attachment of the forum
$sql = "SELECT main_type FROM " . FORUMS_TABLE;
if ( $db->sql_query($sql) )
{
	define('SUB_FORUM_ATTACH', true);
}

// get the ids
$cat_id = 0;
if (isset($_POST[POST_CAT_URL]) || isset($_GET[POST_CAT_URL]))
{
	$cat_id = isset($_POST[POST_CAT_URL]) ? intval($_POST[POST_CAT_URL]) : intval($_GET[POST_CAT_URL]);
}

$forum_id = 0;
if (isset($_POST[POST_FORUM_URL]) || isset($_GET[POST_FORUM_URL]))
{
	$forum_id = isset($_POST[POST_FORUM_URL]) ? intval($_POST[POST_FORUM_URL]) : intval($_GET[POST_FORUM_URL]);
}

// check and fix parm
function admin_check_cat()
{
	global $db;

	$res = false;
	// build the cat list
	$mains = array();

	// from cats
	$sql = "SELECT * FROM " . CATEGORIES_TABLE . " ORDER BY cat_id";
	if ( !$result = $db->sql_query($sql) ) message_die(GENERAL_ERROR, "Couldn't access list of Categories", "", __LINE__, __FILE__, $sql);
	while ( $row = $db->sql_fetchrow($result) ) 
	{
		// fix cat_main value
		if (empty($row['cat_main_type'])) 
		{
			$row['cat_main_type'] = POST_CAT_URL;
		}
		if ( $row['cat_main'] == $row['cat_id'] )
		{
			$row['cat_main_type'] = POST_CAT_URL;
			$row['cat_main'] = 0;
		}
		// fill hierarchy array
		$mains[ POST_CAT_URL . $row['cat_id'] ] = $row['cat_main_type'] . $row['cat_main'];
	}  // end while ( $row = $db->sql_fetchrow($result) )

	// from forums
	$sql = "SELECT * FROM " . FORUMS_TABLE . " ORDER BY forum_id";
	if ( !$result = $db->sql_query($sql) ) message_die(GENERAL_ERROR, "Couldn't access list of Forums", "", __LINE__, __FILE__, $sql);
	while ( $row = $db->sql_fetchrow($result) ) 
	{
		// fill hierarchy array
		if (empty($row['main_type'])) $row['main_type'] = POST_CAT_URL;
		$mains[POST_FORUM_URL . $row['forum_id'] ] = $row['main_type'] . $row['cat_id'];
	}  // end while ( $row = $db->sql_fetchrow($result) )

	// no forums nor cats
	if (empty($mains)) return false;

	// push each cat
	reset($mains);
	while (list($id, $main) = each($mains) )
	{
		$root		= false;
		$cur		= $id;

		$stack		= array();
		$stack[]	= $cur;
		$error		= false;
		while ( !$root )
		{
			// parent catagory doesn't exists
			if ( ($mains[$cur] != 'c0' ) && !isset($mains[ $mains[$cur] ]) )
			{
				$error = true;
				$mains[$cur] = 'c0';
			}

			// the parent category is already in the stack (recursive attachement)
			if ( in_array($mains[$cur], $stack) )
			{
				$error = true;
				$mains[$cur] = 'c0';
			}

			// push parent category id
			$stack[] = $mains[$cur];

			// climb up a level
			$root = ($mains[$cur] == 'c0');
			$cur = $mains[$cur];

		}  // while ( !$root )

		// update database
		$type		= substr($id, 0, 1);
		$i			= intval(substr($id, 1));
		$main_type	= substr($mains[$id], 0, 1);
		$main_id	= intval(substr($mains[$id], 1));
		if ( $i != 0)
		{
			switch( $type )
			{
				case POST_CAT_URL:
					$sql = "UPDATE " . CATEGORIES_TABLE . " SET cat_main_type='".$main_type."', cat_main='".$main_id."' WHERE cat_id='".$i."'";
					if ( !$result = $db->sql_query($sql) ) message_die(GENERAL_ERROR, "Couldn't update list of Categories", "", __LINE__, __FILE__, $sql);
					break;
				case POST_FORUM_URL:
					$sql = "UPDATE " . FORUMS_TABLE . " SET cat_id='".$main_type."' WHERE forum_id='".$i."'";
					if (defined('SUB_FORUM_ATTACH'))
					{
						$sql = "UPDATE " . FORUMS_TABLE . " SET main_type='".$main_type."', cat_id='".$main_id."' WHERE forum_id='".$i."'";
					}
					if ( !$result = $db->sql_query($sql) ) message_die(GENERAL_ERROR, "Couldn't update list of Forums", "", __LINE__, __FILE__, $sql);
					break;
				default:
					$sql = '';
					break;
			}
		}
	}
	return $error;
}  // end

function move_tree($type, $id, $move)
{
	global $db;
	global $tree;

	// search the object
	$CH_this = (isset($tree['keys'][ $type . $id ])) ? $tree['keys'][ $type . $id ] : -1;

	// get the root id
	$main = ($CH_this < 0) ? 'Root' : $tree['main'][$CH_this];

	// renum objects of the same level and regenerate all
	$cats = array();
	$forums = array();
	$order = 0;
	$parents = array();
	for ($i=0; $i < count($tree['data']); $i++) 
	{
		if ($tree['main'][$i] == $main)
		{
			$order = $order + 10;
			$worder = ($i == $CH_this) ? $order + $move : $order;
			$field_name = ($tree['type'][$i] == POST_CAT_URL) ? 'cat_order' : 'forum_order';
			$tree['data'][$i][$field_name] = $worder;
		}
		if ($tree['type'][$i] == POST_CAT_URL)
		{
			$idx = count($cats);
			$cats[$idx] = $tree['data'][$i];
			$parents[POST_CAT_URL][ $tree['main'][$i] ][] = $idx;
		}
		else
		{
			$idx = count($forums);
			$forums[$idx] = $tree['data'][$i];
			$parents[POST_FORUM_URL][ $tree['main'][$i] ][] = $idx;
		}
	}

	// build the tree
	$tree = array();
	cache_tree_level('Root', $parents, $cats, $forums);

	// re-order all
	$order = 0;
	for ($i=0; $i < count($tree['data']); $i++)
	{
		$order = $order + 10;
		if ($tree['type'][$i] == POST_CAT_URL)
		{
			$sql = "UPDATE " . CATEGORIES_TABLE . " SET cat_order='".$order."' WHERE cat_id=" . $tree['id'][$i];
		}
		else
		{
			$sql = "UPDATE " . FORUMS_TABLE . " SET forum_order='".$order."' WHERE forum_id=" . $tree['id'][$i];
		}
		if ( !$db->sql_query($sql) ) message_die(GENERAL_ERROR, 'Couldn\'t update cat/forum order', '', __LINE__, __FILE__, $sql);
	}
}
//-- fin mod : categories hierarchy ----------------------------------------------------------------

function get_info($mode, $id)
{
	global $db;

	switch($mode)
	{
		case 'category':
			$table = CATEGORIES_TABLE;
			$idfield = 'cat_id';
			$namefield = 'cat_title';
			break;

		case 'forum':
			$table = FORUMS_TABLE;
			$idfield = 'forum_id';
			$namefield = 'forum_name';
			break;

		default:
			message_die(GENERAL_ERROR, "Wrong mode for generating select list", "", __LINE__, __FILE__);
			break;
	}
	$sql = "SELECT count(*) as total
		FROM $table";
	if( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, "Couldn't get Forum/Category information", "", __LINE__, __FILE__, $sql);
	}
	$count = $db->sql_fetchrow($result);
	$count = $count['total'];

	$sql = "SELECT *
		FROM $table
		WHERE $idfield = $id"; 

	if( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, "Couldn't get Forum/Category information", "", __LINE__, __FILE__, $sql);
	}

	if( $db->sql_numrows($result) != 1 )
	{
		message_die(GENERAL_ERROR, "Forum/Category doesn't exist or multiple forums/categories with ID $id", "", __LINE__, __FILE__);
	}

	$return = $db->sql_fetchrow($result);
	$return['number'] = $count;
	return $return;
}

function get_list($mode, $id, $select)
{
	global $db;

	switch($mode)
	{
		case 'category':
			$table = CATEGORIES_TABLE;
			$idfield = 'cat_id';
			$namefield = 'cat_title';
			break;

		case 'forum':
			$table = FORUMS_TABLE;
			$idfield = 'forum_id';
			$namefield = 'forum_name';
			break;

		default:
			message_die(GENERAL_ERROR, "Wrong mode for generating select list", "", __LINE__, __FILE__);
			break;
	}

	$sql = "SELECT *
		FROM $table";
	if( $select == 0 )
	{
		$sql .= " WHERE $idfield <> $id";
	}

	if( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, "Couldn't get list of Categories/Forums", "", __LINE__, __FILE__, $sql);
	}

	$cat_list = "";

	while( $row = $db->sql_fetchrow($result) )
	{
		$s = "";
		if ($row[$idfield] == $id)
		{
			$s = " selected=\"selected\"";
		}
		$catlist .= "<option value=\"$row[$idfield]\"$s>" . $row[$namefield] . "</option>\n";
	}

	return($catlist);
}

function renumber_order($mode, $cat = 0)
{
	global $db;

	switch($mode)
	{
		case 'category':
			$table = CATEGORIES_TABLE;
			$idfield = 'cat_id';
			$orderfield = 'cat_order';
			$cat = 0;
			break;

		case 'forum':
			$table = FORUMS_TABLE;
			$idfield = 'forum_id';
			$orderfield = 'forum_order';
			$catfield = 'cat_id';
			break;

		default:
			message_die(GENERAL_ERROR, "Wrong mode for generating select list", "", __LINE__, __FILE__);
			break;
	}

	$sql = "SELECT * FROM $table";
	if( $cat != 0)
	{
		$sql .= " WHERE $catfield = $cat";
	}
	$sql .= " ORDER BY $orderfield ASC";


	if( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, "Couldn't get list of Categories", "", __LINE__, __FILE__, $sql);
	}

	$i = 10;
	$inc = 10;

	while( $row = $db->sql_fetchrow($result) )
	{
		$sql = "UPDATE $table
			SET $orderfield = $i
			WHERE $idfield = " . $row[$idfield];
		if( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, "Couldn't update order fields", "", __LINE__, __FILE__, $sql);
		}
		$i += 10;
	}

}
//
// End function block
// ------------------

//
// Begin program proper
//
if( isset($_POST['addforum']) || isset($_POST['addcategory']) )
{
	$mode = ( isset($_POST['addforum']) ) ? "addforum" : "addcat";

	if( $mode == "addforum" )
	{
		list($cat_id) = each($_POST['addforum']);
		$cat_id = intval($cat_id);
		// 
		// stripslashes needs to be run on this because slashes are added when the forum name is posted
		//
		//-- mod : categories hierarchy --------------------------------------------------------------------
//-- delete
//		$forumname = stripslashes($_POST['forumname'][$cat_id]);
//-- add
		$forumname = stripslashes($_POST['name'][$cat_id]);
	}
	
	if( $mode == "addcat" )
	{
		list($cat_id) = each($_POST['addcategory']);
		$cat_title = stripslashes($_POST['name'][$cat_id]);
		$cat_main = $cat_id;
		$cat_id = -1;
//-- fin mod : categories hierarchy ----------------------------------------------------------------

	}
}

if( !empty($mode) ) 
{
	//-- mod : categories hierarchy --------------------------------------------------------------------
//-- add
	admin_check_cat();
	get_user_tree($userdata);
//-- fin mod : categories hierarchy ----------------------------------------------------------------

	switch($mode)
	{
		case 'addforum':
		case 'editforum':
			//
			// Show form to create/modify a forum
			//
			if ($mode == 'editforum')
			{
				// $newmode determines if we are going to INSERT or UPDATE after posting?

				$l_title = $lang['Edit_forum'];
				$newmode = 'modforum';
				$buttonvalue = $lang['Update'];

				$forum_id = intval($_GET[POST_FORUM_URL]);

				$row = get_info('forum', $forum_id);

				$cat_id = $row['cat_id'];
				$forumname = $row['forum_name'];
				$forumdesc = $row['forum_desc'];
				$forumstatus = $row['forum_status'];
				$countposts = $row['count_posts'];
				//-- mod : categories hierarchy --------------------------------------------------------------------
//-- add
				$main_type = $row['main_type'];
				if (!defined('SUB_FORUM_ATTACH'))
				{
					if (empty($main_type)) $main_type = POST_CAT_URL;
				}
				$forum_link				= $row['forum_link'];
				$forum_link_internal	= intval($row['forum_link_internal']);
				$forum_link_hit_count	= intval($row['forum_link_hit_count']);
				$forum_link_hit			= intval($row['forum_link_hit']);
				$icon = $row['icon'];
//-- fin mod : categories hierarchy ----------------------------------------------------------------


				//
				// start forum prune stuff.
				//
				if( $row['prune_enable'] )
				{
					$prune_enabled = "checked=\"checked\"";
					$sql = "SELECT *
               			FROM " . PRUNE_TABLE . "
               			WHERE forum_id = $forum_id";
					if(!$pr_result = $db->sql_query($sql))
					{
						 message_die(GENERAL_ERROR, "Auto-Prune: Couldn't read auto_prune table.", __LINE__, __FILE__);
        			}

					$pr_row = $db->sql_fetchrow($pr_result);
				}
				else
				{
					$prune_enabled = '';
				}
			}
			else
			{
				$l_title = $lang['Create_forum'];
				$newmode = 'createforum';
				$buttonvalue = $lang['Create_forum'];

				$forumdesc = '';
				$forumstatus = FORUM_UNLOCKED;
				$countposts = TRUE;
				$forum_id = ''; 
				$prune_enabled = '';
			//-- mod : categories hierarchy --------------------------------------------------------------------
//-- delete
//			}
//
//			$catlist = get_list('category', $cat_id, TRUE);
//-- add
				$main_type = POST_CAT_URL;
				$prune_enabled = '';
				$forum_link				= '';
				$forum_link_internal	= 0;
				$forum_link_hit_count	= 0;
				$forum_link_hit			= 0;
				$icon = '';
			}
			$catlist = get_tree_option( $main_type . $cat_id, true );
//-- fin mod : categories hierarchy ----------------------------------------------------------------


			$forumstatus == ( FORUM_LOCKED ) ? $forumlocked = "selected=\"selected\"" : $forumunlocked = "selected=\"selected\"";
			
			// These two options ($lang['Status_unlocked'] and $lang['Status_locked']) seem to be missing from
			// the language files.
			$lang['Status_unlocked'] = isset($lang['Status_unlocked']) ? $lang['Status_unlocked'] : 'Unlocked';
			$lang['Status_locked'] = isset($lang['Status_locked']) ? $lang['Status_locked'] : 'Locked';
			
			$statuslist = "<option value=\"" . FORUM_UNLOCKED . "\" $forumunlocked>" . $lang['Status_unlocked'] . "</option>\n";
			$statuslist .= "<option value=\"" . FORUM_LOCKED . "\" $forumlocked>" . $lang['Status_locked'] . "</option>\n"; 

			$template->set_filenames(array(
				"body" => "admin/forum_edit_body.tpl")
			);

			$s_hidden_fields = '<input type="hidden" name="mode" value="' . $newmode .'" /><input type="hidden" name="' . POST_FORUM_URL . '" value="' . $forum_id . '" />';

			$template->assign_vars(array(
				'S_FORUM_ACTION' => append_sid("admin_forums.$phpEx"),
				'S_HIDDEN_FIELDS' => $s_hidden_fields,
				'S_SUBMIT_VALUE' => $buttonvalue, 
				'S_CAT_LIST' => $catlist,
				'S_STATUS_LIST' => $statuslist,
				'S_PRUNE_ENABLED' => $prune_enabled,

				'L_FORUM_TITLE' => $l_title, 
				'L_FORUM_EXPLAIN' => $lang['Forum_edit_delete_explain'], 
				'L_FORUM_SETTINGS' => $lang['Forum_settings'], 
				'L_FORUM_NAME' => $lang['Forum_name'], 
				'L_CATEGORY' => $lang['Category'], 
				'L_FORUM_DESCRIPTION' => $lang['Forum_desc'],
				'L_FORUM_STATUS' => $lang['Forum_status'],
				'L_AUTO_PRUNE' => $lang['Forum_pruning'],
				'L_ENABLED' => $lang['Enabled'],
				'L_PRUNE_DAYS' => $lang['prune_days'],
				'L_PRUNE_FREQ' => $lang['prune_freq'],
				'L_DAYS' => $lang['Days'],

				'PRUNE_DAYS' => ( isset($pr_row['prune_days']) ) ? $pr_row['prune_days'] : 7,
				'PRUNE_FREQ' => ( isset($pr_row['prune_freq']) ) ? $pr_row['prune_freq'] : 1,
				//-- mod : categories hierarchy --------------------------------------------------------------------
//-- add
				'L_LINK'							=> $lang['Forum_link'],
				'L_FORUM_LINK'						=> $lang['Forum_link_url'],
				'L_FORUM_LINK_EXPLAIN'				=> $lang['Forum_link_url_explain'],
				'FORUM_LINK'						=> $forum_link,
				'L_FORUM_LINK_INTERNAL'				=> $lang['Forum_link_internal'],
				'L_FORUM_LINK_INTERNAL_EXPLAIN'		=> $lang['Forum_link_internal_explain'],
				'FORUM_LINK_INTERNAL_YES'			=> ( $forum_link_internal) ? ' checked="checked"' : '',
				'FORUM_LINK_INTERNAL_NO'			=> (!$forum_link_internal) ? ' checked="checked"' : '',
				'L_FORUM_LINK_HIT_COUNT'			=> $lang['Forum_link_hit_count'],
				'L_FORUM_LINK_HIT_COUNT_EXPLAIN'	=> $lang['Forum_link_hit_count_explain'],
				'FORUM_LINK_HIT_COUNT_YES'			=> ( $forum_link_hit_count) ? ' checked="checked"' : '',
				'FORUM_LINK_HIT_COUNT_NO'			=> (!$forum_link_hit_count) ? ' checked="checked"' : '',
				'L_YES'								=> $lang['Yes'],
				'L_NO'								=> $lang['No'],
				'L_ICON'							=> $lang['icon'],
				'L_ICON_EXPLAIN'					=> $lang['icon_explain'],
				'ICON'								=> $icon,
				'ICON_IMG'							=> empty($icon) ? '' : '<br /><img src="' . ( isset($images[$icon]) ? $phpbb_root_path . $images[$icon] : $icon ) . '" border="0" alt="' . $icon . '" title="' . $icon . '" />',
//-- fin mod : categories hierarchy ----------------------------------------------------------------

				'FORUM_NAME' => $forumname,
				'COUNT_POSTS_YES' => ($row['count_posts'] ? 'checked="checked"' : ''), 
            			'COUNT_POSTS_NO' => (!$row['count_posts'] ? 'checked="checked"' : ''), 

            			'L_COUNT_POSTS' => $lang['Post_count'], 
            			'L_YES' => $lang['Yes'], 
            			'L_NO' => $lang['No'],
				'DESCRIPTION' => $forumdesc)
			);
			$template->pparse("body");
			break;

		case 'createforum':
			//
			// Create a forum in the DB
			//
			if( trim($_POST['forumname']) == "" )
			{
				//-- mod : categories hierarchy --------------------------------------------------------------------
//-- delete
//				message_die(GENERAL_ERROR, "Can't create a forum without a name");
//			}
//
//			$sql = "SELECT MAX(forum_order) AS max_order
//				FROM " . FORUMS_TABLE . "
//				WHERE cat_id = " . intval($_POST[POST_CAT_URL]);
//			if( !$result = $db->sql_query($sql) )
//			{
//				message_die(GENERAL_ERROR, "Couldn't get order number from forums table", "", __LINE__, __FILE__, $sql);
//			}
//			$row = $db->sql_fetchrow($result);
//
//			$max_order = $row['max_order'];
//-- add
				message_die(GENERAL_ERROR, $lang['Forum_name_missing']);
			}

			// get ids
			$fid = $_POST[POST_CAT_URL];
			$type = substr($fid, 0, 1);
			$id = intval(substr($fid, 1));
			if ($fid == 'Root')
			{
				$id = 0;
				$type = POST_CAT_URL;
				if (!defined('SUB_FORUM_ATTACH'))
				{
					message_die(GENERAL_ERROR, $lang['Attach_root_wrong']);
				}
			}
			if ($type != POST_CAT_URL)
			{
				if (!defined('SUB_FORUM_ATTACH'))
				{
					message_die(GENERAL_ERROR, $lang['Attach_forum_wrong']);
				}
				if ($type == POST_FORUM_URL)
				{
					$CH_this = $tree['keys'][$type . $id];
					if (!empty($tree['data'][$CH_this]['forum_link']))
					{
						message_die(GENERAL_ERROR, $lang['Forum_attached_to_link_denied']);
					}
				}
			}
			$cat_id = $id;

			// get the last order
			$max_order = 0;
			$last = count($tree['data'])-1;
			if ($last >= 0) 
			{
				$max_order = ($tree['type'][$last] == POST_CAT_URL) ? $tree['data'][$last]['cat_order'] : $tree['data'][$last]['forum_order'];
			}
//-- fin mod : categories hierarchy ----------------------------------------------------------------

			$next_order = $max_order + 10;
			
			$sql = "SELECT MAX(forum_id) AS max_id
				FROM " . FORUMS_TABLE;
			if( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, "Couldn't get order number from forums table", "", __LINE__, __FILE__, $sql);
			}
			$row = $db->sql_fetchrow($result);

			$max_id = $row['max_id'];
			$next_id = $max_id + 1;

			//
			// Default permissions of public :: 
			//
			$field_sql = "";
			$value_sql = "";
			while( list($field, $value) = each($forum_auth_ary) )
			{
				$field_sql .= ", $field";
				$value_sql .= ", $value";

			}

			// There is no problem having duplicate forum names so we won't check for it.
			//-- mod : categories hierarchy --------------------------------------------------------------------
//-- add
			if (defined('SUB_FORUM_ATTACH'))
			{
				$field_sql .= ", main_type";
				$value_sql .= ", '$type'";
			}
			$forum_link				= isset($_POST['forum_link']) ? trim(stripslashes($_POST['forum_link'])) : '';
			$forum_link_internal	= isset($_POST['forum_link_internal']) ? intval($_POST['forum_link_internal']) : 0;
			$forum_link_hit_count	= isset($_POST['forum_link_hit_count']) ? intval($_POST['forum_link_hit_count']) : 0;
			$field_sql .= ", forum_link";
			$value_sql .= ", '$forum_link'";
			$field_sql .= ", forum_link_internal";
			$value_sql .= ", $forum_link_internal";
			$field_sql .= ", forum_link_hit_count";
			$value_sql .= ", $forum_link_hit_count";
			$icon = isset($_POST['icon']) ? trim(stripslashes($_POST['icon'])) : '';
			$field_sql .= ", icon";
			$value_sql .= ", '$icon'";
//-- fin mod : categories hierarchy ----------------------------------------------------------------
			//-- mod : categories hierarchy --------------------------------------------------------------------
// here we replaced
//	" . intval($_POST[POST_CAT_URL]) . "
// with
//	$cat_id
//-- modify

			$sql = "INSERT INTO " . FORUMS_TABLE . " (forum_id, forum_name, cat_id, forum_desc, forum_order, forum_status, prune_enable" . $field_sql . ")
				VALUES ('" . $next_id . "', '" . str_replace("\'", "''", $_POST['forumname']) . "', $cat_id, '" . str_replace("\'", "''", $_POST['forumdesc']) . "', $next_order, " . intval($_POST['forumstatus']) . ", " . intval($_POST['prune_enable']) . $value_sql . ")";
			if( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, "Couldn't insert row in forums table", "", __LINE__, __FILE__, $sql);
			}
			//-- mod : categories hierarchy --------------------------------------------------------------------
//-- add
			admin_check_cat();
			get_user_tree($userdata);
			move_tree('Root', 0, 0);
//-- fin mod : categories hierarchy ----------------------------------------------------------------

			if( $_POST['prune_enable'] )
			{

				if( $_POST['prune_days'] == "" || $_POST['prune_freq'] == "")
				{
					message_die(GENERAL_MESSAGE, $lang['Set_prune_data']);
				}

				$sql = "INSERT INTO " . PRUNE_TABLE . " (forum_id, prune_days, prune_freq)
					VALUES('" . $next_id . "', " . intval($_POST['prune_days']) . ", " . intval($_POST['prune_freq']) . ")";
				if( !$result = $db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, "Couldn't insert row in prune table", "", __LINE__, __FILE__, $sql);
				}
			}
			//-- mod : categories hierarchy --------------------------------------------------------------------
//-- add
			cache_tree(true);			
			board_stats();
			@unlink($phpbb_root_path . 'cache/c_seolist.'.$phpEx);
//-- fin mod : categories hierarchy ----------------------------------------------------------------

			$message = $lang['Forums_updated'] . "<br /><br />" . sprintf($lang['Click_return_forumadmin'], "<a href=\"" . append_sid("admin_forums.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");

			message_die(GENERAL_MESSAGE, $message);

			break;

		case 'modforum':
		//-- mod : categories hierarchy --------------------------------------------------------------------
//-- add
			if( trim($_POST['forumname']) == "" )
			{
				message_die(GENERAL_ERROR, $lang['Forum_name_missing']);
			}

			$fid = $_POST[POST_CAT_URL];
			$type = substr($fid, 0, 1);
			$id = intval(substr($fid, 1));
			if ($fid == 'Root')
			{
				$id = 0;
				$type = POST_CAT_URL;
				if (!defined('SUB_FORUM_ATTACH'))
				{
					message_die(GENERAL_ERROR, $lang['Attach_root_wrong']);
				}
			}
			if ($type != POST_CAT_URL)
			{
				if (!defined('SUB_FORUM_ATTACH'))
				{
					message_die(GENERAL_ERROR, $lang['Attach_forum_wrong']);
				}
				if ($type == POST_FORUM_URL)
				{
					$CH_this = $tree['keys'][$type . $id];
					if (!empty($tree['data'][$CH_this]['forum_link']))
					{
						message_die(GENERAL_ERROR, $lang['Forum_attached_to_link_denied']);
					}
				}
			}
			$cat_id = $id;
//-- fin mod : categories hierarchy ----------------------------------------------------------------

			// Modify a forum in the DB
			if( isset($_POST['prune_enable']))
			{
				if( $_POST['prune_enable'] != 1 )
				{
					$_POST['prune_enable'] = 0;
				}
			}
			//-- mod : categories hierarchy --------------------------------------------------------------------
//-- add
			$field_value_sql = '';
			$forum_link				= isset($_POST['forum_link']) ? trim(stripslashes($_POST['forum_link'])) : '';
			$forum_link_internal	= isset($_POST['forum_link_internal']) ? intval($_POST['forum_link_internal']) : 0;
			$forum_link_hit_count	= isset($_POST['forum_link_hit_count']) ? intval($_POST['forum_link_hit_count']) : 0;

			// check if link nothing is attached to the forum
			if (!empty($forum_link))
			{
				// forum_id
				$forum_id = intval($_POST[POST_FORUM_URL]);

				// search in tree if something is attached to
				if (isset($tree['sub'][POST_FORUM_URL . $forum_id]))
				{
					message_die(GENERAL_MESSAGE, $lang['Forum_link_with_attachment_deny']);
				}

				// is there some topics attached to ?
				$sql = "SELECT * FROM " . TOPICS_TABLE . " WHERE forum_id=$forum_id";
				if( !$result = $db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, 'Couldn\'t access topics table', '', __LINE__, __FILE__, $sql);
				}
				if ($row = $db->sql_fetchrow($result))
				{
					message_die(GENERAL_MESSAGE, $lang['Forum_link_with_topics_deny']);
				}
			}

			$field_value_sql .= ", forum_link='$forum_link'";
			$field_value_sql .= ", forum_link_internal=$forum_link_internal";
			$field_value_sql .= ", forum_link_hit_count=$forum_link_hit_count";
			if (defined('SUB_FORUM_ATTACH'))
			{
				$field_value_sql .= ", main_type = '$type'";
			}
			$icon = isset($_POST['icon']) ? trim(stripslashes($_POST['icon'])) : '';
			$field_value_sql .= ", icon = '$icon'";
//-- fin mod : categories hierarchy ----------------------------------------------------------------
			//-- mod : categories hierarchy --------------------------------------------------------------------
// here we replaced
//	" . intval($_POST[POST_CAT_URL]) . "
// with
//	$cat_id
//
// and added
//	. $field_value_sql
//--- modify

			$sql = "UPDATE " . FORUMS_TABLE . "
				SET forum_name = '" . str_replace("\'", "''", $_POST['forumname']) . "', cat_id = $cat_id, forum_desc = '" . str_replace("\'", "''", $_POST['forumdesc']) . "', forum_status = " . intval($_POST['forumstatus']) . ", prune_enable = " . intval($_POST['prune_enable']) . ", count_posts = " . intval($_POST['count_posts']) . $field_value_sql . "
				WHERE forum_id = " . intval($_POST[POST_FORUM_URL]);
			if( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, "Couldn't update forum information", "", __LINE__, __FILE__, $sql);
			}

			if( $_POST['prune_enable'] == 1 )
			{
				if( $_POST['prune_days'] == "" || $_POST['prune_freq'] == "" )
				{
					message_die(GENERAL_MESSAGE, $lang['Set_prune_data']);
				}

				$sql = "SELECT *
					FROM " . PRUNE_TABLE . "
					WHERE forum_id = " . intval($_POST[POST_FORUM_URL]);
				if( !$result = $db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, "Couldn't get forum Prune Information","",__LINE__, __FILE__, $sql);
				}

				if( $db->sql_numrows($result) > 0 )
				{
					$sql = "UPDATE " . PRUNE_TABLE . "
						SET	prune_days = " . intval($_POST['prune_days']) . ",	prune_freq = " . intval($_POST['prune_freq']) . "
				 		WHERE forum_id = " . intval($_POST[POST_FORUM_URL]);
				}
				else
				{
					$sql = "INSERT INTO " . PRUNE_TABLE . " (forum_id, prune_days, prune_freq)
						VALUES(" . intval($_POST[POST_FORUM_URL]) . ", " . intval($_POST['prune_days']) . ", " . intval($_POST['prune_freq']) . ")";
				}

				if( !$result = $db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, "Couldn't Update Forum Prune Information","",__LINE__, __FILE__, $sql);
				}
			}
			//-- mod : categories hierarchy --------------------------------------------------------------------
//-- add
			cache_tree(true);			
			board_stats();
			@unlink($phpbb_root_path . 'cache/c_seolist.'.$phpEx);
//-- fin mod : categories hierarchy ----------------------------------------------------------------

			$message = $lang['Forums_updated'] . "<br /><br />" . sprintf($lang['Click_return_forumadmin'], "<a href=\"" . append_sid("admin_forums.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");

			message_die(GENERAL_MESSAGE, $message);

			break;
			
		//-- mod : categories hierarchy --------------------------------------------------------------------
//-- delete
//		case 'addcat':
//			// Create a category in the DB
//			if( trim($_POST['categoryname']) == '')
//			{
//				message_die(GENERAL_ERROR, "Can't create a category without a name");
//			}
//
//			$sql = "SELECT MAX(cat_order) AS max_order
//				FROM " . CATEGORIES_TABLE;
//			if( !$result = $db->sql_query($sql) )
//			{
//				message_die(GENERAL_ERROR, "Couldn't get order number from categories table", "", __LINE__, __FILE__, $sql);
//			}
//			$row = $db->sql_fetchrow($result);
//
//			$max_order = $row['max_order'];
//-- add
		case 'createcat':
			// Create a category in the DB
			$icon = isset($_POST['icon']) ? trim($_POST['icon']) : '';
			if( trim($_POST['cat_title']) == '')
			{
				message_die(GENERAL_ERROR, $lang['Category_name_missing']);
			}
			$main = $_POST['cat_main'];
			if ($main == 'Root')
			{
				$cat_main_type = POST_CAT_URL;
				$cat_main = 0;
			}
			else
			{
				$cat_main_type = substr($main, 0, 1);
				$cat_main = intval(substr($main, 1));
			}
			if ($cat_main_type == POST_FORUM_URL)
			{
				$CH_this = $tree['keys'][$cat_main_type . $cat_main];
				if (!empty($tree['data'][$CH_this]['forum_link']))
				{
					message_die(GENERAL_ERROR, $lang['Forum_attached_to_link_denied']);
				}
			}

			// get the last order
			$max_order = 0;
			$last = count($tree['data'])-1;
			if ($last >= 0) 
			{
				$max_order = ($tree['type'][$last] == POST_CAT_URL) ? $tree['data'][$last]['cat_order'] : $tree['data'][$last]['forum_order'];
			}
//-- fin mod : categories hierarchy ----------------------------------------------------------------

			$next_order = $max_order + 10;

			//
			// There is no problem having duplicate forum names so we won't check for it.
			//
			//-- mod : categories hierarchy --------------------------------------------------------------------
//-- delete
//			$sql = "INSERT INTO " . CATEGORIES_TABLE . " (cat_title, cat_order)
//				VALUES ('" . str_replace("\'", "''", $_POST['categoryname']) . "', $next_order)";
//-- add
			$sql = "INSERT INTO " . CATEGORIES_TABLE . " (cat_title, cat_main_type, cat_main, cat_desc, icon, cat_order)
				VALUES ('" . str_replace("\'", "''", $_POST['cat_title']) . "', '" . $cat_main_type . "', " . $cat_main . ", '" . str_replace("\'", "''", $_POST['cat_desc']) . "', '" . str_replace("\'", "''", $icon) . "', $next_order)";
//-- fin mod : categories hierarchy ----------------------------------------------------------------

			if( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, "Couldn't insert row in categories table", "", __LINE__, __FILE__, $sql);
			}
			//-- mod : categories hierarchy --------------------------------------------------------------------
//-- add
			admin_check_cat();
			get_user_tree($userdata);
			move_tree('Root', 0, 0);
			cache_tree(true);			
			board_stats();
			@unlink($phpbb_root_path . 'cache/c_seolist.'.$phpEx);
//-- fin mod : categories hierarchy ----------------------------------------------------------------

			$message = $lang['Forums_updated'] . "<br /><br />" . sprintf($lang['Click_return_forumadmin'], "<a href=\"" . append_sid("admin_forums.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");

			message_die(GENERAL_MESSAGE, $message);

			break;
			//-- mod : categories hierarchy --------------------------------------------------------------------
//-- add
		case 'addcat':
//-- fin mod : categories hierarchy ----------------------------------------------------------------

		case 'editcat':
			//
			// Show form to edit a category
			//
			//-- mod : categories hierarchy --------------------------------------------------------------------
//-- add
			if ($mode == 'editcat')
			{
				$l_title = $lang['Edit_Category'];
//-- fin mod : categories hierarchy ----------------------------------------------------------------

			$newmode = 'modcat';
			$buttonvalue = $lang['Update'];

			$cat_id = intval($_GET[POST_CAT_URL]);

			$row = get_info('category', $cat_id);
			$cat_title = $row['cat_title'];
			//-- mod : categories hierarchy --------------------------------------------------------------------
//-- add
				$cat_desc	= $row['cat_desc'];
				$icon = $row['icon'];
				$cat_main	= $row['cat_main'];
				$cat_main_type = $row['cat_main_type'];
				if ($cat_main <= 0)
				{
					$cat_main = 0;
					$cat_main_type = POST_CAT_URL;
				}
			}
			else
			{
				$l_title = $lang['Create_category'];
				$newmode = 'createcat';
				$buttonvalue = $lang['Create_category'];

				$cat_desc  = '';
				$icon = '';
				$cat_main_type = POST_CAT_URL;
				if ($cat_main <= 0)
				{
					$cat_main = 0;
				}
			}

			// get the list of cats/forums
			$catlist = get_tree_option($cat_main_type . $cat_main, true);
//-- fin mod : categories hierarchy ----------------------------------------------------------------

			$template->set_filenames(array(
				"body" => "admin/category_edit_body.tpl")
			);

			$s_hidden_fields = '<input type="hidden" name="mode" value="' . $newmode . '" /><input type="hidden" name="' . POST_CAT_URL . '" value="' . $cat_id . '" />';

			$template->assign_vars(array(
				'CAT_TITLE' => $cat_title,

				//-- mod : categories hierarchy --------------------------------------------------------------------
//-- delete
//				'L_EDIT_CATEGORY' => $lang['Edit_Category'],
//-- add
				'L_CAT_DESCRIPTION'			=> $lang['Category_desc'],
				'CAT_DESCRIPTION'			=> $cat_desc,
				'S_CAT_LIST'				=> $catlist,
				'L_CATEGORY_ATTACHMENT'		=> $lang['Category_attachment'],

				'L_EDIT_CATEGORY'			=> $l_title,
				'L_ICON'					=> $lang['icon'],
				'L_ICON_EXPLAIN'			=> $lang['icon_explain'],
				'ICON'						=> $icon,
				'ICON_IMG'					=> empty($icon) ? '' : '<br /><img src="' . ( isset($images[$icon]) ? $phpbb_root_path . $images[$icon] : $icon ) . '" border="0" alt="' . $icon . '" title="' . $icon . '" />',
//-- fin mod : categories hierarchy ----------------------------------------------------------------
 
				'L_EDIT_CATEGORY_EXPLAIN' => $lang['Edit_Category_explain'], 
				'L_CATEGORY' => $lang['Category'], 

				'S_HIDDEN_FIELDS' => $s_hidden_fields, 
				'S_SUBMIT_VALUE' => $buttonvalue, 
				'S_FORUM_ACTION' => append_sid("admin_forums.$phpEx"))
			);

			$template->pparse("body");
			break;

		case 'modcat':
			// Modify a category in the DB
			//-- mod : categories hierarchy --------------------------------------------------------------------
//-- add
			$icon = isset($_POST['icon']) ? trim($_POST['icon']) : '';
			if( trim($_POST['cat_title']) == '')
			{
				message_die(GENERAL_ERROR, $lang['Category_name_missing']);
			}
			$main = $_POST['cat_main'];
			if ($main == 'Root')
			{
				$cat_main_type = POST_CAT_URL;
				$cat_main = 0;
			}
			else
			{
				$cat_main_type = substr($main, 0, 1);
				$cat_main = intval(substr($main, 1));
			}
			if ($cat_main_type == POST_FORUM_URL)
			{
				$CH_this = $tree['keys'][$cat_main_type . $cat_main];
				if (!empty($tree['data'][$CH_this]['forum_link']))
				{
					message_die(GENERAL_ERROR, $lang['Forum_attached_to_link_denied']);
				}
			}

			// update db
//-- fin mod : categories hierarchy ----------------------------------------------------------------
			//-- mod : categories hierarchy --------------------------------------------------------------------
// here we added
//	, cat_main_type='" . $cat_main_type . "', cat_main = " . $cat_main . ", cat_desc = '" . str_replace("\'", "''", $_POST['cat_desc']) . "', icon = '" . str_replace("\'", "''", $icon) . "'
//-- modify

			$sql = "UPDATE " . CATEGORIES_TABLE . "
				SET cat_title = '" . str_replace("\'", "''", $_POST['cat_title']) . "', cat_main_type='" . $cat_main_type . "', cat_main = " . $cat_main . ", cat_desc = '" . str_replace("\'", "''", $_POST['cat_desc']) . "', icon = '" . str_replace("\'", "''", $icon) . "'
				WHERE cat_id = " . intval($_POST[POST_CAT_URL]);
			if( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, "Couldn't update forum information", "", __LINE__, __FILE__, $sql);
			}

			$message = $lang['Forums_updated'] . "<br /><br />" . sprintf($lang['Click_return_forumadmin'], "<a href=\"" . append_sid("admin_forums.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");
			//-- mod : categories hierarchy --------------------------------------------------------------------
//-- add
			cache_tree(true);			
			board_stats();
			@unlink($phpbb_root_path . 'cache/c_seolist.'.$phpEx);
			$err = admin_check_cat();
			if ( $err ) $message = $lang['Category_config_error_fixed'] . "<br /><br />" . $message;
//-- fin mod : categories hierarchy ----------------------------------------------------------------

			message_die(GENERAL_MESSAGE, $message);

			break;
			
		case 'deleteforum':
			// Show form to delete a forum
			$forum_id = intval($_GET[POST_FORUM_URL]);

			$select_to = '<select name="to_id">';
			$select_to .= "<option value=\"-1\"$s>" . $lang['Delete_all_posts'] . "</option>\n";
			//-- mod : categories hierarchy --------------------------------------------------------------------
//-- delete
//			$select_to .= get_list('forum', $forum_id, 0);
//-- add
			$select_to .= '<option value=""></option>';
			$select_to .= get_tree_option('', true); 
//-- fin mod : categories hierarchy ----------------------------------------------------------------

			$select_to .= '</select>';

			$buttonvalue = $lang['Move_and_Delete'];

			$newmode = 'movedelforum';

			//-- mod : categories hierarchy --------------------------------------------------------------------
//-- delete
//			$foruminfo = get_info('forum', $forum_id);
//			$name = $foruminfo['forum_name'];
//-- add
			$CH_this = $tree['keys'][POST_FORUM_URL . $forum_id];
			$name = $tree['data'][$CH_this]['forum_name'];
			$desc = $tree['data'][$CH_this]['forum_desc'];

			$name_trad = get_object_lang(POST_FORUM_URL . $forum_id, 'name');
			$desc_trad = get_object_lang(POST_FORUM_URL . $forum_id, 'desc');
			if ($name != $name_trad) $name = '(' . $name . ') ' . $name_trad;
			if ($desc != $desc_trad) $desc = '(' . $desc . ') ' . $desc_trad;
//-- fin mod : categories hierarchy ----------------------------------------------------------------


			$template->set_filenames(array(
				"body" => "admin/forum_delete_body.tpl")
			);

			$s_hidden_fields = '<input type="hidden" name="mode" value="' . $newmode . '" /><input type="hidden" name="from_id" value="' . $forum_id . '" />';

			$template->assign_vars(array(
				'NAME' => $name, 

				'L_FORUM_DELETE' => $lang['Forum_delete'], 
				'L_FORUM_DELETE_EXPLAIN' => $lang['Forum_delete_explain'], 
				'L_MOVE_CONTENTS' => $lang['Move_contents'], 
				'L_FORUM_NAME' => $lang['Forum_name'], 

				"S_HIDDEN_FIELDS" => $s_hidden_fields,
				'S_FORUM_ACTION' => append_sid("admin_forums.$phpEx"), 
				'S_SELECT_TO' => $select_to,
				'S_SUBMIT_VALUE' => $buttonvalue)
			);
			//-- mod : categories hierarchy --------------------------------------------------------------------
//-- add
			$template->assign_vars(array(
				'DESC'			=> $desc,
				'L_FORUM_DESC'	=> $lang['Forum_desc'],
				)
			);
//-- fin mod : categories hierarchy ----------------------------------------------------------------

			$template->pparse("body");
			break;

		case 'movedelforum':
			//
			// Move or delete a forum in the DB
			//
			$from_id = intval($_POST['from_id']);
			//-- mod : categories hierarchy --------------------------------------------------------------------
//-- delete
//			$to_id = intval($_POST['to_id']);
//-- add
			$to_fid = $_POST['to_id'];
			if (intval($to_fid) == -1)
			{
				$to_type = '';
				$to_id = -1;
			}
			else
			{
				$to_type	= substr($to_fid, 0, 1);
				$to_id		= intval(substr($to_fid, 1));
				if (($to_type != POST_FORUM_URL) || ($to_fid == 'Root'))
				{
					message_die(GENERAL_MESSAGE, $lang['Only_forum_for_topics']);
				}
			}

			// check if sub-levels present
			if (!empty($tree['sub'][POST_FORUM_URL. $from_id]))
			{
				message_die(GENERAL_MESSAGE, $lang['Delete_forum_with_attachment_denied']);
			}
//-- fin mod : categories hierarchy ----------------------------------------------------------------
			$delete_old = intval($_POST['delete_old']);


			// Either delete or move all posts in a forum
			if($to_id == -1)
			{
				// Delete polls in this forum
				$sql = "SELECT v.vote_id 
					FROM " . VOTE_DESC_TABLE . " v, " . TOPICS_TABLE . " t 
					WHERE t.forum_id = $from_id 
						AND v.topic_id = t.topic_id";
				if (!($result = $db->sql_query($sql)))
				{
					message_die(GENERAL_ERROR, "Couldn't obtain list of vote ids", "", __LINE__, __FILE__, $sql);
				}

				if ($row = $db->sql_fetchrow($result))
				{
					$vote_ids = '';
					do
					{
						$vote_ids = (($vote_ids != '') ? ', ' : '') . $row['vote_id'];
					}
					while ($row = $db->sql_fetchrow($result));

					$sql = "DELETE FROM " . VOTE_DESC_TABLE . " 
						WHERE vote_id IN ($vote_ids)";
					$db->sql_query($sql);

					$sql = "DELETE FROM " . VOTE_RESULTS_TABLE . " 
						WHERE vote_id IN ($vote_ids)";
					$db->sql_query($sql);

					$sql = "DELETE FROM " . VOTE_USERS_TABLE . " 
						WHERE vote_id IN ($vote_ids)";
					$db->sql_query($sql);
				}
				$db->sql_freeresult($result);
				
				include($phpbb_root_path . "includes/prune.$phpEx");
				prune($from_id, 0, true); // Delete everything from forum
			}
			else
			{
				$sql = "SELECT *
					FROM " . FORUMS_TABLE . "
					WHERE forum_id IN ($from_id, $to_id)";
				if( !$result = $db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, "Couldn't verify existence of forums", "", __LINE__, __FILE__, $sql);
				}

				if($db->sql_numrows($result) != 2)
				{
					message_die(GENERAL_ERROR, "Ambiguous forum ID's", "", __LINE__, __FILE__);
				}
				$sql = "UPDATE " . TOPICS_TABLE . "
					SET forum_id = $to_id
					WHERE forum_id = $from_id";
				if( !$result = $db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, "Couldn't move topics to other forum", "", __LINE__, __FILE__, $sql);
				}
				$sql = "UPDATE " . POSTS_TABLE . "
					SET	forum_id = $to_id
					WHERE forum_id = $from_id";
				if( !$result = $db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, "Couldn't move posts to other forum", "", __LINE__, __FILE__, $sql);
				}
				sync('forum', $to_id);
			}

			// Alter Mod level if appropriate - 2.0.4
			$sql = "SELECT ug.user_id 
				FROM " . AUTH_ACCESS_TABLE . " a, " . USER_GROUP_TABLE . " ug 
				WHERE a.forum_id <> $from_id 
					AND a.auth_mod = 1
					AND ug.group_id = a.group_id";
			if( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, "Couldn't obtain moderator list", "", __LINE__, __FILE__, $sql);
			}

			if ($row = $db->sql_fetchrow($result))
			{
				$user_ids = '';
				do
				{
					$user_ids .= (($user_ids != '') ? ', ' : '' ) . $row['user_id'];
				}
				while ($row = $db->sql_fetchrow($result));

				$sql = "SELECT ug.user_id 
					FROM " . AUTH_ACCESS_TABLE . " a, " . USER_GROUP_TABLE . " ug 
					WHERE a.forum_id = $from_id 
						AND a.auth_mod = 1 
						AND ug.group_id = a.group_id
						AND ug.user_id NOT IN ($user_ids)";
				if( !$result2 = $db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, "Couldn't obtain moderator list", "", __LINE__, __FILE__, $sql);
				}
					
				if ($row = $db->sql_fetchrow($result2))
				{
					$user_ids = '';
					do
					{
						$user_ids .= (($user_ids != '') ? ', ' : '' ) . $row['user_id'];
					}
					while ($row = $db->sql_fetchrow($result2));

					$sql = "UPDATE " . USERS_TABLE . " 
						SET user_level = " . USER . " 
						WHERE user_id IN ($user_ids) 
							AND user_level <> " . ADMIN;
					$db->sql_query($sql);
				}
				$db->sql_freeresult($result);

			}
			$db->sql_freeresult($result2);

			$sql = "DELETE FROM " . FORUMS_TABLE . "
				WHERE forum_id = $from_id";
			if( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, "Couldn't delete forum", "", __LINE__, __FILE__, $sql);
			}
			
			$sql = "DELETE FROM " . AUTH_ACCESS_TABLE . "
				WHERE forum_id = $from_id";
			if( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, "Couldn't delete forum", "", __LINE__, __FILE__, $sql);
			}
			
			$sql = "DELETE FROM " . PRUNE_TABLE . "
				WHERE forum_id = $from_id";
			if( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, "Couldn't delete forum prune information!", "", __LINE__, __FILE__, $sql);
			}
			//-- mod : categories hierarchy --------------------------------------------------------------------
//-- add
			cache_tree(true);			
			board_stats();
			@unlink($phpbb_root_path . 'cache/c_seolist.'.$phpEx);
//-- fin mod : categories hierarchy ----------------------------------------------------------------

			$message = $lang['Forums_updated'] . "<br /><br />" . sprintf($lang['Click_return_forumadmin'], "<a href=\"" . append_sid("admin_forums.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");

			message_die(GENERAL_MESSAGE, $message);

			break;
			
		case 'deletecat':
			//
			// Show form to delete a category
			//
			$cat_id = intval($_GET[POST_CAT_URL]);

			$buttonvalue = $lang['Move_and_Delete'];
			$newmode = 'movedelcat';
			//-- mod : categories hierarchy --------------------------------------------------------------------
//-- delete
//			$catinfo = get_info('category', $cat_id);
//			$name = $catinfo['cat_title'];
//
//			if ($catinfo['number'] == 1)
//			{
//				$sql = "SELECT count(*) as total
//					FROM ". FORUMS_TABLE;
//				if( !$result = $db->sql_query($sql) )
//				{
//					message_die(GENERAL_ERROR, "Couldn't get Forum count", "", __LINE__, __FILE__, $sql);
//				}
//				$count = $db->sql_fetchrow($result);
//				$count = $count['total'];
//
//				if ($count > 0)
//				{
//					message_die(GENERAL_ERROR, $lang['Must_delete_forums']);
//				}
//				else
//				{
//					$select_to = $lang['Nowhere_to_move'];
//				}
//			}
//			else
//			{
//				$select_to = '<select name="to_id">';
//				$select_to .= get_list('category', $cat_id, 0);
//				$select_to .= '</select>';
//			}
//-- add
			$CH_this = $tree['keys'][POST_CAT_URL . $cat_id];
			$name = $tree['data'][$CH_this]['cat_title'];
			$desc = $tree['data'][$CH_this]['cat_desc'];

			$name_trad = get_object_lang(POST_CAT_URL . $cat_id, 'name');
			$desc_trad = get_object_lang(POST_CAT_URL . $cat_id, 'desc');
			if ($name != $name_trad) $name = '(' . $name . ') ' . $name_trad;
			if ($desc != $desc_trad) $desc = '(' . $desc . ') ' . $desc_trad;

			// chek main category deletation
			if ($tree['main'][$CH_this] == 'Root')
			{
				// check if other main categories
				$found = false;
				for ($i=0; (($i < count($tree['data'])) && !$found); $i++)
				{
					$found = (($i != $CH_this) && ($tree['main'][$i] == 'Root'));
				}
				// no other main cats : check if forums presents
				if (!$found)
				{
					$found = false;
					for ($i=0; $i < count($tree['sub'][POST_CAT_URL . $from_id]); $i++)
					{
						$found = ($tree['type'][$tree['keys'][$tree['sub'][POST_CAT_URL . $cat_id][$i]]] == POST_FORUM_URL);
					}
					if ($found)
					{
						message_die(GENERAL_ERROR, $lang['Must_delete_forums']);
					}
				}
			}
			
			// get cat list
			$s_cat_list = get_tree_option('', true);
			$select_to = '<select name="to_id">' . $s_cat_list . '</select>';
//-- fin mod : categories hierarchy ----------------------------------------------------------------


			$template->set_filenames(array(
				"body" => "admin/forum_delete_body.tpl")
			);

			$s_hidden_fields = '<input type="hidden" name="mode" value="' . $newmode . '" /><input type="hidden" name="from_id" value="' . $cat_id . '" />';

			$template->assign_vars(array(
				'NAME' => $name, 

				//-- mod : categories hierarchy --------------------------------------------------------------------
//-- delete
//				'L_FORUM_DELETE' => $lang['Forum_delete'], 
//				'L_FORUM_DELETE_EXPLAIN' => $lang['Forum_delete_explain'], 
//-- add
				'L_FORUM_DELETE' => $lang['Category_delete'],
				'L_FORUM_DELETE_EXPLAIN' => $lang['Category_delete_explain'],
//-- fin mod : categories hierarchy ----------------------------------------------------------------
				'L_MOVE_CONTENTS' => $lang['Move_contents'], 
//-- mod : categories hierarchy --------------------------------------------------------------------
//-- delete
//				'L_FORUM_NAME' => $lang['Forum_name'], 
//-- add
				'L_FORUM_NAME' => $lang['Category'],
//-- fin mod : categories hierarchy ----------------------------------------------------------------

				'S_HIDDEN_FIELDS' => $s_hidden_fields,
				'S_FORUM_ACTION' => append_sid("admin_forums.$phpEx"), 
				'S_SELECT_TO' => $select_to,
				'S_SUBMIT_VALUE' => $buttonvalue)
			);

//-- mod : categories hierarchy --------------------------------------------------------------------
//-- add
			$template->assign_vars(array(
				'L_FORUM_DESC'	=> $lang['Category_desc'],
				'DESC'			=> $desc,
				)
			);
//-- fin mod : categories hierarchy ----------------------------------------------------------------
			$template->pparse("body");
			break;

		case 'movedelcat':

			//
			// Move or delete a category in the DB
			//
			$from_id = intval($_POST['from_id']);
			//-- mod : categories hierarchy --------------------------------------------------------------------
//-- delete
//			$to_id = intval($_POST['to_id']); 
//-- add
			$to_fid		= $_POST['to_id'];
			$to_type	= substr($to_fid, 0, 1);
			$to_id		= intval(substr($to_fid, 1));
//-- fin mod : categories hierarchy ----------------------------------------------------------------

			if (!empty($to_id))

			{
				$sql = "SELECT *
					FROM " . CATEGORIES_TABLE . "
					WHERE cat_id IN ($from_id, $to_id)";
				if( !$result = $db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, "Couldn't verify existence of categories", "", __LINE__, __FILE__, $sql);
				}
				if($db->sql_numrows($result) != 2)
				{
					message_die(GENERAL_ERROR, "Ambiguous category ID's", "", __LINE__, __FILE__);
				}
				//-- mod : categories hierarchy --------------------------------------------------------------------
//-- add
				// check that there is no forum attached to the from cat (will issue to forum attached to forums)
				if (($to_type == POST_FORUM_URL) && !defined('SUB_FORUM_ATTACH'))
				{
					$found = false;
					for ($i=0; $i < count($tree['sub'][POST_CAT_URL . $from_id]); $i++)
					{
						$found = ($tree['type'][$tree['keys'][$tree['sub'][POST_CAT_URL . $from_id][$i]]] == POST_FORUM_URL);
					}
					if ($found)
					{
						message_die(GENERAL_ERROR, $lang['Must_delete_forums']);
					}
				}

				$sql_feed = '';
				$sql_where = '';
				if (defined('SUB_FORUM_ATTACH'))
				{
					$sql_feed = ", main_type='$to_type'";
					$sql_where = " AND main_type='" . POST_CAT_URL . "'";
				}
//-- fin mod : categories hierarchy ----------------------------------------------------------------
				//-- mod : categories hierarchy --------------------------------------------------------------------
// here we added
//	" . $sql_feed . "
// and
//	 . $sql_where
//-- modify

				$sql = "UPDATE " . FORUMS_TABLE . "
					SET cat_id = $to_id" . $sql_feed . "
					WHERE cat_id = $from_id" . $sql_where;
				if( !$result = $db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, "Couldn't move forums to other category", "", __LINE__, __FILE__, $sql);
				}
			}
			else if ( $to_fid == 'Root' )
         {
            $found = false;
            for ($i=0; $i < count($tree['sub'][POST_CAT_URL . $from_id]); $i++)
            {
               $found = ($tree['type'][$tree['keys'][$tree['sub'][POST_CAT_URL . $from_id][$i]]] == POST_FORUM_URL);
            }
            if ($found)
            {
               message_die(GENERAL_ERROR, $lang['Must_delete_forums']);
            }
         }
			$sql = "DELETE FROM " . CATEGORIES_TABLE ."
				WHERE cat_id = $from_id";
				
			if( !$result = $db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, "Couldn't delete category", "", __LINE__, __FILE__, $sql);
			}

			$message = $lang['Forums_updated'] . "<br /><br />" . sprintf($lang['Click_return_forumadmin'], "<a href=\"" . append_sid("admin_forums.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");
			//-- mod : categories hierarchy --------------------------------------------------------------------
//-- add
			cache_tree(true);			
			board_stats();
			@unlink($phpbb_root_path . 'cache/c_seolist.'.$phpEx);
			$err = admin_check_cat();
			if ( $err ) $message = $lang['Category_config_error_fixed'] . "<br /><br />" . $message;
//-- fin mod : categories hierarchy ----------------------------------------------------------------

			message_die(GENERAL_MESSAGE, $message);

			break;

		case 'forum_order':
			//
			// Change order of forums in the DB
			//
			$move = intval($_GET['move']);
			$forum_id = intval($_GET[POST_FORUM_URL]);

			//-- mod : categories hierarchy --------------------------------------------------------------------
//-- delete
//			$forum_info = get_info('forum', $forum_id);
//
//			$cat_id = $forum_info['cat_id'];
//
//			$sql = "UPDATE " . FORUMS_TABLE . "
//				SET forum_order = forum_order + $move
//				WHERE forum_id = $forum_id";
//			if( !$result = $db->sql_query($sql) )
//			{
//				message_die(GENERAL_ERROR, "Couldn't change category order", "", __LINE__, __FILE__, $sql);
//			}
//
//			renumber_order('forum', $forum_info['cat_id']);
//-- add
			// update the level order
			move_tree(POST_FORUM_URL, $forum_id, $move);
			cache_tree(true);			
			board_stats();
			@unlink($phpbb_root_path . 'cache/c_seolist.'.$phpEx);
//-- fin mod : categories hierarchy ----------------------------------------------------------------

			$show_index = TRUE;

			break;
			
		case 'cat_order':
			//
			// Change order of categories in the DB
			//
			$move = intval($_GET['move']);
			$cat_id = intval($_GET[POST_CAT_URL]);

			//-- mod : categories hierarchy --------------------------------------------------------------------
//-- delete
//			$sql = "UPDATE " . CATEGORIES_TABLE . "
//				SET cat_order = cat_order + $move
//				WHERE cat_id = $cat_id";
//			if( !$result = $db->sql_query($sql) )
//			{
//				message_die(GENERAL_ERROR, "Couldn't change category order", "", __LINE__, __FILE__, $sql);
//			}
//
//			renumber_order('category');
//-- add
			// update the level order
			move_tree(POST_CAT_URL, $cat_id, $move);

			// get ids
			$main	= $tree['main'][ $tree['keys'][POST_CAT_URL . $cat_id] ];
			$cat_id = $tree['id'][ $tree['keys'][$main] ];
			cache_tree(true);			
			board_stats();
			@unlink($phpbb_root_path . 'cache/c_seolist.'.$phpEx);
//-- fin mod : categories hierarchy ----------------------------------------------------------------

			$show_index = TRUE;

			break;

		case 'forum_sync':
			sync('forum', intval($_GET[POST_FORUM_URL]));
			$show_index = TRUE;

			break;

		default:
			message_die(GENERAL_MESSAGE, $lang['No_mode']);
			break;
	}

	if ($show_index != TRUE)
	{
		include('./page_footer_admin.'.$phpEx);
		exit;
	}
}

//
// Start page proper
//
$template->set_filenames(array(
	"body" => "admin/forum_admin_body.tpl")
);

$template->assign_vars(array(
	//-- mod : categories hierarchy --------------------------------------------------------------------
//-- add
	'L_ACTION' => $lang['Action'],
//-- fin mod : categories hierarchy ----------------------------------------------------------------

	'S_FORUM_ACTION' => append_sid("admin_forums.$phpEx"),
	'L_FORUM_TITLE' => $lang['Forum_admin'], 
	'L_FORUM_EXPLAIN' => $lang['Forum_admin_explain'], 
	'L_CREATE_FORUM' => $lang['Create_forum'], 
	'L_CREATE_CATEGORY' => $lang['Create_category'], 
	'L_EDIT' => $lang['Edit'], 
	'L_DELETE' => $lang['Delete'], 
	'L_MOVE_UP' => $lang['Move_up'], 
	'L_MOVE_DOWN' => $lang['Move_down'], 
	'L_RESYNC' => $lang['Resync'])
);
//-- mod : categories hierarchy --------------------------------------------------------------------
//-- delete
/*

$sql = "SELECT cat_id, cat_title, cat_order
	FROM " . CATEGORIES_TABLE . "
	ORDER BY cat_order";
if( !$q_categories = $db->sql_query($sql) )
{
	message_die(GENERAL_ERROR, "Could not query categories list", "", __LINE__, __FILE__, $sql);
}

if( $total_categories = $db->sql_numrows($q_categories) )
{
	$category_rows = $db->sql_fetchrowset($q_categories);

	$sql = "SELECT *
		FROM " . FORUMS_TABLE . "
		ORDER BY cat_id, forum_order";
	if(!$q_forums = $db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, "Could not query forums information", "", __LINE__, __FILE__, $sql);
	}

	if( $total_forums = $db->sql_numrows($q_forums) )
	{
		$forum_rows = $db->sql_fetchrowset($q_forums);
	}

	//
	// Okay, let's build the index
	//
	$gen_cat = array();

	for($i = 0; $i < $total_categories; $i++)
	{
		$cat_id = $category_rows[$i]['cat_id'];

		$template->assign_block_vars("catrow", array( 
			'S_ADD_FORUM_SUBMIT' => "addforum[$cat_id]", 
			'S_ADD_FORUM_NAME' => "forumname[$cat_id]", 

			'CAT_ID' => $cat_id,
			'CAT_DESC' => $category_rows[$i]['cat_title'],

			'U_CAT_EDIT' => append_sid("admin_forums.$phpEx?mode=editcat&amp;" . POST_CAT_URL . "=$cat_id"),
			'U_CAT_DELETE' => append_sid("admin_forums.$phpEx?mode=deletecat&amp;" . POST_CAT_URL . "=$cat_id"),
			'U_CAT_MOVE_UP' => append_sid("admin_forums.$phpEx?mode=cat_order&amp;move=-15&amp;" . POST_CAT_URL . "=$cat_id"),
			'U_CAT_MOVE_DOWN' => append_sid("admin_forums.$phpEx?mode=cat_order&amp;move=15&amp;" . POST_CAT_URL . "=$cat_id"),
			'U_VIEWCAT' => append_sid($phpbb_root_path."index.$phpEx?" . POST_CAT_URL . "=$cat_id"))
		);

		for($j = 0; $j < $total_forums; $j++)
		{
			$forum_id = $forum_rows[$j]['forum_id'];
			
			if ($forum_rows[$j]['cat_id'] == $cat_id)
			{

				$template->assign_block_vars("catrow.forumrow",	array(
					'FORUM_NAME' => $forum_rows[$j]['forum_name'],
					'FORUM_DESC' => $forum_rows[$j]['forum_desc'],
					'ROW_COLOR' => $row_color,
					'NUM_TOPICS' => $forum_rows[$j]['forum_topics'],
					'NUM_POSTS' => $forum_rows[$j]['forum_posts'],

					'U_VIEWFORUM' => append_sid($phpbb_root_path."viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id"),
					'U_FORUM_EDIT' => append_sid("admin_forums.$phpEx?mode=editforum&amp;" . POST_FORUM_URL . "=$forum_id"),
					'U_FORUM_DELETE' => append_sid("admin_forums.$phpEx?mode=deleteforum&amp;" . POST_FORUM_URL . "=$forum_id"),
					'U_FORUM_MOVE_UP' => append_sid("admin_forums.$phpEx?mode=forum_order&amp;move=-15&amp;" . POST_FORUM_URL . "=$forum_id"),
					'U_FORUM_MOVE_DOWN' => append_sid("admin_forums.$phpEx?mode=forum_order&amp;move=15&amp;" . POST_FORUM_URL . "=$forum_id"),
					'U_FORUM_RESYNC' => append_sid("admin_forums.$phpEx?mode=forum_sync&amp;" . POST_FORUM_URL . "=$forum_id"))
				);

			}// if ... forumid == catid
			
		} // for ... forums

	} // for ... categories

}// if ... total_categories
//-- add
*/
function display_admin_index($cur='Root', $level=0, $max_level=-1)
{
	global $template, $phpbb_root_path, $phpEx, $lang, $images;
	global $tree;

	// display the level
	$CH_this = isset($tree['keys'][$cur]) ? $tree['keys'][$cur] : -1;

	// root level
	if ($max_level==-1)
	{
		// get max inc level
		$keys = array();
		$max_level = get_max_depth($cur, true, -1, $keys);
		if ($cur != 'Root') $max_level++;
		$template->assign_vars(array(
			'INC_SPAN'		=> ($max_level+3),
			'INC_SPAN_ALL'	=> ($max_level+7),
			)
		);
	}

	// if forum index, omit one level
	if ($cur == 'Root') $level=-1;

	// sub-levels
	if ($CH_this >= -1)
	{
		// cat header row
		if ($tree['type'][$CH_this] == POST_CAT_URL)
		{
			// display a cat row
			$cat = $tree['data'][$CH_this];
			$cat_id = $tree['id'][$CH_this];

			// get the class colors
			$class_catLeft   = "cat";
			$class_catMiddle = "cat";
			$class_catRight  = "cat";

			$cat_title = $cat['cat_title'];
			$cat_title_trad = get_object_lang(POST_CAT_URL . $cat_id, 'name');
			if ($cat_title != $cat_title_trad) $cat_title = '(' . $cat_title . ') ' . $cat_title_trad;

			// title and icon
			$cat_desc = $cat['cat_desc'];
			$cat_desc_trad = get_object_lang(POST_CAT_URL . $cat_id, 'desc');
			if ($cat_desc != $cat_desc_trad)
			{
				$cat_desc = '(' . $cat_desc . ') ' . $cat_desc_trad;
			}
			$cat_icon = empty($cat['icon']) ? '' : '<img src="' . ( isset($images[ $cat['icon'] ]) ? $phpbb_root_path . $images[ $cat['icon'] ] : $cat['icon'] ) . '" border="0" alt="' . $cat['icon'] . '" title="' . $cat['icon'] . '" />';

			// send to template
			$template->assign_block_vars('catrow', array());
			$template->assign_block_vars('catrow.cathead', array(
				'CAT_ID'			=> $cat_id,
				'CAT_TITLE'			=> $cat_title,
				'CAT_DESCRIPTION'	=> $cat_desc,
				'ICON_IMG'			=> $cat_icon,

				'CLASS_CATLEFT'		=> $class_catLeft,
				'CLASS_CATMIDDLE'	=> $class_catMiddle,
				'CLASS_CATRIGHT'	=> $class_catRight,
				'INC_SPAN'			=> $max_level - $level+3,
				'WIDTH'				=> ($max_level == $level) ? 'width="50%"' : '',

				'U_CAT_EDIT'		=> append_sid("admin_forums.$phpEx?mode=editcat&amp;" . POST_CAT_URL . "=$cat_id"),
				'U_CAT_DELETE'		=> append_sid("admin_forums.$phpEx?mode=deletecat&amp;" . POST_CAT_URL . "=$cat_id"),
				'U_CAT_MOVE_UP'		=> append_sid("admin_forums.$phpEx?mode=cat_order&amp;move=-15&amp;" . POST_CAT_URL . "=$cat_id"),
				'U_CAT_MOVE_DOWN'	=> append_sid("admin_forums.$phpEx?mode=cat_order&amp;move=15&amp;" . POST_CAT_URL . "=$cat_id"),
				'U_VIEWCAT'			=> append_sid("admin_forums.$phpEx?" . POST_CAT_URL . "=$cat_id"))
			);
			// add indentation to the display
			for ($k=1; $k <= $level; $k++)
			{
				$template->assign_block_vars('catrow.cathead.inc', array());
			}
		}

		// forum header row
		if ($tree['type'][$CH_this] == POST_FORUM_URL)
		{
			$forum = $tree['data'][$CH_this];
			$forum_id = $tree['id'][$CH_this];
			$forum_link_img = '';
			if (!empty($tree['data'][$CH_this]['forum_link']))
			{
				$forum_link_img = '<img src="' . $phpbb_root_path . $images['link'] . '" border="0" />';
			}
			else
			{
				$sub = (isset($tree['sub'][POST_FORUM_URL . $forum_id]));
				$forum_link_img = '<img src="' . $phpbb_root_path . (($sub) ? $images['category'] : $images['forum']) . '" border="0" />';
				if ($tree['data'][$CH_this]['forum_status'] == FORUM_LOCKED)
				{
					$forum_link_img = '<img src="' . $phpbb_root_path . (($sub) ? $images['category_locked'] : $images['forum_locked']) . '" border="0" />';
				}
			}

			$forum_name = $forum['forum_name'];
			$forum_name_trad = get_object_lang(POST_FORUM_URL . $forum_id, 'name');
			if ($forum_name != $forum_name_trad) $forum_name = '(' . $forum_name . ') ' . $forum_name_trad;

			$forum_desc = $forum['forum_desc'];
			$forum_desc_trad = get_object_lang(POST_FORUM_URL . $forum_id, 'desc');
			if ($forum_desc != $forum_desc_trad) $forum_desc = '(' . $forum_desc . ') ' . $forum_desc_trad;
			$template->assign_block_vars('catrow', array());
			$template->assign_block_vars('catrow.forumrow', array(
				'LINK_IMG'			=> $forum_link_img,
				'ICON_IMG'			=> empty($forum['icon']) ? '' : '<img src="' . ( isset($images[ $forum['icon'] ]) ? $phpbb_root_path . $images[ $forum['icon'] ] : $forum['icon'] ) . '" border="0" alt="' . $forum['icon'] . '" title="' . $forum['icon'] . '" />',
				'FORUM_NAME'		=> $forum_name,
				'FORUM_DESC'		=> $forum_desc,
				'NUM_TOPICS'		=> $forum['forum_topics'],
				'NUM_POSTS'			=> $forum['forum_posts'],

				'INC_SPAN'			=> $max_level - $level+1,
				'WIDTH'				=> ($max_level == $level) ? 'width="50%"' : '',

				'U_VIEWFORUM'		=> append_sid("admin_forums.$phpEx?" . POST_FORUM_URL . "=$forum_id"),
				'U_FORUM_EDIT'		=> append_sid("admin_forums.$phpEx?mode=editforum&amp;" . POST_FORUM_URL . "=$forum_id"),
				'U_FORUM_DELETE'	=> append_sid("admin_forums.$phpEx?mode=deleteforum&amp;" . POST_FORUM_URL . "=$forum_id"),
				'U_FORUM_MOVE_UP'	=> append_sid("admin_forums.$phpEx?mode=forum_order&amp;move=-15&amp;" . POST_FORUM_URL . "=$forum_id"),
				'U_FORUM_MOVE_DOWN'	=> append_sid("admin_forums.$phpEx?mode=forum_order&amp;move=15&amp;" . POST_FORUM_URL . "=$forum_id"),
				'U_FORUM_RESYNC'	=> append_sid("admin_forums.$phpEx?mode=forum_sync&amp;" . POST_FORUM_URL . "=$forum_id"))
			);
			// add indentation to the display
			for ($k=1; $k <= $level; $k++) $template->assign_block_vars('catrow.forumrow.inc', array());
		}

		// display the sub-level
		for ($i=0; $i < count($tree['sub'][$cur]); $i++)
		{
			display_admin_index($tree['sub'][$cur][$i], $level+1, $max_level);
		}

		// forum footer

		// cat footer
		if ($tree['type'][$CH_this] == POST_CAT_URL)
		{
			// add the footer
			$template->assign_block_vars('catrow', array());
			$template->assign_block_vars('catrow.catfoot', array(
				'S_ADD_FORUM_SUBMIT'	=> "addforum[$cat_id]",
				'S_ADD_CAT_SUBMIT'		=> "addcategory[$cat_id]",
				'S_ADD_NAME'			=> "name[$cat_id]",
				'INC_SPAN'				=> $max_level - $level+3,
				'INC_SPAN_ALL'			=> $max_level - $level+7,
				)
			);
			// add indentation to the display
			for ($k=1; $k <= $level; $k++) $template->assign_block_vars('catrow.catfoot.inc', array());
		}

		// board index footer
		if ($cur == 'Root')
		{
			$template->assign_block_vars('switch_board_footer', array());
			if (defined('SUB_FORUM_ATTACH'))
			{
				$template->assign_block_vars('switch_board_footer.sub_forum_attach', array());
			}
		}
	}
}

// fix the cat_main value
admin_check_cat();

// read the cats/forums tree
get_user_tree($userdata);

// get the values of level selected
$main = 'Root';
if (!empty($cat_id))
{
	$main = POST_CAT_URL . $cat_id;
}
else if (!empty($forum_id))
{
	$main = $tree['main'][$forum_id];
	$main = $tree['main'][ $tree['keys'][POST_FORUM_URL . $forum_id] ];
}
if (!isset($tree['keys'][$main])) $main = 'Root';

// get the nav cat sentence
$nav_cat_desc = make_cat_nav_tree($main, 'admin_forums');
if ($nav_cat_desc != '') $nav_cat_desc = $nav_separator . $nav_cat_desc;
$template->assign_vars(array(
	'SPACER'			=> $phpbb_root_path . $images['spacer'],
	'NAV_CAT_DESC'		=> $nav_cat_desc,
	'L_INDEX'			=> sprintf($lang['Forum_Index'], $board_config['sitename']),
	)
);

// display the tree
display_admin_index($main);
//-- fin mod : categories hierarchy ----------------------------------------------------------------

$template->pparse("body");

include('./page_footer_admin.'.$phpEx);

?>

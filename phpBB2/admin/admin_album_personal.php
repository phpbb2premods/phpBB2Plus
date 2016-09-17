<?php
/***************************************************************************
 *                            admin_album_personal.php
 *                             -------------------
 *   begin                : Sunday, February 02, 2003
 *   copyright            : (C) 2003 Smartor
 *   email                : smartor_xp@hotmail.com
 *
 *   $Id: admin_album_personal.php,v 1.0.2 2003/03/05, 19:44:38 ngoctu Exp $
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

if( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$module['Photo_Album']['Personal_Galleries'] = $filename;
	return;
}

//
// Let's set the root dir for phpBB
//
$phpbb_root_path = '../';
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);
require($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_main_album.' . $phpEx);
require($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_admin_album.' . $phpEx);

if( !isset($_POST['submit']) )
{
	$template->set_filenames(array(
		'body' => 'admin/album_personal_body.tpl')
	);

	// Get the list of phpBB usergroups
	$sql = "SELECT group_id, group_name
			FROM " . GROUPS_TABLE . "
			WHERE group_single_user <> " . TRUE ."
			ORDER BY group_name ASC";
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, "Couldn't get group list", "", __LINE__, __FILE__, $sql);
	}

	while( $row = $db->sql_fetchrow($result) )
	{
		$groupdata[] = $row;
	}

	// Get the current album settings for non created personal galleries
	$sql = "SELECT *
			FROM ". ALBUM_CONFIG_TABLE ."
			WHERE config_name = 'personal_gallery_private'";
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, "Couldn't get Album info", "", __LINE__, __FILE__, $sql);
	}
	$row = $db->sql_fetchrow($result);
	$private_groups = explode(',', $row['config_value']);
	//--- Album Category Hierarchy : begin
	//--- version : 1.1.0beta6
	// Since all personal galleries have the same private/moderator settings we fetch the first
	// personal gallery and not all.
	$sql = "SELECT cat_id, cat_title, cat_view_groups, cat_upload_groups, cat_rate_groups, cat_comment_groups, cat_edit_groups, cat_delete_groups, cat_moderator_groups
			FROM ". ALBUM_CAT_TABLE ."
			WHERE cat_parent = 0 and cat_user_id != 0
			LIMIT 1";

	if( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Could not get Category information', '', __LINE__, __FILE__, $sql);
	}

	$thiscat = $db->sql_fetchrow($result);

	$view_groups = @explode(',', $thiscat['cat_view_groups']);
	$upload_groups = @explode(',', $thiscat['cat_upload_groups']);
	$rate_groups = @explode(',', $thiscat['cat_rate_groups']);
	$comment_groups = @explode(',', $thiscat['cat_comment_groups']);
	$edit_groups = @explode(',', $thiscat['cat_edit_groups']);
	$delete_groups = @explode(',', $thiscat['cat_delete_groups']);

	$moderator_groups = @explode(',', $thiscat['cat_moderator_groups']);
	//--- Album Category Hierarchy : end
	
	for($i = 0; $i < count($groupdata); $i++)
	{
		//--- Album Category Hierarchy : begin
		//--- version : 1.1.0beta6
		//--- removed
		//$template->assign_block_vars('grouprow', array(
		//--- added
		$template->assign_block_vars('creation_grouprow', array(
		//--- Album Category Hierarchy : end
			'GROUP_ID' => $groupdata[$i]['group_id'],
			'GROUP_NAME' => $groupdata[$i]['group_name'],
			'PRIVATE_CHECKED' => (in_array($groupdata[$i]['group_id'], $private_groups)) ? 'checked="checked"' : ''
			) //end array
		);
		//--- Album Category Hierarchy : begin
		//--- version : 1.1.0beta6
		$template->assign_block_vars('grouprow', array(
			'GROUP_ID' => $groupdata[$i]['group_id'],
			'GROUP_NAME' => $groupdata[$i]['group_name'],

			'VIEW_CHECKED' => (in_array($groupdata[$i]['group_id'], $view_groups)) ? 'checked="checked"' : '',

			'UPLOAD_CHECKED' => (in_array($groupdata[$i]['group_id'], $upload_groups)) ? 'checked="checked"' : '',

			'RATE_CHECKED' => (in_array($groupdata[$i]['group_id'], $rate_groups)) ? 'checked="checked"' : '',

			'COMMENT_CHECKED' => (in_array($groupdata[$i]['group_id'], $comment_groups)) ? 'checked="checked"' : '',

			'EDIT_CHECKED' => (in_array($groupdata[$i]['group_id'], $edit_groups)) ? 'checked="checked"' : '',

			'DELETE_CHECKED' => (in_array($groupdata[$i]['group_id'], $delete_groups)) ? 'checked="checked"' : '',

			'MODERATOR_CHECKED' => (in_array($groupdata[$i]['group_id'], $moderator_groups)) ? 'checked="checked"' : '')
		);
		//--- Album Category Hierarchy : end
	}

	$template->assign_vars(array(
		'L_ALBUM_PERSONAL_TITLE' => $lang['Album_personal_gallery_title'],
		'L_ALBUM_PERSONAL_EXPLAIN' => $lang['Album_personal_gallery_explain'],
		//--- Album Category Hierarchy : begin
		//--- version : 1.1.0beta6
		'L_ALBUM_AUTH_EXPLAIN' => $lang['Album_Personal_Auth_Explain'],		
		//--- Album Category Hierarchy : end
		'L_SUBMIT' => $lang['Submit'],
		'L_RESET' => $lang['Reset'],
		'L_GROUP_CONTROL' => $lang['Auth_Control_Group'],
		'L_GROUPS' => $lang['Usergroups'],
		//--- Album Category Hierarchy : begin
		//--- version : 1.1.0beta6
		'L_VIEW' => $lang['View'],
		'L_UPLOAD' => $lang['Upload'],
		'L_RATE' => $lang['Rate'],
		'L_COMMENT' => $lang['Comment'],
		'L_EDIT' => $lang['Edit'],
		'L_DELETE' => $lang['Delete'],

		'L_IS_MODERATOR' => $lang['Is_Moderator'],
		//--- Album Category Hierarchy : end
		'L_PRIVATE_ACCESS' => $lang['Private_access'],
		'S_ALBUM_ACTION' => append_sid('admin_album_personal.'.$phpEx)
		)
	);

	$template->pparse('body');

	include('./page_footer_admin.'.$phpEx);
}
else
{
	// Now we update the datatabase
	$private_groups = @implode(',', $_POST['private']);
	//--- Album Category Hierarchy : begin
	//--- version : 1.1.0beta6
	$view_groups = @implode(',', $_POST['view']);
	$upload_groups = @implode(',', $_POST['upload']);
	$rate_groups = @implode(',', $_POST['rate']);
	$comment_groups = @implode(',', $_POST['comment']);
	$edit_groups = @implode(',', $_POST['edit']);
	$delete_groups = @implode(',', $_POST['delete']);

	$moderator_groups = @implode(',', $_POST['moderator']);
	//--- Album Category Hierarchy : end
	
    // album config for non created personal galleries

	$sql = "UPDATE ". ALBUM_CONFIG_TABLE ."
			SET config_value = '$private_groups'
			WHERE config_name = 'personal_gallery_private'";
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not update Album config table', '', __LINE__, __FILE__, $sql);
	}
	//--- Album Category Hierarchy : begin
	//--- version : 1.1.0beta6
	$sql = "UPDATE ". ALBUM_CAT_TABLE ."
		SET cat_view_groups = '$view_groups', cat_upload_groups = '$upload_groups', cat_rate_groups = '$rate_groups', cat_comment_groups = '$comment_groups', cat_edit_groups = '$edit_groups', cat_delete_groups = '$delete_groups',	cat_moderator_groups = '$moderator_groups'
		WHERE cat_user_id != 0";

	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not update personal gallery group information table', '', __LINE__, __FILE__, $sql);
	}
	//--- Album Category Hierarchy : end
	// okay, return a message... 
	$message = $lang['Album_personal_successfully'] . '<br /><br />' . sprintf($lang['Click_return_album_personal'], '<a href="' . append_sid("admin_album_personal.$phpEx") . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . append_sid("index.$phpEx?pane=right") . '">', '</a>');

	message_die(GENERAL_MESSAGE, $message);
}

/* Powered by Photo Album v2.x.x (c) 2002-2003 Smartor */

?>
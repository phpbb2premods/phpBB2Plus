<?php
/***************************************************************************
 *                              admin_acronyms.php
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
	$module['General']['Acronyms'] = $file;
	return;
}

//
// Load default header
//
$phpbb_root_path = "./../";
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);

if( isset($_GET['mode']) || isset($_POST['mode']) )
{
	$mode = ($_GET['mode']) ? $_GET['mode'] : $_POST['mode'];
}
else 
{
	//
	// These could be entered via a form button
	//
	if( isset($_POST['add']) )
	{
		$mode = "add";
	}
	else if( isset($_POST['save']) )
	{
		$mode = "save";
	}
	else
	{
		$mode = "";
	}
}

if( $mode != "" )
{
	if( $mode == "edit" || $mode == "add" )
	{
		$acronym_id = ( isset($_GET['id']) ) ? intval($_GET['id']) : 0;

		$template->set_filenames(array(
			"body" => "admin/acronyms_edit_body.tpl")
		);

		$s_hidden_fields = '';

		if( $mode == "edit" )
		{
			if( $acronym_id )
			{
				$sql = 'SELECT * 
					FROM ' . ACRONYMS_TABLE . "
					WHERE acronym_id = $acronym_id";
					
				if(!$result = $db->sql_query($sql))
				{
					message_die(GENERAL_ERROR, "Could not query acronym table", "Error", __LINE__, __FILE__, $sql);
				}

				$acronym_info = $db->sql_fetchrow($result);
				$s_hidden_fields .= '<input type="hidden" name="id" value="' . $acronym_id . '" />';
			}
			else
			{
				message_die(GENERAL_MESSAGE, $lang['No_acronym_selected']);
			}
		}

		$template->assign_vars(array(
			'ACRONYM' => $acronym_info['acronym'],
			'DESCRIPTION' => $acronym_info['description'],

			'L_ACRONYMS_TITLE' => $lang['Acronyms_title'],
			'L_ACRONYMS_TEXT' => $lang['Acronyms_explain'],
			'L_ACRONYM_EDIT' => $lang['Edit_acronym'],
			'L_ACRONYM' => $lang['Acronym'],
			'L_DESCRIPTION' => $lang['Description'],
			'L_SUBMIT' => $lang['Submit'],

			'S_ACRONYMS_ACTION' => append_sid("admin_acronyms.$phpEx"),
			'S_HIDDEN_FIELDS' => $s_hidden_fields)
		);

		$template->pparse("body");

		include('./page_footer_admin.'.$phpEx);
	}
	else if( $mode == "save" )
	{
		$acronym_id = ( isset($_POST['id']) ) ? intval($_POST['id']) : 0;
		$acronym = ( isset($_POST['acronym']) ) ? trim($_POST['acronym']) : "";
		$description = ( isset($_POST['description']) ) ? trim($_POST['description']) : "";

		if($acronym == "" || $description == "")
		{
			message_die(GENERAL_MESSAGE, $lang['Must_enter_acronym']);
		}

		if( $acronym_id )
		{
			$sql = "UPDATE " . ACRONYMS_TABLE . "
				SET acronym = '" . str_replace("\'", "''", htmlspecialchars($acronym) ) . "', description = '" . str_replace("\'", "''", htmlspecialchars($description)) . "'
				WHERE acronym_id = $acronym_id";
			$message = $lang['Acronym_updated'];
		}
		else
		{
			$sql = 'SELECT acronym FROM ' . ACRONYMS_TABLE . " WHERE acronym = '" . str_replace("\'", "''", htmlspecialchars($acronym) ) . "'";
			
			if(!$result = $db->sql_query($sql))
			{
				message_die(GENERAL_ERROR, "Could not insert data into words table", $lang['Error'], __LINE__, __FILE__, $sql);
			}
			
			if( $db->sql_fetchrow( $result ) )
			{
				$message = 'Acronym already in Database.';
				$message .= "<br /><br />" . sprintf($lang['Click_return_acronymadmin'], "<a href=\"" . append_sid("admin_acronyms.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");
				
				$db->sql_freeresult( $result );
				
				message_die(GENERAL_MESSAGE, $message );
			}
			
			$db->sql_freeresult( $result );
			
			$sql = "INSERT INTO " . ACRONYMS_TABLE . " (acronym, description)
				VALUES ('" . str_replace("\'", "''", htmlspecialchars($acronym)) . "', '" . str_replace("\'", "''", htmlspecialchars($description)) . "')";
			
			$message = $lang['Acronym_added'];
		}

		if(!$result = $db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, "Could not insert data into words table", $lang['Error'], __LINE__, __FILE__, $sql);
		}

		$message .= "<br /><br />" . sprintf($lang['Click_return_acronymadmin'], "<a href=\"" . append_sid("admin_acronyms.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");

		message_die(GENERAL_MESSAGE, $message);
	}
	else if( $mode == "delete" )
	{
		if( isset($_POST['id']) ||  isset($_GET['id']) )
		{
			$acronym_id = ( isset($_POST['id']) ) ? intval($_POST['id']) : intval($_GET['id']);
		}
		else
		{
			$acronym_id = 0;
		}

		if( $acronym_id )
		{
			$sql = "DELETE FROM " . ACRONYMS_TABLE . "
				WHERE acronym_id = $acronym_id";

			if(!$result = $db->sql_query($sql))
			{
				message_die(GENERAL_ERROR, "Could not remove data from words table", $lang['Error'], __LINE__, __FILE__, $sql);
			}

			$message = $lang['Acronym_removed'] . "<br /><br />" . sprintf($lang['Click_return_acronymadmin'], "<a href=\"" . append_sid("admin_acronyms.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");

			message_die(GENERAL_MESSAGE, $message);
		}
		else
		{
			message_die(GENERAL_MESSAGE, $lang['No_acronym_selected']);
		}
	}
}
else
{
	$template->set_filenames(array(
		"body" => "admin/acronyms_list_body.tpl")
	);

	$sql = "SELECT *
		FROM " . ACRONYMS_TABLE . "
		ORDER BY acronym";
	if( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, "Could not query words table", $lang['Error'], __LINE__, __FILE__, $sql);
	}

	$word_rows = $db->sql_fetchrowset($result);
	$word_count = count($word_rows);

	$template->assign_vars(array(
		'L_ACRONYMS_TITLE' => $lang['Acronyms_title'],
		'L_ACRONYMS_TEXT' => $lang['Acronyms_explain'],
		'L_ACRONYM' => $lang['Acronym'],
		'L_DESCRIPTION' => $lang['Description'],
		'L_EDIT' => $lang['Edit'],
		'L_DELETE' => $lang['Delete'],
		'L_ADD_ACRONYM' => $lang['Add_new_acronym'],
		'L_ACTION' => $lang['Action'],

		'S_ACRONYM_ACTION' => append_sid("admin_acronyms.$phpEx"),
		'S_HIDDEN_FIELDS' => '')
	);

	for($i = 0; $i < $word_count; $i++)
	{
		$acronym = $word_rows[$i]['acronym'];
		$description = $word_rows[$i]['description'];
		$acronym_id = $word_rows[$i]['acronym_id'];

		$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
		$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

		$template->assign_block_vars('acronyms', array(
			'ROW_COLOR' => "#" . $row_color,
			'ROW_CLASS' => $row_class,
			'ACRONYM' => $acronym,
			'DESCRIPTION' => $description,

			'U_ACRONYM_EDIT' => append_sid("admin_acronyms.$phpEx?mode=edit&amp;id=$acronym_id"),
			'U_ACRONYM_DELETE' => append_sid("admin_acronyms.$phpEx?mode=delete&amp;id=$acronym_id"))
		);
	}
}

$template->pparse("body");

include('./page_footer_admin.'.$phpEx);

?>

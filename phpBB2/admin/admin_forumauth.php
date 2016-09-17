<?php
/***************************************************************************
 *                            admin_forumauth.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: admin_forumauth.php,v 1.23.2.5 2004/03/25 15:57:19 acydburn Exp $
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

define('IN_PHPBB', 1);

if( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$module['Forums']['Permissions']   = $filename;

	return;
}

//
// Load default header
//
$no_page_header = TRUE;
$phpbb_root_path = './../';
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);

//
// Start program - define vars
//
//                //-- mod : categories hierarchy --------------------------------------------------------------------
//-- delete
// all the preset and auth fields definition has been moved to includes/def_auth.php
//-- add
// auth list : put in this file all the auth fields description
include( $phpbb_root_path . './includes/def_auth.' . $phpEx );

// build an indexed array on field names
@reset($field_names);
$forum_auth_fields = array();
while ( list($auth_key, $auth_name) = @each($field_names) )
{
	$forum_auth_fields[] = $auth_key;
}
//-- fin mod : categories hierarchy ----------------------------------------------------------------


if(isset($_GET[POST_FORUM_URL]) || isset($_POST[POST_FORUM_URL]))
{
	//-- mod : categories hierarchy --------------------------------------------------------------------
//-- delete
//	$forum_id = (isset($_POST[POST_FORUM_URL])) ? intval($_POST[POST_FORUM_URL]) : intval($_GET[POST_FORUM_URL]);
//	$forum_sql = "AND forum_id = $forum_id";
//-- add
	$fid = (isset($_POST[POST_FORUM_URL])) ? $_POST[POST_FORUM_URL] : $_GET[POST_FORUM_URL];
	$f_type = substr($fid, 0, 1);
	if ($f_type == POST_FORUM_URL)
	{
		$forum_id = intval(substr($fid, 1));
		$forum_sql = " WHERE forum_id = $forum_id";
	}
	else
	{
		unset($forum_id);
		$forum_sql = '';
	}
//-- fin mod : categories hierarchy ----------------------------------------------------------------

}
else
{
	unset($forum_id);
	$forum_sql = '';
}

if( isset($_GET['adv']) )
{
	$adv = intval($_GET['adv']);
}
else
{
	unset($adv);
}

//
// Start program proper
//
if( isset($_POST['submit']) )
{
	$sql = '';

	if(!empty($forum_id))
	{
		if(isset($_POST['simpleauth']))
		{
			$simple_ary = $simple_auth_ary[intval($_POST['simpleauth'])];

			for($i = 0; $i < count($simple_ary); $i++)
			{
				$sql .= ( ( $sql != '' ) ? ', ' : '' ) . $forum_auth_fields[$i] . ' = ' . $simple_ary[$i];
			}

			if (is_array($simple_ary))
			{
				$sql = "UPDATE " . FORUMS_TABLE . " SET $sql WHERE forum_id = $forum_id";
			}
		}
		else
		{
			for($i = 0; $i < count($forum_auth_fields); $i++)
			{
				$value = intval($_POST[$forum_auth_fields[$i]]);

				if ( $forum_auth_fields[$i] == 'auth_vote' )
				{
					if ( $_POST['auth_vote'] == AUTH_ALL )
					{
						$value = AUTH_REG;
					}
				}

				$sql .= ( ( $sql != '' ) ? ', ' : '' ) .$forum_auth_fields[$i] . ' = ' . $value;
			}

			$sql = "UPDATE " . FORUMS_TABLE . " SET $sql WHERE forum_id = $forum_id";
		}

		if ( $sql != '' )
		{
			if ( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not update auth table', '', __LINE__, __FILE__, $sql);
			}
		}

		$forum_sql = '';
		$adv = 0;
	}
	//-- mod : categories hierarchy --------------------------------------------------------------------
//-- add
	cache_tree(true);

	$files = glob($phpbb_root_path."cache/cal_cache_*.php"); 
	if ($files)
    {
      foreach ( $files as $filename)
      {
        @unlink ($filename);
      }
    }

//-- fin mod : categories hierarchy ----------------------------------------------------------------

	$template->assign_vars(array(
		'META' => '<meta http-equiv="refresh" content="3;url=' . append_sid("admin_forumauth.$phpEx?" . POST_FORUM_URL . "=$forum_id") . '">')
	);
	$message = $lang['Forum_auth_updated'] . '<br /><br />' . sprintf($lang['Click_return_forumauth'],  '<a href="' . append_sid("admin_forumauth.$phpEx") . '">', "</a>");
	message_die(GENERAL_MESSAGE, $message);

} // End of submit

//
// Get required information, either all forums if
// no id was specified or just the requsted if it
// was
//
//-- mod : categories hierarchy --------------------------------------------------------------------
//-- delete
// $sql = "SELECT f.*
//	FROM " . FORUMS_TABLE . " f, " . CATEGORIES_TABLE . " c
//	WHERE c.cat_id = f.cat_id
//	$forum_sql
//	ORDER BY c.cat_order ASC, f.forum_order ASC";
// if ( !($result = $db->sql_query($sql)) )
// {
//	message_die(GENERAL_ERROR, "Couldn't obtain forum list", "", __LINE__, __FILE__, $sql);
// }
//
// $forum_rows = $db->sql_fetchrowset($result);
// $db->sql_freeresult($result);
//-- fin mod : categories hierarchy ----------------------------------------------------------------


if( empty($forum_id) )
{
	//
	// Output the selection table if no forum id was
	// specified
	//
	$template->set_filenames(array(
		'body' => 'admin/auth_select_body.tpl')
	);

	//-- mod : categories hierarchy --------------------------------------------------------------------
//-- delete
//	$select_list = '<select name="' . POST_FORUM_URL . '">';
//	for($i = 0; $i < count($forum_rows); $i++)
//	{
//		$select_list .= '<option value="' . $forum_rows[$i]['forum_id'] . '">' . $forum_rows[$i]['forum_name'] . '</option>';
//	}
//	$select_list .= '</select>';
//-- add
	$select_list = selectbox(POST_FORUM_URL, false, '', true);
//-- fin mod : categories hierarchy ----------------------------------------------------------------


	$template->assign_vars(array(
		'L_AUTH_TITLE' => $lang['Auth_Control_Forum'],
		'L_AUTH_EXPLAIN' => $lang['Forum_auth_explain'],
		'L_AUTH_SELECT' => $lang['Select_a_Forum'],
		'L_LOOK_UP' => $lang['Look_up_Forum'],

		'S_AUTH_ACTION' => append_sid("admin_forumauth.$phpEx"),
		'S_AUTH_SELECT' => $select_list)
	);

}
else
{
	//
	// Output the authorisation details if an id was
	// specified
	//
	$template->set_filenames(array(
		'body' => 'admin/auth_forum_body.tpl')
	);

	//-- mod : categories hierarchy --------------------------------------------------------------------
//-- delete
//	$forum_name = $forum_rows[0]['forum_name'];
//-- add
	$forum_rows[0] = $tree['data'][$tree['keys'][POST_FORUM_URL . $forum_id]];
	$forum_name_trad = get_object_lang(POST_FORUM_URL . $forum_id, 'name');
	$forum_name = $forum_rows[0]['forum_name'];
	if ($forum_name != $forum_name_trad)
	{
		$forum_name = '(' . $forum_name . ') ' . $forum_name_trad;
	}
//-- fin mod : categories hierarchy ----------------------------------------------------------------


	@reset($simple_auth_ary);
	while( list($key, $auth_levels) = each($simple_auth_ary))
	{
		$matched = 1;
		for($k = 0; $k < count($auth_levels); $k++)
		{
			$matched_type = $key;

			if ( $forum_rows[0][$forum_auth_fields[$k]] != $auth_levels[$k] )
			{
				$matched = 0;
			}
		}

		if ( $matched )
		{
			break;
		}
	}

	//
	// If we didn't get a match above then we
	// automatically switch into 'advanced' mode
	//
	if ( !isset($adv) && !$matched )
	{
		$adv = 1;
	}

	$s_column_span == 0;

	if ( empty($adv) )
	{
		$simple_auth = '<select name="simpleauth">';

		for($j = 0; $j < count($simple_auth_types); $j++)
		{
			$selected = ( $matched_type == $j ) ? ' selected="selected"' : '';
			$simple_auth .= '<option value="' . $j . '"' . $selected . '>' . $simple_auth_types[$j] . '</option>';
		}

		$simple_auth .= '</select>';

		$template->assign_block_vars('forum_auth_titles', array(
			'CELL_TITLE' => $lang['Simple_mode'])
		);
		$template->assign_block_vars('forum_auth_data', array(
			'S_AUTH_LEVELS_SELECT' => $simple_auth)
		);

		$s_column_span++;
	}
	else
	{
		//
		// Output values of individual
		// fields
		//
		for($j = 0; $j < count($forum_auth_fields); $j++)
		{
			$custom_auth[$j] = '&nbsp;<select name="' . $forum_auth_fields[$j] . '">';

			for($k = 0; $k < count($forum_auth_levels); $k++)
			{
				$selected = ( $forum_rows[0][$forum_auth_fields[$j]] == $forum_auth_const[$k] ) ? ' selected="selected"' : '';
				$custom_auth[$j] .= '<option value="' . $forum_auth_const[$k] . '"' . $selected . '>' . $lang['Forum_' . $forum_auth_levels[$k]] . '</option>';
			}
			$custom_auth[$j] .= '</select>&nbsp;';

			$cell_title = $field_names[$forum_auth_fields[$j]];

			$template->assign_block_vars('forum_auth_titles', array(
				'CELL_TITLE' => $cell_title)
			);
			$template->assign_block_vars('forum_auth_data', array(
				'S_AUTH_LEVELS_SELECT' => $custom_auth[$j])
			);

			$s_column_span++;
		}
	}

	$adv_mode = ( empty($adv) ) ? '1' : '0';
	//-- mod : categories hierarchy --------------------------------------------------------------------
//-- delete
//	$switch_mode = append_sid("admin_forumauth.$phpEx?" . POST_FORUM_URL . "=" . $forum_id . "&adv=". $adv_mode);
//-- add
	$switch_mode = append_sid("admin_forumauth.$phpEx?" . POST_FORUM_URL . "=f" . $forum_id . "&adv=". $adv_mode);
//-- fin mod : categories hierarchy ----------------------------------------------------------------

	$switch_mode_text = ( empty($adv) ) ? $lang['Advanced_mode'] : $lang['Simple_mode'];
	$u_switch_mode = '<a href="' . $switch_mode . '">' . $switch_mode_text . '</a>';

	//-- mod : categories hierarchy --------------------------------------------------------------------
//-- delete
//	$s_hidden_fields = '<input type="hidden" name="' . POST_FORUM_URL . '" value="' . $forum_id . '">';
//-- add
	$s_hidden_fields = '<input type="hidden" name="' . POST_FORUM_URL . '" value="f' . $forum_id . '">';
//-- fin mod : categories hierarchy ----------------------------------------------------------------


	$template->assign_vars(array(
		'FORUM_NAME' => $forum_name,

		'L_FORUM' => $lang['Forum'], 
		'L_AUTH_TITLE' => $lang['Auth_Control_Forum'],
		'L_AUTH_EXPLAIN' => $lang['Forum_auth_explain'],
		'L_SUBMIT' => $lang['Submit'],
		'L_RESET' => $lang['Reset'],

		'U_SWITCH_MODE' => $u_switch_mode,

		'S_FORUMAUTH_ACTION' => append_sid("admin_forumauth.$phpEx"),
		'S_COLUMN_SPAN' => $s_column_span,
		'S_HIDDEN_FIELDS' => $s_hidden_fields)
	);

}

include('./page_header_admin.'.$phpEx);

$template->pparse('body');

include('./page_footer_admin.'.$phpEx);

?>
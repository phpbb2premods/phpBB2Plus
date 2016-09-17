<?php
/***************************************************************************
 *                                 kb.php
 *                            -------------------
 *   begin                : Sunday, Mar 31, 2003
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : jonohlsson@hotmail.com
 *   description          : This kb module is based on wGEric's phpbb mod and 
 *                          adapted for mx. It has been greatly improved and bugfixed
 *                          and is currently developed independent of original code...
 *
 *   $Id: kb.php,v 1.8 2004/05/30 20:47:20 jonohlsson Exp $
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
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);

define('PAGE_KB', -500);

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_KB);
init_userprefs($userdata);
//
// End session management
//

include($phpbb_root_path . 'includes/functions_post.'.$phpEx);
include($phpbb_root_path. 'includes/kb_constants.'.$phpEx);
include($phpbb_root_path . 'includes/functions_kb.'.$phpEx);
include_once($phpbb_root_path . 'includes/bbcode.'.$phpEx);
include_once($phpbb_root_path . 'includes/functions_search.'.$phpEx);

$show_new = true;

//options
if ( !$board_config['allow_html'] )
{
   $html_on = 0;
}
else
{
 	$html_on = ( $submit || $refresh ) ? ( ( !empty($_POST['disable_html']) ) ? 0 : TRUE ) : ( ( $userdata['user_id'] == ANONYMOUS ) ? $board_config['allow_html'] : $userdata['user_allowhtml'] );
}
if ( !$board_config['allow_bbcode'] )
{
   $bbcode_on = 0;
}
else
{
 	$bbcode_on = ( $submit || $refresh ) ? ( ( !empty($_POST['disable_bbcode']) ) ? 0 : TRUE ) : ( ( $userdata['user_id'] == ANONYMOUS ) ? $board_config['allow_bbcode'] : $userdata['user_allowbbcode'] );
}
if ( !$board_config['allow_smilies'] )
{
   $smilies_on = 0;
}
else
{
 	$smilies_on = ( $submit || $refresh ) ? ( ( !empty($_POST['disable_smilies']) ) ? 0 : TRUE ) : ( ( $userdata['user_id'] == ANONYMOUS ) ? $board_config['allow_smilies'] : $userdata['user_allowsmile'] );
}

//
//page number
//
if ( isset($_POST['page_num']) || isset($_GET['page_num']) )
{
	$page_num = ( isset($_POST['page_num']) ) ? intval($_POST['page_num']) : intval($_GET['page_num']);
	$page_num = $page_num - 1;
}
else
{
    $page_num = 0;
}

// Print version
if ( isset($_POST['print']) || isset($_GET['print']) )
{
	$print_version = ( isset($_POST['print']) ) ? $_POST['print'] : $_GET['print'];
}
else
{
    $print_version = '';
}

//
// Pull all config data
//
$sql = "SELECT *
	FROM " . KB_CONFIG_TABLE;
if(!$result = $db->sql_query($sql))
{
	message_die(CRITICAL_ERROR, "Could not query config information in kb_config", "", __LINE__, __FILE__, $sql);
}
else
{
	while( $row = $db->sql_fetchrow($result) )
	{
		$config_name = $row['config_name'];
		$config_value = $row['config_value'];
		$kb_config[$config_name] = $config_value;
    }
}

$is_admin = ( ( $userdata['user_level'] == ADMIN || is_group_member($kb_config['mod_group'], $userdata['user_id']) ) && $userdata['session_logged_in'] ) ? TRUE : 0;

// DEBUG
// if (is_group_member($kb_config['mod_group'], $userdata['user_id']))
// {
// 	message_die(GENERAL_ERROR, "you're group moderator...."."mod_group:".$kb_config['mod_group']. ", user_id:".$userdata['user_id'] , '', '', '', '');
// }
// else
// {
// 	message_die(GENERAL_ERROR, "you're not group moderator..."."mod_group:".$kb_config['mod_group'] . ", user_id".$userdata['user_id'] , '', '', '', '');
// }

//
//mode
//
if ( isset($_POST['mode']) || isset($_GET['mode']) )
{
	$mode = ( isset($_POST['mode']) ) ? $_POST['mode'] : $_GET['mode'];
	$mode = htmlspecialchars($mode);
}

if ( isset($_POST['stats']) || isset($_GET['stats']) )
{
	$stats = ( isset($_POST['stats']) ) ? $_POST['stats'] : $_GET['stats'];
	$stats = htmlspecialchars($stats);
}

	if ( $mode == 'article' )
	{
		 include($phpbb_root_path. 'includes/kb_article.'.$phpEx);
	}
	else if ( $mode == 'cat' )
	{
	 	include($phpbb_root_path. 'includes/kb_cat.'.$phpEx);
	}
	else if ( $mode == 'add')
	{
		 include($phpbb_root_path. 'includes/kb_add.'.$phpEx);
	}
	else if ( $mode == 'search' )
	{
		 include($phpbb_root_path. 'includes/kb_search.'.$phpEx);
	}
	else if ( $mode == 'edit' )
	{
		 include($phpbb_root_path. 'includes/kb_edit.'.$phpEx);
	}
	else if ( $mode == 'rate' )
	{
		 include($phpbb_root_path. 'includes/kb_rate.'.$phpEx);
	}
	else if ( $mode == 'stats' )
	{
		 include($phpbb_root_path. 'includes/kb_stats.'.$phpEx);
	}
	else if ( $mode == 'moderate' )
	{
		 include($phpbb_root_path. 'includes/kb_moderator.'.$phpEx);
	}
	else
	{
		// DEFAULT ACTION
		$page_title = $lang['KB_title'];
 		if ( !$is_block )
 		{
			include($phpbb_root_path . 'includes/page_header.'.$phpEx);
		 }	
			make_jumpbox($phpbb_root_path .'viewforum.'.$phpEx,'');

		//load header
		include ($phpbb_root_path ."includes/kb_header.".$phpEx);
	
		$template->set_filenames(array(
			'body' => 'kb_index_body.tpl')
		);
	
		$template->assign_vars(array(
			'L_CATEGORY' => $lang['Category'],
			'L_ARTICLES' => $lang['Articles'])
		);
	
   	 	get_kb_cat_index();		
	}

	$template->pparse('body');

	//load footer
		include ($phpbb_root_path ."includes/kb_footer.".$phpEx);
	
 	if ( !$is_block && !$print_version)
 	{
		include($phpbb_root_path . 'includes/page_tail.'.$phpEx);
 	}
?>
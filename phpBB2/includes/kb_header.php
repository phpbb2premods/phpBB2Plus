<?php
/***************************************************************************
 *                              kb_header.php
 *                            -------------------
 *   begin                : Monday, Mar 31, 2003
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: kb_header.php,v 1.8 2004/05/30 20:49:22 jonohlsson Exp $
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

if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}

define('ALLOW_NEW', 1);
define('ALLOW_ANON', 1);

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

// $dirname = $phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_kb.'.$phpEx;
// include($dirname);

//
// Parse and show the overall header.
//
$template->set_filenames(array(
	'kb_header' => 'kb_header.tpl')
);

if ( ( $kb_config['allow_new'] == ALLOW_NEW && $userdata['session_logged_in'] && $show_new ) || ( $kb_config['allow_new'] == ALLOW_NEW && $kb_config['allow_anon'] == ALLOW_ANON && $show_new ) || $is_admin && $show_new )
{
   if ( $_GET['cat'] )
   {
       $temp_url = append_sid(this_kb_mxurl("mode=add&cat=" . $_GET['cat']));
       $add_article = '<a href="' . $temp_url . '">' . $lang['Add_article'] . '</a>';
   }
   else
   {
       $add_article = $lang['Click_cat_to_add'];
   }
    
   $template->assign_block_vars('switch_add_article', array()); 
}

$temp_url = append_sid($phpbb_root_path . "kb_search.php");
$search = '<a href="' . $temp_url . '">' . $lang['Search'] . '</a>';

if ($kb_config['header_banner'] == 1)
{
	$temp_url = append_sid(this_kb_mxurl());
	$title = '<a href="' . $temp_url . '"><img src="' . $images['kb_title'] . '" width="285" height="45" border="0" alt="' . $lang['KB_title'] . '"></a>';
}
else
{
	$title = $lang['KB_title'];
}

$template->assign_vars(array(
	'U_PORTAL' => append_sid("portal.$phpEx"),
	'L_PORTAL' => "Home",
	'L_KB_TITLE' => $title,
	'L_ADD_ARTICLE' => $add_article,
	'L_SEARCH' => $search,
	'U_TOPRATED' => append_sid(this_kb_mxurl("mode=stats&amp;stats=toprated")),
	'L_TOPRATED' => $lang['Top_toprated'],
	'U_MOST_POPULAR' => append_sid(this_kb_mxurl("mode=stats&amp;stats=mostpopular")),
	'L_MOST_POPULAR' => $lang['Top_most_popular'],
	'U_LATEST' => append_sid(this_kb_mxurl("mode=stats&amp;stats=latest")),
	'L_LATEST' => $lang['Top_latest'],
	'U_KB' => append_sid(this_kb_mxurl()),
	'L_KB' => $lang['KB_title'])
);

if ( $kb_config['stats_list'] == 1 )
{
	get_quick_stats();
}

$template->pparse('kb_header');

?>
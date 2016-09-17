<?php
/***************************************************************************
 *                                 kb_cat.php
 *                            -------------------
 *   begin                : Sunday, Mar 31, 2003
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: kb_stats.php,v 1.1 2004/05/30 20:49:22 jonohlsson Exp $
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

//	$category_id = $_GET['cat'];
//	$category = get_kb_cat($category_id);		
//	$category_name = $category['category_name'];
	
//	$page_title = $category_name;
	    if ( !$is_block )
		 {
		   include($phpbb_root_path . 'includes/page_header.'.$phpEx);
		 }	
//	make_jumpbox($phpbb_root_path .'viewforum.'.$phpEx, $category_id);
	
	//load header
	include ($phpbb_root_path ."includes/kb_header.".$phpEx);
	
	$template->set_filenames(array(
		'body' => 'kb_stats_body.tpl')
	);

//  if ( !$category_name )
//	{
//	    $message = $lang['Category_not_exsist'] . '<br /><br />' . sprintf($lang['Click_return_kb'], '<a href="' . append_sid(this_kb_mxurl()) . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_index'], '<a href="' . append_sid($phpbb_root_path . "index.$phpEx") . '">', '</a>');
//
//      message_die(GENERAL_MESSAGE, $message);
//  }
//  else
//  {

	//get sub-cats
//	get_kb_cat_subs($category_id);

	if ( $stats == 'toprated' )
	{	
		$path_kb = $lang['Top_toprated'];
	}
	elseif ( $stats == 'latest' )
	{
		$path_kb = $lang['Top_latest'];
	}
	elseif ( $stats == 'mostpopular' )
	{
		$path_kb = $lang['Top_most_popular'];
	}
	
//	$path_kb_array = array();
//	get_kb_nav($category_id);
	
	$template->assign_vars(array(
		'L_CATEGORY_NAME' => $category_name,
		'L_ARTICLE' => $lang['Article'],
		'L_CAT' => $lang['Category'],
		'L_ARTICLE_TYPE' => $lang['Article_type'],
		'L_ARTICLE_CATEGORY' => $lang['Category'],
		'L_ARTICLE_DATE' => $lang['Date'],
		'L_ARTICLE_AUTHOR' => $lang['Author'],
		'L_VIEWS' => $lang['Views'],
		'L_VOTES' => $lang['Votes'],
		
		'L_CATEGORY' => $lang['Category_sub'],
		'L_ARTICLES' => $lang['Articles'],
		
		'PATH' => '-> ' . $path_kb,
		
		'U_CAT' => append_sid(this_kb_mxurl('mode=cat&cat=' . $category_id)))
	);
	
	get_kb_stats($stats, '1', 'articlerow');

//	}
	

?>
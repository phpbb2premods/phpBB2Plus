<?php
/***************************************************************************
 *                                 kb_cat.php
 *                            -------------------
 *   begin                : Sunday, Mar 31, 2003
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: kb_cat.php,v 1.5 2004/05/02 08:25:02 jonohlsson Exp $
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
	$start = ( isset($_GET['start']) ) ? intval($_GET['start']) : 0;

	$category_id = ( isset( $HTTP_GET_VARS['cat'] ) ) ? intval ( $HTTP_GET_VARS['cat'])  : intval ( $HTTP_POST_VARS['cat'] );
	$category = get_kb_cat($category_id);		
	$category_name = $category['category_name'];
	
	$page_title = $category_name;
	    if ( !$is_block )
		 {
		   include($phpbb_root_path . 'includes/page_header.'.$phpEx);
		 }	
	make_jumpbox($phpbb_root_path .'viewforum.'.$phpEx, $category_id);

	$kb_news_sort_par = $kb_config['news_sort_par'];
	$kb_news_sort_method_lj = false; 
	
	switch( $kb_config['news_sort'] ) 
	{ 
	case 'Id': 
   		$kb_news_sort_method = 't.article_id'; 
//		$kb_news_sort_method_extra = 't.article_type' . " DESC, " ;
   		break; 
	case 'Creation': 
 	  	$kb_news_sort_method = 't.article_date'; 
//		$kb_news_sort_method_extra = 't.article_type' . " DESC, " ;
  	 	break; 
	case 'Latest': 
   		$kb_news_sort_method = 'tt.topic_last_post_id'; 
   		$kb_news_sort_method_lj = true; 
//		$kb_news_sort_method_extra = 't.article_type' . " DESC, " ;
   		break; 
	case 'Userrank': 
   		$kb_news_sort_method = 'u.user_rank'; 
//		$kb_news_sort_method_extra = 't.article_type' . " DESC, " ;
   		break; 
	case 'Alphabetic': 
   		$kb_news_sort_method = 't.article_title'; 
//		$kb_news_sort_method_extra = 't.article_type' . " ASC, " ;
   		break; 
	}
	
	//load header
	include ($phpbb_root_path ."includes/kb_header.".$phpEx);
	
	$template->set_filenames(array(
		'body' => 'kb_cat_body.tpl')
	);

  if ( !$category_name )
	{
	    $message = $lang['Category_not_exsist'] . '<br /><br />' . sprintf($lang['Click_return_kb'], '<a href="' . append_sid(this_kb_mxurl()) . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_index'], '<a href="' . append_sid($phpbb_root_path . "index.$phpEx") . '">', '</a>');

      message_die(GENERAL_MESSAGE, $message);
  }
  else
  {

	//get sub-cats
	get_kb_cat_subs($category_id);
	
	$path_kb = ' ';
	$path_kb_array = array();
	get_kb_nav($category_id);

// Pagination
	$sql_pag = "SELECT count(article_id) AS total
		FROM " . KB_ARTICLES_TABLE . "
		WHERE article_category_id = '$category_id'";

	if ( !($result = $db->sql_query($sql_pag)) )
	{
		message_die(GENERAL_ERROR, 'Error getting total articles', '', __LINE__, __FILE__, $sql);
	}

	if ( $total = $db->sql_fetchrow($result) )
	{
		$total_articles = $total['total'];
		$pagination = generate_pagination("kb.$phpEx?mode=cat&cat=$category_id", $total_articles, $kb_config['art_pagination'], $start). '&nbsp;';
	}

	$total_cat_pages = ceil( $total_articles / $kb_config['art_pagination'] );

	$template->assign_vars(array(
		'PAGINATION' => ( $total_cat_pages > 1 ) ? $pagination : '',
		'PAGE_NUMBER' => ( $total_cat_pages > 1 ) ? sprintf($lang['Page_of'], ( floor( $start / $kb_config['art_pagination'] ) + 1 ), ceil( $total_articles / $kb_config['art_pagination'] )) : '',
		'L_GOTO_PAGE' => $lang['Goto_page'],

		'L_CATEGORY_NAME' => $category_name,
		'L_ARTICLE' => $lang['Article'],
		'L_ARTICLE_TYPE' => $lang['Article_type'],
		'L_ARTICLE_CATEGORY' => $lang['Category'],
		'L_ARTICLE_DATE' => $lang['Date'],
		'L_ARTICLE_AUTHOR' => $lang['Author'],
		'L_VIEWS' => $lang['Views'],
		'L_VOTES' => $lang['Votes'],
		
		'L_CATEGORY' => $lang['Category_sub'],
		'L_ARTICLES' => $lang['Articles'],
		
		'PATH' => $path_kb,
		
		'U_CAT' => append_sid(this_kb_mxurl('mode=cat&cat=' . $category_id)))
	);
	get_kb_articles($category_id, '1', 'articlerow', $start, $kb_config['art_pagination']);

	}
	

?>
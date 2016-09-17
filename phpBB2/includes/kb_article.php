<?php
/***************************************************************************
 *                                 kb_article.php
 *                            -------------------
 *   begin                : Sunday, Mar 31, 2003
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: kb_article.php,v 1.9 2004/05/30 20:49:22 jonohlsson Exp $
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


	$article_id = intval($_GET['k']);
	$start = ( isset($_GET['start']) ) ? intval($_GET['start']) : 0;
	
	$sql = "SELECT *
		FROM " . KB_ARTICLES_TABLE . "
		WHERE article_id = $article_id";
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, "Could not obtain article data", '', __LINE__, __FILE__, $sql);
	}

	if ( $row = $db->sql_fetchrow($result) )
	{
	
	   $article_title = stripslashes($row['article_title']);
	   $approved = $row['approved'];

	   $article_category_id = $row['article_category_id'];	
	   $category = get_kb_cat($article_category_id);
	   $article_category_name = $category['category_name'];

	   $temp_url = append_sid(this_kb_mxurl("mode=cat&amp;cat=$article_category_id"));
	   $category = '<a href="' . $temp_url . '" class="gen">' . $article_category_name . '</a>';
	
	   $date = create_date($board_config['default_dateformat'], $row['article_date'], $board_config['board_timezone']);
	
	   // author information
	   $author_id = $row['article_author_id'];	

	   if ( $author_id == 0 )
	   {
	       $author_kb_art = ( $username != '' ) ? $lang['Guest'] : $row['username'];
	   }
	   else
	   {
	       $author_name = get_kb_author($author_id);
	   
	       $temp_url = append_sid($phpbb_root_path . "profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=$author_id");
	       $author_kb_art  = '<a href="' . $temp_url . '" class="gen">' . $author_name . '</a>';
	   }
	
	   $art_pages = explode('[page]', stripslashes($row['article_body']));
	   $article = trim($art_pages[$page_num]);
	   $article = str_replace('[toc]', '', $article);
	   $kb_art_description  = stripslashes($row['article_description']);
	   
	   $type_id = $row['article_type'];
	   $type = get_kb_type($type_id);
	   $topic_id = $row['topic_id'];
	   
	   $new_views = $row['views'] + 1;
	   $views = '<b>' . $lang['Views'] . '</b> ' . $new_views;

		if ($row['article_rating'] == 0 || $row['article_totalvotes'] == 0 )
		{
			$rating = 0;
			$rating_votes = 0;
			$rate_message = ''; 
		}
		else
		{
			$rating = round($row['article_rating']/$row['article_totalvotes'],2);
			$rating_votes = $row['article_totalvotes'];	
			$rating_message = $rating.'/10, '.$rating_votes. ' ' .$lang['Votes'] ;	
	   		$rate_message = '<b>' . $lang['Votes_label'] . '</b> ' . $rating_message;
		}
  	}	
	
	if ( $page_num == 0 )
	{	
	   $sql = "UPDATE " . KB_ARTICLES_TABLE . " SET
		    views = '" . $new_views . "'
		    WHERE article_id = " . $article_id;
    }
	if ( !($result2 = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, "Could not update article's views", '', __LINE__, __FILE__, $sql);
	}
	
	//
	// Was a highlight request part of the URI?
	//
	$highlight_match = $highlight = '';
	if (isset($_GET['highlight']))
	{
	    // Split words and phrases
		$words = explode(' ', trim(htmlspecialchars(urldecode($_GET['highlight']))));

		for($i = 0; $i < sizeof($words); $i++)
		{
		    if (trim($words[$i]) != '')
			{
			    $highlight_match .= (($highlight_match != '') ? '|' : '') . str_replace('*', '\w*', preg_quote($words[$i], '#'));
			}
	    }
		unset($words);

		$highlight = urlencode($_GET['highlight']);
		$highlight_match = phpbb_rtrim($highlight_match, "\\");
    }
	
	if ( !$board_config['allow_html'] ) 
    { 
        $article = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", $article); 
    }
	
	//
	// Parse message
	//
	$bbcode_uid = $row['bbcode_uid'];
	
	if ( $board_config['allow_bbcode'] )
	{
		if ( $bbcode_uid != '' )
		{
			$article = ( $board_config['allow_bbcode'] ) ? bbencode_second_pass($article, $bbcode_uid) : preg_replace("/\:$bbcode_uid/si", '', $article);
		}
	}

	$article = make_clickable($article);

	//
	// Parse smilies
	//
	if ( $board_config['allow_smilies'] )
	{
		$article = smilies_pass($article);		
	}

	//
	// Highlight active words (primarily for search)
	//
	if ($highlight_match)
	{
		// This has been back-ported from 3.0 CVS
		$article = preg_replace('#(?!<.*)(?<!\w)(' . $highlight_match . ')(?!\w|[^<>]*>)#i', '<b style="color:#'.$theme['fontcolor3'].'">\1</b>', $article);
	}

	//
	// Replace naughty words
	//
	if ( count($orig_word) )
	{
		$article_title = preg_replace($orig_word, $replacement_word, $article_title);

		$article = str_replace('\"', '"', substr(@preg_replace('#(\>(((?>([^><]+|(?R)))*)\<))#se', "@preg_replace(\$orig_word, \$replacement_word, '\\0')", '>' . $article . '<'), 1, -1));
	}

	//
	// Replace newlines (we use this rather than nl2br because
	// till recently it wasn't XHTML compliant)
	//

	$article = str_replace("\n", "\n<br />\n", $article);
	
	$article = acronym_pass( $article );
	//
	// Highlight active words (primarily for search)
	//
	if ($highlight_match)
	{
		// This was shamelessly 'borrowed' from volker at multiartstudio dot de
		// via php.net's annotated manual
		$article = str_replace('\"', '"', substr(preg_replace('#(\>(((?>([^><]+|(?R)))*)\<))#se', "preg_replace('#\b(" . $highlight_match . ")\b#i', '<span style=\"color:#" . $theme['fontcolor3'] . "\"><b>\\\\1</b></span>', '\\0')", '>' . $article . '<'), 1, -1));
	}
	
	$page_title = $article_title;
	    if ( !$is_block && !$print_version )
		 {
		   include($phpbb_root_path . 'includes/page_header.'.$phpEx);
		 }	
		
		make_jumpbox($phpbb_root_path .'viewforum.'.$phpEx);
	
	//load header
	if ( !$print_version )
	{
		include ($phpbb_root_path ."includes/kb_header.".$phpEx);
	}
	//edit 
	if ( ( $userdata['user_id'] == $author_id && $kb_config['allow_edit'] ) || ( $is_admin ) )
	{
		 $temp_url = append_sid(this_kb_mxurl("mode=edit&amp;k=" . $article_id));
		 $edit_img = '<a href="' . $temp_url . '"><img src="' . $phpbb_root_path . $images['icon_edit'] . '" alt="' . $lang['Edit_delete_post'] . '" title="' . $lang['Edit_delete_post'] . '" border="0" /></a>';
		 $edit = '<a href="' . $temp_url . '">' . $lang['Edit_delete_post'] . '</a>';
	}
	else
	{
		$edit_img = '';
		$edit = '';
	}
	
	//
	//Build page
	//
	if ( !$print_version )
	{
 		$template->set_filenames(array(
			'body' => 'kb_article_body.tpl')
		);
	}
	else
	{
 		$template->set_filenames(array(
			'body' => 'kb_article_body_print.tpl')
		);
	}	
	
	if ( !$article_title || (!$approved && !$is_admin) )
	{
	    $message = $lang['Article_not_exsist'] . '<br /><br />' . sprintf($lang['Click_return_kb'], '<a href="' . append_sid(this_kb_mxurl()) . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_index'], '<a href="' . append_sid($phpbb_root_path . "index.$phpEx") . '">', '</a>');
      	message_die(GENERAL_MESSAGE, $message);
  	}
  	else
  	{
       	// fix for 0.76
		// if topic id is missing, inset post	
	   	if ( $kb_config['comments'] && !$topic_id && $approved )
	   	{		  
		  	// choose a user
		  	$user_id = $userdata['user_id'];

		  	// initialise the userdata
		  	$sql = "SELECT * FROM " . USERS_TABLE . " WHERE user_id = $user_id";
		  	if ( !($result = $db->sql_query($sql)) )
		  	{
	  	      	message_die(CRITICAL_ERROR, 'Could not obtain lastvisit data from user table', '', __LINE__, __FILE__, $sql);
		  	}
		  	$user = $db->sql_fetchrow($result);
		  	
		  	$search = array (
                 "'&(quot|#34);'i",                	// Replace HTML entities
                 "'&(amp|#38);'i",
                 "'&(lt|#60);'i",
                 "'&(gt|#62);'i"
				 );                    
		  	$replace = array (
                 "\"",
                 "&",
                 "<",
                 ">"
				 );
		  	$temp_url = "http://" . $board_config['server_name'] . $board_config['script_path'] . "kb.".$phpEx."?mode=article&k=".$article_id;
		  	$message = "[b]" . $lang['Category'] . ":[/b] " . $article_category_name . "\n";
		  	$message .= "[b]" . $lang['Article_type'] . ":[/b] " . $type . "\n\n";
		  	$message .= "[b]" . $lang['Article_title'] . ":[/b] " . preg_replace($search, $replace, $row['article_title']) . "\n";
		  	$message .= "[b]" . $lang['Author'] . ":[/b] " . $author_kb_art  . "\n";
		  	$message .= "[b]" . $lang['Article_description'] . ":[/b] " . preg_replace($search, $replace, $row['article_description']) . "\n\n";
		  	$message .= "[b][url=" . $temp_url . "]" . $lang['Read_full_article'] . "[/url][/b]";

		  	$subject = '[ KB ] ' . $row['article_title'];

		  	$subject = str_replace("'", "\'" , $subject);
		  	$message = str_replace("'", "\'" , $message);

		  	$forum_id = $kb_config['forum_id'];
	
		  	$topic_data = insert_post($message, $subject, $forum_id, $user['user_id'], $user['username'], $user['user_attachsig']);
		  
		  	$sql = "UPDATE " . KB_ARTICLES_TABLE .
		     " SET topic_id = " . $topic_data['topic_id'] . " 
		 	 WHERE article_id = " . $article_id;
		 
		  	if ( !($result876 = $db->sql_query($sql)) )
		  	{
   	   	  	  	message_die(GENERAL_ERROR, "Could not update article data", '', __LINE__, __FILE__, $sql);
	      	}
		  	$topic_id = $topic_data['topic_id'];
	  	}
	
		if ( $kb_config['comments'] )
		{       
	    	$sql = "SELECT topic_id, topic_replies FROM " . TOPICS_TABLE . " WHERE topic_id = " . $topic_id;
		
			if ( !($result4 = $db->sql_query($sql)) )
			{
		    	message_die(GENERAL_ERROR, 'Error getting comments', '', __LINE__, __FILE__, $sql);
			}	
			$topic = $db->sql_fetchrow($result4);	  
	   
	    	$temp_url = append_sid($phpbb_root_path . "viewtopic.php?t=" . $topic['topic_id']);
	    	$comments = '<b>' . $lang['Comments'] . '</b><a href="' . $temp_url . '" class="gen"> [' . $topic['topic_replies'] . ' - ' . $lang['Post_comments'] . ']</a>';
	
	    	$template->assign_block_vars('switch_comments', array());
		}
		else
		{
	    	$comments = '';
		}

		if ( $kb_config['comments_show'] && $topic_id && $topic['topic_replies'] != 0)
		{    
			//
			//page number
			//
			if ( isset( $page_num ) )
			{
				$page_numm = "&page_num=" . ($page_num + 1) ;
			}
			else
			{
    			$page_numm = '';
			}

			$show_num_comments = $kb_config['comments_pagination'];
			$pagination = generate_pagination(this_kb_mxurl("mode=article&k=$article_id" . $page_numm), $topic['topic_replies'], $kb_config['comments_pagination'], $start). '&nbsp;';
			get_kb_comments($topic_id, $start, $show_num_comments);   
		}
	
		//rate 
		if ( $kb_config['allow_rating'] && ( $kb_config['allow_anonymos_rating'] || ( !$kb_config['allow_anonymos_rating'] && $userdata['session_logged_in'])) )
		{
				$temp_url = append_sid(this_kb_mxurl("mode=rate&amp;k=" . $article_id . "&amp;cat=" . $article_category_id));
				$rate_img = '<a href="' . $temp_url . '" class="gen">' . $lang['ADD_RATING'] . '</a>';
				$rate = '<a href="' . $temp_url . '" class="gen">' . $lang['ADD_RATING'] . '</a>';
	    		$template->assign_block_vars('switch_ratings', array());
		}
		else
		{
			$rate_img = '';
			$rate = '';
		}
	
		$path_kb = ' ';
		$path_kb_array = array();
		get_kb_nav($article_category_id);

		$print_url = append_sid(this_kb_mxurl("mode=article&amp;k=" . $article_id . "&print=true", true));

		$template->assign_vars(array(
			'PAGINATION' => $pagination,
			'PAGE_NUMBER' => ( count($art_pages) > 1 ) ? sprintf($lang['Page_of'], ( floor( $start / $kb_config['comments_pagination'] ) + 1 ), ceil( $topic['topic_replies'] / $kb_config['comments_pagination'] )) : '',
			'L_GOTO_PAGE' => $lang['Goto_page'],

			'L_ARTICLE_DESCRIPTION' => $lang['Article_description'],
			'L_ARTICLE_DATE' => $lang['Date'],
			'L_ARTICLE_TYPE' => $lang['Article_type'],
			'L_ARTICLE_CATEGORY' => $lang['Category'],
			'L_ARTICLE_AUTHOR' => $lang['Author'],
			'L_TOC' => $lang['TOC'],
			'L_COMMENTS' => $lang['Comments_show_title'],
			'L_PRINT' => $lang['Print_version'],

			'U_PRINT' => $print_url,
		
			'ARTICLE_TITLE' => $article_title,
			'ARTICLE_AUTHOR' => $author_kb_art,
			'ARTICLE_CATEGORY' => $category,
			'ARTICLE_TEXT' => $article,
			'ARTICLE_DESCRIPTION' => $kb_art_description,
			'ARTICLE_DATE' => $date,
			'ARTICLE_TYPE' => $type,
			'EDIT_IMG' => $edit_img,
			'EDIT' => $edit,
			'VIEWS' => $views,

			'RATINGS' => $rate_message,
			'RATE_IMG' => $rate_img,
			'RATE' => $rate,
		
			'PATH' => $path_kb,
		
			'COMMENTS' => $comments)
		);


	//
	//article pages table of contents
	//
	if ( count($art_pages) > 1 )
	{
		$template->assign_block_vars('switch_toc', array());
		
		$i = 0;
	    while($i < count($art_pages))
	    {
			$page_number = $i + 1;
			
	   		$art_split = explode('[toc]', $art_pages[$i]);
	   		$article_toc = $art_split[0];
//	   		$article_body = $art_split[1];

		// Fix up the toc title
		if ( !$board_config['allow_html'] ) 
  	  	{ 
  	      $article_toc = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", $article_toc); 
  	  	}
		//
		// Parse message
		//
//		$bbcode_uid = $row['bbcode_uid'];
//		$article_toc = preg_replace('/\:[0-9a-z\:]+\]/si', ']', $article_toc);
		$article_toc = preg_replace("/\[(\S+)\]/e", "", $article_toc);

//				$txt = preg_replace("/<a href=\"(.*)\">(.*)<\/a>/i", "\\2 (\\1)", $txt);		
		$article_toc = make_clickable($article_toc);
		//
		// Parse smilies
		//
		if ( $board_config['allow_smilies'] )
		{
			$article_toc = smilies_pass($article_toc);		
		}
		//
		// Replace naughty words
		//
		if ( count($orig_word) )
		{
			$article_toc = str_replace('\"', '"', substr(preg_replace('#(\>(((?>([^><]+|(?R)))*)\<))#se', "preg_replace(\$orig_word, \$replacement_word, '\\0')", '>' . $article_toc . '<'), 1, -1));
		}
		// Replace newlines (we use this rather than nl2br because
		// till recently it wasn't XHTML compliant)
//		$article_toc = str_replace("\n", "\n<br />\n", $article_toc);
			
			$page_toc = $art_pages[$i];

		//
		// Sync with comments pagination
		//
		if ( $start > -1 )
		{
			$start_pag = "&start=" . $start;
		}
		else
		{
			$start_pag = "";
		}

			if( $page_num != $i )
			{
				if ( !$print_version )
				{
					$temp_url = append_sid(this_kb_mxurl("mode=article&k=$article_id&page_num=$page_number" . $start_pag));
				}
				else
				{
					$temp_url = append_sid(this_kb_mxurl("mode=article&k=$article_id&page_num=$page_number&print=true" . $start_pag, true));
				}
				$page_link = '<a href="' . $temp_url . '" class="nav">' . $page_number . ' - ' . $article_toc . '</a>';
			}
			else
			{
				$page_link = $page_number . ' - ' . $article_toc ;
			}
			
			if( $i < count($art_pages) - 1 )
			{
			    $page_link .= '<br />';
			}
			$template->assign_block_vars('switch_toc.pages', array(
			    'TOC_ITEM' => $page_link)
			);
		    $i++;
		}
	}	
	
	//
	//article pages
	//
	if ( count($art_pages) > 1 )
	{
		$template->assign_block_vars('switch_pages', array());
		
		if ( $start > -1 )
		{
			$start_pag = "&start=" . $start;
		}
		else
		{
			$start_pag = "";
		}

		$i = 0;
	    while($i < count($art_pages))
	    {
			$page_number = $i + 1;
			if( $page_num != $i )
			{
				if ( !$print_version )
				{
			    	$temp_url = append_sid(this_kb_mxurl("mode=article&k=$article_id&page_num=$page_number" . $start_pag));
				}
				else
				{
			    	$temp_url = append_sid(this_kb_mxurl("mode=article&k=$article_id&page_num=$page_number&print=true" . $start_pag, true));
				}
			    $page_link = '<a href="' . $temp_url . '" class="nav">' . $page_number . '</a>';
			}
			else
			{
			    $page_link = $page_number;
			}
			
			if( $i < count($art_pages) - 1 )
			{
			    $page_link .= ', ';
			}
			$template->assign_block_vars('switch_pages.pages', array(
			    'PAGE_LINK' => $page_link)
			);
		    $i++;
		}
	}
	
  }
  
?>
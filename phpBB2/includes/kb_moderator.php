<?php
/***************************************************************************
 *                             admin_kb_art.php
 *                            -------------------
 *   begin                : Monday, Mar 31, 2003
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: admin_kb_art.php,v 1.9 2004/05/02 08:25:02 jonohlsson Exp $
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

// MX
if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}

if ( !$is_admin )
{
   $message = $lang['No_add'] . '<br /><br />' . sprintf($lang['Click_return_kb'], '<a href="' . append_sid(this_kb_mxurl()) . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_index'], '<a href="' . append_sid($mx_root_path . "index.$phpEx") . '">', '</a>');
   message_die(GENERAL_MESSAGE, $message);
}

include($phpbb_root_path . 'includes/functions_admin.'.$phpEx);

$category_id = $_GET['cat'];
$page_id = $_GET['page'];
$ref_stats = ( isset($_GET['ref']) ) ? true : 0;

if ( isset($_POST['action']) || isset($_GET['action']) )
{
	$action = ( isset($_POST['action']) ) ? $_POST['action'] : $_GET['action'];
}
else
{
	if ( $approve )
	{
		$action = 'approve';
	}
	else if ( $unapprove )
	{
		$action = 'unapprove';
	}
	else if ( $delete )
	{
		$action = 'delete';
	}
	else
	{
		$action = '';
	}
}

switch( $action )
{

 	case 'approve':
	
	$article_id = $_GET['a'];
	
	$topic_sql = '';
	if ( $kb_config['comments'] )
	{
	    $sql = "SELECT * FROM " . KB_ARTICLES_TABLE . " WHERE article_id = " . $article_id;	
		if ( !($results = $db->sql_query($sql)) )
		{
	        message_die(GENERAL_ERROR, "Could not obtain article data", '', __LINE__, __FILE__, $sql);
		}

		$row = $db->sql_fetchrow($results);
	
		if ( !$row['topic_id'] )
		{		
		    // choose a user
			$user_id = $kb_config['admin_id'];

			// initialise the userdata
			$sql = "SELECT * FROM " . USERS_TABLE . " WHERE user_id = $user_id";
			if ( !($result = $db->sql_query($sql)) )
			{
	   	        message_die(CRITICAL_ERROR, 'Could not obtain lastvisit data from user table', '', __LINE__, __FILE__, $sql);
			}
			$user = $db->sql_fetchrow($result);
			init_userprefs($user);
			
			$kb_cat = get_kb_cat($row['article_category_id']);
		    $type = get_kb_type($row['article_type']);
		  	$author = get_kb_author($row['article_author_id']);

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
		  	$message = "[b]" . $lang['Category'] . ":[/b] "  . $kb_cat['category_name'] . "\n";
		  	$message .= "[b]" . $lang['Article_type'] . ":[/b] " . $type . "\n\n";
		  	$message .= "[b]" . $lang['Article_title'] . ":[/b] " . preg_replace($search, $replace, $row['article_title']) . "\n";
		  	$message .= "[b]" . $lang['Author'] . ":[/b] " . $author . "\n";
		  	$message .= "[b]" . $lang['Article_description'] . ":[/b] " . preg_replace($search, $replace, $row['article_description']) . "\n\n";
		  	$message .= "[b][url=" . $temp_url . "]" . $lang['Read_full_article'] . "[/url][/b]";

		  	$subject = '[ KB ] ' . $row['article_title'];

		  	$subject = str_replace("'", "\'" , $subject);
		  	$message = str_replace("'", "\'" , $message);

			$forum_id = $kb_config['forum_id'];
	
			$topic_data = insert_post($message, $subject, $forum_id, $user['user_id'], $user['username'], $user['user_attachsig']);
			$topic_sql = ", topic_id = " . $topic_data['topic_id'];
		}
	}
		
	$sql = "UPDATE " . KB_ARTICLES_TABLE .
		 " SET approved = 1 " . $topic_sql . "
		 WHERE article_id = " . $article_id;
		 
	if ( !($result = $db->sql_query($sql)) )
	{
   	   message_die(GENERAL_ERROR, "Could not update article data", '', __LINE__, __FILE__, $sql);
	}
	
	$sql = "SELECT article_category_id, article_body 
	 FROM " . KB_ARTICLES_TABLE . "
	 WHERE article_id = " . $article_id;

	 if ( !($result = $db->sql_query($sql)) )
	 {
   	  	message_die(GENERAL_ERROR, "Could not obtain article category", '', __LINE__, __FILE__, $sql);
	 }

	 if ( $article = $db->sql_fetchrow($result) )
	 {
	  	$article_category_id = $article['article_category_id'];
		$body = $article['article_body'];
	 }
	 
	 update_kb_number($article_category_id, '+ 1');
	 
	 add_kb_words($article_id, $body);
	
	$message = $lang['Article_approved'] . '<br /><br />' . sprintf($lang['Click_return_article_manager'], '<a href="' . append_sid($phpbb_root_path ."kb.$phpEx?mode=cat&cat=$article_category_id") . '">', '</a>') ;

	message_die(GENERAL_MESSAGE, $message);
	break;

	case 'unapprove':
	
	$article_id = $_GET['a'];
	
	$sql = "UPDATE " . KB_ARTICLES_TABLE .
		 " SET approved = 0
		 WHERE article_id = " . $article_id;
		 
	if ( !($result = $db->sql_query($sql)) )
	{
   	   message_die(GENERAL_ERROR, "Could not update article data", '', __LINE__, __FILE__, $sql);
	}
	
	$sql = "SELECT article_category_id 
	 FROM " . KB_ARTICLES_TABLE . "
	 WHERE article_id = " . $article_id;

	 if ( !($result = $db->sql_query($sql)) )
	 {
   	  	message_die(GENERAL_ERROR, "Could not obtain article category", '', __LINE__, __FILE__, $sql);
	 }

	 if ( $article = $db->sql_fetchrow($result) )
	 {
	  	$article_category_id = $article['article_category_id'];
	 }
	 
	 update_kb_number($article_category_id, '- 1');
	
	$message = $lang['Article_unapproved'] . '<br /><br />' . sprintf($lang['Click_return_article_manager'], '<a href="' . append_sid($phpbb_root_path ."kb.$phpEx?mode=cat&cat=$article_category_id") . '">', '</a>') ;

	message_die(GENERAL_MESSAGE, $message);
	break;
	
	case 'delete':
	
	if ($_GET['c'] == "yes")
	{	
	$article_id = $_GET['a'];
	
	$sql = "SELECT article_category_id, approved, topic_id  
	 FROM " . KB_ARTICLES_TABLE . "
	 WHERE article_id = " . $article_id;

	 if ( !($result = $db->sql_query($sql)) )
	 {
   	  	message_die(GENERAL_ERROR, "Could not obtain article category", '', __LINE__, __FILE__, $sql);
	 }

	 if ( $article = $db->sql_fetchrow($result) )
	 {
	  	$article_category_id = $article['article_category_id'];
	 }
	
	if ($article['approved'] == 1)
	{
	 	update_kb_number($article_category_id, '- 1');
	}
	
	if ( $kb_config['del_topic'] && $article['topic_id'] )
	{
			$topic = $article['topic_id'];

			$sql = "SELECT poster_id, COUNT(post_id) AS posts 
				FROM " . POSTS_TABLE . " 
				WHERE topic_id = " . $topic . "  
				GROUP BY poster_id";
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not get poster id information', '', __LINE__, __FILE__, $sql);
			}

			$count_sql = array();
			while ( $row = $db->sql_fetchrow($result) )
			{
				$count_sql[] = "UPDATE " . USERS_TABLE . " 
					SET user_posts = user_posts - " . $row['posts'] . " 
					WHERE user_id = " . $row['poster_id'];
			}
			$db->sql_freeresult($result);

			if ( sizeof($count_sql) )
			{
				for($i = 0; $i < sizeof($count_sql); $i++)
				{
					if ( !$db->sql_query($count_sql[$i]) )
					{
						message_die(GENERAL_ERROR, 'Could not update user post count information', '', __LINE__, __FILE__, $sql);
					}
				}
			}
			
			$sql = "SELECT forum_id 
			    FROM " . TOPICS_TABLE . "
				WHERE topic_id = $topic";
				
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not get forum id information', '', __LINE__, __FILE__, $sql);
			}

			$forum_id = array();
			while ( $row = $db->sql_fetchrow($result) )
			{
				$forum_id = $row['forum_id'];
			}
			$db->sql_freeresult($result);
			
			$sql = "SELECT post_id 
				FROM " . POSTS_TABLE . " 
				WHERE topic_id = $topic";
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not get post id information', '', __LINE__, __FILE__, $sql);
			}

			$post_array = array();
			$ii = 0;
			$post_id_sql = '';
			while ( $row = $db->sql_fetchrow($result) )
			{
				$post_array[$ii] = $row['post_id'];
				$post_id_sql .= ( ( $post_id_sql != '' ) ? ', ' : '' ) . $row['post_id'];
				$ii++;
			}
			$db->sql_freeresult($result);

			//
			// Got all required info so go ahead and start deleting everything
			//
			$sql = "DELETE 
				FROM " . TOPICS_TABLE . " 
				WHERE topic_id = $topic 
					OR topic_moved_id = $topic";
			if ( !$db->sql_query($sql, BEGIN_TRANSACTION) )
			{
				message_die(GENERAL_ERROR, 'Could not delete topics', '', __LINE__, __FILE__, $sql);
			}

			if ( $post_id_sql != '' )
			{
				$sql = "DELETE 
					FROM " . POSTS_TABLE . " 
					WHERE topic_id = $topic";
				if ( !$db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, 'Could not delete posts', '', __LINE__, __FILE__, $sql);
				}

				for ($i = 0; $i < count($post_array); $i++)
				{
					$sql = "DELETE 
						FROM " . POSTS_TEXT_TABLE . " 
						WHERE post_id = $post_array[$i]";
					if ( !$db->sql_query($sql) )
					{
						message_die(GENERAL_ERROR, 'Could not delete posts text', '', __LINE__, __FILE__, $sql);
					}
				}

				remove_search_post($post_id_sql);
			}

			$sql = "DELETE 
				FROM " . TOPICS_WATCH_TABLE . " 
				WHERE topic_id = $topic";
			if ( !$db->sql_query($sql, END_TRANSACTION) )
			{
				message_die(GENERAL_ERROR, 'Could not delete watched post list', '', __LINE__, __FILE__, $sql);
			}
			if ( !empty($forum_id) )
			{
				sync('forum', $forum_id);
			}

	}
	
	$sql = "DELETE FROM  " . KB_ARTICLES_TABLE .
		 " WHERE article_id = " . $article_id;
		 
	if ( !($result = $db->sql_query($sql)) )
	{
   	   message_die(GENERAL_ERROR, "Could not delete article data", '', __LINE__, __FILE__, $sql);
	}	

	$sql = "DELETE FROM  " . KB_MATCH_TABLE .
		 " WHERE article_id = " . $article_id;
		 
	if ( !($result = $db->sql_query($sql)) )
	{
   	   message_die(GENERAL_ERROR, "Could not delete article wordmatch data", '', __LINE__, __FILE__, $sql);
	}	
	
	$message = $lang['Article_deleted'] . '<br /><br />' . sprintf($lang['Click_return_article_manager'], '<a href="' . append_sid($phpbb_root_path . "kb.$phpEx?mode=cat&cat=$article_category_id") . '">', '</a>') ;

	message_die(GENERAL_MESSAGE, $message);
	}
	else
	{
		$category_id = ($ref_stats ? 1 : $category_id);
		
	 	$message = $lang['Confirm_art_delete'] . '<br /><br />' . sprintf($lang['Confirm_art_delete_yes'], '<a href="' . append_sid($phpbb_root_path ."kb.$phpEx?mode=moderate&action=delete&page=$page_id&cat=$article_category_id&amp;c=yes&amp;a=" . $_GET['a']) . '">', '</a>') . '<br /><br />' . sprintf($lang['Confirm_art_delete_no'], '<a href="' . append_sid($phpbb_root_path ."kb.$phpEx?mode=cat&cat=$category_id") . '">', '</a>');

		message_die(GENERAL_MESSAGE, $message);
	}
	break;
}

$template->pparse('body');


?>
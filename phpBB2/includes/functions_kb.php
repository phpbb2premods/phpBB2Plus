<?php
/***************************************************************************
 *                               kb_functions.php
 *                            -------------------
 *   begin                : Wednesday, June 11, 2003
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : eric@wwegcodes.com
 *
 *   $Id: functions_kb.php,v 1.11 2004/05/30 20:49:22 jonohlsson Exp $
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
 *
 ***************************************************************************/
if ( !defined('IN_PHPBB') )
{
   die('Hacking attempt');
}

//
// get_quick_stats();
// gets number of articles
//
function get_quick_stats()
{
    global $db, $template, $lang;
	
	$sql = "SELECT * FROM " . KB_TYPES_TABLE . " ORDER BY type";

	if ( !($result = $db->sql_query($sql)) )
	{
	    message_die(GENERAL_ERROR, "Error getting quick stats", '', __LINE__, __FILE__, $sql);
	}

	$template->assign_block_vars('switch_quick_stats', array(
	    'L_QUICK_STATS' => $lang['Quick_stats'])
	);

   $ii=0;
   while( $type = $db->sql_fetchrow($result) ) 
   { 
	$ii++;
   	$type_id = $type['id']; 
      $type_name = $type['type']; 
    
      $sql = "SELECT article_id FROM " . KB_ARTICLES_TABLE . " WHERE article_type = $type_id"; 
    
      if ( !($count = $db->sql_query($sql)) ) 
      { 
           message_die(GENERAL_ERROR, "error getting quick stats", '', __LINE__, __FILE__, $sql); 
      } 

    $number_count = 0;    
    $number_count = $db->sql_numrows($count); 

		$template->assign_block_vars('switch_quick_stats.quick_stats', array(
		    'Q_TYPE_NAME' => (($ii == 1) ? ':: ' . $type_name : $type_name),
			'Q_TYPE_AMOUNT' => '(' . $number_count . ') ::'
		));
  }
	
	return $template;
}
 
//
// get author of article
//
function get_kb_author($id)
{
     global $db;
 
     $sql = "SELECT username  
       		FROM " . USERS_TABLE . " 
      		WHERE user_id = $id";
	 
	  if ( !($result = $db->sql_query($sql)) )
	  {
		  message_die(GENERAL_ERROR, "Could not obtain author data", '', __LINE__, __FILE__, $sql);
	  }

	  if ( $row = $db->sql_fetchrow($result) )
	  {	
		  $name = $row['username'];
	  }
	  else
	  {
	      $name = '';
	  }
	  
	  return $name;
}

//
// get type of article
//
function get_kb_type($id)
{
    global $db;
	
    $sql = "SELECT type  
       		FROM " . KB_TYPES_TABLE . " 
      		WHERE id = $id";
	
	 if ( !($result = $db->sql_query($sql)) )
	 {
		message_die(GENERAL_ERROR, "Could not obtain article type data", '', __LINE__, __FILE__, $sql);
	 }

	 if ( $row = $db->sql_fetchrow($result) )
	 {	
		$type = $row['type'];
	 }
	 
	 return $type;
}

//
// get category for article
//
function get_kb_cat($id)
{
    global $db;

	$sql = "SELECT *  
       		FROM " . KB_CATEGORIES_TABLE . " 
			WHERE category_id = $id";
	
	 if ( !($result = $db->sql_query($sql)) )
	 {
		message_die(GENERAL_ERROR, "Could not obtain category data", '', __LINE__, __FILE__, $sql);
	 }
	 
	 $row = $db->sql_fetchrow($result);
	 
	 return $row;
}

//
// get_kb_nav($cat_id)
// gets parents for category
//
function get_kb_nav($parent)
{
    global $db, $phpbb_root_path, $phpbb_root_path, $phpbb_root_path, $phpEx;
	global $path_kb, $path_kb_array, $is_block, $page_id;
	
	$sql = "SELECT * FROM " . KB_CATEGORIES_TABLE . " 
		       WHERE category_id = $parent";
	
	if ( !($result = $db->sql_query($sql)) )
	 {
		message_die(GENERAL_ERROR, "Could not obtain category data", '', __LINE__, __FILE__, $sql);
	 }
	 
	 $row = $db->sql_fetchrow($result);
	
	 $temp_url = append_sid(this_kb_mxurl('mode=cat&amp;cat='. $row['category_id']));		   
	 $path_kb_array[] .= '-> <a href="' . $temp_url . '" class="nav">' . $row['category_name'] . '</a> ';
	 
	 if ( $row['parent'] != '0' )
	 {
	     get_kb_nav($row['parent']);
		 return;
	 }
	 
	 $path_kb_array2 = array_reverse($path_kb_array);
	 
	 $i = 0;
	 while($i <= count($path_kb_array2))
	 {
		 $path_kb .= $path_kb_array2[$i];
		 $i++;
	 }
	 
	 return;
}

//
// get articles for the category
//
function get_kb_articles($id = false, $approve, $block_name, $start = -1, $articles_in_cat = 0)
{
    global $db, $template, $images, $phpEx, $phpbb_root_path, $phpbb_root_path, $phpbb_root_path, $board_config, $lang, $is_block, $page_id, $is_admin, $userdata;
	global $kb_news_sort_method_extra, $kb_news_sort_method, $kb_news_sort_method_lj, $kb_news_sort_par, $kb_config, $is_admin;
	
	$sql = "SELECT t.*, u.username, u.user_id, u.user_rank, u.user_sig, u.user_sig_bbcode_uid, u.user_allowsmile
			FROM " . KB_ARTICLES_TABLE  . " t, " . USERS_TABLE . " u".(($kb_news_sort_method_lj) ?  ",". TOPICS_TABLE  . " tt" : '')."
			WHERE ";	

	if ( $id )
	{
	    $sql .= " t.article_category_id = " . $id . " AND";
	}
	
	if($kb_news_sort_method_lj)
	{
		$sql .= " tt.topic_id = t.topic_id AND";
	}
	$sql .= " u.user_id = t.article_author_id";

	if ( !$is_admin )
	{
		$sql .= " AND t.approved = " . $approve;
	}
	
	if ( defined('IN_ADMIN') )
	{
	    $sql .= " ORDER BY t.article_id";
	}
	else
	{
	    $sql .= " ORDER BY " . $kb_news_sort_method_extra . $kb_news_sort_method . " " . $kb_news_sort_par;
	}

	if ( $start > -1 && $articles_in_cat > 0 )
	{
		$sql .= " LIMIT $start, $articles_in_cat";
	}

	if ( !($article_result = $db->sql_query($sql)) )
	{
	   message_die(GENERAL_ERROR, "Could not obtain article data", '', __LINE__, __FILE__, $sql);
	}

	$i=0;
	
	while($article = $db->sql_fetchrow($article_result))
	{	
		$i++;
		$article_description = stripslashes($article['article_description']);
		$article_cat = $article['article_category_id'];
		$article_approved = $article['approved'];
		
	   //type
	   $type_id = $article['article_type'];	   
	   $article_type = get_kb_type($type_id);		
		
	   $article_date = create_date($board_config['default_dateformat'], $article['article_date'], $board_config['board_timezone']);
		
	   // author information
	   $author_id = $article['article_author_id'];
	   if ( $author_id == 0 )
	   {
	       $author = ( $username != '' ) ? $lang['Guest'] : $article['username'];
	   }
	   else
	   {
	       $author_name = get_kb_author($author_id);
	   
	       $temp_url = append_sid($phpbb_root_path . "profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=$author_id");
	       $author = '<a href="' . $temp_url . '" class="gen">' . $author_name . '</a>';
	   }
		
	   $article_id = $article['article_id'];
	   $views = $article['views'];
		
	   $article_title = stripslashes($article['article_title']);
	   $temp_url = append_sid(this_kb_mxurl("mode=article&amp;k=$article_id"));
	   $article = '<a href="' . $temp_url . '" class="gen">' . $article_title . '</a>';
	   
	   $approve = '';
	   $delete = '';
	   $category_name = '';   
	   
	   if ( defined('IN_ADMIN') )
	   {
	       $category = get_kb_cat($article_cat);
		   $category_name = $category['category_name'];

		   if ( $article_approved == 2 || $article_approved == 0)
		   {
		       //approve
		   	   $temp_url = append_sid($phpbb_root_path . "admin/admin_kb_art.$phpEx?mode=approve&amp;a=$article_id");
		   	   $approve = '<a href="' . $temp_url . '"><img src="'. $images['icon_approve'] . '" border="0" alt="' . $lang['Approve'] . '"></a>';
		   }
		   elseif ( $article_approved == 1 )
		   {		   
			   //unapprove
			   $temp_url = append_sid($phpbb_root_path . "admin/admin_kb_art.$phpEx?mode=unapprove&amp;a=$article_id");
			   $approve = '<a href="' . $temp_url . '"><img src="'.  $images['icon_unapprove'] . '" border="0" alt="' . $lang['Un_approve'] . '"></a>';
		   }
	
		   	//delete
		   	$temp_url = append_sid($phpbb_root_path . "admin/admin_kb_art.$phpEx?mode=delete&amp;a=$article_id");
		   	$delete = '<a href="' . $temp_url . '"><img src="'.$phpbb_root_path . $images['icon_delpost'] . '" border="0" alt="' . $lang['Delete'] . '"></a>';
	   }
	   else if ( $is_admin )
	   {
	       $category = get_kb_cat($article_cat);
		   $category_name = $category['category_name'];

		   if ( $article_approved == 2 || $article_approved == 0)
		   {
		       //approve
		   	   $temp_url = append_sid($phpbb_root_path . "kb.$phpEx?mode=moderate&action=approve&amp;a=$article_id&cat=$article_cat&page=$page_id");
		   	   $approve = '<a href="' . $temp_url . '"><img src="'. $images['icon_approve'] . '" border="0" alt="' . $lang['Approve'] . '"></a>';
		   }
		   elseif ( $article_approved == 1 )
		   {		   
			   //unapprove
			   $temp_url = append_sid($phpbb_root_path . "kb.$phpEx?mode=moderate&action=unapprove&amp;a=$article_id&cat=$article_cat&page=$page_id");
			   $approve = '<a href="' . $temp_url . '"><img src="'. $images['icon_unapprove'] . '" border="0" alt="' . $lang['Un_approve'] . '"></a>';
		   }
	
		   	//delete
		   	$temp_url = append_sid($phpbb_root_path . "kb.$phpEx?mode=moderate&action=delete&amp;a=$article_id&cat=$article_cat&page=$page_id");
		   	$delete = '<a href="' . $temp_url . '"><img src="'.$phpbb_root_path . $images['icon_delpost'] . '" border="0" alt="' . $lang['Delete'] . '"></a>';
	  }
	   
	if ($article['article_rating'] == 0 || $article['article_totalvotes'] == 0 )
	{
		$rating = 0;
		$rating_votes = 0;
		$rating_message = ''; 
	}
	else
	{
		$rating = round($postrow[$i]['link_rating']/$postrow[$i]['link_totalvotes'],2);
		$rating_votes = $postrow[$i]['link_totalvotes'];	
		$rating_message = '('.$rating.'/10, </span><span class="gensmall">'.$rating_votes.' votes)';	
		
	}
  
	   $template->assign_block_vars($block_name, array(
			'ARTICLE' => $article ,
			'ARTICLE_DESCRIPTION' => $article_description,
			'ARTICLE_TYPE' => $article_type,
			'ARTICLE_DATE' => $article_date,
			'ARTICLE_AUTHOR' => $author,
			'CATEGORY' => $category_name,
			'ART_VIEWS' => $views,
			'ART_VOTES' => $rating_message,

			'U_APPROVE' => $approve,
			'U_DELETE' => $delete)
		);
	}
   if ($i == 0)
   {
 	   $template->assign_block_vars('no_articles', array(
			'COMMENT' => $lang['No_Articles'])
		);
  
   }
   
	return $template;
}

//
// update number of articles in a category
//
function update_kb_number($id, $change)
{
    global $db;
	
	//update number of articles in category if article has been approve
	$sql = "SELECT * FROM " . KB_CATEGORIES_TABLE . " WHERE category_id = '" . $id . "'";
	if ( !($results = $db->sql_query($sql)) )
	{
   	  	message_die(GENERAL_ERROR, "Could not obtain article data", '', __LINE__, __FILE__, $sql);
	}
	if ( $kb_cat = $db->sql_fetchrow($results) )
	{ 
	    $new_number = $kb_cat['number_articles'] . $change;
	}	
	$sql = "UPDATE " . KB_CATEGORIES_TABLE .
		  " SET number_articles = " . $new_number .
		  " WHERE category_id = '" . $id . "'";
		 
	if ( !($result = $db->sql_query($sql)) )
	{
   	    message_die(GENERAL_ERROR, "Could not update category data", '', __LINE__, __FILE__, $sql);
	}
	
	if ($kb_cat['parent'] != '0')
	{
	    update_kb_number($kb_cat['parent'], $change);
	}
	  
	return;
}

//
// email admin
//
function email_kb_admin($action)
{
    global $lang, $emailer, $board_config, $kb_config, $db, $phpbb_root_path, $phpbb_root_path, $phpbb_root_path, $phpEx, $is_block, $page_id, $images;
	
	if ( $action == 2 )
	{	    
		include($phpbb_root_path . 'includes/emailer.'.$phpEx);

      //
      // Let's do some checking to make sure that mass mail functions
      // are working in win32 versions of php.
      //
      if ( preg_match('/[c-z]:\\\.*/i', getenv('PATH')) && !$board_config['smtp_delivery'])
      {
         $ini_val = ( @phpversion() >= '4.0.0' ) ? 'ini_get' : 'get_cfg_var';

         // We are running on windows, force delivery to use our smtp functions
         // since php's are broken by default
         $board_config['smtp_delivery'] = 1;
         $board_config['smtp_host'] = @$ini_val('SMTP');
      }

      $emailer = new emailer($board_config['smtp_delivery']);

      $emailer->from($board_config['board_email']);
      $emailer->replyto($board_config['board_email']);

      $email_headers = 'X-AntiAbuse: Board servername - ' . $board_config['server_name'] . "\n";
      $email_headers .= 'X-AntiAbuse: User_id - ' . $userdata['user_id'] . "\n";
      $email_headers .= 'X-AntiAbuse: Username - ' . $userdata['username'] . "\n";
      $email_headers .= 'X-AntiAbuse: User IP - ' . decode_ip($user_ip) . "\n";

      $emailer->use_template('admin_send_email');
      $emailer->email_address($board_config['board_email']);
      $emailer->set_subject($lang['New_article']);
      $emailer->extra_headers($email_headers);

      $emailer->assign_vars(array(
         'SITENAME' => $board_config['sitename'],
         'BOARD_EMAIL' => $board_config['board_email'],
         'MESSAGE' => $lang['Email_body'])
      );
      $emailer->send();
      $emailer->reset(); 
	}
	else if ( $action == 1 )
	{
	    $sql = "UPDATE " . USERS_TABLE . " 
		   		SET user_new_privmsg = '1', user_last_privmsg = '9999999999'
				WHERE user_id = " . $kb_config['admin_id'];
				
		   if ( !($result = $db->sql_query($sql)) )
           {
		      message_die(GENERAL_ERROR, 'Could not update users table', '', __LINE__, __FILE__, $sql);
           }
			
			// added by snake for extended PM 
			$approve_pm_view = "<table width=". "100%" . " border=" . "1" . " cellspacing=" . "0" . " cellpadding=" . "0" . "><tr><td>".$lang['Category']."</td><td>".$lang['Art_action']."</td></tr>"; 
			
			$sql = "SELECT * FROM " . KB_ARTICLES_TABLE . " WHERE approved = '2' ORDER BY article_id DESC LIMIT 1"; 
			if ( !($article_result = $db->sql_query($sql)) ) 
			{ 
				message_die(GENERAL_ERROR, "Could not obtain article data", '', __LINE__, __FILE__, $sql); 
			} 

			while($article = $db->sql_fetchrow($article_result)) 
			{ 
				$approved_yesno = $article['approved']; 
				$article_description = $article['article_description']; 
				$article_cat = $article['article_category_id']; 
				$bbcode_uid = $article['bbcode_uid']; // to enadbe bbcode from article html seems to wolr by default even whwn off 
				$articlebody = "[quote:$bbcode_uid]" .$article['article_body'] . "<br>[/quote:$bbcode_uid]"; // include the post for approve.. 
			
				//type 
				$type_id = $article['article_type']; 
				$article_type = get_kb_type($type_id); 
				$article_date = create_date($board_config['default_dateformat'], $article['article_date'], $board_config['board_timezone']); 
				
				// author information 
				$author_id = $article['article_author_id'];
				 
				if ( $author_id == 0 ) 
				{ 
					$author = ( $username != '' ) ? $lang['Guest'] : $article['username']; 
				} 
				else 
				{ 
					$author_name = get_kb_author($author_id); 
					$temp_url = append_sid($phpbb_root_path . "profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=$author_id"); 
					$author = '<a href="' . $temp_url . '" class="gen">' . $author_name . '</a>'; 
				} 

				$article_id = $article['article_id']; 
				$views = $article['views']; 
				$article_title = $article['article_title']; 
				$temp_url = append_sid(this_kb_mxurl("mode=article&amp;k=$article_id")); 
				$article = '<a href="' . $temp_url . '" class="gen">' . $article_title . '</a>'; 

				$approve = ''; 
				$delete = ''; 
				$category_name = ''; 

				$category = get_kb_cat($article_cat); 
				$category_name = $category['category_name']; 
			
				if ( $approved_yesno == 2) 
				{ 
				//approve 
					$temp_url = append_sid($phpbb_root_path . "admin/admin_kb_art.$phpEx?mode=approve&amp;a=$article_id"); 
					$approve = '<a href="' . $temp_url . '"><img src="'. $images['icon_approve'] . '" border="0" alt="' . $lang['Approve'] . '"></a>'; 
				}
				else
				{ 
				//unapprove 
					$temp_url = append_sid($phpbb_root_path . "admin/admin_kb_art.$phpEx?mode=unapprove&amp;a=$article_id"); 
					$unapprove = '<a href="' . $temp_url . '"><img src="'. $images['icon_unapprove'] . '" border="0" alt="' . $lang['Un_approve'] . '"></a>'; 
				}
					$temp_url = append_sid($phpbb_root_path . "admin/admin_kb_art.$phpEx?mode=delete&amp;a=$article_id"); 
					$delete = '<a href="' . $temp_url . '"><img src="'.$images['icon_delpost'] . '" border="0" alt="' . $lang['Delete'] . '"></a>'; 
					$approve_pm_view .= "<tr><td>$category_name</td><td>$approve ' ' $delete ' ' $unapprove</td></tr>"; // the action table 
			
			} 
					
			$approve_pm_view .= "</table>"; // end action table 

			$user_id = $kb_config['admin_id']; 
			$new_article_subject = $lang['New_article']; 
			$new_article = $lang['Email_body']; // original code 
			$new_article .= $articlebody; // the extended Pm body 
			$new_article .= '<p>'. $approve_pm_view; // the extended Pm body 
			$new_article .= '<br><a href='. $phpbb_root_path . 'admin/admin_kb_art.'.$phpEx .'>KB Admin page</a><br>'; // the extended Pm body 
		  	$new_article = addslashes($new_article);

			$privmsgs_date = date("U"); 

			// End Snake Extend PM Mod
		   
           $sql = "INSERT INTO " . PRIVMSGS_TABLE . " (privmsgs_type, privmsgs_subject, privmsgs_from_userid, privmsgs_to_userid, privmsgs_date, privmsgs_enable_html, privmsgs_enable_bbcode, privmsgs_enable_smilies, privmsgs_attach_sig) VALUES ('5', '" . $new_article_subject . "', '" . $user_id . "', '" . $user_id . "', '" . $privmsgs_date . "', '0', '1', '1', '0')";
           if ( !$db->sql_query($sql) )
		   {
			  message_die(GENERAL_ERROR, 'Could not insert private message sent info', '', __LINE__, __FILE__, $sql);
		   }
		   $privmsg_sent_id = $db->sql_nextid();
		   $privmsgs_text = $lang['register_pm_subject'];

		   $sql = "INSERT INTO " . PRIVMSGS_TEXT_TABLE . " (privmsgs_text_id, privmsgs_bbcode_uid, privmsgs_text) VALUES ($privmsg_sent_id, '" . $bbcode_uid . "', '" . $new_article . "')"; // need to aply the bbcode_uid for bbcode to work 
           if ( !$db->sql_query($sql) )
		   {
			  message_die(GENERAL_ERROR, 'Could not insert private message sent text', '', __LINE__, __FILE__, $sql);
		   }
	}
	return;
}

//
// get categories for index
//
function get_kb_cat_index($parent = 0)
{
    global $db, $template, $phpbb_root_path, $phpbb_root_path, $phpbb_root_path, $phpEx, $is_block, $page_id;
	
	$sql = "SELECT *  
       		FROM " . KB_CATEGORIES_TABLE . " 
			WHERE parent = " . $parent . " 
			ORDER BY cat_order";
	
	 if ( !($result = $db->sql_query($sql)) )
	 {
		message_die(GENERAL_ERROR, "Could not obtain category data", '', __LINE__, __FILE__, $sql);
	 }
	 
	 while ( $category = $db->sql_fetchrow($result) )
	 {		
		$category_details = $category['category_details'];
		$category_articles = $category['number_articles'];
		
		$category_id = $category['category_id'];
		$category_name = $category['category_name'];
		$temp_url = append_sid(this_kb_mxurl("mode=cat&amp;cat=$category_id"));
	   	$category = '<a href="' . $temp_url . '" class="forumlink">' . $category_name . '</a>';
		
		$template->assign_block_vars('catrow', array(
			'CATEGORY' => $category,
			'CAT_DESCRIPTION' => $category_details,
			'CAT_ARTICLES' => $category_articles)
		);
	 }	 
	 return $template;
}

//
// get sub categories for articles
//
function get_kb_cat_subs($parent)
{
    global $db, $template, $phpbb_root_path, $phpbb_root_path, $phpbb_root_path, $phpEx, $is_block, $page_id;
	
	$sql = "SELECT *  
       		FROM " . KB_CATEGORIES_TABLE . " 
			WHERE parent = " . $parent . " 
			ORDER BY cat_order";
	
	 if ( !($result = $db->sql_query($sql)) )
	 {
		message_die(GENERAL_ERROR, "Could not obtain sub-category data", '', __LINE__, __FILE__, $sql);
	 }
	 if ( !($result2 = $db->sql_query($sql)) )
	 {
		message_die(GENERAL_ERROR, "Could not obtain sub-category data", '', __LINE__, __FILE__, $sql);
	 }
 
	 if ( $category2 = $db->sql_fetchrow($result2) )
	 {		
		// fix for 0.76
		if ( $category2['category_name'] != '' )
	 	{
	        $template->assign_block_vars('switch_sub_cats', array());
	    }
	 }
	 while ( $category = $db->sql_fetchrow($result) )
	 {		
		$category_details = $category['category_details'];
		$category_articles = $category['number_articles'];
		
		$category_id = $category['category_id'];
		$category_name = $category['category_name'];
		$temp_url = append_sid(this_kb_mxurl("mode=cat&amp;cat=$category_id"));
	   	$category = '<a href="' . $temp_url . '" class="forumlink">' . $category_name . '</a>';
		
		$template->assign_block_vars('switch_sub_cats.catrow', array(
			'CATEGORY' => $category,
			'CAT_DESCRIPTION' => $category_details,
			'CAT_ARTICLES' => $category_articles)
		);
	  }	
	  return $template;
}

//
// get category list for adding and editing articles
//
function get_kb_cat_list($sel_id)
{
    global $db, $template;
	
	$sql = "SELECT *  
    	 FROM " . KB_CATEGORIES_TABLE;
	
	 if ( !($cat_result = $db->sql_query($sql)) )
	 {
	     message_die(GENERAL_ERROR, "Could not obtain category information", '', __LINE__, __FILE__, $sql);
	 }

	$categoryy = '';
	 while ( $category = $db->sql_fetchrow($cat_result) )
	 {	
		 $category_name = $category['category_name'];
		 $category_id = $category['category_id'];
		   
		 if ( $sel_id == $category_id )
		 {
		   	 $status = 'selected';
		 }
		 else
		 {
		   	 $status = '';
		 }

		 $categoryy .= '<option value="' . $category_id . '" ' . $status . '>' . $category_name . '</option>';
		
	  }

      //----------------------replace
	   $template->assign_vars(array(
	  //--------------------------
		     'CATEGORYY' => $categoryy)
		 );
	  
	  return $template;
}

//
// get type list for adding and editing articles
//
function get_kb_type_list($sel_id)
{
    global $db, $template;
	
	$sql = "SELECT *  
       	FROM " . KB_TYPES_TABLE;
	
	if ( !($type_result = $db->sql_query($sql)) )
	{
	   message_die(GENERAL_ERROR, "Could not obtain category information", '', __LINE__, __FILE__, $sql);
	}
	
	while ( $type = $db->sql_fetchrow($type_result) )
	{	
		$type_name = $type['type'];
		$type_id = $type['id'];
		   
		if ( $sel_id == $type_id )
		{
		   	$status = 'selected';
		}
		else
		{
		   	$status = '';
		}
		   
		$type = '<option value="' . $type_id . '" ' . $status . '>' . $type_name . '</option>';
		   
		$template->assign_block_vars('types', array(
		    'TYPE' => $type)
		);
	}
	return $template;
}

//
// insert post for site updates
// By netclectic - Adrian Cockburn
//
function insert_post( 
    $message,
    $subject, 
    $forum_id, 
    $user_id, 
    $user_name, 
    $user_attach_sig, 
    $topic_id = NULL,
	$message_update_text = '',
	$bump_post = 1, 
    $topic_type = POST_NORMAL, 
    $do_notification = false, 
    $notify_user = false, 
    $current_time = 0, 
    $error_die_function = '', 
    $html_on = 1, 
    $bbcode_on = 1, 
    $smilies_on = 1 )
{
    global $db, $board_config, $user_ip;

    // initialise some variables
    $topic_vote = 0; 
    $poll_title = '';
    $poll_options = '';
    $poll_length = '';
    
	if ( $bump_post == 0)
	{
		$mode = 'update_only';
	}

    $bbcode_uid = ($bbcode_on) ? make_bbcode_uid() : ''; 
    $error_die_function = ($error_die_function == '') ? "message_die" : $error_die_function;
    $current_time = ($current_time == 0) ? time() : $current_time;
    
    // parse the message and the subject 
    $message_update_text = str_replace("\'", "''", prepare_message(trim($message_update_text . $message), $html_on, $bbcode_on, $smilies_on, $bbcode_uid)); 
    $message = str_replace("\'", "''", prepare_message(trim($message), $html_on, $bbcode_on, $smilies_on, $bbcode_uid)); 
    $subject = str_replace("\'", "''", trim($subject)); 
    $username = str_replace("\'", "''", trim(strip_tags($user_name))); 
    
    // if this is a new topic then insert the topic details
    if ( is_null($topic_id) )
    {
        $mode = 'newtopic'; 
        $sql = "INSERT INTO " . TOPICS_TABLE . " (topic_title, topic_poster, topic_time, forum_id, topic_status, topic_type, topic_vote) VALUES ('$subject', " . $user_id . ", $current_time, $forum_id, " . TOPIC_UNLOCKED . ", $topic_type, $topic_vote)";
        if ( !$db->sql_query($sql, BEGIN_TRANSACTION) )
        {
            $error_die_function(GENERAL_ERROR, 'Error in posting', '', __LINE__, __FILE__, $sql);
        }
        $topic_id = $db->sql_nextid();
    }

    // insert the post details using the topic id
	if ( $mode != 'update_only' )
    {	
    	$sql = "INSERT INTO " . POSTS_TABLE . " (topic_id, forum_id, poster_id, post_username, post_time, poster_ip, enable_bbcode, enable_html, enable_smilies, enable_sig) VALUES ($topic_id, $forum_id, " . $user_id . ", '$username', $current_time, '$user_ip', $bbcode_on, $html_on, $smilies_on, $user_attach_sig)";
    	if ( !$db->sql_query($sql, BEGIN_TRANSACTION) )
    	{
       	 $error_die_function(GENERAL_ERROR, 'Error in posting', '', __LINE__, __FILE__, $sql);
   	 	}
   	 	$post_id = $db->sql_nextid();
    

    	// insert the actual post text for our new post
    	$sql = "INSERT INTO " . POSTS_TEXT_TABLE . " (post_id, post_subject, bbcode_uid, post_text) VALUES ($post_id, '$subject', '$bbcode_uid', '$message_update_text')";
   	 	if ( !$db->sql_query($sql, BEGIN_TRANSACTION) )
   		 {
   		     $error_die_function(GENERAL_ERROR, 'Error in posting', '', __LINE__, __FILE__, $sql);
   		 }
    
    	// update the post counts etc.
    	$newpostsql = ($mode == 'newtopic') ? ',forum_topics = forum_topics + 1' : '';
    	$sql = "UPDATE " . FORUMS_TABLE . " SET 
                forum_posts = forum_posts + 1,
                forum_last_post_id = $post_id
                $newpostsql 	
            WHERE forum_id = $forum_id";
    	if ( !$db->sql_query($sql, BEGIN_TRANSACTION) )
    	{
    	    $error_die_function(GENERAL_ERROR, 'Error in posting', '', __LINE__, __FILE__, $sql);
    	}
    
    	// update the first / last post ids for the topic
    	$first_post_sql = ( $mode == 'newtopic' ) ? ", topic_first_post_id = $post_id  " : ' , topic_replies=topic_replies+1'; 
    	$sql = "UPDATE " . TOPICS_TABLE . " SET 
                topic_last_post_id = $post_id 
                $first_post_sql
            WHERE topic_id = $topic_id";
   		 if ( !$db->sql_query($sql, BEGIN_TRANSACTION) )
    	{
      	  $error_die_function(GENERAL_ERROR, 'Error in posting', '', __LINE__, __FILE__, $sql);
    	}
    
    	// update the user's post count and commit the transaction
    	$sql = "UPDATE " . USERS_TABLE . " SET 
                user_posts = user_posts + 1
            WHERE user_id = $user_id";
    	if ( !$db->sql_query($sql, END_TRANSACTION) )
    	{
       	 $error_die_function(GENERAL_ERROR, 'Error in posting', '', __LINE__, __FILE__, $sql);
    	}
    
    	// add the search words for our new post
    	switch ($board_config['version'])
    	{
       	 case '.0.0' : 
       	 case '.0.1' : 
         case '.0.2' : 
       	 case '.0.3' : 
            add_search_words($post_id, stripslashes($message), stripslashes($subject));
            break;
        
        default :
            add_search_words('', $post_id, stripslashes($message), stripslashes($subject));
            break;
    	}
    
    	// do we need to do user notification
    	if ( ($mode != 'newtopic') && $do_notification )
    	{
        	$post_data = array();
       	 user_notification($mode, $post_data, $subject, $forum_id, $topic_id, $post_id, $notify_user);
    	}
	// End if mode is update_only	
	}
	
	// Update original post
	// Added by Haplo
	   $sql = "SELECT topic_first_post_id  
       		FROM " . TOPICS_TABLE . " 
      		WHERE topic_id = '$topic_id'";
	 
	  if ( !($result = $db->sql_query($sql)) )
	  {
		  message_die(GENERAL_ERROR, "Could not obtain orig_post_id data", '', __LINE__, __FILE__, $sql);
	  }
	  	$row = $db->sql_fetchrow($result);
		
		$orig_post_id = $row[0];
		
	    $sql = "UPDATE " . POSTS_TEXT_TABLE . " SET 
                post_subject = '$subject', 
				bbcode_uid = '$bbcode_uid', 
				post_text = '$message' 
				WHERE post_id = '$orig_post_id'";

	if ( !($result = $db->sql_query($sql, BEGIN_TRANSACTION)) )
    {
        $message_die(GENERAL_ERROR, 'Error in posting', '', __LINE__, __FILE__, $sql);
    }
   
    // if all is well then return the id of our new post
    return array('post_id'=>$post_id, 'topic_id'=>$topic_id);
}

function add_kb_words($post_id, $post_text, $post_title = '')
{
	global $db, $phpbb_root_path, $phpbb_root_path, $phpbb_root_path, $board_config, $lang, $is_block, $page_id;

	$stopword_array = @file($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . "/search_stopwords.txt"); 
	$synonym_array = @file($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . "/search_synonyms.txt"); 

	$search_raw_words = array();
	$search_raw_words['text'] = split_words(clean_words('post', $post_text, $stopword_array, $synonym_array));
	$search_raw_words['title'] = split_words(clean_words('post', $post_title, $stopword_array, $synonym_array));

	$word = array();
	$word_insert_sql = array();
	while ( list($word_in, $search_matches) = @each($search_raw_words) )
	{
		$word_insert_sql[$word_in] = '';
		if ( !empty($search_matches) )
		{
			for ($i = 0; $i < count($search_matches); $i++)
			{ 
				$search_matches[$i] = trim($search_matches[$i]);

				if( $search_matches[$i] != '' ) 
				{
					$word[] = $search_matches[$i];
					if ( !strstr($word_insert_sql[$word_in], "'" . $search_matches[$i] . "'") )
					{
						$word_insert_sql[$word_in] .= ( $word_insert_sql[$word_in] != "" ) ? ", '" . $search_matches[$i] . "'" : "'" . $search_matches[$i] . "'";
					}
				} 
			}
		}
	}

	if ( count($word) )
	{
		sort($word);

		$prev_word = '';
		$word_text_sql = '';
		$temp_word = array();
		for($i = 0; $i < count($word); $i++)
		{
			if ( $word[$i] != $prev_word )
			{
				$temp_word[] = $word[$i];
				$word_text_sql .= ( ( $word_text_sql != '' ) ? ', ' : '' ) . "'" . $word[$i] . "'";
			}
			$prev_word = $word[$i];
		}
		$word = $temp_word;

		$check_words = array();
		switch( SQL_LAYER )
		{
			case 'postgresql':
			case 'msaccess':
			case 'mssql-odbc':
			case 'oracle':
			case 'db2':
				$sql = "SELECT word_id, word_text     
					FROM " . SEARCH_WORD_TABLE . " 
					WHERE word_text IN ($word_text_sql)";
				if ( !($result = $db->sql_query($sql)) )
				{
					message_die(GENERAL_ERROR, 'Could not select words', '', __LINE__, __FILE__, $sql);
				}

				while ( $row = $db->sql_fetchrow($result) )
				{
					$check_words[$row['word_text']] = $row['word_id'];
				}
				break;
		}

		$value_sql = '';
		$match_word = array();
		for ($i = 0; $i < count($word); $i++)
		{ 
			$new_match = true;
			if ( isset($check_words[$word[$i]]) )
			{
				$new_match = false;
			}

			if ( $new_match )
			{
				switch( SQL_LAYER )
				{
					case 'mysql':
					case 'mysql4':
						$value_sql .= ( ( $value_sql != '' ) ? ', ' : '' ) . '(\'' . $word[$i] . '\', 0)';
						break;
					case 'mssql':
						$value_sql .= ( ( $value_sql != '' ) ? ' UNION ALL ' : '' ) . "SELECT '" . $word[$i] . "', 0";
						break;
					default:
						$sql = "INSERT INTO " . KB_WORD_TABLE . " (word_text, word_common) 
							VALUES ('" . $word[$i] . "', 0)"; 
						if( !$db->sql_query($sql) )
						{
							message_die(GENERAL_ERROR, 'Could not insert new word', '', __LINE__, __FILE__, $sql);
						}
						break;
				}
			}
		}

		if ( $value_sql != '' )
		{
			switch ( SQL_LAYER )
			{
				case 'mysql':
				case 'mysql4':
					$sql = "INSERT IGNORE INTO " . KB_WORD_TABLE . " (word_text, word_common) 
						VALUES $value_sql"; 
					break;
				case 'mssql':
					$sql = "INSERT INTO " . KB_WORD_TABLE . " (word_text, word_common) 
						$value_sql"; 
					break;
			}

			if ( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not insert new word', '', __LINE__, __FILE__, $sql);
			}
		}
	}

	while( list($word_in, $match_sql) = @each($word_insert_sql) )
	{
		$title_match = ( $word_in == 'title' ) ? 1 : 0;

		if ( $match_sql != '' )
		{
			$sql = "INSERT INTO " . KB_MATCH_TABLE . " (article_id, word_id, title_match) 
				SELECT $post_id, word_id, $title_match  
					FROM " . KB_WORD_TABLE . " 
					WHERE word_text IN ($match_sql)"; 
			if ( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not insert new word matches', '', __LINE__, __FILE__, $sql);
			}
		}
	}

	if ($mode == 'single')
	{
		remove_common('single', 4/10, $word);
	}

	return;
}

// MX add-on
// Generate paths for page and standalone mode
// ...function based on original function written by Markus :-)
function this_kb_mxurl($args = '', $force_standalone_mode = false)
{
	global $phpbb_root_path, $phpbb_root_path, $phpEx;

	$mxurl = $phpbb_root_path.'kb.'.$phpEx . ($args == '' ? '' : '?' . $args);

	return $mxurl;
}

// MX add-on
// Generate paths for page and standalone mode
// ...function based on original function written by Markus :-)
function this_kb_mxurl_search($args = '', $force_standalone_mode = false)
{
	global $phpbb_root_path, $phpbb_root_path, $phpEx;

	$mxurl = $phpbb_root_path.'kb_search.'.$phpEx . ($args == '' ? '' : '?' . $args);
	
	return $mxurl;
}

// MX add-on
// Check if user $user_id belongs to group $group_id
// ...function based on original function written by AbelaJohnB :-)
function is_group_member($group_id = '', $user_id = '')
{
	global $db;
	global $phpbb_root_path, $phpbb_root_path, $page_id, $phpEx, $is_block;

		if ( $user_id == '' || $group_id == '' )
		{
			message_die(GENERAL_ERROR, "no valid function call, is_group_member...", '', '', '', '');
		}

		// Check if user is member of the proper group..
		$sql="SELECT * FROM " . USER_GROUP_TABLE . " WHERE group_id='" . $group_id . "' AND user_id='" . $user_id . "' LIMIT 1";

		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, "Could not query group rights information", '', '', '', '');
		}

		if ($db->sql_numrows($result) == 0)
		{
			$is_member = FALSE;
		}
		else
		{
			$is_member = TRUE;
		}		
		
	return $is_member;
}

// Extract all post in the comments topic
//
function get_kb_comments($topic_id = '', $start = -1, $show_num_comments = 0 )
{
    global $db, $board_config, $template, $phpbb_root_path, $phpbb_root_path, $phpbb_root_path, $phpEx, $is_block, $page_id;

	if ($topic_id == '')
	{
		message_die(GENERAL_MESSAGE, 'no topic id');
	}

	$show_num_comments = $start == 0 ? $show_num_comments = $show_num_comments + 1 : $show_num_comments ;
	$start = $start > 0 ? $start = $start + 1: $start;
	
	//
	// Go ahead and pull all data for this topic
	//
	$sql = "SELECT u.username, u.user_id, u.user_posts, u.user_from, u.user_website, u.user_email, u.user_icq, u.user_aim, u.user_yim, u.user_regdate, u.user_msnm, u.user_viewemail, u.user_rank, u.user_sig, u.user_sig_bbcode_uid, u.user_avatar, u.user_avatar_type, u.user_allowavatar, u.user_allowsmile, p.*,  pt.post_text, pt.post_subject, pt.bbcode_uid
		FROM " . POSTS_TABLE . " p, " . USERS_TABLE . " u, " . POSTS_TEXT_TABLE . " pt
		WHERE p.topic_id = $topic_id
			AND pt.post_id = p.post_id
			AND u.user_id = p.poster_id
		ORDER BY p.post_time $post_time_order";
	
	if ( $start > -1 && $show_num_comments > 0 )
	{
		$sql .= " LIMIT $start, $show_num_comments ";
	}

	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, "Could not obtain post/user information.", '', __LINE__, __FILE__, $sql);
	}

	$postrow = array();
	if ($row = $db->sql_fetchrow($result))
	{
		do
		{
			$postrow[] = $row;
		}
		while ($row = $db->sql_fetchrow($result));
		$db->sql_freeresult($result);
		$total_posts = count($postrow);
	}
	else 
	{ 
  	 include_once($phpbb_root_path . 'includes/functions_admin.' . $phpEx); 
  	 sync('topic', $topic_id); 
  	 message_die(GENERAL_MESSAGE, $lang['No_posts_topic']); 
	} 	

//
// Okay, let's do the loop, yeah come on baby let's do the loop
// and it goes like this ...
//
$start == 0 ? $i_init = 1: $i_init = 0;

for($i = $i_init; $i < $total_posts; $i++)
{
	$poster_id = $postrow[$i]['user_id'];
	$poster = ( $poster_id == ANONYMOUS ) ? $lang['Guest'] : $postrow[$i]['username'];

	$post_date = create_date($board_config['default_dateformat'], $postrow[$i]['post_time'], $board_config['board_timezone']);

	$poster_posts = ( $postrow[$i]['user_id'] != ANONYMOUS ) ? $lang['Posts'] . ': ' . $postrow[$i]['user_posts'] : '';

	$poster_from = ( $postrow[$i]['user_from'] && $postrow[$i]['user_id'] != ANONYMOUS ) ? $lang['Location'] . ': ' . $postrow[$i]['user_from'] : '';

	$poster_joined = ( $postrow[$i]['user_id'] != ANONYMOUS ) ? $lang['Joined'] . ': ' . create_date($lang['DATE_FORMAT'], $postrow[$i]['user_regdate'], $board_config['board_timezone']) : '';
	//
	// Handle anon users posting with usernames
	//
	if ( $poster_id == ANONYMOUS && $postrow[$i]['post_username'] != '' )
	{
		$poster = $postrow[$i]['post_username'];
		$poster_rank = $lang['Guest'];
	}
	$post_subject = ( $postrow[$i]['post_subject'] != '' ) ? $postrow[$i]['post_subject'] : '';

	$message = $postrow[$i]['post_text'];
	$bbcode_uid = $postrow[$i]['bbcode_uid'];
	//
	// If the board has HTML off but the post has HTML
	// on then we process it, else leave it alone
	//
	if ( !$board_config['allow_html'] )
	{
		if ( $user_sig != '' && $userdata['user_allowhtml'] )
		{
			$user_sig = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", $user_sig);
		}

		if ( $postrow[$i]['enable_html'] )
		{
			$message = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", $message);
		}
	}

	//
	// Parse message and/or sig for BBCode if reqd
	//
	if ( $board_config['allow_bbcode'] )
	{
		if ( $user_sig != '' && $user_sig_bbcode_uid != '' )
		{
			$user_sig = ( $board_config['allow_bbcode'] ) ? bbencode_second_pass($user_sig, $user_sig_bbcode_uid) : preg_replace('/\:[0-9a-z\:]+\]/si', ']', $user_sig);
		}

		if ( $bbcode_uid != '' )
		{
			$message = ( $board_config['allow_bbcode'] ) ? bbencode_second_pass($message, $bbcode_uid) : preg_replace('/\:[0-9a-z\:]+\]/si', ']', $message);
		}
	}

	if ( $user_sig != '' )
	{
		$user_sig = make_clickable($user_sig);
	}
	$message = make_clickable($message);

	//
	// Parse smilies
	//
	if ( $board_config['allow_smilies'] )
	{
		if ( $postrow[$i]['user_allowsmile'] && $user_sig != '' )
		{
			$user_sig = smilies_pass($user_sig);
		}

		if ( $postrow[$i]['enable_smilies'] )
		{
			$message = smilies_pass($message);
		}
	}
	$message = str_replace("\n", "\n<br />\n", $message);
	//
	// Editing information
	//
	if ( $postrow[$i]['post_edit_count'] )
	{
		$l_edit_time_total = ( $postrow[$i]['post_edit_count'] == 1 ) ? $lang['Edited_time_total'] : $lang['Edited_times_total'];

		$l_edited_by = '<br /><br />' . sprintf($l_edit_time_total, $poster, create_date($board_config['default_dateformat'], $postrow[$i]['post_edit_time'], $board_config['board_timezone']), $postrow[$i]['post_edit_count']);
	}
	else
	{
		$l_edited_by = '';
	}
	
	$template->assign_block_vars('postrow', array(
		'POSTER_NAME' => $poster,
		'POSTER_FROM' => $poster_from,
		'POST_DATE' => $post_date,
		'POST_SUBJECT' => $post_subject,
		'MESSAGE' => $message,
		'EDITED_MESSAGE' => $l_edited_by,
		'U_POST_ID' => $postrow[$i]['post_id'])
	);	
}	

if ( $total_posts != 0 )
	{
    	$template->assign_block_vars('switch_comments_show', array());
		return $template;
	}
	
}

//
// get articles for the category
//
function get_kb_stats($type = false, $approve, $block_name)
{
    global $db, $template, $images, $phpEx, $phpbb_root_path, $phpbb_root_path, $phpbb_root_path, $board_config, $lang, $is_block, $page_id, $is_admin, $userdata;
	
	$sql = "SELECT * FROM " . KB_ARTICLES_TABLE . " WHERE";
	
	$sql .= " approved = " . $approve;

	if ( $type )
	{
		if ( $type == 'toprated' )
		{
	    	$sql .= " AND article_totalvotes > 0";
	    	$sql .= " ORDER BY article_rating/article_totalvotes DESC";
		}
		elseif ( $type == 'latest' )
		{
	    	$sql .= " ORDER BY article_date DESC";
		}
		elseif ( $type == 'mostpopular' )
		{
	    	$sql .= " AND views > 0";
	    	$sql .= " ORDER BY views DESC";
		}
	}
	
	if ( !($article_result = $db->sql_query($sql)) )
	{
	   message_die(GENERAL_ERROR, "Could not obtain article data", '', __LINE__, __FILE__, $sql);
	}

	$i=0;
	
	while($article = $db->sql_fetchrow($article_result))
	{	
		$i++;
		$article_description = $article['article_description'];
		$article_cat = $article['article_category_id'];
		$article_approved = $article['approved'];
		
	   //type
	   $type_id = $article['article_type'];	   
	   $article_type = get_kb_type($type_id);		
		
	   $article_date = create_date($board_config['default_dateformat'], $article['article_date'], $board_config['board_timezone']);
		
	   // author information
	   $author_id = $article['article_author_id'];
	   if ( $author_id == 0 )
	   {
	       $author = ( $username != '' ) ? $lang['Guest'] : $article['username'];
	   }
	   else
	   {
	       $author_name = get_kb_author($author_id);
	   
	       $temp_url = append_sid($phpbb_root_path . "profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=$author_id");
	       $author = '<a href="' . $temp_url . '" class="gen">' . $author_name . '</a>';
	   }
		
	   $article_id = $article['article_id'];
	   $views = $article['views'];
		
	   $article_title = $article['article_title'];
	   $temp_url = append_sid(this_kb_mxurl("mode=article&amp;k=$article_id"));
	   $article = '<a href="' . $temp_url . '" class="gen">' . $article_title . '</a>';
	   
	   $approve = '';
	   $delete = '';
	   $category_name = '';   

       $category = get_kb_cat($article_cat);
	   $category_id = $category['category_id'];
	   $category_name = $category['category_name'];
	   $category_temp = append_sid(this_kb_mxurl("mode=cat&amp;cat=$category_id"));
	   $category_url = '<a href="' . $category_temp . '" class="genmed">' . $category_name . '</a>';
	   
	   if ( defined('IN_ADMIN') || $userdata['user_level'] == ADMIN )
	   {
	       $category = get_kb_cat($article_cat);
		   $category_name = $category['category_name'];

		   if ( $article_approved == 2 || $article_approved == 0)
		   {
		       //approve
		   	   $temp_url = append_sid($phpbb_root_path . "kb.$phpEx?mode=moderate&action=approve&ref=stats&amp;a=$article_id");
		   	   $approve = '<a href="' . $temp_url . '"><img src="'. $images['icon_approve'] . '" border="0" alt="' . $lang['Approve'] . '"></a>';
		   }
		   elseif ( $article_approved == 1 )
		   {		   
			   //unapprove
			   $temp_url = append_sid($phpbb_root_path . "kb.$phpEx?mode=moderate&action=unapprove&ref=stats&amp;a=$article_id");
			   $approve = '<a href="' . $temp_url . '"><img src="'. $images['icon_unapprove'] . '" border="0" alt="' . $lang['Un_approve'] . '"></a>';
		   }
	
		   	//delete
		   	$temp_url = append_sid($phpbb_root_path . "kb.$phpEx?mode=moderate&action=delete&ref=stats&amp;a=$article_id");
		   	$delete = '<a href="' . $temp_url . '"><img src="'. $images['icon_delpost'] . '" border="0" alt="' . $lang['Delete'] . '"></a>';
	  }
	   
	if ($article['article_rating'] == 0 || $article['article_totalvotes'] == 0 )
	{
		$rating = 0;
		$rating_votes = 0;
		$rating_message = ''; 
	}
	else
	{
		$rating = round($postrow[$i]['link_rating']/$postrow[$i]['link_totalvotes'],2);
		$rating_votes = $postrow[$i]['link_totalvotes'];	
		$rating_message = '('.$rating.'/10, </span><span class="gensmall">'.$rating_votes.' votes)';	
		
	}
  
	   $template->assign_block_vars($block_name, array(
			'ARTICLE' => $article ,
			'ARTICLE_DESCRIPTION' => $article_description,
			'ARTICLE_TYPE' => $article_type,
			'ARTICLE_DATE' => $article_date,
			'ARTICLE_AUTHOR' => $author,
			'CATEGORY' => $category_url,
			'ART_VIEWS' => $views,
			'ART_VOTES' => $rating_message,

			'U_APPROVE' => $approve,
			'U_DELETE' => $delete)
		);
	}
   if ($i == 0)
   {
 	   $template->assign_block_vars('no_articles', array(
			'COMMENT' => $lang['No_Articles'])
		);
  
   }
   
	return $template;
}

?>
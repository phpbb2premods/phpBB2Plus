<?php
/***************************************************************************
 *                             admin_kb_config.php
 *                            -------------------
 *   begin                : Monday, Mar 31, 2003
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: admin_kb_config.php,v 1.8 2004/05/02 08:25:02 jonohlsson Exp $
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
	$file = basename(__FILE__);
	$module['KB_title']['Configuration'] = $file . '?mode=config';
	return;
}

//
// Load default header
//
$phpbb_root_path = "./../";
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);
include($phpbb_root_path . 'config.'.$phpEx);
require($phpbb_root_path . 'includes/kb_constants.' . $phpEx);
include($phpbb_root_path . 'includes/functions_admin.'.$phpEx);

function get_forums($sel_id)
{
 	global $db;

	$sql = "SELECT forum_id, forum_name
		FROM " . FORUMS_TABLE;
	
	
	if( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, "Couldn't get list of forums", "", __LINE__, __FILE__, $sql);
	}

	$forumlist = '<select name="forum_id">';

	while( $row = $db->sql_fetchrow($result) )
	{
		if ( $sel_id == $row['forum_id'] )
		{
		    $status = "selected";
		}
		else
		{
		    $status = '';
		}
		$forumlist .= '<option value="' .$row['forum_id'] . '" ' . $status . '>' . $row['forum_name'] . '</option>';
	}

	$forumlist .= '</select>';
	
	return $forumlist;
}

function get_groups($sel_id)
{
 	global $db;

	$sql = "SELECT group_id, group_name
		FROM " . GROUPS_TABLE;
	
	
	if( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, "Couldn't get list of groups", "", __LINE__, __FILE__, $sql);
	}

	$grouplist = '<select name="mod_group">';

	while( $row = $db->sql_fetchrow($result) )
	{ 
	  if ($row['group_name'] != '')
	  {	
		if ( $sel_id == $row['group_id'] )
		{
		    $status = "selected";
		}
		else
		{
		    $status = '';
		}
		$grouplist .= '<option value="' .$row['group_id'] . '" ' . $status . '>' . $row['group_name'] . '</option>';
	  }
	}

	$grouplist .= '</select>';
	
	return $grouplist;
}

	//
	// Pull all config data
	//
	$sql = "SELECT *
		 FROM " . KB_CONFIG_TABLE;
	if(!$result = $db->sql_query($sql))
	{
	 	message_die(CRITICAL_ERROR, "Could not query knowledge base configuration information", "", __LINE__, __FILE__, $sql);
	}
	else
	{
	 	while( $row = $db->sql_fetchrow($result) )
		{
		 	   $config_name = $row['config_name'];
			   $config_value = $row['config_value'];
			   $default_config[$config_name] = $config_value;
		
			   $new[$config_name] = ( isset($_POST[$config_name]) ) ? $_POST[$config_name] : $default_config[$config_name];

			   if( isset($_POST['submit']) )
			   {
			   	   $sql = "UPDATE " . KB_CONFIG_TABLE . " SET
				   		config_value = '" . str_replace("\'", "''", $new[$config_name]) . "'
						WHERE config_name = '$config_name'";
				   if( !$db->sql_query($sql) )
				   {
				   	   message_die(GENERAL_ERROR, "Failed to update general configuration for $config_name", "", __LINE__, __FILE__, $sql);
				   }
			   }
		}

		if( isset($_POST['submit']) )
		{
		 	$message = $lang['KB_config_updated'] . "<br /><br />" . sprintf($lang['Click_return_kb_config'], "<a href=\"" . append_sid("admin_kb_config.$phpEx?mode=config") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid($phpbb_root_path . "admin/index.$phpEx?pane=right") . "\">", "</a>");

			message_die(GENERAL_MESSAGE, $message);
	    }
	}
	$new_yes = ( $new['allow_new'] ) ? "checked=\"checked\"" : "";
	$new_no = ( !$new['allow_new'] ) ? "checked=\"checked\"" : "";
	
	$approve_new_yes = ( $new['approve_new'] ) ? "checked=\"checked\"" : "";
	$approve_new_no = ( !$new['approve_new'] ) ? "checked=\"checked\"" : "";

	$edit_yes = ( $new['allow_edit'] ) ? "checked=\"checked\"" : "";
	$edit_no = ( !$new['allow_edit'] ) ? "checked=\"checked\"" : "";
	
	$approve_edit_yes = ( $new['approve_edit'] ) ? "checked=\"checked\"" : "";
	$approve_edit_no = ( !$new['approve_edit'] ) ? "checked=\"checked\"" : "";

	$pretext_show = (  $new['show_pretext'] ) ? "checked=\"checked\"" : "";
	$pretext_hide = ( !$new['show_pretext'] ) ? "checked=\"checked\"" : "";

	$pt_header = $new['pt_header'];
	$pt_body = $new['pt_body'];

	$notify_none = ( $new['notify'] == 0 ) ? "checked=\"checked\"" : "";
	$notify_pm = ( $new['notify'] == 1 ) ? "checked=\"checked\"" : "";
	$notify_email = ( $new['notify'] == 2 ) ? "checked=\"checked\"" : "";
	
	$admin_id = $new['admin_id'];
	
	$comments_yes = (  $new['comments'] ) ? "checked=\"checked\"" : "";
	$comments_no = ( !$new['comments'] ) ? "checked=\"checked\"" : "";
	$forums = get_forums($new['forum_id']);

	$anon_yes = ( $new['allow_anon'] ) ? "checked=\"checked\"" : ""; 
    $anon_no = ( !$new['allow_anon'] ) ? "checked=\"checked\"" : "";
	
	$del_topic_yes = ( $new['del_topic'] ) ? "checked=\"checked\"" : ""; 
    $del_topic_no = ( !$new['del_topic'] ) ? "checked=\"checked\"" : "";

// Added by Haplo
	
	$comments_show_yes = (  $new['comments_show'] ) ? "checked=\"checked\"" : "";
	$comments_show_no = ( !$new['comments_show'] ) ? "checked=\"checked\"" : "";

	$bump_post_yes = ( $new['bump_post'] ) ? "checked=\"checked\"" : ""; 
    $bump_post_no = ( !$new['bump_post'] ) ? "checked=\"checked\"" : "";

	$stats_list_yes = ( $new['stats_list'] ) ? "checked=\"checked\"" : ""; 
    $stats_list_no = ( !$new['stats_list'] ) ? "checked=\"checked\"" : "";

	$header_banner_yes = ( $new['header_banner'] ) ? "checked=\"checked\"" : ""; 
    $header_banner_no = ( !$new['header_banner'] ) ? "checked=\"checked\"" : "";
	
	$mod_group = get_groups($new['mod_group']);

	$allow_rating_yes = ( $new['allow_rating'] ) ? "checked=\"checked\"" : ""; 
    $allow_rating_no = ( !$new['allow_rating'] ) ? "checked=\"checked\"" : "";

	$allow_anonymos_rating_yes = ( $new['allow_anonymos_rating'] ) ? "checked=\"checked\"" : ""; 
    $allow_anonymos_rating_no = ( !$new['allow_anonymos_rating'] ) ? "checked=\"checked\"" : "";

	$votes_check_ip_yes = ( $new['votes_check_ip'] ) ? "checked=\"checked\"" : ""; 
    $votes_check_ip_no = ( !$new['votes_check_ip'] ) ? "checked=\"checked\"" : "";

	$votes_check_userid_yes = ( $new['votes_check_userid'] ) ? "checked=\"checked\"" : ""; 
    $votes_check_userid_no = ( !$new['votes_check_userid'] ) ? "checked=\"checked\"" : "";

	$article_pag = $new['art_pagination'];

	$comments_pag = $new['comments_pagination'];

	$news_sort_options = array();
	$news_sort_options = array("Latest", "Creation", "Id", "Userrank", "Alphabetic");

	$news_sort_list = '<select name="news_sort">';
	for($j = 0; $j < count($news_sort_options); $j++)
	{
		if ( $new['news_sort'] == $news_sort_options[$j] )
		{
		    $status = "selected";
		}
		else
		{
		    $status = '';
		}
		$news_sort_list .= '<option value="' .$news_sort_options[$j] . '" ' . $status . '>' . $news_sort_options[$j] . '</option>';
	}
	$news_sort_list .= '</select>';

	$news_sort_par_options = array();
	$news_sort_par_options = array("DESC", "ASC");

	$news_sort_par_list = '<select name="news_sort_par">';
	for($j = 0; $j < count($news_sort_par_options); $j++)
	{
		if ( $new['news_sort_par'] == $news_sort_par_options[$j] )
		{
		    $status = "selected";
		}
		else
		{
		    $status = '';
		}
		$news_sort_par_list .= '<option value="' .$news_sort_par_options[$j] . '" ' . $status . '>' . $news_sort_par_options[$j] . '</option>';
	}
	$news_sort_par_list .= '</select>';

	$template->set_filenames(array(
		"body" => "admin/kb_config_body.tpl")
	);

	$template->assign_vars(array(
		'S_ACTION' => append_sid("admin_kb_config.$phpEx?mode=config"),
		'L_SUBMIT' => $lang['Submit'], 
		'L_RESET' => $lang['Reset'],
		
		'L_YES' => $lang['Yes'],
		'L_NO' => $lang['No'],
		'L_NONE' => $lang['Acc_None'], 
		
		'L_CONFIGURATION_TITLE' => $lang['KB_config_title'],
		'L_CONFIGURATION_EXPLAIN' => $lang['KB_config_explain'],
		
		'L_NEW_NAME' => $lang['New_title'],
		'L_NEW_EXPLAIN' => $lang['New_explain'],
		'S_NEW_YES' => $new_yes,
		'S_NEW_NO' => $new_no,
		
		'L_APPROVE_NEW_NAME' => $lang['Approve_new_name'],
		'L_APPROVE_NEW_EXPLAIN' => $lang['Approve_new_explain'],
		'S_APPROVE_NEW_YES' => $approve_new_yes,
		'S_APPROVE_NEW_NO' => $approve_new_no,
		
		'L_EDIT_NAME' => $lang['Edit_name'],
		'L_EDIT_EXPLAIN' => $lang['Edit_explain'],
		'S_EDIT_YES' => $edit_yes,
		'S_EDIT_NO' => $edit_no,

		'L_SHOW' => $lang['Show'],
		'L_HIDE' => $lang['Hide'],
		'L_PRE_TEXT_NAME' => $lang['Pre_text_name'],
		'L_PRE_TEXT_HEADER' => $lang['Pre_text_header'],
		'L_PRE_TEXT_BODY' => $lang['Pre_text_body'],
		'L_PRE_TEXT_EXPLAIN' => $lang['Pre_text_explain'],
		'S_SHOW_PRETEXT' => $pretext_show,
		'S_HIDE_PRETEXT' => $pretext_hide,
		'L_PT_HEADER' => $pt_header,
		'L_PT_BODY' => $pt_body,
				
		'L_APPROVE_EDIT_NAME' => $lang['Approve_edit_name'],
		'L_APPROVE_EDIT_EXPLAIN' => $lang['Approve_edit_explain'],
		'S_APPROVE_EDIT_YES' => $approve_edit_yes,
		'S_APPROVE_EDIT_NO' => $approve_edit_no,
		
		'L_NOTIFY_NAME' => $lang['Notify_name'],
		'L_NOTIFY_EXPLAIN' => $lang['Notify_explain'],
		'L_EMAIL' => $lang['Email'],
		'L_PM' => $lang['PM'],
		'S_NOTIFY_NONE' => $notify_none,
		'S_NOTIFY_EMAIL' => $notify_email,
		'S_NOTIFY_PM' => $notify_pm,
		
		'L_ADMIN_ID_NAME' => $lang['Admin_id_name'],
		'L_ADMIN_ID_EXPLAIN' => $lang['Admin_id_explain'],
		'ADMIN_ID' => $admin_id,
		
		'L_COMMENTS' => $lang['Allow_comments'],
		'L_COMMENTS_EXPLAIN' => $lang['Allow_comments_explain'],
		'S_COMMENTS_YES' => $comments_yes,
		'S_COMMENTS_NO' => $comments_no,
		
		'L_FORUM_ID' => $lang['Forum_id'],
		'L_FORUM_ID_EXPLAIN' => $lang['Forum_id_explain'],
		'FORUMS' => $forums,

// Added by Haplo
		'L_RATINGS_INFO' => $lang['Rating_info'],
		'L_COMMENTS_INFO' => $lang['Comment_info'],
		
		'L_COMMENTS_SHOW' => $lang['Comments_show'],
		'L_COMMENTS_SHOW_EXPLAIN' => $lang['Comments_show_explain'],
		'S_COMMENTS_SHOW_YES' => $comments_show_yes,
		'S_COMMENTS_SHOW_NO' => $comments_show_no,

		'L_MOD_GROUP' => $lang['Mod_group'],
		'L_MOD_GROUP_EXPLAIN' => $lang['Mod_group_explain'],
		'MOD_GROUP' => $mod_group,

		'L_BUMP_POST' => $lang['Bump_post'], 
      	'L_BUMP_POST_EXPLAIN' => $lang['Bump_post_explain'], 
        'S_BUMP_POST_YES' => $bump_post_yes, 
        'S_BUMP_POST_NO' => $bump_post_no,

		'L_STATS_LIST' => $lang['Stats_list'], 
      	'L_STATS_LIST_EXPLAIN' => $lang['Stats_list_explain'], 
        'S_STATS_LIST_YES' => $stats_list_yes, 
        'S_STATS_LIST_NO' => $stats_list_no,

		'L_HEADER_BANNER' => $lang['Header_banner'], 
      	'L_HEADER_BANNER_EXPLAIN' => $lang['Header_banner_explain'], 
        'S_HEADER_BANNER_YES' => $header_banner_yes, 
        'S_HEADER_BANNER_NO' => $header_banner_no,
		
		'L_ANON_NAME' => $lang['Allow_anon_name'], 
      	'L_ANON_EXPLAIN' => $lang['Allow_anon_explain'], 
        'S_ANON_YES' => $anon_yes, 
        'S_ANON_NO' => $anon_no,
		
		'L_ALLOW_RATING' => $lang['Allow_rating'], 
      	'L_ALLOW_RATING_EXPLAIN' => $lang['Allow_rating_explain'], 
        'S_ALLOW_RATING_YES' => $allow_rating_yes, 
        'S_ALLOW_RATING_NO' => $allow_rating_no,

		'L_ALLOW_ANONYMOS_RATING' => $lang['Allow_anonymos_rating'], 
      	'L_ALLOW_ANONYMOS_RATING_EXPLAIN' => $lang['Allow_anonymos_rating_explain'], 
        'S_ALLOW_ANONYMOS_RATING_YES' => $allow_anonymos_rating_yes, 
        'S_ALLOW_ANONYMOS_RATING_NO' => $allow_anonymos_rating_no,

		'L_VOTES_CHECK_IP' => $lang['Votes_check_ip'], 
      	'L_VOTES_CHECK_IP_EXPLAIN' => $lang['Votes_check_ip_explain'], 
        'S_VOTES_CHECK_IP_YES' => $votes_check_ip_yes, 
        'S_VOTES_CHECK_IP_NO' => $votes_check_ip_no,

		'L_VOTES_CHECK_USERID' => $lang['Votes_check_userid'], 
      	'L_VOTES_CHECK_USERID_EXPLAIN' => $lang['Votes_check_userid_explain'], 
        'S_VOTES_CHECK_USERID_YES' => $votes_check_userid_yes, 
        'S_VOTES_CHECK_USERID_NO' => $votes_check_userid_no,

		'L_ARTICLE_PAG' => $lang['Article_pag'],
		'L_ARTICLE_PAG_EXPLAIN' => $lang['Article_pag_explain'],
		'ARTICLE_PAG' => $article_pag,

		'L_COMMENTS_PAG' => $lang['Comments_pag'],
		'L_COMMENTS_PAG_EXPLAIN' => $lang['Comments_pag_explain'],
		'COMMENTS_PAG' => $comments_pag,

		'L_NEWS_SORT' => $lang['News_sort'],
		'L_NEWS_SORT_EXPLAIN' => $lang['News_sort_explain'],
		'NEWS_SORT' => $news_sort_list,

		'L_NEWS_SORT_PAR' => $lang['News_sort_par'],
		'L_NEWS_SORT_PAR_EXPLAIN' => $lang['News_sort_par_explain'],
		'NEWS_SORT_PAR' => $news_sort_par_list,

 		'L_DEL_TOPIC' => $lang['Del_topic'],
		'L_DEL_TOPIC_EXPLAIN' => $lang['Del_topic_explain'],
		'S_DEL_TOPIC_YES' => $del_topic_yes,
		'S_DEL_TOPIC_NO' => $del_topic_no)
	);	

$template->pparse('body');

include('./page_footer_admin.'.$phpEx);

?>
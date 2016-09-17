<?php
/***************************************************************************
 *                                posting.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: posting.php,v 1.159.2.21 2004/03/13 15:08:22 acydburn Exp $
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
/*
	png visual confirmation system : (c) phpBB Group, 2003 : All Rights Reserved
*/

define('IN_PHPBB', true);
$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);
include($phpbb_root_path . 'includes/bbcode.'.$phpEx);
include($phpbb_root_path . 'includes/functions_post.'.$phpEx);
//-- mod : post icon -------------------------------------------------------------------------------
//-- add
include($phpbb_root_path . 'includes/def_icons.'.$phpEx);
//-- fin mod : post icon ---------------------------------------------------------------------------
//-- add
include_once($phpbb_root_path . 'includes/functions_calendar.'.$phpEx);
//-- fin mod : calendar ---------------------------------------------------------------------------- 
include($phpbb_root_path . 'includes/functions_bookmark.'.$phpEx);
//
// Check and set various parameters
//
$params = array('submit' => 'post', 'news_category' => 'news_category', 'preview' => 'preview', 'delete' => 'delete', 'poll_delete' => 'poll_delete', 'poll_add' => 'add_poll_option', 'poll_edit' => 'edit_poll_option', 'mode' => 'mode');
while( list($var, $param) = @each($params) )
{
	if ( !empty($_POST[$param]) || !empty($_GET[$param]) )
	{
		$$var = ( !empty($_POST[$param]) ) ? htmlspecialchars($_POST[$param]) : htmlspecialchars($_GET[$param]);
	}
	else
	{
		$$var = '';
	}
}

$confirm = isset($_POST['confirm']) ? true : false;
$sid = (isset($_POST['sid'])) ? $_POST['sid'] : 0;

$params = array('forum_id' => POST_FORUM_URL, 'topic_id' => POST_TOPIC_URL, 'post_id' => POST_POST_URL, 'lock_subject' => 'lock_subject');
while( list($var, $param) = @each($params) )
{
	if ( !empty($_POST[$param]) || !empty($_GET[$param]) )
	{
		$$var = ( !empty($_POST[$param]) ) ? intval($_POST[$param]) : intval($_GET[$param]);
	}
	else
	{
		$$var = '';
	}
}

$refresh = $preview || $poll_add || $poll_edit || $poll_delete;
$orig_word = $replacement_word = array();
//-- mod : post icon -------------------------------------------------------------------------------
//-- add
$post_icon = isset($_POST['post_icon']) ? intval($_POST['post_icon']) : 0;
//-- fin mod : post icon ---------------------------------------------------------------------------

//
// Set topic type
//
$topic_type = ( !empty($_POST['topictype']) ) ? intval($_POST['topictype']) : POST_NORMAL;
$topic_type = ( in_array($topic_type, array(POST_NORMAL, POST_STICKY, POST_ANNOUNCE, POST_GLOBAL_ANNOUNCE)) ) ? $topic_type : POST_NORMAL;
//-- mod : calendar --------------------------------------------------------------------------------
//-- add
$year	= ( !empty($_POST['topic_calendar_year']) ) ? intval($_POST['topic_calendar_year']) : '';
$month	= ( !empty($_POST['topic_calendar_month']) ) ? intval($_POST['topic_calendar_month']) : '';
$day	= ( !empty($_POST['topic_calendar_day']) ) ? intval($_POST['topic_calendar_day']) : '';
$hour	= ( !empty($_POST['topic_calendar_hour']) ) ? intval($_POST['topic_calendar_hour']) : '';
$min	= ( !empty($_POST['topic_calendar_min']) ) ? intval($_POST['topic_calendar_min']) : '';
$d_day	= ( !empty($_POST['topic_calendar_duration_day']) ) ? intval($_POST['topic_calendar_duration_day']) : '';
$d_hour	= ( !empty($_POST['topic_calendar_duration_hour']) ) ? intval($_POST['topic_calendar_duration_hour']) : '';
$d_min	= ( !empty($_POST['topic_calendar_duration_min']) ) ? intval($_POST['topic_calendar_duration_min']) : '';
if ( empty($year) || empty($month) || empty($day) )
{
	$year = '';
	$month = '';
	$day = '';
	$hour = '';
	$min = '';
	$d_day = '';
	$d_hour = '';
	$d_min = '';
}
if (empty($hour) && empty($min))
{
	$hour = '';
	$min = '';
	$d_hour = '';
	$d_min = '';
}

// start event
$topic_calendar_time = 0;
if (!empty($year))
{
	$topic_calendar_time = mktime( intval($hour), intval($min), 0, intval($month), intval($day), intval($year) );
}

// duration
$topic_calendar_duration = 0;
$d_dur = $d_day . $d_hour . $d_min;
if ( !empty($topic_calendar_time) && !empty($d_dur) )
{
	$topic_calendar_duration = intval($d_day) * 86400 + intval($d_hour) * 3600 + intval($d_min) * 60;
	if ($topic_calendar_duration < 0)
	{
		$topic_calendar_duration = 0;
	}
}
//-- fin mod : calendar ----------------------------------------------------------------------------

//-- mod : announces -------------------------------------------------------------------------------
//-- add
$topic_announce_duration = ( !empty($_POST['topicduration']) ) ? intval($_POST['topicduration']) : 0;
if (in_array($topic_type, array(POST_ANNOUNCE, POST_GLOBAL_ANNOUNCE)))
{
	if (empty($topic_announce_duration)) $topic_announce_duration = $board_config['announcement_duration'];
}
else
{
	$topic_announce_duration = 0;
}
//-- fin mod : announces ---------------------------------------------------------------------------

//
// If the mode is set to topic review then output
// that review ...
//
if ( $mode == 'topicreview' )
{
	require($phpbb_root_path . 'includes/topic_review.'.$phpEx);

	topic_review($topic_id, false);
	exit;
}
else if ( $mode == 'smilies' )
{
	generate_smilies('window', PAGE_POSTING);
	exit;
}

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_POSTING);
init_userprefs($userdata);
//
// End session management
//

//
// Was cancel pressed? If so then redirect to the appropriate
// page, no point in continuing with any further checks
//
if ( isset($_POST['cancel']) )
{
	if ( $postreport )
{
	$redirect = 'viewtopic.$phpEx?' . POST_POST_URL . '=$postreport';
	$post_append = '';
} else
	if ( $post_id )
	{
		$redirect = "viewtopic.$phpEx?" . POST_POST_URL . "=$post_id";
		$post_append = "#$post_id";
	}
	else if ( $topic_id )
	{
		$redirect = "viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id";
		$post_append = '';
	}
	else if ( $forum_id )
	{
		$redirect = "viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id";
		$post_append = '';
	}
	else
	{
		$redirect = "index.$phpEx";
		$post_append = '';
	}

	redirect(append_sid($redirect, true) . $post_append);
}

//
// What auth type do we need to check?
//
$is_auth = array();
//-- mod : calendar --------------------------------------------------------------------------------
//-- add
$is_auth_type = '';
$is_auth_type_cal = '';
//-- fin mod : calendar ----------------------------------------------------------------------------

switch( $mode )
{
	case 'newtopic':
		if ( $topic_type == POST_ANNOUNCE )
		{
			$is_auth_type = 'auth_announce';
		}
		//-- mod : announces -------------------------------------------------------------------------------
//-- add
		else if ( $topic_type == POST_GLOBAL_ANNOUNCE )
		{
			$is_auth_type = 'auth_global_announce';
		}
//-- fin mod : announces ---------------------------------------------------------------------------

		else if ( $topic_type == POST_STICKY )
		{
			$is_auth_type = 'auth_sticky';
		}
		else
		{
			$is_auth_type = 'auth_post';
		}
		//-- mod : calendar --------------------------------------------------------------------------------
//-- add
		if (!empty($topic_calendar_time))
		{
			$is_auth_type_cal = 'auth_cal';
		}
//-- fin mod : calendar ----------------------------------------------------------------------------

		break;
	case 'reply':
	case 'quote':
		$is_auth_type = 'auth_reply';
		break;
	case 'editpost':
		$is_auth_type = 'auth_edit';
		break;
	case 'delete':
	case 'poll_delete':
		$is_auth_type = 'auth_delete';
		break;
	case 'vote':
		$is_auth_type = 'auth_vote';
		break;
	case 'topicreview':
		$is_auth_type = 'auth_read';
		break;
	default:
		message_die(GENERAL_MESSAGE, $lang['No_post_mode']);
		break;
}

//
// Here we do various lookups to find topic_id, forum_id, post_id etc.
// Doing it here prevents spoofing (eg. faking forum_id, topic_id or post_id
//
$error_msg = '';
$post_data = array();
switch ( $mode )
{
	case 'newtopic':
		if ( empty($forum_id) )
		{
			message_die(GENERAL_MESSAGE, $lang['Forum_not_exist']);
		}

		$sql = "SELECT * 
			FROM " . FORUMS_TABLE . " 
			WHERE forum_id = $forum_id";
		break;

	case 'reply':
	case 'vote':
		if ( empty( $topic_id) )
		{
			message_die(GENERAL_MESSAGE, $lang['No_topic_id']);
		}

		$sql = "SELECT f.*, t.topic_status, t.topic_title, t.topic_type  
			FROM " . FORUMS_TABLE . " f, " . TOPICS_TABLE . " t
			WHERE t.topic_id = $topic_id
				AND f.forum_id = t.forum_id";
		break;

	case 'quote':
	case 'editpost':
	case 'delete':
	case 'poll_delete':
		if ( empty($post_id) )
		{
			message_die(GENERAL_MESSAGE, $lang['No_post_id']);
		}
		//-- mod : announces -------------------------------------------------------------------------------
// here we added
//	, t.topic_announce_duration
//-- modify
//-- mod : post icon -------------------------------------------------------------------------------
// here we added
//	, t.topic_icon
//	, p.post_icon
//-- modify
//-- mod : calendar --------------------------------------------------------------------------------
// here we added
//	, t.topic_calendar_time, t.topic_calendar_duration
//-- modify

		$select_sql = (!$submit) ? ', t.topic_title, t.topic_desc, t.news_id, t.topic_calendar_time, t.topic_calendar_duration, t.topic_icon, t.topic_announce_duration, p.enable_bbcode, p.enable_html, p.enable_smilies, p.enable_sig, p.post_username, pt.post_subject, p.post_icon, pt.post_text, pt.bbcode_uid, u.username, u.user_id, u.user_sig, u.user_sig_bbcode_uid' : '';
		$from_sql = ( !$submit ) ? ", " . POSTS_TEXT_TABLE . " pt, " . USERS_TABLE . " u" : '';
		$where_sql = ( !$submit ) ? "AND pt.post_id = p.post_id AND u.user_id = p.poster_id" : '';

		$sql = "SELECT f.*, t.topic_id, t.topic_status, t.topic_type, t.topic_first_post_id, t.topic_last_post_id, t.topic_vote, p.post_id, p.poster_id" . $select_sql . " 
			FROM " . POSTS_TABLE . " p, " . TOPICS_TABLE . " t, " . FORUMS_TABLE . " f" . $from_sql . " 
			WHERE p.post_id = $post_id 
				AND t.topic_id = p.topic_id 
				AND f.forum_id = p.forum_id
				$where_sql";
		break;

	default:
		message_die(GENERAL_MESSAGE, $lang['No_valid_mode']);
}

if ( ($result = $db->sql_query($sql)) && ($post_info = $db->sql_fetchrow($result)) )
{
	$db->sql_freeresult($result);

	$forum_id = $post_info['forum_id'];
	//-- mod : categories hierarchy --------------------------------------------------------------------
//-- delete
//	$forum_name = $post_info['forum_name'];
//-- add
	$forum_name = get_object_lang(POST_FORUM_URL . $post_info['forum_id'], 'name');
//-- fin mod : categories hierarchy ----------------------------------------------------------------
	//-- mod : calendar --------------------------------------------------------------------------------
//-- add
	if (!empty($post_info['topic_calendar_duration']))
	{
		$post_info['topic_calendar_duration']++;
	}
//-- fin mod : calendar ----------------------------------------------------------------------------

	$is_auth = auth(AUTH_ALL, $forum_id, $userdata, $post_info);

	if ( $post_info['forum_status'] == FORUM_LOCKED && !$is_auth['auth_mod']) 
	{ 
	   message_die(GENERAL_MESSAGE, $lang['Forum_locked']); 
	} 
	else if ( $mode != 'newtopic' && $post_info['topic_status'] == TOPIC_LOCKED && !$is_auth['auth_mod']) 
	{ 
	   message_die(GENERAL_MESSAGE, $lang['Topic_locked']); 
	} 

	if ( $mode == 'editpost' || $mode == 'delete' || $mode == 'poll_delete' )
	{
		$topic_id = $post_info['topic_id'];

		$post_data['poster_post'] = ( $post_info['poster_id'] == $userdata['user_id'] ) ? true : false;
		$post_data['first_post'] = ( $post_info['topic_first_post_id'] == $post_id ) ? true : false;
		$post_data['last_post'] = ( $post_info['topic_last_post_id'] == $post_id ) ? true : false;
		$post_data['last_topic'] = ( $post_info['forum_last_post_id'] == $post_id ) ? true : false;
		$post_data['has_poll'] = ( $post_info['topic_vote'] ) ? true : false; 
		$post_data['topic_type'] = $post_info['topic_type'];
		//-- mod : calendar --------------------------------------------------------------------------------
//-- add
		$post_data['topic_calendar_time'] = $post_info['topic_calendar_time'];
		$post_data['topic_calendar_duration'] = $post_info['topic_calendar_duration'];
//-- fin mod : calendar ----------------------------------------------------------------------------

		//-- mod : post icon -------------------------------------------------------------------------------
//-- add
		$post_data['post_icon'] = $post_info['post_icon'];
//-- fin mod : post icon ---------------------------------------------------------------------------

		//-- mod : announces -------------------------------------------------------------------------------
//-- add
		$post_data['topic_announce_duration'] = $post_info['topic_announce_duration'];
//-- fin mod : announces ---------------------------------------------------------------------------

		$post_data['poster_id'] = $post_info['poster_id'];

		if ( $post_data['first_post'] && $post_data['has_poll'] )
		{
			$sql = "SELECT * 
				FROM " . VOTE_DESC_TABLE . " vd, " . VOTE_RESULTS_TABLE . " vr 
				WHERE vd.topic_id = $topic_id 
					AND vr.vote_id = vd.vote_id 
				ORDER BY vr.vote_option_id";
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not obtain vote data for this topic', '', __LINE__, __FILE__, $sql);
			}

			$poll_options = array();
			$poll_results_sum = 0;
			if ( $row = $db->sql_fetchrow($result) )
			{
				$poll_title = $row['vote_text'];
				$poll_id = $row['vote_id'];
				$poll_length = $row['vote_length'] / 86400;

				do
				{
					$poll_options[$row['vote_option_id']] = $row['vote_option_text']; 
					$poll_results_sum += $row['vote_result'];
				}
				while ( $row = $db->sql_fetchrow($result) );
			}
			$db->sql_freeresult($result);

			$post_data['edit_poll'] = ( ( !$poll_results_sum || $is_auth['auth_mod'] ) && $post_data['first_post'] ) ? true : 0;
		}
		else 
		{
			$post_data['edit_poll'] = ($post_data['first_post'] && $is_auth['auth_pollcreate']) ? true : false;
		}
		
		//
		// Can this user edit/delete the post/poll?
		//
		if ( $post_info['poster_id'] != $userdata['user_id'] && !$is_auth['auth_mod'] )
		{
			$message = ( $delete || $mode == 'delete' ) ? $lang['Delete_own_posts'] : $lang['Edit_own_posts'];
			$message .= '<br /><br />' . sprintf($lang['Click_return_topic'], '<a href="' . append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id") . '">', '</a>');

			message_die(GENERAL_MESSAGE, $message);
		}
		else if ( !$post_data['last_post'] && !$is_auth['auth_mod'] && ( $mode == 'delete' || $delete ) )
		{
			message_die(GENERAL_MESSAGE, $lang['Cannot_delete_replied']);
		}
		else if ( !$post_data['edit_poll'] && !$is_auth['auth_mod'] && ( $mode == 'poll_delete' || $poll_delete ) )
		{
			message_die(GENERAL_MESSAGE, $lang['Cannot_delete_poll']);
		}
	}
	else
	{
		if ( $mode == 'quote' )
		{
			$topic_id = $post_info['topic_id'];
		}
		if ( $mode == 'newtopic' )
		{
			$post_data['topic_type'] = POST_NORMAL;
		}

		$post_data['first_post'] = ( $mode == 'newtopic' ) ? true : 0;
		$post_data['last_post'] = false;
		$post_data['has_poll'] = false;
		$post_data['edit_poll'] = false;
	}
	if ( $mode == 'poll_delete' && !isset($poll_id) )
	{
		message_die(GENERAL_MESSAGE, $lang['No_such_post']);
	}
	// BEGIN cmx_slash_news_mod
	//if( $board_config['allow_news'] && $post_data['first_post'] &&  $is_auth['auth_post'] && ($is_auth['auth_news'] || ( $is_auth['auth_mod'] && $mode == 'editpost') ) )
	if( $board_config['allow_news'] && $post_data['first_post'] &&  $is_auth['auth_post'] && $is_auth['auth_news'] )
	{
		if( $mode == 'editpost' )
		{
			$post_data['news_id'] = $post_info['news_id'];
		}
		else
		{
			$post_data['news_id'] = 0;
		}
		$post_data['disp_news'] = true;
	}
	else
	{
		$post_data['disp_news'] = false;
	}
// END cmx_slash_news_mod 
}
else
{
	message_die(GENERAL_MESSAGE, $lang['No_such_post']);
}

//
// The user is not authed, if they're not logged in then redirect
// them, else show them an error message
//
//-- mod : calendar --------------------------------------------------------------------------------
// here we added
//	 || (!empty($is_auth_type_cal) && !$is_auth[$is_auth_type_cal])
//-- modify

if ( !$is_auth[$is_auth_type] || (!empty($is_auth_type_cal) && !$is_auth[$is_auth_type_cal]) )
{
	if ( $userdata['session_logged_in'] )
	{
		//-- mod : calendar --------------------------------------------------------------------------------
//-- add
		if (!empty($is_auth_type_cal) && !$is_auth[$is_auth_type_cal])
		{
			message_die(GENERAL_MESSAGE, sprintf($lang['Sorry_' . $is_auth_type_cal], $is_auth[$is_auth_type_cal . "_type"]));
		}
//-- fin mod : calendar ----------------------------------------------------------------------------

		message_die(GENERAL_MESSAGE, sprintf($lang['Sorry_' . $is_auth_type], $is_auth[$is_auth_type . "_type"]));
	}

	switch( $mode )
	{
		case 'newtopic':
			$redirect = "mode=newtopic&" . POST_FORUM_URL . "=" . $forum_id;
			break;
		case 'reply':
		case 'topicreview':
			$redirect = "mode=reply&" . POST_TOPIC_URL . "=" . $topic_id;
			break;
		case 'quote':
		case 'editpost':
			$redirect = "mode=quote&" . POST_POST_URL ."=" . $post_id;
			break;
	}
	$redirect .= ($post_reportid) ? '&post_reportid=$post_reportid' : '';
	redirect(append_sid("login.$phpEx?redirect=posting.$phpEx&" . $redirect, true));
}

//
// Set toggles for various options
//
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

if ( ($submit || $refresh) && $is_auth['auth_read'])
{
	$notify_user = ( !empty($_POST['notify']) ) ? TRUE : 0;
}
else
{
	if ( $mode != 'newtopic' && $userdata['session_logged_in'] && $is_auth['auth_read'] )
	{
		$sql = "SELECT topic_id 
			FROM " . TOPICS_WATCH_TABLE . "
			WHERE topic_id = $topic_id 
				AND user_id = " . $userdata['user_id'];
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not obtain topic watch information', '', __LINE__, __FILE__, $sql);
		}

		$notify_user = ( $db->sql_fetchrow($result) ) ? TRUE : $userdata['user_notify'];
		$db->sql_freeresult($result);
	}
	else
	{
		$notify_user = ( $userdata['session_logged_in'] && $is_auth['auth_read'] ) ? $userdata['user_notify'] : 0;
	}
}

$attach_sig = ( $submit || $refresh ) ? ( ( !empty($_POST['attach_sig']) ) ? TRUE : 0 ) : ( ( $userdata['user_id'] == ANONYMOUS ) ? 0 : $userdata['user_attachsig'] );
$setbm = ( $submit || $refresh ) ? ( ( !empty($_POST['setbm']) ) ? TRUE : 0 ) : ( ( $userdata['user_id'] == ANONYMOUS ) ? 0 : $userdata['user_setbm'] );
execute_posting_attachment_handling();
// --------------------
//  What shall we do?
//
// BEGIN cmx_slash_news_mod
//
// Get News Categories.
//
if( $userdata['session_logged_in'] && $post_data['disp_news'] )
{
	if ( $mode == 'edit' && empty($post_id) )
	{
		message_die(GENERAL_MESSAGE, $lang['No_post_id']);
	}

 	$sql = 'SELECT n.* FROM ' . NEWS_TABLE . ' n WHERE 1 ORDER BY n.news_category';

	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not obtain news data', '', __LINE__, __FILE__, $sql);
	}

	$news_sel = array();
	$news_cat = array();
	while ( $row = $db->sql_fetchrow($result) )
	{
		if( ($news_category > 0 && $news_category == $row['news_id']) || 
		    ($post_data['news_id'] > 0 && $post_data['news_id'] == $row['news_id']) )
		{
				$news_sel = $row;
		}
		
		if( $post_data['news_id'] != 0 && $post_data['news_id'] == $row['news_id'] )
		{
			$news_sel = $row;
		}
		$news_cat[] = $row;
	}
	
	if( $post_data['news_id'] == 0 && $news_category == 0)
	{
		$boxstring = '<option value="0">' . $lang['Regular_Post'] . '</option>';
	}
	else
	{
		$boxstring = '<option value="' . $news_sel['news_id'] .'">' . $news_sel['news_category'] . ' (' . $lang['Current_Selection'] . ')</option>';
		$boxstring .= '<option value="0">' . $lang['Regular_Post'] . '</option>';
	} 

	if( count( $news_cat ) > 0 )
	{
		for( $i = 0; $i < count( $news_cat ); $i++ )
		{
			if( $news_cat[$i]['news_id'] != $post_data['news_id'] )
			{
				$boxstring .= '<option value="' . $news_cat[$i]['news_id'] . '">' . $news_cat[$i]['news_category'] . '</option>';
			}
		}

		$template->assign_block_vars('switch_news_cat', array(
			'L_NEWS_CATEGORY' => $lang['Select_News_Category'],
			'S_NAME' => 'news_category',
			'S_CATEGORY_BOX' => $boxstring
		));
	}
}
// END cmx_slash_news_mod
if ( ( $delete || $poll_delete || $mode == 'delete' ) && !$confirm )
{
	//
	// Confirm deletion
	//
	$s_hidden_fields = '<input type="hidden" name="' . POST_POST_URL . '" value="' . $post_id . '" />';
	$s_hidden_fields .= ( $delete || $mode == "delete" ) ? '<input type="hidden" name="mode" value="delete" />' : '<input type="hidden" name="mode" value="poll_delete" />';
	$s_hidden_fields .= '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" />';

	$l_confirm = ( $delete || $mode == 'delete' ) ? $lang['Confirm_delete'] : $lang['Confirm_delete_poll'];

	//
	// Output confirmation page
	//
	include($phpbb_root_path . 'includes/page_header.'.$phpEx);

	$template->set_filenames(array(
		'confirm_body' => 'confirm_body.tpl')
	);

	$template->assign_vars(array(
		'MESSAGE_TITLE' => $lang['Information'],
		'MESSAGE_TEXT' => $l_confirm,

		'L_YES' => $lang['Yes'],
		'L_NO' => $lang['No'],

		'S_CONFIRM_ACTION' => append_sid("posting.$phpEx"),
		'S_HIDDEN_FIELDS' => $s_hidden_fields)
	);

	$template->pparse('confirm_body');

	include($phpbb_root_path . 'includes/page_tail.'.$phpEx);
}
else if ( $mode == 'vote' )
{
	//
	// Vote in a poll
	//
	if ( !empty($_POST['vote_id']) )
	{
		$vote_option_id = intval($_POST['vote_id']);

		$sql = "SELECT vd.vote_id    
			FROM " . VOTE_DESC_TABLE . " vd, " . VOTE_RESULTS_TABLE . " vr
			WHERE vd.topic_id = $topic_id 
				AND vr.vote_id = vd.vote_id 
				AND vr.vote_option_id = $vote_option_id
			GROUP BY vd.vote_id";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not obtain vote data for this topic', '', __LINE__, __FILE__, $sql);
		}

		if ( $vote_info = $db->sql_fetchrow($result) )
		{
			$vote_id = $vote_info['vote_id'];

			$sql = "SELECT * 
				FROM " . VOTE_USERS_TABLE . "  
				WHERE vote_id = $vote_id 
					AND vote_user_id = " . $userdata['user_id'];
			if ( !($result2 = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not obtain user vote data for this topic', '', __LINE__, __FILE__, $sql);
			}

			if ( !($row = $db->sql_fetchrow($result2)) )
			{
				$sql = "UPDATE " . VOTE_RESULTS_TABLE . " 
					SET vote_result = vote_result + 1 
					WHERE vote_id = $vote_id 
						AND vote_option_id = $vote_option_id";
				if ( !$db->sql_query($sql, BEGIN_TRANSACTION) )
				{
					message_die(GENERAL_ERROR, 'Could not update poll result', '', __LINE__, __FILE__, $sql);
				}

				$sql = "INSERT INTO " . VOTE_USERS_TABLE . " (vote_id, vote_user_id, vote_user_ip) 
					VALUES ($vote_id, " . $userdata['user_id'] . ", '$user_ip')";
				if ( !$db->sql_query($sql, END_TRANSACTION) )
				{
					message_die(GENERAL_ERROR, "Could not insert user_id for poll", "", __LINE__, __FILE__, $sql);
				}

				$message = $lang['Vote_cast'];
			}
			else
			{
				$message = $lang['Already_voted'];
			}
			$db->sql_freeresult($result2);
		}
		else
		{
			$message = $lang['No_vote_option'];
		}
		$db->sql_freeresult($result);

		$template->assign_vars(array(
			'META' => '<meta http-equiv="refresh" content="3;url=' . append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id") . '">')
		);
		$message .=  '<br /><br />' . sprintf($lang['Click_view_message'], '<a href="' . append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id") . '">', '</a>');
		message_die(GENERAL_MESSAGE, $message);
	}
	else
	{
		redirect(append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id", true));
	}
}
else if ( $submit || $confirm )
{
	//
	// Submit post/vote (newtopic, edit, reply, etc.)
	//
	$return_message = '';
	$return_meta = '';
	// session id check
	if ($sid == '' || $sid != $userdata['session_id'])
	{
		$error_msg .= (!empty($error_msg)) ? '<br />' . $lang['Session_invalid'] : $lang['Session_invalid'];
	}
	switch ( $mode )
	{
		case 'editpost':
		case 'newtopic':
		case 'reply':
			if ( $plus_config['enable_confirm_post'] && !$userdata['session_logged_in'] )
			{
				if ( empty($_POST['confirm_id']) || empty($_POST['confirm_code']) )
				{
					$error = TRUE;
					$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Confirm_code_wrong'];
				}
				else
				{
					$confirm_id = htmlspecialchars($_POST['confirm_id']);
					if (!preg_match('/^[A-Za-z0-9]+$/', $confirm_id))
					{
						$confirm_id = '';
					}
					
					$sql = 'SELECT code 
						FROM ' . CONFIRM_TABLE . " 
						WHERE confirm_id = '$confirm_id' 
							AND session_id = '" . $userdata['session_id'] . "'";
					if (!($result = $db->sql_query($sql)))
					{
						message_die(GENERAL_ERROR, 'Could not obtain confirmation code', __LINE__, __FILE__, $sql);
					}
		
					if ($row = $db->sql_fetchrow($result))
					{
						if ($row['code'] != $_POST['confirm_code'])
						{
							$error = TRUE;
							$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Confirm_code_wrong'];
						}
						else
						{
							$sql = 'DELETE FROM ' . CONFIRM_TABLE . " 
								WHERE confirm_id = '$confirm_id' 
									AND session_id = '" . $userdata['session_id'] . "'";
							if (!$db->sql_query($sql))
							{
								message_die(GENERAL_ERROR, 'Could not delete confirmation code', __LINE__, __FILE__, $sql);
							}
						}
					}
					else
					{		
						$error = TRUE;
						$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Confirm_code_wrong'];
					}
					$db->sql_freeresult($result);
				}
			}
			$username = ( !empty($_POST['username']) ) ? $_POST['username'] : '';
			$subject = ( !empty($_POST['subject']) ) ? trim($_POST['subject']) : '';
			$topic_desc = ( !empty($_POST['topic_desc']) ) ? trim($_POST['topic_desc']) : '';
			$message = ( !empty($_POST['message']) ) ? $_POST['message'] : '';
			//-- mod : calendar --------------------------------------------------------------------------------
//-- add
			$topic_calendar_time = ( $topic_calendar_time != $post_data['topic_calendar_time'] && !$is_auth['auth_cal']) ? $post_data['topic_calendar_time'] : $topic_calendar_time;
			if (empty($topic_calendar_time)) $topic_calendar_time = 0;
			$topic_calendar_duration = ( $topic_calendar_duration != $post_data['topic_calendar_duration'] && !$is_auth['auth_cal']) ? $post_data['topic_calendar_duration'] : $topic_calendar_duration;
			if ( !empty($topic_calendar_duration) )
			{
				$topic_calendar_duration--;
			}
			if (empty($topic_calendar_time) || empty($topic_calendar_duration)) $topic_calendar_duration = 0;
//-- fin mod : calendar ----------------------------------------------------------------------------
			$poll_title = ( isset($_POST['poll_title']) && $is_auth['auth_pollcreate'] ) ? $_POST['poll_title'] : '';
			$poll_options = ( isset($_POST['poll_option_text']) && $is_auth['auth_pollcreate'] ) ? $_POST['poll_option_text'] : '';
			$poll_length = ( isset($_POST['poll_length']) && $is_auth['auth_pollcreate'] ) ? $_POST['poll_length'] : '';
			$bbcode_uid = '';
			//-- mod : calendar --------------------------------------------------------------------------------
// here we have added
//	, $topic_calendar_time, $topic_calendar_duration
//-- modify prepare_post only

			prepare_post($mode, $post_data, $bbcode_on, $html_on, $smilies_on, $error_msg, $username, $bbcode_uid, $subject, $message, $poll_title, $poll_options, $poll_length, $topic_desc, $topic_calendar_time, $topic_calendar_duration);

			if ( $error_msg == '' )
			{
				$topic_type = ( $topic_type != $post_data['topic_type'] && !$is_auth['auth_sticky'] && !$is_auth['auth_announce'] && !$is_auth['auth_global_announce'] ) ? $post_data['topic_type'] : $topic_type;
				//-- mod : announces -------------------------------------------------------------------------------
//-- add
				if ($topic_announce_duration < -1) $topic_announce_duration == 0;
				if ( !in_array($topic_type, array(POST_ANNOUNCE, POST_GLOBAL_ANNOUNCE)) )
				{
					$topic_announce_duration = 0;
				}
				if ( ($topic_announce_duration == 0) && in_array($topic_type, array(POST_ANNOUNCE, POST_GLOBAL_ANNOUNCE)) )
				{
					$topic_announce_duration = intval($board_config['announcement_duration']);
				}
//-- fin mod : announces ---------------------------------------------------------------------------
				//-- mod : announces -------------------------------------------------------------------------------
// here we added
//	, $topic_announce_duration
//-- modify
//-- mod : post icon -------------------------------------------------------------------------------
// here we added
//	, post_icon
//-- modify
//-- mod : calendar --------------------------------------------------------------------------------
// here we added
//	, $topic_calendar_time, $topic_calendar_duration
//-- modify
if ($lock_subject)
{
	$url = "<a href='viewtopic.$phpEx?" . POST_POST_URL . "=" .$lock_subject."#".$lock_subject."'> ";
	$message = addslashes(sprintf($lang['Link_to_post'],$url,"</a>")).$message;	
}
				$tmp_username = str_replace("\'", "''", $username); 
				$tmp_subject = str_replace("\'", "''", $subject); 
				$tmp_message = str_replace("\'", "''", $message); 
				$tmp_poll_title = str_replace("\'", "''", $poll_title); 
				$tmp_topic_desc = str_replace("\'", "''", $topic_desc); 
				submit_post($mode, $post_data, $return_message, $return_meta, $forum_id, $topic_id, $post_id, $poll_id, $topic_type, $bbcode_on, $html_on, $smilies_on, $attach_sig, $bbcode_uid, $tmp_username, $tmp_subject, $tmp_message, $tmp_poll_title, $poll_options, $poll_length, $tmp_topic_desc, $topic_announce_duration, $post_icon, $topic_calendar_time, $topic_calendar_duration, $news_category);
//				submit_post($mode, $post_data, $return_message, $return_meta, $forum_id, $topic_id, $post_id, $poll_id, $topic_type, $bbcode_on, $html_on, $smilies_on, $attach_sig, $bbcode_uid, str_replace("\'", "''", $username), str_replace("\'", "''", $subject), str_replace("\'", "''", $message), str_replace("\'", "''", $poll_title), $poll_options, $poll_length, str_replace("\'", "''", $topic_desc), $topic_announce_duration, $post_icon, $topic_calendar_time, $topic_calendar_duration, $news_category);
			}
			break;

		case 'delete':
		case 'poll_delete':
		if ($error_msg != '')
			{
				message_die(GENERAL_MESSAGE, $error_msg);
			}
			delete_post($mode, $post_data, $return_message, $return_meta, $forum_id, $topic_id, $post_id, $poll_id);
			break;
	}

	if ( $error_msg == '' )
	{
		if ( $mode != 'editpost' )
		{
			$user_id = ( $mode == 'reply' || $mode == 'newtopic' ) ? $userdata['user_id'] : $post_data['poster_id'];
			update_post_stats($mode, $post_data, $forum_id, $topic_id, $post_id, $user_id);
		}
		$attachment_mod['posting']->insert_attachment($post_id);
		if ($error_msg == '' && $mode != 'poll_delete')
		{
			if ( $setbm )
			{
				set_bookmark($topic_id);
			}
			user_notification($mode, $post_data, $post_info['topic_title'], $forum_id, $topic_id, $post_id, $notify_user);
		}
		if ($lock_subject) 
{ 
	$url = "<a href='".append_sid("viewtopic.$phpEx?" . POST_POST_URL . "=" .$lock_subject."#".$lock_subject)."'> ";
	$return_message = $lang['Report_stored']."<br/><br/>".sprintf($lang['Send_report'],$url,"</a>");	
	$return_meta = str_replace($post_id,$lock_subject,$return_meta); 
}
		if ( $mode == 'newtopic' || $mode == 'reply' )
		{
			$tracking_topics = ( !empty($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_t']) ) ? unserialize($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_t']) : array();
			$tracking_forums = ( !empty($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_f']) ) ? unserialize($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_f']) : array();

			if ( count($tracking_topics) + count($tracking_forums) == 100 && empty($tracking_topics[$topic_id]) )
			{
				asort($tracking_topics);
				unset($tracking_topics[key($tracking_topics)]);
			}

			$tracking_topics[$topic_id] = time();

			setcookie($board_config['cookie_name'] . '_t', serialize($tracking_topics), 0, $board_config['cookie_path'], $board_config['cookie_domain'], $board_config['cookie_secure']);
		}

		$template->assign_vars(array(
			'META' => $return_meta)
		);
		message_die(GENERAL_MESSAGE, $return_message);
	}
}

if( $refresh || isset($_POST['del_poll_option']) || $error_msg != '' )
{
	$username = ( !empty($_POST['username']) ) ? htmlspecialchars(trim(stripslashes($_POST['username']))) : '';
	$subject = ( !empty($_POST['subject']) ) ? htmlspecialchars(trim(stripslashes($_POST['subject']))) : '';
	$message = ( !empty($_POST['message']) ) ? htmlspecialchars(trim(stripslashes($_POST['message']))) : '';
	$topic_desc = ( !empty($_POST['topic_desc']) ) ? htmlspecialchars(trim(stripslashes($_POST['topic_desc']))) : '';
	//-- mod : post icon -------------------------------------------------------------------------------
//-- add
	$post_icon = ( !empty($_POST['post_icon']) ) ? intval($_POST['post_icon']) : 0;
//-- fin mod : post icon ---------------------------------------------------------------------------


	$poll_title = ( !empty($_POST['poll_title']) ) ? htmlspecialchars(trim(stripslashes($_POST['poll_title']))) : '';
	$poll_length = ( isset($_POST['poll_length']) ) ? max(0, intval($_POST['poll_length'])) : 0;

	$poll_options = array();
	if ( !empty($_POST['poll_option_text']) )
	{
		while( list($option_id, $option_text) = @each($_POST['poll_option_text']) )
		{
			if( isset($_POST['del_poll_option'][$option_id]) )
			{
				unset($poll_options[$option_id]);
			}
			else if ( !empty($option_text) ) 
			{
				$poll_options[intval($option_id)] = htmlspecialchars(trim(stripslashes($option_text)));
			}
		}
	}

	if ( isset($poll_add) && !empty($_POST['add_poll_option_text']) )
	{
		$poll_options[] = htmlspecialchars(trim(stripslashes($_POST['add_poll_option_text'])));
	}

	if ( $mode == 'newtopic' || $mode == 'reply')
	{
		$user_sig = ( $userdata['user_sig'] != '' && $board_config['allow_sig'] ) ? $userdata['user_sig'] : '';
	}
	else if ( $mode == 'editpost' )
	{
		$user_sig = ( $post_info['user_sig'] != '' && $board_config['allow_sig'] ) ? $post_info['user_sig'] : '';
		$userdata['user_sig_bbcode_uid'] = $post_info['user_sig_bbcode_uid'];
	}
	
	if( $preview )
	{
		$orig_word = array();
		$replacement_word = array();
		obtain_word_list($orig_word, $replacement_word);

		$bbcode_uid = ( $bbcode_on ) ? make_bbcode_uid() : '';
		$preview_message = stripslashes(prepare_message(addslashes(unprepare_message($message)), $html_on, $bbcode_on, $smilies_on, $bbcode_uid));
		$preview_subject = $subject;
		$preview_username = $username;

		//
		// Finalise processing as per viewtopic
		//
		if( !$html_on )
		{
			if( $user_sig != '' || !$userdata['user_allowhtml'] )
			{
				$user_sig = preg_replace('#(<)([\/]?.*?)(>)#is', '&lt;\2&gt;', $user_sig);
			}
		}

		if( $attach_sig && $user_sig != '' && $userdata['user_sig_bbcode_uid'] )
		{
			$user_sig = bbencode_second_pass($user_sig, $userdata['user_sig_bbcode_uid']);
		}

		if( $bbcode_on )
		{
			$preview_message = bbencode_second_pass($preview_message, $bbcode_uid);
		}

		if( !empty($orig_word) )
		{
			$preview_username = ( !empty($username) ) ? preg_replace($orig_word, $replacement_word, $preview_username) : '';
			$preview_subject = ( !empty($subject) ) ? preg_replace($orig_word, $replacement_word, $preview_subject) : '';
			$preview_message = ( !empty($preview_message) ) ? preg_replace($orig_word, $replacement_word, $preview_message) : '';
		}

		if( $user_sig != '' )
		{
			$user_sig = make_clickable($user_sig);
		}
		$preview_message = make_clickable($preview_message);

		if( $smilies_on )
		{
			if( $userdata['user_allowsmile'] && $user_sig != '' )
			{
				$user_sig = smilies_pass($user_sig);
			}

			$preview_message = smilies_pass($preview_message);
		}

		if( $attach_sig && $user_sig != '' )
		{
			$preview_message = $preview_message . '<br /><br />_________________<br />' . $user_sig;
		}

		$preview_message = str_replace("\n", '<br />', $preview_message);
		$url = "<a href='viewtopic.$phpEx?" . POST_POST_URL . "=" .$lock_subject."#".$lock_subject."'> ";
		$extra_message_body= sprintf($lang['Link_to_post'],$url,"</a>");	
		$preview_message = ($lock_subject) ? stripslashes($extra_message_body).$preview_message : $preview_message;
		$template->set_filenames(array(
			'preview' => 'posting_preview.tpl')
		);
		//-- mod : calendar --------------------------------------------------------------------------------
//-- add
		if (!empty($topic_calendar_time))
		{
			$topic_calendar_duration_preview = $topic_calendar_duration-1;
			if ($topic_calendar_duration_preview < 0)
			{
				$topic_calendar_duration_preview = 0;
			}
			$preview_subject .= get_calendar_title($topic_calendar_time, $topic_calendar_duration_preview);
		}
//-- fin mod : calendar ----------------------------------------------------------------------------
		//-- mod : post icon -------------------------------------------------------------------------------
//-- add
		$preview_subject = get_icon_title($post_icon) . '&nbsp;' . $preview_subject;
//-- fin mod : post icon ---------------------------------------------------------------------------

		$attachment_mod['posting']->preview_attachments();
		$template->assign_vars(array(
			'TOPIC_TITLE' => $preview_subject,
			'POST_SUBJECT' => $preview_subject,
			'POSTER_NAME' => $preview_username,
			'POST_DATE' => create_date($board_config['default_dateformat'], time(), $board_config['board_timezone']),
			'MESSAGE' => $preview_message,

			'L_POST_SUBJECT' => $lang['Post_subject'], 
			'L_PREVIEW' => $lang['Preview'],
			'L_POSTED' => $lang['Posted'], 
			'L_POST' => $lang['Post'])
		);
		$template->assign_var_from_handle('POST_PREVIEW_BOX', 'preview');
	}
	else if( $error_msg != '' )
	{
		$template->set_filenames(array(
			'reg_header' => 'error_body.tpl')
		);
		$template->assign_vars(array(
			'ERROR_MESSAGE' => $error_msg)
		);
		$template->assign_var_from_handle('ERROR_BOX', 'reg_header');
	}
}
else
{
	//
	// User default entry point
	//
	$postreport=(isset($_GET['postreport']))? intval( $_GET['postreport']) : 0;
if ($postreport)
{
	$sql = 'SELECT topic_id FROM '.POSTS_TABLE.' WHERE post_id="'.$postreport.'"';
	if( !($result = $db->sql_query($sql) )) 
		message_die(GENERAL_ERROR, "Couldn't get post subject information"); 
	$post_details = $db->sql_fetchrow($result);
	$post_topic_id=$post_details['topic_id'];
	$sql = 'SELECT pt.post_subject FROM '.POSTS_TEXT_TABLE.' pt, '.POSTS_TABLE.' p WHERE p.topic_id="'.$post_topic_id.'" AND pt.post_id=p.post_id ORDER BY p.post_time ASC LIMIT 1';
	if( !($result = $db->sql_query($sql) )) 
		message_die(GENERAL_ERROR, "Couldn't get topic subject information".$sql); 
	$post_details = $db->sql_fetchrow($result);
	$subject='('.$postreport.')'.$post_details['post_subject'];
	$lock_subject=$postreport;
} else
{
	$subject = '';
	$lock_subject='';
}
	if ( $mode == 'newtopic' )
	{
		$user_sig = ( $userdata['user_sig'] != '' ) ? $userdata['user_sig'] : '';

		// Start replacement - Yellow card MOD
$username = ($userdata['session_logged_in']) ? $userdata['username'] : ''; 
$poll_title = ''; 
$poll_length = ''; 
// End replacement - Yellow card MOD
		$message = '';
		//-- mod : post icon -------------------------------------------------------------------------------
//-- add
		$post_icon = 0;
//-- fin mod : post icon ---------------------------------------------------------------------------

	}
	else if ( $mode == 'reply' )
	{
		$user_sig = ( $userdata['user_sig'] != '' ) ? $userdata['user_sig'] : '';

		$username = ( $userdata['session_logged_in'] ) ? $userdata['username'] : '';
		$subject = '';
		$message = '';
		//-- mod : post icon -------------------------------------------------------------------------------
//-- add
		$post_icon = 0;
//-- fin mod : post icon ---------------------------------------------------------------------------


	}
	else if ( $mode == 'quote' || $mode == 'editpost' )
	{
		$subject = ( $post_data['first_post'] ) ? $post_info['topic_title'] : $post_info['post_subject'];
		$message = $post_info['post_text'];
		$topic_desc = $post_info['topic_desc'];
		//-- mod : post icon -------------------------------------------------------------------------------
//-- add
		$post_icon = ( $post_data['first_post'] ) ? $post_info['topic_icon'] : $post_info['post_icon'];
//-- fin mod : post icon ---------------------------------------------------------------------------


		if ( $mode == 'editpost' )
		{
			$attach_sig = ( $post_info['enable_sig'] && $post_info['user_sig'] != '' ) ? TRUE : 0; 
			$user_sig = $post_info['user_sig'];

			$html_on = ( $post_info['enable_html'] ) ? true : false;
			$bbcode_on = ( $post_info['enable_bbcode'] ) ? true : false;
			$smilies_on = ( $post_info['enable_smilies'] ) ? true : false;
		}
		else
		{
			$attach_sig = ( $userdata['user_attachsig'] ) ? TRUE : 0;
			$user_sig = $userdata['user_sig'];
		}

		if ( $post_info['bbcode_uid'] != '' )
		{
			$message = preg_replace('/\:(([a-z0-9]:)?)' . $post_info['bbcode_uid'] . '/s', '', $message);
		}

		$message = str_replace('<', '&lt;', $message);
		$message = str_replace('>', '&gt;', $message);
		$message = str_replace('<br />', "\n", $message);

		if ( $mode == 'quote' )
		{
			$orig_word = array();
			$replacement_word = array();
			obtain_word_list($orig_word, $replace_word);

			$msg_date =  create_date($board_config['default_dateformat'], $postrow['post_time'], $board_config['board_timezone']);

			// Use trim to get rid of spaces placed there by MS-SQL 2000
			$quote_username = ( trim($post_info['post_username']) != '' ) ? $post_info['post_username'] : $post_info['username'];
			$message = '[quote="' . $quote_username . '"]' . $message . '[/quote]';

			if ( !empty($orig_word) )
			{
				$subject = ( !empty($subject) ) ? preg_replace($orig_word, $replace_word, $subject) : '';
				$message = ( !empty($message) ) ? preg_replace($orig_word, $replace_word, $message) : '';
			}

			if ( !preg_match('/^Re:/', $subject) && strlen($subject) > 0 )
			{
				$subject = 'Re: ' . $subject;
			}

			$mode = 'reply';
		}
		else
		{
			$username = ( $post_info['user_id'] == ANONYMOUS && !empty($post_info['post_username']) ) ? $post_info['post_username'] : '';
		}
	}
}

//
// Signature toggle selection
//
if( $user_sig != '' )
{
	$template->assign_block_vars('switch_signature_checkbox', array());
}

//
// HTML toggle selection
//
if ( $board_config['allow_html'] )
{
	$html_status = $lang['HTML_is_ON'];
	$template->assign_block_vars('switch_html_checkbox', array());
}
else
{
	$html_status = $lang['HTML_is_OFF'];
}

//
// BBCode toggle selection
//
if ( $board_config['allow_bbcode'] )
{
	$bbcode_status = $lang['BBCode_is_ON'];
	$template->assign_block_vars('switch_bbcode_checkbox', array());
}
else
{
	$bbcode_status = $lang['BBCode_is_OFF'];
}

//
// Smilies toggle selection
//
if ( $board_config['allow_smilies'] )
{
	$smilies_status = $lang['Smilies_are_ON'];
	$template->assign_block_vars('switch_smilies_checkbox', array());
}
else
{
	$smilies_status = $lang['Smilies_are_OFF'];
}

if( !$userdata['session_logged_in'] || ( $mode == 'editpost' && $post_info['poster_id'] == ANONYMOUS ) )
{
	$template->assign_block_vars('switch_username_select', array());
}

//
// Notify checkbox - only show if user is logged in
//
if ( $userdata['session_logged_in'] && $is_auth['auth_read'] )
{
	if ( $mode != 'editpost' || ( $mode == 'editpost' && $post_info['poster_id'] != ANONYMOUS ) )
	{
		$template->assign_block_vars('switch_notify_checkbox', array());
	}
}
//
// Bookmark checkbox - only show if user is logged in and not editing a post
//
if ( $userdata['session_logged_in'] )
{
	if ( $mode != 'editpost' )
	{
		$template->assign_block_vars('switch_bookmark_checkbox', array());
	}
}
//
// Delete selection
//
if ( $mode == 'editpost' && ( ( $is_auth['auth_delete'] && $post_data['last_post'] && ( !$post_data['has_poll'] || $post_data['edit_poll'] ) ) || $is_auth['auth_mod'] ) )
{
	$template->assign_block_vars('switch_delete_checkbox', array());
}

//
// Topic type selection
//
$topic_type_toggle = '';
if ( $mode == 'newtopic' || ( $mode == 'editpost' && $post_data['first_post'] ) )
{
	$template->assign_block_vars('switch_type_toggle', array());

	if( $is_auth['auth_sticky'] )
	{
		$topic_type_toggle .= '<input type="radio" name="topictype" value="' . POST_STICKY . '"';
		if ( $post_data['topic_type'] == POST_STICKY || $topic_type == POST_STICKY )
		{
			$topic_type_toggle .= ' checked="checked"';
		}
		$topic_type_toggle .= ' /> ' . $lang['Post_Sticky'] . '&nbsp;&nbsp;';
	}

	if( $is_auth['auth_announce'] )
	{
		$topic_type_toggle .= '<input type="radio" name="topictype" value="' . POST_ANNOUNCE . '"';
		if ( $post_data['topic_type'] == POST_ANNOUNCE || $topic_type == POST_ANNOUNCE )
		{
			$topic_type_toggle .= ' checked="checked"';
		}
		$topic_type_toggle .= ' /> ' . $lang['Post_Announcement'] . '&nbsp;&nbsp;';
	}
	//-- mod : announces -------------------------------------------------------------------------------
//-- add
	if( $is_auth['auth_global_announce'] )
	{
		$topic_type_toggle .= '<input type="radio" name="topictype" value="' . POST_GLOBAL_ANNOUNCE . '"';
		if ( $post_data['topic_type'] == POST_GLOBAL_ANNOUNCE || $topic_type == POST_GLOBAL_ANNOUNCE )
		{
			$topic_type_toggle .= ' checked="checked"';
		}
		$topic_type_toggle .= ' /> ' . $lang['Post_Global_Announcement'] . '&nbsp;&nbsp;';
	}
//-- fin mod : announces ---------------------------------------------------------------------------

	if ( $topic_type_toggle != '' )
	{
		$topic_type_toggle = $lang['Post_topic_as'] . ': <input type="radio" name="topictype" value="' . POST_NORMAL .'"' . ( ( $post_data['topic_type'] == POST_NORMAL || $topic_type == POST_NORMAL ) ? ' checked="checked"' : '' ) . ' /> ' . $lang['Post_Normal'] . '&nbsp;&nbsp;' . $topic_type_toggle;
	}
	//-- mod : announces -------------------------------------------------------------------------------
//-- add
	if( $is_auth['auth_announce'] || $is_auth['auth_global_announce'])
	{
		if (empty($topic_announce_duration)) $topic_announce_duration = $post_data['topic_announce_duration'];
		$topic_type_toggle .= '<br />' . $lang['announcement_duration'] . ': <input type="post" size="3" name="topicduration" value="' . $topic_announce_duration . '" />&nbsp;' . $lang['Days'] . '<br /><span class="gensmall">(' . $lang['announcement_duration_explain'] . ')</span>';
	}
//-- fin mod : announces ---------------------------------------------------------------------------

}
//-- mod : calendar --------------------------------------------------------------------------------
//-- add
//
// Calendar type selection
//
$topic_type_cal = '';
if ( $mode == 'newtopic' || ( $mode == 'editpost' && $post_data['first_post'] ) )
{
	if( $is_auth['auth_cal'])
	{
		$template->assign_block_vars('switch_type_cal', array());
		$months = array( 
			' ------------ ',
			$lang['datetime']['January'], 
			$lang['datetime']['February'], 
			$lang['datetime']['March'],
			$lang['datetime']['April'],
			$lang['datetime']['May'],
			$lang['datetime']['June'],
			$lang['datetime']['July'],
			$lang['datetime']['August'],
			$lang['datetime']['September'],
			$lang['datetime']['October'],
			$lang['datetime']['November'],
			$lang['datetime']['December'],
		);

		// get the date
		$topic_calendar_time = ( !isset($_POST['topic_calendar_year']) || (($topic_calendar_time != intval($post_data['topic_calendar_time'])) && !$is_auth['auth_cal']) ) ? intval($post_data['topic_calendar_time']) : $topic_calendar_time;
		$topic_calendar_duration = ( (!isset($_POST['topic_calendar_duration_day']) && !isset($_POST['topic_calendar_duration_hour']) && !isset($_POST['topic_calendar_duration_min']) ) || (($topic_calendar_duration != intval($post_data['topic_calendar_duration'])) && !$is_auth['auth_cal']) ) ? intval($post_data['topic_calendar_duration']) : $topic_calendar_duration;

		// get the components of the event date
		$year	= '';
		$month	= '';
		$day	= '';
		$hour	= '';
		$min	= '';
		if (!empty($topic_calendar_time))
		{
			$year	= intval( date('Y', $topic_calendar_time) );
			$month	= intval( date('m', $topic_calendar_time) );
			$day	= intval( date('d', $topic_calendar_time) );
			$hour	= intval( date('H', $topic_calendar_time) );
			$min	= intval( date('i', $topic_calendar_time) );
		}

		// get the components of the duration
		$d_day	= '';
		$d_hour	= '';
		$d_min	= '';
		if ( !empty($topic_calendar_time) && !empty($topic_calendar_duration) )
		{
			$d_dur = intval($topic_calendar_duration);
			$d_day = intval($d_dur / 86400);
			$d_dur = $d_dur - 86400 * $d_day;
			$d_hour = intval($d_dur / 3600);
			$d_dur = $d_dur - 3600 * $d_hour;
			$d_min = intval($d_dur / 60);
		}

		// raz if no date
		if ( empty($year) || empty($month) || empty($day) )
		{
			$year	= '';
			$month	= '';
			$day	= '';
			$hour	= '';
			$min	= '';
			$d_day	= '';
			$d_hour	= '';
			$d_min	= '';
		}

		// day list
		$s_topic_calendar_day = '<select name="topic_calendar_day">';
		for ($i=0; $i <= 31; $i++)
		{
			$selected = ( intval($day) == $i) ? ' selected="selected"' : '';
			$s_topic_calendar_day .= '<option value="' . $i . '"' . $selected . '>' . ( ($i == 0) ? ' -- ' : str_pad($i, 2, '0', STR_PAD_LEFT) ) . '</option>';
		}
		$s_topic_calendar_day .= '</select>';

		// month list
		$s_topic_calendar_month = '<select name="topic_calendar_month">';
		for ($i=0; $i <= 12; $i++)
		{
			$selected = ( intval($month) == $i ) ? ' selected="selected"' : '';
			$s_topic_calendar_month .= '<option value="' . $i . '"' . $selected . '>' . $months[$i] . '</option>';
		}
		$s_topic_calendar_month .= '</select>';

		// year list
		$s_topic_calendar_year = '<select name="topic_calendar_year">';

		$selected = empty($year) ? ' selected="selected"' : '';
		$s_topic_calendar_year .= '<option value="0"' . $select . '> ---- </option>';

		$start_year = ( (intval($year) > 1971 ) && (intval($year) <= date('Y', time())) ) ? intval($year) : date('Y', time());
		for ($i = $start_year; $i <= date('Y', time())+10; $i++)
		{
			$selected = ( intval($year) == $i) ? ' selected="selected"' : '';
			$s_topic_calendar_year .= '<option value="' . $i . '"' . $selected . '>' . $i . '</option>';
		}
		$s_topic_calendar_year .= '</select>';

		// time
		if (empty($hour) && empty($min))
		{
			$hour = '';
			$min = '';
		}
		$topic_calendar_hour	= $hour;
		$topic_calendar_min		= $min;

		// duration
		if ( empty($topic_calendar_hour) && empty($topic_calendar_min) )
		{
			$d_hour = '';
			$d_min = '';
		}
		if ( empty($d_day) && empty($d_hour) && empty($d_min) )
		{
			$d_day = '';
			$d_hour = '';
			$d_min = '';
		}
		$topic_calendar_duration_day	= $d_day;
		$topic_calendar_duration_hour	= $d_hour;
		$topic_calendar_duration_min	= $d_min;
	}
}
//-- fin mod : calendar ----------------------------------------------------------------------------

$hidden_form_fields = '<input type="hidden" name="mode" value="' . $mode . '" />';
$hidden_form_fields .= '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" />';
$hidden_form_fields .= ($lock_subject) ? '<input type="hidden" name="lock_subject" value="'.$lock_subject.'" />':'';
switch( $mode )
{
	case 'newtopic':
		$page_title = $lang['Post_a_new_topic'];
		$hidden_form_fields .= '<input type="hidden" name="' . POST_FORUM_URL . '" value="' . $forum_id . '" />';
		break;

	case 'reply':
		$page_title = $lang['Post_a_reply'];
		$hidden_form_fields .= '<input type="hidden" name="' . POST_TOPIC_URL . '" value="' . $topic_id . '" />';
		break;

	case 'editpost':
		$page_title = $lang['Edit_Post'];
		$hidden_form_fields .= '<input type="hidden" name="' . POST_POST_URL . '" value="' . $post_id . '" />';
		break;
}
$page_title = ($postreport || $lock_subject) ? $lang['Post_a_report']: $page_title;
//
// Visual confirmation for guests
//
$confirm_image = '';
if( !$userdata['session_logged_in'] && $plus_config['enable_confirm_post'])
{
	$expiry_time = time() - $board_config['session_length'];

	$sql = 'SELECT session_id 
		FROM ' . SESSIONS_TABLE ." WHERE session_time>$expiry_time"; 
	if (!($result = $db->sql_query($sql)))
	{
		message_die(GENERAL_ERROR, 'Could not select session data', '', __LINE__, __FILE__, $sql);
	}
	
	if ($row = $db->sql_fetchrow($result))
	{
		$confirm_sql = '';
		do
		{
			$confirm_sql .= (($confirm_sql != '') ? ', ' : '') . "'" . $row['session_id'] . "'";
		}
		while ($row = $db->sql_fetchrow($result));
	
		$sql = 'DELETE FROM ' .  CONFIRM_TABLE . " 
			WHERE session_id NOT IN ($confirm_sql)";
		if (!$db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, 'Could not delete stale confirm data', '', __LINE__, __FILE__, $sql);
		}
	}
	$db->sql_freeresult($result);
	
	// Generate the required confirmation code
	// NB 0 (zero) could get confused with O (the letter) so we make change it
	$code = dss_rand();
	$code = strtoupper(str_replace('0', 'o', substr($code, 6)));
	
	$confirm_id = md5(uniqid($user_ip));
	
	$sql = 'INSERT INTO ' . CONFIRM_TABLE . " (confirm_id, session_id, code) 
		VALUES ('$confirm_id', '". $userdata['session_id'] . "', '$code')";
	if (!$db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, 'Could not insert new confirm code information', '', __LINE__, __FILE__, $sql);
	}
	
	unset($code);
	
	$confirm_image = '<img src="' . append_sid("profile.$phpEx?mode=confirm&amp;id=$confirm_id") . '" alt="" title="" />';

	$hidden_form_fields .= '<input type="hidden" name="confirm_id" value="' . $confirm_id . '" />';
	
	$template->assign_block_vars('switch_confirm', array());
}
// Generate smilies listing for page output
generate_smilies('inline', PAGE_POSTING);

//
// Include page header
//
include($phpbb_root_path . 'includes/page_header.'.$phpEx);

$template->set_filenames(array(
	'body' => 'posting_body.tpl', 
	'pollbody' => 'posting_poll_body.tpl', 
	'reviewbody' => 'posting_topic_review.tpl')
);
make_jumpbox('viewforum.'.$phpEx);
// MULTI BBCODE-begin
//NOTE: the first element of each array must be ''   Add new elements AFTER the ''
$EMBB_keys = array('','g', 'd', 'e', 'h', 'j', 'j', 'j', 'j', 'k', 'm', 'n', 'r', 't', 'v', 'x', 'y', 'z', 'th') ;
$EMBB_widths = array('','57' ,'57','57','57','57','57','57','57','57','57','57','57','57','57','57','57','57','57') ;
$EMBB_values = array('','Glow' ,'Shadow','Align','Fade','ScrollLeft','Scrollright','ScrollUp','Scrolldown','Highlight','Flash','FlipV','FlipH','Stream','Left','Right',$lang['PHPCode'],'Google','Through') ;
/* ///// removed for BBCode Buttons Mod /////
for ($i=1; $i<count($EMBB_values); $i++)
{
	// load BBcode MODs info
	$val = ($i*2)+16 ;
	$template->assign_block_vars('MultiBB', array(
		'KEY' => $EMBB_keys[$i],
		'NAME' => "addbbcode$val",
		'WIDTH' => $EMBB_widths[$i],
		'VALUE' => $EMBB_values[$i],
		'STYLE' => "bbstyle($val)")
	);
}
*/


$max_rows = ((count($EMBB_values)-1)/9) ;
$max_rows = ($max_rows*9 == count($EMBB_values)) ? $max_rows : $max_rows+1 ;
$code_count = 1 ;
for ($i=1; $i<=$max_rows; $i++)
{
	$template->assign_block_vars('XBBcode', array(
		'ROW_ID' => $i)
	);
	
	for ($element=0; $element<9; $element++)
	{
		$val = ($code_count*2)+16 ;
		if ( $code_count < count($EMBB_values))
		{
			$template->assign_block_vars('XBBcode.BB', array(
				'KEY' => $EMBB_keys[$code_count],
				'NAME' => "addbbcode$val",
				'WIDTH' => $EMBB_widths[$code_count],
				'VALUE' => $EMBB_values[$code_count],
				'STYLE' => "bbstyle($val)")
			);
		}
		$code_count++ ;
	}
}

// MULTI BBCODE-end
$template->assign_vars(array(
	'FORUM_NAME' => $forum_name,
	'L_POST_A' => $page_title,
	'L_POST_SUBJECT' => $lang['Post_subject'], 

	'U_VIEW_FORUM' => append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id"))
);

//
// This enables the forum/topic title to be output for posting
// but not for privmsg (where it makes no sense)
//
$template->assign_block_vars('switch_not_privmsg', array());
//
// Enable the Topic Description MOD only if this is a new post
// or if you edit the fist post of a topic
//
if ( $mode == 'newtopic' || ( $mode == 'editpost' && $post_data['first_post'] ) )
{
   $template->assign_block_vars('topic_description', array());
}

//
// Output the data to the template
//
$template->assign_vars(array(
	'USERNAME' => $username,
	'SUBJECT' => $subject,
	'MESSAGE' => $message,
	'HTML_STATUS' => $html_status,
	'BBCODE_STATUS' => sprintf($bbcode_status, '<a href="' . append_sid("faq.$phpEx?mode=bbcode") . '" target="_phpbbcode">', '</a>'), 
	'SMILIES_STATUS' => $smilies_status, 
	'CONFIRM_IMG' => $confirm_image,

	'L_SUBJECT' => $lang['Subject'],
	'L_MESSAGE_BODY' => $lang['Message_body'],
	'L_OPTIONS' => $lang['Options'],
	'L_PREVIEW' => $lang['Preview'],
	'L_SPELLCHECK' => $lang['Spellcheck'],
	'L_SUBMIT' => $lang['Submit'],
	'L_CANCEL' => $lang['Cancel'],
	'L_CONFIRM_DELETE' => $lang['Confirm_delete'],
	'L_DISABLE_HTML' => $lang['Disable_HTML_post'], 
	'L_DISABLE_BBCODE' => $lang['Disable_BBCode_post'], 
	'L_DISABLE_SMILIES' => $lang['Disable_Smilies_post'], 
	'L_ATTACH_SIGNATURE' => $lang['Attach_signature'], 
	'L_SET_BOOKMARK' => $lang['Set_Bookmark'],
	'L_NOTIFY_ON_REPLY' => $lang['Notify'], 
	'L_DELETE_POST' => $lang['Delete_post'],
	'L_CONFIRM_CODE_IMPAIRED'	=> sprintf($lang['Confirm_code_impaired'], '<a href="mailto:' . $board_config['board_email'] . '">', '</a>'),
	'L_CONFIRM_CODE' => $lang['Confirm_code'],
	'L_CONFIRM_CODE_EXPLAIN' => $lang['Confirm_code_explain'],

	'L_BBCODE_B_HELP' => $lang['bbcode_b_help'], 
	'L_BBCODE_I_HELP' => $lang['bbcode_i_help'], 
	'L_BBCODE_U_HELP' => $lang['bbcode_u_help'], 
	'L_BBCODE_Q_HELP' => $lang['bbcode_q_help'], 
	'L_BBCODE_C_HELP' => $lang['bbcode_c_help'], 
	'L_BBCODE_L_HELP' => $lang['bbcode_l_help'], 
	'L_BBCODE_O_HELP' => $lang['bbcode_o_help'], 
	'L_BBCODE_P_HELP' => $lang['bbcode_p_help'], 
	'L_BBCODE_W_HELP' => $lang['bbcode_w_help'], 
	'L_BBCODE_A_HELP' => $lang['bbcode_a_help'], 
	'L_BBCODE_S_HELP' => $lang['bbcode_s_help'], 
	'L_BBCODE_F_HELP' => $lang['bbcode_f_help'], 
	'L_BBCODE_G_HELP' => $lang['bbcode_g_help'], 
   	'L_BBCODE_D_HELP' => $lang['bbcode_d_help'], 
   	'L_BBCODE_E_HELP' => $lang['bbcode_e_help'],
   	'L_BBCODE_H_HELP' => $lang['bbcode_h_help'],
   	'L_BBCODE_J_HELP' => $lang['bbcode_j_help'],
   	'L_BBCODE_K_HELP' => $lang['bbcode_k_help'],
   	'L_BBCODE_M_HELP' => $lang['bbcode_m_help'],
   	'L_BBCODE_N_HELP' => $lang['bbcode_n_help'],
   	'L_BBCODE_R_HELP' => $lang['bbcode_r_help'],
   	'L_BBCODE_T_HELP' => $lang['bbcode_t_help'],
   	'L_BBCODE_V_HELP' => $lang['bbcode_v_help'],
   	'L_BBCODE_X_HELP' => $lang['bbcode_x_help'],
   	'L_BBCODE_Y_HELP' => $lang['bbcode_y_help'],
   	'L_BBCODE_Z_HELP' => $lang['bbcode_z_help'],
   	'L_BBCODE_TH_HELP' => $lang['bbcode_th_help'],
   	'L_BBCODE_SC_HELP' => $lang['bbcode_sc_help'],
	'L_SMILIE_CREATOR' => $lang['Smilie_creator'],
	'L_EMPTY_MESSAGE' => $lang['Empty_message'],

	'L_FONT_COLOR' => $lang['Font_color'], 
	'L_FONT_TYPE' => $lang['Font_type'],
	'L_COLOR_DEFAULT' => $lang['color_default'], 
	'L_COLOR_DARK_RED' => $lang['color_dark_red'], 
	'L_COLOR_RED' => $lang['color_red'], 
	'L_COLOR_ORANGE' => $lang['color_orange'], 
	'L_COLOR_BROWN' => $lang['color_brown'], 
	'L_COLOR_YELLOW' => $lang['color_yellow'], 
	'L_COLOR_GREEN' => $lang['color_green'], 
	'L_COLOR_OLIVE' => $lang['color_olive'], 
	'L_COLOR_CYAN' => $lang['color_cyan'], 
	'L_COLOR_BLUE' => $lang['color_blue'], 
	'L_COLOR_DARK_BLUE' => $lang['color_dark_blue'], 
	'L_COLOR_INDIGO' => $lang['color_indigo'], 
	'L_COLOR_VIOLET' => $lang['color_violet'], 
	'L_COLOR_WHITE' => $lang['color_white'], 
	'L_COLOR_BLACK' => $lang['color_black'], 

	'L_FONT_SIZE' => $lang['Font_size'], 
	'L_FONT_TINY' => $lang['font_tiny'], 
	'L_FONT_SMALL' => $lang['font_small'], 
	'L_FONT_NORMAL' => $lang['font_normal'], 
	'L_FONT_LARGE' => $lang['font_large'], 
	'L_FONT_HUGE' => $lang['font_huge'], 

	'L_BBCODE_CLOSE_TAGS' => $lang['Close_Tags'], 
	'L_STYLES_TIP' => $lang['Styles_tip'], 
	'L_TOPIC_DESCRIPTION' => $lang['Topic_description'],
	'U_VIEWTOPIC' => ( $mode == 'reply' ) ? append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;postorder=desc") : '', 
	'U_REVIEW_TOPIC' => ( $mode == 'reply' ) ? append_sid("posting.$phpEx?mode=topicreview&amp;" . POST_TOPIC_URL . "=$topic_id") : '', 
	'S_AJAX_BLUR' => ($mode == 'newtopic') ? 'onblur="AJAXSearch(this.value);"' : '',
	'S_DISPLAY_PREVIEW' => ($preview) ? '' : 'style="display:none;"',
	'S_EDIT_AJAX' => ($board_config['use_ajax_preview']) ? 'onclick="return AJAXPreview(0, '.(($mode == 'editpost') ? $post_id : 0).');" ' : '',
	'L_SEARCH_RESULTS' => $lang['AJAX_search_results'],
	'L_SEARCH_RESULT' => $lang['AJAX_search_result'],
	'L_EMPTY_SUBJECT' => $lang['Empty_subject'],
	'TOPIC_DESCRIPTION' => $topic_desc,
	//-- mod : calendar --------------------------------------------------------------------------------
//-- add
	'L_CALENDAR_TITLE'			=> $lang['Calendar_event'],
	'L_TIME'					=> $lang['Event_time'],
	'L_CALENDAR_DURATION'		=> $lang['Calendar_duration'],
	'L_DAYS'					=> $lang['Days'],
	'L_HOURS'					=> $lang['Hours'],
	'L_MINUTES'					=> $lang['Minutes'],
	'L_TODAY'					=> $lang['Today'],

	'TODAY_DAY'					=> date('d', time()),
	'TODAY_MONTH'				=> date('m', time()),
	'TODAY_YEAR'				=> date('Y', time()),

	'S_CALENDAR_YEAR'			=> $s_topic_calendar_year,
	'S_CALENDAR_MONTH'			=> $s_topic_calendar_month,
	'S_CALENDAR_DAY'			=> $s_topic_calendar_day,

	'CALENDAR_HOUR'				=> $topic_calendar_hour,
	'CALENDAR_MIN'				=> $topic_calendar_min,
	'CALENDAR_DURATION_DAY'		=> $topic_calendar_duration_day,
	'CALENDAR_DURATION_HOUR'	=> $topic_calendar_duration_hour,
	'CALENDAR_DURATION_MIN'		=> $topic_calendar_duration_min,
//-- fin mod : calendar ----------------------------------------------------------------------------

	'S_HTML_CHECKED' => ( !$html_on ) ? 'checked="checked"' : '', 
	'S_BBCODE_CHECKED' => ( !$bbcode_on ) ? 'checked="checked"' : '', 
	'S_SMILIES_CHECKED' => ( !$smilies_on ) ? 'checked="checked"' : '', 
	'S_SIGNATURE_CHECKED' => ( $attach_sig ) ? 'checked="checked"' : '', 
	'S_SETBM_CHECKED' => ( $setbm ) ? 'checked="checked"' : '',
	// Start replacement - Yellow card admin MOD
	'S_NOTIFY_CHECKED' => ($is_auth['auth_read'] ) ? (( $notify_user ) ? 'checked="checked"' : '')  : 'DISABLED' ,
	'S_LOCK_SUBJECT' => ($lock_subject) ? ' READONLY ' : '',
	// End replacement - Yellow card admin MOD 
	'S_TYPE_TOGGLE' => $topic_type_toggle, 
	'S_TOPIC_ID' => $topic_id, 
	'S_POST_ACTION' => append_sid("posting.$phpEx"),
	'S_HIDDEN_FORM_FIELDS' => $hidden_form_fields)
);
//-- mod : post icon -------------------------------------------------------------------------------
//-- add
// get the number of icon per row from config
$icon_per_row = isset($board_config['icon_per_row']) ? intval($board_config['icon_per_row']) : 10;
if ($icon_per_row <= 1)
{
	$icon_per_row = 10;
}

// get the list of icon available to the user
$icones_sort = array();
for ($i = 0; $i < count($icones); $i++)
{
	switch ($icones[$i]['auth'])
	{
		case AUTH_ADMIN:
			if ( $userdata['user_level'] == ADMIN )
			{
				$icones_sort[] = $i;
			}
			break;
		case AUTH_MOD:
			if ( $is_auth['auth_mod'] )
			{
				$icones_sort[] = $i;
			}
			break;
		case AUTH_REG:
			if ( $userdata['session_logged_in'] )
			{
				$icones_sort[] = $i;
			}
			break;
		default:
			$icones_sort[] = $i;
			break;
	}
}

// check if the icon exists
$found = false;
for ($i=0; ( ($i < count($icones_sort)) && !$found );$i++)
{
	$found = ($icones[ $icones_sort[$i] ]['ind'] == $post_icon);
}
if (!$found) $post_icon = 0;

// send to template
$template->assign_block_vars('switch_icon_checkbox', array());
$template->assign_vars(array(
	'L_ICON_TITLE' => $lang['post_icon_title'],
	)
);

// display the icons
$nb_row = intval( (count($icones_sort)-1) / $icon_per_row )+1;
$offset = 0;
for ($i=0; $i < $nb_row; $i++)
{
	$template->assign_block_vars('switch_icon_checkbox.row',array());
	for ($j=0; ( ($j < $icon_per_row) && ($offset < count($icones_sort)) ); $j++)
	{
		$icon_id  = $icones_sort[$offset];

		// send to cell or cell_none
		$template->assign_block_vars('switch_icon_checkbox.row.cell', array(
			'ICON_ID'		=> $icones[$icon_id]['ind'],
			'ICON_CHECKED'	=> ($post_icon == $icones[$icon_id]['ind']) ? ' checked="checked"' : '',
			'ICON_IMG'		=> get_icon_title($icones[$icon_id]['ind'], 2),
			)
		);
		$offset++;
	}
}
//-- fin mod : post icon ---------------------------------------------------------------------------

//
// Poll entry switch/output
//
if( ( $mode == 'newtopic' || ( $mode == 'editpost' && $post_data['edit_poll']) ) && $is_auth['auth_pollcreate'] )
{
	$template->assign_vars(array(
		'L_ADD_A_POLL' => $lang['Add_poll'],  
		'L_ADD_POLL_EXPLAIN' => $lang['Add_poll_explain'],   
		'L_POLL_QUESTION' => $lang['Poll_question'],   
		'L_POLL_OPTION' => $lang['Poll_option'],  
		'L_ADD_OPTION' => $lang['Add_option'],
		'L_UPDATE_OPTION' => $lang['Update'],
		'L_DELETE_OPTION' => $lang['Delete'], 
		'L_POLL_LENGTH' => $lang['Poll_for'],  
		'L_DAYS' => $lang['Days'], 
		'L_POLL_LENGTH_EXPLAIN' => $lang['Poll_for_explain'], 
		'L_POLL_DELETE' => $lang['Delete_poll'],
		
		'POLL_TITLE' => $poll_title,
		'POLL_LENGTH' => $poll_length)
	);

	if( $mode == 'editpost' && $post_data['edit_poll'] && $post_data['has_poll'])
	{
		$template->assign_block_vars('switch_poll_delete_toggle', array());
	}

	if( !empty($poll_options) )
	{
		while( list($option_id, $option_text) = each($poll_options) )
		{
			$template->assign_block_vars('poll_option_rows', array(
				'POLL_OPTION' => str_replace('"', '&quot;', $option_text), 

				'S_POLL_OPTION_NUM' => $option_id)
			);
		}
	}

	$template->assign_var_from_handle('POLLBOX', 'pollbody');
}

//
// Topic review
//
if( $mode == 'reply' && $is_auth['auth_read'] )
{
	require($phpbb_root_path . 'includes/topic_review.'.$phpEx);
	topic_review($topic_id, true);

	$template->assign_block_vars('switch_inline_mode', array());
	$template->assign_var_from_handle('TOPIC_REVIEW_BOX', 'reviewbody');
}

$template->pparse('body');

include($phpbb_root_path . 'includes/page_tail.'.$phpEx);

?>

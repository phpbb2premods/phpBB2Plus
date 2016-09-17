<?php
/***************************************************************************
 *                                 ajax.php
 *                            -------------------
 *   begin                : Friday, Dec 09, 2005
 *   copyright            : (C) 2005 alcaeus
 *   email                : mods@alcaeus.org
 *
 *   $Id: ajax.php,v 1.8 2006/04/18 23:20:50 alcaeus Exp $
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
include($phpbb_root_path .'extension.inc');
include($phpbb_root_path .'common.'. $phpEx);
include($phpbb_root_path .'includes/functions_post.'. $phpEx);

// Define constant to keep page_header.php from sending headers
define('AJAX_HEADERS', True);

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_INDEX);
init_userprefs($userdata);
//
// End session management
//

// Get SID and check it
if (isset($HTTP_POST_VARS['sid']) || isset($HTTP_GET_VARS['sid']))
{
	$sid = (isset($HTTP_POST_VARS['sid'])) ? $HTTP_POST_VARS['sid'] : $HTTP_GET_VARS['sid'];
}
else
{
	$sid = '';
}
if ($sid != $userdata['session_id'])
{
	$result_ar = array(
		'result' => AJAX_ERROR,
		'error_msg' => 'Invalid session_id'
	);
	AJAX_message_die($result_ar);
}

// Get mode
if (isset($HTTP_POST_VARS['mode']) || isset($HTTP_GET_VARS['mode']))
{
	$mode = (isset($HTTP_POST_VARS['mode'])) ? $HTTP_POST_VARS['mode'] : $HTTP_GET_VARS['mode'];
}
else
{
	$mode = '';
}

// Send AJAX headers - this is to prevent browsers from caching possible error pages
AJAX_headers();

// Flush the output, this will send any headers to the browsers, including session cookies (if necessary)
// mark_topic and mark_forum however set cookies, therefore we're not allowed to send the headers yet. They'll be sent at the end of the script.
if (($mode != 'mark_topic') && ($mode != 'mark_forum'))
{
	flush();
}

//
// Editing of post subject
//
if ($mode == 'edit_post_subject')
{
	include($phpbb_root_path .'includes/functions_search.'. $phpEx);
	
	// Determine post_id and new subject
	if (isset($HTTP_POST_VARS[POST_POST_URL]) || isset($HTTP_GET_VARS[POST_POST_URL]))
	{
		$post_id = (isset($HTTP_POST_VARS[POST_POST_URL])) ? intval($HTTP_POST_VARS[POST_POST_URL]) : intval($HTTP_GET_VARS[POST_POST_URL]);
	}
	else
	{
		$post_id = 0;
	}
	$subject = (isset($HTTP_POST_VARS['subject'])) ? ajax_htmlspecialchars(trim(utf8_rawurldecode($HTTP_POST_VARS['subject']))) : '';
	
	// Check if data was submitted
	if (empty($post_id))
	{
		$result_ar = array(
			'result' => AJAX_ERROR,
			'postid' => $post_id,
			'error_msg' => 'No post_id specified'
		);
		AJAX_message_die($result_ar);
	}
	
	// Get post/topic information
	$sql = 'SELECT t.topic_id, t.topic_first_post_id, t.topic_last_post_id, t.topic_poster, t.forum_id, t.topic_status, p.poster_id, p.post_edit_time, p.post_edit_count, u.username, p.post_username 
	        FROM '. TOPICS_TABLE .' t, '. POSTS_TABLE .' p, '. USERS_TABLE ." u 
	        WHERE t.topic_id = p.topic_id 
	        AND p.poster_id = u.user_id 
	        AND p.post_id = $post_id";
	if (!($result = $db->sql_query($sql)))
	{
		$result_ar = array(
			'result' => AJAX_ERROR,
			'postid' => $post_id,
			'error_msg' => 'Could not fetch post details'
		);
		AJAX_message_die($result_ar);
	}
	$row = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);
	if (!$row)
	{
		$result_ar = array(
			'result' => AJAX_ERROR,
			'postid' => $post_id,
			'error_msg' => 'Invalid post_id'
		);
		AJAX_message_die($result_ar);
	}
	$forum_id = $row['forum_id'];
	
	if (($post_id == $row['topic_first_post_id']) && empty($subject))
	{
		$result_ar = array(
			'result' => AJAX_ERROR,
			'postid' => $post_id,
			'error_msg' => 'No subject specified'
		);
		AJAX_message_die($result_ar);
	}
	
	//Check auth settings
	$is_auth = array();
	$is_auth = auth(AUTH_ALL, $forum_id, $userdata);
	if ((($row['poster_id'] != $userdata['user_id']) || ($row['topic_status'] == TOPIC_LOCKED)) && !$is_auth['auth_mod'])
	{
		$result_ar = array(
			'result' => AJAX_ERROR,
			'postid' => $post_id,
			'error_msg' => 'You\'re not allowed to edit this post'
		);
		AJAX_message_die($result_ar);
	}
	
	// Edit post subject and topic subject (if necessary)
	$topic_title = str_replace("\'", "''", $subject);
	if ($row['topic_first_post_id'] == $post_id)
	{
		$sql = 'UPDATE '. TOPICS_TABLE ." 
		        SET topic_title = '$topic_title' 
		        WHERE topic_id = ". $row['topic_id'];
		if (!$db->sql_query($sql))
		{
			$result_ar = array(
				'result' => AJAX_ERROR,
				'postid' => $post_id,
				'error_msg' => 'Could not update topic title'
			);
			AJAX_message_die($result_ar);
		}
	}
	
	$sql = 'UPDATE '. POSTS_TEXT_TABLE ." 
	        SET post_subject = '$topic_title' 
	        WHERE post_id = $post_id";
	if (!$db->sql_query($sql))
	{
		$result_ar = array(
			'result' => AJAX_ERROR,
			'postid' => $post_id,
			'error_msg' => 'Could not update post subject'
		);
		AJAX_message_die($result_ar);
	}
	
	// Update post edited message (if necessary)
	if (($row['poster_id'] == $userdata['user_id']) && ($post_id != $row['topic_last_post_id']))
	{
		$time_now = time();
		$sql = 'UPDATE '. POSTS_TABLE ." 
		        SET post_edit_time = $time_now, post_edit_count = post_edit_count + 1
		        WHERE post_id = $post_id";
		if (!$db->sql_query($sql))
		{
			$result_ar = array(
				'result' => AJAX_ERROR,
				'postid' => $post_id,
				'error_msg' => 'Could not update post edit information'
			);
			AJAX_message_die($result_ar);
		}
		
		$row['post_edit_time'] = $time_now;
		$row['post_edit_count'] = ($row['post_edit_count'] == NULL) ? 0 : $row['post_edit_count'] + 1;
	}
	// Get new edited message
	if ($row['post_edit_count'])
	{
		$l_edit_time_total = ($row['post_edit_count'] == 1) ? $lang['Edited_time_total'] : $lang['Edited_times_total'];

		if (($row['poster_id'] == ANONYMOUS) && !empty($row['post_username']))
		{
			$row['username'] = $row['post_username'];
		}
		$editmessage = '<br /><br />'. sprintf($l_edit_time_total, $row['username'], create_date($board_config['default_dateformat'], $row['post_edit_time'], $board_config['board_timezone']), $row['post_edit_count']);
	}
	else
	{
		$editmessage = '';
	}
	
	// Truncate the topic title...just like it will be in the database
	$subject = substr(stripslashes($subject), 0, 60);
	
	// Refresh search index for this post (subject only)
	remove_search_post($post_id, True, False);
	add_search_words('single', $post_id, '', $subject);
	
	// Censor the subject
	$raw_subject = $subject;
	$orig_word = array();
	$replacement_word = array();
	obtain_word_list($orig_word, $replacement_word);
	if (count($orig_word))
	{
		$subject = preg_replace($orig_word, $replacement_word, $subject);
	}
	
	// Send it back to client for further processing
	$result_ar = array(
		'result' => AJAX_POST_SUBJECT_EDITED,
		'postid' => $post_id,
		'subject' => (empty($subject)) ? $lang['No_subject'] : unhtmlspecialchars($subject),
		'rawsubject' => unhtmlspecialchars($raw_subject),
		'editmessage' => $editmessage
	);
	AJAX_message_die($result_ar);
}
// Editing of post text
else if ($mode == 'edit_post_text')
{
	include($phpbb_root_path .'includes/functions_search.'. $phpEx);
	include($phpbb_root_path .'includes/bbcode.'. $phpEx);
	
	// Determine post_id and message
	if (isset($HTTP_POST_VARS[POST_POST_URL]) || isset($HTTP_GET_VARS[POST_POST_URL]))
	{
		$post_id = (isset($HTTP_POST_VARS[POST_POST_URL])) ? intval($HTTP_POST_VARS[POST_POST_URL]) : intval($HTTP_GET_VARS[POST_POST_URL]);
	}
	else
	{
		$post_id = 0;
	}
	$message = (isset($HTTP_POST_VARS['message'])) ? utf8_rawurldecode($HTTP_POST_VARS['message']) : '';
	
	// This is only needed on the search page
	if (isset($HTTP_POST_VARS['return_chars']) || isset($HTTP_GET_VARS['return_chars']))
	{
		$return_chars = (isset($HTTP_POST_VARS['return_chars'])) ? intval($HTTP_POST_VARS['return_chars']) : intval($HTTP_GET_VARS['return_chars']);
	}
	else
	{
		$return_chars = -1;
	}
	$highlight_match = $highlight = '';
	if (isset($HTTP_GET_VARS['highlight']) || isset($HTTP_POST_VARS['highlight']))
	{
		// Split words and phrases
		$highlight_string = (isset($HTTP_POST_VARS['highlight'])) ? $HTTP_POST_VARS['highlight'] : $HTTP_GET_VARS['highlight'];
		$words = explode(' ', trim(ajax_htmlspecialchars(utf8_rawurldecode($highlight_string))));
	
		for($i = 0; $i < sizeof($words); $i++)
		{
			if (trim($words[$i]) != '')
			{
				$highlight_match .= (($highlight_match != '') ? '|' : '') . str_replace('*', '\w*', preg_quote($words[$i], '#'));
			}
		}
		unset($words);
	
		$highlight = urlencode($HTTP_GET_VARS['highlight']);
		$highlight_match = phpbb_rtrim($highlight_match, "\\");
	}
	
	// Check if data was submitted
	if (empty($post_id) || empty($message))
	{
		$result_ar = array(
			'result' => AJAX_ERROR,
			'postid' => $post_id,
			'error_msg' => 'No post_id or message specified'
		);
		AJAX_message_die($result_ar);
	}
	
	$sql = 'SELECT p.poster_id, p.forum_id, p.enable_bbcode, p.enable_html, p.enable_smilies, t.topic_last_post_id, t.topic_status, p.post_edit_time, p.post_edit_count, u.username, p.post_username 
	        FROM '. POSTS_TABLE .' p, '. POSTS_TEXT_TABLE .' pt, '. TOPICS_TABLE .' t, '. USERS_TABLE ." u 
	        WHERE p.post_id = $post_id 
	        AND p.topic_id = t.topic_id 
	        AND p.poster_id = u.user_id 
	        AND p.post_id = pt.post_id";
	if (!($result = $db->sql_query($sql)))
	{
		$result_ar = array(
			'result' => AJAX_ERROR,
			'postid' => $post_id,
			'error_msg' => 'Could not fetch post details'
		);
		AJAX_message_die($result_ar);
	}
	$row = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);
	if (!$row)
	{
		$result_ar = array(
			'result' => AJAX_ERROR,
			'postid' => $post_id,
			'error_msg' => 'Invalid post_id'
		);
		AJAX_message_die($result_ar);
	}
	$forum_id = $row['forum_id'];
	
	//Check auth settings
	$is_auth = array();
	$is_auth = auth(AUTH_ALL, $forum_id, $userdata);
	if ((($row['poster_id'] != $userdata['user_id']) || ($row['topic_status'] == TOPIC_LOCKED)) && !$is_auth['auth_mod'])
	{
		$result_ar = array(
			'result' => AJAX_ERROR,
			'postid' => $post_id,
			'error_msg' => 'You are not allowed to edit this post'
		);
		AJAX_message_die($result_ar);
	}
	
	// Prepare message for posting and edit post text
	$bbcode_uid = ($row['enable_bbcode']) ? make_bbcode_uid() : '';
	$message = prepare_message(trim($message), $row['enable_html'], $row['enable_bbcode'], $row['enable_smilies'], $bbcode_uid);
	
	$sql = 'UPDATE '. POSTS_TEXT_TABLE ." 
	        SET post_text = '$message', bbcode_uid = '$bbcode_uid' 
	        WHERE post_id = $post_id";
	if (!$db->sql_query($sql))
	{
		$result_ar = array(
			'result' => AJAX_ERROR,
			'postid' => $post_id,
			'error_msg' => 'Could not update post'
		);
		AJAX_message_die($result_ar);
	}
	
	// Update post edited message (if necessary)
	if (($row['poster_id'] == $userdata['user_id']) && ($post_id != $row['topic_last_post_id']))
	{
		$time_now = time();
		$sql = 'UPDATE '. POSTS_TABLE ." 
		        SET post_edit_time = $time_now, post_edit_count = post_edit_count + 1
		        WHERE post_id = $post_id";
		if (!$db->sql_query($sql))
		{
			$result_ar = array(
				'result' => AJAX_ERROR,
				'postid' => $post_id,
				'error_msg' => 'Could not update post edit information'
			);
			AJAX_message_die($result_ar);
		}
		
		$row['post_edit_time'] = $time_now;
		$row['post_edit_count'] = ($row['post_edit_count'] == NULL) ? 0 : $row['post_edit_count'] + 1;
	}
	// Get new edited message
	if ($row['post_edit_count'])
	{
		$l_edit_time_total = ($row['post_edit_count'] == 1) ? $lang['Edited_time_total'] : $lang['Edited_times_total'];

		if (($row['poster_id'] == ANONYMOUS) && !empty($row['post_username']))
		{
			$row['username'] = $row['post_username'];
		}
		$editmessage = '<br /><br />'. sprintf($l_edit_time_total, $row['username'], create_date($board_config['default_dateformat'], $row['post_edit_time'], $board_config['board_timezone']), $row['post_edit_count']);
	}
	else
	{
		$editmessage = '';
	}
	
	$raw_message = $message = stripslashes($message);
	
	// Refresh search index for this post (message only)
	remove_search_post($post_id, False);
	add_search_words('single', $post_id, $message);
	
	// Prepare the new raw message for the textarea
	if (!empty($bbcode_uid))
	{
		$raw_message = preg_replace('#\:(([a-z0-9]\:)?)'. $bbcode_uid .'#s', '', $raw_message);
	}
	
	$raw_message = str_replace('<', '&lt;', $raw_message);
	$raw_message = str_replace('>', '&gt;', $raw_message);
	$raw_message = str_replace('<br />', "\n", $raw_message);
	
	// Now parse the message
	if ($return_chars == -1)
	{
		if ((!$board_config['allow_html'] || !$userdata['user_allowhtml']) && $row['enable_html'])
		{
			$message = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", $message);
		}
		if ($bbcode_uid != '')
		{
			$message = ($board_config['allow_bbcode']) ? bbencode_second_pass($message, $bbcode_uid) : preg_replace("/\:$bbcode_uid/si", '', $message);
		}
		$message = make_clickable($message);
		
		if ($highlight_match)
		{
			// This has been back-ported from 3.0 CVS
			$message = preg_replace('#(?!<.*)(?<!\w)(' . $highlight_match . ')(?!\w|[^<>]*>)#i', '<b style="color:#'.$theme['fontcolor3'].'">\1</b>', $message);
		}
	}
	else
	{
		$message = strip_tags($message);
		$message = preg_replace("/\[.*?:$bbcode_uid:?.*?\]/si", '', $message);
		$message = preg_replace('/\[url\]|\[\/url\]/si', '', $message);
		$message = ( strlen($message) > $return_chars ) ? substr($message, 0, $return_chars) . ' ...' : $message;
	}
	
	$orig_word = array();
	$replacement_word = array();
	obtain_word_list($orig_word, $replacement_word);
	if (count($orig_word))
	{
		$message = str_replace('\"', '"', substr(@preg_replace('#(\>(((?>([^><]+|(?R)))*)\<))#se', "@preg_replace(\$orig_word, \$replacement_word, '\\0')", '>' . $message . '<'), 1, -1));
	}
	
	if ($board_config['allow_smilies'] && $row['enable_smilies'])
	{
		$message = smilies_pass($message);
	}
	
	$message = str_replace("\n", "\n<br />\n", $message);
	
	// Send it back to client for further processing
	$result_ar = array(
		'result' => AJAX_POST_TEXT_EDITED,
		'postid' => $post_id,
		'message' => '<span class="postbody">'. $message .'</span>',
		'rawmessage' => unhtmlspecialchars($raw_message),
		'editmessage' => $editmessage
	);
	AJAX_message_die($result_ar);
}
// Voting/Viewing of polls
else if (($mode == 'vote_poll') || ($mode == 'view_poll') || ($mode == 'view_ballot'))
{
	// Get topic_id
	if (isset($HTTP_POST_VARS[POST_TOPIC_URL]) || isset($HTTP_GET_VARS[POST_TOPIC_URL]))
	{
		$topic_id = (isset($HTTP_POST_VARS[POST_TOPIC_URL])) ? intval($HTTP_POST_VARS[POST_TOPIC_URL]) : intval($HTTP_GET_VARS[POST_TOPIC_URL]);
	}
	else
	{
		$topic_id = 0;
	}
	
	if (empty($topic_id))
	{
		$result_ar = array(
			'result' => AJAX_ERROR,
			'error_msg' => 'No topic_id'
		);
		AJAX_message_die($result_ar);
	}
	
	// Get vote_option_id and vote_id
	if ($mode == 'vote_poll')
	{
		if (isset($HTTP_POST_VARS['vote_option_id']) || isset($HTTP_GET_VARS['vote_option_id']))
		{
			$vote_option_id = (isset($HTTP_POST_VARS['vote_option_id'])) ? intval($HTTP_POST_VARS['vote_option_id']) : intval($HTTP_GET_VARS['vote_option_id']);
		}
		else
		{
			$vote_option_id = 0;
		}
		
		if (!empty($vote_option_id))
		{
			// Get vote_id from vote_option_id
			$sql = 'SELECT vd.*, t.forum_id, t.topic_id, t.topic_status 
			        FROM '. VOTE_DESC_TABLE .' vd, '. VOTE_RESULTS_TABLE .' vr, '. TOPICS_TABLE ." t 
			        WHERE vr.vote_id = vd.vote_id 
			        AND t.topic_id = vd.topic_id 
			        AND vr.vote_option_id = $vote_option_id 
			        AND t.topic_id = $topic_id 
			        GROUP BY vd.vote_id";
			if (!($result = $db->sql_query($sql)))
			{
				$error = $db->sql_error();
				$result_ar = array(
					'result' => AJAX_ERROR,
					'error_msg' => 'Could not query vote information'
				);
				AJAX_message_die($result_ar);
			}
			$vote_info = $db->sql_fetchrow($result);
			$db->sql_freeresult($result);
		}
	}
	else
	{
		// Get vote_id from vote_option_id
		$sql = 'SELECT vd.*, t.forum_id, t.topic_id, t.topic_status 
		        FROM '. VOTE_DESC_TABLE .' vd, '. TOPICS_TABLE ." t 
		        WHERE t.topic_id = vd.topic_id 
		        AND t.topic_id = $topic_id 
		        GROUP BY vd.vote_id";
		if (!($result = $db->sql_query($sql)))
		{
			$error = $db->sql_error();
			$result_ar = array(
				'result' => AJAX_ERROR,
				'error_msg' => 'Could not query vote information'
			);
			AJAX_message_die($result_ar);
		}
		$vote_info = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);
	}
	
	if ($vote_info)
	{
		// Check if the user is allowed to vote
		$is_auth = auth(AUTH_ALL, $vote_info['forum_id'], $userdata);
		$poll_expired = ($vote_info['vote_length']) ? (($vote_info['vote_start'] + $vote_info['vote_length'] < time()) ? True : False) : False;
		$can_vote = $is_auth['auth_vote'] && (($vote_info['topic_status'] != TOPIC_LOCKED) || ($is_auth['auth_mod'])) && !$poll_expired;
		if ($can_vote)
		{
			$vote_id = intval($vote_info['vote_id']);
		
			// Check if the user already voted
			$sql = 'SELECT * FROM '. VOTE_USERS_TABLE ." 
			        WHERE vote_id = $vote_id 
			        AND vote_user_id = ". $userdata['user_id'];
			if (!($result = $db->sql_query($sql)))
			{
				$result_ar = array(
					'result' => AJAX_ERROR,
					'error_msg' => 'Could not obtain user vote data for this topic'
				);
				AJAX_message_die($result_ar);
			}
			$row = $db->sql_fetchrow($result);
			$db->sql_freeresult($result);
			
			$can_vote = $can_vote && !$row;

			if (!$row && ($mode == 'vote_poll'))
			{
				$sql = 'UPDATE '. VOTE_RESULTS_TABLE ." 
				        SET vote_result = vote_result + 1 
				        WHERE vote_id = $vote_id 
				        AND vote_option_id = $vote_option_id";
				if (!$db->sql_query($sql, BEGIN_TRANSACTION))
				{
					$result_ar = array(
						'result' => AJAX_ERROR,
						'error_msg' => 'Could not update poll result (1):'. $mode
					);
					AJAX_message_die($result_ar);
				}
			
				$sql = 'INSERT INTO '. VOTE_USERS_TABLE ." (vote_id, vote_user_id, vote_user_ip) 
				        VALUES ($vote_id, ". $userdata['user_id'] .", '$user_ip')";
				if (!$db->sql_query($sql, END_TRANSACTION))
				{
					$result_ar = array(
						'result' => AJAX_ERROR,
						'error_msg' => 'Could not update poll result (2):'. $mode
					);
					AJAX_message_die($result_ar);
				}
				$can_vote = False;
			}
			else if (!$can_vote && ($mode == 'view_ballot'))
			{
				$mode = 'view_poll';
			}
		}
	}
	
	// Display vote information
	$sql = 'SELECT vd.vote_id, vd.vote_text, vd.vote_start, vd.vote_length, vr.vote_option_id, vr.vote_option_text, vr.vote_result 
	        FROM '. VOTE_DESC_TABLE .' vd, '. VOTE_RESULTS_TABLE ." vr 
	        WHERE vd.topic_id = $topic_id 
	        AND vr.vote_id = vd.vote_id 
	        ORDER BY vr.vote_option_id ASC";
	if (!($result = $db->sql_query($sql)))
	{
		$result_ar = array(
			'result' => AJAX_ERROR,
			'error_msg' => 'Could not get vote information'
		);
		AJAX_message_die($result_ar);
	}
	$vote_info = $db->sql_fetchrowset($result);
	$db->sql_freeresult($result);
	
	if (!$vote_info)
	{
		$result_ar = array(
			'result' => AJAX_ERROR,
			'error_msg' => 'Could not get vote information'
		);
		AJAX_message_die($result_ar);
	}

	
	$vote_options = count($vote_info);

	$vote_id = $vote_info[0]['vote_id'];
	$vote_title = $vote_info[0]['vote_text'];

	if (count($orig_word))
	{
		$vote_title = preg_replace($orig_word, $replacement_word, $vote_title);
	}
	
	if ($mode == 'view_ballot')
	{
		$template->set_filenames(array(
			'pollbox' => 'viewtopic_poll_ballot.tpl')
		);
		
		for ($i = 0; $i < $vote_options; $i++)
		{
			if (count($orig_word))
			{
				$vote_info[$i]['vote_option_text'] = preg_replace($orig_word, $replacement_word, $vote_info[$i]['vote_option_text']);
			}
			
			$template->assign_block_vars('poll_option', array(
				'POLL_OPTION_ID' => $vote_info[$i]['vote_option_id'],
				'POLL_OPTION_CAPTION' => $vote_info[$i]['vote_option_text'])
			);
		}
		
		$template->assign_vars(array(
			'L_SUBMIT_VOTE' => $lang['Submit_vote'],
			'L_VIEW_RESULTS' => $lang['View_results'],
			
			'U_VIEW_RESULTS' => append_sid("viewtopic.$phpEx?". POST_TOPIC_URL ."=$topic_id&amp;postdays=$post_days&amp;postorder=$post_order&amp;vote=viewresult"),
			'S_HIDDEN_FIELDS' => '<input type="hidden" name="topic_id" value="' . $topic_id . '" /><input type="hidden" name="mode" value="vote" />')
		);
	}
	else
	{
		$template->set_filenames(array(
			'pollbox' => 'viewtopic_poll_result.tpl')
		);
	
		$vote_results_sum = 0;
	
		for ($i = 0; $i < $vote_options; $i++)
		{
			$vote_results_sum += $vote_info[$i]['vote_result'];
		}
	
		$vote_graphic = 0;
		$vote_graphic_max = count($images['voting_graphic']);
	
		$orig_word = array();
		$replacement_word = array();
		obtain_word_list($orig_word, $replacement_word);
		
		for ($i = 0; $i < $vote_options; $i++)
		{
			$vote_percent = ($vote_results_sum > 0) ? $vote_info[$i]['vote_result'] / $vote_results_sum : 0;
			$vote_graphic_length = round($vote_percent * $board_config['vote_graphic_length']);
	
			$vote_graphic_img = $images['voting_graphic'][$vote_graphic];
			$vote_graphic = ($vote_graphic < $vote_graphic_max - 1) ? $vote_graphic + 1 : 0;
	
			if (count($orig_word))
			{
				$vote_info[$i]['vote_option_text'] = preg_replace($orig_word, $replacement_word, $vote_info[$i]['vote_option_text']);
			}
	
			$template->assign_block_vars('poll_option', array(
				'POLL_OPTION_CAPTION' => $vote_info[$i]['vote_option_text'],
				'POLL_OPTION_RESULT' => $vote_info[$i]['vote_result'],
				'POLL_OPTION_PERCENT' => sprintf("%.1d%%", ($vote_percent * 100)),
	
				'POLL_OPTION_IMG' => $vote_graphic_img,
				'POLL_OPTION_IMG_WIDTH' => $vote_graphic_length)
			);
		}
	
		$template->assign_vars(array(
			'L_TOTAL_VOTES' => $lang['Total_votes'],
			'L_VIEW_BALLOT' => $lang['View_ballot'],
			'U_VIEW_BALLOT' => append_sid("viewtopic.$phpEx?". POST_TOPIC_URL ."=$topic_id&amp;postdays=$post_days&amp;postorder=$post_order"),
			'S_POLL_ACTION' => append_sid("posting.$phpEx?mode=vote&amp;". POST_TOPIC_URL ."=$topic_id"),
			'TOTAL_VOTES' => $vote_results_sum)
		);
		
		if ($can_vote)
		{
			$template->assign_block_vars('switch_view_ballot', array());
		}
	}
	
	$template->assign_vars(array(
		'POLL_QUESTION' => $vote_title,
		'TOPIC_ID' => $topic_id)
	);
	
	// Get the compiled code for the pollbox
	$template->assign_var_from_handle('__POLL_RESULT__', 'pollbox');
	$tpl_code = trim($template->_tpldata['.'][0]['__POLL_RESULT__']);
	unset($template->_tpldata['.'][0]['__POLL_RESULT__']);
	
	// Get rid of the sorrounding <tr> and <td> tags. May not work with some templates
	// We have no other choice, because Firefox does not support outerHTML :(
	// Then on the other hand, IE seems to have a problem with setting innerHTML on a <tr> tag...did I mention that I hate browsers?
	$tpl_code = trim(preg_replace("#^\<tr\>(.*)\<\/tr\>$#si", '\1', $tpl_code));
	$tpl_code = trim(preg_replace("#^\<td(.*?)\>(.*)\<\/td\>$#si", '\2', $tpl_code));
	
	$result_ar = array(
		'result' => AJAX_POLL_RESULT,
		'error_msg' => $tpl_code
	);
	AJAX_message_die($result_ar);
}
else if ($mode == 'watch_topic')
{
	// Get topic_id
	if (isset($HTTP_POST_VARS[POST_TOPIC_URL]) || isset($HTTP_GET_VARS[POST_TOPIC_URL]))
	{
		$topic_id = (isset($HTTP_POST_VARS[POST_TOPIC_URL])) ? intval($HTTP_POST_VARS[POST_TOPIC_URL]) : intval($HTTP_GET_VARS[POST_TOPIC_URL]);
	}
	else
	{
		$topic_id = 0;
	}
	
	if (empty($topic_id))
	{
		$result_ar = array(
			'result' => AJAX_ERROR,
			'error_msg' => 'No topic_id'
		);
		AJAX_message_die($result_ar);
	}
	
	// Get watch_status
	if (isset($HTTP_POST_VARS['watch_status']) || isset($HTTP_GET_VARS['watch_status']))
	{
		$watch_status = (isset($HTTP_POST_VARS['watch_status'])) ? intval($HTTP_POST_VARS['watch_status']) : intval($HTTP_GET_VARS['watch_status']);
	}
	else
	{
		$watch_status = 0;
	}
	
	// Get start
	if (isset($HTTP_POST_VARS['start']) || isset($HTTP_GET_VARS['start']))
	{
		$start = (isset($HTTP_POST_VARS['start'])) ? intval($HTTP_POST_VARS['start']) : intval($HTTP_GET_VARS['start']);
	}
	else
	{
		$start = 0;
	}
	
	// Not logged in? Bye bye
	if (!$userdata['session_logged_in'])
	{
		$result_ar = array(
			'result' => AJAX_ERROR,
			'error_msg' => 'Not logged in'
		);
		AJAX_message_die($result_ar);
	}
	
	// Get the forum_id for the auth check below, also a nice way to check if the topic exists
	$sql = 'SELECT forum_id FROM '. TOPICS_TABLE ." 
	        WHERE topic_id = $topic_id";
	if (!($result = $db->sql_query($sql)))
	{
		$result_ar = array(
			'result' => AJAX_ERROR,
			'error_msg' => 'Could not query topics table'
		);
		AJAX_message_die($result_ar);
	}
	$topic_row = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);
	
	if (!$topic_row)
	{
		$result_ar = array(
			'result' => AJAX_ERROR,
			'error_msg' => 'This topic does not exist'
		);
		AJAX_message_die($result_ar);
	}
	
	// Check the permissions, don't want people to watch topics they're not supposed to read.
	// If the person is not authed, we'll just pretend that the topic doesn't exist, just like phpBB does...
	$is_auth = auth(AUTH_READ, $topic_row['forum_id'], $userdata);
	if (!$is_auth['auth_read'])
	{
		$result_ar = array(
			'result' => AJAX_ERROR,
			'error_msg' => 'This topic does not exist'
		);
		AJAX_message_die($result_ar);
	}
	
	// Check if the user is already watching this topic
	$sql = 'SELECT notify_status FROM '. TOPICS_WATCH_TABLE ." 
	        WHERE topic_id = $topic_id 
	        AND user_id = ". $userdata['user_id'];
	if (!($result = $db->sql_query($sql)))
	{
		$result_ar = array(
			'result' => AJAX_ERROR,
			'error_msg' => 'Could not query topics watch table'
		);
		AJAX_message_die($result_ar);
	}
	$watch_row = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);
	
	if ($watch_row)
	{
		// User is watching this topic
		if ($watch_status)
		{
			$result_ar = array(
				'result' => AJAX_ERROR,
				'error_msg' => 'You are already watching this topic'
			);
			AJAX_message_die($result_ar);
		}
		
		// Remove topic from watch list
		$sql = 'DELETE FROM '. TOPICS_WATCH_TABLE ." 
		        WHERE topic_id = $topic_id 
		        AND user_id = ". $userdata['user_id'];
		if (!$db->sql_query($sql))
		{
			$result_ar = array(
				'result' => AJAX_ERROR,
				'error_msg' => 'Could not delete topic from watch table'
			);
			AJAX_message_die($result_ar);
		}
		
		$link_url = append_sid("viewtopic.$phpEx?". POST_TOPIC_URL . "=$topic_id&watch=topic&start=$start");
		$link_text = $lang['Start_watching_topic'];
		$img_url = $images['Topic_watch'];
		$watching = 0;
	}
	else
	{
		// User is not watching this topic
		if (!$watch_status)
		{
			$result_ar = array(
				'result' => AJAX_ERROR,
				'error_msg' => 'You are not watching this topic'
			);
			AJAX_message_die($result_ar);
		}
		
		// Add topic to watch list
		$sql = 'INSERT INTO '. TOPICS_WATCH_TABLE .' (user_id, topic_id, notify_status) 
		        VALUES ('. $userdata['user_id'] .", $topic_id, 0)";
		if (!$db->sql_query($sql))
		{
			$result_ar = array(
				'result' => AJAX_ERROR,
				'error_msg' => 'Could not add topic to watch table'
			);
			AJAX_message_die($result_ar);
		}
		
		$link_url = append_sid("viewtopic.$phpEx?". POST_TOPIC_URL . "=$topic_id&unwatch=topic&start=$start");
		$link_text = $lang['Stop_watching_topic'];
		$img_url = $images['topic_un_watch'];
		$watching = 1;
	}
	
	$result_ar = array(
		'result' => AJAX_WATCH_TOPIC,
		'topicid' => $topic_id,
		'linkurl' => $link_url,
		'linktext' => $link_text,
		'imgurl' => $img_url,
		'start' => $start,
		'watching' => $watching
	);
	AJAX_message_die($result_ar);
}
else if ($mode == 'lock_topic')
{
	// Get topic_id
	if (isset($HTTP_POST_VARS[POST_TOPIC_URL]) || isset($HTTP_GET_VARS[POST_TOPIC_URL]))
	{
		$topic_id = (isset($HTTP_POST_VARS[POST_TOPIC_URL])) ? intval($HTTP_POST_VARS[POST_TOPIC_URL]) : intval($HTTP_GET_VARS[POST_TOPIC_URL]);
	}
	else
	{
		$topic_id = 0;
	}
	
	if (empty($topic_id))
	{
		$result_ar = array(
			'result' => AJAX_ERROR,
			'error_msg' => 'No topic_id'
		);
		AJAX_message_die($result_ar);
	}
	
	// Get watch_status
	if (isset($HTTP_POST_VARS['lock_status']) || isset($HTTP_GET_VARS['lock_status']))
	{
		$lock_status = (isset($HTTP_POST_VARS['lock_status'])) ? intval($HTTP_POST_VARS['lock_status']) : intval($HTTP_GET_VARS['lock_status']);
	}
	else
	{
		$lock_status = 0;
	}
	
	$sql = 'SELECT forum_id, topic_status FROM '. TOPICS_TABLE ." 
	        WHERE topic_id = $topic_id";
	if (!($result = $db->sql_query($sql)))
	{
		$result_ar = array(
			'result' => AJAX_ERROR,
			'error_msg' => 'Could not query topics table'
		);
		AJAX_message_die($result_ar);
	}
	$topic_row = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);
	
	if (!$topic_row)
	{
		$result_ar = array(
			'result' => AJAX_ERROR,
			'error_msg' => 'This topic does not exist'
		);
		AJAX_message_die($result_ar);
	}
	
	$is_auth = auth(AUTH_MOD, $topic_row['forum_id'], $userdata);
	if (!$is_auth['auth_mod'])
	{
		$result_ar = array(
			'result' => AJAX_ERROR,
			'error_msg' => 'You cannot lock/unlock this topic'
		);
		AJAX_message_die($result_ar);
	}
	
	if ($topic_row['topic_status'] == TOPIC_LOCKED)
	{
		if ($lock_status)
		{
			$result_ar = array(
				'result' => AJAX_ERROR,
				'error_msg' => 'Topic already locked'
			);
			AJAX_message_die($result_ar);
		}
		
		$sql = 'UPDATE '. TOPICS_TABLE .' 
		        SET topic_status = '. TOPIC_UNLOCKED ." 
		        WHERE topic_id = $topic_id";
		if (!$db->sql_query($sql))
		{
			$result_ar = array(
				'result' => AJAX_ERROR,
				'error_msg' => 'Could not update topics table'
			);
			AJAX_message_die($result_ar);
		}
		
		$linkurl = "modcp.$phpEx?". POST_TOPIC_URL ."=$topic_id&mode=lock&sid=". $userdata['session_id'];
		$imgurl = $images['topic_mod_lock'];
		$imgtext = $lang['Lock_topic'];
		$replyurl = $images['reply_new'];
		$replytext = $lang['Reply_to_topic'];
		$locked = 0;
	}
	else
	{
		if (!$lock_status)
		{
			$result_ar = array(
				'result' => AJAX_ERROR,
				'error_msg' => 'Topic not locked'
			);
			AJAX_message_die($result_ar);
		}
		
		$sql = 'UPDATE '. TOPICS_TABLE .' 
		        SET topic_status = '. TOPIC_LOCKED ." 
		        WHERE topic_id = $topic_id";
		if (!$db->sql_query($sql))
		{
			$result_ar = array(
				'result' => AJAX_ERROR,
				'error_msg' => 'Could not update topics table'
			);
			AJAX_message_die($result_ar);
		}
		
		$linkurl = "modcp.$phpEx?". POST_TOPIC_URL ."=$topic_id&mode=unlock&sid=". $userdata['session_id'];
		$imgurl = $images['topic_mod_unlock'];
		$imgtext = $lang['Unlock_topic'];
		$replyurl = $images['reply_locked'];
		$replytext = $lang['Topic_locked'];
		$locked = 1;
	}
	
	$result_ar = array(
		'result' => AJAX_LOCK_TOPIC,
		'topicid' => $topic_id,
		'linkurl' => $linkurl,
		'imgurl' => $imgurl,
		'imgtext' => $imgtext,
		'replyurl' => $replyurl,
		'replytext' => $replytext,
		'locked' => $locked
	);
	AJAX_message_die($result_ar);
}
else if ($mode == 'mark_topic')
{
	if (!$userdata['session_logged_in'])
	{
		$result_ar = array(
			'result' => AJAX_ERROR,
			'error_msg' => 'Not logged in'
		);
		AJAX_message_die($result_ar);
	}
	
	// Get topic_id
	if (isset($HTTP_POST_VARS[POST_TOPIC_URL]) || isset($HTTP_GET_VARS[POST_TOPIC_URL]))
	{
		$topic_id = (isset($HTTP_POST_VARS[POST_TOPIC_URL])) ? intval($HTTP_POST_VARS[POST_TOPIC_URL]) : intval($HTTP_GET_VARS[POST_TOPIC_URL]);
	}
	else
	{
		$topic_id = 0;
	}
	
	if (empty($topic_id))
	{
		$result_ar = array(
			'result' => AJAX_ERROR,
			'error_msg' => 'No topic_id'
		);
		AJAX_message_die($result_ar);
	}
	
	$sql = 'SELECT topic_type, topic_status, topic_replies FROM '. TOPICS_TABLE ." 
	        WHERE topic_id = $topic_id";
	if (!($result = $db->sql_query($sql)))
	{
		$result_ar = array(
			'result' => AJAX_ERROR,
			'error_msg' => 'Could not query topics table'
		);
		AJAX_message_die($result_ar);
	}
	$topic_row = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);
	
	if (!$topic_row)
	{
		$result_ar = array(
			'result' => AJAX_ERROR,
			'error_msg' => 'This topic does not exist'
		);
		AJAX_message_die($result_ar);
	}
	
	if ($topic_row['topic_status'] == TOPIC_MOVED)
	{
		$result_ar = array(
			'result' => AJAX_ERROR,
			'error_msg' => 'Cannot mark move stubs'
		);
		AJAX_message_die($result_ar);
	}
	
	$tracking_topics = (isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] .'_t'])) ? unserialize($HTTP_COOKIE_VARS[$board_config['cookie_name'] .'_t']) : array();
	$tracking_forums = (isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] .'_f'])) ? unserialize($HTTP_COOKIE_VARS[$board_config['cookie_name'] .'_f']) : array();

	if (count($tracking_topics) >= 150 && empty($tracking_topics[$topic_id]))
	{
		asort($tracking_topics);
		unset($tracking_topics[key($tracking_topics)]);
	}

	$tracking_topics[$topic_id] = time();

	setcookie($board_config['cookie_name'] .'_t', serialize($tracking_topics), 0, $board_config['cookie_path'], $board_config['cookie_domain'], $board_config['cookie_secure']);
	
	if ($topic_row['topic_type'] == POST_ANNOUNCE)
	{
		$topic_image = $images['folder_announce'];
	}
	else if ($topic_row['topic_type'] == POST_STICKY)
	{
		$topic_image = $images['folder_sticky'];
	}
	else if ($topic_row['topic_status'] == TOPIC_LOCKED)
	{
		$topic_image = $images['folder_locked'];
	}
	else if ($topic_row['topic_replies'] >= $board_config['hot_threshold'])
	{
		$topic_image = $images['folder_hot'];
	}
	else
	{
		$topic_image = $images['folder'];
	}
	
	$result_ar = array(
		'result' => AJAX_MARK_TOPIC,
		'topicid' => $topic_id,
		'topicimage' => $topic_image,
		'imagetext' => $lang['No_new_posts']
	);
	AJAX_message_die($result_ar);
}
else if ($mode == 'mark_forum')
{
	if (!$userdata['session_logged_in'])
	{
		$result_ar = array(
			'result' => AJAX_ERROR,
			'error_msg' => 'Not logged in'
		);
		AJAX_message_die($result_ar);
	}
	
	// Get forum_id
	if (isset($HTTP_POST_VARS[POST_FORUM_URL]) || isset($HTTP_GET_VARS[POST_FORUM_URL]))
	{
		$forum_id = (isset($HTTP_POST_VARS[POST_FORUM_URL])) ? intval($HTTP_POST_VARS[POST_FORUM_URL]) : intval($HTTP_GET_VARS[POST_FORUM_URL]);
	}
	else
	{
		$forum_id = 0;
	}
	
	if (empty($forum_id))
	{
		$result_ar = array(
			'result' => AJAX_ERROR,
			'error_msg' => 'No forum_id'
		);
		AJAX_message_die($result_ar);
	}
	
	$sql = 'SELECT forum_status FROM '. FORUMS_TABLE ." 
	        WHERE forum_id = $forum_id";
	if (!($result = $db->sql_query($sql)))
	{
		$result_ar = array(
			'result' => AJAX_ERROR,
			'error_msg' => 'Could not query forums table'
		);
		AJAX_message_die($result_ar);
	}
	$forum_row = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);
	
	if (!$forum_row)
	{
		$result_ar = array(
			'result' => AJAX_ERROR,
			'error_msg' => 'This forum does not exist'
		);
		AJAX_message_die($result_ar);
	}
	
	$tracking_forums = (isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] .'_f'])) ? unserialize($HTTP_COOKIE_VARS[$board_config['cookie_name'] .'_f']) : array();
	$tracking_topics = (isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] .'_t'])) ? unserialize($HTTP_COOKIE_VARS[$board_config['cookie_name'] .'_t']) : array();

	if ((count($tracking_forums) + count($tracking_topics)) >= 150 && empty($tracking_forums[$forum_id]))
	{
		asort($tracking_forums);
		unset($tracking_forums[key($tracking_forums)]);
	}
	
	$tracking_forums[$forum_id] = time();
	
	setcookie($board_config['cookie_name'] .'_f', serialize($tracking_forums), 0, $board_config['cookie_path'], $board_config['cookie_domain'], $board_config['cookie_secure']);
	
	if ($forum_row['forum_status'] == FORUM_LOCKED)
	{
		$forum_image = $images['forum_locked'];
		$image_text = $lang['Forum_locked'];
	}
	else
	{
		$forum_image = $images['forum'];
		$image_text = $lang['No_new_posts'];
	}
	
	$result_ar = array(
		'result' => AJAX_MARK_FORUM,
		'forumid' => $forum_id,
		'forumimage' => $forum_image,
		'imagetext' => $image_text
	);
	AJAX_message_die($result_ar);
}
else if ($mode == 'checkusername_post')
{
	include($phpbb_root_path .'includes/functions_validate.'. $phpEx);
	
	if (isset($HTTP_GET_VARS['username']) || isset($HTTP_POST_VARS['username']))
	{
		$username = (isset($HTTP_POST_VARS['username'])) ? utf8_rawurldecode($HTTP_POST_VARS['username']) : utf8_rawurldecode($HTTP_GET_VARS['username']);
	}
	else
	{
		$username = '';
	}
	
	$result_code = AJAX_OP_COMPLETED;
	$error_msg = '';
	if (!empty($username))
	{
		$username = phpbb_clean_username($username);

		if (!$userdata['session_logged_in'] || ($userdata['session_logged_in'] && $username != $userdata['username']))
		{
			$result = validate_username($username);
			if ($result['error'])
			{
				$result_code = AJAX_ERROR;
				$error_msg = $result['error_msg'];
			}
		}
	}
	
	$result_ar = array(
		'result' => $result_code
	);
	if (!empty($error_msg))
	{
		$result_ar['error_msg'] = $error_msg;
	}
	AJAX_message_die($result_ar);
}
else if (($mode == 'checkusername_pm') || ($mode == 'search_user'))
{
	include($phpbb_root_path .'includes/functions_validate.'. $phpEx);
	
	// Get username
	if (isset($HTTP_GET_VARS['username']) || isset($HTTP_POST_VARS['username']))
	{
		$username = (isset($HTTP_POST_VARS['username'])) ? utf8_rawurldecode($HTTP_POST_VARS['username']) : utf8_rawurldecode($HTTP_GET_VARS['username']);
	}
	else
	{
		$username = '';
	}
	if (isset($HTTP_GET_VARS['search']) || isset($HTTP_POST_VARS['search']))
	{
		$search = (isset($HTTP_POST_VARS['search'])) ? intval($HTTP_POST_VARS['search']) : intval($HTTP_GET_VARS['search']);
	}
	else
	{
		$search = 0;
	}
	
	if (empty($username))
	{
		if ($mode == 'checkusername_pm')
		{
			$error_msg = $lang['No_to_user'];
		}
		else if (!$search)
		{
			$error_msg = $lang['No_username'];
		}
		else
		{
			$error_msg = '&nbsp;';
		}
		$result_ar = array(
			'result' => AJAX_PM_USERNAME_ERROR,
			'error_msg' => $error_msg
		);
		AJAX_message_die($result_ar);
	}
	
	$username = phpbb_clean_username($username);
	if ($mode == 'search_user')
	{
		$has_wildcards = (strpos($username, '*') !== False) ? True : False;
		$username = preg_replace('#\*#', '%', phpbb_clean_username($username));
	}
	
	$username_row = False;
	if (($mode == 'checkusername_pm') || (($mode == 'search_user') && !$has_wildcards))
	{
		$sql = 'SELECT user_id 
		        FROM '. USERS_TABLE ."
		        WHERE username='$username' 
		        AND user_id <> ". ANONYMOUS;
		if (!($result = $db->sql_query($sql)))
		{
			$result_ar = array(
				'result' => AJAX_OP_COMPLETED
			);
			AJAX_message_die($result_ar);
		}
		$username_row = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);
	}
	
	if ($username_row)
	{
		$result_ar = array(
			'result' => AJAX_PM_USERNAME_FOUND
		);
		AJAX_message_die($result_ar);
	}
	else
	{
		if (substr($username, -1, 1) !== '%')
		{
			$username .= '%';
		}
		$sql = 'SELECT username 
		        FROM '. USERS_TABLE ."
		        WHERE username LIKE '{$username}' 
		        AND user_id <> ". ANONYMOUS .' 
		        ORDER BY username';
		if (!($result = $db->sql_query($sql)))
		{
			$result_ar = array(
				'result' => AJAX_OP_COMPLETED
			);
			AJAX_message_die($result_ar);
		}
		$username_rows = $db->sql_fetchrowset($result);
		$db->sql_freeresult($result);
		
		if (!($username_count = count($username_rows)))
		{
			$result_ar = array(
				'result' => AJAX_PM_USERNAME_ERROR,
				'error_msg' => $lang['No_such_user']
			);
			AJAX_message_die($result_ar);
		}
		else
		{
			if ($mode == 'checkusername_pm')
			{
				$username_select = '&nbsp;<select onclick="AJAXSelectPMUsername(this)" onblur="AJAXSelectPMUsername(this);" tabindex="1">';
			}
			else
			{
				if ($search)
				{
					$username_select = '<select name="username_list" onclick="refresh_username(this.form.username_list.options[this.form.username_list.selectedIndex].value);" onblur="refresh_username(this.form.username_list.options[this.form.username_list.selectedIndex].value);">';
				}
				else
				{
					$username_select = '&nbsp;<select onclick="AJAXSelectUsername(this)" onblur="AJAXSelectUsername(this);" tabindex="1">';
				}
			}
			$username_select .= '<option value="-1"> --- </option>';
			for ($i = 0; $i < $username_count; $i++)
			{
				$username_select .= '<option value="'. $username_rows[$i]['username'] .'">'. $username_rows[$i]['username'] .'</option>';
			}
			$username_select .= '</select>';
			
			$result_ar = array(
				'result' => AJAX_PM_USERNAME_SELECT,
				'error_msg' => $username_select
			);
			AJAX_message_die($result_ar);
		}
	}
	
	$result_ar = array(
		'result' => AJAX_OP_COMPLETED
	);
	AJAX_message_die($result_ar);
}
else if ($mode == 'checkemail')
{
	include($phpbb_root_path .'includes/functions_validate.'. $phpEx);
	
	if (isset($HTTP_GET_VARS['email']) || isset($HTTP_POST_VARS['email']))
	{
		$email = (isset($HTTP_POST_VARS['email'])) ? stripslashes(utf8_rawurldecode($HTTP_POST_VARS['email'])) : stripslashes(utf8_rawurldecode($HTTP_GET_VARS['email']));
	}
	else
	{
		$email = '';
	}
	
	$result_code = AJAX_OP_COMPLETED;
	$error_msg = '';
	if ((!empty($email)) && ((($email != $userdata['user_email']) && $userdata['session_logged_in']) || !$userdata['session_logged_in']))
	{
			$result = validate_email($email);
			if ($result['error'])
			{
				$result_code = AJAX_ERROR;
				$error_msg = $result['error_msg'];
			}
	}
	
	$result_ar = array(
		'result' => $result_code
	);
	if (!empty($error_msg))
	{
		$result_ar['error_msg'] = $error_msg;
	}
	AJAX_message_die($result_ar);
}
else if ($mode == 'post_preview')
{
	include($phpbb_root_path .'includes/bbcode.'. $phpEx);
	
	// Get post_id
	if (isset($HTTP_POST_VARS[POST_POST_URL]) || isset($HTTP_GET_VARS[POST_POST_URL]))
	{
		$post_id = (isset($HTTP_POST_VARS[POST_POST_URL])) ? intval($HTTP_POST_VARS[POST_POST_URL]) : intval($HTTP_GET_VARS[POST_POST_URL]);
	}
	else
	{
		$post_id = 0;
	}
	if (!empty($post_id))
	{
		$sql = 'SELECT p.poster_id, p.post_username, u.username, u.user_sig, u.user_sig_bbcode_uid, u.user_allowhtml, u.user_allowbbcode, u.user_allowsmile 
		        FROM '. POSTS_TABLE .' p, '. USERS_TABLE ." u 
		        WHERE p.post_id = $post_id 
		        AND p.poster_id = u.user_id";
		if (!($result = $db->sql_query($sql)))
		{
			$result_ar = array(
				'result' => AJAX_ERROR,
				'error_msg' => 'Could not get post information'
			);
			AJAX_message_die($result_ar);
		}
		$row = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);
		
		if (!$row)
		{
			$result_ar = array(
				'result' => AJAX_ERROR,
				'error_msg' => 'This post does not exist'
			);
			AJAX_message_die($result_ar);
		}
		
		$user_sig_bbcode_uid = $row['user_sig_bbcode_uid'];
		$user_sig = $row['user_sig'];
		$username = ($row['poster_id'] == ANONYMOUS) ? ((!empty($row['post_username'])) ? $row['post_username'] : '') : $row['username'];
		$user_allowhtml = $row['user_allowhtml'];
		$user_allowbbcode = $row['user_allowbbcode'];
		$user_allowsmile = $row['user_allowsmile'];
	}
	else
	{
		$user_sig_bbcode_uid = $userdata['user_sig_bbcode_uid'];
		$user_sig = $userdata['user_sig'];
		$username = ($userdata['user_id'] == ANONYMOUS) ? '' : $userdata['username'];
		$user_allowhtml = $userdata['user_allowhtml'];
		$user_allowbbcode = $userdata['user_allowbbcode'];
		$user_allowsmile = $userdata['user_allowsmile'];
	}
	
	$username = (isset($HTTP_POST_VARS['username'])) ? ajax_htmlspecialchars(trim(stripslashes(utf8_rawurldecode($HTTP_POST_VARS['username'])))) : $username;
	$subject = (isset($HTTP_POST_VARS['subject'])) ? ajax_htmlspecialchars(trim(stripslashes(utf8_rawurldecode($HTTP_POST_VARS['subject'])))) : '';
	$message = (isset($HTTP_POST_VARS['message'])) ? ajax_htmlspecialchars(trim(stripslashes(utf8_rawurldecode($HTTP_POST_VARS['message'])))) : '';

	if (!$board_config['allow_html'])
	{
		$html_on = 0;
	}
	else
	{
		$html_on = (!empty($HTTP_POST_VARS['disable_html'])) ? 0 : True;
	}
	if (!$board_config['allow_bbcode'])
	{
		$bbcode_on = 0;
	}
	else
	{
		$bbcode_on = (!empty($HTTP_POST_VARS['disable_bbcode'])) ? 0 : True;
	}
	if (!$board_config['allow_smilies'])
	{
		$smilies_on = 0;
	}
	else
	{
		$smilies_on = (!empty($HTTP_POST_VARS['disable_smilies'])) ? 0 : True;
	}
	$attach_sig = (!empty($HTTP_POST_VARS['attach_sig'])) ? True : 0;
	
	$bbcode_uid = ($bbcode_on) ? make_bbcode_uid() : '';
	$message = stripslashes(prepare_message(addslashes(unprepare_message($message)), $html_on, $bbcode_on, $smilies_on, $bbcode_uid));

	//
	// Finalise processing as per viewtopic
	//
	if (!$html_on)
	{
		if (($user_sig != '') || !$user_allowhtml)
		{
			$user_sig = preg_replace('#(<)([\/]?.*?)(>)#is', '&lt;\2&gt;', $user_sig);
		}
	}

	if ($attach_sig && ($user_sig != '') && $user_sig_bbcode_uid)
	{
		$user_sig = bbencode_second_pass($user_sig, $user_sig_bbcode_uid);
	}

	if ($bbcode_on)
	{
		$message = bbencode_second_pass($message, $bbcode_uid);
	}

	$orig_word = array();
	$replacement_word = array();
	obtain_word_list($orig_word, $replacement_word);
	if (count($orig_word))
	{
		$username = (!empty($username)) ? preg_replace($orig_word, $replacement_word, $username) : '';
		$subject = (!empty($subject)) ? preg_replace($orig_word, $replacement_word, $subject) : '';
		$message = (!empty($message)) ? preg_replace($orig_word, $replacement_word, $message) : '';
	}
	
	if (empty($username))
	{
		$username = $lang['Guest'];
	}

	if ($user_sig != '')
	{
		$user_sig = make_clickable($user_sig);
	}
	$message = make_clickable($message);

	if ($smilies_on)
	{
		if ($user_allowsmile && ($user_sig != ''))
		{
			$user_sig = smilies_pass($user_sig);
		}

		$message = smilies_pass($message);
	}

	if ($attach_sig && ($user_sig != ''))
	{
		$message = $message .'<br /><br />_________________<br />'. $user_sig;
	}

	$message = str_replace("\n", '<br />', $message);

	$template->set_filenames(array(
		'preview' => 'posting_preview.tpl')
	);

	$template->assign_vars(array(
		'TOPIC_TITLE' => $subject,
		'POST_SUBJECT' => $subject,
		'POSTER_NAME' => $username,
		'POST_DATE' => create_date($board_config['default_dateformat'], time(), $board_config['board_timezone']),
		'MESSAGE' => $message,

		'L_POST_SUBJECT' => $lang['Post_subject'], 
		'L_PREVIEW' => $lang['Preview'],
		'L_POSTED' => $lang['Posted'], 
		'L_POST' => $lang['Post'])
	);
	$template->assign_var_from_handle('__PREVIEW__', 'preview');
	$tpl_code = trim($template->_tpldata['.'][0]['__PREVIEW__']);
	unset($template->_tpldata['.'][0]['__PREVIEW__']);
	
	$result_ar = array(
		'result' => AJAX_PREVIEW,
		'error_msg' => $tpl_code
	);
	AJAX_message_die($result_ar);
}
else if ($mode == 'pm_preview')
{
	include($phpbb_root_path .'includes/bbcode.'. $phpEx);
	
	$user_sig = $userdata['user_sig'];
	
	$to_username = (isset($HTTP_POST_VARS['username']) ) ? trim(ajax_htmlspecialchars(stripslashes(utf8_rawurldecode($HTTP_POST_VARS['username'])))) : '';
	$subject = ( isset($HTTP_POST_VARS['subject']) ) ? trim(ajax_htmlspecialchars(stripslashes(utf8_rawurldecode($HTTP_POST_VARS['subject'])))) : '';
	$message = ( isset($HTTP_POST_VARS['message']) ) ? trim(utf8_rawurldecode($HTTP_POST_VARS['message'])) : '';

	if (!$board_config['allow_html'])
	{
		$html_on = 0;
	}
	else
	{
		$html_on = (!empty($HTTP_POST_VARS['disable_html'])) ? 0 : True;
	}
	if (!$board_config['allow_bbcode'])
	{
		$bbcode_on = 0;
	}
	else
	{
		$bbcode_on = (!empty($HTTP_POST_VARS['disable_bbcode'])) ? 0 : True;
	}
	if (!$board_config['allow_smilies'])
	{
		$smilies_on = 0;
	}
	else
	{
		$smilies_on = (!empty($HTTP_POST_VARS['disable_smilies'])) ? 0 : True;
	}
	$attach_sig = (!empty($HTTP_POST_VARS['attach_sig'])) ? True : 0;
	
	$bbcode_uid = ($bbcode_on) ? make_bbcode_uid() : '';
	$message = stripslashes(prepare_message($message, $html_on, $bbcode_on, $smilies_on, $bbcode_uid));
	
	//
	// Finalise processing as per viewtopic
	//
	if (!$html_on || !$board_config['allow_html'] || !$userdata['user_allowhtml'])
	{
		if ($user_sig != '')
		{
			$user_sig = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", $user_sig);
		}
	}

	if ($attach_sig && ($user_sig != '') && $userdata['user_sig_bbcode_uid'])
	{
		$user_sig = bbencode_second_pass($user_sig, $userdata['user_sig_bbcode_uid']);
	}

	if ($bbcode_on)
	{
		$message = bbencode_second_pass($message, $bbcode_uid);
	}

	if ($attach_sig && ($user_sig != ''))
	{
		$message = $message .'<br /><br />_________________<br />'. $user_sig;
	}
	
	if (count($orig_word))
	{
		$subject = preg_replace($orig_word, $replacement_word, $subject);
		$message = preg_replace($orig_word, $replacement_word, $message);
	}

	if ($smilies_on)
	{
		$message = smilies_pass($message);
	}

	$message = make_clickable($message);
	$message = str_replace("\n", '<br />', $message);
	
	$template->set_filenames(array(
		'preview' => 'privmsgs_preview.tpl')
	);

	$template->assign_vars(array(
		'TOPIC_TITLE' => $subject,
		'POST_SUBJECT' => $subject,
		'MESSAGE_TO' => $to_username, 
		'MESSAGE_FROM' => $userdata['username'], 
		'POST_DATE' => create_date($board_config['default_dateformat'], time(), $board_config['board_timezone']),
		'MESSAGE' => $message,

		'S_HIDDEN_FIELDS' => $s_hidden_fields,

		'L_SUBJECT' => $lang['Subject'],
		'L_DATE' => $lang['Date'],
		'L_FROM' => $lang['From'],
		'L_TO' => $lang['To'],
		'L_PREVIEW' => $lang['Preview'],
		'L_POSTED' => $lang['Posted'])
	);

	$template->assign_var_from_handle('__PREVIEW__', 'preview');
	$tpl_code = trim($template->_tpldata['.'][0]['__PREVIEW__']);
	unset($template->_tpldata['.'][0]['__PREVIEW__']);
	
	$result_ar = array(
		'result' => AJAX_PREVIEW,
		'error_msg' => $tpl_code
	);
	AJAX_message_die($result_ar);
}
else
{
	$result_ar = array(
		'result' => AJAX_ERROR,
		'error_msg' => "Invalid mode: $mode",
	);
	AJAX_message_die($result_ar);
}

?>
<?php
/***************************************************************************
 *                               viewtopic.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: viewtopic.php,v 1.186.2.35 2004/03/13 15:08:23 acydburn Exp $
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
include_once($phpbb_root_path . 'includes/bbcode.'.$phpEx);
include_once($phpbb_root_path . 'includes/functions_color_groups.'.$phpEx);
include($phpbb_root_path . 'includes/def_icons.'. $phpEx);
include_once($phpbb_root_path . 'includes/functions_calendar.'.$phpEx);
include($phpbb_root_path . 'includes/functions_bookmark.'.$phpEx);
include_once($phpbb_root_path . 'includes/functions_profile_fields.'.$phpEx);

//
// Start initial var setup
//
$topic_id = $post_id = 0;
if ( isset($_GET[POST_TOPIC_URL]) )
{
	$topic_id = intval($_GET[POST_TOPIC_URL]);
}
else if ( isset($_GET['topic']) )
{
	$topic_id = intval($_GET['topic']);
}

if ( isset($_GET[POST_POST_URL]))
{
	$post_id = intval($_GET[POST_POST_URL]);
}


$start = ( isset($_GET['start']) ) ? intval($_GET['start']) : 0;
$start = ($start < 0) ? 0 : $start;

if (!$topic_id && !$post_id)
{
	message_die(GENERAL_MESSAGE, 'Topic_post_not_exist');
}

//
// Find topic id if user requested a newer
// or older topic
//
if ( isset($_GET['view']) && empty($_GET[POST_POST_URL]) )
{
	if ( $_GET['view'] == 'newest' )
	{
		if ( isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_sid']) || isset($_GET['sid']) )
		{
			$session_id = isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_sid']) ? $HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_sid'] : $_GET['sid'];
			
			if (!preg_match('/^[A-Za-z0-9]*$/', $session_id)) 
			{
				$session_id = '';
			}
			
			if ( $session_id )
			{
				$sql = "SELECT p.post_id
					FROM " . POSTS_TABLE . " p, " . SESSIONS_TABLE . " s,  " . USERS_TABLE . " u
					WHERE s.session_id = '$session_id'
						AND u.user_id = s.session_user_id
						AND p.topic_id = $topic_id
						AND p.post_time >= u.user_lastvisit
					ORDER BY p.post_time ASC
					LIMIT 1";
				if ( !($result = $db->sql_query($sql)) )
				{
					message_die(GENERAL_ERROR, 'Could not obtain newer/older topic information', '', __LINE__, __FILE__, $sql);
				}

				if ( !($row = $db->sql_fetchrow($result)) )
				{
					message_die(GENERAL_MESSAGE, 'No_new_posts_last_visit');
				}

				$post_id = $row['post_id'];

				if (isset($_GET['sid']))
				{
					redirect("viewtopic.$phpEx?sid=$session_id&" . POST_POST_URL . "=$post_id#$post_id");
				}
				else
				{
					redirect("viewtopic.$phpEx?" . POST_POST_URL . "=$post_id#$post_id");
				}
			}
		}

		redirect(append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id", true));
	}
	else if ( $_GET['view'] == 'next' || $_GET['view'] == 'previous' )
	{
		$sql_condition = ( $_GET['view'] == 'next' ) ? '>' : '<';
		$sql_ordering = ( $_GET['view'] == 'next' ) ? 'ASC' : 'DESC';

		$sql = "SELECT t.topic_id
			FROM " . TOPICS_TABLE . " t, " . TOPICS_TABLE . " t2
			WHERE
				t2.topic_id = $topic_id
				AND t.forum_id = t2.forum_id
				AND t.topic_moved_id = 0
				AND t.topic_last_post_id $sql_condition t2.topic_last_post_id
			ORDER BY t.topic_last_post_id $sql_ordering
			LIMIT 1";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, "Could not obtain newer/older topic information", '', __LINE__, __FILE__, $sql);
		}

		if ( $row = $db->sql_fetchrow($result) )
		{
			$topic_id = intval($row['topic_id']);
			//-- mod : categories hierarchy --------------------------------------------------------------------
			//-- add
			redirect( "./viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id" );
			//-- fin mod : categories hierarchy ----------------------------------------------------------------

		}
		else
		{
			$message = ( $_GET['view'] == 'next' ) ? 'No_newer_topics' : 'No_older_topics';
			message_die(GENERAL_MESSAGE, $message);
		}
	}
}

//
// This rather complex gaggle of code handles querying for topics but
// also allows for direct linking to a post (and the calculation of which
// page the post is on and the correct display of viewtopic)
//
$join_sql_table = (!$post_id) ? '' : ", " . POSTS_TABLE . " p, " . POSTS_TABLE . " p2 ";
$join_sql = (!$post_id) ? "t.topic_id = $topic_id" : "p.post_id = $post_id AND t.topic_id = p.topic_id AND p2.topic_id = p.topic_id AND p2.post_id <= $post_id";
$count_sql = (!$post_id) ? '' : ", COUNT(p2.post_id) AS prev_posts";

$order_sql = ( !$post_id ) ? '' : "GROUP BY p.post_id, t.topic_id, t.topic_title, t.topic_status, t.topic_replies, t.topic_time, t.topic_type, t.topic_vote, t.topic_last_post_id, f.forum_name, f.forum_status, f.forum_id, f.auth_view, f.auth_read, f.auth_post, f.auth_reply, f.auth_edit, f.auth_delete, f.auth_sticky, f.auth_announce, f.auth_pollcreate, f.auth_vote, f.auth_attachments, f.auth_ban, f.auth_greencard, f.auth_bluecard ORDER BY p.post_id ASC";
//-- mod : calendar --------------------------------------------------------------------------------
// here we added
//	, t.topic_first_post_id, t.topic_calendar_time, t.topic_calendar_duration
//-- modify

$sql = "SELECT t.topic_id, t.topic_title, t.topic_status, t.topic_replies, t.topic_time, t.topic_type, t.topic_vote, t.topic_last_post_id, t.topic_first_post_id, t.topic_calendar_time, t.topic_calendar_duration, f.forum_name, f.forum_status, f.forum_id, f.auth_view, f.auth_read, f.auth_post, f.auth_reply, f.auth_edit, f.auth_delete, f.auth_sticky, f.auth_announce, f.auth_pollcreate, f.auth_vote, f.auth_attachments, f.auth_ban, f.auth_greencard, f.auth_bluecard" . $count_sql . "
	FROM " . TOPICS_TABLE . " t, " . FORUMS_TABLE . " f" . $join_sql_table . "
	WHERE $join_sql
		AND f.forum_id = t.forum_id
		$order_sql";
		attach_setup_viewtopic_auth($order_sql, $sql);
if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, "Could not obtain topic information", '', __LINE__, __FILE__, $sql);
}

if ( !($forum_topic_data = $db->sql_fetchrow($result)) )
{
	message_die(GENERAL_MESSAGE, 'Topic_post_not_exist');
}

$forum_id = intval($forum_topic_data['forum_id']);

// Start add - Who viewed a topic MOD
$topic_id = intval($forum_topic_data['topic_id']);
// End add - Who viewed a topic MOD

//
// Start session management
//
$userdata = session_pagestart($user_ip, $forum_id, $topic_id);
init_userprefs($userdata);
//
// End session management
//

//
// Set or remove bookmark
//
if ( isset($_GET['setbm']) || isset($_GET['removebm']) )
{
	$redirect = "viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&start=$start&postdays=$post_days&postorder=$post_order&highlight=" . $_GET['highlight'];
	if ( $userdata['session_logged_in'] )
	{
		if (isset($_GET['setbm']) && $_GET['setbm'])
		{
			set_bookmark($topic_id);
		}
		else if (isset($_GET['removebm']) && $_GET['removebm'])
		{
			remove_bookmark($topic_id);
		}
	}
	else
	{
		if (isset($_GET['setbm']) && $_GET['setbm'])
		{
			$redirect .= '&setbm=true';
		}
		else if (isset($_GET['removebm']) && $_GET['removebm'])
		{
			$redirect .= '&removebm=true';
		}
		redirect(append_sid("login.$phpEx?redirect=$redirect", true));
	}
	redirect(append_sid($redirect, true));
}

//
// Start auth check
//
$is_auth = array();
//-- mod : categories hierarchy --------------------------------------------------------------------
//-- delete
// $is_auth = auth(AUTH_ALL, $forum_id, $userdata, $forum_topic_data);
//
// if( !$is_auth['auth_view'] || !$is_auth['auth_read'] )
//-- add
$is_auth = $tree['auth'][POST_FORUM_URL . $forum_id];

if ( !$is_auth['auth_read'] )
//-- fin mod : categories hierarchy ----------------------------------------------------------------

{
	if ( !$userdata['session_logged_in'] )
	{
		$redirect = ($post_id) ? POST_POST_URL . "=$post_id" : POST_TOPIC_URL . "=$topic_id";
		$redirect .= ($start) ? "&start=$start" : '';
		redirect(append_sid("login.$phpEx?redirect=viewtopic.$phpEx&$redirect", true));
	}

	//-- mod : categories hierarchy --------------------------------------------------------------------
//-- delete
//	$message = ( !$is_auth['auth_view'] ) ? $lang['Topic_post_not_exist'] : sprintf($lang['Sorry_auth_read'], $is_auth['auth_read_type']);
//-- add
	$message = sprintf($lang['Sorry_auth_read'], $is_auth['auth_read_type']);
//-- fin mod : categories hierarchy ----------------------------------------------------------------


	message_die(GENERAL_MESSAGE, $message);
}
//
// End auth check
//
// Start add - Who viewed a topic MOD
$user_id=$userdata['user_id'];
$sql='UPDATE '.TOPIC_VIEW_TABLE.' SET topic_id="'.$topic_id.'", view_time="'.time().'", view_count=view_count+1 WHERE topic_id='.$topic_id.' AND user_id='.$user_id;
if ( !$db->sql_query($sql) || !$db->sql_affectedrows() )
{
	$sql = 'INSERT IGNORE INTO '.TOPIC_VIEW_TABLE.' (topic_id, user_id, view_time,view_count)
		VALUES ('.$topic_id.', "'.$user_id.'", "'.time().'","1")';
	if ( !($db->sql_query($sql)) )
	{
		message_die(CRITICAL_ERROR, 'Error create user view topic information ', '', __LINE__, __FILE__, $sql);
	}
}
// End add - Who viewed a topic MOD

//-- mod : categories hierarchy --------------------------------------------------------------------
//-- delete
// $forum_name = $forum_topic_data['forum_name'];
//-- add
$forum_name = get_object_lang(POST_FORUM_URL . $forum_topic_data['forum_id'], 'name');
//-- fin mod : categories hierarchy ----------------------------------------------------------------

$topic_title = $forum_topic_data['topic_title'];
$topic_id = intval($forum_topic_data['topic_id']);
$topic_time = $forum_topic_data['topic_time'];
//-- mod : calendar --------------------------------------------------------------------------------
//-- add
$topic_first_post_id = intval($forum_topic_data['topic_first_post_id']);
$topic_calendar_time = intval($forum_topic_data['topic_calendar_time']);
$topic_calendar_duration = intval($forum_topic_data['topic_calendar_duration']);
//-- fin mod : calendar ----------------------------------------------------------------------------


if ($post_id)
{
	$start = floor(($forum_topic_data['prev_posts'] - 1) / intval($board_config['posts_per_page'])) * intval($board_config['posts_per_page']);
}

//
// Is user watching this thread?
//
if( $userdata['session_logged_in'] )
{
	$can_watch_topic = TRUE;

	$sql = "SELECT notify_status
		FROM " . TOPICS_WATCH_TABLE . "
		WHERE topic_id = $topic_id
			AND user_id = " . $userdata['user_id'];
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, "Could not obtain topic watch information", '', __LINE__, __FILE__, $sql);
	}

	if ( $row = $db->sql_fetchrow($result) )
	{
		if ( isset($_GET['unwatch']) )
		{
			if ( $_GET['unwatch'] == 'topic' )
			{
				$is_watching_topic = 0;

				$sql_priority = (SQL_LAYER == "mysql") ? "LOW_PRIORITY" : '';
				$sql = "DELETE $sql_priority FROM " . TOPICS_WATCH_TABLE . "
					WHERE topic_id = $topic_id
						AND user_id = " . $userdata['user_id'];
				if ( !($result = $db->sql_query($sql)) )
				{
					message_die(GENERAL_ERROR, "Could not delete topic watch information", '', __LINE__, __FILE__, $sql);
				}
			}

			$template->assign_vars(array(
				'META' => '<meta http-equiv="refresh" content="3;url=' . append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;start=$start") . '">')
			);

			$message = $lang['No_longer_watching'] . '<br /><br />' . sprintf($lang['Click_return_topic'], '<a href="' . append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;start=$start") . '">', '</a>');
			message_die(GENERAL_MESSAGE, $message);
		}
		else
		{
			$is_watching_topic = TRUE;

			if ( $row['notify_status'] )
			{
				$sql_priority = (SQL_LAYER == "mysql") ? "LOW_PRIORITY" : '';
				$sql = "UPDATE $sql_priority " . TOPICS_WATCH_TABLE . "
					SET notify_status = 0
					WHERE topic_id = $topic_id
						AND user_id = " . $userdata['user_id'];
				if ( !($result = $db->sql_query($sql)) )
				{
					message_die(GENERAL_ERROR, "Could not update topic watch information", '', __LINE__, __FILE__, $sql);
				}
			}
		}
	}
	else
	{
		if ( isset($_GET['watch']) )
		{
			if ( $_GET['watch'] == 'topic' )
			{
				$is_watching_topic = TRUE;

				$sql_priority = (SQL_LAYER == "mysql") ? "LOW_PRIORITY" : '';
				$sql = "INSERT $sql_priority INTO " . TOPICS_WATCH_TABLE . " (user_id, topic_id, notify_status)
					VALUES (" . $userdata['user_id'] . ", $topic_id, 0)";
				if ( !($result = $db->sql_query($sql)) )
				{
					message_die(GENERAL_ERROR, "Could not insert topic watch information", '', __LINE__, __FILE__, $sql);
				}
			}

			$template->assign_vars(array(
				'META' => '<meta http-equiv="refresh" content="3;url=' . append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;start=$start") . '">')
			);

			$message = $lang['You_are_watching'] . '<br /><br />' . sprintf($lang['Click_return_topic'], '<a href="' . append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;start=$start") . '">', '</a>');
			message_die(GENERAL_MESSAGE, $message);
		}
		else
		{
			$is_watching_topic = 0;
		}
	}
}
else
{
	if ( isset($_GET['unwatch']) )
	{
		if ( $_GET['unwatch'] == 'topic' )
		{
			redirect(append_sid("login.$phpEx?redirect=viewtopic.$phpEx&" . POST_TOPIC_URL . "=$topic_id&unwatch=topic", true));
		}
	}
	else
	{
		$can_watch_topic = 0;
		$is_watching_topic = 0;
	}
}

//
// Generate a 'Show posts in previous x days' select box. If the postdays var is POSTed
// then get it's value, find the number of topics with dates newer than it (to properly
// handle pagination) and alter the main query
//
$previous_days = array(0, 1, 7, 14, 30, 90, 180, 364);
$previous_days_text = array($lang['All_Posts'], $lang['1_Day'], $lang['7_Days'], $lang['2_Weeks'], $lang['1_Month'], $lang['3_Months'], $lang['6_Months'], $lang['1_Year']);

if( !empty($_POST['postdays']) || !empty($_GET['postdays']) )
{
	$post_days = ( !empty($_POST['postdays']) ) ? intval($_POST['postdays']) : intval($_GET['postdays']);
	$min_post_time = time() - (intval($post_days) * 86400);

	$sql = "SELECT COUNT(p.post_id) AS num_posts
		FROM " . TOPICS_TABLE . " t, " . POSTS_TABLE . " p
		WHERE t.topic_id = $topic_id
			AND p.topic_id = t.topic_id
			AND p.post_time >= $min_post_time";
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, "Could not obtain limited topics count information", '', __LINE__, __FILE__, $sql);
	}

	$total_replies = ( $row = $db->sql_fetchrow($result) ) ? intval($row['num_posts']) : 0;

	$limit_posts_time = "AND p.post_time >= $min_post_time ";

	if ( !empty($_POST['postdays']))
	{
		$start = 0;
	}
}
else
{
	$total_replies = intval($forum_topic_data['topic_replies']) + 1;

	$limit_posts_time = '';
	$post_days = 0;
}

$select_post_days = '<select name="postdays">';
for($i = 0; $i < count($previous_days); $i++)
{
	$selected = ($post_days == $previous_days[$i]) ? ' selected="selected"' : '';
	$select_post_days .= '<option value="' . $previous_days[$i] . '"' . $selected . '>' . $previous_days_text[$i] . '</option>';
}
$select_post_days .= '</select>';

//
// Decide how to order the post display
//
if ( !empty($_POST['postorder']) || !empty($_GET['postorder']) )
{
	$post_order = (!empty($_POST['postorder'])) ? htmlspecialchars($_POST['postorder']) : htmlspecialchars($_GET['postorder']);
	$post_time_order = ($post_order == "asc") ? "ASC" : "DESC";
}
else
{
	$post_order = 'asc';
	$post_time_order = 'ASC';
}

$select_post_order = '<select name="postorder">';
if ( $post_time_order == 'ASC' )
{
	$select_post_order .= '<option value="asc" selected="selected">' . $lang['Oldest_First'] . '</option><option value="desc">' . $lang['Newest_First'] . '</option>';
}
else
{
	$select_post_order .= '<option value="asc">' . $lang['Oldest_First'] . '</option><option value="desc" selected="selected">' . $lang['Newest_First'] . '</option>';
}
$select_post_order .= '</select>';

// Custom Profile Fields MOD
$profile_data = get_fields('WHERE view_in_topic = ' . VIEW_IN_TOPIC . ' AND users_can_view = ' . ALLOW_VIEW);
$profile_data_sql = get_udata_txt($profile_data, 'u.');
// END Custom Profile Fields MOD

//
// Go ahead and pull all data for this topic
//
$sql = "SELECT u.username, u.user_absence, u.user_absence_mode, u.user_id, u.user_posts, u.user_from, u.user_from_flag, u.user_website, u.user_email, u.user_icq, u.user_aim, u.user_yim, u.user_regdate, u.user_msnm, u.user_viewemail, u.user_rank, u.user_sig, u.user_sig_bbcode_uid, u.user_avatar, u.user_avatar_type, u.user_allowavatar, u.user_allowsmile, u.user_warnings, u.user_level, u.user_allow_viewonline, u.user_session_time, u.user_birthday, u.user_next_birthday_greeting, u.user_gender".$profile_data_sql.", p.*,  pt.post_text, pt.post_subject, pt.bbcode_uid
	FROM " . POSTS_TABLE . " p, " . USERS_TABLE . " u, " . POSTS_TEXT_TABLE . " pt
	WHERE p.topic_id = $topic_id
		$limit_posts_time
		AND pt.post_id = p.post_id
		AND u.user_id = p.poster_id
	ORDER BY p.post_time $post_time_order
	LIMIT $start, ".$board_config['posts_per_page'];
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
   include($phpbb_root_path . 'includes/functions_admin.' . $phpEx); 
   sync('topic', $topic_id); 

   message_die(GENERAL_MESSAGE, $lang['No_posts_topic']); 
} 

$resync = FALSE; 
if ($forum_topic_data['topic_replies'] + 1 < $start + count($postrow)) 
{ 
   $resync = TRUE; 
} 
elseif ($start + $board_config['posts_per_page'] > $forum_topic_data['topic_replies']) 
{ 
   $row_id = intval($forum_topic_data['topic_replies']) % intval($board_config['posts_per_page']); 
   if ($postrow[$row_id]['post_id'] != $forum_topic_data['topic_last_post_id'] || $start + count($postrow) < $forum_topic_data['topic_replies']) 
   { 
      $resync = TRUE; 
   } 
} 
elseif (count($postrow) < $board_config['posts_per_page']) 
{ 
   $resync = TRUE; 
} 

if ($resync) 
{ 
   include($phpbb_root_path . 'includes/functions_admin.' . $phpEx); 
   sync('topic', $topic_id); 

   $result = $db->sql_query('SELECT COUNT(post_id) AS total FROM ' . POSTS_TABLE . ' WHERE topic_id = ' . $topic_id); 
   $row = $db->sql_fetchrow($result); 
   $total_replies = $row['total']; 
}

$sql = "SELECT *
	FROM " . RANKS_TABLE . "
	ORDER BY rank_special, rank_min";
if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, "Could not obtain ranks information.", '', __LINE__, __FILE__, $sql);
}

$ranksrow = array();
while ( $row = $db->sql_fetchrow($result) )
{
	$ranksrow[] = $row;
}
$db->sql_freeresult($result);

//
// Define censored word matches
//
$orig_word = array();
$replacement_word = array();
obtain_word_list($orig_word, $replacement_word);

//
// Censor topic title
//
if ( count($orig_word) )
{
	$topic_title = preg_replace($orig_word, $replacement_word, $topic_title);
}

//
// Was a highlight request part of the URI?
//
$highlight_match = $highlight = '';
if (isset($HTTP_GET_VARS['highlight']))
{
	// Split words and phrases
	$words = explode(' ', trim(htmlspecialchars($HTTP_GET_VARS['highlight'])));

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

//
// Post, reply and other URL generation for
// templating vars
//
$new_topic_url = append_sid("posting.$phpEx?mode=newtopic&amp;" . POST_FORUM_URL . "=$forum_id");
$reply_topic_url = append_sid("posting.$phpEx?mode=reply&amp;" . POST_TOPIC_URL . "=$topic_id");
$export_topic_url = append_sid("export.$phpEx?mode=txt&amp;" . POST_TOPIC_URL . "=$topic_id");
$view_forum_url = append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id");
$view_prev_topic_url = append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;view=previous");
$view_next_topic_url = append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;view=next");

//
// Mozilla navigation bar
//
$nav_links['prev'] = array(
	'url' => $view_prev_topic_url,
	'title' => $lang['View_previous_topic']
);
$nav_links['next'] = array(
	'url' => $view_next_topic_url,
	'title' => $lang['View_next_topic']
);
$nav_links['up'] = array(
	'url' => $view_forum_url,
	'title' => $forum_name
);

$reply_img = ( $forum_topic_data['forum_status'] == FORUM_LOCKED || $forum_topic_data['topic_status'] == TOPIC_LOCKED ) ? $images['reply_locked'] : $images['reply_new'];
$reply_alt = ( $forum_topic_data['forum_status'] == FORUM_LOCKED || $forum_topic_data['topic_status'] == TOPIC_LOCKED ) ? $lang['Topic_locked'] : $lang['Reply_to_topic'];
$post_img = ( $forum_topic_data['forum_status'] == FORUM_LOCKED ) ? $images['post_locked'] : $images['post_new'];
$post_alt = ( $forum_topic_data['forum_status'] == FORUM_LOCKED ) ? $lang['Forum_locked'] : $lang['Post_new_topic'];

//
// Set a cookie for this topic
//
if ( $userdata['session_logged_in'] )
{
	$tracking_topics = ( isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_t']) ) ? unserialize($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_t']) : array();
	$tracking_forums = ( isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_f']) ) ? unserialize($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_f']) : array();

	if ( !empty($tracking_topics[$topic_id]) && !empty($tracking_forums[$forum_id]) )
	{
		$topic_last_read = ( $tracking_topics[$topic_id] > $tracking_forums[$forum_id] ) ? $tracking_topics[$topic_id] : $tracking_forums[$forum_id];
	}
	else if ( !empty($tracking_topics[$topic_id]) || !empty($tracking_forums[$forum_id]) )
	{
		$topic_last_read = ( !empty($tracking_topics[$topic_id]) ) ? $tracking_topics[$topic_id] : $tracking_forums[$forum_id];
	}
	else
	{
		$topic_last_read = $userdata['user_lastvisit'];
	}

	if ( count($tracking_topics) >= 150 && empty($tracking_topics[$topic_id]) )
	{
		asort($tracking_topics);
		unset($tracking_topics[key($tracking_topics)]);
	}

	$tracking_topics[$topic_id] = time();

	setcookie($board_config['cookie_name'] . '_t', serialize($tracking_topics), 0, $board_config['cookie_path'], $board_config['cookie_domain'], $board_config['cookie_secure']);
}

//
// Load templates
//
$template->set_filenames(array(
	'body' => 'viewtopic_body.tpl')
);
make_jumpbox('viewforum.'.$phpEx, $forum_id);

//
// Output page header
//
// Start add - Topic in Who is online MOD
if ($board_config['display_viewonline'] == 2) define('SHOW_ONLINE', true);
// End add - Topic in Who is online MOD
$page_title = $lang['View_topic'] .' - ' . $topic_title;
include($phpbb_root_path . 'includes/page_header.'.$phpEx);

//
// User authorisation levels output
//
$s_auth_can = ( ( $is_auth['auth_post'] ) ? $lang['Rules_post_can'] : $lang['Rules_post_cannot'] ) . '<br />';
$s_auth_can .= ( ( $is_auth['auth_reply'] ) ? $lang['Rules_reply_can'] : $lang['Rules_reply_cannot'] ) . '<br />';
$s_auth_can .= ( ( $is_auth['auth_edit'] ) ? $lang['Rules_edit_can'] : $lang['Rules_edit_cannot'] ) . '<br />';
$s_auth_can .= ( ( $is_auth['auth_delete'] ) ? $lang['Rules_delete_can'] : $lang['Rules_delete_cannot'] ) . '<br />';
$s_auth_can .= ( ( $is_auth['auth_vote'] ) ? $lang['Rules_vote_can'] : $lang['Rules_vote_cannot'] ) . '<br />';
$s_auth_can .= ( $is_auth['auth_ban'] ) ? $lang['Rules_ban_can'] . '<br />' : ''; 
$s_auth_can .= ( $is_auth['auth_greencard'] ) ? $lang['Rules_greencard_can'] . '<br />' : ''; 
$s_auth_can .= ( $is_auth['auth_bluecard'] ) ? $lang['Rules_bluecard_can'] . '<br />' : '';
attach_build_auth_levels($is_auth, $s_auth_can);
$topic_mod = '';

if ( $is_auth['auth_mod'] )
{
	$s_auth_can .= sprintf($lang['Rules_moderate'], "<a href=\"modcp.$phpEx?" . POST_FORUM_URL . "=$forum_id&amp;sid=" . $userdata['session_id'] . '">', '</a>');

	$topic_mod .= ( $is_auth['auth_delete'] ) ? "<a href=\"modcp.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;mode=delete&amp;sid=" . $userdata['session_id'] . '"><img src="' . $images['topic_mod_delete'] . '" alt="' . $lang['Delete_topic'] . '" title="' . $lang['Delete_topic'] . '" border="0" /></a>&nbsp;' : "";

	$topic_mod .= "<a href=\"modcp.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;mode=move&amp;sid=" . $userdata['session_id'] . '"><img src="' . $images['topic_mod_move'] . '" alt="' . $lang['Move_topic'] . '" title="' . $lang['Move_topic'] . '" border="0" /></a>&nbsp;';

	$topic_mod .= ( $forum_topic_data['topic_status'] == TOPIC_UNLOCKED ) ? "<a id=\"topic_locklink\" onclick=\"return AJAXLockTopic($topic_id, 1);\" href=\"modcp.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;mode=lock&amp;sid=" . $userdata['session_id'] . '"><img id="topic_lockimg" src="' . $images['topic_mod_lock'] . '" alt="' . $lang['Lock_topic'] . '" title="' . $lang['Lock_topic'] . '" border="0" /></a>&nbsp;' : "<a id=\"topic_locklink\" onclick=\"return AJAXLockTopic($topic_id, 0);\" href=\"modcp.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;mode=unlock&amp;sid=" . $userdata['session_id'] . '"><img id="topic_lockimg" src="' . $images['topic_mod_unlock'] . '" alt="' . $lang['Unlock_topic'] . '" title="' . $lang['Unlock_topic'] . '" border="0" /></a>&nbsp;';

	$topic_mod .= "<a href=\"modcp.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;mode=split&amp;sid=" . $userdata['session_id'] . '"><img src="' . $images['topic_mod_split'] . '" alt="' . $lang['Split_topic'] . '" title="' . $lang['Split_topic'] . '" border="0" /></a>&nbsp;&nbsp;';
	//-- mod : merge -----------------------------------------------------------------------------------
	//-- add
	$topic_mod .= '<a href="' . append_sid("merge.$phpEx?" . POST_TOPIC_URL . '=' . $topic_id) . '"><img src="' . $images['topic_mod_merge'] . '" alt="' . $lang['Merge_topics'] . '" title="' . $lang['Merge_topics'] . '" border="0" /></a>&nbsp;';
	//-- fin mod : merge -------------------------------------------------------------------------------

	// MOD Modcp Extansion BEGIN
    $normal_button = "<a href=\"modcp.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;mode=normalise&amp;sid=" . $userdata['session_id'] . '"><img src="' . $images['topic_mod_normal'] . '" alt="' . $lang['Normal_topic'] . '" title="' . $lang['Normal_topic'] . '" border="0" /></a>&nbsp;';
    $sticky_button = ( $is_auth['auth_sticky'] ) ? "<a href=\"modcp.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;mode=sticky&amp;sid=" . $userdata['session_id'] . '"><img src="' . $images['topic_mod_sticky'] . '" alt="' . $lang['Sticky_topic'] . '" title="' . $lang['Sticky_topic'] . '" border="0" /></a>&nbsp;' : "";
    $announce_button = ( $is_auth['auth_announce'] ) ? "<a href=\"modcp.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;mode=announce&amp;sid=" . $userdata['session_id'] . '"><img src="' . $images['topic_mod_announce'] . '" alt="' . $lang['Announce_topic'] . '" title="' . $lang['Announce_topic'] . '" border="0" /></a>&nbsp;' : "";
    switch( $forum_topic_data['topic_type'] )
    {
        case POST_NORMAL: 
            $topic_mod .= $sticky_button . $announce_button;
            break;
        case POST_STICKY:
            $topic_mod .= $announce_button . $normal_button;
            break;
        case POST_ANNOUNCE:
            $topic_mod .= $sticky_button . $normal_button;
            break;
    }
    // MOD Modcp Extansion END
}

//
// Topic watch information
//
$s_watching_topic = '';
if ( $can_watch_topic )
{
	if ( $is_watching_topic )
	{
		$s_watching_topic = "<a id=\"watchlink\" onclick=\"return AJAXWatchTopic($topic_id, $start, 0);\" href=\"viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;unwatch=topic&amp;start=$start&amp;sid=" . $userdata['session_id'] . '">' . $lang['Stop_watching_topic'] . '</a>';
		$s_watching_topic_img = ( isset($images['topic_un_watch']) ) ? "<a id=\"watchlink_img\" onclick=\"return AJAXWatchTopic($topic_id, $start, 0);\" href=\"viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;unwatch=topic&amp;start=$start&amp;sid=" . $userdata['session_id'] . '"><img id="watchimage" src="' . $images['topic_un_watch'] . '" alt="' . $lang['Stop_watching_topic'] . '" title="' . $lang['Stop_watching_topic'] . '" border="0"></a>' : '';
	}
	else
	{
		$s_watching_topic = "<a id=\"watchlink\" onclick=\"return AJAXWatchTopic($topic_id, $start, 1);\" href=\"viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;watch=topic&amp;start=$start&amp;sid=" . $userdata['session_id'] . '">' . $lang['Start_watching_topic'] . '</a>';
		$s_watching_topic_img = ( isset($images['Topic_watch']) ) ? "<a id=\"watchlink_img\" onclick=\"return AJAXWatchTopic($topic_id, $start, 1);\" href=\"viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;watch=topic&amp;start=$start&amp;sid=" . $userdata['session_id'] . '"><img id="watchimage" src="' . $images['Topic_watch'] . '" alt="' . $lang['Start_watching_topic'] . '" title="' . $lang['Start_watching_topic'] . '" border="0"></a>' : '';
	}
}
//
// Bookmark information
//
if ( $userdata['session_logged_in'] )
{
	$template->assign_block_vars('bookmark_state', array());
	// Send vars to template
	if (is_bookmark_set($topic_id))
	{
		$bm_action = "&amp;removebm=true";
		$bm_action_l = $lang['Remove_Bookmark'];
	}else{
		$bm_action = "&amp;setbm=true";
		$bm_action_l = $lang['Set_Bookmark'];
	}
	$template->assign_vars(array(
		'L_BOOKMARK_ACTION' => $bm_action_l,
		'U_BOOKMARK_ACTION' => append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;start=$start&amp;postdays=$post_days&amp;postorder=$post_order&amp;highlight=" . $_GET['highlight'] . $bm_action))
	);
}
//
// If we've got a hightlight set pass it on to pagination,
// I get annoyed when I lose my highlight after the first page.
//
$pagination = ( $highlight != '' ) ? generate_pagination("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;postdays=$post_days&amp;postorder=$post_order&amp;highlight=$highlight", $total_replies, $board_config['posts_per_page'], $start) : generate_pagination("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;postdays=$post_days&amp;postorder=$post_order", $total_replies, $board_config['posts_per_page'], $start);
$watch_topic_url = "topic_view_users.$phpEx?".POST_TOPIC_URL."=$topic_id";
//
// Send vars to template
//
$template->assign_vars(array(
	'FORUM_ID' => $forum_id,
    'FORUM_NAME' => $forum_name,
    'TOPIC_ID' => $topic_id,
    'TOPIC_TITLE' => $topic_title,
	'PAGINATION' => $pagination,
	'PAGE_NUMBER' => sprintf($lang['Page_of'], ( floor( $start / intval($board_config['posts_per_page']) ) + 1 ), ceil( $total_replies / intval($board_config['posts_per_page']) )),
	'HIGHLIGHT' => $highlight,

	'POST_IMG' => $post_img,
	'REPLY_IMG' => $reply_img,
	'L_PRINT' => ($lang['Print_View']) ? $lang['Print_View'] : 'Printable version', 
    	'U_PRINT' => append_sid("printview.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;start=$start"),
	'L_AUTHOR' => $lang['Author'],
	'L_MESSAGE' => $lang['Message'],
	'L_POSTED' => $lang['Posted'],
	'L_POST_SUBJECT' => $lang['Post_subject'],
	'L_VIEW_NEXT_TOPIC' => $lang['View_next_topic'],
	'L_VIEW_PREVIOUS_TOPIC' => $lang['View_previous_topic'],
	'L_POST_NEW_TOPIC' => $post_alt,
	'L_POST_REPLY_TOPIC' => $reply_alt,
	'L_BACK_TO_TOP' => $lang['Back_to_top'],
	'L_DISPLAY_POSTS' => $lang['Display_posts'],
	'L_LOCK_TOPIC' => $lang['Lock_topic'],
	'L_UNLOCK_TOPIC' => $lang['Unlock_topic'],
	'L_MOVE_TOPIC' => $lang['Move_topic'],
	'L_SPLIT_TOPIC' => $lang['Split_topic'],
	'L_DELETE_TOPIC' => $lang['Delete_topic'],
	'L_GOTO_PAGE' => $lang['Goto_page'],
	'L_FULL_EDIT' => $lang['Full_edit'],
	'L_SAVE_CHANGES' => $lang['Save_changes'],
	'L_CANCEL' => $lang['Cancel'],
	// Bottom of Page Link MOD - Daz - ForumImages.com - START
	'PAGE_BOTTOM_IMG' => '<a href="#bot"><img src="' . $images['icon_down'] . '" alt="' . $lang['Go_to_bottom'] . '" title="' . $lang['Go_to_bottom'] . '" border="0" /></a>',
	'PAGE_BOTTOM' => '<a href="#bot">' . $lang['Go_to_bottom'] . '</a>',
	'PAGE_TOP_IMG' => '<a href="#top"><img src="' . $images['icon_up'] . '" alt="' . $lang['Back_to_top'] . '" title="' . $lang['Back_to_top'] . '" border="0" /></a>',
	'PAGE_TOP' => '<a href="#top">' . $lang['Back_to_top'] . '</a>',
	// Bottom of Page Link MOD - Daz - ForumImages.com - END
	'L_TELL_FRIEND' => $lang['Tell_Friend'],
	'L_TOPIC_VIEW_USERS' => $lang['Topic_view_users'],
	'L_SAVE_TOPIC' => $lang['Save_Topic'],
	'S_TOPIC_LINK' => POST_TOPIC_URL,
	'S_SELECT_POST_DAYS' => $select_post_days,
	'S_SELECT_POST_ORDER' => $select_post_order,
	'S_POST_DAYS_ACTION' => append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . '=' . $topic_id . "&amp;start=$start"),
	'S_AUTH_LIST' => $s_auth_can,
	'S_TOPIC_ADMIN' => $topic_mod,
	'S_WATCH_TOPIC' => $s_watching_topic,
	'S_WATCH_TOPIC_IMG' => $s_watching_topic_img,

	'U_VIEW_TOPIC' => append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;start=$start&amp;postdays=$post_days&amp;postorder=$post_order&amp;highlight=$highlight"),
	'U_VIEW_FORUM' => $view_forum_url,
	'U_VIEW_OLDER_TOPIC' => $view_prev_topic_url,
	'U_VIEW_NEWER_TOPIC' => $view_next_topic_url,
	'U_POST_NEW_TOPIC' => $new_topic_url,
	'U_POST_EXPORT_TOPIC' => $export_topic_url,
	'U_WATCH_TOPIC' => $watch_topic_url,
	'U_POST_REPLY_TOPIC' => $reply_topic_url)
);

//
// Does this topic contain a poll?
//
if ( !empty($forum_topic_data['topic_vote']) )
{
	$s_hidden_fields = '';

	$sql = "SELECT vd.vote_id, vd.vote_text, vd.vote_start, vd.vote_length, vr.vote_option_id, vr.vote_option_text, vr.vote_result
		FROM " . VOTE_DESC_TABLE . " vd, " . VOTE_RESULTS_TABLE . " vr
		WHERE vd.topic_id = $topic_id
			AND vr.vote_id = vd.vote_id
		ORDER BY vr.vote_option_id ASC";
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, "Could not obtain vote data for this topic", '', __LINE__, __FILE__, $sql);
	}

	if ( $vote_info = $db->sql_fetchrowset($result) )
	{
		$db->sql_freeresult($result);
		$vote_options = count($vote_info);

		$vote_id = $vote_info[0]['vote_id'];
		$vote_title = $vote_info[0]['vote_text'];

		$sql = "SELECT vote_id
			FROM " . VOTE_USERS_TABLE . "
			WHERE vote_id = $vote_id
				AND vote_user_id = " . intval($userdata['user_id']);
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, "Could not obtain user vote data for this topic", '', __LINE__, __FILE__, $sql);
		}

		$user_voted = ( $row = $db->sql_fetchrow($result) ) ? TRUE : 0;
		$db->sql_freeresult($result);

		if ( isset($_GET['vote']) || isset($_POST['vote']) )
		{
			$view_result = ( ( ( isset($_GET['vote']) ) ? $_GET['vote'] : $_POST['vote'] ) == 'viewresult' ) ? TRUE : 0;
		}
		else
		{
			$view_result = 0;
		}

		$poll_expired = ( $vote_info[0]['vote_length'] ) ? ( ( $vote_info[0]['vote_start'] + $vote_info[0]['vote_length'] < time() ) ? TRUE : 0 ) : 0;

		if ( $user_voted || $view_result || $poll_expired || !$is_auth['auth_vote'] || $forum_topic_data['topic_status'] == TOPIC_LOCKED )
		{
			$template->set_filenames(array(
				'pollbox' => 'viewtopic_poll_result.tpl')
			);

			$vote_results_sum = 0;

			for($i = 0; $i < $vote_options; $i++)
			{
				$vote_results_sum += $vote_info[$i]['vote_result'];
			}

			$vote_graphic = 0;
			$vote_graphic_max = count($images['voting_graphic']);

			for($i = 0; $i < $vote_options; $i++)
			{
				$vote_percent = ( $vote_results_sum > 0 ) ? $vote_info[$i]['vote_result'] / $vote_results_sum : 0;
				$vote_graphic_length = round($vote_percent * $board_config['vote_graphic_length']);

				$vote_graphic_img = $images['voting_graphic'][$vote_graphic];
				$vote_graphic = ($vote_graphic < $vote_graphic_max - 1) ? $vote_graphic + 1 : 0;

				if ( count($orig_word) )
				{
					$vote_info[$i]['vote_option_text'] = preg_replace($orig_word, $replacement_word, $vote_info[$i]['vote_option_text']);
				}

				$template->assign_block_vars("poll_option", array(
					'POLL_OPTION_CAPTION' => $vote_info[$i]['vote_option_text'],
					'POLL_OPTION_RESULT' => $vote_info[$i]['vote_result'],
					'POLL_OPTION_PERCENT' => sprintf("%.1d%%", ($vote_percent * 100)),

					'POLL_OPTION_IMG' => $vote_graphic_img,
					'POLL_OPTION_IMG_WIDTH' => $vote_graphic_length)
				);
			}

			$template->assign_vars(array(
				'L_TOTAL_VOTES' => $lang['Total_votes'],
				'TOTAL_VOTES' => $vote_results_sum,
				
				'L_VIEW_BALLOT' => $lang['View_ballot'],
				'U_VIEW_BALLOT' => append_sid("viewtopic.$phpEx?". POST_TOPIC_URL ."=$topic_id&amp;postdays=$post_days&amp;postorder=$post_order"))
			);
			
			if (!$user_voted && !$poll_expired && $is_auth['auth_vote'] && ($forum_topic_data['topic_status'] != TOPIC_LOCKED))
			{
				$template->assign_block_vars('switch_view_ballot', array());
			}


		}
		else
		{
			$template->set_filenames(array(
				'pollbox' => 'viewtopic_poll_ballot.tpl')
			);

			for($i = 0; $i < $vote_options; $i++)
			{
				if ( count($orig_word) )
				{
					$vote_info[$i]['vote_option_text'] = preg_replace($orig_word, $replacement_word, $vote_info[$i]['vote_option_text']);
				}

				$template->assign_block_vars("poll_option", array(
					'POLL_OPTION_ID' => $vote_info[$i]['vote_option_id'],
					'POLL_OPTION_CAPTION' => $vote_info[$i]['vote_option_text'])
				);
			}

			$template->assign_vars(array(
				'L_SUBMIT_VOTE' => $lang['Submit_vote'],
				'L_VIEW_RESULTS' => $lang['View_results'],

				'U_VIEW_RESULTS' => append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;postdays=$post_days&amp;postorder=$post_order&amp;vote=viewresult"))
			);

			$s_hidden_fields = '<input type="hidden" name="topic_id" value="' . $topic_id . '" /><input type="hidden" name="mode" value="vote" />';
		}

		if ( count($orig_word) )
		{
			$vote_title = preg_replace($orig_word, $replacement_word, $vote_title);
		}

		$s_hidden_fields .= '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" />';

		$template->assign_vars(array(
			'POLL_QUESTION' => $vote_title,

			'S_HIDDEN_FIELDS' => $s_hidden_fields,
			'S_POLL_ACTION' => append_sid("posting.$phpEx?mode=vote&amp;" . POST_TOPIC_URL . "=$topic_id"))
		);

		$template->assign_var_from_handle('POLL_DISPLAY', 'pollbox');
	}
}
init_display_post_attachments($forum_topic_data['topic_attachment']);
//
// Update the topic view counter
//
$sql = "UPDATE " . TOPICS_TABLE . "
	SET topic_views = topic_views + 1
	WHERE topic_id = $topic_id";
if ( !$db->sql_query($sql) )
{
	message_die(GENERAL_ERROR, "Could not update topic views.", '', __LINE__, __FILE__, $sql);
}
include($phpbb_root_path . 'includes/chinese.'.$phpEx);
//
// Okay, let's do the loop, yeah come on baby let's do the loop
// and it goes like this ...
//
// Start add - Birthday MOD
$this_year = create_date('Y', time(), $board_config['board_timezone']);
$this_date = create_date('md', time(), $board_config['board_timezone']);
// End add - Birthday MOD

for($i = 0; $i < $total_posts; $i++)
{
	$poster_id = $postrow[$i]['user_id'];
	$poster = ( $poster_id == ANONYMOUS ) ? $lang['Guest'] : color_group_colorize_name($postrow[$i]['user_id']);
	
	// Start add - Birthday MOD
	if ( $postrow[$i]['user_birthday'] != 999999 ) 
	{
		$poster_birthdate=realdate('md', $postrow[$i]['user_birthday']);
		$n=0;
		while ($n<26)
		{
			if ($poster_birthdate>=$zodiacdates[$n] && $poster_birthdate<=$zodiacdates[$n+1])
			{
				$zodiac = $lang[$zodiacs[($n/2)]];
				$u_zodiac = $images[$zodiacs[($n/2)]];
				$zodiac_img = '<img src="' . $u_zodiac . '" alt="' . $zodiac . '" title="' . $zodiac . '" align="top" border="0" />';
				$n=26;
			} else
			{
				$n=$n+2;
			}
		}
		$poster_age = $this_year - realdate ('Y',$postrow[$i]['user_birthday']);
		if ($this_date < $poster_birthdate) $poster_age--;
		$poster_age = $lang['Age'] . ': ' . $poster_age;
		$chinese = get_chinese_year (realdate('Ymd', $postrow[$i]['user_birthday']));
		$u_chinese = $images[$chinese];
		$chinese_img = ($chinese=='Unknown') ? '' : '<img src="' . $u_chinese . '" alt="' . $lang[$chinese] . '" title="' . $lang[$chinese] . '" align="top" border="0" />';
	} else
	{
		$zodiac = '';
		$u_zodiac = '';
		$zodiac_img = '';
		$poster_age = '';
		$chinese = '';
	$u_chinese = '';
	$chinese_img = '';
	}
	// End add - Birthday MOD

	//-- mod : today at  yesterday at ------------------------------------------------------------------------ 
	//-- add 
   $post_date = create_date_day($board_config['default_dateformat'], $postrow[$i]['post_time'], $board_config['board_timezone']); 
	//-- end mod : today at  yesterday at ------------------------------------------------------------------------ 


	$poster_posts = ( $postrow[$i]['user_id'] != ANONYMOUS ) ? $lang['Posts'] . ': ' . $postrow[$i]['user_posts'] : '';

	$poster_from = ( $postrow[$i]['user_from'] && $postrow[$i]['user_id'] != ANONYMOUS ) ? $lang['Location'] . ': ' . $postrow[$i]['user_from'] : '';
	// FLAGHACK-start
	$poster_from_flag = ( $postrow[$i]['user_from_flag'] && $postrow[$i]['user_id'] != ANONYMOUS ) ? "<img src=\"images/flags/" . $postrow[$i]['user_from_flag'] . "\" alt=\"" . $postrow[$i]['user_from_flag'] . "\" border=\"0\" width=\"32\" height=\"20\" /><br />" : "";
	// FLAGHACK-end
	$poster_joined = ( $postrow[$i]['user_id'] != ANONYMOUS ) ? $lang['Joined'] . ': ' . create_date($lang['DATE_FORMAT'], $postrow[$i]['user_regdate'], $board_config['board_timezone']) : '';

	$poster_avatar = '';

	if ( $postrow[$i]['user_avatar_type'] && $poster_id != ANONYMOUS && $postrow[$i]['user_allowavatar'] )
	{
		switch( $postrow[$i]['user_avatar_type'] )
		{
			case USER_AVATAR_UPLOAD:
				$size = check_avatar_size($board_config['avatar_path'] . '/' . $postrow[$i]['user_avatar'], $board_config['avatar_max_width']);
				$poster_avatar = ( $board_config['allow_avatar_upload'] ) ? '<img src="' . $board_config['avatar_path'] . '/' . $postrow[$i]['user_avatar'] . '" '.$size.' alt="" border="0" />' : '';
				break;
			case USER_AVATAR_REMOTE:
				$size = check_avatar_size($postrow[$i]['user_avatar'], $board_config['avatar_max_width'], true);
				$poster_avatar = ( $board_config['allow_avatar_remote'] ) ? '<img src="' . $postrow[$i]['user_avatar'] . '" '.$size.' alt="" border="0" />' : '';
				break;
			case USER_AVATAR_GALLERY:
				$size = check_avatar_size($board_config['avatar_gallery_path'] . '/' . $postrow[$i]['user_avatar'], $board_config['avatar_max_width']);
				$poster_avatar = ( $board_config['allow_avatar_local'] ) ? '<img src="' . $board_config['avatar_gallery_path'] . '/' . $postrow[$i]['user_avatar'] . '" '.$size.' alt="" border="0" />' : '';
				break;
		}
	}
	else { 
		if ( $plus_config['default_avatar'] == 1)
		{
                        if ( $postrow[$i]['user_avatar'] == '' ) { 
                                $poster_avatar = ( $board_config['allow_avatar_local'] ) ? '<img src="images/default_avatar.gif" alt="" border="0" />' : ''; 
                        } 
          }}
	//
	// Define the little post icon
	//
	if ( $userdata['session_logged_in'] && $postrow[$i]['post_time'] > $userdata['user_lastvisit'] && $postrow[$i]['post_time'] > $topic_last_read )
	{
		$mini_post_img = $images['icon_minipost_new'];
		$mini_post_alt = $lang['New_post'];
	}
	else
	{
		$mini_post_img = $images['icon_minipost'];
		$mini_post_alt = $lang['Post'];
	}

	$mini_post_url = append_sid("viewtopic.$phpEx?" . POST_POST_URL . '=' . $postrow[$i]['post_id']) . '#' . $postrow[$i]['post_id'];

	//
	// Generate ranks, set them to empty string initially.
	//
	$poster_rank = '';
	$rank_image = '';
	// Start add - Gender MOD
	$gender_image = ''; 
	// End add - Gender MOD
	if ( $postrow[$i]['user_id'] == ANONYMOUS )
	{
	}
	else if ( $postrow[$i]['user_rank'] )
	{
		for($j = 0; $j < count($ranksrow); $j++)
		{
			if ( $postrow[$i]['user_rank'] == $ranksrow[$j]['rank_id'] && $ranksrow[$j]['rank_special'] )
			{
				$poster_rank = $ranksrow[$j]['rank_title'];
				$rank_image = ( $ranksrow[$j]['rank_image'] ) ? '<img src="' . $images['rank_path'] . $ranksrow[$j]['rank_image'] . '" alt="' . $poster_rank . '" title="' . $poster_rank . '" border="0" /><br />' : '';
			}
		}
	}
	else
	{
		for($j = 0; $j < count($ranksrow); $j++)
		{
			if ( $postrow[$i]['user_posts'] >= $ranksrow[$j]['rank_min'] && !$ranksrow[$j]['rank_special'] )
			{
				$poster_rank = $ranksrow[$j]['rank_title'];
				$rank_image = ( $ranksrow[$j]['rank_image'] ) ? '<img src="' . $images['rank_path'] . $ranksrow[$j]['rank_image'] . '" alt="' . $poster_rank . '" title="' . $poster_rank . '" border="0" /><br />' : '';
			}
		}
	}

	//
	// Handle anon users posting with usernames
	//
	if ( $poster_id == ANONYMOUS && $postrow[$i]['post_username'] != '' )
	{
		$poster = $postrow[$i]['post_username'];
		$poster_rank = $lang['Guest'];
		// Start add - Birthday MOD
		$poster_age = '';
		// End add - Birthday MOD

	}

	$temp_url = '';

	if ( $poster_id != ANONYMOUS )
	{
		$temp_url = append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=$poster_id");
		$profile_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_profile'] . '" alt="' . $lang['Read_profile'] . '" title="' . $lang['Read_profile'] . '" border="0" /></a>';
		$profile = '<a href="' . $temp_url . '">' . $lang['Read_profile'] . '</a>';

		$temp_url = append_sid("privmsg.$phpEx?mode=post&amp;" . POST_USERS_URL . "=$poster_id");
		$pm_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_pm'] . '" alt="' . $lang['Send_private_message'] . '" title="' . $lang['Send_private_message'] . '" border="0" /></a>';
		// Start add - Gender MOD
		switch ($postrow[$i]['user_gender']) 
		{ 
			case 1 : $gender_image = "<img src=\"" . $images['icon_minigender_male'] . "\" alt=\"" . $lang['Gender'].  ":".$lang['Male']."\" title=\"" . $lang['Gender'] . ":".$lang['Male']. "\" border=\"0\" />"; break; 
			case 2 : $gender_image = "<img src=\"" . $images['icon_minigender_female'] . "\" alt=\"" . $lang['Gender']. ":".$lang['Female']. "\" title=\"" . $lang['Gender'] . ":".$lang['Female']. "\" border=\"0\" />"; break; 
			default : $gender_image=""; 
		}
		// End add - Gender MOD
		$pm = '<a href="' . $temp_url . '">' . $lang['Send_private_message'] . '</a>';
		// Photo Album Link MOD - Daz - ForumImages.com - START
		$temp_url = append_sid("album.$phpEx?user_id=$poster_id");
		$gallery_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_gallery'] . '" alt="' . sprintf($lang['Personal_Gallery_Of_User'], $postrow[$i]['username']) . '" title="' . sprintf($lang['Personal_Gallery_Of_User'], $postrow[$i]['username']) . '" border="0" /></a>';
		$gallery = '<a href="' . $temp_url . '">' . $lang['Album'] . '</a>';
		// Photo Album Link MOD - Daz - ForumImages.com - END 
		if ( !empty($postrow[$i]['user_viewemail']) || $is_auth['auth_mod'] )
		{
			$email_uri = ( $board_config['board_email_form'] ) ? append_sid("profile.$phpEx?mode=email&amp;" . POST_USERS_URL .'=' . $poster_id) : 'mailto:' . $postrow[$i]['user_email'];

			$email_img = '<a href="' . $email_uri . '"><img src="' . $images['icon_email'] . '" alt="' . $lang['Send_email'] . '" title="' . $lang['Send_email'] . '" border="0" /></a>';
			$email = '<a href="' . $email_uri . '">' . $lang['Send_email'] . '</a>';
		}
		else
		{
			$email_img = '';
			$email = '';
		}

		$www_img = ( $postrow[$i]['user_website'] ) ? '<a href="' . $postrow[$i]['user_website'] . '" target="_userwww"><img src="' . $images['icon_www'] . '" alt="' . $lang['Visit_website'] . '" title="' . $lang['Visit_website'] . '" border="0" /></a>' : '';
		$www = ( $postrow[$i]['user_website'] ) ? '<a href="' . $postrow[$i]['user_website'] . '" target="_userwww">' . $lang['Visit_website'] . '</a>' : '';

		if ( !empty($postrow[$i]['user_icq']) )
		{
			$icq_status_img = '<a href="http://wwp.icq.com/' . $postrow[$i]['user_icq'] . '#pager"><img src="http://web.icq.com/whitepages/online?icq=' . $postrow[$i]['user_icq'] . '&img=5" width="18" height="18" border="0" /></a>';
			$icq_img = '<a href="http://wwp.icq.com/scripts/search.dll?to=' . $postrow[$i]['user_icq'] . '"><img src="' . $images['icon_icq'] . '" alt="' . $lang['ICQ'] . '" title="' . $lang['ICQ'] . '" border="0" /></a>';
			$icq =  '<a href="http://wwp.icq.com/scripts/search.dll?to=' . $postrow[$i]['user_icq'] . '">' . $lang['ICQ'] . '</a>';
		}
		else
		{
			$icq_status_img = '';
			$icq_img = '';
			$icq = '';
		}

		$aim_img = ( $postrow[$i]['user_aim'] ) ? '<a href="aim:goim?screenname=' . $postrow[$i]['user_aim'] . '&amp;message=Hello+Are+you+there?"><img src="' . $images['icon_aim'] . '" alt="' . $lang['AIM'] . '" title="' . $lang['AIM'] . '" border="0" /></a>' : '';
		$aim = ( $postrow[$i]['user_aim'] ) ? '<a href="aim:goim?screenname=' . $postrow[$i]['user_aim'] . '&amp;message=Hello+Are+you+there?">' . $lang['AIM'] . '</a>' : '';

		$temp_url = append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=$poster_id");
		$msn_img = ( $postrow[$i]['user_msnm'] ) ? '<a href="http://members.msn.com/' . $postrow[$i]['user_msnm'] . '" target="_blank"><img src="' . $images['icon_msnm'] . '" alt="' . $lang['MSNM'] . '" title="' . $lang['MSNM'] . '" border="0" /></a>' : '';
		$msn = ( $postrow[$i]['user_msnm'] ) ? '<a href="' . $temp_url . '">' . $lang['MSNM'] . '</a>' : '';

		$yim_img = ( $postrow[$i]['user_yim'] ) ? '<a href="http://edit.yahoo.com/config/send_webmesg?.target=' . $postrow[$i]['user_yim'] . '&amp;.src=pg"><img src="' . $images['icon_yim'] . '" alt="' . $lang['YIM'] . '" title="' . $lang['YIM'] . '" border="0" /></a>' : '';
		$yim = ( $postrow[$i]['user_yim'] ) ? '<a href="http://edit.yahoo.com/config/send_webmesg?.target=' . $postrow[$i]['user_yim'] . '&amp;.src=pg">' . $lang['YIM'] . '</a>' : '';
	}
	else
	{
		$profile_img = '';
		$profile = '';
		$pm_img = '';
		$pm = '';
		// Photo Album Link MOD - Daz - ForumImages.com - START
		$gallery_img = '';
		$gallery = '';
		// Photo Album Link MOD - Daz - ForumImages.com - END 
		$email_img = '';
		$email = '';
		$www_img = '';
		$www = '';
		$icq_status_img = '';
		$icq_img = '';
		$icq = '';
		$aim_img = '';
		$aim = '';
		$msn_img = '';
		$msn = '';
		$yim_img = '';
		$yim = '';
	}

	$temp_url = append_sid("posting.$phpEx?mode=quote&amp;" . POST_POST_URL . "=" . $postrow[$i]['post_id']);
	$quote_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_quote'] . '" alt="' . $lang['Reply_with_quote'] . '" title="' . $lang['Reply_with_quote'] . '" border="0" /></a>';
	$quote = '<a href="' . $temp_url . '">' . $lang['Reply_with_quote'] . '</a>';

	$temp_url = append_sid("search.$phpEx?search_author=" . urlencode($postrow[$i]['username']) . "&amp;showresults=posts");
	$search_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_search'] . '" alt="' . sprintf($lang['Search_user_posts'], $postrow[$i]['username']) . '" title="' . sprintf($lang['Search_user_posts'], $postrow[$i]['username']) . '" border="0" /></a>';
	$search = '<a href="' . $temp_url . '">' . sprintf($lang['Search_user_posts'], $postrow[$i]['username']) . '</a>';

	if ( ( $userdata['user_id'] == $poster_id && $is_auth['auth_edit'] && ($forum_topic_data['topic_status'] != TOPIC_LOCKED)) || $is_auth['auth_mod'] )
	{
		$edit_url = append_sid("posting.$phpEx?mode=editpost&amp;" . POST_POST_URL . "=" . $postrow[$i]['post_id']);
		$edit_img = '<a id="editimg_'. $postrow[$i]['post_id'] .'" '.(($board_config['use_ajax_edit'])?'onclick="return AJAXPostEdit('. $postrow[$i]['post_id'] .');" ':'').'href="'. $edit_url .'"><img src="' . $images['icon_edit'] . '" alt="' . $lang['Edit_delete_post'] . '" title="' . $lang['Edit_delete_post'] . '" border="0" /></a>';
		$edit = '<a id="editlink_'. $postrow[$i]['post_id'] .'" href="' . $edit_url . '">' . $lang['Edit_delete_post'] . '</a>';
	}
	else
	{
		$edit_img = '';
		$edit = '';
		$edit_url = '';
	}
	

	if ( $is_auth['auth_mod'] )
	{
		$temp_url = "modcp.$phpEx?mode=ip&amp;" . POST_POST_URL . "=" . $postrow[$i]['post_id'] . "&amp;" . POST_TOPIC_URL . "=" . $topic_id . "&amp;sid=" . $userdata['session_id'];
		$ip_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_ip'] . '" alt="' . $lang['View_IP'] . '" title="' . $lang['View_IP'] . '" border="0" /></a>';
		$ip = '<a href="' . $temp_url . '">' . $lang['View_IP'] . '</a>';

		$temp_url = "posting.$phpEx?mode=delete&amp;" . POST_POST_URL . "=" . $postrow[$i]['post_id'] . "&amp;sid=" . $userdata['session_id'];
		$delpost_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_delpost'] . '" alt="' . $lang['Delete_post'] . '" title="' . $lang['Delete_post'] . '" border="0" /></a>';
		$delpost = '<a href="' . $temp_url . '">' . $lang['Delete_post'] . '</a>';
	}
	else
	{
		$ip_img = '';
		$ip = '';

		if ( $userdata['user_id'] == $poster_id && $is_auth['auth_delete'] && $forum_topic_data['topic_last_post_id'] == $postrow[$i]['post_id'] )
		{
			$temp_url = "posting.$phpEx?mode=delete&amp;" . POST_POST_URL . "=" . $postrow[$i]['post_id'] . "&amp;sid=" . $userdata['session_id'];
			$delpost_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_delpost'] . '" alt="' . $lang['Delete_post'] . '" title="' . $lang['Delete_post'] . '" border="0" /></a>';
			$delpost = '<a href="' . $temp_url . '">' . $lang['Delete_post'] . '</a>';
		}
		else
		{
			$delpost_img = '';
			$delpost = '';
		}
	}
	if($poster_id != ANONYMOUS && $postrow[$i]['user_level'] != ADMIN) 
	{ 
		$current_user = str_replace("'","\'",$postrow[$i]['username']);
		if ($is_auth['auth_greencard']) 
		{ 
			  $g_card_img = ' <input type="image" name="unban" value="unban" onClick="return confirm(\''.sprintf($lang['Green_card_warning'],$current_user).'\')" src="'. $images['icon_g_card'] . '" alt="' . $lang['Give_G_card'] . '" >'; 
		} 
		else 
		{
			$g_card_img = ''; 
		}
		$user_warnings = $postrow[$i]['user_warnings'];
		//$card_img = ($user_warnings) ? (( $user_warnings < $board_config['max_user_bancard']) ? sprintf($lang['Warnings'], $user_warnings) : $lang['Banned'] ) : '';
		// these lines will make a icon apear beside users post, if user have warnings or ar banned
		// used instead of the previous line of code, witch shows the status as a text
		//  ------ From here --- do not include this line
		$card_img = ($user_warnings) ? '<br />' . '<img src="'.(( $user_warnings < $board_config['max_user_bancard']) ? 
		$images['icon_y_card'] . '" alt="'. sprintf($lang['Warnings'], $user_warnings) .'">' : 
		$images['icon_r_card'] . '" alt="'. $lang['Banned'] .'">') : '';
		//  ----- To this line --- Do not included this line
		// 
		// You may also included several images, instead of only one yellow, these lines below will produce several yellow images, depending on mumber of yellow cards
		//  ------ From here --- do not include this line
		//$card_img = ($user_warnings >= $board_config['max_user_bancard'])  ? '<img src="'.$images['icon_r_card'] . '" alt="'. $lang['Banned'] .'">' : '';
		//for ($n=0 ; $n<$user_warnings && $user_warnings < $board_config['max_user_bancard'];$n++)
		//{
		//$card_img .= ($user_warnings) ? '<img src="'.(( $user_warnings < $board_config['max_user_bancard']) ? 
		//$images['icon_y_card'] . '" alt="'. sprintf($lang['Warnings'], $user_warnings) .'">' : 
		//$images['icon_r_card'] . '" alt="'. $lang['Banned'] .'">') : '';
		//}
		//  ----- To this line --- Do not included this line
	
		if ($user_warnings<$board_config['max_user_bancard'] && $is_auth['auth_ban'] )
		{ 
			$y_card_img = ' <input type="image" name="warn" value="warn" onClick="return confirm(\''.sprintf($lang['Yellow_card_warning'],$current_user).'\')" src="'. $images['icon_y_card'] . '" alt="' . sprintf($lang['Give_Y_card'],$user_warnings+1) . '" title="' . sprintf($lang['Give_Y_card'],$user_warnings+1) . '" >'; 
				$r_card_img = ' <input type="image" name="ban" value="ban"  onClick="return confirm(\''.sprintf($lang['Red_card_warning'],$current_user).'\')" src="'. $images['icon_r_card'] . '" alt="' . $lang['Give_R_card'] . '" title="' . $lang['Give_R_card'] . '" >'; 
		}
		else
		{
			$y_card_img = '';
			$r_card_img = ''; 
		} 
	} else
	{
		$card_img = '';
		$g_card_img = '';
		$y_card_img = '';
		$r_card_img = '';
	}

	if ($is_auth['auth_bluecard']) 
	{ 
		if ($is_auth['auth_mod']) 
		{ 
			$b_card_img = (($postrow[$i]['post_bluecard'])) ? ' <input type="image" name="report_reset" value="report_reset" onClick="return confirm(\''.$lang['Clear_blue_card_warning'].'\')" src="'. $images['icon_bhot_card'] . '" alt="'. sprintf($lang['Clear_b_card'],$postrow[$i]['post_bluecard']) . '" title="'. sprintf($lang['Clear_b_card'],$postrow[$i]['post_bluecard']) . '">':' <input type="image" name="report" value="report" onClick="return confirm(\''.$lang['Blue_card_warning'].'\')" src="'. $images['icon_b_card'] . '" alt="'. $lang['Give_b_card'] . '" title="'. $lang['Give_b_card'] . '" >'; 
		} 
   		else 
		{ 
			$b_card_img = ' <input type="image" name="report" value="report" onClick="return confirm(\''.$lang['Blue_card_warning'].'\')" src="'. $images['icon_b_card'] . '" alt="'. $lang['Give_b_card'] . '" title="'. $lang['Give_b_card'] . '" >';
			
   		}
	} else $b_card_img = '';

	// parse hidden filds if cards visible
	$card_hidden = ($g_card_img || $r_card_img || $y_card_img || $b_card_img) ? '<input type="hidden" name="post_id" value="'. $postrow[$i]['post_id'].'">' :'';

	$post_subject = ( $postrow[$i]['post_subject'] != '' ) ? $postrow[$i]['post_subject'] : (($postrow[$i]['post_id'] == $topic_first_post_id) ? $forum_topic_data['topic_title'] : '');

	$message = $postrow[$i]['post_text'];
	$bbcode_uid = $postrow[$i]['bbcode_uid'];

	$user_sig = ( $postrow[$i]['enable_sig'] && $postrow[$i]['user_sig'] != '' && $board_config['allow_sig'] ) ? $postrow[$i]['user_sig'] : '';
	$user_sig_bbcode_uid = $postrow[$i]['user_sig_bbcode_uid'];

	//
	// Note! The order used for parsing the message _is_ important, moving things around could break any
	// output
	//

	//
	// If the board has HTML off but the post has HTML
	// on then we process it, else leave it alone
	//
	if ( !$board_config['allow_html'] || !$userdata['user_allowhtml'])
	{
		if ( $user_sig != '' ) 
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
	if ($user_sig != '' && $user_sig_bbcode_uid != '')
	{
		$user_sig = ($board_config['allow_bbcode']) ? bbencode_second_pass($user_sig, $user_sig_bbcode_uid) : preg_replace("/\:$user_sig_bbcode_uid/si", '', $user_sig);
	}

	if ($bbcode_uid != '')
	{
		$message = ($board_config['allow_bbcode']) ? bbencode_second_pass($message, $bbcode_uid) : preg_replace("/\:$bbcode_uid/si", '', $message);
	}

	if ( $user_sig != '' )
	{
		$user_sig = make_clickable($user_sig);
	}
	$message = make_clickable($message);
	// BEGIN CMX News Mod
	// Strip out the <!--break--> delimiter.
	$delim = htmlspecialchars( '<!--break-->' );
	$pos = strpos( $message, $delim );
	if( ($pos !== false) && ($pos < strlen( $message )) ) {
		$message = substr_replace( $message, html_entity_decode($delim), $pos, strlen($delim) );
	}
	// END CMX News Mod
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

	//
	// Highlight active words (primarily for search)
	//
	if ($highlight_match)
	{
		// This has been back-ported from 3.0 CVS
		$message = preg_replace('#(?!<.*)(?<!\w)(' . $highlight_match . ')(?!\w|[^<>]*>)#i', '<b style="color:#'.$theme['fontcolor3'].'">\1</b>', $message);
	}

	//
	// Replace naughty words
	//
	if (count($orig_word))
	{
		$post_subject = preg_replace($orig_word, $replacement_word, $post_subject);

		if ($user_sig != '')
		{
			$user_sig = str_replace('\"', '"', substr(@preg_replace('#(\>(((?>([^><]+|(?R)))*)\<))#se', "@preg_replace(\$orig_word, \$replacement_word, '\\0')", '>' . $user_sig . '<'), 1, -1));
		}

		$message = str_replace('\"', '"', substr(@preg_replace('#(\>(((?>([^><]+|(?R)))*)\<))#se', "@preg_replace(\$orig_word, \$replacement_word, '\\0')", '>' . $message . '<'), 1, -1));
	}

	//
	// Replace newlines (we use this rather than nl2br because
	// till recently it wasn't XHTML compliant)
	//
	if ( $user_sig != '' )
	{
		$user_sig = '_________________<br />' . str_replace("\n", "\n<br />\n", $user_sig);
	}
	$message = acronym_pass( $message );
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
	//-- mod : post icon -------------------------------------------------------------------------------
	//-- add
	$post_subject_pre = '';
	$post_subject_pre = get_icon_title($postrow[$i]['post_icon']) . '&nbsp;';
	//-- fin mod : post icon ---------------------------------------------------------------------------
	//-- mod : calendar --------------------------------------------------------------------------------
	//-- add
	$post_subject_back = '';
	if (!empty($topic_calendar_time) && ($postrow[$i]['post_id'] == $topic_first_post_id))
	{
		$post_subject_back = get_calendar_title($topic_calendar_time, $topic_calendar_duration);
	}
	//-- fin mod : calendar ----------------------------------------------------------------------------
	if ( $postrow[$i]['user_absence'] == TRUE )
	{
		$absence_mode = create_absence_mode($postrow[$i]['user_absence_mode'], $pm_img, $pm, $email_img, $email, $poster);
	}
	//
	// Again this will be handled by the templating
	// code at some point
	//
	$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
	$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

	$is_firstpost = ($postrow[$i]['post_id'] == $forum_topic_data['topic_first_post_id']) ? 1 : 0;
	if ($can_edit = ($is_auth['auth_mod'] || (($postrow[$i]['user_id'] == $userdata['user_id'] && ($forum_topic_data['topic_status'] != TOPIC_LOCKED)) && $is_auth['auth_edit'])))
	{
		$raw_message = $postrow[$i]['post_text'];
		if (!empty($bbcode_uid))
		{
			$raw_message = preg_replace('#\:(([a-z0-9]:)?)'. $bbcode_uid .'#s', '', $raw_message);
		}
	
		$raw_message = str_replace('<', '&lt;', $raw_message);
		$raw_message = str_replace('>', '&gt;', $raw_message);
		$raw_message = str_replace('<br />', "\n", $raw_message);
	}

	//Online/Offline
	if ($poster_id == ANONYMOUS)
	{
		$on_off_hidden = '';
	}
	else if (($postrow[$i]['user_session_time'] >= ( time() - 300 )) && ($postrow[$i]['user_allow_viewonline']))
	{
		$on_off_hidden = '<img src="' . $images['icon_online'] . '" alt="' . $lang['Online'] . '" title="' . $lang['Online'] . '" border="0" />';
	}
	else if (($postrow[$i]['user_allow_viewonline']) == 0)
	{
		$on_off_hidden = '<img src="' . $images['icon_hidden'] . '" alt="' . $lang['Hidden'] . '" title="' . $lang['Hidden'] . '" border="0" />';
	}
	else
	{
		$on_off_hidden = '<img src="' . $images['icon_offline'] . '" alt="' . $lang['Offline'] . '" title="' . $lang['Offline'] . '" border="0" />';
	}
	$template->assign_block_vars('postrow', array(
		'ROW_COLOR' => '#' . $row_color,
		'ROW_CLASS' => $row_class,
		'POSTER_NAME' => $poster, 
		'ZODIAC_IMG' => $zodiac_img,
		'ZODIAC' => $zodiac,
		'U_ZODIAC' => $u_zodiac,
		'L_ZODIAC' => ($zodiac) ? $lang['Zodiac'] . ': ' : '',
		// Start add - Birthday MOD
		'POSTER_AGE' => $poster_age,
		'CHINESE' => $lang[$chinese],
		'CHINESE_IMG' => $chinese_img,
		'U_CHINESE' => $u_chinese,
		'L_CHINESE' => ($chinese) ? $lang['Chinese_zodiac'] . ': ' : '',
		// End add - Birthday MOD
		'POSTER_RANK' => $poster_rank,
		// Start add - Gender MOD
		'POSTER_GENDER' => $gender_image,
		// End add - Gender MOD
		'RANK_IMAGE' => $rank_image,
		'POSTER_JOINED' => $poster_joined,
		'POSTER_POSTS' => $poster_posts,
		'POSTER_FROM' => $poster_from,
		// FLAGHACK-start
		'POSTER_FROM_FLAG' => $poster_from_flag,
		// FLAGHACK-end
		'POSTER_AVATAR' => $poster_avatar,
		'POSTER_ONLINE' => $on_off_hidden,
		'POST_DATE' => $post_date,
		'POST_SUBJECT_PRE' => $post_subject_pre,
		'POST_SUBJECT_BACK' => $post_subject_back,
		'POST_SUBJECT' => (empty($post_subject)) ? $lang['No_subject'] : $post_subject,
		'POST_RAW_SUBJECT' => $post_subject,
		'MESSAGE' => $message,
		'SIGNATURE' => $user_sig,
		'EDITED_MESSAGE' => $l_edited_by,

		'MINI_POST_IMG' => $mini_post_img,
		'PROFILE_IMG' => $profile_img,
		'PROFILE' => $profile,
		'SEARCH_IMG' => $search_img,
		'SEARCH' => $search,
		'PM_IMG' => $pm_img,
		'PM' => $pm,
		// Photo Album Link MOD - Daz - ForumImages.com - START
		'GALLERY_IMG' => $gallery_img,
		'GALLERY' => $gallery,
		// Photo Album Link MOD - Daz - ForumImages.com - END 
		'EMAIL_IMG' => $email_img,
		'EMAIL' => $email,
		'WWW_IMG' => $www_img,
		'WWW' => $www,
		'ICQ_STATUS_IMG' => $icq_status_img,
		'ICQ_IMG' => $icq_img,
		'ICQ' => $icq,
		'AIM_IMG' => $aim_img,
		'AIM' => $aim,
		'MSN_IMG' => $msn_img,
		'MSN' => $msn,
		'YIM_IMG' => $yim_img,
		'YIM' => $yim,
		'EDIT_IMG' => $edit_img,
		'EDIT' => $edit,
		'QUOTE_IMG' => $quote_img,
		'QUOTE' => $quote,
		'IP_IMG' => $ip_img,
		'IP' => $ip,
		'DELETE_IMG' => $delpost_img,
		'DELETE' => $delpost,
		'RAW_MESSAGE' => ($can_edit) ? $raw_message : '',
		'USER_WARNINGS' => $user_warnings,
		'CARD_IMG' => $card_img,
		'CARD_HIDDEN_FIELDS' => $card_hidden,
		'CARD_EXTRA_SPACE' => ($r_card_img || $y_card_img || $g_card_img || $b_card_img) ? ' ' : '',
		// Start add - Gender MOD
		'L_GENDER' => $lang['Gender'],
		// End add - Gender MOD
		'L_MINI_POST_ALT' => $mini_post_alt,

		'S_FIRST_POST' => $is_firstpost,
		'S_AJAX_EDIT_TITLE' => ($can_edit) ? 'ondblclick="AJAXTitleEdit('. $postrow[$i]['post_id'] .', '. $is_firstpost .');"' : '',
		
		'U_EDIT_POST' => $edit_url,
		'U_MINI_POST' => $mini_post_url,
		'U_G_CARD' => $g_card_img, 
		'U_Y_CARD' => $y_card_img, 
		'U_R_CARD' => $r_card_img, 
		'U_B_CARD' => $b_card_img,
		'S_CARD' => append_sid("card.".$phpEx),
		'U_POST_ID' => $postrow[$i]['post_id'])
	);

	display_post_attachments($postrow[$i]['post_id'], $postrow[$i]['post_attachment']);

	if ($can_edit)
	{
		$template->assign_block_vars('postrow.can_edit', array());
	}

	//
	// Custom Profile Fields MOD
	//
	if ( $poster_id != ANONYMOUS && $profile_data_sql != '' )
	{
		$cp_data = array();
		$cp_data = get_topic_udata($postrow[$i], $profile_data);		
		
		if ( $cp_data['aboves'] )
			foreach($cp_data['aboves'] as $above_val)
				$template->assign_block_vars('postrow.above_sig',array('ABOVE_VAL' => $above_val));

		if ( $cp_data['belows'] )
			foreach($cp_data['belows'] as $below_val)
				$template->assign_block_vars('postrow.below_sig',array('BELOW_VAL' => $below_val));

		if ( $cp_data['author'] )
			foreach($cp_data['author'] as $author_val)
				$template->assign_block_vars('postrow.author_profile',array('AUTHOR_VAL' => $author_val));
	}
	//
	// END Custom Profile Fields MOD
	//

}

if ($plus_config['show_quickreply'] == 1 && ($userdata['user_id']!= -1) && $forum_topic_data['topic_status'] == TOPIC_UNLOCKED)
{
	include($phpbb_root_path . 'quick_reply.'.$phpEx);
	$template->assign_block_vars('switch_show_quickreply', array());
}


$template->assign_vars(array( 
	'TELL_LINK' => append_sid("http://".$HTTP_SERVER_VARS['HTTP_HOST'].$HTTP_SERVER_VARS['PHP_SELF']."?t=$topic_id", true))
);

$template->pparse('body');

include($phpbb_root_path . 'includes/page_tail.'.$phpEx);

?>
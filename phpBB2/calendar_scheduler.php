<?php
/***************************************************************************
 *                            calendar_scheduler.php
 *                            ----------------------
 *	begin				: 27/08/2003
 *	copyright			: Ptirhiik
 *	email				: admin@rpgnet-fr.com
 *
 *	version				: 1.0.3 - 14/09/2003
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

define('IN_PHPBB', true);
$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.' . $phpEx);
@include($phpbb_root_path . 'profilcp/functions_profile.' . $phpEx);
include($phpbb_root_path . 'includes/functions_calendar.' . $phpEx);
include($phpbb_root_path . 'includes/functions_topics_list.' . $phpEx);

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_INDEX);
init_userprefs($userdata);
//
// End session management
//

// some constants
$set_of_months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
$set_of_days = array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');

//
//  get parameters
//
// date
$date = 0;
if ( isset($_POST['date']) || isset($_GET['d']) )
{
	$date = isset($_POST['date']) ? intval($_POST['date']) : intval($_GET['d']);
}
if ($date == 0)
{
	$date = time();
}

// date per jumpbox
$start_month = intval($_POST['start_month']);
$start_year = intval($_POST['start_year']);
if ( !empty($start_month) && !empty($start_year) )
{
	$day = 01;
	if (!empty($date))
	{
		$day = date('d', $date);
	}
	$date = mktime(0,0,0, $start_month, $day, $start_year);
}

// mode
$mode = '';
if ( isset($_POST['mode']) || isset($_GET['mode']) )
{
	$mode = isset($_POST['mode']) ? $_POST['mode'] : $_GET['mode'];
}
if ( !in_array($mode, array('hour')) )
{
	$mode = '';
}
// start
$start = 0;
if ( isset($_POST['start']) || isset($_GET['start']) )
{
	$start = isset($_POST['start']) ? intval($_POST['start']) : intval($_GET['start']);
}

// get the period
$year	= date('Y', $date);
$month	= date('m', $date);
$day	= date('d', $date);
$hour	= date('H', $date);
$min	= date('i', $date);
if ($mode == 'hour')
{
	$start_date	= mktime($hour, 0, 0, $month, $day, $year);
	$end_date	= mktime($hour+1, 0, 0, $month, $day, $year);
}
else
{
	$start_date	= mktime(0, 0, 0, $month, $day, $year);
	$end_date	= mktime(0 ,0 ,0, $month, $day+1, $year);
}

// get the forum id selected
$fid = '';
if ( isset($_POST['selected_id']) || isset($_GET['fid']) )
{
	$fid = isset($_POST['selected_id']) ? intval($_POST['selected_id']) : intval($_GET['fid']);
	if ($fid != 'Root')
	{
		$type = substr($fid, 0, 1);
		$id = intval(substr($fid, 1));
		if ( ($id == 0) || !in_array($type, array(POST_FORUM_URL, POST_CAT_URL)) )
		{
			$type = POST_CAT_URL;
			$id = 0;
		}
		$fid = $type . $id;
		if ($fid == POST_CAT_URL . '0')
		{
			$fid = 'Root';
		}
	}
}

//
// get the month events
//
$month_start = mktime(0,0,0, $month, 01, $year);
$month_end	 = mktime(0,0,0, $month+1, 01, $year);
$number = 0;
$events	= array();
get_event_PCP_birthday($events, $number, $month_start, $month_end);
get_event_topics($events, $number, $month_start, $month_end, false, 0, -1, $fid);

// get the days with events
$days = array();
for ($i=0; $i < count($events); $i++)
{
	// set the event on the month viewed
	$calendar_start = $events[$i]['event_calendar_time'];
	$calendar_end =  $events[$i]['event_calendar_time'] + $events[$i]['event_calendar_duration'];
	if ($calendar_start < $month_start) $calendar_start = $month_start;
	if ($calendar_end >= $month_end) $calendar_end = $month_end-1;
	$wstart = intval(date('d', $calendar_start));
	$wend = intval(date('d', $calendar_end));
	for ($j = $wstart; $j <= $wend; $j++)
	{
		$days[$j] = true;
	}
}

//
// get the day events
//
$events = array();

// birthday
$birthdays_count = 0;
$remaining = $board_config['topics_per_page'];
get_event_PCP_birthday($events, $birthdays_count, $start_date, $end_date, true, $start, $remaining);
$displayed = count($events)-1;
if ($displayed < 0) $displayed = 0;

// topics
$topics_count = 0;
$remaining = $board_config['topics_per_page'] - $displayed;
$local_start = $start-$displayed;
get_event_topics($events, $topics_count, $start_date, $end_date, true, $local_start, $remaining, $fid);
//
// set the page title and include the page header
//
$page_title = $lang['Calendar_scheduler'];
include ($phpbb_root_path . 'includes/page_header.' . $phpEx);

//
// template name
//
$template->set_filenames(array(
	'body' => 'calendar_scheduler_body.tpl')
);
make_jumpbox('viewforum.' . $phpEx);

// Header
$template->assign_vars(array(
	'L_CALENDAR_SCHEDULER'	=> $lang['Calendar_scheduler'],
	'U_CALENDAR_SCHEDULER'	=> append_sid("./calendar_scheduler.$phpEx?d=$date&mode=$mode&start=$start"),
	)
);

// set a bar of hours
$work_date = mktime( 0, 0, 0, $month, $day, $year );
for ($i=0; $i <= 24; $i++)
{
	if ($i == 0)
	{
		$l_hour = $lang['All_events'];
		if ($mode != 'hour')
		{
			$color = 'quote';
		}
		else
		{
			$color = 'row2';
		}
	}
	else
	{
		$l_hour = date('H', $work_date);
		if ( ($mode == 'hour') && ($hour == $i-1) )
		{
			$color = 'quote';
		}
		else
		{
			$color = 'row3';
		}
		$work_date = $work_date + 3600;
	}
	$template->assign_block_vars('hour', array(
		'CLASS'		=> $color,
		'HOUR'		=> $l_hour,
		'U_HOUR'	=> append_sid("./calendar_scheduler.$phpEx?" . (($i==0) ? '' : 'mode=hour&') . "d=" . mktime( (($i==0) ? 0 : $i-1), 0, 0, $month, $day, $year ) ),
		)
	);
}

// send the month box
$first_day_of_week = isset($board_config['calendar_week_start']) ? intval($board_config['calendar_week_start']) : 1;

// buid select list for month
$s_month = '';
for ($i=0; $i < count($set_of_months); $i++)
{
	$selected = ($month == $i+1) ? ' selected="selected"' : '';
	$s_month .= '<option value="' . ($i+1) . '"' . $selected . '>' . $lang['datetime'][ $set_of_months[$i] ] . '</option>';
}
$s_month = sprintf('<select name="start_month" onchange="forms[\'_calendar_scheduler\'].submit();">%s</select>', $s_month);;

// buid select list for year
$year = intval(date('Y', $start_date));
$s_year = '<select name="start_year" onchange="forms[\'_calendar_scheduler\'].submit();">';
for ($i=1971; $i < 2070; $i++)
{
	$selected = ($year == $i) ? ' selected="selected"' : '';
	$s_year .= '<option value="' . $i . '"' . $selected . '>' . $i . '</option>';
}
$s_year .= '</select>';

// build a forum select list
$cat_hierarchy = function_exists(get_auth_keys);
if (!$cat_hierarchy)
{
	$s_forum_list = '<select name="selected_id" onchange="forms[\'_calendar_scheduler\'].submit();">' . calendar_get_tree_option($fid) . '</select>';
}
else
{
	$s_forum_list = '<select name="selected_id" onchange="forms[\'_calendar_scheduler\'].submit();">' . get_tree_option($fid) . '</select>';
}

// send header
$k = $first_day_of_week;
for ($i=0; $i <= 6; $i++)
{
	$template->assign_block_vars('header_cell', array(
		'L_DAY' => $lang['datetime'][ $set_of_days[$k] ],
		)
	);
	$k++;
	if ($k > 6) $k = 0;
}

$prec = mktime(0,0,0, $month-1, $day, $year);
$next = mktime(0,0,0, $month+1, $day, $year);
$template->assign_vars(array(
	'S_MONTH'			=> $s_month,
	'S_YEAR'			=> $s_year,
	'U_PREC'			=> append_sid("./calendar_scheduler.$phpEx?d=$prec&fid=$fid"),
	'U_NEXT'			=> append_sid("./calendar_scheduler.$phpEx?d=$next&fid=$fid"),
	'U_CALENDAR'		=> append_sid("./calendar.$phpEx?start=" . $year . $month . "01&fid=$fid"),
	'L_CALENDAR'		=> $lang['Calendar'],
	'IMG_CALENDAR'		=> $images['icon_calendar'],
	)
);

// get first day of the month
$offset		= date('w', mktime(0,0,0, $month, 01, $year)) - $first_day_of_week;
if ($offset < 0) $offset = $offset + 7;
$offset		= mktime(0,0,0, $month, 01-$offset, $year);
$nb_days	= intval((mktime(0,0,0, $month+1, 01, $year) - $offset) / 86400);
$nb_rows	= intval($nb_days / 7);

$start_m	= mktime(0,0,0, $month, 01, $year);
$end_m		= mktime(0,0,0, $month+1, 01, $year);
$today		= mktime(0,0,0, $month, $day, $year);
if (($nb_days % 7) > 0)
{
	$nb_rows++;
}

$color = false;
for ($j=0; $j < $nb_rows; $j++)
{
	$template->assign_block_vars('row', array());
	$color = !$color;
	for ($i=0; $i <= 6; $i++)
	{
		$cur = intval(date('d', $offset));
		$class = ($color) ? 'row1' : 'row2';
		if (($offset < $start_m) || ($offset >= $end_m))
		{
			$cur = '&nbsp;';
			$class = 'row3';
		}
		if ($offset == $today)
		{
			$class = 'quote';
		}
		if ($days[$cur])
		{
			$url = append_sid("./calendar_scheduler.$phpEx?d=$offset&fid=$fid");
			$cur = sprintf('<a href="%s" class="gen"><b>%s</b></a>', $url, $cur);
		}
		$template->assign_block_vars('row.cell', array(
			'CLASS' => $class,
			'DAY' => $cur,
			)
		);
		$offset = $offset + 86400;
	}
}

// list of topics
$period = ($mode == 'hour') ? 3600-1 : '';
$title = get_calendar_title_date($start_date, $period);

// move events to topic_rowset format
$topic_rowset = array();
for ($i = 0; $i < count($events); $i++)
{
	$row['topic_id']				= $events[$i]['event_id'];
	$row['topic_title']				= $events[$i]['event_title'];
	$row['topic_replies']			= $events[$i]['event_replies'];
	$row['topic_type']				= $events[$i]['event_type'];
	$row['topic_vote']				= $events[$i]['event_vote'];
	$row['topic_status']			= $events[$i]['event_status'];
	$row['topic_moved_id']			= $events[$i]['event_moved_id'];
	$row['post_time']				= $events[$i]['event_last_time'];
	$row['user_id']					= $events[$i]['event_author_id'];
	$row['username']				= $events[$i]['event_author'];
	$row['post_username']			= $events[$i]['event_author'];
	$row['topic_time']				= $events[$i]['event_time'];
	$row['id2']						= $events[$i]['event_last_author_id'];
	$row['post_username2']			= $events[$i]['event_last_author'];
	$row['user2']					= $events[$i]['event_last_author'];
	$row['topic_last_post_id']		= $events[$i]['event_last_id'];
	$row['topic_views']				= $events[$i]['event_views'];
	$row['forum_id']				= $events[$i]['event_forum_id'];
	$row['forum_name']				= $events[$i]['event_forum_name'];
	$row['topic_calendar_time']		= $events[$i]['event_calendar_time'];
	$row['topic_calendar_duration']	= $events[$i]['event_calendar_duration'];
	$row['topic_icon']				= $events[$i]['event_icon'];

	$topic_rowset[] = $row;
}

$split_type = false;
$display_nav_tree = (intval($board_config['calendar_forum']) == 1);
$footer = $s_forum_list . '&nbsp;<input type="submit" value="' . $lang['Go'] . '" class="liteoption" />';
topic_list('TOPIC_LIST_SCHEDULER', 'topics_list_box', $topic_rowset, $title, $split_type, $display_nav_tree, $footer );

// system
$s_hidden_fields = '<input type="hidden" name="mode" value="' . $mode . '" />';
$s_hidden_fields .= '<input type="hidden" name="date" value="' . $date . '" />';
$s_hidden_fields .= '<input type="hidden" name="start" value="' . $start . '" />';
if (!isset($nav_separator))
{
	$nav_separator = '&nbsp;->&nbsp;';
}

$total = $topics_count + $birthdays_count;
if ($total == 0) $total++;
$template->assign_vars(array(
	'PAGINATION' => generate_pagination("calendar_scheduler.$phpEx?d=$date&mode=$mode", $total, $board_config['topics_per_page'], $start),
	'PAGE_NUMBER' => sprintf($lang['Page_of'], ( floor( $start / $board_config['topics_per_page'] ) + 1 ), ceil( $topics_count / $board_config['topics_per_page'] )),
	'L_GOTO_PAGE' => $lang['Goto_page'],

	'NAV_SEPARATOR'		=> $nav_separator,
	'S_ACTION'			=> append_sid("./calendar_scheduler.$phpEx"),
	'S_HIDDEN_FIELDS'	=> $s_hidden_fields,
	)
);

// send to browser
$template->pparse('body');
include($phpbb_root_path . 'includes/page_tail.'.$phpEx);

?>
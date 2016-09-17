<?php
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
//
// Top Posting Users This Week (History Mod adaption)
//
$statistics->init_bars();

$month = array();
$current_time = time();
$year = create_date('Y', $current_time, $board_config['board_timezone']);
$month [0] = mktime (0,0,0,1,1, $year);
$month [1] = $month [0] + 2678400;
$month [2] = mktime (0,0,0,3,1, $year);
$month [3] = $month [2] + 2678400;
$month [4] = $month [3] + 2592000;
$month [5] = $month [4] + 2678400;
$month [6] = $month [5] + 2592000;
$month [7] = $month [6] + 2678400;
$month [8] = $month [7] + 2678400;
$month [9] = $month [8] + 2592000;
$month [10] = $month [9] + 2678400;
$month [11] = $month [10] + 2592000;
$month [12] = $month [11] + 2592000;
$arr_num = (date('n')-1);
$time_thismonth = $month[$arr_num];

$l_this_month = create_date('F', $time_thismonth, $board_config['board_timezone']);

$template->assign_vars(array(
	'L_MODULE_NAME' => $lang['module_name'],
	'MONTH' => sprintf($lang['Month'], ($l_this_month . ' ' . create_date('Y', $time_thismonth, $board_config['board_timezone'])) ),
	'L_RANK' => $lang['Rank'],
	'L_PERCENTAGE' => $lang['Percent'],
	'L_GRAPH' => $lang['Graph'],
	'L_USERNAME' => $lang['Username'],
	'L_POSTS' => $lang['Posts'])
);

$sql = "select u.user_id, u.username, count(u.user_id) as user_posts  
FROM " . USERS_TABLE . " u, " . POSTS_TABLE . " p 
WHERE (u.user_id = p.poster_id) AND (p.post_time > '" . $time_thismonth . "') AND (u.user_id <> " . ANONYMOUS . ")
GROUP BY user_id, username
ORDER BY user_posts DESC
LIMIT " . $return_limit;

if ( !($result = $stat_db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, "Couldn't retrieve topposters data", "", __LINE__, __FILE__, $sql);
}

$total_posts_thismonth = 0;
$user_count = $stat_db->sql_numrows($result);
$user_data = $stat_db->sql_fetchrowset($result);
$firstcount = $user_data[0]['user_posts'];

for ($i = 0; $i < $user_count; $i++)
{
	$total_posts_thismonth += $user_data[$i]['user_posts'];
}

for ($i = 0; $i < $user_count; $i++)
{
	$class = ($i % 2) ? $theme['td_class2'] : $theme['td_class1'];
	
	$statistics->do_math($firstcount, $user_data[$i]['user_posts'], $total_posts_thismonth);

	$template->assign_block_vars('top_posters', array(
		'RANK' => $i+1,
		'CLASS' => $class,
		'USERNAME' => $user_data[$i]['username'],
		'PERCENTAGE' => $statistics->percentage,
		'BAR' => $statistics->bar_percent,
		'URL' => append_sid($phpbb_root_path . 'profile.php?mode=viewprofile&u=' . $user_data[$i]['user_id']),
		'POSTS' => $user_data[$i]['user_posts'])
	);
}

?>
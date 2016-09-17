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

$current_time = time();
$minutes = date('is', $current_time);
$hour_now = $current_time - (60*($minutes[0].$minutes[1])) - ($minutes[2].$minutes[3]); 
$date = date('H');
$time_today = $hour_now - (3600 * $date); 
$time_thisweek = $time_today - ((date('w', $time_today)-1)*86400);

$l_this_day = create_date('D', $time_today, $board_config['board_timezone']);

$sql = "select u.user_id, u.username, count(u.user_id) as user_posts  
FROM " . USERS_TABLE . " u, " . POSTS_TABLE . " p 
WHERE (u.user_id = p.poster_id) AND (p.post_time > '" . $time_thisweek . "') AND (u.user_id <> " . ANONYMOUS . ")
GROUP BY user_id, username
ORDER BY user_posts DESC
LIMIT " . $return_limit;

if ( !($result = $stat_db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, "Couldn't retrieve topposters data", "", __LINE__, __FILE__, $sql);
}

$total_posts_thisweek = 0;
$user_count = $stat_db->sql_numrows($result);
$user_data = $stat_db->sql_fetchrowset($result);
$firstcount = $user_data[0]['user_posts'];

for ($i = 0; $i < $user_count; $i++)
{
	$total_posts_thisweek += $user_data[$i]['user_posts'];
}

for ($i = 0; $i < $user_count; $i++)
{
	$class = ($i % 2) ? $theme['td_class2'] : $theme['td_class1'];
	
	$statistics->do_math($firstcount, $user_data[$i]['user_posts'], $total_posts_thisweek);

	$template->assign_block_vars('top_posters_week', array(
		'RANK' => $i+1,
		'CLASS' => $class,
		'USERNAME' => $user_data[$i]['username'],
		'PERCENTAGE' => $statistics->percentage,
		'BAR' => $statistics->bar_percent,
		'URL' => append_sid($phpbb_root_path . 'profile.php?mode=viewprofile&u=' . $user_data[$i]['user_id']),
		'POSTS' => $user_data[$i]['user_posts'])
	);
}

$template->assign_vars(array(
	'L_MODULE_NAME' => $lang['module_name'],
	'WEEK' => sprintf($lang['Week'], (create_date('D', $time_thisweek, $board_config['board_timezone'])). ' - ' . $l_this_day),
	'L_RANK' => $lang['Rank'],
	'L_PERCENTAGE' => $lang['Percent'],
	'L_GRAPH' => $lang['Graph'],
	'L_USERNAME' => $lang['Username'],
	'L_POSTS' => $lang['Posts'])
);

?>
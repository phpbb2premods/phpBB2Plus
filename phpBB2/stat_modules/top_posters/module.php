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
// DB Cache used here

//
// Top Posting Users
//
$template->assign_vars(array(
	'L_RANK' => $lang['Rank'],
	'L_POSTS' => $lang['Posts'],
	'L_PERCENTAGE' => $lang['Percent'],
	'L_USERNAME' => $lang['Username'],
	'L_GRAPH' => $lang['Graph'],
	'MODULE_NAME' => $lang['module_name'])
);

// 
// Method 1 to define Vote Bars: Define the Images
//
/*
$bars = array(
	'left' => 'images/vote_lcap.gif',
	'right' => 'images/vote_rcap.gif',
	'bar' => 'images/voting_bar.gif'
);

$statistics->init_bars($bars);
*/

//
// Method 2 to define Vote Bars: Let the Statistics Mod define default Bars
//
$statistics->init_bars();

$sql = "SELECT SUM(user_posts) as total_posts FROM " . USERS_TABLE . "
WHERE user_id <> " . ANONYMOUS;

if ( !($result = $stat_db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Couldn\'t retrieve users data', '', __LINE__, __FILE__, $sql);
}

$row = $stat_db->sql_fetchrow($result);
//$total_posts = get_db_stat('postcount');
$total_posts = $row['total_posts'];

$sql = 'SELECT user_id, username, user_posts 
FROM ' . USERS_TABLE . ' 
WHERE (user_id <> ' . ANONYMOUS . ' ) AND (user_posts > 0) 
ORDER BY user_posts DESC 
LIMIT ' . $return_limit;

if ( !($result = $stat_db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Couldn\'t retrieve users data', '', __LINE__, __FILE__, $sql);
}

$user_count = $stat_db->sql_numrows($result);
$user_data = $stat_db->sql_fetchrowset($result);

$firstcount = $user_data[0]['user_posts'];

for ($i = 0; $i < $user_count; $i++)
{
	$class = ($i % 2) ? $theme['td_class2'] : $theme['td_class1'];

	$statistics->do_math($firstcount, $user_data[$i]['user_posts'], $total_posts);

	$template->assign_block_vars('users', array(
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
<?php
/***************************************************************************
 *								module.php
 *                            -------------------
 *   begin                : Tuesday, Sep 03, 2002
 *   copyright            : (C) 2002 Meik Sievertsen
 *   email                : acyd.burn@gmx.de
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
if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
} 
//
// Modules should be considered to already have access to the following variables which
// the parser will give out to it:

// $return_limit - Control Panel defined number of items to display
// $module_info['name'] - The module name specified in the info.txt file
// $module_info['email'] - The author email
// $module_info['author'] - The author name
// $module_info['version'] - The version
// $module_info['url'] - The author url
//
// To make the module more compatible, please do not use any functions here
// and put all your code inline to keep from redeclaring functions on accident.
//

//
// All your code
//
// Top Smilies
//

//
// Start user modifiable variables
//

//
// Set smile_pref to 0, if you want that smilies are only counted once per post.
// This means that, if the same smilie is entered ten times in a message, only one is counted in that message.
//
$smile_pref = 1;

$vote_left = 'images/vote_lcap.gif';
$vote_right = 'images/vote_rcap.gif';
$vote_bar = 'images/voting_bar.gif';

//
// End user modifiable variables
//

$percentage = 0;
$bar_percent = 0;

//
// Functions
//

//
// Do the math ;)
//
function smilies_do_math($firstval, $value, $total)
{
	global $percentage, $bar_percent;

	$cst = ($firstval > 0) ? 90 / $firstval : 90;

	if ( $value != 0  )
	{
		$percentage = ( $total ) ? round( min(100, ($value / $total) * 100)) : 0;
	}
	else
	{
		$percentage = 0;
	}

	$bar_percent = round($value * $cst);
}

//
// sort multi-dimensional array - from File Attachment Mod
//
function smilies_sort_multi_array_attachment ($sort_array, $key, $sort_order) 
{
	$last_element = count($sort_array) - 1;

	$string_sort = ( is_string($sort_array[$last_element-1][$key]) ) ? TRUE : FALSE;

	for ($i = 0; $i < $last_element; $i++) 
	{
		$num_iterations = $last_element - $i;

		for ($j = 0; $j < $num_iterations; $j++) 
		{
			$next = 0;

			//
			// do checks based on key
			//
			$switch = FALSE;
			if ( !($string_sort) )
			{
				if ( ( ($sort_order == 'DESC') && (intval($sort_array[$j][$key]) < intval($sort_array[$j + 1][$key])) ) || ( ($sort_order == 'ASC') &&    (intval($sort_array[$j][$key]) > intval($sort_array[$j + 1][$key])) ) )
				{
					$switch = TRUE;
				}
			}
			else
			{
				if ( ( ($sort_order == 'DESC') && (strcasecmp($sort_array[$j][$key], $sort_array[$j + 1][$key]) < 0) ) || ( ($sort_order ==   'ASC') && (strcasecmp($sort_array[$j][$key], $sort_array[$j + 1][$key]) > 0) ) )
				{
					$switch = TRUE;
				}
			}

			if ($switch)
			{
				$temp = $sort_array[$j];
				$sort_array[$j] = $sort_array[$j + 1];
				$sort_array[$j + 1] = $temp;
			}
		}
	}

	return ($sort_array);
}

//
// END Functions
//

$template->assign_vars(array(
	'L_TOP_SMILIES' => $lang['Top_Smilies'],

	'L_USES' => $lang['Uses'],
	'L_RANK' => $lang['Rank'],
	'L_PERCENTAGE' => $lang['Percent'],
	'L_GRAPH' => $lang['Graph'],
	'L_IMAGE' => $lang['smiley_url'],
	'L_CODE' => $lang['smiley_code'],
	'PAGE_NAME' => $lang['Statistics'])
);


//
// Getting voting bar info
//
if( !$board_config['override_user_style'] )
{
	if( ($userdata['user_id'] != ANONYMOUS) && (isset($userdata['user_style'])) )
	{
		$style = $userdata['user_style'];
		if( !$theme )
		{
			$style =  $board_config['default_style'];
		}
	}
	else
	{
		$style =  $board_config['default_style'];
	}
}
else
{
	$style =  $board_config['default_style'];
}

$sql = 'SELECT * 
FROM ' . THEMES_TABLE . ' 
WHERE themes_id = ' . $style;

if ( !($result = $db->sql_query($sql)) )
{
	message_die(CRITICAL_ERROR, 'Couldn\'t query database for theme info.');
}

if( !$row = $db->sql_fetchrow($result) )
{
	message_die(CRITICAL_ERROR, 'Couldn\'t get theme data for themes_id=' . $style . '.');
}

$current_template_path = 'templates/' . $row['template_name'] . '/';

$template->assign_vars(array(
	'LEFT_GRAPH_IMAGE' => $current_template_path . $vote_left,
	'RIGHT_GRAPH_IMAGE' => $current_template_path . $vote_right,
	'GRAPH_IMAGE' => $current_template_path . $vote_bar)
);

//
// Most used smilies
//
$sql = 'SELECT smile_url
FROM ' . SMILIES_TABLE . '
GROUP BY smile_url';

if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Couldn\'t retrieve smilies data', '', __LINE__, __FILE__, $sql);
}

$all_smilies = array();
$total_smilies = 0;

if ($db->sql_numrows($result) > 0)
{
	$smilies = $db->sql_fetchrowset($result);

	for ($i = 0; $i < count($smilies); $i++)
	{
		$sql = "SELECT *
		FROM " . SMILIES_TABLE . "
		WHERE smile_url = '" . $smilies[$i]['smile_url'] . "'";

		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Couldn\'t retrieve smilies data', '', __LINE__, __FILE__, $sql);
		}

		$smile_codes = $db->sql_fetchrowset($result);

		$count = 0;

		for ($j = 0; $j < count($smile_codes); $j++)
		{
			$smile_codes[$j]['code'] = str_replace("'", "\'", $smile_codes[$j]['code']);
			$sql = "SELECT post_id, post_text
			FROM " . POSTS_TEXT_TABLE . "
			WHERE post_text LIKE '%" . $smile_codes[$j]['code'] . "%'";

			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Couldn\'t retrieve smilies data', '', __LINE__, __FILE__, $sql);
			}

			if ($smile_pref == 0)
			{
				$count = $count + $db->sql_numrows($result);
			}
			else
			{
				while ($post = $db->sql_fetchrow($result))
				{
					$count = $count + substr_count($post['post_text'], $smile_codes[$j]['code']);
				}
			}
		}

		$all_smilies[$i]['count'] = $count;
		$all_smilies[$i]['code'] = $smile_codes[0]['code'];
	    $all_smilies[$i]['smile_url'] = $smile_codes[0]['smile_url'];
	    $total_smilies = $total_smilies + $count;
	}
}

// Sort array
$all_smilies = smilies_sort_multi_array_attachment($all_smilies, 'count', 'DESC');

$limit = ( $return_limit > count($all_smilies) ) ? count($all_smilies) : $return_limit;

for ($i = 0; $i < $limit; $i++)
{
	if ($all_smilies[$i]['count'] != 0)
	{
		$class = ( !($i+1 % 2) ) ? $theme['td_class2'] : $theme['td_class1'];

		smilies_do_math($all_smilies[0]['count'], $all_smilies[$i]['count'], $total_smilies);

		$template->assign_block_vars('topsmilies', array(
			'RANK' => $i+1,
			'CLASS' => $class,
			'CODE' => $all_smilies[$i]['code'],
			'USES' => $all_smilies[$i]['count'],
			'PERCENTAGE' => $percentage,
			'BAR' => $bar_percent,
			'URL' => '<img src="'. $board_config['smilies_path'] . '/' . $all_smilies[$i]['smile_url'] . '" alt="' . $all_smilies[$i]['smile_url'] . '" border="0">')
		);
	}
}

?>
<?php
/***************************************************************************
 *                         album_personal_index.php
 *                            -------------------
 *   begin                : Monday, February 24, 2003
 *   copyright            : (C) 2003 Smartor
 *   email                : smartor_xp@hotmail.com
 *
 *   $Id: album_personal_index.php,v 2.0.3 2003/02/28 11:32:52 ngoctu Exp $
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
$album_root_path = $phpbb_root_path . 'album_mod/';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_ALBUM);
init_userprefs($userdata);
//
// End session management
//


//
// Get general album information
//
include($album_root_path . 'album_common.'.$phpEx);


$start = ( isset($_GET['start']) ) ? intval($_GET['start']) : 0;

if ( isset($_GET['mode']) || isset($_POST['mode']) )
{
	$mode = ( isset($_POST['mode']) ) ? $_POST['mode'] : $_GET['mode'];
}
else
{
	$mode = 'joined';
}

if(isset($_POST['order']))
{
	$sort_order = ($_POST['order'] == 'ASC') ? 'ASC' : 'DESC';
}
else if(isset($_GET['order']))
{
	$sort_order = ($_GET['order'] == 'ASC') ? 'ASC' : 'DESC';
}
else
{
	$sort_order = 'ASC';
}

//
// Memberlist sorting
//
$mode_types_text = array($lang['Sort_Joined'], $lang['Sort_Username'], $lang['Pics'], $lang['Last_Pic']);
$mode_types = array('joindate', 'username', 'pics', 'last_pic');

$select_sort_mode = '<select name="mode">';
for($i = 0; $i < count($mode_types_text); $i++)
{
	$selected = ( $mode == $mode_types[$i] ) ? ' selected="selected"' : '';
	$select_sort_mode .= '<option value="' . $mode_types[$i] . '"' . $selected . '>' . $mode_types_text[$i] . '</option>';
}
$select_sort_mode .= '</select>';

$select_sort_order = '<select name="order">';
if($sort_order == 'ASC')
{
	$select_sort_order .= '<option value="ASC" selected="selected">' . $lang['Sort_Ascending'] . '</option><option value="DESC">' . $lang['Sort_Descending'] . '</option>';
}
else
{
	$select_sort_order .= '<option value="ASC">' . $lang['Sort_Ascending'] . '</option><option value="DESC" selected="selected">' . $lang['Sort_Descending'] . '</option>';
}
$select_sort_order .= '</select>';


/*
+----------------------------------------------------------
| Start output the page
+----------------------------------------------------------
*/

$page_title = $lang['Album'];
include($phpbb_root_path . 'includes/page_header.'.$phpEx);

$template->set_filenames(array(
	'body' => 'album_personal_index_body.tpl')
);

$template->assign_vars(array(
	'L_SELECT_SORT_METHOD' => $lang['Select_sort_method'],
	'L_ORDER' => $lang['Order'],
	'L_SORT' => $lang['Sort'],
	'L_JOINED' => $lang['Joined'],
	'L_PICS' => $lang['Pics'],
	'L_USERS_PERSONAL_GALLERIES' => $lang['Users_Personal_Galleries'],
	'S_MODE_SELECT' => $select_sort_mode,
	'S_ORDER_SELECT' => $select_sort_order,
	'S_MODE_ACTION' => append_sid("album_personal_index.$phpEx")
	)
);


switch( $mode )
{
	case 'joined':
		$order_by = "user_regdate ASC LIMIT $start, " . $board_config['topics_per_page'];
		break;
	case 'username':
		$order_by = "username $sort_order LIMIT $start, " . $board_config['topics_per_page'];
		break;
	case 'pics':
		$order_by = "pics $sort_order LIMIT $start, " . $board_config['topics_per_page'];
		break;
	case 'last_pic':
		$order_by = "last_pic $sort_order LIMIT $start, " . $board_config['topics_per_page'];
		break;
	default:
		$order_by = "user_regdate $sort_order LIMIT $start, " . $board_config['topics_per_page'];
		break;
}

//--- Album Category Hierarchy : begin
//--- version : 1.1.0
$sql = "SELECT u.username, u.user_id, u.user_regdate, COUNT(p.pic_id) AS pics, MAX(p.pic_id) AS last_pic, COUNT(c.cat_user_id) AS cats
		FROM ". USERS_TABLE ." AS u, " . ALBUM_TABLE . " AS p, " . ALBUM_CAT_TABLE . " AS c
		WHERE u.user_id <> ". ANONYMOUS ."
			AND c.cat_user_id = u.user_id
			AND c.cat_id = p.pic_cat_id
		GROUP BY user_id
		ORDER BY $order_by";
//--- Album Category Hierarchy : end

if( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Could not query users', '', __LINE__, __FILE__, $sql);
}

$memberrow = array();

while( $row = $db->sql_fetchrow($result) )
{
	$memberrow[] = $row;
}

for ($i = 0; $i < count($memberrow); $i++)
{
	$template->assign_block_vars('memberrow', array(
		'ROW_CLASS' => ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'],
		'USERNAME' => $memberrow[$i]['username'],
		'U_VIEWGALLERY' => append_sid("album.$phpEx?user_id=". $memberrow[$i]['user_id']),
		'JOINED' => create_date($lang['DATE_FORMAT'], $memberrow[$i]['user_regdate'], $board_config['board_timezone']),
		'PICS' => $memberrow[$i]['pics'])
	);
}

//--- Album Category Hierarchy : begin
//--- version : 1.1.0
$sql = "SELECT COUNT(DISTINCT u.user_id) AS total
		FROM ". USERS_TABLE ." AS u, ". ALBUM_TABLE ." AS p, " . ALBUM_CAT_TABLE . " AS c
		WHERE u.user_id <> ". ANONYMOUS ."
			AND c.cat_user_id = u.user_id
			AND c.cat_id = p.pic_cat_id";
//--- Album Category Hierarchy : end

if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Error getting total galleries', '', __LINE__, __FILE__, $sql);
}

if ( $total = $db->sql_fetchrow($result) )
{
	$total_galleries = $total['total'];

	$pagination = generate_pagination("album_personal_index.$phpEx?mode=$mode&amp;order=$sort_order", $total_galleries, $board_config['topics_per_page'], $start). '&nbsp;';
}

$template->assign_vars(array(
	'PAGINATION' => $pagination,
	'PAGE_NUMBER' => sprintf($lang['Page_of'], ( floor( $start / $board_config['topics_per_page'] ) + 1 ), ceil( $total_galleries / $board_config['topics_per_page'] ))
	)
);

//
// Generate the page
//
$template->pparse('body');

include($phpbb_root_path . 'includes/page_tail.'.$phpEx);


// +-------------------------------------------------------------+
// |  Powered by Photo Album 2.x.x (c) 2002-2003 Smartor         |
// |  with Volodymyr (CLowN) Skoryk's Service Pack 1 � 2003-2004 |
// +-------------------------------------------------------------+

?>
<?php
/***************************************************************************
 *                           antirobot_pic.php
 *                           -------------------
 *   begin                : Friday, August 02, 2002
 *   copyright            : (C) 2002 Smartor
 *   email                : smartor_xp@hotmail.com
 *
 *   $Id: antirobot_pic.php,v 1.0.2 2003/02/07, 13:11:45 hoangngoctu Exp $
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

function gen_reg_key()
{
	$key = "";
	$max_length_reg_key = 5;
	$chars = array(
		"a","b","c","d","e","f","g","h","i","j","k","l","m",
		"n","o","p","q","r","s","t","u","v","w","x","y","z");

	$count = count($chars) - 1;

	srand((double)microtime()*1000000);

	for($i = 0; $i < $max_length_reg_key; $i++)
	{
		$key .= $chars[rand(0, $count)];
	}

	return($key);
}

define('IN_PHPBB', true);
$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_PROFILE);
init_userprefs($userdata);
//
// End session management
//

if( !isset($_GET['id']) )
{
	die('Lack of information');
}

$id = intval($_GET['id']);

if ( ($id < 1) or ($id > 5) )
{
	die('Bad request');
}

// Get the properly char in key
$sql = "SELECT * FROM " . ANTI_ROBOT_TABLE . "
		WHERE session_id = '" . $userdata['session_id'] . "'";

if( !$result = $db->sql_query($sql) )
{
	die('Cannot obtain information from the database');
}

if( $db->sql_numrows($result) == 0 )
{
	$reg_key = gen_reg_key();

	$sql = "INSERT INTO ". ANTI_ROBOT_TABLE . "
			VALUES ('" . $userdata['session_id'] . "', '" . $reg_key . "', '" . time() . "')";
	if( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Could not check registration information', '', __LINE__, __FILE__, $sql);
	}

	$sql = "SELECT * FROM " . ANTI_ROBOT_TABLE . "
			WHERE session_id = '" . $userdata['session_id'] . "'";

	if( !$result = $db->sql_query($sql) )
	{
		die('Cannot obtain information from the database');
	}
}

$reg_row = $db->sql_fetchrow($result);

$char = $reg_row['reg_key'][$id - 1];

// No Cache
header ("Expires: Sat, 10 Dec 1983 07:00:00 GMT");
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");  // HTTP/1.1
header ("Pragma: no-cache");                          // HTTP/1.0

// Send Image
header('Content-Disposition: inline; filename=smartor.gif');
header('Content-type: image/gif');
readfile('images/anti_robotic_reg/anti_robotic_reg_' . $char . '.gif');

?>
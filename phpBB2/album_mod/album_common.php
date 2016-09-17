<?php
/***************************************************************************
 *							   album_common.php
 *                            -------------------
 *   begin                : Saturday, February 01, 2003
 *   copyright            : (C) 2003 Smartor
 *   email                : smartor_xp@hotmail.com
 *
 *   $Id: album_common.php,v 2.0.2 2003/03/03 22:38:24 ngoctu Exp $
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
 
 /***************************************************************************
 *
 *   MODIFICATIONS:
 *   	-added a query to get SP config info
 *   	-added a include to SP functions
 *
 ***************************************************************************/

if ( !defined('IN_PHPBB') )
{
	die('Hacking attempt');
}


//
// Include Language
//
$language = $board_config['default_lang'];

if ( !file_exists($phpbb_root_path . 'language/lang_' . $language . '/lang_main_album.'.$phpEx) )
{
	$language = 'english';
}

include($phpbb_root_path . 'language/lang_' . $language . '/lang_main_album.' . $phpEx);


//
// Get Album Config
//
$sql = "SELECT *
		FROM ". ALBUM_CONFIG_TABLE;
if(!$result = $db->sql_query($sql))
{
	message_die(GENERAL_ERROR, "Could not query Album config information", "", __LINE__, __FILE__, $sql);
}
while( $row = $db->sql_fetchrow($result) )
{
	$album_config_name = $row['config_name'];
	$album_config_value = $row['config_value'];
	$album_config[$album_config_name] = $album_config_value;
}
//--- Album Category Hirarchy : begin
//--- version : 1.2.0
if($album_config['album_debug_mode'] == 1)
{
 	$GLOBALS['album_debug_enabled'] = true;
}
else
{
    $GLOBALS['album_debug_enabled'] = false;
}
//--- Album Category Hirarchy : end
//get SP config info
$sql = "SELECT *
		FROM ". ALBUM_SP_CONFIG_TABLE;
if(!$result = $db->sql_query($sql))
{
	message_die(GENERAL_ERROR, "Could not query SP config information", "", __LINE__, __FILE__, $sql);
}
while( $row = $db->sql_fetchrow($result) )
{
	$album_sp_config_name = $row['config_name'];
	$album_sp_config_value = $row['config_value'];
	
	$album_sp_config[$album_sp_config_name] = $album_sp_config_value;
}
//end get SP config info

//
// Set ALBUM Version
//
$template->assign_vars(array(
	'ALBUM_VERSION' => '2' . $album_config['album_version']
	)
);

//--- Album Category Hierarchy : begin
//--- version : <= 1.1.0
if (!isset($album_root_path) || empty($album_root_path)) 
{
    $album_root_path = $phpbb_root_path . 'album_mod/';
}
//--- Album Category Hierarchy : end

include($album_root_path . 'album_functions.' . $phpEx);

//--- Album Category Hierarchy : begin
//--- version : <= 1.1.0
include($album_root_path . 'album_hierarchy_functions.' . $phpEx);
//--- Album Category Hierarchy : end
include($album_root_path . 'clown_album_functions.' . $phpEx);

?>
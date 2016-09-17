<?php
/***************************************************************************
 *                            function_selects.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: functions_selects.php,v 1.3.2.4 2002/12/22 12:20:35 psotfx Exp $
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
 *
 ***************************************************************************/

//
// Pick a language, any language ...
//
function language_select($default, $select_name = "language", $dirname="language")
{
	global $phpEx, $phpbb_root_path;

	$dir = opendir($phpbb_root_path . $dirname);

	$lang = array();
	while ( $file = readdir($dir) )
	{
		if (preg_match('#^lang_#i', $file) && !is_file(@phpbb_realpath($phpbb_root_path . $dirname . '/' . $file)) && !is_link(@phpbb_realpath($phpbb_root_path . $dirname . '/' . $file)))
		{
			$filename = trim(str_replace("lang_", "", $file));
			$displayname = preg_replace("/^(.*?)_(.*)$/", "\\1 [ \\2 ]", $filename);
			$displayname = preg_replace("/\[(.*?)_(.*)\]/", "[ \\1 - \\2 ]", $displayname);
			$lang[$displayname] = $filename;
		}
	}

	closedir($dir);

	@asort($lang);
	@reset($lang);

	$lang_select = '<select name="' . $select_name . '">';
	while ( list($displayname, $filename) = @each($lang) )
	{
		$selected = ( strtolower($default) == strtolower($filename) ) ? ' selected="selected"' : '';
		$lang_select .= '<option value="' . $filename . '"' . $selected . '>' . ucwords($displayname) . '</option>';
	}
	$lang_select .= '</select>';

	return $lang_select;
}

//
// Pick a template/theme combo, 
//
function style_select($default_style, $select_name = "style", $dirname = "templates")
{
	global $db;

	$sql = "SELECT themes_id, style_name
		FROM " . THEMES_TABLE . "
		ORDER BY template_name, themes_id";
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, "Couldn't query themes table", "", __LINE__, __FILE__, $sql);
	}

	$style_select = '<select name="' . $select_name . '">';
	while ( $row = $db->sql_fetchrow($result) )
	{
		$selected = ( $row['themes_id'] == $default_style ) ? ' selected="selected"' : '';

		$style_select .= '<option value="' . $row['themes_id'] . '"' . $selected . '>' . $row['style_name'] . '</option>';
	}
	$style_select .= "</select>";

	return $style_select;
}

//
// Pick a timezone
//
function tz_select($default, $select_name = 'timezone')
{
	global $sys_timezone, $lang;

	if ( !isset($default) )
	{
		$default == $sys_timezone;
	}
	$tz_select = '<select name="' . $select_name . '">';

	while( list($offset, $zone) = @each($lang['tz']) )
	{
		$selected = ( $offset == $default ) ? ' selected="selected"' : '';
		$tz_select .= '<option value="' . $offset . '"' . $selected . '>' . $zone . '</option>';
	}
	$tz_select .= '</select>';

	return $tz_select;
}
//
// Pick a (canned) date format
//
function date_format_select($default, $timezone, $select_name = 'dateformat')
{
	global $board_config;

	// Include any valid PHP date format strings here, in your preferred order
	$date_formats = array(
		'D d M, Y g:i a',
		'D d M, Y H:i',
		'D M d, Y g:i a',
		'D M d, Y H:i',
		'jS F Y, g:i a',
		'jS F Y, H:i',
		'F jS Y, g:i a',
		'F jS Y, H:i',
		'j/n/Y, g:i a',
		'j/n/Y, H:i',
		'n/j/Y, g:i a',
		'n/j/Y, H:i',
		'Y-m-d, g:i a',
		'Y-m-d, H:i'
	);

	if ( !isset($timezone) )
	{
		$timezone == $board_config['board_timezone'];
	}
	$now = time() + (3600 * $timezone);

	$df_select = '<select name="' . $select_name . '">';
	for ($i = 0; $i < sizeof($date_formats); $i++)
	{
		$format = $date_formats[$i];
		$display = date($format, $now);
		$df_select .= '<option value="' . $format . '"';
		if (isset($default) && ($default == $format))
		{
			$df_select .= ' selected';
		}
		$df_select .= '>' . $display . '</option>';
	}
	$df_select .= '</select>';

	return $df_select;
}

function admin_date_format_select($default, $timezone, $select_name = 'default_dateformat') 
{ 
global $board_config; 

// Include any valid PHP date format strings here, in your preferred order 
$date_formats = array( 
'D d M, Y g:i a', 
'D d M, Y H:i', 
'D M d, Y g:i a', 
'D M d, Y H:i', 
'D jS M g:i a', 
'D jS M H:i', 
'jS F Y, g:i a', 
'jS F Y, H:i', 
'F jS Y, g:i a', 
'F jS Y, H:i', 
'j/n/Y, g:i a', 
'j/n/Y, H:i', 
'n/j/Y, g:i a', 
'n/j/Y, H:i', 
'Y-m-d, g:i a', 
'Y-m-d, H:i' 
); 

if ( !isset($timezone) ) 
{ 
$timezone == $board_config['board_timezone']; 
} 
$now = time() + (3600 * $timezone); 

$df_select = '<select name="' . $select_name . '">'; 
for ($i = 0; $i < sizeof($date_formats); $i++) 
{ 
$format = $date_formats[$i]; 
$display = date($format, $now); 
$df_select .= '<option value="' . $format . '"'; 
if (isset($default) && ($default == $format)) 
{ 
$df_select .= ' selected'; 
} 
$df_select .= '>' . $display . '</option>'; 
} 
$df_select .= '</select>'; 

return $df_select; 
}

?>

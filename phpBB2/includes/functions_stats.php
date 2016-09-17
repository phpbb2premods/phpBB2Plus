<?php
/***************************************************************************
*                           functions_stats.php
*                            -------------------
*   begin                : Wed, Sep 04, 2002
*   copyright            : (C) 2002 Meik Sievertsen
*   email                : acyd.burn@gmx.de
*
*   $Id: functions_stats.php,v 1.13 2002/11/28 18:37:55 acydburn Exp $
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

// For backward compatibility
function module_language_parse($lang_key, $lang_var)
{
	global $lang;

	$lang[$lang_key] = $lang_var;
}

function sql_quote($data)
{
	$data = str_replace("'", "\'", $data);
	return ($data);
}

function generate_module_info($module_data, $install = FALSE)
{
	global $db, $phpbb_root_path, $__stats_config;

	$module_dir = trim($module_data['name']);

	//
	// Get Info from Cache or not...
	//
	$condition_mode = FALSE;
	$ret_array['condition_result'] = TRUE;
	$condition = '';

	if ($module_data['module_info_time'] == filemtime($phpbb_root_path . $__stats_config['modules_dir'] . '/' . $module_dir . '/info.txt'))
	{
		$ret_array = unserialize(stripslashes($module_data['module_info_cache']));
	}
	else
	{
		$extra_info_mode = FALSE;
		$ret_array['default_update_time'] = 0;
		$data_file = @file($phpbb_root_path . trim($__stats_config['modules_dir']) . '/' . $module_dir . '/info.txt');
		
		while (list($key, $data) = @each($data_file))
		{
			if ((!$extra_info_mode) && (!$condition_mode))
			{
				if (preg_match("/\[name\]/", $data))
				{
					$ret_array['name'] = trim(str_replace("[name]", '', $data));
				}
				elseif (preg_match("/\[author\]/", $data))
				{
					$ret_array['author'] = trim(str_replace("[author]", '', $data));
				}
				elseif (preg_match("/\[email\]/", $data))
				{
					$ret_array['email'] = trim(str_replace("[email]", '', $data));
				}
				elseif (preg_match("/\[url\]/", $data))
				{
					$ret_array['url'] = trim(str_replace("[url]", '', $data));
				}
				elseif (preg_match("/\[version\]/", $data))
				{
					$ret_array['version'] = trim(str_replace("[version]", '', $data));
				}
				elseif (preg_match("/\[update_time\]/", $data))
				{
					$ret_array['default_update_time'] = trim(str_replace("[update_time]", '', $data));
				}
				elseif (preg_match("/\[stats_mod_version\]/", $data))
				{
					$ret_array['stats_mod_version'] = trim(str_replace("[stats_mod_version]", '', $data));
				}
				elseif (preg_match("/\[extra_info\]/", $data))
				{
					$extra_info_mode = TRUE;
					$ret_array['extra_info'] =  trim(str_replace("[extra_info]", '', $data));
				}
			}
			else
			{
				if ($extra_info_mode)
				{
					if (preg_match("/\[\/extra_info\]/", $data))
					{
						$extra_info_mode = FALSE;
					}
					else
					{
						$ret_array['extra_info'] .= $data;
					}
				}
			}
		}

		$sql = "UPDATE " . MODULES_TABLE . "
		SET module_info_cache = '" . addslashes(serialize($ret_array)) . "',
		module_info_time = " . filemtime($phpbb_root_path . $__stats_config['modules_dir'] . '/' . $module_dir . '/info.txt') . "
		WHERE module_id = " . intval($module_data['module_id']);

		if (!$db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, 'Could not update Info Cache', '', __LINE__, __FILE__, $sql);
		}
		
	}
	
	$ret_array['dname'] = $module_dir;
	$ret_array['update_time'] = $module_data['update_time'];
	$ret_array['auth_value'] = $module_data['auth_value'];
	$ret_array['active'] = $module_data['active'];

	if ($install)
	{
		$data_file = @file($phpbb_root_path . trim($__stats_config['modules_dir']) . '/' . $module_dir . '/info.txt');

		while (list($key, $data) = @each($data_file))
		{
			if (!$condition_mode)
			{
				if (preg_match("/\[condition\]/", $data))
				{
					$condition_mode = TRUE;
					$condition =  trim(str_replace("[condition]", '', $data));
				}
			}
			else
			{
				if (preg_match("/\[\/condition\]/", $data))
				{
					$condition_mode = FALSE;
				}
				else
				{
					$condition .= $data;
				}
			}
		}

		// Parse the condition
		if ($condition != '')
		{
			$return_val = TRUE;
			eval($condition);
			$ret_array['condition_result'] = $return_val;
		}
	}

	return $ret_array;
}

//
// Get and update Module List
//
function update_module_list()
{
	global $phpbb_root_path, $db, $__stats_config;

	//
	// Returns a list of modules found by directory and updates the database as needed
	//
	$ret_list = array();
	
	$handle = @opendir($phpbb_root_path . $__stats_config['modules_dir']);

	if (!$handle)
	{
		message_die(GENERAL_ERROR, "Unable to open directory " . $phpbb_root_path . $__stats_config['modules_dir']);
	}

	$dir_list = '';
	
	while ($file = readdir($handle))
	{
		if ($file != '.' && $file != '..' && is_dir($phpbb_root_path . $__stats_config['modules_dir'] . '/' . $file) && ($file != '_vti_cnf') && ($file != 'CVS') )
		{
			$dir_list .= ($dir_list == '') ? "'$file'" : ", '$file'";
			
			$sql = "SELECT MAX(display_order) as max
			FROM " . MODULES_TABLE;

			if (!$result = $db->sql_query($sql))
			{
				message_die(GENERAL_ERROR, 'Unable to select display order', '', __LINE__, __FILE__, $sql);
			}

			$row = $db->sql_fetchrow($result);
			
			$curr_max = $row['max'];
			
			$sql = "SELECT module_id, name, display_order, active
			FROM " . MODULES_TABLE . "
			WHERE (name = '" . trim($file) . "')";

			if (!$result = $db->sql_query($sql))
			{
				message_die(GENERAL_ERROR, 'Could not query Modules Table', '', __LINE__, __FILE__, $sql);
			}

			if ($db->sql_numrows($result) == 0)
			{
				$sql = "SELECT MAX(module_id) as next_id FROM " . MODULES_TABLE;

				if (!($result = $db->sql_query($sql)) )
				{
					message_die(GENERAL_ERROR, 'Unable to get next Module ID', '', __LINE__, __FILE__, $sql);
				}
				
				$row = $db->sql_fetchrow($result);
				$next_id = $row['next_id'] + 1;
			    
				$sql = "INSERT INTO  " . MODULES_TABLE . "
				(module_id, name, display_order, module_info_cache, module_db_cache, module_result_cache)
				VALUES (" . $next_id . ", '" . trim($file) . "', " . ($curr_max + 10) . ", '', '', '')";

				if (!$db->sql_query($sql))
				{
					message_die(GENERAL_ERROR, 'Could not insert data into Modules Table', '', __LINE__, __FILE__, $sql);
				}
				
				$sql = "SELECT module_id, display_order, active
				FROM " . MODULES_TABLE . "
				WHERE module_id = " . $next_id;
				
				if (!$result = $db->sql_query($sql))
				{
					message_die(GENERAL_ERROR, 'Unable to select created Module Entry', '', __LINE__, __FILE__, $sql);
				}

				$row = $db->sql_fetchrow($result);
			}
			else
			{
				$row = $db->sql_fetchrow($result);
			}

		}
	}

	//
	// Kill old module folders that were deleted
	//
	$sql = "DELETE FROM " . MODULES_TABLE . "
	WHERE (name NOT IN ($dir_list))";

	if (!$db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, 'Could not delete obsolete Modules', '', __LINE__, __FILE__, $sql);
	}
}

//
// Get complete Module List from Database
//
function get_module_list_from_db()
{
	global $phpbb_root_path, $db, $__stats_config;

	//
	// Returns a list of modules stored in the database
	//
	$ret_list = array();
	
	$sql = "SELECT module_id, name, display_order
	FROM " . MODULES_TABLE . "
	WHERE (active = 1) AND (installed = 1)
	ORDER BY display_order ASC";

	if (!$result = $db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, 'Could not get Module List', '', __LINE__, __FILE__, $sql);
	}

	if ($db->sql_numrows($result) != 0)
	{
		$rows = $db->sql_fetchrowset($result);

		for ($i = 0; $i < count($rows); $i++)
		{
			$ret_list[$rows[$i]['module_id']] = $rows[$i]['name'];
		}
	}

	return ($ret_list);
}

//
// Get complete Module Data from Database
//
function get_module_data_from_db()
{
	global $phpbb_root_path, $db, $__stats_config;

	//
	// Returns a list of modules stored in the database
	//
	$ret_list = array();
	
	$sql = "SELECT *
	FROM " . MODULES_TABLE . "
	WHERE (active = 1) AND (installed = 1)
	ORDER BY display_order ASC";

	if (!$result = $db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, 'Could not get Module List', '', __LINE__, __FILE__, $sql);
	}

	if (($num_rows = $db->sql_numrows($result)) != 0)
	{
		$rows = $db->sql_fetchrowset($result);

		for ($i = 0; $i < $num_rows; $i++)
		{
			$ret_list[$rows[$i]['module_id']] = $rows[$i];
		}
	}

	return ($ret_list);
}


//
// Check Module Authentication
// Only ALL, REG and ADMIN is supported
//
function module_auth_check($module_data, $userdata)
{
	// FALSE = Not Authorized
	// TRUE = Authorized
	global $db;

	$auth_value = intval($module_data['auth_value']);

	switch ($auth_value)
	{
		case AUTH_ALL:
			return (true);
			break;

		case AUTH_REG:
			if ( ($userdata['session_logged_in']) && ($userdata['user_id'] != ANONYMOUS) )
			{
				return (true);
			}
			else
			{
				return (false);
			}
			break;

		case AUTH_ADMIN:
			if ( ( $userdata['user_level'] == ADMIN && $userdata['session_logged_in'] ) )
			{
				return (true);
			}
			else
			{
				return (false);
			}
			break;
	}

	return (false);
}

?>
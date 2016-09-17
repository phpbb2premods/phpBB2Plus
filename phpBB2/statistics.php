<?php
/***************************************************************************
 *								statistics.php
 *                            -------------------
 *   begin                : Sat, Aug 31, 2002
 *   copyright            : (C) 2002 Meik Sievertsen
 *   email                : acyd.burn@gmx.de
 *
 *   $Id: statistics.php,v 1.13 2003/02/05 13:12:03 acydburn Exp $
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

define('IN_PHPBB', true);
$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);

// Prepend all Variables with '__' to prevent conflicts with Variables from included Variables.
$__stats_config = array();

$sql = 'SELECT *
FROM ' . STATS_CONFIG_TABLE;
	 
if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Could not query statistics config table', '', __LINE__, __FILE__, $sql);
}

while ($row = $db->sql_fetchrow($result))
{
	$__stats_config[$row['config_name']] = trim($row['config_value']);
}

include($phpbb_root_path . 'includes/functions_stats.' . $phpEx);
include($phpbb_root_path . 'includes/functions_module.' . $phpEx);

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_INDEX);
init_userprefs($userdata);
//
// End session management
//

$language = $board_config['default_lang'];

if (!file_exists($phpbb_root_path . 'language/lang_' . $language . '/lang_statistics.' . $phpEx))
{
	$language = 'english';
}

include($phpbb_root_path . 'language/lang_' . $language . '/lang_statistics.' . $phpEx);

$page_title = $lang['Statistics_title'];
include('includes/page_header.php');

$template->set_filenames(array(
	'body' => 'statistics.tpl')
);

$__module_rows = get_module_list_from_db();
$__stat_module_data = get_module_data_from_db();
$return_limit = $__stats_config['return_limit'];

@reset($__module_rows);

$__stat_module_rows = array();
$__count = 0;

while (list($__module_id, $__module_name) = each($__module_rows))
{
	$__stat_module_rows[$__count]['module_id'] = $__module_id;
	$__stat_module_rows[$__count]['module_name'] = $__module_name;
	$__count++;
}

for ($__count = 0; $__count < count($__stat_module_rows); $__count++)
{
	$__module_name = trim($__stat_module_rows[$__count]['module_name']);
	$__module_id = intval($__stat_module_rows[$__count]['module_id']);

	//
	// Clear Template and Destroy Language Variables
	//
	$template->destroy();
	
	if (module_auth_check($__stat_module_data[$__module_id], $userdata))
	{
		print '<a name="' . $__module_id . '"></a>';

		$__module_info = generate_module_info($__stat_module_data[$__module_id]);

		$__tpl_name = 'module_tpl_' . $__module_id;
		$__module_root_path = './../../' . $phpbb_root_path;
		$__module_data = $__stat_module_data[$__module_id];
		$mod_lang = 'module_language_parse';		
		
//		$lang = array();

		include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_main.' . $phpEx);
		include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_admin.' . $phpEx);

		$__language = $board_config['default_lang'];

		if (!@file_exists(@realpath($phpbb_root_path . 'language/lang_' . $__language . '/lang_statistics.' . $phpEx)))
		{
			$__language = 'english';
		}
		include($phpbb_root_path . 'language/lang_' . $__language . '/lang_statistics.' . $phpEx);

		$__language = $board_config['default_lang'];

		if (!@file_exists(@realpath($phpbb_root_path . $__stats_config['modules_dir'] . '/' . $__module_name . '/lang_' . $__language . '/lang.' . $phpEx)))
		{
			$__language = 'english';
		}
		include($phpbb_root_path . $__stats_config['modules_dir'] . '/' . $__module_name . '/lang_' . $__language . '/lang.' . $phpEx);
		$__reload = FALSE;

		if ((trim($__module_data['module_db_cache']) != '') || (trim($__module_data['module_result_cache']) != ''))
		{
			if (($__module_data['module_cache_time'] + ($__module_data['update_time'] * 60)) > time())
			{
				if (trim($__module_data['module_db_cache']) != '')
				{
					$statistics->db_cache_used = TRUE;
					$stat_db->begin_cached_query(TRUE, trim($__module_data['module_db_cache']));
				}

				if (trim($__module_data['module_result_cache']) != '')
				{
					$statistics->result_cache_used = TRUE;
					$result_cache->begin_cached_results(TRUE, trim($__module_data['module_result_cache']));
				}

				include($phpbb_root_path . $__stats_config['modules_dir'] . '/' . $__module_name . '/module.php');

				if (trim($__module_data['module_db_cache']) != '')
				{
					$stat_db->end_cached_query($__module_id);
				}
				if (trim($__module_data['module_result_cache']) != '')
				{
					$result_cache->end_cached_query($__module_id);
				}
			}
			else
			{
				$__reload = TRUE;
			}
		}
		else
		{
			$__reload = TRUE;
		}

		if ($__reload)
		{
			$statistics->result_cache_used = FALSE;
			$statistics->db_cache_used = FALSE;

			$stat_db->begin_cached_query();
			$result_cache->begin_cached_results();
			include($phpbb_root_path . $__stats_config['modules_dir'] . '/' . $__module_name . '/module.php');
			$stat_db->end_cached_query($__module_id);
			$result_cache->end_cached_query($__module_id);
		}
				
		$template->set_filenames(array(
			$__tpl_name => $__module_root_path . $__stats_config['modules_dir'] . '/' . $__module_info['dname'] . '/module.tpl')
		);
	
		$template->pparse($__tpl_name);

		print '<br />';
	}
}
	
$sql = "UPDATE " . STATS_CONFIG_TABLE . "
SET config_value = " . (intval($__stats_config['page_views']) + 1) . "
WHERE (config_name = 'page_views')";

if (!$db->sql_query($sql))
{
	message_die(GENERAL_ERROR, 'Unable to Update View Counter', '', __LINE__, __FILE__, $sql);
}

$template->assign_vars(array(
	'VIEWED_INFO' => sprintf($lang['Viewed_info'], $__stats_config['page_views']),
	'INSTALL_INFO' => sprintf($lang['Install_info'], create_date($board_config['default_dateformat'], $__stats_config['install_date'], $board_config['board_timezone'])),
	'VERSION_INFO' => ( isset($lang['Version_info']) ) ? sprintf($lang['Version_info'], $__stats_config['version']) : '')
);
	
$template->assign_block_vars('main_bottom',array());

$template->pparse('body');

include('includes/page_tail.php');

?>
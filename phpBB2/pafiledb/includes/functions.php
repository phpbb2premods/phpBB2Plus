<?php
/*
  paFileDB 3.0
  �2001/2002 PHP Arena
  Written by Todd
  todd@phparena.net
  http://www.phparena.net
  Keep all copyright links on the script visible
  Please read the license included with this script for more information.
*/

if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}


class pafiledb_functions
{
	function set_config($config_name, $config_value)
	{
		global $cache, $pafiledb_config, $db;
		
		$sql = "UPDATE " . PA_CONFIG_TABLE . " SET
			config_value = '" . str_replace("\'", "''", $config_value) . "'
			WHERE config_name = '$config_name'";
		if( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, "Failed to update pafiledb configuration for $config_name", "", __LINE__, __FILE__, $sql);
		}

		if (!$db->sql_affectedrows() && !isset($pafiledb_config[$config_name]))
		{
			$sql = 'INSERT INTO ' . PA_CONFIG_TABLE . " (config_name, config_value)
				VALUES ('$config_name', '" . str_replace("\'", "''", $config_value) . "')";

			if( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, "Failed to update pafiledb configuration for $config_name", "", __LINE__, __FILE__, $sql);
			}
		}

		$pafiledb_config[$config_name] = $config_value;
		$cache->destroy('config');
	}

	function post_icons($file_posticon = '')
	{
		global $lang, $phpbb_root_path;
		$curicons = 1;

		if ($file_posticon == 'none' || $file_posticon == 'none.gif' or empty($file_posticon))
		{
			$posticons .= '<input type="radio" name="posticon" value="none" checked><a class="gensmall">' . $lang['None'] . '</a>&nbsp;';
		}
		else 
		{
			$posticons .= '<input type="radio" name="posticon" value="none"><a class="gensmall">' . $lang['None'] . '</a>&nbsp;';
		}

		$handle = @opendir($phpbb_root_path . ICONS_DIR);
          
		while ($icon = @readdir($handle))
		{
			if ($icon !== '.' && $icon !== '..' && $icon !== 'index.htm') 
			{
				if ($file_posticon == $icon) 
				{
					$posticons .= '<input type="radio" name="posticon" value="' . $icon . '" checked><img src="' . $phpbb_root_path . ICONS_DIR . $icon . '">&nbsp;';
				} 
				else 
				{
					$posticons .= '<input type="radio" name="posticon" value="' . $icon . '"><img src="' . $phpbb_root_path . ICONS_DIR . $icon . '">&nbsp;';
				}

				$curicons++;

				if ($curicons == 8) 
				{
					$posticons .= '<br>';
					$curicons = 0;
				}
			}
		}
		@closedir($handle);
		return $posticons;
	}

	function license_list($license_id = 0)
	{
		global $db, $lang;

		if ($license_id == 0) 
		{
			$list .= '<option calue="0" selected>' . $lang['None'] . '</option>';
		}
		else
		{
			$list .= '<option calue="0">' . $lang['None'] . '</option>';
		}

		$sql = 'SELECT * 
			FROM ' . PA_LICENSE_TABLE . ' 
			ORDER BY license_id';

		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Couldnt Query info', '', __LINE__, __FILE__, $sql);
		}

		while ($license = $db->sql_fetchrow($result)) 
		{
			if ($license_id == $license['license_id']) 
			{
				$list .= '<option value="' . $license['license_id'] . '" selected>' . $license['license_name'] . '</option>';
			}
			else 
			{
				$list .= '<option value="' . $license['license_id'] . '">' . $license['license_name'] . '</option>';
			}
		}
		return $list;
	}

	function gen_unique_name($file_type)
	{
		global $pafiledb_config;
	
		srand((double)microtime()*1000000);	// for older than version 4.2.0 of PHP

		do
		{
			$filename = md5(uniqid(rand())) . $file_type;
		}
		while( file_exists($pafiledb_config['upload_dir'] . '/' . $filename) );
	
		return $filename;
	}


	function get_extension($filename)
	{
		$help = explode('.', $filename); 
		$tmp = strtolower(array_pop($help)); 
		return $tmp;
	}

	function upload_file($userfile, $userfile_name, $userfile_size, $upload_dir = '', $local = false)
	{
		global $phpbb_root_path, $lang, $phpEx, $board_config, $pafiledb_config, $userdata;
	
		@set_time_limit(0);
		$file_info = array();
	
		$file_info['error'] = FALSE;
	
		if(file_exists($phpbb_root_path . $upload_dir . $userfile_name)) 
		{	
			$userfile_name = time() . $userfile_name;
		}
			
		// =======================================================
		// if the file size is more than the allowed size another error message
		// =======================================================
			
		if ($userfile_size > $pafiledb_config['max_file_size'] && $userdata['user_level'] != ADMIN && $userdata['session_logged_in'])
		{
			$file_info['error'] = TRUE;
			if(!empty($file_info['message']))
			{
				$file_info['message'] .= '<br>';
			}
			$file_info['message'] .= $lang['Filetoobig'];
		}

		// =======================================================
		// Then upload the file, and check the php version
		// =======================================================

		else 
		{
			$ini_val = ( @phpversion() >= '4.0.0' ) ? 'ini_get' : 'get_cfg_var';

			$upload_mode = (@$ini_val('open_basedir') || @$ini_val('safe_mode')) ? 'move' : 'copy';
			$upload_mode = ($local) ? 'local' : $upload_mode;

			if($this->do_upload_file($upload_mode, $userfile, $phpbb_root_path . $upload_dir . $userfile_name))
			{
				$file_info['error'] = TRUE;
				if(!empty($file_info['message']))
				{
					$file_info['message'] .= '<br>';
				}
				$file_info['message'] .= 'Couldn\'t Upload the File.';
			}

			$file_info['url'] = get_formated_url() . '/' . $upload_dir . $userfile_name;
		}
		return $file_info;
	}

	function do_upload_file($upload_mode, $userfile, $userfile_name)
	{
		switch ($upload_mode)
		{
			case 'copy':
				if ( !@copy($userfile, $userfile_name) ) 
				{
					if ( !@move_uploaded_file($userfile, $userfile_name) ) 
					{
						return false;
					}
				} 
				@chmod($userfile_name, 0666);
				break;

			case 'move':
				if ( !@move_uploaded_file($userfile, $userfile_name) ) 
				{ 
					if ( !@copy($userfile, $userfile_name) ) 
					{
						return false;
					}
				} 
				@chmod($userfile_name, 0666);
				break;

			case 'local':
				if (!@copy($userfile, $userfile_name))
				{
					return false;
				}
				@chmod($userfile_name, 0666);
				@unlink($userfile);
				break;
		}

		return;
	}	
	
	function pafiledb_config() 
	{
		global $db;

		$sql = "SELECT * 
			FROM " . PA_CONFIG_TABLE;

		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Couldnt query Download configuration', '', __LINE__, __FILE__, $sql);
		}
	
		while ($row = $db->sql_fetchrow($result))
		{
			$pafiledb_config[$row['config_name']] = trim($row['config_value']);
		}

		$db->sql_freeresult($result);

		return ($pafiledb_config);
	}

	function get_file_size($file_id, $file_data = '')
	{
		global $db, $lang, $phpbb_root_path, $pafiledb_config;
	
		$directory = $phpbb_root_path . $pafiledb_config['upload_dir'];
	
		if(empty($file_data))
		{
			$sql = "SELECT file_dlurl, file_size, unique_name, file_dir
				FROM " . PA_FILES_TABLE . " 
				WHERE file_id = '" . $file_id . "'";
	
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Couldnt query Download URL', '', __LINE__, __FILE__, $sql);
			}	

			$file_data = $db->sql_fetchrow($result);

			$db->sql_freeresult($result);
		}

		$file_url = $file_data['file_dlurl'];
		$file_size = $file_data['file_size'];

		$formated_url = get_formated_url();
		$html_path = $formated_url . '/' . $directory;
		$update_filesize = FALSE;
	
		if (((substr($file_url, 0, strlen($html_path)) == $html_path) || !empty($file_data['unique_name'])) && empty($file_size))
		{
			$file_url = basename($file_url) ;
			$file_name = basename($file_url);

			if((!empty($file_data['unique_name'])) && (!file_exists($phpbb_root_path . $file_data['file_dir'] . $file_data['unique_name'])))
			{
				return $lang['Not_available'];
			}

			if(empty($file_data['unique_name']))
			{
				$file_size = @filesize($directory . $file_name);
			}
			else
			{
				$file_size = @filesize($phpbb_root_path . $file_data['file_dir'] . $file_data['unique_name']);
			}

			$update_filesize = TRUE;
		}
		elseif(empty($file_size) && ((!(substr($file_url, 0, strlen($html_path)) == $html_path)) || empty($file_data['unique_name'])))
		{
			$ourhead = "";
			$url = parse_url($file_url);
			$host = $url['host']; 
			$path = $url['path']; 
			$port = (!empty($url['port'])) ? $url['port'] : 80;

			$fp = @fsockopen($host, $port, $errno, $errstr, 20);
		
			if(!$fp)
			{ 
				return $lang['Not_available'];
			}
			else
			{ 
				fputs($fp, "HEAD $file_url HTTP/1.1\r\n"); 
				fputs($fp, "HOST: $host\r\n"); 
				fputs($fp, "Connection: close\r\n\r\n"); 

				while (!feof($fp))
				{
					$ourhead = sprintf('%s%s', $ourhead, fgets ($fp,128)); 
				}
			}
			@fclose ($fp);

			$split_head = explode('Content-Length: ', $ourhead);
		
			$file_size = round(abs($split_head[1]));
			$update_filesize = TRUE;
		}

		if($update_filesize)
		{
			$sql = 'UPDATE ' . PA_FILES_TABLE . "
				SET file_size = '$file_size'
				WHERE file_id = '$file_id'";
			
			if ( !($db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not update filesize', '', __LINE__, __FILE__, $sql);
			}
		}

		if ($file_size < 1024)
		{
			$file_size_out = intval($file_size) . ' ' . $lang['Bytes'];
		}
		if ($file_size >= 1025)
		{
			$file_size_out = round(intval($file_size) / 1024 * 100) / 100 . ' ' . $lang['KB'];
		}
		if ($file_size >= 1048575)
		{
			$file_size_out = round(intval($file_size) / 1048576 * 100) / 100 . ' ' . $lang['MB'];
		}

		return $file_size_out;

	}

	function get_rating($file_id, $file_rating = '')
	{
		global $db, $lang;
	
		$sql = "SELECT AVG(rate_point) AS rating 
			FROM " . PA_VOTES_TABLE . " 
			WHERE votes_file = '" . $file_id . "'";
	
		if(!($result = $db->sql_query($sql)))
		{
			message_die(GENERAL_ERROR, 'Couldnt rating info for the giving file', '', __LINE__, __FILE__, $sql);
		}

		$row = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);
		$file_rating = $row['rating'];

		return ($file_rating != 0) ? round($file_rating, 2) . ' / 10' : $lang['Not_rated'];
	}

	//===================================================
	// since that I can't use the original function with new template system
	// I just copy it and chagne it
	//===================================================
	function pa_generate_smilies($mode, $page_id)
	{
		global $db, $board_config, $pafiledb_template, $lang, $images, $theme, $phpEx, $phpbb_root_path;
		global $user_ip, $session_length, $starttime;
		global $userdata;

		$inline_columns = 4;
		$inline_rows = 5;
		$window_columns = 8;

		if ($mode == 'window')
		{
			$userdata = session_pagestart($user_ip, $page_id);
			init_userprefs($userdata);

			$gen_simple_header = TRUE;

			$page_title = $lang['Review_topic'] . " - $topic_title";
			include($phpbb_root_path . 'includes/page_header.'.$phpEx);

			$pafiledb_template->set_filenames(array(
				'smiliesbody' => 'posting_smilies.tpl')
			);
		}

		$sql = "SELECT emoticon, code, smile_url   
			FROM " . SMILIES_TABLE . " 
			ORDER BY smilies_id";
		if ($result = $db->sql_query($sql))
		{
			$num_smilies = 0;
			$rowset = array();
			while ($row = $db->sql_fetchrow($result))
			{
				if (empty($rowset[$row['smile_url']]))
				{
					$rowset[$row['smile_url']]['code'] = str_replace("'", "\\'", str_replace('\\', '\\\\', $row['code']));
					$rowset[$row['smile_url']]['emoticon'] = $row['emoticon'];
					$num_smilies++;
				}
			}

			if ($num_smilies)
			{
				$smilies_count = ($mode == 'inline') ? min(19, $num_smilies) : $num_smilies;
				$smilies_split_row = ($mode == 'inline') ? $inline_columns - 1 : $window_columns - 1;

				$s_colspan = 0;
				$row = 0;
				$col = 0;

				while (list($smile_url, $data) = @each($rowset))
				{
					if (!$col)
					{
						$pafiledb_template->assign_block_vars('smilies_row', array());
					}

					$pafiledb_template->assign_block_vars('smilies_row.smilies_col', array(
						'SMILEY_CODE' => $data['code'],
						'SMILEY_IMG' => $board_config['smilies_path'] . '/' . $smile_url,
						'SMILEY_DESC' => $data['emoticon'])
					);

					$s_colspan = max($s_colspan, $col + 1);

					if ($col == $smilies_split_row)
					{
						if ($mode == 'inline' && $row == $inline_rows - 1)
						{
							break;
						}
						$col = 0;
						$row++;
					}
					else
					{
						$col++;
					}
				}

				if ($mode == 'inline' && $num_smilies > $inline_rows * $inline_columns)
				{
					$pafiledb_template->assign_block_vars('switch_smilies_extra', array());

					$pafiledb_template->assign_vars(array(
						'L_MORE_SMILIES' => $lang['More_emoticons'], 
						'U_MORE_SMILIES' => append_sid("posting.$phpEx?mode=smilies"))
					);
				}

				$pafiledb_template->assign_vars(array(
					'L_EMOTICONS' => $lang['Emoticons'], 
					'L_CLOSE_WINDOW' => $lang['Close_window'], 
					'S_SMILIES_COLSPAN' => $s_colspan)
				);
			}
		}

		if ($mode == 'window')
		{
			$pafiledb_template->display('smiliesbody');

			include($phpbb_root_path . 'includes/page_tail.'.$phpEx);
		}
	}


	function obtain_ranks(&$ranks)
	{
		global $db, $cache;

		if ($cache->exists('ranks'))
		{
			$ranks = $cache->get('ranks');
		}
		else
		{
			$sql = "SELECT *
				FROM " . RANKS_TABLE . "
				ORDER BY rank_special, rank_min";
		
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, "Could not obtain ranks information.", '', __LINE__, __FILE__, $sql);
			}

			$ranks = array();
			while ( $row = $db->sql_fetchrow($result) )
			{
				$ranks[] = $row;
			}

			$db->sql_freeresult($result);
			$cache->put('ranks', $ranks);
		}
	}

	function pafiledb_unlink($filename)
	{
		global $pafiledb_config, $lang;

		$deleted = @unlink($filename);

		if (@file_exists($this->pafiledb_realpath($filename)) ) 
		{
			$filesys = eregi_replace('/','\\', $filename);
			$deleted = @system("del $filesys");

			if (@file_exists($this->pafiledb_realpath($filename))) 
			{
				$deleted = @chmod ($filename, 0775);
				$deleted = @unlink($filename);
				$deleted = @system("del $filesys");
			}
		}

		return ($deleted);
	}


	function pafiledb_realpath($path)
	{
		global $phpbb_root_path, $phpEx;

		return (!@function_exists('realpath') || !@realpath($phpbb_root_path . 'includes/functions.'.$phpEx)) ? $path : @realpath($path);
	}
	
	function sql_query_limit($query, $total, $offset = 0)
	{
		global $db;
		
		$query .= ' LIMIT ' . ((!empty($offset)) ? $offset . ', ' . $total : $total);
		return $db->sql_query($query);
	}
}

function get_formated_url()
{
	global $board_config;

	$server_protocol = ($board_config['cookie_secure']) ? 'https://' : 'http://';
	$server_name = preg_replace('#^\/?(.*?)\/?$#', '\1', trim($board_config['server_name']));
	$server_port = ($board_config['server_port'] <> 80) ? ':' . trim($board_config['server_port']) : '';
	$script_name = preg_replace('#^\/?(.*?)\/?$#', '\1', trim($board_config['script_path']));
	$script_name = ($script_name == '') ? $script_name : '/' . $script_name;
	$formated_url = $server_protocol . $server_name . $server_port . $script_name;
	
	return $formated_url;
}



function pafiledb_page_header($page_title)
{
	global $pafiledb_config, $lang, $pafiledb_template, $userdata, $images, $action, $_REQUEST, $pafiledb;
	global $template, $db, $theme, $gen_simple_header, $starttime, $phpEx, $board_config, $user_ip, $phpbb_root_path;
	global $admin_level, $level_prior, $tree, $do_gzip_compress; 
	
	if($action != 'download')
	{
		include_once($phpbb_root_path . 'includes/page_header.'.$phpEx);
	}

	if($action == 'category')
	{
		$upload_url = append_sid("dload.php?action=user_upload&cat_id={$_REQUEST['cat_id']}");
		$upload_auth = $pafiledb->modules[$pafiledb->module_name]->auth[$_REQUEST['cat_id']]['auth_upload'];
// MX Addon
		$mcp_url = append_sid("dload.php?action=mcp&cat_id={$_REQUEST['cat_id']}");
		$mcp_auth = $pafiledb->modules[$pafiledb->module_name]->auth[$_REQUEST['cat_id']]['auth_mod'];

	}
	else
	{
		$upload_url = append_sid("dload.php?action=user_upload");
		$cat_list = $pafiledb->modules[$pafiledb->module_name]->jumpmenu_option(0, 0, '', true, true);
//		$upload_auth = (empty($cat_list)) ? FALSE : TRUE;
// MX Addon
		$upload_auth = FALSE;
		$mcp_auth = FALSE;
		unset($cat_list);
	}
	
	$pafiledb_template->assign_vars(array(
		'IS_AUTH_VIEWALL' => ($pafiledb_config['settings_viewall']) ? (($pafiledb->modules[$pafiledb->module_name]->auth_global['auth_viewall']) ? TRUE : FALSE) : FALSE,
		'IS_AUTH_SEARCH' => ($pafiledb->modules[$pafiledb->module_name]->auth_global['auth_search']) ? TRUE : FALSE,
		'IS_AUTH_STATS' => ($pafiledb->modules[$pafiledb->module_name]->auth_global['auth_stats']) ? TRUE : FALSE,
		'IS_AUTH_TOPLIST' => ($pafiledb->modules[$pafiledb->module_name]->auth_global['auth_toplist']) ? TRUE : FALSE,
		'IS_AUTH_UPLOAD' => $upload_auth,
		'IS_ADMIN' => ( $userdata['user_level'] == ADMIN && $userdata['session_logged_in'] ) ? TRUE : 0,
// MX		'IS_MOD' => $pafiledb->modules[$pafiledb->module_name]->is_moderator(),
		'IS_MOD' => $pafiledb->modules[$pafiledb->module_name]->auth[$_REQUEST['cat_id']]['auth_mod'],
		'IS_AUTH_MCP' => $mcp_auth,
		'MCP_LINK' => $lang['pa_MCP'],
		'U_MCP' => $mcp_url,

		'L_OPTIONS' => $lang['Options'],
		'L_SEARCH' => $lang['Search'],
		'L_STATS' => $lang['Statistics'],
		'L_TOPLIST' => $lang['Toplist'],
		'L_UPLOAD' => $lang['User_upload'],
		'L_VIEW_ALL' => $lang['Viewall'],
		
		'SEARCH_IMG' => $images['pa_search'],
		'STATS_IMG' => $images['pa_stats'],
		'TOPLIST_IMG' => $images['pa_toplist'],
		'UPLOAD_IMG' => $images['pa_upload'],
		'VIEW_ALL_IMG' => $images['pa_viewall'],

		'U_TOPLIST' => append_sid("dload.php?action=toplist"),
		'U_PASEARCH' => append_sid("dload.php?action=search"),
		'U_UPLOAD' => $upload_url,
		'U_VIEW_ALL' => append_sid("dload.php?action=viewall"),
		'U_PASTATS' => append_sid("dload.php?action=stats"))
	);

}
//===================================================
// page footer for pafiledb 
//===================================================
function pafiledb_page_footer()
{
	global $cache, $lang, $pafiledb_template, $board_config, $_GET, $pafiledb, $userdata, $phpbb_root_path;
	global $phpEx, $template, $do_gzip_compress, $debug, $db, $starttime;
		
	$pafiledb_template->assign_vars(array(
		'JUMPMENU' => $pafiledb->modules[$pafiledb->module_name]->jumpmenu_option(),
		'L_JUMP' =>  $lang['jump'],
		'S_JUMPBOX_ACTION' => append_sid('dload.php'),
		'S_TIMEZONE' => sprintf($lang['All_times'], $lang[number_format($board_config['board_timezone'])]))
	);
	$pafiledb->modules[$pafiledb->module_name]->_pafiledb();
	if(!isset($_GET['explain']))
	{
		$pafiledb_template->display('body');
	}
	$cache->unload();

	if($action != 'download')
	{
		include_once($phpbb_root_path . 'includes/page_tail.'.$phpEx);
	}
}

//=========================================
// This class is used to determin Browser and operating system info of the user
//
//  Copyright (c) 2002 Chip Chapin <cchapin@chipchapin.com>
//                     http://www.chipchapin.com
//  All rights reserved.
//=========================================


class user_info
{
	var $agent = 'unknown';
	var $ver = 0;
	var $majorver = 0;
	var $minorver = 0;
	var $platform = 'unknown';

	/* Constructor
	 Determine client browser type, version and platform using
	 heuristic examination of user agent string.
	 @param $user_agent allows override of user agent string for testing.
	*/
	
	function user_info( $user_agent = '' )
	{
		global $_SERVER, $HTTP_USER_AGENT, $HTTP_SERVER_VARS;
		
		if (!empty($_SERVER['HTTP_USER_AGENT'])) 
		{
			$HTTP_USER_AGENT = $_SERVER['HTTP_USER_AGENT'];
		} 
		else if (!empty($HTTP_SERVER_VARS['HTTP_USER_AGENT'])) 
		{
			$HTTP_USER_AGENT = $HTTP_SERVER_VARS['HTTP_USER_AGENT'];
		}
		else if (!isset($HTTP_USER_AGENT))
		{
			$HTTP_USER_AGENT = '';
		}
		
		if (empty($user_agent))
		{
			$user_agent = $HTTP_USER_AGENT;
		}
	
		$user_agent = strtolower($user_agent);

		// Determine browser and version
		// The order in which we test the agents patterns is important
		// Intentionally ignore Konquerer.  It should show up as Mozilla.
		// post-Netscape Mozilla versions using Gecko show up as Mozilla 5.0
	
		if (preg_match( '/(opera |opera\/)([0-9]*).([0-9]{1,2})/', $user_agent, $matches)) ;
		elseif (preg_match( '/(msie )([0-9]*).([0-9]{1,2})/', $user_agent, $matches)) ;
		elseif (preg_match( '/(mozilla\/)([0-9]*).([0-9]{1,2})/', $user_agent, $matches)) ;
		else
		{
			$matches[1] = 'unknown'; 
			$matches[2] = 0; 
			$matches[3] = 0;
		}
		
		$this->majorver = $matches[2];
		$this->minorver = $matches[3];
		$this->ver = $matches[2] . '.' . $matches[3];
	
		switch ($matches[1]) 
		{
			case 'opera/':
			case 'opera ':
				$this->agent = 'OPERA'; 
				break;
	
			case 'msie ':
				$this->agent = 'IE'; 
				break;

			case 'mozilla/':
				$this->agent = 'NETSCAPE'; 
				if($this->majorver >= 5)
				{
					$this->agent = 'MOZILLA';
				}
				break;
			
			case 'unknown':
				$this->agent = 'OTHER';
				break;

			default:
				$this->agent = 'Oops!';
		}

    
		// Determine platform
		// This is very incomplete for platforms other than Win/Mac
	
		if (preg_match( '/(win|mac|linux|unix)/', $user_agent, $matches));
		else $matches[1] = 'unknown';
	
		switch ($matches[1])
		{
			case 'win':
				$this->platform = 'Win';
				break;

			case 'mac':
				$this->platform = 'Mac';
				break;

			case 'linux':
				$this->platform = 'Linux';
				break;

			case 'unix':
				$this->platform = 'Unix';
				break;

			case 'unknown':
				$this->platform = 'Other';
				break;

			default:
				$this->platform = 'Oops!';
		}
	}
	
	function update_downloader_info($file_id)
	{
		global $user_ip, $db, $userdata;
		
		$where_sql = ( $userdata['user_id'] != ANONYMOUS ) ? "user_id = '" . $userdata['user_id'] . "'" : "downloader_ip = '" . $user_ip . "'";
		
		$sql = "SELECT user_id, downloader_ip 
			FROM " . PA_DOWNLOAD_INFO_TABLE . " 
			WHERE $where_sql";
		
		if(!($result = $db->sql_query($sql)))
		{
			message_die(GENERAL_ERROR, 'Couldnt Query User id', '', __LINE__, __FILE__, $sql);
		}
		
		if(!$db->sql_numrows($result))
		{
			$sql = "INSERT INTO " . PA_DOWNLOAD_INFO_TABLE . " (file_id, user_id, downloader_ip, downloader_os, downloader_browser, browser_version) 
						VALUES('" . $file_id . "', '" . $userdata['user_id'] . "', '" . $user_ip . "', '" . $this->platform . "', '" . $this->agent . "', '" . $this->ver . "')";
			if(!($db->sql_query($sql)))
			{
				message_die(GENERAL_ERROR, 'Couldnt Update Downloader Table Info', '', __LINE__, __FILE__, $sql);
			}
		}

		$db->sql_freeresult($result);
	}
	
	function update_voter_info($file_id, $rating)
	{
		global $user_ip, $db, $userdata, $lang;
		
		$where_sql = ( $userdata['user_id'] != ANONYMOUS ) ? "user_id = '" . $userdata['user_id'] . "'" : "votes_ip = '" . $user_ip . "'";
		
		$sql = "SELECT user_id, votes_ip 
			FROM " . PA_VOTES_TABLE . " 
			WHERE $where_sql
			AND votes_file = '" . $file_id . "'
			LIMIT 1";
		
		if(!($result = $db->sql_query($sql)))
		{
			message_die(GENERAL_ERROR, 'Couldnt Query User id', '', __LINE__, __FILE__, $sql);
		}
		
		if(!$db->sql_numrows($result))
		{
			$sql = "INSERT INTO " . PA_VOTES_TABLE . " (user_id, votes_ip, votes_file, rate_point, voter_os, voter_browser, browser_version) 
						VALUES('" . $userdata['user_id'] . "', '" . $user_ip . "', '" . $file_id . "','" . $rating ."', '" . $this->platform . "', '" . $this->agent . "', '" . $this->ver . "')";
			if(!($db->sql_query($sql)))
			{
				message_die(GENERAL_ERROR, 'Couldnt Update Votes Table Info', '', __LINE__, __FILE__, $sql);
			}
		}
		else
		{
			message_die(GENERAL_MESSAGE, $lang['Rerror']);
		}
		
		$db->sql_freeresult($result);
	}	
}
?>

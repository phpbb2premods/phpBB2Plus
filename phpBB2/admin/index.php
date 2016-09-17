<?php
/***************************************************************************
 *                             (admin) index.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: index.php,v 1.40.2.5 2003/08/03 11:50:51 acydburn Exp $
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

define('IN_PHPBB', 1);
define('PCheck', true);
//
// Load default header
//
$no_page_header = TRUE;
$phpbb_root_path = "./../";
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);

// ---------------
// Begin functions
//
function inarray($needle, $haystack)
{ 
	for($i = 0; $i < sizeof($haystack); $i++ )
	{ 
		if( $haystack[$i] == $needle )
		{ 
			return true; 
		} 
	} 
	return false; 
}
//
// End functions
// -------------
include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_admin_pafiledb.' . $phpEx);
//
// Generate relevant output
//
if( isset($_GET['pane']) && $_GET['pane'] == 'left' )
{
	$jr_admin_userdata = jr_admin_get_user_info($userdata['user_id']);
	$module = jr_admin_get_module_list($jr_admin_userdata['user_jr_admin']);

	include('./page_header_admin.'.$phpEx);

	$template->set_filenames(array(
		"body" => "admin/index_navigate.tpl")
	);

	$template->assign_vars(array(
		"U_FORUM_INDEX" => append_sid("../index.$phpEx"),
		"U_ADMIN_INDEX" => append_sid("index.$phpEx?pane=right"),
		"U_PORTAL_INDEX" => append_sid("../portal.$phpEx"),
		"U_PORTAL_PREVIEW" => append_sid("../portal.$phpEx"),
                //+MOD: DHTML Menu for ACP 
                'COOKIE_NAME'   => $board_config['cookie_name'], 
                'COOKIE_PATH'   => $board_config['cookie_path'], 
                'COOKIE_DOMAIN'   => $board_config['cookie_domain'], 
                'COOKIE_SECURE'   => $board_config['cookie_secure'], 
                //-MOD: DHTML Menu for ACP
		"L_FORUM_INDEX" => $lang['Main_index'],
		"L_ADMIN_INDEX" => $lang['Admin_Index'], 
		"L_PREVIEW_FORUM" => $lang['Preview_forum'],
		"L_PREVIEW_PORTAL" => $lang['Preview_portal'])
	);

	jr_admin_make_left_pane();

	$template->pparse("body");

	include('./page_footer_admin.'.$phpEx);
}
elseif( isset($_GET['pane']) && $_GET['pane'] == 'right' )
{

	include('./page_header_admin.'.$phpEx);

	$template->set_filenames(array(
		"body" => "admin/index_body.tpl")
	);

	$template->assign_vars(array(
		"L_WELCOME" => $lang['Welcome_phpBB'],
		"L_ADMIN_INTRO" => $lang['Admin_intro'],
		"L_FORUM_STATS" => $lang['Forum_stats'],
		"L_WHO_IS_ONLINE" => $lang['Who_is_Online'],
		"L_USERNAME" => $lang['Username'],
		"L_LOCATION" => $lang['Location'],
		"L_LAST_UPDATE" => $lang['Last_updated'],
		"L_IP_ADDRESS" => $lang['IP_Address'],
		"L_STATISTIC" => $lang['Statistic'],
		"L_VALUE" => $lang['Value'],
		"L_NUMBER_POSTS" => $lang['Number_posts'],
		"L_POSTS_PER_DAY" => $lang['Posts_per_day'],
		"L_NUMBER_TOPICS" => $lang['Number_topics'],
		"L_TOPICS_PER_DAY" => $lang['Topics_per_day'],
		"L_NUMBER_USERS" => $lang['Number_users'],
		"L_USERS_PER_DAY" => $lang['Users_per_day'],
		"L_BOARD_STARTED" => $lang['Board_started'],
		"L_AVATAR_DIR_SIZE" => $lang['Avatar_dir_size'],
		"L_DB_SIZE" => $lang['Database_size'], 
		"L_FORUM_LOCATION" => $lang['Forum_Location'],
		"L_STARTED" => $lang['Login'],
		"L_GZIP_COMPRESSION" => $lang['Gzip_compression'])
	);
	//+MOD: DHTML Menu for ACP
$menu_cat_id = 0;
//+MOD: DHTML Menu for ACP
	//
	// Get forum statistics
	//
	$total_posts = get_db_stat('postcount');
	$total_users = get_db_stat('usercount');
	$total_topics = get_db_stat('topiccount');

	$start_date = create_date($board_config['default_dateformat'], $board_config['board_startdate'], $board_config['board_timezone']);

	$boarddays = ( time() - $board_config['board_startdate'] ) / 86400;

	$posts_per_day = sprintf("%.2f", $total_posts / $boarddays);
	$topics_per_day = sprintf("%.2f", $total_topics / $boarddays);
	$users_per_day = sprintf("%.2f", $total_users / $boarddays);

	$avatar_dir_size = 0;

	if ($avatar_dir = @opendir($phpbb_root_path . $board_config['avatar_path']))
	{
		while( $file = @readdir($avatar_dir) )
		{
			if( $file != "." && $file != ".." )
			{
				$avatar_dir_size += @filesize($phpbb_root_path . $board_config['avatar_path'] . "/" . $file);
			}
		}
		@closedir($avatar_dir);

		//
		// This bit of code translates the avatar directory size into human readable format
		// Borrowed the code from the PHP.net annoted manual, origanally written by:
		// Jesse (jesse@jess.on.ca)
		//
		if($avatar_dir_size >= 1048576)
		{
			$avatar_dir_size = round($avatar_dir_size / 1048576 * 100) / 100 . " MB";
		}
		else if($avatar_dir_size >= 1024)
		{
			$avatar_dir_size = round($avatar_dir_size / 1024 * 100) / 100 . " KB";
		}
		else
		{
			$avatar_dir_size = $avatar_dir_size . " Bytes";
		}

	}
	else
	{
		// Couldn't open Avatar dir.
		$avatar_dir_size = $lang['Not_available'];
	}

	if($posts_per_day > $total_posts)
	{
		$posts_per_day = $total_posts;
	}

	if($topics_per_day > $total_topics)
	{
		$topics_per_day = $total_topics;
	}

	if($users_per_day > $total_users)
	{
		$users_per_day = $total_users;
	}

	//
	// DB size ... MySQL only
	//
	// This code is heavily influenced by a similar routine
	// in phpMyAdmin 2.2.0
	//
	if( preg_match("/^mysql/", SQL_LAYER) )
	{
		$sql = "SELECT VERSION() AS mysql_version";
		if($result = $db->sql_query($sql))
		{
			$row = $db->sql_fetchrow($result);
			$version = $row['mysql_version'];

			if( preg_match("/^(3\.23|4\.|5\.)/", $version) )
			{
				$db_name = ( preg_match("/^(3\.23\.[6-9])|(3\.23\.[1-9][1-9])|(4\.)|(5\.)/", $version) ) ? "`$dbname`" : $dbname;

				$sql = "SHOW TABLE STATUS 
					FROM " . $db_name;
				if($result = $db->sql_query($sql))
				{
					$tabledata_ary = $db->sql_fetchrowset($result);

					$dbsize = 0;
					for($i = 0; $i < count($tabledata_ary); $i++)
					{
						if( $tabledata_ary[$i]['Type'] != "MRG_MyISAM" )
						{
							if( $table_prefix != "" )
							{
								if( strstr($tabledata_ary[$i]['Name'], $table_prefix) )
								{
									$dbsize += $tabledata_ary[$i]['Data_length'] + $tabledata_ary[$i]['Index_length'];
								}
							}
							else
							{
								$dbsize += $tabledata_ary[$i]['Data_length'] + $tabledata_ary[$i]['Index_length'];
							}
						}
					}
				} // Else we couldn't get the table status.
			}
			else
			{
				$dbsize = $lang['Not_available'];
			}
		}
		else
		{
			$dbsize = $lang['Not_available'];
		}
	}
	else if( preg_match("/^mssql/", SQL_LAYER) )
	{
		$sql = "SELECT ((SUM(size) * 8.0) * 1024.0) as dbsize 
			FROM sysfiles"; 
		if( $result = $db->sql_query($sql) )
		{
			$dbsize = ( $row = $db->sql_fetchrow($result) ) ? intval($row['dbsize']) : $lang['Not_available'];
		}
		else
		{
			$dbsize = $lang['Not_available'];
		}
	}
	else
	{
		$dbsize = $lang['Not_available'];
	}

	if ( is_integer($dbsize) )
	{
		if( $dbsize >= 1048576 )
		{
			$dbsize = sprintf("%.2f MB", ( $dbsize / 1048576 ));
		}
		else if( $dbsize >= 1024 )
		{
			$dbsize = sprintf("%.2f KB", ( $dbsize / 1024 ));
		}
		else
		{
			$dbsize = sprintf("%.2f Bytes", $dbsize);
		}
	}

	$template->assign_vars(array(
		"NUMBER_OF_POSTS" => $total_posts,
		"NUMBER_OF_TOPICS" => $total_topics,
		"NUMBER_OF_USERS" => $total_users,
		"START_DATE" => $start_date,
		"POSTS_PER_DAY" => $posts_per_day,
		"TOPICS_PER_DAY" => $topics_per_day,
		"USERS_PER_DAY" => $users_per_day,
		"AVATAR_DIR_SIZE" => $avatar_dir_size,
		"DB_SIZE" => $dbsize, 
		"GZIP_COMPRESSION" => ( $board_config['gzip_compress'] ) ? $lang['ON'] : $lang['OFF'])
	);
	//
	// End forum statistics
	//

	//
	// Get users online information.
	//
	$sql = "SELECT u.user_id, u.username, u.user_session_time, u.user_session_page, s.session_logged_in, s.session_ip, s.session_start 
		FROM " . USERS_TABLE . " u, " . SESSIONS_TABLE . " s
		WHERE s.session_logged_in = " . TRUE . " 
			AND u.user_id = s.session_user_id 
			AND u.user_id <> " . ANONYMOUS . " 
			AND s.session_time >= " . ( time() - 300 ) . " 
		ORDER BY u.user_session_time DESC";
	if(!$result = $db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, "Couldn't obtain regd user/online information.", "", __LINE__, __FILE__, $sql);
	}
	$onlinerow_reg = $db->sql_fetchrowset($result);

	$sql = "SELECT session_page, session_logged_in, session_time, session_ip, session_start   
		FROM " . SESSIONS_TABLE . "
		WHERE session_logged_in = 0
			AND session_time >= " . ( time() - 300 ) . "
		ORDER BY session_time DESC";
	if(!$result = $db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, "Couldn't obtain guest user/online information.", "", __LINE__, __FILE__, $sql);
	}
	$onlinerow_guest = $db->sql_fetchrowset($result);

	$sql = "SELECT forum_name, forum_id
		FROM " . FORUMS_TABLE;
	if($forums_result = $db->sql_query($sql))
	{
		while($forumsrow = $db->sql_fetchrow($forums_result))
		{
			$forum_data[$forumsrow['forum_id']] = $forumsrow['forum_name'];
		}
	}
	else
	{
		message_die(GENERAL_ERROR, "Couldn't obtain user/online forums information.", "", __LINE__, __FILE__, $sql);
	}

	$reg_userid_ary = array();

	if( count($onlinerow_reg) )
	{
		$registered_users = 0;

		for($i = 0; $i < count($onlinerow_reg); $i++)
		{
			if( !inarray($onlinerow_reg[$i]['user_id'], $reg_userid_ary) )
			{
				$reg_userid_ary[] = $onlinerow_reg[$i]['user_id'];

				$username = $onlinerow_reg[$i]['username'];

				if( $onlinerow_reg[$i]['user_allow_viewonline'] || $userdata['user_level'] == ADMIN )
				{
					$registered_users++;
					$hidden = FALSE;
				}
				else
				{
					$hidden_users++;
					$hidden = TRUE;
				}

				if( $onlinerow_reg[$i]['user_session_page'] < 1 )
				{
					switch($onlinerow_reg[$i]['user_session_page'])
					{
						case PAGE_INDEX:
							$location = $lang['Forum_index'];
							$location_url = "index.$phpEx?pane=right";
							break;
						case PAGE_POSTING:
							$location = $lang['Posting_message'];
							$location_url = "index.$phpEx?pane=right";
							break;
						case PAGE_LOGIN:
							$location = $lang['Logging_on'];
							$location_url = "index.$phpEx?pane=right";
							break;
						case PAGE_SEARCH:
							$location = $lang['Searching_forums'];
							$location_url = "index.$phpEx?pane=right";
							break;
						case PAGE_PROFILE:
							$location = $lang['Viewing_profile'];
							$location_url = "index.$phpEx?pane=right";
							break;
						case PAGE_VIEWONLINE:
							$location = $lang['Viewing_online'];
							$location_url = "index.$phpEx?pane=right";
							break;
						case PAGE_VIEWMEMBERS:
							$location = $lang['Viewing_member_list'];
							$location_url = "index.$phpEx?pane=right";
							break;
						case PAGE_PRIVMSGS:
							$location = $lang['Viewing_priv_msgs'];
							$location_url = "index.$phpEx?pane=right";
							break;
						case PAGE_FAQ:
							$location = $lang['Viewing_FAQ'];
							$location_url = "index.$phpEx?pane=right";
							break;
						case PAGE_KB:
							$location = $lang['Viewing_KB'];
							$location_url = "../kb.$phpEx";
							break;	
						case PAGE_RECENT:
							$location = $lang['Recent_topics'];
							$location_url = "../recent.$phpEx";
							break;	
						case PAGE_STAFF:
							$location = $lang['Staff'];
							$location_url = "../staff.$phpEx";
							break;	
						case PAGE_ALBUM:
							$location = "Album Index";
							$location_url = "album.$phpEx?pane=right";
							break;
						case PAGE_ALBUM_PERSONAL:
							$location = "Viewing Personal Album of a user";
							$location_url = "album_personal_index.$phpEx?pane=right";
							break;
						case PAGE_ALBUM_PICTURE:
							$location = "Viewing Pictures or Posting/Reading comments in the Album";
							$location_url = "album_showpage.$phpEx?pane=right";
							break;
						case PAGE_ALBUM_SEARCH:
							$location = "Searching the Album";
							$location_url = "album_search.$phpEx?pane=right";
							break;
						case PAGE_DOWNLOAD:
							$location = $lang['Viewing_Download'];
							$location_url = "../dload.$phpEx";
							break;	
						default:
							$location = $lang['Forum_index'];
							$location_url = "index.$phpEx?pane=right";
					}
				}
				else
				{
					$location_url = append_sid("admin_forums.$phpEx?mode=editforum&amp;" . POST_FORUM_URL . "=" . $onlinerow_reg[$i]['user_session_page']);
					$location = $forum_data[$onlinerow_reg[$i]['user_session_page']];
				}

				$row_color = ( $registered_users % 2 ) ? $theme['td_color1'] : $theme['td_color2'];
				$row_class = ( $registered_users % 2 ) ? $theme['td_class1'] : $theme['td_class2'];

				$reg_ip = decode_ip($onlinerow_reg[$i]['session_ip']);

				$template->assign_block_vars("reg_user_row", array(
					"ROW_COLOR" => "#" . $row_color,
					"ROW_CLASS" => $row_class,
					"USERNAME" => $username, 
					"STARTED" => create_date($board_config['default_dateformat'], $onlinerow_reg[$i]['session_start'], $board_config['board_timezone']), 
					"LASTUPDATE" => create_date($board_config['default_dateformat'], $onlinerow_reg[$i]['user_session_time'], $board_config['board_timezone']),
					"FORUM_LOCATION" => $location,
					"IP_ADDRESS" => $reg_ip, 

					"U_WHOIS_IP" => "http://network-tools.com/default.asp?host=$reg_ip", 
					"U_USER_PROFILE" => append_sid("admin_users.$phpEx?mode=edit&amp;" . POST_USERS_URL . "=" . $onlinerow_reg[$i]['user_id']),
					"U_FORUM_LOCATION" => append_sid($location_url))
				);
			}
		}

	}
	else
	{
		$template->assign_vars(array(
			"L_NO_REGISTERED_USERS_BROWSING" => $lang['No_users_browsing'])
		);
	}

	//
	// Guest users
	//
	if( count($onlinerow_guest) )
	{
		$guest_users = 0;

		for($i = 0; $i < count($onlinerow_guest); $i++)
		{
			$guest_userip_ary[] = $onlinerow_guest[$i]['session_ip'];
			$guest_users++;

			if( $onlinerow_guest[$i]['session_page'] < 1 )
			{
				switch( $onlinerow_guest[$i]['session_page'] )
				{
					case PAGE_INDEX:
						$location = $lang['Forum_index'];
						$location_url = "index.$phpEx?pane=right";
						break;
					case PAGE_POSTING:
						$location = $lang['Posting_message'];
						$location_url = "index.$phpEx?pane=right";
						break;
					case PAGE_LOGIN:
						$location = $lang['Logging_on'];
						$location_url = "index.$phpEx?pane=right";
						break;
					case PAGE_SEARCH:
						$location = $lang['Searching_forums'];
						$location_url = "index.$phpEx?pane=right";
						break;
					case PAGE_PROFILE:
						$location = $lang['Viewing_profile'];
						$location_url = "index.$phpEx?pane=right";
						break;
					case PAGE_VIEWONLINE:
						$location = $lang['Viewing_online'];
						$location_url = "index.$phpEx?pane=right";
						break;
					case PAGE_VIEWMEMBERS:
						$location = $lang['Viewing_member_list'];
						$location_url = "index.$phpEx?pane=right";
						break;
					case PAGE_PRIVMSGS:
						$location = $lang['Viewing_priv_msgs'];
						$location_url = "index.$phpEx?pane=right";
						break;
					case PAGE_FAQ:
						$location = $lang['Viewing_FAQ'];
						$location_url = "index.$phpEx?pane=right";
						break;
					case PAGE_KB:
						$location = $lang['Viewing_KB'];
						$location_url = "../kb.$phpEx";
						break;	
					case PAGE_RECENT:
						$location = $lang['Recent_topics'];
						$location_url = "../recent.$phpEx";
						break;	
					case PAGE_STAFF:
						$location = $lang['Staff'];
						$location_url = "../staff.$phpEx";
						break;	
					case PAGE_ALBUM:
						$location = $lang['Album'];
						$location_url = "index.$phpEx?pane=right";
						break;	
					case PAGE_DOWNLOAD:
						$location = $lang['Viewing_Download'];
						$location_url = "../dload.$phpEx";
						break;	
					default:
						$location = $lang['Forum_index'];
						$location_url = "index.$phpEx?pane=right";
				}
			}
			else
			{
				$location_url = append_sid("admin_forums.$phpEx?mode=editforum&amp;" . POST_FORUM_URL . "=" . $onlinerow_guest[$i]['session_page']);
				$location = $forum_data[$onlinerow_guest[$i]['session_page']];
			}

			$row_color = ( $guest_users % 2 ) ? $theme['td_color1'] : $theme['td_color2'];
			$row_class = ( $guest_users % 2 ) ? $theme['td_class1'] : $theme['td_class2'];

			$guest_ip = decode_ip($onlinerow_guest[$i]['session_ip']);

			$template->assign_block_vars("guest_user_row", array(
				"ROW_COLOR" => "#" . $row_color,
				"ROW_CLASS" => $row_class,
				"USERNAME" => $lang['Guest'],
				"STARTED" => create_date($board_config['default_dateformat'], $onlinerow_guest[$i]['session_start'], $board_config['board_timezone']), 
				"LASTUPDATE" => create_date($board_config['default_dateformat'], $onlinerow_guest[$i]['session_time'], $board_config['board_timezone']),
				"FORUM_LOCATION" => $location,
				"IP_ADDRESS" => $guest_ip, 

				"U_WHOIS_IP" => "http://network-tools.com/default.asp?host=$guest_ip", 
				"U_FORUM_LOCATION" => append_sid($location_url))
			);
		}

	}
	else
	{
		$template->assign_vars(array(
			"L_NO_GUESTS_BROWSING" => $lang['No_users_browsing'])
		);
	}

	if (defined('PCheck'))
	{
		$ffperms = '';
		#################################
		#CHMOD to 777
		#######
		if (!is_writable($phpbb_root_path . 'album_mod/upload')) $ffperms .= '<br /> /album_mod/upload >> ' . $lang['File_not_writable_777'];
		if (!is_writable($phpbb_root_path . 'album_mod/upload/cache')) $ffperms .= '<br /> /album_mod/upload/cache >> ' . $lang['File_not_writable_777'];
		if (!is_writable($phpbb_root_path . 'cache')) $ffperms .= '<br /> /cache >> ' . $lang['File_not_writable_777'];
		if (!is_writable($phpbb_root_path . 'files')) $ffperms .= '<br /> /files >> ' . $lang['File_not_writable_777'];
		if (!is_writable($phpbb_root_path . 'files/thumbs')) $ffperms .= '<br /> /files/thumbs >> ' . $lang['File_not_writable_777'];
		if (!is_writable($phpbb_root_path . 'images/avatars')) $ffperms .= '<br /> /images/avatars >> ' . $lang['File_not_writable_777'];
		if (!is_writable($phpbb_root_path . 'pafiledb/cache')) $ffperms .= '<br /> /pafiledb/cache >> ' . $lang['File_not_writable_777'];
		if (!is_writable($phpbb_root_path . 'pafiledb/cache/templates')) $ffperms .= '<br /> /pafiledb/cache/templates >> ' . $lang['File_not_writable_777'];
		if (!is_writable($phpbb_root_path . 'pafiledb/images/screenshots')) $ffperms .= '<br /> /pafiledb/images/screenshots >> ' . $lang['File_not_writable_777'];
		if (!is_writable($phpbb_root_path . 'pafiledb/uploads')) $ffperms .= '<br /> /pafiledb/uploads >> ' . $lang['File_not_writable_777'];
		#################################
		#CHMOD to 666
		#######
		if (!is_writable($phpbb_root_path . 'includes/def_icons.php')) $ffperms .= '<br /> /includes/def_icons.php >> ' . $lang['File_not_writable_666'];
		if (!is_writable($phpbb_root_path . 'includes/def_themes.php')) $ffperms .= '<br /> /includes/def_themes.php >> ' . $lang['File_not_writable_666'];
		if (!is_writable($phpbb_root_path . 'includes/def_tree.php')) $ffperms .= '<br /> /includes/def_tree.php >> ' . $lang['File_not_writable_666'];
		if (!is_writable($phpbb_root_path . 'includes/def_words.php')) $ffperms .= '<br /> /includes/def_words.php >> ' . $lang['File_not_writable_666'];
		if (!is_writable($phpbb_root_path . 'ctracker/logs/counter.txt')) $ffperms .= '<br /> /ctracker/logs/counter.txt >> ' . $lang['File_not_writable_666'];
		if (!is_writable($phpbb_root_path . 'ctracker/logs/logfile_flood.txt')) $ffperms .= '<br /> /ctracker/logs/logfile_flood.txt >> ' . $lang['File_not_writable_666'];
		if (!is_writable($phpbb_root_path . 'ctracker/logs/logfile_proxy.txt')) $ffperms .= '<br /> /ctracker/logs/logfile_proxy.txt >> ' . $lang['File_not_writable_666'];
		if (!is_writable($phpbb_root_path . 'ctracker/logs/logfile_worms.txt')) $ffperms .= '<br /> /ctracker/logs/logfile_worms.txt >> ' . $lang['File_not_writable_666'];
	}
	// Check for new version
	$current_version = explode('.', '2' . $board_config['version']);
	$minor_revision = (int) $current_version[2];

	$errno = 0;
	$errstr = $version_info = '';

	if ($fsock = @fsockopen('www.phpbb.com', 80, $errno, $errstr, 10))
	{
		@fputs($fsock, "GET /updatecheck/20x.txt HTTP/1.1\r\n");
		@fputs($fsock, "HOST: www.phpbb.com\r\n");
		@fputs($fsock, "Connection: close\r\n\r\n");

		$get_info = false;
		while (!@feof($fsock))
		{
			if ($get_info)
			{
				$version_info .= @fread($fsock, 1024);
			}
			else
			{
				if (@fgets($fsock, 1024) == "\r\n")
				{
					$get_info = true;
				}
			}
		}
		@fclose($fsock);

		$version_info = explode("\n", $version_info);
		$latest_head_revision = (int) $version_info[0];
		$latest_minor_revision = (int) $version_info[2];
		$latest_version = (int) $version_info[0] . '.' . (int) $version_info[1] . '.' . (int) $version_info[2];

		if ($latest_head_revision == 2 && $minor_revision == $latest_minor_revision)
		{
			$version_info = '<p style="color:green">' . $lang['Version_up_to_date'] . '</p>';
		}
		else
		{
			$version_info = '<p style="color:red">' . $lang['Version_not_up_to_date'];
			$version_info .= '<br />' . sprintf($lang['Latest_version_info'], $latest_version) . ' ' . sprintf($lang['Current_version_info'], '2' . $board_config['version']) . '</p>';
		}
	}
	else
	{
		if ($errstr)
		{
			$version_info = '<p style="color:red">' . sprintf($lang['Connect_socket_error'], $errstr) . '</p>';
		}
		else
		{
			$version_info = '<p>' . $lang['Socket_functions_disabled'] . '</p>';
		}
	}
	
	$version_info .= '<p>' . $lang['Mailing_list_subscribe_reminder'] . '</p>';
	
	if (defined('PCheck') && $ffperms)
		$version_info .= '<br /><hr><p><h4>' . $lang['Permission_Check'] . '</h4>' . $ffperms . '</p><hr><br /><p>';
		
	$template->assign_vars(array(
		'VERSION_INFO'	=> $version_info,
		'L_VERSION_INFORMATION'	=> $lang['Version_information'])
	);
	jr_admin_make_info_box();
	$template->pparse("body");

	include('./page_footer_admin.'.$phpEx);

}
else
{
	//
	// Generate frameset
	//
	$template->set_filenames(array(
		"body" => "admin/index_frameset.tpl")
	);

	$template->assign_vars(array(
		"S_FRAME_NAV" => append_sid("index.$phpEx?pane=left"),
		"S_FRAME_MAIN" => append_sid("index.$phpEx?pane=right"))
	);

	header ("Expires: " . gmdate("D, d M Y H:i:s", time()) . " GMT");
	header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");

	$template->pparse("body");

	$db->sql_close();
	exit;

}

?>
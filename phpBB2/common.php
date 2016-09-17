<?php
/***************************************************************************
 *                                common.php
 *                            -------------------
 *   begin                : Saturday, Feb 23, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: common.php,v 1.74.2.10 2003/06/04 17:41:39 acydburn Exp $
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

if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}
//-- mod : run stats -----------------------------------------------------------
//-- add
$starttime = microtime();
$trc_loc_start = $trc_loc_end = 0;
//-- fin mod : run stats -------------------------------------------------------

//
error_reporting  (E_ERROR | E_WARNING | E_PARSE); // This will NOT report uninitialized variables
set_magic_quotes_runtime(0); // Disable magic_quotes_runtime

// The following code (unsetting globals)
// Thanks to Matt Kavanagh and Stefan Esser for providing feedback as well as patch files

// PHP5 with register_long_arrays off?
if (@phpversion() >= '5.0.0' && (!@ini_get('register_long_arrays') || @ini_get('register_long_arrays') == '0' || strtolower(@ini_get('register_long_arrays')) == 'off'))
{
	$HTTP_POST_VARS = $_POST;
	$HTTP_GET_VARS = $_GET;
	$HTTP_SERVER_VARS = $_SERVER;
	$HTTP_COOKIE_VARS = $_COOKIE;
	$HTTP_ENV_VARS = $_ENV;
	$HTTP_POST_FILES = $_FILES;

	// _SESSION is the only superglobal which is conditionally set
	if (isset($_SESSION))
	{
		$HTTP_SESSION_VARS = $_SESSION;
	}
}

//
// CBACK.de CrackerTracker
// Worm&Exploit Protection Engine
//
include($phpbb_root_path . "ctracker/ct_security." . $phpEx);

// Protect against GLOBALS tricks
if (isset($HTTP_POST_VARS['GLOBALS']) || isset($HTTP_POST_FILES['GLOBALS']) || isset($HTTP_GET_VARS['GLOBALS']) || isset($HTTP_COOKIE_VARS['GLOBALS']))
{
	die("Hacking attempt");
}

// Protect against HTTP_SESSION_VARS tricks
if (isset($HTTP_SESSION_VARS) && !is_array($HTTP_SESSION_VARS))
{
	die("Hacking attempt");
}

if (@ini_get('register_globals') == '1' || strtolower(@ini_get('register_globals')) == 'on')
{
	// PHP4+ path
	$not_unset = array('HTTP_GET_VARS', 'HTTP_POST_VARS', 'HTTP_COOKIE_VARS', 'HTTP_SERVER_VARS', 'HTTP_SESSION_VARS', 'HTTP_ENV_VARS', 'HTTP_POST_FILES', 'phpEx', 'phpbb_root_path');
	// Not only will array_merge give a warning if a parameter
	// is not an array, it will actually fail. So we check if
	// HTTP_SESSION_VARS has been initialised.
	if (!isset($HTTP_SESSION_VARS) || !is_array($HTTP_SESSION_VARS))
	{
		$HTTP_SESSION_VARS = array();
	}

	// Merge all into one extremely huge array; unset
	// this later
	$input = array_merge($HTTP_GET_VARS, $HTTP_POST_VARS, $HTTP_COOKIE_VARS, $HTTP_SERVER_VARS, $HTTP_SESSION_VARS, $HTTP_ENV_VARS, $HTTP_POST_FILES);

	unset($input['input']);
	unset($input['not_unset']);

	while (list($var,) = @each($input))
	{
		if (in_array($var, $not_unset))
		{
			die('Hacking attempt!');
		}
		unset($$var);
	} 
   
	unset($input);
}

//
// addslashes to vars if magic_quotes_gpc is off
// this is a security precaution to prevent someone
// trying to break out of a SQL statement.
//
if( !get_magic_quotes_gpc() )
{
	if( is_array($_GET) )
	{
		while( list($k, $v) = each($_GET) )
		{
			if( is_array($_GET[$k]) )
			{
				while( list($k2, $v2) = each($_GET[$k]) )
				{
					$_GET[$k][$k2] = addslashes($v2);
				}
				@reset($_GET[$k]);
			}
			else
			{
				$_GET[$k] = addslashes($v);
			}
		}
		@reset($_GET);
	}

	if( is_array($_POST) )
	{
		while( list($k, $v) = each($_POST) )
		{
			if( is_array($_POST[$k]) )
			{
				while( list($k2, $v2) = each($_POST[$k]) )
				{
					$_POST[$k][$k2] = addslashes($v2);
				}
				@reset($_POST[$k]);
			}
			else
			{
				$_POST[$k] = addslashes($v);
			}
		}
		@reset($_POST);
	}

	if( is_array($HTTP_COOKIE_VARS) )
	{
		while( list($k, $v) = each($HTTP_COOKIE_VARS) )
		{
			if( is_array($HTTP_COOKIE_VARS[$k]) )
			{
				while( list($k2, $v2) = each($HTTP_COOKIE_VARS[$k]) )
				{
					$HTTP_COOKIE_VARS[$k][$k2] = addslashes($v2);
				}
				@reset($HTTP_COOKIE_VARS[$k]);
			}
			else
			{
				$HTTP_COOKIE_VARS[$k] = addslashes($v);
			}
		}
		@reset($HTTP_COOKIE_VARS);
	}
}

//
// Define some basic configuration arrays this also prevents
// malicious rewriting of language and otherarray values via
// URI params
//
$board_config = array();
$plus_config = array();
$userdata = array();
$theme = array();
$images = array();
$lang = array();
$nav_links = array();
$dss_seeded = false;
$gen_simple_header = FALSE;

include($phpbb_root_path . 'config.'.$phpEx);

if( !defined("PHPBB_INSTALLED") )
{
	header('Location: ' . $phpbb_root_path . 'install/install.' . $phpEx);
	exit;
}

include($phpbb_root_path . 'includes/constants.'.$phpEx);
include_once($phpbb_root_path . 'includes/template.'.$phpEx);
include($phpbb_root_path . 'includes/sessions.'.$phpEx);
include($phpbb_root_path . 'includes/auth.'.$phpEx);
include_once( $phpbb_root_path . './includes/functions_categories_hierarchy.' . $phpEx );
include($phpbb_root_path . 'includes/functions.'.$phpEx);
include($phpbb_root_path . 'includes/db.'.$phpEx);

// We do not need this any longer, unset for safety purposes
unset($dbpasswd);

//
// Obtain and encode users IP
//
// I'm removing HTTP_X_FORWARDED_FOR ... this may well cause other problems such as
// private range IP's appearing instead of the guilty routable IP, tough, don't
// even bother complaining ... go scream and shout at the idiots out there who feel
// "clever" is doing harm rather than good ... karma is a great thing ... :)
//
$client_ip = ( !empty($HTTP_SERVER_VARS['REMOTE_ADDR']) ) ? $HTTP_SERVER_VARS['REMOTE_ADDR'] : ( ( !empty($HTTP_ENV_VARS['REMOTE_ADDR']) ) ? $HTTP_ENV_VARS['REMOTE_ADDR'] : getenv('REMOTE_ADDR') );
$user_ip = encode_ip($client_ip);

// cache configs -----------------
$cache_dir = $phpbb_root_path . 'cache';
$cache_config = $cache_dir . '/config.'.$phpEx;
define('CCache', true);

if (@file_exists($cache_config) && defined('CCache'))
{ 
	include($cache_config); 
} 
// cache configs -----------------

//
// CBACK.de CrackerTracker
// Proxy&IP Blocker and Function File
//
include($phpbb_root_path . 'ctracker/ct_ipblocker.'.$phpEx);
include($phpbb_root_path . 'ctracker/ct_functions.'.$phpEx); 

//
// Setup forum wide options, if this fails
// then we output a CRITICAL_ERROR since
// basic forum information is not available
//
// cache configs -----------------
if (!$board_config['config_id'])
{
	// is /cache/ useable 
	$use_cache = (is_writable($cache_dir) && defined('CCache') && !defined('IN_ADMIN') ) ? true : false;

	// begin File 
	$write_string = "<?php \n if ( !defined('IN_PHPBB') ) \n { \n die('Hacking attempt'); \n } \n";

	// Boardconfig -----------------
	$sql = "SELECT *
		FROM " . CONFIG_TABLE;
	if( !($result = $db->sql_query($sql)) )
	{
		message_die(CRITICAL_ERROR, "Could not query config information", "", __LINE__, __FILE__, $sql);
	}

	if ($use_cache) {
		// cache
		$write_string .= '$board_config = array(';
		while ( $row = $db->sql_fetchrow($result) )
		{
			$write_string .= "'".$row['config_name']."'=> ".(( is_numeric($row['config_value']) ) ? $row['config_value'].",\n" : "'".addslashes($row['config_value'])."',\n");
		}
		$write_string .= "); \n \n";
	} else {
		// default
		while ( $row = $db->sql_fetchrow($result) )
		{
			$board_config[$row['config_name']] = $row['config_value'];
		}
	}
	// Boardconfig -----------------
	
	// PLUSconfig -----------------
	$sql = "SELECT *
		FROM " . PLUS_TABLE;
	if( !($result = $db->sql_query($sql)) )
	{
		message_die(CRITICAL_ERROR, "Could not query Plus-Config information", "", __LINE__, __FILE__, $sql);
	}
	
	if ($use_cache) {
		$write_string .= '$plus_config = array(';
		// cache
		while ( $row = $db->sql_fetchrow($result) )
		{
			$write_string .= "'".$row['config_name']."'=> ".(( is_numeric($row['config_value']) ) ? $row['config_value'].",\n" : "'".addslashes($row['config_value'])."',\n");
		}
		$write_string .= "); \n \n";
	} else {
		// default
		while ( $row = $db->sql_fetchrow($result) )
		{
			$plus_config[$row['config_name']] = $row['config_value'];
		}
	}
	// PLUSconfig -----------------
	
	// CBACK.de CrackerTracker 4.0 "PLUS-Edition"
	if ( defined('CTRACK') && !$ctracker_config['version']) {
		$sql = "SELECT *
			FROM " . CTRACK. " WHERE name NOT IN ('lastreg', 'lastreg_ip')";
		if( !($result = $db->sql_query($sql)) )
		{
			message_die(CRITICAL_ERROR, "Could not query CTracker-Config information", "", __LINE__, __FILE__, $sql);
		}
		
		if ($use_cache) {
		$write_string .= '$ctracker_config = array(';
			// cache
			while ( $row = $db->sql_fetchrow($result) )
			{
				$write_string .= "'".$row['name']."'=> ".(( is_numeric($row['value']) ) ? $row['value'].",\n" : "'".addslashes($row['value'])."',\n");
			}
		$write_string .= "); \n \n";
		} else {
			// default
			while ( $row = $db->sql_fetchrow($result) )
			{
				$ctracker_config[$row['name']] = $row['value'];
			}
		}
	}
	// CBACK.de CrackerTracker 4.0 "PLUS-Edition"

	$db->sql_freeresult($result);

	// end File 
	$write_string .= '?>';

	// write File 
	if ($use_cache) {
		if(@$f = fopen($cache_config, 'w')) 
		{ 
			fwrite($f, $write_string); 
			fclose($f); 
			@chmod($cache_config, 0666); 
		}
		include($cache_config); 
	}

	// \:cls 
	unset($write_string, $cache_config, $use_cache);
}
/*
else {
	$sql = "SELECT * FROM " . CONFIG_TABLE . " WHERE config_name 
			IN (xs_template_time, )";
	if( !($result = $db->sql_query($sql)) ) {
		message_die(CRITICAL_ERROR, "Could not query config information", "", __LINE__, __FILE__, $sql);
	}
	while ( $row = $db->sql_fetchrow($result) ) {
		$board_config[$row['config_name']] = $row['config_value'];
	}
	$db->sql_freeresult($result);
}
*/
// cache configs -----------------

include($phpbb_root_path . 'attach_mod/attachment_mod.'.$phpEx);

if (file_exists('install') || file_exists('contrib'))
{
	@unlink($phpbb_root_path . 'cache/config.'.$phpEx);
	message_die(GENERAL_MESSAGE, 'Please_remove_install_contrib');
}

//
// Show 'Board is disabled' message if needed.
//
if( $board_config['board_disable'] && !defined("IN_ADMIN") && !defined("IN_LOGIN") )
{
	if ( $board_config['board_disable_msg'] != "" )
	{
		message_die(GENERAL_MESSAGE, $board_config['board_disable_msg'], 'Information');
	}
	else
	{
		message_die(GENERAL_MESSAGE, 'Board_disable', 'Information');
	}
}

?>
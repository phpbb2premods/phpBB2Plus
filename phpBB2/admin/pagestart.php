<?php
/***************************************************************************
 *                               pagestart.php
 *                            -------------------
 *   begin                : Thursday, Aug 2, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: pagestart.php,v 1.1.2.7 2004/03/24 14:43:31 psotfx Exp $
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

if (!defined('IN_PHPBB'))
{
	die("Hacking attempt");
}

define('IN_ADMIN', true);
// Include files
include($phpbb_root_path . 'common.'.$phpEx);

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_INDEX);
init_userprefs($userdata);
//
// End session management
//
include_once($phpbb_root_path . 'includes/functions_jr_admin.' . $phpEx);
find_lang_file_nivisec('lang_jr_admin');

if (!$userdata['session_logged_in'])
{
	redirect(append_sid("login.$phpEx?redirect=admin/index.$phpEx", true));
}
elseif (!jr_admin_secure(basename($HTTP_SERVER_VARS['REQUEST_URI'])))
{
	message_die(GENERAL_ERROR, $lang['Error_Module_ID'], '', __LINE__, __FILE__);	
}
if (file_exists($phpbb_root_path . 'update'))
{
	message_die(GENERAL_MESSAGE, 'Please ensure update/ directory is deleted');
}

if ($_GET['sid'] != $userdata['session_id'])
{
	redirect("index.$phpEx?sid=" . $userdata['session_id']);
}
if (!$userdata['session_admin'])
{
	redirect(append_sid("login.$phpEx?redirect=admin/index.$phpEx&admin=1", true));
}
if (empty($no_page_header))
{
	// Not including the pageheader can be neccesarry if META tags are
	// needed in the calling script.
	include('./page_header_admin.'.$phpEx);
}

?>
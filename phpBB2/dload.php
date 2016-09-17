<?php
/***************************************************************************
 *                                dload.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: index.php,v 1.99.2.1 2002/12/19 17:17:40 psotfx Exp $
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
define('IN_DOWNLOAD', true);
$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_DOWNLOAD);
init_userprefs($userdata);
//
// End session management
//

//===================================================
// Include the common file
//===================================================

include($phpbb_root_path . 'pafiledb/pafiledb_common.'.$phpEx);

//===================================================
// Get action variable other wise set it to the main
//===================================================

$action = ( isset($_REQUEST['action']) ) ? htmlspecialchars($_REQUEST['action']) : 'main';

//===================================================
// if the database disabled give them a nice message
//===================================================

if(intval($pafiledb_config['settings_disable']))
{
	message_die(GENERAL_MESSAGE, $lang['pafiledb_disable']);        
}

//===================================================
// an array of all expected actions
//===================================================

$actions = array('download' => 'download',
				 'category' => 'category', 
				 'file' => 'file', 
				 'viewall' => 'viewall', 
				 'search' => 'search', 
				 'license' => 'license', 
				 'rate' => 'rate', 
				 'email' => 'email', 
				 'stats' => 'stats', 
				 'toplist' => 'toplist', 
				 'user_upload' => 'user_upload', 
				 'post_comment' => 'post_comment',
				 'mcp' => 'mcp',
				 'ucp' => 'ucp',
				 'main' => 'main');


//===================================================
// Lets Build the page
//===================================================

$action_mod = array();
$action_mod = explode('?',$action);

$pafiledb->module($actions[$action_mod[0]]);
$pafiledb->modules[$actions[$action_mod[0]]]->main($action_mod[1]);

?>

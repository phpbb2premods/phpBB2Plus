<?php
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
//
// Display Forum Index
//

$template->assign_vars(array(
	'U_INDEX' => append_sid('index.'.$phpEx),
	'L_INDEX' => sprintf($lang['Forum_Index'], $board_config['sitename']))
);

?>
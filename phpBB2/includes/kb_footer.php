<?php
/***************************************************************************
 *                              kb_footer.php
 *                            -------------------
 *   begin                : Monday, Mar 31, 2003
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: kb_footer.php,v 1.2 2004/01/04 15:56:56 jonohlsson Exp $
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

//
// Parse and show the overall footer.
//
$template->set_filenames(array(
	'kb_footer' => 'kb_footer.tpl')
);

$template->assign_vars(array(
	'L_MODULE_VERSION' => $kb_module_version,
	'L_MODULE_ORIG_AUTHOR' => $kb_module_orig_author,
	'L_MODULE_AUTHOR' => $kb_module_author)
);

$template->pparse('kb_footer');

?>
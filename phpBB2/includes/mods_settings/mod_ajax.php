<?php

/***************************************************************************
 *                            mod_calendar.php
 *                            ------------------------
 *	begin			: 10/08/2003
 *	copyright		: Ptirhiik
 *	email			: admin@rpgnet-fr.com
 *	version			: 1.0.1 - 14/09/2003
 *
 *	mod version		: calendar v 1.0.0
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

// service functions
include_once( $phpbb_root_path . 'includes/functions_mods_settings.' . $phpEx );

// mod definition
$mod_name = 'AJAX_features';
$config_fields = array(


	'use_ajax_preview' => array(
		'lang_key'	=> 'AJAX_use_preview',
		'type'		=> 'LIST_RADIO',
		'default'	=> 'Yes',
		'user'		=> 'user_use_ajax_preview',
		'values'	=> $list_yes_no,
		),

	'use_ajax_edit' => array(
		'lang_key'	=> 'AJAX_use_edit',
		'type'		=> 'LIST_RADIO',
		'default'	=> 'Yes',
		'user'		=> 'user_use_ajax_edit',
		'values'	=> $list_yes_no,
		),

);

// init config table
init_board_config($mod_name, $config_fields);

?>
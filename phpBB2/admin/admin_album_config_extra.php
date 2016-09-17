<?php

if (!defined('IN_PHPBB'))
{
	die('Hacking attempt');
} 

$album_config_tabs[] =  array(
							'order'				=> 5,
							'selection'			=> 'extra',
							'title'				=> $lang['Extra_Settings'],
							'detail'			=> '',
							'sub_config' 		=> array(
														/*
														0 => array(
																	'order'		=> 0,
																	'selection' => 'dummy test',
																	'title'		=> 'bla bla',
																	'detail'	=> ''
																	)
														*/
														),
							'config_table_name'	=> ALBUM_CONFIG_TABLE,							
							'generate_function'	=> 'album_generate_config_extra_box',
							'template_file'		=> 'admin/album_config_extra_body.tpl'			
							);

function album_generate_config_extra_box($config_data)
{
	global $template, $lang, $new;

	$template->assign_vars(array(
			
		'RATE_ENABLED' => ($new['rate'] == 1) ? 'checked="checked"' : '',
		'RATE_DISABLED' => ($new['rate'] == 0) ? 'checked="checked"' : '',
	
		'RATE_SCALE' => $new['rate_scale'],
	
		'COMMENT_ENABLED' => ($new['comment'] == 1) ? 'checked="checked"' : '',
		'COMMENT_DISABLED' => ($new['comment'] == 0) ? 'checked="checked"' : '',		
			
		//--- Language Setup		
			
		'L_RATE_SYSTEM' => $lang['Rate_system'],
		'L_RATE_SCALE' => $lang['Rate_Scale'],
		'L_COMMENT_SYSTEM' => $lang['Comment_system'],
	
		'L_DISABLED' => $lang['Disabled'],
		'L_ENABLED' => $lang['Enabled'],
		'L_YES' => $lang['Yes'],
		'L_NO' => $lang['No'])
	);
}
?>
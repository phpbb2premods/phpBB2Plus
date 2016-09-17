<?php

if (!defined('IN_PHPBB'))
{
	die('Hacking attempt');
} 

$album_config_tabs[] =  array(
							'order'				=> 3,
							'selection'			=> 'upload',
							'title'				=> $lang['Upload_Settings'],
							'detail'			=> '',
							'sub_config' 		=> array(
														/*
														0 => array(
																	'order'		=> 0,
																	'selection' => '',
																	'title'		=> '',
																	'detail'	=> ''
																   )
														*/
														),
							'config_table_name'	=> ALBUM_CONFIG_TABLE,							
							'generate_function'	=> 'album_generate_config_upload_box',
							'template_file'		=> 'admin/album_config_upload_body.tpl'							
							);


function album_generate_config_upload_box($config_data)
{
	global $template, $lang, $new;

	$template->assign_vars(array(
			
		'MAX_PICS' => $new['max_pics'],
		'MAX_FILE_SIZE' => $new['max_file_size'],
		'MAX_WIDTH' => $new['max_width'],
		'MAX_HEIGHT' => $new['max_height'],
	
		'USER_PICS_LIMIT' => $new['user_pics_limit'],
		'MOD_PICS_LIMIT' => $new['mod_pics_limit'],
	
		'THUMBNAIL_CACHE_ENABLED' => ($new['thumbnail_cache'] == 1) ? 'checked="checked"' : '',
		'THUMBNAIL_CACHE_DISABLED' => ($new['thumbnail_cache'] == 0) ? 'checked="checked"' : '',
	
		'JPG_ENABLED' => ($new['jpg_allowed'] == 1) ? 'checked="checked"' : '',
		'JPG_DISABLED' => ($new['jpg_allowed'] == 0) ? 'checked="checked"' : '',
	
		'PNG_ENABLED' => ($new['png_allowed'] == 1) ? 'checked="checked"' : '',
		'PNG_DISABLED' => ($new['png_allowed'] == 0) ? 'checked="checked"' : '',
	
		'GIF_ENABLED' => ($new['gif_allowed'] == 1) ? 'checked="checked"' : '',
		'GIF_DISABLED' => ($new['gif_allowed'] == 0) ? 'checked="checked"' : '',
	
		'PIC_DESC_MAX_LENGTH' => $new['desc_length'],
	
		'NO_GD' => ($new['gd_version'] == 0) ? 'checked="checked"' : '',
		'GD_V1' => ($new['gd_version'] == 1) ? 'checked="checked"' : '',
		'GD_V2' => ($new['gd_version'] == 2) ? 'checked="checked"' : '',
		
		//--- Language Setup
	
		'L_MAX_PICS' => $lang['Max_pics'],
		'L_MAX_FILE_SIZE' => $lang['Max_file_size'],
		'L_MAX_WIDTH' => $lang['Max_width'],
		'L_MAX_HEIGHT' => $lang['Max_height'],
		'L_USER_PICS_LIMIT' => $lang['User_pics_limit'],
		'L_MOD_PICS_LIMIT' => $lang['Moderator_pics_limit'],
		'L_MANUAL_THUMBNAIL' => $lang['Manual_thumbnail'],
		'L_JPG_ALLOWED' => $lang['JPG_allowed'],
		'L_PNG_ALLOWED' => $lang['PNG_allowed'],
		'L_GIF_ALLOWED' => $lang['GIF_allowed'],
		'L_PIC_DESC_MAX_LENGTH' => $lang['Pic_Desc_Max_Length'],
		'L_HOTLINK_PREVENT' => $lang['Hotlink_prevent'],
		'L_HOTLINK_ALLOWED' => $lang['Hotlink_allowed'],
		'L_GD_VERSION' => $lang['GD_version'],
	
		'L_DISABLED' => $lang['Disabled'],
		'L_ENABLED' => $lang['Enabled'],
		'L_YES' => $lang['Yes'],
		'L_NO' => $lang['No'])
	);
}
?>
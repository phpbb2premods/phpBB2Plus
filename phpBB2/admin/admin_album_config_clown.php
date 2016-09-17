<?php
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
	die('Hacking attempt');
} 
require($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_clown_album.' . $phpEx);

if (!defined('ALBUM_SP_CONFIG_TABLE')) 
{
	$album_config_tabs[] =  array();
}
else
{

	$album_config_tabs[] =  array(
							'order'				=> 6,
							'selection'			=> 'clown',
							'title'				=> 'CLowN SP', //$lang['Extra_Settings'],
							'detail'			=> $lang['Album_clown_config_explain'],
							'sub_config' 		=> array(
														0 => array(
																	'order'			=> 0,
																	'selection' 	=> 'general',
																	'title'			=> $lang['Album_sp_general'],
																	'detail'		=> '',
																	'template_file'	=> 'admin/album_config_clown_general_body.tpl'
																	),
														1 => array(
																	'order'			=> 2,
																	'selection' 	=> 'hotornot',
																	'title'			=> $lang['Album_sp_hotornot'],
																	'detail'		=> '',
																	'template_file'	=> 'admin/album_config_clown_hotnot_body.tpl'
																	),
														2 => array(
																	'order'			=> 1,
																	'selection' 	=> 'watermark',
																	'title'			=> $lang['Album_sp_watermark'],
																	'detail'		=> '',
																	'template_file'	=> 'admin/album_config_clown_watermark_body.tpl'
																	)
														),
							'config_table_name'	=> ALBUM_SP_CONFIG_TABLE,
							'generate_function'	=> 'album_generate_config_clown_box',
							'template_file'		=> 'admin/album_config_sub_body.tpl'
							);
}

function album_generate_config_clown_box($config_data)
{
	global $template, $lang, $phpEx, $new;
		
	$selected_subtab = get_selected_tab_from_config($config_data);

	$template->assign_vars(array(
		
		//cat names
		'L_ALBUM_SP_GENERAL' => "Genaral Config",
		'L_ALBUM_SP_WATERMARK' => "WaterMark Config",
		'L_ALBUM_SP_HOTORNOT' => "Hot or Not Config",
		
		//config blocks
		
		//--------------------
		//General Config Section
		//--------------------
		//rate type
		'L_RATE_TYPE' => $lang['Rate_type'],
		'L_RATE_TYPE_0' => $lang['Rate_type_0'],
		'RATE_TYPE_0' => ($new['rate_type'] == 0) ? 'selected="selected"' : '',
		'L_RATE_TYPE_1' => $lang['Rate_type_1'],
		'RATE_TYPE_1' => ($new['rate_type'] == 1) ? 'selected="selected"' : '',
		'L_RATE_TYPE_2' => $lang['Rate_type_2'],
		'RATE_TYPE_2' => ($new['rate_type'] == 2) ? 'selected="selected"' : '',
		
		//display latest
		'L_DISPLAY_LATEST' => $lang['Display_latest'],
		'DISPLAY_LATEST_ENABLED' => ($new['disp_late'] == 1) ? 'checked="checked"' : '',
		'DISPLAY_LATEST_DISABLED' => ($new['disp_late'] == 0) ? 'checked="checked"' : '',
		
		//display highest
		'L_DISPLAY_HIGHEST' => $lang['Display_highest'],
		'DISPLAY_HIGHEST_ENABLED' => ($new['disp_high'] == 1) ? 'checked="checked"' : '',
		'DISPLAY_HIGHEST_DISABLED' => ($new['disp_high'] == 0) ? 'checked="checked"' : '',
		
		//display random
		'L_DISPLAY_RANDOM' => $lang['Display_random'],
		'DISPLAY_RANDOM_ENABLED' => ($new['disp_rand'] == 1) ? 'checked="checked"' : '',
		'DISPLAY_RANDOM_DISABLED' => ($new['disp_rand'] == 0) ? 'checked="checked"' : '',
		
		//how many pics
		'L_PIC_ROW' => $lang['Pic_row'],
		'L_PIC_COL' => $lang['Pic_col'],
		'PIC_ROW' => $new['img_rows'],
		'PIC_COL' => $new['img_cols'],
		
		//mid thumbnail
		'L_MIDTHUMB_USE' => $lang['Midthumb_use'],
		'MIDTHUMB_ENABLED' => ($new['midthumb_use'] == 1) ? 'checked="checked"' : '',
		'MIDTHUMB_DISABLED' => ($new['midthumb_use'] == 0) ? 'checked="checked"' : '',
		
		//mid thumbnail cache
		'L_MIDTHUMB_CACHE' => $lang['Midthumb_cache'],
		'MIDTHUMB_CACHE_ENABLED' => ($new['midthumb_cache'] == 1) ? 'checked="checked"' : '',
		'MIDTHUMB_CACHE_DISABLED' => ($new['midthumb_cache'] == 0) ? 'checked="checked"' : '',
		
		//wut size fo midthumbnail
		'L_MIDTHUMB_HEIGHT' => $lang['Midthumb_high'],
		'MIDTHUMB_HEIGHT' => $new['midthumb_height'],
		'L_MIDTHUMB_WIDTH' => $lang['Midthumb_width'],
		'MIDTHUMB_WIDTH' => $new['midthumb_width'],
		
	
		//--------------------
		//WaterMark Section
		//--------------------
		//watermark
		'L_WATERMARK' => $lang['Watermark'],
		'WATERMARK_ENABLED' => ($new['use_watermark'] == 1) ? 'checked="checked"' : '',
		'WATERMARK_DISABLED' => ($new['use_watermark'] == 0) ? 'checked="checked"' : '',
	
	
		//fo wut users
		'L_WATERMARK_USERS' => $lang['Watermark_users'],
		'WATERMARK_USERS_ENABLED' => ($new['wut_users'] == 1) ? 'checked="checked"' : '',
		'WATERMARK_USERS_DISABLED' => ($new['wut_users'] == 0) ? 'checked="checked"' : '',
		
		//watermark placement
		'L_WATERMARK_PLACENT' => $lang['Watermark_placent'],
		'WATERMAR_PLACEMENT_0' => ($new['disp_watermark_at'] == 0) ? 'checked="checked"' : '',
		'WATERMAR_PLACEMENT_1' => ($new['disp_watermark_at'] == 1) ? 'checked="checked"' : '',
		'WATERMAR_PLACEMENT_2' => ($new['disp_watermark_at'] == 2) ? 'checked="checked"' : '',
		'WATERMAR_PLACEMENT_3' => ($new['disp_watermark_at'] == 3) ? 'checked="checked"' : '',
		'WATERMAR_PLACEMENT_4' => ($new['disp_watermark_at'] == 4) ? 'checked="checked"' : '',
		'WATERMAR_PLACEMENT_5' => ($new['disp_watermark_at'] == 5) ? 'checked="checked"' : '',
		'WATERMAR_PLACEMENT_6' => ($new['disp_watermark_at'] == 6) ? 'checked="checked"' : '',
		'WATERMAR_PLACEMENT_7' => ($new['disp_watermark_at'] == 7) ? 'checked="checked"' : '',
		'WATERMAR_PLACEMENT_8' => ($new['disp_watermark_at'] == 8) ? 'checked="checked"' : '',
		
		//--------------------
		//Hot or Not Config Section
		//--------------------
		//already rated?
		'L_HON_ALREDY_RATED' => $lang['Hon_already_rated'],
		'HON_ALREADY_RATED_ENABLED' => ($new['hon_rate_times'] == 1) ? 'checked="checked"' : '',
		'HON_ALREADY_RATED_DISABLED' => ($new['hon_rate_times'] == 0) ? 'checked="checked"' : '',
		
		//use sep table for hon rating?
		'L_HON_SEP_RATING' => $lang['Hon_sep_rating'],
		'HON_SEP_RATING_ENABLED' => ($new['hon_rate_sep'] == 1) ? 'checked="checked"' : '',
		'HON_SEP_RATING_DISABLED' => ($new['hon_rate_sep'] == 0) ? 'checked="checked"' : '',
		
		//take pics from
		'L_HON_WHERE' => $lang['Hon_where'],
		'HON_WHERE' => $new['hon_rate_where'],
		
		//if user anon
		'L_HON_USERS' => $lang['Hon_users'],
		'HON_USERS_ENABLED' => ($new['hon_rate_users'] == 1) ? 'checked="checked"' : '',
		'HON_USERS_DISABLED' => ($new['hon_rate_users'] == 0) ? 'checked="checked"' : '',
		
		
		'L_DISABLED' => $lang['Disabled'],
		'L_ENABLED' => $lang['Enabled'],
		'L_YES' => $lang['Yes'],
		'L_NO' => $lang['No'],
		'L_SUBMIT' => $lang['Submit'],
		'L_RESET' => $lang['Reset'])
	);
}

?>
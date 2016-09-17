<?php

if (!defined('IN_PHPBB'))
{
	die('Hacking attempt');
} 

$album_config_tabs[] =  array(
							'order'				=> 0,
							'selection'			=> 'config',
							'title'				=> $lang['Album_config'],
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
							'generate_function'	=> 'album_generate_config_settings_box',
							'template_file'		=> 'admin/album_config_settings_body.tpl'
							);

function album_generate_config_settings_box($config_data)
{
	global $template, $lang, $new;
	
	$template->assign_vars(array(		
		'MAX_PICS' => $new['max_pics'],
	
		'ROWS_PER_PAGE' => $new['rows_per_page'],
		'COLS_PER_PAGE' => $new['cols_per_page'],
	
		'USER_PICS_LIMIT' => $new['user_pics_limit'],
		'MOD_PICS_LIMIT' => $new['mod_pics_limit'],
	
		//--- Album Category Hierarchy : begin
	    //--- version : <= 1.1.0	
	    'ALBUM_CATEGORY_SORTING_ID' => ($new['album_category_sorting'] == 'cat_id') ? 'checked="checked"' : '',
	    'ALBUM_CATEGORY_SORTING_NAME' => ($new['album_category_sorting'] == 'cat_title') ? 'checked="checked"' : '',
	    'ALBUM_CATEGORY_SORTING_ORDER' => ($new['album_category_sorting'] == 'cat_order') ? 'checked="checked"' : '',
	
	    'ALBUM_CATEGORY_SORTING_ASC' => ($new['album_category_sorting_direction'] == 'ASC') ? 'checked="checked"' : '',
	    'ALBUM_CATEGORY_SORTING_DESC' => ($new['album_category_sorting_direction'] == 'DESC') ? 'checked="checked"' : '',
	
		'SHOW_RECENT_IN_SUBCATS_ENABLED' => ($new['show_recent_in_subcats'] == 1) ? 'checked="checked"' : '',
		'SHOW_RECENT_IN_SUBCATS_DISABLED' => ($new['show_recent_in_subcats'] == 0) ? 'checked="checked"' : '',
		'SHOW_RECENT_INSTEAD_OF_NOPICS_ENABLED' => ($new['show_recent_instead_of_nopics'] == 1) ? 'checked="checked"' : '',
		'SHOW_RECENT_INSTEAD_OF_NOPICS_DISABLED' => ($new['show_recent_instead_of_nopics'] == 0) ? 'checked="checked"' : '',	
		
	    //--- version : 1.2.0
	    'ALBUM_DEBUG_MODE_ENABLED' => ($new['album_debug_mode'] == 1) ? 'checked="checked"' : '',
		'ALBUM_DEBUG_MODE_DISABLED' => ($new['album_debug_mode'] == 0) ? 'checked="checked"' : '',
	 	//--- Album Category Hierarchy : end
	
		'HOTLINK_PREVENT_ENABLED' => ($new['hotlink_prevent'] == 1) ? 'checked="checked"' : '',
		'HOTLINK_PREVENT_DISABLED' => ($new['hotlink_prevent'] == 0) ? 'checked="checked"' : '',
	
		'HOTLINK_ALLOWED' => $new['hotlink_allowed'],
		
		//--- Language Setup
	
		'L_MAX_PICS' => $lang['Max_pics'],
		'L_USER_PICS_LIMIT' => $lang['User_pics_limit'],
		'L_MOD_PICS_LIMIT' => $lang['Moderator_pics_limit'],
		'L_MANUAL_THUMBNAIL' => $lang['Manual_thumbnail'],
		'L_HOTLINK_PREVENT' => $lang['Hotlink_prevent'],
		'L_HOTLINK_ALLOWED' => $lang['Hotlink_allowed'],
	
		//--- Album Category Hierarchy : begin	
	    'L_ALBUM_CATEGORY_SORTING' => $lang['Album_Category_Sorting'],
	    'L_ALBUM_CATEGORY_SORTING_ID' => $lang['Album_Category_Sorting_Id'],
	    'L_ALBUM_CATEGORY_SORTING_NAME' => $lang['Album_Category_Sorting_Name'],
	    'L_ALBUM_CATEGORY_SORTING_ORDER' => $lang['Album_Category_Sorting_Order'],
	
	    'L_ALBUM_CATEGORY_DIRECTION' => $lang['Album_Category_Sorting_Direction'],
	    'L_ALBUM_CATEGORY_SORTING_ASC' => $lang['Album_Category_Sorting_Asc'],
	    'L_ALBUM_CATEGORY_SORTING_DESC' => $lang['Album_Category_Sorting_Desc'],
		
		'L_SHOW_RECENT_IN_SUBCATS' => $lang['Show_Recent_In_Subcats'],
		'L_SHOW_RECENT_INSTEAD_OF_NOPICS' => $lang['Show_Recent_Instead_of_NoPics'],	
	
		//--- version : 1.2.0
		'L_ALBUM_DEBUG_MODE' => $lang['Album_debug_mode'],
		//--- Album Category Hierarchy : end
	
		'L_DISABLED' => $lang['Disabled'],
		'L_ENABLED' => $lang['Enabled'],
		'L_YES' => $lang['Yes'],
		'L_NO' => $lang['No'])
	);
}
?>
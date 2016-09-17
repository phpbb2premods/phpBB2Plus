<?php

if (!defined('IN_PHPBB'))
{
	die('Hacking attempt');
} 

$album_config_tabs[] =  array(
							'order'				=> 4,
							'selection'			=> 'thumb',
							'title'				=> $lang['Thumbnail_Settings'],
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
							'generate_function'	=> 'album_generate_config_thumb_box',
							'template_file'		=> 'admin/album_config_thumb_body.tpl'
							);

function album_generate_config_thumb_box($config_data)
{
	global $template, $lang, $new;

	$template->assign_vars(array(
	
		'ROWS_PER_PAGE' => $new['rows_per_page'],
		'COLS_PER_PAGE' => $new['cols_per_page'],
		
		'THUMBNAIL_QUALITY' => $new['thumbnail_quality'],
		'THUMBNAIL_SIZE' => $new['thumbnail_size'],
		'THUMBNAIL_CACHE_ENABLED' => ($new['thumbnail_cache'] == 1) ? 'checked="checked"' : '',
		'THUMBNAIL_CACHE_DISABLED' => ($new['thumbnail_cache'] == 0) ? 'checked="checked"' : '',
	
		'SORT_TIME' => ($new['sort_method'] == 'pic_time') ? 'selected="selected"' : '',
		'SORT_PIC_TITLE' => ($new['sort_method'] == 'pic_title') ? 'selected="selected"' : '',
		'SORT_USERNAME' => ($new['sort_method'] == 'pic_user_id') ? 'selected="selected"' : '',
		'SORT_VIEW' => ($new['sort_method'] == 'pic_view_count') ? 'selected="selected"' : '',
		'SORT_RATING' => ($new['sort_method'] == 'rating') ? 'selected="selected"' : '',
		'SORT_COMMENTS' => ($new['sort_method'] == 'comments') ? 'selected="selected"' : '',
		'SORT_NEW_COMMENT' => ($new['sort_method'] == 'new_comment') ? 'selected="selected"' : '',
	
		'SORT_ASC' => ($new['sort_order'] == 'ASC') ? 'selected="selected"' : '',
		'SORT_DESC' => ($new['sort_order'] == 'DESC') ? 'selected="selected"' : '',
	
		'FULLPIC_POPUP_ENABLED' => ($new['fullpic_popup'] == 1) ? 'checked="checked"' : '',
		'FULLPIC_POPUP_DISABLED' => ($new['fullpic_popup'] == 0) ? 'checked="checked"' : '',
		
		//--- Language setup ---
	
		'L_ROWS_PER_PAGE' => $lang['Rows_per_page'],
		'L_COLS_PER_PAGE' => $lang['Cols_per_page'],	
			
		'L_THUMBNAIL_QUALITY' => $lang['Thumbnail_quality'],
		'L_THUMBNAIL_SIZE' => $lang['Thumbnail_size'],
		'L_THUMBNAIL_CACHE' => $lang['Thumbnail_cache'],
	
		'L_DEFAULT_SORT_METHOD' => $lang['Default_Sort_Method'],
		'L_TIME' => $lang['Time'],
		'L_PIC_TITLE' => $lang['Pic_Title'],
		'L_USERNAME' => $lang['Sort_Username'],
		'L_VIEW' => $lang['View'],
		'L_RATING' => $lang['Rating'],
		'L_COMMENTS' => $lang['Comments'],
		'L_NEW_COMMENT' => $lang['New_Comment'],
		'L_DEFAULT_SORT_ORDER' => $lang['Default_Sort_Order'],
		'L_ASC' => $lang['Sort_Ascending'],
		'L_DESC' => $lang['Sort_Descending'],
		'L_FULLPIC_POPUP' => $lang['Fullpic_Popup'],
		
		'L_DISABLED' => $lang['Disabled'],
		'L_ENABLED' => $lang['Enabled'],
		'L_YES' => $lang['Yes'],
		'L_NO' => $lang['No'])
	);
}
?>
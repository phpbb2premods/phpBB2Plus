<?php
/***************************************************************************
 *                              page_tail.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: page_tail.php,v 1.27.2.2 2002/11/26 11:42:12 psotfx Exp $
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
	die('Hacking attempt');
}
// Start add - Complete banner MOD
if ($banner_show_list)
{
	$banner_show_list['0'] = ($banner_show_list) ? ' ':'';
	$sql = "UPDATE ".BANNERS_TABLE." SET banner_view=banner_view+1 where banner_id IN ($banner_show_list)"; 
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, "Couldn't update banners data", "", __LINE__, __FILE__, $sql);
	} 
}
// End add - Complete banner MOD

global $do_gzip_compress;

//
// CBACK.de CrackerTracker
//
include($phpbb_root_path . 'ctracker/ct_footer.'.$phpEx);

//
// Show the overall footer.
//
if ($userdata['session_logged_in'])
{
	include_once($phpbb_root_path . 'includes/functions_jr_admin.' . $phpEx);
	$admin_link = jr_admin_make_admin_link();
} else {
	$admin_link = '';
}

$template->set_filenames(array(
	'overall_footer' => ( empty($gen_simple_header) ) ? 'overall_footer.tpl' : 'simple_footer.tpl')
);

$template->assign_vars(array(
	'TRANSLATION_INFO' => (isset($lang['TRANSLATION_INFO'])) ? $lang['TRANSLATION_INFO'] : ((isset($lang['TRANSLATION'])) ? $lang['TRANSLATION'] : ''),
	'L_CREDITS' => $lang['Credits'],
	'U_CREDITS' => append_sid("hacks_list.$phpEx"), 
	'ADMIN_LINK' => $admin_link)
);

// Begin speaking links ShortURL
if ($plus_config['enable_shorturls'] == 1 && !defined('AJAX_HEADERS'))
{
	$cache_seo = $phpbb_root_path . 'cache/c_seolist.'.$phpEx;

	if (@!file_exists($cache_seo))
	{

		if (is_writable($phpbb_root_path . '/cache')) {
		
			$write_string = '<?php'."\n".'if ( !defined(\'IN_PHPBB\') )'."\n".'{'."\n".'	die(\'Hacking attempt\');'."\n".'}'."\n\n".'$seo_list_in = array( ';
			$write_string_b = "\n".'$seo_list_out = array( ';

			// cache Forums (read)
			$sql = "SELECT forum_id, forum_name FROM  " . FORUMS_TABLE;
			if( !$result = $db->sql_query($sql) )
			{
			  message_die(CRITICAL_ERROR, "Could not query Forum information", "", __LINE__, __FILE__, $sql);
			}

			// cache Forums
			while ( $row = $db->sql_fetchrow($result) )
			{
				$search = array( 'Ö',  'Ä',  'Ü',  'ö',  'ä',  'à', 'é', 'è', 'ü', '$','\\','/', '---');
				$replace = array( 'oe', 'ae', 'ue', 'oe', 'ae', 'a', 'e', 'e', 'ue', '-', '-', '-', '-');
				$name = eregi_replace (",|:|'|´|`|\"|\/|-|( )+|#|_", "-", $row['forum_name']);
				$name = eregi_replace ("&amp", "-and-", $name);
				$name = eregi_replace ("!|\?", "", $name);
				$name = eregi_replace ("&", "-and-", $name);
				$name = eregi_replace ("\(|\)|;", "", $name);
				$name = eregi_replace ("\[|\]", "", $name);
				$name = eregi_replace ("(-)+", "-", $name);
				$name = str_replace ($search, $replace, $name);
				$name = strtolower ( $name );

				$write_string .= '\'|"(?:./)?viewforum.php\?f='.$row['forum_id'].'&(?:amp;)topicdays=([0-9]*)&(?:amp;)start=([0-9]*)"|\','."\n".'\'|"(?:./)?viewforum.php\?f='.$row['forum_id'].'"|\','."\n";
				$write_string_b .= '\'"viewforum'. $row['forum_id'] . '-\\1-\\2,'. $name . '.html"\','."\n".'\'"forum'. $row['forum_id'] . ','. $name . '.html"\','."\n";
			}
			//-----------------------------------------------

			// cache Categories (read)
			$sql = "SELECT cat_id, cat_title FROM  " . CATEGORIES_TABLE;
			if( !$result = $db->sql_query($sql) )
			{
			  message_die(CRITICAL_ERROR, "Could not query Categorie information", "", __LINE__, __FILE__, $sql);
			}

			// cache Categories
			while ( $row = $db->sql_fetchrow($result) )
			{
				$search = array( 'Ö',  'Ä',  'Ü',  'ö',  'ä',  'à', 'é', 'è', 'ü', '$','\\','/', '---');
				$replace = array( 'oe', 'ae', 'ue', 'oe', 'ae', 'a', 'e', 'e', 'ue', '-', '-', '-', '-');
				$name = eregi_replace (",|:|'|´|`|\"|\/|-|( )+|#|_", "-", $row['cat_title']);
				$name = eregi_replace ("&amp", "-and-", $name);
				$name = eregi_replace ("!|\?", "", $name);
				$name = eregi_replace ("&", "-and-", $name);
				$name = eregi_replace ("\(|\)|;", "", $name);
				$name = eregi_replace ("\[|\]", "", $name);
				$name = eregi_replace ("(-)+", "-", $name);
				$name = str_replace ($search, $replace, $name);
				$name = strtolower ( $name );

				$write_string .= '\'|"(?:./)?index.php\?c='.$row['cat_id'].'"|\','."\n";
				$write_string_b .= '\'"forumc'. $row['cat_id'] . ','. $name . '.html"\','."\n";
			}
			//-----------------------------------------------


				$write_string_b .= "); \n ?>";
				
				$write_string .= "); \n". $write_string_b;

			if(@$f = fopen($cache_seo, 'w')) 
			{ 
				fwrite($f, $write_string); 
				fclose($f); 
				@chmod($cache_seo, 0666); 
			}
		}
    }
}
// End speaking links ShortURL

//-- mod : run stats -----------------------------------------------------------
//-- add
if ( empty($gen_simple_header) && defined('DEBUG') && $plus_config['enable_gentime'] && !defined('AJAX_HEADERS'))
{
	// send run stat (page generation, sql time, requests dump...)
	$stat_run = new stat_run_class(microtime());
	$stat_run->display();
}
//-- fin mod : run stats -------------------------------------------------------

$template->pparse('overall_footer');

//
// Close our DB connection.
//
$db->sql_close();


if ($plus_config['enable_shorturls'] == 1 && !defined('AJAX_HEADERS'))
{
//
// Short URL implementation
//
$contents = ob_get_contents();
ob_end_clean();
echo replace_for_mod_rewrite($contents);
}

//
// Compress buffered output if required and send to browser
//
if ( $do_gzip_compress )
{
	//
	// Borrowed from php.net!
	//
	$gzip_contents = ob_get_contents();

if ($plus_config['enable_shorturls'] == 1 && !defined('AJAX_HEADERS'))
{	
	//
  // Short URL implementation
  //
  $gzip_contents = replace_for_mod_rewrite($gzip_contents);
}   
	ob_end_clean();

	$gzip_size = strlen($gzip_contents);
	$gzip_crc = crc32($gzip_contents);

	$gzip_contents = gzcompress($gzip_contents, 9);
	$gzip_contents = substr($gzip_contents, 0, strlen($gzip_contents) - 4);

	echo "\x1f\x8b\x08\x00\x00\x00\x00\x00";
	echo $gzip_contents;
	echo pack('V', $gzip_crc);
	echo pack('V', $gzip_size);
}

exit;

?>
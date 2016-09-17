<?php
/***************************************************************************
 *                             kb_constants.php
 *                            -------------------
 *   begin                : April, 2003
 *   copyright            : (C) 2002 MX-System
 *   email                : support@mx-system.com
 *   description		  : define constants
 *	 Author				  : Haplo (jonohlsson@hotmail.com)
 *	 credit				  : Roman Malarev (romutis), MarcMoris 
 *
 *   $Id: kb_constants.php,v 1.12 2004/05/30 20:49:22 jonohlsson Exp $
 *
 ***************************************************************************/
if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}
// ---------------------------------------------------------------------START
// This file defines specific constants for the module
// -------------------------------------------------------------------------
define('KB_ARTICLES_TABLE', $table_prefix.'kb_articles');
define('KB_CATEGORIES_TABLE', $table_prefix.'kb_categories');
define('KB_CONFIG_TABLE',$table_prefix.'kb_config');
define('KB_TYPES_TABLE',$table_prefix.'kb_types');
define('KB_WORD_TABLE',$table_prefix.'kb_wordlist');
define('KB_SEARCH_TABLE',$table_prefix.'kb_results');
define('KB_MATCH_TABLE',$table_prefix.'kb_wordmatch');
define('KB_VOTES_TABLE',$table_prefix.'kb_votes');

// **********************************************************************
//  Read language definition
// **********************************************************************

if ( !file_exists($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_kb.'.$phpEx ) )
{
  	include( $phpbb_root_path . 'language/lang_english/lang_kb.'.$phpEx );
	$link_language='lang_english';
}	
else
{
  	include(  $phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_kb.'.$phpEx );
	$link_language='lang_' . $board_config['default_lang'];
} 

// **********************************************************************
//  Read theme definition
// **********************************************************************

if ( file_exists( $phpbb_root_path . "templates/".$theme['template_name']."/images" ) )
{
// ----------
//	$current_template_images = $module_root_path . "templates/".$theme['template_name']."/images" ;
	$current_template_images = $phpbb_root_path . "templates/".$theme['template_name']."/images" ;
// ----------
}	
else
{
// ----------
//	$current_template_images = $module_root_path . "templates/"."subSilver"."/images" ;
	$current_template_images = $phpbb_root_path . 'templates/subSilver/images' ;
// ----------
} 

// **********************************************************************
//  Read image language in theme definition
// **********************************************************************

if ( file_exists( "$current_template_images/$link_language/kb.gif" ) )
{
// ----------
$images['icon_approve'] = "$current_template_images/icon_approve.gif";
$images['icon_unapprove'] = "$current_template_images/icon_unapprove.gif";
$images['kb_title'] = "$current_template_images/$link_language/kb.gif";
// ----------
}	
else
{
// ----------
$images['icon_approve'] = "$current_template_images/icon_approve.gif";
$images['icon_unapprove'] = "$current_template_images/icon_unapprove.gif";
$images['kb_title'] = "$current_template_images/lang_english/kb.gif";
// ----------
}

$kb_module_version = "Knowledge Base - MX Addon v. 1.03e";
$kb_module_author = "Haplo";
$kb_module_orig_author = "wGEric";


?>
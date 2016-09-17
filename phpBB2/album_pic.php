<?php 
/*************************************************************************** 
*                               album_pic.php 
*                            ------------------- 
*   begin                : Wednesday, February 05, 2003 
*   copyright            : (C) 2003 Smartor 
*   email                : smartor_xp@hotmail.com 
* 
*   $Id: album_pic.php,v 2.0.5 2003/02/28 14:33:12 ngoctu Exp $ 
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

  /***************************************************************************
 *                            MODIFICATIONS
 *                           ---------------
 *   started            : Saturday, January 18, 2004
 *   copyright          : © Volodymyr (CLowN) Skoryk
 *   email              : blaatimmy72@yahoo.com
 *	 version            : 1.5
 *
 *	 MODIFICATIONS:
 *		-added watermark support
 *   
 *
 ***************************************************************************/

define('IN_PHPBB', true); 
$phpbb_root_path = './'; 
$album_root_path = $phpbb_root_path . 'album_mod/'; 
include($phpbb_root_path . 'extension.inc'); 
include($phpbb_root_path . 'common.'.$phpEx); 

// 
// Start session management 
// 
$userdata = session_pagestart($user_ip, PAGE_ALBUM); 
init_userprefs($userdata); 
// 
// End session management 
// 


// 
// Get general album information 
// 
include($album_root_path . 'album_common.'.$phpEx); 

if 	(defined('ALBUM_SP_CONFIG_TABLE'))
{
// 
// Function for watermark 
// 
function mergePics($sourcefile, $insertfile, $pos = 0, $transition = 50, $filetype) 
{
	$insertfile_id = imageCreateFromPNG($insertfile);

   switch( $filetype ) 
   { 
      case '.jpg': 
         $sourcefile_id = imageCreateFromJPEG($sourcefile); 
         break; 
      case '.png': 
         $sourcefile_id = imageCreateFromPNG($sourcefile); 
         break; 
      default: 
         break; 
   } 

   // Get the size of both pics 
   $sourcefile_width = imageSX($sourcefile_id); 
   $sourcefile_height = imageSY($sourcefile_id); 
   $insertfile_width = imageSX($insertfile_id); 
   $insertfile_height = imageSY($insertfile_id); 

   switch( $pos ) 
   { 
      case 0: // middle 
         $dest_x = ( $sourcefile_width / 2 ) - ( $insertfile_width / 2 ); 
         $dest_y = ( $sourcefile_height / 2 ) - ( $insertfile_height / 2 ); 
         break; 

      case 1: // top left 
         $dest_x = 0; 
         $dest_y = 0; 
         break; 

      case 2: // top right 
         $dest_x = $sourcefile_width - $insertfile_width; 
         $dest_y = 0; 
         break; 

      case 3: // bottom right 
         $dest_x = $sourcefile_width - $insertfile_width; 
         $dest_y = $sourcefile_height - $insertfile_height; 
         break; 

      case 4: // bottom left 
         $dest_x = 0; 
         $dest_y = $sourcefile_height - $insertfile_height; 
         break; 

      case 5: // top middle 
         $dest_x = ( ( $sourcefile_width - $insertfile_width ) / 2 ); 
         $dest_y = 0; 
         break; 

      case 6: // middle right 
         $dest_x = $sourcefile_width - $insertfile_width; 
         $dest_y = ( $sourcefile_height / 2 ) - ( $insertfile_height / 2 ); 
         break; 

      case 7: // bottom middle 
         $dest_x = ( ( $sourcefile_width - $insertfile_width ) / 2 ); 
         $dest_y = $sourcefile_height - $insertfile_height; 
         break; 

      case 8: // middle left 
         $dest_x = 0; 
         $dest_y = ( $sourcefile_height / 2 ) - ( $insertfile_height / 2 ); 
         break; 
      default: 
         break; 
   } 

   // Merge the two pix 
   imageCopyMerge($sourcefile_id, $insertfile_id, $dest_x, $dest_y, 0, 0, $insertfile_width, $insertfile_height, $transition); 

   // Create the final image 
   switch( $filetype ) 
   { 
      case '.jpg': 
         Imagejpeg($sourcefile_id, '', 75); 
         break; 
      case '.png': 
         Imagepng($sourcefile_id); 
         break; 
      default: 
         break; 
   } 

   ImageDestroy($sourcefile_id); 
} 
// 
// END: Function for watermark 
// 
}

// ------------------------------------ 
// Check the request 
// ------------------------------------ 
if( isset($_GET['pic_id']) ) 
{ 
   $pic_id = intval($_GET['pic_id']); 
} 
else if( isset($_POST['pic_id']) ) 
{ 
   $pic_id = intval($_POST['pic_id']); 
} 
else 
{ 
   message_die(GENERAL_MESSAGE, 'No pics specified'); 
} 


//--- Album category Hierarchy : begin
//--- version : 1.1.0
// ------------------------------------ 
// Get this pic info and current category info
// ------------------------------------ 
$sql = "SELECT p.*, c.*
		FROM ". ALBUM_TABLE ." AS p, ". ALBUM_CAT_TABLE ." AS c
		WHERE pic_id = '$pic_id'
	  		AND c.cat_id = p.pic_cat_id";

if( !$result = $db->sql_query($sql) ) 
{ 
   message_die(GENERAL_ERROR, 'Could not query pic information', '', __LINE__, __FILE__, $sql); 
} 

$thispic = $db->sql_fetchrow($result); 
$db->sql_freeresult($result); 

$cat_id = $thispic['pic_cat_id'];
$album_user_id = $thispic['cat_user_id'];

$pic_filetype = substr($thispic['pic_filename'], strlen($thispic['pic_filename']) - 4, 4); 
$pic_filename = $thispic['pic_filename']; 
$pic_thumbnail = $thispic['pic_thumbnail']; 

if( empty($thispic) or !file_exists(ALBUM_UPLOAD_PATH . $pic_filename) ) 
{ 
   message_die(GENERAL_MESSAGE, $lang['Pic_not_exist']); 
} 


// ------------------------------------ 
// Check the permissions 
// ------------------------------------ 
$album_user_access = album_permissions($album_user_id, $cat_id, ALBUM_AUTH_VIEW, $thispic);

if( $album_user_access['view'] == 0 ) 
{ 
   message_die(GENERAL_MESSAGE, $lang['Not_Authorised']); 
} 


// ------------------------------------ 
// Check Pic Approval 
// ------------------------------------ 

if( $userdata['user_level'] != ADMIN ) 
{ 
   if( ($thispic['cat_approval'] == ADMIN) or (($thispic['cat_approval'] == MOD) and !$album_user_access['moderator']) ) 
   { 
      if( $thispic['pic_approval'] != 1 ) 
      { 
         message_die(GENERAL_MESSAGE, $lang['Not_Authorised']); 
      } 
   } 
} 

//--- Album category Hierarchy : end
// ------------------------------------ 
// Check hotlink 
// ------------------------------------ 
if( ($album_config['hotlink_prevent'] == 1) and (isset($HTTP_SERVER_VARS['HTTP_REFERER'])) ) 
{ 
   $check_referer = explode('?', $HTTP_SERVER_VARS['HTTP_REFERER']); 
   $check_referer = trim($check_referer[0]); 

   $good_referers = array(); 

   if ($album_config['hotlink_allowed'] != '') 
   { 
      $good_referers = explode(',', $album_config['hotlink_allowed']); 
   } 

   $good_referers[] = $board_config['server_name'] . $board_config['script_path']; 

   $errored = TRUE; 

   for ($i = 0; $i < count($good_referers); $i++) 
   { 
      $good_referers[$i] = trim($good_referers[$i]); 

      if( (strstr($check_referer, $good_referers[$i])) and ($good_referers[$i] != '') ) 
      { 
         $errored = FALSE; 
      } 
   } 

   if( $errored ) 
   { 
      message_die(GENERAL_MESSAGE, $lang['Not_Authorised']); 
   } 
} 


/* 
+---------------------------------------------------------- 
| Main work here... 
+---------------------------------------------------------- 
*/ 


// ------------------------------------ 
// Increase view counter 
// ------------------------------------ 
$sql = "UPDATE ". ALBUM_TABLE ." 
      SET pic_view_count = pic_view_count + 1 
      WHERE pic_id = '$pic_id'"; 
if( !$result = $db->sql_query($sql) ) 
{ 
   message_die(GENERAL_ERROR, 'Could not update pic information', '', __LINE__, __FILE__, $sql); 
} 


// ------------------------------------ 
// Okay, now we can send image to the browser 
// ------------------------------------ 
switch( $pic_filetype ) 
{ 
   case '.png': 
      header('Content-type: image/png'); 
      break; 

   case '.gif': 
      header('Content-type: image/gif'); 
      break; 

   case '.jpg': 
      header('Content-type: image/jpeg'); 
      break; 

   default: 
      message_die(GENERAL_MESSAGE, 'The filename data in the DB was corrupted'); 
} 

if (defined('ALBUM_SP_CONFIG_TABLE'))
{
// -------------------------------------------------------- 
// Okay, now we insert the watermark for unregistered users 
// -------------------------------------------------------- 
if( $pic_filetype != '.gif' && (!$userdata['session_logged_in'] || $userdata['user_level'] == USER) && $album_sp_config['use_watermark'] == 1) 
{ 
   $position  = $album_sp_config['disp_watermark_at']; 
   $transition = 50; 

   $sourcefile = ALBUM_UPLOAD_PATH  . $thispic['pic_filename']; 
   $insertfile = $album_root_path  . 'mark.png'; 
   mergePics($sourcefile, $insertfile, $position, $transition, $pic_filetype); 
}
else if ($pic_filetype != '.gif' && $album_sp_config['wut_users'] == 1 && $album_sp_config['use_watermark'] == 1)
{
   $position  = $album_sp_config['disp_watermark_at']; 
   $transition = 70; 

   $sourcefile = ALBUM_UPLOAD_PATH  . $thispic['pic_filename']; 
   $insertfile = $album_root_path  . 'mark.png'; 
   mergePics($sourcefile, $insertfile, $position, $transition, $pic_filetype);
}
else 
{ 
   readfile(ALBUM_UPLOAD_PATH  . $thispic['pic_filename']); 
} 
}
else
   readfile(ALBUM_UPLOAD_PATH  . $thispic['pic_filename']);
exit; 


// +-------------------------------------------------------------+
// |  Powered by Photo Album 2.x.x (c) 2002-2003 Smartor         |
// |  with Volodymyr (CLowN) Skoryk's Service Pack 1 © 2003-2004 |
// +-------------------------------------------------------------+

?> 
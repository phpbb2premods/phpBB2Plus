<?php
/***************************************************************************
 *                             album_upload.php
 *                            -------------------
 *   begin                : Wednesday, February 05, 2003
 *   copyright            : (C) 2003 Smartor
 *   email                : smartor_xp@hotmail.com
 *
 *   $Id: album_upload.php,v 2.1.2 2003/03/13 19:46:00 ngoctu Exp $
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

define('IN_PHPBB', true);
$phpbb_root_path = './';
$album_root_path = $phpbb_root_path . 'album_mod/';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);
include($phpbb_root_path . 'includes/functions_validate.'.$phpEx);

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


/*
+----------------------------------------------------------
| Common Check
+----------------------------------------------------------
*/


// ------------------------------------
// Check the request
// for this Upload script, we prefer POST to GET
// ------------------------------------
//--- Album Category Hierarchy : begin
//--- version : 1.1.0
if( isset($_POST['user_id']) )
{
	$album_user_id = intval($_POST['user_id']);
}
else if( isset($_GET['user_id']) )
{
	$album_user_id = intval($_GET['user_id']);
}
else
{
	// it's a public category we are uploading too
	$album_user_id = ALBUM_PUBLIC_GALLERY;
}
//--- Album Category Hierarchy : end
if( isset($_POST['cat_id']) )
{
	$cat_id = intval($_POST['cat_id']);
}
else if( isset($_GET['cat_id']) )
{
	$cat_id = intval($_GET['cat_id']);
}
else
{
	message_die(GENERAL_ERROR, 'No categories specified');
}
//--- Album Category Hierarchy : begin
//--- version : 1.3.0
// check if it's a 'fake' category id, which look like this -<user_id> (a minus sign followed by the userid)
if( isset($_POST['pic_title']) ) // is it submitted?
{
	if (!album_validate_jumpbox_selection($cat_id))
	{
		message_die(GENERAL_ERROR, $lang['No_valid_category_selected']);
	}	

 	if ($cat_id < 0)
 	{
 	 	$album_user_id = abs($cat_id); // convert the negative 'cat_id' into to a user id
 	 	if ($album_user_id > 0 && album_check_user_exists($album_user_id))
		{
        	// NOTE : if we want to create personal galleries the upload setting ($album_config['personal_gallery']) as set in the ACP
        	//        we should change the next line so it looks like this :
        	//
			//album_create_personal_gallery($album_upload_user_id, $album_config['personal_gallery_view'], $album_config['personal_gallery']);
			//
			// this will how ever make it possible for all users to upload to other persons personal galleries as default.
			//
			// so the best solution would be this which sets the upload permission to private which in this case means a moderator or the
			// owner of the gallery and of cause the admin :)
			album_create_personal_gallery($album_user_id, $album_config['personal_gallery_view'], ALBUM_PRIVATE);
			$cat_id = album_get_personal_root_id($album_user_id);
		}
	}
}
//--- Album Category Hierarchy : end


// ------------------------------------
//--- Album Category Hierarchy : begin
//--- version : 1.1.0
// ------------------------------------
// Get the current Category Info
// ------------------------------------
$sql = "SELECT c.*, COUNT(p.pic_id) AS count, IF (cat_user_id > 0, 1, 0) AS personal
		FROM ". ALBUM_CAT_TABLE ." AS c
			LEFT JOIN ". ALBUM_TABLE ." AS p ON c.cat_id = p.pic_cat_id
		WHERE c.cat_id = '$cat_id'
		GROUP BY c.cat_id
		LIMIT 1";

if( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Could not query category information', '', __LINE__, __FILE__, $sql);
}

$thiscat = $db->sql_fetchrow($result);
$db->sql_freeresult($result);
//--- Album Category Hierarchy : end

//--- Album Category Hierarchy : begin
//--- version : 1.1.0beta6
// check if its a personal gallery request and if the gallery exists (checking $thiscat)
if (empty($thiscat) && $album_user_id != ALBUM_PUBLIC_GALLERY)
{
	//check if user exsts
	$user_name = album_get_user_name($album_user_id);
	if ( !empty($user_name) )
	{
		$thiscat = init_personal_gallery_cat($album_user_id);
	}
	else
	{
		// generate mesage saying that the user specified doesn't exists
		message_die(GENERAL_ERROR, $lang['No_user_id_specified']);
	}
}
//--- Album Category Hierarchy : end


if (empty($thiscat))
{
	message_die(GENERAL_ERROR, $lang['Category_not_exist']);
}
// ------------------------------------
// now get the gategory information
// ------------------------------------
$cat_id = $thiscat['cat_id'];
$current_pics = $thiscat['count'];

// ------------------------------------
// Check the permissions
// ------------------------------------
//--- Album Category Hierarchy : begin
//--- version : 1.1.0beta6
$album_user_access = album_permissions($album_user_id,$cat_id,ALBUM_AUTH_VIEW_AND_UPLOAD, $thiscat);
//--- Album Category Hierarchy : end


if ($album_user_access['upload'] == 0)
{
	if (!$userdata['session_logged_in'])
	{
		redirect(append_sid(album_append_uid("login.$phpEx?redirect=album_upload.$phpEx?cat_id=$cat_id")));
	}
	else
	{
		message_die(GENERAL_ERROR, $lang['Not_Authorised']);
	}
}


/*
+----------------------------------------------------------
| Upload Quota Check
+----------------------------------------------------------
*/
//--- Album Category Hierarchy : begin
//--- version : 1.1.0
// if we are in a public category
if ($album_user_id == ALBUM_PUBLIC_GALLERY)
{
//--- Album Category Hierarchy : end
	// ------------------------------------
	// Check This Category Quota
	// ------------------------------------
	if ($album_config['max_pics'] >= 0)
	{
		// $current_pics was set at "Get the current Category Info"
		if( $current_pics >= $album_config['max_pics'] )
		{
			message_die(GENERAL_MESSAGE, $lang['Album_reached_quota']);
		}
	}

	// ------------------------------------
	// Check This User Limit Quota
	// ------------------------------------
	$check_user_limit = FALSE;

	if( ($userdata['user_level'] != ADMIN) and ($userdata['session_logged_in']) )
	{
		if ($album_user_access['moderator'])
		{
			if ($album_config['mod_pics_limit'] >= 0)
			{
				$check_user_limit = 'mod_pics_limit';
			}
		}
		else
		{
			if ($album_config['user_pics_limit'] >= 0)
			{
				$check_user_limit = 'user_pics_limit';
			}
		}
	}

	// Do the check here
	if ($check_user_limit != FALSE)
	{
		$sql = "SELECT COUNT(pic_id) AS count
				FROM ". ALBUM_TABLE ."
				WHERE pic_user_id = '". $userdata['user_id'] ."'
					AND pic_cat_id = '$cat_id'";

		if( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not count your pic', '', __LINE__, __FILE__, $sql);
		}
		$row = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);
		
		if( $row['count'] >= $album_config[$check_user_limit] )
		{
			message_die(GENERAL_MESSAGE, $lang['User_reached_pics_quota']);
		}
		
		unset($row);
	}
}
//--- Album Category Hierarchy : begin
//--- version : 1.1.0
// it's a personal gallery category
else
{
	$sql = "SELECT COUNT(p.pic_id) AS count
			FROM ". ALBUM_TABLE ." AS p, ". ALBUM_CAT_TABLE ." AS c
			WHERE c.cat_user_id = '". $album_user_id ."'
				AND p.pic_cat_id = c.cat_id";

	if( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not count your pic', '', __LINE__, __FILE__, $sql);
	}
	$row = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);
	
	if( ($row['count'] >= $album_config['personal_gallery_limit']) and ($album_config['personal_gallery_limit'] >= 0) )
	{
		message_die(GENERAL_MESSAGE, $lang['Album_reached_quota']);
	}
	
	unset($row);
}
//--- Album Category Hierarchy : end

/*
+----------------------------------------------------------
| Main work here...
+----------------------------------------------------------
*/

if( !isset($_POST['pic_title']) ) // is it not submitted?
{
	// --------------------------------
	// --------------------------------
	// Build categories select
	// --------------------------------
	//--- Album Category Hierarchy : begin
	//--- version : 1.3.0	
	album_read_tree($userdata['user_id'], ALBUM_READ_ALL_CATEGORIES|ALBUM_AUTH_VIEW_AND_UPLOAD);	
    if( $userdata['session_logged_in'] )
	{
    	// build fake list of personal galleries (these will get created when needed later automatically
		$userinfo = album_get_nonexisting_personal_gallery_info();

        for($idx=0; $idx < count($userinfo); $idx++)
        {
		 	// is user allowed to create this personal gallery ?
		 	// NOTE : that it isn't nesecary to create the $personal_gallery variable first,
		 	//        it will be generated inside the album_permissions function if needed
		 	//		  but here it's done to make the code easier to read
		 	$personal_gallery = init_personal_gallery_cat($userinfo[$idx]['user_id']);
			$album_user_access = album_permissions($userinfo[$idx]['user_id'], 0, ALBUM_AUTH_CREATE_PERSONAL, $personal_gallery);
			if (album_check_permission($album_user_access, ALBUM_AUTH_CREATE_PERSONAL) == TRUE)
			{
				$selected = (($userdata['user_id'] ==  $userinfo[$idx]['user_id'])) ? ' selected="selected"' : '';
			 	$personal_gallery_list .= '<option value="-'.$userinfo[$idx]['user_id'].'" ' . $selected . '>' . sprintf($lang['Personal_Gallery_Of_User'], $userinfo[$idx]['username']) . '</option>';
			}
		}

		if (!empty($personal_gallery_list))
			$personal_gallery_list = '<option value="'.ALBUM_JUMPBOX_SEPERATOR.'">------------------------------</option>' . $personal_gallery_list;
	}	
	$select_cat = '<select name="cat_id">';
	$select_cat .= album_get_tree_option($cat_id, ALBUM_AUTH_VIEW_AND_UPLOAD);
	$select_cat .= $personal_gallery_list;
	$select_cat .= '</select>';
	unset($personal_gallery_list);
	album_free_album_data();	
	//--- Album Category Hierarchy : end

	//
	// Start output of page
	//
	$page_title = $lang['Album'];
	include($phpbb_root_path . 'includes/page_header.'.$phpEx);

	$template->set_filenames(array(
		'body' => 'album_upload_body.tpl')
	);

	$template->assign_vars(array(
		'U_VIEW_CAT' => append_sid(album_append_uid("album_cat.$phpEx?cat_id=$cat_id")),
		'CAT_TITLE' => $thiscat['cat_title'],

		'L_UPLOAD_PIC' => $lang['Upload_Pic'],

		'L_USERNAME' => $lang['Username'],
		'L_PIC_TITLE' => $lang['Pic_Title'],

		'L_PIC_DESC' => $lang['Pic_Desc'],
		'L_PLAIN_TEXT_ONLY' => $lang['Plain_text_only'],
		'L_MAX_LENGTH' => $lang['Max_length'],
		'S_PIC_DESC_MAX_LENGTH' => $album_config['desc_length'],

		'L_UPLOAD_PIC_FROM_MACHINE' => $lang['Upload_pic_from_machine'],
		'L_UPLOAD_TO_CATEGORY' => $lang['Upload_to_Category'],

		'SELECT_CAT' => $select_cat,

		'L_MAX_FILESIZE' => $lang['Max_file_size'],
		'S_MAX_FILESIZE' => $album_config['max_file_size'],

		'L_MAX_WIDTH' => $lang['Max_width'],
		'L_MAX_HEIGHT' => $lang['Max_height'],

		'S_MAX_WIDTH' => $album_config['max_width'],
		'S_MAX_HEIGHT' => $album_config['max_height'],

		'L_ALLOWED_JPG' => $lang['JPG_allowed'],
		'L_ALLOWED_PNG' => $lang['PNG_allowed'],
		'L_ALLOWED_GIF' => $lang['GIF_allowed'],

		'S_JPG' => ($album_config['jpg_allowed'] == 1) ? $lang['Yes'] : $lang['No'],
		'S_PNG' => ($album_config['png_allowed'] == 1) ? $lang['Yes'] : $lang['No'],
		'S_GIF' => ($album_config['gif_allowed'] == 1) ? $lang['Yes'] : $lang['No'],

		'L_UPLOAD_NO_TITLE' => $lang['Upload_no_title'],
		'L_UPLOAD_NO_FILE' => $lang['Upload_no_file'],
		'L_DESC_TOO_LONG' => $lang['Desc_too_long'],
		//--- Album Category Hierarchy : begin
		//--- version : 1.3.0			
		'S_ALBUM_JUMPBOX_PUBLIC_GALLERY' => intval(ALBUM_JUMPBOX_PUBLIC_GALLERY),
		'S_ALBUM_JUMPBOX_USERS_GALLERY' => intval(ALBUM_JUMPBOX_USERS_GALLERY),
		'S_ALBUM_JUMPBOX_SEPERATOR' => intval(ALBUM_JUMPBOX_SEPERATOR),
		'S_ALBUM_ROOT_CATEGORY' => intval(ALBUM_ROOT_CATEGORY),
		'L_NO_VALID_CAT_SELECTED' => $lang['No_valid_category_selected'],
		//--- Album Category Hierarchy : end

		// Manual Thumbnail
		'L_UPLOAD_THUMBNAIL' => $lang['Upload_thumbnail'],
		'L_UPLOAD_THUMBNAIL_EXPLAIN' => $lang['Upload_thumbnail_explain'],
		'L_THUMBNAIL_SIZE' => $lang['Thumbnail_size'],
		'S_THUMBNAIL_SIZE' => $album_config['thumbnail_size'],

		'L_RESET' => $lang['Reset'],
		'L_SUBMIT' => $lang['Submit'],

		'S_ALBUM_ACTION' => append_sid(album_append_uid("album_upload.$phpEx?cat_id=$cat_id")),
		)
	);

	if ($album_config['gd_version'] == 0)
	{
		$template->assign_block_vars('switch_manual_thumbnail', array());
	}

	//
	// Generate the page
	//
	$template->pparse('body');

	include($phpbb_root_path . 'includes/page_tail.'.$phpEx);
}
else
{
	// --------------------------------
	// Check posted info
	// --------------------------------

	$pic_title = str_replace("\'", "''", htmlspecialchars(trim($_POST['pic_title'])));

	$pic_desc = str_replace("\'", "''", htmlspecialchars(substr(trim($_POST['pic_desc']), 0, $album_config['desc_length'])));

	$pic_username = (!$userdata['session_logged_in']) ? substr(str_replace("\'", "''", htmlspecialchars(trim($_POST['pic_username']))), 0, 32) : str_replace("'", "''", $userdata['username']);

	if( empty($pic_title) )
	{
		message_die(GENERAL_ERROR, $lang['Missed_pic_title']);
	}

	if( !isset($HTTP_POST_FILES['pic_file']) )
	{
		message_die(GENERAL_ERROR, 'Bad Upload');
	}
	//--- Album Category Hierarchy : begin
	//--- version : 1.1.0	
	$album_user_id = album_is_personal_gallery($cat_id);		
	//--- Album Category Hierarchy : en

	// --------------------------------
	// Check username for guest posting
	// --------------------------------

	if (!$userdata['session_logged_in'])
	{
		if ($pic_username != '')
		{
			$result = validate_username($pic_username);
			if ( $result['error'] )
			{
				message_die(GENERAL_MESSAGE, $result['error_msg']);
			}
		}
	}	


	// --------------------------------
	// Get File Upload Info
	// --------------------------------

	$filetype = $HTTP_POST_FILES['pic_file']['type'];
	$filesize = $HTTP_POST_FILES['pic_file']['size'];
	$filetmp = $HTTP_POST_FILES['pic_file']['tmp_name'];

	if ($album_config['gd_version'] == 0)
	{
		$thumbtype = $HTTP_POST_FILES['pic_thumbnail']['type'];
		$thumbsize = $HTTP_POST_FILES['pic_thumbnail']['size'];
		$thumbtmp = $HTTP_POST_FILES['pic_thumbnail']['tmp_name'];
	}


	// --------------------------------
	// Prepare variables
	// --------------------------------

	$pic_time = time();
	$pic_user_id = $userdata['user_id'];
	$pic_user_ip = $userdata['session_ip'];


	// --------------------------------
	// Check file size
	// --------------------------------

	if( ($filesize == 0) or ($filesize > $album_config['max_file_size']) )
	{
		message_die(GENERAL_MESSAGE, $lang['Bad_upload_file_size']);
	}

	if ($album_config['gd_version'] == 0)
	{
		if( ($thumbsize == 0) or ($thumbsize > $album_config['max_file_size']) )
		{
			message_die(GENERAL_MESSAGE, $lang['Bad_upload_file_size']);
		}
	}


	// --------------------------------
	// Check file type
	// --------------------------------

	switch ($filetype)
	{
		case 'image/jpeg':
		case 'image/jpg':
		case 'image/pjpeg':
			if ($album_config['jpg_allowed'] == 0)
			{
				message_die(GENERAL_ERROR, $lang['Not_allowed_file_type']);
			}
			$pic_filetype = '.jpg';
			break;

		case 'image/png':
		case 'image/x-png':
			if ($album_config['png_allowed'] == 0)
			{
				message_die(GENERAL_ERROR, $lang['Not_allowed_file_type']);
			}
			$pic_filetype = '.png';
			break;

		case 'image/gif':
			if ($album_config['gif_allowed'] == 0)
			{
				message_die(GENERAL_ERROR, $lang['Not_allowed_file_type']);
			}
			$pic_filetype = '.gif';
			break;
		default:
			message_die(GENERAL_ERROR, $lang['Not_allowed_file_type']);
	}

	if ($album_config['gd_version'] == 0)
	{
		if ($filetype != $thumbtype)
		{
			message_die(GENERAL_ERROR, $lang['Filetype_and_thumbtype_do_not_match']);
		}
	}


	// --------------------------------
	// Generate filename
	// --------------------------------

	srand((double)microtime()*1000000);	// for older than version 4.2.0 of PHP

	do
	{
		$pic_filename = md5(uniqid(rand())) . $pic_filetype;
	}
	while( file_exists(ALBUM_UPLOAD_PATH . $pic_filename) );

	if ($album_config['gd_version'] == 0)
	{
		$pic_thumbnail = $pic_filename;
	}


	// --------------------------------
	// Move this file to upload directory
	// --------------------------------

	$ini_val = ( @phpversion() >= '4.0.0' ) ? 'ini_get' : 'get_cfg_var';

	if ( @$ini_val('open_basedir') != '' )
	{
		if ( @phpversion() < '4.0.3' )
		{
			message_die(GENERAL_ERROR, 'open_basedir is set and your PHP version does not allow move_uploaded_file<br /><br />Please contact your server admin', '', __LINE__, __FILE__);
		}

		$move_file = 'move_uploaded_file';
	}
	else
	{
		$move_file = 'copy';
	}

	$move_file($filetmp, ALBUM_UPLOAD_PATH . $pic_filename);

	@chmod(ALBUM_UPLOAD_PATH . $pic_filename, 0777);

	if ($album_config['gd_version'] == 0)
	{
		$move_file($thumbtmp, ALBUM_CACHE_PATH . $pic_thumbnail);

		@chmod(ALBUM_CACHE_PATH . $pic_thumbnail, 0777);
	}


	// --------------------------------
	// Well, it's an image. Check its image size
	// --------------------------------

	$pic_size = getimagesize(ALBUM_UPLOAD_PATH . $pic_filename);

	$pic_width = $pic_size[0];
	$pic_height = $pic_size[1];

	if ( ($pic_width > $album_config['max_width']) or ($pic_height > $album_config['max_height']) )
	{
		@unlink(ALBUM_UPLOAD_PATH . $pic_filename);

		if ($album_config['gd_version'] == 0)
		{
			@unlink(ALBUM_CACHE_PATH . $pic_thumbnail);
		}

		message_die(GENERAL_ERROR, $lang['Upload_image_size_too_big']);
	}

	if ($album_config['gd_version'] == 0)
	{
		$thumb_size = getimagesize(ALBUM_CACHE_PATH . $pic_thumbnail);

		$thumb_width = $thumb_size[0];
		$thumb_height = $thumb_size[1];

		if ( ($thumb_width > $album_config['thumbnail_size']) or ($thumb_height > $album_config['thumbnail_size']) )
		{
			@unlink(ALBUM_UPLOAD_PATH . $pic_filename);

			@unlink(ALBUM_CACHE_PATH . $pic_thumbnail);

			message_die(GENERAL_ERROR, $lang['Upload_thumbnail_size_too_big']);
		}
	}


	// --------------------------------
	// This image is okay, we can cache its thumbnail now
	// --------------------------------

	if( ($album_config['thumbnail_cache'] == 1) and ($pic_filetype != '.gif') and ($album_config['gd_version'] > 0) )
	{
		$gd_errored = FALSE;

		switch ($pic_filetype)
		{
			case '.jpg':
				$read_function = 'imagecreatefromjpeg';
				break;
			case '.png':
				$read_function = 'imagecreatefrompng';
				break;
		}

		$src = @$read_function(ALBUM_UPLOAD_PATH  . $pic_filename);

		if (!$src)
		{
			$gd_errored = TRUE;
			$pic_thumbnail = '';
		}
		else if( ($pic_width > $album_config['thumbnail_size']) or ($pic_height > $album_config['thumbnail_size']) )
		{
			// Resize it
			if ($pic_width > $pic_height)
			{
				$thumbnail_width = $album_config['thumbnail_size'];
				$thumbnail_height = $album_config['thumbnail_size'] * ($pic_height/$pic_width);
			}
			else
			{
				$thumbnail_height = $album_config['thumbnail_size'];
				$thumbnail_width = $album_config['thumbnail_size'] * ($pic_width/$pic_height);
			}

			$thumbnail = ($album_config['gd_version'] == 1) ? @imagecreate($thumbnail_width, $thumbnail_height) : @imagecreatetruecolor($thumbnail_width, $thumbnail_height);

			$resize_function = ($album_config['gd_version'] == 1) ? 'imagecopyresized' : 'imagecopyresampled';

			@$resize_function($thumbnail, $src, 0, 0, 0, 0, $thumbnail_width, $thumbnail_height, $pic_width, $pic_height);
		}
		else
		{
			$thumbnail = $src;
		}

		if (!$gd_errored)
		{
			$pic_thumbnail = $pic_filename;

			// Write to disk
			switch ($pic_filetype)
			{
				case '.jpg':
					@imagejpeg($thumbnail, ALBUM_CACHE_PATH . $pic_thumbnail, $album_config['thumbnail_quality']);
					break;
				case '.png':
					@imagepng($thumbnail, ALBUM_CACHE_PATH . $pic_thumbnail);
					break;
			}

			@chmod(ALBUM_CACHE_PATH . $pic_thumbnail, 0777);

		} // End IF $gd_errored

	} // End Thumbnail Cache
	else if ($album_config['gd_version'] > 0)
	{
		$pic_thumbnail = '';
	}

	// --------------------------------
	// Check Pic Approval
	// --------------------------------

	$pic_approval = ($thiscat['cat_approval'] == 0) ? 1 : 0;


	// --------------------------------
	// Insert into DB
	// --------------------------------

	$sql = "INSERT INTO ". ALBUM_TABLE ." (pic_filename, pic_thumbnail, pic_title, pic_desc, pic_user_id, pic_user_ip, pic_username, pic_time, pic_cat_id, pic_approval)
			VALUES ('$pic_filename', '$pic_thumbnail', '$pic_title', '$pic_desc', '$pic_user_id', '$pic_user_ip', '$pic_username', '$pic_time', '$cat_id', '$pic_approval')";
	if( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Could not insert new entry', '', __LINE__, __FILE__, $sql);
	}


	// --------------------------------
	// Complete... now send a message to user
	// --------------------------------

	if ($thiscat['cat_approval'] == 0)
	{
		$message = $lang['Album_upload_successful'];
	}
	else
	{
		$message = $lang['Album_upload_need_approval'];
	}

	if ($thiscat['cat_approval'] == 0)
	{
	 	if (album_is_debug_enabled() == false)
	 	{
		    $template->assign_vars(array(
		        'META' => '<meta http-equiv="refresh" content="3;url=' . append_sid(album_append_uid("album_cat.$phpEx?cat_id=$cat_id")) . '">'
                )
            );
		}
	}
	if ($album_user_id == ALBUM_PUBLIC_GALLERY)
	{
		$message .= "<br /><br />" . sprintf($lang['Click_return_category'], "<a href=\"" . append_sid(album_append_uid("album_cat.$phpEx?cat_id=$cat_id")) . "\">", "</a>");
	}
	else
	{
		$message .= "<br /><br />" . sprintf($lang['Click_return_personal_gallery'], "<a href=\"" . append_sid(album_append_uid("album_cat.$phpEx?cat_id=$cat_id")) . "\">", "</a>");
	}


	$message .= "<br /><br />" . sprintf($lang['Click_return_album_index'], "<a href=\"" . append_sid(album_append_uid("album.$phpEx")) . "\">", "</a>");

	message_die(GENERAL_MESSAGE, $message);
}


// +------------------------------------------------------+
// |  Powered by Photo Album 2.x.x (c) 2002-2003 Smartor  |
// +------------------------------------------------------+

?>
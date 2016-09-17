<?php
/***************************************************************************
 *                          lang_main_album.php [English]
 *                              -------------------
 *     begin                : Sunday, February 02, 2003
 *     copyright            : (C) 2003 Smartor
 *     email                : smartor_xp@hotmail.com
 *
 *     $Id: lang_main_album.php,v 1.0.6 2003/03/05 20:12:38 ngoctu Exp $
 *
 ****************************************************************************/

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
   exit;
}

//--- Album Category Hierarchy : begin
//--- version : 1.10
include($phpbb_root_path.'language/lang_english/lang_hierarchy_album.' . $phpEx);
//--- Album Category Hierarchy : end


//
// Album Index
//
$lang['Photo_Album'] = 'Photo Album';
$lang['Pics'] = 'Pics';
$lang['Last_Pic'] = 'Last Pic';
$lang['Public_Categories'] = 'Public Categories';
$lang['No_Pics'] = 'No Pics';
$lang['Users_Personal_Galleries'] = 'User\'s Personal Galleries';
$lang['Your_Personal_Gallery'] = 'Your Personal Gallery';
$lang['Recent_Public_Pics'] = 'Recent Public Pics';
$lang['Highest_Rated_Pics'] = 'Highest Rated Pictures';
$lang['Random_Pics'] = 'Random Pictures';

$lang['View'] = 'View';

//
// Category View
//
$lang['Category_not_exist'] = 'This category does not exist';
$lang['Upload_Pic'] = 'Upload Pic';
$lang['Pic_Title'] = 'Pic Title';

$lang['Album_upload_can'] = 'You <b>can</b> upload new pics in this category';
$lang['Album_upload_cannot'] = 'You <b>cannot</b> upload new pics in this category';
$lang['Album_rate_can'] = 'You <b>can</b> rate pics in this category';
$lang['Album_rate_cannot'] = 'You <b>cannot</b> rate pics in this category';
$lang['Album_comment_can'] = 'You <b>can</b> post comments to pics in this category';
$lang['Album_comment_cannot'] = 'You <b>cannot</b> post comments to pics in this category';
$lang['Album_edit_can'] = 'You <b>can</b> edit your pics and comments in this category';
$lang['Album_edit_cannot'] = 'You <b>cannot</b> edit your pics and comments in this category';
$lang['Album_delete_can'] = 'You <b>can</b> delete your pics and comments in this category';
$lang['Album_delete_cannot'] = 'You <b>cannot</b> delete your pics and comments in this category';
$lang['Album_moderate_can'] = 'You <b>can</b> %smoderate%s this category';

$lang['Edit_pic'] = 'Edit';
$lang['Delete_pic'] = 'Delete';
$lang['Rating'] = 'Rating';
$lang['Comments'] = 'Comments';
$lang['New_Comment'] = 'New Comment';

$lang['Not_rated'] = '<i>not rated</i>';

//
// Upload
//
$lang['Pic_Desc'] = 'Pic Description';
$lang['Plain_text_only'] = 'Plain text only';
$lang['Max_length'] = 'Max length (bytes)';
$lang['Upload_pic_from_machine'] = 'Upload a pic from your machine';
$lang['Upload_to_Category'] = 'Upload to Category';
$lang['Upload_thumbnail_from_machine'] = 'Upload its thumbnail from your machine (must be the same type with your pic)';
$lang['Upload_thumbnail'] = 'Upload a thumbnail image';
$lang['Upload_thumbnail_explain'] = 'It must be of the same file type as your picture';
$lang['Thumbnail_size'] = 'Thumbnail size (pixel)';
$lang['Filetype_and_thumbtype_do_not_match'] = 'Your pic and your thumbnail must be the same type';

$lang['Upload_no_title'] = 'You must enter a title for your pic';
$lang['Upload_no_file'] = 'You must enter your path and your filename';
$lang['Desc_too_long'] = 'Your description is too long';

$lang['Max_file_size'] = 'Maximum file size (bytes)';
$lang['Max_width'] = 'Maximum image width (pixel)';
$lang['Max_height'] = 'Maximum image height (pixel)';

$lang['JPG_allowed'] = 'Allowed to upload JPG files';
$lang['PNG_allowed'] = 'Allowed to upload PNG files';
$lang['GIF_allowed'] = 'Allowed to upload GIF files';

$lang['Album_reached_quota'] = 'This category has reached the quota of pics. Now you cannot upload any more. Please contact the administrators for more information';
$lang['User_reached_pics_quota'] = 'You have reached your quota of pics. Now you cannot upload any more. Please contact the administrators for more information';

$lang['Bad_upload_file_size'] = 'Your uploaded file is too large or corrupted';
$lang['Not_allowed_file_type'] = 'Your file type is not allowed';
$lang['Upload_image_size_too_big'] = 'Your image dimension size is too large';
$lang['Upload_thumbnail_size_too_big'] = 'Your thumbnail dimension size is too large';

$lang['Missed_pic_title'] = 'You must enter your pic title';

$lang['Album_upload_successful'] = 'Your pic has been uploaded successfully';
$lang['Album_upload_need_approval'] = 'Your pic has been uploaded successfully.<br /><br />But the feature Pic Approval has been enabled so your pic must be approved by a administrator or a moderator before posting';
$lang['Click_return_category'] = 'Click %shere%s to return to the category';
$lang['Click_return_album_index'] = 'Click %shere%s to return to the Album Index';

// View Pic
$lang['Pic_not_exist'] = 'This pic does not exist';

// Edit Pic
$lang['Edit_Pic_Info'] = 'Edit Pic Information';
$lang['Pics_updated_successfully'] = 'Your pic information has been updated successfully';

// Delete Pic
$lang['Album_delete_confirm'] = 'Are you sure to delete these pic(s)?';
$lang['Pics_deleted_successfully'] = 'These pic(s) have been deleted successfully';

//
// ModCP
//
$lang['Approval'] = 'Approval';
$lang['Approve'] = 'Approve';
$lang['Unapprove'] = 'Unapprove';
$lang['Status'] = 'Status';
$lang['Locked'] = 'Locked';
$lang['Not_approved'] = 'Not approved';
$lang['Approved'] = 'Approved';
$lang['Move_to_Category'] = 'Move to Category';
$lang['Pics_moved_successfully'] = 'Your pic(s) have been moved successfully';
$lang['Pics_locked_successfully'] = 'Your pic(s) have been locked successfully';
$lang['Pics_unlocked_successfully'] = 'Your pic(s) have been unlocked successfully';
$lang['Pics_approved_successfully'] = 'Your pic(s) have been approved successfully';
$lang['Pics_unapproved_successfully'] = 'Your pic(s) have been unapproved successfully';

//
// Rate
//
$lang['Current_Rating'] = 'Current Rating';
$lang['Please_Rate_It'] = 'Please Rate It';
$lang['Already_rated'] = 'You have already rated this pic';
$lang['Album_rate_successfully'] = 'Your pic has been rated successfully';

//
// Comment
//
$lang['Comment_no_text'] = 'Please enter your comment';
$lang['Comment_too_long'] = 'Your comment is too long';
$lang['Comment_delete_confirm'] = 'Are you sure you want to delete this comment?';
$lang['Pic_Locked'] = 'Sorry, this pic was locked. So you cannot post comment for this pic anymore';

//
// Personal Gallery
//
$lang['Personal_Gallery_Explain'] = 'You can view the personal galleries of other members by clicking on the link in their profiles';
$lang['Personal_gallery_not_created'] = 'The personal gallery of %s is empty or has not been created';
$lang['Not_allowed_to_create_personal_gallery'] = 'Sorry, the administrator(s) of this board do not allow you to create a personal gallery';
$lang['Click_return_personal_gallery'] = 'Click %shere%s to return to the personal gallery';

/* Album Hierarchy - START */
$lang['Last_Comments'] = 'Last Comment';
$lang['No_Comment_Info'] = 'No Comments';
$lang['No_Pictures_In_Cat']= 'No Pictures In Category';
$lang['Total_Pics'] = 'Total Pics';
$lang['Total_Comments'] = 'Total Comments';
$lang['Last_Index_Thumbnail'] = 'Last Pic';
$lang['Sub_Total_Pics'] = 'Total Pics';
/* Album Hierarchy - STOP  */
/* Album Hierarchy - START */ 
$lang['Album_sub_categories'] = 'Sub Categories'; 
/* Album Hierarchy - STOP  */ 

?>
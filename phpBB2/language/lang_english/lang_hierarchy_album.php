<?php
/***************************************************************************
 *                          lang_hierarchy_album.php [English]
 *                          ------------------------------------------------
 *     begin                : Wednesday, May 12, 2004
 *     copyright            : (C) 2004 IdleVoid
 *     email                : idlevoid@slater.dk
 *
 *     version              : 1.0.2 12/08/2004
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

//
// Album Hierarchy Index Table
//
$lang['Last_Comments'] = 'Last Comment';
$lang['No_Comment_Info'] = 'No Comments';
$lang['No_Pictures_In_Cat']= 'No Pictures In Category';
$lang['Total_Pics'] = 'Total Pics';
$lang['Total_Comments'] = 'Total Comments';
$lang['Last_Index_Thumbnail'] = 'Last Pic';
$lang['One_Sub_Total_Pics'] = ' (%d Pic)'; // NOTE THE SPACE BEFORE '(', ITS ON PURPOSE. AND PLEASE KEEP IT
$lang['Multiple_Sub_Total_Pics'] = ' (%d Pics)'; // NOTE THE SPACE BEFORE '(', ITS ON PURPOSE. AND PLEASE KEEP IT
$lang['Album_sub_categories'] = 'Sub Categories';
$lang['No_Public_Galleries'] = 'No Public Galleries';
$lang['One_new_picture'] = '%d new picture';
$lang['Multiple_new_pictures'] = '%d new pictures'; // notice the 'S' in pictureS :), any better way to do it ???
//
// Personal Album Hierarchy Index Table
//
$lang['Personal_Categories'] = 'Personal Gallery';
$lang['Personal_Cat_Admin'] = 'Personal Gallery Category Admin';
$lang['Recent_Personal_Pics'] = 'Recent Pictures From the Personal Gallery of %s';
//
// Album Moderator Control Panel
//
$lang['Modcp_check_all'] = 'Check All';
$lang['Modcp_uncheck_all'] = 'Uncheck All';
$lang['Modcp_inverse_selection'] = 'Inverse Selection';

$lang['Show_selected_pic_view_mode'] = 'Show Only The Selected Personal Gallery Category';
$lang['Show_all_pic_view_mode'] = 'Show All Pictures In this Personal Gallery';

//
// Access language strings
//
$lang['Album_Can_Manage_Categories'] = 'You <b>can</b> %smanage%s the categories in the gallery';
$lang['No_Personal_Category_admin'] = 'You are not allowed to manage your personal gallery categories';

// Upload message
$lang['No_valid_category_selected'] = 'No valid album category selected';

//
// The picture list of a member (album_mod/album_memberlist.php)
//
$lang['Pic_Cat'] = 'Category';
$lang['Picture_List_Of_User'] = 'All Pictures by %s';
$lang['Member_Picture_List_Explain'] = 'You can view the complete list of picture contributed by other members by clicking on the link in their profiles';
//--- version 1.3.0
$lang['Comment_List_Of_User'] = 'All Comments by %s';
$lang['Rating_List_Of_User'] = 'All Ratings by %s';
$lang['Show_All_Pictures_Of_user'] = 'Show All Pictures by %s';
$lang['Show_All_Comments_Of_user'] = 'Show All Comments by %s';
$lang['Show_All_Ratings_Of_user'] = 'Show All Ratings by %s';

$lang['Not_commented'] = '<i>not commented</i>';

/***************************************************************************
 * Album Hierarchy Administration                                          *
 ***************************************************************************/
//
// Configuration
//
$lang['Album_config_notice'] = 'If you have done some changes to the current settings and then selects another tab, you will be prompted if you want to save the changes. <br />The system does <b>not</b> save it automaticly';
$lang['Save_sucessfully_confimation'] = '%s was saved successfully';

$lang['Show_Recent_In_Subcats'] = 'Show recent pictures in sub categories';
$lang['Show_Recent_Instead_of_NoPics'] = 'Show recent pictures instead of no picture message';

$lang['Album_Index_Settings'] = 'Album Index Table Settings';
$lang['Show_Index_Subcats'] = 'Show sub categories in index table';
$lang['Show_Index_Thumb'] = 'Show category thumbnails in index table';
$lang['Show_Index_Pics'] = 'Show the number of pictures in current category in index table';
$lang['Show_Index_Comments'] = 'Show the number of comments in current category in index table';
$lang['Show_Index_Total_Pics'] = 'Show the number of total pictures for current categories and all it\'s sub categories in index table';
$lang['Show_Index_Total_Comments'] = 'Show the number of total comments for current categories and all it\'s sub categories in index table';
$lang['Show_Index_Last_Comment'] = 'Show last comments for current categories and all it\'s sub categories in index table';
$lang['Show_Index_Last_Pic'] = 'Show last picture info for current categories and all it\'s sub categories in index table';
$lang['Show_Index_Last_Pic'] = 'Show last picture info for current categories and all it\'s sub categories in index table';
$lang['Line_Break_Subcats'] = 'Show each sub cat on a new line';

$lang['Show_Personal_Gallery_Link'] = 'Show Personal Gallery and Users Personal Gallery link in Sub Categories';

$lang['Album_Personal_Auth_Explain'] = 'Here you can choose which usergroup(s) can be the moderators for <b>all</b> personal album categories or just has the private access to them';

$lang['Album_debug_mode'] = 'Enable the hierarchy debug mode.<br><span class="gensmall">This will generate a lot of extra output on the page and also some header warnings, which are all ok.<br>This option should <b>only</b> be used when having problems.</span>';

$lang['New_Pic_Check_Interval'] = 'The time to use to see if a picture is new or not.<br><span class="gensmall"><b>Format</b> : &lt;number&gt;&lt;type&gt; Where type is either h, d, w or m (hour, day, week or month)<br> e.g. 12H = 12 hours and 12D = 12 days and 12W = 12 weeks and 12M = 12 months<br>If no type is specified the system will use <b>days</b></span>';
$lang['New_Pic_Check_Interval_Desc'] = '<span class="gensmall">H = HOURS, D = DAYS, W = WEEKS, M = MONTHS</span>';
$lang['Enable_Show_All_Pics'] = 'Enable toggling of personal gallery view mode (all pictures or only selected category).<br/> When set to <b>no</b>, only selected category is shown.';
$lang['Enable_Index_Supercells'] = 'Enable super cells in the index table. <br><span class="gensmall">This will enable the mouseover effects on the columns, also knows as the supercell effect.</span>';

// Sorting
$lang['Album_Category_Sorting'] = 'Sorting of the album categories';
$lang['Album_Category_Sorting_Id'] = 'ID';
$lang['Album_Category_Sorting_Name'] = 'Name';
$lang['Album_Category_Sorting_Order'] = 'Sort Order (default)';
$lang['Album_Category_Sorting_Direction'] = 'Sorting direction (only valid for ID and Name sorting)';
$lang['Album_Category_Sorting_Asc'] = 'Ascending';
$lang['Album_Category_Sorting_Desc'] = 'Descending';

// Upload 
$lang['Upload_Settings'] = 'Upload Settings';

// Personal Gallery
$lang['Album_Personal_Settings'] = 'Personal Gallery Settings';
$lang['Show_Personal_Sub_Cats'] = 'Show personal sub categories in index table';
$lang['Personal_Gallery_MOD'] = 'Personal gallery can moderated by owner';
$lang['Personal_Sub_Cat_Limit'] = 'Maximum number of sub categories (-1 = unlimited)';
$lang['User_Can_Create_Personal_SubCats'] = 'Users can create sub categories in own personal gallery';

$lang['Click_return_personal_gallery_index'] = 'Click %shere%s to return to the personal gallery index';

$lang['Show_Recent_In_Personal_Subcats'] = 'Show recent pictures in personal sub categories';
$lang['Show_Recent_Instead_of_Personal_NoPics'] = 'Show recent pictures instead of no picture message in personal gallery';

//
// Categories
//
$lang['Personal_Root_Gallery'] = 'Personal Gallery Root Category';
$lang['Parent_Category'] = 'Parent Category (for this category)';
$lang['Child_Category_Moved'] = 'Selected category had child categories. The child categories got moved to the <B>%s</B> category.';
$lang['No_Self_Refering_Cat'] = 'You cannot set a category\'s parent to itself';
$lang['Can_Not_Change_Main_Parent'] = 'You cannot change to parent of the main category of your personal gallery';

//
// ACP - Javascript text
//
$lang['acp_ask_save_changes'] = 'Do want to save the changes ?\n(OK = Yes, Cancel = No)';
$lang['acp_nothing_to_save'] = 'Nothing to save !';
$lang['acp_settings_changed_ask_save'] = 'You have changed the settings. Do you want to save them ?\n(OK = Yes, Cancel = No)';

?>
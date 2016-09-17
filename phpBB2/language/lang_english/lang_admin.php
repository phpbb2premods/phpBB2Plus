<?php

/***************************************************************************
 *                            lang_admin.php [English]
 *                              -------------------
 *     begin                : Sat Dec 16 2000
 *     copyright            : (C) 2001 The phpBB Group
 *     email                : support@phpbb.com
 *
 *     $Id: lang_admin.php,v 1.35.2.9 2003/06/10 00:31:19 psotfx Exp $
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

/* CONTRIBUTORS
	2002-12-15	Philip M. White (pwhite@mailhaven.com)
		Fixed many minor grammatical mistakes
*/

// phpBB2 Plus 1.5 Language File Build 123

//
// Format is same as lang_main
//

//
// Modules, this replaces the keys used
// in the modules[][] arrays in each module file
//
$lang['General'] = 'General Admin';
$lang['Users'] = 'User Admin';
$lang['Groups'] = 'Group Admin';
$lang['Forums'] = 'Forum Admin';
$lang['Styles'] = 'Styles Admin';

$lang['Configuration'] = 'Configuration';
$lang['Permissions'] = 'Permissions';
$lang['Manage'] = 'Management';
$lang['Disallow'] = 'Disallow names';
$lang['Prune'] = 'Pruning';
$lang['Mass_Email'] = 'Mass Email';
$lang['Ranks'] = 'Ranks';
$lang['Smilies'] = 'Smilies';
$lang['Ban_Management'] = 'Ban Control';
$lang['Word_Censor'] = 'Word Censors';
$lang['Export'] = 'Export';
$lang['Create_new'] = 'Create';
$lang['Add_new'] = 'Add';
$lang['Backup_DB'] = 'Backup Database';
$lang['Restore_DB'] = 'Restore Database';

//
// Custom Profile Fields MOD
//
$lang['custom_field_notice_admin'] = 'These items have been created by you or another administrator. For more information, check the items under the Profile Fields heading in the navbar. Items marked with a * are required fields. Items marked with a &dagger; are only being displayed to admins.';

$lang['field_deleted'] = 'The specified field has been deleted';
$lang['double_check_delete'] = 'Are you sure you want to delete profile field "%s" from the database permenantly?';

$lang['here'] = 'Here';
$lang['new_field_link'] = '<a href="'.append_sid("$filename?mode=add&pfid=x").'">%s</a>';
$lang['edit_field_link'] = '<a href="'.append_sid("$filename?mode=edit&pfid=x").'">%s</a>';
$lang['index_link'] = '<a href="'.append_sid("admin_profile_fields.$phpEx?mode=edit&pfid=x").'">%s</a>';
$lang['field_exists'] = 'This field already exists.<br /><br />You can try creating a ' . sprintf($lang['new_field_link'],'new') . ' profile field,<br /><br />or try ' . sprintf($lang['edit_field_link'],'editing') . ' the one you already have.';
$lang['click_here_here'] = 'Click ' . sprintf($lang['new_field_link'],$lang['here']) . ' to add another profile field,<br /><br />or click ' . sprintf($lang['index_link'],$lang['here']) . ' to return to the Admin Index.';
$lang['field_success'] = 'Field successfully submitted!<br /><br />' . $lang['click_here_here'];
$lang['Custom_Profile'] = 'Profile Fields';
$lang['profile_field_created'] = 'Profile Field Created';
$lang['profile_field_updated'] = 'Profile Field Updated';

$lang['add_field_title'] = 'Add Custom Profile Fields';
$lang['edit_field_title'] = 'Edit Custom Profile Fields';
$lang['add_field_explain'] = 'Here you can create new fields for your users to set in their profiles.';
$lang['edit_field_explain'] = 'Here you can edit fields you have already created for your users to set in their profiles.';

$lang['add_field_general'] = 'General Settings';
$lang['add_field_admin'] = 'Administrator Settings';
$lang['add_field_view'] = 'Viewing Settings';
$lang['add_field_text_field'] = 'Text Field Settings';
$lang['add_field_text_area'] = 'Text Area Settings';
$lang['add_field_radio_button'] = 'Radio Button Settings';
$lang['add_field_checkbox'] = 'Checkbox Settings';

$lang['default_value'] = 'Default Value';
$lang['default_value_explain'] = 'This is the default for this field. If a new user does not change this value, this is the value they will have. If this is a required field, this is the value that all existing users will be set to.';
$lang['default_value_radio_explain'] = 'Enter a name identical to one written in the available values field.';
$lang['default_value_checkbox_explain'] = 'Enter values that will default to checked. These values must match values in the available values field';
$lang['max_length'] = 'Maximum Length';
$lang['max_length_explain'] = 'This is the maximum length for this field.';
$lang['max_length_value'] = ' This must be a number between %d and %d.';
$lang['available_values'] = 'Available Values';
$lang['available_values_explain'] = 'Put each value on its own line';

$lang['add_field_view_disclaimer'] = 'All of these settings will be treated as "no" if users are not allowed to view this field';

$lang['add_field_name'] = 'Field Name';
$lang['add_field_name_explain'] = 'Enter the name you want to associate with this field.';
$lang['add_field_description'] = 'Field Description';
$lang['add_field_description_explain'] = 'Enter a description you wish to associate with this field. It will be displayed in small text below the field name, just like this text is.';
$lang['add_field_type'] = 'Field Type';
$lang['add_field_type_explain'] = 'Select the type of profile field you want to add. Examples of each field type are shown to the far right.';
$lang['edit_field_type_explain'] = 'Select the type of profile field you want to change this field to. Examples of each field type are shown to the far right.';
$lang['add_field_required'] = 'Set as Required';
$lang['add_field_required_explain'] = 'If the field is set to "Required", any user that registers later <strong>must</strong> fill it in, and all existing users will have it filled with a default value.';
$lang['add_field_user_can_view'] = 'Allow Users to View';
$lang['add_field_user_can_view_explain'] = 'If this is set to "yes", the user is allowed to view and edit this field. If it is set to "no", only Administrators may veiw or edit this value. Also, if this is set to "yes", this field cannot be required.';
$lang['view_in_profile'] = 'Viewable in User Profile';
$lang['profile_locations_explain'] = 'These options are for if this field is to be viewed in the user\'s profile.';
$lang['contacts_column'] = 'Contacts Column';
$lang['about_column'] = 'About Column';
$lang['view_in_memberlist'] = 'Viewable in Memeberlist';
$lang['view_in_topic'] = 'Viewable in Topic';
$lang['topic_locations_explain'] = 'These options are for if this field is to be viewed in a post.';
$lang['author_column'] = 'Author Section';
$lang['above'] = 'Above ';
$lang['below'] = 'Below ';

$lang['textarea'] = 'Textarea';
$lang['textarea_example'] = "This is an example\n   of a Textarea.";
$lang['text_field'] = 'Text Field';
$lang['text_field_example'] = 'This is an example of a Text Field';
$lang['radio'] = 'Radio Button';
$lang['radio_example'] = 'This is an example of two Radio Buttons';
$lang['checkbox'] = 'Checkbox';
$lang['checkbox_example'] = 'This is an example of two Checkboxes';

$lang['profile_field_list'] = 'Your Custom Profile Fields';
$lang['profile_field_list_explain'] = 'These are all of the custom profiles you have created for your board, with links to edit or delete them.';
$lang['profile_field_id'] = 'ID #';
$lang['profile_field_name'] = 'Field Name';
$lang['profile_field_action'] = 'Action';
$lang['no_profile_fields_exist'] = 'No Custom Profile Fields Exist.';

$lang['enter_a_name'] = 'You <strong>must</strong> enter a field name<br /><br />Press back and try again';
//
// END Custom Profile Fields MOD
//

//
// Index
//
$lang['Admin'] = 'Administration';
$lang['Not_admin'] = 'You are not authorised to administer this board';
$lang['Welcome_phpBB'] = 'Welcome to phpBB';
$lang['Main_index'] = 'Forum Index';
$lang['Forum_stats'] = 'Forum Statistics';
$lang['Admin_Index'] = 'Admin Index';
$lang['Preview_forum'] = 'Preview Forum';
$lang['Portal_index'] = 'Portal Index';
$lang['Preview_portal'] = 'Preview Portal';

$lang['Click_return_admin_index'] = 'Click %sHere%s to return to the Admin Index';

$lang['Statistic'] = 'Statistic';
$lang['Value'] = 'Value';
$lang['Number_posts'] = 'Number of posts';
$lang['Posts_per_day'] = 'Posts per day';
$lang['Number_topics'] = 'Number of topics';
$lang['Topics_per_day'] = 'Topics per day';
$lang['Number_users'] = 'Number of users';
$lang['Users_per_day'] = 'Users per day';
$lang['Board_started'] = 'Board started';
$lang['Avatar_dir_size'] = 'Avatar directory size';
$lang['Database_size'] = 'Database size';
$lang['Gzip_compression'] ='Gzip compression';
$lang['Not_available'] = 'Not available';

$lang['ON'] = 'ON'; // This is for GZip compression
$lang['OFF'] = 'OFF'; 

//
// DB Utils
//
$lang['Database_Utilities'] = 'Database Utilities';

$lang['Restore'] = 'Restore';
$lang['Backup'] = 'Backup';
$lang['Restore_explain'] = 'This will perform a full restore of all phpBB tables from a saved file. If your server supports it, you may upload a gzip-compressed text file and it will automatically be decompressed. <b>WARNING</b>: This will overwrite any existing data. The restore may take a long time to process, so please do not move from this page until it is complete.';
$lang['Backup_explain'] = 'Here you can back up all your phpBB-related data. If you have any additional custom tables in the same database with phpBB that you would like to back up as well, please enter their names, separated by commas, in the Additional Tables textbox below. If your server supports it you may also gzip-compress the file to reduce its size before download.';

$lang['Backup_options'] = 'Backup options';
$lang['Start_backup'] = 'Start Backup';
$lang['Full_backup'] = 'Full backup';
$lang['Structure_backup'] = 'Structure-Only backup';
$lang['Data_backup'] = 'Data only backup';
$lang['Additional_tables'] = 'Additional tables';
$lang['Gzip_compress'] = 'Gzip compress file';
$lang['Select_file'] = 'Select a file';
$lang['Start_Restore'] = 'Start Restore';

$lang['Restore_success'] = 'The Database has been successfully restored.<br /><br />Your board should be back to the state it was when the backup was made.';
$lang['Backup_download'] = 'Your download will start shortly; please wait until it begins.';
$lang['Backups_not_supported'] = 'Sorry, but database backups are not currently supported for your database system.';

$lang['Restore_Error_uploading'] = 'Error in uploading the backup file';
$lang['Restore_Error_filename'] = 'Filename problem; please try an alternative file';
$lang['Restore_Error_decompress'] = 'Cannot decompress a gzip file; please upload a plain text version';
$lang['Restore_Error_no_file'] = 'No file was uploaded';


//
// Auth pages
//
$lang['Select_a_User'] = 'Select a User';
$lang['Select_a_Group'] = 'Select a Group';
$lang['Select_a_Forum'] = 'Select a Forum';
$lang['Auth_Control_User'] = 'User Permissions Control'; 
$lang['Auth_Control_Group'] = 'Group Permissions Control'; 
$lang['Auth_Control_Forum'] = 'Forum Permissions Control'; 
$lang['Look_up_User'] = 'Look up User'; 
$lang['Look_up_Group'] = 'Look up Group'; 
$lang['Look_up_Forum'] = 'Look up Forum'; 

$lang['Group_auth_explain'] = 'Here you can alter the permissions and moderator status assigned to each user group. Do not forget when changing group permissions that individual user permissions may still allow the user entry to forums, etc. You will be warned if this is the case.';
$lang['User_auth_explain'] = 'Here you can alter the permissions and moderator status assigned to each individual user. Do not forget when changing user permissions that group permissions may still allow the user entry to forums, etc. You will be warned if this is the case.';
$lang['Forum_auth_explain'] = 'Here you can alter the authorisation levels of each forum. You will have both a simple and advanced method for doing this, where advanced offers greater control of each forum operation. Remember that changing the permission level of forums will affect which users can carry out the various operations within them.';

$lang['Simple_mode'] = 'Simple Mode';
$lang['Advanced_mode'] = 'Advanced Mode';
$lang['Moderator_status'] = 'Moderator status';

$lang['Allowed_Access'] = 'Allowed Access';
$lang['Disallowed_Access'] = 'Disallowed Access';
$lang['Is_Moderator'] = 'Is Moderator';
$lang['Not_Moderator'] = 'Not Moderator';

$lang['Conflict_warning'] = 'Authorisation Conflict Warning';
$lang['Conflict_access_userauth'] = 'This user still has access rights to this forum via group membership. You may want to alter the group permissions or remove this user the group to fully prevent them having access rights. The groups granting rights (and the forums involved) are noted below.';
$lang['Conflict_mod_userauth'] = 'This user still has moderator rights to this forum via group membership. You may want to alter the group permissions or remove this user the group to fully prevent them having moderator rights. The groups granting rights (and the forums involved) are noted below.';

$lang['Conflict_access_groupauth'] = 'The following user (or users) still have access rights to this forum via their user permission settings. You may want to alter the user permissions to fully prevent them having access rights. The users granted rights (and the forums involved) are noted below.';
$lang['Conflict_mod_groupauth'] = 'The following user (or users) still have moderator rights to this forum via their user permissions settings. You may want to alter the user permissions to fully prevent them having moderator rights. The users granted rights (and the forums involved) are noted below.';

$lang['Public'] = 'Public';
$lang['Private'] = 'Private';
$lang['Registered'] = 'Registered';
$lang['Administrators'] = 'Administrators';
$lang['Hidden'] = 'Hidden';

// These are displayed in the drop down boxes for advanced
// mode forum auth, try and keep them short!
$lang['Forum_ALL'] = 'ALL';
$lang['Forum_REG'] = 'REG';
$lang['Forum_PRIVATE'] = 'PRIVATE';
$lang['Forum_MOD'] = 'MOD';
$lang['Forum_ADMIN'] = 'ADMIN';

$lang['View'] = 'View';
$lang['Read'] = 'Read';
$lang['Post'] = 'Post';
$lang['Reply'] = 'Reply';
$lang['Edit'] = 'Edit';
$lang['Delete'] = 'Delete';
$lang['Sticky'] = 'Sticky';
$lang['Announce'] = 'Announce'; 
$lang['Vote'] = 'Vote';
$lang['Pollcreate'] = 'Poll create';

$lang['Permissions'] = 'Permissions';
$lang['Simple_Permission'] = 'Simple Permissions';

$lang['User_Level'] = 'User Level'; 
$lang['Auth_User'] = 'User';
$lang['Auth_Admin'] = 'Administrator';
$lang['Group_memberships'] = 'Usergroup memberships';
$lang['Usergroup_members'] = 'This group has the following members';

$lang['Forum_auth_updated'] = 'Forum permissions updated';
$lang['User_auth_updated'] = 'User permissions updated';
$lang['Group_auth_updated'] = 'Group permissions updated';

$lang['Auth_updated'] = 'Permissions have been updated';
$lang['Click_return_userauth'] = 'Click %sHere%s to return to User Permissions';
$lang['Click_return_groupauth'] = 'Click %sHere%s to return to Group Permissions';
$lang['Click_return_forumauth'] = 'Click %sHere%s to return to Forum Permissions';


//
// Banning
//
$lang['Ban_control'] = 'Ban Control';
$lang['Ban_explain'] = 'Here you can control the banning of users. You can achieve this by banning either or both of a specific user or an individual or range of IP addresses or hostnames. These methods prevent a user from even reaching the index page of your board. To prevent a user from registering under a different username you can also specify a banned email address. Please note that banning an email address alone will not prevent that user from being able to log on or post to your board. You should use one of the first two methods to achieve this.';
$lang['Ban_explain_warn'] = 'Please note that entering a range of IP addresses results in all the addresses between the start and end being added to the banlist. Attempts will be made to minimise the number of addresses added to the database by introducing wildcards automatically where appropriate. If you really must enter a range, try to keep it small or better yet state specific addresses.';

$lang['Select_username'] = 'Select a Username';
$lang['Select_ip'] = 'Select an IP address';
$lang['Select_email'] = 'Select an Email address';

$lang['Ban_username'] = 'Ban one or more specific users';
$lang['Ban_username_explain'] = 'You can ban multiple users in one go using the appropriate combination of mouse and keyboard for your computer and browser';

$lang['Ban_IP'] = 'Ban one or more IP addresses or hostnames';
$lang['IP_hostname'] = 'IP addresses or hostnames';
$lang['Ban_IP_explain'] = 'To specify several different IP addresses or hostnames separate them with commas. To specify a range of IP addresses, separate the start and end with a hyphen (-); to specify a wildcard, use an asterisk (*).';

$lang['Ban_email'] = 'Ban one or more email addresses';
$lang['Ban_email_explain'] = 'To specify more than one email address, separate them with commas. To specify a wildcard username, use * like *@hotmail.com';

$lang['Unban_username'] = 'Un-ban one more specific users';
$lang['Unban_username_explain'] = 'You can unban multiple users in one go using the appropriate combination of mouse and keyboard for your computer and browser';

$lang['Unban_IP'] = 'Un-ban one or more IP addresses';
$lang['Unban_IP_explain'] = 'You can unban multiple IP addresses in one go using the appropriate combination of mouse and keyboard for your computer and browser';

$lang['Unban_email'] = 'Un-ban one or more email addresses';
$lang['Unban_email_explain'] = 'You can unban multiple email addresses in one go using the appropriate combination of mouse and keyboard for your computer and browser';

$lang['No_banned_users'] = 'No banned usernames';
$lang['No_banned_ip'] = 'No banned IP addresses';
$lang['No_banned_email'] = 'No banned email addresses';

$lang['Ban_update_sucessful'] = 'The banlist has been updated successfully';
$lang['Click_return_banadmin'] = 'Click %sHere%s to return to Ban Control';


//
// Configuration
//
$lang['General_Config'] = 'General Configuration';
$lang['Config_explain'] = 'The form below will allow you to customize all the general board options. For User and Forum configurations use the related links on the left hand side.';

$lang['Click_return_config'] = 'Click %sHere%s to return to General Configuration';

$lang['General_settings'] = 'General Board Settings';
$lang['Server_name'] = 'Domain Name';
$lang['Server_name_explain'] = 'The domain name from which this board runs';
$lang['Script_path'] = 'Script path';
$lang['Script_path_explain'] = 'The path where phpBB2 is located relative to the domain name';
$lang['Server_port'] = 'Server Port';
$lang['Server_port_explain'] = 'The port your server is running on, usually 80. Only change if different';
$lang['Site_name'] = 'Site name';
$lang['Site_desc'] = 'Site description';
$lang['Board_disable'] = 'Disable board';
$lang['Board_disable_explain'] = 'This will make the board unavailable to users. Administrators are able to access the Administration Panel while the board is disabled.';
$lang['Acct_activation'] = 'Enable account activation';
$lang['Acc_None'] = 'None'; // These three entries are the type of activation
$lang['Acc_User'] = 'User';
$lang['Acc_Admin'] = 'Admin';

$lang['Abilities_settings'] = 'User and Forum Basic Settings';
$lang['Max_poll_options'] = 'Max number of poll options';
$lang['Flood_Interval'] = 'Flood Interval';
$lang['Flood_Interval_explain'] = 'Number of seconds a user must wait between posts'; 
$lang['Board_email_form'] = 'User email via board';
$lang['Board_email_form_explain'] = 'Users send email to each other via this board';
$lang['Topics_per_page'] = 'Topics Per Page';
$lang['Posts_per_page'] = 'Posts Per Page';
$lang['Hot_threshold'] = 'Posts for Popular Threshold';
$lang['Default_style'] = 'Default Style';
$lang['Override_style'] = 'Override user style';
$lang['Override_style_explain'] = 'Replaces users style with the default';
$lang['Default_language'] = 'Default Language';
$lang['Date_format'] = 'Date Format';
$lang['System_timezone'] = 'System Timezone';
$lang['Enable_gzip'] = 'Enable GZip Compression';
$lang['Enable_prune'] = 'Enable Forum Pruning';
$lang['Allow_HTML'] = 'Allow HTML';
$lang['Allow_BBCode'] = 'Allow BBCode';
$lang['Allowed_tags'] = 'Allowed HTML tags';
$lang['Allowed_tags_explain'] = 'Separate tags with commas';
$lang['Allow_smilies'] = 'Allow Smilies';
$lang['Smilies_path'] = 'Smilies Storage Path';
$lang['Smilies_path_explain'] = 'Path under your phpBB root dir, e.g. images/smiles';
$lang['Allow_sig'] = 'Allow Signatures';
$lang['Max_sig_length'] = 'Maximum signature length';
$lang['Max_sig_length_explain'] = 'Maximum number of characters in user signatures';
$lang['Allow_name_change'] = 'Allow Username changes';

$lang['Avatar_settings'] = 'Avatar Settings';
$lang['Allow_local'] = 'Enable gallery avatars';
$lang['Allow_remote'] = 'Enable remote avatars';
$lang['Allow_remote_explain'] = 'Avatars linked to from another website';
$lang['Allow_upload'] = 'Enable avatar uploading';
$lang['Max_filesize'] = 'Maximum Avatar File Size';
$lang['Max_filesize_explain'] = 'For uploaded avatar files';
$lang['Max_avatar_size'] = 'Maximum Avatar Dimensions';
$lang['Max_avatar_size_explain'] = '(Height x Width in pixels)';
$lang['Avatar_storage_path'] = 'Avatar Storage Path';
$lang['Avatar_storage_path_explain'] = 'Path under your phpBB root dir, e.g. images/avatars';
$lang['Avatar_gallery_path'] = 'Avatar Gallery Path';
$lang['Avatar_gallery_path_explain'] = 'Path under your phpBB root dir for pre-loaded images, e.g. images/avatars/gallery';

$lang['COPPA_settings'] = 'COPPA Settings';
$lang['COPPA_fax'] = 'COPPA Fax Number';
$lang['COPPA_mail'] = 'COPPA Mailing Address';
$lang['COPPA_mail_explain'] = 'This is the mailing address to which parents will send COPPA registration forms';

$lang['Email_settings'] = 'Email Settings';
$lang['Admin_email'] = 'Admin Email Address';
$lang['Email_sig'] = 'Email Signature';
$lang['Email_sig_explain'] = 'This text will be attached to all emails the board sends';
$lang['Use_SMTP'] = 'Use SMTP Server for email';
$lang['Use_SMTP_explain'] = 'Say yes if you want or have to send email via a named server instead of the local mail function';
$lang['SMTP_server'] = 'SMTP Server Address';
$lang['SMTP_username'] = 'SMTP Username';
$lang['SMTP_username_explain'] = 'Only enter a username if your SMTP server requires it';
$lang['SMTP_password'] = 'SMTP Password';
$lang['SMTP_password_explain'] = 'Only enter a password if your SMTP server requires it';

$lang['Disable_privmsg'] = 'Private Messaging';
$lang['Inbox_limits'] = 'Max posts in Inbox';
$lang['Sentbox_limits'] = 'Max posts in Sentbox';
$lang['Savebox_limits'] = 'Max posts in Savebox';

$lang['Cookie_settings'] = 'Cookie settings'; 
$lang['Cookie_settings_explain'] = 'These details define how cookies are sent to your users\' browsers. In most cases the default values for the cookie settings should be sufficient, but if you need to change them do so with care -- incorrect settings can prevent users from logging in';
$lang['Cookie_domain'] = 'Cookie domain';
$lang['Cookie_name'] = 'Cookie name';
$lang['Cookie_path'] = 'Cookie path';
$lang['Cookie_secure'] = 'Cookie secure';
$lang['Cookie_secure_explain'] = 'If your server is running via SSL, set this to enabled, else leave as disabled';
$lang['Session_length'] = 'Session length [ seconds ]';

// Visual Confirmation
$lang['Visual_confirm'] = 'Enable Visual Confirmation';
$lang['Visual_confirm_explain'] = 'Requires users enter a code defined by an image when registering.';

// Autologin Keys - added 2.0.18
$lang['Allow_autologin'] = 'Allow automatic logins';
$lang['Allow_autologin_explain'] = 'Determines whether users are allowed to select to be automatically logged in when visiting the forum';
$lang['Autologin_time'] = 'Automatic login key expiry';
$lang['Autologin_time_explain'] = 'How long a autologin key is valid for in days if the user does not visit the board. Set to zero to disable expiry.';

// Search Flood Control - added 2.0.20
$lang['Search_Flood_Interval'] = 'Search Flood Interval';
$lang['Search_Flood_Interval_explain'] = 'Number of seconds a user must wait between search requests'; 

//
// Forum Management
//
$lang['Forum_admin'] = 'Forum Administration';
$lang['Forum_admin_explain'] = 'From this panel you can add, delete, edit, re-order and re-synchronise categories and forums';
$lang['Edit_forum'] = 'Edit forum';
$lang['Create_forum'] = 'Create new forum';
$lang['Create_category'] = 'Create new category';
$lang['Remove'] = 'Remove';
$lang['Action'] = 'Action';
$lang['Update_order'] = 'Update Order';
$lang['Config_updated'] = 'Forum Configuration Updated Successfully';
$lang['Edit'] = 'Edit';
$lang['Delete'] = 'Delete';
$lang['Move_up'] = 'Move up';
$lang['Move_down'] = 'Move down';
$lang['Resync'] = 'Resync';
$lang['No_mode'] = 'No mode was set';
$lang['Forum_edit_delete_explain'] = 'The form below will allow you to customize all the general board options. For User and Forum configurations use the related links on the left hand side';

$lang['Move_contents'] = 'Move all contents';
$lang['Forum_delete'] = 'Delete Forum';
$lang['Forum_delete_explain'] = 'The form below will allow you to delete a forum (or category) and decide where you want to put all topics (or forums) it contained.';

$lang['Status_locked'] = 'Locked';
$lang['Status_unlocked'] = 'Unlocked';
$lang['Forum_settings'] = 'General Forum Settings';
$lang['Forum_name'] = 'Forum name';
$lang['Forum_desc'] = 'Description';
$lang['Forum_status'] = 'Forum status';
$lang['Forum_pruning'] = 'Auto-pruning';

$lang['prune_freq'] = 'Check for topic age every';
$lang['prune_days'] = 'Remove topics that have not been posted to in';
$lang['Set_prune_data'] = 'You have turned on auto-prune for this forum but did not set a frequency or number of days to prune. Please go back and do so.';

$lang['Move_and_Delete'] = 'Move and Delete';

$lang['Delete_all_posts'] = 'Delete all posts';
$lang['Nowhere_to_move'] = 'Nowhere to move to';

$lang['Edit_Category'] = 'Edit Category';
$lang['Edit_Category_explain'] = 'Use this form to modify a category\'s name.';

$lang['Forums_updated'] = 'Forum and Category information updated successfully';

$lang['Must_delete_forums'] = 'You need to delete all forums before you can delete this category';

$lang['Click_return_forumadmin'] = 'Click %sHere%s to return to Forum Administration';


//
// Smiley Management
//
$lang['smiley_title'] = 'Smiles Editing Utility';
$lang['smile_desc'] = 'From this page you can add, remove and edit the emoticons or smileys that your users can use in their posts and private messages.';

$lang['smiley_config'] = 'Smiley Configuration';
$lang['smiley_code'] = 'Smiley Code';
$lang['smiley_url'] = 'Smiley Image File';
$lang['smiley_emot'] = 'Smiley Emotion';
$lang['smile_add'] = 'Add a new Smiley';
$lang['Smile'] = 'Smile';
$lang['Emotion'] = 'Emotion';

$lang['Select_pak'] = 'Select Pack (.pak) File';
$lang['replace_existing'] = 'Replace Existing Smiley';
$lang['keep_existing'] = 'Keep Existing Smiley';
$lang['smiley_import_inst'] = 'You should unzip the smiley package and upload all files to the appropriate Smiley directory for your installation. Then select the correct information in this form to import the smiley pack.';
$lang['smiley_import'] = 'Smiley Pack Import';
$lang['choose_smile_pak'] = 'Choose a Smile Pack .pak file';
$lang['import'] = 'Import Smileys';
$lang['smile_conflicts'] = 'What should be done in case of conflicts';
$lang['del_existing_smileys'] = 'Delete existing smileys before import';
$lang['import_smile_pack'] = 'Import Smiley Pack';
$lang['export_smile_pack'] = 'Create Smiley Pack';
$lang['export_smiles'] = 'To create a smiley pack from your currently installed smileys, click %sHere%s to download the smiles.pak file. Name this file appropriately making sure to keep the .pak file extension.  Then create a zip file containing all of your smiley images plus this .pak configuration file.';

$lang['smiley_add_success'] = 'The Smiley was successfully added';
$lang['smiley_edit_success'] = 'The Smiley was successfully updated';
$lang['smiley_import_success'] = 'The Smiley Pack was imported successfully!';
$lang['smiley_del_success'] = 'The Smiley was successfully removed';
$lang['Click_return_smileadmin'] = 'Click %sHere%s to return to Smiley Administration';

$lang['Confirm_delete_smiley'] = 'Are you sure you want to delete this Smiley?';

//
// User Management
//
$lang['User_admin'] = 'User Administration';
$lang['User_admin_explain'] = 'Here you can change your users\' information and certain options. To modify the users\' permissions, please use the user and group permissions system.';

$lang['Look_up_user'] = 'Look up user';

$lang['Admin_user_fail'] = 'Couldn\'t update the user\'s profile.';
$lang['Admin_user_updated'] = 'The user\'s profile was successfully updated.';
$lang['Click_return_useradmin'] = 'Click %sHere%s to return to User Administration';

$lang['User_delete'] = 'Delete this user';
$lang['User_delete_explain'] = 'Click here to delete this user; this cannot be undone.';
$lang['User_deleted'] = 'User was successfully deleted.';

$lang['User_status'] = 'User is active';
$lang['User_allowpm'] = 'Can send Private Messages';
$lang['User_allowavatar'] = 'Can display avatar';

$lang['Admin_avatar_explain'] = 'Here you can see and delete the user\'s current avatar.';

$lang['User_special'] = 'Special admin-only fields';
$lang['User_special_explain'] = 'These fields are not able to be modified by the users.  Here you can set their status and other options that are not given to users.';


//
// Group Management
//
$lang['Group_administration'] = 'Group Administration';
$lang['Group_admin_explain'] = 'From this panel you can administer all your usergroups. You can delete, create and edit existing groups. You may choose moderators, toggle open/closed group status and set the group name and description';
$lang['Error_updating_groups'] = 'There was an error while updating the groups';
$lang['Updated_group'] = 'The group was successfully updated';
$lang['Added_new_group'] = 'The new group was successfully created';
$lang['Deleted_group'] = 'The group was successfully deleted';
$lang['New_group'] = 'Create new group';
$lang['Edit_group'] = 'Edit group';
$lang['group_name'] = 'Group name';
$lang['group_description'] = 'Group description';
$lang['group_moderator'] = 'Group moderator';
$lang['group_status'] = 'Group status';
$lang['group_open'] = 'Open group';
$lang['group_closed'] = 'Closed group';
$lang['group_hidden'] = 'Hidden group';
$lang['group_delete'] = 'Delete group';
$lang['group_delete_check'] = 'Delete this group';
$lang['submit_group_changes'] = 'Submit Changes';
$lang['reset_group_changes'] = 'Reset Changes';
$lang['No_group_name'] = 'You must specify a name for this group';
$lang['No_group_moderator'] = 'You must specify a moderator for this group';
$lang['No_group_mode'] = 'You must specify a mode for this group, open or closed';
$lang['No_group_action'] = 'No action was specified';
$lang['delete_group_moderator'] = 'Delete the old group moderator?';
$lang['delete_moderator_explain'] = 'If you\'re changing the group moderator, check this box to remove the old moderator from the group.  Otherwise, do not check it, and the user will become a regular member of the group.';
$lang['Click_return_groupsadmin'] = 'Click %sHere%s to return to Group Administration.';
$lang['Select_group'] = 'Select a group';
$lang['Look_up_group'] = 'Look up group';


//
// Prune Administration
//
$lang['Forum_Prune'] = 'Forum Prune';
$lang['Forum_Prune_explain'] = 'This will delete any topic which has not been posted to within the number of days you select. If you do not enter a number then all topics will be deleted. It will not remove topics in which polls are still running nor will it remove announcements. You will need to remove those topics manually.';
$lang['Do_Prune'] = 'Do Prune';
$lang['All_Forums'] = 'All Forums';
$lang['Prune_topics_not_posted'] = 'Prune topics with no replies in this many days';
$lang['Topics_pruned'] = 'Topics pruned';
$lang['Posts_pruned'] = 'Posts pruned';
$lang['Prune_success'] = 'Pruning of forums was successful';


//
// Word censor
//
$lang['Words_title'] = 'Word Censoring';
$lang['Words_explain'] = 'From this control panel you can add, edit, and remove words that will be automatically censored on your forums. In addition people will not be allowed to register with usernames containing these words. Wildcards (*) are accepted in the word field. For example, *test* will match detestable, test* would match testing, *test would match detest.';
$lang['Word'] = 'Word';
$lang['Edit_word_censor'] = 'Edit word censor';
$lang['Replacement'] = 'Replacement';
$lang['Add_new_word'] = 'Add new word';
$lang['Update_word'] = 'Update word censor';

$lang['Must_enter_word'] = 'You must enter a word and its replacement';
$lang['No_word_selected'] = 'No word selected for editing';

$lang['Word_updated'] = 'The selected word censor has been successfully updated';
$lang['Word_added'] = 'The word censor has been successfully added';
$lang['Word_removed'] = 'The selected word censor has been successfully removed';

$lang['Click_return_wordadmin'] = 'Click %sHere%s to return to Word Censor Administration';

$lang['Confirm_delete_word'] = 'Are you sure you want to delete this word censor?';


//
// Mass Email
//
$lang['Mass_email_explain'] = 'Here you can email a message to either all of your users or all users of a specific group.  To do this, an email will be sent out to the administrative email address supplied, with a blind carbon copy sent to all recipients. If you are emailing a large group of people please be patient after submitting and do not stop the page halfway through. It is normal for a mass emailing to take a long time and you will be notified when the script has completed';
$lang['Compose'] = 'Compose'; 

$lang['Recipients'] = 'Recipients'; 
$lang['All_users'] = 'All Users';

$lang['Email_successfull'] = 'Your message has been sent';
$lang['Click_return_massemail'] = 'Click %sHere%s to return to the Mass Email form';


//
// Ranks admin
//
$lang['Ranks_title'] = 'Rank Administration';
$lang['Ranks_explain'] = 'Using this form you can add, edit, view and delete ranks. You can also create custom ranks which can be applied to a user via the user management facility';

$lang['Add_new_rank'] = 'Add new rank';

$lang['Rank_title'] = 'Rank Title';
$lang['Rank_special'] = 'Set as Special Rank';
$lang['Rank_minimum'] = 'Minimum Posts';
$lang['Rank_maximum'] = 'Maximum Posts';
$lang['Rank_image'] = 'Rank Image (Relative to phpBB2 root path)';
$lang['Rank_image_explain'] = 'Use this to define a small image associated with the rank';

$lang['Must_select_rank'] = 'You must select a rank';
$lang['No_assigned_rank'] = 'No special rank assigned';

$lang['Rank_updated'] = 'The rank was successfully updated';
$lang['Rank_added'] = 'The rank was successfully added';
$lang['Rank_removed'] = 'The rank was successfully deleted';
$lang['No_update_ranks'] = 'The rank was successfully deleted. However, user accounts using this rank were not updated.  You will need to manually reset the rank on these accounts';

$lang['Click_return_rankadmin'] = 'Click %sHere%s to return to Rank Administration';

$lang['Confirm_delete_rank'] = 'Are you sure you want to delete this rank?';


//
// Disallow Username Admin
//
$lang['Disallow_control'] = 'Username Disallow Control';
$lang['Disallow_explain'] = 'Here you can control usernames which will not be allowed to be used.  Disallowed usernames are allowed to contain a wildcard character of *.  Please note that you will not be allowed to specify any username that has already been registered. You must first delete that name then disallow it.';

$lang['Delete_disallow'] = 'Delete';
$lang['Delete_disallow_title'] = 'Remove a Disallowed Username';
$lang['Delete_disallow_explain'] = 'You can remove a disallowed username by selecting the username from this list and clicking submit';

$lang['Add_disallow'] = 'Add';
$lang['Add_disallow_title'] = 'Add a disallowed username';
$lang['Add_disallow_explain'] = 'You can disallow a username using the wildcard character * to match any character';

$lang['No_disallowed'] = 'No Disallowed Usernames';

$lang['Disallowed_deleted'] = 'The disallowed username has been successfully removed';
$lang['Disallow_successful'] = 'The disallowed username has been successfully added';
$lang['Disallowed_already'] = 'The name you entered could not be disallowed. It either already exists in the list, exists in the word censor list, or a matching username is present.';

$lang['Click_return_disallowadmin'] = 'Click %sHere%s to return to Disallow Username Administration';


//
// Styles Admin
//
$lang['Styles_admin'] = 'Styles Administration';
$lang['Styles_explain'] = 'Using this facility you can add, remove and manage styles (templates and themes) available to your users';
$lang['Styles_addnew_explain'] = 'The following list contains all the themes that are available for the templates you currently have. The items on this list have not yet been installed into the phpBB database. To install a theme, simply click the install link beside an entry.';

$lang['Select_template'] = 'Select a Template';

$lang['Style'] = 'Style';
$lang['Template'] = 'Template';
$lang['Install'] = 'Install';
$lang['Download'] = 'Download';

$lang['Edit_theme'] = 'Edit Theme';
$lang['Edit_theme_explain'] = 'In the form below you can edit the settings for the selected theme';

$lang['Create_theme'] = 'Create Theme';
$lang['Create_theme_explain'] = 'Use the form below to create a new theme for a selected template. When entering colours (for which you should use hexadecimal notation) you must not include the initial #, i.e.. CCCCCC is valid, #CCCCCC is not';

$lang['Export_themes'] = 'Export Themes';
$lang['Export_explain'] = 'In this panel you will be able to export the theme data for a selected template. Select the template from the list below and the script will create the theme configuration file and attempt to save it to the selected template directory. If it cannot save the file itself it will give you the option to download it. In order for the script to save the file you must give write access to the webserver for the selected template dir. For more information on this see the phpBB 2 users guide.';

$lang['Theme_installed'] = 'The selected theme has been installed successfully';
$lang['Style_removed'] = 'The selected style has been removed from the database. To fully remove this style from your system you must delete the appropriate style from your templates directory.';
$lang['Theme_info_saved'] = 'The theme information for the selected template has been saved. You should now return the permissions on the theme_info.cfg (and if applicable the selected template directory) to read-only';
$lang['Theme_updated'] = 'The selected theme has been updated. You should now export the new theme settings';
$lang['Theme_created'] = 'Theme created. You should now export the theme to the theme configuration file for safe keeping or use elsewhere';

$lang['Confirm_delete_style'] = 'Are you sure you want to delete this style?';

$lang['Download_theme_cfg'] = 'The exporter could not write the theme information file. Click the button below to download this file with your browser. Once you have downloaded it you can transfer it to the directory containing the template files. You can then package the files for distribution or use elsewhere if you desire';
$lang['No_themes'] = 'The template you selected has no themes attached to it. To create a new theme click the Create New link on the left hand panel';
$lang['No_template_dir'] = 'Could not open the template directory. It may be unreadable by the webserver or may not exist';
$lang['Cannot_remove_style'] = 'You cannot remove the style selected since it is currently the forum default. Please change the default style and try again.';
$lang['Style_exists'] = 'The style name to selected already exists, please go back and choose a different name.';

$lang['Click_return_styleadmin'] = 'Click %sHere%s to return to Style Administration';

$lang['Theme_settings'] = 'Theme Settings';
$lang['Theme_element'] = 'Theme Element';
$lang['Simple_name'] = 'Simple Name';
$lang['Value'] = 'Value';
$lang['Save_Settings'] = 'Save Settings';

$lang['Stylesheet'] = 'CSS Stylesheet';
$lang['Stylesheet_explain'] = 'Filename for CSS stylesheet to use for this theme.';
$lang['Background_image'] = 'Background Image';
$lang['Background_color'] = 'Background Colour';
$lang['Theme_name'] = 'Theme Name';
$lang['Link_color'] = 'Link Colour';
$lang['Text_color'] = 'Text Colour';
$lang['VLink_color'] = 'Visited Link Colour';
$lang['ALink_color'] = 'Active Link Colour';
$lang['HLink_color'] = 'Hover Link Colour';
$lang['Tr_color1'] = 'Table Row Colour 1';
$lang['Tr_color2'] = 'Table Row Colour 2';
$lang['Tr_color3'] = 'Table Row Colour 3';
$lang['Tr_class1'] = 'Table Row Class 1';
$lang['Tr_class2'] = 'Table Row Class 2';
$lang['Tr_class3'] = 'Table Row Class 3';
$lang['Th_color1'] = 'Table Header Colour 1';
$lang['Th_color2'] = 'Table Header Colour 2';
$lang['Th_color3'] = 'Table Header Colour 3';
$lang['Th_class1'] = 'Table Header Class 1';
$lang['Th_class2'] = 'Table Header Class 2';
$lang['Th_class3'] = 'Table Header Class 3';
$lang['Td_color1'] = 'Table Cell Colour 1';
$lang['Td_color2'] = 'Table Cell Colour 2';
$lang['Td_color3'] = 'Table Cell Colour 3';
$lang['Td_class1'] = 'Table Cell Class 1';
$lang['Td_class2'] = 'Table Cell Class 2';
$lang['Td_class3'] = 'Table Cell Class 3';
$lang['fontface1'] = 'Font Face 1';
$lang['fontface2'] = 'Font Face 2';
$lang['fontface3'] = 'Font Face 3';
$lang['fontsize1'] = 'Font Size 1';
$lang['fontsize2'] = 'Font Size 2';
$lang['fontsize3'] = 'Font Size 3';
$lang['fontcolor1'] = 'Font Colour 1';
$lang['fontcolor2'] = 'Font Colour 2';
$lang['fontcolor3'] = 'Font Colour 3';
$lang['span_class1'] = 'Span Class 1';
$lang['span_class2'] = 'Span Class 2';
$lang['span_class3'] = 'Span Class 3';
$lang['img_poll_size'] = 'Polling Image Size [px]';
$lang['img_pm_size'] = 'Private Message Status size [px]';


//
// Install Process
//
$lang['Initial_config'] = 'Basic Configuration';
$lang['DB_config'] = 'Database Configuration';
$lang['Admin_config'] = 'Admin Configuration';
$lang['continue_upgrade'] = 'Once you have downloaded your config file to your local machine you may\'Continue Upgrade\' button below to move forward with the upgrade process.  Please wait to upload the config file until the upgrade process is complete.';
$lang['upgrade_submit'] = 'Continue Upgrade';

$lang['Installer_Error'] = 'An error has occurred during installation';
$lang['Previous_Install'] = 'A previous installation has been detected';
$lang['Install_db_error'] = 'An error occurred trying to update the database';

$lang['Re_install'] = 'Your previous installation is still active.<br /><br />If you would like to re-install phpBB 2 you should click the Yes button below. Please be aware that doing so will destroy all existing data and no backups will be made! The administrator username and password you have used to login in to the board will be re-created after the re-installation and no other settings will be retained.<br /><br />Think carefully before pressing Yes!';

$lang['Start_Install'] = 'Start Install';
$lang['Finish_Install'] = 'Finish Installation';

$lang['Default_lang'] = 'Default board language';
$lang['DB_Host'] = 'Database Server Hostname / DSN';
$lang['DB_Name'] = 'Your Database Name';
$lang['DB_Username'] = 'Database Username';
$lang['DB_Password'] = 'Database Password';
$lang['Database'] = 'Your Database';
$lang['Install_lang'] = 'Choose Language for Installation';
$lang['dbms'] = 'Database Type';
$lang['Table_Prefix'] = 'Prefix for tables in database';
$lang['Admin_Username'] = 'Administrator Username';
$lang['Admin_Password'] = 'Administrator Password';
$lang['Admin_Password_confirm'] = 'Administrator Password [ Confirm ]';

$lang['Inst_Step_2'] = 'Your admin username has been created.  At this point your basic installation is complete. You will now be taken to a screen which will allow you to administer your new installation. Please be sure to check the General Configuration details and make any required changes. Thank you for choosing phpBB 2.';

$lang['Unwriteable_config'] = 'Your config file is un-writeable at present. A copy of the config file will be downloaded to your computer when you click the button below. You should upload this file to the same directory as phpBB 2. Once this is done you should log in using the administrator name and password you provided on the previous form and visit the admin control center (a link will appear at the bottom of each screen once logged in) to check the general configuration. Thank you for choosing phpBB 2.';
$lang['Download_config'] = 'Download Config';

$lang['ftp_choose'] = 'Choose Download Method';
$lang['ftp_option'] = '<br />Since FTP extensions are enabled in this version of PHP you may also be given the option of first trying to automatically FTP the config file into place.';
$lang['ftp_instructs'] = 'You have chosen to FTP the file to the account containing phpBB 2 automatically.  Please enter the information below to facilitate this process. Note that the FTP path should be the exact path via FTP to your phpBB2 installation as if you were FTPing to it using any normal client.';
$lang['ftp_info'] = 'Enter Your FTP Information';
$lang['Attempt_ftp'] = 'Attempt to FTP config file into place';
$lang['Send_file'] = 'Just send the file to me and I\'ll FTP it manually';
$lang['ftp_path'] = 'FTP path to phpBB 2';
$lang['ftp_username'] = 'Your FTP Username';
$lang['ftp_password'] = 'Your FTP Password';
$lang['Transfer_config'] = 'Start Transfer';
$lang['NoFTP_config'] = 'The attempt to FTP the config file into place failed.  Please download the config file and FTP it into place manually.';

$lang['Install'] = 'Install';
$lang['Upgrade'] = 'Upgrade';


$lang['Install_Method'] = 'Choose your installation method';

$lang['Install_No_Ext'] = 'The PHP configuration on your server doesn\'t support the database type that you chose';

$lang['Install_No_PCRE'] = 'phpBB2 Requires the Perl-Compatible Regular Expressions Module for PHP which your PHP configuration doesn\'t appear to support!';

// Additional Stuff for phpBB2 Plus only ! Translators should get original Language Files for phpBB 2.0.8
// for the language they want to translate from http://www.phpbb.com/downloads.php. Then they need to translate 
// the following stuff only and use the rest from the original language files !

// Start add - Birthday MOD
$lang['Birthday_required'] = 'Force users to submit a birthday';
$lang['Enable_birthday_greeting'] = 'Enable birthday greetings';
$lang['Birthday_greeting_expain'] = 'Users who have submitted a birthday can have a birthday greeting, when thy visit the board';
$lang['Next_birthday_greeting'] = 'Next birthday popup year';
$lang['Next_birthday_greeting_expain'] = 'This field keeps track of the next year the user shall have a birthday greeting';
$lang['Wrong_next_birthday_greeting'] = 'The supplied, next birthday popup year, was not valid, please try again';
$lang['Max_user_age'] = 'Maximum user age';
$lang['Min_user_age'] = 'Minimum user age';
$lang['Birthday_lookforward'] = 'Birthday look forward';
$lang['Birthday_lookforward_explain'] = 'Number of days the script shall look forward for users with a birthday';
// End add - Birthday MOD

// Start add - Last visit MOD
$lang['Hidde_last_logon'] = "Hidden last logon time"; 
$lang['Hidde_last_logon_expain'] = "If this is set to yes, users last logon time, is hidden to other users except administrators"; 
// End add - Last visit MOD

// FLAGHACK-start
$lang['Flags'] = 'Flags';
$lang['Flags_title'] = 'Flag Administration';
$lang['Flags_explain'] = 'Using this form you can add, edit, view and delete flags. You can also create custom flags which can be applied to a user via the user management facility';
$lang['Add_new_flag'] = 'Add new flag';
$lang['Flag_name'] = 'Flag Name';
$lang['Flag_pic'] = 'Image';
$lang['Flag_image'] = 'Flag Image (in the images/flags/ directory)';
$lang['Flag_image_explain'] = 'Use this to define a small image associated with the flag';
$lang['Must_select_flag'] = 'You must select a flag';
$lang['Flag_updated'] = 'The flag was successfully updated';
$lang['Flag_added'] = 'The flag was successfully added';
$lang['Flag_removed'] = 'The flag was successfully deleted';
$lang['No_update_flags'] = 'The flag was successfully deleted. However, user accounts using this flag were not updated.  You will need to manually reset the flag on these accounts';
$lang['Flag_confirm'] = 'Delete Flag' ;
$lang['Confirm_delete_flag'] = 'Are you sure you want to remove the selected flag?' ;
$lang['Click_return_flagadmin'] = 'Click %sHere%s to return to Flag Administration';
// FLAGHACK-end

// Start Additional Language Stuff phpBB2 Plus specific
$lang['Plus_Settings'] = 'phpBB2 Plus Settings';
$lang['Enable_indexlinks'] = 'Show Links in Index';
$lang['Indexlinks_explain'] = 'You can enable or disable the Links Display in the Forums index';
$lang['General_Plusconfig'] = 'phpBB2 Plus Configuration';
$lang['Plusconfig_explain'] = 'You can do phpBB2 Plus specific Settings here';
$lang['Select_Layout'] = 'Select Index Layout';
$lang['Index_Layout'] = 'Configuration phpBB2 Plus';
$lang['Plusstyle_explain'] = 'You can select the Layout of the Forum Index here. You can set the phpBB2 Plus Layout (Live Statistics Box on the right site) or you can use the default phpBB2 Index Layout (No Live Statistics Box).';
$lang['Plusstyle1'] = 'phpBB2 Default';
$lang['Plusstyle2'] = 'Plus Default';
$lang['Plusstyle3'] = 'N/A';
$lang['Enable_defaultavatar'] = 'Default Avatar';
$lang['Defaultavatar_explain'] = 'You can choose if a Default Avatar is shown in Topics for Users that have not set a Avatar in their Profile. You must copy the Image which should be the default Avatar as default_avatar.gif into the directory /images';
$lang['Enable_quickreply'] = 'Enable Quickreply Mod';
$lang['Quickreply_explain'] = 'You can enable or disable the display of the Quick Reply Mod in the Viewtopic';
$lang['Enable_shoutbox'] = 'Enable Shoutbox';
$lang['Shoutbox_explain'] = 'You can enable or disable the display of the Shoutbox Mod';
$lang['Shoutbox_yes_reg'] = 'On, only for registered';
$lang['Shoutbox_portal'] = 'Only Portal';
$lang['Shoutbox_portal_reg'] = 'Only Portal (REG)';
$lang['Shoutbox_index'] = 'Only Index';
$lang['Shoutbox_index_reg'] = 'Only Index (REG)';
$lang['Shoutbox_yes'] = 'On';
$lang['Shoutbox_no'] = 'Off';
$lang['Enable_Lastvisit'] = 'Enable Last Visit Display in Forum';
$lang['Lastvisit_explain'] = 'You can enable or disable the display of the Today Users (Last Visit Mod) in the Forum index';
$lang['Lastvisit_24guest'] = 'Whole Day + Guests(!!more Load)'; 
$lang['Enable_Gentime'] = 'Enable Page Generation Statistics in Footer';
$lang['Gentime_Explain'] = 'You can enable or disable the display of Page Generation Time Statistics in the Forums Footer. It shows PHP and SQL Statistics';
$lang['Enable_Bannerhack'] = 'Enable Banner MOD';
$lang['Bannerhack_explain'] = 'You can enable or disable the Bannermod MOD';
$lang['Confirm_code_guestpost'] = 'Enable Visual Confirmation for guest posts';
$lang['Confirm_guestpost_Explain'] = 'Requires guests enter a code defined by an image when sending a post.';
$lang['Fulltext_Config'] = 'Enable MySQL Fulltext Search';
$lang['Fulltext_Explain'] = 'If you have first run (one-time) this query in youre Database, you can use the fulltext search of MySQL.';
// End additional Language Stuff phpBB2 Plus specific 

//
// Bookmark Mod
//
$lang['Max_bookmarks_links'] = 'Maximum bookmarks send in link-tag';
$lang['Max_bookmarks_links_explain'] = 'Number of bookmarks maximal send in link-tag at the beginning of the document. This information is e.g. used by Mozilla. Enter 0 to disable this function.';

// Admin Account Actions Mod
$lang['Deleted_user'] = "User with ID No. #%d deleted"; //%d = user id
$lang['Activate_title'] = 'Account Actions';
$lang['Reg_date'] = 'Joined';
$lang['Activate'] = 'Activate';
$lang['Actions'] = 'Actions';
$lang['Waiting_1'] = '(awaits activation since %d day)'; // %d = day
$lang['Waiting_2'] = '(awaits activation since %d days)'; // %d = days
$lang['No_users'] = 'There is no user who awaits an activation.';
$lang['Total_member'] = '<b>%d</b> user awaits activation.';
$lang['Total_members'] = '<b>%d</b> users await activation.';

// Start add - Fully integrated shoutbox MOD
$lang['Prune_shouts'] = 'Auto prune shouts'; 
$lang['Prune_shouts_explain'] = 'Number of days, before the shouts are deleted, if a value of 0 is submittd, autoprune will be disabled'; 
// End add - Fully integrated shoutbox MOD

//
// mod : ezportal Admin
//
$lang['EZPortal_Config'] = 'EZPortal Configuration';
$lang['EZPortal_Portal_settings'] = 'EZPortal Settings';
$lang['Welcome_Text'] = 'Welcome Message';
$lang['Number_of_News'] = 'Number of News';
$lang['News_length'] = 'News length';
$lang['News_Forum'] = 'News forum(s)';
$lang['Poll_Forum'] = 'Poll forum(s)';
$lang['Number_Recent_Topics'] = 'Number of recent topics';
$lang['Number_Recent_Files'] = 'Number of recent files';
$lang['Last_Seen'] = 'Last seen users on forum';
$lang['Comma'] = 'Separate forum ID(s) with a comma. If you leave this field empty or set it to 0, the poll block in Portal will not be displayed.';
$lang['Exceptional_Forum'] = 'Exceptional Forum(s) for Recent Topics, eg. 2,4,10';
$lang['Exceptional_Comma'] = 'Enter Forum ID(s) from Forums you <b>dont</b> want to see Topics in Recent Topics Block in Portal.';
$lang['Picture_cat_id'] = 'Categories you wish to display Recent Pics out of. Set this to 0 to display from all categories';
$lang['Picture_number'] = 'Number of Pictures to display on Portal';
$lang['Picture_all'] = 'Do you also wan\'t personal Categories to be displayed ? If set to no, only public Pics will be displayed.';
$lang['Picture_sort'] = 'Do you wan\'t to display random Pics ? If set to no, only newest Pics will be displayed.';
$lang['Recent_Pic_Settings'] = 'Settings for Recent Pictures on Portal';
$lang['Pic_Comma'] = 'Separate Categories with a comma';
//
//  END ezportal Admin
//
// Start add - Yellow card admin MOD
$lang['Ban'] = 'Ban'; 
$lang['Max_user_bancard'] = 'Maximum number of warnings'; 
$lang['Max_user_bancard_explain'] = 'If a user gets more yellow cards than this limit, the user will be banned'; 
$lang['ban_card'] = 'Yellow card'; 
$lang['ban_card_explain'] = 'The user will be banned when he/she is in excess of %d yellow cards'; 
$lang['Greencard'] = 'Un-ban'; 
$lang['Bluecard'] = 'Post report'; 
$lang['Bluecard_limit'] = 'Interval of bluecard'; 
$lang['Bluecard_limit_explain'] = 'Notify the moderators again for every x bluecards given to a post'; 
$lang['Bluecard_limit_2'] = 'Limit of bluecard'; 
$lang['Bluecard_limit_2_explain'] = 'First notification to moderators is sent, when a post get this amount of blue cards'; 
$lang['Report_forum']= 'Report forum';
$lang['Report_forum_explain'] = 'Fill with the forum ID where users reports are to be posted, a value of 0 will disable this feature, users MUST at least have post/reply access to this forum';

// Start add - Protect user account MOD
$lang['user_password_settings'] = 'User Password Settings'; 
$lang['Max_login_error'] = 'Number of attempts before blocking user'; 
$lang['Max_login_error_explain'] = 'If a user submits a wrong password repeatedly, then his/her account will be blocked for a specific amount of time. Indicate how many wrong passwords a user can type before his/her account is blocked';
$lang['Block_time'] = 'Block account time'; 
$lang['Block_time_explain'] = 'Number of minutes the user\'s account is blocked for if a wrong password is submitted repeatedly more than the amount specified in "Block user on wrong login"'; 
$lang['Password_complex'] = 'Complex Password'; 
$lang['Password_complex_explain'] = 'Users password must consist of both alpha and numeric characters'; 
$lang['Password_len'] = 'Minimum password length'; 
$lang['Password_len_explain'] = 'Valid range is [ 1 - 32 ]'; 
$lang['Password_not_login'] = 'Password different from Username'; 
$lang['Password_not_login_explain'] = 'Password must be different than the Username'; 
$lang['Account_block'] = 'Account blocked'; 
$lang['Account_block_explain'] = 'Here you can view/set or reset users block information'; 
$lang['Block_until'] ='Blocked until: %s';// %s is substituded with the date/time 
$lang['Block_by'] = 'Blocked by IP: %s';// %s is substituded with the ip addr. 
$lang['Last_block_by'] = 'Last blocked by IP: %s';// %s is substituded with the ip addr. 
$lang['Unblock_user'] ='Unblock user account'; 
$lang['Block_user'] ='Block user account for %s min';// %s is substituded with the date/time 
$lang['Badlogin_count'] = 'Number of bad login'; 
$lang['Force_new_passwd'] = 'Force user to change password on next logon'; 
$lang['Force_new_passwd_detail'] = 'Click here to force this user to change his/her password on next logon.';
$lang['Password_intervall'] = 'Days between users are forced to change password'; 
$lang['Password_intervall_explain'] = 'Enter number of Days here between the Users are forced to change their password. Setting this Value to <b>0</b> will disable this feature !';
$lang['Password_expire'] = 'This users password will expire on: %s';
// End add - Protect user account MOD

// Start add - Prune users MOD
$lang['Prune_users'] = 'Prune users'; 
// End add - Prune users MOD

// Start add - Admin add user MOD
$lang['Create_user'] = 'Create new user';
$lang['Create_user_explain'] = 'You are about to create a new user, when creating a new user, the script will look up the data from this user %s, the user ID of this user is hard coded into the file admin_users.php, you may change this setting in the top of this file if another user ID should be used.<br />There are 2 exceptions from this: <br />1. users Password will default to "%s" if you do not specify differently into the admin add user page<br />2. users email must be filled into the admin add user page';
// End add - Admin add user MOD

$lang['Post_count'] = 'Count Posts in this forum?';

$lang['Contact_Config'] = 'Contact EMail';
$lang['Contact_Explain'] = 'Enter the Email-Address to which the Contact Form Mails should be sent to';

//
// Acronyms
//
$lang['Acronyms_title'] = 'Acronyms Administration';
$lang['Acronyms_explain'] = 'From this control panel you can add, edit, and remove acronyms that will be automatically added to posts on your forums.';
$lang['Acronym'] = 'Acronym';
$lang['Acronyms'] = 'Acronyms';
$lang['Edit_acronym'] = 'Edit Acronym';
$lang['Description'] = 'Description';
$lang['Add_new_acronym'] = 'Add new acronym';
$lang['Update_acronym'] = 'Update acronym';

$lang['Must_enter_acronym'] = 'You must enter an acronym and its description';
$lang['No_acronym_selected'] = 'No acronym selected for editing';

$lang['Acronym_updated'] = 'The selected acronym has been successfully updated';
$lang['Acronym_added'] = 'The acronym has been successfully added';
$lang['Acronym_removed'] = 'The selected acronym has been successfully removed';

$lang['Click_return_acronymadmin'] = 'Click %sHere%s to return to Acronym Administration'; 

// Disable Board Message Mod
$lang['Board_disable_msg'] = 'Disable board message';
$lang['Board_disable_msg_explain'] = 'This text will be shown if "Disable board" is on "Yes".';

// Install Process
$lang['Welcome_install'] = 'Welcome to phpBB 2 Plus Installation';
$lang['Admin_intro'] = 'Thank you for choosing phpBB2 Plus as your forum solution. This screen will give you a quick overview of all the various statistics of your board. You can get back to this page by clicking on the <u>Admin Index</u> link in the left pane. To return to the index of your board, click the phpBB logo also in the left pane. The other links on the left hand side of this screen will allow you to control every aspect of your forum experience. Each screen will have instructions on how to use the tools.';
$lang['Inst_Step_0'] = 'Thank you for choosing phpBB2 Plus. In order to complete this install please fill out the details requested below. Please note that the database you install into should already exist. At the Moment <b>only MySQL Database</b> is supported in phpBB2 Plus.';

$lang['Absence_user_allowed'] = 'Allow users to set absence.<br />On NO, only moderators and administrators can use this.';
$lang['Mod_able_sent_absent'] = 'Allow moderators to send messages to absent user';
$lang['Absent_button_on_username'] = 'Place the absence icon near the username<br />If NO the icon will positioned instead email button.';

$lang['Portal_thumb_size'] = 'Size of the portal thumbnail for recent images (pixel)';

// ShortURLs
$lang['Enable_Shorturls'] = 'Enable Short URLs';
$lang['Shorturls_explain'] = 'Here you can enable static Links for the Forum (.html). To use this function <b>your Webserver MUST use Apache with loaded Module mod_rewrite !</b>. You also have to make the needed changes in the File .htaccess.shorturl and rename it to .htaccess then! The original .htaccess File in the Forums Root-Folder must be deleted !';
$lang['Disable_Sid'] = 'Disable Session-IDs for unregistered Users (and Bots like Googlebot)';
$lang['Disable_Sid_Explain'] = 'If you select Yes, Session-IDs will be cut off from your Forum URLs for unregistered Users and Bots. Because Googlebot also visits as unregistered User the Links are more Search engine Friendly';

// Antirobot Switching
$lang['Enable_Antirobot'] = 'Activate Robot Check';
$lang['Antirobot_Explain'] = 'If set to yes, a visual confirmation code will be displayed during registration to prevent Robots registrations';
//
//

//Admin Users List Addon
$lang['Admin_Users_List'] = 'Admin Users List';
$lang['There_are'] = 'There are';
$lang['Boardmembers'] = 'Members in your Board';
$lang['ID'] = 'ID';
$lang['Last_Visit'] = 'Last Visit';
$lang['Active'] = 'Active';
$lang['Permission'] = 'Permission';

// BEGIN Disable Registration MOD
$lang['registration_status'] = 'Disable registrations';
$lang['registration_status_explain'] = 'This will disable all new registrations to your board.';
$lang['registration_closed'] = 'Reason of closed registrations';
$lang['registration_closed_explain'] = 'Text that explain why are the registrations closed, that would appear if a user try to register. Leave blank to show default explanation text.';
// END Disable Registration MOD

$lang['Plus'] = 'Plus';
$lang['Portal'] = 'Portal';
$lang['Banner'] = 'Banner';
$lang['Org. Configuration'] = 'Orig. Configuration';
$lang['News Admin'] = 'News Admin';
$lang['Download'] = 'Download';
$lang['Email_List'] = 'EMail List';
$lang['Users List'] = 'User List';

//
// Version Check
//
$lang['Version_up_to_date'] = 'Your installation is up to date, no updates are available for your version of phpBB.';
$lang['Version_not_up_to_date'] = 'Your installation does <b>not</b> seem to be up to date. Updates are available for your version of phpBB, please visit <a href="http://www.phpbb.com/downloads.php" target="_new">http://www.phpbb.com/downloads.php</a> to obtain the latest version.';
$lang['Latest_version_info'] = 'The latest available version is <b>phpBB %s</b>.';
$lang['Current_version_info'] = 'You are running <b>phpBB %s</b>.';
$lang['Connect_socket_error'] = 'Unable to open connection to phpBB Server, reported error is:<br />%s';
$lang['Socket_functions_disabled'] = 'Unable to use socket functions.';
$lang['Mailing_list_subscribe_reminder'] = 'For the latest information on updates to phpBB, why not <a href="http://www.phpbb.com/support/" target="_new">subscribe to our mailing list</a>.';
$lang['Version_information'] = 'Version Information'; 

//Added for Topposters Configuration in Portal
$lang['Number_Topposters'] = 'Number of Topposters';
$lang['Topposters_Explain'] = 'Configuration for Number of Topposters displayed in the Topposters Portal Box. Seting this to 0 will disable the Box';
//
// Login attempts configuration
//
$lang['Max_login_attempts'] = 'Allowed login attempts';
$lang['Max_login_attempts_explain'] = 'The number of allowed board login attempts.';
$lang['Login_reset_time'] = 'Login lock time';
$lang['Login_reset_time_explain'] = 'Time in minutes the user have to wait until he is allowed to login again after exceeding the number of allowed login attempts.';

//Added for Folder Permission Check in Admin Panel
$lang['Permission_Check'] = '<u>Checking Permission:</u><br /><br />The following Permissions are not set correctly:';
$lang['File_not_writable_666'] = '<font color="red"><b>is not writable !</b> [change permission to 666]</font>';
$lang['File_not_writable_777'] = '<font color="red"><b>is not writable !</b> [change permission to 777]</font>';
//
// That's all Folks!
// -------------------------------------------------

?>
<?php
/***************************************************************************
*                         admin_panel_nivisec.php
*                            -------------------
*   begin                : Friday, June 07, 2002
*   copyright            : (C) 2002 Nivisec.com
*   email                : admin@nivisec.com
*
*   $Id: lang_jr_admin.php,v 1.4 2003/08/15 02:09:36 nivisec Exp $
*
*
***************************************************************************/
$lang['None'] = 'None';
$lang['Allow_Access'] = 'Allow Access';

$lang['Jr_Admin'] = 'Junior Admin';
$lang['Options'] = 'Options';
$lang['Example'] = 'Example';
$lang['Version'] = 'Version';
$lang['Add_Arrow'] = 'Add ->';
$lang['Super_Mod'] = 'Super Moderator';
$lang['Update'] = 'Update';
$lang['Module_Info'] = 'Module Info';
$lang['Module_Count'] = 'Module Count';
$lang['Modules_Owned'] = '(%d Modules)';
$lang['Updated_Permissions'] = 'Updated User Module Permissions<br>';
$lang['Color_Group'] = 'Color Group';
$lang['Users_with_Access'] = 'Users With Access';
$lang['Users_without_Access'] = 'Users Without Access';
$lang['Check_All'] = 'Select/Un-select All';
$lang['Cat_Check_All'] = 'Category: Select, Un-select All';
$lang['Edit_Permissions'] = 'Edit User Permissions';
$lang['View_Profile'] = 'View User Profile';
$lang['Edit_User_Details'] = 'Edit User Details';
$lang['Notes'] = 'Notes';
$lang['Allow_View'] = 'Allow User To View';
$lang['Start_Date'] = 'Permissions First Granted On';
$lang['Update_Date'] = 'Permissions Last Updated On';
$lang['Edit_Modules'] = 'Edit Modules';
$lang['Color_Group'] = 'Color Group';
$lang['Rank'] = 'Rank';
$lang['Allow_PM'] = 'Allow PM';
$lang['Allow_Avatar'] = 'Allow Avatar';
$lang['User_Active'] = 'User Active';
$lang['User_Info'] = 'User Info';
$lang['User_Stats'] = 'User Stats';
$lang['Junior_Admin_Info'] = 'Your Junior Admin Info';
$lang['Admin_Notes'] = 'Admin Notes';

//Descriptions
$lang['Levels_Page_Desc'] = 'This page allows you to define user levels.  Choose a username on the list to add it or manually enter it.  Usernames MUST be seperated by a , (comma) on each list!';
$lang['Permissions_Page_Desc'] = 'This page allows you to change certain admin only user options and also edit their module list.<br>You may click on each table heading to apply sorting by that heading.';

//Errors
$lang['Error_Users_Table'] = 'Error querying the users table.';
$lang['Error_Module_Table'] = 'Error querying the Jr Admin module permissions table.';
$lang['Error_Module_ID'] = 'The requested module does not exist or you are not an authorized user.';
$lang['Disabled_Color_Groups'] = 'Color Groups Mod not found, unable to assign a color group.';
$lang['Admin_Note'] = 'Notice:  This user is classified as an Administrator Level User.  Any restrictions placed here will not work until you change their access to User instead of Administrator.';
$lang['No_Special_Ranks'] = 'No special ranks defined.';

//This is the bookmark ASCII search list!  If you have odd usernames, you should add your own ASCII search numbers.
//It uses a special format.
//
// Smaller-case letters are ignored also.  Don't bother listing them as everything is converted to upper case for eval.
//
// It searches and prepares the bookmark heading IN THE ORDER you have it below.  It will not sort lowest to highest.
//
// Item-Item2 will search the code from item to item2 AND give each their own bookmark heading (ex. A-Z)
// Item&Item2 will search the code from item to item2 BUT NOT give each their own heading, they will appear like 1-9
// You can add single entries, ie 67
// Seperate entry areas by a ,
//
$lang['ASCII_Search_Codes'] = '48&57, 65-90';

//Images
// Don't change these unless you need to
$lang['ASC_Image'] = 'images/asc_order.png';
$lang['DESC_Image'] = 'images/desc_order.png';

?>
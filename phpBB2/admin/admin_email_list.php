<?php
############################################################## 
## MOD Title: Admin_Email_List
## MOD Version: 1.02 Final 
## MOD Author: Jamer (Colin James) http://www.jamer.co.uk/scripts/phpbb2
## MOD Description: This mod will list all email addresses from your phpbb database, within the admin cp
## 
## Installation Level: Easy
## Installation Time: 5 Minutes 
## Files To Edit: file_language/lang_XXX/lang_admin.php)
## Included Files: (admin_email_list.php,admin_users_email_list_body.tpl) 
##############################################################  
## For Security Purposes, Please Check: <http://www.phpbb.com/mods/downloads/> for the 
## latest version of this MOD. Downloading this MOD from other sites could cause malicious code 
## to enter into your phpBB Forum. As such, phpBB will not offer support for MOD's not offered 
## in our MOD-Database, located at: <http://www.phpbb.com/mods/downloads/> 
############################################################## 
## Author Notes: 
## 
############################################################## 
## MOD History: 
## 
############################################################## 
## Before Adding This MOD To Your Forum, You Should Back Up All Files Related To This MOD 
############################################################## 
#
# Includes Fix by Dwing (phpBBHacks.com)
#
##############################################################


define('IN_PHPBB', 1);
if( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$module['Users']['Email_List'] = $filename;
	return;
}

//
// Load default header
//
$phpbb_root_path = "../";
require($phpbb_root_path . 'extension.inc');
require('pagestart.' . $phpEx);


//
// Generate page
//
$template->set_filenames(array(
	'body' => 'admin/admin_users_email_list_body.tpl')
);

$template->assign_vars(array(
	'L_ADMIN_USERS_LIST_MAIL_TITLE' => $lang['Admin_Users_List_Mail_Title'],
	'L_ADMIN_USERS_LIST_MAIL_EXPLAIN' => $lang['Admin_Users_List_Mail_Explain'],
	'L_USERNAME' => $lang['Usersname'],
	'L_EMAIL' => $lang['Email'])
);

// Count users
$sql = "SELECT user_id FROM ".USERS_TABLE." WHERE user_id > 0";
if(!$result = $db->sql_query($sql))
{
	message_die(GENERAL_ERROR, "Could not count Users", "", __LINE__, __FILE__, $sql);
}
$total_users = $db->sql_numrows($result);
//

$query_result = mysql_query("SELECT username,user_email FROM ".USERS_TABLE." WHERE user_id > 0");

while( $row = $db->sql_fetchrow($query_result) )
{
	$userrow[] = $row;
}

for ($i = 0; $i < $total_users; $i++)
{
	if (empty($userrow[$i]))
	{
		break;
	}

	$row_color = (($i % 2) == 0) ? "row1" : "row2";
	
	$template->assign_block_vars('userrow', array(
		'COLOR' => $row_color,
		'NUMBER' => ($start + $i + 1),
		'USERNAME' => $userrow[$i]['username'],
		'U_ADMIN_USER' => append_sid("admin_users.$phpEx?mode=edit&amp;" . POST_USERS_URL . "=" . $userrow[$i]['user_id']),
		'EMAIL' => $userrow[$i]['user_email']
		) //end array
	);
} // end for

$template->pparse('body');
include('./page_footer_admin.'.$phpEx);
?>

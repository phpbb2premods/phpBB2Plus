<?php
/***************************************************************************
 *                              admin_users.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: admin_users.php,v 1.57.2.26 2004/03/25 15:57:20 acydburn Exp $
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

define('IN_PHPBB', 1);
// Start add - Admin add user MOD
// define a "dummy user", the profile settings of this user, will be used as default settings for new users
define('DEFAULT_USER_ID', 2);
define('DEFAULT_PASSWD', '123456');
// End add - Admin add user MOD
if( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$module['Users']['Manage'] = $filename;

	return;
}

$phpbb_root_path = './../';
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);
require($phpbb_root_path . 'includes/bbcode.'.$phpEx);
require($phpbb_root_path . 'includes/functions_post.'.$phpEx);
require($phpbb_root_path . 'includes/functions_selects.'.$phpEx);
require($phpbb_root_path . 'includes/functions_validate.'.$phpEx);
include($phpbb_root_path . 'includes/functions_profile_fields.'.$phpEx);

$html_entities_match = array('#<#', '#>#');
$html_entities_replace = array('&lt;', '&gt;');

//
// Set mode
//
if( isset( $_POST['mode'] ) || isset( $_GET['mode'] ) )
{
	$mode = ( isset( $_POST['mode']) ) ? $_POST['mode'] : $_GET['mode'];
	$mode = htmlspecialchars($mode);
}
else
{
	$mode = '';
}
// Start add - Admin add user MOD
$new_user = (isset($_POST['new_user'])) ? (($_POST['new_user']==TRUE) ? TRUE : 0 ) : 0 ;
if ($new_user)
{
	//see if user already exist
	if (get_userdata($_POST['username']))
	{
		message_die(GENERAL_MESSAGE, $lang['Username_taken'] );
	}
	//see if default user exist
	if ( !($default_user = get_userdata(DEFAULT_USER_ID) ) )
	{
		message_die(CRITICAL_MESSAGE, 'The DEFAULT_USER_ID are not set correctly, please correct this in admin/admin_users.php');
	}
	if ($mode == 'save' && isset( $_POST['submit'] ) )
	{
		//we need to create the user
		$sql = "SELECT MAX(user_id) AS total
			FROM " . USERS_TABLE;
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not obtain next user_id information', '', __LINE__, __FILE__, $sql);
		}
		if ( !($row = $db->sql_fetchrow($result)) )
		{
			message_die(GENERAL_ERROR, 'Could not obtain next user_id information', '', __LINE__, __FILE__, $sql);
		}
		$user_id = $row['total'] + 1;
		$sql = "INSERT INTO " . USERS_TABLE . "	(user_id, username, user_regdate, user_active)
			VALUES ($user_id, 'new_user', " . time() . ",'0')";
		if ( !($result = $db->sql_query($sql, BEGIN_TRANSACTION)) )
		{
			message_die(GENERAL_ERROR, 'Could not insert data into users table', '', __LINE__, __FILE__, $sql);
		}
		$sql = "INSERT INTO " . GROUPS_TABLE . " (group_name, group_description, group_single_user, group_moderator)
			VALUES ('', 'Personal User', 1, 0)";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not insert data into groups table', '', __LINE__, __FILE__, $sql);
		}
		$group_id = $db->sql_nextid();
		//go get the usergroups, the default user are member of
		$sql = "SELECT g.group_id
			FROM " . USER_GROUP_TABLE . " ug, " . GROUPS_TABLE . " g
			WHERE NOT g.group_single_user AND ug.group_id=g.group_id AND ug.user_id='".DEFAULT_USER_ID."'";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not obtain default user group information', '', __LINE__, __FILE__, $sql);
		}
		while ($group_data = $db->sql_fetchrow($result))
		{
			//user join default groups
			$sql = "INSERT INTO " . USER_GROUP_TABLE . " (group_id, user_id, user_pending) 
				VALUES (".$group_data['group_id'].", $user_id, '0')";
			if ( !($db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Error insert default groupst', '', __LINE__, __FILE__, $sql);
			}
		}

		$sql = "INSERT INTO " . USER_GROUP_TABLE . " (user_id, group_id, user_pending)
			VALUES ($user_id, $group_id, 0)";
		if( !($result = $db->sql_query($sql, END_TRANSACTION)) )
		{
			message_die(GENERAL_ERROR, 'Could not insert data into user_group table', '', __LINE__, __FILE__, $sql);
		}
		$_POST[POST_USERS_URL] = $user_id;
	} else
	{
		//make script use default user as a starting point
		$_POST[POST_USERS_URL] = DEFAULT_USER_ID;
	}
}
// End add - Admin add user MOD

//
// Begin program
//
if ( $mode == 'edit' || $mode == 'save' && ( isset($_POST['username']) || isset($_GET[POST_USERS_URL]) || isset( $_POST[POST_USERS_URL]) ) )
{
	attachment_quota_settings('user', $_POST['submit'], $mode);
	//
	// Ok, the profile has been modified and submitted, let's update
	//
	if ( ( $mode == 'save' && isset( $_POST['submit'] ) ) || isset( $_POST['avatargallery'] ) || isset( $_POST['submitavatar'] ) || isset( $_POST['cancelavatar'] ) )
	{
		// Start replacement - Admin add user MOD
		$user_id = ($new_user) ? $user_id : intval($_POST['id']);
		// End replacement - Admin add user MOD

		if (!($this_userdata = get_userdata($user_id)))
		{
			message_die(GENERAL_MESSAGE, $lang['No_user_id_specified'] );
		}

		if( $_POST['deleteuser'] && ( $userdata['user_id'] != $user_id ) && $new_user==0)
		{
			$sql = "SELECT g.group_id 
				FROM " . USER_GROUP_TABLE . " ug, " . GROUPS_TABLE . " g  
				WHERE ug.user_id = $user_id 
					AND g.group_id = ug.group_id 
					AND g.group_single_user = 1";
			if( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not obtain group information for this user', '', __LINE__, __FILE__, $sql);
			}

			$row = $db->sql_fetchrow($result);
			
			$sql = "UPDATE " . POSTS_TABLE . "
				SET poster_id = " . DELETED . ", post_username = '" . str_replace("\\'", "''", addslashes($this_userdata['username'])) . "' 
				WHERE poster_id = $user_id";
			if( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not update posts for this user', '', __LINE__, __FILE__, $sql);
			}
			// Start add - Fully integrated shoutbox MOD
			$sql = "UPDATE " . SHOUTBOX_TABLE . "
				SET shout_user_id = " . DELETED . ", shout_username = '$username' 
				WHERE shout_user_id = $user_id";
			if( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not update shouts for this user', '', __LINE__, __FILE__, $sql);
			}
			// End add - Fully integrated shoutbox MOD
			$sql = "UPDATE " . TOPICS_TABLE . "
				SET topic_poster = " . DELETED . " 
				WHERE topic_poster = $user_id";
			if( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not update topics for this user', '', __LINE__, __FILE__, $sql);
			}
			
			$sql = "UPDATE " . VOTE_USERS_TABLE . "
				SET vote_user_id = " . DELETED . "
				WHERE vote_user_id = $user_id";
			if( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not update votes for this user', '', __LINE__, __FILE__, $sql);
			}
			
			$sql = "SELECT group_id
				FROM " . GROUPS_TABLE . "
				WHERE group_moderator = $user_id";
			if( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not select groups where user was moderator', '', __LINE__, __FILE__, $sql);
			}
			
			while ( $row_group = $db->sql_fetchrow($result) )
			{
				$group_moderator[] = $row_group['group_id'];
			}
			
			if ( count($group_moderator) )
			{
				$update_moderator_id = implode(', ', $group_moderator);
				
				$sql = "UPDATE " . GROUPS_TABLE . "
					SET group_moderator = " . $userdata['user_id'] . "
					WHERE group_moderator IN ($update_moderator_id)";
				if( !$db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, 'Could not update group moderators', '', __LINE__, __FILE__, $sql);
				}
			}

			$sql = "DELETE FROM " . USERS_TABLE . "
				WHERE user_id = $user_id";
			if( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not delete user', '', __LINE__, __FILE__, $sql);
			}

			$sql = "DELETE FROM " . USER_GROUP_TABLE . "
				WHERE user_id = $user_id";
			if( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not delete user from user_group table', '', __LINE__, __FILE__, $sql);
			}

			$sql = "DELETE FROM " . GROUPS_TABLE . "
				WHERE group_id = " . $row['group_id'];
			if( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not delete group for this user', '', __LINE__, __FILE__, $sql);
			}

			$sql = "DELETE FROM " . AUTH_ACCESS_TABLE . "
				WHERE group_id = " . $row['group_id'];
			if( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not delete group for this user', '', __LINE__, __FILE__, $sql);
			}

			$sql = "DELETE FROM " . TOPICS_WATCH_TABLE . "
				WHERE user_id = $user_id";
			if ( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not delete user from topic watch table', '', __LINE__, __FILE__, $sql);
			}
			$sql = "DELETE FROM " . BOOKMARK_TABLE . "
				WHERE user_id = $user_id";
			if ( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not delete user\'s bookmarks', '', __LINE__, __FILE__, $sql);
			}
			$sql = "DELETE FROM " . BANLIST_TABLE . "
				WHERE ban_userid = $user_id";
			if ( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not delete user from banlist table', '', __LINE__, __FILE__, $sql);
			}

			$sql = "DELETE FROM " . SESSIONS_TABLE . "
				WHERE session_user_id = $user_id";
			if ( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not delete sessions for this user', '', __LINE__, __FILE__, $sql);
			}
			
			$sql = "DELETE FROM " . SESSIONS_KEYS_TABLE . "
				WHERE user_id = $user_id";
			if ( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not delete auto-login keys for this user', '', __LINE__, __FILE__, $sql);
			}

			$sql = "SELECT privmsgs_id
				FROM " . PRIVMSGS_TABLE . "
				WHERE privmsgs_from_userid = $user_id 
					OR privmsgs_to_userid = $user_id";
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not select all users private messages', '', __LINE__, __FILE__, $sql);
			}

			// This little bit of code directly from the private messaging section.
			while ( $row_privmsgs = $db->sql_fetchrow($result) )
			{
				$mark_list[] = $row_privmsgs['privmsgs_id'];
			}
			
			if ( count($mark_list) )
			{
				$delete_sql_id = implode(', ', $mark_list);
				
				$delete_text_sql = "DELETE FROM " . PRIVMSGS_TEXT_TABLE . "
					WHERE privmsgs_text_id IN ($delete_sql_id)";
				$delete_sql = "DELETE FROM " . PRIVMSGS_TABLE . "
					WHERE privmsgs_id IN ($delete_sql_id)";
				
				if ( !$db->sql_query($delete_sql) )
				{
					message_die(GENERAL_ERROR, 'Could not delete private message info', '', __LINE__, __FILE__, $delete_sql);
				}
				
				if ( !$db->sql_query($delete_text_sql) )
				{
					message_die(GENERAL_ERROR, 'Could not delete private message text', '', __LINE__, __FILE__, $delete_text_sql);
				}
			}

			$message = $lang['User_deleted'] . '<br /><br />' . sprintf($lang['Click_return_useradmin'], '<a href="' . append_sid("admin_users.$phpEx") . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . append_sid("index.$phpEx?pane=right") . '">', '</a>');

			message_die(GENERAL_MESSAGE, $message);
		}
		// Start add - Protect user account MOD
if( $_POST['block_account'] )
{
	$sql = "UPDATE ".USERS_TABLE." SET 
		user_blocktime='".(time()+$board_config['block_time']*60)."', user_block_by='$user_ip' 
		WHERE user_id = '$user_id'";
	if( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not block user', '', __LINE__, __FILE__, $sql);
	}
	$sql = 'UPDATE ' . SESSIONS_TABLE . ' SET session_logged_in="0" WHERE session_user_id="'.$user_id.'"';
	if ( !$db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, "Couldn't update blocked sessions from database", "", __LINE__, __FILE__, $sql);
	}

} else
if( $_POST['unblock_account'] )
{
	$sql = "UPDATE ".USERS_TABLE." SET 
		user_blocktime='0', user_badlogin='0' 
		WHERE user_id = '$user_id'";
	if( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not unblock user', '', __LINE__, __FILE__, $sql);
	}
}
// End add - Protect user account MOD

		$username = ( !empty($_POST['username']) ) ? phpbb_clean_username($_POST['username']) : '';
		$email = ( !empty($_POST['email']) ) ? trim(strip_tags(htmlspecialchars( $_POST['email'] ) )) : '';

		$password = ( !empty($_POST['password']) ) ? trim(strip_tags(htmlspecialchars( $_POST['password'] ) )) : '';
		$password_confirm = ( !empty($_POST['password_confirm']) ) ? trim(strip_tags(htmlspecialchars( $_POST['password_confirm'] ) )) : '';

		$icq = ( !empty($_POST['icq']) ) ? trim(strip_tags( $_POST['icq'] ) ) : '';
		$aim = ( !empty($_POST['aim']) ) ? trim(strip_tags( $_POST['aim'] ) ) : '';
		$msn = ( !empty($_POST['msn']) ) ? trim(strip_tags( $_POST['msn'] ) ) : '';
		$yim = ( !empty($_POST['yim']) ) ? trim(strip_tags( $_POST['yim'] ) ) : '';

		$website = ( !empty($_POST['website']) ) ? trim(strip_tags( $_POST['website'] ) ) : '';
		$location = ( !empty($_POST['location']) ) ? trim(strip_tags( $_POST['location'] ) ) : '';
		$occupation = ( !empty($_POST['occupation']) ) ? trim(strip_tags( $_POST['occupation'] ) ) : '';
		$interests = ( !empty($_POST['interests']) ) ? trim(strip_tags( $_POST['interests'] ) ) : '';
		$user_absence = ( isset( $_POST['user_absence']) ) ? ( ( $_POST['user_absence'] ) ? TRUE : 0 ) : 0;
		$user_absence_mode = abs( intval($_POST['user_absence_mode']) );
		$user_absence_text = ( !empty($_POST['user_absence_text']) ) ? trim(strip_tags( $_POST['user_absence_text'] ) ): '';
		// Start add - Gender MOD
		$gender = ( isset($_POST['gender']) ) ? intval ($_POST['gender']) : 0;
		// End add - Gender MOD
		// Start add - Birthday MOD
		if (isset($_POST['birthday']) )
		{
			$birthday = intval ($_POST['birthday']);
			$b_day = realdate('j',$birthday);
			$b_md = realdate('n',$birthday);
			$b_year = realdate('Y',$birthday);
		} else
		{
			$b_day = ( isset($_POST['b_day']) ) ? intval ($_POST['b_day']) : 0;
			$b_md = ( isset($_POST['b_md']) ) ? intval ($_POST['b_md']) : 0;
			$b_year = ( isset($_POST['b_year']) ) ? intval ($_POST['b_year']) : 0;
			$birthday = mkrealdate($b_day,$b_md,$b_year);
		}
		$next_birthday_greeting = ( !empty($_POST['next_birthday_greeting']) ) ? intval( $_POST['next_birthday_greeting'] ) : 0;
		// End add - Birthday MOD
		$signature = ( !empty($_POST['signature']) ) ? trim(str_replace('<br />', "\n", $_POST['signature'] ) ) : '';

		validate_optional_fields($icq, $aim, $msn, $yim, $website, $location, $occupation, $interests, $signature);

		$viewemail = ( isset( $_POST['viewemail']) ) ? ( ( $_POST['viewemail'] ) ? TRUE : 0 ) : 0;
		// Start add - Protect user account MOD
//
// If you wish to give the user the option of using the admin
// made password for X days, substitude "0" value in the secound
// line below with a value of secounds + current time the password
// will be valid
//
		$force_new_passwd = ( isset( $_POST['force_new_passwd']) ) ? ( ( $_POST['force_new_passwd'] ) ? TRUE : 0 ) : 0;
		$force_new_passwd_sql = ( $force_new_passwd ) ? ", user_passwd_change='0'" : (($this_userdata['user_passwd_change']) ? "" : ", user_passwd_change='".time()."'");
		// End add - Protect user account MOD

		$allowviewonline = ( isset( $_POST['hideonline']) ) ? ( ( $_POST['hideonline'] ) ? 0 : TRUE ) : TRUE;
		$notifyreply = ( isset( $_POST['notifyreply']) ) ? ( ( $_POST['notifyreply'] ) ? TRUE : 0 ) : 0;
		$notifypm = ( isset( $_POST['notifypm']) ) ? ( ( $_POST['notifypm'] ) ? TRUE : 0 ) : TRUE;
		$popuppm = ( isset( $_POST['popup_pm']) ) ? ( ( $_POST['popup_pm'] ) ? TRUE : 0 ) : TRUE;
		$attachsig = ( isset( $_POST['attachsig']) ) ? ( ( $_POST['attachsig'] ) ? TRUE : 0 ) : 0;
		$setbm = ( isset( $_POST['setbm']) ) ? ( ( $_POST['setbm'] ) ? TRUE : 0 ) : 0;
		
		$allowhtml = ( isset( $_POST['allowhtml']) ) ? intval( $_POST['allowhtml'] ) : $board_config['allow_html'];
		$allowbbcode = ( isset( $_POST['allowbbcode']) ) ? intval( $_POST['allowbbcode'] ) : $board_config['allow_bbcode'];
		$allowsmilies = ( isset( $_POST['allowsmilies']) ) ? intval( $_POST['allowsmilies'] ) : $board_config['allow_smilies'];

		$user_style = ( isset( $_POST['style'] ) ) ? intval( $_POST['style'] ) : $board_config['default_style'];
		$user_lang = ( $_POST['language'] ) ? $_POST['language'] : $board_config['default_lang'];
		$user_timezone = ( isset( $_POST['timezone']) ) ? doubleval( $_POST['timezone'] ) : $board_config['board_timezone'];
		// FLAGHACK-start
		$user_flag = ( !empty($_POST['user_flag']) ) ? $_POST['user_flag'] : '' ;
		// FLAGHACK-end

		$user_dateformat = ( $_POST['dateformat'] ) ? trim( $_POST['dateformat'] ) : $board_config['default_dateformat'];

		$user_avatar_local = ( isset( $_POST['avatarselect'] ) && !empty($_POST['submitavatar'] ) && $board_config['allow_avatar_local'] ) ? $_POST['avatarselect'] : ( ( isset( $_POST['avatarlocal'] )  ) ? $_POST['avatarlocal'] : '' );
		$user_avatar_category = ( isset($_POST['avatarcatname']) && $board_config['allow_avatar_local'] ) ? htmlspecialchars($_POST['avatarcatname']) : '' ;

		$user_avatar_remoteurl = ( !empty($_POST['avatarremoteurl']) ) ? trim( $_POST['avatarremoteurl'] ) : '';
		$user_avatar_url = ( !empty($_POST['avatarurl']) ) ? trim( $_POST['avatarurl'] ) : '';
		$user_avatar_loc = ( $HTTP_POST_FILES['avatar']['tmp_name'] != "none") ? $HTTP_POST_FILES['avatar']['tmp_name'] : '';
		$user_avatar_name = ( !empty($HTTP_POST_FILES['avatar']['name']) ) ? $HTTP_POST_FILES['avatar']['name'] : '';
		$user_avatar_size = ( !empty($HTTP_POST_FILES['avatar']['size']) ) ? $HTTP_POST_FILES['avatar']['size'] : 0;
		$user_avatar_filetype = ( !empty($HTTP_POST_FILES['avatar']['type']) ) ? $HTTP_POST_FILES['avatar']['type'] : '';

		$user_avatar = ( empty($user_avatar_loc) ) ? $this_userdata['user_avatar'] : '';
		$user_avatar_type = ( empty($user_avatar_loc) ) ? $this_userdata['user_avatar_type'] : '';		

		$user_status = ( !empty($_POST['user_status']) ) ? intval( $_POST['user_status'] ) : 0;
		$user_ycard = ( !empty($_POST['user_ycard']) ) ? intval( $_POST['user_ycard'] ) : 0;
		$user_allowpm = ( !empty($_POST['user_allowpm']) ) ? intval( $_POST['user_allowpm'] ) : 0;
		$user_rank = ( !empty($_POST['user_rank']) ) ? intval( $_POST['user_rank'] ) : 0;
		$user_allowavatar = ( !empty($_POST['user_allowavatar']) ) ? intval( $_POST['user_allowavatar'] ) : 0;

		if( isset( $_POST['avatargallery'] ) || isset( $_POST['submitavatar'] ) || isset( $_POST['cancelavatar'] ) )
		{
			$username = stripslashes($username);
			$email = stripslashes($email);
			$password = '';
			$password_confirm = '';

			$icq = stripslashes($icq);
			$aim = htmlspecialchars(stripslashes($aim));
			$msn = htmlspecialchars(stripslashes($msn));
			$yim = htmlspecialchars(stripslashes($yim));

			$website = htmlspecialchars(stripslashes($website));
			$location = htmlspecialchars(stripslashes($location));
			$occupation = htmlspecialchars(stripslashes($occupation));
			$interests = htmlspecialchars(stripslashes($interests));
			$user_absence_text = htmlspecialchars(stripslashes($user_absence_text));
			$signature = htmlspecialchars(stripslashes($signature));

			$user_lang = stripslashes($user_lang);
			$user_dateformat = htmlspecialchars(stripslashes($user_dateformat));

			if ( !isset($_POST['cancelavatar'])) 
			{
				$user_avatar = $user_avatar_category . '/' . $user_avatar_local;
				$user_avatar_type = USER_AVATAR_GALLERY;
			}
		}
	}

	if( isset( $_POST['submit'] ) )
	{
		include($phpbb_root_path . 'includes/usercp_avatar.'.$phpEx);

		$error = FALSE;

		if (stripslashes($username) != $this_userdata['username'])
		{
			unset($rename_user);

			if ( stripslashes(strtolower($username)) != strtolower($this_userdata['username']) ) 
			{
				$result = validate_username($username);
				if ( $result['error'] )
				{
					$error = TRUE;
					$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $result['error_msg'];
				}
				else if ( strtolower(str_replace("\\'", "''", $username)) == strtolower($userdata['username']) )
				{
					$error = TRUE;
					$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Username_taken'];
				}
			}

			if (!$error)
			{
				$username_sql = "username = '" . str_replace("\\'", "''", $username) . "', ";
				$rename_user = $username; // Used for renaming usergroup
			}
		}

		//
		// Custom Profile Fields MOD
		//
		$profile_data = get_fields();
		$profile_names = array();
		
		foreach($profile_data as $fields)
		{
		  $name = text_to_column($fields['field_name']);
		  $type = $fields['field_type'];
		  $required = $fields['is_required'] == REQUIRED ? true : false;
		  
		  $temp = $_POST[$name];
		  if($type == CHECKBOX)
		  {
			$temp2 = '';
			if ($temp)
				foreach($temp as $temp3)
				  $temp2 .= htmlspecialchars($temp3) . ',';

			$temp2 = substr($temp2,0,strlen($temp2)-1);
			
			$temp = $temp2;
		  }
		  else
			$temp = is_numeric($temp) ? intval($temp) : htmlspecialchars($temp);
		  $profile_names[$name] = $temp;
		  
		  if($required && empty($profile_names[$name]))
		  {
			$error = TRUE;
				$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Fields_empty'];
		  }
		}
		//
		// END Custom Profile Fields MOD
		//

		$passwd_sql = '';
		if( !empty($password) && !empty($password_confirm) )
		{
			//
			// Awww, the user wants to change their password, isn't that cute..
			//
			if($password != $password_confirm)
			{
				$error = TRUE;
				$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Password_mismatch'];
			}
			else
			{
				$password = md5($password);
				$passwd_sql = "user_password = '$password', ";
			}
		}
		else if( $password && !$password_confirm )
		{
			$error = TRUE;
			$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Password_mismatch'];
		}
		else if( !$password && $password_confirm )
		{
			$error = TRUE;
			$error_msg .= ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Password_mismatch'];
		}
		// Start add - Admin add user MOD
		else if ($new_user)
		{
			//no password given for this new user, create default password
			$password = md5(DEFAULT_PASSWD);
			$passwd_sql = "user_password = '$password', ";
			//send out email notification goes here
		}
		// End add - Admin add user MOD
		if ($signature != '')
		{
			$sig_length_check = preg_replace('/(\[.*?)(=.*?)\]/is', '\\1]', stripslashes($signature));
			if ( $allowhtml )
			{
				$sig_length_check = preg_replace('/(\<.*?)(=.*?)( .*?=.*?)?([ \/]?\>)/is', '\\1\\3\\4', $sig_length_check);
			}

			// Only create a new bbcode_uid when there was no uid yet.
			if ( $signature_bbcode_uid == '' )
			{
				$signature_bbcode_uid = ( $allowbbcode ) ? make_bbcode_uid() : '';
			}
			$signature = prepare_message($signature, $allowhtml, $allowbbcode, $allowsmilies, $signature_bbcode_uid);

			if ( strlen($sig_length_check) > $board_config['max_sig_chars'] )
			{ 
				$error = TRUE;
				$error_msg .=  ( ( isset($error_msg) ) ? '<br />' : '' ) . $lang['Signature_too_long'];
			}
		}
		
		//
		// Avatar stuff
		//
		$avatar_sql = "";
		if( isset($_POST['avatardel']) )
		{
			if( $this_userdata['user_avatar_type'] == USER_AVATAR_UPLOAD && $this_userdata['user_avatar'] != "" )
			{
				if( @file_exists(@phpbb_realpath('./../' . $board_config['avatar_path'] . "/" . $this_userdata['user_avatar'])) )
				{
					@unlink('./../' . $board_config['avatar_path'] . "/" . $this_userdata['user_avatar']);
				}
			}
			$avatar_sql = ", user_avatar = '', user_avatar_type = " . USER_AVATAR_NONE;
		}
		else if( ( $user_avatar_loc != "" || !empty($user_avatar_url) ) && !$error )
		{
			//
			// Only allow one type of upload, either a
			// filename or a URL
			//
			if( !empty($user_avatar_loc) && !empty($user_avatar_url) )
			{
				$error = TRUE;
				if( isset($error_msg) )
				{
					$error_msg .= "<br />";
				}
				$error_msg .= $lang['Only_one_avatar'];
			}

			if( $user_avatar_loc != "" )
			{
				if( file_exists(@phpbb_realpath($user_avatar_loc)) && ereg(".jpg$|.gif$|.png$", $user_avatar_name) )
				{
					if( $user_avatar_size <= $board_config['avatar_filesize'] && $user_avatar_size > 0)
					{
						$error_type = false;

						//
						// Opera appends the image name after the type, not big, not clever!
						//
						preg_match("'image\/[x\-]*([a-z]+)'", $user_avatar_filetype, $user_avatar_filetype);
						$user_avatar_filetype = $user_avatar_filetype[1];

						switch( $user_avatar_filetype )
						{
							case "jpeg":
							case "pjpeg":
							case "jpg":
								$imgtype = '.jpg';
								break;
							case "gif":
								$imgtype = '.gif';
								break;
							case "png":
								$imgtype = '.png';
								break;
							default:
								$error = true;
								$error_msg = (!empty($error_msg)) ? $error_msg . "<br />" . $lang['Avatar_filetype'] : $lang['Avatar_filetype'];
								break;
						}

						if( !$error )
						{
							list($width, $height) = @getimagesize($user_avatar_loc);

							if( $width <= $board_config['avatar_max_width'] && $height <= $board_config['avatar_max_height'] )
							{
								$user_id = $this_userdata['user_id'];

								$avatar_filename = $user_id . $imgtype;

								if( $this_userdata['user_avatar_type'] == USER_AVATAR_UPLOAD && $this_userdata['user_avatar'] != "" )
								{
									if( @file_exists(@phpbb_realpath("./../" . $board_config['avatar_path'] . "/" . $this_userdata['user_avatar'])) )
									{
										@unlink("./../" . $board_config['avatar_path'] . "/". $this_userdata['user_avatar']);
									}
								}
								@copy($user_avatar_loc, "./../" . $board_config['avatar_path'] . "/$avatar_filename");

								$avatar_sql = ", user_avatar = '$avatar_filename', user_avatar_type = " . USER_AVATAR_UPLOAD;
							}
							else
							{
								$l_avatar_size = sprintf($lang['Avatar_imagesize'], $board_config['avatar_max_width'], $board_config['avatar_max_height']);

								$error = true;
								$error_msg = ( !empty($error_msg) ) ? $error_msg . "<br />" . $l_avatar_size : $l_avatar_size;
							}
						}
					}
					else
					{
						$l_avatar_size = sprintf($lang['Avatar_filesize'], round($board_config['avatar_filesize'] / 1024));

						$error = true;
						$error_msg = ( !empty($error_msg) ) ? $error_msg . "<br />" . $l_avatar_size : $l_avatar_size;
					}
				}
				else
				{
					$error = true;
					$error_msg = ( !empty($error_msg) ) ? $error_msg . "<br />" . $lang['Avatar_filetype'] : $lang['Avatar_filetype'];
				}
			}
			else if( !empty($user_avatar_url) )
			{
				//
				// First check what port we should connect
				// to, look for a :[xxxx]/ or, if that doesn't
				// exist assume port 80 (http)
				//
				preg_match("/^(http:\/\/)?([\w\-\.]+)\:?([0-9]*)\/(.*)$/", $user_avatar_url, $url_ary);

				if( !empty($url_ary[4]) )
				{
					$port = (!empty($url_ary[3])) ? $url_ary[3] : 80;

					$fsock = @fsockopen($url_ary[2], $port, $errno, $errstr);
					if( $fsock )
					{
						$base_get = "/" . $url_ary[4];

						//
						// Uses HTTP 1.1, could use HTTP 1.0 ...
						//
						@fputs($fsock, "GET $base_get HTTP/1.1\r\n");
						@fputs($fsock, "HOST: " . $url_ary[2] . "\r\n");
						@fputs($fsock, "Connection: close\r\n\r\n");

						unset($avatar_data);
						while( !@feof($fsock) )
						{
							$avatar_data .= @fread($fsock, $board_config['avatar_filesize']);
						}
						@fclose($fsock);

						if( preg_match("/Content-Length\: ([0-9]+)[^\/ ][\s]+/i", $avatar_data, $file_data1) && preg_match("/Content-Type\: image\/[x\-]*([a-z]+)[\s]+/i", $avatar_data, $file_data2) )
						{
							$file_size = $file_data1[1]; 
							$file_type = $file_data2[1];

							switch( $file_type )
							{
								case "jpeg":
								case "pjpeg":
								case "jpg":
									$imgtype = '.jpg';
									break;
								case "gif":
									$imgtype = '.gif';
									break;
								case "png":
									$imgtype = '.png';
									break;
								default:
									$error = true;
									$error_msg = (!empty($error_msg)) ? $error_msg . "<br />" . $lang['Avatar_filetype'] : $lang['Avatar_filetype'];
									break;
							}

							if( !$error && $file_size > 0 && $file_size < $board_config['avatar_filesize'] )
							{
								$avatar_data = substr($avatar_data, strlen($avatar_data) - $file_size, $file_size);

								$tmp_filename = tempnam ("/tmp", $this_userdata['user_id'] . "-");
								$fptr = @fopen($tmp_filename, "wb");
								$bytes_written = @fwrite($fptr, $avatar_data, $file_size);
								@fclose($fptr);

								if( $bytes_written == $file_size )
								{
									list($width, $height) = @getimagesize($tmp_filename);

									if( $width <= $board_config['avatar_max_width'] && $height <= $board_config['avatar_max_height'] )
									{
										$user_id = $this_userdata['user_id'];

										$avatar_filename = $user_id . $imgtype;

										if( $this_userdata['user_avatar_type'] == USER_AVATAR_UPLOAD && $this_userdata['user_avatar'] != "")
										{
											if( file_exists(@phpbb_realpath("./../" . $board_config['avatar_path'] . "/" . $this_userdata['user_avatar'])) )
											{
												@unlink("./../" . $board_config['avatar_path'] . "/" . $this_userdata['user_avatar']);
											}
										}
										@copy($tmp_filename, "./../" . $board_config['avatar_path'] . "/$avatar_filename");
										@unlink($tmp_filename);

										$avatar_sql = ", user_avatar = '$avatar_filename', user_avatar_type = " . USER_AVATAR_UPLOAD;
									}
									else
									{
										$l_avatar_size = sprintf($lang['Avatar_imagesize'], $board_config['avatar_max_width'], $board_config['avatar_max_height']);

										$error = true;
										$error_msg = ( !empty($error_msg) ) ? $error_msg . "<br />" . $l_avatar_size : $l_avatar_size;
									}
								}
								else
								{
									//
									// Error writing file
									//
									@unlink($tmp_filename);
									message_die(GENERAL_ERROR, "Could not write avatar file to local storage. Please contact the board administrator with this message", "", __LINE__, __FILE__);
								}
							}
						}
						else
						{
							//
							// No data
							//
							$error = true;
							$error_msg = ( !empty($error_msg) ) ? $error_msg . "<br />" . $lang['File_no_data'] : $lang['File_no_data'];
						}
					}
					else
					{
						//
						// No connection
						//
						$error = true;
						$error_msg = ( !empty($error_msg) ) ? $error_msg . "<br />" . $lang['No_connection_URL'] : $lang['No_connection_URL'];
					}
				}
				else
				{
					$error = true;
					$error_msg = ( !empty($error_msg) ) ? $error_msg . "<br />" . $lang['Incomplete_URL'] : $lang['Incomplete_URL'];
				}
			}
			else if( !empty($user_avatar_name) )
			{
				$l_avatar_size = sprintf($lang['Avatar_filesize'], round($board_config['avatar_filesize'] / 1024));

				$error = true;
				$error_msg = ( !empty($error_msg) ) ? $error_msg . "<br />" . $l_avatar_size : $l_avatar_size;
			}
		}
		else if( $user_avatar_remoteurl != "" && $avatar_sql == "" && !$error )
		{
			if( !preg_match("#^http:\/\/#i", $user_avatar_remoteurl) )
			{
				$user_avatar_remoteurl = "http://" . $user_avatar_remoteurl;
			}

			if( preg_match("#^(http:\/\/[a-z0-9\-]+?\.([a-z0-9\-]+\.)*[a-z]+\/.*?\.(gif|jpg|png)$)#is", $user_avatar_remoteurl) )
			{
				$avatar_sql = ", user_avatar = '" . str_replace("\'", "''", $user_avatar_remoteurl) . "', user_avatar_type = " . USER_AVATAR_REMOTE;
			}
			else
			{
				$error = true;
				$error_msg = ( !empty($error_msg) ) ? $error_msg . "<br />" . $lang['Wrong_remote_avatar_format'] : $lang['Wrong_remote_avatar_format'];
			}
		}
		else if( $user_avatar_local != "" && $avatar_sql == "" && !$error )
		{
			$avatar_sql = ", user_avatar = '" . str_replace("\'", "''", phpbb_ltrim(basename($user_avatar_category), "'") . '/' . phpbb_ltrim(basename($user_avatar_local), "'")) . "', user_avatar_type = " . USER_AVATAR_GALLERY;
		}
		// Start add - Birthday MOD
// find the birthday values, reflected by the $lang['Submit_date_format']
		if ($b_day || $b_md || $b_year) //if a birthday is submited, then validate it
		{
			$user_age=(date('md')>=$b_md.(($b_day <= 9) ? '0':'').$b_day) ? date('Y') - $b_year : date('Y') - $b_year - 1 ;
			// Check date, maximum / minimum user age
			if (!checkdate($b_md,$b_day,$b_year))
			{
				$error = TRUE;
				if( isset($error_msg) )$error_msg .= "<br />";
				$error_msg .= $lang['Wrong_birthday_format'];
			} else
			if ($user_age>$board_config['max_user_age'])
			{
				$error = TRUE;
				if( isset($error_msg) )$error_msg .= "<br />";
				$error_msg .= sprintf($lang['Birthday_to_high'],$board_config['max_user_age']);
			} else
			if ($user_age<$board_config['min_user_age'])
			{
				$error = TRUE;
				if( isset($error_msg) )$error_msg .= "<br />";
				$error_msg .= sprintf($lang['Birthday_to_low'],$board_config['min_user_age']);
			} else
			{
				$birthday = ($error) ? $birthday : mkrealdate($b_day,$b_md,$b_year);
			}
		} else $birthday = ($error) ? '' : 999999;
		// End add - Birthday MOD
		//
		// Update entry in DB
		//
		if( !$error )
		{
			if ($user_ycard>$board_config['max_user_bancard']) 
{ 
   $sql = "SELECT ban_userid FROM " . BANLIST_TABLE . " WHERE ban_userid=$user_id"; 
   if( $result = $db->sql_query($sql) ) 
   { 
      if (!$db->sql_fetchrowset($result)) 
      { 
         // insert the user in the ban list 
         $sql = "INSERT INTO " . BANLIST_TABLE . " (ban_userid) VALUES ($user_id)"; 
         if (!$result = $db->sql_query($sql) ) 
            message_die(GENERAL_ERROR, "Couldn't insert ban_userid info into database", "", __LINE__, __FILE__, $sql); 
         else $no_error_ban=true; 
      } else $no_error_ban = true; 
   } else message_die(GENERAL_ERROR, "Couldn't obtain banlist information", "", __LINE__, __FILE__, $sql); 
} else 
{ 
   // remove the ban, if there is any 
   $sql = "DELETE FROM " . BANLIST_TABLE . " WHERE ban_userid=$user_id"; 
   if (!$result = $db->sql_query($sql) ) 
      message_die(GENERAL_ERROR, "Couldn't remove ban_userid info into database", "", __LINE__, __FILE__, $sql); 
   else $no_error_ban=true; 
}
			$sql = "UPDATE " . USERS_TABLE . "
				SET " . $username_sql . $passwd_sql . "user_email = '" . str_replace("\'", "''", $email) . "', user_icq = '" . str_replace("\'", "''", $icq) . "', user_website = '" . str_replace("\'", "''", $website) . "', user_occ = '" . str_replace("\'", "''", $occupation) . "', user_from = '" . str_replace("\'", "''", $location) . "', user_from_flag = '$user_flag', user_interests = '" . str_replace("\'", "''", $interests) . "', user_absence_mode = $user_absence_mode, user_absence = $user_absence, user_absence_text = '" . str_replace("\'", "''", $user_absence_text) . "', user_birthday='$birthday', user_next_birthday_greeting=$next_birthday_greeting, user_sig = '" . str_replace("\'", "''", $signature) . "', user_viewemail = $viewemail, user_aim = '" . str_replace("\'", "''", $aim) . "', user_yim = '" . str_replace("\'", "''", $yim) . "', user_msnm = '" . str_replace("\'", "''", $msn) . "', user_attachsig = $attachsig, user_setbm = $setbm, user_sig_bbcode_uid = '$signature_bbcode_uid', user_allowsmile = $allowsmilies, user_allowhtml = $allowhtml, user_allowavatar = $user_allowavatar, user_allowbbcode = $allowbbcode, user_allow_viewonline = $allowviewonline, user_notify = $notifyreply, user_allow_pm = $user_allowpm, user_notify_pm = $notifypm, user_popup_pm = $popuppm, user_lang = '" . str_replace("\'", "''", $user_lang) . "', user_style = $user_style, user_timezone = $user_timezone, user_dateformat = '" . str_replace("\'", "''", $user_dateformat) . "', user_active = $user_status, user_warnings = $user_ycard, user_rank = $user_rank, user_gender = '$gender'" . $avatar_sql . $force_new_passwd_sql . "
				WHERE user_id = $user_id";

			if( $result = $db->sql_query($sql) )
			{
				if( isset($rename_user) )
				{
					$sql = "UPDATE " . GROUPS_TABLE . "
						SET group_name = '".str_replace("\'", "''", $rename_user)."'
						WHERE group_name = '".str_replace("'", "''", $this_userdata['username'] )."'";
					if( !$result = $db->sql_query($sql) )
					{
						message_die(GENERAL_ERROR, 'Could not rename users group', '', __LINE__, __FILE__, $sql);
					}
				}
				
				// Delete user session, to prevent the user navigating the forum (if logged in) when disabled
				if (!$user_status)
				{
					$sql = "DELETE FROM " . SESSIONS_TABLE . " 
						WHERE session_user_id = " . $user_id;

					if ( !$db->sql_query($sql) )
					{
						message_die(GENERAL_ERROR, 'Error removing user session', '', __LINE__, __FILE__, $sql);
					}
				}
				
				//
				// Custom Profile Fields MOD
				//
				$profile_data = get_fields();
				$profile_names = array();
				
			    $sql2_tmp = '';
				foreach($profile_data as $fields)
				{
					$name = text_to_column($fields['field_name']);
					$type = $fields['field_type'];
					$required = $fields['is_required'] == REQUIRED ? true : false;
					
					$temp = $_POST[$name];
					if($type == CHECKBOX)
					{
						$temp2 = '';
						if ($temp)
							foreach($temp as $temp3)
								$temp2 .= htmlspecialchars($temp3) . ',';

						$temp2 = substr($temp2,0,strlen($temp2)-1);
						$temp = $temp2;
					}
					else
						$temp = is_numeric($temp) ? intval($temp) : htmlspecialchars($temp);

					$profile_names[$name] = $temp;
					$sql2_tmp .= $name . " = '".str_replace("\'","''",$profile_names[$name])."', ";
				}
				 if ( !empty($sql2_tmp) )
				 {
				  $sql2_tmp = substr($sql2_tmp,0,strlen($sql2_tmp)-2);
				  $sql2 = "UPDATE " . USERS_TABLE . "
					  SET ".$sql2_tmp."
					WHERE user_id = ".$user_id;
				  
				  if(!$db->sql_query($sql2))
						message_die(GENERAL_ERROR,'Could not update custom profile fields','',__LINE__,__FILE__,$sql2);
				 }
				//
				// END Custom Profile Fields MOD
				//

				// We remove all stored login keys since the password has been updated
				// and change the current one (if applicable)
				if ( !empty($passwd_sql) )
				{
					session_reset_keys($user_id, $user_ip);
				}
				
				$message .= $lang['Admin_user_updated'];
			}
			else
			{
				message_die(GENERAL_ERROR, 'Admin_user_fail', '', __LINE__, __FILE__, $sql);
			}

			$message .= '<br /><br />' . sprintf($lang['Click_return_useradmin'], '<a href="' . append_sid("admin_users.$phpEx") . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . append_sid("index.$phpEx?pane=right") . '">', '</a>');

			message_die(GENERAL_MESSAGE, $message);
		}
		else
		{
			$template->set_filenames(array(
				'reg_header' => 'error_body.tpl')
			);

			$template->assign_vars(array(
				'ERROR_MESSAGE' => $error_msg)
			);

			$template->assign_var_from_handle('ERROR_BOX', 'reg_header');

			$username = htmlspecialchars(stripslashes($username));
			$email = stripslashes($email);
			$password = '';
			$password_confirm = '';

			$icq = stripslashes($icq);
			$aim = htmlspecialchars(str_replace('+', ' ', stripslashes($aim)));
			$msn = htmlspecialchars(stripslashes($msn));
			$yim = htmlspecialchars(stripslashes($yim));

			$website = htmlspecialchars(stripslashes($website));
			$location = htmlspecialchars(stripslashes($location));
			$occupation = htmlspecialchars(stripslashes($occupation));
			$interests = htmlspecialchars(stripslashes($interests));
			$user_absence_text = htmlspecialchars(stripslashes($user_absence_text));
			$signature = htmlspecialchars(stripslashes($signature));

			$user_lang = stripslashes($user_lang);
			$user_dateformat = htmlspecialchars(stripslashes($user_dateformat));
		}
	}
	else if( !isset( $_POST['submit'] ) && $mode != 'save' && !isset( $_POST['avatargallery'] ) && !isset( $_POST['submitavatar'] ) && !isset( $_POST['cancelavatar'] ) )
	{
		if( isset( $_GET[POST_USERS_URL]) || isset( $_POST[POST_USERS_URL]) )
		{
			$user_id = ( isset( $_POST[POST_USERS_URL]) ) ? intval( $_POST[POST_USERS_URL]) : intval( $_GET[POST_USERS_URL]);
			$this_userdata = get_userdata($user_id);
			if( !$this_userdata )
			{
				message_die(GENERAL_MESSAGE, $lang['No_user_id_specified'] );
			}
		}
		else
		{
			$this_userdata = get_userdata($_POST['username'], true);
			if( !$this_userdata )
			{
				message_die(GENERAL_MESSAGE, $lang['No_user_id_specified'] );
			}
		}
		// Start add - Admin add user MOD
		if ($new_user)
		{
			$this_userdata['username'] = $_POST['username'];
			$this_userdata['user_email'] = '';
			$this_userdata['user_passwd_change'] = 0;
		} else
		{
			$template->assign_block_vars('switch_show_delete', array());
		}
		// End add - Admin add user MOD
		//
		// Now parse and display it as a template
		//
		$user_id = $this_userdata['user_id'];
		$username = $this_userdata['username'];
		$email = $this_userdata['user_email'];
		$password = '';
		$password_confirm = '';

		$icq = $this_userdata['user_icq'];
		$aim = htmlspecialchars(str_replace('+', ' ', $this_userdata['user_aim'] ));
		$msn = htmlspecialchars($this_userdata['user_msnm']);
		$yim = htmlspecialchars($this_userdata['user_yim']);

		$website = htmlspecialchars($this_userdata['user_website']);
		$location = htmlspecialchars($this_userdata['user_from']);
		// FLAGHACK-start
		$user_flag = htmlspecialchars($this_userdata['user_from_flag']);	
		// FLAGHACK-end
		$occupation = htmlspecialchars($this_userdata['user_occ']);
		$interests = htmlspecialchars($this_userdata['user_interests']);
		$user_absence = $this_userdata['user_absence'];
		$user_absence_mode = $this_userdata['user_absence_mode'];
		$user_absence_text = htmlspecialchars($this_userdata['user_absence_text']);
		// Start add - Gender MOD
		$gender = $this_userdata['user_gender'];
		// End add - Gender MOD
		// Start add - Birthday MOD
		$next_birthday_greeting = $this_userdata['user_next_birthday_greeting'];
		if ($this_userdata['user_birthday']!=999999)
		{
			$birthday = realdate($lang['Submit_date_format'],$this_userdata['user_birthday']);
			$b_day = realdate('j',$this_userdata['user_birthday']);
			$b_md = realdate('n',$this_userdata['user_birthday']);
			$b_year = realdate('Y',$this_userdata['user_birthday']);
		} else
		{
			$b_day = '';
			$b_md = '';
			$b_year = '';
			$birthday = '';
		}
		// End add - Birthday MOD

		$signature = ($this_userdata['user_sig_bbcode_uid'] != '') ? preg_replace('#:' . $this_userdata['user_sig_bbcode_uid'] . '#si', '', $this_userdata['user_sig']) : $this_userdata['user_sig'];
		$signature = preg_replace($html_entities_match, $html_entities_replace, $signature);

		$viewemail = $this_userdata['user_viewemail'];
		$notifypm = $this_userdata['user_notify_pm'];
		$popuppm = $this_userdata['user_popup_pm'];
		$notifyreply = $this_userdata['user_notify'];
		$attachsig = $this_userdata['user_attachsig'];
		$setbm = $this_userdata['user_setbm'];
		
		$allowhtml = $this_userdata['user_allowhtml'];
		$allowbbcode = $this_userdata['user_allowbbcode'];
		$allowsmilies = $this_userdata['user_allowsmile'];
		$allowviewonline = $this_userdata['user_allow_viewonline'];

		$user_avatar = $this_userdata['user_avatar'];
		$user_avatar_type = $this_userdata['user_avatar_type'];
		$user_style = $this_userdata['user_style'];
		$user_lang = $this_userdata['user_lang'];
		$user_timezone = $this_userdata['user_timezone'];
		$user_dateformat = htmlspecialchars($this_userdata['user_dateformat']);
		
		$user_status = $this_userdata['user_active'];
		$user_ycard = $this_userdata['user_warnings'];
		$user_allowavatar = $this_userdata['user_allowavatar'];
		$user_allowpm = $this_userdata['user_allow_pm'];
		
		$COPPA = false;

		$html_status =  ($this_userdata['user_allowhtml'] ) ? $lang['HTML_is_ON'] : $lang['HTML_is_OFF'];
		$bbcode_status = ($this_userdata['user_allowbbcode'] ) ? $lang['BBCode_is_ON'] : $lang['BBCode_is_OFF'];
		$smilies_status = ($this_userdata['user_allowsmile'] ) ? $lang['Smilies_are_ON'] : $lang['Smilies_are_OFF'];
	}

	if( isset($_POST['avatargallery']) && !$error )
	{
		if( !$error )
		{
			$user_id = intval($_POST['id']);

			$template->set_filenames(array(
				"body" => "admin/user_avatar_gallery.tpl")
			);

			$dir = @opendir("../" . $board_config['avatar_gallery_path']);

			$avatar_images = array();
			while( $file = @readdir($dir) )
			{
				if( $file != "." && $file != ".." && !is_file(phpbb_realpath("./../" . $board_config['avatar_gallery_path'] . "/" . $file)) && !is_link(phpbb_realpath("./../" . $board_config['avatar_gallery_path'] . "/" . $file)) )
				{
					$sub_dir = @opendir("../" . $board_config['avatar_gallery_path'] . "/" . $file);

					$avatar_row_count = 0;
					$avatar_col_count = 0;

					while( $sub_file = @readdir($sub_dir) )
					{
						if( preg_match("/(\.gif$|\.png$|\.jpg)$/is", $sub_file) )
						{
							$avatar_images[$file][$avatar_row_count][$avatar_col_count] = $sub_file;

							$avatar_col_count++;
							if( $avatar_col_count == 5 )
							{
								$avatar_row_count++;
								$avatar_col_count = 0;
							}
						}
					}
				}
			}
	
			@closedir($dir);

			if( isset($_POST['avatarcategory']) )
			{
				$category = htmlspecialchars($_POST['avatarcategory']);
			}
			else
			{
				list($category, ) = each($avatar_images);
			}
			@reset($avatar_images);

			$s_categories = "";
			while( list($key) = each($avatar_images) )
			{
				$selected = ( $key == $category ) ? "selected=\"selected\"" : "";
				if( count($avatar_images[$key]) )
				{
					$s_categories .= '<option value="' . $key . '"' . $selected . '>' . ucfirst($key) . '</option>';
				}
			}

			$s_colspan = 0;
			for($i = 0; $i < count($avatar_images[$category]); $i++)
			{
				$template->assign_block_vars("avatar_row", array());

				$s_colspan = max($s_colspan, count($avatar_images[$category][$i]));

				for($j = 0; $j < count($avatar_images[$category][$i]); $j++)
				{
					$template->assign_block_vars("avatar_row.avatar_column", array(
						"AVATAR_IMAGE" => "../" . $board_config['avatar_gallery_path'] . '/' . $category . '/' . $avatar_images[$category][$i][$j])
					);

					$template->assign_block_vars("avatar_row.avatar_option_column", array(
						"S_OPTIONS_AVATAR" => $avatar_images[$category][$i][$j])
					);
				}
			}

			$coppa = ( ( !$_POST['coppa'] && !$_GET['coppa'] ) || $mode == "register") ? 0 : TRUE;

			$s_hidden_fields = '<input type="hidden" name="mode" value="edit" /><input type="hidden" name="agreed" value="true" /><input type="hidden" name="coppa" value="' . $coppa . '" /><input type="hidden" name="avatarcatname" value="' . $category . '" />';
			// Start add - Admin add user MOD
			$s_hidden_fields .= '<input type="hidden" name="new_user" value="'.$new_user.'" />';
			// End add - Admin add user MOD
			$s_hidden_fields .= '<input type="hidden" name="id" value="' . $user_id . '" />';
			
			$s_hidden_fields .= '<input type="hidden" name="username" value="' . str_replace("\"", "&quot;", $username) . '" />';
			$s_hidden_fields .= '<input type="hidden" name="email" value="' . str_replace("\"", "&quot;", $email) . '" />';
			$s_hidden_fields .= '<input type="hidden" name="icq" value="' . str_replace("\"", "&quot;", $icq) . '" />';
			$s_hidden_fields .= '<input type="hidden" name="aim" value="' . str_replace("\"", "&quot;", $aim) . '" />';
			$s_hidden_fields .= '<input type="hidden" name="msn" value="' . str_replace("\"", "&quot;", $msn) . '" />';
			$s_hidden_fields .= '<input type="hidden" name="yim" value="' . str_replace("\"", "&quot;", $yim) . '" />';
			$s_hidden_fields .= '<input type="hidden" name="website" value="' . str_replace("\"", "&quot;", $website) . '" />';
			$s_hidden_fields .= '<input type="hidden" name="location" value="' . str_replace("\"", "&quot;", $location) . '" />';
			// FLAGHACK-start
			$s_hidden_fields .= '<input type="hidden" name="user_flag" value="' . $user_flag . '" />';
			// FLAGHACK-end
			$s_hidden_fields .= '<input type="hidden" name="occupation" value="' . str_replace("\"", "&quot;", $occupation) . '" />';
			$s_hidden_fields .= '<input type="hidden" name="interests" value="' . str_replace("\"", "&quot;", $interests) . '" />';
			$s_hidden_fields .= '<input type="hidden" name="user_absence_mode" value="' . $user_absence_mode . '" />';
			$s_hidden_fields .= '<input type="hidden" name="user_absence" value="' . $user_absence . '" />';
			$s_hidden_fields .= '<input type="hidden" name="user_absence_text" value="' . $user_absence_text . '" />';
			// Start add - Birthday MOD
			$s_hidden_fields .= '<input type="hidden" name="birthday" value="'.$birthday.'" />';
			$s_hidden_fields .= '<input type="hidden" name="next_birthday_greeting" value="'.$next_birthday_greeting.'" />';
			// End add - Birthday MOD
			$s_hidden_fields .= '<input type="hidden" name="signature" value="' . str_replace("\"", "&quot;", $signature) . '" />';
			$s_hidden_fields .= '<input type="hidden" name="viewemail" value="' . $viewemail . '" />';
			// Start add - Gender MOD
			$s_hidden_fields .= '<input type="hidden" name="gender" value="' . $gender . '" />';
			// End add - Gender MOD
			$s_hidden_fields .= '<input type="hidden" name="notifypm" value="' . $notifypm . '" />';
			$s_hidden_fields .= '<input type="hidden" name="popup_pm" value="' . $popuppm . '" />';
			$s_hidden_fields .= '<input type="hidden" name="notifyreply" value="' . $notifyreply . '" />';
			$s_hidden_fields .= '<input type="hidden" name="attachsig" value="' . $attachsig . '" />';
			$s_hidden_fields .= '<input type="hidden" name="setbm" value="' . $setbm . '" />';
			
			$s_hidden_fields .= '<input type="hidden" name="allowhtml" value="' . $allowhtml . '" />';
			$s_hidden_fields .= '<input type="hidden" name="allowbbcode" value="' . $allowbbcode . '" />';
			$s_hidden_fields .= '<input type="hidden" name="allowsmilies" value="' . $allowsmilies . '" />';
			$s_hidden_fields .= '<input type="hidden" name="hideonline" value="' . !$allowviewonline . '" />';
			$s_hidden_fields .= '<input type="hidden" name="style" value="' . $user_style . '" />'; 
			$s_hidden_fields .= '<input type="hidden" name="language" value="' . $user_lang . '" />';
			$s_hidden_fields .= '<input type="hidden" name="timezone" value="' . $user_timezone . '" />';
			$s_hidden_fields .= '<input type="hidden" name="dateformat" value="' . str_replace("\"", "&quot;", $user_dateformat) . '" />';

			$s_hidden_fields .= '<input type="hidden" name="user_status" value="' . $user_status . '" />';
			$s_hidden_fields .= '<input type="hidden" name="user_ycard" value="' . $user_ycard . '" />';
			$s_hidden_fields .= '<input type="hidden" name="user_allowpm" value="' . $user_allowpm . '" />';
			$s_hidden_fields .= '<input type="hidden" name="user_allowavatar" value="' . $user_allowavatar . '" />';
			$s_hidden_fields .= '<input type="hidden" name="user_rank" value="' . $user_rank . '" />';

			$template->assign_vars(array(
				"L_USER_TITLE" => $lang['User_admin'],
				"L_USER_EXPLAIN" => ($new_user) ? sprintf( $lang['Create_user_explain'],'<a href="'.append_sid('/profile.'.$phpEx.'?mode=viewprofile&'.POST_USERS_URL.'='.$default_user['user_id']).'">'.$default_user['username'].'</a>', DEFAULT_PASSWD ) : $lang['User_admin_explain'],
				"L_AVATAR_GALLERY" => $lang['Avatar_gallery'], 
				"L_SELECT_AVATAR" => $lang['Select_avatar'], 
				"L_RETURN_PROFILE" => $lang['Return_profile'], 
				"L_CATEGORY" => $lang['Select_category'], 
				"L_GO" => $lang['Go'],

				"S_OPTIONS_CATEGORIES" => $s_categories, 
				"S_COLSPAN" => $s_colspan, 
				"S_PROFILE_ACTION" => append_sid("admin_users.$phpEx?mode=$mode"), 
				"S_HIDDEN_FIELDS" => $s_hidden_fields)
			);
		}
	}
	else
	{
		$s_hidden_fields = '<input type="hidden" name="mode" value="save" /><input type="hidden" name="agreed" value="true" /><input type="hidden" name="coppa" value="' . $coppa . '" />';
		$s_hidden_fields .= '<input type="hidden" name="id" value="' . $this_userdata['user_id'] . '" />';
		// Start add - Admin add user MOD
		$s_hidden_fields .= '<input type="hidden" name="new_user" value="'.$new_user.'" />';
		// End add - Admin add user MOD
		if( !empty($user_avatar_local) )
		{
			$s_hidden_fields .= '<input type="hidden" name="avatarlocal" value="' . $user_avatar_local . '" /><input type="hidden" name="avatarcatname" value="' . $user_avatar_category . '" />';
		}

		if( $user_avatar_type )
		{
			switch( $user_avatar_type )
			{
				case USER_AVATAR_UPLOAD:
					$avatar = '<img src="../' . $board_config['avatar_path'] . '/' . $user_avatar . '" alt="" />';
					break;
				case USER_AVATAR_REMOTE:
					$avatar = '<img src="' . $user_avatar . '" alt="" />';
					break;
				case USER_AVATAR_GALLERY:
					$avatar = '<img src="../' . $board_config['avatar_gallery_path'] . '/' . $user_avatar . '" alt="" />';
					break;
			}
		}
		else
		{
			$avatar = "";
		}

		$sql = "SELECT * FROM " . RANKS_TABLE . "
			WHERE rank_special = 1
			ORDER BY rank_title";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not obtain ranks data', '', __LINE__, __FILE__, $sql);
		}

		$rank_select_box = '<option value="0">' . $lang['No_assigned_rank'] . '</option>';
		while( $row = $db->sql_fetchrow($result) )
		{
			$rank = $row['rank_title'];
			$rank_id = $row['rank_id'];
			
			$selected = ( $this_userdata['user_rank'] == $rank_id ) ? ' selected="selected"' : '';
			$rank_select_box .= '<option value="' . $rank_id . '"' . $selected . '>' . $rank . '</option>';
		}

		$template->set_filenames(array(
			"body" => "admin/user_edit_body.tpl")
		);

		//
		// Custom Profile Fields MOD
		//
		$profile_data = get_fields();
		
		if(count($profile_data) > 0)
		  $template->assign_block_vars('switch_custom_fields',array(
			'L_CUSTOM_FIELD_NOTICE' => $lang['custom_field_notice_admin']
			));
		
		foreach($profile_data as $field)
		{
		  $field_name = $field['field_name'];
		  $name = text_to_column($field_name);
		  
		  if($field['is_required'] == REQUIRED)
			$required = true;
		  else
			$required = false;
		  
		  if($field['users_can_view'] == DISALLOW_VIEW)
			$admin_only = true;
		  else
			$admin_only = false;
		  
		  switch($field['field_type'])
		  {
			case TEXT_FIELD:
			  $value = $this_userdata[$name];
			  $length = $field['text_field_maxlen'];
			  $field_html_code = "<input type=\"text\" class=\"post\" style=\"width: 200px\"  name=\"$name\" size=\"35\" maxlength=\"$length\" value=\"$value\" />";
			  break;
			case TEXTAREA:
			  $value = $this_userdata[$name];
			  $field_html_code = "<textarea name=\"$name\" style=\"width: 300px\" rows=\"6\" cols=\"30\" class=\"post\">$value</textarea>";
			  break;
			case RADIO:
			  $value = $this_userdata[$name];
			  $radio_list = explode(',',$field['radio_button_values']);
			  $html_list = array();
			  foreach($radio_list as $num => $radio_name)
			  {
				$temp = "<input type=\"radio\" name=\"$name\" value=\"$radio_name\"";
				if($radio_name == $value)
				  $temp .= ' checked="checked"';
				$temp .= " /> <span class=\"gen\">$radio_name</span>";
				if($num < count($radio_list))
				  $temp .= '<br />';
				$html_list[] = $temp;
			  }
			  $field_html_code = '';
			  foreach($html_list as $line)
				$field_html_code .= $line . "\n";
			  break;
			case CHECKBOX:
			  $value_array = explode(',',$this_userdata[$name]);
			  $check_list = explode(',',$field['checkbox_values']);
			  $html_list = array();
			  foreach($check_list as $num => $check_name)
			  {
				$temp = "<input type=\"checkbox\" name=\"{$name}[]\" value=\"$check_name\"";
				foreach($value_array as $val)
				  if($val == $check_name)
				  {
					$temp .= ' checked="checked"';
					break;
				  }
				$temp .= " /> <span class=\"gen\">$check_name</span>";
				if($num < count($check_list))
				  $temp .= '<br />';
				$html_list[] = $temp;
			  }
			  $field_html_code = '';
			  foreach($html_list as $line)
				$field_html_code .= $line . "\n";
			  break;
		  }
		  
		  $template->assign_block_vars('custom_fields',array(
			'NAME' => $field_name,
			'FIELD' => $field_html_code,
			'DESCRIPTION' => $description,
			'REQUIRED' => $required ? ' *' : '',
			'ADMIN_ONLY' => $admin_only ? ' &dagger;' : ''
			));
		  
		  if($field['field_description'] != NULL && !empty($field['field_description']))
			$template->assign_block_vars('custom_fields.switch_description',array(
			  'DESCRIPTION' => $field['field_description']));
		}
		//
		// END Custom Profile Fields MOD
		//

		if ( ($this_userdata['user_level'] == USER && $board_config['users_allow_absence'] == TRUE) || $this_userdata['user_level'] != USER )
		{
			$template->assign_block_vars('allow_absence', array());
		}

		$s_user_absence_mode = '<select name = "user_absence_mode">';
		$s_user_absence_mode .= '<option value = "1">' . $lang['On_holidays'] . '</option>';
		$s_user_absence_mode .= '<option value = "2">' . $lang['User_ill'] . '</option>';
		$s_user_absence_mode .= '<option value = "3">' . $lang['Longer_absenct'] . '</option>';
		$s_user_absence_mode .= '</select>';

		$s_user_absence_mode = str_replace('value = "' . $this_userdata['user_absence_mode'] . '">', 'value = "' . $this_userdata['user_absence_mode'] . '" SELECTED>' ,$s_user_absence_mode);

		// Start add - Birthday MOD
		$s_b_day = '<span class="genmed">' . $lang['Day'] . '&nbsp;</span><select name="b_day" size="1" class="gensmall"> 
		<option value="0">&nbsp;-&nbsp;</option> 
			<option value="1">&nbsp;1&nbsp;</option>
			<option value="2">&nbsp;2&nbsp;</option>
			<option value="3">&nbsp;3&nbsp;</option>
			<option value="4">&nbsp;4&nbsp;</option>
			<option value="5">&nbsp;5&nbsp;</option>
			<option value="6">&nbsp;6&nbsp;</option>
			<option value="7">&nbsp;7&nbsp;</option>
			<option value="8">&nbsp;8&nbsp;</option>
			<option value="9">&nbsp;9&nbsp;</option>
			<option value="10">&nbsp;10&nbsp;</option>
			<option value="11">&nbsp;11&nbsp;</option>
			<option value="12">&nbsp;12&nbsp;</option>
			<option value="13">&nbsp;13&nbsp;</option>
			<option value="14">&nbsp;14&nbsp;</option>
			<option value="15">&nbsp;15&nbsp;</option>
			<option value="16">&nbsp;16&nbsp;</option>
			<option value="17">&nbsp;17&nbsp;</option>
			<option value="18">&nbsp;18&nbsp;</option>
			<option value="19">&nbsp;19&nbsp;</option>
			<option value="20">&nbsp;20&nbsp;</option>
			<option value="21">&nbsp;21&nbsp;</option>
			<option value="22">&nbsp;22&nbsp;</option>
			<option value="23">&nbsp;23&nbsp;</option>
			<option value="24">&nbsp;24&nbsp;</option>
			<option value="25">&nbsp;25&nbsp;</option>
			<option value="26">&nbsp;26&nbsp;</option>
			<option value="27">&nbsp;27&nbsp;</option>
			<option value="28">&nbsp;28&nbsp;</option>
			<option value="29">&nbsp;29&nbsp;</option>
			<option value="30">&nbsp;30&nbsp;</option>
			<option value="31">&nbsp;31&nbsp;</option>
			</select>&nbsp;&nbsp;';
		$s_b_md = '<span class="genmed">' . $lang['Month'] . '&nbsp;</span><select name="b_md" size="1" class="gensmall"> 
     		<option value="0">&nbsp;-&nbsp;</option> 
			<option value="1">&nbsp;'.$lang['datetime']['January'].'&nbsp;</option>
			<option value="2">&nbsp;'.$lang['datetime']['February'].'&nbsp;</option>
			<option value="3">&nbsp;'.$lang['datetime']['March'].'&nbsp;</option>
			<option value="4">&nbsp;'.$lang['datetime']['April'].'&nbsp;</option>
			<option value="5">&nbsp;'.$lang['datetime']['May'].'&nbsp;</option>
			<option value="6">&nbsp;'.$lang['datetime']['June'].'&nbsp;</option>
			<option value="7">&nbsp;'.$lang['datetime']['July'].'&nbsp;</option>
			<option value="8">&nbsp;'.$lang['datetime']['August'].'&nbsp;</option>
			<option value="9">&nbsp;'.$lang['datetime']['September'].'&nbsp;</option>
			<option value="10">&nbsp;'.$lang['datetime']['October'].'&nbsp;</option>
			<option value="11">&nbsp;'.$lang['datetime']['November'].'&nbsp;</option>
			<option value="12">&nbsp;'.$lang['datetime']['December'].'&nbsp;</option>
			</select>&nbsp;&nbsp;';
		$s_b_day= str_replace("value=\"".$b_day."\">", "value=\"".$b_day."\" SELECTED>" ,$s_b_day);
		$s_b_md = str_replace("value=\"".$b_md."\">", "value=\"".$b_md."\" SELECTED>" ,$s_b_md);
		$s_b_year = '<span class="genmed">' . $lang['Year'] . '&nbsp;</span><input type="text" class="post" style="width: 50px" name="b_year" size="4" maxlength="4" value="' . $b_year . '" />&nbsp;&nbsp;'; 
		$i = 0;
		$s_birthday = '';
		for ($i=0;$i<=strlen($lang['Submit_date_format']);$i++)
		{
			switch ($lang['Submit_date_format'][$i])
			{
				case d:  $s_birthday .=$s_b_day;break;
				case m:  $s_birthday .=$s_b_md;break;
				case Y:  $s_birthday .=$s_b_year;break;
			}
		}
		// End add - Birthday MOD
		//
		// Start add - Gender MOD
switch ($gender) 
{ 
   case 1: $gender_male_checked="checked=\"checked\"";break; 
   case 2: $gender_female_checked="checked=\"checked\"";break; 
   default:$gender_no_specify_checked="checked=\"checked\""; 
}
// End add - Gender MOD
		
// Start add - Protect user account MOD
if ($this_userdata['user_blocktime']<time() )

{
	$template->assign_vars(array(
	'BLOCK_BY' => ($this_userdata['user_block_by']) ? sprintf($lang['Last_block_by'],decode_ip($this_userdata['user_block_by'])).'<br/>' : '',
	'BLOCK' => '<br/><input type="checkbox" name="block_account">'.sprintf ($lang['Block_user'],$board_config['block_time']) ));
} else
{
	$template->assign_vars(array(

	'BLOCK_UNTIL' => sprintf($lang['Block_until'], create_date($board_config['default_dateformat'], $this_userdata['user_blocktime'], $board_config['board_timezone']) ).'<br/>',
	'BLOCK_BY' => ($this_userdata['user_block_by']) ? sprintf($lang['Block_by'],decode_ip($this_userdata['user_block_by'])).'<br/>' : '',
	'BLOCK' => '<br/><input type="checkbox" name="unblock_account">'.$lang['Unblock_user'] )).'<br/>';
}
if ($this_userdata['user_passwd_change']>0)
{
	$l_force_new_passwd_explain = sprintf ($lang['Password_expire'],create_date($board_config['default_dateformat'],$this_userdata['user_passwd_change']+($board_config['max_password_age']*86400),$board_config['board_timezone']));
	$force_new_passwd_checked ='';
} else
{
	$l_force_new_passwd_explain = '';
	$force_new_passwd_checked = 'value="checked" checked="checked"';
}
// End add - Protect user account MOD
// End add - Advanced time management MOD 
		// Let's do an overall check for settings/versions which would prevent
		// us from doing file uploads....
		//
		$ini_val = ( phpversion() >= '4.0.0' ) ? 'ini_get' : 'get_cfg_var';
		$form_enctype = ( !@$ini_val('file_uploads') || phpversion() == '4.0.4pl1' || !$board_config['allow_avatar_upload'] || ( phpversion() < '4.0.3' && @$ini_val('open_basedir') != '' ) ) ? '' : 'enctype="multipart/form-data"';
		// FLAGHACK-start
	// query to get the list of flags
	$sql = "SELECT *
		FROM " . FLAG_TABLE . "
		ORDER BY flag_id";
	if(!$flags_result = $db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, "Couldn't obtain flags information.", "", __LINE__, __FILE__, $sql);
	}
	$flag_row = $db->sql_fetchrowset($ranksresult);
	$num_flags = $db->sql_numrows($ranksresult) ;

	// build the html select statement
	$flag_start_image = 'blank.gif' ;
	$selected = ( isset($user_flag) ) ? '' : ' selected="selected"'  ;
	$flag_select = "<select name=\"user_flag\" onChange=\"document.images['user_flag'].src = '../images/flags/'
 + this.value;\" >";
	$flag_select .= "<option value=\"blank.gif\"$selected>" . $lang['Select_Country'] . "</option>";
	for ($i = 0; $i < $num_flags; $i++)
	{
		$flag_name = $flag_row[$i]['flag_name'];
		$flag_image = $flag_row[$i]['flag_image'];
		$selected = ( isset( $user_flag) ) ? (($user_flag == $flag_image) ? 'selected="selected"' : '' ) : '' ;
		$flag_select .= "\t<option value=\"$flag_image\"$selected>$flag_name</option>";
		if ( isset( $user_flag) && ($user_flag == $flag_image))
		{
			$flag_start_image = $flag_image ;
		}
	}
	$flag_select .= '</select>';
		// FLAGHACK-end
		$template->assign_vars(array(
			'USERNAME' => $username,
			'EMAIL' => $email,
			'YIM' => $yim,
			'ICQ' => $icq,
			'MSN' => $msn,
			'AIM' => $aim,
			'OCCUPATION' => $occupation,
			'INTERESTS' => $interests,
			'L_USER_ABSENCE' => $lang['User_absence'],
			'L_USER_ABSENCE_MODE' => $lang['User_absence_mode'],
			'L_USER_ABSENCE_TEXT' => $lang['User_absence_text'],
			'USER_ABSENCE_YES' => ($user_absence) ? 'checked="checked"' : '',
			'USER_ABSENCE_NO' => (!$user_absence) ? 'checked="checked"' : '',
			'S_USER_ABSENCE_MODE' => $s_user_absence_mode,
			'S_USER_ABSENCE_TEXT' => $user_absence_text,
			// Start add - Gender MOD
			'GENDER' => $gender, 
			'GENDER_NO_SPECIFY_CHECKED' => $gender_no_specify_checked, 
			'GENDER_MALE_CHECKED' => $gender_male_checked, 
			'GENDER_FEMALE_CHECKED' => $gender_female_checked,
			// End add - Gender MOD
			// Start add - Birthday MOD
			'NEXT_BIRTHDAY_GREETING' => $next_birthday_greeting,
			'S_BIRTHDAY' => $s_birthday,
			// End add - Birthday MOD
			'LOCATION' => $location,
			// FLAGHACK-start
			'L_FLAG' => $lang['Country_Flag'],
			'FLAG_SELECT' => $flag_select,
			'FLAG_START' => $flag_start_image,
			// FLAGHACK-end
			'WEBSITE' => $website,
			'SIGNATURE' => str_replace('<br />', "\n", $signature),
			'VIEW_EMAIL_YES' => ($viewemail) ? 'checked="checked"' : '',
			'VIEW_EMAIL_NO' => (!$viewemail) ? 'checked="checked"' : '',
			'HIDE_USER_YES' => (!$allowviewonline) ? 'checked="checked"' : '',
			'HIDE_USER_NO' => ($allowviewonline) ? 'checked="checked"' : '',
			'NOTIFY_PM_YES' => ($notifypm) ? 'checked="checked"' : '',
			'NOTIFY_PM_NO' => (!$notifypm) ? 'checked="checked"' : '',
			'POPUP_PM_YES' => ($popuppm) ? 'checked="checked"' : '',
			'POPUP_PM_NO' => (!$popuppm) ? 'checked="checked"' : '',
			'ALWAYS_ADD_SIGNATURE_YES' => ($attachsig) ? 'checked="checked"' : '',
			'ALWAYS_ADD_SIGNATURE_NO' => (!$attachsig) ? 'checked="checked"' : '',
			'ALWAYS_SET_BOOKMARK_YES' => ( $setbm ) ? 'checked="checked"' : '',
			'ALWAYS_SET_BOOKMARK_NO' => ( !$setbm ) ? 'checked="checked"' : '',

			'NOTIFY_REPLY_YES' => ( $notifyreply ) ? 'checked="checked"' : '',
			'NOTIFY_REPLY_NO' => ( !$notifyreply ) ? 'checked="checked"' : '',
			'ALWAYS_ALLOW_BBCODE_YES' => ($allowbbcode) ? 'checked="checked"' : '',
			'ALWAYS_ALLOW_BBCODE_NO' => (!$allowbbcode) ? 'checked="checked"' : '',
			'ALWAYS_ALLOW_HTML_YES' => ($allowhtml) ? 'checked="checked"' : '',
			'ALWAYS_ALLOW_HTML_NO' => (!$allowhtml) ? 'checked="checked"' : '',
			'ALWAYS_ALLOW_SMILIES_YES' => ($allowsmilies) ? 'checked="checked"' : '',
			'ALWAYS_ALLOW_SMILIES_NO' => (!$allowsmilies) ? 'checked="checked"' : '',
			'AVATAR' => $avatar,
			'LANGUAGE_SELECT' => language_select($user_lang),
			'TIMEZONE_SELECT' => tz_select($user_timezone),
			'STYLE_SELECT' => style_select($user_style, 'style'),
			'DATE_FORMAT_SELECT' => date_format_select($user_dateformat, $user_timezone),
			'ALLOW_PM_YES' => ($user_allowpm) ? 'checked="checked"' : '',
			'ALLOW_PM_NO' => (!$user_allowpm) ? 'checked="checked"' : '',
			'ALLOW_AVATAR_YES' => ($user_allowavatar) ? 'checked="checked"' : '',
			'ALLOW_AVATAR_NO' => (!$user_allowavatar) ? 'checked="checked"' : '',
			'USER_ACTIVE_YES' => ($user_status) ? 'checked="checked"' : '',
			'USER_ACTIVE_NO' => (!$user_status) ? 'checked="checked"' : '', 
			'BANCARD' => $user_ycard,
			'RANK_SELECT_BOX' => $rank_select_box,
			// Start add - Protect user account MOD
			'BAD_LOGIN_COUNT' => $this_userdata['user_badlogin'],
			'FORCE_NEW_PASSWD_CHECKED' => $force_new_passwd_checked,
			// End add - Protect user account MOD
			'L_USERNAME' => $lang['Username'],
			'L_USER_TITLE' => $lang['User_admin'],
			'L_USER_EXPLAIN' => ($new_user) ? sprintf( $lang['Create_user_explain'],'<a href="'.append_sid('/profile.'.$phpEx.'?mode=viewprofile&'.POST_USERS_URL.'='.$default_user['user_id']).'">'.$default_user['username'].'</a>', DEFAULT_PASSWD ) : $lang['User_admin_explain'],
			'L_NEW_PASSWORD' => $lang['New_password'], 
			'L_PASSWORD_IF_CHANGED' => $lang['password_if_changed'],
			'L_CONFIRM_PASSWORD' => $lang['Confirm_password'],
			'L_PASSWORD_CONFIRM_IF_CHANGED' => $lang['password_confirm_if_changed'],
			'L_SUBMIT' => $lang['Submit'],
			'L_RESET' => $lang['Reset'],
			'L_ICQ_NUMBER' => $lang['ICQ'],
			'L_MESSENGER' => $lang['MSNM'],
			'L_YAHOO' => $lang['YIM'],
			'L_WEBSITE' => $lang['Website'],
			'L_AIM' => $lang['AIM'],
			'L_LOCATION' => $lang['Location'],
			'L_OCCUPATION' => $lang['Occupation'],
			'L_BOARD_LANGUAGE' => $lang['Board_lang'],
			'L_BOARD_STYLE' => $lang['Board_style'],
			'L_TIMEZONE' => $lang['Timezone'],
			'L_DATE_FORMAT' => $lang['Date_format'],
			'L_DATE_FORMAT_EXPLAIN' => $lang['Date_format_explain'],
			'L_YES' => $lang['Yes'],
			'L_NO' => $lang['No'],
			'L_INTERESTS' => $lang['Interests'],
			// Start add - Protect user account MOD
			'L_ACCOUNT_BLOCK' => $lang['Account_block'],
			'L_ACCOUNT_BLOCK_EXPLAIN' => $lang['Account_block_explain'],
			'L_UNBLOCK' => $lang['Unblock_user'],
			'L_BAD_LOGIN_COUNT' => $lang['Badlogin_count'],
			'L_FORCE_NEW_PASSWD' => $lang['Force_new_passwd'],
			'L_FORCE_NEW_PASSWD_EXPLAIN' => $l_force_new_passwd_explain,
			// End add - Protect user account MOD
			'L_BANCARD' => $lang['ban_card'], 
			'L_BANCARD_EXPLAIN' => sprintf($lang['ban_card_explain'], $board_config['max_user_bancard']),
			// Start add - Gender MOD
			'L_GENDER' =>$lang['Gender'], 
			'L_GENDER_MALE' =>$lang['Male'], 
			'L_GENDER_FEMALE' =>$lang['Female'], 
			'L_GENDER_NOT_SPECIFY' =>$lang['No_gender_specify'],
			// End add - Gender MOD
			// Start add - Birthday MOD
			'L_BIRTHDAY' => $lang['Birthday'],
			'L_NEXT_BIRTHDAY_GREETING' => $lang['Next_birthday_greeting'],
			'L_NEXT_BIRTHDAY_GREETING_EXPLAIN' => $lang['Next_birthday_greeting_expain'],
			// End add - Birthday MOD
			'L_ALWAYS_ALLOW_SMILIES' => $lang['Always_smile'],
			'L_ALWAYS_ALLOW_BBCODE' => $lang['Always_bbcode'],
			'L_ALWAYS_ALLOW_HTML' => $lang['Always_html'],
			'L_HIDE_USER' => $lang['Hide_user'],
			'L_ALWAYS_ADD_SIGNATURE' => $lang['Always_add_sig'],
			'L_ALWAYS_SET_BOOKMARK' => $lang['Always_set_bm'],

			'L_SPECIAL' => $lang['User_special'],
			'L_SPECIAL_EXPLAIN' => $lang['User_special_explain'],
			'L_USER_ACTIVE' => $lang['User_status'],
			'L_ALLOW_PM' => $lang['User_allowpm'],
			'L_ALLOW_AVATAR' => $lang['User_allowavatar'],
			
			'L_AVATAR_PANEL' => $lang['Avatar_panel'],
			'L_AVATAR_EXPLAIN' => $lang['Admin_avatar_explain'],
			'L_DELETE_AVATAR' => $lang['Delete_Image'],
			'L_CURRENT_IMAGE' => $lang['Current_Image'],
			'L_UPLOAD_AVATAR_FILE' => $lang['Upload_Avatar_file'],
			'L_UPLOAD_AVATAR_URL' => $lang['Upload_Avatar_URL'],
			'L_AVATAR_GALLERY' => $lang['Select_from_gallery'],
			'L_SHOW_GALLERY' => $lang['View_avatar_gallery'],
			'L_LINK_REMOTE_AVATAR' => $lang['Link_remote_Avatar'],

			'L_SIGNATURE' => $lang['Signature'],
			'L_SIGNATURE_EXPLAIN' => sprintf($lang['Signature_explain'], $board_config['max_sig_chars'] ),
			'L_NOTIFY_ON_PRIVMSG' => $lang['Notify_on_privmsg'],
			'L_NOTIFY_ON_REPLY' => $lang['Always_notify'],
			'L_POPUP_ON_PRIVMSG' => $lang['Popup_on_privmsg'],
			'L_PREFERENCES' => $lang['Preferences'],
			'L_PUBLIC_VIEW_EMAIL' => $lang['Public_view_email'],
			'L_ITEMS_REQUIRED' => $lang['Items_required'],
			'L_REGISTRATION_INFO' => $lang['Registration_info'],
			'L_PROFILE_INFO' => $lang['Profile_info'],
			'L_PROFILE_INFO_NOTICE' => $lang['Profile_info_warn'],
			'L_EMAIL_ADDRESS' => $lang['Email_address'],
			'S_FORM_ENCTYPE' => $form_enctype,

			'HTML_STATUS' => $html_status,
			'BBCODE_STATUS' => sprintf($bbcode_status, '<a href="../' . append_sid("faq.$phpEx?mode=bbcode") . '" target="_phpbbcode">', '</a>'), 
			'SMILIES_STATUS' => $smilies_status,

			'L_DELETE_USER' => $lang['User_delete'],
			'L_DELETE_USER_EXPLAIN' => $lang['User_delete_explain'],
			'L_SELECT_RANK' => $lang['Rank_title'],

			'S_HIDDEN_FIELDS' => $s_hidden_fields,
			'S_PROFILE_ACTION' => append_sid("admin_users.$phpEx"))
		);

		if( file_exists(@phpbb_realpath('./../' . $board_config['avatar_path'])) && ($board_config['allow_avatar_upload'] == TRUE) )
		{
			if ( $form_enctype != '' )
			{
				$template->assign_block_vars('avatar_local_upload', array() );
			}
			$template->assign_block_vars('avatar_remote_upload', array() );
		}

		if( file_exists(@phpbb_realpath('./../' . $board_config['avatar_gallery_path'])) && ($board_config['allow_avatar_local'] == TRUE) )
		{
			$template->assign_block_vars('avatar_local_gallery', array() );
		}
		
		if( $board_config['allow_avatar_remote'] == TRUE )
		{
			$template->assign_block_vars('avatar_remote_link', array() );
		}
	}

	$template->pparse('body');
}
else
{
	//
	// Default user selection box
	//
	$template->set_filenames(array(
		'body' => 'admin/user_select_body.tpl')
	);
	// Start add - Admin add user MOD
	$template->assign_block_vars('switch_add_user_on', array());
	// End add - Admin add user MOD
	$template->assign_vars(array(
		'L_USER_TITLE' => $lang['User_admin'],
		'L_USER_EXPLAIN' => $lang['User_admin_explain'],
		'L_USER_SELECT' => $lang['Select_a_User'],
		'L_LOOK_UP' => $lang['Look_up_user'],
		'L_FIND_USERNAME' => $lang['Find_username'],
		// Start add - Admin add user MOD
		'L_CREATE_USER' => $lang['Create_user'],
		// End add - Admin add user MOD
		'U_SEARCH_USER' => append_sid("./../search.$phpEx?mode=searchuser"), 

		'S_USER_ACTION' => append_sid("admin_users.$phpEx"),
		'S_USER_SELECT' => $select_list)
	);
	$template->pparse('body');

}

include('./page_footer_admin.'.$phpEx);

?>
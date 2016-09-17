<?php
/***************************************************************************
 *                                login.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: login.php,v 1.47.2.15 2004/03/18 18:15:51 acydburn Exp $
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

//
// Allow people to reach login page if
// board is shut down
//
define('IN_LOGIN', true);

define('IN_PHPBB', true);
$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);

//
// Set page ID for session management
//
$userdata = session_pagestart($user_ip, PAGE_LOGIN);
init_userprefs($userdata);
//
// End session management
//

// session id check
if (!empty($_POST['sid']) || !empty($_GET['sid']))
{
	$sid = (!empty($_POST['sid'])) ? $_POST['sid'] : $_GET['sid'];
}
else
{
	$sid = '';
}
//
// CBACK CrackerTracker Visual Login Confirmation
// visual confirmation code Generator taken from phpBB (c) phpBB Group
//
if ( isset($_GET['mode']) || isset($_POST['mode']) )
{
	$mode = ( isset($_GET['mode']) ) ? $_GET['mode'] : $_POST['mode'];
	$mode = htmlspecialchars($mode);

	if ( $mode == 'confirm' )
	{
		if ( $userdata['session_logged_in'] )
		{
			exit;
		}
		if (function_exists(imagettftext) && defined('ADV_CAPTCHA'))
			include($phpbb_root_path . 'ctracker/ct_confirm_adv.'.$phpEx);
		else
			include($phpbb_root_path . 'ctracker/ct_confirm.'.$phpEx);
		exit;
	}
}
//
// Now we check if the User is trying to Log in if he already has used one attempt or not
// if not we disable the Visual Confirmation Code and with this we allow a normal login without any Confirmation
// if the User tried to log in once we just continue with the normal Script and then we show the Visible Code every time the user
// tries to log in before checking Password or anything.
// Well OK its more DB gaming but many users want comfort AND security so let's do it ;-)
//
if(!empty($_POST['username']) && $ctracker_config['loginfeature'] == 1)
{
	$secure_username = '';
	$secure_username = isset($_POST['username']) ? phpbb_clean_username($_POST['username']) : '';
	$sql = "SELECT ct_logintry FROM " . USERS_TABLE . " WHERE username = '" . str_replace("\\'", "''", $secure_username) . "'";
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Error in obtaining userdata', '', __LINE__, __FILE__, $sql);
	}
	if( $row = $db->sql_fetchrow($result) )
	{
		if($row['ct_logintry'] == 0)
		{
			$ctracker_config['loginfeature'] = 0;
		}
	} 
}
else
{
	$ctracker_config['loginfeature'] = 0;
}


if ( $ctracker_config['loginfeature'] == 1 && !$userdata['session_logged_in'] && !empty($_POST['confirm_id']) && !empty($_POST['confirm_code']))
{
	$confirm_id = htmlspecialchars($_POST['confirm_id']);
	
	if (!preg_match('/^[A-Za-z0-9]+$/', $confirm_id))
	{
		$confirm_id = '';
	}

	$sql = 'SELECT code
		FROM ' . CTVISKEY . "
		WHERE confirm_id = '$confirm_id'
			AND session_id = '" . $userdata['session_id'] . "'";
	if (!($result = $db->sql_query($sql)))
	{
		message_die(GENERAL_ERROR, 'Could not obtain confirmation code', __LINE__, __FILE__, $sql);
	}

	if ($row = $db->sql_fetchrow($result))
	{
		if ($row['code'] != $_POST['confirm_code'])
		{
			message_die(GENERAL_MESSAGE, $lang['ct_forum_sl1']);
		}
		else
		{
			$sql = 'DELETE FROM ' . CTVISKEY . "
				WHERE confirm_id = '$confirm_id'
					AND session_id = '" . $userdata['session_id'] . "'";
			if (!$db->sql_query($sql))
			{
				message_die(GENERAL_ERROR, 'Could not delete confirmation code', __LINE__, __FILE__, $sql);
			}
		}
	}
	else
	{
			message_die(GENERAL_MESSAGE, $lang['ct_forum_sl1']);
	}
	$db->sql_freeresult($result);
}

$vcheck_need  = FALSE;
$vcheck_login = TRUE;
if($ctracker_config['loginfeature'] == 1 )
{
	$vcheck_need = TRUE;
	$vcheck_login = FALSE;
}

if (($vcheck_need = FALSE || $userdata['session_logged_in']) or (isset($_GET['logout']) || !empty($_POST['confirm_id']) && !empty($_POST['confirm_code'])))
{
	$vcheck_login = TRUE;
}
// CBACK CrackerTracker Visual Login Confirmation
//

if(( $vcheck_login == TRUE ) and ( isset($_POST['login']) || isset($_GET['login']) || isset($_POST['logout']) || isset($_GET['logout']) ) )
{
	if( ( isset($_POST['login']) || isset($_GET['login']) ) && (!$userdata['session_logged_in'] || isset($_POST['admin'])) )
	{
		$username = isset($_POST['username']) ? phpbb_clean_username($_POST['username']) : '';
		$password = isset($_POST['password']) ? $_POST['password'] : '';

		$sql = "SELECT user_id, username, user_password, user_active, user_level, user_login_tries, user_last_login_try, user_badlogin, user_blocktime, user_email, user_lang, user_timezone,user_passwd_change
			FROM " . USERS_TABLE . "
			WHERE username = '" . str_replace("\\'", "''", $username) . "'";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Error in obtaining userdata', '', __LINE__, __FILE__, $sql);
		}

		if( $row = $db->sql_fetchrow($result) )
		{
			if( $row['user_level'] != ADMIN && $board_config['board_disable'] )
			{
				redirect(append_sid("portal.$phpEx", true));
			}
			else
			{
				// Start add - Protect user account MOD
				if ($row['user_blocktime']<time() )
				{
					/*
					// If the last login is more than x minutes ago, then reset the login tries/time
					if ($row['user_last_login_try'] && $board_config['login_reset_time'] && $row['user_last_login_try'] < (time() - ($board_config['login_reset_time'] * 60)))
					{
						$db->sql_query('UPDATE ' . USERS_TABLE . ' SET user_login_tries = 0, user_last_login_try = 0 WHERE user_id = ' . $row['user_id']);
						$row['user_last_login_try'] = $row['user_login_tries'] = 0;
					}
					
					// Check to see if user is allowed to login again... if his tries are exceeded
					if ($row['user_last_login_try'] && $board_config['login_reset_time'] && $board_config['max_login_attempts'] && 
						$row['user_last_login_try'] >= (time() - ($board_config['login_reset_time'] * 60)) && $row['user_login_tries'] >= $board_config['max_login_attempts'] && $userdata['user_level'] != ADMIN)
					{
						message_die(GENERAL_MESSAGE, sprintf($lang['Login_attempts_exceeded'], $board_config['max_login_attempts'], $board_config['login_reset_time']));
					}
					*/
					// End add - Protect user account MOD
					if( md5($password) == $row['user_password'] && $row['user_active'] )
					{
						$autologin = ( isset($_POST['autologin']) ) ? TRUE : 0;
	
						$admin = (isset($HTTP_POST_VARS['admin'])) ? 1 : 0;
						$session_id = session_begin($row['user_id'], $user_ip, PAGE_INDEX, FALSE, $autologin, $admin);
						$sql = 'UPDATE ' . USERS_TABLE . ' SET ct_logintry = 0 WHERE user_id = ' . $row['user_id'];
							if( !$db->sql_query($sql))
							{
							  message_die(CRITICAL_ERROR, "Could not perform Database operation", "", __LINE__, __FILE__, $sql);
							}
	
						// Start add - Protect user account MOD
						/*
						// Reset login tries
						$db->sql_query('UPDATE ' . USERS_TABLE . ' SET user_login_tries = 0, user_last_login_try = 0 WHERE user_id = ' . $row['user_id']);
						*/
						// End add - Protect user account MOD
	
						if( $session_id )
						{
							// Start add - Protect user account MOD
							$sql = "UPDATE " . USERS_TABLE . " SET user_badlogin='0'
								WHERE username = '" . str_replace("\'", "''", $username) . "'";
							if ( !($result = $db->sql_query($sql)) )
							{
								message_die(GENERAL_ERROR, 'Error updating correct login data', '', __LINE__, __FILE__, $sql);
							}
							// End add - Protect user account MOD
							$url = ( !empty($_POST['redirect']) ) ? str_replace('&amp;', '&', htmlspecialchars($_POST['redirect'])) : "portal.$phpEx";
							// Start add - Protect user account MOD
							if ($session_id['user_id']!=ANONYMOUS )
							{
								include($phpbb_root_path . "includes/functions_validate.$phpEx");
								$pass_result = validate_complex_password ($username, $password);
								if ( $session_id['user_passwd_change']==0 || $pass_result['error']== true)
								{
									//force a change of password, do not allow a secound login
									$sql = "UPDATE " . USERS_TABLE . " SET user_passwd_change='-9999'
									WHERE user_id = '" . $session_id['user_id'] . "'";
									if ( !($result = $db->sql_query($sql)) )
									{
										message_die(GENERAL_ERROR, 'Error updating correct login data2', '', __LINE__, __FILE__, $sql);
									}
									$url .= ( ereg( "\?" , $url) ) ? '&ch_passwd=1' : '?ch_passwd=1';
								} else
								if ((  intval((time()-$session_id['user_passwd_change']) / 86400) >= $board_config['max_password_age'])&&$board_config['max_password_age'] > 0)
								{
									session_end($session_id['session_id'], $session_id['user_id']);
									$message = $lang['Passwd_have_expired'] . '<br /><br /><a href="'.append_sid("profile.$phpEx?mode=sendpassword").'">'.$lang['Send_new_passwd'].'</a><br /><br />' .  sprintf($lang['Click_return_portal'], '<a href="' . append_sid("portal.$phpEx") . '">', '</a>');
									message_die(GENERAL_MESSAGE, $message);
								} else
								if (( intval((time()-$session_id['user_passwd_change']) / 86400)+(($board_config['max_password_age']<14) ? 1 : 14) >= $board_config['max_password_age'] )&&$board_config['max_password_age'] > 0)
								{
									$url .= ( ereg( "\?" , $url) ) ? '&ch_passwd=1' : '?ch_passwd=1';
								}
							}
							// End add - Protect user account MOD
							redirect(append_sid($url, true));
						}
						else
						{
							message_die(CRITICAL_ERROR, "Couldn't start session : login", "", __LINE__, __FILE__);
						}
					}
					// Only store a failed login attempt for an active user - inactive users can't login even with a correct password
					elseif( $row['user_active'] )
					{
						// Start add - Protect user account MOD
						/*
						// Save login tries and last login
						if ($row['user_id'] != ANONYMOUS)
						{
							$sql = 'UPDATE ' . USERS_TABLE . '
								SET user_login_tries = user_login_tries + 1, user_last_login_try = ' . time() . '
								WHERE user_id = ' . $row['user_id'];
							$db->sql_query($sql);
						}
						*/
						// End add - Protect user account MOD
						if ($row['user_id'] != ANONYMOUS)
						{
							$sql = 'UPDATE ' . USERS_TABLE . '
								SET ct_logintry = 1
								WHERE user_id = ' . $row['user_id'];
								
							if( !$db->sql_query($sql))
								{
								  message_die(CRITICAL_ERROR, "Could not perform Database operation", "", __LINE__, __FILE__, $sql);
								}
						}
	
						// Start add - Protect user account MOD
						//count bad login
						// block the user for X min
						$blocktime = '';
						if (($row['user_badlogin']+1) % $board_config['max_login_error'])
						{
							$sql = "UPDATE " . USERS_TABLE . " SET user_badlogin=user_badlogin+1
								WHERE username = '" . str_replace("\'", "''", $username) . "'";
							if ( !($result = $db->sql_query($sql)) )
							{
								message_die(GENERAL_ERROR, 'Error updating bad login data'.$user_ip, '', __LINE__, __FILE__, $sql);
							}
						} else
						{
							$blocktime = ", user_block_by='$user_ip', user_blocktime='" . (time()+($board_config['block_time']*60)) . "'";
							$sql = "UPDATE " . USERS_TABLE . " SET user_badlogin=user_badlogin+1 $blocktime
								WHERE username = '" . str_replace("\'", "''", $username) . "'";
							if ( !($result = $db->sql_query($sql)) )
							{
								message_die(GENERAL_ERROR, 'Error updating bad login data'.$user_ip, '', __LINE__, __FILE__, $sql);
							}
					
							if ($row['user_email']  && $row['user_blocktime']<(time()-3600))
							{
								include($phpbb_root_path . 'includes/emailer.'.$phpEx); 
								$server_name = trim($board_config['server_name']);
								$emailer = new emailer($board_config['smtp_delivery']); 
								$emailer->email_address($row['user_email']); 
								$email_headers = "To: \"".$row['username']."\" <".$row['user_email']. ">\r\n"; 
								$email_headers .= "From: \"".$board_config['sitename']."\" <".$board_config['board_email'].">\r\n"; 
								$email_headers .= "X-AntiAbuse: Board servername - " . $server_name . "\r\n"; 
								$email_headers .= "X-AntiAbuse: User IP - " . decode_ip($user_ip) . "\r\n"; 
								$emailer->use_template('bad_login', $row['user_lang']);
								$emailer->extra_headers($email_headers); 
								$emailer->assign_vars(array( 
									'USER' => '"'.$row['username'].'"',
									'BLOCK_TIME' => $board_config['block_time'],
									'BAD_LOGINS' => $row['user_badlogin']+1, 
									'BLOCK_UNTIL' => create_date ($lang['Time_format'],time()+($board_config['block_time']*60),$row['user_timezone']),
									'SITENAME' => $board_config['sitename'], 
									'BOARD_EMAIL' => $board_config['board_email'])); 
								$emailer->send(); 
								$emailer->reset(); 
							}
						}
						// End add - Protect user account MOD
					}
				}
				$redirect = ( !empty($_POST['redirect']) ) ? str_replace('&amp;', '&', htmlspecialchars($_POST['redirect'])) : '';
				$redirect = str_replace('?', '&', $redirect);
				
				if (strstr(urldecode($redirect), "\n") || strstr(urldecode($redirect), "\r") || strstr(urldecode($redirect), ';url'))
				{
					message_die(GENERAL_ERROR, 'Tried to redirect to potentially insecure url.');
				}
				
				$template->assign_vars(array(
					'META' => "<meta http-equiv=\"refresh\" content=\"3;url=login.$phpEx?redirect=$redirect\">")
				);

			// Start add - Protect user account MOD
		/*
				$message = $lang['Error_login'] . '<br /><br />' . sprintf($lang['Click_return_login'], "<a href=\"login.$phpEx?redirect=$redirect\">", '</a>') . '<br /><br />' .  sprintf($lang['Click_return_index'], '<a href="' . append_sid("index.$phpEx") . '">', '</a>');
		*/
				$message = ( ($blocktime && $lang['Error_login_tomutch'])?$lang['Error_login_tomutch']:$lang['Error_login'] ) . '<br /><br />' . sprintf($lang['Click_return_login'], '<a href="' . append_sid("login.$phpEx?redirect=$redirect") . '">', '</a>') . '<br /><br />' .  sprintf($lang['Click_return_index'], '<a href="' . append_sid("index.$phpEx") . '">', '</a>');
				// End add - Protect user account MOD
				message_die(GENERAL_MESSAGE, $message);
			}
		}
		else
		{
			$redirect = ( !empty($_POST['redirect']) ) ? str_replace('&amp;', '&', htmlspecialchars($_POST['redirect'])) : "";
			$redirect = str_replace("?", "&", $redirect);
			
			if (strstr(urldecode($redirect), "\n") || strstr(urldecode($redirect), "\r") || strstr(urldecode($redirect), ';url'))
			{
				message_die(GENERAL_ERROR, 'Tried to redirect to potentially insecure url.');
			}
			
			$template->assign_vars(array(
				'META' => "<meta http-equiv=\"refresh\" content=\"3;url=login.$phpEx?redirect=$redirect\">")
			);

			$message = $lang['Error_login'] . '<br /><br />' . sprintf($lang['Click_return_login'], "<a href=\"login.$phpEx?redirect=$redirect\">", '</a>') . '<br /><br />' .  sprintf($lang['Click_return_index'], '<a href="' . append_sid("index.$phpEx") . '">', '</a>');

			message_die(GENERAL_MESSAGE, $message);
		}
	}
	else if( ( isset($_GET['logout']) || isset($_POST['logout']) ) && $userdata['session_logged_in'] )
	{
		// session id check
		if ($sid == '' || $sid != $userdata['session_id'])
		{
			message_die(GENERAL_ERROR, 'Invalid_session');
		}

		if( $userdata['session_logged_in'] )
		{
			session_end($userdata['session_id'], $userdata['user_id']);
		}

		if (!empty($_POST['redirect']) || !empty($_GET['redirect']))
		{
			$url = (!empty($_POST['redirect'])) ? htmlspecialchars($_POST['redirect']) : htmlspecialchars($_GET['redirect']);
			$url = str_replace('&amp;', '&', $url);
			redirect(append_sid($url, true));
		}
		else
		{
			redirect(append_sid("portal.$phpEx", true));
		}
	}
	else
	{
		$url = ( !empty($_POST['redirect']) ) ? str_replace('&amp;', '&', htmlspecialchars($_POST['redirect'])) : "portal.$phpEx";
		// Start add - Protect user account MOD
		if ($session_id['user_id']!=ANONYMOUS )
		{
			include($phpbb_root_path . "includes/functions_validate.$phpEx");
			$pass_result = validate_complex_password ($username, $password);
			if ( $session_id['user_passwd_change']==0 || $pass_result['error']== true)
			{
				//force a change of password, do not allow a secound login
				$sql = "UPDATE " . USERS_TABLE . " SET user_passwd_change='-9999'
				WHERE user_id = '" . $session_id['user_id'] . "'";
				if ( !($result = $db->sql_query($sql)) )
				{
					message_die(GENERAL_ERROR, 'Error updating correct login data2', '', __LINE__, __FILE__, $sql);
				}
				$url .= ( ereg( "\?" , $url) ) ? '&ch_passwd=1' : '?ch_passwd=1';
			} else
			if ((  intval((time()-$session_id['user_passwd_change']) / 86400) >= $board_config['max_password_age'])&&$board_config['max_password_age'] > 0)
			{
				session_end($session_id['session_id'], $session_id['user_id']);
				$message = $lang['Passwd_have_expired'] . '<br /><br /><a href="'.append_sid("profile.$phpEx?mode=sendpassword").'">'.$lang['Send_new_passwd'].'</a><br /><br />' .  sprintf($lang['Click_return_portal'], '<a href="' . append_sid("portal.$phpEx") . '">', '</a>');
				message_die(GENERAL_MESSAGE, $message);
			} else
			if ((  intval((time()-$session_id['user_passwd_change']) / 86400)+(($board_config['max_password_age']<14) ? 1 : 14) >= $board_config['max_password_age'] )&&$board_config['max_password_age'] > 0)
			{
				$url .= ( ereg( "\?" , $url) ) ? '&ch_passwd=1' : '?ch_passwd=1';
			}
		}
		// End add - Protect user account MOD
		redirect(append_sid($url, true));
	}
}
else
{
	//
	// Do a full login page dohickey if
	// user not already logged in
	//
	include_once($phpbb_root_path . 'includes/functions_jr_admin.' . $phpEx);
	$jr_admin_userdata = jr_admin_get_user_info($userdata['user_id']);
	
	if( !$userdata['session_logged_in'] || (isset($_GET['admin']) && $userdata['session_logged_in'] && (!empty($jr_admin_userdata['user_jr_admin']) || $userdata['user_level'] == ADMIN)))
	{
		$page_title = $lang['Login'];
		include($phpbb_root_path . 'includes/page_header.'.$phpEx);

		$template->set_filenames(array(
			'body' => 'login_body.tpl')
		);

		$forward_page = '';

		//
		// CBACK CrackerTracker Login Confirmation
		// Confirmation Generator Taken from phpBB (C) phpBB Group
		//
		$confirm_image = '';
		if( $ctracker_config['loginfeature'] == 1 && !$userdata['session_logged_in'])
		{
			$expiry_time = time() - $board_config['session_length'];
		
			$sql = 'SELECT session_id 
				FROM ' . SESSIONS_TABLE ." WHERE session_time>$expiry_time"; 
			if (!($result = $db->sql_query($sql)))
			{
				message_die(GENERAL_ERROR, 'Could not select session data', '', __LINE__, __FILE__, $sql);
			}
	
			if ($row = $db->sql_fetchrow($result))
			{
				$confirm_sql = '';
				do
				{
					$confirm_sql .= (($confirm_sql != '') ? ', ' : '') . "'" . $row['session_id'] . "'";
				}
				while ($row = $db->sql_fetchrow($result));
	
				$sql = 'DELETE FROM ' .  CTVISKEY . "
					WHERE session_id NOT IN ($confirm_sql)";
				if (!$db->sql_query($sql))
				{
					message_die(GENERAL_ERROR, 'Could not delete stale confirm data', '', __LINE__, __FILE__, $sql);
				}
			}
			$db->sql_freeresult($result);
	
			// Generate the required confirmation code
			// NB 0 (zero) could get confused with O (the letter) so we make change it
			$code = dss_rand();
			$code = strtoupper(str_replace('0', 'o', substr($code, 6)));
	
			$confirm_id = md5(uniqid($user_ip));
	
			$sql = 'INSERT INTO ' . CTVISKEY . " (confirm_id, session_id, code)
				VALUES ('$confirm_id', '". $userdata['session_id'] . "', '$code')";
			if (!$db->sql_query($sql))
			{
				message_die(GENERAL_ERROR, 'Could not insert new confirm code information', '', __LINE__, __FILE__, $sql);
			}
	
			unset($code);
	
			$confirm_image = '<img src="' . append_sid("login.$phpEx?mode=confirm&amp;id=$confirm_id") . '" alt="" title="" />';
			$hidden_form_fields .= '<input type="hidden" name="confirm_id" value="' . $confirm_id . '" />';
	
			$template->assign_block_vars('switch_confirm', array());
		}
		// CBACK CrackerTracker Login Confirmation
		//

		if( isset($_POST['redirect']) || isset($_GET['redirect']) )
		{
			$forward_to = $HTTP_SERVER_VARS['QUERY_STRING'];

			if( preg_match("/^redirect=([a-z0-9\.#\/\?&=\+\-_]+)/si", $forward_to, $forward_matches) )
			{
				$forward_to = ( !empty($forward_matches[3]) ) ? $forward_matches[3] : $forward_matches[1];
				$forward_match = explode('&', $forward_to);

				if(count($forward_match) > 1)
				{
					for($i = 1; $i < count($forward_match); $i++)
					{
						if( !ereg("sid=", $forward_match[$i]) )
						{
							if( $forward_page != '' )
							{
								$forward_page .= '&';
							}
							$forward_page .= $forward_match[$i];
						}
					}
					$forward_page = $forward_match[0] . '?' . $forward_page;
				}
				else
				{
					$forward_page = $forward_match[0];
				}
			}
		}

		$username = ( $userdata['user_id'] != ANONYMOUS ) ? $userdata['username'] : '';

		$s_hidden_fields = '<input type="hidden" name="redirect" value="' . $forward_page . '" />';

		$s_hidden_fields .= (isset($_GET['admin'])) ? '<input type="hidden" name="admin" value="1" />' : '';

		make_jumpbox('viewforum.'.$phpEx);
		$template->assign_vars(array(
			'USERNAME' => $username,

			'L_ENTER_PASSWORD' => (isset($_GET['admin'])) ? $lang['Admin_reauthenticate'] : $lang['Enter_password'],
			'L_SEND_PASSWORD' => $lang['Forgotten_password'],
			'CONFIRM_IMG' => $confirm_image,
			'L_CONFIRM_CODE' => $lang['ct_forum_slo'],

			'U_SEND_PASSWORD' => append_sid("profile.$phpEx?mode=sendpassword"),

			'S_HIDDEN_FIELDS' => $s_hidden_fields . $hidden_form_fields )
		);

		$template->pparse('body');

		include($phpbb_root_path . 'includes/page_tail.'.$phpEx);
	}
	else
	{
		redirect(append_sid("portal.$phpEx", true));
	}

}

?>
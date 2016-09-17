<?php
define('IN_PHPBB', true);
$phpbb_root_path = "./";
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);
include($phpbb_root_path . 'includes/functions_post.'.$phpEx);

$topic = (isset($_POST['topic'])) ? $_POST['topic'] : $_GET['topic']; 
$friendname =  $_POST['friendname'];
$message = $_POST['message'];
$link = $_GET['link'];
$PHP_SELF = $HTTP_SERVER_VARS['PHP_SELF'];

$userdata = session_pagestart($user_ip, PAGE_INDEX);
init_userprefs($userdata);

if( !$userdata['session_logged_in'] ) 
{ 
	redirect(append_sid("login.$phpEx?redirect=$PHP_SELF&topic=$topic&link=$link", true));
} 
        
include($phpbb_root_path . 'includes/page_header.'.$phpEx);

$mail_body = str_replace("{TOPIC}", trim(stripslashes($topic)), $lang['Tell_Friend_Body']);
$mail_body = str_replace("{LINK}", $link, $mail_body);
$mail_body = str_replace("{SITENAME}", $board_config['sitename'], $mail_body);

$template->assign_vars(array(
'L_TELL_FRIEND_TITLE' => $lang['Tell_Friend_Title'],
'L_TELL_FRIEND_EMAIL_MESSAGE' => $lang['Tell_Friend_Email_Message'],
'L_TELL_FRIEND_SENDER_USER' => $lang['Tell_Friend'],
'L_TELL_FRIEND_SENDER_USER' => $lang['Tell_Friend_Sender_User'],
'L_TELL_FRIEND_SENDER_EMAIL' => $lang['Tell_Friend_Sender_Email'],
'L_TELL_FRIEND_RECIEVER_USER' => $lang['Tell_Friend_Reciever_User'],
'L_TELL_FRIEND_RECIEVER_EMAIL' => $lang['Tell_Friend_Reciever_Email'],
'L_TELL_FRIEND_MSG' => $lang['Tell_Friend_Msg'],
'L_TELL_FRIEND_BODY' => $mail_body,
 
'SUBMIT_ACTION' => append_sid("$PHP_SELF", true),
'L_SUBMIT' => $lang['Send_email'],
'SITENAME' => $board_config['sitename'], 
'TOPIC' => trim(stripslashes($topic)), 
'LINK' => $link, 
'SENDER_NAME' => $userdata['username'], 
'SENDER_MAIL' => $userdata['user_email'], 
));

/**************/
		if ( isset($_POST['submit']) )
		{
			$error = FALSE;

			if ( !empty($_POST['friendemail']) && preg_match('/^[a-z0-9_\.\-]+@[a-z0-9\.\-]+\.[a-z]{2,}$/i', $_POST['friendemail']) )
			{
				$friendemail = trim(stripslashes($_POST['friendemail']));
				if (!$_POST['friendname']) { $friendname=substr($friendemail,0,strpos($_POST['friendemail'],"@")); };
			}
			else
			{
				$error = TRUE;
				$error_msg = "You have not entered a (valid) email address";
			}
			
			if ( strstr($_POST['friendemail'], "\n") || strstr($_POST['friendname'], "\n") ) {
				$error = TRUE;
				$error_msg = "You have not entered a (valid) email address";
			}

			if ( !$error )
			{
					include($phpbb_root_path . 'includes/emailer.'.$phpEx);
					$emailer = new emailer($board_config['smtp_delivery']);

					//$email_headers = 'Return-Path: ' . $userdata['user_email'] . "\nFrom: ". $userdata['username'] .'<'. $userdata['user_email'] .'>' . "\n";
					// The above line did not work for some people, so we use the simpler below line
					$email_headers = 'Return-Path: ' . $userdata['user_email'] . "\nFrom: ". $userdata['user_email'] ."\n";
					$email_headers .= 'X-AntiAbuse: Board servername - ' . $server_name . "\n";
					$email_headers .= 'X-AntiAbuse: User_id - ' . $userdata['user_id'] . "\n";
					$email_headers .= 'X-AntiAbuse: Username - ' . $userdata['username'] . "\n";
					$email_headers .= 'X-AntiAbuse: User IP - ' . decode_ip($user_ip) . "\r\n";

					$emailer->use_template('tellafriend_email', $user_lang);
					$emailer->email_address($friendname .'<'. $friendemail .'>');
					//$emailer->set_subject($friendname.', du wurdest eingeladen nach '. $board_config[sitename]);
					$emailer->set_subject(trim(stripslashes($topic)));
					$emailer->extra_headers($email_headers);

					$emailer->assign_vars(array(
						'SITENAME' => $board_config['sitename'], 
						'BOARD_EMAIL' => $board_config['board_email'], 
						'FROM_USERNAME' => $userdata['username'], 
						'TO_USERNAME' => $friendname, 
						'MESSAGE' => $message)
					);
					$emailer->send();
					$emailer->reset();

					$template->assign_vars(array(
						'META' => '<meta http-equiv="refresh" content="5;url=' . append_sid("index.$phpEx") . '">')
					);

					$message = $lang['Email_sent'] . '<br /><br />' . sprintf($lang['Click_return_index'],  '<a href="' . append_sid("index.$phpEx") . '">', '</a>');

					message_die(GENERAL_MESSAGE, $message);
			}

			if ( $error )
			{
				$template->set_filenames(array(
					'reg_header' => 'error_body.tpl')
				);
				$template->assign_vars(array(
					'ERROR_MESSAGE' => $error_msg)
				);
				$template->assign_var_from_handle('ERROR_BOX', 'reg_header');
			}

		}


$template->set_filenames(array('body' => 'tellafriend_body.tpl'));
$template->pparse('body');

include($phpbb_root_path . 'includes/page_tail.'.$phpEx);
?>
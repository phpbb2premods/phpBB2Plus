<?php
#########################################################
## phpBB2 Update checker
## Author: Niels Chr. Rød
## Nickname: Niels Chr. Denmark
## Email: ncr@db9.dk
##
#########################################################

define('IN_LOGIN', true);
define('IN_PHPBB', true);
$phpbb_root_path = './../';
include($phpbb_root_path . 'extension.inc');
@unlink($phpbb_root_path . 'cache/config.'.$phpEx);
include($phpbb_root_path . 'common.'.$phpEx);
include($phpbb_root_path . 'includes/functions_selects.'.$phpEx);

###########################
$forum_version = '.0.21';
$plus_version = '1.53a';
$attach_version = '2.4.3';
$ct_version = '4.1.7';

###########################


function page_output($text, $refresh = false)
{
	global $phpEx, $lang, $db;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $lang['ENCODING']; ?>">
<meta http-equiv="Content-Style-Type" content="text/css">
<title><?php echo $lang['Welcome_install'];?></title>
<link rel="stylesheet" href="./fissh/fisubsilversh.css" type="text/css">
<style type="text/css">
</style>
</head>
<body bgcolor="#E5E5E5" text="#000000" link="#006699" vlink="#5584AA">
<table class="topbkg" width="100%" cellspacing="0" cellpadding="0" border="0">
<tr> 
<td><img src="./fissh/phpbb2_logo.jpg" border="0" width="240" height="110" /></td>
<td><span class="maintitle">This Check what you need to get latest Version<img src="./fissh/spacer.gif" alt="" width="28" height="4" /></span></td>
<td align="right"><img src="./fissh/phpbb2_logor.jpg" border="0" width="140" height="110" /></td>
</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="10" align="center"> 
	<tr>
		<td class="bodyline" width="100%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
			
			<tr>
				<td><br /><br /></td>
			</tr>
			<tr>
				<td colspan="2">
				<table width="90%" border="0" align="center" cellspacing="0" cellpadding="0">
					<tr>
						<td><span class="gen"><?php echo $text; ?></span></td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td><br /><?php if($refresh) echo '<br /><center><a href="./index.'.$phpEx.'" target="_self">[  refresh  ]</a></center>'; ?><br /></td>
			</tr>
		</table></td>
	</tr>
</table>

</body>
</html>
<?php

$db->sql_close();
exit;
}

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_INDEX);
init_userprefs($userdata);
//
// End session management
if ($userdata['user_level']!=ADMIN)
{
	if ($phpbb_root_path == './../')
		redirect(append_sid("login.$phpEx?redirect=update/index.php", true));
    else
	   page_output("You are not Authorised to do this, log in as Administrator and try again"); 
}
unset($message);


if ( $_GET['mode'] == 'updatetheme' )
{

function _sql($sql, &$errored, &$error_ary, $echo_dot = true)
{
	global $db;

	if (!($result = $db->sql_query($sql)))
	{
		$errored = true;
		$error_ary['sql'][] = (is_array($sql)) ? $sql[$i] : $sql;
		$error_ary['error_code'][] = $db->sql_error();
	}

	if ($echo_dot)
	{
		echo ". \n";
		flush();
	}

	return $result;
}

	$message = '<br/><br/> <h2>set FI Subsilver Shadow:</h2> <br/>';
	
	$sql = 'SELECT themes_id FROM ' . THEMES_TABLE . " WHERE template_name = 'fisubsilversh'";
	$result = $db->sql_query($sql);
	
	if ($result)
	{
		if ($db->sql_numrows($result) > 0)
		{
			$row = $db->sql_fetchrow($result);
			$def_template_id = intval($row['themes_id']);
		} else 
			$def_template_id = false;
	}
	$db->sql_freeresult($result);
	
	if ( !$def_template_id )
	{
		$sql = 'INSERT INTO '.$table_prefix.'themes (template_name, style_name, head_stylesheet, body_background, body_bgcolor, body_text, body_link, body_vlink, body_alink, body_hlink, tr_color1, tr_color2, tr_color3, tr_class1, tr_class2, tr_class3, th_color1, th_color2, th_color3, th_class1, th_class2, th_class3, td_color1, td_color2, td_color3, td_class1, td_class2, td_class3, fontface1, fontface2, fontface3, fontsize1, fontsize2, fontsize3, fontcolor1, fontcolor2, fontcolor3, span_class1, span_class2, span_class3, img_size_poll, img_size_privmsg) VALUES ("fisubsilversh", "FI Subsilver Shadow", "fisubsilversh.css", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "row1", "row2", "", "", "", "", 0, 0, 0, "", "006600", "ffa34f", "", "", "", "", 0)';
		if ( $db->sql_query($sql) )
		{
			$sql = 'SELECT themes_id FROM ' . THEMES_TABLE . " WHERE template_name = 'fisubsilversh'";
			$result = $db->sql_query($sql);
			
			if ($result)
			{
				if ($db->sql_numrows($result) > 0)
				{
					$row = $db->sql_fetchrow($result);
					$def_template_id = intval($row['themes_id']);
				}
			}
			$db->sql_freeresult($result);
		}
	}

	$sql = 'UPDATE '.CONFIG_TABLE.' SET config_value=1 where config_name="override_user_style"';
	_sql($sql, $errored, $error_ary);
	$sql = 'UPDATE '.CONFIG_TABLE.' SET config_value='.$def_template_id.' where config_name="default_style"';  
	_sql($sql, $errored, $error_ary);
	$sql = 'UPDATE '.USERS_TABLE.' SET user_style='.$def_template_id.' where user_style>='.$def_template_id;
	_sql($sql, $errored, $error_ary);


	if ($errored)
	{
		$message .= " <b>Some queries failed, the statements and errors are listing below</b>\n<ul>";
	
		for ($i = 0; $i < count($error_ary['sql']); $i++)
		{
			$message .= "<li>Error :: <b>" . $error_ary['error_code'][$i]['message'] . "</b><br />";
			$message .= "SQL &nbsp; :: <b>" . $error_ary['sql'][$i] . "</b><br /><br /></li>";
		}
	
		$message .= "</ul>\n<p>This is probably nothing to worry about, update will continue. Should this fail to complete you may need to seek help at our development board. See <a href=\"docs\README.html\">README</a> for details on how to obtain advice.</p>\n";
	}
	else
	{
		$message .= "<b>No errors</b>\n";
	}
page_output($message, true);

} else {
	$files = true;
	//
	//---------------------------------------------
	//
	$message = '<br/><br/> <h2>Boardversion:</h2> <br/>';
	$current_version = explode('.', '2' . $board_config['version']);
	$new_version = explode('.', '2' . $forum_version);
	
	if ( ((int) $current_version[2]) < ((int) $new_version[2]) )
	{
		$message .= 'Current Version: 2' . $board_config['version'] ." Please run update_to_latest.php first to update Forum :: <a href=\"".append_sid('./update_to_latest.'.$phpEx)."\" target=\"_self\">[  process now  ]</a>";
		$files = false;
	}else
		$message .= '<span style="font-weight:bold;color:#009900">OK</span> - Current Version: 2' . $board_config['version'];
	
	//
	//---------------------------------------------
	//
	if ( !empty($attach_config['attach_version']) ) {
	$message .= '<br/><br/> <h2>Attachment-MOD:</h2> <br/>';
	$current_a_version = explode('.', $attach_config['attach_version']);
	$new_a_version = explode('.', $attach_version);
	
	if ( ( (int) $current_a_version[1] < (int) $new_a_version[1] ) || 
			( ((int) $current_a_version[1].(int) $current_a_version[2]) < ((int) $new_a_version[1].(int) $new_a_version[2]) ) ) 
	{
		$message .= 'Current Version: ' . $attach_config['attach_version'] ." Please run update_<b>attach</b>_to_latest.php first to update Attachment Mod :: <a href=\"".append_sid('./update_attach_to_latest.'.$phpEx)."\" target=\"_self\">[  process now  ]</a>"; 
		$files = false;
	}else
		$message .= '<span style="font-weight:bold;color:#009900">OK</span> - Current Version: ' . $attach_config['attach_version'];
	}
	//
	//---------------------------------------------
	//
	if ( !empty($ctracker_config['version']) ) {
		$message .= '<br/><br/> <h2>CrackerTracker:</h2> <br/>';
		
		$current_ct_version = explode('.', $ctracker_config['version']);
		$new_ct_version = explode('.', $ct_version);
		
		if ( ((int) $current_ct_version[0].(int) $current_ct_version[1].(int) $current_ct_version[2]) < ((int) $new_ct_version[0].(int) $new_ct_version[1].(int) $new_ct_version[2]) )
		{
			$message .= 'Current Version: ' . $ctracker_config['version'] ." Please run update_ct_to_latest.php first to update CrackerTracker :: <a href=\"".append_sid('./update_ct_to_latest.'.$phpEx)."\" target=\"_self\">[  process now  ]</a>"; 
			$files = false;
		}else if ( ((int) $current_ct_version[0].(int) $current_ct_version[1].(int) $current_ct_version[2]) > ((int) $new_ct_version[0].(int) $new_ct_version[1].(int) $new_ct_version[2]) )
		{
			$message .= 'Current Version: ' . $ctracker_config['version'] ." Please run update_ct_to_latest.php to set version self is here installed :: <a href=\"".append_sid('./update_ct_to_latest.'.$phpEx)."\" target=\"_self\">[  process now  ]</a>"; 
			$files = false;
		}else 
			$message .= '<span style="font-weight:bold;color:#009900">OK</span> - Current Version: ' . $ctracker_config['version'];
	} 
	//
	//---------------------------------------------
	//
	$message .= '<br/><br/> <h2>Plusboard:</h2> <br/>';
	if ( !empty($plus_config['plus_version']) )
	{
		
		if ( $plus_config['plus_version'] === $plus_version )
		{
				$message .= '<span style="font-weight:bold;color:#009900">OK</span> - Current Version: ' . $plus_config['plus_version'];
		} else
		{
			switch ($plus_config['plus_version'])
			{		
			case '1.52':
					$link_to = ($files) ? '<form action="./'.append_sid("update_plus152_to_153.".$phpEx).'"  method="post" name="addprofile"><input type="submit" class="button" value="[  process now  ]" name="run" /></form>' : ' [  <span style="font-weight:bold;color:#FF0000">process other updates first</span>  ] ';
					$message .= 'Current Version: ' . $plus_config['plus_version'] ." Please run update_plus152_to_153.php :: ".$link_to; 
					$files = false;
				break;
			case '1.53 Beta1':
			case '1.53 Beta2':
			case '1.53 Beta3':
			case '1.53 Beta4':
			case '1.53 Beta5':
			case '1.53 Beta6':
			case '1.53 Beta7':
			case '1.53 Beta8':
			case '1.53 Beta9':
			case '1.53':
					$link_to = ($files) ? '<form action="./'.append_sid("update_153_to_latest.".$phpEx).'"  method="post" name="addprofile"><input type="submit" class="button" value="[  process now  ]" name="run" /></form>' : ' [  <span style="font-weight:bold;color:#FF0000">process other updates first</span>  ] ';
					$message .= 'Current Version: ' . $plus_config['plus_version'] ." Please run update_153_to_latest.php up to get Final :: ".$link_to; 
					$files = false;
				break;
			default:
					$message .= 'this is no Plus or an older version, ask for support @ www.phpbb2.de';
					$files = false;
				break;
			}
		}
	
		if ($theme['template_name'] != 'fisubsilversh')
		{
			$message .= '<br/><h4><br/>Template:</h4>';
			$link_to = '<a href="./'.append_sid("index.".$phpEx.'?mode=updatetheme').'" target="_self">[  process now  ]</a>';
			$message .= '<span style="font-weight:bold;color:#FF9900">!!!</span> - FI Subsilver Shadow is not default template :: '.$link_to;
		}
	}
	else {
		$link_to = ($files) ? '<form action="./'.append_sid("update_phpbb_20xx_to_plus_153.".$phpEx).'"  method="post" name="addprofile"><input type="submit" class="button" value="[  process now  ]" name="run" /></form>' : ' [  <span style="font-weight:bold;color:#FF0000">process other updates first</span>  ] ';
		$message .= 'is this a vanilla phpBB so use update_phpbb_20xx_to_plus_153.php :: '.$link_to.',<br/> is this another premodded or selfmodded ask for support @ www.phpbb2.de';
		$files = false;
	}
	//
	//---------------------------------------------
	//
	if ( $files )
		  $message .= '<br/><br/><span style="font-weight:bold;color:#009900">OK</span> - now upload all files like readme and set permissions of folders and files';
	
}
// end

page_output($message, true);
?>
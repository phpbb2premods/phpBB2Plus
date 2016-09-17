<?php
//copyright © 2004 IdleVoid & brustverein
//copyright © 2003 Volodymy (CLowN) Skoryk 
//this update template copyright : ©2003 Freakin' Booty ;-P & Antony Bailey 

define('IN_LOGIN', true);
define('IN_PHPBB', true); 
$phpbb_root_path = './../';
$album_root_path = $phpbb_root_path . 'album_mod/';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);

// 
// Start session management 
// 
$userdata = session_pagestart($user_ip, PAGE_INDEX); 
init_userprefs($userdata); 
// 
// End session management 
//
function page_output($text)
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
<td><span class="maintitle">Result of the SQL Queries needed for the Update phpBB2 Plus 1.53<img src="./fissh/spacer.gif" alt="" width="28" height="4" /></span></td>
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
				<td><br /><br /></td>
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

include($album_root_path . 'album_common.'.$phpEx);

if ($userdata['user_level']!=ADMIN)
      page_output("You are not Authorised to do this"); 

$message="<br/>";

if (isset($_GET['process']) && $_GET['process'] == 'yes')
{
	$message .= '<h2>This will convert/migrate all the personal galleries into the data model used in the Album Category Hierarchy 1.1.0 mod.</h2>';
	$message .= '<h3>Updating the database</h3>';

	$personal_gallery_info = array();

	$sql = "SELECT DISTINCT p.pic_user_id, p.pic_username
			FROM ". ALBUM_TABLE ." AS p
			WHERE p.pic_cat_id = 0
			ORDER BY pic_user_id";

	if(!$result = $db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, 'Could not query personal gallery information', '', __LINE__, __FILE__, $sql);
	}

	if( $db->sql_numrows($result) == 0 )
	{
		//message_die(GENERAL_ERROR, 'There aren\'t any \'old\' personal galleries. Script is ending.');
		$message .= '<font color="#0000FF"><b>NOTICE:</b></font> There aren\'t any \'old\' personal galleries to migrate. Script is ending.<br />';
	}
	else
	{
		while( $row = $db->sql_fetchrow($result) )
		{
			$personal_gallery_info[] = $row;
		}

		reset($personal_gallery_info);

		$sql = "";
		for( $i = 0; $i < count($personal_gallery_info); $i++ )
		{
			//check wheter the personal gallery root id already exists...it shouldn't tho'.
		   	$sql = "SELECT cat_id
		   	        FROM ". ALBUM_CAT_TABLE ."
		   	        WHERE cat_user_id = " . $personal_gallery_info[$i]['pic_user_id'] . "
		   	            AND cat_parent = 0
		   	        LIMIT 1";

			if( !$result = $db->sql_query ($sql) )
			{
				$error = $db->sql_error();

				$message .= $sql . '<br /><font color="#FF0000"><b>ERROR:</b></font> ' . $error['message'] . '<br />';

				// try the next personal gallery
				continue;
			}

			if( $db->sql_numrows($result) == 0 )
			{
				$root_cat_name = sprintf($lang['Personal_Gallery_Of_User'], $personal_gallery_info[$i]['pic_username']);

				$sql = "INSERT INTO ". ALBUM_CAT_TABLE ."
						(cat_title, cat_desc,
						 cat_order, cat_view_level,
						 cat_upload_level, cat_rate_level,
						 cat_comment_level, cat_edit_level,
						 cat_delete_level, cat_approval,
						 cat_parent, cat_user_id)
						VALUES
						('". $root_cat_name ."', '". $root_cat_name ."',
						 '0', '". $album_config['personal_gallery_view'] ."',
						 '".ALBUM_PRIVATE."', '0',
						 '0', '".ALBUM_PRIVATE."',
						 '".ALBUM_PRIVATE."', '0',
						 '0', '" . $personal_gallery_info[$i]['pic_user_id'] . "')";

				if( !$result = $db->sql_query ($sql) )
				{
					$error = $db->sql_error();

					$message .= $sql . '<br /><font color="#FF0000"><b>ERROR:</b></font> ' . $error['message'] . '<br />';
                    $message .= '	Personal gallery was <b>NOT</b> created for user : \'' . $personal_gallery_info[$i]['pic_username'] . '\'<br />';
                    $message .= '	Please inform IdleVoid (the Author) about this, including the user name<br />';

					// try the next personal gallery and by that skip the updating of this users personal gallery
					continue;
				}

			   	//get the newly created personal gallery root id.
			   	$sql = "SELECT cat_id
			   	        FROM ". ALBUM_CAT_TABLE ."
			   	        WHERE cat_user_id = " . $personal_gallery_info[$i]['pic_user_id'] . "
			   	            AND cat_parent = 0
			   	        LIMIT 1";

				if( !$result = $db->sql_query ($sql) )
				{
					$error = $db->sql_error();

					$message .= $sql . '<br /><font color="#FF0000"><b>ERROR:</b></font> ' . $error['message'] . '<br />';

					continue;
				}

				$row = $db->sql_fetchrow($result);
				$root_cat_id = $row['cat_id'];

				//move the pictures of this user into the
				$sql = "UPDATE ". ALBUM_TABLE ."
						SET pic_cat_id = $root_cat_id
						WHERE pic_cat_id = 0
							AND pic_user_id = " . $personal_gallery_info[$i]['pic_user_id'];

				if( !$result = $db->sql_query ($sql) )
				{
					$error = $db->sql_error();

					$message .= $sql . '<br /><font color="#FF0000"><b>ERROR:</b></font> ' . $error['message'] . '<br />';
				}
				else
				{
					$message .= $sql . '<br /><font color="#00AA00"><b>SUCCESSFULL</b></font><br />';
				}
			}
		}
	}

	$message .= '<h2>Finish</h2><span class="genmed"><center><br />Installation is now finished. Please be sure to delete this file now.<br /></center></span>';
}
else
{

 	$message .= '<h2>This will convert/migrate all the personal galleries into the data model used in the Album Category Hierarchy 1.1.0 mod.</h2>';
	$message .= '<center>You are about to migrate your existing personal galleries so they will work with the Album Category Hierarchy Mod by IdleVoid<br /><br />';
	$message .= 'I STRONGLY suggest that you make backup of your database before continuing running this file. <br />';
	$message .= 'The script might be running for some time, depending on how many users and how many personal galleries you have<br /><br />';
	$message .= '<a href="?process=yes">Click here go run the script</a></center></span>';
}

	$link_to = '<a href="./'.append_sid("index.".$phpEx).'" target="_self">[  next step  ]</a>';
	$message .= '<br /><br /><h4>'. $link_to . '<h4>';


page_output($message);

?>
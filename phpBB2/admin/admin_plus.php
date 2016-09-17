<?php
/***************************************************************************
 *                              admin_plus.php
 *                            -------------------
 *   begin                : Thursday, Jul 12, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : sp@phpbb2.de
 *
 *   $Id: admin_board.php,v 1.51.2.6 2003/08/10 00:37:12 stefan2k1 Exp $
 *
 *
 ***************************************************************************/

define('IN_PHPBB', 1);

if( !empty($setmodules) )
{
	$file = basename(__FILE__);
	$module['Plus']['Configuration'] = $file;
	return;
}

//
// Let's set the root dir for phpBB
//
$phpbb_root_path = "./../";
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);

//
// Pull all config data
//
$sql = "SELECT *
	FROM " . PLUS_TABLE;
if(!$result = $db->sql_query($sql))
{
	message_die(CRITICAL_ERROR, "Could not query phpBB2 Plus information in admin_board", "", __LINE__, __FILE__, $sql);
}
else
{
	while( $row = $db->sql_fetchrow($result) )
	{
		$config_name = $row['config_name'];
		$config_value = $row['config_value'];
		$default_config[$config_name] = $config_value;
		
		$new[$config_name] = ( isset($_POST[$config_name]) ) ? $_POST[$config_name] : $default_config[$config_name];

		if( isset($_POST['submit']) )
		{
			$sql = "UPDATE " . PLUS_TABLE . " SET
				config_value = '" . str_replace("\'", "''", $new[$config_name]) . "'
				WHERE config_name = '$config_name'";
			if( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, "Failed to update Plus configuration for $config_name", "", __LINE__, __FILE__, $sql);
			}
		}
	}

	if( isset($_POST['submit']) )
	{
		$message = $lang['Config_updated'] . "<br /><br />" . sprintf($lang['Click_return_config'], "<a href=\"" . append_sid("admin_plus.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");

		message_die(GENERAL_MESSAGE, $message);
	}
}

$plusstyle_1 = ( $new['index_layout'] == PLUSLAYOUT_1 ) ? "checked=\"checked\"" : "";
$plusstyle_2 = ( $new['index_layout'] == PLUSLAYOUT_2 ) ? "checked=\"checked\"" : "";
$plusstyle_3 = ( $new['index_layout'] == PLUSLAYOUT_3 ) ? "checked=\"checked\"" : "";

$default_avatar_yes = ( $new['default_avatar'] ) ? "checked=\"checked\"" : "";
$default_avatar_no = ( !$new['default_avatar'] ) ? "checked=\"checked\"" : "";

$boardstats_yes = ( $new['show_boardstats'] ) ? "checked=\"checked\"" : "";
$boardstats_no = ( !$new['show_boardstats'] ) ? "checked=\"checked\"" : "";

$links_yes = ( $new['show_links'] ) ? "checked=\"checked\"" : "";
$links_no = ( !$new['show_links'] ) ? "checked=\"checked\"" : "";

$banners_yes = ( $new['enable_banners'] ) ? "checked=\"checked\"" : "";
$banners_no = ( !$new['enable_banners'] ) ? "checked=\"checked\"" : "";

$quickreply_yes = ( $new['show_quickreply'] ) ? "checked=\"checked\"" : "";
$quickreply_no = ( !$new['show_quickreply'] ) ? "checked=\"checked\"" : "";

$shoutbox_no = ( $new['show_shoutbox'] == 0 ) ? "checked=\"checked\"" : "";
$shoutbox_yes = ( $new['show_shoutbox'] == 1 ) ? "checked=\"checked\"" : "";
$shoutbox_yes_reg = ( $new['show_shoutbox'] == 2 ) ? "checked=\"checked\"" : "";
$shoutbox_portal = ( $new['show_shoutbox'] == 3 ) ? "checked=\"checked\"" : "";
$shoutbox_portal_reg = ( $new['show_shoutbox'] == 4 ) ? "checked=\"checked\"" : "";
$shoutbox_index = ( $new['show_shoutbox'] == 5 ) ? "checked=\"checked\"" : "";
$shoutbox_index_reg = ( $new['show_shoutbox'] == 6 ) ? "checked=\"checked\"" : "";

$lastvisit_no = ( !$new['show_last_visit'] ) ? "checked=\"checked\"" : "";
$lastvisit_yes = ( $new['show_last_visit'] == 1 ) ? "checked=\"checked\"" : ""; 
$lastvisit_24guest = ( $new['show_last_visit'] == 2 ) ? "checked=\"checked\"" : "";

$disablesid_yes = ( $new['disable_sid'] ) ? "checked=\"checked\"" : "";
$disablesid_no = ( !$new['disable_sid'] ) ? "checked=\"checked\"" : "";

$shorturls_yes = ( $new['enable_shorturls'] ) ? "checked=\"checked\"" : "";
$shorturls_no = ( !$new['enable_shorturls'] ) ? "checked=\"checked\"" : "";

$antirobot_yes = ( $new['enable_antirobot'] ) ? "checked=\"checked\"" : "";
$antirobot_no = ( !$new['enable_antirobot'] ) ? "checked=\"checked\"" : "";

$confirm_post_yes = ( $new['enable_confirm_post'] ) ? "checked=\"checked\"" : "";
$confirm_post_no = ( !$new['enable_confirm_post'] ) ? "checked=\"checked\"" : "";

$gentime_yes = ( $new['enable_gentime'] ) ? "checked=\"checked\"" : "";
$gentime_no = ( !$new['enable_gentime'] ) ? "checked=\"checked\"" : "";

$fulltext_yes = ( $new['enable_fulltextsearch'] ) ? "checked=\"checked\"" : "";
$fulltext_no = ( !$new['enable_fulltextsearch'] ) ? "checked=\"checked\"" : "";

$contact_mail = $new['contact_email'];

$template->set_filenames(array(
	"body" => "admin/plus_config_body.tpl")
);

$template->assign_vars(array(
	"S_CONFIG_ACTION" => append_sid("admin_plus.$phpEx"),

	"L_YES" => $lang['Yes'],
	"L_NO" => $lang['No'],
	"L_PLUSCONFIG_TITLE" => $lang['General_Plusconfig'],
	"L_PLUSCONFIG_EXPLAIN" => $lang['Plusconfig_explain'],
	"L_INDEX_LAYOUT" => $lang['Index_Layout'],
	"L_PLUSSTYLE_EXPLAIN" => $lang['Plusstyle_explain'],
	"L_PLUSSTYLE1" => $lang['Plusstyle1'],
	"L_PLUSSTYLE1_EXPLAIN" => $lang['Plusstyle1_explain'],
	"L_PLUSSTYLE2" => $lang['Plusstyle2'],
	"L_PLUSSTYLE2_EXPLAIN" => $lang['Plusstyle2_explain'],
	"L_PLUSSTYLE3" => $lang['Plusstyle3'],
	"L_PLUSSTYLE3_EXPLAIN" => $lang['Plusstyle3_explain'],
	"L_ENABLE_DEFAULTAVATAR" => $lang['Enable_defaultavatar'],
	"L_DEFAULTAVATAR_EXPLAIN" => $lang['Defaultavatar_explain'],
	"L_BOARDSTATS_EXPLAIN" => $lang['Boardstats_explain'],
	"L_ENABLE_LINKS" => $lang['Enable_indexlinks'],
	"L_LINKS_EXPLAIN" => $lang['Indexlinks_explain'],
	"L_ENABLE_QUICKREPLY" => $lang['Enable_quickreply'],
	"L_QUICKREPLY_EXPLAIN" => $lang['Quickreply_explain'],
	"L_ENABLE_SHOUTBOX" => $lang['Enable_shoutbox'],
	"L_SHOUTBOX_YES" => $lang['Shoutbox_yes'],
	"L_SHOUTBOX_NO" => $lang['Shoutbox_no'],
	"L_SHOUTBOX_YES_REG" => $lang['Shoutbox_yes_reg'],
	"L_SHOUTBOX_PORTAL" => $lang['Shoutbox_portal'],
	"L_SHOUTBOX_PORTAL_REG" => $lang['Shoutbox_portal_reg'],
	"L_SHOUTBOX_INDEX" => $lang['Shoutbox_index'],
	"L_SHOUTBOX_INDEX_REG" => $lang['Shoutbox_index_reg'],
	"L_SHOUTBOX_EXPLAIN" => $lang['Shoutbox_explain'],
	"L_SUBMIT" => $lang['Submit'], 
	"L_RESET" => $lang['Reset'], 
	"L_PLUS_SETTINGS" => $lang['Plus_Settings'],
	"L_CONTACT_CONFIG" => $lang['Contact_Config'],
	"L_CONTACT_EXPLAIN" => $lang['Contact_Explain'],
	"L_ENABLE_LASTVISIT" => $lang['Enable_Lastvisit'],
	"L_LASTVISIT_EXPLAIN" => $lang['Lastvisit_explain'],
	"L_LASTVISIT_24GUEST" => $lang['Lastvisit_24guest'],
	"L_ENABLE_SHORTURLS" => $lang['Enable_Shorturls'],
	"L_SHORTURLS_EXPLAIN" => $lang['Shorturls_explain'],
	"L_DISABLE_SID" => $lang['Disable_Sid'],
	"L_DISABLE_SID_EXPLAIN" => $lang['Disable_Sid_Explain'],
	"L_SELECT_LAYOUT" => $lang['Select_Layout'],
	"L_ENABLE_ANTIROBOT" => $lang['Enable_Antirobot'],
	"L_ANTIROBOT_EXPLAIN" => $lang['Antirobot_Explain'],
	"L_ENABLE_GENTIME" => $lang['Enable_Gentime'],
	"L_GENTIME_EXPLAIN" => $lang['Gentime_Explain'],
	"L_ENABLE_BANNERS" => $lang['Enable_Bannerhack'],
	"L_BANNERS_EXPLAIN" => $lang['Bannerhack_explain'],
	"L_ENABLE_CONFIRM_POST" => $lang['Confirm_code_guestpost'],
	"L_CONFIRM_POST_EXPLAIN" => $lang['Confirm_guestpost_Explain'],
	"L_FULLTEXT_CONFIG" => $lang['Fulltext_Config'],
	"L_FULLTEXT_EXPLAIN" => $lang['Fulltext_Explain'],
		
	"PLUSSTYLE_1" => PLUSLAYOUT_1, 
	"PLUSSTYLE_1_CHECKED" => $plusstyle_1,
	"PLUSSTYLE_2" => PLUSLAYOUT_2, 
	"PLUSSTYLE_2_CHECKED" => $plusstyle_2,
	"PLUSSTYLE_3" => PLUSLAYOUT_3, 
	"PLUSSTYLE_3_CHECKED" => $plusstyle_3, 
	
	"DEFAULT_AVATAR_YES" => $default_avatar_yes,
	"DEFAULT_AVATAR_NO" => $default_avatar_no,
	"BOARDSTATS_YES" => $boardstats_yes,
	"BOARDSTATS_NO" => $boardstats_no,
	"LINKS_YES" => $links_yes,
	"LINKS_NO" => $links_no,
	"BANNERS_YES" => $banners_yes,
	"BANNERS_NO" => $banners_no,
	"QUICKREPLY_YES" => $quickreply_yes,
	"QUICKREPLY_NO" => $quickreply_no,
	"SHOUTBOX_YES" => $shoutbox_yes,
	"SHOUTBOX_NO" => $shoutbox_no,
	"SHOUTBOX_YES_REG" => $shoutbox_yes_reg,
	"SHOUTBOX_PORTAL" => $shoutbox_portal,
	"SHOUTBOX_PORTAL_REG" => $shoutbox_portal_reg,
	"SHOUTBOX_INDEX" => $shoutbox_index,
	"SHOUTBOX_INDEX_REG" => $shoutbox_index_reg,
	"LASTVISIT_YES" => $lastvisit_yes,
	"LASTVISIT_NO" => $lastvisit_no,
	"LASTVISIT_24GUEST" => $lastvisit_24guest,
	"SHORTURLS_YES" => $shorturls_yes,
	"SHORTURLS_NO" => $shorturls_no,
	"DISABLESID_YES" => $disablesid_yes,
	"DISABLESID_NO" => $disablesid_no,
	"ANTIROBOT_YES" => $antirobot_yes,
	"ANTIROBOT_NO" => $antirobot_no,
	"CONFIRM_POST_YES" => $confirm_post_yes,
	"CONFIRM_POST_NO" => $confirm_post_no,
	"GENTIME_YES" => $gentime_yes,
	"GENTIME_NO" => $gentime_no,
	"FULLTEXT_YES" => $fulltext_yes,
	"FULLTEXT_NO" => $fulltext_no,
	"CONTACT_MAIL" => $contact_mail,
	"ACTIVATION_NONE_CHECKED" => $activation_none)
);

$template->pparse("body");

include('./page_footer_admin.'.$phpEx);

?>

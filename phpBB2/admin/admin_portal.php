<?php
/***************************************************************************
 *                              admin_portal.php
 *                            -------------------
 *   begin                : Wednesday, Dec 25, 2002
 *   copyright            : (C) 2002 ThunderCat
 *   email                : thundercat@die-pretorianer.de
 *
 *   $Id: admin_portal.php,v 1.01.0.0 2002/12/25 00:00:00 psotfx Exp $
 *
 *
 ***************************************************************************/

define('IN_PHPBB', 1);

if( !empty($setmodules) )
{
	$file = basename(__FILE__);
	$module['Portal']['Configuration'] = $file."?mode=config";
	return;
}

//
// Let's set the root dir for phpBB
//
$phpbb_root_path = "./../";
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);

define('PORTAL_TABLE', $table_prefix.'portal');

//
// Pull all config data
//
$sql = "SELECT * FROM " . PORTAL_TABLE;
if(!$result = $db->sql_query($sql))
{
	message_die(CRITICAL_ERROR, "Could not query config information in admin_portal", "", __LINE__, __FILE__, $sql);
}
else
{
	while( $row = $db->sql_fetchrow($result) )
	{
		$portal_name = $row['portal_name'];
		$portal_value = $row['portal_value'];
		$default_portal[$portal_name] = $portal_value;
		
		$new[$portal_name] = ( isset($_POST[$portal_name]) ) ? $_POST[$portal_name] : $default_portal[$portal_name];
		if( isset($_POST['submit']) )
		{
			$sql = "UPDATE " . PORTAL_TABLE . " SET
				portal_value = '" . str_replace("\'", "''", $new[$portal_name]) . "'
				WHERE portal_name = '$portal_name'";
			if( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, "Failed to update general configuration for $portal_name", "", __LINE__, __FILE__, $sql);
			}
		}
	}

	if( isset($_POST['submit']) )
	{
		$message = $lang['Config_updated'] . "<br /><br />" . sprintf($lang['Click_return_config'], "<a href=\"" . append_sid("admin_portal.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");

		message_die(GENERAL_MESSAGE, $message);
	}
}
$pics_all_yes = ( $new['pics_all'] ) ? "checked=\"checked\"" : "";
$pics_all_no = ( !$new['pics_all'] ) ? "checked=\"checked\"" : "";
$pics_sort_yes = ( $new['pics_sort'] ) ? "checked=\"checked\"" : "";
$pics_sort_no = ( !$new['pics_sort'] ) ? "checked=\"checked\"" : "";

$template->set_filenames(array(
	"body" => "admin/portal_config_body.tpl")
);

$template->assign_vars(array(
	"S_CONFIG_ACTION" => append_sid("admin_portal.$phpEx"),
	"L_CONFIGURATION_TITLE" => $lang['EZPortal_Config'],
	"L_GENERAL_SETTINGS" => $lang['EZPortal_settings'],
	"L_WELCOME_TEXT" => $lang['Welcome_Text'],
	"L_NUMBER_OF_NEWS" => $lang['Number_of_News'],
	"L_NEWS_LENGTH" => $lang['News_length'],
	"L_NEWS_FORUM" => $lang['News_Forum'],
	"L_POLL_FORUM" => $lang['Poll_Forum'],
	"L_NUMBER_RECENT_TOPICS" => $lang['Number_Recent_Topics'],
	"L_NUMBER_RECENT_FILES" => $lang['Number_Recent_Files'],
	"L_LAST_SEEN" => $lang['Last_Seen'],
	"L_EXCEPT_FORUM" => $lang['Exceptional_Forum'],
	"L_EXCEPT_COMMA" => $lang['Exceptional_Comma'],
	"L_RECENT_PIC_SETTINGS" => $lang['Recent_Pic_Settings'],
	"L_PIC_CAT_ID" => $lang['Picture_cat_id'],
	"L_PIC_NUMBER" => $lang['Picture_number'],
	"L_PIC_ALL" => $lang['Picture_all'],
	"L_PIC_SORT" => $lang['Picture_sort'],
	"L_PIC_THUMBSIZE" => $lang['Portal_thumb_size'],
	"L_SUBMIT" => $lang['Submit'], 
	"L_RESET" => $lang['Reset'], 
	"L_SHOW" => $lang['Portal_Show'],
	"L_HIDE" => $lang['Portal_Hide'],
  "L_COMMA" => $lang['Comma'],
  "L_PIC_COMMA" => $lang['Pic_Comma'],
	"L_NUMBER_TOPPOSTERS" => $lang['Number_Topposters'],
	"L_TOPPOSTERS_EXPLAIN" => $lang['Topposters_Explain'],
	"L_YES" => $lang['Yes'],
	"L_NO" => $lang['No'],

	"PIC_ALL_NO" => $pics_all_no,
	"PIC_ALL_YES" => $pics_all_yes,
	"PIC_SORT_NO" => $pics_sort_no,
	"PIC_SORT_YES" => $pics_sort_yes,

	"WELCOME_TEXT" => $new['welcome_text'], 
	"NUMBER_OF_NEWS" => $new['number_of_news'],
	"NEWS_LENGTH" => $new['news_length'],
	"NEWS_FORUM" => $new['news_forum'],
	"POLL_FORUM" => $new['poll_forum'],
	"NUMBER_RECENT_TOPICS" => $new['number_recent_topics'],
	"NUMBER_RECENT_FILES" => $new['number_recent_files'],
	"EXCEPT_FORUM" => $new['exceptional_forums'],
	"PIC_CAT_ID" => $new['cat_id'],
	"PIC_NUMBER" => $new['pics_number'],
	"PIC_THUMBSIZE" => $new['pics_thumbsize'],
	"NUMBER_TOP_POSTERS" => $new['number_top_posters'],
	"LAST_SEEN" => $new['last_seen'])
);

$template->pparse("body");

include('./page_footer_admin.'.$phpEx);

?>


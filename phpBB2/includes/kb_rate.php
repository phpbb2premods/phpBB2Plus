<?php
/***************************************************************************
 *                             kb_rate.php
 *                            -------------------
 *   begin                : April, 2003
 *   copyright            : (C) 2002 MX-System
 *   email                : support@mx-system.com
 *   description		  : implementing ratings
 *	 Author				  : Haplo (jonohlsson@hotmail.com)
 *	 credit				  : pafiledb 
 *
 *   $Id: kb_rate.php,v 1.4 2004/05/02 08:25:02 jonohlsson Exp $
 *
 ***************************************************************************/
// ---------------------------------------------------------------------START
// This file adds rating to the module
// -------------------------------------------------------------------------
if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}

//
// Start initial var setup
//
if ( isset($_GET['cat']) )
{
	$category_id = intval($_GET['cat']);
}
else
{
//	message_die(GENERAL_MESSAGE, 'no category');
}


if ( isset($_GET['k']) || isset($_POST['k']) )
{
	$article_id = ( isset($_GET['k']) ) ? $_GET['k'] : $_POST['k'];
}
else
{
	message_die(GENERAL_MESSAGE, 'no article');
}

 if ( isset($_GET['rate']) || isset($_POST['rate']) )
 {
 	$rate = ( isset($_GET['rate']) ) ? $_GET['rate'] : $_POST['rate'];
 }
 
 if ( isset($_GET['rating']) || isset($_POST['rating']) )
 {
 	$rating = ( isset($_GET['rating']) ) ? intval($_GET['rating']) : intval($_POST['rating']);
 }

$start = ( isset($_GET['start']) ) ? intval($_GET['start']) : 0;
//
// End initial var setup
//

   include($phpbb_root_path . 'includes/page_header.'.$phpEx);

	make_jumpbox($phpbb_root_path .'viewforum.'.$phpEx, $category_id);
	
	//load header
	include ($phpbb_root_path ."includes/kb_header.".$phpEx);

$template->set_filenames(array(
	'body' => 'kb_rate_body.tpl')
);

$sql = "SELECT * FROM " . KB_ARTICLES_TABLE . " WHERE article_id = '" . $article_id . "'";

if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Couldnt Query Article info', '', __LINE__, __FILE__, $sql);
}
$article = $db->sql_fetchrow($result);

$sql = "SELECT * FROM " . KB_CATEGORIES_TABLE . " WHERE category_id = '" . $article['article_category_id'] . "'";
if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Couldnt Query category info for this article', '', __LINE__, __FILE__, $sql);
}
$category = $db->sql_fetchrow($result);

$ipaddy= getenv ("REMOTE_ADDR");

if ($kb_config['votes_check_ip'] == 1)
{
	$sql = "SELECT * FROM " . KB_VOTES_TABLE . " WHERE votes_ip = '" . $ipaddy . "' AND votes_file = '" . $article_id . "'";
	if ( !($result = $db->sql_query($sql)) )
	{
	   	message_die(GENERAL_ERROR, 'Couldnt Query rate ip', '', __LINE__, __FILE__, $sql);
	}

	if ( $db->sql_numrows($result) > 0 )
	{
		$template->assign_vars(array(
			"META" => '<meta http-equiv="refresh" content="3;url='  . append_sid("kb.$phpEx?action=url&amp;k=" . $article_id) . '">')
		);
		$message = $lang['Rerror'] . "<br /><br />" . sprintf($lang['Click_return_rate'], "<a href=\"" . append_sid("kb.$phpEx?action=url&amp;k=$article_id") . "\">", "</a>");
		message_die(GENERAL_MESSAGE, $message);
	}
}

if ($kb_config['votes_check_userid'] == 1)
{
	$sql = "SELECT * FROM " . KB_VOTES_TABLE . " WHERE votes_userid = '" . $userdata['user_id'] . "' AND votes_file = '" . $article_id . "'";
	if ( !($result = $db->sql_query($sql)) )
	{
	   	message_die(GENERAL_ERROR, 'Couldnt Query rate ip', '', __LINE__, __FILE__, $sql);
	}

	if ( $db->sql_numrows($result) > 0 )
	{
		$template->assign_vars(array(
			"META" => '<meta http-equiv="refresh" content="3;url='  . append_sid("kb.$phpEx?action=url&amp;k=" . $article_id) . '">')
		);
		$message = $lang['Rerror'] . "<br /><br />" . sprintf($lang['Click_return_rate'], "<a href=\"" . append_sid("kb.$phpEx?action=url&amp;k=$article_id") . "\">", "</a>");
		message_die(GENERAL_MESSAGE, $message);
	}
}

if ($rate == 'dorate')
{
	$conf = str_replace("{filename}", $article['article_name'], $lang['Rconf']);
	$conf = str_replace("{rate}", $rating, $conf);

	if ($article['article_totalvotes'] == 1)
    {
		$add = 0;
	}
	else
	{
		$add = 1;
	}
 
    $sql = "UPDATE " . KB_ARTICLES_TABLE . " SET article_rating=article_rating+" . $rating . ", article_totalvotes=article_totalvotes+1 WHERE article_id = '" . $article_id . "'";

    if ( !($update = $db->sql_query($sql)) )
    {
        message_die(GENERAL_ERROR, 'Couldnt Update rating table', '', __LINE__, __FILE__, $sql);
    }

	$ipaddy = getenv ("REMOTE_ADDR");

	$sql = "INSERT INTO " . KB_VOTES_TABLE . " VALUES('" . $ipaddy . "', '" . $userdata['user_id'] . "', '" . $article_id . "')";

    if ( !($insert = $db->sql_query($sql)) )
    {
       	message_die(GENERAL_ERROR, 'Couldnt Update rating table', '', __LINE__, __FILE__, $sql);
    }

    $sql = "SELECT * FROM " . KB_ARTICLES_TABLE . " WHERE article_id = '" . $article_id . "'";

    if ( !($result = $db->sql_query($sql)) )
    {
        message_die(GENERAL_ERROR, 'Couldnt Update rating table', '', __LINE__, __FILE__, $sql);
    }

	$article = $db->sql_fetchrow($result);

	if ($article['article_rating'] == 0 or $article['article_totalvotes'] == 0)
	{
		$nrating = 0; 
	}
	else
	{
		$nrating = round($article['article_rating']/($article['article_totalvotes']), 3); 
	}

	$conf = str_replace("{newrating}", $nrating, $conf);

	$template->assign_vars(array(
		"META" => '<meta http-equiv="refresh" content="3;url='  .append_sid($phpbb_root_path . "kb.$phpEx?action=url&amp;k=" . $article_id) . '">')
	);
	$message = $conf . "<br /><br />" . sprintf($lang['Click_return_rate'], "<a href=\"" . append_sid($phpbb_root_path . "kb.$phpEx?mode=article&amp;k=$article_id") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_forum'], "<a href=\"" . append_sid("kb.$phpEx?action=cat&amp;cat=$category_id") . "\">", "</a>");
	message_die(GENERAL_MESSAGE, $message);  

}
else
{
	$rateinfo = str_replace("{filename}", $article['article_name'], $lang['Rateinfo']);

	$template->assign_block_vars("rate", array());

//
// Send variables to template (the associated *.tpl file)
//
	$template->assign_vars(array(
		'S_RATE_ACTION' => append_sid($phpbb_root_path . "kb.$phpEx?mode=rate&amp;cat=$category_id&amp;k=$article_id"),
		'L_RATE' => $lang['Rate'],
		'L_RERROR' => $lang['Rerror'],
		'L_R1' => $lang['R1'],
		'L_R2' => $lang['R2'],
		'L_R3' => $lang['R3'],
		'L_R4' => $lang['R4'],
		'L_R5' => $lang['R5'],
		'L_R6' => $lang['R6'],
		'L_R7' => $lang['R7'],
		'L_R8' => $lang['R8'],
		'L_R9' => $lang['R9'],
		'L_R10' => $lang['R10'],
		'RATEINFO' => $rateinfo, 
		'ID' => $article_id) 
	);
}

?>
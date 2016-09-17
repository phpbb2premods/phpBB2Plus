<?php
/***************************************************************************
 *                             Kontakt Formular von Carsten Schäfer
 *                          ------------------------
 *   Version              : Version 1.00 - 26.04.2003
 *   copyright            : (C) 2003 Carsten Schäfer
 *   email			      : cs-mailbox@web.de
 *
 *   $Id: kontakt.php,v 1.00 2003/04/26 Carsten Schäfer $
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

define('IN_PHPBB', true);

$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);

$userdata = session_pagestart($user_ip, PAGE_INDEX);
init_userprefs($userdata);

$page_title = $lang['Kontakt'];
include($phpbb_root_path . 'includes/page_header.'.$phpEx);

$textfeld = ( isset($_POST['textfeld']) ) ? trim(stripslashes($_POST['textfeld'])) : false; 
$name = ( isset($_POST['name']) ) ?  trim(stripslashes($_POST['name'])) : false; 
$mail = ( isset($_POST['mail']) ) ? ( ( preg_match('/^[a-z0-9_\.\-]+@[a-z0-9\.\-]+\.[a-z]{2,}$/i',$_POST['mail']) ) ? trim(stripslashes($_POST['mail'])) :false) : false; 
$betreff = ( isset($_POST['betreff']) ) ? trim(stripslashes($_POST['betreff'])) : false;
$email_from = "$name<$mail>";
$email_to = $plus_config['contact_email'];
$header = "From:$email_from\n";
if($mail&&$textfeld&&$name&&$betreff)
{
	if (!mail($email_to,$betreff,$textfeld,$header)){
	$false = $lang['kontakt8'];}
	else {
	$true = $lang['kontakt9'];}
}
else {
	$false = $lang['kontakt8'];
}

$template->assign_vars(array(
'false' => $false,
'true' => $true)
);



$template->set_filenames(array(
'body' => 'kontakt_post.tpl')
);

$template->pparse('body');

include($phpbb_root_path . 'includes/page_tail.'.$phpEx);
?>
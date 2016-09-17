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

$template->assign_vars(array(
'kontakt1' => $lang['kontakt1'],
'kontakt2' => $lang['kontakt2'],
'kontakt3' => $lang['kontakt3'],
'kontakt4' => $lang['kontakt4'],
'kontakt5' => $lang['kontakt5'],
'kontakt6' => $lang['kontakt6'],
'kontakt7' => $lang['kontakt7'],
'kontakt_js1' => $lang['kontakt_js1'],
'kontakt_js2' => $lang['kontakt_js2'],
'kontakt_js3' => $lang['kontakt_js3'],
'kontakt_js4' => $lang['kontakt_js4'],
'kontakt_js5' => $lang['kontakt_js5'],
'kontakt_js6' => $lang['kontakt_js6'])
);

$template->set_filenames(array(
'body' => 'kontakt.tpl')
);

$template->pparse('body');

include($phpbb_root_path . 'includes/page_tail.'.$phpEx);

?>
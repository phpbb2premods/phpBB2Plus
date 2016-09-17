<?php
/***************************************************************************
 *                            album_search.php
 *                            -------------------
 *   started            : Saturday, January 18, 2004
 *   copyright          : © Volodymyr (CLowN) Skoryk
 *   email              : blaatimmy72@yahoo.com
 *	 version            : 1.5
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
 
 /***************************************************************************
 *
 *   Change Log:
 *
 *		1.5.0
 *			-fixed bug in searching personal galleries
 *
 *		1.4.0
 *			-made search of personal galleries possible
 * 
 *		1.3.0
 *			-totally rewrote search.php and templet file to use phpbbs
 *			 template system
 *			-fixed bug in mysql query line
 *			-implemented use of $_GET and $_POST
 *
 *		1.2.0
 *			-fixed session problem,and php opening tag before comments bug
 *
 *		1.1.0
 *			-fixed bug were username and picture name were rewerced in the
 *			 template
 *
 *		1.0.0
 *			-initial release
 *
 ***************************************************************************/

//+-+-------------------------------------------------------+-+-+-+-+-+-+-+-+

define('IN_PHPBB', true);
$phpbb_root_path = './';
$album_root_path = $phpbb_root_path . 'album_mod/';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);

// Start session management
//
	$userdata = session_pagestart($user_ip, PAGE_ALBUM);
	init_userprefs($userdata);
//
// End session management

	include($album_root_path . 'album_common.'.$phpEx);

	$page_title = "Album Search";	
	include($phpbb_root_path . 'includes/page_header.'.$phpEx);

	$template->set_filenames(array(
		'body' => 'album_search_body.tpl')
	);
	//+-+-------------------------------------------------------+-+-+-+-+-+-+-+-+
	
	if (( isset($_POST['search']) || isset($_GET['search']) ) && ( $_POST['search'] != '' || $_GET['search'] != '' ))
	{
		$template->assign_block_vars('switch_search_results', array());
		
		if ( isset($_POST['mode']) )
			$m = $_POST['mode'];
		else if ( isset($_GET['mode']) )
			$m = $_GET['mode'];
		else
			message_die(GENERAL_ERROR, 'Bad request');
			
		if ( isset($_POST['search']) )
			$s = $_POST['search'];
		else if ( isset($_GET['search']) )
			$s = $_GET['search'];
			
		if ($m == 'user')
			$where = 'p.pic_username';
		else if ($m == 'name')
			$where = 'p.pic_title';
		else if ($m == 'desc')
			$where = 'p.pic_desc';

				
		$sql = "SELECT p.pic_id, p.pic_title, p.pic_desc, p.pic_user_id, p.pic_username, p.pic_time, p.pic_cat_id, p.pic_approval, c.cat_id, c.cat_title, c.cat_user_id
				FROM " . ALBUM_TABLE . ' AS p,' . ALBUM_CAT_TABLE . " AS c
				WHERE p.pic_approval = 1 AND " . $where .  " LIKE '%" . $s . "%' AND p.pic_cat_id = c.cat_id OR p.pic_cat_id = 0 AND p.pic_approval = 1 AND " . $where .  " LIKE '%" . $s . "%' 
				ORDER BY p.pic_time DESC";
				
				
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, "Couldn't obtain a list of matching information (searching for: $search)", "", __LINE__, __FILE__, $sql);
		}
		
		$numres = 0;
		
		if ( $row = $db->sql_fetchrow($result) )
		{
			$in = array();
			do
			{
				if ( ! in_array($row['pic_id'], $in) ) 
				{
					$album_user_id = $row['cat_user_id'];
				 	$user_cat_root_id =  album_get_personal_root_id($album_user_id);
				 	
					$template->assign_block_vars('switch_search_results.search_results', array(
						'L_USERNAME' => $row['pic_username'],
						'U_PROFILE' => append_sid('profile.php?mode=viewprofile&u=' . $row['pic_user_id']),
						
						'L_CAT' => ($row['cat_user_id'] != ALBUM_PUBLIC_GALLERY ) ? 'User personal' : $row['cat_title'],
						'U_CAT' => ($row['cat_id'] == $user_cat_root_id) ? append_sid(album_append_uid('album.php')) : append_sid(album_append_uid('album_cat.php?cat_id=' . $row['cat_id'])),
						
						'L_PIC' => $row['pic_title'],
						'U_PIC' => append_sid('album_showpage.php?pic_id=' . $row['pic_id']),
						
						'L_TIME' => create_date($board_config['default_dateformat'], $row['pic_time'], $board_config['board_timezone'])
					));
					
					$in[$numres] = $row['pic_id'];
					$numres++;
				}
			}
			while( $row = $db->sql_fetchrow($result) );
	
			$template->assign_vars(array(
				'L_NRESULTS' => $numres,
				'L_TCATEGORY' => 'Category',
				'L_TTITLE' => 'Title',
				'L_TSUBMITER' => 'Submiter',
				'L_TSUBMITED' => 'Submited on'
			));
		}
		else
		{
			message_die(GENERAL_MESSAGE, $lang['No_search_match']);
		}
	}
	else
	{
		$template->assign_block_vars('switch_search', array());
	}
	
	
//+-+-------------------------------------------------------+-+-+-+-+-+-+-+-+

	$template->pparse('body');
	include($phpbb_root_path . 'includes/page_tail.'.$phpEx);
	
// +-------------------------------------------------------------+
// |  Powered by Photo Album 2.x.x (c) 2002-2003 Smartor         |
// |  with Volodymyr (CLowN) Skoryk's Service Pack 1 © 2003-2004 |
// +-------------------------------------------------------------+
		
?>
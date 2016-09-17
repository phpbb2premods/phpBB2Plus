<?php
/***************************************************************************
 *                            admin_ct_systest.php
 *                             -------------------
 *   copyright            : (C) 2005 Christian Knerr
 *   email                : webmaster@cback.de
 *   www                  : http://www.cback.de
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

define('IN_PHPBB', 1);

if( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$module['ct_maintitle']['ct_systest'] = $filename;

	return;
}

//
// Load Page Header
//
$no_page_header = TRUE;
$phpbb_root_path = './../';
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);

$template->set_filenames(array(
	'body' => 'admin/ct_systest.tpl'
	)
);

  $tests = array();

  // CHMOD777 Test
  $filearr = array();
  $logpath = $phpbb_root_path . 'ctracker/logs/';
  $filearr = array('counter.txt', 'logfile_flood.txt', 'logfile_proxy.txt', 'logfile_worms.txt');

  for($i=0; $i<=count($filearr)-1; $i++)
  {
    if(is_writeable($logpath . $filearr[$i]))
    {
      $tests[$i + 1] = 1;
    }
    else
    {
      $tests[$i + 1] = 0;
    }
  }

  if($cresponse200 == 'cbackctr'){ $tests[5] = 1; } else { $tests[5] = 0; }                                     // Wormprotector Response
  if($cresponse300 == 'cbackctr'){ $tests[6] = 1; } else { $tests[6] = 0; }                                     // IP&Agent Blocker Response
  if($cresponse100 == 'cbackctr'){ $tests[7] = 1; } else { $tests[7] = 0; }                                     // Function File Response
  if(!empty($ctracker_config['version'])){ $tests[8] = 1; } else { $tests[8] = 0; }                             // Database Response
  if(@file_exists($phpbb_root_path . 'ctracker/ct_footer.' . $phpEx)){ $tests[9] = 1; } else { $tests[9] = 0; } // Footer Response
  if(count($ct_rules) >= 170){ $tests[10] = 1; } else { $tests[10] = 0; }                                       // Rules Response

  for($i=1; $i<=10; $i++)
  {
    $spacerow = '';

    $table[0] = $lang['ct_sys_c' . $i];

    if($tests[$i] == 1)
    {
      $table[1] = $lang['ct_sys_ok'];
    }
    else
    {
      $table[1] = $lang['ct_sys_er'];
    }

    $template->assign_block_vars('ctrack_syscheck', array(
      'L_TABLE_1'  => $table[0],
      'L_TABLE_2'  => $table[1]));
  }

  $script_name = preg_replace('/^\/?(.*?)\/?$/', '\1', trim($board_config['script_path']));
  $script_name = ( $script_name != '' ) ? $script_name . '/index.'.$phpEx : 'index.'.$phpEx;
  $server_name = trim($board_config['server_name']);
  $server_protocol = ( $board_config['cookie_secure'] ) ? 'https://' : 'http://';
  $server_port = ( $board_config['server_port'] <> 80 ) ? ':' . trim($board_config['server_port']) . '/' : '/';
  $server_url = $server_protocol . $server_name . $server_port . $script_name;
  
  $testlink = '<a href="' . $server_url . '?chr(test)" target="_blank">';

  $template->assign_vars(array(
    "L_HEAD_1"     => $lang['ct_s_hd1'],
    "L_HEAD_2"     => $lang['ct_s_hd4'],
    "L_SYS_HEAD"   => $lang['ct_sys_he'],
    "L_SYS_DESC"   => sprintf($lang['ct_sys_de'], $testlink),
    "L_SYS_FOOTER" => $lang['ct_adm_foot'])
	);

  include('./page_header_admin.'.$phpEx);

  $template->pparse('body');

  include('./page_footer_admin.'.$phpEx);

?>
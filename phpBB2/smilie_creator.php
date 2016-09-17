<?php

define('IN_PHPBB', 'true');
$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);

$userdata = session_pagestart($user_ip, PAGE_INDEX, $session_length);
init_userprefs($userdata);

$gen_simple_header = 1;
$page_title = $lang['Smilie_creator'];
include($phpbb_root_path . 'includes/page_header.'.$phpEx);

if($_GET['mode'] == "text2schild"){ 
	$anz_smilie = -1;
	$hdl = opendir("./smilie_creator/images/smilies/schild/");
	while($res = readdir($hdl)){
		if(strtolower(substr($res, (strlen($res) - 3), 3)) == "png") $anz_smilie++;
	}
	closedir($hdl);

	$i = 1;
	$ii = 1;
	while($i <= $anz_smilie){
		$smilies_wahl .= "<td><input type=\"radio\" name=\"smilie\" value=\"".$i."\"><img src=\"smilie_creator/images/smilies/schild/smilie".$i.".png\"></td>";
		$smilies_js .= "	if(document.schilderstellung.smilie[".($i-1)."].checked) var smilie = document.schilderstellung.smilie[".($i-1)."].value;\n";
		if($ii >= 5){
			$smilies_wahl .= "</tr><tr>";
			$ii = 0;
		}
		$i++;
		$ii++;
	}

	$smilies_js .= "	if(document.schilderstellung.smilie[".($i-1)."].checked) var smilie = document.schilderstellung.smilie[".($i-1)."].value;\n";
	$smilies_js .= "	if(document.schilderstellung.smilie[".$i."].checked) var smilie = document.schilderstellung.smilie[".$i."].value;\n";
}

$template->set_filenames(array(
   'body' => 'smilie_creator.tpl',
   'jumpbox' => 'jumpbox.tpl')
);

$jumpbox = make_jumpbox($forum_id);
$template->assign_vars(array(
   'L_GO' => $lang['Go'],
   'SMILIES_WAHL' => $smilies_wahl,
   'SMILIES_JS' => $smilies_js,
   'L_SMILIE_CREATOR' => $lang['Smilie_creator'],
   'L_CREATE_SMILIE' => $lang['SC_create_smilie'],
   'L_STOP_CREATING' => $lang['SC_stop_creating'],
   'L_SHIELDSHADOW_ON' => $lang['SC_shieldshadow_on'],
   'L_SHIELDSHADOW_OFF' => $lang['SC_shieldshadow_off'],
   'L_SHIELDTEXT' => $lang['SC_shieldtext'],
   'L_SHADOWCOLOR' => $lang['SC_shadowcolor'],
   'L_SHIELDSHADOW' => $lang['SC_shieldshadow'],
   'L_SMILIECHOOSER' => $lang['SC_smiliechooser'],
   'L_RANDOM_SMILIE' => $lang['SC_random_smilie'],
   'L_DEFAULT_SMILIE' => $lang['SC_default_smilie'],
   'L_FONTCOLOR' => $lang['SC_fontcolor'],
   'L_COLOR_DEFAULT' => $lang['color_default'],
   'L_COLOR_DARK_RED' => $lang['color_dark_red'],
   'L_COLOR_RED' => $lang['color_red'],
   'L_COLOR_ORANGE' => $lang['color_orange'],
   'L_COLOR_BROWN' => $lang['color_brown'],
   'L_COLOR_YELLOW' => $lang['color_yellow'],
   'L_COLOR_GREEN' => $lang['color_green'],
   'L_COLOR_OLIVE' => $lang['color_olive'],
   'L_COLOR_CYAN' => $lang['color_cyan'],
   'L_COLOR_BLUE' => $lang['color_blue'],
   'L_COLOR_DARK_BLUE' => $lang['color_dark_blue'],
   'L_COLOR_INDIGO' => $lang['color_indigo'],
   'L_COLOR_VIOLETT' => $lang['color_violet'],
   'L_COLOR_WHITE' => $lang['color_white'],
   'L_COLOR_BLACK' => $lang['color_black'],
   'L_JUMP_TO' => $lang['Jump_to'],
   'L_SELECT_FORUM' => $lang['Select_forum'],
   'L_ANOTHER_SHIELD' => $lang['SC_another_shield'],
   'L_NOTEXT_ERROR' => $lang['SC_notext_error'],

   'S_JUMPBOX_LIST' => $jumpbox,
   'S_JUMPBOX_ACTION' => append_sid('viewforum.$phpEx'))
);
$template->assign_var_from_handle('JUMPBOX', 'jumpbox');


$template->pparse('body');
?>
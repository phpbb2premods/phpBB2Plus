<?php
/*
  paFileDB 3.0
  �2001/2002 PHP Arena
  Written by Todd
  todd@phparena.net
  http://www.phparena.net
  Keep all copyright links on the script visible
  Please read the license included with this script for more information.
*/

define('IN_PHPBB', 1);

if( !empty($setmodules) )
{
	$file = basename(__FILE__);
// MX Addon	
    $module['Download'][$lang['Mfieldtitle']] = $file;
//    $module['Download'][$lang['Afield']] = $file."?mode=add";
//    $module['Download'][$lang['Efield']] = $file."?mode=edit";
//    $module['Download'][$lang['Dfield']] = $file."?mode=delete";
	return;
}

$phpbb_root_path = "./../";

require($phpbb_root_path . 'extension.inc');

require('./pagestart.' . $phpEx);

include($phpbb_root_path . 'pafiledb/pafiledb_common.'.$phpEx);
include($phpbb_root_path . 'pafiledb/includes/functions_field.'.$phpEx);

$custom_field = new custom_field();
$custom_field->init();

// MX Modified - select
$mode = (isset($_REQUEST['mode'])) ? htmlspecialchars($_REQUEST['mode']) : 'select';
$field_id = (isset($_REQUEST['field_id'])) ? intval($_REQUEST['field_id']) : 0;
$field_type = (isset($_REQUEST['field_type'])) ? intval($_REQUEST['field_type']) : $custom_field->field_rowset[$field_id]['field_type'];
$field_ids = (isset($_REQUEST['field_ids'])) ? $_REQUEST['field_ids'] : '';
$submit = (isset($_POST['submit'])) ? TRUE : FALSE;

switch($mode)
{
	case 'addfield':
		$template_file = 'admin/pa_admin_field_add.tpl';
		break;
	case 'edit':
		$template_file = 'admin/pa_admin_select_field.tpl';
		break;
	case 'add':
		$template_file = 'admin/pa_admin_select_field_type.tpl';
		break;
	case 'delete':
		$template_file = 'admin/pa_admin_field_delete.tpl';
		break;
// MX Addon
	case 'select':
		$template_file = 'admin/pa_admin_field.tpl';
		break;
}

if($submit)
{
	if($mode == 'do_add' && !$field_id)
	{
		$custom_field->update_add_field($field_type);

		$message = $lang['Fieldadded'] . '<br /><br />' . sprintf($lang['Click_return'], '<a href="' . append_sid('admin_pa_custom.'.$phpEx) . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . append_sid('index.'.$phpEx.'?pane=right') . '">', '</a>');
		message_die(GENERAL_MESSAGE, $message);
	}
	elseif($mode == 'do_add' && $field_id)
	{
		$custom_field->update_add_field($field_type, $field_id);
		
		$message = $lang['Fieldedited'] . '<br /><br />' . sprintf($lang['Click_return'], '<a href="' . append_sid('admin_pa_custom.'.$phpEx) . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . append_sid('index.'.$phpEx.'?pane=right') . '">', '</a>');
		message_die(GENERAL_MESSAGE, $message);
	}
	elseif($mode == 'delete')
	{
		foreach($field_ids as $key => $value)
		{
			$custom_field->delete_field($key);
		}
		
		$message = $lang['Fieldsdel'] . '<br /><br />' . sprintf($lang['Click_return'], '<a href="' . append_sid('admin_pa_custom.'.$phpEx) . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . append_sid('index.'.$phpEx.'?pane=right') . '">', '</a>');
		message_die(GENERAL_MESSAGE, $message);
	}
}


$pafiledb_template->set_filenames(array(
	'admin' => $template_file)
);
	
switch($mode)
{
	case 'add':
	case 'addfield':
		$l_title = $lang['Afieldtitle'];
		break;
	case 'edit':
		$l_title = $lang['Efieldtitle'];
		break;
	case 'delete':
		$l_title = $lang['Dfieldtitle'];
		break;
// MX ADdon
	case 'select':
		$l_title = $lang['Mfieldtitle'];
		break;
}

if($mode == 'add')
{
	$s_hidden_fields = '<input type="hidden" name="mode" value="addfield">';
}
elseif($mode == 'addfield')
{
	$s_hidden_fields = '<input type="hidden" name="field_type" value="' . $field_type . '">';
	$s_hidden_fields .= '<input type="hidden" name="field_id" value="' . $field_id . '">';
	$s_hidden_fields .= '<input type="hidden" name="mode" value="do_add">';
}
elseif($mode == 'edit')
{
	$s_hidden_fields = '<input type="hidden" name="mode" value="addfield">';
}
elseif($mode == 'delete')
{
	$s_hidden_fields = '<input type="hidden" name="mode" value="delete">';
}

$pafiledb_template->assign_vars(array(
	'L_FIELD_TITLE' => $l_title,
	'L_FIELD_EXPLAIN' => $lang['Fieldexplain'],

	'S_HIDDEN_FIELDS' => $s_hidden_fields,
	'S_FIELD_ACTION' => append_sid("admin_pa_custom.$phpEx"))
);


if($mode == 'addfield')
{
	if($field_id)
	{
		$data = $custom_field->get_field_data($field_id);
	}

	$pafiledb_template->assign_vars(array(
		'L_FIELD_NAME' => $lang['Fieldname'],
		'L_FIELD_NAME_INFO' => $lang['Fieldnameinfo'],
		'L_FIELD_DESC' => $lang['Fielddesc'],
		'L_FIELD_DESC_INFO' => $lang['Fielddescinfo'],
		'L_FIELD_DATA' => $lang['Field_data'],
		'L_FIELD_DATA_INFO' => $lang['Field_data_info'],
		'L_FIELD_REGEX' => $lang['Field_regex'],
		'L_FIELD_REGEX_INFO' => sprintf($lang['Field_regex_info'], '<a href="http://www.php.net/manual/en/function.preg-match.php" target="_blank">', '</a>'),
		'L_FIELD_ORDER' => $lang['Field_order'],
			
		'DATA' => ($field_type != INPUT && $field_type != TEXTAREA) ? TRUE : FALSE,
		'REGEX' => ($field_type == INPUT || $field_type == TEXTAREA) ? TRUE : FALSE,
		'ORDER' => ($field_id) ? TRUE : FALSE,
			
		'FIELD_NAME' => $data['custom_name'],
		'FIELD_DESC' => $data['custom_description'],
		'FIELD_DATA' => $data['data'],
		'FIELD_REGEX' => $data['regex'],
		'FIELD_ORDER' => $data['field_order'])
	);
}
elseif($mode == 'add')
{
	$field_types = array(INPUT => $lang['Input'], TEXTAREA => $lang['Textarea'], RADIO => $lang['Radio'], SELECT => $lang['Select'], SELECT_MULTIPLE => $lang['Select_multiple'], CHECKBOX => $lang['Checkbox']);
	
	$field_type_list = '<select name="field_type">';
	foreach($field_types as $key => $value)
	{
		$field_type_list .= '<option value="' . $key . '">' . $value . '</option>';
	}
	$field_type_list .= '</select>';

	$pafiledb_template->assign_vars(array(
		'S_SELECT_FIELD_TYPE' => $field_type_list)
	);
}
elseif($mode == 'edit' || $mode == 'delete' || $mode == 'select' )
{
	foreach($custom_field->field_rowset as $field_id => $field_data)
	{
		$pafiledb_template->assign_block_vars('field_row', array(
			'FIELD_ID' => $field_id,
			'FIELD_NAME' => $field_data['custom_name'],
			'FIELD_DESC' => $field_data['custom_description'])
		);
	}
}

$pafiledb_template->display('admin');

$pafiledb->_pafiledb();
$cache->unload();

include('./page_footer_admin.'.$phpEx);
?>

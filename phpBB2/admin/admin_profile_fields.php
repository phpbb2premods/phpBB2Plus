<?php
/***************************************************************************
 *                          admin_profile_fields.php
 *                            -------------------
 *   author:                Brian Shields (alias Blankety Blank Man)
 *   email:                 blanketyblankman@gmail.com
 *   description:           Dynamic content file driving the addition/editing/
 *                          deletion of custom profile fields for the Custom
 *                          Profiles MOD.
 *
 *
 ***************************************************************************/

/***************************************************************************
 *                               Version notes
 *                                 ---------
 *   1.0.0: December 31, 2005
 *   ------------------------
 *      - No longer vulnerable to SQL injection
 *      - Removed Javascript implementaion for radio & checkboxes
 *      - Added field description
 *
 *   0.0.1: December 17, 2005
 *   ------------------------
 *      - Vulnerable to SQL injection
 *      - Poorly implemented Javascript for radio and checkbox values
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

define('IN_PHPBB',true);

if(!empty($setmodules))
{
  $filename = basename(__FILE__);
  $module['Custom_Profile']['Add_new'] = $filename."?mode=add&pfid=x";
  $module['Custom_Profile']['Edit'] = $filename."?mode=edit&pfid=x";
  
  return;
}

//
// Load default header
//
$no_page_header = false;
$phpbb_root_path = './../';
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);
include_once($phpbb_root_path . 'includes/functions_profile_fields.'.$phpEx);

if(!isset($HTTP_GET_VARS['mode']) || !isset($HTTP_GET_VARS['pfid']))
{
  message_die(GENERAL_ERROR,'Required GET variables not set','Could not reach admin page; Insufficient data',__LINE__,__FILE__);
}


$mode = $HTTP_GET_VARS['mode'];
$pfid = $HTTP_GET_VARS['pfid'];

if($mode == 'add')
{
  $template->set_filenames(array('body' => 'admin/add_profile_field.tpl'));
  
  $template->assign_vars(array(
    'TEXT_FIELD_CHECKED' => ' checked="checked"',
    'NOT_REQUIRED_CHECKED' => ' checked="checked"',
    'ALLOW_VIEW_CHECKED' => ' checked="checked"',
    'VIEW_IN_PROFILE_CHECKED' => ' checked="checked"',
    'ABOUT_CHECKED' => ' checked="checked"',
    'NO_VIEW_IN_MEMBERLIST' => ' checked="checked"',
    'NO_VIEW_IN_TOPIC' => ' checked="checked"',
    'AUTHOR_CHECKED' => ' checked="checked"',
    
    'L_ADD_FIELD_TITLE' => $lang['add_field_title'],
    'L_ADD_FIELD_EXPLAIN' => $lang['add_field_explain'],
    
    'S_ADD_FIELD_ACTION' => append_sid("$filename?mode=update&pfid=x")
    ));
}
elseif($mode == 'update')
{
  $template->set_filenames(array('body' => 'admin/admin_message_body.tpl'));
  
  $name = htmlspecialchars($HTTP_POST_VARS['field_name']);
  if(empty($name))
    message_die(GENERAL_ERROR,$lang['enter_a_name']);
  
  $description = htmlspecialchars($HTTP_POST_VARS['field_descrition']);
  
  $type = intval($HTTP_POST_VARS['field_type']);
  $text_field_default = htmlspecialchars($HTTP_POST_VARS['text_field_default']);
  $text_field_maxlen = empty($HTTP_POST_VARS['text_field_maxlen']) ? TEXT_FIELD_MAXLENGTH : intval($HTTP_POST_VARS['text_field_maxlen']);
  $text_field_maxlen = $text_field_maxlen > TEXT_FIELD_MAXLENGTH ? TEXT_FIELD_MAXLENGTH : $text_field_maxlen;
  $text_area_default = htmlspecialchars($HTTP_POST_VARS['text_area_default']);
  $text_area_maxlen = empty($HTTP_POST_VARS['text_area_maxlen']) ? TEXTAREA_MINLENGTH : intval($HTTP_POST_VARS['text_area_maxlen']);
  $text_area_maxlen = $text_area_maxlen > TEXTAREA_MAXLENGTH ? TEXTAREA_MAXLENGTH : $text_area_maxlen;
  
  $radio_values = htmlspecialchars($HTTP_POST_VARS['radio_values']);
  $radio_default_value = htmlspecialchars($HTTP_POST_VARS['radio_default_value']);
  $radio_values = explode("\n",str_replace("\r",'',$radio_values));
  if(empty($radio_default_value))
    $radio_default_value = $radio_values[0];
  $temp = '';
  foreach($radio_values as $val)
    $temp .= $val . ',';
  $radio_values = substr($temp,0,strlen($temp)-1);
  
  $checkbox_values = htmlspecialchars($HTTP_POST_VARS['checkbox_values']);
  $check_default_values = htmlspecialchars($HTTP_POST_VARS['check_default_values']);
  $checkbox_values = explode("\n",str_replace("\r",'',$checkbox_values));
  if(!empty($check_default_values))
  {
    $check_default_values = explode("\n",str_replace("\r",'',$check_default_values));
    $temp = '';
    foreach($check_default_values as $val)
      $temp .= $val . ',';
    $check_default_values = substr($temp,0,strlen($temp)-1);
  }
  $temp = '';
  foreach($checkbox_values as $val)
    $temp .= $val . ',';
  $checkbox_values = substr($temp,0,strlen($temp)-1);
  
  $required = intval($HTTP_POST_VARS['required']);
  $user_can_view = intval($HTTP_POST_VARS['user_can_view']);
  $view_in_profile = intval($HTTP_POST_VARS['view_in_profile']);
  $profile_location = intval($HTTP_POST_VARS['profile_location']);
  $view_in_memberlist = intval($HTTP_POST_VARS['view_in_memberlist']);
  $view_in_topic = intval($HTTP_POST_VARS['view_in_topic']);
  $signature_wrap = intval($HTTP_POST_VARS['signature_wrap']);
  
  if($pfid == 'x')
  {
    $sql = "SELECT field_name FROM " . PROFILE_FIELDS_TABLE . "
      WHERE field_name='$name'";
    if(!($result = $db->sql_query($sql)))
      message_die(GENERAL_ERROR,'Could not query database for field name information','',__LINE__,__FILE__,$sql);
    $temp = $db->sql_fetchrowset($result);
    if(!empty($temp))
      message_die(GENERAL_ERROR,$lang['field_exists']);
  }
  
  if($pfid == 'x')
    $die_message = 'Could not insert new profile field';
  else
    $die_message = 'Could not update profile information';
  
  if($pfid != 'x')
  {
    $sql = "SELECT field_name FROM " . PROFILE_FIELDS_TABLE . "
      WHERE field_id = $pfid";
    if(!($result = $db->sql_query($sql)))
      message_die(GENERAL_ERROR,'Could not find old name','',__LINE__,__FILE__,$sql);
    $old_name = $db->sql_fetchrow($result);
    $old_name = text_to_column($old_name['field_name']);
  }
  
  $name_display = $name;
  $name = str_replace("\'","''",text_to_column($name));
  $description = str_replace("\'","''",$description);
  $text_field_default = str_replace("\'","''",$text_field_default);
  $text_area_default = str_replace("\'","''",$text_area_default);
  $text_area_maxlen = str_replace("\'","''",$text_area_maxlen);
  $radio_default_value = str_replace("\'","''",$radio_default_value);
  $radio_values = str_replace("\'","''",$radio_values);
  $check_default_values = str_replace("\'","''",$check_default_values);
  $checkbox_values = str_replace("\'","''",$checkbox_values);

  $sql = "SELECT $name FROM " . USERS_TABLE . " WHERE user_id = ".$userdata['user_id']." LIMIT 1";
  if($db->sql_query($sql))
  {
	  if($pfid == 'x')
		message_die(GENERAL_ERROR, "Field like $name allready exists");
	  else if ( $old_name != $name )
		message_die(GENERAL_ERROR, "Field like $name allready exists");
  }

  if($pfid == 'x')
  {
    $sql = "INSERT INTO " . PROFILE_FIELDS_TABLE . "
      (field_name, field_description, field_type, text_field_default, text_field_maxlen, text_area_default, text_area_maxlen,
      radio_button_default, radio_button_values, checkbox_default, checkbox_values, is_required,
      users_can_view, view_in_profile, profile_location, view_in_memberlist, view_in_topic, topic_location)
      VALUES ('$name_display','$description',$type,'$text_field_default',$text_field_maxlen,'$text_area_default',$text_area_maxlen,
      '$radio_default_value','$radio_values','$check_default_values','$checkbox_values',$required,$user_can_view,
      $view_in_profile,$profile_location,$view_in_memberlist,$view_in_topic,$signature_wrap)";
  }
  else
  {
    $sql = "UPDATE " . PROFILE_FIELDS_TABLE . "
      SET field_name = '$name_display',
        field_description = '$description',
        field_type = $type,
        text_field_default = '$text_field_default',
        text_field_maxlen = $text_field_maxlen,
        text_area_default = '$text_area_default',
        text_area_maxlen = $text_area_maxlen,
        radio_button_default = '$radio_default_value',
        radio_button_values = '$radio_values',
        checkbox_default = '$check_default_values',
        checkbox_values = '$checkbox_values',
        is_required = $required,
        users_can_view = $user_can_view,
        view_in_profile = $view_in_profile,
        profile_location = $profile_location,
        view_in_memberlist = $view_in_memberlist,
        view_in_topic = $view_in_topic,
        topic_location = $signature_wrap
      WHERE field_id = $pfid";
  }
  
  if(!$db->sql_query($sql))
    message_die(GENERAL_ERROR,$die_message,'',__LINE__,__FILE__,$sql);
  
  if($pfid != 'x')
  {
    switch($type)
    {
		case TEXT_FIELD: 
			$col_type = 'VARCHAR('.$text_field_maxlen.') DEFAULT \''.$text_field_default.'\''; 
			break;
		case RADIO:
			$col_type = 'VARCHAR(255) DEFAULT \''.$radio_default_value.'\''; 
			break;
		
		case TEXTAREA:
		case CHECKBOX: 
			$col_type = 'TEXT';
			break;
    }
    $sql = "ALTER TABLE " . USERS_TABLE . "
      CHANGE $old_name $name $col_type";
    if(!$db->sql_query($sql))
      message_die(GENERAL_ERROR,'Could not change column name in '.USERS_TABLE,'',__LINE__,__FILE__,$sql);
  }
  
  $sql = "ALTER TABLE " . USERS_TABLE . "
    ADD $name";
  switch($type)
  {
    case TEXT_FIELD:
      $sql .= " varchar($text_field_maxlen) DEFAULT '$text_field_default'";
      break;
    case RADIO:
      $sql .= " varchar(255) DEFAULT '$radio_default_value'";
      break;
    case TEXTAREA:
    case CHECKBOX:
      $sql .= " text";
      break;
  }
  
  if($pfid == 'x' && !$db->sql_query($sql))
    message_die(GENERAL_ERROR,'Could not expand users table for new profile field.','',__LINE__,__FILE__,$sql);
  
  $sql = "SELECT user_id FROM " . USERS_TABLE;
  if(!($result = $db->sql_query($sql)))
    message_die(GENERAL_ERROR,'Could not retrieve use and profile information','',__LINE__,__FILE__,$sql);
  
  $user_id_array = array();
  while($temp = $db->sql_fetchrow($result))$user_id_array[] = $temp['user_id'];
  
  if($pfid == 'x')
    foreach($user_id_array as $user_id)
    {
      $sql = "UPDATE " . USERS_TABLE . "
        SET $name = %s
        WHERE user_id = $user_id";
      
      switch($type)
      {
        case TEXT_FIELD:
          $val = $text_field_default;
          break;
        case TEXTAREA:
          $val = $text_area_default;
          break;
        case RADIO:
          $val = $radio_default_value;
          break;
        case CHECKBOX:
          $val = $check_default_values;
          break;
      }
      
      $sql = sprintf($sql,"'$val'");
      
      if(!$db->sql_query($sql))
        message_die(GENERAL_ERROR,'Could not update users with default values','',__LINE__,__FILE__,$sql);
    }
  
  $template->assign_vars(array(
    'MESSAGE_TITLE' => $pfid == 'x' ? $lang['profile_field_created'] : $lang['profile_field_updated'],
    'MESSAGE_TEXT' => $lang['field_success'] . '<br /><br />' . $create_second_field_link));
}
elseif($mode == 'edit')
{
  if($pfid == 'x')
  {
    $template->set_filenames(array('body' => 'admin/add_profile_field_list.tpl'));
    
    $template->assign_vars(array(
      'L_PROFILE_FIELD_LIST_TITLE' => $lang['profile_field_list'],
      'L_PROFILE_FIELD_LIST_EXPLAIN' => $lang['profile_field_list_explain'],
      'L_ID' => $lang['profile_field_id'],
      'L_NAME' => $lang['profile_field_name'],
      'L_ACTION' => $lang['profile_field_action'],
      'L_EDIT' => $lang['Edit'],
      'L_DELETE' => $lang['Delete']
      ));
    
    $profile_rows = get_fields();
    
    if(count($profile_rows) == 0)
      $template->assign_block_vars('switch_no_fields',array('NO_FIELDS_EXIST' => $lang['no_profile_fields_exist']));
    else
    {
      $template->assign_block_vars('switch_fields',array());
      
      foreach($profile_rows as $col => $val)
      {
        $row = $col % 2 == 0 ? 'row1' : 'row2';
        $id = $val['field_id'];
        $name = $val['field_name'];
        
        $edit_url = append_sid("$filename?mode=edit&pfid=$id");
        $delete_url = append_sid("$filename?mode=delete&pfid=$id");
        
        $template->assign_block_vars('switch_fields.profile_fields',array(
          'ROW_CLASS' => $row,
          'ID' => $id,
          'NAME' => $name,
          
          'U_PROFILE_FIELD_EDIT' => $edit_url,
          'U_PROFILE_FIELD_DELETE' => $delete_url
          ));
      }
    }
  }
  else
  {
    $template->set_filenames(array('body' => 'admin/add_profile_field.tpl'));
    
    $profile_rows = get_fields('WHERE field_id = ' . $pfid,false);
    
    $template->assign_vars(array(
      'FIELD_NAME' => $profile_rows['field_name'],
      'FIELD_DESCRIPTION' => $profile_rows['field_description'],
      'TEXT_FIELD_CHECKED' => $profile_rows['field_type'] == TEXT_FIELD ? ' checked="checked"' : '',
      'TEXTAREA_CHECKED' => $profile_rows['field_type'] == TEXTAREA ? ' checked="checked"' : '',
      'RADIO_CHECKED' => $profile_rows['field_type'] == RADIO ? ' checked="checked"' : '',
      'CHECKBOX_CHECKED' => $profile_rows['field_type'] == CHECKBOX ? ' checked="checked"' : '',
      'TEXT_FIELD_DEFAULT' => $profile_rows['text_field_default'],
      'TEXT_FIELD_MAXLENGTH' => $profile_rows['text_field_maxlen'],
      'TEXTAREA_DEFAULT' => $profile_rows['text_area_default'],
      'TEXTAREA_MAXLENGTH' => $profile_rows['text_area_maxlen'],
      'REQUIRED_CHECKED' => $profile_rows['is_required'] == REQUIRED ? ' checked="checked"' : '',
      'NOT_REQUIRED_CHECKED' => $profile_rows['is_required'] == NOT_REQUIRED ? ' checked="checked"' : '',
      'ALLOW_VIEW_CHECKED' => $profile_rows['users_can_view'] == ALLOW_VIEW ? ' checked="checked"' : '',
      'DISALLOW_VIEW_CHECKED' => $profile_rows['users_can_view'] == DISALLOW_VIEW ? ' checked="checked"' : '',
      'VIEW_IN_PROFILE_CHECKED' => $profile_rows['view_in_profile'] == VIEW_IN_PROFILE ? ' checked="checked"' : '',
      'NO_VIEW_IN_PROFILE_CHECKED' => $profile_rows['view_in_profile'] == NO_VIEW_IN_PROFILE ? ' checked="checked"' : '',
      'CONTACTS_CHECKED' => $profile_rows['profile_location'] == CONTACTS ? ' checked="checked"' : '',
      'ABOUT_CHECKED' => $profile_rows['profile_location'] == ABOUT ? ' checked="checked"' : '',
      'VIEW_IN_MEMBERLIST' => $profile_rows['view_in_memberlist'] == VIEW_IN_MEMBERLIST ? ' checked="checked"' : '',
      'NO_VIEW_IN_MEMBERLIST' => $profile_rows['view_in_memberlist'] == NO_VIEW_IN_MEMBERLIST ? ' checked="checked"' : '',
      'VIEW_IN_TOPIC' => $profile_rows['view_in_topic'] == VIEW_IN_TOPIC ? ' checked="checked"' : '',
      'NO_VIEW_IN_TOPIC' => $profile_rows['view_in_topic'] == NO_VIEW_IN_TOPIC ? ' checked="checked"' : '',
      'AUTHOR_CHECKED' => $profile_rows['topic_location'] == AUTHOR ? ' checked="checked"' : '',
      'ABOVE_SIG_CHECKED' => $profile_rows['topic_location'] == ABOVE_SIGNATURE ? ' checked="checked"' : '',
      'BELOW_SIG_CHECKED' => $profile_rows['topic_location'] == BELOW_SIGNATURE ? ' checked="checked"' : '',
      'RADIO_VALUES' => str_replace(',',"\r\n",$profile_rows['radio_button_values']),
      'RADIO_DEFAULT' => $profile_rows['radio_button_default'],
      'CHECKBOX_VALUES' => str_replace(',',"\r\n",$profile_rows['checkbox_values']),
      'CHECKBOX_DEFAULT' => str_replace(',',"\r\n",$profile_rows['checkbox_default']),
      
      'L_ADD_FIELD_TITLE' => $lang['edit_field_title'],
      'L_ADD_FIELD_EXPLAIN' => $lang['edit_field_explain'],
      
      'S_ADD_FIELD_ACTION' => append_sid("$filename?mode=update&pfid=$pfid")
      ));
  }
}
elseif($mode == 'delete')
{
  $field_name = get_fields('WHERE field_id = '.$pfid,false,'field_name');
  $name = text_to_column($field_name['field_name']);
  
  $del_link = '<a href="' . append_sid("$filename?mode=confirmdelete&pfid=$pfid&name=$name") . '">' . $lang['Yes'] . '</a>';
  $nodel_link = sprintf($lang['index_link'],$lang['No']);
  
  $template->set_filenames(array('body' => 'admin/admin_message_body.tpl'));
  $template->assign_vars(array(
    'MESSAGE_TITLE' => sprintf($lang['double_check_delete'],$field_name['field_name']),
    'MESSAGE_TEXT' => $del_link . ' &nbsp; ' . $nodel_link
    ));
}
elseif($mode == 'confirmdelete')
{
  $sql = "DELETE FROM " . PROFILE_FIELDS_TABLE . "
    WHERE field_id = $pfid";
  if(!$db->sql_query($sql))
    message_die(GENERAL_ERROR,'Could not delete profile form database','',__LINE__,__FILE__,$sql);
  
  $name = $HTTP_GET_VARS['name'];
  $sql = "ALTER TABLE " . USERS_TABLE . "
    DROP COLUMN $name";
  if(!$db->sql_query($sql))
    message_die(GENERAL_ERROR,'Could not remove column from '.USERS_TABLE,'',__LINE__,__FILE__,$sql);
  
  $template->set_filenames(array('body' => 'admin/admin_message_body.tpl'));
  $template->assign_vars(array(
    'MESSAGE_TITLE' => $lang['field_deleted'],
    'MESSAGE_TEXT' => $lang['click_here_here']
    ));
}

$template->assign_vars(array(
  'L_NEW_FIELD_NAME' => $lang['add_field_name'],
  'L_NEW_FIELD_EXPLAIN' => $lang['add_field_name_explain'],
  'L_NEW_FIELD_DESCRIPTION' => $lang['add_field_description'],
  'L_NEW_FIELD_DESCRIPTION_EXPLAIN' => $lang['add_field_description_explain'],
  'L_NEW_FIELD_TYPE' => $lang['add_field_type'],
  'L_NEW_FIELD_TYPE_EXPLAIN' => $lang['edit_field_type_explain'],
  'L_REQUIRED_FIELD' => $lang['add_field_required'],
  'L_REQUIRED_FIELD_EXPLAIN' => $lang['add_field_required_explain'],
  'L_USER_CAN_VIEW' => $lang['add_field_user_can_view'],
  'L_USER_CAN_VIEW_EXPLAIN' => $lang['add_field_user_can_view_explain'],
  'L_TEXTAREA' => $lang['textarea'],
  'L_TEXTAREA_EXAMPLE' => $lang['textarea_example'],
  'L_TEXT_FIELD' => $lang['text_field'],
  'L_TEXT_FIELD_EXAMPLE' => $lang['text_field_example'],
  'L_RADIO' => $lang['radio'],
  'L_RADIO_EXAMPLE' => $lang['radio_example'],
  'L_CHECKBOX' => $lang['checkbox'],
  'L_CHECKBOX_EXAMPLE' => $lang['checkbox_example'],
  'L_VIEW_IN_PROFILE' => $lang['view_in_profile'],
  'L_VIEW_IN_MEMBERLIST' => $lang['view_in_memberlist'],
  'L_VIEW_IN_TOPIC' => $lang['view_in_topic'],    
  'L_PROFILE_LOCATIONS_EXPLAIN' => $lang['profile_locations_explain'],
  'L_CONTACTS_COLUMN' => $lang['contacts_column'],
  'L_ABOUT_COLUMN' => $lang['about_column'],    
  'L_TOPIC_LOCATIONS_EXPLAIN' => $lang['topic_locations_explain'],
  'L_ABOVE_SIGNATURE' => $lang['above'] . $lang['Signature'],
  'L_BELOW_SIGNATURE' => $lang['below'] . $lang['Signature'],
  'L_AUTHOR_COLUMN' => $lang['author_column'],    
  'L_YES' => $lang['Yes'],
  'L_NO' => $lang['No'],    
  'L_ADMIN_SETTINGS' => $lang['add_field_admin'],
  'L_GENERAL_SETTINGS' => $lang['add_field_general'],
  'L_VIEW_SETTINGS' => $lang['add_field_view'],
  'L_TEXT_FIELD_SETTINGS' => $lang['add_field_text_field'],
  'L_TEXT_AREA_SETTINGS' => $lang['add_field_text_area'],
  'L_RADIO_BUTTON_SETTINGS' => $lang['add_field_radio_button'],
  'L_CHECKBOX_SETTINGS' => $lang['add_field_checkbox'],    
  'L_DEFAULT_VALUE' => $lang['default_value'],
  'L_DEFAULT_VALUE_EXPLAIN' => $lang['default_value_explain'],
  'L_DEFAULT_VALUE_RADIO_EXPLAIN' => $lang['default_value_radio_explain'],
  'L_DEFAULT_VALUE_CHECKBOX_EXPLAIN' => $lang['default_value_checkbox_explain'],
  'L_MAX_LENGTH' => $lang['max_length'],
  'L_MAX_LENGTH_TEXT_FIELD_EXPLAIN' => $lang['max_length_explain'] . sprintf($lang['max_length_value'],TEXT_FIELD_MINLENGTH,TEXT_FIELD_MAXLENGTH),
  'L_MAX_LENGTH_TEXTAREA_EXPLAIN' => $lang['max_length_explain'] . sprintf($lang['max_length_value'],TEXTAREA_MINLENGTH,TEXTAREA_MAXLENGTH),
  'L_AVAILABLE_VALUES' => $lang['available_values'],
  'L_AVAILABE_VALUES_EXPLAIN' => $lang['available_values_explain'],    
  'L_VIEW_DISCLAIMER' => $lang['add_field_view_disclaimer'],
  'L_SUBMIT' => $lang['Submit'],
  'L_RESET' => $lang['Reset'],
  
  'S_TEXT_FIELD' => TEXT_FIELD,
  'S_TEXTAREA' => TEXTAREA,
  'S_RADIO' => RADIO,
  'S_CHECKBOX' => CHECKBOX,
  'S_REQUIRED' => REQUIRED,
  'S_NOT_REQUIRED' => NOT_REQUIRED,
  'S_ALLOW_VIEW' => ALLOW_VIEW,
  'S_DISALLOW_VIEW' => DISALLOW_VIEW,
  'S_VIEW_IN_PROFILE' => VIEW_IN_PROFILE,
  'S_NO_VIEW_IN_PROFILE' => NO_VIEW_IN_PROFILE,
  'S_CONTACTS' => CONTACTS,
  'S_ABOUT' => ABOUT,
  'S_VIEW_IN_MEMBERLIST' => VIEW_IN_MEMBERLIST,
  'S_NO_VIEW_IN_MEMBERLIST' => NO_VIEW_IN_MEMBERLIST,
  'S_VIEW_IN_TOPIC' => VIEW_IN_TOPIC,
  'S_NO_VIEW_IN_TOPIC' => NO_VIEW_IN_TOPIC,
  'S_AUTHOR' => AUTHOR,
  'S_ABOVE_SIGNATURE' => ABOVE_SIGNATURE,
  'S_BELOW_SIGNATURE' => BELOW_SIGNATURE
  ));

$template->pparse('body');

include($phpbb_root_path . 'admin/page_footer_admin.' . $phpEx);
?>

<?php
/***************************************************************************
 *                             admin_kb_cat.php
 *                            -------------------
 *   begin                : Monday, Mar 31, 2003
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: admin_kb_cat.php,v 1.4 2004/05/02 08:25:02 jonohlsson Exp $
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
	$file = basename(__FILE__);
	$module['KB_title']['Cat_man'] = $file;
	return;
}

// function get_list($id, $select, $selected = false)
function get_list_kb($id, $select, $selected = false)
{
 	global $db;

    $idfield = 'category_id';
	$namefield = 'category_name';

	$sql = "SELECT *
		FROM " . KB_CATEGORIES_TABLE;
	
	if( $select == 0 )
	{
		$sql .= " WHERE $idfield <> $id";
	}
	
	if( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, "Couldn't get list of Categories", "", __LINE__, __FILE__, $sql);
	}

	$cat_list = "";

	while( $row = $db->sql_fetchrow($result) )
	{
		if ( $selected == $row[$idfield] )
		{
		    $status = 'selected';
		}
		else
		{
		    $status = '';
		}
		$catlist .= "<option value=\"$row[$idfield]\" $status>" . $row[$namefield] . "</option>\n";
	}

	return($catlist);
}

//
// get_kb_cat_subs($parent)
// gets sub categories for a category
//
function get_kb_cat_subs($parent, $indent)
{
    global $db, $template, $phpbb_root_path, $phpbb_root_path, $phpEx, $images, $row_color, $row_class, $theme, $i, $lang;
	
	//$i = $i + 1;
	
	$sql = "SELECT *  
       		FROM " . KB_CATEGORIES_TABLE . " 
			WHERE parent = " . $parent . " 
			ORDER BY cat_order";
	
	 if ( !($result = $db->sql_query($sql)) )
	 {
		message_die(GENERAL_ERROR, "Could not obtain sub-category data", '', __LINE__, __FILE__, $sql);
	 }

	 while ( $category2 = $db->sql_fetchrow($result) )
	 {		
		$category_details2 = $category2['category_details'];
		$category_articles2 = $category2['number_articles'];
		
		$category_id2 = $category2['category_id'];
		$category_name2 = $category2['category_name'];
		$temp_url = append_sid($phpbb_root_path . "kb.$phpEx?mode=cat&amp;cat=$category_id2");
	   	$category2 = '<a href="' . $temp_url . '" class="gen">' . $category_name2 . '</a>';
		
		$temp_url = append_sid($phpbb_root_path . "admin/admin_kb_cat.$phpEx?mode=edit&amp;cat=$category_id2");
	   	$edit2 = '<a href="' . $temp_url . '"><img src="'.$phpbb_root_path . $images['icon_edit'] . '" border="0" alt="' . $lang['Edit'] . '"></a>';
		
		$temp_url = append_sid($phpbb_root_path . "admin/admin_kb_cat.$phpEx?mode=delete&amp;cat=$category_id2");
	   	$delete2 = '<a href="' . $temp_url . '" class="gen"><img src="'.$phpbb_root_path . $images['icon_delpost'] . '" border="0" alt="' . $lang['Delete'] . '"></a>';
		
		$temp_url = append_sid($phpbb_root_path . "admin/admin_kb_cat.$phpEx?mode=up&amp;cat=$category_id2");
		$up2 = '<a href="' . $temp_url . '" class="gen">' . $lang['Move_up'] . '</a>';
		
		$temp_url = append_sid($phpbb_root_path . "admin/admin_kb_cat.$phpEx?mode=down&amp;cat=$category_id2");
		$down2 = '<a href="' . $temp_url . '" class="gen">' . $lang['Move_down'] . '</a>';
		
		$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
		$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];
		
		$template->assign_block_vars('catrow.subrow', array(
			'CATEGORY' => $category2,
			'CAT_DESCRIPTION' => $category_details2,
			'CAT_ARTICLES' => $category_articles2,
			
			'INDENT' => $indent,
			
			'U_EDIT' => $edit2,
			'U_DELETE' => $delete2,
			'U_UP' => $up2,
			'U_DOWN' => $down2,
			
			'ROW_COLOR' => '#' . $row_color,
			'ROW_CLASS' => $row_class)
		);
		$i++;
		$sql = "SELECT category_id  
       		FROM " . KB_CATEGORIES_TABLE . " 
			WHERE parent = " . $category_id2 . " 
			ORDER BY cat_order";
		if ( !($result2 = $db->sql_query($sql)) )
	 	{
		    message_die(GENERAL_ERROR, "Could not obtain sub-category data", '', __LINE__, __FILE__, $sql);
	 	}

	 	$kb_cat = $db->sql_fetchrow($result2);
	 	
		if ( $kb_cat['category_id'] != '' )
		{
			$temp = $indent . '-> ';
			get_kb_cat_subs($category_id2, $temp);
		}		    
	}	
	return;
}

//
// Load default header
//
$phpbb_root_path = "./../";
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);
include($phpbb_root_path . 'config.'.$phpEx);
require($phpbb_root_path . 'includes/kb_constants.' . $phpEx);
include($phpbb_root_path . 'includes/functions_admin.'.$phpEx);

if ( isset($_POST['mode']) || isset($_GET['mode']) )
{
	$mode = ( isset($_POST['mode']) ) ? $_POST['mode'] : $_GET['mode'];
}
else
{
	if ( $create )
	{
		$mode = 'create';
	}
	else if ( $edit )
	{
		$mode = 'edit';
	}
	else if ( $delete )
	{
		$mode = 'delete';
	}
	else
	{
		$mode = '';
	}
}

switch( $mode )
{

  case ('create'):
	  
  if ( !$_POST['submit'] )
  {
   	   $new_cat_name = stripslashes($_POST['new_cat_name']);
  
	   //
 	   // Generate page
  	   //
  	   $template->set_filenames(array(
			'body' => 'admin/kb_cat_edit_body.tpl')
       );
	   
	   $template->assign_block_vars('switch_cat', array());
	   
  	   $template->assign_vars(array( 
	        'L_EDIT_TITLE' => $lang['Create_cat'],
			'L_EDIT_DESCRIPTION' => $lang['Create_description'],
			'L_CATEGORY' => $lang['Category'],
			'L_DESCRIPTION' => $lang['Article_description'],
			'L_NUMBER_ARTICLES' => $lang['Articles'],
			'L_CAT_SETTINGS' => $lang['Cat_settings'],
			'L_CREATE' => $lang['Create'],
			'L_PARENT' => $lang['Parent'],
			'L_NONE' => $lang['None'],
			
			'PARENT_LIST' => get_list_kb(0, 0, 0),
			
			'S_ACTION' => append_sid($phpbb_root_path . "admin/admin_kb_cat.$phpEx?mode=create"),
			'CAT_NAME' => $new_cat_name,
			'DESC' => '',
			'NUMBER_ARTICLES' => '0')
		);
  }
  else if ($_POST['submit'] )
  {	   
	   $cat_name = trim($_POST['catname']);
	   
	   if ( !$cat_name )
	   {
	   	  echo "Please put a category name in!";
	   }
	   
	   $cat_desc = $_POST['catdesc'];
	   $parent = $_POST['parent'];
	   
	   $sql = "SELECT MAX(cat_order) AS cat_order
			FROM " .  KB_CATEGORIES_TABLE . " WHERE parent = $parent";
	   if ( !($result = $db->sql_query($sql)) )
	   {
		  message_die(GENERAL_ERROR, 'Could not obtain next type id', '', __LINE__, __FILE__, $sql);
	   }

	   if ( !($id = $db->sql_fetchrow($result)) )
	   {
		    message_die(GENERAL_ERROR, 'Could not obtain next type id', '', __LINE__, __FILE__, $sql);
	    }
		$cat_order = $id['cat_order'] + 10;
	   
	   $sql = "INSERT INTO " . KB_CATEGORIES_TABLE . " ( category_name, category_details, number_articles, parent, cat_order)" . 
	   		   " VALUES ( '$cat_name', ' $cat_desc', '0', '$parent', '$cat_order')";
			   
	   if ( !($results = $db->sql_query($sql)) )
	   {
	       message_die(GENERAL_ERROR, "Could not create category", '', __LINE__, __FILE__, $sql);
	   }

	   $message = $lang['Cat_created'] . '<br /><br />' . sprintf($lang['Click_return_cat_manager'], '<a href="' . append_sid("admin_kb_cat.$phpEx") . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . append_sid($phpbb_root_path . "admin/index.$phpEx?pane=right") . '">', '</a>');

	message_die(GENERAL_MESSAGE, $message);	
  }
  break;

  case ('edit'):
  
  if ( !$_POST['submit'] )
  {
   	   $cat_id = $_GET['cat'];
	   
	   $sql = "SELECT * FROM " . KB_CATEGORIES_TABLE . " WHERE category_id = " . $cat_id;
		 
	   if ( !($results = $db->sql_query($sql)) )
	   {
   	  	  message_die(GENERAL_ERROR, "Could not obtain category information", '', __LINE__, __FILE__, $sql);
	   }
	   if ( $kb_cat = $db->sql_fetchrow($results) )
	   {
	  	  $cat_name = $kb_cat['category_name'];
		  $cat_desc = $kb_cat['category_details'];
		  $number_articles = $kb_cat['number_articles'];
		  $parent = $kb_cat['parent'];
	   }
  
	   //
 	   // Generate page
  	   //
  	   $template->set_filenames(array(
			'body' => 'admin/kb_cat_edit_body.tpl')
       );

	   $template->assign_block_vars('switch_cat', array());
	   $template->assign_block_vars('switch_cat.switch_edit_category', array());
	   
  	   $template->assign_vars(array( 
	        'L_EDIT_TITLE' => $lang['Edit_cat'],
			'L_EDIT_DESCRIPTION' => $lang['Edit_description'],
			'L_CATEGORY' => $lang['Category'],
			'L_DESCRIPTION' => $lang['Article_description'],
			'L_NUMBER_ARTICLES' => $lang['Articles'],
			'L_CAT_SETTINGS' => $lang['Cat_settings'],
			'L_CREATE' => $lang['Edit'],
			
			'L_PARENT' => $lang['Parent'],
			'L_NONE' => $lang['None'],
			
			'PARENT_LIST' => get_list_kb($cat_id, 0, $parent),
			
			'S_ACTION' => append_sid($phpbb_root_path . "admin/admin_kb_cat.$phpEx?mode=edit"),
			'CAT_NAME' => $cat_name,
			'CAT_DESCRIPTION' => $cat_desc,
			'NUMBER_ARTICLES' => $number_articles,
			
			'S_HIDDEN' => '<input type="hidden" name="catid" value="' . $cat_id . '">')
		);
  }
  else if ($_POST['submit'] )
  {
   	   $cat_id = $_POST['catid'];
	   $cat_name = trim($_POST['catname']);
	   $cat_desc = $_POST['catdesc'];
	   $number_articles = $_POST['number_articles'];
	   $parent = $_POST['parent'];
	   
	   if ( !$cat_name )
	   {
	   	  echo "Please put a category name in!";
	   }
	   
	   $sql = "UPDATE " . KB_CATEGORIES_TABLE .
	   		" SET category_name = '" . $cat_name .
			"', category_details = '" . $cat_desc .
			"', number_articles = '" . $number_articles .
			"', parent = '" . $parent . 
			"' WHERE category_id = " . $cat_id;
		   
	   if ( !($results = $db->sql_query($sql)) )
	   {
	       message_die(GENERAL_ERROR, "Could not update category", '', __LINE__, __FILE__, $sql);
	   }

	   $message = $lang['Cat_edited'] . '<br /><br />' . sprintf($lang['Click_return_cat_manager'], '<a href="' . append_sid("admin_kb_cat.$phpEx") . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . append_sid($phpbb_root_path . "admin/index.$phpEx?pane=right") . '">', '</a>');

	   message_die(GENERAL_MESSAGE, $message);	
  }
  break;
  
  case ('delete'):

  if ( !$_POST['submit'] )
  {
   	   $cat_id = $_GET['cat'];
  
  	   $sql = "SELECT *  
       		FROM " . KB_CATEGORIES_TABLE . 
			" WHERE category_id = '" . $cat_id . "'";
	
	   if ( !($cat_result = $db->sql_query($sql)) )
	   {
	   	  message_die(GENERAL_ERROR, "Could not obtain category information", '', __LINE__, __FILE__, $sql);
	   }

	   if ( $category = $db->sql_fetchrow($cat_result) )
	   {
	   	  $cat_name = $category['category_name'];
	   }
  
  	   //
 	   // Generate page
  	   //
  	   $template->set_filenames(array(
			'body' => 'admin/kb_cat_del_body.tpl')
       );

  	   $template->assign_vars(array(
	       'L_DELETE_TITLE' => $lang['Cat_delete_title'],
		   'L_DELETE_DESCRIPTION' => $lang['Cat_delete_desc'],
		   'L_CAT_DELETE' => $lang['Cat_delete_title'],
		   'L_DELETE_ARTICLES' => $lang['Delete_all_articles'],
		   
		   'L_CAT_NAME' => $lang['Article_category'],
		   'L_MOVE_CONTENTS' => $lang['Move_contents'],
		   'L_DELETE' => $lang['Move_and_Delete'],
		   
		   'S_HIDDEN_FIELDS' => '<input type="hidden" name="catid" value="' . $cat_id .'">',
		   'S_SELECT_TO' => get_list_kb($cat_id, 0),
		   'S_ACTION' => append_sid($phpbb_root_path . "admin/admin_kb_cat.$phpEx?mode=delete"),
		   
		   'CAT_NAME' => $cat_name)
	);  
  }
  else if ( $_POST['submit'] )
  {
   	   $new_category = $_POST['move_id'];
	   $old_category = $_POST['catid'];
  
  	   if ( $new_category != '0' )
	   {  
   	      $sql = "UPDATE " . KB_ARTICLES_TABLE .
	   		   " SET article_category_id = '$new_category' 
			   WHERE article_category_id = '$old_category'";
			
	      if ( !($move_result = $db->sql_query($sql)) )
	      {
	   	     message_die(GENERAL_ERROR, "Could not move articles", '', __LINE__, __FILE__, $sql);
	      }
	   
	      $sql = "SELECT *  
       		   FROM " . KB_CATEGORIES_TABLE . 
			   " WHERE category_id = '$new_category'";
			
	     if ( !($cat_result = $db->sql_query($sql)) )
	      {
	   	     message_die(GENERAL_ERROR, "Could not get category data", '', __LINE__, __FILE__, $sql);
	      }
	   
	      if( $new_cat = $db->sql_fetchrow($cat_result) )
	      {
	         $new_articles = $new_cat['number_articles'];
	      }
	   
	      $sql = "SELECT *  
       		   FROM " . KB_CATEGORIES_TABLE . 
			   " WHERE category_id = '$old_category'";
			
	      if ( !($oldcat_result = $db->sql_query($sql)) )
	      {
	   	     message_die(GENERAL_ERROR, "Could not get category data", '', __LINE__, __FILE__, $sql);
	      }
	   
	      if( $old_cat = $db->sql_fetchrow($oldcat_result) )
	      {
	         $old_articles = $old_cat['number_articles'];
	      }
	   
	      $number_articles = $new_articles + $old_articles;
	   
	   	  $sql = "UPDATE " . KB_CATEGORIES_TABLE .
	   		  " SET number_articles = '" . $number_articles .
			  "' WHERE category_id = " . $new_category;
	   
	   	  if ( !($number_result = $db->sql_query($sql)) )
	   	  {
	   	   	 message_die(GENERAL_ERROR, "Could not update articles number", '', __LINE__, __FILE__, $sql);
	   	  }
	   }
	   else
	   {
	       $sql = "DELETE FROM " . KB_ARTICLES_TABLE . " 
		   		      WHERE article_category_id = " . $old_category;
		   if ( !($delete__articles = $db->sql_query($sql)) )
	   	   {
	   	       message_die(GENERAL_ERROR, "Could not delete articles", '', __LINE__, __FILE__, $sql);
	   	   }
	   }
	   	
	   $sql = "DELETE FROM " . KB_CATEGORIES_TABLE .
	   		  " WHERE category_id = $old_category";
			 
	   if ( !($delete_result = $db->sql_query($sql)) )
	   {
	   	  message_die(GENERAL_ERROR, "Could not delete category", '', __LINE__, __FILE__, $sql);
	   }
	   	
	   $message = $lang['Cat_deleted'] . '<br /><br />' . sprintf($lang['Click_return_cat_manager'], '<a href="' . append_sid("admin_kb_cat.$phpEx") . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . append_sid($phpbb_root_path . "admin/index.$phpEx?pane=right") . '">', '</a>');

	   message_die(GENERAL_MESSAGE, $message);
  }
  break;
  
  default:
 
  if ( $mode == "up" )
  {
      $cat_id = $_GET['cat'];
	  
	  $sql = "SELECT *  
	  	   FROM " . KB_CATEGORIES_TABLE . " 
		   WHERE category_id = $cat_id";
		   
	  if ( !($result = $db->sql_query($sql)) )
	  {
	      message_die(GENERAL_ERROR, "Could not get category data", '', __LINE__, __FILE__, $sql);
	  }
	   
	  if( $category = $db->sql_fetchrow($result) )
	  {
		  $parent = $category['parent'];
		  $old_pos = $category['cat_order'];
		  $new_pos = $old_pos-10;
	  }
	  
	  $sql = "UPDATE " . KB_CATEGORIES_TABLE . " SET
	  	   cat_order = '" . $old_pos . "' 
		   WHERE parent = " . $parent . " AND cat_order = " . $new_pos;
		   
	  if ( !($result = $db->sql_query($sql)) )
	  {
	      message_die(GENERAL_ERROR, "Could not update order", '', __LINE__, __FILE__, $sql);
	  }
	  
	  $sql = "UPDATE " . KB_CATEGORIES_TABLE . " SET
	  	   cat_order = '" . $new_pos . "' 
		   WHERE category_id = " . $cat_id;
		   
	  if ( !($result = $db->sql_query($sql)) )
	  {
	      message_die(GENERAL_ERROR, "Could not update order", '', __LINE__, __FILE__, $sql);
	  }
  }
  
  if ( $mode == "down" )
  {
      $cat_id = $_GET['cat'];
	  
	  $sql = "SELECT *  
	  	   FROM " . KB_CATEGORIES_TABLE . " 
		   WHERE category_id = $cat_id";
		   
	  if ( !($result = $db->sql_query($sql)) )
	  {
	      message_die(GENERAL_ERROR, "Could not get category data", '', __LINE__, __FILE__, $sql);
	  }
	   
	  if( $category = $db->sql_fetchrow($result) )
	  {
		  $parent = $category['parent'];
		  $old_pos = $category['cat_order'];
		  $new_pos = $old_pos+10;
	  }
	  
	  $sql = "UPDATE " . KB_CATEGORIES_TABLE . " SET
	  	   cat_order = '" . $old_pos . "' 
		   WHERE parent = " . $parent . " AND cat_order = " . $new_pos;
		   
	  if ( !($result = $db->sql_query($sql)) )
	  {
	      message_die(GENERAL_ERROR, "Could not update order", '', __LINE__, __FILE__, $sql);
	  }
	  
	  $sql = "UPDATE " . KB_CATEGORIES_TABLE . " SET
	  	   cat_order = '" . $new_pos . "' 
		   WHERE category_id = " . $cat_id;
		   
	  if ( !($result = $db->sql_query($sql)) )
	  {
	      message_die(GENERAL_ERROR, "Could not update order", '', __LINE__, __FILE__, $sql);
	  }
  }
 
  //
  // Generate page
  //
  $template->set_filenames(array(
		'body' => 'admin/kb_cat_admin_body.tpl')
  );

  $template->assign_vars(array(
      'L_KB_CAT_TITLE' => $lang['Cat_man'],
  	  'L_KB_CAT_DESCRIPTION' => $lang['KB_cat_description'],
  
  	  'L_CREATE_CAT' => $lang['Create_cat'],
	  'L_CREATE' => $lang['Create'],
  	  'L_CATEGORY' => $lang['Article_category'],
  	  'L_ACTION' => $lang['Art_action'],
	  'L_ARTICLES' => $lang['Articles'],
	  'L_ORDER' => $lang['Update_order'],
	  
	  'S_ACTION' => append_sid($phpbb_root_path . "admin/admin_kb_cat.$phpEx?mode=create"))
   );
  
  //get categories
  $sql = "SELECT *  
       		FROM " . KB_CATEGORIES_TABLE . " 
			WHERE parent = 0 ORDER BY cat_order ASC";
	
	if ( !($cat_result = $db->sql_query($sql)) )
	{
	   message_die(GENERAL_ERROR, "Could not obtain category information", '', __LINE__, __FILE__, $sql);
	}

	while ( $category = $db->sql_fetchrow($cat_result) )
	{	
		
		$category_details = $category['category_details'];
		$category_articles = $category['number_articles'];
		
		$category_id = $category['category_id'];
		$category_name = $category['category_name'];
		$temp_url = append_sid($phpbb_root_path . "kb.$phpEx?mode=cat&amp;cat=$category_id");
	   	$category_link = '<a href="' . $temp_url . '" class="gen">' . $category_name . '</a>';
		
		$temp_url = append_sid($phpbb_root_path . "admin/admin_kb_cat.$phpEx?mode=edit&amp;cat=$category_id");
	   	$edit = '<a href="' . $temp_url . '"><img src="'.$phpbb_root_path . $images['icon_edit'] . '" border="0" alt="' . $lang['Edit'] . '"></a>';
		
		$temp_url = append_sid($phpbb_root_path . "admin/admin_kb_cat.$phpEx?mode=delete&amp;cat=$category_id");
	   	$delete = '<a href="' . $temp_url . '" class="gen"><img src="'.$phpbb_root_path . $images['icon_delpost'] . '" border="0" alt="' . $lang['Delete'] . '"></a>';
		
		$temp_url = append_sid($phpbb_root_path . "admin/admin_kb_cat.$phpEx?mode=up&amp;cat=$category_id");
		$up = '<a href="' . $temp_url . '" class="gen">' . $lang['Move_up'] . '</a>';
		
		$temp_url = append_sid($phpbb_root_path . "admin/admin_kb_cat.$phpEx?mode=down&amp;cat=$category_id");
		$down = '<a href="' . $temp_url . '" class="gen">' . $lang['Move_down'] . '</a>';
		
		$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
		$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];
		
		$template->assign_block_vars('catrow', array(
			'CATEGORY' => $category_link,
			'CAT_DESCRIPTION' => $category_details,
			'CAT_ARTICLES' => $category_articles,
			
			'U_EDIT' => $edit,
			'U_DELETE' => $delete,
			'U_UP' => $up,
			'U_DOWN' => $down,
			
			'ROW_COLOR' => '#' . $row_color,
			'ROW_CLASS' => $row_class)
		);
		
		$i++;
		get_kb_cat_subs($category_id, '-> ');		
	}
	break;
}

$template->pparse('body');

include('./page_footer_admin.'.$phpEx);

?>
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
// MX mod
    $module['Download']['License_title'] = $file;    
//    $module['Download']['Alicense'] = $file."?license=add";    
//    $module['Download']['Elicense'] = $file."?license=edit";    
//    $module['Download']['Dlicense'] = $file."?license=delete";
	return;
}

$phpbb_root_path = "./../";

require($phpbb_root_path . 'extension.inc');

require('./pagestart.' . $phpEx);

include($phpbb_root_path . 'pafiledb/pafiledb_common.'.$phpEx);

if( isset($_GET['license']) || isset($_POST['license']) )
{
	$license = (isset($_POST['license'])) ? $_POST['license'] : $_GET['license'];

	switch($license)
	{
		case 'add':
		{
			$template->set_filenames(array(
				'admin' => 'admin/pa_admin_license_add.tpl')
			);

			if ( isset($_GET['add']) || isset($_POST['add']) )
			{
				$add = ( isset($_GET['add']) ) ? $_GET['add'] : $_POST['add'];
			}

			if ($add == 'do')
			{
				if ( isset($_GET['form']) || isset($_POST['form']) )
				{
					$form = ( isset($_GET['form']) ) ? $_GET['form'] : $_POST['form'];
				}

				//$form['text'] = str_replace("\n", "<br>", $form['text']);

				$sql = "INSERT INTO " . PA_LICENSE_TABLE . " VALUES('NULL', '" . $form['name'] . "', '" . $form['text'] . "')";

				if ( !($db->sql_query($sql)) )
				{
					message_die(GENERAL_ERROR, 'Couldnt Query info', '', __LINE__, __FILE__, $sql);
				}

				$message = $lang['Licenseadded'] . '<br /><br />' . sprintf($lang['Click_return'], '<a href="' . append_sid("admin_pa_license.$phpEx") . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . append_sid("index.$phpEx?pane=right") . '">', '</a>');

				message_die(GENERAL_MESSAGE, $message);
			}

			if (empty($add)) 
			{
				$template->assign_vars(array(
					'S_ADD_LIC_ACTION' => append_sid("admin_pa_license.$phpEx"),
					'L_ALICENSETITLE' => $lang['Alicensetitle'],
					'L_LICENSEEXPLAIN' => $lang['Licenseexplain'],
					'L_LNAME' => $lang['Lname'],
					'L_LTEXT' => $lang['Ltext'])
				);
			}

			$template->pparse('admin');

			break;
		}

		case 'edit':
		{
			$template->set_filenames(array(
				'admin' => 'admin/pa_admin_license_edit.tpl')
			);

			if ( isset($_GET['edit']) || isset($_POST['edit']) )
			{
				$edit = ( isset($_GET['edit']) ) ? $_GET['edit'] : $_POST['edit'];
			}

			if ($edit == 'do')
			{
				if ( isset($_GET['form']) || isset($_POST['form']) )
				{
					$form = ( isset($_GET['form']) ) ? $_GET['form'] : $_POST['form'];
				}

				if ( isset($_GET['id']) || isset($_POST['id']) )
				{
					$id = ( isset($_GET['id']) ) ? intval($_GET['id']) : intval($_POST['id']);
				}

				//$form['text'] = str_replace("\n", "<br>", $form['text']);

				$sql = "UPDATE " . PA_LICENSE_TABLE . " SET license_name = '" . $form['name'] . "', license_text = '" . $form['text'] . "' WHERE license_id = '" . $id . "'";

				if ( !($db->sql_query($sql)) )
				{
					message_die(GENERAL_ERROR, 'Couldnt Query info', '', __LINE__, __FILE__, $sql);
				}

				$message = $lang['Licenseedited'] . '<br /><br />' . sprintf($lang['Click_return'], '<a href="' . append_sid("admin_pa_license.$phpEx") . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . append_sid("index.$phpEx?pane=right") . '">', '</a>');

				message_die(GENERAL_MESSAGE, $message);
			}

			if ($edit == 'form')
			{
				if ( isset($_GET['select']) || isset($_POST['select']) )
				{
					$select = ( isset($_GET['select']) ) ? $_GET['select'] : $_POST['select'];
				}

				$sql = "SELECT * FROM " . PA_LICENSE_TABLE . " WHERE license_id = '" . $select . "'";

				if ( !($result = $db->sql_query($sql)) )
				{
					message_die(GENERAL_ERROR, 'Couldnt Query info', '', __LINE__, __FILE__, $sql);
				}

				$license = $db->sql_fetchrow($result);

				$text = str_replace("<br>", "\n", $license['license_text']);

				$template->assign_block_vars("license_form", array());

				$template->assign_vars(array(
					'S_EDIT_LIC_ACTION' => append_sid("admin_pa_license.$phpEx"),
					'L_ELICENSETITLE' => $lang['Elicensetitle'],
					'L_LICENSEEXPLAIN' => $lang['Licenseexplain'],
					'L_LNAME' => $lang['Lname'],
					'LICENSE_NAME' => $license['license_name'],
					'TEXT' => $text,
					'SELECT' => $select,
					'L_LTEXT' => $lang['Ltext'])
				);
			}

			if (empty($edit)) 
			{
				$sql = "SELECT * FROM " . PA_LICENSE_TABLE;

				if ( !($result = $db->sql_query($sql)) )
				{
					message_die(GENERAL_ERROR, 'Couldnt Query info', '', __LINE__, __FILE__, $sql);
				}

				while ($license = $db->sql_fetchrow($result))
				{
					$row .= '<tr><td width="3%" class="row1" align="center" valign="middle"><input type="radio" name="select" value="' . $license['license_id'] . '"></td><td width="97%" class="row1">' . $license['license_name'] . '</td></tr>';
				}

				$template->assign_block_vars("license", array());

				$template->assign_vars(array(
					'S_EDIT_LIC_ACTION' => append_sid("admin_pa_license.$phpEx"),
					'L_ELICENSETITLE' => $lang['Elicensetitle'],
					'L_LICENSEEXPLAIN' => $lang['Licenseexplain'],
					'ROW' => $row)
				);
			}

			$template->pparse('admin');

			break;	
		}

		case 'delete':
		{
			$template->set_filenames(array(
				'admin' => 'admin/pa_admin_license_delete.tpl')
			);

			if ( isset($_GET['delete']) || isset($_POST['delete']) )
			{
				$delete = ( isset($_GET['delete']) ) ? $_GET['delete'] : $_POST['delete'];
			}
            
			if ($delete == 'do')
			{
				if ( isset($_GET['select']) || isset($_POST['select']) )
				{
					$select = ( isset($_GET['select']) ) ? $_GET['select'] : $_POST['select'];
				}

				if (empty($select)) 
				{ 
					$message = $lang['lderror'] . '<br /><br />' . sprintf($lang['Click_return'], '<a href="' . append_sid("admin_pa_license.$phpEx?license=delete") . '">', '</a>');

					message_die(GENERAL_MESSAGE, $message);
				}
				else 
				{
					foreach ($select as $key => $value)
					{
						$sql = "DELETE FROM " . PA_LICENSE_TABLE . " WHERE license_id = '" . $key . "'";

						if ( !($db->sql_query($sql)) )
						{
							message_die(GENERAL_ERROR, 'Couldnt Query info', '', __LINE__, __FILE__, $sql);
						}

						$sql = "UPDATE " . PA_FILES_TABLE . " SET file_license = '0' WHERE file_license = '$key'";

						if ( !($db->sql_query($sql)) )
						{
							message_die(GENERAL_ERROR, 'Couldnt Query info', '', __LINE__, __FILE__, $sql);
						}
					}

					$message = $lang['Ldeleted'] . '<br /><br />' . sprintf($lang['Click_return'], '<a href="' . append_sid("admin_pa_license.$phpEx") . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . append_sid("index.$phpEx?pane=right") . '">', '</a>');

					message_die(GENERAL_MESSAGE, $message);                		        
				}
			}

			if (empty($delete)) 
			{
				$sql = "SELECT * FROM " . PA_LICENSE_TABLE;

				if ( !($result = $db->sql_query($sql)) )
				{
					message_die(GENERAL_ERROR, 'Couldnt Query info', '', __LINE__, __FILE__, $sql);
				}

				while ($license = $db->sql_fetchrow($result)) 
				{
					$row .= '<tr><td width="3%" class="row1" align="center" valign="middle"><input type="checkbox" name="select[' . $license['license_id'] . ']" value="yes"></td><td width="97%" class="row1">' . $license['license_name'] . '</td></tr>';
				}

				$template->assign_vars(array(
					'S_DELETE_LIC_ACTION' => append_sid("admin_pa_license.$phpEx"),
					'L_DLICENSETITLE' => $lang['Dlicensetitle'],
					'L_LICENSEEXPLAIN' => $lang['Licenseexplain'],
					'ROW' => $row)
				);

			}

			$template->pparse('admin');

			break;
		}
	}
}
// MX Addon
else
{
		// main
			$template->set_filenames(array(
				'admin' => 'admin/pa_admin_license.tpl')
			);
			
				$sql = "SELECT * FROM " . PA_LICENSE_TABLE;

				if ( !($result = $db->sql_query($sql)) )
				{
					message_die(GENERAL_ERROR, 'Couldnt Query info', '', __LINE__, __FILE__, $sql);
				}

				while ($license = $db->sql_fetchrow($result))
				{
					$row .= '<tr><td width="80%" class="row1" align="center">' . $license['license_name'] . '</td></tr>';
				}
						
				$template->assign_vars(array(
					'S_DELETE_LIC_ACTION' => append_sid("admin_pa_license.$phpEx"),
					'L_LICENSETITLE' => $lang['License_title'],
					'L_ALICENSETITLE' => $lang['Alicensetitle'],
					'L_ELICENSETITLE' => $lang['Elicensetitle'],
					'L_DLICENSETITLE' => $lang['Dlicensetitle'],
					'L_LICENSEEXPLAIN' => $lang['Licenseexplain'],
					'ROW' => $row)
				);
			$template->pparse('admin');
}

include('./page_footer_admin.'.$phpEx);
?>

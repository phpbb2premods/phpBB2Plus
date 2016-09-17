<?php
define('IN_PHPBB', 1);
if( !empty($setmodules) )
{
        $filename = basename(__FILE__);
        $module['Users']['Activate_title'] = $filename;
        return;
}

$phpbb_root_path = "../";
require($phpbb_root_path . 'extension.inc');
require('pagestart.' . $phpEx);
require($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_admin.' . $phpEx);

// delete part
if(isset($_GET['delete']) || isset($_POST['delete']))
{
        $delete = (isset($_GET['delete'])) ? $_GET['delete'] : $_POST['delete'];
        $sql = "DELETE FROM " . USERS_TABLE . " WHERE user_id = $delete";
        if( !$db->sql_query($sql) )
        {
                message_die(GENERAL_ERROR, "Unable to delete user.", "", __LINE__, __FILE__, $sql);
        }

        $sql = "DELETE FROM " . USER_GROUP_TABLE . " WHERE user_id = $delete";
        if( !$db->sql_query($sql) )
        {
                message_die(GENERAL_ERROR, 'Could not delete user from user_group table', '', __LINE__, __FILE__, $sql);
        }

        $sql = "SELECT g.group_id
                   FROM " . GROUPS_TABLE . " g LEFT JOIN " . USER_GROUP_TABLE . " ug
                            ON g.group_id = ug.group_id
                   WHERE group_single_user = 1 AND ug.group_id IS NULL";
        if ( !($result = $db->sql_query($sql)) )
        {
                message_die(GENERAL_ERROR, 'Could not obtain group information.', '', __LINE__, __FILE__, $sql);
        }
        while ( $row = $db->sql_fetchrow($result) )
        {
                $sql2 = "DELETE FROM " . GROUPS_TABLE . " WHERE group_id = " . $row['group_id'];
                if ( !($db->sql_query($sql2)) )
                {
                        message_die(GENERAL_ERROR, 'Could not delete group.', '', __LINE__, __FILE__, $sql2);
                }
        }

        $template->assign_vars(array(
                'INFO_MESSAGE' => sprintf($lang['Deleted_user'], $delete))
        );
}

// sort part
$start = ( isset($_GET['start']) ) ? intval($_GET['start']) : 0;
if(isset($_POST['order']))
{
        $sort_order = ($_POST['order'] == 'ASC') ? 'ASC' : 'DESC';
}
else if(isset($_GET['order']))
{
        $sort_order = ($_GET['order'] == 'ASC') ? 'ASC' : 'DESC';
}
else
{
        $sort_order = 'ASC';
}
$mode_types_text = array($lang['Sort_Joined'],$lang['Sort_Username'],$lang['Sort_Email']);
$mode_types = array('joindate', 'username', 'email');

$select_sort_mode = '<select name="mode">';
for($i = 0; $i < count($mode_types_text); $i++)
{
        $selected = ( $mode == $mode_types[$i] ) ? ' selected="selected"' : '';
        $select_sort_mode .= '<option value="' . $mode_types[$i] . '"' . $selected . '>' . $mode_types_text[$i] . '</option>';
}
$select_sort_mode .= '</select>';

$select_sort_order = '<select name="order">';
if($sort_order == 'ASC')
{
        $select_sort_order .= '<option value="ASC" selected="selected">' . $lang['Sort_Ascending'] . '</option><option value="DESC">' . $lang['Sort_Descending'] . '</option>';
}
else
{
        $select_sort_order .= '<option value="ASC">' . $lang['Sort_Ascending'] . '</option><option value="DESC" selected="selected">' . $lang['Sort_Descending'] . '</option>';
}
$select_sort_order .= '</select>';

$template->set_filenames(array(
	'body' => 'admin/admin_account_body.tpl')
);

if ( $board_config['require_activation'] == USER_ACTIVATION_SELF )
{
        $l_activation = $lang['Acct_activation'].':<b> '.$lang['Acc_User'].'</b>';
}
else if ( $board_config['require_activation'] == USER_ACTIVATION_ADMIN )
{
        $l_activation = $lang['Acct_activation'].':<b> '.$lang['Acc_Admin'].'</b>';
}
else
{
        $l_activation = $lang['Acct_activation'].':<b> '.$lang['None'].'</b>';
}

$template->assign_vars(array(
        'L_ACTIVATION' => $l_activation,
        'L_NO_USERS' => $lang['No_users'],
        'L_SELECT_SORT_METHOD' => $lang['Select_sort_method'],
        'L_ACTIVATE' => $lang['Activate'],
        'L_DELETE' => $lang['Delete'],
        'L_ACCOUNT_ACTIONS' => $lang['Activate_title'],
        'L_ACTIONS' => $lang['Actions'],
        'L_USERNAME' => $lang['Username'],
        'L_EMAIL' => $lang['Email'],
        'L_DATE' => $lang['Reg_date'],
        'L_ORDER' => $lang['Order'],
        'L_SORT' => $lang['Sort'],
        'L_SUBMIT' => $lang['Sort'],
        'L_JOINED' => $lang['Joined'], 
        'L_POSTS' => $lang['Posts'], 
        'S_MODE_SELECT' => $select_sort_mode,
        'S_ORDER_SELECT' => $select_sort_order,
        'S_MODE_ACTION' => append_sid("admin_account.$phpEx"))
);

if ( isset($_GET['mode']) || isset($_POST['mode']) )
{
        $mode = ( isset($_POST['mode']) ) ? $_POST['mode'] : $_GET['mode'];
        switch( $mode )
        {
                case 'joindate':
                        $order_by = "user_regdate $sort_order LIMIT $start, " . $board_config['posts_per_page'];
                break;
                case 'username':
                        $order_by = "username $sort_order LIMIT $start, " . $board_config['posts_per_page'];
                break;
                case 'email':
                        $order_by = "user_email $sort_order LIMIT $start, " . $board_config['posts_per_page'];
                break;
                default:
                        $order_by = "user_regdate $sort_order LIMIT $start, " . $board_config['posts_per_page'];
                break;
        }
}
else
{
        $order_by = "user_regdate $sort_order LIMIT $start, " . $board_config['posts_per_page'];
}

//output
$sql = "SELECT username, user_id, user_actkey, user_regdate, user_email 
	FROM " . USERS_TABLE . "
	WHERE user_id <> " . ANONYMOUS . " AND user_active != '1'
	ORDER BY $order_by";
if( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Could not query users', '', __LINE__, __FILE__, $sql);
}

if ( $row = $db->sql_fetchrow($result) )
{
        $i = 0;
        do
        {
                $row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

                $email_uri = ( $board_config['board_email_form'] ) ? append_sid("../profile.$phpEx?mode=email&u=$row[user_id]") : 'mailto:' . $row['user_email'];
                $email = '<a href="' . $email_uri . '" class="gensmall">' . $row['user_email'] . '</a>';

                $waiting = max(1, round( ( time() - $row['user_regdate'] ) / 86400 ));
                $l_waiting = ( $waiting == 1 ) ? $lang['Waiting_1'] : $lang['Waiting_2'];

                $template->assign_block_vars('admin_account', array(
                        'ROW_NUMBER' => $i + ( $_GET['start'] + 1 ),
		'ROW_CLASS' => $row_class,
		'USERNAME' => $row['username'],
                        'U_PROFILE' => append_sid("../profile.$phpEx?mode=viewprofile&u=$row[user_id]"),
                        'EMAIL' => $email,
                        'REG_DATE' => create_date($board_config['default_dateformat'], $row['user_regdate'], $board_config['board_timezone']),
                        'WAITING' => sprintf($l_waiting, $waiting),
                        'U_DELETE' => append_sid("admin_account.$phpEx?delete=$row[user_id]"),
                        'U_ACTKEY' => append_sid("../profile.$phpEx?mode=activate&u=$row[user_id]&act_key=$row[user_actkey]"),
                ));
                $i++;
        }
        while ( $row = $db->sql_fetchrow($result) );
}

$sql = "SELECT * FROM ".USERS_TABLE." WHERE user_id <> " . ANONYMOUS . " AND user_active != '1'";
if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Could not get topic status.', '', __LINE__, __FILE__, $sql);
}
$row = $db->sql_fetchrow($result);
if ( $row )
{
        $template->assign_block_vars('there_are_users', array());
}
else
{
        $template->assign_block_vars('there_are_no_users', array());
}

$sql = "SELECT count(*) AS total FROM " . USERS_TABLE . " WHERE user_id <> " . ANONYMOUS . " AND user_active != '1'";
if ( !($result = $db->sql_query($sql)) )
{
        message_die(GENERAL_ERROR, 'Error getting total users', '', __LINE__, __FILE__, $sql);
}
if ( $total = $db->sql_fetchrow($result) )
{
        $total_members = $total['total'];
        $l_total_members = ( $total_members == 1 ) ? sprintf($lang['Total_member'], $total_members) : sprintf($lang['Total_members'], $total_members);
        $pagination = generate_pagination("admin_account.$phpEx?mode=$mode&amp;order=$sort_order", $total_members, $board_config['posts_per_page'], $start). '&nbsp;';
}

$template->assign_vars(array(
        'TOTAL' => $l_total_members,
        'PAGINATION' => $pagination,
        'PAGE_NUMBER' => sprintf($lang['Page_of'], ( floor( $start / $board_config['posts_per_page'] ) + 1 ), ceil( $total_members / $board_config['posts_per_page'] )), 
        'L_GOTO_PAGE' => $lang['Goto_page'])
);

$template->pparse("body");
include('page_footer_admin.'.$phpEx);
?>
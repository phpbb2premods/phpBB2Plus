<?php

//
// Set up for phpBB intergration.
//
define('IN_PHPBB', true);
$phpbb_root_path = './';

//
// phpBB related files
//

include_once( $phpbb_root_path . 'extension.inc' );
include_once( $phpbb_root_path . 'common.' . $phpEx );
include_once ($phpbb_root_path . 'includes/news.' . $phpEx );

//
// Start session management
//
$userdata = session_pagestart( $user_ip, PAGE_INDEX, $session_length );
init_userprefs( $userdata );

//
// End session management
//

include($phpbb_root_path . 'includes/page_header.'.$phpEx); 

//
// Check to see what mode we should operate in.
//
if( isset($_POST['mode']) || isset($_GET['mode']) )
{
  $mode = ( isset($_POST['mode']) ) ? $_POST['mode'] : $_GET['mode'];
}
else
{
  $mode = "";
}

$dir = @opendir($phpbb_root_path . $board_config['news_path'] );

if( !$dir )
{
   message_die(GENERAL_ERROR, "Couldn't find news images", "", __LINE__, __FILE__, "The news images were not found" );
}

while($file = @readdir($dir))
{
  if( !@is_dir($phpbb_root_path . $board_config['news_path'] . '/' . $file) )
  {
    $img_size = @getimagesize($phpbb_root_path . $board_config['news_path'] . '/' . $file);

    if( $img_size[0] && $img_size[1] )
    {
      $category_images[] = $file;
    }
  }
}

@closedir($dir);

if( is_array( $category_images ) )
{
  sort( $category_images );
}


  //
  // This is the main display of the page before the admin has selected
  // any options.
  //
  $data_access = new NewsDataAccess( $phpbb_root_path );
  $news_cats = $data_access->fetchCategories( );

  $template->set_filenames(array(
    "body" => "news_cats.tpl")
  );

  $template->assign_vars(array(
    'L_ACTION' => $lang['Action'],
    'L_NEWS_TITLE' => $lang['News_Editing_Utility'],
    'L_NEWS_TEXT' => $lang['News_Explain'],
    'L_DELETE' => $lang['Delete'],
    'L_EDIT' => $lang['Edit'],
    'L_NEWS_ADD' => $lang['Add_new_category'],
    'L_ICON' => $lang['Icon'],
    'L_CATEGORY' => $lang['Category'],
    'L_TOPICS' => $lang['Topics'],

    'S_HIDDEN_FIELDS' => $s_hidden_fields,
    'S_NEWS_ACTION' => append_sid("admin_news_cats.$phpEx"))
  );

  //
  // Loop throuh the rows of smilies setting block vars for the template.
  //
  for($i = 0; $i < count($news_cats); $i++)
  {
    
    $row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
    $row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

    $template->assign_block_vars("news_cats", array(
      'ROW_COLOR' => '#' . $row_color,
      'ROW_CLASS' => $row_class,

      'TOPIC_COUNT' => $news_cats[$i]['topic_count'],

      'CATEGORY_IMG' => $phpbb_root_path . $board_config['news_path'] . '/' . $news_cats[$i]['news_image'],
      'L_CATEGORY' => $news_cats[$i]['news_category'],

      'U_NEWS_EDIT' => append_sid("admin_news_cats.$phpEx?mode=edit&amp;id=" . $news_cats[$i]['news_id']),
      'U_NEWS_DELETE' => append_sid("admin_news_cats.$phpEx?mode=delete&amp;id=" . $news_cats[$i]['news_id']))
    );
  }

  //
  // Spit out the page.
  //
  $template->pparse("body");


//
// Page Footer
//
include($phpbb_root_path . 'includes/page_tail.'.$phpEx); 

?>

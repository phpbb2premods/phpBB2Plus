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

// Tell the template class which template to use.
$template->set_filenames( array( 'news' => 'news.tpl' ) );
    
$content =& new NewsModule( $phpbb_root_path );

$content->setVariables( array(
    'L_INDEX' => $lang['Index'],
    'L_CATEGORIES' => $lang['Categories'],
    'L_ARCHIVES' => $lang['Archives']
    ) );

if( (isset( $_GET['news']  ) && $_GET['news'] == 'categories') )
{
  // View the news categories.
  $content->setVariables( array( 'TITLE' => $lang['News'] . ' ' . $lang['Categories'] ) );
  $content->renderTopics( );
}
elseif( isset( $_GET['news']  ) && $_GET['news'] == 'archives' )
{
  // View the news Archives.
  $year   = (isset( $_GET['year'] )) ? $_GET['year'] : 0;
  $month  = (isset( $_GET['month'] )) ? $_GET['month'] : 0;
  $day    = (isset( $_GET['day'] )) ? $_GET['day'] : 0;
  $key    = (isset( $_GET['key'] )) ? $_GET['key'] : '';

  $content->setVariables( array( 'TITLE' => $lang['News'] . ' ' . $lang['Archives'] ) );
  $content->renderArchives( $year, $month, $day, $key );
}
else
{
  // View news articles.
  $topic_id = 0;
  if( isset( $_GET['topic_id'] ) )
  {
    $topic_id = $_GET['topic_id'];
  }
  elseif( isset( $_GET['news_id'] ) )
  {
    $topic_id = $_GET['news_id'];
  }

  $content->setVariables( array( 'TITLE' => $lang['News'] . ' ' . $lang['Articles'] ) );
  $content->renderArticles( $topic_id );
}

$content->renderPagination( );

$content->display( );
$content->clear( );

include($phpbb_root_path . 'includes/page_tail.'.$phpEx);
?>

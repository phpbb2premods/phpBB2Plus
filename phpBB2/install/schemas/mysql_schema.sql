#
# phpBB2 - MySQL schema
#
# $Id: mysql_schema.sql,v 1.35.2.7 2003/06/10 12:42:31 psotfx Exp $
#

#
# Table structure for table 'phpbb_auth_access'
#
CREATE TABLE phpbb_auth_access (
   group_id mediumint(8) default '0' NOT NULL,
   forum_id smallint(5) UNSIGNED default '0' NOT NULL,
   auth_view tinyint(1) default '0' NOT NULL,
   auth_read tinyint(1) default '0' NOT NULL,
   auth_post tinyint(1) default '0' NOT NULL,
   auth_reply tinyint(1) default '0' NOT NULL,
   auth_edit tinyint(1) default '0' NOT NULL,
   auth_delete tinyint(1) default '0' NOT NULL,
   auth_sticky tinyint(1) default '0' NOT NULL,
   auth_announce tinyint(1) default '0' NOT NULL,
   auth_global_announce tinyint(1) default '0' NOT NULL,
   auth_vote tinyint(1) default '0' NOT NULL,
   auth_pollcreate tinyint(1) default '0' NOT NULL,
   auth_attachments tinyint(1) default '0' NOT NULL,
   auth_mod tinyint(1) default '0' NOT NULL,
   auth_download tinyint(1) default '0' NOT NULL,
   auth_cal tinyint(1) default '0' NOT NULL,
   auth_news tinyint(1) default '0' NOT NULL,
   auth_ban tinyint(1) default '0' NOT NULL,
   auth_greencard tinyint(1) default '0' NOT NULL,
   auth_bluecard tinyint(1) default '0' NOT NULL,
   KEY group_id (group_id),
   KEY forum_id (forum_id)
) ;


#
# Table structure for table 'phpbb_user_group'
#
CREATE TABLE phpbb_user_group (
   group_id mediumint(8) default '0' NOT NULL,
   user_id mediumint(8) default '0' NOT NULL,
   user_pending tinyint(1),
   KEY group_id (group_id),
   KEY user_id (user_id)
) ;

#
# Table structure for table 'phpbb_groups'
#
CREATE TABLE phpbb_groups (
   group_id mediumint(8) NOT NULL auto_increment,
   group_type tinyint(4) default '1' NOT NULL,
   group_name varchar(40) NOT NULL,
   group_description varchar(255) NOT NULL,
   group_moderator mediumint(8) default '0' NOT NULL,
   group_single_user tinyint(1) default '1' NOT NULL,
   group_color_group mediumint UNSIGNED default '0' NOT NULL,
   PRIMARY KEY (group_id),
   KEY group_single_user (group_single_user)
) ;


# --------------------------------------------------------
#
# Table structure for table 'phpbb_banlist'
#
CREATE TABLE phpbb_banlist (
   ban_id mediumint(8) UNSIGNED NOT NULL auto_increment,
   ban_userid mediumint(8) NOT NULL,
   ban_ip char(8) NOT NULL,
   ban_email varchar(255),
   PRIMARY KEY (ban_id),
   KEY ban_ip_user_id (ban_ip, ban_userid)
) ;


# --------------------------------------------------------
#
# Table structure for table 'phpbb_categories'
#
CREATE TABLE phpbb_categories (
   cat_id mediumint(8) UNSIGNED NOT NULL auto_increment,
   cat_title varchar(100),
   cat_order mediumint(8) UNSIGNED NOT NULL,
   cat_main_type char(1),
   cat_main mediumint(8) UNSIGNED default '0' NOT NULL,
   cat_desc text default '' NOT NULL,
   icon varchar(255),
   PRIMARY KEY (cat_id),
   KEY cat_order (cat_order)
) ;


# --------------------------------------------------------
#
# Table structure for table 'phpbb_config'
#
CREATE TABLE phpbb_config (
    config_name varchar(255) NOT NULL,
    config_value varchar(255) NOT NULL,
    PRIMARY KEY (config_name)
) ;


# --------------------------------------------------------
#
# Table structure for table 'phpbb_confirm'
#
CREATE TABLE phpbb_confirm (
  confirm_id char(32) default '' NOT NULL,
  session_id char(32) default '' NOT NULL,
  code char(6) default '' NOT NULL, 
  PRIMARY KEY  (session_id,confirm_id)
) ;


# --------------------------------------------------------
#
# Table structure for table 'phpbb_disallow'
#
CREATE TABLE phpbb_disallow (
   disallow_id mediumint(8) UNSIGNED NOT NULL auto_increment,
   disallow_username varchar(25) default '' NOT NULL,
   PRIMARY KEY (disallow_id)
) ;


# --------------------------------------------------------
#
# Table structure for table 'phpbb_forum_prune'
#
CREATE TABLE phpbb_forum_prune (
   prune_id mediumint(8) UNSIGNED NOT NULL auto_increment,
   forum_id smallint(5) UNSIGNED NOT NULL,
   prune_days smallint(5) UNSIGNED NOT NULL,
   prune_freq smallint(5) UNSIGNED NOT NULL,
   PRIMARY KEY(prune_id),
   KEY forum_id (forum_id)
) ;


# --------------------------------------------------------
#
# Table structure for table 'phpbb_forums'
#
CREATE TABLE phpbb_forums (
   forum_id smallint(5) UNSIGNED NOT NULL,
   cat_id mediumint(8) UNSIGNED NOT NULL,
   forum_name varchar(150),
   forum_desc text,
   forum_status tinyint(4) default '0' NOT NULL,
   forum_order mediumint(8) UNSIGNED default '1' NOT NULL,
   forum_posts mediumint(8) UNSIGNED default '0' NOT NULL,
   forum_topics mediumint(8) UNSIGNED default '0' NOT NULL,
   forum_last_post_id mediumint(8) UNSIGNED default '0' NOT NULL,
   prune_next int(11),
   prune_enable tinyint(1) default '0' NOT NULL,
   auth_view tinyint(2) default '0' NOT NULL,
   auth_read tinyint(2) default '0' NOT NULL,
   auth_post tinyint(2) default '0' NOT NULL,
   auth_reply tinyint(2) default '0' NOT NULL,
   auth_edit tinyint(2) default '0' NOT NULL,
   auth_delete tinyint(2) default '0' NOT NULL,
   auth_sticky tinyint(2) default '0' NOT NULL,
   auth_announce tinyint(2) default '0' NOT NULL,
   auth_global_announce tinyint(2) default '0' NOT NULL,
   auth_vote tinyint(2) default '0' NOT NULL,
   auth_pollcreate tinyint(2) default '0' NOT NULL,
   auth_attachments tinyint(2) default '0' NOT NULL,
   forum_link varchar(255),
   forum_link_internal tinyint(1) default '0' NOT NULL,
   forum_link_hit_count tinyint(1) default '0' NOT NULL,
   forum_link_hit bigint(20) UNSIGNED default '0' NOT NULL,
   icon varchar(255) default NULL,
   main_type char(1) default NULL,
   auth_download tinyint(2) default '0' NOT NULL,
   auth_cal tinyint(2) default '0' NOT NULL,
   auth_news tinyint(2) default '2' NOT NULL,
   auth_ban tinyint(2) default '3' NOT NULL,
   auth_greencard tinyint(2) default '5' NOT NULL,
   auth_bluecard tinyint(2) default '1' NOT NULL,
   count_posts char(1) default '1' NOT NULL,
   PRIMARY KEY (forum_id),
   KEY forums_order (forum_order),
   KEY cat_id (cat_id),
   KEY forum_last_post_id (forum_last_post_id)
) ;


# --------------------------------------------------------
#
# Table structure for table 'phpbb_posts'
#
CREATE TABLE phpbb_posts (
   post_id mediumint(8) UNSIGNED NOT NULL auto_increment,
   topic_id mediumint(8) UNSIGNED default '0' NOT NULL,
   forum_id smallint(5) UNSIGNED default '0' NOT NULL,
   poster_id mediumint(8) default '0' NOT NULL,
   post_time int(11) default '0' NOT NULL,
   poster_ip char(8) NOT NULL,
   post_username varchar(25),
   enable_bbcode tinyint(1) default '1' NOT NULL,
   enable_html tinyint(1) default '0' NOT NULL,
   enable_smilies tinyint(1) default '1' NOT NULL,
   enable_sig tinyint(1) default '1' NOT NULL,
   post_edit_time int(11),
   post_edit_count smallint(5) UNSIGNED default '0' NOT NULL,
   post_attachment tinyint(1) default '0' NOT NULL,
   post_icon tinyint(2),
   post_bluecard tinyint(1),
   PRIMARY KEY (post_id),
   KEY forum_id (forum_id),
   KEY topic_id (topic_id),
   KEY poster_id (poster_id),
   KEY post_time (post_time),
   KEY post_icon (post_icon)
) ;


# --------------------------------------------------------
#
# Table structure for table 'phpbb_posts_text'
#
CREATE TABLE phpbb_posts_text (
   post_id mediumint(8) UNSIGNED default '0' NOT NULL,
   bbcode_uid char(10) default '' NOT NULL,
   post_subject char(60),
   post_text text,
   PRIMARY KEY (post_id)
) ;


# --------------------------------------------------------
#
# Table structure for table 'phpbb_privmsgs'
#
CREATE TABLE phpbb_privmsgs (
   privmsgs_id mediumint(8) UNSIGNED NOT NULL auto_increment,
   privmsgs_type tinyint(4) default '0' NOT NULL,
   privmsgs_subject varchar(255) default '0' NOT NULL,
   privmsgs_from_userid mediumint(8) default '0' NOT NULL,
   privmsgs_to_userid mediumint(8) default '0' NOT NULL,
   privmsgs_date int(11) default '0' NOT NULL,
   privmsgs_ip char(8) NOT NULL,
   privmsgs_enable_bbcode tinyint(1) default '1' NOT NULL,
   privmsgs_enable_html tinyint(1) default '0' NOT NULL,
   privmsgs_enable_smilies tinyint(1) default '1' NOT NULL,
   privmsgs_attach_sig tinyint(1) default '1' NOT NULL,
   privmsgs_attachment tinyint(1) default '0' NOT NULL,
   PRIMARY KEY (privmsgs_id),
   KEY privmsgs_from_userid (privmsgs_from_userid),
   KEY privmsgs_to_userid (privmsgs_to_userid)
) ;


# --------------------------------------------------------
#
# Table structure for table 'phpbb_privmsgs_text'
#
CREATE TABLE phpbb_privmsgs_text (
   privmsgs_text_id mediumint(8) UNSIGNED default '0' NOT NULL,
   privmsgs_bbcode_uid char(10) default '0' NOT NULL,
   privmsgs_text text,
   PRIMARY KEY (privmsgs_text_id)
) ;


# --------------------------------------------------------
#
# Table structure for table 'phpbb_ranks'
#
CREATE TABLE phpbb_ranks (
   rank_id smallint(5) UNSIGNED NOT NULL auto_increment,
   rank_title varchar(50) NOT NULL,
   rank_min mediumint(8) default '0' NOT NULL,
   rank_special tinyint(1) default '0',
   rank_image varchar(255),
   PRIMARY KEY (rank_id)
) ;


# --------------------------------------------------------
#
# Table structure for table `phpbb_search_results`
#
CREATE TABLE phpbb_search_results (
  search_id int(11) UNSIGNED NOT NULL default '0',
  session_id char(32) NOT NULL default '',
  search_time int(11) DEFAULT '0' NOT NULL,
  search_array mediumtext NOT NULL,
  PRIMARY KEY  (search_id),
  KEY session_id (session_id)
) ;


# --------------------------------------------------------
#
# Table structure for table `phpbb_search_wordlist`
#
CREATE TABLE phpbb_search_wordlist (
  word_text varchar(50) binary NOT NULL default '',
  word_id mediumint(8) UNSIGNED NOT NULL auto_increment,
  word_common tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY (word_text),
  KEY word_id (word_id)
) ;

# --------------------------------------------------------
#
# Table structure for table `phpbb_search_wordmatch`
#
CREATE TABLE phpbb_search_wordmatch (
  post_id mediumint(8) UNSIGNED NOT NULL default '0',
  word_id mediumint(8) UNSIGNED NOT NULL default '0',
  title_match tinyint(1) NOT NULL default '0',
  KEY post_id (post_id),
  KEY word_id (word_id)
) ;


# --------------------------------------------------------
#
# Table structure for table 'phpbb_sessions'
#
# Note that if you're running 3.23.x you may want to make
# this table a type HEAP. This type of table is stored
# within system memory and therefore for big busy boards
# is likely to be noticeably faster than continually
# writing to disk ...
#
CREATE TABLE phpbb_sessions (
   session_id char(32) default '' NOT NULL,
   session_user_id mediumint(8) default '0' NOT NULL,
   session_start int(11) default '0' NOT NULL,
   session_time int(11) default '0' NOT NULL,
   session_ip char(8) default '0' NOT NULL,
   session_page int(11) default '0' NOT NULL,
   session_topic int(11) default '0' NOT NULL,
   session_logged_in tinyint(1) default '0' NOT NULL,
   session_admin tinyint(2) default '0' NOT NULL, 
   PRIMARY KEY (session_id),
   KEY session_user_id (session_user_id),
   KEY session_id_ip_user_id (session_id, session_ip, session_user_id)
) ;

# --------------------------------------------------------
#
# Table structure for table `phpbb_sessions_keys`
#
CREATE TABLE phpbb_sessions_keys (
  key_id varchar(32) default '0' NOT NULL,
  user_id mediumint(8) default '0' NOT NULL,
  last_ip varchar(8) default '0' NOT NULL,
  last_login int(11) default '0' NOT NULL,
  PRIMARY KEY (key_id, user_id),
  KEY last_login (last_login)
) ;


# --------------------------------------------------------
#
# Table structure for table 'phpbb_smilies'
#
CREATE TABLE phpbb_smilies (
   smilies_id smallint(5) UNSIGNED NOT NULL auto_increment,
   code varchar(50),
   smile_url varchar(100),
   emoticon varchar(75),
   PRIMARY KEY (smilies_id)
) ;


# --------------------------------------------------------
#
# Table structure for table 'phpbb_themes'
#
CREATE TABLE phpbb_themes (
   themes_id mediumint(8) UNSIGNED NOT NULL auto_increment,
   template_name varchar(30) NOT NULL default '',
   style_name varchar(30) NOT NULL default '',
   head_stylesheet varchar(100) default NULL,
   body_background varchar(100) default NULL,
   body_bgcolor varchar(6) default NULL,
   body_text varchar(6) default NULL,
   body_link varchar(6) default NULL,
   body_vlink varchar(6) default NULL,
   body_alink varchar(6) default NULL,
   body_hlink varchar(6) default NULL,
   tr_color1 varchar(6) default NULL,
   tr_color2 varchar(6) default NULL,
   tr_color3 varchar(6) default NULL,
   tr_class1 varchar(25) default NULL,
   tr_class2 varchar(25) default NULL,
   tr_class3 varchar(25) default NULL,
   th_color1 varchar(6) default NULL,
   th_color2 varchar(6) default NULL,
   th_color3 varchar(6) default NULL,
   th_class1 varchar(25) default NULL,
   th_class2 varchar(25) default NULL,
   th_class3 varchar(25) default NULL,
   td_color1 varchar(6) default NULL,
   td_color2 varchar(6) default NULL,
   td_color3 varchar(6) default NULL,
   td_class1 varchar(25) default NULL,
   td_class2 varchar(25) default NULL,
   td_class3 varchar(25) default NULL,
   fontface1 varchar(50) default NULL,
   fontface2 varchar(50) default NULL,
   fontface3 varchar(50) default NULL,
   fontsize1 tinyint(4) default NULL,
   fontsize2 tinyint(4) default NULL,
   fontsize3 tinyint(4) default NULL,
   fontcolor1 varchar(6) default NULL,
   fontcolor2 varchar(6) default NULL,
   fontcolor3 varchar(6) default NULL,
   span_class1 varchar(25) default NULL,
   span_class2 varchar(25) default NULL,
   span_class3 varchar(25) default NULL,
   img_size_poll smallint(5) UNSIGNED,
   img_size_privmsg smallint(5) UNSIGNED,
   PRIMARY KEY  (themes_id)
) ;


# --------------------------------------------------------
#
# Table structure for table 'phpbb_themes_name'
#
CREATE TABLE phpbb_themes_name (
   themes_id smallint(5) UNSIGNED default '0' NOT NULL,
   tr_color1_name char(50),
   tr_color2_name char(50),
   tr_color3_name char(50),
   tr_class1_name char(50),
   tr_class2_name char(50),
   tr_class3_name char(50),
   th_color1_name char(50),
   th_color2_name char(50),
   th_color3_name char(50),
   th_class1_name char(50),
   th_class2_name char(50),
   th_class3_name char(50),
   td_color1_name char(50),
   td_color2_name char(50),
   td_color3_name char(50),
   td_class1_name char(50),
   td_class2_name char(50),
   td_class3_name char(50),
   fontface1_name char(50),
   fontface2_name char(50),
   fontface3_name char(50),
   fontsize1_name char(50),
   fontsize2_name char(50),
   fontsize3_name char(50),
   fontcolor1_name char(50),
   fontcolor2_name char(50),
   fontcolor3_name char(50),
   span_class1_name char(50),
   span_class2_name char(50),
   span_class3_name char(50),
   PRIMARY KEY (themes_id)
) ;


# --------------------------------------------------------
#
# Table structure for table 'phpbb_topics'
#
CREATE TABLE phpbb_topics (
   topic_id mediumint(8) UNSIGNED NOT NULL auto_increment,
   forum_id smallint(8) UNSIGNED default '0' NOT NULL,
   topic_title varchar(60) NOT NULL,
   topic_desc varchar(255) default '',
   topic_poster mediumint(8) default '0' NOT NULL,
   topic_time int(11) default '0' NOT NULL,
   topic_views mediumint(8) UNSIGNED default '0' NOT NULL,
   topic_replies mediumint(8) UNSIGNED default '0' NOT NULL,
   topic_status tinyint(3) default '0' NOT NULL,
   topic_vote tinyint(1) default '0' NOT NULL,
   topic_type tinyint(3) default '0' NOT NULL,
   topic_first_post_id mediumint(8) UNSIGNED default '0' NOT NULL,
   topic_last_post_id mediumint(8) UNSIGNED default '0' NOT NULL,
   topic_moved_id mediumint(8) UNSIGNED default '0' NOT NULL,
   topic_attachment tinyint(1) default '0' NOT NULL,
   topic_icon tinyint(2),
   topic_calendar_time int(11),
   topic_calendar_duration int(11),
   topic_announce_duration mediumint(5) default '0' NOT NULL,
   news_id int UNSIGNED default '0' NOT NULL,

   PRIMARY KEY (topic_id),
   KEY forum_id (forum_id),
   KEY topic_moved_id (topic_moved_id),
   KEY topic_status (topic_status),
   KEY topic_type (topic_type),
   KEY topic_calendar_time (topic_calendar_time),
   KEY news_id (news_id)
) ;


# --------------------------------------------------------
#
# Table structure for table 'phpbb_topics_watch'
#
CREATE TABLE phpbb_topics_watch (
  topic_id mediumint(8) UNSIGNED NOT NULL default '0',
  user_id mediumint(8) NOT NULL default '0',
  notify_status tinyint(1) NOT NULL default '0',
  KEY topic_id (topic_id),
  KEY user_id (user_id),
  KEY notify_status (notify_status)
) ;


# --------------------------------------------------------
#
# Table structure for table 'phpbb_users'
#
CREATE TABLE phpbb_users (
   user_id mediumint(8) NOT NULL,
   user_active tinyint(1) default '1',
   username varchar(25) NOT NULL,
   user_password varchar(32) NOT NULL,
   user_session_time int(11) default '0' NOT NULL,
   user_session_page smallint(5) default '0' NOT NULL,
   user_session_topic int(11) default '0' NOT NULL,
   user_lastvisit int(11) default '0' NOT NULL,
   user_regdate int(11) default '0' NOT NULL,
   user_level tinyint(4) default '0',
   user_posts mediumint(8) UNSIGNED default '0' NOT NULL,
   user_timezone decimal(5,2) default '0' NOT NULL,
   user_style tinyint(4),
   user_lang varchar(255),
   user_dateformat varchar(14) default 'd M Y H:i' NOT NULL,
   user_new_privmsg smallint(5) UNSIGNED default '0' NOT NULL,
   user_unread_privmsg smallint(5) UNSIGNED default '0' NOT NULL,
   user_last_privmsg int(11) default '0' NOT NULL,
   user_login_tries smallint(5) UNSIGNED default '0' NOT NULL,
   user_last_login_try int(11) default '0' NOT NULL,
   user_emailtime int(11),
   user_viewemail tinyint(1),
   user_attachsig tinyint(1),
   user_setbm tinyint(1) NOT NULL default '0',
   user_allowhtml tinyint(1) default '1',
   user_allowbbcode tinyint(1) default '1',
   user_allowsmile tinyint(1) default '1',
   user_allowavatar tinyint(1) default '1' NOT NULL,
   user_allow_pm tinyint(1) default '1' NOT NULL,
   user_allow_viewonline tinyint(1) default '1' NOT NULL,
   user_notify tinyint(1) default '1' NOT NULL,
   user_notify_pm tinyint(1) default '0' NOT NULL,
   user_popup_pm tinyint(1) default '0' NOT NULL,
   user_rank int(11) default '0',
   user_avatar varchar(100),
   user_avatar_type tinyint(4) default '0' NOT NULL,
   user_email varchar(255),
   user_icq varchar(15),
   user_website varchar(100),
   user_from varchar(100),
   user_from_flag varchar(25) NULL,
   user_sig text,
   user_sig_bbcode_uid char(10),
   user_aim varchar(255),
   user_yim varchar(255),
   user_msnm varchar(255),
   user_occ varchar(100),
   user_interests varchar(255),
   user_actkey varchar(32),
   user_newpasswd varchar(32),
   ct_postcount varchar(10) default '0' NOT NULL,
   ct_posttime varchar(10) default '0' NOT NULL,
   ct_searchcount varchar(10) default '0' NOT NULL,
   ct_searchtime varchar(10) default '0' NOT NULL,
   ct_mailcount int( 10 ) default '0' NOT NULL,
   ct_pwreset int( 2 ) default '0' NOT NULL,
   ct_unsucclogin int( 10 ) default NULL,
   ct_logintry int( 2 ) default '0' NOT NULL,
   user_sub_forum tinyint(1) default '1' NOT NULL,
   user_split_cat tinyint(1) default '1' NOT NULL,
   user_last_topic_title tinyint(1) default '1' NOT NULL,
   user_sub_level_links tinyint(1) default '2' NOT NULL,
   user_display_viewonline tinyint(1) default '2' NOT NULL,
   user_birthday int default '999999' NOT NULL,
   user_next_birthday_greeting int default '0' NOT NULL,
   user_gender tinyint NOT NULL default '0',
   user_color_group mediumint UNSIGNED default '0' NOT NULL,
   user_lastlogon int(11) default '0' NOT NULL,
   user_totaltime int(11) default '0',
   user_totallogon int(11) default '0',
   user_totalpages int(11) default '0',
   user_calendar_display_open tinyint(1) default '0' NOT NULL,
   user_calendar_header_cells tinyint(1) default '7' NOT NULL,
   user_calendar_week_start tinyint(1) default '1' NOT NULL,
   user_calendar_nb_row tinyint(2) UNSIGNED default '5' NOT NULL,
   user_calendar_birthday tinyint(1) default '1' NOT NULL,
   user_calendar_forum tinyint(1) default '1' NOT NULL,
   user_warnings smallint(5) default '0',
   user_passwd_change int(11) default '0' NOT NULL,
   user_badlogin smallint(5) default '0' NOT NULL,
   user_blocktime int(11) default '0' NOT NULL,
   user_block_by varchar(8),
   user_split_global_announce tinyint(1) default '1' NOT NULL,
   user_split_announce tinyint(1) default '1' NOT NULL,
   user_split_sticky tinyint(1) default '1' NOT NULL,
   user_split_news tinyint(1) default '1' NOT NULL,
   user_split_topic_split tinyint(1) default '0' NOT NULL,
   user_absence tinyint(1) default '0' NOT NULL,
   user_absence_mode mediumint(8) default '0' NOT NULL,
   user_absence_text text default '' NOT NULL,
   user_announcement_date_display tinyint(1) default '1' NOT NULL,
   user_announcement_display tinyint(1) default '1' NOT NULL,
   user_announcement_display_forum tinyint(1) default '1' NOT NULL,
   user_announcement_split tinyint(1) default '1' NOT NULL,
   user_announcement_forum tinyint(1) default '1' NOT NULL,
   user_use_ajax_preview tinyint(1) default '1' NOT NULL,
   user_use_ajax_edit tinyint(1) default '1' NOT NULL,
   PRIMARY KEY (user_id),
   KEY user_session_time (user_session_time)
) ;

# --------------------------------------------------------
#
# Table structure for table 'phpbb_vote_desc'
#
CREATE TABLE phpbb_vote_desc (
  vote_id mediumint(8) UNSIGNED NOT NULL auto_increment,
  topic_id mediumint(8) UNSIGNED NOT NULL default '0',
  vote_text text NOT NULL,
  vote_start int(11) NOT NULL default '0',
  vote_length int(11) NOT NULL default '0',
  PRIMARY KEY  (vote_id),
  KEY topic_id (topic_id)
) ;


# --------------------------------------------------------
#
# Table structure for table 'phpbb_vote_results'
#
CREATE TABLE phpbb_vote_results (
  vote_id mediumint(8) UNSIGNED NOT NULL default '0',
  vote_option_id tinyint(4) UNSIGNED NOT NULL default '0',
  vote_option_text varchar(255) NOT NULL,
  vote_result int(11) NOT NULL default '0',
  KEY vote_option_id (vote_option_id),
  KEY vote_id (vote_id)
) ;


# --------------------------------------------------------
#
# Table structure for table 'phpbb_vote_voters'
#
CREATE TABLE phpbb_vote_voters (
  vote_id mediumint(8) UNSIGNED NOT NULL default '0',
  vote_user_id mediumint(8) NOT NULL default '0',
  vote_user_ip char(8) NOT NULL,
  KEY vote_id (vote_id),
  KEY vote_user_id (vote_user_id),
  KEY vote_user_ip (vote_user_ip)
) ;


# --------------------------------------------------------
#
# Table structure for table 'phpbb_words'
#
CREATE TABLE phpbb_words (
   word_id mediumint(8) UNSIGNED NOT NULL auto_increment,
   word char(100) NOT NULL,
   replacement char(100) NOT NULL,
   PRIMARY KEY (word_id)
) ;

CREATE TABLE phpbb_attachments_config (
  config_name varchar(255) NOT NULL,
  config_value varchar(255) NOT NULL,
  PRIMARY KEY (config_name)
) ;

#
# Table structure for table 'phpbb_forbidden_extensions'
#
CREATE TABLE phpbb_forbidden_extensions (
  ext_id mediumint(8) UNSIGNED NOT NULL auto_increment, 
  extension varchar(100) NOT NULL, 
  PRIMARY KEY (ext_id)
) ;

#
# Table structure for table 'phpbb_extension_groups'
#
CREATE TABLE phpbb_extension_groups (
  group_id mediumint(8) NOT NULL auto_increment,
  group_name char(20) NOT NULL,
  cat_id tinyint(2) default '0' NOT NULL, 
  allow_group tinyint(1) default '0' NOT NULL,
  download_mode tinyint(1) UNSIGNED default '1' NOT NULL,
  upload_icon varchar(100) default '',
  max_filesize int(20) default '0' NOT NULL,
  forum_permissions varchar(255) default '' NOT NULL,
  PRIMARY KEY group_id (group_id)
) ;

#
# Table structure for table 'phpbb_extensions'
#
CREATE TABLE phpbb_extensions (
  ext_id mediumint(8) UNSIGNED NOT NULL auto_increment,
  group_id mediumint(8) UNSIGNED default '0' NOT NULL,
  extension varchar(100) NOT NULL,
  comment varchar(100),
  PRIMARY KEY ext_id (ext_id)
) ;

#
# Table structure for table 'phpbb_attachments_desc'
#
CREATE TABLE phpbb_attachments_desc (
  attach_id mediumint(8) UNSIGNED NOT NULL auto_increment,
  physical_filename varchar(255) NOT NULL,
  real_filename varchar(255) NOT NULL,
  download_count mediumint(8) UNSIGNED default '0' NOT NULL,
  comment varchar(255),
  extension varchar(100),
  mimetype varchar(100),
  filesize int(20) NOT NULL,
  filetime int(11) default '0' NOT NULL,
  thumbnail tinyint(1) default '0' NOT NULL,
  PRIMARY KEY (attach_id),
  KEY filetime (filetime),
  KEY physical_filename (physical_filename(10)),
  KEY filesize (filesize)
) ;

#
# Table structure for table 'phpbb_attachments'
#
CREATE TABLE phpbb_attachments (
  attach_id mediumint(8) UNSIGNED default '0' NOT NULL, 
  post_id mediumint(8) UNSIGNED default '0' NOT NULL, 
  privmsgs_id mediumint(8) UNSIGNED default '0' NOT NULL,
  user_id_1 mediumint(8) NOT NULL,
  user_id_2 mediumint(8) NOT NULL,
  KEY attach_id_post_id (attach_id, post_id),
  KEY attach_id_privmsgs_id (attach_id, privmsgs_id),
  KEY post_id (post_id),
  KEY privmsgs_id (privmsgs_id)
) ; 

#
# Table structure for table 'phpbb_quota_limits'
#
CREATE TABLE phpbb_quota_limits (
  quota_limit_id mediumint(8) unsigned NOT NULL auto_increment,
  quota_desc varchar(20) NOT NULL default '',
  quota_limit bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY  (quota_limit_id)
) ;

#
# Table structure for table 'phpbb_attach_quota'
#
CREATE TABLE phpbb_attach_quota (
  user_id mediumint(8) unsigned NOT NULL default '0',
  group_id mediumint(8) unsigned NOT NULL default '0',
  quota_type smallint(2) NOT NULL default '0',
  quota_limit_id mediumint(8) unsigned NOT NULL default '0',
  KEY quota_type (quota_type)
) ; 

CREATE TABLE phpbb_jr_admin_users (
  user_id mediumint(9) NOT NULL default '0',
  user_jr_admin longtext NOT NULL,
  start_date int(10) unsigned NOT NULL default '0',
  update_date int(10) unsigned NOT NULL default '0',
  admin_notes text NOT NULL,
  notes_view tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (user_id)
) ;

CREATE TABLE phpbb_color_groups (
  group_id mediumint(8) unsigned NOT NULL auto_increment,
  group_name varchar(255) NOT NULL default '',
  group_color varchar(50) NOT NULL default '',
  hidden tinyint(1) default '0' NOT NULL,
  order_num mediumint NOT NULL,
  PRIMARY KEY  (group_id),
  UNIQUE KEY group_name (group_name)
) ;

CREATE TABLE phpbb_flags (
   flag_id int(10) NOT NULL auto_increment,
   flag_name varchar(25),
   flag_image varchar(25),
   PRIMARY KEY (flag_id)
) ;

CREATE TABLE phpbb_anti_robotic_reg (
   session_id char(32) default '' NOT NULL,
   reg_key char(5) NOT NULL,
   timestamp int(11) unsigned NOT NULL,
   PRIMARY KEY (session_id)
) ;

CREATE TABLE phpbb_pa_cat (
  cat_id int(10) NOT NULL auto_increment,
  cat_name text,
  cat_desc text,
  cat_parent int(50) default NULL,
  parents_data text NOT NULL,
  cat_order int(50) default NULL,
  cat_allow_file tinyint(2) NOT NULL default '0',
  cat_allow_ratings tinyint(2) NOT NULL default '1',
  cat_allow_comments tinyint(2) NOT NULL default '1',
  cat_files mediumint(8) NOT NULL default '-1',
  cat_last_file_id mediumint(8) unsigned NOT NULL default '0',
  cat_last_file_name varchar(255) NOT NULL default '',
  cat_last_file_time int(50) UNSIGNED default '0' NOT NULL,
  auth_view tinyint(2) NOT NULL default '0',
  auth_read tinyint(2) NOT NULL default '0',
  auth_view_file tinyint(2) NOT NULL default '0',
  auth_edit_file tinyint(1) NOT NULL default '0',
  auth_delete_file tinyint(1) NOT NULL default '0',
  auth_upload tinyint(2) NOT NULL default '0',
  auth_download tinyint(2) NOT NULL default '0',
  auth_rate tinyint(2) NOT NULL default '0',
  auth_email tinyint(2) NOT NULL default '0',
  auth_view_comment tinyint(2) NOT NULL default '0',
  auth_post_comment tinyint(2) NOT NULL default '0',
  auth_edit_comment tinyint(2) NOT NULL default '0',
  auth_delete_comment tinyint(2) NOT NULL default '0',
  PRIMARY KEY  (cat_id)
) ;

CREATE TABLE phpbb_pa_auth (
   group_id mediumint(8) default '0' NOT NULL,
   cat_id smallint(5) UNSIGNED default '0' NOT NULL,
   auth_view tinyint(1) default '0' NOT NULL,
   auth_read tinyint(1) default '0' NOT NULL,
   auth_view_file tinyint(1) default '0' NOT NULL,
   auth_edit_file tinyint(1) default '0' NOT NULL,
   auth_delete_file tinyint(1) default '0' NOT NULL,
   auth_upload tinyint(1) default '0' NOT NULL,
   auth_download tinyint(1) default '0' NOT NULL,
   auth_rate tinyint(1) default '0' NOT NULL,
   auth_email tinyint(1) default '0' NOT NULL,
   auth_view_comment tinyint(1) default '0' NOT NULL,
   auth_post_comment tinyint(1) default '0' NOT NULL,
   auth_edit_comment tinyint(1) default '0' NOT NULL,
   auth_delete_comment tinyint(1) default '0' NOT NULL,
   auth_mod tinyint(1) default '0' NOT NULL,
   auth_search tinyint(1) default '1' NOT NULL,
   auth_stats tinyint(1) default '1' NOT NULL,
   auth_toplist tinyint(1) default '1' NOT NULL,
   auth_viewall tinyint(1) default '1' NOT NULL,
   KEY group_id (group_id),
   KEY cat_id (cat_id)
) ;

CREATE TABLE phpbb_pa_comments (
  comments_id int(10) NOT NULL auto_increment,
  file_id int(10) NOT NULL default '0',
  comments_text text NOT NULL,
  comments_title text NOT NULL,
  comments_time int(50) NOT NULL default '0',
  comment_bbcode_uid varchar(10) default NULL,
  poster_id mediumint(8) NOT NULL default '0',
  PRIMARY KEY  (comments_id),
  KEY comments_id (comments_id)
) ;

CREATE TABLE phpbb_pa_config (
  config_name varchar(255) NOT NULL default '',
  config_value varchar(255) NOT NULL default '',
  PRIMARY KEY  (config_name)
) ;

CREATE TABLE phpbb_pa_custom (
  custom_id int(50) NOT NULL auto_increment,
  custom_name text NOT NULL,
  custom_description text NOT NULL,
  data text NOT NULL,
  field_order int(20) NOT NULL default '0',
  field_type tinyint(2) NOT NULL default '0',
  regex varchar(255) NOT NULL default '',
  PRIMARY KEY  (custom_id)
) ;

CREATE TABLE phpbb_pa_customdata (
  customdata_file int(50) NOT NULL default '0',
  customdata_custom int(50) NOT NULL default '0',
  data text NOT NULL
) ;

CREATE TABLE phpbb_pa_download_info (
  file_id mediumint(8) NOT NULL default '0',
  user_id mediumint(8) NOT NULL default '0',
  downloader_ip varchar(8) NOT NULL default '',
  downloader_os varchar(255) NOT NULL default '',
  downloader_browser varchar(255) NOT NULL default '',
  browser_version varchar(255) NOT NULL default ''
) ;

CREATE TABLE phpbb_pa_files (
  file_id int(10) NOT NULL auto_increment,
  user_id mediumint(8) NOT NULL default '0',
  poster_ip varchar(8) NOT NULL default '',
  file_name text,
  file_size int(20) NOT NULL default '0',
  unique_name varchar(255) NOT NULL default '',
  real_name varchar(255) NOT NULL,
  file_dir varchar(255) NOT NULL,
  file_desc text,
  file_creator text,
  file_version text,
  file_longdesc text,
  file_ssurl text,
  file_sshot_link tinyint(2) NOT NULL default '0',
  file_dlurl text,
  file_time int(50) default NULL,
  file_update_time int(50) NOT NULL default '0',
  file_catid int(10) default NULL,
  file_posticon text,
  file_license int(10) default NULL,
  file_dls int(10) default NULL,
  file_last int(50) default NULL,
  file_pin int(2) default NULL,
  file_docsurl text,
  file_approved tinyint(1) default '1' NOT NULL,
  file_broken tinyint(1) default '0' NOT NULL,
  PRIMARY KEY  (file_id)
) ;

CREATE TABLE phpbb_pa_license (
  license_id int(10) NOT NULL auto_increment,
  license_name text,
  license_text text,
  PRIMARY KEY  (license_id)
) ;

CREATE TABLE phpbb_pa_mirrors (
  mirror_id mediumint(8) NOT NULL auto_increment, 
  file_id int(10) NOT NULL,
  unique_name varchar(255) NOT NULL default '',
  file_dir varchar(255) NOT NULL, 
  file_dlurl varchar(255) NOT NULL default '',
  mirror_location varchar(255) NOT NULL default '',
  PRIMARY KEY  (mirror_id),
  KEY file_id (file_id)
) ;

CREATE TABLE phpbb_pa_votes (
  user_id mediumint(8) NOT NULL default '0',
  votes_ip varchar(50) NOT NULL default '0',
  votes_file int(50) NOT NULL default '0',
  rate_point tinyint(3) unsigned NOT NULL default '0',
  voter_os varchar(255) NOT NULL default '',
  voter_browser varchar(255) NOT NULL default '',
  browser_version varchar(8) NOT NULL default '',
  KEY user_id (user_id)
) ;

CREATE TABLE phpbb_album (
	pic_id int(11) UNSIGNED NOT NULL auto_increment,
	pic_filename varchar(255) NOT NULL,
	pic_thumbnail varchar(255),
	pic_title varchar(255) NOT NULL,
	pic_desc text,
	pic_user_id mediumint(8) NOT NULL,
	pic_username varchar(32),
	pic_user_ip char(8) NOT NULL default '0',
	pic_time int(11) UNSIGNED NOT NULL,
	pic_cat_id mediumint(8) UNSIGNED NOT NULL default '1',
	pic_view_count int(11) UNSIGNED NOT NULL default '0',
	pic_lock tinyint(3) NOT NULL default '0',
	pic_approval tinyint(3) NOT NULL default '1',
	PRIMARY KEY (pic_id),
	KEY pic_cat_id (pic_cat_id),
	KEY pic_user_id (pic_user_id),
	KEY pic_time (pic_time)
) ;

CREATE TABLE phpbb_album_rate (
	rate_pic_id int(11) UNSIGNED NOT NULL,
	rate_user_id mediumint(8) NOT NULL,
	rate_user_ip char(8) NOT NULL,
	rate_point tinyint(3) UNSIGNED NOT NULL,
	rate_hon_point tinyint(3) default '0' NOT NULL,
	KEY rate_pic_id (rate_pic_id),
	KEY rate_user_id (rate_user_id),
	KEY rate_user_ip (rate_user_ip),
	KEY rate_point (rate_point)
) ;

CREATE TABLE phpbb_album_comment (
	comment_id int(11) UNSIGNED NOT NULL auto_increment,
	comment_pic_id int(11) UNSIGNED NOT NULL,
	comment_cat_id int(11) NOT NULL,
	comment_user_id mediumint(8) NOT NULL,
	comment_username varchar(32),
	comment_user_ip char(8) NOT NULL,
	comment_time int(11) UNSIGNED NOT NULL,
	comment_text text,
	comment_edit_time int(11) UNSIGNED,
	comment_edit_count smallint(5) UNSIGNED NOT NULL default '0',
	comment_edit_user_id mediumint(8),
	PRIMARY KEY(comment_id),
	KEY comment_pic_id (comment_pic_id),
	KEY comment_user_id (comment_user_id),
	KEY comment_user_ip (comment_user_ip),
	KEY comment_time (comment_time)
) ;

CREATE TABLE phpbb_album_cat (
	cat_id mediumint(8) UNSIGNED NOT NULL auto_increment,
	cat_title varchar(255) NOT NULL,
	cat_desc text,
	cat_order mediumint(8) NOT NULL,
	cat_view_level tinyint(3) NOT NULL default '-1',
	cat_upload_level tinyint(3) NOT NULL default '0',
	cat_rate_level tinyint(3) NOT NULL default '0',
	cat_comment_level tinyint(3) NOT NULL default '0',
	cat_edit_level tinyint(3) NOT NULL default '0',
	cat_delete_level tinyint(3) NOT NULL default '2',
	cat_view_groups varchar(255),
	cat_upload_groups varchar(255),
	cat_rate_groups varchar(255),
	cat_comment_groups varchar(255),
	cat_edit_groups varchar(255),
	cat_delete_groups varchar(255),
	cat_moderator_groups varchar(255),
	cat_approval tinyint(3) NOT NULL default '0',
	cat_parent mediumint(8) UNSIGNED default '0' NULL,
	cat_user_id mediumint(8)UNSIGNED default '0' NULL,
	PRIMARY KEY (cat_id),
	KEY cat_order (cat_order)
) ;

CREATE TABLE phpbb_album_config (
	config_name varchar(255) NOT NULL,
	config_value varchar(255) NOT NULL,
	PRIMARY KEY (config_name)) ;

CREATE TABLE phpbb_plus (
  config_name varchar(255) NOT NULL default '',
  config_value varchar(255) NOT NULL default '',
  PRIMARY KEY  (config_name)
) ;
CREATE TABLE phpbb_bookmarks (
  topic_id mediumint(8) unsigned NOT NULL default '0',
  user_id mediumint(8) NOT NULL default '0',
  KEY topic_id (topic_id),
  KEY user_id (user_id)
) ;

CREATE TABLE phpbb_banner (
banner_id mediumint(8) UNSIGNED NOT NULL, 
banner_name text NOT NULL, 
banner_spot smallint(1) UNSIGNED NOT NULL, 
banner_forum mediumint(8) UNSIGNED NOT NULL, 
banner_description varchar(30) NOT NULL, 
banner_url varchar(90) NOT NULL, 
banner_owner mediumint(8) NOT NULL, 
banner_click mediumint(8) UNSIGNED NOT NULL,
banner_view mediumint(8) UNSIGNED NOT NULL,
banner_weigth tinyint(1) UNSIGNED default '50' NOT NULL, 
banner_active tinyint(1) NOT NULL, 
banner_timetype tinyint(1) NOT NULL, 
time_begin int(11) NOT NULL, 
time_end int(11) NOT NULL, 
date_begin int(11) NOT NULL, 
date_end int(11) NOT NULL,
banner_level tinyint(1) NOT NULL,
banner_level_type tinyint(1) NOT NULL,
banner_comment varchar(50) NOT NULL,
banner_type mediumint(5) NOT NULL, 
banner_width mediumint(5) UNSIGNED NOT NULL,
banner_height mediumint(5) NOT NULL,
banner_filter tinyint(1) NOT NULL,
banner_filter_time mediumint(5) default '600' NOT NULL,
INDEX (banner_id)
) ;

CREATE TABLE phpbb_banner_stats (
banner_id mediumint(8) UNSIGNED NOT NULL, 
click_date int(11) NOT NULL, 
click_ip char(8) NOT NULL, 
click_user mediumint(8) NOT NULL, 
user_duration int(11) NOT NULL
) ;

CREATE TABLE phpbb_portal (
  portal_name varchar(255) NOT NULL default '',
  portal_value text NOT NULL,
  PRIMARY KEY  (portal_name)
) ;

CREATE TABLE phpbb_shout (
  shout_id mediumint(8) unsigned NOT NULL auto_increment,
  shout_username varchar(25) NOT NULL default '',
  shout_user_id mediumint(8) NOT NULL default '0',
  shout_group_id mediumint(8) NOT NULL default '0',
  shout_session_time int(11) NOT NULL default '0',
  shout_ip varchar(8) NOT NULL default '',
  shout_text text NOT NULL default '',
  shout_active mediumint(8) NOT NULL default '0',
  enable_bbcode tinyint(1) NOT NULL default '0',
  enable_html tinyint(1) NOT NULL default '0',
  enable_smilies tinyint(1) NOT NULL default '0',
  enable_sig tinyint(1) NOT NULL default '0',
  shout_bbcode_uid varchar(10) NOT NULL default '',
  KEY shout_id (shout_id)
) ;


CREATE TABLE phpbb_news (
news_id mediumint UNSIGNED NOT NULL AUTO_INCREMENT,
news_category varchar( 70 ) NOT NULL ,
news_image varchar( 70 ) NOT NULL ,
PRIMARY KEY ( news_id )
) ; 

CREATE TABLE phpbb_album_sp_config (
  config_name varchar(255) NOT NULL default '',
  config_value varchar(255) NOT NULL default '',
  PRIMARY KEY  (config_name)
) ;

CREATE TABLE phpbb_topic_view ( 
  topic_id mediumint(8) NOT NULL, 
  user_id mediumint(8) NOT NULL, 
  view_time int(11) NOT NULL, 
  view_count int(11) NOT NULL
) ;

CREATE TABLE phpbb_hacks_list (
  hack_id mediumint(8) unsigned NOT NULL auto_increment,
  hack_add_date int(10) unsigned NOT NULL default '0',
  hack_name varchar(255) NOT NULL default '',
  hack_desc varchar(255) NOT NULL default '',
  hack_author varchar(255) NOT NULL default '',
  hack_author_email varchar(255) NOT NULL default '',
  hack_author_website tinytext NOT NULL,
  hack_version varchar(32) NOT NULL default '',
  hack_hide enum('Yes','No') NOT NULL default 'No',
  hack_download_url text NOT NULL,
  hack_file varchar(255) NOT NULL default '',
  hack_file_mtime int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (hack_id),
  UNIQUE KEY hack_name (hack_name),
  KEY hack_hide (hack_hide),
  KEY hack_file (hack_file)
) ;

CREATE TABLE phpbb_stats_config (
  config_name varchar(50) NOT NULL default '',
  config_value varchar(255) NOT NULL default '',
  PRIMARY KEY (config_name)
) ;

CREATE TABLE phpbb_stats_modules (
  module_id tinyint(8) NOT NULL default '0',
  name varchar(150) NOT NULL default '',
  active tinyint(1) NOT NULL default '0',
  installed tinyint(1) NOT NULL default '0',
  display_order mediumint(8) unsigned NOT NULL default '0',
  update_time mediumint(8) unsigned NOT NULL default '0',
  auth_value tinyint(2) NOT NULL default '0',
  module_info_cache blob,
  module_db_cache blob,
  module_result_cache blob,
  module_info_time int(10) unsigned NOT NULL default '0',
  module_cache_time int(10) unsigned NOT NULL default '0',
  PRIMARY KEY (module_id)
) ; 

CREATE TABLE phpbb_link_categories (
   cat_id mediumint(8) unsigned NOT NULL auto_increment,
   cat_title varchar(100) NOT NULL default '',
   cat_order mediumint(8) unsigned NOT NULL default '0',
   PRIMARY KEY  (cat_id),
   KEY cat_order (cat_order)
) ;

CREATE TABLE phpbb_links (
   link_id mediumint(8) unsigned NOT NULL auto_increment,
   link_title varchar(100) NOT NULL default '',
   link_desc varchar(255) default NULL,
   link_category mediumint(8) unsigned NOT NULL default '0',
   link_url varchar(100) NOT NULL default '',
   link_logo_src varchar(120) default NULL,
   link_joined int(11) NOT NULL default '0',
   link_active tinyint(1) NOT NULL default '0',
   link_hits int(10) unsigned NOT NULL default '0',
   user_id mediumint(8) NOT NULL default '0',
   user_ip varchar(8) NOT NULL default '',
   last_user_ip varchar(8) NOT NULL default '',
   PRIMARY KEY  (link_id)
) ;

CREATE TABLE phpbb_link_config (
  config_name varchar(255) NOT NULL default '',
  config_value varchar(255) NOT NULL default ''
) ;

CREATE TABLE phpbb_acronyms (
acronym_id mediumint NOT NULL AUTO_INCREMENT,
acronym varchar(80) NOT NULL,
description varchar(255) NOT NULL,
PRIMARY KEY (acronym_id)
) ; 

CREATE TABLE phpbb_kb_articles (
article_id mediumint(8) unsigned NOT NULL auto_increment,
article_category_id mediumint(8) unsigned NOT NULL default '0',
article_title varchar(255) binary NOT NULL default '',
article_description varchar(255) binary NOT NULL default '',
article_date varchar(255) binary NOT NULL default '',
article_author_id mediumint(8) unsigned NOT NULL default '0',
username varchar(255),
bbcode_uid varchar(10) binary NOT NULL default '',
article_body text NOT NULL,
article_type mediumint(8) unsigned NOT NULL default '0',
approved tinyint(1) unsigned NOT NULL default '0',
topic_id mediumint(8) unsigned NOT NULL default '0',
views bigint(8) NOT NULL default '0',
article_rating double(6,4) NOT NULL default '0.0000',
article_totalvotes int(255) NOT NULL default '0',
KEY article_id (article_id)
) ;

CREATE TABLE phpbb_kb_categories (
category_id mediumint(8) unsigned NOT NULL auto_increment, 
category_name varchar(255) binary NOT NULL, 
category_details varchar(255) binary NOT NULL, 
number_articles mediumint(8) unsigned default '0' NOT NULL,
parent mediumint(8) unsigned,
cat_order mediumint(8) unsigned default '0' NOT NULL,
KEY category_id (category_id)
) ;

CREATE TABLE phpbb_kb_config (
config_name varchar(255) NOT NULL default '', 
config_value varchar(255) NOT NULL default '',
PRIMARY KEY  (config_name)
) ;

CREATE TABLE phpbb_kb_types (
id mediumint(8) unsigned NOT NULL auto_increment, 
type varchar(255) binary default '' NOT NULL, 
KEY id (id)
) ;

CREATE TABLE phpbb_kb_votes (
votes_ip varchar(50) NOT NULL default '0',
votes_userid int(50) NOT NULL default '0',
votes_file int(50) NOT NULL default '0'
) ;

CREATE TABLE phpbb_kb_results (
search_id int(11) unsigned NOT NULL default '0',
session_id varchar(32) NOT NULL default '',
search_array text NOT NULL,
PRIMARY KEY  (search_id),
KEY session_id (session_id)
) ;

CREATE TABLE phpbb_kb_wordlist (
word_text varchar(50) binary NOT NULL default '',
word_id mediumint(8) unsigned NOT NULL auto_increment,
word_common tinyint(1) unsigned NOT NULL default '0',
PRIMARY KEY  (word_text),
KEY word_id (word_id)
) ;

CREATE TABLE phpbb_kb_wordmatch (
article_id mediumint(8) unsigned NOT NULL default '0',
word_id mediumint(8) unsigned NOT NULL default '0',
title_match tinyint(1) NOT NULL default '0',
KEY post_id (article_id),
KEY word_id (word_id)
) ;

CREATE TABLE phpbb_ct_filter (
id mediumint(8) unsigned NOT NULL,
list varchar(250) default NULL,
PRIMARY KEY  (id)
) ;

CREATE TABLE phpbb_ctrack (
name varchar(50) default NULL,
value varchar(100) default NULL
) ;

CREATE TABLE phpbb_ct_viskey (
confirm_id char(32) NOT NULL default '',
session_id char(32) NOT NULL default '',
code char(6) NOT NULL default '',
PRIMARY KEY  (session_id,confirm_id)
) ;

CREATE TABLE phpbb_profile_fields (
field_id MEDIUMINT( 8 ) UNSIGNED NOT NULL AUTO_INCREMENT,
field_name VARCHAR( 255 ) NOT NULL ,
field_description VARCHAR( 255 ) NULL ,
field_type TINYINT( 4 ) UNSIGNED NOT NULL DEFAULT '0',
text_field_default VARCHAR( 255 ) NULL ,
text_field_maxlen INT( 255 ) UNSIGNED NOT NULL DEFAULT '255',
text_area_default TEXT NULL ,
text_area_maxlen INT( 255 ) UNSIGNED NOT NULL DEFAULT '1024',
radio_button_default VARCHAR( 255 ) NULL ,
radio_button_values TEXT NULL ,
checkbox_default TEXT NULL ,
checkbox_values TEXT NULL ,
is_required TINYINT( 2 ) UNSIGNED NOT NULL DEFAULT '0',
users_can_view TINYINT( 2 ) UNSIGNED NOT NULL DEFAULT '1',
view_in_profile TINYINT( 2 ) UNSIGNED NOT NULL DEFAULT '1',
profile_location TINYINT( 2 ) UNSIGNED NOT NULL DEFAULT '2',
view_in_memberlist TINYINT( 2 ) UNSIGNED NOT NULL DEFAULT '0',
view_in_topic TINYINT( 2 ) UNSIGNED NOT NULL DEFAULT '0',
topic_location TINYINT( 2 ) UNSIGNED NOT NULL DEFAULT '1',
PRIMARY KEY (field_id),
INDEX ( field_type ) ,
UNIQUE (field_name)
) ;

CREATE TABLE `phpbb_captcha_config` (
  `config_name` varchar(255) NOT NULL default '',
  `config_value` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`config_name`)
) ;

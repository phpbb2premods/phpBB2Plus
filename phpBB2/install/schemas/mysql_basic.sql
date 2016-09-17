#
# Basic DB data for phpBB2 devel
#
# $Id: mysql_basic.sql,v 1.29.2.25 2006/03/09 21:55:09 grahamje Exp $

# -- Config
INSERT INTO phpbb_config (config_name, config_value) VALUES ('config_id','1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('board_disable','0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('sitename','yourdomain.com');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('site_desc','A _little_ text to describe your forum');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cookie_name','phpbb2mysql');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cookie_path','/');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cookie_domain','');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cookie_secure','0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('session_length','3600');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_html','0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_html_tags','b,i,u,pre');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_bbcode','1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_smilies','1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_sig','1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_namechange','0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_theme_create','0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_avatar_local','0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_avatar_remote','0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_avatar_upload','0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('enable_confirm', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_autologin','1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_autologin_time','0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('override_user_style','0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('posts_per_page','15');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('topics_per_page','50');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('hot_threshold','25');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_poll_options','10');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_sig_chars','255');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_inbox_privmsgs','50');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_sentbox_privmsgs','25');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_savebox_privmsgs','50');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('board_email_sig','Thanks, The Management');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('board_email','youraddress@yourdomain.com');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('smtp_delivery','0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('smtp_host','');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('smtp_username','');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('smtp_password','');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('sendmail_fix','0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('require_activation','0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('flood_interval','15');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('search_flood_interval','15');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('search_min_chars','3');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_login_attempts', '5');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('login_reset_time', '30');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('board_email_form','0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('avatar_filesize','6144');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('avatar_max_width','80');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('avatar_max_height','80');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('avatar_path','images/avatars');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('avatar_gallery_path','images/avatars/gallery');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('smilies_path','images/smiles');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('default_style','1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('default_dateformat','D M d, Y g:i a');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('board_timezone','0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('prune_enable','1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('privmsg_disable','0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('gzip_compress','0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('coppa_fax', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('coppa_mail', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('record_online_users', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('record_online_date', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('server_name', 'www.myserver.tld');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('server_port', '80');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('script_path', '/phpBB2/');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('version', '.0.22');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('rand_seed', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('birthday_required', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('birthday_greeting', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_user_age', '100');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('min_user_age', '5');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('birthday_check_day', '7');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('hidde_last_logon', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('prune_shouts', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_news', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('news_item_trim', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('news_title_trim', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('news_item_num', '10');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('news_path', 'images/news');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_rss', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('news_rss_desc', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('news_rss_language', 'en_us');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('news_rss_ttl', '60');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('news_rss_cat', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('news_rss_image', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('news_rss_image_desc', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('news_rss_item_count', '15');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('news_rss_show_abstract', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('news_base_url', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('news_index_file', 'portal.php');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('bluecard_limit', '3');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('bluecard_limit_2', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_user_bancard', '10');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('report_forum', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_password_age', '730');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('block_time', '15');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_login_error', '3');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('min_password_len', '6');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('force_complex_password', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('password_not_login', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('board_disable_msg', 'Rebuild Search in progress...');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('split_news', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('users_allow_absence', 0);
INSERT INTO phpbb_config (config_name, config_value) VALUES ('mod_able_sent_absent', 0);
INSERT INTO phpbb_config (config_name, config_value) VALUES ('absent_button', 1);
INSERT INTO phpbb_config (config_name, config_value) VALUES ('google_visit_counter', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('registration_status', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('registration_closed', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('use_ajax_preview', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('use_ajax_edit', '1');

# -- Categories
INSERT INTO phpbb_categories (cat_id, cat_title, cat_order) VALUES (1, 'Test category 1', 10);


# -- Forums
INSERT INTO phpbb_forums (forum_id, forum_name, forum_desc, cat_id, forum_order, forum_posts, forum_topics, forum_last_post_id, auth_view, auth_read, auth_post, auth_reply, auth_edit, auth_delete, auth_announce, auth_sticky, auth_pollcreate, auth_vote, auth_attachments) VALUES (1, 'Test Forum 1', 'This is just a test forum.', 1, 10, 1, 1, 1, 0, 0, 0, 0, 1, 1, 3, 3, 1, 1, 3);


# -- Users
INSERT INTO phpbb_users (user_id, username, user_level, user_regdate, user_password, user_email, user_icq, user_website, user_occ, user_from, user_interests, user_sig, user_viewemail, user_style, user_aim, user_yim, user_msnm, user_posts, user_attachsig, user_allowsmile, user_allowhtml, user_allowbbcode, user_allow_pm, user_notify_pm, user_allow_viewonline, user_rank, user_avatar, user_lang, user_timezone, user_dateformat, user_actkey, user_newpasswd, user_notify, user_active) VALUES ( -1, 'Anonymous', 0, 0, '', '', '', '', '', '', '', '', 0, NULL, '', '', '', 0, 0, 1, 1, 1, 0, 1, 1, NULL, '', '', 0, '', '', '', 0, 0);

# -- username: admin    password: admin (change this or remove it once everything is working!)
INSERT INTO phpbb_users (user_id, username, user_level, user_regdate, user_password, user_email, user_icq, user_website, user_occ, user_from, user_interests, user_sig, user_viewemail, user_style, user_aim, user_yim, user_msnm, user_posts, user_attachsig, user_allowsmile, user_allowhtml, user_allowbbcode, user_allow_pm, user_notify_pm, user_popup_pm, user_allow_viewonline, user_rank, user_avatar, user_lang, user_timezone, user_dateformat, user_actkey, user_newpasswd, user_notify, user_active, user_color_group) VALUES ( 2, 'Admin', 1, 0, '21232f297a57a5a743894a0e4a801fc3', 'admin@yourdomain.com', '', '', '', '', '', '', 1, 1, '', '', '', 1, 0, 1, 0, 1, 1, 1, 1, 1, 1, '', 'english', 0, 'd M Y h:i a', '', '', 0, 1, 1);


# -- Ranks
INSERT INTO phpbb_ranks (rank_id, rank_title, rank_min, rank_special, rank_image) VALUES (1, 'Administrator', -1, 1, 'rank5_admin.gif');
INSERT INTO phpbb_ranks (rank_id, rank_title, rank_min, rank_special, rank_image) VALUES (2, 'Moderator', -1, 1, 'rank5_mod.gif');
INSERT INTO phpbb_ranks (rank_id, rank_title, rank_min, rank_special, rank_image) VALUES (3, 'Partner', -1, 1, 'rank5_partner.gif');
INSERT INTO phpbb_ranks (rank_id, rank_title, rank_min, rank_special, rank_image) VALUES (4, 'Spammer', -1, 1, 'rank0_spammer.gif');


# -- Groups
INSERT INTO phpbb_groups (group_id, group_name, group_description, group_single_user) VALUES (1, 'Anonymous', 'Personal User', 1);
INSERT INTO phpbb_groups (group_id, group_name, group_description, group_single_user) VALUES (2, 'Admin', 'Personal User', 1);


# -- User -> Group
INSERT INTO phpbb_user_group (group_id, user_id, user_pending) VALUES (1, -1, 0);
INSERT INTO phpbb_user_group (group_id, user_id, user_pending) VALUES (2, 2, 0);


# -- Demo Topic
INSERT INTO phpbb_topics (topic_id, topic_title, topic_poster, topic_time, topic_views, topic_replies, forum_id, topic_status, topic_type, topic_vote, topic_first_post_id, topic_last_post_id) VALUES (1, 'Welcome to phpBB 2 Plus 1.53', 2, '972086460', 0, 0, 1, 0, 0, 0, 1, 1);
INSERT INTO phpbb_topics (topic_id, forum_id, topic_title, topic_desc, topic_poster, topic_time, topic_views, topic_replies, topic_status, topic_vote, topic_type, topic_first_post_id, topic_last_post_id, topic_moved_id, topic_attachment, topic_icon, topic_calendar_time, topic_calendar_duration, topic_announce_duration, news_id) VALUES (2, 1, 'Sample News Post in Portal', '', 2, 1084742471, 1, 0, 0, 0, 4, 2, 2, 0, 0, 10, 0, 0, 0, 2);

# -- Demo Post
INSERT INTO phpbb_posts (post_id, topic_id, forum_id, poster_id, post_time, post_username, poster_ip, post_icon) VALUES (1, 1, 1, 2, 972086460, NULL, '7F000001', 10);
INSERT INTO phpbb_posts_text (post_id, bbcode_uid, post_subject, post_text) VALUES (1, '9e48a9b705', NULL, 'If you can read this Topic it seems that you have successfully installed your new Forum using [b:9e48a9b705]phpBB2 Plus 1.53[/b:9e48a9b705]. You should now visit the Admin Control Panel to configure some Settings. Since everything seems to work fine you are now free to delete this Topic, this Forum and also the Category.');
INSERT INTO phpbb_posts (post_id, topic_id, forum_id, poster_id, post_time, poster_ip, post_username, enable_bbcode, enable_html, enable_smilies, enable_sig, post_edit_time, post_edit_count, post_attachment, post_icon, post_bluecard) VALUES (2, 2, 1, 2, 1084742471, '7f000001', '', 1, 0, 1, 0, NULL, 0, 0, 10, NULL);
INSERT INTO phpbb_posts_text (post_id, bbcode_uid, post_subject, post_text) VALUES (2, 'a0ade7ddce', 'Sample News Post in Portal', 'As you can see this Topic is Attached to a News Category which is displayed in the Portal Index. You can simply create News Postings in the Portal by Posting a Topic and select the News Category into which the News Message should be posted.\r\n\r\nHave Fun...');


# -- Themes
# -- INSERT INTO phpbb_themes (themes_id, template_name, style_name, head_stylesheet, body_background, body_bgcolor, body_text, body_link, body_vlink, body_alink, body_hlink, tr_color1, tr_color2, tr_color3, tr_class1, tr_class2, tr_class3, th_color1, th_color2, th_color3, th_class1, th_class2, th_class3, td_color1, td_color2, td_color3, td_class1, td_class2, td_class3, fontface1, fontface2, fontface3, fontsize1, fontsize2, fontsize3, fontcolor1, fontcolor2, fontcolor3, span_class1, span_class2, span_class3) VALUES (1, 'subSilver', 'subSilver', 'subSilver.css', '', 'E5E5E5', '000000', '006699', '5493B4', '', 'DD6900', 'EFEFEF', 'DEE3E7', 'D1D7DC', '', '', '', '98AAB1', '006699', 'FFFFFF', 'cellpic1.gif', 'cellpic3.gif', 'cellpic2.jpg', 'FAFAFA', 'FFFFFF', '', 'row1', 'row2', '', 'Verdana, Arial, Helvetica, sans-serif', 'Trebuchet MS', 'Courier, \'Courier New\', sans-serif', 10, 11, 12, '444444', '006600', 'FFA34F', '', '', '');
INSERT INTO phpbb_themes VALUES (1, 'fisubsilversh', 'FI Subsilver Shadow', 'fisubsilversh.css', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'row1', 'row2', '', '', '', '', 0, 0, 0, '', '006600', 'ffa34f', '', '', '', 0, 0); 
INSERT INTO phpbb_themes_name (themes_id, tr_color1_name, tr_color2_name, tr_color3_name, tr_class1_name, tr_class2_name, tr_class3_name, th_color1_name, th_color2_name, th_color3_name, th_class1_name, th_class2_name, th_class3_name, td_color1_name, td_color2_name, td_color3_name, td_class1_name, td_class2_name, td_class3_name, fontface1_name, fontface2_name, fontface3_name, fontsize1_name, fontsize2_name, fontsize3_name, fontcolor1_name, fontcolor2_name, fontcolor3_name, span_class1_name, span_class2_name, span_class3_name) VALUES (1, 'The lightest row colour', 'The medium row color', 'The darkest row colour', '', '', '', 'Border round the whole page', 'Outer table border', 'Inner table border', 'Silver gradient picture', 'Blue gradient picture', 'Fade-out gradient on index', 'Background for quote boxes', 'All white areas', '', 'Background for topic posts', '2nd background for topic posts', '', 'Main fonts', 'Additional topic title font', 'Form fonts', 'Smallest font size', 'Medium font size', 'Normal font size (post body etc)', 'Quote & copyright text', 'Code text colour', 'Main table header text colour', '', '', '');


# -- Smilies
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 1, ':D', 'icon_biggrin.gif', 'Very Happy');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 2, ':-D', 'icon_biggrin.gif', 'Very Happy');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 3, ':grin:', 'icon_biggrin.gif', 'Very Happy');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 4, ':)', 'icon_smile.gif', 'Smile');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 5, ':-)', 'icon_smile.gif', 'Smile');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 6, ':smile:', 'icon_smile.gif', 'Smile');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 7, ':(', 'icon_sad.gif', 'Sad');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 8, ':-(', 'icon_sad.gif', 'Sad');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 9, ':sad:', 'icon_sad.gif', 'Sad');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 10, ':o', 'icon_surprised.gif', 'Surprised');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 11, ':-o', 'icon_surprised.gif', 'Surprised');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 12, ':eek:', 'icon_surprised.gif', 'Surprised');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 13, ':shock:', 'icon_eek.gif', 'Shocked');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 14, ':?', 'icon_confused.gif', 'Confused');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 15, ':-?', 'icon_confused.gif', 'Confused');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 16, ':???:', 'icon_confused.gif', 'Confused');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 17, '8)', 'icon_cool.gif', 'Cool');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 18, '8-)', 'icon_cool.gif', 'Cool');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 19, ':cool:', 'icon_cool.gif', 'Cool');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 20, ':lol:', 'icon_lol.gif', 'Laughing');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 21, ':x', 'icon_mad.gif', 'Mad');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 22, ':-x', 'icon_mad.gif', 'Mad');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 23, ':mad:', 'icon_mad.gif', 'Mad');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 24, ':P', 'icon_razz.gif', 'Razz');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 25, ':-P', 'icon_razz.gif', 'Razz');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 26, ':razz:', 'icon_razz.gif', 'Razz');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 27, ':oops:', 'icon_redface.gif', 'Embarassed');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 28, ':cry:', 'icon_cry.gif', 'Crying or Very sad');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 29, ':evil:', 'icon_evil.gif', 'Evil or Very Mad');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 30, ':twisted:', 'icon_twisted.gif', 'Twisted Evil');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 31, ':roll:', 'icon_rolleyes.gif', 'Rolling Eyes');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 32, ':wink:', 'icon_wink.gif', 'Wink');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 33, ';)', 'icon_wink.gif', 'Wink');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 34, ';-)', 'icon_wink.gif', 'Wink');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 35, ':!:', 'icon_exclaim.gif', 'Exclamation');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 36, ':?:', 'icon_question.gif', 'Question');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 37, ':idea:', 'icon_idea.gif', 'Idea');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 38, ':arrow:', 'icon_arrow.gif', 'Arrow');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 39, ':|', 'icon_neutral.gif', 'Neutral');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 40, ':-|', 'icon_neutral.gif', 'Neutral');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 41, ':neutral:', 'icon_neutral.gif', 'Neutral');
INSERT INTO phpbb_smilies (smilies_id, code, smile_url, emoticon) VALUES ( 42, ':mrgreen:', 'icon_mrgreen.gif', 'Mr. Green');


# -- wordlist
INSERT INTO phpbb_search_wordlist (word_id, word_text, word_common) VALUES ( 1, 'example', 0 );
INSERT INTO phpbb_search_wordlist (word_id, word_text, word_common) VALUES ( 2, 'post', 0 );
INSERT INTO phpbb_search_wordlist (word_id, word_text, word_common) VALUES ( 3, 'phpbb', 0 );
INSERT INTO phpbb_search_wordlist (word_id, word_text, word_common) VALUES ( 4, 'installation', 0 );
INSERT INTO phpbb_search_wordlist (word_id, word_text, word_common) VALUES ( 5, 'delete', 0 );
INSERT INTO phpbb_search_wordlist (word_id, word_text, word_common) VALUES ( 6, 'topic', 0 );
INSERT INTO phpbb_search_wordlist (word_id, word_text, word_common) VALUES ( 7, 'forum', 0 );
INSERT INTO phpbb_search_wordlist (word_id, word_text, word_common) VALUES ( 8, 'since', 0 );
INSERT INTO phpbb_search_wordlist (word_id, word_text, word_common) VALUES ( 9, 'everything', 0 );
INSERT INTO phpbb_search_wordlist (word_id, word_text, word_common) VALUES ( 10, 'seems', 0 );
INSERT INTO phpbb_search_wordlist (word_id, word_text, word_common) VALUES ( 11, 'working', 0 );
INSERT INTO phpbb_search_wordlist (word_id, word_text, word_common) VALUES ( 12, 'welcome', 0 );


# -- wordmatch
INSERT INTO phpbb_search_wordmatch (word_id, post_id, title_match) VALUES ( 1, 1, 0 );
INSERT INTO phpbb_search_wordmatch (word_id, post_id, title_match) VALUES ( 2, 1, 0 );
INSERT INTO phpbb_search_wordmatch (word_id, post_id, title_match) VALUES ( 3, 1, 0 );
INSERT INTO phpbb_search_wordmatch (word_id, post_id, title_match) VALUES ( 4, 1, 0 );
INSERT INTO phpbb_search_wordmatch (word_id, post_id, title_match) VALUES ( 5, 1, 0 );
INSERT INTO phpbb_search_wordmatch (word_id, post_id, title_match) VALUES ( 6, 1, 0 );
INSERT INTO phpbb_search_wordmatch (word_id, post_id, title_match) VALUES ( 7, 1, 0 );
INSERT INTO phpbb_search_wordmatch (word_id, post_id, title_match) VALUES ( 8, 1, 0 );
INSERT INTO phpbb_search_wordmatch (word_id, post_id, title_match) VALUES ( 9, 1, 0 );
INSERT INTO phpbb_search_wordmatch (word_id, post_id, title_match) VALUES ( 10, 1, 0 );
INSERT INTO phpbb_search_wordmatch (word_id, post_id, title_match) VALUES ( 11, 1, 0 );
INSERT INTO phpbb_search_wordmatch (word_id, post_id, title_match) VALUES ( 12, 1, 1 );
INSERT INTO phpbb_search_wordmatch (word_id, post_id, title_match) VALUES ( 3, 1, 1 );

#
# Basic DB data for Attachment Mod
#
# $Id: attach_mysql_basic.sql,v 1.1 2005/11/05 18:50:21 acydburn Exp $
# 

# -- attachments_config
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('upload_dir','files');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('upload_img','images/icon_clip.gif');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('topic_icon','images/icon_clip.gif');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('display_order','0');

INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('max_filesize','262144');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('attachment_quota','52428800');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('max_filesize_pm','262144');

INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('max_attachments','3');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('max_attachments_pm','1');

INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('disable_mod','0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('allow_pm_attach','1');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('attachment_topic_review','0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('allow_ftp_upload','0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('show_apcp','0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('attach_version','2.4.3');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('default_upload_quota', '0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('default_pm_quota', '0');

INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('ftp_server','');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('ftp_path','');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('download_path','');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('ftp_user','');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('ftp_pass','');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('ftp_pasv_mode','1');

INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('img_display_inlined','1');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('img_max_width','0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('img_max_height','0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('img_link_width','0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('img_link_height','0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('img_create_thumbnail','0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('img_min_thumb_filesize','12000');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('img_imagick', '');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('use_gd2','0');

INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('wma_autoplay','0');

INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('flash_autoplay','0');

# -- forbidden_extensions
INSERT INTO phpbb_forbidden_extensions (ext_id, extension) VALUES (1,'php');
INSERT INTO phpbb_forbidden_extensions (ext_id, extension) VALUES (2,'php3');
INSERT INTO phpbb_forbidden_extensions (ext_id, extension) VALUES (3,'php4');
INSERT INTO phpbb_forbidden_extensions (ext_id, extension) VALUES (4,'phtml');
INSERT INTO phpbb_forbidden_extensions (ext_id, extension) VALUES (5,'pl');
INSERT INTO phpbb_forbidden_extensions (ext_id, extension) VALUES (6,'asp');
INSERT INTO phpbb_forbidden_extensions (ext_id, extension) VALUES (7,'cgi');

# -- extension_groups
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (1,'Images',1,1,1,'',0,'');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (2,'Archives',0,1,1,'',0,'');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (3,'Plain Text',0,0,1,'',0,'');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (4,'Documents',0,0,1,'',0,'');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (5,'Real Media',0,0,2,'',0,'');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (6,'Streams',2,0,1,'',0,'');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (7,'Flash Files',3,0,1,'',0,'');

# -- extensions
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (1, 1,'gif', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (2, 1,'png', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (3, 1,'jpeg', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (4, 1,'jpg', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (5, 1,'tif', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (6, 1,'tga', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (7, 2,'gtar', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (8, 2,'gz', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (9, 2,'tar', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (10, 2,'zip', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (11, 2,'rar', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (12, 2,'ace', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (13, 3,'txt', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (14, 3,'c', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (15, 3,'h', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (16, 3,'cpp', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (17, 3,'hpp', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (18, 3,'diz', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (19, 4,'xls', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (20, 4,'doc', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (21, 4,'dot', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (22, 4,'pdf', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (23, 4,'ai', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (24, 4,'ps', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (25, 4,'ppt', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (26, 5,'rm', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (27, 6,'wma', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (28, 7,'swf', '');

# -- default quota limits
INSERT INTO phpbb_quota_limits (quota_limit_id, quota_desc, quota_limit) VALUES (1, 'Low', 262144);
INSERT INTO phpbb_quota_limits (quota_limit_id, quota_desc, quota_limit) VALUES (2, 'Medium', 2097152);
INSERT INTO phpbb_quota_limits (quota_limit_id, quota_desc, quota_limit) VALUES (3, 'High', 5242880); 

UPDATE phpbb_users SET user_lastlogon=user_lastvisit WHERE user_lastlogon='0';
UPDATE phpbb_users SET user_totaltime=(user_session_time-user_lastlogon) WHERE user_totaltime='0' AND user_lastlogon > 0;
UPDATE phpbb_users SET user_totallogon=1 WHERE user_totallogon='0' AND user_session_time <> '0';

INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('afghanistan','afghanistan.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('albania','albania.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('algeria','algeria.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('andorra','andorra.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('angola','angola.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('antigua and barbuda','antiguabarbuda.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('argentina','argentina.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('armenia','armenia.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('australia','australia.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('austria','austria.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('azerbaijan','azerbaijan.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('bahamas','bahamas.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('bahrain','bahrain.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('bangladesh','bangladesh.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('barbados','barbados.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('belarus','belarus.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('belgium','belgium.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('belize','belize.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('benin','benin.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('bhutan','bhutan.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('bolivia','bolivia.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('bosnia herzegovina','bosnia_herzegovina.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('botswana','botswana.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('brazil','brazil.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('brunei','brunei.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('bulgaria','bulgaria.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('burkinafaso','burkinafaso.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('burma','burma.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('burundi','burundi.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('cambodia','cambodia.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('cameroon','cameroon.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('canada','canada.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('central african rep','centralafricanrep.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('chad','chad.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('chile','chile.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('china','china.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('columbia','columbia.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('comoros','comoros.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('congo','congo.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('costarica','costarica.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('croatia','croatia.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('cuba','cuba.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('cyprus','cyprus.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('czech republic','czechrepublic.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('demrepcongo','demrepcongo.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('denmark','denmark.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('djibouti','djibouti.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('dominica','dominica.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('dominican rep','dominicanrep.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('ecuador','ecuador.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('egypt','egypt.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('elsalvador','elsalvador.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('eq guinea','eq_guinea.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('eritrea','eritrea.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('estonia','estonia.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('ethiopia','ethiopia.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('fiji','fiji.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('finland','finland.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('france','france.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('gabon','gabon.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('gambia','gambia.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('georgia','georgia.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('germany','germany.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('ghana','ghana.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('greece','greece.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('grenada','grenada.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('grenadines','grenadines.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('guatemala','guatemala.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('guinea','guinea.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('guineabissau','guineabissau.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('guyana','guyana.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('haiti','haiti.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('honduras','honduras.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('hong kong','hong_kong.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('hungary','hungary.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('iceland','iceland.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('india','india.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('indonesia','indonesia.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('iran','iran.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('iraq','iraq.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('ireland','ireland.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('israel','israel.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('italy','italy.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('ivory coast','ivorycoast.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('jamaica','jamaica.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('japan','japan.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('jordan','jordan.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('kazakhstan','kazakhstan.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('kenya','kenya.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('kiribati','kiribati.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('kuwait','kuwait.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('kyrgyzstan','kyrgyzstan.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('laos','laos.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('latvia','latvia.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('lebanon','lebanon.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('liberia','liberia.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('libya','libya.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('liechtenstein','liechtenstein.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('lithuania','lithuania.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('luxembourg','luxembourg.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('macadonia','macadonia.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('macau','macau.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('madagascar','madagascar.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('malawi','malawi.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('malaysia','malaysia.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('maldives','maldives.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('mali','mali.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('malta','malta.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('mauritania','mauritania.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('mauritius','mauritius.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('mexico','mexico.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('micronesia','micronesia.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('moldova','moldova.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('monaco','monaco.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('mongolia','mongolia.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('morocco','morocco.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('mozambique','mozambique.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('namibia','namibia.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('nauru','nauru.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('nepal','nepal.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('neth antilles','neth_antilles.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('netherlands','netherlands.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('new zealand','newzealand.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('nicaragua','nicaragua.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('niger','niger.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('nigeria','nigeria.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('north korea','north_korea.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('norway','norway.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('oman','oman.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('pakistan','pakistan.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('panama','panama.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('papua newguinea','papuanewguinea.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('paraguay','paraguay.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('peru','peru.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('philippines','philippines.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('poland','poland.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('portugal','portugal.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('puertorico','puertorico.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('qatar','qatar.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('rawanda','rawanda.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('romania','romania.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('russia','russia.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('sao tome','sao_tome.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('saudiarabia','saudiarabia.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('senegal','senegal.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('serbia','serbia.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('seychelles','seychelles.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('sierraleone','sierraleone.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('singapore','singapore.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('slovakia','slovakia.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('slovenia','slovenia.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('solomon islands','solomon_islands.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('somalia','somalia.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('south_korea','south_korea.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('south africa','southafrica.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('spain','spain.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('srilanka','srilanka.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('stkitts nevis','stkitts_nevis.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('stlucia','stlucia.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('sudan','sudan.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('suriname','suriname.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('sweden','sweden.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('switzerland','switzerland.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('syria','syria.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('taiwan','taiwan.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('tajikistan','tajikistan.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('tanzania','tanzania.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('thailand','thailand.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('togo','togo.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('tonga','tonga.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('trinidad and tobago','trinidadandtobago.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('tunisia','tunisia.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('turkey','turkey.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('turkmenistan','turkmenistan.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('tuvala','tuvala.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('uae','uae.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('uganda','uganda.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('uk','uk.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('ukraine','ukraine.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('uruguay','uruguay.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('usa','usa.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('ussr','ussr.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('uzbekistan','uzbekistan.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('vanuatu','vanuatu.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('venezuela','venezuela.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('vietnam','vietnam.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('western samoa','western_samoa.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('yemen','yemen.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('yugoslavia','yugoslavia.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('zaire','zaire.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('zambia','zambia.gif');
INSERT INTO phpbb_flags (flag_name, flag_image) VALUES ('zimbabwe','zimbabwe.gif');

INSERT INTO phpbb_pa_cat VALUES (1, 'My Category', '', 0, '', 1, 0, 0, 0, '0', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO phpbb_pa_cat VALUES (2, 'Test Cagegory', 'Just a test category', 1, '', 2, 1, 0, 0, '0', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO phpbb_pa_config VALUES ('allow_comment_images', '0');
INSERT INTO phpbb_pa_config VALUES ('no_comment_image_message', '[No image please]');
INSERT INTO phpbb_pa_config VALUES ('allow_smilies', '1');
INSERT INTO phpbb_pa_config VALUES ('allow_comment_links', '1');
INSERT INTO phpbb_pa_config VALUES ('no_comment_link_message', '[No links please]');
INSERT INTO phpbb_pa_config VALUES ('settings_disable', '0');
INSERT INTO phpbb_pa_config VALUES ('allow_html', '1');
INSERT INTO phpbb_pa_config VALUES ('allow_bbcode', '1');
INSERT INTO phpbb_pa_config VALUES ('settings_topnumber', '10');
INSERT INTO phpbb_pa_config VALUES ('settings_newdays', '1');
INSERT INTO phpbb_pa_config VALUES ('settings_stats', '');
INSERT INTO phpbb_pa_config VALUES ('settings_viewall', '1');
INSERT INTO phpbb_pa_config VALUES ('settings_dbname', 'Download Database');
INSERT INTO phpbb_pa_config VALUES ('settings_dbdescription', '');
INSERT INTO phpbb_pa_config VALUES ('max_comment_chars', '5000');
INSERT INTO phpbb_pa_config VALUES ('tpl_php', '0');
INSERT INTO phpbb_pa_config VALUES ('settings_file_page', '20');
INSERT INTO phpbb_pa_config VALUES ('hotlink_prevent', '1');
INSERT INTO phpbb_pa_config VALUES ('hotlink_allowed', '');
INSERT INTO phpbb_pa_config VALUES ('sort_method', 'file_time');
INSERT INTO phpbb_pa_config VALUES ('sort_order', 'DESC');
INSERT INTO phpbb_pa_config (config_name, config_value) VALUES ('auth_search','0');
INSERT INTO phpbb_pa_config (config_name, config_value) VALUES ('auth_stats','0');
INSERT INTO phpbb_pa_config (config_name, config_value) VALUES ('auth_toplist','0');
INSERT INTO phpbb_pa_config (config_name, config_value) VALUES ('auth_viewall','0');
INSERT INTO phpbb_pa_config (config_name, config_value) VALUES ('max_file_size','262144');
INSERT INTO phpbb_pa_config (config_name, config_value) VALUES ('upload_dir','pafiledb/uploads/');
INSERT INTO phpbb_pa_config (config_name, config_value) VALUES ('screenshots_dir','pafiledb/images/screenshots/');
INSERT INTO phpbb_pa_config (config_name, config_value) VALUES ('forbidden_extensions','php, php3, php4, phtml, pl, asp, aspx, cgi');
INSERT INTO phpbb_pa_config VALUES ('need_validation', '0');
INSERT INTO phpbb_pa_config VALUES ('validator', 'validator_admin');
INSERT INTO phpbb_pa_config VALUES ('pm_notify', '0');

INSERT INTO phpbb_album_cat VALUES (1, 'Test category', '', 10, -1, 0, 0, 0, 0, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0);

INSERT INTO phpbb_album_config VALUES ('max_pics', '1024');
INSERT INTO phpbb_album_config VALUES ('user_pics_limit', '50');
INSERT INTO phpbb_album_config VALUES ('mod_pics_limit', '250');
INSERT INTO phpbb_album_config VALUES ('max_file_size', '128000');
INSERT INTO phpbb_album_config VALUES ('max_width', '800');
INSERT INTO phpbb_album_config VALUES ('max_height', '600');
INSERT INTO phpbb_album_config VALUES ('rows_per_page', '3');
INSERT INTO phpbb_album_config VALUES ('cols_per_page', '4');
INSERT INTO phpbb_album_config VALUES ('fullpic_popup', '0');
INSERT INTO phpbb_album_config VALUES ('thumbnail_quality', '50');
INSERT INTO phpbb_album_config VALUES ('thumbnail_size', '125');
INSERT INTO phpbb_album_config VALUES ('thumbnail_cache', '1');
INSERT INTO phpbb_album_config VALUES ('sort_method', 'pic_time');
INSERT INTO phpbb_album_config VALUES ('sort_order', 'DESC');
INSERT INTO phpbb_album_config VALUES ('jpg_allowed', '1');
INSERT INTO phpbb_album_config VALUES ('png_allowed', '1');
INSERT INTO phpbb_album_config VALUES ('gif_allowed', '0');
INSERT INTO phpbb_album_config VALUES ('desc_length', '512');
INSERT INTO phpbb_album_config VALUES ('hotlink_prevent', '0');
INSERT INTO phpbb_album_config VALUES ('hotlink_allowed', 'smartor.is-root.com');
INSERT INTO phpbb_album_config VALUES ('personal_gallery', '0');
INSERT INTO phpbb_album_config VALUES ('personal_gallery_private', '0');
INSERT INTO phpbb_album_config VALUES ('personal_gallery_limit', '10');
INSERT INTO phpbb_album_config VALUES ('personal_gallery_view', '-1');
INSERT INTO phpbb_album_config VALUES ('rate', '1');
INSERT INTO phpbb_album_config VALUES ('rate_scale', '10');
INSERT INTO phpbb_album_config VALUES ('comment', '1');
INSERT INTO phpbb_album_config VALUES ('gd_version', '2');
INSERT INTO phpbb_album_config VALUES ('album_version', '.0.53');
INSERT INTO phpbb_album_config VALUES ('show_index_thumb', '0'); 
INSERT INTO phpbb_album_config VALUES ('show_index_total_pics', '0'); 
INSERT INTO phpbb_album_config VALUES ('show_index_total_comments', '0'); 
INSERT INTO phpbb_album_config VALUES ('show_index_comments', '0'); 
INSERT INTO phpbb_album_config VALUES ('show_index_last_comment', '0'); 
INSERT INTO phpbb_album_config VALUES ('show_index_last_pic', '0'); 
INSERT INTO phpbb_album_config VALUES ('line_break_subcats', '0');
INSERT INTO phpbb_album_config VALUES ('show_index_subcats', '1');
INSERT INTO phpbb_album_config VALUES ('show_index_pics', '0');
INSERT INTO phpbb_album_config VALUES ('show_recent_in_subcats', '1');
INSERT INTO phpbb_album_config VALUES ('show_recent_instead_of_nopics', '1');
INSERT INTO phpbb_album_config VALUES ('personal_allow_gallery_mod', '1');
INSERT INTO phpbb_album_config VALUES ('personal_allow_sub_categories', '1');
INSERT INTO phpbb_album_config VALUES ('personal_sub_category_limit', '10');
INSERT INTO phpbb_album_config VALUES ('personal_show_subcats_in_index', '1');
INSERT INTO phpbb_album_config VALUES ('personal_show_recent_in_subcats', '1');
INSERT INTO phpbb_album_config VALUES ('personal_show_recent_instead_of_nopics', '1');
INSERT INTO phpbb_album_config VALUES ('show_personal_gallery_link', '1');
INSERT INTO phpbb_album_config VALUES ('album_category_sorting', 'cat_order');
INSERT INTO phpbb_album_config VALUES ('album_category_sorting_direction', 'ASC');
INSERT INTO phpbb_album_config VALUES ('album_debug_mode', '0');
INSERT INTO phpbb_album_config VALUES ('show_all_in_personal_gallery', '0');
INSERT INTO phpbb_album_config VALUES ('new_pic_check_interval', '1M');
INSERT INTO phpbb_album_config VALUES ('index_enable_supercells', '1');
UPDATE phpbb_auth_access SET auth_cal = auth_sticky;
UPDATE phpbb_forums SET auth_cal = auth_sticky;
INSERT INTO phpbb_plus VALUES ('show_quickreply', '1');
INSERT INTO phpbb_plus VALUES ('show_recent_photo', '1');
INSERT INTO phpbb_plus VALUES ('index_layout', 'index_body_plus.tpl');
INSERT INTO phpbb_plus VALUES ('default_avatar', '1');
INSERT INTO phpbb_plus VALUES ('show_boardstats', '1');
INSERT INTO phpbb_plus VALUES ('show_links', '1');
INSERT INTO phpbb_plus VALUES ('show_recent_topics', '1');
INSERT INTO phpbb_plus VALUES ('show_shoutbox', '1');
INSERT INTO phpbb_plus VALUES ('plus_version', '1.53');
INSERT INTO phpbb_plus VALUES ('cols_per_page', '4');
INSERT INTO phpbb_plus VALUES ('show_last_visit', '1');
INSERT INTO phpbb_plus VALUES ('contact_email', 'webmaster@yourdomain');
INSERT INTO phpbb_plus VALUES ('enable_shorturls', '0');
INSERT INTO phpbb_plus VALUES ('disable_sid', '0');
INSERT INTO phpbb_plus VALUES ('enable_antirobot', '1');
INSERT INTO phpbb_plus VALUES ('enable_gentime', '0');
INSERT INTO phpbb_plus VALUES ('enable_banners', '1');
INSERT INTO phpbb_plus VALUES ('enable_confirm_post', '0');
INSERT INTO phpbb_plus VALUES ('enable_fulltextsearch', '0');

INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_link_bookmarks', '0');

INSERT INTO phpbb_portal VALUES ('welcome_text', '<center>Welcome to <b>phpBB2 Plus 1.53</b><br /><br />Your new Forum is waiting for you now,<br /><br />Have a good time! ^_^<br><br>');
INSERT INTO phpbb_portal VALUES ('number_of_news', '5');
INSERT INTO phpbb_portal VALUES ('news_length', '200');
INSERT INTO phpbb_portal VALUES ('news_forum', '1');
INSERT INTO phpbb_portal VALUES ('poll_forum', '1');
INSERT INTO phpbb_portal VALUES ('number_recent_topics', '5');
INSERT INTO phpbb_portal VALUES ('number_recent_files', '5');
INSERT INTO phpbb_portal VALUES ('last_seen', '5');
INSERT INTO phpbb_portal VALUES ('exceptional_forums', '');
INSERT INTO phpbb_portal VALUES ('cat_id', '0');
INSERT INTO phpbb_portal VALUES ('pics_number', '1');
INSERT INTO phpbb_portal VALUES ('pics_all', '0');
INSERT INTO phpbb_portal VALUES ('pics_sort', '0');
INSERT INTO phpbb_portal VALUES ('pics_thumbsize', '100');
INSERT INTO phpbb_portal VALUES ('number_top_posters', '5');

INSERT INTO phpbb_album_sp_config VALUES ('disp_late', '1');
INSERT INTO phpbb_album_sp_config VALUES ('rate_type', '2');
INSERT INTO phpbb_album_sp_config VALUES ('disp_high', '1');
INSERT INTO phpbb_album_sp_config VALUES ('disp_rand', '1');
INSERT INTO phpbb_album_sp_config VALUES ('img_rows', '2');
INSERT INTO phpbb_album_sp_config VALUES ('img_cols', '4');
INSERT INTO phpbb_album_sp_config VALUES ('use_watermark', '0');
INSERT INTO phpbb_album_sp_config VALUES ('wut_users', '0');
INSERT INTO phpbb_album_sp_config VALUES ('disp_watermark_at', '3');
INSERT INTO phpbb_album_sp_config VALUES ('hon_rate_times', '1');
INSERT INTO phpbb_album_sp_config VALUES ('hon_rate_sep', '1');
INSERT INTO phpbb_album_sp_config VALUES ('hon_rate_where', '');
INSERT INTO phpbb_album_sp_config VALUES ('hon_rate_users', '1');
INSERT INTO phpbb_album_sp_config VALUES ('midthumb_use', '1');
INSERT INTO phpbb_album_sp_config VALUES ('midthumb_height', '600');
INSERT INTO phpbb_album_sp_config VALUES ('midthumb_width', '800');
INSERT INTO phpbb_album_sp_config VALUES ('midthumb_cache', '1');

INSERT INTO phpbb_stats_config (config_name, config_value) VALUES ('return_limit', '10');
INSERT INTO phpbb_stats_config (config_name, config_value) VALUES ('version', '2.1.5');
INSERT INTO phpbb_stats_config (config_name, config_value) VALUES ('modules_dir', 'stat_modules');
INSERT INTO phpbb_stats_config (config_name, config_value) VALUES ('page_views', '0');

INSERT INTO phpbb_color_groups VALUES (1, 'Administrator', 'red', 0, 1);
INSERT INTO phpbb_color_groups VALUES (2, 'Super Mod', 'blue', 0, 2);
INSERT INTO phpbb_color_groups VALUES (3, 'Moderator', 'green', 0, 3);

INSERT INTO phpbb_news VALUES (1, 'News', 'topicnews.gif');
INSERT INTO phpbb_news VALUES (2, 'Announcements', 'announcements.gif');

INSERT INTO phpbb_link_categories VALUES (1, 'Arts', 1);
INSERT INTO phpbb_link_categories VALUES (2, 'Business', 2);
INSERT INTO phpbb_link_categories VALUES (3, 'Children and Teens', 3);
INSERT INTO phpbb_link_categories VALUES (4, 'Computers', 4);
INSERT INTO phpbb_link_categories VALUES (5, 'Games', 5);
INSERT INTO phpbb_link_categories VALUES (6, 'Health', 6);
INSERT INTO phpbb_link_categories VALUES (7, 'Home', 7);
INSERT INTO phpbb_link_categories VALUES (8, 'News', 8); 
INSERT INTO phpbb_links VALUES (1, 'phpBB Official Website', 'Official phpBB Website', 4, 'http://www.phpbb.com/', 'images/links/phpBB_88a.gif', unix_timestamp(NOW()), 1, 0, 2, '', '');
INSERT INTO phpbb_links VALUES (2, 'phpbb-tw.net', 'Unofficial phpBB Chinese Support Centre', 4, 'http://phpbb-tw.net', 'images/links/phpbb-tw_logo88a.gif', unix_timestamp(NOW()), 1, 0, 2, '', '');
INSERT INTO phpbb_links VALUES (3, 'phpbb2.de', 'Your Source for phpBB2 Stuff', 4, 'http://www.phpbb2.de', 'images/links/phpbb2_de_logo.gif', unix_timestamp(NOW()), 1, 0, 2, '', '');
INSERT INTO phpbb_links VALUES (4, 'Forumstyles.de', 'Forumstyles.de', 4, 'http://www.forumstyles.de', 'images/links/forumstyles_button.gif', unix_timestamp(NOW()), 1, 0, 2, '', '');
INSERT INTO phpbb_links VALUES (5, 'Oxpus', 'Oxpus.de', 4, 'http://www.oxpus.de', 'images/links/oxpus_banner.gif', unix_timestamp(NOW()), 1, 0, 2, '', '');
INSERT INTO phpbb_acronyms (acronym, description) VALUES ('phpBB2', 'phpBB2.de');

INSERT INTO phpbb_link_config (config_name, config_value) VALUES ('width', '88');
INSERT INTO phpbb_link_config (config_name, config_value) VALUES ('height', '31');
INSERT INTO phpbb_link_config (config_name, config_value) VALUES ('linkspp', '10');
INSERT INTO phpbb_link_config (config_name, config_value) VALUES ('display_interval', '6000');
INSERT INTO phpbb_link_config (config_name, config_value) VALUES ('display_logo_num', '10');
INSERT INTO phpbb_link_config (config_name, config_value) VALUES ('display_links_logo', '1');
INSERT INTO phpbb_link_config (config_name, config_value) VALUES ('email_notify', '1');
INSERT INTO phpbb_link_config (config_name, config_value) VALUES ('pm_notify ', '0'); 
INSERT INTO phpbb_link_config (config_name, config_value) VALUES ('lock_submit_site', '0');
INSERT INTO phpbb_link_config (config_name, config_value) VALUES ('allow_no_logo', '0');
INSERT INTO phpbb_banner VALUES (1, 'images/banner/phpbb2_banner_486.gif', 0, 0, 'phpBB2.de - Your No.1 Source', 'http://www.phpbb2.de', 2, 0, 11, 50, 1, 0, 0, 0, 0, 0, -1, 2, 'phpBB2.de Banner 468 * 60', 0, 468, 60, 0, 600);
INSERT INTO phpbb_banner VALUES (2, 'images/banner/phpbb2_de_logo.gif', 16, 0, 'phpBB2.de - Your No.1 Source', 'http://www.phpbb2.de', 2, 0, 10, 50, 1, 0, 0, 0, 0, 0, -1, 2, 'phpBB2.de Portal Button 88 * 31', 0, 88, 31, 0, 0);
INSERT INTO phpbb_banner VALUES (3, 'images/banner/smartorsite_logo.gif', 17, 0, 'Smartors Site', 'http://smartor.is-root.com', 2, 0, 6, 50, 1, 0, 0, 0, 0, 0, -1, 2, 'Smartor Portal Button 88 * 31', 0, 88, 31, 0, 600);
INSERT INTO phpbb_banner VALUES (4, 'images/banner/phpBB_88a.gif', 18, 0, 'phpBB.com - Home of phpBB', 'http://www.phpbb.com', 2, 0, 4, 50, 1, 0, 0, 0, 0, 0, -1, 2, 'phpBB.com Portal Button 88 * 31', 0, 88, 31, 0, 600);
INSERT INTO phpbb_banner VALUES (5, 'images/banner/forumstyles_button.gif', 19, 0, 'Forumstyles', 'http://www.forumstyles.de', 2, 0, 2, 50, 1, 0, 0, 0, 0, 0, -1, 2, 'Forumstyles.de Portal Button 88 * 31', 0, 88, 31, 0, 600);
UPDATE phpbb_users SET user_passwd_change = user_regdate;
UPDATE phpbb_forums SET auth_global_announce=5;
INSERT INTO phpbb_kb_categories VALUES (1, 'Test Category 1', 'This is a test category', 1, '0', '10' );
INSERT INTO phpbb_kb_config (config_name, config_value) VALUES ('approve_new', '1');
INSERT INTO phpbb_kb_config (config_name, config_value) VALUES ('approve_edit', '1');
INSERT INTO phpbb_kb_config (config_name, config_value) VALUES ('allow_new', '1');
INSERT INTO phpbb_kb_config (config_name, config_value) VALUES ('allow_edit', '1');
INSERT INTO phpbb_kb_config (config_name, config_value) VALUES ('notify', '1');
INSERT INTO phpbb_kb_config (config_name, config_value) VALUES ('admin_id', '2');
INSERT INTO phpbb_kb_config (config_name, config_value) VALUES ('show_pretext',0);
INSERT INTO phpbb_kb_config (config_name, config_value) VALUES ('pt_header','Article Submission Instructions');
INSERT INTO phpbb_kb_config (config_name, config_value) VALUES ('pt_body','Please check your references and include as much information as you can.');
INSERT INTO phpbb_kb_config (config_name, config_value) VALUES ('forum_id', '1');
INSERT INTO phpbb_kb_config (config_name, config_value) VALUES ('comments', '1');
INSERT INTO phpbb_kb_config (config_name, config_value) VALUES ('allow_anon', '0');
INSERT INTO phpbb_kb_config (config_name, config_value) VALUES ('del_topic', '1');
INSERT INTO phpbb_kb_config (config_name, config_value) VALUES ('allow_rating', '0');
INSERT INTO phpbb_kb_config (config_name, config_value) VALUES ('allow_anonymos_rating', '0');
INSERT INTO phpbb_kb_config (config_name, config_value) VALUES ('comments_show', '1');
INSERT INTO phpbb_kb_config (config_name, config_value) VALUES ('mod_group', '0');
INSERT INTO phpbb_kb_config (config_name, config_value) VALUES ('bump_post', '1');
INSERT INTO phpbb_kb_config (config_name, config_value) VALUES ('stats_list', '1');
INSERT INTO phpbb_kb_config (config_name, config_value) VALUES ('header_banner', '1');
INSERT INTO phpbb_kb_config (config_name, config_value) VALUES ('votes_check_userid', '1');
INSERT INTO phpbb_kb_config (config_name, config_value) VALUES ('votes_check_ip', '1');
INSERT INTO phpbb_kb_config (config_name, config_value) VALUES ('art_pagination', '5');
INSERT INTO phpbb_kb_config (config_name, config_value) VALUES ('comments_pagination', '5');
INSERT INTO phpbb_kb_config (config_name, config_value) VALUES ('news_sort', 'Alphabetic');
INSERT INTO phpbb_kb_config (config_name, config_value) VALUES ('news_sort_par', 'ASC');
INSERT INTO phpbb_kb_types VALUES (1, 'Test Type 1');
INSERT INTO phpbb_hacks_list (hack_id, hack_add_date, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES (28, 0, 'Gender Mod', 'This mod will add a Gender field into users\\\' profile, and display \\"Gender: |image|\\" in posts too', 'Niels', 'ncr@db9.dk', 'http://mods.db9.dk', '1.2.6', 'No', '', '', 0),
(3, 0, 'Admin Account Actions', 'Displays all users which expect an account activation on an extra site inside the admin panel (admin activation and user activation). You can activate or delete them.', 'Acid', '', '', '1.2.1', 'No', '', '', 0),
(6, 0, 'Supercharged Album Pack 1', 'A series of modification for Album version 2 by Smartor ( http://smartor.is-root.com )', 'Volodymyr (CLowN) Skoryk', '', '', '1.5.1', 'No', '', '', 0),
(7, 0, 'Photo Album Addon v2 for phpBB2', 'This is a phpBB-based photo album/gallery management system.', 'Smartor', 'smartor_xp@hotmail.com', 'http://smartor.is-root.com', '', 'No', '', '', 0),
(8, 0, 'Align text BBcode Mod', 'Adds a text alignment bbcode tag to your forum', 'davidls', 'davidls14@yahoo.com.au', 'http://www27.brinkster.com/bb2c', '2.0.6', 'No', '', '', 0),
(9, 0, 'Anti Robotic Register Flood', 'This will add a Random-graphical-text Vadiation field in Registration form to protect your phpBB from being flooded of robotic-member-registration (like many free webhost signup form...)', 'Smartor', 'smartor_xp@hotmail.com', 'http://smartor.is-root.com', '1.1.4', 'No', '', '', 0),
(12, 0, 'File Attachment Mod v2', 'This Mod adds the ability to attach files in phpBB2.', 'Acyd Burn', '', 'http://www.opentools.de', '2.4.3', 'No', '', '', 0),
(13, 0, 'BBCode Buttons Organizer', 'Allows for neater display of additional quick BBCode buttons.', 'Nuttzy', 'nospam@blizzhackers.com', 'http://www.blizzhackers.com', '1.2.1', 'No', '', '', 0),
(14, 0, 'Birthday Mod', 'This mod will add a birthday field into your user\\\'s profile and make users age viewable to others when viewing posts.', 'Niels', 'ncr@db9.dk', 'http://mods.db9.dk', '1.5.4', 'No', '', '', 0),
(15, 0, 'Birthday ADD-ON Chinese zodiac\\\'s in viewtopic', 'if the user have filled a birthday date, a chinese zodiac image will be displayed in the viewtopic. this is a ADD-ON and will require Birthday mod to be installed before it will work', 'Niels', 'ncr@db9.dk', 'http://mods.db9.dk', '1.0.0', 'No', '', '', 0),
(16, 0, 'Birthday ADD-ON Chinese zodiac', 'if the user have filled a birthday date, a chinese zodiac image will be displayed in the users profile. this is a ADD-ON and will require Birthday mod to be installed before it will work', 'Niels', 'ncr@db9.dk', 'http://mods.db9.dk', '1.0.1', 'No', '', '', 0),
(17, 0, 'Birthday ADD-ON zodiac\\\'s', 'if the user have filled a birthday date, a zodiac image will be displayed in the users profile/beside users posts. this is a ADD-ON and will require Birthday mod to be installed before it will work', 'Niels', 'ncr@db9.dk', 'http://mods.db9.dk', '1.0.5', 'No', '', '', 0),
(18, 0, 'Bookmarks Mod', 'Keeps an internal list of bookmarks set by the user', 'PhilippK', 'phpBB2004@kordowich.net', 'http://phpbb.kordowich.net/', '1.1.1a', 'No', '', '', 0),
(19, 0, 'Slash News Mod', 'Allows you to assign a news category to any new topic. The topic can then be displayed as news with a category graphic like Slashdot', 'CodeMonkeyX', 'nickyoungso@yahoo.com', 'http://www.codemonkeyx.net', '1.0.1', 'No', '', '', 0),
(20, 0, 'Color Groups Mod', 'This mod will replace the current name colorization with a group system.  You may define your group name, group color, and group members', 'Nivisec', 'support@nivisec.com', 'http://www.nivisec.com', '1.2.0', 'No', '', '', 0),
(21, 0, 'Complete banner Mod', 'This mod makes it posible to add banners to your phpbb2 pages, by default banners are placed in top/botton but you may place the tags, inside any template file', 'Niels', 'ncr@db9.dk', 'http://mods.db9.dk', '1.3.5', 'No', '', '', 0),
(22, 0, 'Country Flags', 'This mod allows your registered board members to select the flag of their country.  Their flag will then display thoughout the phpBB system', 'Nuttzy99', 'pktoolkit@blizzhackers.com', 'http://www.blizzhackers.com', '2.2.0', 'No', '', '', 0),
(23, 0, 'ezPortal Admin for phpBB2', 'This mod will add a small administration menu for the ezPortal from Smartor', 'Marcus Thiel', 'thundercat@die-pretorianer.de', 'http://www.die-pretorianer.de', '1.0.5', 'No', '', '', 0),
(24, 0, 'ezPortal', 'This Mod explains you how to create a portal for phpBB2 as simple as possible. This MOD is not exactly a full functional portal system (content management system) but it looks like a portal. You should customize/modify/improve it to fit your fantasy ;) It', 'Smartor', 'smartor_xp@hotmail.com', 'http://smartor.is-root.com', '2.1.8', 'No', '', '', 0),
(30, 0, 'Glow and Shadow effects BBcode Mod', 'adds a glow and shadow bbcode tags to your forum', 'davidls', 'davidls14@yahoo.com.au', 'http://www27.brinkster.com/bb2c', '2.0.6', 'No', '', '', 0),
(32, 0, 'Junior Admin Mod', 'This will allow you to define any and all users you\\\'d like to have access to whatever admin modules you\\\'d like', 'Nivisec', 'support@nivisec.com', 'http://www.nivisec.com', '2.0.5', 'No', '', '', 0),
(33, 0, 'Last visit Mod', 'This mod will register when the user last logged in, allong with the info about how many users have visited the board', 'Niels', 'ncr@db9.dk', 'http://mods.db9.dk', '1.2.8', 'No', '', '', 0),
(34, 0, 'Announces Suite', 'This mod allows you to display the announces from the forum on the index page, and above the forum pages for the announce coming from forums of the same categories. It adds also a duration to each announcement, and global announcement', 'Ptirhiik', 'admin@rpgnet-fr.com', 'http://rpgnet.clanmckeen.com', '3.0.2', 'No', '', '', 0),
(35, 0, 'Categories hierarchy Mod', 'This mod allows to attach a categorie to a higher level categorie, keeping all the forum visible on the index page (vBulletin-like view), or have a sub-forum view.', 'Ptirhiik', 'ptirhiik@clanmckeen.com', 'http://rpgnet.clanmckeen.com', '2.0.4', 'No', '', '', 0),
(36, 0, 'Post Icons Mod', 'This mod will allow to add an icon in front of each topic title. This part is common to all board setup.', 'Ptirhiik', 'ptirhiik@clanmckeen.com', 'http://rpgnet.clanmckeen.com', '1.0.1', 'No', '', '', 0),
(38, 0, 'Ranks summarize', 'This mod displays all the ranks available on your board', 'Ptirhiik', 'admin@rpgnet-fr.com', 'http://www.rpgnet-fr.com', '1.0.4', 'No', '', '', 0),
(40, 0, 'Split topic type', 'This mod splits the topic per type in the viewform display', 'Ptirhiik', 'admin@rpgnet-fr.com', 'http://rpgnet.clanmckeen.com', '2.0.1', 'No', '', '', 0),
(41, 0, 'Topic calendar Mod', 'This mod adds a calendar to your board, working with natural phpBB auth.', 'Ptirhiik', 'ptirhiik@clanmckeen.com', 'http://rpgnet.clanmckeen.com', '1.0.1', 'No', '', '', 0),
(42, 0, 'Multiple BBCode MOD', 'Allows you to install BBCode MODs that add quick BBCode buttons in post edits.  Without this MOD, there is no standard way of installing BBCode MODs.\r\n', 'Nuttzy99', 'nospam@blizzhackers.com', 'http://www.blizzhackers.com', '1.2.1', 'No', '', '', 0),
(43, 0, 'Online/Offline Indicator', 'This MOD outputs graphically a user\\\'s online status in Topics and the Memberlist', 'romans1423', 'romans1423@hotmail.com', 'http://www.beckman-ministries.com', '1.3.2', 'No', '', '', 0),
(44, 0, 'Download Mod pafiledb with MX Addon', 'Integration of pafiledb (Database download manager) with phpbb. pafiledb use header, footer, session, template, and database system of phpbb', 'mohd + mx-system', 'mohdalbasri@yahoo.com', 'http://mohd.vraag-en-antwoord.nl/main/', '0.0.9d', 'No', '', '', 0),
(46, 0, 'Printtopic Mod', 'Generates printable Versions of Topics', 'Unknown', '', '', '', 'No', '', '', 0),
(48, 0, 'Advanced Quick Reply Mod', 'Adds a Quick Reply Box to the Topic View', 'Unknown', '', '', '', 'No', '', '', 0),
(49, 0, 'Fully integrated shoutbox', 'A fully phpBB2 enabled shoutbox witch support: database abstration layer, timezones, languages, templates, smilies, BBcode and censored words', 'Niels', 'ncr@db9.dk', 'http://mods.db9.dk', '1.1.5', 'No', '', '', 0),
(50, 0, 'Smartor Album Add-On: Random or Recent Photo', 'Display a random or recent photo on your forum main page or chosen from a category only.', 'SeekIdeas', 'cfsilent@yahoo.com', 'http://www.seekideas.com', '1.0.0', 'No', '', '', 0),
(52, 0, 'Smilie Creator Mod', 'This Mod adds a BBCode [schild=1]text[/schild] to your phpBB2 whick allows Users to post Smilies with own Text in their postings', 'esperitox', 'bockelmann@powerforum.de', 'http://www.powerforum.de', '1.0.3', 'No', '', '', 0),
(54, 0, 'Staff Site Mod', 'An external site to display who is Mod or Admin on your board. Some additional infos. (see optional part to add other columns)', 'Acid', '', '', '2.2.0', 'No', '', '', 0),
(56, 0, 'Tell a Friend Mod', 'Adds a function to sent Topics as EMail to Friends', 'Unknown', '', '', '1.0.0', 'No', '', '', 0),
(58, 0, 'Today At/Yesterday At Mod', 'Will show Today At if the post was posted today, Will show Yesterday At if the post was posted yesterday', 'akzhaiyk', 'phpbb2xp@myrunet.com', 'http://phpbb2xp.myrunet.com', '1.0.0', 'No', '', '', 0),
(59, 0, 'Who viewed a topic Mod', 'This MOD will add the ability to logged users to see who has already viewed the topic they\\\'re watching. A small image is added to the viewtopic page for this', 'Niels', 'ncr@db9.dk', 'http://mods.db9.dk', '1.0.3', 'No', '', '', 0),
(62, 0, 'Recent Topics (third version)', 'Shows recent topics on an extra site (last 24 hour, last week,yesterday, last x days, today)', 'Acid', '', '', '1.2.0', 'No', '', '', 0),
(66, 0, 'FI SubSilver Template', 'Template FI Subsilver Shadow 2.1.1 - Wonderful Template done by Darren Burnhill from http://www.forumimages.com', 'Darren Burnhill', '', 'http://www.forumimages.com', '2.1.1', 'No', '', '', 0),
(68, 0, 'FI Navslices', 'Adds Navslices to the Viewtopic View with several Actions like EMail to Friend, Printtopic etc..', 'Darren Burnhill', '', 'http://www.forumimages.com', '', 'No', '', '', 0),
(69, 0, 'Private Message Info in Browser Status Bar', 'This MODification adds PM info (you have no new messages, etc..) to the browser status bar.', 'Darren Burnhill', '', 'http://www.forumimages.com', '1.0.0', 'No', '', '', 0),
(71, 0, 'FI SubSilver CodeExpand', 'This MODification changes the Code formatting in posts to use resizable DIVs as well as making it so that the code is automatically selected', 'Darren Burnhill', '', 'http://www.forumimages.com', '1.1.0', 'No', '', '', 0),
(76, 0, 'BBCode Fade Mod', 'This takes the text between the tags and makes it fade away! Starts off normal then as the line continues until it just disappears', 'Brewjah', 'blackhash@rogers.com', 'http://forums.gotdns.com', '1.2.0', 'No', '', '', 0),
(78, 0, 'BBCode Scroll aka Marquee Mod', 'Displays scrolling text using the marquee tag', 'Nuttzy99', 'pktoolkit@blizzhackers.com', 'http://www.blizzhackers.com', '1.2.1', 'No', '', '', 0),
(81, 0, 'BBcode Highlight Mod', 'Adds a highlight bbcode tag to your forum', 'David Smith', 'davidls14@yahoo.com.au', 'http://www27.brinkster.com/bb2c', '1.2.0', 'No', '', '', 0),
(83, 0, 'Macromedia Flash Player BBcode MOD', 'This mod adds a flash tag to your forum, this version removes the need to use the loop param, and if you want you can remove the width and height params as well', 'davidls', 'davidls14@yahoo.com.au', 'http://www27.brinkster.com/bb2c', '2.0.6', 'No', '', '', 0),
(87, 0, 'BBCode FlipV / FlipH Mod', '[flipv]some text[/flipv] and [fliph]some text[/fliph]', 'Brewjah', 'blackhash@rogers.com', '', '1.6.0', 'No', '', '', 0),
(88, 0, 'Streaming audio BBcode Mod', 'adds a stream bbcode tag to your forum for the windows media player plugin', 'David Smith', 'davidls14@yahoo.com.au', 'http://www27.brinkster.com/bb2c', '2.0.0', 'No', '', '', 0),
(91, 0, 'Left and Right IMG tags', 'Adds BBCode to let you align your Pics left and right', 'Nuttzy', 'pktoolkit@blizzhackers.com', 'http://www.blizzhackers.com', '1.6.0', 'No', '', '', 0),
(94, 0, 'PHP Syntax Highlighter BBCode', 'Highlights PHP specific code when used', 'Fubonis', 'php_fubonis@yahoo.com', 'http://www.fubonis.com', '3.0.3', 'No', '', '', 0),
(97, 0, 'Board Statistics Mod', 'The Statistics Mod is a complete statistics core for your phpBB 2 board', 'Acyd Burn, Nivisec', 'acyd.burn@gmx.de', 'http://www.opentools.de/board', '2.1.5', 'No', '', '', 0),
(98, 0, 'Admin Hacks List', 'Adds a list of Hacks/Mods to your phpBB2', 'Nivisec', 'support@nivisec.com', 'http://www.nivisec.com', '1.20', 'No', '', '', 0),
(101, 0, 'Advanced Links Mod', 'Display links (with logo) on the forum index page', 'stefan2k1, CRLin', '', 'http://www.phpbb2.de', '1.2.2', 'No', '', '', 0),
(104, 0, 'Full Database Backup Mod', 'Now you can use the Backup Function in phpBB2 Admin Panel to Backup ALL Tables, even those from your MODs, you make a FULL backup now', 'Unknown', '', '', '1.0.0', 'No', '', '', 0),
(110, 0, 'Topic View Page Bottom Link', 'This MODification adds a link that takes you to the bottom of the topic view pages', 'Darren Burnhill', '', 'http://www.forumimages.com', '1.0.0', 'No', '', '', 0),
(113, 0, 'Smartors Photo Album Addon 2.x View Topic Link', 'This MODification adds a link to the members personal photo gallery for Smartors Photo Album Addon version 2.x on the View Topic pages', 'Darren Burnhill', '', 'http://www.forumimages.com', '1.0.0', 'No', '', '', 0),
(114, 0, 'Smartors Photo Album Addon 2.x Member List Link', 'This MODification adds a link to the members personal photo gallery for Smartors Photo Album Addon version 2.x on the Member List pages', 'Darren Burnhill', '', 'http://www.forumimages.com', '1.0.0', 'No', '', '', 0),
(115, 0, 'Smartors Photo Album Addon 2.x View Profile Link', 'This MODification replaces the link to the members personal photo gallery for Smartors Photo Album Addon version 2.x on the View Profile pages', 'Darren Burnhill', '', 'http://www.forumimages.com', '1.0.0', 'No', '', '', 0),
(118, 0, 'Google Search BBCode', 'Allows you put make strings in your post be searched for in Google. ([google]string to search for[/google])', 'wGEric', 'eric@egcnetwork.com', 'http://eric.best-1.biz ', '1.1.2', 'No', '', '', 0),
(121, 0, 'Yellow Card Mod', 'Also known as \\"card system\\" This mod will make 4 colored buttons beside users post (red,yellow,green and blue)', 'Niels', 'ncr@db9.dk', 'http://mods.db9.dk', '1.4.11', 'No', '', '', 0),
(122, 0, 'Protect user account', 'This mod will prevent hacking on users password, and give the admin the posibilty to specify witch types of passwords are accepted', 'Niels', 'ncr@db9.dk', 'http://mods.db9.dk', '1.2.9', 'No', '', '', 0),
(125, 0, 'BBCode Line-through Mod', 'Adds BBCode with Line-Through words [s] [/s]', 'Acid', '', '', '1.0.2', 'No', '', '', 0),
(128, 0, 'Topic Description Mod', 'This MOD allow you to add a little description of the topic that you have posted', 'Morpheus2matrix', 'morpheus2matrix@caramail.com', 'http://morpheus.2037.biz', '1.0.5', 'No', '', '', 0),
(129, 0, 'Prune users Mod', 'Admin plug-in that makes it posible to delete users who are inactive/haven\\\'t posted or like.', 'Niels', 'ncr@db9.dk', 'http://mods.db9.dk', '1.4.3', 'No', '', '', 0),
(133, 0, 'Admin Add Users Mod', 'Admin can now create a new user, using admin panel user management.', 'Niels', 'ncr@db9.dk', 'http://mods.db9.dk', '0.10.4', 'No', '', '', 0),
(140, 0, 'Count posts Mod', 'Allows you to select if posts in forum are counted upon creation', 'Antony Bailey', '', '', '1.0.0', 'No', '', '', 0),
(142, 0, 'Topic in Who is online', 'This mod will make it possible to view exactly witch topic a user is looking at. The information is applyed in the Who-is-online list', 'Niels', '', 'http://mods.db9.dk', '1.2.9', 'No', '', '', 0),
(145, 0, 'Admin Userlist', 'This MOD will add an userlist into your AdminCP', 'Smartor', 'smartor_xp@hotmail.com', 'http://smartor.is-root.com', '1.1.0', 'No', '', '', 0),
(146, 0, 'Admin Email List', 'This mod will list all email addresses from your phpbb database, within the admin cp', 'Jamer', '', 'http://www.jamer.co.uk/scripts/phpbb2', '1.0.2', 'No', '', '', 0),
(147, 0, 'Bottom aligned signature', 'This mod will align signatures at the bottom of posts', '-=ET=-', 'space_et@tiscali.fr', 'http://www.golfexpert.net/phpbb', '1.0.3', 'No', '', '', 0),
(150, 0, 'Kontakt Mod', 'Adds a contact Form to your Forum', 'Carsten Schaefer', '', '', '1.0.0', 'No', '', '', 0),
(151, 0, 'Mini Cal', 'Provides a mini calendar on your forum index page', 'netclectic', 'phpbb@netclectic.com', 'http://www.netclectic.com', '2.0.4', 'No', '', '', 0),
(152, 0, 'Moved Folder Mod', 'Adds a Moved Folder Image to your Forum', 'Darren Burnhill', '', 'http://www.forumimages.com', '1.0.0', 'No', 'http://www.forumimages.com/info/mods/moved_folder.php', '', 0),
(155, 0, 'Acronym Mod', 'Provides automatic acroymn additions to posts', 'CodeMonkeyX', 'nickyoungso@yahoo.com', 'http://www.codemonkeyx.net', '0.9.5', 'No', '', '', 0),
(156, 0, 'Disable Board Message', 'Customize disable board message', 'Sko22', 'webmaste@quellicheilpc.com', 'http://www.quellicheilpc.com', '1.0.0', 'No', '', '', 0),
(159, 0, 'Signature Editor/Preview Deluxe', 'This mod adds a really cool Signature Editor to your Board, included Preview & Save & BBCodes', 'Ego2000', '', '', '1.0.0', 'No', '', '', 0),
(162, 0, 'Absent User Mod', 'If an user is on holidays, ill or simply not on the board for a longer time, he/she can set to be absent with this mod', 'Oxpus', 'webmaster@oxpus.de', 'http://www.oxpus.de', '1.1.7', 'No', '', '', 0),
(163, 0, 'Album Hierarchy Mod', 'This mod allows to create multiple sub categories of each (sub) categories in the Photo Album Addon', 'IdleVoid', 'idlevoid@slater.dk', '', '1.1.0', 'No', '', '', 0),
(164, 0, 'Portal Polls Upgrade', 'Alters the display and behavior of the Poll Block', 'vgan', 'transflux@msn.com', '', '2.0.0', 'No', '', '', 0),
(165, 0, 'Modcp Extension', 'Extend the moderators control panel to include Sticky / Announce / Normal of topics', 'netclectic', 'adrian@netclectic.com', 'http://www.netclectic.com', '1.1.3', 'No', '', '', 0),
(166, 0, 'Simply Merge Threads', 'This mod allows to merge two topics', 'Ptirhiik', 'admin@rpgnet-fr.com', 'http://www.rpgnet-fr.com', '1.0.1', 'No', '', '', 0),
(167, 0, 'Dates for Humans Mod', 'Allows users to select their date format from a pre-defined selection of examples', 'Lars Janssen', 'lars.dfh@ukmix.net', 'http://www.ukmix.org/', '1.0.1', 'No', '', '', 0),
(168, 0, 'eXtreme Styles mod 2', 'This mod is heavily optimized version of phpBB templates system ', 'CyberAlien', '', 'http://www.phpbbstyles.com/', '2.3.1', 'No', '', '', 0),
(169, 0, 'Google Visit Counter', 'Adds a google bot visit counter on index ', 'Dr DLP', '', 'http://www.web-lapin.levillage.org/forum/', '1.0.0', 'No', '', '', 0),
(170, 0, 'Fix message_die for multiple errors MOD', 'This MOD replaces the message_die was called multiple times message with something more useful', 'markus_petrux', '', 'http://www.phpmix.com', '1.0.3', 'No', '', '', 0),
(171, 0, 'Search Engine ShortURLs Mod', 'This MOD replaces the Forum Links from .php to static .html Links', 'larsneo', '', '', '1.0.0', 'No', '', '', 0),
(172, 0, 'Cracker Tracker Professional 2nd Ed.', 'A fully integrated Security System for your Forum. Blocks known Worm Attacks and Floods.', 'cback', '', 'http://www.cback.de', '4.1.7', 'No', 'http://www.cback.de', '', 0),
(173, 0, 'Run stats', 'Gives stats and details about page time generation, sql requests, indexes used, etc.', 'Ptirhiik', '', 'http://ptifo.clanmckeen.com', '1.0.2', 'No', '', '', 0),
(174, 0, 'Visual Confirmation for Guests', 'Adds visual confirmation for guest posts, eliminating spam.', 'Kanuck', '', 'http://kanuck.net', '1.0.1', 'No', '', '', 0),
(175, 0, 'Custom Profile Fields', 'Allows administrators to add fields to registration/profile/memberlist/topics, plus admin-only fields', 'Blankety Blank Man', '', 'http://edos.siteburg.com/phpBB2/index.php', '1.1.0', 'No', '', '', 0),
(176, 0, 'AJAX features', 'This MOD introduces a lot of features based on the AJAX technology', 'alcaeus', '', 'http://www.alcaeus.org', '1.0.4', 'No', '', '', 0),
(177, 0, 'Advanced Visual Confirmation', 'This MOD replaces the original CAPTCHA of the phpBB Visual Confirmation.', 'AmigaLink', '', 'http://www.EssenMitFreude.info', '1.1.0', 'No', '', '', 0);


INSERT INTO phpbb_ct_filter (id, list) VALUES (1, 'WebStripper');
INSERT INTO phpbb_ct_filter (id, list) VALUES (2, 'NetMechanic');
INSERT INTO phpbb_ct_filter (id, list) VALUES (3, 'CherryPicker');
INSERT INTO phpbb_ct_filter (id, list) VALUES (4, 'EmailCollector');
INSERT INTO phpbb_ct_filter (id, list) VALUES (5, 'EmailSiphon');
INSERT INTO phpbb_ct_filter (id, list) VALUES (6, 'WebBandit');
INSERT INTO phpbb_ct_filter (id, list) VALUES (7, 'EmailWolf');
INSERT INTO phpbb_ct_filter (id, list) VALUES (8, 'ExtractorPro');
INSERT INTO phpbb_ct_filter (id, list) VALUES (9, 'SiteSnagger');
INSERT INTO phpbb_ct_filter (id, list) VALUES (10, 'CheeseBot');
INSERT INTO phpbb_ct_filter (id, list) VALUES (11, 'ia_archiver/1.6');
INSERT INTO phpbb_ct_filter (id, list) VALUES (12, 'Website Quester');
INSERT INTO phpbb_ct_filter (id, list) VALUES (13, 'WebZip');
INSERT INTO phpbb_ct_filter (id, list) VALUES (14, 'moget/2.1');
INSERT INTO phpbb_ct_filter (id, list) VALUES (15, 'WebSauger');
INSERT INTO phpbb_ct_filter (id, list) VALUES (16, 'WebCopier');
INSERT INTO phpbb_ct_filter (id, list) VALUES (17, 'WWW-Collector-E');
INSERT INTO phpbb_ct_filter (id, list) VALUES (18, 'InfoNaviRobot');
INSERT INTO phpbb_ct_filter (id, list) VALUES (19, 'Harvest/1.5');
INSERT INTO phpbb_ct_filter (id, list) VALUES (20, 'Bullseye/1.0');
INSERT INTO phpbb_ct_filter (id, list) VALUES (21, 'lwp-trivial/1.34');
INSERT INTO phpbb_ct_filter (id, list) VALUES (22, 'lwp-trivial');
INSERT INTO phpbb_ct_filter (id, list) VALUES (23, 'LinkWalker');
INSERT INTO phpbb_ct_filter (id, list) VALUES (24, 'LinkextractorPro');
INSERT INTO phpbb_ct_filter (id, list) VALUES (25, 'Offline Explorer');
INSERT INTO phpbb_ct_filter (id, list) VALUES (26, 'BlowFish/1.0');
INSERT INTO phpbb_ct_filter (id, list) VALUES (27, 'WebEnhancer');
INSERT INTO phpbb_ct_filter (id, list) VALUES (28, 'TightTwatBot');
INSERT INTO phpbb_ct_filter (id, list) VALUES (29, 'LinkScan/8.1a Unix');
INSERT INTO phpbb_ct_filter (id, list) VALUES (30, 'WebDownloader');
INSERT INTO phpbb_ct_filter (id, list) VALUES (31, 'lwp-trivial/1.33');
INSERT INTO phpbb_ct_filter (id, list) VALUES (32, 'lwp-trivial/1.38');
INSERT INTO phpbb_ct_filter (id, list) VALUES (33, 'BruteForce');
INSERT INTO phpbb_ct_filter (id, list) VALUES (34, 'lwp');

INSERT INTO phpbb_ctrack (name, value) VALUES ('lastreg', '0');
INSERT INTO phpbb_ctrack (name, value) VALUES ('version', '4.1.7');
INSERT INTO phpbb_ctrack (name, value) VALUES ('footer', '3');
INSERT INTO phpbb_ctrack (name, value) VALUES ('floodlog', '100');
INSERT INTO phpbb_ctrack (name, value) VALUES ('proxylog', '100');
INSERT INTO phpbb_ctrack (name, value) VALUES ('filter', '1');
INSERT INTO phpbb_ctrack (name, value) VALUES ('floodprot', '1');
INSERT INTO phpbb_ctrack (name, value) VALUES ('maxsearch', '4');
INSERT INTO phpbb_ctrack (name, value) VALUES ('searchtime', '16');
INSERT INTO phpbb_ctrack (name, value) VALUES ('regblock', '1');
INSERT INTO phpbb_ctrack (name, value) VALUES ('regtime', '10');
INSERT INTO phpbb_ctrack (name, value) VALUES ('autoban', '1');
INSERT INTO phpbb_ctrack (name, value) VALUES ('posttimespan', '200');
INSERT INTO phpbb_ctrack (name, value) VALUES ('postintime', '10');
INSERT INTO phpbb_ctrack (name, value) VALUES ('lastreg_ip', '000.000.000.000');
INSERT INTO phpbb_ctrack (name, value) VALUES ('mailfeature', '1');
INSERT INTO phpbb_ctrack (name, value) VALUES ('pwreset', '1');
INSERT INTO phpbb_ctrack (name, value) VALUES ('loginfeature', '1');

INSERT INTO `phpbb_captcha_config` VALUES ('width', '320');
INSERT INTO `phpbb_captcha_config` VALUES ('height', '60');
INSERT INTO `phpbb_captcha_config` VALUES ('background_color', '#E5ECF9');
INSERT INTO `phpbb_captcha_config` VALUES ('jpeg', '0');
INSERT INTO `phpbb_captcha_config` VALUES ('jpeg_quality', '50');
INSERT INTO `phpbb_captcha_config` VALUES ('pre_letters', '0');
INSERT INTO `phpbb_captcha_config` VALUES ('pre_letters_great', '0');
INSERT INTO `phpbb_captcha_config` VALUES ('font', '0');
INSERT INTO `phpbb_captcha_config` VALUES ('chess', '0');
INSERT INTO `phpbb_captcha_config` VALUES ('ellipses', '1');
INSERT INTO `phpbb_captcha_config` VALUES ('arcs', '0');
INSERT INTO `phpbb_captcha_config` VALUES ('lines', '1');
INSERT INTO `phpbb_captcha_config` VALUES ('image', '0');
INSERT INTO `phpbb_captcha_config` VALUES ('gammacorrect', '0.8');
INSERT INTO `phpbb_captcha_config` VALUES ('foreground_lattice_x', '15');
INSERT INTO `phpbb_captcha_config` VALUES ('foreground_lattice_y', '15');
INSERT INTO `phpbb_captcha_config` VALUES ('lattice_color', '#FFFFFF');


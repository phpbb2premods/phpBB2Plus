<?php
/***************************************************************************
 *                            lang_main.php [English]
 *                              -------------------
 *     begin                : Sat Dec 16 2000
 *     copyright            : (C) 2001 The phpBB Group
 *     email                : support@phpbb.com
 *
 *     $Id: lang_main.php,v 1.85.2.15 2003/06/10 00:31:19 psotfx Exp $
 *
 ****************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

//
// CONTRIBUTORS:
//	 Add your details here if wanted, e.g. Name, username, email address, website
// 2002-08-27  Philip M. White        - fixed many grammar problems
//

//
// The format of this file is ---> $lang['message'] = 'text';
//
// You should also try to set a locale and a character encoding (plus direction). The encoding and direction
// will be sent to the template. The locale may or may not work, it's dependent on OS support and the syntax
// varies ... give it your best guess!
//

$lang['ENCODING'] = 'iso-8859-1';
$lang['DIRECTION'] = 'ltr';
$lang['LEFT'] = 'left';
$lang['RIGHT'] = 'right';
$lang['DATE_FORMAT'] =  'd M Y'; // This should be changed to the default date format for your language, php date() format

// This is optional, if you would like a _SHORT_ message output
// along with our copyright message indicating you are the translator
// please add it here.
// $lang['TRANSLATION'] = '';

//
// Common, these terms are used
// extensively on several pages
//
$lang['Forum'] = 'Forum';
$lang['Category'] = 'Category';
$lang['Topic'] = 'Topic';
$lang['Topics'] = 'Topics';
$lang['Replies'] = 'Replies';
$lang['Views'] = 'Views';
$lang['Post'] = 'Post';
$lang['Posts'] = 'Posts';
$lang['Posted'] = 'Posted';
$lang['Username'] = 'Username';
$lang['Password'] = 'Password';
$lang['Email'] = 'Email';
$lang['Poster'] = 'Poster';
$lang['Author'] = 'Author';
$lang['Time'] = 'Time';
$lang['Hours'] = 'Hours';
$lang['Message'] = 'Message';

$lang['1_Day'] = '1 Day';
$lang['7_Days'] = '7 Days';
$lang['2_Weeks'] = '2 Weeks';
$lang['1_Month'] = '1 Month';
$lang['3_Months'] = '3 Months';
$lang['6_Months'] = '6 Months';
$lang['1_Year'] = '1 Year';

$lang['Go'] = 'Go';
$lang['Jump_to'] = 'Jump to';
$lang['Submit'] = 'Submit';
$lang['Reset'] = 'Reset';
$lang['Cancel'] = 'Cancel';
$lang['Preview'] = 'Preview';
$lang['Confirm'] = 'Confirm';
$lang['Spellcheck'] = 'Spellcheck';
$lang['Yes'] = 'Yes';
$lang['No'] = 'No';
$lang['Enabled'] = 'Enabled';
$lang['Disabled'] = 'Disabled';
$lang['Error'] = 'Error';

$lang['Next'] = 'Next';
$lang['Previous'] = 'Previous';
$lang['Goto_page'] = 'Goto page';
$lang['Joined'] = 'Joined';
$lang['IP_Address'] = 'IP Address';

$lang['Select_forum'] = 'Select a forum';
$lang['View_latest_post'] = 'View latest post';
$lang['View_newest_post'] = 'View newest post';
$lang['Page_of'] = 'Page <b>%d</b> of <b>%d</b>'; // Replaces with: Page 1 of 2 for example

$lang['ICQ'] = 'ICQ Number';
$lang['AIM'] = 'AIM Address';
$lang['MSNM'] = 'MSN Messenger';
$lang['YIM'] = 'Yahoo Messenger';

$lang['Forum_Index'] = '%s Forum Index';  // eg. sitename Forum Index, %s can be removed if you prefer

$lang['Post_new_topic'] = 'Post new topic';
$lang['Reply_to_topic'] = 'Reply to topic';
$lang['Reply_with_quote'] = 'Reply with quote';

$lang['Click_return_topic'] = 'Click %sHere%s to return to the topic'; // %s's here are for uris, do not remove!
$lang['Click_return_login'] = 'Click %sHere%s to try again';
$lang['Click_return_forum'] = 'Click %sHere%s to return to the forum';
$lang['Click_view_message'] = 'Click %sHere%s to view your message';
$lang['Click_return_modcp'] = 'Click %sHere%s to return to the Moderator Control Panel';
$lang['Click_return_group'] = 'Click %sHere%s to return to group information';

$lang['Admin_panel'] = 'Go to Administration Panel';

$lang['Board_disable'] = 'Sorry, but this board is currently unavailable.  Please try again later.';


//
// Global Header strings
//
$lang['Registered_users'] = 'Registered Users:';
$lang['Browsing_forum'] = 'Users browsing this forum:';
$lang['Online_users_zero_total'] = 'In total there are <b>0</b> users online :: ';
$lang['Online_users_total'] = 'In total there are <b>%d</b> users online :: ';
$lang['Online_user_total'] = 'In total there is <b>%d</b> user online :: ';
$lang['Reg_users_zero_total'] = '0 Registered, ';
$lang['Reg_users_total'] = '%d Registered, ';
$lang['Reg_user_total'] = '%d Registered, ';
$lang['Hidden_users_zero_total'] = '0 Hidden and ';
$lang['Hidden_user_total'] = '%d Hidden and ';
$lang['Hidden_users_total'] = '%d Hidden and ';
$lang['Guest_users_zero_total'] = '0 Guests';
$lang['Guest_users_total'] = '%d Guests';
$lang['Guest_user_total'] = '%d Guest';
$lang['Record_online_users'] = 'Most users ever online was <b>%s</b> on %s'; // first %s = number of users, second %s is the date.

$lang['Admin_online_color'] = '%sAdministrator%s';
$lang['Mod_online_color'] = '%sModerator%s';

$lang['You_last_visit'] = 'You last visited on %s'; // %s replaced by date/time
$lang['Current_time'] = 'The time now is %s'; // %s replaced by time

$lang['Search_new'] = 'View posts since last visit';
$lang['Search_new_p'] = 'View posts since <br />last visit';
$lang['Search_your_posts'] = 'View your posts';
$lang['Search_unanswered'] = 'View unanswered posts';

$lang['Register'] = 'Register';
$lang['Profile'] = 'Profile';
$lang['Edit_profile'] = 'Edit your profile';
$lang['Search'] = 'Search';
$lang['Memberlist'] = 'Memberlist';
$lang['FAQ'] = 'FAQ';
$lang['BBCode_guide'] = 'BBCode Guide';
$lang['Usergroups'] = 'Usergroups';
$lang['Last_Post'] = 'Last Post';
$lang['Moderator'] = 'Moderator';
$lang['Moderators'] = 'Moderators';


//
// Stats block text
//
$lang['Posted_articles_zero_total'] = 'Our users have posted a total of <b>0</b> articles'; // Number of posts
$lang['Posted_articles_total'] = 'Our users have posted a total of <b>%d</b> articles'; // Number of posts
$lang['Posted_article_total'] = 'Our users have posted a total of <b>%d</b> article'; // Number of posts
$lang['Registered_users_zero_total'] = 'We have <b>0</b> registered users'; // # registered users
$lang['Registered_users_total'] = 'We have <b>%d</b> registered users'; // # registered users
$lang['Registered_user_total'] = 'We have <b>%d</b> registered user'; // # registered users
$lang['Newest_user'] = 'The newest registered user is <b>%s%s%s</b>'; // a href, username, /a 

$lang['No_new_posts_last_visit'] = 'No new posts since your last visit';
$lang['No_new_posts'] = 'No new posts';
$lang['New_posts'] = 'New posts';
$lang['New_post'] = 'New post';
$lang['No_new_posts_hot'] = 'No new posts [ Popular ]';
$lang['New_posts_hot'] = 'New posts [ Popular ]';
$lang['No_new_posts_locked'] = 'No new posts [ Locked ]';
$lang['New_posts_locked'] = 'New posts [ Locked ]';
$lang['Forum_is_locked'] = 'Forum is locked';


//
// Login
//
$lang['Enter_password'] = 'Please enter your username and password to log in.';
$lang['Login'] = 'Log in';
$lang['Logout'] = 'Log out';

$lang['Forgotten_password'] = 'I forgot my password';

$lang['Log_me_in'] = 'Log me on automatically each visit';

$lang['Error_login'] = 'You have specified an incorrect or inactive username, or an invalid password.';


//
// Index page
//
$lang['Index'] = 'Index';
$lang['No_Posts'] = 'No Posts';
$lang['No_forums'] = 'This board has no forums';

$lang['Private_Message'] = 'Private Message';
$lang['Private_Messages'] = 'Private Messages';
$lang['Who_is_Online'] = 'Who is Online';

$lang['Mark_all_forums'] = 'Mark all forums read';
$lang['Forums_marked_read'] = 'All forums have been marked read';


//
// Viewforum
//
$lang['View_forum'] = 'View Forum';

$lang['Forum_not_exist'] = 'The forum you selected does not exist.';
$lang['Reached_on_error'] = 'You have reached this page in error.';

$lang['Display_topics'] = 'Display topics from previous';
$lang['All_Topics'] = 'All Topics';

$lang['Topic_Announcement'] = '<b>Announcement:</b>';
$lang['Topic_Sticky'] = '<b>Sticky:</b>';
$lang['Topic_Moved'] = '<b>Moved:</b>';
$lang['Topic_Poll'] = '<b>[ Poll ]</b>';

$lang['Mark_all_topics'] = 'Mark all topics read';
$lang['Topics_marked_read'] = 'The topics for this forum have now been marked read';

$lang['Rules_post_can'] = 'You <b>can</b> post new topics in this forum';
$lang['Rules_post_cannot'] = 'You <b>cannot</b> post new topics in this forum';
$lang['Rules_reply_can'] = 'You <b>can</b> reply to topics in this forum';
$lang['Rules_reply_cannot'] = 'You <b>cannot</b> reply to topics in this forum';
$lang['Rules_edit_can'] = 'You <b>can</b> edit your posts in this forum';
$lang['Rules_edit_cannot'] = 'You <b>cannot</b> edit your posts in this forum';
$lang['Rules_delete_can'] = 'You <b>can</b> delete your posts in this forum';
$lang['Rules_delete_cannot'] = 'You <b>cannot</b> delete your posts in this forum';
$lang['Rules_vote_can'] = 'You <b>can</b> vote in polls in this forum';
$lang['Rules_vote_cannot'] = 'You <b>cannot</b> vote in polls in this forum';
$lang['Rules_moderate'] = 'You <b>can</b> %smoderate this forum%s'; // %s replaced by a href links, do not remove! 

$lang['No_topics_post_one'] = 'There are no posts in this forum.<br />Click on the <b>Post New Topic</b> link on this page to post one.';


//
// Viewtopic
//
$lang['View_topic'] = 'View topic';

$lang['Guest'] = 'Guest';
$lang['Post_subject'] = 'Post subject';
$lang['View_next_topic'] = 'View next topic';
$lang['View_previous_topic'] = 'View previous topic';
$lang['Submit_vote'] = 'Submit Vote';
$lang['View_results'] = 'View Results';
$lang['View_ballot'] = 'View Ballot';

$lang['No_newer_topics'] = 'There are no newer topics in this forum';
$lang['No_older_topics'] = 'There are no older topics in this forum';
$lang['Topic_post_not_exist'] = 'The topic or post you requested does not exist';
$lang['No_posts_topic'] = 'No posts exist for this topic';

$lang['Display_posts'] = 'Display posts from previous';
$lang['All_Posts'] = 'All Posts';
$lang['Newest_First'] = 'Newest First';
$lang['Oldest_First'] = 'Oldest First';

$lang['Back_to_top'] = 'Back to top';

$lang['Read_profile'] = 'View user\'s profile'; 
$lang['Send_email'] = 'Send e-mail to user';
$lang['Visit_website'] = 'Visit poster\'s website';
$lang['ICQ_status'] = 'ICQ Status';
$lang['Edit_delete_post'] = 'Edit/Delete this post';
$lang['View_IP'] = 'View IP address of poster';
$lang['Delete_post'] = 'Delete this post';

$lang['wrote'] = 'wrote'; // proceeds the username and is followed by the quoted text
$lang['Quote'] = 'Quote'; // comes before bbcode quote output.
$lang['Code'] = 'Code'; // comes before bbcode code output.

$lang['Edited_time_total'] = 'Last edited by %s on %s; edited %d time in total'; // Last edited by me on 12 Oct 2001; edited 1 time in total
$lang['Edited_times_total'] = 'Last edited by %s on %s; edited %d times in total'; // Last edited by me on 12 Oct 2001; edited 2 times in total

$lang['Lock_topic'] = 'Lock this topic';
$lang['Unlock_topic'] = 'Unlock this topic';
$lang['Move_topic'] = 'Move this topic';
$lang['Delete_topic'] = 'Delete this topic';
$lang['Split_topic'] = 'Split this topic';

$lang['Stop_watching_topic'] = 'Stop watching this topic';
$lang['Start_watching_topic'] = 'Watch this topic for replies';
$lang['No_longer_watching'] = 'You are no longer watching this topic';
$lang['You_are_watching'] = 'You are now watching this topic';

$lang['Total_votes'] = 'Total Votes';

$lang['Full_edit'] = 'Switch to full edit form';
$lang['Save_changes'] = 'Save';
$lang['No_subject'] = '(No subject)';

//
// Posting/Replying (Not private messaging!)
//
$lang['Message_body'] = 'Message body';
$lang['Topic_review'] = 'Topic review';

$lang['No_post_mode'] = 'No post mode specified'; // If posting.php is called without a mode (newtopic/reply/delete/etc, shouldn't be shown normaly)

$lang['Post_a_new_topic'] = 'Post a new topic';
$lang['Post_a_reply'] = 'Post a reply';
$lang['Post_topic_as'] = 'Post topic as';
$lang['Edit_Post'] = 'Edit post';
$lang['Options'] = 'Options';

$lang['Post_Announcement'] = 'Announcement';
$lang['Post_Sticky'] = 'Sticky';
$lang['Post_Normal'] = 'Normal';

$lang['Confirm_delete'] = 'Are you sure you want to delete this post?';
$lang['Confirm_delete_poll'] = 'Are you sure you want to delete this poll?';

$lang['Flood_Error'] = 'You cannot make another post so soon after your last; please try again in a short while.';
$lang['Empty_subject'] = 'You must specify a subject when posting a new topic.';
$lang['Empty_message'] = 'You must enter a message when posting.';
$lang['Forum_locked'] = 'This forum is locked: you cannot post, reply to, or edit topics.';
$lang['Topic_locked'] = 'This topic is locked: you cannot edit posts or make replies.';
$lang['No_post_id'] = 'You must select a post to edit';
$lang['No_topic_id'] = 'You must select a topic to reply to';
$lang['No_valid_mode'] = 'You can only post, reply, edit, or quote messages. Please return and try again.';
$lang['No_such_post'] = 'There is no such post. Please return and try again.';
$lang['Edit_own_posts'] = 'Sorry, but you can only edit your own posts.';
$lang['Delete_own_posts'] = 'Sorry, but you can only delete your own posts.';
$lang['Cannot_delete_replied'] = 'Sorry, but you may not delete posts that have been replied to.';
$lang['Cannot_delete_poll'] = 'Sorry, but you cannot delete an active poll.';
$lang['Empty_poll_title'] = 'You must enter a title for your poll.';
$lang['To_few_poll_options'] = 'You must enter at least two poll options.';
$lang['To_many_poll_options'] = 'You have tried to enter too many poll options.';
$lang['Post_has_no_poll'] = 'This post has no poll.';
$lang['Already_voted'] = 'You have already voted in this poll.';
$lang['No_vote_option'] = 'You must specify an option when voting.';

$lang['Add_poll'] = 'Add a Poll';
$lang['Add_poll_explain'] = 'If you do not want to add a poll to your topic, leave the fields blank.';
$lang['Poll_question'] = 'Poll question';
$lang['Poll_option'] = 'Poll option';
$lang['Add_option'] = 'Add option';
$lang['Update'] = 'Update';
$lang['Delete'] = 'Delete';
$lang['Poll_for'] = 'Run poll for';
$lang['Days'] = 'Days'; // This is used for the Run poll for ... Days + in admin_forums for pruning
$lang['Poll_for_explain'] = '[ Enter 0 or leave blank for a never-ending poll ]';
$lang['Delete_poll'] = 'Delete Poll';

$lang['Disable_HTML_post'] = 'Disable HTML in this post';
$lang['Disable_BBCode_post'] = 'Disable BBCode in this post';
$lang['Disable_Smilies_post'] = 'Disable Smilies in this post';

$lang['HTML_is_ON'] = 'HTML is <u>ON</u>';
$lang['HTML_is_OFF'] = 'HTML is <u>OFF</u>';
$lang['BBCode_is_ON'] = '%sBBCode%s is <u>ON</u>'; // %s are replaced with URI pointing to FAQ
$lang['BBCode_is_OFF'] = '%sBBCode%s is <u>OFF</u>';
$lang['Smilies_are_ON'] = 'Smilies are <u>ON</u>';
$lang['Smilies_are_OFF'] = 'Smilies are <u>OFF</u>';

$lang['Attach_signature'] = 'Attach signature (signatures can be changed in profile)';
$lang['Notify'] = 'Notify me when a reply is posted';
$lang['Delete_post'] = 'Delete this post';

$lang['Stored'] = 'Your message has been entered successfully.';
$lang['Deleted'] = 'Your message has been deleted successfully.';
$lang['Poll_delete'] = 'Your poll has been deleted successfully.';
$lang['Vote_cast'] = 'Your vote has been cast.';

$lang['Topic_reply_notification'] = 'Topic Reply Notification';

$lang['bbcode_b_help'] = 'Bold text: [b]text[/b]  (alt+b)';
$lang['bbcode_i_help'] = 'Italic text: [i]text[/i]  (alt+i)';
$lang['bbcode_u_help'] = 'Underline text: [u]text[/u]  (alt+u)';
$lang['bbcode_q_help'] = 'Quote text: [quote]text[/quote]  (alt+q)';
$lang['bbcode_c_help'] = 'Code display: [code]code[/code]  (alt+c)';
$lang['bbcode_l_help'] = 'List: [list]text[/list] (alt+l)';
$lang['bbcode_o_help'] = 'Ordered list: [list=]text[/list]  (alt+o)';
$lang['bbcode_p_help'] = 'Insert image: [img]http://image_url[/img]  (alt+p)';
$lang['bbcode_w_help'] = 'Insert URL: [url]http://url[/url] or [url=http://url]URL text[/url]  (alt+w)';
$lang['bbcode_a_help'] = 'Close all open bbCode tags';
$lang['bbcode_s_help'] = 'Font color: [color=red]text[/color]  Tip: you can also use color=#FF0000';
$lang['bbcode_f_help'] = 'Font size: [size=x-small]small text[/size]';

$lang['Emoticons'] = 'Emoticons';
$lang['More_emoticons'] = 'View more Emoticons';

$lang['Font_color'] = 'Font colour';
$lang['color_default'] = 'Default';
$lang['color_dark_red'] = 'Dark Red';
$lang['color_red'] = 'Red';
$lang['color_orange'] = 'Orange';
$lang['color_brown'] = 'Brown';
$lang['color_yellow'] = 'Yellow';
$lang['color_green'] = 'Green';
$lang['color_olive'] = 'Olive';
$lang['color_cyan'] = 'Cyan';
$lang['color_blue'] = 'Blue';
$lang['color_dark_blue'] = 'Dark Blue';
$lang['color_indigo'] = 'Indigo';
$lang['color_violet'] = 'Violet';
$lang['color_white'] = 'White';
$lang['color_black'] = 'Black';

$lang['Font_size'] = 'Font size';
$lang['font_tiny'] = 'Tiny';
$lang['font_small'] = 'Small';
$lang['font_normal'] = 'Normal';
$lang['font_large'] = 'Large';
$lang['font_huge'] = 'Huge';

$lang['Close_Tags'] = 'Close Tags';
$lang['Styles_tip'] = 'Tip: Styles can be applied quickly to selected text.';

$lang['AJAX_search_results'] = 'A quick search has found %s topics with the keywords in your topic title. Click here to view these topics';
$lang['AJAX_search_result'] = 'A quick search has found one topic with the keywords in your topic title. Click here to view this topic';

$lang['AJAX_features'] = 'AJAX features';
$lang['AJAX_use_preview'] = 'AJAX message preview';
$lang['AJAX_use_edit'] = 'AJAX quickedit';

//
// Private Messaging
//
$lang['Private_Messaging'] = 'Private Messaging';

$lang['Login_check_pm'] = 'Log in to check your private messages';
$lang['New_pms'] = 'You have %d new messages'; // You have 2 new messages
$lang['New_pm'] = 'You have %d new message'; // You have 1 new message
$lang['No_new_pm'] = 'You have no new messages';
$lang['Unread_pms'] = 'You have %d unread messages';
$lang['Unread_pm'] = 'You have %d unread message';
$lang['No_unread_pm'] = 'You have no unread messages';
$lang['You_new_pm'] = 'A new private message is waiting for you in your Inbox';
$lang['You_new_pms'] = 'New private messages are waiting for you in your Inbox';
$lang['You_no_new_pm'] = 'No new private messages are waiting for you';

$lang['Unread_message'] = 'Unread message';
$lang['Read_message'] = 'Read message';

$lang['Read_pm'] = 'Read message';
$lang['Post_new_pm'] = 'Post message';
$lang['Post_reply_pm'] = 'Reply to message';
$lang['Post_quote_pm'] = 'Quote message';
$lang['Edit_pm'] = 'Edit message';

$lang['Inbox'] = 'Inbox';
$lang['Outbox'] = 'Outbox';
$lang['Savebox'] = 'Savebox';
$lang['Sentbox'] = 'Sentbox';
$lang['Flag'] = 'Flag';
$lang['Subject'] = 'Subject';
$lang['From'] = 'From';
$lang['To'] = 'To';
$lang['Date'] = 'Date';
$lang['Mark'] = 'Mark';
$lang['Sent'] = 'Sent';
$lang['Saved'] = 'Saved';
$lang['Delete_marked'] = 'Delete Marked';
$lang['Delete_all'] = 'Delete All';
$lang['Save_marked'] = 'Save Marked'; 
$lang['Save_message'] = 'Save Message';
$lang['Delete_message'] = 'Delete Message';

$lang['Display_messages'] = 'Display messages from previous'; // Followed by number of days/weeks/months
$lang['All_Messages'] = 'All Messages';

$lang['No_messages_folder'] = 'You have no messages in this folder';

$lang['PM_disabled'] = 'Private messaging has been disabled on this board.';
$lang['Cannot_send_privmsg'] = 'Sorry, but the administrator has prevented you from sending private messages.';
$lang['No_to_user'] = 'You must specify a username to whom to send this message.';
$lang['No_such_user'] = 'Sorry, but no such user exists.';

$lang['Disable_HTML_pm'] = 'Disable HTML in this message';
$lang['Disable_BBCode_pm'] = 'Disable BBCode in this message';
$lang['Disable_Smilies_pm'] = 'Disable Smilies in this message';

$lang['Message_sent'] = 'Your message has been sent.';

$lang['Click_return_inbox'] = 'Click %sHere%s to return to your Inbox';
$lang['Click_return_index'] = 'Click %sHere%s to return to the Index';

$lang['Send_a_new_message'] = 'Send a new private message';
$lang['Send_a_reply'] = 'Reply to a private message';
$lang['Edit_message'] = 'Edit private message';

$lang['Notification_subject'] = 'New Private Message has arrived!';

$lang['Find_username'] = 'Find a username';
$lang['Find'] = 'Find';
$lang['No_match'] = 'No matches found.';

$lang['No_post_id'] = 'No post ID was specified';
$lang['No_such_folder'] = 'No such folder exists';
$lang['No_folder'] = 'No folder specified';

$lang['Mark_all'] = 'Mark all';
$lang['Unmark_all'] = 'Unmark all';

$lang['Confirm_delete_pm'] = 'Are you sure you want to delete this message?';
$lang['Confirm_delete_pms'] = 'Are you sure you want to delete these messages?';

$lang['Inbox_size'] = 'Your Inbox is %d%% full'; // eg. Your Inbox is 50% full
$lang['Sentbox_size'] = 'Your Sentbox is %d%% full'; 
$lang['Savebox_size'] = 'Your Savebox is %d%% full'; 

$lang['Click_view_privmsg'] = 'Click %sHere%s to visit your Inbox';

$lang['More_matches_username'] = 'More than one username matched your query. Please select a user from the box above.';
$lang['No_username'] = 'You must enter a username.';

//
// Profiles/Registration
//
$lang['Viewing_user_profile'] = 'Viewing profile :: %s'; // %s is username 
$lang['About_user'] = 'All about %s'; // %s is username

$lang['Preferences'] = 'Preferences';
$lang['Items_required'] = 'Items marked with a * are required unless stated otherwise.';
$lang['Registration_info'] = 'Registration Information';
$lang['Profile_info'] = 'Profile Information';
$lang['Profile_info_warn'] = 'This information will be publicly viewable';
$lang['Avatar_panel'] = 'Avatar control panel';
$lang['Avatar_gallery'] = 'Avatar gallery';

$lang['Website'] = 'Website';
$lang['Location'] = 'Location';
$lang['Contact'] = 'Contact';
$lang['Email_address'] = 'E-mail address';
$lang['Email'] = 'E-mail';
$lang['Send_private_message'] = 'Send private message';
$lang['Hidden_email'] = '[ Hidden ]';
$lang['Search_user_posts'] = 'Search for posts by this user';
$lang['Interests'] = 'Interests';
$lang['Occupation'] = 'Occupation'; 
$lang['Poster_rank'] = 'Poster rank';

$lang['Total_posts'] = 'Total posts';
$lang['User_post_pct_stats'] = '%.2f%% of total'; // 1.25% of total
$lang['User_post_day_stats'] = '%.2f posts per day'; // 1.5 posts per day
$lang['Search_user_posts'] = 'Find all posts by %s'; // Find all posts by username

$lang['No_user_id_specified'] = 'Sorry, but that user does not exist.';
$lang['Wrong_Profile'] = 'You cannot modify a profile that is not your own.';

$lang['Only_one_avatar'] = 'Only one type of avatar can be specified';
$lang['File_no_data'] = 'The file at the URL you gave contains no data';
$lang['No_connection_URL'] = 'A connection could not be made to the URL you gave';
$lang['Incomplete_URL'] = 'The URL you entered is incomplete';
$lang['Wrong_remote_avatar_format'] = 'The URL of the remote avatar is not valid';
$lang['No_send_account_inactive'] = 'Sorry, but your password cannot be retrieved because your account is currently inactive. Please contact the forum administrator for more information.';

$lang['Always_smile'] = 'Always enable Smilies';
$lang['Always_html'] = 'Always allow HTML';
$lang['Always_bbcode'] = 'Always allow BBCode';
$lang['Always_add_sig'] = 'Always attach my signature';
$lang['Always_notify'] = 'Always notify me of replies';
$lang['Always_notify_explain'] = 'Sends an e-mail when someone replies to a topic you have posted in. This can be changed whenever you post.';

$lang['Board_style'] = 'Board Style';
$lang['Board_lang'] = 'Board Language';
$lang['No_themes'] = 'No Themes In database';
$lang['Timezone'] = 'Timezone';
$lang['Date_format'] = 'Date format';
$lang['Date_format_explain'] = 'The syntax used is identical to the PHP <a href=\'http://www.php.net/date\' target=\'_other\'>date()</a> function.';
$lang['Signature'] = 'Signature';
$lang['Signature_explain'] = 'This is a block of text that can be added to posts you make. There is a %d character limit';
$lang['Public_view_email'] = 'Always show my e-mail address';

$lang['Current_password'] = 'Current password';
$lang['New_password'] = 'New password';
$lang['Confirm_password'] = 'Confirm password';
$lang['Confirm_password_explain'] = 'You must confirm your current password if you wish to change it or alter your e-mail address';
$lang['password_if_changed'] = 'You only need to supply a password if you want to change it';
$lang['password_confirm_if_changed'] = 'You only need to confirm your password if you changed it above';

$lang['Avatar'] = 'Avatar';
$lang['Avatar_explain'] = 'Displays a small graphic image below your details in posts. Only one image can be displayed at a time, its width can be no greater than %d pixels, the height no greater than %d pixels, and the file size no more than %d KB.';
$lang['Upload_Avatar_file'] = 'Upload Avatar from your machine';
$lang['Upload_Avatar_URL'] = 'Upload Avatar from a URL';
$lang['Upload_Avatar_URL_explain'] = 'Enter the URL of the location containing the Avatar image, it will be copied to this site.';
$lang['Pick_local_Avatar'] = 'Select Avatar from the gallery';
$lang['Link_remote_Avatar'] = 'Link to off-site Avatar';
$lang['Link_remote_Avatar_explain'] = 'Enter the URL of the location containing the Avatar image you wish to link to.';
$lang['Avatar_URL'] = 'URL of Avatar Image';
$lang['Select_from_gallery'] = 'Select Avatar from gallery';
$lang['View_avatar_gallery'] = 'Show gallery';

$lang['Select_avatar'] = 'Select avatar';
$lang['Return_profile'] = 'Cancel avatar';
$lang['Select_category'] = 'Select category';

$lang['Delete_Image'] = 'Delete Image';
$lang['Current_Image'] = 'Current Image';

$lang['Notify_on_privmsg'] = 'Notify on new Private Message';
$lang['Popup_on_privmsg'] = 'Pop up window on new Private Message'; 
$lang['Popup_on_privmsg_explain'] = 'Some templates may open a new window to inform you when new private messages arrive.';
$lang['Hide_user'] = 'Hide your online status';

$lang['Profile_updated'] = 'Your profile has been updated';
$lang['Profile_updated_inactive'] = 'Your profile has been updated. However, you have changed vital details, thus your account is now inactive. Check your e-mail to find out how to reactivate your account, or if admin activation is required, wait for the administrator to reactivate it.';

$lang['Password_mismatch'] = 'The passwords you entered did not match.';
$lang['Current_password_mismatch'] = 'The current password you supplied does not match that stored in the database.';
$lang['Password_long'] = 'Your password must be no more than 32 characters.';
$lang['Too_many_registers'] = 'You have made too many registration attempts. Please try again later.';
$lang['Username_taken'] = 'Sorry, but this username has already been taken.';
$lang['Username_invalid'] = 'Sorry, but this username contains an invalid character such as \'.';
$lang['Username_disallowed'] = 'Sorry, but this username has been disallowed.';
$lang['Email_taken'] = 'Sorry, but that e-mail address is already registered to a user.';
$lang['Email_banned'] = 'Sorry, but this e-mail address has been banned.';
$lang['Email_invalid'] = 'Sorry, but this e-mail address is invalid.';
$lang['Signature_too_long'] = 'Your signature is too long.';
$lang['Fields_empty'] = 'You must fill in the required fields.';
$lang['Avatar_filetype'] = 'The avatar filetype must be .jpg, .gif or .png';
$lang['Avatar_filesize'] = 'The avatar image file size must be less than %d KB'; // The avatar image file size must be less than 6 KB
$lang['Avatar_imagesize'] = 'The avatar must be less than %d pixels wide and %d pixels high'; 

$lang['Welcome_subject'] = 'Welcome to %s Forums'; // Welcome to my.com forums
$lang['New_account_subject'] = 'New user account';
$lang['Account_activated_subject'] = 'Account Activated';

$lang['Account_added'] = 'Thank you for registering. Your account has been created. You may now log in with your username and password';
$lang['Account_inactive'] = 'Your account has been created. However, this forum requires account activation. An activation key has been sent to the e-mail address you provided. Please check your e-mail for further information';
$lang['Account_inactive_admin'] = 'Your account has been created. However, this forum requires account activation by the administrator. An e-mail has been sent to them and you will be informed when your account has been activated';
$lang['Account_active'] = 'Your account has now been activated. Thank you for registering';
$lang['Account_active_admin'] = 'The account has now been activated';
$lang['Reactivate'] = 'Reactivate your account!';
$lang['Already_activated'] = 'You have already activated your account';
$lang['COPPA'] = 'Your account has been created but has to be approved. Please check your e-mail for details.';

$lang['Registration'] = 'Registration Agreement Terms';
$lang['Reg_agreement'] = 'While the administrators and moderators of this forum will attempt to remove or edit any generally objectionable material as quickly as possible, it is impossible to review every message. Therefore you acknowledge that all posts made to these forums express the views and opinions of the author and not the administrators, moderators or webmaster (except for posts by these people) and hence will not be held liable.<br /><br />You agree not to post any abusive, obscene, vulgar, slanderous, hateful, threatening, sexually-oriented or any other material that may violate any applicable laws. Doing so may lead to you being immediately and permanently banned (and your service provider being informed). The IP address of all posts is recorded to aid in enforcing these conditions. You agree that the webmaster, administrator and moderators of this forum have the right to remove, edit, move or close any topic at any time should they see fit. As a user you agree to any information you have entered above being stored in a database. While this information will not be disclosed to any third party without your consent the webmaster, administrator and moderators cannot be held responsible for any hacking attempt that may lead to the data being compromised.<br /><br />This forum system uses cookies to store information on your local computer. These cookies do not contain any of the information you have entered above; they serve only to improve your viewing pleasure. The e-mail address is used only for confirming your registration details and password (and for sending new passwords should you forget your current one).<br /><br />By clicking Register below you agree to be bound by these conditions.';

$lang['Agree_under_13'] = 'I Agree to these terms and am <b>under</b> 13 years of age';
$lang['Agree_over_13'] = 'I Agree to these terms and am <b>over</b> or <b>exactly</b> 13 years of age';
$lang['Agree_not'] = 'I do not agree to these terms';

$lang['Wrong_activation'] = 'The activation key you supplied does not match any in the database.';
$lang['Send_password'] = 'Send me a new password'; 
$lang['Password_updated'] = 'A new password has been created; please check your e-mail for details on how to activate it.';
$lang['No_email_match'] = 'The e-mail address you supplied does not match the one listed for that username.';
$lang['New_password_activation'] = 'New password activation';
$lang['Password_activated'] = 'Your account has been re-activated. To log in, please use the password supplied in the e-mail you received.';

$lang['Send_email_msg'] = 'Send an e-mail message';
$lang['No_user_specified'] = 'No user was specified';
$lang['User_prevent_email'] = 'This user does not wish to receive e-mail. Try sending them a private message.';
$lang['User_not_exist'] = 'That user does not exist';
$lang['CC_email'] = 'Send a copy of this e-mail to yourself';
$lang['Email_message_desc'] = 'This message will be sent as plain text, so do not include any HTML or BBCode. The return address for this message will be set to your e-mail address.';
$lang['Flood_email_limit'] = 'You cannot send another e-mail at this time. Try again later.';
$lang['Recipient'] = 'Recipient';
$lang['Email_sent'] = 'The e-mail has been sent.';
$lang['Send_email'] = 'Send e-mail';
$lang['Empty_subject_email'] = 'You must specify a subject for the e-mail.';
$lang['Empty_message_email'] = 'You must enter a message to be e-mailed.';


//
// Visual confirmation system strings
//
$lang['Confirm_code_wrong'] = 'The confirmation code you entered was incorrect';
$lang['Too_many_registers'] = 'You have exceeded the number of registration attempts for this session. Please try again later.';
$lang['Confirm_code_impaired'] = 'If you are visually impaired or cannot otherwise read this code please contact the %sAdministrator%s for help.';
$lang['Confirm_code'] = 'Confirmation code';
$lang['Confirm_code_explain'] = 'Enter the code exactly as you see it. The code is case sensitive and zero has a diagonal line through it.';



//
// Memberslist
//
$lang['Select_sort_method'] = 'Select sort method';
$lang['Sort'] = 'Sort';
$lang['Sort_Top_Ten'] = 'Top Ten Posters';
$lang['Sort_Joined'] = 'Joined Date';
$lang['Sort_Username'] = 'Username';
$lang['Sort_Location'] = 'Location';
$lang['Sort_Posts'] = 'Total posts';
$lang['Sort_Email'] = 'Email';
$lang['Sort_Website'] = 'Website';
$lang['Sort_Ascending'] = 'Ascending';
$lang['Sort_Descending'] = 'Descending';
$lang['Order'] = 'Order';


//
// Group control panel
//
$lang['Group_Control_Panel'] = 'Group Control Panel';
$lang['Group_member_details'] = 'Group Membership Details';
$lang['Group_member_join'] = 'Join a Group';

$lang['Group_Information'] = 'Group Information';
$lang['Group_name'] = 'Group name';
$lang['Group_description'] = 'Group description';
$lang['Group_membership'] = 'Group membership';
$lang['Group_Members'] = 'Group Members';
$lang['Group_Moderator'] = 'Group Moderator';
$lang['Pending_members'] = 'Pending Members';

$lang['Group_type'] = 'Group type';
$lang['Group_open'] = 'Open group';
$lang['Group_closed'] = 'Closed group';
$lang['Group_hidden'] = 'Hidden group';

$lang['Current_memberships'] = 'Current memberships';
$lang['Non_member_groups'] = 'Non-member groups';
$lang['Memberships_pending'] = 'Memberships pending';

$lang['No_groups_exist'] = 'No Groups Exist';
$lang['Group_not_exist'] = 'That user group does not exist';

$lang['Join_group'] = 'Join Group';
$lang['No_group_members'] = 'This group has no members';
$lang['Group_hidden_members'] = 'This group is hidden; you cannot view its membership';
$lang['No_pending_group_members'] = 'This group has no pending members';
$lang['Group_joined'] = 'You have successfully subscribed to this group.<br />You will be notified when your subscription is approved by the group moderator.';
$lang['Group_request'] = 'A request to join your group has been made.';
$lang['Group_approved'] = 'Your request has been approved.';
$lang['Group_added'] = 'You have been added to this usergroup.'; 
$lang['Already_member_group'] = 'You are already a member of this group';
$lang['User_is_member_group'] = 'User is already a member of this group';
$lang['Group_type_updated'] = 'Successfully updated group type.';

$lang['Could_not_add_user'] = 'The user you selected does not exist.';
$lang['Could_not_anon_user'] = 'You cannot make Anonymous a group member.';

$lang['Confirm_unsub'] = 'Are you sure you want to unsubscribe from this group?';
$lang['Confirm_unsub_pending'] = 'Your subscription to this group has not yet been approved; are you sure you want to unsubscribe?';

$lang['Unsub_success'] = 'You have been un-subscribed from this group.';

$lang['Approve_selected'] = 'Approve Selected';
$lang['Deny_selected'] = 'Deny Selected';
$lang['Not_logged_in'] = 'You must be logged in to join a group.';
$lang['Remove_selected'] = 'Remove Selected';
$lang['Add_member'] = 'Add Member';
$lang['Not_group_moderator'] = 'You are not this group\'s moderator, therefore you cannot perform that action.';

$lang['Login_to_join'] = 'Log in to join or manage group memberships';
$lang['This_open_group'] = 'This is an open group: click to request membership';
$lang['This_closed_group'] = 'This is a closed group: no more users accepted';
$lang['This_hidden_group'] = 'This is a hidden group: automatic user addition is not allowed';
$lang['Member_this_group'] = 'You are a member of this group';
$lang['Pending_this_group'] = 'Your membership of this group is pending';
$lang['Are_group_moderator'] = 'You are the group moderator';
$lang['None'] = 'None';

$lang['Subscribe'] = 'Subscribe';
$lang['Unsubscribe'] = 'Unsubscribe';
$lang['View_Information'] = 'View Information';


//
// Search
//
$lang['Search_query'] = 'Search Query';
$lang['Search_options'] = 'Search Options';

$lang['Search_keywords'] = 'Search for Keywords';
$lang['Search_keywords_explain'] = 'You can use <u>AND</u> to define words which must be in the results, <u>OR</u> to define words which may be in the result and <u>NOT</u> to define words which should not be in the result. Use * as a wildcard for partial matches';
$lang['Search_author'] = 'Search for Author';
$lang['Search_author_explain'] = 'Use * as a wildcard for partial matches';

$lang['Search_for_any'] = 'Search for any terms or use query as entered';
$lang['Search_for_all'] = 'Search for all terms';
$lang['Search_title_msg'] = 'Search topic title and message text';
$lang['Search_msg_only'] = 'Search message text only';

$lang['Return_first'] = 'Return first'; // followed by xxx characters in a select box
$lang['characters_posts'] = 'characters of posts';

$lang['Search_previous'] = 'Search previous'; // followed by days, weeks, months, year, all in a select box

$lang['Sort_by'] = 'Sort by';
$lang['Sort_Time'] = 'Post Time';
$lang['Sort_Post_Subject'] = 'Post Subject';
$lang['Sort_Topic_Title'] = 'Topic Title';
$lang['Sort_Author'] = 'Author';
$lang['Sort_Forum'] = 'Forum';

$lang['Display_results'] = 'Display results as';
$lang['All_available'] = 'All available';
$lang['No_searchable_forums'] = 'You do not have permissions to search any forum on this site.';

$lang['No_search_match'] = 'No topics or posts met your search criteria';
$lang['Found_search_match'] = 'Search found %d match'; // eg. Search found 1 match
$lang['Found_search_matches'] = 'Search found %d matches'; // eg. Search found 24 matches
$lang['Search_Flood_Error'] = 'You cannot make another search so soon after your last; please try again in a short while.';

$lang['Close_window'] = 'Close Window';


//
// Auth related entries
//
// Note the %s will be replaced with one of the following 'user' arrays
$lang['Sorry_auth_announce'] = 'Sorry, but only %s can post announcements in this forum.';
$lang['Sorry_auth_sticky'] = 'Sorry, but only %s can post sticky messages in this forum.'; 
$lang['Sorry_auth_read'] = 'Sorry, but only %s can read topics in this forum.'; 
$lang['Sorry_auth_post'] = 'Sorry, but only %s can post topics in this forum.'; 
$lang['Sorry_auth_reply'] = 'Sorry, but only %s can reply to posts in this forum.';
$lang['Sorry_auth_edit'] = 'Sorry, but only %s can edit posts in this forum.'; 
$lang['Sorry_auth_delete'] = 'Sorry, but only %s can delete posts in this forum.';
$lang['Sorry_auth_vote'] = 'Sorry, but only %s can vote in polls in this forum.';

// These replace the %s in the above strings
$lang['Auth_Anonymous_Users'] = '<b>anonymous users</b>';
$lang['Auth_Registered_Users'] = '<b>registered users</b>';
$lang['Auth_Users_granted_access'] = '<b>users granted special access</b>';
$lang['Auth_Moderators'] = '<b>moderators</b>';
$lang['Auth_Administrators'] = '<b>administrators</b>';

$lang['Not_Moderator'] = 'You are not a moderator of this forum.';
$lang['Not_Authorised'] = 'Not Authorised';

$lang['You_been_banned'] = 'You have been banned from this forum.<br />Please contact the webmaster or board administrator for more information.';


//
// Viewonline
//
$lang['Reg_users_zero_online'] = 'There are 0 Registered users and '; // There are 5 Registered and
$lang['Reg_users_online'] = 'There are %d Registered users and '; // There are 5 Registered and
$lang['Reg_user_online'] = 'There is %d Registered user and '; // There is 1 Registered and
$lang['Hidden_users_zero_online'] = '0 Hidden users online'; // 6 Hidden users online
$lang['Hidden_users_online'] = '%d Hidden users online'; // 6 Hidden users online
$lang['Hidden_user_online'] = '%d Hidden user online'; // 6 Hidden users online
$lang['Guest_users_online'] = 'There are %d Guest users online'; // There are 10 Guest users online
$lang['Guest_users_zero_online'] = 'There are 0 Guest users online'; // There are 10 Guest users online
$lang['Guest_user_online'] = 'There is %d Guest user online'; // There is 1 Guest user online
$lang['No_users_browsing'] = 'There are no users currently browsing this forum';

$lang['Online_explain'] = 'This data is based on users active over the past five minutes';

$lang['Forum_Location'] = 'Forum Location';
$lang['Last_updated'] = 'Last Updated';

$lang['Forum_index'] = 'Forum index';
$lang['Logging_on'] = 'Logging on';
$lang['Posting_message'] = 'Posting a message';
$lang['Searching_forums'] = 'Searching forums';
$lang['Viewing_profile'] = 'Viewing profile';
$lang['Viewing_online'] = 'Viewing who is online';
$lang['Viewing_member_list'] = 'Viewing member list';
$lang['Viewing_priv_msgs'] = 'Viewing Private Messages';
$lang['Viewing_FAQ'] = 'Viewing FAQ';


//
// Moderator Control Panel
//
$lang['Mod_CP'] = 'Moderator Control Panel';
$lang['Mod_CP_explain'] = 'Using the form below you can perform mass moderation operations on this forum. You can lock, unlock, move or delete any number of topics.';

$lang['Select'] = 'Select';
$lang['Delete'] = 'Delete';
$lang['Move'] = 'Move';
$lang['Lock'] = 'Lock';
$lang['Unlock'] = 'Unlock';

$lang['Topics_Removed'] = 'The selected topics have been successfully removed from the database.';
$lang['Topics_Locked'] = 'The selected topics have been locked.';
$lang['Topics_Moved'] = 'The selected topics have been moved.';
$lang['Topics_Unlocked'] = 'The selected topics have been unlocked.';
$lang['No_Topics_Moved'] = 'No topics were moved.';

$lang['Confirm_delete_topic'] = 'Are you sure you want to remove the selected topic/s?';
$lang['Confirm_lock_topic'] = 'Are you sure you want to lock the selected topic/s?';
$lang['Confirm_unlock_topic'] = 'Are you sure you want to unlock the selected topic/s?';
$lang['Confirm_move_topic'] = 'Are you sure you want to move the selected topic/s?';

$lang['Move_to_forum'] = 'Move to forum';
$lang['Leave_shadow_topic'] = 'Leave shadow topic in old forum.';

$lang['Split_Topic'] = 'Split Topic Control Panel';
$lang['Split_Topic_explain'] = 'Using the form below you can split a topic in two, either by selecting the posts individually or by splitting at a selected post';
$lang['Split_title'] = 'New topic title';
$lang['Split_forum'] = 'Forum for new topic';
$lang['Split_posts'] = 'Split selected posts';
$lang['Split_after'] = 'Split from selected post';
$lang['Topic_split'] = 'The selected topic has been split successfully';

$lang['Too_many_error'] = 'You have selected too many posts. You can only select one post to split a topic after!';

$lang['None_selected'] = 'You have not selected any topics to perform this operation on. Please go back and select at least one.';
$lang['New_forum'] = 'New forum';

$lang['This_posts_IP'] = 'IP address for this post';
$lang['Other_IP_this_user'] = 'Other IP addresses this user has posted from';
$lang['Users_this_IP'] = 'Users posting from this IP address';
$lang['IP_info'] = 'IP Information';
$lang['Lookup_IP'] = 'Look up IP address';


//
// Timezones ... for display on each page
//
$lang['All_times'] = 'All times are %s'; // eg. All times are GMT - 12 Hours (times from next block)

$lang['-12'] = 'GMT - 12 Hours';
$lang['-11'] = 'GMT - 11 Hours';
$lang['-10'] = 'GMT - 10 Hours';
$lang['-9'] = 'GMT - 9 Hours';
$lang['-8'] = 'GMT - 8 Hours';
$lang['-7'] = 'GMT - 7 Hours';
$lang['-6'] = 'GMT - 6 Hours';
$lang['-5'] = 'GMT - 5 Hours';
$lang['-4'] = 'GMT - 4 Hours';
$lang['-3.5'] = 'GMT - 3.5 Hours';
$lang['-3'] = 'GMT - 3 Hours';
$lang['-2'] = 'GMT - 2 Hours';
$lang['-1'] = 'GMT - 1 Hours';
$lang['0'] = 'GMT';
$lang['1'] = 'GMT + 1 Hour';
$lang['2'] = 'GMT + 2 Hours';
$lang['3'] = 'GMT + 3 Hours';
$lang['3.5'] = 'GMT + 3.5 Hours';
$lang['4'] = 'GMT + 4 Hours';
$lang['4.5'] = 'GMT + 4.5 Hours';
$lang['5'] = 'GMT + 5 Hours';
$lang['5.5'] = 'GMT + 5.5 Hours';
$lang['6'] = 'GMT + 6 Hours';
$lang['6.5'] = 'GMT + 6.5 Hours';
$lang['7'] = 'GMT + 7 Hours';
$lang['8'] = 'GMT + 8 Hours';
$lang['9'] = 'GMT + 9 Hours';
$lang['9.5'] = 'GMT + 9.5 Hours';
$lang['10'] = 'GMT + 10 Hours';
$lang['11'] = 'GMT + 11 Hours';
$lang['12'] = 'GMT + 12 Hours';
$lang['13'] = 'GMT + 13 Hours';

// These are displayed in the timezone select box
$lang['tz']['-12'] = '(GMT -12 Hours) Eniwetok, Kwajalein';
$lang['tz']['-11'] = '(GMT -11 Hours) Midway Island, Samoa';
$lang['tz']['-10'] = '(GMT -10 Hours) Hawaii';
$lang['tz']['-9'] = '(GMT -9 Hours) Alaska';
$lang['tz']['-8'] = '(GMT -8 Hours) Pacific Time (US & Canada)';
$lang['tz']['-7'] = '(GMT -7 Hours) Mountain Time (US & Canada)';
$lang['tz']['-6'] = '(GMT -6 Hours) Central Time (US & Canada), Mexico City';
$lang['tz']['-5'] = '(GMT -5 Hours) Eastern Time (US & Canada), Bogota, Lima, Quito';
$lang['tz']['-4'] = '(GMT -4 Hours) Atlantic Time (Canada), Caracas, La Paz';
$lang['tz']['-3.5'] = '(GMT -3.5 Hours) Newfoundland';
$lang['tz']['-3'] = '(GMT -3 Hours) Brazil, Buenos Aires, Georgetown';
$lang['tz']['-2'] = '(GMT -2 Hours) Mid-Atlantic';
$lang['tz']['-1'] = '(GMT -1 Hour) Azores, Cape Verde Islands';
$lang['tz']['0'] = '(GMT) Western Europe Time, London, Lisbon, Casablanca, Monrovia';
$lang['tz']['1'] = '(GMT +1 Hour) CET(Central Europe Time), Berlin, Brussels, Madrid, Paris';
$lang['tz']['2'] = '(GMT +2 Hours) EET(Eastern Europe Time), Kaliningrad, South Africa';
$lang['tz']['3'] = '(GMT +3 Hours) Baghdad, Kuwait, Riyadh, Moscow, St. Petersburg, Nairobi';
$lang['tz']['3.5'] = '(GMT +3.5 Hours) Tehran';
$lang['tz']['4'] = '(GMT +4 Hours) Abu Dhabi, Muscat, Baku, Tbilisi';
$lang['tz']['4.5'] = '(GMT +4.5 Hours) Kabul';
$lang['tz']['5'] = '(GMT +5 Hours) Ekaterinburg, Islamabad, Karachi, Tashkent';
$lang['tz']['5.5'] = '(GMT +5.5 Hours) Bombay, Calcutta, Madras, New Delhi';
$lang['tz']['5.75'] = '(GMT +5.75 Hours) Kathmandu';
$lang['tz']['6'] = '(GMT +6 Hours) Almaty, Dhaka, Colombo';
$lang['tz']['6.5'] = '(GMT +6.5 Hours)';
$lang['tz']['7'] = '(GMT +7 Hours) Bangkok, Hanoi, Jakarta';
$lang['tz']['8'] = '(GMT +8 Hours) Beijing, Perth, Singapore, Hong Kong, Urumqi, Taipei';
$lang['tz']['9'] = '(GMT +9 Hours) Tokyo, Seoul, Osaka, Sapporo, Yakutsk';
$lang['tz']['9.5'] = '(GMT +9.5 Hours) Adelaide, Darwin';
$lang['tz']['10'] = '(GMT +10 Hours) EAST(East Australian Standard), Guam, Papua New Guinea';
$lang['tz']['11'] = '(GMT +11 Hours) Magadan, Solomon Islands, New Caledonia';
$lang['tz']['12'] = '(GMT +12 Hours) Auckland, Wellington, Fiji, Kamchatka, Marshall Island';
$lang['tz']['13'] = '(GMT +13 Hours) Nuku\'alofa';

$lang['datetime']['Sunday'] = 'Sunday';
$lang['datetime']['Monday'] = 'Monday';
$lang['datetime']['Tuesday'] = 'Tuesday';
$lang['datetime']['Wednesday'] = 'Wednesday';
$lang['datetime']['Thursday'] = 'Thursday';
$lang['datetime']['Friday'] = 'Friday';
$lang['datetime']['Saturday'] = 'Saturday';
$lang['datetime']['Sun'] = 'Sun';
$lang['datetime']['Mon'] = 'Mon';
$lang['datetime']['Tue'] = 'Tue';
$lang['datetime']['Wed'] = 'Wed';
$lang['datetime']['Thu'] = 'Thu';
$lang['datetime']['Fri'] = 'Fri';
$lang['datetime']['Sat'] = 'Sat';
$lang['datetime']['January'] = 'January';
$lang['datetime']['February'] = 'February';
$lang['datetime']['March'] = 'March';
$lang['datetime']['April'] = 'April';
$lang['datetime']['May'] = 'May';
$lang['datetime']['June'] = 'June';
$lang['datetime']['July'] = 'July';
$lang['datetime']['August'] = 'August';
$lang['datetime']['September'] = 'September';
$lang['datetime']['October'] = 'October';
$lang['datetime']['November'] = 'November';
$lang['datetime']['December'] = 'December';
$lang['datetime']['Jan'] = 'Jan';
$lang['datetime']['Feb'] = 'Feb';
$lang['datetime']['Mar'] = 'Mar';
$lang['datetime']['Apr'] = 'Apr';
$lang['datetime']['May'] = 'May';
$lang['datetime']['Jun'] = 'Jun';
$lang['datetime']['Jul'] = 'Jul';
$lang['datetime']['Aug'] = 'Aug';
$lang['datetime']['Sep'] = 'Sep';
$lang['datetime']['Oct'] = 'Oct';
$lang['datetime']['Nov'] = 'Nov';
$lang['datetime']['Dec'] = 'Dec';

//
// Errors (not related to a
// specific failure on a page)
//
$lang['Information'] = 'Information';
$lang['Critical_Information'] = 'Critical Information';

$lang['General_Error'] = 'General Error';
$lang['Critical_Error'] = 'Critical Error';
$lang['An_error_occured'] = 'An Error Occurred';
$lang['A_critical_error'] = 'A Critical Error Occurred';

// Additional Stuff for phpBB2 Plus only ! Translators should get original Language Files for phpBB 2.0.8
// for the language they want to translate from http://www.phpbb.com/downloads.php. Then they need to translate 
// the following stuff only and use the rest from the original language files !

//-- mod : mods settings ---------------------------------------------------------------------------
//-- add
$lang['Click_return_preferences'] = 'Click %sHere%s to return to Preferences';
//-- fin mod : mods settings -----------------------------------------------------------------------

// Start add - Birthday MOD
$lang['Birthday'] = 'Birthday';
$lang['No_birthday_specify'] = 'None Specified';
$lang['Age'] = 'Age';
$lang['Wrong_birthday_format'] = 'The birthday format was entered incorrectly.'; 
$lang['Birthday_to_high'] = 'Sorry, this site does not accept users over %d years of age';
$lang['Birthday_require'] = 'Your Birthday is required on this site';
$lang['Birthday_to_low'] = 'Sorry, this site does not accept users below %d years of age';
$lang['Submit_date_format'] = 'd-m-Y'; //php date() format - Note: ONLY d, m and Y may be used and SHALL ALL be used (different seperators are accepted)
$lang['Birthday_greeting_today'] = 'Happy Birthday! %s years old today.<br /><br /> The Management';//%s is substituted with the users age
$lang['Birthday_greeting_prev'] = 'Happy Belated Birthday! %s years old on the %s.<br /><br /> The Management';//%s is substituted with the users age, and birthday
$lang['Greeting_Messaging'] = 'Congratulations';
$lang['Birthday_today'] = 'Users with a birthday today:';
$lang['Birthday_week'] = 'Users with a birthday within the next %d days:';
$lang['Nobirthday_week'] = 'No users with a birthday in the upcoming %d days'; // %d is substitude with the number of days
$lang['Nobirthday_today'] = 'No users with a birthday today'; 
$lang['Year'] = 'Year';
$lang['Month'] = 'Month';
$lang['Day'] = 'Day';

// NOTE: Please do not translate the folowing 4 lines !
// They are automatically translated into your language
$lang['day_short'] = array ($lang['datetime']['Sun'],$lang['datetime']['Mon'],$lang['datetime']['Tue'],$lang['datetime']['Wed'],$lang['datetime']['Thu'],$lang['datetime']['Fri'],$lang['datetime']['Sat']);
$lang['day_long'] = array ($lang['datetime']['Sunday'],$lang['datetime']['Monday'],$lang['datetime']['Tuesday'],$lang['datetime']['Wednesday'],$lang['datetime']['Thursday'],$lang['datetime']['Friday'],$lang['datetime']['Saturday']);
$lang['month_short'] = array ($lang['datetime']['Jan'],$lang['datetime']['Feb'],$lang['datetime']['Mar'],$lang['datetime']['Apr'],$lang['datetime']['May'],$lang['datetime']['Jun'],$lang['datetime']['Jul'],$lang['datetime']['Aug'],$lang['datetime']['Sep'],$lang['datetime']['Oct'],$lang['datetime']['Nov'],$lang['datetime']['Dec']);
$lang['month_long'] = array ($lang['datetime']['January'],$lang['datetime']['February'],$lang['datetime']['March'],$lang['datetime']['April'],$lang['datetime']['May'],$lang['datetime']['June'],$lang['datetime']['July'],$lang['datetime']['August'],$lang['datetime']['September'],$lang['datetime']['October'],$lang['datetime']['November'],$lang['datetime']['December']);
// End add - Birthday MOD
// zodiacs used for birthday mod
$lang['Zodiac'] = 'Zodiac';
$lang['Capricorn'] = 'Capricorn';
$lang['Aquarius'] = 'Aquarius';
$lang['Pisces'] = 'Pisces';
$lang['Aries'] = 'Aries';
$lang['Taurus'] = 'Taurus';
$lang['Gemini'] = 'Gemini';
$lang['Cancer'] = 'Cancer';
$lang['Leo'] = 'Leo';
$lang['Virgo'] = 'Virgo';
$lang['Libra'] = 'Libra';
$lang['Scorpio'] = 'Scorpio';
$lang['Sagittarius'] = 'Sagittarius';
// chinese zodiacs used for birthday mod
$lang['Chinese_zodiac']= 'Chinese zodiac';
$lang['Unknown'] = 'Unknown';
$lang['Rat'] = 'Rat';
$lang['Buffalo'] = 'Buffalo';
$lang['Tiger'] = 'Tiger';
$lang['Cat'] = 'Cat';
$lang['Dragon'] = 'Dragon';
$lang['Snake'] = 'Snake';
$lang['Horse'] = 'Horse';
$lang['Goat'] = 'Goat';
$lang['Monkey'] = 'Monkey';
$lang['Cock'] = 'Cock';
$lang['Dog'] = 'Dog';
$lang['Pig'] = 'Pig';

// Start add - Gender MOD
$lang['Gender'] = 'Gender';//used in users profile to display witch gender he/she is 
$lang['Male'] = 'Male'; 
$lang['Female']='Female'; 
$lang['No_gender_specify'] = 'None Specified'; 
// End add - Gender MOD

// Start add - Last visit MOD
$lang['Last_logon'] = 'Last Visit'; 
$lang['Hidde_last_logon'] = 'Hidden'; 
$lang['Never_last_logon'] = 'Never'; 
$lang['Users_today_zero_total'] = 'In total <b>0</b> users have visited this site today :: ';
$lang['Users_today_total'] = 'In total <b>%d</b> user have visited this site today :: ';
$lang['User_today_total'] = 'In total <b>%d</b> users have visited this site today :: ';
$lang['Users_lasthour_explain'] = ', %d of them within the last hour.'; 
$lang['Users_lasthour_none_explain'] = ''; //showen of none have visited the last hour, fill if you like

$lang['Years'] = 'Years';
$lang['Year'] = 'Year';
$lang['Weeks'] = 'Weeks';
$lang['Week'] = 'Week';
$lang['Day'] = 'Day';
$lang['Total_online_time'] = 'Total Online Duration'; 
$lang['Last_online_time'] = 'Last Online Duration'; 
$lang['Number_of_visit'] = 'Number of visits'; 
$lang['Number_of_pages'] = 'Number of page hits'; 
// End add - Last visit MOD

// FLAGHACK-start
$lang['Country_Flag'] = 'Country Flag';
$lang['Select_Country'] = 'SELECT COUNTRY' ;
// FLAGHACK-end

// Anti Robotic Registration
$lang['Wrong_reg_key'] = 'Anti Robotic Register Validation Error';
$lang['Validation'] = 'Validation';
$lang['Validation_explain'] = 'To make sure you are not a robot, please type what letters you see in the image right';

//
// Smartor's ezPortal
//
$lang['Home'] = 'Portal';
$lang['Board_navigation'] = 'Board Navigation';
$lang['Statistics'] = 'Statistics';
$lang['total_topics'] = " within <b>%s</b> topics"; // added in v2.1.6
$lang['Comments'] = 'Comments';
$lang['Read_Full'] = 'Read Full';
$lang['View_comments'] = 'View Comments';
$lang['Post_your_comment'] = 'Post your comment';
$lang['Welcome'] = 'Welcome';
$lang['Register_new_account'] = 'Don\'t have an account yet?<br />You can %sregister%s for FREE';
$lang['Remember_me'] = 'Remember me';
$lang['View_complete_list'] = 'View complete list';
$lang['Poll'] = 'Poll';
$lang['Login_to_vote'] = 'You must login to vote';
$lang['Vote'] = 'Vote';
$lang['No_poll'] = 'No poll at the moment';

$lang['Download'] = 'Download';
$lang['Viewing_Download'] = 'Viewing Download';
$lang['Top_Downloads'] = 'Top 10';
$lang['Newest_Downloads'] = 'Latest';
$lang['L_Word_on'] = 'on';
$lang['L_Word_by'] = 'by';
$lang['News_Reply'] = 'Reply to this News Item';
$lang['News_Print'] = 'Print this Topic';
$lang['News_Email'] = 'E-Mail this Topic';
$lang['Save_Topic'] = 'Save this Topic as file';
$lang['News_Categories'] = 'News Categories';
$lang['News_Archieves'] = 'News Archives';
$lang['News_Summary'] = 'This news item has';
$lang['News_Views'] = 'Views';
$lang['News_And'] = 'and';
$lang['News_Comments'] = 'Comments';
$lang['Credits'] = 'Mods and Credits';
$lang['News_Cats'] = 'News Categories';
$lang['No_News_Cats'] = 'Sorry, no News Categories available !';
$lang['Recent_files'] = 'Recent Files';
$lang['Forum_Search'] = 'Forum Search';
$lang['About_us'] = 'About us';
$lang['Portal_Navigate'] = 'Navigation';
$lang['Portal_Tools'] = 'Tools';
$lang['Site_links'] = 'Links';
$lang['Site_Contact'] = 'Contact us';
$lang['Last_Seen'] = 'Last Seen';
$lang['No_News'] = 'Sorry, there is no News available';
$lang['Quick_Search'] = 'Quick Search';
$lang['Advanced_Search'] = 'Advanced Search';

//
// Photo Album Addon v2.x.x by Smartor
//
$lang['Album'] = 'Album';
$lang['Personal_Gallery_Of_User'] = 'Personal Gallery of %s'; 
$lang['Newest_pic'] = 'Recent Photo';
//--- Album Category Hierarchy : begin
//--- Version : 1.2.0
$lang['Personal_Gallery_Of_User_Profile'] = 'Personal Gallery of %s (%d Pictures)';
$lang['Show_All_Pic_View_Mode_Profile'] = 'Show All Pictures In The Personal Gallery of %s (without sub cats)';
//--- Album Category Hierarchy : end

//
// Start add  - Photo Album Block
$lang['Newest_pics'] = 'Newest Pics';
// End add  - Photo Album Block

// Start Quick Reply Mod
$lang['Quick_Reply'] = 'Quick Reply';
$lang['Quick_quote'] = 'Quote the last message';
$lang['Quick_add_smilies'] = 'Smilies';
$lang['QuoteSelelected'] = 'Quote selected';
$lang['QuoteSelelectedEmpty'] = 'Select a text anywhere on a page and try again';
$lang['Quick_Reply_smilies'] = 'all';
// End Quick Reply Mod 

$lang['Recent_topics'] = 'Recent topics'; // Recent Topics
$lang['No_recent_topics'] = '<br />No topics at the moment<br /><br />'; // No recent Topics
$lang['No_recent_files'] = '<br />No files at the moment<br /><br />'; // No recent Files
$lang['No_articles'] = '<br />No articles at the moment<br /><br />'; // No News

//
// Online/Offline
//
$lang['Offline'] = 'Offline';
$lang['Online'] = 'Online';
$lang['Hidden'] = 'Hidden';
$lang['On_off_status'] = 'Status';

//
// Staff Site
//
$lang['Staff'] = 'Staff Site';
$lang['Staff_about'] = 'Informations about %s'; // %s = username
$lang['Staff_level'] = array('Administrator', 'Moderator');
$lang['Staff_forums'] = 'Forums';
$lang['Staff_messenger'] = 'Messenger';
$lang['Staff_user_topic_day_stats'] = '%.2f topics per day'; // %.2f = topics
$lang['Staff_online'] = '<font color=#0000FF>online</font>';
$lang['Staff_year'] = 'year';
$lang['Staff_years'] = 'years';
$lang['Staff_week'] = 'week';
$lang['Staff_weeks'] = 'weeks';
$lang['Staff_day'] = 'day';
$lang['Staff_days'] = 'days';
$lang['Staff_hour'] = 'hour';
$lang['Staff_hours'] = 'hours';
$lang['Staff_minute'] = 'minute';
$lang['Staff_minutes'] = 'minutes';
$lang['Staff_since'] = '(since %s)'; // %s = period
$lang['Staff_ago'] = '(%s ago)'; // %s = period


//
// Bookmark Mod
//
$lang['Bookmarks'] = 'Bookmarks';
$lang['Set_Bookmark'] = 'Set a bookmark for this topic';
$lang['Remove_Bookmark'] = 'Remove the bookmark for this topic';
$lang['No_Bookmarks'] = 'You do not have set a bookmark';
$lang['Always_set_bm'] = 'Set bookmark automatically when posting';
$lang['Found_bookmark'] = 'You have set %d bookmark.'; // eg. Search found 1 match
$lang['Found_bookmarks'] = 'You have set %d bookmarks.'; // eg. Search found 24 matches
$lang['More_bookmarks'] = 'More bookmarks...'; // For mozilla navigation bar

// Start add - Fully integrated shoutbox MOD
$lang['Shoutbox'] = 'Shoutbox';
$lang['Shoutbox_date'] = ' d m Y h:i:s';
$lang['Shout_censor'] = 'shout removed !';
$lang['Shout_refresh'] = 'Refresh';
$lang['Shout_text'] = 'Your text';
$lang['Viewing_Shoutbox']= 'Viewing shoutbox';
$lang['Censor'] ='Censor';
// End add - Fully integrated shoutbox MOD

$lang['bbcode_g_help'] = "Glow: [glow=colour]text[/glow] (alt+g)"; 
$lang['bbcode_d_help'] = "Shadow: [shadow=colour]text[/shadow] (alt+d)"; 
$lang['bbcode_e_help'] = "Align: [align=left|right|center|justify]text[/align] (alt+e)";
$lang['bbcode_h_help'] = "Fade text: [fade]some text[/fade] (alt+h)";
$lang['bbcode_j_help'] = "Scrolling text: [scroll**]text[/scroll**] (alt+j)";
$lang['bbcode_k_help'] = "Highlighted text: [highlight=color]text[/highlight] (alt+k)";
$lang['bbcode_m_help'] = "flash: [flash width= height= loop=]text[/flash] (alt+m)";
$lang['bbcode_n_help'] = "Flip text: [flipv]text[/flipv] (alt+n)";
$lang['bbcode_r_help'] = "Flip text: [fliph]text[/fliph] (alt+r)";
$lang['bbcode_t_help'] = "Stream Files (wma, mp3, mp2...): [stream]http://path_to_file.wma[/stream] (alt+t)";
$lang['bbcode_v_help'] = "Left Aligned Pic: [left]Path_to_Picture[/left] (alt+v)";
$lang['bbcode_x_help'] = "Right Aligned Pic: [right]Path_to_Picture[/right] (alt+x)";
$lang['PHPCode'] = 'PHP'; // PHP MOD
$lang['bbcode_y_help'] = 'PHP syntax highlighter. [php]<?php code ?>[/php] (alt+y)'; // PHP MOD
$lang['bbcode_z_help'] = "Google: [google]String to search for[/google] (alt+z)";
$lang['bbcode_sc_help'] = 'Smilie Creator: [schild=1]Text[/schild] Generates a Shield Smilie'; 
$lang['bbcode_th_help'] = 'Strikethrough: [s]text[/s] (alt+th)';
$lang['Smilie_creator'] = 'Smilie Creator';
$lang['SC_shieldtext'] = 'Smilie Text';
$lang['SC_fontcolor'] = 'Textcolor';
$lang['SC_shadowcolor'] = 'Shadow Color';
$lang['SC_shieldshadow'] = 'Shieldshadow';
$lang['SC_shieldshadow_on'] = 'Activate';
$lang['SC_shieldshadow_off'] = 'Deactivate';
$lang['SC_smiliechooser'] = 'Select Smilie';
$lang['SC_random_smilie'] = 'Random Smilie';
$lang['SC_default_smilie'] = 'Standard Smilie';
$lang['SC_create_smilie'] = 'Create';
$lang['SC_stop_creating'] = 'Cancel';
$lang['SC_error'] = 'Here is your Shield - you have forgotten the Text...';
$lang['SC_another_shield'] = 'Do you want to create another Smilie ?';
$lang['SC_notext_error'] = 'You can not create Smilies without Text'; 

//
// TELL A FRIEND
$lang['Tell_Friend'] = "Email to a Friend.";
$lang['Tell_Friend_Sender_User'] = "Your Name:";
$lang['Tell_Friend_Sender_Email'] = "Your Email:";
$lang['Tell_Friend_Reciever_User'] = "Your Friend's Name:";
$lang['Tell_Friend_Reciever_Email'] = "Your Friend's Email:";
$lang['Tell_Friend_Msg'] = "Your message:";
$lang['Tell_Friend_Title'] = "Tell A Friend";
$lang['Tell_Friend_Body'] = "Hi,\nI just read the topic >>{TOPIC}<< at {SITENAME} and thought you might be interested. Here is the link: {LINK}\n\nGo and read it and if you want to reply you can register for your own account if you have not done so already."; 

// Start add - Who viewed a topic MOD
$lang['Topic_view_users'] = 'List users that have viewed this topic';
$lang['Topic_time'] = 'Last viewed';
$lang['Topic_count'] = 'View count';
$lang['Topic_view_count'] = 'Topic view count';
// End add - Who viewed a topic MOD

//
// Recent Topics
//
$lang['Recent_topics'] = 'Recent Topics';
$lang['Recent_today'] = 'Today';
$lang['Recent_yesterday'] = 'Yesterday';
$lang['Recent_last24'] = 'Last 24 Hours';
$lang['Recent_lastweek'] = 'Last Week';
$lang['Recent_lastXdays'] = 'Last %s days';
$lang['Recent_last'] = 'Last';
$lang['Recent_days'] = 'Days';
$lang['Recent_first'] = 'started at %s';
$lang['Recent_first_poster'] = ' by %s';
$lang['Recent_select_mode'] = 'Select mode:';
$lang['Recent_showing_posts'] = 'Showing Posts:';
$lang['Recent_title_one'] = '<font size=4>%s</font> topic %s'; // %s = topics; %s = sort method
$lang['Recent_title_more'] = '<font size=4>%s</font> topics %s'; // %s = topics; %s = sort method
$lang['Recent_title_today'] = ' from today';
$lang['Recent_title_yesterday'] = ' from yesterday';
$lang['Recent_title_last24'] = ' from the last 24 hours';
$lang['Recent_title_lastweek'] = ' from the last week';
$lang['Recent_title_lastXdays'] = ' from the last %s days'; // %s = days
$lang['Recent_no_topics'] = 'No topics were found.';
$lang['Recent_wrong_mode'] = 'You´ve selected a wrong mode.';
$lang['Recent_click_return'] = 'Click %shere%s to return to recent site.';

// Bottom of Page Link MOD - Daz - ForumImages.com - START/END Line Below
$lang['Go_to_bottom'] = 'Bottom of Page';

// Start add - Yellow card admin MOD
$lang['Give_G_card']='Re-activate user'; 
$lang['Give_Y_card']='Give user warning #%d'; 
$lang['Give_R_card']='Ban this user now'; 
$lang['Ban_update_sucessful'] = 'The banlist has been updated successfully'; 
$lang['Ban_update_green'] = 'The user is now re-activated'; 
$lang['Ban_update_yellow'] = 'The user has recieved a warning, and has now a total of %d warnings of a maximum %d warnings'; 
$lang['Ban_update_red'] = 'The user is now banned'; 
$lang['Ban_reactivate'] = 'Your account has been re-activated'; 
$lang['Ban_warning'] = 'You\'ve recieved a warning'; 
$lang['Ban_blocked'] = 'Your account is now blocked'; 
$lang['Click_return_viewtopic'] = 'Click %sHere%s to return to the topic'; 
$lang['Rules_ban_can'] = 'You <b>can</b> ban other users in this forum'; 
$lang['user_no_email'] = 'The user has no email, therefore no message about this action can be sent. You should submit him/her a private message'; 
$lang['user_already_banned'] = 'The selected user is already banned'; 
$lang['Ban_no_admin'] ='This user in an ADMIN and therefore cannot be warned or banned'; 
$lang['Rules_greencard_can'] = 'You <b>can</b> un-ban users in this forum'; 
$lang['Rules_bluecard_can'] = 'You <b>can</b> report post to moderators in this forum'; 
$lang['Give_b_card'] = 'Report this post to the moderators of this forum'; 
$lang['Clear_b_card'] = 'This post has %d blue cards now. If you press this button you will clear this'; 
$lang['No_moderators'] = 'The forum has no moderators, No reports can be therfore sent!'; 
$lang['Post_repported'] = 'This post has now been reported to %d moderators'; 
$lang['Post_repported_1'] = 'This post has now been reported to the moderator'; 
$lang['Post_repport'] = 'Post Report'; //Subject in email notification
$lang['Post_reset'] = 'The blue cards for this post have now been reset'; 
$lang['Search_only_bluecards'] = 'Search only among posts with blue cards';
$lang['Send_message'] = 'Click %sHere%s to write a message to the moderators or <br />';
$lang['Send_PM_user'] = 'Click %sHere%s to write a PM to the user or';
$lang['Link_to_post'] = 'Click %sHere%s to go to the reported post  <br/>--------------------------------<br/><br/>';
$lang['Post_a_report'] = 'Post a report';
$lang['Report_stored'] = 'Your report has been entered successfully';
$lang['Send_report'] = 'Click %sHere%s to go back to the original message';
$lang['Red_card_warning'] = 'You are about to give the user:%s a red card, this will ban the user, are you sure ?'; 
$lang['Yellow_card_warning'] = 'You are about to give the user:%s a yellow card, this will isue a warning to the user, are you sure ?'; 
$lang['Green_card_warning'] = 'You are about to give the user:%s a green card, this will unban the user, are you sure ?'; 
$lang['Blue_card_warning'] = 'You are about to give the post a blue card, this will alert the moderators about this post, Are you sure you want to Alert the moderators about this post ?'; 
$lang['Clear_blue_card_warning'] = 'You are about to reset the blue card counter for this post, Do you wan to continue ?';
$lang['Warnings'] = 'Warnings : %d'; //shown beside users post, if any warnings given to the user
$lang['Banned'] = 'Currently banned';//shown beside users post, if user are banned

// Start add - Protect user account MOD
$lang['Error_login_tomutch']='You have specified a locked username, please try again later'; 
$lang['Password_not_complex'] ='The specified password, does not comply with the complexity rules, you should verify that: the password '; 
$lang['Password_to_short'] = 'is at least %d characters long'; 
$lang['Password_mixed'] = 'has both numbers and letters'; 
$lang['Password_not_same'] = 'is not the same as your username'; 
$lang['Time_format'] = 'D d. M, Y H:i:s';// how time should be shown in email notification 
$lang['Passwd_have_expired'] = 'Your password has expired, you may request a new one'; 
$lang['Passwd_expired'] = 'Your password has expired and is no longer valid. However, you still have the opportunity to choose a new one now. If, for some reason, you cannot change it now, do not panic. You may request a new random password, using the appropriate link at your next logon.'; 
$lang['Passwd_soon_expired'] = 'Your password will expire in %d days. We recommend that you change it before it actually expires. Should you let your password expire, you may request a new one using the appropriate link at your next logon.'; 
$lang['Send_new_passwd'] = 'Send me a new password'; 
$lang['Passwd_updated'] = 'Thank you <br />Your new password is now stored'; 
$lang['Passwd_title'] = 'Please change your password';
// End add - Protect user account MOD

$lang['Topic_description'] = 'Description of your topic';
$lang['Description'] = 'Topic Description';

// Start add - Topic in Who is online MOD
$lang['Browsing_topic'] = 'Users browsing this topic:';
// End add - Topic in Who is online MOD

//admin user list mail 
$lang['Usersname'] = "Users Name";
$lang['Admin_Users_List_Mail_Title'] = "List users e-mail";
$lang['Admin_Users_List_Mail_Explain'] = "Here a list of your users's e-mail";

// Moved Folder Image Mod
$lang['Moved'] = 'Moved';

//signature editor
$lang['sig_description'] = "Edit Signature (<b>Preview included</b>)";
$lang['sig_edit'] = "Edit Signature";
$lang['sig_current'] = "Current Signature";
$lang['sig_none'] = "No Signature available";
$lang['sig_save'] = "Save";
$lang['sig_save_message'] = "Signature saved successful !";

//Absent User Mod
$lang['On_holidays'] = 'on holidays';
$lang['User_ill'] = 'gotten sick';
$lang['Longer_absenct'] = 'longer abcent';
$lang['User_absence'] = 'Absent';
$lang['User_absence_mode'] = 'Kind of absence';
$lang['User_absence_text'] = 'Absence Message';
$lang['User_absent'] = '<b>Absence Message:</b><br /><br />%s is %s.<br /><br /><i>%s</i><br /><br />So you can not send a message to %s!';
$lang['Absence_notify'] = 'You have set absence.<br />Do you want to disable this?';
$lang['Absence_deleted'] = 'You have successfully disabled your absence.<br /><br />Welcome back!';

// Top 5 Posters in EzPortal Mod
$lang['Top_Posters'] = 'Top Posters';
$lang['Top_Member'] = 'Member';
$lang['Top_Posts'] = 'Posts';

// MOD MODCP EXTENSION BEGIN
$lang['Sticky_topic'] = 'Sticky this topic';
$lang['Announce_topic'] = 'Announce this topic';
$lang['Normal_topic'] = 'Reset this topic to normal';
$lang['Sticky'] = 'Sticky';
$lang['Announce'] = 'Announcement';
$lang['Normalise'] = 'Normal';
$lang['Topics_Stickyd'] = 'The selected topics have been stickied';
$lang['Topics_Announced'] = 'The selected topics have been announced';
$lang['Topics_Normalised'] = 'The selected topics have been normalised';
$lang['Check_All'] = 'Check All'; 
$lang['Uncheck_All'] = 'Uncheck All';
// MOD MODCP EXTENSION END
$lang['Search_new2'] = 'New Posts';

$lang['Search_for'] = "Search for";
$lang['Submit_search'] = "Submit Search";
$lang['That_contains'] = "that contains";

$lang['Name'] = 'Name';

// Contact Form Mod
// Kontakttext:
$lang['kontakt1'] = '<b>Note:</b> If you have any questions or problems using the forum please have a look at our <a href="faq.php"><b>FAQ</b></a> first. If you don\'t find help in the FAQ please send a Mail using this Contact Form.<br><span class="gensmall">Required Fields are marked as *.</span>';
$lang['kontakt2'] = 'Name:*';
$lang['kontakt3'] = 'E-Mail:*';
$lang['kontakt4'] = 'Subject:*';
$lang['kontakt5'] = 'Text:*';
$lang['kontakt6'] = 'Send';
$lang['kontakt7'] = 'Delete';
$lang['kontakt8'] = 'Error, could not sent EMail!';
$lang['kontakt9'] = 'Email was Sent!';
$lang['kontakt_js1'] = 'Are you sure that you want to cancel your Entrys ?';
$lang['kontakt_js2'] = 'Please enter your Name!';
$lang['kontakt_js3'] = 'Please enter a valid EMail Adress!';
$lang['kontakt_js4'] = 'No valid EMail Adress!';
$lang['kontakt_js5'] = 'Please enter a Subject!';
$lang['kontakt_js6'] = 'Please enter some Text!';
$lang['Kontakt'] = 'Contact Page';

// Language Variables for phpBB2 Plus Forum Index Stats
$lang['Newest_user_plus'] = '<b>%s%s%s</b>'; // a href, username, /a
$lang['Live_Statistics'] = 'Live Statistics';
$lang['Latest_Member'] = 'Latest';
$lang['New_Today'] = 'New today';
$lang['New_Yesterday'] = 'New yesterday';
$lang['Members_Overall'] = 'Overall';
$lang['Online_Now'] = 'Online now';
$lang['Guests_P'] = 'Guests';
$lang['Members_P'] = 'Members';
$lang['Box_Stats'] = 'Statistics';
$lang['User_Record'] = 'Record Users';
$lang['Birthdays_P'] = 'Birthdays';
$lang['Online_Members_P'] = 'Logged in';
$lang['Last_Visit'] = 'Online Statistics';

// Google Visit Counter Mod
$lang['Google_Visit_counter'] = 'Google visits: <b>%d</b>';

//+MOD: Select Expand BBcodes MOD
$lang['Select'] = "Select";
$lang['Expand'] = "Expand";
$lang['Contract'] = "Contract";
//-MOD: Select Expand BBcodes MOD

$lang['Click_larger'] = 'Click on image to view larger image';

//BBCode Translations
$lang['B'] ='B';// Here the first letter of 'Bold' in your language
$lang['I'] ='I';// Here the first letter of 'Italic' in your language
$lang['U'] ='U';// Here the first letter of 'Underlined' in your language
$lang['Text'] ='Text';
$lang['Font_type'] = 'Font Type';

//Portal Additions
$lang['KB_title'] = 'Knowledge Base';
$lang['Viewing_KB'] = 'Viewing KB';

// BEGIN Disable Registration MOD
$lang['registration_status'] = 'Sorry, but registrations on this board are currently closed. Please try again later.';
// END Disable Registration MOD
$lang['Admin_reauthenticate'] = 'To administer the board you must re-authenticate yourself.';
//-- mod : run stats -----------------------------------------------------------
//-- add
// run stats
$lang['Stat_surround'] = '[ %s ]';
$lang['Stat_sep'] = ' - ';
$lang['Stat_page_duration'] = 'Time: %.4fs';
$lang['Stat_local_duration'] = 'local trace: %.4fs';
$lang['Stat_part_php'] = 'PHP: %.2d%%';
$lang['Stat_part_sql'] = 'SQL: %.2d%%';
$lang['Stat_queries'] = 'Queries: %2d (%.4fs)';
$lang['Stat_gzip_enable'] = 'GZIP on';
$lang['Stat_debug_enable'] = 'Debug on';
$lang['Stat_request'] = 'Request';
$lang['Stat_line'] = 'Line:&nbsp;%d';
$lang['Stat_cache'] = 'cache:&nbsp;%.4fs';
$lang['Stat_dur'] = 'dur.:&nbsp;%.4fs';
$lang['Stat_table'] = 'Table';
$lang['Stat_type'] = 'Type';
$lang['Stat_possible_keys'] = 'Possible keys';
$lang['Stat_key'] = 'Used key';
$lang['Stat_key_len'] = 'Key length';
$lang['Stat_ref'] = 'Ref.';
$lang['Stat_rows'] = 'Rows';
$lang['Stat_Extra'] = 'Comment';
$lang['Stat_Comment'] = 'Comment';
$lang['Stat_id'] = 'Id';
$lang['Stat_select_type'] = 'Select type';

// debug
$lang['dbg_line'] = 'Line: %s';
$lang['dbg_file'] = 'File: %s';
$lang['dbg_empty'] = 'Empty';
//-- fin mod : run stats -------------------------------------------------------
$lang['Login_attempts_exceeded'] = 'The maximum number of %s login attempts has been exceeded. You are not allowed to login for the next %s minutes.';
$lang['Please_remove_install_contrib'] = 'Please ensure both the install/ directorie are deleted';
//
// Custom Profile Fields MOD
//
$lang['custom_field_notice'] = 'These items have been created by an administrator. They may or may not be publicly viewable. Items marked with a * are required fields.';
$lang['and'] = ' and ';

$lang['Session_invalid'] = 'Invalid Session. Please resubmit the form.';
//
// END Custom Profile Fields MOD
//
//
// That's all, Folks!
// -------------------------------------------------

?>
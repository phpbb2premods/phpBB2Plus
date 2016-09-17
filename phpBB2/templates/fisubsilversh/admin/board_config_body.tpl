<div class="maintitle">{L_CONFIGURATION_TITLE}</div>
<br />
<div class="genmed">{L_CONFIGURATION_EXPLAIN}</div>
<br />
<form action="{S_CONFIG_ACTION}" method="post">
<table width="99%" cellpadding="3" cellspacing="1" border="0" align="center" class="forumline">
<tr> 
<th colspan="2">{L_GENERAL_SETTINGS}</th>
</tr>
<tr> 
<td class="row1" width="38%">{L_SERVER_NAME}</td>
<td class="row2" width="62%"> 
<input type="text" maxlength="255" size="40" name="server_name" value="{SERVER_NAME}" class="post" />
</td>
</tr>
<tr> 
<td class="row1">{L_SERVER_PORT}<br />
<span class="gensmall">{L_SERVER_PORT_EXPLAIN}</span></td>
<td class="row2"> 
<input type="text" maxlength="5" size="5" name="server_port" value="{SERVER_PORT}" class="post" />
</td>
</tr>
<tr> 
<td class="row1">{L_SCRIPT_PATH}<br />
<span class="gensmall">{L_SCRIPT_PATH_EXPLAIN}</span></td>
<td class="row2"> 
<input type="text" maxlength="255" name="script_path" value="{SCRIPT_PATH}" class="post" />
</td>
</tr>
<tr> 
<td class="row1">{L_SITE_NAME}<br />
<span class="gensmall">{L_SITE_NAME_EXPLAIN}</span></td>
<td class="row2"> 
<input type="text" size="25" maxlength="100" name="sitename" value="{SITENAME}" class="post" />
</td>
</tr>
<tr> 
<td class="row1">{L_SITE_DESCRIPTION}</td>
<td class="row2"> 
<input type="text" size="40" maxlength="255" name="site_desc" value="{SITE_DESCRIPTION}" class="post" />
</td>
</tr>
<tr> 
<td class="row1">{L_DISABLE_BOARD}<br />
<span class="gensmall">{L_DISABLE_BOARD_EXPLAIN}</span></td>
<td class="row2"> 
<input type="radio" name="board_disable" value="1" {S_DISABLE_BOARD_YES} />
{L_YES}&nbsp;&nbsp; 
<input type="radio" name="board_disable" value="0" {S_DISABLE_BOARD_NO} />
{L_NO}</td>
</tr>
<tr>
<td class="row1">{L_DISABLE_BOARD_MSG}<br /><span class="gensmall">{L_DISABLE_BOARD_MSG_EXPLAIN}</span></td>
<td class="row2"><input class="post" type="text" maxlength="255" size="40" name="board_disable_msg" value="{DISABLE_BOARD_MSG}" /></td></td>
</tr>
<tr>
<td class="row1">{L_REGISTRATION_STATUS}<br /><span class="gensmall">{L_REGISTRATION_STATUS_EXPLAIN}</span></td>
<td class="row2"><input type="radio" name="registration_status" value="1" {S_REGISTRATION_STATUS_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="registration_status" value="0" {S_REGISTRATION_STATUS_NO} /> {L_NO}</td>
</tr>
<tr>
<td class="row1">{L_REGISTRATION_CLOSED}<br /><span class="gensmall">{L_REGISTRATION_CLOSED_EXPLAIN}</span></td>
<td class="row2"><input class="post" type="text" size="40" maxlength="255" name="registration_closed" value="{REGISTRATION_CLOSED}" /></td>
</tr>
<!-- BEGIN switch_confirm -->
<tr>
<td class="row1">{L_VISUAL_CONFIRM}<br /><span class="gensmall">{L_VISUAL_CONFIRM_EXPLAIN}</span></td>
<td class="row2"><input type="radio" name="enable_confirm" value="1" {CONFIRM_ENABLE} />{L_YES}&nbsp; &nbsp;<input type="radio" name="enable_confirm" value="0" {CONFIRM_DISABLE} />{L_NO}</td>
</tr>
<!-- END switch_confirm -->
<tr>
<td class="row1">{L_ALLOW_AUTOLOGIN}<br />
<span class="gensmall">{L_ALLOW_AUTOLOGIN_EXPLAIN}</span></td>
<td class="row2">
<input type="radio" name="allow_autologin" value="1" {ALLOW_AUTOLOGIN_YES} />
{L_YES}&nbsp; &nbsp;
<input type="radio" name="allow_autologin" value="0" {ALLOW_AUTOLOGIN_NO} />
{L_NO}</td>
</tr>
<tr>
<td class="row1">{L_AUTOLOGIN_TIME} <br />
<span class="gensmall">{L_AUTOLOGIN_TIME_EXPLAIN}</span></td>
<td class="row2">
<input class="post" type="text" size="3" maxlength="4" name="max_autologin_time" value="{AUTOLOGIN_TIME}" />
</td>
</tr>
<tr> 
<td class="row1">{L_ACCT_ACTIVATION}</td>
<td class="row2"> 
<input type="radio" name="require_activation" value="{ACTIVATION_NONE}" {ACTIVATION_NONE_CHECKED} />
{L_NONE}&nbsp; &nbsp; 
<input type="radio" name="require_activation" value="{ACTIVATION_USER}" {ACTIVATION_USER_CHECKED} />
{L_USER}&nbsp; &nbsp; 
<input type="radio" name="require_activation" value="{ACTIVATION_ADMIN}" {ACTIVATION_ADMIN_CHECKED} />
{L_ADMIN}</td>
</tr>
<tr> 
<td class="row1">{L_BOARD_EMAIL_FORM}<br />
<span class="gensmall">{L_BOARD_EMAIL_FORM_EXPLAIN}</span></td>
<td class="row2"> 
<input type="radio" name="board_email_form" value="1" {BOARD_EMAIL_FORM_ENABLE} />
{L_ENABLED}&nbsp;&nbsp; 
<input type="radio" name="board_email_form" value="0" {BOARD_EMAIL_FORM_DISABLE} />
{L_DISABLED}</td>
</tr>
<tr> 
<td class="row1">{L_FLOOD_INTERVAL} <br />
<span class="gensmall">{L_FLOOD_INTERVAL_EXPLAIN}</span></td>
<td class="row2"> 
<input type="text" size="3" maxlength="4" name="flood_interval" value="{FLOOD_INTERVAL}" class="post" />
</td>
</tr>
<tr>
<td class="row1">{L_SEARCH_FLOOD_INTERVAL} <br /><span class="gensmall">{L_SEARCH_FLOOD_INTERVAL_EXPLAIN}</span></td>
<td class="row2">
<input class="post" type="text" size="3" maxlength="4" name="search_flood_interval" value="{SEARCH_FLOOD_INTERVAL}" />
</td>
</tr>
<tr> 
<td class="row1">{L_TOPICS_PER_PAGE}</td>
<td class="row2"> 
<input type="text" name="topics_per_page" size="3" maxlength="4" value="{TOPICS_PER_PAGE}" class="post" />
</td>
</tr>
<tr> 
<td class="row1">{L_POSTS_PER_PAGE}</td>
<td class="row2"> 
<input type="text" name="posts_per_page" size="3" maxlength="4" value="{POSTS_PER_PAGE}" class="post" />
</td>
</tr>
<tr> 
<td class="row1">{L_HOT_THRESHOLD}</td>
<td class="row2"> 
<input type="text" name="hot_threshold" size="3" maxlength="4" value="{HOT_TOPIC}" class="post" />
</td>
</tr>
<tr> 
<td class="row1">{L_DEFAULT_STYLE}</td>
<td class="row2">{STYLE_SELECT}</td>
</tr>
<tr> 
<td class="row1">{L_OVERRIDE_STYLE}<br />
<span class="gensmall">{L_OVERRIDE_STYLE_EXPLAIN}</span></td>
<td class="row2"> 
<input type="radio" name="override_user_style" value="1" {OVERRIDE_STYLE_YES} />
{L_YES}&nbsp;&nbsp; 
<input type="radio" name="override_user_style" value="0" {OVERRIDE_STYLE_NO} />
{L_NO}</td>
</tr>
<tr> 
<td class="row1">{L_DEFAULT_LANGUAGE}</td>
<td class="row2">{LANG_SELECT}</td>
</tr>
<tr> 
<td class="row1">{L_DATE_FORMAT}</td>
<td class="row2"><span class="gensmall">{DEFAULT_DATEFORMAT}</span></td>
</tr>
<tr> 
<td class="row1">{L_SYSTEM_TIMEZONE}</td>
<td class="row2">{TIMEZONE_SELECT}</td>
</tr>
<tr> 
<td class="row1">{L_ENABLE_GZIP}</td>
<td class="row2"> 
<input type="radio" name="gzip_compress" value="1" {GZIP_YES} />
{L_YES}&nbsp;&nbsp; 
<input type="radio" name="gzip_compress" value="0" {GZIP_NO} />
{L_NO}</td>
</tr>
<tr> 
<td class="row1">{L_ENABLE_PRUNE}</td>
<td class="row2"> 
<input type="radio" name="prune_enable" value="1" {PRUNE_YES} />
{L_YES}&nbsp;&nbsp; 
<input type="radio" name="prune_enable" value="0" {PRUNE_NO} />
{L_NO}</td>
</tr>
<!-- Start add - Fully integrated shoutbox MOD -->
<tr>
<td class="row1">{L_PRUNE_SHOUTS}<br /><span class="gensmall">{L_PRUNE_SHOUTS_EXPLAIN}</span></td>
<td class="row2"><input class="post" type="text" size="6" maxlength="6" name="prune_shouts" value="{PRUNE_SHOUTS}" /></td>
</tr>
<!-- End add - Fully integrated shoutbox MOD -->
<tr> 
<td class="row1">{L_BLUECARD_LIMIT_2}<br /><span class="gensmall">{L_BLUECARD_LIMIT_2_EXPLAIN}</span></td> 
<td class="row2"><input class="post" type="text" size="4" maxlength="4" name="bluecard_limit_2" value="{BLUECARD_LIMIT_2}" /></td> 
</tr> 
<tr> 
<td class="row1">{L_BLUECARD_LIMIT}<br /><span class="gensmall">{L_BLUECARD_LIMIT_EXPLAIN}</span></td> 
<td class="row2"><input class="post" type="text" size="4" maxlength="4" name="bluecard_limit" value="{BLUECARD_LIMIT}" /></td> 
</tr> 
<tr> 
<td class="row1">{L_MAX_USER_BANCARD}<br /><span class="gensmall">{L_MAX_USER_BANCARD_EXPLAIN}</span></td> 
<td class="row2"><input class="post" type="text" size="4" maxlength="4" name="max_user_bancard" value="{MAX_USER_BANCARD}" /></td> 
</tr> 
<tr> 
<td class="row1">{L_REPORT_FORUM}<br /><span class="gensmall">{L_REPORT_FORUM_EXPLAIN}</span></td> 
<td class="row2">{S_REPORT_FORUM}</td> 
</tr>
<!-- Start add - Last visit MOD -->
<tr> 
<td class="row1">{L_HIDDE_LAST_LOGON}<br /><span class="gensmall">{L_HIDDE_LAST_LOGON_EXPLAIN}</span></td> 
<td class="row2"><input type="radio" name="hidde_last_logon" value="1" {HIDDE_LAST_LOGON_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="hidde_last_logon" value="0" {HIDDE_LAST_LOGON_NO} /> {L_NO}</td> 
</tr> 
<!-- End add - Last visit MOD -->
<!-- Start add - Birthday MOD -->
<tr>
<td class="row1">{L_BIRTHDAY_REQUIRED}<br /></td>
<td class="row2"><input type="radio" name="birthday_required" value="1" {BIRTHDAY_REQUIRED_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="birthday_required" value="0" {BIRTHDAY_REQUIRED_NO} /> {L_NO}</td>
</tr>
<tr>
<td class="row1">{L_ENABLE_BIRTHDAY_GREETING}<br /><span class="gensmall">{L_BIRTHDAY_GREETING_EXPLAIN}</span></td>
<td class="row2"><input type="radio" name="birthday_greeting" value="1" {BIRTHDAY_GREETING_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="birthday_greeting" value="0" {BIRTHDAY_GREETING_NO} /> {L_NO}</td>
</tr>
<tr>
<td class="row1">{L_MAX_USER_AGE}<br /></td>
<td class="row2"><input class="post" type="text" size="4" maxlength="4" name="max_user_age" value="{MAX_USER_AGE}" /></td>
</tr>
<tr>
<td class="row1">{L_MIN_USER_AGE}<br /><span class="gensmall">{L_MIN_USER_AGE_EXPLAIN}</span></td>
<td class="row2"><input class="post" type="text" size="4" maxlength="4" name="min_user_age" value="{MIN_USER_AGE}" /></td>
</tr>
<tr>
<td class="row1">{L_BIRTHDAY_LOOKFORWARD}<br /><span class="gensmall">{L_BIRTHDAY_LOOKFORWARD_EXPLAIN}</span></td>
<td class="row2"><input class="post" type="text" size="3" maxlength="3" name="birthday_check_day" value="{BIRTHDAY_LOOKFORWARD}" /></td>
</tr>
<!-- End add - Birthday MOD -->
<tr> 
<th colspan="2">{L_COOKIE_SETTINGS}</th>
</tr>
<tr> 
<td class="row2" colspan="2"><span class="gensmall">{L_COOKIE_SETTINGS_EXPLAIN}</span></td>
</tr>
<tr> 
<td class="row1">{L_COOKIE_DOMAIN}</td>
<td class="row2"> 
<input type="text" maxlength="255" name="cookie_domain" value="{COOKIE_DOMAIN}" class="post" />
</td>
</tr>
<tr> 
<td class="row1">{L_COOKIE_NAME}</td>
<td class="row2"> 
<input type="text" maxlength="16" name="cookie_name" value="{COOKIE_NAME}" class="post" />
</td>
</tr>
<tr> 
<td class="row1">{L_COOKIE_PATH}</td>
<td class="row2"> 
<input type="text" maxlength="255" name="cookie_path" value="{COOKIE_PATH}" class="post" />
</td>
</tr>
<tr> 
<td class="row1">{L_COOKIE_SECURE}<br />
<span class="gensmall">{L_COOKIE_SECURE_EXPLAIN}</span></td>
<td class="row2"> 
<input type="radio" name="cookie_secure" value="0" {S_COOKIE_SECURE_DISABLED} />
{L_DISABLED}&nbsp; &nbsp; 
<input type="radio" name="cookie_secure" value="1" {S_COOKIE_SECURE_ENABLED} />
{L_ENABLED}</td>
</tr>
<tr> 
<td class="row1">{L_SESSION_LENGTH}</td>
<td class="row2"> 
<input type="text" maxlength="5" size="5" name="session_length" value="{SESSION_LENGTH}" class="post" />
</td>
</tr>
<tr> 
<th colspan="2">{L_PRIVATE_MESSAGING}</th>
</tr>
<tr> 
<td class="row1">{L_DISABLE_PRIVATE_MESSAGING}</td>
<td class="row2"> 
<input type="radio" name="privmsg_disable" value="0" {S_PRIVMSG_ENABLED} />
{L_ENABLED}&nbsp; &nbsp; 
<input type="radio" name="privmsg_disable" value="1" {S_PRIVMSG_DISABLED} />
{L_DISABLED}</td>
</tr>
<tr> 
<td class="row1">{L_INBOX_LIMIT}</td>
<td class="row2"> 
<input type="text" maxlength="4" size="4" name="max_inbox_privmsgs" value="{INBOX_LIMIT}" class="post" />
</td>
</tr>
<tr> 
<td class="row1">{L_SENTBOX_LIMIT}</td>
<td class="row2"> 
<input type="text" maxlength="4" size="4" name="max_sentbox_privmsgs" value="{SENTBOX_LIMIT}" class="post" />
</td>
</tr>
<tr> 
<td class="row1">{L_SAVEBOX_LIMIT}</td>
<td class="row2"> 
<input type="text" maxlength="4" size="4" name="max_savebox_privmsgs" value="{SAVEBOX_LIMIT}" class="post" />
</td>
</tr>
<!-- Start add - Protect user account MOD -->
<tr>
<th class="thHead" colspan="2">{L_USER_PASSWORD_SETTINGS}</th>
</tr>
<tr> 
<td class="row1">{L_PASSWORD_INTERVALL}<br /><span class="gensmall">{L_PASSWORD_INTERVALL_EXPLAIN}</span></td> 
<td class="row2"><input class="post" type="text" size="4" maxlength="4" name="max_password_age" value="{PASSWORD_INTERVALL}" /></td> 
</tr> 
<tr> 
<td class="row1">{L_MAX_LOGIN_ERROR}<br /><span class="gensmall">{L_MAX_LOGIN_ERROR_EXPLAIN}</span></td> 
<td class="row2"><input class="post" type="text" size="4" maxlength="4" name="max_login_error" value="{MAX_LOGIN_ERROR}" /></td> 
</tr> 
<tr> 
<td class="row1">{L_BLOCK_TIME}<br /><span class="gensmall">{L_BLOCK_TIME_EXPLAIN}</span></td> 
<td class="row2"><input class="post" type="text" size="4" maxlength="4" name="block_time" value="{BLOCK_TIME}" /></td> 
</tr>
<tr>
<td class="row1">{L_PASSWORD_COMPLEX}<br /><span class="gensmall">{L_PASSWORD_COMPLEX_EXPLAIN}</span></td>
<td class="row2"><input type="radio" name="force_complex_password" value="1" {S_PASSWORD_COMPLEX_ENABLED} />{L_ENABLED}&nbsp; &nbsp;<input type="radio" name="force_complex_password" value="0" {S_PASSWORD_COMPLEX_DISABLED} />{L_DISABLED}</td>
</tr>
<tr>
<td class="row1">{L_PASSWORD_NOT_LOGIN}<br /><span class="gensmall">{L_PASSWORD_NOT_LOGIN_EXPLAIN}</span></td>
<td class="row2"><input type="radio" name="password_not_login" value="1" {S_PASSWORD_NOT_LOGIN_ENABLED} />{L_ENABLED}&nbsp; &nbsp;<input type="radio" name="password_not_login" value="0" {S_PASSWORD_NOT_LOGIN_DISABLED} />{L_DISABLED}</td>
</tr>
<tr> 
<td class="row1">{L_PASSWORD_LEN}<br /><span class="gensmall">{L_PASSWORD_LEN_EXPLAIN}</span></td> 
<td class="row2"><input class="post" type="text" size="4" maxlength="4" name="min_password_len" value="{MIN_PASSWORD_LEN}" /></td> 
</tr>
<!-- End add - Protect user account MOD -->
<tr> 
<th colspan="2">{L_ABILITIES_SETTINGS}</th>
</tr>
<tr> 
<td class="row1">{L_MAX_POLL_OPTIONS}</td>
<td class="row2"> 
<input type="text" name="max_poll_options" size="4" maxlength="4" value="{MAX_POLL_OPTIONS}" class="post" />
</td>
</tr>
<tr> 
<td class="row1">{L_ALLOW_HTML}</td>
<td class="row2"> 
<input type="radio" name="allow_html" value="1" {HTML_YES} />
{L_YES}&nbsp;&nbsp; 
<input type="radio" name="allow_html" value="0" {HTML_NO} />
{L_NO}</td>
</tr>
<tr> 
<td class="row1">{L_ALLOWED_TAGS}<br />
<span class="gensmall">{L_ALLOWED_TAGS_EXPLAIN}</span></td>
<td class="row2"> 
<input type="text" size="30" maxlength="255" name="allow_html_tags" value="{HTML_TAGS}" class="post" />
</td>
</tr>
<tr> 
<td class="row1">{L_ALLOW_BBCODE}</td>
<td class="row2"> 
<input type="radio" name="allow_bbcode" value="1" {BBCODE_YES} />
{L_YES}&nbsp;&nbsp; 
<input type="radio" name="allow_bbcode" value="0" {BBCODE_NO} />
{L_NO}</td>
</tr>
<tr> 
<td class="row1">{L_ALLOW_SMILIES}</td>
<td class="row2"> 
<input type="radio" name="allow_smilies" value="1" {SMILE_YES} />
{L_YES}&nbsp;&nbsp; 
<input type="radio" name="allow_smilies" value="0" {SMILE_NO} />
{L_NO}</td>
</tr>
<tr> 
<td class="row1">{L_SMILIES_PATH} <br />
<span class="gensmall">{L_SMILIES_PATH_EXPLAIN}</span></td>
<td class="row2"> 
<input type="text" size="20" maxlength="255" name="smilies_path" value="{SMILIES_PATH}" class="post" />
</td>
</tr>
<tr> 
<td class="row1">{L_ALLOW_SIG}</td>
<td class="row2"> 
<input type="radio" name="allow_sig" value="1" {SIG_YES} />
{L_YES}&nbsp;&nbsp; 
<input type="radio" name="allow_sig" value="0" {SIG_NO} />
{L_NO}</td>
</tr>
<tr> 
<td class="row1">{L_MAX_SIG_LENGTH}<br />
<span class="gensmall">{L_MAX_SIG_LENGTH_EXPLAIN}</span></td>
<td class="row2"> 
<input type="text" size="5" maxlength="4" name="max_sig_chars" value="{SIG_SIZE}" class="post" />
</td>
</tr>
<tr> 
<td class="row1">{L_ALLOW_NAME_CHANGE}</td>
<td class="row2"> 
<input type="radio" name="allow_namechange" value="1" {NAMECHANGE_YES} />
{L_YES}&nbsp;&nbsp; 
<input type="radio" name="allow_namechange" value="0" {NAMECHANGE_NO} />
{L_NO}</td>
</tr>
<tr>
<td class="row1">{L_ABSENCE_USER_ALLOWED}</td>
<td class="row2"><input type="radio" name="users_allow_absence" value="1" {ABSENCE_USER_ALLOWED_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="users_allow_absence" value="0" {ABSENCE_USER_ALLOWED_NO} /> {L_NO}</td>
</tr>
<tr>
<td class="row1">{L_MOD_ABLE_SENT_ABSENT}</td>
<td class="row2"><input type="radio" name="mod_able_sent_absent" value="1" {MOD_ABLE_SENT_ABSENT_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="mod_able_sent_absent" value="0" {MOD_ABLE_SENT_ABSENT_NO} /> {L_NO}</td>
</tr>
<tr>
<td class="row1">{L_ABSENT_BUTTON}</td>
<td class="row2"><input type="radio" name="absent_button" value="1" {ABSENT_BUTTON_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="absent_button" value="0" {ABSENT_BUTTON_NO} /> {L_NO}</td>
</tr>
<tr>
<td class="row1">{L_MAX_LINK_BOOKMARKS}<br /><span class="gensmall">{L_MAX_LINK_BOOKMARKS_EXPLAIN}</span></td>
<td class="row2"><input class="post" type="text" size="4" maxlength="3" name="max_link_bookmarks" value="{LINK_BOOKMARKS}" /></td>
</tr>
<tr> 
<th colspan="2">{L_AVATAR_SETTINGS}</th>
</tr>
<tr> 
<td class="row1">{L_ALLOW_LOCAL}</td>
<td class="row2"> 
<input type="radio" name="allow_avatar_local" value="1" {AVATARS_LOCAL_YES} />
{L_YES}&nbsp;&nbsp; 
<input type="radio" name="allow_avatar_local" value="0" {AVATARS_LOCAL_NO} />
{L_NO}</td>
</tr>
<tr> 
<td class="row1">{L_ALLOW_REMOTE} <br />
<span class="gensmall">{L_ALLOW_REMOTE_EXPLAIN}</span></td>
<td class="row2"> 
<input type="radio" name="allow_avatar_remote" value="1" {AVATARS_REMOTE_YES} />
{L_YES}&nbsp;&nbsp; 
<input type="radio" name="allow_avatar_remote" value="0" {AVATARS_REMOTE_NO} />
{L_NO}</td>
</tr>
<tr> 
<td class="row1">{L_ALLOW_UPLOAD}</td>
<td class="row2"> 
<input type="radio" name="allow_avatar_upload" value="1" {AVATARS_UPLOAD_YES} />
{L_YES}&nbsp;&nbsp; 
<input type="radio" name="allow_avatar_upload" value="0" {AVATARS_UPLOAD_NO} />
{L_NO}</td>
</tr>
<tr> 
<td class="row1">{L_MAX_FILESIZE}<br />
<span class="gensmall">{L_MAX_FILESIZE_EXPLAIN}</span></td>
<td class="row2"> 
<input type="text" size="4" maxlength="10" name="avatar_filesize" value="{AVATAR_FILESIZE}" class="post" />
Bytes</td>
</tr>
<tr> 
<td class="row1">{L_MAX_AVATAR_SIZE} <br />
<span class="gensmall">{L_MAX_AVATAR_SIZE_EXPLAIN}</span> </td>
<td class="row2"> 
<input type="text" size="3" maxlength="4" name="avatar_max_height" value="{AVATAR_MAX_HEIGHT}" class="post" />
x 
<input type="text" size="3" maxlength="4" name="avatar_max_width" value="{AVATAR_MAX_WIDTH}" class="post" />
</td>
</tr>
<tr> 
<td class="row1">{L_AVATAR_STORAGE_PATH} <br />
<span class="gensmall">{L_AVATAR_STORAGE_PATH_EXPLAIN}</span></td>
<td class="row2"> 
<input type="text" size="20" maxlength="255" name="avatar_path" value="{AVATAR_PATH}" class="post" />
</td>
</tr>
<tr> 
<td class="row1">{L_AVATAR_GALLERY_PATH} <br />
<span class="gensmall">{L_AVATAR_GALLERY_PATH_EXPLAIN}</span></td>
<td class="row2"> 
<input type="text" size="20" maxlength="255" name="avatar_gallery_path" value="{AVATAR_GALLERY_PATH}" class="post" />
</td>
</tr>
<tr> 
<th colspan="2">{L_COPPA_SETTINGS}</th>
</tr>
<tr> 
<td class="row1">{L_COPPA_FAX}</td>
<td class="row2"> 
<input type="text" size="25" maxlength="100" name="coppa_fax" value="{COPPA_FAX}" class="post" />
</td>
</tr>
<tr> 
<td class="row1">{L_COPPA_MAIL}<br />
<span class="gensmall">{L_COPPA_MAIL_EXPLAIN}</span></td>
<td class="row2"> 
<textarea name="coppa_mail" rows="5" cols="30" style="width: 300px" class="post">{COPPA_MAIL}</textarea>
</td>
</tr>
<tr> 
<th colspan="2">{L_EMAIL_SETTINGS}</th>
</tr>
<tr> 
<td class="row1">{L_ADMIN_EMAIL}</td>
<td class="row2"> 
<input type="text" size="25" maxlength="100" name="board_email" value="{EMAIL_FROM}" class="post" />
</td>
</tr>
<tr> 
<td class="row1">{L_EMAIL_SIG}<br />
<span class="gensmall">{L_EMAIL_SIG_EXPLAIN}</span></td>
<td class="row2"> 
<textarea name="board_email_sig" rows="5" cols="30" style="width: 300px" class="post">{EMAIL_SIG}</textarea>
</td>
</tr>
<tr> 
<td class="row1">{L_USE_SMTP}<br />
<span class="gensmall">{L_USE_SMTP_EXPLAIN}</span></td>
<td class="row2"> 
<input type="radio" name="smtp_delivery" value="1" {SMTP_YES} />
{L_YES}&nbsp;&nbsp; 
<input type="radio" name="smtp_delivery" value="0" {SMTP_NO} />
{L_NO}</td>
</tr>
<tr> 
<td class="row1">{L_SMTP_SERVER}</td>
<td class="row2"> 
<input type="text" name="smtp_host" value="{SMTP_HOST}" size="25" maxlength="50" class="post" />
</td>
</tr>
<tr> 
<td class="row1">{L_SMTP_USERNAME}<br />
<span class="gensmall">{L_SMTP_USERNAME_EXPLAIN}</span></td>
<td class="row2"> 
<input type="text" name="smtp_username" value="{SMTP_USERNAME}" size="25" maxlength="255" class="post" />
</td>
</tr>
<tr> 
<td class="row1">{L_SMTP_PASSWORD}<br />
<span class="gensmall">{L_SMTP_PASSWORD_EXPLAIN}</span></td>
<td class="row2"> 
<input type="password" name="smtp_password" value="{SMTP_PASSWORD}" size="25" maxlength="255" class="post" />
</td>
</tr>
<tr> 
<td class="cat" colspan="2" align="center">{S_HIDDEN_FIELDS} 
<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />
&nbsp;&nbsp; 
<input type="reset" value="{L_RESET}" class="button" />
</td>
</tr>
</table>
</form>
<br clear="all" />

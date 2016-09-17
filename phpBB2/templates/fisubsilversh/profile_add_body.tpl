<script type="text/javascript" src="includes/javascript/ajax_postfunctions.js"></script>
<script type="text/javascript" src="includes/javascript/ajax_regfunctions.js"></script>

<form action="{S_PROFILE_ACTION}" {S_FORM_ENCTYPE} method="post" name="addprofile">

<table width="100%" cellspacing="2" cellpadding="3" border="0">
<tr>
	<td class="maintitle">{L_PROFILE_INFO}</td>
</tr>
<tr>
<td class="nav"><a href="{U_INDEX}">{L_INDEX}</a> &raquo; {L_PROFILE_INFO}</td>
</tr>
</table>
{ERROR_BOX}
<table border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
<tr>
<th colspan="2">{L_REGISTRATION_INFO}</th>
</tr>
<tr>
<td height="22" colspan="2" class="row2"><span class="gensmall">{L_ITEMS_REQUIRED}</span></td>
</tr>
<!-- BEGIN switch_namechange_disallowed -->
<tr>
<td class="row1" width="38%"><span class="explaintitle">{L_USERNAME}:</span> *</td>
<td width="62%" class="row2"><input type="hidden" name="username" value="{USERNAME}" />
<span class="name">{USERNAME}</span></td>
</tr>
<!-- END switch_namechange_disallowed -->
<!-- BEGIN switch_namechange_allowed -->
<tr>
<td class="row1" width="38%"><span class="explaintitle">{L_USERNAME}:</span> *</td>
<td class="row2" width="62%">
<input type="text" class="post" style="width:200px" name="username" size="25" maxlength="25" value="{USERNAME}" onblur="AJAXCheckPostUsername(this.value);" />
</td>
</tr>
<tr id="post_username_error_tbl" style="display:none;">
<td class="row1">&nbsp;</td>
<td class="row2"><span class="gen" id="post_username_error_text">&nbsp;</span></td>
</tr>
<!-- END switch_namechange_allowed -->
<tr>
<td class="row1"><span class="explaintitle">{L_EMAIL_ADDRESS}:</span> *</td>
<td class="row2">
<input type="text" class="post" style="width:200px" name="email" size="25" maxlength="255" value="{EMAIL}" onblur="AJAXCheckEmail(this.value);" />
</td>
</tr>
<tr id="email_error_tbl" style="display:none;">
<td class="row1">&nbsp;</td>
<td class="row2"><span class="gen" id="email_error_text">&nbsp;</span></td>
</tr>
<!-- BEGIN switch_edit_profile -->
<tr>
<td class="row1"><span class="explaintitle">{L_CURRENT_PASSWORD}:</span> *<br />
<span class="gensmall">{L_CONFIRM_PASSWORD_EXPLAIN}</span></td>
<td class="row2">
<input type="password" class="post" style="width: 200px" name="cur_password" size="25" maxlength="32" value="{CUR_PASSWORD}" />
</td>
</tr>
<!-- END switch_edit_profile -->
<tr>
<td class="row1"><span class="explaintitle">{L_NEW_PASSWORD}:</span> *<br />
<span class="gensmall">{L_PASSWORD_IF_CHANGED}</span></td>
<td class="row2">
<input type="password" class="post" style="width: 200px" name="new_password" size="25" maxlength="32" value="{NEW_PASSWORD}" onchange="ComparePasswords(this.value, document.addprofile.password_confirm.value);" />
</td>
</tr>
<tr>
<td class="row1"><span class="explaintitle">{L_CONFIRM_PASSWORD}:</span> * <br />
<span class="gensmall">{L_PASSWORD_CONFIRM_IF_CHANGED}</span></td>
<td class="row2">
<input type="password" class="post" style="width: 200px" name="password_confirm" size="25" maxlength="32" value="{PASSWORD_CONFIRM}" onchange="ComparePasswords(document.addprofile.new_password.value, this.value);" />
</td>
</tr>
<tr id="pass_compare_error_tbl" style="display:none;">
<td class="row1">&nbsp;</td>
<td class="row2"><span class="gen">{L_PASSWORD_MISMATCH}</span></td>
</tr>
<!-- BEGIN switch_confirm -->
<tr>
<td class="row1" colspan="2" align="center"><span class="gensmall">{L_CONFIRM_CODE_IMPAIRED}</span><br /><br />{CONFIRM_IMG}<br /><br /></td>
</tr>
<tr> 
<td class="row1"><span class="explaintitle">{L_CONFIRM_CODE}: * </span><br /><span class="gensmall">{L_CONFIRM_CODE_EXPLAIN}</span></td>
<td class="row2"><input type="text" class="post" style="width: 200px" name="confirm_code" size="6" maxlength="6" value="" /></td>
</tr>
<!-- END switch_confirm -->
<!-- BEGIN switch_validation -->
<tr>
<td class="cat" colspan="2">&nbsp;</td>
</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="tbl"><tr><td class="tbll"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblbot"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblr"><img src="images/spacer.gif" alt="" width="8" height="4" /></td></tr></table>
<br />
<table width="100%" border="0" cellpadding="3" cellspacing="1" class="forumline">
<tr>
<th class="thSides" colspan="2" height="12" valign="middle">{L_VALIDATION}</th>
</tr>
<tr>
<td class="row1" width="38%"><span class="explaintitle">{L_VALIDATION}:</span> *<br /><span class="gensmall">{L_VALIDATION_EXPLAIN}</span></td>
<td class="row2" width="62%"><span class="gen"><img src="{S_ANTI_ROBOT1}" alt="" border="0"><img src="{S_ANTI_ROBOT2}" alt="" border="0"><img src="{S_ANTI_ROBOT3}" alt="" border="0"><img src="{S_ANTI_ROBOT4}" alt="" border="0"><img src="{S_ANTI_ROBOT5}" alt="" border="0"><br /><br /><input type="text" name="reg_key" maxlength="5" size="6"></span></td>
</tr>
<!-- END switch_validation -->
<tr>
<td class="cat" colspan="2">&nbsp;</td>
</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="tbl"><tr><td class="tbll"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblbot"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblr"><img src="images/spacer.gif" alt="" width="8" height="4" /></td></tr></table>
<br />
<table width="100%" border="0" cellpadding="3" cellspacing="1" class="forumline">
<tr>
<th colspan="2">{L_PROFILE_INFO}</th>
</tr>
<tr>
<td height="22" colspan="2" class="row2"><span class="gensmall">{L_PROFILE_INFO_NOTICE}</span></td>
</tr>
<tr>
<td class="row1" width="38%"><span class="explaintitle">{L_ICQ_NUMBER}:</span></td>
<td class="row2" width="62%">
<input type="text" name="icq" class="post" style="width: 100px"  size="10" maxlength="15" value="{ICQ}" />
</td>
</tr>
<tr>
<td class="row1"><span class="explaintitle">{L_AIM}:</span></td>
<td class="row2">
<input type="text" class="post" style="width: 150px"  name="aim" size="20" maxlength="255" value="{AIM}" />
</td>
</tr>
<tr>
<td class="row1"><span class="explaintitle">{L_MESSENGER}:</span></td>
<td class="row2">
<input type="text" class="post" style="width: 150px"  name="msn" size="20" maxlength="255" value="{MSN}" />
</td>
</tr>
<tr>
<td class="row1"><span class="explaintitle">{L_YAHOO}:</span></td>
<td class="row2">
<input type="text" class="post" style="width: 150px"  name="yim" size="20" maxlength="255" value="{YIM}" />
</td>
</tr>
<tr>
<td class="row1"><span class="explaintitle">{L_WEBSITE}:</span></td>
<td class="row2">
<input type="text" class="post" style="width: 200px"  name="website" size="25" maxlength="255" value="{WEBSITE}" />
</td>
</tr>
<tr>
<td class="row1"><span class="explaintitle">{L_LOCATION}:</span></td>
<td class="row2">
<input type="text" class="post" style="width: 200px"  name="location" size="25" maxlength="100" value="{LOCATION}" />
</td>
</tr>
<!-- FLAGHACK-start -->
<tr>
<td class="row1"><span class="explaintitle">{L_FLAG}:</span></td>
<td class="row2"><span class="gensmall">
<table><tr>
<td>{FLAG_SELECT}&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td><img src="images/flags/{FLAG_START}" width="32" height="20" name="user_flag" /></td>
</tr></table>
</span></td>
</tr>
<!-- FLAGHACK-end -->
<tr>
<td class="row1"><span class="explaintitle">{L_OCCUPATION}:</span></td>
<td class="row2">
<input type="text" class="post" style="width: 200px"  name="occupation" size="25" maxlength="100" value="{OCCUPATION}" />
</td>
</tr>
<tr>
<td class="row1"><span class="explaintitle">{L_INTERESTS}:</span></td>
<td class="row2">
<input type="text" class="post" style="width: 200px"  name="interests" size="35" maxlength="150" value="{INTERESTS}" />
</td>
</tr>
<!-- BEGIN allow_absence -->
<tr> 
<td class="row1"><span class="explaintitle">{L_USER_ABSENCE}:</span></td>
<td class="row2"> 
<input type="radio" name="user_absence" value="1" {USER_ABSENCE_YES} />
<span class="gen">{L_YES}</span>&nbsp;&nbsp; 
<input type="radio" name="user_absence" value="0" {USER_ABSENCE_NO} />
<span class="gen">{L_NO}</span></td>
</tr>
<tr>
<td class="row1"><span class="explaintitle">{L_USER_ABSENCE_MODE}:</span></td>
<td class="row2"><span class="gensmall">{S_USER_ABSENCE_MODE}</span></td>
</tr>
<tr> 
<td class="row1"><span class="explaintitle">{L_USER_ABSENCE_TEXT}:</span></td>
<td class="row2"><textarea name="user_absence_text" cols="75" rows="5">{S_USER_ABSENCE_TEXT}</textarea>
</tr>
<!-- END allow_absence -->
<!-- Start add - Gender MOD -->
<tr> 
<td class="row1"><span class="explaintitle">{L_GENDER}:</span></td> 
<td class="row2"> 
<input type="radio" {LOCK_GENDER} name="gender" value="0" {GENDER_NO_SPECIFY_CHECKED}/> 
<span class="gen">{L_GENDER_NOT_SPECIFY}</span>&nbsp;&nbsp; 
<input type="radio" name="gender" value="1" {GENDER_MALE_CHECKED}/> 
<span class="gen">{L_GENDER_MALE}</span>&nbsp;&nbsp; 
<input type="radio" name="gender" value="2" {GENDER_FEMALE_CHECKED}/> 
<span class="gen">{L_GENDER_FEMALE}</span></td> 
</tr>
<!-- End add - Gender MOD -->
<!-- Start add - Birthday MOD -->
<tr>
<td class="row1"><span class="explaintitle">{L_BIRTHDAY}:{BIRTHDAY_REQUIRED}</span></td>
<td class="row2"><span class="gen">{S_BIRTHDAY}</span></td>
</tr>
<!-- End add - Birthday MOD -->
<tr> 
<td class="row1"><span class="explaintitle">{SIG_DESC}:</span></td>
<td class="row2"><INPUT TYPE="submit" VALUE="{SIG_BUTTON_DESC}" name="signature"></td>
</tr>
<!-- Custom Profile Fields MOD start + -->
<!-- BEGIN switch_custom_fields -->
<tr> 
<td class="row3" colspan="2"><span class="gensmall">{switch_custom_fields.L_CUSTOM_FIELD_NOTICE}</span></td>
</tr>
<!-- END switch_custom_fields -->
<!-- BEGIN custom_fields -->
<tr>
<td class="row1"><span class="explaintitle">{custom_fields.NAME}:{custom_fields.REQUIRED}</span>
<!-- BEGIN switch_description -->
<br /><span class="gensmall">{custom_fields.switch_description.DESCRIPTION}</span>
<!-- END switch_description -->
</td>
<td class="row2">
{custom_fields.FIELD}
</td>
</tr>
<!-- END custom_fields -->
<!-- Custom Profile Fields MOD finish + -->
<tr>
<td class="cat" colspan="2">&nbsp;</td>
</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="tbl"><tr><td class="tbll"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblbot"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblr"><img src="images/spacer.gif" alt="" width="8" height="4" /></td></tr></table>
<br />
<table width="100%" border="0" cellpadding="3" cellspacing="1" class="forumline">
<tr>
<th colspan="2">{L_PREFERENCES}</th>
</tr>
<tr>
<td class="row1" width="38%"><span class="explaintitle">{L_PUBLIC_VIEW_EMAIL}:</span></td>
<td class="row2" width="62%">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<td><input type="radio" name="viewemail" value="1" {VIEW_EMAIL_YES} />&nbsp;</td>
<td>{L_YES}&nbsp;&nbsp;</td>
<td><input type="radio" name="viewemail" value="0" {VIEW_EMAIL_NO} />&nbsp;</td>
<td>{L_NO}</td>
</tr>
</table>
</td>
</tr>
<tr>
<td class="row1"><span class="explaintitle">{L_HIDE_USER}:</span></td>
<td class="row2">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<td><input type="radio" name="hideonline" value="1" {HIDE_USER_YES} />&nbsp;</td>
<td>{L_YES}&nbsp;&nbsp;</td>
<td><input type="radio" name="hideonline" value="0" {HIDE_USER_NO} />&nbsp;</td>
<td>{L_NO}</td>
</tr>
</table>
</td>
</tr>
<tr>
<td class="row1"><span class="explaintitle">{L_NOTIFY_ON_REPLY}:</span><br />
<span class="gensmall">{L_NOTIFY_ON_REPLY_EXPLAIN}</span></td>
<td class="row2">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<td><input type="radio" name="notifyreply" value="1" {NOTIFY_REPLY_YES} />&nbsp;</td>
<td>{L_YES}&nbsp;&nbsp;</td>
<td><input type="radio" name="notifyreply" value="0" {NOTIFY_REPLY_NO} />&nbsp;</td>
<td>{L_NO}</td>
</tr>
</table>
</td>
</tr>
<tr>
<td class="row1"><span class="explaintitle">{L_NOTIFY_ON_PRIVMSG}:</span></td>
<td class="row2">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<td><input type="radio" name="notifypm" value="1" {NOTIFY_PM_YES} />&nbsp;</td>
<td>{L_YES}&nbsp;&nbsp;</td>
<td><input type="radio" name="notifypm" value="0" {NOTIFY_PM_NO} />&nbsp;</td>
<td>{L_NO}</td>
</tr>
</table>
</td>
</tr>
<tr>
<td class="row1"><span class="explaintitle">{L_POPUP_ON_PRIVMSG}:</span><br />
<span class="gensmall">{L_POPUP_ON_PRIVMSG_EXPLAIN}</span></td>
<td class="row2">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<td><input type="radio" name="popup_pm" value="1" {POPUP_PM_YES} />&nbsp;</td>
<td>{L_YES}&nbsp;&nbsp;</td>
<td><input type="radio" name="popup_pm" value="0" {POPUP_PM_NO} />&nbsp;</td>
<td>{L_NO}</td>
</tr>
</table>
</td>
</tr>
<tr>
<td class="row1"><span class="explaintitle">{L_ALWAYS_ADD_SIGNATURE}:</span></td>
<td class="row2">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<td><input type="radio" name="attachsig" value="1" {ALWAYS_ADD_SIGNATURE_YES} />&nbsp;</td>
<td>{L_YES}&nbsp;&nbsp;</td>
<td><input type="radio" name="attachsig" value="0" {ALWAYS_ADD_SIGNATURE_NO} />&nbsp;</td>
<td>{L_NO}</td>
</tr>
</table>
</td>
</tr>
<tr>
<td class="row1"><span class="explaintitle">{L_ALWAYS_SET_BOOKMARK}:</span></td>
<td class="row2">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<td><input type="radio" name="setbm" value="1" {ALWAYS_SET_BOOKMARK_YES} />&nbsp;</td>
<td>{L_YES}&nbsp;&nbsp;</td>
<td><input type="radio" name="setbm" value="0" {ALWAYS_SET_BOOKMARK_NO} />&nbsp;</td>
<td>{L_NO}</td>
</tr>
</table>
</td>
</tr>
<tr>
<td class="row1"><span class="explaintitle">{L_ALWAYS_ALLOW_BBCODE}:</span></td>
<td class="row2">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<td><input type="radio" name="allowbbcode" value="1" {ALWAYS_ALLOW_BBCODE_YES} />&nbsp;</td>
<td>{L_YES}&nbsp;&nbsp;</td>
<td><input type="radio" name="allowbbcode" value="0" {ALWAYS_ALLOW_BBCODE_NO} />&nbsp;</td>
<td>{L_NO}</td>
</tr>
</table>
</td>
</tr>
<tr>
<td class="row1"><span class="explaintitle">{L_ALWAYS_ALLOW_HTML}:</span></td>
<td class="row2">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<td><input type="radio" name="allowhtml" value="1" {ALWAYS_ALLOW_HTML_YES} />&nbsp;</td>
<td>{L_YES}&nbsp;&nbsp;</td>
<td><input type="radio" name="allowhtml" value="0" {ALWAYS_ALLOW_HTML_NO} />&nbsp;</td>
<td>{L_NO}</td>
</tr>
</table>
</td>
</tr>
<tr>
<td class="row1"><span class="explaintitle">{L_ALWAYS_ALLOW_SMILIES}:</span></td>
<td class="row2">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<td><input type="radio" name="allowsmilies" value="1" {ALWAYS_ALLOW_SMILIES_YES} />&nbsp;</td>
<td>{L_YES}&nbsp;&nbsp;</td>
<td><input type="radio" name="allowsmilies" value="0" {ALWAYS_ALLOW_SMILIES_NO} />&nbsp;</td>
<td>{L_NO}</td>
</tr>
</table>
</td>
</tr>
<tr>
<td class="row1"><span class="explaintitle">{L_BOARD_LANGUAGE}:</span></td>
<td class="row2">{LANGUAGE_SELECT}</td>
</tr>
<tr>
<td class="row1"><span class="explaintitle">{L_BOARD_STYLE}:</span></td>
<td class="row2">{STYLE_SELECT}</td>
</tr>
<tr>
<td class="row1"><span class="explaintitle">{L_TIMEZONE}:</span></td>
<td class="row2">{TIMEZONE_SELECT}</td>
</tr>
<tr>
<td class="row1"><span class="explaintitle">{L_DATE_FORMAT}:</span></td>
<td class="row2"><span class="gensmall">{DATE_FORMAT_SELECT}</span></td>
</tr>
<!-- BEGIN switch_avatar_block -->
<tr>
<td class="cat" colspan="2">&nbsp;</td>
</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="tbl"><tr><td class="tbll"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblbot"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblr"><img src="images/spacer.gif" alt="" width="8" height="4" /></td></tr></table>
<br />
<table width="100%" border="0" cellpadding="3" cellspacing="1" class="forumline">
<tr>
<th colspan="2">{L_AVATAR_PANEL}</th>
</tr>
<tr>
<td class="row1" colspan="2">
<table width="70%" cellspacing="2" cellpadding="0" border="0" align="center">
<tr>
<td width="65%" class="gensmall">{L_AVATAR_EXPLAIN}</td>
<td align="center" class="gensmall">{L_CURRENT_IMAGE}<br />
{AVATAR}<br />
<input type="checkbox" name="avatardel" />
&nbsp;{L_DELETE_AVATAR}</td>
</tr>
</table>
</td>
</tr>
<!-- BEGIN switch_avatar_local_upload -->
<tr>
<td class="row1"><span class="explaintitle">{L_UPLOAD_AVATAR_FILE}:</span></td>
<td class="row2">
<input type="hidden" name="MAX_FILE_SIZE" value="{AVATAR_SIZE}" />
<input type="file" name="avatar" class="post" style="width:200px" />
</td>
</tr>
<!-- END switch_avatar_local_upload -->
<!-- BEGIN switch_avatar_remote_upload -->
<tr>
<td class="row1"><span class="explaintitle">{L_UPLOAD_AVATAR_URL}</span>:<br />
<span class="gensmall">{L_UPLOAD_AVATAR_URL_EXPLAIN}</span></td>
<td class="row2">
<input type="text" name="avatarurl" size="40" class="post" style="width:200px" />
</td>
</tr>
<!-- END switch_avatar_remote_upload -->
<!-- BEGIN switch_avatar_remote_link -->
<tr>
<td class="row1"><span class="explaintitle">{L_LINK_REMOTE_AVATAR}:</span><br />
<span class="gensmall">{L_LINK_REMOTE_AVATAR_EXPLAIN}</span></td>
<td class="row2">
<input type="text" name="avatarremoteurl" size="40" class="post" style="width:200px" />
</td>
</tr>
<!-- END switch_avatar_remote_link -->
<!-- BEGIN switch_avatar_local_gallery -->
<tr>
<td class="row1"><span class="explaintitle">{L_AVATAR_GALLERY}:</span></td>
<td class="row2">
<input type="submit" name="avatargallery" value="{L_SHOW_GALLERY}" class="button" />
</td>
</tr>
<!-- END switch_avatar_local_gallery -->
<!-- END switch_avatar_block -->
<tr>
<td class="cat" colspan="2" align="center">{S_HIDDEN_FIELDS} 
<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />
&nbsp;&nbsp; 
<input type="reset" value="{L_RESET}" name="reset" class="button" />
</td>
</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="tbl"><tr><td class="tbll"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblbot"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblr"><img src="images/spacer.gif" alt="" width="8" height="4" /></td></tr></table>
<table width="100%" cellspacing="2" cellpadding="3" border="0">
<tr>
<td class="nav"><a href="{U_INDEX}">{L_INDEX}</a> &raquo; {L_PROFILE_INFO}</td>
</tr>
</table>
</form>

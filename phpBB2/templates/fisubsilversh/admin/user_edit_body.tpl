<div class="maintitle">{L_USER_TITLE}</div>
<br />
<div class="genmed">{L_USER_EXPLAIN}</div>
<br />
{ERROR_BOX}
<form action="{S_PROFILE_ACTION}" {S_FORM_ENCTYPE} method="post">
<table width="100%" cellspacing="1" cellpadding="3" border="0" class="forumline">
<tr> 
<th colspan="2">{L_REGISTRATION_INFO}</th>
</tr>
<tr> 
<td class="row2" colspan="2"><span class="gensmall">{L_ITEMS_REQUIRED}</span></td>
</tr>
<tr> 
<td class="row1" width="38%">{L_USERNAME}: *</td>
<td class="row2"> 
<input type="text" name="username" size="35" maxlength="40" value="{USERNAME}" class="post" />
</td>
</tr>
<tr> 
<td class="row1">{L_EMAIL_ADDRESS}: *</td>
<td class="row2"> 
<input type="text" name="email" size="35" maxlength="255" value="{EMAIL}" class="post" />
</td>
</tr>
<tr> 
<td class="row1">{L_NEW_PASSWORD}: *<br />
<span class="gensmall">{L_PASSWORD_IF_CHANGED}</span></td>
<td class="row2"> 
<input type="password" name="password" size="35" maxlength="32" value="" class="post" />
</td>
</tr>
<tr> 
<td class="row1">{L_CONFIRM_PASSWORD}: * <br />
<span class="gensmall">{L_PASSWORD_CONFIRM_IF_CHANGED}</span></td>
<td class="row2"> 
<input type="password" name="password_confirm" size="35" maxlength="32" value="" class="post" />
</td>
</tr>
<tr> 
<td class="cat" colspan="2">&nbsp;</td>
</tr>
<tr> 
<th colspan="2">{L_PROFILE_INFO}</th>
</tr>
<tr> 
<td class="row2" colspan="2"><span class="gensmall">{L_PROFILE_INFO_NOTICE}</span></td>
</tr>
<tr> 
<td class="row1">{L_ICQ_NUMBER}</td>
<td class="row2"> 
<input type="text" name="icq" size="10" maxlength="15" value="{ICQ}" class="post" />
</td>
</tr>
<tr> 
<td class="row1">{L_AIM}</td>
<td class="row2"> 
<input type="text" name="aim" size="20" maxlength="255" value="{AIM}" class="post" />
</td>
</tr>
<tr> 
<td class="row1">{L_MESSENGER}</td>
<td class="row2"> 
<input type="text" name="msn" size="20" maxlength="255" value="{MSN}" class="post" />
</td>
</tr>
<tr> 
<td class="row1">{L_YAHOO}</td>
<td class="row2"> 
<input type="text" name="yim" size="20" maxlength="255" value="{YIM}" class="post" />
</td>
</tr>
<tr> 
<td class="row1">{L_WEBSITE}</td>
<td class="row2"> 
<input type="text" name="website" size="35" maxlength="255" value="{WEBSITE}" class="post" />
</td>
</tr>
<tr> 
<td class="row1">{L_LOCATION}</td>
<td class="row2"> 
<input type="text" name="location" size="35" maxlength="100" value="{LOCATION}" class="post" />
</td>
</tr>
<!-- FLAGHACK-start -->
<tr>
<td class="row1">{L_FLAG}:</td>
<td class="row2"><span class="gensmall">
<table><tr>
<td>{FLAG_SELECT}&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td><img src="../images/flags/{FLAG_START}" width="32" height="20" name="user_flag" /></td>
</tr></table>
</span></td>
</tr>
<!-- FLAGHACK-end -->
<tr> 
<td class="row1">{L_OCCUPATION}</td>
<td class="row2"> 
<input type="text" name="occupation" size="35" maxlength="100" value="{OCCUPATION}" class="post" />
</td>
</tr>
<tr> 
<td class="row1">{L_INTERESTS}</td>
<td class="row2"> 
<input type="text" name="interests" size="35" maxlength="150" value="{INTERESTS}" class="post" />
</td>
</tr>
<!-- BEGIN allow_absence -->
<tr>
<td class="row1"><span class="gen">{L_USER_ABSENCE}:</span></td>
<td class="row2">
<input type="radio" name="user_absence" value="1" {USER_ABSENCE_YES} />
<span class="gen">{L_YES}</span>&nbsp;&nbsp;
<input type="radio" name="user_absence" value="0" {USER_ABSENCE_NO} />
<span class="gen">{L_NO}</span></td>
</tr>
<tr>
<td class="row1"><span class="gen">{L_USER_ABSENCE_MODE}:</span></td>
<td class="row2"><span class="gensmall">{S_USER_ABSENCE_MODE}</span></td>
</tr>
<tr>
<td class="row1"><span class="gen">{L_USER_ABSENCE_TEXT}:</span></td>
<td class="row2"><textarea name="user_absence_text" cols="75" rows="5">{S_USER_ABSENCE_TEXT}</textarea>
</tr>
<!-- END allow_absence -->
<!-- Start add - Gender MOD -->
<tr> 
<td class="row1"><span class="gen">{L_GENDER}:</span></td> 
<td class="row2"> 
<input type="radio" name="gender" value="0" {GENDER_NO_SPECIFY_CHECKED}/> 
<span class="gen">{L_GENDER_NOT_SPECIFY}</span>&nbsp;&nbsp; 
<input type="radio" name="gender" value="1" {GENDER_MALE_CHECKED}/> 
<span class="gen">{L_GENDER_MALE}</span>&nbsp;&nbsp; 
<input type="radio" name="gender" value="2" {GENDER_FEMALE_CHECKED}/> 
<span class="gen">{L_GENDER_FEMALE}</span></td> 
</tr>
<!-- End add - Gender MOD -->
<!-- Start add - Birthday MOD -->
<tr>
<td class="row1"><span class="gen">{L_BIRTHDAY}</span></td>
<td class="row2">{S_BIRTHDAY}</td>
</tr>
<tr>
<td class="row1"><span class="gen">{L_NEXT_BIRTHDAY_GREETING}:</span><br /><span class="gensmall">{L_NEXT_BIRTHDAY_GREETING_EXPLAIN}<br /></span></td>
<td class="row2"><input class="post" type="text" name="next_birthday_greeting" size="5" maxlength="4" value="{NEXT_BIRTHDAY_GREETING}" /></td>
</tr>
<!-- End add - Birthday MOD -->
<tr> 
<td class="row1">{L_SIGNATURE}<br />
<span class="gensmall">{L_SIGNATURE_EXPLAIN}<br />
<br />
{HTML_STATUS}<br />
{BBCODE_STATUS}<br />
{SMILIES_STATUS}</span></td>
<td class="row2"> 
<textarea name="signature" rows="6" cols="30" style="width: 300px" class="post">{SIGNATURE}</textarea>
</td>
</tr>
<!-- Custom Profile Fields MOD start + -->
	<!-- BEGIN switch_custom_fields -->
	<tr> 
	  <td class="row3" colspan="2"><span class="gensmall">{switch_custom_fields.L_CUSTOM_FIELD_NOTICE}</span></td>
	</tr>
	<!-- END switch_custom_fields -->
	<!-- BEGIN custom_fields -->
	<tr>
	 <td class="row1" valign="top"><span class="gen">{custom_fields.NAME}:{custom_fields.REQUIRED}{custom_fields.ADMIN_ONLY}</span>
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
<tr> 
<th colspan="2">{L_PREFERENCES}</th>
</tr>
<tr> 
<td class="row1">{L_PUBLIC_VIEW_EMAIL}</td>
<td class="row2"> 
<input type="radio" name="viewemail" value="1" {VIEW_EMAIL_YES} />
{L_YES}&nbsp;&nbsp; 
<input type="radio" name="viewemail" value="0" {VIEW_EMAIL_NO} />
{L_NO}</td>
</tr>
<tr> 
<td class="row1">{L_HIDE_USER}</td>
<td class="row2"> 
<input type="radio" name="hideonline" value="1" {HIDE_USER_YES} />
{L_YES}&nbsp;&nbsp; 
<input type="radio" name="hideonline" value="0" {HIDE_USER_NO} />
{L_NO}</td>
</tr>
<tr> 
<td class="row1">{L_NOTIFY_ON_REPLY}</td>
<td class="row2"> 
<input type="radio" name="notifyreply" value="1" {NOTIFY_REPLY_YES} />
{L_YES}&nbsp;&nbsp; 
<input type="radio" name="notifyreply" value="0" {NOTIFY_REPLY_NO} />
{L_NO}</td>
</tr>
<tr> 
<td class="row1">{L_NOTIFY_ON_PRIVMSG}</td>
<td class="row2"> 
<input type="radio" name="notifypm" value="1" {NOTIFY_PM_YES} />
{L_YES}&nbsp;&nbsp; 
<input type="radio" name="notifypm" value="0" {NOTIFY_PM_NO} />
{L_NO}</td>
</tr>
<tr> 
<td class="row1">{L_POPUP_ON_PRIVMSG}</td>
<td class="row2"> 
<input type="radio" name="popup_pm" value="1" {POPUP_PM_YES} />
{L_YES}&nbsp;&nbsp; 
<input type="radio" name="popup_pm" value="0" {POPUP_PM_NO} />
{L_NO}</td>
</tr>
<tr> 
<td class="row1">{L_ALWAYS_ADD_SIGNATURE}</td>
<td class="row2"> 
<input type="radio" name="attachsig" value="1" {ALWAYS_ADD_SIGNATURE_YES} />
{L_YES}&nbsp;&nbsp; 
<input type="radio" name="attachsig" value="0" {ALWAYS_ADD_SIGNATURE_NO} />
{L_NO}</td>
</tr>
<tr> 
<td class="row1">{L_ALWAYS_SET_BOOKMARK}</td>
<td class="row2"> 
<input type="radio" name="setbm" value="1" {ALWAYS_SET_BOOKMARK_YES} />
<span class="gen">{L_YES}</span>&nbsp;&nbsp; 
<input type="radio" name="setbm" value="0" {ALWAYS_SET_BOOKMARK_NO} />
<span class="gen">{L_NO}</span></td>
</tr>
<tr> 
<td class="row1">{L_ALWAYS_ALLOW_BBCODE}</td>
<td class="row2"> 
<input type="radio" name="allowbbcode" value="1" {ALWAYS_ALLOW_BBCODE_YES} />
{L_YES}&nbsp;&nbsp; 
<input type="radio" name="allowbbcode" value="0" {ALWAYS_ALLOW_BBCODE_NO} />
{L_NO}</td>
</tr>
<tr> 
<td class="row1">{L_ALWAYS_ALLOW_HTML}</td>
<td class="row2"> 
<input type="radio" name="allowhtml" value="1" {ALWAYS_ALLOW_HTML_YES} />
{L_YES}&nbsp;&nbsp; 
<input type="radio" name="allowhtml" value="0" {ALWAYS_ALLOW_HTML_NO} />
{L_NO}</td>
</tr>
<tr> 
<td class="row1">{L_ALWAYS_ALLOW_SMILIES}</td>
<td class="row2"> 
<input type="radio" name="allowsmilies" value="1" {ALWAYS_ALLOW_SMILIES_YES} />
{L_YES}&nbsp;&nbsp; 
<input type="radio" name="allowsmilies" value="0" {ALWAYS_ALLOW_SMILIES_NO} />
{L_NO}</td>
</tr>
<tr> 
<td class="row1">{L_BOARD_LANGUAGE}</td>
<td class="row2">{LANGUAGE_SELECT}</td>
</tr>
<tr> 
<td class="row1">{L_BOARD_STYLE}</td>
<td class="row2">{STYLE_SELECT}</td>
</tr>
<tr> 
<td class="row1">{L_TIMEZONE}</td>
<td class="row2">{TIMEZONE_SELECT}</td>
</tr>
<tr> 
<td class="row1"><span class="gen">{L_DATE_FORMAT}</span></td>
<td class="row2"><span class="gensmall">{DATE_FORMAT_SELECT}</span></td>
</tr>
<tr> 
<td class="cat" colspan="2">&nbsp;</td>
</tr>
<tr> 
<th colspan="2">{L_AVATAR_PANEL}</th>
</tr>
<tr align="center"> 
<td class="row1" colspan="2"> 
<table width="70%" cellspacing="2" cellpadding="0" border="0">
<tr> 
<td width="65%"><span class="gensmall">{L_AVATAR_EXPLAIN}</span></td>
<td align="center"><span class="gensmall">{L_CURRENT_IMAGE}</span><br />
{AVATAR}<br />
<input type="checkbox" name="avatardel" />
&nbsp;<span class="gensmall">{L_DELETE_AVATAR}</span></td>
</tr>
</table>
</td>
</tr>
<!-- BEGIN avatar_local_upload -->
<tr> 
<td class="row1">{L_UPLOAD_AVATAR_FILE}</td>
<td class="row2"> 
<input type="hidden" name="MAX_FILE_SIZE" value="{AVATAR_SIZE}" />
<input type="file" name="avatar" class="post" style="width: 200px"  />
</td>
</tr>
<!-- END avatar_local_upload -->
<!-- BEGIN avatar_remote_upload -->
<tr> 
<td class="row1">{L_UPLOAD_AVATAR_URL}</td>
<td class="row2"> 
<input type="text" name="avatarurl" size="40" class="post" style="width: 200px"  />
</td>
</tr>
<!-- END avatar_remote_upload -->
<!-- BEGIN avatar_remote_link -->
<tr> 
<td class="row1">{L_LINK_REMOTE_AVATAR}</td>
<td class="row2"> 
<input type="text" name="avatarremoteurl" size="40" class="post" style="width: 200px"  />
</td>
</tr>
<!-- END avatar_remote_link -->
<!-- BEGIN avatar_local_gallery -->
<tr> 
<td class="row1">{L_AVATAR_GALLERY}</td>
<td class="row2"> 
<input type="submit" name="avatargallery" value="{L_SHOW_GALLERY}" class="button" />
</td>
</tr>
<!-- END avatar_local_gallery -->
<tr> 
<td class="cat" colspan="2">&nbsp;</td>
</tr>
<tr> 
<th colspan="2">{L_SPECIAL}</th>
</tr>
<tr> 
<td class="row1" colspan="2"><span class="gensmall">{L_SPECIAL_EXPLAIN}</span></td>
</tr>
<tr> 
<td class="row1"><span class="gen">{L_UPLOAD_QUOTA}</span></td>
<td class="row2">{S_SELECT_UPLOAD_QUOTA}</td>
</tr>
<tr> 
<td class="row1"><span class="gen">{L_PM_QUOTA}</span></td>
<td class="row2">{S_SELECT_PM_QUOTA}</td>
</tr>
<tr> 
<td class="row1">{L_USER_ACTIVE}</td>
<td class="row2"> 
<input type="radio" name="user_status" value="1" {USER_ACTIVE_YES} />
{L_YES}&nbsp;&nbsp; 
<input type="radio" name="user_status" value="0" {USER_ACTIVE_NO} />
{L_NO}</td>
</tr>
<tr> 
<td class="row1">{L_ALLOW_PM}</td>
<td class="row2"> 
<input type="radio" name="user_allowpm" value="1" {ALLOW_PM_YES} />
{L_YES}&nbsp;&nbsp; 
<input type="radio" name="user_allowpm" value="0" {ALLOW_PM_NO} />
{L_NO}</td>
</tr>
<tr> 
<td class="row1">{L_ALLOW_AVATAR}</td>
<td class="row2"> 
<input type="radio" name="user_allowavatar" value="1" {ALLOW_AVATAR_YES} />
{L_YES}&nbsp;&nbsp; 
<input type="radio" name="user_allowavatar" value="0" {ALLOW_AVATAR_NO} />
{L_NO}</td>
</tr>
<tr> 
<td class="row1">{L_SELECT_RANK}</td>
<td class="row2"> 
<select name="user_rank">{RANK_SELECT_BOX}
</select>
</td>
</tr>
<!-- Start add - Admin add user MOD -->
<!-- BEGIN switch_show_delete -->
<!-- End add - Admin add user MOD -->
<tr> 
<td class="row1">{L_DELETE_USER}?</td>
<td class="row2"> 
<input type="checkbox" name="deleteuser" />
{L_DELETE_USER_EXPLAIN}</td>
</tr>
<!-- Start add - Admin add user MOD -->
<!-- END switch_show_delete -->
<!-- End add - Admin add user MOD -->
<!-- Start add - Protect user account MOD -->
<tr> 
<td class="row1"><span class="gen">{L_FORCE_NEW_PASSWD} ?</span><br /><span class="gensmall">{L_FORCE_NEW_PASSWD_EXPLAIN}</span></td>
<td class="row2"> 
<input type="checkbox" name="force_new_passwd" {FORCE_NEW_PASSWD_CHECKED} value="ON"> {L_FORCE_NEW_PASSWD_DETAIL}</td>
</tr>
<tr> 
<td class="row1"><span class="gen">{L_ACCOUNT_BLOCK}:</span><br /><span class="gensmall">{L_ACCOUNT_BLOCK_EXPLAIN}<br /></td> 
<td class="row2">
{L_BAD_LOGIN_COUNT}: {BAD_LOGIN_COUNT}<br/>
{BLOCK_UNTIL}{BLOCK_BY}
{BLOCK}</td> 
</tr>
<!-- End add - Protect user account MOD -->
<tr> 
<td class="row1"><span class="gen">{L_BANCARD}:</span><br /><span class="gensmall">{L_BANCARD_EXPLAIN}<br /></td> 
<td class="row2"><input type="text" class="post" style="width: 40px"  name="user_ycard" size="4" maxlength="4" value="{BANCARD}" /></td> 
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
<br />
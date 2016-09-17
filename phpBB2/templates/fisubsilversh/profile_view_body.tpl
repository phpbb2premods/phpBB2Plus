<table width="100%" cellspacing="2" cellpadding="2" border="0">
<tr>
	<td class="maintitle">{L_VIEWING_PROFILE}</td>
</tr>
<tr>
<td class="nav"><a href="{U_INDEX}">{L_INDEX}</a> &raquo; {L_VIEWING_PROFILE}</td>
</tr>
</table>
<table class="forumline" width="100%" cellspacing="1" cellpadding="3" border="0">
<tr>
<th colspan="2">{L_VIEWING_PROFILE}</th>
</tr>
<tr>
<td class="cat" width="40%" align="center">{L_AVATAR}</td>
<td class="cat" width="60%" align="center">{L_ABOUT_USER}</td>
</tr>
<tr>
<td class="row1" align="center">{AVATAR_IMG}<br />
<span class="postdetails">{POSTER_RANK}<br /><br />{L_ABSENCE}&nbsp;<br /><b>{ABSENCE_MESSAGE}</b></span></td>
<td class="row1" rowspan="3" valign="top">
<table width="100%" border="0" cellspacing="1" cellpadding="3">
<tr>
<td align="right" nowrap="nowrap" class="explaintitle">{L_JOINED}:</td>
<td width="100%">{JOINED}</td>
</tr>
<!-- Start add - Last visit MOD -->
<tr> 
<td align="right" nowrap="nowrap" class="explaintitle">{L_LOGON}:</td> 
<td width="100%">{LAST_LOGON}</td> 
</tr>
<!-- BEGIN switch_user_is_moderator -->
<tr> 
<td align="right" nowrap="nowrap" class="explaintitle">{L_TOTAL_ONLINE_TIME}:</td> 
<td width="100%">{TOTAL_ONLINE_TIME}</td> 
</tr> 
<tr> 
<td align="right" nowrap="nowrap" class="explaintitle">{L_LAST_ONLINE_TIME}:</td> 
<td width="100%">{LAST_ONLINE_TIME}</td> 
</tr> 
<tr> 
<td align="right" nowrap="nowrap" class="explaintitle">{L_NUMBER_OF_VISIT}:</td> 
<td width="100%">{NUMBER_OF_VISIT}</td> 
</tr> 
<tr> 
<td align="right" nowrap="nowrap" class="explaintitle">{L_NUMBER_OF_PAGES}:</td> 
<td width="100%">{NUMBER_OF_PAGES}</td> 
</tr> 
<!-- END switch_user_is_moderator -->
<!-- End add - Last visit MOD -->
<tr>
<td align="right" valign="top" nowrap="nowrap" class="explaintitle">{L_TOTAL_POSTS}:</td>
<td valign="top">{POSTS}<br />
<span class="genmed">[{POST_PERCENT_STATS} / {POST_DAY_STATS}]<br />
<a href="{U_SEARCH_USER}">{L_SEARCH_USER_POSTS}</a></span></td>
</tr>
<tr>
<td align="right" nowrap="nowrap" class="explaintitle">{L_LOCATION}:</td>
<td>{LOCATION}</td>
</tr>
<tr>
<td align="right" nowrap="nowrap" class="explaintitle">{L_WEBSITE}:</td>
<td>{WWW}</td>
</tr>
<tr>
<td align="right" nowrap="nowrap" class="explaintitle">{L_OCCUPATION}:</td>
<td>{OCCUPATION}</td>
</tr>
<tr>
<td align="right" valign="top" nowrap="nowrap" class="explaintitle">{L_INTERESTS}:</td>
<td>{INTERESTS}</td>
</tr>
<!-- Custom Profile Fields MOD start + -->
<!-- BEGIN custom_about -->
<tr>
<td align="right" valign="top" nowrap="nowrap" class="explaintitle">{custom_about.ABOUT_N}:</td>
<td>{custom_about.ABOUT_D}</td>
</tr>
<!-- END custom_about -->
<!-- Custom Profile Fields MOD finish + -->
<!-- BEGIN switch_upload_limits -->
<tr> 
<td align="right" valign="top" nowrap="nowrap" class="explaintitle">{L_UPLOAD_QUOTA}:</td>
<td> 
<table width="175" cellspacing="1" cellpadding="2" border="0" class="bodyline">
<tr> 
<td colspan="3" width="100%" class="row2">
<table cellspacing="0" cellpadding="1" border="0">
<tr> 
<td bgcolor="{T_TD_COLOR2}"><img src="templates/fisubsilver/images/spacer.gif" width="{UPLOAD_LIMIT_IMG_WIDTH}" height="8" alt="{UPLOAD_LIMIT_PERCENT}" /></td>
</tr>
</table>
</td>
</tr>
<tr> 
<td width="33%" class="row1"><span class="gensmall">0%</span></td>
<td width="34%" align="center" class="row1"><span class="gensmall">50%</span></td>
<td width="33%" align="right" class="row1"><span class="gensmall">100%</span></td>
</tr>
</table>
<b><span class="genmed">[{UPLOADED} / {QUOTA} / {PERCENT_FULL}]</span> </b><br />
<span class="genmed"><a href="{U_UACP}" class="genmed">{L_UACP}</a></span></td>
</td>
</tr>
<!-- END switch_upload_limits -->
<!-- Start add - Gender MOD --> 
<tr> 
<td align="right" valign="top" nowrap="nowrap" class="explaintitle">{L_GENDER}:</td>
<td>{GENDER}</td>
</tr>
<!-- End add - Gender MOD -->
<!-- Start add - Birthday MOD -->
<tr>
<td align="right" valign="top" nowrap="nowrap" class="explaintitle">{L_BIRTHDAY}:</td>
<td>{BIRTHDAY}</td>
</tr>
<tr>
<td align="right" valign="top" nowrap="nowrap" class="explaintitle">{L_ZODIAC}:</td>
<td>{ZODIAC}&nbsp;{ZODIAC_IMG}</td>
</tr>
<tr>
<td align="right" valign="top" nowrap="nowrap" class="explaintitle">{L_CHINESE}:</td>
<td>{CHINESE}&nbsp;{CHINESE_IMG}</td>
</tr>
<!-- End add - Birthday MOD -->
</table>
</td>
</tr>
<tr>
<td class="cat" align="center">{L_CONTACT} {USERNAME}</td>
</tr>
<tr>
<td class="row1" valign="top">
<table width="100%" border="0" cellspacing="1" cellpadding="3">
<tr>
<td align="right" nowrap="nowrap" class="explaintitle">{L_EMAIL_ADDRESS}:</td>
<td width="100%">{EMAIL_IMG}</td>
</tr>
<tr>
<td align="right" nowrap="nowrap" class="explaintitle">&nbsp;{L_PM}</td>
<td>{PM_IMG}</td>
</tr>
<tr>
<td align="right" nowrap="nowrap" class="explaintitle">{L_MESSENGER}:</td>
<td>{MSN}</td>
</tr>
<tr>
<td align="right" nowrap="nowrap" class="explaintitle">{L_YAHOO}:</td>
<td>{YIM_IMG}</td>
</tr>
<tr>
<td align="right" nowrap="nowrap" class="explaintitle">{L_AIM}:</td>
<td>{AIM_IMG}</td>
</tr>
<tr>
<td align="right" nowrap="nowrap" class="explaintitle">{L_ICQ_NUMBER}:</td>
<td>{ICQ_IMG}</td>
</tr>
<!-- Custom Profile Fields MOD start + -->
<!-- BEGIN custom_contact -->
<tr>
<td align="right" nowrap="nowrap" class="explaintitle">{custom_contact.CONTACT_N}:</td>
<td>{custom_contact.CONTACT_D}</td>
</tr>
<!-- END custom_contact -->
<!-- Custom Profile Fields MOD finish + -->
<tr>
<td class="explaintitle" align="right" nowrap="nowrap">{L_ALBUM}:</td>
<td class="genmed">{GALLERY_IMG}&nbsp;
<!-- BEGIN enable_view_toggle -->
<a href="{U_TOGGLE_VIEW_ALL}"><img src="{TOGGLE_VIEW_ALL_IMG}" alt="{L_TOGGLE_VIEW_ALL}" title="{L_TOGGLE_VIEW_ALL}"></a>&nbsp;
<!-- END enable_view_toggle -->
<a href="{U_ALL_IMAGES_BY_USER}">{L_ALL_IMAGES_BY_USER}</a>
</td>
</tr>
</table>
</td>
</tr>
<tr>
<td class="cat" colspan="2">&nbsp;</td>
</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="tbl"><tr><td class="tbll"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblbot"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblr"><img src="images/spacer.gif" alt="" width="8" height="4" /></td></tr></table>
<table width="100%" cellspacing="2" cellpadding="2" border="0">
	<tr>
		<td class="nav"><a href="{U_INDEX}">{L_INDEX}</a> &raquo; {L_VIEWING_PROFILE}</td>
	</tr>
</table>

<table width="100%" cellspacing="2" cellpadding="2" border="0">
<tr>
	<td><br />{JUMPBOX}</td>
	</tr>
</table>
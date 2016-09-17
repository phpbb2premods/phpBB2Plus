<table width="100%" cellspacing="2" cellpadding="2" border="0">
<tr>
	<td colspan="2" class="maintitle">{L_INDEX}</td>
	</tr>
<tr>
<td valign="bottom" class="gensmall">
<!-- BEGIN switch_user_logged_in -->
{LAST_VISIT_DATE}<br />
<!-- END switch_user_logged_in -->
{CURRENT_TIME}<br />
<a href="{U_INDEX}" class="nav">{L_INDEX}</a>{NAV_CAT_DESC}</td>
<td align="right" valign="bottom" class="gensmall">
<a href="{U_SEARCH_UNANSWERED}">{L_SEARCH_UNANSWERED}</a><br />
<!-- BEGIN switch_user_logged_in -->
<a href="{U_SEARCH_NEW}">{L_SEARCH_NEW}</a><br />
<a href="{U_MARK_READ}"><strong>{L_MARK_FORUMS_READ}</strong></a>
<!-- END switch_user_logged_in -->
</td>
</tr>
</table>
{BOARD_ANNOUNCES}
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr> 
<td valign="top">
{BOARD_INDEX}
<!-- BEGIN switch_show_links -->
<table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
<tr> 
<td class="cat" width="100%" height="22"><span class="cattitle"><a href="{U_LINKS}" class="cattitle">{L_LINKS}</a></span></td>
<td class="cat" nowrap="nowrap" align="center"><span class="cattitle">{SITENAME}</span></td>
</tr>
<tr> 
<td class="row1" nowrap="nowrap"><iframe marginwidth="0" marginheight="0" src="{U_LINKS_JS}" frameborder="0" scrolling="no" width="100%" height="{SITE_LOGO_HEIGHT}"></iframe></td>
<td class="row2" nowrap="nowrap"><img src="{U_SITE_LOGO}" alt="{SITENAME}" width="{SITE_LOGO_WIDTH}" height="{SITE_LOGO_HEIGHT}" border="0" /></td>
</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="tbl"><tr><td class="tbll"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblbot"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblr"><img src="images/spacer.gif" alt="" width="8" height="4" /></td></tr></table>
<br />
<!-- END switch_show_links -->
<table width="100%" cellspacing="2" cellpadding="2" border="0">
<tr>
<td class="nav"><a href="{U_INDEX}">{L_INDEX}</a></td>
</tr>
</table>
<br />
</td>
<td width="10"><img src="images/spacer.gif" alt="" width="10" height="30" /></td>
<td width="175" valign="top"> 
<!-- BEGIN switch_user_logged_out -->
<form method="post" action="{S_LOGIN_ACTION}">
<table width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline">
<tr> 
<th>{L_LOGIN}</th>
</tr>
<tr> 
<td align="center" class="row1"><span class="gensmall"> 
<input type="hidden" name="redirect" value="{U_PORTAL}" />
{L_USERNAME}:<br />
<input class="post" type="text" name="username" size="15" />
<br />
{L_PASSWORD}:<br />
<input class="post" type="password" name="password" size="15" />
<br />
</span> 
<!-- BEGIN switch_allow_autologin -->
<table border="0" cellspacing="0" cellpadding="0">
<tr> 
<td><input class="text" type="checkbox" name="autologin" /></td>
<td class="gensmall">&nbsp;{L_REMEMBER_ME}</td>
</tr>
</table>
<!-- END switch_allow_autologin -->
<br/> <input type="submit" class="mainoption" name="login" value="{L_LOGIN}" /> 
<br /> <br /> <a href="{U_SEND_PASSWORD}" class="gensmall">{L_SEND_PASSWORD}</a></td>
</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="tbl"><tr><td class="tbll"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblbot"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblr"><img src="images/spacer.gif" alt="" width="8" height="4" /></td></tr></table>
<br />
</form>
<!-- END switch_user_logged_out -->
<table width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline">
<tr>
<th>{L_LIVE_STATS}</th>
</tr>
<tr>
<td align="left" class="row1"><img src="templates/fisubsilversh/images/plus_images/icon_profile.gif" alt="" width="19" height="15" />&nbsp;<strong><span class="gensmall">{L_MEMBERS}:</span></strong><br />
<!-- BEGIN disable_viewonline -->
<img src="templates/fisubsilversh/images/plus_images/ur-moderator.gif" alt="" width="19" height="18" />&nbsp;<span class="gensmall">{L_LATEST}:&nbsp;{NEWEST_USER}<br /><img src="templates/fisubsilversh/images/plus_images/ur-author.gif" alt="" width="19" height="18" />&nbsp;{L_NEW_TODAY}:&nbsp;<strong>{TODAY_USERS}</strong><br />
<img src="templates/fisubsilversh/images/plus_images/ur-admin.gif" alt="" width="19" height="18" />&nbsp;{L_NEW_YESTERDAY}:&nbsp;<strong>{YESTERDAY_USERS}</strong><br /><img src="templates/fisubsilversh/images/plus_images/ur-guest.gif" alt="" width="19" height="18" />&nbsp;{L_MEMBERS_OVERALL}:&nbsp;<strong>{TOTAL_USERS}</strong></span><br /></td>
</tr>
<tr>
<td align="left" class="row1"><img src="templates/fisubsilversh/images/plus_images/group-1.gif" alt="" width="19" height="18" />&nbsp;<strong><span class="gensmall"><a href="{U_VIEWONLINE}">{L_ONLINE_NOW}</a>:</span></strong><br />
<img src="templates/fisubsilversh/images/plus_images/ur-anony.gif" alt="" width="19" height="18" />&nbsp;<span class="gensmall">{L_GUESTS}:&nbsp;<strong>{GUESTS_ONLINE}</strong><br /><img src="templates/fisubsilversh/images/plus_images/ur-member.gif" alt="" width="19" height="18" />&nbsp;{L_MEMBERS}:&nbsp;<strong>{REGGED_ONLINE}</strong></span></td>
</tr>
<!-- END disable_viewonline -->
<tr>
<td align="left" class="row1"><img src="templates/fisubsilversh/images/plus_images/icon_hits.gif" alt="" width="15" height="15" />&nbsp;<strong><span class="gensmall">&nbsp;{L_STATS}:</span></strong><br />
<span class="gensmall">{L_USER_RECORD}:&nbsp;<strong>{RECORD_USERS_P}</strong><br />{L_TOTAL_POSTS}:&nbsp;<strong>{TOTAL_POSTS}</strong><br />{GOOGLE_VISIT_COUNTER}</span>
<!-- BEGIN disable_viewonline -->
</td>
</tr>
<tr>
<td align="left" class="row1"><img src="templates/fisubsilversh/images/plus_images/icon_regged.gif" alt="" width="17" height="18" />&nbsp;<strong><span class="gensmall">&nbsp;{L_ONLINE_MEMBERS}:</span></strong><br />
<span class="gensmall">{ONLINE_USERLIST_P}</span></td>
</tr>
<tr>
<td align="center" class="row1"><span class="gensmall">{COLOR_GROUPS_LIST}</span>
</td>
<!-- END disable_viewonline -->
</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="tbl"><tr><td class="tbll"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblbot"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblr"><img src="images/spacer.gif" alt="" width="8" height="4" /></td></tr></table>
<br />
<!-- BEGIN switch_show_shoutbox -->
<table width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline">
<tr>
<th><a class="link2" href="{U_SHOUTBOX_MAX}">{L_SHOUTBOX}</a></th>
</tr>
<tr>
<td class="row1"><span class="genmed"><iframe src="{U_SHOUTBOX}" scrolling="NO" width="100%" height="270" frameborder="0" marginheight="0" marginwidth="0" allowtransparency="true"></iframe></span></td>
</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="tbl"><tr><td class="tbll"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblbot"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblr"><img src="images/spacer.gif" alt="" width="8" height="4" /></td></tr></table>
<br />
<!-- END switch_show_shoutbox --> 
<!-- BEGIN switch_show_birthday -->
<table width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline">
<tr>
<th>{L_BIRTHDAYS}</th>
</tr>
<tr>
<td class="row1" align="center"><img src="templates/fisubsilversh/images/plus_images/happy_birthday.gif" alt="" width="46" height="30" /></td>
</tr>
<tr>
<td class="row1"><span class="gensmall">{L_WHOSBIRTHDAY_TODAY}<br /><br />{L_WHOSBIRTHDAY_WEEK}</span></td>
</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="tbl"><tr><td class="tbll"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblbot"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblr"><img src="images/spacer.gif" alt="" width="8" height="4" /></td></tr></table>
<br />
<!-- END switch_show_birthday -->
<!-- BEGIN switch_show_lastvisit -->
<table width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline">
<tr>
<th>{L_LAST_VISIT}</th>
</tr>
<tr>
<td class="row1"><span class="gensmall">{L_USERS_TODAY}&nbsp;{L_USERS_LASTHOUR}<br />{USERS_TODAY_LIST}</span></td>
</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="tbl"><tr><td class="tbll"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblbot"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblr"><img src="images/spacer.gif" alt="" width="8" height="4" /></td></tr></table>
<br />
<!-- END switch_show_lastvisit -->
</td>
<table border="0" align="center" cellpadding="0" cellspacing="3">
<tr>
<td><img src="{FORUM_NEW_IMG}" alt="{L_NEW_POSTS}" title="{L_NEW_POSTS}" /></td>
<td class="gensmall">{L_NEW_POSTS}</td>
<td>&nbsp;</td>
<td><img src="{FORUM_IMG}" alt="{L_NO_NEW_POSTS}" title="{L_NO_NEW_POSTS}" /></td>
<td class="gensmall">{L_NO_NEW_POSTS}</td>
<td>&nbsp;</td>
<td><img src="{FORUM_LOCKED_IMG}" alt="{L_FORUM_LOCKED}" title="{L_FORUM_LOCKED}" /></td>
<td class="gensmall">{L_FORUM_LOCKED}</td>
</tr>
</table>

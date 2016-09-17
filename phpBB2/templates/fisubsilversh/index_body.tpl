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
<!-- BEGIN disable_viewonline -->
<table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
<tr>
<td class="cat" colspan="2"><a href="{U_VIEWONLINE}">{L_WHO_IS_ONLINE}</a></td>
</tr>
<tr>
<td class="row1" rowspan="5"><img src="templates/fisubsilversh/images/whosonline.gif" alt="{L_WHO_IS_ONLINE}" width="25" height="25" class="imgfolder" title="{L_WHO_IS_ONLINE}" />
</td>
<td class="row1" width="100%"><span class="gensmall">{TOTAL_POSTS}<br />
{TOTAL_USERS}<br />
{NEWEST_USER}</span></td>
</tr>
<tr>
<td class="row1"><span class="gensmall">{TOTAL_USERS_ONLINE} &nbsp;{COLOR_GROUPS_LIST}<br />
{RECORD_USERS}<br />
{LOGGED_IN_USER_LIST}</span></td>
</tr>
<!-- END disable_viewonline -->
<!-- BEGIN switch_show_birthday -->
<tr>
<td class="row1" align="left"><span class="gensmall">{L_WHOSBIRTHDAY_TODAY}<br />{L_WHOSBIRTHDAY_WEEK}</span></td>
</tr>
<!-- END switch_show_birthday -->
<!-- BEGIN switch_show_lastvisit -->
<tr>
<td class="row1" align="left"><span class="gensmall">{L_USERS_TODAY}&nbsp;{L_USERS_LASTHOUR}<br />{USERS_TODAY_LIST}</br></span></td>   
</tr>
<!-- END switch_show_lastvisit -->
<!-- BEGIN disable_viewonline -->
<tr>
<td height="20" class="row1"><span class="gensmall">{GOOGLE_VISIT_COUNTER}<br />{L_ONLINE_EXPLAIN}</span></td>
</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="tbl"><tr><td class="tbll"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblbot"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblr"><img src="images/spacer.gif" alt="" width="8" height="4" /></td></tr></table>
<!-- END disable_viewonline --> 
<!-- BEGIN switch_user_logged_out -->
<br />
<form method="post" action="{S_LOGIN_ACTION}">
<table width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline">
<tr>
<td class="cat">{L_LOGIN_LOGOUT}</td>
</tr>
<tr>
<td class="row1" align="center">
<table border="0" cellspacing="0" cellpadding="2">
<tr> 
<td class="gensmall">{L_USERNAME}:&nbsp;</td>
<td><input class="post" type="text" name="username" size="10" /></td>
<td class="gensmall">&nbsp;&nbsp;&nbsp;{L_PASSWORD}:</td>
<td><input class="post" type="password" name="password" size="10" maxlength="32" /></td>
<!-- BEGIN switch_allow_autologin -->
<td class="gensmall">&nbsp;&nbsp;&nbsp;{L_AUTO_LOGIN}</td>
<td><input class="text" type="checkbox" name="autologin" /></td>
<!-- END switch_allow_autologin -->
<td>&nbsp;&nbsp;<input type="submit" class="mainoption" name="login" value="{L_LOGIN}" /></td>
</tr>
</table></td>
</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="tbl"><tr><td class="tbll"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblbot"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblr"><img src="images/spacer.gif" alt="" width="8" height="4" /></td></tr></table>
</form>
<!-- END switch_user_logged_out -->
<table width="100%" cellspacing="2" cellpadding="2" border="0">
<tr>
<td class="nav"><a href="{U_INDEX}">{L_INDEX}</a></td>
</tr>
</table>
<br />
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
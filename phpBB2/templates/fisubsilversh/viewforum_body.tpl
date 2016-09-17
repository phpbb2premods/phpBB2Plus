<form method="post" action="search.php?mode=results">
  <input type="hidden" name="search_where" value="f{FORUM_ID}">
  <input type="hidden" name="show_results" value="topics">
  <input type="hidden" name="search_terms" value="any">
  <input type="hidden" name="search_fields" value="all">
<table width="100%" border="0" cellspacing="2" cellpadding="2">
<tr>
<td class="maintitle">{BANNER_13_IMG}<br/><a href="{U_VIEW_FORUM}">{FORUM_NAME}</a></td>
<td class="gensmall" align="right" valign="bottom">{L_MODERATOR}: {MODERATORS}<br />
{TOTAL_USERS_ONLINE}<br/>{LOGGED_IN_USER_LIST}<br />
<strong><a href="{U_MARK_READ}">{L_MARK_TOPICS_READ}</a></strong></td>
</tr>
</table>
{BOARD_ANNOUNCES}
<table width="100%" cellspacing="2" cellpadding="2" border="0">
<tr> 
<td><br /><a href="{U_POST_NEW_TOPIC}"><img src="{POST_IMG}" alt="{L_POST_NEW_TOPIC}" title="{L_POST_NEW_TOPIC}" /></a></td>
<td align="left" valign="middle" class="nav" width="100%"><br /><span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a>{NAV_CAT_DESC}</span></td>
<td nowrap="nowrap" class="nav" align="right">{PAGINATION}<br /><br /><span class="gensmall">{L_SEARCH_FOR}: </span><input class="liteoption" type="text" name="search_keywords" value="" size="20" maxlength="150" />&nbsp;<input type="submit" name="submit" value="{L_GO}" alt="{L_SUBMIT_SEARCH}" class="liteoption" /></td>
</tr>
</table>
</form>
<script type="text/javascript" src="includes/javascript/ajax_topicfunctions.js"></script>
<form method="post" action="{S_POST_DAYS_ACTION}">
{BOARD_INDEX}
{TOPICS_LIST_BOX}
</form>
<table border="0" cellpadding="0" cellspacing="0" class="tbl"><tr><td class="tbll"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblbot"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblr"><img src="images/spacer.gif" alt="" width="8" height="4" /></td></tr></table>
<table width="100%" cellspacing="2" cellpadding="2" border="0">
<tr>
<td><a href="{U_POST_NEW_TOPIC}"><img src="{POST_IMG}" alt="{L_POST_NEW_TOPIC}" title="{L_POST_NEW_TOPIC}" /></a></td>
<td align="left" valign="middle" class="nav" width="100%"><span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a>{NAV_CAT_DESC}</span></td>
<td nowrap="nowrap" class="nav">{PAGINATION}</td>
</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="2">
<tr>
<td><br />{JUMPBOX}</td>
<td class="gensmall" align="right" valign="top"><strong><a href="{U_MARK_READ}">{L_MARK_TOPICS_READ}</a></strong><br />
{L_MODERATOR}: {MODERATORS}<br />
{TOTAL_USERS_ONLINE}<br/>{LOGGED_IN_USER_LIST}
</td>
</tr>
</table>
<br />
<table width="100%" cellspacing="0" border="0" align="center" cellpadding="0">
<tr>
<td valign="top">
<table border="0" cellspacing="1" cellpadding="0">
<tr>
<td><img src="{FOLDER_NEW_IMG}" alt="{L_NEW_POSTS}" title="{L_NEW_POSTS}" /></td>
<td class="gensmall">{L_NEW_POSTS}</td>
<td>&nbsp;&nbsp;</td>
<td><img src="{FOLDER_IMG}" alt="{L_NO_NEW_POSTS}" title="{L_NO_NEW_POSTS}" /></td>
<td class="gensmall">{L_NO_NEW_POSTS}</td>
<td>&nbsp;&nbsp;</td>
<td><img src="{FOLDER_ANNOUNCE_IMG}" alt="{L_ANNOUNCEMENT}" title="{L_ANNOUNCEMENT}" /></td>
<td class="gensmall">{L_ANNOUNCEMENT}</td>
</tr>
<tr>
<td><img src="{FOLDER_HOT_NEW_IMG}" alt="{L_NEW_POSTS_HOT}" title="{L_NEW_POSTS_HOT}" /></td>
<td class="gensmall">{L_NEW_POSTS_HOT}</td>
<td>&nbsp;</td>
<td><img src="{FOLDER_HOT_IMG}" alt="{L_NO_NEW_POSTS_HOT}" vspace="4" title="{L_NO_NEW_POSTS_HOT}" /></td>
<td class="gensmall">{L_NO_NEW_POSTS_HOT}</td>
<td>&nbsp;</td>
<td><img src="{FOLDER_STICKY_IMG}" alt="{L_STICKY}" title="{L_STICKY}" /></td>
<td class="gensmall">{L_STICKY}</td>
</tr>
<tr>
<td><img src="{FOLDER_LOCKED_NEW_IMG}" alt="{L_NEW_POSTS_LOCKED}" title="{L_NEW_POSTS_LOCKED}" /></td>
<td class="gensmall">{L_NEW_POSTS_LOCKED}</td>
<td>&nbsp;</td>
<td><img src="{FOLDER_LOCKED_IMG}" alt="{L_NO_NEW_POSTS_LOCKED}" title="{L_NO_NEW_POSTS_LOCKED}" /></td>
<td class="gensmall">{L_NO_NEW_POSTS_LOCKED}</td>
<td>&nbsp;</td>
<td><img src="{FOLDER_MOVED_IMG}" alt="{L_MOVED}" title="{L_MOVED}" /></td>
<td class="gensmall">{L_MOVED}</td>
</tr>
</table>
</td>
<td align="right" valign="top"><span class="gensmall">{S_AUTH_LIST}</span></td>
</tr>
</table>

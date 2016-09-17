<script type="text/javascript" src="includes/javascript/ajax_topicfunctions.js"></script>
<script type="text/javascript">
<!--
is_viewtopic = 1;
highlight = '{HIGHLIGHT}';
//-->
</script>

<table width="100%" border="0" cellspacing="0" cellpadding="2">
<tr>
<td height="34" valign="top" class="nav">{BANNER_14_IMG}<br/><a href="{U_VIEW_TOPIC}" id="topiclink_top" class="maintitle">{TOPIC_TITLE}</a><br />
{PAGINATION}</span>
<!-- Start add - Topic in Who is online MOD -->
<span class="gensmall"><br/>{TOTAL_USERS_ONLINE}<br/>{LOGGED_IN_USER_LIST}</b></span></td>
<!-- End add - Topic in Who is online MOD -->
</td>
<td class="gensmall" align="right" valign="bottom"><a href="{U_VIEW_NEWER_TOPIC}">{L_VIEW_NEXT_TOPIC}</a><br />
<a href="{U_VIEW_OLDER_TOPIC}">{L_VIEW_PREVIOUS_TOPIC}</a><br />
<strong>{S_WATCH_TOPIC}</strong><br />
<!-- BEGIN bookmark_state -->
<a href="{U_BOOKMARK_ACTION}">{L_BOOKMARK_ACTION}</a>
<!-- END bookmark_state -->
</td>
</tr>
</table>

<table width="100%" cellspacing="2" cellpadding="2" border="0">
<tr>
<td nowrap="nowrap"><a href="{U_POST_NEW_TOPIC}"><img src="{POST_IMG}" alt="{L_POST_NEW_TOPIC}" title="{L_POST_NEW_TOPIC}" /></a><a href="{U_POST_REPLY_TOPIC}"><img src="{REPLY_IMG}" id="replyimg_top" alt="{L_POST_REPLY_TOPIC}" hspace="8" title="{L_POST_REPLY_TOPIC}" /></a></td>
<td align="left" valign="middle" class="nav" width="100%"><span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a>{NAV_CAT_DESC}</span></td>
<td nowrap="nowrap"><a href="{U_VIEW_OLDER_TOPIC}"><img src="templates/fisubsilversh/images/lang_english/topic_previous.gif" alt="{L_VIEW_PREVIOUS_TOPIC}" title="{L_VIEW_PREVIOUS_TOPIC}" width="15" height="25" border="0" /></a><a href="tellafriend.php?topic={TOPIC_TITLE}&link={TELL_LINK}"><img src="templates/fisubsilversh/images/lang_english/topic_email.gif" alt="{L_TELL_FRIEND}" width="24" height="25" border="0" title="{L_TELL_FRIEND}" /></a><a href="{U_WATCH_TOPIC}"><img src="templates/fisubsilversh/images/topic_watch.gif" width="24" height="25" border="0" alt="{L_TOPIC_VIEW_USERS}" title="{L_TOPIC_VIEW_USERS}" /></a><a href="{U_POST_EXPORT_TOPIC}"><img src="templates/fisubsilversh/images/save_topic.gif" width="24" height="25" border="0" alt="{L_SAVE_TOPIC}" title="{L_SAVE_TOPIC}" /></a><a href="{U_PRINT}" target="_blank"><img src="templates/fisubsilversh/images/lang_english/topic_print.gif" width="24" height="25" border="0" alt="{L_PRINT}" title="{L_PRINT}" /></a>{S_WATCH_TOPIC_IMG}<a href="{U_PRIVATEMSGS}"><img src="{PRIVMSG_IMG}" border="0" alt="{PRIVATE_MESSAGE_INFO}" title="{PRIVATE_MESSAGE_INFO}" /></a><a href="{U_VIEW_NEWER_TOPIC}"><img src="templates/fisubsilversh/images/lang_english/topic_next.gif" alt="{L_VIEW_NEXT_TOPIC}" title="{L_VIEW_NEXT_TOPIC}" width="14" height="25" border="0" /></a></td>
</tr>
</table>

{POLL_DISPLAY}

<table class="forumline" width="100%" cellspacing="1" cellpadding="3" border="0">
<tr>
<th width="150" height="28">{L_AUTHOR}</th>
<th width="100%">{L_MESSAGE}</th>
</tr>
<!-- BEGIN postrow -->
<tr>
<td valign="top" class="{postrow.ROW_CLASS}"> 
<span class="name"><a name="{postrow.U_POST_ID}" id="{postrow.U_POST_ID}"></a><strong>{postrow.POSTER_NAME}</strong>{postrow.CARD_IMG}<br /></span>
<span class="postdetails">{postrow.POSTER_RANK}<br /> 
{postrow.RANK_IMAGE}{postrow.POSTER_AVATAR}<br /><br /> 
{postrow.POSTER_AGE}<br />
{postrow.POSTER_JOINED}<br /> 
{postrow.POSTER_POSTS}<br /> 
{postrow.POSTER_FROM}<br /> 
<!-- BEGIN author_profile -->{postrow.author_profile.AUTHOR_VAL}<br /><!-- END author_profile -->
</span>
{postrow.POSTER_FROM_FLAG}
<img src="images/spacer.gif" alt="" width="150" height="1" /> 
</td> 
<td class="{postrow.ROW_CLASS}" width="100%" height="28" valign="top"> 
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0"> 
<tr> 
<!-- Start add - Yellow card admin MOD -->
<form method="post" action="{postrow.S_CARD}">
<!-- End add - Yellow card admin MOD -->
<td class="postdetails"><a href="{postrow.U_MINI_POST}"><img src="{postrow.MINI_POST_IMG}" alt="{postrow.L_MINI_POST_ALT}" title="{postrow.L_MINI_POST_ALT}" /></a>{L_POSTED}: {postrow.POST_DATE}&nbsp; <span {postrow.S_AJAX_EDIT_TITLE}>{L_POST_SUBJECT}: 
{postrow.POST_SUBJECT_PRE}<span id="topiclink_{postrow.U_POST_ID}">{postrow.POST_SUBJECT}</span>{postrow.POST_SUBJECT_BACK}</span>
<!-- BEGIN can_edit -->
<span id="title_{postrow.U_POST_ID}" style="display:none;"><input type="text" class="post" name="topictitle_{postrow.U_POST_ID}" id="topictitle_{postrow.U_POST_ID}" value="{postrow.POST_RAW_SUBJECT}" size="40" maxlength="60" onkeyup="AJAXTitleEditKeyUp(event, {postrow.U_POST_ID})" /><input type="hidden" id="orig_topictitle_{postrow.U_POST_ID}" value="{postrow.POST_RAW_SUBJECT}" />&nbsp;<input type="button" onclick="AJAXEndTitleEdit({postrow.U_POST_ID})" value="{L_SAVE_CHANGES}" class="mainoption" />&nbsp;<input type="button" onclick="AJAXCancelTitleEdit({postrow.U_POST_ID})" value="{L_CANCEL}" class="liteoption" /></span>
<!-- END can_edit -->
</td>
<td align="right" valign="top" nowrap="nowrap">{postrow.QUOTE_IMG}{postrow.EDIT_IMG}{PAGE_BOTTOM_IMG}{PAGE_TOP_IMG}{postrow.DELETE_IMG}{postrow.IP_IMG}{postrow.U_R_CARD}{postrow.U_Y_CARD}{postrow.U_G_CARD}{postrow.U_B_CARD}{postrow.CARD_EXTRA_SPACE}{postrow.CARD_HIDDEN_FIELDS}</td> 
<!-- Start add - Yellow card admin MOD -->
</form>
<!-- End add - Yellow card admin MOD -->
</tr> 
<tr>
<td colspan="2" width="100%" valign="top">
<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr>
<td><hr /></td>
</tr>
<tr>
<td valign="top" class="postbody"><span id="postmessage_{postrow.U_POST_ID}">{postrow.MESSAGE}</span>
<!-- BEGIN can_edit -->
<div class="gen" id="post_{postrow.U_POST_ID}" style="display:none; text-align:right;">
<textarea id="posttext_{postrow.U_POST_ID}" rows="15" cols="35" wrap="virtual" class="post" style="width:100%;" onkeyup="AJAXPostEditkeyUp(event, {postrow.U_POST_ID})">{postrow.RAW_MESSAGE}</textarea><textarea id="orig_posttext_{postrow.U_POST_ID}" rows="1" cols="1" style="display:none;">{postrow.RAW_MESSAGE}</textarea><br />
<input type="button" value=" + " onclick="AJAXEnlargePostArea({postrow.U_POST_ID});return false;" class="liteoption" />&nbsp;<input type="button" value=" - " onclick="AJAXShortenPostArea({postrow.U_POST_ID});return false;" class="liteoption" />&nbsp;&nbsp;&nbsp;<input type="button" onclick="AJAXEndPostEdit({postrow.U_POST_ID}, -1);return false;" value="{L_SAVE_CHANGES}" class="liteoption" />&nbsp;<input type="button" onclick="AJAXCancelPostEdit({postrow.U_POST_ID});return false;" value="{L_CANCEL}" class="liteoption" />&nbsp;<a href="{postrow.U_EDIT_POST}" class="gen">{L_FULL_EDIT}</a>
</div>
<!-- END can_edit -->
</td>
</tr>
<tr>
<td valign="bottom" class="genmed">{postrow.ATTACHMENTS}<td>
</tr>
</table>

</td>
</tr>
<tr>
<td colspan="2" height="100%" valign="bottom">
<!-- BEGIN above_sig --><span class="postdetails"><br />{postrow.above_sig.ABOVE_VAL}</span><!-- END above_sig -->
<span class="postbody"><br />{postrow.SIGNATURE}</span>
<!-- BEGIN below_sig --><span class="postdetails"><br />{postrow.below_sig.BELOW_VAL}</span><!-- END below_sig -->
<br /><span id="editmessage_{postrow.U_POST_ID}" class="postdetails">{postrow.EDITED_MESSAGE}</span>
</td>
</tr>
</table>

</td>
</tr>
<tr>
<td class="{postrow.ROW_CLASS}" align="center">{postrow.ZODIAC_IMG}&nbsp;{postrow.POSTER_GENDER}&nbsp;{postrow.CHINESE_IMG}</td>
<td valign="bottom" nowrap="nowrap" class="{postrow.ROW_CLASS}">{postrow.POSTER_ONLINE}{postrow.GALLERY_IMG}{postrow.PROFILE_IMG}{postrow.PM_IMG}{postrow.EMAIL_IMG}{postrow.WWW_IMG}{postrow.AIM_IMG}{postrow.YIM_IMG}{postrow.MSN_IMG}{postrow.ICQ_IMG}</td>
</tr>
<tr>
<td class="spacerow" colspan="2" height="1"><img src="images/spacer.gif" alt="" width="1" height="1" /></td>
</tr>
<!-- END postrow -->
<!-- BEGIN bookmark_state -->
<tr align="right">
<td class="row2" colspan="2" height="20"><span class="genmed"><a href="{U_BOOKMARK_ACTION}" class="genmed">{L_BOOKMARK_ACTION}</a></span></td>
</tr>
<!-- END bookmark_state -->
<!-- BEGIN switch_show_quickreply -->
<tr align="center">
		<td class="row1" colspan="2" >
		{QUICKREPLY_OUTPUT}
		</td>
	</tr>
<!-- END switch_show_quickreply -->
<tr>
<td colspan="2" align="center" class="cat">

<form method="post" action="{S_POST_DAYS_ACTION}">
<table cellspacing="0" cellpadding="0" border="0">
<tr>
<td class="gensmall">{L_DISPLAY_POSTS}:&nbsp;&nbsp;</td>
<td>{S_SELECT_POST_DAYS}&nbsp;</td>
<td>{S_SELECT_POST_ORDER}&nbsp;</td>
<td><input type="submit" value="{L_GO}" class="catbutton" name="submit" /></td>
</tr>
</table>
</form>

</td>
</tr>
</table>

<table border="0" cellpadding="0" cellspacing="0" class="tbl"><tr><td class="tbll"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblbot"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblr"><img src="images/spacer.gif" alt="" width="8" height="4" /></td></tr></table>
<table width="100%" cellspacing="2" cellpadding="2" border="0">
<tr>
<td nowrap="nowrap"><a href="{U_POST_NEW_TOPIC}"><img src="{POST_IMG}" alt="{L_POST_NEW_TOPIC}" title="{L_POST_NEW_TOPIC}" /></a><a href="{U_POST_REPLY_TOPIC}"><img src="{REPLY_IMG}" id="replyimg_bottom" alt="{L_POST_REPLY_TOPIC}" hspace="8" title="{L_POST_REPLY_TOPIC}" /></a></td>
<td align="left" valign="middle" class="nav" width="100%"><span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a>{NAV_CAT_DESC}</span></td>
<td nowrap="nowrap"><a href="{U_VIEW_OLDER_TOPIC}"><img src="templates/fisubsilversh/images/lang_english/topic_previous.gif" alt="{L_VIEW_PREVIOUS_TOPIC}" title="{L_VIEW_PREVIOUS_TOPIC}" width="15" height="25" border="0" /></a><a href="tellafriend.php?topic={TOPIC_TITLE}&link={TELL_LINK}"><img src="templates/fisubsilversh/images/lang_english/topic_email.gif" alt="{L_TELL_FRIEND}" width="24" height="25" border="0" title="{L_TELL_FRIEND}" /></a><a href="{U_WATCH_TOPIC}"><img src="templates/fisubsilversh/images/topic_watch.gif" width="24" height="25" border="0" alt="{L_TOPIC_VIEW_USERS}" title="{L_TOPIC_VIEW_USERS}" /></a><a href="{U_POST_EXPORT_TOPIC}"><img src="templates/fisubsilversh/images/save_topic.gif" width="24" height="25" border="0" alt="{L_SAVE_TOPIC}" title="{L_SAVE_TOPIC}" /></a><a href="{U_PRINT}" target="_blank"><img src="templates/fisubsilversh/images/lang_english/topic_print.gif" width="24" height="25" border="0" alt="{L_PRINT}" title="{L_PRINT}" /></a>{S_WATCH_TOPIC_IMG}<a href="{U_PRIVATEMSGS}"><img src="{PRIVMSG_IMG}" border="0" alt="{PRIVATE_MESSAGE_INFO}" title="{PRIVATE_MESSAGE_INFO}" /></a><a href="{U_VIEW_NEWER_TOPIC}"><img src="templates/fisubsilversh/images/lang_english/topic_next.gif" alt="{L_VIEW_NEXT_TOPIC}" title="{L_VIEW_NEXT_TOPIC}" width="14" height="25" border="0" /></a></td>
</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="2">
<tr>
<td height="34" align="left" valign="top" class="nav">{PAGINATION}<br />
<br />
{JUMPBOX}<br />
<br />
{S_TOPIC_ADMIN}<br /><br />{BANNER_15_IMG}</td>
<td class="gensmall" align="right" valign="top"><strong>{S_WATCH_TOPIC}</strong><br />
<a href="{U_VIEW_NEWER_TOPIC}">{L_VIEW_NEXT_TOPIC}</a><br />
<a href="{U_VIEW_OLDER_TOPIC}">{L_VIEW_PREVIOUS_TOPIC}</a><br />
{S_AUTH_LIST}</td>
</tr>
</table>
<script type="text/javascript" src="includes/javascript/ajax_topicfunctions.js"></script>

<table width="100%" cellspacing="2" cellpadding="2" border="0">
	<tr>
		<td colspan="2" class="maintitle">{L_SEARCH_MATCHES}</td>
	</tr>
	<tr>
		<td width="100%" class="nav"><a href="{U_INDEX}">{L_INDEX}</a> &raquo; <a href="{U_SEARCH}">{L_SEARCH}</a> &raquo; {L_SEARCH_MATCHES}</td>
		<td nowrap="nowrap" class="nav">{PAGINATION}</td>
	</tr>
</table>
<table width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline">
<tr>
<th colspan="2">{L_FORUM}</th>
<th>{L_TOPICS}</th>
<th>{L_AUTHOR}</th>
<th>{L_REPLIES}</th>
<th>{L_VIEWS}</th>
<th>{L_LASTPOST}</th>
</tr>
<!-- BEGIN searchresults -->
<tr>
<td width="4%" class="row1">{searchresults.S_MARK_LINK_START}<img src="{searchresults.TOPIC_FOLDER_IMG}" id="topicimage_{searchresults.TOPIC_ID}" alt="{searchresults.L_TOPIC_FOLDER_ALT}" title="{searchresults.L_TOPIC_FOLDER_ALT}" border="0" />{searchresults.S_MARK_LINK_END}</td>
<td class="row1"><strong><a href="{searchresults.U_VIEW_FORUM}">{searchresults.FORUM_NAME}</a></strong></td>
<td class="row2" {searchresults.S_AJAX_EDIT_TITLE}><span class="topictitle"><span id="topicnewest_{searchresults.TOPIC_ID}">{searchresults.NEWEST_POST_IMG}</span>{searchresults.TOPIC_TYPE}<a href="{searchresults.U_VIEW_TOPIC}" id="topiclink_{searchresults.TOPIC_FIRST_POST_ID}" >{searchresults.TOPIC_TITLE}</a>
<!-- BEGIN can_edit_title -->
<span id="title_{searchresults.TOPIC_FIRST_POST_ID}" style="display:none;"><input type="text" class="post" name="topictitle_{searchresults.TOPIC_FIRST_POST_ID}" id="topictitle_{searchresults.TOPIC_FIRST_POST_ID}" value="{searchresults.TOPIC_TITLE}" size="40" maxlength="60" onkeyup="AJAXTitleEditKeyUp(event, {searchresults.TOPIC_FIRST_POST_ID})" /><input type="hidden" id="orig_topictitle_{searchresults.TOPIC_FIRST_POST_ID}" value="{searchresults.TOPIC_TITLE}" />&nbsp;<input type="button" onclick="AJAXEndTitleEdit({searchresults.TOPIC_FIRST_POST_ID})" value="{L_SAVE_CHANGES}" class="mainoption" />&nbsp;<input type="button" onclick="AJAXCancelTitleEdit({searchresults.TOPIC_FIRST_POST_ID})" value="{L_CANCEL}" class="liteoption" /></span>
<!-- END can_edit_title -->
</span><br /><span class="gensmall">{searchresults.GOTO_PAGE}</span>
</td>
<td class="row1" align="center"><span class="genmed">&nbsp;{searchresults.TOPIC_AUTHOR}&nbsp;</span></td>
<td class="row2" align="center"><span class="gensmall">{searchresults.REPLIES}</span></td>
<td class="row1" align="center"><span class="gensmall">{searchresults.VIEWS}</span></td>
<td class="row2" align="center" nowrap="nowrap"><span class="gensmall">{searchresults.LAST_POST_TIME}<br />
{searchresults.LAST_POST_AUTHOR} {searchresults.LAST_POST_IMG}</span></td>
</tr>
<!-- END searchresults -->
<tr>
<td class="cat" colspan="7">&nbsp;</td>
</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="tbl"><tr><td class="tbll"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblbot"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblr"><img src="images/spacer.gif" alt="" width="8" height="4" /></td></tr></table>
<table width="100%" cellspacing="2" cellpadding="2" border="0">
	<tr>
		<td width="100%" class="nav"><a href="{U_INDEX}">{L_INDEX}</a> &raquo; <a href="{U_SEARCH}">{L_SEARCH}</a> &raquo; {L_SEARCH_MATCHES}</td>
		<td nowrap="nowrap" class="nav">{PAGINATION}</td>
	</tr>
	<tr>
		<td colspan="2"><br />
			{JUMPBOX}</td>
	</tr>
</table>

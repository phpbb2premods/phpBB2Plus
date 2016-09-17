<script type="text/javascript" src="includes/javascript/ajax_topicfunctions.js"></script>

<form name="modcpForm" id="modcpForm" method="post" action="{S_MODCP_ACTION}">
<table width="100%" cellspacing="2" cellpadding="2" border="0">
<tr>
	<td colspan="2" class="maintitle">{L_MOD_CP}</td>
</tr>
<tr>
<td class="nav"><a href="{U_INDEX}">{L_INDEX}</a> {NAV_CAT_DESC} &raquo; {L_MOD_CP}</td>
<td align="right" class="nav">{PAGINATION}</td>
</tr>
</table>
<table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline">
<tr>
<td class="cat" colspan="5" align="center">{L_MOD_CP}</td>
</tr>
<tr>
<td class="row1" colspan="5" align="center"><span class="genmed">{L_MOD_CP_EXPLAIN}</span></td>
</tr>
<tr>
<th colspan="2">{L_TOPICS}</th>
<th>{L_REPLIES}</th>
<th>{L_LASTPOST}</th>
<th>{L_SELECT}</th>
</tr>
<!-- BEGIN topicrow -->
<tr>
<td class="row1"><img src="{topicrow.TOPIC_FOLDER_IMG}" alt="{topicrow.L_TOPIC_FOLDER_ALT}" title="{topicrow.L_TOPIC_FOLDER_ALT}" /></td>
<td width="100%" class="row1" ondblclick="AJAXTitleEdit({topicrow.TOPIC_FIRST_POST_ID}, 0)">&nbsp;<span class="topictitle">{topicrow.TOPIC_ATTACHMENT_IMG}{topicrow.TOPIC_TYPE}<a href="{topicrow.U_VIEW_TOPIC}" id="topiclink_{topicrow.TOPIC_FIRST_POST_ID}">{topicrow.TOPIC_TITLE}</a><span id="title_{topicrow.TOPIC_FIRST_POST_ID}" style="display:none;"><input type="text" class="post" name="topictitle_{topicrow.TOPIC_FIRST_POST_ID}" id="topictitle_{topicrow.TOPIC_FIRST_POST_ID}" value="{topicrow.TOPIC_TITLE}" size="40" maxlength="60" /><input type="hidden" id="orig_topictitle_{topicrow.TOPIC_FIRST_POST_ID}" value="{topicrow.TOPIC_TITLE}" />&nbsp;<input type="button" onclick="AJAXEndTitleEdit({topicrow.TOPIC_FIRST_POST_ID})" value="{L_SAVE_CHANGES}" class="mainoption" />&nbsp;<input type="button" onclick="AJAXCancelTitleEdit({topicrow.TOPIC_FIRST_POST_ID})" value="{L_CANCEL}" class="liteoption" /></span></span></td>
<td class="row2" align="center"><span class="gensmall">{topicrow.REPLIES}</span></td>
<td align="center" nowrap="nowrap" class="row1"><span class="gensmall">{topicrow.LAST_POST_TIME}</span></td>
<td class="row2" align="center"><input type="checkbox" name="topic_id_list[]" value="{topicrow.TOPIC_ID}" /></td>
</tr>
<!-- END topicrow -->
<tr> 
<td colspan="5" align="right" class="cat"> {S_HIDDEN_FIELDS} 
<!-- BEGIN switch_auth_delete -->
<input type="submit" name="delete" class="catbutton" value="{L_DELETE}" />
&nbsp; 
<!-- END switch_auth_delete -->
<input type="submit" name="move" class="catbutton" value="{L_MOVE}" />
&nbsp; 
<input type="submit" name="lock" class="catbutton" value="{L_LOCK}" />
&nbsp; 
<input type="submit" name="unlock" class="catbutton" value="{L_UNLOCK}" />
&nbsp;
<!-- BEGIN switch_auth_sticky -->
<input type="submit" name="sticky" class="catbutton" value="{L_STICKY}" />
&nbsp; 
<!-- END switch_auth_sticky -->
<!-- BEGIN switch_auth_announce -->
<input type="submit" name="announce" class="catbutton" value="{L_ANNOUNCE}" />
&nbsp; 
<!-- END switch_auth_announce -->
<input type="submit" name="normalise" class="catbutton" value="{L_NORMALISE}" />
&nbsp;
</td>
</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="tbl"><tr><td class="tbll"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblbot"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblr"><img src="images/spacer.gif" alt="" width="8" height="4" /></td></tr></table>
</form>
<table width="100%" cellspacing="2" cellpadding="2" border="0">
	<tr>
		<td class="nav"><a href="{U_INDEX}">{L_INDEX}</a> {NAV_CAT_DESC} &raquo; {L_MOD_CP}</td>
		<td align="right" class="nav"><span class="gensmall"><a href="#" onclick="setCheckboxes('modcpForm', 'topic_id_list[]', true); return false;">{L_CHECK_ALL}</a>&nbsp;&nbsp;<a href="#" onclick="setCheckboxes('modcpForm', 'topic_id_list[]', false); return false;">{L_UNCHECK_ALL}</a></span><br/><br/>{PAGINATION}</td>
	</tr>
	<tr>
		<td colspan="2"><br />{JUMPBOX}</td>
		</tr>
</table>

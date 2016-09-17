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
<table border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
<tr>
<th width="150">{L_AUTHOR}</th>
<th width="100%">{L_MESSAGE}</th>
</tr>
<!-- BEGIN searchresults -->
<tr>
<td class="cat" colspan="2">{L_TOPIC}:&nbsp;<a href="{searchresults.U_TOPIC}" class="topictitle" id="topiclink_top_{searchresults.U_POST_ID}">{searchresults.TOPIC_TITLE}</a></td>
</tr>
<tr>
<td width="150" valign="top" class="row1" rowspan="2"><span class="name">{searchresults.POSTER_NAME}</span><br />
<br />
<span class="postdetails">{L_REPLIES}: <strong>{searchresults.TOPIC_REPLIES}</strong><br />
{L_VIEWS}: <strong>{searchresults.TOPIC_VIEWS}</strong></span><br />
<img src="images/spacer.gif" alt="" width="150" height="1" />
</td>
<td width="100%" valign="top" class="row1" {searchresults.S_AJAX_EDIT_TITLE}><span class="postdetails"><a href="{searchresults.U_POST}"><img src="{searchresults.MINI_POST_IMG}" alt="{searchresults.L_MINI_POST_ALT}" title="{searchresults.L_MINI_POST_ALT}" /></a>{L_FORUM}:&nbsp;<strong><a href="{searchresults.U_FORUM}" class="postdetails">{searchresults.FORUM_NAME}</a></strong>&nbsp; 
&nbsp;{L_POSTED}: {searchresults.POST_DATE}&nbsp; &nbsp;{L_SUBJECT}: <strong><a href="{searchresults.U_POST}" id="topiclink_{searchresults.U_POST_ID}">{searchresults.POST_SUBJECT}</a></strong>
<!-- BEGIN can_edit -->
<span id="title_{searchresults.U_POST_ID}" style="display:none;"><input type="text" class="post" name="topictitle_{searchresults.U_POST_ID}" id="topictitle_{searchresults.U_POST_ID}" value="{searchresults.POST_RAW_SUBJECT}" size="40" maxlength="60" onkeyup="AJAXTitleEditKeyUp(event, {searchresults.U_POST_ID})" /><input type="hidden" id="orig_topictitle_{searchresults.U_POST_ID}" value="{searchresults.POST_RAW_SUBJECT}" />&nbsp;<input type="button" onclick="AJAXEndTitleEdit({searchresults.U_POST_ID})" value="{L_SAVE_CHANGES}" class="mainoption" />&nbsp;<input type="button" onclick="AJAXCancelTitleEdit({searchresults.U_POST_ID})" value="{L_CANCEL}" class="liteoption" /></span>
<!-- END can_edit -->
</span></td>
</tr>
<tr>
<td valign="top" class="row1">
{searchresults.U_EDIT_IMG}<span id="postmessage_{searchresults.U_POST_ID}"><span class="postbody">{searchresults.MESSAGE}</span></span>
<!-- BEGIN can_edit -->
<div class="gen" id="post_{searchresults.U_POST_ID}" style="display:none; text-align:right;">
<textarea id="posttext_{searchresults.U_POST_ID}" rows="15" cols="35" wrap="virtual" class="post" style="width:100%;" onkeyup="AJAXPostEditkeyUp(event, {searchresults.U_POST_ID})">{searchresults.RAW_MESSAGE}</textarea><textarea id="orig_posttext_{searchresults.U_POST_ID}" rows="1" cols="1" style="display:none;">{searchresults.RAW_MESSAGE}</textarea><br />
<input type="button" value=" + " onclick="AJAXEnlargePostArea({searchresults.U_POST_ID});return false;" class="liteoption" />&nbsp;<input type="button" value=" - " onclick="AJAXShortenPostArea({searchresults.U_POST_ID});return false;" class="liteoption" />&nbsp;&nbsp;&nbsp;<input type="button" onclick="AJAXEndPostEdit({searchresults.U_POST_ID}, {RETURN_CHARS});return false;" value="{L_SAVE_CHANGES}" class="liteoption" />&nbsp;<input type="button" onclick="AJAXCancelPostEdit({searchresults.U_POST_ID});return false;" value="{L_CANCEL}" class="liteoption" />&nbsp;<a href="{searchresults.U_EDIT_POST}" class="gen">{L_FULL_EDIT}</a>
</div>
<!-- END can_edit -->
</td>
</tr>
<!-- END searchresults -->
<tr>
<td class="cat" colspan="2">&nbsp;</td>
</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="tbl"><tr><td class="tbll"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblbot"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblr"><img src="images/spacer.gif" alt="" width="8" height="4" /></td></tr></table>
<table width="100%" cellspacing="2" cellpadding="2" border="0">
<tr> 
<td width="100%" class="nav"><a href="{U_INDEX}">{L_INDEX}</a> &raquo; <a href="{U_SEARCH}">{L_SEARCH}</a> &raquo; {L_SEARCH_MATCHES}</td>
<td nowrap="nowrap" class="nav">{PAGINATION}</td>
</tr>
<tr>
	<td colspan="2"><br />{JUMPBOX}</td>
	</tr>
</table>

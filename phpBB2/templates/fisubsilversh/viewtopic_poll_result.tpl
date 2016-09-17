<table width="100%" border="0" cellpadding="3" cellspacing="1" class="forumline">
<tr> 
<th>Poll :: {POLL_QUESTION}</th>
</tr>
<tr>
<td class="row2">
<br />
<table cellspacing="0" cellpadding="4" border="0" align="center">
<tr> 
<td><table cellspacing="0" cellpadding="2" border="0">
<!-- BEGIN poll_option -->
<tr> 
<td>{poll_option.POLL_OPTION_CAPTION}</td>
<td> <table cellspacing="0" cellpadding="0" border="0">
<tr> 
<td><img src="templates/fisubsilversh/images/vote_lcap.gif" width="4" alt="" height="12" /></td>
<td><img src="{poll_option.POLL_OPTION_IMG}" width="{poll_option.POLL_OPTION_IMG_WIDTH}" height="12" alt="{poll_option.POLL_OPTION_PERCENT}" title="{poll_option.POLL_OPTION_PERCENT}" /></td>
<td><img src="templates/fisubsilversh/images/vote_rcap.gif" width="4" alt="" height="12" /></td>
</tr>
</table></td>
<td align="center">&nbsp;<strong>{poll_option.POLL_OPTION_PERCENT}</strong>&nbsp;</td>
<td align="center">[ {poll_option.POLL_OPTION_RESULT} ]</td>
</tr>
<!-- END poll_option -->
</table></td>
</tr>
<tr> 
<td colspan="4" align="center"><strong>{L_TOTAL_VOTES} : {TOTAL_VOTES}</strong></td>
</tr>
<!-- BEGIN switch_view_ballot -->
<tr>
<td align="center"><strong><a href="{U_VIEW_BALLOT}" onClick="return AJAXViewPollBallot({TOPIC_ID});" class="gensmall">{L_VIEW_BALLOT}</a></strong></td>
</tr>
<!-- END switch_view_ballot -->
</table>
<br />
</td>
</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="tbl"><tr><td class="tbll"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblbot"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblr"><img src="images/spacer.gif" alt="" width="8" height="4" /></td></tr></table>
<br />
<script type="text/javascript" src="includes/javascript/ajax_forumfunctions.js"></script>

<!-- BEGIN catrow -->
<!-- BEGIN tablehead -->
<table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
<tr> 
	<th colspan="{catrow.tablehead.INC_SPAN}" width="100%" nowrap="nowrap">&nbsp;{catrow.tablehead.L_FORUM}&nbsp;</th>
	<th width="50" nowrap="nowrap">&nbsp;{L_TOPICS}&nbsp;</th>
	<th width="50" nowrap="nowrap">&nbsp;{L_POSTS}&nbsp;</th>
	<th nowrap="nowrap">&nbsp;</th>
	<th width="150" nowrap="nowrap">&nbsp;{L_LASTPOST}&nbsp;</th>
</tr>
<!-- END tablehead -->
<!-- BEGIN cathead -->
<tr> 
	<!-- BEGIN inc -->
	<td width="46" class="{catrow.cathead.inc.INC_CLASS}"><img src="{SPACER}" width="46" height="0" /></td>
	<!-- END inc -->
	<td class="{catrow.cathead.CLASS_CAT}" width="100%" colspan="{catrow.cathead.INC_SPAN}"><span class="cattitle"><a href="{catrow.cathead.U_VIEWCAT}" class="cattitle" title="{catrow.cathead.CAT_DESC}">{catrow.cathead.CAT_TITLE}</a></span></td>
	<td class="{catrow.cathead.CLASS_ROWPIC}" colspan="5" align="right">&nbsp;</td>
</tr>
<!-- END cathead -->
<!-- BEGIN forumrow -->
<tr> 
	<!-- BEGIN inc -->
	<td width="46" class="{catrow.forumrow.inc.INC_CLASS}"><img src="{SPACER}" width="46" height="0" /></td>
	<!-- END inc -->
	<td  class="{catrow.forumrow.INC_CLASS}" align="center" valign="middle" height="50">{catrow.forumrow.S_MARK_LINK_START}<img src="{catrow.forumrow.FORUM_FOLDER_IMG}" id="forumimage_{catrow.forumrow.FORUM_ID}" alt="{catrow.forumrow.L_FORUM_FOLDER_ALT}" border="0" title="{catrow.forumrow.L_FORUM_FOLDER_ALT}" />{catrow.forumrow.S_MARK_LINK_END}</td>
	<td class="row1" width="100%" height="50" colspan="{catrow.forumrow.INC_SPAN}" valign="top">
		<!-- BEGIN forum_icon -->
		<table cellpadding="2" cellspacing="0" border="0" width="100%" height="47">
		<tr>
			<td width="46" align="center"><a href="{catrow.forumrow.U_VIEWFORUM}"><img src="{catrow.forumrow.ICON_IMG}" border="0" /></a></td>
			<td>
		<!-- END forum_icon -->
		<span class="forumlink"><a href="{catrow.forumrow.U_VIEWFORUM}" class="forumlink">{catrow.forumrow.FORUM_NAME}</a><br /></span>
		<span class="genmed">{catrow.forumrow.FORUM_DESC}</span>
		<span class="gensmall">{catrow.forumrow.L_MODERATOR}{catrow.forumrow.MODERATORS}{catrow.forumrow.L_LINKS}{catrow.forumrow.LINKS}</span>
		<!-- BEGIN forum_icon -->
			</td>
		</tr>
		</table>
		<!-- END forum_icon -->
	</td>
	<!-- BEGIN forum_link_no -->
	<td class="row3" align="center" valign="middle" height="50"><span class="gensmall">{catrow.forumrow.TOPICS}</span></td>
	<td class="row2" align="center" valign="middle" height="50"><span class="gensmall">{catrow.forumrow.POSTS}</span></td>
	<td class="row2" align="center" valign="middle" height="50"><span class="gensmall">{catrow.forumrow.ICONS}</span></td>
	<td class="row3" align="center" valign="middle" height="50" nowrap="nowrap"> <span class="gensmall">{catrow.forumrow.LAST_POST}</span></td>
	<!-- END forum_link_no -->
	<!-- BEGIN forum_link -->
	<td class="row3" align="center" valign="middle" height="50" colspan="4"><span class="gensmall">{catrow.forumrow.forum_link.HIT_COUNT}</span></td>
	<!-- END forum_link -->
</tr>
<!-- END forumrow -->
<!-- BEGIN catfoot -->
<tr>
	<!-- BEGIN inc -->
	<td width="46" class="{catrow.catfoot.inc.INC_CLASS}"><img src="{SPACER}" width="46" height="0" /></td>
	<!-- END inc -->
	<td colspan="{catrow.catfoot.INC_SPAN}" height="1" class="spacerow"><img src="{SPACER}" alt="" width="1" height="1" /></td>
</tr>
<!-- END catfoot -->
<!-- BEGIN tablefoot -->
</table>
<table border="0" cellpadding="0" cellspacing="0" class="tbl"><tr><td class="tbll"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblbot"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblr"><img src="images/spacer.gif" alt="" width="8" height="4" /></td></tr></table>
<br class="gensmall" />
<!-- END tablefoot -->
<!-- END catrow -->
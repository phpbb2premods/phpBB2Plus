<form method="post" action="{S_MODE_ACTION}">
<table width="100%" cellspacing="2" cellpadding="2" border="0">
<tr>
	<td colspan="2" class="maintitle">{L_MEMBERLIST}</td>
	</tr>
<tr> 
<td class="nav"><a href="{U_INDEX}">{L_INDEX}</a> &raquo; {L_MEMBERLIST}</td>
<td align="right" nowrap="nowrap" class="nav">{PAGINATION}</td>
</tr>
</table>
<table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
<tr>
<th>#</th>
<th>{L_PM}</th>
<th>{L_ON_OFF_STATUS}</th>
<th>{L_USERNAME}</th>
<th>{L_EMAIL}</th>
<th>{L_FROM}</th>
<th>{L_JOINED}</th>
<th>{L_POSTS}</th>
<th>{L_LOGON}</th>
<th>{L_WEBSITE}</th>
<th>{L_ALBUM}</th>
</tr>
<!-- BEGIN memberrow -->
<tr>
<td class="{memberrow.ROW_CLASS}" align="center">&nbsp;{memberrow.ROW_NUMBER}&nbsp;</td>
<td class="{memberrow.ROW_CLASS}" align="center">&nbsp;{memberrow.PM_IMG}&nbsp;</td>
<td class="{memberrow.ROW_CLASS}" align="center">&nbsp;{memberrow.USER_ONLINE}&nbsp;</td>
<td class="{memberrow.ROW_CLASS}" align="center">{memberrow.U_VIEWPROFILE}</td>
<td class="{memberrow.ROW_CLASS}" align="center">&nbsp;{memberrow.EMAIL_IMG}&nbsp;</td>
<td class="{memberrow.ROW_CLASS}" align="center"><table class="gen"><tr><td align=center width="100%">{memberrow.FROM}</td><td align=right>{memberrow.FLAG}</td></tr></table></td>
<td class="{memberrow.ROW_CLASS}" align="center"><span class="gensmall">{memberrow.JOINED}</span></td>
<td class="{memberrow.ROW_CLASS}" align="center">{memberrow.POSTS}</td>
<td class="{memberrow.ROW_CLASS}" align="center"><span class="gensmall">{memberrow.LAST_LOGON}</span></td>
<td class="{memberrow.ROW_CLASS}" align="center">&nbsp;{memberrow.WWW_IMG}&nbsp;</td>
<td class="{memberrow.ROW_CLASS}" align="center">&nbsp;{memberrow.GALLERY_IMG}&nbsp;</td>
</tr>
<!-- END memberrow -->
<tr align="center">
<td class="cat" colspan="11">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<td class="gensmall">{L_SELECT_SORT_METHOD}:&nbsp;</td>
<td>{S_MODE_SELECT}&nbsp;&nbsp;</td>
<td class="gensmall">{L_ORDER}:&nbsp;</td>
<td>{S_ORDER_SELECT}&nbsp;</td>
<td><input type="submit" name="submit" value="{L_SUBMIT}" class="catbutton" /></td>
</tr>
</table>
</td>
</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="tbl"><tr><td class="tbll"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblbot"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblr"><img src="images/spacer.gif" alt="" width="8" height="4" /></td></tr></table>
<table width="100%" cellspacing="2" cellpadding="2" border="0">
<tr> 
<td class="nav"><a href="{U_INDEX}">{L_INDEX}</a> &raquo; {L_MEMBERLIST}</td>
<td align="right" nowrap="nowrap" class="nav">{PAGINATION}</td>
</tr>
</table>
</form>
<table width="100%" cellspacing="2" cellpadding="2" border="0">
<tr>
	<td><br />{JUMPBOX}</td>
	</tr>
</table>
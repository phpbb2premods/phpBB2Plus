<!-- BEGIN statusrow -->
<table width="100%" cellspacing="2" cellpadding="2" border="1" align="center">
	<tr> 
	  <td align="center"><span class="gen">{L_STATUS}<br />{STATUS_TIME}<br /></span>
	  <span class="genmed"><b>{I_STATUS_MESSAGE}</b></span><br /></td>
	</tr>
  </table>
<!-- END statusrow -->

<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
	<tr> 
	  <td align="left"><span class="maintitle">{L_PAGE_NAME}</span>
	  	<br /><span class="gensmall"><b>{L_VERSION} {VERSION}
	  	<br />{NIVISEC_CHECKER_VERSION}</b></span><br /><br />
	  <span class="genmed">{L_PAGE_DESC}<br><span class="gensmall">{L_COLORS_DESC}<br>{HTML_COLOR_LIST}</span><br /><br />{VERSION_CHECK_DATA}</span></td>
	</tr>
</table>

<br />
<form action="{S_ACTION}" name="user_list_form" method="post">

<table  border="0" cellpadding="3" cellspacing="1" width="95%" class="forumline" align="center">
	<tr> 
		<th class="thHead"  height="25" valign="middle" >{L_GROUP_NAME}</th>
		<th class="thHead"  height="25" valign="middle" >{L_USER_COUNT}</th>
		<th class="thHead"  height="25" valign="middle" nowrap="nowrap">{L_EXAMPLE}</th>
		<th class="thHead"  height="25" valign="middle" >{L_COLOR}</th>
		<th class="thHead"  height="25" valign="middle" >{L_STATUS}</th>
		<th class="thHead"  height="25" valign="middle" >&nbsp;</th>
		<th class="thHead"  height="25" valign="middle" >&nbsp;</th>
		<th class="thHead"  height="25" valign="middle" >&nbsp;</th>
		<th class="thHead"  height="25" valign="middle" >{L_HIDE_ON_INDEX}</th>
	</tr>
<!-- BEGIN grouprow -->
<tr>
	<td class="row1" width="45%"><span class="gen">{grouprow.NAME}</span></td>
	<td class="row2" align="center"><span class="gen">{grouprow.COUNT}</span></td>
	<td class="row1" align="center" nowrap="nowrap"><span class="gen">[ <span  style="font-weight:bold;color:{grouprow.COLOR}">{L_EXAMPLE}</span> ]</span></td>
	<td class="row2" align="center"><span class="gen"><input type="text" class="post" name="color_change_{grouprow.ID}" value="{grouprow.COLOR}" size="9" maxlength="50"></span></td>
	<td class="row1" align="center"><span class="gensmall">{grouprow.STATUS}</span></td>
	<td class="row2" align="center"><span class="gen"><input type="submit" name="edit_group_{grouprow.ID}" class="liteoption" value="{L_DEFINE_USERS}"></span></td>
	<td class="row1" align="center"><span class="gen"><input type="submit" name="delete_group_{grouprow.ID}" class="liteoption" value="{L_DELETE}"></span></td>
	<td class="row2" align="center" nowrap="nowrap"><span class="genmed">{grouprow.MOVE_UP}<br>{grouprow.MOVE_DOWN}</span></td>
	<td class="row1" align="center"><span class="genmed"><input type="submit" name="{grouprow.HIDE}" class="liteoption" value="{grouprow.L_HIDE}"></span></td>
</tr>
<!-- END grouprow -->
<!-- BEGIN emptyswitch -->
<tr>
	<td class="row1" colspan="7" align="center"><span class="gen">{L_NO_GROUPS}</span></td>
</tr>
<!-- END emptyswitch -->
	<tr>
		<td class="cat" colspan="9" align="center" height="28">
		<input type="hidden" name="mode" value="{S_MODE}">
		<input type="submit" name="update_groups" value="{L_UPDATE}" class="mainoption">&nbsp;&nbsp;
		<input type="reset" value="{L_RESET}" name="reset" class="liteoption">&nbsp;&nbsp;
		</td>
	</tr>
<tr>
	<td class="row1" width="35%"><span class="gen"><input type="text" name="new_group_name" value="" class="post" size="30" maxlength="255"></span></td>
	<td class="row2" align="center"><span class="gen">&nbsp;</span></td>
	<td class="row1" align="center"><span class="gen">&nbsp;</span></td>
	<td class="row2" align="center"><span class="gen"><input type="text" class="post" name="new_group_color" value="" size="9" maxlength="50"></span></td>
	<td class="row1" align="center"><span class="gensmall">{grouprow.STATUS}</span></td>
	<td class="row2" align="center"><span class="gen">&nbsp;</span></td>
	<td class="row1" align="center"><span class="gen">&nbsp;</span></td>
	<td class="row2" align="center"><span class="genmed">&nbsp;</span></td>
	<td class="row1" align="center"><span class="genmed">&nbsp;</span></td>
</tr>
	<tr>
		<td class="cat" colspan="9" align="center" height="28">
		<input type="submit" name="add_new_group" value="{L_ADD_NEW_GROUP}" class="liteoption">
		</td>
	</tr>
</table>
</form>
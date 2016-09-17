<script type="text/javascript" src="../includes/javascript/ajax_searchfunctions.js"></script>

<div class="maintitle">{L_USER_TITLE}</div>
<br />
<div class="genmed">{L_USER_EXPLAIN}</div>
<br />
<form method="post" name="post" action="{S_USER_ACTION}">
<table cellspacing="1" cellpadding="3" border="0" align="center" class="forumline">
<tr> 
<th>{L_USER_SELECT}</th>
</tr>
<tr> 
<td class="row1" align="center">
<input type="text" class="post" name="username" id="username" maxlength="50" size="20" onkeyup="AJAXUsernameSearch(this.value, 0);" /><input type="checkbox" name="new_user">{L_CREATE_USER}
<span id="username_list" style="display:none;"><span id="username_select">&nbsp;</span>&nbsp;</span><input type="hidden" name="mode" value="edit" />
{S_HIDDEN_FIELDS}
<input type="submit" name="submituser" value="{L_LOOK_UP}" class="mainoption" />
<input type="submit" name="usersubmit" value="{L_FIND_USERNAME}" class="button" onclick="window.open('{U_SEARCH_USER}', '_phpbbsearch', 'HEIGHT=250,resizable=yes,WIDTH=400');return false;" />
</td>
</tr>
<tr id="username_error_tbl" style="display:none;">
<td class="row1" id="username_error_text">&nbsp;</td>
</tr>
</table>
</form>
<br />
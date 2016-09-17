<script language="JavaScript">
function make_real_lists()
{
    var insertUserArea = document.ul_form.real_user_list;
    var userListBox = document.ul_form.user_list_box;
    var insertGroupArea = document.ul_form.real_group_list;
    var groupListBox = document.ul_form.group_list_box;
	var i = 0;
	var count = 0;
	var insertData = "";
	
    
    if(groupListBox.options.length > 0)
    {
        for(i = 0; i < groupListBox.options.length; i++)
        {
            if (groupListBox.options[i].selected)
            {
                if (insertData != "" || insertGroupArea.value != "") insertData += ", ";
                insertData += groupListBox.options[i].value;
            }
        }
     	insertGroupArea.value = insertData;
    }
    
    insertData = "";
    
    if(userListBox.options.length > 0)
    {
        for(i = 0; i < userListBox.options.length; i++)
        {
            if (userListBox.options[i].selected)
            {
                if (insertData != "" || insertUserArea.value != "") insertData += ", ";
                insertData += userListBox.options[i].value;
            }
        }
     	insertUserArea.value = insertData;
    }
}
</script>

<!-- BEGIN statusrow -->
<table width="100%" cellspacing="2" cellpadding="2" border="1" align="center">
	<tr> 
	  <td align="center"><span class="gen">{L_STATUS}<br /></span>
	  <span class="genmed"><b>{I_STATUS_MESSAGE}</b></span><br /></td>
	</tr>
  </table>
<!-- END statusrow -->

<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
	<tr> 
	  <td align="left"><span class="maintitle">{L_PAGE_NAME}</span>
	  	<br /><span class="gensmall"><b>{L_VERSION} {VERSION}
	  	<br />{NIVISEC_CHECKER_VERSION}</b></span><br /><br />
	  <span class="genmed">{L_PAGE_DESC}<br /><br />{VERSION_CHECK_DATA}</span></td>
	</tr>
</table>
<br>
<span class="gen">{L_EDITING_GROUP} - [ <span  class="gen" style="font-weight:bold;color:{S_GROUP_COLOR}">{L_EXAMPLE}</span> ]</span>
<br><br>
<span class="gen">{L_LIST_INFO}</span>
<form action="{S_ACTION}" name="ul_form" method="post">
<table  border="0" cellpadding="3" cellspacing="1" width="90%" class="forumline" align="center">
<tr>
<th class="thCat" align="center">{L_USERS_LIST}</th>
<th class="thCat" align="center">{L_GROUPS_LIST}</th>
<tr>
	<td class="row1" align="center" width="50%" valign="middle">
	{S_USER_LIST_BOX}
 	</td>
	<td class="row1" align="center" width="50%" valign="middle">
	{S_GROUP_LIST_BOX}
	</td>
</tr>
	<tr>
		<td class="cat" colspan="3" align="center" height="28">
		<input type="hidden" name="real_user_list" value="">
		<input type="hidden" name="real_group_list" value="">
		<input type="hidden" name="group_id" value="{S_GROUP_ID}">
		<input type="submit" name="update_group_list" value="{L_UPDATE}" class="mainoption" onClick="make_real_lists();" />&nbsp;&nbsp;
		<input type="reset" value="{L_RESET}" name="reset" class="liteoption" /></td>
	</tr>
</table>
</form>
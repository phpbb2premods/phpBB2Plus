<form action="{S_PROFILE_ACTION}" method="post" name="profileform">

{ERROR_BOX}

<table border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
	<tr>
		<th class="thHead" colspan="2" height="25" valign="middle">{L_REGISTRATION_INFO}</th>
	</tr>
	<tr>
		<td class="row2" colspan="2"><span class="gensmall">{L_ITEMS_REQUIRED}</span></td>
	</tr>
	   <tr>
	      <td class="row1" width="50%"><span class="gen">{L_USERNAME}: *</span></td>
	      <td class="row2"><input type="text" class="post" style="width:200px" name="username" size="25" maxlength="25" value="{USERNAME}" /></td>
	   </tr>
	<tr>
		<td class="row1"><span class="gen">{L_EMAIL_ADDRESS}: *</span></td>
		<td class="row2"><input type="text" class="post" style="width:200px" name="email" size="25" maxlength="255" value="{EMAIL}" /></td>
	</tr>
	<tr>
	  <td class="row1"><span class="gen">{L_NEW_PASSWORD}: *</span><br />
		<span class="gensmall">{L_PASSWORD_IF_CHANGED}</span></td>
	  <td class="row2">
      <input type="password" class="post" style="width: 200px" name="new_password" size="25" maxlength="32" value="{NEW_PASSWORD}" />
     </td>
   </tr>
   <tr>
     <td class="row1"><span class="gen">{L_CONFIRM_PASSWORD}: * </span><br />
      <span class="gensmall">{L_PASSWORD_CONFIRM_IF_CHANGED}</span></td>
     <td class="row2">
      <input type="password" class="post" style="width: 200px" name="password_confirm" size="25" maxlength="32" value="{PASSWORD_CONFIRM}" />
     </td>
   </tr>
	<tr>
	  <th class="thSides" colspan="2" height="25" valign="middle">{L_PREFERENCES}</th>
	</tr>
	<tr>
	  <td class="row1"><span class="gen">{L_BOARD_LANGUAGE}:</span></td>
	  <td class="row2"><span class="gensmall">{LANGUAGE_SELECT}</span></td>
	</tr>
	<tr>
	  <td class="row1"><span class="gen">{L_BOARD_STYLE}:</span></td>
	  <td class="row2"><span class="gensmall">{STYLE_SELECT}</span></td>
	</tr>
	<tr>
	  <td class="row1"><span class="gen">{L_TIMEZONE}:</span></td>
	  <td class="row2"><span class="gensmall">{TIMEZONE_SELECT}</span></td>
	</tr>
	<tr>
	  <td class="row1"><span class="gen">{L_DATE_FORMAT}:</span></td>
	  <td class="row2"><span class="gensmall">{DATE_FORMAT_SELECT}</span></td>
	</tr>
	<tr>
		<td class="cat" colspan="2" align="center" height="28">{S_HIDDEN_FIELDS}<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;<input type="reset" value="{L_RESET}" name="reset" class="liteoption" /></td>
	</tr>
</table>

</form>
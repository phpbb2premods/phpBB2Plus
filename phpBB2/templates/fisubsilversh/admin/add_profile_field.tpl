
<h1>{L_ADD_FIELD_TITLE}</h1>

<p>{L_ADD_FIELD_EXPLAIN}</p>

<form action="{S_ADD_FIELD_ACTION}" method="post">
<table width="99%" cellpadding="4" cellspacing="1" border="0" align="center" class="forumline">
	<tr>
	  <th class="thHead" colspan="2">{L_GENERAL_SETTINGS}</th>
	</tr>
	<tr>
		<td class="row1">{L_NEW_FIELD_NAME}<br /><span class="gensmall">{L_NEW_FIELD_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" maxlength="255" size="40" name="field_name" value="{FIELD_NAME}" /></td>
	</tr>
	<tr>
	  <td class="row1">{L_NEW_FIELD_DESCRIPTION}<br /><span class="gensmall">{L_NEW_FIELD_DESCRIPTION_EXPLAIN}</span></td>
	  <td class="row2"><input class="post" type="text" maxlength="255" size="40" name="field_descrition" value="{FIELD_DESCRIPTION}" /></td>
	</tr>
	<tr>
		<td class="row1" valign="top">{L_NEW_FIELD_TYPE}<br /><span class="gensmall">{L_NEW_FIELD_TYPE_EXPLAIN}</span></td>
		<td class="row2">
			<table width="99%" cellpadding="4" cellspacing="1" border="0" align="center" class="forumline">
				<tr>
				  <td class="row3" colspan="2"><input type="radio" name="field_type" value="{S_TEXT_FIELD}"{TEXT_FIELD_CHECKED} />{L_TEXT_FIELD} :: <input name="text" type="text" class="post" style="width: 200px" value="{L_TEXT_FIELD_EXAMPLE}" /></td>
				</tr>
				<tr>
				  <th class="thHead" colspan="2">{L_TEXT_FIELD_SETTINGS}</th>
				</tr>
				<tr>
				  <td class="row1">{L_DEFAULT_VALUE}<br /><span class="gensmall">{L_DEFAULT_VALUE_EXPLAIN}</span></td>
				  <td class="row2"><input class="post" type="text" maxlength="255" size="25" name="text_field_default" value="{TEXT_FIELD_DEFAULT}" /></td>
				</tr>
				<tr>
				  <td class="row1">{L_MAX_LENGTH}<br /><span class="gensmall">{L_MAX_LENGTH_TEXT_FIELD_EXPLAIN}</span></td>
				  <td class="row2"><input class="post" type="text" maxlength="3" size="3" name="text_field_maxlen" value="{TEXT_FIELD_MAXLENGTH}" /></td>
				</tr>
			</table>
			<br />
			<table width="99%" cellpadding="4" cellspacing="1" border="0" align="center" class="forumline">
				<tr>
				  <td class="row3" colspan="2"><input type="radio" name="field_type" value="{S_TEXTAREA}"{TEXTAREA_CHECKED} />{L_TEXTAREA} :: <textarea style="width: 200px" rows="1" class="post">{L_TEXTAREA_EXAMPLE}</textarea></td>
				</tr>
				<tr>
				  <th class="thHead" colspan="2">{L_TEXT_AREA_SETTINGS}</th>
				</tr>
				<tr>
				  <td class="row1" valign="top">{L_DEFAULT_VALUE}<br /><span class="gensmall">{L_DEFAULT_VALUE_EXPLAIN}</span></td>
				  <td class="row2"><textarea style="width: 300px" rows="6" class="post" name="text_area_default">{TEXTAREA_DEFAULT}</textarea></td>
				</tr>
				<tr>
				  <td class="row1">{L_MAX_LENGTH}<br /><span class="gensmall">{L_MAX_LENGTH_TEXTAREA_EXPLAIN}</span></td>
				  <td class="row2"><input class="post" type="text" size="4" name="text_area_maxlen" value="{TEXTAREA_MAXLENGTH}" /></td>
				</tr>
			</table>
			<br />
			<table width="99%" cellpadding="4" cellspacing="1" border="0" align="center" class="forumline">
				<tr>
				  <td class="row3" colspan="2"><input type="radio" name="field_type" value="{S_RADIO}"{RADIO_CHECKED} />{L_RADIO} :: <input type="radio" name="radio_test" checked="checked" />&nbsp;<input type="radio" name="radio_test" /> <span class="gen">{L_RADIO_EXAMPLE}</td>
				</tr>
				<tr>
				  <th class="thHead" colspan="2">{L_RADIO_BUTTON_SETTINGS}</th>
				</tr>
				<tr>
				  <td class="row1">{L_AVAILABLE_VALUES}<br /><span class="gensmall">{L_AVAILABLE_VALUES_EXPLAIN}</span></td>
				  <td class="row2"><textarea name="radio_values" class="post" style="width: 150px" rows="5">{RADIO_VALUES}</textarea></td>
				</tr>
				<tr>
				  <td class="row1">{L_DEFAULT_VALUE}<br /><span class="gensmall">{L_DEFAULT_VALUE_RADIO_EXPLAIN}</span></td>
				  <td class="row2"><input class="post" type="text" name="radio_default_value" style="width: 150px" value="{RADIO_DEFAULT}"></td>
				</tr>
			</table>
			<br />
			<table width="99%" cellpadding="4" cellspacing="1" border="0" align="center" class="forumline">
				<tr>
				  <td class="row3" colspan="2"><input type="radio" name="field_type" value="{S_CHECKBOX}"{CHECKBOX_CHECKED} />{L_CHECKBOX} :: <input type="checkbox" />&nbsp;<input type="checkbox" /> <span class="gen">{L_CHECKBOX_EXAMPLE}</td>
				</tr>
				<tr>
				  <th class="thHead" colspan="2">{L_CHECKBOX_SETTINGS}</th>
				</tr>
				<tr>
				  <td class="row1">{L_AVAILABLE_VALUES}<br /><span class="gensmall">{L_AVAILABLE_VALUES_EXPLAIN}</span></td>
				  <td class="row2"><textarea name="checkbox_values" class="post" style="width: 150px" rows="5">{CHECKBOX_VALUES}</textarea></td>
				</tr>
				<tr>
				  <td class="row1">{L_DEFAULT_VALUE}<br /><span class="gensmall">{L_DEFAULT_VALUE_CHECKBOX_EXPLAIN}</span></td>
				  <td class="row2"><textarea name="check_default_values" class="post" style="width: 150px" rows="5">{CHECKBOX_DEFAULT}</textarea></td>
				</tr>
			</table>
		</td>
	</tr>
  <tr>
	  <th class="thHead" colspan="2">{L_ADMIN_SETTINGS}</th>
	</tr>
	<tr>
		<td class="row1">{L_REQUIRED_FIELD}<br /><span class="gensmall">{L_REQUIRED_FIELD_EXPLAIN}</span></td>
		<td class="row2">
      <input type="radio" name="required" value="{S_REQUIRED}"{REQUIRED_CHECKED} />
  		<span class="gen">{L_YES}</span>&nbsp;&nbsp; 
  		<input type="radio" name="required" value="{S_NOT_REQUIRED}"{NOT_REQUIRED_CHECKED} />
  		<span class="gen">{L_NO}</span></td>
	</tr>
	<tr>
		<td class="row1">{L_USER_CAN_VIEW}<br /><span class="gensmall">{L_USER_CAN_VIEW_EXPLAIN}</span></td>
		<td class="row2">
      <input type="radio" name="user_can_view" value="{S_ALLOW_VIEW}"{ALLOW_VIEW_CHECKED} />
  		<span class="gen">{L_YES}</span>&nbsp;&nbsp; 
  		<input type="radio" name="user_can_view" value="{S_DISALLOW_VIEW}"{DISALLOW_VIEW_CHECKED} />
  		<span class="gen">{L_NO}</span></td>
	</tr>
  <tr>
	  <th class="thHead" colspan="2">{L_VIEW_SETTINGS}</th>
	</tr>
	<tr>
	  <td class="row3" colspan="2" align="center"><span class="genmed">{L_VIEW_DISCLAIMER}</span></td>
	</tr>
	<tr>
		<td class="row1">{L_VIEW_IN_PROFILE}</td>
		<td class="row2">
      <input type="radio" name="view_in_profile" value="{S_VIEW_IN_PROFILE}"{VIEW_IN_PROFILE_CHECKED} />
  		<span class="gen">{L_YES}</span>&nbsp;&nbsp; 
  		<input type="radio" name="view_in_profile" value="{S_NO_VIEW_IN_PROFILE}"{NO_VIEW_IN_PROFILE_CHECKED} />
  		<span class="gen">{L_NO}</span></td>
	</tr>
	<tr>
	  <td class="row1" style="padding-left: 1cm"><span class="gensmall">{L_PROFILE_LOCATIONS_EXPLAIN}</span></td>
	  <td class="row2" style="padding-left: 1cm">
	    <input type="radio" name="profile_location" value="{S_CONTACTS}"{CONTACTS_CHECKED} />
	    <span class="gen">{L_CONTACTS_COLUMN}</span><br />
	    <input type="radio" name="profile_location" value="{S_ABOUT}"{ABOUT_CHECKED} />
    <span class="gen">{L_ABOUT_COLUMN}</span>	</tr>
	<tr>
		<td class="row1">{L_VIEW_IN_MEMBERLIST}</td>
		<td class="row2">
      <input type="radio" name="view_in_memberlist" value="{S_VIEW_IN_MEMBERLIST}"{VIEW_IN_MEMBERLIST} />
  		<span class="gen">{L_YES}</span>&nbsp;&nbsp; 
  		<input type="radio" name="view_in_memberlist" value="{S_NO_VIEW_IN_MEMBERLIST}"{NO_VIEW_IN_MEMBERLIST} />
  		<span class="gen">{L_NO}</span></td>
	</tr>
	<tr>
		<td class="row1">{L_VIEW_IN_TOPIC}</td>
		<td class="row2">
      <input type="radio" name="view_in_topic" value="{S_VIEW_IN_TOPIC}"{VIEW_IN_TOPIC} />
  		<span class="gen">{L_YES}</span>&nbsp;&nbsp; 
  		<input type="radio" name="view_in_topic" value="{S_NO_VIEW_IN_TOPIC}"{NO_VIEW_IN_TOPIC} />
  		<span class="gen">{L_NO}</span></td>
	</tr>
	<tr>
	  <td class="row1" style="padding-left: 1cm"><span class="gensmall">{L_TOPIC_LOCATIONS_EXPLAIN}</span></td>
	  <td class="row2" style="padding-left: 1cm">
	    <input type="radio" name="signature_wrap" value="{S_AUTHOR}"{AUTHOR_CHECKED} />
	    <span class="gen">{L_AUTHOR_COLUMN}</span>
      <br /><input type="radio" name="signature_wrap" value="{S_ABOVE_SIGNATURE}"{ABOVE_SIG_CHECKED} />
      <span class="gen">{L_ABOVE_SIGNATURE}</span>
      <br /><input type="radio" name="signature_wrap" value="{S_BELOW_SIGNATURE}"{BELOW_SIG_CHECKED} />
      <span class="gen">{L_BELOW_SIGNATURE}</span></td>
	</tr>
	<tr>
		<td class="cat" colspan="2" align="center" id="submitbar">{S_HIDDEN_FIELDS}<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" onclick="selectAll()" />&nbsp;&nbsp;<input type="reset" value="{L_RESET}" class="liteoption" />		</td>
	</tr>
</table>
</form>

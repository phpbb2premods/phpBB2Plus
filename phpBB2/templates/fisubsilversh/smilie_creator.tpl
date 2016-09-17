<script language="JavaScript">
//<!--
function makeschild(){
	var text = document.schilderstellung.schildtext.value;
         var color = document.schilderstellung.color.value;
         var shadowcolor = document.schilderstellung.shadowcolor.value;
         var shieldshadow = document.schilderstellung.shieldshadow.value;

	{SMILIES_JS}

	if(text){
		if(smilie == "standard") var text2form = "[schild=standard fontcolor="+color+" shadowcolor="+shadowcolor+" shieldshadow="+shieldshadow+"]"+text+"[/schild]";
		else var text2form = "[schild="+smilie+" fontcolor="+color+" shadowcolor="+shadowcolor+" shieldshadow="+shieldshadow+"]"+text+"[/schild]";

		opener.document.forms['post'].message.value += text2form;
		if(!confirm("{L_ANOTHER_SHIELD}")){
			window.close();
			 opener.document.forms['post'].message.focus();
		}else{
                         document.schilderstellung.reset();
		}
	}else{
		alert("{L_NOTEXT_ERROR}");
	}
}
//-->
</script>
<table cellpadding=4 cellspacing=1 border=0 width="100%" class="forumline">
<tr>
        <td colspan="2" class="catHead" height="28" align="center" valign="middle"><span class="cattitle">{L_SMILIE_CREATOR}</span></td>
  </tr>
	<form name="schilderstellung">
	<tr bgcolor="{tablec}" id="tablec">
		<td class="row1"><span class="gen"><b>{L_SHIELDTEXT}:</b></span></td>
		<td class="row2"><input type="text" name="schildtext" class="post" size="30" maxlength="396"></td>
	</tr>
	<tr>
		<td class="row1"><span class="gen"><b>{L_FONTCOLOR}:</b></span></td>
		<td class="row2"><table>
			<tr><select name="color">
                                                                                    <option style="color:black; background-color: {T_TD_COLOR1}" value="000000" class="genmed">{L_COLOR_DEFAULT}</option>
                                          <option style="color:darkred; background-color: {T_TD_COLOR1}" value="8B0000" class="genmed">{L_COLOR_DARK_RED}</option>
                                          <option style="color:red; background-color: {T_TD_COLOR1}" value="FF0000" class="genmed">{L_COLOR_RED}</option>
                                          <option style="color:orange; background-color: {T_TD_COLOR1}" value="FFA500" class="genmed">{L_COLOR_ORANGE}</option>
                                          <option style="color:brown; background-color: {T_TD_COLOR1}" value="A52A2A" class="genmed">{L_COLOR_BROWN}</option>
                                          <option style="color:yellow; background-color: {T_TD_COLOR1}" value="FFFF00" class="genmed">{L_COLOR_YELLOW}</option>
                                          <option style="color:green; background-color: {T_TD_COLOR1}" value="008000" class="genmed">{L_COLOR_GREEN}</option>
                                          <option style="color:olive; background-color: {T_TD_COLOR1}" value="808000" class="genmed">{L_COLOR_OLIVE}</option>
                                          <option style="color:cyan; background-color: {T_TD_COLOR1}" value="00FFFF" class="genmed">{L_COLOR_CYAN}</option>
                                          <option style="color:blue; background-color: {T_TD_COLOR1}" value="0000FF" class="genmed">{L_COLOR_BLUE}</option>
                                          <option style="color:darkblue; background-color: {T_TD_COLOR1}" value="00008B" class="genmed">{L_COLOR_DARK_BLUE}</option>
                                          <option style="color:indigo; background-color: {T_TD_COLOR1}" value="4B0082" class="genmed">{L_COLOR_INDIGO}</option>
                                          <option style="color:violet; background-color: {T_TD_COLOR1}" value="EE82EE" class="genmed">{L_COLOR_VIOLETT}</option>
                                          <option style="color:white; background-color: {T_TD_COLOR1}" value="FFFFFF" class="genmed">{L_COLOR_WHITE}</option>
                                          <option style="color:black; background-color: {T_TD_COLOR1}" value="000000" class="genmed">{L_COLOR_BLACK}</option>
                                        </select></tr>
		</table></td>
	</tr>
<tr>
		<td class="row1"><span class="gen"><b>{L_SHADOWCOLOR}:</b></span></td>
		<td class="row2"><table>
			<tr><select name="shadowcolor">
                                                                                    <option style="color:black; background-color: {T_TD_COLOR1}" value="C0C0C0" class="genmed">{L_COLOR_DEFAULT}</option>
                                          <option style="color:darkred; background-color: {T_TD_COLOR1}" value="8B0000" class="genmed">{L_COLOR_DARK_RED}</option>
                                          <option style="color:red; background-color: {T_TD_COLOR1}" value="FF0000" class="genmed">{L_COLOR_RED}</option>
                                          <option style="color:orange; background-color: {T_TD_COLOR1}" value="FFA500" class="genmed">{L_COLOR_ORANGE}</option>
                                          <option style="color:brown; background-color: {T_TD_COLOR1}" value="A52A2A" class="genmed">{L_COLOR_BROWN}</option>
                                          <option style="color:yellow; background-color: {T_TD_COLOR1}" value="FFFF00" class="genmed">{L_COLOR_YELLOW}</option>
                                          <option style="color:green; background-color: {T_TD_COLOR1}" value="008000" class="genmed">{L_COLOR_GREEN}</option>
                                          <option style="color:olive; background-color: {T_TD_COLOR1}" value="808000" class="genmed">{L_COLOR_OLIVE}</option>
                                          <option style="color:cyan; background-color: {T_TD_COLOR1}" value="00FFFF" class="genmed">{L_COLOR_CYAN}</option>
                                          <option style="color:blue; background-color: {T_TD_COLOR1}" value="0000FF" class="genmed">{L_COLOR_BLUE}</option>
                                          <option style="color:darkblue; background-color: {T_TD_COLOR1}" value="00008B" class="genmed">{L_COLOR_DARK_BLUE}</option>
                                          <option style="color:indigo; background-color: {T_TD_COLOR1}" value="4B0082" class="genmed">{L_COLOR_INDIGO}</option>
                                          <option style="color:violet; background-color: {T_TD_COLOR1}" value="EE82EE" class="genmed">{L_COLOR_VIOLETT}</option>
                                          <option style="color:white; background-color: {T_TD_COLOR1}" value="FFFFFF" class="genmed">{L_COLOR_WHITE}</option>
                                          <option style="color:black; background-color: {T_TD_COLOR1}" value="000000" class="genmed">{L_COLOR_BLACK}</option>
                                        </select></tr>
		</table></td>
	</tr>
<tr>
		<td class="row1"><span class="gen"><b>{L_SHIELDSHADOW}:</b></span></td>
		<td class="row2"><table>
			<tr><select name="shieldshadow">
                         <option value="1" class="genmed">{L_SHIELDSHADOW_ON}</option>
                         <option value="0" class="genmed">{L_SHIELDSHADOW_OFF}</option>
                         </select></tr>
		</table></td>
	</tr>
<tr>
		<td valign="top" class="row1"><span class="gen"><b>{L_SMILIECHOOSER}:</b></span></td>
		<td class="row2"><table>
		<tr>{SMILIES_WAHL}</tr>
                 <tr><td colspan="5"><input type="radio" name="smilie" value="random" checked><span class="gen">{L_RANDOM_SMILIE}</span></td></tr>
			<tr><td colspan="5"><input type="radio" name="smilie" value="standard"><span class="gen">{L_DEFAULT_SMILIE}</span></td></tr>
		</table></td>
	</tr>
<tr>
  <td class="spacerow" colspan="6" height="1"><img src="templates/fisubsilversh/images/spacer.gif" alt="" width="1" height="1" /></td>
  </tr>
  <tr>
    <td class="cat" align="center" colspan="5" valign="middle">
   <span class="cattitle"><input type="button" class="mainoption" value="{L_CREATE_SMILIE}" onClick="makeschild()" class="input"> <input type="button" class="liteoption" value="{L_STOP_CREATING}" onClick="window.close()" class="input"></span>
    </td>
  </tr>
	</form>
</table>
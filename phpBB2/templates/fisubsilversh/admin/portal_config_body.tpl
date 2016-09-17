<div class="maintitle"><center>{L_CONFIGURATION_TITLE}</center></div>
<br />
<div class="genmed">{L_CONFIGURATION_EXPLAIN}</div>
<br />
<form action="{S_CONFIG_ACTION}" method="post">
<table width="99%" cellpadding="3" cellspacing="1" border="0" align="center" class="forumline">
<tr>
<th colspan="2">{L_GENERAL_SETTINGS}</th>
</tr>
<tr>
<td class="row1" width="38%"><b>{L_WELCOME_TEXT}</b><br />
<span class="gensmall">{L_WELCOME_TEXT_EXPLAIN}</span></td>
<td class="row2" width="62%"><textarea maxlength="9999" size="40" name="welcome_text" rows="10" cols="45">{WELCOME_TEXT}</textarea>
</td>
</tr>
<tr>
<td class="row1" width="38%"><b><br>{L_POLL_FORUM}</b><br><br><span class="gensmall"><br>*<u>{L_COMMA}</u>*</td>
<td class="row2" width="62%">
<input type="text" maxlength="255" size="40" name="poll_forum" value="{POLL_FORUM}" class="post" />
</td>
</tr>
<tr>
<td class="row1" width="38%"><b><br>{L_NUMBER_RECENT_TOPICS}</b><br><br></td>
<td class="row2" width="62%">
<input type="text" maxlength="255" size="5" name="number_recent_topics" value="{NUMBER_RECENT_TOPICS}" class="post" />
</td>
</tr>
<tr>
<td class="row1" width="38%"><b><br>{L_NUMBER_RECENT_FILES}</b><br><br></td>
<td class="row2" width="62%">
<input type="text" maxlength="255" size="5" name="number_recent_files" value="{NUMBER_RECENT_FILES}" class="post" />
</td>
</tr>
<tr>
<td class="row1" width="38%"><b><br>{L_LAST_SEEN}</b><br><br></td>
<td class="row2" width="62%">
<input type="text" maxlength="255" size="5" name="last_seen" value="{LAST_SEEN}" class="post" />
</td>
</tr>
<tr>
<td class="row1" width="38%"><b><br>{L_EXCEPT_FORUM}</b><br><br><span class="gensmall"><br>*<u>{L_EXCEPT_COMMA}</u>*</td>
<td class="row2" width="62%">
<input type="text" maxlength="255" size="40" name="exceptional_forums" value="{EXCEPT_FORUM}" class="post" />
</td>
</tr>
<tr> 
<td class="row1" width="38%"><b><br>{L_NUMBER_TOPPOSTERS}</b><br><br />
<span class="gensmall">{L_TOPPOSTERS_EXPLAIN}</span></td>
<td class="row2"> 
<input type="text" maxlength="5" size="5" name="number_top_posters" value="{NUMBER_TOP_POSTERS}" class="post" />
</td>
</tr>
<tr>
<th colspan="2">{L_RECENT_PIC_SETTINGS}</th>
</tr>
<tr>
<td class="row1" width="38%"><b><br>{L_PIC_CAT_ID}</b><br><span class="gensmall"><br>*<u>{L_PIC_COMMA}</u>*</td>
<td class="row2" width="62%">
<input type="text" maxlength="255" size="40" name="cat_id" value="{PIC_CAT_ID}" class="post" />
</td>
</tr>
<tr>
<td class="row1" width="38%"><b><br>{L_PIC_NUMBER}</b></td>
<td class="row2" width="62%">
<input type="text" maxlength="255" size="5" name="pics_number" value="{PIC_NUMBER}" class="post" />
</td>
</tr>
<tr>
<td class="row1" width="38%"><b><br>{L_PIC_ALL}</b></td>
<td class="row2" width="62%">
<input type="radio" name="pics_all" value="1" {PIC_ALL_YES} />
{L_YES}&nbsp;&nbsp; 
<input type="radio" name="pics_all" value="0" {PIC_ALL_NO} />
{L_NO}</td>
</tr>
<tr>
<td class="row1" width="38%"><b><br>{L_PIC_SORT}</b></td>
<td class="row2" width="62%">
<input type="radio" name="pics_sort" value="1" {PIC_SORT_YES} />
{L_YES}&nbsp;&nbsp; 
<input type="radio" name="pics_sort" value="0" {PIC_SORT_NO} />
{L_NO}</td>
</tr>
<tr>
<td class="row1" width="38%"><b><br>{L_PIC_THUMBSIZE}</b></td>
<td class="row2" width="62%">
<input type="text" maxlength="5" size="5" name="pics_thumbsize" value="{PIC_THUMBSIZE}" class="post" />
</td>
</tr>
<tr>
<td class="cat" colspan="2" align="center">{S_HIDDEN_FIELDS}<br><br>
<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />
&nbsp;&nbsp;
<input type="reset" value="{L_RESET}" class="button" />
</td>
</tr>
</table>
</form>
<br clear="all" />
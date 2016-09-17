<script type="text/javascript">
<!--
var L_RESULTS = '{L_SEARCH_RESULTS}';
var L_RESULT = '{L_SEARCH_RESULT}';
var L_MORE_MATCHES = '{L_MORE_MATCHES}';
//-->
</script>

<script type="text/javascript" src="includes/javascript/ajax_postfunctions.js"></script>


<script language="JavaScript" src="bbcode_box/add_bbcode.js" type="text/javascript"></script>
<form action="{S_POST_ACTION}" method="post" name="post" onsubmit="return checkForm(this)" {S_FORM_ENCTYPE}>
<table width="100%" cellspacing="2" cellpadding="2" border="0">
<tr>
	<td class="maintitle">{L_POST_A}</td>
</tr>
<tr>
<td class="nav"><a href="{U_INDEX}">{L_INDEX}</a> 
<!-- BEGIN switch_not_privmsg -->
{NAV_CAT_DESC}
<!-- END switch_not_privmsg -->
&nbsp;&raquo; {L_POST_A}</td>
</tr>
</table>
<div id="preview_box" {S_DISPLAY_PREVIEW}>{POST_PREVIEW_BOX}</div>
{ERROR_BOX}
<table border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
<tr>
<th colspan="2">{L_POST_A}</th>
</tr>
<!-- BEGIN switch_username_select -->
<tr>
<td align="right" class="row1"><span class="explaintitle">{L_USERNAME}:</span></td>
<td class="row2"><input type="text" class="post" tabindex="1" name="username" size="25" maxlength="25" value="{USERNAME}" onblur="AJAXCheckPostUsername(this.value);" /> 
</td>
</tr>
<tr id="post_username_error_tbl" style="display:none;">
<td class="row1">&nbsp;</td>
<td class="row2"><span class="gen" id="post_username_error_text">&nbsp;</span></td>
</tr>
<!-- END switch_username_select -->
<!-- BEGIN switch_privmsg -->
<tr> 
<td align="right" class="row1"><span class="explaintitle">{L_USERNAME}:</span></td>
<td class="row2"> <input type="text"  class="post" name="username" maxlength="25" size="25" tabindex="1" value="{USERNAME}" onkeyup="AJAXCheckPMUsername(this.value);" /><span id="pm_username_select">&nbsp;</span> 
&nbsp; <input type="submit" name="usersubmit" value="{L_FIND_USERNAME}" class="button" onclick="window.open('{U_SEARCH_USER}', '_phpbbsearch', 'HEIGHT=250,resizable=yes,WIDTH=400');return false;" /> 
</td>
</tr>
<tr id="pm_username_error_tbl" style="display:none;">
<td class="row1">&nbsp;</td>
<td class="row2"><span class="gen" id="pm_username_error_text">&nbsp;</span></td>
</tr>
<!-- END switch_privmsg -->
<tr>
<td width="22%" align="right" class="row1"><span class="explaintitle">{L_SUBJECT}:</span></td>
<td class="row2" width="78%"><input type="text" {S_LOCK_SUBJECT} name="subject" size="45" maxlength="60" style="width:450px" tabindex="2" class="post" value="{SUBJECT}" {S_AJAX_BLUR} /> 
</td>
</tr>
<tr id="subject_error_tbl" style="display:none;">
<td class="row1">&nbsp;</td>
<td class="row2"><span class="gen">{L_EMPTY_SUBJECT}</span></td>
</tr>
<tr id="searchresults_tbl" style="display:none;">
<td class="row1">&nbsp;</td>
<td class="row2"><span class="gen">
<a href="#" target="_blank" class="gen" id="searchresults_lnk">No results found.</a>
</span></td>
</tr>
<!-- BEGIN topic_description -->
<tr>
<td width="22%" align="right" class="row1"><span class="explaintitle">{L_TOPIC_DESCRIPTION}</span></td>
<td class="row2" width="78%"> <span class="gen">
<input type="text" name="topic_desc" size="45" maxlength="60" style="width:450px" tabindex="2" class="post" value="{TOPIC_DESCRIPTION}" />
</span> </td>
</tr>
<!-- END topic_description -->
<!-- BEGIN switch_news_cat -->
<tr>
<td class="row1" width="22%" align="right"><span class="explaintitle">{switch_news_cat.L_NEWS_CATEGORY}</span></td>
<td class="row2" width="78%">
<select name="{switch_news_cat.S_NAME}">
{switch_news_cat.S_CATEGORY_BOX}
</select>
</td>
</tr>
<!-- END switch_news_cat -->
<!-- BEGIN switch_icon_checkbox -->
<tr>
<td valign="top" align="right" class="row1"><span class="explaintitle"><b>{L_ICON_TITLE}</b></td>
<td class="row2">
<table width="100%" border="0" cellspacing="0" cellpadding="2">
<!-- BEGIN row -->
<tr>
<td nowrap="nowrap">
<span class="gen">
<!-- BEGIN cell -->
<input type="radio" name="post_icon" value="{switch_icon_checkbox.row.cell.ICON_ID}"{switch_icon_checkbox.row.cell.ICON_CHECKED}>&nbsp;{switch_icon_checkbox.row.cell.ICON_IMG}&nbsp;&nbsp;
<!-- END cell -->
</span>
</td>
</tr>
<!-- END row -->
</table>
</td>
</tr>
<!-- END switch_icon_checkbox -->
<tr>
<td class="row1" valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="1">
<tr>
<td align="right"><span class="explaintitle">{L_MESSAGE_BODY}:</span></td>
</tr>
<tr>
<td align="center"><br />
<table width="100" border="0" cellspacing="0" cellpadding="5">
<tr align="center">
<td colspan="{S_SMILIES_COLSPAN}" class="gensmall"><span class="explaintitle">{L_EMOTICONS}</span></td>
</tr>
<!-- BEGIN smilies_row -->
<tr align="center">
<!-- BEGIN smilies_col -->
<td><a href="javascript:emoticon('{smilies_row.smilies_col.SMILEY_CODE}')"><img src="{smilies_row.smilies_col.SMILEY_IMG}" border="0" alt="{smilies_row.smilies_col.SMILEY_DESC}" title="{smilies_row.smilies_col.SMILEY_DESC}" /></a></td>
<!-- END smilies_col -->
</tr>
<!-- END smilies_row -->
<!-- BEGIN switch_smilies_extra -->
<tr align="center">
<td colspan="{S_SMILIES_COLSPAN}" class="nav"><a href="{U_MORE_SMILIES}" onclick="window.open('{U_MORE_SMILIES}', '_phpbbsmilies', 'HEIGHT=250,resizable=yes,scrollbars=yes,WIDTH=300');return false;" target="_phpbbsmilies">{L_MORE_SMILIES}</a></td>
</tr>
<!-- END switch_smilies_extra -->
</table>
</td>
</tr>
</table>
</td>
<td class="row2" valign="top">
<table width="500" border="0" cellspacing="0" cellpadding="2">
<tr align="right" valign="middle"> 
<td>
<p style="margin-top: 0; margin-bottom: 0" align="left">
<span class="gen"> 
<span class="genmed">&nbsp;<select name="fc" onChange="BBCfc()" onMouseOver="helpline('fc')"
<option style="color:darkred; background-color: {T_TD_COLOR1}" value="darkred" class="genmed">
<option selected>{L_FONT_COLOR}</option>
<option style="color:black" value="{T_FONTCOLOR1}">{L_COLOR_DEFAULT}</option>
<option value="darkred">{L_COLOR_DARK_RED}</option>
<option style="color:red; background-color: {T_TD_COLOR1}" value="red" class="genmed">{L_COLOR_RED}</option>
<option style="color:orange; background-color: {T_TD_COLOR1}" value="orange" class="genmed">{L_COLOR_ORANGE}</option>
<option style="color:brown; background-color: {T_TD_COLOR1}" value="brown" class="genmed">{L_COLOR_BROWN}</option>
<option style="color:yellow; background-color: {T_TD_COLOR1}" value="yellow" class="genmed">{L_COLOR_YELLOW}</option>
<option style="color:green; background-color: {T_TD_COLOR1}" value="green" class="genmed">{L_COLOR_GREEN}</option>
<option style="color:olive; background-color: {T_TD_COLOR1}" value="olive" class="genmed">{L_COLOR_OLIVE}</option>
<option style="color:cyan; background-color: {T_TD_COLOR1}" value="cyan" class="genmed">{L_COLOR_CYAN}</option>
<option style="color:blue; background-color: {T_TD_COLOR1}" value="blue" class="genmed">{L_COLOR_BLUE}</option>
<option style="color:darkblue; background-color: {T_TD_COLOR1}" value="darkblue" class="genmed">{L_COLOR_DARK_BLUE}</option>
<option style="color:indigo; background-color: {T_TD_COLOR1}" value="indigo" class="genmed">{L_COLOR_INDIGO}</option>
<option style="color:violet; background-color: {T_TD_COLOR1}" value="violet" class="genmed">{L_COLOR_VIOLET}</option>
<option style="color:white; background-color: {T_TD_COLOR1}" value="white" class="genmed">{L_COLOR_WHITE}</option>
<option style="color:black; background-color: {T_TD_COLOR1}" value="black" class="genmed">{L_COLOR_BLACK}</option>
</select>&nbsp;&nbsp; <select name="fs" onChange="BBCfs()" onMouseOver="helpline('fs')" 
<option value="7" class="genmed" dir="ltr">
<option selected>{L_FONT_SIZE}</option>
{L_FONT_TINY}</option>
<option value="9" class="genmed">{L_FONT_SMALL}</option>
<option value="12" class="genmed">{L_FONT_NORMAL}</option>
<option value="18" class="genmed">{L_FONT_LARGE}</option>
<option  value="24" class="genmed">{L_FONT_HUGE}</option>
</select> <span lang="ar-sy">&nbsp;</span><select name="ft" onChange="BBCft()" onMouseOver="helpline('ft')" 
<option style="color:black; background-color: #FFFFFF " value="{L_ARIAL}" class="genmed" dir="ltr">
<option selected>{L_FONT_TYPE}</option>
<option value="Arial">Default font</option>
<option style="color:black; background-color: #FFFFFF " value="Andalus" class="genmed">Andalus</option> 
<option style="color:black; background-color: #FFFFFF " value="Arial" class="genmed">Arial</option> 
<option style="color:black; background-color: #FFFFFF " value="Comic Sans MS" class="genmed">Comic Sans MS</option> 
<option style="color:black; background-color: #FFFFFF " value="Courier New" class="genmed">Courier New</option> 
<option value="Lucida Console">Lucida Console</option>
<option style="color:black; background-color: #FFFFFF " value="Microsoft Sans Serif" class="genmed">Microsoft Sans Serif</option> 
<option style="color:black; background-color: #FFFFFF " value="Symbol" class="genmed">Symbol</option> 
<option style="color:black; background-color: #FFFFFF " value="Tahoma" class="genmed">Tahoma</option> 
<option style="color:black; background-color: #FFFFFF " value="Times New Roman" class="genmed">Times New Roman</option> 
<option style="color:black; background-color: #FFFFFF " value="Traditional Arabic" class="genmed">Traditional Arabic</option> 
<option style="color:black; background-color: #FFFFFF " value="Verdana" class="genmed">Verdana</option> 
<option style="color:black; background-color: #FFFFFF " value="Webdings" class="genmed">Webdings</option> 
<option style="color:black; background-color: #FFFFFF " value="Wingdings" class="genmed">Wingdings</option> 
</select></span></span></span><p style="margin-top: 0; margin-bottom: 0">
<span class="genmed"><span style="font-size: 5pt">&nbsp;</span></span></td>
</tr>
<span class="gen"> 
<tr> 
<td width="450"> 
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr> 
<td> 
<table width="100%" border="0" cellspacing="0" cellpadding="0"> 
<tr> 
<td>
<p dir="ltr" align="left"><span class="gen">  
<span class="genmed"> 
<img border="1" src="bbcode_box/images/justify.gif" width="24" height="20" name="justify" type="image" onClick="BBCjustify()" onMouseOver="helpline('justify')" style="border-style: outset; border-width: 1" alt="justify"><img border="0" src="bbcode_box/images/right.gif" width="24" height="20" name="right" type="image" onClick="BBCright()" onMouseOver="helpline('right')" style="border-style: outset; border-width: 1" alt="right"><img border="0" src="bbcode_box/images/center.gif" width="24" height="20" name="center" type="image" onClick="BBCcenter()" onMouseOver="helpline('center')" style="border-style: outset; border-width: 1" alt="center"><img border="0" src="bbcode_box/images/left.gif" width="24" height="20" name="left" type="image" onClick="BBCleft()" onMouseOver="helpline('left')" style="border-style: outset; border-width: 1" alt="left">&nbsp;&nbsp; 
<img border="1" src="bbcode_box/images/bold.gif" width="24" height="20" name="bold" type="image" onClick="BBCbold()" onMouseOver="helpline('b')" style="border-style: outset; border-width: 1" alt="bold"><img border="0" src="bbcode_box/images/italic.gif" width="24" height="20" name="italic" type="image" onClick="BBCitalic()" onMouseOver="helpline('i')" style="border-style: outset; border-width: 1" alt="italic"><img border="0" src="bbcode_box/images/under.gif" width="24" height="20" name="under" type="image" onClick="BBCunder()" onMouseOver="helpline('u')" style="border-style: outset; border-width: 1" alt="under line"><img border="0" src="bbcode_box/images/strike.gif" width="24" height="20" name="strik" type="image" onClick="BBCstrik()" onMouseOver="helpline('s')" style="border-style: outset; border-width: 1" alt="strike through">&nbsp;&nbsp; 
<img border="1" src="bbcode_box/images/fade.gif" width="24" height="20" name="fade" type="image" onClick="BBCfade()" onMouseOver="helpline('fade')" style="border-style: outset; border-width: 1" alt="fade"><img border="0" src="bbcode_box/images/grad.gif" width="24" height="20" name="grad" type="image" onClick="BBCgrad()" onMouseOver="helpline('grad')" style="border-style: outset; border-width: 1" alt="gradient"><img border="0" src="bbcode_box/images/glow.gif" width="24" height="20" name="glow" type="image" onClick="BBCglow()" onMouseOver="helpline('glow')" style="border-style: outset; border-width: 1" alt="glow"><img border="0" src="bbcode_box/images/shadow.gif" width="24" height="20" name="shadow" type="image" onClick="BBCshadow()" onMouseOver="helpline('shadow')" style="border-style: outset; border-width: 1" alt="shadow"><img border="0" src="bbcode_box/images/highl.gif" width="24" height="20" name="highlight" type="image" onClick="BBChighlight()" onMouseOver="helpline('highlight')" style="border-style: outset; border-width: 1" alt="highlight">&nbsp;&nbsp; 
<img border="1" src="bbcode_box/images/marqd.gif" width="24" height="20" name="marqd" type="image" onClick="BBCmarqd()" onMouseOver="helpline('marqd')" style="border-style: outset; border-width: 1" alt="Marque to down"><img border="0" src="bbcode_box/images/marqu.gif" width="24" height="20" name="marqu" type="image" onClick="BBCmarqu()" onMouseOver="helpline('marqu')" style="border-style: outset; border-width: 1" alt="Marque to up"><img border="0" src="bbcode_box/images/marql.gif" width="24" height="20" name="marql" type="image" onClick="BBCmarql()" onMouseOver="helpline('marql')" style="border-style: outset; border-width: 1" alt="Marque to left"><img border="0" src="bbcode_box/images/marqr.gif" width="24" height="20" name="marqr" type="image" onClick="BBCmarqr()" onMouseOver="helpline('marqr')" style="border-style: outset; border-width: 1" alt="Marque to right"></span></span>
</p>
</td> 
</tr> 
<tr> 
<td>
<p align="left" style="margin-top: 0; margin-bottom: 0">
<span style="font-size: 5pt">&nbsp;</span></p><p align="left" dir="ltr" style="margin-top: 0; margin-bottom: 0"><span class="gen"> 
<span class="genmed"> 
<img border="0" src="bbcode_box/images/code.gif" width="24" height="20" name="code" type="image" onClick="BBCcode()" onMouseOver="helpline('code')" style="border-style: outset; border-width: 1" alt="Code"><img border="0" src="bbcode_box/images/phpcode.gif" width="24" height="20" name="php" type="image" onClick="BBCphp()" onMouseOver="helpline('php')" style="border-style: outset; border-width: 1" alt="PHP"><img border="0" src="bbcode_box/images/quote.gif" width="24" height="20" name="quote" type="image" onClick="BBCquote()" onMouseOver="helpline('quote')" style="border-style: outset; border-width: 1" alt="Quote">&nbsp;&nbsp; 
<img border="0" src="bbcode_box/images/url.gif" width="24" height="20" name="url" type="image" onClick="BBCurl()" onMouseOver="helpline('url')" style="border-style: outset; border-width: 1" alt="URL"><img border="0" src="bbcode_box/images/email.gif" width="24" height="20" name="email" type="image" onClick="BBCmail()" onMouseOver="helpline('mail')" style="border-style: outset; border-width: 1" alt="Email">&nbsp;&nbsp; 
<img border="0" src="bbcode_box/images/img.gif" width="24" height="20" name="img" type="image" onClick="BBCimg()" onMouseOver="helpline('img')" style="border-style: outset; border-width: 1" alt="Image"><img border="0" src="bbcode_box/images/imgl.gif" width="24" height="20" name="imgl" type="image" onClick="BBCimgl()" onMouseOver="helpline('imgl')" style="border-style: outset; border-width: 1" alt="Imagel"><img border="0" src="bbcode_box/images/imgr.gif" width="24" height="20" name="imgr" type="image" onClick="BBCimgr()" onMouseOver="helpline('imgr')" style="border-style: outset; border-width: 1" alt="Imager">&nbsp;&nbsp;<img border="0" src="bbcode_box/images/flash.gif" width="24" height="20" name="flash" type="image" onClick="BBCflash()" onMouseOver="helpline('flash')" style="border-style: outset; border-width: 1" alt="Flash"><img border="0" src="bbcode_box/images/video.gif" width="24" height="20" name="video" type="image" onClick="BBCvideo()" onMouseOver="helpline('video')" style="border-style: outset; border-width: 1" alt="Video"><img border="0" src="bbcode_box/images/sound.gif" width="24" height="20" name="stream" type="image" onClick="BBCstream()" onMouseOver="helpline('stream')" style="border-style: outset; border-width: 1" alt="Stream"><img border="0" src="bbcode_box/images/ram.gif" width="24" height="20" name="ram" type="image" onClick="BBCram()" onMouseOver="helpline('ram')" style="border-style: outset; border-width: 1" alt="Real Media">&nbsp;&nbsp; 
<img border="0" src="bbcode_box/images/smile.gif" width="24" height="20" name="smile" type="image" onclick="window.open('smilie_creator.php?mode=text2schild', '_phpbbcreatesmilies', 'HEIGHT=375,resizable=yes,scrollbars=yes,WIDTH=450');return false;" target="_phpbbcreatesmilies" onMouseOver="helpline('smile')" style="border-style: outset; border-width: 1" alt="Smilie Creator"><img border="0" src="bbcode_box/images/google.gif" width="24" height="20" name="google" type="image" onClick="BBCgoogle()" onMouseOver="helpline('google')" style="border-style: outset; border-width: 1" alt="Google"><img border="0" src="bbcode_box/images/hr.gif" width="24" height="20" name="hr" type="image" onClick="BBChr()" onMouseOver="helpline('hr')" style="border-style: outset; border-width: 1" alt="H-Line">&nbsp;&nbsp;<img border="0" src="bbcode_box/images/plain.gif" width="24" height="20" name="plain" type="image" onClick="BBCplain()" onMouseOver="helpline('plain')" style="border-style: outset; border-width: 1" alt="Remove BBcode"></span></td> 
</tr> 
</table> 
</td> 
</tr> 
</table>
</td>
</tr>
<tr>
<td colspan="9">
<input type="text" name="helpbox" size="45" maxlength="100" style="width:450px; font-size:10px" class="helpline" value="{L_STYLES_TIP}" />
</td>
</tr>
<tr>
<td colspan="9">
<textarea name="message" rows="15" cols="35" style="width:450px" tabindex="3" class="post" onselect="storeCaret(this);" onclick="storeCaret(this);" onkeyup="storeCaret(this);">{MESSAGE}</textarea>
</td>
</tr>
</table>
</td>
</tr>
<tr>
<td class="row1" valign="top"><span class="explaintitle">{L_OPTIONS}:</span><br />
<span class="gensmall">{HTML_STATUS}<br />
{BBCODE_STATUS}<br />
{SMILIES_STATUS}</span></td>
<td class="row2"> 
<table cellspacing="0" cellpadding="1" border="0">
<!-- BEGIN switch_html_checkbox -->
<tr>
<td>
<input type="checkbox" name="disable_html" {S_HTML_CHECKED} />
</td>
<td class="gensmall">{L_DISABLE_HTML}</td>
</tr>
<!-- END switch_html_checkbox -->
<!-- BEGIN switch_bbcode_checkbox -->
<tr>
<td>
<input type="checkbox" name="disable_bbcode" {S_BBCODE_CHECKED} />
</td>
<td class="gensmall">{L_DISABLE_BBCODE}</td>
</tr>
<!-- END switch_bbcode_checkbox -->
<!-- BEGIN switch_smilies_checkbox -->
<tr>
<td>
<input type="checkbox" name="disable_smilies" {S_SMILIES_CHECKED} />
</td>
<td class="gensmall">{L_DISABLE_SMILIES}</td>
</tr>
<!-- END switch_smilies_checkbox -->
<!-- BEGIN switch_signature_checkbox -->
<tr>
<td>
<input type="checkbox" name="attach_sig" {S_SIGNATURE_CHECKED} />
</td>
<td class="gensmall">{L_ATTACH_SIGNATURE}</td>
</tr>
<!-- END switch_signature_checkbox -->
<!-- BEGIN switch_bookmark_checkbox -->
<tr> 
<td> 
<input type="checkbox" name="setbm" {S_SETBM_CHECKED} />
</td>
<td class="gensmall">{L_SET_BOOKMARK}</td>
</tr>
<!-- END switch_bookmark_checkbox -->
<!-- BEGIN switch_notify_checkbox -->
<tr>
<td>
<input type="checkbox" name="notify" {S_NOTIFY_CHECKED} />
</td>
<td class="gensmall">{L_NOTIFY_ON_REPLY}</td>
</tr>
<!-- END switch_notify_checkbox -->
<!-- BEGIN switch_delete_checkbox -->
<tr>
<td>
<input type="checkbox" name="delete" />
</td>
<td class="gensmall">{L_DELETE_POST}</td>
</tr>
<!-- END switch_delete_checkbox -->
<!-- BEGIN switch_type_cal -->
		  <tr><td colspan="2"><hr /></td></tr>
		  <tr>
			<td></td>
			<td valign="top">
				<table cellpadding="2" cellspacing="0" width="100%" border="0">
				<tr>
					<td align="right" nowrap="nowrap"><span class="gen"><b>{L_CALENDAR_TITLE}&nbsp;:</b></span></td>
					<td align="left" width="100%">
						<span class="genmed">
							{S_CALENDAR_DAY}{S_CALENDAR_MONTH}{S_CALENDAR_YEAR}&nbsp;
							<a href="#" name="#" class="genmed" onClick="document.post.topic_calendar_day.value={TODAY_DAY};document.post.topic_calendar_month.value={TODAY_MONTH};document.post.topic_calendar_year.value={TODAY_YEAR};" />{L_TODAY}</a>
						</span>
					</td>
				</tr>
				<tr>
					<td align="right" nowrap="nowrap"><span class="gen"><b>{L_TIME}&nbsp;:</b></span></td>
					<td align="left" width="100%">
						<span class="genmed">
							<input name="topic_calendar_hour" type="post" maxlength="2" size="3" value="{CALENDAR_HOUR}" />&nbsp;{L_HOURS}&nbsp;&nbsp;
							<input name="topic_calendar_min" type="post" maxlength="2" size="3" value="{CALENDAR_MIN}" />&nbsp;{L_MINUTES}
						</span>
					</td>
				</tr>
				<tr><td></td><td><hr /></td></tr>
				<tr>
					<td align="right" nowrap="nowrap"><span class="gen"><b>{L_CALENDAR_DURATION}&nbsp;:</b></span></td>
					<td align="left" width="100%">
						<span class="genmed">
							<input name="topic_calendar_duration_day" type="post" maxlength="5" size="3" value="{CALENDAR_DURATION_DAY}" />&nbsp;{L_DAYS}&nbsp;&nbsp;
							<input name="topic_calendar_duration_hour" type="post" maxlength="5" size="3" value="{CALENDAR_DURATION_HOUR}" />&nbsp;{L_HOURS}&nbsp;&nbsp;
							<input name="topic_calendar_duration_min" type="post" maxlength="5" size="3" value="{CALENDAR_DURATION_MIN}" />&nbsp;{L_MINUTES}
						</span>
					</td>
				</tr>
				</table>
			</td>
		  </tr>
		  <tr><td colspan="2"><hr /></td></tr>
		  <!-- END switch_type_cal -->
<!-- BEGIN switch_type_toggle -->
<tr>
<td></td>
<td><strong>{S_TYPE_TOGGLE}</strong></td>
</tr>
<!-- END switch_type_toggle -->
</table>
</td>
</tr>
{ATTACHBOX}
{POLLBOX} 
<!-- Visual Confirmation -->
<!-- BEGIN switch_confirm -->
<tr>
	<td class="row1" colspan="2" align="center"><span class="gensmall">{L_CONFIRM_CODE_IMPAIRED}</span><br /><br />{CONFIRM_IMG}<br /><br /></td>
</tr>
<tr> 
  <td class="row1"><span class="gen">{L_CONFIRM_CODE}: * </span><br /><span class="gensmall">{L_CONFIRM_CODE_EXPLAIN}</span></td>
  <td class="row2"><input type="text" class="post" style="width: 200px" name="confirm_code" size="6" maxlength="6" value="" /></td>
</tr>
<!-- END switch_confirm -->
<tr>
<td class="cat" colspan="2" align="center" height="28">{S_HIDDEN_FORM_FIELDS}
<input type="submit" tabindex="5" name="preview" {S_EDIT_AJAX}class="mainoption" value="{L_PREVIEW}" />
&nbsp;&nbsp;<input type="submit" accesskey="s" tabindex="6" name="post" class="mainoption" value="{L_SUBMIT}" />
</td>
</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="tbl"><tr><td class="tbll"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblbot"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblr"><img src="images/spacer.gif" alt="" width="8" height="4" /></td></tr></table>
</form>
{TOPIC_REVIEW_BOX} 
<table width="100%" cellspacing="2" cellpadding="2" border="0">
<tr>
<td class="nav"><a href="{U_INDEX}">{L_INDEX}</a> 
<!-- BEGIN switch_not_privmsg -->
{NAV_CAT_DESC}
<!-- END switch_not_privmsg -->
&nbsp;&raquo; {L_POST_A}</td>
</tr>
<tr>
	<td><br />{JUMPBOX}</td>
</tr>
</table>

<!-- BEGIN topics_list_box -->
<!-- BEGIN row -->
<!-- BEGIN header_table -->
<!-- BEGIN multi_selection -->
<script language="Javascript" type="text/javascript">
//
// checkbox selection management
function check_uncheck_main_{topics_list_box.row.header_table.BOX_ID}()
{
	var all_checked = true;
	for (i = 0; (i < document.{topics_list_box.FORMNAME}.elements.length) && all_checked; i++)
	{
		if (document.{topics_list_box.FORMNAME}.elements[i].name == '{topics_list_box.FIELDNAME}[]{topics_list_box.row.header_table.BOX_ID}')
		{
			all_checked =  document.{topics_list_box.FORMNAME}.elements[i].checked;
		}
	}
	document.{topics_list_box.FORMNAME}.all_mark_{topics_list_box.row.header_table.BOX_ID}.checked = all_checked;
}
// check/uncheck all
function check_uncheck_all_{topics_list_box.row.header_table.BOX_ID}()
{
	for (i = 0; i < document.{topics_list_box.FORMNAME}.length; i++)
	{
		if (document.{topics_list_box.FORMNAME}.elements[i].name == '{topics_list_box.FIELDNAME}[]{topics_list_box.row.header_table.BOX_ID}')
		{
			document.{topics_list_box.FORMNAME}.elements[i].checked = document.{topics_list_box.FORMNAME}.all_mark_{topics_list_box.row.header_table.BOX_ID}.checked;
		}
	}
}
</script>
<!-- END multi_selection -->

<table border="0" cellpadding="4" cellspacing="1" width="100%" class="forumline">
<tr> 
	<th colspan="{topics_list_box.row.header_table.COLSPAN}" align="center" nowrap="nowrap">&nbsp;{topics_list_box.row.L_TITLE}&nbsp;</th>
	<th width="50" align="center" nowrap="nowrap">&nbsp;{topics_list_box.row.L_REPLIES}&nbsp;</th>
	<th width="100" align="center" nowrap="nowrap">&nbsp;{topics_list_box.row.L_AUTHOR}&nbsp;</th>
	<th width="50" align="center" nowrap="nowrap">&nbsp;{topics_list_box.row.L_VIEWS}&nbsp;</th>
	<th width="150" align="center" nowrap="nowrap">&nbsp;{topics_list_box.row.L_LASTPOST}&nbsp;</th>
	<!-- BEGIN multi_selection -->
	<th width="20" align="center" nowrap="nowrap"><input type="checkbox" name="all_mark_{topics_list_box.row.header_table.BOX_ID}" value="0" onClick="check_uncheck_all_{topics_list_box.row.header_table.BOX_ID}();" /></th>
	<!-- END multi_selection -->
</tr>
<!-- END header_table -->
<!-- BEGIN header_row -->
<tr>
	<td class="row3" colspan="{topics_list_box.row.COLSPAN}"><span class="gensmall">&nbsp;&nbsp;<b>{topics_list_box.row.L_TITLE}</b></span></td>
</tr>
<!-- END header_row -->
<!-- BEGIN topic -->
<tr> 
	<!-- BEGIN single_selection -->
	<td class="{topics_list_box.row.ROW_CLASS}" align="center" valign="middle" width="20"><input type="radio" name="{topics_list_box.FIELDNAME}" value="{topics_list_box.row.FID}" {topics_list_box.row.L_SELECT} /></td>
	<!-- END single_selection -->
	<td class="{topics_list_box.row.ROW_FOLDER_CLASS}" align="center" valign="middle" width="20">{topics_list_box.row.S_MARK_LINK_START}<img src="{topics_list_box.row.TOPIC_FOLDER_IMG}" id="topicimage_{topics_list_box.row.TOPIC_ID}" alt="{topics_list_box.row.L_TOPIC_FOLDER_ALT}" title="{topics_list_box.row.L_TOPIC_FOLDER_ALT}" border="0" />{topics_list_box.row.S_MARK_LINK_END}</td>
	<!-- BEGIN icon -->
	<td class="{topics_list_box.row.ROW_CLASS}" align="center" valign="middle" width="20">{topics_list_box.row.ICON}</td>
	<!-- END icon -->
	<td {topics_list_box.row.S_AJAX_EDIT_TITLE} class="{topics_list_box.row.ROW_CLASS}" width="100%">
		<span class="topictitle"><span id="topicnewest_{topics_list_box.row.TOPIC_ID}">{topics_list_box.row.NEWEST_POST_IMG}</span>{topics_list_box.row.TOPIC_ATTACHMENT_IMG} {topics_list_box.row.TOPIC_TYPE}<a href="{topics_list_box.row.U_VIEW_TOPIC}" id="topiclink_{topics_list_box.row.TOPIC_FIRST_POST_ID}" class="topictitle">{topics_list_box.row.TOPIC_TITLE}</a>
		<!-- BEGIN can_edit_title -->
	  	<span id="title_{topics_list_box.row.TOPIC_FIRST_POST_ID}" style="display:none;"><input type="text" class="post" name="topictitle_{topics_list_box.row.TOPIC_FIRST_POST_ID}" id="topictitle_{topics_list_box.row.TOPIC_FIRST_POST_ID}" value="{topics_list_box.row.TOPIC_TITLE}" size="40" maxlength="60" onkeyup="AJAXTitleEditKeyUp(event, {topics_list_box.row.TOPIC_FIRST_POST_ID})" /><input type="hidden" id="orig_topictitle_{topics_list_box.row.TOPIC_FIRST_POST_ID}" value="{topics_list_box.row.TOPIC_TITLE}" />&nbsp;<input type="button" onclick="AJAXEndTitleEdit({topics_list_box.row.TOPIC_FIRST_POST_ID})" value="{L_SAVE_CHANGES}" class="mainoption" />&nbsp;<input type="button" onclick="AJAXCancelTitleEdit({topics_list_box.row.TOPIC_FIRST_POST_ID})" value="{L_CANCEL}" class="liteoption" /></span>
	  	<!-- END can_edit_title -->
		</span><span class="gensmall">
		<!-- BEGIN switch_topic_desc -->
             <br /> {L_DESCRIPTION} : {topics_list_box.row.TOPIC_DESCRIPTION}<br />
              <!-- END switch_topic_desc -->
		&nbsp;&nbsp;{topics_list_box.row.TOPIC_ANNOUNCES_DATES}{topics_list_box.row.TOPIC_CALENDAR_DATES}</span>
		<span class="gensmall">
			{topics_list_box.row.GOTO_PAGE}
			<!-- BEGIN nav_tree -->
			{topics_list_box.row.TOPIC_NAV_TREE}
			<!-- END nav_tree -->
		</span>
	</td>
	<td class="row2" align="center" valign="middle"><span class="postdetails">{topics_list_box.row.REPLIES}</span></td>
	<td class="row3" align="center" valign="middle"><span class="name">{topics_list_box.row.TOPIC_AUTHOR}</span></td>
	<td class="row2" align="center" valign="middle"><span class="postdetails">{topics_list_box.row.VIEWS}</span></td>
	<td class="row3" align="center" valign="middle" nowrap="nowrap"><span class="postdetails">{topics_list_box.row.LAST_POST_TIME}<br />{topics_list_box.row.LAST_POST_AUTHOR} {topics_list_box.row.LAST_POST_IMG}</span></td>
	<!-- BEGIN multi_selection -->
	<td class="row2" align="center" valign="middle"><span class="postdetails"><input type="checkbox" name="{topics_list_box.FIELDNAME}[]{topics_list_box.row.BOX_ID}" value="{topics_list_box.row.FID}" onClick="javascript:check_uncheck_main_{topics_list_box.row.BOX_ID}();" {topics_list_box.row.L_SELECT} /></span></td>
	<!-- END multi_selection -->
</tr>
<!-- END topic -->
<!-- BEGIN no_topics -->
<tr> 
	<td class="row1" colspan="{topics_list_box.row.COLSPAN}" height="30" align="center" valign="middle"><span class="gen">{topics_list_box.row.L_NO_TOPICS}</span></td>
</tr>
<!-- END no_topics -->
<!-- BEGIN bottom -->
<tr> 
	<td class="cat" colspan="{topics_list_box.row.COLSPAN}" align="center" valign="middle"><span class="genmed">{topics_list_box.row.FOOTER}</span></td>
</tr>
<!-- END bottom -->
<!-- BEGIN footer_table -->
</table>
<!-- END footer_table -->
<!-- BEGIN spacer -->
<br class="gensmall">
<!-- END spacer -->
<!-- END row -->
<!-- END topics_list_box -->
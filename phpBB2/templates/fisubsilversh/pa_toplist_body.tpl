<!-- INCLUDE pa_header.tpl -->
<table width="100%" cellpadding="2" cellspacing="2">
  <tr>
	<td valign="bottom">
		<span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a> &raquo; <a href="{U_DOWNLOAD}" class="nav">{DOWNLOAD}</a> &raquo; {L_TOPLIST}</span>
	</td>
  </tr>
</table>

<table width="100%" cellpadding="3" cellspacing="1" class="forumline">
  <tr> 
	<th class="thHead" colspan="7">{L_TOPLIST}</th>
  </tr>
	<tr> 
		<td colspan="7" class="row1" align="center"><span class="gen"><b>{L_CURRENT_TOPLIST} - {L_NEW_FILES}</b></span></td>
	</tr>
	<tr>
		<td colspan="7" class="row2" align="center"><span class="genmed"><a href="{U_NEWEST_FILE}" class="genmed">{L_NEWEST_FILE}</a> | <a href="{U_MOST_POPULAR}" class="genmed">{L_MOST_POPULAR}</a> | <a href="{U_TOP_RATED}" class="genmed">{L_TOP_RATED}</a></span></td>
	</tr>
<!-- IF IS_NEWEST -->	
	<tr> 
		<td colspan="7" class="row1" align="center">
			<span class="gen">
				<b>{L_TOTAL_NEW_FILE}:</b> {L_LAST_WEEK} ( {TOTAL_FILE_WEEK} ) | {L_LAST_30_DAYS} ( {TOTAL_FILE_MONTH} )<br />
				<b>{L_SHOW}:</b> <a href="{U_ONE_WEEK}" class="gen">{L_ONE_WEEK}</a> - <a href="{U_TWO_WEEK}" class="gen">{L_TWO_WEEK}</a> - <a href="{U_30_DAYS}" class="gen">{L_30_DAYS}</a>
			</span>
		</td>
	</tr>
	<!-- IF FILE_DATE -->	
	<tr> 
		<td colspan="7" class="row1" align="center">
		<span class="gen">
		<!-- BEGIN files_date -->
		<strong><big>&middot;</big></strong> <a href="{files_date.U_DATES}">{files_date.DATES}</a>&nbsp({files_date.TOTAL_DOWNLOADS})<br />
		<!-- END files_date -->
		</span>
		</td>
	</tr>
	<!-- ENDIF -->
	
<!-- ENDIF -->
<!-- IF IS_POPULAR -->
	<tr> 
		<td colspan="7" class="row1" align="center">
		<span class="genmed">
		<b>{L_SHOW_TOP}:</b> [ <a href="{U_TOP_10}" class="genmed">10</a> - <a href="{U_TOP_25}" class="genmed">25</a> - <a href="{U_TOP_50}" class="genmed">50</a> ]
		<b>{L_OR_TOP}:</b> [ <a href="{U_TOP_PER_1}" class="genmed">1%</a> - <a href="{U_TOP_PER_5}" class="genmed">5%</a> - <a href="{U_TOP_PER_10}" class="genmed">10%</a> ]
		</span>
		</td>
	</tr>

<!-- ENDIF -->

<!-- IF FILE_LIST -->
  <tr> 
	<td width="4%" align="center" class="cat" nowrap="nowrap">&nbsp;</td>
	<td class="cat" align="center" nowrap="nowrap"><span class="cattitle">&nbsp;{L_CATEGORY}&nbsp;</span></td>
	<td class="cat" align="center" nowrap="nowrap"><span class="cattitle">&nbsp;{L_FILE}&nbsp;</span></td>
	<td class="cat" align="center" nowrap="nowrap"><span class="cattitle">&nbsp;{L_SUBMITER}&nbsp;</span></td>
	<td class="cat" align="center" nowrap="nowrap"><span class="cattitle">&nbsp;{L_DATE}&nbsp;</span></td>
	<td class="cat" align="center" nowrap="nowrap"><span class="cattitle">&nbsp;{L_DOWNLOADS}&nbsp;</span></td>
	<td class="cat" align="center" nowrap="nowrap"><span class="cattitle">&nbsp;{L_RATE}&nbsp;</span></td>
  </tr>
		<!-- BEGIN files_row -->
  <tr> 
	<td class="row1" align="center" valign="middle"><a href="{files_row.U_FILE}" class="topictitle">{files_row.PIN_IMAGE}</a></td>
	<td class="row1"><span class="forumlink"><a href="{files_row.U_CAT}" class="forumlink">{files_row.CAT_NAME}</a></span></td>
	<td class="row1" valign="middle"><a href="{files_row.U_FILE}" class="topictitle">{files_row.FILE_NAME}</a>&nbsp;<!-- IF files_row.IS_NEW_FILE --><img src="{files_row.FILE_NEW_IMAGE}" border="0" alt="{L_NEW_FILE}"><!-- ENDIF --><br /><span class="genmed">{files_row.FILE_DESC}</span></td>
	<td class="row1" align="center" valign="middle"><span class="name">{files_row.FILE_SUBMITER}</span></td>
	<td class="row2" align="center" valign="middle"><span class="postdetails">{files_row.DATE}</span></td>
	<td class="row1" align="center" valign="middle"><span class="postdetails">{files_row.DOWNLOADS}</span></td>
	<td class="row2" align="center" valign="middle" nowrap="nowrap"><span class="postdetails">{files_row.RATING}</span></td>
  </tr> 
		<!-- END files_row -->
  <tr> 
	<td colspan="7" class="cat" align="center">&nbsp </td>
  </tr>
<!-- ENDIF -->	
</table>
<table border="0" cellpadding="0" cellspacing="0" class="tbl"><tr><td class="tbll"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblbot"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblr"><img src="images/spacer.gif" alt="" width="8" height="4" /></td></tr></table>
<!-- INCLUDE pa_footer.tpl -->
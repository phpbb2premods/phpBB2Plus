    <table width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline">
        <tr>
		<th>{L_POLL}</th>
	  </tr>
	  <tr> 
		<td class="row1" colspan="2" align="center"><span class="gensmall"><b>{POLL_QUESTION}</b></span></td>
	  </tr>
	  <tr> 
		<td class="row1" colspan="2" align="center"> 
		  <table width="100%" cellspacing="2" cellpadding="2" border="0">
			<!-- BEGIN poll_option -->
			<tr> 
			  <td class="row1"><span class="gensmall">{poll_option.POLL_OPTION_CAPTION}</span></td>
			  <td class="row1"><span class="gensmall">[ {poll_option.POLL_OPTION_RESULT} ]</span></td>
			<tr> 
			  <td class="row1"><img src="templates/fisubsilversh/images/vote_lcap.gif" width="4" alt="" height="12" /><img src="{poll_option.POLL_OPTION_IMG}" width="{poll_option.POLL_OPTION_IMG_WIDTH}" height="12" alt="{poll_option.POLL_OPTION_PERCENT}" /><img src="templates/fisubsilversh/images/vote_rcap.gif" width="4" alt="" height="12" /></td>
			  <td class="row1"><b><span class="gensmall">&nbsp;{poll_option.POLL_OPTION_PERCENT}&nbsp;</span></b>&nbsp;</td>
			</tr>
			<!-- END poll_option -->
		  </table>
		</td>
	  </tr>
	  <tr> 
		<td class="row1" colspan="2" align="center"><span class="gensmall"><b>{L_TOTAL_VOTES} : {TOTAL_VOTES}</b></span></td>
	  </tr>
     	  <tr> 
        	<td class="row1" align="center">[ <span class="gensmall"><a href="{U_VIEW_RESULTS}" class="gensmall"><b>{L_VIEW_RESULTS}</b></a> ]</span></td> 
     	  </tr>
	</table>
	<table border="0" cellpadding="0" cellspacing="0" class="tbl"><tr><td class="tbll"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblbot"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblr"><img src="images/spacer.gif" alt="" width="8" height="4" /></td></tr></table>
<br />

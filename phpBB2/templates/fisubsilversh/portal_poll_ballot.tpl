    <table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
        <tr>
		<th>{L_POLL}</th>
	  </tr>
			<tr>
				<td class="row1" colspan="2"><br clear="all" /><form method="POST" action="{S_POLL_ACTION}"><table cellspacing="0" cellpadding="4" border="0" align="center">
					<tr>
						<td class="row1" align="center"><span class="gensmall">{POLL_QUESTION}</span></td>
					</tr>
					<tr>
						<td align="center"><table cellspacing="0" cellpadding="2" border="0">
							<!-- BEGIN poll_option -->
							<tr>
								<td><input type="radio" name="vote_id" value="{poll_option.POLL_OPTION_ID}" />&nbsp;</td>
								<td><span class="gensmall">{poll_option.POLL_OPTION_CAPTION}</span></td>
							</tr>
							<!-- END poll_option -->
						</table></td>
					</tr>
					<tr>
						<td  class="row1" align="center">
						 <!-- BEGIN switch_user_logged_in -->
						 {L_SUBMIT_VOTE}
						 <!-- END switch_user_logged_in -->		
						 <!-- BEGIN switch_user_logged_out -->
						 <span class="gensmall">{LOGIN_TO_VOTE}<span>
						 <!-- END switch_user_logged_out -->
		  				</td>
					</tr>
				</table>{S_HIDDEN_FIELDS}</form></td>
			</tr>
	</table>
	<table border="0" cellpadding="0" cellspacing="0" class="tbl"><tr><td class="tbll"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblbot"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblr"><img src="images/spacer.gif" alt="" width="8" height="4" /></td></tr></table>
<br />
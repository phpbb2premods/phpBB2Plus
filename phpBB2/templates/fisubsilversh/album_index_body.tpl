<table width="100%" cellspacing="0" cellpadding="2" border="0">
  <tr>
	<td><span class="gensmall">
	<!-- BEGIN switch_user_logged_in -->
	{LAST_VISIT_DATE}<br />
	<!-- END switch_user_logged_in -->
	{CURRENT_TIME}<br />
	</span><span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a>&nbsp;&raquo;&nbsp;<a href="{U_ALBUM}" class="nav">{L_ALBUM}</a></span></td>

    <td align="right">
  		<form action="album_search.php">
			<span class="gensmall">{L_SEARCH_FOR}: &nbsp;&nbsp;
			<select name="mode">
				<option value="user">{L_USERNAME}</option>
				<option value="name">{L_NAME}</option>
				<option value="desc">{L_DESCRIPTION}</option>
			</select>
			&nbsp;&nbsp;{L_THAT_CONTAINS}:&nbsp;&nbsp; <input type="text" name="search" maxlength="20">&nbsp;&nbsp;<input type="submit" value="Go"></span>
		</form>
  </td>
 </tr>
</table>

<!-- Album Category Hierarchy : begin -->
{ALBUM_BOARD_INDEX}    

<table width="100%" cellspacing="2" cellpadding="1" border="0">
  <tr>
	<td align="right"><span class="gensmall">{S_TIMEZONE}</span></td>
  </tr>
</table>

<!-- BEGIN personal_picrow -->
  <table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">  
  <tr>
  <!-- BEGIN piccol -->
	<td align="center" width="{S_COL_WIDTH}" class="row1"><span class="genmed"><a href="{personal_picrow.piccol.U_PIC}" {TARGET_BLANK}><img src="{personal_picrow.piccol.THUMBNAIL}" border="0" alt="{personal_picrow.piccol.DESC}" title="{personal_picrow.piccol.DESC}" vspace="10" /></a></span></td>
  <!-- END piccol -->
  </tr>
  <tr>
  <!-- BEGIN pic_detail -->
	<td class="row2"><span class="gensmall">
	{L_PIC_TITLE}: {personal_picrow.pic_detail.TITLE}<br />
	{L_POSTED}: {personal_picrow.pic_detail.TIME}<br />
	{L_VIEW}: {personal_picrowow.pic_detail.VIEW}<br />
	{personal_picrow.pic_detail.RATING}
	{personal_picrow.pic_detail.COMMENTS}
	{personal_picrowcrow.pic_detail.IP}
	{personal_picrow.pic_detail.EDIT}  {personal_picrow.pic_detail.DELETE}  {personal_picrow.pic_detail.LOCK}</span>
	</td>
  <!-- END pic_detail -->
  </tr>
  </table>  
<!-- END personal_picrow -->
<!-- BEGIN recent_pics_block -->
<table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
  <tr>
	<th class="thTop" height="25" colspan="{S_COLS}" nowrap="nowrap">{L_RECENT_PUBLIC_PICS}</th>
  </tr>
  <!-- BEGIN no_pics -->
  <tr>
	<td class="row1" align="center" colspan="{S_COLS}" height="50"><span class="gen">{L_NO_PICS}</span></td>
  </tr>
  <!-- END no_pics -->
  <!-- BEGIN recent_pics -->
  <tr>
  <!-- BEGIN recent_col -->
	<td class="row1" width="{S_COL_WIDTH}" align="center"><a href="{recent_pics_block.recent_pics.recent_col.U_PIC}" {TARGET_BLANK}><img src="{recent_pics_block.recent_pics.recent_col.THUMBNAIL}" border="0" alt="{recent_pics_block.recent_pics.recent_col.DESC}" title="{recent_pics_block.recent_pics.recent_col.DESC}" vspace="10" /></a></td>
  <!-- END recent_col -->
  </tr>
  <tr>
  <!-- BEGIN recent_detail -->
    <td class="row2"><span class="gensmall">{L_PIC_TITLE}: {recent_pics_block.recent_pics.recent_detail.TITLE}<br />
  	{L_POSTER}: {recent_pics_block.recent_pics.recent_detail.POSTER}<br />{L_POSTED}: {recent_pics_block.recent_pics.recent_detail.TIME}<br />
  	{L_VIEW}: {recent_pics_block.recent_pics.recent_detail.VIEW}<br />{recent_pics_block.recent_pics.recent_detail.RATING}{recent_pics_block.recent_pics.recent_detail.IP}</span>
	</td>
  <!-- END recent_detail -->
  </tr>
  <!-- END recent_pics -->
</table>
<table border="0" cellpadding="0" cellspacing="0" class="tbl"><tr><td class="tbll"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblbot"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblr"><img src="images/spacer.gif" alt="" width="8" height="4" /></td></tr></table>
<p />
<!-- END recent_pics_block -->

<!-- BEGIN highest_pics_block -->
<table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline"> 
  <tr> 
   <th height="25" colspan="{S_COLS}" nowrap="nowrap">{L_HIGHEST_RATED_PICS}</th> 
  </tr> 
  <!-- BEGIN no_pics --> 
  <tr> 
   <td class="row1" align="center" colspan="{S_COLS}" height="50"><span class="gen">{L_NO_PICS}</span></td> 
  </tr> 
  <!-- END no_pics --> 
  <!-- BEGIN highest_pics --> 
  <tr> 
  <!-- BEGIN highest_col --> 
   <td class="row1" width="{S_COL_WIDTH}" align="center"><a href="{highest_pics_block.highest_pics.highest_col.U_PIC}" {TARGET_BLANK}><img src="{highest_pics_block.highest_pics.highest_col.THUMBNAIL}" border="0" alt="{highest_pics_block.highest_pics.highest_col.DESC}" title="{highest_pics_block.highest_pics.highest_col.DESC}" vspace="10" /></a></td> 
  <!-- END highest_col --> 
  </tr> 
  <tr> 
  <!-- BEGIN highest_detail --> 
    <td class="row2"><span class="gensmall">{L_PIC_TITLE}: {highest_pics_block.highest_pics.highest_detail.H_TITLE}<br /> 
     {L_POSTER}: {highest_pics_block.highest_pics.highest_detail.H_POSTER}<br />{L_POSTED}: {highest_pics_block.highest_pics.highest_detail.H_TIME}<br /> 
     {L_VIEW}: {highest_pics_block.highest_pics.highest_detail.H_VIEW}<br />{highest_pics_block.highest_pics.highest_detail.H_RATING}{highest_pics_block.highest_pics.highest_detail.H_IP}</span> 
   </td> 
  <!-- END highest_detail --> 
  </tr> 
  <!-- END highest_pics --> 
</table> 
<table border="0" cellpadding="0" cellspacing="0" class="tbl"><tr><td class="tbll"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblbot"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblr"><img src="images/spacer.gif" alt="" width="8" height="4" /></td></tr></table>
<p />
<!-- END highest_pics_block -->


<!-- BEGIN random_pics_block -->
<table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
  <tr>
	<th class="thTop" height="25" colspan="{S_COLS}" nowrap="nowrap">{L_RANDOM_PICS}</th>
  </tr>
  <!-- BEGIN no_pics -->
  <tr>
	<td class="row1" align="center" colspan="{S_COLS}" height="50"><span class="gen">{L_NO_PICS}</span></td>
  </tr>
  <!-- END no_pics -->
  <!-- BEGIN rand_pics -->
  <tr>
  <!-- BEGIN rand_col -->
	<td class="row1" width="{S_COL_WIDTH}" align="center"><a href="{random_pics_block.rand_pics.rand_col.U_PIC}" {TARGET_BLANK}><img src="{random_pics_block.rand_pics.rand_col.THUMBNAIL}" border="0" alt="{random_pics_block.rand_pics.rand_col.DESC}" title="{random_pics_block.rand_pics.rand_col.DESC}" vspace="10" /></a></td>
  <!-- END rand_col -->
  </tr>
  <tr>
  <!-- BEGIN rand_detail -->
    <td class="row2"><span class="gensmall">{L_PIC_TITLE}: {random_pics_block.rand_pics.rand_detail.TITLE}<br />
  	{L_POSTER}: {random_pics_block.rand_pics.rand_detail.POSTER}<br />{L_POSTED}: {random_pics_block.rand_pics.rand_detail.TIME}<br />
  	{L_VIEW}: {random_pics_block.rand_pics.rand_detail.VIEW}<br />{random_pics_block.rand_pics.rand_detail.RATING}{random_pics_block.rand_pics.rand_detail.IP}</span>
	</td>
  <!-- END rand_detail -->
  </tr>
  <!-- END rand_pics -->
</table>
<table border="0" cellpadding="0" cellspacing="0" class="tbl"><tr><td class="tbll"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblbot"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblr"><img src="images/spacer.gif" alt="" width="8" height="4" /></td></tr></table>
<!-- END random_pics_block -->
<!-- Album Category Hierarchy : end -->	
	

<!-- BEGIN switch_user_logged_out -->
<form method="post" action="{S_LOGIN_ACTION}">
  <table width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline">
	<tr>
	  <td class="catHead" height="28"><a name="login"></a><span class="cattitle">{L_LOGIN_LOGOUT}</span></td>
	</tr>
	<tr>
	  <td class="row1" align="center" height="28"><span class="gensmall">{L_USERNAME}:
		<input class="post" type="text" name="username" size="10" />
		&nbsp;&nbsp;&nbsp;{L_PASSWORD}:
		<input class="post" type="password" name="password" size="10" />
		&nbsp;&nbsp; &nbsp;&nbsp;{L_AUTO_LOGIN}
		<input class="text" type="checkbox" name="autologin" />
		&nbsp;&nbsp;&nbsp;
		<input type="submit" class="mainoption" name="login" value="{L_LOGIN}" />
		<input type="hidden" name="redirect" value="{U_ALBUM}" />
		</span> </td>
	</tr>
  </table>
</form>
<!-- END switch_user_logged_out -->

<br clear="all" />

<!--
You must keep my copyright notice visible with its original content
-->
<div align="center" style="font-family: Verdana; font-size: 10px; letter-spacing: -1px">Powered by Photo Album Addon {ALBUM_VERSION} &copy; 2002-2003 <a href="http://smartor.is-root.com" target="_blank">Smartor</a> with Volodymyr (CLowN) Skoryk's SP1 addon & IdleVoid's Album Category Hierarchy mod!</div>

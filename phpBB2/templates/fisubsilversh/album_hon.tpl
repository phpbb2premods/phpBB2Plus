<form action="album_hotornot.php">
<input type="hidden" name="pic_id" value="{PICTURE_ID}" />
<table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
  <!-- BEGIN hon_rating -->
  <tr>
	<td align="center" class="row2"><span class="genmed">Rate me:&nbsp;&nbsp;&nbsp;
	
			<!-- BEGIN hon_row -->
			<INPUT type="radio" name="hon_rating" value="{hon_rating.hon_row.VALUE}" onclick="this.form.submit()">&nbsp;{hon_rating.hon_row.VALUE}&nbsp;&nbsp;
			<!-- END hon_row -->
			</span>
		
    </td>
  </tr>
  <!-- END hon_rating -->

  <!-- BEGIN hon_rating_cant -->
  <tr>
	<td align="center" class="row2"><span class="genmed">You are not allowed to rate this image again.</td>
  </tr>
  <!-- END hon_rating_cant -->
</table>
</form>

<table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
  <tr>
	<th class="thTop" width="10%">{PIC_TITLE}</th>
  </tr>
  <tr>
	<td class="row1" align="center"><img src="{U_PIC}" border="0" vspace="10" alt="{PIC_TITLE}" title="{PIC_TITLE}" /></td>
  </tr>
  <tr>
	<td class="row2"><table width="90%" align="center" border="0" cellpadding="3" cellspacing="2">
	  <tr>
		<td width="25%" align="right"><span class="genmed">{L_POSTER}:</span></td>
		<td><span class="genmed"><b>{POSTER}</b></span></td>
	  </tr>
	  <tr>
		<td valign="top" align="right"><span class="genmed">{L_PIC_TITLE}:</span></td>
		<td valign="top"><b><span class="genmed">{PIC_TITLE}</span></b></td>
	  </tr>
	  <tr>
		<td valign="top" align="right"><span class="genmed">{L_PIC_DESC}:</span></td>
		<td valign="top"><b><span class="genmed">{PIC_DESC}</span></b></td>
	  </tr>
	  <tr>
		<td align="right"><span class="genmed">{L_POSTED}:</span></td>
		<td><b><span class="genmed">{PIC_TIME}</span></b></td>
	  </tr>
	  <tr>
		<td align="right"><span class="genmed">{L_VIEW}:</span></td>
		<td><b><span class="genmed">{PIC_VIEW}</span></b></td>
	  </tr>
	  <!-- BEGIN rate_switch -->
	  <tr>
		<td valign="top" align="right"><span class="genmed">{L_RATING}:</span></td>
		<td><b><span class="genmed">{PIC_RATING}</span></b></td>
	  </tr>
	  <!-- END rate_switch -->
	  <!-- BEGIN comment_switch -->
	  <tr>
		<td align="right"><span class="genmed"><a href="{U_COMMENT}">{L_COMMENTS}:</a></span></td>
		<td><b><span class="genmed">{PIC_COMMENTS}</span></b></td>
	  </tr>
	  <!-- END comment_switch -->
	</table></td>
  </tr>
</table>

<br />

<!--
You must keep my copyright notice visible with its original content
-->
<div align="center" style="font-family: Verdana; font-size: 10px; letter-spacing: -1px">Powered by Photo Album Addon {ALBUM_VERSION} &copy; 2002-2003 <a href="http://smartor.is-root.com" target="_blank">Smartor</a> with Volodymyr (CLowN) Skoryk's SP1 addon</div>

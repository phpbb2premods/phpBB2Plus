<table width="100%" cellspacing="2" cellpadding="2" border="0">
  <tr>
	<td><a class="maintitle" href="{U_VIEW_CAT}">{CAT_TITLE}</a><br />
		<span class="gensmall"><b>{L_MODERATORS}: {MODERATORS}</b></span>
		<!-- Album Category Hierarchy : begin -->
		<!-- BEGIN personal_gallery_header -->
		<br><span class="genmed">{L_PERSONAL_GALLERY_EXPLAIN}</span>
		<!-- END personal_gallery_header -->
		<!-- Album Category Hierarchy : end -->
	</td>

   
   <td align="right">
  		<form name="search" action="album_search.php">
			<span class="gensmall">{L_SEARCH_FOR}: &nbsp;&nbsp;
			<select name="mode">
				<option value="user">{L_USERNAME}</option>
				<option value="name">{L_NAME}</option>
				<option value="desc">{L_DESCRIPTION}</option>
			</select>
			&nbsp;&nbsp;{L_THAT_CONTAINS}:&nbsp;&nbsp; <input type="text" name="search" maxlength="20">&nbsp;&nbsp;<input type="submit" value="Go"></span>
		</form>
		
		<span class="nav">{PAGINATION}</span>
  </td>
 </tr>
</table>

<table width="100%" cellspacing="2" cellpadding="2" border="0">
  <tr>
<!-- Album Category Hierarchy : begin -->  
	<!-- BEGIN enable_picture_upload -->
	<td><a href="{U_UPLOAD_PIC}"><img src="{UPLOAD_PIC_IMG}" border="0" alt="{L_UPLOAD_PIC}" title="{L_UPLOAD_PIC}" /></a></td>
	<!-- END enable_picture_upload -->
	<!-- BEGIN enable_view_toggle -->
	<td><a href="{U_TOGGLE_VIEW_ALL}"><img src="{TOGGLE_VIEW_ALL_IMG}" border="0" alt="{L_TOGGLE_VIEW_ALL}" title="{L_TOGGLE_VIEW_ALL}" /></a></td>
	<!-- END enable_view_toggle -->	
	<td class="nav" width="100%"><span class="nav">&nbsp;&nbsp;&nbsp;<a href="{U_INDEX}" class="nav">{L_INDEX}</a> {ALBUM_NAVIGATION_ARROW} <a href="{U_ALBUM}" class="nav">{L_ALBUM}</a>{NAV_CAT_DESC}</span></td>
<!-- Album Category Hierarchy : end -->
  </tr>
</table>
<!-- Album Category Hierarchy : begin -->
{ALBUM_BOARD_INDEX}    
<!-- Album Category Hierarchy : end -->
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
<p />
<!-- END recent_pics_block -->
<!-- BEGIN index_pics_block -->
<table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
  <tr>
	<th class="thTop" height="25" align="center" colspan="{S_COLS}" nowrap="nowrap">{L_CATEGORY}
  <!-- BEGIN enable_gallery_title -->
	 :: {CAT_TITLE}
  <!-- END enable_gallery_title --></th>
  </tr>
  <!-- BEGIN no_pics -->
  <tr>
	<td class="row5" align="center" height="50"><span class="gen">{L_NO_PICS}</span></td>
  </tr>
  <!-- END no_pics -->
  <!-- BEGIN picrow -->
  <tr>
  <!-- BEGIN piccol -->
	<td align="center" width="{S_COL_WIDTH}" class="row1"><span class="genmed"><a href="{index_pics_block.picrow.piccol.U_PIC}" {TARGET_BLANK}><img src="{index_pics_block.picrow.piccol.THUMBNAIL}" border="0" alt="{index_pics_block.picrow.piccol.DESC}" title="{index_pics_block.picrow.piccol.DESC}" vspace="10" /></a><br />{index_pics_block.picrow.piccol.APPROVAL}</span></td>
  <!-- END piccol -->
  </tr>
  <tr>
  <!-- BEGIN pic_detail -->
	<td class="row2"><span class="gensmall">
	{L_PIC_TITLE}: {index_pics_block.picrow.pic_detail.TITLE}<br />
    <!-- BEGIN cats -->
    {L_PIC_CAT}: <a href="{index_pics_block.picrow.pic_detail.cats.U_PIC_CAT}" {TARGET_BLANK}>{index_pics_block.picrow.pic_detail.cats.CATEGORY}</a><br />
    <!-- END cats -->
	{L_POSTER}: {index_pics_block.picrow.pic_detail.POSTER}<br />
	{L_POSTED}: {index_pics_block.picrow.pic_detail.TIME}<br />
	{L_VIEW}: {index_pics_block.picrow.pic_detail.VIEW}<br />
	{index_pics_block.picrow.pic_detail.RATING}
	{index_pics_block.picrow.pic_detail.COMMENTS}
	{index_pics_block.picrow.pic_detail.IP}
	{index_pics_block.picrow.pic_detail.EDIT}  {index_pics_block.picrow.pic_detail.DELETE}  {index_pics_block.picrow.pic_detail.LOCK}  {index_pics_block.picrow.pic_detail.MOVE}</span>
	</td>
  <!-- END pic_detail -->
  </tr>
  <!-- END picrow -->
  <tr>
	<td class="cat" colspan="{S_COLS}" align="center" height="28">
		<form action="{S_ALBUM_ACTION}" method="post">
		<span class="gensmall">{L_SELECT_SORT_METHOD}:
		<select name="sort_method">
			<option {SORT_TIME} value='pic_time'>{L_TIME}</option>
			<option {SORT_PIC_TITLE} value='pic_title'>{L_PIC_TITLE}</option>
			{SORT_USERNAME_OPTION}
			<option {SORT_VIEW} value='pic_view_count'>{L_VIEW}</option>
			{SORT_RATING_OPTION}
			{SORT_COMMENTS_OPTION}
			{SORT_NEW_COMMENT_OPTION}
		</select>
		&nbsp;{L_ORDER}:
		<select name="sort_order">
			<option {SORT_ASC} value='ASC'>{L_ASC}</option>
			<option {SORT_DESC} value='DESC'>{L_DESC}</option>
		</select>
		&nbsp;<input type="submit" name="submit" value="{L_SORT}" class="liteoption" /></span>
	</td>
  </tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="tbl"><tr><td class="tbll"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblbot"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblr"><img src="images/spacer.gif" alt="" width="8" height="4" /></td></tr></table>
<!-- END index_pics_block -->
<table width="100%" cellspacing="2" border="0" cellpadding="2">
  <tr>
	<!-- Album Category Hierarchy : begin -->
	<!-- BEGIN enable_picture_upload -->  
		<td><a href="{U_UPLOAD_PIC}"><img src="{UPLOAD_PIC_IMG}" border="0" alt="{L_UPLOAD_PIC}" title="{L_UPLOAD_PIC}" /></a></td>
	<!-- END enable_picture_upload -->
	<!-- BEGIN enable_view_toggle -->
	<td><a href="{U_TOGGLE_VIEW_ALL}"><img src="{TOGGLE_VIEW_ALL_IMG}" border="0" alt="{L_TOGGLE_VIEW_ALL}" title="{L_TOGGLE_VIEW_ALL}" /></a></td>
	<!-- END enable_view_toggle -->			
	<td class="nav" width="100%"><span class="nav">&nbsp;&nbsp;&nbsp;<a href="{U_INDEX}" class="nav">{L_INDEX}</a> {ALBUM_NAVIGATION_ARROW} <a href="{U_ALBUM}" class="nav">{L_ALBUM}</a>{NAV_CAT_DESC}</span></td>
<!-- Album Category Hierarchy : end -->
	<td align="right" nowrap="nowrap"><span class="gensmall">{S_TIMEZONE}</span><br />
		<span class="nav">{PAGINATION}</span></td>
  </tr>
  <tr>
	<td colspan="3"><span class="nav">{PAGE_NUMBER}</span></td>
  </tr>
</table>
</form>

<table width="100%" cellspacing="0" border="0" cellpadding="0">
  <tr>
	<td align="right" class="gensmall" nowrap="nowrap">{ALBUM_JUMPBOX}</td>
  </tr>
  <tr>
	<td align="right" class="gensmall">{S_AUTH_LIST}</td>
  </tr>
</table>

<br />

<!--
You must keep my copyright notice visible with its original content
-->
<div align="center" style="font-family: Verdana; font-size: 10px; letter-spacing: -1px">Powered by Photo Album Addon {ALBUM_VERSION} &copy; 2002-2003 <a href="http://smartor.is-root.com" target="_blank">Smartor</a> with Volodymyr (CLowN) Skoryk's SP1 addon & IdleVoid's Album Category Hierarchy mod!</div>

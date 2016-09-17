<table width="100%" cellspacing="2" cellpadding="2" border="0">
  <tr>
	<td width="100%"><a class="maintitle" href="{U_PERSONAL_GALLERY}">{L_PERSONAL_GALLERY_OF_USER}</a><br />
		<span class="genmed">{L_PERSONAL_GALLERY_EXPLAIN}</span></td>
	<td align="right" valign="bottom" nowrap="nowrap">
  		<form name="search" action="album_search.php">
			<span class="gensmall">{L_SEARCH_FOR}: &nbsp;&nbsp;
			<select name="mode">
				<option value="user">{L_USERNAME}</option>
				<option value="name">{L_NAME}</option>
				<option value="desc">{L_DESCRIPTION}</option>
			</select>
			&nbsp;&nbsp;{L_THAT_CONTAINS}:&nbsp;&nbsp; <input type="text" name="search" maxlength="20">&nbsp;&nbsp;<input type="submit" value="Go"></span>
		</form>
	
	<span class="gensmall"><b>{PAGINATION}</b></span></td>
  </tr>
</table>

<table width="100%" cellspacing="2" cellpadding="2" border="0">
  <tr>
	<!-- BEGIN your_personal_gallery -->
	<td><a href="{U_UPLOAD_PIC}"><img src="{UPLOAD_PIC_IMG}" border="0" alt="{L_UPLOAD_PIC}" title="{L_UPLOAD_PIC}" /></a></td>
	<!-- END your_personal_gallery -->
	<td class="nav" width="100%"><span class="nav">&nbsp;&nbsp;&nbsp;<a href="{U_INDEX}" class="nav">{L_INDEX}</a> -> <a class="nav" href="{U_ALBUM}">{L_ALBUM}</a> -> <a class="nav" href="{U_PERSONAL_GALLERY}">{L_PERSONAL_GALLERY_OF_USER}</a></span></td>
  </tr>
</table>

<table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
  <tr>
	<th class="thTop" height="25" colspan="{S_COLS}">{L_PERSONAL_GALLERY_OF_USER}</th>
  </tr>
  <!-- BEGIN no_pics -->
  <tr>
	<td class="row1" align="center" height="50"><span class="gen">{L_PERSONAL_GALLERY_NOT_CREATED}</span></td>
  </tr>
  <!-- END no_pics -->
  <!-- BEGIN picrow -->
  <tr>
  <!-- BEGIN piccol -->
	<td align="center" width="{S_COL_WIDTH}" class="row1"><span class="genmed"><a href="{picrow.piccol.U_PIC}" {TARGET_BLANK}><img src="{picrow.piccol.THUMBNAIL}" border="0" alt="{picrow.piccol.DESC}" title="{picrow.piccol.DESC}" vspace="10" /></a></span></td>
  <!-- END piccol -->
  </tr>
  <tr>
  <!-- BEGIN pic_detail -->
	<td class="row2"><span class="gensmall">
	{L_PIC_TITLE}: {picrow.pic_detail.TITLE}<br />
	{L_POSTED}: {picrow.pic_detail.TIME}<br />
	{L_VIEW}: {picrow.pic_detail.VIEW}<br />
	{picrow.pic_detail.RATING}
	{picrow.pic_detail.COMMENTS}
	{picrow.pic_detail.IP}
	{picrow.pic_detail.EDIT}  {picrow.pic_detail.DELETE}  {picrow.pic_detail.LOCK}</span>
	</td>
  <!-- END pic_detail -->
  </tr>
  <!-- END picrow -->
  <tr>
	<td class="cat" colspan="{S_COLS}" align="center" height="28">
		<form action="{U_PERSONAL_GALLERY}" method="post">
		<span class="gensmall">{L_SELECT_SORT_METHOD}:
		<select name="sort_method">
			<option {SORT_TIME} value='pic_time'>{L_TIME}</option>
			<option {SORT_PIC_TITLE} value='pic_title'>{L_PIC_TITLE}</option>
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

<table width="100%" cellspacing="2" border="0" cellpadding="2">
  <tr>
	<!-- BEGIN your_personal_gallery -->
	<td><a href="{U_UPLOAD_PIC}"><img src="{UPLOAD_PIC_IMG}" border="0" alt="{L_UPLOAD_PIC}" title="{L_UPLOAD_PIC}" /></a></td>
	<!-- END your_personal_gallery -->
	<td width="100%"><span class="nav">&nbsp;&nbsp;&nbsp;<a href="{U_INDEX}" class="nav">{L_INDEX}</a> -> <a class="nav" href="{U_ALBUM}">{L_ALBUM}</a> -> <a class="nav" href="{U_PERSONAL_GALLERY}">{L_PERSONAL_GALLERY_OF_USER}</a></span></td>
	<td align="right" nowrap="nowrap"><span class="gensmall">{S_TIMEZONE}</span><br />
		<span class="nav">{PAGINATION}</span></td>
  </tr>
  <tr>
	<td colspan="3"><span class="nav">{PAGE_NUMBER}</span></td>
  </tr>
</table>
</form>

<br />

<!--
You must keep my copyright notice visible with its original content
-->
<div align="center" style="font-family: Verdana; font-size: 10px; letter-spacing: -1px">Powered by Photo Album Addon {ALBUM_VERSION} &copy; 2002-2003 <a href="http://smartor.is-root.com" target="_blank">Smartor</a> with Volodymyr (CLowN) Skoryk's SP1 addon</div>

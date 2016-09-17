  <table width="100%" cellspacing="2" cellpadding="2" border="0">
	<tr>
	  <td><span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a> -> <a href="{U_ALBUM}" class="nav">{L_ALBUM}</a></span></td>
	  <td align="right" nowrap="nowrap"><span class="gensmall">
  		<form name="search" action="album_search.php">
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
<!-- Album Category Hierarchy : end -->
  <table width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline">
	<tr>
	  <th width="100%" height="25" nowrap="nowrap" class="thCornerL">&nbsp;{L_USERS_PERSONAL_GALLERIES}&nbsp;</th>
	  <th class="thTop" nowrap="nowrap">&nbsp;{L_JOINED}&nbsp;</th>
	  <th class="thCornerR" nowrap="nowrap">&nbsp;{L_PICS}&nbsp;</th>
	</tr>
	<!-- BEGIN memberrow -->
	<tr>
	  <td height="28" class="{memberrow.ROW_CLASS}">&nbsp;<span class="gen"><a href="{memberrow.U_VIEWGALLERY}" class="gen">{memberrow.USERNAME}</a></span></td>
	  <td class="{memberrow.ROW_CLASS}" align="center" nowrap="nowrap"><span class="gensmall">&nbsp;{memberrow.JOINED}&nbsp;</span></td>
	  <td class="{memberrow.ROW_CLASS}" align="center"><span class="gensmall">{memberrow.PICS}</span></td>
	</tr>
	<!-- END memberrow -->
  <tr>
	<td class="cat" colspan="3" align="center"h>
	<form method="post" action="{S_MODE_ACTION}">
		<span class="gensmall">{L_SELECT_SORT_METHOD}:&nbsp;{S_MODE_SELECT}&nbsp;&nbsp;{L_ORDER}:&nbsp;{S_ORDER_SELECT}&nbsp;&nbsp;
		   <input type="submit" name="submit" value="{L_SORT}" class="liteoption" />
		</span></form>
	</td>
  </tr>
  </table>

<table width="100%" cellspacing="0" cellpadding="0" border="0">
  <tr>
	<td><span class="nav">{PAGE_NUMBER}</span></td>
	<td align="right"><span class="gensmall">{S_TIMEZONE}</span><br /><span class="nav">{PAGINATION}</span></td>
  </tr>
</table>


<br />

<!--
You must keep my copyright notice visible with its original content
-->
<div align="center" style="font-family: Verdana; font-size: 10px; letter-spacing: -1px">Powered by Photo Album Addon {ALBUM_VERSION} &copy; 2002-2003 <a href="http://smartor.is-root.com" target="_blank">Smartor</a> with Volodymyr (CLowN) Skoryk's SP1 addon</div>

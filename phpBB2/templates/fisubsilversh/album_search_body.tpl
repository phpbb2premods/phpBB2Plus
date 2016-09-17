<!-- BEGIN switch_search -->
<form action="album_search.php">
<span class="gensmall">

	{L_SEARCH_FOR}: &nbsp;&nbsp;
	<select name="mode">
		<option value="user">{L_USERNAME}</option>
				<option value="name">{L_NAME}</option>
				<option value="desc">{L_DESCRIPTION}</option>
	</select>

	&nbsp;&nbsp;{L_THAT_CONTAINS}:&nbsp;&nbsp; <input type="text" name="search" maxlength="20">
	<br><br>

	<input type="submit" value="Submit">
	<input type="reset" value="Reset">

</span>
</form>
<!-- END switch_search -->


<!-- BEGIN switch_search_results -->
<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
  <tr> 
	<td><span class="maintitle">Search found {L_NRESULTS} matches</span><br /></td>
  </tr>
  <tr> 
	<td><span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a></span></td>
  </tr>
</table>

<table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline" align="center">
  <tr> 
  	<th class="thTop" nowrap="nowrap" width="5%">&nbsp;</th>
	<th class="thTop" nowrap="nowrap" width="10%">{L_TCATEGORY}</th>
	<th class="thTop" nowrap="nowrap">{L_TTITLE}</th>
	<th class="thTop" nowrap="nowrap"  width="12%">{L_TSUBMITER}</th>
	<th class="thTop" nowrap="nowrap" width="20%">{L_TSUBMITED}</th>
  </tr>
  
  <!-- BEGIN search_results -->
  <tr>
	<td class="row1" align="center" valign="middle"><img src="templates/fisubsilversh/images/folder.gif" /></td>
	<td class="row1"><span class="gensmall"><a href="{switch_search_results.search_results.U_CAT}">{switch_search_results.search_results.L_CAT}</a></span></td>
	<td class="row1"><span class="gensmall"><a href="{switch_search_results.search_results.U_PIC}">{switch_search_results.search_results.L_PIC}</a></span></td>
	<td class="row1"><span class="gensmall"><a href="{switch_search_results.search_results.U_PROFILE}"><center>{switch_search_results.search_results.L_USERNAME}</center></a></span></td>
	<td class="row1"><span class="gensmall"><center>{switch_search_results.search_results.L_TIME}</center></span></td>
  </tr>
  <!-- END search_results -->
  
  <tr> 
	<td class="cat" colspan="7" height="28" valign="middle">&nbsp; </td>
  </tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="tbl"><tr><td class="tbll"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblbot"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblr"><img src="images/spacer.gif" alt="" width="8" height="4" /></td></tr></table>
<table width="100%" cellspacing="2" border="0" align="center" cellpadding="2">
  <tr> 
	<td align="right"><span class="gensmall">{S_TIMEZONE}</span></td>
  </tr>
</table>
<!-- END switch_search_results -->


<br />

<!--
You must keep my copyright notice visible with its original content
-->
<div align="center" style="font-family: Verdana; font-size: 10px; letter-spacing: -1px">Powered by Photo Album Addon {ALBUM_VERSION} &copy; 2002-2003 <a href="http://smartor.is-root.com" target="_blank">Smartor</a> with Volodymyr (CLowN) Skoryk's SP1 addon</div>

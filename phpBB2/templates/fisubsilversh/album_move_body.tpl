<form action="{S_ALBUM_ACTION}" method="post">
<table width="100%" cellspacing="2" cellpadding="2" border="0">
  <tr>
	<td class="nav"><span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a> -> <a class="nav" href="{U_ALBUM}">{L_ALBUM}</a></span></td>
  </tr>
</table>
<table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline">
	<tr>
	  <th height="25" class="thHead">{L_MOVE}</th>
	</tr>
	<tr>
	  <td class="row1" align="center"><br /><span class="gen">{L_MOVE_TO_CATEGORY}</span> &nbsp; {S_CATEGORY_SELECT} &nbsp; <input class="mainoption" type="submit" name="move" value="{L_MOVE}" /><br />&nbsp;</td>
	</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="tbl"><tr><td class="tbll"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblbot"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblr"><img src="images/spacer.gif" alt="" width="8" height="4" /></td></tr></table>
<!-- BEGIN pic_id_array -->
<input type="hidden" name="pic_id[]" value="{pic_id_array.VALUE}" />
<!-- END pic_id_array -->
</form>

<br />

<!--
You must keep my copyright notice visible with its original content
-->
<div align="center" class="copyright">Powered by Photo Album {ALBUM_VERSION} &copy; 2002-2003 <a href="http://smartor.is-root.com" target="_blank">Smartor</a></div>
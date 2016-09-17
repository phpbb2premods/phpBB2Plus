<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
	<tr>
		<td align="left" class="nav">
		  <a href="{U_PORTAL}" class="nav">{L_PORTAL}</a> -> <a href="{U_KB}" class="nav">{L_KB}</a> {PATH}
		</td>
	</tr>
</table>

<!-- BEGIN switch_sub_cats -->
<table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
  <tr> 
  	   <th class="thCornerL" nowrap="nowrap">&nbsp;{L_CATEGORY}&nbsp;</th>
	   <th width="50" class="thCornerR" nowrap="nowrap">&nbsp;{L_ARTICLES}&nbsp;</th>
  </tr>
  <!-- BEGIN catrow -->
  <tr> 
  	   <td class="row1" height="50"><span class="forumlink">{switch_sub_cats.catrow.CATEGORY}</span><br /><span class="genmed">{switch_sub_cats.catrow.CAT_DESCRIPTION}</span></td>
	   <td class="row2" align="center" valign="middle"><span class="genmed">{switch_sub_cats.catrow.CAT_ARTICLES}</span></td>
  </tr>
  <!-- END catrow -->
  <tr>
  	  <td class="cat" colspan="2">&nbsp;</td>
  </tr>
</table>
<br />
<!-- END switch_sub_cats -->
<table width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline">
  <tr> 
  	   <th class="thCornerL" nowrap="nowrap">&nbsp;{L_ARTICLE}&nbsp;</th>
  	   <th class="thTop" nowrap="nowrap">&nbsp;{L_CAT}&nbsp;</th>
  	   <th class="thTop" nowrap="nowrap">&nbsp;{L_ARTICLE_TYPE}&nbsp;</th>
  	   <th class="thTop" nowrap="nowrap">&nbsp;{L_ARTICLE_AUTHOR}&nbsp;</th>
  	   <th class="thTop nowrap="nowrap">&nbsp;{L_ARTICLE_DATE}&nbsp;</th>
	   <th class="thCornerR" nowrap="nowrap">&nbsp;{L_VIEWS}&nbsp;</th>
  </tr>
  <!-- BEGIN articlerow -->
  <tr> 
  	   <td class="row1" height="50">{articlerow.ARTICLE}<br /><span class="genmed">{articlerow.ARTICLE_DESCRIPTION} <br />{articlerow.U_APPROVE} {articlerow.U_DELETE}</span></td>
	   <td class="row1" align="center" valign="middle">&nbsp;<span class="genmed">{articlerow.CATEGORY}</span>&nbsp;</td>
	   <td class="row1" align="center" valign="middle">&nbsp;<span class="genmed">{articlerow.ARTICLE_TYPE}</span>&nbsp;</td>
	   <td class="row2" align="center" valign="middle"><span class="genmed">{articlerow.ARTICLE_AUTHOR}</span></td>
	   <td class="row1" align="center" valign="middle" nowrap="nowrap"><span class="gensmall">{articlerow.ARTICLE_DATE}</span></td>
	   <td class="row2" align="center" valign="middle"><span class="genmed">{articlerow.ART_VIEWS}</span></td>
  </tr>
  <!-- END articlerow -->
  <!-- BEGIN no_articles -->
  <tr> 
  	   <td class="row1" align = "center" colspan = "6" height="50"><span class="genmed">{no_articles.COMMENT}</span></td>
  </tr>
  <!-- END no_articles -->
  <tr>
  	  <td class="cat" colspan="6">&nbsp;</td>
  </tr>
</table>
<table width="100%" cellspacing="2" border="0" align="center">
  <tr> 
	<td valign="top" align="right"><br />{JUMPBOX}</td>
  </tr>
</table>

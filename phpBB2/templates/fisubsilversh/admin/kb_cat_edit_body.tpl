
<h1>{L_EDIT_TITLE}</h1>

<p>{L_EDIT_DESCRIPTION}</p>

  <table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline" align="center">
<form action="{S_ACTION}" method="post">
	<tr> 
	  <th class="thHead" colspan="2">{L_CAT_SETTINGS}</th>
	</tr>
	<tr> 
	  <td class="row1">{L_CATEGORY}</td>
	  <td class="row2"><input class="post" type="text" size="25" name="catname" value="{CAT_NAME}" class="post" /></td>
	</tr>
	<!-- BEGIN switch_cat -->
	<tr> 
	  <td class="row1">{L_DESCRIPTION}</td>
	  <td class="row2"><textarea rows="5" cols="45" wrap="virtual" name="catdesc" class="post">{CAT_DESCRIPTION}</textarea></td>
	</tr>
	<tr>
	  <td class="row1">{L_PARENT}</td>
	  <td class="row2">
	    <select name="parent">
	    <option value="0">{L_NONE}</otpion>
		{PARENT_LIST}
		</select>
	</tr>
	<!-- BEGIN switch_edit_category -->
	<tr> 
	  <td class="row1">{L_NUMBER_ARTICLES}</td>
	  <td class="row2"><input class="post" type="text" size="4" maxlength="3" name="number_articles" value="{NUMBER_ARTICLES}" class="post" /></td>
	</tr>
	<!-- END switch_edit_category -->
	<!-- END switch_cat -->
	<tr> 
	  <td class="cat" colspan="2" align="center">{S_HIDDEN}<input type="submit" name="submit" value="{L_CREATE}" class="mainoption" /></td>
	</tr>
  </table>
</form>
	
<br clear="all" />
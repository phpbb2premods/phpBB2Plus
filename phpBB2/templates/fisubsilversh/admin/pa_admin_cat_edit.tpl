<script language="JavaScript" type="text/javascript">
<!--
	var error_msg = "";
	function checkAddForm() 
	{
		error_msg = "";

		if(document.form.cat_name.value == "")
		{
			error_msg += "{L_CAT_NAME_FIELD_EMPTY}";
		}
		
		if(error_msg != "")
		{
			alert(error_msg);
			error_msg = "";
			return false;
		}
		else
		{
			return true;
		}
	}
// -->
</script>



<h1>{L_CAT_TITLE}</h1>

<p>{L_CAT_EXPLAIN}</p>

<!-- IF ERROR neq '' -->
<table width="100%" cellpadding="3" cellspacing="1" class="forumline">
  <tr>
	<td class="row2" align="center">{ERROR}</td>
  </tr>
</table>
<br />
<!-- ENDIF -->

<form action="{S_CAT_ACTION}" method="post" name="form" onsubmit="return checkAddForm();">
<table width="100%" cellpadding="3" cellspacing="1" class="forumline">
  <tr>
	<th colspan="2" class="thHead">{L_CAT_TITLE}</th>
  </tr>
  <tr>
	<td width="50%" class="row1">{L_CAT_NAME}<br><span class="gensmall">{L_CAT_NAME_INFO}</span></td>
	<td class="row2"><input type="text" class="post" size="50" name="cat_name" value="{CAT_NAME}"></td>
  </tr>
  <tr>
	<td class="row1">{L_CAT_DESC}<br><span class="gensmall">{L_CAT_DESC_INFO}</span></td>
	<td class="row2"><input type="text" class="post" size="50" name="cat_desc" value="{CAT_DESC}"></td>
  </tr>
  <tr>
	<td class="row1">{L_CAT_PARENT}<br><span class="gensmall">{L_CAT_PARENT_INFO}</span></td>
	<td class="row2"><select name="cat_parent" class="forminput">{S_CAT_LIST}</select></td>
  </tr>
  <tr>
	<td class="row1">{L_CAT_ALLOWFILE}<br><span class="gensmall">{L_CAT_ALLOWFILE_INFO}</span></td>
	<td class="row2">
	<input type="radio" name="cat_allow_file" value="1" {CHECKED_YES}>{L_YES}&nbsp;
	<input type="radio" name="cat_allow_file" value="0" {CHECKED_NO}>{L_NO}&nbsp;
	</td>
  </tr>  
  <tr>
	<td class="row1">{L_CAT_ALLOWCOMMENTS}<br><span class="gensmall">{L_CAT_ALLOWCOMMENTS_INFO}</span></td>
	<td class="row2">
	<input type="radio" name="cat_allow_comments" value="1" {CHECKED_ALLOWCOMMENTS_YES}>{L_YES}&nbsp;
	<input type="radio" name="cat_allow_comments" value="0" {CHECKED_ALLOWCOMMENTS_NO}>{L_NO}&nbsp;
	</td>
  </tr>  
  <tr>
	<td class="row1">{L_CAT_ALLOWRATINGS}<br><span class="gensmall">{L_CAT_ALLOWRATINGS_INFO}</span></td>
	<td class="row2">
	<input type="radio" name="cat_allow_ratings" value="1" {CHECKED_ALLOWRATINGS_YES}>{L_YES}&nbsp;
	<input type="radio" name="cat_allow_ratings" value="0" {CHECKED_ALLOWRATINGS_NO}>{L_NO}&nbsp;
	</td>
  </tr>  
  <tr>
	<td align="center" class="cat" colspan="2">
	{S_HIDDEN_FIELDS}
	<input class="liteoption" type="submit" value="{L_CAT_TITLE}" name="submit">
  </tr>
</table>
</form>

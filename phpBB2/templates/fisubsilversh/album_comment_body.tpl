<form action="{S_ALBUM_ACTION}" method="post">
<table width="100%" cellspacing="2" cellpadding="2" border="0">
  <tr>
	<td class="nav"><span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a> {ALBUM_NAVIGATION_ARROW} <a href="{U_ALBUM}" class="nav">{L_ALBUM}</a>{NAV_CAT_DESC}</span></td>
    <td align="right">
  		<form action="album_search.php" method="get">
			<span class="gensmall">Search for: &nbsp;

			<select name="search_type">
				<option>User Name</option>
				<option>Picture Name</option>
				<option>Description</option>
			</select>

			&nbsp;that contains:&nbsp; <input type="text" name="search" maxlength="20">&nbsp;


			<input type="submit" class="liteoption" value="Go"></span>
		</form>
  </td>
 </tr>
</table>


<table width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline">
  <tr>
	<th class="thTop" height="25" colspan="2">{PIC_TITLE}</th>
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
	  <tr>
		<td valign="top" align="right"><span class="genmed">{L_PIC_DESC}:</span></td>
		<td valign="top"><b><span class="genmed">{PIC_DESC}</span></b></td>
	  </tr>
	</td>
  </tr>
	</table>
<!-- BEGIN coment_switcharo_top -->	
<br>
<table border="0" class="forumline" width="100%">
  <tr> 
  	<th class="thTop" nowrap="nowrap" width="15%">Poster</th>
	<th class="thTop" nowrap="nowrap" width="85%">Message</th>
  </tr>
<!-- END coment_switcharo_top -->	
  
<!-- BEGIN commentrow -->

<tr> 
	<td  class="row1" align="center" valign="top">
		<span class="genmed"><b>{commentrow.POSTER}</span></b>
	</td>
	
	<td class="row1">		
		<table width="100%">
			<tr>
				<td><span class="genmed">Posted at: {commentrow.TIME}</span></td>
				<td align="right"><span class="genmed">{commentrow.EDIT}&nbsp;{commentrow.DELETE}&nbsp;{commentrow.IP}</span></td>
			</tr>
			<tr> 
				<td colspan="2"><hr></td>
			</tr>
			<tr>
				<td><span class="postbody">{commentrow.TEXT}</span></td>
			</tr>
		</table>
	</td>
</tr>
	

<!-- END commentrow -->

<!-- BEGIN coment_switcharo_bottom -->	
  <tr> 
	<td class="cat" colspan="2" height="28">&nbsp; </td>
  </tr>
</table>
<!-- END coment_switcharo_bottom -->


<!-- BEGIN switch_comment -->
  <tr>
	<td class="cat" align="center" height="28" colspan="2"><span class="gensmall">{L_ORDER}:</span>
	<select name="sort_order"><option {SORT_ASC} value='ASC'>{L_ASC}</option><option {SORT_DESC} value='DESC'>{L_DESC}</option></select>&nbsp;<input type="submit" name="submit" value="{L_SORT}" class="liteoption" /></td>
  </tr>
<!-- END switch_comment -->
</table>
<!-- BEGIN switch_comment -->
<table width="100%" cellspacing="2" border="0" cellpadding="2">
  <tr>
	<td width="100%"><span class="nav">{PAGE_NUMBER}</span></td>
	<td align="right" nowrap="nowrap"><span class="gensmall">{S_TIMEZONE}</span><br /><span class="nav">{PAGINATION}</span></td>
  </tr>
</table>
<!-- END switch_comment -->
</form>

<script language="JavaScript" type="text/javascript">
<!--
function checkForm() {
	formErrors = false;

	if ((document.commentform.comment.value.length < 2) && (document.commentform.rate.value == -1))
	{
		formErrors = "{L_COMMENT_NO_TEXT}";
	}
	else if (document.commentform.comment.value.length > {S_MAX_LENGTH})
	{
		formErrors = "{L_COMMENT_TOO_LONG}";
	}

	if (formErrors) {
		alert(formErrors);
		return false;
	} else {
		return true;
	}
}

 function storeCaret(textEl) {
                if (textEl.createTextRange) textEl.caretPos = document.selection.createRange().duplicate();
 }

//how to add smilies
function emotions(text) 
{
	if (document.commentform.comment.createTextRange && document.commentform.comment.caretPos) 
	{
		var caretPos = document.commentform.comment.caretPos;
		caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == ' ' ? text + ' ' : text;
		document.commentform.comment.focus();
	} 
	else 
	{
		document.commentform.comment.value  += text;
		document.commentform.comment.focus();
	}
}
//pops up a window with all smilies
function openAllSmiles()
{
		smiles = window.open('album_showpage.php?mode=smilies', '_phpbbsmilies', 'HEIGHT=600,resizable=yes,scrollbars=yes,WIDTH=470');
	    smiles.focus();
	    return false;
}
// -->
</script>

<!-- BEGIN switch_comment_post -->
<form name="commentform" action="{S_ALBUM_ACTION}" method="post" onsubmit="return checkForm();">
<table width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline">
  <tr>
	<th class="thTop" height="25" colspan="3">{L_POST_YOUR_COMMENT}</th>
  </tr>
  <tr>
	<td class="row1" valign="top" width="20%"><span class="genmed">{L_MESSAGE}<br>
		{L_MAX_LENGTH}: <b>{S_MAX_LENGTH}</b></span></td>
	<td class="row2" valign="top">
			
	<textarea name="comment" class="post" cols="60" rows="9" wrap='virtual' class='post' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'>{S_MESSAGE}</textarea></td>
	
	<td class="row2" valign="middle" width="40%">  
	   <table border="0" cellspacing="0" cellpadding="5">
	      <tr>
	     	<!-- BEGIN smilies -->
	            <td><img src="{switch_comment_post.smilies.URL}" border="0" onmouseover="this.style.cursor='hand';" onclick="emotions(' {switch_comment_post.smilies.CODE} ');" alt="{switch_comment_post.smilies.DESC}" /></td>
	                        			
		        <!-- BEGIN new_col -->
		        </tr><tr>
		    	<!-- END new_col -->
	    	<!-- END smilies -->
	      </tr>
	   </table>
	   
	   <INPUT TYPE='button' CLASS=BUTTON NAME="SmilesButt" VALUE="Show All Smilies" ONCLICK="openAllSmiles();">
	       
	 </td>
  </tr>
  <tr>
	<td class="cat" align="center" colspan="3" height="28"><input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" /></td>
  </tr>
</table>
</form>
<!-- END switch_comment_post -->

<br />

<!--
You must keep my copyright notice visible with its original content
-->
<div align="center" style="font-family: Verdana; font-size: 10px; letter-spacing: -1px">Powered by Photo Album Addon {ALBUM_VERSION} &copy; 2002-2003 <a href="http://smartor.is-root.com" target="_blank">Smartor</a> with Volodymyr (CLowN) Skoryk's SP1 addon</div>

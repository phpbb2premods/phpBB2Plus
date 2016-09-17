<table width="100%" cellspacing="2" cellpadding="2" border="0">
  <tr>
	<td><span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a>&nbsp;&raquo;&nbsp;<a class="nav" href="{U_ALBUM}">Gallery</a>&nbsp;&raquo;&nbsp;<a class="nav" href="{U_VIEW_CAT}">{CAT_TITLE}</a></span></td>
   
   <td align="right">
  		<form action="album_search.php">
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

<table width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline">
  <tr>
	<th class="thTop" height="25" colspan="2"><a href="{U_PREVIOUS}"><img src="{ALBUM_PREVIOUS_IMG}" alt=""></a>&nbsp; &nbsp;{PIC_TITLE}&nbsp; &nbsp;<a href="{U_NEXT}"><img src="{ALBUM_NEXT_IMG}" alt=""></a></th>
  </tr>
  <tr>
	<td class="row1" align="center">{U_PIC_L1}<img src="{U_PIC}" border="0" vspace="10" alt="{PIC_TITLE}" title="{PIC_TITLE}" />{U_PIC_L2}<br /><span class="genmed">{U_PIC_CLICK}</span></td>
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
	<td width="150" align="left" valign="top" class="row1"><span class="name"><b>{commentrow.POSTER_NAME}</b></span><br /><span class="postdetails">{commentrow.POSTER_RANK}<br />{commentrow.POSTER_RANK_IMAGE}{commentrow.POSTER_AVATAR}<br /><br />{commentrow.POSTER_JOINED}<br />{commentrow.POSTER_POSTS}<br />{commentrow.POSTER_FROM}</span><br /></td>
	<td class="row1" width="100%" height="28" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td width="100%"><a href="{commentrow.U_MINI_POST}"><img src="{commentrow.MINI_POST_IMG}" width="12" height="9" alt="{commentrow.L_MINI_POST_ALT}" title="{commentrow.L_MINI_POST_ALT}" border="0" /></a><span class="postdetails">Posted at: {commentrow.TIME}</span></td>
			<td valign="top" nowrap="nowrap"><span class="genmed">{commentrow.EDIT}&nbsp;{commentrow.DELETE}&nbsp;{commentrow.IP}</span></td>
		</tr>
		<tr> 
			<td colspan="2"><hr /></td>
		</tr>
		<tr>
			<td colspan="2"><span class="postbody">{commentrow.TEXT}</span></td>
		</tr>
	</table></td>
</tr>
<tr> 
	<td class="row1" width="150" align="left" valign="middle"><span class="nav"><a href="#top" class="nav">Back to top</a></span></td>
	<td class="row1" width="100%" height="28" valign="bottom" nowrap="nowrap"><table cellspacing="0" cellpadding="0" border="0" height="18" width="18">
		<tr> 
			<td valign="middle" nowrap="nowrap">{commentrow.PROFILE_IMG} {commentrow.PM_IMG} {commentrow.EMAIL_IMG} {commentrow.WWW_IMG} {commentrow.AIM_IMG} {commentrow.YIM_IMG} {commentrow.MSNM_IMG} {commentrow.ICQ_IMG}</td>
		</tr>
	</table></td>
</tr>
<tr> 
	<td class="spacerow" colspan="2" height="1"><img src="templates/fisubsilversh/images/spacer.gif" alt="" width="1" height="1" /></td>
</tr>
<!-- END commentrow -->

<!-- BEGIN coment_switcharo_bottom -->	
    <tr>
	<td class="spacerow" height="1" colspan="5"><img src="templates/fisubsilversh/images/spacer.gif" alt="" width="1" height="1" /></td>
  </tr>
</table>
<!-- END coment_switcharo_bottom -->

<form action="{S_ALBUM_ACTION}" method="post">
<!-- BEGIN switch_comment -->
  <tr>
	<td class="cat" align="center" height="28" colspan="2"><span class="gensmall">{L_ORDER}:</span>
	<select name="sort_order"><option {SORT_ASC} value='ASC'>{L_ASC}</option><option {SORT_DESC} value='DESC'>{L_DESC}</option></select>&nbsp;<input type="submit" name="submit" value="{L_SORT}" class="liteoption" /></td>
  </tr>
<!-- END switch_comment -->
</table>
<table border="0" cellpadding="0" cellspacing="0" class="tbl"><tr><td class="tbll"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblbot"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblr"><img src="images/spacer.gif" alt="" width="8" height="4" /></td></tr></table>
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
	    return true;
}
// -->
</script>

<!-- BEGIN rate_switch_only --> 
<form name="commentform" action="{S_ALBUM_ACTION}" method="post" onsubmit="return checkForm();"> 
<table width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline"> 
  <tr> 
   <th class="thTop" height="25" colspan="3">{L_PLEASE_RATE_IT}</th> 
  </tr> 
    <td class="row2" valign="top" align="center"> 
          
      <select name="rate"> 
         <option value="-1">{S_RATE_MSG}</option> 

         <!-- BEGIN rate_row --> 
      <option value="{rate_switch_only.rate_row.POINT}">{rate_switch_only.rate_row.POINT}</option> 
      <!-- END rate_row --> 
          
         </select> 
    </td> 
  </tr> 
  <tr> 
     <td class="cat" align="center" colspan="3" height="28"><input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" /></td> 
  </tr> 
</table> 
</form> 
<table border="0" cellpadding="0" cellspacing="0" class="tbl"><tr><td class="tbll"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblbot"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblr"><img src="images/spacer.gif" alt="" width="8" height="4" /></td></tr></table>
<!-- END rate_switch_only --> 


<!-- BEGIN switch_comment_post -->
<form name="commentform" action="{S_ALBUM_ACTION}" method="post" onsubmit="return checkForm();">
<table width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline">
  <tr>
	<th class="thTop" height="25" colspan="3">{L_POST_YOUR_COMMENT}</th>
  </tr>
  <!-- BEGIN logout -->
  <tr>
	<td class="row1" width="30%" height="28"><span class="genmed">{L_USERNAME}</span></td>
	<td class="row2" colspan="3"><input class="post" type="text" name="comment_username" size="32" maxlength="32" /></td>
  </tr>
  <!-- END logout -->
  <tr>
	<td class="row1" valign="top" width="20%"><span class="genmed">{L_MESSAGE}<br>
		{L_MAX_LENGTH}: <b>{S_MAX_LENGTH}</b></span></td>
		
	<td class="row2" valign="top">
			<!-- BEGIN rate_comment -->
	<span class="genmed">{L_PLEASE_RATE_IT}:&nbsp;</span>
			<select name="rate">
			<option value="-1">{S_RATE_MSG}</option>
			<!-- BEGIN rate_row -->
			<option value="{switch_comment_post.rate_row.POINT}">{switch_comment_post.rate_row.POINT}</option>
			<!-- END rate_row -->
			</select>			
	<br>
			<!-- END rate_comment -->
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
	   
	   <INPUT TYPE='button' CLASS=BUTTON NAME="SmilesButt" VALUE="{L_MORE_SMILIES}" ONCLICK="openAllSmiles();">
	       
	 </td>
  </tr>
  <tr>
	<td class="cat" align="center" colspan="3" height="28"><input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" /></td>
  </tr>
</table>
</form>
<table border="0" cellpadding="0" cellspacing="0" class="tbl"><tr><td class="tbll"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblbot"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblr"><img src="images/spacer.gif" alt="" width="8" height="4" /></td></tr></table>
<!-- END switch_comment_post -->
<br />

<!--
You must keep my copyright notice visible with its original content
-->
<div align="center" style="font-family: Verdana; font-size: 10px; letter-spacing: -1px">Powered by Photo Album Addon {ALBUM_VERSION} &copy; 2002-2003 <a href="http://smartor.is-root.com" target="_blank">Smartor</a> with Volodymyr (CLowN) Skoryk's SP1 addon</div>

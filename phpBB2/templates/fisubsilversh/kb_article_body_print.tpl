<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html dir="{S_CONTENT_DIRECTION}">
<head>
<meta http-equiv="Content-Type" content="text/html; charset={S_CONTENT_ENCODING}">
<meta http-equiv="Content-Style-Type" content="text/css">
{META}
{NAV_LINKS}
<title>{SITENAME} :: {PAGE_TITLE}</title>
<link rel="stylesheet" href="templates/print_version.css" type="text/css" >
</head>

<body bgcolor="{T_BODY_BGCOLOR}" text="{T_BODY_TEXT}" link="{T_BODY_LINK}" vlink="{T_BODY_VLINK}" />
<a name="top"></a>

<table align ="center" width="80%" cellpadding="4" cellspacing="1" border="0" class="forumline">
  <tr>
  	  <td class="maintitle" nowrap="nowrap">{ARTICLE_TITLE}&nbsp;<br /><hr></td>
  </tr>
  <tr>
  	  <td class="row2">
	  <span class="gen"><b>{L_ARTICLE_DESCRIPTION}</b></span> <span class="gen">{ARTICLE_DESCRIPTION}</span><br />
  	  <span class="gen"><b>{L_ARTICLE_AUTHOR}</b></span> <span class="gen">{ARTICLE_AUTHOR}</span>
  	  <span class="gen"><b>{L_ARTICLE_DATE}</b></span> <span class="gen">{ARTICLE_DATE}</span>
  	  <span class="gen"><b>{L_ARTICLE_TYPE}</b></span> <span class="gen">{ARTICLE_TYPE}</span><br />
  	  <span class="gen"><b>{L_ARTICLE_KEYWORDS}</b></span> <span class="gen">{ARTICLE_KEYWORDS}</span><br />
  	  <span class="gen"><b>{L_ARTICLE_CATEGORY}</b></span> <span class="gen">{ARTICLE_CATEGORY}</span><br />
  <!-- BEGIN switch_comments -->
  	  <span class="gen">{COMMENTS}</span><br />
  <!-- END switch_comments -->
  	  <span class="gen">{VIEWS}</span>
  <!-- BEGIN switch_ratings -->
  	  <span class="gen">{RATINGS}&nbsp;{RATE_IMG}</span><br />
  <!-- END switch_ratings -->
		<hr></td>
  <!-- BEGIN switch_toc -->
  <tr>
       <td class="row1" align="left"><span class="maintitle">{L_TOC}</span><br /><br />
	   <span class="nav">
	   <!-- BEGIN pages -->
	   {switch_toc.pages.TOC_ITEM}
	   <!-- END pages -->
	   </span></td>
  </tr>
<!-- END switch_toc -->
  <tr>
  	  <td class="spacerow" height="1"><img src="templates/fisubsilversh/images/spacer.gif" alt="" width="1" height="1" /></td>
  </tr>
  <tr> 
  	   <td class="row1" wrap="wrap"><span class="postbody">{ARTICLE_TEXT}</span></td>
  </tr>
  <!-- BEGIN switch_pages -->
  <tr>
       <td class="row1" align="center"><span class="nav">{L_GOTO_PAGE} 
	   <!-- BEGIN pages -->
	   {switch_pages.pages.PAGE_LINK}
	   <!-- END pages -->
	   </span></td>
  </tr>
<!-- END switch_pages -->
</table>

<br />
  <!-- BEGIN switch_comments_show -->
	<table align ="center" width="80%" cellpadding="4" cellspacing="1" border="0" class="forumline">
 	 <tr>
  		  <td class="maintitle">{L_COMMENTS}&nbsp;</td>
 	 </tr>
  <!-- END switch_comments_show -->
	<!-- BEGIN postrow -->
	<tr> 
		<td class="row1" width="100%" height="28" valign="top">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="100%"><span class="genmed"><b>{postrow.POSTER_NAME}</b></span><span class="postdetails">{L_POSTED}: {postrow.POST_DATE}<span class="gen">&nbsp;</span>&nbsp; &nbsp;{L_POST_SUBJECT} {postrow.POST_SUBJECT}</span></td>
			</tr>
			<tr> 
				<td ><hr /></td>
			</tr>
			<tr>
				<td ><span class="postbody">{postrow.MESSAGE}</span></td>
			</tr>
		</table></td>
	</tr>
	<tr> 
		<td class="spacerow" colspan="2" height="1"><img src="templates/fisubsilversh/images/spacer.gif" alt="" width="1" height="1" /></td>
	</tr>
	<!-- END postrow -->
  <!-- BEGIN switch_comments_show -->
	</table>
  <!-- END switch_comments_show -->
</body>
</html>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset={S_CONTENT_ENCODING}" />
<link rel="stylesheet" href="{T_URL}/{T_HEAD_STYLESHEET}" type="text/css">
</HEAD>

<body bgcolor="{T_TR_COLOR3}" text="{T_BODY_TEXT}" link="{T_BODY_LINK}" vlink="{T_BODY_VLINK}"> 
<script language="JavaScript" src="{T_URL}/bbcode.js" type="text/javascript" ></script>
<form method="post" name="post" action="{U_SHOUTBOX}" onsubmit="return checkForm(this)">
{ERROR_BOX}
<table width="100%" height="26" cellpadding="0" cellspacing="0" border="0" class="row1">
<tr>
			<td class="row1" align="center" valign="middle" width="100%">
				<center><span class="gensmall">
 	<!-- BEGIN switch_auth_post -->
 	<!-- BEGIN switch_bbcode -->
	  <input type="button" class="button" accesskey="b" name="addbbcode0" value=" {L_B} " style="font-weight:bold; width: 20px" onClick="bbstyle(0)" />
	  <input type="button" class="button" accesskey="i" name="addbbcode2" value=" {L_I} " style="font-style:italic; width: 20px" onClick="bbstyle(2)" />
	  <input type="button" class="button" accesskey="u" name="addbbcode4" value=" {L_U} " style="text-decoration: underline; width: 20px" onClick="bbstyle(4)" />
	  <input type="button" class="button" accesskey="q" name="addbbcode6" value=" {L_QUOTE} " style="width: 50px" onClick="bbstyle(6)" />&nbsp;&nbsp;
	<span  class="nav"><a href="{U_MORE_SMILIES}" onclick="window.open('{U_MORE_SMILIES}', '_phpbbsmilies', 'HEIGHT=300,resizable=yes,scrollbars=yes,WIDTH=250');return false;" target="_phpbbsmilies" class="nav">{L_SMILIES}</a></span>
 	<!-- END switch_bbcode -->
{L_TEXT}:
<input type="text" class="liteoption" name="message" value="{MESSAGE}" size="18%" onselect="storeCaret(this);" onclick="storeCaret(this);" onkeyup="storeCaret(this);"/>
&nbsp;&nbsp;
		<input type="submit" class="mainoption" value="{L_SHOUT_SUBMIT}" name="shout" />

	<!-- END switch_auth_post -->
	<!-- BEGIN switch_auth_no_post -->
				{L_SHOUTBOX_LOGIN}&nbsp;
	<!-- END switch_auth_no_post -->
				<input type="submit" class="liteoption" value="{L_SHOUT_REFRESH}" name="refresh" /></center><br/>
				</span>		
				<center>
			</td>

</tr>
</table>
		 <iframe src="{U_SHOUTBOX_VIEW}" align="left" width="100%" height="160" frameborder="0" marginheight="0" marginwidth="0" allowtransparency="true">
		</iframe>


</form>
</body>
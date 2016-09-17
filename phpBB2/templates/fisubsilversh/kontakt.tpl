<script language="JavaScript"  type="text/javascript" type="text/javascript">
<!--
function ResetCheck()
{
pruef=window.confirm("{kontakt_js1}");
return pruef;
}

function chkFormular()
{
 if(document.Formular.name.value == "")
  {
   alert("{kontakt_js2}");
   document.Formular.name.focus();
   return false;
  }
 if(document.Formular.mail.value == "")
  {
   alert("{kontakt_js3}");
   document.Formular.mail.focus();
   return false;
  }
      if(document.Formular.mail.value.indexOf('@') == -1)
  {
   alert("{kontakt_js4}");
   document.Formular.mail.focus();
   return false;
  }
if(document.Formular.betreff.value == "")
  {
   alert("{kontakt_js5}");
   document.Formular.betreff.focus();
   return false;
  }
if(document.Formular.textfeld.value == "")
  {
   alert("{kontakt_js6}");
   document.Formular.textfeld.focus();
   return false;
  }

}
       //-->
</script>

<body>
<table width="100%" border="0" cellpadding="3" cellspacing="1" style="border-collapse: collapse" class="forumline">
<tr>
<th class="thHead" colspan="2"><center>{L_CONTACT}</center></th>
</tr>

<tr><td colspan="2" class="row2"><span class="postbody">{kontakt1}</td></tr>
<form name="Formular" action="kontakt_post.php" method="POST" onSubmit="return chkFormular()" OnReset="return ResetCheck()" enctype="multipart/form-data">
<tr>
<td width="38%" class="row1"><font size="3"><span class="postbody">{kontakt2}</font></td>
<td align="left" class="row2"><input class="input" name="name" type="text" size="40" maxlength="50"></td>
</tr>
<tr>
<td class="row1"><font size="3"><span class="postbody">{kontakt3}</font></td>
<td align="left" class="row2"><input class="input" name="mail" type="text" size="40" maxlength="50"></td>
</tr>
<tr>
<td class="row1"><font size="3"><span class="postbody">{kontakt4}</font></td>
<td align="left" class="row2"><input class="input" name="betreff" type="text" size="40" maxlength="50"></td>
</tr>
<tr><td valign="top" class="row1"><font size="3"><span class="postbody">{kontakt5}</font></td>

<td align="left" class="row2"><textarea class="input" name="textfeld" cols="39" rows="15" type="text"></textarea></td></tr>
<tr><td class="row1"></td>
<td class="row2"><input type="submit" value="{kontakt6}" onClick="this.document.Formular.Name.focus()">   <input type="reset" value="{kontakt7}"></td>
</tr>
</form>
</span>
</table>

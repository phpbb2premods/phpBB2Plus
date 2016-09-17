<!-- BEGIN quick_reply -->
<script language='JavaScript'>
	function openAllSmiles(){
		smiles = window.open('{U_MORE_SMILIES}', '_phpbbsmilies', 'HEIGHT=250,resizable=yes,scrollbars=yes,WIDTH=300');
		smiles.focus();
		return false;
	}
	
	function quoteSelection() {

		theSelection = false;
			if (window.getSelection)
			{
				theSelection = window.getSelection();
			}
			else if (document.getSelection)
			{
				theSelection = document.getSelection();
			}
			else if (document.selection)
			{
				theSelection = document.selection.createRange().text;
			}

		if (theSelection) {
			// Add tags around selection
					emoticon( '[quote]' + theSelection + '[/quote]\n');
			document.post.message.focus();
			theSelection = '';
			return;
			}
			else
			{
			alert('{L_NO_TEXT_SELECTED}');
		}
	}

	function storeCaret(textEl) {
		if (textEl.createTextRange) textEl.caretPos = document.selection.createRange().duplicate();
	}

	function emoticon(text) {
		if (document.post.message.createTextRange && document.post.message.caretPos) {
			var caretPos = document.post.message.caretPos;
			caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == ' ' ? text + ' ' : text;
			document.post.message.focus();
		} else {
			document.post.message.value  += text;
			document.post.message.focus();
		}
	}

	function checkForm() {
		formErrors = false;
		if (document.post.message.value.length < 2) {
			formErrors = '{L_EMPTY_MESSAGE}';
		}
		if (formErrors) {
			alert(formErrors);
			return false;
		} else {
			if (document.post.quick_quote.checked) {
				document.post.message.value = document.post.last_msg.value + document.post.message.value;
			} 
			document.post.quick_quote.checked = false;
			return true;
		}
	}
</script>
<form action='{quick_reply.POST_ACTION}' method='post' name='post' onsubmit='return checkForm(this)'>
<input type="hidden" name="sid" value="{quick_reply.SID}">  
<tr>
<th>{L_OPTIONS}</th>
<th><b>{L_QUICK_REPLY}</b></th>
</tr>
<!-- BEGIN user_logged_out -->
<!-- END user_logged_out -->
<td class="row1" rowspan="1" align="left"><input type='checkbox' name='quick_quote'> <span class="gensmall">{L_QUOTE_LAST_MESSAGE}</span><br>
<!-- BEGIN user_logged_in -->
&nbsp;<input type='checkbox' name='attach_sig' {quick_reply.user_logged_in.ATTACH_SIGNATURE}><span class="gensmall">{L_ATTACH_SIGNATURE}</span><br>
&nbsp;<input type='checkbox' name='notify' {quick_reply.user_logged_in.NOTIFY_ON_REPLY}><span class="gensmall">{L_NOTIFY_ON_REPLY}</span>
<!-- END user_logged_in -->
</td>
<input type='hidden' name='mode' value='reply'>
<input type='hidden' name='t' value='{quick_reply.TOPIC_ID}'>
<input type='hidden' name='last_msg' value='{quick_reply.LAST_MESSAGE}'>
<!--input type='hidden' name='message' value=''-->
<td class="row1" valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td class='row1' valign='top'>
<textarea name='message' rows="6" cols="35" style="width:450px" wrap='virtual' tabindex='1' class='post' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'></textarea><br>
<INPUT TYPE='button' name='smiles_all' class='liteoption' VALUE='{L_ADD_SMILIES}' ONCLICK="openAllSmiles();">&nbsp;
<input type='button' name='quoteselected' class='liteoption' value='{L_QUOTE_SELECTED}' onclick='javascript:quoteSelection()'>&nbsp;
<input type='submit' name='preview' class='liteoption' value='{L_PREVIEW}'>&nbsp;
<input type='submit' accesskey='s' name='post' class='mainoption' value='{L_SUBMIT}'>

</tr>
</table>
</td>
</form>
<!-- END quick_reply -->
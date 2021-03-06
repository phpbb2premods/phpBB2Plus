<script language="JavaScript" type="text/javascript">
<!--
window.onunload = doUnload;

// set gDoConfirmSubit to false, if you don't want to confirm submit
// setting it to false, will always submit even with no changes
var gDoConfirmSubmit = false;
var gFormHasChanged = false;

// small dummy function to ensure that when unloading that we set tab to null
function doUnload()
{	
	checkForm(null,null);
}

// unset the global change 'check' variable
function unsetChange()
{
	gFormHasChanged = false;
}

// set the global change 'check' variable
function setChange()
{
	gFormHasChanged = true;
}

// this function gets called when user clicks 'submit' NOT when changing tabs
function confirmSubmit()
{
	var lResult = false;
	if (gDoConfirmSubmit)
	{
		if (gFormHasChanged)
		{
			if (confirm('{L_ASK_SAVE_CHANGES}'))
			{
				lResult = true;			
				document.config.save_config.value='true';
			}
		}
		else
		{
			alert('{L_NOTHING_TO_SAVE}')
		}
	}
	else
	{
		lResult = true;	
		document.config.save_config.value='true';	
	}
	
	unsetChange();	
	return lResult;
}

// this function gets called when user clicks 'submit' AND when changing tabs
function checkForm(tab,subtab)
{
	if (tab != null || subtab != null)
	{
		if (gFormHasChanged)
		{
			if (confirm('{L_SETTINGS_CHANGED_ASK_SAVE}'))
			{
				document.config.save_config.value='true';
			}
		}
		
		unsetChange();
		
		// when using the document.config.submit() call, the submit button wasn't submitted in EI (bug in EI ?), so here is a workaround :
		// when hitting submit, the 'tab' var will always be null, and thus we are sumitting and thus we can do an 'old' submit method
		// meaning we don't use javascript to submit the form....

		document.config.tab.value = (tab != null) ? tab : document.config.tab.value;
		document.config.subtab.value = (subtab != null) ? subtab : document.config.subtab.value;
		document.config.submit();
	}
}

// -->
</script>
<script language="JavaScript" type="text/javascript">unsetChange();</script>
<h1>{L_ALBUM_CONFIG}</h1>
<p>{L_ALBUM_CONFIG_EXPLAIN}</p>
<p>{L_ALBUM_CONFIG_NOTICE}</p>
<p><i>{L_ALBUM_CONFIG_EXPLAIN_DETAIL}</i></p>
<table width="100%" cellpadding="0" cellspacing="0" border="0" class="forumline">
<form name="config" action="{S_ALBUM_CONFIG_ACTION}" method="post" onSubmit="return confirmSubmit();">
<input type="hidden" name="tab" value="{H_SELECTED_TAB}" />
<input type="hidden" name="subtab" value="{V_SELECTED_TAB}" />
<input type="hidden" name="config_table" value="{CONFIG_TABLE}" />
<input type="hidden" name="save_config" value="false" />
<tr>
	<td width="15%" class="row2" valign="top">
		<table border="0">
			<!-- BEGIN header_row -->
			<tr>
				<td cellpadding="0" cellspacing="0">
					<table cellpadding="4" cellspacing="1" border="0" class="forumline">
						<tr width="100%">
							<td width="1000" class="{header_row.HEADER_TAB_CLASS}"><a href="#" onClick="checkForm('{header_row.TAB_SELECT_NAME}');" class="{header_row.TAB_LINKS}">{header_row.L_TAB_TITLE}</a></td>
						</tr>
					</table>
				</td>
			</tr>
			<!-- END header_row -->
		</table>
	</td>
	<td class="row1" valign="top">
		<table border="0" width="100%" height="100%" cellpadding="0" cellspacing="1"">
			<tr>
				<th colspan="2" class="thHead">{L_CONFIG_TAB}</th>
			</tr>
			{CONFIGURATION_BOX}
		</table>
	</td>
</tr>	
<tr>
	<td class="cat" colspan="2" align="center"><input type="submit" name="submitted" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;<input type="reset" value="{L_RESET}" onclick="unsetChange();" class="liteoption" /></td>
</tr>		
</form>				
<!-- BEGIN switch_on_save_confirmation -->
<tr>
	<td align="center" colspan="{HEADER_COL_SPAN}"><br />
		<table cellpadding="4" cellspacing="1" border="0" class="forumline">
			<tr>
				<td class="tab_headers">{L_SETTINGS_SAVED}</td>
			</tr>
		</table>	
	</td>
</tr>
<!-- END switch_on_save_confirmation -->
</table>
<br clear="all" />
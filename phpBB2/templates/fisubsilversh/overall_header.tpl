<?xml version="1.0" encoding="{S_CONTENT_ENCODING}"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="{S_CONTENT_DIRECTION}">
<head>
<meta http-equiv="Content-Type" content="text/html; charset={S_CONTENT_ENCODING}" />
<meta http-equiv="Content-Style-Type" content="text/css" />
{META}
{NAV_LINKS}
<title>{SITENAME} :: {PAGE_TITLE}</title>
<link rel="stylesheet" href="templates/fisubsilversh/{T_HEAD_STYLESHEET}" type="text/css" />
<link rel="shortcut icon" href="./favicon.ico" />
<script language="JavaScript" type="text/javascript" src="includes/toggle_display.js"></script>
<!-- BEGIN switch_enable_pm_popup -->
<script type="text/javascript">
<!--
	if ( {PRIVATE_MESSAGE_NEW_FLAG} )
	{
		window.open('{U_PRIVATEMSGS_POPUP}', '_phpbbprivmsg', 'HEIGHT=225,resizable=yes,WIDTH=400');;
	}
//-->
</script>
<!-- END switch_enable_pm_popup -->
<script type="text/javascript">
<!--
var phpEx = '{PHPEX}';
var POST_FORUM_URL = '{POST_FORUM_URL}';
var POST_TOPIC_URL = '{POST_TOPIC_URL}';
var POST_POST_URL = '{POST_POST_URL}';
var ajax_page_charset = '{S_CONTENT_ENCODING}';
var S_SID = '{S_SID}';
var ajax_core_defined = 0;
var phpbb_root_path = '{PHPBB_ROOT_PATH}';
//-->
</script>

<script type="text/javascript" src="includes/javascript/ajax_core.js"></script>

<script language="Javascript" type="text/javascript"> 
<!-- 
function setCheckboxes(theForm, elementName, isChecked)
{
    var chkboxes = document.forms[theForm].elements[elementName];
    var count = chkboxes.length;

    if (count) 
	{
        for (var i = 0; i < count; i++) 
		{
            chkboxes[i].checked = isChecked;
    	}
    } 
	else 
	{
    	chkboxes.checked = isChecked;
    } 

    return true;
} 
//--> 
</script>
<!-- Start add - Birthday MOD -->
{GREETING_POPUP}
<!-- End add - Birthday MOD -->
<script type="text/javascript">
<!--
window.status = "{PRIVATE_MESSAGE_INFO}";
// -->
</script>
<!-- Start add - Protect user account MOD -->
{PASSWD_POPUP}
<!-- End add - Protect user account MOD -->
<!-- BEGIN switch_absence -->
<script language="Javascript" type="text/javascript">
<!--
	window.open('{U_ABSENCE_POPUP}', '_phpbbprivmsg', 'HEIGHT=225,resizable=yes,WIDTH=400');;
//-->
</script>
<!-- END switch_absence -->
</head>
<body>
<!-- Start add - Complete banner MOD -->
<!-- BEGIN switch_Banners -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="20%">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td><div align="center">{BANNER_1_IMG}</div></td></tr>
<tr><td><div align="center">{BANNER_2_IMG}</div></td></tr>
</table>
</td>
<td width="60%">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td><div align="center">{BANNER_3_IMG}</div></td></tr>
<tr><td><div align="center">{BANNER_4_IMG}</div></td></tr>
</table>
</td>
<td width="20%">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td><div align="center">{BANNER_5_IMG}</div></td></tr>
<tr><td><div align="center">{BANNER_6_IMG}</div></td></tr>
</table>
</td>
</tr>
</table>
<!-- END switch_Banners -->
<!-- End add - Complete banner MOD -->
<a name="top" id="top"></a>
<table class="bodyline" width="100%" cellspacing="0" cellpadding="0" border="0">
<tr>
<td>
<table class="topbkg" width="100%" cellspacing="0" cellpadding="0" border="0">
<tr> 
<td><a href="{U_INDEX}"><img src="templates/fisubsilversh/images/phpbb2_logo.jpg" border="0" alt="{L_INDEX}" title="{L_INDEX}" width="240" height="110" /></a></td>
<td align="center" width="100%">{BANNER_0_IMG}</td><td><a href="{U_PORTAL}"><img src="templates/fisubsilversh/images/phpbb2_logor.jpg" border="0" alt="{L_HOME}" title="{L_HOME}" width="140" height="110" /></a></td>
</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="2">
<tr> 
<td align="center" class="topnav">&nbsp;<a href="{U_FAQ}">{L_FAQ}</a>
&nbsp;&#8226;&nbsp;
<a href="{U_SEARCH}">{L_SEARCH}</a>
&nbsp;&#8226;&nbsp;
<a href="{U_PREFERENCES}">{L_PREFERENCES}</a>
<!-- BEGIN switch_user_logged_in -->
&nbsp;&#8226;&nbsp;
<a href="{U_BOOKMARKS}">{L_BOOKMARKS}</a>
&nbsp; &#8226;&nbsp;
<a href="{U_SEARCH_NEW}">{L_SEARCH_NEW2}</a>
<!-- END switch_user_logged_in -->
&nbsp;&#8226;&nbsp;
<a href="{U_GROUP_CP}">{L_USERGROUPS}</a>
<!-- BEGIN switch_user_logged_out -->
&nbsp;&#8226;&nbsp;
<a href="{U_REGISTER}">{L_REGISTER}</a>
<!-- END switch_user_logged_out -->
&nbsp;&#8226;&nbsp;
<a href="{U_PROFILE}">{L_PROFILE}</a>
&nbsp;&#8226;&nbsp;
<a href="{U_PRIVATEMSGS}">{PRIVATE_MESSAGE_INFO}</a>
&nbsp;&#8226;&nbsp;
<a href="{U_LOGIN_LOGOUT}">{L_LOGIN_LOGOUT}</a></td>
</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="tbl"><tr><td class="tbll"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblbot"><img src="images/spacer.gif" alt="" width="8" height="4" /></td><td class="tblr"><img src="images/spacer.gif" alt="" width="8" height="4" /></td></tr></table>
{CALENDAR_BOX}
<table width="100%" border="0" cellspacing="0" cellpadding="10">
<tr>
<td>
<!-- BEGIN switch_list_staff -->
<table width="90%" cellspacing="2" cellpadding="2" border="0" align="center">
  <tr> 
	<td align="left"><a href="{U_INDEX}" class="nav">{L_INDEX}</a></td>
  </tr>
</table>

<table width="90%" cellpadding="4" cellspacing="1" border="0" class="forumline" align="center">
  <tr>
        <th class="thTop">{L_USERNAME}</th>
        <th class="thTop">{L_FORUMS}</th>
        <th class="thTop">{L_LOCATION}</th>
        <th class="thTop">{L_CONTACT}</th>
        <th class="thTop">{L_MESSENGER}</th>
        <th class="thCornerR">{L_WWW}</th>
  </tr>
  <!-- BEGIN user_level -->
  <tr>
        <td class="row3" colspan="6" align="left"><span class="nav"><b>{switch_list_staff.user_level.USER_LEVEL}</b></span></td>
  </tr>
  <!-- BEGIN staff -->
  <tr> 
        <td align="left" class="{switch_list_staff.user_level.staff.ROW_CLASS}" valign="top">
                <span class="gen"><a href="{switch_list_staff.user_level.staff.U_PROFILE}" onclick="window.open('{switch_list_staff.user_level.staff.U_PROFILE}', 'view_profile', 'HEIGHT=400,top=10,left=10,status=no,resizable=yes,menubar=no,scrollbars=yes,toolbar=no,WIDTH=700');return false;" class="gen">{switch_list_staff.user_level.staff.USERNAME}</a></span>
                <span class="gensmall"> {switch_list_staff.user_level.staff.USER_STATUS}<br />{switch_list_staff.user_level.staff.RANK}<br />{switch_list_staff.user_level.staff.RANK_IMAGE}<br />
                {switch_list_staff.user_level.staff.AVATAR}</span></td>
        <td align="left" class="{switch_list_staff.user_level.staff.ROW_CLASS}" width="30%" valign="top"><span class="gen">{switch_list_staff.user_level.staff.FORUMS}</span></td>
        <td class="{switch_list_staff.user_level.staff.ROW_CLASS}" valign="top" align="center"><span class="genmed">{switch_list_staff.user_level.staff.LOCATION}</span></td>
        <td class="{switch_list_staff.user_level.staff.ROW_CLASS}" width="11%" valign="top" align="center">{switch_list_staff.user_level.staff.EMAIL} {switch_list_staff.user_level.staff.PM}</td>
        <td class="{switch_list_staff.user_level.staff.ROW_CLASS}" width="11%" valign="top" align="center">{switch_list_staff.user_level.staff.MSN} {switch_list_staff.user_level.staff.YIM} {switch_list_staff.user_level.staff.AIM} {switch_list_staff.user_level.staff.ICQ}</td>
        <td class="{switch_list_staff.user_level.staff.ROW_CLASS}" width="11%" valign="top" align="center">{switch_list_staff.user_level.staff.WWW}</td>
  </tr>
  <!-- END staff -->
  <!-- END user_level -->
  <tr>
        <td class="cat" colspan="6">&nbsp;</td>
  </tr>
</table>
<!-- END switch_list_staff -->

<!-- BEGIN switch_view_profile -->
<table border="0" cellspacing="1" cellpadding="3" align="center" width="100%" class="forumline">
  <tr> 
        <th colspan="2" class="thHead">{L_ABOUT_USER}</th>
  </tr>
  <tr> 
        <td align="left" valign="middle" class="row1"><span class="genmed">{L_POSTS}</span></td>
        <td align="left" valign="middle" class="row2" nowrap="nowrap">&nbsp;<span class="gen"> {POSTS} ({POST_PERCENT},&nbsp;ø {POSTS_PER_DAY})</span></td>
  </tr>
  <tr> 
        <td align="left" valign="middle" class="row1"><span class="genmed">{L_TOPICS}</span></td>
        <td align="left" valign="middle" class="row2" nowrap="nowrap">&nbsp;<span class="gen"> {TOPICS} ({TOPIC_PERCENT},&nbsp;ø {TOPICS_PER_DAY})</span></td>
  </tr>
<!-- BEGIN last_posts -->
  <tr>
        <td colspan="2" align="left" class="row3">
                <table border="0" cellspacing="0" cellpadding="0" align="center" width="93%">
                  <tr>
                        <td align="left" width="30%"><span class="genmed"><a href="{switch_view_profile.last_posts.FORUM_URL}" target="_blank" onclick="opener.location.href='{switch_view_profile.last_posts.FORUM_URL}'; return false;" class="genmed"><b>{switch_view_profile.last_posts.FORUM_NAME}</b></a></span></td>
                        <td align="left" width="40%"><span class="genmed"><a href="{switch_view_profile.last_posts.LAST_POST_URL}" target="_blank" onclick="opener.location.href='{switch_view_profile.last_posts.LAST_POST_URL}'; return false;" class="genmed">{switch_view_profile.last_posts.LAST_POST_TITLE}</a></span></td>
                        <td align="right"><span class="gensmall">{switch_view_profile.last_posts.LAST_POST_TIME}<br />{switch_view_profile.last_posts.LAST_POST_PERIOD}</span></td>
                  </tr>
                </table></td>
  </tr>
<!-- END last_posts -->
  <tr> 
        <td align="left" valign="middle" class="row1"><span class="genmed">{L_JOINED}</span></td>
        <td align="left" valign="middle" class="row2" nowrap="nowrap">&nbsp;<span class="gen">{JOINED}&nbsp; {JOINED_PERIOD}</span></td>
  </tr>
<!-- BEGIN view_signature -->
  <tr> 
        <td class="spacerow" colspan="2" height="1"></td>
  </tr>
  <tr>
        <td colspan="2" align="left" class="row2"><span class="gensmall">{SIGNATURE}</span></td>
  </tr>
<!-- END view_signature -->
  <tr>
        <td colspan="2" align="center" class="cat"><span class="genmed"><a href="javascript:window.close();" class="genmed">{L_CLOSE_WINDOW}</a></span></td>
  </tr>
</table>
<!-- END switch_view_profile -->
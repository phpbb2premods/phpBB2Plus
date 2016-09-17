
<h1>{L_CONFIGURATION_TITLE}</h1>

<p>{L_CONFIGURATION_EXPLAIN}</p>

<form action="{S_ACTION}" method="post">
<table width="100%" cellpadding="3" cellspacing="1" border="0" align="center" class="forumline">
	<tr>
	  <th class="thHead" colspan="2">{L_CONFIGURATION_TITLE}</th>
	</tr>
	<tr>
		<td class="row1" width="50%">{L_NEW_NAME}<br /><span class="gensmall">{L_NEW_EXPLAIN}</span></td>
		<td class="row2" width="50%"><input type="radio" name="allow_new" value="1" {S_NEW_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="allow_new" value="0" {S_NEW_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1" width="50%">{L_APPROVE_NEW_NAME}<br /><span class="gensmall">{L_APPROVE_NEW_EXPLAIN}</span></td>
		<td class="row2" width="50%"><input type="radio" name="approve_new" value="1" {S_APPROVE_NEW_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="approve_new" value="0" {S_APPROVE_NEW_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1" width="50%">{L_EDIT_NAME}<br /><span class="gensmall">{L_EDIT_EXPLAIN}</span></td>
		<td class="row2" width="50%"><input type="radio" name="allow_edit" value="1" {S_EDIT_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="allow_edit" value="0" {S_EDIT_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1" width="50%">{L_APPROVE_EDIT_NAME}<br /><span class="gensmall">{L_APPROVE_EDIT_EXPLAIN}</span></td>
		<td class="row2" width="50%"><input type="radio" name="approve_edit" value="1" {S_APPROVE_EDIT_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="approve_edit" value="0" {S_APPROVE_EDIT_NO} /> {L_NO}</td>
	</tr>
	<tr> 
        <td class="row1" width="50%">{L_ANON_NAME}<br /><span class="gensmall">{L_ANON_EXPLAIN}</span></td> 
        <td class="row2" width="50%"><input type="radio" name="allow_anon" value="1" {S_ANON_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="allow_anon" value="0" {S_ANON_NO} /> {L_NO}</td> 
    </tr>
	<tr>
		<td class="row1" width="50%">{L_NOTIFY_NAME}<br /><span class="gensmall">{L_NOTIFY_EXPLAIN}</span></td>
		<td class="row2" width="50%"><input type="radio" name="notify" value="0" {S_NOTIFY_NONE} />{L_NONE}&nbsp; &nbsp;<input type="radio" name="notify" value="2" {S_NOTIFY_EMAIL} />{L_EMAIL}&nbsp; &nbsp;<input type="radio" name="notify" value="1" {S_NOTIFY_PM} />{L_PM}</td>
	</tr>
	<tr>
		<td class="row1" width="50%">{L_ADMIN_ID_NAME}<br /><span class="gensmall">{L_ADMIN_ID_EXPLAIN}</span></td>
		<td class="row2" width="50%"><input class="post" type="text" name="admin_id" value="{ADMIN_ID}" size="5" maxlength="4" /></td>
	</tr>
	<tr>
		<td class="row1" width="50%">{L_MOD_GROUP}<br /><span class="gensmall">{L_MOD_GROUP_EXPLAIN}</span></td>
		<td class="row2" width="50%">{MOD_GROUP}</td>
	</tr>
	<tr>
		<td class="row1" width="50%">{L_HEADER_BANNER}<br /><span class="gensmall">{L_HEADER_BANNER_EXPLAIN}</span></td>
		<td class="row2" width="50%"><input type="radio" name="header_banner" value="1" {S_HEADER_BANNER_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="header_banner" value="0" {S_HEADER_BANNER_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1" width="50%">{L_STATS_LIST}<br /><span class="gensmall">{L_STATS_LIST_EXPLAIN}</span></td>
		<td class="row2" width="50%"><input type="radio" name="stats_list" value="1" {S_STATS_LIST_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="stats_list" value="0" {S_STATS_LIST_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1" width="50%">{L_ARTICLE_PAG}<br /><span class="gensmall">{L_ARTICLE_PAG_EXPLAIN}</span></td>
		<td class="row2" width="50%"><input class="post" type="text" name="art_pagination" value="{ARTICLE_PAG}" size="5" maxlength="4" /></td>
	</tr>
	<tr>
		<td class="row1" width="50%">{L_COMMENTS_PAG}<br /><span class="gensmall">{L_COMMENTS_PAG_EXPLAIN}</span></td>
		<td class="row2" width="50%"><input class="post" type="text" name="comments_pagination" value="{COMMENTS_PAG}" size="5" maxlength="4" /></td>
	</tr>
	<tr>
		<td class="row1" width="50%"><span class="gen">{L_NEWS_SORT}</span></td>
		<td class="row2" width="50%">{NEWS_SORT} </td>
	</tr>
	<tr>
		<td class="row1" width="50%"><span class="gen">{L_NEWS_SORT_PAR}</span></td>
		<td class="row2" width="50%">{NEWS_SORT_PAR} </td>
	</tr>
	<tr>
	  <th class="thHead" colspan="2">{L_COMMENTS_INFO}</th>
	</tr>
	<tr>
		<td class="row1" width="50%">{L_COMMENTS}<br /><span class="gensmall">{L_COMMENTS_EXPLAIN}</span></td>
		<td class="row2" width="50%"><input type="radio" name="comments" value="1" {S_COMMENTS_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="comments" value="0" {S_COMMENTS_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1" width="50%">{L_COMMENTS_SHOW}<br /><span class="gensmall">{L_COMMENTS_SHOW_EXPLAIN}</span></td>
		<td class="row2" width="50%"><input type="radio" name="comments_show" value="1" {S_COMMENTS_SHOW_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="comments_show" value="0" {S_COMMENTS_SHOW_NO} /> {L_NO}</td>
	</tr>
	<tr> 
        <td class="row1" width="50%">{L_BUMP_POST}<br /><span class="gensmall">{L_BUMP_POST_EXPLAIN}</span></td> 
        <td class="row2" width="50%"><input type="radio" name="bump_post" value="1" {S_BUMP_POST_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="bump_post" value="0" {S_BUMP_POST_NO} /> {L_NO}</td> 
    </tr>
	<tr>
		<td class="row1" width="50%">{L_FORUM_ID}<br /><span class="gensmall">{L_FORUM_ID_EXPLAIN}</span></td>
		<td class="row2" width="50%">{FORUMS}</td>
	</tr>
	<tr>
		<td class="row1" width="50%">{L_DEL_TOPIC}<br /><span class="gensmall">{L_DEL_TOPIC_EXPLAIN}</span></td>
		<td class="row2" width="50%"><input type="radio" name="del_topic" value="1" {S_DEL_TOPIC_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="del_topic" value="0" {S_DEL_TOPIC_NO} /> {L_NO}</td>
	</tr>
	<tr>
	  <th class="thHead" colspan="2">{L_RATINGS_INFO}</th>
	</tr>
	<tr>
		<td class="row1" width="50%">{L_ALLOW_RATING}<br /><span class="gensmall">{L_ALLOW_RATING_EXPLAIN}</span></td>
		<td class="row2" width="50%"><input type="radio" name="allow_rating" value="1" {S_ALLOW_RATING_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="allow_rating" value="0" {S_ALLOW_RATING_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1" width="50%">{L_ALLOW_ANONYMOS_RATING}<br /><span class="gensmall">{L_ALLOW_ANONYMOS_RATING_EXPLAIN}</span></td>
		<td class="row2" width="50%"><input type="radio" name="allow_anonymos_rating" value="1" {S_ALLOW_ANONYMOS_RATING_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="allow_anonymos_rating" value="0" {S_ALLOW_ANONYMOS_RATING_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1" width="50%">{L_VOTES_CHECK_IP}<br /><span class="gensmall">{L_VOTES_CHECK_IP_EXPLAIN}</span></td>
		<td class="row2" width="50%"><input type="radio" name="votes_check_ip" value="1" {S_VOTES_CHECK_IP_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="votes_check_ip" value="0" {S_VOTES_CHECK_IP_NO} /> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1" width="50%">{L_VOTES_CHECK_USERID}<br /><span class="gensmall">{L_VOTES_CHECK_USERID_EXPLAIN}</span></td>
		<td class="row2" width="50%"><input type="radio" name="votes_check_userid" value="1" {S_VOTES_CHECK_USERID_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="votes_check_userid" value="0" {S_VOTES_CHECK_USERID_NO} /> {L_NO}</td>
	</tr>
	<tr>
	  <th class="thHead" colspan="2">{L_PRE_TEXT_NAME}</th>
	</tr>
	<tr>
		<td class="row1" width="50%">{L_PRE_TEXT_NAME}<br /><span class="gensmall">{L_PRE_TEXT_EXPLAIN}</span></td>
		<td class="row2" width="50%"><input type="radio" name="show_pretext" value="1" {S_SHOW_PRETEXT} /> {L_SHOW}&nbsp;&nbsp;<input type="radio" name="show_pretext" value="0" {S_HIDE_PRETEXT} /> {L_HIDE}</td>
	</tr>
	<tr>
		<td class="row1" width="50%">{L_PRE_TEXT_HEADER}</td>
		<td class="row2" width="50%"><input text="text" name="pt_header" value="{L_PT_HEADER}" size="40" maxlength="100" /></td>
	</tr>
	<tr>
		<td class="row1" width="50%">{L_PRE_TEXT_BODY}</td>
		<td class="row2" width="50%"><textarea name="pt_body" cols="40" rows="5">{L_PT_BODY}</textarea></td>
	</tr>
	<tr>
		<td class="cat" colspan="2" align="center">{S_HIDDEN_FIELDS}<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;<input type="reset" value="{L_RESET}" class="liteoption" /></td>
	</tr>
</table>
</form>
<br clear="all" />
<div class="maintitle">{L_PLUSCONFIG_TITLE}</div>
<br />
<div class="genmed">{L_PLUSCONFIG_EXPLAIN}</div>
<br />
<form action="{S_CONFIG_ACTION}" method="post">
<table width="99%" cellpadding="3" cellspacing="1" border="0" align="center" class="forumline">
<tr> 
<th colspan="2">{L_INDEX_LAYOUT}</th>
</tr>
<tr> 
<td class="row1">{L_SELECT_LAYOUT}<br />
<span class="gensmall">{L_PLUSSTYLE_EXPLAIN}</span></td>
<td class="row2" nowrap="nowrap"> 
<input type="radio" name="index_layout" value="{PLUSSTYLE_2}" {PLUSSTYLE_2_CHECKED} />
{L_PLUSSTYLE2}&nbsp;<br />
<input type="radio" name="index_layout" value="{PLUSSTYLE_1}" {PLUSSTYLE_1_CHECKED} />
{L_PLUSSTYLE1}</td>
</tr>
<tr> 
<td class="row1">{L_ENABLE_DEFAULTAVATAR}<br />
<span class="gensmall">{L_DEFAULTAVATAR_EXPLAIN}</span></td>
<td class="row2" nowrap="nowrap"> 
<input type="radio" name="default_avatar" value="1" {DEFAULT_AVATAR_YES} />
{L_YES}&nbsp;&nbsp; 
<input type="radio" name="default_avatar" value="0" {DEFAULT_AVATAR_NO} />
{L_NO}</td>
</tr>
<tr> 
<td class="row1">{L_ENABLE_BANNERS}<br />
<span class="gensmall">{L_BANNERS_EXPLAIN}</span></td>
<td class="row2" nowrap="nowrap"> 
<input type="radio" name="enable_banners" value="1" {BANNERS_YES} />
{L_YES}&nbsp;&nbsp; 
<input type="radio" name="enable_banners" value="0" {BANNERS_NO} />
{L_NO}</td>
</tr>
<tr> 
<td class="row1">{L_ENABLE_LINKS}<br />
<span class="gensmall">{L_LINKS_EXPLAIN}</span></td>
<td class="row2" nowrap="nowrap"> 
<input type="radio" name="show_links" value="1" {LINKS_YES} />
{L_YES}&nbsp;&nbsp; 
<input type="radio" name="show_links" value="0" {LINKS_NO} />
{L_NO}</td>
</tr>
<tr> 
<td class="row1">{L_ENABLE_QUICKREPLY}<br />
<span class="gensmall">{L_QUICKREPLY_EXPLAIN}</span></td>
<td class="row2" nowrap="nowrap"> 
<input type="radio" name="show_quickreply" value="1" {QUICKREPLY_YES} />
{L_YES}&nbsp;&nbsp; 
<input type="radio" name="show_quickreply" value="0" {QUICKREPLY_NO} />
{L_NO}</td>
</tr>
<tr> 
<td class="row1">{L_ENABLE_SHOUTBOX}<br />
<span class="gensmall">{L_SHOUTBOX_EXPLAIN}</span></td>
<td class="row2" nowrap="nowrap"> 
<input type="radio" name="show_shoutbox" value="1" {SHOUTBOX_YES} />&nbsp;{L_SHOUTBOX_YES}&nbsp;&nbsp;
<input type="radio" name="show_shoutbox" value="2" {SHOUTBOX_YES_REG} />&nbsp;{L_SHOUTBOX_YES_REG}&nbsp;&nbsp;
<input type="radio" name="show_shoutbox" value="0" {SHOUTBOX_NO} />&nbsp;{L_SHOUTBOX_NO}<br />
<input type="radio" name="show_shoutbox" value="3" {SHOUTBOX_PORTAL} />&nbsp;{L_SHOUTBOX_PORTAL}&nbsp;&nbsp;
<input type="radio" name="show_shoutbox" value="4" {SHOUTBOX_PORTAL_REG} />&nbsp;{L_SHOUTBOX_PORTAL_REG}<br />
<input type="radio" name="show_shoutbox" value="5" {SHOUTBOX_INDEX} />&nbsp;{L_SHOUTBOX_INDEX}&nbsp;&nbsp;
<input type="radio" name="show_shoutbox" value="6" {SHOUTBOX_INDEX_REG} />&nbsp;{L_SHOUTBOX_INDEX_REG}
</td>
</tr>
<tr> 
<td class="row1">{L_ENABLE_LASTVISIT}<br />
<span class="gensmall">{L_LASTVISIT_EXPLAIN}</span></td>
<td class="row2" nowrap="nowrap"> 
<input type="radio" name="show_last_visit" value="0" {LASTVISIT_NO} />
{L_NO}&nbsp;&nbsp;
<input type="radio" name="show_last_visit" value="1" {LASTVISIT_YES} />
{L_YES}&nbsp;&nbsp;
<input type="radio" name="show_last_visit" value="2" {LASTVISIT_24GUEST} />
{L_LASTVISIT_24GUEST}</td>
</tr>
<tr> 
<td class="row1">{L_CONTACT_CONFIG}<br />
<span class="gensmall">{L_CONTACT_EXPLAIN}</span></td>
<td class="row2" nowrap="nowrap"> 
<input type="text" maxlength="255" size="40" name="contact_email" value="{CONTACT_MAIL}" class="post" /></td>
</tr>
<tr> 
<td class="row1">{L_ENABLE_SHORTURLS}<br />
<span class="gensmall">{L_SHORTURLS_EXPLAIN}</span></td>
<td class="row2" nowrap="nowrap"> 
<input type="radio" name="enable_shorturls" value="1" {SHORTURLS_YES} />
{L_YES}&nbsp;&nbsp; 
<input type="radio" name="enable_shorturls" value="0" {SHORTURLS_NO} />
{L_NO}</td>
</tr>
<tr> 
<td class="row1">{L_DISABLE_SID}<br />
<span class="gensmall">{L_DISABLE_SID_EXPLAIN}</span></td>
<td class="row2" nowrap="nowrap"> 
<input type="radio" name="disable_sid" value="1" {DISABLESID_YES} />
{L_YES}&nbsp;&nbsp; 
<input type="radio" name="disable_sid" value="0" {DISABLESID_NO} />
{L_NO}</td>
</tr>
<tr> 
<td class="row1">{L_ENABLE_ANTIROBOT}<br />
<span class="gensmall">{L_ANTIROBOT_EXPLAIN}</span></td>
<td class="row2" nowrap="nowrap"> 
<input type="radio" name="enable_antirobot" value="1" {ANTIROBOT_YES} />
{L_YES}&nbsp;&nbsp; 
<input type="radio" name="enable_antirobot" value="0" {ANTIROBOT_NO} />
{L_NO}</td>
</tr>
<tr> 
<td class="row1">{L_ENABLE_CONFIRM_POST}<br />
<span class="gensmall">{L_CONFIRM_POST_EXPLAIN}</span></td>
<td class="row2" nowrap="nowrap"> 
<input type="radio" name="enable_confirm_post" value="1" {CONFIRM_POST_YES} />
{L_YES}&nbsp;&nbsp; 
<input type="radio" name="enable_confirm_post" value="0" {CONFIRM_POST_NO} />
{L_NO}</td>
</tr>
<tr> 
<td class="row1">{L_ENABLE_GENTIME}<br />
<span class="gensmall">{L_GENTIME_EXPLAIN}</span></td>
<td class="row2" nowrap="nowrap"> 
<input type="radio" name="enable_gentime" value="1" {GENTIME_YES} />
{L_YES}&nbsp;&nbsp; 
<input type="radio" name="enable_gentime" value="0" {GENTIME_NO} />
{L_NO}</td>
</tr>
<tr> 
<td class="row1">{L_FULLTEXT_CONFIG}<br />
<span class="gensmall">{L_FULLTEXT_EXPLAIN}</span><br /><br /><span class="code">ALTER TABLE phpbb_posts_text ADD FULLTEXT(post_text);</span></td>
<td class="row2" nowrap="nowrap"> 
<input type="radio" name="enable_fulltextsearch" value="1" {FULLTEXT_YES} />
{L_YES}&nbsp;&nbsp; 
<input type="radio" name="enable_fulltextsearch" value="0" {FULLTEXT_NO} />
{L_NO}</td>
</tr>
<tr> 
<td class="cat" colspan="2" align="center">{S_HIDDEN_FIELDS} 
<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />
&nbsp;&nbsp; 
<input type="reset" value="{L_RESET}" class="button" />
</td>
</tr>
</table>
</form>
<br clear="all" />

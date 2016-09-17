	<tr>
	  <td class="row1" width="45%"><span class="genmed">{L_MAX_PICS}</span></td>
	  <td class="row2"><input onchange="setChange();" class="post" type="text" maxlength="9" size="9" name="max_pics" value="{MAX_PICS}" /></td>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_USER_PICS_LIMIT}</span></td>
	  <td class="row2"><input onchange="setChange();" class="post" type="text" maxlength="12" size="5" name="user_pics_limit" value="{USER_PICS_LIMIT}" /></td>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_MOD_PICS_LIMIT}</span></td>
	  <td class="row2"><input onchange="setChange();" class="post" type="text" maxlength="12" size="5" name="mod_pics_limit" value="{MOD_PICS_LIMIT}" /></td>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_HOTLINK_PREVENT}</span></td>
	  <td class="row2"><span class="genmed"><input onchange="setChange();" type="radio" {HOTLINK_PREVENT_ENABLED} name="hotlink_prevent" value="1" />{L_YES}&nbsp;&nbsp;<input onchange="setChange();" type="radio" {HOTLINK_PREVENT_DISABLED} name="hotlink_prevent" value="0" />{L_NO}</span></td>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_HOTLINK_ALLOWED}</span></td>
	  <td class="row2"><input onchange="setChange();" class="post" type="text" size="40" name="hotlink_allowed" value="{HOTLINK_ALLOWED}" /></td>
	</tr>
    <tr>
      <td class="row1"><span class="genmed">{L_ALBUM_CATEGORY_SORTING}</span></td>
      <td class="row2"><span class="genmed"><input onchange="setChange();" type="radio" {ALBUM_CATEGORY_SORTING_ID} name="album_category_sorting" value="cat_id" />{L_ALBUM_CATEGORY_SORTING_ID}&nbsp;&nbsp;<input onchange="setChange();" type="radio" {ALBUM_CATEGORY_SORTING_NAME} name="album_category_sorting" value="cat_title" />{L_ALBUM_CATEGORY_SORTING_NAME}&nbsp;&nbsp;<input onchange="setChange();" type="radio" {ALBUM_CATEGORY_SORTING_ORDER} name="album_category_sorting" value="cat_order" />{L_ALBUM_CATEGORY_SORTING_ORDER}</span></td>
    </tr>
    <tr>
      <td class="row1"><span class="genmed">{L_ALBUM_CATEGORY_DIRECTION}</span></td>
      <td class="row2"><span class="genmed"><input onchange="setChange();" type="radio" {ALBUM_CATEGORY_SORTING_ASC} name="album_category_sorting_direction" value="ASC" />{L_ALBUM_CATEGORY_SORTING_ASC}&nbsp;&nbsp;<input onchange="setChange();" type="radio" {ALBUM_CATEGORY_SORTING_DESC} name="album_category_sorting_direction" value="DESC" />{L_ALBUM_CATEGORY_SORTING_DESC}</span></td>
    </tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_SHOW_RECENT_IN_SUBCATS}</span></td>
	  <td class="row2"><span class="genmed"><input onchange="setChange();" type="radio" {SHOW_RECENT_IN_SUBCATS_ENABLED} name="show_recent_in_subcats" value="1" />{L_YES}&nbsp;&nbsp;<input onchange="setChange();" type="radio" {SHOW_RECENT_IN_SUBCATS_DISABLED} name="show_recent_in_subcats" value="0" />{L_NO}</span></td>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_SHOW_RECENT_INSTEAD_OF_NOPICS}</span></td>
	  <td class="row2"><span class="genmed"><input onchange="setChange();" type="radio" {SHOW_RECENT_INSTEAD_OF_NOPICS_ENABLED} name="show_recent_instead_of_nopics" value="1" />{L_YES}&nbsp;&nbsp;<input onchange="setChange();" type="radio" {SHOW_RECENT_INSTEAD_OF_NOPICS_DISABLED} name="show_recent_instead_of_nopics" value="0" />{L_NO}</span></td>
	</tr>
    <tr>
      <td class="row1"><span class="genmed">{L_ALBUM_DEBUG_MODE}</span></td>
	  <td class="row2"><span class="genmed"><input onchange="setChange();" type="radio" {ALBUM_DEBUG_MODE_ENABLED} name="album_debug_mode" value="1" />{L_YES}&nbsp;&nbsp;<input onchange="setChange();" type="radio" {ALBUM_DEBUG_MODE_DISABLED} name="album_debug_mode" value="0" />{L_NO}</span></td>
    </tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_MAX_FILE_SIZE}</span></td>
	  <td class="row2"><input onchange="setChange();" class="post" type="text" maxlength="12" size="12" name="max_file_size" value="{MAX_FILE_SIZE}" /></td>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_MAX_WIDTH}</span></td>
	  <td class="row2"><input onchange="setChange();" class="post" type="text" maxlength="9" size="9" name="max_width" value="{MAX_WIDTH}" /></td>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_MAX_HEIGHT}</span></td>
	  <td class="row2"><input onchange="setChange();" class="post" type="text" maxlength="9" size="9" name="max_height" value="{MAX_HEIGHT}" /></td>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_PIC_DESC_MAX_LENGTH}</span></td>
	  <td class="row2"><input onchange="setChange();" class="post" type="text" size="6" name="desc_length" value="{PIC_DESC_MAX_LENGTH}" /></td>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_GD_VERSION}</span></td>
	  <td class="row2"><span class="genmed"><input onchange="setChange();" type="radio" {NO_GD} name="gd_version" value="0" />{L_MANUAL_THUMBNAIL}&nbsp;&nbsp;<input onchange="setChange();" type="radio" {GD_V1} name="gd_version" value="1" />GD1&nbsp;&nbsp;<input onchange="setChange();" type="radio" {GD_V2} name="gd_version" value="2" />GD2</span></td>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_JPG_ALLOWED}</span></td>
	  <td class="row2"><span class="genmed"><input onchange="setChange();" type="radio" {JPG_ENABLED} name="jpg_allowed" value="1" />{L_YES}&nbsp;&nbsp;<input onchange="setChange();" type="radio" {JPG_DISABLED} name="jpg_allowed" value="0" />{L_NO}</span></td>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_PNG_ALLOWED}</span></td>
	  <td class="row2"><span class="genmed"><input onchange="setChange();" type="radio" {PNG_ENABLED} name="png_allowed" value="1" />{L_YES}&nbsp;&nbsp;<input onchange="setChange();" type="radio" {PNG_DISABLED} name="png_allowed" value="0" />{L_NO}</span></td>
	</tr>
	<tr>
	  <td class="row1"><span class="genmed">{L_GIF_ALLOWED}</span></td>
	  <td class="row2"><span class="genmed"><input onchange="setChange();" type="radio" {GIF_ENABLED} name="gif_allowed" value="1" />{L_YES}&nbsp;&nbsp;<input onchange="setChange();" type="radio" {GIF_DISABLED} name="gif_allowed" value="0" />{L_NO}</span></td>
	</tr>
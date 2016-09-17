<?php

define('IN_PHPBB', 'true');
$phpbb_root_path = './';

//-----------------------------------------------------------
/* delete >>
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);

$userdata = session_pagestart($user_ip, PAGE_INDEX, $session_length);
init_userprefs($userdata);

<< delete || add >> */

error_reporting  (E_ERROR | E_WARNING | E_PARSE); // This will NOT report uninitialized variables
set_magic_quotes_runtime(0); // Disable magic_quotes_runtime

// PHP5 with register_long_arrays off?
if (@phpversion() >= '5.0.0' && (!@ini_get('register_long_arrays') || @ini_get('register_long_arrays') == '0' || strtolower(@ini_get('register_long_arrays')) == 'off'))
{
	$HTTP_POST_VARS = $_POST;
	$HTTP_GET_VARS = $_GET;
	$HTTP_SERVER_VARS = $_SERVER;
	$HTTP_COOKIE_VARS = $_COOKIE;
	$HTTP_ENV_VARS = $_ENV;
	$HTTP_POST_FILES = $_FILES;

	// _SESSION is the only superglobal which is conditionally set
	if (isset($_SESSION))
	{
		$HTTP_SESSION_VARS = $_SESSION;
	}
}

// Protect against GLOBALS tricks
if (isset($HTTP_POST_VARS['GLOBALS']) || isset($HTTP_POST_FILES['GLOBALS']) || isset($HTTP_GET_VARS['GLOBALS']) || isset($HTTP_COOKIE_VARS['GLOBALS']))
{
	die("Hacking attempt");
}

// Protect against HTTP_SESSION_VARS tricks
if (isset($HTTP_SESSION_VARS) && !is_array($HTTP_SESSION_VARS))
{
	die("Hacking attempt");
}

if (@ini_get('register_globals') == '1' || strtolower(@ini_get('register_globals')) == 'on')
{
	// PHP4+ path
	$not_unset = array('HTTP_GET_VARS', 'HTTP_POST_VARS', 'HTTP_COOKIE_VARS', 'HTTP_SERVER_VARS', 'HTTP_SESSION_VARS', 'HTTP_ENV_VARS', 'HTTP_POST_FILES', 'phpEx', 'phpbb_root_path');
	// Not only will array_merge give a warning if a parameter
	// is not an array, it will actually fail. So we check if
	// HTTP_SESSION_VARS has been initialised.
	if (!isset($HTTP_SESSION_VARS) || !is_array($HTTP_SESSION_VARS))
	{
		$HTTP_SESSION_VARS = array();
	}

	// Merge all into one extremely huge array; unset
	// this later
	$input = array_merge($HTTP_GET_VARS, $HTTP_POST_VARS, $HTTP_COOKIE_VARS, $HTTP_SERVER_VARS, $HTTP_SESSION_VARS, $HTTP_ENV_VARS, $HTTP_POST_FILES);

	unset($input['input']);
	unset($input['not_unset']);

	while (list($var,) = @each($input))
	{
		if (!in_array($var, $not_unset))
		{
			unset($$var);
		}
	} 
   
	unset($input);
}

//
// addslashes to vars if magic_quotes_gpc is off
// this is a security precaution to prevent someone
// trying to break out of a SQL statement.
//
if( !get_magic_quotes_gpc() )
{
	if( is_array($_GET) )
	{
		while( list($k, $v) = each($_GET) )
		{
			if( is_array($_GET[$k]) )
			{
				while( list($k2, $v2) = each($_GET[$k]) )
				{
					$_GET[$k][$k2] = addslashes($v2);
				}
				@reset($_GET[$k]);
			}
			else
			{
				$_GET[$k] = addslashes($v);
			}
		}
		@reset($_GET);
	}

	if( is_array($_POST) )
	{
		while( list($k, $v) = each($_POST) )
		{
			if( is_array($_POST[$k]) )
			{
				while( list($k2, $v2) = each($_POST[$k]) )
				{
					$_POST[$k][$k2] = addslashes($v2);
				}
				@reset($_POST[$k]);
			}
			else
			{
				$_POST[$k] = addslashes($v);
			}
		}
		@reset($_POST);
	}

	if( is_array($HTTP_COOKIE_VARS) )
	{
		while( list($k, $v) = each($HTTP_COOKIE_VARS) )
		{
			if( is_array($HTTP_COOKIE_VARS[$k]) )
			{
				while( list($k2, $v2) = each($HTTP_COOKIE_VARS[$k]) )
				{
					$HTTP_COOKIE_VARS[$k][$k2] = addslashes($v2);
				}
				@reset($HTTP_COOKIE_VARS[$k]);
			}
			else
			{
				$HTTP_COOKIE_VARS[$k] = addslashes($v);
			}
		}
		@reset($HTTP_COOKIE_VARS);
	}
}
/* << add */
//-----------------------------------------------------------

$raute = '#';
$schriftfarbe = $raute.$_GET['fontcolor'];
$schriftdatei = 'arial';
$std_smilie = 1;


$smilie = $_GET['smilie'];
if ( $smilie == 'random')
{
	$smilie = 'random';
}
else if ( $smilie == 'standard')
{
	$smilie = $std_smilie;
}
else
{
	$smilie = intval($smilie);
}

if ( $_GET['shadowcolor'] == '' )
{
	$schattenfarbe = '';
}
else
{
	$schattenfarbe = $raute.$_GET['shadowcolor'];
}

$schildschatten = ( $_GET['shieldshadow'] == '1' ) ? true : false;

$anz_smilie = -1;
$hdl = opendir($phpbb_root_path. 'smilie_creator/images/smilies/schild/');
while($res = readdir($hdl)){
	if(strtolower(substr($res, (strlen($res) - 3), 3)) == 'png') $anz_smilie++;
}
closedir($hdl);


if($phpversion_nr >= 4.30) $gd_info = gd_info();
else{
	$gd_info['FreeType Support'] = 1;
}

if((!$gd_info['FreeType Support']) || (!file_exists($schriftdatei))){
	$schriftwidth = 6;
	$schriftheight = 8;
}else{
	if((!$schriftheight) || (!$schriftwidth)){
		$schriftwidth = imagefontwidth($schriftdatei);
		$schriftheight = imagefontheight($schriftdatei);
	}
}
$schriftheight += 2;


if(!$text) $text = trim($_GET['text']);
$text = stripslashes($text);
$text = str_replace("&lt;",'<',$text);
$text = str_replace("&gt;",'>',$text);
$text = str_replace("&quot;",'"',$text);

while(substr_count($text, '<')){
	$text = @ereg_replace(substr($text, strpos($text, '<'), (strpos($text, '>') - strpos($text, '<') + 1)), "", $text);
}

if(!$text) $text = 'error';//$lang['SC_error']; 

if(strlen($text) > 33){
	$worte = split(" ", $text);

	if(is_array($worte)){
		$i = 0;
		foreach($worte as $wort){
			if((strlen($output[$i].' '.$wort) < 33) && (!substr_count($wort, '[SM'))){
				$output[$i] .= ' '.$wort;
			}else{
				if($i <= 11){
					if($zeichenzahl < strlen($output[$i])) $zeichenzahl = strlen($output[$i]);
					$i++;
					$output[$i] = $wort;
				}
			}
		}
	}else{
		$zeichenzahl = 33;
		$output[0] = substr($text, 0, 30)."...";
	}
}else{
	$zeichenzahl = strlen($text);
	$output[0] = $text;
}

if(count($output) > 12) $output[12] = substr($output[12], 0, 30)."...";

$width = ($zeichenzahl * $schriftwidth) + 6;
$height = (count($output) * $schriftheight) + 34;
if($width < 60) $width = 60;

mt_srand((double)microtime()*3216549);
if($smilie == 'random') $smilie = mt_rand(1,$anz_smilie);
if(!$smilie){
	if($std_smilie) $smilie = $std_smilie;
	else $smilie = mt_rand(1,$anz_smilie);
}


$smilie = imagecreatefrompng($phpbb_root_path . 'smilie_creator/images/smilies/schild/smilie'.$smilie.'.png');
$schild = imagecreatefrompng($phpbb_root_path . 'smilie_creator/images/smilies/schild/schild.png');
$img = imagecreate($width,$height);

$bgcolor = imagecolorallocate ($img, 111, 252, 134);
$txtcolor = imagecolorallocate ($img, hexdec(substr(str_replace('#',"",$schriftfarbe),0,2)), hexdec(substr(str_replace('#',"",$schriftfarbe),2,2)), hexdec(substr(str_replace('#',"",$schriftfarbe),4,2)));
$txt2color = imagecolorallocate ($img, hexdec(substr(str_replace('#',"",$schattenfarbe),0,2)), hexdec(substr(str_replace('#',"",$schattenfarbe),2,2)), hexdec(substr(str_replace('#',"",$schattenfarbe),4,2)));
$bocolor = imagecolorallocate ($img, 0, 0, 0);
$schcolor = imagecolorallocate ($img, 255, 255, 255);
$schatten1color = imagecolorallocate ($img, 235, 235, 235);
$schatten2color = imagecolorallocate ($img, 219, 219, 219);

$smiliefarbe = imagecolorsforindex($smilie, imagecolorat($smilie, 5, 14));

imagesetpixel($schild, 1, 14, imagecolorallocate($schild, ($smiliefarbe['red'] + 52), ($smiliefarbe['green'] + 59), ($smiliefarbe['blue'] + 11)));
imagesetpixel($schild, 2, 14, imagecolorallocate($schild, ($smiliefarbe['red'] + 50), ($smiliefarbe['green'] + 52), ($smiliefarbe['blue'] + 50)));
imagesetpixel($schild, 1, 15, imagecolorallocate($schild, ($smiliefarbe['red'] + 50), ($smiliefarbe['green'] + 52), ($smiliefarbe['blue'] + 50)));
imagesetpixel($schild, 2, 15, imagecolorallocate($schild, ($smiliefarbe['red'] + 22), ($smiliefarbe['green'] + 21), ($smiliefarbe['blue'] + 35)));
imagesetpixel($schild, 1, 16, imagecolorat($smilie, 5, 14));
imagesetpixel($schild, 2, 16, imagecolorat($smilie, 5, 14));
imagesetpixel($schild, 5, 16, imagecolorallocate($schild, ($smiliefarbe['red'] + 22), ($smiliefarbe['green'] + 21), ($smiliefarbe['blue'] + 35)));
imagesetpixel($schild, 6, 16, imagecolorat($smilie, 5, 14));
imagesetpixel($schild, 5, 15, imagecolorallocate($schild, ($smiliefarbe['red'] + 52), ($smiliefarbe['green'] + 59), ($smiliefarbe['blue'] + 11)));
imagesetpixel($schild, 6, 15, imagecolorallocate($schild, ($smiliefarbe['red'] + 50), ($smiliefarbe['green'] + 52), ($smiliefarbe['blue'] + 50)));


imagecopy ($img, $schild, ($width / 2 - 3), 0, 0, 0, 6, 4); // Bildteil kopieren
imagecopy ($img, $schild, ($width / 2 - 3), ($height - 24), 0, 5, 9, 17); // Bildteil kopieren
imagecopy ($img, $smilie, ($width / 2 + 6), ($height - 24), 0, 0, 23, 23); // Bildteil kopieren

imagefilledrectangle($img, 0, 4, $width, ($height - 25), $bocolor);
imagefilledrectangle($img, 1, 5, ($width - 2), ($height - 26), $schcolor);

if($schildschatten){
	imagefilledpolygon($img, array((($width - 2) / 2 + ((($width - 2) / 4) - 3)), 5, (($width - 2) / 2 + ((($width - 2) / 4) + 3)), 5, (($width - 2) / 2 - ((($width - 2) / 4) - 3)), ($height - 26), (($width - 2) / 2 - ((($width - 2) / 4) + 3)), ($height - 26)), 4, $schatten1color);
	imagefilledpolygon($img, array((($width - 2) / 2 + ((($width - 2) / 4) + 4)), 5, ($width - 2), 5, ($width - 2), ($height - 26), (($width - 2) / 2 - ((($width - 2) / 4) - 4)), ($height - 26)), 4, $schatten2color);
}

$i = 0;
while($i < count($output)){
	if(((!$gd_info['FreeType Support']) || (!file_exists($schriftdatei)))){
		if($schattenfarbe) imagestring($img, 2, (($width - (strlen(trim($output[$i])) * $schriftwidth) - 2) / 2 + 1), ($i * $schriftheight + 6), trim($output[$i]), $txt2color);
		imagestring($img, 2, (($width - (strlen(trim($output[$i])) * $schriftwidth) - 2) / 2), ($i * $schriftheight + 5), trim($output[$i]), $txtcolor);
	}else{
		if($schattenfarbe) imagettftext($img, $schriftheight, 0, (($width - (strlen(trim($output[$i])) * $schriftwidth) - 2) / 2 + 1), ($i * $schriftheight + $schriftheight + 4), $txt2color, $schriftdatei, trim($output[$i]));
		imagettftext($img, $schriftheight, 0, (($width - (strlen(trim($output[$i])) * $schriftwidth) - 2) / 2), ($i * $schriftheight + $schriftheight + 3), $txtcolor, $schriftdatei, trim($output[$i]));
	}
	$i++;
}


imagecolortransparent($img, $bgcolor);  // Dummybg als transparenz setzen
imageinterlace($img, 1);

header("Content-Type: image/png");
//imagepng($img,'',100);   // 100 = komprimierung
imagepng($img); 
imagedestroy($img);
imagedestroy($schild);
imagedestroy($smilie);

exit;
?>
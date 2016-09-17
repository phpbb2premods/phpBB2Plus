<?php
/***************************************************************************
 *							lang_admin_captcha.php (german)
 *                         ------------------------
 *   copyright            : (C) 2006 AmigaLink
 *   website              : www.amigalink.de
 *
 ***************************************************************************/ 

$lang['VC_Captcha_Config'] = 'CAPTCHA Konfiguration';
$lang['captcha_config_explain'] = 'Hier kannst du das Aussehen des Bildes bestimmen, das bei aktivierter Visuellen Best�tigung den Registrierungscode anzeigt.';
$lang['captcha_config_explain'] .= '<br />Bedenke bitte das die Lesbarkeit des Best�tigungs-Codes, extrem erschwert oder sogar unm�glich werden kann.';
$lang['VC_active'] = 'Visuelle Best�tigung ist aktiviert!';
$lang['VC_inactive'] = 'Visuelle Best�tigung ist nicht aktiviert!';
$lang['background_configs'] = 'Hintergrund';
$lang['Click_return_captcha_config'] = 'Klick %shier%s um zur CAPTCHA Konfiguartion zur�ckzukehren';

$lang['CAPTCHA_width'] = 'Breite des CAPTCHA';
$lang['CAPTCHA_height'] = 'H�he des CAPTCHA';
$lang['background_color'] = 'Hintergrundfarbe';
$lang['background_color_explain'] = 'Angabe in Hexadezimaler schreibweise (z.B. #0000FF f�r Blau).';
$lang['pre_letters'] = 'Anzahl der Schattenzeichen';
$lang['pre_letters_explain'] = '';
$lang['great_pre_letters'] = 'Schattenzeichen vergr��ern';
$lang['great_pre_letters_explain'] = '';
$lang['Random'] = 'Zuf�llig';
$lang['random_font_per_letter'] = 'Zuf�lliger Schriftsatz pro Zeichen';
$lang['random_font_per_letter_explain'] = 'F�r jedes Zeichen wird ein anderer Schriftsatz benutzt.';

$lang['back_chess'] = 'Schachmuster';
$lang['back_chess_explain'] = 'F�llt den kompletten Hintergrund mit 16 Vierecken.';
$lang['back_ellipses'] = 'Ovale und Kreise';
$lang['back_arcs'] = 'Gebogene Linien';
$lang['back_lines'] = 'Linien';
$lang['back_image'] = 'Hintergrundbild';
$lang['back_image_explain'] = '(Diese Funktion ist derzeitig noch nicht integriert)';

$lang['foreground_lattice'] = 'Vordergrundgitter';
$lang['foreground_lattice_explain'] = '(breite x h�he)<br />Generiert ein Gitter �ber dem CAPTCHA';
$lang['foreground_lattice_color'] = 'Gitterfarbe';
$lang['foreground_lattice_color_explain'] = $lang['background_color_explain'];
$lang['gammacorrect'] = 'Kontrastkorrektur';
$lang['gammacorrect_explain'] = '(0 = aus)<br />ACHTUNG!!! Eine �nderungen des Wertes hat direkte auswirkung auf die Lesbarkeit des CAPTCHA!!';
$lang['generate_jpeg'] = 'Bildformat';
$lang['generate_jpeg_explain'] = 'Das JPEG Format hat eine h�here Kompression als PNG und kann, anhand der Qualit�tseinstellung (max 95%), einen direkten einfluss auf die Lesbarkeit aus�ben.';
$lang['generate_jpeg_quality'] = 'Qualit�t';

?>
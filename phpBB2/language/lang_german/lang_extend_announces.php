<?php
/***************************************************************************
 *						lang_extend_announces.php [English]
 *						-------------------------
 *	begin				: 28/09/2003
 *	copyright			: Ptirhiik
 *	email				: ptirhiik@clanmckeen.com
 *
 *	version				: 1.0.0 - 28/09/2003
 *
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}

// admin part
if ( $lang_extend_admin )
{
	$lang['Lang_extend_announces'] = 'Announces Suite';
}

$lang['Board_announcement']						= 'Board Ank�ndigungen';
$lang['announcement_duration']					= 'Dauer der Ank�ndigung';
$lang['announcement_duration_explain']			= 'Anzahl Tage, die die Ank�ndigung dauert. Setze -1 f�r eine dauerhafte Ank�ndigung';
$lang['Announce_settings']						= 'Ank�ndigungen';
$lang['announcement_date_display']				= 'Zeige Datum der Ank�ndigung';
$lang['announcement_display']					= 'Zeige Board Ank�ndigungen im Index';
$lang['announcement_display_forum']				= 'Zeige Board Ank�ndigungen im Forum';
$lang['announcement_split']						= 'Teile den Ank�ndigungstyp in der Board Ank�ndigungsbox';
$lang['announcement_forum']						= 'Zeige den Forennamen unter dem Ank�ndigungstitel in der Board Ank�ndigungsbox';
$lang['announcement_prune_strategy']			= 'Strategie zum l�schen der Ank�ndigungen';
$lang['announcement_prune_strategy_explain']	= 'Das ist der Typ des Ank�ndigungsthemas nach der automatischen L�schung';

$lang['Global_announce']						= 'Globale Ank�ndigung';
$lang['Sorry_auth_global_announce']				= 'Sorry, aber nur %s k�nnen in diesem Forum Globale Ank�ndigungen posten.';
$lang['Post_Global_Announcement']				= 'Globale Ank�ndigung';
$lang['Topic_Global_Announcement']				= '<b>Globale Ank�ndigung:</b>';

$lang['Announces_from_to']						= '(vom %s bis %s)';

?>
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

$lang['Board_announcement']						= 'Board Ankündigungen';
$lang['announcement_duration']					= 'Dauer der Ankündigung';
$lang['announcement_duration_explain']			= 'Anzahl Tage, die die Ankündigung dauert. Setze -1 für eine dauerhafte Ankündigung';
$lang['Announce_settings']						= 'Ankündigungen';
$lang['announcement_date_display']				= 'Zeige Datum der Ankündigung';
$lang['announcement_display']					= 'Zeige Board Ankündigungen im Index';
$lang['announcement_display_forum']				= 'Zeige Board Ankündigungen im Forum';
$lang['announcement_split']						= 'Teile den Ankündigungstyp in der Board Ankündigungsbox';
$lang['announcement_forum']						= 'Zeige den Forennamen unter dem Ankündigungstitel in der Board Ankündigungsbox';
$lang['announcement_prune_strategy']			= 'Strategie zum löschen der Ankündigungen';
$lang['announcement_prune_strategy_explain']	= 'Das ist der Typ des Ankündigungsthemas nach der automatischen Löschung';

$lang['Global_announce']						= 'Globale Ankündigung';
$lang['Sorry_auth_global_announce']				= 'Sorry, aber nur %s können in diesem Forum Globale Ankündigungen posten.';
$lang['Post_Global_Announcement']				= 'Globale Ankündigung';
$lang['Topic_Global_Announcement']				= '<b>Globale Ankündigung:</b>';

$lang['Announces_from_to']						= '(vom %s bis %s)';

?>
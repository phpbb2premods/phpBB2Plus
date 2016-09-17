<?php
/***************************************************************************
 *						lang_extend_topic_calendar.php [English]
 *						------------------------------
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
	$lang['Lang_extend_topic_calendar'] = 'Topic Kalender';
}

$lang['Calendar']				= 'Kalender';
$lang['Calendar_scheduler']		= 'Planer';
$lang['Calendar_event']			= 'Kalender Termin';
$lang['Calendar_from_to']		= 'Vom %s bis %s';
$lang['Calendar_time']			= '%s';
$lang['Calendar_duration']		= 'Dauer';

$lang['Calendar_settings']		= 'Kalender Einstellungen';
$lang['Calendar_week_start']	= 'Erster Wochentag';
$lang['Calendar_header_cells']	= 'Anzahl der Zellen die im Board Header angezeigt werden (0 für keine Anzeige)';
$lang['Calendar_title_length']	= 'Länge des Titels welcher in den Kalender Zellen angezeigt wird';
$lang['Calendar_text_length']	= 'Länge des Textes, welcher im Übersichtsfenster angezeigt wird';


$lang['Calendar_display_open']	= 'Zeige die Kalender Reihe im Board Index geöffnet';
$lang['Calendar_nb_row']		= 'Anzahl der Reihen pro Tag im Board Header';
$lang['Calendar_birthday']		= 'Zeige Geburtstage im Kalendar an';
$lang['Calendar_forum']			= 'Den Namen des Forums unter dem Thematitel im Planer anschlagen';

$lang['Sorry_auth_cal']			= 'Sorry, nur %s kann in diesem Forum Termine im Kalender eintragen.';
$lang['Date_error']				= '%d/%d/%d ist kein gültiges Datum';

$lang['Event_time']				= 'Termin Zeit';
$lang['Minutes']				= 'Minuten';
$lang['Today']					= 'Heute';
$lang['All_events']				= 'Alle Ereignisse';

$lang['Rules_calendar_can']		= 'Du <b>kannst</b> Ereignisse des Kalender in diesem Forum postieren';
$lang['Rules_calendar_cannot']	= 'Du <b>kannst keine</b> Ereignisse des Kalender in diesem Forum postieren';

$lang['birthday_header']   = 'Herzlichen Glückwunsch zum Geburtstag!'; 
$lang['birthday']   = '<b>%s</b> hat heute Geburtstag!'; 
?>
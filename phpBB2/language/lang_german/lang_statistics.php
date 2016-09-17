<?php
/***************************************************************************
*                           lang_statistics.php [German]
*                            -------------------
*   begin                : Wed, Sep 04 2002
*   copyright            : (C) 2002 Meik Sievertsen
*   email                : acyd.burn@gmx.de
*
*   $Id: lang_statistics.php,v 1.3 2002/11/10 21:45:43 acydburn Exp $
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

// Original Statistics Mod (c) 2002 Nivisec - http://nivisec.com/mods

//
// If you want to credit the Author on the Statistics Page, uncomment the second line.
//
$lang['Version_info'] = '<br />Statistik Mod Version %s'; //%s = number
//$lang['Version_info'] = '<br />Statistik Mod Version %s &copy; 2002 <a href="http://www.opentools.de/board">Acyd Burn</a>';

//
// These Language Variables are available for all installed Modules
//
$lang['Rank'] = 'Rang';
$lang['Percent'] = 'Prozent';
$lang['Graph'] = 'Balken';
$lang['Uses'] = 'Anzahl';
$lang['How_many'] = 'Wie viele';

//
// Main Language
//

//
// Page Header/Footer
//
$lang['Install_info'] = 'Installiert am %s'; //%s = date
$lang['Viewed_info'] = 'Statistik Seite wurde %d mal geladen'; //%d = number
$lang['Statistics_title'] = 'Board Statistiken';

//
// Admin Language
//
$lang['Statistics_management'] = 'Statistik Module';
$lang['Statistics_config'] = 'Statistik Konfiguration';

//
// Statistics Config
//
$lang['Statistics_config_title'] = 'Statistik Konfiguration';

$lang['Return_limit'] = 'Rückgabelimit';
$lang['Return_limit_desc'] = 'Die Anzahl der Punkte die in jedem Ranking enthalten sind. Diese Variable ist in jedem Modul verfügbar.';
$lang['Clear_cache'] = 'Modul Cache leeren';
$lang['Clear_cache_desc'] = 'Leert die vorgehaltenen gecachten Daten aller Module';
$lang['Modules_directory'] = 'Modulverzeichnis';
$lang['Modules_directory_desc'] = 'Das Verzeichnis relativ zu deinem phpBB Verzeichnis, in dem die Module gespeichert werden. Es ist nicht erlaubt, / oder \ im Pfad zu benutzen.';

//
// Status Messages
//
$lang['Messages'] = 'Admin Nachrichten';
$lang['Updated'] = 'Aktualisiert';
$lang['Active'] = 'Aktiv';
$lang['Activate'] = 'Aktivieren';
$lang['Activated'] = 'Aktiviert';
$lang['Not_active'] = 'Nicht Aktiv';
$lang['Deactivate'] = 'Deaktivieren';
$lang['Deactivated'] = 'Deaktiviert';
$lang['Install'] = 'Installieren';
$lang['Installed'] = 'Installiert';
$lang['Uninstall'] = 'Deinstallieren';
$lang['Uninstalled'] = 'Deinstalliert';
$lang['Move_up'] = 'Einen Eintrag hoch';
$lang['Move_down'] = 'Einen Eintrag runter';
$lang['Update_time'] = 'Update Zeit';
$lang['Auth_settings_updated'] = 'Berechtigungen - [Diese werden immer aktualisiert]';

//
// Modules Management
//
$lang['Back_to_management'] = 'Zurück zur Modul Konfiguration';
$lang['Statistics_modules_title'] = 'Statistik Modul Verwaltung';

$lang['Module_name'] = 'Name';
$lang['Directory_name'] = 'Verzeichnisname';
$lang['Status'] = 'Status';
$lang['Update_time_minutes'] = 'Update Zeit in Minuten';
$lang['Update_time_desc'] = 'Zeitintervall (in Minuten) bis zum Neuladen der Daten aus dem Modul. D.h. in der eingestellten Zeit werden die gecachten Daten zum Anzeigen genommen.';
$lang['Auto_set_update_time'] = 'Ermittle und setze die vorgeschlagenen Update Zeiten für jedes Installierte (und Aktive) Modul. Bitte Beachte: Das kann etwas länger dauern.';
$lang['Uninstall_module'] = 'Modul deinstallieren';
$lang['Uninstall_module_desc'] = 'Markiert das Modul als "nicht installiert", so das es möglich ist das Modul noch einmal zu installieren. Es löscht das Modul nicht von der Festplatte, du musst das Modul Verzeichnis löschen um das Modul komplett zu deinstallieren.';
$lang['Active_desc'] = 'Option, ob das Modul aktiv ist oder nicht. Im aktiviertem Zustand wird das Modul in abhängigkeit der Berechtigungen in den Statistiken angezeigt.';
$lang['Go'] = 'Los';

$lang['Not_allowed_to_install'] = 'Dieses Modul kann nicht installiert werden. Meistens deshalb nicht, weil das Modul ein Mod benötigt, welches du nicht installiert hast. Bitte kontaktiere den Autoren des Moduls falls du weitere Fragen hast oder wenn die obigen Informationen nicht ausreichen.';
$lang['Wrong_stats_mod_version'] = 'Dieses Modul kann nicht installiert werden, da es eine höhere Statistik Mod Version benötigt. Um dieses Modul ordnungsgemäß ausführen zu können benötigst du mindestens eine Statistik Mod Version %s.'; // replace %s with Version (2.1.3 for example)
$lang['Module_install_error'] = 'Es ist ein Fehler beim Installieren des Moduls aufgetreten. Bitte prüfe die obigen Ausgaben auf Fehler und kontaktiere den Modul Autoren.';

$lang['Preview_debug_info'] = 'Dieses Modul wurde in %f Sekunden generiert: %d queries wurden ausgeführt.'; // Replace %f with seconds and %d with queries
$lang['Update_time_recommend'] = 'Das Statistik Mod schlägt (auf Basis der Debug Informationen) eine Update Zeit von <b>%d</b> Minuten vor.'; // Replace %d with Minutes

?>
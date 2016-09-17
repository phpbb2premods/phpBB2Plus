<?php
/***************************************************************************
*                            $RCSfile: lang_color_groups.php,v $
*                            -------------------
*   copyright            : (C) 2003 Nivisec.com
*   email                : support@nivisec.com
*
*   $Id: lang_color_groups.php,v 1.3 2003/09/03 02:52:47 nivisec Exp $
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

$lang['Color_Groups'] = 'Farbgruppen';
$lang['Manage_Color_Groups'] = 'Farbgruppen Einstellungen';
$lang['Add_New_Group'] = 'Neue Gruppe hinzuf�gen';
$lang['Status'] = 'Status';
$lang['Color'] = 'Farbe';
$lang['User_Count'] = 'Useranzahl';
$lang['Color_List'] = 'Liste der Farbnamen:';
$lang['Group_Name'] = 'Gruppenname';
$lang['Define_Users'] = 'User definieren';
$lang['Color_Group_User_List'] = 'Userliste der Farbgruppe';
$lang['Options'] = 'Optionen';
$lang['Example'] = 'Beispiel';
$lang['Version'] = 'Version';
$lang['User_List'] = 'komplette Userliste';
$lang['Unassigned_User_List'] = 'User ohne Gruppe';
$lang['Assigned_User_List'] = 'User mit Gruppe';
$lang['Add_Arrow'] = 'der Liste hinzuf�gen';
$lang['Update'] = 'Update';
$lang['Updated_Group'] = 'Usergruppenliste aktualisiert<br />';
$lang['Delete'] = 'L�schen';
$lang['Deleted_Group'] = 'Gruppe gel�scht. Alle User in dieser Gruppe wurden zur�ckgestuft.<br />';
$lang['Hide'] = 'Verstecken';
$lang['Un-hide'] = 'Nicht Verstecken';
$lang['Move_Up'] = 'nach oben verschieben';
$lang['Move_Down'] = 'nach unten verschieben';
$lang['Group_Hidden'] = 'Gruppe versteckt<br />';
$lang['Group_Unhidden'] = 'Gruppe nicht versteckt<br />';
$lang['Groups_Updated'] = 'Gruppen�nderung wurde �bernommen.<br />';
$lang['Moved_Group'] = 'Gruppenanordnung verschoben<br />';

//Beschreibungen
$lang['Manage_Color_Groups_Desc'] = 'Aktualisiert Gruppen, f�gte neue Gruppen hinzu oder verwaltet User, die einer Gruppe angeh�ren.<br />Gruppen, die als <b>versteckt</b> markiert sind, werden nicht auf der Indexliste angezeigt.';
$lang['Color_Group_User_List_Desc'] = 'User einer Gruppe hinzuf�gen oder aus dieser entfernen.';

//Fehler
$lang['Error_Group_Table'] = 'Fehler beim Zugriff auf Farbgruppen-Tabelle.';
$lang['Error_Font_Color'] = '<b><u>Warnung:</b></u> Die ausgew�hlte Schriftfarbe scheint ung�ltig zu sein!';
$lang['Color_Ok'] = 'Die ausgew�hlte Schriftfarbe scheint in Ordnung zu sein.';
$lang['No_Groups_Exist'] = 'Es existieren keine Gruppen.';
$lang['Error_Users_Table'] = 'Fehler beim Zugriff auf die User-Tabelle.';
$lang['Invalid_Group_Add'] = '%s ist ein ung�ltiger oder schon vorhandener Gruppenname.<br />';

//Dynamisch
$lang['Group_Updated'] = 'Farbgruppe %s aktualisiert<br />';
$lang['Editing_Group'] = 'Momentane Userliste f�r %s.';
$lang['Invalid_User'] = '%s ist ein ung�ltiger Username<br>';
$lang['Invalid_Order_Num'] = '%s beinhaltete eine ung�ltige Anordnungsnummer, aber es wurde behoben. Bitte versuche es erneut.';

//Neu f�r 1.2.0
$lang['Users_List'] = 'Userliste';
$lang['Groups_List'] = 'Usergruppenliste';
$lang['List_Info'] = '<b>Notizen</b>: <ul><li>Um mehrere Namen auszuw�hlen, halte CTRL gedr�ckt. <li>Wenn ein User einer Usergruppe angeh�rt und einer bestimmten Farbgruppe zugeteilt wird, so wird die Farbgruppe, die den User beinhaltet genutzt (nicht die Farbgruppe der Usergruppe).<li>Die Listen sind aufgeteilt in NAME (JEWEILIGE_FARB_GRUPPE). Wenn ein Eintrag keiner Farbgruppe zugeordnet ist, wird (JEWEILIGE_FARBGRUPPE) nicht angezeigt.<li>Wenn ein User zwei oder mehreren Usergruppen angeh�rt, wird die h�chstrangige Farbgruppe zugeordnet (die Abfolge kann auf der Hauptseite angepasst werden).</ul>';
?>
<?php
/***************************************************************************
 *                            lang_admin_album.php [German]
 *                              -------------------
 *     begin                : Sunday, February 02, 2003
 *     copyright            : (C) 2003 Smartor
 *     email                : smartor_xp@hotmail.com
 *     creator		    : http://www.phpbb2.de
 *
 *     $Id: lang_admin_album.php,v 1.0.6 2003/03/05 00:21:55 ngoctu Exp $
 *
 ****************************************************************************/

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
   die('Hacking attempt');
   exit;
}

//--- Album Category Hierarchy : begin
//--- version : 1.10
include($phpbb_root_path.'language/lang_german/lang_hierarchy_album.' . $phpEx);
//--- Album Category Hierarchy : end

//
// Configuration
//

$lang['Album_config'] = 'Album Konfiguration';
$lang['Album_config_explain'] = 'Du kannst hier die allgemeinen Einstellungen von Deinem Photo Album �ndern';
$lang['Album_config_updated'] = 'Die Album-Konfiguration ist erfolgreich ge�ndert worden';
$lang['Click_return_album_config'] = 'Klicke %shier%s um zur Album Konfiguration zur�ckzukehren';
$lang['Max_pics'] = 'Max. Anzahl an Bildern f�r all Deine Photo Alben (-1 = unendlich)';
$lang['User_pics_limit'] = 'Max. Anzahl der Bilder pro Kategorie f�r jeden Benutzer (-1 = unendlich)';
$lang['Moderator_pics_limit'] = 'Max. Anzahl der Bilder je Moderator (-1 = unendlich)';
$lang['Pics_Approval'] = 'Bilder-Zulassung';
$lang['Rows_per_page'] = 'Anzahl der Reihen auf der Vorschauseite';
$lang['Cols_per_page'] = 'Anzahl der Spalten auf der Vorschauseite';
$lang['Thumbnail_quality'] = 'Vorschau Qualit�t (1-100)';
$lang['Thumbnail_cache'] = 'Vorschau Cache';
$lang['Manual_thumbnail'] = 'Manuelle Vorschau';
$lang['GD_version'] = 'Optimierung f�r die GD Version';
$lang['Pic_Desc_Max_Length'] = 'Max. L�nge der Beschreibung/des Kommentars (Bytes)';
$lang['Hotlink_prevent'] = 'Hotlink nicht erlauben';
$lang['Hotlink_allowed'] = 'Erlaubte Domains f�r Hotlinks (durch Kommata abtrennen)';
$lang['Personal_gallery'] = 'Pers�nliches Album f�r jeden Benuter freigeben';
$lang['Personal_gallery_limit'] = 'Max. Anzahl an Bildern f�r jedes Pers�nliche Album';
$lang['Personal_gallery_view'] = 'Wer kann sich die pers�nlichen Alben per Default anschauen?';
$lang['Rate_system'] = 'Aktivieren des Bewertungssystems';
$lang['Rate_Scale'] =' Rating Skala';
$lang['Comment_system'] = 'Aktivieren des Kommentarsystems';
$lang['Thumbnail_Settings'] = 'Vorschau-Einstellungen';
$lang['Extra_Settings'] = 'Extra-Einstellungen';
$lang['Default_Sort_Method'] = 'Standard-Sortier-Methode';
$lang['Default_Sort_Order'] = 'Standard-Sortier-Reihenfolge';
$lang['Fullpic_Popup'] = 'Ganzes Bild in eigenem Popup-Fenster ansehen';


// Personal Gallery Page
$lang['Album_personal_gallery_title'] = 'Pers�nliche Galerie';
$lang['Album_personal_gallery_explain'] = 'Auf dieser Seite kannst Du ausw�hlen, welche Gruppen sich dieses Pers�nliche Album anschauen d�rfen';
$lang['Album_personal_successfully'] = 'Die Einstellung wurde erfolgreich ge�ndert';
$lang['Click_return_album_personal'] = 'Klicke bitte %shier%s um zu den Pers�nlichen Alben Einstellungen zur�ckzukehren';

//
// Categories
//
$lang['Album_Categories_Title'] = 'Album Kategorie Konfiguration';
$lang['Album_Categories_Explain'] = 'Auf dieser Seite kannst Du die Kategorieeinstellungen vornehmen: Erstellen, bearbeiten, l�schen, sortieren etc.';
$lang['Category_Permissions'] = 'Kategorie Erlaubnisse';
$lang['Category_Title'] = 'Kategorie Titel';
$lang['Category_Desc'] = 'Kategorie Beschreibung';
$lang['View_level'] = 'Welche Benutzer d�rfen sich Bilder anschauen';
$lang['Upload_level'] = 'Welche Benutzer d�rfen Bilder hochladen';
$lang['Rate_level'] = 'Welche Benutzer d�rfen Bilder bewerten';
$lang['Comment_level'] = 'Welche Benutzer d�rfen Bilder kommentieren';
$lang['Edit_level'] = 'Welche Benutzer d�rfen Bilder bearbeiten';
$lang['Delete_level'] = 'Welche Benutzer d�rfen Bilder l�schen';
$lang['New_category_created'] = 'Die neue Kategorie ist erfolgreich erstellt worden';
$lang['Click_return_album_category'] = 'Klicke bitte %shier%s um zur Album Kategorie Einstellung zur�ckzukehren';
$lang['Category_updated'] = 'Die Kategorie ist erfolgreich ge�ndert worden';
$lang['Delete_Category'] = 'Kategorie l�schen';
$lang['Delete_Category_Explain'] = 'Die nachfolgenden Einstellungen erlauben es Dir eine Kategorie zu l�schen und zu entscheiden, was mit den darin enthaltenen Bildern passieren soll';
$lang['Delete_all_pics'] = 'Alle Bilder l�schen';
$lang['Category_deleted'] = 'Diese Kategorie ist erfolgreich gel�scht worden';
$lang['Category_changed_order'] = 'Diese Kategorie ist erfolgreich ge�ndert worden';

//
// Permissions
//
$lang['Album_Auth_Title'] = 'Album-Zugriffsrechte';
$lang['Album_Auth_Explain'] = 'Hier kannst du ausw�hlen, welche Benutzergruppe(n) Moderator f�r die jeweilige Album-Kategorie sein soll(en) oder nur den Privatzugriff regeln.';
$lang['Select_a_Category'] = 'Kategorie ausw�hlen';
$lang['Look_up_Category'] = 'Kategorie suchen';
$lang['Album_Auth_successfully'] = 'Zugriffsrechte wurden erfolgreicht aktualisiert';
$lang['Click_return_album_auth'] = 'Klicke %shier%s um zu den Album-Zugriffsrechten zur�ckzukehren.';

$lang['Upload'] = 'Upload';
$lang['Rate'] = 'Bewertung';
$lang['Comment'] = 'Kommentar';

//
// Clear Cache
//
$lang['Clear_Cache'] = 'Cache l�schen';
$lang['Album_clear_cache_confirm'] = 'Wenn Du das Vorschau-Cache-Feature benutzt, mu�t Du den Cache l�schen, nachdem du die Vorschau-Einstellungen in der Album-Konfiguration ge�ndert hast - erst dann wird der Cache wiederhergestellt.<br /><br /> Willst Du den Cache jetzt l�schen?';
$lang['Thumbnail_cache_cleared_successfully'] = '<br />Der Vorschau-Cache wurde erfolgreich gel�scht.<br /><br />';

?>
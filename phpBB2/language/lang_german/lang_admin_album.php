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
$lang['Album_config_explain'] = 'Du kannst hier die allgemeinen Einstellungen von Deinem Photo Album ändern';
$lang['Album_config_updated'] = 'Die Album-Konfiguration ist erfolgreich geändert worden';
$lang['Click_return_album_config'] = 'Klicke %shier%s um zur Album Konfiguration zurückzukehren';
$lang['Max_pics'] = 'Max. Anzahl an Bildern für all Deine Photo Alben (-1 = unendlich)';
$lang['User_pics_limit'] = 'Max. Anzahl der Bilder pro Kategorie für jeden Benutzer (-1 = unendlich)';
$lang['Moderator_pics_limit'] = 'Max. Anzahl der Bilder je Moderator (-1 = unendlich)';
$lang['Pics_Approval'] = 'Bilder-Zulassung';
$lang['Rows_per_page'] = 'Anzahl der Reihen auf der Vorschauseite';
$lang['Cols_per_page'] = 'Anzahl der Spalten auf der Vorschauseite';
$lang['Thumbnail_quality'] = 'Vorschau Qualität (1-100)';
$lang['Thumbnail_cache'] = 'Vorschau Cache';
$lang['Manual_thumbnail'] = 'Manuelle Vorschau';
$lang['GD_version'] = 'Optimierung für die GD Version';
$lang['Pic_Desc_Max_Length'] = 'Max. Länge der Beschreibung/des Kommentars (Bytes)';
$lang['Hotlink_prevent'] = 'Hotlink nicht erlauben';
$lang['Hotlink_allowed'] = 'Erlaubte Domains für Hotlinks (durch Kommata abtrennen)';
$lang['Personal_gallery'] = 'Persönliches Album für jeden Benuter freigeben';
$lang['Personal_gallery_limit'] = 'Max. Anzahl an Bildern für jedes Persönliche Album';
$lang['Personal_gallery_view'] = 'Wer kann sich die persönlichen Alben per Default anschauen?';
$lang['Rate_system'] = 'Aktivieren des Bewertungssystems';
$lang['Rate_Scale'] =' Rating Skala';
$lang['Comment_system'] = 'Aktivieren des Kommentarsystems';
$lang['Thumbnail_Settings'] = 'Vorschau-Einstellungen';
$lang['Extra_Settings'] = 'Extra-Einstellungen';
$lang['Default_Sort_Method'] = 'Standard-Sortier-Methode';
$lang['Default_Sort_Order'] = 'Standard-Sortier-Reihenfolge';
$lang['Fullpic_Popup'] = 'Ganzes Bild in eigenem Popup-Fenster ansehen';


// Personal Gallery Page
$lang['Album_personal_gallery_title'] = 'Persönliche Galerie';
$lang['Album_personal_gallery_explain'] = 'Auf dieser Seite kannst Du auswählen, welche Gruppen sich dieses Persönliche Album anschauen dürfen';
$lang['Album_personal_successfully'] = 'Die Einstellung wurde erfolgreich geändert';
$lang['Click_return_album_personal'] = 'Klicke bitte %shier%s um zu den Persönlichen Alben Einstellungen zurückzukehren';

//
// Categories
//
$lang['Album_Categories_Title'] = 'Album Kategorie Konfiguration';
$lang['Album_Categories_Explain'] = 'Auf dieser Seite kannst Du die Kategorieeinstellungen vornehmen: Erstellen, bearbeiten, löschen, sortieren etc.';
$lang['Category_Permissions'] = 'Kategorie Erlaubnisse';
$lang['Category_Title'] = 'Kategorie Titel';
$lang['Category_Desc'] = 'Kategorie Beschreibung';
$lang['View_level'] = 'Welche Benutzer dürfen sich Bilder anschauen';
$lang['Upload_level'] = 'Welche Benutzer dürfen Bilder hochladen';
$lang['Rate_level'] = 'Welche Benutzer dürfen Bilder bewerten';
$lang['Comment_level'] = 'Welche Benutzer dürfen Bilder kommentieren';
$lang['Edit_level'] = 'Welche Benutzer dürfen Bilder bearbeiten';
$lang['Delete_level'] = 'Welche Benutzer dürfen Bilder löschen';
$lang['New_category_created'] = 'Die neue Kategorie ist erfolgreich erstellt worden';
$lang['Click_return_album_category'] = 'Klicke bitte %shier%s um zur Album Kategorie Einstellung zurückzukehren';
$lang['Category_updated'] = 'Die Kategorie ist erfolgreich geändert worden';
$lang['Delete_Category'] = 'Kategorie löschen';
$lang['Delete_Category_Explain'] = 'Die nachfolgenden Einstellungen erlauben es Dir eine Kategorie zu löschen und zu entscheiden, was mit den darin enthaltenen Bildern passieren soll';
$lang['Delete_all_pics'] = 'Alle Bilder löschen';
$lang['Category_deleted'] = 'Diese Kategorie ist erfolgreich gelöscht worden';
$lang['Category_changed_order'] = 'Diese Kategorie ist erfolgreich geändert worden';

//
// Permissions
//
$lang['Album_Auth_Title'] = 'Album-Zugriffsrechte';
$lang['Album_Auth_Explain'] = 'Hier kannst du auswählen, welche Benutzergruppe(n) Moderator für die jeweilige Album-Kategorie sein soll(en) oder nur den Privatzugriff regeln.';
$lang['Select_a_Category'] = 'Kategorie auswählen';
$lang['Look_up_Category'] = 'Kategorie suchen';
$lang['Album_Auth_successfully'] = 'Zugriffsrechte wurden erfolgreicht aktualisiert';
$lang['Click_return_album_auth'] = 'Klicke %shier%s um zu den Album-Zugriffsrechten zurückzukehren.';

$lang['Upload'] = 'Upload';
$lang['Rate'] = 'Bewertung';
$lang['Comment'] = 'Kommentar';

//
// Clear Cache
//
$lang['Clear_Cache'] = 'Cache löschen';
$lang['Album_clear_cache_confirm'] = 'Wenn Du das Vorschau-Cache-Feature benutzt, mußt Du den Cache löschen, nachdem du die Vorschau-Einstellungen in der Album-Konfiguration geändert hast - erst dann wird der Cache wiederhergestellt.<br /><br /> Willst Du den Cache jetzt löschen?';
$lang['Thumbnail_cache_cleared_successfully'] = '<br />Der Vorschau-Cache wurde erfolgreich gelöscht.<br /><br />';

?>
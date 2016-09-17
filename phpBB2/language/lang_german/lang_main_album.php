<?php
/***************************************************************************
 *                          lang_main_album.php [English]
 *                              -------------------
 *     begin                : Sunday, February 02, 2003
 *     copyright            : (C) 2003 Smartor
 *     email                : smartor_xp@hotmail.com
 *
 *     $Id: lang_main_album.php,v 1.0.6 2003/03/05 20:12:38 ngoctu Exp $
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
// Album Index
//
$lang['Photo_Album'] = 'Photo Album';
$lang['Pics'] = 'Bilder'; 
$lang['Last_Pic'] = 'Letztes Bild'; 
$lang['Public_Categories'] = 'Öffentliche Kategorien'; 
$lang['No_Pics'] = 'Keine Bilder'; 
$lang['Users_Personal_Galleries'] = 'Persönliche Galerien'; 
$lang['Your_Personal_Gallery'] = 'Deine persönliche Galerie'; 
$lang['Recent_Public_Pics'] = 'Neue Öffentliche Bilder'; 
$lang['Highest_Rated_Pics'] = 'Top bewertete Bilder';
$lang['Random_Pics'] = 'Zufällige Bilder';

$lang['View'] = 'Aufrufe'; 

//
// Category View
//
$lang['Category_not_exist'] = 'Diese Kategorie existiert nicht'; 
$lang['Upload_Pic'] = 'Bild hochladen'; 
$lang['Pic_Title'] = 'Titel'; 

$lang['Album_upload_can'] = 'Du <b>kannst</b> neue Bilder in dieser Kategorie hochladen'; 
$lang['Album_upload_cannot'] = 'Du kannst <b>keine</b> neuen Bilder in dieser Kategorie hochladen'; 
$lang['Album_rate_can'] = 'Du <b>kannst</b> Bilder in dieser Kategorie bewerten'; 
$lang['Album_rate_cannot'] = 'Du kannst <b>keine</b> Bilder in dieser Kategorie bewerten'; 
$lang['Album_comment_can'] = 'Du <b>kannst</b> Kommentare zu diesem Bilder in der Kategorie schreiben'; 
$lang['Album_comment_cannot'] = 'Du kannst <b>keine</b> Kommentare zu diesem Bilder in der Kategorie schreiben'; 
$lang['Album_edit_can'] = 'Du <b>kannst</b> Bilder editieren und Kommentare dazu erstellen in dieser Kategorie'; 
$lang['Album_edit_cannot'] = 'Du kannst <b>keine</b> Bilder editieren und Kommentare dazu erstellen in dieser Kategorie'; 
$lang['Album_delete_can'] = 'Du <b>kannst</b> Bilder löschen und kommentieren in dieser Kategorie'; 
$lang['Album_delete_cannot'] = 'Du kannst<b>keine</b> Bilder löschen und kommentieren in dieser Kategorie'; 
$lang['Album_moderate_can'] = 'Du <b>kannst</b> diese Kategorie %smoderieren%s'; 

$lang['Edit_pic'] = 'Bearbeiten'; 
$lang['Delete_pic'] = 'Löschen'; 
$lang['Rating'] = 'Bewertung'; 
$lang['Comments'] = 'Kommentare'; 
$lang['New_Comment'] = 'Neuer Kommentar'; 

$lang['Not_rated'] = '<i>nicht bewertet</i>'; 

//
// Upload
//
$lang['Pic_Desc'] = 'Bild-Beschreibung'; 
$lang['Plain_text_only'] = 'nur reiner Text'; 
$lang['Max_length'] = 'Max. Länge (bytes)'; 
$lang['Upload_pic_from_machine'] = 'Bild von Deinem Computer hochladen'; 
$lang['Upload_to_Category'] = 'In Kategorie hochladen'; 
$lang['Upload_thumbnail_from_machine'] = 'Vorschaubild von Deinem Computer hochladen (muss der selbe Typ wie Dein Bild sein)'; 
$lang['Upload_thumbnail'] = 'Vorschaubild hochladen';
$lang['Upload_thumbnail_explain'] = 'Es muss der gleiche Dateityp wie Dein Bild sein';
$lang['Thumbnail_size'] = 'Vorschau-Größe (Pixel)'; 
$lang['Filetype_and_thumbtype_do_not_match'] = 'Dein Bild und das Vorschaubild müssen vom selben Typ sein!'; 

$lang['Upload_no_title'] = 'Du mußt einen Titel für Dein Bild angeben!'; 
$lang['Upload_no_file'] = 'Du mußt einen Pfad und den Dateinamen angeben!'; 
$lang['Desc_too_long'] = 'Deine Beschreibung des Bildes ist zu lang!'; 

$lang['Max_file_size'] = 'Max. Dateigröße (bytes)'; 
$lang['Max_width'] = 'Max. Bilderbreite (pixel)'; 
$lang['Max_height'] = 'Max. Bilderhöhe(pixel)'; 

$lang['JPG_allowed'] = 'Erlaubnis JPG Dateien hochzuladen'; 
$lang['PNG_allowed'] = 'Erlaubnis PNG Dateien hochzuladen'; 
$lang['GIF_allowed'] = 'Erlaubnis GIF Dateien hochzuladen'; 

$lang['Album_reached_quota'] = 'Das System hat die Grenze der Bilder erreicht. Du kannst nun keine mehr hochladen. Bitte benachrichtige den Administrator für mehr Informationen'; 
$lang['User_reached_pics_quota'] = 'Du hast die Grenze der hochzuladenen Bilder erreicht. Du kannst nun keine mehr hochladen. Bitte benachrichtige den Administrator für mehr Informationen'; 

$lang['Bad_upload_file_size'] = 'Dein hochzuladenes Bild ist zu groß oder die Datei ist beschädigt'; 
$lang['Not_allowed_file_type'] = 'Deine Dateiendung ist hier nicht erlaubt'; 
$lang['Upload_image_size_too_big'] = 'Die Abmessungen Deines Bildes sind zu groß!'; 
$lang['Upload_thumbnail_size_too_big'] = 'Die Abmessungen des Vorschau-Bildes sind zu groß!'; 

$lang['Missed_pic_title'] = 'Du mußt Deinen Bildtitel eintragen'; 

$lang['Album_upload_successful'] = 'Dein Bild wurde erfolgreich hochgeladen'; 
$lang['Album_upload_need_approval'] = 'Dein Bild wurde erfolgreich hochgeladen<br /><br />Sobald ein Administrator oder Moderator das Bild akzeptiert hat, wird es freigeschaltet'; 
$lang['Click_return_category'] = 'Klicke bitte %shier%s um zur Kategorie zurückzukehren'; 
$lang['Click_return_album_index'] = 'Klicke bitte %shier%s um zum Album Index zurückzukehren'; 

// View Pic
$lang['Pic_not_exist'] = 'Das Bild existiert nicht'; 

// Edit Pic
$lang['Edit_Pic_Info'] = 'Bilder Informationen bearbeiten'; 
$lang['Pics_updated_successfully'] = 'Deine Bilder Informationen sind erfolgreich geändert worden'; 

// Delete Pic
$lang['Album_delete_confirm'] = 'Bist Du sicher, das Bild (die Bilder) zu löschen?'; 
$lang['Pic_deleted_successful'] = 'Dieses Bild (diese Bilder) sind erfolgreich gelöscht worden'; 

//
// ModCP
//
$lang['Approval'] = 'Bilder-Freischaltung'; 
$lang['Approve'] = 'genehmigen'; 
$lang['Unapprove'] = 'ablehnen'; 
$lang['Status'] = 'Status';
$lang['Locked'] = 'gesperrt'; 
$lang['Not_approved'] = 'nicht genehmigt'; 
$lang['Approved'] = 'genehmigt'; 
$lang['Move_to_Category'] = 'In eine Kategorie verschieben'; 
$lang['Pics_moved_successfully'] = 'Dein(e) Bild(er) wurden erfolgreich verschoben'; 
$lang['Pics_locked_successfully'] = 'Dein(e) Bild(er) wurden erfolgreich gesperrt'; 
$lang['Pics_unlocked_successfully'] = 'Dein(e) Bild(er) wurden erfolgreich entsperrt'; 
$lang['Pics_approved_successfully'] = 'Dein(e) Bild(er) wurden freigeschalten'; 
$lang['Pics_unapproved_successfully'] = 'Dein(e) Bild(er) wurden abgelehnt'; 

//
// Rate
//
$lang['Current_Rating'] = 'Aktuelle Bewertung'; 
$lang['Please_Rate_It'] = 'Bitte bewerte das Bild'; 
$lang['Already_rated'] = 'Du hast dieses Bild bereits bewertet'; 
$lang['Album_rate_successfully'] = 'Dein Bild wurde erfolgreich bewertet'; 

//
// Comment
//
$lang['Comment_no_text'] = 'Bitte füge einen Kommentar hinzu'; 
$lang['Comment_too_long'] = 'Dein Kommentar ist zu lang'; 
$lang['Comment_delete_confirm'] = 'Bist Du sicher, dass du den Kommentar löschen willst?'; 
$lang['Pic_Locked'] = 'Das Bild ist gesperrt, deshalb kannst Du keine Kommentare mehr posten'; 

//
// Personal Gallery
//
$lang['Personal_Gallery_Explain'] = 'Du kannst die persönliche Galerie von anderen Benutzern betrachten, indem Du auf den Link in Ihrem Profil klickst'; 
$lang['Personal_gallery_not_created'] = 'Die persönliche Galerie von %s ist leer oder wurde noch nicht erstellt'; 
$lang['Not_allowed_to_create_personal_gallery'] = 'Wende Dich bitte an einen Administrator, wenn Du eine persönliche Galerie anlegen willst!'; 
$lang['Click_return_personal_gallery'] = 'Klicke %shier%s um zur persönlichen Galerie zurückzukehren'; 
/* Album Hierarchy - START */
$lang['Last_Comments'] = 'Letzer Kommentar';
$lang['No_Comment_Info'] = 'Keine Kommentare';
$lang['No_Pictures_In_Cat']= 'Keine Bilder in dieser Kategorie';
$lang['Total_Pics'] = 'Bilder insgesamt';
$lang['Total_Comments'] = 'Kommentare insgesamt';
$lang['Last_Index_Thumbnail'] = 'Letztes Bild';
$lang['Sub_Total_Pics'] = 'Bilder insgesamt';
/* Album Hierarchy - STOP  */
/* Album Hierarchy - START */ 
$lang['Album_sub_categories'] = 'Sub Kategorien'; 
/* Album Hierarchy - STOP  */ 

?>
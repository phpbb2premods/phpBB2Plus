<?php
/***************************************************************************
 *                          lang_hierarchy_album.php [English]
 *                          ------------------------------------------------
 *     begin                : Wednesday, May 12, 2004
 *     copyright            : (C) 2004 IdleVoid
 *     email                : idlevoid@slater.dk
 *
 *     version              : 1.0.2 12/08/2004
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

//
// Album Hierarchy Index Table
//
$lang['Last_Comments'] = 'Letzter Kommentar';
$lang['No_Comment_Info'] = 'Keine Kommentare';
$lang['No_Pictures_In_Cat']= 'Keine Bilder in der Kategorie';
$lang['Total_Pics'] = 'ANzahl Bilder';
$lang['Total_Comments'] = 'Anzahl KOmmentare';
$lang['Last_Index_Thumbnail'] = 'Letztes Bild';
$lang['One_Sub_Total_Pics'] = ' (%d Bild)'; // NOTE THE SPACE BEFORE '(', ITS ON PURPOSE. AND PLEASE KEEP IT
$lang['Multiple_Sub_Total_Pics'] = ' (%d Bilder)'; // NOTE THE SPACE BEFORE '(', ITS ON PURPOSE. AND PLEASE KEEP IT
$lang['Album_sub_categories'] = 'Unterkategorien';
$lang['No_Public_Galleries'] = 'Keine �ffentlichen Gallerien';
$lang['One_new_picture'] = '%d neues Bild';
$lang['Multiple_new_pictures'] = '%d neue Bilder'; // notice the 'S' in pictureS :), any better way to do it ???
//
// Personal Album Hierarchy Index Table
//
$lang['Personal_Categories'] = 'Pers�nliche Gallerie';
$lang['Personal_Cat_Admin'] = 'Pers�nliche Gallerie Kategorie Administration';
$lang['Recent_Personal_Pics'] = 'Neueste Bilder aus der pers�nlichen Gallerie von %s';
//
// Album Moderator Control Panel
//
$lang['Modcp_check_all'] = 'Alle markieren';
$lang['Modcp_uncheck_all'] = 'Alle l�schen';
$lang['Modcp_inverse_selection'] = 'Auswahl umkehren';

$lang['Show_selected_pic_view_mode'] = 'Zeige nur die ausgew�hlte pers�nliche Gallerie-Kategorie';
$lang['Show_all_pic_view_mode'] = 'Zeige alle Bilder in dieser pers�nlichen Gallerie';

//
// Access language strings
//
$lang['Album_Can_Manage_Categories'] = 'Du <b>kannst</b> Kategorien in dieser Gallerie %smanagen%s';
$lang['No_Personal_Category_admin'] = 'Du bist nicht befugt, Deine Kategorien in der pers�nlichen Gallerie zu bearbeiten';

// Upload message
$lang['No_valid_category_selected'] = 'Keine g�ltige Album Kategorie ausgew�hlt';

//
// The picture list of a member (album_mod/album_memberlist.php)
//
$lang['Pic_Cat'] = 'Kategorie';
$lang['Picture_List_Of_User'] = 'Alle Bilder von %s';
$lang['Member_Picture_List_Explain'] = 'Du kannst die komplette Liste der Bilder, die durch andere Mitglieder hinzugef�gt wurden durch einen Klick im Link des jeweiligen Profils sehen';
//--- version 1.3.0
$lang['Comment_List_Of_User'] = 'Alle Kommentare von %s';
$lang['Rating_List_Of_User'] = 'Alle Bewertungen von %s';
$lang['Show_All_Pictures_Of_user'] = 'Zeige alle Bilder von %s';
$lang['Show_All_Comments_Of_user'] = 'Zeige alle Kommentare von %s';
$lang['Show_All_Ratings_Of_user'] = 'Zeige alle Bewertungen von %s';

$lang['Not_commented'] = '<i>nicht kommentiert</i>';

/***************************************************************************
 * Album Hierarchy Administration                                          *
 ***************************************************************************/
//
// Configuration
//
$lang['Album_config_notice'] = 'Wenn Du �nderungen an den momentanen Einstellungen vorgenommen hast und in ein anderes Tab wechseln m�chtest, wirst Du gefragt, ob Du die �nderungen speichern m�chtest.<br />Das System speichert die �nderungen <b>nicht</b> automatisch';
$lang['Save_sucessfully_confimation'] = '%s wurde erfolgreich gespeichert';

$lang['Show_Recent_In_Subcats'] = 'Zeige letzte Bilder in Unterkategorien';
$lang['Show_Recent_Instead_of_NoPics'] = 'Zeige letzte Bilder anstatt der Nachricht, das keine Bilder existieren';

$lang['Album_Index_Settings'] = 'Album Index';
$lang['Show_Index_Subcats'] = 'Zeige Unterkategorien im Index';
$lang['Show_Index_Thumb'] = 'Zeige Kategorie Icons im Index';
$lang['Show_Index_Pics'] = 'Zeige die Anzahl der Bilder der aktuellen Kategorie im Index';
$lang['Show_Index_Comments'] = 'Zeige die Anzahl der Kommentare der aktuellen Kategorie im Index';
$lang['Show_Index_Total_Pics'] = 'Zeige die Anzahl der Bilder der aktuellen Kategorie und aller Unterkategorien im Index';
$lang['Show_Index_Total_Comments'] = 'Zeige die Gesamt-Anzahl der Kommentare der aktuellen Kategorie und aller Unterkategorien im Index';
$lang['Show_Index_Last_Comment'] = 'Zeige die letzten Kommentare der aktuellen Kategorie und aller Unterkategorien im Index';
$lang['Show_Index_Last_Pic'] = 'Zeige die Info des letzten Bildes der aktuellen Kategorie und aller Unterkategorien im Index';
$lang['Line_Break_Subcats'] = 'Zeige jede Subkategorie in einer neuen Zeile';

$lang['Show_Personal_Gallery_Link'] = 'Zeige pers�nliche Gallerie und den Link zur pers�nlichen Gallerie des Benutzers in den Unterkategorien';

$lang['Album_Personal_Auth_Explain'] = 'Hier kann ausgew�hlt werden, welche Benutzergruppe(n) Moderatoren f�r <b>alle</b> pers�nlichen Album Kategorien sind oder ob nur der private Zugriff m�glich ist';

$lang['Album_debug_mode'] = 'Aktiviere den Debug-Modus des Hierarchie Mods.<br><span class="gensmall">Hierdurch werden eine Menge Meldungen produziert, ebenso einige Warnungen im Header, die normal sind.<br>Diese Option sollte <b>nur</b> aktiviert werden, wenn Probleme bestehen.</span>';

$lang['New_Pic_Check_Interval'] = 'Verwendete Zeit um zu sehen ob ein Bild neu ist oder nicht.<br><span class="gensmall"><b>Format</b> : &lt;nummer&gt;&lt;typ&gt; Wobei Typ folgendes sein kann: h, d, w or m (Stunde, Tag, Woche oder Monat)<br> z.B. 12H = 12 Stunden und 12D = 12 Tage und 12W = 12 Wochen und 12M = 12 Monate<br>Wenn kein Typ angegeben wird verwendet das System automatisch <b>Tage</b></span>';
$lang['New_Pic_Check_Interval_Desc'] = '<span class="gensmall">H = STUNDEN, D = TAGE, W = WOCHEN, M = MONATE</span>';
$lang['Enable_Show_All_Pics'] = 'Aktiviere Umschaltung des Ansichtsmodus der pers�nlichen Gallerie (alle Bilder oder nur ausgew�hlte Kategorien).<br/> Bei Einstellung <b>nein</b> wird nur die gew�hlte Kategorie gezeigt.';
$lang['Enable_Index_Supercells'] = 'Aktiviere den Superzellen Effekt im Index. <br><span class="gensmall">Das aktiviert den Mouseover Effekt in den Spalten, auch bekannt als Superzellen Effekt.</span>';

// Sorting
$lang['Album_Category_Sorting'] = 'Sortierung der Album Kategorien';
$lang['Album_Category_Sorting_Id'] = 'ID';
$lang['Album_Category_Sorting_Name'] = 'Name';
$lang['Album_Category_Sorting_Order'] = 'Sortierungsrichtung (default)';
$lang['Album_Category_Sorting_Direction'] = 'Sortierungsrichtung (nur g�ltig f�r ID und Name)';
$lang['Album_Category_Sorting_Asc'] = 'Aufsteigend';
$lang['Album_Category_Sorting_Desc'] = 'Absteigend';

// Upload 
$lang['Upload_Settings'] = 'Upload';

// Personal Gallery
$lang['Album_Personal_Settings'] = 'Pers�nliche Gallerie';
$lang['Show_Personal_Sub_Cats'] = 'Zeige pers�nliche Unterkategorien im Index';
$lang['Personal_Gallery_MOD'] = 'Pers�nliche Gallerie kann durch Eigent�mer moderiert werden';
$lang['Personal_Sub_Cat_Limit'] = 'Maximale Anzahl an Unterkategorien (-1 = unlimitiert)';
$lang['User_Can_Create_Personal_SubCats'] = 'Benutzer k�nnen Unterkategorien in der eigenen pers�nlichen Gallerie erstellen';

$lang['Click_return_personal_gallery_index'] = 'Klicke %shier%s um zum pers�nlichen Gallerie Index zur�ckzukehren';

$lang['Show_Recent_In_Personal_Subcats'] = 'Zeige letzte Bilder in pers�nlichen Unterkategorien';
$lang['Show_Recent_Instead_of_Personal_NoPics'] = 'Zeige letzte Bilder anstatt der Nachricht, das keine Bilder existieren in der pers�nlichen Kategorie';

//
// Categories
//
$lang['Personal_Root_Gallery'] = 'Hauptkategorie der pers�nlichen Gallerie';
$lang['Parent_Category'] = '�bergeordnete Kategorie (f�r diese Kategorie)';
$lang['Child_Category_Moved'] = 'Gew�hlte Kategorie hat Unterkategorien. Die Unterkategorien werden in die <B>%s</B> Kategorie verschoben.';
$lang['No_Self_Refering_Cat'] = 'Du kannst keine �bergeordnete Kategorie auf sich selbst setzen';
$lang['Can_Not_Change_Main_Parent'] = 'Du kannst nicht auf die �bergeordnete Hauptkategorie der pers�nlichen Gallerie wechseln';

//
// ACP - Javascript text
//
$lang['acp_ask_save_changes'] = 'M�chtest Du die �nderungen speichern ?\n(OK = Yes, Cancel = No)';
$lang['acp_nothing_to_save'] = 'Nichts zu speichern !';
$lang['acp_settings_changed_ask_save'] = 'Du hast Einstellungen ver�ndert. M�chtest Du die �nderungen speichern ?\n(OK = Yes, Cancel = No)';

?>
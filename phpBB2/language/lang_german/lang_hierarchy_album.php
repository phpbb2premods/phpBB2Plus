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
$lang['No_Public_Galleries'] = 'Keine öffentlichen Gallerien';
$lang['One_new_picture'] = '%d neues Bild';
$lang['Multiple_new_pictures'] = '%d neue Bilder'; // notice the 'S' in pictureS :), any better way to do it ???
//
// Personal Album Hierarchy Index Table
//
$lang['Personal_Categories'] = 'Persönliche Gallerie';
$lang['Personal_Cat_Admin'] = 'Persönliche Gallerie Kategorie Administration';
$lang['Recent_Personal_Pics'] = 'Neueste Bilder aus der persönlichen Gallerie von %s';
//
// Album Moderator Control Panel
//
$lang['Modcp_check_all'] = 'Alle markieren';
$lang['Modcp_uncheck_all'] = 'Alle löschen';
$lang['Modcp_inverse_selection'] = 'Auswahl umkehren';

$lang['Show_selected_pic_view_mode'] = 'Zeige nur die ausgewählte persönliche Gallerie-Kategorie';
$lang['Show_all_pic_view_mode'] = 'Zeige alle Bilder in dieser persönlichen Gallerie';

//
// Access language strings
//
$lang['Album_Can_Manage_Categories'] = 'Du <b>kannst</b> Kategorien in dieser Gallerie %smanagen%s';
$lang['No_Personal_Category_admin'] = 'Du bist nicht befugt, Deine Kategorien in der persönlichen Gallerie zu bearbeiten';

// Upload message
$lang['No_valid_category_selected'] = 'Keine gültige Album Kategorie ausgewählt';

//
// The picture list of a member (album_mod/album_memberlist.php)
//
$lang['Pic_Cat'] = 'Kategorie';
$lang['Picture_List_Of_User'] = 'Alle Bilder von %s';
$lang['Member_Picture_List_Explain'] = 'Du kannst die komplette Liste der Bilder, die durch andere Mitglieder hinzugefügt wurden durch einen Klick im Link des jeweiligen Profils sehen';
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
$lang['Album_config_notice'] = 'Wenn Du Änderungen an den momentanen Einstellungen vorgenommen hast und in ein anderes Tab wechseln möchtest, wirst Du gefragt, ob Du die Änderungen speichern möchtest.<br />Das System speichert die Änderungen <b>nicht</b> automatisch';
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

$lang['Show_Personal_Gallery_Link'] = 'Zeige persönliche Gallerie und den Link zur persönlichen Gallerie des Benutzers in den Unterkategorien';

$lang['Album_Personal_Auth_Explain'] = 'Hier kann ausgewählt werden, welche Benutzergruppe(n) Moderatoren für <b>alle</b> persönlichen Album Kategorien sind oder ob nur der private Zugriff möglich ist';

$lang['Album_debug_mode'] = 'Aktiviere den Debug-Modus des Hierarchie Mods.<br><span class="gensmall">Hierdurch werden eine Menge Meldungen produziert, ebenso einige Warnungen im Header, die normal sind.<br>Diese Option sollte <b>nur</b> aktiviert werden, wenn Probleme bestehen.</span>';

$lang['New_Pic_Check_Interval'] = 'Verwendete Zeit um zu sehen ob ein Bild neu ist oder nicht.<br><span class="gensmall"><b>Format</b> : &lt;nummer&gt;&lt;typ&gt; Wobei Typ folgendes sein kann: h, d, w or m (Stunde, Tag, Woche oder Monat)<br> z.B. 12H = 12 Stunden und 12D = 12 Tage und 12W = 12 Wochen und 12M = 12 Monate<br>Wenn kein Typ angegeben wird verwendet das System automatisch <b>Tage</b></span>';
$lang['New_Pic_Check_Interval_Desc'] = '<span class="gensmall">H = STUNDEN, D = TAGE, W = WOCHEN, M = MONATE</span>';
$lang['Enable_Show_All_Pics'] = 'Aktiviere Umschaltung des Ansichtsmodus der persönlichen Gallerie (alle Bilder oder nur ausgewählte Kategorien).<br/> Bei Einstellung <b>nein</b> wird nur die gewählte Kategorie gezeigt.';
$lang['Enable_Index_Supercells'] = 'Aktiviere den Superzellen Effekt im Index. <br><span class="gensmall">Das aktiviert den Mouseover Effekt in den Spalten, auch bekannt als Superzellen Effekt.</span>';

// Sorting
$lang['Album_Category_Sorting'] = 'Sortierung der Album Kategorien';
$lang['Album_Category_Sorting_Id'] = 'ID';
$lang['Album_Category_Sorting_Name'] = 'Name';
$lang['Album_Category_Sorting_Order'] = 'Sortierungsrichtung (default)';
$lang['Album_Category_Sorting_Direction'] = 'Sortierungsrichtung (nur gültig für ID und Name)';
$lang['Album_Category_Sorting_Asc'] = 'Aufsteigend';
$lang['Album_Category_Sorting_Desc'] = 'Absteigend';

// Upload 
$lang['Upload_Settings'] = 'Upload';

// Personal Gallery
$lang['Album_Personal_Settings'] = 'Persönliche Gallerie';
$lang['Show_Personal_Sub_Cats'] = 'Zeige persönliche Unterkategorien im Index';
$lang['Personal_Gallery_MOD'] = 'Persönliche Gallerie kann durch Eigentümer moderiert werden';
$lang['Personal_Sub_Cat_Limit'] = 'Maximale Anzahl an Unterkategorien (-1 = unlimitiert)';
$lang['User_Can_Create_Personal_SubCats'] = 'Benutzer können Unterkategorien in der eigenen persönlichen Gallerie erstellen';

$lang['Click_return_personal_gallery_index'] = 'Klicke %shier%s um zum persönlichen Gallerie Index zurückzukehren';

$lang['Show_Recent_In_Personal_Subcats'] = 'Zeige letzte Bilder in persönlichen Unterkategorien';
$lang['Show_Recent_Instead_of_Personal_NoPics'] = 'Zeige letzte Bilder anstatt der Nachricht, das keine Bilder existieren in der persönlichen Kategorie';

//
// Categories
//
$lang['Personal_Root_Gallery'] = 'Hauptkategorie der persönlichen Gallerie';
$lang['Parent_Category'] = 'Übergeordnete Kategorie (für diese Kategorie)';
$lang['Child_Category_Moved'] = 'Gewählte Kategorie hat Unterkategorien. Die Unterkategorien werden in die <B>%s</B> Kategorie verschoben.';
$lang['No_Self_Refering_Cat'] = 'Du kannst keine übergeordnete Kategorie auf sich selbst setzen';
$lang['Can_Not_Change_Main_Parent'] = 'Du kannst nicht auf die übergeordnete Hauptkategorie der persönlichen Gallerie wechseln';

//
// ACP - Javascript text
//
$lang['acp_ask_save_changes'] = 'Möchtest Du die Änderungen speichern ?\n(OK = Yes, Cancel = No)';
$lang['acp_nothing_to_save'] = 'Nichts zu speichern !';
$lang['acp_settings_changed_ask_save'] = 'Du hast Einstellungen verändert. Möchtest Du die Änderungen speichern ?\n(OK = Yes, Cancel = No)';

?>
<?php
/***************************************************************************
 *                                 lang_kb.php
 *                            -------------------
 *   begin                : Sunday, Mar 31, 2003
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: lang_kb.php,v 1.8 2004/05/30 20:50:10 jonohlsson Exp $
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
 
$lang['KB_title'] = 'Knowledge Base';
$lang['Article'] = 'Artikel';
$lang['Category'] = 'Kategorie';
$lang['Article_description'] = 'Beschreibung';
$lang['Article_type'] = 'Typ';
$lang['Article_keywords'] = 'Schl&uuml;sselw&ouml;rter';
$lang['Articles'] = 'Artikel';
$lang['Add_article'] = 'Artikel hinzuf&uuml;gen';
$lang['Click_cat_to_add'] = 'Klicken Sie auf eine Kategorie um einen Artikel hinzuzuf&uuml;gen';
$lang['KB_Home'] = 'KB Start';
$lang['No_articles'] = 'Keine Artikel';
$lang['Article_title'] = 'Artikel Name';
$lang['Article_text'] = 'Artikeltext';
$lang['Add_article'] = 'Artikel senden';
$lang['Read_article'] = 'Artikel lesen';
$lang['Article_not_exsist'] = 'Artikel exsistiert nicht';
$lang['Category_not_exsist'] = 'Kategorie existiert nicht';

$lang['Edit'] = 'Bearbeiten';

$lang['Article_submitted_Approve'] = 'Artikel wurdeerfolgreich &uuml;bermittelt.<br />Ein Administrator wird dar&uuml;ber entscheiden ob Ihr Artikel ver&ouml;ffentlicht wird oder nicht.';
$lang['Article_submitted'] = 'Artikel wurdeerfolgreich &uuml;bermittelt.';
$lang['Click_return_kb'] = 'Klicken Sie %shier%s um zur&uuml;ckzukehren zu' . $lang['KB_title'];

$lang['Article_Edited_Approve'] = 'Artikel erfolgreich bearbeitet.<br />Es wird eine erneute Freischaltung ben&ouml;tigt bis er ver&ouml;ffentlicht wird.';
$lang['Article_Edited'] = 'Artikel erfolgreich bearbeitet.';
$lang['Edit_article'] = 'Bearbeite Artikel';

$lang['KB_title'] = 'Knowledge Base';
$lang['KB_art_description'] = 'Hier k&ouml;nnen Sie Artikel freischalten oder l&ouml;schen.';
$lang['Art_man'] = 'Artikel Manager';
$lang['Cat_man'] = 'Kategorie Manager';
$lang['KB_cat_description'] = 'Hier k&ouml;nnen Sie Kategorien f&uuml;r die Knowledge-Base hinzuf&uuml;gen, bearbeiten oder l&ouml;schen.';
$lang['Art_action'] = 'Aktion';

//approve
$lang['Art_edit'] = 'Bearbeitete Artikel';
$lang['Art_not_approved'] = 'Nicht ver&ouml;ffentlicht';
$lang['Art_approved'] = 'Ver&ouml;ffentlicht';
$lang['Approve'] = 'Ver&ouml;ffentlichen';
$lang['Un_approve'] = 'Ver&ouml;ffentlichung zur&uuml;ckziehen';
$lang['Article_approved'] = 'Artikel ist hiermit ver&ouml;ffentlicht.';
$lang['Article_unapproved'] = 'Artikel ist hiermit nicht ver&ouml;ffentlicht.';

//delete
$lang['Delete'] = 'L&ouml;schen';
$lang['Confirm_art_delete'] = 'Sind Sie sich sicher, dass Sie diesen Artikel l&ouml;schen wollen?';
$lang['Confirm_art_delete_yes'] = '%sJa, Ich mochten den/die Artikel l&ouml;schen.';
$lang['Confirm_art_delete_no'] = '%sNein, ich bin mir nicht sicher.';
$lang['Article_deleted'] = 'Artikel l&ouml;schen erfolgreich.';

$lang['Click_return_article_manager'] = 'Klicken Sie %shier%s um zum Artikel Manager zur&uuml;ckzukehren';

//cat manager
$lang['Create_cat'] = 'Erstellen einer neuen Kategorie:';
$lang['Create'] = 'Erstellen';
$lang['Cat_settings'] = 'Kategorie Einstellungen';
$lang['Create_description'] = 'Hier k&ouml;nnen Sie den Namen einer Kategorie &auml;ndern und/oder eine Beschreibung hinzuf&uuml;gen.';
$lang['Cat_created'] = 'Kategorie erfolgreich erstellt.';
$lang['Click_return_cat_manager'] = 'Klicken Sie %shier%s zum zur&uuml;ckkehren zum' . $lang['Cat_man'];
$lang['Edit_description'] = 'Hier k&ouml;nnen Sie die Einstellungen ihrer Kategorie &auml;ndern.';
$lang['Edit_cat'] = 'Kategorie bearbeiten';
$lang['Cat_edited'] = 'Kategorie erfolgreich ge&auml;ndert.';
$lang['Parent'] = '&uuml;bergeordnet';

$lang['Cat_delete_title'] = 'Kategorie l&ouml;schen';
$lang['Cat_delete_desc'] = 'Hier k&ouml;nnen Sie eine Kategorie l&ouml;schen und ihre Artikel zu einen neuen Kategorie verschieben.';
$lang['Cat_deleted'] = 'Kategorie erfolgreich gel&ouml;scht.';
$lang['Delete_all_articles'] = 'Artikel gel&ouml;scht';

//configuration
$lang['KB_config'] = 'Tutorial-Sammlung Konfiguration';
$lang['Art_types'] = 'Artikel Typen';
$lang['KB_config_title'] = 'Tutorial-Sammlung Konfiguration';
$lang['KB_config_explain'] = '&Auml;ndern der Konfiguration der Tutorial-Sammlung';
$lang['New_title'] = 'Neue Artikel erlauben';
$lang['New_explain'] = 'Erlauben Sie Usern neue Artikel zu posten.';
$lang['Edit_name'] = '&Auml;nderungen erlauben';
$lang['Edit_explain'] = 'Erlauben Sie Usern ihre Artikel nach dem posten zu &auml;ndern.';
$lang['Notify_name'] = 'Informiere mich bei';
$lang['Notify_explain'] = 'W&auml;hlen Sie auf welchem Wege Sie informiert werden wollen bei neuen Artikeln';
$lang['PM'] = 'PM';
$lang['Click_return_kb_config'] = 'Klicken Sie %shier%s um zur Konfiguration Ihrer Tutorial-Sammlung zur&uuml;ckzukehren';
$lang['Admin_id_name'] = 'Admin ID';
$lang['Admin_id_explain'] = 'Dies ist die User ID an welche die PMs geschickt werden.';
$lang['Approve_new_name'] = 'Neue Artikel ver&ouml;ffentlichen';
$lang['Approve_new_explain'] = 'W&auml;hlen Sie, ob <b />neue</b /> Artikel eine Freischaltung ben&ouml;tigen';
$lang['Approve_edit_name'] = 'Ge&auml;nderte Artikel ver&ouml;ffentlichen';
$lang['Approve_edit_explain'] = 'W&auml;hlen Sie, ob <b />ge&auml;nderte</b /> Artikel eine Freischaltung ben&ouml;tigen';
$lang['Allow_anon_name'] = 'Erlauben sie anonymen Usern neue Artikel zu posten';
$lang['Allow_anon_explain'] = 'W&auml;hlen Sie, ob <b />neu</b /> Artikel von anonymen User freigeschaltet werden m&uuml;ssen';
$lang['Del_topic'] = 'L&ouml;sche Topic';
$lang['Del_topic_explain'] = 'Wenn Sie einen Artikel l&ouml;schen, wollen sie dann auch die Kommentare dazu l&ouml;schen?';
$lang['Allow_comments'] = 'Kommentare erlauben';
$lang['Allow_comments_explain'] = 'Erlauben Sie Kommentare zu Ihren Artikeln';
$lang['Forum_id'] = 'Forum ID';
$lang['Forum_id_explain'] = 'Dies ist das Forum in der die Kommentare zu Artikeln gespeichert werden.';

$lang['Allow_rating'] = 'Bewertungen erlauben';
$lang['Allow_rating_explain'] = 'Erlaube den Benutzern, Bewertungen zu den Artikeln abzugeben';

$lang['Allow_anonymos_rating'] = 'Erlaube anonyme Bewertungen';
$lang['Allow_anonymos_rating_explain'] = 'Wenn Bewertungen erlaubt sind, erlaube hiermit anonymen Benutzern, Bewertungen zu Artikeln abzugeben';

$lang['KB_config_updated'] = 'Die Konfiguration der Knowledge-Base wurde erfolgreich aktualisiert.';

$lang['New_article'] = 'Neuer Artikel in der Knowledge Base!';
$lang['Email_body'] = 'Es wurde ein Artikel an die Knowledge-Base gesendet.<br />\nPrüfe den Artikel, dann genehmige ihn oder lösche ihn.<br />\nDer Artikel ist unten angehängt:<br />\n'; 

//Added by Haplo
$lang['Comments_show'] = 'Zeige Artikel Kommentare.';
$lang['Comments_show_explain'] = '- zeigt ebenfalls Kommentare auf der Artikel Seite an';
$lang['Comments_show_title'] = 'Benutzer Kommentare';

$lang['Mod_group'] = 'KB Moderatoren-Gruppe';
$lang['Mod_group_explain'] = '- mit KB Admin Befugnissen!';

$lang['Bump_post'] = 'Bumping Artikel Beitrag'; 
$lang['Bump_post_explain'] = 'Wird ein Artikel bearbeitet, wird eine Antwort in Thema des Artikels gepostet. Dadurch wird darüber informiert, das der Artikel aktualisiert wurde'; 

$lang['Stats_list'] = 'Zeige KB Statistik'; 
$lang['Stats_list_explain'] = 'Zeigt KB Statistiken im Header.'; 

$lang['Header_banner'] = 'Zeige Top Logo'; 
$lang['Header_banner_explain'] = 'Zeige KB Logo im Header.'; 

$lang['Comment_info'] = 'Kommentar Einstellungen'; 
$lang['Rating_info'] = 'Bewertungs Einstellungen'; 


//types
$lang['Types_man'] = 'Typen Manager';
$lang['KB_types_description'] = 'Hier k&ouml;nnen Sie verschiedene Artikel-Typen hinzuf&uuml;gen, &auml;ndern oder l&ouml;schen.';
$lang['Create_type'] = 'NeuenArtikel-Typ hinzuf&uuml;gen:';
$lang['Type_created'] = 'Artikel-Typ erfolgreich erstellt.';
$lang['Click_return_type_manager'] = 'Klicken Sie %shier%s um zum Typen Manager zur&uuml;ckzukehren';

$lang['Edit_type'] = 'Typ bearbeiten';
$lang['Edit_type_description'] = 'Hier können Sie den Namen des Typs bearbeiten';
$lang['Type_edited'] = 'Artikel Typ erfolgreich bearbeitet.';

$lang['Type_delete_title'] = 'Artikel-Typ l&ouml;schen';
$lang['Type_delete_desc'] = 'Hier k&ouml;nnen die Artikel-Typen &auml;ndern von Artikeln deren Typ Sie gel&ouml;scht haben.';
$lang['Change_type'] = '&auml;nder des Artikel-Typs zu';
$lang['Change_and_Delete'] = '&auml;ndern und l&ouml;schen';
$lang['Type_deleted'] = 'Artikel-Typ erfolgreich gel&ouml;scht.';

$lang['Pre_text_name'] = 'Anleitung zur Artikeleinsendung';
$lang['Pre_text_header'] = 'Artikeleinsendung Kopfzeile';
$lang['Pre_text_body'] = 'Artikeleinsedung Hauptteil';
$lang['Pre_text_explain'] = 'Dies ist der Text der Usern im Kopf des Einsendeformulars angezeigt wird:';
$lang['Show'] = 'Zeige';
$lang['Hide'] = 'Verstecken';
$lang['Empty_category'] ='Sie m&uuml;ssen eine Kategorie w&auml;hlen';
$lang['Empty_type']='Sie m&uuml;ssen einen Typ w&auml;hlen';
$lang['Empty_article_name'] = 'Sie müssen den Artikel-Namen ausfüllen';
$lang['Empty_article_desc'] = 'Sie müssen die Artikel-Beschreibung ausfüllen';

$lang['Read_full_article'] = '>>Ganzen Artikel anzeigen';
$lang['Comments'] = 'Kommentare';

$lang['No_add'] = 'Sie können keinen neuen Artikel hinzufügen!';
$lang['No_edit'] = 'Sie können diesen Artikel nicht bearbeiten!';
$lang['Post_comments'] = 'Kommentar abgeben';

$lang['Category_sub'] = 'Unterkategorien';
$lang['Quick_stats'] = 'Kurzstatistik';

// added

$lang['Edited_Article_info'] = 'Artikel aktualisiert...';
$lang['No_Articles'] = 'Diese Kategorie ist leer!';
$lang['Not_authorized'] = 'Sie sind hierzu nicht authorisiert...';
$lang['TOC'] = 'Inhalt';

// Rate
$lang['Votes_label'] = 'Bewertung ';
$lang['Votes'] = 'Stimme(n)';
$lang['Rate'] = 'Artikel bewerten';
$lang['ADD_RATING'] = '[Artikel bewerten]';
$lang['Rerror'] = 'Sorry, Sie haben diesen Artikel bereits bewertet.';
$lang['Rateinfo'] = 'Sie sind dabei, den Artikel <i>{filename}</i> zu bewerten.<br />Bitte wählen Sie eine Bewertung. 1 ist die schlechteste, 10 ist die beste.';
$lang['Rconf'] = 'Sie haben <i>{filename}</i> eine Bewertung von {rate} gegeben.<br />Das führt zu einer neuen Bewertung von {newrating}/10.';
$lang['R1'] = '1';
$lang['R2'] = '2';
$lang['R3'] = '3';
$lang['R4'] = '4';
$lang['R5'] = '5';
$lang['R6'] = '6';
$lang['R7'] = '7';
$lang['R8'] = '8';
$lang['R9'] = '9';
$lang['R10'] = '10';
$lang['Click_return_rate'] = 'Klicken Sie %shier%s um zum Artikel zurückzukehren';

// Print version
$lang['Print_version'] = '[Druckbare Version]';

// Stats
$lang['Top_toprated'] = 'Bestbewertete Artikel';
$lang['Top_most_popular'] = 'Populärste Artikel';
$lang['Top_latest'] = 'Neueste Artikel';

// Votes check
$lang['Votes_check_ip'] = 'Bewertungen überprüfen - IP'; 
$lang['Votes_check_ip_explain'] = 'Nur eine Bewertung pro IP-Adresse ist erlaubt.'; 

$lang['Votes_check_userid'] = 'Bewertungen überprüfen - Benutzer'; 
$lang['Votes_check_userid_explain'] = 'Benutzer dürfen nur eine Bewertung abgeben.'; 

$lang['Article_pag'] = 'Artikel Seitenanzeige'; 
$lang['Article_pag_explain'] = 'Anzahl Artikel in einer Kategorie, bevor die nächste Seite angezeigt wird.'; 

$lang['Comments_pag'] = 'Kommentare Seitenanzeige'; 
$lang['Comments_pag_explain'] = 'Anzahl Kommentare, bevor die nächste Seite angezeigt wird.'; 

$lang['News_sort'] = 'Artikel Sortierung'; 
$lang['News_sort_explain'] = 'Definiere, wie die Artikel in der jeweiligen Kategorie sortiert werden.'; 

$lang['News_sort_par'] = 'Aufsteigend oder Absteigend'; 
$lang['News_sort_par_explain'] = ''; 

// 
// General strings from the news admin panel
// 

$lang['News_settings'] = "KB Block Einstellungen";
$lang['News_settings_short_explain'] = "Konfigureren Sie einige Optionen für die News auf der Hauptseite";
$lang['News_settings_explain'] = "Hier können Sie die Konfiguration des KB Blocks bearbeiten. Hier können Sie einstellen, welche Kategorien der Block darstellen soll.";

// 
// Update result messages
// 

$lang['News_updated_return_settings'] = "KB Block Konfiguration erfolgreich aktualisiert.<br /><br />Klicken Sie %shier%s um zur Hauptseite zurückzukehren."; // %s's for URI params - DO NOT REMOVE
$lang['News_update_error'] = "Konnte die KB Block Konfiguration nicht aktualisieren.<br /><br />Dieser Mod funktioniert mit MySQL, kontaktieren Sie bitte den Author, falls es Probleme gibt. Wenn Sie eine Übersetzung eines anderen Datenbankformats anbieten können senden Sie es bitte an:<br />";


// kb
$lang['Cat_all'] = "Alle";


?>
<?php

/***************************************************************************
 *                            lang_admin.php [German]
 *                              -------------------
 *     begin                : Sun May 19 2002
 *     copyright            : (C) 2001 The phpBB Group
 *     email                : support@phpbb.com
 *     creator		    : http://www.phpbb2.de
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

/***************************************************************************
 * German Translation by:
 * Joel Ricardo Zick (Rici) webmaster@rpg-inn.de || http://www.sdc-forum.de
 * Assistance: Philipp Kordowich, Ingo Köhler
 *
 * Release date: 2003-10-09
 ***************************************************************************/

//
// Format is same as lang_main
//

//
// Modules, this replaces the keys used
// in the modules[][] arrays in each module file
//
$lang['General'] = 'Allgemeines';
$lang['Users'] = 'Benutzer';
$lang['Groups'] = 'Gruppen';
$lang['Forums'] = 'Forum';
$lang['Styles'] = 'Styles/Themes';

$lang['Configuration'] = 'Konfiguration';
$lang['Permissions'] = 'Befugnisse';
$lang['Manage'] = 'Einstellungen';
$lang['Disallow'] = 'Benutzernamen verbieten';
$lang['Prune'] = 'Autom. Löschen';
$lang['Mass_Email'] = 'Massen-E-Mail versenden';
$lang['Ranks'] = 'Ränge';
$lang['Smilies'] = 'Smilies';
$lang['Ban_Management'] = 'Bannen';
$lang['Word_Censor'] = 'Wortzensur';
$lang['Export'] = 'Exportieren';
$lang['Create_new'] = 'Erstellen';
$lang['Add_new'] = 'Hinzufügen';
$lang['Backup_DB'] = 'Datenbank-Backup';
$lang['Restore_DB'] = 'Datenbank wiederherstellen';

//
// Custom Profile Fields MOD
//
$lang['custom_field_notice_admin'] = 'Diese Objekte wurden von dir oder einem anderen Administrator kreiert. Für mehr Informationen, überprüfe die Einträge unter Profilfelder in der Navigation. Objekte mit * sind Pflichtfelder. Objekte mit &dagger; können nur Admins sehen.';

$lang['field_deleted'] = 'Das ausgewählte Objekt wurde gelöscht';
$lang['double_check_delete'] = 'Bist du sicher ob du das Objekt "%s" endgültig aus der Datenbank löschen willst?';

$lang['here'] = 'hier';
$lang['new_field_link'] = '<a href="'.append_sid("$filename?mode=add&pfid=x").'">%s</a>';
$lang['edit_field_link'] = '<a href="'.append_sid("$filename?mode=edit&pfid=x").'">%s</a>';
$lang['index_link'] = '<a href="'.append_sid("admin_profile_fields.$phpEx?mode=edit&pfid=x").'">%s</a>';
$lang['field_exists'] = 'Diese Feld existiert schon.<br /><br />Du kannst ein ' . sprintf($lang['new_field_link'],'neues') . ' Profilfeld erstellen,<br /><br />oder versuch das bestehende ' . sprintf($lang['edit_field_link'],'anzupassen') . '.';
$lang['click_here_here'] = 'Klicke ' . sprintf($lang['new_field_link'],$lang['here']) . ' um ein Profilfeld zu erstellen,<br /><br />oder klicke ' . sprintf($lang['index_link'],$lang['here']) . ' um zum Admin-Index zurückzukehren.';
$lang['field_success'] = 'Feld erfolgreich eingetragen!<br /><br />' . $lang['click_here_here'];
$lang['Custom_Profile'] = 'Profilfelder';
$lang['profile_field_created'] = 'Profilfeld erstellt';
$lang['profile_field_updated'] = 'Profilfeld geändert';

$lang['add_field_title'] = 'Eigene Profilfelder hinzufügen';
$lang['edit_field_title'] = 'Ändere eigene Profilfelder';
$lang['add_field_explain'] = 'Hier kannst du eigene Profilfelder für deine User erstellen.';
$lang['edit_field_explain'] = 'Hier kannst du deine Profilfelder bearbeiten die du erstellt hast.';

$lang['add_field_general'] = 'Allgemeine Einstellungen';
$lang['add_field_admin'] = 'Administrator Einstellungen';
$lang['add_field_view'] = 'Ansichtsoptionen';
$lang['add_field_text_field'] = 'Textfeld Einstellungen';
$lang['add_field_text_area'] = 'Textbereich Einstellungen';
$lang['add_field_radio_button'] = 'Optionsschalter Einstellungen';
$lang['add_field_checkbox'] = 'Checkbox Einstellungen';

$lang['default_value'] = 'Standardwert';
$lang['default_value_explain'] = 'Dies ist der Standardwert für das Feld. Wenn der Benutzer das Feld nicht ändert, wird dieser Wert verwendet. Ist dies ein Pflichtfeld, wird dieser Wert für alle Benutzer gesetzt.';
$lang['default_value_radio_explain'] = 'Trage einen Wert ein der in der Auswahl für dieses Feld vorkommt.';
$lang['default_value_checkbox_explain'] = 'Eingetragene Werte werden als ausgewählt gesetzt. Diese Werte müssen mit denen der Auswahl hierfür übereinstimmen';
$lang['max_length'] = 'Maximale Länge';
$lang['max_length_explain'] = 'Dies ist die maximale Zeichenanzahl für dieses Feld.';
$lang['max_length_value'] = ' Dies muss eine Zahl zwischen %d und %d sein.';
$lang['available_values'] = 'Verfügbare Werte';
$lang['available_values_explain'] = 'Schreibe jede Option in seine eigene Zeile';

$lang['add_field_view_disclaimer'] = 'Alle diese Optionen gelten als auf "nein" gesetzt, wenn dem Benutzer nicht erlaubt ist das Feld zu sehen';

$lang['add_field_name'] = 'Feld Name';
$lang['add_field_name_explain'] = 'Trage einen Feldnamen ein der das Feld beschreibt.';
$lang['add_field_description'] = 'Feldbeschreibung';
$lang['add_field_description_explain'] = 'Trage hier eine Beschreibung für das Feld ein. Diese wird wie dieser Text unter dem Feldnamen angezeigt.';
$lang['add_field_type'] = 'Feldtype';
$lang['add_field_type_explain'] = 'Wähle einen Feldtyp. Beispiele eines jeden Typs siehst Du rechts.';
$lang['edit_field_type_explain'] = 'Wähle einen Feldtyp in den Du das Feld ändern willst. Beispiele eines jeden Typs siehst Du rechts.';
$lang['add_field_required'] = 'Als Pflichtfeld setzten';
$lang['add_field_required_explain'] = 'Ist das Feld als "Benötigt" gesetzt, jeder User der sich registriert <strong>muss</strong> diese Feld ausfüllen und alle bestehenden Benutzer erhalten den Standardwert eingetragen.';
$lang['add_field_user_can_view'] = 'Benutzern können dieses Feld sehen';
$lang['add_field_user_can_view_explain'] = 'Dies diese Option auf "ja", ist es dem Benutzer erlaubt das Feld zu sehen und zu ändern. Ist es auf "nein", können es nur Administratoren sehen und den Inhalt ändern. Steht dieses Feld auf "nein" kann man es auch nicht als Pflichtfeld setzten.';
$lang['view_in_profile'] = 'Anzeige im Benuterprofil';
$lang['profile_locations_explain'] = 'Diese Option ist für die Anzeige im Profil des Benutzers.';
$lang['contacts_column'] = 'Kontakt Spalte';
$lang['about_column'] = '"Alles über" Spalte';
$lang['view_in_memberlist'] = 'Anzeige in der Mitgliederliste';
$lang['view_in_topic'] = 'Anzeige in Themen';
$lang['topic_locations_explain'] = 'Diese Optionen sind für die Beitragsansicht.';
$lang['author_column'] = 'Miniprofil';
$lang['above'] = 'Oberhalb ';
$lang['below'] = 'Unterhalb ';

$lang['textarea'] = 'Textbereich';
$lang['textarea_example'] = "Dies ist ein Beispiel für eine Textbereich.";
$lang['text_field'] = 'Textfeld';
$lang['text_field_example'] = 'Dies ist ein Beispiel für ein Textfeld';
$lang['radio'] = 'Optionsschalter';
$lang['radio_example'] = 'Dies ist ein Beispiel für zwei Optionsschalter';
$lang['checkbox'] = 'Checkbox';
$lang['checkbox_example'] = 'Dies ist ein Beispiel für zwei Checkboxen';

$lang['profile_field_list'] = 'Deine individuellen Profilfelder';
$lang['profile_field_list_explain'] = 'Dies sind alle Felder die Du erstellt hast, mit Links diese zu bearbeiten oder zu löschen.';
$lang['profile_field_id'] = 'ID #';
$lang['profile_field_name'] = 'Feld Name';
$lang['profile_field_action'] = 'Aktion';
$lang['no_profile_fields_exist'] = 'Es existieren keine Felder.';

$lang['enter_a_name'] = 'Du <strong>musst</strong> einen Feldnamen eintragen<br /><br />Drücke zurück um es nochmal zu versuchen';
//
// END Custom Profile Fields MOD
//

//
// Index
//
$lang['Admin'] = 'Administration';
$lang['Not_admin'] = 'Du hast keine Administrator-Rechte';
$lang['Welcome_phpBB'] = 'Willkommen bei phpBB';
$lang['Main_index'] = 'Forum Index';
$lang['Forum_stats'] = 'Forum Statistiken';
$lang['Admin_Index'] = 'Admin Index';
$lang['Preview_forum'] = 'Forumsvorschau';
$lang['Portal_index'] = 'Portal Index';
$lang['Preview_portal'] = 'Portalvorschau';

$lang['Click_return_admin_index'] = 'Klicke %shier%s, um zum Admin-Index zurückzukehren';

$lang['Statistic'] = 'Statistik';
$lang['Value'] = 'Wert';
$lang['Number_posts'] = 'Anzahl der Beiträge';
$lang['Posts_per_day'] = 'Beiträge pro Tag';
$lang['Number_topics'] = 'Anzahl der Themen';
$lang['Topics_per_day'] = 'Themen pro Tag';
$lang['Number_users'] = 'Anzahl der Benutzer';
$lang['Users_per_day'] = 'Benutzer pro Tag';
$lang['Board_started'] = 'Board startete am';
$lang['Avatar_dir_size'] = 'Größe des Avatarordners';
$lang['Database_size'] = 'Datenbankgröße';
$lang['Gzip_compression'] ='GZip-Kompression';
$lang['Not_available'] = 'Nicht verfügbar';

$lang['ON'] = 'Aktiv'; // This is for GZip compression
$lang['OFF'] = 'Inaktiv';

//
// DB Utils
//
$lang['Database_Utilities'] = 'Datenbankfunktionen';

$lang['Restore'] = 'Wiederherstellen';
$lang['Backup'] = 'Backup';
$lang['Restore_explain'] = 'Hiermit werden alle phpBB Tabellen aus einer Datei wiederhergestellt. Falls es dein Server unterstützt, kannst du auch einen GZip-komprimierten Text hochladen - er wird automatisch dekomprimiert! <b>ACHTUNG</b>: Es werden alle existierenden Daten überschrieben. Der Vorgang wird einige Zeit dauern, bitte verlasse diese Seite nicht, bis er abgeschlossen wurde.';
$lang['Backup_explain'] = 'Hier kannst du alle phpBB-Tabellen abspeichern. Solltest du noch weitere, eigene Tabellen in derselben Datenbank wie die phpBB-Tabellen haben, die auch gespeichert werden sollen, gib ihre Namen in der \'Zusätzliche Tabellen\'-Textbox an (getrennt mit Kommata). Sollte dein Server es unterstützen, kannst du die Datei(en) auch mit GZip komprimieren, bevor du sie runterlädst.';

$lang['Backup_options'] = 'Backup-Optionen';
$lang['Start_backup'] = 'Backup beginnen';
$lang['Full_backup'] = 'Vollständiges Backup';
$lang['Structure_backup'] = 'Nur-Struktur-Backup';
$lang['Data_backup'] = 'Nur-Daten-Backup';
$lang['Additional_tables'] = 'Zusätzliche Tabellen';
$lang['Gzip_compress'] = 'GZip-Komprimierungs Datei';
$lang['Select_file'] = 'Wähle eine Datei';
$lang['Start_Restore'] = 'Wiederherstellung beginnen';

$lang['Restore_success'] = 'Die Datenbank wurde wieder hergestellt.<br /><br />Dein Board sollte jetzt wieder den Stand des Backups haben.';
$lang['Backup_download'] = 'Dein Download wird in Kürze beginnen - bitte etwas Geduld';
$lang['Backups_not_supported'] = 'Fehler: Dein Datenbanksystem unterstützt Datenbank-Backups nicht!';

$lang['Restore_Error_uploading'] = 'Fehler beim Hochladen der Backup-Datei';
$lang['Restore_Error_filename'] = 'Probleme mit dem Dateinamen, probiere einen anderen';
$lang['Restore_Error_decompress'] = 'Die GZip-Version kann nicht dekomprimiert werden, nutze bitte eine Nur-Text-Datei';
$lang['Restore_Error_no_file'] = 'Es wurde keine Datei hochgeladen';


//
// Auth pages
//
$lang['Select_a_User'] = 'Wähle einen Benutzer';
$lang['Select_a_Group'] = 'Wähle eine Gruppe';
$lang['Select_a_Forum'] = 'Wähle ein Forum';
$lang['Auth_Control_User'] = 'Benutzerbefugniskontrolle';
$lang['Auth_Control_Group'] = 'Gruppenbefugniskontrolle';
$lang['Auth_Control_Forum'] = 'Forenzugangskontrolle';
$lang['Look_up_User'] = 'Benutzer auswählen';
$lang['Look_up_Group'] = 'Gruppe auswählen';
$lang['Look_up_Forum'] = 'Forum auswählen';

$lang['Group_auth_explain'] = 'Du kannst hier die Befugnisse und den Moderator-Status für jede Gruppe einstellen. Vergiss nicht, dass einzelne Benutzerbefugnisse immer noch gültig sind, wenn du die Gruppenbefugnisse änderst (z. B. Zugang zu Foren u. ä.). Sollte dies der Fall sein, wirst du darüber informiert.';
$lang['User_auth_explain'] = 'Du kannst hier die Befugnisse und den Moderator-Status für jeden einzelnen Benutzer einstellen. Vergiss nicht, dass Gruppenbefugnisse immer noch gültig sind, wenn du die Benutzerbefugnisse änderst (z. B. Zugang zu Foren u. ä.). Sollte dies der Fall sein, wirst du darüber informiert.';
$lang['Forum_auth_explain'] = 'Du kannst hier die Zugangsebenen für jedes Forum bestimmen. Es gibt eine einfache und eine fortgeschrittene Methode, dies zu tun. Bei der fortgeschrittenen Methode hast du eine bessere Kontrolle über jedes Forum. Bedenke, dass das Ändern der Zugangsebene beeinflusst, welche Benutzer welche Aktionen im Forum durchführen können.';

$lang['Simple_mode'] = 'Einfache Methode';
$lang['Advanced_mode'] = 'Fortgeschrittene Methode';
$lang['Moderator_status'] = 'Moderatorenstatus';

$lang['Allowed_Access'] = 'Zugang gestattet';
$lang['Disallowed_Access'] = 'Zugang verwehrt';
$lang['Is_Moderator'] = 'ist hier Moderator';
$lang['Not_Moderator'] = 'ist hier kein Moderator';

$lang['Conflict_warning'] = 'Warnung: Autorisationskonflikt';
$lang['Conflict_access_userauth'] = 'Der Benutzer hat auf Grund seiner Gruppenmitgliedschaft immer noch Rechte in diesem Forum. Vielleicht solltest du die Gruppenrechte ändern oder den Benutzer komplett aus der Benutzergruppe entfernen. Die Gruppen mit Rechten (und die dazugehörigen Foren) stehen unten.';
$lang['Conflict_mod_userauth'] = 'Der Benutzer hat immer noch Moderatorenrechte in diesem Forum. Vielleicht solltest du die Gruppenrechte ändern oder den Benutzer komplett aus der Benutzergruppe entfernen. Die Gruppen mit Rechten (und die dazugehörigen Foren) stehen unten.';

$lang['Conflict_access_groupauth'] = 'Der oder die folgenden Benutzer haben auf Grund ihrer Benutzereinstellungen immer noch das Zugangsrecht zu diesem Forum. Vielleicht solltest du diese Einstellungen ändern, um dem Benutzer komplett den Zugang zu verweigern. Die Benutzer mit Rechten (und die dazugehörigen Foren) stehen unten.';
$lang['Conflict_mod_groupauth'] = 'Der oder die folgenden Benutzer haben auf Grund ihrer Benutzereinstellungen immer noch Moderatorenrechte in diesem Forum. Vielleicht solltest du diese Einstellungen ändern, um dem Benutzer komplett die Rechte zu nehmen. Die Benutzer mit Rechten (und die dazugehörigen Foren) stehen unten.';

$lang['Public'] = 'Öffentlich';
$lang['Private'] = 'Privat';
$lang['Registered'] = 'Registriert';
$lang['Administrators'] = 'Administratoren';
$lang['Hidden'] = 'Versteckt';

// These are displayed in the drop down boxes for advanced
// mode forum auth, try and keep them short!
$lang['Forum_ALL'] = 'Alle';
$lang['Forum_REG'] = 'Reg';
$lang['Forum_PRIVATE'] = 'Privat';
$lang['Forum_MOD'] = 'Mods';
$lang['Forum_ADMIN'] = 'Admin';

$lang['View'] = 'Ansicht';
$lang['Read'] = 'Lesen';
$lang['Post'] = 'Posten';
$lang['Reply'] = 'Antworten';
//$lang['Edit'] = 'Editieren';
$lang['Delete'] = 'Löschen';
$lang['Sticky'] = 'Wichtig';
$lang['Announce'] = 'Ankündigung';
$lang['Vote'] = 'Umfrage';
$lang['Pollcreate'] = 'Umfrage erstellen';

$lang['Permissions'] = 'Befugnisse';
$lang['Simple_Permission'] = 'Einfache Befugnisse';

$lang['User_Level'] = 'Benutzerebene';
$lang['Auth_User'] = 'Benutzer';
$lang['Auth_Admin'] = 'Administrator';
$lang['Group_memberships'] = 'Benutzergruppenmitglieder';
$lang['Usergroup_members'] = 'Diese Gruppe hat die folgenden Mitglieder';

$lang['Forum_auth_updated'] = 'Forumsberechtigungen aktualisiert';
$lang['User_auth_updated'] = 'Benutzerberechtigungen aktualisiert';
$lang['Group_auth_updated'] = 'Gruppenberechtigungen aktualisiert';

$lang['Auth_updated'] = 'Befugnisse wurden aktualisiert';
$lang['Click_return_userauth'] = 'Klicke %shier%s, um zu den Benutzerrechten zurückzukehren';
$lang['Click_return_groupauth'] = 'Klicke %shier%s, um zu den Gruppenrechten zurückzukehren';
$lang['Click_return_forumauth'] = 'Klicke %shier%s, um zu den Forenberechtigungen zurückzukehren';


//
// Banning
//
$lang['Ban_control'] = 'Sperren';
$lang['Ban_explain'] = 'Hier kannst du Benutzer bannen. Du kannst entweder einen bestimmten User, eine IP-Adresse oder einen Hostnamen sperren. Durch diese Methode kann der Benutzer die Startseite des Forums nicht aufrufen. Um den Benutzer daran zu hindern, sich unter einem anderen Namen anzumelden, kannst du auch bestimmte E-Mail-Adressen sperren. Eine E-Mail-Sperre verhindert nur das Registrieren, nicht das Posten eines Benutzers!';
$lang['Ban_explain_warn'] = 'Bitte beachte, dass, wenn du mehrere IP-Adressen eingibst, alle Adressen zwischen dem Anfang und dem Ende der Sperrliste hinzugefügt werden. Versuche die Anzahl der Adressen klein zu halten, indem du Wildcards einsetzt, wo es möglich ist. Am besten ist es, eine konkrete IP-Adresse anzugeben.';

$lang['Select_username'] = 'Wähle einen Benutzernamen';
$lang['Select_ip'] = 'Wähle eine IP-Adresse';
$lang['Select_email'] = 'Wähle eine E-Mail-Adresse';

$lang['Ban_username'] = 'Einen oder mehrere Benutzer bannen';
$lang['Ban_username_explain'] = 'Mit einer Kombination aus Tastatur und Maus kannst du auch mehrere Benutzer auf einmal bannen';

$lang['Ban_IP'] = 'Eine(n) oder mehrere IP-Adressen/Hostnamen bannen';
$lang['IP_hostname'] = 'IP-Adressen oder Hostname';
$lang['Ban_IP_explain'] = 'Um mehrere verschiedene IP-Adressen oder Hostnamen anzugeben, trenne sie mit Kommata voneinander. Um einen Bereich von IP-Adressen anzugeben, trenne den Anfang und das Ende mit einem Bindestrich (-), benutze * als Platzhalter';

$lang['Ban_email'] = 'Eine oder mehrere E-Mail Adressen bannen';
$lang['Ban_email_explain'] = 'Um mehrere verschiedene E-Mail Adressen anzugeben, trenne sie mit Kommata voneinander. Für einen allgemeinen Benutzernamen benutze ein * (z.B. *@hotmail.de)';

$lang['Unban_username'] = 'Einen oder mehrere Benutzer entsperren';
$lang['Unban_username_explain'] = 'Mit einer Kombination aus Tastatur und Maus kannst du auch mehrere Benutzer auf einmal entsperren';

$lang['Unban_IP'] = 'Eine oder mehrere IP-Adressen entsperren';
$lang['Unban_IP_explain'] = 'Mit einer Kombination aus Tastatur und Maus kannst du auch mehrere IP-Adressen auf einmal entsperren';

$lang['Unban_email'] = 'Eine oder mehrere E-Mail Adressen entsperren';
$lang['Unban_email_explain'] = 'Mit einer Kombination aus Tastatur und Maus kannst du auch mehrere E-Mail Adressen auf einmal entsperren';

$lang['No_banned_users'] = 'Keine gesperrten Benutzernamen';
$lang['No_banned_ip'] = 'Keine gebannten IP-Adressen';
$lang['No_banned_email'] = 'Keine gebannten E-Mail Adressen';

$lang['Ban_update_sucessful'] = 'Die Banliste wurde aktualisiert';
$lang['Click_return_banadmin'] = 'Klicke %shier%s, um zur Sperr-Kontrolle zurückzukehren';


//
// Configuration
//
$lang['General_Config'] = 'Allgemeine Konfiguration';
$lang['Config_explain'] = 'Hier kannst du die allgemeinen Einstellungen deines Forums ändern. Für Benutzer- und Foreneinstellungen nutze bitte die Links auf der linken Seite.';

$lang['Click_return_config'] = 'Klicke %shier%s, um zur allgemeinen Konfiguration zurückzukehren';

$lang['General_settings'] = 'Allgemeine Boardeinstellungen';
$lang['Server_name'] = 'Domainname';
$lang['Server_name_explain'] = 'Der Name der Domain, auf der das Board läuft';
$lang['Script_path'] = 'Scriptpfad';
$lang['Script_path_explain'] = 'Der Pfad zu phpBB2, relativ zum Domainnamen';
$lang['Server_port'] = 'Server Port';
$lang['Server_port_explain'] = 'Der Port, unter dem dein Server läuft, normalerweise 80. Ändere dies nur, wenn es ein anderer ist';
$lang['Site_name'] = 'Name der Seite';
$lang['Site_desc'] = 'Beschreibung der Seite';
$lang['Board_disable'] = 'Board deaktivieren';
$lang['Board_disable_explain'] = 'Hiermit sperrst du das Forum für alle Benutzer. Administratoren können auf den Administrations-Bereich zugreifen, wenn das Forum gesperrt ist.';
$lang['Acct_activation'] = 'Account-Freischaltung aktivieren';
$lang['Acc_None'] = 'Keine'; // These three entries are the type of activation
$lang['Acc_User'] = 'Per E-Mail';
$lang['Acc_Admin'] = 'Durch den Admin';

$lang['Abilities_settings'] = 'Standard Benutzer- und Foreneinstellungen';
$lang['Max_poll_options'] = 'Maximale Anzahl der Umfrageoptionen';
$lang['Flood_Interval'] = 'Flood-Intervall';
$lang['Flood_Interval_explain'] = 'Anzahl der Sekunden, die ein Benutzer warten muss, bevor er einen neuen Beitrag schreiben kann';
$lang['Board_email_form'] = 'Benutzer E-Mails per Board';
$lang['Board_email_form_explain'] = 'Deine Benutzer können sich über das Board E-Mails schreiben';
$lang['Topics_per_page'] = 'Themen pro Seite';
$lang['Posts_per_page'] = 'Beiträge pro Seite';
$lang['Hot_threshold'] = 'Beiträge, die ein Thema braucht, um ein \'Hot Topic\' zu werden';
$lang['Default_style'] = 'Standard-Style';
$lang['Override_style'] = 'Style überschreiben';
$lang['Override_style_explain'] = 'Vom Benutzer gewähltes Style überschreiben';
$lang['Default_language'] = 'Standard-Sprache';
$lang['Date_format'] = 'Datumsformat';
$lang['System_timezone'] = 'Zeitzone';
$lang['Enable_gzip'] = 'GZip-Komprimierung aktivieren';
$lang['Enable_prune'] = 'Forumspruning aktivieren';
$lang['Allow_HTML'] = 'HTML erlauben';
$lang['Allow_BBCode'] = 'BBCode erlauben';
$lang['Allowed_tags'] = 'Erlaubte HTML-Tags';
$lang['Allowed_tags_explain'] = 'Trenne die Tags mit Kommata';
$lang['Allow_smilies'] = 'Smilies erlauben';
$lang['Smilies_path'] = 'Speicherort für Smilies';
$lang['Smilies_path_explain'] = 'Der Pfad in deinem phpBB-Verzeichnis, in dem die Smilies liegen (z. B. images/smiles)';
$lang['Allow_sig'] = 'Signaturen erlauben';
$lang['Max_sig_length'] = 'Maximale Signaturlänge';
$lang['Max_sig_length_explain'] = 'Die maximale Anzahl an Zeichen, die ein Benutzer in seiner Signatur nutzen darf';
$lang['Allow_name_change'] = 'Namenswechsel erlauben';

$lang['Avatar_settings'] = 'Avatareinstellungen';
$lang['Allow_local'] = 'Galerieavatare erlauben';
$lang['Allow_remote'] = 'Avatarremote erlauben';
$lang['Allow_remote_explain'] = 'Avatare, die von einer anderen Site verlinkt werden';
$lang['Allow_upload'] = 'Hochladen von Avataren erlauben';
$lang['Max_filesize'] = 'Maximale Größe';
$lang['Max_filesize_explain'] = 'Für hochgeladene Avatare';
$lang['Max_avatar_size'] = 'Maximale Abmessungen des Avatars';
$lang['Max_avatar_size_explain'] = '(Höhe x Breite in Pixel)';
$lang['Avatar_storage_path'] = 'Avatar Speicherpfad';
$lang['Avatar_storage_path_explain'] = 'Der Pfad in deinem phpBB-Verzeichnis, in dem die Avatare liegen (z. B. images/avatars)';
$lang['Avatar_gallery_path'] = 'Avatar Galeriepfad';
$lang['Avatar_gallery_path_explain'] = 'Der Pfad in deinem phpBB-Verzeichnis, in dem die Galerie-Avatare liegen (z. B. images/avatars/gallery)';

$lang['COPPA_settings'] = 'COPPA Einstellungen';
$lang['COPPA_fax'] = 'COPPA Fax Nummer';
$lang['COPPA_mail'] = 'COPPA E-Mail Adresse';
$lang['COPPA_mail_explain'] = 'Zu dieser E-Mail Adresse schicken die Eltern die COPPA Einverständniserklärung';

$lang['Email_settings'] = 'E-Mail Einstellungen';
$lang['Admin_email'] = 'E-Mail Adresse des Administrators';
$lang['Email_sig'] = 'E-Mail Signatur';
$lang['Email_sig_explain'] = 'Diese Signatur wird an alle E-Mails des Administrators angehängt';
$lang['Use_SMTP'] = 'Nutze einen SMTP Server zum Mailen';
$lang['Use_SMTP_explain'] = 'Wähle \'Ja\', wenn du möchtest, dass deine E-Mails über einen SMTP-Server gesendet werden';
$lang['SMTP_server'] = 'SMTP-Server Addresse';
$lang['SMTP_username'] = 'SMTP Benutzername';
$lang['SMTP_username_explain'] = 'Gib nur dann einen Benutzernamen an, wenn der SMTP-Server dies benötigt';
$lang['SMTP_password'] = 'SMTP Passwort';
$lang['SMTP_password_explain'] = 'Gib nur dann ein Passwort an, wenn der SMTP-Server dies benötigt';

$lang['Disable_privmsg'] = 'Private Nachrichten';
$lang['Inbox_limits'] = 'Maximale Nachrichten im Eingang';
$lang['Sentbox_limits'] = 'Maximale Nachrichten im Ausgang';
$lang['Savebox_limits'] = 'Maximale Anzahl gespeicherter Nachrichten';

$lang['Cookie_settings'] = 'Cookie Einstellungen';
$lang['Cookie_settings_explain'] = 'Hier kannst du einstellen, was für Cookies zum Browser gesendet werden. Meistens stimmen die Standardeinstellungen. Solltest du sie ändern müssen, tue es mit Bedacht, ansonsten kann sich niemand mehr im Forum einloggen.';
$lang['Cookie_domain'] = 'Cookie-Domain';
$lang['Cookie_name'] = 'Cookie-Name';
$lang['Cookie_path'] = 'Cookie-Pfad';
$lang['Cookie_secure'] = 'Sicherers Cookie';
$lang['Cookie_secure_explain'] = 'Falls dein Server auf SSL läuft, aktiviere diese Funktion, ansonsten lasse sie deaktiviert';
$lang['Session_length'] = 'Sessionlänge [ Sekunden ]';

// Visual Confirmation 
$lang['Visual_confirm'] = 'Aktiviere visuelle Bestätigung'; 
$lang['Visual_confirm_explain'] = 'Benutzer müssen bei der Registrierung einen durch ein Bild vorgegeben Schlüssel eingeben.';

// Autologin Keys - added 2.0.18
$lang['Allow_autologin'] = 'Automatisches Login aktivieren'; 
$lang['Allow_autologin_explain'] = 'Bestimmt ob Benutzer die Option wählen können bei Rückkehr ins Forum automatisch eingeloggt zu sein oder nicht'; 
$lang['Autologin_time'] = 'Ablauf des Auto-Login Schlüssels'; 
$lang['Autologin_time_explain'] = 'Wieviele Tage soll der Auto-Login Schlüssel gültig sein nach dem letzten Login des Benutzers? Gebe eine 0 für unbegrenzte Gültigkeit ein.'; 

// Search Flood Control - added 2.0.20
$lang['Search_Flood_Interval'] = 'Such-Flood-Intervall';
$lang['Search_Flood_Interval_explain'] = 'Anzahl der Sekunden, die ein Benutzer warten muss, bevor er eine neue Suche starten kann'; 

//
// Forum Management
//
$lang['Forum_admin'] = 'Forum Administration';
$lang['Forum_admin_explain'] = 'Hier kannst du Kategorien und Foren hinzufügen, löschen, bearbeiten und neu anordnen.';
$lang['Edit_forum'] = 'Forum bearbeiten';
$lang['Create_forum'] = 'Neues Forum erstellen';
$lang['Create_category'] = 'Neue Kategorie erstellen';
$lang['Remove'] = 'Entfernen';
$lang['Action'] = 'Aktion';
$lang['Update_order'] = 'Reihenfolge ändern';
$lang['Config_updated'] = 'Forumskonfiguration geändert';
$lang['Edit'] = 'Bearbeiten';
$lang['Delete'] = 'Löschen';
$lang['Move_up'] = 'Nach oben';
$lang['Move_down'] = 'Nach unten';
$lang['Resync'] = 'Resync';
$lang['No_mode'] = 'Kein Modus ausgewählt';
$lang['Forum_edit_delete_explain'] = 'Hier kannst du alle allgemeinen Boardeinstellungen anpassen. Zur Benutzer- und Forenkonfiguration benutze bitte die entsprechenden Links auf der linken Seite';

$lang['Move_contents'] = 'Alle Inhalte verschieben';
$lang['Forum_delete'] = 'Forum löschen';
$lang['Forum_delete_explain'] = 'Hier kannst du ein Forum oder eine Kategorie löschen und entscheiden, wohin die enthaltenen Themen oder Foren verschoben werden sollen.';

$lang['Status_locked'] = 'Gesperrt';
$lang['Status_unlocked'] = 'Entsperrt';
$lang['Forum_settings'] = 'Allgemeine Foreneinstellungen';
$lang['Forum_name'] = 'Forumsname';
$lang['Forum_desc'] = 'Beschreibung';
$lang['Forum_status'] = 'Forumsstatus';
$lang['Forum_pruning'] = 'Automatisches Pruning';

$lang['prune_freq'] = 'Überprüfe das Themenalter alle';
$lang['prune_days'] = 'Entferne Themen, in denen nichts mehr geschrieben wurde seit';
$lang['Set_prune_data'] = 'Du hast das automatische Pruning für dieses Forum aktiviert, aber weder ein Intervall noch eine Anzahl an Tagen angegeben.';

$lang['Move_and_Delete'] = 'Verschieben und Löschen';

$lang['Delete_all_posts'] = 'Alle Beiträge löschen';
$lang['Nowhere_to_move'] = 'Kein Ziel zum Verschieben';

$lang['Edit_Category'] = 'Kategorie editieren';
$lang['Edit_Category_explain'] = 'Hier kannst du den Namen einer Kategorie ändern';

$lang['Forums_updated'] = 'Forums- und Kategorieinformationen wurden geändert';

$lang['Must_delete_forums'] = 'Du musst erst alle Foren löschen, bevor du diese Kategorie löschen kannst';

$lang['Click_return_forumadmin'] = 'Klicke %shier%s, um zur Forumsadministration zurückzukehren';


//
// Smiley Management
//
$lang['smiley_title'] = 'Smiley-Bearbeitung';
$lang['smile_desc'] = 'Hier kannst du die Smilies, die die Benutzer in ihren Beiträgen und Privaten Nachrichten einfügen können, hinzufügen, löschen oder bearbeiten.';

$lang['smiley_config'] = 'Smiley-Konfiguration';
$lang['smiley_code'] = 'Smiley Code';
$lang['smiley_url'] = 'Smiley Bilddatei';
$lang['smiley_emot'] = 'Smiley Beschreibung';
$lang['smile_add'] = 'Einen neuen Smiley hinzufügen';
$lang['Smile'] = 'Smiley';
$lang['Emotion'] = 'Beschreibung';

$lang['Select_pak'] = 'Wähle Paketdatei (.pak)';
$lang['replace_existing'] = 'Aktuelle Smilies überschreiben';
$lang['keep_existing'] = 'Aktuelle Smilies behalten';
$lang['smiley_import_inst'] = 'Du solltest das Smiley-Paket entzippen und alle Dateien ins jeweilige Smiley-Verzeichnis hochladen. Wähle dann die korrekten Angaben, um das Paket zu installieren.';
$lang['smiley_import'] = 'Smiley-Paketimport';
$lang['choose_smile_pak'] = 'Wähle ein Smiley-Paket (.pak)';
$lang['import'] = 'Smilies importieren';
$lang['smile_conflicts'] = ' Was tun, wenn Konflikte auftreten?';
$lang['del_existing_smileys'] = 'Aktuelle Smilies vor dem Import löschen';
$lang['import_smile_pack'] = 'Smiley-Paket importieren';
$lang['export_smile_pack'] = 'Smiley-Paket erstellen';
$lang['export_smiles'] = 'Um aus deinen jetzigen Smilies ein Paket zu erstellen, klicke %shier%s, um das Paket herunterzuladen. Achte darauf, die .pak-Erweiterung am Ende beizubehalten. Erstelle dann eine Zip-Datei mit allen benutzten Smilies und der .pak-Datei.';

$lang['smiley_add_success'] = 'Der Smiley wurde hinzugefügt';
$lang['smiley_edit_success'] = 'Der Smiley wurde geändert';
$lang['smiley_import_success'] = 'Das Smiley-Paket wurde installiert';
$lang['smiley_del_success'] = 'Der Smiley wurde gelöscht';
$lang['Click_return_smileadmin'] = 'Klicke %shier%s, um zur Smiley-Verwaltung zurückzukehren';
$lang['Confirm_delete_smiley'] = 'Diesen Smiley wirklich löschen?';

//
// User Management
//
$lang['User_admin'] = 'Benutzer-Administration';
$lang['User_admin_explain'] = 'Hier kannst du die Daten und Optionen eines Nutzers ändern. Um die Befugnisse eines Benutzers zu ändern, benutze bitte die Benutzer- und Gruppenkontrolle.';

$lang['Look_up_user'] = 'Benutzer auswählen';

$lang['Admin_user_fail'] = 'Benutzerprofil konnte nicht geändert werden';
$lang['Admin_user_updated'] = 'Benutzerprofil geändert';
$lang['Click_return_useradmin'] = 'Klicke %shier%s, um zur Benutzeradministration zurückzukehren';

$lang['User_delete'] = 'Diesen Benutzer löschen';
$lang['User_delete_explain'] = 'Klicke hier, um den Benutzer zu löschen - diese Aktion kann nicht rückgängig gemacht werden.';
$lang['User_deleted'] = 'Benutzer wurde gelöscht';

$lang['User_status'] = 'Benutzer ist aktiv';
$lang['User_allowpm'] = 'Darf Private Nachrichten verschicken';
$lang['User_allowavatar'] = 'Darf einen Avatar benutzen';

$lang['Admin_avatar_explain'] = 'Hier kannst du den Avatar des Benutzers ansehen und löschen';

$lang['User_special'] = 'Spezielle Optionen (nur für Administratoren)';
$lang['User_special_explain'] = 'Diese Optionen könnten nicht von den Benutzern geändert werden. Du kannst hier ihren Status und andere Optionen festlegen, die den Benutzern nicht zur Verfügung stehen.';


//
// Group Management
//
$lang['Group_administration'] = 'Gruppenadministration';
$lang['Group_admin_explain'] = 'Hier kannst du die Benutzergruppen deines Forum überwachen. Du kannst bestehende Gruppen löschen oder editieren oder neue anlegen. Ebenso kannst du Gruppenleiter wählen, den Gruppenstatus auf offen/geschlossen ändern und den Gruppennamen bzw. die Gruppenbeschreibung ändern';
$lang['Error_updating_groups'] = 'Fehler beim Aktualisieren der Gruppe';
$lang['Updated_group'] = 'Die Gruppe wurde abgeändert';
$lang['Added_new_group'] = 'Die Gruppe wurde hinzugefügt';
$lang['Deleted_group'] = 'Die Gruppe wurde gelöscht';
$lang['New_group'] = 'Neue Gruppe erstellen';
$lang['Edit_group'] = 'Gruppe bearbeiten';
$lang['group_name'] = 'Gruppenname';
$lang['group_description'] = 'Gruppenbeschreibung';
$lang['group_moderator'] = 'Gruppenleiter';
$lang['group_status'] = 'Gruppenstatus';
$lang['group_open'] = 'Offene Gruppe';
$lang['group_closed'] = 'Geschlossene Gruppe';
$lang['group_hidden'] = 'Versteckte Gruppe';
$lang['group_delete'] = 'Gelöschte Gruppe';
$lang['group_delete_check'] = 'Diese Gruppe löschen';
$lang['submit_group_changes'] = 'Änderungen übernehmen';
$lang['reset_group_changes'] = 'Reset';
$lang['No_group_name'] = 'Bitte gib einen Gruppennamen an';
$lang['No_group_moderator'] = 'Bitte gib einen Gruppenleiter an';
$lang['No_group_mode'] = 'Du musst einen Status für diese Gruppe angeben (offen/geschlossen)';
$lang['No_group_action'] = 'Es wurde keine Aktion ausgewählt';
$lang['delete_group_moderator'] = 'Alten Gruppenleiter entfernen?';
$lang['delete_moderator_explain'] = 'Wenn du den Gruppenleiter wechseln möchtest, wähle die entsprechende Option, um den alten Leiter zu entfernen. Ansonsten wähle die Option nicht und der Benutzer wird ein reguläres Mitglied der Gruppe.';
$lang['Click_return_groupsadmin'] = 'Klicke %shier%s, um zur Gruppenadministration zurückzukehren.';
$lang['Select_group'] = 'Gruppe wählen';
$lang['Look_up_group'] = 'Gruppe finden';


//
// Prune Administration
//
$lang['Forum_Prune'] = 'Forum Prune';
$lang['Forum_Prune_explain'] = 'Du kannst angeben, dass alle Themen, in denen seit einer gewissen Zeit nichts gepostet wurde, gelöscht werden. Solltest du keine Zahl angeben, werden alle Themen gelöscht. Laufende Umfragen und Ankündigungen sind davon nicht betroffen. Diese Themen müssen manuell entfernt werden.';
$lang['Do_Prune'] = 'Prune einetzen';
$lang['All_Forums'] = 'Alle Foren';
$lang['Prune_topics_not_posted'] = 'Prune Themen, in denen es keine Antworten gab';
$lang['Topics_pruned'] = 'Prune-Themen';
$lang['Posts_pruned'] = 'Prune-Beiträge';
$lang['Prune_success'] = 'Das Prunen des Forums wurde aktiviert';


//
// Word censor
//
$lang['Words_title'] = 'Wortzensur';
$lang['Words_explain'] = 'Hier kannst du Wörter bestimmen, die automatisch aus den Beiträgen zensiert werden. Außerdem kann kein Benutzer einen Namen wählen, in dem diese Wörter vorkommen. Du kannst ein * als Platzhalter im Word-Feld verwenden. Beispiel: Fisch* entfernt Wörter wie Fischbesteck, Fischfang usw., *Fisch entfernt Backfisch, Stockfisch usw.';
$lang['Word'] = 'Wort';
$lang['Edit_word_censor'] = 'Wortzensur ändern';
$lang['Replacement'] = 'Ersatz';
$lang['Add_new_word'] = 'Neues Wort hinzufügen';
$lang['Update_word'] = 'Zensur aktualisieren';

$lang['Must_enter_word'] = 'Ein Wort und ein entsprechender Ersatz sind nötig';
$lang['No_word_selected'] = 'Kein Wort zum Editieren ausgewählt';

$lang['Word_updated'] = 'Die Wortzensur wurde aktualisiert';
$lang['Word_added'] = 'Die Wortzensur wurde eingerichtet';
$lang['Word_removed'] = 'Die Wortzensur wurde entfernt';

$lang['Confirm_delete_word'] = 'Diese Wortzensur wirklich löschen?';

$lang['Click_return_wordadmin'] = 'Klicke %shier%s, um zur Wortzensur-Administration zurückzukehren';


//
// Mass Email
//
$lang['Mass_email_explain'] = 'Hier kannst du entweder allen registrierten Benutzern oder einer bestimmten Gruppe eine Nachricht schicken. Diese Nachricht wird an das Postfach des Administrators geschickt und anonym (BCC) an alle Empfänger. Solltest du einer großen Gruppe eine E-Mail schicken, habe etwas Geduld und brich den Vorgang nicht ab. Es ist völlig normal, dass der Vorgang länger dauert und du erhältst eine Rückmeldung, wenn das Skript beendet ist';
$lang['Compose'] = 'Erstellen';

$lang['Recipients'] = 'Empfänger';
$lang['All_users'] = 'Alle Benutzer';

$lang['Email_successfull'] = 'Die Nachricht wurde gesendet';
$lang['Click_return_massemail'] = 'Klicke %shier%s, um zur Massen E-Mail zurückzukehren';


//
// Ranks admin
//
$lang['Ranks_title'] = 'Rank-Administration';
$lang['Ranks_explain'] = 'Hier kannst du Ränge hinzufügen, editieren, anschauen und löschen. Du kannst ebenfalls eigene Ränge erstellen, die du per Benutzeradministration an spezielle Benutzer vergibst.';

$lang['Add_new_rank'] = 'Neuen Rang anlegen';

$lang['Rank_title'] = 'Rankname';
$lang['Rank_special'] = 'Spezialrang';
$lang['Rank_minimum'] = 'Minimum-Beiträge';
$lang['Rank_maximum'] = 'Maximum-Beiträge';
$lang['Rank_image'] = 'Bild zum Rang (relativ zum Forenpfad)';
$lang['Rank_image_explain'] = 'Du kannst hier ein Bild bestimmen, dass dem jeweiligen Rang zugeordnet ist';

$lang['Must_select_rank'] = 'Wähle einen Rang aus';
$lang['No_assigned_rank'] = 'Kein Spezialrang vergeben';

$lang['Rank_updated'] = 'Die Ranginformationen wurden aktualisiert';
$lang['Rank_added'] = 'Der Rang wurde hinzugefügt';
$lang['Rank_removed'] = 'Der Rang wurde gelöscht';
$lang['No_update_ranks'] = 'Der Rang wurde erfolgreich gelöscht. Allerdings wurden Benutzer, denen dieser Rang zugeordnet war, nicht aktualisiert. Du musst den Rang bei diesen Benutzern manuell aktualisieren';

$lang['Click_return_rankadmin'] = 'Klicke %shier%s, um zur Rank Administration zurückzukehren';
$lang['Confirm_delete_rank'] = 'Diesen Rang wirklich löschen?';

//
// Disallow Username Admin
//
$lang['Disallow_control'] = 'Verbot von Benutzernamen';
$lang['Disallow_explain'] = 'Hier kannst du Benutzernamen überwachen, die nicht genutzt werden dürfen. Du kannst einen Stern (*) als Platzhalter setzen. Beachte, dass du den jeweiligen Benutzer zuerst löschen musst, wenn du einen bereits vergebenen Benutzernamen wählst.';

$lang['Delete_disallow'] = 'Löschen';
$lang['Delete_disallow_title'] = 'Einen verbotenen Namen entfernen';
$lang['Delete_disallow_explain'] = 'Du kannst einen verbotenen Namen entfernen, indem du den Namen aus der Liste auswählst und Abschicken anklickst';

$lang['Add_disallow'] = 'Hinzufügen';
$lang['Add_disallow_title'] = 'Einen verbotenen Namen hinzufügen';
$lang['Add_disallow_explain'] = 'Du kannst ein * benutzen, um jegliche Benutzernamen zu verbieten';

$lang['No_disallowed'] = 'Keine verbotenen Benutzernamen';

$lang['Disallowed_deleted'] = 'Der verbotene Benutzername ist nun wieder gestattet';
$lang['Disallow_successful'] = 'Der verbotene Benutzername wurde hinzugefügt';
$lang['Disallowed_already'] = 'Der angebene Benuztername kann nicht verboten werden. Er existiert entweder schon oder stimmt mit einem existierenden überein.';

$lang['Click_return_disallowadmin'] = 'Klicke %shier%s, um zum Verbot der Benutzernamen zurückzukehren';


//
// Styles Admin
//
$lang['Styles_admin'] = 'Styles Administration';
$lang['Styles_explain'] = 'Hier kannst du Styles (Templates und Themes) hinzufügen, löschen und überwachen.';
$lang['Styles_addnew_explain'] = 'In der folgenden Liste sind alle für dieses Template verfügbaren Themes aufgeführt. Die in der Liste aufgeführten Objekte wurden der Datenbank noch nicht zugefügt. Um ein Theme zu installieren, klicke einfach auf den Installieren-Link neben einem Eintrag';

$lang['Select_template'] = 'Wähle ein Template';

$lang['Style'] = 'Style';
$lang['Template'] = 'Template';
$lang['Install'] = 'Installieren';
$lang['Download'] = 'Runterladen';

$lang['Edit_theme'] = 'Theme editieren';
$lang['Edit_theme_explain'] = 'Hier kannst du die Einstellungen für das gewählte Theme ändern';

$lang['Create_theme'] = 'Theme erstellen';
$lang['Create_theme_explain'] = 'Hier kannst du ein neues Theme für das gewählte Template erstellen. Wenn du Farben eingibst (für die du Hexdezimalzahlen nutzen solltest), darfst du das # nicht mit angeben - CCCCCC ist z. B. korrekt, #CCCCCC nicht';

$lang['Export_themes'] = 'Theme exportieren';
$lang['Export_explain'] = 'Hier kannst du die Themedaten für ein bestimmtes Template exportieren. Wähle das Template aus der unteren Liste, und das Script wird die Themekonfigurationsdatei erstellen und versuchen, sie in den Templateordner zu speichern. Falls es die Datei nicht selbst speichern kann, kannst du sie runterladen. Um dem Skript das Schreiben der Datei zu ermöglichen, musst du dem gewählten Templateordner Schreibrechte gewähren. Für weitere Informationen siehe den phpBB2 Benutzerguide.';

$lang['Theme_installed'] = 'Das gewählte Theme wurde installiert';
$lang['Style_removed'] = 'Der gewählte Style wurde aus der Datenbank entfernt. Um den Style völlig vom System zu entfernen, musst du es aus deinem Templates-Ordner löschen.';
$lang['Theme_info_saved'] = 'Die Themeinformationen für das gewählte Template wurden gespeichert. Du solltest jetzt die Erlaubnis der theme_info.cfg (und eventueller Verzeichnisse) auf Nur-Lesen zurück stellen';
$lang['Theme_updated'] = 'Das gewählte Theme wurde aktualisiert. Du solltest die neuen Themeeinstellungen jetzt exportieren.';
$lang['Theme_created'] = 'Theme erstellt. Du solltest das Theme jetzt in die Themekonfiguration exportieren, damit es nicht verloren geht oder du es an anderer Stelle einsetzen kannst.';

$lang['Confirm_delete_style'] = 'Diesen Style wirklich löschen?';

$lang['Download_theme_cfg'] = 'Der Exporter konnte nicht in die Themeinformationsdatei schreiben. Klicke auf den unteren Knopf, um die Datei per Browser runterzuladen. Hast du sie runtergeladen, kannst du sie in deinen Ordner mit den Templatedateien kopieren. Schließlich kannst du die Dateien zu einem Paket zusammenschließen.';
$lang['No_themes'] = 'Das gewählte Template hat keine verfügbaren Themes. Um ein neues Theme zu erstellen, klicke auf den Theme-erstellen-Link auf der linken Seite';
$lang['No_template_dir'] = 'Konnte das Template-Verzeichnis nicht öffnen. Es ist eventuell unlesbar oder existiert nicht (mehr).';
$lang['Cannot_remove_style'] = 'Du kannst den gewählten Style nicht entfernen, da er zum Forumsstandard gehört. Du kannst jedoch einen anderen Forumsstandard wählen und es erneut versuchen.';
$lang['Style_exists'] = 'Der gewählte Stylename existiert bereits, bitte gehe zurück und wähle einen anderen Namen.';

$lang['Click_return_styleadmin'] = 'Klicke %shier%s, um zur Styles Administration zurückzukehren';

$lang['Theme_settings'] = 'Theme Einstellungen';
$lang['Theme_element'] = 'Theme Element';
$lang['Simple_name'] = 'Einfacher Name';
$lang['Value'] = 'Wert';
$lang['Save_Settings'] = 'Einstellungen übernehmen';

$lang['Stylesheet'] = 'CSS Stylesheet';
$lang['Stylesheet_explain'] = 'Dateiname des CSS Stylesheet das für dieses Template benutzt werden soll.';
$lang['Background_image'] = 'Hintergrundbild';
$lang['Background_color'] = 'Hintergrundfarbe';
$lang['Theme_name'] = 'Themename';
$lang['Text_color'] = 'Textfarbe';
$lang['Link_color'] = 'Linkfarbe';
$lang['VLink_color'] = 'Farbe für gesehener Link';
$lang['ALink_color'] = 'Farbe für aktiver Link';
$lang['HLink_color'] = 'Farbe für gewählter Link';
$lang['Tr_color1'] = 'Farbe für Tabellenreihe 1';
$lang['Tr_color2'] = 'Farbe für Tabellenreihe 2';
$lang['Tr_color3'] = 'Farbe für Tabellenreihe 3';
$lang['Tr_class1'] = 'Tabellenreihe Klasse 1';
$lang['Tr_class2'] = 'Tabellenreihe Klasse 2';
$lang['Tr_class3'] = 'Tabellenreihe Klasse 3';
$lang['Th_color1'] = 'Farbe für Tabellenkopf 1';
$lang['Th_color2'] = 'Farbe für Tabellenkopf 2';
$lang['Th_color3'] = 'Farbe für Tabellenkopf 3';
$lang['Th_class1'] = 'Tabellenkopf Klasse 1';
$lang['Th_class2'] = 'Tabellenkopf Klasse 2';
$lang['Th_class3'] = 'Tabellenkopf Klasse 3';
$lang['Td_color1'] = 'Farbe für Tabellenzelle 1';
$lang['Td_color2'] = 'Farbe für Tabellenzelle 2';
$lang['Td_color3'] = 'Farbe für Tabellenzelle 3';
$lang['Td_class1'] = 'Tabellenzelle Klasse 1';
$lang['Td_class2'] = 'Tabellenzelle Klasse 2';
$lang['Td_class3'] = 'Tabellenzelle Klasse 3';
$lang['fontface1'] = 'Schriftart 1';
$lang['fontface2'] = 'Schriftart 2';
$lang['fontface3'] = 'Schriftart 3';
$lang['fontsize1'] = 'Schriftgrösse 1';
$lang['fontsize2'] = 'Schriftgrösse 2';
$lang['fontsize3'] = 'Schriftgrösse 3';
$lang['fontcolor1'] = 'Schriftfarbe 1';
$lang['fontcolor2'] = 'Schriftfarbe 2';
$lang['fontcolor3'] = 'Schriftfarbe 3';
$lang['span_class1'] = 'Abstand Klasse 1';
$lang['span_class2'] = 'Abstand Klasse 2';
$lang['span_class3'] = 'Abstand Klasse 3';
$lang['img_poll_size'] = 'Umfragen-Symbolgröße [px]';
$lang['img_pm_size'] = 'Private Nachrichten-Statussymbolgröße [px]';


//
// Install Process
//
$lang['Initial_config'] = 'Grundeinstellungen';
$lang['DB_config'] = 'Datenbankkonfiguration';
$lang['Admin_config'] = 'Administratorkonfiguration';
$lang['continue_upgrade'] = 'Sobald du die Konfigurationsdatei auf deinen Rechner herunter geladen hast, kannst du die Schaltfläche \'Upgrade fortsetzen\' betätigen, um mit dem Upgrade-Prozess fortzufahren. Bitte warte mit dem Hochladen der Konfigurationsdatei, bis der Upgrade-Prozess beendet ist.';
$lang['upgrade_submit'] = 'Upgrade fortsetzen';

$lang['Installer_Error'] = 'Während der Installation trat ein Fehler auf';
$lang['Previous_Install'] = 'Eine vorherige Installation wurde entdeckt';
$lang['Install_db_error'] = 'Beim Update der Datenbank trat ein Fehler auf';

$lang['Re_install'] = 'Deine vorherige Installation ist noch aktiv.<br /><br />Falls Du phpBB2 neu installieren möchtest, aktiviere den unten stehenden Ja-Knopf. Beachte jedoch, dass dieser Vorgang sämtliche existierenden Daten zerstören wird und keine Sicherungen vorgenommen werden. Der Administrator-Benutzername und das Passwort, das du benutzt hast, um dich im Board einzuloggen, werden nach der Neuinstallation erneut erstellt. Es bleiben sonst keine Einstellungen zurück.<br /><br />Überlege es dir gut, bevor du auf Ja klickst';

$lang['Start_Install'] = 'Installation beginnen';
$lang['Finish_Install'] = 'Installation abschließen';

$lang['Default_lang'] = 'Standardsprache';
$lang['DB_Host'] = 'Datenbank: Host / DSN';
$lang['DB_Name'] = 'Name der Datenbank';
$lang['DB_Username'] = 'Datenbank Benutzername';
$lang['DB_Password'] = 'Datenbank Passwort';
$lang['Database'] = 'Deine Datenbank';
$lang['Install_lang'] = 'Wähle Sprache für die Installation';
$lang['dbms'] = 'Datenbanktyp';
$lang['Table_Prefix'] = 'Prefix für die Tabellen in der Datenbank';
$lang['Admin_Username'] = 'Administrator Benutzername';
$lang['Admin_Password'] = 'Administrator Passwort';
$lang['Admin_Password_confirm'] = 'Administrator Passwort [ Bestätigung ]';

$lang['Inst_Step_2'] = 'Dein Administrator-Benutzername wurde erstellt. Deine Installation ist nun komplett. Du wirst jetzt auf eine Seite geführt, wo du dein neues Board deinen Bedürfnissen anpassen kannst. Überprüfe am besten gleich die Allgemeine Konfiguration und nehme eventuell nötige Änderungen vor. Danke, dass du dich für phpBB 2 entschieden hast.';

$lang['Unwriteable_config'] = 'Momentan ist deine Konfigurationsdatei nicht beschreibbar. Du kannst dir eine Kopie der Datei runterladen, wenn du auf den entsprechenden Link unten klickst. Du solltest diese Datei ins selbe Verzeichnis wie phpBB2 hochladen. Wenn dies getan ist, solltest du dich mit deinem Administrator-Benutzernamen und Passwort, die du auf der letzten Seite angegeben hast, einloggen und den Administrationsbereich betreten, um die allgemeinen Einstellungen zu prüfen. Einen entsprechenden Link findest du am Ende jeder Seite deines Forums. Danke, dass du dich für phpBB 2 entschieden hast.';
$lang['Download_config'] = 'Konfigurationsdatei herunterladen';

$lang['ftp_choose'] = 'Wähle Downloadmethode';
$lang['ftp_option'] = '<br />Da FTP Erweiterungen in dieser Version von PHP aktiviert sind, könntest du die Möglichkeit haben, die Konfigurationsdatei automatisch per FTP vor Ort zu ändern.';
$lang['ftp_instructs'] = 'Du hast dich dazu entschieden, die Datei automatisch und vor Ort zu ändern. Bitte gib die unten geforderten Informationen an, um den Prozess zu starten. Beachte, dass der FTP-Pfad der exakte Pfad zu deinem phpBB2-Ordner sein muss.';
$lang['ftp_info'] = 'Eingabe der FTP Informationen';
$lang['Attempt_ftp'] = 'Die Konfigurationsdatei vor Ort umschreiben';
$lang['Send_file'] = 'Ich möchte, dass mir die Datei geschickt wird. Ich werde sie manuell hochladen.';
$lang['ftp_path'] = 'FTP-Pfad zum phpBB2';
$lang['ftp_username'] = 'Dein FTP Benutzername';
$lang['ftp_password'] = 'Dein FTP Passwort';
$lang['Transfer_config'] = 'Transfer beginnen';
$lang['NoFTP_config'] = 'Der Versuch, die Konfigurationsdatei vor Ort umzuschreiben, scheiterte. Bitte lade die Datei runter und lade sie manuell hoch.';

$lang['Install'] = 'Installation';
$lang['Upgrade'] = 'Upgrade';


$lang['Install_Method'] = 'Wähle eine Installations-Methode aus';

$lang['Install_No_Ext'] = 'Die PHP-Konfiguration auf deinem Server unterstützt nicht den gewählten Datenbank-Typ';

$lang['Install_No_PCRE'] = 'phpBB 2 benötigt das Perl-Compatible Regular Expressions Module für PHP, was von deiner PHP-Konfiguration anscheinend nicht unterstützt wird.';

// Additional Stuff for phpBB2 Plus only ! Translators should get original Language Files for phpBB 2.0.8
// for the language they want to translate from http://www.phpbb.com/downloads.php. Then they need to translate 
// the following stuff only and use the rest from the original language files !

// Start add - Birthday MOD
$lang['Birthday_required'] = 'Die Eingabe des Geburstags erforderlich machen';
$lang['Enable_birthday_greeting'] = "Geburtstagsgrüße aktivieren"; 
$lang['Birthday_greeting_expain'] = "Benutzer, die einen Geburtstag angegeben haben, können bei Einloggen in das Forum beglückwünscht werden."; 
$lang['Next_birthday_greeting'] = "Jahr des nächsten Geburtstags-Popups"; 
$lang['Next_birthday_greeting_expain'] = "Dieses Feld gibt an, in welchem Jahr der Benutzer die nächste Glückwunschbenachrichtigung bekommt."; 
$lang['Wrong_next_birthday_greeting'] = "Das angegebene Jahr des nächsten Geburtstags-Popups war nicht korrekt. Bitte nochmal eingeben."; 
$lang['Max_user_age'] = "Höchstalter"; 
$lang['Min_user_age'] = "Mindestalter"; 
$lang['Birthday_lookforward'] = "Geburtstagsvorschau"; 
$lang['Birthday_lookforward_explain'] = "Anzahl der Tage, die vorausgesehen werden soll"; 
// End add - Birthday MOD

// Start add - Last visit MOD
$lang['Hidde_last_logon'] = "Anzeige des letzten Besuchs ausblenden"; 
$lang['Hidde_last_logon_expain'] = "Wenn auf JA gesetzt, wird die Anzeige des letzten Besuchs für alle Benutzer ausgeblendet (bis auf den Administrator!)"; 
// End add - Last visit MOD

// Start Flag Mod
$lang['Flags'] = 'Flaggen';
$lang['Flags_title'] = 'Flaggen Administration';
$lang['Flags_explain'] = 'In diesem Menu können Flaggen hinzugefügt, bearbeitet und gelöscht werden. Du kannst hier ebenfalls eigene Flaggen erstellen, welche über die User-Administration einem Benutzer zugewiesen werden können';
$lang['Add_new_flag'] = 'Flagge hinzufügen';
$lang['Flag_name'] = 'Flaggen Name';
$lang['Flag_pic'] = 'Bild';
$lang['Flag_image'] = 'Flaggenbild (im images/flags/ Verzeichnis)';
$lang['Flag_image_explain'] = 'Hier wird das Bild definiert, welches als Flagge angezeigt wird';
$lang['Must_select_flag'] = 'Du musst eine Flagge auswählen';
$lang['Flag_updated'] = 'Die Flagge wurde erfolgreich bearbeitet';
$lang['Flag_added'] = 'Die Flagge wurde erfolgreich hinzugefügt';
$lang['Flag_removed'] = 'Die Flagge wurde erfolgreich gelöscht';
$lang['No_update_flags'] = 'Die Flagge wurde erfolgreich gelöscht. Benutzer-Accounts, welche diese Flagge eingestellt haben wurden nicht verändert. Du musst die Flagge in diesen Profilen selbst umstellen';
$lang['Flag_confirm'] = 'Flagge löschen' ;
$lang['Confirm_delete_flag'] = 'Bist Du sicher, das Du die gewählte Flagge löschen möchtest ?' ;
$lang['Click_return_flagadmin'] = 'Klicke %shier%s um zur Flaggen Administration zurückzukehren'; 
// End Flag Mod 

// Start Additional Language Stuff phpBB2 Plus specific
$lang['Plus_Settings'] = 'phpBB2 Plus Einstellungen';
$lang['Enable_indexlinks'] = 'Links im Index anzeigen';
$lang['Indexlinks_explain'] = 'Hier kannst Du die Links-Leiste im Index ein/ausschalten';
$lang['General_Plusconfig'] = 'phpBB2 Plus Konfiguration';
$lang['Plusconfig_explain'] = 'Hier kannst Du phpBB2 Plus spezifische Einstellungen vornehmen';
$lang['Select_Layout'] = 'Wähle Index Layout';
$lang['Index_Layout'] = 'Konfiguration phpBB2 Plus'; 
$lang['Plusstyle_explain'] = 'Hier kannst Du das Layout im Forum Index einstellen. Du kannst zwischen dem phpBB2 Default Layout und dem phpBB2 Plus typischen Layout (Live Statistik Box rechts) wählen.'; 
$lang['Plusstyle1'] = 'phpBB2 Default';
$lang['Plusstyle2'] = 'Plus Default';
$lang['Plusstyle3'] = 'nicht verfügbar'; 
$lang['Enable_defaultavatar'] = 'Default Avatar';
$lang['Defaultavatar_explain'] = 'Hier kannst Du wählen ob ein Default Avatar angezeigt werden soll, wenn Der User kein Avatar eingestellt hat. Den Avatar musst Du als default_avatar.gif ins Verzeichnis /images kopieren';
$lang['Enable_quickreply'] = 'Quick Reply Box Anzeige';
$lang['Quickreply_explain'] = 'Hier kannst Du die Anzeige der Quick Reply Box in der Viewtopic Ansicht aktivieren / deaktivieren';
$lang['Enable_shoutbox'] = 'Aktiviere Shoutbox';
$lang['Shoutbox_explain'] = 'Hier kannst Du die Anzeige der Shoutbox aktivieren / deaktivieren';
$lang['Shoutbox_yes'] = 'An';
$lang['Shoutbox_no'] = 'Aus';
$lang['Shoutbox_yes_reg'] = 'An, nur für registrierte';
$lang['Shoutbox_portal'] = 'Nur Portal';
$lang['Shoutbox_portal_reg'] = 'Nur Portal (REG)';
$lang['Shoutbox_index'] = 'Nur Index';
$lang['Shoutbox_index_reg'] = 'Nur Index (REG)';
$lang['Enable_Lastvisit'] = 'Aktiviere Last Visit Anzeige';
$lang['Lastvisit_explain'] = 'Hier kannst Du die Anzeige der Tagesbesucher (Last Visit Mod) im Forenindex aktivieren / deaktivieren';
$lang['Lastvisit_24guest'] = 'Ganzer Tag + Gäste(!!mehr Last)';
$lang['Enable_Gentime'] = 'Aktiviere Page Generation Statistiken im Footer';
$lang['Gentime_Explain'] = 'Hier kannst Du die Page Generation Time Anzeige im Footer des Forums aktivieren / deaktivieren. Sie gibt PHP und SQL Statistiken wieder';
$lang['Enable_Bannerhack'] = 'Aktiviere den Banner MOD';
$lang['Bannerhack_explain'] = 'Hier kannst Du die Anzeige den Banner MOD aktivieren / deaktivieren';
$lang['Confirm_code_guestpost'] = 'Aktiviere visuelle Bestätigung für Gastbeiträge';
$lang['Confirm_guestpost_Explain'] = 'Gäste müssen beim absenden des Beitrags einen durch ein Bild vorgegeben Schlüssel eingeben.';
$lang['Fulltext_Config'] = 'Aktiviere MySQL Volltextsuche';
$lang['Fulltext_Explain'] = 'Wenn du den Befehl (einmalig) in deiner Datenbank ausgeführt hast, kannst die MySQL eigene Volltextsuche benutzen.';
// End additional Language Stuff phpBB2 Plus specific 

//
// Bookmark Mod
//
$lang['Max_bookmarks_links'] = 'Maximale Lesezeichen im link-Tag';
$lang['Max_bookmarks_links_explain'] = 'Maximale Zahl von Lesezeichen, die zu Beginn des Dokumentes im link-Tag gesendet werden. Dies wird z.B. von Mozilla ausgewertet. Bei Eingabe von 0 werden keine Tags gesendet.';

// Admin Account Actions Mod
$lang['Deleted_user'] = "User mit der ID No. #%d gelöscht"; //%d = user id
$lang['Activate_title'] = 'Account Aktionen';
$lang['Reg_date'] = 'Registrierungsdatum';
$lang['Activate'] = 'Aktivieren';
$lang['Actions'] = 'Aktionen';
$lang['Waiting_1'] = '(erwartet Aktivierung seit %d Tag)'; // %d = day
$lang['Waiting_2'] = '(erwartet Aktivierung seit %d Tagen)'; // %d = days
$lang['No_users'] = 'Kein User erwartet eine Aktivierung.';
$lang['Total_member'] = '<b>%d</b> User erwartet eine Aktivierung.';
$lang['Total_members'] = '<b>%d</b> User erwarten eine Aktivierung.';

// Start add - Fully integrated shoutbox MOD
$lang['Prune_shouts'] = 'Shouts automatisch löschen'; 
$lang['Prune_shouts_explain'] = 'Anzahl Tage bis Shouts gelöscht werden. 0 (Null) eingeben, um diese Funktion zu deaktivieren.';
// End add - Fully integrated shoutbox MOD

//
// mod : ezportal Admin
//
$lang['EZPortal_Config'] = 'EZPortal Konfiguration';
$lang['EZPortal_Portal_settings'] = 'EZPortal Einstellungen';
$lang['Welcome_Text'] = 'Willkommensnachricht';
$lang['Number_of_News'] = 'Anzahl News';
$lang['News_length'] = 'News Länge';
$lang['News_Forum'] = 'News Foren';
$lang['Poll_Forum'] = 'Umfrage Foren';
$lang['Number_Recent_Topics'] = 'Anzahl der letzten Themen';
$lang['Number_Recent_Files'] = 'Anzahl der letzten Dateien';
$lang['Last_Seen'] = 'Anzahl zuletzt gesehene Benutzer im Forum';
$lang['Comma'] = 'Wenn Du Umfragen im Portal darstellen möchtest, dann trage hier die Forum ID(s) ein, aus denen Umfragen dargestellt werden sollen. Trenne die Forum ID(s) durch ein Komma. Trägst Du hier nichts oder 0 ein, wird der Umfragen-Block im Portal ausgeblendet';
$lang['Exceptional_Forum'] = 'Auszunehmende(s) Forum(s) für Letzte Themen Block, z.B. 2,4,10';
$lang['Exceptional_Comma'] = 'Trage hier die Foren-ID(s) ein, aus denen im Letzte Themen Block <b>keine</b> Beiträge angezeigt werden sollen.';
$lang['Picture_cat_id'] = 'Kategorien, aus denen Du Neueste Bilder anzeigen möchtest. Stelle hier 0 ein, wenn Du aus allen Kategorien darstellen lassen möchtest';
$lang['Picture_number'] = 'Anzahl Bilder, die im Portal dargestellt werden sollen';
$lang['Picture_all'] = 'Möchtest Du auch persönliche Kategorien darstellen lassen, wenn nein werden nur Allgemeine Bilder angezeigt.';
$lang['Picture_sort'] = 'Sollen zufällige Bilder dargestellt werden, wenn nein werden nur die neuesten Bilder angezeigt.'; 
$lang['Recent_Pic_Settings'] = 'Einstellungen für den Neueste Bilder Block im Portal';
$lang['Pic_Comma'] = 'Trenne die Kategorien durch ein Komma';
//
//  END ezportal Admin
//
// Start add - Yellow card admin MOD
$lang['Ban'] = 'Sperren';
$lang['Max_user_bancard'] = 'Maximale Anzahl der Warnungen';
$lang['Max_user_bancard_explain'] = 'Wenn ein Benutzer mehr gelbe Karten bekommt, als hier angegeben sind, wird er gesperrt.';
$lang['ban_card'] = 'Gelbe Karte'; 
$lang['ban_card_explain'] = 'Der Benutzer wird gesperrt, wenn er mehr als %d gelbe Karten hat.';
$lang['Greencard'] = 'Reaktivieren'; 
$lang['Bluecard'] = 'Beitrags-Meldungen'; 
$lang['Bluecard_limit'] = 'Intervall der Beitrags-Meldungen';
$lang['Bluecard_limit_explain'] = 'Die Moderatoren werden alle x Beitrags-Meldungen erneut benachrichtigt.';
$lang['Bluecard_limit_2'] = 'Erst-Benachrichtigung';
$lang['Bluecard_limit_2_explain'] = 'Die Moderatoren erhalten die erste Benachrichtigung über einen Beitrag, wenn x Benachrichtigungen eingegangen sind.';
$lang['RY_block_time'] = 'Sperrzeit für rote/gelbe Karten';
$lang['Report_forum']= 'Benachrichtigungs-Forum'; 
$lang['Report_forum_explain'] = 'In diesem Forum können die Beitrags-Benachrichtigungen gelistet werden. Gib hier die ID des Forums an bzw 0 um diese Funktion abzuschalten.';

// Start add - Protect user account MOD
$lang['user_password_settings'] = 'Benutzer Passwort Einstellungen'; 
$lang['Max_login_error'] = 'Anzahl Versuche, bevor ein Benutzer geblockt wird'; 
$lang['Max_login_error_explain'] = 'Wenn ein Benutzer mehrfach ein falsches Passwort verwendet, wird sein Account für eine Weile blockiert. Gib hier die Anzahl der falschen Eingaben an, bevor der Account des Benutzers blockiert wird'; 
$lang['Block_time'] = 'Dauer der Blockierung'; 
$lang['Block_time_explain'] = 'Anzahl Minuten, die der Account des Benutzers blockiert ist, if a wrong password is submitted repeately more than specifyed in "Block user on wrong login"'; 
$lang['Password_complex'] = 'Komplexes Passwort'; 
$lang['Password_complex_explain'] = 'Die Benutzer Passwörter müssen sowohl Buchstaben als auch Ziffern enthalten'; 
$lang['Password_len'] = 'Minimale Passwort Länge'; 
$lang['Password_len_explain'] = 'Gültige Länge ist [ 1 - 32 ]'; 
$lang['Password_not_login'] = 'Das Passwort muss sich vom Benutzernamen unterscheiden'; 
$lang['Password_not_login_explain'] = 'Das Passwort muss sich vom Benutzernamen unterscheiden'; 
$lang['Account_block'] = 'Account blockiert'; 
$lang['Account_block_explain'] = 'Hier kannst Du die Block-Einstellungen der Benutzer anzeigen/einstellen oder resetten'; 
$lang['Block_until'] ='Blockiert bis: %s';// %s is substituded with the date/time 
$lang['Block_by'] = 'IP geblockt: %s';// %s is substituded with the ip addr. 
$lang['Last_block_by'] = 'Zuletzt geblockte IP: %s';// %s is substituded with the ip addr. 
$lang['Unblock_user'] ='Blockierung des Accounts aufheben'; 
$lang['Block_user'] ='Blockiere Benutzeraccount für %s Min';// %s is substituded with the date/time 
$lang['Badlogin_count'] = 'Anzahl der falschen Logins'; 
$lang['Force_new_passwd'] = 'Benutzer zwingen, beim nächsten Login das Passwort zu ändern'; 
$lang['Force_new_passwd_detail'] = 'Klicke hier um diesen Benutzer beim nächsten Login dazu zu zwingen, sein Passwort zu ändern.';
$lang['Password_intervall'] = 'Anzahl Tage, zwischen denen der Benutzer aufgefordert wird, das Passwort zu ändern'; 
$lang['Password_intervall_explain'] = 'Gib hier die Anzahl der Tage ein, zwischen denen der Bnutzer aufgefordert wird, sein Passwort zu ändern. Trage hier <b>0</b> ein um diese Funktion zu deaktivieren !';
$lang['Password_expire'] = 'Das Passwort dieses Benutzers wird ablaufen am: %s';
// End add - Protect user account MOD

// Start add - Prune users MOD
$lang['Prune_users'] = 'Benutzer löschen'; 
// End add - Prune users MOD

// Start add - Admin add user MOD
$lang['Create_user'] = 'Neuen Benutzer erstellen';
$lang['Create_user_explain'] = 'Du bist dabei, einen neuen Beuntzer zu erstellen. Das Script wird bei den Daten für diesen Benutzer %s nachsehen; die Benutzer-ID dieses Benutzers ist in der Datei admin_users.php festgelegt, Du kannst diese Einstellung ganz oben in der Datei ändern, wenn eine andere Benutzer-ID benötigt wird.<br />Hiervon gibt es zwei Ausnahmen: <br />1. das Paßwort des Benutzers wird auf "%s" festgelegt, wenn Du es nicht auf der Benutzer-hinzufügen-Seite anders festgelegt hast<br />2. die E-Mail des Benutzers muß auf der Benutzer-hinzufügen-Seite ausgefüllt werden';
// End add - Admin add user MOD

$lang['Post_count'] = 'Beiträge in diesem Forum zählen ?';

$lang['Contact_Config'] = 'KontaKt EMail';
$lang['Contact_Explain'] = 'Gib die EMail Adresse an, an die die Beiträge gesendet werden sollen, die über das Kontakt-Formular abgesendet werden';

//
// Acronyms
//
$lang['Acronyms_title'] = 'Akronyme Administration';
$lang['Acronyms_explain'] = 'In diesem Einstellungsmenu kannst Du Akronyme hinzufügen, bearbeiten oder löschen.';
$lang['Acronym'] = 'Akronym';
$lang['Acronyms'] = 'Akronyme';
$lang['Edit_acronym'] = 'Akronym bearbeiten';
$lang['Description'] = 'Beschreibung';
$lang['Add_new_acronym'] = 'Neues Akronym hinzufügen';
$lang['Update_acronym'] = 'Akronym aktualisieren';

$lang['Must_enter_acronym'] = 'Du musst ein Akronym und dessen Beschreibung angeben';
$lang['No_acronym_selected'] = 'Es wurden keine Akronyme zur Bearbeitung ausgewählt';

$lang['Acronym_updated'] = 'Das ausgewählte Akronym wurde erfolgreich aktualisiert';
$lang['Acronym_added'] = 'Das Akronym wurde erfolgreich hinzugefügt';
$lang['Acronym_removed'] = 'Das ausgewählte Akronym wurde erfolgreich gelöscht';

$lang['Click_return_acronymadmin'] = 'Klicke %shier%s um zur Akronym Administration zurückzukehren'; 

// Disable Board Message Mod
$lang['Board_disable_msg'] = 'Board Deaktivierungsnachricht';
$lang['Board_disable_msg_explain'] = 'Dieser Text wird angezeigt, wenn "Board deaktivieren" eingeschaltet wurde.';

// Install Process
$lang['Welcome_install'] = 'Willkommen bei der phpBB2 Plus Installation';
$lang['Admin_intro'] = 'Danke, dass du dich für phpBB2 Plus entschieden hast. Auf diesem Bildschirm erhältst du einen Überblick über die Statistiken deines Forums. Wenn du auf diese Seite zurückkehren möchtest, klicke auf den <u>Admin Index</u>-Link im linken Bedienfeld. Um zu deinem Forum zurückzukehren, klicke auf das phpBB-Logo. Die anderen Links auf der linken Seiten erlauben es dir, alle wichtigen Bereiche deines Forums zu kontrollieren. In jedem Bereich wird beschrieben, wie er richtig genutzt wird.';
$lang['Inst_Step_0'] = 'Thank you for choosing phpBB2 Plus. In order to complete this install please fill out the details requested below. Please note that the database you install into should already exist. At the Moment <b>only MySQL Database</b> is supported in phpBB2 Plus.';
$lang['Inst_Step_0'] = 'Danke, dass du dich für phpBB2 Plus entschieden hast. Um die Installation abzuschließen, gib bitte die unten geforderten Daten ein. Beachte, dass die Datenbank, in welche du installierst, bereits vorhanden seien sollte. Zur Zeit wird <b>nur die MySQL Datenbank</b> in phpBB2 Plus unterstützt.';

$lang['Absence_user_allowed'] = 'Benutzern erlauben, Abwesenheit einzustellen.<br />Bei NEIN können nur Moderatoren und Administratoren dieses benutzen.';
$lang['Mod_able_sent_absent'] = 'Moderatoren erlauben, Nachrichten an abwesende User zu senden';
$lang['Absent_button_on_username'] = 'Plaziert das Abwesenheits-Icon beim Usernamen<br />Bei NEIN wird das Icon an die Stelle des Email Buttons gesetzt.';

$lang['Portal_thumb_size'] = 'Grösse des Portal Gifs beim neuesten Bilder-Block im Portal (pixel)';

// ShortURLs
$lang['Enable_Shorturls'] = 'Aktiviere Statische URLs';
$lang['Shorturls_explain'] = 'Hiermit werden für das Forum statische Links (.html) aktiviert. Um diese Funktion nutzen zu können <b>MUSS Apache als Webserver laufen und das Modul mod_rewrite geladen sein !</b>. Hierzu muss auch die Datei htaccess.shorturl angepasst werden und anschliessend in .htaccess umbenannt werden! Die originale .htaccess Datei muss bei Aktivierung dieser Funktion gelöscht werden';
$lang['Disable_Sid'] = 'Deaktiviere Session-IDs für unregistrierte Benutzer';
$lang['Disable_Sid_Explain'] = 'Wir hier Ja eingestellt, werden die Session-IDs in den URLs für unregistrierte Benutzer ausgeblendet. Da Google das Forum auch als unregistrierter Benutzer besucht sind somit die Session-IDs nicht vorhanden und die Links sind Suchmaschinenfreundlicher';

// Antirobot Switching
$lang['Enable_Antirobot'] = 'Aktiviere Robot Überprüfung';
$lang['Antirobot_Explain'] = 'Wird hier Ja eingestellt, wird ein Überprüfungscode bei der Registrierung eingeblendet, den der User eingeben muss. Das verhindert Registrierungen durch Robots';

//Admin Users List Addon
$lang['Admin_Users_List'] = 'Admin User Liste';
$lang['There_are'] = 'Dein Board hat';
$lang['Boardmembers'] = 'Mitglieder';
$lang['ID'] = 'ID';
$lang['Last_Visit'] = 'Letzter Besuch';
$lang['Active'] = 'Aktiv';
$lang['Permission'] = 'Befugnisse';

// BEGIN Disable Registration MOD
$lang['registration_status'] = 'Deaktiviere Registrierungen';
$lang['registration_status_explain'] = 'Diese Option deaktiviert die Registrierung in Deinem Forum.';
$lang['registration_closed'] = 'Grund für die Deaktivierung der Registrierung';
$lang['registration_closed_explain'] = 'Text, mit einer Erklärung, warum die Registrierung deaktiviert ist. Der Text wird angezeigt, wenn ein Benutzer versucht sich zu registrieren. Lasse das Feld leer um den Standard Text anzuzeigen.';
// END Disable Registration MOD

$lang['Plus'] = 'Plus';
$lang['Portal'] = 'Portal';
$lang['Banner'] = 'Banner';
$lang['Org. Configuration'] = 'Orig. Konfiguration';
$lang['News Admin'] = 'News Admin';
$lang['Download'] = 'Download';
$lang['Email_List'] = 'EMail Liste';
$lang['Users List'] = 'Benutzerliste';

//
// Version Check
//
$lang['Version_up_to_date'] = 'Deine Installation ist auf aktuellem Stand, für Deine phpBB-Version sind keine Updates verfügbar.';
$lang['Version_not_up_to_date'] = 'Deine Installation ist <b>nicht</b> auf aktuellem Stand. Updates für Deine phpBB-Version sind erhältlich auf <a href="http://www.phpbb.com/downloads.php" target="_new">http://www.phpbb.com/downloads.php</a>.';
$lang['Latest_version_info'] = 'Die letzte erhältliche Version ist <b>phpBB %s</b>.';
$lang['Current_version_info'] = 'Du verwendest <b>phpBB %s</b>.';
$lang['Connect_socket_error'] = 'Konnte keine Verbindung zum phpBB Server herstellen, gemeldeter Fehler ist:<br />%s';
$lang['Socket_functions_disabled'] = 'Konnte keinen Socket öffnen.';
$lang['Mailing_list_subscribe_reminder'] = 'Um die neuesten Informationen zu phpBB zu erhalten, kannst Du Dich gerne bei unserer <a href="http://www.phpbb.com/support/" target="_new">Mailingliste anmelden</a>.';
$lang['Version_information'] = 'Versions-Information';

//Added for Topposters Configuration in Portal
$lang['Number_Topposters'] = 'Anzahl Topposter Anzeige';
$lang['Topposters_Explain'] = 'Hier kannst Du einstellen, wieviele Topposter im Portal in der Box angezeigt werden sollen. Wenn Du 0 einträgst wird der Block nicht mehr angezeigt';

//Added for Folder Permission Check in Admin Panel
$lang['Permission_Check'] = '<u>Überprüfe Verzeichnisrechte:</u><br /><br />Die Verzeichnisrechte folgender Dateien/Ordner sind nicht korrekt eingestellt:';
$lang['File_not_writable_666'] = '<font color="red"><b>ist nicht beschreibbar !</b> [CHMOD 666 setzen]</font>';
$lang['File_not_writable_777'] = '<font color="red"><b>ist nicht beschreibbar !</b> [CHMOD 777 setzen]</font>';
// That's all Folks!
// Na Gott sei Dank!
// -------------------------------------------------

?>
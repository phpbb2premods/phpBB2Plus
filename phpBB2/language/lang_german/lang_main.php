<?php

/***************************************************************************
 *                            lang_main.php [German]
 *                              -------------------
 *     begin                : Sun May 19 2002
 *     copyright            : (C) 2001 The phpBB Group
 *     email                : support@phpbb.com
 *
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
// The format of this file is ---> $lang['message'] = 'text';
//
// You should also try to set a locale and a character encoding (plus direction). The encoding and direction
// will be sent to the template. The locale may or may not work, it's dependent on OS support and the syntax
// varies ... give it your best guess!
//

$lang['ENCODING'] = 'iso-8859-1';
$lang['DIRECTION'] = 'ltr';
$lang['LEFT'] = 'left';
$lang['RIGHT'] = 'right';
$lang['DATE_FORMAT'] = 'd.m.Y'; // This should be changed to the default date format for your language, php date() format

// This is optional, if you would like a _SHORT_ message output
// along with our copyright message indicating you are the translator
// please add it here.
// $lang['TRANSLATION'] = '';

//
// Common, these terms are used
// extensively on several pages
//
$lang['Forum'] = 'Forum';
$lang['Category'] = 'Kategorie';
$lang['Topic'] = 'Thema';
$lang['Topics'] = 'Themen';
$lang['Replies'] = 'Antworten';
$lang['Views'] = 'Aufrufe';
$lang['Post'] = 'Beitrag';
$lang['Posts'] = 'Beiträge';
$lang['Posted'] = 'Verfasst';
$lang['Username'] = 'Benutzername';
$lang['Password'] = 'Passwort';
$lang['Email'] = 'E-Mail';
$lang['Poster'] = 'Poster';
$lang['Author'] = 'Autor';
$lang['Time'] = 'Zeit';
$lang['Hours'] = 'Stunden';
$lang['Message'] = 'Nachricht';

$lang['1_Day'] = '1 Tag';
$lang['7_Days'] = '7 Tage';
$lang['2_Weeks'] = '2 Wochen';
$lang['1_Month'] = '1 Monat';
$lang['3_Months'] = '3 Monate';
$lang['6_Months'] = '6 Monate';
$lang['1_Year'] = '1 Jahr';

$lang['Go'] = 'Los';
$lang['Jump_to'] = 'Gehe zu';
$lang['Submit'] = 'Absenden';
$lang['Reset'] = 'Zurücksetzen';
$lang['Cancel'] = 'Abbrechen';
$lang['Preview'] = 'Vorschau';
$lang['Confirm'] = 'Bestätigen';
$lang['Spellcheck'] = 'Rechtschreibprüfung';
$lang['Yes'] = 'Ja';
$lang['No'] = 'Nein';
$lang['Enabled'] = 'Aktiviert';
$lang['Disabled'] = 'Deaktiviert';
$lang['Error'] = 'Fehler';

$lang['Next'] = 'Weiter';
$lang['Previous'] = 'Zurück';
$lang['Goto_page'] = 'Gehe zu Seite';
$lang['Joined'] = 'Anmeldungsdatum';
$lang['IP_Address'] = 'IP-Adresse';

$lang['Select_forum'] = 'Forum auswählen';
$lang['View_latest_post'] = 'Letzten Beitrag anzeigen';
$lang['View_newest_post'] = 'Neuesten Beitrag anzeigen';
$lang['Page_of'] = 'Seite <b>%d</b> von <b>%d</b>'; // Replaces with: Page 1 of 2 for example

$lang['ICQ'] = 'ICQ-Nummer';
$lang['AIM'] = 'AIM-Name';
$lang['MSNM'] = 'MSN Messenger';
$lang['YIM'] = 'Yahoo Messenger';

$lang['Forum_Index'] = '%s Foren-Übersicht'; // eg. sitename Forum Index, %s can be removed if you prefer

$lang['Post_new_topic'] = 'Neues Thema eröffnen';
$lang['Reply_to_topic'] = 'Neue Antwort erstellen';
$lang['Reply_with_quote'] = 'Antworten mit Zitat';

$lang['Click_return_topic'] = '%sHier klicken%s, um zum Thema zurückzukehren'; // %s's here are for uris, do not remove!
$lang['Click_return_login'] = '%sHier klicken%s, um es noch einmal zu versuchen';
$lang['Click_return_forum'] = '%sHier klicken%s, um zum Forum zurückzukehren';
$lang['Click_view_message'] = '%sHier klicken%s, um deine Nachricht anzuzeigen';
$lang['Click_return_modcp'] = '%sHier klicken%s, um zur Moderatorenkontrolle zurückzukehren';
$lang['Click_return_group'] = '%sHier klicken%s, um zur Gruppeninfo zurückzukehren';

$lang['Admin_panel'] = 'Administrations-Bereich';

$lang['Board_disable'] = 'Sorry, aber dieses Board ist im Moment nicht verfügbar. Probier es bitte später wieder.';


//
// Global Header strings
//
$lang['Registered_users'] = 'Registrierte Benutzer:';
$lang['Browsing_forum'] = 'Benutzer in diesem Forum:';
$lang['Online_users_zero_total'] = 'Insgesamt sind <b>0</b> Benutzer online: ';
$lang['Online_users_total'] = 'Insgesamt sind <b>%d</b> Benutzer online: ';
$lang['Online_user_total'] = 'Insgesamt ist <b>ein</b> Benutzer online: ';
$lang['Reg_users_zero_total'] = 'Kein registrierter, ';
$lang['Reg_users_total'] = '%d registrierte, ';
$lang['Reg_user_total'] = 'Ein registrierter, ';
$lang['Hidden_users_zero_total'] = 'kein versteckter und ';
$lang['Hidden_users_total'] = '%d versteckte und ';
$lang['Hidden_user_total'] = 'ein versteckter und ';
$lang['Guest_users_zero_total'] = 'kein Gast';
$lang['Guest_users_total'] = '%d Gäste';
$lang['Guest_user_total'] = 'ein Gast';
$lang['Record_online_users'] = 'Der Rekord liegt bei <b>%s</b> Benutzern am %s.'; // first %s = number of users, second %s is the date.

$lang['Admin_online_color'] = '%sAdministrator%s';
$lang['Mod_online_color'] = '%sModerator%s';

$lang['You_last_visit'] = 'Dein letzter Besuch war am: %s'; // %s replaced by date/time
$lang['Current_time'] = 'Aktuelles Datum und Uhrzeit: %s'; // %s replaced by time

$lang['Search_new'] = 'Beiträge seit dem letzten Besuch anzeigen';
$lang['Search_new_p'] = 'Beiträge seit dem letzten Besuch <br />anzeigen';
$lang['Search_your_posts'] = 'Eigene Beiträge anzeigen';
$lang['Search_unanswered'] = 'Unbeantwortete Beiträge anzeigen';

$lang['Register'] = 'Registrieren';
$lang['Profile'] = 'Profil';
$lang['Edit_profile'] = 'Profil bearbeiten';
$lang['Search'] = 'Suchen';
$lang['Memberlist'] = 'Mitgliederliste';
$lang['FAQ'] = 'FAQ';
$lang['BBCode_guide'] = 'BBCode-Hilfe';
$lang['Usergroups'] = 'Benutzergruppen';
$lang['Last_Post'] = 'Letzter&nbsp;Beitrag';
$lang['Moderator'] = '<b>Moderator</b>';
$lang['Moderators'] = '<b>Moderatoren</b>';


//
// Stats block text
//
$lang['Posted_articles_zero_total'] = 'Unsere Benutzer haben <b>noch keine</b> Beiträge geschrieben.'; // Number of posts
$lang['Posted_articles_total'] = 'Unsere Benutzer haben insgesamt <b>%d</b> Beiträge geschrieben.'; // Number of posts
$lang['Posted_article_total'] = 'Unsere Benutzer haben <b>einen</b> Beitrag geschrieben.'; // Number of posts
$lang['Registered_users_zero_total'] = 'Wir haben <b>keine</b> registrierten Benutzer.'; // # registered users
$lang['Registered_users_total'] = 'Wir haben <b>%d</b> registrierte Benutzer.'; // # registered users
$lang['Registered_user_total'] = 'Wir haben <b>einen</b> registrierten Benutzer.'; // # registered users
$lang['Newest_user'] = 'Der neueste Benutzer ist <b>%s%s%s</b>.'; // a href, username, /a

$lang['No_new_posts_last_visit'] = 'Keine neuen Beiträge seit deinem letzten Besuch';
$lang['No_new_posts'] = 'Keine neuen Beiträge';
$lang['New_posts'] = 'Neue Beiträge';
$lang['New_post'] = 'Neuer Beitrag';
$lang['No_new_posts_hot'] = 'Keine neuen Beiträge [ Top-Thema ]';
$lang['New_posts_hot'] = 'Neue Beiträge [ Top-Thema ]';
$lang['No_new_posts_locked'] = 'Keine neuen Beiträge [ Gesperrt ]';
$lang['New_posts_locked'] = 'Neue Beiträge [ Gesperrt ]';
$lang['Forum_is_locked'] = 'Forum ist gesperrt';


//
// Login
//
$lang['Enter_password'] = 'Gib bitte deinen Benutzernamen und dein Passwort ein, um dich einzuloggen!';
$lang['Login'] = 'Login';
$lang['Logout'] = 'Logout';

$lang['Forgotten_password'] = 'Ich habe mein Passwort vergessen!';

$lang['Log_me_in'] = 'Bei jedem Besuch automatisch einloggen';

$lang['Error_login'] = 'Du hast einen falschen oder inaktiven Benutzernamen oder ein falsches Passwort eingegeben.';


//
// Index page
//
$lang['Index'] = 'Index';
$lang['No_Posts'] = 'Keine Beiträge';
$lang['No_forums'] = 'Dieses Board hat keine Foren.';

$lang['Private_Message'] = 'Private Nachricht';
$lang['Private_Messages'] = 'Private Nachrichten';
$lang['Who_is_Online'] = 'Wer ist online?';

$lang['Mark_all_forums'] = 'Alle Foren als gelesen markieren';
$lang['Forums_marked_read'] = 'Alle Foren wurden als gelesen markiert.';


//
// Viewforum
//
$lang['View_forum'] = 'Forum anzeigen';

$lang['Forum_not_exist'] = 'Das ausgewählte Forum existiert nicht.';
$lang['Reached_on_error'] = 'Fehler auf dieser Seite!';

$lang['Display_topics'] = 'Siehe Beiträge der letzten';
$lang['All_Topics'] = 'Alle Themen anzeigen';

$lang['Topic_Announcement'] = '<b>Ankündigungen:</b>';
$lang['Topic_Sticky'] = '<b>Wichtig:</b>';
$lang['Topic_Moved'] = '<b>Verschoben:</b>';
$lang['Topic_Poll'] = '<b>[Umfrage]</b>';

$lang['Mark_all_topics'] = 'Alle Themen als gelesen markieren';
$lang['Topics_marked_read'] = 'Alle Themen wurden als gelesen markiert.';

$lang['Rules_post_can'] = 'Du <b>kannst</b> Beiträge in dieses Forum schreiben.';
$lang['Rules_post_cannot'] = 'Du <b>kannst keine</b> Beiträge in dieses Forum schreiben.';
$lang['Rules_reply_can'] = 'Du <b>kannst</b> auf Beiträge in diesem Forum antworten.';
$lang['Rules_reply_cannot'] = 'Du <b>kannst</b> auf Beiträge in diesem Forum <b>nicht</b> antworten.';
$lang['Rules_edit_can'] = 'Du <b>kannst</b> deine Beiträge in diesem Forum bearbeiten.';
$lang['Rules_edit_cannot'] = 'Du <b>kannst</b> deine Beiträge in diesem Forum <b>nicht</b> bearbeiten.';
$lang['Rules_delete_can'] = 'Du <b>kannst</b> deine Beiträge in diesem Forum löschen.';
$lang['Rules_delete_cannot'] = 'Du <b>kannst</b> deine Beiträge in diesem Forum <b>nicht</b> löschen.';
$lang['Rules_vote_can'] = 'Du <b>kannst</b> an Umfragen in diesem Forum mitmachen.';
$lang['Rules_vote_cannot'] = 'Du <b>kannst</b> an Umfragen in diesem Forum <b>nicht</b> mitmachen.';
$lang['Rules_moderate'] = 'Du <b>kannst</b> %sdieses Forum moderieren%s.'; // %s replaced by a href links, do not remove!

$lang['No_topics_post_one'] = 'In diesem Forum sind keine Beiträge vorhanden.<br />Klicke auf <b>Neues Thema</b>, um den ersten Beitrag zu erstellen.';


//
// Viewtopic
//
$lang['View_topic'] = 'Thema anzeigen';

$lang['Guest'] = 'Gast';
$lang['Post_subject'] = 'Titel';
$lang['View_next_topic'] = 'Nächstes Thema anzeigen';
$lang['View_previous_topic'] = 'Vorheriges Thema anzeigen';
$lang['Submit_vote'] = 'Stimme absenden';
$lang['View_results'] = 'Ergebnis anzeigen';
$lang['View_ballot'] = 'Umfrage anzeigen';

$lang['No_newer_topics'] = 'Es gibt keine neueren Themen in diesem Forum.';
$lang['No_older_topics'] = 'Es gibt keine älteren Themen in diesem Forum.';
$lang['Topic_post_not_exist'] = 'Das gewählte Thema oder der Beitrag existiert nicht.';
$lang['No_posts_topic'] = 'Es existieren keine Beiträge zu diesem Thema.';

$lang['Display_posts'] = 'Beiträge der letzten Zeit anzeigen';
$lang['All_Posts'] = 'Alle Beiträge';
$lang['Newest_First'] = 'Die neusten zuerst';
$lang['Oldest_First'] = 'Die ältesten zuerst';

$lang['Back_to_top'] = 'Nach oben';

$lang['Read_profile'] = 'Benutzer-Profile anzeigen';
$lang['Send_email'] = 'E-Mail an diesen Benutzer senden';
$lang['Visit_website'] = 'Website dieses Benutzers besuchen';
$lang['ICQ_status'] = 'ICQ-Status';
$lang['Edit_delete_post'] = 'Beitrag bearbeiten oder löschen';
$lang['View_IP'] = 'IP-Adresse zeigen';
$lang['Delete_post'] = 'Beitrag löschen';

$lang['wrote'] = 'hat folgendes geschrieben'; // proceeds the username and is followed by the quoted text
$lang['Quote'] = 'Zitat'; // comes before bbcode quote output.
$lang['Code'] = 'Code'; // comes before bbcode code output.

$lang['Edited_time_total'] = 'Zuletzt bearbeitet von %s am %s, insgesamt einmal bearbeitet'; // Last edited by me on 12 Oct 2001, edited 1 time in total
$lang['Edited_times_total'] = 'Zuletzt bearbeitet von %s am %s, insgesamt %d-mal bearbeitet'; // Last edited by me on 12 Oct 2001, edited 2 times in total

$lang['Lock_topic'] = 'Thema sperren';
$lang['Unlock_topic'] = 'Thema entsperren';
$lang['Move_topic'] = 'Thema verschieben';
$lang['Delete_topic'] = 'Thema löschen';
$lang['Split_topic'] = 'Thema teilen';

$lang['Stop_watching_topic'] = 'Bei Antworten zu diesem Thema nicht mehr benachrichtigen';
$lang['Start_watching_topic'] = 'Bei Antworten zu diesem Thema benachrichtigen';
$lang['No_longer_watching'] = 'Das Thema wird nicht mehr von Dir beobachtet.';
$lang['You_are_watching'] = 'Du beobachtest nun das Thema.';

$lang['Total_votes'] = 'Stimmen insgesamt';

$lang['Full_edit'] = 'Zum vollen Editor wechseln';
$lang['Save_changes'] = 'Speichern';
$lang['No_subject'] = '(Kein Titel)';

//
// Posting/Replying (Not private messaging!)
//
$lang['Message_body'] = 'Nachrichtentext';
$lang['Topic_review'] = 'Thema-Überblick';

$lang['No_post_mode'] = 'Kein Eintrags-Modus ausgewählt'; // If posting.php is called without a mode (newtopic/reply/delete/etc, shouldn't be shown normaly)

$lang['Post_a_new_topic'] = 'Neues Thema schreiben';
$lang['Post_a_reply'] = 'Antwort schreiben';
$lang['Post_topic_as'] = 'Thema schreiben als';
$lang['Edit_Post'] = 'Beitrag editieren';
$lang['Options'] = 'Optionen';

$lang['Post_Announcement'] = 'Ankündigung';
$lang['Post_Sticky'] = 'Wichtig';
$lang['Post_Normal'] = 'Normal';

$lang['Confirm_delete'] = 'Sicher, dass dieser Beitrag gelöscht werden soll?';
$lang['Confirm_delete_poll'] = 'Sicher, dass diese Umfrage gelöscht werden soll?';

$lang['Flood_Error'] = 'Du kannst einen Beitrag nicht so schnell nach deinem letzten absenden, bitte warte einen Augenblick.';
$lang['Empty_subject'] = 'Bei einem neuen Thema musst du einen Titel angeben.';
$lang['Empty_message'] = 'Du musst zu deinem Beitrag einen Text eingeben.';
$lang['Forum_locked'] = 'Dieses Forum ist gesperrt, du kannst keine Beiträge editieren, schreiben oder beantworten.';
$lang['Topic_locked'] = 'Dieses Thema ist gesperrt, du kannst keine Beiträge editieren oder beantworten.';
$lang['No_post_id'] = 'Du musst einen Beitrag zum editieren auswählen.';
$lang['No_topic_id'] = 'Du musst ein Thema für deine Antwort auswählen.';
$lang['No_valid_mode'] = 'Du kannst nur Beiträge schreiben, bearbeiten, beantworten und zitieren. Versuch es noch einmal.';
$lang['No_such_post'] = 'Es existiert kein solcher Beitrag. Versuch es noch einmal.';
$lang['Edit_own_posts'] = 'Du kannst nur deine eigenen Beiträge bearbeiten.';
$lang['Delete_own_posts'] = 'Du kannst nur deine eigenen Beiträge löschen.';
$lang['Cannot_delete_replied'] = 'Du kannst keine Beiträge löschen, die schon beantwortet wurden.';
$lang['Cannot_delete_poll'] = 'Du kannst keine aktiven Umfrage löschen.';
$lang['Empty_poll_title'] = 'Du musst einen Titel für die Umfrage eingeben.';
$lang['To_few_poll_options'] = 'Du musst mindestens zwei Antworten für die Umfrage angeben.';
$lang['To_many_poll_options'] = 'Du hast zu viele Antworten für die Umfrage angegeben';
$lang['Post_has_no_poll'] = 'Dieser Beitrag hat keine Umfrage.';
$lang['Already_voted'] = 'Du hast an dieser Umfrage schon teilgenommen.';
$lang['No_vote_option'] = 'Du musst eine Auswahl treffen, um abzustimmen.';

$lang['Add_poll'] = 'Umfrage hinzufügen';
$lang['Add_poll_explain'] = 'Wenn du keine Umfrage zum Thema hinzufügen willst, lass die Felder leer.';
$lang['Poll_question'] = 'Frage';
$lang['Poll_option'] = 'Antwort';
$lang['Add_option'] = 'Antwort hinzufügen';
$lang['Update'] = 'Aktualisieren';
$lang['Delete'] = 'Löschen';
$lang['Poll_for'] = 'Dauer der Umfrage:';
$lang['Days'] = 'Tage'; // This is used for the Run poll for ... Days + in admin_forums for pruning
$lang['Poll_for_explain'] = '[ Gib 0 ein oder lass dieses Feld leer, um die Umfrage auf unbeschränkte Zeit durchzuführen ]';
$lang['Delete_poll'] = 'Umfrage löschen';

$lang['Disable_HTML_post'] = 'HTML in diesem Beitrag deaktivieren';
$lang['Disable_BBCode_post'] = 'BBCode in diesem Beitrag deaktivieren';
$lang['Disable_Smilies_post'] = 'Smilies in diesem Beitrag deaktivieren';

$lang['HTML_is_ON'] = 'HTML ist <u>an</u>';
$lang['HTML_is_OFF'] = 'HTML ist <u>aus</u>';
$lang['BBCode_is_ON'] = '%sBBCode%s ist <u>an</u>'; // %s are replaced with URI pointing to FAQ
$lang['BBCode_is_OFF'] = '%sBBCode%s ist <u>aus</u>';
$lang['Smilies_are_ON'] = 'Smilies sind <u>an</u>';
$lang['Smilies_are_OFF'] = 'Smilies sind <u>aus</u>';

$lang['Attach_signature'] = 'Signatur anhängen (Signatur kann im Profil geändert werden)';
$lang['Notify'] = 'Benachrichtigt mich, wenn eine Antwort geschrieben wurde';
$lang['Delete_post'] = 'Diesen Beitrag löschen';

$lang['Stored'] = 'Deine Nachricht wurde erfolgreich eingetragen.';
$lang['Deleted'] = 'Deine Nachricht wurde erfolgreich gelöscht.';
$lang['Poll_delete'] = 'Deine Umfrage wurde erfolgreich gelöscht.';
$lang['Vote_cast'] = 'Deine Stimme wurde gezählt.';

$lang['Topic_reply_notification'] = 'Benachrichtigen bei Antworten';

$lang['bbcode_b_help'] = 'Text in fett: [b]Text[/b] (alt+b)';
$lang['bbcode_i_help'] = 'Text in kursiv: [i]Text[/i] (alt+i)';
$lang['bbcode_u_help'] = 'Unterstrichener Text: [u]Text[/u] (alt+u)';
$lang['bbcode_q_help'] = 'Zitat: [quote]Text[/quote] (alt+q)';
$lang['bbcode_c_help'] = 'Code anzeigen: [code]Code[/code] (alt+c)';
$lang['bbcode_l_help'] = 'Liste: [list]Text[/list] (alt+l)';
$lang['bbcode_o_help'] = 'Geordnete Liste: [list=]Text[/list] (alt+o)';
$lang['bbcode_p_help'] = 'Bild einfügen: [img]http://URL_des_Bildes[/img] (alt+p)';
$lang['bbcode_w_help'] = 'URL einfügen: [url]http://URL[/url] oder [url=http://url]URL Text[/url] (alt+w)';
$lang['bbcode_a_help'] = 'Alle offenen BBCodes schließen';
$lang['bbcode_s_help'] = 'Schriftfarbe: [color=red]Text[/color] Tipp: Du kannst ebenfalls color=#FF0000 benutzen';
$lang['bbcode_f_help'] = 'Schriftgröße: [size=x-small]Kleiner Text[/size]';

$lang['Emoticons'] = 'Smilies';
$lang['More_emoticons'] = 'Weitere Smilies ansehen';

$lang['Font_color'] = 'Schriftfarbe';
$lang['color_default'] = 'Standard';
$lang['color_dark_red'] = 'Dunkelrot';
$lang['color_red'] = 'Rot';
$lang['color_orange'] = 'Orange';
$lang['color_brown'] = 'Braun';
$lang['color_yellow'] = 'Gelb';
$lang['color_green'] = 'Grün';
$lang['color_olive'] = 'Oliv';
$lang['color_cyan'] = 'Cyan';
$lang['color_blue'] = 'Blau';
$lang['color_dark_blue'] = 'Dunkelblau';
$lang['color_indigo'] = 'Indigo';
$lang['color_violet'] = 'Violett';
$lang['color_white'] = 'Weiß';
$lang['color_black'] = 'Schwarz';

$lang['Font_size'] = 'Schriftgröße';
$lang['font_tiny'] = 'Winzig';
$lang['font_small'] = 'Klein';
$lang['font_normal'] = 'Normal';
$lang['font_large'] = 'Groß';
$lang['font_huge'] = 'Riesig';

$lang['Close_Tags'] = 'Tags schließen';
$lang['Styles_tip'] = 'Tipp: Styles können schnell zum markierten Text hinzugefügt werden.';

$lang['AJAX_search_results'] = 'Eine Schnellsuche hat %s Themen mit den Wörtern aus diesem Thementitel gefunden. Klick hier um die Suchergebnisse anzuzeigen.';
$lang['AJAX_search_result'] = 'Eine Schnellsuche hat ein Thema mit den Wörtern aus diesem Thementitel gefunden. Klick hier um das Thema anzuzeigen.';

$lang['AJAX_features'] = 'AJAX Features';
$lang['AJAX_use_preview'] = 'Benutze AJAX Beitragsvorschau';
$lang['AJAX_use_edit'] = 'Benutze AJAX Schnelledit';

//
// Private Messaging
//
$lang['Private_Messaging'] = 'Private Nachrichten';

$lang['Login_check_pm'] = 'Einloggen, um private Nachrichten zu lesen';
$lang['New_pms'] = 'Du hast %d neue Nachrichten'; // You have 2 new messages
$lang['New_pm'] = 'Du hast 1 neue Nachricht'; // You have 1 new message
$lang['No_new_pm'] = 'Du hast keine neuen Nachrichten';
$lang['Unread_pms'] = 'Du hast %d ungelesene Nachrichten';
$lang['Unread_pm'] = 'Du hast 1 ungelesene Nachricht';
$lang['No_unread_pm'] = 'Du hast keine ungelesenen Nachrichten';
$lang['You_new_pm'] = 'Eine neue private Nachricht befindet sich in deinem Posteingang';
$lang['You_new_pms'] = 'Es befinden sich neue private Nachrichten in deinem Posteingang';
$lang['You_no_new_pm'] = 'Es sind keine neuen privaten Nachrichten vorhanden';

$lang['Unread_message'] = 'Ungelesene Nachricht';
$lang['Read_message'] = 'Gelesene Nachricht';

$lang['Read_pm'] = 'Nachricht lesen';
$lang['Post_new_pm'] = 'Nachricht schreiben';
$lang['Post_reply_pm'] = 'Auf Nachricht antworten';
$lang['Post_quote_pm'] = 'Nachricht zitieren';
$lang['Edit_pm'] = 'Nachricht bearbeiten';

$lang['Inbox'] = 'Posteingang';
$lang['Outbox'] = 'Postausgang';
$lang['Savebox'] = 'Archiv';
$lang['Sentbox'] = 'Gesendete Nachrichten';
$lang['Flag'] = 'Flag';
$lang['Subject'] = 'Titel';
$lang['From'] = 'Von';
$lang['To'] = 'An';
$lang['Date'] = 'Datum';
$lang['Mark'] = 'Markiert';
$lang['Sent'] = 'Gesendet';
$lang['Saved'] = 'Gespeichert';
$lang['Delete_marked'] = 'Markierte löschen';
$lang['Delete_all'] = 'Alle löschen';
$lang['Save_marked'] = 'Markierte speichern';
$lang['Save_message'] = 'Nachricht speichern';
$lang['Delete_message'] = 'Nachricht löschen';

$lang['Display_messages'] = 'Nachrichten anzeigen der letzten'; // Followed by number of days/weeks/months
$lang['All_Messages'] = 'Alle Nachrichten';

$lang['No_messages_folder'] = 'Es sind keine weiteren Nachrichten in diesem Ordner.';

$lang['PM_disabled'] = 'Private Nachrichten wurden in diesem Board deaktiviert.';
$lang['Cannot_send_privmsg'] = 'Der Administrator hat private Nachrichten für dich gesperrt.';
$lang['No_to_user'] = 'Du musst einen Benutzernamen angeben, um diese Nachricht zu senden.';
$lang['No_such_user'] = 'Es existiert kein Benutzer mit diesem Namen.';

$lang['Disable_HTML_pm'] = 'HTML in dieser Nachricht deaktivieren';
$lang['Disable_BBCode_pm'] = 'BBCode in dieser Nachricht deaktivieren';
$lang['Disable_Smilies_pm'] = 'Smilies in dieser Nachricht deaktivieren';

$lang['Message_sent'] = 'Deine Nachricht wurde gesendet.';

$lang['Click_return_inbox'] = 'Klick %shier%s um zum Posteingang zurückzukehren';
$lang['Click_return_index'] = 'Klick %shier%s um zum Index zurückzukehren';

$lang['Send_a_new_message'] = 'Neue Nachricht senden';
$lang['Send_a_reply'] = 'Auf private Nachricht antworten';
$lang['Edit_message'] = 'Private Nachricht bearbeiten';

$lang['Notification_subject'] = 'Eine neue private Nachricht ist eingetroffen!';

$lang['Find_username'] = 'Benutzernamen finden';
$lang['Find'] = 'Finden';
$lang['No_match'] = 'Keine Ergebnisse gefunden.';

$lang['No_post_id'] = 'Es wurde keine Beitrags-ID angegeben.';
$lang['No_such_folder'] = 'Es existiert kein solcher Ordner.';
$lang['No_folder'] = 'Kein Ordner ausgewählt';

$lang['Mark_all'] = 'Alle markieren';
$lang['Unmark_all'] = 'Markierungen aufheben';

$lang['Confirm_delete_pm'] = 'Diese Nachricht wirklich löschen?';
$lang['Confirm_delete_pms'] = 'Diese Nachrichten wirklich löschen?';

$lang['Inbox_size'] = 'Dein Posteingang ist zu %d%% voll'; // eg. Your Inbox is 50% full
$lang['Sentbox_size'] = 'Deine gesendeten Nachrichten sind zu %d%% voll';
$lang['Savebox_size'] = 'Dein Archiv ist zu %d%% voll';

$lang['Click_view_privmsg'] = 'Klick %shier%s, um deinen Posteingang aufzurufen';

$lang['More_matches_username'] = 'Es wurden mehrere Benutzer gefunden. Bitte wähle einen Benutzer aus der Box aus.';
$lang['No_username'] = 'Du musst einen Benutzernamen eingeben.';

//
// Profiles/Registration
//
$lang['Viewing_user_profile'] = 'Profil anzeigen : %s'; // %s is username
$lang['About_user'] = 'Alles über %s';

$lang['Preferences'] = 'Einstellungen';
$lang['Items_required'] = 'Mit * markierte Felder sind erforderlich';
$lang['Registration_info'] = 'Registrierungs-Informationen';
$lang['Profile_info'] = 'Profil-Informationen';
$lang['Profile_info_warn'] = 'Diese Informationen sind öffentlich abrufbar!';
$lang['Avatar_panel'] = 'Avatar-Steuerung';
$lang['Avatar_gallery'] = 'Avatar-Galerie';

$lang['Website'] = 'Website';
$lang['Location'] = 'Wohnort';
$lang['Contact'] = 'Kontakt';
$lang['Email_address'] = 'E-Mail-Adresse';
$lang['Email'] = 'E-Mail';
$lang['Send_private_message'] = 'Private Nachricht senden';
$lang['Hidden_email'] = '[ Versteckt ]';
$lang['Search_user_posts'] = 'Nachrichten von diesem Benutzer anzeigen';
$lang['Interests'] = 'Interessen';
$lang['Occupation'] = 'Beruf';
$lang['Poster_rank'] = 'Rang';

$lang['Total_posts'] = 'Beiträge insgesamt';
$lang['User_post_pct_stats'] = '%.2f%% aller Beiträge'; // 1.25% of total
$lang['User_post_day_stats'] = '%.2f Beiträge pro Tag'; // 1.5 posts per day
$lang['Search_user_posts'] = 'Alle Beiträge von %s anzeigen'; // Find all posts by username

$lang['No_user_id_specified'] = 'Dieser Benutzer existiert nicht.';
$lang['Wrong_Profile'] = 'Du kannst nur dein eigenes Profil bearbeiten.';

$lang['Only_one_avatar'] = 'Es kann nur ein Avatar ausgewählt werden';
$lang['File_no_data'] = 'Die angegebene Datei enthält keine Daten';
$lang['No_connection_URL'] = 'Es konnte keine Verbindung zur angegebenen Datei hergestellt werden';
$lang['Incomplete_URL'] = 'Die angegebene URL ist unvollständig';
$lang['Wrong_remote_avatar_format'] = 'Das Format des Avatars ist nicht gültig';
$lang['No_send_account_inactive'] = 'Sorry, aber ein neues Passwort kann im Moment nicht gesendet werden, da dein Account derzeit noch inaktiv ist. Bitte kontaktiere den Administrator für weitere Informationen.';

$lang['Always_smile'] = 'Smilies immer aktivieren';
$lang['Always_html'] = 'HTML immer aktivieren';
$lang['Always_bbcode'] = 'BBCode immer aktivieren';
$lang['Always_add_sig'] = 'Signatur immer anhängen';
$lang['Always_notify'] = 'Bei Antworten immer benachrichtigen';
$lang['Always_notify_explain'] = 'Sendet dir eine E-Mail, wenn jemand auf einen deiner Beiträge antwortet. Kann für jeden Beitrag geändert werden.';

$lang['Board_style'] = 'Board-Style';
$lang['Board_lang'] = 'Board-Sprache';
$lang['No_themes'] = 'Keine Themes in der Datenbank';
$lang['Timezone'] = 'Zeitzone';
$lang['Date_format'] = 'Datums-Format';
$lang['Date_format_explain'] = 'Die Syntax ist identisch mit der PHP-Funktion <a href=\'http://www.php.net/date\' target=\'_other\'>date()</a>';
$lang['Signature'] = 'Signatur';
$lang['Signature_explain'] = 'Dies ist ein Text, der an jeden Beitrag von dir angehängt werden kann. Es besteht ein Limit von %d Buchstaben.';
$lang['Public_view_email'] = 'Zeige meine E-Mail-Adresse immer an';

$lang['Current_password'] = 'Altes Passwort';
$lang['New_password'] = 'Neues Passwort';
$lang['Confirm_password'] = 'Passwort bestätigen';
$lang['Confirm_password_explain'] = 'Du musst dein Passwort angeben, wenn du dein Passwort oder deine Mailadresse ändern möchtest.';
$lang['password_if_changed'] = 'Du musst nur dann ein neues Passwort angeben, wenn du es ändern willst';
$lang['password_confirm_if_changed'] = 'Du musst dein neues Passwort bestätigen, wenn du es ändern willst';

$lang['Avatar'] = 'Avatar';
$lang['Avatar_explain'] = 'Zeigt eine kleine Grafik neben deinen Details zu jedem deiner Beiträge an. Es kann immer nur ein Avatar angezeigt werden, seine Breite darf nicht größer als %d Pixel sein, die Höhe nicht größer als %d Pixel, und die Dateigröße darf maximal %d KB betragen.';
$lang['Upload_Avatar_file'] = 'Avatar von deinem Computer hochladen';
$lang['Upload_Avatar_URL'] = 'Avatar von URL hochladen';
$lang['Upload_Avatar_URL_explain'] = 'Gib die URL des gewünschten Avatars an, dieser wird dann kopiert';
$lang['Pick_local_Avatar'] = 'Avatar aus der Galerie auswählen';
$lang['Link_remote_Avatar'] = 'Zu einem externen Avatar linken';
$lang['Link_remote_Avatar_explain'] = 'Gib die URL des Avatars ein, der gelinkt werden soll';
$lang['Avatar_URL'] = 'URL des Avatars';
$lang['Select_from_gallery'] = 'Avatar aus der Galerie auswählen';
$lang['View_avatar_gallery'] = 'Galerie anzeigen';

$lang['Select_avatar'] = 'Avatar auswählen';
$lang['Return_profile'] = 'Avatar abbrechen';
$lang['Select_category'] = 'Kategorie auswählen';

$lang['Delete_Image'] = 'Bild löschen';
$lang['Current_Image'] = 'Aktuelles Bild';

$lang['Notify_on_privmsg'] = 'Bei neuen Privaten Nachrichten benachrichtigen';
$lang['Popup_on_privmsg'] = 'PopUp-Fenster bei neuen Privaten Nachrichten';
$lang['Popup_on_privmsg_explain'] = 'Einige Templates öffnen neue Fenster, um dich über neue private Nachrichten zu benachrichtigen.';
$lang['Hide_user'] = 'Online-Status verstecken';

$lang['Profile_updated'] = 'Dein Profil wurde aktualisiert';
$lang['Profile_updated_inactive'] = 'Dein Profil wurde aktualisiert. Du hast jedoch wesentliche Details geändert, weswegen dein Account jetzt inaktiv ist. Du wurdest per Mail darüber informiert, wie du deinen Account reaktivieren kannst. Falls eine Aktivierung durch den Administrator erforderlich ist, warte bitte, bis die Reaktivierung stattgefunden hat.';

$lang['Password_mismatch'] = 'Du musst zweimal das gleiche Passwort eingeben.';
$lang['Current_password_mismatch'] = 'Das aktuelle Passwort stimmt nicht mit dem in der Datenbank überein.';
$lang['Password_long'] = 'Dein Passwort kann nicht länger als 32 Zeichen sein.';
$lang['Too_many_registers'] = 'Du hast zu oft versucht, dich zu registrieren. Bitte versuche es später erneut.';
$lang['Username_taken'] = 'Der gewünschte Benutzername ist leider bereits belegt.';
$lang['Username_invalid'] = 'Der gewünschte Benutzername enthält ein ungültiges Sonderzeichen (z.B. \').';
$lang['Username_disallowed'] = 'Der gewünschte Benutzername wurde vom Administrator gesperrt.';
$lang['Email_taken'] = 'Die angegebene Mailadresse wird bereits von einem anderen Benutzer verwendet.';
$lang['Email_banned'] = 'Die angegebene Mailadresse wurde vom Administrator gesperrt.';
$lang['Email_invalid'] = 'Die angegebene Mailadresse ist ungültig.';
$lang['Signature_too_long'] = 'Deine Signatur ist zu lang.';
$lang['Fields_empty'] = 'Du musst alle benötigten Felder ausfüllen.';
$lang['Avatar_filetype'] = 'Der Avatar muss im GIF-, JPG- oder PNG-Format sein.';
$lang['Avatar_filesize'] = 'Die Dateigröße muss kleiner als %d kB sein.'; // followed by xx kB, xx being the size
$lang['Avatar_imagesize'] = 'Der Avatar muss weniger als %d Pixel breit und %d Pixel hoch sein.';

$lang['Welcome_subject'] = 'Willkommen auf %s';
$lang['New_account_subject'] = 'Neuer Benutzeraccount';
$lang['Account_activated_subject'] = 'Account aktiviert';

$lang['Account_added'] = 'Danke für die Registrierung, dein Account wurde erstellt. Du kannst dich jetzt mit deinem Benutzernamen und deinem Passwort einloggen.';
$lang['Account_inactive'] = 'Dein Account wurde erstellt. Dieses Forum benötigt aber eine Aktivierung, daher wurde ein Activation-Key an deine E-Mail-Adresse gesendet. Bitte überprüfe deine Mailbox für weitere Informationen.';
$lang['Account_inactive_admin'] = 'Dein Account wurde erstellt. Dieser muss noch durch den Administrator freigeschaltet werden. Du wirst benachrichtigt, wenn dies geschehen ist.';
$lang['Account_active'] = 'Dein Account wurde aktiviert. Danke für die Registrierung.';
$lang['Account_active_admin'] = 'Dein Account wurde jetzt aktiviert.';
$lang['Reactivate'] = 'Account wieder aktivieren!';
$lang['Already_activated'] = 'Dein Account ist bereits aktiv';
$lang['COPPA'] = 'Dein Account wurde erstellt, muss aber zuerst überprüft werden. Mehr Details dazu wurden dir per E-Mail gesendet.';

$lang['Registration'] = 'Einverständniserklärung';
$lang['Reg_agreement'] = 'Die Administratoren und Moderatoren dieses Forums bemühen sich, Beiträge mit fragwürdigem Inhalt so schnell wie möglich zu bearbeiten oder ganz zu löschen, aber es ist nicht möglich, jede einzelne Nachricht zu überprüfen. Du bestätigst mit Absenden dieser Einverständniserklärung, dass du akzeptierst, dass jeder Beitrag in diesem Forum die Meinung des Urhebers wiedergibt und dass die Administratoren, Moderatoren und Betreiber dieses Forums nur für ihre eigenen Beiträge verantwortlich sind.<br /><br />Du verpflichtest dich, keine beleidigenden, obszönen, vulgären, verleumdenden, gewaltverherrlichenden oder aus anderen Gründen strafbaren Inhalte in diesem Forum zu veröffentlichen. Verstöße gegen diese Regel führen zu sofortiger und permanenter Sperrung, wir behalten uns vor, Verbindungsdaten u. ä. an die strafverfolgenden Behörden weiterzugeben. Du räumst den Betreibern, Administratoren und Moderatoren dieses Forums das Recht ein, Beiträge nach eigenem Ermessen zu entfernen, zu bearbeiten, zu verschieben oder zu sperren. Du stimmst zu, dass die im Rahmen der Registrierung erhobenen Daten in einer Datenbank gespeichert werden.<br /><br />Dieses System verwendet Cookies, um Informationen auf deinem Computer zu speichern. Diese Cookies enthalten keine der oben angegebenen Informationen, sondern dienen ausschließlich deinem Komfort. Deine Mail-Adresse wird nur zur Bestätigung der Registrierung und ggf. zum Versand eines neuen Passwortes verwendet.<br /><br />Durch das Abschließen der Registrierung stimmst du diesen Nutzungsbedingungen zu.';

$lang['Agree_under_13'] = 'Ich bin mit den Konditionen dieses Forums einverstanden und <b>unter</b> 12 Jahre alt.';
$lang['Agree_over_13'] = 'Ich bin mit den Konditionen dieses Forums einverstanden und <b>über</b> oder <b>exakt</b> 12 Jahre alt.';
$lang['Agree_not'] = 'Ich bin mit den Konditionen nicht einverstanden.';

$lang['Wrong_activation'] = 'Der Aktivierungsschlüssel aus dem Link stimmt nicht mit dem in der Datenbank überein. Bitte überprüfe die URL, und versuche es erneut.';
$lang['Send_password'] = 'Schickt mir ein neues Passwort.';
$lang['Password_updated'] = 'Ein neues Passwort wurde erstellt, es wurde eine E-Mail mit weiteren Anweisungen verschickt.';
$lang['No_email_match'] = 'Die angegebene E-Mail-Adresse stimmt nicht mit dem Benutzernamen überein.';
$lang['New_password_activation'] = 'Aktivierung des neuen Passwortes';
$lang['Password_activated'] = 'Dein Account wurde wieder aktiviert. Um dich einzuloggen, benutze das Passwort, welches du per E-Mail erhalten hast.';

$lang['Send_email_msg'] = 'E-Mail senden';
$lang['No_user_specified'] = 'Es wurde kein Benutzer ausgewählt';
$lang['User_prevent_email'] = 'Dieser Benutzer hat den E-Mail-Empfang deaktiviert. Bitte versuche es mit einer privaten Nachricht.';
$lang['User_not_exist'] = 'Dieser Benutzer existiert nicht.';
$lang['CC_email'] = 'Eine Kopie dieser E-Mail an dich senden';
$lang['Email_message_desc'] = 'Diese Nachricht wird als Text versendet, verwende bitte deshalb kein HTML oder BBCode. Als Antwort-Adresse der E-Mail wird deine Adresse angegeben.';
$lang['Flood_email_limit'] = 'Im Moment kannst du keine weiteren E-Mails versenden. Versuch es später noch einmal.';
$lang['Recipient'] = 'Empfänger';
$lang['Email_sent'] = 'E-Mail wurde gesendet';
$lang['Send_email'] = 'E-Mail senden';
$lang['Empty_subject_email'] = 'Du musst einen Titel für diese E-Mail angeben.';
$lang['Empty_message_email'] = 'Du musst einen Text zur E-Mail angeben.';


//
// Visual confirmation system strings
//
$lang['Confirm_code_wrong'] = 'Der eingegebene Bestätigungs-Code war nicht richtig';
$lang['Too_many_registers'] = 'Du hast die zulässige Zahl von Registrierungs-Versuchen für diese Sitzung überschritten. Bitte versuche es später erneut.';
$lang['Confirm_code_impaired'] = 'Wenn du optisch beeinträchtigt bist oder aus einem anderen Grund den Code nicht lesen kannst, kontaktiere bitte den %sAdministrator%s für Hilfe.';
$lang['Confirm_code'] = 'Bestätigungs-Code';
$lang['Confirm_code_explain'] = 'Gebe den Code exakt so ein, wie du ihn siehst. Der Code unterscheidet zwischen Groß- und Kleinschreibung, die Null hat im Inneren einen schrägen Strich.';



//
// Memberslist
//
$lang['Select_sort_method'] = 'Sortierungs-Methode auswählen';
$lang['Sort'] = 'Sortieren';
$lang['Sort_Top_Ten'] = 'Top-Ten-Autoren';
$lang['Sort_Joined'] = 'Anmeldungsdatum';
$lang['Sort_Username'] = 'Benutzername';
$lang['Sort_Location'] = 'Ort';
$lang['Sort_Posts'] = 'Beiträge total';
$lang['Sort_Email'] = 'E-Mail';
$lang['Sort_Website'] = 'Website';
$lang['Sort_Ascending'] = 'Aufsteigend';
$lang['Sort_Descending'] = 'Absteigend';
$lang['Order'] = 'Ordnung';


//
// Group control panel
//
$lang['Group_Control_Panel'] = 'Gruppen-Kontrolle';
$lang['Group_member_details'] = 'Details zur Gruppen-Mitgliedschaft';
$lang['Group_member_join'] = 'Gruppe beitreten';

$lang['Group_Information'] = 'Information';
$lang['Group_name'] = 'Name';
$lang['Group_description'] = 'Beschreibung';
$lang['Group_membership'] = 'Gruppen-Mitgliedschaft';
$lang['Group_Members'] = 'Gruppen-Mitglieder';
$lang['Group_Moderator'] = 'Gruppen-Moderatoren';
$lang['Pending_members'] = 'Wartende Mitglieder';

$lang['Group_type'] = 'Gruppentyp';
$lang['Group_open'] = 'Offene Gruppe';
$lang['Group_closed'] = 'Geschlossene Gruppe';
$lang['Group_hidden'] = 'Versteckte Gruppe';

$lang['Current_memberships'] = 'Aktuelle Mitgliedschaften';
$lang['Non_member_groups'] = 'Gruppen ohne deine Mitgliedschaft';
$lang['Memberships_pending'] = 'Warten auf Mitgliedschaft';

$lang['No_groups_exist'] = 'Es existieren keine Gruppen';
$lang['Group_not_exist'] = 'Diese Gruppe existiert nicht';

$lang['Join_group'] = 'Gruppe beitreten';
$lang['No_group_members'] = 'Diese Gruppe hat keine Mitglieder.';
$lang['Group_hidden_members'] = 'Diese Gruppe ist versteckt, du kannst keine Mitgliedschaften anzeigen.';
$lang['No_pending_group_members'] = 'Diese Gruppe hat keine wartenden Mitglieder.';
$lang['Group_joined'] = 'Du wurdest erfolgreich bei dieser Gruppe angemeldet.<br />Du wirst benachrichtigt, wenn der Gruppenmoderator deine Mitgliedschaft akzeptiert hat.';
$lang['Group_request'] = 'Eine Anfrage zum Beitritt in diese Gruppe wurde erstellt.';
$lang['Group_approved'] = 'Deine Anfrage wurde akzeptiert.';
$lang['Group_added'] = 'Du bist dieser Gruppe beigetreten.';
$lang['Already_member_group'] = 'Du bist bereits Mitglied dieser Gruppe.';
$lang['User_is_member_group'] = 'Dieser Benutzer ist bereits ein Mitglied dieser Gruppe.';
$lang['Group_type_updated'] = 'Gruppentyp wurde erfolgreich aktualisiert.';

$lang['Could_not_add_user'] = 'Die gewählte Gruppe existiert nicht.';
$lang['Could_not_anon_user'] = 'Ein anonymer Benutzer kann kein Gruppenmitglied werden.';

$lang['Confirm_unsub'] = 'Bist du sicher, dass du die Mitgliedschaft in dieser Gruppe beenden möchtest?';
$lang['Confirm_unsub_pending'] = 'Deine Anmeldung bei der Gruppe wurde noch nicht bestätigt, möchtest du wirklich austreten?';

$lang['Unsub_success'] = 'Du wurdest aus dieser Gruppe abgemeldet.';

$lang['Approve_selected'] = 'Akzeptierte ausgewählt';
$lang['Deny_selected'] = 'Gewählte löschen';
$lang['Not_logged_in'] = 'Du musst eingeloggt sein, um einer Gruppe beizutreten.';
$lang['Remove_selected'] = 'Ausgewählte entfernen';
$lang['Add_member'] = 'Mitglied hinzufügen';
$lang['Not_group_moderator'] = 'Du bist nicht der Gruppenmoderator, daher kannst du diese Aktion nicht durchführen.';

$lang['Login_to_join'] = 'Einloggen, um Gruppe zu managen';
$lang['This_open_group'] = 'Dies ist eine offene Gruppe. Klicke, um eine Mitgliedschaft zu beantragen.';
$lang['This_closed_group'] = 'Dies ist eine geschlossene Gruppe, keine weiteren Mitglieder werden akzeptiert.';
$lang['This_hidden_group'] = 'Dies ist eine versteckte Gruppe, automatische Anmeldungen werden nicht akzeptiert.';
$lang['Member_this_group'] = 'Du bist ein Mitglied dieser Gruppe.';
$lang['Pending_this_group'] = 'Du wartest auf eine Mitgliedschaft in dieser Gruppe.';
$lang['Are_group_moderator'] = 'Du bist der Moderator dieser Gruppe.';
$lang['None'] = 'Keine';

$lang['Subscribe'] = 'Anmelden';
$lang['Unsubscribe'] = 'Abmelden';
$lang['View_Information'] = 'Information anzeigen';


//
// Search
//
$lang['Search_query'] = 'Suchabfrage';
$lang['Search_options'] = 'Suchoptionen';

$lang['Search_keywords'] = 'Nach Begriffen suchen';
$lang['Search_keywords_explain'] = 'Du kannst <u>AND</u> benutzen, um Wörter zu definieren, die vorkommen müssen, <u>OR</u> kannst du benutzen für Wörter, die im Resultat sein können und <u>NOT</u> für Wörter, die im Ergebnis nicht vorkommen sollen. Das *-Zeichen kannst du als Platzhalter benutzen.';
$lang['Search_author'] = 'Nach Autor suchen';
$lang['Search_author_explain'] = 'Benutze das *-Zeichen als Platzhalter';

$lang['Search_for_any'] = 'Nach irgendeinem Wort suchen';
$lang['Search_for_all'] = 'Nach allen Wörtern suchen';
$lang['Search_title_msg'] = 'Titel und Text durchsuchen';
$lang['Search_msg_only'] = 'Nur Nachrichtentext durchsuchen';

$lang['Return_first'] = 'Die ersten'; // followed by xxx characters in a select box
$lang['characters_posts'] = 'Zeichen des Beitrags anzeigen';

$lang['Search_previous'] = 'Durchsuchen'; // followed by days, weeks, months, year, all in a select box

$lang['Sort_by'] = 'Sortieren nach';
$lang['Sort_Time'] = 'Zeit';
$lang['Sort_Post_Subject'] = 'Titel des Beitrags';
$lang['Sort_Topic_Title'] = 'Titel des Themas';
$lang['Sort_Author'] = 'Autor';
$lang['Sort_Forum'] = 'Forum';

$lang['Display_results'] = 'Ergebnis anzeigen als';
$lang['All_available'] = 'Alle';
$lang['No_searchable_forums'] = 'Du hast nicht die Berechtigung, dieses Forum zu durchsuchen.';

$lang['No_search_match'] = 'Keine Beiträge entsprechen deinen Kriterien.';
$lang['Found_search_match'] = 'Die Suche hat %d Ergebnis ergeben.'; // eg. Search found 1 match
$lang['Found_search_matches'] = 'Die Suche hat %d Ergebnisse ergeben.'; // eg. Search found 24 matches
$lang['Search_Flood_Error'] = 'Du kannst eine Sucheanfrage nicht so schnell nach deiner letzten absenden, bitte warte einen Augenblick.';

$lang['Close_window'] = 'Fenster schliessen';


//
// Auth related entries
//
// Note the %s will be replaced with one of the following 'user' arrays
$lang['Sorry_auth_announce'] = 'Ankündigungen können in diesem Forum nur von %s erstellt werden.';
$lang['Sorry_auth_sticky'] = 'Wichtige Nachrichten können in diesem Forum nur von %s erstellt werden.';
$lang['Sorry_auth_read'] = 'Nur %s haben die Berechtigung, in diesem Forum Beiträge zu lesen.';
$lang['Sorry_auth_post'] = 'Nur %s haben die Berechtigung, in diesem Forum Beiträge zu erstellen.';
$lang['Sorry_auth_reply'] = 'Nur %s haben die Berechtigung, in diesem Forum auf Beiträge zu antworten.';
$lang['Sorry_auth_edit'] = 'Nur %s haben die Berechtigung, in diesem Forum Beiträge zu bearbeiten.';
$lang['Sorry_auth_delete'] = 'nur %s haben die Berechtigung, in diesem Forum Beiträge zu löschen.';
$lang['Sorry_auth_vote'] = 'In diesem Forum können sich nur %s an Abstimmungen beteiligen.';

// These replace the %s in the above strings
$lang['Auth_Anonymous_Users'] = '<b>anonyme Benutzer</b>';
$lang['Auth_Registered_Users'] = '<b>registrierte Benutzer</b>';
$lang['Auth_Users_granted_access'] = '<b>Benutzer mit speziellen Rechten</b>';
$lang['Auth_Moderators'] = '<b>Moderatoren</b>';
$lang['Auth_Administrators'] = '<b>Administratoren</b>';

$lang['Not_Moderator'] = 'Du bist nicht Moderator dieses Forums.';
$lang['Not_Authorised'] = 'Nicht berechtigt';

$lang['You_been_banned'] = 'Du wurdest von diesem Forum verbannt.<br />Kontaktiere den Administrator, um mehr Informationen zu erhalten.';


//
// Viewonline
//
$lang['Reg_users_zero_online'] = 'Es sind kein registrierter und '; // There are 5 Registered and
$lang['Reg_users_online'] = 'Es sind %d registrierte und ';
$lang['Reg_user_online'] = 'Es ist ein registrierter und '; // There are 5 Registered and
$lang['Hidden_users_zero_online'] = 'kein versteckter Benutzer online.'; // 6 Hidden users online
$lang['Hidden_users_online'] = '%d versteckte Benutzer online.'; // 6 Hidden users online
$lang['Hidden_user_online'] = 'ein versteckter Benutzer online.'; // 6 Hidden users online
$lang['Guest_users_online'] = 'Es sind %d Gäste online.';
$lang['Guest_users_zero_online'] = 'Es sind keine Gäste online.'; // There are 10 Guest users online
$lang['Guest_user_online'] = 'Es ist ein Gast online.';
$lang['No_users_browsing'] = 'Im Moment sind keine Benutzer im Forum.';

$lang['Online_explain'] = 'Diese Daten zeigen an, wer in den letzten 5 Minuten online war.';

$lang['Forum_Location'] = 'Welche Seite';
$lang['Last_updated'] = 'Zuletzt aktualisiert';

$lang['Forum_index'] = 'Forum-Index';
$lang['Logging_on'] = 'Einloggen';
$lang['Posting_message'] = 'Nachricht schreiben';
$lang['Searching_forums'] = 'Foren durchsuchen';
$lang['Viewing_profile'] = 'Profil anzeigen';
$lang['Viewing_online'] = 'Anzeigen, wer online ist';
$lang['Viewing_member_list'] = 'Mitgliederliste anzeigen';
$lang['Viewing_priv_msgs'] = 'Private Nachrichten anzeigen';
$lang['Viewing_FAQ'] = 'FAQ anzeigen';


//
// Moderator Control Panel
//
$lang['Mod_CP'] = 'Moderator Control Panel';
$lang['Mod_CP_explain'] = 'Mit dem unteren Menü kannst du mehrere Moderatoren-Operationen gleichzeitig ausführen. Du kannst Beiträge öffnen, schließen, löschen oder verschieben.';

$lang['Select'] = 'Auswählen';
$lang['Delete'] = 'Löschen';
$lang['Move'] = 'Verschieben';
$lang['Lock'] = 'Sperren';
$lang['Unlock'] = 'Entsperren';

$lang['Topics_Removed'] = 'Die gewählten Themen wurden erfolgreich gelöscht.';
$lang['Topics_Locked'] = 'Die gewählten Themen wurden erfolgreich gesperrt.';
$lang['Topics_Moved'] = 'Die gewählten Themen wurden verschoben.';
$lang['Topics_Unlocked'] = 'Die gewählten Themen wurden entsperrt.';
$lang['No_Topics_Moved'] = 'Es wurden keine Themen verschoben.';

$lang['Confirm_delete_topic'] = 'Bist du sicher, dass die gewählten Themen entfernt werden sollen?';
$lang['Confirm_lock_topic'] = 'Bist du sicher, dass die gewählten Themen gesperrt werden sollen?';
$lang['Confirm_unlock_topic'] = 'Bist du sicher, dass die gewählten Themen entsperrt werden sollen?';
$lang['Confirm_move_topic'] = 'Bist du sicher, dass die gewählten Themen verschoben werden sollen?';

$lang['Move_to_forum'] = 'Verschieben nach';
$lang['Leave_shadow_topic'] = 'Shadow Topic im alten Forum lassen';

$lang['Split_Topic'] = 'Split Topic Control Panel';
$lang['Split_Topic_explain'] = 'Mit den Eingabefeldern unten kannst du ein Thema in zwei teilen, in dem du entweder die Beiträge manuell auswählst oder ab einem gewählten Beitrag teilst';
$lang['Split_title'] = 'Titel des neuen Themas';
$lang['Split_forum'] = 'Forum des neuen Themas';
$lang['Split_posts'] = 'Gewählte Beiträge teilen';
$lang['Split_after'] = 'Von gewähltem Beitrag teilen';
$lang['Topic_split'] = 'Das gewählte Thema wurde erfolgreich geteilt';

$lang['Too_many_error'] = 'Du hast zu viele Beiträge gewählt. Du kannst nur einen Beitrag auswählen, nach dem geteilt werden soll!';

$lang['None_selected'] = 'Du hast keine Themen ausgewählt, auf die diese Aktion ausgeführt werden soll. Bitte wähle mindestens eins aus.';
$lang['New_forum'] = 'Neues Forum';

$lang['This_posts_IP'] = 'IP-Adresse für diesen Beitrag';
$lang['Other_IP_this_user'] = 'Andere IP-Adressen, von denen dieser Benutzer geschrieben hat';
$lang['Users_this_IP'] = 'Beiträge von dieser IP-Adresse';
$lang['IP_info'] = 'IP-Information';
$lang['Lookup_IP'] = 'IP nachschlagen';


//
// Timezones ... for display on each page
//
$lang['All_times'] = 'Alle Zeiten sind %s'; // eg. All times are GMT - 12 Hours (times from next block)

$lang['-12'] = 'GMT - 12 Stunden';
$lang['-11'] = 'GMT - 11 Stunden';
$lang['-10'] = 'GMT - 10 Stunden';
$lang['-9'] = 'GMT - 9 Stunden';
$lang['-8'] = 'GMT - 8 Stunden';
$lang['-7'] = 'GMT - 7 Stunden';
$lang['-6'] = 'GMT - 6 Stunden';
$lang['-5'] = 'GMT - 5 Stunden';
$lang['-4'] = 'GMT - 4 Stunden';
$lang['-3.5'] = 'GMT - 3.5 Stunden';
$lang['-3'] = 'GMT - 3 Stunden';
$lang['-2'] = 'GMT - 2 Stunden';
$lang['-1'] = 'GMT - 1 Stunden';
$lang['0'] = 'GMT';
$lang['1'] = 'GMT + 1 Stunde';
$lang['2'] = 'GMT + 2 Stunden';
$lang['3'] = 'GMT + 3 Stunden';
$lang['3.5'] = 'GMT + 3.5 Stunden';
$lang['4'] = 'GMT + 4 Stunden';
$lang['4.5'] = 'GMT + 4.5 Stunden';
$lang['5'] = 'GMT + 5 Stunden';
$lang['5.5'] = 'GMT + 5.5 Stunden';
$lang['6'] = 'GMT + 6 Stunden';
$lang['6.5'] = 'GMT + 6.5 Stunden';
$lang['7'] = 'GMT + 7 Stunden';
$lang['8'] = 'GMT + 8 Stunden';
$lang['9'] = 'GMT + 9 Stunden';
$lang['9.5'] = 'GMT + 9.5 Stunden';
$lang['10'] = 'GMT + 10 Stunden';
$lang['11'] = 'GMT + 11 Stunden';
$lang['12'] = 'GMT + 12 Stunden';
$lang['13'] = 'GMT + 13 Stunden';

// These are displayed in the timezone select box
$lang['tz']['-12'] = '(GMT - 12 Stunden) Eniwetok, Kwajalein';
$lang['tz']['-11'] = '(GMT - 11 Stunden) Midway Island, Samoa';
$lang['tz']['-10'] = '(GMT - 10 Stunden) Hawaii';
$lang['tz']['-9'] = '(GMT - 9 Stunden) Alaska';
$lang['tz']['-8'] = '(GMT - 8 Stunden) Pacific Time (US & Canada)';
$lang['tz']['-7'] = '(GMT - 7 Stunden) Mountain Time (US & Canada)';
$lang['tz']['-6'] = '(GMT - 6 Stunden) Central Time (US & Canada), Mexico City';
$lang['tz']['-5'] = '(GMT - 5 Stunden) Eastern Time (US & Canada), Bogota, Lima, Quito';
$lang['tz']['-4'] = '(GMT - 4 Stunden) Atlantic Time (Canada), Caracas, La Paz';
$lang['tz']['-3.5'] = '(GMT - 3.5 Stunden) Newfoundland';
$lang['tz']['-3'] = '(GMT - 3 Stunden) Brazil, Buenos Aires, Georgetown';
$lang['tz']['-2'] = '(GMT - 2 Stunden) Mid-Atlantic';
$lang['tz']['-1'] = '(GMT - 1 Stunden) Azores, Cape Verde Islands';
$lang['tz']['0'] = '(GMT) Western Europe Time, London, Lisbon, Casablanca, Monrovia';
$lang['tz']['1'] = '(GMT + 1 Stunde) CET(Central Europe Time), Berlin, Brussels, Madrid, Paris';
$lang['tz']['2'] = '(GMT + 2 Stunden) EET(Eastern Europe Time), Kaliningrad, South Africa';
$lang['tz']['3'] = '(GMT + 3 Stunden) Baghdad, Kuwait, Riyadh, Moscow, St. Petersburg, Nairobi';
$lang['tz']['3.5'] = '(GMT + 3.5 Stunden) Tehran';
$lang['tz']['4'] = '(GMT + 4 Stunden) Abu Dhabi, Muscat, Baku, Tbilisi';
$lang['tz']['4.5'] = '(GMT + 4.5 Stunden) Kabul';
$lang['tz']['5'] = '(GMT + 5 Stunden) Ekaterinburg, Islamabad, Karachi, Tashkent';
$lang['tz']['5.5'] = '(GMT + 5.5 Stunden) Bombay, Calcutta, Madras, New Delhi';
$lang['tz']['6'] = '(GMT + 6 Stunden) Almaty, Dhaka, Colombo';
$lang['tz']['6.5'] = '(GMT + 6.5 Stunden)';
$lang['tz']['7'] = '(GMT + 7 Stunden) Bangkok, Hanoi, Jakarta';
$lang['tz']['8'] = '(GMT + 8 Stunden) Beijing, Perth, Singapore, Hong Kong, Urumqi, Taipei';
$lang['tz']['9'] = '(GMT + 9 Stunden) Tokyo, Seoul, Osaka, Sapporo, Yakutsk';
$lang['tz']['9.5'] = '(GMT + 9.5 Stunden) Adelaide, Darwin';
$lang['tz']['10'] = '(GMT + 10 Stunden) EAST(East Australian Standard), Guam, Papua New Guinea';
$lang['tz']['11'] = '(GMT + 11 Stunden) Magadan, Solomon Islands, New Caledonia';
$lang['tz']['12'] = '(GMT + 12 Stunden) Auckland, Wellington, Fiji, Kamchatka, Marshall Island';
$lang['tz']['13'] = '(GMT + 13 Stunden) Nuku\'alofa';

$lang['datetime']['Sunday'] = 'Sonntag';
$lang['datetime']['Monday'] = 'Montag';
$lang['datetime']['Tuesday'] = 'Dienstag';
$lang['datetime']['Wednesday'] = 'Mittwoch';
$lang['datetime']['Thursday'] = 'Donnerstag';
$lang['datetime']['Friday'] = 'Freitag';
$lang['datetime']['Saturday'] = 'Samstag';
$lang['datetime']['Sun'] = 'So';
$lang['datetime']['Mon'] = 'Mo';
$lang['datetime']['Tue'] = 'Di';
$lang['datetime']['Wed'] = 'Mi';
$lang['datetime']['Thu'] = 'Do';
$lang['datetime']['Fri'] = 'Fr';
$lang['datetime']['Sat'] = 'Sa';
$lang['datetime']['January'] = 'Januar';
$lang['datetime']['February'] = 'Februar';
$lang['datetime']['March'] = 'März';
$lang['datetime']['April'] = 'April';
$lang['datetime']['May'] = 'Mai';
$lang['datetime']['June'] = 'Juni';
$lang['datetime']['July'] = 'Juli';
$lang['datetime']['August'] = 'August';
$lang['datetime']['September'] = 'September';
$lang['datetime']['October'] = 'Oktober';
$lang['datetime']['November'] = 'November';
$lang['datetime']['December'] = 'Dezember';
$lang['datetime']['Jan'] = 'Jan';
$lang['datetime']['Feb'] = 'Feb';
$lang['datetime']['Mar'] = 'März';
$lang['datetime']['Apr'] = 'Apr';
$lang['datetime']['May'] = 'Mai';
$lang['datetime']['Jun'] = 'Jun';
$lang['datetime']['Jul'] = 'Jul';
$lang['datetime']['Aug'] = 'Aug';
$lang['datetime']['Sep'] = 'Sep';
$lang['datetime']['Oct'] = 'Okt';
$lang['datetime']['Nov'] = 'Nov';
$lang['datetime']['Dec'] = 'Dez';

//
// Errors (not related to a
// specific failure on a page)
//
$lang['Information'] = 'Information';
$lang['Critical_Information'] = 'Kritische Information';

$lang['General_Error'] = 'Allgemeiner Fehler';
$lang['Critical_Error'] = 'Kritischer Fehler';
$lang['An_error_occured'] = 'Ein Fehler ist aufgetreten.';
$lang['A_critical_error'] = 'Ein kritischer Fehler ist aufgetreten.';

// Additional Stuff for phpBB2 Plus only ! Translators should get original Language Files for phpBB 2.0.8
// for the language they want to translate from http://www.phpbb.com/downloads.php. Then they need to translate 
// the following stuff only and use the rest from the original language files !

//-- mod : mods settings ---------------------------------------------------------------------------
//-- add
$lang['Click_return_preferences'] = 'Klicke %shier%s um zu den Einstellungen zurückzugelangen';
//-- fin mod : mods settings -----------------------------------------------------------------------

// Start add - Birthday MOD
$lang['Birthday'] = "Geburtstag"; 
$lang['No_birthday_specify'] = "Keiner angegeben"; 
$lang['Age'] = "Alter"; 
$lang['Wrong_birthday_format'] = "Der Geburtstag wurde nicht korrekt eingegeben."; 
$lang['Birthday_to_high'] = 'Das Alter muss unter %d Jahren liegen'; 
$lang['Birthday_require'] = 'Die Eingabe des Geburtstags ist erforderlich'; 
$lang['Birthday_to_low'] = 'Das Alter muss über %d Jahren liegen';
$lang['Submit_date_format'] = "d.m.Y"; //php date() format - note: ONLY d , m and Y may be used and SHALL ALL be used (different sepperators are accepted) 
$lang['Birthday_greeting_today'] ="Herzlichen Glückwunsch zum Geburtstag! Mit deinen %s Jahren siehst du immer noch so aus wie eh und eh: einfach <b>blendend</b>.<br /> Also lass dich heute reich beschenken und feiern und lass dich nicht ärgern. <br /><br />Das Management";//%s is substituted with the users age 
$lang['Birthday_greeting_prev'] ="Hui! Wir kommen zu spät zu deinem %sten Geburtstag, der am %s war, stimmt's? Wir wünschen dir auch nachträglich noch alles Gute und hoffen, dass du einen schönen Purzeltag hattest.<br /><br /> Das Management";//%s is substituted with the users age, and birthday 
$lang['Greeting_Messaging'] ="Herzlichen Glückwunsch!"; 
$lang['Birthday_today'] = "Geburtstag(e) heute: "; 
$lang['Birthday_week'] = "Geburtstag(e) in den nächsten %d Tagen: "; 
$lang['Nobirthday_week'] = "Keine Geburtstage in den nächsten %d Tagen."; // %d is substitude with the number of days 
$lang['Nobirthday_today']="Heute hat niemand Geburtstag."; 
$lang['Year'] = 'Jahr'; 
$lang['Month'] = 'Monat'; 
$lang['Day'] = 'Tag';

// NOTE: Please do not translate the folowing 4 lines !
// They are automatically translated into your language
$lang['day_short'] = array ($lang['datetime']['Sun'],$lang['datetime']['Mon'],$lang['datetime']['Tue'],$lang['datetime']['Wed'],$lang['datetime']['Thu'],$lang['datetime']['Fri'],$lang['datetime']['Sat']);
$lang['day_long'] = array ($lang['datetime']['Sunday'],$lang['datetime']['Monday'],$lang['datetime']['Tuesday'],$lang['datetime']['Wednesday'],$lang['datetime']['Thursday'],$lang['datetime']['Friday'],$lang['datetime']['Saturday']);
$lang['month_short'] = array ($lang['datetime']['Jan'],$lang['datetime']['Feb'],$lang['datetime']['Mar'],$lang['datetime']['Apr'],$lang['datetime']['May'],$lang['datetime']['Jun'],$lang['datetime']['Jul'],$lang['datetime']['Aug'],$lang['datetime']['Sep'],$lang['datetime']['Oct'],$lang['datetime']['Nov'],$lang['datetime']['Dec']);
$lang['month_long'] = array ($lang['datetime']['January'],$lang['datetime']['February'],$lang['datetime']['March'],$lang['datetime']['April'],$lang['datetime']['May'],$lang['datetime']['June'],$lang['datetime']['July'],$lang['datetime']['August'],$lang['datetime']['September'],$lang['datetime']['October'],$lang['datetime']['November'],$lang['datetime']['December']);
// End add - Birthday MOD
// zodiacs used for birthday mod
$lang['Zodiac'] = 'Sternzeichen'; 
$lang['Capricorn'] = 'Steinbock'; 
$lang['Aquarius'] = 'Wassermann';  
$lang['Pisces'] = 'Fische'; 
$lang['Aries'] = 'Widder'; 
$lang['Taurus'] = 'Stier';  
$lang['Gemini'] = 'Zwillinge'; 
$lang['Cancer'] = 'Krebs'; 
$lang['Leo'] = 'Löwe';  
$lang['Virgo'] = 'Jungfrau'; 
$lang['Libra'] = 'Waage'; 
$lang['Scorpio'] = 'Skorpion';  
$lang['Sagittarius'] = 'Schütze'; 	
// chinese zodiacs used for birthday mod
$lang['Chinese_zodiac']= 'Chinesisches Sternzeichen'; 
$lang['Unknown'] = 'Unbekannt';  
$lang['Rat'] = 'Ratte'; 
$lang['Buffalo'] = 'Büffel'; 
$lang['Tiger'] = 'Tiger';  
$lang['Cat'] = 'Katze'; 
$lang['Dragon'] = 'Drache'; 
$lang['Snake'] = 'Schlange';  
$lang['Horse'] = 'Pferd'; 
$lang['Goat'] = 'Ziege'; 
$lang['Monkey'] = 'Affe';  
$lang['Cock'] = 'Hahn'; 
$lang['Dog'] = 'Hund'; 
$lang['Pig'] = 'Schwein';  

// Start add - Gender MOD
$lang['Gender'] = 'Geschlecht';//used in users profile to display witch gender he/she is 
$lang['Male'] = 'Männlich'; 
$lang['Female']='Weiblich'; 
$lang['No_gender_specify'] = 'Keine Angabe'; 
// End add - Gender MOD

// Start add - Last visit MOD
$lang['Last_logon'] = "Letzter Besuch"; 
$lang['Hidde_last_logon'] = "Versteckt"; 
$lang['Never_last_logon'] = "Niemals"; 
$lang['Users_today_zero_total'] = 'Es hat heute noch <b>niemand</b> das Forum besucht: ';
$lang['Users_today_total'] = 'Insgesamt haben heute <b>%d</b> User das Forum besucht: ';
$lang['User_today_total'] = 'Insgesamt hat heute <b>%d</b> User das Forum besucht: ';
$lang['Users_lasthour_explain'] = ', davon %d innerhalb der letzten Stunde.'; 
$lang['Users_lasthour_none_explain'] = ''; //showen of none have visited the last hour, fill if you like

$lang['Years'] = 'Jahre';
$lang['Year'] = 'Jahr';
$lang['Weeks'] = 'Wochen';
$lang['Week'] = 'Woche';
$lang['Day'] = 'Tag';
$lang['Total_online_time'] = 'Gesamte Online Dauer'; 
$lang['Last_online_time'] = 'Letzte Online Dauer'; 
$lang['Number_of_visit'] = 'Anzahl Besuche'; 
$lang['Number_of_pages'] = 'Anzahl der Page Hits'; 
// End add - Last visit MOD 

// FLAGHACK-start
$lang['Country_Flag'] = 'Landesflagge';
$lang['Select_Country'] = 'Wähle Land' ; 
// FLAGHACK-end

// Anti Robotic Registration
$lang['Wrong_reg_key'] = 'Anti Robot Überprüfungsfehler';
$lang['Validation'] = 'Überprüfung';
$lang['Validation_explain'] = 'Um automatische Registrierungen durch Robot Scripts zu verhindern, gib bitte den angezeigten Code in das Feld ein.'; 

//
// Smartor's ezPortal
//
$lang['Home'] = 'Portal';
$lang['Board_navigation'] = 'Board Navigation';
$lang['Statistics'] = 'Statistik';
$lang['total_topics'] = " in <b>%s</b> Themen geschrieben"; // added in v2.1.6
$lang['Comments'] = 'Kommentare';
$lang['Read_Full'] = 'Alles anzeigen';
$lang['View_comments'] = 'Kommentare anzeigen';
$lang['Post_your_comment'] = 'Antworten';
$lang['Welcome'] = 'Willkommen';
$lang['Register_new_account'] = 'Hast Du noch keinen Account ?<br />Du kannst hier kostenlos %sregistrieren%s';
$lang['Remember_me'] = 'Auto-Login';
$lang['View_complete_list'] = 'Komplette Liste';
$lang['Poll'] = 'Umfrage';
$lang['Login_to_vote'] = 'Du musst angemeldet sein um an der Umfrage teilzunehmen';
$lang['Vote'] = 'Abstimmen';
$lang['No_poll'] = 'Zur Zeit keine Umfrage';

$lang['Download'] = 'Download';
$lang['Viewing_Download'] = 'Downloads anzeigen';
$lang['Top_Downloads'] = 'Top 10';
$lang['Newest_Downloads'] = 'Neueste';
$lang['L_Word_on'] = 'am';
$lang['L_Word_by'] = 'von';
$lang['News_Reply'] = 'Auf diese News antworten';
$lang['News_Print'] = 'Dieses Thema drucken';
$lang['News_Email'] = 'Dieses Thema mailen';
$lang['Save_Topic'] = 'Dieses Thema als Datei sichern';
$lang['News_Categories'] = 'News Kategorien';
$lang['News_Archieves'] = 'News Archiv';
$lang['News_Summary'] = 'Diese News wurde';
$lang['News_Views'] = 'mal gelesen';
$lang['News_And'] = 'und hat';
$lang['News_Comments'] = 'Kommentare';
$lang['Credits'] = 'Mods und Credits';
$lang['News_Cats'] = 'News Kategorien';
$lang['No_News_Cats'] = 'Sorry, es existieren keine News Kategorien !';
$lang['Recent_files'] = 'Neueste Dateien';
$lang['Forum_Search'] = 'Forum Suche';
$lang['About_us'] = 'Über uns';
$lang['Portal_Navigate'] = 'Navigation';
$lang['Portal_Tools'] = 'Tools';
$lang['Site_links'] = 'Links';
$lang['Site_Contact'] = 'Kontakt';
$lang['Last_Seen'] = 'Zuletzt online';
$lang['No_News'] = 'Sorry, es sind keine News verfügbar';
$lang['Quick_Search'] = 'Schnellsuche';
$lang['Advanced_Search'] = 'Erweiterte Suche';

//
// Photo Album Addon v2.x.x by Smartor
//
$lang['Album'] = 'Album';
$lang['Personal_Gallery_Of_User'] = 'Persönliche Galerie von %s'; 
$lang['Newest_pic'] = 'Neuestes Photo';
//
// Start add  - Photo Album Block
$lang['Newest_pics'] = 'Neueste Bilder';
// End add  - Photo Album Block

// Start Quick Reply Mod
$lang['Quick_Reply'] = 'Kurz Antwort';
$lang['Quick_quote'] = 'Die letzte Nachricht zitieren';
$lang['Quick_add_smilies'] = 'Smilies';
$lang['QuoteSelelected'] = 'Auswahl zitieren';
$lang['QuoteSelelectedEmpty'] = 'Wähle einen Text aus und versuche es nochmal';
$lang['Quick_Reply_smilies'] = 'Alle';  
// End Quick Reply Mod 

$lang['Recent_topics'] = 'Letzte Themen'; 
$lang['No_recent_topics'] = '<br />Zur Zeit kein Thema<br /><br />'; // No recent Topics
$lang['No_recent_files'] = '<br />Zur Zeit keine Dateien<br /><br />'; // No recent Files
$lang['No_articles'] = '<br />Zur Zeit keine Artikel<br /><br />'; // No News

//
// Online/Offline
//
$lang['Offline'] = 'Offline';
$lang['Online'] = 'Online';
$lang['Hidden'] = 'Versteckt';
$lang['On_off_status'] = 'Status';

// Staff Mod
$lang['Staff'] = 'Mitarbeiter';
$lang['Staff_about'] = 'Informationen über %s'; // %s = Username
$lang['Staff_level'] = array('Administrator', 'Moderator');
$lang['Staff_forums'] = 'Foren';
$lang['Staff_messenger'] = 'Messenger';
$lang['Staff_user_topic_day_stats'] = '%.2f Themen pro Tag'; // %.2f = Themem
$lang['Staff_online'] = '<font color=#0000FF>online</font>';
$lang['Staff_year'] = 'Jahr';
$lang['Staff_years'] = 'Jahre';
$lang['Staff_week'] = 'Woche';
$lang['Staff_weeks'] = 'Wochen';
$lang['Staff_day'] = 'Tag';
$lang['Staff_days'] = 'Tage';
$lang['Staff_hour'] = 'Stunde';
$lang['Staff_hours'] = 'Stunden';
$lang['Staff_minute'] = 'Minute';
$lang['Staff_minutes'] = 'Minuten';
$lang['Staff_since'] = '(seit %s)'; // %s = Zeitraum
$lang['Staff_ago'] = '(vor %s)'; // %s = Zeitraum


//
// Bookmark Mod
//
$lang['Bookmarks'] = 'Lesezeichen';
$lang['Set_Bookmark'] = 'Lesezeichen für diesen Beitrag setzen';
$lang['Remove_Bookmark'] = 'Lesezeichen für diesen Beitrag enfernen'; 
$lang['No_Bookmarks'] = 'Du hast keine Lesezeichen gesetzt';
$lang['Always_set_bm'] = 'Lesezeichen automatisch bei Erstellung eines Beitrages setzen';
$lang['Found_bookmark'] = 'Du hast %d Lesezeichen gesetzt.'; // eg. Search found 1 match
$lang['Found_bookmarks'] = 'Du hast %d Lesezeichen gesetzt.'; // eg. Search found 24 matches
$lang['More_bookmarks'] = 'Mehr Lesezeichen...'; // For mozilla navigation bar

// Start add - Fully integrated shoutbox MOD
$lang['Shoutbox'] = 'Shoutbox';
$lang['Shoutbox_date'] = ' d m Y h:i:s';
$lang['Shout_censor'] = 'shout entfernt !';
$lang['Shout_refresh'] = 'Aktualisieren';
$lang['Shout_text'] = 'Dein Text';
$lang['Viewing_Shoutbox']= 'Shoutbox anzeigen';
$lang['Censor'] ='Zensiert';
// End add - Fully integrated shoutbox MOD

$lang['bbcode_g_help'] = "Glühen: [glow=Farbe]Text[/glow] (alt+g)"; 
$lang['bbcode_d_help'] = "Schatten: [shadow=Farbe]Text[/shadow] (alt+d)"; 
$lang['bbcode_e_help'] = "Align: [align=left|right|center|justify]text[/align] (alt+e)";
$lang['bbcode_h_help'] = "Fade Text: [fade]Text[/fade] (alt+h)";
$lang['bbcode_j_help'] = "Scrollender Text: [scroll**]Text[/scroll**] (alt+j)";
$lang['bbcode_k_help'] = "Highlighted Text: [highlight=Farbe]Text[/highlight] (alt+k)";
$lang['bbcode_m_help'] = "flash: [flash width= height= loop=]Flash File[/flash] (alt+m)";
$lang['bbcode_n_help'] = "Flip Text: [flipv]Text[/flipv] (alt+n)";
$lang['bbcode_r_help'] = "Flip Text: [fliph]Text[/fliph] (alt+r)";
$lang['bbcode_t_help'] = "Stream Files (wma, mp3, mp2...): [stream]http://Pfad_zur_Datei.wma[/stream] (alt+t)";
$lang['bbcode_v_help'] = "Links ausgerichtetes Bild: [left]Pfad_zum_Bild[/left] (alt+v)";
$lang['bbcode_x_help'] = "Rechts ausgerichtetes Bild: [right]Pfad_zum_Bild[/right] (alt+x)";
$lang['PHPCode'] = 'PHP'; // PHP MOD
$lang['bbcode_y_help'] = 'PHP syntax highlighter. [php]<?php code ?>[/php] (alt+y)'; // PHP MOD
$lang['bbcode_z_help'] = "Google: [google]String nach dem gesucht wird[/google] (alt+z)";
$lang['bbcode_sc_help'] = 'Smilie Creator: [schild=1]Text[/schild] Generiert ein Smilie Schild'; 
$lang['bbcode_th_help'] = 'Durchgestrichen: [s]Text[/s] (alt+th)';
$lang['Smilie_creator'] = 'Smilie Creator';
$lang['SC_shieldtext'] = 'Smilie Text';
$lang['SC_fontcolor'] = 'Textfarbe';
$lang['SC_shadowcolor'] = 'Schattenfarbe';
$lang['SC_shieldshadow'] = 'Schildschatten';
$lang['SC_shieldshadow_on'] = 'Aktivieren';
$lang['SC_shieldshadow_off'] = 'Deaktivieren';
$lang['SC_smiliechooser'] = 'Wähle Smilie';
$lang['SC_random_smilie'] = 'Zufalls-Smilie';
$lang['SC_default_smilie'] = 'Standard Smilie';
$lang['SC_create_smilie'] = 'Erstellen';
$lang['SC_stop_creating'] = 'Verwerfen';
$lang['SC_error'] = 'Hier ist Dein Schild - Du hast den Text vergessen...';
$lang['SC_another_shield'] = 'Möchte Du noch ein weiteres Smilie erstellen ?';
$lang['SC_notext_error'] = 'Du kannst kein Smilie ohne Text erstellen'; 

//
// TELL A FRIEND
$lang['Tell_Friend'] = "Dieses Thema verschicken";
$lang['Tell_Friend_Sender_User'] = "Dein Name:";
$lang['Tell_Friend_Sender_Email'] = "Deine Email";
$lang['Tell_Friend_Reciever_User'] = "Name des Empfängers:";
$lang['Tell_Friend_Reciever_Email'] = "Email des Empfängers:";
$lang['Tell_Friend_Msg'] = "Deine Nachricht:";
$lang['Tell_Friend_Title'] = "Dieses Thema einem Freund schicken";
$lang['Tell_Friend_Body'] = "Hi,\n\nIch habe gerade das Thema >>{TOPIC}<< bei {SITENAME} gelesen und dachte das würde dich auch interessieren.\n\nHier ist der Link: {LINK}\n\nSchau es dir mal an, wenn du antworten möchtest kannst du dir dort deinen eigenen Account anmelden.\n\nAntworte mir was du davon hälst. :)";  

// Start add - Who viewed a topic MOD
$lang['Topic_view_users'] = 'Zeige Benutzer, die dieses Thema gesehen haben';
$lang['Topic_time'] = 'Zuletzt gesehen';
$lang['Topic_count'] = 'Anzahl Ansichten';
$lang['Topic_view_count'] = 'Themenanzeige Zähler';
// End add - Who viewed a topic MOD

//
// Recent Topics
//
$lang['Recent_topics'] = 'Letzte Themen';
$lang['Recent_today'] = 'Heute';
$lang['Recent_yesterday'] = 'Gestern';
$lang['Recent_last24'] = 'Letzten 24 Stunden';
$lang['Recent_lastweek'] = 'Letzte Woche';
$lang['Recent_lastXdays'] = 'Letzten %s Tage';
$lang['Recent_last'] = 'Letzten';
$lang['Recent_days'] = 'Tage';
$lang['Recent_first'] = 'gestartet am %s';
$lang['Recent_first_poster'] = ' von %s';
$lang['Recent_select_mode'] = 'Wähle Modus:';
$lang['Recent_showing_posts'] = 'angezeigte Themen:';
$lang['Recent_title_one'] = '<font size=4>%s</font> Thema %s'; // %s = Thema; %s = Modus
$lang['Recent_title_more'] = '<font size=4>%s</font> Themen %s'; // %s = Themen; %s = Modus
$lang['Recent_title_today'] = ' von heute';
$lang['Recent_title_yesterday'] = ' von gestern';
$lang['Recent_title_last24'] = ' von den letzten 24 Stunden';
$lang['Recent_title_lastweek'] = ' von der letzten Woche';
$lang['Recent_title_lastXdays'] = ' von den letzten %s Tagen'; // %s = Tage
$lang['Recent_no_topics'] = 'Keine Themen gefunden.';
$lang['Recent_wrong_mode'] = 'Du hast einen falschen Modus ausgewählt.';
$lang['Recent_click_return'] = 'Klicke %shier%s, um zur recent Seite zurückzukehren.';

// Bottom of Page Link MOD - Daz - ForumImages.com - START/END Line Below
$lang['Go_to_bottom'] = 'Nach unten';

// Start add - Yellow card admin MOD
$lang['Give_G_card']="Benutzer reaktivieren"; 
$lang['Give_Y_card']="Dem Benutzer die %dte Verwarnung erteilen."; 
$lang['Give_R_card']="Diesen Benutzer JETZT sperren.";  
$lang['Ban_update_sucessful'] = "Die Sperrliste wurde erfolgreich aktualisiert"; 
$lang['Ban_update_green'] = "Der Benutzer ist nun reaktiviert"; 
$lang['Ban_update_yellow'] = "Der Benutzer hat eine Verwarnung erhalten, und hat nun %d von maximal %d Verwarnungen"; 
$lang['Ban_update_red'] = "Der Benutzer ist nun gesperrt"; 
$lang['Ban_reactivate'] = "Dein Nickname wurde reaktivert"; 
$lang['Ban_warning'] = "Du wurdest verwarnt!"; 
$lang['Ban_blocked'] = 'Dein Account ist nun blockiert'; 
$lang['Click_return_viewtopic'] = "Klick %shier%s, um zum Thema zurückzukeheren";  
$lang['Rules_ban_can'] = "Du <b>kannst</b> andere Benutzer in diesem Forum bannen"; 
$lang['user_no_email'] = "Der Benutzer hat keine eMail-Adresse angegeben, daher kann keine Benachrichtigung über diese Aktion an ihn geschickt werden. Du solltest ihm manuell eine nachricht zukommen lassen."; 
$lang['user_already_banned'] = "Der gewählte Benutzer ist bereits gesperrt."; 
$lang['Ban_no_admin'] ="Dieser Benutzer ist ein Administrator und kann weder verwarnt noch gesperrt werden."; 
$lang['Rules_greencard_can'] = "Du <b>kannst</b> Benutzer in diesem Foum entsperren"; 
$lang['Rules_bluecard_can'] = "Du <b>kannst</b> postings in diesem Forum beanstanden."; 
$lang['Give_b_card'] = "Diesen Beitrag einem Moderator melden."; 
$lang['Clear_b_card'] = "Dieses Posting hat bisher %d blaue Karten erhalten. Wenn du diesen Knopf drückst, löschst du diese Anzahl."; 
$lang['No_moderators'] ="Dieses Forum hat keinen Moderator, deswegen wird kein Bericht versandt."; 
$lang['Post_reported'] ="%d Moderatoren werden über die Beanstandung dieses Postings informiert."; 
$lang['Post_reported_1'] ="Der Moderator wird über die Beanstandung dieses Postings informaiert."; 
$lang['Post_report'] ="Beanstandung abschicken"; //Subject in email notification 
$lang['Post_reset'] = "Die Anzahl der blauen Karten dieses Postings wurde zurückgesetzt.";  
$lang['Search_only_bluecards'] = 'Alle Beiträge mit blauen Karten anzeigen.'; 
$lang['Send_message'] = 'Klicke %shier%s, um einen Beitrag zu beanstanden.<br/>'; 
$lang['Send_PM_user'] = 'Klicke %shier%s, um dem Benutzer eine PN zu schreiben.'; 
$lang['Link_to_post'] = 'Klick %sHere%s, um zum beanstandeten Beitrag zu gehen  <br/>--------------------------------<br/><br/>'; 
$lang['Post_a_report'] = 'Diesen Beitrag beanstanden'; 
$lang['Report_stored'] = 'Deine Beanstandung ist erfolgreich übermittelt worden.'; 
$lang['Send_report'] = 'Klick %shier%s, um zurück zu der ursprünglichen Anzeige zu gelangen'; 
$lang['Red_card_warning'] = 'Du willst dem Benutzer %s eine rote Karte geben. Damit sperrst du ihn. Bist du sicher, dass du dieses tun willst?'; 
$lang['Yellow_card_warning'] = 'Du willst dem Benutzer %s eine gelbe Karte geben. Damit lässt du ihm eine Verwarnung zukommen. Bist du sicher, dass du dieses tun willst?'; 
$lang['Green_card_warning'] = 'Du willst dem Benutzer %s eine grüne Karte geben. Damit entsperrst du ihn wieder. Bist du sicher, dass du dieses tun willst?'; 
$lang['Blue_card_warning'] = 'Du willst diesen Beitrag beanstanden. Wenn du dies tust, werden die Moderatoren dieses Forums darüber informiert. Bist du sicher, dass du dieses tun willst?'; 
$lang['Clear_blue_card_warning'] = 'Du bist im Begriff, den Zähler für blaue Karten für diesen Beitrag zurückzustellen. Möchtest du fortfahren?'; 
$lang['Warnings'] = 'Warnungen : %d'; //shown beside users post, if any warnings given to the user 
$lang['Banned'] = 'Z.Z. verboten';//shown beside users post, if user are banned 

// Start add - Protect user account MOD
$lang['Error_login_tomutch']='Du hast einen gesperrten Benutzernamen angegeben, bitte versuche es später wieder'; 
$lang['Password_not_complex'] ='Das angegebene Passwort enspricht nicht den erforderlichen Sicherheitsregeln, Du solltest sicherstellen dass: Das Passwort '; 
$lang['Password_to_short'] = 'mindestens %d Zeichen lang ist'; 
$lang['Password_mixed'] = 'sowohl Zahlen als auch Buchstaben enthält'; 
$lang['Password_not_same'] = 'nicht gleich Deinem Benutzernamen ist'; 
$lang['Time_format'] = 'D d. M, Y H:i:s';// how time should be shown in email notification 
$lang['Passwd_have_expired'] = 'Dein Passwort ist abgelaufen, Du solltest ein neues beantragen'; 
$lang['Passwd_expired'] = 'Dein Passwort ist abgelaufen und nicht länger gültig. Dennoch hast Du die Möglichkeit, jetzt ein neues auszuwählen. Wenn Du das Passwort aus irgendwelchen Gründen jetzt nicht ändern kannst...keine Panik. Du kannst beim nächsten Login ein zufälliges Passwort anfordern, indem Du auf den entsprechenden Link klickst.'; 
$lang['Passwd_soon_expired'] = 'Dein Passwort läuft in %d Tagen ab. Wir empfehlen Dir, es vor dem Ablaufdatum zu ändern. Solltest Du das Passwort ablaufen lassen, kannst Du beim nächsten Login ein zufälliges Passwort anfordern, indem Du auf den entsprechenden Link klickst.'; 
$lang['Send_new_passwd'] = 'Sende mir ein neues Passwort zu'; 
$lang['Passwd_updated'] = 'Vielen Dank <br />Dein neues Passwort wurde gespeichert'; 
$lang['Passwd_title'] = 'Bitte ändere Dein Passwort';
// End add - Protect user account MOD

$lang['Topic_description'] = 'Beschreibung:';
$lang['Description'] = 'Themen-Beschreibung';

// Start add - Topic in Who is online MOD
$lang['Browsing_topic'] = "Im Thema: ";
// End add - Topic in Who is online MOD

//admin user list mail 
$lang['Usersname'] = "Benutzername";
$lang['Admin_Users_List_Mail_Title'] = "Zeige Benutzer EMail";
$lang['Admin_Users_List_Mail_Explain'] = "Hier ist eine Liste der EMails Deiner Benutzer";

// Moved Folder Image Mod
$lang['Moved'] = 'Verschoben';

//signature editor
$lang['sig_description'] = "Signatur bearbeiten (<b>inklusive Vorschau</b>)";  
$lang['sig_edit'] = "Signatur bearbeiten";  
$lang['sig_current'] = "Aktuelle Signatur";  
$lang['sig_preview'] = "Vorschau"; 
$lang['sig_none'] = "Keine Signatur vorhanden"; 
$lang['sig_save'] = "Speichern"; 
$lang['sig_save_message'] = "Signatur erfolgreich gespeichert ! <br /><br />Klicke auf \"Aktuelle Signatur\" um sie noch einmal zu überprüfen.";  

//Absent User Mod
$lang['On_holidays'] = 'im Urlaub';
$lang['User_ill'] = 'erkrankt';
$lang['Longer_absenct'] = 'länger abwesend';
$lang['User_absence'] = 'Abwesend';
$lang['User_absence_mode'] = 'Art der Abwesenheit';
$lang['User_absence_text'] = 'Abwesenheitsnachricht';
$lang['User_absent'] = '<b>Abwesenheitsnachricht:</b><br /><br />%s ist %s.<br /><br /><i>%s</i><br /><br />Du kannst %s daher keine Nachricht senden!';
$lang['Absence_notify'] = 'Du hast Abwesenheit eingestellt.<br />Willst Du dieses jetzt abschalten?';
$lang['Absence_deleted'] = 'Du hast erfolgreich die Abwesenheit ausgeschaltet.<br /><br />Willkommen zurück!';

// Top 5 Posters in EzPortal Mod
$lang['Top_Posters'] = 'Top Poster';
$lang['Top_Member'] = 'Mitglieder';
$lang['Top_Posts'] = 'Beiträge';

// MOD MODCP EXTENSION BEGIN
$lang['Sticky_topic'] = 'Dieses Thema als Wichtig setzen';
$lang['Announce_topic'] = 'Dieses Thema als Ankündigung setzen';
$lang['Normal_topic'] = 'Dieses Thema zum Status Normal zurücksetzen';
$lang['Sticky'] = 'Wichtig';
$lang['Announce'] = 'Ankündigung';
$lang['Normalise'] = 'Normal';
$lang['Topics_Stickyd'] = 'Die gewählten Themen wurden als Wichtig gesetzt';
$lang['Topics_Announced'] = 'Die gewählten Themen wurden als Ankündigung gesetzt';
$lang['Topics_Normalised'] = 'Die gewählten Themen wurden als Normal gesetzt';
$lang['Check_All'] = 'Alle auswählen'; 
$lang['Uncheck_All'] = 'Auswahl entfernen';
// MOD MODCP EXTENSION END
$lang['Search_new2'] = 'Neue Beiträge';

$lang['Search_for'] = "Suche nach";
$lang['Submit_search'] = "Suche senden";
$lang['That_contains'] = "mit Inhalt";

$lang['Name'] = 'Name';
// Kontakttext:
$lang['kontakt1'] = '<b>HINWEIS:</b> Wenn Sie Fragen oder Probleme mit der Benutzung des Forums haben, beachten Sie bitte zuerst unsere <a href="faq.php"><b>FAQ</b></a>. Sollten Sie dort keine Antwort auf Ihre Fragen bekommen schicken Sie uns bitte eine Mail mit diesem Formular.<br><span class="gensmall">Mit * markierte Felder sind erforderlich.</span>';
$lang['kontakt2'] = 'Name:*';
$lang['kontakt3'] = 'E-Mail:*';
$lang['kontakt4'] = 'Betreff:*';
$lang['kontakt5'] = 'Text:*';
$lang['kontakt6'] = 'Absenden';
$lang['kontakt7'] = 'Loeschen';
$lang['kontakt8'] = 'Fehler, konnte Email nicht versenden!';
$lang['kontakt9'] = 'Email wurde versendet!';
$lang['kontakt_js1'] = 'Sind Sie sicher, dass Sie die Eingaben verwerfen wollen?';
$lang['kontakt_js2'] = 'Bitte geben Sie Ihren Namen ein!';
$lang['kontakt_js3'] = 'Bitte geben Sie Ihre E-Mail-Adresse ein!';
$lang['kontakt_js4'] = 'Keine gueltige E-Mail-Adresse!';
$lang['kontakt_js5'] = 'Bitte geben Sie einen Betreff an!';
$lang['kontakt_js6'] = 'Bitte geben Sie einen Text an!';
$lang['Kontakt'] = 'Kontakt Seite';
// Language Variables for phpBB2 Plus Forum Index Stats
$lang['Newest_user_plus'] = '<b>%s%s%s</b>'; // a href, username, /a
$lang['Live_Statistics'] = 'Live Statistik';
$lang['Latest_Member'] = 'Letzter';
$lang['New_Today'] = 'Heute neu';
$lang['New_Yesterday'] = 'Gestern neu';
$lang['Members_Overall'] = 'Insgesamt';
$lang['Online_Now'] = 'Jetzt Online';
$lang['Guests_P'] = 'Gäste';
$lang['Members_P'] = 'Mitglieder';
$lang['Box_Stats'] = 'Statistik';
$lang['User_Record'] = 'Benutzerrekord';
$lang['Birthdays_P'] = 'Geburtstage';
$lang['Online_Members_P'] = 'Eingeloggt';
$lang['Last_Visit'] = 'Online Statistik';

// Google Visit Counter Mod
$lang['Google_Visit_counter'] = 'Google Besuche: <b>%d</b>';

//+MOD: Select Expand BBcodes MOD
$lang['Select'] = "markieren";
$lang['Expand'] = "aufklappen";
$lang['Contract'] = "einklappen";
//-MOD: Select Expand BBcodes MOD

//--- Album Category Hierarchy : begin
//--- Version : 1.2.0
$lang['Personal_Gallery_Of_User_Profile'] = 'Persönliche Galerie von %s (%d Bilder)';
$lang['Show_All_Pic_View_Mode_Profile'] = 'Zeige alle Bilder in der persönlichen Galerie von %s (ohne Subkategorien)';
$lang['Click_larger'] = 'Klicke auf das Bild um eine grössere Ansicht zu erhalten';
//--- Album Category Hierarchy : end 

//BBCode Translations
$lang['B'] ='F';// Here the first letter of 'Bold' in your language
$lang['I'] ='K';// Here the first letter of 'Italic' in your language
$lang['U'] ='U';// Here the first letter of 'Underlined' in your language
$lang['Text'] ='Text';
$lang['Font_type'] = 'Schriftart';

//Portal Additions
$lang['KB_title'] = 'Knowledge Base';
$lang['Viewing_KB'] = 'Knowledge Base anzeigen';

// BEGIN Disable Registration MOD
$lang['registration_status'] = 'Registrierungen sind zur Zeit leider deaktiviert. Bitte versuche es später wieder.';
// END Disable Registration MOD
$lang['Admin_reauthenticate'] = 'Um das Board zu administrieren musst Du Dich erneut anmelden.';
//-- mod : run stats -----------------------------------------------------------
//-- add
// run stats
$lang['Stat_surround'] = '[ %s ]';
$lang['Stat_sep'] = ' - ';
$lang['Stat_page_duration'] = 'Zeit: %.4fs';
$lang['Stat_local_duration'] = 'Lokaler Trace: %.4fs';
$lang['Stat_part_php'] = 'PHP: %.2d%%';
$lang['Stat_part_sql'] = 'SQL: %.2d%%';
$lang['Stat_queries'] = 'Queries: %2d (%.4fs)';
$lang['Stat_gzip_enable'] = 'GZIP Ein';
$lang['Stat_debug_enable'] = 'Debug Ein';
$lang['Stat_request'] = 'Anfrage';
$lang['Stat_line'] = 'Zeile:&nbsp;%d';
$lang['Stat_cache'] = 'Cache:&nbsp;%.4fs';
$lang['Stat_dur'] = 'DB:&nbsp;%.4fs';
$lang['Stat_table'] = 'Tabelle';
$lang['Stat_type'] = 'Typ';
$lang['Stat_possible_keys'] = 'Mögliche Schlüssel';
$lang['Stat_key'] = 'Benutzter Schlüssel';
$lang['Stat_key_len'] = 'Schlüssel Länge';
$lang['Stat_ref'] = 'Ref.';
$lang['Stat_rows'] = 'Zeilen';
$lang['Stat_Extra'] = 'Kommentar';
$lang['Stat_Comment'] = 'Kommentar';
$lang['Stat_id'] = 'Id';
$lang['Stat_select_type'] = 'Wähle Typ';

// debug
$lang['dbg_line'] = 'Zeile';
$lang['dbg_file'] = 'Datei';
$lang['dbg_empty'] = 'Leer';
//-- fin mod : run stats -------------------------------------------------------
$lang['Login_attempts_exceeded'] = 'Die maximale Anzahl von %s Anmeldeversuchen ist erreicht. Es ist dir nicht möglich dich Anzumelden für %s Minuten.';
$lang['Please_remove_install_contrib'] = 'Bitte lösche das install/ Verzeichnis.';
//
// Custom Profile Fields MOD
//
$lang['custom_field_notice'] = 'Diese Felder wurden von einem Administrator erstellt. Diese können müssen aber nicht für alle sichtbar sein. Felder die mit einem * markiert sind, sind Pflicht.';
$lang['and'] = ' und ';

$lang['Session_invalid'] = 'Ungültige Sitzung. Bitte sende das Formular erneut.';
//
// END Custom Profile Fields MOD
//
//
// That's all Folks!
// -------------------------------------------------
?>
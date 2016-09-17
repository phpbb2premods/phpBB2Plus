<?php
/**************************************************************
*
*  MOD Title:   Complete banner
*  MOD Version: 1.2.0.
*  Translation: English
*  Rev date:    10/12/2003
*
*  Translator:  Niels < ncr@db9.dk > (Niels Chr. Rød) http://mods.db9.dk
*
***************************************************************/

// this is the text showen in admin panel, depending on your template layout,
// you may change the text, so this reflect the placement in the templates
// these are only exampels, you may add more or remove some of them.

$lang['Banner_spot']['0'] = "Over all banner"; // used for {BANNER_0_IMG} tag in the template files
$lang['Banner_spot']['1'] = "Top left 1"; // used for {BANNER_1_IMG} tag in the template files
$lang['Banner_spot']['2'] = "Top left 2"; // used for {BANNER_2_IMG} tag in the template files
$lang['Banner_spot']['3'] = "Top center 1"; // used for {BANNER_3_IMG} tag in the template files
$lang['Banner_spot']['4'] = "Top center 2"; // used for {BANNER_4_IMG} tag in the template files
$lang['Banner_spot']['5'] = "Top right 1"; // used for {BANNER_5_IMG} tag in the template files
$lang['Banner_spot']['6'] = "Top right 2"; // used for {BANNER_6_IMG} tag in the template files
$lang['Banner_spot']['7'] = "Bottom left 1"; // used for {BANNER_7_IMG} tag in the template files
$lang['Banner_spot']['8'] = "Bottom left 2"; // used for {BANNER_8_IMG} tag in the template files
$lang['Banner_spot']['9'] = "Bottom center 1"; // used for {BANNER_9_IMG} tag in the template files
$lang['Banner_spot']['10'] = "Bottom center 2"; // used for {BANNER_10_IMG} tag in the template files
$lang['Banner_spot']['11'] = "Bottom right 1"; // used for {BANNER_11_IMG} tag in the template files
$lang['Banner_spot']['12'] = "Bottom rigth 2"; // used for {BANNER_12_IMG} tag in the template files
$lang['Banner_spot']['13'] = "Forum_view top"; // used for {BANNER_13_IMG} tag in the template files
$lang['Banner_spot']['14'] = "Topic view top"; // used for {BANNER_14_IMG} tag in the template files
$lang['Banner_spot']['15'] = "Topic view botton"; // used for {BANNER_15_IMG} tag in the template files
$lang['Banner_spot']['16'] = "Portal Banner 1"; // used for {BANNER_16_IMG} tag in the template files
$lang['Banner_spot']['17'] = "Portal Banner 2"; // used for {BANNER_17_IMG} tag in the template files
$lang['Banner_spot']['18'] = "Portal Banner 3"; // used for {BANNER_18_IMG} tag in the template files
$lang['Banner_spot']['19'] = "Portal Banner 4"; // used for {BANNER_19_IMG} tag in the template files

//
// please do not modify the text below (except if you are translating)
//
$lang['Banner_title'] = "Banner Administration";
$lang['Banner_text'] = "Hier kannst du die Banner modifizieren, die auf deiner Seite erscheinen. Banner können mit zeitbasierten Regeln versehen werden";
$lang['Add_new_banner'] = "Neues Banner";
$lang['Banner_add_text'] = "Hier kannst du ein Banner hinzufügen oder ändern";

$lang['Banner_example'] = "Beispiel";
$lang['Banner_example_explain'] = "Dies soll anzeigen, wie das Banner dargestellt wird";
$lang['Banner_type_text'] = "Typ";
$lang['Banner_type_explain'] = "Wähle den Banner-Typ";
//pre-defined types
$lang['Banner_type'][0] = "Bild-Link";
$lang['Banner_type'][2] = "Text-Link";
$lang['Banner_type'][4] = "Benutzerdefinierter HTML-Code";
$lang['Banner_type'][6] = "Flash-Datei";

$lang['Banner_name'] = "Bild-Pfad/Text/Code";
$lang['Banner_name_explain'] = "Pfade müssen entweder relativ zum phpbb2-Pfad oder eine komplette URL sein (inklusive http://)";
$lang['Banner_size'] = "Bildgröße";
$lang['Banner_size_explain'] = "Wenn die Größe auf 0 gesetzt ist, wird das Bild in Originalgröße dargestellt";
$lang['Banner_width'] = "Breite";
$lang['Banner_height'] = "Höhe";

$lang['Banner_activated'] = "Aktiviert";
$lang['Banner_activate'] = "Banner aktivieren";
$lang['Banner_comment'] = "Kommentar";
$lang['Banner_description'] = "Bildbeschreibung";
$lang['Banner_description_explain'] = "Dieser Text wird angezeigt, wenn die Maus über dem Bild ist";
$lang['Banner_url'] = "Ziel-URL";
$lang['Banner_url_explain'] ="Die URL der Seite, die beim Mausklick aufgerufen wird, beginnend mit HTTP://<br />(Die Ziel-URL ist nur dann aktiviert, wenn der Typ ein Bild oder ein Textverweis ist)";
$lang['Banner_owner']="Moderator der Banners";
$lang['Banner_owner_explain']="Dieser Benutzer darf das Banner bearbeiten - (noch nicht implementiert)";
$lang['Banner_placement'] = "Position";
$lang['Banner_clicks'] = "Klicks";
$lang['Banner_clicks_explain'] = "(Der Counter ist nur aktiviert, wenn der Typ ein Bild oder ein Textverweis ist)";
$lang['Banner_view'] = "Views";
$lang['Banner_weigth'] = "Bannergewichtung";
$lang['Banner_weigth_explain'] = "Wie oft soll dieses Banner im Vergleich zu anderen aktivierten Bannern gezeigt werden (1-99)";
$lang['Show_to_users'] ='Benutzern zeigen';
$lang['Show_to_users_explain'] ='Wähle, welche Art von Benutzer das Banner sehen sollen';
$lang['Show_to_users_select'] = 'Benutzer muß %s bis %s sein'; //%s are supstituded with dropdown selections
$lang['Banner_level']['-1'] = 'Gast';
$lang['Banner_level']['0'] = 'Registrierter';
$lang['Banner_level']['1'] = 'Moderator';
$lang['Banner_level']['2'] = 'Administrator';
$lang['Banner_level_type']['0'] = 'gleich';
$lang['Banner_level_type']['1'] = 'kleiner oder gleich';
$lang['Banner_level_type']['2'] = 'größer oder gleich';
$lang['Banner_level_type']['3'] = 'nicht';
$lang['Time_interval'] = "Zeitintervall";
$lang['Time_interval_explain'] = "Gib entweder ein Datum, einen Wochentag oder/und eine Zeit an";
$lang['Start'] = "Start";
$lang['End'] = "Ende";
$lang['Year'] = "Jahr";
$lang['Month'] = "Monat";
$lang['Date'] = "Datum";
$lang['Weekday'] = "Wochentag";
$lang['Hour'] = "Stunde";
$lang['Min'] = "Minute";
$lang['Time_type'] = "Zeit-Typ";
$lang['Time_type_explain'] = "Wähle, ob die Information ein Zeit- oder Daten-Intervall ist <i>(du kannst immer noch ein Zeitintervall angeben, wenn du eine Datenintervall-basierte Regel angegeben hast)</i>";
$lang['Not_specify'] = "Nicht angegeben";
$lang['No_time'] = "Keine Zeit";
$lang['By_time'] = "Nach Zeit";
$lang['By_week'] = "Nach Wochentag";
$lang['By_date'] = "Nach Datum";

// messages
$lang['Missing_banner_id'] = "Die Banner-ID fehlt";
$lang['Missing_banner_owner'] = "Du mußt einen Banner-Eigentümer wählen";
$lang['Missing_time'] = "Wenn du ein Banner zeitbasiert angibst, mußt du das Zeitintervall angeben";
$lang['Missing_date'] ="Wenn du ein Banner datenbasiert angibst, mußt du zumindest das Datum und das Zeitintervall angeben";
$lang['Missing_week'] ="Wenn du ein Banner nach Wochentag angibst, mußt du zumindest den Wochentag und das Zeitintervall angeben";

$lang['Banner_removed'] = "Das Banner wurde entfernt";
$lang['Banner_updated'] = "Das Banner wurde aktualisiert";
$lang['Banner_added'] = "Das Banner wurde hinzugefügt";
$lang['Click_return_banneradmin'] = 'Klicke %shier%s, um zur Bannerverwaltung zurückzukehren';

$lang['No_redirect_error'] = 'Wenn die Seite nicht in Kürze angezeigt wird, klicke bitte <b><a href="%s" id="jumplink" name="jumplink">hier<a></b>, um zu der gewünschten URL zu gelangen';
$lang['Left_via_banner'] = 'Via Banner verlassen';

$lang['Banner_filter'] = 'Banner-Filter';
$lang['Banner_filter_explain'] = 'Verstecke dieses Banner, nachdem der Benutzer darauf geklickt hat';
$lang['Banner_filter_time'] = 'Inaktive Klick-Zeit';
$lang['Banner_filter_time_explain'] = 'Anzahl der Sekunden, die das Banner nach einem Benutzerklick inaktiv wird, wenn der Banner-Filter aktiviert wurde. Das Banner wird in dieser Zeit nicht angezeigt';

?>
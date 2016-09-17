<?php 
/************************************************************* 
* MOD Title:   Prune users
* MOD Version: 1.4.2
* Translation: English
* Rev date:    19/12/2003 
* 
* Translator:  Niels < ncr@db9.dk > (Niels Chr. R�d) http://mods.db9.dk 
* 
**************************************************************/

// add to prune inactive
$lang['X_Days'] = '%d Tage';
$lang['X_Weeks'] = '%d Wochen';
$lang['X_Months'] = '%d Monate';
$lang['X_Years'] = '%d Jahre';

$lang['Prune_no_users']="Keine Beutzer gel�scht";
$lang['Prune_users_number']="Die folgenden %d Benutzer wurden gel�scht:";

$lang['Prune_user_list'] = 'Benutzer, die gel�scht werden';
$lang['Prune_on_click'] = 'Du bist dabei, %d Benutzer zu l�schen. Bist Du sicher?';
$lang['Prune_Action'] = 'Klicke zur Ausf�hrung auf den unteren Link';
$lang['Prune_users_explain'] = 'Du kannst auf dieser Seite Benutzer l�schen. Du kannst einen der drei Links ausw�hlen: L�sche alte Benutzer, die niemals gepostet haben, l�sche alte Benutzer, die niemals eingeloggt waren, l�sche Benutzer, die niemals den Account aktiviert haben.<p/><b>Achtung:</b> Diese Aktion kann nicht r�ckg�ngig gemacht werden.';
$lang['Prune_commands'] = array();

// here you can make more entries if needed
$lang['Prune_commands'][0] = 'L�sche Null-Poster';
$lang['Prune_explain'][0] = 'die keinen Beitrag geschrieben haben, <b>ausser</b> neue Benutzer der letzten %d Tage';
$lang['Prune_commands'][1] = 'L�sche inaktive Benutzer';
$lang['Prune_explain'][1] = 'die nie eingeloggt waren, <b>ausser</b> neue Benutzer der letzten %d Tage';
$lang['Prune_commands'][2] = 'L�sche Nicht aktivierte Benutzer';
$lang['Prune_explain'][2] = 'die nie aktiviert waren, <b>ausser</b> neue Benutzer der letzten %d Tage';
$lang['Prune_commands'][3] = 'L�sche Lange-Zeit-her Benutzer'; 
$lang['Prune_explain'][3] = 'die seit 60 Tagen nicht im Forum waren, <b>ausser</b> neue Benutzer der letzten %d Tage'; 
$lang['Prune_commands'][4] = 'L�sche nicht so h�ufig schreibende Benutzer'; 
$lang['Prune_explain'][4] = 'die weniger als 1 Beitrag pro 10 Tage schreiben, <b>ausser</b> neue Benutzer der letzten %d Tage';

?>

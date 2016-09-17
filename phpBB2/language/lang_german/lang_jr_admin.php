<?php
/***************************************************************************
*                         admin_panel_nivisec.php
*                            -------------------
*   begin                : Friday, June 07, 2002
*   copyright            : (C) 2002 Nivisec.com
*   email                : admin@nivisec.com
*
*   $Id: lang_jr_admin.php,v 1.4 2003/08/15 02:09:36 nivisec Exp $
*
*
***************************************************************************/
$lang['None'] = 'Keine';
$lang['Allow_Access'] = 'Zugriff erlauben';

$lang['Jr_Admin'] = 'Junior Admin';
$lang['Options'] = 'Optionen';
$lang['Example'] = 'Beispiel';
$lang['Version'] = 'Version';
$lang['Add_Arrow'] = 'Hinzufügen ->';
$lang['Super_Mod'] = 'Super Moderator';
$lang['Update'] = 'Update';
$lang['Module_Info'] = 'Modulinfo';
$lang['Module_Count'] = 'Modulanzahl';
$lang['Modules_Owned'] = '(%d Module)';
$lang['Updated_Permissions'] = 'Modul User-Zugriffsrechte aktualisiert<br />';
$lang['Color_Group'] = 'Farbengruppe';
$lang['Users_with_Access'] = 'User mit Zugriff';
$lang['Users_without_Access'] = 'User ohne Zugriff';
$lang['Check_All'] = 'Alle aus-/abwählen';
$lang['Cat_Check_All'] = 'Kategorie: Alle aus-/abwählen';
$lang['Edit_Permissions'] = 'User-Zugriffsrechte ändern';
$lang['View_Profile'] = 'Userprofil anschauen';
$lang['Edit_User_Details'] = 'User-Details ändern';
$lang['Notes'] = 'Notizen';
$lang['Allow_View'] = 'Ansicht Usern erlauben';
$lang['Start_Date'] = 'Zugriffsrechte gegeben am ';
$lang['Update_Date'] = 'Zugriffsrechte aktualisiert am ';
$lang['Edit_Modules'] = 'Module ändern';
$lang['Rank'] = 'Rang';
$lang['Allow_PM'] = 'PN erlauben';
$lang['Allow_Avatar'] = 'Avatar erlauben';
$lang['User_Active'] = 'User aktiv';
$lang['User_Info'] = 'Userinfo';
$lang['User_Stats'] = 'Userstatistiken';
$lang['Junior_Admin_Info'] = 'Deine Junior Admin Info';
$lang['Admin_Notes'] = 'Adminnotizen';

//Descriptions
$lang['Levels_Page_Desc'] = 'Diese Seite ermöglicht es dir Userlevels zu definieren. Wähle einen Namen aus der Liste oder gebe den Namen manuell ein, um den User hinzuzufügen. Usernamen müssen in jeder Liste mit einem Komma (,) getrennt werden!';
$lang['Permissions_Page_Desc'] = 'Diese Seite erlaubt dir nur für den Admin bestimmte Useroptionen zu ändern und deren Modulliste anzupassen.<br />Über die Tabellenüberschrift können die Einträge sortiert werden.';

//Errors
$lang['Error_Users_Table'] = 'Fehler beim Zugriff auf users Tabelle.';
$lang['Error_Module_Table'] = 'Fehler beim Zugriff auf Jr Admin Modul Tabelle.';
$lang['Error_Module_ID'] = 'Das verlangte Modul existiert nicht oder du bist nicht authorisiert darauf zuzugreifen.';
$lang['Disabled_Color_Groups'] = 'Farbgruppen MOD nicht gefunden, Zuweisung einer Farbgruppe nicht möglich.';
$lang['Admin_Note'] = 'Notiz: Dieser User ist als Administrator definiert. Jede Beschränkung funktioniert nicht, es sei denn er erhält wieder den Status eines Users.';
$lang['No_Special_Ranks'] = 'Keine speziellen Ränge definiert.';

//This is the bookmark ASCII search list!  If you have odd usernames, you should add your own ASCII search numbers.
//It uses a special format.
//
// Smaller-case letters are ignored also.  Don't bother listing them as everything is converted to upper case for eval.
//
// It searches and prepares the bookmark heading IN THE ORDER you have it below.  It will not sort lowest to highest.
//
// Item-Item2 will search the code from item to item2 AND give each their own bookmark heading (ex. A-Z)
// Item&Item2 will search the code from item to item2 BUT NOT give each their own heading, they will appear like 1-9
// You can add single entries, ie 67
// Seperate entry areas by a ,
//
$lang['ASCII_Search_Codes'] = '48&57, 65-90';

//Images
// Don't change these unless you need to
$lang['ASC_Image'] = 'images/asc_order.png';
$lang['DESC_Image'] = 'images/desc_order.png';

?>
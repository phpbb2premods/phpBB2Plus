<?php
/***************************************************************************
 *						lang_extend_categories_hierarchy.php [English]
 *						------------------------------------
 *	begin				: 28/09/2003
 *	copyright			: Ptirhiik
 *	email				: ptirhiik@clanmckeen.com
 *
 *	version				: 1.0.1 - 10/11/2003
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

// admin part
if ( $lang_extend_admin )
{
	$lang['Lang_extend_categories_hierarchy']		= 'Kategorie Hierarchie';

	$lang['Category_attachment']					= 'Angefügt an';
	$lang['Category_desc']							= 'Beschreibung';
	$lang['Category_config_error_fixed']			= 'Ein Fehler im Kategorie Setup wurde korrigiert';
	$lang['Attach_forum_wrong']						= 'Du kannst kein Forum an ein Forum anfügen';
	$lang['Attach_root_wrong']						= 'Du kannst kein Forum an den Foren-Index anfügen';
	$lang['Forum_name_missing']						= 'Du kannst kein Forum ohne Namen anlegen';
	$lang['Category_name_missing']					= 'Du kannst keine Kategorie ohne Namen anlegen';
	$lang['Only_forum_for_topics']					= 'Themen können nur in Foren gefunden werden';
	$lang['Delete_forum_with_attachment_denied']	= 'Du kannst keine Foren löschen, die Sub-Level enthalten';
	$lang['Category_delete']						= 'Lösche Kategorie';
	$lang['Category_delete_explain']				= 'Hier kannst Du eine Kategorie löschen und bestimmen, wohin alle darin enthaltenen Foren und Kategorien verschoben werden sollen.';

	// forum links type
	$lang['Forum_link_url']							= 'Link URL';
	$lang['Forum_link_url_explain']					= 'Du kannst hier die URL zu einem phpBB Prog. setzen oder eine vollständige URL zu einem externen Server';
	$lang['Forum_link_internal']					= 'phpBB Prog';
	$lang['Forum_link_internal_explain']			= 'Wähle Ja, wenn Du ein Programm aufrufen möchtest, welches im phpBB Directory liegt';
	$lang['Forum_link_hit_count']					= 'Hits Zähler';
	$lang['Forum_link_hit_count_explain']			= 'Wähle Ja wenn Du möchtest, das das Board die Klicks zählt und auch darstellt';
	$lang['Forum_link_with_attachment_deny']		= 'Du kannst kein Forum als Link definieren, wenn es schon Sub-Level hat';
	$lang['Forum_link_with_topics_deny']			= 'Du kannst kein Forum als Link definieren, wenn es schon Themen enthält';
	$lang['Forum_attached_to_link_denied']			= 'Du kannst kein Forum oder eine Kategorie einem Forum Link zuordnen';

	$lang['Manage_extend']							= 'Management +';
	$lang['No_subforums']							= 'Keine Sub-Foren';
	$lang['Forum_type']								= 'Wähle die gewünschte Art des Forums';
	$lang['Presets']								= 'Voreinstellungen';
	$lang['Refresh']								= 'Aktualisieren';
	$lang['Position_after']							= 'Position dieses Forums hinter';
	$lang['Link_missing']							= 'Der Link fehlt';
	$lang['Category_with_topics_deny']				= 'Thema verbleibt in diesem Forum. Du kannst es nicht in eine Kategorie umwandeln.';
	$lang['Recursive_attachment']					= 'Du kannst keine Forum an die eigene niedrigste Ebene anhängen (Rekursives Attachment)';
	$lang['Forum_with_attachment_denied']			= 'Du kannst keine Kategorie in ein Forum ändern, wenn noch Foren an die Kategorie angehängt sind';
	$lang['icon']									= 'Icon';
	$lang['icon_explain']							= 'Dieses Icon wird vor dem Foren-Titel angezeigt. Du kannst hier eine direkte URL angeben oder einen $image[] key entry (siehe <i>dein_template</i>/<i>dein_template</i>.cfg).';
}

$lang['Forum_link']					= 'Link Weiterleitung';
$lang['Forum_link_visited']			= 'Dieser Link wurde %d mal besucht';
$lang['Redirect']					= 'Weiterleitung';
$lang['Redirect_to']				= 'Sollte Dein Browser keine Meta Weiterleitung unterstützen, klicke bitte %shier% für manuelle Weiterleitung';

$lang['Use_sub_forum']				= 'Index Pack-Level';
$lang['Hierarchy_setting']			= 'Kategorie Hierarchie Einstellungen';
$lang['Index_packing_explain']		= 'Wähle den Pack-Level der für den Index verwendet werden soll';
$lang['Medium']						= 'Mittel';
$lang['Full']						= 'Voll';
$lang['Split_categories']			= 'Kategorien im Index aufteilen';
$lang['Use_last_topic_title']		= 'Zeige die Titel der letzten Themen im Index';
$lang['Last_topic_title_length']	= 'Titellänge des letzten Themas im Index';
$lang['Sub_level_links']			= 'Sub-level Links im Index';
$lang['Sub_level_links_explain']	= 'Füge Links zu den Sub-Level in der Forum oder Kategorie Beschreibung hinzu';
$lang['With_pics']					= 'Mit Icons';
$lang['Display_viewonline']			= 'Viewonline Box (Standard phpBB2) einschalten';
$lang['Never']						= 'Nie';
$lang['Root_index_only']			= 'Nur Im Root Index';
$lang['Always']						= 'Immer';
$lang['Subforums']					= 'Subforen';
//-- mod : today at   yesterday at ------------------------------------------------------------------------ 
//-- add 
$lang['Today_at'] = '<b>Heute</b> um %s'; // %s is the time 
$lang['Yesterday_at'] = '<b>Gestern</b> um %s'; // %s is the time 
//-- end mod : today at   yesterday at ------------------------------------------------------------------------ 

?>
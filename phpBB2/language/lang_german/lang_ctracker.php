<?php
/***************************************************************************
 *                            lang_ctracker.php [German]
 *                            -------------------
 *   copyright            : (C) 2005 by Christian Knerr (CBACK)
 *   homepage             : http://www.cback.de
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

 // Footer Text
 $lang['ctr_footer_n'] = '<a href="http://www.cback.de" target="_blank">Sicherheit</a> durch <a href="http://www.cback.de" target="_blank">CBACK CrackerTracker</a>.';
 $lang['ctr_footer_c'] = 'Gesch�tzt durch <a href="http://www.cback.de" target="_blank">CBACK CrackerTracker</a><br><b>%s</b> abgewehrte Angriffe.';
 $lang['ctr_footer_i'] = 'Forensicherheit';
 $lang['ctr_footer_g'] = '<b>%s</b> Angriffe abgewehrt';

 // ACP
 $lang['ct_maintitle'] = 'CrackerTracker';
 $lang['ct_seccheck']  = 'Sicherheitscheck';
 $lang['ct_systest']   = 'Systemtest';
 $lang['ct_config']    = 'Konfiguration';
 $lang['ct_logs']      = 'Logdatei Manager';
 $lang['ct_footer']    = 'Footerauswahl';
 $lang['ct_blocker']   = 'Proxy&Agent blocker';
 $lang['ct_adm_foot']  = 'Powered by <a href="http://www.cback.de" target="_blank">CBACK CrackerTracker</a> Security System';

 // Security-Check
 $lang['ct_s_head']    = 'CTracker Sicherheitscheck';
 $lang['ct_s_desc']    = 'Der CBACK CrackerTracker Sicherheitscheck pr�ft einige Elemente Deines Boards und Deines Servers auf m�gliche Sicherheitsrisiken. Dieses System kann nicht bei allen Servern die Werte ermitteln, in diesem Fall werden bei den Versionsnummern keine Werte angezeigt. Bei Shared Hosts k�nnen die Einstellungen an der php.ini Konfiguration nicht selbst umgestellt werden. Auch die PHP Version selbst kann in diesem Fall nur vom Hoster aktualisiert werden.';
 $lang['ct_s_hd1']     = 'Testpunkt';
 $lang['ct_s_hd2']     = 'Deine Version';
 $lang['ct_s_hd3']     = 'Aktuelle Version';
 $lang['ct_s_hd4']     = 'Status';
 $lang['ct_s_hd5']     = 'Deine Einstellung';
 $lang['ct_s_t0']      = 'CrackerTracker';
 $lang['ct_s_t1']      = 'PHP4 Version';
 $lang['ct_s_t2']      = 'PHP5 Version';
 $lang['ct_s_t3']      = 'phpBB Version';
 $lang['ct_s_ukn']     = '<font color="orange"><b>UNBEKANNT</b></font>';
 $lang['ct_s_ok']      = '<font color="green"><b>SICHER</b></font>';
 $lang['ct_s_ac']      = '<font color="red"><b>UNSICHER</b></font>';
 $lang['ct_sc_v0']     = 'PHP Safe Mode';
 $lang['ct_sc_v1']     = 'PHP Globals';
 $lang['ct_sc_v2']     = 'phpBB visuelle Best�tigung';
 $lang['ct_sc_v3']     = 'phpBB Accountfreischaltung';
 $lang['ct_sc_on']     = 'aktiviert';
 $lang['ct_sc_off']    = 'deaktiviert';
 $lang['ct_s_infohe']  = 'Information';
 $lang['ct_s_info']    = 'Auch bei einem Shared Host (Webspace) hast Du die M�glichkeit Deine Forensoftware <a href="http://www.phpbb2.de" target="_blank">phpBB</a> sowie den <a href="http://www.cback.de" target="_blank">CBACK CrackerTracker</a> immer auf dem neuesten Stand zu halten. Desweiteren solltest Du wenn m�glich daf�r sorgen, dass auch Dein <a href="http://www.php.net" target="_blank">PHP Interpreter</a> auf dem Server immer auf einer aktuellen Version ist: Nicht selten kommt es vor, dass ein Forum oder anderes PHP Skript sicher ist, jedoch eine Bruchstelle in einer veralteten PHP Interpreterversion besteht. Kontaktiere bez�glich php.ini konfiguration und PHP Interpreter am Besten Deinen Hoster f�r weitere Informationen.';

 // System-Test
 $lang['ct_sys_he']    = 'CBACK CrackerTracker Systemtest';
 $lang['ct_sys_de']    = 'Der CrackerTracker Systemtest pr�ft das Sicherheitssystem auf funktionsf�higkeit. Es testet, ob die Sicherheitsmodule eine R�ckmeldung an das Forensystem liefern (und damit aktiv sind), ob die Dateiberechtigungen f�r die Logdateien korrekt gesetzt sind und ob Exploitangriffe erkannt werden k�nnen. Wenn Du selbst einmal einen Testangriff starten m�chtest, dann kannst Du dies mit einem Teststring machen. Klicke dazu einfach auf %sDIESEN</a> Link.';
 $lang['ct_sys_c1']    = 'CHMOD777: Counterdatei';
 $lang['ct_sys_c2']    = 'CHMOD777: Flooder Log';
 $lang['ct_sys_c3']    = 'CHMOD777: IPBlocker Log';
 $lang['ct_sys_c4']    = 'CHMOD777: Worm&Exploit Log';
 $lang['ct_sys_c5']    = 'Wurmschutz Engine';
 $lang['ct_sys_c6']    = 'IP&Agent Blocker Engine';
 $lang['ct_sys_c7']    = 'CrackerTracker Funktionsdatei';
 $lang['ct_sys_c8']    = 'Datenbankeintr�ge';
 $lang['ct_sys_c9']    = 'Footersystem';
 $lang['ct_sys_c10']   = 'Definitionsdatensatz';
 $lang['ct_sys_ok']    = '<font color="green"><b>OK</b></font>';
 $lang['ct_sys_er']    = '<font color="red"><b>FEHLER</b></font>';

 // Footer
 $lang['ct_submit']    = '�nderungen �bernehmen';
 $lang['ct_foot_h']    = 'Footerauswahl';
 $lang['ct_foot_d']    = 'Hier kannst Du den CrackerTracker Footer ausw�hlen welcher in Deinem Board angezeigt wird. Bitte beachte, dass Funktionen wie Angriffscounter nur bei PHP Interpretern neuer als PHP 4.3.6 funktionieren. Es wird au�erdem wegen der Sicherheit empfohlen, dass generell die neueste PHP Version auf dem Server installiert ist.';
 $lang['ct_foot_sh']   = 'Bitte w�hle den gew�nschten Footer';
 $lang['ct_f_ass']     = '<font color="red">�nderungen gespeichert</font>';

 // CT IP&Agent Blocker
 $lang['ct_pf_add']    = 'Hinzuf�gen';
 $lang['ct_pf_head']   = 'IP, Proxy&User Agent Blocker';
 $lang['ct_pf_head1']  = 'Neuen Eintrag hinzuf�gen';
 $lang['ct_pf_head2']  = 'Blockliste';
 $lang['ct_pf_desc']   = 'Hier kannst Du feste IP Adressen sperren (z.B. 192.168.0.40) oder User Agents (z.B. WebCrawler). Beachte bitte, dass dieses System um ein schnelleres Sperren zu vollziehen die gesamten Eintr�ge ben�tigt, Jokerzeichen sind also nicht gestattet. Diese sind dann bei der IP Ban Funktion von phpBB nutzbar. Beachte bitte au�erdem, dass W�rmer h�ufig gef�lschte IP Adressen benutzen und daher ein Ban von WurmIPs nichts bringt. Gegen W�rmer arbeitet schon das CrackerTracker Exploit Detection Engine, also keine Sorge: W�rmer werden gefiltert! Achte au�erdem darauf, dass Du nicht den UserAgent Deines Browsers eintr�gst, sonst sperrst Du Dich selbst aus dem Forum aus. ;)';
 $lang['ct_pf_desc1']  = 'Bitte trage hier die komplette IP Adresse oder den gesamten UserAgent ein, den CrackerTracker blockieren soll.';
 $lang['ct_pf_desc2']  = 'Hier siehst Du alle Eintr�ge in der CrackerTracker Proxy&Agent Blocker Blacklist und kannst hier ggf. Eintr�ge wieder aus dem Sperrsystem entfernen.';
 $lang['ct_pf_del']    = 'ENTSPERREN';

 // Configuration
 $lang['ct_conf_h']    = 'CBACK CrackerTracker Konfiguration';
 $lang['ct_conf_d']    = 'Hier kannst Du einige optionale Sicherheitsfunktionen steuern und nach Deinem Belieben anpassen.';
 $lang['ct_conf_tb1']  = 'Dynamische Logdatei Limitierung';
 $lang['ct_conf_tb2']  = 'Steuerung optionaler Sicherheitsmodule';
 $lang['ct_conf_tb3']  = 'Suchsperre';
 $lang['ct_conf_tb4']  = 'Flooder & Spammer Schutzfunktion';
 $lang['ct_conf_p1']   = 'Spammer & Flooder Logfile';
 $lang['ct_conf_d1']   = 'Hier kannst Du die maximalen Eintr�ge im Spammer Logfile einstellen. Dort werden alle Benutzer gespeichert, die wegen �berschreitung des "Postlimit innerhalb Zeitspanne" gesperrt wurden. Wenn diese Anzahl erreicht ist, wird das Logfile automatisch geleert.';
 $lang['ct_conf_p2']   = 'IP & UserAgent Blocker Logfile';
 $lang['ct_conf_d2']   = 'Hier k�nnen die maximalen Eintr�ge im IP & UserAgent Blocker Logfile eingestellt werden. Dort werden die in dem gleichnamigen Konfigurationspunkt gesperrten UserAgent und IP Anfragen auf das Forum geloggt. Nach �berschreitung der eingestellten Zahl wird das Logfile automatisch geleert.';
 $lang['ct_conf_p3']   = 'Proxy & Agent Blocker';
 $lang['ct_conf_d3']   = 'Hier kann das Proxy & Agent Blocker feature von CBACK CrackerTracker global aktiviert oder deaktiviert werden. Wird das Modul deaktiviert ignoriert das System die im gleichnamigen ACP Konfigurationspunkt definierte Blacklist.';
 $lang['ct_conf_p4']   = 'Spammer Protection';
 $lang['ct_conf_d4']   = 'Hier kann das Spammer Protection Engine aktiviert oder deaktiviert werden, welches bei �berschreitung einer Postzahl in einer gewissen Zeit automatisch einen Benutzer sperrt.';
 $lang['ct_conf_p5']   = 'Registrierungsflood - Schutz';
 $lang['ct_conf_d5']   = 'Dieses Feature sch�tzt die Registrierung von phpBB noch �ber die Visuelle Best�tigung hinaus. CrackerTracker pr�ft wiederauftreten der IP beim Registrieren und kann zwischen zwei Registrierungen eine Warteschleife erzeugen, um Flooder Skripte zu bremsen.';
 $lang['ct_conf_p6']   = 'Autoban f�r Spammer';
 $lang['ct_conf_d6']   = 'Ist diese Option aktiviert sowie die Option "Spammer Protection" aktiviert, dann werden die Benutzer gebannt. Ansonsten wird der Benutzeraccount deaktiviert. <b>Empfehlung:</b> Diese Option sollte auf aktiviert stehen, da Username Bannen die beste Methode ist. Es gibt auch Boards, bei denen eine Aktivierungsmail f�r den Account erneut zugeschickt werden kann.';
 $lang['ct_conf_p9']   = 'Maximale Suchen bis Zeitsperre';
 $lang['ct_conf_d9']   = 'Hier kannst Du einstellen, wieviele Suchanfragen Registrierte (!) Benutzer nacheinander ausf�hren k�nnen, bis eine Zeitsperre aktiviert wird.';
 $lang['ct_conf_p10']  = 'Suchfunktion Zeitbegrenzung';
 $lang['ct_conf_d10']  = 'Hier kannst Du einstellen, wieviel Sekunden ein Benutzer warten muss wenn er entweder (Registrierte Benutzer) sein Suchanzahl Limit �berschritten hat, oder bis er 2 aufeinanderfolgende Suchen (Gast) ausf�hren kann. (Sch�tzt vor �berflutungen durch Skripte)';
 $lang['ct_conf_p11']  = 'Registrierungs Zeitbegrenzung';
 $lang['ct_conf_d11']  = 'Hier kann die Wartezeit in Sekunden zwischen zwei aufeinanderfolgenden Registrierungen eingestellt werden. (Sch�tzt vor Server�berlastung durch Skripte)';
 $lang['ct_conf_p12']  = 'Zeitspanne der Postz�hlung';
 $lang['ct_conf_d12']  = 'Hier kannst Du die Zeitspanne in Sekunden einstellen, in der das Limit der nachfolgend einstellbaren Postzahl eines Benutzers nicht �berschritten werden darf. Ansonsten wird - wenn dieses Engine oben aktiviert wurde - der Benutzer gesperrt.';
 $lang['ct_conf_p13']  = 'Anzahl der Postings innerhalb der Zeitspanne';
 $lang['ct_conf_d13']  = 'Hier kannst Du einstellen, wieviele Posts ein Benutzer in der oben eingestellten Zeitspanne schreiben muss, bis er vom CrackerTracker System automatisch als Spammer identifiziert und - wenn das Engine oben aktiviert wurde - gesperrt wird.';
 $lang['ct_conf_p14']  = 'Mail�berwachung';
 $lang['ct_conf_d14']  = 'Ist dieses Feature aktiviert, kann ein Benutzer �ber die Formularfunktion von phpBB immer nur eine EMail innerhalb von 4 Minuten versenden.';
 $lang['ct_conf_p15']  = 'Passwort Reset �berwachung';
 $lang['ct_conf_d15']  = 'Ist dies aktiviert, so kann sich ein Benutzer immer nur einmal eine Passwort Reset Anforderung senden, bis er diese best�tigt hat.';
 $lang['ct_conf_p16']  = 'Loginschutz System';
 $lang['ct_conf_d16']  = 'Aktiviert die visuelle Best�tigung beim Login um vor BruteForce Attacken zu sch�tzen.';
 $lang['ct_conf_act']  = 'Aktivieren';
 $lang['ct_conf_dact'] = 'Deaktivieren';

 // Logfile Manager
 $lang['ct_log_head']  = 'CrackerTracker Logfile Manager';
 $lang['ct_log_desc']  = 'Hier kannst Du die CrackerTracker Logdateien verwalten, ansehen und l�schen.';
 $lang['ct_log_cell1'] = 'Logdatei';
 $lang['ct_log_cell2'] = 'Eintr�ge';
 $lang['ct_log_cell3'] = 'Optionen';
 $lang['ct_log_f1']    = 'Wurm & Exploit Logdatei';
 $lang['ct_log_f2']    = 'IP & Agent Blocker Logdatei';
 $lang['ct_log_f3']    = 'Spammer Logdatei';
 $lang['ct_log_l1']    = 'ANSEHEN';
 $lang['ct_log_l2']    = 'L�SCHEN';
 $lang['ct_log_l3']    = 'ALLE LOGDATEIEN L�SCHEN';
 $lang['ct_log_gl']    = 'Globale Funktionen';
 $lang['ct_log_gl1']   = 'Insgesamt hat CBACK CrackerTracker <b>%s</b> Angriffe auf das Forum abgewehrt. Mit dem nachfolgenden Link kannst Du alle Logdateien auf einmal l�schen. Der Counter bleibt davon unber�hrt.<br>';
 $lang['ct_log_back']  = '&laquo; ZUR�CK ZUR �BERSICHT';
 $lang['ct_log_tc1']   = 'Datum / Zeit';
 $lang['ct_log_tc2']   = 'IP';
 $lang['ct_log_tc3']   = 'Angriffsart';
 $lang['ct_log_tc4']   = 'Referrer';
 $lang['ct_log_tc5']   = 'User Agent';
 $lang['ct_log_entr']  = 'Es befinden sich zur Zeit %s Eintr�ge in der Logdatei.';
 $lang['ct_log_entr1'] = 'Es befindet sich zur Zeit ein Eintrag in der Logdatei.';

 // Language for parts into the Board itself
 $lang['ct_forum_sfl'] = 'Aus Sicherheitsgr�nden ist die Suche leider nur alle %s Sekunden m�glich. Du musst noch %s Sekunden bis zur n�chsten Suche warten.';
 $lang['ct_forum_rfl'] = 'Es fand gerade eine Registrierung statt. Aus Sicherheitsgr�nden musst Du noch %s Sekunden bis zur n�chsten Registrierung warten.';
 $lang['ct_forum_ifl'] = 'Du hast Dich anscheinend soeben schon registriert. Bitte pr�fe, ob Du normal eingeloggt bist (Login klicken) oder ob vielleicht weitere Schritte wie z.B das Best�tigen einer Aktivierungsmail erforderlich sind.';
 $lang['ct_forum_wa']  = '<b>WARNUNG!</b><br><br>CrackerTracker Spammer Erkennungssystem hat festgestellt, dass gleich die vom Administrator eingestellte h�chstpostzahl innerhalb einer Zeitspanne erreicht wurde. Bitte warte %s Sekunden bis zu Deinem n�chsten Post, ansonsten wird Dein Benutzeraccount gesperrt!';
 $lang['ct_forum_blo'] = '<b>CRACKERTRACKER SPAMMER PROTECTION</b><br><br>Du hast die maximalzahl Posts in der eingestellten Zeitspanne �berschritten. Dies sind aktivit�ten eines Spammers, daher wurde Dein Benutzeraccount nun gesperrt.';
 $lang['ct_forum_emb'] = '<b>CRACKERTRACKER INFORMATION</b><br><br>Es wurde vor kurzen bereits eine E-Mail gesendet. Um Massen Mails zu verhindern kannst Du zur Zeit keine E-Mail mehr senden. Bitte versuche es sp�ter erneut.';
 $lang['ct_forum_slo'] = 'Um Deinen Login zu best�tigen musst Du aus Sicherheitsgr�nden den nachfolgenden Visuellen Best�tigungscode eingeben um den Loginvorgang zu vervollst�ndigen.';
 $lang['ct_forum_sl1'] = 'Die Eingabe des Visuellen Best�tigungscodes war nicht korrekt! Bitte versuche es erneut.';
 $lang['ct_forum_pws'] = 'Du hast vor kurzem das Passwort R�cksetzsystem benutzt. Bitte pr�fe Deine E-Mails f�r informationen �ber die weitere Vorgehensweise. Wenn Du keine E-Mail bekommen hast, dann kontaktiere den Administrator des Forums oder warte 4 Stunden bis Du Dir erneut eine Passwort-Reset Mail zusenden lassen kannst.';

?>
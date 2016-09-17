<?php
/***************************************************************************
 *                            lang_ctracker.php [English]
 *                            -------------------
 *   copyright            : (C) 2005 by Christian Knerr (CBACK)
 *   homepage             : http://www.cback.de
 *
 *                            english translation
 *                           ---------------------
 *   copyright            : (C) 2005 by Michael Auchtor (herr-der-winde)
 *   homepage             : http://www.herrderwinde.de.vu
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
 $lang['ctr_footer_n'] = '<a href="http://www.cback.de" target="_blank">Security</a> with <a href="http://www.cback.de" target="_blank">CBACK CrackerTracker</a> Protection Engine.';
 $lang['ctr_footer_c'] = 'Protected by <a href="http://www.cback.de" target="_blank">CBACK CrackerTracker</a><br><b>%s</b> Attacks blocked.';
 $lang['ctr_footer_i'] = 'Board Security';
 $lang['ctr_footer_g'] = '<b>%s</b> Attacks blocked';

 // ACP
 $lang['ct_maintitle'] = 'CrackerTracker';
 $lang['ct_seccheck']  = 'Security Check';
 $lang['ct_systest']   = 'System Test';
 $lang['ct_config']    = 'Configuration';
 $lang['ct_logs']      = 'Logfile Manager';
 $lang['ct_footer']    = 'Select Footer';
 $lang['ct_blocker']   = 'Proxy&Agent blocker';
 $lang['ct_adm_foot']  = 'Powered by <a href="http://www.cback.de" target="_blank">CBACK CrackerTracker</a> Security System';

 // Security-Check
 $lang['ct_s_head']    = 'CTracker Security Check';
 $lang['ct_s_desc']    = 'The CBACK CrackerTracker Security Check checks some Elements of your Board and your Server for possible Security issues. This System can\'t detect the values on all Servers, in this case, the table is empty at this place. On Shared Hosts, you can\'t configure the settings of the php.ini yourself. In this case too, the PHP Version itself only could be updated by your Hoster.';
 $lang['ct_s_hd1']     = 'Checkpoint';
 $lang['ct_s_hd2']     = 'Your Version';
 $lang['ct_s_hd3']     = 'Current Version';
 $lang['ct_s_hd4']     = 'Status';
 $lang['ct_s_hd5']     = 'Your Setting';
 $lang['ct_s_t0']      = 'CrackerTracker';
 $lang['ct_s_t1']      = 'PHP4 Version';
 $lang['ct_s_t2']      = 'PHP5 Version';
 $lang['ct_s_t3']      = 'phpBB Version';
 $lang['ct_s_ukn']     = '<font color="orange"><b>UNKNOWN</b></font>';
 $lang['ct_s_ok']      = '<font color="green"><b>SAFE</b></font>';
 $lang['ct_s_ac']      = '<font color="red"><b>UNSAFE</b></font>';
 $lang['ct_sc_v0']     = 'PHP Safe Mode';
 $lang['ct_sc_v1']     = 'PHP Globals';
 $lang['ct_sc_v2']     = 'phpBB visual confirmation';
 $lang['ct_sc_v3']     = 'phpBB account activation';
 $lang['ct_sc_on']     = 'activated';
 $lang['ct_sc_off']    = 'deactivated';
 $lang['ct_s_infohe']  = 'Information';
 $lang['ct_s_info']    = 'On a Shared Host (Webspace), you have the possibility to keep your forum software <a href="http://www.phpbb2.de" target="_blank">phpBB</a> and the <a href="http://www.cback.de" target="_blank">CBACK CrackerTracker</a> up to date. Further, if possible, you should keep your <a href="http://www.php.net" target="_blank">PHP Interpreter</a> on your Server up to date: Often it happens, that a Forum or another PHP Script is safe, but a Breaking Point exists in an old PHP Interpreter Version. You should contact with reference to php.ini Configuration and PHP Interpreter your Hoster for further Information.';

 // System-Test
 $lang['ct_sys_he']    = 'CBACK CrackerTracker System Test';
 $lang['ct_sys_de']    = 'The CrackerTracker System Test proofs the Security System, if it works properly. It tests, if the Security Modules sent a response (and therewith are active) on the Forum System, if the File Authorizations for the Logfiles are right and if Exploit Attacks could be recognized. If you want to start a Test Attack, you could do this with a Test String, Just klick on %sTHIS</a> Link.';
 $lang['ct_sys_c1']    = 'CHMOD777: Counter File';
 $lang['ct_sys_c2']    = 'CHMOD777: Flooder Log';
 $lang['ct_sys_c3']    = 'CHMOD777: IPBlocker Log';
 $lang['ct_sys_c4']    = 'CHMOD777: Worm&Exploit Log';
 $lang['ct_sys_c5']    = 'Worm Protection Engine';
 $lang['ct_sys_c6']    = 'IP&Agent Blocker Engine';
 $lang['ct_sys_c7']    = 'CrackerTracker Functions File';
 $lang['ct_sys_c8']    = 'Database Entries';
 $lang['ct_sys_c9']    = 'Footer System';
 $lang['ct_sys_c10']   = 'Definition Record';
 $lang['ct_sys_ok']    = '<font color="green"><b>OK</b></font>';
 $lang['ct_sys_er']    = '<font color="red"><b>ERROR</b></font>';

 // Footer
 $lang['ct_submit']    = 'Save Changes';
 $lang['ct_foot_h']    = 'Select a Footer';
 $lang['ct_foot_d']    = 'Here you can select the CrackerTracker Footer, which is shown in your Board. Please regard, that Functions like the Attack Counter only work in newer PHP Interpreters as PHP 4.3.6. Additional, you should generally should have installed the newest PHP Version on your Server because Security.';
 $lang['ct_foot_sh']   = 'Please select favorite Footer';
 $lang['ct_f_ass']     = '<font color="red">Settings safed</font>';

 // CT IP&Agent Blocker
 $lang['ct_pf_add']    = 'Add';
 $lang['ct_pf_head']   = 'IP, Proxy&User Agent Blocker';
 $lang['ct_pf_head1']  = 'Add a new Entry';
 $lang['ct_pf_head2']  = 'Block List';
 $lang['ct_pf_desc']   = 'Here you can block fixed IP Adresses (e.g. 192.168.0.40) or User Agents (e.g. WebCrawler). Please regard, that this System needs the whole Entries for faster Blocking, Wildcard characters aren\'t allowed. These are available at the IP Ban Function of phpBB. Please also regard, that Worms often use faked IP Adresses and a Ban of Worm IP\'s is useless. The CrackerTracker Exploit Detection Engine works against Worms, so don\'t worry: Worms get filtered! Respect too, that you don\'t register your Browser\'s UserAgent, because then you block yourself out of your Forum.';
 $lang['ct_pf_desc1']  = 'Please enter here the complete IP Adress or the whole UserAgent, which CrackerTracker should block.';
 $lang['ct_pf_desc2']  = 'Here you see all Entries of the CrackerTracker Proxy&Agent Blocker Blacklist and you can delete Entries of the Block System, if necessary.';
 $lang['ct_pf_del']    = 'UNBLOCK';

 // Configuration
 $lang['ct_conf_h']    = 'CBACK CrackerTracker Configuration';
 $lang['ct_conf_d']    = 'Here you can control some optional Security Functions and accommodate as you want.';
 $lang['ct_conf_tb1']  = 'Dynamic Logfile Limitation';
 $lang['ct_conf_tb2']  = 'Control of optional Security Modules';
 $lang['ct_conf_tb3']  = 'Search Barrier';
 $lang['ct_conf_tb4']  = 'Flooder & Spammer Protection Function';
 $lang['ct_conf_p1']   = 'Spammer & Flooder Logfile';
 $lang['ct_conf_d1']   = 'Here you can select the maximum entries of the Spammer Logfile. In this file, alle Users get saved, who had been blocked because of "Post Limit during period of time". If this count is reached, the Logfile gets automatically cleared.';
 $lang['ct_conf_p2']   = 'IP & UserAgent Blocker Logfile';
 $lang['ct_conf_d2']   = 'Here you can adjust the maximum Entries of the IP & UserAgent Blocker Logfile. There, the blocked UserAgent and IP Requests of the eponymous Configurationpoint on the Forum will be logged. After Striding the adjusted Count, the Logfile gets automatically cleared.';
 $lang['ct_conf_p3']   = 'Proxy & Agent Blocker';
 $lang['ct_conf_d3']   = 'Here you can globally activate or deactivate the Proxy & Agent Blocker Feature of CBACK CrackerTracker. If this Module is deactivated, the System ignores the defined Blacklist in the eponymous Configurationpoint.';
 $lang['ct_conf_p4']   = 'Spammer Protection';
 $lang['ct_conf_d4']   = 'Here you can activate oder daectivate the Spammer Protection Engine, which blocks a User by Striding a count of Posts in a given time.';
 $lang['ct_conf_p5']   = 'Registration Flooding Protection';
 $lang['ct_conf_d5']   = 'This Feature protects the Registry of phpBB additional to the Visual Confirmation. CrackerTracker proofs reccurent IP\'s on registration and can create a Wait Loop between two Registrations to slow down Flooder Skripts.';
 $lang['ct_conf_p6']   = 'Automatic Ban for Spammer';
 $lang['ct_conf_d6']   = 'If this Option and the Option "Spammer Protection" is activated, the Users will be banned. Otherwise, the Useraccount gets deactivated. <b>Advice:</b> This Option should be activated, cause Username Banning is the best method. There are Boards too, where you can request the Activation Mail for the Account once again.';
 $lang['ct_conf_p9']   = 'Maximum Search until Timebarrier';
 $lang['ct_conf_d9']   = 'Here you can choose, how many Search requests registered (!) Users could execute one after another, until the Timebarrier gets activated.';
 $lang['ct_conf_p10']  = 'Search Function Time Limitation';
 $lang['ct_conf_d10']  = 'Here you can choose, how many Seconds a User has to has to wait, if he either (Registered Users) strided his limit of Searchcounts, or until he can execute two following Searches. (Prevents Flooding through Scripts)';
 $lang['ct_conf_p11']  = 'Registration Time Limitation';
 $lang['ct_conf_d11']  = 'Here you can select the latency in seconds between two following registrations.(Prevents Server-overloads through Scripts)';
 $lang['ct_conf_p12']  = 'Period of Postcounting';
 $lang['ct_conf_d12']  = 'Here you can adjust the Period in Seconds, in which the Limit of following chooseable Posts of a User mustn\'t be stridden. Otherwise - if the Engine above was activated - the User will be blocked.';
 $lang['ct_conf_p13']  = 'Count of Postings during the Period of Time.';
 $lang['ct_conf_d13']  = 'Here you can choose, how many Posts a User has to write in the selected Period, till the CrackerTracker System identifies him as a Spammer and - if the Engine above was activated - gets blocked.';
 $lang['ct_conf_p14']  = 'Mail-Delivery Check';
 $lang['ct_conf_d14']  = 'If you enabled this feature, every User can just deliver a Mail over the phpBB Formmailer each 4 Minutes.';
 $lang['ct_conf_p15']  = 'Passwort Reset Check';
 $lang['ct_conf_d15']  = 'If this is activated, CrackerTracker will just allow one Password Resend till the password was changed.';
 $lang['ct_conf_p16']  = 'Loginprotection System';
 $lang['ct_conf_d16']  = 'Here you can enable Visual Confirmation during Login to protect from Brute Force Attacks.';
 $lang['ct_conf_act']  = 'Activate';
 $lang['ct_conf_dact'] = 'Deactivate';

 // Logfile Manager
 $lang['ct_log_head']  = 'CrackerTracker Log File Manager';
 $lang['ct_log_desc']  = 'Here you can administrate, delete and look at CrackerTracker Log Files.';
 $lang['ct_log_cell1'] = 'Log File';
 $lang['ct_log_cell2'] = 'Entries';
 $lang['ct_log_cell3'] = 'Options';
 $lang['ct_log_f1']    = 'Worm & Exploit Logfile';
 $lang['ct_log_f2']    = 'IP & Agent Blocker Logfile';
 $lang['ct_log_f3']    = 'Spammer Logfile';
 $lang['ct_log_l1']    = 'VIEW';
 $lang['ct_log_l2']    = 'DELETE';
 $lang['ct_log_l3']    = 'DELETE ALL LOGFILES';
 $lang['ct_log_gl']    = 'Global Functions';
 $lang['ct_log_gl1']   = 'CBACK CrackerTracker has blocked <b>%s</b> Attacks on the Forum. With the following Link, you can delete all Logfiles at once. The Counter stays untouched.<br>';
 $lang['ct_log_back']  = '&laquo; BACK TO MENU';
 $lang['ct_log_tc1']   = 'Date / Time';
 $lang['ct_log_tc2']   = 'IP';
 $lang['ct_log_tc3']   = 'Attack Type';
 $lang['ct_log_tc4']   = 'Referrer';
 $lang['ct_log_tc5']   = 'User Agent';
 $lang['ct_log_entr']  = 'Actually, there are %s Entries in the Logfile.';
 $lang['ct_log_entr1'] = 'Actually, there is 1 Entry in the Logfile..';

 // Language for parts into the Board itself
 $lang['ct_forum_sfl'] = 'To protect against Search Flooding you can only start a search every %s seconds. You have to wait %s seconds till your next search.';
 $lang['ct_forum_rfl'] = 'There was a Registration just before. To protect against Register Flooders you have to wait %s seconds till next Registration is possible.';
 $lang['ct_forum_ifl'] = 'It seems that you have Registered an account short time before. Please check if you are logged in normally (click LogIn) or if you have to do further steps to confirm your registration, maybe activate your Account over EMail.';
 $lang['ct_forum_wa']  = '<b>WARNING!</b><br><br>CrackerTracker Spammer Detector found, that the Maximum Post Count is reached. If you will make a new post within the next %s seconds your will be banned!';
 $lang['ct_forum_blo'] = '<b>CRACKERTRACKER SPAMMER PROTECTION</b><br><br>You reached maximum Post count. Your User Account was blocked.';
 $lang['ct_forum_emb'] = '<b>CRACKERTRACKER INFORMATION</b><br><br>You sended a Mail short time before. To protect Mass-Mails you currently can\'t send more Messages. Please try again later.';
 $lang['ct_forum_slo'] = 'For Security Reasons please enter the following Visual Confirmation Code to log in into this Board.';
 $lang['ct_forum_sl1'] = 'Visual Confirmation Code wrong. Please try again!';
 $lang['ct_forum_pws'] = 'You sended a request for a new Password short time before. Please check your E-Mails and do the Steps from the Mail you recieved. If you had problems to recieve a Mail please Contact the Board Administrator or wait 4 hours till your next Password Reset Request.';

?>
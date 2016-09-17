<?php
/***************************************************************************
 *                                update.php
 *                            -------------------
 *   begin                : Saturday, Nov 12, 2005
 *   copyright            : (C) Christian Knerr (CBACK)
 *   homepage             : http://www.cback.de
 *
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This Script is NOT released under GPL License! Sorry, but this should
 *   stay an unique part of CBACK MODs and the Orion Update System.
 *
 ***************************************************************************/

 define('IN_LOGIN', true);
define("IN_PHPBB", true);


 // General Information
 $title     = 'CBACK CrackerTracker Professional';
 $version   = '4.1.7';
 $rootpath  = './../';
 $phpbb_root_path = $rootpath;


 // Load Configuration
 include($rootpath . "extension.inc");
 include($rootpath . "config." . $phpEx);
 include($rootpath . "includes/db." . $phpEx);
 
// Database Connect
 @$sql = mysql_connect($dbhost, $dbuser, $dbpasswd)
   or die("<b>CBACK Setup System</b><br><br>Critical Error: Database connection failed.");

 @mysql_select_db($dbname)
   or die("<b>CBACK Setup System</b><br><br>Critical Error: Selected Database doesn't exists.");

 $sql = "SELECT *
	FROM " . $table_prefix . "ctrack";

 if(!($result = $db->sql_query($sql)))
 {
	die("Currently there is no CBACK CrackerTracker v4.x on your Webspace. Please use install.php instead!<br><br>
    	 Momentan befindet sich keine CBACK CrackerTracker Version 4.x auf Deinem Webspace. Bitte benutze die Datei
         install.php um die Datenbankänderungen auszuführen!");
 }

 while ( $row = $db->sql_fetchrow($result) )
 {
   $ctracker_config[$row['name']] = $row['value'];
 }

 // SQL Scheme
 $sql = array();
switch ($ctracker_config['version'])
{
	case '4.0.0':
	case '4.0.1':
	case '4.0.2':
	   $sql[] = "CREATE TABLE ".$table_prefix."ct_viskey (
				   confirm_id char(32) NOT NULL default '',
				   session_id char(32) NOT NULL default '',
				   code char(6) NOT NULL default '',
				   PRIMARY KEY  (session_id,confirm_id)) TYPE=MyISAM;";
	   $sql[] = "INSERT INTO ".$table_prefix."ctrack (name, value) VALUES ('mailfeature', '1');";
	   $sql[] = "INSERT INTO ".$table_prefix."ctrack (name, value) VALUES ('pwreset', '1');";
	   $sql[] = "INSERT INTO ".$table_prefix."ctrack (name, value) VALUES ('loginfeature', '1');";
	   $sql[] = "ALTER TABLE ".$table_prefix."users ADD ct_mailcount INT( 10 ) NOT NULL AFTER user_newpasswd;";
	   $sql[] = "ALTER TABLE ".$table_prefix."users ADD ct_pwreset INT( 2 ) NOT NULL AFTER user_newpasswd;";
	   $sql[] = "ALTER TABLE ".$table_prefix."users ADD ct_unsucclogin INT( 10 ) DEFAULT NULL AFTER user_newpasswd;";
	case '4.1.0':
	   $sql[] = "ALTER TABLE ".$table_prefix."users ADD ct_logintry INT( 2 ) DEFAULT 0 AFTER user_newpasswd;";
	case '4.1.1':
	case '4.1.2':
	case '4.1.3':
	case '4.1.4':
	case '4.1.5':
	case '4.1.6':
	default:
	   $sql[] = "UPDATE ".$table_prefix."ctrack SET value = '" . $version . "' WHERE name = 'version';";
	break;
 }


?>

<html>
  	    <head>
        <title>CBACK Database Update System</title>
        </head>
        <body bgcolor="#70A5CC">
        <center>
          <table border="1" width="800px" cellspacing="0">
            <tr>
              <td width="100%" valign="top" bgcolor="#ffffff">

                <img src="http://www.community.cback.de/uplink/cdus_head.jpg" border="0"><br>
                <br>
                <center>
                  <table border="0" height="100%" width="94%" cellspacing="0">
                    <tr height="100%">
                    <td align="left">
                    <div align="right"><font face="Tahoma" color="orange" size="5"><b><?php echo $title; ?></b> <?php echo $version; ?> Setup</font></div><br><br>

                    <font face="Verdana" color="#000000" size="3">
                    Welcome to the automatic <a href="http://www.cback.de" target="_blank">CBACK</a> Database Update System for <?php echo $title; ?> v<?php echo $version; ?>.
                    This Setup Script is performing all needed Database changes to your Forum while you're reading this Text.
					<br><br><br><b>Database Operation:</b><br><br><ul>
<?php

  // Lets do the Database Changes
  for( $i = 0; $i < count($sql); $i++ )
  {

    if(!$result = mysql_query ($sql[$i]) )
	{
		echo '<li><font face="Arial" color="#FF0000" size="2"><b>[ ERROR ]</b></font> <font face="Arial" color="#808080" size="2">' . $sql[$i] . '</font></li><br />';
	}
	else
	{
		echo '<li><font face="Arial" color="#00AA00" size="2"><b>[ OK ]</b></font> <font face="Arial" color="#808080" size="2">' . $sql[$i] . '</font></li><br />';
	}
  }

?>
                    </ul><font face="Verdana" color="#000000" size="3"><br><br>
                    Everything is done now completely! Please <b>delete this file</b> from your Webspace now!<br><br>
                    <br><br><br>
                    </font>
					<br /><br /><h4><a href="./index.php" target="_self">[  next step  ]</a><h4>
                    </td>
                    </tr>
                  </table>
                </center>
                <br><img src="http://www.community.cback.de/uplink/cdus_foot.jpg" border="0">
              </td>
            </tr>
          </table>
        </center>
        </body>
        </html>


<?php

  // Datenbankverbindung trennen
  @mysql_close($sql);

?>
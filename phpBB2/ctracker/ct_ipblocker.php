<?php
/***************************************************************************
 *                             ct_ipblocker.php
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

if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}
  //
  // Loading CTracker Configuration from the Database
  //
	if( !defined('CCache') || $_GET['mode'] == 'register')
	{
	  $sql = "SELECT *
		FROM " . CTRACK;

	  if (defined('CCache'))
	  			$sql .= " WHERE name IN ('lastreg', 'lastreg_ip')";

	  if( !($result = $db->sql_query($sql)) )
	  {
		message_die(CRITICAL_ERROR, "Could not query CBACK CrackerTracker config information", "", __LINE__, __FILE__, $sql);
	  }
	  while ( $row = $db->sql_fetchrow($result) )
	  {
		$ctracker_config[$row['name']] = $row['value'];
	  }
	}
  //
  // CTracker IP and Agent blocker
  //
  $ctb_remotead = $client_ip;
  $ctb_agent    = $HTTP_SERVER_VARS['HTTP_USER_AGENT'];

  if(!empty($ctb_remotead) && !empty($ctb_agent) && $ctracker_config['filter'] == 1)
  {
	$cache_proxy = $phpbb_root_path . 'cache/ct_proxylist.'.$phpEx;

	if (@file_exists($cache_proxy))
	{
		@include($cache_proxy);
	}

	if (!$proxy_list)
	{
		$use_cache = (is_writable($phpbb_root_path . '/cache')) ? true : false;

		$write_string = "<?php \n if ( !defined('IN_PHPBB') ) \n { \n die('Hacking attempt'); \n } \n".'$proxy_list = array(';

		$sql = "SELECT list
		  FROM " . CTFILTER;
		if( !($result = $db->sql_query($sql)) )
		{
		  message_die(CRITICAL_ERROR, "Could not query CBACK CTracker ProxyBlocker information", "", __LINE__, __FILE__, $sql);
		}

		if (!$use_cache) {
			$proxy_list = array();
			// NO cache
			while ( $row = $db->sql_fetchrow($result) )
			{
				$proxy_list[] = $row['list'];
			}
		} else {
			// cache
			while ( $row = $db->sql_fetchrow($result) )
			{
				$write_string .= "'". addslashes($row['list']) ."', \n ";
			}

			$write_string .= "); \n".'?>';

			if(@$f = fopen($cache_proxy, 'w')) 
			{ 
				fwrite($f, $write_string); 
				fclose($f); 
				@chmod($cache_proxy, 0666); 
			}
			include($cache_proxy); 
		}
    }

	while ( list($p_list) = @each($proxy_list) )
    {
	  if(stripslashes($p_list) == $ctb_remotead || stripslashes($p_list) == $ctb_agent)
      {
        //
        // Collecting information about the Attack and the Attacker
        //
        $ctl_pmeld    = 1;
        $ctl_stamp    = time();
        $ctl_remotead = $HTTP_SERVER_VARS['REMOTE_ADDR'];
        $ctl_referrer = $HTTP_SERVER_VARS['HTTP_REFERER'];
        $ctl_agent    = $HTTP_SERVER_VARS['HTTP_USER_AGENT'];
		$ctl_agent    = str_replace('||', ' ', $ctl_agent); // Remove || from User Agents

        //
        // Now we built the Line for the Logfile
        //
        $ctr_logfile  = $ctl_pmeld . '||' . $ctl_stamp . '||' . $ctl_remotead . '||' . $ctl_referrer . '||' . $ctl_agent;

        //
        // How many entrys are into the Logfile and how much entrys (default 100) are allowed?
        // I hardcoded this value because I won't contact the Database during an attack. ;)
        //
        $ctr_logsize  = count(file($phpbb_root_path . "ctracker/logs/logfile_proxy.txt"));
        $ctr_maxlogs  = $ctracker_config['proxylog'];

        //
        // Now logging and Counting. The Counter here is asymmetric so just if CTracker has to delete the Log
        // it writes something to the Counter. This is better because during an DoS Like attack we only have to
        // do one file operation. Into the footer the Counter will also count how many entrys are in the log
        // so the Counter-Value is always correct.
        //
        if ($ctr_logsize > $ctr_maxlogs)
        {
          $clog = @fopen($phpbb_root_path . "ctracker/logs/logfile_proxy.txt", "a") or die("Could not open Logfile.");
          @ftruncate($clog, '0');
          @fwrite($clog, "0||" . $ctl_stamp . "||SYSTEM MESSAGE||AUTOMATIC LOG FILE RESET||-||CRACKERTRACKER\n" . $ctr_logfile . "\n");
          @fclose($clog);

          //
          // Because we deleted the Logfile we will now write our new value for the Counter.
          //
          $ct_counter_val = 0;
          $countername    = $phpbb_root_path . "ctracker/logs/counter.txt";
          $ct_counter_val = @file_get_contents($countername);

          $ct_counter_val = $ct_counter_val + $ctr_maxlogs;

          $cfp = @fopen ($countername, 'a') or die("Could not open Counter File.");
          @ftruncate($cfp, '0');
          @fwrite($cfp, $ct_counter_val);
          @fclose($cfp);
        }
        else
        {
          $clog = @fopen($phpbb_root_path . 'ctracker/logs/logfile_proxy.txt', 'a') or die("Could not open Logfile.");
          @fwrite($clog, $ctr_logfile . "\n");
          @fclose($clog);
        }

        //
        // Output a warning message and stop the script
        //
        die("<br><hr width=\"40%\" align=\"left\"><font color=\"#FF0F0F\" face=\"Verdana\" size=\"5\"><b>- SECURITY ALERT -</b></font><hr width=\"40%\" align=\"left\">
    	     <font color=\"#000000\" face=\"Verdana\" size=\"2\"><br>The CBACK CrackerTracker Security System detected,
             that you are<br>using a blocked IP Adress or a Proxy Server to watch this site
             or<br>you are Using Harvester or Spider Tools or the Admin blocked your<br>User Agent.<br><br>
             So your access to this site has been blocked.
             <br></font>
             <br><hr width=\"40%\" align=\"left\"><font color=\"#6B6B6B\" face=\"Verdana\" size=\"3\"><b>CBACK CrackerTracker v4</b></font>");
      }
    }
   unset($write_string, $proxy_list, $p_list, $cache_proxy, $use_cache);
  }

  //
  // Response Var for System-Check
  //
  $cresponse300 = 'cbackctr';
  unset($db->password);

?>
<?php
	
	/** 
	 * @file wAstats.php
	 * @brief Gathers statistics on the visitors.
	 * @update 2012-01-18 14:25:00 (Wed Jan 18, 2012 at 2:25 PM)
	 * @author Paolo Rovelli
	 **/
	
	
	
	//Includes:
	require_once("./webAdmin-stats/wAs-includes/functions.inc.php");
	require_once("./webAdmin-stats/wAs-includes/widgets.inc.php");
	require_once("./webAdmin-stats/wAs-includes/classes/user.class.php");
	
	
	//User's data:
	$user = new Visitor;

	
	/* BEGIN Gathers statistics: */
	$db = connectToDB();
	
	if ( $db != null ) {
		/* BEGIN delete old visits: */
		$query = "DELETE FROM was_visits WHERE ( DATE(time)<DATE(NOW()) ) OR ( DATE(time)=DATE(NOW()) AND HOUR(NOW())-HOUR(time)>'2' ) OR ( DATE(time)=DATE(NOW()) AND ( HOUR(NOW())-HOUR(time)='2' AND MINUTE(NOW())>=MINUTE(time) ) )";  // delete the access out of the last 2 hours...
		$recset = mysql_query($query, $db);
		//if ( $recset == null ) {...}  // problems to MySQL DB
		/* END delete old visits. */

		
		if ( $user->getBrowser("family") != "bot" && $user->getBrowser("family") != "app" ) {  // it is a real browser!
			//Looks for an access from the same user (IP address + Operating System):
			$query = "SELECT ip, os FROM was_visits WHERE ip='".$user->getHost("IP")."' AND os='".$user->getOS("name")."'";  // AND browser='".$user->getBrowser("name")."'
			$recset = mysql_query($query, $db);
			
			if ( $recset != null ) {
				$numrec = mysql_num_rows($recset);  // number of access with the same IP address and Operating System
				
				if ( $numrec == 0 ) {  // no access with the same IP address and Operating System
					/* BEGIN Update OSs counter: */
					$query = "SELECT counter FROM was_oss WHERE name='".$user->getOS("name")."' AND family='".$user->getOS("family")."'";  // select the counter number of the visitor's OSs
					$recset = mysql_query($query, $db);
					
					if ( $recset != null ) {
						$numrec = mysql_num_rows($recset);  // number of OSs selected (theorically, only 0 or 1)
						
						if ( $numrec == 0 ) {  // no OS selected!
						 	//Save the new Operating System information:
							$query = "INSERT INTO was_oss SET name='".$user->getOS("name")."', family='".$user->getOS("family")."', kernel='".$user->getOS("kernel")."', counter='1'";  // insert the new OS info...
							$recset = mysql_query($query, $db);
							//if ( $recset == null ) {...}  // problems to MySQL DB
							
						}
						else {  // $numrec != 0  // the OS exists...
							$osCounter = mysql_result($recset, 0, 'counter');
							$osCounter++;
							
							//Update the OS counter:
							$query = "UPDATE was_oss SET counter='$osCounter' WHERE name='".$user->getOS("name")."' AND family='".$user->getOS("family")."'";  // update the OS counter...
							$recset = mysql_query($query, $db);
							//if ( $recset == null ) {...}  // problems to MySQL DB
						}
					}
					//else {...}  // $recset == null  // problems to MySQL DB
					/* END Update OSs counter. */

					
					/* BEGIN Update browsers counter: */
					$query = "SELECT counter FROM was_browsers WHERE name='".$user->getBrowser("name")."' AND family='".$user->getBrowser("family")."'";  // select the counter number of the visitor's browsers
					$recset = mysql_query($query, $db);
					
					if ( $recset != null ) {
						$numrec = mysql_num_rows($recset);  // number of browsers selected (theorically, only 0 or 1)
						
						if ( $numrec == 0 ) {  // no browser selected!
						 	//Save the new browser information:
							$query = "INSERT INTO was_browsers SET name='".$user->getBrowser("name")."', family='".$user->getBrowser("family")."', engine='".$user->getBrowser("engine")."', counter='1'";  // insert the new browser info...
							$recset = mysql_query($query, $db);
							//if ( $recset == null ) {...}  // problems to MySQL DB
						}
						else {  // $numrec != 0  // the browser exists...
							$browserCounter = mysql_result($recset, 0, 'counter');
							$browserCounter++;
							
							//Update the browser counter:
							$query = "UPDATE was_browsers SET counter='$browserCounter' WHERE name='".$user->getBrowser("name")."' AND family='".$user->getBrowser("family")."'";  // update the browser counter...
							$recset = mysql_query($query, $db);
							//if ( $recset == null ) {...}  // problems to MySQL DB
						}
					}
					//else {...}  // $recset == null  // problems to MySQL DB
					/* END Update browsers counter. */
					

					/* BEGIN Update languages counter: */
					$query = "SELECT counter FROM was_languages WHERE language='".$user->getLanguage("language")."'";  // select the counter number of the visitor's languages
					$recset = mysql_query($query, $db);
					
					if ( $recset != null ) {
						$numrec = mysql_num_rows($recset);  // number of languages selected (theorically, only 0 or 1)
						
						if ( $numrec == 0 ) {  // no language selected!
						 	//Save the new language information:
							$query = "INSERT INTO was_languages SET language='".$user->getLanguage("language")."', abbreviation='".$user->getLanguage("abbreviation")."', counter='1'";  // insert the new language info...
							$recset = mysql_query($query, $db);
							//if ( $recset == null ) {...}  // problems to MySQL DB
						}
						else {  // $numrec != 0  // the browser exists...
							$browserCounter = mysql_result($recset, 0, 'counter');
							$browserCounter++;
							
							//Update the language counter:
							$query = "UPDATE was_languages SET counter='$browserCounter' WHERE language='".$user->getLanguage("language")."'";  // update the language counter...
							$recset = mysql_query($query, $db);
							//if ( $recset == null ) {...}  // problems to MySQL DB
						}
					}
					//else {...}  // $recset == null  // problems to MySQL DB
					/* END Update languages counter. */

					
					/* BEGIN Save the new visitor's information: */
					$query = "INSERT INTO was_visits SET ip='".$user->getHost("IP")."', os='".$user->getOS("name")."', browser='".$user->getBrowser("name")."', language='".$user->getLanguage("language")."', host='".$user->getHost("hostname")."', port='".$user->getHost("port")."', time=NOW()";  // insert the new visitor info...
					$recset = mysql_query($query, $db);
					//if ( $recset == null ) {...}  // problems to MySQL DB
					/* END Save the new visitor's information. */
				}
				else {  // $numrec != 0  // update the visit of the user (IP address + Operating System)
					$query = "UPDATE was_visits SET time=NOW(), browser='".$user->getBrowser("name")."', language='".$user->getLanguage("language")."', port='".$user->getHost("port")."' WHERE ip='".$user->getHost("IP")."' AND os='".$user->getOS("name")."'";  // AND browser='".$user->getBrowser("name")."'  // update the visitor info...
					$recset = mysql_query($query, $db);
					//if ( $recset == null ) {...}  // problems to MySQL DB
				}
			}  // $recset != null
		}  // $user->getBrowser("family") != "bot" && $user->getBrowser("family") != "app"
		/* END visits control. */
		
		
		/*
		 * Using mysql_close() isn't usually necessary, as non-persistent open links are automatically closed at the end of the script's execution.
		 * Thanks to the reference-counting system introduced with PHP 4's Zend Engine, a resource with no more references to it is detected automatically, and it is freed by the garbage collector.
		 */
		//disconnectFromDB($db);
	}  // $db != null
	/* END Gathers statistics. */
	
?>

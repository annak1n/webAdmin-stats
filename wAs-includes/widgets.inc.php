<?php 
	
	/** 
	 * @file widget.inc.php
	 * @brief Widget functions declaration.
	 * @update 2012-01-19 11:24:00 (Thu Jan 19, 2012 at 11:24 AM)
	 * @author Paolo Rovelli
	 **/
	
	
	
	//Includes:
	require_once("./webAdmin-stats/wAs-includes/functions.inc.php");
	
	
	
	/** 
	 * Print the user's Operating System information (HTML formatted).
	 * 
	 * @param $user  the visitor (object).
	 * @author Paolo Rovelli
	 **/
	function wAs_userOS($user) {
		//Output:
		print "<p class='wAs-userOS'>\n";
		print "\t<strong>Operation System:</strong><br />\n";
		print "\t".$user->getOS("name")."<br />\n";
		print "\t".$user->getOS("kernel")."\n";
		print "</p>\n";
	}
	
	
	
	/** 
	 * Print the user's browser information (HTML formatted).
	 * 
	 * @param $user  the visitor (object).
	 * @author Paolo Rovelli
	 **/
	function wAs_userBrowser($user) {
		//Output:
		print "<p class='wAs-userBrowser'>\n";
		print "\t<strong>Browser:</strong><br />\n";
		print "\t".$user->getBrowser("name")."<br />\n";
		print "\t".$user->getBrowser("engine")."<br />\n";
		print "\t<noscript>[JavaScript is disabled]</noscript>\n";
		print "</p>\n";
	}
	
	
	
	/** 
	 * Print the user's language information (HTML formatted).
	 * 
	 * @param $user  the visitor (object).
	 * @author Paolo Rovelli
	 **/
	function wAs_userLanguage($user) {
		//Output:
		print "<p class='wAs-userLanguage'>\n";
		print "\t<strong>Language:</strong><br />\n";
		print "\t".$user->getLanguage("language")."\n";
		print "</p>\n";
	}
	
	
	
	/** 
	 * Print the user's host information (HTML formatted).
	 * 
	 * @param $user  the visitor (object).
	 * @author Paolo Rovelli
	 **/
	function wAs_userHost($user) {
		//Output:
		print "<p class='wAs-userHost'>\n";
		print "\t<strong>Host:</strong><br />\n";
		print "\t".$user->getHost("hostname")."<br />\n";
		print "\t".$user->getHost("IP")."<br />\n";
		print "\t".$user->getHost("port")."\n";
		print "</p>\n";
	}
	
	
	
	/** 
	 * Print all the user's information (HTML formatted).
	 * 
	 * @param $user  the visitor (object).
	 * @author Paolo Rovelli
	 **/
	function wAs_userInfo($user) {
		//Output:
		print "<div class='wAs-userInfo'>\n";
		print "<h2>USER'S DATA</h2>\n";
		wAs_userOS($user);
		wAs_userBrowser($user);
		wAs_userLanguage($user);
		wAs_userHost($user);
		print "</div>\n";
	}
	
	
	
	/** 
	 * Print the visitors' Operating Systems statistics.
	 * 
	 * @author Paolo Rovelli
	 **/
	function wAs_visitorsOSs() {
		$db = connectToDB();
		
		if ( $db != null ) {
			/* BEGIN visitors' OSs statistics: */
			$query = "SELECT SUM(counter) AS numVisits FROM was_oss WHERE name != 'unknown'";  // select the sum of the counters of the OSs visits
			$recset = mysql_query($query,$db);
			
			if ( $recset != null ) {
				$osNumVisits = mysql_result($recset, 0, 'numVisits');  // the total number of OSs visits
				
				//Select the counters of the OS families:
				$query = "SELECT family, SUM(counter) AS counter FROM was_oss WHERE name != 'unknown' GROUP BY family ORDER BY counter DESC, family ASC";
				$recset = mysql_query($query,$db);
				
				if ( $recset != null ) {
					$numrec = mysql_num_rows($recset);  // number of (different) OSs
					
					if ( $numrec > 0 ) {
						print "<div class='wAs-visitorsStats'>\n";
							print "<h2>Visitors' OS<span style='text-transform: lowercase;'>s</span></h2>\n";
							print "<ul>\n";

								for($i=0; $i < $numrec; $i++) {
									//OS data:
									$visitorsOS = mysql_fetch_array($recset, MYSQL_ASSOC);
									
									//$id = $visitorsOS['id'];  									// mysql_result($recset, $i, 'id')
									//$osName = $visitorsOS['name'];  								// mysql_result($recset, $i, 'name')
									$osFamily = $visitorsOS['family'];  							// mysql_result($recset, $i, 'family')
									//$osCounter = $visitorsOS['counter'];  						// mysql_result($recset, $i, 'counter')
									$osCounter = bcdiv($visitorsOS['counter']*100,$osNumVisits,2);  // ($visitorsOS['counter']/$osNumVisits)*100
									
									//OS image:
									//$osImg = "./webAdmin-stats/wAs-includes/images/icon".str_replace(' ', '', $osFamily).".jpg";
									

									switch ( $osFamily ) {
										case "Apple OS X":
												$osFamily = "Apple OS X / iOS";
											break;
										
										case "BlackBerry":
												$osFamily = "BlackBerry OS";
											break;
										
										case "Mandriva":
												$osFamily = "Mandriva Linux";
											break;
										
										case "Red Hat":
												$osFamily = "Red Hat Linux / Fedora";
											break;
										
										case "SuSE":
												$osFamily = "SuSE Linux / openSuSE";
											break;
										
										//Generic OSs:
										case "BSD":
												$osFamily = "Other BSD OSs";
											break;
										
										case "Linux":
												$osFamily = "Other Linux OSs";
											break;
										
										case "Unix":
												$osFamily = "Other Unix-like OSs";
											break;
										
										case "unknown":
												$osFamily = "Other OSs";
											break;
									}

									
									//Print the counter of the OS family:
									print "<li><div class='wAs-counter'>~$osCounter%</div><div class='wAs-name'>$osFamily: </div></li>\n";
								}
							print "</ul>\n";
						print "</div>\n";  // class='wAs-visitorsStats'
					}  // $numrec > 0
				}
				//else {...}  // $recset == null  // problems to MySQL DB
			}  // $recset != null
			/* END visitors' OSs statistics. */
			

			/*
			 * Using mysql_close() isn't usually necessary, as non-persistent open links are automatically closed at the end of the script's execution.
			 * Thanks to the reference-counting system introduced with PHP 4's Zend Engine, a resource with no more references to it is detected automatically, and it is freed by the garbage collector.
			 */
			//disconnectFromDB($db);
		}  // $db != null
	}
	
	
	
	/** 
	 * Print the visitors' browsers statistics.
	 * 
	 * @author Paolo Rovelli
	 **/
	function wAs_visitorsBrowsers() {
		$db = connectToDB();
		
		if ( $db != null ) {
			/* BEGIN visitors' browsers statistics: */
			$query = "SELECT SUM(counter) AS numVisits FROM was_browsers WHERE name != 'unknown'";  // select the sum of the counters of the browsers visits
			$recset = mysql_query($query,$db);
			
			if ( $recset != null ) {
				$browserNumVisits = mysql_result($recset, 0, 'numVisits');  // the total number of browsers visits
				
				//Select the counters of the browser families:
				$query = "SELECT family, SUM(counter) AS counter FROM was_browsers WHERE name != 'unknown' GROUP BY family ORDER BY counter DESC, family ASC";
				$recset = mysql_query($query,$db);
				
				if ( $recset != null ) {
					$numrec = mysql_num_rows($recset);  // number of OSs
					
					if ( $numrec > 0 ) {
						print "<div class='wAs-visitorsStats'>\n";
							print "<h2>Visitors' browsers</h2>\n";
							print "<ul>\n";

								for($i=0; $i < $numrec; $i++) {
									//Browser data:
									$visitors = mysql_fetch_array($recset, MYSQL_ASSOC);
									
									//$id = $link['id'];  // mysql_result($recset, $i, 'id')
									//$browserName = $visitors['name'];  // mysql_result($recset, $i, 'name')
									$browserFamily = $visitors['family'];  // mysql_result($recset, $i, 'family')
									//$browserEngine = $visitors['engine'];  // mysql_result($recset, $i, 'engine')
									//$osCounter = $visitors['counter'];  // mysql_result($recset, $i, 'counter')
									$browserCounter = bcdiv($visitors['counter']*100,$browserNumVisits,2);  // ($visitors['counter']/$browserNumVisits)*100
									
									//Browser image:
									//$browserImg = "./webAdmin-stats/wAs-includes/images/icon".str_replace(' ', '', $browserFamily).".jpg";
									

									switch ( $browserFamily ) {
										case "Epiphany":
												$browserFamily = "Epiphany web browser";
											break;
										
										case "Google Chrome":
												$browserFamily = "Google Chrome / Android";
											break;
										
										case "Opera":
												$browserFamily = "Opera browser";
											break;
										
										//Generic browsers:
										case "Gecko":
												$browserFamily = "Other Gecko-based browsers";
											break;
										
										case "KHTML":
												$browserFamily = "Other KHTML-based browsers";
											break;
										
										case "Trident":
												$browserFamily = "Other Trident-based browsers";
											break;
										
										case "WebKit":
												$browserFamily = "Other WebKit-based browsers";
											break;
										
										case "unknown":
												$browserFamily = "Other browsers";
											break;
									}

									
									//Print the counter of the browser family:
									print "<li><div class='wAs-counter'>~$browserCounter%</div><div class='wAs-name'>$browserFamily: </div></li>\n";
								}
							print "</ul>\n";
						print "</div>\n";  // class='wAs-visitorsStats'
					}  // $numrec > 0
				}  // $recset != null
			}  // $recset != null
			/* END visitors' browsers statistics. */
			

			//disconnectFromDB($db);
			/*
			Using mysql_close() isn't usually necessary, as non-persistent open links are automatically closed at the end of the script's execution.
			Thanks to the reference-counting system introduced with PHP 4's Zend Engine, a resource with no more references to it is detected automatically, and it is freed by the garbage collector.
			*/
		}  // $db != null
	}
	
	
	
	/** 
	 * Print the visitors' languages statistics.
	 * 
	 * @author Paolo Rovelli
	 **/
	function wAs_visitorsLanguages() {
		$db = connectToDB();
		
		if ( $db != null ) {
			/* BEGIN visitors' languages statistics: */
			$query = "SELECT SUM(counter) AS numVisits FROM was_languages WHERE language != 'unknown'";  // select the sum of the counters of the language visits
			$recset = mysql_query($query,$db);
			
			if ( $recset != null ) {
				$languageNumVisits = mysql_result($recset, 0, 'numVisits');  // the total number of languages visits
				
				//Select the counters of the languages:
				$query = "SELECT language, counter FROM was_languages WHERE language != 'unknown' ORDER BY counter DESC, language ASC";
				$recset = mysql_query($query,$db);
				
				if ( $recset != null ) {
					$numrec = mysql_num_rows($recset);  // number of OSs
					
					if ( $numrec > 0 ) {
						print "<div class='wAs-visitorsStats'>\n";
							print "<h2>Visitors' languages</h2>\n";
							print "<ul>\n";

								for($i=0; $i < $numrec; $i++) {
									//Browser data:
									$visitors = mysql_fetch_array($recset, MYSQL_ASSOC);
									
									//$id = $link['id'];  // mysql_result($recset, $i, 'id')
									$language = $visitors['language'];  // mysql_result($recset, $i, 'language')
									//$languageAbbreviation = $visitors['abbreviation'];  // mysql_result($recset, $i, 'abbreviation')
									//$languageCounter = $visitors['counter'];  // mysql_result($recset, $i, 'counter')
									$languageCounter = bcdiv($visitors['counter']*100,$languageNumVisits,2);  // ($visitors['counter']/$languageNumVisits)*100
									
									//Language image:
									//$languageImg = "/webAdmin-stats/wAs-includes/images/icon".str_replace(' ', '', $language).".jpg";
									

									switch ( $language ) {
										case "unknown":
												$language = "Other languages";
											break;
									}
									

									print "<li><div class='wAs-counter'>~$languageCounter%</div><div class='wAs-name'>$language: </div></li>\n";
								}
							print "</ul>\n";
						print "</div>\n";  // class='wAs-visitorsStats'
					}  // $numrec > 0
				}  // $recset != null
			}  // $recset != null
			/* END visitors' languages statistics. */
			
			
			//disconnectFromDB($db);
			/*
			Using mysql_close() isn't usually necessary, as non-persistent open links are automatically closed at the end of the script's execution.
			Thanks to the reference-counting system introduced with PHP 4's Zend Engine, a resource with no more references to it is detected automatically, and it is freed by the garbage collector.
			*/
		}  // $db != null
	}

?>

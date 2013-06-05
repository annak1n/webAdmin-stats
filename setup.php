<?php
	
	/**
	 * @file setup.php
	 * @brief Installer of webAdmin Stats.
	 * @update 2012-01-17 23:14:00 (Tue Jan 17, 2012 at 11:14 PM)
	 * @author Paolo Rovelli
	 **/
	

	
	//Includes:
	require_once("./wAs-includes/functions.inc.php");
	include("./wAs-config.php");
	
?>
<html>
	<header>
		<title>webAdmin Stats installer</title>
		
		<!-- Begin webAdmin Stats STYLESHEETS -->
		<link rel='stylesheet' type='text/css' media='all' href='./webAdmin-stats/wAs-includes/css/style.css' />
		<!-- End webAdmin Stats STYLESHEETS -->
	</header>
	<body>
		<?php
			
			print "<h1><img src='./wAs-includes/images/webAdminStats.png' title='webAdmin Stats' alt='' style='width: 24px; height: 24px;' /> webAdmin Stats installer</h1>";
			
			//Connect to MySQL:
			$db = @mysql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD);
			
			if ( $db != null ) {
				//Create the DataBase:
				$query = "CREATE DATABASE IF NOT EXISTS ".DB_DATABASE." CHARACTER SET 'utf8'";
				$recset = mysql_query($query, $db);
				
				if ( $recset != null ) {
					// DataBase selection:
					$conn = @mysql_select_db(DB_DATABASE, $db);
					if ( $conn != false ) {
					 	/* BEGIN Create the visits table: */
						$query = "CREATE TABLE IF NOT EXISTS `was_visits` (
									  `id` int(1) NOT NULL AUTO_INCREMENT,
									  `ip` varchar(25) NOT NULL DEFAULT '',
									  `os` varchar(50) NOT NULL DEFAULT 'unknown',
									  `browser` varchar(50) NOT NULL DEFAULT 'unknown',
									  `language` varchar(25) NOT NULL DEFAULT 'unknown',
									  `host` varchar(50) NOT NULL DEFAULT '',
									  `port` int(1) NOT NULL DEFAULT '0',
									  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
									  PRIMARY KEY (`id`)
									) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='User visits at your website' AUTO_INCREMENT=1 ;";
						$recset = mysql_query($query, $db);
						
						if ( $recset != null ) {
							/* BEGIN Create the OSs table: */
							$query = "CREATE TABLE IF NOT EXISTS `was_oss` (
										  `id` int(1) NOT NULL AUTO_INCREMENT,
										  `name` varchar(50) NOT NULL DEFAULT 'unknown',
										  `family` varchar(50) NOT NULL DEFAULT 'unknown',
										  `kernel` varchar(25) NOT NULL DEFAULT 'unknown',
										  `counter` int(1) NOT NULL DEFAULT '0',
										  PRIMARY KEY (`id`)
										) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Operating Systems of your website visitors' AUTO_INCREMENT=1 ;";
							$recset = mysql_query($query, $db);
							
							if ( $recset != null ) {
								/* BEGIN Create the browsers table: */
								$query = "CREATE TABLE IF NOT EXISTS `was_browsers` (
											  `id` int(1) NOT NULL AUTO_INCREMENT,
											  `name` varchar(50) NOT NULL DEFAULT 'unknown',
											  `family` varchar(50) NOT NULL DEFAULT 'unknown',
											  `engine` varchar(25) NOT NULL DEFAULT 'unknown',
											  `counter` int(1) NOT NULL DEFAULT '0',
											  PRIMARY KEY (`id`)
											) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Browsers of your website visitors' AUTO_INCREMENT=1 ;";
								$recset = mysql_query($query, $db);
								
								if( $recset != null ) {
									/* BEGIN Create the languages table: */
									$query = "CREATE TABLE IF NOT EXISTS `was_languages` (
												  `id` int(1) NOT NULL AUTO_INCREMENT,
												  `language` varchar(25) NOT NULL DEFAULT 'unknown',
												  `abbreviation` varchar(3) NOT NULL DEFAULT 'unk',
												  `counter` int(1) NOT NULL DEFAULT '0',
												  PRIMARY KEY (`id`)
												) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Languages of your website visitors' AUTO_INCREMENT=1 ;";
									$recset = mysql_query($query, $db);
									
									if ( $recset != null ) {
										print "<p>Congratulations! Now, to start to gather statistics you need only to include in all your web pages the file: &acute;<i>/webAdmin-stats/wAstats.php</i>&acute;.</p>";
										print "<p>For more information you should read the <i>readMe</i> file.</p>";
									}
									else {  // $recset == null  // problems to MySQL DB
										/* BEGIN Warning message: */
										print "<blockquote class='errorMsg'>\n";
											print "<p><span>..:: Error ::..</span></p>\n";
											/* DEBUG messages (print them only for debugging tests): */
											//print "<p>Error n&ordm; ".mysql_errno()." : ".mysql_error()."</p>\n";
											print "<p>Control the parameters in the file <i>webAdmin-stats/wAs-config.php</i></p>\n";
											print "<p>We apologize for the inconvenience.. please try again later.</p>\n";
										print "</blockquote>\n";  // class='errorMsg'
										/* END Warning message. */
									}
									/* END Create the languages table. */
								}
								else {  // $recset == null  // problems to MySQL DB
									/* BEGIN Warning message: */
									print "<blockquote class='errorMsg'>\n";
										print "<p><span>..:: Error ::..</span></p>\n";
										/* DEBUG messages (print them only for debugging tests): */
										//print "<p>Error n&ordm; ".mysql_errno()." : ".mysql_error()."</p>\n";
										print "<p>Control the parameters in the file <i>webAdmin-stats/wAs-config.php</i></p>\n";
										print "<p>We apologize for the inconvenience.. please try again later.</p>\n";
									print "</blockquote>\n";  // class='errorMsg'
									/* END Warning message. */
								}
								/* END Create the browsers table. */
							}
							else {  // $recset == null  // problems to MySQL DB
								/* BEGIN Warning message: */
								print "<blockquote class='errorMsg'>\n";
									print "<p><span>..:: Error ::..</span></p>\n";
									/* DEBUG messages (print them only for debugging tests): */
									//print "<p>Error n&ordm; ".mysql_errno()." : ".mysql_error()."</p>\n";
									print "<p>Control the parameters in the file <i>webAdmin-stats/wAs-config.php</i></p>\n";
									print "<p>We apologize for the inconvenience.. please try again later.</p>\n";
								print "</blockquote>\n";  // class='errorMsg'
								/* END Warning message. */
							}
							/* END Create the OSs table. */
						}
						else {  // $recset == null  // problems to MySQL DB
							/* BEGIN Warning message: */
							print "<blockquote class='errorMsg'>\n";
								print "<p><span>..:: Error ::..</span></p>\n";
								/* DEBUG messages (print them only for debugging tests): */
								//print "<p>Error n&ordm; ".mysql_errno()." : ".mysql_error()."</p>\n";
								print "<p>Control the parameters in the file <i>webAdmin-stats/wAs-config.php</i></p>\n";
								print "<p>We apologize for the inconvenience.. please try again later.</p>\n";
							print "</blockquote>\n";  // class='errorMsg'
							/* END Warning message. */
						}
						/* END Create the visits table. */
					}
					else {  // $conn == false  // problems to MySQL DB
						/* BEGIN Warning message: */
						print "<blockquote class='errorMsg'>\n";
							print "<p><span>..:: Error ::..</span></p>\n";
							/* DEBUG messages (print them only for debugging tests): */
							print "<p>Doesn't find MySQL DataBase: ".DB_DATABASE."</p>\n";
							//print "<p>Error n&ordm; ".mysql_errno()." : ".mysql_error()."</p>\n";
							print "<p>Control the parameters in the file <i>webAdmin-stats/wAs-config.php</i></p>\n";
							print "<p>We apologize for the inconvenience.. please try again later.</p>\n";
						print "</blockquote>\n";  // class='errorMsg'
						/* END Warning message. */
					}
				}
				else {  // $recset == null  // problems to MySQL DB
					/* BEGIN Warning message: */
					print "<blockquote class='errorMsg'>\n";
						print "<p><span>..:: Error ::..</span></p>\n";
						/* DEBUG messages (print them only for debugging tests): */
						//print "<p>Error n&ordm; ".mysql_errno()." : ".mysql_error()."</p>\n";
						print "<p>Control the parameters in the file <i>webAdmin-stats/wAs-config.php</i></p>\n";
						print "<p>We apologize for the inconvenience.. please try again later.</p>\n";
					print "</blockquote>\n";  // class='errorMsg'
					/* END Warning message. */
				}
				
				/*
				 * Using mysql_close() isn't usually necessary, as non-persistent open links are automatically closed at the end of the script's execution.
				 * Thanks to the reference-counting system introduced with PHP 4's Zend Engine, a resource with no more references to it is detected automatically, and it is freed by the garbage collector.
				 */
				//disconnectFromDB($db);
			}
			else {  // $db == null  // problems to MySQL DB
				/* BEGIN Warning message: */
				print "<blockquote class='errorMsg'>\n";
					print "<p><span>..:: Error ::..</span></p>\n";
					/* DEBUG messages (print them only for debugging tests): */
					print "<p>Cannot connect to MySQL server: ".DB_HOST."</p>\n";
					//print "<p>Error n&ordm; ".mysql_errno()." : ".mysql_error()."</p>\n";
					print "<p>Control the parameters in the file <i>webAdmin-stats/wAs-config.php</i></p>\n";
					print "<p>We apologize for the inconvenience.. please try again later.</p>\n";
				print "</blockquote>\n";  // class='errorMsg'
				/* END Warning message. */
			}
			
			print "<h5 style='text-align: right;'>Copyright &copy; 2012 Paolo Rovelli.</h5>";
			
		?>
	</body>
</html>

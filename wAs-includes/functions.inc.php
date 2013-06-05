<?php
	
	/** 
	 * @file function.inc.php
	 * @brief Generic functions declaration.
	 * @update 2012-01-08 23:48:00 (Sun Jan 08, 2012 at 11:48 PM)
	 * @author Paolo Rovelli
	 **/
	
	
	
	/** 
	 * Include the CSS theme inside the HTML <head> tags.
	 * 
	 * @author Paolo Rovelli
	 **/
	function wAs_theme() {
		//Output:
		print "<!-- Begin webAdmin Stats STYLESHEETS -->\n";
		print "<link rel='stylesheet' type='text/css' media='all' href='./webAdmin-stats/wAs-includes/css/style.css' />\n";
		print "<!-- End webAdmin Stats STYLESHEETS -->\n";
	}
	
	
	
	/** 
	 * Connects to MySQL server and selects the DataBase.
	 * 
	 * @return the ID number of MySQL connection (if the connection has been successful) or null.
	 * @author Paolo Rovelli
	 **/
	function connectToDB() {
		require_once("./webAdmin-stats/wAs-config.php");
		
		//Connect to MySQL:
		$db = @mysql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD);
		
		if ( $db == null ) {
			/* BEGIN Warning message: */
			print "<blockquote class='errorMsg'>\n";
				print "<p><span>..:: Error ::..</span></p>\n";
				/* DEBUG messages (print them only for debugging tests): */
				//print "<p>Cannot connect to MySQL server: ".DB_HOST."</p>\n";
				//print "<p>Error n&ordm; ".mysql_errno()." : ".mysql_error()."</p>\n";
				//print "<p>Control the parameters in the file <i>webAdmin-stats/wAs-config.php</i></p>\n";
				print "<p>We apologize for the inconvenience.. please try again later.</p>\n";
			print "</blockquote>\n";  // class='msgWarning'
			/* END Warning message. */
			
			return null;  // the connection has not been successful!
		}  // $db == null
		
		/* DEBUG messages (print them only for debugging tests): */
		//print "<p>Connected to ".DB_HOST." MySQL server (ID number: $db)!</p>\n";
		
		// DataBase selection:
		$conn = @mysql_select_db(DB_DATABASE, $db);
		
		if ( $conn == false ) {
			/* BEGIN Warning message: */
			print "<blockquote class='errorMsg'>\n";
				print "<p><span>..:: Error ::..</span></p>\n";
				/* DEBUG messages (print them only for debugging tests): */
				//print "<p>Doesn't find MySQL DataBase: ".DB_DATABASE."</p>\n";
				//print "<p>Error n&ordm; ".mysql_errno()." : ".mysql_error()."</p>\n";
				//print "<p>Control the parameters in the file <i>webAdmin-stats/wAs-config.php</i></p>\n";
				print "<p>We apologize for the inconvenience.. please try again later.</p>\n";
			print "</blockquote>\n";  // class='msgWarning'
			/* END Warning message. */
			
			return null;  // the connection has not been successful!
		}  // $ris == false
		
		$conn = null;
		
		/* DEBUG messages (print them only for debugging tests): */
		//print "<p>".DB_DATABASE." MySQL DataBase has been selected!</p>\n";
		
		return $db;  // the connection has been successful!
	}
	
	
	/** 
	 * Disconnects from the MySQL server.
	 * 
	 * @param $db  the ID number of the MySQL connection
	 * @author Paolo Rovelli
	 **/
	function disconnectFromDB($db) {
		/* DEBUG messages (print them only for debugging tests): */
		//print "<p>MySQL connection (ID number: $db) has been closed!</p>\n";
		
		// MySQL close connection:
		mysql_close($db);
	}
	
?>

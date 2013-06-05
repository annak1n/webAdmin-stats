<?php
	
	/**
	 * @file config.inc.php
	 * @brief The base parameters to configure WebAdmin Stats.
	 * @update 2010-09-22 18:27:00 (Wed Sep 22, 2010 at 6:28 PM)
	 * @author Paolo Rovelli
	 * 
	 * This file is used by the `/webAdmin-stats/setup.php` file to create the appropriate MySQL tables during the installation process.
	 * It is also used by the `/webAdmin-stats/wAs-includes/function.inc.php` to establish the connection to MySQL.
	 * You can get the MySQL connection data from your web host.
	 * 
	 * You can find more information by reading the readMe file (`/webAdmin-stats/readMe`).
	 **/
	
	
	/* BEGIN MySQL connection data: */
	//MySQL hostname or IP (for local access: "localhost" or "127.0.0.1"):
	define('DB_HOST', "localhost");
	
	//MySQL database username:
	define('DB_USERNAME', "username_here");
	
	//MySQL database password:
	define('DB_PASSWORD', "password_here");
	
	//MySQL database name:
	define('DB_DATABASE', "database_name_here");
	/* END MySQL connection data. */
	
?>

<?php 
	
	/** 
	 * @file user.class.php
	 * @brief Visitor class.
	 * @update 2012-01-17 23:28:00 (Tue Jan 17, 2012 at 11:28 PM)
	 * @author Paolo Rovelli
	 **/
	
	
	
	//Includes:
	require_once("./webAdmin-stats/wAs-includes/classes/os.class.php");
	require_once("./webAdmin-stats/wAs-includes/classes/browser.class.php");
	require_once("./webAdmin-stats/wAs-includes/classes/language.class.php");
	
	
	
	/** 
	 * Visitor class.
	 * 
	 * @author Paolo Rovelli
	 **/
	class Visitor {
		//User's info:
		var $os = "";  			// user's Operating System information
		var $browser = "";  	// user's browser information
		var $language = "";  	// user's language information
		var $host = array('hostname' => "", 'IP' => "", 'port' => "");  // user's host information
		
		
		
		/** 
		 * Initialize the visitor information.
		 * 
		 * @author Paolo Rovelli
		 **/
		function Visitor() {
		 	//Operating System:
			$this->os = new OS;  				// user's Operating System information
			
			//Browser:
			$this->browser = new Browser;  		// user's browser information
			
			//Language:
			$this->language = new Language;  	// user's language
			
			//Host:
			$this->host['IP'] = $_SERVER['REMOTE_ADDR'];  					// user's IP address
			$this->host['hostname'] = gethostbyaddr( $this->host['IP'] );  	// user's host name
			$this->host['port'] = $_SERVER['REMOTE_PORT'];  				// user's connection port
		}
		
		
		
		/** 
		 * Get the user's Operating System information.
		 * 
		 * @param $info  the information to be returned ("name", "family", "kernel").
		 * @return the selected user's Operating System information.
		 * @author Paolo Rovelli
		 **/
		function getOS($info = "name") {
		 	return $this->os->getOS($info);
		}
		
		
		
		/** 
		 * Get the user's browser information.
		 * 
		 * @param $info  the information to be returned ("name", "version", "engine").
		 * @return the selected user's browser information.
		 * @author Paolo Rovelli
		 **/
		function getBrowser($info) {
			return $this->browser->getBrowser($info);
		}
		
		
		
		/** 
		 * Get the user's language information.
		 * 
		 * @param $info  the information to be returned ("language", "abbreviation").
		 * @return the selected user's language information.
		 * @author Paolo Rovelli
		 **/
		function getLanguage($info = "language") {
			return $this->language->getLanguage($info);
		}
		
		
		
		/** 
		 * Get the user's host information.
		 * 
		 * @param $info  the information to be returned ("hostname", "IP", "port").
		 * @return the selected user's host information.
		 * @author Paolo Rovelli
		 **/
		function getHost($info) {
			switch ($info) {
				case "hostname":
						return $this->host['hostname'];
					break;
				
				case "IP":
						return $this->host['IP'];
					break;
				
				case "port":
						return $this->host['port'];
					break;
			}  // $info
		}
	}
	
?>
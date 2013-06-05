<?php 
	
	/** 
	 * @file browser.class.php
	 * @brief Declaration of Browser class.
	 * @update 2012-01-19 11:36:00 (Thu Jan 19, 2012 at 11:36 AM)
	 * @author Paolo Rovelli
	 **/
		
	
	
	/** 
	 * Browser class.
	 *
	 * @author Paolo Rovelli
	 **/
	class Browser {
		var $browser = array('name' => "", 'family' => "", 'engine' => "");  // user's browser information
		
		
		
		/** 
		 * Initialize the user's browser information.
		 * 
		 * @author Paolo Rovelli
		 **/
		function Browser() {
			//Browser
			$this->browser['name'] = "unknown";  	// user's browser name
			$this->browser['family'] = "unknown";  	// user's browser family
			$this->browser['engine'] = "unknown";  	// user's browser layout engine
			
			$userAgent = (!empty($_SERVER['HTTP_USER_AGENT'])) ? strtolower($_SERVER['HTTP_USER_AGENT']) : strtolower(getenv('HTTP_USER_AGENT'));  // Contents of the HTTP User Agent string.
			

			if ( !empty($userAgent) ) {
				/* 
				 * Values of browsers array ($browserTypes):
				 * [0]: User Agent Identifier (lowercase)
				 * [1]: browser name
				 * [2]: browser family
				 * [3]: browser layout engine
				 */
				$browserTypes = array(
					array('firefox', "Mozilla Firefox", "Mozilla Firefox", "Gecko"),
					array('konqueror', "Konqueror", "Konqueror", "KHTML"),
					array('opera', "Opera browser", "Opera", "Presto"),
					//Generic browsers:
					array('presto', "Opera browser", "Opera", "Presto"),
					array('trident', "unknown", "Trident", "Trident"),  // generic browser based on Trident (MSHTML)
					array('msie', "Microsoft IE", "Microsoft IE", "Trident"),
					array('webkit', "unknown", "WebKit", "WebKit"),  // generic browser based on WebKit
					array('gecko', "unknown", "unknown", "Gecko"),  // generic browser based on Gecko
					//Other browsers:
					array('amaya', "Amaya World", "unknown", "unknown"),
					array('amigavoyager', "Amiga Voyager", "unknown", "unknown"),
					array('dillo', "Dillo", "unknown", "unknown"),
					array('elinks', "ELinks", "unknown", "Text"),
					array('ibrowse', "ibrowse", "unknown", "unknown"),
					array('lynx', "Lynx", "unknown", "Text"),
					array('lobo', "Lobo", "unknown", "Java"),
					array('hotjava', "HotJava Browser", "unknown", "Java"),
					array('netpositive', "NetPositive", "unknown", "unknown"),
					array('sputnik', "Sputnik", "KHTML", "KHTML"),
					//Generic bots:
					array('bot', "unknown", "bot", "unknown"),  // generic bot
					array('crawl', "unknown", "bot", "unknown"),  // generic crawler
					array('spider', "unknown", "bot", "unknown"),  // generic spider
					//Other bots:
					array('almaden', "IBM Almaden web crawler", "bot", "unknown"),
					array('answerbus', "AnswerBus", "bot", "unknown"),
					array('ask', "Jeeves/Teoma", "bot", "unknown"),
					array('baidu', "Baidu spider", "bot", "unknown"),  // 'baiduspider'
					array('blogpulselive', "Blog Pulse live", "bot", "unknown"),
					array('boitho', "Boitho search engine", "bot", "unknown"),
					array('ezooms', "Ezooms", "bot", "unknown"),
					array('ia_archiver', "IA archiver", "bot", "unknown"),
					array('iltrovatore-setaccio', "IlTrovatore", "bot", "unknown"),
					array('inktomi', "Inktomi", "bot", "unknown"),
					array('jaxified', "Jaxified", "bot", "unknown"),
					array('lexxebotr', "Lexxebotr", "bot", "unknown"),
					array('mediapartners-google', "Google Adsense", "bot", "unknown"),
					array('netcraftsurveyagent', "Netcraft", "bot", "unknown"),
					array('objectssearch', "Objects search", "bot", "unknown"),
					array('scooter', "AltaVista", "bot", "unknown"),
					array('scoutjet', "Scoutjet", "bot", "unknown"),
					array('slurp', "Inktomi", "bot", "unknown"),
					array('sogou', "Sogou", "bot", "unknown"),
					array('sohu-search', "Sohu search", "bot", "unknown"),
					array('teoma', "Jeeves/Teoma", "bot", "unknown"),
					array('vbseo', "vbSEO", "bot", "unknown"),
					array('w3c_validator', "W3C Validator", "bot", "unknown"),
					array('wdg_validator', "WDG Validator", "bot", "unknown"),
					array('yahoo', "Yahoo!", "bot", "unknown"),  // 'yahoo-verticalcrawler', 'yahoo! slurp', 'yahoo-mm'
					array('zyborg', "Looksmart", "bot", "unknown"),
					/*
					//Replaced by generic bot, crawler and spider:
					array('ahrefsbot', "AhrefsBot", "bot", "unknown"),
					array('bingbot', "Bing", "bot", "unknown"),
					array('comodospider', "Comodo spider", "bot", "unknown"),
					array('exabot', "Exabot", "bot", "unknown"),
					array('fast-webcrawler', "Fast AllTheWeb", "bot", "unknown"),
					array('gigabot', "Gigabot crawler", "bot", "unknown"),
					array('googlebot', "Google", "bot", "unknown"),
					array('magpie-crawler', "Magpie crawler", "bot", "unknown"),
					array('mj12bot', "MJ12", "bot", "unknown"),
					array('mlbot', "ML", "bot", "unknown"),
					array('moreoverbot', "Moreover", "bot", "unknown"),
					array('msnbot', "MSN Search", "bot", "unknown"),
					array('naverbot', "Naverbot crawler", "bot", "unknown"),
					array('omgilibot', "Omgilibot", "bot", "unknown"),
					array('openbot', "Openbot", "bot", "unknown"),
					array('purebot', "Purebot", "bot", "unknown"),
					array('psbot', "Psbot image crawler", "bot", "unknown"),
					array('seznambot', "SeznamBot", "bot", "unknown"),
					array('sitebot', "SiteBot", "bot", "unknown"),
					array('sistrix crawler', "SISTRIX", "bot", "unknown"),
					array('sosospider', "Soso spider", "bot", "unknown"),
					array('spbot', "Seoprofiler", "bot", "unknown"),
					array('surveybot', "Survey bot", "bot", "unknown"),
					array('yandexbot', "YandexBot", "bot", "unknown"),
					*/
					//Apps:
					array('google web preview', "Google Web Preview", "app", "unknown"),
					array('gravatar', "Gravatar", "app", "unknown"),
					array('liferea', "Liferea", "app", "unknown"),
					array('mshots', "WordPress", "app", "unknown"),
					array('prism', "Mozilla Prism", "app", "unknown")
				);
				

				/* 
				 * Values of Gecko browsers array ($browserGecko):
				 * [0]: User Agent Identifier (lowercase)
				 * [1]: Browser name
				 * [2]: Browser family
				 */
				$browserGecko = array(
					//Based on Firefox:
					array('fennec', "Mozilla Fennec", "Mozilla Firefox"),
					array('maemo browser', "Maemo Browser", "Gecko"),
					array('netscape', "Netscape Navigator", "Gecko"),
					array('navigator', "Netscape Navigator", "Gecko"),
					array('wyzo', "Wyzo", "Gecko"),
					array('palemoon', "Palemoon", "Gecko"),
					//Based on Gecko:
					array('amizilla', "AmiZilla", "Gecko"),
					array('beonex', "Beonex", "Gecko"),
					array('camino', "Mozilla Camino", "Gecko"),
					array('conkeror', "Conkeror", "Gecko"),
					array('galeon', "Galeon", "Gecko"),
					array('ghostzilla', "Ghostzilla", "Gecko"),
					array('gnuzilla', "GNUzilla", "Gecko"),
					array('iceape', "Iceape", "Gecko"),
					array('icecat', "GNU IceCat", "Gecko"),
					array('kazehakase', "Kazehakase", "Gecko"),
					array('k-meleon', "K-Meleon", "Gecko"),
					array('minimo', "Mozilla Minimo", "Gecko"),
					array('seamonkey', "Mozilla Seamonkey", "Mozilla Seamonkey"),
					array('songbird', "Mozilla Songbird", "Mozilla Firefox"),
					//Generic:
					array('firefox', "Mozilla Firefox", "Mozilla Firefox")
				);

				
				/* 
				 * Values of Presto browsers array ($browserPresto):
				 * [0]: User Agent Identifier (lowercase)
				 * [1]: Browser name
				 * [2]: Browser family
				 */
				$browserPresto = array(
					array('opera mini', "Opera Mini", "Opera"),
					array('opera mobi', "Opera Mobile", "Opera")
				);
				

				/* 
				 * Values of Trident (MSHTML) browsers array ($browserTrident):
				 * [0]: User Agent Identifier (lowercase)
				 * [1]: Browser name
				 * [2]: Browser family
				 */
				$browserTrident = array(
					array('america online browser', "AOL Explorer", "Trident"),
					array('aol', "AOL Explorer", "Trident"),
					array('avant browser', "Avant Browser", "Trident"),
					array('deepnet explorer', "Deepnet Explorer", "Trident"),
					array('greenbrowser', "GreenBrowser", "Trident"),
					array('maxthon', "Maxthon", "Trident"),
					array('sleipnir', "Sleipnir", "Trident"),
					array('slimbrowser', "SlimBrowser", "Trident"),
					array('msie', "Microsoft IE", "Microsoft IE")
				);
				

				/* 
				 * Values of WebKit browsers array ($browserWebKit):
				 * [0]: User Agent Identifier (lowercase)
				 * [1]: Browser name
				 * [2]: Browser family
				 */
				$browserWebKit = array(
					//Based on Chrome:
					array('comodo_dragon', "Comodo Dragon", "WebKit"),
					array('flock', "Flock", "WebKit"),
					array('rockmelt', "RockMelt", "WebKit"),
					//Based on Safari:
					array('arora', "Arora", "WebKit"),
					array('bolt', "BOLT Browser", "WebKit"),
					array('dolphin', "Dolphin Browser", "WebKit"),
					array('dooble', "Dooble", "WebKit"),
					array('dorothy', "Dorothy", "WebKit"),
					array('epiphany', "Epiphany web browser", "Epiphany"),
					array('fluid', "Fluid", "WebKit"),
					array('icab', "iCab", "WebKit"),
					array('maxthon', "Maxthon", "WebKit"),
					array('midori', "Midori", "WebKit"),
					array('omniweb', "OmniWeb", "WebKit"),
					array('rekonq', "Rekonq", "WebKit"),
					array('shiira', "Shiira", "WebKit"),
					array('silk', "Amazon Silk", "Amazon Silk"),
					array('skyfire', "Skyfire", "WebKit"),
					array('uzbl', "Uzbl", "WebKit"),
					array('webpositive', "WebPositive", "WebKit"),  // 'web+'
					//Generic:
					array('chrome', "Google Chrome", "Google Chrome"),
					array('chromium', "Chromium", "WebKit"),
					array('safari', "Apple Safari", "Apple Safari")
				);
				
				
				/* BEGIN browser detection: */
				for ($i=0; $i < count($browserTypes); $i++) {
					if ( stristr($userAgent, $browserTypes[$i][0]) ) {
						$this->browser['name'] = $browserTypes[$i][1];  	// user's browser name
						$this->browser['family'] = $browserTypes[$i][2];  	// user's browser family
						$this->browser['engine'] = $browserTypes[$i][3];  	// user's browser layout engine
						
						
						switch ( $this->browser['engine'] ) {
							case "Gecko":
									for ($j=0; $j < count($browserGecko); $j++) {
										if ( strstr($userAgent, $browserGecko[$j][0]) ) {
										 	$this->browser['name'] = $browserGecko[$j][1];
											$this->browser['family'] = $browserGecko[$j][2];
											break;
										}
									}
								break;
								
							case "Presto":
									for ($j=0; $j < count($browserPresto); $j++) {
										if ( strstr($userAgent, $browserPresto[$j][0]) ) {
										 	$this->browser['name'] = $browserPresto[$j][1];
											//$this->browser['family'] = $browserPresto[$j][2];
											break;
										}
									}
								break;
								
							case "Trident":
									for ($j=0; $j < count($browserTrident); $j++) {
										if ( strstr($userAgent, $browserTrident[$j][0]) ) {
										 	$this->browser['name'] = $browserTrident[$j][1];
											$this->browser['family'] = $browserTrident[$j][2];
											break;
										}
									}
								break;
								
							case "WebKit":
									for ($j=0; $j < count($browserWebKit); $j++) {
										if ( strstr($userAgent, $browserWebKit[$j][0]) ) {
										 	$this->browser['name'] = $browserWebKit[$j][1];
											$this->browser['family'] = $browserWebKit[$j][2];
											break;
										}
									}
									
									if ( $this->browser['name'] == "Apple Safari" && strstr($userAgent, "Android") ) {  // On Android: Android web browser!
										$this->browser['name'] = "Android web browser";
										$this->browser['family'] = "Google Chrome";
									}
								break;
						}
						
						
						break;  // exit the for loop!
					}  // stristr($userAgent, $browserTypes[$i][0])
				}
				/* END browser detection. */
			}  // !empty($userAgent)
		}
		
		
		
		/** 
		 * Get the user's browser information.
		 * 
		 * @param $info  the information to be returned ("name", "family", "engine").
		 * @return the selected user's browser information.
		 * @author Paolo Rovelli
		 **/
		function getBrowser($info = "name") {
		 	return $this->browser[$info];
		}
	}
	
?>
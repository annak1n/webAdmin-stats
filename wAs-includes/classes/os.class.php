<?php 
	
	/** 
	 * @file os.class.php
	 * @brief Declaration of OS class.
	 * @update 2012-01-20 17:45:00 (Fri Jan 20, 2012 at 5:45 PM)
	 * @author Paolo Rovelli
	 **/
	
	
	
	/** 
	 * OS class.
	 *
	 * @author Paolo Rovelli
	 **/
	class OS {
		var $os = array('OS' => "", 'family' => "", 'kernel' => "");  // user's Operating System information
				
		
		
		/** 
		 * Initialize the user's OS information.
		 * 
		 * @author Paolo Rovelli
		 **/
		function OS() {
			//Operating System:
			$this->os['name'] = "unknown";  	// user's Operating System name
			$this->os['family'] = "unknown";  	// user's Operating System family
			$this->os['kernel'] = "unknown";  	// user's Operating System kernel
			
			$userAgent = (!empty($_SERVER['HTTP_USER_AGENT'])) ? strtolower($_SERVER['HTTP_USER_AGENT']) : strtolower(getenv('HTTP_USER_AGENT'));  // Contents of the HTTP User Agent string.
			

			if ( !empty($userAgent) ) {
				/* 
				 * Values of OSs array ($osTypes):
				 * [0]: User Agent Identifier (lowercase)
				 * [1]: OS family
				 * [2]: OS name
				 * [3]: OS kernel
				 */
				$osTypes = array(
					array('win', "Microsoft Windows", "Windows", "Windows NT"),  // 'windows'
					array('android', "Android", "Android", "Linux"),
					array('blackberry', "BlackBerry", "BlackBerry OS", "unknown"),
					array('iphone', "Apple OS X", "iOS", "BSD"),
					array('ipad', "Apple OS X", "iOS", "BSD"),
					array('ipod', "Apple OS X", "iOS", "BSD"),
					array('linux', "Linux", "unknown", "Linux"),
					array('mac', "Apple OS X", "Mac OS X", "BSD"),
					array('solaris', "Oracle Solaris", "Oracle Solaris", "Unix"),
					array('symbian', "Nokia Symbian", "Symbian", "unknown"),
					//Other OSs:
					array('aix', "Unix", "AIX", "Unix"),
					array('belenix', "Unix", "BeleniX", "IllumOS"),
					array('dragonfly', "BSD", "Dragonfly BSD", "BSD"),
					array('freebsd', "BSD", "FreeBSD", "BSD"),
					array('hpux', "Unix", "HP-UX", "Unix"),
					array('hp-ux', "Unix", "HP-UX", "Unix"),
					array('jaris', "Unix", "Jaris OS", "IllumOS"),
					array('milax', "Unix", "MilaX", "IllumOS"),
					array('mot', "unknown", "Motorola", "unknown"),
					array('netbsd', "BSD", "NetBSD", "BSD"),
					array('nexenta', "Unix", "Nexenta Core Platform", "IllumOS"),
					array('nintendo wii', "Unix", "Nintendo Wii", "Unix"),
					array('nokia', "unknown", "Nokia", "unknown"),
					array('nook', "unknown", "Barnes and Noble's Nook", "unknown"),
					array('openbsd', "BSD", "OpenBSD", "BSD"),
					array('openindiana', "Unix", "OpenIndiana", "IllumOS"),
					array('os2', "OS/2", "IBM OS/2", "unknown"),
					array('palmos', "Linux", "Palm OS", "Linux"),
					array('psp', "unknown", "PlayStation Portable", "unknown"),
					array('playstation', "unknown", "PlayStation", "unknown"),
					array('sam', "Samsung", "Samsung"),  // 'samsung'
					array('schillix', "Unix", "SchilliX", "IllumOS"),
					array('siemens', "unknown", "Siemens", "unknown"),
					array('sonyericsson', "unknown", "Sony Ericsson", "unknown"),
					array('stormos', "Unix", "StormOS", "IllumOS"),
					array('webos', "Linux", "HP webOS", "Linux"),
					//Generic:
					array('bsd', "BSD", "BSD", "BSD"),
					array('illumos', "Unix", "unknown", "IllumOS"),
					array('nt', "Microsoft Windows", "Windows", "Windows NT"),
					array('sun', "Oracle Solaris", "Oracle Solaris", "Unix"),  // 'sunos'
					array('unix', "Unix", "unknown", "Unix")
				);

				
				/* 
				 * Values of Windows OSs array ($osWindows):
				 * [0]: User Agent Identifier (lowercase)
				 * [1]: Windows version
				 * [2]: Windows kernel
				 */
				$osWindows = array(
					array('phone', "Windows Phone", "Windows CE"),
					array('wp7', "Windows Phone", "Windows NT 7.0"),
					array('vista', "Windows Vista", "Windows NT 6.0"),
					array('xp', "Windows XP", "Windows NT 5.2"),
					array('mobile', "Windows Mobile", "Windows CE"),
					array('wm5', "Windows Mobile", "Windows CE"),
					array('ce 7', "Windows Phone", "Windows CE 7"),
					array('ce 6', "Windows Phone", "Windows CE 6"),
					array('ce 5', "Windows Mobile", "Windows CE 5"),
					array('ce 4', "Windows Mobile", "Windows CE 4"),
					array('ce 3', "Pocket PC", "Windows CE 3"),
					array('nt 6.2', "Windows 8", "Windows NT 6.2"),
					array('nt 6.1', "Windows 7", "Windows NT 6.1"),  // Microsoft Windows Phone
					array('nt 6.0', "Windows Vista", "Windows NT 6.0"),  // Microsoft Windows Server 2008
					array('nt 5.2', "Windows XP", "Windows NT 5.2"),  // Microsoft Windows Server 2003
					array('nt 5.1', "Windows XP", "Windows NT 5.1"),
					array('nt 5', "Windows 2000", "Windows NT 5.0"),
					array('nt 4.0', "Windows NT", "Windows NT 4.0"),
					array('nt 3.5', "Windows NT", "Windows NT 3.5"),
					array('nt 3.1', "Windows 3.1", "Windows NT 3.1"),
					array('9x 4.9', "Windows ME", "Windows 9x 4.9"),
					array('9x 4.1', "Windows 98", "Windows 9x 4.1"),
					array('9x 4.0', "Windows 95", "Windows 9x 4.0"),
					array('2008', "Windows Server 2008", "Windows NT 6.0"),
					array('2003', "Windows Server 2003", "Windows NT 5.2"),
					array('2000', "Windows 2000", "Windows NT 5.0"),
					array('me', "Windows ME", "Windows 9x 4.9"),
					array('98', "Windows 98", "Windows 9x 4.1"),
					array('95', "Windows 95", "Windows 9x 4.0"),
					array('nt', "Windows NT", "Windows NT"),
					array('ce', "Windows CE", "Windows CE")  // 'wince'
				);
				
				
				/* 
				 * Values of Android distributions array ($osAndroid):
				 * [0]: User Agent Identifier (lowercase)
				 * [1]: Android distribution
				 */
				$osAndroid = array(
					array('android 4.0', "Android Ice Cream Sandwich"),  // Android 4.0
					array('android 3', "Android Honeycomb"),  // Android 3.x
					array('android 2.3', "Android Gingerbread"),  // Android 2.3
					array('android 2.2', "Android FroYo"),  // Android 2.2
					array('android 2.1', "Android Eclair"),  // Android 2.1
					array('android 1.6', "Android Donut"),  // Android 1.6
					array('android 1.5', "Android Cupcake")  // Android 1.5
				);

				
				/* 
				 * Values of Linux distributions array ($osLinux):
				 * [0]: User Agent Identifier (lowercase)
				 * [1]: Linux distribution family
				 * [2]: Linux distribution name
				 */
				$osLinux = array(
					array('arch', "Linux", "Arch Linux"),
					array('aurora', "Linux", "Aurora"),
					array('asturix', "Linux", "Asturix"),
					array('backtrack', "Linux", "BackTrack"),
					array('baltix', "Linux", "Baltix"),
					array('beatrix', "Linux", "BeatrIX"),
					//array('bifrost', "Linux", "Bifrost"),
					array('boss', "Linux", "Bharat Operating System Solutions"),
					array('centos', "Red Hat", "CentOS"),
					array('chrome os', "Linux", "Google Chrome OS"),
					array('chromium os', "Linux", "Chromium OS"),
					array('clearos', "Linux", "ClearOS"),
					array('coyote', "Linux", "Coyote Linux"),
					array('debian', "Debian", "Debian"),
					array('dreamlinux', "Linux", "Dreamlinux"),
					array('edulinux', "Linux", "Edulinux"),
					array('elive', "Linux", "Elive"),
					array('fedora', "Red Hat", "Fedora"),
					array('finnix', "Linux", "Finnix"),
					array('gentoo', "Linux", "Gentoo Linux"),
					array('gos', "Linux", "gOS"),
					array('hpwos', "Linux", "HP webOS"),
					array('joli', "Linux", "Joli OS"),
					array('kanotix', "Linux", "Kanotix"),
					array('kindle', "Linux", "Amazon Kindle"),
					array('knoppix', "Linux", "Knoppix"),
					array('maemo', "Linux", "Maemo"),
					array('mageia', "Mandriva", "Mageia Linux"),
					array('mandriva', "Mandriva", "Mandriva Linux"),
					array('mint', "Linux", "Linux Mint"),
					array('opensuse', "SuSE", "openSuSE"),
					array('oracle', "Linux", "Oracle Linux"),
					array('peppermint', "Linux", "Peppermint OS"),
					array('poseidon', "Linux", "Poseidon Linux"),
					array('puppy', "Linux", "Puppy Linux"),
					array('redhat', "Red Hat", "Red Hat Linux"),
					array('sabayon', "Linux", "Sabayon Linux"),
					array('slackware', "Linux", "Slackware"),
					array('slax', "Linux", "Slax"),
					array('suse', "SuSE", "SuSE Linux"),
					array('symphony', "Linux", "Symphony OS"),
					array('turbolinux', "Linux", "Turbolinux"),
					array('ubuntu', "Ubuntu", "Ubuntu"),  // Kubuntu, Xubuntu, Edubuntu, ...
					array('vyatta', "Linux", "Vyatta"),
					array('xandros', "Linux", "Xandros Desktop"),
					//array('yggdrasil', "Linux", "Yggdrasil Linux"),
					array('yellow', "Linux", "Yellow Dog Linux")
				);
				
				
				/* BEGIN OS detection: */
				for ($i=0; $i < count($osTypes); $i++) {
					if ( strstr($userAgent, $osTypes[$i][0]) ) {
						$this->os['family'] = $osTypes[$i][1];  // user's Operating System family
						$this->os['name'] = $osTypes[$i][2];  	// user's Operating System name
						$this->os['kernel'] = $osTypes[$i][3];  // user's Operating System kernel
						

						switch ( $this->os['name'] ) {
							case "Android":  // $this->os['family'] == "Linux"
									for ($j=0; $j < count($osAndroid); $j++) {
										if ( strstr($userAgent, $osAndroid[$j][0]) ) {
											$this->os['name'] = $osAndroid[$j][1];
											break;
										}
									}
								break;
							
							case "Windows":  // $this->os['family'] == "Microsoft"
									for ($j=0; $j < count($osWindows); $j++) {
										if ( strstr($userAgent, $osWindows[$j][0]) ) {
										 	$this->os['name'] = $osWindows[$j][1];
										 	$this->os['kernel'] = $osWindows[$j][2];
											break;
										}
										
									}
								break;
							
							case "unknown":
									if ( $this->os['family'] == "Linux" ) {  // Linux distributions
										for ($j=0; $j < count($osLinux); $j++) {
											if ( strstr($userAgent, $osLinux[$j][0]) ) {
												$this->os['family'] = $osLinux[$j][1];
												$this->os['name'] = $osLinux[$j][2];
												break;
											}
										}
									}  // $this->os['family'] == "Linux"
								break;
						}  // $this->os['name']

						
						break;  // exit the for loop!
					}  // strstr($userAgent, $osTypes[$i][0])
				}
				/* END OS detection. */	
			}  // !empty($userAgent)
		}
		
		
		
		/** 
		 * Get the user's OS information.
		 * 
		 * @param $info  the information to be returned ("name", "family", "kernel").
		 * @return the selected user's OS information.
		 * @author Paolo Rovelli
		 **/
		function getOS($info = "name") {
		 	return $this->os[$info];
		}
	}
	
?>
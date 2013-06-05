<?php 
	
	/** 
	 * @file language.class.php
	 * @brief Declaration of Language class.
	 * @update 2012-01-19 11:36:00 (Thu Jan 19, 2012 at 11:36 AM)
	 * @author Paolo Rovelli
	 **/
		
	
	
	/** 
	 * Language class.
	 * 
	 * @author Paolo Rovelli
	 **/
	class Language {
		var $language = array('language' => "", 'abbreviation' => "");  // user's language information
		
		
		
		/** 
		 * Initialize the type of language.
		 * 
		 * @author Paolo Rovelli
		 **/
		function Language() {
			//Language:
			$this->language['language'] = "unknown";  // user's language name
			$this->language['abbreviation'] = "unk";  // user's language abbreviation
			
			$acceptLanguage = (!empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])) ? strtolower($_SERVER['HTTP_ACCEPT_LANGUAGE']) : strtolower(getenv('HTTP_ACCEPT_LANGUAGE')); // Contents of the Accept-Language: header from the current request, if there is one.
			

			if ( !empty($acceptLanguage) ) {
				/* 
				 * Values of languages array ($languageTypes):
				 * [0]: Language Identifier (lowercase)
				 * [1]: Type of language
				 */
				$languageTypes = array(
					array('aa', 'Afar'),
					array('ab', 'Abkhazian'),
					array('af', 'Afrikaans'),
					array('am', 'Amharic'),
					array('an', 'Aragonese'),
					array('ar', 'Arabic'),
					array('as', 'Assamese'),
					array('ay', 'Aymara'),
					array('az', 'Azeri'),
					array('ba', 'Bashkir'),
					array('be', 'Belarusian'),
					array('bg', 'Bulgarian'),
					array('bh', 'Bihari'),
					array('bi', 'Bislama'),
					array('bn', 'Bengali'),
					array('bo', 'Tibetan'),
					array('br', 'Breton'),
					array('ca', 'Catalan'),
					array('co', 'Corsican'),
					array('cs', 'Czech'),
					array('cy', 'Welsh'),
					array('da', 'Danish'),
					array('de', 'German'),
					array('div', 'Divehi'),
					array('dz', 'Bhutani'),
					array('el', 'Greek'),
					array('en', 'English'),
					array('eo', 'Esperanto'),
					array('es', 'Spanish'),
					array('et', 'Estonian'),
					array('eu', 'Basque'),
					array('fo', 'Faeroese'),
					array('fa', 'Farsi'),
					array('fi', 'Finnish'),
					array('fj', 'Fiji'),
					array('fr', 'French'),
					array('fy', 'Frisian'),
					array('ga', 'Irish'),
					array('gd', 'Gaelic'),
					array('gl', 'Galician'),
					array('gn', 'Guarani'),
					array('gu', 'Gujarati'),
					array('gv', 'Gaelic'),
					array('ha', 'Hausa'),
					array('he', 'Hebrew'),
					array('hi', 'Hindi'),
					array('hr', 'Croatian'),
					array('ht', 'Creole'),
					array('hu', 'Hungarian'),
					array('hy', 'Armenian'),
					array('id', 'Indonesian'),
					array('ii', 'Nuosu'),
					array('ik', 'Inupiak'),
					array('io', 'Ido'),
					array('is', 'Icelandic'),
					array('it', 'Italian'),
					array('iu', 'Inuktitut'),
					array('iw', 'Hebrew'),
					array('ja', 'Japanese'),
					array('jv', 'Javanese'),
					array('ka', 'Georgian'),
					array('kk', 'Kazakh'),
					array('kl', 'Greenlandic'),
					array('km', 'Cambodian'),
					array('kn', 'Kannada'),
					array('ko', 'Korean'),
					array('kok', 'Konkani'),
					array('ks', 'Kashmiri'),
					array('ku', 'Kurdish'),
					array('ky', 'Kirghiz'),
					array('kz', 'Kyrgyz'),
					array('la', 'Latin'),
					array('li', 'Limburgish'),
					array('ln', 'Lingala'),
					array('lo', 'Laothian'),
					array('lt', 'Lithuanian'),
					array('lv', 'Latvian'),
					array('mg', 'Malagasy'),
					array('mi', 'Maori'),
					array('mk', 'Macedonian'),
					array('ml', 'Malayalam'),
					array('mn', 'Mongolian'),
					array('mo', 'Moldavian'),
					array('mr', 'Marathi'),
					array('ms', 'Malay'),
					array('mt', 'Maltese'),
					array('my', 'Burmese'),
					array('na', 'Nauru'),
					array('ne', 'Nepali'),
					array('nl', 'Dutch'),
					array('no', 'Norwegian'),
					array('oc', 'Occitan'),
					array('om', 'Oromo'),
					array('or', 'Oriya'),
					array('pa', 'Punjabi'),
					array('pl', 'Polish'),
					array('ps', 'Pashto'),
					array('pt', 'Portuguese'),
					array('qu', 'Quechua'),
					array('rm', 'Rhaeto-Romance'),
					array('rn', 'Kirundi'),
					array('ro', 'Romanian'),
					array('ru', 'Russian'),
					array('rw', 'Kinyarwanda'),
					array('sa', 'Sanskrit'),
					array('sb', 'Sorbian'),
					array('sd', 'Sindhi'),
					array('sg', 'Sangro'),
					array('si', 'Sinhalese'),
					array('sk', 'Slovak'),
					array('sl', 'Slovenian'),
					array('sm', 'Samoan'),
					array('sn', 'Shona'),
					array('so', 'Somali'),
					array('sq', 'Albanian'),
					array('sr', 'Serbian'),
					array('ss', 'Siswati'),
					array('st', 'Sesotho'),
					array('su', 'Sundanese'),
					array('sv', 'Swedish'),
					array('sw', 'Swahili'),
					array('sx', 'Sutu'),
					array('syr', 'Syriac'),
					array('ta', 'Tamil'),
					array('te', 'Telugu'),
					array('tg', 'Tajik'),
					array('th', 'Thai'),
					array('ti', 'Tigrinya'),
					array('tk', 'Turkmen'),
					array('tl', 'Tagalog'),
					array('tn', 'Tswana'),
					array('to', 'Tonga'),
					array('tr', 'Turkish'),
					array('ts', 'Tsonga'),
					array('tt', 'Tatar'),
					array('tw', 'Twi'),
					array('ug', 'Uighur'),
					array('uk', 'Ukrainian'),
					array('ur', 'Urdu'),
					//array('us', 'English'),
					array('uz', 'Uzbek'),
					array('vi', 'Vietnamese'),
					array('vo', 'Volapük'),
					array('wa', 'Wallon'),
					array('wo', 'Wolof'),
					array('xh', 'Xhosa'),
					array('yi', 'Yiddish'),
					array('yo', 'Yoruba'),
					array('zh', 'Chinese'),
					array('zu', 'Zulu')
				);  // $languageTypes
				
				
				/* BEGIN Language detection: */
				for ($i=0; $i < count($languageTypes); $i++) {
					if ( strstr($acceptLanguage, $languageTypes[$i][0]) ) {
						$this->language['abbreviation'] = $languageTypes[$i][0];  	// user's language abbreviation
						$this->language['language'] = $languageTypes[$i][1];  		// user's language name

						break;  // exit the for loop!
					}  // strstr($languageType, $languages[$i][0])
				}
				/* END Language detection. */
			}  // !empty($acceptLanguage)
		}
		
		
		
		/** 
		 * Get the user's language information.
		 * 
		 * @param $info  the information to be returned ("language", "abbreviation").
		 * @return the selected user's language information.
		 * @author Paolo Rovelli
		 **/
		function getLanguage($info = "language") {
			return $this->language[$info];
		}
	}
	
?>
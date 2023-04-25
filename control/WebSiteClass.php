<?php
	
	/**
	 * Created by PhpStorm.
	 * User: Mohammad
	 * Date: 27/01/2016
	 * Time: 08:56 PM
	 */
	class WebSiteClass
	{
		public static function GetWebSiteURL()
		{
			return sprintf("%s://%s%s", isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http', $_SERVER['SERVER_NAME'],
			               $_SERVER['REQUEST_URI']);
		}

		public static function InitializeLocalization($Locale)
		{
			// Set language to German
			putenv('LC_ALL='.$Locale);
			setlocale(LC_ALL, $Locale);

			// Specify location of translation tables
			bindtextdomain("messages", "./locale");

			// Choose domain
			textdomain("messages");
		}
	}
<?php
	
	/**
	 * Created by PhpStorm.
	 * User: Mohammad
	 * Date: 27/01/2016
	 * Time: 12:20 PM
	 */
	class SessionClass
	{
		
		/**
		 * SessionClass constructor.
		 */
		public static function CheckSession()
		{
			if(!isset($_SESSION))
			{
				session_start();
			}
		}
		
		/**
		 * @return bool
		 */
		public static function IsLoggedIn()
		{
			return (isset($_SESSION) and isset($_SESSION[USERNAME]) and isset($_SESSION[PASSWORD]) and isset($_SESSION[ISLOGGEDIN]));
		}
		
		/**
		 *
		 */
		public static function SetSessionValues()
		{
			$_SESSION[USERNAME]   = $_POST[USERNAME];
			$_SESSION[PASSWORD]   = md5($_POST[PASSWORD]);
			$_SESSION[ISLOGGEDIN] = session_id();
		}
		
		/**
		 *
		 */
		public static function UnSetSessionValues()
		{
			// remove all session variables
			session_unset();
			
			// destroy the session
			session_destroy();
		}
	}
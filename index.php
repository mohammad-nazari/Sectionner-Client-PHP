<?php
	/**
	 * Created by JetBrains PhpStorm.
	 * User: Mohammad
	 * Date: 8/15/13
	 * Time: 5:02 PM
	 * To change this template use File | Settings | File Templates.
	 */
	error_reporting(E_ERROR & ~E_WARNING  & ~E_PARSE  & ~E_NOTICE);
	require_once('control/SessionClass.php');

	// Check session is enabled
	SessionClass::CheckSession();

	// Redirect to requested page
	require_once('control/WebSiteClass.php');

	require_once('control/definitions.php');

	// User is logged in
	if(SessionClass::IsLoggedIn())
	{
		if(isset($_GET['Req']))
		{
			// Load all pages
			require_once('control/LoadPageClass.php');
			if(!LoadPageClass::LoadPage($_GET['Req']))
			{
				// Requested page does not exist
				header('Location: ' . ALLDEVICESPAGE);
			}
		}
		else
		{
			header('Location: ' . ALLDEVICESPAGE);
		}
	}
	else
	{
		if(isset($_GET['Req']) and $_GET['Req'] == 'login')
		{
			// Load all pages
			require_once('view/login.php');
		}
		else
		{
			header('Location: ' . LOGINPAGE);
		}
	}

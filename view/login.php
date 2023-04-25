<?php
	/**
	 * Created by PhpStorm.
	 * User: mohammad
	 * Date: 1/2/2015
	 * Time: 3:58 PM
	 */
	require_once('control/DefaultObjectsClass.php');
	
	$errorMessage = "";
	// User logged in and send data to this page
	if(isset($_POST[USERNAME]) and isset($_POST[PASSWORD]))
	{
		$userName = $_POST[USERNAME];
		$passWord = $_POST[PASSWORD];
		// One or both is empty
		if($userName == "" or $passWord == "")
		{
			$errorMessage = FILLFILED;
		}
		else
		{
			// Check user and generate session info
			require_once('model/webservice/Sectionner.php');
			$protector = new webservice\Sectionner();
			if($protector->error_str)
			{
				$errorMessage = "Web service error" . $protector->error_str;
			}
			else
			{
				/*echo ("hfhfhf");
				exit(1);*/
				$result = DefaultObjectsClass::Login();
				
				if($protector->error_str)
				{
					$errorMessage = "Web service error" . $protector->error_str;
				}
				else
				{
					if($result->uErr->eMsg == "")
					{
						SessionClass::SetSessionValues();
						// Redirect to index page
						header('Location: ' . ALLDEVICESPAGE);
					}
					else
					{
						$errorMessage = "Username and/or password is incorrect";
					}
				}
			}
		}
	}
	// I18N support information here
	$locale = 'en_US';
	putenv("LC_ALL=" . $locale);
	setlocale(LC_ALL, $locale);
	
	// Set the text domain as 'messages'
	$domain = 'messages';
	bindtextdomain($domain, "locale");
	textdomain($domain);
	$pageName = _('User Login');
	require_once('view/templates/headers.php');
	require_once('view/templates/menu.php');
	require_once('view/templates/login.php');
	require_once('view/templates/footer.php');
?>
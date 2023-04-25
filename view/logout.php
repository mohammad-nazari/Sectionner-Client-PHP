<?php
	/**
	 * Created by PhpStorm.
	 * User: mohammad
	 * Date: 1/5/2015
	 * Time: 1:24 AM
	 */
	// Unset all session values
	SessionClass::UnSetSessionValues();

	// Redirect to login page
	header('Location: ' . LOGINPAGE);
?>
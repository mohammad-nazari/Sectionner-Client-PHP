<?php
	/**
	 * Created by JetBrains PhpStorm.
	 * User: Mohammad
	 * Date: 8/15/13
	 * Time: 5:02 PM
	 * To change this template use File | Settings | File Templates.
	 */
	require_once ('view/initialize.php');
	$pageName= _('Show all devices');
	$result = DefaultObjectsClass::GetAllDeviceStatus();
		
	require_once('view/templates/headers.php');
	require_once('view/templates/menu.php');
	require_once('view/templates/alldevices.php');
	require_once('view/templates/footer.php');

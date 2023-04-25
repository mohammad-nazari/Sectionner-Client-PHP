<?php
	/**
	 * Created by PhpStorm.
	 * User: Mohammad
	 * Date: 17/06/2016
	 * Time: 01:29 AM
	 */

	require_once('view/initialize.php');
	
	$userDeviceList = DefaultObjectsClass::GetUserDeviceList();
	$pageName     = _('Get and show reports');
	
	require_once('view/templates/headers.php');
	require_once('view/templates/menu.php');
	require_once('view/templates/report.php');
	require_once('view/templates/footer.php');
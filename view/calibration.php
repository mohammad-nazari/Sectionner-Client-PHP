<?php
	/**
	 * Created by PhpStorm.
	 * User: Mohammad
	 * Date: 26/06/2016
	 * Time: 11:24 AM
	 */

	require_once('view/initialize.php');

	$userDeviceList = DefaultObjectsClass::GetUserDeviceList();
	$pageName     = _('Get and set calibrations');

	require_once('view/templates/headers.php');
	require_once('view/templates/menu.php');
	require_once('view/templates/calibration.php');
	require_once('view/templates/footer.php');
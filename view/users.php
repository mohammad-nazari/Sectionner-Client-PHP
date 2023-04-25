<?php
	/**
	 * Created by PhpStorm.
	 * User: Mohammad
	 * Date: 26/07/2016
	 * Time: 11:19 AM
	 */
	
	require_once('view/initialize.php');
	
	$usersList = DefaultObjectsClass::GetUsersList();
	$pageName     = _('Edit Users');
	?>
	<script src="scripts/users.js" type="text/javascript"></script>;
<?php
	require_once('view/templates/headers.php');
	require_once('view/templates/menu.php');
	require_once('view/templates/users.php');
	require_once('view/templates/footer.php');
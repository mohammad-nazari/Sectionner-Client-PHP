<?php
	/**
	 * Created by PhpStorm.
	 * User: mohammad
	 * Date: 1/5/2015
	 * Time: 1:36 AM
	 */

	require_once("definitions.php");
	require_once("nuSOAP/lib/nusoap.php");
	require_once("webservice/Sectionner.php");

	// nuSOAP initialize
	$proxyhost     = isset($_POST['proxyhost']) ? $_POST['proxyhost'] : '';
	$proxyport     = isset($_POST['proxyport']) ? $_POST['proxyport'] : '';
	$proxyusername = isset($_POST['proxyusername']) ? $_POST['proxyusername'] : '';
	$proxypassword = isset($_POST['proxypassword']) ? $_POST['proxypassword'] : '';

	$client = new nusoap_client(WEBSERVICESERVERINFO, FALSE);
?>
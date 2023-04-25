<?php
/**
 * Created by PhpStorm.
 * User: Mohammad
 * Date: 31/01/2016
 * Time: 11:11 PM
 */
require_once('control/SessionClass.php');
require_once('control/SocketClient.php');
// Check session is enabled
SessionClass::CheckSession();

if (isset($_GET) and isset($_GET['req']))
{
	require_once('control/definitions.php');
	require_once('control/DefaultObjectsClass.php');
	require_once('control/DeviceClass.php');
	require_once('control/ReportClass.php');
	require_once('control/ChartClass.php');
	$request = $_GET['req'];
	if ($request == "all")
	{
		$result = DefaultObjectsClass::GetAllDeviceStatus();
		$deviceList = array();
		foreach ($result->udDevs as $deviceObject)
		{
			if ($deviceObject->dSerialNumber > 0 and $deviceObject->dModel != \webservice\DeviceModel::ALARM)
			{
				$device = new  DeviceClass();
				$device = ToolsClass::LoadFromParentObj($deviceObject, $device);
				$device->InitializeDevice();
				//					$device->DeleteSensorsList();
				array_push($deviceList, $device);
			}
		}
		
		/* Send to client as json*/
		echo json_encode($deviceList, 0, 1024);
		//			echo json_last_error_msg();
	}
	elseif ($request == "device" and isset($_GET['ID']))
	{
		$deviceObject = DefaultObjectsClass::GetDeviceStatus();
		
		$device = new  DeviceClass();
		$device = ToolsClass::LoadFromParentObj($deviceObject, $device);
		$device->InitializeDevice();
		
		/* Send to client as json*/
		echo json_encode($device);
	}
	elseif ($request == "sms" and isset($_GET['ID']))
	{
		$error = DefaultObjectsClass::GetDeviceStatusSms();
		
		/* Send to client as json*/
		echo json_encode($error);
	}
	elseif ($request == "relay" and
	        isset($_GET['ID']) and isset($_GET['relays']) and isset($_GET['tcp']) and isset($_GET['sms'])
	)
	{
		$relaysList = $_GET['relays'];
		$device = DefaultObjectsClass::NewDevice();
		$device->dRequests[0] = \webservice\RequestType::OUTRELAY;
		$device->dSms = $_GET['sms'];
		
		$relay = "";
		
		// List of boolean values
		for ($index = 0; $index < 32; $index++)
		{
			if (isset($relaysList[$index]))
			{
				$device->dRelays[$index] = ($relaysList[$index] == "true");
				$relay .= ($relaysList[$index] == "true")?"1":"0";
			}
			else
			{
				$device->dRelays[$index] = 0;
				$relay .= "0";
			}
		}
		
		if (strtolower($_GET['tcp']) == 'false')
		{
			// Device
			$deviceObject = DefaultObjectsClass::SetDeviceSetting($device);
			
			/* Send to client as json*/
			echo json_encode($deviceObject);
		}
		else
		{
			$clientObject = new \SocketConnSer\SocketClient($device->dSerialNumber . "," . $_SESSION[USERNAME] . "," .
			                                                $_SESSION[PASSWORD] . ",2," . $relay);
			echo json_decode("DON");
		}
	}
	elseif ($request == "settings" and isset($_GET['ID']) and
	                                   isset($_GET['nike-name']) and
	                                   isset($_GET['date-time']) and
	                                   isset($_GET['location']) and
	                                   isset($_GET['city']) and
	                                   isset($_GET['sampling']) and
	                                   isset($_GET['sms']) and
	                                   isset($_GET['x-pos']) and
	                                   isset($_GET['y-pos'])
	)
	{
		$device = new DeviceClass();
		$device->dRequests[0] = \webservice\RequestType::SAMPLING;
		//			$device->dRequests[1] = \webservice\RequestType::DATETIME;
		
		$device->dSerialNumber = $_GET['ID'];
		$device->dNikeName = $_GET['nike-name'];
		$device->dDateTime = strtotime($_GET['date-time']);
		$device->dLocation = $_GET['location'];
		$device->dCity = $_GET['city'];
		$device->dSamplingTime = $_GET['sampling'];
		$device->dSmsTerm = $_GET['sms'];
		$device->dGPS = DefaultObjectsClass::NewGPS();
		$device->dGPS->gX = $_GET['x-pos'];
		$device->dGPS->gY = $_GET['y-pos'];
		$device->dSms = FALSE;
		if (isset($_GET['power']) and
		    isset($_GET['capacity'])
		)
		{
			$device->dTransPower = $_GET['power'];
			$device->dTableCapacity = $_GET['capacity'];
		}
		$device->EncodeData();
		
		// Device
		$deviceObject = DefaultObjectsClass::SetDeviceSetting($device);
		
		/* Send to client as json*/
		echo json_encode($deviceObject);
	}
	elseif ($request == "status" and isset($_GET['tcp']) and isset($_GET['ID']))
	{
		$device = new DeviceClass();
		$device->dRequests[0] = \webservice\RequestType::STT;
		
		$device->dSerialNumber = $_GET['ID'];
		
		if (strtolower($_GET['tcp']) == 'false')
		{
			// Device
			$deviceObject = DefaultObjectsClass::SetDeviceSetting($device);
			
			/* Send to client as json*/
			echo json_encode($deviceObject);
		}
		else
		{
			$clientObject = new \SocketConnSer\SocketClient();
			$clientObject->__clientConnect($device->dSerialNumber . "," . $_SESSION[USERNAME] . "," .
			                               $_SESSION[PASSWORD] . ",11");
			echo json_decode("DON");
		}
	}
	elseif ($request == "report" and isset($_GET['ID']) and isset($_GET['start']) and isset($_GET['end']))
	{
		$deviceList = DefaultObjectsClass::NewDevice();
		$deviceList->dSerialNumber = $_GET['ID'];
		$startDateTime = strtotime($_GET['start']);
		$endDateTime = strtotime($_GET['end']);
		
		// Device
		$deviceStatusLogList = DefaultObjectsClass::GetDeviceStatusLog($startDateTime, $endDateTime, $deviceList);
		
		$reportObject = new ReportClass();
		if (count($deviceStatusLogList->dsllStatus) > 0)
		{
			$reportObject->GenerateReportCharts($deviceStatusLogList);
		}
		
		/* Send to client as json*/
		echo json_encode($reportObject);
	}
	elseif ($request == "pic" and isset($_GET['ID']))
	{
		$device = DefaultObjectsClass::NewDevice();
		$device->dSerialNumber = $_GET['ID'];
		$device->dCamera->cPort = 1;
		$device->dRequests[0] = webservice\RequestType::PICTURE;
		
		// Device
		$devicePicture = DefaultObjectsClass::GetDevicePicture($device);
		
		//if(isset($devicePicturePart->dPicture) and $devicePicturePart->dPicture->pSize > 0)
		{
			// Reset device picture image file
			$myfile = fopen("images/device/" . $device->dSerialNumber . $_SESSION[USERNAME] . ".gif", "w");
			fclose($myfile);
		}
		
		/* Send to client as json*/
		echo json_encode($devicePicture->dPicture);
	}
	elseif ($request == "part" and isset($_GET['ID']) and isset($_GET['index']))
	{
		$device = DefaultObjectsClass::NewDevice();
		$device->dSerialNumber = $_GET['ID'];
		$device->dCamera->cPort = 1;
		$device->dPicture->pParts[0] = DefaultObjectsClass::NewPicturePart();
		$device->dPicture->pParts[0]->ppIndex = $_GET['index'];
		$device->dRequests[0] = webservice\RequestType::PARTS;
		
		// Device
		$devicePicturePart = DefaultObjectsClass::GetDevicePicturePart($device);
		
		$result = FALSE;
		$resultWrite = 0;
		if (isset($devicePicturePart->dPicture->pParts->ppData) and
		    $devicePicturePart->dPicture->pParts->ppData != ""
		)
		{
			$myfile = fopen("images/device/" . $device->dSerialNumber . $_SESSION[USERNAME] . ".gif", "a");
			$resultWrite = fwrite($myfile, hex2bin($devicePicturePart->dPicture->pParts->ppData));
			fclose($myfile);
		}
		
		$result = $resultWrite > 0 ? TRUE : FALSE;
		/* Send to client as json*/
		echo json_encode($result);
	}
	elseif ($request == "getclb" and isset($_GET['ID']))
	{
		$device = DefaultObjectsClass::NewDevice();
		$device->dSerialNumber = $_GET['ID'];
		
		// Device
		$calibrationList = DefaultObjectsClass::GetDeviceCalibration($device);
		
		/* Send to client as json*/
		echo json_encode($calibrationList);
	}
	elseif ($request == "setclb" and isset($_GET['ID']) and isset($_GET['vOff']) and isset($_GET['vMin']) and
	                                                                                 isset($_GET['vMax']) and
	                                                                                 isset($_GET['vZero']) and
	                                                                                 isset($_GET['vSpan']) and
	                                                                                 isset($_GET['aOff']) and
	                                                                                 isset($_GET['aMin']) and
	                                                                                 isset($_GET['aMax']) and
	                                                                                 isset($_GET['aZero']) and
	                                                                                 isset($_GET['aSpan']) and
	                                                                                 isset($_GET['cOff']) and
	                                                                                 isset($_GET['cMin']) and
	                                                                                 isset($_GET['cMax']) and
	                                                                                 isset($_GET['cZero']) and
	                                                                                 isset($_GET['cSpan'])
	)
	{
		$device = DefaultObjectsClass::NewDevice();
		$device->dSerialNumber = $_GET['ID'];
		
		$deviceCalibration = DefaultObjectsClass::NewCalibrationList();
		
		$voltageOff = $_GET['vOff'];
		$voltageMin = $_GET['vMin'];
		$voltageMax = $_GET['vMax'];
		$voltageZero = $_GET['vZero'];
		$voltageSpan = $_GET['vSpan'];
		$ampereOff = $_GET['aOff'];
		$ampereMin = $_GET['aMin'];
		$ampereMax = $_GET['aMax'];
		$ampereZero = $_GET['aZero'];
		$ampereSpan = $_GET['aSpan'];
		$cosqOff = $_GET['cOff'];
		$cosqMin = $_GET['cMin'];
		$cosqMax = $_GET['cMax'];
		$cosqZero = $_GET['cZero'];
		$cosqSpan = $_GET['cSpan'];
		
		$counts = ChartRowsColumns["ACVOLTAGE"][0] * ChartRowsColumns["ACVOLTAGE"][1];
		for ($i = 0; $i < $counts; $i++)
		{
			$deviceCalibration->clVoltage[$i] = DefaultObjectsClass::NewCalibration();
			$deviceCalibration->clVoltage[$i]->cOffset = $voltageOff[$i];
			$deviceCalibration->clVoltage[$i]->cMin = $voltageMin[$i];
			$deviceCalibration->clVoltage[$i]->cMax = $voltageMax[$i];
			$deviceCalibration->clVoltage[$i]->cZero = $voltageZero[$i];
			$deviceCalibration->clVoltage[$i]->cSpan = $voltageSpan[$i];
		}
		$counts = ChartRowsColumns["ACAMPERE"][0] * ChartRowsColumns["ACAMPERE"][1];
		for ($i = 0; $i < $counts; $i++)
		{
			$deviceCalibration->clAmpere[$i] = DefaultObjectsClass::NewCalibration();
			$deviceCalibration->clAmpere[$i]->cOffset = $ampereOff[$i];
			$deviceCalibration->clAmpere[$i]->cMin = $ampereMin[$i];
			$deviceCalibration->clAmpere[$i]->cMax = $ampereMax[$i];
			$deviceCalibration->clAmpere[$i]->cZero = $ampereZero[$i];
			$deviceCalibration->clAmpere[$i]->cSpan = $ampereSpan[$i];
		}
		$counts = ChartRowsColumns["COSQ"][0] * ChartRowsColumns["COSQ"][1];
		for ($i = 0; $i < $counts; $i++)
		{
			$deviceCalibration->clCosq[$i] = DefaultObjectsClass::NewCalibration();
			$deviceCalibration->clCosq[$i]->cOffset = $cosqOff[$i];
			$deviceCalibration->clCosq[$i]->cMin = $cosqMin[$i];
			$deviceCalibration->clCosq[$i]->cMax = $cosqMax[$i];
			$deviceCalibration->clCosq[$i]->cZero = $cosqZero[$i];
			$deviceCalibration->clCosq[$i]->cSpan = $cosqSpan[$i];
		}
		
		// Device
		$calibrationResult = DefaultObjectsClass::SetDeviceCalibration($device, $deviceCalibration);
		
		/* Send to client as json*/
		echo json_encode($calibrationResult);
	}
	elseif ($request == "getusers")
	{
		$usersList = DefaultObjectsClass::GetUsersList();
		
		/* Send to client as json*/
		echo json_encode($usersList);
	}
	elseif ($request == "addedituser" and $_GET['userID'] != "" and isset($_GET['userID']) and
	                                                                isset($_GET['username']) and
	                                                                isset($_GET['user-password']) and
	                                                                isset($_GET['user-repassword']) and
	                                                                isset($_GET['user-first-name']) and
	                                                                isset($_GET['user-last-name']) and
	                                                                isset($_GET['user-type']) and
	                                                                isset($_GET['device-list'])
	)
	{
		$user = DefaultObjectsClass::NewUser("", "");
		$user->uId = $_GET['userID'];
		$user->uName = $_GET['username'];
		$user->uPassword = md5($_GET['user-password']);
		$user->uRePassword = md5($_GET['user-repassword']);
		$user->uFirstName = $_GET['user-first-name'];
		$user->uLastName = $_GET['user-last-name'];
		$user->uType = $_GET['user-type'];
		$selectedDevices = $_GET['device-list'];
		
		$updateUserResult =
			$user->uId > 0 ? DefaultObjectsClass::UpdateUser($user) : DefaultObjectsClass::AddUser($user);
		
		$addedDeviceResult = DefaultObjectsClass::NewErrorCode();
		$deletedDeviceResult = DefaultObjectsClass::NewErrorCode();
		
		if (isset($updateUserResult) and (!isset($updateUserResult->eMsg) or $updateUserResult->eMsg == ""))
		{
			$userDeviceList = DefaultObjectsClass::GetUserDevices($user);
			
			if (!isset($userDeviceList->udDevs))
			{
				$userDeviceList = DefaultObjectsClass::NewUserDevice();
			}
			
			$addedDevices = array();
			foreach ($selectedDevices as $deviceNo)
			{
				$isInList = FALSE;
				foreach ($userDeviceList->udDevs as $userDevice)
				{
					if ($userDevice->dSerialNumber == $deviceNo)
					{
						$isInList = TRUE;
						break;
					}
				}
				if ($isInList == FALSE)
				{
					$device = DefaultObjectsClass::NewDevice();
					$device->dSerialNumber = $deviceNo;
					array_push($addedDevices, $device);
				}
			}
			
			$deletedDevices = array();
			foreach ($userDeviceList->udDevs as $userDevice)
			{
				$isInList = FALSE;
				foreach ($selectedDevices as $deviceNo)
				{
					if ($userDevice->dSerialNumber == $deviceNo)
					{
						$isInList = TRUE;
						break;
					}
				}
				if ($isInList == FALSE)
				{
					array_push($deletedDevices, $userDevice);
				}
			}
			
			$userDevices = DefaultObjectsClass::NewUserDeviceList($user, $addedDevices);
			$addedDeviceResult = DefaultObjectsClass::AssignDeviceToUser($userDevices);
			
			$userDevices = DefaultObjectsClass::NewUserDeviceList($user, $deletedDevices);
			$deletedDeviceResult = DefaultObjectsClass::DeleteDeviceFromUser($userDevices);
		}
		
		echo json_encode(array($updateUserResult, $addedDeviceResult, $deletedDeviceResult));
	}
	elseif ($request == "getuserdevice" and isset($_GET['userID']) and isset($_GET['userName']))
	{
		$user = DefaultObjectsClass::NewUser("", "");
		$user->uId = $_GET['userID'];
		$user->uName = $_GET['userName'];
		
		$userDeviceList = NULL;
		if ($user->uId > 0)
		{
			$userDeviceList = DefaultObjectsClass::GetUserDevices($user);
		}
		
		$userDevices = array();
		$allDeviceList = DefaultObjectsClass::GetUserDeviceList();
		foreach ($allDeviceList->udDevs as $aDevice)
		{
			$userDevice = new DeviceClass();
			$userDevice = ToolsClass::LoadFromParentObj($aDevice, $userDevice);
			$userDevice->DecodeData();
			$userDevice->dUser = $allDeviceList->udUser->uId;
			if (isset($userDeviceList) and isset($userDeviceList->udDevs))
			{
				if (is_array($userDeviceList->udDevs))
				{
					foreach ($userDeviceList->udDevs as $device)
					{
						if ($device->dSerialNumber == $aDevice->dSerialNumber)
						{
							$userDevice->dUser = $user->uId;
							break;
						}
					}
				}
				elseif (is_object($userDeviceList->udDevs))
				{
					if ($userDeviceList->udDevs->dSerialNumber == $aDevice->dSerialNumber)
					{
						$userDevice->dUser = $user->uId;
					}
				}
			}
			array_push($userDevices, $userDevice);
		}
		/* Send to client as json*/
		echo json_encode($userDevices);
	}
	elseif ($request == "deleteuser" and isset($_GET['userID']) and isset($_GET['userName']))
	{
		$user = DefaultObjectsClass::NewUser("", "");
		$user->uId = $_GET['userID'];
		$user->uName = $_GET['userName'];
		
		$userDeleted = DefaultObjectsClass::DeleteUser($user);
		
		/* Send to client as json*/
		echo json_encode($userDeleted);
	}
}
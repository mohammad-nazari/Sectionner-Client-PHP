<?php
	use \webservice as webservice;
	
	/**
	 * Created by PhpStorm.
	 * User: Mohammad
	 * Date: 27/01/2016
	 * Time: 12:28 PM
	 */
	require_once('model/webservice/Sectionner.php');
	
	class DefaultObjectsClass
	{
		public static function NewDateTime()
		{
			//return new DateTime('now');
			$dateTime = new DateTime('now');

			return $dateTime->format('Y-m-d H:i:s');
		}
		
		public static function NewErrorCode()
		{
			return new webservice\ErrorCode(0, "", webservice\SettingLevel::Normal);
		}
		
		public static function NewIP()
		{
			return new webservice\IP(0, 0, 0, 0);
		}
		
		public static function NewCamera()
		{
			return new webservice\Camera(0, self::NewIP(), 0, self::NewErrorCode());
		}
		
		public static function NewPicturePart()
		{
			return new webservice\PicturePart(0, "", 0);
		}
		
		public static function NewPicture()
		{
			return new webservice\Picture("", 0, 0, 0, 0, array());
		}
		
		public static function NewGPS()
		{
			return new webservice\GPS(0, 0);
		}
		
		public static function NewSensorExtension()
		{
			return new webservice\SensorExtension(webservice\SensorName::ACAMPERE, array());
		}
		
		public static function NewSensor()
		{
			return new webservice\Sensor("", 0, 0, 0, webservice\SensorType::Mono, self::NewErrorCode());
		}
		
		public static function NewDevice()
		{
			return new webservice\Device((isset($_GET) and isset($_GET['ID'])) ? $_GET['ID'] : 0, webservice\DeviceModel::MANAGER, "", "", "", "", 0, "", self::NewIP(), 0, self::NewDateTime(), self::NewDateTime(),
			                             self::NewCamera(), self::NewGPS(), array(), 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, "", self::NewPicture(), "", array(), array(), array(),0,false, self::NewDateTime(), self::NewErrorCode());
		}
		
		public static function NewUser($UserName, $PassWord)
		{
			return new webservice\User(0, $UserName, $PassWord, "", "", "", webservice\UserType::Monitor, "", self::NewErrorCode());
		}
		
		public static function NewDeviceStatus($StartDateTime, $EndDateTime, $DeviceList)
		{
			return new webservice\DeviceStatus(self::NewReportRange($StartDateTime, $EndDateTime), $DeviceList, array());
		}
		
		public static function NewReportRange($StartDateTime, $EndDateTime)
		{
			return new webservice\ReportRange($StartDateTime, $EndDateTime);
		}
		
		public static function NewUserDevice()
		{
			return new \webservice\UserDevice(self::NewUser($_SESSION[USERNAME], $_SESSION[PASSWORD]), array(), self::NewErrorCode());
		}
		
		public static function NewDeviceStatusLogList()
		{
			return new \webservice\DeviceStatusLogList(array(), self::NewErrorCode());
		}
		
		public static function NewDeviceStatusLog()
		{
			return new \webservice\DeviceStatusLog(self::NewDateTime(), self::NewDevice(), self::NewErrorCode());
		}
		
		public static function NewCalibration()
		{
			return new \webservice\Calibration(0, 0, 0, 0, 0);
		}
		
		public static function NewCalibrationList()
		{
			return new \webservice\CalibrationList(array(), array(), array(), self::NewErrorCode());
		}
		
		public static function NewUserDeviceList($User, $DevicesList)
		{
			return new \webservice\UserDevice($User, $DevicesList, self::NewErrorCode());
		}
		
		public static function GetAllDeviceStatus()
		{
			// Fetch data from server web service
			$protector = new \webservice\Sectionner();
			return $protector->GetAllDeviceStatus(new webservice\GetAllDeviceStatus(self::NewUser($_SESSION[USERNAME], $_SESSION[PASSWORD])));
		}
		
		public static function GetDeviceStatus()
		{
			// Fetch data from server web service
			$protector = new \webservice\Sectionner();
			
			return $protector->GetDeviceStatus(new webservice\GetDeviceStatus(self::NewUser($_SESSION[USERNAME], $_SESSION[PASSWORD]), self::NewDevice()));
		}
		
		public static function GetDeviceStatusSms()
		{
			// Fetch data from server web service
			$protector = new \webservice\Sectionner();
			
			return $protector->GetDeviceStatusSMS(new webservice\GetDeviceStatusSMS(self::NewUser($_SESSION[USERNAME], $_SESSION[PASSWORD]), self::NewDevice()));
		}
		
		public static function SetDeviceSetting($Device)
		{
			// Fetch data from server web service
			$protector = new \webservice\Sectionner();
			
			return $protector->SetDeviceSetting(new webservice\SetDeviceSetting(self::NewUser($_SESSION[USERNAME], $_SESSION[PASSWORD]), $Device));
		}
		
		public static function GetDeviceStatusLog($StartDateTime, $EndDateTime, $DeviceList)
		{
			// Fetch data from server web service
			$protector = new \webservice\Sectionner();
			
			return $protector->GetDeviceStatusLog(new webservice\GetDeviceStatusLog(self::NewUser($_SESSION[USERNAME], $_SESSION[PASSWORD]),
			                                                                        self::NewDeviceStatus($StartDateTime, $EndDateTime, $DeviceList)));
		}
		
		public static function Login()
		{
			// Fetch data from server web service
			$protector = new \webservice\Sectionner();
			
			return $protector->Login(new webservice\Login(self::NewUser($_POST[USERNAME], md5($_POST[PASSWORD]))));
		}
		
		public static function GetUserDeviceList()
		{
			// Fetch data from server web service
			$protector = new \webservice\Sectionner();
			
			return $protector->GetUserDeviceList(new webservice\GetUserDeviceList(self::NewUser($_SESSION[USERNAME], $_SESSION[PASSWORD])));
		}
		
		public static function GetUserDevices($User)
		{
			// Fetch data from server web service
			$protector = new \webservice\Sectionner();
			
			return $protector->GetUserDevices(new webservice\GetUserDevices(self::NewUser($_SESSION[USERNAME], $_SESSION[PASSWORD]), $User));
		}
		
		public static function GetDevicePicture($Device)
		{
			// Fetch data from server web service
			$protector = new \webservice\Sectionner();
			
			return $protector->GetDevicePicture(new webservice\GetDevicePicture(self::NewUser($_SESSION[USERNAME], $_SESSION[PASSWORD]), $Device));
		}
		
		public static function GetDevicePicturePart($Device)
		{
			// Fetch data from server web service
			$protector = new \webservice\Sectionner();
			
			return $protector->GetDevicePicturePart(new webservice\GetDevicePicturePart(self::NewUser($_SESSION[USERNAME], $_SESSION[PASSWORD]), $Device));
		}
		
		public static function GetDeviceCalibration($Device)
		{
			// Fetch data from server web service
			$protector = new \webservice\Sectionner();
			
			return $protector->GetDeviceCalibration(new webservice\GetDeviceCalibration(self::NewUser($_SESSION[USERNAME], $_SESSION[PASSWORD]), $Device));
		}
		
		public static function SetDeviceCalibration($Device, $CalibrationList)
		{
			// Fetch data from server web service
			$protector = new \webservice\Sectionner();
			
			return $protector->SetDeviceCalibration(new webservice\SetDeviceCalibration(self::NewUser($_SESSION[USERNAME], $_SESSION[PASSWORD]), $Device, $CalibrationList));
		}
		
		public static function GetUsersList()
		{
			// Fetch data from server web service
			$protector = new \webservice\Sectionner();
			
			return $protector->GetUsersList(new webservice\GetUsersList(self::NewUser($_SESSION[USERNAME], $_SESSION[PASSWORD])));
		}
		
		public static function AddUser($User)
		{
			// Fetch data from server web service
			$protector = new \webservice\Sectionner();
			
			return $protector->AddUser(new webservice\AddUser(self::NewUser($_SESSION[USERNAME], $_SESSION[PASSWORD]), $User));
		}
		
		public static function UpdateUser($User)
		{
			// Fetch data from server web service
			$protector = new \webservice\Sectionner();
			
			return $protector->UpdateUser(new webservice\UpdateUser(self::NewUser($_SESSION[USERNAME], $_SESSION[PASSWORD]), $User));
		}
		
		public static function DeleteUser($User)
		{
			// Fetch data from server web service
			$protector = new \webservice\Sectionner();
			
			return $protector->DeleteUser(new webservice\DeleteUser(self::NewUser($_SESSION[USERNAME], $_SESSION[PASSWORD]), $User));
		}
		
		public static function AssignDeviceToUser($UserDevice)
		{
			// Fetch data from server web service
			$protector = new \webservice\Sectionner();
			
			return $protector->AssignDeviceToUser(new webservice\AssignDeviceToUser(self::NewUser($_SESSION[USERNAME], $_SESSION[PASSWORD]), $UserDevice));
		}
		
		public static function DeleteDeviceFromUser($UserDevice)
		{
			// Fetch data from server web service
			$protector = new \webservice\Sectionner();
			
			return $protector->DeleteDeviceFromUser(new webservice\DeleteDeviceFromUser(self::NewUser($_SESSION[USERNAME], $_SESSION[PASSWORD]), $UserDevice));
		}
	}
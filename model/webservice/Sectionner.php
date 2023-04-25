<?php

namespace webservice;

include_once('SettingLevel.php');
include_once('UserType.php');
include_once('SensorType.php');
include_once('SensorName.php');
include_once('DeviceModel.php');
include_once('RequestType.php');
include_once('IP.php');
include_once('GPS.php');
include_once('Calibration.php');
include_once('Sensor.php');
include_once('SensorExtension.php');
include_once('Camera.php');
include_once('PicturePart.php');
include_once('Picture.php');
include_once('ReportRange.php');
include_once('ActivityLog.php');
include_once('UserLog.php');
include_once('DeviceStatusLog.php');
include_once('DeviceStatus.php');
include_once('ErrorLog.php');
include_once('DataBase.php');
include_once('CityLocation.php');
include_once('GetDeviceStatus.php');
include_once('Device.php');
include_once('GetDeviceStatusSMS.php');
include_once('ErrorCode.php');
include_once('GetAllDeviceStatus.php');
include_once('UserDevice.php');
include_once('GetDevicePicture.php');
include_once('GetDevicePicturePart.php');
include_once('SetDeviceSetting.php');
include_once('SetDeviceSettingResponse.php');
include_once('SetDeviceSettingSMS.php');
include_once('SetAllDeviceSetting.php');
include_once('SetAllDeviceSettingResponse.php');
include_once('DeleteDevices.php');
include_once('DeleteDevicesResponse.php');
include_once('SetDeviceCalibration.php');
include_once('GetDeviceCalibration.php');
include_once('CalibrationList.php');
include_once('Login.php');
include_once('User.php');
include_once('GetUserDeviceList.php');
include_once('GetUsersList.php');
include_once('UsersList.php');
include_once('AddUser.php');
include_once('UpdateUser.php');
include_once('DeleteUser.php');
include_once('AssignDeviceToUser.php');
include_once('DeleteDeviceFromUser.php');
include_once('GetUserDevices.php');
include_once('SaveActivityLog.php');
include_once('GetActivityLog.php');
include_once('GetActivityLogResponse.php');
include_once('SaveUserLog.php');
include_once('GetUserLog.php');
include_once('GetUserLogResponse.php');
include_once('SaveDeviceStatusLog.php');
include_once('GetDeviceStatusLog.php');
include_once('DeviceStatusLogList.php');
include_once('GetServerOptions.php');
include_once('ServerOptions.php');
include_once('SetServerOptions.php');
include_once('GetCityAndLocations.php');
include_once('AllCityLocatoins.php');
include_once('ChangeCityName.php');
include_once('ChangeLocationName.php');
include_once('ChangeDeviceName.php');


/**
 * Generate web service for sectionner system
 */
class Sectionner extends \SoapClient
{

    /**
     * @var array $classmap The defined classes
     * @access private
     */
    private static $classmap = array(
      'IP' => 'webservice\IP',
      'GPS' => 'webservice\GPS',
      'Calibration' => 'webservice\Calibration',
      'Sensor' => 'webservice\Sensor',
      'SensorExtension' => 'webservice\SensorExtension',
      'Camera' => 'webservice\Camera',
      'PicturePart' => 'webservice\PicturePart',
      'Picture' => 'webservice\Picture',
      'ReportRange' => 'webservice\ReportRange',
      'ActivityLog' => 'webservice\ActivityLog',
      'UserLog' => 'webservice\UserLog',
      'DeviceStatusLog' => 'webservice\DeviceStatusLog',
      'DeviceStatus' => 'webservice\DeviceStatus',
      'ErrorLog' => 'webservice\ErrorLog',
      'DataBase' => 'webservice\DataBase',
      'CityLocation' => 'webservice\CityLocation',
      'GetDeviceStatus' => 'webservice\GetDeviceStatus',
      'Device' => 'webservice\Device',
      'GetDeviceStatusSMS' => 'webservice\GetDeviceStatusSMS',
      'ErrorCode' => 'webservice\ErrorCode',
      'GetAllDeviceStatus' => 'webservice\GetAllDeviceStatus',
      'UserDevice' => 'webservice\UserDevice',
      'GetDevicePicture' => 'webservice\GetDevicePicture',
      'GetDevicePicturePart' => 'webservice\GetDevicePicturePart',
      'SetDeviceSetting' => 'webservice\SetDeviceSetting',
      'SetDeviceSettingResponse' => 'webservice\SetDeviceSettingResponse',
      'SetDeviceSettingSMS' => 'webservice\SetDeviceSettingSMS',
      'SetAllDeviceSetting' => 'webservice\SetAllDeviceSetting',
      'SetAllDeviceSettingResponse' => 'webservice\SetAllDeviceSettingResponse',
      'DeleteDevices' => 'webservice\DeleteDevices',
      'DeleteDevicesResponse' => 'webservice\DeleteDevicesResponse',
      'SetDeviceCalibration' => 'webservice\SetDeviceCalibration',
      'GetDeviceCalibration' => 'webservice\GetDeviceCalibration',
      'CalibrationList' => 'webservice\CalibrationList',
      'Login' => 'webservice\Login',
      'User' => 'webservice\User',
      'GetUserDeviceList' => 'webservice\GetUserDeviceList',
      'GetUsersList' => 'webservice\GetUsersList',
      'UsersList' => 'webservice\UsersList',
      'AddUser' => 'webservice\AddUser',
      'UpdateUser' => 'webservice\UpdateUser',
      'DeleteUser' => 'webservice\DeleteUser',
      'AssignDeviceToUser' => 'webservice\AssignDeviceToUser',
      'DeleteDeviceFromUser' => 'webservice\DeleteDeviceFromUser',
      'GetUserDevices' => 'webservice\GetUserDevices',
      'SaveActivityLog' => 'webservice\SaveActivityLog',
      'GetActivityLog' => 'webservice\GetActivityLog',
      'GetActivityLogResponse' => 'webservice\GetActivityLogResponse',
      'SaveUserLog' => 'webservice\SaveUserLog',
      'GetUserLog' => 'webservice\GetUserLog',
      'GetUserLogResponse' => 'webservice\GetUserLogResponse',
      'SaveDeviceStatusLog' => 'webservice\SaveDeviceStatusLog',
      'GetDeviceStatusLog' => 'webservice\GetDeviceStatusLog',
      'DeviceStatusLogList' => 'webservice\DeviceStatusLogList',
      'GetServerOptions' => 'webservice\GetServerOptions',
      'ServerOptions' => 'webservice\ServerOptions',
      'SetServerOptions' => 'webservice\SetServerOptions',
      'GetCityAndLocations' => 'webservice\GetCityAndLocations',
      'AllCityLocatoins' => 'webservice\AllCityLocatoins',
      'ChangeCityName' => 'webservice\ChangeCityName',
      'ChangeLocationName' => 'webservice\ChangeLocationName',
      'ChangeDeviceName' => 'webservice\ChangeDeviceName');

    /**
     * @param array $options A array of config values
     * @param string $wsdl The wsdl file to use
     * @access public
     */
    public function __construct(array $options = array(), $wsdl = 'Sectionner.wsdl')
    {
      foreach (self::$classmap as $key => $value) {
    if (!isset($options['classmap'][$key])) {
      $options['classmap'][$key] = $value;
    }
  }
  
  parent::__construct($wsdl, $options);
    }

    /**
     * Service definition of function ns__GetDeviceStatus
     *
     * @param GetDeviceStatus $Body
     * @access public
     * @return Device
     */
    public function GetDeviceStatus(GetDeviceStatus $Body)
    {
      return $this->__soapCall('GetDeviceStatus', array($Body));
    }

    /**
     * Service definition of function ns__GetDeviceStatusSMS
     *
     * @param GetDeviceStatusSMS $Body
     * @access public
     * @return ErrorCode
     */
    public function GetDeviceStatusSMS(GetDeviceStatusSMS $Body)
    {
      return $this->__soapCall('GetDeviceStatusSMS', array($Body));
    }

    /**
     * Service definition of function ns__GetAllDeviceStatus
     *
     * @param GetAllDeviceStatus $Body
     * @access public
     * @return UserDevice
     */
    public function GetAllDeviceStatus(GetAllDeviceStatus $Body)
    {
      return $this->__soapCall('GetAllDeviceStatus', array($Body));
    }

    /**
     * Service definition of function ns__GetDevicePicture
     *
     * @param GetDevicePicture $Body
     * @access public
     * @return Device
     */
    public function GetDevicePicture(GetDevicePicture $Body)
    {
      return $this->__soapCall('GetDevicePicture', array($Body));
    }

    /**
     * Service definition of function ns__GetDevicePicturePart
     *
     * @param GetDevicePicturePart $Body
     * @access public
     * @return Device
     */
    public function GetDevicePicturePart(GetDevicePicturePart $Body)
    {
      return $this->__soapCall('GetDevicePicturePart', array($Body));
    }

    /**
     * Service definition of function ns__SetDeviceSetting
     *
     * @param SetDeviceSetting $Body
     * @access public
     * @return SetDeviceSettingResponse
     */
    public function SetDeviceSetting(SetDeviceSetting $Body)
    {
      return $this->__soapCall('SetDeviceSetting', array($Body));
    }

    /**
     * Service definition of function ns__SetDeviceSettingSMS
     *
     * @param SetDeviceSettingSMS $Body
     * @access public
     * @return ErrorCode
     */
    public function SetDeviceSettingSMS(SetDeviceSettingSMS $Body)
    {
      return $this->__soapCall('SetDeviceSettingSMS', array($Body));
    }

    /**
     * Service definition of function ns__SetAllDeviceSetting
     *
     * @param SetAllDeviceSetting $Body
     * @access public
     * @return SetAllDeviceSettingResponse
     */
    public function SetAllDeviceSetting(SetAllDeviceSetting $Body)
    {
      return $this->__soapCall('SetAllDeviceSetting', array($Body));
    }

    /**
     * Service definition of function ns__DeleteDevices
     *
     * @param DeleteDevices $Body
     * @access public
     * @return DeleteDevicesResponse
     */
    public function DeleteDevices(DeleteDevices $Body)
    {
      return $this->__soapCall('DeleteDevices', array($Body));
    }

    /**
     * Service definition of function ns__SetDeviceCalibration
     *
     * @param SetDeviceCalibration $Body
     * @access public
     * @return ErrorCode
     */
    public function SetDeviceCalibration(SetDeviceCalibration $Body)
    {
      return $this->__soapCall('SetDeviceCalibration', array($Body));
    }

    /**
     * Service definition of function ns__GetDeviceCalibration
     *
     * @param GetDeviceCalibration $Body
     * @access public
     * @return CalibrationList
     */
    public function GetDeviceCalibration(GetDeviceCalibration $Body)
    {
      return $this->__soapCall('GetDeviceCalibration', array($Body));
    }

    /**
     * Service definition of function ns__Login
     *
     * @param Login $Body
     * @access public
     * @return User
     */
    public function Login(Login $Body)
    {
      return $this->__soapCall('Login', array($Body));
    }

    /**
     * Service definition of function ns__GetUserDeviceList
     *
     * @param GetUserDeviceList $Body
     * @access public
     * @return UserDevice
     */
    public function GetUserDeviceList(GetUserDeviceList $Body)
    {
      return $this->__soapCall('GetUserDeviceList', array($Body));
    }

    /**
     * Service definition of function ns__GetUsersList
     *
     * @param GetUsersList $Body
     * @access public
     * @return UsersList
     */
    public function GetUsersList(GetUsersList $Body)
    {
      return $this->__soapCall('GetUsersList', array($Body));
    }

    /**
     * Service definition of function ns__AddUser
     *
     * @param AddUser $Body
     * @access public
     * @return ErrorCode
     */
    public function AddUser(AddUser $Body)
    {
      return $this->__soapCall('AddUser', array($Body));
    }

    /**
     * Service definition of function ns__UpdateUser
     *
     * @param UpdateUser $Body
     * @access public
     * @return ErrorCode
     */
    public function UpdateUser(UpdateUser $Body)
    {
      return $this->__soapCall('UpdateUser', array($Body));
    }

    /**
     * Service definition of function ns__DeleteUser
     *
     * @param DeleteUser $Body
     * @access public
     * @return ErrorCode
     */
    public function DeleteUser(DeleteUser $Body)
    {
      return $this->__soapCall('DeleteUser', array($Body));
    }

    /**
     * Service definition of function ns__AssignDeviceToUser
     *
     * @param AssignDeviceToUser $Body
     * @access public
     * @return ErrorCode
     */
    public function AssignDeviceToUser(AssignDeviceToUser $Body)
    {
      return $this->__soapCall('AssignDeviceToUser', array($Body));
    }

    /**
     * Service definition of function ns__DeleteDeviceFromUser
     *
     * @param DeleteDeviceFromUser $Body
     * @access public
     * @return ErrorCode
     */
    public function DeleteDeviceFromUser(DeleteDeviceFromUser $Body)
    {
      return $this->__soapCall('DeleteDeviceFromUser', array($Body));
    }

    /**
     * Service definition of function ns__GetUserDevices
     *
     * @param GetUserDevices $Body
     * @access public
     * @return UserDevice
     */
    public function GetUserDevices(GetUserDevices $Body)
    {
      return $this->__soapCall('GetUserDevices', array($Body));
    }

    /**
     * Service definition of function ns__SaveActivityLog
     *
     * @param SaveActivityLog $Body
     * @access public
     * @return ErrorCode
     */
    public function SaveActivityLog(SaveActivityLog $Body)
    {
      return $this->__soapCall('SaveActivityLog', array($Body));
    }

    /**
     * Service definition of function ns__GetActivityLog
     *
     * @param GetActivityLog $Body
     * @access public
     * @return GetActivityLogResponse
     */
    public function GetActivityLog(GetActivityLog $Body)
    {
      return $this->__soapCall('GetActivityLog', array($Body));
    }

    /**
     * Service definition of function ns__SaveUserLog
     *
     * @param SaveUserLog $Body
     * @access public
     * @return ErrorCode
     */
    public function SaveUserLog(SaveUserLog $Body)
    {
      return $this->__soapCall('SaveUserLog', array($Body));
    }

    /**
     * Service definition of function ns__GetUserLog
     *
     * @param GetUserLog $Body
     * @access public
     * @return GetUserLogResponse
     */
    public function GetUserLog(GetUserLog $Body)
    {
      return $this->__soapCall('GetUserLog', array($Body));
    }

    /**
     * Service definition of function ns__SaveDeviceStatusLog
     *
     * @param SaveDeviceStatusLog $Body
     * @access public
     * @return ErrorCode
     */
    public function SaveDeviceStatusLog(SaveDeviceStatusLog $Body)
    {
      return $this->__soapCall('SaveDeviceStatusLog', array($Body));
    }

    /**
     * Service definition of function ns__GetDeviceStatusLog
     *
     * @param GetDeviceStatusLog $Body
     * @access public
     * @return DeviceStatusLogList
     */
    public function GetDeviceStatusLog(GetDeviceStatusLog $Body)
    {
      return $this->__soapCall('GetDeviceStatusLog', array($Body));
    }

    /**
     * Service definition of function ns__GetServerOptions
     *
     * @param GetServerOptions $Body
     * @access public
     * @return ServerOptions
     */
    public function GetServerOptions(GetServerOptions $Body)
    {
      return $this->__soapCall('GetServerOptions', array($Body));
    }

    /**
     * Service definition of function ns__SetServerOptions
     *
     * @param SetServerOptions $Body
     * @access public
     * @return ErrorCode
     */
    public function SetServerOptions(SetServerOptions $Body)
    {
      return $this->__soapCall('SetServerOptions', array($Body));
    }

    /**
     * Service definition of function ns__GetCityAndLocations
     *
     * @param GetCityAndLocations $Body
     * @access public
     * @return AllCityLocatoins
     */
    public function GetCityAndLocations(GetCityAndLocations $Body)
    {
      return $this->__soapCall('GetCityAndLocations', array($Body));
    }

    /**
     * Service definition of function ns__ChangeCityName
     *
     * @param ChangeCityName $Body
     * @access public
     * @return ErrorCode
     */
    public function ChangeCityName(ChangeCityName $Body)
    {
      return $this->__soapCall('ChangeCityName', array($Body));
    }

    /**
     * Service definition of function ns__ChangeLocationName
     *
     * @param ChangeLocationName $Body
     * @access public
     * @return ErrorCode
     */
    public function ChangeLocationName(ChangeLocationName $Body)
    {
      return $this->__soapCall('ChangeLocationName', array($Body));
    }

    /**
     * Service definition of function ns__ChangeDeviceName
     *
     * @param ChangeDeviceName $Body
     * @access public
     * @return ErrorCode
     */
    public function ChangeDeviceName(ChangeDeviceName $Body)
    {
      return $this->__soapCall('ChangeDeviceName', array($Body));
    }

}

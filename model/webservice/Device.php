<?php

namespace webservice;

class Device
{

    /**
     * @var int $dSerialNumber
     * @access public
     */
    public $dSerialNumber = null;

    /**
     * @var DeviceModel $dModel
     * @access public
     */
    public $dModel = null;

    /**
     * @var string $dName
     * @access public
     */
    public $dName = null;

    /**
     * @var string $dNikeName
     * @access public
     */
    public $dNikeName = null;

    /**
     * @var string $dLocation
     * @access public
     */
    public $dLocation = null;

    /**
     * @var string $dCity
     * @access public
     */
    public $dCity = null;

    /**
     * @var int $dSocket
     * @access public
     */
    public $dSocket = null;

    /**
     * @var string $dDNSAddress
     * @access public
     */
    public $dDNSAddress = null;

    /**
     * @var IP $dIP
     * @access public
     */
    public $dIP = null;

    /**
     * @var int $dPort
     * @access public
     */
    public $dPort = null;

    /**
     * @var dateTime $dDateTime
     * @access public
     */
    public $dDateTime = null;

    /**
     * @var dateTime $dDDateTime
     * @access public
     */
    public $dDDateTime = null;

    /**
     * @var Camera $dCamera
     * @access public
     */
    public $dCamera = null;

    /**
     * @var GPS $dGPS
     * @access public
     */
    public $dGPS = null;

    /**
     * @var boolean $dReset
     * @access public
     */
    public $dReset = null;

    /**
     * @var int $dSamplingTime
     * @access public
     */
    public $dSamplingTime = null;

    /**
     * @var float $dTransPower
     * @access public
     */
    public $dTransPower = null;

    /**
     * @var float $dTableCapacity
     * @access public
     */
    public $dTableCapacity = null;

    /**
     * @var float $dPOK
     * @access public
     */
    public $dPOK = null;

    /**
     * @var float $dPTotal
     * @access public
     */
    public $dPTotal = null;

    /**
     * @var float $dPR
     * @access public
     */
    public $dPR = null;

    /**
     * @var float $dPS
     * @access public
     */
    public $dPS = null;

    /**
     * @var float $dPT
     * @access public
     */
    public $dPT = null;

    /**
     * @var float $dQR
     * @access public
     */
    public $dQR = null;

    /**
     * @var float $dQS
     * @access public
     */
    public $dQS = null;

    /**
     * @var float $dQT
     * @access public
     */
    public $dQT = null;

    /**
     * @var string $dKeyName
     * @access public
     */
    public $dKeyName = null;

    /**
     * @var Picture $dPicture
     * @access public
     */
    public $dPicture = null;

    /**
     * @var string $dCustomCommand
     * @access public
     */
    public $dCustomCommand = null;

    /**
     * @var boolean[] $dRelays
     * @access public
     */
    public $dRelays = null;

    /**
     * @var RequestType[] $dRequests
     * @access public
     */
    public $dRequests = null;

    /**
     * @var SensorExtension[] $dSensors
     * @access public
     */
    public $dSensors = null;

    /**
     * @var int $dSmsTerm
     * @access public
     */
    public $dSmsTerm = null;

    /**
     * @var boolean $dSms
     * @access public
     */
    public $dSms = null;

    /**
     * @var dateTime $dSmsTime
     * @access public
     */
    public $dSmsTime = null;

    /**
     * @var ErrorCode $dErr
     * @access public
     */
    public $dErr = null;

    /**
     * @param int $dSerialNumber
     * @param DeviceModel $dModel
     * @param string $dName
     * @param string $dNikeName
     * @param string $dLocation
     * @param string $dCity
     * @param int $dSocket
     * @param string $dDNSAddress
     * @param IP $dIP
     * @param int $dPort
     * @param dateTime $dDateTime
     * @param dateTime $dDDateTime
     * @param Camera $dCamera
     * @param GPS $dGPS
     * @param boolean $dReset
     * @param int $dSamplingTime
     * @param float $dTransPower
     * @param float $dTableCapacity
     * @param float $dPOK
     * @param float $dPTotal
     * @param float $dPR
     * @param float $dPS
     * @param float $dPT
     * @param float $dQR
     * @param float $dQS
     * @param float $dQT
     * @param string $dKeyName
     * @param Picture $dPicture
     * @param string $dCustomCommand
     * @param boolean[] $dRelays
     * @param RequestType[] $dRequests
     * @param SensorExtension[] $dSensors
     * @param int $dSmsTerm
     * @param boolean $dSms
     * @param dateTime $dSmsTime
     * @param ErrorCode $dErr
     * @access public
     */
    public function __construct($dSerialNumber, $dModel, $dName, $dNikeName, $dLocation, $dCity, $dSocket, $dDNSAddress, $dIP, $dPort, $dDateTime, $dDDateTime, $dCamera, $dGPS, $dReset, $dSamplingTime, $dTransPower, $dTableCapacity, $dPOK, $dPTotal, $dPR, $dPS, $dPT, $dQR, $dQS, $dQT, $dKeyName, $dPicture, $dCustomCommand, $dRelays, $dRequests, $dSensors, $dSmsTerm, $dSms, $dSmsTime, $dErr)
    {
      $this->dSerialNumber = $dSerialNumber;
      $this->dModel = $dModel;
      $this->dName = $dName;
      $this->dNikeName = $dNikeName;
      $this->dLocation = $dLocation;
      $this->dCity = $dCity;
      $this->dSocket = $dSocket;
      $this->dDNSAddress = $dDNSAddress;
      $this->dIP = $dIP;
      $this->dPort = $dPort;
      $this->dDateTime = $dDateTime;
      $this->dDDateTime = $dDDateTime;
      $this->dCamera = $dCamera;
      $this->dGPS = $dGPS;
      $this->dReset = $dReset;
      $this->dSamplingTime = $dSamplingTime;
      $this->dTransPower = $dTransPower;
      $this->dTableCapacity = $dTableCapacity;
      $this->dPOK = $dPOK;
      $this->dPTotal = $dPTotal;
      $this->dPR = $dPR;
      $this->dPS = $dPS;
      $this->dPT = $dPT;
      $this->dQR = $dQR;
      $this->dQS = $dQS;
      $this->dQT = $dQT;
      $this->dKeyName = $dKeyName;
      $this->dPicture = $dPicture;
      $this->dCustomCommand = $dCustomCommand;
      $this->dRelays = $dRelays;
      $this->dRequests = $dRequests;
      $this->dSensors = $dSensors;
      $this->dSmsTerm = $dSmsTerm;
      $this->dSms = $dSms;
      $this->dSmsTime = $dSmsTime;
      $this->dErr = $dErr;
    }

}

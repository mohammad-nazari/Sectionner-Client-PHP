<?php

namespace webservice;

class ChangeDeviceName
{

    /**
     * @var User $requestUser
     * @access public
     */
    public $requestUser = null;

    /**
     * @var int $deviceSerialNumber
     * @access public
     */
    public $deviceSerialNumber = null;

    /**
     * @var string $newCityName
     * @access public
     */
    public $newCityName = null;

    /**
     * @var string $newLocationName
     * @access public
     */
    public $newLocationName = null;

    /**
     * @var string $newDeviceName
     * @access public
     */
    public $newDeviceName = null;

    /**
     * @param User $requestUser
     * @param int $deviceSerialNumber
     * @param string $newCityName
     * @param string $newLocationName
     * @param string $newDeviceName
     * @access public
     */
    public function __construct($requestUser, $deviceSerialNumber, $newCityName, $newLocationName, $newDeviceName)
    {
      $this->requestUser = $requestUser;
      $this->deviceSerialNumber = $deviceSerialNumber;
      $this->newCityName = $newCityName;
      $this->newLocationName = $newLocationName;
      $this->newDeviceName = $newDeviceName;
    }

}

<?php

namespace webservice;

class SetDeviceCalibration
{

    /**
     * @var User $requestUser
     * @access public
     */
    public $requestUser = null;

    /**
     * @var Device $requestDevice
     * @access public
     */
    public $requestDevice = null;

    /**
     * @var CalibrationList $requestCalibrationList
     * @access public
     */
    public $requestCalibrationList = null;

    /**
     * @param User $requestUser
     * @param Device $requestDevice
     * @param CalibrationList $requestCalibrationList
     * @access public
     */
    public function __construct($requestUser, $requestDevice, $requestCalibrationList)
    {
      $this->requestUser = $requestUser;
      $this->requestDevice = $requestDevice;
      $this->requestCalibrationList = $requestCalibrationList;
    }

}

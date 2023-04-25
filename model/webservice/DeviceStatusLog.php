<?php

namespace webservice;

class DeviceStatusLog
{

    /**
     * @var dateTime $dslDateTime
     * @access public
     */
    public $dslDateTime = null;

    /**
     * @var Device $dslDevice
     * @access public
     */
    public $dslDevice = null;

    /**
     * @var ErrorCode $dslErr
     * @access public
     */
    public $dslErr = null;

    /**
     * @param dateTime $dslDateTime
     * @param Device $dslDevice
     * @param ErrorCode $dslErr
     * @access public
     */
    public function __construct($dslDateTime, $dslDevice, $dslErr)
    {
      $this->dslDateTime = $dslDateTime;
      $this->dslDevice = $dslDevice;
      $this->dslErr = $dslErr;
    }

}

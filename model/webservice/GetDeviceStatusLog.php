<?php

namespace webservice;

class GetDeviceStatusLog
{

    /**
     * @var User $requestUser
     * @access public
     */
    public $requestUser = null;

    /**
     * @var DeviceStatus $requestStatusLog
     * @access public
     */
    public $requestStatusLog = null;

    /**
     * @param User $requestUser
     * @param DeviceStatus $requestStatusLog
     * @access public
     */
    public function __construct($requestUser, $requestStatusLog)
    {
      $this->requestUser = $requestUser;
      $this->requestStatusLog = $requestStatusLog;
    }

}

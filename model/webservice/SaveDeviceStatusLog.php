<?php

namespace webservice;

class SaveDeviceStatusLog
{

    /**
     * @var User $requestUser
     * @access public
     */
    public $requestUser = null;

    /**
     * @var DeviceStatusLog $requestStatusLog
     * @access public
     */
    public $requestStatusLog = null;

    /**
     * @param User $requestUser
     * @param DeviceStatusLog $requestStatusLog
     * @access public
     */
    public function __construct($requestUser, $requestStatusLog)
    {
      $this->requestUser = $requestUser;
      $this->requestStatusLog = $requestStatusLog;
    }

}

<?php

namespace webservice;

class SetAllDeviceSetting
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
     * @param User $requestUser
     * @param Device $requestDevice
     * @access public
     */
    public function __construct($requestUser, $requestDevice)
    {
      $this->requestUser = $requestUser;
      $this->requestDevice = $requestDevice;
    }

}

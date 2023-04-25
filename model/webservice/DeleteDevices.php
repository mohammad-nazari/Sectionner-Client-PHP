<?php

namespace webservice;

class DeleteDevices
{

    /**
     * @var User $requestUser
     * @access public
     */
    public $requestUser = null;

    /**
     * @var Device $requestDeviceList
     * @access public
     */
    public $requestDeviceList = null;

    /**
     * @param User $requestUser
     * @param Device $requestDeviceList
     * @access public
     */
    public function __construct($requestUser, $requestDeviceList)
    {
      $this->requestUser = $requestUser;
      $this->requestDeviceList = $requestDeviceList;
    }

}

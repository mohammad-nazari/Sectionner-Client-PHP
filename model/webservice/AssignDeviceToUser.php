<?php

namespace webservice;

class AssignDeviceToUser
{

    /**
     * @var User $requestUser
     * @access public
     */
    public $requestUser = null;

    /**
     * @var UserDevice $requestUserDevice
     * @access public
     */
    public $requestUserDevice = null;

    /**
     * @param User $requestUser
     * @param UserDevice $requestUserDevice
     * @access public
     */
    public function __construct($requestUser, $requestUserDevice)
    {
      $this->requestUser = $requestUser;
      $this->requestUserDevice = $requestUserDevice;
    }

}

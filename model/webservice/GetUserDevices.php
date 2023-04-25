<?php

namespace webservice;

class GetUserDevices
{

    /**
     * @var User $requestUser
     * @access public
     */
    public $requestUser = null;

    /**
     * @var User $requestSelectedUser
     * @access public
     */
    public $requestSelectedUser = null;

    /**
     * @param User $requestUser
     * @param User $requestSelectedUser
     * @access public
     */
    public function __construct($requestUser, $requestSelectedUser)
    {
      $this->requestUser = $requestUser;
      $this->requestSelectedUser = $requestSelectedUser;
    }

}

<?php

namespace webservice;

class DeleteUser
{

    /**
     * @var User $requestUser
     * @access public
     */
    public $requestUser = null;

    /**
     * @var User $requestDeleteUser
     * @access public
     */
    public $requestDeleteUser = null;

    /**
     * @param User $requestUser
     * @param User $requestDeleteUser
     * @access public
     */
    public function __construct($requestUser, $requestDeleteUser)
    {
      $this->requestUser = $requestUser;
      $this->requestDeleteUser = $requestDeleteUser;
    }

}

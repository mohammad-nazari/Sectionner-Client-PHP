<?php

namespace webservice;

class UpdateUser
{

    /**
     * @var User $requestUser
     * @access public
     */
    public $requestUser = null;

    /**
     * @var User $requestNewUser
     * @access public
     */
    public $requestNewUser = null;

    /**
     * @param User $requestUser
     * @param User $requestNewUser
     * @access public
     */
    public function __construct($requestUser, $requestNewUser)
    {
      $this->requestUser = $requestUser;
      $this->requestNewUser = $requestNewUser;
    }

}

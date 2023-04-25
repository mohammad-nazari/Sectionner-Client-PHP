<?php

namespace webservice;

class Login
{

    /**
     * @var User $requestUser
     * @access public
     */
    public $requestUser = null;

    /**
     * @param User $requestUser
     * @access public
     */
    public function __construct($requestUser)
    {
      $this->requestUser = $requestUser;
    }

}

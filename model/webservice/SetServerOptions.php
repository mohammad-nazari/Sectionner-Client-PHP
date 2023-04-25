<?php

namespace webservice;

class SetServerOptions
{

    /**
     * @var User $requestUser
     * @access public
     */
    public $requestUser = null;

    /**
     * @var ServerOptions $serverOptions
     * @access public
     */
    public $serverOptions = null;

    /**
     * @param User $requestUser
     * @param ServerOptions $serverOptions
     * @access public
     */
    public function __construct($requestUser, $serverOptions)
    {
      $this->requestUser = $requestUser;
      $this->serverOptions = $serverOptions;
    }

}

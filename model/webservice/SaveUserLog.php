<?php

namespace webservice;

class SaveUserLog
{

    /**
     * @var User $requestUser
     * @access public
     */
    public $requestUser = null;

    /**
     * @var UserLog $requestActivityLog
     * @access public
     */
    public $requestActivityLog = null;

    /**
     * @param User $requestUser
     * @param UserLog $requestActivityLog
     * @access public
     */
    public function __construct($requestUser, $requestActivityLog)
    {
      $this->requestUser = $requestUser;
      $this->requestActivityLog = $requestActivityLog;
    }

}

<?php

namespace webservice;

class SaveActivityLog
{

    /**
     * @var User $requestUser
     * @access public
     */
    public $requestUser = null;

    /**
     * @var ActivityLog $requestActivityLog
     * @access public
     */
    public $requestActivityLog = null;

    /**
     * @param User $requestUser
     * @param ActivityLog $requestActivityLog
     * @access public
     */
    public function __construct($requestUser, $requestActivityLog)
    {
      $this->requestUser = $requestUser;
      $this->requestActivityLog = $requestActivityLog;
    }

}

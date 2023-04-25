<?php

namespace webservice;

class GetUserLogResponse
{

    /**
     * @var UserLog $responseActivityLog
     * @access public
     */
    public $responseActivityLog = null;

    /**
     * @param UserLog $responseActivityLog
     * @access public
     */
    public function __construct($responseActivityLog)
    {
      $this->responseActivityLog = $responseActivityLog;
    }

}

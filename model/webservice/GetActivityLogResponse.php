<?php

namespace webservice;

class GetActivityLogResponse
{

    /**
     * @var ActivityLog $responseActivityLog
     * @access public
     */
    public $responseActivityLog = null;

    /**
     * @param ActivityLog $responseActivityLog
     * @access public
     */
    public function __construct($responseActivityLog)
    {
      $this->responseActivityLog = $responseActivityLog;
    }

}

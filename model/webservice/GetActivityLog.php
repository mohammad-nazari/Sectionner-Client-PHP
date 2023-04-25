<?php

namespace webservice;

class GetActivityLog
{

    /**
     * @var User $requestUser
     * @access public
     */
    public $requestUser = null;

    /**
     * @var ReportRange $requestReport
     * @access public
     */
    public $requestReport = null;

    /**
     * @param User $requestUser
     * @param ReportRange $requestReport
     * @access public
     */
    public function __construct($requestUser, $requestReport)
    {
      $this->requestUser = $requestUser;
      $this->requestReport = $requestReport;
    }

}

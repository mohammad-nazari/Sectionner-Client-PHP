<?php

namespace webservice;

class ActivityLog
{

    /**
     * @var ReportRange $alRange
     * @access public
     */
    public $alRange = null;

    /**
     * @var string $alData
     * @access public
     */
    public $alData = null;

    /**
     * @var Device $alDevice
     * @access public
     */
    public $alDevice = null;

    /**
     * @var User $alUser
     * @access public
     */
    public $alUser = null;

    /**
     * @var ErrorCode $alErr
     * @access public
     */
    public $alErr = null;

    /**
     * @param ReportRange $alRange
     * @param string $alData
     * @param Device $alDevice
     * @param User $alUser
     * @param ErrorCode $alErr
     * @access public
     */
    public function __construct($alRange, $alData, $alDevice, $alUser, $alErr)
    {
      $this->alRange = $alRange;
      $this->alData = $alData;
      $this->alDevice = $alDevice;
      $this->alUser = $alUser;
      $this->alErr = $alErr;
    }

}

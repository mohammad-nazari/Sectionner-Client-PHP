<?php

namespace webservice;

class DeviceStatusLogList
{

    /**
     * @var DeviceStatusLog[] $dsllStatus
     * @access public
     */
    public $dsllStatus = null;

    /**
     * @var ErrorCode $dsllErr
     * @access public
     */
    public $dsllErr = null;

    /**
     * @param DeviceStatusLog[] $dsllStatus
     * @param ErrorCode $dsllErr
     * @access public
     */
    public function __construct($dsllStatus, $dsllErr)
    {
      $this->dsllStatus = $dsllStatus;
      $this->dsllErr = $dsllErr;
    }

}

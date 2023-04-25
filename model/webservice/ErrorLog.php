<?php

namespace webservice;

class ErrorLog
{

    /**
     * @var dateTime $elDateTime
     * @access public
     */
    public $elDateTime = null;

    /**
     * @var Device $elDevice
     * @access public
     */
    public $elDevice = null;

    /**
     * @var ErrorCode $elErr
     * @access public
     */
    public $elErr = null;

    /**
     * @param dateTime $elDateTime
     * @param Device $elDevice
     * @param ErrorCode $elErr
     * @access public
     */
    public function __construct($elDateTime, $elDevice, $elErr)
    {
      $this->elDateTime = $elDateTime;
      $this->elDevice = $elDevice;
      $this->elErr = $elErr;
    }

}

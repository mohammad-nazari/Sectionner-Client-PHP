<?php

namespace webservice;

class DeviceStatus
{

    /**
     * @var ReportRange $dsRange
     * @access public
     */
    public $dsRange = null;

    /**
     * @var Device[] $dsDevice
     * @access public
     */
    public $dsDevice = null;

    /**
     * @var string[] $dsErr
     * @access public
     */
    public $dsErr = null;

    /**
     * @param ReportRange $dsRange
     * @param Device[] $dsDevice
     * @param string[] $dsErr
     * @access public
     */
    public function __construct($dsRange, $dsDevice, $dsErr)
    {
      $this->dsRange = $dsRange;
      $this->dsDevice = $dsDevice;
      $this->dsErr = $dsErr;
    }

}

<?php

namespace webservice;

class Sensor
{

    /**
     * @var string $sNkName
     * @access public
     */
    public $sNkName = null;

    /**
     * @var float $sVal
     * @access public
     */
    public $sVal = null;

    /**
     * @var int $sMin
     * @access public
     */
    public $sMin = null;

    /**
     * @var int $sMax
     * @access public
     */
    public $sMax = null;

    /**
     * @var SensorType $sType
     * @access public
     */
    public $sType = null;

    /**
     * @var ErrorCode $sErr
     * @access public
     */
    public $sErr = null;

    /**
     * @param string $sNkName
     * @param float $sVal
     * @param int $sMin
     * @param int $sMax
     * @param SensorType $sType
     * @param ErrorCode $sErr
     * @access public
     */
    public function __construct($sNkName, $sVal, $sMin, $sMax, $sType, $sErr)
    {
      $this->sNkName = $sNkName;
      $this->sVal = $sVal;
      $this->sMin = $sMin;
      $this->sMax = $sMax;
      $this->sType = $sType;
      $this->sErr = $sErr;
    }

}

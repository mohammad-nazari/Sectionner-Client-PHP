<?php

namespace webservice;

class CalibrationList
{

    /**
     * @var Calibration[] $clVoltage
     * @access public
     */
    public $clVoltage = null;

    /**
     * @var Calibration[] $clAmpere
     * @access public
     */
    public $clAmpere = null;

    /**
     * @var Calibration[] $clCosq
     * @access public
     */
    public $clCosq = null;

    /**
     * @var ErrorCode $clErr
     * @access public
     */
    public $clErr = null;

    /**
     * @param Calibration[] $clVoltage
     * @param Calibration[] $clAmpere
     * @param Calibration[] $clCosq
     * @param ErrorCode $clErr
     * @access public
     */
    public function __construct($clVoltage, $clAmpere, $clCosq, $clErr)
    {
      $this->clVoltage = $clVoltage;
      $this->clAmpere = $clAmpere;
      $this->clCosq = $clCosq;
      $this->clErr = $clErr;
    }

}

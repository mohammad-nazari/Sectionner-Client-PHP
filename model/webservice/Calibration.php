<?php

namespace webservice;

class Calibration
{

    /**
     * @var float $cOffset
     * @access public
     */
    public $cOffset = null;

    /**
     * @var float $cZero
     * @access public
     */
    public $cZero = null;

    /**
     * @var float $cSpan
     * @access public
     */
    public $cSpan = null;

    /**
     * @var float $cMin
     * @access public
     */
    public $cMin = null;

    /**
     * @var float $cMax
     * @access public
     */
    public $cMax = null;

    /**
     * @param float $cOffset
     * @param float $cZero
     * @param float $cSpan
     * @param float $cMin
     * @param float $cMax
     * @access public
     */
    public function __construct($cOffset, $cZero, $cSpan, $cMin, $cMax)
    {
      $this->cOffset = $cOffset;
      $this->cZero = $cZero;
      $this->cSpan = $cSpan;
      $this->cMin = $cMin;
      $this->cMax = $cMax;
    }

}

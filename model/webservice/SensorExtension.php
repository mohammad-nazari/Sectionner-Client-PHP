<?php

namespace webservice;

class SensorExtension
{

    /**
     * @var SensorName $seName
     * @access public
     */
    public $seName = null;

    /**
     * @var double[] $seVal
     * @access public
     */
    public $seVal = null;

    /**
     * @param SensorName $seName
     * @param double[] $seVal
     * @access public
     */
    public function __construct($seName, $seVal)
    {
      $this->seName = $seName;
      $this->seVal = $seVal;
    }

}

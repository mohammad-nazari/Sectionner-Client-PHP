<?php

namespace webservice;

class CityLocation
{

    /**
     * @var string $clCity
     * @access public
     */
    public $clCity = null;

    /**
     * @var string[] $clLocations
     * @access public
     */
    public $clLocations = null;

    /**
     * @var ErrorCode $clErr
     * @access public
     */
    public $clErr = null;

    /**
     * @param string $clCity
     * @param string[] $clLocations
     * @param ErrorCode $clErr
     * @access public
     */
    public function __construct($clCity, $clLocations, $clErr)
    {
      $this->clCity = $clCity;
      $this->clLocations = $clLocations;
      $this->clErr = $clErr;
    }

}

<?php

namespace webservice;

class AllCityLocatoins
{

    /**
     * @var CityLocation[] $aclCityLocatoins
     * @access public
     */
    public $aclCityLocatoins = null;

    /**
     * @var ErrorCode $aclErr
     * @access public
     */
    public $aclErr = null;

    /**
     * @param CityLocation[] $aclCityLocatoins
     * @param ErrorCode $aclErr
     * @access public
     */
    public function __construct($aclCityLocatoins, $aclErr)
    {
      $this->aclCityLocatoins = $aclCityLocatoins;
      $this->aclErr = $aclErr;
    }

}

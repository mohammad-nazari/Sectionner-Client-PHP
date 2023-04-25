<?php

namespace webservice;

class ChangeCityName
{

    /**
     * @var User $requestUser
     * @access public
     */
    public $requestUser = null;

    /**
     * @var string $oldCityName
     * @access public
     */
    public $oldCityName = null;

    /**
     * @var string $newCityName
     * @access public
     */
    public $newCityName = null;

    /**
     * @param User $requestUser
     * @param string $oldCityName
     * @param string $newCityName
     * @access public
     */
    public function __construct($requestUser, $oldCityName, $newCityName)
    {
      $this->requestUser = $requestUser;
      $this->oldCityName = $oldCityName;
      $this->newCityName = $newCityName;
    }

}

<?php

namespace webservice;

class ChangeLocationName
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
     * @var string $oldLocationName
     * @access public
     */
    public $oldLocationName = null;

    /**
     * @var string $newLocationName
     * @access public
     */
    public $newLocationName = null;

    /**
     * @param User $requestUser
     * @param string $oldCityName
     * @param string $newCityName
     * @param string $oldLocationName
     * @param string $newLocationName
     * @access public
     */
    public function __construct($requestUser, $oldCityName, $newCityName, $oldLocationName, $newLocationName)
    {
      $this->requestUser = $requestUser;
      $this->oldCityName = $oldCityName;
      $this->newCityName = $newCityName;
      $this->oldLocationName = $oldLocationName;
      $this->newLocationName = $newLocationName;
    }

}

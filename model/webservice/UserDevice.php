<?php

namespace webservice;

class UserDevice
{

    /**
     * @var User $udUser
     * @access public
     */
    public $udUser = null;

    /**
     * @var Device[] $udDevs
     * @access public
     */
    public $udDevs = null;

    /**
     * @var ErrorCode $udErr
     * @access public
     */
    public $udErr = null;

    /**
     * @param User $udUser
     * @param Device[] $udDevs
     * @param ErrorCode $udErr
     * @access public
     */
    public function __construct($udUser, $udDevs, $udErr)
    {
      $this->udUser = $udUser;
      $this->udDevs = $udDevs;
      $this->udErr = $udErr;
    }

}

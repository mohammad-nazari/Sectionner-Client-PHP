<?php

namespace webservice;

class User
{

    /**
     * @var int $uId
     * @access public
     */
    public $uId = null;

    /**
     * @var string $uName
     * @access public
     */
    public $uName = null;

    /**
     * @var string $uPassword
     * @access public
     */
    public $uPassword = null;

    /**
     * @var string $uRePassword
     * @access public
     */
    public $uRePassword = null;

    /**
     * @var string $uFirstName
     * @access public
     */
    public $uFirstName = null;

    /**
     * @var string $uLastName
     * @access public
     */
    public $uLastName = null;

    /**
     * @var UserType $uType
     * @access public
     */
    public $uType = null;

    /**
     * @var string $uKey
     * @access public
     */
    public $uKey = null;

    /**
     * @var ErrorCode $uErr
     * @access public
     */
    public $uErr = null;

    /**
     * @param int $uId
     * @param string $uName
     * @param string $uPassword
     * @param string $uRePassword
     * @param string $uFirstName
     * @param string $uLastName
     * @param UserType $uType
     * @param string $uKey
     * @param ErrorCode $uErr
     * @access public
     */
    public function __construct($uId, $uName, $uPassword, $uRePassword, $uFirstName, $uLastName, $uType, $uKey, $uErr)
    {
      $this->uId = $uId;
      $this->uName = $uName;
      $this->uPassword = $uPassword;
      $this->uRePassword = $uRePassword;
      $this->uFirstName = $uFirstName;
      $this->uLastName = $uLastName;
      $this->uType = $uType;
      $this->uKey = $uKey;
      $this->uErr = $uErr;
    }

}

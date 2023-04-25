<?php

namespace webservice;

class DataBase
{

    /**
     * @var string $dbServer
     * @access public
     */
    public $dbServer = null;

    /**
     * @var int $bdPort
     * @access public
     */
    public $bdPort = null;

    /**
     * @var string $dbUser
     * @access public
     */
    public $dbUser = null;

    /**
     * @var string $dbPassWord
     * @access public
     */
    public $dbPassWord = null;

    /**
     * @var ErrorCode $dbErr
     * @access public
     */
    public $dbErr = null;

    /**
     * @param string $dbServer
     * @param int $bdPort
     * @param string $dbUser
     * @param string $dbPassWord
     * @param ErrorCode $dbErr
     * @access public
     */
    public function __construct($dbServer, $bdPort, $dbUser, $dbPassWord, $dbErr)
    {
      $this->dbServer = $dbServer;
      $this->bdPort = $bdPort;
      $this->dbUser = $dbUser;
      $this->dbPassWord = $dbPassWord;
      $this->dbErr = $dbErr;
    }

}

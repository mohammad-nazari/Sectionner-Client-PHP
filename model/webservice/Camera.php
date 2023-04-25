<?php

namespace webservice;

class Camera
{

    /**
     * @var int $cSocket
     * @access public
     */
    public $cSocket = null;

    /**
     * @var IP $cIP
     * @access public
     */
    public $cIP = null;

    /**
     * @var int $cPort
     * @access public
     */
    public $cPort = null;

    /**
     * @var ErrorCode $cErr
     * @access public
     */
    public $cErr = null;

    /**
     * @param int $cSocket
     * @param IP $cIP
     * @param int $cPort
     * @param ErrorCode $cErr
     * @access public
     */
    public function __construct($cSocket, $cIP, $cPort, $cErr)
    {
      $this->cSocket = $cSocket;
      $this->cIP = $cIP;
      $this->cPort = $cPort;
      $this->cErr = $cErr;
    }

}

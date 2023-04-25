<?php

namespace webservice;

class DeleteDevicesResponse
{

    /**
     * @var ErrorCode $responseError
     * @access public
     */
    public $responseError = null;

    /**
     * @param ErrorCode $responseError
     * @access public
     */
    public function __construct($responseError)
    {
      $this->responseError = $responseError;
    }

}

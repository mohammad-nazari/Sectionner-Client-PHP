<?php

namespace webservice;

class ErrorCode
{

    /**
     * @var int $eNo
     * @access public
     */
    public $eNo = null;

    /**
     * @var string $eMsg
     * @access public
     */
    public $eMsg = null;

    /**
     * @var SettingLevel $eType
     * @access public
     */
    public $eType = null;

    /**
     * @param int $eNo
     * @param string $eMsg
     * @param SettingLevel $eType
     * @access public
     */
    public function __construct($eNo, $eMsg, $eType)
    {
      $this->eNo = $eNo;
      $this->eMsg = $eMsg;
      $this->eType = $eType;
    }

}

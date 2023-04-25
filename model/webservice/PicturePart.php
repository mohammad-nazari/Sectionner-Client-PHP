<?php

namespace webservice;

class PicturePart
{

    /**
     * @var int $ppIndex
     * @access public
     */
    public $ppIndex = null;

    /**
     * @var string $ppData
     * @access public
     */
    public $ppData = null;

    /**
     * @var int $ppCRC
     * @access public
     */
    public $ppCRC = null;

    /**
     * @param int $ppIndex
     * @param string $ppData
     * @param int $ppCRC
     * @access public
     */
    public function __construct($ppIndex, $ppData, $ppCRC)
    {
      $this->ppIndex = $ppIndex;
      $this->ppData = $ppData;
      $this->ppCRC = $ppCRC;
    }

}

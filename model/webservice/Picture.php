<?php

namespace webservice;

class Picture
{

    /**
     * @var string $pName
     * @access public
     */
    public $pName = null;

    /**
     * @var int $pSize
     * @access public
     */
    public $pSize = null;

    /**
     * @var int $pPartSize
     * @access public
     */
    public $pPartSize = null;

    /**
     * @var int $pPartNo
     * @access public
     */
    public $pPartNo = null;

    /**
     * @var int $pCRC
     * @access public
     */
    public $pCRC = null;

    /**
     * @var PicturePart[] $pParts
     * @access public
     */
    public $pParts = null;

    /**
     * @param string $pName
     * @param int $pSize
     * @param int $pPartSize
     * @param int $pPartNo
     * @param int $pCRC
     * @param PicturePart[] $pParts
     * @access public
     */
    public function __construct($pName, $pSize, $pPartSize, $pPartNo, $pCRC, $pParts)
    {
      $this->pName = $pName;
      $this->pSize = $pSize;
      $this->pPartSize = $pPartSize;
      $this->pPartNo = $pPartNo;
      $this->pCRC = $pCRC;
      $this->pParts = $pParts;
    }

}

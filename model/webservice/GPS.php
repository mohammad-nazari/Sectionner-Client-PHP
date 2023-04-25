<?php

namespace webservice;

class GPS
{

    /**
     * @var float $gX
     * @access public
     */
    public $gX = null;

    /**
     * @var float $gY
     * @access public
     */
    public $gY = null;

    /**
     * @param float $gX
     * @param float $gY
     * @access public
     */
    public function __construct($gX, $gY)
    {
      $this->gX = $gX;
      $this->gY = $gY;
    }

}

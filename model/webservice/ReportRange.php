<?php

namespace webservice;

class ReportRange
{

    /**
     * @var dateTime $rrStart
     * @access public
     */
    public $rrStart = null;

    /**
     * @var dateTime $rrEnd
     * @access public
     */
    public $rrEnd = null;

    /**
     * @param dateTime $rrStart
     * @param dateTime $rrEnd
     * @access public
     */
    public function __construct($rrStart, $rrEnd)
    {
      $this->rrStart = $rrStart;
      $this->rrEnd = $rrEnd;
    }

}

<?php

namespace webservice;

class UserLog
{

    /**
     * @var ReportRange $ulRange
     * @access public
     */
    public $ulRange = null;

    /**
     * @var string $ulData
     * @access public
     */
    public $ulData = null;

    /**
     * @var User $ulUser
     * @access public
     */
    public $ulUser = null;

    /**
     * @param ReportRange $ulRange
     * @param string $ulData
     * @param User $ulUser
     * @access public
     */
    public function __construct($ulRange, $ulData, $ulUser)
    {
      $this->ulRange = $ulRange;
      $this->ulData = $ulData;
      $this->ulUser = $ulUser;
    }

}

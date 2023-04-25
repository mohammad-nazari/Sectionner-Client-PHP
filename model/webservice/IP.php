<?php

namespace webservice;

class IP
{

    /**
     * @var int $ip1
     * @access public
     */
    public $ip1 = null;

    /**
     * @var int $ip2
     * @access public
     */
    public $ip2 = null;

    /**
     * @var int $ip3
     * @access public
     */
    public $ip3 = null;

    /**
     * @var int $ip4
     * @access public
     */
    public $ip4 = null;

    /**
     * @param int $ip1
     * @param int $ip2
     * @param int $ip3
     * @param int $ip4
     * @access public
     */
    public function __construct($ip1, $ip2, $ip3, $ip4)
    {
      $this->ip1 = $ip1;
      $this->ip2 = $ip2;
      $this->ip3 = $ip3;
      $this->ip4 = $ip4;
    }

}

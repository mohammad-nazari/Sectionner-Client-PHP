<?php

namespace webservice;

class UsersList
{

    /**
     * @var User[] $ulUsers
     * @access public
     */
    public $ulUsers = null;

    /**
     * @var ErrorCode $ulErr
     * @access public
     */
    public $ulErr = null;

    /**
     * @param User[] $ulUsers
     * @param ErrorCode $ulErr
     * @access public
     */
    public function __construct($ulUsers, $ulErr)
    {
      $this->ulUsers = $ulUsers;
      $this->ulErr = $ulErr;
    }

}

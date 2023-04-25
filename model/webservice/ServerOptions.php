<?php

namespace webservice;

class ServerOptions
{

    /**
     * @var DataBase $soDataBase
     * @access public
     */
    public $soDataBase = null;

    /**
     * @var int $soRepeat
     * @access public
     */
    public $soRepeat = null;

    /**
     * @var ErrorCode $soErr
     * @access public
     */
    public $soErr = null;

    /**
     * @param DataBase $soDataBase
     * @param int $soRepeat
     * @param ErrorCode $soErr
     * @access public
     */
    public function __construct($soDataBase, $soRepeat, $soErr)
    {
      $this->soDataBase = $soDataBase;
      $this->soRepeat = $soRepeat;
      $this->soErr = $soErr;
    }

}

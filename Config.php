<?php
/**
 * @author denis909
 * @license MIT
 */
namespace denis909\db;

class Config
{

    public $host;

    public $user;

    public $password;

    public $db;

    public $charset;

    public function __construct($host = null, $user = null, $password = null, $db = null, $charset = 'utf8')
    {
        $this->host = $host;

        $this->user = $user;

        $this->password = $password;

        $this->db = $db;
        
        $this->charset = $charset;        
    }

}
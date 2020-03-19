<?php
/**
 * @author denis909 <mail@denis909.spb.ru>
 * @license MIT
 */
namespace Denis909\Db;

class Config
{

    public $host;

    public $user;

    public $password;

    public $db;

    public $charset = 'utf8';

    public function __construct($host = null, $user = null, $password = null, $db = null, $charset = null)
    {
        if ($host)
        {
            $this->host = $host;
        }

        if ($user)
        {
            $this->user = $user;
        }

        if ($password)
        {
            $this->password = $password;
        }

        if ($db)
        {
            $this->db = $db;
        }

        if ($charset)
        {
            $this->charset = $charset;
        }
    }

}
<?php
/**
 * @author denis909 <mail@denis909.spb.ru>
 * @license MIT
 */
namespace Denis909\Db;

class Expression
{

    protected $_sql;

    public function __construct($sql)
    {
        $this->_sql = $sql;
    }

    public function __toString()
    {
        return $this->_sql;
    } 

    public function getSql()
    {
        return $this->_sql;
    }
    
}
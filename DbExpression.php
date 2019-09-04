<?php
/**
 * @package Db
 * @license MIT License
 * @link    http://denis909.spb.ru
 */
namespace denis909\db;

class DbExpression
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
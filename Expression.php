<?php
/**
 * @author denis909
 * @license MIT
 */
namespace denis909\db;

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
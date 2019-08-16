<?php
/**
 * @package Db
 * @license MIT License
 * @link    http://denis909.spb.ru
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

    public static function isExpression($object)
    {
        $class = Expression::class;

        if (is_object($object))
        {
            if ($object instanceof $class)
            {
                return true;
            }
        }
        elseif (is_string($object))
        {
            return is_subclass_of($object, $class, true);
        }

        return false;
    }

}
<?php
/**
 * @package Db
 * @license MIT License
 * @link    http://denis909.spb.ru
 */
namespace denis909\db;

use ArrayAccess;
use Exception;

class Row implements ArrayAccess
{

    protected $_container = [];

    public function __construct($params = [])
    {
        $this->_container = $params;
    }

    public function __isset($name)
    {
        return isset($this->_container[$name]);
    }

    public function __get($name)
    {
        if (!array_key_exists($name, $this->_container))
        {
            throw new Exception('Undefined property: ' . $name);
        }

        return $this->_container[$name];
    }

    public function __set($name, $value)
    {
        if (!array_key_exists($name, $this->_container))
        {
            throw new Exception('Undefined property: ' . $name);
        }    

        $this->_container[$name] = $value;
    }

    public function getProperty($name, $default = null)
    {
        if (array_key_exists($name, $this->_container))
        {
            return $this->_container[$name];
        }

        return $default;
    }

    public function setProperty($name, $value)
    {
        $this->_container[$name] = $value;
    }

    public function offsetSet($offset, $value)
    {
        if (!array_key_exists($offset, $this->_container))
        {
            throw new Exception('Undefined offset: ' . $offset);
        }

        $this->_container[$offset] = $value;
    }

    public function offsetExists($offset)
    {
        return isset($this->_container[$offset]);
    }

    public function offsetUnset($offset)
    {
        throw new Exception('Unset is not allowed.');
    }

    public function offsetGet($offset)
    {
        if (!array_key_exists($offset, $this->_container))
        {
            throw new Exception('Undefined offset: ' . $offset);
        }

        return $this->_container[$offset];
    }

}
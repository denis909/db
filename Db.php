<?php
/**
 * @package Db
 * @license MIT License
 * @link    http://denis909.spb.ru
 */
namespace denis909\db;

class Db
{

    protected $_adapter;

    public function __construct($adapter)
    {
        $this->_adapter = $adapter;
    }

    public function getAdapter()
    {
        return $this->_adapter;
    }

    public function getConnection()
    {
        return $this->getAdapter()->getConnection();
    }

    public function createCommand()
    {
        return new Command($this);
    }

    public function query($sql, $params = [])
    {
        return $this->getAdapter()->query($sql);
    }

    public function insertId()
    {
        return $this->getAdapter()->insertId();
    }

    public function escape($string)
    {
        if(is_null($string))
        {
            return 'NULL';
        }

        return $this->getAdapter()->escape($string);
    }

    public function count($sql, $params = [])
    {
        $params = $this->escapeParams($params);

        $sql = strtr($sql, $params);

        return $this->getAdapter()->count($sql);
    }

    public function queryAll($sql, $params = [])
    {
        $params = $this->escapeParams($params);

        $sql = strtr($sql, $params);

        $return = $this->getAdapter()->queryAll($sql);

        foreach($return as $key => $value)
        {
            $return[$key] = new Row($value);
        }

        return $return;
    }

    public function queryOne($sql, $params = [])
    {
        $params = $this->escapeParams($params);

        $sql = strtr($sql, $params);

        $return = $this->getAdapter()->queryOne($sql);
   
        if ($return)
        {
            $return = new Row($return);
        }

        return $return;
    }

    public function escapeParams($params = [])
    {
        foreach($params as $key => $value)
        {
            if ($value instanceof DbExpression)
            {
                $params[$key] = $value->getSql();
            }
            else
            {
                $params[$key] = "'" . $this->escape($value) . "'";
            }
        }

        return $params;
    }

    public function findAll($from, $where = null, $params = [], $suffix = null)
    {
        $command = $this->createCommand();

        $sql = $command->findAll($from, $where, $params, $suffix);
   
        return $this->queryAll($sql);
    }

    public function findOne($from, $where = null, $params = [], $suffix = '')
    {
        $command = $this->createCommand();

        $sql = $command->findOne($from, $where, $params, $suffix);
    
        return $this->queryOne($sql);
    }

    public function insert($table, $values = [])
    {
        $command = $this->createCommand();

        $sql = $command->insert($table, $values);
    
        $result = $this->query($sql);

        if (!$result)
        {
            return false;
        }

        return $this->insertId();
    }

    public function replace($table, $values = [])
    {
        $command = $this->createCommand();

        $sql = $command->replace($table, $values);
    
        $result = $this->query($sql);

        if (!$result)
        {
            return false;
        }

        return true;
    }

    public function update($table, $values, $where, $params = [])
    {
        $command = $this->createCommand();

        $sql = $command->update($table, $values, $where, $params);

        return $this->query($sql);
    }

    public function delete($table, $where, $params = [])
    {
        $command = $this->createCommand();

        $sql = $command->delete($table, $where, $params);

        return $this->query($sql);
    }

}
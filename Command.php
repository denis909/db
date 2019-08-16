<?php
/**
 * @package Db
 * @license MIT License
 * @link    http://denis909.spb.ru
 */
namespace denis909\db;

use Exception;

class Command
{

    protected $_db;

    public function __construct($db)
    {
        $this->_db = $db;
    }

    public function getDb()
    {
        return $this->_db;
    }

    public function values($values, $isWhere = false)
    {
        if ($isWhere)
        {
            $devider = ' AND ';
        }
        else
        {
            $devider = ', ';
        }

        $sql = '';

        foreach($values as $key => $value)
        {
            if ($sql)
            {
                $sql .= $devider;
            }

            if (($value === null) && $isWhere)
            {
                $sql .= '`' . $key . '` IS NULL';
            }
            else
            {
                $sql .= '`' . $key . '` = ';

                if (Expression::isSubclassOf($value))
                {
                    $sql .= $value->getSql();
                }
                else
                {
                    $sql .= "'" . $this->getDb()->escape($value) . "'";
                }
            }
        }

        return $sql;
    }

    public function where($where, $params = [])
    {
        if (is_array($where))
        {
            return $this->values($where, true);
        }
        else
        {
            if ($params === null)
            {
                return $where;
            }

            return strtr($where, $params);
        }
    }

    public function update($table, $values, $where, $params = [])
    {
        $sql = 'UPDATE ' .  $this->table($table) . ' SET ' . $this->values($values);

        if ($where)
        {
            $sql .= ' WHERE ' . $this->where($where, $params);
        }

        $sql .= ';';

        return $sql;
    }

    public function insert($table, $values = [])
    {
        $sql = 'INSERT INTO ' . $this->table($table) . ' SET ' . $this->values($values) . ';';

        return $sql;
    }

    public function delete($table, $where, $params = [])
    {
        $sql = "DELETE FROM " . $this->table($table);

        if ($where)
        {
            $sql .= ' WHERE ' . $this->where($where, $params);
        }

        $sql .= ';';

        return $sql;
    }

    public function findAll($from, $where = null, $params = [], $suffix = null)
    {
        $sql = 'SELECT ' . $this->columns($from) . ' FROM ' . $this->table($from);

        if ($where)
        {
            $sql .= ' WHERE ' . $this->where($where, $params); 
        }

        if ($suffix)
        {
            $sql .= ' ' . $suffix;
        }

        $sql .= ';';

        return $sql;
    }

    public function findOne($from, $where = null, $params = [], $suffix = '')
    {
        $sql = 'SELECT ' . $this->columns($from) . ' FROM ' . $this->table($from);

        if ($where)
        {
            $sql .= ' WHERE ' . $this->where($where, $params); 
        }

        if ($suffix)
        {
            $sql .= ' ' . $suffix;
        }

        $sql .= ' LIMIT 1;';

        return $sql;
    }

    public function table($from)
    {
        if (is_array($from))
        {
            $tables = [];

            foreach($from as $name => $columns)
            {
                $tables[] = $this->table($name);
            }

            return implode(',', $tables);
        }

        if (strpos($from, "`") !== false)
        {
            throw new DbException("Bad table name: " . $from);
        }

        return "`" . $from . "`";
    }

    public function columns($from)
    {
        if (is_array($from))
        {
            $columns = [];

            foreach($from as $table => $cols)
            {
                foreach($cols as $col => $syn)
                {
                    if (is_int($col))
                    {
                        $columns[] = $this->table($table) . '.`' . $syn. '`';
                    }
                    else
                    {
                        $columns[] = $this->table($table) . '.`' . $col . '` `' . $syn . '`';
                    }
                }
            }

            return implode(',', $columns);
        }

        return '*';
    }

}
<?php
/**
 * @author denis909
 * @license MIT
 */
namespace denis909\db;

interface AdapterInterface
{

    function __construct($config);

    function __destruct();

    function getConnection();

    function query($sql);

    function escape($sql);

    function insertId();

    function queryOne($sql);

    function queryAll($sql);

    function count($sql);

}
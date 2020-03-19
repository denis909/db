<?php
/**
 * @author denis909 <mail@denis909.spb.ru>
 * @license MIT
 */
namespace Denis909\Db;

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
<?php
/**
 * @author denis909 <mail@denis909.spb.ru>
 * @license MIT
 */
namespace Denis909\Db;

class Row extends \ArrayObject
{

    public function __construct($input = [], int $flags = self::ARRAY_AS_PROPS, string $iterator_class = "ArrayIterator")
    {
        parent::__construct($input, $flags, $iterator_class);
    }

}
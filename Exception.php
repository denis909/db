<?php
/**
 * @author denis909 <mail@denis909.spb.ru>
 * @license MIT
 */
namespace Denis909\Db;

class Exception extends \Exception
{

    public function setMessage(string $message)
    {
        $this->message = $message;
    }

}
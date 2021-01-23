<?php


namespace ILoveMarusia\Common\Model;

use ILoveMarusia\Common\Mapper;
use ILoveMarusia\Common\Entity;

class Request
{
    public static function Insert($request,$response)
    {
        return self::GetMapper() -> Insert($request,$response);
    }

    protected static function GetMapper(){
        return $mapper = new Mapper\Request();
    }
}
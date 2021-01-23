<?php


namespace ILoveMarusia\Common\Model;

use ILoveMarusia\Common\Mapper;

class Response
{
    public static function GetResponseByResponseId($response_id)
    {
        return self::GetMapper() -> GetResponseByResponseId($response_id);
    }
    public static function GetResponseByCommandId($command_id)
    {
        return self::GetMapper() -> GetResponseByCommandId($command_id);
    }

    protected static function GetMapper(){
        return $mapper = new Mapper\Response();
    }
}
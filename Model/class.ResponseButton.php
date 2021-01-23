<?php


namespace ILoveMarusia\Common\Model;

use ILoveMarusia\Common\Mapper;

class ResponseButton
{
    public static function GetResponseAndButtonByResponseId($response_id)
    {
        return self::GetMapper() -> GetResponseAndButtonByResponseId($response_id);
    }

    protected static function GetMapper(){
        return $mapper = new Mapper\ResponseButton();
    }
}
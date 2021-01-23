<?php


namespace ILoveMarusia\Common\Model;

use ILoveMarusia\Common\Mapper;

class Button
{
    public static function GetButtonByResponseId($response_id)
    {
        return self::GetMapper() -> GetButtonByResponseId($response_id);
    }
    public static function GetButtonByTitle($title)
    {
        return self::GetMapper() -> GetButtonByTitle($title);
    }

    protected static function GetMapper(){
        return $mapper = new Mapper\Button();
    }
}
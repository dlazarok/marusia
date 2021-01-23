<?php


namespace ILoveMarusia\Common\Model;

use ILoveMarusia\Common\Mapper;

class CardType
{
    public static function GetCardTypeByTypeId($type_id)
    {
        return self::GetMapper() -> GetCardTypeByTypeId($type_id);
    }

    protected static function GetMapper(){
        return $mapper = new Mapper\CardType();
    }
}
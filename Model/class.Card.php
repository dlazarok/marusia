<?php


namespace ILoveMarusia\Common\Model;

use ILoveMarusia\Common\Mapper;

class Card
{
    public static function GetCardByCardId($card_id)
    {
        return self::GetMapper() -> GetCardByCardId($card_id);
    }

    protected static function GetMapper(){
        return $mapper = new Mapper\Card();
    }
}
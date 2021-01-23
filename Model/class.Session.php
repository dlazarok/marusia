<?php


namespace ILoveMarusia\Common\Model;

use ILoveMarusia\Common\Mapper;
use ILoveMarusia\Common\Entity;


class Session
{
    public static function Insert(Entity\Session $session)
    {
        return self::GetMapper() -> Insert($session);
    }

    protected static function GetMapper(){
        return $mapper = new Mapper\Session();
    }
}
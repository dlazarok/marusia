<?php


namespace ILoveMarusia\Common\Model;

use ILoveMarusia\Common\Mapper;

class Command
{
    public static function GetCommandByCommandName($command)
    {
        return self::GetMapper() -> GetCommandByCommandName($command);
    }

    protected static function GetMapper(){
        return $mapper = new Mapper\Command();
    }
}
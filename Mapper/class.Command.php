<?php


namespace ILoveMarusia\Common\Mapper;

use ILoveMarusia\Common\Helper\ConnectionDatabase;

class Command
{
    protected $connection;

    public function __construct()
    {
        $Db = new ConnectionDatabase();
        $this -> connection = $Db -> Connection();

    }

    static private function GetSchemaName(){
        return '`denis121_e11`.';
    }

    static private function GetTableName(){
        return '`command`';
    }

    public function GetCommandByCommandName($command){
        $sql = 'SELECT * '
            . 'FROM ' . self::GetSchemaName() . self::GetTableName()
            . ' WHERE command like \'%' . $command . '%\' '
            . 'LIMIT 1';

        $params = array();
        $query = $this -> connection -> prepare($sql);
        $query->execute($params);
        $query->setFetchMode(\PDO::FETCH_CLASS, 'ILoveMarusia\Common\Entity\Command');
        return $query->fetch();

    }
}
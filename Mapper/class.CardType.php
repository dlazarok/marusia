<?php


namespace ILoveMarusia\Common\Mapper;

use ILoveMarusia\Common\Helper\ConnectionDatabase;

class CardType
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
        return '`card_type`';
    }

    public function GetCardTypeByTypeId($type_id){
        $sql = 'SELECT * '
            . 'FROM ' . self::GetSchemaName()  . self::GetTableName()
            . ' WHERE type_id = :type_id ';

        $params = array(':type_id' => $type_id);
        $query = $this -> connection -> prepare($sql);
        $query->execute($params);
        $query->setFetchMode(\PDO::FETCH_CLASS , 'ILoveMarusia\Common\Entity\CardType');
        return $query->fetch();

    }
}
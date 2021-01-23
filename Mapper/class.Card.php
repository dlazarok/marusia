<?php


namespace ILoveMarusia\Common\Mapper;

use ILoveMarusia\Common\Helper\ConnectionDatabase;

class Card
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
        return '`card`';
    }

    public function GetCardByCardId($card_id){
        $sql = ' SELECT * '
            . ' FROM ' . self::GetSchemaName()  . self::GetTableName()
            . ' WHERE card_id = :card_id ';

        $params = array(':card_id' => $card_id);
        $query = $this -> connection -> prepare($sql);
        $query->execute($params);
        $query->setFetchMode(\PDO::FETCH_CLASS, 'ILoveMarusia\Common\Entity\Card');
        return $query->fetch();

    }
}
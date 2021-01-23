<?php


namespace ILoveMarusia\Common\Mapper;

use ILoveMarusia\Common\Helper\ConnectionDatabase;

class ResponseButton
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
        return '`response_button`';
    }

    public function GetResponseAndButtonByResponseId($response_id){
        $sql = 'SELECT * '
            . 'FROM ' . self::GetSchemaName()  . self::GetTableName()
            . ' WHERE response_id = :response_id ';

        $params = array(':response_id' => $response_id);
        $query = $this -> connection -> prepare($sql);
        $query->execute($params);
        $query->setFetchMode(\PDO::FETCH_CLASS, 'ILoveMarusia\Common\Entity\ResponseButton');
        return $query->fetchAll();

    }
}
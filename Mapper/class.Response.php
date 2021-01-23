<?php


namespace ILoveMarusia\Common\Mapper;

use ILoveMarusia\Common\Helper\ConnectionDatabase;

class Response
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
        return '`response`';
    }

    public function GetResponseByResponseId($response_id){
        $sql = 'SELECT *'
            . ' FROM ' . self::GetSchemaName() . self::GetTableName()
            . ' WHERE response_id = :response_id ';

        $params = array(':response_id' => $response_id);
        $query = $this -> connection -> prepare($sql);
        $query->execute($params);
        $query->setFetchMode(\PDO::FETCH_CLASS, 'ILoveMarusia\Common\Entity\Response');
        return $query->fetch();

    }
    public function GetResponseByCommandId($command_id){
        $sql = 'SELECT *'
            . ' FROM ' . self::GetSchemaName() . self::GetTableName()
            . ' WHERE command_id = :command_id ';

        $params = array(':command_id' => $command_id);
        $query = $this -> connection -> prepare($sql);
        $query->execute($params);
        $query->setFetchMode(\PDO::FETCH_CLASS, 'ILoveMarusia\Common\Entity\Response');
        return $query->fetch();

    }

}
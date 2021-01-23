<?php


namespace ILoveMarusia\Common\Mapper;

use ILoveMarusia\Common\Helper\ConnectionDatabase;

class Button
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
        return '`button`';
    }

    public function GetButtonByResponseId($response_id){

        $sql = 'SELECT * '
            . 'FROM ' . self::GetSchemaName()  . self::GetTableName()
            . ' WHERE response_id = :response_id';

        $params = array(':response_id' => $response_id);
        $query = $this -> connection -> prepare($sql);
        $query->execute($params);
        $query->setFetchMode(\PDO::FETCH_CLASS, 'ILoveMarusia\Common\Entity\Button');
        return $query->fetchAll();

    }
    public function GetButtonByTitle($title){
        $sql = 'SELECT * '
            . 'FROM ' . self::GetSchemaName() . self::GetTableName()
            . ' WHERE title like lower(\'' . $title . '%\') '
            . 'LIMIT 1';


        $params = array();
        $query = $this -> connection -> prepare($sql);
        $query->execute($params);
        $query->setFetchMode(\PDO::FETCH_CLASS, 'ILoveMarusia\Common\Entity\Button');
        return $query->fetch();

    }
}
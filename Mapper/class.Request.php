<?php


namespace ILoveMarusia\Common\Mapper;

use ILoveMarusia\Common\Helper\ConnectionDatabase;

class Request
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
        return '`request`';
    }

    public function Insert($request,$response){

        try {
            $sql = 'INSERT INTO '
                . self::GetSchemaName() . self::GetTableName()
                . ' (json_request,json_response) '
                . ' VALUES (:json_request,:json_response)';

            $params = array(
                ':json_request' => $request,
                ':json_response' => $response,
            );
            $query = $this->connection->prepare($sql);
            $query->execute($params);
            $query->setFetchMode(\PDO::FETCH_ASSOC);
            return $query->fetch();
        }catch (\Exception $e){
            print_r($e);
        }

    }
}
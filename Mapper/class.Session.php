<?php


namespace ILoveMarusia\Common\Mapper;

use ILoveMarusia\Common\Helper\ConnectionDatabase;

class Session
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
        return '`session`';
    }

    public function Insert($session){

        try {
            $sql = 'INSERT INTO '
                . self::GetSchemaName() . self::GetTableName()
                . ' (session_id,user_id,message_id,response_id) '
                . ' VALUES (:session_id,:user_id,:message_id,:response_id)';

            $params = array(
                ':session_id' => $session->session_id,
                ':user_id' => $session->user_id,
                ':message_id' => $session->message_id,
                ':response_id' => $session->response_id,
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
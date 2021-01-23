<?php

namespace ILoveMarusia\Common\Helper;

class ConnectionDatabase
{
    protected $db;

    public function __construct()
    {
        $this -> db = array(
            'user' => 'denis121_e11',
            'password' => 'BNg&M3bv',
            'host' => 'localhost',
            'base' => 'denis121_e11'
        );
    }

    public function Connection(){

        return new \PDO(
            'mysql:host=' . $this -> db['host'] . ';dbname=' .  $this -> db['base'],
            $this -> db['user'],
            $this -> db['password'],
            array(
                12 => true
            )
        );
    }
}


<?php

namespace App\Classes\DB;

require_once('configSql.php');

class Sql{

    private $conn;

    public function __construct(array $connect)
    {

        try {

            $this->conn = new \PDO(
            
                'mysql:host='.$connect['HOSTNAME'].';dbname='.$connect['DBNAME'],$connect['USERNAME'] , $connect['PASSWORD']

            );

        } catch(\Throwable $e) {

            throw new \Exception("Não foi possível efetuar essa ação no momento, tente novamente mais tarde.");           

        }
    }

    private function setParams($statement, $parameters = array())
    {

        foreach ($parameters as $key => $value) {
        
            $this->bindParam($statement, $key, $value);

        }

    }

    private function bindParam($statement, $key, $value)
    {

        $statement->bindParam($key, $value);

    }

    public function query($query, $params = array())
    {

        $stmt = $this->conn->prepare($query);

        $this->setParams($stmt, $params);

        $stmt->execute();

        return $this->conn->lastInsertId();
        
    }

    public function select($query, $params = array()):array
    {

        $stmt = $this->conn->prepare($query);

        $this->setParams($stmt, $params);
        
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);

    }
}
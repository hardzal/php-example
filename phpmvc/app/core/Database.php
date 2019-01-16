<?php
# 8
class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $password = DB_PASSWORD;
    private $dbName = DB_NAME;
    
    private $databaseHandler;
    private $statement;

    
    public function __construct() {
        $dataSourceName =  'mysql:host='.$this->host.';dbname='.$this->dbName;

        $option = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try {
            $this->databaseHandler = new PDO($dataSourceName, $this->user, $this->password, $option);
        } catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    public function query($query) {
        $this->statement = $this->databaseHandler->prepare($query);
    }   

    public function bind($param, $value, $type = null) {
        if(is_null($type)) {
            switch(true) {
                case is_int($value) : 
                    $type =  PDO::PARAM_INT;
                    break;
                case is_bool($value) :
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value) :
                    $type = PDO::PARAM_NULL;
                    break;
                default :
                    $type = PDO::PARAM_STR;
            }
        }

        $this->statement->bindValue($param, $value, $type);
    }

    public function execute() {
        $this->statement->execute();
    }

    public function resultSet() {
        $this->execute();
        return $this->statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function resultSingle() {
        $this->execute();
        return $this->statement->fetch(PDO::FETCH_ASSOC);       
    }

    public function rowCount() {
        return $this->statement->rowCount();
    }
}
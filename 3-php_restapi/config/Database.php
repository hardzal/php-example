<?php

class Database {
    // Database params
    private $db_host = 'localhost';
    private $db_name = 'latihan_api';
    private $db_username = 'root';
    private $db_password = '';
    private $connect;

    // Database Connect 
    public function connect()
    {
        $this->connect = null;

        try {
            $this->connect = new PDO('mysql:host=' . $this->db_host . ';dbname='.$this->db_name, $this->db_username, $this->db_password);
            $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo 'Connection error: '. $e->getMessage();
        }

        return $this->connect;
    }
}


<?php

class Category {
    private $connect;
    private $table = 'categories';

    public $id;
    public $name;
    public $created_at;

    public function __construct($db_connect)
    {
        $this->connect = $db_connect;
    }

    // get categories
    public function read() {
        $query = 'SELECT 
            id,
            name
        FROM 
            '. $this->table .'
        ORDER BY
            created_at DESC';

        // prepare statement
        $statement = $this->connect->prepare($query);

        $statement->execute();

        return $statement;
    }

    public function single_read() {

    }

    public function update() {

    }

    public function delete() {

    }
}
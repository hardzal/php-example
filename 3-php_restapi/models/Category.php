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
        $query = 'SELECT
            id,  
            name,
            created_at
        FROM 
            '. $this->table. '
        WHERE
            id = ?
        LIMIT 0,1';

        $statement = $this->connect->prepare($query);
        
        // bind id
        $statement->bindParam(1, $this->id);
        
        // execute query
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        // set properties
        $this->name = $row['name'];
        $this->created_at = $row['created_at'];
    }

    public function create() {
        $query = 'INSERT INTO '. $this->table .' 
            SET 
                name = :name';
        
        $statement = $this->connect->prepare($query);
        
        // clean data
        $this->name = htmlspecialchars(strip_tags($this->name));

        // Binding data
        $statement->bindParam(':name', $this->name);

        // execute query
        if($statement->execute()) {
            return true;
        }

        // print error if something goes wrong
        printf("Error: %s.\n", $statement->error);

        return false;
    }

    public function update() {
        $query = 'UPDATE '. $this->table .' 
            SET
                name = :name
            WHERE 
                id = :id';
        
        $statement = $this->connect->prepare($query);
        
        // clean data
        $this->name = htmlspecialchars(strip_tags($this->name));
 
        // Binding data
        $statement->bindParam(':id', $this->id);
        $statement->bindParam(':name', $this->name);
        
        // execute query
        if($statement->execute()) {
            return true;
        }

        // print error if something goes wrong
        printf("Error: %s.\n", $statement->error);

        return false;
    }

    public function delete() {
        $query = 'DELETE FROM '. $this->table .' WHERE id = :id';

        $statement = $this->connect->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $statement->bindParam(':id', $this->id);

        if($statement->execute()) {
            return true;
        }

        printf("Error: %s.\n", $statement->error);

        return false;
    }
}
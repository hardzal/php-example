<?php

class Post {
    private $connect;
    private $table = 'posts';

    // Properties
    public $id;
    public $category_id;
    public $categoy_name;
    public $title;
    public $body;
    public $author;
    public $created_at;

    // constructor
    public function __construct($db_connect)
    {
        $this->connect = $db_connect;
    }

    // read posts
    public function read() 
    { 
        $query = 'SELECT  
                c.name as category_name,
                p.id,
                p.category_id,
                p.title,
                p.body,
                p.author,
                p.created_at
            FROM 
                '. $this->table. ' p
            LEFT JOIN
                categories as c ON p.category_id = c.id
            ORDER BY
                p.created_at DESC';
        
        $statement = $this->connect->prepare($query);
        
        $statement->execute();

        return $statement;
    }

    // read single post
    public function single_read() {
        $query = 'SELECT  
            c.name as category_name,
            p.id,
            p.category_id,
            p.title,
            p.body,
            p.author,
            p.created_at
        FROM 
            '. $this->table. ' p
        LEFT JOIN
            categories as c ON p.category_id = c.id
        WHERE
            p.id = ?
        LIMIT 0,1';

        $statement = $this->connect->prepare($query);
        
        // bind id
        $statement->bindParam(1, $this->id);
        
        // execute query
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        // set properties
        $this->title = $row['title'];
        $this->body = $row['body'];
        $this->author = $row['author'];
        $this->category_name = $row['category_name'];
        $this->category_id = $row['category_id'];
    }

    // create post
    public function create() {
        $query = 'INSERT INTO '. $this->table .' 
            SET
                title = :title,
                body = :body,
                author = :author,
                category_id = :category_id';
        
        $statement = $this->connect->prepare($query);
        
        // clean data
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->body = htmlspecialchars(strip_tags($this->body));
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));

        // Binding data
        $statement->bindParam(':title', $this->title);
        $statement->bindParam(':body', $this->body);
        $statement->bindParam(':author', $this->author);
        $statement->bindParam(':category_id', $this->category_id);

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
                title = :title,
                body = :body,
                author = :author,
                category_id = :category_id
            WHERE 
                id = :id';
        
        $statement = $this->connect->prepare($query);
        
        // clean data
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->body = htmlspecialchars(strip_tags($this->body));
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));

        // Binding data
        $statement->bindParam(':id', $this->id);
        $statement->bindParam(':title', $this->title);
        $statement->bindParam(':body', $this->body);
        $statement->bindParam(':author', $this->author);
        $statement->bindParam(':category_id', $this->category_id);

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
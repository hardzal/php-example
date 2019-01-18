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
}
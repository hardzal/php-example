<?php
// headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

// Instantiate Database & Connect
$database = new Database();
$db = $database->connect();

// Instantiate category post object
$category = new Category($db);

//  Blog category query
$result = $category->read();
// Get row count
$num = $result->rowCount();

// Check if any posts
if($num > 0) {
    // Post array
    $categories_array = array();
    $categories_arr['categories'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $category_item = array(
            'id' => $id,
            'name' => $name
        );

        // Push to data
        array_push($categories_arr['categories'], $category_item);
    }
    // Turn to json
    echo json_encode($categories_arr);
} else {
    // no posts 
    echo json_encode(
        array('message' => 'No Categories found')
    );
}

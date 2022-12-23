<?php

//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

//initializing api
include_once('../classes/initialize.php');

//Instatiate category
$genre = new Category($db);

//Category query
$result = $genre->getCategories();

//Get row count
$num = $result->rowCount();

if ($num > 0) {
   $genre_array = array();
   

   while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      $genre_fields = array(
            'id' => $genre_id,
            'genre_name' =>  $genre_name
      );
      array_push($genre_array, $genre_fields);
   }
   //Convert to JSON and output
   echo json_encode($genre_array);
} else {
   echo json_encode(array('message' => 'No categories found.'));
}

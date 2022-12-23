<?php

//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

//initializing api
include_once('../classes/initialize.php');

//Instatiate title
$title = new Title($db);

//Crew query
$result = $title->getTitles();

//Get row count
$num = $result->rowCount();

if ($num > 0) {
   $title_array = array();
   

   while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      $title_fields = array(
            'id' => $movie_id,
            'movie_name' =>  $movie_title
      );
      array_push($title_array, $title_fields);
   }
   //Convert to JSON and output
   echo json_encode($title_array);
} else {
   echo json_encode(array('message' => 'No moview with this title found.'));
}

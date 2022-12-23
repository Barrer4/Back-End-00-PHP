<?php

//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

//initializing api
include_once('../classes/initialize.php');

//Instatiate actor
$actor = new Actor($db);

//Actor query
$result = $actor->getActors();

//Get row count
$num = $result->rowCount();

if ($num > 0) {
   $actor_array = array();
   

   while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      $actor_fields = array(
            'cast_id' => $cast_id,
            'cast_name' =>  $cast_name
      );
      array_push($actor_array, $actor_fields);
   }
   //Convert to JSON and output
   echo json_encode($actor_array);
} else {
   echo json_encode(array('message' => 'No movies for this year found.'));
}

<?php

//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

//initializing api
include_once('../classes/initialize.php');

//Instatiate crew
$crew = new Director($db);

//Crew query
$result = $crew->getDirectors();

//Get row count
$num = $result->rowCount();

if ($num > 0) {
   $crew_array = array();
   

   while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      $crew_fields = array(
            'crew_id' => $crew_id,
            'crew_name' =>  $crew_name,
            'movie_id' => $movie_id
      );
      array_push($crew_array, $crew_fields);
   }
   //Convert to JSON and output
   echo json_encode($crew_array);
} else {
   echo json_encode(array('message' => 'No crew members found.'));
}

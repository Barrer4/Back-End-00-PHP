<?php

//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

//initializing api
include_once('../classes/initialize.php');

//Instatiate year
$year = new Year($db);

//Category query
$result = $year->getYears();

//Get row count
$num = $result->rowCount();

if ($num > 0) {
   $year_array = array();
   

   while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      $year_fields = array(
            'movie_id' => $movie_id,
            'movie_year' =>  $movie_year
      );
      array_push($year_array, $year_fields);
   }
   //Convert to JSON and output
   echo json_encode($year_array);
} else {
   echo json_encode(array('message' => 'No movies for this year found.'));
}

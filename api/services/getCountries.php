<?php

//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

//initializing api
include_once('../classes/initialize.php');

//Instatiate country
$country = new Country($db);

//Category query
$result = $country->getCountries();

//Get row count
$num = $result->rowCount();

if ($num > 0) {
   $country_array = array();
   

   while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      $country_fields = array(
            'id' => $country_id,
            'country_name' =>  $country_name
      );
      array_push($country_array, $country_fields);
   }
   //Convert to JSON and output
   echo json_encode($country_array);
} else {
   echo json_encode(array('message' => 'No countries found.'));
}

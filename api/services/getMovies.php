<?php

//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

//initializing api
include_once('../classes/initialize.php');

//Instatiate movie
$movies = new Movie($db);

//Movie query
if (isset($_GET['search'])) {
   $search = $_GET['search'];
   $result = $movies->getSearch($search);
} else {
   $result = $movies->getMovies();
}

//Get row count
$num = $result->rowCount();

if ($num > 0) {
   $movies_array = array();

   while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      $movie_fields = array(
         'id' => $movie_id,
         'backdrop_path' => $movie_backdrop_path,
         'overview' => html_entity_decode($movie_overview),
         'popularity' => $movie_popularity,
         'poster_path' => $movie_poster_path,
         'year' => (int)$movie_year,
         'title' => $movie_title,
         'vote_average' => $movie_vote_average,
         'vote_count' => $movie_vote_count,
         'genre_name' =>  $genre_name,
         'country_name' => $country_name,
         'director_name' => $crew_name,
         'cast_name' => $cast_name,
         'cast_order' => $cast_order
      );
      array_push($movies_array, $movie_fields);
   }
   //Convert to JSON and output
   echo json_encode($movies_array);
} else {
   echo json_encode(array('Error'));
}

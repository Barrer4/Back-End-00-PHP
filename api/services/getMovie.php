<?php

//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

//initializing api
include_once('../classes/initialize.php');

//Instatiate movie
$movie = new Movie($db);

//Check id
$movie->movie_id = isset($_GET['movie_id'])
   ? $_GET['movie_id']
   : die();

//Execute query
$movie->getMovie();


$movie_fields = array(
   'id' => $movie->movie_id,
   'backdrop_path' => $movie->movie_backdrop_path,
   'overview' => html_entity_decode($movie->movie_overview),
   'popularity' => $movie->movie_popularity,
   'poster_path' => $movie->movie_poster_path,
   'year' => $movie->movie_year,
   'title' => $movie->movie_title,
   'vote_average' => $movie->movie_vote_average,
   'vote_count' => $movie->movie_vote_count,
   'genre_name' =>  $movie->genre_name,
   'country_name' => $movie->country_name,
   'director_name' => $movie->director_name,
   'cast_name' => $movie->cast_name,
   'cast_order' => $movie->cast_order
);
echo json_encode($movie_fields);

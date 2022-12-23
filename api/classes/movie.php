<?php

class Movie
{
   private $conn;
   private $table = 'movies';

   //Movie fields
   public $movie_id;
   public $movie_backdrop_path;
   public $movie_overview;
   public $movie_popularity;
   public $movie_poster_path;
   public $movie_year;
   public $movie_title;
   public $movie_vote_average;
   public $movie_vote_count;

   //Genre fields
   public $genre_name;

   //Crew fields
   public $crew_job;

   //Country fields
   public $country_name;


   //Constructor with db connection
   public function __construct($db)
   {
      $this->conn = $db;
   }

   //Get movies from db
   public function getMovies()
   {

      //create query
      $query = 'SELECT
            m.movie_id,
            m.movie_backdrop_path,
            m.movie_overview,
            m.movie_popularity,
            m.movie_poster_path,
            m.movie_year,
            m.movie_title,
            m.movie_vote_average,
            m.movie_vote_count,
            c.country_name,
            crw.crew_name,
            GROUP_CONCAT(DISTINCT g.genre_name SEPARATOR ", ") AS genre_name,
            GROUP_CONCAT(DISTINCT cst.cast_name SEPARATOR ", ") AS cast_name,
            GROUP_CONCAT(DISTINCT cst.cast_order SEPARATOR ", ") AS cast_order      
         FROM
         ' . $this->table . ' m
         LEFT JOIN 
         movies_genres mg
            ON
         m.movie_id = mg.movie_id
         
         LEFT JOIN 
         genres g 
            ON 
         g.genre_id = mg.genre_id
         
         LEFT JOIN
         movies_countries mc
            ON
         m.movie_id = mc.movie_id
         
         LEFT JOIN
         countries c
            ON
         c.country_id = mc.country_id

         LEFT JOIN
         movies_crew mcrw
            ON
         m.movie_id = mcrw.movie_id
         
         LEFT JOIN
         crew crw
            ON
         crw.crew_id = mcrw.crew_id
         
         LEFT JOIN
         movies_cast mcst
            ON
         m.movie_id = mcst.movie_id
         
         LEFT JOIN
         cast cst
            ON
         cst.cast_id = mcst.cast_id

         GROUP BY
         m.movie_id
         ORDER BY
         count(m.movie_id)
         ';

      //prepare statement
      $stmt = $this->conn->prepare($query);

      //execute query
      $stmt->execute();
      return $stmt;
   }

   //Get specific movie by id
   public function getMovie()
   {

      //create query
      $query = 'SELECT
            m.movie_id,
            m.movie_backdrop_path,
            m.movie_overview,
            m.movie_popularity,
            m.movie_poster_path,
            m.movie_year,
            m.movie_title,
            m.movie_vote_average,
            m.movie_vote_count,
            c.country_name,
            crw.crew_name,
            GROUP_CONCAT(DISTINCT g.genre_name SEPARATOR ", ") AS genre_name,
            GROUP_CONCAT(DISTINCT cst.cast_name SEPARATOR ", ") AS cast_name,
            GROUP_CONCAT(DISTINCT cst.cast_order SEPARATOR ", ") AS cast_order     
         FROM
         ' . $this->table . ' m
         LEFT JOIN 
         movies_genres mg
            ON
         m.movie_id = mg.movie_id
         
         LEFT JOIN 
         genres g 
            ON 
         g.genre_id = mg.genre_id
         
         LEFT JOIN
         movies_countries mc
            ON
         m.movie_id = mc.movie_id
         
         LEFT JOIN
         countries c
            ON
         c.country_id = mc.country_id

         LEFT JOIN
         movies_crew mcrw
            ON
         m.movie_id = mcrw.movie_id
         
         LEFT JOIN
         crew crw
            ON
         crw.crew_id = mcrw.crew_id
         
         LEFT JOIN
         movies_cast mcst
            ON
         m.movie_id = mcst.movie_id
         
         LEFT JOIN
         cast cst
            ON
         cst.cast_id = mcst.cast_id

      WHERE m.movie_id = ?
      ';

      //prepare statement
      $stmt = $this->conn->prepare($query);

      //Binding parameter
      $stmt->bindParam(1, $this->movie_id);

      //Execute query
      $result = $stmt->execute();
      if ($result > 0) {
         $row = $stmt->fetch(PDO::FETCH_ASSOC);

         $this->movie_id = $row['movie_id'];
         $this->movie_backdrop_path = $row['movie_backdrop_path'];
         $this->movie_overview = $row['movie_overview'];
         $this->movie_popularity = $row['movie_popularity'];
         $this->movie_poster_path = $row['movie_poster_path'];
         $this->movie_year = $row['movie_year'];
         $this->movie_title = $row['movie_title'];
         $this->movie_vote_average = $row['movie_vote_average'];
         $this->movie_vote_count = $row['movie_vote_count'];
         $this->genre_name =  $row['genre_name'];
         $this->country_name = $row['country_name'];
         $this->director_name = $row['crew_name'];
         $this->cast_name = $row['cast_name'];
         $this->cast_order = $row['cast_order'];


         return $stmt;
      } else {
         echo json_encode(array('message' => 'No categories found.'));
      }
   }

   //Get movies by search
   public function getSearch($search)
   {

      //create query
      $query = 'SELECT
            m.movie_id,
            m.movie_backdrop_path,
            m.movie_overview,
            m.movie_popularity,
            m.movie_poster_path,
            m.movie_year,
            m.movie_title,
            m.movie_vote_average,
            m.movie_vote_count,
            c.country_name,
            crw.crew_name,
            g.genre_name,
            cst.cast_name,
            cst.cast_order
         FROM
         ' . $this->table . ' m
        LEFT JOIN 
        movies_genres mg
           ON
        m.movie_id = mg.movie_id
        LEFT JOIN 
        genres g 
           ON 
        g.genre_id = mg.genre_id
        
        LEFT JOIN
        movies_countries mc
           ON
        m.movie_id = mc.movie_id
        LEFT JOIN
        countries c
           ON
        c.country_id = mc.country_id
  
        LEFT JOIN
        movies_crew mcrw
           ON
        m.movie_id = mcrw.movie_id
        LEFT JOIN
        crew crw
           ON
        crw.crew_id = mcrw.crew_id
        LEFT JOIN
        movies_cast mcst
           ON
        m.movie_id = mcst.movie_id
        
        LEFT JOIN
        cast cst
           ON
        cst.cast_id = mcst.cast_id
  
        WHERE 
        m.movie_title  RLIKE  ' . " '$search' " . ' 
        OR
        c.country_name RLIKE  ' . " '$search' " . ' 
        OR
        crw.crew_name  RLIKE ' . " '$search' " . ' 
        OR
        m.movie_year RLIKE  ' . " '$search' " . ' 
        OR
        g.genre_name  RLIKE ' . " '$search' " . ' 
        OR
        c.country_name RLIKE ' . " '$search' " . ' 
        OR
        cst.cast_name RLIKE ' . " '$search' " . '
        GROUP BY m.movie_id
      ';

      //prepare statement
      $stmt = $this->conn->prepare($query);

      //execute query
      $stmt->execute();
      return $stmt;
   }
}

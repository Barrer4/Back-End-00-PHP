<?php

class Title
{
   private $conn;
   private $table = 'movies';

   //Genre fields
   public $movie_id;
   public $movie_name;

   //Constructor with db connection
   public function __construct($db)
   {
      $this->conn = $db;
   }

   //Get titles from db
   public function getTitles()
   {
      //create query
      $query = 'SELECT
            *   
         FROM
         ' . $this->table .' m
         GROUP BY
         m.movie_title';

      //prepare statement
      $stmt = $this->conn->prepare($query);

      //execute query
      $stmt->execute();
   
      return $stmt;
   }
}

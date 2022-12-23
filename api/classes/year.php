<?php

class Year
{
   private $conn;
   private $table = 'movies';

   //Year fields
   public $movie_year;
   public $movie_id;

   //Constructor with db connection
   public function __construct($db)
   {
      $this->conn = $db;
   }

   //Get year from db
   public function getYears()
   {
      //create query
      $query = 'SELECT
            *   
         FROM
         ' . $this->table . ' m
         GROUP BY
         m.movie_year';

      //prepare statement
      $stmt = $this->conn->prepare($query);

      //execute query
      $stmt->execute();
   
      return $stmt;
   }
}

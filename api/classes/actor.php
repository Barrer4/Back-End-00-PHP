<?php

class Actor
{
   private $conn;
   private $table = 'cast';

   //Cast fields
   public $cast_name;
   public $cast_id;

   //Constructor with db connection
   public function __construct($db)
   {
      $this->conn = $db;
   }

   //Get cast from db
   public function getActors()
   {
      //create query
      $query = 'SELECT
            *   , 
            GROUP_CONCAT(DISTINCT m.movie_id SEPARATOR ", ") 
         FROM
         ' . $this->table .' cst

         LEFT JOIN
         movies_cast mcst
         ON
         cst.cast_id = mcst.cast_id

         LEFT JOIN
         movies m
         ON
         mcst.movie_id = m.movie_id
         
         GROUP BY
         cst.cast_name';

      //prepare statement
      $stmt = $this->conn->prepare($query);

      //execute query
      $stmt->execute();
   
      return $stmt;
   }
}

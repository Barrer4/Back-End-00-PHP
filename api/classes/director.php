<?php

class Director
{
   private $conn;
   private $table = 'crew';

   //Crew fields
   public $crew_name;
   public $crew_id;

   //Constructor with db connection
   public function __construct($db)
   {
      $this->conn = $db;
   }

   //Get crew from db
   public function getDirectors()
   {
      //create query
      $query = 'SELECT
            *  , 
            GROUP_CONCAT(DISTINCT m.movie_id SEPARATOR ", ") 
         FROM
         ' . $this->table .' crw
         
         LEFT JOIN
         movies_crew mcrw
         ON
         crw.crew_id = mcrw.crew_id

         LEFT JOIN
         movies m
         ON
         mcrw.movie_id = m.movie_id

         GROUP BY
         crw.crew_name';

      //prepare statement
      $stmt = $this->conn->prepare($query);

      //execute query
      $stmt->execute();
   
      return $stmt;
   }
}

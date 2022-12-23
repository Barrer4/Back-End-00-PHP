<?php

class Category
{
   private $conn;
   private $table = 'genres';

   //Genre fields
   public $genre_name;
   public $genre_id;

   //Constructor with db connection
   public function __construct($db)
   {
      $this->conn = $db;
   }

   //Get genre from db
   public function getCategories()
   {
      //create query
      $query = 'SELECT
            *   
         FROM
         ' . $this->table .' g
         GROUP BY
         g.genre_name';

      //prepare statement
      $stmt = $this->conn->prepare($query);

      //execute query
      $stmt->execute();
      return $stmt;
   }

}

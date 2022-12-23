<?php

class Country
{
   private $conn;
   private $table = 'countries';

   //Country fields
   public $country_name;
   public $country_id;

   //Constructor with db connection
   public function __construct($db)
   {
      $this->conn = $db;
   }

   //Get country from db
   public function getCountries()
   {
      //create query
      $query = 'SELECT
            *   
         FROM
         ' . $this->table .' c
         GROUP BY
         c.country_name';

      //prepare statement
      $stmt = $this->conn->prepare($query);

      //execute query
      $stmt->execute();
      return $stmt;
   }

}

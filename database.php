<?php

// This is database class module

require_once("config.php");

class MySQLDatabase {
 
  private $connection;  // private attribute
 
  function __construct() { // constructor
    $this->create_connection();
  }

  // the following method opens a database connection in object
  // oriented method
  public function create_connection() {
    // Create connection
    $this->connection = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    // Check connection
    if ($this->connection->connect_error) {
      die("Connection to database failed: " . $this->connection->connect_error);
    }
  }

  // The following function closes the connection
  public function close_connection() {
    if(isset($this->connection)) {
      $this->connection->close();
      unset($this->connection);
    }
  }

  // Mysql database query

  public function query($sql) {
    $result = $this->connection->query($sql);
    $this->confirm_query($result);
    return $result;
  }

  // If the query not successful, error message displayed.
  private function confirm_query($result) {
    if (!$result) {
      die("Database query failed.");
    }
  } 

  // The function returns the escaped string
  public function escape_value($string) {
    $escaped_string = $this->connection->real_escape_string($string);
    return $escaped_string;
  }

  
  // the following function returns the associative array for
  // the query result
  public function fetch_assoc($result_set) {
    return $result_set->fetch_assoc();
  }

  // the following function returns the  array for
  // the query result
  public function fetch_array($result_set) {
    return $result_set->fetch_array();
  }


  // Determine number of rows in result set
  public function num_rows($result_set) {
    return $result_set->num_rows;
  }  

  // Get the last id inserted over the current db connection
  public function insert_id() {
   return  $this->connection->insert_id;
  }

  // Get the affected rows
  public function affected_rows() {
    return $this->connection->affected_rows;
  }

}

$database = new MySQLDatabase();

?>

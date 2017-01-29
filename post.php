<?php

// This is the Post Class file
// The database is required
require_once('database.php');

class Post extends MySQLDatabase {

  protected static $table_name="Posts";
  protected static $db_fields=array('Title',
  'Price','Description','Email','Agreement','Image1','Image2','Image3','Image4','SubCategory_ID', 'Location_ID');     

  public $Post_ID;
  public $Title;
  public $Price;
  public $Description;
  public $Email;
  public $Agreement;
  public $Timestamp;
  public $Image1;
  public $Image2;
  public $Image3;
  public $Image4;
  public $SubCategory_ID;
  public $Location_ID;

  public static function make ($Title,$Price, $Description, $Email,$Agreement, $Image1, $Image2,$Image3,$Image4, $SubCategory_ID, $Location_ID) {
   $post = new Post();
   $post->Title = $Title;
   $post->Price = $Price;
   $post->Description = $Description;
   $post->Email = $Email;
   $post->Agreement = $Agreement;
   $post->Image1 = $Image1;
   $post->Image2 = $Image2;
   $post->Image3 = $Image3;
   $post->Image4 = $Image4;
   $post->SubCategory_ID = (int)$SubCategory_ID;
   $post->Location_ID = (int)$Location_ID;
   
   return($post);
 }

  // Find all the posts based on a string
  public static function find_posts_based_on_str($str){
    global $database;
    $sql = "SELECT * FROM " . self::$table_name;
    $sql .= " WHERE Title LIKE '{$str}'";
    $sql .= " ORDER BY TimeStamp ASC ";
    $sql .= ";";
    return self::find_by_sql($sql);
  }

  // Find all the posts based on a subcategory
  public static function find_posts_based_on_subcat($SubCategory_ID=0){
    global $database;
    $sql = "SELECT * FROM " . self::$table_name;
    $sql .= " WHERE SubCategory_ID=" .$database->escape_value($SubCategory_ID);
    $sql .= " ORDER BY TimeStamp ASC";
    return self::find_by_sql($sql);
  }

  // Find all the posts based on a Location
  public static function find_posts_based_on_locn($Location_ID=0){
    global $database;
    $sql = "SELECT * FROM " . self::$table_name;
    $sql .= " WHERE Location_ID=" .$database->escape_value($Location_ID);
    $sql .= " ORDER BY TimeStamp ASC";
    return self::find_by_sql($sql);
  }


  // Common Database methods

  public static function find_all() {
    return self::find_by_sql("SELECT * FROM users");
  }

  public static function find_by_id($id=0) {
    global $database;
    $result_array = self::find_by_sql("SELECT * FROM users WHERE id={$id} LIMIT 1");
    return !empty($result_array) ? array_shift($result_array) : false;
  }


  public static function find_by_sql($sql="") {
    global $database;
    $result_set = $database->query($sql);
    $object_array = array();
    while ($row = $database->fetch_array($result_set)) {
      $object_array[] = self::instantiate($row);
    }
    return $object_array;
  }

  private static function instantiate($record) {
    $object = new self;

    //  more dynamic, short-form approach:
    foreach($record as $attribute=>$value) {
      if($object->has_attribute($attribute)) {
        $object->$attribute = $value;
      }
    } 
    return $object;
  }

  private function has_attribute($attribute) {
     //get_object_vars returns an associative array with all attributes
     //(don't incl. private ones!) as the keys and the their current values as 
     // the value

     $object_vars = get_object_vars($this);
     // We don't care about the value, we just want to know if the key exists
     // will return true or false
     return array_key_exists($attribute, $object_vars);
  }

  protected function attributes() {
    // return an array of attribute keys and their values

    $attributes = array();
    foreach(self::$db_fields as $field) {
      $attributes[$field] = $this->$field;
    }
    return $attributes;
  }

  protected function sanitized_attributes() {
    global $database;

    $clean_attributes = array();

    foreach($this->attributes() as $key => $value) {
      $clean_attributes[$key] = $database->escape_value($value);
    }
    return $clean_attributes;
  }

  public function save() {

    return isset($this->id) ? $this->update() : $this->create();

  }

  public function create() {
    global $database;

    $attributes = $this->sanitized_attributes();
    $sql = "INSERT INTO " .self::$table_name." (";
    $sql .= join(", ", array_keys($attributes));
    $sql .= ") VALUES ('";
    $sql .= join("', '", array_values($attributes));
    $sql .= "')";

    if($database->query($sql)) {
      $this->id = $database->insert_id();
      return true;
    } else {

      return false;
    }

  }

  public function update() {
    global $database;

    $attributes = $this->sanitized_attributes();
    $attribute_pairs = array();
    foreach($attributes as $key => $value) {
      $attribute_pairs[] = "{$key} = '{$value}'";
    }

    $sql = "UPDATE " .self::$table_name." SET ";
    $sql .= join(", ", $attribute_pairs);
    $sql .= " WHERE id=" . $database->escape_value($this->id);

    $database->query($sql);
    return ($database->affected_rows() ==1) ? true:false;
  }
 
  public function delete() {
    global $database;
    $sql = "DELETE FROM ".self::$table_name."  ";
    $sql .= "WHERE id=". $database->escape_value($this->id);
    $sql .= " LIMIT 1";
    $database->query($sql);
    return ($database->affected_rows() ==1) ? true:false;


  }

}

?>

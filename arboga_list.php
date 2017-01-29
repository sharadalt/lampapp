<!-- 
    Document   : craiglist 
    Created on : Nov 24, 2016
    Author     : Sharada Thimmaiah 

    This takes the user to browse and post the posts
-->
<?php

require_once('database.php');
require_once('post.php');

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }


global $database;
echo '<h2>Arboga Posts</h2>';

  $loc_res = $database->query("select Location_ID from Location where LocationName='Arboga' LIMIT 1");
  while($loc = $loc_res->fetch_assoc()) {
    $loc_id = $loc['Location_ID'];
  }
  $res = $database->query("Select Post_ID, Title from Posts where Location_ID='$loc_id'");
  while($row_sc = $res->fetch_assoc()) {
    echo "<a href='arboga_list_1.php'>$row_sc[Title]</a>";
    //echo "<option value=$row_sc[Post_ID]>$row_sc[Title]</option>";
  }


?>

<!-- 
    Document   : craiglist 
    Created on : Nov 24, 2016
    Author     : Sharada Thimmaiah 

    This takes the user to browse and post the posts
-->
<?php

require_once('database.php');
require_once('post.php');

global $database;
echo '<h2>Arboga Posts</h2>';

echo '<table border="1">';
          echo '<tr>';
          echo '<th>Title</th><th>Email</th><th>Price</th><th>TimeStamp</th><th>Image1</th>';
          echo '</tr>';

  $loc_res = $database->query("select Location_ID from Location where LocationName='Arboga' LIMIT 1");
  while($loc = $loc_res->fetch_assoc()) {
    $loc_id = $loc['Location_ID'];
  }
  $res = $database->query("Select Post_ID, Title, Email, Price, TimeStamp,Image1 from Posts where Location_ID='$loc_id'");
  while($row_sc = $res->fetch_assoc()) {
    echo '<tr>';
    echo '<td>' . $row_sc['Title'] . '</td>';
    echo '<td>' . $row_sc['Email'] . '</td>';
    echo '<td>' . $row_sc['Price'] . '</td>';
    echo '<td>' . $row_sc['TimeStamp'] . '</td>';
    echo '<td>' .  "<img src='uploads/".$row_sc['Image1']."' height='150' width='150'>";
    //echo '<td>' . $row_sc['Image1'] . '</td>';
    echo '</tr>';
   // echo "<option value=$row_sc[Post_ID]>$row_sc[Title]</option>";
  }


?>

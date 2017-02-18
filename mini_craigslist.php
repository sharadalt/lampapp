<!-- 
    Document   : craiglist 
    Created on : Nov 24, 2016
    Author     : Sharada Thimmaiah 

    This takes the user to browse and post the posts
-->
<?php

require_once('initialize.php');
require_once('database.php');
require_once('post.php');

if(!$session->is_logged_in()) {

  echo nl2br("You are not logged in. Please Login \n");
  echo nl2br('<a href="login.php">Login</a>');

}


if($session->is_logged_in()) {

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

// The following function checks the length of the passed string 
// with max length

  function has_max_length($value, $max) {
    return strlen($value) <= $max;
  }

 $search = $search_err = "";


 if (isset($_POST['submit'])) {

    //print_r($_POST);

    if (empty($_POST['search'])) {
      $title_err = "Search string is required";
      $errors['search'] = "search". " string is required";
    } else {
      $search = test_input($_POST["search"]);
      $max = 64;
      if (!has_max_length($search, $max)) {
        $errors['search'] = ucfirst('search') . "is too long";
        $search_err = "Search string is too long.";
      } else {
        if (!preg_match("/^[a-zA-Z0-9. ]*$/",$search)) {
          $search_err = "Only letters, numbers and white space allowed";
          $errors['search'] = "search". " only letters, numbers and white space";
        } else {
          global $database;
          $search_str = $search . "%";
          $found_post_arr = Post::find_posts_based_on_str($search_str); 

          echo '<h2>Posted Ads</h2>';
          echo '<table border="1">';
          echo '<tr>';
          echo '<th>Title</th><th>Email</th><th>Price</th><th>SubCategory</th><th>Location</th><th>Image1</th>';
          echo '</tr>';
          foreach($found_post_arr as $rowpost) {

           //print_r($rowpost);
           echo '<p></p>';

           echo '<tr>';
           echo '<td>' . $rowpost->Title . '</td>';
           echo '<td>' . $rowpost->Email . '</td>';
           echo '<td>' . $rowpost->Price . '</td>';
           echo '<td>' . $rowpost->SubCategory_ID . '</td>';
           echo '<td>' . $rowpost->Location_ID . '</td>';
           //echo '<td>' . $rowpost->Image1 . '</td>';
          echo '<td>' .  "<img src='uploads/".$rowpost->Image1."' height='100' width='100'>";

           echo '</tr>';
           }
          echo '</table>';

        } 
        
      }
    }

 }
}

?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="styles.css"> 
    <title>AdsList</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=US-ASCII">
  </head>
  <body>

    <div style="width:500px;height:300px;background-color:#6B8E23;">

      <h2 style="color:white;" > AdsList </h2>

      <?php if(!empty($message)) {echo "<p>{$message}</p>";} ?>

      <?php
        if($session->is_logged_in()) { 
          echo nl2br('<a href="logout.php">Logout</a>');
          echo nl2br("\n");
        }
      ?>


      <p><span class="error">* required fields.</span></p>
       <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

      <p>
	<p><a href="post_form.php">NewPost</a></p>
	<p style="color:white;">Search:</p>
        <form action="mini_craigslist.php" method="post">
	<p><b><input type="text" class="myinp" name="search" />
           <input type="Submit" value="Submit" name="submit"/>
           <input type="Reset"/>
        </b></p>

        <h3>Supported Categories and their SubCategories</h3>


	<table>
          <tr>
                <th>ForSale/Rent</th>
                <th>Services</th>
                <th>Jobs</th>
          </tr>
          <tr>
                <td>Books</td>
                <td>Computer</td>
                <td>Full-Time</td>
          </tr>
	  <tr>
                <td>Electronics</td>
                <td>Financial</td>
                <td>Part-Time</td>
          </tr>
          <tr>
                <td>Housing</td>
                <td>Lessons</td>
                <td>Volunteering</td>
          </tr>
        </table>
        
      </p>
    </div>
    </body>
</html>

<?php

// It gives the user the login screen

require_once('initialize.php');
require_once('user.php');

$message ="";
if($session->is_logged_in()) {
 
  echo nl2br("You are logged in. Please choose what you want to do  \n");
  echo '<a href="mini_craigslist.php">Browse Ads</a>';
  echo nl2br("\n");
  echo '<a href="form_post.php">Post an Ad</a>';
  echo nl2br("\n");
  echo nl2br('<a href="logout.php">Logout</a>');
 
}
else {
  if (empty($_POST['username']) or empty($_POST['password'])){
     echo 'Please fill in all the required fields!';
  } else {
     global $database;
     $username = trim($_POST['username']);
     $password = trim($_POST['password']);
     $username = $database->escape_value($_POST["username"]);
     $password = md5($_POST['password']);

     if (isset($_POST['submit'])) { // The form has been submitted
       // Check the database to see if username/password exist.
       $found_user = User::authenticate($username,$password); 
       if($found_user) {
         // Create new session, store the user id
         $session->login($found_user);

         // Check if user is logged in
         if($session->is_logged_in()) {
           
          echo 'Hi '. $username . ', welcome to Mini-Craiglist!';

          echo nl2br("You are logged in. Please choose what you want to do  \n");
          echo '<a href="mini_craigslist.php">Browse Ads</a>';
          echo nl2br("\n");
          echo '<a href="form_post.php">Post an Ad</a>';
          echo nl2br("\n");
          echo nl2br('<a href="logout.php">Logout</a>');

          } else {
           echo 'Please login.';
          }

         } else {

          $message = "Username/password combination incorrect. May be you need to Register";
         
         }  

       } else { //form not submitted
  
         $username = "";
         $password = "";
       }
   }
}
?>

<html>
  <head>
    <title>AdsList</title>
    <link href="main.css" media="all" rel="stylesheet" type="text/css" />
  </head>

  <body>
    <div id="header">
      <h1>AdsList</h1>
    </div>
    <div id="main">
      <h2>Customer Login</h2>
      <?php echo output_message($message); ?>
    <form action="login.php" method="post">
    <table>
      <tr>
        <td>Username:</td>
        <td>
          <input type="text" name="username" maxlength="64" />
        </td>
      </tr>

      <tr>        
        <td>Password:</td>
        <td> 
          <input type="password" name="password" maxlength="40"/>
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <input type="submit" name="submit" value="Login" />
        </td>
      </tr>
     </table>
   </form>
   </div>
 </body>
</html>
<?php if(isset($database)) {$database->close_connection();} ?>
  

<?php

// This gives the user to do the user registration
require_once('initialize.php');

$message ="";

/*
if($session->is_logged_in()) {
  redirect_to("index.php");
}
*/

  if (isset($_POST['submit'])) { // The form has been submitted

    // Yes, the user has clicked on the submit button,
    // let's check if he filled in all the fields

    if(empty($_POST['username']) OR
      empty($_POST['password']) OR
      empty($_POST['email']) ) {

      // At least one of the file is empty, display an error
      echo 'You haven\'t filled in all the fields. Please do it again.';

     } else {

        // User has filled it all in!
        // SQL save variables
       global $database;
       $username = trim($_POST['username']);
       $password = trim($_POST['password']);
       $email    = trim($_POST['email']);

       $username = $database->escape_value($_POST["username"]);
       $password = md5($_POST['password']);
       $email = $database->escape_value($_POST["email"]);

       $sql = "SELECT COUNT(*) as total FROM users  WHERE username = '" . $username . "' AND email = '" . $email . "' ;";
     
       $result = $database->query($sql);
       $assoc_arr = $database->fetch_assoc($result);
       $count = $assoc_arr['total'];

       if($count == 0) {
       // Username and Email are free!
         $user = new User();
         $user->username = $username;
         $user->password = $password;
         $user->email = $email;
         $user->create();
         echo 'You have successfully registered!<br>';
        ?>
         <a href="login.php">Please Click Here to Login</a>
<?php
        } else {
          // Username or Email already taken
          echo 'Username & Email address already taken!';
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
    <h2>Customer Registration</h2>
    <?php echo output_message($message); ?>

    <form action="register.php" method="post">
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
          <input type="password" name="password" maxlength="40" />
        </td>
      </tr>
      
      <tr>
        <td>email:</td>
        <td>
          <input type="text" name="email" maxlength="64"/>
        </td>
       </tr>
     

      <tr>
        <td colspan="2">
          <input type="submit" name="submit" value="Register" />
        </td>
      </tr>
     </table>
   </form>
   </div>
 </body>
</html>
<?php if(isset($database)) {$database->close_connection();} ?>
  

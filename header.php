<?php

// Start session
//session_start();

// Check if user is logged in
if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    echo '<a href="logout.php">Logout</a>';

} 


echo '<p></p>';
echo '<p></p>';

?>

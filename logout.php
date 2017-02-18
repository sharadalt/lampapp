<?php

require_once('initialize.php');

if($session->is_logged_in()) {
   $session->logout();
   session_destroy();
}

// now that the user is logged out,
// go to login page
redirect_to('index.php');

?>

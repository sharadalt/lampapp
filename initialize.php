<?php
//Define the core paths
//DIRECTORY_SEPARATOR is a PHP pre-defined constant
//(\for Windows, / for Unix)

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

require_once("functions.php");
require_once("session.php");
require_once("database.php");
require_once("user.php");

?>

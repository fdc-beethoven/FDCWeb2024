<?php
session_start();
// load anything important here related to your program!!!!!!

require_once "config/classes/DB.php";
require_once "config/classes/User.php";
require_once "config/classes/Project.php";
require_once "config/classes/Task.php";
$db = new DB();
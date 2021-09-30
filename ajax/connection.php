<?php
session_start();
include_once '../web-api/config/db.php';
include_once '../web-api/config/core.php';
include_once '../web-api/objects/user.php';
include_once '../web-api/objects/details.php';

// instantiate database and user object

$database = new Database();
$db = $database->getConnection();
$details = new details($db);
$user = new user($db);
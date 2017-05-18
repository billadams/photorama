<?php
// require files
//require('includes/config.php');
require('model/database.php');
require('model/user_db.php');
require('model/validate.php');
require('model/user.php');
//include_once('includes/functions.php');

session_start();

//set default value of variables for initial page load
if (!isset($user_id)) {
    $user_id = '';
}
if (!isset($username)) {
    $username = '';
}
if (!isset($email)) {
    $email = '';
}
if (!isset($password)) {
    $password = '';
}

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'user_galleries';
    }
}

switch ($action) {
    case 'user_galleries':
        include('views/user_galleries.php');
    break;
}
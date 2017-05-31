<?php
// Require necessary files
require('includes/config.php');
require('model/database.php');
require('model/user_db.php');
require('model/validate.php');
require('model/user.php');
require('includes/utilities.php');
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
        $user = new User("", "Triton", "billadams1977@gmail.com", false, "Password01!");
//        $user = $user->create_new("100", "Triton", "billadams1977@gmail.com", "Password01!");
        include('views/user_galleries.php');
    break;
    case 'register':
        include('views/register.php');
        break;
    case 'register_attempt':
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');
        $password_verify = filter_input(INPUT_POST, 'password_verify');
        //        $image_path = "images/stick1.jpg";

//        $errors_user_registration = Validate::validate_user_registration($first_name, $last_name, $email, $username);
        $errors = Validate::validate_password_match($password, $password_verify);
//        $errors_topology = Validate::validate_check_password_topologies($password);
//        $errors_password_rules = Validate::validate_password_rules($password);
//        $errors_new_user_name = Validate::validate_new_user_name($username);
//        $errors = array_merge($errors_user_registration, $errors_topology, $errors_password_rules, $errors_new_user_name);

        if (!$errors) {
            // Instantiate User Object
            $user = new User('', $email, false, $password);
//            $user = $user->create_new($first_name, $last_name, $username, $email, $password, $image_path);

            // Submit user
            UserDB::add_new_user($user);

//            $subject = 'Stickman registration confirmation';
//            $message = 'Registration successful for ' . $first_name . ' ' . $last_name . '.' . PHP_EOL;
//            $message .= 'Your username is ' . $username . '.';
//            $headers = 'From: webmaster@stickman1.com' . "\r\n" .
//                'Reply-To: webmaster@stickman1.com' . "\r\n";
//            $mail_success = false;
//            if (mail($email, $subject, $message, $headers)) {
//                $mail_success = true;
//            } else {
//                $message = 'Registration was unsuccessful, please try again.';
//            }

            include('views/login.php');
        } else {
            include('views/registration.php');
        }
        break;
    case 'login_attempt':
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');

        $row = UserDB::get_user_by_username($username);
        $user = new User();
        $user = $user->create_user_instance($row['id'], $row['FirstName'], $row['LastName'],
            $row['UserName'], $row['Email'], $row['Password'], $row['ImagePath']);

        $errors = Validate::validate_login($username, $password, $user);

        if (!$errors) {
            $_SESSION['user_id'] = $user->get_user_id();
            $_SESSION['is_logged_in'] = true;
            include('views/profile_admin.php');
        } else {
            include('views/login.php');
        }
        break;
}
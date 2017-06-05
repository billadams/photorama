<?php
// Require necessary files
require_once('util/main.php');
require_once('util/config.php');
require_once('util/functions.php');
require_once('model/database.php');
require_once('model/user_db.php');
require_once('model/category_db.php');
require_once('model/validate.php');
require_once('model/user.php');

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
if (!isset($password_confirm)) {
    $password_confirm = '';
}

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'category_view';
    }
}

switch ($action) {
    case 'category_view':
        $row = UserDB::get_user_by_id(14);
        $user = new User($row['user_id'], $row['username'], $row['email'], false, $row['password'], $row['profile_image']);

//        $user = new User("", "Triton", "billadams1977@gmail.com", false, "Password01!");
//        $user = $user->create_new("100", "Triton", "billadams1977@gmail.com", "Password01!");
        include('views/category_view.php');
    break;
    case 'show_register_form':
        include('views/register.php');
        break;
    case 'show_login_form':
        include('views/login.php');
        break;
    case 'register':
        $username = filter_input(INPUT_POST, 'username');
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');
        $password_confirm = filter_input(INPUT_POST, 'confirm_password');

        $errors_user_registration = Validate::validate_user_registration($email, $username, $password, $password_confirm);
////        $errors_topology = Validate::validate_check_password_topologies($password);
////        $errors_password_rules = Validate::validate_password_rules($password);
        $errors_new_username = Validate::validate_new_username($username);
        $errors = array_merge($errors_user_registration, $errors_new_username);

        if (!$errors) {
            // Create the new user in the database and return the new user
            $inserted_user_id = UserDB::add_new_user($username, $email, Utilities::hash_password($password));
            $row = UserDB::get_user_by_id($inserted_user_id);

            // Send the newly registered user and email welcoming them to Stickman social network.
//            $subject = 'Stickman registration confirmation';
//            $message = 'Registration successful for ' . $first_name . ' ' . $last_name . '.' . PHP_EOL;
//            $message .= 'Your username is ' . $username . '.';
//            $headers = 'From: webmaster@stickman1.com' . "\r\n" .
//                    'Reply-To: webmaster@stickman1.com' . "\r\n";
//            $mail_success = false;
//            if (mail($email, $subject, $message, $headers)) {
//                $mail_success = true;
//            } else {
//                $message = 'Registration was unsuccessful, please try again.';
//            }

            // Instantiate user object
            $user = new User($row['user_id'], $row['username'], $row['email'], false, $row['password'], $row['profile_image']);
            // Store the user_id in a session so we can log them in.
            $_SESSION['user_id'] = $user->get_user_id();
            include('views/profile_admin.php');
        } else {
            include('views/register.php');
        }
        break;
    case 'view_admin_profile':
        $user_id = $_SESSION['user_id'];
        $row = UserDB::get_user_by_id($user_id);
        $user = new User($row['user_id'], $row['username'], $row['email'], false, $row['password'], $row['profile_image']);

//        $user_images = UserDB::get_category_images_by_user($user_id);
        $user_image_library = array();
        $categories = CategoryDB::get_all_categories();
        foreach ($categories as $category) {
            $user_image_library[] = $category;
            $category_images = CategoryDB::get_user_images_by_category($category['category_id'], $user_id);
            $user_image_library[$category][] = $category_images;
        }

            include('views/profile_admin.php');
        break;
    case 'login':
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');

        $row = UserDB::get_user_by_username($username);
        $user = new User($row['user_id'], $row['username'], $row['email'], false, $row['password'], $row['profile_image']);

        $errors = Validate::validate_login($username, $password, $user);

        if (!$errors) {
            $_SESSION['user_id'] = $user->get_user_id();
            include('views/profile_admin.php');
        } else {
            include('views/login.php');
        }
        break;
    case 'logout':
        $_SESSION = array();
        session_destroy();

        header("Location: .");
    case 'update_profile_image':
        if (isset($_FILES['image'])) {
            $errors = array();
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_tmp = $_FILES['image']['tmp_name'];
            $file_type = $_FILES['image']['type'];
            $temp = explode('.', $_FILES['image']['name']);
            $file_extension = end($temp);
//            $file_ext = strtolower($temp);

//            var_dump($_FILES);

            $extensions = array("jpeg", "jpg", "png", "gif");
            $upload_dir = "/images/";
            $name = pathinfo($_FILES['image']['name'], PATHINFO_FILENAME);
            $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

            // Loop through and increment the numeric name suffix of the filename itself
            // until a number is found that an existing file doesn't already have.
            $i = 0;
            $file_name = $name . '.' . $extension;
            while ( is_file(getcwd() . $upload_dir . $file_name)) {
                $i++;
                $file_name = $name . $i . '.' . $extension;
            }

            if (in_array($file_extension, $extensions) === false) {
                $errors[] = "Attempted image upload file extension not in whitelist: " . join(', ', $extensions);
            }

            if (empty($errors) === true) {
                $path = move_uploaded_file($file_tmp, getcwd() . "/" . "images/" . $file_name);

                $image_path = "images/" . $file_name;
                $user_id = $_SESSION['user_id'];
                UserDB::update_profile_image($image_path, $user_id);


                $row = UserDB::get_user_by_id($user_id);
                $user = new User($row['user_id'], $row['username'], $row['email'], false, $row['password'], $row['profile_image']);

                include('views/profile_admin.php');
//                echo "Success";
            } else {
//                var_dump($errors);
                include 'views/upload_error.php';
            }
        }
        break;
}
<?php
// Require necessary files
require_once('util/main.php');
require_once('util/config.php');
require_once('util/functions.php');
require_once('model/database.php');
require_once('model/user_db.php');
require_once('model/category_db.php');
require_once('model/image_db.php');
require_once('model/validate.php');
require_once('model/user.php');

session_start();

// Set default value of variables for initial page load
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
        $users = UserDB::get_all_users();

        include('views/galleries_view.php');
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

        $errors_new_username = Validate::validate_new_username($username);
        $errors_user_registration = Validate::validate_user_registration($email, $username, $password, $password_confirm);
        $errors_topology = Validate::validate_check_password_topologies($password);
        $errors_password_rules = Validate::validate_password_rules($password);
        $errors = array_merge($errors_new_username, $errors_user_registration, $errors_topology, $errors_password_rules);

        if (!$errors) {
            // Create the new user in the database and return the new user
            $inserted_user_id = UserDB::add_new_user($username, $email, Utilities::hash_password($password));
            $row = UserDB::get_user_by_id($inserted_user_id);

            // Instantiate user object
            $user = new User($row['user_id'], $row['username'], $row['email'], false, $row['password'], $row['profile_image']);

            $motocross_images = CategoryDB::get_user_images_by_category(3, $user->get_user_id());
            $colorado_images = CategoryDB::get_user_images_by_category(2, $user->get_user_id());
            $disney_images = CategoryDB::get_user_images_by_category(1, $user->get_user_id());

            $num_images = ImageDB::count_total_user_images($user->get_user_id());
            $num_categories = ImageDB::count_total_user_categories($user->get_user_id());

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

        // Hard code the categories for now until I can find a way to pull the category
        // and put the the user images into the category.
        $motocross_images = CategoryDB::get_user_images_by_category(3, $user->get_user_id());
        $colorado_images = CategoryDB::get_user_images_by_category(2, $user->get_user_id());
        $disney_images = CategoryDB::get_user_images_by_category(1, $user->get_user_id());

        $num_images = ImageDB::count_total_user_images($user_id);
        $num_categories = ImageDB::count_total_user_categories($user->get_user_id());

        include('views/profile_admin.php');
        break;
    case 'view_profile':
        $user_id = filter_input(INPUT_GET, 'user_id', FILTER_VALIDATE_INT);

        // Get the profile the user selected.
        $row = UserDB::get_user_by_id($user_id);
        $user = new User($row['user_id'], $row['username'], $row['email'], false, $row['password'], $row['profile_image']);

        $motocross_images = CategoryDB::get_user_images_by_category(3, $user->get_user_id());
        $colorado_images = CategoryDB::get_user_images_by_category(2, $user->get_user_id());
        $disney_images = CategoryDB::get_user_images_by_category(1, $user->get_user_id());

        $num_images = ImageDB::count_total_user_images($user->get_user_id());
        $num_categories = ImageDB::count_total_user_categories($user->get_user_id());

        include('views/profile_public.php');
        break;
    case 'login':
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');

        $row = UserDB::get_user_by_username($username);
        $user = new User($row['user_id'], $row['username'], $row['email'], false, $row['password'], $row['profile_image']);

        $errors = Validate::validate_login($username, $password, $user);

        $motocross_images = CategoryDB::get_user_images_by_category(3, $user->get_user_id());
        $colorado_images = CategoryDB::get_user_images_by_category(2, $user->get_user_id());
        $disney_images = CategoryDB::get_user_images_by_category(1, $user->get_user_id());

        $num_images = ImageDB::count_total_user_images($user->get_user_id());
        $num_categories = ImageDB::count_total_user_categories($user->get_user_id());

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

                $user_id = $_SESSION['user_id'];
                $row = UserDB::get_user_by_id($user_id);
                $user = new User($row['user_id'], $row['username'], $row['email'], false, $row['password'], $row['profile_image']);

                $motocross_images = CategoryDB::get_user_images_by_category(3, $user->get_user_id());
                $colorado_images = CategoryDB::get_user_images_by_category(2, $user->get_user_id());
                $disney_images = CategoryDB::get_user_images_by_category(1, $user->get_user_id());

                $num_images = ImageDB::count_total_user_images($user->get_user_id());
                $num_categories = ImageDB::count_total_user_categories($user->get_user_id());

                include('views/profile_admin.php');
            } else {
                include ('views/upload_error.php');
            }
        }
        break;
}
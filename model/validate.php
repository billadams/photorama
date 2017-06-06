<?php
class Validate {
    public static function validate_user_registration($email, $username, $password, $password_confirm)
    {
        $username_exists = false;
        $email_exists = false;
        $errors = array();

        $username_row_count = UserDB::check_unique_username($username);
        if ($username_row_count === 1) {
            $username_exists = true;
        }

        $email_row_count = UserDB::check_unique_email($email);
        if ($email_row_count ===1) {
            $email_exists = true;
        }

        if ($username_exists === true) {
            $error_message = 'Our records indicate that the username provided is already in use. Please choose a different username.';
            $errors[] = $error_message;
        }

        if ($username === null || $username === '') {
            $error_message = 'Please enter a user name.';
            $errors[] = $error_message;
        }

        if ($email_exists === true) {
            $error_message = 'Our records indicate that the email provided is already in use. Please choose a different email address.';
            $errors[] = $error_message;
        }

        if ($email === false || $email === '') {
            $error_message = 'Please enter a valid email address.';
            $errors[] = $error_message;
        }

        if ($password !== $password_confirm) {
            $error_message = "Passwords do not match.";
            $errors[] = $error_message;
        }

        return $errors;
    }

    public static function validate_password_match($password, $password_verify) {
        $errors = array();

        if ($password != $password_verify) {
            $error_message = 'Passwords do not match';
            $errors[] = $error_message;
        }

        // Passwords do match, return an empty array
        return $errors;
    }

    public static function validate_user_update($first_name, $last_name, $email)
    {
        $errors = array();

        if ($first_name === null || $first_name === '') {
            $error_message = 'Please enter a first name.';
            $errors[] = $error_message;
        }
        if ($last_name === null || $last_name === '') {
            $error_message = 'Please enter a last name.';
            $errors[] = $error_message;
        }
        if ($email === false || $email === '') {
            $error_message = 'Please enter a valid email address.';
            $errors[] = $error_message;
        }

        return $errors;
    }

    public static function validate_check_password_topologies($password)
    {
        $errors = array();

        $patterns = array("/^[A-Z]{1}[a-z]{7}[0-9]{2}$/", "/^[A-Z]{1}[a-z]{5}[0-9]{4}$/", "/^[A-Z]{1}[a-z]{6}[0-9]{4}$/",
            "/^[A-Z]{1}[a-z]{7}[0-9]{1}[-!$%^&*()_+|~=`{}\[\]:\";'<>?,.\/]$/", "/^[A-Z]{1}[a-z]{7}[0-9]{4}$/");

        foreach($patterns as $pattern) {
            if (preg_match($pattern, $password)) {
                $message = "Incorrect topology";
                $errors[] = $message;
            }
        }

        return $errors;
    }

    public static function validate_password_rules($password)
    {
        $errors = array();
        $pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[-!$%^&*()_+|~=`{}\[\]:\";'<>?,.\/])(?=.{10,})$|(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{10,})|(?=.*[A-Z])(?=.*[0-9])(?=.*[-!$%^&*()_+|~=`{}\[\]:\";'<>?,.\/])(?=.{10,})|(?=.*[a-z])(?=.*[0-9])(?=.*[-!$%^&*()_+|~=`{}\[\]:\";'<>?,.\/])(?=.{10,})|(?=.*[a-z])(?=.*[A-Z])(?=.*[-!$%^&*()_+|~=`{}\[\]:\";'<>?,.\/])(?=.{10,})$/";

        if (preg_match($pattern, $password))
        {
            return $errors;
        }
        $message = "Password doesn't match the required specifications";
        $errors[] = $message;

        return $errors;
    }

    public static function validate_new_username($username)
    {
        // Username must begin with a letter and be between 4 to 20 characters
        $errors = array();
        $pattern = "/^[A-Z a-z]{1}[A-Z a-z 0-9!\$_.]{3,19}$/";

        if (preg_match($pattern, $username))
        {
            return $errors;
        }
        $message = "Username must begin with a letter and be between 4 and 20 characters.";
        $errors[] = $message;

        return $errors;
    }

    public static function validate_login($username, $password, User $user)
    {
        $errors = array();
        $password_matches = password_verify($password, $user->get_password());

        if ($username !== $user->get_username()) {
            $message = "Username not recognized";
            $errors[] = $message;
        }
        if (!$password_matches) {
            $message = "Password not recognized";
            $errors[] = $message;
        }

        return $errors;
    }
}
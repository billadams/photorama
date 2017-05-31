<?php
class Validate {
    public static function validate_user_registration($first_name, $last_name, $email, $username)
    {
        $username_exists = false;

        $row_count = UserDB::check_unique_username($username);
        if ($row_count === 1) {
            $username_exists = true;
        }
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
        //add username rules of must begin with letter and 4 to 20 chars use preg_match
        if ($username === null || $username === '' || $username_exists === true) {
            $error_message = 'Please enter a unique user name.';
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

        //add regex topologies use preg_match
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

    public static function validate_new_user_name($username)
    {
        $errors = array();
        $pattern = "/^[A-Z a-z]{1}[A-Z a-z 0-9!\$_.]{3,19}$/";

        if (preg_match($pattern, $username))
        {
            return $errors;
        }
        $message = "Incorrect username";
        $errors[] = $message;

        return $errors;
    }

    public static function validate_login($username, $password, User $user)
    {
        $errors = array();
        $password_matches = password_verify($password, $user->get_password());

        if ($username === $user->get_username() && $password_matches) {
            return $errors;
        }
        $message = "Invalid login information";
        $errors[] = $message;

        return $errors;
    }
}
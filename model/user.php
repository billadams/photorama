<?php
class User {

    private $user_id;
    private $username;
    private $email;
    private $password;
    private $profile_image;

    public function __construct($user_id = null, $username, $email, $hash_password = false, $password, $profile_image = null) {
        $this->user_id = $user_id;
        $this->username = $username;
        $this->email = $email;
        if ($hash_password == true) {
            $this->password = Utilities::hash_password($password);
        } else {
            $this->password = $password;
        }
        $this->profile_image = $profile_image;
    }

    public function get_user_id()
    {
        return $this->user_id;
    }

    public function set_user_id($user_id)
    {
        $this->user_id = $user_id;
    }

    public function get_username()
    {
        return $this->username;
    }

    public function set_username($username)
    {
        $this->username = $username;
    }

    public function get_email()
    {
        return $this->email;
    }

    public function set_email($email)
    {
        $this->email = $email;
    }

    public function get_password()
    {
        return $this->password;
    }

    public function set_password($password)
    {
        $this->password = $password;
    }

    public function get_profile_image()
    {
        return $this->profile_image;
    }

    public function set_profile_image($profile_image)
    {
        $this->password = $profile_image;
    }
}
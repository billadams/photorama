<?php
class User {
    private $user_id;
    private $username;
    private $email;
    private $password;

    public function __construct() {

    }

    public function create($user_id, $username, $email, $password) {
        $user_instance = new self;

        $user_instance->set_user_id($user_id);
        $user_instance->set_username($username);
        $user_instance->set_email($email);
        $user_instance->set_password_with_hash($password);

        return $user_instance;
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

    public function set_password_with_hash($password)
    {
        $this->password = Utilites::hash_password($password);
    }
}